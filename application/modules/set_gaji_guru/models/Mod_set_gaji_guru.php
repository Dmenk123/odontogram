<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mod_set_gaji_guru extends CI_Model
{
	var $table = 'tbl_set_gaji';
	var $column_order = array('tbl_jabatan.nama','tbl_set_gaji.gaji_pokok','tbl_set_gaji.gaji_perjam', 'tbl_set_gaji.gaji_tunjangan_jabatan', null); //set column field database for datatable orderable
	var $column_search = array('tbl_jabatan.nama','tbl_set_gaji.gaji_pokok','tbl_set_gaji.gaji_perjam', 'tbl_set_gaji.gaji_tunjangan_jabatan'); //set column field database for datatable searchable just username are searchable
	var $order = array('tbl_jabatan.nama' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		$column = array(
			"tbl_jabatan.nama",
			"tbl_set_gaji.gaji_pokok",
			"tbl_set_gaji.gaji_perjam",
			"tbl_set_gaji.gaji_tunjangan_jabatan",
			null,
		);
		
		$this->db->select("
			tbl_set_gaji.*,
			tbl_jabatan.nama as nama_jabatan
		");

		$this->db->from('tbl_set_gaji');
		$this->db->join('tbl_jabatan', 'tbl_set_gaji.id_jabatan = tbl_jabatan.id', 'left');
		$this->db->where('tbl_set_gaji.is_aktif', 1);
		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
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
		$this->db->select("
			tbl_set_gaji.*,
			tbl_jabatan.nama as nama_jabatan
		");

		$this->db->from('tbl_set_gaji');
		$this->db->join('tbl_jabatan', 'tbl_set_gaji.id_jabatan = tbl_jabatan.id', 'left');
		$this->db->where('tbl_jabatan.is_aktif', 1);
		return $this->db->count_all_results();
	}

	public function get_detail_user($id_user)
	{
		$this->db->select('*');
		$this->db->from('tbl_user_detail');
		$this->db->where('id_user', $id_user);

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

	public function save($data)
	{
		$this->db->insert($this->table, $data);
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}

	public function lookup_kode_jabatan($keyword="")
	{
		$this->db->select('*');
		$this->db->from('tbl_jabatan');
		$this->db->like('nama',$keyword);
		$this->db->order_by('nama', 'asc');
		
		$query = $this->db->get();
		return $query->result();
	}
}