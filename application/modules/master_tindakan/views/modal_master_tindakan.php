
<div class="modal fade modal_add_form" tabindex="-1" role="dialog" aria-labelledby="add_menu" aria-hidden="true" id="modal_pegawai_form">
  <div class="modal-dialog modal-xs" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form id="form-pegawai" name="form-pegawai">
          <!-- <div class="form-group">
            <label for="lbl_nama_pegawai" class="form-control-label">Kode Tindakan:</label>
            <input type="text" class="form-control" id="kode" name="kode">
            <span class="help-block"></span>
          </div> -->
          <div class="form-group">
            <label for="lbl_telp1" class="form-control-label">Nama Tindakan:</label>
            <input type="hidden" class="form-control" id="id_tindakan" name="id_tindakan">
            <input type="text" class="form-control" id="nama" name="nama">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_telp1" class="form-control-label">Harga:</label>
            <input type="number" class="form-control" id="harga" name="harga">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_telp1" class="form-control-label">Diskon (%):</label>
            <input type="text" class="form-control numberinput" id="diskon" name="diskon" value="0">
            <span class="help-block"></span>
          </div>
          <div class="form-group row">
            <label class="col-6 col-form-label">Untuk Semua Gigi</label>
            <div class="col-6">
              <span class="kt-switch kt-switch--icon">
                <label>
                  <input type="checkbox" name="is_all_gigi" id="is_all_gigi" value="1">
                  <span></span>
                </label>
              </span>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-6 col-form-label">Potong Lab Honor Dokter</label>
            <div class="col-6">
              <span class="kt-switch kt-switch--icon">
                <label>
                  <input type="checkbox" name="is_potong_lab_honor" id="is_potong_lab_honor" value="1">
                  <span></span>
                </label>
              </span>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="btnSave" onclick="save()">Simpan</button>
      </div>
    </div>
  </div>
</div>