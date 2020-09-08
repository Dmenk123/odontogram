<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

  <!-- begin:: Content Head -->
  <div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
      <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">
          <?= $this->template_view->nama('judul').' - '.$title; ?>
        </h3>
      </div>
    </div>
  </div>
  <!-- end:: Content Head -->

  <!-- begin:: Content -->
  <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    
    <div class="kt-portlet kt-portlet--mobile">
      <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
        </div>
        <div class="kt-portlet__head-toolbar">
          <div class="kt-portlet__head-wrapper">
            <div class="kt-portlet__head-actions">
              &nbsp;
              <?= $this->template_view->getOpsiButton(true); ?>
              &nbsp;
              <?= $this->template_view->getAddButton(true, 'add_jabatan'); ?>
            </div>
          </div>
        </div>
      </div>
      <div class="kt-portlet__body">

        <!--begin: Datatable -->
        <table class="table table-striped- table-bordered table-hover table-checkable" id="tabel_index">
          <thead>
            <tr>
              <th style="width: 5%;">No</th>
              <th>Nama</th>
              <th>Keterangan</th>
              <td>Dibuat Pada</td>
              <td>Diedit Pada</td>
              <th style="width: 5%;">Aksi</th>
            </tr>
          </thead>
        </table>

        <!--end: Datatable -->
      </div>
    </div>
  </div>
  
</div>



