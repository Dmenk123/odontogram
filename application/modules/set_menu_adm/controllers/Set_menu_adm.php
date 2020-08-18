<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Set_menu_adm extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		//profil data
		$this->load->model('profil/mod_profil','prof');
		$this->load->model('mod_set_menu_adm','m_menu');
	}

	public function index()
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->prof->get_detail_pengguna($id_user);

		$data = array(
			'data_user' => $data_user
		);

		$content = [
			'css' 	=> 'setMenuAdmCss',
			'modal' => 'modalSetMenuAdm',
			'js'	=> 'setMenuAdmJs',
			'view'	=> 'view_list_set_menu'
		];

		$this->template_view->load_view($content, $data);
	}

	public function list_menu()
	{
		$list = $this->m_menu->get_datatable_menu();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $listMenu) {
			$no++;
			$row = array();
			//loop value tabel db
			$row[] = $no;
			$row[] = $listMenu->id_menu;
			$row[] = $listMenu->id_parent;
			$row[] = $listMenu->nama_menu;
			$row[] = $listMenu->link_menu;
			$aktif_txt = ($listMenu->aktif_menu == 1) ? 'Aktif' : 'Nonaktif';
			$row[] = $aktif_txt;
			//add html for action button

			if ($listMenu->aktif_menu == 1) {
				$row[] =
				'<a class="btn btn-sm btn-primary" title="Edit" href="'.base_url('set_menu_adm/edit_menu/'.$listMenu->id_menu).'"><i class="glyphicon glyphicon-pencil"></i></a>
				 <button class="btn btn-sm btn-success btn_edit_status" href="javascript:void(0)" title="aktif" id="'.$listMenu->id_menu.'" value="aktif"><i class="fa fa-times"></i></button>';
			}else{
				$row[] =
				'<a class="btn btn-sm btn-primary" title="Edit" href="'.base_url('set_menu_adm/edit_menu/'.$listMenu->id_menu).'"><i class="glyphicon glyphicon-pencil"></i></a>
				 <button class="btn btn-sm btn-danger btn_edit_status" href="javascript:void(0)" title="nonaktif" id="'.$listMenu->id_menu.'" value="nonaktif"><i class="fa fa-check"></i></button>';
			}
			
			$data[] = $row;
		}//end loop

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->m_menu->count_all(),
						"recordsFiltered" => $this->m_menu->count_filtered(),
						"data" => $data,
					);
		//output to json format
		echo json_encode($output);
	}

	public function add_data_menu()
	{
		$this->db->trans_begin();
		$input = [
			'id_menu' => $this->m_menu->get_max_id(),
			'id_parent' => $this->input->post('id_parent'),
			'nama_menu' => $this->input->post('nama_menu'),
			'judul_menu' => $this->input->post('judul_menu'),
			'link_menu' => $this->input->post('link_menu'),
			'icon_menu' => $this->input->post('icon_menu'),
			'tingkat_menu' => $this->input->post('tingkat_menu'),
			'urutan_menu' => $this->input->post('urutan_menu'),
			'aktif_menu' => $this->input->post('aktif_menu'),
			'add_button' => $this->input->post('add_button'),
			'edit_button' => $this->input->post('edit_button'),
			'delete_button' => $this->input->post('delete_button')
		];

		$insert = $this->m_menu->insert_data_menu($input);
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$data['status'] = false;
			$data['pesan'] = 'Gagal menambahkan menu';
		}else{
			$this->db->trans_commit();
			$data['status'] = true;
			$data['pesan'] = 'Sukses menambahkan menu';
		}

		echo json_encode($data);
	}

	public function edit_menu($id)
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->prof->get_detail_pengguna($id_user);		
		$whereOld = "id_menu = $id";
		$oldData = $this->m_menu->get_data($whereOld, 'tbl_menu');
	
		if(!$oldData){
			redirect($this->uri->segment(1));
		}

		$order_by = 'id_parent, urutan_menu';
		$data_menu = $this->m_menu->show_data_menu("","",$order_by);

		$data = array(
			'data_user' => $data_user,
			'oldData'		=> $oldData,
			'data_menu'	=> $data_menu
		);

		$content = [
			'modal' => false,
			'js'		=> false,
			'css'		=> 'setMenuAdmCss',
			'view'	=> 'view_list_edit_menu'
		];

		$this->template_view->load_view($content, $data);
	}

	public function edit_menu_data()
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->prof->get_detail_pengguna($id_user);
		
		$this->form_validation->set_rules('id_menu', '', 'trim|required');
		$this->form_validation->set_rules('nama_menu', '', 'trim|required');
		$this->form_validation->set_rules('judul_menu', '', 'trim|required');
		$this->form_validation->set_rules('link_menu', '', 'trim|required');
		$this->form_validation->set_rules('tingkat_menu', '', 'trim|required');
		$this->form_validation->set_rules('urutan_menu', '', 'trim|required');
		
		if ($this->form_validation->run() == FALSE)	{
			$this->session->set_flashdata('feedback_failed','Gagal menyimpan Data, pastikan telah mengisi semua inputan.'); 
			redirect($this->uri->segment(1));
		}else{
			//update tabel level menu
			$input = array(
				'id_parent' => $this->input->post('id_parent'),
				'nama_menu' => $this->input->post('nama_menu'),
				'judul_menu' => $this->input->post('judul_menu'),
				'link_menu' => $this->input->post('link_menu'),
				'icon_menu' => $this->input->post('icon_menu'),
				'aktif_menu' => $this->input->post('aktif_menu'),
				'tingkat_menu' => $this->input->post('tingkat_menu'),
				'urutan_menu' => $this->input->post('urutan_menu'),
				'add_button' => $this->input->post('add_button'),
				'edit_button' => $this->input->post('edit_button'),
				'delete_button' => $this->input->post('delete_button')
			);
			$where = array('id_menu' => $this->input->post('id_menu'));
			$query = $this->m_menu->update_data_menu($where, $input, 'tbl_menu');
			if ($this->db->affected_rows() == '1') {
				$this->session->set_flashdata('feedback_success','Berhasil update data menu.'); 
				redirect($this->uri->segment(1));
			}else{
				$this->session->set_flashdata('feedback_failed','Gagal update data menu.'); 
				redirect($this->uri->segment(1));
			}
		}
	}
	
	public function edit_status_menu($id)
	{
		$input_status = $this->input->post('status');
		// jika aktif maka di set ke nonaktif / "0"
		$status = ($input_status == "aktif") ? $status = 0 : $status = 1;
			
		$input = array(
			'aktif_menu' => $status 
		);

		$where = array('id_menu' => $id);
		$this->m_menu->update_data_menu($where, $input, 'tbl_menu');
		if ($this->db->affected_rows() == '1') {
			$data = array(
				'status' => TRUE,
				'pesan' => "Status menu dengan kode ".$id." berhasil di ubah.",
			);
		}else{
			$data = array(
				'status' => FALSE
			);
		}

		echo json_encode($data);
	}

	public function get_parent_data()
	{
		$q = $this->m_menu->show_data_menu();
		$data = array(
			'status' => TRUE,
			'data' => $q,
		);
		echo json_encode($data);
	}
	// ==========================	
}
