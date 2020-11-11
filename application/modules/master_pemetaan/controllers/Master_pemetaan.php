<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_pemetaan extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') === false) {
			return redirect('login');
		}

		$this->load->model('m_user');
		$this->load->model('m_pemetaan');
		$this->load->model('m_global');
	}

	public function index()
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
				
		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Pengelolaan Data Pemetaan',
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
			'modal' => 'modal_master_pemetaan',
			'js'	=> 'master_pemetaan.js',
			'view'	=> 'view_master_pemetaan'
		];

		$this->template_view->load_view($content, $data);
	}

	public function list_pemetaan()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');

		$list = $this->m_pemetaan->get_datatable();
		// echo $this->db->last_query();exit;
		$data = array();
		$no =$_POST['start'];
		foreach ($list as $datalist) {
			$no++;
			$row = array();
			//loop value tabel db
			$row[] = $no;
			$row[] = $datalist->keterangan;
			$row[] = $datalist->umur_awal.' Tahun';
			$row[] = $datalist->umur_akhir.' Tahun';
			$row[] = ($datalist->created_at) ? $obj_date->createFromFormat('Y-m-d H:i:s', $datalist->created_at)->format('d-m-Y H:i') : '-';
			$row[] = ($datalist->updated_at) ? $obj_date->createFromFormat('Y-m-d H:i:s', $datalist->updated_at)->format('d-m-Y H:i') : '-';			
			
			$str_aksi = '
				<div class="btn-group">
					<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Opsi</button>
					<div class="dropdown-menu">
						<button class="dropdown-item" onclick="edit_pemetaan(\''.$datalist->id.'\')">
							<i class="la la-pencil"></i> Edit Pemetaan
						</button>
						<button class="dropdown-item" onclick="delete_pemetaan(\''.$datalist->id.'\')">
							<i class="la la-trash"></i> Hapus
						</button>
			';

			$str_aksi .= '</div></div>';
		

			$row[] = $str_aksi;

			$data[] = $row;

		}//end loop

		$output = [
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_pemetaan->count_all(),
			"recordsFiltered" => $this->m_pemetaan->count_filtered(),
			"data" => $data
		];
		
		echo json_encode($output);
	}

	public function edit_pemetaan()
	{
		$id = $this->input->post('id');
		$oldData = $this->m_pemetaan->get_by_id($id);
		
		if(!$oldData){
			return redirect($this->uri->segment(1));
		}

		$data = array('old_data' => $oldData);
		
		echo json_encode($data);
	}

	public function add_data_pemetaan()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$arr_valid = $this->rule_validasi();
		
		$keterangan = trim($this->input->post('keterangan'));
		$umur_awal = trim($this->input->post('umur_awal'));
		$umur_akhir = trim($this->input->post('umur_akhir'));

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}

		$this->db->trans_begin();
		
		$data = [
			'id' => $this->m_pemetaan->get_max_id_pemetaan(),
			'keterangan' => $keterangan,
			'umur_awal' => $umur_awal,
			'umur_akhir' => $umur_akhir,
			'created_at' => $timestamp
		];
		
		$insert = $this->m_pemetaan->save($data);
		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['pesan'] = 'Gagal menambahkan Pemetaan';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['pesan'] = 'Sukses menambahkan Pemetaan';
		}

		echo json_encode($retval);
	}

	public function update_data_pemetaan()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$arr_valid = $this->rule_validasi();

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}

		$keterangan = trim($this->input->post('keterangan'));
		$umur_awal = trim($this->input->post('umur_awal'));
		$umur_akhir = trim($this->input->post('umur_akhir'));
		
		$this->db->trans_begin();
		
		$data_upd = [
			'keterangan' => $keterangan,
			'umur_awal' => $umur_awal,
			'umur_akhir' => $umur_akhir,
			'updated_at' => $timestamp
		];

		$where = ['id' => $this->input->post('id_pemetaan')];
		$update = $this->m_pemetaan->update($where, $data_upd);
				
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$data['status'] = false;
			$data['pesan'] = 'Gagal update Master Pemetaan';
		}else{
			$this->db->trans_commit();
			$data['status'] = true;
			$data['pesan'] = 'Sukses update Master Pemetaan';
		}
		
		echo json_encode($data);
	}

	/**
	 * Hanya melakukan softdelete saja
	 * isi kolom deleted_at dengan datetime now()
	 */
	public function delete_pemetaan()
	{
		$id = $this->input->post('id');
		$del = $this->m_pemetaan->softdelete_by_id($id);
		if($del) {
			$retval['status'] = TRUE;
			$retval['pesan'] = 'Data Master pemetaan Berhasil dihapus';
		}else{
			$retval['status'] = FALSE;
			$retval['pesan'] = 'Data Master pemetaan Gagal dihapus';
		}

		echo json_encode($retval);
	}

	public function edit_status_pegawai()
	{
		$input_status = $this->input->post('status');
		// jika aktif maka di set ke nonaktif / "0"
		$status = ($input_status == "aktif") ? $status = 0 : $status = 1;
			
		$input = ['is_aktif' => $status];

		$where = ['id' => $this->input->post('id')];

		$this->m_pegawai->update($where, $input);

		if ($this->db->affected_rows() == '1') {
			$data = array(
				'status' => TRUE,
				'pesan' => "Status Pegawai berhasil di ubah.",
			);
		}else{
			$data = array(
				'status' => FALSE
			);
		}

		echo json_encode($data);
	}

	public function cetak_data()
	{
		$select = "*";
		$where = ["deleted_at is null"];
		$orderby = "umur_awal asc";
		$data = $this->m_global->multi_row($select, $where, 'm_pemetaan', null, $orderby);
		$data_klinik = $this->m_global->single_row('*', 'deleted_at is null', 'm_klinik');

		$retval = [
			'data' => $data,
			'data_klinik' => $data_klinik,
			'title' => 'Master Data Pemetaan'
		];
		
		// $this->load->view('pdf', $retval);
		$html = $this->load->view('pdf', $retval, true);
	    $filename = 'master_data_pemetaan_'.time();
	    $this->lib_dompdf->generate($html, $filename, true, 'A4', 'potrait');
	}

	// ===============================================
	private function rule_validasi()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('keterangan') == '') {
			$data['inputerror'][] = 'keterangan';
            $data['error_string'][] = 'Wajib mengisi keterangan';
            $data['status'] = FALSE;
		}

		if ($this->input->post('umur_awal') == '') {
			$data['inputerror'][] = 'umur_awal';
            $data['error_string'][] = 'Wajib mengisi umur awal';
            $data['status'] = FALSE;
		}

		if ($this->input->post('umur_akhir') == '') {
			$data['inputerror'][] = 'umur_akhir';
            $data['error_string'][] = 'Wajib mengisi umur akhir';
            $data['status'] = FALSE;
		}

        return $data;
	}
}
