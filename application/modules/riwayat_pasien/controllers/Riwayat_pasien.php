<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class Riwayat_pasien extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') === false) {
			return redirect('login');
		}
		
		$this->load->model('m_user');
		$this->load->model('m_global');
		$this->load->model('t_registrasi');
		$this->load->library('Enkripsi');
		$this->load->model('t_rekam_medik');
	}

	public function index()
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);		
		$data_pasien = $this->m_global->multi_row('*', ['deleted_at' => null], 'm_pasien', null, 'nama');

		$data = array(
			'title' => 'Monitoring Log Aktifitas',
			'data_user' => $data_user,
			'data_pasien' => $data_pasien
		);

		/**
		 * content data untuk template
		 * param (css : link css pada direktori assets/css_module)
		 * param (modal : modal komponen pada modules/nama_modul/views/nama_modal)
		 * param (js : link js pada direktori assets/js_module)
		 */
		$content = [
			'css' 	=> null,
			'modal' => ['modal_detail', 'modal_diagnosa', 'modal_tindakan', 'modal_logistik'],
			'js'	=> 'riwayat_pasien.js',
			'view'	=> 'view_riwayat'
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

		$select = "log.*, m_user.username, m_pegawai.nama as nama_pegawai";

		$where = ['log.deleted_at' => null, 'log.created_at >=' => $start.' 00:00:00', 'log.created_at <= ' => $end.' 23:59:59'];
	

		$table = 't_log_aktifitas as log';
		$join = [ 
			[
				'table' => 'm_user',
				'on'	=> 'log.id_user = m_user.id'
			],
			[
				'table' => 'm_pegawai',
				'on'	=> 'm_user.id_pegawai = m_pegawai.id'
			],
		];
		
		$datatable = $this->m_global->multi_row($select,$where,$table, $join, 'log.created_at desc');
		// echo $this->db->last_query();exit;
		
		// echo $this->db->last_query(); die();
		$data = array();
		$data = [];
		if ($datatable) {
			foreach ($datatable as $key => $value) {
			
				$data[$key][] = $key+1;
				$data[$key][] = Carbon::parse($value->created_at)->format('d-m-Y H:i:s');
				$data[$key][] = $value->username;
				$data[$key][] = $value->nama_pegawai;
				$data[$key][] = $value->aksi;
				if($value->new_data == null && $value->old_data == null) {
					$data[$key][] = '-';   
				}else{
					$data[$key][] = '<button class="btn btn-sm btn-info" onclick="detail_log(\'' . $value->id . '\',\'' . $this->enkripsi->enc_dec('encrypt', $value->aksi) . '\')">Detail</button>';   
				}
				
			}
		}
		
		// $this->output->enable_profiler(TRUE);

        echo json_encode([
            'data' => $data
        ]);
	}

	public function detail_aktifitas() {
		$id = $this->input->post('id');
		$aksi = $this->enkripsi->enc_dec($this->input->post('enc_aksi'), 'decrypt');

		switch ($aksi) {
			case 'UBAH DATA REGISTRASI':
				$data = $this->get_detail_reg_html($id, 'edit');
				break;
			
			default:
				# code...
				break;
		}
	}

	protected function get_detail_reg_html($id, $ket)
	{
		switch ($ket) {
			case 'edit':
				$datalog = $this->m_global->single_row('*', ['id'=>$id], 't_log_aktifitas');
				$q = $this->t_registrasi->get_data_log_edit($id, json_decode($datalog->new_data, true), json_decode($datalog->old_data, true));
				break;

			default:
				# code...
				break;
		}
	}

	public function simpan_form_diagnosa()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$datenow = $obj_date->format('Y-m-d');
		if ($this->input->post('fm_diagnosa') == '') {
			echo json_encode([
				'status' => true,
				'pesan' => 'wajib memilih diagnosa'
			]);
			return;
		}

		if($this->input->post('fm_tanggal') == '') {
			echo json_encode([
				'status'=> false,
				'pesan' => 'wajib memilih tanggal'
			]);
			return;
		}

		$this->db->trans_begin();

		$id_psn = $this->input->post('id_psn');
		$id_reg = null;
		$id_diagnosa = $this->input->post('fm_diagnosa');
		$gigi = $this->input->post('fm_gigi');
		$id_peg = $this->input->post('fm_dokter');
		
		$tanggal = Carbon::createFromFormat('d/m/Y', $this->input->post('fm_tanggal'))->format('Y-m-d');
		$keterangan = $this->input->post('fm_keterangan');
		//cek sudah ada data / tidak
		// $data_diagnosa = $this->m_global->single_row('*', ['id_reg' => $id_reg, 'id_pasien' => $id_psn, 'id_pegawai' => $id_peg], 't_diagnosa');

		// if(!$data_diagnosa){
		###insert
		$data = [
			'id_pasien' => $id_psn,
			'id_pegawai' => $id_peg,
			'id_reg' => null,
			'id_user_adm' => $this->session->userdata('id_user'),
			'tanggal' => $tanggal,
			'created_at' => $timestamp
		];

		$insert = $this->t_rekam_medik->save($data, 't_diagnosa');
		$this->m_global->insert_log_aktifitas('TAMBAH DATA RIWAYAT DIAGNOSA (REKAM MEDIK)', [
			'new_data' => json_encode($data)
		]);
		// $pesan = 'Sukses Menambah data Perawatan';
		// }

		// $cek_diagnosa = $this->m_global->single_row('id', ['id_reg' => null, 'id_pasien' => $id_psn, 'id_pegawai' => $id_peg], 't_diagnosa');
		$data_det = [
			'id_t_diagnosa' => $insert,
			'id_diagnosa' => $id_diagnosa,
			'gigi' => $gigi,
			'keterangan' => $keterangan,
			'created_at' => $timestamp
		];

		$insert_det = $this->t_rekam_medik->save($data_det, 't_diagnosa_det');

		$this->m_global->insert_log_aktifitas('TAMBAH DATA RIWAYAT DIAGNOSA DETAIL (REKAM MEDIK)', [
			'new_data' => json_encode($data_det)
		]);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['pesan'] = 'Gagal Menambah Data';
		} else {
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['pesan'] = 'Sukses Menambah Data';
		}

		echo json_encode($retval);
	}

	public function simpan_form_tindakan()
	{
		$this->db->trans_begin();

		try {
			$obj_date = new DateTime();
			$timestamp = $obj_date->format('Y-m-d H:i:s');
			$datenow = $obj_date->format('Y-m-d');
			if($this->input->post('tdk_tindakan') == '') {
				echo json_encode([
					'status'=> false,
					'pesan' => 'wajib memilih tindakan'
				]);
				return;
			}

			if($this->input->post('tdk_tanggal') == '') {
				echo json_encode([
					'status'=> false,
					'pesan' => 'wajib memilih tanggal'
				]);
				return;
			}

			$id_psn = $this->input->post('id_psn');
			$id_reg = null;
			$id_peg = $this->input->post('tdk_dokter');
			$id_tindakan = $this->input->post('tdk_tindakan');
			$ket = $this->input->post('tdk_ket');
			
			if($this->input->post('tdk_gigi_num') != '') {
				$gigi = $this->input->post('tdk_gigi_num');
			}

			if ($this->input->post('tdk_gigi_txt') != '') {
				$gigi = $this->input->post('tdk_gigi_txt');
			}
			
			$tanggal = Carbon::createFromFormat('d/m/Y', $this->input->post('tdk_tanggal'))->format('Y-m-d');
			
			//cek sudah ada data / tidak
			// $data = $this->m_global->single_row('*', ['id_reg' => $id_reg, 'id_pasien' => $id_psn, 'id_pegawai' => $id_peg], 't_tindakan');
			
			###insert
			$id = $this->m_global->get_max_id('id', 't_tindakan');
			$data = [
				'id' => $id,
				'id_pasien' => $id_psn,
				'id_pegawai' => $id_peg,
				'id_reg' => $id_reg,
				'id_user_adm' => $this->session->userdata('id_user'),
				'tanggal' => $tanggal,
				'created_at' => $timestamp
			];
						
			$insert = $this->t_rekam_medik->save($data, 't_tindakan');
			$this->m_global->insert_log_aktifitas('TAMBAH DATA RIWAYAT TINDAKAN (REKAM MEDIK)', [
				'new_data' => json_encode($data)
			]);
			

			$id_det = $this->m_global->get_max_id('id', 't_tindakan_det');

			$data_det['id'] = $id_det;
			$data_det['id_t_tindakan'] = $insert;
			$data_det['id_tindakan'] = $id_tindakan;
			$data_det['gigi'] = $gigi;
			$data_det['harga'] = 0;
			$data_det['diskon_persen'] = 0;
			$data_det['diskon_nilai'] = 0;
			$data_det['harga_bruto'] = 0;
			$data_det['keterangan'] = $ket;
			$data_det['created_at'] = $timestamp;

			$data_det_kirim[] = $data_det;

			$insert_det = $this->t_rekam_medik->save($data_det, 't_tindakan_det');

			$this->m_global->insert_log_aktifitas('TAMBAH DATA RIWAYAT TINDAKAN DETAIL (REKAM MEDIK)', [
				'new_data' => json_encode($data_det)
			]);

			if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				$retval['status'] = false;
				$retval['pesan'] = 'Gagal Menambah Data';
			}else{
				$this->db->trans_commit();
				$retval['status'] = true;
				$retval['pesan'] = 'Sukses Menambah Data';
			}

			echo json_encode($retval);
		} catch (\Throwable $th) {
			$this->db->trans_rollback();
			
			echo "<pre>";
			print_r ($th);
			echo "</pre>";
			
		}
		
	}

	public function simpan_form_logistik()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$datenow = $obj_date->format('Y-m-d');
		if($this->input->post('log_qty') == '') {
			echo json_encode([
				'status'=> true,
				'pesan' => 'wajib Mengisi Qty'
			]);
			return;
		}

		if($this->input->post('log_logistik') == '') {
			echo json_encode([
				'status'=> true,
				'pesan' => 'wajib Mengisi logistik'
			]);
			return;
		}

		if($this->input->post('log_tanggal') == '') {
			echo json_encode([
				'status'=> false,
				'pesan' => 'wajib memilih tanggal'
			]);
			return;
		}

		$this->db->trans_begin();
		$id_psn = $this->input->post('id_psn');
		$id_reg = null;
		$id_peg = $this->input->post('log_dokter');
		$logistik = $this->input->post('log_logistik');
		$qty_obat = $this->input->post('log_qty');
		$tanggal = Carbon::createFromFormat('d/m/Y', $this->input->post('log_tanggal'))->format('Y-m-d');
		//cek sudah ada data / tidak
		// $data = $this->m_global->single_row('*', ['id_reg' => $id_reg, 'id_pasien' => $id_psn, 'id_pegawai' => $id_peg], 't_logistik');
	
		###insert
		$id = $this->m_global->get_max_id('id', 't_logistik');
		$data = [
			'id' => $id,
			'id_pasien' => $id_psn,
			'id_pegawai' => $id_peg,
			'id_reg' => $id_reg,
			'id_user_adm' => $this->session->userdata('id_user'),
			'tanggal' => $tanggal,
			'created_at' => $timestamp,
		];
					
		$insert = $this->t_rekam_medik->save($data, 't_logistik');

		$this->m_global->insert_log_aktifitas('TAMBAH DATA RIWAYAT LOGISTIK (REKAM MEDIK)', [
			'new_data' => json_encode($data)
		]);


		$id_det = $this->m_global->get_max_id('id', 't_logistik_det');
		$data_det = [
			'id' => $id_det,
			'id_t_logistik' => $insert,
			'id_logistik' => $logistik,
			'qty' => $qty_obat,
			'harga' => 0,
			'subtotal' => 0,
			'created_at' => $timestamp
		];

		$data_det_kirim[] = $data_det;

		$insert_det = $this->t_rekam_medik->save($data_det, 't_logistik_det');

		$this->m_global->insert_log_aktifitas('TAMBAH DATA RIWAYAT LOGISTIK DETAIL (REKAM MEDIK)', [
			'new_data' => json_encode($data_det)
		]);
		// isi mutasi
		/**
		 * param 1 = id_registrasi
		 * param 2 kode jenis transaksi (lihat m_jenis_trans)
		 * param 3 data tabel transaksi (parent tabel)
		 * param 4 data tabel detail transaksi (child tabel)
		 * param 5 flag_transaksi (1 : penerimaan , 2 : pengeluaran)
		*/
		## $mutasi = $this->lib_mutasi->simpan_mutasi($id_reg, '1', $data, $data_det_kirim, '1');
		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['pesan'] = 'Gagal Menambah Data';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['pesan'] = 'Sukses Menambah Data';
		}

		echo json_encode($retval);
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
