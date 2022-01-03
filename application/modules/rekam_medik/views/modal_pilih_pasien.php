<div class="modal fade modal_detail" tabindex="-1" role="dialog" aria-labelledby="add_menu" aria-hidden="true" id="modal_pilih_pasien">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_pilih_pasien_title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form id="form_cari_pasien" name="form_cari_pasien">
          <div class="col-12">
            <div class="row" style="padding-bottom: 20px;">
              <div class="col-5 row">
                <label class="col-form-label col-lg-2">Mulai</label>
                <div class="col-lg-9">
                  <input type="text" class="form-control kt_datepicker" id="tgl_filter_mulai" name="tgl_filter_mulai" readonly placeholder="Tanggal Awal" value="<?= DateTime::createFromFormat('Y-m-d', date('Y-m-d'))->modify('-10 day')->format('d/m/Y'); ?>" />
                </div>
              </div>
              <div class="col-5 row">
                <label class="col-form-label col-lg-2">Hingga</label>
                <div class="col-lg-9">
                  <input type="text" class="form-control kt_datepicker" id="tgl_filter_akhir" name="tgl_filter_akhir" readonly placeholder="Tanggal Akhir" value="<?= DateTime::createFromFormat('Y-m-d', date('Y-m-d'))->format('d/m/Y'); ?>" />
                </div>
              </div>
              <div class="col-2 row">
                <label class="col-form-label col-lg-2">&nbsp;</label>
                <div>
                  <button type="button" class="btn btn-brand" onclick="cari_pasien()">Cari</button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="row" style="padding-bottom: 20px;">
              <div class="col-md-6 row">
                <label class="col-form-label col-lg-3">Nama</label>
                <div class="col-lg-9">
                  <input type="text" class="form-control" id="pilih_nama" name="pilih_nama" placeholder="Cari Berdasarkan Nama">
                </div>
              </div>
              <div class="col-md-6 row">
                <label class="col-form-label col-lg-3">No. RM</label>
                <div class="col-lg-9">
                  <input type="text" class="form-control" id="pilih_norm" name="pilih_norm" placeholder="Cari Berdasarkan No RM">
                </div>
              </div>
            </div>
          </div>
        </form>
        <hr>
        <div class="col-md-12 table-responsive">
          <table class="table table-striped- table-bordered table-hover table-checkable" id="tabel_pilih_pasien" style="width:100%">
            <thead>
              <tr>
                <td>No. Reg</td>
                <td>Nama</td>
                <td>Tgl Masuk</td>
                <td>Pukul</td>
                <td>No. RM</td>
                <td>Sudah Rekam Medik</td>
                <td>Layanan</td>
                <td>Aksi</td>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>