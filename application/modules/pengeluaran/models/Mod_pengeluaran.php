<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mod_pengeluaran extends CI_Model
{
	var $column_search = array(
		"tk.id",
		"tk.tanggal",
		"tu.username",
		"tk.pemohon"
	);

	var $column_order = array(
		"tk.id",
		"tk.tanggal",
		"tu.username",
		"tk.pemohon",
		null,
	);

	var $order = array('tk.tanggal' => 'desc'); // default order

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query($tanggal_awal, $tanggal_akhir, $term='') //term is value of $_REQUEST['search']
	{
		$column = array(
			"tk.id",
			"tk.tanggal",
			"tu.username",
			"tk.pemohon",
			null,
		);
		
		$this->db->select("
			tk.id,
			tk.user_id,
			tu.username,
			tk.pemohon,
			tk.tanggal,
			tk.status,
			tk.created_at,
			tk.updated_at
		");
		
		$this->db->from('tbl_trans_keluar as tk');
		$this->db->join('tbl_user as tu', 'tk.user_id = tu.id_user', 'left');
		$this->db->where("tk.tanggal between '".$tanggal_awal."' and '".$tanggal_akhir."'");
		
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

	function get_datatables($tanggal_awal, $tanggal_akhir)
	{
		$term = $_REQUEST['search']['value'];
		$this->_get_datatables_query($tanggal_awal, $tanggal_akhir, $term);

		if($_REQUEST['length'] != -1)
		$this->db->limit($_REQUEST['length'], $_REQUEST['start']);

		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered($tanggal_awal, $tanggal_akhir)
	{
		$term = $_REQUEST['search']['value'];
		$this->_get_datatables_query($tanggal_awal, $tanggal_akhir, $term);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all($tanggal_awal, $tanggal_akhir)
	{
		$this->db->select("
			tk.id,
			tk.user_id,
			tu.username,
			tk.pemohon,
			tk.tanggal,
			tk.status,
			tk.created_at,
			tk.updated_at
		");
		
		$this->db->from('tbl_trans_keluar as tk');
		$this->db->join('tbl_user as tu', 'tk.user_id = tu.id_user', 'left');
		$this->db->where("tk.tanggal between '".$tanggal_awal."' and '".$tanggal_akhir."'");
		return $this->db->count_all_results();
	}

	public function save($data_header, $data_detail)
	{ 
		$this->db->insert('tbl_trans_keluar',$data_header);
		$this->db->insert_batch('tbl_trans_keluar_detail',$data_detail);
	}

	public function get_detail_header($id_pengeluaran)
	{
		$this->db->select('tp.*,tu.username');
		$this->db->from('tbl_trans_keluar tp');
		$this->db->join('tbl_user tu', 'tp.user_id = tu.id_user','left');
        $this->db->where('tp.id', $id_pengeluaran);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
	}

	public function get_detail($id_pengeluaran)
	{
		$this->db->select('tkd.*, ts.nama as nama_satuan');
		$this->db->from('tbl_trans_keluar_detail tkd');
		$this->db->join('tbl_satuan ts', 'tkd.satuan = ts.id','left');
        $this->db->where('tkd.id_trans_keluar', $id_pengeluaran);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
	}

	public function hapus_data_detail($id)
	{
		$this->db->where('id_trans_keluar', $id);
		$this->db->delete('tbl_trans_keluar_detail');
	}

	public function update_data_header($where, $data_header)
	{
		$this->db->update('tbl_trans_keluar', $data_header, $where);
		return $this->db->affected_rows();
	}

	public function insert_update($data_order_detail)
	{
		$this->db->insert_batch('tbl_trans_keluar_detail',$data_order_detail);
	}

	// ============================================================================================

	public function get_by_id($id)
	{
		$this->db->from('tbl_trans_order');
		$this->db->where('id_trans_order',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function delete_data($table, $where)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}

	public function get_id_trans_beli_detail($id_t_order)
	{
		$this->db->select('id_trans_beli_detail');
		$this->db->from('tbl_trans_beli_detail');
		$this->db->where('id_trans_order', $id_t_order);

		$query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
	}

	public function get_id_trans_order_detail($id_t_order)
	{
		$this->db->select('id_trans_order_detail');
		$this->db->from('tbl_trans_order_detail');
		$this->db->where('id_trans_order', $id_t_order);

		$query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
	}

    function getKodePengeluaran(){
            $q = $this->db->query("SELECT MAX(RIGHT(id,5)) as kode_max from tbl_trans_keluar WHERE DATE_FORMAT(tanggal, '%Y-%m') = DATE_FORMAT(CURRENT_DATE(), '%Y-%m')");
            $kd = "";
            if($q->num_rows()>0){
                foreach($q->result() as $k){
                    $tmp = ((int)$k->kode_max)+1;
                    $kd = sprintf("%05s", $tmp);
                }
            }else{
                $kd = "00001";
            }
            return "OUT".date('my').$kd;
    }

    function satuan(){
		$this->db->order_by('name','ASC');
		$namaSatuan= $this->db->get('tbl_satuan,tbl_barang');
		return $namaSatuan->result_array();
	}


	public function lookup_pengeluaran($keyword)
	{
		$this->db->select('*');
		$this->db->from('tbl_master_kode_akun_internal');
		$this->db->like('nama', $keyword);
		$this->db->where('is_aktif', '1');
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