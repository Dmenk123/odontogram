<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class T_mutasi extends CI_Model
{
	var $table = 't_mutasi';

	public function __construct()
	{
		parent::__construct();
		//alternative load library from config
		$this->load->database();
	}

	public function get_detail($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id', $id);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
	}
	
	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_by_condition($where, $is_single = false)
	{
		$this->db->from($this->table);
		$this->db->where($where);
		$query = $this->db->get();
		if($is_single) {
			return $query->row();
		}else{
			return $query->result();
		}
	}

	public function save($data)
	{
		return $this->db->insert($this->table, $data);	
	}

	public function update($where, $data)
	{
		return $this->db->update($this->table, $data, $where);
	}

	public function softdelete_by_id($id)
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$where = ['id' => $id];
		$data = ['deleted_at' => $timestamp];
		return $this->db->update($this->table, $data, $where);
	}

	public function cek_data_mutasi($id_reg, $id_jenis_trans, $id_trans_flag)
	{
		$this->db->select("m.*, md.id as id_mut_det, md.qty, md.harga, md.subtotal, md.id_trans_det_flag");
		$this->db->from($this->table.' m');
		$this->db->join('t_mutasi_det as md', 'm.id = md.id_mutasi', 'left');
		$this->db->where(['id_registrasi' => $id_reg, 'm.id_jenis_trans' => $id_jenis_trans, 'm.id_trans_flag' => $id_trans_flag, 'm.deleted_at' => null]);
		
		$query = $this->db->get();
		if($query){
			return $query->result();
		}else{
			return false;
		}
	
	}
}