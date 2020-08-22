<?php
//require_once BASEPATH.'core/CodeIgniter.php';
class Template_view extends CI_Controller {
    protected $_ci;

    function __construct(){
        
        //parent::__construct();
        
        $this->_ci = &get_instance();
    }



    function load_view($content, $data = NULL){
		//var_dump($content);exit;
		
        $this->_ci->load->library('session');
		
        if(!$_SESSION['id_role']){
            $id_role = "0";
        }
        else{
            $id_role = $this->_ci->session->userdata('id_role');
        }

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
			m_menu.aktif = 1 and m_menu.LINK = '".$this->_ci->uri->segment(1)."' and m_menu.id = t_role_menu.id_menu and t_role_menu.id_role = '".$id_role."'
		");
		$dataActive = $queryActive->row();
		// echo $this->_ci->db->last_query();
		// exit;
		$menuHtml = "<ul class='sidebar-menu'>";
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

        $noMenuSatu = 1;
        foreach($dataMenu1 as $dataMenuSatu){

            $Parent1 = $this->_ci->db->query("
                select 
                    count(m_menu.id) as jumlah 
                from 
                    m_menu,t_role_menu 
                where 
                    m_menu.id_parent = '".$dataMenuSatu->id_menu."' and 
                    m_menu.id=t_role_menu.id_menu and 
                    m_menu.aktif = 1 and 
                    t_role_menu.id_role = '".$id_role."'
            ");

            $jumlahParent1 = $Parent1->row();
            
			if($jumlahParent1->jumlah > 0) {
				$treeview1 = 'treeview';
				$iconTurun1 = '<span class="pull-right-container">
                				<i class="fa fa-angle-left pull-right"></i>
              				   </span>';
				//$iconTurun1 = "<i class='fa fa-dashboard'></i> <span></span>";
				$link1 = "#";

			}else{
				$treeview1 = '';
				$iconTurun1 = "";
				$link1 = base_url().$dataMenuSatu->LINK;
			}

			
			if(!$dataActive){
				redirect("login");
			}

			if($dataActive->tingkat=='4' && $dataActive->id_atasketiga==$dataMenuSatu->id_menu){
				$active1="active";
			}else{
				if($dataActive->tingkat=='3' && $dataActive->id_ataskedua==$dataMenuSatu->id_menu){
					$active1="active";
				}else{
					if($dataActive->tingkat=='2' && $dataActive->id_ataspertama==$dataMenuSatu->id_menu){
						$active1="active";
					}else{
						if($dataActive->tingkat=='1' && $dataActive->id_menu==$dataMenuSatu->id_menu){
							$active1="active";
						}else{
							$active1="";
						}
					}
				}
			}

			$menuHtml .= "
			<li class=' $active1 ".$treeview1."'>
				<a href='".$link1."'>
					<i class='".$dataMenuSatu->icon_menu."'></i>
						<span class='title'>".$dataMenuSatu->nama."</span>
						".$iconTurun1."
				</a>
			";

			if($jumlahParent1->jumlah > 0) {

                $menu2 = $this->_ci->db->query("
                    select 
                        m_menu.* 
                    from 
                        m_menu,t_role_menu 
                    where 
                        m_menu.id_parent = '".$dataMenuSatu->id_menu."' and m_menu.id=t_role_menu.id_menu and m_menu.aktif = 1 and  t_role_menu.id_role= '".$id_role."' 
                    order by m_menu.urutan
                ");

				$dataMenu2 = $menu2->result();
				$noMenuDua = 1;
				$menuHtml .= '<ul class="treeview-menu">';
				foreach($dataMenu2 as $dataMenuDua){

                    $Parent2 = $this->_ci->db->query("
                        select 
                            count(m_menu.id) as jumlah 
                        from 
                            m_menu,t_role_menu 
                        where 
                            m_menu.id_parent = '".$dataMenuDua->id_menu."' and 
                            m_menu.aktif = 1 and 
                            m_menu.id=t_role_menu.id_menu and 
                            t_role_menu.id_role= '".$id_role."' 
                    ");

					$jumlahParent2 = $Parent2->row();

					if($jumlahParent2->jumlah > 0) {
						$treeview2 = '';
						$iconTurun2 = '<span class="pull-right-container">
										<i class="fa fa-angle-left pull-right"></i>
									   </span>';
						$link2 = "#";
						$iconPanah1 = "";

					}else{
						$treeview2 = '';
						$iconTurun2 = "";
						$link2 = base_url().$dataMenuDua->LINK;
						$iconPanah1 = '';
					}

					if($dataActive->tingkat=='4' && $dataActive->id_ataskedua==$dataMenuDua->id_menu){
						$active2="active";
					}else{
						if($dataActive->tingkat=='3' && $dataActive->id_ataspertama==$dataMenuDua->id_menu){
							$active2="active";
						}else{
							if($dataActive->tingkat=='2' && $dataActive->id_menu==$dataMenuDua->id_menu){
								$active2="active";
							}else{
								$active2="";
							}
						}
					}
					
					$menuHtml .= "
					<li class='$active2 ".$treeview2."'>
						<a href='".$link2."'>
								<i class='".$dataMenuDua->icon_menu."'></i>".$dataMenuDua->nama."
								".$iconTurun2."
						</a>
					";

					if($jumlahParent2->jumlah > 0) {

                        $menu3 = $this->_ci->db->query("
                            select 
                                m_menu.* 
                            from 
                                m_menu,t_role_menu 
                            where 
                                m_menu.id_parent = '".$dataMenuDua->id_menu."' and m_menu.id=t_role_menu.id_menu and m_menu.aktif = 1 and t_role_menu.id_role= '".$id_role."' 
                            order by m_menu.urutan
                        ");

						$dataMenu3 = $menu3->result();
						$noMenuTiga = 1;
						$menuHtml .= '<ul class="sub-menu">';
						foreach($dataMenu3 as $dataMenuTiga){

                            $Parent3 = $this->_ci->db->query("
                                select 
                                    count(m_menu.id) as jumlah
                                from 
                                    m_menu,t_role_menu 
                                where 
                                    m_menu.id_parent = '".$dataMenuTiga->id_menu."' and m_menu.id=t_role_menu.id_menu and  m_menu.aktif = 1 and t_role_menu.id_role= '".$id_role."' 
                            ");

							$jumlahParent3 = $Parent3->row();

							if($jumlahParent3->jumlah > 0) {
								$treeview3 = 'treeview';
								$iconTurun3 = "<span class='pull-right-container'><i class='fa fa-angle-left 	pull-right'></i></span>";
								$link3 = "#";
								$iconPanah2 = '';

							}else{
								$treeview3 = '';
								$iconTurun3 = "";
								$link3 = base_url().$dataMenuTiga->LINK;
								//$iconPanah2 = '<i class="fa fa-angle-right"></i> ';
								$iconPanah2 = '';
							}



							if($dataActive->tingkat=='4' && $dataActive->id_ataspertama==$dataMenuTiga->id_menu){
								$active3="active";
							}else{
								if($dataActive->tingkat=='3' && $dataActive->id_menu==$dataMenuTiga->id_menu){
									$active3="active";
								}else{
									$active3="";
								}
							}

							$menuHtml .= "
							<li class='$active3 ".$treeview3."'>
								<a href='".$link3."'>
									$iconPanah2
										<span>".$dataMenuTiga->nama."</span>
										".$iconTurun3."
								</a>
							";


							if($jumlahParent3->jumlah > 0) {

                                $menu4 = $this->_ci->db->query("
                                    select 
                                        m_menu.* 
                                    from 
                                        m_menu,t_role_menu 
                                    where 
                                        m_menu.id_parent = '".$dataMenuTiga->id_menu."' and m_menu.id=t_role_menu.id_menu and
                                        t_role_menu.id_role= '".$id_role."' 
                                    order by m_menu.urutan
                                ");
								$dataMenu4 = $menu4->result();
								$noMenuEmpat = 1;
								$menuHtml .= '<ul class="treeview-menu">';
								foreach($dataMenu4 as $dataMenuEmpat){

                                    $Parent4 = $this->_ci->db->query("
                                        select 
                                            count(id_menu) as jumlah 
                                        from 
                                            m_menu,t_role_menu 
                                        where 
                                            m_menu.id_parent = '".$dataMenuTiga->id_menu."' and m_menu.id=t_role_menu.id_menu and t_role_menu.id_role= '".$id_role."' order by m_menu.urutan
                                    ");
									$jumlahParent4 = $Parent4->row();

									if($jumlahParent4->jumlah > 0) {
										$treeview4 = 'treeview';
										$iconTurun4 = "<span class='pull-right-container'><i class='fa fa-angle-left 	pull-right'></i></span>";
										$link4 = "#";
										$iconPanah3 = '';

									}else{
										$treeview4 = '';
										$iconTurun4 = "";
										$link4 = base_url().$dataMenuEmpat->LINK;
										//$iconPanah3 = '<i class="fa fa-angle-right"></i> ';
										$iconPanah3 = '';
									}

									if($dataActive->tingkat=='4' && $dataActive->id_menu==$dataMenuEmpat->id_menu){
										$active4="active";
									}else{
										$active4="";
									}

									$menuHtml .= "
									<li class=' $active4 ".$treeview4."'>
										<a href='".$link4."'>
											$iconPanah3
												<span>".$dataMenuEmpat->nama."</span>
												".$iconTurun4."
										</a>
									";
								}
								$menuHtml .= "</li></ul>";
							}

						}
						$menuHtml .= "</li></ul>";
					}
				}

				$menuHtml .= "</li></ul>";
			}

			$menuHtml .= "</li>";
			$noMenuSatu++;
		}


		$data['tampil_menu'] = $menuHtml;
		if($content['css']){
			$data['css_adm'] = $this->_ci->load->view($content['css'], $data, TRUE);
		}
		
		if($content['js']){
			$data['js']      = $this->_ci->load->view($content['js'], $data, TRUE);
		}
		
		if($content['modal']){
			$data['modal']         = $this->_ci->load->view($content['modal'], $data, TRUE);
		}

        //$data['modal']      = $this->_ci->load->view($content['modal'], $data, TRUE);
        //$data['js']         = $this->_ci->load->view($content['js'], $data, TRUE);
		$data['navbar']     = $this->_ci->load->view('template/v_navbar', $data, TRUE);
        $data['header']     = $this->_ci->load->view('template/v_header', $data, TRUE);
        $data['content']    = $this->_ci->load->view($content['view'], $data, TRUE);
        $data['footer']     = $this->_ci->load->view('template/v_footer', $data, TRUE);
		
        $this->_ci->load->view('template/v_index', $data);

    }

    function nama($string){
        $queryMenu = $this->_ci->db->query("
        select
            m_menu.id,
            m_menu.tingkat,
            m_menu.judul_menu,
            m_menu.nama
        from
            m_menu
        WHERE
            m_menu.LINK = '".$this->_ci->uri->segment(1)."'
        ");
        $dataMenu = $queryMenu->row();

		switch ($string) {
			case "judul_menu":
				return $dataMenu->judul_menu;
				break;
			case "nama":
				return $dataMenu->nama;
				break;

			default:
				return "Kosong -> Perhatikan Database Menu";
		}

    }

    function getAddButton(){
      if(!$_SESSION['id_level_user']){
        $id_role = "0";
      }
      else{
        $id_role = $this->_ci->session->userdata('id_level_user');
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
				and m_menu.LINK = '".$this->_ci->uri->segment(1)."'
			");
			$dataButton = $queryButton->row();
			if($dataButton->add_button == 1 ){
				echo "<a href='".base_url().$this->_ci->uri->segment(1)."/add'><span class='btn btn-success'><i class='fa fa-plus'></i> Tambah Data</span></a>
				";
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
				and m_menu.LINK = '".$this->_ci->uri->segment(1)."'
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
				and m_menu.LINK = '".$this->_ci->uri->segment(1)."'
			");
			$dataButton = $queryButton->row();
			if($dataButton->delete_button == 1 ){

				$msgDelete = '"'.$msgDelete.'"';
				$urlDelete = '"'.$urlDelete.'"';

				echo	"<span class='btn btn-danger btn-xs' onclick='tampil_pesan_hapus(".$msgDelete.",".$urlDelete.")'><i class='glyphicon glyphicon-remove'></i></span>";
			}
		}
    }

}
