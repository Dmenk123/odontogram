<div class="modal fade modal_detail" tabindex="-1" role="dialog" aria-labelledby="add_menu" aria-hidden="true" id="div_tindakanlab_modal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="div_tindakanlab_modal_title">Tindakan Lab</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form id="form_tindakanlab" name="form_tindakanlab">
          <div class="col-md-12">
            <div class="kt-portlet__body">
              <div class="form-group">
                <input type="hidden" class="form-control" id="id_tindakanlab" name="id_tindakanlab" value="">           
                <div class="col-12 row">
                  <label class="col-12 col-form-label">Tindakan :</label>
                </div>
                <div class="col-12 row">
                  <div class="col-12">
                    <select class="form-control kt-select2" id="tindakanlab" name="tindakanlab" style="width: 100%;">
                      <option value="">Silahkan Pilih Tindakan Lab</option>
                    </select>
                    <span class="help-block"></span>
                  </div>
                </div>
                <br>
                <div class="col-12 row">
                  <label class="col-2 col-form-label">Kode :</label>
                  <label class="col-5 col-form-label">Tindakan Lab:</label>
                  <label class="col-5 col-form-label">Keterangan :</label>
                </div>
                <div class="col-12 row">
                  <div class="col-2">
                    <input type="text" class="form-control" id="tdklab_kode" name="tdklab_kode" value="" readonly>   
                    <span class="help-block"></span>
                  </div>
                  <div class="col-5">
                    <input type="text" class="form-control" id="tdklab_tindakan" name="tdklab_tindakan" value="" readonly>   
                    <span class="help-block"></span>
                  </div>
                  <div class="col-5">
                    <input type="text" class="form-control" id="tdklab_ket" name="tdklab_ket" value="">   
                    <span class="help-block"></span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-12 row">
                  <label class="col-4 col-form-label">Harga (Gross):</label>
                  <label class="col-4 col-form-label">Diskon (%):</label>
                  <label class="col-4 col-form-label">Nett :</label>
                </div>
                <div class="col-12 row">
                  <div class="col-4">
                    <input type="text" data-thousands="." data-decimal="," id="tdklab_harga" name="tdklab_harga" class="form-control inputmask" onkeyup="setHargaLabRaw()" value="0">
                    <input type="hidden" class="form-control" id="tdklab_harga_raw" name="tdklab_harga_raw" value="">
                    <span class="help-block"></span>
                  </div>
                  <div class="col-4">
                    <input type="text" class="form-control" id="tdklab_diskon" name="tdklab_diskon" value="" disabled>
                    <span class="help-block"></span>
                  </div>
                  <div class="col-4">
                    <input type="text" id="tdklab_nett" name="tdklab_nett" class="form-control" value="0" style="text-align: right;" disabled>
                    <input type="hidden" class="form-control" id="tdklab_nett_raw" name="tdklab_nett_raw" value="">
                    <span class="help-block"></span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-12">
                  <button type="button" id="btnSave" class="btn btn-primary" onclick="save('form_tindakanlab')">Tambahkan</button>
                </div>
              </div>
              <div class="form-group">
                <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
               
                <div class=" col-lg-12 col-sm-12">
                  <h3>Tabel tindakan Lab Pasien</h3>
                  <table class="table table-striped- table-bordered table-hover" id="tabel_modal_tindakanlab">
                    <thead>
                      <tr>
                        <th>Kode</th>
                        <th>Nama tindakan</th>
                        <th>Harga</th>
                        <th>Keterangan</th>
                        <th style="width: 10%;">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
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
