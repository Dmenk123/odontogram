<div class="modal fade modal_detail" tabindex="-1" role="dialog" aria-labelledby="add_menu" aria-hidden="true" id="div_logistik_modal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="div_logistik_modal_title">Logistik</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form id="form_logistik" name="form_logistik">
          <div class="col-md-12">
            <div class="kt-portlet__body">
              <div class="form-group">
                <input type="hidden" class="form-control" id="id_logistik" name="id_logistik" value="">
                <input type="hidden" class="form-control" id="harga_jual_raw" name="harga_jual_raw" value="">        
                <div class="col-12 row">
                  <label class="col-8 col-form-label">Pilih Obat :</label>
                  <label class="col-4 col-form-label">Qty :</label>
                </div>
                <div class="col-12 row">
                  <div class="col-8">
                    <select class="form-control kt-select2" id="logistik" name="logistik" style="width: 100%;">
                      <option value="">Silahkan Pilih Obat</option>
                    </select>
                    <span class="help-block"></span>
                  </div>
                  <div class="col-4">
                    <input type="number" class="form-control" id="qty_obat" name="qty_obat" value="">   
                    <span class="help-block"></span>
                  </div>
                </div>
                <br>
                <div class="col-12">
                  <button type="button" id="btnSave" class="btn btn-primary" onclick="save('form_logistik')">Tambahkan</button>
                </div>
                <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
               
                <div class=" col-lg-12 col-sm-12">
                  <h3>Tabel Resep Obat</h3>
                  <table class="table table-striped- table-bordered table-hover" id="tabel_modal_logistik">
                    <thead>
                      <tr>
                        <th>Nama</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Jenis</th>
                        <th>Subtotal</th>
                        <th style="width: 10%;">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
                <br>
                <div class="col-12 row">
                  <label class="col-12 col-form-label">Keterangan :</label>
                </div>
                <div class="col-12">
                  <input type="text" class="form-control" id="ket_resep" name="ket_resep" value="" autocomplete="off">   
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
