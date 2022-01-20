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
                <div class="col-12 row">
                  <label class="col-8 col-form-label">Pilih Obat : </label>
                  <label class="col-4 col-form-label">Qty :</label>
                </div>
                <div class="col-12 row">
                  <div class="col-8">
                    <select class="form-control kt-select2" id="log_logistik" name="log_logistik" style="width: 100%;">
                      <option value="">Silahkan Pilih Obat</option>
                    </select>
                    <span class="help-block"></span>
                  </div>
                  <div class="col-4">
                    <input type="number" class="form-control" id="log_qty" name="log_qty" value="">
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="col-12 row">
                  <label class="col-8 col-form-label">Dokter : </label>
                  <label class="col-4 col-form-label">Tanggal : </label>
                </div>
                <div class="col-12 row">
                  <div class="col-8">
                    <select class="form-control kt-select2" id="log_dokter" name="log_dokter" style="width: 100%;">
                      <option value="">Silahkan Pilih</option>
                      <?php $q = $this->db->get_Where('m_pegawai', ['is_aktif' => 1, 'id_jabatan' => 1])->result(); 
                      foreach ($q as $key => $value) {
                        echo "<option value='$value->id'>$value->nama</option>";
                      }
                      ?>
                    </select>
                    <span class="help-block"></span>
                  </div>
                  <div class="col-4">
                    <input type="text" class="form-control kt_datepicker" id="log_tanggal" name="log_tanggal" autocomplete="off">
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
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Qty</th>
                        <th>Jenis</th>
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
    </div>
  </div>
</div>

<div class="modal fade modal_add_form" tabindex="-1" role="dialog" aria-labelledby="add_menu" aria-hidden="true" id="modalPintasanLogistik">
  <div class="modal-dialog modal-xs" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_title">Master Logistik</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form id="form_master_logistik" name="form_master_logistik">
          <div class="form-group">
            <label for="lbl_telp1" class="form-control-label">Nama :</label>
            <input type="text" class="form-control" name="nama">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_telp1" class="form-control-label">Stok:</label>
            <input type="number" class="form-control" name="stok">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_telp1" class="form-control-label">Jenis Logistik:</label>
            <select id="jenisLogistikModal" name="jenis" class="form-control kt-select2" style="width: 100%;">
              <option value="">Silahkan Pilih jenis Logistik</option>
            </select>
            <span class="help-block"></span>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-success" id="btnSaveMasterLogistik" onclick="saveMasterLogistik()">Simpan</button>
      </div>
    </div>
  </div>
</div>