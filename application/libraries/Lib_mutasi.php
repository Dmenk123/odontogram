<?php
class Lib_mutasi extends CI_Controller {
    protected $_ci;
    
    function __construct(){
		$this->_ci = &get_instance();
		$this->_ci->load->model(['m_global', 't_mutasi', 't_mutasi_det']);  //<-------Load the Model first
    }
	
	/**
	 * param 1 = id_registrasi
	 * param 2 kode jenis transaksi (lihat m_jenis_trans)
	 * param 3 data tabel transaksi (parent tabel)
	 * param 4 data tabel detail transaksi (child tabel)
	 * param 5 flag_transaksi (1 : penerimaan , 2 : pengeluaran)
	*/
	function simpan_mutasi($id_reg, $id_jenis_trans, $data_header, $data_detail, $flag_transaksi) {
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$datenow = $obj_date->format('Y-m-d');
		$id_trans_flag = $data_header['id'];
		$data = $this->_ci->t_mutasi->cek_data_mutasi($id_reg, $id_jenis_trans, $id_trans_flag);
		
		if(!$data){	
			###insert
			$id_mutasi = $this->_ci->m_global->get_max_id('id', 't_mutasi');
			$data['id'] = $id_mutasi;
			$data['tanggal'] = $datenow;
			$data['id_registrasi'] = $id_reg;
			$data['id_jenis_trans'] = $id_jenis_trans;
			$data['id_trans_flag'] = $id_trans_flag;
			$data['id_user'] = $this->_ci->session->userdata('id_user');
			$data['flag_transaksi'] = $flag_transaksi;			
			$data['created_at'] = $timestamp;
						
			$insert = $this->_ci->m_global->save($data, 't_mutasi');

			if($insert) {
				$gross_total = $this->insert_data_det($id_mutasi, $id_jenis_trans, $data_detail);

				###cek honor dokter
				$honor = $this->_ci->m_global->single_row('*',['id_dokter' => $data_header['id_pegawai'], 'deleted_at' => null], 't_honor');
				
				if($honor){
					// ###### logistik
					if($id_jenis_trans == '1'){
						$tot_honor = ((float)$gross_total * (int)$honor->obat_persen) / 100;
						$data_upd['total_honor_dokter'] = $tot_honor;
					}
					###### tindakan
					elseif($id_jenis_trans == '2'){
						$tot_honor = 0;
						// todo : 
						// cek master honor tindakan by dokter apa saja
						$list_tindakan = $this->_ci->m_global->multi_row('*', ['id_dokter' => $data_header['id_pegawai'], 'deleted_at' => null], 't_honor_dokter_tindakan');
						if($list_tindakan){
							foreach ($data_detail as $key => $val) {
								$id_tindakan = $val['id_tindakan'];
								$counter_list_tindakan_false = 0;
								foreach ($list_tindakan as $keys => $vals) {
									if($id_tindakan == $vals->id_tindakan){
										// persentase honor dokter berdasarkan penerimaan gross
										// looping data, jika tidak ada di loop lakukan flag counter false
										$tot_honor +=  ((float)$gross_total * (int)$vals->persentase) / 100;
										continue;
									}else{
										$counter_list_tindakan_false += 1;
									}
								}

								//jika counter == jumlah array maka honor tindakan khusus tidak ada. sehingga pakai honor tindakan global
								if($counter_list_tindakan_false == count($list_tindakan)){
									// ambil honor tindakan global
									$tot_honor += ((float)$gross_total * (int)$honor->tindakan_persen) / 100;
								}
							}
						}else{
							// ambil honor tindakan global
							$tot_honor += ((float)$gross_total * (int)$honor->tindakan_persen) / 100;
						}						
					}
					###### lab
					elseif($id_jenis_trans == '3'){
						$tot_honor = 0;
						// todo : 
						// cek master honor tindakan lab by dokter apa saja
						$list_tindakan_lab = $this->_ci->m_global->multi_row('*', ['id_dokter' => $data_header['id_pegawai'], 'deleted_at' => null], 't_honor_dokter_lab');
						if($list_tindakan_lab){
							foreach ($data_detail as $key => $val) {
								$id_lab = $val['id_lab'];
								$counter_list_tindakan_lab_false = 0;
								foreach ($list_tindakan_lab as $keys => $vals) {
									if($id_lab == $vals->id_lab){
										// persentase honor dokter berdasarkan penerimaan gross
										// looping data, jika tidak ada di loop lakukan flag counter false
										$tot_honor +=  ((float)$gross_total * (int)$vals->persentase) / 100;
										continue;
									}else{
										$counter_list_tindakan_lab_false += 1;
									}
								}

								//jika counter == jumlah array maka honor tindakan khusus tidak ada. sehingga pakai honor tindakan global
								if($counter_list_tindakan_lab_false == count($list_tindakan_lab)){
									// ambil honor tindakan global
									$tot_honor += ((float)$gross_total * (int)$honor->tindakan_persen) / 100;
								}
							}
						}else{
							// ambil honor tindakan global
							$tot_honor += ((float)$gross_total * (int)$honor->tindakan_persen) / 100;
						}
					}

				}else{
					$tot_honor = 0;
				}

				## jika transaksi penerimaan/pengeluaran
				if($flag_transaksi == 1) {
					$data_upd['total_penerimaan_gross'] = $gross_total;
					$data_upd['total_honor_dokter'] = $tot_honor;
					$data_upd['total_penerimaan_nett'] = (float)$gross_total - (float)$tot_honor;
				}else{
					$data_upd['total_pengeluaran'] = $gross_total;	
				}

				$upd = $this->_ci->m_global->update('t_mutasi', $data_upd, ['id' => $id_mutasi]);
				if($upd){
					####### FINAL RETURN
					$retval = true;
				}else{
					####### FINAL RETURN
					$retval = false;
				}
			}else{
				####### FINAL RETURN
				$retval = false;
			}
		}
		// else{
		// 	###update
		// 	if($flag_transaksi == 1) {
		// 		$data_upd = [
		// 			'harga_total_in' => $datanya['harga_total'],
		// 			'id_user' => $this->_ci->session->userdata('id_user')
		// 		];
		// 	}else{
		// 		$data_upd = [
		// 			'harga_total_out' => $datanya['harga_total'],
		// 			'id_user' => $this->_ci->session->userdata('id_user')
		// 		];
		// 	}

		// 	$update = $this->_ci->m_global->update(['id' => $data->id], $data_upd, 't_mutasi');
			
		// 	if($update) {
		// 		$retval = true;
		// 	}else{
		// 		$retval = false;
		// 	}
		// }

		return $retval;
	}

	public function insert_data_det($id_mutasi, $id_jenis_trans, $data)
	{
		$obj_date = new DateTime();
		$nilai_total = 0;
		foreach ($data as $key => $value) {
			$timestamp = $obj_date->format('Y-m-d H:i:s');

			$dataIns['id_mutasi'] = $id_mutasi;
			$dataIns['id_trans_det_flag'] = $value['id'];
			$dataIns['harga'] = $value['harga'];

			###### logistik
			if($id_jenis_trans == '1'){
				$dataIns['qty'] = $value['qty'];
				$dataIns['subtotal'] = (float)$value['harga'] * (int)$value['qty'];
			}else{
				$dataIns['subtotal'] = $value['harga'];
			}
			
			$dataIns['created_at'] = $timestamp;
			$insert = $this->_ci->m_global->save($dataIns, 't_mutasi_det');

			// akumulasi subtotal
			$nilai_total += $dataIns['subtotal'];
		}

		return $nilai_total;
	}
	
	function new_id(){
		$queryNewId	= $this->_ci->db->query("select * from uuid_generate_v1() as newid");
		$dataNewId = $queryNewId->row();
		
		return $dataNewId->newid;
	}
}