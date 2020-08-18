<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mod_lap_keluar extends CI_Model
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
				tv.*, tkd.keterangan, tkd.qty, ts.nama as nama_satuan, tud.nama_lengkap_user
			FROM
				tbl_verifikasi tv
				JOIN tbl_trans_keluar_detail tkd on tv.id_out_detail = tkd.id
				JOIN tbl_satuan ts on tkd.satuan = ts.id
				JOIN tbl_user_detail tud on tv.user_id = tud.id_user
			WHERE tv.tanggal between '".$tanggal_awal."' and '".$tanggal_akhir."'
			ORDER BY tanggal asc
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
}