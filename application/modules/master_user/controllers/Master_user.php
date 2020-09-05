<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_user extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') === false) {
			return redirect('login');
		}

		$this->load->model('m_user');
		$this->load->model('set_role/m_set_role', 'm_role');
	}

	public function index()
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
		$data_role = $this->m_role->get_data_all(['aktif' => '1'], 'm_role');
		
		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Pengelolaan Data User',
			'data_user' => $data_user,
			'data_role'	=> $data_role
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
			

			if ($user->status == 1) {
				$row[] =
				'<button class="btn btn-sm btn-warning" title="Edit" href="javascript:void(0)" onclick="edit_user(\''.$user->id.'\')">Edit</button>
				 <button class="btn btn-sm btn-success btn_edit_status" href="javascript:void(0)" title="aktif" id="'.$user->id.'" value="aktif">Aktif</i></button>';
			}else{
				$row[] =
				'<button class="btn btn-sm btn-warning" title="Edit" href="javascript:void(0)" onclick="edit_user(\''.$user->id.'\')">Edit</button>
				 <button class="btn btn-sm btn-danger btn_edit_status" href="javascript:void(0)" title="nonaktif" id="'.$user->id.'" value="nonaktif">Non Aktif</button>';
			}

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
		$oldData = $this->m_user->get_by_id($id);
		
		if(!$oldData){
			return redirect($this->uri->segment(1));
		}

		$data = array(
			'data_user' => $data_user,
			'old_data'	=> $oldData
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
		
		$data_user = [
			'id' => $this->m_user->get_max_id_user(),
			'id_role' => $role,
			'kode_user' => $this->m_user->get_kode_user(),
			'username' => $username,
			'password' => $hasil_password,
			'status' => $status,
			'created_at' => $timestamp
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
		$id_user = $this->session->userdata('id_user'); 
		$this->load->library('Enkripsi');
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$arr_valid = $this->rule_validasi(true);

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}

		$password = trim($this->input->post('password'));
		$repassword = trim($this->input->post('repassword'));
		$role = $this->input->post('role');
		$status = $this->input->post('status');

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

		$hash_password = $this->enkripsi->enc_dec('encrypt', $password);
		$hash_password_lama = $this->enkripsi->enc_dec('encrypt', trim($this->input->post('password_lama')));
		$dataOld = $this->m_user->get_by_id($this->input->post('id_user'));
		
		if($hash_password_lama != $dataOld->password) {
			$data['inputerror'][] = 'password_lama';
			$data['error_string'][] = 'Password lama salah';
			$data['status'] = FALSE;

			echo json_encode($data);
			return;
		}

		$this->db->trans_begin();
		
		$data_user = [
			'id_role' => $role,
			'password' => $hash_password,
			'status' => $status,
			'updated_at' => $timestamp
		];

		$where = ['id' => $this->input->post('id_user')];
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

	public function delete_pengguna($id)
	{
		$this->user->delete_by_id($id);
		echo json_encode(array(
			"status" => TRUE,
			"pesan" => 'Data Master Supplier No.'.$id.' Berhasil dihapus',
			));
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

	// ===============================================
	private function rule_validasi($is_update=false)
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
			if ($this->input->post('password_lama') == '') {
				$data['inputerror'][] = 'password_lama';
				$data['error_string'][] = 'Wajib mengisi Password Lama';
				$data['status'] = FALSE;
			}
		}
		
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
}
