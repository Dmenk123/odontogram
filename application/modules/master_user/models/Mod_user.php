<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mod_user extends CI_Model
{
	var $table = 'tbl_user';

	var $column_order = array(
		null,
		"tu.id_user",
		"tu.username",
		"tl.nama_level_user",
		"tud.nama_lengkap_user",
		null,
	); //set column field database for datatable orderable
	var $column_search = array(
		"tu.id_user",
		"tu.username",
		"tl.nama_level_user",
		"tud.nama_lengkap_user"
	);
	var $order = array('username' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		
		//$this->db->from($this->table);
		$column = array(
			"tu.id_user",
			"tu.username",
			"tl.nama_level_user",
			"tud.nama_lengkap_user",
			null,
		);
		
		$this->db->select("
			tu.*, tud.id_user_detail, tud.nama_lengkap_user, tud.alamat_user, tud.thumb_gambar_user, tl.nama_level_user
		");
		$this->db->from('tbl_user as tu');
		$this->db->join('tbl_user_detail as tud', 'tu.id_user = tud.id_user', 'left');
		$this->db->join('tbl_level_user tl', 'tu.id_level_user = tl.id_level_user', 'left');
		$this->db->where('tu.status', 1);
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
			tu.*, tud.id_user_detail, tud.nama_lengkap_user, tud.alamat_user, tud.thumb_gambar_user, tl.nama_level_user
		");
		$this->db->from('tbl_user as tu');
		$this->db->join('tbl_user_detail as tud', 'tu.id_user = tud.id_user', 'left');
		$this->db->join('tbl_level_user tl', 'tu.id_level_user = tl.id_level_user', 'left');
		$this->db->where('tu.status', 1);
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

	public function get_detail_user($id_user)
	{
		$this->db->select("
			tu.*, 
			tud.id_user_detail,
			tud.nama_lengkap_user,
			tud.alamat_user,
			tud.tanggal_lahir_user,
			tud.jenis_kelamin_user,
			tud.no_telp_user,
			tud.gambar_user,
			tud.thumb_gambar_user, 
			tl.nama_level_user
		");
		$this->db->from('tbl_user as tu');
		$this->db->join('tbl_user_detail as tud', 'tu.id_user = tud.id_user', 'left');
		$this->db->join('tbl_level_user tl', 'tu.id_level_user = tl.id_level_user', 'left');
		$this->db->where([
			'tu.status' => 1,
			'tu.id_user' => $id_user
		]);

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

	public function save($table, $data)
	{
		$this->db->insert($table, $data);
	}

	public function update($table, $where, $data)
	{
		$this->db->update($table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}

	public function get_detail_pegawai($nip)
	{
		$this->db->select('*');
		$this->db->from('tbl_guru');
		$this->db->where('nip', $nip);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        }
	}
}