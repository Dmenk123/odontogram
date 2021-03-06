<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekam_medik extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') === false) {
			return redirect('login');
		}

		$this->load->model('m_user');
		$this->load->model('m_global');
		$this->load->model('t_rekam_medik');
	}

	public function index()
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
			
		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Data Rekam Medik',
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
				$html .= '<td><button type="button" class="button btn-sm btn-success" onclick="pilih_pasien(\''.$this->enkripsi->enc_dec('encrypt', $value->id).'\')"> Pilih</button></td>';
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
			
			default:
				$datanya = null;
				echo json_encode(['data'=> null, 'status' => false, 'menu' => false]);
				break;
		}
	}

	///////////////////// start anamnesa grup ////////////////////
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
	///////////////////// end anamnesa grup ////////////////////

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
		$enc_id = $this->input->post('id_regnya');
		
		$this->load->library('Enkripsi');
		$id = $this->enkripsi->enc_dec('decrypt', $enc_id);

		$select = "reg.id_asuransi, reg.no_asuransi, asu.nama as nama_asuransi, asu.keterangan";
		$where = ['reg.deleted_at is null' => null, 'reg.id' => $id];
		$table = 't_registrasi as reg';
		$join = [ 
			['table' => 'm_asuransi as asu', 'on' => 'reg.id_asuransi = asu.id']
		];

		$data_reg = $this->m_global->single_row($select,$where,$table, $join);
		
		$jenis = $this->input->post('jenis_penjamin');
		// $data_asuransi = $this->m_global->multi_row('*', ['deleted_at' => null], 'm_asuransi', null, 'nama');
		if($jenis == '1') {
			$html = '
				<div class="form-group row form-group-marginless kt-margin-t-20">
					<label class="col-lg-2 col-form-label">Asuransi:</label>
					<div class=" col-lg-6">
					<select class="form-control kt-select2" id="asuransi" name="asuransi">
						<option value="">Silahkan Pilih Nama Asuransi</option>
			';
			if($id != null) {
				$html .= '<option value="'.$data_reg->id_asuransi.'" selected>'.$data_reg->nama_asuransi.'</option>';
			}

			$html .= '
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
			';
			if($id != null) {
				$html .= '<input type="text" class="form-control" id="no_asuransi" name="no_asuransi" autocomplete="off" value="'.$data_reg->no_asuransi.'">';
			}else{
				$html .= '<input type="text" class="form-control" id="no_asuransi" name="no_asuransi" autocomplete="off" value="">';
			}
			$html .= '	
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
		
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);

		$pemetaan = $this->m_global->multi_row('*', ['deleted_at' => null], 'm_pemetaan', null, 'umur_awal');

		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Edit Data Registrasi',
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

	public function get_data_form_reg()
	{
		$enc_id = $this->input->post('enc_id');

		if(strlen($enc_id) != 32) {
			$status = false;
		}

		$this->load->library('Enkripsi');
		$id = $this->enkripsi->enc_dec('decrypt', $enc_id);

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
			$status = false;
		}else{
			$status = true;
		}

		echo json_encode([
			'status' => $status,
			'data' => $data_reg,
			'txt_opt_pasien' => '['.$data_reg->no_rm.' - '.$data_reg->nik.'] '.$data_reg->nama_pasien,
			'txt_opt_dokter' => '['.$data_reg->kode_dokter.'] '.$data_reg->nama_dokter
		]);
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




	/////////////////////////////////

}
