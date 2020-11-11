
<div class="modal fade modal_add_form" tabindex="-1" role="dialog" aria-labelledby="add_menu" aria-hidden="true" id="modal_honor_dokter">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form id="form-honor" name="form-honor">
          <div class="form-group">
            <input type="hidden" class="form-control" id="id_honor" name="id_honor">
            <label for="lbl_visite" class="form-control-label">Honor Visite:</label>
            <input type="text" class="form-control numberinput" id="honor_visite" name="honor_visite" autocomplete="off">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_username" class="form-control-label">Nama Dokter:</label>
            <br>
            <select class="form-control kt-select2 select2" id="dokter" name="dokter" style="width: 100%;">
              <option value="">Silahkan Pilih Dokter</option>
              <?php 
              foreach ($data_peg as $key => $pegawai) {
                echo "<option value='".$pegawai->id."'>$pegawai->nama</option>";
              }
              ?>
            </select>
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="" class="form-control-label">Persentase Tindakan Dokter:</label>
            <br>
            <select class="form-control kt-select2" id="sel_tindakan" name="sel_tindakan" style="width: 100%;">
              <option value="">Silahkan Pilih Metode</option>
              <option value="1">Global</option>
              <option value="2">Spesifik</option>
            </select>
            <span class="help-block"></span>
          </div>

          <div id="tindakan_append_area"></div>

          <div class="form-group">
            <label for="" class="form-control-label">Honor Obat Dokter % :</label>
            <input type="text" class="form-control numberinput" id="honor_obat" name="honor_obat" autocomplete="off">
            <span class="help-block"></span>
          </div>

          <div class="form-group">
            <label for="" class="form-control-label">Persentase Tind Lab Dokter:</label>
            <br>
            <select class="form-control kt-select2" id="sel_lab" name="sel_lab" style="width: 100%;">
              <option value="">Silahkan Pilih Metode</option>
              <option value="1">Global</option>
              <option value="2">Spesifik</option>
            </select>
            <span class="help-block"></span>
          </div>

          <div id="lab_append_area"></div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="btnSave" onclick="save()">Simpan</button>
      </div>
    </div>
  </div>
</div>