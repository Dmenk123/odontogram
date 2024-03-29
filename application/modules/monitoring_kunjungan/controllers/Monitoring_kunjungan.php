<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class Monitoring_kunjungan extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') === false) {
			return redirect('login');
		}
		
		$this->load->model('m_user');
		$this->load->model('m_global');
		$this->load->library('Enkripsi');
		
	}

	public function index()
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);		
	

		$data = array(
			'title' => 'Monitoring Kunjungan Klinik',
			'data_user' => $data_user,
		);

		/* if($this->session->userdata('id_klinik') == null) {
			// administrator
			$where = ['a.deleted_at' => null, 'b.id_jabatan' => 1, 'a.id_role !=' => 1];
		}else{
			//admin
			$where = ['a.deleted_at' => null, 'b.id_jabatan' => 1, 'a.id' => $id_user];
		}

		$join = [ 
			[
				'table' => 'm_pegawai as b',
				'on'	=> 'a.id_pegawai = b.id'
			],
		];
		
		$data['dokter'] = $this->m_global->multi_row('a.*, b.nama as nama_pegawai, b.kode as kode_pegawai',$where, 'm_user a', $join, 'b.nama'); */

		
		/**
		 * content data untuk template
		 * param (css : link css pada direktori assets/css_module)
		 * param (modal : modal komponen pada modules/nama_modul/views/nama_modal)
		 * param (js : link js pada direktori assets/js_module)
		 */
		$content = [
			'css' 	=> null,
			'modal' => null,
			'js'	=> 'monitoring_kunjungan.js',
			'view'	=> 'view_monitoring'
		];

		$this->template_view->load_view($content, $data);
	}

	public function datatable_monitoring()
	{
		$id_dokter = $this->input->post('id_dokter');
		$start     = $this->input->post('start');
		$end 	   = $this->input->post('end'); 
		
		if ($start) {
			$start = Carbon::createFromFormat('d/m/Y', $start)->format('Y-m-d'); 
		}

		if ($end) {
			$end = Carbon::createFromFormat('d/m/Y', $end)->format('Y-m-d');
		}
		// var_dump($end); die();

		$select = "reg.no_reg, reg.tanggal_reg, reg.jam_reg, m_klinik.nama_klinik, m_klinik.alamat, m_pasien.no_rm, m_pasien.nama as nama_pasien, peg.nama as nama_dokter, m_pasien.created_at as tgl_buat_pasien";
		
		if ($this->session->userdata('id_role') != '1') {
			$where = ['reg.deleted_at' => null, 'reg.id_klinik' => $this->session->userdata('id_klinik'), 'reg.tanggal_reg >=' => $start, 'reg.tanggal_reg <= ' => $end];
		} else {
			$where = ['reg.deleted_at' => null, 'reg.tanggal_reg >=' => $start, 'reg.tanggal_reg <= ' => $end];
		}

		$table = 't_registrasi as reg';
		$join = [ 
			[
				'table' => 'm_klinik',
				'on'	=> 'reg.id_klinik = m_klinik.id and m_klinik.deleted_at is null'
			],
			[
				'table' => 'm_pasien',
				'on'	=> 'reg.id_pasien = m_pasien.id and m_pasien.deleted_at is null'
			],
			[
				'table' => 'm_pegawai peg',
				'on'	=> 'reg.id_pegawai = peg.id and peg.deleted_at is null'
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
				$data[$key][] = Carbon::parse($value->tanggal_reg)->format('d-m-Y');
				$data[$key][] = $value->nama_klinik;
				$data[$key][] = $value->nama_pasien;
				$data[$key][] = $value->no_rm;   
				$data[$key][] = $value->nama_dokter;

				if(strtotime(Carbon::parse($value->tgl_buat_pasien)->format('Y-m-d')) >= strtotime($value->tanggal_reg)) {
					$data[$key][] = '<span style="color:green;font-weight:bold;">Pasien Baru</span>';
				}else{
					$data[$key][] = 'Pasien Lama';
				}
			}
		}
		
		// $this->output->enable_profiler(TRUE);

        echo json_encode([
            'data' => $data
        ]);
	}

	// ===============================================
	
	private function seoUrl($string) {
	    //Lower case everything
	    $string = strtolower($string);
	    //Make alphanumeric (removes all other characters)
	    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
	    //Clean up multiple dashes or whitespaces
	    $string = preg_replace("/[\s-]+/", " ", $string);
	    //Convert whitespaces and underscore to dash
	    $string = preg_replace("/[\s_]/", "-", $string);
	    return $string;
	}

	public function monitoring_chart()
	{
		$id_user = $this->session->userdata('id_user');
		// $user_klinik =  $this->m_global->multi_row('*', ['id_user' => $id_user], 't_user_klinik');
		// $data_dokter = $this->m_global->single_row('*', ['id' => $id_dokter], 'm_pegawai');
		// $data_user = $this->m_global->single_row('*', ['id_pegawai' => $data_dokter->id, 'deleted_at' => null, 'id_role != ' => 1], 'm_user');

		$start = $this->input->post('start');
		$end = $this->input->post('end');
		if ($start) {
			$start = Carbon::createFromFormat('d/m/Y', $start)->format('Y-m-d'); 
		}

		if ($end) {
			$end = Carbon::createFromFormat('d/m/Y', $end)->format('Y-m-d');
		}

		$period = CarbonPeriod::create($start, $end);
		foreach ($period as $date) {
			$dates[] = $date->format('Y-m-d');
		}
		
		if($this->session->userdata('id_role') != '1') {
			$data_klinik = $this->db->query("
				SELECT 
					m_klinik.nama_klinik, m_klinik.id
				FROM t_user_klinik 
				LEFT JOIN m_klinik on t_user_klinik.id_klinik = m_klinik.id
				WHERE t_user_klinik.id_user = '$id_user'")
			->result();
		}else{
			$data_klinik = $this->m_global->multi_row('*', ['deleted_at' => null], 'm_klinik');
		}

		$dataset = [];
		$data_label_x = [];
		$min = 0;
		$arr_max = [];
		foreach ($data_klinik as $key => $value) {
			$total_temp = [];
			$dataset[$key]['label'] = $value->nama_klinik;
			$dataset[$key]['backgroundColor'] = "#".$this->random_color();
			$dataset[$key]['fill'] = true;
			
			/* if ($this->session->userdata('id_role') != '1') {
				$where = "reg.tanggal_reg BETWEEN '$start' AND '$end' AND reg.id_klinik = '$value->id_klinik'";
			}else{
				$where = "reg.tanggal_reg BETWEEN '$start' AND '$end'";
			} */

			$q = $this->db->query("
				SELECT
					count(reg.id) as jml_kunjungan,
					reg.tanggal_reg,
					m_klinik.nama_klinik,
					m_klinik.alamat
				FROM
					t_registrasi AS reg 
					LEFT JOIN m_klinik ON reg.id_klinik = m_klinik.id AND m_klinik.deleted_at IS NULL 
				WHERE 
					reg.tanggal_reg BETWEEN '$start' AND '$end' AND reg.id_klinik = '$value->id'	 
				GROUP BY
					m_klinik.nama_klinik, reg.tanggal_reg
				ORDER BY tanggal_reg
			")->result();

			foreach ($q as $k => $v) {
				foreach ($dates as $dk => $dv) {
					if($v->tanggal_reg != $dv) {
						### pengecekan by key, agar tidak di replace
						if (array_key_exists($dk,$total_temp)){
							continue;
						}

						$arr_max[] = 0;
						$total_temp[$dk] = 0;
					}else{
						$arr_max[] = (int)$v->jml_kunjungan;
						$total_temp[$dk] = (int)$v->jml_kunjungan;
					}
				}				
			}
			
			$dataset[$key]['data'] = $total_temp;
		}

		rsort($arr_max);
			
		$data['label'] = $dates;
		$data['datasets'] = $dataset;
		$data['status'] = true;
		$data['v_min'] = $min;
		$data['v_max'] = $arr_max[0];
		$data['judul'] = "Grafik Kunjungan per Klinik";

		echo json_encode($data);
		
	}

	function random_color(){
		mt_srand((double)microtime()*1000000);
		$c = '';
		while(strlen($c)<6){
		  $c .= sprintf("%02X", mt_rand(0, 255));
		}
		return $c;
	}

	public function get_barang()
	{
		$id = $this->input->post('id_pelanggan');
		$barang = $this->m_pelanggan->get_barang($id);
		echo json_encode($barang);
	}
}
