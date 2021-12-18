<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_honor_dokter extends CI_Controller {
	
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
			
		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Laporan Penjualan',
			'data_user' => $data_user,
			'data_role'	=> $data_role,
		);

		/**
		 * content data untuk template
		 * param (css : link css pada direktori assets/css_module)
		 * param (modal : modal komponen pada modules/nama_modul/views/nama_modal)
		 * param (js : link js pada direktori assets/js_module)
		 */
		$content = [
			'css' 	=> null,
			'modal' => '',
			'js'	=> 'lap_honor_dokter.js',
			'view'	=> 'view_laporan'
		];

		$this->template_view->load_view($content, $data);
	}

	public function datatable()
	{
		$model = $this->input->post('model');
		$tahun2 = $this->input->post('tahun2');

		$tahun = $this->input->post('tahun');
		$bulan = $this->input->post('bulan');
		$start = $this->input->post('start');
		$end = $this->input->post('end');

		if ($start) {
			$start = date('Y-d-m', strtotime($start));
		}

		if ($end) {
			$exp_date = str_replace('/', '-', $end);
			$end = date('Y-m-d', strtotime($exp_date));
		}

		if ($model == 2) {
			$data_table = $this->m_laporan->get_laporan_penjualan($model, $tahun2);
		}elseif ($model == 1) {
			$data_table = $this->m_laporan->get_laporan_penjualan($model, null, $tahun, $bulan );
		}elseif ($model == 3) {
			$data_table = $this->m_laporan->get_laporan_penjualan($model, null, null, null, $start, $end );
		}

		// echo $this->db->last_query(); die();
		
		// var_dump($data_table); die();
		$data = [];
		if ($data_table) {
			foreach ($data_table as $key => $value) {
			
				$data[$key][] = $key+1;
				$data[$key][] = $value->nama_pelanggan;
				$data[$key][] = $value->nama_barang;
				$data[$key][] = $value->qty.' Pcs';
				$data[$key][] = 'Rp '.number_format($value->sub_total); 
				$data[$key][] = date('d-m-Y H:i:s', strtotime($value->tanggal_order));	
				
			}
		}
        
		
		// $this->output->enable_profiler(TRUE);

        echo json_encode([
            'data' => $data
        ]);
	} 


	
}
