<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_akun_internal extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		//profil data
		$this->load->model('profil/mod_profil','prof');
		$this->load->model('mod_master_akun_internal','akun_i');
	}

	public function index()
	{	
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->prof->get_detail_pengguna($id_user);

		$data = array(
			'data_user' => $data_user
		);

		$content = [
			'css' 	=> 'cssMasterAkunInternal',
			'modal' => 'modalMasterAkunInternal',
			'js'	=> 'jsMasterAkunInternal',
			'view'	=> 'view_list_master_akun_internal'
		];

		$this->template_view->load_view($content, $data);
	}

	public function list_akun_internal()
	{
		$txtNamaIndex = "";
		$list = $this->akun_i->get_datatables();
		$data = array();
		$no =$_POST['start'];
		foreach ($list as $val) {
			$no++;
			$row = array();
			if ($val->sub_1 != null || $val->sub_2 != null) {
				if ($val->nama_sub != null) {
					$txtNamaIndex = $val->nama_sub;
				}else{
					$q = $this->db->query("SELECT nama from tbl_master_kode_akun_internal WHERE kode = '".$val->kode."' and sub_1 is null and sub_2 is null")->row();
					$txtNamaIndex = $q->nama;
				}

				$row[] = $no;
				$row[] = $txtNamaIndex;
				$row[] = $val->nama;
				$row[] = $val->kode_in_text;

				//add html for action
				$row[] = '
						<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_akun('."'".$val->kode_in_text."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
						<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_akun('."'".$val->kode_in_text."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
				';

				$data[] = $row;
			}
		}//end loop

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->akun_i->count_all(),
			"recordsFiltered" => $this->akun_i->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function add()
	{
		$arr_valid = $this->_validate();
		$kat_akun = $this->input->post('kat_akun');
		$nama = $this->input->post('nama');
		$akun_ext = $this->input->post('kat_akun_ext');
		$arr_tipe_akun_ext = explode("-",$akun_ext);
		$tipe_ext = $arr_tipe_akun_ext[0];
		$kode_in_text_ext = $arr_tipe_akun_ext[1];
		
		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}

		$arr_akun = explode("-",$kat_akun);
		$kode = $arr_akun[0];
		$kode_in_text = $arr_akun[1];

		$q = $this->db->query("select max(sub_1) as last_sub1 from tbl_master_kode_akun_internal where kode = '".$kode."'")->row();
		if ($q->last_sub1 == null) {
			$kode_sub1_final = 1;
		}else{
			$kode_sub1_final = (int)$q->last_sub1 + 1;
		}
		
		$data = array(
			'nama' => $nama,
			'kode' => $kode,
			'sub_1' => $kode_sub1_final,
			'sub_2' => null,
			'tipe_bos' => null,
			'kode_bos' => null,
			'kode_bos_sub1' => null,
			'kode_bos_sub2' => null,
			'kode_in_text' => $kode.'.'.$kode_sub1_final,
			'kodetext_akun_external' => trim($kode_in_text_ext),
			'tipe_akun_external' => trim($tipe_ext)
		);

		$insert = $this->akun_i->save($data);
		echo json_encode(array(
			"status" => TRUE,
			"pesan" => 'Master Akun Internal Berhasil ditambahkan',
		));
	}

	public function get_kategori_akun() {
		if (isset($_GET['term'])) {
			$q = strtolower($_GET['term']);
		}else{
			$q = '';
		}
		
		$query = $this->akun_i->lookup_kode_akun_internal($q);
		
		foreach ($query as $row) {
			$akun[] = array(
				'id' => $row->kode.'-'.$row->kode_in_text,
				'text' => $row->kode_in_text.' - '.$row->nama
			);
		}
		echo json_encode($akun);
	}

	public function get_kategori_akun_external() {
		if (isset($_GET['term'])) {
			$q = strtolower($_GET['term']);
		}else{
			$q = '';
		}
		
		$query = $this->akun_i->lookup_kode_akun_external($q);
		
		foreach ($query as $row) {
			$akun[] = array(
				'id' => $row->tipe.' - '.$row->kode_in_text,
				'text' => $row->kode_in_text.' - '.$row->nama
			);
		}
		echo json_encode($akun);
	}

	public function edit($id)
	{
		$data = $this->akun_i->get_by_id($id);

		$q = $this->db->query("
			select tbl_master_kode_akun_internal.*, tbl_master_kode_akun.nama as nama_akun_ext
			from tbl_master_kode_akun_internal
			left join tbl_master_kode_akun on tbl_master_kode_akun_internal.kodetext_akun_external = tbl_master_kode_akun.kode_in_text and tbl_master_kode_akun.tipe = '".$data->tipe_akun_external."'
			where tbl_master_kode_akun_internal.kode = '".$data->kode."' and tbl_master_kode_akun_internal.kode_in_text = '".$data->kode_in_text."'")->row();
		
		$hasil = [
			'nama' => $data->nama,
			'id' => $data->kode_in_text,
			'kat_id' => $q->kode.'-'.$data->kode_in_text,
			'kat_text' => $q->kode_in_text.' - '.$q->nama,
			'kat_id2' => $q->tipe_akun_external.' - '.$q->kodetext_akun_external,
			'kat_text2' => $q->kodetext_akun_external.' - '.$q->nama_akun_ext
		];
		
		echo json_encode($hasil);
	}

	public function update()
	{
		//$this->_validate();
		$arr_akun = explode("-", $this->input->post('kat_akun'));

		$akun_ext = $this->input->post('kat_akun_ext');
		$arr_tipe_akun_ext = explode("-",$akun_ext);
		$tipe_ext = trim($arr_tipe_akun_ext[0]);
		$kode_in_text_ext = trim($arr_tipe_akun_ext[1]);
		
		$kode = $arr_akun[0];
		$kode_in_text = $arr_akun[1];

		$kode_akun = null;
		$sub1_akun = null;
		$sub2_akun = null;
		$arr_akun2 = explode(".", $arr_akun[1]);
		for ($z=0; $z <count($arr_akun2); $z++) { 
			if ($z == 0) {
				$kode_akun = $arr_akun2[$z];
			}elseif($z == 1){
				$sub1_akun = $arr_akun2[$z];
			}elseif($z == 2){
				$sub2_akun = $arr_akun2[$z];
			}
		}

		$data = array(
			'nama' => $this->input->post('nama'),
			'kode' => $kode,
			'sub_1' => $sub1_akun,
			'sub_2' => $sub2_akun,
			'kode_in_text' => $arr_akun[1],
			'kodetext_akun_external' => $kode_in_text_ext,
			'tipe_akun_external' => $tipe_ext
		);

		if ($this->input->post('nama') == '' || $this->input->post('kat_akun') == '') {
			echo json_encode(array(
				"status" => TRUE,
				"pesan" => 'Mohon Lengkapi isian pada form',
			));

			return;
		}

		$this->akun_i->update(array('kode_in_text' => $this->input->post('id')), $data);
		echo json_encode(array(
			"status" => TRUE,
			"pesan" => 'Master Akun Internal Berhasil diupdate',
		));
	}

	public function delete($id)
	{
		// $this->m_sat->delete_by_id($id);
		$this->akun_i->update(['kode_in_text' => $id], ['is_aktif '=> 0]);
		echo json_encode(array(
			"status" => TRUE,
			"pesan" => 'Data Master Akun Internal Berhasil dihapus',
		));
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('nama') == '') {
			$data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Nama wajib di isi';
            $data['status'] = FALSE;
		}
		if($this->input->post('kat_akun') == '')
        {
            $data['inputerror'][] = 'kat_akun';
            $data['error_string'][] = 'Kategori Akun Wajib di isi';
            $data['status'] = FALSE;
        }
		
		return $data;
	}
}
