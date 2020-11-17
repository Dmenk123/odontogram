<style>
  #filedrag {
  padding: 1em;
  margin: 1em 0;
  color: #1a1a1a;
  border: 2px dashed #808080;
  border-radius: 4px;
  cursor: default;
  width: 100%;
  display: inline-block;
  text-align: center;
}

#filedrag.hover {
  border-color: #efd126;
  border-style: solid;
}

#filedrag.hover .box-icon {
  max-width: 10px;
}

#fileselect {
  margin: auto;
}

.box-icon {
  max-width: 100px;
  display: block;
  margin: auto;
}

#messages {
  padding: 0 10px;
  margin: 1em 0;
  max-height: 400px;
  overflow-y: scroll;
}

#progress p {
  display: block;
  width: 100%;
  padding: 5px 15px;
  margin: 2px 0;
  border: 1px solid #eee;
  border-radius: 20px;
  background: #eee 100% 0 repeat-y;
  color: #333;
}

#progress p.success {
  background: #28a745 none 0 0 no-repeat;
  color: #fff;
}

#progress p.failed {
  background: #dc3545 none 0 0 no-repeat;
  color: #fff;
}

.mobile-upload {
  display: none;
}

@media (pointer: coarse) {
  .desktop-upload {
    display: none;
  }
}

</style>
<div class="modal fade modal_detail" tabindex="-1" role="dialog" aria-labelledby="add_menu" aria-hidden="true" id="div_kamera_modal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="div_diagnosa_modal_title">Kamera</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
      <form id="form_kamera" name="form_kamera">
        <div class="form-group desktop-upload">
          <input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" value="2097152" />
          <div>
            <div id="filedrag">
              <img class="box-icon" src="https://upload.wikimedia.org/wikipedia/commons/b/bb/Octicons-cloud-upload.svg" />
              <label for="fileselect">Drop files here or</label>
              <input type="file" id="fileselect" name="fileselect" />
            </div>
            <div id="messages">
              <p></p>
            </div>
            <div id="progress"></div>
          </div>
        </div>
        <div class="form-group mobile-upload">
          <label for="exampleFormControlFile1">Example file input</label>
          <input type="file" class="form-control-file" name="file" id="file" id="exampleFormControlFile1">
        </div>
        <div class="col-12 row">
          <label class="col-12 col-form-label">Keterangan :</label>
        </div>
        <div class="col-12 row">
          <div class="col-12">
            <textarea type="text" class="form-control" id="keterangan" name="keterangan" value=""></textarea>
          </div>
        </div>
        <br>
        <div class="col-12 row">
            <button type="button" id="btnSave" class="btn btn-primary" onclick="save('form_kamera')">Tambahkan</button>
        </div>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
