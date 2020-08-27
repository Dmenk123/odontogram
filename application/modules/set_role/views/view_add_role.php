<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

  <!-- begin:: Content Head -->
  <div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
      <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">
          <?= $title ?>
        </h3>
      </div>
    </div>
  </div>
  <!-- end:: Content Head -->

  <!-- begin:: Content -->
  <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

    
      <div class="alert alert-light alert-elevate" role="alert">
        <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
        <div class="alert-text alert-dismissible">
            Mohon Checklist / Centang Menu yang akan diakses beserta tombol-tombol pada menu tersebut untuk dipasangkan dengan Hak Akses User.
        </div>
      </div>
      

    <div class="kt-portlet kt-portlet--mobile">
      <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
          <span class="kt-portlet__head-icon">
            <i class="kt-font-brand flaticon2-line-chart"></i>
          </span>
          <h3 class="kt-portlet__head-title">
            <?= $title; ?>
          </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
          <div class="kt-portlet__head-wrapper">
            <div class="kt-portlet__head-actions">
            </div>
          </div>
        </div>
      </div>

      <div class="kt-portlet__body">

        <form class="form-add-role kt-form" id="form-add-role" action="<?=base_url()."".$this->uri->segment(1)."/".$this->uri->segment(2);?>_data" method="post">
              <div class="box-header">
              <input type="hidden" value="" name="id_role">
                <div class="form-group">
                  <label class="control-label col-sm-12">Role User :</label>
                  <div class="col-sm-12">
                    <input type="input" class="form-control required" id="nama_role" value="" name="nama_role">
                  </div>
                </div>
                <br>
                <div class="form-group">
                  <label class="control-label col-sm-12">Keterangan (jika diperlukan) : </label>
                  <div class="col-sm-12">
                    <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                  </div>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="form-group">										
                  <div class="table-responsive"> 
                    <?php echo $check_box_menu; ?>
                  </div>
                  <!-- responsive --> 
                </div>
              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                  <button type="submit" class="btn btn-primary tombol-simpan"> Tambah Data</button>
                  <a href="<?=base_url()."".$this->uri->segment(1);?>">
                    <span class="btn btn-warning"><i class="glyphicon glyphicon-remove"></i> Batal</span>
                  </a>
                </div>
              </div>
              </div>
              <!-- /.box-body -->
            </form>

        <!--end: Datatable -->
      </div>
    </div>
  </div>
  
</div>


