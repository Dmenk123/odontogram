<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Carbon\Carbon;

class Rekam_medik extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') === false) {
			return redirect('login');
		}

		$this->load->model('m_user');
		$this->load->model('m_global');
		$this->load->model('m_pasien');
		$this->load->model('m_data_medik');
		$this->load->model('t_rekam_medik');
		$this->load->library('enkripsi');
	}

	public function index()
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
			
		/**
		 * data passing ke halaman view content
		 */

		$id_reg = $this->input->get('pid');
		$id_reg = $this->enkripsi->enc_dec('decrypt', $id_reg);
		$datareg = $this->m_global->single_row('*', ['id' => $id_reg, 'deleted_at' => null], 't_registrasi');
		
		if($datareg && $datareg->is_pulang) {
			$is_pulang = true;
		}else{
			$is_pulang = false;

		}

		$data = array(
			'title' => 'Data Rekam Medik',
			'data_user' => $data_user,
			'is_pulang' => $is_pulang,
			'datareg' => $datareg
		);

		/**
		 * content data untuk template
		 * param (css : link css pada direktori assets/css_module)
		 * param (modal : modal komponen pada modules/nama_modul/views/nama_modal)
		 * param (js : link js pada direktori assets/js_module)
		 */
		$content = [
			'css' 	=> null,
			'modal' => ['modal_pilih_pasien', 'modal_anamnesa','modal_diagnosa','modal_odonto','modal_tindakan', 'modal_logistik', 'modal_tindakan_lab', 'modal_pasien', 'modal_kamera'],
			'js'	=> ['rekam_medik.js', 'anamnesa.js', 't_diagnosa.js', 'odonto.js','t_tindakan.js','t_logistik.js', 't_tindakanlab.js', 't_kamera.js', 't_data_pasien.js'],
			'view'	=> 'view_rekam_medik'
		];

		$this->template_view->load_view($content, $data);
	}

	public function cari_pasien()
	{
		$this->load->library('Enkripsi');
		$tgl_filter_akhir = DateTime::createFromFormat('d/m/Y', $this->input->post('tgl_filter_akhir'))->format('Y-m-d');
		$tgl_filter_mulai = DateTime::createFromFormat('d/m/Y', $this->input->post('tgl_filter_mulai'))->format('Y-m-d');
		$pilih_nama = $this->input->post('pilih_nama');
		$pilih_norm = $this->input->post('pilih_norm');
		
		$select = "reg.*, reg.no_asuransi, pas.no_rm, pas.nama as nama_pasien";
		$where = [
			'reg.deleted_at' => null,
			'pas.is_aktif' => '1',
			'pas.nama like' => '%'.$pilih_nama.'%',
			'pas.no_rm like' => '%'.$pilih_norm.'%',
			'reg.tanggal_reg >=' => $tgl_filter_mulai,
			'reg.tanggal_reg <=' => $tgl_filter_akhir
		];
		$table = 't_registrasi as reg';
		$join = [ 
			['table' => 'm_pasien as pas', 'on' => 'reg.id_pasien = pas.id']
		];
				
		// var_dump($join);exit;
		$data = $this->m_global->multi_row($select, $where, $table, $join, 'pas.nama asc');
		$html = '';
		if($data){
			$status = true;
			foreach ($data as $key => $value) {
				$html .= '<tr>';
				$html .= '<td>'.$value->no_reg.'</td>';
				$html .= '<td>'.$value->nama_pasien.'</td>';
				$html .= '<td>'.DateTime::createFromFormat('Y-m-d', $value->tanggal_reg)->format('d/m/Y').'</td>';
				$html .= '<td>'.$value->jam_reg.'</td>';
				$html .= '<td>'.$value->no_rm.'</td>';
				$html .= '<td>'.$value->is_pulang.'</td>';
				$html .= '<td>'.$value->no_asuransi.'</td>';
				// $html .= '<td><button type="button" class="button btn-sm btn-success" onclick="pilih_pasien(\''.$this->enkripsi->enc_dec('encrypt', $value->id).'\')"> Pilih</button></td>';
				$html .= '<td><button type="button" class="button btn-sm btn-success" onclick="submit_pasien(\''.$this->enkripsi->enc_dec('encrypt', $value->id).'\')"> Pilih</button></td>';
				$html .= '</tr>';
			}
		}else{
			$status = false;
			$html .= '';
		}
		
		echo json_encode([
			'data' => $html,
			'status' => $status
		]);
	}

	public function hasil_pilih_pasien(){
		$this->load->library('Enkripsi');
		$enc_id = $this->input->post('enc_id');
		$id = $this->enkripsi->enc_dec('decrypt', $enc_id);
		$select = "reg.*, reg.no_asuransi, pas.no_rm, pas.nama as nama_pasien, peg.nama as nama_dokter, asu.nama as nama_asuransi";
		$where = ['reg.id' => $id];
		$table = 't_registrasi as reg';
		$join = [ 
			['table' => 'm_pasien as pas', 'on' => 'reg.id_pasien = pas.id'],
			['table' => 'm_pegawai as peg', 'on' => 'reg.id_pegawai = peg.id'],
			['table' => 'm_asuransi as asu', 'on' => 'reg.id_asuransi = asu.id and reg.is_asuransi is not null']
		];
				
		$data = $this->m_global->single_row($select, $where, $table, $join);
		$html = '';
		
		if($data){
			$status = true;
			$html .= '<tr>';
			$html .= '<td>'.$data->no_reg.'</td>';
			$html .= '<td>'.DateTime::createFromFormat('Y-m-d', $data->tanggal_reg)->format('d/m/Y').' '.$data->jam_reg.'</td>';
			$html .= '<td>'.$data->nama_pasien.'</td>';
			$html .= '<td>'.$data->nama_dokter.'</td>';
			$html .= '<td>'.$data->no_rm.'</td>';
			$html .= ($data->is_asuransi) ? '<td>Asuransi</td>' : '<td>Umum</td>';
			$html .= '<td>'.$data->nama_asuransi.'</td>';
			$html .= '</tr>';
			
		}else{
			$status = false;
			$html .= '';
		}

		$data_id = [
			'id_reg' => $data->id,
			'id_psn' => $data->id_pasien,
			'id_peg' => $data->id_pegawai,
		];
		
		echo json_encode([
			'data' => $html,
			'status' => $status,
			'data_id' => $data_id
		]);
		
	}

	public function get_old_data()
	{
		$id_peg = $this->input->post('id_peg');
		$id_psn = $this->input->post('id_psn');
		$id_reg = $this->input->post('id_reg');
		$menu = $this->input->post('menu');
		 
		switch ($menu) {
			case 'anamnesa':
				$select = "*";
				$where = ['id_reg' => $id_reg, 'id_pasien' => $id_psn, 'id_pegawai' => $id_peg];
				$table = 't_perawatan';
				$datanya = $this->m_global->single_row($select,$where,$table);
				
				echo json_encode(['data'=>$datanya, 'status' => true, 'menu' => 'anamnesa']);
				break;

			case 'diagnosa':
				echo json_encode(['menu' => 'diagnosa']);
				break;
			
			case 'tindakan':
				echo json_encode(['menu' => 'tindakan']);
				break;

			case 'logistik':
				echo json_encode(['menu' => 'logistik']);
				break;

			case 'kamera':
				echo json_encode(['menu' => 'kamera']);
				break;

			case 'tindakanlab':
				echo json_encode(['menu' => 'tindakanlab']);
				break;
			
			case 'diskon':
				echo json_encode(['menu' => 'diskon']);
				break;
			case 'odonto':
				echo json_encode(['menu' => 'odonto']);
				break;
			case 'pasien':
				$select = "pas.*, mdk.*";
				$where = ['pas.deleted_at' => null, 'pas.id' => $id_psn];
				$table = 'm_pasien as pas';
				$join = [ 
					[
						'table' => 'm_data_medik as mdk',
						'on'	=> 'pas.id = mdk.id_pasien'
					]
				];
				$data_pasien = $this->m_global->single_row($select,$where,$table, $join);

				echo json_encode(['menu' => 'pasien', 'data' => $data_pasien]);
				break;
			
			default:
				$datanya = null;
				echo json_encode(['data'=> null, 'status' => false, 'menu' => false]);
				break;
		}
	}

	########################### start anamnesa grup ###########################
	public function simpan_form_anamnesa()
	{

		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$datenow = $obj_date->format('Y-m-d');
		
		$this->db->trans_begin();
		$id_psn = $this->input->post('id_psn');
		$id_reg = $this->input->post('id_reg');
		$id_peg = $this->input->post('id_peg');
		$anamnesa = $this->input->post('txt_anamnesa');
		
		$data = [
			'id_pasien' => $id_psn,
			'id_pegawai' => $id_peg,
			'id_reg' => $id_reg,
			'anamnesa' => $anamnesa,
		];

		if($this->input->post('id_anamnesa') != '') {
			###update
			$data['updated_at'] = $timestamp;
			$where = ['id' => $this->input->post('id_anamnesa')];
			$update = $this->t_rekam_medik->update($where, $data, 't_perawatan');
			$pesan = 'Sukses Mengupdate data Perawatan';
		}else{
			###insert
			$data['id'] = $this->t_rekam_medik->get_max_id_perawatan();
			$data['tanggal'] = $datenow;
			$data['created_at'] = $timestamp;
			
			$insert = $this->t_rekam_medik->save($data, 't_perawatan');
			$pesan = 'Sukses Menambah data Perawatan';
		}
				
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['pesan'] = 'Gagal memproses Data Perawatan';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['pesan'] = $pesan;
		}

		echo json_encode($retval);
	}

	public function cetak_anamnesa()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$datenow = $obj_date->format('Y-m-d');
		$enc_id = $this->input->get('pid');
		$id_reg = $this->enkripsi->enc_dec('decrypt', $enc_id);

		$select = "reg.*, reg.no_asuransi, pas.no_rm, pas.nama as nama_pasien, pas.tempat_lahir, pas.tanggal_lahir, pas.jenis_kelamin, peg.nama as nama_dokter, asu.nama as nama_asuransi";
		$where = ['reg.id' => $id_reg];
		$table = 't_registrasi as reg';
		$join = [ 
			['table' => 'm_pasien as pas', 'on' => 'reg.id_pasien = pas.id'],
			['table' => 'm_pegawai as peg', 'on' => 'reg.id_pegawai = peg.id'],
			['table' => 'm_asuransi as asu', 'on' => 'reg.id_asuransi = asu.id and reg.is_asuransi is not null']
		];
				
		$datareg = $this->m_global->single_row($select, $where, $table, $join);
		
		$datanya = $this->m_global->single_row('*', ['id_reg' => $id_reg], 't_perawatan');
		
		$data_klinik = $this->m_global->single_row('*', ['deleted_at' => null, 'id' => $datareg->id_klinik], 'm_klinik');

		$konten_html = $this->load->view('pdf_anamnesa', ['data_reg'=>$datareg, 'datanya' => $datanya], true);
		
		// var_dump($konten_html);exit;
		$retval = [
			'data' => $datanya,
			'data_reg' => $datareg,
			'data_klinik' => $data_klinik,
			'content' => $konten_html,
			'title' => 'Data Anamnesa'
		];

		//$this->load->view('template/pdf', $retval, true);		
		$html = $this->load->view('template/pdf', $retval, true);
	    $filename = $retval['title'].'_'.time();
	    $this->lib_dompdf->generate($html, $filename, true, 'A4', 'potrait');
		
	}
	
	########################### end anamnesa grup ###########################



	///////////////////////////// start diagnosa grup ///////////////////////////////////
	public function simpan_form_diagnosa()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$datenow = $obj_date->format('Y-m-d');
		if($this->input->post('diagnosa') == '') {
			echo json_encode([
				'status'=> true,
				'pesan' => 'wajib memilih diagnosa'
			]);
			return;
		}

		$this->db->trans_begin();
		$id_psn = $this->input->post('id_psn');
		$id_reg = $this->input->post('id_reg');
		$id_peg = $this->input->post('id_peg');
		$id_diagnosa = $this->input->post('diagnosa');
		$gigi = $this->input->post('gigi');
		
		//cek sudah ada data / tidak
		$data_diagnosa = $this->m_global->single_row('*', ['id_reg' => $id_reg, 'id_pasien' => $id_psn, 'id_pegawai' => $id_peg], 't_diagnosa');
		if(!$data_diagnosa){
			###insert
			$data = [
				'id_pasien' => $id_psn,
				'id_pegawai' => $id_peg,
				'id_reg' => $id_reg,
				'id_user_adm' => $this->session->userdata('id_user'),
				'tanggal' => $datenow,
				'created_at' => $timestamp
			];
						
			$insert = $this->t_rekam_medik->save($data, 't_diagnosa');
			// $pesan = 'Sukses Menambah data Perawatan';
		}

		$cek_diagnosa = $this->m_global->single_row('id', ['id_reg' => $id_reg, 'id_pasien' => $id_psn, 'id_pegawai' => $id_peg], 't_diagnosa');
		$data_det = [
			'id_t_diagnosa' => $cek_diagnosa->id,
			'id_diagnosa' => $id_diagnosa,
			'gigi' => $gigi,
			'created_at' => $timestamp
		];

		$insert_det = $this->t_rekam_medik->save($data_det, 't_diagnosa_det');

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['pesan'] = 'Gagal Menambah Data';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['pesan'] = 'Sukses Menambah Data';
		}

		echo json_encode($retval);
	}

	public function simpan_form_kamera()
	{	
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$datenow = $obj_date->format('Y-m-d');
		$keterangan = $this->input->post('keterangan');
		$id_psn = $this->input->post('id_psn');
		$id_reg = $this->input->post('id_reg');
		$id_peg = $this->input->post('id_peg');
		if($this->input->post('keterangan') == '') {
			$retval['status'] = false;
			$retval['pesan'] = 'Wajib mengisi form keterangan !';
		}

		if(!empty($_FILES['fileselect']['name'])){

			$this->db->trans_begin();
			$random = rand();
			$nama_gambar = $_FILES['fileselect']['name'];
			$tmp = explode('.', $nama_gambar);
			$file_extension = end($tmp);
   			$newfilename = $id_reg."_".$random.".".$file_extension;
			$config['upload_path'] = 'upload/kamera/'; 
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['max_size'] = '1024'; // max_size in kb
			$config['file_name'] = $newfilename;
	   
			//Load upload library
			$this->load->library('upload',$config); 
	   
			// File upload
			if($this->upload->do_upload('fileselect')){
			  // Get data about the file
			  $uploadData = $this->upload->data();
			}

			//cek sudah ada data / tidak
			$data_kamera = $this->m_global->single_row('*', ['id_reg' => $id_reg, 'id_pasien' => $id_psn, 'id_pegawai' => $id_peg], 't_kamera');
			if(!$data_kamera){
				###insert
				$data = [
					'id_pasien' => $id_psn,
					'id_pegawai' => $id_peg,
					'id_reg' => $id_reg,
					'id_user_adm' => $this->session->userdata('id_user'),
					'tanggal' => $datenow,
					'created_at' => $timestamp
				];
							
				$insert = $this->t_rekam_medik->save($data, 't_kamera');
				// $pesan = 'Sukses Menambah data Perawatan';
			}

			$cek_kamera = $this->m_global->single_row('id', ['id_reg' => $id_reg, 'id_pasien' => $id_psn, 'id_pegawai' => $id_peg], 't_kamera');
			$data_det = [
				'id_t_kamera' => $cek_kamera->id,
				'keterangan'  => $keterangan,
				'nama_gambar' => $newfilename,
				'created_at'  => $timestamp
			];

			$insert_det = $this->t_rekam_medik->save($data_det, 't_kamera_det');

			if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				$retval['status'] = false;
				$retval['pesan'] = 'Gagal Menambah Data';
			}else{
				$this->db->trans_commit();
				$retval['status'] = true;
				$retval['pesan'] = 'Sukses Menambah Data';
			}
		}else{
			$retval['status'] = false;
			$retval['pesan'] = 'File Photo tidak dipilih !';
		}

		echo json_encode($retval);
	}

	public function load_form_diagnosa()
	{
		$id_psn = $this->input->post('id_psn');
		$id_reg = $this->input->post('id_reg');
		$id_peg = $this->input->post('id_peg');
		
		$select = "d.*,dt.id as id_diagnosa_det, dt.id_diagnosa, dt.gigi, md.kode_diagnosa, md.nama_diagnosa";
		$where = ['d.id_reg' => $id_reg, 'd.id_pasien' => $id_psn, 'd.id_pegawai' => $id_peg];
		$table = 't_diagnosa as d';
		$join = [ 
			['table' => 't_diagnosa_det as dt', 'on' => 'd.id = dt.id_t_diagnosa'],
			['table' => 'm_diagnosa as md', 'on' => 'dt.id_diagnosa = md.id_diagnosa']
		];

		$data = $this->m_global->multi_row($select, $where, $table, $join);
		$html = '';
		
		if($data){
			foreach ($data as $key => $value) {
				if($value->kode_diagnosa){
					$html .= '<tr><td>'.$value->gigi.'</td><td>'.$value->kode_diagnosa.'</td><td>'.$value->nama_diagnosa.'</td><td><button type="button" class="btn btn-sm btn-danger" onclick="hapus_diagnosa_det(\''.$value->id_diagnosa_det.'\')"><i class="la la-trash"></i></button></td></tr>';
				}
				
			}
		}

		echo json_encode([
			'html' => $html
		]);
	}

	public function load_form_pasien()
	{
		$id_psn = $this->input->post('id_psn');
		$id_reg = $this->input->post('id_reg');
		$id_peg = $this->input->post('id_peg');
		
		$select = "pas.*, mdk.*";
		$where = ['pas.deleted_at' => null, 'pas.id' => $id_psn];
		$table = 'm_pasien as pas';
		$join = [ 
			[
				'table' => 'm_data_medik as mdk',
				'on'	=> 'pas.id = mdk.id_pasien'
			]
		];
		$data_pasien = $this->m_global->single_row($select,$where,$table, $join);
		if ($data_pasien) {
			$tgl_lahir = date('d/m/Y', strtotime($data_pasien->tanggal_lahir));
		}else{
			$tgl_lahir = '';
		}

		echo json_encode([
			'old_data' => $data_pasien,
			'tgl_lahir' => $tgl_lahir
		]);
	}

	public function load_form_kamera()
	{
		$id_psn = $this->input->post('id_psn');
		$id_reg = $this->input->post('id_reg');
		$id_peg = $this->input->post('id_peg');
		
		$select = "k.*,dt.id as id_kamera_det, dt.keterangan, dt.nama_gambar";
		$where = ['k.id_reg' => $id_reg, 'k.id_pasien' => $id_psn, 'k.id_pegawai' => $id_peg];
		$table = 't_kamera as k';
		$join = [ 
			['table' => 't_kamera_det as dt', 'on' => 'k.id = dt.id_t_kamera']
		];

		$data = $this->m_global->multi_row($select, $where, $table, $join);
		$html = '';
		$no = 1;
		if($data){
			foreach ($data as $key => $value) {
				$i = $no++;
				
					$html .= '<tr><td>'.$i.'</td><td><img src='.base_url().'upload/kamera/'.$value->nama_gambar.' alt="tidak ditemukan" width="200"></td><td>'.$value->keterangan.'</td><td><button type="button" class="btn btn-sm btn-danger" onclick="hapus_kamera_det(\''.$value->id_kamera_det.'\')"><i class="la la-trash"></i></button></td></tr>';
				
				
			}
		}

		echo json_encode([
			'html' => $html
		]);
	}

	public function delete_data_diagnosa_det()
	{
		$id = $this->input->post('id');
		$hapus = $this->m_global->delete(['id' => $id], 't_diagnosa_det');
		if($hapus) {
			$data = [
				'status' => true,
				'pesan' => 'Berhasil Hapus Data',
			];
		}else{
			$data = [
				'status' => false,
				'pesan' => 'Gagal Hapus Data',
			];
		}

		echo json_encode($data);
	}

	public function delete_data_kamera_det()
	{
		$id = $this->input->post('id');
		$hapus = $this->m_global->delete(['id' => $id], 't_kamera_det');
		if($hapus) {
			$data = [
				'status' => true,
				'pesan' => 'Berhasil Hapus Data',
			];
		}else{
			$data = [
				'status' => false,
				'pesan' => 'Gagal Hapus Data',
			];
		}

		echo json_encode($data);
	}
	///////////////////////////// end diagnosa grup ///////////////////////////////////

	///////////////////// start tindakan grup ////////////////////
	public function simpan_form_tindakan()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$datenow = $obj_date->format('Y-m-d');
		if($this->input->post('tindakan') == '') {
			echo json_encode([
				'status'=> true,
				'pesan' => 'wajib memilih tindakan'
			]);
			return;
		}

		$this->db->trans_begin();
		$id_psn = $this->input->post('id_psn');
		$id_reg = $this->input->post('id_reg');
		$id_peg = $this->input->post('id_peg');
		$id_tindakan = $this->input->post('tindakan');
		$ket = $this->input->post('tdk_ket');
		$gigi = $this->input->post('tdk_gigi');
		$harga = $this->input->post('tdk_harga_raw');
		
		//cek sudah ada data / tidak
		$data = $this->m_global->single_row('*', ['id_reg' => $id_reg, 'id_pasien' => $id_psn, 'id_pegawai' => $id_peg], 't_tindakan');
		
		if(!$data){
			###insert
			$id = $this->m_global->get_max_id('id', 't_tindakan');
			$data = [
				'id' => $id,
				'id_pasien' => $id_psn,
				'id_pegawai' => $id_peg,
				'id_reg' => $id_reg,
				'id_user_adm' => $this->session->userdata('id_user'),
				'tanggal' => $datenow,
				'created_at' => $timestamp
			];
						
			$insert = $this->t_rekam_medik->save($data, 't_tindakan');

		}else{
			$data = [
				'id' => $data->id,
				'id_pasien' => $data->id_pasien,
				'id_pegawai' => $data->id_pegawai,
				'id_reg' => $data->id_reg,
				'id_user_adm' => $data->id_user_adm,
				'tanggal' => $data->tanggal,
				'created_at' => $data->created_at
			];
		}

		$cek_tindakan = $this->m_global->single_row('id', ['id_reg' => $id_reg, 'id_pasien' => $id_psn, 'id_pegawai' => $id_peg], 't_tindakan');
		$id_det = $this->m_global->get_max_id('id', 't_tindakan_det');
		$data_det = [
			'id' => $id_det,
			'id_t_tindakan' => $cek_tindakan->id,
			'id_tindakan' => $id_tindakan,
			'gigi' => $gigi,
			'harga' => (float)$harga,
			'keterangan' => $ket,
			'created_at' => $timestamp
		];

		$data_det_kirim[] = $data_det;

		$insert_det = $this->t_rekam_medik->save($data_det, 't_tindakan_det');

		// isi mutasi
		/**
		 * param 1 = id_registrasi
		 * param 2 kode jenis transaksi (lihat m_jenis_trans)
		 * param 3 data tabel transaksi (parent tabel)
		 * param 4 data tabel detail transaksi (child tabel)
		 * param 5 flag_transaksi (1 : penerimaan , 2 : pengeluaran)
		*/
		$mutasi = $this->lib_mutasi->simpan_mutasi($id_reg, '2', $data, $data_det_kirim, '1');

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['pesan'] = 'Gagal Menambah Data';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['pesan'] = 'Sukses Menambah Data';
		}

		echo json_encode($retval);
	}

	public function load_form_tindakan()
	{
		$id_psn = $this->input->post('id_psn');
		$id_reg = $this->input->post('id_reg');
		$id_peg = $this->input->post('id_peg');
		
		$select = "d.*, dt.id as id_tindakan_det, dt.id_tindakan, dt.gigi, dt.harga, dt.keterangan, mt.kode_tindakan, mt.nama_tindakan";
		$where = ['d.id_reg' => $id_reg, 'd.id_pasien' => $id_psn, 'd.id_pegawai' => $id_peg, 'dt.deleted_at' => null];
		$table = 't_tindakan as d';
		$join = [ 
			['table' => 't_tindakan_det as dt', 'on' => 'd.id = dt.id_t_tindakan'],
			['table' => 'm_tindakan as mt', 'on' => 'dt.id_tindakan = mt.id_tindakan']
		];

		$data = $this->m_global->multi_row($select, $where, $table, $join);
		$html = '';
		$harga = 0;
		if($data){
			foreach ($data as $key => $value) {
				if($value->kode_tindakan){
					$harga += (float)$value->harga;
					$html .= '<tr><td>'.$value->gigi.'</td><td>'.$value->kode_tindakan.'</td><td>'.$value->nama_tindakan.'</td><td>'.number_format($value->harga,0,',','.').'</td><td>'.$value->keterangan.'</td><td><button type="button" class="btn btn-sm btn-danger" onclick="hapus_tindakan_det(\''.$value->id_tindakan_det.'\')"><i class="la la-trash"></i></button></td></tr>';
				}				
			}
			$html .= '<tr><td colspan="3"><strong>Total Harga</strong></td><td colspan="3"><strong>'.number_format($harga,2,',','.').'</strong></td></tr>';
		}

		echo json_encode([
			'html' => $html
		]);
	}

	public function delete_data_tindakan_det()
	{
		$id = $this->input->post('id');
		$select = 't_tindakan_det.*, t_tindakan.id_reg, t_tindakan.id_pegawai';
		$join = [ 
			['table' => 't_tindakan', 'on' => 't_tindakan_det.id_t_tindakan = t_tindakan.id'],
		];
		$data_lawas = $this->m_global->single_row_array($select, ['t_tindakan_det.id' => $id], 't_tindakan_det', $join);
		
		$id_reg = $data_lawas['id_reg'];
		$id_trans_flag = $data_lawas['id_t_tindakan'];

		$this->db->trans_begin();
		$hapus = $this->m_global->softdelete(['id' => $id], 't_tindakan_det');
		
		if(!$hapus) {
			$data = [
				'status' => false,
				'pesan' => 'Gagal Menghapus Data',
			];
			echo json_encode($data);
			return;
		}else{
			
			$data_kirim[] = $data_lawas;
			/**
			 * param 1 = id_registrasi
			 * param 2 kode jenis transaksi (lihat m_jenis_trans)
			 * param 3 data tabel transaksi_detail (join)
			 * param 4 id_trans_flag (id_parent_tabel_transaksi)
			 * param 5 flag_transaksi (1 : penerimaan , 2 : pengeluaran)
			*/
			$mutasi = $this->lib_mutasi->delete_mutasi($id_reg, '2', $data_kirim, $id_trans_flag, '1');

			if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				$retval['status'] = false;
				$retval['pesan'] = 'Gagal Menghapus Data';
			}else{
				$this->db->trans_commit();
				$retval['status'] = true;
				$retval['pesan'] = 'Sukses Menghapus Data';
			}
		}

		echo json_encode($retval);
	}
	///////////////////// end tindakan grup ////////////////////

	///////////////////// start logistik grup ////////////////////
	public function simpan_form_logistik()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$datenow = $obj_date->format('Y-m-d');
		if($this->input->post('qty_obat') == '') {
			echo json_encode([
				'status'=> true,
				'pesan' => 'wajib Mengisi Qty'
			]);
			return;
		}

		$this->db->trans_begin();
		$id_psn = $this->input->post('id_psn');
		$id_reg = $this->input->post('id_reg');
		$id_peg = $this->input->post('id_peg');
		$logistik = $this->input->post('logistik');
		$qty_obat = $this->input->post('qty_obat');
		$ket_resep = $this->input->post('ket_resep');
		$harga_jual_raw = $this->input->post('harga_jual_raw');
		
		//cek sudah ada data / tidak
		$data = $this->m_global->single_row('*', ['id_reg' => $id_reg, 'id_pasien' => $id_psn, 'id_pegawai' => $id_peg], 't_logistik');
		
		if(!$data){
			###insert
			$id = $this->m_global->get_max_id('id', 't_tindakan');
			$data = [
				'id' => $id,
				'id_pasien' => $id_psn,
				'id_pegawai' => $id_peg,
				'id_reg' => $id_reg,
				'id_user_adm' => $this->session->userdata('id_user'),
				'tanggal' => $datenow,
				'created_at' => $timestamp,
				'keterangan_resep' => $ket_resep
			];
						
			$insert = $this->t_rekam_medik->save($data, 't_logistik');
		}else{
			$data = [
				'id' => $data->id,
				'id_pasien' => $id_psn,
				'id_pegawai' => $id_peg,
				'id_reg' => $id_reg,
				'id_user_adm' => $this->session->userdata('id_user'),
				'tanggal' => $datenow,
				'created_at' => $timestamp,
				'keterangan_resep' => $ket_resep
			];
		}

		$cek_logistik = $this->m_global->single_row('id', ['id_reg' => $id_reg, 'id_pasien' => $id_psn, 'id_pegawai' => $id_peg], 't_logistik');
		$id_det = $this->m_global->get_max_id('id', 't_logistik_det');
		$data_det = [
			'id' => $id_det,
			'id_t_logistik' => $cek_logistik->id,
			'id_logistik' => $logistik,
			'qty' => $qty_obat,
			'harga' => (float)$harga_jual_raw,
			'subtotal' => (float)$harga_jual_raw * (int)$qty_obat,
			'created_at' => $timestamp
		];

		$data_det_kirim[] = $data_det;

		$insert_det = $this->t_rekam_medik->save($data_det, 't_logistik_det');

		// isi mutasi
		/**
		 * param 1 = id_registrasi
		 * param 2 kode jenis transaksi (lihat m_jenis_trans)
		 * param 3 data tabel transaksi (parent tabel)
		 * param 4 data tabel detail transaksi (child tabel)
		 * param 5 flag_transaksi (1 : penerimaan , 2 : pengeluaran)
		*/
		$mutasi = $this->lib_mutasi->simpan_mutasi($id_reg, '1', $data, $data_det_kirim, '1');
		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['pesan'] = 'Gagal Menambah Data';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['pesan'] = 'Sukses Menambah Data';
		}

		echo json_encode($retval);
	}

	public function load_form_logistik()
	{
		// $this->lib_mutasi->simpan_mutasi(1, 1);
		$id_psn = $this->input->post('id_psn');
		$id_reg = $this->input->post('id_reg');
		$id_peg = $this->input->post('id_peg');
		
		$select = "tl.*, tld.id as id_logistik_det, tld.id_logistik, tld.qty, tld.harga, tld.subtotal, ml.kode_logistik, ml.nama_logistik, mjl.jenis as jenis_logistik";
		$where = ['tl.id_reg' => $id_reg, 'tl.id_pasien' => $id_psn, 'tl.id_pegawai' => $id_peg, 'tld.deleted_at' => null];
		$table = 't_logistik as tl';
		$join = [ 
			['table' => 't_logistik_det as tld', 'on' => 'tl.id = tld.id_t_logistik'],
			['table' => 'm_logistik as ml', 'on' => 'tld.id_logistik = ml.id_logistik'],
			['table' => 'm_jenis_logistik as mjl', 'on' => 'ml.id_jenis_logistik = mjl.jenis'],
		];

		$data = $this->m_global->multi_row($select, $where, $table, $join);
		$html = '';
		$grand_total = 0;
		if($data){
			foreach ($data as $key => $value) {
				if($value->kode_logistik){
					$grand_total += (float)$value->subtotal;
					$html .= '<tr><td>'.$value->nama_logistik.'</td><td>'.$value->qty.'</td><td>'.number_format($value->harga,0,',','.').'</td><td>'.$value->jenis_logistik.'</td><td>'.number_format($value->subtotal,0,',','.').'</td><td><button type="button" class="btn btn-sm btn-danger" onclick="hapus_logistik_det(\''.$value->id_logistik_det.'\')"><i class="la la-trash"></i></button></td></tr>';
				}				
			}
			$html .= '<tr><td colspan="3"><strong>Total Harga</strong></td><td colspan="3"><strong>'.number_format($grand_total,2,',','.').'</strong></td></tr>';
		}

		echo json_encode([
			'html' => $html
		]);
	}

	public function delete_data_logistik_det()
	{
		$id = $this->input->post('id');
		$select = 't_logistik_det.*, t_logistik.id_reg, t_logistik.id_pegawai';
		$join = [ 
			['table' => 't_logistik', 'on' => 't_logistik_det.id_t_logistik = t_logistik.id'],
		];
		$data_lawas = $this->m_global->single_row_array($select, ['t_logistik_det.id' => $id], 't_logistik_det', $join);
		
		$id_reg = $data_lawas['id_reg'];
		$id_trans_flag = $data_lawas['id_t_logistik'];

		$this->db->trans_begin();
		$hapus = $this->m_global->softdelete(['id' => $id], 't_logistik_det');
		
		if(!$hapus) {
			$data = [
				'status' => false,
				'pesan' => 'Gagal Menghapus Data',
			];
			echo json_encode($data);
			return;
		}else{
			
			$data_kirim[] = $data_lawas;
			/**
			 * param 1 = id_registrasi
			 * param 2 kode jenis transaksi (lihat m_jenis_trans)
			 * param 3 data tabel transaksi_detail (join)
			 * param 4 id_trans_flag (id_parent_tabel_transaksi)
			 * param 5 flag_transaksi (1 : penerimaan , 2 : pengeluaran)
			*/
			$mutasi = $this->lib_mutasi->delete_mutasi($id_reg, '1', $data_kirim, $id_trans_flag, '1');

			if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				$retval['status'] = false;
				$retval['pesan'] = 'Gagal Menghapus Data';
			}else{
				$this->db->trans_commit();
				$retval['status'] = true;
				$retval['pesan'] = 'Sukses Menghapus Data';
			}
		}

		echo json_encode($retval);
	}
	///////////////////// end logistik grup ////////////////////

	///////////////////// start tindakan lab grup ////////////////////
	public function simpan_form_tindakanlab()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$datenow = $obj_date->format('Y-m-d');
		if($this->input->post('tdklab_tindakan') == '') {
			echo json_encode([
				'status'=> true,
				'pesan' => 'wajib memilih tindakan Lab'
			]);
			return;
		}

		$this->db->trans_begin();
		$id_psn = $this->input->post('id_psn');
		$id_reg = $this->input->post('id_reg');
		$id_peg = $this->input->post('id_peg');
		$id_tindakanlab = $this->input->post('tindakanlab');
		$ket = $this->input->post('tdklab_ket');
		$harga = $this->input->post('tdklab_harga_raw');
		
		//cek sudah ada data / tidak
		$data = $this->m_global->single_row('*', ['id_reg' => $id_reg, 'id_pasien' => $id_psn, 'id_pegawai' => $id_peg], 't_tindakanlab');
		
		if(!$data){
			###insert
			$id = $this->m_global->get_max_id('id', 't_tindakanlab');
			$data = [
				'id' => $id,
				'id_pasien' => $id_psn,
				'id_pegawai' => $id_peg,
				'id_reg' => $id_reg,
				'id_user_adm' => $this->session->userdata('id_user'),
				'tanggal' => $datenow,
				'created_at' => $timestamp
			];
						
			$insert = $this->t_rekam_medik->save($data, 't_tindakanlab');

		}else{
			$data = [
				'id' => $data->id,
				'id_pasien' => $data->id_pasien,
				'id_pegawai' => $data->id_pegawai,
				'id_reg' => $data->id_reg,
				'id_user_adm' => $data->id_user_adm,
				'tanggal' => $data->tanggal,
				'created_at' => $data->created_at
			];
		}

		$cek_tindakan = $this->m_global->single_row('id', ['id_reg' => $id_reg, 'id_pasien' => $id_psn, 'id_pegawai' => $id_peg], 't_tindakanlab');

		$id_det = $this->m_global->get_max_id('id', 't_tindakanlab_det');
		$data_det = [
			'id' => $id_det,
			'id_t_tindakanlab' => $cek_tindakan->id,
			'id_tindakan_lab' => $id_tindakanlab,
			'harga' => (float)$harga,
			'keterangan' => $ket,
			'created_at' => $timestamp
		];

		$data_det_kirim[] = $data_det;

		$insert_det = $this->t_rekam_medik->save($data_det, 't_tindakanlab_det');

		// isi mutasi
		/**
		 * param 1 = id_registrasi
		 * param 2 kode jenis transaksi (lihat m_jenis_trans)
		 * param 3 data tabel transaksi (parent tabel)
		 * param 4 data tabel detail transaksi (child tabel)
		 * param 5 flag_transaksi (1 : penerimaan , 2 : pengeluaran)
		*/
		$mutasi = $this->lib_mutasi->simpan_mutasi($id_reg, '3', $data, $data_det_kirim, '1');

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['pesan'] = 'Gagal Menambah Data';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['pesan'] = 'Sukses Menambah Data';
		}

		echo json_encode($retval);
	}

	public function load_form_tindakanlab()
	{
		$id_psn = $this->input->post('id_psn');
		$id_reg = $this->input->post('id_reg');
		$id_peg = $this->input->post('id_peg');
		
		$select = "d.*, dt.id as id_tindakanlab_det, dt.id_tindakan_lab, dt.harga, dt.keterangan, ml.kode, ml.tindakan_lab";
		$where = ['d.id_reg' => $id_reg, 'd.id_pasien' => $id_psn, 'd.id_pegawai' => $id_peg, 'dt.deleted_at' => null];
		$table = 't_tindakanlab as d';
		$join = [ 
			['table' => 't_tindakanlab_det as dt', 'on' => 'd.id = dt.id_t_tindakanlab'],
			['table' => 'm_laboratorium as ml', 'on' => 'dt.id_tindakan_lab = ml.id_laboratorium']
		];

		$data = $this->m_global->multi_row($select, $where, $table, $join);
		$html = '';
		$harga = 0;
		if($data){
			foreach ($data as $key => $value) {
				if($value->kode){
					$harga += (float)$value->harga;
					$html .= '<tr><td>'.$value->kode.'</td><td>'.$value->tindakan_lab.'</td><td>'.number_format($value->harga,0,',','.').'</td><td>'.$value->keterangan.'</td><td><button type="button" class="btn btn-sm btn-danger" onclick="hapus_tindakanlab_det(\''.$value->id_tindakanlab_det.'\')"><i class="la la-trash"></i></button></td></tr>';
				}				
			}
			$html .= '<tr><td colspan="3"><strong>Total Harga</strong></td><td colspan="3"><strong>'.number_format($harga,2,',','.').'</strong></td></tr>';
		}

		echo json_encode([
			'html' => $html
		]);
	}

	public function delete_data_tindakanlab_det()
	{
		$id = $this->input->post('id');
		$select = 't_tindakanlab_det.*, t_tindakanlab.id_reg, t_tindakanlab.id_pegawai';
		$join = [ 
			['table' => 't_tindakanlab', 'on' => 't_tindakanlab_det.id_t_tindakanlab = t_tindakanlab.id'],
		];
		$data_lawas = $this->m_global->single_row_array($select, ['t_tindakanlab_det.id' => $id], 't_tindakanlab_det', $join);
		
		$id_reg = $data_lawas['id_reg'];
		$id_trans_flag = $data_lawas['id_t_tindakanlab'];

		$this->db->trans_begin();
		$hapus = $this->m_global->softdelete(['id' => $id], 't_tindakanlab_det');
		
		if(!$hapus) {
			$data = [
				'status' => false,
				'pesan' => 'Gagal Menghapus Data',
			];
			echo json_encode($data);
			return;
		}else{
			
			$data_kirim[] = $data_lawas;
			/**
			 * param 1 = id_registrasi
			 * param 2 kode jenis transaksi (lihat m_jenis_trans)
			 * param 3 data tabel transaksi_detail (join)
			 * param 4 id_trans_flag (id_parent_tabel_transaksi)
			 * param 5 flag_transaksi (1 : penerimaan , 2 : pengeluaran)
			*/
			$mutasi = $this->lib_mutasi->delete_mutasi($id_reg, '3', $data_kirim, $id_trans_flag, '1');

			if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				$retval['status'] = false;
				$retval['pesan'] = 'Gagal Menghapus Data';
			}else{
				$this->db->trans_commit();
				$retval['status'] = true;
				$retval['pesan'] = 'Sukses Menghapus Data';
			}
		}

		echo json_encode($retval);
	}
	///////////////////// end tindakan grup ////////////////////

	///////////////////////////////////////////////////////////////////

	public function export_excel()
	{
		$tgl_awal = $this->input->get('tgl_awal');
		$tgl_akhir = $this->input->get('tgl_akhir');

		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$tgl_awal_fix = $obj_date->createFromFormat('d/m/Y', $tgl_awal)->format('Y-m-d');
		$tgl_akhir_fix = $obj_date->createFromFormat('d/m/Y', $tgl_akhir)->format('Y-m-d');

		// var_dump($tgl_awal, $tgl_akhir);
		$data = $this->t_registrasi->get_data_ekspor($tgl_awal_fix,$tgl_akhir_fix);
		
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
			->setCellValue('A1', 'No Reg')
			->setCellValue('B1', 'Nama')
			->setCellValue('C1', 'Tgl Masuk')
			->setCellValue('D1', 'Pukul Masuk')
			->setCellValue('E1', 'Pulang')
			->setCellValue('F1', 'Tgl Keluar')
			->setCellValue('G1', 'Pkl Keluar')
			->setCellValue('H1', 'No RM')
			->setCellValue('I1', 'Tempat Lahir')
			->setCellValue('J1', 'Tgl Lahir')
			->setCellValue('K1', 'NIK')
			->setCellValue('L1', 'Jenis Kelamin')
			->setCellValue('M1', 'Dokter')
			->setCellValue('N1', 'Jenis Penjamin')
			->setCellValue('O1', 'Asuransi')
			->setCellValue('P1', 'No Asuransi')
			->setCellValue('Q1', 'Umur')
			->setCellValue('R1', 'Pemetaan');
					
		$startRow = 2;
		$row = $startRow;
		if($data){
			foreach ($data as $key => $val) {
				$is_pulang = ($val->is_pulang == '1') ? 'Pulang' : '-';
				$tgl_plg = ($val->tanggal_pulang) ? DateTime::createFromFormat('Y-m-d', $val->tanggal_pulang)->format('d/m/Y') : '-';
				$sheet
					->setCellValue("A{$row}", $val->no_reg)
					->setCellValue("B{$row}", $val->nama_pasien)
					->setCellValue("C{$row}", DateTime::createFromFormat('Y-m-d', $val->tanggal_reg)->format('d/m/Y'))
					->setCellValue("D{$row}", $val->jam_reg)
					->setCellValue("E{$row}", $is_pulang)
					->setCellValue("F{$row}", $tgl_plg)
					->setCellValue("G{$row}", $val->jam_pulang)
					->setCellValue("H{$row}", $val->no_rm)
					->setCellValue("I{$row}", $val->tempat_lahir)
					->setCellValue("J{$row}", DateTime::createFromFormat('Y-m-d', $val->tanggal_lahir)->format('d/m/Y'))
					->setCellValue("K{$row}", $val->nik)
					->setCellValue("L{$row}", $val->jenkel)
					->setCellValue("M{$row}", $val->nama_dokter)
					->setCellValue("N{$row}", $val->penjamin)
					->setCellValue("O{$row}", $val->nama_asuransi)
					->setCellValue("P{$row}", $val->no_asuransi)
					->setCellValue("Q{$row}", $val->umur)
					->setCellValue("R{$row}", $val->keterangan);
				$row++;
			}

			$endRow = $row - 1;
		}
		
		
		$filename = 'data-registrasi_'.$tgl_awal_fix.'_'.$tgl_akhir_fix.'_'.time();
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
		
	}

	public function cetak_data_individu($enc_id)
	{
		if(strlen($enc_id) != 32) {
			return redirect(base_url($this->uri->segment(1)));
		}

		$this->load->library('Enkripsi');
		$id = $this->enkripsi->enc_dec('decrypt', $enc_id);

		$data = $this->t_registrasi->get_data_ekspor(false,false,$id);
		$data_klinik = $this->m_global->single_row('*', 'deleted_at is null', 'm_klinik');

		$retval = [
			'data' => $data,
			'data_klinik' => $data_klinik,
			'title' => 'Detail Data Registrasi'
		];

		$this->load->view('pdf_individu', $retval);
		$html = $this->load->view('pdf_individu', $retval, true);
	    $filename = 'detail_registrasi_'.$data->no_reg.'_'.time();
	    $this->lib_dompdf->generate($html, $filename, true, 'A4', 'potrait');
	}

	public function cetak_data()
	{
		$tgl_awal = $this->input->get('tgl_awal');
		$tgl_akhir = $this->input->get('tgl_akhir');

		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$tgl_awal_fix = $obj_date->createFromFormat('d/m/Y', $tgl_awal)->format('Y-m-d');
		$tgl_akhir_fix = $obj_date->createFromFormat('d/m/Y', $tgl_akhir)->format('Y-m-d');

		// var_dump($tgl_awal, $tgl_akhir);
		$data = $this->t_registrasi->get_data_ekspor($tgl_awal_fix,$tgl_akhir_fix);
		$data_klinik = $this->m_global->single_row('*', 'deleted_at is null', 'm_klinik');

		$retval = [
			'data' => $data,
			'title' => 'Data Registrasi',
			'periode' => 'Periode '.$tgl_awal.' - '.$tgl_akhir,
			'data_klinik' => $data_klinik
		];

		// $this->load->view('pdf', $retval);
		$html = $this->load->view('pdf', $retval, true);
	    $filename = 'data_registrasi'.$tgl_awal_fix.'_'.$tgl_akhir_fix.'_'.time();
	    $this->lib_dompdf->generate($html, $filename, true, 'legal', 'landscape');
	}

	############ odonto grup ##############
	public function save_odontogram()
	{
		$base64Image = $this->input->post('image');
		$id_reg = $this->input->post('id_reg');

		$cek = $this->m_global->getSelectedData('t_odontogram', ['id_reg' => $id_reg])->row();
		$fileName =  $id_reg.'.png';
		$imageDir =  'upload/odontogram/';
		$base64Image = trim($base64Image);
		$base64Image = str_replace('data:image/png;base64,', '', $base64Image);
		$base64Image = str_replace('data:image/jpg;base64,', '', $base64Image);
		$base64Image = str_replace('data:image/jpeg;base64,', '', $base64Image);
		$base64Image = str_replace('data:image/gif;base64,', '', $base64Image);
		$base64Image = str_replace(' ', '+', $base64Image);
	
		$imageData = base64_decode($base64Image);
		// var_dump($imageData); die();
		//Set image whole path here 
		$filePath = $imageDir . $fileName;
	
	   	$result = file_put_contents($filePath, $imageData);

		if ($result !== FALSE) {
			if ($cek) {
				$this->m_global->update('t_odontogram', ['gambar'=>$fileName], ['id_reg' => $id_reg]);
			}else{
				$this->m_global->store(['gambar'=>$fileName, 'id_reg'=> $id_reg], 't_odontogram');
			}
			$retval['status'] = true;
			$retval['pesan'] = 'Berhasil Tersimpan';
		}else{
			$retval['status'] = false;
			$retval['pesan'] = 'gagal tersimpan';
		}

		echo json_encode($retval);
	}

	public function cetak_odontogram()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$datenow = $obj_date->format('Y-m-d');
		$enc_id = $this->input->get('pid');
		$id_reg = $this->enkripsi->enc_dec('decrypt', $enc_id);

		$select = "reg.*, reg.no_asuransi, pas.no_rm, pas.nama as nama_pasien, pas.tempat_lahir, pas.tanggal_lahir, pas.jenis_kelamin, pas.nik, peg.nama as nama_dokter, asu.nama as nama_asuransi";
		$where = ['reg.id' => $id_reg];
		$table = 't_registrasi as reg';
		$join = [ 
			['table' => 'm_pasien as pas', 'on' => 'reg.id_pasien = pas.id'],
			['table' => 'm_pegawai as peg', 'on' => 'reg.id_pegawai = peg.id'],
			['table' => 'm_asuransi as asu', 'on' => 'reg.id_asuransi = asu.id and reg.is_asuransi is not null']
		];
				
		$datareg = $this->m_global->single_row($select, $where, $table, $join);
		
		$datanya = $this->m_global->single_row('*', ['id_reg' => $id_reg], 't_perawatan');
		$odonto = $this->m_global->getSelectedData('t_odontogram', ['id_reg' => $id_reg])->row();
		
		$data_klinik = $this->m_global->single_row('*', ['deleted_at' => null, 'id' => $datareg->id_klinik], 'm_klinik');

		$konten_html = $this->load->view('pdf_odontogram', ['data_reg'=>$datareg, 'datanya' => $datanya, 'odonto' => $odonto], true);
		
		// var_dump($konten_html);exit;
		$retval = [
			'data' => $datanya,
			'data_reg' => $datareg,
			'data_klinik' => $data_klinik,
			'content' => $konten_html,
			'title' => 'Pemeriksaan Odontogram'
		];

		//$this->load->view('template/pdf', $retval, true);		
		$html = $this->load->view('template/pdf', $retval, true);
	    $filename = $retval['title'].'_'.time();
	    $this->lib_dompdf->generate($html, $filename, true, 'A4', 'potrait');
		
	}

	public function cetak_pemeriksaan()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$datenow = $obj_date->format('Y-m-d');
		$enc_id = $this->input->get('pid');
		$id_reg = $this->enkripsi->enc_dec('decrypt', $enc_id);

		$select = "reg.*, reg.no_asuransi, pas.no_rm, pas.nama as nama_pasien, pas.tempat_lahir, pas.tanggal_lahir, pas.jenis_kelamin, pas.nik, peg.nama as nama_dokter, asu.nama as nama_asuransi";
		$where = ['reg.id' => $id_reg];
		$table = 't_registrasi as reg';
		$join = [ 
			['table' => 'm_pasien as pas', 'on' => 'reg.id_pasien = pas.id'],
			['table' => 'm_pegawai as peg', 'on' => 'reg.id_pegawai = peg.id'],
			['table' => 'm_asuransi as asu', 'on' => 'reg.id_asuransi = asu.id and reg.is_asuransi is not null']
		];
				
		$datareg = $this->m_global->single_row($select, $where, $table, $join);
		
		$datanya = $this->m_global->single_row('*', ['id_reg' => $id_reg], 't_perawatan');
		$odonto = $this->m_global->getSelectedData('t_odontogram', ['id_reg' => $id_reg])->row();
		
		$data_klinik = $this->m_global->single_row('*', ['deleted_at' => null, 'id' => $datareg->id_klinik], 'm_klinik');

		$konten_html = $this->load->view('pdf_pemeriksaan', ['data_reg'=>$datareg, 'datanya' => $datanya, 'odonto' => $odonto], true);
		
		// var_dump($konten_html);exit;
		$retval = [
			'data' => $datanya,
			'data_reg' => $datareg,
			'data_klinik' => $data_klinik,
			'content' => $konten_html,
			'title' => 'Formulir Pemeriksaan Odontogram'
		];

		//$this->load->view('template/pdf', $retval, true);		
		$html = $this->load->view('template/pdf', $retval, true);
	    $filename = $retval['title'].'_'.time();
	    $this->lib_dompdf->generate($html, $filename, true, 'A4', 'potrait');
		
	}

	public function save_formulir_odonto()
	{
		$id_reg = $this->input->get('id_reg');

		$data = [
			'sebelas' => $this->input->post('sebelas'),
			'dua_belas' => $this->input->post('dua_belas'),
			'tiga_belas' => $this->input->post('tiga_belas'),
			'empat_belas' => $this->input->post('empat_belas'),
			'lima_belas' => $this->input->post('lima_belas'),
			'enam_belas' => $this->input->post('enam_belas'),
			'tujuh_belas' => $this->input->post('tujuh_belas'),
			'delapan_belas' => $this->input->post('delapan_belas'),
			'dua_satu' => $this->input->post('dua_satu'),
			'dua_dua' => $this->input->post('dua_dua'),
			'dua_tiga' => $this->input->post('dua_tiga'),
			'dua_empat' => $this->input->post('dua_empat'),
			'dua_lima' => $this->input->post('dua_lima'),
			'dua_enam' => $this->input->post('dua_enam'),
			'dua_tujuh' => $this->input->post('dua_tujuh'),
			'dua_delapan' => $this->input->post('dua_delapan'),
			'tiga_satu' => $this->input->post('tiga_satu'),
			'tiga_dua' => $this->input->post('tiga_dua'),
			'tiga_tiga' => $this->input->post('tiga_tiga'),
			'tiga_empat' => $this->input->post('tiga_empat'),
			'tiga_lima' => $this->input->post('tiga_lima'),
			'tiga_enam' => $this->input->post('tiga_enam'),
			'tiga_tujuh' => $this->input->post('tiga_tujuh'),
			'tiga_delapan' => $this->input->post('tiga_delapan'),
			'empat_satu' => $this->input->post('empat_satu'),
			'empat_dua' => $this->input->post('empat_dua'),
			'empat_tiga' => $this->input->post('empat_tiga'),
			'empat_empat' => $this->input->post('empat_empat'),
			'empat_lima' => $this->input->post('empat_lima'),
			'empat_enam' => $this->input->post('empat_enam'),
			'empat_tujuh' => $this->input->post('empat_tujuh'),
			'empat_delapan' => $this->input->post('empat_delapan'),
			'occlusi' => $this->input->post('occlusi'),
			'torus_palatinus' => $this->input->post('torus_palatinus'),
			'torus_mandibularis' => $this->input->post('torus_mandibularis'),
			'palatum' => $this->input->post('palatum'),
			'diastema' => $this->input->post('diastema'),
			'keterangan_diastema' => $this->input->post('keterangan_diastema'),
			'gigi_anomali' => $this->input->post('gigi_anomali'),
			'keterangan_gigi_anomali' => $this->input->post('keterangan_gigi_anomali'),
			'lain_lain' => $this->input->post('lain_lain'),
			'd' => $this->input->post('d'),
			'm' => $this->input->post('m'),
			'f' => $this->input->post('f'),
			'jumlah_rontgen' => $this->input->post('jumlah_rontgen'),
			'jumlah_foto' => $this->input->post('jumlah_foto'),
		];

		$cek = $this->m_global->getSelectedData('t_odontogram', ['id_reg' => $id_reg])->row();
		if ($cek) {
			
			$this->m_global->update('t_odontogram', $data, ['id_reg' => $id_reg]);

			$old_data = $this->m_global->getSelectedData('t_odontogram', ['id_reg' => $id_reg])->row();
			$retval['status'] = true;
			$retval['pesan'] = 'Berhasil Diupdate';
			$retval['old_data'] = $old_data;
		}else{
			$data['id_reg'] = $id_reg;
			$this->m_global->store($data, 't_odontogram');

			$old_data = $this->m_global->getSelectedData('t_odontogram', ['id_reg' => $id_reg])->row();
			$retval['status'] = true;
			$retval['pesan'] = 'Berhasil Tersimpan';
			$retval['old_data'] = $old_data;
		}

		echo json_encode($retval);
	}

	public function load_formulir()
	{
		$id_reg = $this->input->get('id_reg');
		$old_data = $this->m_global->getSelectedData('t_odontogram', ['id_reg' => $id_reg])->row();
		
		$data['old_data'] = $old_data;
		

		echo json_encode($data);
	}

	############ end odonto grup ###########

	############ pulangkan grup ##########
	public function pulangkan_pasien()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$datenow = $obj_date->format('Y-m-d');
		$id_reg = $this->input->post('idReg');
		$id_reg = $this->enkripsi->enc_dec('decrypt', $id_reg);
		$datareg = $this->m_global->single_row('*', ['id' => $id_reg, 'deleted_at' => null], 't_registrasi');
		if($datareg && $datareg->is_pulang) {
			echo json_encode([
				'status' => false,
				'pesan' => 'Pasien ['.$datareg->no_reg.'] Telah dipulangkan, Aksi Dibatalkan',  
			]);
			return;
		}

		$upd = $this->m_global->update('t_registrasi', [
			'tanggal_pulang' => $datenow,
			'jam_pulang' =>  Carbon::parse($timestamp)->format('H:i:s'),
			'is_pulang' => 1, 
			'updated_at' => $timestamp
		], ['id' => $id_reg]);
		if($upd) {
			echo json_encode([
				'status' => true,
				'pesan' => 'Pasien ['.$datareg->no_reg.'] Sukses dipulangkan',  
			]);
		}else{
			echo json_encode([
				'status' => false,
				'pesan' => 'Terjadi kesalahan, mohon hubungi administrator.',  
			]);
		}
		
	}
	########### end pulangkan grup ##########

	########################### start pasien grup ###########################
	public function simpan_form_pasien()
	{

		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$datenow = $obj_date->format('Y-m-d');
		$id_peg = $this->input->post('id_peg');
		$id_psn = $this->input->post('id_psn');
		$id_reg = $this->input->post('id_reg');
		
		$nama = contul(trim(strtoupper($this->input->post('nama'))));
		$nik = contul(trim($this->input->post('nik')));
		$tempat_lahir = contul(trim($this->input->post('tempat_lahir')));
		$tanggal_lahir = contul(trim($this->input->post('tanggal_lahir')));
		$jenkel = contul(trim($this->input->post('jenkel')));
		$suku = contul(trim($this->input->post('suku')));
		$pekerjaan = contul(trim($this->input->post('pekerjaan')));
		$hp = contul(trim($this->input->post('hp')));
		$telp = contul(trim($this->input->post('telp')));
		$alamat_rumah = contul(trim($this->input->post('alamat_rumah')));
		$alamat_kantor = contul(trim($this->input->post('alamat_kantor')));

		$gol_darah = contul(trim($this->input->post('gol_darah')));
		$tekanan_darah_val = contul(trim($this->input->post('tekanan_darah_val')));
		$tekanan_darah = $this->input->post('tekanan_darah');
		$penyakit_jantung = $this->input->post('penyakit_jantung');
		$diabetes = $this->input->post('diabetes');
		$haemopilia = $this->input->post('haemopilia');
		$hepatitis = $this->input->post('hepatitis');
		$gastring = $this->input->post('gastring');
		$penyakit_lainnya = $this->input->post('penyakit_lainnya');
		$alergi_obat = $this->input->post('alergi_obat');
		$alergi_obat_val = contul(trim($this->input->post('alergi_obat_val')));
		$alergi_makanan = $this->input->post('alergi_makanan');
		$alergi_makanan_val = contul(trim($this->input->post('alergi_makanan_val')));

		$this->db->trans_begin();
		
		###################### data pasien

		$pasien = [
			'nama' => $nama,
			'nik' => $nik,
			'tempat_lahir' => $tempat_lahir,
			'tanggal_lahir' => $obj_date->createFromFormat('d/m/Y', $tanggal_lahir)->format('Y-m-d'),
			'jenis_kelamin' => $jenkel,
			'suku' => $suku,
			'pekerjaan' => $pekerjaan,
			'hp' => $hp,
			'telp_rumah' => $telp,
			'alamat_rumah' => $alamat_rumah,
			'alamat_kantor' => $alamat_kantor
		];

	
		$pasien['updated_at'] = $timestamp;
		
		$where = ['id' => $id_psn];
		$update = $this->m_pasien->update($where, $pasien);
		

		###################### data medik
		
		$medik = [
			'gol_darah' => $gol_darah,
			'tekanan_darah' => $tekanan_darah,
			'tekanan_darah_val' => $tekanan_darah_val,
			'penyakit_jantung' => $penyakit_jantung,
			'diabetes' => $diabetes,
			'haemopilia' => $haemopilia,
			'hepatitis' => $hepatitis,
			'gastring' => $gastring,
			'penyakit_lainnya' => $penyakit_lainnya,
			'alergi_obat' => $alergi_obat,
			'alergi_obat_val' => $alergi_obat_val,
			'alergi_makanan' => $alergi_makanan,
			'alergi_makanan_val' => $alergi_makanan_val
		];

	
		$cek_medik = $this->m_data_medik->get_by_condition(['id_pasien' => $id_psn], true);
		$medik['updated_at'] = $timestamp;

		$where = ['id' => $cek_medik->id];
		$update = $this->m_data_medik->update($where, $medik);
		
		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['pesan'] = 'Gagal menambahkan Data Pasien';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['pesan'] = 'Sukses Mengubah Data Pasien';
		}

		echo json_encode($retval);
	}

}
