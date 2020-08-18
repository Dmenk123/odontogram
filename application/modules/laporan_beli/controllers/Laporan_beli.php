<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_beli extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//cek apablia session kosong
		if ($this->session->userdata('username') === null) {
			//direct ke controller login
			redirect('login');
		}elseif ($this->session->userdata('id_level_user') != '1' && $this->session->userdata('id_level_user') != '2' && $this->session->userdata('id_level_user') != '4') {
			redirect('home/oops');
		}

		//pesan stok dibawah rop
		$this->load->model('Mod_home');
		$barang = $this->Mod_home->get_barang();
			foreach ($barang as $key) {
				if ($key->stok_barang < $key->rop_barang) {
					$this->session->set_flashdata('cek_stok', 'Terdapat Stok Barang dibawah nilai Reorder Point, Mohon di cek ulang / melakukan permintaan');
				}
			}
		$this->load->model('mod_lap_beli','lap_beli');
		$this->load->model('pengguna/mod_pengguna');
		$this->load->model('pesan/mod_pesan','psn');
	}

	public function index()
	{
		$id_user = $this->session->userdata('id_user'); 
		$query = $this->mod_pengguna->get_detail_user($id_user);
		$jumlah_notif = $this->psn->notif_count($id_user);  //menghitung jumlah post
		$notif= $this->psn->get_notifikasi($id_user); //menampilkan isi postingan

		if ($this->session->userdata('id_level_user') == 1) {
			$data = array(
				'content'=>'view_lap_beli',
				'css'=>'cssLapBeli',
				'js'=>'jsLapBeli',
				'title' => 'PT.Surya Putra Barutama',
				'data_user' => $query,
				'qty_notif' => $jumlah_notif,
				'isi_notif' => $notif,
			);
		}elseif ($this->session->userdata('id_level_user') == 2) {
			$data = array(
				'content'=>'view_lap_beli',
				'css'=>'cssLapBeli',
				'js'=>'jsLapBeli',
				'title' => 'PT.Surya Putra Barutama',
				'data_user' => $query,
				'qty_notif' => $jumlah_notif,
				'isi_notif' => $notif,
			);
		}elseif ($this->session->userdata('id_level_user') == 4) {
			$data = array(
				'content'=>'view_lap_beli',
				'css'=>'cssLapBeli',
				'js'=>'jsLapBeli',
				'title' => 'PT.Surya Putra Barutama',
				'data_user' => $query,
				'qty_notif' => $jumlah_notif,
				'isi_notif' => $notif,
			);
		}
		//parsing data ke file view home
		$this->load->view('view_home',$data);
	}

	public function laporan_beli_detail()
	{
		$id_user = $this->session->userdata('id_user'); 
		$query_user = $this->mod_pengguna->get_detail_user($id_user);

		$jumlah_notif = $this->psn->notif_count($id_user);  //menghitung jumlah post
		$notif= $this->psn->get_notifikasi($id_user); //menampilkan isi postingan

		$tanggal_awal = $this->input->post('tanggalBeliAwal');
		$tanggal_akhir = $this->input->post('tanggalBeliAkhir');
		$query = $this->lap_beli->get_detail($tanggal_awal, $tanggal_akhir);
		//echo var_dump($query_header);
		if ($this->session->userdata('id_level_user') == 1) {
			$data = array(
				'css'=>'cssLapBeli',
				'js'=>'jsLapBeli',
				'content'=>'view_lap_beli_detail',
				'title' => 'PT.Surya Putra Barutama',
				'hasil_data' => $query,
				'data_user' => $query_user,
				'tanggal_awal' => $tanggal_awal,
				'tanggal_akhir' => $tanggal_akhir,
				'tanggal' => $tanggal_awal.' s/d '.$tanggal_akhir,
				'qty_notif' => $jumlah_notif,
				'isi_notif' => $notif,
			);
		}elseif ($this->session->userdata('id_level_user') == 2) {
			$data = array(
				'css'=>'cssLapBeli',
				'js'=>'jsLapBeli',
				'content'=>'view_lap_beli_detail',
				'title' => 'PT.Surya Putra Barutama',
				'hasil_data' => $query,
				'data_user' => $query_user,
				'tanggal_awal' => $tanggal_awal,
				'tanggal_akhir' => $tanggal_akhir,
				'tanggal' => $tanggal_awal.' s/d '.$tanggal_akhir,
				'qty_notif' => $jumlah_notif,
				'isi_notif' => $notif,
			);
		}elseif ($this->session->userdata('id_level_user') == 4) {
			$data = array(
				'css'=>'cssLapBeli',
				'js'=>'jsLapBeli',
				'content'=>'view_lap_beli_detail',
				'title' => 'PT.Surya Putra Barutama',
				'hasil_data' => $query,
				'data_user' => $query_user,
				'tanggal_awal' => $tanggal_awal,
				'tanggal_akhir' => $tanggal_akhir,
				'tanggal' => $tanggal_awal.' s/d '.$tanggal_akhir,
				'qty_notif' => $jumlah_notif,
				'isi_notif' => $notif,
			);
		}
		$this->load->view('view_home',$data);
	}

	public function cetak_report_pembelian($tglAwal= 0, $tglAkhir= 0)
	{
		$this->load->library('Pdf_gen');
		$this->load->model('laporan_order/mod_lap_order');
		// $tglAwal = $this->uri->segment(3);
		// $tglAkhir =$this->uri->segment(4);
		$id_user = $this->session->userdata('id_user');
		$query = $this->lap_beli->get_detail($tglAwal, $tglAkhir);
		$query_footer = $this->mod_lap_order->get_detail_footer($id_user);

		$data = array(
			'title' => 'Laporan Pembelian Barang',
			'hasil_data' => $query,
			'hasil_footer' => $query_footer,
			'tanggal_awal' => $tglAwal,
			'tanggal_akhir' => $tglAkhir,
			'tanggal' => $tglAwal.' s/d '.$tglAkhir,
			);

	    $html = $this->load->view('view_lap_beli_cetak', $data, true);
	    
	    $filename = 'laporan_pembelian_'.time();
	    $this->pdf_gen->generate($html, $filename, true, 'A4', 'portrait');
	}

}
