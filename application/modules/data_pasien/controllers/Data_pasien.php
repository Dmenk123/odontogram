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
			'modal' => null,
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

	public function list_pasien()
	{
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
						<button class="dropdown-item" onclick="detail_pasien(\''.$val->id.'\')">
							<i class="la la-search"></i> Detail Pasien
						</button>
						<button class="dropdown-item" onclick="edit_pasien(\''.$val->id.'\')">
							<i class="la la-pencil"></i> Edit Pasien
						</button>
						<button class="dropdown-item" onclick="delete_pasien(\''.$val->id.'\')">
							<i class="la la-trash"></i> Hapus
						</button>
			';

			if ($val->is_aktif == 1) {
				$str_aksi .=
				'<button class="dropdown-item btn_edit_status" title="aktif" id="'.$val->id.'" value="aktif"><i class="la la-check">
				</i> Aktif</button>';
			}else{
				$str_aksi .=
				'<button class="dropdown-item btn_edit_status" title="nonaktif" id="'.$val->id.'" value="nonaktif"><i class="la la-close">
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
			'haemopila' => $haemopilia,
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

	public function update_data_user()
	{
		$sesi_id_user = $this->session->userdata('id_user'); 
		$id_user = $this->input->post('id_user');
		$this->load->library('Enkripsi');
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		
		if($this->input->post('skip_pass') != null){
			$skip_pass = true;
		}else{
			$skip_pass = false;
		}
		
		$arr_valid = $this->rule_validasi(true, $skip_pass);

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}

		$password = trim($this->input->post('password'));
		$repassword = trim($this->input->post('repassword'));
		$role = $this->input->post('role');
		$status = $this->input->post('status');
		
		$q = $this->m_user->get_by_id($id_user);
		$namafileseo = $this->seoUrl($q->username.' '.time());

		if($skip_pass == false) {
			if ($password != $repassword) {
				$data['inputerror'][] = 'password';
				$data['error_string'][] = 'Password Tidak Cocok';
				$data['status'] = FALSE;
			
				$data['inputerror'][] = 'repassword';
				$data['error_string'][] = 'Password Tidak Cocok';
				$data['status'] = FALSE;
	
				echo json_encode($data);
				return;
			}
		}
		
		$hash_password = $this->enkripsi->enc_dec('encrypt', $password);
		$hash_password_lama = $this->enkripsi->enc_dec('encrypt', trim($this->input->post('password_lama')));
		$dataOld = $this->m_user->get_by_id($this->input->post('id_user'));
		
		if($skip_pass == false) {
			if($hash_password_lama != $dataOld->password) {
				$data['inputerror'][] = 'password_lama';
				$data['error_string'][] = 'Password lama salah';
				$data['status'] = FALSE;
	
				echo json_encode($data);
				return;
			}
		}
		
		$this->db->trans_begin();


		$data_user = [
			'id_role' => $role,
			'status' => $status,
			'updated_at' => $timestamp
		];

		$where = ['id' => $id_user];
		$update = $this->m_user->update($where, $data_user);

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$data['status'] = false;
			$data['pesan'] = 'Gagal update Master User';
		}else{
			$this->db->trans_commit();
			$data['status'] = true;
			$data['pesan'] = 'Sukses update Master User';
		}
		
		echo json_encode($data);
	}

	/**
	 * Hanya melakukan softdelete saja
	 * isi kolom updated_at dengan datetime now()
	 */
	public function delete_user()
	{
		$id = $this->input->post('id');
		$del = $this->m_user->softdelete_by_id($id);
		if($del) {
			$retval['status'] = TRUE;
			$retval['pesan'] = 'Data Master User dihapus';
		}else{
			$retval['status'] = FALSE;
			$retval['pesan'] = 'Data Master User dihapus';
		}

		echo json_encode($retval);
	}

	public function edit_status_user($id)
	{
		$input_status = $this->input->post('status');
		// jika aktif maka di set ke nonaktif / "0"
		$status = ($input_status == "aktif") ? $status = 0 : $status = 1;
			
		$input = array('status' => $status);

		$where = ['id' => $id];

		$this->m_user->update($where, $input);

		if ($this->db->affected_rows() == '1') {
			$data = array(
				'status' => TRUE,
				'pesan' => "Status User berhasil di ubah.",
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
		$file_url = base_url().'files/template_dokumen/template_master_user.xlsx';
		header('Content-Type: application/octet-stream');
		header("Content-Transfer-Encoding: Binary"); 
		header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
		readfile($file_url); 
	}

	public function export_excel()
	{
		$select = "m_user.*, m_pegawai.nama as nama_pegawai, m_role.nama as nama_role";
		$where = ['m_pegawai.deleted_at' => null];
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
		
		$spreadsheet = $this->excel->spreadsheet_obj();
		$writer = $this->excel->xlsx_obj($spreadsheet);
		$number_format_obj = $this->excel->number_format_obj();
		
		$spreadsheet
			->getActiveSheet()
			->getStyle('A1:E1000')
			->getNumberFormat()
			->setFormatCode($number_format_obj::FORMAT_TEXT);
		
		$sheet = $spreadsheet->getActiveSheet();

		$sheet
			->setCellValue('A1', 'Kode User')
			->setCellValue('B1', 'Username')
			->setCellValue('C1', 'Nama Pegawai')
			->setCellValue('D1', 'Role')
			->setCellValue('E1', 'Status Aktif');
		
		$startRow = 2;
		$row = $startRow;
		if($data){
			foreach ($data as $key => $val) {
				$sts = ($val->status = '1') ? 'Aktif' : 'Non Aktif';
				
				$sheet
					->setCellValue("A{$row}", $val->kode_user)
					->setCellValue("B{$row}", $val->username)
					->setCellValue("C{$row}", $val->nama_pegawai)
					->setCellValue("D{$row}", $val->nama_role)
					->setCellValue("E{$row}", $sts);
				$row++;
			}

			$endRow = $row - 1;
		}
		
		
		$filename = 'master-user-'.time();
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
		
	}

	public function import_data_master()
	{
		$this->load->library('Enkripsi');
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
				
				if ($sheetData[$i][0] == null || $sheetData[$i][1] == null || $sheetData[$i][2] == null || $sheetData[$i][3] == null) {
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

				$data['kode_user'] = strtoupper(strtolower(trim($sheetData[$i][0])));
				$data['username'] = strtolower(trim($sheetData[$i][1]));
				
				#pegawai
				$id_pegawai = $this->m_user->get_id_pegawai_by_name(strtolower(trim($sheetData[$i][2])));
				if($id_pegawai){
					$data['id_pegawai'] = $id_pegawai->id;
				}else{
					if($i == 0) {
						continue;
					}else{
						$flag_kosongan = false;
						$status_import = false;
						$pesan = "Terjadi Kesalahan Dalam Penulisan Nama Pegawai, Mohon Cek Kembali";
						break;
					}
				}
				#end pegawai

				#role
				$id_role = $this->m_user->get_id_role_by_name(strtolower(trim($sheetData[$i][3])));

				if($id_role){
					$data['id_role'] = $id_role->id;
				}else{
					if($i == 0) {
						continue;
					}else{
						$flag_kosongan = false;
						$status_import = false;
						$pesan = "Terjadi Kesalahan Dalam Penulisan Nama Role, Mohon Cek Kembali";
						break;
					}
				}
				#end role

				$data['created_at'] = $timestamp;
				$data['foto'] = 'user_default.png';
				$data['status'] = 1;
				#default password 123456
				$data['password'] = $this->enkripsi->enc_dec('encrypt', '123456');

				$retval[] = $data;

				######## jika lancar sampai akhir beri flag sukses
				if($i == (count($sheetData) - 1)) {
					$flag_kosongan = false;
					$status_import = true;
					$pesan = "Data Sukses Di Import";
				}
			}

			if($status_import) {
				// var_dump(count($retval));exit;
				## jika array maks cuma 1, maka batalkan (soalnya hanya header saja disana) ##
				if(count($retval) <= 1) {
					echo json_encode([
						'status' => false,
						'pesan'	=> 'Import dibatalkan, Data Kosong...'
					]);

					return;
				}
				
				$this->db->trans_begin();
				
				#### truncate loh !!!!!!
				$this->m_user->trun_master_user();
				
				foreach ($retval as $keys => $vals) {
					#### simpan
					$vals['id'] = $this->m_user->get_max_id_user();
					$simpan = $this->m_user->save($vals);
				}

				if ($this->db->trans_status() === FALSE){
					$this->db->trans_rollback();
					$status = false;
					$pesan = 'Gagal melakukan Import, cek ulang dalam melakukan pengisian data excel';
				}else{
					$this->db->trans_commit();
					$status = true;
					$pesan = 'Sukses Import data pegawai';
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
