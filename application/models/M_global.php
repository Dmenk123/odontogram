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

    function multi_row($select=NULL, $array_where=NULL, $table=NULL, $join= NULL, $order_by=NULL){
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
		
}