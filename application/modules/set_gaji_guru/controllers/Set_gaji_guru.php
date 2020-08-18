<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Set_gaji_guru extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		//profil data
		$this->load->model('profil/mod_profil','prof');
		$this->load->model('mod_set_gaji_guru','m_set');
	}

	public function index()
	{	
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->prof->get_detail_pengguna($id_user);

		$data = array(
			'data_user' => $data_user
		);

		$content = [
			'css' 	=> 'cssSetGajiGuru',
			'modal' => 'modalSetGajiGuru',
			'js'	=> 'jsSetGajiGuru',
			'view'	=> 'view_list_set_gaji_guru'
		];

		$this->template_view->load_view($content, $data);
	}

	public function suggest_jabatan()
	{
		if (isset($_GET['term'])) {
			$q = strtolower($_GET['term']);
		}else{
			$q = '';
		}
		
		$query = $this->m_set->lookup_kode_jabatan($q);
		
		foreach ($query as $row) {
			$akun[] = array(
				'id' => $row->id,
				'text' => $row->nama,
				'tunjangan' => $row->tunjangan
			);
		}
		echo json_encode($akun);
	}

	public function get_tunjangan($id)
	{
		$q = $this->db->query("select tunjangan from tbl_jabatan where id = '".$id."'")->row();
		echo json_encode($q);
	}

	public function list_data()
	{
		$list = $this->m_set->get_datatables();
		$data = array();
		$no =$_POST['start'];
		foreach ($list as $sat) {
			// $no++;
			$row = array();
			//loop value tabel db
			// $row[] = $no;
			$row[] = $sat->nama_jabatan;
			$row[] = '
				<div>
	                <span class="pull-left">Rp. </span>
	                  <span class="pull-right">'.number_format($sat->gaji_pokok,2,",",".").'</span>
	             </div>
			';
			$row[] = '
				<div>
	                <span class="pull-left">Rp. </span>
	                  <span class="pull-right">'.number_format($sat->gaji_perjam,2,",",".").'</span>
	             </div>
			';
			$row[] = '
				<div>
	                <span class="pull-left">Rp. </span>
	                  <span class="pull-right">'.number_format($sat->gaji_tunjangan_jabatan,2,",",".").'</span>
	             </div>
			';

			//add html for action
			$row[] = '
					<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_data('."'".$sat->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$sat->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
			';

			$data[] = $row;
		}//end loop

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_set->count_all(),
			"recordsFiltered" => $this->m_set->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function add_data()
	{
		//validasi
		$arr_valid = $this->_validate();
		
		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		} 

		$data = array(
			'id_jabatan' => $this->input->post('jabatan'),
			'gaji_pokok' => $this->input->post('gapok_raw'),
			'gaji_perjam' => $this->input->post('gaperjam_raw'),
			'gaji_tunjangan_jabatan' => $this->input->post('tunjangan_raw'),
			'is_guru' => $this->input->post('tipepeg')			
		);

		$insert = $this->m_set->save($data);
		
		echo json_encode(array(
			"status" => TRUE,
			"pesan" => 'Berhasil Setting gaji',
		));
	}

	public function edit($id)
	{
		$data = $this->db->query("SELECT tbl_set_gaji.*, tbl_jabatan.nama as nama_jabatan from tbl_set_gaji join tbl_jabatan on tbl_set_gaji.id_jabatan = tbl_jabatan.id where tbl_set_gaji.id = '".$id."'")->row();

		//$data = $this->m_set->get_by_id($id);		
		echo json_encode($data);
	}

	public function update_data()
	{
		$arr_valid = $this->_validate();
		
		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		} 

		$data = array(
			'id_jabatan' => $this->input->post('jabatan'),
			'gaji_pokok' => $this->input->post('gapok_raw'),
			'gaji_perjam' => $this->input->post('gaperjam_raw'),
			'gaji_tunjangan_jabatan' => $this->input->post('tunjangan_raw'),
			'is_guru' => $this->input->post('tipepeg')			
		);

		$this->m_set->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array(
			"status" => TRUE,
			"pesan" => 'Setting Gaji Berhasil diupdate',
		));
	}

	public function delete_data($id)
	{
		// $this->m_set->delete_by_id($id);
		$this->m_set->update(['id' => $id], ['is_aktif '=> 0]);
		echo json_encode(array(
			"status" => TRUE,
			"pesan" => 'Setting Gaji Berhasil dihapus',
		));
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('jabatan') == '') {
			$data['inputerror'][] = 'jabatan';
            $data['error_string'][] = 'Wajib mengisi jabatan';
            $data['status'] = FALSE;
		}

		// if ($this->input->post('gapok') == '') {
		// 	$data['inputerror'][] = 'gapok';
  //           $data['error_string'][] = 'Wajib mengisi Gaji Pokok';
  //           $data['status'] = FALSE;
		// }

		// if ($this->input->post('gaperjam') == '') {
		// 	$data['inputerror'][] = 'gaperjam';
  //           $data['error_string'][] = 'Wajib mengisi Gaji per jam';
  //           $data['status'] = FALSE;
		// }

		// if ($this->input->post('tunjangan') == '') {
		// 	$data['inputerror'][] = 'tunjangan';
  //           $data['error_string'][] = 'Wajib mengisi Gaji Tunjangan';
  //           $data['status'] = FALSE;
		// }

		if ($this->input->post('tipepeg') == '') {
			$data['inputerror'][] = 'tipepeg';
            $data['error_string'][] = 'Wajib mengisi Tipe Pegawai';
            $data['status'] = FALSE;
		}
			
        return $data;
	}
}
