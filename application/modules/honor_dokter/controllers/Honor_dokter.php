<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Honor_dokter extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') === null) {
			return redirect('login');
		}

		$this->load->model('m_user');
		$this->load->model('t_honor');
		$this->load->model('m_global');
		$this->load->model('set_role/m_set_role', 'm_role');
	}

	public function index()
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
		$data_role = $this->m_role->get_data_all(['aktif' => '1'], 'm_role');
		$data_peg = $this->m_global->multi_row("*", "is_aktif = '1' and deleted_at is null and id_jabatan = '1'", "m_pegawai", NULL, "nama asc");
			
		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Pengelolaan Honor Dokter',
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
			'modal' => 'modal_honor_dokter',
			'js'	=> 'honor_dokter.js',
			'view'	=> 'view_honor_dokter'
		];

		$this->template_view->load_view($content, $data);
	}

	public function list_data()
	{
		$list = $this->t_honor->get_datatable();
		$data = array();
		$no =$_POST['start'];
		foreach ($list as $val) {
			// $no++;
			$row = array();
			//loop value tabel db
			// $row[] = $no;
			$row[] = $val->nama_dokter;
			$row[] = "Rp " . number_format($val->honor_visite,2,',','.');
			$row[] = $val->tindakan_persen.' %';
			$row[] = $val->obat_persen.' %';
			$row[] = $val->tindakan_lab_persen.' %';
			
			$str_aksi = '
				<div class="btn-group">
					<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Opsi</button>
					<div class="dropdown-menu">
						<button class="dropdown-item" onclick="edit_honor(\''.$val->id.'\')">
							<i class="la la-pencil"></i> Edit Honor
						</button>
						<button class="dropdown-item" onclick="delete_honor(\''.$val->id.'\')">
							<i class="la la-trash"></i> Hapus
						</button>
			';

			$str_aksi .= '</div></div>';
			$row[] = $str_aksi;

			$data[] = $row;
		}//end loop

		$output = [
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->t_honor->count_all(),
			"recordsFiltered" => $this->t_honor->count_filtered(),
			"data" => $data
		];
		
		echo json_encode($output);
	}

	public function get_data_form_tindakan()
 	{
		$id_dokter = $this->input->post('id_dokter');
		
		$dokter =  $this->m_global->single_row('*', ['id' => $id_dokter], 'm_pegawai');
		$tindakan = $this->m_global->multi_row('*', ['deleted_at' => null], 'm_tindakan', null, 'kode_tindakan');
		
		$join = [ 
			[
				'table' => 'm_tindakan',
				'on'	=> 't_honor_dokter_tindakan.id_tindakan = m_tindakan.id_tindakan'
			],
		];

		$data_tindakan = $this->m_global->multi_row('t_honor_dokter_tindakan.*, m_tindakan.kode_tindakan, m_tindakan.harga, m_tindakan.nama_tindakan', ['t_honor_dokter_tindakan.deleted_at' => null, 'id_dokter' => $id_dokter], 't_honor_dokter_tindakan', $join, 'id_tindakan');

		$html = '';
		if($data_tindakan) {
			foreach ($data_tindakan as $key => $value) {
				$html .= '<tr>
							<th>'.$value->kode_tindakan.'</th>
							<th>'.$value->nama_tindakan.'</th>
							<th>'.$value->harga.'</th>
							<th>'.$value->persentase.'</th>
							<th><button type="button" class="button btn-sm btn-danger" onclick="hapus_honor_tindakan(\''.$value->id.'\')"><i class="la la-trash"></i></button></th>	
						</tr>';
			}
		}
		echo json_encode(['tindakan' => $tindakan, 'dokter' => $dokter, 'html' => $html]);
	}

	public function add_data_honor_tindakan()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$arr_valid = $this->rule_validasi('tindakan');

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}
		
		$id_dokter_tindakan = trim($this->input->post('id_dokter_tindakan'));
		// $nama_dokter_tindakan = trim($this->input->post('nama_dokter_tindakan'));
		$id_tindakan = trim($this->input->post('id_tindakan'));
		$honor_tindakan_persen = trim($this->input->post('honor_tindakan_persen'));
		
		//cek exist
		$cek = $this->m_global->single_row('*', ['id_dokter' => $id_dokter_tindakan, 'id_tindakan' => $id_tindakan, 'deleted_at' => null], 't_honor_dokter_tindakan');
		
		if($cek) {
			$retval['status'] = false;
			$retval['is_alert'] = true;
			$retval['pesan'] = 'Maaf Tindakan Telah Ada';
			echo json_encode($retval);
			return;
		}else{
			$this->db->trans_begin();
			$data_ins = [
				'id_dokter' => $id_dokter_tindakan,
				'id_tindakan' => $id_tindakan,
				'persentase' => $honor_tindakan_persen,
				'created_at' => $timestamp,
				
			];

			$insert = $this->m_global->store($data_ins,'t_honor_dokter_tindakan');
		}

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['is_alert'] = false;
			$retval['id_dokter'] = null;
			$retval['pesan'] = 'Gagal menambahkan tindakan';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['is_alert'] = false;
			$retval['id_dokter'] = $id_dokter_tindakan;
			$retval['pesan'] = 'Sukses menambahkan tindakan';
		}

		echo json_encode($retval);
	}

	public function add_data_honor_lab()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$arr_valid = $this->rule_validasi('lab');

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}
		
		$id_dokter_lab = trim($this->input->post('id_dokter_lab'));
		// $nama_dokter_tindakan = trim($this->input->post('nama_dokter_tindakan'));
		$id_lab = trim($this->input->post('id_lab'));
		$honor_lab_persen = trim($this->input->post('honor_lab_persen'));
		
		//cek exist
		$cek = $this->m_global->single_row('*', ['id_dokter' => $id_dokter_lab, 'id_lab' => $id_lab, 'deleted_at' => null], 't_honor_dokter_lab');
		
		if($cek) {
			$retval['status'] = false;
			$retval['is_alert'] = true;
			$retval['pesan'] = 'Maaf Tindakan Lab Telah Ada';
			echo json_encode($retval);
			return;
		}else{
			$this->db->trans_begin();
			$data_ins = [
				'id_dokter' => $id_dokter_lab,
				'id_lab' => $id_lab,
				'persentase' => $honor_lab_persen,
				'created_at' => $timestamp,
				
			];

			$insert = $this->m_global->store($data_ins,'t_honor_dokter_lab');
		}

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['is_alert'] = false;
			$retval['id_dokter'] = null;
			$retval['pesan'] = 'Gagal menambahkan Tindakan Lab';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['is_alert'] = false;
			$retval['id_dokter'] = $id_dokter_lab;
			$retval['pesan'] = 'Sukses menambahkan Tindakan Lab';
		}

		echo json_encode($retval);
	}

	public function add_data_honor()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$arr_valid = $this->rule_validasi();

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}
		
		$honor_visite = (int)str_replace(".","",$this->input->post('honor_visite'));
		$id_dokter = trim($this->input->post('dokter'));
		$tindakan_persen = trim($this->input->post('honor_tindakan'));
		$obat_persen = trim($this->input->post('honor_obat'));
		$tindakan_lab_persen = trim($this->input->post('honor_lab'));
		
		//cek exist
		$cek = $this->m_global->single_row('*', ['id_dokter' => $id_dokter, 'deleted_at' => null], 't_honor');
		
		if($cek) {
			$retval['status'] = false;
			$retval['is_alert'] = true;
			$retval['pesan'] = 'Maaf Data Honor pada dokter ini sudah ada';
			echo json_encode($retval);
			return;
		}else{
			$this->db->trans_begin();
			$data_ins = [
				'id_dokter' => $id_dokter,
				'honor_visite' => (float)$honor_visite,
				'tindakan_persen' => $tindakan_persen,
				'tindakan_lab_persen' => $tindakan_lab_persen,
				'obat_persen' => $obat_persen,
				'created_at' => $timestamp,
			];

			$insert = $this->m_global->store($data_ins,'t_honor');
		}

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['is_alert'] = false;
			$retval['id_dokter'] = null;
			$retval['pesan'] = 'Gagal menambahkan Honor Dokter';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['is_alert'] = false;
			$retval['id_dokter'] = $id_dokter;
			$retval['pesan'] = 'Sukses menambahkan Honor Dokter';
		}

		echo json_encode($retval);
	}

	public function get_data_form_lab()
 	{
		$id_dokter = $this->input->post('id_dokter');
		
		$dokter =  $this->m_global->single_row('*', ['id' => $id_dokter], 'm_pegawai');
		$lab = $this->m_global->multi_row('*', ['deleted_at' => null], 'm_laboratorium', null, 'kode');
		
		$join = [ 
			[
				'table' => 'm_laboratorium',
				'on'	=> 't_honor_dokter_lab.id_lab = m_laboratorium.id_laboratorium'
			],
		];

		$data_lab = $this->m_global->multi_row('t_honor_dokter_lab.*, m_laboratorium.kode, m_laboratorium.harga, m_laboratorium.tindakan_lab', ['t_honor_dokter_lab.deleted_at' => null, 'id_dokter' => $id_dokter], 't_honor_dokter_lab', $join, 'id_lab');

		$html = '';
		if($data_lab) {
			foreach ($data_lab as $key => $value) {
				$html .= '<tr>
							<th>'.$value->kode.'</th>
							<th>'.$value->tindakan_lab.'</th>
							<th>'.$value->harga.'</th>
							<th>'.$value->persentase.'</th>
							<th><button type="button" class="button btn-sm btn-danger" onclick="hapus_honor_lab(\''.$value->id.'\')"><i class="la la-trash"></i></button></th>	
						</tr>';
			}
		}
		echo json_encode(['lab' => $lab, 'dokter' => $dokter, 'html' => $html]);
	}

	public function delete_honor_tindakan()
	{
		$id = $this->input->post('id');
		$oldData = $this->m_global->single_row('*', ['id' => $id], 't_honor_dokter_tindakan');
		if($oldData){
			##soft delete saja
			$id_dokter = $oldData->id_dokter;
			$del = $this->m_global->softdelete(['id'=>$id], 't_honor_dokter_tindakan');
		}else{
			$id_dokter = NULL;
			$del = FALSE;
		}
		
		if($del) {
			$retval['status'] = TRUE;
			$retval['id_dokter'] = $id_dokter;
			$retval['pesan'] = 'Data Honor Tindakan Sukses dihapus';
		}else{
			$retval['status'] = FALSE;
			$retval['id_dokter'] = $id_dokter;
			$retval['pesan'] = 'Data Honor Tindakan Gagal dihapus';
		}

		echo json_encode($retval);
	}

	public function delete_honor_lab()
	{
		$id = $this->input->post('id');
		$oldData = $this->m_global->single_row('*', ['id' => $id], 't_honor_dokter_lab');
		if($oldData){
			##soft delete saja
			$id_dokter = $oldData->id_dokter;
			$del = $this->m_global->softdelete(['id'=>$id], 't_honor_dokter_lab');
		}else{
			$id_dokter = NULL;
			$del = FALSE;
		}
		
		if($del) {
			$retval['status'] = TRUE;
			$retval['id_dokter'] = $id_dokter;
			$retval['pesan'] = 'Data Honor Lab Sukses dihapus';
		}else{
			$retval['status'] = FALSE;
			$retval['id_dokter'] = $id_dokter;
			$retval['pesan'] = 'Data Honor Lab Gagal dihapus';
		}

		echo json_encode($retval);
	}

	public function edit_data()
	{
		$this->load->library('Enkripsi');
		$id = $this->input->post('id');
		$oldData = $this->t_honor->get_by_id($id);
			
		if(!$oldData){
			return redirect($this->uri->segment(1));
		}

		$data = array(
			'old_data'	=> $oldData
		);
		
		echo json_encode($data);
	}

	public function update_data_honor()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$arr_valid = $this->rule_validasi();

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}

		$id = $this->input->post('id_honor');
		$honor_visite = (int)str_replace(".","",$this->input->post('honor_visite'));
		$id_dokter = trim($this->input->post('dokter'));
		$tindakan_persen = trim($this->input->post('honor_tindakan'));
		$obat_persen = trim($this->input->post('honor_obat'));
		$tindakan_lab_persen = trim($this->input->post('honor_lab'));

		//cek exist
		$cek = $this->m_global->single_row('*', ['id_dokter' => $id_dokter, 'deleted_at' => null], 't_honor');

		if($cek) {
			if($cek->id_dokter == $id) {
				$flag_lanjut = true;
			}else{
				$flag_lanjut = false;
			}
		}else{
			$flag_lanjut = true;
		}

		if($flag_lanjut == false) {
			$retval['status'] = false;
			$retval['is_alert'] = true;
			$retval['pesan'] = 'Maaf Data Honor pada dokter ini sudah ada';
			echo json_encode($retval);
			return;
		}else{
			$this->db->trans_begin();

			$data = [
				'id_dokter' => $id_dokter,
				'honor_visite' => (float)$honor_visite,
				'tindakan_persen' => $tindakan_persen,
				'tindakan_lab_persen' => $tindakan_lab_persen,
				'obat_persen' => $obat_persen,
				'updated_at' => $timestamp,
			];

			$update = $this->t_honor->update(['id' => $id], $data);
		}

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['is_alert'] = false;
			$retval['id_dokter'] = null;
			$retval['pesan'] = 'Gagal mengupdate Honor Dokter';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['is_alert'] = false;
			$retval['id_dokter'] = $id_dokter;
			$retval['pesan'] = 'Sukses mengupdate Honor Dokter';
		}

		echo json_encode($retval);
	}

	/**
	 * Hanya melakukan softdelete saja
	 * isi kolom updated_at dengan datetime now()
	 */
	public function delete_honor()
	{
		$id = $this->input->post('id');
		$del = $this->t_honor->softdelete_by_id($id);
		if($del) {
			$retval['status'] = TRUE;
			$retval['pesan'] = 'Data Master Honor dihapus';
		}else{
			$retval['status'] = FALSE;
			$retval['pesan'] = 'Data Master Honor dihapus';
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

		if($tipe == 'tindakan') {
			if ($this->input->post('id_tindakan') == '' || $this->input->post('id_tindakan') == '0') {
				$data['inputerror'][] = 'id_tindakan';
				$data['error_string'][] = 'Wajib mengisi Tindakan';
				$data['status'] = FALSE;
			}
			if ($this->input->post('honor_tindakan_persen') == '' || $this->input->post('honor_tindakan_persen') == '0') {
				$data['inputerror'][] = 'honor_tindakan_persen';
				$data['error_string'][] = 'Wajib mengisi Persentase';
				$data['status'] = FALSE;
			}
		}elseif($tipe == 'lab'){
			
			if ($this->input->post('id_lab') == '' || $this->input->post('id_lab') == '0') {
				$data['inputerror'][] = 'id_lab';
				$data['error_string'][] = 'Wajib mengisi Tindakan Lab';
				$data['status'] = FALSE;
			}
			if ($this->input->post('honor_lab_persen') == '' || $this->input->post('honor_lab_persen') == '0') {
				$data['inputerror'][] = 'honor_lab_persen';
				$data['error_string'][] = 'Wajib mengisi Persentase';
				$data['status'] = FALSE;
			}
			
		}else{
			if ($this->input->post('honor_visite') == '') {
				$data['inputerror'][] = 'honor_visite';
				$data['error_string'][] = 'Minimal Honor adalah 0';
				$data['status'] = FALSE;
			}

			if ($this->input->post('dokter') == '') {
				$data['inputerror'][] = 'dokter';
				$data['error_string'][] = 'Wajib Memilih Dokter';
				$data['status'] = FALSE;
			}

			if ($this->input->post('honor_tindakan') == '') {
				$data['inputerror'][] = 'honor_tindakan';
				$data['error_string'][] = 'Minimal Honor adalah 0';
				$data['status'] = FALSE;
			}

			if ($this->input->post('honor_obat') == '') {
				$data['inputerror'][] = 'honor_obat';
				$data['error_string'][] = 'Minimal Honor adalah 0';
				$data['status'] = FALSE;
			}

			if ($this->input->post('honor_lab') == '') {
				$data['inputerror'][] = 'honor_lab';
				$data['error_string'][] = 'Minimal Honor adalah 0';
				$data['status'] = FALSE;
			}
		}

        return $data;
	}

}
