<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

  <!-- begin:: Content Head -->
  <div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
      <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">
          <?= $this->template_view->nama('judul'); ?>
        </h3>
      </div>
    </div>
  </div>
  <!-- end:: Content Head -->

  <!-- begin:: Content -->
  <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

    <div class="kt-portlet kt-portlet--mobile">

      <div class="kt-portlet__body">

        <form id="form-monitoring" name="form-monitoring">
          <div class="row">
            <div class="form-group col-sm-12">
              <label for="lbl_username" class="form-control-label">Nama Pasien :</label>
              <select class="form-control kt-select2" id="pid" name="pid" style="width: 100%;">
                <option value="">Silahkan Pilih Pasien</option>
                <?php foreach ($data_pasien as $key => $value) { ?>
                  <option value="<?= $value->id; ?>" <?php if ($value->id == $this->input->get('pid')) {
                                                        echo 'selected';
                                                      } ?>>[<?= $value->no_rm; ?>] <?= $value->nama; ?>
                  </option>';
                <?php } ?>
              </select>
              <span class="help-block"></span>
            </div>
          </div>

          <div class="kt-portlet__foot">
            <div class="kt-form__actions">
              <button type="submit" class="btn btn-primary">Submit Pasien</button>
              <button type="reset" class="btn btn-secondary">Cancel</button>
            </div>
          </div>
        </form>
        <?php if ($this->input->get('pid') != '') { ?>
          <div id="div-tabel-area">
            <div class="row">
              <div class="col-12">
                <ul class="nav nav-tabs" role="tablist" id="tab">
                  <li class="nav-item">
                    <a class="nav-link active" href="javascript: void(0);" data-toggle="tab" data-target="#diagnosa" role="tab">Diagnosa</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="javascript: void(0);" data-toggle="tab" data-target="#tindakan" role="tab">Tindakan</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="javascript: void(0);" data-toggle="tab" data-target="#lab" role="tab">Tindakan Lab</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="javascript: void(0);" data-toggle="tab" data-target="#logistik" role="tab">Logistik/Obat</a>
                  </li>
                </ul>
                <div class="tab-content padding-vertical-20">

                  <div class="tab-pane active" id="diagnosa" role="tabpanel">
                    <div class="kt-portlet kt-portlet--mobile">
                      <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label col-8">
                          <h3 class="kt-portlet__head-title">
                            Riwayat <small>Diagnosa</small>
                          </h3>
                        </div>
                        <div class="col-4" style="text-align:right;">
                          <button type="button" class="btn btn-md btn-warning" onclick="openModalRiwayat('diagnosa')">Tambah Data Diagnosa</button>
                        </div>
                      </div>
                      <div class="kt-portlet__body">
                        <div class="table-responsive">
                          <table class="table table-striped- table-bordered table-hover" id="tabel_modal_diagnosa_pasien">
                            <thead>
                              <tr>
                                <th style="width: 10%;">Gigi</th>
                                <th style="width: 10%;">Kode</th>
                                <th>Nama Diagnosa</th>
                                <th>Keterangan</th>
                                <th>Tanggal Diagnosa</th>
                                <th>Klinik</th>
                                <th>Dokter</th>
                              </tr>
                            </thead>
                            <tbody>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane" id="tindakan" role="tabpanel">
                    <div class="kt-portlet kt-portlet--mobile">
                      <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label col-8">
                          <h3 class="kt-portlet__head-title">
                            Riwayat <small>Tindakan</small>
                          </h3>
                        </div>
                        <div class="col-4" style="text-align:right;">
                          <button type="button" class="btn btn-md btn-warning" onclick="openModalRiwayat('tindakan')">Tambah Data Tindakan</button>
                        </div>
                      </div>
                      <div class="kt-portlet__body">
                        <div class="table-responsive">
                          <table class="table table-striped- table-bordered table-hover" id="tabel_modal_tindakan_pasien">
                            <thead>
                              <tr>
                                <th style="width: 10%;">Gigi</th>
                                <th style="width: 10%;">Kode</th>
                                <th>Nama Tindakan</th>
                                <th style="width: 15%;">Harga</th>
                                <th>Keterangan</th>
                                <th>Tanggal Tindakan</th>
                                <th>Klinik</th>
                                <th>Dokter</th>
                              </tr>
                            </thead>
                            <tbody>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane" id="lab" role="tabpanel">
                    <div class="kt-portlet kt-portlet--mobile">
                      <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label col-8">
                          <h3 class="kt-portlet__head-title">
                            Riwayat <small>Lab</small>
                          </h3>
                        </div>
                      </div>
                      <div class="kt-portlet__body">
                        <div class="table-responsive">
                          <table class="table table-striped- table-bordered table-hover" id="tabel_modal_tindakan_lab_pasien">
                            <thead>
                              <tr>
                                <th style="width: 10%;">Kode</th>
                                <th>Nama Tindakan Lab</th>
                                <th>Keterangan</th>
                                <th>Tanggal Tindakan</th>
                                <th>Klinik</th>
                                <th>Dokter</th>
                              </tr>
                            </thead>
                            <tbody>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane" id="logistik" role="tabpanel">
                    <div class="kt-portlet kt-portlet--mobile">
                      <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label col-8">
                          <h3 class="kt-portlet__head-title">
                            Riwayat <small>Logistik</small>
                          </h3>
                        </div>
                        <div class="col-4" style="text-align:right;">
                          <button type="button" class="btn btn-md btn-warning" onclick="openModalRiwayat('logistik')">Tambah Data Logistik</button>
                        </div>
                      </div>
                      <div class="kt-portlet__body">
                        <div class="table-responsive">
                          <table class="table table-striped- table-bordered table-hover" id="tabel_modal_logistik_pasien">
                            <thead>
                              <tr>
                                <th>Kode</th>
                                <th>Nama Logistik</th>
                                <th>Keterangan</th>
                                <th>Tanggal</th>
                                <th>Klinik</th>
                                <th>Dokter</th>
                              </tr>
                            </thead>
                            <tbody>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
              <div>
              </div>
            <?php } ?>
            </div>
          </div>
      </div>

    </div>