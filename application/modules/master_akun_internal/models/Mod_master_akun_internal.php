<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mod_master_akun_internal extends CI_Model
{
	var $table = 'tbl_master_kode_akun_internal';
	var $column_order = array('tmkai.nama','tmkai.kode_in_text',null); //set column field database for datatable orderable
	var $column_search = array('tmkai.nama','tmkai.kode_in_text'); //set column field database for datatable searchable just username are searchable
	/* var $order = array(
		'tmkai.kode' => 'asc',
		'tmkai.sub_1' => 'asc',
		'tmkai.sub_2' => 'asc',
		'tmkai.nama' => 'asc'
	); // default order  */

	var $order = array('tmkai.kode, tmkai.sub_1, tmkai.sub_2, tmkai.nama'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query($term='') //term is value of $_REQUEST['search']
	{
		$column = array(
			"tmkai.nama",
			"tblsub.nama as nama_sub",
			"tmkai.kode_in_text",
			null,
		);
		
		$this->db->select("
			tmkai.*,
			tblsub.nama as nama_sub
		");
		
		$this->db->from('tbl_master_kode_akun_internal as tmkai');
		$this->db->join(
			'(SELECT tbl_master_kode_akun_internal.*
			  FROM tbl_master_kode_akun_internal
              WHERE sub_1 is null and sub_2 is null) tblsub','tmkai.kode_in_text = tblsub.kode_in_text', 'left'
		);
		$this->db->where('tmkai.is_aktif', 1);
		$this->db->order_by('tmkai.kode , tmkai.sub_1 , tmkai.sub_2 , tmkai.nama');

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

	public function lookup_kode_akun_internal($keyword="")
	{
		$this->db->select('*');
		$this->db->from('tbl_master_kode_akun_internal');
		$this->db->like('nama',$keyword);
		$this->db->where('sub_1 is null');
		$this->db->where('sub_2 is null');
		$this->db->order_by('kode, sub_1, sub_2', 'asc');
		
		$query = $this->db->get();
		return $query->result();
	}

	public function lookup_kode_akun_external($keyword="")
	{
		$this->db->select('*');
		$this->db->from('tbl_master_kode_akun');
		$this->db->like('nama',$keyword);
		$this->db->where('is_aktif', '1');
		$this->db->order_by('kode, sub_1, sub_2', 'asc');
		
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
		$this->db->insert('tbl_master_kode_akun_internal',$data);
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