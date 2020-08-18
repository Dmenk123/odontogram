</div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
        <b>Sistem Informasi Keuangan | SMP Darul Ulum</b>
        </div>
        <strong>Copyright &copy; <?php echo date('Y'); ?> SMP Darul Ulum </strong> All rights
        reserved.
    </footer>
    
    <!-- *** FOOTER END *** -->
</div>
 <!-- ./wrapper -->

    <?php
    if(isset($modal)){
        echo $modal;
    } ?>

    <!-- jQuery 2.2.3 -->
    <script src="<?php echo config_item('assets'); ?>jQuery/jquery-2.2.3.min.js"></script>
    <!-- jquery validation -->
    <script src="<?php echo config_item('assets'); ?>js/jquery-validation.js"></script>
    <!-- jQuery UI  -->
    <script src="<?php echo config_item('assets'); ?>jQueryUI/jquery-ui.min.js"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.6 -->
    <script src="<?php echo config_item('assets'); ?>bootstrap/js/bootstrap.min.js"></script>
    <!-- Sparkline -->
    <script src="<?php echo config_item('assets'); ?>sparkline/jquery.sparkline.min.js"></script>
    <!-- datepicker -->
    <script src="<?php echo config_item('assets'); ?>datepicker/bootstrap-datepicker.js"></script>
    <!-- select2 -->
    <script src="<?php echo config_item('assets'); ?>select2/select2.min.js"></script>
    <!-- chartjs -->
    <script src="<?php echo config_item('assets'); ?>chartjs/Chart.min.js"></script>
    <!-- Slimscroll -->
    <script src="<?php echo config_item('assets'); ?>slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo config_item('assets'); ?>fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo config_item('assets'); ?>adminlte/app.min.js"></script>
    <!-- DataTables -->
    <script src="<?php echo config_item('assets')?>datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo config_item('assets')?>datatables/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo config_item('assets')?>js/sweetalert.min.js"></script>
    <script src="<?php echo config_item('assets')?>js/jquery-maskmoney.min.js"></script>
    <script src="<?php echo config_item('assets')?>js/dobpicker.js"></script>
    <!-- load js per modul -->
    <?php
    if(isset($js)){
        echo $js;
    } ?>

    <span class="hidden" id="base_url"><?php echo base_url();?></span>
	<script src="<?php echo site_url('assets'); ?>/jsModul/modal.js"></script>

  <script>
    $(document).ready(function() {
      $(window).load(function() {
         // $('#loading').hide();
         $('#CssLoader').addClass('hidden');
      });

      $('.tombol-simpan').click(function(event) {
        $('#CssLoader').removeClass('hidden');
      });

      //update dt_read after click
      $(document).on('click', '.linkNotif', function(){
          var id = $(this).attr('id');
          $.ajax({
              url : "<?php echo site_url('inbox_adm/update_read_email/')?>" + id,
              type: "POST",
              dataType: "JSON",
              success: function(data)
              {
                  location.href = "<?php echo site_url('inbox_adm')?>";
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  alert('Error get data from ajax');
              }
          });
      });      
    });
    //end jquery

    // setInterval(function(){
    //   $("#load_row").load('<?=base_url()?>inbox_adm/load_email_row_notif')
    // }, 10000); //menggunakan setinterval jumlah notifikasi akan selalu update setiap 10 detik diambil dari controller notifikasi fungsi load_row
     
    // setInterval(function(){
    //     $("#load_data").load('<?=base_url()?>inbox_adm/load_email_data_notif')
    // }, 10000); //yang ini untuk selalu cek isi data notifikasinya sama setiap 10 detik diambil dari controller notifikasi fungsi load_data

    //fix to issue select2 on modal when opening in firefox, thanks to github
    $.fn.modal.Constructor.prototype.enforceFocus = function() {};
  </script>
  
</body>
</html>