<div class="modal fade modal_add_form" tabindex="-1" role="dialog" aria-labelledby="add_menu" aria-hidden="true" id="modal_jadwal_rutin">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="form-jadwal-rutin" name="form-diskon">
        <div class="modal-header">
          <h5 class="modal-title" id="modal_title"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" class="form-control" id="id" name="id">
            <label for="lbl_visite" class="form-control-label">Dokter :</label>
            <select class="form-control kt-select2 select2" id="dokter" name="dokter" style="width: 100%;">
              <option value="">Pilih Dokter</option>
              <?php 
              foreach ($dokter as $pegawai) {
                echo "<option value='".$pegawai->id."'>$pegawai->nama</option>";
              }
              ?>
            </select>
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_visite" class="form-control-label">Hari :</label>
            <select class="form-control " id="hari" name="hari" style="width: 100%;">
              <option value="">Pilih Hari</option>
              <option value="senin">Senin</option>
              <option value="selasa">Selasa</option>
              <option value="rabu">Rabu</option>
              <option value="kamis">Kamis</option>
              <option value="jumat">Jumat</option>
              <option value="sabtu">Sabtu</option>
              <option value="minggu">Minggu</option>
            </select>
            <span class="help-block"></span>
          </div>

          <div class="form-group">
            <label for="lbl_visite" class="form-control-label timepicker" >Jam Mulai :</label>
                <input class="form-control" id="jam_mulai" name="jam_mulai"  placeholder="Pilih Jam" type="text" >
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_visite" class="form-control-label timepicker" >Jam Akhir :</label>
                <input class="form-control" id="jam_akhir" name="jam_akhir"  placeholder="Pilih Jam" type="text" >
            <span class="help-block"></span>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="button" class="btn btn-primary" id="btnSave" onclick="save_jadwal_rutin()">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

