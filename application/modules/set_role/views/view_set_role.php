<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

  <!-- begin:: Content Head -->
  <div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
      <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">
          <?= $title ?>
        </h3>
      </div>

      <!-- <div class="kt-subheader__toolbar">
        <a href="#" class="">
        </a>
        <?= $this->template_view->getAddButton(); ?>
      </div> -->
    </div>
  </div>
  <!-- end:: Content Head -->

  <!-- begin:: Content -->
  <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

    <?php if ($this->session->flashdata('feedback_sukses')) { ?>
      <div class="alert alert-light alert-elevate"  align="center" role="alert">
        <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
        <div class="alert-text alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-check"></i> <span style="color:blue;"><strong>Berhasil!</strong></span></h4>
          <span style="color:blue;"><?= $this->session->flashdata('feedback_sukses') ?></span>
        </div>
      </div>
      <?php } elseif ($this->session->flashdata('feedback_gagal')) { ?>
      <div class="alert alert-light alert-elevate"  align="center" role="alert">
        <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
        <div class="alert-text alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-remove"></i> <span style="color:red;"><strong>Gagal!</strong></span></h4>
          <span style="color:red;"><?= $this->session->flashdata('feedback_gagal') ?></span>
        </div>
      </div>
    <?php } ?>

    <div class="kt-portlet kt-portlet--mobile">
      <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
          <span class="kt-portlet__head-icon">
            <i class="kt-font-brand flaticon2-line-chart"></i>
          </span>
          <h3 class="kt-portlet__head-title">
            <?= $title_tabel; ?>
          </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
          <div class="kt-portlet__head-wrapper">
            <div class="kt-portlet__head-actions">
              &nbsp;
              <?= $this->template_view->getAddButton(); ?>
            </div>
          </div>
        </div>
      </div>
      <div class="kt-portlet__body">

        <!--begin: Datatable -->
        <table class="table table-striped- table-bordered table-hover table-checkable" id="tabel_role">
          <thead>
            <tr>
              <th style="width: 5%;">No</th>
              <th>Nama Role</th>
              <th>Keterangan</th>
              <th style="width: 13%;">Aksi</th>
            </tr>
          </thead>
        </table>

        <!--end: Datatable -->
      </div>
    </div>
  </div>
  
</div>
