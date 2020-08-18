<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mod_lap_k1 extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//alternative load library from config
		$this->load->database();
	}

	public function get_detail($tanggal_awal, $tanggal_akhir)
	{ 
		$query = $this->db->query("
			SELECT
					tmka.*, sum(tv.harga_total) as harga_total, 
					concat(tmka.tipe,'.',tmka.kode_in_text) as idx_column,
					concat(tmka.tipe,'.',tmka.kode) as kode_sing_di_group_by
				FROM
					tbl_master_kode_akun AS tmka 
				left JOIN 
					tbl_verifikasi tv on 
						CONCAT(tmka.tipe, tmka.kode, tmka.sub_1, IFNULL(tmka.sub_2, 0)) = CONCAT(tv.tipe_akun, tv.kode_akun, tv.sub1_akun, IFNULL(tv.sub2_akun, 0)) and tv.tanggal between '".$tanggal_awal."' and '".$tanggal_akhir."' 
				WHERE
					tmka.is_aktif = 1 
				GROUP BY kode_sing_di_group_by
				ORDER BY tmka.tipe, tmka.kode, tmka.sub_1, tmka.sub_2
		");

        return $query->result();
       
	}

	public function get_detail_pengeluaran_lain($tanggal_awal, $tanggal_akhir)
	{
		$query = $this->db->query("
			SELECT tmka.*, sum(tv.harga_total) as harga_total, concat(tmka.tipe,'.',tmka.kode_in_text) as idx_column
			FROM
				tbl_master_kode_akun AS tmka 
			left JOIN 
				tbl_verifikasi tv on 
					CONCAT(tmka.tipe, tmka.kode, tmka.sub_1, IFNULL(tmka.sub_2, 0)) = CONCAT(tv.tipe_akun, tv.kode_akun, tv.sub1_akun, IFNULL(tv.sub2_akun, 0)) and tv.tanggal between '".$tanggal_awal."' and '".$tanggal_akhir."' 
			WHERE
				tmka.is_aktif = 1 and tipe = 2
				GROUP BY kode_in_text
			ORDER BY tmka.tipe, tmka.kode, tmka.sub_1, tmka.sub_2
		");

		return $query->result();
	}

	public function get_penerimaan($tanggal_awal, $tanggal_akhir)
	{
		$query = $this->db->query("
			SELECT 
				sum(tv.harga_total) as total_penerimaan 
			FROM tbl_verifikasi tv 
			JOIN tbl_trans_masuk tm on tv.id_in = tm.id
			where tv.tipe_transaksi = 1 and tv.tanggal between '".$tanggal_awal."' and '".$tanggal_akhir."' and tm.is_bos = '1'
		");
		return $query->row();
	}

	public function get_penerimaan_non_bos($tanggal_awal, $tanggal_akhir)
	{
		$query = $this->db->query("
			SELECT 
				sum(tv.harga_total) as total_penerimaan 
			FROM tbl_verifikasi tv 
			JOIN tbl_trans_masuk tm on tv.id_in = tm.id
			where tv.tipe_transaksi = 1 and tv.tanggal between '".$tanggal_awal."' and '".$tanggal_akhir."' and tm.is_bos = '0'
		");
		return $query->row();
	}

	public function get_detail_laporan($bulan, $tahun, $kode_header)
	{
		$tanggal_awal = date('Y-m-d', strtotime($tahun.'-'.$bulan.'-01'));
		$tanggal_akhir = date('Y-m-t', strtotime($tahun.'-'.$bulan.'-01'));

		$query = $this->db->query("
			SELECT * from tbl_lap_bku_detail where tanggal between '$tanggal_awal' and '$tanggal_akhir' and is_kunci = '1'
		");

        return $query->result();
	}

	public function get_saldo_awal($bulan, $tahun)
	{
		$saldo = 0;
		$anchorBulan = (int)$bulan - 1;
		for ($i=$bulan; $i <= 1 ; $i--) { 
			$bln = ($i < 10) ? '0'.$i : $i;
			$q = $this->db->query("SELECT saldo_akhir FROM tbl_lap_bku WHERE bulan = '".$bln."' and tahun = '".$tahun."' and is_delete is null")->row();

			if ($q) {
				$saldo = $q->saldo_akhir;
				break;
			}
		}

		return $saldo;
	}

	public function get_last_saldo($tahun)
	{
		$this->db->select('saldo_akhir');
		$this->db->from('tbl_lap_bku');
		$this->db->where('tahun', $tahun);
		$this->db->where('bulan', '12');
		$this->db->where('is_delete', '0');
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			$query->row();
			return $query->saldo_akhir;
		}else{
			return 0;
		}
	}
}