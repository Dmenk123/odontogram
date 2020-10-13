<?php
class Lib_mutasi extends CI_Controller {
    protected $_ci;
    
    function __construct(){
		$this->_ci = &get_instance();
		$this->_ci->load->model('m_global');  //<-------Load the Model first
    }
	
	/**
	 * $id_jenis_trans = adalah id dari m jenis transaksi
	 * $id_trans_flag = id transaksi dari tiap2 tabel transaksi
	 * $datanya = data array dari inputan
	 * $flag_transaksi = 1: penerimaan, 2: pengeluaran
	 */
	function simpan_mutasi($id_jenis_trans, $id_trans_flag, $datanya=null, $flag_transaksi) {
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$datenow = $obj_date->format('Y-m-d');
		$select = "m.*, md.id as id_mut_det, md.id_logistik, md.qty, md.harga, md.subtotal, md.id_trans_det_flag";
		$join = [ 
			['table' => 't_mutasi_det as md', 'on' => 'm.id = md.id_mutasi'],
		];
		$data = $this->_ci->m_global->single_row($select, ['m.id_jenis_trans' => $id_jenis_trans, 'm.id_trans_flag' => $id_trans_flag], 't_mutasi as m', $join);
		
		if(!$data){	
			###insert
			$data['tanggal'] = $datenow;
			$data['id_jenis_trans'] = $id_jenis_trans;
			$data['id_trans_flag'] = $id_trans_flag;
			$data['id_user'] = $this->_ci->session->userdata('id_user');
			## jika transaksi penerimaan/pengeluaran
			if($flag_transaksi == 1) {
				$data['harga_total_in'] = $datanya['harga_total'];
			}else{
				$data['harga_total_out'] = $datanya['harga_total'];	
			}
			
			$data['flag_transaksi'] = $flag_transaksi;
			$data['created_at'] = $timestamp;
						
			$insert = $this->_ci->m_global->save($data, 't_mutasi');

			if($insert) {
				// $this->insert_data_det($datanya);
				$retval = true;
			}else{
				$retval = false;
			}
		}else{
			###update
			if($flag_transaksi == 1) {
				$data_upd = [
					'harga_total_in' => $datanya['harga_total'],
					'id_user' => $this->_ci->session->userdata('id_user')
				];
			}else{
				$data_upd = [
					'harga_total_out' => $datanya['harga_total'],
					'id_user' => $this->_ci->session->userdata('id_user')
				];
			}

			$update = $this->_ci->m_global->update(['id' => $data->id], $data_upd, 't_mutasi');
			
			if($update) {
				$retval = true;
			}else{
				$retval = false;
			}
		}

		return $retval;
	}

	public function insert_data_det($datanya)
	{
		return;
	}
	
	function new_id(){
		$queryNewId	= $this->_ci->db->query("select * from uuid_generate_v1() as newid");
		$dataNewId = $queryNewId->row();
		
		return $dataNewId->newid;
	}
}