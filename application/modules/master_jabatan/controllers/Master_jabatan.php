<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_jabatan extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') === null) {
			return redirect('login');
		}

		$this->load->model('m_user');
		$this->load->model('m_jabatan');
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
			'title' => 'Pengelolaan Data Jabatan',
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
			'modal' => 'modal_master_jabatan',
			'js'	=> 'master_jabatan.js',
			'view'	=> 'view_master_jabatan'
		];

		$this->template_view->load_view($content, $data);
	}

	public function list_jabatan()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');

		$list = $this->m_jabatan->get_datatable();
		$data = array();
		$no =$_POST['start'];
		foreach ($list as $datalist) {
			$no++;
			$row = array();
			//loop value tabel db
			$row[] = $no;
			$row[] = $datalist->nama;
			$row[] = $datalist->keterangan;
			$row[] = ($datalist->created_at) ? $obj_date->createFromFormat('Y-m-d H:i:s', $datalist->created_at)->format('d-m-Y H:i') : '-';
			$row[] = ($datalist->updated_at) ? $obj_date->createFromFormat('Y-m-d H:i:s', $datalist->updated_at)->format('d-m-Y H:i') : '-';			
			
			$str_aksi = '
				<div class="btn-group">
					<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Opsi</button>
					<div class="dropdown-menu">
						<button class="dropdown-item" onclick="edit_jabatan(\''.$datalist->id.'\')">
							<i class="la la-pencil"></i> Edit Jabatan
						</button>
						<button class="dropdown-item" onclick="delete_jabatan(\''.$datalist->id.'\')">
							<i class="la la-trash"></i> Hapus
						</button>
			';

			$str_aksi .= '</div></div>';
		

			$row[] = $str_aksi;

			$data[] = $row;

		}//end loop

		$output = [
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_jabatan->count_all(),
			"recordsFiltered" => $this->m_jabatan->count_filtered(),
			"data" => $data
		];
		
		echo json_encode($output);
	}

	public function edit_jabatan()
	{
		$id = $this->input->post('id');
		$oldData = $this->m_jabatan->get_by_id($id);
		
		if(!$oldData){
			return redirect($this->uri->segment(1));
		}

		$data = array('old_data' => $oldData);
		
		echo json_encode($data);
	}

	public function add_data_jabatan()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$arr_valid = $this->rule_validasi();
		
		$nama = trim($this->input->post('nama'));
		$keterangan = trim($this->input->post('keterangan'));

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}

		$this->db->trans_begin();
		
		$data = [
			'id' => $this->m_jabatan->get_max_id_jabatan(),
			'nama' => $nama,
			'keterangan' => $keterangan,
			'created_at' => $timestamp
		];
		
		$insert = $this->m_jabatan->save($data);
		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['pesan'] = 'Gagal menambahkan Jabatan';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['pesan'] = 'Sukses menambahkan Jabatan';
		}

		echo json_encode($retval);
	}

	public function update_data_jabatan()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$arr_valid = $this->rule_validasi();

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}

		$nama = trim($this->input->post('nama'));
		$keterangan = trim($this->input->post('keterangan'));
		
		$this->db->trans_begin();
		
		$data_upd = [
			'nama' => $nama,
			'keterangan' => $keterangan,
			'updated_at' => $timestamp
		];

		$where = ['id' => $this->input->post('id_jabatan')];
		$update = $this->m_jabatan->update($where, $data_upd);
				
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$data['status'] = false;
			$data['pesan'] = 'Gagal update Master Jabatan';
		}else{
			$this->db->trans_commit();
			$data['status'] = true;
			$data['pesan'] = 'Sukses update Master Jabatan';
		}
		
		echo json_encode($data);
	}

	/**
	 * Hanya melakukan softdelete saja
	 * isi kolom updated_at dengan datetime now()
	 */
	public function delete_jabatan()
	{
		$id = $this->input->post('id');
		$del = $this->m_jabatan->softdelete_by_id($id);
		if($del) {
			$retval['status'] = TRUE;
			$retval['pesan'] = 'Data Master Jabatan Berhasil dihapus';
		}else{
			$retval['status'] = FALSE;
			$retval['pesan'] = 'Data Master Jabatan Gagal dihapus';
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
		$orderby = "nama asc";
		$data = $this->m_global->multi_row($select, $where, 'm_jabatan', null, $orderby);
		$data_klinik = $this->m_global->single_row('*', 'deleted_at is null', 'm_klinik');

		$retval = [
			'data' => $data,
			'data_klinik' => $data_klinik,
			'title' => 'Master Data Jabatan'
		];
		
		// $this->load->view('pdf', $retval);
		$html = $this->load->view('pdf', $retval, true);
	    $filename = 'master_data_jabatan_'.time();
	    $this->lib_dompdf->generate($html, $filename, true, 'A4', 'potrait');
	}

	// ===============================================
	private function rule_validasi()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('nama') == '') {
			$data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Wajib mengisi Nama Jabatan';
            $data['status'] = FALSE;
		}

		if ($this->input->post('keterangan') == '') {
			$data['inputerror'][] = 'keterangan';
            $data['error_string'][] = 'Wajib mengisi Keterangan Jabatan';
            $data['status'] = FALSE;
		}

        return $data;
	}
}
