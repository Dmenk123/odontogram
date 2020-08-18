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
		
        if(!$_SESSION['id_level_user']){
            $id_level = "0";
        }
        else{
            $id_level = $this->_ci->session->userdata('id_level_user');
        }

		$queryActive = $this->_ci->db->query("
		select
			tbl_menu.id_menu,
			tbl_menu.tingkat_menu,
            tbl_menu.nama_menu,
			tbl_menu.id_parent as id_ataspertama,
			(select menuataskedua.id_parent from tbl_menu menuataskedua where menuataskedua.id_menu=tbl_menu.id_parent) as id_ataskedua,
			(select menuatasketiga.id_parent from tbl_menu menuatasketiga where menuatasketiga.id_menu= (select menuataskedua.id_parent from tbl_menu menuataskedua where menuataskedua.id_menu=tbl_menu.id_parent)) as id_atasketiga
		from
			tbl_menu,tbl_hak_akses
		WHERE
			tbl_menu.aktif_menu = 1 and tbl_menu.LINK_MENU = '".$this->_ci->uri->segment(1)."' and tbl_menu.id_menu=tbl_hak_akses.id_menu and tbl_hak_akses.id_level_user= '".$id_level."'
		");
		$dataActive = $queryActive->row();
		// echo $this->_ci->db->last_query();
		// exit;
		$menuHtml = "<ul class='sidebar-menu'>";
        $menu1 = $this->_ci->db->query("
            select 
                tbl_menu.* 
            from 
                tbl_menu,tbl_hak_akses where tbl_menu.id_parent = '0' and 
                tbl_menu.aktif_menu= 1 and tbl_menu.id_menu=tbl_hak_akses.id_menu and 
                tbl_hak_akses.id_level_user= '".$id_level."' 
            order by tbl_menu.URUTAN_MENU
        ");
        $dataMenu1 = $menu1->result();

        $noMenuSatu = 1;
        foreach($dataMenu1 as $dataMenuSatu){

            $Parent1 = $this->_ci->db->query("
                select 
                    count(tbl_menu.id_menu) as jumlah 
                from 
                    tbl_menu,tbl_hak_akses 
                where 
                    tbl_menu.id_parent = '".$dataMenuSatu->id_menu."' and 
                    tbl_menu.id_menu=tbl_hak_akses.id_menu and 
                    tbl_menu.aktif_menu = 1 and 
                    tbl_hak_akses.id_level_user = '".$id_level."'
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
				$link1 = base_url().$dataMenuSatu->link_menu;
			}

			
			if(!$dataActive){
				redirect("login");
			}

			if($dataActive->tingkat_menu=='4' && $dataActive->id_atasketiga==$dataMenuSatu->id_menu){
				$active1="active";
			}else{
				if($dataActive->tingkat_menu=='3' && $dataActive->id_ataskedua==$dataMenuSatu->id_menu){
					$active1="active";
				}else{
					if($dataActive->tingkat_menu=='2' && $dataActive->id_ataspertama==$dataMenuSatu->id_menu){
						$active1="active";
					}else{
						if($dataActive->tingkat_menu=='1' && $dataActive->id_menu==$dataMenuSatu->id_menu){
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
						<span class='title'>".$dataMenuSatu->nama_menu."</span>
						".$iconTurun1."
				</a>
			";

			if($jumlahParent1->jumlah > 0) {

                $menu2 = $this->_ci->db->query("
                    select 
                        tbl_menu.* 
                    from 
                        tbl_menu,tbl_hak_akses 
                    where 
                        tbl_menu.id_parent = '".$dataMenuSatu->id_menu."' and tbl_menu.id_menu=tbl_hak_akses.id_menu and tbl_menu.aktif_menu = 1 and  tbl_hak_akses.id_level_user= '".$id_level."' 
                    order by tbl_menu.URUTAN_MENU
                ");

				$dataMenu2 = $menu2->result();
				$noMenuDua = 1;
				$menuHtml .= '<ul class="treeview-menu">';
				foreach($dataMenu2 as $dataMenuDua){

                    $Parent2 = $this->_ci->db->query("
                        select 
                            count(tbl_menu.id_menu) as jumlah 
                        from 
                            tbl_menu,tbl_hak_akses 
                        where 
                            tbl_menu.id_parent = '".$dataMenuDua->id_menu."' and 
                            tbl_menu.aktif_menu = 1 and 
                            tbl_menu.id_menu=tbl_hak_akses.id_menu and 
                            tbl_hak_akses.id_level_user= '".$id_level."' 
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
						$link2 = base_url().$dataMenuDua->link_menu;
						$iconPanah1 = '';
					}

					if($dataActive->tingkat_menu=='4' && $dataActive->id_ataskedua==$dataMenuDua->id_menu){
						$active2="active";
					}else{
						if($dataActive->tingkat_menu=='3' && $dataActive->id_ataspertama==$dataMenuDua->id_menu){
							$active2="active";
						}else{
							if($dataActive->tingkat_menu=='2' && $dataActive->id_menu==$dataMenuDua->id_menu){
								$active2="active";
							}else{
								$active2="";
							}
						}
					}
					
					$menuHtml .= "
					<li class='$active2 ".$treeview2."'>
						<a href='".$link2."'>
								<i class='".$dataMenuDua->icon_menu."'></i>".$dataMenuDua->nama_menu."
								".$iconTurun2."
						</a>
					";

					if($jumlahParent2->jumlah > 0) {

                        $menu3 = $this->_ci->db->query("
                            select 
                                tbl_menu.* 
                            from 
                                tbl_menu,tbl_hak_akses 
                            where 
                                tbl_menu.id_parent = '".$dataMenuDua->id_menu."' and tbl_menu.id_menu=tbl_hak_akses.id_menu and tbl_menu.aktif_menu = 1 and tbl_hak_akses.id_level_user= '".$id_level."' 
                            order by tbl_menu.URUTAN_MENU
                        ");

						$dataMenu3 = $menu3->result();
						$noMenuTiga = 1;
						$menuHtml .= '<ul class="sub-menu">';
						foreach($dataMenu3 as $dataMenuTiga){

                            $Parent3 = $this->_ci->db->query("
                                select 
                                    count(tbl_menu.id_menu) as jumlah
                                from 
                                    tbl_menu,tbl_hak_akses 
                                where 
                                    tbl_menu.id_parent = '".$dataMenuTiga->id_menu."' and tbl_menu.id_menu=tbl_hak_akses.id_menu and  tbl_menu.aktif_menu = 1 and tbl_hak_akses.id_level_user= '".$id_level."' 
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
								$link3 = base_url().$dataMenuTiga->link_menu;
								//$iconPanah2 = '<i class="fa fa-angle-right"></i> ';
								$iconPanah2 = '';
							}



							if($dataActive->tingkat_menu=='4' && $dataActive->id_ataspertama==$dataMenuTiga->id_menu){
								$active3="active";
							}else{
								if($dataActive->tingkat_menu=='3' && $dataActive->id_menu==$dataMenuTiga->id_menu){
									$active3="active";
								}else{
									$active3="";
								}
							}

							$menuHtml .= "
							<li class='$active3 ".$treeview3."'>
								<a href='".$link3."'>
									$iconPanah2
										<span>".$dataMenuTiga->nama_menu."</span>
										".$iconTurun3."
								</a>
							";


							if($jumlahParent3->jumlah > 0) {

                                $menu4 = $this->_ci->db->query("
                                    select 
                                        tbl_menu.* 
                                    from 
                                        tbl_menu,tbl_hak_akses 
                                    where 
                                        tbl_menu.id_parent = '".$dataMenuTiga->id_menu."' and tbl_menu.id_menu=tbl_hak_akses.id_menu and
                                        tbl_hak_akses.id_level_user= '".$id_level."' 
                                    order by tbl_menu.URUTAN_MENU
                                ");
								$dataMenu4 = $menu4->result();
								$noMenuEmpat = 1;
								$menuHtml .= '<ul class="treeview-menu">';
								foreach($dataMenu4 as $dataMenuEmpat){

                                    $Parent4 = $this->_ci->db->query("
                                        select 
                                            count(id_menu) as jumlah 
                                        from 
                                            tbl_menu,tbl_hak_akses 
                                        where 
                                            tbl_menu.id_parent = '".$dataMenuTiga->id_menu."' and tbl_menu.id_menu=tbl_hak_akses.id_menu and tbl_hak_akses.id_level_user= '".$id_level."' order by tbl_menu.URUTAN_MENU
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
										$link4 = base_url().$dataMenuEmpat->LINK_MENU;
										//$iconPanah3 = '<i class="fa fa-angle-right"></i> ';
										$iconPanah3 = '';
									}

									if($dataActive->tingkat_menu=='4' && $dataActive->id_menu==$dataMenuEmpat->id_menu){
										$active4="active";
									}else{
										$active4="";
									}

									$menuHtml .= "
									<li class=' $active4 ".$treeview4."'>
										<a href='".$link4."'>
											$iconPanah3
												<span>".$dataMenuEmpat->nama_menu."</span>
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
		$data['navbar']     = $this->_ci->load->view('template/v_navbar_adm', $data, TRUE);
        $data['header']     = $this->_ci->load->view('template/v_header_adm', $data, TRUE);
        $data['content']    = $this->_ci->load->view($content['view'], $data, TRUE);
        $data['footer']     = $this->_ci->load->view('template/v_footer_adm', $data, TRUE);
		
        $this->_ci->load->view('template/v_index_adm', $data);

    }

    function nama_menu($string){
        $queryMenu = $this->_ci->db->query("
        select
            tbl_menu.id_menu,
            tbl_menu.tingkat_menu,
            tbl_menu.judul_menu,
            tbl_menu.nama_menu
        from
            tbl_menu
        WHERE
            tbl_menu.link_menu = '".$this->_ci->uri->segment(1)."'
        ");
        $dataMenu = $queryMenu->row();

		switch ($string) {
			case "judul_menu":
				return $dataMenu->judul_menu;
				break;
			case "nama_menu":
				return $dataMenu->nama_menu;
				break;

			default:
				return "Kosong -> Perhatikan Database Menu";
		}

    }

    function getAddButton(){
      if(!$_SESSION['id_level_user']){
        $id_level = "0";
      }
      else{
        $id_level = $this->_ci->session->userdata('id_level_user');
      }

		if($id_level){
			$queryButton = $this->_ci->db->query("
			select
				tbl_hak_akses.add_button
			from
				tbl_menu,tbl_hak_akses
			WHERE
				tbl_menu.id_menu=tbl_hak_akses.id_menu
				and tbl_hak_akses.id_level_user= '".$id_level."'
				and tbl_menu.link_menu = '".$this->_ci->uri->segment(1)."'
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
        $id_level = "0";
      }
      else{
        $id_level = $this->_ci->session->userdata('id_level_user');
      }

		if($id_level){
			$queryButton = $this->_ci->db->query("
			select
				tbl_hak_akses.edit_button
			from
				tbl_menu,tbl_hak_akses
			WHERE
				tbl_menu.id_menu=tbl_hak_akses.id_menu
				and tbl_hak_akses.id_level_user= '".$id_level."'
				and tbl_menu.link_menu = '".$this->_ci->uri->segment(1)."'
			");
			$dataButton = $queryButton->row();
			if($dataButton->edit_button == 1 ){

				echo "<a href='".$urlEdit."'><span class='btn btn-warning btn-xs'><i class='fa fa-edit'></i></span></a>";
			}
		}
    }

    function getDeleteButton($msgDelete,$urlDelete){

      if(!$_SESSION['id_level_user']){
        $id_level = "0";
      }
      else{
        $id_level = $this->_ci->session->userdata('id_level_user');
      }

		if($id_level){
			$queryButton = $this->_ci->db->query("
			select
				tbl_hak_akses.delete_button
			from
				tbl_menu,tbl_hak_akses
			WHERE
				tbl_menu.id_menu=tbl_hak_akses.id_menu
				and tbl_hak_akses.id_level_user= '".$id_level."'
				and tbl_menu.link_menu = '".$this->_ci->uri->segment(1)."'
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
