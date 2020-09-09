
<div class="modal fade modal_add_form" tabindex="-1" role="dialog" aria-labelledby="add_menu" aria-hidden="true" id="modal_user_form">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form id="form-user" name="form-user">
          <div class="form-group">
            <input type="hidden" class="form-control" id="id_user" name="id_user">
            <label for="lbl_username" class="form-control-label">Username:</label>
            <input type="text" class="form-control" id="username" name="username" autocomplete="off">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_username" class="form-control-label">Nama Pegawai:</label>
            <br>
            <select class="form-control kt-select2 select2" id="pegawai" name="pegawai" style="width: 100%;" required>
              <?php 
              foreach ($data_peg as $key => $pegawai) {
                echo "<option value='".$pegawai->id."'>$pegawai->nama</option>";
              }
              ?>
            </select>
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label>Foto Profil</label>
            <div></div>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="foto" name="foto" accept=".jpg,.jpeg,.png">
              <label class="custom-file-label" id="label_foto" for="customFile">Pilih gambar yang akan diupload</label>
            </div>
          </div>
          <div class="form-group" id="div_preview_foto" style="display: none;">
            <label for="lbl_password_lama" class="form-control-label">Preview Foto:</label>
            <div></div>
            <img id="preview_img" src="#" alt="Preview Foto" height="200" width="200"/>
            <span class="help-block"></span>
          </div>
          <div class="form-group" id="div_skip_password" style="display: none;">
            <label for="lbl_password_lama" class="form-control-label">Tanpa Ganti Password:</label>
            <div class="kt-checkbox-inline">
              <label class="kt-checkbox">
                <input type="checkbox" class="form-control" id="skip_pass" name="skip_pass" value="1"> Centang Apabila tidak ingin mengganti password
                <span></span>
              </label>
            </div>
            <span class="help-block"></span>
          </div>
          <div class="form-group" id="div_pass_lama" style="display: none;">
            <label for="lbl_password_lama" class="form-control-label">Password Lama:</label>
            <input type="password" class="form-control" id="password_lama" name="password_lama" autocomplete="off">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_password" class="form-control-label">Password:</label>
            <input type="password" class="form-control" id="password" name="password" autocomplete="off">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_repassword" class="form-control-label">Tulis Ulang Password:</label>
            <input type="password" class="form-control" id="repassword" name="repassword" autocomplete="off">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_role" class="form-control-label">Role User:</label>
            <select class="form-control required" name="role" id="role">
              <option value=""> Pilih Role User </option>
              <?php
              foreach ($data_role as $val) { ?>
                  <option value="<?php echo $val->id; ?>">
                      <?php echo $val->nama; ?>    
                  </option>
              <?php } ?>
            </select>
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_status" class="form-control-label">Status User:</label>
            <select class="form-control required" name="status" id="status">
              <option value="1">Aktif </option>
              <option value="0">Non Aktif </option>
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

<div class="modal fade modal_detail" tabindex="-1" role="dialog" aria-labelledby="add_menu" aria-hidden="true" id="modal_user_detail">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_title_det"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-responsive table-borderless">
          <tbody>
            <tr>
              <th style="width: 30%;">Username</th>
              <td style="width: 3%;"> : </td>
              <td style="width: 40%;"><span id="username_det"></span></td>
              <td style="width: 27%;" rowspan="4"><img class="rounded" id="preview_img_det" src="#" alt="Preview Foto" height="200" width="200"/></td>
            </tr>
            <tr>
              <th>Nama Pegawai</th>
              <td> : </td>
              <td><span id="pegawai_det"></span></td>
            </tr>
            <tr>
              <th>Role User</th>
              <td> : </td>
              <td><span id="role_det"></span></td>
            </tr>
            <tr> 
              <th>Status User</th>
              <td> : </td>
              <td><span id="status_det"></span></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>