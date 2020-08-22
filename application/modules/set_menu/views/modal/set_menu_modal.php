<!-- modal add_user -->
<div class="modal fade" id="modal_menu_form" role="dialog" aria-labelledby="add_menu" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"></h4>
         </div>
         <div class="modal-body">
            <form class="form-horizontal" id="form-add-menu" name="form-add-menu">
              <div class="form-group">
                <label class="control-label col-sm-4 lblNamaErr" >Nama Menu :</label>
                <div class="col-sm-6">
                  <input type="input" class="form-control required" id="nama_menu"  name="nama_menu" value="">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-4 lblJudulErr" >Judul Menu :</label>
                <div class="col-sm-6">
                  <input type="input" class="form-control" id="judul_menu"  name="judul_menu" value="">
                </div>
              </div>	

              <div class="form-group">
                <label class="control-label col-sm-4 lblLinkErr" >Link Menu :</label>
                <div class="col-sm-6">
                  <input type="input" class="form-control" id="link_menu"  name="link_menu" value="">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-4 lblIconErr" >Icon Menu :</label>
                <div class="col-sm-6">
                  <input type="input" class="form-control" id="icon_menu"  name="icon_menu" value="">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-4 lblTingkatErr" >Tingkat Menu :</label>
                <div class="col-sm-6">
                  <select class="form-control required" name="tingkat_menu">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                  </select>
                </div>
              </div>
              
              <div class="form-group">
                <label class="control-label col-sm-4 lblUrutErr" >Urutan Menu :</label>
                <div class="col-sm-6">
                  <select class="form-control required" name="urutan_menu">
                     <?php for ($i=1; $i <= 20; $i++) { 
                        echo "<option value=$i>$i</option>";
                     } ?>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-4" >Aktif Menu :</label>
                <div class="col-sm-6">
                  <select class="form-control required" name="aktif_menu">
                    <option value="1">Ya </option>
                    <option value="0">Tidak </option>
                  </select>
                </div>
              </div>
              
              <div class="form-group">
                <label class="control-label col-sm-4" >Add Button :</label>
                <div class="col-sm-6">
                  <select class="form-control required" name="add_button">
                    <option value="1">Ya </option>
                    <option value="0">Tidak </option>
                  </select>
                </div>
              </div>
              
              <div class="form-group">
                <label class="control-label col-sm-4" >Edit Button :</label>
                <div class="col-sm-6">
                  <select class="form-control required" name="edit_button">
                    <option value="1">Ya </option>
                    <option value="0">Tidak </option>
                  </select>
                </div>
              </div>
              
              <div class="form-group">
                <label class="control-label col-sm-4" >Delete Button :</label>
                <div class="col-sm-6">
                  <select class="form-control required" name="delete_button">
                    <option value="1">Ya </option>
                    <option value="0">Tidak </option>
                  </select>
                </div>
              </div>
              
              <div class="form-group">
                <label class="control-label col-sm-4" for="Parent Menu">Parent Menu :</label>
                <div class="col-sm-6">
                  <select class="form-control required" name="id_parent" id="id_parent">
                    <option value="0">Jenis Pertama </option>
                  </select>
                </div>
              </div>	
		      </form>
         </div>
         <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
         </div>
      </div>
   </div>
<div>