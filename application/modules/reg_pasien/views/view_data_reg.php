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
            <div class="kt-portlet__head-actions row">
              <div><?= $this->template_view->getAddButton(); ?></div>
            </div>
          </div>
        </div>
      </div>
      <div class="kt-portlet__body">
        <div class="row" style="padding-bottom: 20px;">
          <div class="col-md-3 row">
            <label class="col-form-label col-lg-2">Mulai</label>
            <div class="col-lg-9">
              <input type="text" class="form-control kt_datepicker" id="tgl_filter_mulai" readonly placeholder="Tanggal Awal" value="<?= DateTime::createFromFormat('Y-m-d', date('Y-m-d'))->modify('-10 day')->format('d/m/Y'); ?>"/>
            </div>
          </div>
          <div class="col-md-3 row">
            <label class="col-form-label col-lg-2">Hingga</label>
            <div class="col-lg-9">
              <input type="text" class="form-control kt_datepicker" id="tgl_filter_akhir" readonly placeholder="Tanggal Akhir" value="<?= DateTime::createFromFormat('Y-m-d', date('Y-m-d'))->format('d/m/Y'); ?>"/>
            </div>
          </div>
          <div class="col-md-3 row">
            <div class="kt-section">
              <div class="kt-section__content">
                <button type="button" class="btn btn-primary btn-sm" onclick="filter_tanggal()">Cari</button>
                <button type="button" class="btn btn-sm btn-success" onclick="ekspor_excel()">Eksport Excel</button>
                <button type="button" class="btn btn-sm btn-warning" onclick="cetak_data()">Cetak Data</button>
              </div>
            </div>
          </div>
        </div>
        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
          <!--begin: Datatable -->
          <table class="table table-striped- table-bordered table-hover table-checkable" id="tabel_index">
            <thead>
              <tr>
                <th>No Reg</th>
                <th>Nama</th>
                <th>Tgl Masuk</th>
                <th>Pkl Masuk</th>
                <th>Pulang</th>
                <th>Tgl Keluar</th>
                <th>Pkl Keluar</th>
                <th>No Rm</th>
                <th>Tempat Lahir</th>
                <th>Tgl Lahir</th>
                <th>NIK</th>
                <th>JK</th>
                <th>Dokter</th>
                <th>jenis Penjamin</th>
                <th>Asuransi</th>
                <th>No Asuransi</th>
                <th>Umur</th>
                <th>Pemetaan</th>
                <th style="width: 5%;">Aksi</th>
              </tr>
            </thead>
          </table>
          <!--end: Datatable -->
        
      </div>
    </div>
  </div>
  
</div>



