<div class="modal fade modal_add_form" tabindex="-1" role="dialog" aria-labelledby="add_menu" aria-hidden="true" id="modal_honor_dokter">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form id="form-honor" name="form-honor">
          <div class="form-group">
            <input type="hidden" class="form-control" id="id_honor" name="id_honor">
            <label for="lbl_visite" class="form-control-label">Honor Visite:</label>
            <input type="text" class="form-control numberinput mask_money" id="honor_visite" name="honor_visite" autocomplete="off">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_username" class="form-control-label">Nama Dokter:</label>
            <br>
            <select class="form-control kt-select2 select2" id="dokter" name="dokter" style="width: 100%;">
              <option value="">Silahkan Pilih Dokter</option>
              <?php 
              foreach ($data_peg as $key => $pegawai) {
                echo "<option value='".$pegawai->id."'>$pegawai->nama</option>";
              }
              ?>
            </select>
            <span class="help-block"></span>
          </div>
            
          <div class="form-group">
            <label for="" class="form-control-label">Honor Tindakan Dokter % :</label>
            <div class="input-group">
              <input type="text" class="form-control numberinput" id="honor_tindakan" name="honor_tindakan" autocomplete="off">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button" onclick="bukaFormTindakan()">.....</button>
              </div>
            </div>
            <span class="help-block"></span>
          </div>
          

          <div class="form-group">
            <label for="" class="form-control-label">Honor Obat Dokter % :</label>
            <input type="text" class="form-control numberinput" id="honor_obat" name="honor_obat" autocomplete="off">
            <span class="help-block"></span>
          </div>

          <div class="form-group">
            <label for="" class="form-control-label">Honor Tind Lab Dokter % :</label>
            <div class="input-group">
              <input type="text" class="form-control numberinput" id="honor_lab" name="honor_lab" autocomplete="off">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button" onclick="bukaFormLab()">.....</button>
              </div>
            </div>
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


<div class="modal fade modal_add_form" tabindex="-1" role="dialog" aria-labelledby="add_menu" aria-hidden="true" id="modal_honor_tindakan">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_title_tindakan"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form id="form-honor-tindakan" name="form-honor-tindakan">
          <div class="form-group">
            <input type="hidden" class="form-control" id="id_honor_tindakan" name="id_honor_tindakan">
            <input type="hidden" class="form-control" id="id_dokter_tindakan" name="id_dokter_tindakan">
            <label for="lbl_visite" class="form-control-label">Nama Dokter:</label>
            <input type="text" class="form-control" id="nama_dokter_tindakan" name="nama_dokter_tindakan" autocomplete="off" disabled>
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_username" class="form-control-label">Tindakan :</label>
            <br>
            <select class="form-control kt-select2 select2" id="id_tindakan" name="id_tindakan" style="width: 100%;">
              <option value="">Silahkan Pilih Tindakan</option>
            </select>
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="" class="form-control-label">Persen % :</label>
            <input type="text" class="form-control numberinput" id="honor_tindakan_persen" name="honor_tindakan_persen" autocomplete="off">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <button type="button" id="btnSaveTindakan" class="btn btn-primary" onclick="tambah_tindakan()">Simpan Tindakan</button>
          </div>
        </form>

        <div class="form-group">
          <div class="kt-section__content">
            <table class="table" id="tabel-tindakan-dokter">
              <thead class="thead-light">
                <tr>
                  <th>Kode</th>
                  <th>Tindakan</th>
                  <th>Tarif</th>
                  <th>Persen</th>
                  <th style="width: 5%;">Hapus</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="show_modal_honor()">Batal</button>
      </div>
    </div>
  </div>
</div>