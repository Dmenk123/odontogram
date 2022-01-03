
<div class="modal fade modal_import_excel" tabindex="-1" role="dialog" aria-labelledby="add_menu" aria-hidden="true" id="modal_import_excel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_import_title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form class="kt-form" id="form_import_excel">
          <div class="kt-portlet__body">
          <div class="form-group">
              <label>Download Template File Excel</label>
              <div></div>
                <a type="button" class="btn btn-default" target="_blank" href="<?= base_url().$this->uri->segment(1).'/template_excel'; ?>">Download Template</a>
            </div>
            <div class="form-group">
              <label>File Upload</label>
              <div></div>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="file_excel" name="file_excel" accept=".xls,.xlsx">
                <label class="custom-file-label" id="label_file_excel" for="customFile">Pilih file excel yang akan diupload</label>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="btnSaveimport" onclick="import_data_excel()">import</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade modal_add_form" tabindex="-1" role="dialog" aria-labelledby="add_menu" aria-hidden="true" id="modal_profile_user">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">User Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form id="form_user_profile" name="form_user_profile">
          <div class="form-group">
            <input type="hidden" class="form-control" name="id_user_profile">
            <label for="lbl_username" class="form-control-label">Pegawai:</label>
            <input type="text" class="form-control" name="p_pegawai" disabled autocomplete="off">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_username" class="form-control-label">Username:</label>
            <input type="text" class="form-control" name="p_username" disabled autocomplete="off">
          </div>
          <div class="form-group">
            <label for="lbl_password_lama" class="form-control-label">Password Lama:</label>
            <input type="password" class="form-control" name="p_password_lama" autocomplete="off">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_password" class="form-control-label">Password Baru:</label>
            <input type="password" class="form-control" name="p_password" autocomplete="off">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_repassword" class="form-control-label">Tulis Ulang Password:</label>
            <input type="password" class="form-control" name="p_repassword" autocomplete="off">
            <span class="help-block"></span>
          </div>
        </form>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="btnSaveProfileUser" onclick="updateProfileUser()">Update Password</button>
      </div>
    </div>
  </div>
</div>