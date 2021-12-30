<div class="modal fade modal_add_form" tabindex="-1" role="dialog" aria-labelledby="add_menu" aria-hidden="true" id="modal_jadwal_tidak_rutin">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="form-jadwal-tidak-rutin" name="form-diskon">
        <div class="modal-header">
          <h5 class="modal-title" id="modal_title2"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" class="form-control" id="id" name="id">
            <label for="lbl_visite" class="form-control-label">Dokter :</label>
            <select class="form-control kt-select2 select3" id="dokter" name="dokter" style="width: 100%;">
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
            <label for="lbl_visite" class="form-control-label">Tanggal :</label>
            <input type="text" class="form-control kt_datepicker" id="tanggal" name="tanggal" autocomplete="off">
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
          <div class="form-group">
          <label>Status Praktek</label>
          <div class="kt-radio-inline">
            <label class="kt-radio">
              <input type="radio" name="status" value="" <?php echo 'checked' ?>> Praktek
              <span></span>
            </label>
            <label class="kt-radio">
              <input type="radio" name="status" value="1"> Libur
              <span></span>
            </label>
          </div>
          <span class="help-block"></span>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="button" class="btn btn-primary" id="btnSave" onclick="save_jadwal_tidak_rutin()">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

