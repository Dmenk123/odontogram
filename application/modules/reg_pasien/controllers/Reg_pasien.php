<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Carbon\Carbon;

class Reg_pasien extends CI_Controller {
	
	protected $id_klinik = null;
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') === null) {
			return redirect('login');
		}

		$this->load->model('m_user');
		$this->load->model('m_asuransi');
		$this->load->model('m_global');
		$this->load->model('t_registrasi');
		$this->id_klinik = $this->session->userdata('id_klinik');
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

	private function umur_dan_pemetaan($tanggal_lahir = null, $flag_cari = 'umur')
	{
		$tgl_lhr = new DateTime($tanggal_lahir);
		$skrg  = new DateTime('today');
		$umur = $tgl_lhr->diff($skrg)->y;
		
		if($tanggal_lahir !== null) {
			if($flag_cari == 'umur') {
				$retval = $umur;
			}else{
				$data = $this->m_global->single_row('*', ['umur_awal <=' => $umur, 'umur_akhir >=' => $umur], 'm_pemetaan');
				if($data) {
					$retval = $data->id;
				}else{
					$retval = null;
				}
			}
		}else{
			$retval = null;
		}
		

		return $retval;
	}

	public function get_select_pasien()
	{
		$term = $this->input->get('term');
		$data_pasien = $this->m_global->multi_row('*', ['deleted_at' => null, 'is_aktif' => '1', 'nama like' => '%'.$term.'%'], 'm_pasien', null, 'no_rm', 20);
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

	public function get_select_klinik()
	{
		$term = $this->input->get('term');
		$id_jabatan = 1; // jabatan dokter
		$res_data = $this->m_global->multi_row('*', ['deleted_at' => null, 'nama_klinik like' => '%'.$term.'%'], 'm_klinik', null, 'nama_klinik');
		if($res_data) {
			foreach ($res_data as $key => $value) {
				$row['id'] = $value->id;
				$row['text'] = $value->nama_klinik.' - '.$value->alamat;
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

		$select = "reg.nama_asuransi, reg.no_asuransi";
		$where = ['reg.deleted_at is null' => null, 'reg.id' => $id];
		$table = 't_registrasi as reg';
		$join = null;

		$data_reg = $this->m_global->single_row($select,$where,$table, $join);
		
		$jenis = $this->input->post('jenis_penjamin');
		// $data_asuransi = $this->m_global->multi_row('*', ['deleted_at' => null], 'm_asuransi', null, 'nama');
		if($jenis == '1') {
			$html = '
				<div class="form-group row form-group-marginless kt-margin-t-20">
					<label class="col-lg-2 col-form-label">Asuransi:</label>
					<div class=" col-lg-8">';

					if($id != null) {
						$html .= '<input type="text" class="form-control" id="asuransi" name="asuransi" autocomplete="off" value="'.$data_reg->asuransi.'">';
					}else{
						$html .= '<input type="text" class="form-control" id="asuransi" name="asuransi" autocomplete="off" value="">';
					}
				
					$html .= '<span class="help-block"></span>
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

	public function get_select_layanan()
	{
		$term = $this->input->get('term');
		$id_dokter = $this->input->get('id_dokter');
		$this->db->select('*');
		$this->db->from('m_layanan');
		$this->db->where('deleted_at', null);
		// $this->db->like('dokter', $id_dokter);
		$q = $this->db->get();
		$data = $q->result();

		if($data) {
			foreach ($data as $key => $value) {
				$row['id'] = $value->id_layanan;
				$row['text'] = $value->nama_layanan;
				$retval[] = $row;
			}
		} else {
			$retval = false;
		}

		echo json_encode($retval);
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

		$select = "reg.id, reg.id_pasien, reg.id_klinik, reg.id_pegawai, reg.no_reg, reg.tanggal_reg, reg.jam_reg, reg.tanggal_pulang, reg.jam_pulang, reg.is_pulang, reg.is_asuransi, reg.nama_asuransi, reg.umur, reg.no_asuransi, reg.id_pemetaan, reg.id_layanan, psn.nama as nama_pasien, psn.no_rm, psn.tanggal_lahir, psn.tempat_lahir, psn.nik, psn.jenis_kelamin, peg.kode as kode_dokter, peg.nama as nama_dokter, pem.keterangan, CASE WHEN reg.is_asuransi = 1 THEN 'Asuransi' ELSE 'Umum' END as penjamin, CASE WHEN psn.jenis_kelamin = 'L' THEN 'Laki-Laki' ELSE 'Perempuan' END as jenkel, kli.nama_klinik, kli.alamat as alamat_klinik, lay.nama_layanan";
		/* $where = ['reg.deleted_at is null' => null, 'reg.id' => $id, 'reg.id_klinik' => $this->id_klinik]; */
		$where = ['reg.deleted_at is null' => null, 'reg.id' => $id];
		$table = 't_registrasi as reg';
		$join = [ 
			['table' => 'm_pasien as psn', 'on'	=> 'reg.id_pasien = psn.id'],
			['table' => 'm_pegawai as peg', 'on'=> 'reg.id_pegawai = peg.id'],
			['table' => 'm_pemetaan as pem', 'on' => 'reg.id_pemetaan = pem.id'],
			['table' => 'm_klinik as kli', 'on' => 'reg.id_klinik = kli.id'],
			['table' => 'm_layanan as lay', 'on' => 'reg.id_layanan = lay.id_layanan'],
		];
		$data_reg = $this->m_global->single_row($select,$where,$table, $join);
		
		
		// echo $this->db->last_query();
		// exit;

		if($this->session->userdata('id_klinik') == null) {
			$is_option_klinik = true;
		}else{
			$is_option_klinik = false;
		}
		
		if(!$data_reg) {
			$status = false;
		}else{
			$status = true;
		}

		echo json_encode([
			'status' => $status,
			'data' => $data_reg,
			'txt_opt_pasien' => '['.$data_reg->no_rm.' - '.$data_reg->nik.'] '.$data_reg->nama_pasien,
			'txt_opt_dokter' => '['.$data_reg->kode_dokter.'] '.$data_reg->nama_dokter,
			'txt_opt_layanan' => $data_reg->nama_layanan,
			'txt_opt_klinik' =>  $data_reg->nama_klinik.' - '.$data_reg->alamat_klinik,
			'is_option_klinik' => $is_option_klinik
		]);
	}

	public function simpan_data()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		
		if($this->input->post('asuransi') !== null){
			$flag_asuransi = true;
			$nama_asuransi = $this->input->post('asuransi');
			$no_asuransi = contul($this->input->post('no_asuransi'));
		}else{
			$flag_asuransi = false;
			$nama_asuransi = null;
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
		$id_layanan = contul($this->input->post('layanan'));
		
		if($this->session->userdata('id_klinik') != null) {
			$id_klinik = $this->session->userdata('id_klinik');
		}else{
			$id_klinik = contul($this->input->post('klinik'));
		}
		
		$this->db->trans_begin();
		
		$registrasi = [
			'id_pasien' => $id_pasien,
			'tanggal_reg' => $obj_date->createFromFormat('d/m/Y', $tanggal_reg)->format('Y-m-d'),
			'jam_reg' => $jam_reg,
			'id_pegawai' => $id_pegawai,
			'is_asuransi' => $is_asuransi,
			'nama_asuransi' => $nama_asuransi,
			'no_asuransi' => $no_asuransi,
			'id_klinik' => $id_klinik,
			'umur' => $umur,
			'id_pemetaan' => $id_pemetaan,
			'id_layanan'=> $id_layanan
		];

		if($this->input->post('id_reg') != '') {
			###update
			$registrasi['updated_at'] = $timestamp;
			$where = ['id' => $this->input->post('id_reg')];
			$cek = $this->m_global->single_row('*', $where,'t_registrasi');

			$update = $this->t_registrasi->update($where, $registrasi);
			$pesan = 'Sukses Mengupdate data Registrasi';
			$merge_arr = array_merge($where, $registrasi);
			$log_aktifitas = $this->m_global->insert_log_aktifitas('UBAH DATA REGISTRASI', [
				'old_data' => json_encode($cek),
				'new_data' => json_encode($merge_arr)
			]);
		}else{
			###insert
			$registrasi['id'] = $this->t_registrasi->get_max_id();
			$registrasi['no_reg'] = $this->t_registrasi->get_kode_reg();
			$registrasi['created_at'] = $timestamp;
			$insert = $this->t_registrasi->save($registrasi);
			$pesan = 'Sukses Menambah data Registrasi';

			$log_aktifitas = $this->m_global->insert_log_aktifitas('TAMBAH DATA REGISTRASI', [
				'new_data' => json_encode($registrasi)
			]);
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
		$list = $this->t_registrasi->get_datatable($tgl_awal, $tgl_akhir, $this->id_klinik);

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
			$row[] = DateTime::createFromFormat('Y-m-d', $val->tanggal_reg)->format('d/m/Y');
			$row[] = ($val->jam_reg) ?  DateTime::createFromFormat('H:i:s', $val->jam_reg)->format('H:i') : '-';
			$row[] = $val->no_reg;
			$row[] = $val->no_rm;
			$row[] = $val->nama_pasien;
			$row[] = $val->nama_klinik;
			$row[] = $val->nama_layanan;
			$row[] = $val->nama_dokter;
			$row[] = $val->sudah_rekam_medik;
			$row[] = ($val->tanggal_pulang) ? DateTime::createFromFormat('Y-m-d', $val->tanggal_pulang)->format('d/m/Y') : '-';
			$row[] = $val->jam_pulang;
			$row[] = $val->tempat_lahir;
			$row[] = DateTime::createFromFormat('Y-m-d', $val->tanggal_lahir)->format('d/m/Y');
			$row[] = $val->nik;
			$row[] = $val->jenkel;
			$row[] = $val->penjamin;
			$row[] = $val->nama_asuransi;
			$row[] = $val->no_asuransi;
			$row[] = $val->umur;
			$row[] = $val->keterangan;
			
			$str_aksi = '
				<div class="btn-group">
					<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Opsi</button>
					<div class="dropdown-menu">';

			if($val->is_pulang != '1') {
				$str_aksi .= $this->template_view->getEditButtonTable(
					base_url('reg_pasien/edit/').$this->enkripsi->enc_dec('encrypt', $val->id), 
					'Edit Registrasi', 
					true,
					false
				).
				''
				.$this->template_view->getDeleteButtonTable(
					"delete_reg(\"".$this->enkripsi->enc_dec('encrypt', $val->id)."\")",
					'Hapus', 
					true,
					true
				);
			}
			
			$str_aksi .= '<a class="dropdown-item" target="_blank" href="'.base_url('reg_pasien/cetak_data_individu/').$this->enkripsi->enc_dec('encrypt', $val->id).'">
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
			"recordsTotal" => $this->t_registrasi->count_all($this->id_klinik),
			"recordsFiltered" => $this->t_registrasi->count_filtered($tgl_awal, $tgl_akhir, $this->id_klinik),
			"data" => $data
		];
		
		echo json_encode($output);
	}

	public function list_data_broadcast()
	{
		$this->load->library('Enkripsi');
		$list = $this->t_registrasi->get_list_broadcast($this->id_klinik);
		// echo $this->db->last_query();exit;
		
		$data = array();
		$data = [];
		if ($list) {
			foreach ($list as $key => $val) {
			
				$data[$key][] = $key+1;
				$data[$key][] = $val->no_reg;
				$data[$key][] = $val->nama_pasien;
				$data[$key][] = $val->no_rm;
				$data[$key][] = DateTime::createFromFormat('Y-m-d', $val->tanggal_reg)->format('d/m/Y');
				$data[$key][] = $val->jam_reg; 
				$data[$key][] = $val->nama_klinik;
				$data[$key][] = $val->nama_dokter;
				$data[$key][] = $val->id;
			}
		}
		
		// $this->output->enable_profiler(TRUE);

        echo json_encode([
            'data' => $data
        ]);

	}

	public function send_broadcast()
	{
		try {
			$this->load->library('Api_wa');

			if($this->input->post('id') == null || $this->input->post('id') == '') {
				echo json_encode([
					'status' => false,
					'pesan' => 'Mohon ceklist salah satu'
				]);
				return;
			}

			$this->db->select('a.id as id_reg, b.nama, b.hp, c.nama_klinik, c.alamat, c.telp, c.token_wa, a.tanggal_reg, a.jam_reg');
			$this->db->from('t_registrasi a');
			$this->db->join('m_pasien b', 'a.id_pasien = b.id', 'left');
			$this->db->join('m_klinik c', 'a.id_klinik = c.id', 'left');
			$this->db->where('a.deleted_at', null);	
			$this->db->where('b.deleted_at', null);		
			$this->db->where_in('a.id', $this->input->post('id'));
			$q = $this->db->get()->result();
			
			if($q) {
				### get template pesan broadcast
				$template_pesan = $this->m_global->single_row('*', ['type' => 'broadcast'], 'm_pesan_blash');
				foreach ($q as $key => $value) {
					$text = $template_pesan->pesan;
					$text = str_replace("#KLINIK#", $value->nama_klinik, $text);
					$text = str_replace("#NAMA#", $value->nama, $text);
					$text = str_replace("#WAKTU#", tanggal_indo($value->tanggal_reg).' '.Carbon::createFromFormat('H:i:s', $value->jam_reg)->format('H:i'), $text);
					$post_pesan = json_decode($this->api_wa->send_message($value->hp, $text, $value->token_wa), true);
					
					if($post_pesan['status'] == false) {
						echo json_encode([
							'status' => false,
							'pesan' => $post_pesan['message']
						]);
						return;
					}

					#flag registrasi
					$this->m_global->update('t_registrasi', ['is_send_broadcast' => 1],  ['id' => $value->id_reg]);
				}

				$retval['status'] = TRUE;
				$retval['pesan'] = 'Sukses Broadcast reminder';
				echo json_encode($retval);
			}else{
				echo json_encode([
					'status' => false,
					'pesan' => 'Data tidak ditemukan'
				]);
				return;
			}
		} catch (\Throwable $th) {
			$retval['status'] = FALSE;
			$retval['pesan'] = 'Gagal Broadcast reminder';
			echo json_encode($retval);
		}
				
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

		$id_reg = $this->enkripsi->enc_dec('decrypt', $enc_id);
		$cek = $this->m_global->single_row('*', ['id' => $id_reg], 't_registrasi');
		$log_aktifitas = $this->m_global->insert_log_aktifitas('HAPUS DATA REGISTRASI', [
			'old_data' => json_encode($cek)
		]);

		$del = $this->t_registrasi->softdelete_by_id($id_reg);
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

		if ($this->input->post('layanan') == '') {
			$data['inputerror'][] = 'layanan';
			$data['error_string'][] = 'Wajib Mengisi layanan';
			$data['status'] = FALSE;
			$data['is_select2'][] = TRUE;
		}

		if($is_asuransi) {
			if ($this->input->post('asuransi') == '') {
				$data['inputerror'][] = 'asuransi';
				$data['error_string'][] = 'Wajib Mengisi Asuransi';
				$data['status'] = FALSE;
				$data['is_select2'][] = FALSE;
			}
			
			/* if ($this->input->post('no_asuransi') == '') {
				$data['inputerror'][] = 'no_asuransi';
				$data['error_string'][] = 'Wajib Mengisi Nomor Asuransi';
				$data['status'] = FALSE;
				$data['is_select2'][] = FALSE;
			} */
		}

        return $data;
	}




	/////////////////////////////////

}
