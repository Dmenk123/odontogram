<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PT. Surya Putra Barutama</title>
  <link rel="shortcut icon" href="<?php echo config_item('assets'); ?>img/logo_thumb.png" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo config_item('assets'); ?>bootstrap/css/bootstrap.min.css">
  <!-- jquery-ui.css -->
  <link rel="stylesheet" href="<?php echo config_item('assets'); ?>plugins/jQueryUI/themes/base/jquery-ui.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo config_item('assets'); ?>bootstrap/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo config_item('assets'); ?>bootstrap/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo config_item('assets'); ?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo config_item('assets'); ?>dist/css/skins/skin-black.css">
  <!-- <link rel="stylesheet" href="<?php echo config_item('assets'); ?>dist/css/skins/_all-skins.min.css"> -->
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo config_item('assets'); ?>plugins/datepicker/datepicker3.css">
  <!-- Month Picker -->
  <link rel="stylesheet" href="<?php echo config_item('assets'); ?>plugins/monthpicker/MonthPicker.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo config_item('assets'); ?>plugins/daterangepicker/daterangepicker.css">
  <!-- select2 -->
  <link rel="stylesheet" href="<?php echo config_item('assets'); ?>plugins/select2/select2.min.css">
  <link rel="stylesheet" href="<?php echo config_item('assets'); ?>plugins/select2/select2-bootstrap.css">
  <!-- css notifikasi -->
  <link rel="stylesheet" href="<?php echo config_item('assets'); ?>bootstrap/css/notifikasi.css">
  

<?php 
  //load file css per modul
  if(isset($css)){
    $this->load->view($css);
  }
?>

</head>
<!-- configure skin theme in body class -->
<body class="hold-transition skin-black sidebar-mini">
<div class="wrapper">
  <!-- menu header -->
  <?php $this->load->view('menu_header') ?>

  <!-- Left side column. contains the logo and sidebar -->
  <?php $this->load->view('menu_sidebar') ?>
  <!-- Content Wrapper. Contains page content -->

  <!-- content -->
  <!-- load content from controller -->
  <!-- cek id level to unset notif stok if true -->
  <?php if ($this->session->userdata('id_level_user') =='2' || $this->session->userdata('id_level_user') =='4') {
     unset($_SESSION['cek_stok']);
  } ?>
  <div class="content-wrapper">
    <?php if ($this->session->flashdata('cek_stok')) { ?>
    <div class="alert alert-danger" style="height: 45px; margin: 0px;">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
      <strong><p class="icon fa fa-warning" align="center"> Peringatan : <?php echo $this->session->flashdata('cek_stok'); ?></p></strong>
    </div>
    <?php } ?>
    
    <?php 
    if (isset($content)) {
    	$this->load->view($content); 
    } ?>
  </div>
  <!-- /.content-wrapper -->
  
  <!-- footer -->
  <?php $this->load->view('menu_footer') ?>
  <!-- /footer -->
</div>
<!-- ./wrapper -->
  
  <!-- load modal per modul -->
  <?php
  if(isset($modal)){
    $this->load->view($modal);
  } ?>

  <!-- jQuery 2.2.3 -->
  <script src="<?php echo config_item('assets'); ?>plugins/jQuery/jquery-2.2.3.min.js"></script>
  <!-- jQuery UI  -->
  <script src="<?php echo config_item('assets'); ?>plugins/jQueryUI/jquery-ui.min.js"></script>
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- Bootstrap 3.3.6 -->
  <script src="<?php echo config_item('assets'); ?>bootstrap/js/bootstrap.min.js"></script>
  <!-- Sparkline -->
  <script src="<?php echo config_item('assets'); ?>plugins/sparkline/jquery.sparkline.min.js"></script>
  <!-- daterangepicker -->
  <script src="<?php echo config_item('assets'); ?>plugins/daterangepicker/moment.min.js"></script>
  <script src="<?php echo config_item('assets'); ?>plugins/daterangepicker/daterangepicker.js"></script>
  <!-- datepicker -->
  <script src="<?php echo config_item('assets'); ?>plugins/datepicker/bootstrap-datepicker.js"></script>
  <!-- monthpicker -->
  <script src="<?php echo config_item('assets'); ?>plugins/monthpicker/MonthPicker.js"></script>
  <!-- typeahead -->
  <script src="<?php echo config_item('assets'); ?>plugins/typeahead/typeahead.js"></script>
  <!-- select2 -->
  <script src="<?php echo config_item('assets'); ?>plugins/select2/select2.min.js"></script>
  <!-- chartjs -->
  <script src="<?php echo config_item('assets'); ?>plugins/chartjs/Chart.min.js"></script>
  <!-- Slimscroll -->
  <script src="<?php echo config_item('assets'); ?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="<?php echo config_item('assets'); ?>plugins/fastclick/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo config_item('assets'); ?>dist/js/app.min.js"></script>
  
  <!-- load js per modul -->
  <?php
  if(isset($js)){
    $this->load->view($js);
  } ?>
  
</body>
</html>
