<!-- begin:: Header -->
<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">

<!-- begin:: Header Menu -->

<!-- Uncomment this to display the close button of the panel
<button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
-->
<div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
   <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
   </div>
</div>
<!-- end:: Header Menu -->
<?php 
if($this->session->userdata('id_klinik') != null) {
   $q_klinik = $this->db->get_where('m_klinik', ['id' => $this->session->userdata('id_klinik')])->row();
   $txt_greet = $q_klinik->nama_klinik.',';
}else{
   $txt_greet = 'Selamat Datang,';
}
?>
<!-- begin:: Header Topbar -->
<div class="kt-header__topbar">
   <!--begin: User Bar -->
   <div class="kt-header__topbar-item kt-header__topbar-item--user">
      <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
         <div class="kt-header__topbar-user">
            <span class="kt-header__topbar-welcome kt-hidden-mobile"><?=$txt_greet;?></span>
            <span class="kt-header__topbar-username kt-hidden-mobile"><?= $this->session->userdata('username'); ?></span>
            <img class="kt-hidden" alt="Pic" src="assets/media/users/300_25.jpg" />

            <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
            <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold"><?= $this->session->userdata('username')[0]; ?></span>
         </div>
      </div>
      <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">
         <!--begin: Navigation -->
         <div class="kt-notification">
            <a href="javascript:void(0)" class="kt-notification__item" onclick="showProfileUser('<?=$this->session->userdata('id_user');?>')">
               <div class="kt-notification__item-icon">
                  <i class="flaticon2-calendar-3 kt-font-success"></i>
               </div>
               <div class="kt-notification__item-details">
                  <div class="kt-notification__item-title kt-font-bold">
                     Profil Saya
                  </div>
                  <div class="kt-notification__item-time">
                     Pengaturan Akun & Profil
                  </div>
               </div>
            </a>
            <div class="kt-notification__custom kt-space-between">
               <a href="<?= base_url('login/logout_proc');?>" class="btn btn-label btn-label-brand btn-sm btn-bold">Log Out</a>
            </div>
         </div>

         <!--end: Navigation -->
      </div>
   </div>

   <!--end: User Bar -->
</div>
<!-- end:: Header Topbar -->

</div>
<!-- end:: Header -->