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
		$this->load->model('pengguna/mod_pengguna');
		$this->load->library('Enkripsi');

		$pass_string = $this->input->post('password');
		$hasil_password = $this->enkripsi->encrypt($pass_string);
				
		$data_input = array(
			'data_user'=>$this->input->post('username'),
			'data_password'=>$hasil_password,
		);
		
		$result = $this->mod_pengguna->login($data_input);
		
		if ($data = $result[0]) {
			$this->mod_pengguna->set_lastlogin($data['id_user']);
			// unset($data['id_user']);
			$this->session->set_userdata(
				array(
					'username' => $data['username'],
					'id_user' => $data['id_user'],
					'last_login' => $data['last_login'],
					'id_level_user' => $data['id_level_user'],
					'logged_in' => true,
				));
				redirect('home');
		}else{
			//cek login sebagai pegawai/guru
			$data_peg = $this->mod_pengguna->get_datalogin_pegawai(trim($this->input->post('username')));
			if ($data_peg) {
				if ($data_peg->password == null) {
					//cek persamaan user dan password pada inputan
					if (trim($this->input->post('username')) == trim($this->input->post('password'))) {
						$this->session->set_userdata(
							array(
								'username' => $data_peg->nama,
								'id_user' => $data_peg->nip,
								'last_login' => null,
								'id_level_user' => '5',
								'logged_in' => true,
							)
						);
						redirect('home');
					}else{
						$this->session->set_flashdata('message', 'Kombinasi Username & Password Salah, Mohon di cek ulang');
						redirect('login');
					}
				}else{
					//jika password tidak kosong
					if ($this->enkripsi->encrypt(trim($this->input->post('password'))) == $data_peg->password) {
						$this->session->set_userdata(
							array(
								'username' => $data_peg->nama,
								'id_user' => $data_peg->nip,
								'last_login' => null,
								'id_level_user' => '5',
								'logged_in' => true,
							)
						);
						redirect('home');
					}else{
						$this->session->set_flashdata('message', 'Kombinasi Username & Password Salah, Mohon di cek ulang');
						redirect('login');
					}
				}
			}else{
				$this->session->set_flashdata('message', 'Kombinasi Username & Password Salah, Mohon di cek ulang');
				redirect('login');
			}
		}
	}

	public function logout_proc()
	{
		if ($this->session->userdata('logged_in')) 
		{
			//$this->session->sess_destroy();
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('id_user');
			$this->session->unset_userdata('id_level_user');
			$this->session->set_userdata(array('logged_in' => false));
		}
		
		echo json_encode(['status' => 'success']);
	}

	public function lihat_pass($username)
	{
		$this->load->library('Enkripsi');
		$data = $this->db->query("select password from tbl_user where username = '$username'")->row();
		$str_dec = $this->enkripsi->decrypt($data->password);
		echo $str_dec;
	}
}
