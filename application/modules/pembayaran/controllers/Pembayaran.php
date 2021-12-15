<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Carbon\Carbon;

class Pembayaran extends CI_Controller {
	protected $id_klinik = null;

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') === null) {
			return redirect('login');
		}

		$this->load->model('m_user');
		$this->load->model('m_global');
		$this->load->model('m_pasien');
		$this->load->model('m_data_medik');
		$this->load->model('t_pembayaran');

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
			'title' => 'Daftar Pembayaran Selesai',
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
			'modal' => 'modal_detail',
			'js'	=> 'pembayaran.js',
			'view'	=> 'view_list_pembayaran'
		];

		$this->template_view->load_view($content, $data);
	}

	public function list_data()
	{
		$this->load->library('Enkripsi');
		$list = $this->t_pembayaran->get_datatables($this->id_klinik);
		
		$data = array();
		// $no =$_POST['start'];
		foreach ($list as $val) {
			$row = array();
			//loop value tabel db
			$row[] = $val->nama_klinik;
			$row[] = $val->no_reg;
			$row[] = Carbon::parse($val->tanggal)->format('d-m-Y');
			$row[] = $val->username;
			$row[] = $val->jenis_bayar;
			$row[] = $val->disc_persen;
			$row[] = '<div><span style="text-align:right;">'.number_format($val->disc_rp,0,',','.').'</span></div>';
			$row[] = '<div><span style="text-align:right;">'.number_format($val->total_bruto,0,',','.').'</span></div>';
			$row[] = '<div><span style="text-align:right;">'.number_format($val->total_nett,0,',','.').'</span></div>';

			$str_aksi = '
				<div class="btn-group">
					<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Opsi</button>
					<div class="dropdown-menu">
						<button class="dropdown-item" onclick="detail_trans(\'' . $this->enkripsi->enc_dec('encrypt', $val->id) . '\')">
							<i class="la la-search"></i> Detail pembayaran
						</button>
			';

			if ($val->is_locked == null) {
				$str_aksi .= '
				<a class="dropdown-item" href="' . base_url('pembayaran/edit/') . $this->enkripsi->enc_dec('encrypt', $val->id) . '"">
					<i class="la la-pencil"></i> Edit pembayaran
				</a>
				<button class="dropdown-item" onclick="delete_trans(\'' . $this->enkripsi->enc_dec('encrypt', $val->id) . '\')">
					<i class="la la-trash"></i> Hapus
				</button>
				';
			}

			$str_aksi .= '
				<a class="dropdown-item" target="_blank" href="' . base_url('pembayaran/cetak_data_individu/') . $this->enkripsi->enc_dec('encrypt', $val->id) . '">
					<i class="la la-print"></i> Cetak Transaksi Ini
				</a>
			';

			$str_aksi .= '</div></div>';
			$row[] = $str_aksi;
			$data[] = $row;
		} //end loop

		$output = [
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->t_pembayaran->count_all($this->id_klinik),
			"recordsFiltered" => $this->t_pembayaran->count_filtered($this->id_klinik),
			"data" => $data
		];

		echo json_encode($output);
	}

	public function add()
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
			
		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Form Pembayaran',
			'data_user' => $data_user,
			'data_bank_kredit' => $this->m_global->multi_row('*',['deleted_at' => null], 'm_bank_kredit', null, 'nama')
		);

		/**
		 * content data untuk template
		 * param (css : link css pada direktori assets/css_module)
		 * param (modal : modal komponen pada modules/nama_modul/views/nama_modal)
		 * param (js : link js pada direktori assets/js_module)
		 */
		$content = [
			'css' 	=> null,
			'modal' => ['rekam_medik/modal_pilih_pasien'],
			'js'	=> 'pembayaran.js',
			'view'	=> 'form_pembayaran'
		];

		$this->template_view->load_view($content, $data);
	}

	public function cari_pasien_pulang()
	{
		$this->load->library('Enkripsi');
		$tgl_filter_akhir = Carbon::createFromFormat('d/m/Y', $this->input->post('tgl_filter_akhir'))->format('Y-m-d');
		$tgl_filter_mulai = Carbon::createFromFormat('d/m/Y', $this->input->post('tgl_filter_mulai'))->format('Y-m-d');
		$pilih_nama = $this->input->post('pilih_nama');
		$pilih_norm = $this->input->post('pilih_norm');
		
		$select = "reg.*, reg.no_asuransi, pas.no_rm, pas.nama as nama_pasien";
		$where = [
			'reg.deleted_at' => null,
			'reg.is_pulang' => '1',
			'pas.is_aktif' => '1',
			'pas.nama like' => '%'.$pilih_nama.'%',
			'pas.no_rm like' => '%'.$pilih_norm.'%',
			'reg.tanggal_reg >=' => $tgl_filter_mulai,
			'reg.tanggal_reg <=' => $tgl_filter_akhir,
			'byr.is_locked' => null
		];
		$table = 't_registrasi as reg';
		$join = [ 
			['table' => 'm_pasien as pas', 'on' => 'reg.id_pasien = pas.id'],
			['table' => 't_pembayaran as byr', 'on' => 'reg.id = byr.id_reg']
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
				$html .= '<td>'.Carbon::parse($value->tanggal_reg)->format('d/m/Y').'</td>';
				$html .= '<td>'.$value->jam_reg.'</td>';
				$html .= '<td>'.$value->no_rm.'</td>';
				$html .= '<td>'.Carbon::parse($value->tanggal_pulang.' '.$value->jam_pulang)->format('d/m/Y H:i:s').'</td>';
				$html .= '<td>'.$value->no_asuransi.'</td>';
				// $html .= '<td><button type="button" class="button btn-sm btn-success" onclick="pilih_pasien(\''.$this->enkripsi->enc_dec('encrypt', $value->id).'\')"> Pilih</button></td>';
				$html .= '<td><button type="button" class="button btn-sm btn-success" onclick="submit_pasien_pulang(\''.$this->enkripsi->enc_dec('encrypt', $value->id).'\')"> Pilih</button></td>';
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
		if($this->input->post('enc_id') == '') {
			echo json_encode([
				'data' => null,
				'status' => false,
				'data_id' => null,
				'html_header' => null,
				'html_detail' => null,
				'tot_biaya' => null,
			]);
			return;
		}

		$enc_id = $this->input->post('enc_id');
		$id = $this->enkripsi->enc_dec('decrypt', $enc_id);
		$html_header = '';
		$html_pembayaran = $this->get_detail_pembayaran($id);
		$select = "reg.*, reg.no_asuransi, pas.no_rm, pas.nama as nama_pasien, peg.nama as nama_dokter";
		$where = ['reg.id' => $id];
		$table = 't_registrasi as reg';
		$join = [ 
			['table' => 'm_pasien as pas', 'on' => 'reg.id_pasien = pas.id'],
			['table' => 'm_pegawai as peg', 'on' => 'reg.id_pegawai = peg.id'],
		];
				
		$data = $this->m_global->single_row($select, $where, $table, $join);
		$html = '';
		
		if($data){
			$status = true;
			$html .= '<tr>';
			$html .= '<td>'.$data->no_reg.'</td>';
			$html .= '<td>'.Carbon::parse($data->tanggal_reg.' '.$data->jam_reg)->format('d/m/Y H:i:s').'</td>';
			$html .= '<td>'.Carbon::parse($data->tanggal_pulang.' '.$data->jam_pulang)->format('d/m/Y H:i:s').'</td>';
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

		$data_pembayaran = $this->get_detail_pembayaran($id);

		// echo "<pre>";
		// print_r ($data_pembayaran);
		// echo "</pre>";
		// exit;

		$tot_biaya = 0;
		foreach ($data_pembayaran['header'] as $kkkk => $vvvv) {
			$tot_biaya += $vvvv->total_penerimaan_gross;
		}

		$html_header = '';
		if($data_pembayaran['header']) {
			$html_header .= $this->html_header_pembayaran($data_pembayaran['header']);
		}

		$html_detail = '';
		if($data_pembayaran['detail']) {
			$html_detail .= $this->html_detail_pembayaran($data_pembayaran['detail']);
		}

		$data_id = [
			'id_reg' => $data->id,
			'id_psn' => $data->id_pasien,
			'id_peg' => $data->id_pegawai,
		];
		
		echo json_encode([
			'data' => $html,
			'status' => $status,
			'data_id' => $data_id,
			'html_header' => $html_header,
			'html_detail' => $html_detail,
			'tot_biaya' => $tot_biaya,
		]);
		
	}

	protected function get_detail_pembayaran($id) {
		$select = "a.*, peg.nama as nama_dokter, b.total_honor_dokter, b.total_penerimaan_nett, b.total_penerimaan_gross, b.id_jenis_trans, b.id_trans_flag";
		$where = ['a.is_pulang' => 1, 'a.deleted_at' => null, 'a.id' => $id];
		$table = 't_registrasi as a';
		$join = [ 
			[
				'table' => 'm_pegawai as peg',
				'on'	=> 'a.id_pegawai = peg.id'
			],
			[
				'table' => 't_mutasi b',
				'on'	=> 'a.id = b.id_registrasi and b.deleted_at is null'
			],
		];

		$data_header = $this->m_global->multi_row($select,$where,$table, $join);
		
		$arr_detail_fix = [];
		if($data_header && count($data_header) > 0) {
			foreach ($data_header as $key => $value) {
				if($value->id_jenis_trans == '1') {
					#### LOGISTIK
					$q = $this->db->query("
						SELECT a.*, b.qty, b.harga, b.subtotal, c.kode_logistik, c.nama_logistik
						FROM t_logistik as a 
						join t_logistik_det b on a.id = b.id_t_logistik and b.deleted_at is null 
						join m_logistik c on b.id_logistik = c.id_logistik and c.deleted_at is null 
						WHERE a.deleted_at is null and a.id_reg = $value->id 
					")->result();

					foreach ($q as $k => $v) {
						$arr['jenis'] = 'LOGISTIK';
						$arr['qty'] = $v->qty;
						$arr['harga'] = $v->harga;
						$arr['subtotal'] = $v->subtotal;
						$arr['nama'] = $v->nama_logistik.' - '.$v->kode_logistik;
						$arr_detail_fix[] = $arr;
				 	}

				}elseif($value->id_jenis_trans == '2') {
					#### TINDAKAN
					$q = $this->db->query("
						SELECT a.*, b.gigi, b.harga, b.diskon_persen, b.diskon_nilai, b.harga_bruto, c.kode_tindakan, c.nama_tindakan
						FROM t_tindakan as a 
						join t_tindakan_det b on a.id = b.id_t_tindakan and b.deleted_at is null 
						join m_tindakan c on b.id_tindakan = c.id_tindakan and c.deleted_at is null 
						WHERE a.deleted_at is null and a.id_reg = $value->id 
					")->result();

					foreach ($q as $k => $v) {
						$arr['jenis'] = 'TINDAKAN';
						$arr['qty'] = null;
						$arr['harga'] = $v->harga_bruto;
						$arr['diskon_persen'] = $v->diskon_persen;
						$arr['diskon_nilai'] = $v->diskon_nilai;
						$arr['subtotal'] = $v->harga;
						$arr['nama'] = $v->nama_tindakan.' - '.$v->kode_tindakan;
						$arr['gigi'] = $v->gigi;
						$arr_detail_fix[] = $arr;
				 	}
					 
				}elseif($value->id_jenis_trans == '3') {
					#### LAB
					$q = $this->db->query("
						SELECT a.*,  b.harga, b.keterangan, c.kode, c.tindakan_lab
						FROM t_tindakanlab as a 
						join t_tindakanlab_det b on a.id = b.id_t_tindakanlab and b.deleted_at is null 
						join m_laboratorium c on b.id_tindakan_lab = c.id_laboratorium and c.deleted_at is null
						WHERE a.deleted_at is null and a.id_reg = $value->id 
					")->result();

					foreach ($q as $k => $v) {
						$arr['jenis'] = 'TINDAKAN LAB';
						$arr['qty'] = null;
						$arr['harga'] = $v->harga;
						$arr['subtotal'] = $v->harga;
						$arr['nama'] = '(Lab) '.$v->tindakan_lab.' - '.$v->kode;
						$arr['diskon_persen'] = 0;
						$arr['diskon_nilai'] = 0;
						$arr['gigi'] = '-';
						$arr_detail_fix[] = $arr;
				 	}
				}
			}
		}
		
		return [
			'header' => $data_header,
			'detail' => $arr_detail_fix
		];
	}

	protected function html_header_pembayaran($arrData) {
		$tot_biaya = 0;

		foreach ($arrData as $key => $value) {
			$tot_biaya += $value->total_penerimaan_gross;
		}

		$html = '
			<div class="kt-section__title">
				Data Pembayaran
			</div>
			<div class="kt-section__desc">
				Dokter : '.$arrData[0]->nama_dokter.'
			</div>
			<div class="kt-section__desc">
				Asuransi : '.$arrData[0]->nama_asuransi.' - '.$arrData[0]->no_asuransi.'
			</div>
			<div class="kt-section__content">
				<span style="font-size:20px;font-weight:bold;">Total Biaya : Rp. '.number_format($tot_biaya,2,',','.').'</span>
			</div>
		';

		return $html;
	}

	protected function html_detail_pembayaran($arrData) {
		$tot_biaya = 0;

		$html = '
		<div class="kt-section__title">
			Detail Pembayaran
		</div>';

		$html .= '
			<div class="kt-section__content">
				<table class="table table-bordered" style="width:100%;">
					<tr>
						<th>Tindakan</th>
						<th>Gigi</th>
						<th>Harga</th>
						<th>Diskon</th>
						<th>Sub Total</th>
					</tr>
		';

		if(count($arrData) > 0) {
			foreach ($arrData as $key => $value) {
				$tot_biaya += $value['subtotal'];
				$html .= '<tr>
					<td>'.$value['nama'].'</td>
					<td>'.$value['gigi'].'</td>
					<td align="right">'.number_format($value['harga'],0,',','.').'</td>
					<td align="right">'.number_format($value['diskon_nilai'],0,',','.').'</td>
					<td align="right">'.number_format($value['subtotal'],0,',','.').'</td>
				</tr>';
			}

			$html .= '<tr><td colspan="4">Grand Total</td><td align="right"><b>'.number_format($tot_biaya,0,',','.').'</b></td></tr></table></div>';
		}else{
			$html .= '<tr><td colspan="5"><b>Tidak ada Data</b></td></tr></table></div>';
		}	

		return $html;
	}

	public function simpan_data()
	{
		$timestamp = Carbon::now()->format('Y-m-d H:i:s');
		$id_pasien = $this->input->post('id_psn');
		$id_reg = $this->input->post('id_reg');
		$id_peg = $this->input->post('id_peg');
		$total_biaya_raw = $this->input->post('total_biaya_raw');
		$total_biaya_nett_raw = $this->input->post('total_biaya_nett_raw');
		$jenis_bayar = $this->input->post('jenis_bayar');
		$opt_kredit = $this->input->post('opt_kredit');
		$jenis_diskon = $this->input->post('jenis_diskon');
		$disc_rp = $this->input->post('disc_rp');
		$disc_rp_raw = $this->input->post('disc_rp_raw');
		$disc_nilai_raw = $this->input->post('disc_nilai_raw');
		$disc_persen = $this->input->post('disc_persen');
		$pembayaran = $this->input->post('pembayaran');
		$pembayaran_raw = $this->input->post('pembayaran_raw');
		$kembalian_raw = $this->input->post('kembalian_raw');
		
		$arr_valid = $this->rule_validasi();
		
		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}

		$this->db->trans_begin();
		
		$id = $this->m_global->get_max_id('id', 't_pembayaran');
		$arr_pembayaran['id'] = $id;
		$arr_pembayaran['id_reg'] = $id_reg;
		$arr_pembayaran['tanggal'] = Carbon::now()->format('Y-m-d');
		$arr_pembayaran['id_user'] = $this->session->userdata('id_user');
		$arr_pembayaran['disc_persen'] = $disc_persen;
		$arr_pembayaran['disc_rp'] = $disc_rp_raw;
		$arr_pembayaran['disc_nilai'] = $disc_nilai_raw;
		$arr_pembayaran['total_bruto'] = $total_biaya_raw;
		$arr_pembayaran['total_nett'] = $total_biaya_nett_raw;
		$arr_pembayaran['is_locked'] = 1;
		$arr_pembayaran['rupiah_bayar'] = $pembayaran_raw;
		$arr_pembayaran['rupiah_kembali'] = $kembalian_raw;
		
		if($jenis_bayar == 'cash') {
			$arr_pembayaran['is_cash'] = 1;
			$arr_pembayaran['reff_trans_kredit'] = null;
		}else{
			$arr_pembayaran['is_cash'] = null;
			$arr_pembayaran['reff_trans_kredit'] = $opt_kredit;
		}
		
		$arr_pembayaran['created_at'] = $timestamp;

		$insert = $this->t_pembayaran->save($arr_pembayaran);
		
		// isi mutasi
		/**
		 * param 1 = id_registrasi
		 * param 2 kode jenis transaksi (lihat m_jenis_trans)
		 * param 3 data tabel transaksi (parent tabel)
		 * param 4 flag_transaksi (1 : penerimaan , 2 : pengeluaran)
		*/

		#### mutasi diskon
		$mutasi_diskon = $this->lib_mutasi->simpan_mutasi_lain($id_reg, '5', $arr_pembayaran, '2');
		
		if($mutasi_diskon == false) {
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['pesan'] = 'Gagal menambahkan Data Pembayaran';
		}

		#### mutasi honor dokter
		$mutasi_honor = $this->lib_mutasi->simpan_mutasi_lain($id_reg, '6', $arr_pembayaran, '2');
		
		if($mutasi_honor == false) {
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['pesan'] = 'Gagal menambahkan Data Pembayaran';
		}
		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['pesan'] = 'Gagal menambahkan Data Pembayaran';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['pesan'] = 'Sukses menambahkan Data Pembayaran';
		}

		echo json_encode($retval);
	}

	public function detail_pembayaran()
	{
		$enc_id = $this->input->post('enc_id');

		if (strlen($enc_id) != 32) {
			echo json_encode([
				'status' => false,
				'pesan' => 'Data Tidak Valid'
			]);
			return;
		}

		$this->load->library('Enkripsi');
		$id = $this->enkripsi->enc_dec('decrypt', $enc_id);
		$data_bayar = $this->t_pembayaran->get_detail_pembayaran($id);
		$data_bayar_det = $this->get_detail_pembayaran($data_bayar->id_reg);
		
		// echo "<pre>";
		// print_r ($data_bayar);
		// echo "</pre>";
		// exit;

		$html_rinci = '';
		$subtotal = 0;  
		foreach ($data_bayar_det['detail'] as $key => $value) {
			$subtotal += $value['subtotal'];
			$html_rinci .= "<tr>
				<td>".$value['jenis']."</td>
				<td>".$value['nama']."</td>
				<td align='right'>".$value['harga']."</td>
				<td align='right'>".$value['qty']."</td>
				<td align='right'>".$value['subtotal']."</td>
			</tr>";
		}

		$html_rinci .= "<tr>
			<td colspan='4' align='center'>Total (Gross)</td>
			<td align='right'>".number_format($subtotal,0,',','.')."</td>
		</tr>
		<tr>
			<td colspan='4' align='center'>Total Diskon</td>
			<td align='right'>".number_format($data_bayar->disc_nilai,0,',','.')."</td>
		</tr>
		<tr>
			<td colspan='4' align='center'>Total (Nett)</td>
			<td align='right'>".number_format($data_bayar->total_nett,0,',','.')."</td>
		</tr>";

		if (!$data_bayar) {
			echo json_encode([
				'status' => false,
				'pesan' => 'Data Pasien Tidak Ditemukan'
			]);
			return;
		}

		$data = array(
			'status' => true,
			'old_data' => $data_bayar,
			'html_rinci' => $html_rinci
		);

		echo json_encode($data);
	}

	private function rule_validasi($is_update = false)
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;


		if ($this->input->post('jenis_bayar') == '') {
			$data['inputerror'][] = 'jenis_bayar';
			$data['error_string'][] = 'Wajib mengisi Jenis bayar';
			$data['status'] = FALSE;
		}

		if($this->input->post('jenis_bayar') == 'kredit') {
			if ($this->input->post('opt_kredit') == '') {
				$data['inputerror'][] = 'opt_kredit';
				$data['error_string'][] = 'Wajib Mengisi Bank';
				$data['status'] = FALSE;
			}
		}

		if ($this->input->post('jenis_diskon') == 'nominal') {
			if ($this->input->post('disc_rp') == '') {
				$data['inputerror'][] = 'disc_rp';
				$data['error_string'][] = 'Wajib Mengisi Diskon Nominal';
				$data['status'] = FALSE;
			}
		}

		if ($this->input->post('jenis_diskon') == 'persen') {
			if ($this->input->post('disc_persen') == '') {
				$data['inputerror'][] = 'disc_persen';
				$data['error_string'][] = 'Wajib Mengisi Diskon Persen';
				$data['status'] = FALSE;
			}
		}
		
		if ($this->input->post('pembayaran') == '') {
			$data['inputerror'][] = 'pembayaran';
			$data['error_string'][] = 'Wajib Mengisi Pembayaran';
			$data['status'] = FALSE;
		}

		return $data;
	}

	/////////////////////////////////////////////////////////////
	public function edit($enc_id)
	{
		if(strlen($enc_id) != 32) {
			return redirect(base_url($this->uri->segment(1)));
		}

		$this->load->library('Enkripsi');
		$id_pasien = $this->enkripsi->enc_dec('decrypt', $enc_id);
		
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);

		$select = "pas.*, mdk.*";
		$where = ['pas.deleted_at' => null, 'pas.id' => $id_pasien];
		$table = 'm_pasien as pas';
		$join = [ 
			[
				'table' => 'm_data_medik as mdk',
				'on'	=> 'pas.id = mdk.id_pasien'
			]
		];
		$data_pasien = $this->m_global->single_row($select,$where,$table, $join);
		
		if(!$data_pasien) {
			return redirect(base_url($this->uri->segment(1)));
		}

		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Edit Data Pasien',
			'data_user' => $data_user,
			'data_pasien' => $data_pasien
		);

		/**
		 * content data untuk template
		 * param (css : link css pada direktori assets/css_module)
		 * param (modal : modal komponen pada modules/nama_modul/views/nama_modal)
		 * param (js : link js pada direktori assets/js_module)
		 */
		$content = [
			'css' 	=> null,
			'modal' => null,
			'js'	=> 'data_pasien.js',
			'view'	=> 'form_data_pasien'
		];

		$this->template_view->load_view($content, $data);
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
		$del = $this->m_pasien->softdelete_by_id($id_pasien);
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

		$this->m_pasien->update($where, $input);

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
		$table = 'm_pasien as pas';
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

				$id_pasien = $this->m_pasien->get_max_id_pasien();
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
				$this->m_pasien->trun_data_pasien();
				
				foreach ($data_pasien as $key => $val) {
					$simpan = $this->m_pasien->save($val);
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
		$table = 'm_pasien as pas';
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
		$table = 'm_pasien as pas';
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
	
}