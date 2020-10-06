<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class T_rekam_medik extends CI_Model
{
	var $table = 't_rekam_medik';
	
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

	public function save($data, $table=null)
	{
		if($table == null) {
			return $this->db->insert($this->table, $data);	
		}else{
			return $this->db->insert($table, $data);	
		}
	}

	public function update($where, $data, $table=null)
	{
		if($table == null) {
			return $this->db->update($this->table, $data, $where);
		}else{
			return $this->db->update($table, $data, $where);
		}
	}

	public function softdelete_by_id($id)
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$where = ['id' => $id];
		$data = ['deleted_at' => $timestamp];
		return $this->db->update($this->table, $data, $where);
	}

	function get_kode_reg(){
		$q = $this->db->query("select REPLACE(MAX(RIGHT(no_reg,15)),'.','') as kode_max from ".$this->table."");
		$kd_fix = "";
		if($q->num_rows()>0){
			foreach($q->result() as $k){
				$tmp = ((int)$k->kode_max)+1;
				//memberi tambahan padding angka 0 dalam 12 string 
				$kd = sprintf("%012s", $tmp);
				// insert string pada huruf ke dua dan param 0 (false untuk hapus lanjutannya)
				for ($i=3; $i <= 9; $i+=3) { 
					if($i == 3){
						$kd_fix = substr_replace($kd,".",$i,0);
					}else if($i == 6){
						$kd_fix = substr_replace($kd_fix,".",$i+1,0);
					}else{
						$kd_fix = substr_replace($kd_fix,".",$i+2,0);
					}
				}
			}
		}else{
			$kd_fix = "000.000.000.001";
		}

		return $kd_fix;
	}

	public function get_max_id_perawatan()
	{
		$q = $this->db->query("SELECT MAX(id) as kode_max from t_perawatan");
		$kd = "";
		if($q->num_rows()>0){
			$kd = $q->row();
			return (int)$kd->kode_max + 1;
		}else{
			return '1';
		} 
	}

	public function get_max_id()
	{
		$q = $this->db->query("SELECT MAX(id) as kode_max from ".$this->table."");
		$kd = "";
		if($q->num_rows()>0){
			$kd = $q->row();
			return (int)$kd->kode_max + 1;
		}else{
			return '1';
		} 
	}

	public function get_data_ekspor($tgl_awal = false, $tgl_akhir = false, $id = false)
	{
		$this->db->select("reg.id, reg.no_reg, reg.tanggal_reg, reg.jam_reg, reg.tanggal_pulang, reg.jam_pulang, reg.is_pulang, reg.is_asuransi, reg.id_asuransi, reg.umur, reg.no_asuransi, psn.nama as nama_pasien, psn.no_rm, psn.tanggal_lahir, psn.tempat_lahir, psn.nik, psn.jenis_kelamin, 
		peg.nama as nama_dokter, asu.nama as nama_asuransi, asu.keterangan, pem.keterangan, CASE WHEN reg.is_asuransi = 1 THEN 'Asuransi' ELSE 'Umum' END as penjamin, CASE WHEN psn.jenis_kelamin = 'L' THEN 'Laki-Laki' ELSE 'Perempuan' END as jenkel");
		$this->db->from($this->table.' reg');
		$this->db->join('m_pasien psn', 'reg.id_pasien = psn.id', 'left');
		$this->db->join('m_pegawai peg', 'reg.id_pegawai = peg.id', 'left');
		$this->db->join('m_asuransi asu', 'reg.id_asuransi = asu.id', 'left');
		$this->db->join('m_pemetaan pem', 'reg.id_pemetaan = pem.id', 'left');
		$this->db->where('reg.deleted_at is null');
		
		if($id) {
			$this->db->where('reg.id', $id);
		}
		
		if($tgl_awal == true && $tgl_akhir == true) {
			$this->db->where('reg.tanggal_reg >=', $tgl_awal);
			$this->db->where('reg.tanggal_reg <=', $tgl_akhir);
		} 
		
		$query = $this->db->get();

		if($id) {
			return $query->row();
		}else{
			return $query->result();
		}
	}
}