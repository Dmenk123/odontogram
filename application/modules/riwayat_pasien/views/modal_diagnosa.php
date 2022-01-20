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
                <div class="col-12 row">
                  <label class="col-8 col-form-label">Diagnosa :</label>
                  <label class="col-4 col-form-label">Gigi :</label>
                </div>
                <div class="col-12 row">
                  <div class="col-8">
                    <select class="form-control kt-select2" id="fm_diagnosa" name="fm_diagnosa" style="width: 100%;">
                      <option value="">Silahkan Pilih Diagnosa</option>
                    </select>
                    <span class="help-block"></span>
                  </div>
                  <div class="col-4">
                    <input type="text" class="form-control" id="fm_gigi" name="fm_gigi" value="">
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="col-12 row">
                  <label class="col-3 col-form-label">Tanggal</label>
                  <label class="col-4 col-form-label">Dokter</label>
                  <label class="col-5 col-form-label">Keterangan</label>
                </div>
                <div class="col-12 row">
                  <div class="col-3">
                    <input type="text" class="form-control kt_datepicker" id="fm_tanggal" name="fm_tanggal" autocomplete="off">
                    <span class="help-block"></span>
                  </div>
                  <div class="col-4">
                    <select class="form-control kt-select2" id="fm_dokter" name="fm_dokter" style="width: 100%;">
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
                    <input type="text" class="form-control" id="fm_keterangan" name="fm_keterangan" value="">
                    <span class="help-block"></span>
                  </div>
                </div>
                <br>
                <div class="col-12">
                  <button type="button" id="btnSave" class="btn btn-primary" onclick="save('form_diagnosa')">Tambahkan</button>
                </div>
                <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>

                <div class=" col-lg-12 col-sm-12">
                  <h3>Tabel Diagnosa Pasien</h3>
                  <table class="table table-striped- table-bordered table-hover" id="tabel_modal_diagnosa">
                    <thead>
                      <tr>
                        <th>Tanggal</th>
                        <th>Gigi</th>
                        <th>Kode</th>
                        <th>Nama Diagnosa</th>
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

<div class="modal fade modal_add_form" tabindex="-1" role="dialog" aria-labelledby="add_menu" aria-hidden="true" id="modalPintasanDiagnosa">
  <div class="modal-dialog modal-xs" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_title">Master Diagnosa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form id="form_master_diagnosa" name="form_master_diagnosa">
          <div class="form-group">
            <label for="lbl_telp1" class="form-control-label">Nama Diagnosa:</label>
            <input type="text" class="form-control" name="nama">
            <span class="help-block"></span>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-success" id="btnSaveMasterDiagnosa" onclick="saveMasterDiagnosa()">Simpan</button>
      </div>
    </div>
  </div>
</div>