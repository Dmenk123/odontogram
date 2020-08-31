
<div class="modal fade modal_add_form" tabindex="-1" role="dialog" aria-labelledby="add_menu" aria-hidden="true" id="modal_pegawai_form">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form id="form-pegawai" name="form-pegawai">
          <div class="form-group">
            <input type="hidden" class="form-control" id="id_pegawai" name="id_pegawai">
            <label for="lbl_nama_pegawai" class="form-control-label">Nama Pegawai:</label>
            <input type="text" class="form-control" id="nama" name="nama">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_alamat" class="form-control-label">Alamat:</label>
            <textarea class="form-control" name="alamat" id="alamat" cols="10" rows="4"></textarea>
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_telp1" class="form-control-label">No Telp/Hp (1):</label>
            <input type="text" class="form-control" id="telp1" name="telp1">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_telp2" class="form-control-label">No Telp/Hp (2) :</label>
            <input type="text" class="form-control" id="telp2" name="telp2">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_jabatan" class="form-control-label">Jabatan :</label>
            <select class="form-control required" name="jabatan" id="jabatan">
              <option value=""> Pilih Jabatan </option>
              <?php
              foreach ($data_jabatan as $val) { ?>
                  <option value="<?php echo $val->id; ?>">
                      <?php echo $val->nama; ?>    
                  </option>
              <?php } ?>
            </select>
            <span class="help-block"></span>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="btnSave" onclick="save()">Simpan</button>
      </div>
    </div>
  </div>
</div>