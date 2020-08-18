<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_masuk extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//profil data
		$this->load->model('profil/mod_profil','prof');
		$this->load->model('mod_lap_masuk','lap');
	}

	public function index()
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->prof->get_detail_pengguna($id_user);

		$data = array(
			'data_user' => $data_user,
			'arr_bulan' => $this->bulan_indo()
		);

		$content = [
			'css' 	=> 'cssLapMasuk',
			'modal' => null,
			'js'	=> null,
			'view'	=> 'view_lap_masuk'
		];

		$this->template_view->load_view($content, $data);
	}

	public function laporan_masuk_detail()
	{
		$this->load->library('Pdf_gen');
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->prof->get_detail_pengguna($id_user);

		$bulan = $this->input->get('bulan');
		$tahun = $this->input->get('tahun');
		
		//menghilangkan string 0 pada bulan
		$arr_pecah_bulan = $this->format_bulan_tahun($bulan, $tahun);

		$tanggal_awal = $arr_pecah_bulan['tanggal_awal'];
		$tanggal_akhir = $arr_pecah_bulan['tanggal_akhir'];
		$arrBulanIndo = $this->bulan_indo();
		$txtPeriode = 'Periode '.$arrBulanIndo[(int)$bulan].' '.$tahun;

		//cari periode untuk tampilan pada laporan
		$arr_data = [];

		//get detail laporan jika belum dikunci
		$query = $this->lap->get_detail($tanggal_awal, $tanggal_akhir);
		$no = 0;

		//loop detail laporan dan assign array
		foreach ($query as $key => $val) {
			$no++;
			$arr_data[$key]['no'] = $no;
			$arr_data[$key]['tanggal'] = $val->tanggal;
			$arr_data[$key]['namauser'] = $val->nama_lengkap_user;
			$arr_data[$key]['id_out'] = $val->id_out;
			$arr_data[$key]['harga_satuan'] = $val->harga_satuan;
			$arr_data[$key]['harga_total'] = $val->harga_total;
			$arr_data[$key]['keterangan'] = $val->keterangan;
			$arr_data[$key]['qty'] = $val->qty;
			$arr_data[$key]['nama_satuan'] = $val->nama_satuan; 
		}
				
		$data = array(
			'title' => 'SMP Darul Ulum Surabaya',
			'data_user' => $data_user,
			'arr_bulan' => $this->bulan_indo(),
			'hasil_data' => $arr_data,
			'periode' => $txtPeriode,
			'tahun' => $tahun
		);

	    $html = $this->load->view('view_lap_masuk_cetak', $data, true);
	    
	    $filename = 'laporan_in_'.time();
	    $this->pdf_gen->generate($html, $filename, true, 'A4', 'landscape');
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

	public function format_bulan_tahun($bulan, $tahun)
	{
		$bulan_fix = ($bulan < 10) ? '0'.$bulan : $bulan;
		
		$tanggal_awal = date('Y-m-d', strtotime($tahun.'-'.$bulan_fix.'-01'));
		$tanggal_akhir = date('Y-m-t', strtotime($tahun.'-'.$bulan_fix.'-01'));

		return [
			'tanggal_awal' => $tanggal_awal,
			'tanggal_akhir' => $tanggal_akhir,	
		];
	}

}
