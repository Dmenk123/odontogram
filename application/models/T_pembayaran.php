<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class T_pembayaran extends CI_Model
{
	var $table = 't_pembayaran';
	var $column_search = [
		'c.nama_klinik',
		'b.no_reg',
		'b.tanggal_reg',
		'd.username',
		'jenis_bayar',
		'a.disc_persen',
		'a.disc_rp',
		'a.total_bruto',
		'a.total_nett'
	];

	var $column_order = [
		'c.nama_klinik',
		'b.no_reg',
		'b.tanggal_reg',
		'd.username',
		'jenis_bayar',
		'a.disc_persen',
		'a.disc_rp',
		'a.total_bruto',
		'a.total_nett',
		null
	];

	var $order = ['b.no_reg' => 'asc', 'a.tanggal_reg' => 'asc'];

	public function __construct()
	{
		parent::__construct();
		//alternative load library from config
		$this->load->database();
	}

	private function _get_datatables_query($term='', $id_klinik = null)
	{
		$this->db->select("a.*, b.no_reg, b.tanggal_reg, c.nama_klinik, CASE WHEN a.is_cash = 1 THEN 'Cash' ELSE 'Kredit' END as jenis_bayar, d.username");
		$this->db->from($this->table.' a');
		$this->db->join('t_registrasi b', 'a.id_reg = b.id', 'left');
		$this->db->join('m_klinik c', 'b.id_klinik = c.id', 'left');
		$this->db->join('m_user d', 'a.id_user = d.id', 'left');
		$this->db->where('a.deleted_at is null');

		if($id_klinik != null) {
			$this->db->where('b.id_klinik', $id_klinik);
		}
				
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
					if($item == 'jenis_bayar') {
						/**
						 * param both untuk wildcard pada awal dan akhir kata
						 * param false untuk disable escaping (karena pake subquery)
						 */
						$this->db->or_like('(CASE WHEN a.is_cash = 1 THEN \'Cash\' ELSE \'Kredit\' END)', $_POST['search']['value'],'both',false);
					}
					/* elseif($item == 'jenkel'){
						$this->db->or_like('(CASE WHEN psn.jenis_kelamin = \'L\' THEN \'Laki-Laki\' ELSE \'Perempuan\' END)', $_POST['search']['value'],'both',false);
					} */
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

	function get_datatables($id_klinik)
	{
		$term = $_REQUEST['search']['value'];
		$this->_get_datatables_query($term, $id_klinik);
		if($_REQUEST['length'] != -1)
		$this->db->limit($_REQUEST['length'], $_REQUEST['start']);

		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered($id_klinik)
	{
		$this->_get_datatables_query('', $id_klinik);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all($id_klinik)
	{
		$this->_get_datatables_query('', $id_klinik);
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

	public function get_detail_pembayaran($id)
	{
		$this->db->select("a.*, b.no_reg, b.tanggal_reg, c.nama_klinik, CASE WHEN a.is_cash = 1 THEN 'Cash' ELSE 'Kredit' END as jenis_bayar, d.username, e.no_rm, e.nama, f.nama as nama_kredit");
		$this->db->from($this->table . ' a');
		$this->db->join('t_registrasi b', 'a.id_reg = b.id', 'left');
		$this->db->join('m_klinik c', 'b.id_klinik = c.id', 'left');
		$this->db->join('m_user d', 'a.id_user = d.id', 'left');
		$this->db->join('m_pasien e', 'b.id_pasien = e.id', 'left');
		$this->db->join('m_bank_kredit f', 'a.reff_trans_kredit = f.id', 'left');
		$this->db->where('a.deleted_at is null');
		$this->db->where('a.id', $id);
		$q = $this->db->get();
		return $q->row();
	}

	function get_kode_bayar()
	{
		$obj_date = new DateTime();
		$thn = $obj_date->format('Y');
		$bln = $obj_date->format('m');
		$q = $this->db->query("select MAX(RIGHT(kode,4)) as kode_max from " . $this->table . " WHERE DATE_FORMAT(tanggal, '%Y-%m') = '".$thn.'-'.$bln."'");

		$kd_fix = "";
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $k) {
				$tmp = ((int)$k->kode_max) + 1;
				//memberi tambahan padding angka 0 dalam 4 string 
				$kd_fix = sprintf("%04s", $tmp);
			}
		} else {
			$kd_fix = "0001";
		}

		return 'INV' . '-' . $thn . '' . $bln . '-' . $kd_fix;
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