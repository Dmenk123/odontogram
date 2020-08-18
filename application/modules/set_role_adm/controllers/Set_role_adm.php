<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Set_role_adm extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		//profil data
		$this->load->model('profil/mod_profil','prof');
		$this->load->model('mod_set_role_adm','m_role');
	}

	public function index()
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->prof->get_detail_pengguna($id_user);

		$data = array(
			'data_user' => $data_user
		);

		$content = [
			'css' => false,
			'modal' => 'modalSetRoleAdm',
			'js'		=> 'setRoleAdmJs',
			'view'	=> 'view_list_set_role'
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
			$row[] = $listRole->nama_level_user;
			$row[] = $listRole->keterangan_level_user;
			//add html for action button
			if ($listRole->aktif == 1) {
				$row[] =
					'<a class="btn btn-sm btn-primary" title="Edit" href="'.base_url('set_role_adm/edit_role/'.$listRole->id_level_user).'"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					 <a class="btn btn-sm btn-success btn_edit_status" href="javascript:void(0)" title="aktif" id="'.$listRole->id_level_user.'"><i class="fa fa-check"></i> Aktif</a>';
				$data[] = $row;
			}else{
				$row[] =
					'<a class="btn btn-sm btn-primary" title="Edit" href="'.base_url('set_role_adm/edit_role/'.$listRole->id_level_user).'"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					 <a class="btn btn-sm btn-danger btn_edit_status" href="javascript:void(0)" title="nonaktif" id="'.$listRole->id_level_user.'"><i class="fa fa-times"></i> Nonaktif</a>';
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

	public function edit_role($id)
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->prof->get_detail_pengguna($id_user);		
		$where = "id_level_user = $id";
		$oldData = $this->m_role->get_data($where, 'tbl_level_user');
		
		if(!$oldData){
			redirect($this->uri->segment(1));
		}

		$checkboxMenu = "
			<div class='col-sm-9 col-sm-offset-3'>
				<table class='table table-bordered' cellspacing='0' width='100%' style='border: 1px solid black;'>
					<thead>
						<tr>
							<td align='center'>
								<div class='checkbox'>
									<label>
										<input type='checkbox' id='checkAllDelete' onclick='checkAllDeleteButton()'> &nbsp;Nama Menu
									</label>
								</div>
							</td>
							<td>Tambah</td>
							<td>Ubah</td>
							<td>Hapus</td>
						</tr>
					</thead>
				<tbody>
		";
	
		$whereMenuSatu = array('id_parent' => '0');
		$orderBy = 'urutan_menu';
		foreach( $this->m_role->show_data_menu($whereMenuSatu,'',$orderBy) as $menuSatu){
			$whereDataSatu = array('id_level_user' => $id, 'id_menu' => $menuSatu->id_menu);
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
						<div class='checkbox'>
							<label>
								<input ".$aktifMenuSatu." type='checkbox' value='".$menuSatu->id_menu."' name='id_menu[]'>".$menuSatu->nama_menu."
							</label>
						</div>
					</td>";

			if($menuSatu->link_menu != null){
				if($menuSatu->add_button == 1){
					$checkboxMenu.= "
						<td align='center'>
							<input ".$addAktifSatu." type='checkbox' name='add_".$menuSatu->id_menu."' value='1'>
						</td>";
				}
				else{
					$checkboxMenu.= "<td></td>";
				}
				if($menuSatu->edit_button == 1){
					$checkboxMenu.= "
						<td align='center'>
							<input ".$editAktifSatu." type='checkbox' name='edit_".$menuSatu->id_menu."' value='1'>
						</td>";
				}
				else{
					$checkboxMenu.= "<td></td>";
				}
				if($menuSatu->delete_button == 1){
					$checkboxMenu.= "
						<td align='center'>
							<input ".$deleteAktifSatu." type='checkbox' name='delete_".$menuSatu->id_menu."' value='1'>
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
			$whereMenuDua = array('id_parent' => $menuSatu->id_menu , 'aktif_menu' => 1);
			foreach( $this->m_role->show_data_menu($whereMenuDua,'',$orderBy) as $menuDua){
				$whereDataDua = array('id_level_user' => $id, 'id_menu' => $menuDua->id_menu);
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
								<div class='checkbox'>
									<label>
										<input type='checkbox' ".$aktifMenuDua." value='".$menuDua->id_menu."' name='id_menu[]'>".$menuDua->nama_menu."
									</label>
								</div>
							</div>
						</td>";

				if($menuDua->link_menu != null){
					if($menuDua->add_button == 1){
						$checkboxMenu.= "
							<td align='center'>
								<input ".$addAktifDua." type='checkbox' name='add_".$menuDua->id_menu."' value='1'>
							</td>";
					}
					else{
						$checkboxMenu.= "<td></td>";
					}
					if($menuDua->edit_button == 1){
						$checkboxMenu.= "
							<td align='center'>
								<input ".$editAktifDua." type='checkbox' name='edit_".$menuDua->id_menu."' value='1'>
							</td>";
					}
					else{
						$checkboxMenu.= "<td></td>";
					}
					if($menuDua->delete_button == 1){
						$checkboxMenu.= "
							<td align='center'>
								<input type='checkbox' ".$deleteAktifDua." name='delete_".$menuDua->id_menu."' value='1'>
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
				$whereMenuTiga = array('id_parent' => $menuDua->id_menu);
				foreach( $this->m_role->show_data_menu($whereMenuTiga) as $menuTiga){

					$whereDataTiga = array('id_level_user' => $id, 'id_menu' => $menuTiga->id_menu);
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
									<div class='checkbox'>
										<label>
											<input type='checkbox' ".$aktifMenuTiga." value='".$menuTiga->id_menu."' name='id_menu[]'>".$menuTiga->nama_menu."
										</label>
									</div>
								</div>
							</td>";

					if($menuTiga->link_menu!=""){
						if($menuTiga->add_button == 1){
							$checkboxMenu.= "
								<td align='center'>
									<input type='checkbox' name='add_".$menuTiga->id_menu."' ".$addAktifTiga." value='1'>
								</td>";
						}
						else{
							$checkboxMenu.= "<td></td>";
						}
						if($menuTiga->edit_button == 1){
							$checkboxMenu.= "
								<td align='center'>
									<input type='checkbox' name='edit_".$menuTiga->id_menu."' ".$editAktifTiga." value='1'>
								</td>";
						}
						else{
							$checkboxMenu.= "<td></td>";
						}
						if($menuTiga->delete_button == 1){
							$checkboxMenu.= "
								<td align='center'>
									<input type='checkbox' name='delete_".$menuTiga->id_menu."' ".$deleteAktifTiga." value='1'>
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
			'check_box_menu' => $checkboxMenu
		);

		$content = [
			'modal' => false,
			'js'		=> false,
			'css'		=> 'setRoleAdmCss',
			'view'	=> 'view_list_edit_role'
		];

		$this->template_view->load_view($content, $data);
	}

	public function edit_role_data()
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->prof->get_detail_pengguna($id_user);

		$this->form_validation->set_rules('id_role', '', 'trim|required');
		$this->form_validation->set_rules('nama_role', '', 'trim|required');
		
		if ($this->form_validation->run() == FALSE)	{
			$this->session->set_flashdata('feedback_failed','Gagal menyimpan Data, pastikan telah mengisi semua inputan.'); 
			redirect($this->uri->segment(1));
		}else{
			//update tabel level user / role
			$input = array(
				'nama_level_user' => $this->input->post('nama_role'),
				'keterangan_level_user' => $this->input->post('keterangan')
			);
			$where = array('id_level_user' => $this->input->post('id_role'));
			$query = $this->m_role->update_data_role($where, $input, 'tbl_level_user');
			
			// select data di tbl hak akses dengan role terpilih
			$d_akses = $this->db->query("SELECT * FROM tbl_hak_akses WHERE id_level_user = '".$this->input->post('id_role')."'")->result();
			
			if($d_akses){
				// delete hak akses sesuai parent yg di update
				$where2 = array('id_level_user' => $this->input->post('id_role'));
				$this->m_role->delete_data_role($where2, 'tbl_hak_akses');
			}
		
			$id_menu = $this->input->post('id_menu');
			// var_dump($id_menu);exit;

			for ($i=0; $i < count($id_menu); $i++) { 
				$insert = "
					insert into tbl_hak_akses
						(id_menu, id_level_user, add_button, edit_button, delete_button)
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

			$this->session->set_flashdata('feedback_success','Berhasil update data role.'); 
			redirect($this->uri->segment(1));
		}
	}

	public function edit_status_role($idRole)
	{
		$flag_aktifkan = true;
		$status = trim($this->input->post('status'));
		
		if ($status == 'Aktif') {
			$flag_aktifkan = false;
		}else{
			$flag_aktifkan = true;
		}

		if ($flag_aktifkan) {
			$this->m_role->update_data_role(['id_level_user' => $idRole], ['aktif' => 1], 'tbl_level_user');
			$pesan = 'Role berhasil di aktifkan';
		}else{
			$this->m_role->update_data_role(['id_level_user' => $idRole], ['aktif' => 0], 'tbl_level_user');
			$pesan = 'Role berhasil di nonaktifkan';
		}

		echo json_encode([
			'pesan' => $pesan
		]);
	}
	// ==========================	
}
