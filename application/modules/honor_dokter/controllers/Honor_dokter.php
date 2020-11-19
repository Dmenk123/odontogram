<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Honor_dokter extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') === false) {
			return redirect('login');
		}

		$this->load->model('m_user');
		$this->load->model('m_global');
		$this->load->model('set_role/m_set_role', 'm_role');
	}

	public function index()
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
		$data_role = $this->m_role->get_data_all(['aktif' => '1'], 'm_role');
		$data_peg = $this->m_global->multi_row("*", "is_aktif = '1' and deleted_at is null and id_jabatan = '1'", "m_pegawai", NULL, "nama asc");
			
		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Pengelolaan Honor Dokter',
			'data_user' => $data_user,
			'data_role'	=> $data_role,
			'data_peg'	=> $data_peg
		);

		/**
		 * content data untuk template
		 * param (css : link css pada direktori assets/css_module)
		 * param (modal : modal komponen pada modules/nama_modul/views/nama_modal)
		 * param (js : link js pada direktori assets/js_module)
		 */
		$content = [
			'css' 	=> null,
			'modal' => 'modal_honor_dokter',
			'js'	=> 'honor_dokter.js',
			'view'	=> 'view_honor_dokter'
		];

		$this->template_view->load_view($content, $data);
	}

	public function get_data_form_tindakan()
 	{
		$id_dokter = $this->input->post('id_dokter');
		
		$dokter =  $this->m_global->single_row('*', ['id' => $id_dokter], 'm_pegawai');
		$tindakan = $this->m_global->multi_row('*', ['deleted_at' => null], 'm_tindakan', null, 'kode_tindakan');
		
		$join = [ 
			[
				'table' => 'm_tindakan',
				'on'	=> 't_honor_dokter_tindakan.id_tindakan = m_tindakan.id_tindakan'
			],
		];

		$data_tindakan = $this->m_global->multi_row('t_honor_dokter_tindakan.*, m_tindakan.kode_tindakan, m_tindakan.harga, m_tindakan.nama_tindakan', ['t_honor_dokter_tindakan.deleted_at' => null, 'id_dokter' => $id_dokter], 't_honor_dokter_tindakan', $join, 'id_tindakan');

		$html = '';
		if($data_tindakan) {
			foreach ($data_tindakan as $key => $value) {
				$html .= '<tr>
							<th>'.$value->kode_tindakan.'</th>
							<th>'.$value->nama_tindakan.'</th>
							<th>'.$value->harga.'</th>
							<th>'.$value->persentase.'</th>
							<th><button type="button" class="button btn-sm btn-danger" onclick="hapus_honor_tindakan(\''.$value->id.'\')"><i class="la la-trash"></i></button></th>	
						</tr>';
			}
		}
		echo json_encode(['tindakan' => $tindakan, 'dokter' => $dokter, 'html' => $html]);
	}

	public function add_data_honor_tindakan()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$arr_valid = $this->rule_validasi('tindakan');

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}
		
		$id_dokter_tindakan = trim($this->input->post('id_dokter_tindakan'));
		// $nama_dokter_tindakan = trim($this->input->post('nama_dokter_tindakan'));
		$id_tindakan = trim($this->input->post('id_tindakan'));
		$honor_tindakan_persen = trim($this->input->post('honor_tindakan_persen'));
		
		//cek exist
		$cek = $this->m_global->single_row('*', ['id_dokter' => $id_dokter_tindakan, 'id_tindakan' => $id_tindakan, 'deleted_at' => null], 't_honor_dokter_tindakan');
		
		if($cek) {
			$retval['status'] = false;
			$retval['is_alert'] = true;
			$retval['pesan'] = 'Maaf Tindakan Telah Ada';
			echo json_encode($retval);
			return;
		}else{
			$this->db->trans_begin();
			$data_ins = [
				'id_dokter' => $id_dokter_tindakan,
				'id_tindakan' => $id_tindakan,
				'persentase' => $honor_tindakan_persen,
				'created_at' => $timestamp,
				
			];

			$insert = $this->m_global->store($data_ins,'t_honor_dokter_tindakan');
		}

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['is_alert'] = false;
			$retval['id_dokter'] = null;
			$retval['pesan'] = 'Gagal menambahkan tindakan';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['is_alert'] = false;
			$retval['id_dokter'] = $id_dokter_tindakan;
			$retval['pesan'] = 'Sukses menambahkan tindakan';
		}

		echo json_encode($retval);
	}

	public function add_data_honor_lab()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$arr_valid = $this->rule_validasi('lab');

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}
		
		$id_dokter_lab = trim($this->input->post('id_dokter_lab'));
		// $nama_dokter_tindakan = trim($this->input->post('nama_dokter_tindakan'));
		$id_lab = trim($this->input->post('id_lab'));
		$honor_lab_persen = trim($this->input->post('honor_lab_persen'));
		
		//cek exist
		$cek = $this->m_global->single_row('*', ['id_dokter' => $id_dokter_lab, 'id_lab' => $id_lab, 'deleted_at' => null], 't_honor_dokter_lab');
		
		if($cek) {
			$retval['status'] = false;
			$retval['is_alert'] = true;
			$retval['pesan'] = 'Maaf Tindakan Lab Telah Ada';
			echo json_encode($retval);
			return;
		}else{
			$this->db->trans_begin();
			$data_ins = [
				'id_dokter' => $id_dokter_lab,
				'id_lab' => $id_lab,
				'persentase' => $honor_lab_persen,
				'created_at' => $timestamp,
				
			];

			$insert = $this->m_global->store($data_ins,'t_honor_dokter_lab');
		}

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['is_alert'] = false;
			$retval['id_dokter'] = null;
			$retval['pesan'] = 'Gagal menambahkan Tindakan Lab';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['is_alert'] = false;
			$retval['id_dokter'] = $id_dokter_lab;
			$retval['pesan'] = 'Sukses menambahkan Tindakan Lab';
		}

		echo json_encode($retval);
	}

	public function add_data_honor()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$arr_valid = $this->rule_validasi();

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}
		
		$honor_visite = (int)str_replace(".","",$this->input->post('honor_visite'));
		$id_dokter = trim($this->input->post('dokter'));
		$tindakan_persen = trim($this->input->post('honor_tindakan'));
		$obat_persen = trim($this->input->post('honor_obat'));
		$tindakan_lab_persen = trim($this->input->post('honor_lab'));
		
		//cek exist
		$cek = $this->m_global->single_row('*', ['id_dokter' => $id_dokter, 'deleted_at' => null], 't_honor');
		
		if($cek) {
			$retval['status'] = false;
			$retval['is_alert'] = true;
			$retval['pesan'] = 'Maaf Data Honor pada dokter ini sudah ada';
			echo json_encode($retval);
			return;
		}else{
			$this->db->trans_begin();
			$data_ins = [
				// 'id_dokter' => $id_dokter_lab,
				// 'id_lab' => $id_lab,
				// 'persentase' => $honor_lab_persen,
				'created_at' => $timestamp,
				
			];

			$insert = $this->m_global->store($data_ins,'t_honor_dokter_lab');
		}

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['is_alert'] = false;
			$retval['id_dokter'] = null;
			$retval['pesan'] = 'Gagal menambahkan Tindakan Lab';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['is_alert'] = false;
			$retval['id_dokter'] = $id_dokter_lab;
			$retval['pesan'] = 'Sukses menambahkan Tindakan Lab';
		}

		echo json_encode($retval);
	}

	public function get_data_form_lab()
 	{
		$id_dokter = $this->input->post('id_dokter');
		
		$dokter =  $this->m_global->single_row('*', ['id' => $id_dokter], 'm_pegawai');
		$lab = $this->m_global->multi_row('*', ['deleted_at' => null], 'm_laboratorium', null, 'kode');
		
		$join = [ 
			[
				'table' => 'm_laboratorium',
				'on'	=> 't_honor_dokter_lab.id_lab = m_laboratorium.id_laboratorium'
			],
		];

		$data_lab = $this->m_global->multi_row('t_honor_dokter_lab.*, m_laboratorium.kode, m_laboratorium.harga, m_laboratorium.tindakan_lab', ['t_honor_dokter_lab.deleted_at' => null, 'id_dokter' => $id_dokter], 't_honor_dokter_lab', $join, 'id_lab');

		$html = '';
		if($data_lab) {
			foreach ($data_lab as $key => $value) {
				$html .= '<tr>
							<th>'.$value->kode.'</th>
							<th>'.$value->tindakan_lab.'</th>
							<th>'.$value->harga.'</th>
							<th>'.$value->persentase.'</th>
							<th><button type="button" class="button btn-sm btn-danger" onclick="hapus_honor_lab(\''.$value->id.'\')"><i class="la la-trash"></i></button></th>	
						</tr>';
			}
		}
		echo json_encode(['lab' => $lab, 'dokter' => $dokter, 'html' => $html]);
	}

	public function delete_honor_tindakan()
	{
		$id = $this->input->post('id');
		$oldData = $this->m_global->single_row('*', ['id' => $id], 't_honor_dokter_tindakan');
		if($oldData){
			##soft delete saja
			$id_dokter = $oldData->id_dokter;
			$del = $this->m_global->softdelete(['id'=>$id], 't_honor_dokter_tindakan');
		}else{
			$id_dokter = NULL;
			$del = FALSE;
		}
		
		if($del) {
			$retval['status'] = TRUE;
			$retval['id_dokter'] = $id_dokter;
			$retval['pesan'] = 'Data Honor Tindakan Sukses dihapus';
		}else{
			$retval['status'] = FALSE;
			$retval['id_dokter'] = $id_dokter;
			$retval['pesan'] = 'Data Honor Tindakan Gagal dihapus';
		}

		echo json_encode($retval);
	}

	public function delete_honor_lab()
	{
		$id = $this->input->post('id');
		$oldData = $this->m_global->single_row('*', ['id' => $id], 't_honor_dokter_lab');
		if($oldData){
			##soft delete saja
			$id_dokter = $oldData->id_dokter;
			$del = $this->m_global->softdelete(['id'=>$id], 't_honor_dokter_lab');
		}else{
			$id_dokter = NULL;
			$del = FALSE;
		}
		
		if($del) {
			$retval['status'] = TRUE;
			$retval['id_dokter'] = $id_dokter;
			$retval['pesan'] = 'Data Honor Lab Sukses dihapus';
		}else{
			$retval['status'] = FALSE;
			$retval['id_dokter'] = $id_dokter;
			$retval['pesan'] = 'Data Honor Lab Gagal dihapus';
		}

		echo json_encode($retval);
	}

	// public function get_form_tindakan()
	// {
	// 	$data = $this->m_global->multi_row('*', ['deleted_at' => null], 'm_tindakan', null, 'kode_tindakan');
	// 	$html = '';
	// 	$html .= '<div class="form-group row">
	// 				<div class="col-10">
	// 				<label for="" class="form-control-label">Pilih Tindakan:</label>
	// 				<br>
	// 				<select class="form-control kt-select2" id="id_tindakan" name="id_tindakan" style="width: 100%;">
	// 					<option value="">Silahkan Pilih Tindakan</option>';
		
	// 	foreach ($data as $key => $value) {
	// 		$html .= '<option value="'.$value->id_tindakan.'">'.$value->kode_tindakan.'-'.$value->nama_tindakan.'</option>';
	// 	}

	// 	$html .= '</select>
	// 				<span class="help-block"></span>
	// 			</div>
	// 			<div class="col-2">
	// 				<label for="" class="form-control-label">&nbsp;</label>
	// 				<br>
	// 				<button type="button" class="button btn-sm btn-success" onclick="tambah_tindakan()"><i class="la la-plus"></i></button>
	// 			</div>
	// 		</div>';

	// 	$html .= '<div class="form-group">
	// 				<div class="kt-section__content">
	// 					<table class="table" id="tabel-tindakan-dokter">
	// 						<thead class="thead-light">
	// 							<tr>
	// 								<th>Kode</th>
	// 								<th>Tindakan</th>
	// 								<th>Tarif</th>
	// 								<th>Persen</th>
	// 							</tr>
	// 						</thead>
	// 						<tbody></tbody>
	// 					</table>
	// 				</div>
	// 			</div>';
		
	// 	echo json_encode($html);
	// }

	// public function get_form_lab()
	// {
	// 	$data = $this->m_global->multi_row('*', ['deleted_at' => null], 'm_laboratorium	', null, 'kode');
	// 	$html = '';
	// 	$html .= '<div class="form-group row">
	// 				<div class="col-10">
	// 				<label for="" class="form-control-label">Pilih Tindakan Lab :</label>
	// 				<br>
	// 				<select class="form-control kt-select2" id="id_lab" name="id_lab" style="width: 100%;">
	// 					<option value="">Silahkan Pilih Tindakan Lab</option>';
		
	// 	foreach ($data as $key => $value) {
	// 		$html .= '<option value="'.$value->id_laboratorium.'">'.$value->kode.'-'.$value->tindakan_lab.'</option>';
	// 	}

	// 	$html .= '</select>
	// 				<span class="help-block"></span>
	// 			</div>
	// 			<div class="col-2">
	// 				<label for="" class="form-control-label">&nbsp;</label>
	// 				<br>
	// 				<button type="button" class="button btn-sm btn-success" onclick="#"><i class="la la-plus"></i></button>
	// 			</div>
	// 		</div>';

	// 	$html .= '<div class="form-group">
	// 				<div class="kt-section__content">
	// 					<table class="table" id="tabel-lab-dokter">
	// 						<thead class="thead-light">
	// 							<tr>
	// 								<th>Kode</th>
	// 								<th>Tindakan Lab</th>
	// 								<th>Tarif</th>
	// 								<th>Persen</th>
	// 							</tr>
	// 						</thead>
	// 						<tbody></tbody>
	// 					</table>
	// 				</div>
	// 			</div>';
		
	// 	echo json_encode($html);
	// }
	////////////////////////////////////////////////////////////////////////////////

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
	private function rule_validasi($tipe='')
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($tipe == 'tindakan') {
			if ($this->input->post('id_tindakan') == '' || $this->input->post('id_tindakan') == '0') {
				$data['inputerror'][] = 'id_tindakan';
				$data['error_string'][] = 'Wajib mengisi Tindakan';
				$data['status'] = FALSE;
			}
			if ($this->input->post('honor_tindakan_persen') == '' || $this->input->post('honor_tindakan_persen') == '0') {
				$data['inputerror'][] = 'honor_tindakan_persen';
				$data['error_string'][] = 'Wajib mengisi Persentase';
				$data['status'] = FALSE;
			}
		}elseif($tipe == 'lab'){
			
			if ($this->input->post('id_lab') == '' || $this->input->post('id_lab') == '0') {
				$data['inputerror'][] = 'id_lab';
				$data['error_string'][] = 'Wajib mengisi Tindakan Lab';
				$data['status'] = FALSE;
			}
			if ($this->input->post('honor_lab_persen') == '' || $this->input->post('honor_lab_persen') == '0') {
				$data['inputerror'][] = 'honor_lab_persen';
				$data['error_string'][] = 'Wajib mengisi Persentase';
				$data['status'] = FALSE;
			}
			
		}else{
			if ($this->input->post('honor_visite') == '') {
				$data['inputerror'][] = 'honor_visite';
				$data['error_string'][] = 'Minimal Honor adalah 0';
				$data['status'] = FALSE;
			}

			if ($this->input->post('dokter') == '') {
				$data['inputerror'][] = 'dokter';
				$data['error_string'][] = 'Wajib Memilih Dokter';
				$data['status'] = FALSE;
			}

			if ($this->input->post('honor_tindakan') == '') {
				$data['inputerror'][] = 'honor_tindakan';
				$data['error_string'][] = 'Minimal Honor adalah 0';
				$data['status'] = FALSE;
			}

			if ($this->input->post('honor_obat') == '') {
				$data['inputerror'][] = 'honor_obat';
				$data['error_string'][] = 'Minimal Honor adalah 0';
				$data['status'] = FALSE;
			}

			if ($this->input->post('honor_lab') == '') {
				$data['inputerror'][] = 'honor_lab';
				$data['error_string'][] = 'Minimal Honor adalah 0';
				$data['status'] = FALSE;
			}
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
