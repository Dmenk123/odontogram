
<div class="modal fade modal_add_form" tabindex="-1" role="dialog" aria-labelledby="add_menu" aria-hidden="true" id="modal_form">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form id="form-modal" name="form-modal">
          <div class="form-group">
            <input type="hidden" class="form-control" id="id_pemetaan" name="id_pemetaan">
            <label for="lbl_nama_keterangan" class="form-control-label">Keterangan:</label>
            <input type="text" class="form-control" id="keterangan" name="keterangan">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_nama_umur_awal" class="form-control-label">Umur Awal:</label>
            <input type="text" class="form-control numberinput" id="umur_awal" name="umur_awal">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_nama_umur_akhir" class="form-control-label">Umur Akhir:</label>
            <input type="text" class="form-control numberinput" id="umur_akhir" name="umur_akhir">
            <span class="help-block"></span>
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