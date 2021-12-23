<!-- <style>
  .modal-lg {
    max-width: 80%;
  }
</style> -->
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
          <div class="form-group">
            <input type="hidden" class="form-control" id="id_layanan" name="id_layanan">
            <label for="lbl_nama_pegawai" class="form-control-label">Kode Layanan:</label>
            <input type="text" class="form-control" id="kode" name="kode">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_telp1" class="form-control-label">Nama Layanan:</label>
            <input type="text" class="form-control" id="nama" name="nama">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_telp1" class="form-control-label">Keterangan:</label>
            <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_telp1" class="form-control-label">Waktu Layanan:</label>
            <input type="number" class="form-control" id="waktu" name="waktu">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_telp1" class="form-control-label">Dokter yg melayani:</label>
            <br>
            <?php
              foreach ($dokter as $value) {
            ?>
                <label class="kt-checkbox kt-checkbox--success">
                  <input type="checkbox" name="dokter[]" value="<?= $value->id;?>"> <?= $value->nama;?>
                  <span></span>
                </label><br>
            <?php
              }
            ?>
           
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