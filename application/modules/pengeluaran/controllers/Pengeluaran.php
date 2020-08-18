<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		//profil data
		$this->load->model('profil/mod_profil','prof');
		$this->load->model('mod_pengeluaran','m_out');
	}

	public function index()
	{	
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->prof->get_detail_pengguna($id_user);
		
		$arr_bulan = [
			1 => 'Januari',
			2 => 'Februari',
			3 => 'Maret',
			4 => 'April',
			5 => 'Mei',
			6 => 'Juni',
			7 => 'Juli',
			8 => 'Agustus',
			9 => 'September',
			10 => 'Oktober',
			11 => 'November',
			12 => 'Desember'
		];

		if ($this->input->get('bulan') != '' && $this->input->get('tahun') != '') {
			$bulan = $this->input->get('bulan');
			$tahun = $this->input->get('tahun');

			//cek kunci
			$cek_kunci = $this->cek_status_kuncian($bulan, $tahun);

			$data = array(
				'data_user' => $data_user,
				'arr_bulan' => $arr_bulan,
				'cek_kunci' => $cek_kunci
			);
		} else {
			$data = array(
				'data_user' => $data_user,
				'arr_bulan' => $arr_bulan,
				'cek_kunci' => TRUE
			);
		}

		$content = [
			'css' 	=> 'cssPengeluaran',
			'modal' => 'modalPengeluaran',
			'js'	=> 'jsPengeluaran',
			'view'	=> 'view_list_pengeluaran'
		];

		$this->template_view->load_view($content, $data);
	}

	public function list_pengeluaran($bulan, $tahun)
	{
		$tanggal_awal = date('Y-m-d', strtotime($tahun . '-' . $bulan . '-01'));
		$tanggal_akhir = date('Y-m-t', strtotime($tahun . '-' . $bulan . '-01'));
		$list = $this->m_out->get_datatables($tanggal_awal, $tanggal_akhir);
		$data = array();
		$no =$_POST['start'];
		foreach ($list as $listOut) {
			$link_detail = site_url('pengeluaran/pengeluaran_detail/').$listOut->id;
			$no++;
			$row = array();
			$row[] = $listOut->id;
			$row[] = date('d-m-Y', strtotime($listOut->tanggal));
			$row[] = $listOut->username;
			$row[] = $listOut->pemohon;
			if ($listOut->status == 1) {
				//belum di verifikasi
				$row[] = '<span style="color:red">Belum Di Verifikasi</span>';
			}else{
				$row[] = '<span style="color:green">Sudah Di Verifikasi</span>';
			}

			//cek kuncian
			/*$cek_kunci = $this->cek_status_kuncian(date('m', strtotime($listOut->tanggal)), date('Y', strtotime($listOut->tanggal)));*/
			$cek_kunci = FALSE;
			if ($cek_kunci) {
				$row[] = '<a class="btn btn-sm btn-success" href="' . $link_detail . '" title="Detail" id="btn_detail" onclick=""><i class="glyphicon glyphicon-info-sign"></i></a>';
			}else{
				if ($listOut->status == 1) {
					//belum di verifikasi
					$row[] = '
					<a class="btn btn-sm btn-success" href="' . $link_detail . '" title="Detail" id="btn_detail" onclick="">
						<i class="glyphicon glyphicon-info-sign"></i></a>
					<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="editPengeluaran(' . "'" . $listOut->id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i></a>
					<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="deletePengeluaran(' . "'" . $listOut->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a>
				';
				} else {
					$row[] = '<a class="btn btn-sm btn-success" href="' . $link_detail . '" title="Detail" id="btn_detail" onclick=""><i class="glyphicon glyphicon-info-sign"></i></a>';
				}
			}
			
			
			$data[] = $row;
		}//end loop

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->m_out->count_all($tanggal_awal, $tanggal_akhir),
						"recordsFiltered" => $this->m_out->count_filtered($tanggal_awal, $tanggal_akhir),
						"data" => $data,
					);
		//output to json format
		echo json_encode($output);
	}

	public function add_pengeluaran()
	{
		//$this->_validate();
		$timestamp = date('Y-m-d H:i:s');
		$id = $this->input->post('fieldId');
		$userid = $this->input->post('fieldUserid');
		$tanggal = date('Y-m-d');
		$pemohon = $this->input->post('fieldPemohon');

		$this->db->trans_begin();

		$data_header = array(
			'id' 			=> $id,
			'user_id' 		=> $userid,
			'pemohon'		=> $pemohon,
			'tanggal' 		=> $tanggal,
			'status' 		=> 1,
			'created_at' 	=> $timestamp, 
		);

		//for table trans_order_detail
		$hitung = count($this->input->post('i_jumlah'));
		$data_detail = [];
		for ($i=0; $i < $hitung; $i++) 
		{
			$data_detail[$i] = array(
				'id_trans_keluar' => $id,
				'keterangan' => $this->input->post('i_keterangan')[$i],
				'satuan' => $this->input->post('i_satuan')[$i],
				'qty' => $this->input->post('i_jumlah')[$i],
				'kode_in_text_akun' => $this->input->post('i_idakun')[$i]
			);
		}
							
		$insert = $this->m_out->save($data_header, $data_detail);
		
		if ($this->db->trans_status() === FALSE) {
        	$this->db->trans_rollback();
        	echo json_encode(array(
				"status" => FALSE,
				"pesan_tambah" => 'Data Transaksi Pengeluaran Gagal ditambahkan'
			));
		}
		else {
		    $this->db->trans_commit();
		    echo json_encode(array(
				"status" => TRUE,
				"pesan_tambah" => 'Data Transaksi Pengeluaran Barang Berhasil ditambahkan'
			));
		}
	}

	public function edit_pengeluaran($id)
	{
		$data = array(
			'data_header' => $this->m_out->get_detail_header($id),
			'data_isi' => $this->m_out->get_detail($id),
		);

		echo json_encode($data);
	}

	public function update_pengeluaran()
	{
		// $this->_validate();
		$this->db->trans_begin();
		//delete id order in tabel detail
		$id = $this->input->post('fieldId');
		$timestamp = date('Y-m-d H:i:s');
		$hapus_data_detail = $this->m_out->hapus_data_detail($id);

		//update header
		$data_header = array(
			'updated_at' => $timestamp
		); 
		$this->m_out->update_data_header(array('id' => $id), $data_header);

		//proses insert ke tabel detail
		$hitung_detail = count($this->input->post('i_satuan'));
		$data_detail = array();
		for ($i=0; $i < $hitung_detail; $i++) 
		{
			$data_detail[$i] = array(
				'id_trans_keluar' => $id,
				'keterangan' => $this->input->post('i_keterangan')[$i],
				'satuan' => $this->input->post('i_satuan')[$i],
				'qty' => $this->input->post('i_jumlah')[$i],
				'kode_in_text_akun' => $this->input->post('i_idakun')[$i]
			);
		}

		$insert_update = $this->m_out->insert_update($data_detail);

		if ($this->db->trans_status() === FALSE) {
        	$this->db->trans_rollback();
        	echo json_encode(array(
				"status" => FALSE,
				"pesan_tambah" => 'Data Transaksi Pengeluaran Gagal Diupdate'
			));
		}
		else {
		    $this->db->trans_commit();
		    echo json_encode(array(
				"status" => TRUE,
				"pesan_tambah" => 'Data Transaksi Pengeluaran Berhasil Diupdate'
			));
		}
	}

	public function pengeluaran_detail()
	{
		$id_user = $this->session->userdata('id_user'); 
		$query_user = $this->prof->get_detail_pengguna($id_user);

		$id = $this->uri->segment(3); 
		$query_header = $this->m_out->get_detail_header($id);
		$query = $this->m_out->get_detail($id);

		$data = array(
			'data_user' => $query_user,
			'hasil_header' => $query_header,
			'hasil_data' => $query
		);

		$content = [
			'css' 	=> 'cssPengeluaran',
			'modal' => null,
			'js'	=> 'jsPengeluaran',
			'view'	=> 'view_detail_pengeluaran'
		];

		$this->template_view->load_view($content, $data);
	}

	public function cetak_nota_pengeluaran()
	{
		$this->load->library('Pdf_gen');

		$id = $this->uri->segment(3);
		$query_header = $this->m_out->get_detail_header($id);
		$query = $this->m_out->get_detail($id);

		$data = array(
			'title' => 'Report Pencatatan Pengeluaran',
			'hasil_header' => $query_header,
			'hasil_data' => $query, 
		);

	    $html = $this->load->view('view_detail_pengeluaran_report', $data, true);
	    
	    $filename = 'nota_pengeluaran_'.$id.'_'.time();
	    $this->pdf_gen->generate($html, $filename, true, 'A4', 'portrait');
	}

	public function delete_pengeluaran($id)
	{
		$this->m_out->delete_data('tbl_trans_keluar_detail', ['id_trans_keluar' => $id]);
		$this->m_out->delete_data('tbl_trans_keluar', ['id' => $id]);

		echo json_encode(array(
			"status" => TRUE,
			"pesan" => 'Data Pengambilan dengan kode '.$id.' Berhasil dihapus'
		));
	}	

	public function get_header_modal_form()
	{
		$data = array(
			'kode_pencatatan'=> $this->m_out->getKodePengeluaran(),
		);

		echo json_encode($data);
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('fieldNamaBarangOrder') == '') {
			$data['inputerror'][] = 'formNamaBarangOrder';
            $data['error_string'][] = 'Nama Barang is required';
            $data['status'] = FALSE;
		}

		if($this->input->post('fieldNamaSatuanOrder') == '')
		{
			$data['inputerror'][] = 'formNamaSatuanOrder';
			$data['error_string'][] = 'Satuan is required';
			$data['status'] = FALSE;
		}

        if($this->input->post('fieldJumlahBarangOrder') == '')
		{
			$data['inputerror'][] = 'formJumlahBarangOrder';
			$data['error_string'][] = 'Jumlah Barang is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('fieldTanggalOrder') == '')
		{
			$data['inputerror'][] = 'fieldTanggalOrder';
			$data['error_string'][] = 'Tanggal is required';
			$data['status'] = FALSE;
		}
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
	}

	public function suggest_pengeluaran()
	{
		$q = strtolower($_GET['term']);
		$query = $this->m_out->lookup_pengeluaran($q);
		
		foreach ($query as $row) {
			$resultset[] = [
						'label' => $row->nama,
						'id' => $row->kode.'-'.$row->kode_in_text
					];
		}
		echo json_encode($resultset);
	}

	public function get_data_barang($rowIdBrg)
	{
		$query = $this->m_out->lookup2($rowIdBrg);
		echo json_encode($query);
	}

	public function cek_status_kuncian($bulan, $tahun)
	{
		$q = $this->db->query("SELECT * FROM tbl_log_kunci WHERE bulan = '" . $bulan . "' and tahun ='" . $tahun . "'");
		if ($q->num_rows() > 0) {
			$query = $q->row();
			if ($query->is_kunci == '1') {
				return TRUE;
			} else {
				return FALSE;
			}
		}else{
			return FALSE;
		}	
	}

}