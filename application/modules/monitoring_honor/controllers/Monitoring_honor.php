<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Carbon\Carbon;
class Monitoring_honor extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') === false) {
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
	

		$data = array(
			'title' => 'Monitoring Honor Dokter',
			'data_user' => $data_user,
		);

		if($this->session->userdata('id_klinik') == null) {
			// administrator
			$where = ['a.deleted_at' => null, 'b.id_jabatan' => 1];
		}else{
			//dokter
			$where = ['a.deleted_at' => null, 'b.id_jabatan' => 1, 'a.id' => $id_user];
		}

		$join = [ 
			[
				'table' => 'm_pegawai as b',
				'on'	=> 'a.id_pegawai = b.id'
			],
		];
		$data['dokter'] = $this->m_global->multi_row('a.*, b.nama as nama_pegawai, b.kode as kode_pegawai',$where, 'm_user a', $join, 'b.nama');
		
		/**
		 * content data untuk template
		 * param (css : link css pada direktori assets/css_module)
		 * param (modal : modal komponen pada modules/nama_modul/views/nama_modal)
		 * param (js : link js pada direktori assets/js_module)
		 */
		$content = [
			'css' 	=> null,
			'modal' => 'pembayaran/modal_detail',
			'js'	=> 'monitoring_honor.js',
			'view'	=> 'view_monitoring'
		];

		$this->template_view->load_view($content, $data);
	}

	public function datatable_monitoring()
	{
		$id_dokter = $this->input->post('id_dokter');
		$start     = $this->input->post('start');
		$end 	   = $this->input->post('end'); 
		
		if ($start) {
			$start = Carbon::createFromFormat('d/m/Y', $start)->format('Y-m-d'); 
		}

		if ($end) {
			$end = Carbon::createFromFormat('d/m/Y', $end)->format('Y-m-d');
		}
		// var_dump($end); die();

		$select = "mut.*, reg.no_reg, reg.tanggal_reg, reg.jam_reg, m_klinik.nama_klinik, m_klinik.alamat, m_pasien.no_rm, m_pasien.nama as nama_pasien, peg.nama as nama_dokter";
		$where = ['mut.id_jenis_trans' => 6, 'mut.deleted_at' => null];
		$table = 't_mutasi as mut';
		$join = [ 
			[
				'table' => 't_registrasi as reg',
				'on'	=> 'mut.id_registrasi = reg.id'
			],
			[
				'table' => 'm_klinik',
				'on'	=> 'reg.id_klinik = m_klinik.id and m_klinik.deleted_at is null'
			],
			[
				'table' => 'm_pasien',
				'on'	=> 'reg.id_pasien = m_pasien.id and m_pasien.deleted_at is null'
			],
			[
				'table' => 'm_pegawai peg',
				'on'	=> 'reg.id_pegawai = peg.id and peg.deleted_at is null'
			],
		];

		$datatable = $this->m_global->multi_row($select,$where,$table, $join);
		// echo $this->db->last_query(); die();
		$data = array();
		$data = [];
		if ($datatable) {
			foreach ($datatable as $key => $value) {
			
				$data[$key][] = $key+1;
				$data[$key][] = Carbon::parse($value->created_at)->format('Y-m-d H:i');
				$data[$key][] = $value->nama_dokter;
				$data[$key][] = $value->nama_klinik;
				$data[$key][] = $value->no_rm;   
				$data[$key][] = number_format($value->total_pengeluaran); 
				$data[$key][] = '
					<button type="button" class="btn btn-sm btn-primary" onclick="detail_trans(\'' . $this->enkripsi->enc_dec('encrypt', $value->id_registrasi) . '\')"> Detail </button>';
			}
		}
		
		// $this->output->enable_profiler(TRUE);

        echo json_encode([
            'data' => $data
        ]);
	}

	public function edit_agen()
	{
		$this->load->library('Enkripsi');
		$id_user = $this->session->userdata('id_user');
		$data_user = $this->m_user->get_by_id($id_user);
	
		$id = $this->input->post('id');
		//$oldData = $this->m_user->get_by_id($id);

		$select = "m_agen.*";
		$where = ['m_agen.id_agen' => $id];
		$table = 'm_agen';
		// $join = [ 
		// 	[
		// 		'table' => 'm_role',
		// 		'on'	=> 'm_user.id_role = m_role.id'
		// 	]
		// ];

		$oldData = $this->m_global->single_row($select, $where, $table);
		
		if(!$oldData){
			return redirect($this->uri->segment(1));
		}
		// var_dump($oldData);exit;
	
		
		$data = array(
			'data_user' => $data_user,
			'old_data'	=> $oldData,
		);
		
		echo json_encode($data);
	}

	public function add_log_harga_jual()
	{
		$this->load->library('Enkripsi');
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$timestamp2 = $obj_date->format('Y-m-d');
		$arr_valid = $this->rule_validasi();
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
		
		$id_barang 	= $this->input->post('id_barang');
		$harga_jual = $this->input->post('harga_jual');

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}

		$this->db->trans_begin();
		
		$data = [
			'id_barang' => $id_barang,
			'harga_jual' => $harga_jual,
			'tanggal'  => $timestamp2,
			'created_by' => $data_user[0]->id
		];
		
		$insert = $this->m_log_harga->save($data);
		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['pesan'] = 'Gagal menambahkan Log Harga';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['pesan'] = 'Sukses menambahkan Log Harga';
		}

		echo json_encode($retval);
	}

	public function update_data_agen()
	{
		$sesi_id_user = $this->session->userdata('id_user'); 
		$id_agen = $this->input->post('id_agen');
		$this->load->library('Enkripsi');
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		
		// if($this->input->post('skip_pass') != null){
		// 	$skip_pass = true;
		// }else{
		// 	$skip_pass = false;
		// }
		
		$arr_valid = $this->rule_validasi(true);

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}

		$nama_pers		= $this->input->post('nama_pers');
		$produk 		= $this->input->post('produk');
		$alamat			= $this->input->post('alamat');
		$telp     		= $this->input->post('telp');
		
		$q = $this->m_agen->get_by_id($id_agen);
		
		$this->db->trans_begin();

		$data_agen = [
			'nama_perusahaan' => $nama_pers,
			'produk' => $produk,
			'alamat' => $alamat,
			'telp' 	=> $telp,
			'updated_at' => $timestamp
		];
		

		$where = ['id_agen' => $id_agen];
		$update = $this->m_agen->update($where, $data_agen);

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$data['status'] = false;
			$data['pesan'] = 'Gagal update Master Agen';
		}else{
			$this->db->trans_commit();
			$data['status'] = true;
			$data['pesan'] = 'Sukses update Master Agen';
		}
		
		echo json_encode($data);
	}

	/**
	 * Hanya melakukan softdelete saja
	 * isi kolom updated_at dengan datetime now()
	 */
	public function delete_agen()
	{
		$id_agen = $this->input->post('id');
		$del = $this->m_agen->softdelete_by_id($id_agen);
		if($del) {
			$retval['status'] = TRUE;
			$retval['pesan'] = 'Data Master Agen berhasil dihapus';
		}else{
			$retval['status'] = FALSE;
			$retval['pesan'] = 'Data Master Agen berhasil dihapus';
		}

		echo json_encode($retval);
	}

	public function edit_status_user($id)
	{
		$input_status = $this->input->post('status');
		// jika aktif maka di set ke nonaktif / "0"
		$status = ($input_status == "aktif") ? $status = 0 : $status = 1;
			
		$input = array('status' => $status);

		$where = ['id' => $id];

		$this->m_user->update($where, $input);

		if ($this->db->affected_rows() == '1') {
			$data = array(
				'status' => TRUE,
				'pesan' => "Status User berhasil di ubah.",
			);
		}else{
			$data = array(
				'status' => FALSE
			);
		}

		echo json_encode($data);
	}

	// ===============================================
	private function rule_validasi($is_update=false, $skip_pass=false)
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		
		
		// if ($this->input->post('icon_menu') == '') {
		// 	$data['inputerror'][] = 'icon_menu';
        //     $data['error_string'][] = 'Wajib mengisi icon menu';
        //     $data['status'] = FALSE;
		// }

		if ($this->input->post('id_barang') == '') {
			$data['inputerror'][] = 'ida-barang';
            $data['error_string'][] = 'Wajib Memilih Barang';
            $data['status'] = FALSE;
		}

		if ($this->input->post('harga_jual') == '') {
			$data['inputerror'][] = 'harga_jual';
            $data['error_string'][] = 'Wajib Mengisi Harga Jual';
            $data['status'] = FALSE;
		}

        return $data;
	}

	private function konfigurasi_upload_img($nmfile)
	{ 
		//konfigurasi upload img display
		$config['upload_path'] = './files/img/barang_img/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
		$config['overwrite'] = TRUE;
		$config['max_size'] = '4000';//in KB (4MB)
		$config['max_width']  = '0';//zero for no limit 
		$config['max_height']  = '0';//zero for no limit
		$config['file_name'] = $nmfile;
		//load library with custom object name alias
		$this->load->library('upload', $config, 'file_obj');
		$this->file_obj->initialize($config);
	}

	private function konfigurasi_image_resize($filename)
	{
		//konfigurasi image lib
	    $config['image_library'] = 'gd2';
	    $config['source_image'] = './files/img/user_img/'.$filename;
	    $config['create_thumb'] = FALSE;
	    $config['maintain_ratio'] = FALSE;
	    $config['new_image'] = './files/img/user_img/'.$filename;
	    $config['overwrite'] = TRUE;
	    $config['width'] = 450; //resize
	    $config['height'] = 500; //resize
	    $this->load->library('image_lib',$config); //load image library
	    $this->image_lib->initialize($config);
	    $this->image_lib->resize();
	}

	private function konfigurasi_image_thumb($filename, $gbr)
	{
		//konfigurasi image lib
	    $config2['image_library'] = 'gd2';
	    $config2['source_image'] = './files/img/user_img/'.$filename;
	    $config2['create_thumb'] = TRUE;
	 	$config2['thumb_marker'] = '_thumb';
	    $config2['maintain_ratio'] = FALSE;
	    $config2['new_image'] = './files/img/user_img/thumbs/'.$filename;
	    $config2['overwrite'] = TRUE;
	    $config2['quality'] = '60%';
	 	$config2['width'] = 45;
	 	$config2['height'] = 45;
	    $this->load->library('image_lib',$config2); //load image library
	    $this->image_lib->initialize($config2);
	    $this->image_lib->resize();
	    return $output_thumb = $gbr['raw_name'].'_thumb'.$gbr['file_ext'];	
	}

	private function seoUrl($string) {
	    //Lower case everything
	    $string = strtolower($string);
	    //Make alphanumeric (removes all other characters)
	    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
	    //Clean up multiple dashes or whitespaces
	    $string = preg_replace("/[\s-]+/", " ", $string);
	    //Convert whitespaces and underscore to dash
	    $string = preg_replace("/[\s_]/", "-", $string);
	    return $string;
	}

	function get_datatable_detail()
    {
		$id_log = $this->input->post('id_log');
		$data_table = $this->m_log_harga->get_datatable_detail($id_log);
		// var_dump($data_table); die();
		$data = [];
        foreach ($data_table as $key => $value) {
			
			$data[$key][] = $key+1;
			$data[$key][] = $value->nama_barang;
			$data[$key][] = 'Rp '.number_format($value->harga_jual); 
			$data[$key][] = $value->tanggal; 
			$data[$key][] = $value->nama_user;     
			// $data[$key][] = $value->jenis_kelamin;
			// $data[0][] = $value->created_at;
			

			
		}
		
		// $this->output->enable_profiler(TRUE);

        echo json_encode([
            'data' => $data
        ]);
	}

	public function monitoring_cart()
	{
		$id_item = $this->input->post('id_pelanggan');
		$id_barang = $this->input->post('id_barang');
		$start = $this->input->post('start');
		$end = $this->input->post('end');
		if ($start) {
			$start = date('Y-d-m', strtotime($start));
		}

		if ($end) {
			$exp_date = str_replace('/', '-', $end);
			$end = date('Y-m-d', strtotime($exp_date));
		}

		$data_where = array('id_pelanggan'=>$id_item);
		$pelanggan = $this->m_global->getSelectedData('m_pelanggan', $data_where)->row();
		$result     = $this->m_pelanggan->monitoring_cart($id_item, $id_barang, $start, $end)->result_array();
		// echo $this->db->last_query(); die();
		// var_dump($result); die();
		$data_mentah    = array();
		$data_label = [];
		foreach ($result as $key) {
            $data_mentah[$key['nama']] = $key['jumlah'];
			$data_label[] = $key['nama'];
        }

		$user   = array($id_item);
		$data['judul'] = "Grafik Penjualan per Pelanggan dengan Toko ".$pelanggan->nama_pembeli;
		// $data['label'] = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
		// $result        = $this->model_app->eksekusi(jumlah_disposisi_user::sql_tahun($usercomma, $tahun2))->result_array();
		$data_mentah   = array();
		foreach ($result as $key) {
		  $data_mentah[$key['nama']] = $key['jumlah'];
		}
		$label          = $data_label;
		$data['data']   = array();
		$data_grafik    = array();

		for ($i=0; $i < count($result); $i++) {
			//   if($i==0) {
				$data_grafik[$i] = array();

				$data_grafik[$i]['label']       = $result[$i]['nama'];
				$data_grafik[$i]['backgroundColor'] = "#".$this->random_color();
				$data_grafik[$i]['fill']        = true;
				
				$data_grafik[$i]['data'] = $result[$i]['total'];

			
		}
		$data['datasets'] = $data_grafik;
		$data['status'] = true;
		echo json_encode($data);
	}

	function random_color(){
		mt_srand((double)microtime()*1000000);
		$c = '';
		while(strlen($c)<6){
		  $c .= sprintf("%02X", mt_rand(0, 255));
		}
		return $c;
	}

	public function get_barang()
	{
		$id = $this->input->post('id_pelanggan');
		$barang = $this->m_pelanggan->get_barang($id);
		echo json_encode($barang);
	}
}
