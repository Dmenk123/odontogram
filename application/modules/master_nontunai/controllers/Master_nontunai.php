<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Carbon\Carbon;
class Master_nontunai extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') === null) {
			return redirect('login');
		}

		$this->load->model('m_user');
		$this->load->model('m_global');
		$this->load->library('Enkripsi');
		
	}

	public function index()
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
			
		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Pengelolaan Diskon Tindakan',
			'data_user' => $data_user,
		);

		/**
		 * content data untuk template
		 * param (css : link css pada direktori assets/css_module)
		 * param (modal : modal komponen pada modules/nama_modul/views/nama_modal)
		 * param (js : link js pada direktori assets/js_module)
		 */
		$content = [
			'css' 	=> null,
			'modal' => 'modal_master_nontunai',
			'js'	=> 'm_nontunai.js',
			'view'	=> 'view_master_nontunai'
		];

		$this->template_view->load_view($content, $data);
	}

	public function list_data_nontunai()
	{
		$this->load->library('Enkripsi');
		$listData = $this->m_global->multi_row('*', ['deleted_at' => null], 'm_nontunai', NULL, 'nama asc');
		$datas = [];
		$i = 1;
		foreach ($listData as $key => $value) {
			$datas[$key][] = $value->nama;
			$datas[$key][] = tanggal_indo($value->created_at).' '.Carbon::parse($value->created_at)->format('H:i:s');
			$str_aksi = '
				<div class="btn-group">
					<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Opsi</button>
					<div class="dropdown-menu">
						<button class="dropdown-item" onclick="delete_transaksi(\'' .$this->enkripsi->enc_dec('encrypt', $value->id). '\')">
							<i class="la la-trash"></i> Hapus
						</button>
					</div>
				</div>
			';
			$datas[$key][] =  $str_aksi;
		}

		$data = [
			'data' => $datas
		];

		echo json_encode($data);
	}

	public function simpan_data()
	{
		$timestamp = Carbon::now()->format('Y-m-d H:i:s');
		$arr_valid = $this->rule_validasi();

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}
		
		$nama = $this->input->post('nama');		
		$this->db->trans_begin();

		### add new data
		$data_ins = [
			'nama' => $nama,
			'created_at' => $timestamp,
		];

		$insert = $this->m_global->store($data_ins,'m_nontunai');
		

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['pesan'] = 'Gagal menambahkan Data';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['pesan'] = 'Sukses menambahkan Data';
		}

		echo json_encode($retval);
	}

	/**
	 * Hanya melakukan softdelete saja
	 * isi kolom updated_at dengan datetime now()
	 */
	public function delete_data()
	{
		$id = $this->input->post('id');
		$id = $this->enkripsi->enc_dec('decrypt', $id);
		$del = $this->m_global->softdelete(['id' => $id], 'm_nontunai');
		if($del) {
			$retval['status'] = TRUE;
			$retval['pesan'] = 'Data Master dihapus';
		}else{
			$retval['status'] = FALSE;
			$retval['pesan'] = 'Data Master dihapus';
		}

		echo json_encode($retval);
	}
	
	// ===============================================
	private function rule_validasi($tipe='')
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('nama') == '') {
			$data['inputerror'][] = 'nama';
			$data['error_string'][] = 'Wajib mengisi nama';
			$data['status'] = FALSE;
		}

        return $data;
	}

}
