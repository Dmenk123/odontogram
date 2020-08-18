<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mod_lap_history_beli extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//alternative load library from config
		$this->load->database();
	}

	public function get_detail_supplier($data_list, $tanggal_awal, $tanggal_akhir)
	{
		$query =  $this->db->query(
		"SELECT tbl_trans_beli_detail.id_trans_beli,tbl_trans_beli.tgl_trans_beli, tbl_barang.id_barang, tbl_barang.nama_barang, tbl_satuan.nama_satuan,tbl_supplier.id_supplier, tbl_supplier.nama_supplier, tbl_trans_beli_detail.qty_beli, tbl_trans_masuk.tgl_trans_masuk
		FROM tbl_trans_beli
		LEFT JOIN tbl_trans_beli_detail ON tbl_trans_beli_detail.id_trans_beli = tbl_trans_beli.id_trans_beli
		LEFT JOIN tbl_barang ON tbl_trans_beli_detail.id_barang = tbl_barang.id_barang 
		LEFT JOIN tbl_satuan ON tbl_trans_beli_detail.id_satuan = tbl_satuan.id_satuan 
		LEFT JOIN tbl_supplier ON tbl_trans_beli.id_supplier = tbl_supplier.id_supplier
		LEFT JOIN tbl_trans_masuk ON tbl_trans_beli_detail.id_trans_masuk = tbl_trans_masuk.id_trans_masuk
		WHERE tbl_supplier.id_supplier = '".$data_list."' AND tbl_trans_beli.tgl_trans_beli BETWEEN '".$tanggal_awal."' AND '".$tanggal_akhir."' ORDER BY tbl_trans_beli_detail.tgl_trans_beli_detail ASC"
		);

        if ($query->num_rows() > 0) {
            return $query->result();
        }
	}

	public function get_detail_barang($data_list, $tanggal_awal, $tanggal_akhir)
	{
		$query =  $this->db->query(
		"SELECT tbl_trans_beli_detail.id_trans_beli,tbl_trans_beli.tgl_trans_beli, tbl_barang.id_barang, tbl_barang.nama_barang, tbl_satuan.nama_satuan,tbl_supplier.id_supplier, tbl_supplier.nama_supplier, tbl_trans_beli_detail.qty_beli, tbl_trans_masuk.tgl_trans_masuk
		FROM tbl_trans_beli
		LEFT JOIN tbl_trans_beli_detail ON tbl_trans_beli_detail.id_trans_beli = tbl_trans_beli.id_trans_beli
		LEFT JOIN tbl_barang ON tbl_trans_beli_detail.id_barang = tbl_barang.id_barang 
		LEFT JOIN tbl_satuan ON tbl_trans_beli_detail.id_satuan = tbl_satuan.id_satuan 
		LEFT JOIN tbl_supplier ON tbl_trans_beli.id_supplier = tbl_supplier.id_supplier
		LEFT JOIN tbl_trans_masuk ON tbl_trans_beli_detail.id_trans_masuk = tbl_trans_masuk.id_trans_masuk
		WHERE tbl_barang.id_barang = '".$data_list."' AND tbl_trans_beli.tgl_trans_beli BETWEEN '".$tanggal_awal."' AND '".$tanggal_akhir."' ORDER BY tbl_trans_beli_detail.tgl_trans_beli_detail ASC"
		);

        if ($query->num_rows() > 0) {
            return $query->result();
        }
	}

	public function lookup_data_barang($keyword = "")
	{
		$this->db->select('id_barang, nama_barang');
		$this->db->from('tbl_barang');
		$this->db->where('status','aktif');
		$this->db->like('nama_barang',$keyword);
		$this->db->limit(10);
		$this->db->order_by('nama_barang', 'ASC');
		//$this->db->group_by('id_trans_beli');
		$query = $this->db->get();
		return $query->result();
	}

	public function lookup_data_supplier($keyword = "")
	{
		$this->db->select('id_supplier, nama_supplier');
		$this->db->from('tbl_supplier');
		$this->db->where('status','aktif');
		$this->db->like('nama_supplier',$keyword);
		$this->db->limit(10);
		$this->db->order_by('nama_supplier', 'ASC');
		//$this->db->group_by('id_trans_beli');
		$query = $this->db->get();
		return $query->result();
	}
}