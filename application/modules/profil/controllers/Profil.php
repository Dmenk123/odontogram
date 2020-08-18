<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('username') === null) {
			redirect('login');
		}
		$this->load->model('mod_profil','prof');
		$this->load->model('master_user/mod_user','m_user');
		$this->load->model('Mod_home');
		$this->load->library('Enkripsi');
	}

	public function detail_pengguna()
	{
		$id_user = $this->uri->segment(3); 
		if ($this->session->userdata('id_level_user') != '5') {
			$query = $this->prof->get_detail_pengguna($id_user);
		}else{
			$query = $this->prof->get_detail_pegawai($id_user);
		}

		$jumlah_notif = $this->psn->notif_count($id_user);  //menghitung jumlah post
		$notif= $this->psn->get_notifikasi($id_user); //menampilkan isi postingan

		$data = array(
			'css'=>'cssProfil',
			'js'=>'jsProfil',
			'content' => 'view_detail_pengguna',
			'title' => 'PT.Surya Putra Barutama',
			'data_user' => $query,
			'qty_notif' => $jumlah_notif,
			'isi_notif' => $notif,
			);
		//var_dump($data['hasil_data']);
		$this->load->view('view_home',$data);
	}

	public function form_detail_pengguna()
	{
		$id_user = $this->uri->segment(3); 
		$query = $this->prof->get_detail_pengguna($id_user);

		$jumlah_notif = $this->psn->notif_count($id_user);  //menghitung jumlah post
		$notif= $this->psn->get_notifikasi($id_user); //menampilkan isi postingan

		$data = array(
			'css'=>'cssProfil',
			'js'=>'jsProfil',
			'content' => 'view_form_detail_pengguna',
			'title' => 'PT.Surya Putra Barutama',
			'data_user' => $query,
			'qty_notif' => $jumlah_notif,
			'isi_notif' => $notif,
			);
		$this->load->view('view_home',$data);
	}

	public function update()
	{
		$id_nama = $this->session->userdata('id_user');
		

        if(isset($_FILES['foto_user'])) {
        	$nmfile = "img_".$id_nama;

			$config['upload_path'] = './assets/img/user_img/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; 
			$config['max_size'] = '2048'; 
	        $config['max_width']  = '0'; 
	        $config['max_height']  = '0';
	        $config['file_name'] = $nmfile; //nama yang terupload nantinya
	        $this->upload->initialize($config);

        	if ($this->upload->do_upload('foto_user')) {
        	 	$gbr = $this->upload->data();
        	 	////[ THUMB IMAGE ]
        	 	$config2['image_library'] = 'gd2';
        	 	$config2['source_image'] = './assets/img/user_img/'.$gbr['file_name'];
        	 	$config2['create_thumb'] = TRUE;
        	 	$config2['thumb_marker'] = '_thumb';
        	 	$config2['maintain_ratio'] = FALSE;
        	 	$config2['overwrite'] = TRUE;
        	 	$config2['quality'] = '60%';
        	 	$config2['width'] = 45;
        	 	$config2['height'] = 45;
        	 	$config2['new_image'] = './assets/img/user_img/thumbs/'.$gbr['file_name'];
        	 	$this->load->library('image_lib',$config2);
        	 	$this->image_lib->initialize($config2); 
        	 	$output_thumb = $gbr['raw_name'].'_thumb'.$gbr['file_ext'];	

        	 	if ( !$this->image_lib->resize()){
                    $this->session->set_flashdata('errors', $this->image_lib->display_errors('', '')); 
        	 	}

        	 	//[ MAIN IMAGE ]
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/img/user_img/'.$gbr['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['new_image'] = './assets/img/user_img/'.$gbr['file_name'];
                $config['overwrite'] = TRUE;
                $config['width'] = 250;
                $config['height'] = 250;
                $this->load->library('image_lib',$config); 
                $this->image_lib->initialize($config);
        	 	
        	 	

        	 	$id = $this->input->post('id_user');
	        		$data = array(
	        		'nama_lengkap_user' =>$this->input->post('nama_lengkap'),
	        		'alamat_user' =>$this->input->post('alamat'),
	        		'tanggal_lahir_user' =>$this->input->post('tanggal_lahir'),
	        		'jenis_kelamin_user' =>$this->input->post('jenis_kelamin'),
	        		'no_telp_user' =>$this->input->post('cp_user'),		
	               	'gambar_user' =>$gbr['file_name'],
		            'thumb_gambar_user' =>$output_thumb, 

	            );
	        	var_dump($data['thumb_gambar_user']);	
	        	if ( !$this->image_lib->resize()){
                    $this->session->set_flashdata('errors', $this->image_lib->display_errors('', '')); 
        	 	}

        	}
        	else 
        	{
        		$id = $this->input->post('id_user');
        		$data = array(
	        		'nama_lengkap_user' =>$this->input->post('nama_lengkap'),
	        		'alamat_user' =>$this->input->post('alamat'),
	        		'tanggal_lahir_user' =>$this->input->post('tanggal_lahir'),
	        		'jenis_kelamin_user' =>$this->input->post('jenis_kelamin'),
	        		'no_telp_user' =>$this->input->post('cp_user'),
	            );
        	}
        	 	
        	$this->prof->update(array('id_user' => $id), $data);

            $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Setting Profil Berhasil !!</div></div>");
            redirect("profil/detail_pengguna/$id");
        	 
        }
	}
	// =============================================================================
	public function index()
	{
		$id_user = $this->session->userdata('id_user');
		if ($this->session->userdata('id_level_user') != '5') {
			$data_user = $this->prof->get_detail_pengguna($id_user);
			$hasil_data = $this->m_user->get_detail_user($id_user);
		}else{
			$data_user = $this->prof->get_detail_pegawai($id_user);
			$hasil_data = $this->m_user->get_detail_pegawai($id_user);
		}
				
		$data = array(
			'data_user' => $data_user,
			'hasil_data' => $hasil_data
		);

		$content = [
			'css' 	=> 'cssProfil',
			'modal' => null,
			'js'	=> 'jsProfil',
			'view'	=> 'view_detail_profil'
		];

		$this->template_view->load_view($content, $data);
	}

	public function edit()
	{
		$id_user = $this->session->userdata('id_user'); 
		
		if ($this->session->userdata('id_level_user') != '5') {
			$data_user = $this->prof->get_detail_pengguna($id_user);
			$hasil_data = $this->m_user->get_detail_user($id_user);
		}else{
			$data_user = $this->prof->get_detail_pegawai($id_user);
			$hasil_data = $this->m_user->get_detail_pegawai($id_user);
		}

		$q_jabatan = $this->db->query("select * from tbl_jabatan where is_aktif = '1' order by nama")->result();
		$data_role = $this->db->query("select * from tbl_level_user where aktif = '1'")->result();
		
		
		$data = array(
			'data_user' => $data_user,
			'data_jabatan' => $q_jabatan,
			'data_role' => $data_role,
			'hasil_data' => $hasil_data
		);

		if ($this->session->userdata('id_level_user') == '5') {
			$content = [
				'css' 	=> 'cssProfil',
				'modal' => null,
				'js'	=> 'jsProfil',
				'view'	=> 'view_edit_master_pegawai'
			];
		}else{
			$content = [
				'css' 	=> 'cssProfil',
				'modal' => null,
				'js'	=> 'jsProfil',
				'view'	=> 'view_edit_master_user'
			];
		}

		$this->template_view->load_view($content, $data);
	}

	public function update_data_user()
	{
		$flag_upload_foto = FALSE;
		$flag_ganti_pass = FALSE;
		$arr_valid = $this->_validate();

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
		}

		$username = trim(strtoupper($this->input->post('username')));
		$namalengkap = $this->input->post('namalengkap');
		$hari = $this->input->post('hari');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$alamat = trim($this->input->post('alamat'));
		$jenkel = $this->input->post('jenkel');
		$telp = $this->input->post('telp');
		$id_user = $this->input->post('id');
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

	public function update_data_pegawai()
	{
		$flag_upload_foto = FALSE;
		$flag_ganti_pass = FALSE;
		$arr_valid = $this->_validate();

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
		}

		$username = trim(strtoupper($this->input->post('username')));
		$namalengkap = $this->input->post('namalengkap');
		$hari = $this->input->post('hari');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$alamat = trim($this->input->post('alamat'));
		$jenkel = $this->input->post('jenkel');
		$tempatlahir = $this->input->post('tempatlahir');
		$id_user = $this->input->post('id');
		$namafileseo = $this->seoUrl($username.' '.time());
		$output_thumb = '';
		

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}

		$this->db->trans_begin();

		if(!empty($_FILES['gambar']['name']))
		{
			$this->konfigurasi_upload_bukti_peg($namafileseo);
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
				$this->konfigurasi_image_resize_peg($nama_file_foto);
				//clear img lib after resize
				$this->image_lib->clear();
			} //end
		}

		//data detail
		$data_detail = array(
			'nama' => trim($namalengkap),
			'alamat' => $alamat,
			'tanggal_lahir' => date('Y-m-d', strtotime($tahun.'-'.$bulan.'-'.$hari)),
			'jenis_kelamin' => $jenkel,
			'tempat_lahir' => trim($tempatlahir)
		);

		if ($flag_upload_foto) {
			$data_detail['foto'] = $nama_file_foto;
		}

		$this->m_user->update('tbl_guru', ['id' => $id_user], $data_detail);

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$this->session->set_flashdata('feedback_failed','Gagal Update Master Pegawai/Staff.'); 
		}
		else {
			$this->db->trans_commit();
			$this->session->set_flashdata('feedback_success','Berhasil Update Master Pegawai/Staff'); 
		}

		echo json_encode(array(
			"status" => TRUE,
			"pesan" => 'Master Pegawai/Staff Berhasil diupdate',
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

	public function konfigurasi_upload_bukti_peg($nmfile)
	{ 
		//konfigurasi upload img display
		$config['upload_path'] = './assets/img/foto_guru/';
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

	public function konfigurasi_image_resize_peg($filename)
	{
		//konfigurasi image lib
	    $config['image_library'] = 'gd2';
	    $config['source_image'] = './assets/img/foto_guru/'.$filename;
	    $config['create_thumb'] = FALSE;
	    $config['maintain_ratio'] = FALSE;
	    $config['new_image'] = './assets/img/foto_guru/'.$filename;
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

		if ($this->session->userdata('id_level_user') == '5') {
			if ($this->input->post('tempatlahir') == '') {
				$data['inputerror'][] = 'tempatlahir';
	            $data['error_string'][] = 'Wajib mengisi Tempat Lahir';
	            $data['status'] = FALSE;
			}
		}else{
			if ($this->input->post('telp') == '') {
				$data['inputerror'][] = 'telp';
	            $data['error_string'][] = 'Wajib mengisi Nomor Telepon';
	            $data['status'] = FALSE;
			}
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
