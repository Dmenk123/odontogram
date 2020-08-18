<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mod_guru extends CI_Model
{
	var $table = 'tbl_guru';
	var $column_order = array(
		"tg.nip",
		"tg.nama",
		"tj.nama",
		null,
	); //set column field database for datatable orderable
	var $column_search = array(
		"tg.nip",
		"tg.nama",
		"tj.nama"
	); //set column field database for datatable searchable just username are searchable
	var $order = array('nama' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		
		//$this->db->from($this->table);
		$column = array(
			"tg.nip",
			"tg.nama",
			"tj.nama",
			null,
		);
		
		$this->db->select("tg.*, tj.nama as nama_jabatan");
		$this->db->from('tbl_guru as tg');
		$this->db->join('tbl_jabatan as tj', 'tg.kode_jabatan = tj.id', 'left');
		$this->db->where('tg.is_aktif', 1);
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
		$this->db->select("tg.*, tj.nama as nama_jabatan");
		$this->db->from('tbl_guru as tg');
		$this->db->join('tbl_jabatan as tj', 'tg.kode_jabatan = tj.id', 'left');
		$this->db->where('tg.is_aktif', 1);
		return $this->db->count_all_results();
	}

	public function lookup_kode_jabatan($keyword="")
	{
		$this->db->select('*');
		$this->db->from('tbl_jabatan');
		$this->db->like('nama',$keyword);
		$this->db->where('is_aktif', 1);
		$this->db->order_by('nama', 'asc');
		
		$query = $this->db->get();
		return $query->result();
	}

	public function get_detail_guru($id_guru)
	{
		$this->db->select('tbl_guru.*, tbl_jabatan.nama as nama_jabatan');
		$this->db->from('tbl_guru');
		$this->db->join('tbl_jabatan', 'tbl_guru.kode_jabatan = tbl_jabatan.id', 'left');
		$this->db->where('tbl_guru.id', $id_guru);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
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
}