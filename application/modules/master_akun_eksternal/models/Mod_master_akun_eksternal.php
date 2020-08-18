<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mod_master_akun_eksternal extends CI_Model
{
	var $table = 'tbl_master_kode_akun';
	var $column_order = array('tmka.nama','tmka.kode_in_text',null); //set column field database for datatable orderable
	var $column_search = array('tmka.nama','tmka.kode_in_text'); //set column field database for datatable searchable
	var $order = array('tmka.tipe, tmka.sub_1, tmka.sub_2, tmka.kode, tmka.nama'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query($term='') //term is value of $_REQUEST['search']
	{
		$column = array(
			"tmka.nama",
			"tblsub.nama as nama_sub",
			"tmka.kode_in_text",
			null,
		);
		
		$this->db->select("
			tmka.*,
			tblsub.nama as nama_sub
		");
		
		$this->db->from('tbl_master_kode_akun as tmka');
		$this->db->join(
			'(SELECT tbl_master_kode_akun.*
			  FROM tbl_master_kode_akun
              WHERE sub_1 is null and sub_2 is null) tblsub','tmka.kode_in_text = tblsub.kode_in_text', 'left'
		);
		$this->db->where('tmka.is_aktif', 1);
		$this->db->order_by('tmka.tipe, tmka.kode, tmka.sub_1, tmka.sub_2');

		$i = 0;
		foreach ($this->column_search as $item) 
		{
			if($_POST['search']['value']) 
			{
				if($i===0) 
				{
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if(count($this->column_search) - 1 == $i) 
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
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function lookup_kode_akun($keyword="")
	{
		$this->db->select('*');
		$this->db->from('tbl_master_kode_akun');
		$this->db->like('nama',$keyword);
		$this->db->where('sub_1 is null');
		$this->db->where('sub_2 is null');
		$this->db->where('is_aktif', 1);
		$this->db->order_by('tipe, sub_1, sub_2, kode', 'asc');
		
		$query = $this->db->get();
		return $query->result();
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
	
	public function get_by_id($kode_in_text)
	{
		$this->db->from($this->table);
		$this->db->where('kode_in_text',$kode_in_text);
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