<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slip_gaji extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//profil data
		$this->load->model('profil/mod_profil','prof');
		$this->load->model('mod_slip_gaji','lap');
	}

	public function index()
	{
		$id_user = $this->session->userdata('id_user'); 
		if ($this->session->userdata('id_level_user') != '5') {
			$data_user = $this->prof->get_detail_pengguna($id_user);
		}else{
			$data_user = $this->prof->get_detail_pegawai($id_user);
		}

		$data = array(
			'data_user' => $data_user,
			'arr_bulan' => $this->bulan_indo()
		);

		$content = [
			'css' 	=> 'cssSlipGaji',
			'modal' => null,
			'js'	=> 'jsSlipGaji',
			'view'	=> 'view_slip_gaji'
		];

		$this->template_view->load_view($content, $data);
	}

	public function slip_gaji_detail()
	{
		$id_user = $this->session->userdata('id_user'); 
		if ($this->session->userdata('id_level_user') != '5') {
			$data_user = $this->prof->get_detail_pengguna($id_user);
		}else{
			$data_user = $this->prof->get_detail_pegawai($id_user);
		}

		$bulan = $this->input->get('bulan');
		$tahun = $this->input->get('tahun');
		
		//menghilangkan string 0 pada bulan
		$arr_pecah_bulan = $this->hilangakan_stringkosong_bulan($bulan, $tahun);
		$bulan_awal_fix = $arr_pecah_bulan['tanggal_awal'];
		$bulan_fix = (int)date('m', strtotime($bulan_awal_fix));
		
		//cari periode untuk tampilan pada laporan
		$arr_bln_indo = $this->bulan_indo();
		$periode = $arr_bln_indo[$bulan_fix].' '.$tahun;
				
		if ($this->session->userdata('id_level_user') != '5') {
			$query = $this->lap->get_detail($bulan_fix, $tahun);
		}else{
			$query = $this->lap->get_detail($bulan_fix, $tahun, $id_user);
		}
		$data = array(
			'data_user' => $data_user,
			'arr_bulan' => $this->bulan_indo(),
			'hasil_data' => $query,
			'periode' => $periode,
			'bulan' => $bulan_fix,
			'tahun' => $tahun
		);

		$content = [
			'css' 	=> 'cssSlipGaji',
			'modal' => null,
			'js'	=> 'jsSlipGaji',
			'view'	=> 'view_slip_gaji_detail'
		];

		$this->template_view->load_view($content, $data);
	}

	public function slip_gaji_cetak($id)
	{
		$this->load->library('Pdf_gen');
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->prof->get_detail_pengguna($id_user);

		$hasil_data = $this->lap->get_by_id($id);

		//cari periode untuk tampilan pada laporan
		$arr_bln_indo = $this->bulan_indo();
		$periode = $arr_bln_indo[$hasil_data['bulan']].' '.$hasil_data['tahun'];

		$data = array(
			'title' => 'SMP Darul Ulum Surabaya',
			'data_user' => $data_user,
			'hasil_data' => $hasil_data,
			'arr_bulan' => $this->bulan_indo(),
			'arr_hari' => $this->hari_indo(),
			'periode' => $periode,
			'bulan' => $hasil_data['bulan'],
			'tahun' => $hasil_data['tahun']
		);

	    $html = $this->load->view('view_slip_gaji_cetak', $data, true);
	    
	    $filename = 'slip_gaji_'.time();
	    $this->pdf_gen->generate($html, $filename, true, 'A4', 'portrait');

		// $content = [
		// 	'css' 	=> 'cssSlipGaji',
		// 	'modal' => null,
		// 	'js'	=> 'jsSlipGaji',
		// 	'view'	=> 'view_slip_gaji_cetak'
		// ];

	 //    $this->template_view->load_view($content, $data);
	}

	public function bulan_indo()
	{
		return [
			1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
		];
	}

	public function hari_indo()
	{
		return [
			0 => 'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'
		];
	}

	public function pecah_bulan($tgl_awal, $tgl_akhir)
	{

		$date1  = $tgl_awal;
		$date2  = $tgl_akhir;
		$output = [];
		$time   = strtotime($date1);
		$last   = date('m-Y', strtotime($date2));

		do {
			$month_raw = date('m', $time);
		    $month = date('m-Y', $time);
		    $total = date('t', $time);

		    $arr = explode("-",$month);
		    $tahun_bulan = $arr[1].'-'.$arr[0];
			$tahun = $arr[1];
			
		    $output[] = [
				'month_raw' => $month_raw,
				'year_raw' => $tahun,
		        'month' => $tahun_bulan,
		        'total' => $total,
		    ];

		    $time = strtotime('+1 month', $time);
		} while ($month != $last);


		return $output;
	}

	public function hilangakan_stringkosong_bulan($bln, $tahun)
	{
		$bulan = ($bln < 10) ? '0'.$bln : $bln;
		$tanggal_awal = date('Y-m-d', strtotime($tahun.'-'.$bulan.'-01'));
		$tanggal_akhir = date('Y-m-t', strtotime($tahun.'-'.$bulan.'-01'));
		return [
			'tanggal_awal' => $tanggal_awal,
			'tanggal_akhir' => $tanggal_akhir,	
		];
	}

}
