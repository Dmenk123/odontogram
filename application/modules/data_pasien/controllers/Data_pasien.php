<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_pasien extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') === false) {
			return redirect('login');
		}

		$this->load->model('master_user/m_user');
		$this->load->model('m_global');
		$this->load->model('m_pasien');
		$this->load->model('m_data_medik');
	}

	public function index()
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
			
		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Pengelolaan Data Pasien',
			'data_user' => $data_user
		);

		/**
		 * content data untuk template
		 * param (css : link css pada direktori assets/css_module)
		 * param (modal : modal komponen pada modules/nama_modul/views/nama_modal)
		 * param (js : link js pada direktori assets/js_module)
		 */
		$content = [
			'css' 	=> null,
			'modal' => 'modal_data_pasien',
			'js'	=> 'data_pasien.js',
			'view'	=> 'view_data_pasien'
		];

		$this->template_view->load_view($content, $data);
	}

	public function add()
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
			
		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Pengelolaan Data Pasien',
			'data_user' => $data_user
		);

		/**
		 * content data untuk template
		 * param (css : link css pada direktori assets/css_module)
		 * param (modal : modal komponen pada modules/nama_modul/views/nama_modal)
		 * param (js : link js pada direktori assets/js_module)
		 */
		$content = [
			'css' 	=> null,
			'modal' => null,
			'js'	=> 'data_pasien.js',
			'view'	=> 'form_data_pasien'
		];

		$this->template_view->load_view($content, $data);
	}

	public function edit($enc_id)
	{
		if(strlen($enc_id) != 32) {
			return redirect(base_url($this->uri->segment(1)));
		}

		$this->load->library('Enkripsi');
		$id_pasien = $this->enkripsi->enc_dec('decrypt', $enc_id);
		
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);

		$select = "pas.*, mdk.*";
		$where = ['pas.deleted_at' => null, 'pas.id' => $id_pasien];
		$table = 'm_pasien as pas';
		$join = [ 
			[
				'table' => 'm_data_medik as mdk',
				'on'	=> 'pas.id = mdk.id_pasien'
			]
		];
		$data_pasien = $this->m_global->single_row($select,$where,$table, $join);
		
		if(!$data_pasien) {
			return redirect(base_url($this->uri->segment(1)));
		}

		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Edit Data Pasien',
			'data_user' => $data_user,
			'data_pasien' => $data_pasien
		);

		/**
		 * content data untuk template
		 * param (css : link css pada direktori assets/css_module)
		 * param (modal : modal komponen pada modules/nama_modul/views/nama_modal)
		 * param (js : link js pada direktori assets/js_module)
		 */
		$content = [
			'css' 	=> null,
			'modal' => null,
			'js'	=> 'data_pasien.js',
			'view'	=> 'form_data_pasien'
		];

		$this->template_view->load_view($content, $data);
	}

	public function detail_pasien()
	{
		$enc_id = $this->input->post('id');
		
		if(strlen($enc_id) != 32) {
			echo json_encode([
				'status' => false,
				'pesan' => 'Data Tidak Valid'
			]);
			return;
		}

		$this->load->library('Enkripsi');
		$id_pasien = $this->enkripsi->enc_dec('decrypt', $enc_id);

		$select = "pas.*, mdk.*, CASE WHEN pas.jenis_kelamin = 'L' THEN 'Laki-Laki' ELSE 'Perempuan' END as jenkel";
		$where = ['pas.deleted_at' => null, 'pas.id' => $id_pasien];
		$table = 'm_pasien as pas';
		$join = [ 
			[
				'table' => 'm_data_medik as mdk',
				'on'	=> 'pas.id = mdk.id_pasien'
			]
		];
		$data_pasien = $this->m_global->single_row($select,$where,$table, $join);
		
		if(!$data_pasien) {
			echo json_encode([
				'status' => false,
				'pesan' => 'Data Pasien Tidak Ditemukan'
			]);
			return;
		}

		$data = array(
			'status' => true,
			'old_data' => $data_pasien
		);

		echo json_encode($data);
	}

	public function list_data()
	{
		$this->load->library('Enkripsi');
		$list = $this->m_pasien->get_datatable_pasien();
		$data = array();
		// $no =$_POST['start'];
		foreach ($list as $val) {
			// $no++;
			$row = array();
			//loop value tabel db
			// $row[] = $no;
			$row[] = $val->no_rm;
			$row[] = $val->nama;
			$row[] = $val->nik;
			$row[] = ($val->jenis_kelamin == 'L') ? '<span style="color:blue;">Laki-Laki</span>' : '<span style="color:magenta;">Perempuan</span>';
			$row[] = $val->alamat_rumah;
			$row[] = $val->hp;
			$row[] = ($val->is_aktif == 1) ? '<span style="color:blue;">Aktif</span>' : '<span style="color:red;">Non Aktif</span>';
			
			$str_aksi = '
				<div class="btn-group">
					<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Opsi</button>
					<div class="dropdown-menu">
						<button class="dropdown-item" onclick="detail_pasien(\''.$this->enkripsi->enc_dec('encrypt', $val->id).'\')">
							<i class="la la-search"></i> Detail Pasien
						</button>
						<a class="dropdown-item" href="'.base_url('data_pasien/edit/').$this->enkripsi->enc_dec('encrypt', $val->id).'"">
							<i class="la la-pencil"></i> Edit Pasien
						</a>
						<button class="dropdown-item" onclick="delete_pasien(\''.$this->enkripsi->enc_dec('encrypt', $val->id).'\')">
							<i class="la la-trash"></i> Hapus
						</button>
						<a class="dropdown-item" target="_blank" href="'.base_url('data_pasien/cetak_data_individu/').$this->enkripsi->enc_dec('encrypt', $val->id).'">
							<i class="la la-print"></i> Cetak Pasien Ini
						</a>
			';

			if ($val->is_aktif == 1) {
				$str_aksi .=
				'<button class="dropdown-item btn_edit_status" title="aktif" id="'.$this->enkripsi->enc_dec('encrypt', $val->id).'" value="aktif"><i class="la la-check">
				</i> Aktif</button>';
			}else{
				$str_aksi .=
				'<button class="dropdown-item btn_edit_status" title="nonaktif" id="'.$this->enkripsi->enc_dec('encrypt', $val->id).'" value="nonaktif"><i class="la la-close">
				</i> Non Aktif</button>';
			}	

			$str_aksi .= '</div></div>';
			$row[] = $str_aksi;

			$data[] = $row;
		}//end loop

		$output = [
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_pasien->count_all(),
			"recordsFiltered" => $this->m_pasien->count_filtered(),
			"data" => $data
		];
		
		echo json_encode($output);
	}

	public function simpan_data()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$id_pasien = $this->input->post('id_pasien');
		
		######### flag pasien baru
		if($id_pasien != '') {
			$cek = $this->m_pasien->get_by_id($id_pasien);
			if($cek) {
				$flag_data_baru = false;
			}else{
				$flag_data_baru = true;
			}
		}else{
			$flag_data_baru = true;
		}
		######### end flag pasien baru

		######## flag no_rm otomatis
		if($this->input->post('no_rm') != ''){
			$rm_otomatis = false;
		}else{
			$rm_otomatis = true;
		}
		######## end flag no_rm otomatis
		$arr_valid = $this->rule_validasi();
		
		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}

		$nama = contul(trim(strtoupper($this->input->post('nama'))));
		$nik = contul(trim($this->input->post('nik')));
		$tempat_lahir = contul(trim($this->input->post('tempat_lahir')));
		$tanggal_lahir = contul(trim($this->input->post('tanggal_lahir')));
		$jenkel = contul(trim($this->input->post('jenkel')));
		$suku = contul(trim($this->input->post('suku')));
		$pekerjaan = contul(trim($this->input->post('pekerjaan')));
		$hp = contul(trim($this->input->post('hp')));
		$telp = contul(trim($this->input->post('telp')));
		$alamat_rumah = contul(trim($this->input->post('alamat_rumah')));
		$alamat_kantor = contul(trim($this->input->post('alamat_kantor')));

		$gol_darah = contul(trim($this->input->post('gol_darah')));
		$tekanan_darah_val = contul(trim($this->input->post('tekanan_darah_val')));
		$tekanan_darah = $this->input->post('tekanan_darah');
		$penyakit_jantung = $this->input->post('penyakit_jantung');
		$diabetes = $this->input->post('diabetes');
		$haemopilia = $this->input->post('haemopilia');
		$hepatitis = $this->input->post('hepatitis');
		$gastring = $this->input->post('gastring');
		$penyakit_lainnya = $this->input->post('penyakit_lainnya');
		$alergi_obat = $this->input->post('alergi_obat');
		$alergi_obat_val = contul(trim($this->input->post('alergi_obat_val')));
		$alergi_makanan = $this->input->post('alergi_makanan');
		$alergi_makanan_val = contul(trim($this->input->post('alergi_makanan_val')));

		$this->db->trans_begin();
		
		###################### data pasien

		$pasien = [
			'nama' => $nama,
			'nik' => $nik,
			'tempat_lahir' => $tempat_lahir,
			'tanggal_lahir' => $obj_date->createFromFormat('d/m/Y', $tanggal_lahir)->format('Y-m-d'),
			'jenis_kelamin' => $jenkel,
			'suku' => $suku,
			'pekerjaan' => $pekerjaan,
			'hp' => $hp,
			'telp_rumah' => $telp,
			'alamat_rumah' => $alamat_rumah,
			'alamat_kantor' => $alamat_kantor
		];

		##jika data baru
		if($flag_data_baru) {
			$id_pasien = $this->m_pasien->get_max_id_pasien();

			$pasien['id'] = $id_pasien;
			
			if($rm_otomatis) {
				$pasien['no_rm'] = $this->m_pasien->get_kode_rm(substr($nama,0,2));
			}else{
				$pasien['no_rm'] = trim($this->input->post('no_rm'));
			}

			$pasien['created_at'] = $timestamp;
			$pasien['is_aktif'] = 1;

			$insert = $this->m_pasien->save($pasien);
		}
		##jika update data
		else{
			$pasien['updated_at'] = $timestamp;
			
			$where = ['id' => $id_pasien];
			$update = $this->m_pasien->update($where, $pasien);
		}

		###################### data medik
		
		$medik = [
			'gol_darah' => $gol_darah,
			'tekanan_darah' => $tekanan_darah,
			'tekanan_darah_val' => $tekanan_darah_val,
			'penyakit_jantung' => $penyakit_jantung,
			'diabetes' => $diabetes,
			'haemopilia' => $haemopilia,
			'hepatitis' => $hepatitis,
			'gastring' => $gastring,
			'penyakit_lainnya' => $penyakit_lainnya,
			'alergi_obat' => $alergi_obat,
			'alergi_obat_val' => $alergi_obat_val,
			'alergi_makanan' => $alergi_makanan,
			'alergi_makanan_val' => $alergi_makanan_val
		];

		##jika data baru
		if($flag_data_baru) {
			$medik['id'] = $this->m_data_medik->get_max_id_medik();
			$medik['id_pasien'] = $id_pasien;
			$medik['created_at'] = $timestamp;

			$insert = $this->m_data_medik->save($medik);
		}
		##jika update data
		else{
			$cek_medik = $this->m_data_medik->get_by_condition(['id_pasien' => $id_pasien], true);
			$medik['updated_at'] = $timestamp;

			$where = ['id' => $cek_medik->id];
			$update = $this->m_data_medik->update($where, $medik);
		}
		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['pesan'] = 'Gagal menambahkan Data Pasien';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['pesan'] = 'Sukses menambahkan Data Pasien';
		}

		echo json_encode($retval);
	}


	/**
	 * Hanya melakukan softdelete saja
	 * isi kolom updated_at dengan datetime now()
	 */
	public function delete_data()
	{
		$this->load->library('Enkripsi');
		$enc_id = $this->input->post('id');
		
		if(strlen($enc_id) != 32) {
			echo json_encode([
				'status' => false,
				'pesan' => 'Data Tidak Valid'
			]);
			return;
		}

		$id_pasien = $this->enkripsi->enc_dec('decrypt', $enc_id);
		$del = $this->m_pasien->softdelete_by_id($id_pasien);
		if($del) {
			$retval['status'] = TRUE;
			$retval['pesan'] = 'Data Pasien Sukses dihapus';
		}else{
			$retval['status'] = FALSE;
			$retval['pesan'] = 'Data Pasien Gagal dihapus';
		}

		echo json_encode($retval);
	}

	public function edit_status_aktif()
	{
		$this->load->library('Enkripsi');
		$enc_id = $this->input->post('id');
		
		if(strlen($enc_id) != 32) {
			echo json_encode([
				'status' => false,
				'pesan' => 'Data Tidak Valid'
			]);
			return;
		}

		$id_pasien = $this->enkripsi->enc_dec('decrypt', $enc_id);
		$input_status = $this->input->post('status');
		// jika aktif maka di set ke nonaktif / "0"
		$status = ($input_status == "aktif") ? $status = 0 : $status = 1;
			
		$input = array('is_aktif' => $status);

		$where = ['id' => $id_pasien];

		$this->m_pasien->update($where, $input);

		if ($this->db->affected_rows() == '1') {
			$data = array(
				'status' => TRUE,
				'pesan' => "Status Pasien berhasil di ubah.",
			);
		}else{
			$data = array(
				'status' => FALSE
			);
		}

		echo json_encode($data);
	}

	public function template_excel()
	{
		$file_url = base_url().'files/template_dokumen/template_data_pasien.xlsx';
		header('Content-Type: application/octet-stream');
		header("Content-Transfer-Encoding: Binary"); 
		header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
		readfile($file_url); 
	}

	public function export_excel()
	{
		$select = "pas.*, mdk.*, CASE WHEN pas.jenis_kelamin = 'L' THEN 'Laki-Laki' ELSE 'Perempuan' END as jenkel, CASE WHEN is_aktif = 1 THEN 'Aktif' ELSE 'Non Aktif' END as status_pasien";
		$where = ['pas.deleted_at' => null];
		$table = 'm_pasien as pas';
		$join = [ 
			[
				'table' => 'm_data_medik as mdk',
				'on'	=> 'pas.id = mdk.id_pasien'
			]
		];
		$data = $this->m_global->multi_row($select,$where,$table,$join);
		if($data) {
			$counter = count($data)+1;
		}else{
			$counter = 1;
		}

		$spreadsheet = $this->excel->spreadsheet_obj();
		$writer = $this->excel->xlsx_obj($spreadsheet);
		$number_format_obj = $this->excel->number_format_obj();
		
		$spreadsheet
			->getActiveSheet()
			->getStyle('A1:AA'.$counter)
			->getNumberFormat()
			//format text masih ada bug di nip. jadi kacau
			//->setFormatCode($number_format_obj::FORMAT_TEXT);
			// solusi pake format custom
			->setFormatCode('#');
		
		$sheet = $spreadsheet->getActiveSheet();

		$sheet
			->setCellValue('A1', 'No RM')
			->setCellValue('B1', 'Nama')
			->setCellValue('C1', 'Tempat Lahir')
			->setCellValue('D1', 'Tgl Lahir')
			->setCellValue('E1', 'NIK')
			->setCellValue('F1', 'Jenis Kelamin')
			->setCellValue('G1', 'Suku')
			->setCellValue('H1', 'Pekerjaan')
			->setCellValue('I1', 'Alamat Rumah')
			->setCellValue('J1', 'Telp Rumah')
			->setCellValue('K1', 'Alamat Kantor')
			->setCellValue('L1', 'HP/WA')
			->setCellValue('M1', 'Status Pasien')
			->setCellValue('N1', 'Golongan Darah')
			->setCellValue('O1', 'Tekanan Darah')
			->setCellValue('P1', 'Nilai Tek Darah')
			->setCellValue('Q1', 'Penyakit Jantung')
			->setCellValue('R1', 'Diabetes')
			->setCellValue('S1', 'Haemopilia')
			->setCellValue('T1', 'Hepatitis')
			->setCellValue('U1', 'Gastring')
			->setCellValue('V1', 'Penyakit Lainnya')
			->setCellValue('W1', 'Alergi Obat')
			->setCellValue('X1', 'List Alergi Obat')
			->setCellValue('Y1', 'Alergi Makanan')
			->setCellValue('Z1', 'List Alergi Makanan');
					
		$startRow = 2;
		$row = $startRow;
		if($data){
			foreach ($data as $key => $val) {
				$sts = ($val->status = '1') ? 'Aktif' : 'Non Aktif';
				
				$sheet
					->setCellValue("A{$row}", $val->no_rm)
					->setCellValue("B{$row}", $val->nama)
					->setCellValue("C{$row}", $val->tempat_lahir)
					->setCellValue("D{$row}", DateTime::createFromFormat('Y-m-d', $val->tanggal_lahir)->format('d/m/Y'))
					->setCellValue("E{$row}", $val->nik)
					->setCellValue("F{$row}", $val->jenis_kelamin)
					->setCellValue("G{$row}", $val->suku)
					->setCellValue("H{$row}", $val->pekerjaan)
					->setCellValue("I{$row}", $val->alamat_rumah)
					->setCellValue("J{$row}", $val->telp_rumah)
					->setCellValue("K{$row}", $val->alamat_kantor)
					->setCellValue("L{$row}", $val->hp)
					->setCellValue("M{$row}", $val->status_pasien)
					->setCellValue("N{$row}", $val->gol_darah)
					->setCellValue("O{$row}", $val->tekanan_darah)
					->setCellValue("P{$row}", $val->tekanan_darah_val)
					->setCellValue("Q{$row}", ($val->penyakit_jantung == '1') ? 'Ya' : 'Tidak')
					->setCellValue("R{$row}", ($val->diabetes == '1') ? 'Ya' : 'Tidak')
					->setCellValue("S{$row}", ($val->haemopilia == '1') ? 'Ya' : 'Tidak')
					->setCellValue("T{$row}", ($val->hepatitis == '1') ? 'Ya' : 'Tidak')
					->setCellValue("U{$row}", ($val->gastring == '1') ? 'Ya' : 'Tidak')
					->setCellValue("V{$row}", ($val->penyakit_lainnya == '1') ? 'Ya' : 'Tidak')
					->setCellValue("W{$row}", ($val->alergi_obat == '1') ? 'Ya' : 'Tidak')
					->setCellValue("X{$row}", $val->alergi_obat_val)
					->setCellValue("Y{$row}", ($val->alergi_makanan == '1') ? 'Ya' : 'Tidak')
					->setCellValue("Z{$row}", $val->alergi_makanan_val);
				$row++;
			}

			$endRow = $row - 1;
		}
		
		
		$filename = 'data-pasien-'.time();
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
		
	}

	public function import_data()
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
			
			// echo "<pre>";
			// print_r ($sheetData);
			// echo "</pre>";
			// exit;

			for ($i=1; $i <count($sheetData); $i++) { 
				
				if ($sheetData[$i][0] == null || $sheetData[$i][1] == null) {
					if($i == 0) {
						$flag_kosongan = true;
						$status_import = false;
						$pesan = "Data Kosong...";
					}else{
						$flag_kosongan = false;
						$status_import = true;
						$pesan = "Data Sukses Di Import";
					}

					break;
				}

				$id_pasien = $this->m_pasien->get_max_id_pasien();
				$pasien['id'] = $id_pasien;
				$pasien['no_rm'] = strtoupper(strtolower(trim($sheetData[$i][0])));
				$pasien['nama'] = strtoupper(strtolower(trim($sheetData[$i][1])));
				$pasien['tempat_lahir'] = strtoupper(strtolower(trim($sheetData[$i][2])));
				$pasien['tanggal_lahir'] = DateTime::createFromFormat('d-m-Y', trim($sheetData[$i][3]))->format('Y-m-d');
				$pasien['nik'] = trim($sheetData[$i][4]);
				$pasien['jenis_kelamin'] = strtoupper(strtolower(trim($sheetData[$i][5])));
				$pasien['suku'] = strtoupper(strtolower(trim($sheetData[$i][6])));
				$pasien['pekerjaan'] = strtoupper(strtolower(trim($sheetData[$i][7])));
				$pasien['alamat_rumah'] = strtoupper(strtolower(trim($sheetData[$i][8])));
				$pasien['telp_rumah'] = trim($sheetData[$i][9]);
				$pasien['alamat_kantor'] = strtoupper(strtolower(trim($sheetData[$i][10])));
				$pasien['hp'] = trim($sheetData[$i][11]);
				$pasien['is_aktif'] = 1;
				$pasien['created_at'] = $timestamp;
				$data_pasien[] = $pasien;

				################# DATA MEDIK
				$medik['id_pasien'] = $id_pasien;
				$medik['gol_darah'] = strtoupper(strtolower(trim($sheetData[$i][12])));
				$medik['tekanan_darah'] = strtoupper(strtolower(trim($sheetData[$i][13])));
				$medik['tekanan_darah_val'] = strtoupper(strtolower(trim($sheetData[$i][14])));
				$medik['penyakit_jantung'] = strtoupper(strtolower(trim($sheetData[$i][15])));
				$medik['diabetes'] = strtoupper(strtolower(trim($sheetData[$i][16])));
				$medik['haemopilia'] = strtoupper(strtolower(trim($sheetData[$i][17])));
				$medik['hepatitis'] = strtoupper(strtolower(trim($sheetData[$i][18])));
				$medik['gastring'] = strtoupper(strtolower(trim($sheetData[$i][19])));
				$medik['penyakit_lainnya'] = strtoupper(strtolower(trim($sheetData[$i][20])));
				$medik['alergi_obat'] = strtoupper(strtolower(trim($sheetData[$i][21])));
				$medik['alergi_obat_val'] = strtoupper(strtolower(trim($sheetData[$i][22])));
				$medik['alergi_makanan'] = strtoupper(strtolower(trim($sheetData[$i][23])));
				$medik['alergi_makanan_val'] = strtoupper(strtolower(trim($sheetData[$i][24])));
				$medik['created_at'] = $timestamp;
				$data_medik[] = $medik;


				######## jika lancar sampai akhir beri flag sukses
				if($i == (count($sheetData) - 1)) {
					$flag_kosongan = false;
					$status_import = true;
					$pesan = "Data Sukses Di Import";
				}
			}

			if($status_import) {
				if(count($data_pasien) < 1) {
					echo json_encode([
						'status' => false,
						'pesan'	=> 'Import dibatalkan, Data Kosong...'
					]);

					return;
				}
				
				$this->db->trans_begin();
				
				#### truncate loh !!!!!!
				$this->m_data_medik->trun_data_medik();
				$this->m_pasien->trun_data_pasien();
				
				foreach ($data_pasien as $key => $val) {
					$simpan = $this->m_pasien->save($val);
				}

				foreach ($data_medik as $keys => $vals) {
					#### simpan
					$vals['id'] = $this->m_data_medik->get_max_id_medik();
					$simpan = $this->m_data_medik->save($vals);
				}

				if ($this->db->trans_status() === FALSE){
					$this->db->trans_rollback();
					$status = false;
					$pesan = 'Gagal melakukan Import, cek ulang dalam melakukan pengisian data excel';
				}else{
					$this->db->trans_commit();
					$status = true;
					$pesan = 'Sukses Import data Pasien';
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
		$select = "m_user.*, m_pegawai.nama as nama_pegawai, m_role.nama as nama_role";
		$where = ['m_user.deleted_at' => null];
		$table = 'm_user';
		$join = [ 
			[
				'table' => 'm_pegawai',
				'on'	=> 'm_user.id_pegawai = m_pegawai.id'
			],
			[
				'table' => 'm_role',
				'on'	=> 'm_user.id_role = m_role.id'
			]
		];

		$data = $this->m_global->multi_row($select, $where, $table, $join, 'm_user.kode_user');
		$data_klinik = $this->m_global->single_row('*', 'deleted_at is null', 'm_klinik');

		$retval = [
			'data' => $data,
			'title' => 'Master Data Pegawai',
			'data_klinik' => $data_klinik
		];

		// $this->load->view('pdf', $retval);
		$html = $this->load->view('pdf', $retval, true);
	    $filename = 'master_data_pegawai_'.time();
	    $this->lib_dompdf->generate($html, $filename, true, 'A4', 'potrait');
	}

	// ===============================================
	private function rule_validasi($is_update=false, $skip_pass=false)
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		
		if ($this->input->post('nama') == '') {
			$data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Wajib mengisi Nama';
            $data['status'] = FALSE;
		}

		// if ($this->input->post('no_rm') == '') {
		// 	$data['inputerror'][] = 'no_rm';
		// 	$data['error_string'][] = 'Wajib mengisi NO RM';
		// 	$data['status'] = FALSE;
		// }

		if ($this->input->post('nik') == '') {
			$data['inputerror'][] = 'nik';
			$data['error_string'][] = 'Wajib Mengisi NIK';
			$data['status'] = FALSE;
		}
		
		if ($this->input->post('tempat_lahir') == '') {
			$data['inputerror'][] = 'tempat_lahir';
            $data['error_string'][] = 'Wajib Mengisi Tempat Lahir';
            $data['status'] = FALSE;
		}

		if ($this->input->post('tanggal_lahir') == '') {
			$data['inputerror'][] = 'tanggal_lahir';
            $data['error_string'][] = 'Wajib Mengisi Tanggal Lahir';
            $data['status'] = FALSE;
		}

		if ($this->input->post('jenkel') == '') {
			$data['inputerror'][] = 'jenkel';
            $data['error_string'][] = 'Wajib Mengisi Jenis Kelamin';
            $data['status'] = FALSE;
		}

		if ($this->input->post('suku') == '') {
			$data['inputerror'][] = 'suku';
            $data['error_string'][] = 'Wajib Mengisi Suku Bangsa';
            $data['status'] = FALSE;
		}

		if ($this->input->post('pekerjaan') == '') {
			$data['inputerror'][] = 'pekerjaan';
            $data['error_string'][] = 'Wajib Mengisi Pekerjaan';
            $data['status'] = FALSE;
		}

		if ($this->input->post('hp') == '') {
			$data['inputerror'][] = 'hp';
            $data['error_string'][] = 'Wajib Mengisi HP/WA';
            $data['status'] = FALSE;
		}

		if ($this->input->post('alamat_rumah') == '') {
			$data['inputerror'][] = 'alamat_rumah';
            $data['error_string'][] = 'Wajib Mengisi Alamat Rumah';
            $data['status'] = FALSE;
		}

		#### data medik

		if ($this->input->post('tekanan_darah_val') == '') {
			$data['inputerror'][] = 'tekanan_darah_val';
            $data['error_string'][] = 'Wajib Mengisi Tekanan Darah';
            $data['status'] = FALSE;
		}

		if ($this->input->post('tekanan_darah') == '') {
			$data['inputerror'][] = 'tekanan_darah';
            $data['error_string'][] = 'Wajib Memilih Kategori';
            $data['status'] = FALSE;
		}


        return $data;
	}
}
