<div class="modal fade modal_detail" tabindex="-1" role="dialog" aria-labelledby="add_menu" aria-hidden="true" id="div_diagnosa_modal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="div_diagnosa_modal_title">Diagnosa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form id="form_diagnosa" name="form_diagnosa">
          <div class="col-md-12">
            <div class="kt-portlet__body">
              <div class="form-group">
                <input type="hidden" class="form-control" id="id_diagnosa" name="id_diagnosa" value="">           
                <label class="col-lg-4 col-form-label">Diagnosa :</label>
                <div class=" col-lg-8 col-sm-12">
                  <select class="form-control kt-select2" id="diagnosa" name="diagnosa" style="width: 100%;">
                    <option value="">Silahkan Pilih Diagnosa</option>
                  </select>
                  <span class="help-block"></span>
                </div>
              </div>
              <div class="form-group">
                <div class=" col-lg-12 col-md-12 col-sm-12">
                  <button type="button" id="btnSave" class="btn btn-primary" onclick="save('form_diagnosa')">Simpan</button>
                </div>
              </div>
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
