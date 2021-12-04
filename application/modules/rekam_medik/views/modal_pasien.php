<div class="modal fade modal_detail" tabindex="-1" role="dialog" aria-labelledby="add_menu" aria-hidden="true" id="div_pasien_modal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="div_pasien_modal_title">Identitas Pasien</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form id="form_pasien" name="form_pasien">
        <div class="row">
        <div class="col-sm-6">
        
          <div class="form-group">
            <label for="lbl_nama_pegawai" class="form-control-label">Nama Pasien :</label>
            <input type="text" class="form-control" id="nama" name="nama">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_telp1" class="form-control-label">NIK :</label>
            <input type="text" class="form-control" id="nik" name="nik" maxlength="16">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_telp1" class="form-control-label">No. RM :</label>
            <input type="text" class="form-control" id="no_rm" name="no_rm" onkeyup="to_upper(this)" disabled>
            <label class="kt-checkbox kt-checkbox--tick kt-checkbox--brand">
              <input type="checkbox" class="form-control" id="cek_manual"> Manual
              <span></span>
            </label>
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_telp1" class="form-control-label">Tempat Lahir :</label>
            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_telp1" class="form-control-label">Tanggal Lahir :</label>
            <input type="text" class="form-control mask_tanggal" id="tanggal_lahir" name="tanggal_lahir">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_telp1" class="form-control-label">Jenis Kelamin :</label>
            <select class="form-control" name="jenkel" id="jenkel">
              <option value=""> Pilih Jenis Kelamin </option>
              <option value="L" > Laki-Laki </option>
              <option value="P" > Perempuan </option>
            </select>
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_telp1" class="form-control-label">Suku Bangsa :</label>
            <input type="text" class="form-control" id="suku" name="suku">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_telp1" class="form-control-label">Pekerjaan :</label>
            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_telp1" class="form-control-label">HP/WA :</label>
            <input type="text" class="form-control" id="hp" name="hp">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_telp1" class="form-control-label">Telp Rumah :</label>
            <input type="text" class="form-control" id="telp" name="telp">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_telp1" class="form-control-label">Alamat Rumah :</label>
            <input type="text" class="form-control" id="alamat_rumah" name="alamat_rumah">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_telp1" class="form-control-label">Alamat Kantor :</label>
            <input type="text" class="form-control" id="alamat_kantor" name="alamat_kantor">
            <span class="help-block"></span>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label for="lbl_telp1" class="form-control-label">Golongan Darah :</label>
            <input type="text" class="form-control" id="gol_darah" name="gol_darah">
            <span class="help-block"></span>
          </div>
          <div class="row">
            <div class="form-group col-sm-4">
              <label for="lbl_telp1" class="form-control-label">Tekanan Darah :</label>
              <input type="text" class="form-control" id="tekanan_darah_val" name="tekanan_darah_val">
              <span class="help-block"></span>
            </div>
          
            <div class="form-group col-sm-8">
              <label for="lbl_telp1" class="form-control-label">&nbsp;</label>
              <select class="form-control required" name="tekanan_darah" id="tekanan_darah">
                <option value=""> Pilih Kategori </option>
                <option value="HYPERTENSI" > Hypertensi </option>
                <option value="HYPOTENSI" > Hypotensi </option>
                <option value="NORMAL" > Normal </option>
              </select>
              <span class="help-block"></span>
            </div>
          </div>
          <div class="form-group">
            <label for="lbl_telp1" class="form-control-label">Penyakit Jantung :</label>
            <select class="form-control required" name="penyakit_jantung" id="penyakit_jantung">
                <option value="0" > Tidak Ada </option>
                <option value="1" > Ada </option>
              </select>
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_telp1" class="form-control-label">Diabetes :</label>
            <select class="form-control required" name="diabetes" id="diabetes">
                <option value="0" > Tidak Ada </option>
                <option value="1" > Ada </option>
              </select>
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_telp1" class="form-control-label">Haemopilia :</label>
            <select class="form-control required" name="haemopilia" id="haemopilia">
                <option value="0" > Tidak Ada </option>
                <option value="1" > Ada </option>
              </select>
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_telp1" class="form-control-label">Hepatitis :</label>
            <select class="form-control required" name="hepatitis" id="hepatitis">
                <option value="0" > Tidak Ada </option>
                <option value="1" > Ada </option>
              </select>
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_telp1" class="form-control-label">Gastring :</label>
            <select class="form-control required" name="gastring" id="gastring">
                <option value="0" > Tidak Ada </option>
                <option value="1" > Ada </option>
              </select>
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_telp1" class="form-control-label">Penyakit Lainnya :</label>
            <select class="form-control required" name="penyakit_lainnyas" id="penyakit_lainnyas">
                <option value="0" > Tidak Ada </option>
                <option value="1" > Ada </option>
              </select>
            <span class="help-block"></span>
          </div>
          <div class="row">
            <div class="form-group col-sm-5">
              <label for="lbl_telp1" class="form-control-label">Alergi Obat</label>
              <select class="form-control required" name="alergi_obat" id="alergi_obat">
                <option value="0" > Tidak Ada </option>
                <option value="1" > Ada </option>
              </select>
              <span class="help-block"></span>
            </div>
            <div class="col-lg-7">
            <label for="lbl_telp1" class="form-control-label">&nbsp;</label>
              <input type="text" class="form-control" name="alergi_obat_val" disabled >
              <span class="help-block"></span>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-sm-5">
              <label for="lbl_telp1" class="form-control-label">Alergi Makanan</label>
              <select class="form-control required" name="alergi_makanan" id="alergi_makanan">
                <option value="0" > Tidak Ada </option>
                <option value="1" > Ada </option>
              </select>
              <span class="help-block"></span>
            </div>
            <div class="col-lg-7">
            <label for="lbl_telp1" class="form-control-label">&nbsp;</label>
              <input type="text" class="form-control" name="alergi_makanan_val" disabled >
              <span class="help-block"></span>
            </div>
          </div>
        </div>
        </div>
        </form>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-brand" onclick="save('form_pasien')">Simpan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
