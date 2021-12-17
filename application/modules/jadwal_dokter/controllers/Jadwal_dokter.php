<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_dokter extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') === null) {
			return redirect('login');
		}

		$this->load->model('m_user');
		// $this->load->model('m_jadwal_dokter');
		$this->load->model('m_global');
		$this->load->model('Globalmodel', 'modeldb'); 
	}

	public function index()
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
		$data_jabatan = $this->m_global->multi_row('*', 'deleted_at is null', 'm_jabatan', null, 'nama');
				
		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			// 'title' => 'Jadwal Praktek Dokter',
			'data_user' => $data_user,
			'data_jabatan'	=> $data_jabatan
		);

		$select = "log.*, peg.nama";
		$where = ['peg.id_jabatan' => 1];
		$table = 't_log_jadwal_dokter as log';
		$join = [ 
			['table' => 'm_pegawai as peg', 'on' => 'log.id_dokter = peg.id']
		];
		$data_calendar = $this->m_global->multi_row($select,$where,$table, $join);
		// $data_calendar = $this->m_global->getSelectedData('t_log_jadwal_dokter', null)->result();
		$calendar = array();
		foreach ($data_calendar as $key => $val) 
		{
			$calendar[] = array(
				'id' 	=> intval($val->id), 
				'title' => $val->nama, 
				'description' => trim($val->id_klinik), 
				'start' => date_format( date_create($val->tanggal) ,"Y-m-d H:i:s"),
				'end' 	=> date_format( date_create($val->tanggal) ,"Y-m-d H:i:s"),
				'color' => $val->color,
			);
		}

		$data = array();
		$data['get_data']			= json_encode($calendar);
		$data['dokter']             = $this->m_global->getSelectedData('m_pegawai', ['id_jabatan' => 1])->result();
		// var_dump($data['get_data']); die();
		/**
		 * content data untuk template
		 * param (css : link css pada direktori assets/css_module)
		 * param (modal : modal komponen pada modules/nama_modul/views/nama_modal)
		 * param (js : link js pada direktori assets/js_module)
		 */
		$content = [
			'css' 	=> null,
			'modal' => '',
			'js'	=> 'jadwal_dokter.js',
			'view'	=> 'view_jadwal_dokter'
		];

		$this->template_view->load_view($content, $data);
	}

	public function save()
	{
		$obj_date = new DateTime();
		$response = array();
		$this->form_validation->set_rules('id_dokter', 'Dokter Harap Diisi ! ', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal Harap Diisi ! ', 'required');
		$this->form_validation->set_rules('jam_mulai', 'Jam Mulai Harap Diisi ! ', 'required');
		$this->form_validation->set_rules('jam_akhir', 'Jam AKhir Harap Diisi ! ', 'required');
		if ($this->form_validation->run() == TRUE)
		{
			$param = $this->input->post();
			$calendar_id = $param['calendar_id'];
			$start = $this->input->post('tanggal');
			$id_dokter = $this->input->post('id_dokter');
			$dokter = $this->m_global->getSelectedData('m_pegawai', ['id' => $id_dokter])->row();
			$id_klinik = $this->input->post('id_klinik');
			$param['tanggal'] = $obj_date->createFromFormat('d/m/Y', $start)->format('Y-m-d'); 
			unset($param['calendar_id'],);
			if($calendar_id == 0)
			{
				$param['create_at']   	= date('Y-m-d H:i:s');
				$insert = $this->modeldb->insert('t_log_jadwal_dokter', $param);

				if ($insert > 0) 
				{
					$response['status'] = TRUE;
					$response['notif']	= 'Success add calendar';
					$response['id']		= $insert;
					$response['tanggal'] = $param['tanggal'];
					$response['id_dokter'] = $dokter->nama;
					$response['id_klinik'] = $id_klinik;
				}
				else
				{
					$response['status'] = FALSE;
					$response['notif']	= 'Server wrong, please save again';
				}
			}
			else
			{	
				$where 		= [ 'id'  => $calendar_id];
				$param['modified_at']   	= date('Y-m-d H:i:s');
				$update = $this->modeldb->update('t_log_jadwal_dokter', $param, $where);

				if ($update > 0) 
				{
					$response['status'] = TRUE;
					$response['notif']	= 'Success add calendar';
					$response['id']		= $calendar_id;
					$response['tanggal'] = $param['tanggal'];
					$response['id_dokter'] = $id_dokter;
					$response['id_klinik'] = $id_klinik;
				}
				else
				{
					$response['status'] = FALSE;
					$response['notif']	= 'Server wrong, please save again';
				}

			}
		}
		else
		{
			$response['status'] = FALSE;
			$response['notif']	= validation_errors();
		}

		echo json_encode($response);
	}

	public function delete()
	{
		$response 		= array();
		$calendar_id 	= $this->input->post('id');
		if(!empty($calendar_id))
		{
			$where = ['id' => $calendar_id];
			$delete = $this->modeldb->delete('t_log_jadwal_dokter', $where);

			if ($delete > 0) 
			{
				$response['status'] = TRUE;
				$response['notif']	= 'Success delete calendar';
			}
			else
			{
				$response['status'] = FALSE;
				$response['notif']	= 'Server wrong, please save again';
			}
		}
		else
		{
			$response['status'] = FALSE;
			$response['notif']	= 'Data not found';
		}

		echo json_encode($response);
	}


}
