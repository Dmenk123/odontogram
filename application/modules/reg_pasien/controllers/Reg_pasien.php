<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reg_pasien extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') === false) {
			return redirect('login');
		}

		$this->load->model('master_user/m_user');
		$this->load->model('master_asuransi/m_asuransi');
		$this->load->model('m_global');
		$this->load->model('t_registrasi');
	}

	public function index()
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
			
		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Registrasi Pasien',
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
			'modal' => 'modal_data_reg',
			'js'	=> 'reg_pasien.js',
			'view'	=> 'view_data_reg'
		];

		$this->template_view->load_view($content, $data);
	}

	private function umur_dan_pemetaan($tanggal_lahir, $flag_cari = 'umur')
	{
		$tgl_lhr = new DateTime($tanggal_lahir);
		$skrg  = new DateTime('today');
		$umur = $tgl_lhr->diff($skrg)->y;
		
		if($flag_cari == 'umur') {
			$retval = $umur;
		}else{
			$data = $this->m_global->single_row('*', ['umur_awal <=' => $umur, 'umur_akhir >=' => $umur], 'm_pemetaan');
			$retval = $data->id;
		}

		return $retval;
	}

	public function get_select_pasien()
	{
		$term = $this->input->get('term');
		$data_pasien = $this->m_global->multi_row('*', ['deleted_at' => null, 'is_aktif' => '1', 'nama like' => '%'.$term.'%'], 'm_pasien', null, 'no_rm');
		if($data_pasien) {
			foreach ($data_pasien as $key => $value) {
				$row['id'] = $value->id;
				$row['text'] = '['.$value->no_rm.' - '.$value->nik.'] '.$value->nama;
				$row['nik'] = $value->nik;
				$row['no_rm'] = $value->no_rm;
				$row['tanggal_lahir'] = $value->tanggal_lahir;
				$row['tempat_lahir'] = $value->tempat_lahir;
				$row['umur'] = $this->umur_dan_pemetaan($value->tanggal_lahir, 'umur');
				$row['pemetaan'] = $this->umur_dan_pemetaan($value->tanggal_lahir, 'pemetaan');
				$retval[] = $row;
			}
		}else{
			$retval = false;
		}
		echo json_encode($retval);
	}

	public function get_select_dokter()
	{
		$term = $this->input->get('term');
		$id_jabatan = 1; // jabatan dokter
		$data_pasien = $this->m_global->multi_row('*', ['deleted_at' => null, 'is_aktif' => '1', 'nama like' => '%'.$term.'%', 'id_jabatan' => $id_jabatan], 'm_pegawai', null, 'nama');
		if($data_pasien) {
			foreach ($data_pasien as $key => $value) {
				$row['id'] = $value->id;
				$row['text'] = '['.$value->kode.'] '.$value->nama;
				$retval[] = $row;
			}
		}else{
			$retval = false;
		}
		echo json_encode($retval);
	}

	public function get_data_form_penjamin()
	{
		$jenis = $this->input->post('jenis_penjamin');
		$data_asuransi = $this->m_global->multi_row('*', ['deleted_at' => null], 'm_asuransi', null, 'nama');
		if($jenis == '1') {
			$html = '
				<div class="form-group row form-group-marginless kt-margin-t-20">
					<label class="col-lg-2 col-form-label">Asuransi:</label>
					<div class=" col-lg-6">
					<select class="form-control kt-select2" id="asuransi" name="asuransi">
						<option value="">Silahkan Pilih Nama Asuransi</option>
					</select>
					<span class="help-block"></span>
					</div>
					<div class="col-lg-2">
						<button type="button" class="btn btn-sm btn-success" onclick="tambah_data_asuransi()">
							<i class="la la-plus"></i> Tambah data Asuransi
						</button>
					</div>
				</div>
				<div><br /></div>
				<div class="form-group row form-group-marginless kt-margin-t-20">
					<label class="col-lg-2 col-form-label">No. Asuransi:</label>
					<div class=" col-lg-8">
					<input type="text" class="form-control" id="no_asuransi" name="no_asuransi" autocomplete="off" value="">
					<span class="help-block"></span>
					</div>
				</div>
			';
		}else{
			$html = '';
		}

		echo json_encode($html);
	}

	public function add()
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
		$pemetaan = $this->m_global->multi_row('*', ['deleted_at' => null], 'm_pemetaan', null, 'umur_awal');
			
		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Tambah data Registrasi',
			'data_user' => $data_user,
			'data_pemetaan' => $pemetaan
		);

		/**
		 * content data untuk template
		 * param (css : link css pada direktori assets/css_module)
		 * param (modal : modal komponen pada modules/nama_modul/views/nama_modal)
		 * param (js : link js pada direktori assets/js_module)
		 */
		$content = [
			'css' 	=> null,
			'modal' => 'modal_data_reg',
			'js'	=> 'reg_pasien.js',
			'view'	=> 'form_data_reg'
		];

		$this->template_view->load_view($content, $data);
	}

	public function edit($enc_id)
	{
		if(strlen($enc_id) != 32) {
			return redirect(base_url($this->uri->segment(1)));
		}

		$this->load->library('Enkripsi');
		$id = $this->enkripsi->enc_dec('decrypt', $enc_id);
		
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);

		$pemetaan = $this->m_global->multi_row('*', ['deleted_at' => null], 'm_pemetaan', null, 'umur_awal');

		$select = "reg.id, reg.id_pasien, reg.id_pegawai, reg.no_reg, reg.tanggal_reg, reg.jam_reg, reg.tanggal_pulang, reg.jam_pulang, reg.is_pulang, reg.is_asuransi, reg.id_asuransi, reg.umur, reg.no_asuransi, reg.id_pemetaan, psn.nama as nama_pasien, psn.no_rm, psn.tanggal_lahir, psn.tempat_lahir, psn.nik, psn.jenis_kelamin, peg.kode as kode_dokter, peg.nama as nama_dokter, asu.nama as nama_asuransi, asu.keterangan, pem.keterangan, CASE WHEN reg.is_asuransi = 1 THEN 'Asuransi' ELSE 'Umum' END as penjamin, CASE WHEN psn.jenis_kelamin = 'L' THEN 'Laki-Laki' ELSE 'Perempuan' END as jenkel";
		$where = ['reg.deleted_at is null' => null, 'reg.id' => $id];
		$table = 't_registrasi as reg';
		$join = [ 
			['table' => 'm_pasien as psn', 'on'	=> 'reg.id_pasien = psn.id'],
			['table' => 'm_pegawai as peg', 'on'=> 'reg.id_pegawai = peg.id'],
			['table' => 'm_asuransi as asu', 'on' => 'reg.id_asuransi = asu.id'],
			['table' => 'm_pemetaan as pem', 'on' => 'reg.id_pemetaan = pem.id']
		];
		$data_reg = $this->m_global->single_row($select,$where,$table, $join);
		
		if(!$data_reg) {
			return redirect(base_url($this->uri->segment(1)));
		}

		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Edit Data Registrasi',
			'data_user' => $data_user,
			'data_reg' => $data_reg,
			'data_pemetaan' => $pemetaan
		);
		

		/**
		 * content data untuk template
		 * param (css : link css pada direktori assets/css_module)
		 * param (modal : modal komponen pada modules/nama_modul/views/nama_modal)
		 * param (js : link js pada direktori assets/js_module)
		 */
		$content = [
			'css' 	=> null,
			'modal' => 'modal_data_reg',
			'js'	=> 'reg_pasien.js',
			'view'	=> 'form_data_reg'
		];

		$this->template_view->load_view($content, $data);
	}

	public function cek_penjamin()
	{
		$id_reg = $this->input->post('id_reg');
		$select = "reg.*, asu.nama as nama_asuransi, asu.keterangan";
		$where = ['reg.deleted_at is null' => null, 'reg.id' => $id_reg];
		$table = 't_registrasi as reg';
		$join = [ 
			['table' => 'm_asuransi as asu', 'on' => 'reg.id_asuransi = asu.id']
		];

		$data_reg = $this->m_global->single_row($select,$where,$table, $join);
		if($data_reg) {
			$retval = [
				'status' => true,
				'data' => $data_reg
			];
		}else{
			$retval = [
				'status' => false,
				'data' => $data_reg
			];
		}

		echo json_encode($retval);
	}

	public function simpan_data()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		
		if($this->input->post('asuransi') !== null){
			$flag_asuransi = true;
			$id_asuransi = $this->input->post('asuransi');
			$no_asuransi = $this->input->post('no_asuransi');
		}else{
			$flag_asuransi = false;
			$id_asuransi = null;
			$no_asuransi = null;
		}

		$arr_valid = $this->rule_validasi($flag_asuransi);
		
		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}

		$id_pasien = $this->input->post('nama');
		$tanggal_reg = contul($this->input->post('tanggal_reg'));
		$jam_reg = contul($this->input->post('jam_reg'));
		$id_pegawai = contul($this->input->post('dokter'));
		$is_asuransi = ($flag_asuransi) ? 1 : null;
		$umur = contul(trim($this->input->post('umur_reg')));
		$id_pemetaan = contul($this->input->post('pemetaan'));

		$this->db->trans_begin();
		
		$registrasi = [
			'id_pasien' => $id_pasien,
			'tanggal_reg' => $obj_date->createFromFormat('d/m/Y', $tanggal_reg)->format('Y-m-d'),
			'jam_reg' => $jam_reg,
			'id_pegawai' => $id_pegawai,
			'is_asuransi' => $is_asuransi,
			'id_asuransi' => $id_asuransi,
			'no_asuransi' => $no_asuransi,
			'umur' => $umur,
			'id_pemetaan' => $id_pemetaan
		];

		if($this->input->post('id_reg') != '') {
			###update
			$registrasi['updated_at'] = $timestamp;
			$where = ['id' => $this->input->post('id_reg')];
			$update = $this->t_registrasi->update($where, $registrasi);
			$pesan = 'Sukses Mengupdate data Registrasi';
		}else{
			###insert
			$registrasi['id'] = $this->t_registrasi->get_max_id();
			$registrasi['no_reg'] = $this->t_registrasi->get_kode_reg();
			$registrasi['created_at'] = $timestamp;
			$insert = $this->t_registrasi->save($registrasi);
			$pesan = 'Sukses Menambah data Registrasi';
		}
				
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['pesan'] = 'Gagal memproses Data Registrasi';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['pesan'] = $pesan;
		}

		echo json_encode($retval);
	}

	public function list_data()
	{
		$tgl_awal = contul(DateTime::createFromFormat('d/m/Y', $this->input->post('tgl_awal'))->format('Y-m-d'));
		$tgl_akhir = contul(DateTime::createFromFormat('d/m/Y', $this->input->post('tgl_akhir'))->format('Y-m-d'));
		
		$this->load->library('Enkripsi');
		$list = $this->t_registrasi->get_datatable($tgl_awal, $tgl_akhir);

		// echo "<pre>";
		// print_r ($list);
		// echo "</pre>";
		// exit;

		$data = array();
		// $no =$_POST['start'];
		foreach ($list as $val) {
			// $no++;
			$row = array();
			//loop value tabel db
			// $row[] = $no;
			$row[] = $val->no_reg;
			$row[] = $val->nama_pasien;
			$row[] = DateTime::createFromFormat('Y-m-d', $val->tanggal_reg)->format('d/m/Y');
			$row[] = $val->jam_reg;
			$row[] = ($val->is_pulang == '1') ? 'Pulang' : '-';
			$row[] = ($val->tanggal_pulang) ? DateTime::createFromFormat('Y-m-d', $val->tanggal_pulang)->format('d/m/Y') : '-';
			$row[] = $val->jam_pulang;
			$row[] = $val->no_rm;
			$row[] = $val->tempat_lahir;
			$row[] = DateTime::createFromFormat('Y-m-d', $val->tanggal_lahir)->format('d/m/Y');
			$row[] = $val->nik;
			$row[] = $val->jenkel;
			$row[] = $val->nama_dokter;
			$row[] = $val->penjamin;
			$row[] = $val->nama_asuransi;
			$row[] = $val->no_asuransi;
			$row[] = $val->umur;
			$row[] = $val->keterangan;
			
			$str_aksi = '
				<div class="btn-group">
					<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Opsi</button>
					<div class="dropdown-menu">
						<button class="dropdown-item" onclick="detail_reg(\''.$this->enkripsi->enc_dec('encrypt', $val->id).'\')">
							<i class="la la-search"></i> Detail Registrasi
						</button>
						<a class="dropdown-item" href="'.base_url('reg_pasien/edit/').$this->enkripsi->enc_dec('encrypt', $val->id).'"">
							<i class="la la-pencil"></i> Edit Registrasi
						</a>
						<button class="dropdown-item" onclick="delete_reg(\''.$this->enkripsi->enc_dec('encrypt', $val->id).'\')">
							<i class="la la-trash"></i> Hapus
						</button>
						<a class="dropdown-item" target="_blank" href="'.base_url('reg_pasien/cetak_data_individu/').$this->enkripsi->enc_dec('encrypt', $val->id).'">
							<i class="la la-print"></i> Cetak Data Ini
						</a>
					</div>
				</div>
			';

			$row[] = $str_aksi;

			$data[] = $row;
		}//end loop

		$output = [
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->t_registrasi->count_all(),
			"recordsFiltered" => $this->t_registrasi->count_filtered($tgl_awal, $tgl_akhir),
			"data" => $data
		];
		
		echo json_encode($output);
	}	












	/////////////////////////////////

	
	public function detail_pasien()
	{
		$enc_id = $this->input->post('id');
		
		if(strlen($enc_id) != 32) {
			echo json_encode([
				'status' => false,
				'pesan' => 'Data Tidak Valid'
			]);
			return;
		}

		$this->load->library('Enkripsi');
		$id_pasien = $this->enkripsi->enc_dec('decrypt', $enc_id);

		$select = "pas.*, mdk.*, CASE WHEN pas.jenis_kelamin = 'L' THEN 'Laki-Laki' ELSE 'Perempuan' END as jenkel";
		$where = ['pas.deleted_at' => null, 'pas.id' => $id_pasien];
		$table = 't_registrasi as pas';
		$join = [ 
			[
				'table' => 'm_data_medik as mdk',
				'on'	=> 'pas.id = mdk.id_pasien'
			]
		];
		$data_pasien = $this->m_global->single_row($select,$where,$table, $join);
		
		if(!$data_pasien) {
			echo json_encode([
				'status' => false,
				'pesan' => 'Data Pasien Tidak Ditemukan'
			]);
			return;
		}

		$data = array(
			'status' => true,
			'old_data' => $data_pasien
		);

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
		
		if(strlen($enc_id) != 32) {
			echo json_encode([
				'status' => false,
				'pesan' => 'Data Tidak Valid'
			]);
			return;
		}

		$id_pasien = $this->enkripsi->enc_dec('decrypt', $enc_id);
		$del = $this->t_registrasi->softdelete_by_id($id_pasien);
		if($del) {
			$retval['status'] = TRUE;
			$retval['pesan'] = 'Data Pasien Sukses dihapus';
		}else{
			$retval['status'] = FALSE;
			$retval['pesan'] = 'Data Pasien Gagal dihapus';
		}

		echo json_encode($retval);
	}

	public function edit_status_aktif()
	{
		$this->load->library('Enkripsi');
		$enc_id = $this->input->post('id');
		
		if(strlen($enc_id) != 32) {
			echo json_encode([
				'status' => false,
				'pesan' => 'Data Tidak Valid'
			]);
			return;
		}

		$id_pasien = $this->enkripsi->enc_dec('decrypt', $enc_id);
		$input_status = $this->input->post('status');
		// jika aktif maka di set ke nonaktif / "0"
		$status = ($input_status == "aktif") ? $status = 0 : $status = 1;
			
		$input = array('is_aktif' => $status);

		$where = ['id' => $id_pasien];

		$this->t_registrasi->update($where, $input);

		if ($this->db->affected_rows() == '1') {
			$data = array(
				'status' => TRUE,
				'pesan' => "Status Pasien berhasil di ubah.",
			);
		}else{
			$data = array(
				'status' => FALSE
			);
		}

		echo json_encode($data);
	}

	public function template_excel()
	{
		$file_url = base_url().'files/template_dokumen/template_data_pasien.xlsx';
		header('Content-Type: application/octet-stream');
		header("Content-Transfer-Encoding: Binary"); 
		header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
		readfile($file_url); 
	}

	public function export_excel()
	{
		$select = "pas.*, mdk.*, CASE WHEN pas.jenis_kelamin = 'L' THEN 'Laki-Laki' ELSE 'Perempuan' END as jenkel, CASE WHEN is_aktif = 1 THEN 'Aktif' ELSE 'Non Aktif' END as status_pasien";
		$where = ['pas.deleted_at' => null];
		$table = 't_registrasi as pas';
		$join = [ 
			[
				'table' => 'm_data_medik as mdk',
				'on'	=> 'pas.id = mdk.id_pasien'
			]
		];
		$data = $this->m_global->multi_row($select,$where,$table,$join);
		if($data) {
			$counter = count($data)+1;
		}else{
			$counter = 1;
		}

		$spreadsheet = $this->excel->spreadsheet_obj();
		$writer = $this->excel->xlsx_obj($spreadsheet);
		$number_format_obj = $this->excel->number_format_obj();
		
		$spreadsheet
			->getActiveSheet()
			->getStyle('A1:AA'.$counter)
			->getNumberFormat()
			//format text masih ada bug di nip. jadi kacau
			//->setFormatCode($number_format_obj::FORMAT_TEXT);
			// solusi pake format custom
			->setFormatCode('#');
		
		$sheet = $spreadsheet->getActiveSheet();

		$sheet
			->setCellValue('A1', 'No RM')
			->setCellValue('B1', 'Nama')
			->setCellValue('C1', 'Tempat Lahir')
			->setCellValue('D1', 'Tgl Lahir')
			->setCellValue('E1', 'NIK')
			->setCellValue('F1', 'Jenis Kelamin')
			->setCellValue('G1', 'Suku')
			->setCellValue('H1', 'Pekerjaan')
			->setCellValue('I1', 'Alamat Rumah')
			->setCellValue('J1', 'Telp Rumah')
			->setCellValue('K1', 'Alamat Kantor')
			->setCellValue('L1', 'HP/WA')
			->setCellValue('M1', 'Status Pasien')
			->setCellValue('N1', 'Golongan Darah')
			->setCellValue('O1', 'Tekanan Darah')
			->setCellValue('P1', 'Nilai Tek Darah')
			->setCellValue('Q1', 'Penyakit Jantung')
			->setCellValue('R1', 'Diabetes')
			->setCellValue('S1', 'Haemopilia')
			->setCellValue('T1', 'Hepatitis')
			->setCellValue('U1', 'Gastring')
			->setCellValue('V1', 'Penyakit Lainnya')
			->setCellValue('W1', 'Alergi Obat')
			->setCellValue('X1', 'List Alergi Obat')
			->setCellValue('Y1', 'Alergi Makanan')
			->setCellValue('Z1', 'List Alergi Makanan');
					
		$startRow = 2;
		$row = $startRow;
		if($data){
			foreach ($data as $key => $val) {
				$sts = ($val->status = '1') ? 'Aktif' : 'Non Aktif';
				
				$sheet
					->setCellValue("A{$row}", $val->no_rm)
					->setCellValue("B{$row}", $val->nama)
					->setCellValue("C{$row}", $val->tempat_lahir)
					->setCellValue("D{$row}", DateTime::createFromFormat('Y-m-d', $val->tanggal_lahir)->format('d/m/Y'))
					->setCellValue("E{$row}", $val->nik)
					->setCellValue("F{$row}", $val->jenis_kelamin)
					->setCellValue("G{$row}", $val->suku)
					->setCellValue("H{$row}", $val->pekerjaan)
					->setCellValue("I{$row}", $val->alamat_rumah)
					->setCellValue("J{$row}", $val->telp_rumah)
					->setCellValue("K{$row}", $val->alamat_kantor)
					->setCellValue("L{$row}", $val->hp)
					->setCellValue("M{$row}", $val->status_pasien)
					->setCellValue("N{$row}", $val->gol_darah)
					->setCellValue("O{$row}", $val->tekanan_darah)
					->setCellValue("P{$row}", $val->tekanan_darah_val)
					->setCellValue("Q{$row}", ($val->penyakit_jantung == '1') ? 'Ya' : 'Tidak')
					->setCellValue("R{$row}", ($val->diabetes == '1') ? 'Ya' : 'Tidak')
					->setCellValue("S{$row}", ($val->haemopilia == '1') ? 'Ya' : 'Tidak')
					->setCellValue("T{$row}", ($val->hepatitis == '1') ? 'Ya' : 'Tidak')
					->setCellValue("U{$row}", ($val->gastring == '1') ? 'Ya' : 'Tidak')
					->setCellValue("V{$row}", ($val->penyakit_lainnya == '1') ? 'Ya' : 'Tidak')
					->setCellValue("W{$row}", ($val->alergi_obat == '1') ? 'Ya' : 'Tidak')
					->setCellValue("X{$row}", $val->alergi_obat_val)
					->setCellValue("Y{$row}", ($val->alergi_makanan == '1') ? 'Ya' : 'Tidak')
					->setCellValue("Z{$row}", $val->alergi_makanan_val);
				$row++;
			}

			$endRow = $row - 1;
		}
		
		
		$filename = 'data-pasien-'.time();
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
		
	}

	public function import_data()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$file_mimes = ['text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
		$retval = [];

		if(isset($_FILES['file_excel']['name']) && in_array($_FILES['file_excel']['type'], $file_mimes)) {
			$arr_file = explode('.', $_FILES['file_excel']['name']);
			$extension = end($arr_file);
			if('csv' == $extension){
				$reader = $this->excel->csv_reader_obj();
			} else {
				$reader = $this->excel->reader_obj();
			}

			$spreadsheet = $reader->load($_FILES['file_excel']['tmp_name']);
			$sheetData = $spreadsheet->getActiveSheet()->toArray();
			
			// echo "<pre>";
			// print_r ($sheetData);
			// echo "</pre>";
			// exit;

			for ($i=1; $i <count($sheetData); $i++) { 
				
				if ($sheetData[$i][0] == null || $sheetData[$i][1] == null) {
					if($i == 0) {
						$flag_kosongan = true;
						$status_import = false;
						$pesan = "Data Kosong...";
					}else{
						$flag_kosongan = false;
						$status_import = true;
						$pesan = "Data Sukses Di Import";
					}

					break;
				}

				$id_pasien = $this->t_registrasi->get_max_id_pasien();
				$pasien['id'] = $id_pasien;
				$pasien['no_rm'] = contul(strtoupper(strtolower(trim($sheetData[$i][0]))));
				$pasien['nama'] = contul(strtoupper(strtolower(trim($sheetData[$i][1]))));
				$pasien['tempat_lahir'] = contul(strtoupper(strtolower(trim($sheetData[$i][2]))));
				$pasien['tanggal_lahir'] = DateTime::createFromFormat('d-m-Y', trim($sheetData[$i][3]))->format('Y-m-d');
				$pasien['nik'] = contul(trim($sheetData[$i][4]));
				$pasien['jenis_kelamin'] = contul(strtoupper(strtolower(trim($sheetData[$i][5]))));
				$pasien['suku'] = contul(strtoupper(strtolower(trim($sheetData[$i][6]))));
				$pasien['pekerjaan'] = contul(strtoupper(strtolower(trim($sheetData[$i][7]))));
				$pasien['alamat_rumah'] = contul(strtoupper(strtolower(trim($sheetData[$i][8]))));
				$pasien['telp_rumah'] = contul(trim($sheetData[$i][9]));
				$pasien['alamat_kantor'] = contul(strtoupper(strtolower(trim($sheetData[$i][10]))));
				$pasien['hp'] = contul(trim($sheetData[$i][11]));
				$pasien['is_aktif'] = 1;
				$pasien['created_at'] = $timestamp;
				$data_pasien[] = $pasien;

				################# DATA MEDIK
				$medik['id_pasien'] = $id_pasien;
				$medik['gol_darah'] = contul(strtoupper(strtolower(trim($sheetData[$i][12]))));
				$medik['tekanan_darah'] = contul(strtoupper(strtolower(trim($sheetData[$i][13]))));
				$medik['tekanan_darah_val'] = contul(strtoupper(strtolower(trim($sheetData[$i][14]))));
				$medik['penyakit_jantung'] = contul(strtoupper(strtolower(trim($sheetData[$i][15]))));
				$medik['diabetes'] = contul(strtoupper(strtolower(trim($sheetData[$i][16]))));
				$medik['haemopilia'] = contul(strtoupper(strtolower(trim($sheetData[$i][17]))));
				$medik['hepatitis'] = contul(strtoupper(strtolower(trim($sheetData[$i][18]))));
				$medik['gastring'] = contul(strtoupper(strtolower(trim($sheetData[$i][19]))));
				$medik['penyakit_lainnya'] = contul(strtoupper(strtolower(trim($sheetData[$i][20]))));
				$medik['alergi_obat'] = contul(strtoupper(strtolower(trim($sheetData[$i][21]))));
				$medik['alergi_obat_val'] = contul(strtoupper(strtolower(trim($sheetData[$i][22]))));
				$medik['alergi_makanan'] = contul(strtoupper(strtolower(trim($sheetData[$i][23]))));
				$medik['alergi_makanan_val'] = contul(strtoupper(strtolower(trim($sheetData[$i][24]))));
				$medik['created_at'] = $timestamp;
				$data_medik[] = $medik;


				######## jika lancar sampai akhir beri flag sukses
				if($i == (count($sheetData) - 1)) {
					$flag_kosongan = false;
					$status_import = true;
					$pesan = "Data Sukses Di Import";
				}
			}

			if($status_import) {
				if(count($data_pasien) < 1) {
					echo json_encode([
						'status' => false,
						'pesan'	=> 'Import dibatalkan, Data Kosong...'
					]);

					return;
				}
				
				$this->db->trans_begin();
				
				#### truncate loh !!!!!!
				$this->m_data_medik->trun_data_medik();
				$this->t_registrasi->trun_data_pasien();
				
				foreach ($data_pasien as $key => $val) {
					$simpan = $this->t_registrasi->save($val);
				}

				foreach ($data_medik as $keys => $vals) {
					#### simpan
					$vals['id'] = $this->m_data_medik->get_max_id_medik();
					$simpan = $this->m_data_medik->save($vals);
				}

				if ($this->db->trans_status() === FALSE){
					$this->db->trans_rollback();
					$status = false;
					$pesan = 'Gagal melakukan Import, cek ulang dalam melakukan pengisian data excel';
				}else{
					$this->db->trans_commit();
					$status = true;
					$pesan = 'Sukses Import data Pasien';
				}

				echo json_encode([
					'status' => $status,
					'pesan'	=> $pesan
				]);
				
			}else{
				echo json_encode([
					'status' => false,
					'pesan'	=> $pesan
				]);
			}

		}else{
			echo json_encode([
				'status' => false,
				'pesan'	=> 'Terjadi Kesalahan dalam upload file. pastikan file adalah file excel .xlsx/.xls'
			]);
		}
	}

	public function cetak_data_individu($enc_id)
	{
		if(strlen($enc_id) != 32) {
			return redirect(base_url($this->uri->segment(1)));
		}

		$this->load->library('Enkripsi');
		$id_pasien = $this->enkripsi->enc_dec('decrypt', $enc_id);

		$select = "pas.*, mdk.*, CASE WHEN pas.jenis_kelamin = 'L' THEN 'Laki-Laki' ELSE 'Perempuan' END as jenkel";
		$where = ['pas.deleted_at' => null, 'pas.id' => $id_pasien];
		$table = 't_registrasi as pas';
		$join = [ 
			[
				'table' => 'm_data_medik as mdk',
				'on'	=> 'pas.id = mdk.id_pasien'
			]
		];

		$data = $this->m_global->single_row($select,$where,$table, $join);
		$data_klinik = $this->m_global->single_row('*', 'deleted_at is null', 'm_klinik');

		$retval = [
			'data' => $data,
			'data_klinik' => $data_klinik,
			'title' => 'Detail Data Pasien'
		];

		$this->load->view('pdf_individu', $retval);
		$html = $this->load->view('pdf_individu', $retval, true);
	    $filename = 'detail_pasien_'.$data->no_rm.'_'.time();
	    $this->lib_dompdf->generate($html, $filename, true, 'A4', 'potrait');
	}

	public function cetak_data()
	{
		$select = "pas.*, mdk.*, CASE WHEN pas.jenis_kelamin = 'L' THEN 'Laki-Laki' ELSE 'Perempuan' END as jenkel";
		$where = ['pas.deleted_at' => null];
		$table = 't_registrasi as pas';
		$join = [ 
			[
				'table' => 'm_data_medik as mdk',
				'on'	=> 'pas.id = mdk.id_pasien'
			]
		];

		$data = $this->m_global->multi_row($select, $where, $table, $join, 'pas.no_rm');
		$data_klinik = $this->m_global->single_row('*', 'deleted_at is null', 'm_klinik');

		$retval = [
			'data' => $data,
			'title' => 'Data Pasien',
			'data_klinik' => $data_klinik
		];


		// $this->load->view('pdf', $retval);
		$html = $this->load->view('pdf', $retval, true);
	    $filename = 'data_pasien'.time();
	    $this->lib_dompdf->generate($html, $filename, true, 'legal', 'landscape');
	}

	// ===============================================
	private function rule_validasi($is_asuransi = FALSE)
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		
		if ($this->input->post('nama') == '') {
			$data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Wajib mengisi Nama';
			$data['status'] = FALSE;
			$data['is_select2'][] = TRUE;
		}

		if ($this->input->post('tanggal_reg') == '') {
			$data['inputerror'][] = 'tanggal_reg';
			$data['error_string'][] = 'Wajib Mengisi Tanggal';
			$data['status'] = FALSE;
			$data['is_select2'][] = FALSE;
		}
		
		if ($this->input->post('jam_reg') == '') {
			$data['inputerror'][] = 'jam_reg';
            $data['error_string'][] = 'Wajib Mengisi Pukul';
			$data['status'] = FALSE;
			$data['is_select2'][] = FALSE;
		}

		if ($this->input->post('pemetaan') == '') {
			$data['inputerror'][] = 'pemetaan';
            $data['error_string'][] = 'Wajib Mengisi Pemetaan';
            $data['status'] = FALSE;
		}

		if ($this->input->post('dokter') == '') {
			$data['inputerror'][] = 'dokter';
            $data['error_string'][] = 'Wajib Mengisi Dokter';
			$data['status'] = FALSE;
			$data['is_select2'][] = TRUE;
		}

		if ($this->input->post('umur_reg') == '') {
			$data['inputerror'][] = 'umur_reg';
            $data['error_string'][] = 'Wajib Mengisi Umur';
			$data['status'] = FALSE;
			$data['is_select2'][] = FALSE;
		}

		if($is_asuransi) {
			if ($this->input->post('asuransi') == '') {
				$data['inputerror'][] = 'asuransi';
				$data['error_string'][] = 'Wajib Mengisi Asuransi';
				$data['status'] = FALSE;
				$data['is_select2'][] = TRUE;
			}
			
			if ($this->input->post('no_asuransi') == '') {
				$data['inputerror'][] = 'no_asuransi';
				$data['error_string'][] = 'Wajib Mengisi Nomor Asuransi';
				$data['status'] = FALSE;
				$data['is_select2'][] = FALSE;
			}
		}

        return $data;
	}
}
