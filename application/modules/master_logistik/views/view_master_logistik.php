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
              <!-- &nbsp;
              <?= $this->template_view->getOpsiButton(); ?> -->
              &nbsp;
              <?= $this->template_view->getAddButton(true, 'add_logistik'); ?>
            </div>
          </div>
        </div>
      </div>
      <div class="kt-portlet__body">
        <div>
            <ul class="nav nav-tabs" role="tablist" id="tab">
                <li class="nav-item" >
                    <a class="nav-link active" href="javascript: void(0);" data-toggle="tab" data-target="#all" role="tab">Data Logistik</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript: void(0);" style="background-color: #eaeaea;" data-toggle="tab" data-target="#otorisasi" role="tab">jenis Logistik</a>
                </li>
            </ul>
            <div class="tab-content padding-vertical-20">
                <div class="tab-pane active" id="all" role="tabpanel">
                <table class="table table-striped- table-bordered table-hover table-checkable" id="tabel_logistik">
                  <thead>
                    <tr>
                      <th style="width: 5%;">No</th>
                      <th>Kode</th>
                      <th>Nama</th>
                      <!-- <th>Harga Beli</th>
                      <th>Harga Jual</th> -->
                      <th>Stok</th>
                      <th>Jenis</th>
                      <th style="width: 5%;">Aksi</th>
                    </tr>
                  </thead>
                </table>
                </div>
                <div class="tab-pane" id="otorisasi" role="tabpanel">
                  <form id="jenis-logistik" name="jenis-logistik">
                    <div class="form-group row">
                      <label for="inputPassword" class="col-sm-2 col-form-label">Jenis Logistik</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="nama_jenis" name="nama_jenis">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                      <div class="col-sm-10">
                        <button type="button" class="btn btn-primary" id="btnSave" onclick="save_jenis()">Tambah</button>
                      </div>
                    </div>
                  </form>
                  <table class="table table-striped- table-bordered table-hover table-checkable" id="tabel_jenis_logistik">
                    <thead>
                      <tr>
                        <th style="width: 5%;">No</th>
                        <th>Jenis Logistik dan Obat</th>
                        <th style="width: 5%;">Aksi</th>
                      </tr>
                    </thead>
                  </table>
                </div>
                
            </div>
        </div>
      </div>
    </div>
  </div>
  
</div>




