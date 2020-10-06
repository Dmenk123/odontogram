<?php
//require_once BASEPATH.'core/CodeIgniter.php';
class Template_view extends CI_Controller {
    protected $_ci;

    function __construct(){
        
        //parent::__construct();
        
        $this->_ci = &get_instance();
    }



    function load_view($content, $data = NULL){
        $this->_ci->load->library('session');
		
        if(!$_SESSION['id_role']){
            $id_role = "0";
        }
        else{
            $id_role = $this->_ci->session->userdata('id_role');
        }

		//cari page yang aktif
		$queryActive = $this->_ci->db->query("
			select
				m_menu.id,
				m_menu.tingkat,
				m_menu.nama,
				m_menu.id_parent as id_ataspertama,
				(select menuataskedua.id_parent from m_menu as menuataskedua where menuataskedua.id = m_menu.id_parent) as id_ataskedua,
				(select menuatasketiga.id_parent from m_menu as menuatasketiga where menuatasketiga.id = (select menuataskedua.id_parent from m_menu as menuataskedua where menuataskedua.id = m_menu.id_parent)) as id_atasketiga
			from
				m_menu, t_role_menu
			WHERE
				m_menu.aktif = 1 and m_menu.link = '".$this->_ci->uri->segment(1)."' and m_menu.id = t_role_menu.id_menu and t_role_menu.id_role = '".$id_role."'
		");
		$dataActive = $queryActive->row();
		// echo $this->_ci->db->last_query();
		// exit;
		
		// cari menu parent (Menu paling atas/pertama)
        $menu1 = $this->_ci->db->query("
            select 
                m_menu.* 
            from 
                m_menu,t_role_menu where m_menu.id_parent = '0' and 
                m_menu.aktif= 1 and m_menu.id = t_role_menu.id_menu and 
                t_role_menu.id_role= '".$id_role."' 
            order by m_menu.urutan
        ");
        $dataMenu1 = $menu1->result();
		// echo $this->_ci->db->last_query();
		// exit;

		$noMenuSatu = 1;
		$sidebarComponent = "";
        foreach($dataMenu1 as $dataMenuSatu){

            $Parent1 = $this->_ci->db->query("
                select 
                    count(m_menu.id) as jumlah 
                from 
                    m_menu,t_role_menu 
                where 
                    m_menu.id_parent = '".$dataMenuSatu->id."' and 
                    m_menu.id = t_role_menu.id_menu and 
                    m_menu.aktif = 1 and 
                    t_role_menu.id_role = '".$id_role."'
            ");

            $jumlahParent1 = $Parent1->row();
            // echo $this->_ci->db->last_query();
			// exit;
			if($jumlahParent1->jumlah > 0) {
				$toggleMenu1 = "data-ktmenu-submenu-toggle='hover'";
				$iconTurun1 = '<i class="kt-menu__ver-arrow la la-angle-right"></i>';
				$link1 = "javascript:;";

			}else{
				$toggleMenu1 = '';
				$iconTurun1 = "";
				$link1 = base_url().$dataMenuSatu->link;
			}
			
			if(!$dataActive){
				redirect("login");
			}

			if($dataActive->tingkat=='4' && $dataActive->id_atasketiga == $dataMenuSatu->id){
				$active1="here kt-menu__item--open";
			}else{
				if($dataActive->tingkat=='3' && $dataActive->id_ataskedua==$dataMenuSatu->id){
					$active1="here kt-menu__item--open";
				}else{
					if($dataActive->tingkat=='2' && $dataActive->id_ataspertama==$dataMenuSatu->id){
						$active1="here kt-menu__item--open";
					}else{
						if($dataActive->tingkat=='1' && $dataActive->id==$dataMenuSatu->id){
							$active1="here kt-menu__item--open";
						}else{
							$active1="";
						}
					}
				}
			}

			$sidebarComponent .= "
				<li class='kt-menu__item kt-menu__item--".$active1."' aria-haspopup='true' ".$toggleMenu1.">
					<a href='".$link1."' class='kt-menu__link kt-menu__toggle'>
						<span class='kt-menu__link-icon ".$dataMenuSatu->icon."'></span>
						<span class='kt-menu__link-text'>$dataMenuSatu->nama</span>
						$iconTurun1
					</a>
			";
			
			if($jumlahParent1->jumlah > 0) {

                $menu2 = $this->_ci->db->query("
                    select 
                        m_menu.* 
                    from 
                        m_menu,t_role_menu 
                    where 
                        m_menu.id_parent = '".$dataMenuSatu->id."' and m_menu.id=t_role_menu.id_menu and m_menu.aktif = 1 and  t_role_menu.id_role= '".$id_role."' 
                    order by m_menu.urutan
                ");

				$dataMenu2 = $menu2->result();
				$noMenuDua = 1;
				$sidebarComponent .= "<div class='kt-menu__submenu'>";
				$sidebarComponent .= "<ul class='kt-menu__subnav'>";
				
				foreach($dataMenu2 as $dataMenuDua){

                    $Parent2 = $this->_ci->db->query("
                        select 
                            count(m_menu.id) as jumlah 
                        from 
                            m_menu,t_role_menu 
                        where 
                            m_menu.id_parent = '".$dataMenuDua->id."' and 
                            m_menu.aktif = 1 and 
                            m_menu.id=t_role_menu.id_menu and 
                            t_role_menu.id_role= '".$id_role."' 
                    ");

					$jumlahParent2 = $Parent2->row();

					if($jumlahParent2->jumlah > 0) {
						$toggleMenu2 = '';
						$iconTurun2 = '<i class="kt-menu__ver-arrow la la-angle-right"></i>';
						$link2 = "javascript:;";
						$iconPanah1 = "";

					}else{
						$toggleMenu2 = '';
						$iconTurun2 = "";
						$link2 = base_url().$dataMenuDua->link;
						$iconPanah1 = '';
					}

					if($dataActive->tingkat=='4' && $dataActive->id_ataskedua==$dataMenuDua->id){
						$active2="active kt-menu__item--open";
					}else{
						if($dataActive->tingkat=='3' && $dataActive->id_ataspertama==$dataMenuDua->id){
							$active2="active kt-menu__item--open";
						}else{
							if($dataActive->tingkat=='2' && $dataActive->id==$dataMenuDua->id){
								$active2="active kt-menu__item--open";
							}else{
								$active2="";
							}
						}
					}

					if($dataMenuDua->icon != '') {
						$iconSubDua = "<span class='kt-menu__link-icon ".$dataMenuDua->icon."'></span>";
					}else{
						$iconSubDua = "<i class='kt-menu__link-bullet kt-menu__link-bullet--dot'><span></span></i>";
					}

					$sidebarComponent .= "
						<li class='kt-menu__item kt-menu__item--".$active2."' aria-haspopup='true' ".$toggleMenu2.">
							<a href='".$link2."' class='kt-menu__link kt-menu__toggle'>
								$iconSubDua
								<span class='kt-menu__link-text'>$dataMenuDua->nama</span>
								$iconTurun2
							</a>
					";

					if($jumlahParent2->jumlah > 0) {

                        $menu3 = $this->_ci->db->query("
                            select 
                                m_menu.* 
                            from 
                                m_menu,t_role_menu 
                            where 
                                m_menu.id_parent = '".$dataMenuDua->id."' and m_menu.id=t_role_menu.id_menu and m_menu.aktif = 1 and t_role_menu.id_role= '".$id_role."' 
                            order by m_menu.urutan
                        ");

						$dataMenu3 = $menu3->result();
						$noMenuTiga = 1;
						
						$sidebarComponent .= "<div class='kt-menu__submenu'>";
						$sidebarComponent .= "<ul class='kt-menu__subnav'>";
						
						foreach($dataMenu3 as $dataMenuTiga){

                            $Parent3 = $this->_ci->db->query("
                                select 
                                    count(m_menu.id) as jumlah
                                from 
                                    m_menu,t_role_menu 
                                where 
                                    m_menu.id_parent = '".$dataMenuTiga->id."' and m_menu.id=t_role_menu.id_menu and  m_menu.aktif = 1 and t_role_menu.id_role= '".$id_role."' 
                            ");

							$jumlahParent3 = $Parent3->row();

							if($jumlahParent3->jumlah > 0) {
								$toggleMenu3 = '';
								$iconTurun3 = '<i class="kt-menu__ver-arrow la la-angle-right"></i>';
								$link3 = "javascript:;";
								$iconPanah2 = '';

							}else{
								$toggleMenu3 = '';
								$iconTurun3 = "";
								$link3 = base_url().$dataMenuTiga->link;
								$iconPanah2 = '';
							}


							if($dataActive->tingkat=='4' && $dataActive->id_ataspertama==$dataMenuTiga->id){
								$active3="active";
							}else{
								if($dataActive->tingkat=='3' && $dataActive->id==$dataMenuTiga->id){
									$active3="active";
								}else{
									$active3="";
								}
							}

							$sidebarComponent .= "
								<li class='kt-menu__item kt-menu__item--".$active3."' aria-haspopup='true' ".$toggleMenu3.">
								<a href='".$link3."' class='kt-menu__link kt-menu__toggle'>
									<span class='kt-menu__link-icon ".$dataMenuTiga->icon."'></span>
									<span class='kt-menu__link-text'>$dataMenuTiga->nama</span>
									$iconTurun3
								</a>
							";


							if($jumlahParent3->jumlah > 0) {

                                $menu4 = $this->_ci->db->query("
                                    select 
                                        m_menu.* 
                                    from 
                                        m_menu,t_role_menu 
                                    where 
                                        m_menu.id_parent = '".$dataMenuTiga->id."' and m_menu.id=t_role_menu.id_menu and
                                        t_role_menu.id_role= '".$id_role."' 
                                    order by m_menu.urutan
								");
								
								$dataMenu4 = $menu4->result();
								$noMenuEmpat = 1;
								
								$sidebarComponent .= "<div class='kt-menu__submenu'>";
								$sidebarComponent .= "<ul class='kt-menu__subnav'>";

								foreach($dataMenu4 as $dataMenuEmpat){

                                    $Parent4 = $this->_ci->db->query("
                                        select 
                                            count(id_menu) as jumlah 
                                        from 
                                            m_menu,t_role_menu 
                                        where 
                                            m_menu.id_parent = '".$dataMenuEmpat->id."' and m_menu.id=t_role_menu.id_menu and t_role_menu.id_role= '".$id_role."' order by m_menu.urutan
                                    ");
									$jumlahParent4 = $Parent4->row();

									if($jumlahParent4->jumlah > 0) {
										$toggleMenu4 = '';
										$iconTurun4 = '<i class="kt-menu__ver-arrow la la-angle-right"></i>';
										$link4 = "#";
										$iconPanah3 = '';

									}else{
										$toggleMenu4 = '';
										$iconTurun4 = "";
										$link4 = base_url().$dataMenuEmpat->link;
										$iconPanah3 = '';
									}

									if($dataActive->tingkat=='4' && $dataActive->id==$dataMenuEmpat->id){
										$active4="active";
									}else{
										$active4="";
									}
								
									$sidebarComponent .= "
										<li class='kt-menu__item kt-menu__item--".$active4."' aria-haspopup='true' ".$toggleMenu4.">
											<a href='".$link4."' class='kt-menu__link kt-menu__toggle'>
												<span class='kt-menu__link-icon ".$dataMenuEmpat->icon."'></span>
												<span class='kt-menu__link-text'>$dataMenuEmpat->nama</span>
												$iconTurun4
											</a>
										</li>
									";
								}

								$sidebarComponent .= "</ul></div>";
								$sidebarComponent .= "</li>";
							}else{
								$sidebarComponent .= "</li>";
							}

						}

						$sidebarComponent .= "</ul></div>";
						$sidebarComponent .= "</li>";
					}else{
						$sidebarComponent .= "</li>";
					}
				}

				$sidebarComponent .= "</ul></div>";
				$sidebarComponent .= "</li>";
			}else{
				$sidebarComponent .= "</li>";
			}

			$noMenuSatu++;
		}
		
		// echo $sidebarComponent;exit;
		// var_dump($sidebarComponent);exit;
		$data['tampil_menu'] = $sidebarComponent;
		if($content['css']){
			// $data['css'] = $this->_ci->load->view($content['css'], $data, TRUE);
			$data['link_js']      = 'assets/css_module/'.$content['css'];
		}
		
		if($content['js']){
			if(is_array($content['js'])){
				foreach ($content['js'] as $keys => $vals) {
					$data['link_js'][] = 'assets/js_module/'.$vals;
				}
			}else{
				$data['link_js']      = 'assets/js_module/'.$content['js'];
			}
			
		}
		
		if($content['modal']){
			if(is_array($content['modal'])){
				foreach ($content['modal'] as $keys => $vals) {
					$data['modal'][]  = $this->_ci->load->view($vals, $data, TRUE);
				}
			}else{
				$data['modal']  = $this->_ci->load->view($content['modal'], $data, TRUE);
			}
		}
		
		//global modal for upload excel to master
		$data['modal_excel_upload'] = $this->_ci->load->view('template/modal_upload_excel', $data, TRUE);
        
		$data['header']     = $this->_ci->load->view('template/v_header', $data, TRUE);
		$data['navbar']     = $this->_ci->load->view('template/v_navbar', $data, TRUE);
        $data['content']    = $this->_ci->load->view($content['view'], $data, TRUE);
        $data['footer']     = $this->_ci->load->view('template/v_footer', $data, TRUE);
		

        $this->_ci->load->view('template/v_index', $data);

    }

    function nama($string){
        $queryMenu = $this->_ci->db->query("
        select
            m_menu.id,
            m_menu.tingkat,
            m_menu.judul,
            m_menu.nama
        from
            m_menu
        WHERE
            m_menu.link = '".$this->_ci->uri->segment(1)."'
        ");
        $dataMenu = $queryMenu->row();

		switch ($string) {
			case "judul":
				return $dataMenu->judul;
				break;
			case "nama":
				return $dataMenu->nama;
				break;

			default:
				return "Kosong -> Perhatikan Database Menu";
		}

    }

    function getAddButton($is_modal = false, $method_js = false){
      if(!$_SESSION['id_role']){
        $id_role = "0";
      }
      else{
        $id_role = $this->_ci->session->userdata('id_role');
      }

		if($id_role){
			$queryButton = $this->_ci->db->query("
			select
				t_role_menu.add_button
			from
				m_menu,t_role_menu
			WHERE
				m_menu.id=t_role_menu.id_menu
				and t_role_menu.id_role= '".$id_role."'
				and m_menu.link = '".$this->_ci->uri->segment(1)."'
			");
			$dataButton = $queryButton->row();
			if($dataButton->add_button == 1 ){
				if($is_modal) {
					if($method_js) {
						echo "<button type='button' class='btn btn-bold btn-label-brand btn-sm' data-toggle='modal' onclick='".$method_js."()'><i class='la la-plus'></i>Tambah Data</button>";
					}else{
						echo "<button type='button' class='btn btn-bold btn-label-brand btn-sm' data-toggle='modal'><i class='la la-plus'></i>Tambah Data</button>";
					}
					
				}else{
					echo "<a href='".base_url().$this->_ci->uri->segment(1)."/add' class='btn btn-bold btn-label-brand btn-sm'><i class='la la-plus'></i>Tambah Data</a>
				";
				}
			}
		}

	}

    function getEditButton($urlEdit){

      if(!$_SESSION['id_level_user']){
        $id_role = "0";
      }
      else{
        $id_role = $this->_ci->session->userdata('id_level_user');
      }

		if($id_role){
			$queryButton = $this->_ci->db->query("
			select
				t_role_menu.edit_button
			from
				m_menu,t_role_menu
			WHERE
				m_menu.id=t_role_menu.id_menu
				and t_role_menu.id_role= '".$id_role."'
				and m_menu.link = '".$this->_ci->uri->segment(1)."'
			");
			$dataButton = $queryButton->row();
			if($dataButton->edit_button == 1 ){

				echo "<a href='".$urlEdit."'><span class='btn btn-warning btn-xs'><i class='fa fa-edit'></i></span></a>";
			}
		}
    }

    function getDeleteButton($msgDelete,$urlDelete){

      if(!$_SESSION['id_level_user']){
        $id_role = "0";
      }
      else{
        $id_role = $this->_ci->session->userdata('id_level_user');
      }

		if($id_role){
			$queryButton = $this->_ci->db->query("
			select
				t_role_menu.delete_button
			from
				m_menu,t_role_menu
			WHERE
				m_menu.id=t_role_menu.id_menu
				and t_role_menu.id_role= '".$id_role."'
				and m_menu.link = '".$this->_ci->uri->segment(1)."'
			");
			$dataButton = $queryButton->row();
			if($dataButton->delete_button == 1 ){

				$msgDelete = '"'.$msgDelete.'"';
				$urlDelete = '"'.$urlDelete.'"';

				echo	"<span class='btn btn-danger btn-xs' onclick='tampil_pesan_hapus(".$msgDelete.",".$urlDelete.")'><i class='glyphicon glyphicon-remove'></i></span>";
			}
		}
	}
	
	function getOpsiButton($cetak_only = false){
		if(!$_SESSION['id_role']){
		  $id_role = "0";
		}
		else{
		  $id_role = $this->_ci->session->userdata('id_role');
		}
		
		########### hanya pilihan cetak saja tanpa ekspor/impor excel
		if($cetak_only) {
			echo '<a type="button" class="btn btn-primary btn-sm" target="_blank" href="'.base_url().$this->_ci->uri->segment(1).'/cetak_data">
			<i class="la la-print"></i> Cetak </a>';
		}else{
			echo '<div class="btn-group">
				<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Export / Import</button>
				<div class="dropdown-menu">
					<a class="dropdown-item" target="_blank" href="'.base_url().$this->_ci->uri->segment(1).'/template_excel">
						<i class="la la-trello"></i> Template Excel
					</a>
					<button class="dropdown-item" onclick="import_excel()">
						<i class="la la-arrow-circle-o-up"></i> Import Excel
					</button>
					<a class="dropdown-item" target="_blank" href="'.base_url().$this->_ci->uri->segment(1).'/export_excel">
						<i class="la la-arrow-circle-o-down"></i> Export Excel
					</a>
					<a class="dropdown-item" target="_blank" href="'.base_url().$this->_ci->uri->segment(1).'/cetak_data">
						<i class="la la-print"></i> Cetak
					</a>
				</div>
			</div>';
		}
		
	}

}
