<div class="modal fade modal_detail" tabindex="-1" role="dialog" aria-labelledby="add_menu" aria-hidden="true" id="div_anamnesa_modal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="div_anamnesa_modal_title">Anamnesa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form id="form_anamnesa" name="form_anamnesa">
          <div class="col-md-12">
            <div class="form-group">
              <input type="hidden" class="form-control" id="id_anamnesa" name="id_anamnesa">
              <textarea name="anamnesa" id="anamnesa" class="form-control">
              </textarea>
            </div>
            <div class="form-group">
              <button type="button" id="btnSave" class="btn btn-primary" onclick="save('form_anamnesa')">Simpan</button>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>