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

	public function list_user()
	{
		$list = $this->m_user->get_datatable_user();
		$data = array();
		$no =$_POST['start'];
		foreach ($list as $user) {
			$no++;
			$row = array();
			//loop value tabel db
			$row[] = $no;
			$row[] = $user->kode_user;
			$row[] = $user->username;
			$row[] = $user->nama_role;
			$aktif_txt = ($user->status == 1) ? '<span style="color:blue;">Aktif</span>' : '<span style="color:red;">Non Aktif</span>';
			$row[] = $aktif_txt;
			$row[] = ($user->last_login != '') ? $user->last_login : '-';
			
			$str_aksi = '
				<div class="btn-group">
					<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Opsi</button>
					<div class="dropdown-menu">
						<button class="dropdown-item" onclick="detail_user(\''.$user->id.'\')">
							<i class="la la-search"></i> Detail User
						</button>
						<button class="dropdown-item" onclick="edit_user(\''.$user->id.'\')">
							<i class="la la-pencil"></i> Edit User
						</button>
						<button class="dropdown-item" onclick="delete_user(\''.$user->id.'\')">
							<i class="la la-trash"></i> Hapus
						</button>
			';

			if ($user->status == 1) {
				$str_aksi .=
				'<button class="dropdown-item btn_edit_status" title="aktif" id="'.$user->id.'" value="aktif"><i class="la la-check">
				</i> Aktif</button>';
			}else{
				$str_aksi .=
				'<button class="dropdown-item btn_edit_status" title="nonaktif" id="'.$user->id.'" value="nonaktif"><i class="la la-close">
				</i> Non Aktif</button>';
			}	

			$str_aksi .= '</div></div>';
			$row[] = $str_aksi;

			$data[] = $row;
		}//end loop

		$output = [
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_user->count_all(),
			"recordsFiltered" => $this->m_user->count_filtered(),
			"data" => $data
		];
		
		echo json_encode($output);
	}

	public function edit_user()
	{
		$this->load->library('Enkripsi');
		$id_user = $this->session->userdata('id_user');
		$data_user = $this->m_user->get_by_id($id_user);
	
		$id = $this->input->post('id');
		//$oldData = $this->m_user->get_by_id($id);

		$select = "m_user.*, m_pegawai.nama as nama_pegawai, m_role.nama as nama_role";
		$where = ['m_user.id' => $id];
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

		$oldData = $this->m_global->single_row($select, $where, $table, $join, 'm_user.kode_user');
		
		if(!$oldData){
			return redirect($this->uri->segment(1));
		}

		$url_foto = base_url('files/img/user_img/').$oldData->foto;
		$foto = base64_encode(file_get_contents($url_foto));  
		
		$data = array(
			'data_user' => $data_user,
			'old_data'	=> $oldData,
			'foto_encoded' => $foto
		);
		
		echo json_encode($data);
	}

	public function add_data_user()
	{
		$this->load->library('Enkripsi');
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$arr_valid = $this->rule_validasi();
		
		$username = trim($this->input->post('username'));
		$password = trim($this->input->post('password'));
		$repassword = trim($this->input->post('repassword'));
		$role = $this->input->post('role');
		$status = $this->input->post('status');
		$id_pegawai = $this->input->post('pegawai');
		$namafileseo = $this->seoUrl($username.' '.time());

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}

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

		$hasil_password = $this->enkripsi->enc_dec('encrypt', $password);
		$this->db->trans_begin();
		
		$file_mimes = ['image/png', 'image/x-citrix-png', 'image/x-png', 'image/x-citrix-jpeg', 'image/jpeg', 'image/pjpeg'];

		if(isset($_FILES['foto']['name']) && in_array($_FILES['foto']['type'], $file_mimes)) {
			$this->konfigurasi_upload_img($namafileseo);
			//get detail extension
			$pathDet = $_FILES['foto']['name'];
			$extDet = pathinfo($pathDet, PATHINFO_EXTENSION);
			
			if ($this->file_obj->do_upload('foto')) 
			{
				$gbrBukti = $this->file_obj->data();
				$nama_file_foto = $gbrBukti['file_name'];
				$this->konfigurasi_image_resize($nama_file_foto);
				$output_thumb = $this->konfigurasi_image_thumb($nama_file_foto, $gbrBukti);
				$this->image_lib->clear();
				## replace nama file + ext
				$namafileseo = $this->seoUrl($username.' '.time()).'.'.$extDet;
			} else {
				$error = array('error' => $this->file_obj->display_errors());
				var_dump($error);exit;
			}
		}else{
			$namafileseo = 'user_default.png';
		}

		$data_user = [
			'id' => $this->m_user->get_max_id_user(),
			'id_role' => $role,
			'id_pegawai' => $id_pegawai,
			'kode_user' => $this->m_user->get_kode_user(),
			'username' => $username,
			'password' => $hasil_password,
			'status' => $status,
			'created_at' => $timestamp,
			'foto'	=> $namafileseo
		];
		
		$insert = $this->m_user->save($data_user);
		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['pesan'] = 'Gagal menambahkan user';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['pesan'] = 'Sukses menambahkan user';
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

		$file_mimes = ['image/png', 'image/x-citrix-png', 'image/x-png', 'image/x-citrix-jpeg', 'image/jpeg', 'image/pjpeg'];

		if(isset($_FILES['foto']['name']) && in_array($_FILES['foto']['type'], $file_mimes)) {
			$this->konfigurasi_upload_img($namafileseo);
			//get detail extension
			$pathDet = $_FILES['foto']['name'];
			$extDet = pathinfo($pathDet, PATHINFO_EXTENSION);
			
			if ($this->file_obj->do_upload('foto')) 
			{
				$gbrBukti = $this->file_obj->data();
				$nama_file_foto = $gbrBukti['file_name'];
				$this->konfigurasi_image_resize($nama_file_foto);
				$output_thumb = $this->konfigurasi_image_thumb($nama_file_foto, $gbrBukti);
				$this->image_lib->clear();
				## replace nama file + ext
				$namafileseo = $this->seoUrl($q->username.' '.time()).'.'.$extDet;
				$foto = $namafileseo;
			} else {
				$error = array('error' => $this->file_obj->display_errors());
				var_dump($error);exit;
			}
		}else{
			$foto = null;
		}

		$data_user = [
			'id_role' => $role,
			'status' => $status,
			'updated_at' => $timestamp
		];

		if($skip_pass == false) {
			$data_user['password'] = $hash_password;
		}
		
		if($foto != null) {
			$data_user['foto'] = $foto;
		}

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

		if($is_update == false) {
			if ($this->input->post('username') == '') {
				$data['inputerror'][] = 'username';
				$data['error_string'][] = 'Wajib mengisi Username';
				$data['status'] = FALSE;
			}
		}else{
			if($skip_pass === false) {
				if ($this->input->post('password_lama') == '') {
					$data['inputerror'][] = 'password_lama';
					$data['error_string'][] = 'Wajib mengisi Password Lama';
					$data['status'] = FALSE;
				}
			}
		}

		if ($this->input->post('pegawai') == '') {
			$data['inputerror'][] = 'pegawai';
            $data['error_string'][] = 'Wajib mengisi Nama Pegawai';
            $data['status'] = FALSE;
		}

		if($skip_pass === false) {
			if ($this->input->post('password') == '') {
				$data['inputerror'][] = 'password';
				$data['error_string'][] = 'Wajib mengisi Password';
				$data['status'] = FALSE;
			}
	
			if ($this->input->post('repassword') == '') {
				$data['inputerror'][] = 'repassword';
				$data['error_string'][] = 'Wajib Menulis Ulang Password';
				$data['status'] = FALSE;
			}
		}
		
		// if ($this->input->post('icon_menu') == '') {
		// 	$data['inputerror'][] = 'icon_menu';
        //     $data['error_string'][] = 'Wajib mengisi icon menu';
        //     $data['status'] = FALSE;
		// }

		if ($this->input->post('role') == '') {
			$data['inputerror'][] = 'role';
            $data['error_string'][] = 'Wajib Memilih Role User';
            $data['status'] = FALSE;
		}

		if ($this->input->post('status') == '') {
			$data['inputerror'][] = 'status';
            $data['error_string'][] = 'Wajib Memilih Status';
            $data['status'] = FALSE;
		}

        return $data;
	}

	private function konfigurasi_upload_img($nmfile)
	{ 
		//konfigurasi upload img display
		$config['upload_path'] = './files/img/user_img/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
		$config['overwrite'] = TRUE;
		$config['max_size'] = '4000';//in KB (4MB)
		$config['max_width']  = '0';//zero for no limit 
		$config['max_height']  = '0';//zero for no limit
		$config['file_name'] = $nmfile;
		//load library with custom object name alias
		$this->load->library('upload', $config, 'file_obj');
		$this->file_obj->initialize($config);
	}

	private function konfigurasi_image_resize($filename)
	{
		//konfigurasi image lib
	    $config['image_library'] = 'gd2';
	    $config['source_image'] = './files/img/user_img/'.$filename;
	    $config['create_thumb'] = FALSE;
	    $config['maintain_ratio'] = FALSE;
	    $config['new_image'] = './files/img/user_img/'.$filename;
	    $config['overwrite'] = TRUE;
	    $config['width'] = 450; //resize
	    $config['height'] = 500; //resize
	    $this->load->library('image_lib',$config); //load image library
	    $this->image_lib->initialize($config);
	    $this->image_lib->resize();
	}

	private function konfigurasi_image_thumb($filename, $gbr)
	{
		//konfigurasi image lib
	    $config2['image_library'] = 'gd2';
	    $config2['source_image'] = './files/img/user_img/'.$filename;
	    $config2['create_thumb'] = TRUE;
	 	$config2['thumb_marker'] = '_thumb';
	    $config2['maintain_ratio'] = FALSE;
	    $config2['new_image'] = './files/img/user_img/thumbs/'.$filename;
	    $config2['overwrite'] = TRUE;
	    $config2['quality'] = '60%';
	 	$config2['width'] = 45;
	 	$config2['height'] = 45;
	    $this->load->library('image_lib',$config2); //load image library
	    $this->image_lib->initialize($config2);
	    $this->image_lib->resize();
	    return $output_thumb = $gbr['raw_name'].'_thumb'.$gbr['file_ext'];	
	}

	private function seoUrl($string) {
	    //Lower case everything
	    $string = strtolower($string);
	    //Make alphanumeric (removes all other characters)
	    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
	    //Clean up multiple dashes or whitespaces
	    $string = preg_replace("/[\s-]+/", " ", $string);
	    //Convert whitespaces and underscore to dash
	    $string = preg_replace("/[\s_]/", "-", $string);
	    return $string;
	}
}
