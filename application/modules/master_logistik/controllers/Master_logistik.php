<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_logistik extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') === null) {
			return redirect('login');
		}

		$this->load->model('m_user');
		$this->load->model('m_logistik');
		$this->load->model('m_global');
	}

	public function index()
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
		$data_jabatan = $this->m_global->multi_row('*', 'deleted_at is null', 'm_jabatan', null, 'nama');
		$jenis = $this->m_global->getSelectedData('m_jenis_logistik', ['deleted_at' => null])->result_array();
				
		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Pengelolaan Data Master Logistik dan Obat',
			'data_user' => $data_user,
			'data_jabatan'	=> $data_jabatan,
			'jenis' => $jenis,
		);

		/**
		 * content data untuk template
		 * param (css : link css pada direktori assets/css_module)
		 * param (modal : modal komponen pada modules/nama_modul/views/nama_modal)
		 * param (js : link js pada direktori assets/js_module)
		 */
		$content = [
			'css' 	=> null,
			'modal' => 'modal_master_logistik',
			'js'	=> 'master_logistik.js',
			'view'	=> 'view_master_logistik'
		];

		$this->template_view->load_view($content, $data);
	}

	public function list_logistik()
	{
		$list = $this->m_logistik->get_datatable();
		
		$data = array();
		$no =$_POST['start'];
		foreach ($list as $log) {
			$no++;
			$row = array();
			//loop value tabel db
			$row[] = $no;
			$row[] = $log->kode_logistik;
			$row[] = $log->nama_logistik;
			// $row[] = $log->harga_beli;
			// $row[] = $log->harga_jual;
			$row[] = $log->stok;
			$row[] = $log->jenis;
			// $aktif_txt = ($diag->is_aktif == 1) ? '<span style="color:blue;">Aktif</span>' : '<span style="color:red;">Non Aktif</span>';
			// $row[] = $aktif_txt;			
			
			$str_aksi = '
				<div class="btn-group">
					<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Opsi</button>
					<div class="dropdown-menu">
						<button class="dropdown-item" onclick="edit_logistik(\''.$log->id_logistik.'\')">
							<i class="la la-pencil"></i> Edit Logistik
						</button>
						<button class="dropdown-item" onclick="delete_logistik(\''.$log->id_logistik.'\')">
							<i class="la la-trash"></i> Hapus
						</button>
			';

			$row[] = $str_aksi;
			$data[] = $row;

		}//end loop

		$output = [
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_logistik->count_all(),
			"recordsFiltered" => $this->m_logistik->count_filtered(),
			"data" => $data
		];
		
		echo json_encode($output);
	}

	public function list_jenis_logistik()
	{
		$list = $this->m_global->getSelectedData('m_jenis_logistik', ['deleted_at' => null])->result_array();
		
		$data = array();
		$no =$_POST['start'];
		foreach ($list as $key) {
			$no++;
			$row = array();
			//loop value tabel db
			$row[] = $no;
			$row[] = $key['jenis'];
			// $aktif_txt = ($diag->is_aktif == 1) ? '<span style="color:blue;">Aktif</span>' : '<span style="color:red;">Non Aktif</span>';
			// $row[] = $aktif_txt;			
			
			$str_aksi = '
				<div class="btn-group">
					<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Opsi</button>
					<div class="dropdown-menu">
						<button class="dropdown-item" onclick="delete_jenis_logistik(\''.$key['id_jenis_logistik'].'\')">
							<i class="la la-trash"></i> Hapus
						</button>
			';

			$row[] = $str_aksi;
			$data[] = $row;

		}//end loop

		$output = [
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_logistik->count_all(),
			"recordsFiltered" => $this->m_logistik->count_filtered(),
			"data" => $data
		];
		
		echo json_encode($output);
	}

	public function edit_logistik()
	{
		$this->load->library('Enkripsi');
		$id_user = $this->session->userdata('id_user');
		$data_user = $this->m_user->get_by_id($id_user);
	
		$id = $this->input->post('id');
		$oldData = $this->m_logistik->get_by_id($id);
		
		if(!$oldData){
			return redirect($this->uri->segment(1));
		}

		$data = array(
			'data_user' => $data_user,
			'old_data'	=> $oldData
		);
		
		echo json_encode($data);
	}

	public function add_data_logistik()
	{
		$this->load->library('Enkripsi');
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$arr_valid = $this->rule_validasi();
		
		$nama 		= trim($this->input->post('nama'));
		$kode 		= trim($this->input->post('kode'));
		// $harga_beli = trim($this->input->post('harga_beli'));
		// $harga_jual = trim($this->input->post('harga_jual'));
		$stok 		= trim($this->input->post('stok'));
		$jenis 		= trim($this->input->post('jenis'));

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}


		$this->db->trans_begin();
		
		$data = [
			'kode_logistik' => $kode,
			'nama_logistik' => $nama,
			'harga_beli' 	=> 0,
			'harga_jual' 	=> 0,
			'stok'			=> $stok,
			'id_jenis_logistik' => $jenis,
			'created_at' => $timestamp
		];
		
		$insert = $this->m_logistik->save($data);
		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['pesan'] = 'Gagal menambahkan Logistik';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['pesan'] = 'Sukses menambahkan Logistik';
		}

		echo json_encode($retval);
	}

	public function add_data_jenis_logistik()
	{
	
		$this->load->library('Enkripsi');
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		// $arr_valid = $this->rule_validasi();
		
		$nama 		= trim($this->input->post('nama_jenis'));

		$this->db->trans_begin();
		
		$data = [
			
			'jenis' => $nama,
			'created_at' => $timestamp
		];
		
		$insert = $this->m_logistik->save_jenis($data);
		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['pesan'] = 'Gagal menambahkan Jenis Logistik';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['pesan'] = 'Sukses menambahkan Jenis Logistik';
		}

		echo json_encode($retval);
	}

	public function update_data_logistik()
	{
		$id_user = $this->session->userdata('id_user'); 
		$this->load->library('Enkripsi');
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$arr_valid = $this->rule_validasi(true);

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}

		$nama 		= trim($this->input->post('nama'));
		$kode 		= trim($this->input->post('kode'));
		$harga_beli = trim($this->input->post('harga_beli'));
		$harga_jual = trim($this->input->post('harga_jual'));
		$stok 		= trim($this->input->post('stok'));
		$jenis 		= trim($this->input->post('jenis'));

		$this->db->trans_begin();
		
		$data = [
			'nama_logistik' => $nama,
			'kode_logistik' => $kode,
			'harga_beli'	=> $harga_beli,
			'harga_jual'	=> $harga_jual,
			'stok'			=> $stok,
			'id_jenis_logistik' => $jenis,
			'updated_at' => $timestamp
		];

		$where = ['id_logistik' => $this->input->post('id_logistik')];
		$update = $this->m_logistik->update($where, $data);
				
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$data['status'] = false;
			$data['pesan'] = 'Gagal update Master Logistik';
		}else{
			$this->db->trans_commit();
			$data['status'] = true;
			$data['pesan'] = 'Sukses update Master Logistik';
		}
		
		echo json_encode($data);
	}

	/**
	 * Hanya melakukan softdelete saja
	 * isi kolom updated_at dengan datetime now()
	 */
	public function delete_logistik()
	{
		$id = $this->input->post('id');
		$del = $this->m_logistik->softdelete_by_id($id);
		if($del) {
			$retval['status'] = TRUE;
			$retval['pesan'] = 'Data Master Logistik Berhasil dihapus';
		}else{
			$retval['status'] = FALSE;
			$retval['pesan'] = 'Data Master Logistik Gagal dihapus';
		}

		echo json_encode($retval);
	}

	public function delete_jenis_logistik()
	{
		$id = $this->input->post('id');
		$del = $this->m_global->softdelete(['id_jenis_logistik' => $id], 'm_jenis_logistik');
		if ($del) {
			$retval['status'] = TRUE;
			$retval['pesan'] = 'Data Master Jenis Logistik Berhasil dihapus';
		} else {
			$retval['status'] = FALSE;
			$retval['pesan'] = 'Data Master Jenis Logistik Gagal dihapus';
		}

		echo json_encode($retval);
	}

	public function edit_status_pegawai()
	{
		$input_status = $this->input->post('status');
		// jika aktif maka di set ke nonaktif / "0"
		$status = ($input_status == "aktif") ? $status = 0 : $status = 1;
			
		$input = ['is_aktif' => $status];

		$where = ['id' => $this->input->post('id')];

		$this->m_pegawai->update($where, $input);

		if ($this->db->affected_rows() == '1') {
			$data = array(
				'status' => TRUE,
				'pesan' => "Status Pegawai berhasil di ubah.",
			);
		}else{
			$data = array(
				'status' => FALSE
			);
		}

		echo json_encode($data);
	}

	public function import_excel()
	{
		$select = "m_pegawai.*, m_jabatan.nama as nama_jabatan";
		$where = ['m_pegawai.deleted_at' => null];
		$table = 'm_pegawai';
		$join = [ 
			[
				'table' => 'm_jabatan',
				'on'	=> 'm_pegawai.id_jabatan = m_jabatan.id'
			]
		];

		$data = $this->m_global->multi_row($select, $where, $table, $join, 'm_pegawai.kode');
		
		$spreadsheet = $this->excel->spreadsheet_obj();
		$writer = $this->excel->xlsx_obj($spreadsheet);
		$number_format_obj = $this->excel->number_format_obj();
		
		$spreadsheet
			->getActiveSheet()
			->getStyle('E2:E1000')
			->getNumberFormat()
			->setFormatCode($number_format_obj::FORMAT_NUMBER);

		$spreadsheet
			->getActiveSheet()
			->getStyle('F2:F1000')
			->getNumberFormat()
			->setFormatCode($number_format_obj::FORMAT_NUMBER);	
		
		$sheet = $spreadsheet->getActiveSheet();

		$sheet
			->setCellValue('A1', 'Kode')
			->setCellValue('B1', 'Nama')
			->setCellValue('C1', 'Alamat')
			->setCellValue('D1', 'Jabatan')
			->setCellValue('E1', 'Telp. 1')
			->setCellValue('F1', 'Telp. 2')
			->setCellValue('G1', 'Status Aktif');
		
		$startRow = 2;
		$row = $startRow;
		if($data){
			foreach ($data as $key => $val) {
				$sts = ($val->is_aktif = '1') ? 'Aktif' : 'Non Aktif';
				
				$sheet
					->setCellValue("A{$row}", $val->kode)
					->setCellValue("B{$row}", $val->nama)
					->setCellValue("C{$row}", $val->alamat)
					->setCellValue("D{$row}", $val->nama_jabatan)
					->setCellValue("E{$row}", $val->telp_1)
					->setCellValue("F{$row}", $val->telp_2)
					->setCellValue("G{$row}", $sts);
				$row++;
			}
			$endRow = $row - 1;
		}
		
		
		$filename = 'master-pegawai-'.time();
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
		
	}

	public function template_excel()
	{
		$file_url = base_url().'files/template_dokumen/template_master_pegawai.xlsx';
		header('Content-Type: application/octet-stream');
		header("Content-Transfer-Encoding: Binary"); 
		header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
		readfile($file_url); 
	}

	public function export_data_master()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');

		$file_mimes = ['text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
		$retval = [];
		if(isset($_FILES['file_excel']['name']) && in_array($_FILES['file_excel']['type'], $file_mimes)) {
			$arr_file = explode('.', $_FILES['file_excel']['name']);
			$extension = end($arr_file);
			if('csv' == $extension){
				$reader = $this->excel->csv_reader_obj();
			} else {
				$reader = $this->excel->reader_obj();
			}

			$spreadsheet = $reader->load($_FILES['file_excel']['tmp_name']);
			$sheetData = $spreadsheet->getActiveSheet()->toArray();
			
			for ($i=0; $i <count($sheetData); $i++) { 
				
				if ($sheetData[$i][0] == '' || $sheetData[$i][1] == '' || $sheetData[$i][2] == '' || $sheetData[$i][3] == '') {
					
					if($i == 0) {
						$flag_kosongan = true;
						$status_ekspor = false;
						$pesan = "Data Kosong...";
					}else{
						$flag_kosongan = false;
						$status_ekspor = true;
						$pesan = "Data Sukses Di Ekspor";
					}

					break;
				}

				$data['kode'] = strtoupper(strtolower(trim($sheetData[$i][0])));
				$data['nama'] = strtoupper(strtolower(trim($sheetData[$i][1])));
				$data['alamat'] = strtoupper(strtolower(trim($sheetData[$i][2])));
				
				#jabatan
				$id_jabatan = $this->m_pegawai->get_id_jabatan_by_name(strtolower(trim($sheetData[$i][3])));
				
				if($id_jabatan){
					$data['id_jabatan'] = $id_jabatan->id;
				}else{
					if($i == 0) {
						continue;
					}else{
						$flag_kosongan = false;
						$status_ekspor = false;
						$pesan = "Terjadi Kesalahan Dalam Penulisan Nama Jabatan, Mohon Cek Kembali";
						break;
					}
				}
				#end jabatan

				if($sheetData[$i][4] != ''){
					$data['telp_1'] = trim($sheetData[$i][4]);
				}

				if($sheetData[$i][5] != ''){
					$data['telp_2'] = trim($sheetData[$i][5]);
				}

				$data['created_at'] = $timestamp;
				$data['is_aktif'] = 1;

				$retval[] = $data;
			}

			if($status_ekspor) {
				// var_dump(count($retval));exit;
				## jika array maks cuma 1, maka batalkan (soalnya hanya header saja disana) ##
				if(count($retval) <= 1) {
					echo json_encode([
						'status' => false,
						'pesan'	=> 'Ekspor dibatalkan, Data Kosong...'
					]);

					return;
				}
				
				$this->db->trans_begin();
				
				#### truncate loh !!!!!!
				$this->m_pegawai->trun_master_pegawai();
				
				foreach ($retval as $keys => $vals) {
					#### simpan
					$vals['id'] = $this->m_pegawai->get_max_id_pegawai();
					$simpan = $this->m_pegawai->save($vals);
				}

				if ($this->db->trans_status() === FALSE){
					$this->db->trans_rollback();
					$status = false;
					$pesan = 'Gagal melakukan ekspor, cek ulang dalam melakukan pengisian data excel';
				}else{
					$this->db->trans_commit();
					$status = true;
					$pesan = 'Sukses ekspor data pegawai';
				}

				echo json_encode([
					'status' => $status,
					'pesan'	=> $pesan
				]);
				
			}else{
				echo json_encode([
					'status' => false,
					'pesan'	=> $pesan
				]);
			}

		}else{
			echo json_encode([
				'status' => false,
				'pesan'	=> 'Terjadi Kesalahan dalam upload file. pastikan file adalah file excel .xlsx/.xls'
			]);
		}
	}

	public function cetak_data()
	{
		$select = "
					m_logistik.nama_logistik, 
					m_logistik.kode_logistik,
					m_logistik.nama_logistik,
					m_logistik.harga_beli,
					m_logistik.harga_jual,
					m_logistik.stok,
					m_jenis_logistik.jenis";
		$where = ["m_logistik.deleted_at is null"];
		$join = [ 
			[
				'table' => 'm_jenis_logistik',
				'on'	=> 'm_logistik.id_jenis_logistik = m_jenis_logistik.id_jenis_logistik'
			]
		];
		$orderby = "m_logistik.kode_logistik asc";
		$data = $this->m_global->multi_row($select, $where, 'm_logistik', $join, $orderby);
		$data_klinik = $this->m_global->single_row('*', 'deleted_at is null', 'm_klinik');
		$retval = [
			'data' => $data,
			'data_klinik' => $data_klinik,
			'title' => 'Master Data Logistik / Obat'
		];

		// $this->load->view('pdf', $retval);
		$html = $this->load->view('pdf', $retval, true);
	    $filename = 'master_data_logistik_'.time();
	    $this->lib_dompdf->generate($html, $filename, true, 'A4', 'potrait');
	}

	public function get_select_logistik()
	{
		$term = $this->input->get('term');
		$data_logistik = $this->m_global->multi_row('*', ['deleted_at' => null, 'nama_logistik like' => '%'.$term.'%'], 'm_logistik', null, 'nama_logistik');
		if($data_logistik) {
			foreach ($data_logistik as $key => $value) {
				$row['id'] = $value->id_logistik;
				$row['text'] = $value->kode_logistik.' - '.$value->nama_logistik;
				$row['kode'] = $value->kode_logistik;
				$row['nama'] = $value->nama_logistik;
				$row['harga_jual_raw'] = (float)$value->harga_jual;
				$row['id_jenis_logistik'] =$value->id_jenis_logistik;

				$retval[] = $row;
			}
		}else{
			$retval = false;
		}
		echo json_encode($retval);
	}

	public function get_select_jenis_logistik()
	{
		$term = $this->input->get('term');
		$jenis = $this->m_global->getSelectedData('m_jenis_logistik', ['deleted_at' => null])->result();
		if ($jenis) {
			foreach ($jenis as $key => $value) {
				$row['id'] = $value->id_jenis_logistik;
				$row['text'] = $value->jenis;
				$retval[] = $row;
			}
		} else {
			$retval = false;
		}
		echo json_encode($retval);
	}

	// ===============================================
	private function rule_validasi()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('kode') == '') {
			$data['inputerror'][] = 'kode';
            $data['error_string'][] = 'Wajib mengisi Kode logistik';
            $data['status'] = FALSE;
		}

		if ($this->input->post('nama') == '') {
			$data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Wajib mengisi Nama logistik';
            $data['status'] = FALSE;
		}

		/* if ($this->input->post('harga_beli') == '') {
			$data['inputerror'][] = 'harga_beli';
            $data['error_string'][] = 'Wajib mengisi Harga Beli';
            $data['status'] = FALSE;
		}

		if ($this->input->post('harga_jual') == '') {
			$data['inputerror'][] = 'harga_jual';
            $data['error_string'][] = 'Wajib mengisi Harga Jual';
            $data['status'] = FALSE;
		} */

		if ($this->input->post('stok') == '') {
			$data['inputerror'][] = 'stok';
            $data['error_string'][] = 'Wajib mengisi Stok';
            $data['status'] = FALSE;
		}

		if ($this->input->post('jenis') == '') {
			$data['inputerror'][] = 'jenis';
            $data['error_string'][] = 'Wajib mengisi JeniS Logistik';
            $data['status'] = FALSE;
		}

	
        return $data;
	}
}
