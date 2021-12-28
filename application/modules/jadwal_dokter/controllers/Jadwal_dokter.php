<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal_dokter extends CI_Controller
{
	protected $id_klinik = null;

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('logged_in') === null) {
			return redirect('login');
		}

		$this->load->model('m_user');
		// $this->load->model('m_jadwal_dokter');
		$this->load->model('m_global');
		$this->load->model('Globalmodel', 'modeldb');

		if ($this->session->userdata('id_klinik') !== null) {
			$this->id_klinik = $this->session->userdata('id_klinik');
		}
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
			'title' => 'Jadwal Praktek Dokter',
			'data_user' => $data_user,
			'data_jabatan'	=> $data_jabatan
		);

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
			'modal' => ['modal_schedule', 'modal_jadwal_rutin'],
			'js'	=> 'jadwal_dokter.js',
			'view'	=> 'view_jadwal_dokter_rutin_nonrutin'
		];

		$this->template_view->load_view($content, $data);
	}

	public function index_backup()
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
		$data_calendar = $this->m_global->multi_row($select, $where, $table, $join);
		// $data_calendar = $this->m_global->getSelectedData('t_log_jadwal_dokter', null)->result();
		$calendar = array();
		foreach ($data_calendar as $key => $val) {
			$calendar[] = array(
				'id' 	=> intval($val->id),
				'title' => $val->nama,
				'description' => trim($val->id_klinik),
				'start' => date_format(date_create($val->tanggal), "Y-m-d H:i:s"),
				'end' 	=> date_format(date_create($val->tanggal), "Y-m-d H:i:s"),
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
			'modal' => 'modal_schedule',
			'js'	=> 'jadwal_dokter.js',
			'view'	=> 'view_jadwal_dokter'
		];

		$this->template_view->load_view($content, $data);
	}

	public function datatable_jadwal_rutin()
	{
		// var_dump($end); die();

		$select = "r.*, p.nama, k.nama_klinik";
		$where = ['r.deleted_at' => null, 'r.id_klinik >=' => $this->session->userdata('id_klinik')];
		$table = 't_jadwal_dokter_rutin as r';
		$join = [ 
			[
				'table' => 'm_pegawai as p',
				'on'	=> 'r.id_dokter = p.id'
			],
			[
				'table' => 'm_klinik as k',
				'on'	=> 'r.id_klinik = k.id'
			],
		];
		
		$datatable = $this->m_global->multi_row($select,$where,$table, $join);
		// echo $this->db->last_query();exit;
		
		// echo $this->db->last_query(); die();
		$data = array();
		$data = [];
		if ($datatable) {
			foreach ($datatable as $key => $value) {
			
				$data[$key][] = $key+1;
				$data[$key][] = $value->nama;
				$data[$key][] = $value->nama_klinik;
				$data[$key][] = $value->hari;
				$data[$key][] = date('H:i', strtotime($value->jam_mulai)).' WIB';   
				$data[$key][] = date('H:i', strtotime($value->jam_akhir)).' WIB'; 

				$data[$key][] = '<button onclick="delete_jadwal_rutin(\''.$value->id.'\')" class="btn btn-danger">
									<i class="la la-trash"></i> Hapus
								</button>';
			}
		}
		
		// $this->output->enable_profiler(TRUE);

        echo json_encode([
            'data' => $data
        ]);
	}

	public function add_jadwal_rutin()
	{
		$this->load->library('Enkripsi');
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$arr_valid = $this->rule_validasi_jadwal_rutin();
		
		$id_dokter = $this->input->post('dokter');
		$hari = $this->input->post('hari');
		$id_klinik = $this->session->userdata('id_klinik');
		$jam_mulai = $this->input->post('jam_mulai');
		$jam_akhir = $this->input->post('jam_akhir');

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}


		$this->db->trans_begin();
		
		$data = [
			'id_dokter' => $id_dokter,
			'id_klinik' => $id_klinik,
			'hari' => $hari,
			'jam_mulai' => $jam_mulai,
			'jam_akhir' => $jam_akhir,
			'created_at' => $timestamp
		];
		
		$insert = $this->m_global->store_id($data, 't_jadwal_dokter_rutin');
		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['pesan'] = 'Gagal menambahkan jadwal praktik dokter';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['pesan'] = 'Sukses menambahkan jadwal praktik dokter';
		}

		echo json_encode($retval);
	}

	private function rule_validasi_jadwal_rutin()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		/* if ($this->input->post('kode') == '') {
			$data['inputerror'][] = 'kode';
            $data['error_string'][] = 'Wajib mengisi Kode Diagnosa';
            $data['status'] = FALSE;
		} */

		if ($this->input->post('dokter') == '') {
			$data['inputerror'][] = 'dokter';
            $data['error_string'][] = 'Wajib memilih Dokter';
            $data['status'] = FALSE;
		}

		if ($this->input->post('hari') == '') {
			$data['inputerror'][] = 'hari';
            $data['error_string'][] = 'Wajib memilih Hari';
            $data['status'] = FALSE;
		}

		if ($this->input->post('jam_mulai') == '') {
			$data['inputerror'][] = 'jam_mulai';
            $data['error_string'][] = 'Wajib mengisi jam mulai praktik';
            $data['status'] = FALSE;
		}

		if ($this->input->post('jam_akhir') == '') {
			$data['inputerror'][] = 'jam_akhir';
            $data['error_string'][] = 'Wajib mengisi jam akhir praktik';
            $data['status'] = FALSE;
		}

	
        return $data;
	}

	public function datatable_jadwal_tidak_rutin()
	{
		// var_dump($end); die();

		$select = "r.*, p.nama, k.nama_klinik";
		$where = ['r.deleted_at' => null, 'r.id_klinik >=' => $this->session->userdata('id_klinik')];
		$table = 't_jadwal_dokter_tidak_rutin as r';
		$join = [ 
			[
				'table' => 'm_pegawai as p',
				'on'	=> 'r.id_dokter = p.id'
			],
			[
				'table' => 'm_klinik as k',
				'on'	=> 'r.id_klinik = k.id'
			],
		];

		$order_by = 'r.id, "DESC"';
		
		$datatable = $this->m_global->multi_row($select,$where,$table, $join, $order_by);
		// echo $this->db->last_query();exit;
		
		// echo $this->db->last_query(); die();
		$data = array();
		$data = [];
		if ($datatable) {
			foreach ($datatable as $key => $value) {
			
				$data[$key][] = $key+1;
				$data[$key][] = $value->nama.'<br>( <span style="color:#34eb3a;">Aktif Praktek</span> )';
				$data[$key][] = $value->nama_klinik;
				$data[$key][] = tanggal_indo($value->tanggal);
				$data[$key][] = date('H:i', strtotime($value->jam_mulai)).' WIB';   
				$data[$key][] = date('H:i', strtotime($value->jam_akhir)).' WIB'; 

				$data[$key][] = '<button onclick="delete_jadwal_tidak_rutin(\''.$value->id.'\')" class="btn btn-danger">
									<i class="la la-trash"></i> Hapus
								</button>';
			}
		}
		
		// $this->output->enable_profiler(TRUE);

        echo json_encode([
            'data' => $data
        ]);
	}

	public function save()
	{

		$obj_date = new DateTime();
		$id_user = $this->session->userdata('id_user');
		$data_user = $this->m_user->get_by_id($id_user);
		$response = array();
		$this->form_validation->set_rules('id_dokter', 'Dokter Harap Diisi ! ', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal Harap Diisi ! ', 'required');
		$this->form_validation->set_rules('jam_mulai', 'Jam Mulai Harap Diisi ! ', 'required');
		$this->form_validation->set_rules('jam_akhir', 'Jam AKhir Harap Diisi ! ', 'required');


		if ($this->id_klinik == null) {
			$response['status'] = FALSE;
			$response['notif']	= '<p style="font-weight:bold;">Mohon Maaf. Hanya Role Admin Klinik yang dapat menyimpan.</p>';
			echo json_encode($response);
			return;
		}

		$id_klinik = $this->id_klinik;

		if ($this->form_validation->run() == TRUE) {
			$param = $this->input->post();
			$calendar_id = $param['calendar_id'];
			$start = $this->input->post('tanggal');
			$id_dokter = $this->input->post('id_dokter');
			$dokter = $this->m_global->getSelectedData('m_pegawai', ['id' => $id_dokter])->row();

			$param['tanggal'] = $obj_date->createFromFormat('d/m/Y', $start)->format('Y-m-d');
			$param['id_klinik'] = $id_klinik;

			unset($param['calendar_id']);

			if ($calendar_id == 0) {
				$param['create_at']   	= date('Y-m-d H:i:s');
				$param['create_by']   	= $data_user->id;
				$insert = $this->modeldb->insert('t_log_jadwal_dokter', $param);

				if ($insert > 0) {
					$response['status'] = TRUE;
					$response['notif']	= 'Success add calendar';
					$response['id']		= $insert;
					$response['tanggal'] = $param['tanggal'];
					$response['id_dokter'] = $dokter->nama;
					$response['id_klinik'] = $id_klinik;
				} else {
					$response['status'] = FALSE;
					$response['notif']	= 'Server wrong, please save again';
				}
			} else {
				$where 		= ['id'  => $calendar_id];
				$param['modified_at']   	= date('Y-m-d H:i:s');
				$param['modified_by']   	= $data_user->id;
				$update = $this->modeldb->update('t_log_jadwal_dokter', $param, $where);

				if ($update > 0) {
					$response['status'] = TRUE;
					$response['notif']	= 'Success add calendar';
					$response['id']		= $calendar_id;
					$response['tanggal'] = $param['tanggal'];
					$response['id_dokter'] = $dokter->nama;
					$response['id_klinik'] = $id_klinik;
				} else {
					$response['status'] = FALSE;
					$response['notif']	= 'Server wrong, please save again';
				}
			}
		} else {
			$response['status'] = FALSE;
			$response['notif']	= validation_errors();
		}

		echo json_encode($response);
	}

	public function delete()
	{
		$response 		= array();
		$calendar_id 	= $this->input->post('id');
		if (!empty($calendar_id)) {
			$where = ['id' => $calendar_id];
			$delete = $this->modeldb->delete('t_log_jadwal_dokter', $where);

			if ($delete > 0) {
				$response['status'] = TRUE;
				$response['notif']	= 'Success delete calendar';
			} else {
				$response['status'] = FALSE;
				$response['notif']	= 'Server wrong, please save again';
			}
		} else {
			$response['status'] = FALSE;
			$response['notif']	= 'Data not found';
		}

		echo json_encode($response);
	}

	public function edit_jadwal()
	{
		$id = $this->input->post('id');
		$this->load->library('Enkripsi');
		$id_user = $this->session->userdata('id_user');
		$data_user = $this->m_user->get_by_id($id_user);

		$oldData = $this->m_global->getSelectedData('t_log_jadwal_dokter', ['id' => $id])->row();

		if (!$oldData) {
			return redirect($this->uri->segment(1));
		}

		$data = array(
			'data_user' => $data_user,
			'old_data'	=> $oldData
		);

		echo json_encode($data);
	}

	public function save_schedule(){
		$from_date ='01-01-2013';
		$to_date ='05-01-2013';
		
		$from_date = new DateTime($from_date);
		$to_date = new DateTime($to_date);
		
		for ($date = $from_date; $date <= $to_date; $date->modify('+1 day')) {
		  echo $date->format('Y-m-d') . "\n";
		}
	}

	public function delete_jadwal_rutin()
	{
		$where = ['id' => $this->input->post('id') ];
		$del = $this->m_global->softdelete($where, 't_jadwal_dokter_rutin');
		if($del) {
			$retval['status'] = TRUE;
			$retval['pesan'] = 'Data Jadwal Praktik Berhasil dihapus';
		}else{
			$retval['status'] = FALSE;
			$retval['pesan'] = 'Data jadwal Praktik Gagal dihapus';
		}

		echo json_encode($retval);
	}
}
