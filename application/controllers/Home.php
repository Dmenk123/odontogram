<?php

use Carbon\Carbon;
use Carbon\CarbonPeriod;
//defined('BASEPATH ') OR exit('No direct script access allowed');
define('ROLE_DEVELOPER','1');
define('ROLE_ADMINISTRATOR','2');
define('ROLE_ADMIN', '3');
define('DOKTER', '4');
define('PERIOD_CHART', 7);

class Home extends CI_Controller {
	protected $prop_id_role;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('dashboard/m_dashboard');
		$this->load->model('m_user');

		if($this->session->userdata('logged_in') === null) {
			return redirect('login');
		}

		if ($this->session->userdata('id_role') === null) {
			return redirect('login');
		}
		
		$this->prop_id_role = $this->session->userdata('id_role');
		
	}

	public function index()
	{	
		$tahun = date('Y');
		$bulan = date('m');
		$hari = date('d');
		$id_user = $this->session->userdata('id_user');
		$data_user = $this->m_user->get_detail_user($id_user);
		$data_dashboard = [];
		
		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Dashboard Aplikasi',
			'data_user' => $data_user
		);

		/**
		 * content data untuk template
		 * param (css : link css pada direktori assets/css_module)
		 * param (modal : modal komponen pada modules/nama_modul/views/nama_modal)
		 * param (js : link js pada direktori assets/js_module)
		 */
		$content = [
			'css' 	=> null,
			'modal' => null,
		];

		switch ((int)$this->prop_id_role) {
			case ROLE_DEVELOPER:
				$content['view'] = 'dashboard/view_dashboard_owner';
				$content['js'] = 'dashboard_owner.js';
				break;
				
			case ROLE_ADMINISTRATOR:
				$content['view'] = 'dashboard/view_dashboard_owner';
				$content['js'] = 'dashboard_owner.js';
				break;

			case ROLE_ADMIN:
				$content['view'] = 'dashboard/view_dashboard';
				$content['js'] = null;
				break;

			case DOKTER:
				$content['view'] = 'dashboard/view_dashboard';
				$content['js'] = null;
				break;
			
			default:
				$content['view'] = 'dashboard/view_dashboard';
				$content['js'] = null;
				break;
		}
		
		$this->template_view->load_view($content, $data);
	}


	public function oops()
	{	
		$this->load->view('login/view_404');
	}

	public function bulan_indo($bulan)
	{
		$arr_bulan =  [
			1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
		];

		return $arr_bulan[(int) $bulan];
	}

	public function kirim(){
		$this->load->library('Api_wa');
		$wa = new Api_wa;
		$hasil = $wa->send();
	}

	public function chart_kunjungan()
	{
		$id_user = $this->session->userdata('id_user');
		// $user_klinik =  $this->m_global->multi_row('*', ['id_user' => $id_user], 't_user_klinik');
		// $data_dokter = $this->m_global->single_row('*', ['id' => $id_dokter], 'm_pegawai');
		// $data_user = $this->m_global->single_row('*', ['id_pegawai' => $data_dokter->id, 'deleted_at' => null, 'id_role != ' => 1], 'm_user');

		$start = Carbon::now()->subDays(PERIOD_CHART)->format('Y-m-d');		
		$end = Carbon::now()->format('Y-m-d');

		$period = CarbonPeriod::create($start, $end);
		foreach ($period as $date) {
			$dates[] = $date->format('Y-m-d');
		}

		if ($this->session->userdata('id_role') != '1') {
			$data_klinik = $this->db->query("
				SELECT 
					m_klinik.nama_klinik, m_klinik.id
				FROM t_user_klinik 
				LEFT JOIN m_klinik on t_user_klinik.id_klinik = m_klinik.id
				WHERE t_user_klinik.id_user = '$id_user'")
			->result();
		} else {
			$data_klinik = $this->m_global->multi_row('*', ['deleted_at' => null], 'm_klinik');
		}

		$dataset = [];
		$data_label_x = [];
		$min = 0;
		$arr_max = [];
		// set default value
		$arr_max[] = 0;
		foreach ($data_klinik as $key => $value) {
			$total_temp = [];
			$dataset[$key]['label'] = $value->nama_klinik;
			// $dataset[$key]['backgroundColor'] = "#" . $this->random_color();
			$dataset[$key]['borderColor'] = "#" . $this->random_color();
			$dataset[$key]['fill'] = false;

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
					if ($v->tanggal_reg != $dv) {
						### pengecekan by key, agar tidak di replace
						if (array_key_exists($dk, $total_temp)) {
							continue;
						}

						$arr_max[] = 0;
						$total_temp[$dk] = 0;
					} else {
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
		$data['judul'] = "Grafik Kunjungan per Klinik (Last ".PERIOD_CHART." days)";

		echo json_encode($data);
	}

	public function chart_omset()
	{
		$id_user = $this->session->userdata('id_user');
		// $user_klinik =  $this->m_global->multi_row('*', ['id_user' => $id_user], 't_user_klinik');
		// $data_dokter = $this->m_global->single_row('*', ['id' => $id_dokter], 'm_pegawai');
		// $data_user = $this->m_global->single_row('*', ['id_pegawai' => $data_dokter->id, 'deleted_at' => null, 'id_role != ' => 1], 'm_user');

		$start = Carbon::now()->subDays(PERIOD_CHART)->format('Y-m-d');
		$end = Carbon::now()->format('Y-m-d');

		$period = CarbonPeriod::create($start, $end);
		foreach ($period as $date) {
			$dates[] = $date->format('Y-m-d');
		}

		if ($this->session->userdata('id_role') != '1') {
			$data_klinik = $this->db->query("
				SELECT 
					m_klinik.nama_klinik, m_klinik.id
				FROM t_user_klinik 
				LEFT JOIN m_klinik on t_user_klinik.id_klinik = m_klinik.id
				WHERE t_user_klinik.id_user = '$id_user'")
			->result();
		} else {
			$data_klinik = $this->m_global->multi_row('*', ['deleted_at' => null], 'm_klinik');
		}

		$dataset = [];
		$data_label_x = [];
		$min = 0;
		$arr_max = [];
		// set default value
		$arr_max[] = 0;
		foreach ($data_klinik as $key => $value) {
			$total_temp = [];
			$dataset[$key]['label'] = $value->nama_klinik;
			// $dataset[$key]['backgroundColor'] = "#" . $this->random_color();
			$dataset[$key]['borderColor'] = "#" . $this->random_color();
			$dataset[$key]['fill'] = false;

			/* if ($this->session->userdata('id_role') != '1') {
				$where = "reg.tanggal_reg BETWEEN '$start' AND '$end' AND reg.id_klinik = '$value->id_klinik'";
			}else{
				$where = "reg.tanggal_reg BETWEEN '$start' AND '$end'";
			} */

			$q = $this->db->query("
				SELECT
					sum(t_mutasi.total_penerimaan_gross) as total_omset,
					reg.tanggal_reg,
					m_klinik.nama_klinik,
					m_klinik.alamat
				FROM
					t_registrasi AS reg 
					LEFT JOIN m_klinik ON reg.id_klinik = m_klinik.id AND m_klinik.deleted_at IS NULL 
					LEFT JOIN t_mutasi ON reg.id = t_mutasi.id_registrasi AND t_mutasi.deleted_at IS NULL 
				WHERE 
					reg.tanggal_reg BETWEEN '$start' AND '$end' AND reg.id_klinik = '$value->id'	 
				GROUP BY
					m_klinik.nama_klinik, reg.tanggal_reg
				ORDER BY tanggal_reg
			")->result();

			foreach ($q as $k => $v) {
				foreach ($dates as $dk => $dv) {
					if ($v->tanggal_reg != $dv) {
						### pengecekan by key, agar tidak di replace
						if (array_key_exists($dk, $total_temp)) {
							continue;
						}

						$arr_max[] = 0;
						$total_temp[$dk] = 0;
					} else {
						$arr_max[] = (int)$v->total_omset;
						$total_temp[$dk] = (int)$v->total_omset;
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
		$data['judul'] = "Grafik Omset per Klinik (Last ".PERIOD_CHART." days)";

		echo json_encode($data);
	}

	public function chart_honor_dokter()
	{
		$id_user = $this->session->userdata('id_user');
		// $user_klinik =  $this->m_global->multi_row('*', ['id_user' => $id_user], 't_user_klinik');
		// $data_dokter = $this->m_global->single_row('*', ['id' => $id_dokter], 'm_pegawai');
		// $data_user = $this->m_global->single_row('*', ['id_pegawai' => $data_dokter->id, 'deleted_at' => null, 'id_role != ' => 1], 'm_user');

		$start = Carbon::now()->subDays(PERIOD_CHART)->format('Y-m-d');
		$end = Carbon::now()->format('Y-m-d');

		$period = CarbonPeriod::create($start, $end);
		foreach ($period as $date) {
			$dates[] = $date->format('Y-m-d');
		}

		
		$data_dokter = $this->db->query("SELECT * from m_pegawai where id_jabatan = 1 and is_aktif = 1 and deleted_at is null and is_owner is null order by nama")->result();
		
		$dataset = [];
		$data_label_x = [];
		$min = 0;
		$arr_max = [];
		// set default value
		$arr_max[] = 0;
		foreach ($data_dokter as $key => $value) {
			$total_temp = [];
			$dataset[$key]['label'] = $value->nama;
			// $dataset[$key]['backgroundColor'] = "#" . $this->random_color();
			$dataset[$key]['borderColor'] = "#" . $this->random_color();
			$dataset[$key]['fill'] = false;

			/* if ($this->session->userdata('id_role') != '1') {
				$where = "reg.tanggal_reg BETWEEN '$start' AND '$end' AND reg.id_klinik = '$value->id_klinik'";
			}else{
				$where = "reg.tanggal_reg BETWEEN '$start' AND '$end'";
			} */

			$q = $this->db->query("
				SELECT
					sum(t_mutasi.total_pengeluaran) as total_honor,
					reg.tanggal_reg,
					m_pegawai.nama
				FROM
					t_registrasi AS reg 
					LEFT JOIN m_pegawai ON reg.id_pegawai = m_pegawai.id AND m_pegawai.deleted_at IS NULL AND m_pegawai.is_owner is null
					LEFT JOIN t_mutasi ON reg.id = t_mutasi.id_registrasi AND t_mutasi.deleted_at IS NULL 
				WHERE 
					reg.tanggal_reg BETWEEN '$start' AND '$end' AND reg.id_pegawai = '$value->id'	 
				GROUP BY
					m_pegawai.nama, reg.tanggal_reg
				ORDER BY tanggal_reg
			")->result();

			foreach ($q as $k => $v) {
				foreach ($dates as $dk => $dv) {
					if ($v->tanggal_reg != $dv) {
						### pengecekan by key, agar tidak di replace
						if (array_key_exists($dk, $total_temp)) {
							continue;
						}

						$arr_max[] = 0;
						$total_temp[$dk] = 0;
					} else {
						$arr_max[] = (int)$v->total_honor;
						$total_temp[$dk] = (int)$v->total_honor;
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
		$data['judul'] = "Grafik Honor Dokter Per Tanggal (Last ".PERIOD_CHART." days)";

		echo json_encode($data);
	}





	public function chart_total_kunjungan()
	{
		$id_user = $this->session->userdata('id_user');
		$start = Carbon::now()->subDays(PERIOD_CHART)->format('Y-m-d');
		$end = Carbon::now()->format('Y-m-d');

		$dataset = [];
		$data_label_x = [];
		
		$q = $this->db->query("
			SELECT
				count(reg.id) as jml_kunjungan,
				m_klinik.nama_klinik,
				m_klinik.alamat
			FROM
				t_registrasi AS reg 
				LEFT JOIN m_klinik ON reg.id_klinik = m_klinik.id AND m_klinik.deleted_at IS NULL 
			WHERE 
				reg.tanggal_reg BETWEEN '$start' AND '$end'	 
			GROUP BY
				m_klinik.nama_klinik
			ORDER BY tanggal_reg
		")->result();

		foreach ($q as $k => $v) {
			$total_temp = [];
			$arr_data['label'][$k] = $v->nama_klinik;
			$arr_data['backgroundColor'][$k] = "#" . $this->random_color();
			$arr_data['data'][$k] = (int)$v->jml_kunjungan;
			$data_label_x[$k] = $v->nama_klinik;
		}

		$dataset['label'] = $arr_data['label'];
		$dataset['data'] = $arr_data['data'];
		$dataset['backgroundColor'] = $arr_data['backgroundColor'];
		$dataset['hoverOffset'] = 4;

		$data['labels'] = $data_label_x;
		$data['datasets'] = [$dataset];
		$data['status'] = true;
		// $data['v_min'] = $min;
		// $data['v_max'] = $arr_max[0];
		$data['judul'] = "Total Kunjungan Klinik (Last ".PERIOD_CHART." days)";

		echo json_encode($data);
	}

	public function chart_total_omset()
	{
		$id_user = $this->session->userdata('id_user');
		$start = Carbon::now()->subDays(PERIOD_CHART)->format('Y-m-d');
		$end = Carbon::now()->format('Y-m-d');

		$dataset = [];
		$data_label_x = [];
		
		$q = $this->db->query("
			SELECT
				sum(t_mutasi.total_penerimaan_gross) as total_omset,
				m_klinik.nama_klinik,
				m_klinik.alamat
			FROM
				t_registrasi AS reg 
				LEFT JOIN m_klinik ON reg.id_klinik = m_klinik.id AND m_klinik.deleted_at IS NULL 
				LEFT JOIN t_mutasi ON reg.id = t_mutasi.id_registrasi AND t_mutasi.deleted_at IS NULL 
			WHERE 
				reg.tanggal_reg BETWEEN '$start' AND '$end'	 
			GROUP BY
				m_klinik.nama_klinik
			ORDER BY tanggal_reg
		")->result();

		foreach ($q as $k => $v) {
			$total_temp = [];
			$arr_data['label'][$k] = $v->nama_klinik;
			$arr_data['backgroundColor'][$k] = "#" . $this->random_color();
			$arr_data['data'][$k] = (int)$v->total_omset;
			$data_label_x[$k] = $v->nama_klinik;
		}

		$dataset['label'] = $arr_data['label'];
		$dataset['data'] = $arr_data['data'];
		$dataset['backgroundColor'] = $arr_data['backgroundColor'];
		$dataset['hoverOffset'] = 4;

		$data['labels'] = $data_label_x;
		$data['datasets'] = [$dataset];
		$data['status'] = true;
		// $data['v_min'] = $min;
		// $data['v_max'] = $arr_max[0];
		$data['judul'] = "Total Kunjungan Klinik (Last ".PERIOD_CHART." days)";

		echo json_encode($data);
	}
	
	public function chart_total_honor_dokter()
	{
		$id_user = $this->session->userdata('id_user');
		$start = Carbon::now()->subDays(PERIOD_CHART)->format('Y-m-d');
		$end = Carbon::now()->format('Y-m-d');

		$dataset = [];
		$data_label_x = [];
		
		$q = $this->db->query("
			SELECT
				sum(t_mutasi.total_pengeluaran) as total_honor,
				m_pegawai.nama
			FROM
				t_registrasi AS reg 
				LEFT JOIN m_pegawai ON reg.id_pegawai = m_pegawai.id AND m_pegawai.deleted_at IS NULL AND m_pegawai.is_owner is null
				LEFT JOIN t_mutasi ON reg.id = t_mutasi.id_registrasi AND t_mutasi.deleted_at IS NULL 
			WHERE 
				reg.tanggal_reg BETWEEN '$start' AND '$end'	and m_pegawai.nama is not null
			GROUP BY
				m_pegawai.nama
			ORDER BY tanggal_reg
		")->result();

		foreach ($q as $k => $v) {
			$total_temp = [];
			$arr_data['label'][$k] = $v->nama;
			$arr_data['backgroundColor'][$k] = "#" . $this->random_color();
			$arr_data['data'][$k] = (int)$v->total_honor;
			$data_label_x[$k] = $v->nama;
		}

		$dataset['label'] = $arr_data['label'];
		$dataset['data'] = $arr_data['data'];
		$dataset['backgroundColor'] = $arr_data['backgroundColor'];
		$dataset['hoverOffset'] = 4;

		$data['labels'] = $data_label_x;
		$data['datasets'] = [$dataset];
		$data['status'] = true;
		// $data['v_min'] = $min;
		// $data['v_max'] = $arr_max[0];
		$data['judul'] = "Total Kunjungan Klinik (Last ".PERIOD_CHART." days)";

		echo json_encode($data);
	}

	function random_color()
	{
		mt_srand((float)microtime() * 1000000);
		$c = '';
		while (strlen($c) < 6) {
			$c .= sprintf("%02X", mt_rand(0, 255));
		}
		return $c;
	}

}
