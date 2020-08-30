<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_dashboard extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
		//alternative load library from config
		$this->load->database();
	}

	public function get_barang()
	{
		$this->db->select('*');
		$this->db->from('tbl_barang');
		$this->db->where('status', 'aktif');

		$query = $this->db->get();
		return $query->result();
	}

	public function get_count_user()
	{
		$this->db->select('tbl_user.id_user, COUNT(tbl_user.id_user) AS jumlah_user');
		$this->db->from('tbl_user');
		$this->db->where('tbl_user.status', 'aktif');

		$query = $this->db->get();
		return $query->result();
	}

	public function get_count_user_level()
	{
		$this->db->select('tbl_user.id_user,tbl_level_user.level_user , count(tbl_level_user.id_level_user) AS jumlah_level');
		$this->db->from('tbl_user');
		$this->db->join('tbl_level_user', 'tbl_user.id_level_user = tbl_level_user.id_level_user', 'left');
		$this->db->where('tbl_user.status', 'aktif');
		$this->db->group_by('tbl_level_user.id_level_user');

		$query = $this->db->get();
		return $query->result();
	}

	public function get_count_barang()
	{
		$this->db->select('id_barang, nama_barang, stok_barang,COUNT(id_barang) AS jumlah_barang');
		$this->db->from('tbl_barang');
		$this->db->where('status', 'aktif');
		$this->db->order_by('stok_barang', 'desc');

		$query = $this->db->get();
		return $query->result();
	}

	public function get_stok_barang()
	{
		$this->db->select('tbl_barang.id_barang, tbl_barang.nama_barang, tbl_barang.stok_barang, tbl_satuan.nama_satuan');
		$this->db->from('tbl_barang');
		$this->db->join('tbl_satuan', 'tbl_barang.id_satuan = tbl_satuan.id_satuan', 'left');
		$this->db->where('tbl_barang.status', 'aktif');
		$this->db->order_by('tbl_barang.stok_barang', 'desc');
		$this->db->limit(5);

		$query = $this->db->get();
		return $query->result();
	}

	public function get_count_supplier()
	{
		$this->db->select('id_supplier, COUNT(id_supplier) AS jumlah_supplier');
		$this->db->from('tbl_supplier');
		$this->db->where('status', 'aktif');

		$query = $this->db->get();
		return $query->result();
	}

	public function get_pembelian_supplier()
	{
		$this->db->select('tbl_supplier.id_supplier, tbl_supplier.nama_supplier, COUNT(tbl_trans_beli.id_supplier) AS jumlah_pembelian');
		$this->db->from('tbl_supplier');
		$this->db->join('tbl_trans_beli', 'tbl_supplier.id_supplier = tbl_trans_beli.id_supplier', 'left');
		$this->db->where('tbl_supplier.status', 'aktif');
		$this->db->group_by('tbl_trans_beli.id_supplier');
		$this->db->order_by('jumlah_pembelian', 'desc');
		$this->db->limit(5);

		$query = $this->db->get();
		return $query->result();
	}

	public function get_count_borongan()
	{
		$this->db->select('id_borongan, COUNT(id_borongan) AS jumlah_borongan');
		$this->db->from('tbl_borongan');
		$this->db->where('status', 'aktif');

		$query = $this->db->get();
		return $query->result();
	}

	public function get_pengambilan_borongan()
	{
		$this->db->select('tbl_borongan.nama_borongan, tbl_borongan_detail.nama_borongan_detail, COUNT(tbl_trans_keluar.id_borongan_detail) AS jumlah_pengambilan');
		$this->db->from('tbl_borongan_detail');
		$this->db->join('tbl_borongan', 'tbl_borongan_detail.id_borongan = tbl_borongan.id_borongan', 'left');
		$this->db->join('tbl_trans_keluar', 'tbl_borongan_detail.id_borongan_detail = tbl_trans_keluar.id_borongan_detail', 'left');
		$this->db->group_by('tbl_trans_keluar.id_borongan_detail');
		$this->db->order_by('jumlah_pengambilan', 'desc');
		$this->db->limit(5);

		$query = $this->db->get();
		return $query->result();
	}

	public function get_count_order()
	{
		$this->db->select('id_trans_order, COUNT(id_trans_order) AS jumlah_order');
		$this->db->from('tbl_trans_order');

		$query = $this->db->get();
		return $query->result();
	}

	public function get_count_order_detail()
	{
		$this->db->select('tbl_barang.nama_barang, COUNT(tbl_trans_order_detail.id_barang) AS jumlah_order_detail');
		$this->db->from('tbl_trans_order_detail');
		$this->db->join('tbl_barang', 'tbl_trans_order_detail.id_barang = tbl_barang.id_barang', 'left');
		$this->db->group_by('tbl_trans_order_detail.id_barang');
		$this->db->order_by('jumlah_order_detail', 'desc');
		$this->db->limit(5);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_count_beli()
	{
		$this->db->select('id_trans_beli, COUNT(id_trans_beli) AS jumlah_beli');
		$this->db->from('tbl_trans_beli');

		$query = $this->db->get();
		return $query->result();
	}

	public function get_count_beli_detail()
	{
		$this->db->select('tbl_barang.nama_barang, COUNT(tbl_trans_beli_detail.id_barang) AS jumlah_beli_detail');
		$this->db->from('tbl_trans_beli_detail');
		$this->db->join('tbl_barang', 'tbl_trans_beli_detail.id_barang = tbl_barang.id_barang', 'left');
		$this->db->group_by('tbl_trans_beli_detail.id_barang');
		$this->db->order_by('jumlah_beli_detail', 'desc');
		$this->db->limit(5);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_count_masuk()
	{
		$this->db->select('id_trans_masuk, COUNT(id_trans_masuk) AS jumlah_masuk');
		$this->db->from('tbl_trans_masuk');

		$query = $this->db->get();
		return $query->result();
	}

	public function get_count_masuk_detail()
	{
		$this->db->select('tbl_barang.nama_barang, COUNT(tbl_trans_masuk_detail.id_barang) AS jumlah_masuk_detail');
		$this->db->from('tbl_trans_masuk_detail');
		$this->db->join('tbl_barang', 'tbl_trans_masuk_detail.id_barang = tbl_barang.id_barang', 'left');
		$this->db->group_by('tbl_trans_masuk_detail.id_barang');
		$this->db->order_by('jumlah_masuk_detail', 'desc');
		$this->db->limit(5);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function get_count_keluar()
	{
		$this->db->select('id_trans_keluar, COUNT(id_trans_keluar) AS jumlah_keluar');
		$this->db->from('tbl_trans_keluar');

		$query = $this->db->get();
		return $query->result();
	}

	public function get_count_keluar_detail()
	{
		$this->db->select('tbl_barang.nama_barang, COUNT(tbl_trans_keluar_detail.id_barang) AS jumlah_keluar_detail');
		$this->db->from('tbl_trans_keluar_detail');
		$this->db->join('tbl_barang', 'tbl_trans_keluar_detail.id_barang = tbl_barang.id_barang', 'left');
		$this->db->group_by('tbl_trans_keluar_detail.id_barang');
		$this->db->order_by('jumlah_keluar_detail', 'desc');
		$this->db->limit(5);
		$query = $this->db->get();
		return $query->result();
	}
}