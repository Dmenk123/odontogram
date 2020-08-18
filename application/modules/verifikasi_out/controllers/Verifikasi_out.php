<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifikasi_out extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		//profil data
		$this->load->model('profil/mod_profil','prof');
		$this->load->model('mod_verifikasi_out','m_vout');
	}

	public function index()
	{
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
		
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->prof->get_detail_pengguna($id_user);

		$data = array(
			'data_user' => $data_user,
			'arr_bulan' => $arr_bulan
		);

		$content = [
			'css' 	=> 'cssVerifikasiOut',
			'modal' => 'modalVerifikasiOut',
			'js'	=> 'jsVerifikasiOut',
			'view'	=> 'view_list_verifikasi_out'
		];

		$this->template_view->load_view($content, $data);
	}

	public function list_verifikasi($bulan, $tahun)
	{
		$tanggal_awal = date('Y-m-d', strtotime($tahun . '-' . $bulan . '-01'));
		$tanggal_akhir = date('Y-m-t', strtotime($tahun . '-' . $bulan . '-01'));
		$list = $this->m_vout->get_datatables($tanggal_awal, $tanggal_akhir);
		$data = array();
		$no =$_POST['start'];
		foreach ($list as $listV) {
			$link_detail = site_url('verifikasi_out/verifikasi_detail/').$listV->id;
			$link_verifikasi = site_url('verifikasi_out/proses/').$listV->id;
			$no++;
			$row = array();
			$row[] = $listV->id;
			$row[] = date('d-m-Y', strtotime($listV->tanggal));
			$row[] = $listV->username;
			$row[] = $listV->pemohon;
			
			$row[] = '
				<a class="btn btn-sm btn-success" href="'.$link_detail.'" title="Detail" id="btn_detail" onclick="">
					<i class="glyphicon glyphicon-info-sign"></i></a>
				<a class="btn btn-sm btn-primary" href="'.$link_verifikasi.'" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
			';

			$data[] = $row;
		}//end loop

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_vout->count_all($tanggal_awal, $tanggal_akhir),
			"recordsFiltered" => $this->m_vout->count_filtered($tanggal_awal, $tanggal_akhir),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function proses($id)
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->prof->get_detail_pengguna($id_user);
		$data_pengeluaran = $this->m_vout->get_by_id($id);
		$data_detail = $this->m_vout->get_detail_by_id($id);

		foreach ($data_detail as $key => $val) {
			$arr_tipe_akun_internal = explode("-", $val->kode_in_text_akun);
			$kode_int = trim($arr_tipe_akun_internal[0]);
			$kode_in_text_int = trim($arr_tipe_akun_internal[1]);
			$kode_akun_ext = $this->m_vout->lookup_akun_external($kode_int, $kode_in_text_int);

			$data_kode[$key]['kodetext_akun_external'] = $kode_akun_ext->kodetext_akun_external;
			$data_kode[$key]['tipe_akun_external'] =  $kode_akun_ext->tipe_akun_external;
		}

		foreach ($data_kode as $keys => $vals) {
			$cek = $this->m_vout->get_data_akun_external($vals['kodetext_akun_external'], $vals['tipe_akun_external']);
			$data_detail[$keys]->nama_akun_external = $cek->nama;
		}
		
		echo "<pre>";
		print_r ($data_detail);
		echo "</pre>";
		exit;
		
		$data = array(
			'data_user'	 => $data_user,
			'data_form'	 => $data_pengeluaran,
			'data_detail' => $data_detail
		);

		$content = [
			'css' 	=> 'cssVerifikasiOut',
			'modal' => 'modalVerifikasiOut',
			'js'	=> 'jsVerifikasiOut',
			'view'	=> 'view_list_verifikasi_out_proses'
		];

		$this->template_view->load_view($content, $data);
	}

	public function suggest_kode_akun()
	{
		if (isset($_GET['term'])) {
			$q = strtolower($_GET['term']);
		}else{
			$q = '';
		}
		
		$query = $this->m_vout->lookup_kode_akun($q);
		
		foreach ($query as $row) {
			$akun[] = array(
				'id' => $row->tipe.'-'.$row->kode_in_text,
				'text' => $row->kode_in_text.' - '.$row->nama
			);
		}
		echo json_encode($akun);
	}

	public function proses_verifikasi()
	{
		$flag_update_out_header = TRUE;
		$timestamp = date('Y-m-d H:i:s');
		$this->db->trans_begin();
		$nama_file_bukti = '';
		for ($i=0; $i <count($this->input->post('id_detail')); $i++) { 
			if ($this->input->post('ceklis')[$i] == 't' ) {
				//konfigurasi gambar dan resize
				if(!empty($_FILES['i_gambar'.$i]['name']))
				{
					$this->konfigurasi_upload_bukti($this->input->post('i_gambar')[$i]);
					//get detail extension
					$pathDet = $_FILES['i_gambar'.$i]['name'];
					$extDet = pathinfo($pathDet, PATHINFO_EXTENSION);
					if ($this->gbr_bukti->do_upload('i_gambar'.$i)) 
					{
						$gbrBukti = $this->gbr_bukti->data();
						//inisiasi variabel u/ digunakan pada fungsi config img bukti
						$nama_file_bukti = $gbrBukti['file_name'];
						//load config img bukti
						$this->konfigurasi_image_resize($nama_file_bukti);
						//clear img lib after resize
						$this->image_lib->clear();
					} //end
				}else{
					$this->db->trans_rollback();
					$this->session->set_flashdata('feedback_gagal','Mohon Lengkapi Kelengkapan Data'); 
					redirect($this->uri->segment(1));
				} 
				
				//set tipe akun
				$arr_akun1 = explode("-",$this->input->post('i_akun')[$i]);
				$tipe_akun = $arr_akun1[0]; 
				//set kode dan sub akun
				$kode_akun = null;
				$sub1_akun = null;
				$sub2_akun = null;
				$arr_akun2 = explode(".", $arr_akun1[1]);
				for ($z=0; $z <count($arr_akun2); $z++) { 
					if ($z == 0) {
						$kode_akun = $arr_akun2[$z];
					}elseif($z == 1){
						$sub1_akun = $arr_akun2[$z];
					}elseif($z == 2){
						$sub2_akun = $arr_akun2[$z];
					}
				}

				$data = [
					'id' => $this->m_vout->getKodeVerifikasi(),
					'id_out' => $this->input->post('id_header')[$i],
					'id_out_detail' => $this->input->post('id_detail')[$i],
					'tanggal' => date("Y-m-d"),
					'user_id' => $this->session->userdata('id_user'),
					'gambar_bukti' => $nama_file_bukti,
					'harga_satuan' => $this->input->post('i_harga_raw')[$i],
					'harga_total' => $this->input->post('i_harga_total_raw')[$i],
					'status' => 1,
					'tipe_akun' => $tipe_akun,
					'kode_akun' => $kode_akun,
					'sub1_akun' => $sub1_akun,
					'sub2_akun' => $sub2_akun,
					'created_at' => $timestamp
				];

				$this->db->insert('tbl_verifikasi', $data);
				
				//update trans keluar detail status 1 (selesai)
				$data_trans_keluar_detail = [
					'status' => 1	
				];
				
				$this->db->update('tbl_trans_keluar_detail', $data_trans_keluar_detail, ['id' => $this->input->post('id_detail')[$i]]);
				//end update data detail
			}
		}

		//cek apakah sudah selesai semua detil transaksi pengeluaran, update pengeluaran header apabila sudah selesai semua
		$arr_data_detail_pengeluaran = [];
		$data_detail_pengeluaran = $this->m_vout->get_detail_by_id($this->input->post('id_header')[0]);
		$bln_int = (int)date('m');
		$thn_int = (int)date('Y');
		
		foreach ($data_detail_pengeluaran as $out_detil) {
			$arr_data_detail_pengeluaran[] = $out_detil->status;
		}

		if (in_array("0", $arr_data_detail_pengeluaran)){
			$flag_update_out_header = FALSE;
		}

		if ($flag_update_out_header) {
			//update status data header
			$this->db->update('tbl_trans_keluar', ['status' => 0], ['id' => $this->input->post('id_header')[0]]);
		}

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$this->session->set_flashdata('feedback_gagal','Gagal verifikasi data.'); 
			redirect(base_url()."verifikasi_out?bulan=$bln_int&tahun=$thn_int#tab_progress");
		}
		else {
			$this->db->trans_commit();
			$this->session->set_flashdata('feedback_success','Berhasil Verifikasi data.'); 
			redirect(base_url()."verifikasi_out?bulan=$bln_int&tahun=$thn_int#tab_progress");
		}

	}

	public function konfigurasi_upload_bukti($nmfile)
	{ 
		//konfigurasi upload img display
		$config['upload_path'] = './assets/img/bukti_verifikasi/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
		$config['overwrite'] = TRUE;
		$config['max_size'] = '4000';//in KB (4MB)
		$config['max_width']  = '0';//zero for no limit 
		$config['max_height']  = '0';//zero for no limit
		$config['file_name'] = $nmfile;
		//load library with custom object name alias
		$this->load->library('upload', $config, 'gbr_bukti');
		$this->gbr_bukti->initialize($config);
	}

	public function konfigurasi_image_resize($filename)
	{
		//konfigurasi image lib
	    $config['image_library'] = 'gd2';
	    $config['source_image'] = './assets/img/bukti_verifikasi/'.$filename;
	    $config['create_thumb'] = FALSE;
	    $config['maintain_ratio'] = FALSE;
	    $config['new_image'] = './assets/img/bukti_verifikasi/'.$filename;
	    $config['overwrite'] = TRUE;
	    $config['width'] = 450; //resize
	    $config['height'] = 500; //resize
	    $this->load->library('image_lib',$config); //load image library
	    $this->image_lib->initialize($config);
	    $this->image_lib->resize();
	}

	public function verifikasi_detail()
	{
		$id_user = $this->session->userdata('id_user'); 
		$query_user = $this->prof->get_detail_pengguna($id_user);

		$id = $this->uri->segment(3); 
		$query_header = $this->m_vout->get_by_id($id);
		$query = $this->m_vout->get_detail_by_id($id);

		$data = array(
			'data_user' => $query_user,
			'hasil_header' => $query_header,
			'hasil_data' => $query
		);

		$content = [
			'css' 	=> 'cssVerifikasiOut',
			'modal' => null,
			'js'	=> 'jsVerifikasiOut',
			'view'	=> 'view_detail_verifikasi_out'
		];

		$this->template_view->load_view($content, $data);
	}

	// ===========================================================
	public function list_verifikasi_finish($bulan, $tahun)
	{
		$tanggal_awal = date('Y-m-d', strtotime($tahun . '-' . $bulan . '-01'));
		$tanggal_akhir = date('Y-m-t', strtotime($tahun . '-' . $bulan . '-01'));
		$list = $this->m_vout->get_datatables_finish($tanggal_awal, $tanggal_akhir);
		
		$data = array();
		$no =$_POST['start'];
		foreach ($list as $listFinish) {
			$link_detail = site_url('verifikasi_out/verifikasi_detail_finish/').$listFinish->id;
			$no++;
			$row = array();
			$row[] = $listFinish->id;
			$row[] = date('d-m-Y', strtotime($listFinish->tanggal));
			$row[] = $listFinish->username;
			$row[] = $listFinish->keterangan;
			$row[] = '
						<div>
							<span class="pull-left">Rp. </span>
							<span class="pull-right">'.number_format($listFinish->harga_total,2,",",".").'</span>
						</div>';
			//cek kuncian
			$cek_kunci = $this->cek_status_kuncian(date('m', strtotime($listFinish->tanggal)), date('Y', strtotime($listFinish->tanggal)));

			if ($cek_kunci) {
				$row[] = '
					<a class="btn btn-sm btn-success" href="'.$link_detail.'" title="Detail" id="btn_detail" onclick="">
						<i class="glyphicon glyphicon-info-sign"></i></a>';
			}else{
				if ($this->session->userdata('id_level_user') == '4') {
					$row[] = '
						<a class="btn btn-sm btn-success" href="'.$link_detail.'" title="Detail" id="btn_detail" onclick="">
							<i class="glyphicon glyphicon-info-sign"></i></a>
					';
				}else{
					$row[] = '
						<a class="btn btn-sm btn-success" href="'.$link_detail.'" title="Detail" id="btn_detail" onclick="">
							<i class="glyphicon glyphicon-info-sign"></i></a>
						<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="deleteVerifyFinish('."'".$listFinish->id."'".')"><i class="glyphicon glyphicon-trash"></i></a>
					';
				}	
			}

			$data[] = $row;
		}//end loop

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_vout->count_all_finish($tanggal_awal, $tanggal_akhir),
			"recordsFiltered" => $this->m_vout->count_filtered_finish($tanggal_awal, $tanggal_akhir),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function verifikasi_detail_finish()
	{
		$id_user = $this->session->userdata('id_user'); 
		$query_user = $this->prof->get_detail_pengguna($id_user);

		$id = $this->uri->segment(3); 
		$query = $this->m_vout->get_verifikasi_by_id($id);

		$data = array(
			'data_user' => $query_user,
			'hasil_data' => $query
		);

		$content = [
			'css' 	=> 'cssVerifikasiOut',
			'modal' => null,
			'js'	=> 'jsVerifikasiOut',
			'view'	=> 'view_detail_verifikasi_out_finish'
		];
		
		$this->template_view->load_view($content, $data);
	}

	public function hapus_verifikasi_out_finish($id)
	{
		$this->db->trans_begin();

		//ambil data dan hapus data verifikasi
		$data_lawas = $this->db->query("select * from tbl_verifikasi where id = '".$id."'")->row();
		$this->m_vout->delete_ver_by_id($id);
		//update pengeluaran detil
		$this->db->update('tbl_trans_keluar_detail', ['status' => 0], ['id' => $data_lawas->id_out_detail]);
		//update pengeluaran detil
		$this->db->update('tbl_trans_keluar', ['status' => 1], ['id' => $data_lawas->id_out]);
		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			echo json_encode(array(
				"status" => FALSE,
				"pesan" => 'Data gagal dihapus'
			));
		}
		else {
			$this->db->trans_commit();
			echo json_encode(array(
				"status" => TRUE,
				"pesan" => 'Data Sukses dihapus'
			));
		}

		
	}

	// ============================================================
	

	public function cetak_report_trans_order_detail()
	{
		$this->load->library('Pdf_gen');

		$id_trans_order = $this->uri->segment(3);
		$query_header = $this->m_vout->get_detail_header($id_trans_order);
		$query = $this->m_vout->get_detail($id_trans_order);

		$data = array(
			'title' => 'Report Transaksi Permintaan',
			'hasil_header' => $query_header,
			'hasil_data' => $query, 
		);

	    $html = $this->load->view('view_detail_trans_order_report', $data, true);
	    
	    $filename = 'report_permintaan_'.$id_trans_order.'_'.time();
	    $this->pdf_gen->generate($html, $filename, true, 'A4', 'portrait');
	}

	public function get_header_modal_form()
	{
		$data = array(
			'kode_pencatatan'=> $this->m_vout->getKodePengeluaran(),
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

	public function get_data_barang($rowIdBrg)
	{
		$query = $this->m_vout->lookup2($rowIdBrg);
		echo json_encode($query);
	}

	public function cek_status_kuncian($bulan, $tahun)
	{
		$q = $this->db->query("SELECT * FROM tbl_log_kunci WHERE bulan = '".$bulan."' and tahun ='".$tahun."'");
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