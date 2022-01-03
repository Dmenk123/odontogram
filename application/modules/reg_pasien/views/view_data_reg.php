<!-- begin:: Content -->
<!-- <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content"> -->
<div id="kt_header" class="header header-fixed">

  <!-- begin:: Content Head -->
  <!-- <div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
      <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">
          <?= $this->template_view->nama('judul').' - '.$title; ?>
        </h3>
      </div>
    </div>
  </div> -->
  <!-- end:: Content Head -->

  <!-- begin:: Content -->
  <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    
    <div class="kt-portlet kt-portlet--mobile">
      <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label"> 
          <span class="kt-portlet__head-icon"> 
            <i class="kt-font-brand flaticon2-line-chart"></i> 
          </span> 
          <h3 class="kt-portlet__head-title"> <?= $this->template_view->nama('judul').' - '.$title; ?> </h3> 
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
        <ul class="nav nav-tabs" role="tablist" id="tab">
            <li class="nav-item" >
                <a class="nav-link active" href="javascript: void(0);" data-toggle="tab" data-target="#reg-tab" role="tab">Data Registrasi</a>
            </li>
            <?php if(!in_array($this->session->userdata('id_role'), ['1','2'])) { ?>
            <li class="nav-item">
                <a class="nav-link" href="javascript: void(0);" style="background-color: #eaeaea;" data-toggle="tab" data-target="#wa-tab" role="tab" onclick="tabel_broadcast()">Broadcast</a>
            </li>
            <?php } ?>
        </ul>
        <div class="tab-content padding-vertical-20">
          <div class="tab-pane active" id="reg-tab" role="tabpanel">
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
                <div class="col-md-6 row">
                  <label class="col-form-label col-lg-2">&nbsp;</label>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="btn-group btn-group" role="group" aria-label="...">
                        <button type="button" class="btn btn-primary btn-sm" onclick="filter_tanggal()">Cari</button>
                        <button type="button" class="btn btn-sm btn-success" onclick="ekspor_excel()">Eksport Excel</button>
                        <button type="button" class="btn btn-sm btn-warning" onclick="cetak_data()">Cetak Data</button>
                      </div>
                    </div>
                  </div>
                </div>
            </div>

            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable" id="tabel_index">
              <thead>
                <tr>
                  <th>Tgl Masuk</th>
                  <th>Pkl Masuk</th>
                  <th>No Reg</th>
                  <th>No Rm</th>
                  <th>Nama</th>
                  <th>Klinik</th>
                  <th>Layanan</th>
                  <th>Dokter</th>
                  <th>Rekam Medik</th>
                  <th>Tgl Keluar</th>
                  <th>Pkl Keluar</th>
                  <th>Tempat Lahir</th>
                  <th>Tgl Lahir</th>
                  <th>NIK</th>
                  <th>JK</th>
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
          <?php if(!in_array($this->session->userdata('id_role'), ['1','2'])) { ?>
              <div class="tab-pane" id="wa-tab" role="tabpanel">
           
                <h3>Silahkan pilih ceklist pada tabel dibawah ini. kemudian klik "Pilih & Broadcast"</h3>
                <form name="form_broadcast" id="form_broadcast">
                  <p class="form-group">
                    <button type="submit" class="btn btn-primary">Pilih & Broadcast</button>
                  </p>
                  <table class="table table-striped- table-bordered table-hover table-checkable" id="tabel_broadcast">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>No Reg</th>
                        <th>Nama</th>
                        <th>No Rm</th>
                        <th>Tgl Daftar</th>
                        <th>Jam Daftar</th>
                        <th>Klinik</th>
                        <th>Dokter</th>
                        <th style="width: 5%;"></th>
                      </tr>
                    </thead>
                  </table>
                </form>
              </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
  
</div>



