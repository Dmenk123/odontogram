
<div class="modal fade modal_add_form" tabindex="-1" role="dialog" aria-labelledby="add_menu" aria-hidden="true" id="modal_menu_form">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form id="form-menu" name="form-menu">
          <div class="form-group">
            <input type="hidden" class="form-control" id="id_menu" name="id_menu">
            <label for="lbl_nama_menu" class="form-control-label">Nama Menu:</label>
            <input type="text" class="form-control" id="nama_menu" name="nama_menu">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_judul_menu" class="form-control-label">Judul Menu:</label>
            <input type="text" class="form-control" id="judul_menu" name="judul_menu">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_link_menu" class="form-control-label">Link Menu:</label>
            <input type="text" class="form-control" id="link_menu" name="link_menu">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_icon_menu" class="form-control-label">Icon Menu:</label>
            <input type="text" class="form-control" id="icon_menu" name="icon_menu" placeholder="Contoh Icon dapat dilihat pada : https://www.flaticon.com/">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_tingkat_menu" class="form-control-label">Tingkat Menu:</label>
            <select class="form-control required" name="tingkat_menu" id="tingkat_menu">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
            </select>
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_urutan_menu" class="form-control-label">Urutan Menu:</label>
            <select class="form-control required" name="urutan_menu" id="urutan_menu">
              <?php for ($i=1; $i <= 100; $i++) { 
                echo "<option value=$i>$i</option>";
              } ?>
            </select>
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_aktif_menu" class="form-control-label">Aktif Menu:</label>
            <select class="form-control required" name="aktif_menu" id="aktif_menu">
              <option value="1">Ya </option>
              <option value="0">Tidak </option>
            </select>
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_add_button" class="form-control-label">Add Button:</label>
            <select class="form-control required" name="add_button" id="add_button">
              <option value="1">Ya </option>
              <option value="0">Tidak </option>
            </select>
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_edit_button" class="form-control-label">Edit Button:</label>
            <select class="form-control required" name="edit_button" id="edit_button">
              <option value="1">Ya </option>
              <option value="0">Tidak </option>
            </select>
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_delete_button" class="form-control-label">Delete Button:</label>
            <select class="form-control required" name="delete_button" id="delete_button">
              <option value="1">Ya </option>
              <option value="0">Tidak </option>
            </select>
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_parent_menu" class="form-control-label">Parent Menu:</label>
            <select class="form-control required" name="parent_menu" id="parent_menu">
              <option value="0">Jenis Pertama </option>
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