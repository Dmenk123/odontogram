<div class="modal fade modal_add_form" tabindex="-1" role="dialog" aria-labelledby="add_menu" aria-hidden="true" id="modal_pegawai_form">
  <div class="modal-dialog modal-xs" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form id="form-pegawai" name="form-pegawai">
          <div class="form-group">
            <input type="hidden" class="form-control" id="id_logistik" name="id_logistik">
            <label for="lbl_nama_pegawai" class="form-control-label">Kode Logistik:</label>
            <input type="text" class="form-control" id="kode" name="kode">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_telp1" class="form-control-label">Nama :</label>
            <input type="text" class="form-control" id="nama" name="nama">
            <span class="help-block"></span>
          </div>
         <!--  <div class="form-group">
            <label for="lbl_telp1" class="form-control-label">Harga Beli:</label>
            <input type="number" class="form-control" id="harga_beli" name="harga_beli">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_telp1" class="form-control-label">Harga Jual:</label>
            <input type="number" class="form-control" id="harga_jual" name="harga_jual">
            <span class="help-block"></span>
          </div> -->
          <div class="form-group">
            <label for="lbl_telp1" class="form-control-label">Stok:</label>
            <input type="number" class="form-control" id="stok" name="stok">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_telp1" class="form-control-label">Jenis Logistik:</label>
            <select name="jenis" class="form-control" id="" data-placeholder="">                           
              <?php
              foreach($jenis as $key){?>
                  <option value="<?=$key['id_jenis_logistik']?>" class="form-control" ><?=$key['jenis'];?></option>
              <?php } 
              ?>
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