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

		$data_calendar = $this->m_global->getSelectedData('calendar', null)->result();
		$calendar = array();
		foreach ($data_calendar as $key => $val) 
		{
			$calendar[] = array(
				'id' 	=> intval($val->id), 
				'title' => $val->title, 
				'description' => trim($val->description), 
				'start' => date_format( date_create($val->start_date) ,"Y-m-d H:i:s"),
				'end' 	=> date_format( date_create($val->end_date) ,"Y-m-d H:i:s"),
				'color' => $val->color,
			);
		}

		$data = array();
		$data['get_data']			= json_encode($calendar);
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
		$response = array();
		$this->form_validation->set_rules('title', 'Title cant be empty ', 'required');
		if ($this->form_validation->run() == TRUE)
		{
			$param = $this->input->post();
			$calendar_id = $param['calendar_id'];
			unset($param['calendar_id']);

			if($calendar_id == 0)
			{
				$param['create_at']   	= date('Y-m-d H:i:s');
				$insert = $this->modeldb->insert($this->table, $param);

				if ($insert > 0) 
				{
					$response['status'] = TRUE;
					$response['notif']	= 'Success add calendar';
					$response['id']		= $insert;
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
				$update = $this->modeldb->update($this->table, $param, $where);

				if ($update > 0) 
				{
					$response['status'] = TRUE;
					$response['notif']	= 'Success add calendar';
					$response['id']		= $calendar_id;
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
			$delete = $this->modeldb->delete($this->table, $where);

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
