<?php
//defined('BASEPATH ') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('dashboard/m_dashboard');
		$this->load->model('master_user/m_user');

		if($this->session->userdata('logged_in') === false) {
			return redirect('login');
		}
	}

	public function index()
	{	
		$tahun = date('Y');
		$bulan = date('m');
		$hari = date('d');
		$id_user = $this->session->userdata('id_user');
		$data_user = $this->m_user->get_detail_user($id_user);
		$data_dashboard = [];
		
		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Dashboard Aplikasi',
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
			'js'	=> null,
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
