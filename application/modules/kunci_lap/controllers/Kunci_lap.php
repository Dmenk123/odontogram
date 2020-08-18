<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kunci_lap extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		//profil data
		$this->load->model('profil/mod_profil','prof');
		$this->load->model('mod_kunci_lap','kunci');
	}

	public function index()
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->prof->get_detail_pengguna($id_user);

		$arr_bulan = [ 
		    1 => 'Januari',
		    2 => 'Februari',
		    3 => 'Maret',
		    4 => 'April',
		    5 => 'Mei',
		    6 => 'Juni',
		    7 => 'Juli',
		    8 => 'Agustus',
		    9 => 'September',
		    10 => 'Oktober',
		    11 => 'November',
		    12 => 'Desember'
		];

		if ($this->input->get('tahun') != '') {
			$hasildata = $this->kunci->get_datatables($this->input->get('tahun'));			
			$data = array(
				'data_user' => $data_user,
				'arr_bulan' => $arr_bulan,
				'datatabel' => $hasildata
			);

		}else{
			$data = array(
				'data_user' => $data_user,
				'arr_bulan' => $arr_bulan,
				'datatabel' => null

			);
		}

		$content = [
			'css' 	=> 'cssKunciLap',
			'modal' => 'modalKunciLap',
			'js'	=> 'jsKunciLap',
			'view'	=> 'view_list_kunci_lap'
		];

		$this->template_view->load_view($content, $data);
	}

	public function proses_kunci_laporan()
	{
		$tahun = $this->input->post('tahun_kunci'); 
		$bulan = $this->input->post('bulan_kunci');
		$bulan_string = $this->format_bulan_string($bulan);
		
		$this->db->trans_begin();

		//cek adanya log kunci
		$cek = $this->kunci->cek_log_kunci($bulan_string, $tahun);
		if ($cek) {
			if ($cek->is_kunci == '1') {
				$this->db->trans_rollback();
				
				$status = FALSE;
				$pesan = 'Maaf Bulan Terpilih Sudah Dikunci';
				
				echo json_encode([
					'status' => $status,
					'pesan' => $pesan
				]);

				return;
			}else{
				$data_ins = [
					'bulan' => $bulan_string,
					'tahun' => $tahun,
					'user_id' => $this->session->userdata('id_user'),
					'is_kunci' => 1,
					'created_at' => date('Y-m-d H:i:s')
				];

				$this->db->insert('tbl_log_kunci', $data_ins);
			}
		}else{
			$data_ins = [
				'bulan' => $bulan_string,
				'tahun' => $tahun,
				'user_id' => $this->session->userdata('id_user'),
				'is_kunci' => 1,
				'created_at' => date('Y-m-d H:i:s')
			];

			$this->db->insert('tbl_log_kunci', $data_ins);
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$status = FALSE;
			$pesan = 'Gagal Kunci Laporan';
		} else {
			$this->db->trans_commit();
			$status = TRUE;
			$pesan = 'Berhasil Kunci Laporan';
		}

		echo json_encode([
			'status' => $status,
			'pesan' => $pesan
		]);
	}

	public function set_kunci_laporan()
	{
		$bulan = $this->input->post('bulan'); 
		$bulan_string = $this->format_bulan_string($bulan);
		$tahun = $this->input->post('tahun');
		$statuskunci = $this->input->post('statuskunci');
		
		$this->db->trans_begin();

		$where = [
			'bulan' => $bulan_string,
			'tahun' => $tahun,
		];

		if ($statuskunci == '1') {
			//update is_kunci jadi 0
			$data = ['is_kunci' => 0];
			$pesan_txt = 'Berhasil Membuka Kunci Laporan';
		}else{
			//update is_kunci jadi 1
			$data = ['is_kunci' => 1];
			$pesan_txt = 'Berhasil Mengunci Laporan';
		}

		$this->kunci->update($where, $data);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$status = FALSE;
			$pesan = 'Gagal Set Kunci Laporan';
		} else {
			$this->db->trans_commit();
			$status = TRUE;
			$pesan = $pesan_txt;
		}

		echo json_encode([
			'status' => $status,
			'pesan' => $pesan
		]);
	}
	
	/* ================================================================================================== */

	public function bulanIndo($key)
	{
		$arr_bulan = [ 
		    '1' => 'Januari',
		    '2' => 'Februari',
		    '3' => 'Maret',
		    '4' => 'April',
		    '5' => 'Mei',
		    '6' => 'Juni',
		    '7' => 'Juli',
		    '8' => 'Agustus',
		    '9' => 'September',
		    '10' => 'Oktober',
		    '11' => 'November',
		    '12' => 'Desember'
		];

		return $arr_bulan[$key];
	}

	public function format_bulan_string($bulan)
	{
		$hasil_bulan = ($bulan < 10) ? '0'.$bulan : $bulan;
		return $hasil_bulan;
	}
}
