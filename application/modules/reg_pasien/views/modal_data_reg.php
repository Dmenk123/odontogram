<div class="modal fade modal_detail" tabindex="-1" role="dialog" aria-labelledby="add_menu" aria-hidden="true" id="modal_form_asuransi">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_form_asuransi_title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <form id="form-asuransi" name="form-asuransi">
            <div class="form-group">
              <input type="hidden" class="form-control" id="id_asuransi" name="id_asuransi">
              <label for="lbl_nama" class="form-control-label">Nama:</label>
              <input type="text" class="form-control" id="nama_asuransi" name="nama_asuransi">
              <span class="help-block"></span>
            </div>
            <div class="form-group">
              <label for="lbl_keterangan" class="form-control-label">Keterangan:</label>
              <input type="text" class="form-control" id="ket_asuransi" name="ket_asuransi">
              <span class="help-block"></span>
            </div>
            <div class="form-group">
              <button type="button" id="btnSaveAsuransi" class="btn btn-primary" onclick="simpanAsuransi()">Simpan</button>
            </div>
          </form>
        </div>
        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
        <div class="col-md-12">
          <table class="table table-striped- table-bordered table-hover table-checkable" id="tabel_asuransi" style="width:100%">
            <thead>
              <tr>
                <td>Nama</td>
                <td>Keterangan</td>
                <td width="25%">Aksi</td>
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