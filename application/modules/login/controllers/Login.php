<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Carbon\Carbon;

class Login extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->library('Enkripsi');
	}
	

	public function index()
	{	
		if ($this->session->userdata('logged_in') !== null) {
			return redirect('home');
		}

		$this->load->view('view_login2');
	}

	public function middle_login()
	{
		$this->load->model('m_user');
		
		if(!$this->input->post('uid')) {
			return redirect('login');
		}

		if ($this->session->userdata('logged_in') !== null) {
			return redirect('home');
		}

		$id = $this->input->post('uid');
		$id_user = $this->enkripsi->enc_dec('decrypt', $id);
		$result = $this->m_user->get_data_user_by_id($id_user);

		if(!$result){
			return redirect('login');
		}else{
		
			$data = array(
				'title' => 'Login',
				'data' => $result,
				'greet' => $this->greet()
			);
	
			$this->load->view('view_middle_login', $data);
			
		}
	}

	public function confirm_middle_login()
	{
		$this->load->model('m_user');
		$id_user = $this->enkripsi->enc_dec('decrypt', $this->input->post('uid'));
		$id_klinik = $this->enkripsi->enc_dec('decrypt', $this->input->post('kid'));

		$data_klinik = $this->m_global->single_row("*", ['deleted_at' => null, 'id' => $id_klinik], "m_klinik");
		
		if(!$data_klinik) {
			echo json_encode([
				'status' => false,
				'url' => 'dashboard'
			]);
			return;
		}

		$this->m_user->set_lastlogin($id_user);
		$data_user = $this->m_global->single_row("*", ['deleted_at' => null, 'id' => $id_user], "m_user");
		
		if(!$data_user) {
			echo json_encode([
				'status' => false,
			]);
			return;
		}

		$this->session->set_userdata(
			array(
				'username' => $data_user->username,
				'id_user' => $data_user->id,
				'last_login' => $data_user->last_login,
				'id_role' => $data_user->id_role,
				'id_klinik' => $data_klinik->id,
				'logged_in' => true,
			)
		);

		echo json_encode([
			'status' => true,
		]);
		
	}

	public function proses()
	{
		$this->load->model('m_user');		
		$pass_string = $this->input->post('password');
		$hasil_password = $this->enkripsi->enc_dec('encrypt', $pass_string);
		// $this->register_user($this->input->post('username'), $hasil_password);
		// exit;
		$data_input = array(
			'data_user'=>$this->input->post('username'),
			'data_password'=>$hasil_password,
		);
		
		$result = $this->m_user->login($data_input);
		
		if(count($result) > 0) {
			if($result[0]->is_all_klinik == '1') {
				### user administrator
				$this->m_user->set_lastlogin($result[0]->id);
				$this->session->set_userdata(
					array(
						'username' => $result[0]->username,
						'id_user' => $result[0]->id,
						'last_login' => $result[0]->last_login,
						'id_role' => $result[0]->id_role,
						'id_klinik' => null,
						'logged_in' => true,
					)
				);

				echo json_encode([
					'status' => true,
					'is_klinik_choice' => false,
				]);
			}else{
				### user dokter
				echo json_encode([
					'status' => true,
					'is_klinik_choice' => true,
					'uid' => $this->enkripsi->enc_dec('encrypt', $result[0]->id),
				]);
			}
			
		}else{
			echo json_encode([
				'status' => false,
				'is_klinik_choice' => false,
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
			$this->session->set_userdata(array('logged_in' => null));
		}
		
		return redirect('login');
	}

	public function lihat_pass($username)
	{
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

	protected function greet()
	{
		$hour = Carbon::now()->format('H');
		if ((int)$hour < 12) {
			return 'Selamat Pagi';
		}
		if ((int)$hour < 17) {
			return 'Selamat Siang';
		}
		return 'Selamat Malam';
	}
}
