<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('username') === null) {
			redirect('login');
		}elseif ($this->session->userdata('id_level_user') !== '1') {
			redirect('home/oops');
		}
		$this->load->model('mod_pengguna','user');
		$this->load->model('pesan/mod_pesan','psn');
		//pesan stok dibawah rop
		$this->load->model('Mod_home');
		$barang = $this->Mod_home->get_barang();

		foreach ($barang as $key) {
			if ($key->stok_barang < $key->rop_barang) {
				$this->session->set_flashdata('cek_stok', 'Terdapat Stok Barang dibawah nilai Reorder Point, Mohon di cek ulang / melakukan permintaan');
			}
		}
	}

	public function index()
	{
		$id_user = $this->session->userdata('id_user'); 
		$query = $this->user->get_detail_user($id_user);

		$jumlah_notif = $this->psn->notif_count($id_user);  //menghitung jumlah post
		$notif= $this->psn->get_notifikasi($id_user); //menampilkan isi postingan

		$data = array(
			'content'=>'view_list',
			'css'=>'css',
			'modal'=>'modalPengguna',
			'js'=>'js',
			'title' => 'PT.Surya Putra Barutama',
			'data_user' => $query,
			'qty_notif' => $jumlah_notif,
			'isi_notif' => $notif,
		);
		$this->load->view('view_home',$data);
	}

	public function list_pengguna()
	{
		$list = $this->user->get_datatables();
		$data = array();
		$no =$_POST['start'];
		foreach ($list as $user) {
			$no++;
			$row = array();
			//loop value tabel db
			$row[] = $user->username;
			$row[] = $user->password;
			$row[] = $user->level_user;
			$row[] = $user->status;
			$row[] = $user->last_login;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_user('."'".$user->id_user."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_user('."'".$user->id_user."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			$data[] = $row;
		}//end loop

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->user->count_all(),
						"recordsFiltered" => $this->user->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function edit_pengguna($id)
	{
		$this->load->library('Enkripsi');
		$data = $this->user->get_by_id($id);

		$pass_string = $data->password;
		$hasil_password = $this->enkripsi->decrypt($pass_string);
		$data->password = $hasil_password;
		
		echo json_encode($data);
	}

	public function add_pengguna()
	{
		$this->load->library('Enkripsi');
		$this->_validate();
		$pass_string = $this->input->post('password');
		$hasil_password = $this->enkripsi->encrypt($pass_string);
		//for table tbl_user
		$data_user = array(
				'id_user' => $this->user->getKodeUser(),
				'username' => $this->input->post('username'),
				'id_level_user' => $this->input->post('levelUser'),
				'status' => $this->input->post('statusUser'),
				'password' => $hasil_password,
			);
		//for table tbl_user_detail
		$data_user_detail = array(
				'id_user' => $this->user->getKodeUser(),
			);

		$insert = $this->user->save($data_user, $data_user_detail);
		echo json_encode(array(
			"status" => TRUE,
			"pesan_tambah" => 'Master Pengguna Berhasil ditambahkan',
			));
	}

	public function update_pengguna()
	{
		$this->load->library('Enkripsi');
		$this->_validate();

		$pass_string = $this->input->post('password');
		$hasil_password = $this->enkripsi->encrypt($pass_string);

		$data = array(
				'username' => $this->input->post('username'),
				'password' => $hasil_password,
				'last_login' => $this->input->post('last_login'),
				'status' => $this->input->post('statusUser'),
			);
		$this->user->update(array('id_user' => $this->input->post('id')), $data);
		echo json_encode(array(
			"status" => TRUE,
			"pesan_update" => 'Master Pengguna Berhasil diupdate',
			));
	}

	public function delete_pengguna($id)
	{
		$this->user->delete_by_id($id);
		echo json_encode(array(
			"status" => TRUE,
			"pesan" => 'Data Master Supplier No.'.$id.' Berhasil dihapus',
			));
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('username') == '') {
			$data['inputerror'][] = 'username';
            $data['error_string'][] = 'Username is required';
            $data['status'] = FALSE;
		}
		if($this->input->post('password') == '')
        {
            $data['inputerror'][] = 'password';
            $data['error_string'][] = 'password is required';
            $data['status'] = FALSE;
        }
 		if($this->input->post('levelUser') == '')
        {
            $data['inputerror'][] = 'levelUser';
            $data['error_string'][] = 'Level User is required';
            $data['status'] = FALSE;
        }
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
	}
}
