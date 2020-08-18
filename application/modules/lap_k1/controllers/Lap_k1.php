<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_k1 extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//profil data
		$this->load->model('profil/mod_profil','prof');
		$this->load->model('mod_lap_k1','lap');
	}

	public function index()
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->prof->get_detail_pengguna($id_user);

		$data = array(
			'data_user' => $data_user
		);

		$content = [
			'css' 	=> 'cssLapK1',
			'modal' => null,
			'js'	=> 'jsLapK1',
			'view'	=> 'view_lap_K1'
		];

		$this->template_view->load_view($content, $data);
	}

	public function laporan_k1_detail()
	{
		$this->load->library('Pdf_gen');
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->prof->get_detail_pengguna($id_user);

		$tahun = $this->input->get('tahun');

		//cari periode untuk tampilan pada laporan
		$arr_data = [];

		
		//get detail laporan jika belum dikunci
		//triwulan 1
		$tanggal_awal = date('Y-m-d', strtotime($tahun.'-01-01'));
		$tanggal_akhir = date('Y-m-t', strtotime($tahun.'-12-01'));
		$query = $this->lap->get_detail($tanggal_awal, $tanggal_akhir);
		$query2 = $this->lap->get_detail_pengeluaran_lain($tanggal_awal, $tanggal_akhir);

		//cek saldo tahun lalu
		$ambil_saldo = $this->lap->get_last_saldo((int)$this->input->get('tahun')-1);

		//ambil penerimaan (dana BOS)
		$query_masuk = $this->lap->get_penerimaan($tanggal_awal, $tanggal_akhir);
		//penerimaan NON BOS
		$query_masuk2 = $this->lap->get_penerimaan_non_bos($tanggal_awal, $tanggal_akhir);
						
		//assign satu row array untuk saldo awal
		$no = 1;
		$arr_data['penerimaan'][0]['no'] = $no;
		$arr_data['penerimaan'][0]['kode'] = '3.1';
		$arr_data['penerimaan'][0]['jumlah'] = number_format($query_masuk->total_penerimaan,0,",",".");
		$arr_data['penerimaan'][0]['jumlah_raw'] = $query_masuk->total_penerimaan;

		$arr_data['penerimaan'][1]['no'] = $no;
		$arr_data['penerimaan'][1]['kode'] = '';
		$arr_data['penerimaan'][1]['jumlah'] = number_format($query_masuk2->total_penerimaan,0,",",".");
		$arr_data['penerimaan'][1]['jumlah_raw'] = $query_masuk2->total_penerimaan;


		//loop detail laporan dan assign array
		foreach ($query as $key => $val) {
			if ($val->tipe == '1') {
				$arr_data['pengeluaran_reg'][$key]['no'] = $no;
				$arr_data['pengeluaran_reg'][$key]['kode'] = $val->kode_sing_di_group_by;
				$arr_data['pengeluaran_reg'][$key]['uraian'] = $val->nama;
				$arr_data['pengeluaran_reg'][$key]['jumlah'] = number_format($val->harga_total, 0, ",", ".");
				$arr_data['pengeluaran_reg'][$key]['jumlah_raw'] = ($val->harga_total == null) ? 0 : $val->harga_total; 
			}
		}

		//loop detail laporan dan assign array
		foreach ($query2 as $key => $val) {
			$arr_data['pengeluaran_gaji'][$key]['no'] = $no;
			$arr_data['pengeluaran_gaji'][$key]['kode'] = $val->kode_in_text;
			$arr_data['pengeluaran_gaji'][$key]['uraian'] = $val->nama;
			$arr_data['pengeluaran_gaji'][$key]['jumlah'] = number_format($val->harga_total, 0, ",", ".");
			$arr_data['pengeluaran_gaji'][$key]['jumlah_raw'] = ($val->harga_total == null) ? 0 : $val->harga_total; 
		}

		$data = array(
			'title' => 'SMP Darul Ulum Surabaya',
			'data_user' => $data_user,
			'arr_bulan' => $this->bulan_indo(),
			'hasil_data' => $arr_data,
			'tahun' => $tahun,
			'saldo_awal' => $ambil_saldo
		);

		/*echo "<pre>";
		print_r ($data);
		echo "</pre>";
		exit;*/

	    $html = $this->load->view('view_lap_k1_cetak', $data, true);
	    
	    $filename = 'laporan_k1_'.time();
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
