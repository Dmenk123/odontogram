<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_k2 extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//profil data
		$this->load->model('profil/mod_profil','prof');
		$this->load->model('mod_lap_k2','lap');
	}

	public function index()
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->prof->get_detail_pengguna($id_user);

		$data = array(
			'data_user' => $data_user
		);

		$content = [
			'css' 	=> 'cssLapK2',
			'modal' => null,
			'js'	=> 'jsLapK2',
			'view'	=> 'view_lap_K2'
		];

		$this->template_view->load_view($content, $data);
	}

	public function laporan_k2_detail()
	{
		$this->load->library('Pdf_gen');
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->prof->get_detail_pengguna($id_user);

		$tahun = $this->input->get('tahun');

		//cari periode untuk tampilan pada laporan
		$arr_data = [];

		
		//get detail laporan jika belum dikunci
		//triwulan 1
		$tanggal_awal1 = date('Y-m-d', strtotime($tahun.'-01-01'));
		$tanggal_akhir1 = date('Y-m-t', strtotime($tahun.'-03-01'));
		$query1 = $this->lap->get_detail($tanggal_awal1, $tanggal_akhir1);

		//triwulan 2
		$tanggal_awal2 = date('Y-m-d', strtotime($tahun.'-04-01'));
		$tanggal_akhir2 = date('Y-m-t', strtotime($tahun.'-06-01'));
		$query2 = $this->lap->get_detail($tanggal_awal2, $tanggal_akhir2);

		//triwulan 3
		$tanggal_awal3 = date('Y-m-d', strtotime($tahun.'-07-01'));
		$tanggal_akhir3 = date('Y-m-t', strtotime($tahun.'-09-01'));
		$query3 = $this->lap->get_detail($tanggal_awal3, $tanggal_akhir3);

		//triwulan 4
		$tanggal_awal4 = date('Y-m-d', strtotime($tahun.'-10-01'));
		$tanggal_akhir4 = date('Y-m-t', strtotime($tahun.'-12-01'));
		$query4 = $this->lap->get_detail($tanggal_awal4, $tanggal_akhir4);

		//ambil penerimaan (dana BOS)
		$query_masuk = $this->lap->get_penerimaan($tanggal_awal1, $tanggal_akhir4);
						
		//assign satu row array untuk saldo awal
		$no = 1;
		$arr_data['penerimaan'][0]['no'] = $no;
		$arr_data['penerimaan'][0]['kode'] = '3.1';
		$arr_data['penerimaan'][0]['uraian'] = 'Penerimaan BOS';
		$arr_data['penerimaan'][0]['jumlah'] = number_format($query_masuk->total_penerimaan,0,",",".");
		$arr_data['penerimaan'][0]['jumlah_raw'] = $query_masuk->total_penerimaan;

		//loop detail laporan dan assign array
		for ($i=1; $i <= 4 ; $i++) { 
			foreach (${'query'.$i} as $key => $val) {
				$no++;
				$arr_data['triwulan'.$i][$key]['no'] = $no;
				$arr_data['triwulan'.$i][$key]['kode'] = $val->kode_sing_di_group_by;
				$arr_data['triwulan'.$i][$key]['uraian'] = $val->nama;
				$arr_data['triwulan'.$i][$key]['jumlah'] = number_format($val->harga_total,0,",",".");
				$arr_data['triwulan'.$i][$key]['jumlah_raw'] = ($val->harga_total == null) ? 0 : $val->harga_total; 
			}

			$no = 1;
		}

		
		$data = array(
			'title' => 'SMP Darul Ulum Surabaya',
			'data_user' => $data_user,
			'arr_bulan' => $this->bulan_indo(),
			'hasil_data' => $arr_data,
			//'periode' => $txtPeriode,
			//'bln_awal' => $arr_pecah_bulan[0],
			//'bln_akhir' => $arr_pecah_bulan[1],
			'tahun' => $tahun
		);

	    $html = $this->load->view('view_lap_k2_cetak', $data, true);
	    
	    $filename = 'laporan_k2_'.time();
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

	public function hilangakan_stringkosong_bulan($bln_awal, $bln_akhir, $tahun)
	{
		$bulan_awal = ($bln_awal < 10) ? '0'.$bln_awal : $bln_awal;
		$bulan_akhir = ($bln_akhir < 10) ? '0'.$bln_akhir : $bln_akhir;

		$tanggal_awal = date('Y-m-d', strtotime($tahun.'-'.$bulan_awal.'-01'));
		$tanggal_akhir = date('Y-m-t', strtotime($tahun.'-'.$bulan_akhir.'-01'));

		return [
			'tanggal_awal' => $tanggal_awal,
			'tanggal_akhir' => $tanggal_akhir,	
		];
	}

}
