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

        <!--begin: Datatable -->
        <ul class="nav nav-tabs" role="tablist" id="tab">
            <li class="nav-item" >
                <a class="nav-link active" href="javascript: void(0);" data-toggle="tab" data-target="#rutin-tab" role="tab">Jadwal Rutin</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="javascript: void(0);" style="background-color: #eaeaea;" data-toggle="tab" data-target="#tidak-rutin-tab" role="tab" onclick="tabel_broadcast()">Jadwal Tidak Rutin</a>
            </li>
        </ul>
        <div class="tab-content padding-vertical-20">
          <div class="tab-pane active" id="rutin-tab" role="tabpanel">
                 <?= $this->template_view->getAddButton(true, 'add_jadwal_rutin'); ?>
                 <p>&nbsp;</p>
                <table class="table table-striped- table-bordered table-hover table-checkable" id="tabel_rutin">
                    <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th>Nama Dokter</th>
                        <th>Klinik</th>
                        <th>Hari</th>
                        <th>Jam Mulai</th>
                        <th>Jam Akhir</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>      
                </table>
          </div>
          <div class="tab-pane" id="tidak-rutin-tab" role="tabpanel">
                <?= $this->template_view->getAddButton(true, 'add_jadwal_tidak_rutin'); ?>
                 <p>&nbsp;</p>
                <table class="table table-striped- table-bordered table-hover table-checkable" id="tabel_tidak_rutin">
                    <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th>Nama Dokter</th>
                        <th>Klinik</th>
                        <th>Tanggal</th>
                        <th>Jam Mulai</th>
                        <th>Jam Akhir</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>      
                </table>
          </div>
        </div>
        <!--end: Datatable -->
      </div>
    </div>
  </div>
  
</div>



