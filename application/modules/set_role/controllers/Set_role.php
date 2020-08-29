<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Set_role extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		//profil data
		$this->load->model('master_user/m_user');
		$this->load->model('m_set_role','m_role');

		if($this->session->userdata('logged_in') === false) {
			return redirect('login');
		}
	}

	public function index()
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);

		$data = array(
			'data_user' => $data_user
		);

		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Pengelolaan Hak Akses User (Role)',
			'title_tabel' => 'Data Hak Akses User',
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
			'modal' => null,
			'js'	=> 'set_role.js',
			'view'	=> 'view_set_role'
		];

		$this->template_view->load_view($content, $data);
	}

	public function list_role()
	{
		$list = $this->m_role->get_datatable_role();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $listRole) {
			$no++;
			$row = array();
			//loop value tabel db
			$row[] = $no;
			$row[] = $listRole->nama;
			$row[] = $listRole->keterangan;
			//add html for action button
			if ($listRole->aktif == 1) {
				$row[] =
					'<a class="btn btn-sm btn-primary" title="Edit" href="'.base_url('set_role/edit_role/'.$listRole->id).'"> Edit</a>
					<button class="btn btn-sm btn-success btn_edit_status" href="javascript:void(0)" title="aktif" id="'.$listRole->id.'" value="aktif">Aktif</i></button>';
				$data[] = $row;
			}else{
				$row[] =
					'<a class="btn btn-sm btn-primary" title="Edit" href="'.base_url('set_role/edit_role/'.$listRole->id).'">Edit</a>
					<button class="btn btn-sm btn-danger btn_edit_status" href="javascript:void(0)" title="nonaktif" id="'.$listRole->id.'" value="nonaktif">Non Aktif</button>';
				$data[] = $row;
			}
			
		}//end loop

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->m_role->count_all(),
						"recordsFiltered" => $this->m_role->count_filtered(),
						"data" => $data,
					);
		//output to json format
		echo json_encode($output);
	}

	public function add()
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);		
		
		$checkboxMenu = "
			<div class='col-sm-12 col-sm-offset-3'>
				<table class='table table-bordered' cellspacing='0' width='100%' style='border: 1px solid black;'>
					<thead>
						<tr>
							<td align='center'>Nama Menu</td>
							<td align='center'>Tambah</td>
							<td align='center'>Ubah</td>
							<td align='center'>Hapus</td>
						</tr>
					</thead>
				<tbody>
		";
	
		$whereMenuSatu = array('id_parent' => '0');
		$orderBy = 'urutan';
		foreach( $this->m_role->show_data_menu($whereMenuSatu,'',$orderBy) as $menuSatu){
			//////////////////////// MENU 1 (PARENT) /////////////////////////////
			$checkboxMenu.= "
				<tr>
					<td>
						<div class='kt-checkbox-inline'>
							<label class='kt-checkbox'>
								<input type='checkbox' value='$menuSatu->id' name='id_menu[]'>".$menuSatu->nama."
								<span></span>
							</label>
						</div>
					</td>";

			if($menuSatu->link != null){
				if($menuSatu->add_button == 1){
					$checkboxMenu.= "
						<td align='center'>
							<div class='kt-checkbox-inline'>
								<label class='kt-checkbox'>
									<input type='checkbox' name='add_".$menuSatu->id."' value='1'>
									<span></span>
								</label>
							</div>
						</td>";
				}
				else{
					$checkboxMenu.= "<td></td>";
				}
				if($menuSatu->edit_button == 1){
					$checkboxMenu.= "
						<td align='center'>
							<div class='kt-checkbox-inline'>
								<label class='kt-checkbox'>
									<input type='checkbox' name='edit_".$menuSatu->id."' value='1'>
									<span></span>
								</label>
							</div>
						</td>";
				}
				else{
					$checkboxMenu.= "<td></td>";
				}
				if($menuSatu->delete_button == 1){
					$checkboxMenu.= "
						<td align='center'>
							<div class='kt-checkbox-inline'>
								<label class='kt-checkbox'>
									<input type='checkbox' name='delete_".$menuSatu->id."' value='1'>
									<span></span>
								</label>
							</div>
						</td>";
				}
				else{
					$checkboxMenu.= "<td></td>";
				}
			}
			else{
				$checkboxMenu.="<td colspan='3'></td>";
			}

			$checkboxMenu.= "</tr>";
			//////////////////////// END MENU 1 (PARENT) /////////////////////////////

			/////////////////////// MENU 2 (Sub-menu1) ///////////////////////////////
			$whereMenuDua = array('id_parent' => $menuSatu->id , 'aktif' => 1);
			foreach( $this->m_role->show_data_menu($whereMenuDua,'',$orderBy) as $menuDua){
				$checkboxMenu.= "
					<tr>
						<td>
							<div class='col-sm-6 col-sm-offset-1'>
								<div class='kt-checkbox-inline'>
									<label class='kt-checkbox'>
										<input type='checkbox' value='".$menuDua->id."' name='id_menu[]'>".$menuDua->nama."
										<span></span>
									</label>
								</div>
							</div>
						</td>";

				if($menuDua->link != null){
					if($menuDua->add_button == 1){
						$checkboxMenu.= "
							<td align='center'>
								<div class='kt-checkbox-inline'>
									<label class='kt-checkbox'>
										<input type='checkbox' name='add_".$menuDua->id."' value='1'>
										<span></span>
									</label>
								</div>
							</td>";
					}
					else{
						$checkboxMenu.= "<td></td>";
					}
					if($menuDua->edit_button == 1){
						$checkboxMenu.= "
							<td align='center'>
								<div class='kt-checkbox-inline'>
									<label class='kt-checkbox'>
										<input type='checkbox' name='edit_".$menuDua->id."' value='1'>
										<span></span>
									</label>
								</div>
							</td>";
					}
					else{
						$checkboxMenu.= "<td></td>";
					}
					if($menuDua->delete_button == 1){
						$checkboxMenu.= "
							<td align='center'>
								<div class='kt-checkbox-inline'>
									<label class='kt-checkbox'>
										<input type='checkbox' name='delete_".$menuDua->id."' value='1'>
										<span></span>
									</label>
								</div>
							</td>";
					}
					else{
						$checkboxMenu.= "<td></td>";
					}

				}
				else{
					$checkboxMenu.="<td colspan='3'></td>";
				}

				$checkboxMenu.= "</tr>";
				/////////////////////// END MENU 2 (Sub-menu1) ////////////////////////////

				//////////////////// MENU 3 (Sub-menu2) ////////////////////////////////////
				$whereMenuTiga = array('id_parent' => $menuDua->id);
				foreach( $this->m_role->show_data_menu($whereMenuTiga) as $menuTiga){
					$checkboxMenu.= "
						<tr>
							<td>
								<div class='col-sm-6 col-sm-offset-2'>
									<div class='kt-checkbox-inline'>
										<label class='kt-checkbox'>
											<input type='checkbox' value='".$menuTiga->id."' name='id_menu[]'>".$menuTiga->nama."
											<span></span>
										</label>
									</div>
								</div>
							</td>";

					if($menuTiga->link!=""){
						if($menuTiga->add_button == 1){
							$checkboxMenu.= "
								<td align='center'>
									<div class='kt-checkbox-inline'>
										<label class='kt-checkbox'>
											<input type='checkbox' name='add_".$menuTiga->id."' value='1'>
											<span></span>
										</label>
									</div>
								</td>";
						}
						else{
							$checkboxMenu.= "<td></td>";
						}
						if($menuTiga->edit_button == 1){
							$checkboxMenu.= "
								<td align='center'>
									<div class='kt-checkbox-inline'>
										<label class='kt-checkbox'>
											<input type='checkbox' name='edit_".$menuTiga->id."' value='1'>
											<span></span>
										</label>
									</div>
								</td>";
						}
						else{
							$checkboxMenu.= "<td></td>";
						}
						if($menuTiga->delete_button == 1){
							$checkboxMenu.= "
								<td align='center'>
									<div class='kt-checkbox-inline'>
										<label class='kt-checkbox'>
											<input type='checkbox' name='delete_".$menuTiga->id."' value='1'>
											<span></span>
										</label>
									</div>
								</td>";
						}
						else{
							$checkboxMenu.= "<td></td>";
						}
					}
					else{
						$checkboxMenu.="<td colspan='3'></td>";
					}

					$checkboxMenu.= "</tr>";
					//////////////////// END MENU 3 (Sub-menu2) ////////////////////////////////////
				}
			}
		}
		$checkboxMenu .= "</tbody></table></div>";

		$data = array(
			'data_user' => $data_user,
			'check_box_menu' => $checkboxMenu,
			'title' => 'Tambah Hak Akses (Role)'
		);

		$content = [
			'modal' 	=> null,
			'js'		=> 'set_role.js',
			'css'		=> null,
			'view'		=> 'view_add_role'
		];

		$this->template_view->load_view($content, $data);
	}

	public function edit_role($id)
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);		
		$where = "id = $id";
		$oldData = $this->m_role->get_data($where, 'm_role');
		
		if(!$oldData){
			redirect($this->uri->segment(1));
		}

		$checkboxMenu = "
			<div class='col-sm-12 col-sm-offset-3'>
				<table class='table table-bordered' cellspacing='0' width='100%' style='border: 1px solid black;'>
					<thead>
						<tr>
							<td align='center'>Nama Menu</td>
							<td align='center'>Tambah</td>
							<td align='center'>Ubah</td>
							<td align='center'>Hapus</td>
						</tr>
					</thead>
				<tbody>
		";
	
		$whereMenuSatu = array('id_parent' => '0');
		$orderBy = 'urutan';
		foreach( $this->m_role->show_data_menu($whereMenuSatu,'',$orderBy) as $menuSatu){
			$whereDataSatu = array('id_role' => $id, 'id_menu' => $menuSatu->id);
			$dataSatu = $this->m_role->get_data_akses($whereDataSatu);

			if($dataSatu){
				$aktifMenuSatu = "checked";
				if($dataSatu->add_button == 1){
					$addAktifSatu = "checked";
				}
				else{
					$addAktifSatu = "";
				}
				if($dataSatu->edit_button == 1){
					$editAktifSatu = "checked";
				}
				else{
					$editAktifSatu = "";
				}
				if($dataSatu->delete_button == 1){
					$deleteAktifSatu = "checked";
				}
				else{
					$deleteAktifSatu = "";
				}
			}
			else{
				$aktifMenuSatu = "";
				$addAktifSatu = "";
				$editAktifSatu = "";
				$deleteAktifSatu = "";
			}

			//////////////////////// MENU 1 (PARENT) /////////////////////////////
			$checkboxMenu.= "
				<tr>
					<td>
						<div class='kt-checkbox-inline'>
							<label class='kt-checkbox'>
								<input ".$aktifMenuSatu." type='checkbox' value='".$menuSatu->id."' name='id_menu[]'>".$menuSatu->nama."
								<span></span>
							</label>
						</div>
					</td>";

			if($menuSatu->link != null){
				if($menuSatu->add_button == 1){
					$checkboxMenu.= "
						<td align='center'>
							<div class='kt-checkbox-inline'>
								<label class='kt-checkbox'>
									<input ".$addAktifSatu." type='checkbox' name='add_".$menuSatu->id."' value='1'>
									<span></span>
								</label>
							</div>
						</td>";
				}
				else{
					$checkboxMenu.= "<td></td>";
				}
				if($menuSatu->edit_button == 1){
					$checkboxMenu.= "
						<td align='center'>
							<div class='kt-checkbox-inline'>
								<label class='kt-checkbox'>
									<input ".$editAktifSatu." type='checkbox' name='edit_".$menuSatu->id."' value='1'>
									<span></span>
								</label>
							</div>
						</td>";
				}
				else{
					$checkboxMenu.= "<td></td>";
				}
				if($menuSatu->delete_button == 1){
					$checkboxMenu.= "
						<td align='center'>
							<div class='kt-checkbox-inline'>
								<label class='kt-checkbox'>
									<input ".$deleteAktifSatu." type='checkbox' name='delete_".$menuSatu->id."' value='1'>
									<span></span>
								</label>
							</div>
						</td>";
				}
				else{
					$checkboxMenu.= "<td></td>";
				}
			}
			else{
				$checkboxMenu.="<td colspan='3'></td>";
			}

			$checkboxMenu.= "</tr>";
			//////////////////////// END MENU 1 (PARENT) /////////////////////////////

			/////////////////////// MENU 2 (Sub-menu1) ///////////////////////////////
			$whereMenuDua = array('id_parent' => $menuSatu->id , 'aktif' => 1);
			foreach( $this->m_role->show_data_menu($whereMenuDua,'',$orderBy) as $menuDua){
				$whereDataDua = array('id_role' => $id, 'id_menu' => $menuDua->id);
				$dataDua = $this->m_role->get_data_akses($whereDataDua);

				if($dataDua){
					$aktifMenuDua = "checked";
					if($dataDua->add_button == 1){
						$addAktifDua = "checked";
					}
					else{
						$addAktifDua = "";
					}
					if($dataDua->edit_button == 1){
						$editAktifDua = "checked";
					}
					else{
						$editAktifDua = "";
					}
					if($dataDua->delete_button == 1){
						$deleteAktifDua = "checked";
					}
					else{
						$deleteAktifDua = "";
					}
				}
				else{
					$aktifMenuDua = "";
					$addAktifDua = "";
					$editAktifDua = "";
					$deleteAktifDua = "";
				}

				$checkboxMenu.= "
					<tr>
						<td>
							<div class='col-sm-6 col-sm-offset-1'>
								<div class='kt-checkbox-inline'>
									<label class='kt-checkbox'>
										<input type='checkbox' ".$aktifMenuDua." value='".$menuDua->id."' name='id_menu[]'>".$menuDua->nama."
										<span></span>
									</label>
								</div>
							</div>
						</td>";

				if($menuDua->link != null){
					if($menuDua->add_button == 1){
						$checkboxMenu.= "
							<td align='center'>
								<div class='kt-checkbox-inline'>
									<label class='kt-checkbox'>
										<input ".$addAktifDua." type='checkbox' name='add_".$menuDua->id."' value='1'>
										<span></span>
									</label>
								</div>
							</td>";
					}
					else{
						$checkboxMenu.= "<td></td>";
					}
					if($menuDua->edit_button == 1){
						$checkboxMenu.= "
							<td align='center'>
								<div class='kt-checkbox-inline'>
									<label class='kt-checkbox'>
										<input ".$editAktifDua." type='checkbox' name='edit_".$menuDua->id."' value='1'>
										<span></span>
									</label>
								</div>
							</td>";
					}
					else{
						$checkboxMenu.= "<td></td>";
					}
					if($menuDua->delete_button == 1){
						$checkboxMenu.= "
							<td align='center'>
								<div class='kt-checkbox-inline'>
									<label class='kt-checkbox'>
										<input type='checkbox' ".$deleteAktifDua." name='delete_".$menuDua->id."' value='1'>
										<span></span>
									</label>
								</div>
							</td>";
					}
					else{
						$checkboxMenu.= "<td></td>";
					}

				}
				else{
					$checkboxMenu.="<td colspan='3'></td>";
				}

				$checkboxMenu.= "</tr>";
				/////////////////////// END MENU 2 (Sub-menu1) ////////////////////////////

				//////////////////// MENU 3 (Sub-menu2) ////////////////////////////////////
				$whereMenuTiga = array('id_parent' => $menuDua->id);
				foreach( $this->m_role->show_data_menu($whereMenuTiga) as $menuTiga){

					$whereDataTiga = array('id_role' => $id, 'id_menu' => $menuTiga->id);
					$dataTiga = $this->m_role->get_data_akses($whereDataTiga);

					if($dataTiga){
						$aktifMenuTiga = "checked";
						if($dataTiga->add_button == 1){
							$addAktifTiga = "checked";
						}
						else{
							$addAktifTiga = "";
						}
						if($dataTiga->edit_button == 1){
							$editAktifTiga = "checked";
						}
						else{
							$editAktifTiga = "";
						}
						if($dataTiga->delete_button == 1){
							$deleteAktifTiga = "checked";
						}
						else{
							$deleteAktifTiga = "";
						}
					}
					else{
						$aktifMenuTiga = "";
						$addAktifTiga = "";
						$editAktifTiga = "";
						$deleteAktifTiga = "";
					}

					$checkboxMenu.= "
						<tr>
							<td>
								<div class='col-sm-6 col-sm-offset-2'>
									<div class='kt-checkbox-inline'>
										<label class='kt-checkbox'>
											<input type='checkbox' ".$aktifMenuTiga." value='".$menuTiga->id."' name='id_menu[]'>".$menuTiga->nama."
											<span></span>
										</label>
									</div>
								</div>
							</td>";

					if($menuTiga->link!=""){
						if($menuTiga->add_button == 1){
							$checkboxMenu.= "
								<td align='center'>
									<div class='kt-checkbox-inline'>
										<label class='kt-checkbox'>
											<input type='checkbox' name='add_".$menuTiga->id."' ".$addAktifTiga." value='1'>
											<span></span>
										</label>
									</div>
								</td>";
						}
						else{
							$checkboxMenu.= "<td></td>";
						}
						if($menuTiga->edit_button == 1){
							$checkboxMenu.= "
								<td align='center'>
									<div class='kt-checkbox-inline'>
										<label class='kt-checkbox'>
											<input type='checkbox' name='edit_".$menuTiga->id."' ".$editAktifTiga." value='1'>
											<span></span>
										</label>
									</div>
								</td>";
						}
						else{
							$checkboxMenu.= "<td></td>";
						}
						if($menuTiga->delete_button == 1){
							$checkboxMenu.= "
								<td align='center'>
									<div class='kt-checkbox-inline'>
										<label class='kt-checkbox'>
											<input type='checkbox' name='delete_".$menuTiga->id."' ".$deleteAktifTiga." value='1'>
											<span></span>
										</label>
									</div>
								</td>";
						}
						else{
							$checkboxMenu.= "<td></td>";
						}
					}
					else{
						$checkboxMenu.="<td colspan='3'></td>";
					}

					$checkboxMenu.= "</tr>";
					//////////////////// END MENU 3 (Sub-menu2) ////////////////////////////////////
				}
			}
		}
		$checkboxMenu .= "</tbody></table></div>";

		$data = array(
			'data_user' => $data_user,
			'old_data'	=> $oldData,
			'check_box_menu' => $checkboxMenu,
			'title' => 'Edit Hak Akses (Role)'
		);

		$content = [
			'modal' 	=> null,
			'js'		=> 'set_role.js',
			'css'		=> null,
			'view'		=> 'view_edit_role'
		];

		$this->template_view->load_view($content, $data);
	}

	public function add_data()
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
		
		$this->form_validation->set_rules('nama_role', '', 'trim|required');
		
		if ($this->form_validation->run() == FALSE)	{
			$this->session->set_flashdata('feedback_gagal','Gagal menyimpan Data, pastikan telah mengisi semua inputan.'); 
			redirect($this->uri->segment(1));
		}else{
			//insert tabel level user / role
			$id_role = $this->m_role->get_max_id_role();
			$input = array(
				'id'  => $id_role,
				'nama' => $this->input->post('nama_role'),
				'keterangan' => $this->input->post('keterangan'),
				'aktif'	=> 1
			);

			$insert = $this->m_role->insert_data($input, 'm_role');
					
			$id_menu = $this->input->post('id_menu');
			// var_dump($id_menu);exit;

			for ($i=0; $i < count($id_menu); $i++) { 	
				$data_hak_akses = [];		
				$data_hak_akses['id_menu'] = $id_menu[$i];
				$data_hak_akses['id_role'] = $id_role;
				if($this->input->post('add_'.$id_menu[$i]) != '') {
					$data_hak_akses['add_button'] = $this->input->post('add_'.$id_menu[$i]);
				}

				if($this->input->post('edit_'.$id_menu[$i]) != '') {
					$data_hak_akses['edit_button'] = $this->input->post('edit_'.$id_menu[$i]);
				}

				if($this->input->post('delete_'.$id_menu[$i]) != '') {
					$data_hak_akses['delete_button'] = $this->input->post('delete_'.$id_menu[$i]);
				}
				
				$ins = $this->m_role->insert_data($data_hak_akses, 't_role_menu');
			}

			$this->session->set_flashdata('feedback_sukses','Berhasil update data role.'); 
			redirect($this->uri->segment(1));
		}
	}

	public function edit_role_data()
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);

		$this->form_validation->set_rules('id_role', '', 'trim|required');
		$this->form_validation->set_rules('nama_role', '', 'trim|required');
		
		if ($this->form_validation->run() == FALSE)	{
			$this->session->set_flashdata('feedback_gagal','Gagal menyimpan Data, pastikan telah mengisi semua inputan.'); 
			redirect($this->uri->segment(1));
		}else{
			//update tabel level user / role
			$input = array(
				'nama' => $this->input->post('nama_role')
			);
			$where = array('id' => $this->input->post('id_role'));
			$query = $this->m_role->update_data($where, $input, 'm_role');
			
			// select data di tbl hak akses dengan role terpilih
			$d_akses = $this->db->query("SELECT * FROM t_role_menu WHERE id_role = '".$this->input->post('id_role')."'")->result();
			
			if($d_akses){
				// delete hak akses sesuai parent yg di update
				$where2 = array('id_role' => $this->input->post('id_role'));
				$this->m_role->delete_data($where2, 't_role_menu');
			}
		
			$id_menu = $this->input->post('id_menu');
			// var_dump($id_menu);exit;

			for ($i=0; $i < count($id_menu); $i++) { 
				$insert = "
					insert into t_role_menu
						(id_menu, id_role, add_button, edit_button, delete_button)
					values (
						'".$id_menu[$i]."',
						'".$this->input->post('id_role')."',
						'".$this->input->post('add_'.$id_menu[$i])."',
						'".$this->input->post('edit_'.$id_menu[$i])."',
						'".$this->input->post('delete_'.$id_menu[$i])."'
					)
				";

				$this->db->query($insert);
			}

			$this->session->set_flashdata('feedback_sukses','Berhasil update data role.'); 
			redirect($this->uri->segment(1));
		}
	}

	public function edit_status_role($id)
	{
		$input_status = $this->input->post('status');
		// jika aktif maka di set ke nonaktif / "0"
		$status = ($input_status == "aktif") ? $status = 0 : $status = 1;

		$input = array(
			'aktif' => $status 
		);

		$where = ['id' => $id];

		$this->m_role->update_data($where, $input, 'm_role');

		if ($this->db->affected_rows() == '1') {
			$data = array(
				'status' => TRUE,
				'pesan' => "Status Role berhasil di ubah.",
			);
		}else{
			$data = array(
				'status' => FALSE
			);
		}

		echo json_encode($data);
	}
	// ==========================	
}
