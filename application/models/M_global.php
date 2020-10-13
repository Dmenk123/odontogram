<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_global extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function store_id($data,$table){
        $this->db->insert($table,$data);
        return $this->db->insert_id();
    }

    function store($data,$table){
        $this->db->insert($table,$data);
        return $this->db->affected_rows();
    }
    
    function update($table=NULL, $data=NULL, $array_where=NULL){
        $this->db->where($array_where);
        $this->db->update($table, $data);
        return $this->db->affected_rows();
    }

    function delete($array_where=NULL, $table=NULL){
        $this->db->where($array_where);
        $this->db->delete($table);
        return $this->db->affected_rows(); 
    }

    function single_row($select=NULL,$array_where=NULL,$table=NULL, $join=NULL, $order_by=NULL){
        $this->db->select($select);
		$this->db->from($table);
		if(isset($array_where)){
        	$this->db->where($array_where);
		}
		
		if(isset($join)) {
			foreach($join as $j) :
				$this->db->join($j["table"], $j["on"],'left');
			endforeach;
		}

		if(isset($order_by)){
        	$this->db->order_by($order_by);
        }
		
		$q = $this->db->get();
		
        return $q->row();
    }

    function multi_row($select=NULL, $array_where=NULL, $table=NULL, $join= NULL, $order_by=NULL, $limit=NULL){
		if($select != null) {
			$this->db->select($select);
		}else{
			$this->db->select('*');
		}
       
		$this->db->from($table);

		if(isset($array_where)){
        	$this->db->where($array_where);
		}
		
		if(isset($join)) {
			foreach($join as $j) :
				$this->db->join($j["table"], $j["on"],'left');
			endforeach;
		}

		if(isset($order_by)){
        	$this->db->order_by($order_by);
        }

        if(isset($$limit)) {
            $this->db->limit($limit);
        }
		
		$q = $this->db->get();
		
        return $q->result();
    }

    function rownum($where,$table){
		$this->db->select('*');
		$this->db->where($where);
		return $this->db->get($table)->num_rows();
	}
    
    function max($field, $table){
        $q =$this->db->select_max($field);
        $q = $this->db->get($table); 
        return $q->row();
	}

	public function getSelectedData($table,$datawhere,$data_like=null, $datawhere_or = null, $datawhere1=null,$wherein=null,$where_in=null,$in=null,$where_sekda=null,$datalike_or=null,$not_in=null,$not_like=null)
    {
        $this->db->select('*');
        if ($datawhere != null) {
            $this->db->where($datawhere);
        }
        if ($data_like != null) {
           $this->db->like($data_like,false,'after');
        }
        if ($datawhere_or != null) {
            $this->db->or_where($datawhere_or);
        }
        if ($datawhere1 != null) {
            $this->db->where($datawhere1);
        }
     //SEMENTARA UNTUK MENAMPILKAN KATEGORI SURAT YANG HANYA SUDAH ADA FORMNYA
        if ($wherein != null) {
            $this->db->where_in('id_kategori',$wherein);
        }

        if ($where_in != null) {
            $this->db->where_in('id_laporan',$where_in);
        }

        if ($in != null) {
            $this->db->where_in('id_detail',$in);
        }

        if ($where_sekda != null) {
            $this->db->where_in('id_jabatan',$where_sekda);
        }

        if ($datalike_or != null) {
            $this->db->or_like($datalike_or);
        }

        if($not_in != null){
            $this->db->where_not_in($not_in);
        }

        if($not_like != null){
            $this->db->not_like($not_like);
        }

        return $this->db->get($table);
    }

    public function save($data, $table)
	{
		return $this->db->insert($table, $data);	
	}
		
}