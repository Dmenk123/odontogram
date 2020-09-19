<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_asuransi extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') === false) {
			return redirect('login');
		}

		$this->load->model('master_user/m_user');
		$this->load->model('m_asuransi');
		$this->load->model('m_global');
	}

	public function index()
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
		$data_role = $this->m_role->get_data_all(['aktif' => '1'], 'm_role');
		$data_peg = $this->m_global->multi_row("*", "is_aktif = '1' and deleted_at is null", "m_pegawai", NULL, "nama asc");
			
		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Pengelolaan Data User',
			'data_user' => $data_user,
			'data_role'	=> $data_role,
			'data_peg'	=> $data_peg
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

	public function get_select_asuransi()
	{
		$term = $this->input->get('term');
		$data = $this->m_global->multi_row('*', ['deleted_at' => null, 'nama like' => '%'.$term.'%'], 'm_asuransi', null, 'nama');
		if($data) {
			foreach ($data as $key => $value) {
				$row['id'] = $value->id;
				$row['text'] = $value->nama;
				$retval[] = $row;
			}
		}else{
			$retval = false;
		}
		echo json_encode($retval);
	}

	public function list_data()
	{
		$this->load->library('Enkripsi');
		$list = $this->m_asuransi->get_datatables();
		$data = array();
		//$no =$_POST['start'];
		foreach ($list as $val) {
			//$no++;
			$row = array();
			//loop value tabel db
			//$row[] = $no;
			$row[] = $val->nama;
			$row[] = $val->keterangan;
			
			$str_aksi = '
						<button class="button btn-sm btn-warning" onclick="edit_asuransi(\''.$this->enkripsi->enc_dec('encrypt', $val->id).'\')">
							<i class="la la-pencil"></i> Edit
						</button>
						<button class="button btn-sm btn-danger" onclick="delete_asuransi(\''.$this->enkripsi->enc_dec('encrypt', $val->id).'\')">
							<i class="la la-trash"></i> Hapus
						</button>
			';
			$row[] = $str_aksi;

			$data[] = $row;
		}//end loop

		$output = [
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_asuransi->count_all(),
			"recordsFiltered" => $this->m_asuransi->count_filtered(),
			"data" => $data
		];
		
		echo json_encode($output);
	}

	public function edit_data()
	{
		$this->load->library('Enkripsi');
		$enc_id = $this->input->get('id');
		$id = $this->enkripsi->enc_dec('decrypt', $enc_id);
		
		$oldData = $this->m_asuransi->get_by_id($id);
		
		if(!$oldData){
			$status = false;
		}else{
			$status = true;
		}
		
		$data = array(
			'old_data'	=> $oldData,
			'status' => $status
		);
		
		echo json_encode($data);
	}

	public function simpan_data()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$arr_valid = $this->rule_validasi();
		
		$nama = trim($this->input->post('nama_asuransi'));
		$keterangan = trim($this->input->post('ket_asuransi'));

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}

		$this->db->trans_begin();

		$data = [
			'id' => $this->m_asuransi->get_max_id(),
			'nama' => $nama,
			'keterangan' => $keterangan,
			'created_at' => $timestamp
		];
		
		$insert = $this->m_asuransi->save($data);
		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['pesan'] = 'Gagal menambahkan data';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['pesan'] = 'Sukses menambahkan data';
		}

		echo json_encode($retval);
	}

	public function update_data()
	{
		$id = $this->input->post('id_asuransi');
		$nama = trim($this->input->post('nama_asuransi'));
		$keterangan = trim($this->input->post('ket_asuransi'));
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');

		$arr_valid = $this->rule_validasi();

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}

		
		$this->db->trans_begin();

		$data = [
			'nama' => $nama,
			'keterangan' => $keterangan,
			'updated_at' => $timestamp
		];

		$where = ['id' => $id];
		$update = $this->m_asuransi->update($where, $data);

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$data['status'] = false;
			$data['pesan'] = 'Gagal update Master Asuransi';
		}else{
			$this->db->trans_commit();
			$data['status'] = true;
			$data['pesan'] = 'Sukses update Master Asuransi';
		}
		
		echo json_encode($data);
	}

	/**
	 * Hanya melakukan softdelete saja
	 * isi kolom updated_at dengan datetime now()
	 */
	public function delete_data()
	{
		$this->load->library('Enkripsi');
		$enc_id = $this->input->post('id');
		$id = $this->enkripsi->enc_dec('decrypt', $enc_id);
		$del = $this->m_asuransi->softdelete_by_id($id);
		if($del) {
			$retval['status'] = TRUE;
			$retval['pesan'] = 'Data Master Asuransi dihapus';
		}else{
			$retval['status'] = FALSE;
			$retval['pesan'] = 'Data Master Asuransi dihapus';
		}

		echo json_encode($retval);
	}


	// ===============================================
	private function rule_validasi($is_update=false, $skip_pass=false)
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('nama_asuransi') == '') {
			$data['inputerror'][] = 'nama_asuransi';
            $data['error_string'][] = 'Wajib mengisi Nama Asuransi';
            $data['status'] = FALSE;
		}


		if ($this->input->post('ket_asuransi') == '') {
			$data['inputerror'][] = 'ket_asuransi';
            $data['error_string'][] = 'Wajib Mengisi Keterangan Asuransi';
            $data['status'] = FALSE;
		}

        return $data;
	}
}
