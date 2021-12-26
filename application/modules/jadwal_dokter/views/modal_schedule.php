<div class="modal fade modal_add_form" tabindex="-1" role="dialog" aria-labelledby="add_menu" aria-hidden="true" id="modal_schedule">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
      <form id="form-schedule">
	        <div class="input-group control-group after-add-more">
	          <input type="text" name="addmore[]" class="form-control" placeholder="Hobi">
	          <div class="input-group-btn"> 
	            <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> Tmabah</button>
	          </div>
	        </div>
 		</form>
 
        <!-- Copy Fields -->
        <div class="copy hide" style="display:none;">
          <div class="control-group input-group" style="margin-top:10px">
            <input type="text" name="addmore[]" class="form-control" placeholder="Enter Name Here">
            <div class="input-group-btn"> 
              <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Hapus</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="reset_modal()">Batal</button>
        <button type="button" class="btn btn-primary" id="btnSave" onclick="save()">Simpan</button>
      </div>
    </div>
  </div>
</div>
