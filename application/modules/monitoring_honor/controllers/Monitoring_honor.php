<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Carbon\Carbon;
class Monitoring_honor extends CI_Controller {
	
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
			'title' => 'Monitoring Honor Dokter',
			'data_user' => $data_user,
		);

		if($this->session->userdata('id_klinik') == null) {
			// administrator
			$where = ['a.deleted_at' => null, 'b.id_jabatan' => 1, 'a.id_role !=' => 1];
		}else{
			//dokter
			$where = ['a.deleted_at' => null, 'b.id_jabatan' => 1, 'a.id' => $id_user];
		}

		$join = [ 
			[
				'table' => 'm_pegawai as b',
				'on'	=> 'a.id_pegawai = b.id'
			],
		];
		
		$data['dokter'] = $this->m_global->multi_row('a.*, b.nama as nama_pegawai, b.kode as kode_pegawai',$where, 'm_user a', $join, 'b.nama');

		
		/**
		 * content data untuk template
		 * param (css : link css pada direktori assets/css_module)
		 * param (modal : modal komponen pada modules/nama_modul/views/nama_modal)
		 * param (js : link js pada direktori assets/js_module)
		 */
		$content = [
			'css' 	=> null,
			'modal' => 'pembayaran/modal_detail',
			'js'	=> 'monitoring_honor.js',
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

		$select = "mut.*, reg.no_reg, reg.tanggal_reg, reg.jam_reg, m_klinik.nama_klinik, m_klinik.alamat, m_pasien.no_rm, m_pasien.nama as nama_pasien, peg.nama as nama_dokter";
		$where = ['mut.id_jenis_trans' => 6, 'mut.deleted_at' => null, 'reg.id_pegawai' => $id_dokter];
		$table = 't_mutasi as mut';
		$join = [ 
			[
				'table' => 't_registrasi as reg',
				'on'	=> 'mut.id_registrasi = reg.id'
			],
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
		// echo $this->db->last_query(); die();
		$data = array();
		$data = [];
		if ($datatable) {
			foreach ($datatable as $key => $value) {
			
				$data[$key][] = $key+1;
				$data[$key][] = Carbon::parse($value->created_at)->format('Y-m-d H:i');
				$data[$key][] = $value->nama_dokter;
				$data[$key][] = $value->nama_klinik;
				$data[$key][] = $value->no_rm;   
				$data[$key][] = number_format($value->total_pengeluaran); 
				$data[$key][] = '
					<button type="button" class="btn btn-sm btn-primary" onclick="detail_trans(\'' . $this->enkripsi->enc_dec('encrypt', $value->id_registrasi) . '\')"> Detail </button>';
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
		$id_dokter = $this->input->post('id_dokter');
		$id_user = $this->session->userdata('id_user');
		
		$data_dokter = $this->m_global->single_row('*', ['id' => $id_dokter], 'm_pegawai');

		$start = $this->input->post('start');
		$end = $this->input->post('end');
		if ($start) {
			$start = Carbon::createFromFormat('d/m/Y', $start)->format('Y-m-d'); 
		}

		if ($end) {
			$end = Carbon::createFromFormat('d/m/Y', $end)->format('Y-m-d');
		}

		$data_klinik = $this->db->query("SELECT 
			t_user_klinik.*,
			m_klinik.nama_klinik,
			FROM t_user_klinik 
			LEFT JOIN m_klinik on t_user_klinik.id_klinik = m_klinik.id
			WHERE t_user_klinik.id_user = '$id_user'")->result();

		$q = $this->db->query("SELECT	
				sum(mut.total_pengeluaran) as total,
				mut.tanggal,
				m_klinik.nama_klinik
			FROM
				t_mutasi AS mut
				LEFT JOIN t_registrasi AS reg ON mut.id_registrasi = reg.id
				LEFT JOIN m_klinik ON reg.id_klinik = m_klinik.id AND m_klinik.deleted_at IS NULL 
			WHERE
				mut.id_jenis_trans = 6 
				AND mut.deleted_at IS NULL 
				AND reg.id_pegawai = '$id_dokter'
			GROUP BY m_klinik.nama_klinik, mut.tanggal, reg.id_pegawai
		")->result_array();

		$data_mentah    = array();
		$data_label = [];
		
		// foreach ($q as $key) {
        //     $data_mentah[$key['nama_klinik']] = $key['total'];
		// 	$data_label[] = $key['tanggal'];
        // }

		$data_mentah   = array();
		foreach ($q as $key) {
		  $data_mentah[$key['nama_klinik']] = $key['total'];
		}

		// echo "<pre>";
		// print_r ($data_mentah);
		// echo "</pre>";

		// echo "<pre>";
		// print_r ($q);
		// echo "</pre>";

		// echo "<pre>";
		// print_r ($data_label);
		// echo "</pre>";
		// exit;

		$label          = $data_label;
		$data['data']   = array();
		$dataset    = array();

		for ($i=0; $i < count($q); $i++) {
			//   if($i==0) {
				$data_grafik[$i] = array();

				$data_grafik[$i]['label'] = $q[$i]['nama_klinik'];
				$data_grafik[$i]['backgroundColor'] = "#".$this->random_color();
				$data_grafik[$i]['fill'] = true;
				$data_grafik[$i]['data'] = [(int)$q[$i]['total']];

			
			// }
		}

		$data['label'] = $label;
		$data['datasets'] = $data_grafik;
		$data['status'] = true;
		$data['judul'] = "Grafik Honor per Dokter, ".$data_dokter->nama;

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
