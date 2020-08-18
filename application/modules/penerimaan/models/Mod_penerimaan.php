<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mod_Penerimaan extends CI_Model
{
	var $column_search = array(
		"tm.id",
		"tm.tanggal",
		"tud.nama_lengkap_user"
	);

	var $column_order = array(
		"tm.id",
		"tm.tanggal",
		"tud.nama_lengkap_user",
		null,
	);

	var $order = array('tr.id_pembelian' => 'desc'); // default order

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query($term='', $status, $tanggal_awal, $tanggal_akhir)
	{		
		if ($status == 1) {
			$column_search = array(
				"tv.id as id_verifikasi",
				"tm.id",
				"tm.tanggal",
				"tud.nama_lengkap_user"
			);

			$column_order = array(
				"tv.id as id_verifikasi",
				"tm.id",
				"tm.tanggal",
				"tud.nama_lengkap_user",
				null,
			);

			$column = array(
				"tv.id as id_verifikasi",
				"tm.id",
				"tm.tanggal",
				"tud.nama_lengkap_user",
				null,
			);

			$this->db->select("
				tm.id,
				tv.id as id_verifikasi,
				tm.user_id,
				tud.nama_lengkap_user,
				tm.tanggal,
				tm.status,
				tm.created_at,
				tm.updated_at
			");
		}
		else
		{
			$column = array(
				"tm.id",
				"tm.tanggal",
				"tud.nama_lengkap_user",
				null,
			);

			$this->db->select("
				tm.id,
				tm.user_id,
				tud.nama_lengkap_user,
				tm.tanggal,
				tm.status,
				tm.created_at,
				tm.updated_at
			");
		}
		
		
		$this->db->from('tbl_trans_masuk as tm');
		$this->db->join('tbl_user as tu', 'tm.user_id = tu.id_user', 'left');
		$this->db->join('tbl_user_detail as tud', 'tu.id_user = tud.id_user', 'left');
		if ($status == 1) {
			$this->db->join('tbl_verifikasi tv', 'tm.id = tv.id_in');
		}
		$this->db->where('tm.status', $status);
		$this->db->where("tm.tanggal between '".$tanggal_awal."' and '".$tanggal_akhir."'");
		
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

	function get_datatables($status = 0, $tanggal_awal, $tanggal_akhir)
	{
		$term = $_REQUEST['search']['value'];
		$this->_get_datatables_query($term, $status, $tanggal_awal, $tanggal_akhir);

		if($_REQUEST['length'] != -1)
		$this->db->limit($_REQUEST['length'], $_REQUEST['start']);

		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered($status, $tanggal_awal, $tanggal_akhir)
	{
		$term = $_REQUEST['search']['value'];
		$this->_get_datatables_query($term, $status, $tanggal_awal, $tanggal_akhir);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all($status, $tanggal_awal, $tanggal_akhir)
	{
		if ($status == 1) {
			$this->db->select("
				tm.id,
				tv.id as id_verifikasi,
				tm.user_id,
				tud.nama_lengkap_user,
				tm.tanggal,
				tm.status,
				tm.created_at,
				tm.updated_at
			");
		}else{
			$this->db->select("
				tm.id,
				tm.user_id,
				tud.nama_lengkap_user,
				tm.tanggal,
				tm.status,
				tm.created_at,
				tm.updated_at
			");
		}
		

		$this->db->from('tbl_trans_masuk as tm');
		$this->db->join('tbl_user as tu', 'tm.user_id = tu.id_user', 'left');
		$this->db->join('tbl_user_detail as tud', 'tu.id_user = tud.id_user', 'left');
		if ($status == 1) {
			$this->db->join('tbl_verifikasi tv', 'tm.id = tv.id_in');
		}
		$this->db->where('tm.status', $status);
		$this->db->where("tm.tanggal between '".$tanggal_awal."' and '".$tanggal_akhir."'");
		return $this->db->count_all_results();
	}

	public function save($data_header=null, $data_detail=null, $data_verifikasi=null)
	{ 
		if ($data_header != null) {
			$this->db->insert('tbl_trans_masuk',$data_header);
		}
		
		if ($data_detail != null) {
			$this->db->insert('tbl_trans_masuk_detail',$data_detail);
		}

		if ($data_verifikasi != null) {
			$this->db->insert('tbl_verifikasi',$data_verifikasi);
		}
	}

	function getKodePenerimaan(){
		$q = $this->db->query("SELECT MAX(RIGHT(id,5)) as kode_max from tbl_trans_masuk WHERE DATE_FORMAT(tanggal, '%Y-%m') = DATE_FORMAT(CURRENT_DATE(), '%Y-%m')");
		$kd = "";
		if($q->num_rows()>0){
			foreach($q->result() as $k){
				$tmp = ((int)$k->kode_max)+1;
				$kd = sprintf("%05s", $tmp);
			}
		}else{
			$kd = "00001";
		}
		return "MSK".date('my').$kd;
	}
	
	function getKodePenerimaanDetail(){
		$q = $this->db->query("SELECT MAX(id) as kode_detail from tbl_trans_masuk_detail")->row();
		if ($q) {
			$kode = (int)$q->kode_detail + 1;
		}else{
			$kode = 1;
		}

		return $kode;
    }

	public function get_detail_header($id)
	{
		$this->db->select('tm.*,tud.nama_lengkap_user');
		$this->db->from('tbl_trans_masuk tm');
		$this->db->join('tbl_user tu', 'tm.user_id = tu.id_user','left');
		$this->db->join('tbl_user_detail tud', 'tu.id_user = tud.id_user', 'left');
        $this->db->where('tm.id', $id);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
	}

	public function get_detail($id_header, $edit='')
	{
		if ($edit == '') {
			$this->db->select('tmd.*, tv.*, ts.nama as nama_satuan');
			$this->db->from('tbl_trans_masuk_detail tmd');
			$this->db->join('tbl_satuan ts', 'tmd.satuan = ts.id','left');
			$this->db->join('tbl_verifikasi tv', 'tv.id_in = tmd.id_trans_masuk');
		}else{
			$this->db->select('tm.*, tmd.id as id_detail, tmd.id_trans_masuk, tmd.keterangan, tmd.satuan, tmd.qty, ts.nama as nama_satuan');
			$this->db->from('tbl_trans_masuk tm');
			$this->db->join('tbl_trans_masuk_detail tmd', 'tm.id = tmd.id_trans_masuk');
			$this->db->join('tbl_satuan ts', 'tmd.satuan = ts.id','left');
		}
				
        $this->db->where('tmd.id_trans_masuk', $id_header);

        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            if ($edit = '') {
            	return $query->result();
            }else{
            	return $query->row();
            }
        }
	}

	public function update_data($where, $data, $table)
	{
		$this->db->update($table, $data, $where);
		return $this->db->affected_rows();
	}

	public function insert_update($data_order_detail)
	{
		$this->db->insert_batch('tbl_trans_keluar_detail',$data_order_detail);
	}

	public function delete_by_id($where, $table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}

	// ============================================================================================
	

	public function lookup($keyword)
	{
		$this->db->select('tbl_barang.nama_barang,tbl_barang.id_barang,tbl_satuan.id_satuan,tbl_satuan.nama_satuan,tbl_barang.status');
		$this->db->from('tbl_barang');
		$this->db->join('tbl_satuan','tbl_barang.id_satuan = tbl_satuan.id_satuan','left');
		$this->db->like('tbl_barang.nama_barang',$keyword);
		$this->db->where('tbl_barang.status', 'aktif');
		$this->db->limit(5);
		$query = $this->db->get();
		return $query->result();
	}

	public function lookup2($rowIdBrg)
	{
		$this->db->select('tbl_barang.nama_barang, tbl_satuan.id_satuan, tbl_satuan.nama_satuan, tbl_barang.status');
		$this->db->from('tbl_barang');
		$this->db->join('tbl_satuan','tbl_barang.id_satuan = tbl_satuan.id_satuan','left');
		$this->db->where('tbl_barang.id_barang',$rowIdBrg);
		$query = $this->db->get();
		return $query->result();
	}

}