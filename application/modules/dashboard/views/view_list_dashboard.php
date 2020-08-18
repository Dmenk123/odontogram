    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Dashboard
        <?php if ($this->session->userdata('id_level_user') == '5') { ?>
          <small><strong>Selamat Datang : <?php foreach ($data_user as $key) {
          echo $key->nama;
        } ?></strong></small>
        <?php }else{ ?>
          <small><strong>Selamat Datang : <?php foreach ($data_user as $key) {
            echo $key->nama_lengkap_user;
          } ?></strong></small>
        <?php } ?>
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="box">
        <div class="box-body">
          <?php
          if ($component) {
             $this->load->view($component, $data_dashboard); 
          } 
          ?>
        </div>
      </div>       
    </section>
    <!-- /.content -->
