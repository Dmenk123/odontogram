<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	

	public function index()
	{	
		if ($this->session->userdata('username') !== null) {
			redirect('home');
		}

		$this->load->view('view_login');
	}

	public function proses()
	{
		$this->load->model('m_user');
		$this->load->library('Enkripsi');
		
		$pass_string = $this->input->post('password');
		$hasil_password = $this->enkripsi->enc_dec('encrypt', $pass_string);
		// $this->register_user($this->input->post('username'), $hasil_password);
		// exit;
		$data_input = array(
			'data_user'=>$this->input->post('username'),
			'data_password'=>$hasil_password,
		);
		
		$result = $this->m_user->login($data_input);

		if ($result) {
			$this->m_user->set_lastlogin($result->id);
			// unset($data['id_user']);
			$this->session->set_userdata(
				array(
					'username' => $result->username,
					'id_user' => $result->id,
					'last_login' => $result->last_login,
					'id_role' => $result->id_role,
					'id_klinik' => $result->id_klinik,
					'logged_in' => true,
				));

				echo json_encode([
					'status' => true
				]);
		}else{
			echo json_encode([
				'status' => false
			]);
			// $this->session->set_flashdata('message', 'Kombinasi Username & Password Salah, Mohon di cek ulang');
			// redirect('login');
		}
	}

	public function logout_proc()
	{
		if ($this->session->userdata('logged_in')) 
		{
			//$this->session->sess_destroy();
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('id_user');
			$this->session->unset_userdata('id_role');
			$this->session->unset_userdata('last_login');
			$this->session->unset_userdata('id_klinik');
			$this->session->set_userdata(array('logged_in' => false));
		}
		
		return redirect('login');
	}

	public function lihat_pass($username)
	{
		$this->load->library('Enkripsi');
		$data = $this->db->query("select password from tbl_user where username = '$username'")->row();
		$str_dec = $this->enkripsi->decrypt($data->password);
		echo $str_dec;
	}

	public function register_user($username, $pass)
	{
		$data = [
			'id' => 1,
			'id_role' => 1,
			'kode_user' => 'USR-00001',
			'username' => trim($username),
			'password' => $pass,
			'created_at' => date('Y-m-d H:i:s') 
		];
		$this->db->insert('m_user', $data);
		
	}
}
