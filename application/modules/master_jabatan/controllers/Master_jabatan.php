<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_jabatan extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		//profil data
		$this->load->model('profil/mod_profil','prof');
		$this->load->model('mod_jabatan','m_jbtn');
	}

	public function index()
	{	
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->prof->get_detail_pengguna($id_user);

		$data = array(
			'data_user' => $data_user
		);

		$content = [
			'css' 	=> 'cssMasterJabatan',
			'modal' => 'modalMasterJabatan',
			'js'	=> 'jsMasterJabatan',
			'view'	=> 'view_list_master_jabatan'
		];

		$this->template_view->load_view($content, $data);
	}

	public function list_jabatan()
	{
		$list = $this->m_jbtn->get_datatables();
		$data = array();
		$no =$_POST['start'];
		foreach ($list as $sat) {
			$no++;
			$row = array();
			//loop value tabel db
			$row[] = $no;
			$row[] = $sat->nama;
			$row[] = '
				<div>
	                <span class="pull-left">Rp. </span>
	                  <span class="pull-right">'.number_format($sat->tunjangan,2,",",".").'</span>
	             </div>
			';

			//add html for action
			$row[] = '
					<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_jabatan('."'".$sat->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_jabatan('."'".$sat->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
			';

			$data[] = $row;
		}//end loop

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_jbtn->count_all(),
			"recordsFiltered" => $this->m_jbtn->count_filtered(),
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
		$tunjangan = trim($this->input->post('tunjangan_raw'));
		
		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}

		$data = array(
			'nama' => $nama,
			'tunjangan' => $tunjangan
		);

		$insert = $this->m_jbtn->save($data);
		echo json_encode(array(
			"status" => TRUE,
			"pesan" => 'Master Jabatan Berhasil ditambahkan',
		));
	}

	public function edit($id)
	{
		$data = $this->m_jbtn->get_by_id($id);		
		echo json_encode($data);
	}

	public function update()
	{
		$arr_valid = $this->_validate();
		$nama = trim(strtoupper($this->input->post('nama')));
		$tunjangan = trim($this->input->post('tunjangan_raw'));

		$data = array(
			'nama' => $nama,
			'tunjangan' => $tunjangan		
		);

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}

		$this->m_jbtn->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array(
			"status" => TRUE,
			"pesan" => 'Master Tunjangan Berhasil diupdate',
		));
	}

	public function delete($id)
	{
		// $this->m_jbtn->delete_by_id($id);
		$this->m_jbtn->update(['id' => $id], ['is_aktif '=> 0]);
		echo json_encode(array(
			"status" => TRUE,
			"pesan" => 'Data Master Jabatan Berhasil dihapus',
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
			
        return $data;
	}
}
