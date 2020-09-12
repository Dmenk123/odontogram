<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_pasien extends CI_Model
{
	var $table = 'm_pasien';
	var $column_search = [
		'no_rm',
		'nama',
		'nik',
		'jenkel',
		'alamat_rumah',
		'hp',
		'status_pasien'
	];
	
	var $column_order = [
		'no_rm',
		'nama',
		'nik',
		'jenis_kelamin',
		'alamat_rumah',
		'hp',
		'is_aktif',
		null
	];

	var $order = ['no_rm' => 'asc']; 

	public function __construct()
	{
		parent::__construct();
		//alternative load library from config
		$this->load->database();
	}

	private function _get_datatables_query($term='')
	{
		$this->db->select("*, CASE WHEN is_aktif = 1 THEN 'Aktif' ELSE 'Non Aktif' END as status_pasien, CASE WHEN jenis_kelamin = 'L' THEN 'Laki-Laki' ELSE 'Perempuan' END as jenkel");
		$this->db->from($this->table);
		$this->db->where('deleted_at is null');
		
		$i = 0;

		// loop column 
		foreach ($this->column_search as $item) 
		{
			// if datatable send POST for search
			if($_POST['search']['value']) 
			{
				// first loop
				if($i===0) 
				{
					// open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					if($item == 'status_pasien') {
						/**
						 * param both untuk wildcard pada awal dan akhir kata
						 * param false untuk disable escaping (karena pake subquery)
						 */
						$this->db->or_like('(CASE WHEN is_aktif = 1 THEN \'Aktif\' ELSE \'Non Aktif\' END)', $_POST['search']['value'],'both',false);
					}elseif($item == 'jenkel'){
						$this->db->or_like('(CASE WHEN jenis_kelamin = \'L\' THEN \'Laki-Laki\' ELSE \'Perempuan\' END)', $_POST['search']['value'],'both',false);
					}
					else{
						$this->db->or_like($item, $_POST['search']['value']);
					}
				}
				//last loop
				if(count($this->column_search) - 1 == $i) 
					$this->db->group_end(); //close bracket
			}
			$i++;
		}

		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		if(isset($_POST['order']) && $_POST['order']['0']['column'] != '0') 
		{
			$order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
		}

	}

	function get_datatable_pasien()
	{
		$term = $_REQUEST['search']['value'];
		$this->_get_datatables_query($term);
		if($_REQUEST['length'] != -1)
		$this->db->limit($_REQUEST['length'], $_REQUEST['start']);

		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
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

	function get_kode_rm($str){
		// $q = $this->db->query("select MAX(RIGHT(no_rm,6)) as kode_max from ".$this->table."");
		$q = $this->db->query("select REPLACE(MAX(RIGHT(no_rm,6)),'.','') as kode_max from ".$this->table."	where no_rm like '".$str."%'");
		$kd_fix = "";
		if($q->num_rows()>0){
			foreach($q->result() as $k){
				$tmp = ((int)$k->kode_max)+1;
				//memberi tambahan padding angka 0 dalam 4 string 
				$kd = sprintf("%04s", $tmp); 
				// insert string pada huruf ke dua dan param 0 (false untuk hapus lanjutannya)
				$kd_fix = substr_replace($kd,".",2,0);
			}
		}else{
			$kd_fix = "00.01";
		}
		return $str.'.'.$kd_fix;
	}
	
	public function get_max_id_pasien()
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

	public function get_id_pegawai_by_name($nama)
	{
		$this->db->select('id');
		$this->db->from('m_pegawai');
		$this->db->where('LCASE(nama)', $nama);
		$q = $this->db->get();
		if ($q) {
			return $q->row();
		}else{
			return false;
		}
	}

	public function get_id_role_by_name($nama)
	{
		$this->db->select('id');
		$this->db->from('m_role');
		$this->db->where('LCASE(nama)', $nama);
		$q = $this->db->get();
		if ($q) {
			return $q->row();
		}else{
			return false;
		}
	}

	public function trun_master_user()
	{
		$this->db->query("truncate table m_user");
	}
}