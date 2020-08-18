<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_user extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		//profil data
		$this->load->model('profil/mod_profil','prof');
		$this->load->model('mod_user','m_user');
		$this->load->library('Enkripsi');
	}

	public function index()
	{	
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->prof->get_detail_pengguna($id_user);

		$data = array(
			'data_user' => $data_user
		);

		$content = [
			'css' 	=> 'cssMasterUser',
			'modal' => null,
			'js'	=> 'jsMasterUser',
			'view'	=> 'view_list_master_user'
		];

		$this->template_view->load_view($content, $data);
	}

	public function list_user()
	{
		$list = $this->m_user->get_datatables();
		$data = array();
		$no =$_POST['start'];
		foreach ($list as $val) {
			$link_detail = site_url('master_user/detail/').$val->id_user;
			// $no++;
			$row = array();
			$row[] = '<img src="'.base_url().'/assets/img/user_img/thumbs/'.$val->thumb_gambar_user.'">';
			$row[] = $val->id_user;
			$row[] = $val->username;
			$row[] = $val->nama_level_user;
			$row[] = $val->nama_lengkap_user;

			//add html for action
			$row[] = '
				<a class="btn btn-sm btn-success" href="'.$link_detail.'" title="Detail" id="btn_detail">
					<i class="glyphicon glyphicon-info-sign"></i>
				</a>
				<a class="btn btn-sm btn-primary" href="'.base_url('master_user/edit/').$val->id_user.'" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
				<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_user('."'".$val->id_user."'".')"><i class="glyphicon glyphicon-trash"></i></a>
			';

			$data[] = $row;
		}//end loop

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_user->count_all(),
			"recordsFiltered" => $this->m_user->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function detail($id)
	{
		$data = $this->m_user->get_detail_user($id);
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->prof->get_detail_pengguna($id_user);
		
		$data = array(
			'data_user' => $data_user,
			'hasil_data' => $data
		);

		$content = [
			'css' 	=> 'cssMasterUser',
			'modal' => null,
			'js'	=> 'jsMasterUser',
			'view'	=> 'view_detail_master_user'
		];

		$this->template_view->load_view($content, $data);
	}

	public function add()
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->prof->get_detail_pengguna($id_user);
		$q_jabatan = $this->db->query("select * from tbl_jabatan where is_aktif = '1' order by nama")->result();
		$data_role = $this->db->query("select * from tbl_level_user where aktif = '1'")->result();
		
		$data = array(
			'data_user' => $data_user,
			'data_jabatan' => $q_jabatan,
			'data_role' => $data_role
		);

		$content = [
			'css' 	=> 'cssMasterUser',
			'modal' => null,
			'js'	=> 'jsMasterUser',
			'view'	=> 'view_add_master_user'
		];

		$this->template_view->load_view($content, $data);
	}

	public function suggest_jabatan()
	{
		if (isset($_GET['term'])) {
			$q = strtolower($_GET['term']);
		}else{
			$q = '';
		}
		
		$query = $this->m_guru->lookup_kode_jabatan($q);
		
		foreach ($query as $row) {
			$akun[] = array(
				'id' => $row->id,
				'text' => $row->nama
			);
		}
		echo json_encode($akun);
	}

	public function add_data()
	{
		$arr_valid = $this->_validate();

		$username = trim(strtoupper($this->input->post('username')));
		$password = $this->input->post('password');
		$repassword = $this->input->post('repassword');
		$hasil_password = $this->enkripsi->encrypt($password);
		$role = trim($this->input->post('role'));
		$namalengkap = $this->input->post('namalengkap');
		$hari = $this->input->post('hari');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$alamat = trim($this->input->post('alamat'));
		$jenkel = $this->input->post('jenkel');
		$telp = $this->input->post('telp');
		$id_user = $this->prof->getKodeUser();
		$namafileseo = $this->seoUrl($username.' '.time());
		$output_thumb = '';

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}

		if ($this->input->post('ceklistpwd') != 'Y') {
			if ($password != $repassword) {
				$this->session->set_flashdata('feedback_failed','Terdapat ketidak cocokan Password'); 
				echo json_encode(['status' => true]);
				return;
			}
		}

		$this->db->trans_begin();

		if(!empty($_FILES['gambar']['name']))
		{
			$this->konfigurasi_upload_bukti($namafileseo);
			//get detail extension
			$pathDet = $_FILES['gambar']['name'];
			$extDet = pathinfo($pathDet, PATHINFO_EXTENSION);
			if ($this->gbr_bukti->do_upload('gambar')) 
			{
				$gbrBukti = $this->gbr_bukti->data();
				//inisiasi variabel u/ digunakan pada fungsi config img bukti
				$nama_file_foto = $gbrBukti['file_name'];
				//load config img
				$this->konfigurasi_image_resize($nama_file_foto);
				//load config img thumbs
				$output_thumb = $this->konfigurasi_image_thumb($nama_file_foto, $gbrBukti);
				//clear img lib after resize
				$this->image_lib->clear();
			} //end
		}else{
			$this->db->trans_rollback();
			$this->session->set_flashdata('feedback_failed','Mohon Lengkapi Kelengkapan Data'); 
			echo json_encode(array(
				"status" => true
			));
			return;
		}

		//data header
		$data_header = [
			'id_user' => $id_user,
			'username' => $username,
			'password' => $hasil_password,
			'id_level_user' => $role,
			'id_pegawai' => null,
			'status' => 1,
			'last_login' => null,
			'created_at' => date('Y-m-d H:i:s')
		];

		$insert_header = $this->m_user->save('tbl_user', $data_header);

		//data detail
		$data_detail = array(
			'id_user' => $id_user,
			'nama_lengkap_user' => trim($namalengkap),
			'alamat_user' => $alamat,
			'tanggal_lahir_user' => date('Y-m-d', strtotime($tahun.'-'.$bulan.'-'.$hari)),
			'jenis_kelamin_user' => $jenkel,
			'no_telp_user' => trim($telp),
			'gambar_user' => $nama_file_foto,
			'thumb_gambar_user' => $output_thumb
		);

		$insert_detail = $this->m_user->save('tbl_user_detail', $data_detail);
		

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$this->session->set_flashdata('feedback_failed','Gagal Buat Master User.'); 
		}
		else {
			$this->db->trans_commit();
			$this->session->set_flashdata('feedback_success','Berhasil Buat Master User'); 
		}

		echo json_encode(array(
			"status" => TRUE,
			"pesan" => 'Master User Berhasil ditambahkan',
		));
	}

	public function edit($id)
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->prof->get_detail_pengguna($id_user);
		$q_jabatan = $this->db->query("select * from tbl_jabatan where is_aktif = '1' order by nama")->result();
		$data_role = $this->db->query("select * from tbl_level_user where aktif = '1'")->result();
		$data = $this->m_user->get_detail_user($id);
		
		$data = array(
			'data_user' => $data_user,
			'data_jabatan' => $q_jabatan,
			'data_role' => $data_role,
			'hasil_data' => $data
		);

		$content = [
			'css' 	=> 'cssMasterUser',
			'modal' => null,
			'js'	=> 'jsMasterUser',
			'view'	=> 'view_add_master_user'
		];

		$this->template_view->load_view($content, $data);
	}

	public function update_data()
	{
		$flag_upload_foto = FALSE;
		$flag_ganti_pass = FALSE;
		$flag_guru = FALSE;

		$arr_valid = $this->_validate();
		$id_level_user = $this->session->userdata('id_level_user');
		$id_user = $this->input->post('id');
		$flag_guru = ($id_level_user != '5') ? false : true;
		
		if ($flag_guru) {
			$pass_lama = $this->prof->cek_pass_lama('guru', $id_user);
			
			if ($pass_lama['flag_pass_guru'] == 'nip') {
				$pass_lama_txt = $pass_lama['password'];
			}else{
				$pass_lama_txt = $this->enkripsi->decrypt($pass_lama['password']);
			}
		}else{
			$pass_lama = $this->prof->cek_pass_lama('user', $id_user);
			$pass_lama_txt = $this->enkripsi->decrypt($pass_lama['password']);
		}

		if ($this->input->post('ceklistpwd') != 'Y') {
			$flag_ganti_pass = TRUE;
			$password = $this->input->post('password');
			$repassword = $this->input->post('repassword');
			$passwordnew = $this->input->post('passwordnew');
			$hasil_password = $this->enkripsi->encrypt($passwordnew);

			if ($password != $repassword) {
				$this->session->set_flashdata('feedback_failed','Terdapat ketidak cocokan Password Lama'); 
				echo json_encode(['status' => true]);
				return;
			}

			if ($repassword != $pass_lama_txt) {
				$this->session->set_flashdata('feedback_failed','Terdapat ketidak cocokan Password Lama'); 
				echo json_encode(['status' => true]);
				return;
			}
		}

		$username = trim(strtoupper($this->input->post('username')));
		$role = trim($this->input->post('role'));
		$namalengkap = $this->input->post('namalengkap');
		$hari = $this->input->post('hari');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$alamat = trim($this->input->post('alamat'));
		$jenkel = $this->input->post('jenkel');
		$telp = $this->input->post('telp');
		$namafileseo = $this->seoUrl($username.' '.time());
		$output_thumb = '';
		

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}

		$this->db->trans_begin();

		if(!empty($_FILES['gambar']['name']))
		{
			$this->konfigurasi_upload_bukti($namafileseo);
			//get detail extension
			$pathDet = $_FILES['gambar']['name'];
			$extDet = pathinfo($pathDet, PATHINFO_EXTENSION);
			if ($this->gbr_bukti->do_upload('gambar')) 
			{
				$flag_upload_foto = TRUE;
				$gbrBukti = $this->gbr_bukti->data();
				//inisiasi variabel u/ digunakan pada fungsi config img bukti
				$nama_file_foto = $gbrBukti['file_name'];
				//load config img
				$this->konfigurasi_image_resize($nama_file_foto);
				//load config img thumbs
				$output_thumb = $this->konfigurasi_image_thumb($nama_file_foto, $gbrBukti);
				//clear img lib after resize
				$this->image_lib->clear();
			} //end
		}

		//data detail
		$data_detail = array(
			'nama_lengkap_user' => trim($namalengkap),
			'alamat_user' => $alamat,
			'tanggal_lahir_user' => date('Y-m-d', strtotime($tahun.'-'.$bulan.'-'.$hari)),
			'jenis_kelamin_user' => $jenkel,
			'no_telp_user' => trim($telp)
		);

		if ($flag_upload_foto) {
			$data_detail['gambar_user'] = $nama_file_foto;
			$data_detail['thumb_gambar_user'] = $output_thumb;
		}

		$this->m_user->update('tbl_user_detail', ['id_user' => $id_user], $data_detail);

		//data header
		$data_header = [
			'username' => $username,
			'id_level_user' => $role,
			'id_pegawai' => null,
			'status' => 1,
			'last_login' => null,
			'updated_at' => date('Y-m-d H:i:s')
		];

		if ($flag_ganti_pass) {
			$data_header['password'] = $hasil_password;
 		}

		$this->m_user->update('tbl_user', ['id_user' => $id_user], $data_header);

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$this->session->set_flashdata('feedback_failed','Gagal Update Master User.'); 
		}
		else {
			$this->db->trans_commit();
			$this->session->set_flashdata('feedback_success','Berhasil Update Master User'); 
		}

		echo json_encode(array(
			"status" => TRUE,
			"pesan" => 'Master User Berhasil diupdate',
		));
	}

	public function delete_user($id)
	{
		// $this->m_guru->delete_by_id($id);
		$this->db->trans_begin();
		$this->m_user->update('tbl_user', ['id_user' => $id], ['status '=> 0]);
		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$this->session->set_flashdata('feedback_failed','Gagal Hapus Master User.'); 
		}
		else {
			$this->db->trans_commit();
			$this->session->set_flashdata('feedback_success','Berhasil Hapus Master User'); 
		}

		echo json_encode(array(
			"status" => TRUE,
			"pesan" => 'Data Master User Berhasil dihapus',
		));
	}

	public function konfigurasi_upload_bukti($nmfile)
	{ 
		//konfigurasi upload img display
		$config['upload_path'] = './assets/img/user_img/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
		$config['overwrite'] = TRUE;
		$config['max_size'] = '4000';//in KB (4MB)
		$config['max_width']  = '0';//zero for no limit 
		$config['max_height']  = '0';//zero for no limit
		$config['file_name'] = $nmfile;
		//load library with custom object name alias
		$this->load->library('upload', $config, 'gbr_bukti');
		$this->gbr_bukti->initialize($config);
	}

	public function konfigurasi_image_resize($filename)
	{
		//konfigurasi image lib
	    $config['image_library'] = 'gd2';
	    $config['source_image'] = './assets/img/user_img/'.$filename;
	    $config['create_thumb'] = FALSE;
	    $config['maintain_ratio'] = FALSE;
	    $config['new_image'] = './assets/img/user_img/'.$filename;
	    $config['overwrite'] = TRUE;
	    $config['width'] = 450; //resize
	    $config['height'] = 500; //resize
	    $this->load->library('image_lib',$config); //load image library
	    $this->image_lib->initialize($config);
	    $this->image_lib->resize();
	}

	public function konfigurasi_image_thumb($filename, $gbr)
	{
		//konfigurasi image lib
	    $config2['image_library'] = 'gd2';
	    $config2['source_image'] = './assets/img/user_img/'.$filename;
	    $config2['create_thumb'] = TRUE;
	 	$config2['thumb_marker'] = '_thumb';
	    $config2['maintain_ratio'] = FALSE;
	    $config2['new_image'] = './assets/img/user_img/thumbs/'.$filename;
	    $config2['overwrite'] = TRUE;
	    $config2['quality'] = '60%';
	 	$config2['width'] = 45;
	 	$config2['height'] = 45;
	    $this->load->library('image_lib',$config2); //load image library
	    $this->image_lib->initialize($config2);
	    $this->image_lib->resize();
	    return $output_thumb = $gbr['raw_name'].'_thumb'.$gbr['file_ext'];	
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('username') == '') {
			$data['inputerror'][] = 'username';
            $data['error_string'][] = 'Wajib mengisi username';
            $data['status'] = FALSE;
		}

		if ($this->input->post('ceklistpwd') != 'Y') {
			if ($this->input->post('password') == '') {
				$data['inputerror'][] = 'password';
	            $data['error_string'][] = 'Wajib mengisi password';
	            $data['status'] = FALSE;
			}

			if ($this->input->post('repassword') == null) {
				$data['inputerror'][] = 'repassword';
	            $data['error_string'][] = 'Wajib mengisi ulang Password';
	            $data['status'] = FALSE;
			}

			if ($this->input->post('passwordnew') == null) {
				$data['inputerror'][] = 'passwordnew';
	            $data['error_string'][] = 'Wajib mengisi ulang Password Baru';
	            $data['status'] = FALSE;
			}
		}

		if ($this->input->post('role') == '') {
			$data['inputerror'][] = 'role';
            $data['error_string'][] = 'Wajib mengisi role';
            $data['status'] = FALSE;
		}

		if ($this->input->post('namalengkap') == '') {
			$data['inputerror'][] = 'namalengkap';
            $data['error_string'][] = 'Wajib mengisi namalengkap';
            $data['status'] = FALSE;
		}

		if ($this->input->post('hari') == '') {
			$data['inputerror'][] = 'hari';
            $data['error_string'][] = 'Wajib mengisi hari';
            $data['status'] = FALSE;
		}

		if ($this->input->post('bulan') == '') {
			$data['inputerror'][] = 'bulan';
            $data['error_string'][] = 'Wajib mengisi bulan';
            $data['status'] = FALSE;
		}

		if ($this->input->post('tahun') == '') {
			$data['inputerror'][] = 'tahun';
            $data['error_string'][] = 'Wajib mengisi tahun';
            $data['status'] = FALSE;
		}

		if ($this->input->post('alamat') == '') {
			$data['inputerror'][] = 'alamat';
            $data['error_string'][] = 'Wajib mengisi tipe alamat';
            $data['status'] = FALSE;
		}

		if ($this->input->post('jenkel') == '') {
			$data['inputerror'][] = 'jenkel';
            $data['error_string'][] = 'Wajib mengisi jenkel';
            $data['status'] = FALSE;
		}

		if ($this->input->post('telp') == '') {
			$data['inputerror'][] = 'telp';
            $data['error_string'][] = 'Wajib mengisi Nomor Telepon';
            $data['status'] = FALSE;
		}
			
        return $data;
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
}
