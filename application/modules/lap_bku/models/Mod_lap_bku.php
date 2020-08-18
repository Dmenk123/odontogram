<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mod_lap_bku extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//alternative load library from config
		$this->load->database();
	}

	public function get_detail($bulan, $tahun)
	{ 
		$tanggal_awal = date('Y-m-d', strtotime($tahun.'-'.$bulan.'-01'));
		$tanggal_akhir = date('Y-m-t', strtotime($tahun.'-'.$bulan.'-01'));

		$query = $this->db->query("
			SELECT tv.*, CASE WHEN (tmd.keterangan is null) THEN tkd.keterangan ELSE tmd.keterangan END AS keterangan
			FROM tbl_verifikasi tv
			left join tbl_trans_masuk_detail tmd on concat(tv.id_in,'-',tv.id_in_detail) = concat(tmd.id_trans_masuk,'-',tmd.id)
			left join tbl_trans_keluar_detail tkd on concat(tv.id_out,'-',tv.id_out_detail) = concat(tkd.id_trans_keluar,'-',tkd.id)
			where tanggal between '$tanggal_awal' and '$tanggal_akhir' order by tv.tipe_transaksi, tv.tanggal, tv.id
		");

        return $query->result();
       
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
		for ($i=$anchorBulan; $i >= 1 ; $i--) { 
			$bln = ($i < 10) ? '0'.$i : $i;
			$q = $this->db->query("SELECT saldo_akhir FROM tbl_lap_bku WHERE bulan = '".$bln."' and tahun = '".$tahun."' and is_delete = '0'")->row();

			if ($q) {
				$saldo = $q->saldo_akhir;
				break;
			}
		}

		return $saldo;
	}

	public function cek_lap_bku($bulan, $tahun)
	{
		$this->db->select('*');
		$this->db->from('tbl_lap_bku');
		$this->db->where("is_delete = '0' and bulan = '".$bulan."' and tahun = '".$tahun."'");
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->row();
		}else{
			return FALSE;
		}
	}

	public function update($table, $where, $data)
	{
		$this->db->update($table, $data, $where);
		return $this->db->affected_rows();
	}

	function getKodeLapBku($bulan, $tahun)
	{
		$q = $this->db->query("SELECT MAX(RIGHT(kode,5)) as kode_max from tbl_lap_bku WHERE bulan = '".$bulan."' AND tahun = '".$tahun."'");
		
		$kd = "";
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $k) {
				$tmp = ((int) $k->kode_max) + 1;
				$kd = sprintf("%05s", $tmp);
			}
		} else {
			$kd = "00001";
		}
		return "BKU" . date('my', strtotime($tahun.'-'.$bulan.'-01')) . $kd;
	}

	//================================LAWAS==================================

	public function get_detail2($tanggal_awal, $tanggal_akhir)
	{
		$tanggal_awal2 = date('Y-m-d', strtotime('-1 days', strtotime($tanggal_awal)));
		$query =  $this->db->query(
		"SELECT tbl_barang.id_barang, 
	   			tbl_barang.nama_barang,
	   			tbl_satuan.nama_satuan, 
	   			(SELECT tbl_barang.stok_awal + (IFNULL(sa_a.QTY_SA_IN, 0) + IFNULL(sa_c.QTY_SA_RETUR_IN, 0) - IFNULL(sa_b.QTY_SA_OUT, 0) - IFNULL(sa_d.QTY_SA_RETUR_OUT,0))) AS stok_awal,
	   			IFNULL(a.QTY_IN, 0) + IFNULL(c.QTY_RETUR_IN, 0)AS masuk,
	   			IFNULL(b.QTY_OUT, 0) + IFNULL(d.QTY_RETUR_OUT, 0) AS keluar,
	   			(SELECT tbl_barang.stok_awal + (IFNULL(sa_a.QTY_SA_IN, 0) + IFNULL(sa_c.QTY_SA_RETUR_IN, 0) - IFNULL(sa_b.QTY_SA_OUT, 0) - IFNULL(sa_d.QTY_SA_RETUR_OUT,0))) + IFNULL(a.QTY_IN, 0) + IFNULL(c.QTY_RETUR_IN, 0) - IFNULL(b.QTY_OUT, 0) - IFNULL(d.QTY_RETUR_OUT, 0) AS sisa_stok
		FROM tbl_barang
		LEFT JOIN tbl_satuan ON tbl_barang.id_satuan = tbl_satuan.id_satuan
		LEFT JOIN (
			SELECT tbl_trans_masuk_detail.id_barang, tbl_trans_masuk.tgl_trans_masuk, SUM( tbl_trans_masuk_detail.qty_masuk) AS QTY_SA_IN
			FROM tbl_trans_masuk_detail
    		LEFT JOIN tbl_trans_masuk ON tbl_trans_masuk_detail.id_trans_masuk = tbl_trans_masuk.id_trans_masuk
			WHERE tbl_trans_masuk.tgl_trans_masuk BETWEEN '1990-01-01' AND '".$tanggal_awal2."'
			GROUP BY tbl_trans_masuk_detail.id_barang ASC
		)as sa_a ON sa_a.id_barang = tbl_barang.id_barang

		LEFT JOIN (
			SELECT tbl_trans_keluar_detail.id_barang, tbl_trans_keluar.tgl_trans_keluar, SUM( tbl_trans_keluar_detail.qty_keluar) AS QTY_SA_OUT
			FROM tbl_trans_keluar_detail
		    LEFT JOIN tbl_trans_keluar ON tbl_trans_keluar_detail.id_trans_keluar = tbl_trans_keluar.id_trans_keluar
			WHERE tbl_trans_keluar.tgl_trans_keluar BETWEEN '1990-01-01' AND '".$tanggal_awal2."'
			GROUP BY tbl_trans_keluar_detail.id_barang ASC
		)as sa_b ON sa_b.id_barang = tbl_barang.id_barang

		LEFT JOIN (
			SELECT tbl_retur_masuk_detail.id_barang, tbl_retur_masuk.tgl_retur_masuk, SUM( tbl_retur_masuk_detail.qty_retur_masuk) AS QTY_SA_RETUR_IN
			FROM tbl_retur_masuk_detail
		    LEFT JOIN tbl_retur_masuk ON tbl_retur_masuk_detail.id_retur_masuk = tbl_retur_masuk.id_retur_masuk
			WHERE tbl_retur_masuk.tgl_retur_masuk BETWEEN '1990-01-01' AND '".$tanggal_awal2."'
			GROUP BY tbl_retur_masuk_detail.id_barang ASC
		)as sa_c ON sa_c.id_barang = tbl_barang.id_barang

		LEFT JOIN (
			SELECT tbl_retur_keluar_detail.id_barang, tbl_retur_keluar.tgl_retur_keluar, SUM( tbl_retur_keluar_detail.qty_retur_keluar) AS QTY_SA_RETUR_OUT
			FROM tbl_retur_keluar_detail
		    LEFT JOIN tbl_retur_keluar ON tbl_retur_keluar_detail.id_retur_keluar = tbl_retur_keluar.id_retur_keluar
			WHERE tbl_retur_keluar.tgl_retur_keluar BETWEEN '1990-01-01' AND '".$tanggal_awal2."'
			GROUP BY tbl_retur_keluar_detail.id_barang ASC
		)as sa_d ON sa_d.id_barang = tbl_barang.id_barang

		LEFT JOIN (
			SELECT tbl_trans_masuk_detail.id_barang, tbl_trans_masuk.tgl_trans_masuk, SUM( tbl_trans_masuk_detail.qty_masuk) AS QTY_IN
			FROM tbl_trans_masuk_detail
		    LEFT JOIN tbl_trans_masuk ON tbl_trans_masuk_detail.id_trans_masuk = tbl_trans_masuk.id_trans_masuk
			WHERE tbl_trans_masuk.tgl_trans_masuk BETWEEN '".$tanggal_awal."' AND '".$tanggal_akhir."'
			GROUP BY tbl_trans_masuk_detail.id_barang ASC
		)as a ON a.id_barang = tbl_barang.id_barang

		LEFT JOIN (
			SELECT tbl_trans_keluar_detail.id_barang, tbl_trans_keluar.tgl_trans_keluar, SUM( tbl_trans_keluar_detail.qty_keluar) AS QTY_OUT
			FROM tbl_trans_keluar_detail
		    LEFT JOIN tbl_trans_keluar ON tbl_trans_keluar_detail.id_trans_keluar = tbl_trans_keluar.id_trans_keluar
			WHERE tbl_trans_keluar.tgl_trans_keluar BETWEEN '".$tanggal_awal."' AND '".$tanggal_akhir."'
			GROUP BY tbl_trans_keluar_detail.id_barang ASC
		)as b ON b.id_barang = tbl_barang.id_barang

		LEFT JOIN (
			SELECT tbl_retur_masuk_detail.id_barang, tbl_retur_masuk.tgl_retur_masuk, SUM( tbl_retur_masuk_detail.qty_retur_masuk) AS QTY_RETUR_IN
			FROM tbl_retur_masuk_detail
		    LEFT JOIN tbl_retur_masuk ON tbl_retur_masuk_detail.id_retur_masuk = tbl_retur_masuk.id_retur_masuk
			WHERE tbl_retur_masuk.tgl_retur_masuk BETWEEN '".$tanggal_awal."' AND '".$tanggal_akhir."'
			GROUP BY tbl_retur_masuk_detail.id_barang ASC
		)as c ON c.id_barang = tbl_barang.id_barang

		LEFT JOIN (
			SELECT tbl_retur_keluar_detail.id_barang, tbl_retur_keluar.tgl_retur_keluar, SUM( tbl_retur_keluar_detail.qty_retur_keluar) AS QTY_RETUR_OUT
			FROM tbl_retur_keluar_detail
		    LEFT JOIN tbl_retur_keluar ON tbl_retur_keluar_detail.id_retur_keluar = tbl_retur_keluar.id_retur_keluar
			WHERE tbl_retur_keluar.tgl_retur_keluar BETWEEN '".$tanggal_awal."' AND '".$tanggal_akhir."'
			GROUP BY tbl_retur_keluar_detail.id_barang ASC
		)as d ON d.id_barang = tbl_barang.id_barang"
		);

        
        return $query->result();
       
	}

	public function get_detail_footer($id_user)
	{
		$this->db->select('nama_lengkap_user');
		$this->db->from('tbl_user_detail');
        $this->db->where('id_user', $id_user);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
	}
}