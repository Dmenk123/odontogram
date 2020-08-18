<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_satuan extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		//profil data
		$this->load->model('profil/mod_profil','prof');
		$this->load->model('mod_satuan','m_sat');
	}

	public function index()
	{	
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->prof->get_detail_pengguna($id_user);

		$data = array(
			'data_user' => $data_user
		);

		$content = [
			'css' 	=> 'cssMasterSatuan',
			'modal' => 'modalMasterSatuan',
			'js'	=> 'jsMasterSatuan',
			'view'	=> 'view_list_master_satuan'
		];

		$this->template_view->load_view($content, $data);
	}

	public function list_satuan()
	{
		$list = $this->m_sat->get_datatables();
		$data = array();
		$no =$_POST['start'];
		foreach ($list as $sat) {
			$no++;
			$row = array();
			//loop value tabel db
			$row[] = $no;
			$row[] = $sat->nama;
			$row[] = $sat->keterangan;

			//add html for action
			$row[] = '
					<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_satuan('."'".$sat->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_satuan('."'".$sat->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
			';

			$data[] = $row;
		}//end loop

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_sat->count_all(),
			"recordsFiltered" => $this->m_sat->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function add()
	{
		//validasi
		$arr_valid = $this->_validate();
		$nama = trim(strtoupper($this->input->post('nama')));
		$keterangan = trim($this->input->post('keterangan'));
		
		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}

		//for table tbl_user
		$data = array(
			'nama' => $nama,
			'keterangan' => $keterangan
		);

		$insert = $this->m_sat->save($data);
		echo json_encode(array(
			"status" => TRUE,
			"pesan" => 'Master Satuan Berhasil ditambahkan',
		));
	}

	public function edit($id)
	{
		$data = $this->m_sat->get_by_id($id);		
		echo json_encode($data);
	}

	public function update()
	{
		$arr_valid = $this->_validate();
		$nama = trim(strtoupper($this->input->post('nama')));
		$keterangan = trim($this->input->post('keterangan'));

		$data = array(
			'nama' => $nama,
			'keterangan' => $keterangan		
		);

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}

		$this->m_sat->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array(
			"status" => TRUE,
			"pesan" => 'Master Satuan Berhasil diupdate',
		));
	}

	public function delete($id)
	{
		// $this->m_sat->delete_by_id($id);
		$this->m_sat->update(['id' => $id], ['is_aktif '=> 0]);
		echo json_encode(array(
			"status" => TRUE,
			"pesan" => 'Data Master Satuan Berhasil dihapus',
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
            $data['error_string'][] = 'Wajib mengisi nama';
            $data['status'] = FALSE;
		}
		if($this->input->post('keterangan') == '')
        {
            $data['inputerror'][] = 'keterangan';
            $data['error_string'][] = 'Wajib mengisi Keterangan';
            $data['status'] = FALSE;
        }
	
        return $data;
	}
}
