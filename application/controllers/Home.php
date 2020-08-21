<?php
//defined('BASEPATH ') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		//cek apablia session kosong
		if ($this->session->userdata('username') === null) {
			//direct ke controller login
			redirect('login');
		}

		$this->load->model('Mod_home');
		//profil data
		$this->load->model('profil/mod_profil','prof');
	}

	public function index()
	{	
		$tahun = date('Y');
		$bulan = date('m');
		$hari = date('d');
		$id_user = $this->session->userdata('id_user');
		$data_dashboard = [];
		
		$data = array(
			'title' => 'Sistem Informasi Odontogram',
			// 'data_user' => $query,
			// 'data_dashboard' => $data_dashboard,
			// 'component' => $component
		);

		$content = [
			'modal' => false,
			'js'	=> 'dashboard/jsDashboard',
			'css'	=> false,
			'view'	=> 'dashboard/view_dashboard'
		];

		$this->template_view->load_view($content, $data);
	}


	public function oops()
	{	
		$this->load->view('login/view_404');
	}

	public function bulan_indo($bulan)
	{
		$arr_bulan =  [
			1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
		];

		return $arr_bulan[(int) $bulan];
	}

}
