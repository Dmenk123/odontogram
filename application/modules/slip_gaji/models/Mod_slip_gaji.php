<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mod_slip_gaji extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//alternative load library from config
		$this->load->database();
	}

	public function get_detail($bulan, $tahun, $id_user=null)
	{ 
		$this->db->select('
			tp.*, tg.nama as nama_guru, tg.nip, tj.nama as nama_jabatan
		');
		$this->db->from('tbl_penggajian as tp');
		$this->db->join('tbl_guru tg', 'tp.id_guru = tg.id', 'left');
		$this->db->join('tbl_jabatan tj', 'tp.id_jabatan = tj.id', 'left');
		if ($id_user == null) {
			$this->db->where([
				'tp.bulan' => $bulan,
				'tp.tahun' => $tahun,
				'tp.is_confirm' => 1,
				'tp.is_aktif' => 1
			]);
		}else{
			$this->db->where([
				'tp.bulan' => $bulan,
				'tp.tahun' => $tahun,
				'tp.is_confirm' => 1,
				'tp.is_aktif' => 1,
				'tg.nip' => $id_user
			]);
		}
		
		$this->db->order_by('tg.nama', 'asc');
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}
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

	public function get_by_id($id)
	{
		$this->db->select('tbl_penggajian.*, tbl_guru.nama as nama_guru');
		$this->db->from('tbl_penggajian');
		$this->db->join('tbl_guru', 'tbl_penggajian.id_guru = tbl_guru.id', 'left');
		$this->db->where([
			'tbl_penggajian.id' => $id,
			'tbl_penggajian.is_confirm' => 1,
			'tbl_penggajian.is_aktif' => 1
		]);
		return $query = $this->db->get()->row_array();
	}
}