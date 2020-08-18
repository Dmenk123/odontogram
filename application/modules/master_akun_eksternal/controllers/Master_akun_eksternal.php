<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_akun_eksternal extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		//profil data
		$this->load->model('profil/mod_profil','prof');
		$this->load->model('mod_master_akun_eksternal','akun');
	}

	public function index()
	{	
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->prof->get_detail_pengguna($id_user);

		$data = array(
			'data_user' => $data_user
		);

		$content = [
			'css' 	=> 'cssMasterAkunEksternal',
			'modal' => 'modalMasterAkunEksternal',
			'js'	=> 'jsMasterAkunEksternal',
			'view'	=> 'view_list_master_akun_eksternal'
		];

		$this->template_view->load_view($content, $data);
	}

	public function list_akun_eksternal()
	{
		$txtNamaIndex = "";
		$list = $this->akun->get_datatables();
		$data = array();
		$no =$_POST['start'];
		foreach ($list as $val) {
			// $no++;
			$row = array();
			if ($val->sub_1 != null || $val->sub_2 != null) {
				if ($val->nama_sub != null) {
					$txtNamaIndex = $val->nama_sub;
				}else{
					$q = $this->db->query("SELECT nama from tbl_master_kode_akun WHERE kode = '".$val->kode."' and sub_1 is null and sub_2 is null")->row();
					$txtNamaIndex = $q->nama;
				}

				// $row[] = $no;
				$row[] = $txtNamaIndex;
				$row[] = $val->nama;
				$row[] = $val->kode_in_text;

				$str_unique = $val->tipe.'-'.$val->kode_in_text;
				//add html for action
				$row[] = '
						<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_akun('."'".$str_unique."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
						<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_akun('."'".$str_unique."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
				';

				$data[] = $row;
			}
		}//end loop

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->akun->count_all(),
			"recordsFiltered" => $this->akun->count_filtered(),
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
		$sub_1_text = $this->input->post('sub_akun');
		$sub_2 = null;

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}

		$arr_akun = explode("-",$kat_akun);
		$tipe = $arr_akun[0];
		
		$kode_in_text = $arr_akun[1];
		$arr_kode_in_text = explode(".", $kode_in_text);
		$kode = $arr_kode_in_text[0];

		if ($sub_1_text == '') {
			$q = $this->db->query("select max(sub_1) as last_sub1 from tbl_master_kode_akun where kode = '".$kode."' and tipe ='".$tipe."'")->row();
			if ($q->last_sub1 == null) {
				$kode_sub1_final = 1;
			}else{
				$kode_sub1_final = (int)$q->last_sub1 + 1;
			}

			$kode_in_text_final = $kode.'.'.$kode_sub1_final; 
		}else{
			$arr_sub_1_text = explode('.', $sub_1_text);
			$kode_sub1_final = $arr_sub_1_text[1];

			$q2 = $this->db->query("select max(sub_2) as last_sub2 from tbl_master_kode_akun where kode = '".$kode."' and sub_1 = '".$kode_sub1_final."' and tipe ='".$tipe."'")->row();
			if ($q2->last_sub2 == null) {
				$sub_2 = 1;
			}else{
				$sub_2 = (int)$q2->last_sub2 + 1;
			}

			$kode_in_text_final = $kode.'.'.$kode_sub1_final.'.'.$sub_2;
		}
		
		$data = array(
			'tipe' => $tipe,
			'nama' => $nama,
			'kode' => $kode,
			'sub_1' => $kode_sub1_final,
			'sub_2' => $sub_2,
			'kode_in_text' => $kode_in_text_final
		);

		$insert = $this->akun->save($data);
		echo json_encode(array(
			"status" => TRUE,
			"pesan" => 'Master Akun Eksternal Berhasil ditambahkan',
		));
	}

	public function get_kategori_akun() {
		if (isset($_GET['term'])) {
			$q = strtolower($_GET['term']);
		}else{
			$q = '';
		}
		
		$query = $this->akun->lookup_kode_akun($q);
		
		foreach ($query as $row) {
			$akun[] = array(
				'id' => $row->tipe.'-'.$row->kode_in_text,
				'text' => $row->kode_in_text.' - '.$row->nama
			);
		}
		echo json_encode($akun);
	}

	public function get_data_subakun($kategori_akun)
	{
		$arr_pecah = explode('-', $kategori_akun);
		$tipe = $arr_pecah[0];
		$kode_in_text = $arr_pecah[1];

		$q = $this->db->query("
			select nama, tipe, sub_1, kode_in_text
			from tbl_master_kode_akun 
			where kode ='".$kode_in_text."' and tipe = '".$tipe."' and sub_1 is not null and sub_2 is null and is_aktif = '1'  
		")->result();

		echo json_encode($q);
	}

	public function edit($id)
	{
		$arr_akun = explode("-",$id);
		$kode = $arr_akun[1];
		$tipe = $arr_akun[0];
		$data = $this->db->get_Where('tbl_master_kode_akun', ['tipe' => $tipe, 'kode_in_text' => $kode])->row();
		
		$q = $this->db->query("select * from tbl_master_kode_akun where tipe = '".$tipe."' and kode = '".$data->kode."' and sub_1 is null and sub_2 is null")->row();

		$q2 = $this->db->query("
			select nama, tipe, sub_1, kode_in_text
			from tbl_master_kode_akun 
			where kode ='".$data->kode."' and tipe = '".$tipe."' and sub_1 = '".$data->sub_1."' and sub_2 is null and is_aktif = '1'  
		")->row();

		if ($q2) {
			$kat_val_sub = $q2->kode_in_text;
			$kat_nama_sub =  $q2->nama;
		}else {
			$kat_val_sub = null;
			$kat_nama_sub = null;
		}

		$arr_pecah_kode_in_text = explode('.', $kode);
		if (count($arr_pecah_kode_in_text) < 3) {
			$kat_val_sub = null;
			$kat_nama_sub = null;
		}
		
		$hasil = [
			'nama' => $data->nama,
			'id' => $data->kode_in_text,
			'kat_id' => $tipe.'-'.$data->kode_in_text,
			'kat_text' => $q->kode_in_text.' - '.$q->nama,
			'kat_val_sub' => $kat_val_sub,
			'kat_nama_sub' => $kat_nama_sub
		];
		
		echo json_encode($hasil);
	}

	public function update()
	{
		$arr_valid = $this->_validate();
		$kat_akun = $this->input->post('kat_akun');
		$nama = $this->input->post('nama');
		$sub_1_text = $this->input->post('sub_akun');
		$sub_2 = false;

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}

		$arr_akun = explode("-",$kat_akun);
		$tipe = $arr_akun[0];
		$kode_in_text = $arr_akun[1];

		$arr_kode_in_text = explode(".", $kode_in_text);
		$kode = $arr_kode_in_text[0];

		$data = array(
			'nama' => $nama
		);

		$this->akun->update([
			'kode_in_text' => $kode_in_text, 'tipe' => $tipe], $data
		);

		echo json_encode(array(
			"status" => TRUE,
			"pesan" => 'Master Akun Berhasil diupdate',
		));
	}

	public function delete($id)
	{
		// $this->m_sat->delete_by_id($id);
		$arr_akun = explode("-",$id);
		$kode = $arr_akun[1];
		$tipe = $arr_akun[0];
		$this->akun->update(['kode_in_text' => $kode, 'tipe' => $tipe], ['is_aktif '=> 0]);
		echo json_encode(array(
			"status" => TRUE,
			"pesan" => 'Data Master Akun Eksternal Berhasil dihapus',
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
