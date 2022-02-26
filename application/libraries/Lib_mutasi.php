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

				## insert data detail
				## return gross total penjumlahan dari data detail yg di insert
				$gross_total = $this->insert_data_det($id_mutasi, $id_jenis_trans, $data_detail);

				## cari honor dokter
				## return tot_honor
				// $tot_honor = $this->cari_honor_dokter($id_jenis_trans, $data_header, $data_detail);

				### di replace 0, honor dokter bisa dihitung ketika pembayaran dikasir
				$tot_honor = 0;

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
		else{
			###update
			$tot_honor = (float)$data[0]->total_honor_dokter;
			$gross_total = (float)$data[0]->total_penerimaan_gross;
			
			//insert detail
			## return gross total penjumlahan dari data detail yg di insert + data lama
			$gross_total += $this->insert_data_det($data[0]->id, $data[0]->id_jenis_trans, $data_detail);

			## cari honor dokter
			## return tot_honor + data lama
			// $tot_honor += $this->cari_honor_dokter($id_jenis_trans, $data_header, $data_detail);

			### di replace 0, honor dokter bisa dihitung ketika pembayaran dikasir
			$tot_honor = 0;

			## jika transaksi penerimaan/pengeluaran
			if($flag_transaksi == 1) {
				$data_upd['total_penerimaan_gross'] = $gross_total;
				$data_upd['total_honor_dokter'] = $tot_honor;
				$data_upd['total_penerimaan_nett'] = (float)$gross_total - (float)$tot_honor;
			}else{
				$data_upd['total_pengeluaran'] = $gross_total;	
			}

			$data_upd['updated_at'] = $timestamp;
			$upd = $this->_ci->m_global->update('t_mutasi', $data_upd, ['id' => $data[0]->id]);
			
			if($upd){
				####### FINAL RETURN
				$retval = true;
			}else{
				####### FINAL RETURN
				$retval = false;
			}
		}

		return $retval;
	}

	private function insert_data_det($id_mutasi, $id_jenis_trans, $data)
	{
		$obj_date = new DateTime();
		$nilai_total = 0;
		foreach ($data as $key => $value) {
			$timestamp = $obj_date->format('Y-m-d H:i:s');
			$dataIns['id'] = $this->_ci->m_global->get_max_id('id', 't_mutasi_det');
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

	private function cari_honor_dokter($id_jenis_trans, $data_header, $data_detail)
	{
		###cek honor dokter
		$honor = $this->_ci->m_global->single_row('*',['id_dokter' => $data_header['id_pegawai'], 'deleted_at' => null], 't_honor');
				
		if($honor){
			// ###### logistik
			if($id_jenis_trans == '1'){
				$tot_honor = (((float)$data_detail[0]['harga'] * (int)$data_detail[0]['qty']) * (int)$honor->obat_persen) / 100;
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
								$tot_honor +=  ((float)$val['harga'] * (int)$vals->persentase) / 100;
								continue;
							}else{
								$counter_list_tindakan_false += 1;
							}
						}

						//jika counter == jumlah array maka honor tindakan khusus tidak ada. sehingga pakai honor tindakan global
						if($counter_list_tindakan_false == count($list_tindakan)){
							// ambil honor tindakan global
							$tot_honor += ((float)$val['harga'] * (int)$honor->tindakan_persen) / 100;
						}
					}
				}else{
					// ambil honor tindakan global
					$tot_honor += ((float)$data_detail[0]['harga'] * (int)$honor->tindakan_persen) / 100;
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
						$id_lab = $val['id_tindakan_lab'];
						$counter_list_tindakan_lab_false = 0;
						
						foreach ($list_tindakan_lab as $keys => $vals) {
							if($id_lab == $vals->id_lab){
								// persentase honor dokter berdasarkan penerimaan gross
								// looping data, jika tidak ada di loop lakukan flag counter false
								$tot_honor +=  ((float)$val['harga'] * (int)$vals->persentase) / 100;
								continue;
							}else{
								$counter_list_tindakan_lab_false += 1;
							}
						}

						//jika counter == jumlah array maka honor tindakan khusus tidak ada. sehingga pakai honor tindakan global
						if($counter_list_tindakan_lab_false == count($list_tindakan_lab)){
							// ambil honor tindakan global
							$tot_honor += ((float)$val['harga'] * (int)$honor->tindakan_lab_persen) / 100;
						}
					}
				}else{
					// ambil honor tindakan global
					$tot_honor += ((float)$data_detail[0]['harga'] * (int)$honor->tindakan_lab_persen) / 100;
				}
			}

		}else{
			$tot_honor = 0;
		}

		return $tot_honor;
	}

	/**
	 * DIPAKE UNTUK HONOR DAN DISKON PADA MUTASI
	 * param 1 = id_registrasi
	 * param 2 kode jenis transaksi (lihat m_jenis_trans)
	 * param 3 data tabel transaksi (parent tabel)
	 * param 4 flag_transaksi (1 : penerimaan , 2 : pengeluaran)
	*/
	function simpan_mutasi_lain($id_reg, $id_jenis_trans, $data_header, $flag_transaksi) {
		try {
			$obj_date = new DateTime();
			$timestamp = $obj_date->format('Y-m-d H:i:s');
			$datenow = $obj_date->format('Y-m-d');
			$id_trans_flag = $data_header['id'];
			$data = $this->_ci->t_mutasi->cek_data_mutasi($id_reg, $id_jenis_trans, $id_trans_flag);
			$datareg =  $this->_ci->m_global->single_row('*',['id' => $id_reg, 'deleted_at' => null], 't_registrasi');

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
					$this->_ci->db->trans_commit();
					## jika transaksi penerimaan/pengeluaran
					if($flag_transaksi == 1) {
						$data_upd['total_penerimaan_gross'] = $data_header['total_bruto'];
						$data_upd['total_penerimaan_nett'] = $data_header['total_nett'];
					}else{
						## jika jenis transaksi diskon
						if($id_jenis_trans == 5) {
							$data_upd['total_pengeluaran'] = $data_header['disc_nilai'];	
						}
						## jika jenis transaksi honor dokter
						elseif($id_jenis_trans == 6) {
							### get detail pembayaran
							$arr_pembayaran = $this->get_detail_pembayaran($data_header['id_reg']);
							$arr_pembayaran_det = $arr_pembayaran['detail'];
							
							$honor = $this->_ci->m_global->single_row('*',['id_dokter' => $datareg->id_pegawai, 'deleted_at' => null], 't_honor');
							
							## declare variabel
							$sum_tindakan_lab = 0;
							$sum_tindakan = 0;
							$sum_tindakan_potong = 0;
							$honor_dokter = 0;
							$flag_tindakan_potong_lab = false;
							$arr_tindakan = [];
							$arr_tindakan_potong = [];
							$arr_lab = [];
							
							foreach ($arr_pembayaran_det as $k => $v) {
								if($v['jenis'] == 'LOGISTIK') {
									continue;
								}
								elseif($v['jenis'] == 'TINDAKAN LAB'){
									$arr_lab[] = $v;
								}
								elseif($v['jenis'] == 'TINDAKAN'){
									
									if($v['is_potong_lab_honor_dokter'] == '1') {
										$flag_tindakan_potong_lab = true;
										$arr_tindakan_potong[] = $v;
									}else{
										$arr_tindakan[] = $v;
									}
								}
							}

							if(count($arr_lab) > 0) {
								$sum_tindakan_lab += array_sum(array_column($arr_lab, 'subtotal'));
							}
							
							if($flag_tindakan_potong_lab == false) {
								#### jika dalam array potong tindakan tidak ada yg potong lab maka jumlahkan array dan dipotong persen honor dokter
								$sum_tindakan += array_sum(array_column($arr_tindakan, 'subtotal'));
								$honor_dokter += $sum_tindakan * $honor->tindakan_persen / 100;

							}else{
								$sum_tindakan_potong += array_sum(array_column($arr_tindakan_potong, 'subtotal'));

								$honor_dokter += $sum_tindakan_potong - $sum_tindakan_lab;
								
								if(count($arr_tindakan) > 0) {
									$sum_tindakan += array_sum(array_column($arr_tindakan, 'subtotal'));
									$honor_dokter += $sum_tindakan;
								}

								## replace
								$honor_dokter = $honor_dokter * $honor->tindakan_persen / 100;
								
							}

							$data_upd['total_pengeluaran'] = $honor_dokter;
						}
						
					}

					$upd = $this->_ci->m_global->update('t_mutasi', $data_upd, ['id' => $id_mutasi]);
					
					if($upd){
						$this->_ci->db->trans_commit();
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
			else{
				###update
				## jika transaksi penerimaan/pengeluaran
				if($flag_transaksi == 1) {
					$gross_total = (float)$data[0]->total_penerimaan_gross;
					$nett_total = (float)$data[0]->total_penerimaan_nett;

					$data_upd['total_penerimaan_gross'] = $gross_total;
					$data_upd['total_penerimaan_nett'] = $nett_total;
				}else{
					## jika jenis transaksi diskon
					if($id_jenis_trans == 5) {
						$data_upd['total_pengeluaran'] = $data_header['disc_nilai'];
					} ## jika jenis transaksi honor dokter
					elseif ($id_jenis_trans == 6) {
						### get detail pembayaran
						$arr_pembayaran = $this->get_detail_pembayaran($data_header['id_reg']);
						$arr_pembayaran_det = $arr_pembayaran['detail'];

						$honor = $this->_ci->m_global->single_row('*', ['id_dokter' => $datareg->id_pegawai, 'deleted_at' => null], 't_honor');

						## declare variabel
						$sum_tindakan_lab = 0;
						$sum_tindakan = 0;
						$sum_tindakan_potong = 0;
						$honor_dokter = 0;
						$flag_tindakan_potong_lab = false;
						$arr_tindakan = [];
						$arr_tindakan_potong = [];
						$arr_lab = [];

						foreach ($arr_pembayaran_det as $k => $v) {
							if ($v['jenis'] == 'LOGISTIK') {
								continue;
							} elseif ($v['jenis'] == 'TINDAKAN LAB') {
								$arr_lab[] = $v;
							} elseif ($v['jenis'] == 'TINDAKAN') {

								if ($v['is_potong_lab_honor_dokter'] == '1') {
									$flag_tindakan_potong_lab = true;
									$arr_tindakan_potong[] = $v;
								} else {
									$arr_tindakan[] = $v;
								}
							}
						}

						if (count($arr_lab) > 0) {
							$sum_tindakan_lab += array_sum(array_column($arr_lab, 'subtotal'));
						}

						if ($flag_tindakan_potong_lab == false) {
							#### jika dalam array potong tindakan tidak ada yg potong lab maka jumlahkan array dan dipotong persen honor dokter
							$sum_tindakan += array_sum(array_column($arr_tindakan, 'subtotal'));

							$honor_dokter += $sum_tindakan / $honor->tindakan_persen * 100;
						} else {
							$sum_tindakan_potong += array_sum(array_column($arr_tindakan_potong, 'subtotal'));

							$honor_dokter += $sum_tindakan_potong - $sum_tindakan_lab;

							if (count($arr_tindakan) > 0
							) {
								$sum_tindakan += array_sum(array_column($arr_tindakan, 'subtotal'));
								$honor_dokter += $sum_tindakan;
							}

							## replace
							$honor_dokter = $honor_dokter * $honor->tindakan_persen / 100;
						}

						$data_upd['total_pengeluaran'] = $honor_dokter;
					}
				}

				$data_upd['updated_at'] = $timestamp;
				$upd = $this->_ci->m_global->update('t_mutasi', $data_upd, ['id' => $data[0]->id]);
				
				if($upd){
					####### FINAL RETURN
					$retval = true;
				}else{
					####### FINAL RETURN
					$retval = false;
				}
			}
			return $retval;
		} catch (\Throwable $th) {
			return false;
		}
	}


	/**
	 * param 1 = id_registrasi
	 * param 2 kode jenis transaksi (lihat m_jenis_trans)
	 * param 3 data tabel transaksi_detail (join)
	 * param 4 id_trans_flag (id_parent_tabel_transaksi)
	*/
	function delete_mutasi($id_reg, $id_jenis_trans, $data_transaksi, $id_trans_flag, $flag_transaksi) {
		
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$datenow = $obj_date->format('Y-m-d');
		$data = $this->_ci->t_mutasi->cek_data_mutasi($id_reg, $id_jenis_trans, $id_trans_flag);
		
		if(!$data){	
			####### FINAL RETURN
			$retval = false;
		}
		else{
			$data_header['id_pegawai'] = $data_transaksi[0]['id_pegawai'];
			
			//set variabel dengan data lama yg nantinya akan ditambahkan
			$tot_honor = (float)$data[0]->total_honor_dokter;
			$gross_total = (float)$data[0]->total_penerimaan_gross;
						
			//insert detail
			## return gross total penjumlahan dari data detail yg di delete + data lama
			$gross_total -= $this->delete_data_det($data[0]->id, $data_transaksi[0]['id'], $data[0]->id_jenis_trans, $data_transaksi);

			## cari honor dokter
			## return tot_honor + data lama
			// $tot_honor -= $this->cari_honor_dokter($id_jenis_trans, $data_header, $data_transaksi);
			$tot_honor = 0;
			// var_dump($tot_honor);exit;

			## jika transaksi penerimaan/pengeluaran
			if($flag_transaksi == 1) {
				$data_upd['total_penerimaan_gross'] = $gross_total;
				$data_upd['total_honor_dokter'] = $tot_honor;
				$data_upd['total_penerimaan_nett'] = (float)$gross_total - (float)$tot_honor;
			}else{
				$data_upd['total_pengeluaran'] = $gross_total;	
			}

			$data_upd['updated_at'] = $timestamp;
			$upd = $this->_ci->m_global->update('t_mutasi', $data_upd, ['id' => $data[0]->id]);
			
			if($upd){
				####### FINAL RETURN
				$retval = true;
			}else{
				####### FINAL RETURN
				$retval = false;
			}
		}

		return $retval;
	}


	function delete_mutasi_bak($id_reg, $id_jenis_trans, $data_transaksi, $id_trans_flag, $flag_transaksi) {
		
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$datenow = $obj_date->format('Y-m-d');
		$data = $this->_ci->t_mutasi->cek_data_mutasi($id_reg, $id_jenis_trans, $id_trans_flag);
		
		if(!$data){	
			####### FINAL RETURN
			$retval = false;
		}
		else{
			$data_header['id_pegawai'] = $data_transaksi[0]['id_pegawai'];
			
			//set variabel dengan data lama yg nantinya akan ditambahkan
			$tot_honor = (float)$data[0]->total_honor_dokter;
			$gross_total = (float)$data[0]->total_penerimaan_gross;
						
			//insert detail
			## return gross total penjumlahan dari data detail yg di delete + data lama
			$gross_total -= $this->delete_data_det($data[0]->id, $data_transaksi[0]['id'], $data[0]->id_jenis_trans, $data_transaksi);

			## cari honor dokter
			## return tot_honor + data lama
			$tot_honor -= $this->cari_honor_dokter($id_jenis_trans, $data_header, $data_transaksi);
			// var_dump($tot_honor);exit;

			## jika transaksi penerimaan/pengeluaran
			if($flag_transaksi == 1) {
				$data_upd['total_penerimaan_gross'] = $gross_total;
				$data_upd['total_honor_dokter'] = $tot_honor;
				$data_upd['total_penerimaan_nett'] = (float)$gross_total - (float)$tot_honor;
			}else{
				$data_upd['total_pengeluaran'] = $gross_total;	
			}

			$data_upd['updated_at'] = $timestamp;
			$upd = $this->_ci->m_global->update('t_mutasi', $data_upd, ['id' => $data[0]->id]);
			
			if($upd){
				####### FINAL RETURN
				$retval = true;
			}else{
				####### FINAL RETURN
				$retval = false;
			}
		}

		return $retval;
	}

	private function delete_data_det($id_mutasi, $id_trans_det_flag, $id_jenis_trans, $data)
	{
		
		$obj_date = new DateTime();
		$nilai_total = 0;
				
		foreach ($data as $key => $value) {
			$timestamp = $obj_date->format('Y-m-d H:i:s');

			###### logistik
			if($id_jenis_trans == '1'){
				$qty = $value['qty'];
				$subtotal = (float)$value['harga'] * (int)$value['qty'];
			}else{
				$subtotal = $value['harga'];
			}
			
			$hapus = $this->_ci->m_global->softdelete(['id_mutasi' => $id_mutasi, 'id_trans_det_flag' => $id_trans_det_flag], 't_mutasi_det');

			// akumulasi subtotal
			$nilai_total += $subtotal;
		}
		// nilai total yg digunakan untuk dikurangi
		return $nilai_total;
	}
	
	function new_id(){
		$queryNewId	= $this->_ci->db->query("select * from uuid_generate_v1() as newid");
		$dataNewId = $queryNewId->row();
		
		return $dataNewId->newid;
	}

	function get_detail_pembayaran($id_reg) {
		$select = "a.*, peg.nama as nama_dokter, b.total_honor_dokter, b.total_penerimaan_nett, b.total_penerimaan_gross, b.id_jenis_trans, b.id_trans_flag";
		$where = ['a.is_pulang' => 1, 'a.deleted_at' => null, 'a.id' => $id_reg];
		$table = 't_registrasi as a';
		$join = [ 
			[
				'table' => 'm_pegawai as peg',
				'on'	=> 'a.id_pegawai = peg.id'
			],
			[
				'table' => 't_mutasi b',
				'on'	=> 'a.id = b.id_registrasi and b.deleted_at is null'
			],
		];

		$data_header =  $this->_ci->m_global->multi_row($select,$where,$table, $join);
		
		$arr_detail_fix = [];
		if($data_header && count($data_header) > 0) {
			foreach ($data_header as $key => $value) {
				if($value->id_jenis_trans == '1') {
					#### LOGISTIK
					$q = $this->_ci->db->query("
						SELECT a.*, b.qty, b.harga, b.subtotal, c.kode_logistik, c.nama_logistik
						FROM t_logistik as a 
						join t_logistik_det b on a.id = b.id_t_logistik and b.deleted_at is null 
						join m_logistik c on b.id_logistik = c.id_logistik and c.deleted_at is null 
						WHERE a.deleted_at is null and a.id_reg = $value->id 
					")->result();

					foreach ($q as $k => $v) {
						$arr['jenis'] = 'LOGISTIK';
						$arr['qty'] = $v->qty;
						$arr['harga'] = $v->harga;
						$arr['subtotal'] = $v->subtotal;
						$arr['nama'] = $v->nama_logistik;
						$arr['kode'] = $v->kode_logistik;
						$arr['is_potong_lab_honor_dokter'] = null;
						$arr_detail_fix[] = $arr;
				 	}

				}elseif($value->id_jenis_trans == '2') {
					if($value->total_penerimaan_nett == 0 && $value->total_penerimaan_gross == 0) {
						// skip jika transaksi jenis = 2, dan tidak ada nilai penerimaan
						// agar tidak di loop, sehingga honor dokter akan valid
						continue;
					}
					
					#### TINDAKAN
					$q = $this->_ci->db->query("
						SELECT a.*, b.gigi, b.harga, c.kode_tindakan, c.nama_tindakan, c.is_potong_lab_honor_dokter
						FROM t_tindakan as a 
						join t_tindakan_det b on a.id = b.id_t_tindakan and b.deleted_at is null 
						join m_tindakan c on b.id_tindakan = c.id_tindakan and c.deleted_at is null 
						WHERE a.deleted_at is null and a.id_reg = $value->id 
					")->result();

					foreach ($q as $k => $v) {
						$arr['jenis'] = 'TINDAKAN';
						$arr['qty'] = null;
						$arr['harga'] = $v->harga;
						$arr['subtotal'] = $v->harga;
						$arr['nama'] = $v->nama_tindakan;
						$arr['kode'] = $v->kode_tindakan;
						$arr['is_potong_lab_honor_dokter'] = $v->is_potong_lab_honor_dokter;
						$arr_detail_fix[] = $arr;
				 	}
					 
				}elseif($value->id_jenis_trans == '3') {
					#### LAB
					$q = $this->_ci->db->query("
						SELECT a.*,  b.harga, b.keterangan, c.kode, c.tindakan_lab
						FROM t_tindakanlab as a 
						join t_tindakanlab_det b on a.id = b.id_t_tindakanlab and b.deleted_at is null 
						join m_laboratorium c on b.id_tindakan_lab = c.id_laboratorium and c.deleted_at is null
						WHERE a.deleted_at is null and a.id_reg = $value->id 
					")->result();

					foreach ($q as $k => $v) {
						$arr['jenis'] = 'TINDAKAN LAB';
						$arr['qty'] = null;
						$arr['harga'] = $v->harga;
						$arr['subtotal'] = $v->harga;
						$arr['nama'] = $v->tindakan_lab;
						$arr['kode'] = $v->kode;
						$arr['is_potong_lab_honor_dokter'] = null;
						$arr_detail_fix[] = $arr;
				 	}
				}
			}
		}
		
		return [
			'header' => $data_header,
			'detail' => $arr_detail_fix
		];
	}
}