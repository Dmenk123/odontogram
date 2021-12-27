<!-- begin:: Content -->
<!-- <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content"> -->
<div id="kt_header" class="header header-fixed">
  <!-- begin:: Content -->
  <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

    <div class="kt-portlet kt-portlet--mobile">
      <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
        </div>
        <div class="kt-portlet__head-toolbar">
          <div class="kt-portlet__head-wrapper">
            <div class="kt-portlet__head-actions row">
              <div>&nbsp;</div>
              <div><?= $this->template_view->getAddButton(true, 'add_menu'); ?></div>
            </div>
          </div>
        </div>
      </div>
      <div class="kt-portlet__body">

        <!--begin: Datatable -->
        <table class="table table-striped- table-bordered table-hover table-checkable" id="tabel_data">
          <thead>
            <tr>
              <th>Nama</th>
              <th>Dibuat Pada</th>
              <th style="width: 5%;">Aksi</th>
            </tr>
          </thead>
        </table>

        <!--end: Datatable -->
      </div>
    </div>
  </div>

</div>