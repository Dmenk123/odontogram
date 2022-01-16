<div class="modal fade modal_detail" tabindex="-1" role="dialog" aria-labelledby="add_menu" aria-hidden="true" id="div_tindakan_modal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="div_tindakan_modal_title">Tindakan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form id="form_tindakan" name="form_tindakan">
          <div class="col-md-12">
            <div class="kt-portlet__body">
              <div class="form-group">
                <input type="hidden" class="form-control" id="id_tindakan" name="id_tindakan" value="">
                <div class="col-12 row">
                  <label class="col-8 col-form-label">Tindakan : </label>
                  <label class="col-4 col-form-label">Tanggal</label>
                </div>
                <div class="col-12 row">
                  <div class="col-8">
                    <select class="form-control kt-select2" id="tdk_tindakan" name="tdk_tindakan" style="width: 100%;">
                      <option value="">Silahkan Pilih Tindakan</option>
                    </select>
                    <span class="help-block"></span>
                  </div>
                  <div class="col-4">
                    <input type="text" class="form-control kt_datepicker" id="tdk_tanggal" name="tdk_tanggal" autocomplete="off">
                    <span class="help-block"></span>
                  </div>
                </div>
                <br>
                <div class="col-12 row">
                  <label class="col-3 col-form-label">Gigi :</label>
                  <label class="col-4 col-form-label">Dokter :</label>
                  <label class="col-5 col-form-label">Keterangan :</label>
                </div>
                <div class="col-12 row">
                  <div class="col-3">
                    <input type="text" class="form-control" name="tdk_gigi_num" value="" id="input_tdk_gigi_num">
                    <input type="text" class="form-control" name="tdk_gigi_txt" value="all" id="input_tdk_gigi_txt" style="display: none;" readonly>
                    <span class="help-block"></span>
                  </div>
                  <div class="col-4">
                    <select class="form-control kt-select2" id="tdk_dokter" name="tdk_dokter" style="width: 100%;">
                      <option value="">Silahkan Pilih</option>
                      <?php $q = $this->db->get_Where('m_pegawai', ['is_aktif' => 1, 'id_jabatan' => 1])->result(); 
                      foreach ($q as $key => $value) {
                        echo "<option value='$value->id'>$value->nama</option>";
                      }
                      ?>
                    </select>
                    <span class="help-block"></span>
                  </div>
                  <div class="col-5">
                    <input type="text" class="form-control" id="tdk_ket" name="tdk_ket" value="">
                    <span class="help-block"></span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-12">
                  <button type="button" id="btnSave" class="btn btn-primary" onclick="save('form_tindakan')">Tambahkan</button>
                </div>
              </div>
              <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
              <div class="form-group">
                <div class=" col-lg-12 col-sm-12">
                  <h3>Tabel tindakan Pasien</h3>
                  <table class="table table-striped- table-bordered table-hover" id="tabel_modal_tindakan">
                    <thead>
                      <tr>
                        <th>Tanggal</th>
                        <th>Gigi</th>
                        <th>Kode</th>
                        <th>Nama tindakan</th>
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


<div class="modal fade modal_add_form" tabindex="-1" role="dialog" aria-labelledby="add_menu" aria-hidden="true" id="modalPintasanTindakan">
  <div class="modal-dialog modal-xs" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_title">Master Tindakan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form id="form_master_tindakan" name="form_master_tindakan">
          <div class="form-group">
            <label for="lbl_telp1" class="form-control-label">Nama Tindakan:</label>
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
        <button type="button" class="btn btn-success" id="btnSaveMasterTindakan" onclick="saveMasterTindakan()">Simpan</button>
      </div>
    </div>
  </div>
</div>