<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mod_verifikasi_out extends CI_Model
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

	var $order = array('tr.id_pembelian' => 'desc'); // default order

	// ===============================================================

	var $column_search2 = array(
		"tv.id",
		"tv.id_out",
		"tu.username",
		"tkd.keterangan",
		"tv.harga_total"
	);

	var $column_order2 = array(
		"tv.id",
		"tv.id_out",
		"tu.username",
		"tkd.keterangan",
		"tv.harga_total",
		null,
	);

	var $order2 = array('tr.id_pembelian' => 'desc'); // default order

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
		$this->db->where('tk.status', '1');
		
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
		//$this->db->where('tr.status_penarikan', '1');
		return $this->db->count_all_results();
	}

	// ================================================================================
	
	private function _get_datatables_query_finish($tanggal_awal, $tanggal_akhir, $term='') //term is value of $_REQUEST['search']
	{
		$column = array(
			"tv.id",
			"tv.id_out",
			"tu.username",
			"tkd.keterangan",
			"tv.harga_total",
			null,
		);
		
		$this->db->select("
			tv.*,
			tu.username,
			tkd.qty,
			tkd.keterangan,
			ts.nama
		");
		
		$this->db->from('tbl_verifikasi as tv');
		$this->db->join('tbl_user as tu', 'tv.user_id = tu.id_user', 'left');
		$this->db->join('tbl_trans_keluar_detail as tkd', 'tv.id_out_detail = tkd.id', 'left');
		$this->db->join('tbl_satuan as ts', 'tkd.satuan = ts.id', 'left');
		$this->db->where("tv.tanggal between '".$tanggal_awal."' and '".$tanggal_akhir."' and tv.tipe_transaksi = '2'");
		$this->db->where('tv.status', '1');

		$i = 0;
		foreach ($this->column_search2 as $item) 
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
				if(count($this->column_search2) - 1 == $i) 
					$this->db->group_end(); //close bracket
			}
			$i++;
		}

		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order2[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order2))
		{
			$order = $this->order2;
            $this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables_finish($tanggal_awal, $tanggal_akhir)
	{
		$term = $_REQUEST['search']['value'];
		$this->_get_datatables_query_finish($tanggal_awal, $tanggal_akhir, $term);

		if($_REQUEST['length'] != -1)
		$this->db->limit($_REQUEST['length'], $_REQUEST['start']);

		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered_finish($tanggal_awal, $tanggal_akhir)
	{
		$term = $_REQUEST['search']['value'];
		$this->_get_datatables_query_finish($tanggal_awal, $tanggal_akhir, $term);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all_finish($tanggal_awal, $tanggal_akhir)
	{
		$this->db->select("
			tv.*,
			tu.username,
			tkd.qty,
			tkd.keterangan,
			ts.nama
		");
		
		$this->db->from('tbl_verifikasi as tv');
		$this->db->join('tbl_user as tu', 'tv.user_id = tu.id_user', 'left');
		$this->db->join('tbl_trans_keluar_detail as tkd', 'tv.id_out_detail = tkd.id', 'left');
		$this->db->join('tbl_satuan as ts', 'tkd.satuan = ts.id', 'left');
		$this->db->where("tv.tanggal between '".$tanggal_awal."' and '".$tanggal_akhir."'");
		$this->db->where('tv.status', '1');
		
		return $this->db->count_all_results();
	}

	// ================================================================================

	public function get_by_id($id)
	{
		$this->db->select('tbl_trans_keluar.*, tbl_user_detail.nama_lengkap_user');
		$this->db->from('tbl_trans_keluar');
		$this->db->join('tbl_user_detail', 'tbl_trans_keluar.user_id = tbl_user_detail.id_user', 'left');
		$this->db->where('tbl_trans_keluar.id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_detail_by_id($id)
	{
		$this->db->select('tkd.*,ts.nama');
		$this->db->from('tbl_trans_keluar_detail as tkd');
		$this->db->join('tbl_satuan as ts', 'tkd.satuan = ts.id', 'left');
		$this->db->where('tkd.id_trans_keluar',$id);
		$this->db->where('tkd.status', 0);
		$query = $this->db->get();
		return $query->result();
	}

	public function lookup_akun_external($kode_int, $kode_in_text_int)
	{
		$this->db->select('kodetext_akun_external, tipe_akun_external');
		$this->db->from('tbl_master_kode_akun_internal');
		$this->db->where('kode', $kode_int);
		$this->db->where('kode_in_text', $kode_in_text_int);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_data_akun_external($kodetext_akun_external, $tipe_akun_external)
	{
		$this->db->select('*');
		$this->db->from('tbl_master_kode_akun');
		$this->db->where('tipe', $tipe_akun_external);
		$this->db->where('kode_in_text', $kodetext_akun_external);
		$query = $this->db->get();
		return $query->row();
	}

	public function save($data_header, $data_detail)
	{ 
		$this->db->insert('tbl_trans_keluar',$data_header);
		$this->db->insert_batch('tbl_trans_keluar_detail',$data_detail);
	}

	public function lookup_kode_akun($keyword="")
	{
		$this->db->select('*');
		$this->db->from('tbl_master_kode_akun');
		$this->db->like('nama',$keyword);
		$this->db->where('is_aktif', 1);
		
		$this->db->order_by('tipe, kode, sub_1, sub_2', 'asc');
		
		$query = $this->db->get();
		return $query->result();
	}

	function getKodeVerifikasi(){
		$q = $this->db->query("SELECT MAX(RIGHT(id,5)) as kode_max from tbl_verifikasi WHERE DATE_FORMAT(tanggal, '%Y-%m') = DATE_FORMAT(CURRENT_DATE(), '%Y-%m')");
		$kd = "";
		if($q->num_rows()>0){
			foreach($q->result() as $k){
				$tmp = ((int)$k->kode_max)+1;
				$kd = sprintf("%05s", $tmp);
			}
		}else{
			$kd = "00001";
		}
		return "VRY".date('my').$kd;
    }

    function satuan(){
		$this->db->order_by('name','ASC');
		$namaSatuan= $this->db->get('tbl_satuan,tbl_barang');
		return $namaSatuan->result_array();
	}

	public function get_verifikasi_by_id($id)
	{
		$this->db->select('
			tv.*,
			tud.nama_lengkap_user,
			tk.pemohon as nama_pemohon,
			tk.tanggal as tanggal_permintaan,
			tkd.keterangan,
			tkd.qty,
			ts.nama as nama_satuan
		');
		$this->db->from('tbl_verifikasi tv');
		$this->db->join('tbl_user_detail tud', 'tv.user_id = tud.id_user', 'left');
		$this->db->join('tbl_trans_keluar tk', 'tv.id_out = tk.id', 'left');
		$this->db->join('tbl_trans_keluar_detail tkd', 'tv.id_out_detail = tkd.id', 'left');
		$this->db->join('tbl_satuan ts', 'tkd.satuan = ts.id', 'left');
		
		$this->db->where('tv.id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function delete_ver_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('tbl_verifikasi');
	}


	//==================================================================================================

	public function update_data_header_detail($where, $data_header)
	{
		$this->db->update('tbl_trans_order', $data_header, $where);
		return $this->db->affected_rows();
	}

	public function insert_update($data_order_detail)
	{
		$this->db->insert_batch('tbl_trans_order_detail',$data_order_detail);
	}

	public function hapus_data_order_detail($id)
	{
		$this->db->where('id_trans_order', $id);
		$this->db->delete('tbl_trans_order_detail');
	}

	public function delete_by_id($id)
	{
		$this->db->where('id_trans_order', $id);
		$this->db->delete('tbl_trans_order');

		$this->db->where('id_trans_order', $id);
		$this->db->delete('tbl_trans_order_detail');
	}

	public function get_detail($id_trans_order)
	{
		//$this->db->select('tbl_trans_order.id_trans_order,
		$this->db->select(' tbl_barang.id_barang,
							tbl_barang.nama_barang,
							tbl_satuan.nama_satuan,
							tbl_satuan.id_satuan,
							tbl_trans_order.tgl_trans_order,
							tbl_trans_order_detail.id_trans_beli,
							tbl_trans_order_detail.id_trans_order_detail,
							tbl_trans_order_detail.id_trans_order,
							tbl_trans_order_detail.qty_order,
							tbl_trans_order_detail.keterangan_order');
		$this->db->from('tbl_trans_order_detail');
		$this->db->join('tbl_trans_order', 'tbl_trans_order.id_trans_order = tbl_trans_order_detail.id_trans_order','left');
		$this->db->join('tbl_barang', 'tbl_barang.id_barang = tbl_trans_order_detail.id_barang','left');
		$this->db->join('tbl_satuan', 'tbl_satuan.id_satuan = tbl_trans_order_detail.id_satuan','left');

        $this->db->where('tbl_trans_order.id_trans_order', $id_trans_order);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
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