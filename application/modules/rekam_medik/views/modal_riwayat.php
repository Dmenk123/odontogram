<div class="modal fade modal_detail" tabindex="-1" role="dialog" aria-labelledby="add_menu" aria-hidden="true" id="div_riwayat_modal">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="div_riwayat_modal_title">Riwayat Pasien</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <div>
          <ul class="nav nav-tabs" role="tablist" id="tab">
              <li class="nav-item" >
                  <a class="nav-link active" href="javascript: void(0);" data-toggle="tab" data-target="#all2" role="tab">Diagnosa</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="javascript: void(0);"  data-toggle="tab" data-target="#otorisasi2" role="tab">Tindakan</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="javascript: void(0);"  data-toggle="tab" data-target="#otorisasi3" role="tab">Tindakan Lab</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="javascript: void(0);"  data-toggle="tab" data-target="#otorisasi4" role="tab">Logistik/Obat</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="javascript: void(0);"  data-toggle="tab" data-target="#otorisasi5" role="tab">Odontogram</a>
              </li>
          </ul>
          <div class="tab-content padding-vertical-20">
              <div class="tab-pane active" id="all2" role="tabpanel">
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
              <div class="tab-pane" id="otorisasi2" role="tabpanel">
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
              <div class="tab-pane" id="otorisasi3" role="tabpanel">
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
              <div class="tab-pane" id="otorisasi4" role="tabpanel">
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
              <div class="tab-pane" id="otorisasi5" role="tabpanel">
                <div class="table-responsive">
                  <table class="table table-striped- table-bordered table-hover" id="tabel_modal_odontogram_pasien">
                      <thead>
                        <tr>
                          <th>file odontogram</th>
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
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
