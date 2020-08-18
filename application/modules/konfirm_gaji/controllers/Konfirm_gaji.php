<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfirm_gaji extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		//profil data
		$this->load->model('profil/mod_profil','prof');
		$this->load->model('verifikasi_out/mod_verifikasi_out','m_vout');
		$this->load->model('pengeluaran/mod_pengeluaran','m_out');
		$this->load->model('mod_konfirm_gaji','m_kon');
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

		if ($this->input->get('bulan') != '' && $this->input->get('tahun') != '') {
			$hasildata = $this->m_kon->get_datatables($this->input->get('bulan'), $this->input->get('tahun'), 0);
			$hasildatafinish = $this->m_kon->get_datatables($this->input->get('bulan'), $this->input->get('tahun'), 1);
			
			$bulan = $this->input->get('bulan');
			$tahun = $this->input->get('tahun');
			$bulan_fix = $this->format_bulan_string($bulan);
			
			$cek_status_kunci = $this->cek_status_kuncian($bulan_fix, $tahun);
			
			$data = array(
				'data_user' => $data_user,
				'arr_bulan' => $arr_bulan,
				'datatabel' => $hasildata,
				'datatabel2' => $hasildatafinish,
				'cek_status_kunci' => $cek_status_kunci	
			);

		}else{
			$data = array(
				'data_user' => $data_user,
				'arr_bulan' => $arr_bulan,
				'datatabel' => null,
				'datatabel2' => null,
				'cek_status_kunci' => null	
			);
		}

		$content = [
			'css' 	=> 'cssKonfirmGaji',
			'modal' => 'modalKonfirmGaji',
			'js'	=> 'jsKonfirmGaji',
			'view'	=> 'view_list_konfirm_gaji'
		];

		$this->template_view->load_view($content, $data);
	}

	public function detail($tipepeg, $bulan, $tahun, $confirm)
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

		$hasil_data = $this->m_kon->get_detail($tipepeg, $bulan, $tahun, $confirm);
		
		$data = array(
			'data_user' => $data_user,
			'arr_bulan' => $arr_bulan,
			'hasil_data' => $hasil_data
		);
				
		$content = [
			'css' 	=> 'cssKonfirmGaji',
			'modal' => null,
			'js'	=> 'jsKonfirmGaji',
			'view'	=> 'view_detail_konfirm_gaji'
		];

		$this->template_view->load_view($content, $data);
	}

	public function proses_konfirmasi($tipepeg, $bulan, $tahun)
	{
		$this->db->trans_begin();

		//insert into tbl pengeluaran
		$kode_out_header = $this->m_out->getKodePengeluaran();
		$dataInsOut = [
			'id' => $kode_out_header,
			'user_id' => $this->session->userdata('id_user'),
			'pemohon' => 'GAJI BULANAN',
			'tanggal' => date('Y-m-t', strtotime($tahun.'-'.$bulan.'-01')),
			'status' => 0,
			'created_at' => date('Y-m-d H:i:s')
		];
		$this->m_kon->save('tbl_trans_keluar', $dataInsOut);

		//insert into tbl pengeluaran_det
		$txtKet = ($tipepeg == 1) ? 'Gaji Bulanan Guru' : 'Gaji Bulanan Staff/Karyawan';
		$dataInsOutDetail = [
			'id_trans_keluar' => $kode_out_header,
			'keterangan' => $txtKet,
			'satuan' => '9',
			'qty' => '1',
			'status' => 1
		];
		$this->m_kon->save('tbl_trans_keluar_detail', $dataInsOutDetail);
		
		//update status jadi confirm
		$data_awal = $this->m_kon->get_datatables($bulan, $tahun, 0);
		$this->m_kon->update(['is_guru' => $tipepeg, 'bulan' => $bulan, 'tahun' => $tahun, 'is_aktif' => 1], ['is_confirm'=> 1]);

		foreach ($data_awal as $key => $dawal) {
			if ($dawal->is_guru == $tipepeg) {
				$total_gaji_fix = $dawal->total_gaji;
			}
		}

		//insert into tbl verifikasi
		$kode_verifikasi = $this->m_vout->getKodeVerifikasi();
		$q = $this->db->query("select * from tbl_trans_keluar_detail where id_trans_keluar = '".$kode_out_header."'")->row();
		
		$data_ins_v = [
			'id' => $kode_verifikasi,
			'id_out' => $kode_out_header,
			'id_out_detail' => $q->id,
			'tanggal' => date('Y-m-t', strtotime($tahun.'-'.$bulan.'-01')),
			'user_id' => $this->session->userdata('id_user'),
			'gambar_bukti' => null,
			'harga_satuan' => $total_gaji_fix,
			'harga_total' => $total_gaji_fix,
			'status' => 2,
			'tipe_akun' => 2,
			'kode_akun' => 2,
			'sub1_akun' => 3,
			'sub2_akun' => null,
			'created_at' => date("Y-m-d H:i:s")
		];

		$this->m_kon->save('tbl_verifikasi', $data_ins_v);

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$status = FALSE;
			$pesan = 'Gagal Konfirmasi Gaji';
		}
		else {
			$this->db->trans_commit();
			$status = TRUE;
			$pesan = 'Berhasil Konfirmasi Gaji';
		}

		echo json_encode(array(
			"status" => $status,
			"pesan" => $pesan,
		));
	}

	public function delete_konfirmasi($tipepeg, $bulan, $tahun)
	{
		$this->db->trans_begin();

		$tgl_konfirm_gaji = date('Y-m-t', strtotime($tahun.'-'.$bulan.'-01'));
		$txtIndexKey = ($tipepeg == '1') ? 'Gaji Bulanan Guru' : 'Gaji Bulanan Staff/Karyawan' ;
		//get data kode pengeluaran
		$q = $this->db->query("
			select 
				tk.id, tk.tanggal, tkd.satuan, tkd.qty
			from tbl_trans_keluar tk
			join tbl_trans_keluar_detail tkd on tk.id = tkd.id_trans_keluar
			where tk.tanggal = '".$tgl_konfirm_gaji."' and tk.status = '0' and tkd.keterangan = '".$txtIndexKey."'
		")->result();

		foreach ($q as $key => $val) {
			//delete tbl verifikasi
			$this->m_kon->delete_data('tbl_verifikasi', ['id_out' => $val->id]);
			//delete tbl pengeluaran detail
			$this->m_kon->delete_data('tbl_trans_keluar_detail', ['id_trans_keluar' => $val->id]);
			//delete tbl pengeluaran
			$this->m_kon->delete_data('tbl_trans_keluar', ['id' => $val->id]);
		}
			
		//update status jadi un-confirm
		$data_awal = $this->m_kon->get_datatables($bulan, $tahun, 1);
		$this->m_kon->update(['is_guru' => $tipepeg, 'bulan' => $bulan, 'tahun' => $tahun, 'is_aktif' => 1], ['is_confirm'=> 0]);
		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$status = FALSE;
			$pesan = 'Gagal Hapus Konfirmasi Gaji';
		}
		else {
			$this->db->trans_commit();
			$status = TRUE;
			$pesan = 'Berhasil Hapus Konfirmasi Gaji';
		}

		echo json_encode(array(
			"status" => $status,
			"pesan" => $pesan,
		));
	}

	public function cek_status_kuncian($bulan, $tahun)
	{
		$q = $this->db->query("SELECT * FROM tbl_log_kunci WHERE bulan = '" . $bulan . "' and tahun ='" . $tahun . "'")->row();
		if ($q->is_kunci == '1') {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function format_bulan_string($bulan)
	{
		$hasil_bulan = ($bulan < 10) ? '0' . $bulan : $bulan;
		return $hasil_bulan;
	}

	/* ================================================================================================== */

	public function suggest_guru()
	{
		if (isset($_GET['term'])) {
			$q = strtolower($_GET['term']);
		}else{
			$q = '';
		}
		
		$query = $this->m_kon->lookup_kode_guru($q);
		
		foreach ($query as $row) {
			$akun[] = array(
				'id' => $row->id,
				'text' => $row->nip.' - '.$row->nama
			);
		}
		echo json_encode($akun);
	}

	public function get_data_guru($id)
	{
		$q = $this->db->query("
			SELECT tg.*, tj.nama as nama_jabatan, tsg.gaji_pokok, tsg.gaji_perjam, tsg.gaji_tunjangan_jabatan 
			FROM tbl_guru as tg
			JOIN tbl_jabatan tj on tg.kode_jabatan = tj.id and tj.is_aktif = 1
			JOIN tbl_set_gaji tsg on tg.kode_jabatan = tsg.id_jabatan and tsg.is_aktif = 1
			WHERE tg.id = '".$id."' and tg.is_aktif = 1
		 ")->row();

		if ($q->is_guru == 1) {
			$q->statuspeg = 'Guru';
		}else{
			$q->statuspeg = 'Staff/Karyawan';
		}
		
		echo json_encode($q);
	}

	public function add_data()
	{
		//validasi
		$arr_valid = $this->_validate();
		
		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}  

		$tahun = $this->input->post('tahun');
		$bulan = $this->input->post('bulan');
		$namapeg = $this->input->post('namapeg');
		$statuspeg = $this->input->post('statuspeg_raw');
		$jabatanpeg = $this->input->post('jabatanpeg_raw');
		$gapok = $this->input->post('gapok_raw');
		$gaperjam = $this->input->post('gaperjam_raw');
		$tunjangan = $this->input->post('tunjangan_raw');
		$tunjangan_lain = $this->input->post('tunjanganlain_raw');
		$potongan = $this->input->post('potongan_raw');
		$jumlahjam = $this->input->post('jumlahjam');
		$totalgaji = $this->input->post('totalgaji_raw');	
		
		$this->db->trans_begin();

		//cek sudah ada gaji/belum
		$cek_ada = $this->m_kon->cek_exist_gaji([
			'id_guru' => $namapeg, 
			'bulan' => (int)$bulan, 
			'tahun' => $tahun, 
			'is_aktif' => '1'
		]);

		if ($cek_ada) {
			echo json_encode(array(
				"status" => FALSE,
				"pesan" => "Maaf Gaji Guru/Staff pada bulan ".$bulan." dan ".$tahun." Sudah ada"
			));
			return;
		}

		$arr_ins_gaji = [
			'id_guru' => $namapeg,
			'id_jabatan' => $jabatanpeg,
			'bulan' => $bulan,
			'tahun' => $tahun,
			'is_guru' => $statuspeg,
			'gaji_pokok' => $gapok,
			'gaji_perjam' => $gaperjam,
			'gaji_tunjangan_jabatan' => $tunjangan,
			'gaji_tunjangan_lain' => $tunjangan_lain,
			'potongan_lain' => $potongan,
			'jumlah_jam_kerja' => $jumlahjam,
			'total_take_home_pay' => $totalgaji,
			'created_at' => date('Y-m-d H:i:s')
		];
		
		$insert = $this->m_kon->save('tbl_penggajian', $arr_ins_gaji);

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$status = FALSE;
			$pesan = 'Gagal Proses Gaji';
		}
		else {
			$this->db->trans_commit();
			$status = TRUE;
			$pesan = 'Berhsil Proses Gaji';
		}
				
		echo json_encode(array(
			"status" => $status,
			"pesan" => $pesan,
		));
	}

	public function edit($id)
	{
		$data = $this->m_kon->get_by_id($id);
		echo json_encode($data);
	}

	public function update_data()
	{
		$arr_valid = $this->_validate();
		
		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		} 

		$tahun = $this->input->post('tahun');
		$bulan = $this->input->post('bulan');
		$namapeg = $this->input->post('namapeg');
		$statuspeg = $this->input->post('statuspeg_raw');
		$jabatanpeg = $this->input->post('jabatanpeg_raw');
		$gapok = $this->input->post('gapok_raw');
		$gaperjam = $this->input->post('gaperjam_raw');
		$tunjangan = $this->input->post('tunjangan_raw');
		$tunjangan_lain = $this->input->post('tunjanganlain_raw');
		$potongan = $this->input->post('potongan_raw');
		$jumlahjam = $this->input->post('jumlahjam');
		$totalgaji = $this->input->post('totalgaji_raw');

		$this->db->trans_begin();

		$cek_ada = $this->m_kon->cek_exist_gaji(['id_guru' => $namapeg, 'bulan' => (int)$bulan, 'tahun' => $tahun]);

		if ($cek_ada) {
			echo json_encode(array(
				"status" => FALSE,
				"pesan" => "Maaf Gaji Guru/Staff pada bulan ".$bulan." dan ".$tahun." Sudah ada"
			));
			return;
		}

		$data = [
			'id_guru' => $namapeg,
			'id_jabatan' => $jabatanpeg,
			'bulan' => $bulan,
			'tahun' => $tahun,
			'is_guru' => $statuspeg,
			'gaji_pokok' => $gapok,
			'gaji_perjam' => $gaperjam,
			'gaji_tunjangan_jabatan' => $tunjangan,
			'gaji_tunjangan_lain' => $tunjangan_lain,
			'potongan_lain' => $potongan,
			'jumlah_jam_kerja' => $jumlahjam,
			'total_take_home_pay' => $totalgaji
		];

		$this->m_kon->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array(
			"status" => TRUE,
			"pesan" => 'Setting Gaji Berhasil diupdate',
		));
	}

	public function delete_data($id)
	{
		//$this->m_kon->delete_by_id($id);
		$this->m_kon->update(['id' => $id], ['is_aktif '=> 0]);
		echo json_encode(array(
			"status" => TRUE,
			"pesan" => 'Setting Gaji Berhasil dihapus',
		));
	}

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

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('tahun') == '') {
			$data['inputerror'][] = 'tahun';
            $data['error_string'][] = 'Wajib mengisi tahun';
            $data['status'] = FALSE;
		}

		if ($this->input->post('bulan') == '') {
			$data['inputerror'][] = 'bulan';
            $data['error_string'][] = 'Wajib mengisi Bulan';
            $data['status'] = FALSE;
		}

		/*if ($this->input->post('gaperjam') == '') {
			$data['inputerror'][] = 'gaperjam';
            $data['error_string'][] = 'Wajib mengisi Gaji per jam';
            $data['status'] = FALSE;
		}*/

		/*if ($this->input->post('tunjangan') == '') {
			$data['inputerror'][] = 'tunjangan';
            $data['error_string'][] = 'Wajib mengisi Gaji Tunjangan';
            $data['status'] = FALSE;
		}*/

		/*if ($this->input->post('tipepeg') == '') {
			$data['inputerror'][] = 'tipepeg';
            $data['error_string'][] = 'Wajib mengisi Tipe Pegawai';
            $data['status'] = FALSE;
		}*/
			
        return $data;
	}
}
