<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_asuransi extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') === false) {
			return redirect('login');
		}

		$this->load->model('master_user/m_user');
		$this->load->model('m_asuransi');
		$this->load->model('m_global');
	}

	public function index()
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
		$data_role = $this->m_role->get_data_all(['aktif' => '1'], 'm_role');
		$data_peg = $this->m_global->multi_row("*", "is_aktif = '1' and deleted_at is null", "m_pegawai", NULL, "nama asc");
			
		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Pengelolaan Data User',
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
			'modal' => 'modal_master_user',
			'js'	=> 'master_user.js',
			'view'	=> 'view_master_user'
		];

		$this->template_view->load_view($content, $data);
	}

	public function get_select_asuransi()
	{
		$term = $this->input->get('term');
		$data = $this->m_global->multi_row('*', ['deleted_at' => null, 'nama like' => '%'.$term.'%'], 'm_asuransi', null, 'nama');
		if($data) {
			foreach ($data as $key => $value) {
				$row['id'] = $value->id;
				$row['text'] = $value->nama;
				$retval[] = $row;
			}
		}else{
			$retval = false;
		}
		echo json_encode($retval);
	}

	public function list_data()
	{
		$this->load->library('Enkripsi');
		$list = $this->m_asuransi->get_datatables();
		$data = array();
		//$no =$_POST['start'];
		foreach ($list as $val) {
			//$no++;
			$row = array();
			//loop value tabel db
			//$row[] = $no;
			$row[] = $val->nama;
			$row[] = $val->keterangan;
			
			$str_aksi = '
						<button class="button btn-sm btn-warning" onclick="edit_asuransi(\''.$this->enkripsi->enc_dec('encrypt', $val->id).'\')">
							<i class="la la-pencil"></i> Edit
						</button>
						<button class="button btn-sm btn-danger" onclick="delete_asuransi(\''.$this->enkripsi->enc_dec('encrypt', $val->id).'\')">
							<i class="la la-trash"></i> Hapus
						</button>
			';
			$row[] = $str_aksi;

			$data[] = $row;
		}//end loop

		$output = [
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_asuransi->count_all(),
			"recordsFiltered" => $this->m_asuransi->count_filtered(),
			"data" => $data
		];
		
		echo json_encode($output);
	}

	public function edit_data()
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

	public function simpan_data()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$arr_valid = $this->rule_validasi();
		
		$nama = trim($this->input->post('nama_asuransi'));
		$keterangan = trim($this->input->post('ket_asuransi'));

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}

		$this->db->trans_begin();

		$data = [
			'id' => $this->m_asuransi->get_max_id(),
			'nama' => $nama,
			'keterangan' => $keterangan,
			'created_at' => $timestamp
		];
		
		$insert = $this->m_asuransi->save($data);
		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['pesan'] = 'Gagal menambahkan data';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['pesan'] = 'Sukses menambahkan data';
		}

		echo json_encode($retval);
	}

	public function update_data()
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
	public function delete_data()
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


	// ===============================================
	private function rule_validasi($is_update=false, $skip_pass=false)
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('nama_asuransi') == '') {
			$data['inputerror'][] = 'nama_asuransi';
            $data['error_string'][] = 'Wajib mengisi Nama Asuransi';
            $data['status'] = FALSE;
		}


		if ($this->input->post('ket_asuransi') == '') {
			$data['inputerror'][] = 'ket_asuransi';
            $data['error_string'][] = 'Wajib Mengisi Keterangan Asuransi';
            $data['status'] = FALSE;
		}

        return $data;
	}
}
