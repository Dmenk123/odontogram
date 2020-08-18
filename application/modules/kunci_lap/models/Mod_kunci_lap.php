<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mod_kunci_lap extends CI_Model
{
	var $table = 'tbl_log_kunci';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function get_datatables($tahun)
	{
		$this->db->from($this->table);
		$this->db->where('tahun', $tahun);
		$query = $this->db->get();

		return $query->result();
	}

	public function cek_log_kunci($bulan, $tahun)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('bulan', $bulan);
		$this->db->where('tahun', $tahun);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->row();
		}else{
			return false;
		}
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	//============================================================

	public function get_detail($tipepeg, $bulan, $tahun, $confirm)
	{
		$this->db->select("
			tp.*,
			tg.nama as nama_guru,
			tj.nama as nama_jabatan
		");

		$this->db->from('tbl_penggajian tp');
		$this->db->join('tbl_guru tg', 'tp.id_guru = tg.id', 'left');
		$this->db->join('tbl_jabatan tj', 'tp.id_jabatan = tj.id', 'left');
		$this->db->where('tp.bulan', $bulan);
		$this->db->where('tp.tahun', $tahun);
		$this->db->where('tp.is_guru', $tipepeg);
		$this->db->where('tp.is_confirm', $confirm);
		$this->db->where('tp.is_aktif', 1);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
	}
	
	public function get_by_id($id)
	{
		$this->db->select("
			tp.*,
			tg.nama as nama_guru,
			tj.nama as nama_jabatan
		");

		$this->db->from('tbl_penggajian tp');
		$this->db->join('tbl_guru tg', 'tp.id_guru = tg.id', 'left');
		$this->db->join('tbl_jabatan tj', 'tp.id_jabatan = tj.id', 'left');
		$this->db->where('tp.id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($table, $data)
	{
		$this->db->insert($table, $data);
	}

	

	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}

	public function delete_data($table, $where)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}

	public function getKodeGajiOut($akronim)
    {
		$q = $this->db->query("select MAX(RIGHT(id_produk,5)) as kode_max from tbl_produk where id_produk like '%$akronim%'");
		$kd = "";
		if($q->num_rows()>0){
			foreach($q->result() as $hasil){
				$tmp = ((int)$hasil->kode_max)+1;
				$kd = sprintf("%05s", $tmp);
			}
		}else{
			$kd = "00001";
		}
		return "$akronim".$kd;
    }

	public function lookup_kode_guru($keyword="")
	{
		$this->db->select('*');
		$this->db->from('tbl_guru');
		$this->db->where('is_aktif', 1);
		$this->db->like('nama',$keyword);
		$this->db->order_by('nama', 'asc');
		
		$query = $this->db->get();
		return $query->result();
	}

	public function cek_exist_gaji($where)
	{
		$this->db->select('id, id_guru');
		$this->db->from($this->table);
		$this->db->where($where);
		$query = $this->db->get();

        if ($query->num_rows() > 0) {
            return TRUE;
        }else{
        	return FALSE;
        }
	}
}