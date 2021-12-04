<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

  <!-- begin:: Content Head -->
  <div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
      <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">
          <?= $this->template_view->nama('judul').' - '.$title; ?>
        </h3>
      </div>
    </div>
  </div>
  <!-- end:: Content Head -->

  <!-- begin:: Content -->
  <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <!--begin::Form-->
    <form class="kt-form kt-form--label-right" id="form_pasien">
      <!-- form data pasien -->
      <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
          <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
              Form Data Pasien
            </h3>
          </div>
        </div>

        <div class="kt-portlet__body">
          <div class="col-12 row" style="padding-bottom: 20px;">
            <div class="col-12">
              <button type="button" class="btn btn-brand" onclick="show_modal_pasien()">Cari Data</button>
            </div>
          </div>
          <div class="col-12 table-responsive">
            <div class="hidden">
              <input type="hidden" id="id_reg" name="id_reg">
              <input type="hidden" id="id_psn" name="id_psn">
              <input type="hidden" id="id_peg" name="id_peg">
            </div>
            <table class="table table-striped- table-bordered table-hover table-checkable" id="tabel_pasien">
              <thead>
                <tr>
                  <th>No. Reg</th>
                  <th>Tgl Masuk</th>
                  <th>Tgl Pulang</th>
                  <th>Dokter</th>
                  <th>Nama</th>
                  <th>No. RM</th>
                  <th>Jenis Penjamin</th>
                  <th>Pers. Asuransi</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td colspan="7" style="text-align: center;">Data Registrasi Tidak Ditemukan</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="kt-portlet__body">
          <div class="col-12 row">
            <div class="col-5 row">
              <!--begin::Section-->
              <div class="kt-section" id="header_pembayaran"></div>
              <!--end::Section-->
            </div>
            <div class="col-7 row">
              <!--begin::Section-->
              <div class="kt-section" id="detail_pembayaran"></div>
              <!--end::Section-->
            </div>
          </div>
          <div class="kt-separator kt-separator--space-lg kt-separator--border-dashed"></div>
        </div>
      

        <!-- <div class="kt-portlet__body">
          <div class="form-group row form-group-marginless kt-margin-t-20">
            <input type="hidden" class="form-control" name="id_pasien" value="">
            <label class="col-lg-1 col-form-label">Nama Pasien:</label>
            <div class="col-lg-3">
              <input type="text" class="form-control" name="nama" onkeyup="to_upper(this)" value="<?php if(isset($data_pasien)) {echo $data_pasien->nama;} ?>">
              <span class="help-block"></span>
            </div>
            <label class="col-lg-1 col-form-label">NIK:</label>
            <div class="col-lg-2">
              <input type="text" class="form-control" name="nik" maxlength="16" value="<?php if(isset($data_pasien)) {echo $data_pasien->nik;} ?>">
              <span class="help-block"></span>
            </div>
            <label class="col-lg-1 col-form-label">No RM:</label>
            <div class="col-lg-2">
              <input type="text" class="form-control mask_rm" name="no_rm" onkeyup="to_upper(this)" disabled value="<?php if(isset($data_pasien)) {echo $data_pasien->no_rm;} ?>">
              <span class="help-block"></span>
            </div>
            <div class="col-lg-2">
              <div class="kt-checkbox-list">
                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--brand">
                  <input type="checkbox" class="form-control" id="cek_manual"> Manual
                  <span></span>
                </label>
              </div>
            </div>
          </div>
          <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
          <div class="form-group row form-group-marginless">
            <label class="col-lg-1 col-form-label">Tempat Lahir:</label>
            <div class="col-lg-3">
              <input type="text" class="form-control" name="tempat_lahir" value="<?php if(isset($data_pasien)) {echo $data_pasien->tempat_lahir;} ?>">
              <span class="help-block"></span>
            </div>
            <label class="col-lg-1 col-form-label">Tanggal Lahir:</label>
            <div class="col-lg-3">
              <input type="text" class="form-control mask_tanggal" name="tanggal_lahir" autocomplete="off" value="<?php if(isset($data_pasien)) {echo DateTime::createFromFormat('Y-m-d', $data_pasien->tanggal_lahir)->format('d/m/Y');} ?>">
              <span class="help-block"></span>
            </div>
            <label class="col-lg-1 col-form-label">Jenis Kelamin:</label>
            <div class="col-lg-3">
              <select class="form-control required" name="jenkel" id="jenkel">
              <option value=""> Pilih Jenis Kelamin </option>
              <option value="L" <?php if(isset($data_pasien) && $data_pasien->jenis_kelamin == 'L') {echo "selected";} ?>> Laki-Laki </option>
              <option value="P" <?php if(isset($data_pasien) && $data_pasien->jenis_kelamin == 'P') {echo "selected";} ?>> Perempuan </option>
            </select>
              <span class="help-block"></span>
            </div>
          </div>
          <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
          <div class="form-group row">
            <label class="col-lg-1 col-form-label">Suku Bangsa:</label>
            <div class="col-lg-5">
              <input type="text" class="form-control" name="suku" value="<?php if(isset($data_pasien)) {echo $data_pasien->suku;} ?>">
              <span class="help-block"></span>
            </div>
            <label class="col-lg-1 col-form-label">Pekerjaan:</label>
            <div class="col-lg-5">
              <input type="text" class="form-control" name="pekerjaan" value="<?php if(isset($data_pasien)) {echo $data_pasien->pekerjaan;} ?>">
              <span class="help-block"></span>
            </div>
          </div>
          <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
          <div class="form-group row">
            <label class="col-lg-1 col-form-label">HP/WA:</label>
            <div class="col-lg-5">
              <input type="text" class="form-control" name="hp" value="<?php if(isset($data_pasien)) {echo $data_pasien->hp;} ?>">
              <span class="help-block"></span>
            </div>
            <label class="col-lg-1 col-form-label">Telp Rumah:</label>
            <div class="col-lg-5">
              <input type="text" class="form-control" name="telp" value="<?php if(isset($data_pasien)) {echo $data_pasien->telp_rumah;} ?>">
              <span class="help-block"></span>
            </div>
          </div>
          <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
          <div class="form-group row">
            <label class="col-lg-1 col-form-label">Alamat Rumah:</label>
            <div class="col-lg-5">
              <input type="text" class="form-control" name="alamat_rumah" value="<?php if(isset($data_pasien)) {echo $data_pasien->alamat_rumah;} ?>">
              <span class="help-block"></span>
            </div>
            <label class="col-lg-1 col-form-label">Alamat Kantor:</label>
            <div class="col-lg-5">
              <input type="text" class="form-control" name="alamat_kantor" value="<?php if(isset($data_pasien)) {echo $data_pasien->alamat_kantor;} ?>">
              <span class="help-block"></span>
            </div>
          </div>
        </div> -->
      </div>

      <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
          <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
              Form Data Medik
            </h3>
          </div>
        </div>
        <div class="kt-portlet__body">
          <div class="form-group row form-group-marginless kt-margin-t-20">
            <label class="col-lg-1 col-form-label">Golongan Darah:</label>
            <div class="col-lg-3">
              <input type="text" class="form-control" name="gol_darah">
              <span class="help-block"></span>
            </div>
            <label class="col-lg-2 col-form-label">Tekanan Darah:</label>
            <div class="col-lg-3">
              <input type="text" class="form-control" name="tekanan_darah_val" value="<?php if(isset($data_pasien)) {echo $data_pasien->tekanan_darah_val;} ?>">
              <span class="help-block"></span>
            </div>
            <div class="col-lg-3">
              <select class="form-control required" name="tekanan_darah" id="tekanan_darah">
                <option value=""> Pilih Kategori </option>
                <option value="HYPERTENSI" <?php if(isset($data_pasien) && $data_pasien->tekanan_darah == 'HYPERTENSI') {echo "selected";} ?>> Hypertensi </option>
                <option value="HYPOTENSI" <?php if(isset($data_pasien) && $data_pasien->tekanan_darah == 'HYPOTENSI') {echo "selected";} ?>> Hypotensi </option>
                <option value="NORMAL" <?php if(isset($data_pasien) && $data_pasien->tekanan_darah == 'NORMAL') {echo "selected";} ?>> Normal </option>
              </select>
              <span class="help-block"></span>
            </div>
          </div>
          <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
          <div class="form-group row">
            <label class="col-lg-1 col-form-label">Penyakit Jantung:</label>
            <div class="col-lg-3">
              <select class="form-control required" name="penyakit_jantung" id="penyakit_jantung">
                <option value="0" <?php if(isset($data_pasien) && $data_pasien->penyakit_jantung == '0') {echo "selected";} ?>> Tidak Ada </option>
                <option value="1" <?php if(isset($data_pasien) && $data_pasien->penyakit_jantung == '1') {echo "selected";} ?>> Ada </option>
              </select>
              <span class="help-block"></span>
            </div>
            <label class="col-lg-1 col-form-label">Diabetes:</label>
            <div class="col-lg-3">
              <select class="form-control required" name="diabetes" id="diabetes">
                <option value="0" <?php if(isset($data_pasien) && $data_pasien->diabetes == '0') {echo "selected";} ?>> Tidak Ada </option>
                <option value="1" <?php if(isset($data_pasien) && $data_pasien->diabetes == '0') {echo "selected";} ?>> Ada </option>
              </select>
              <span class="help-block"></span>
            </div>
            <label class="col-lg-1 col-form-label">Haemopilia:</label>
            <div class="col-lg-3">
              <select class="form-control required" name="haemopilia" id="haemopilia">
                <option value="0" <?php if(isset($data_pasien) && $data_pasien->haemopilia == '0') {echo "selected";} ?>> Tidak Ada </option>
                <option value="1" <?php if(isset($data_pasien) && $data_pasien->haemopilia == '1') {echo "selected";} ?>> Ada </option>
              </select>
              <span class="help-block"></span>
            </div>
          </div>
          <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
          <div class="form-group row">
            <label class="col-lg-1 col-form-label">Hepatitis:</label>
            <div class="col-lg-3">
              <select class="form-control required" name="hepatitis" id="hepatitis">
                <option value="0" <?php if(isset($data_pasien) && $data_pasien->hepatitis == '0') {echo "selected";} ?>> Tidak Ada </option>
                <option value="1" <?php if(isset($data_pasien) && $data_pasien->hepatitis == '1') {echo "selected";} ?>> Ada </option>
              </select>
              <span class="help-block"></span>
            </div>
            <label class="col-lg-1 col-form-label">Gastring:</label>
            <div class="col-lg-3">
              <select class="form-control required" name="gastring" id="gastring">
                <option value="0" <?php if(isset($data_pasien) && $data_pasien->gastring == '0') {echo "selected";} ?>> Tidak Ada </option>
                <option value="1" <?php if(isset($data_pasien) && $data_pasien->gastring == '1') {echo "selected";} ?>> Ada </option>
              </select>
              <span class="help-block"></span>
            </div>
            <label class="col-lg-1 col-form-label">Penyakit Lainnya:</label>
            <div class="col-lg-3">
              <select class="form-control required" name="penyakit_lainnya" id="penyakit_lainnya">
                <option value="0" <?php if(isset($data_pasien) && $data_pasien->penyakit_lainnya == '0') {echo "selected";} ?>> Tidak Ada </option>
                <option value="1" <?php if(isset($data_pasien) && $data_pasien->penyakit_lainnya == '0') {echo "selected";} ?>> Ada </option>
              </select>
              <span class="help-block"></span>
            </div>
          </div>
          <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
          <div class="form-group row">
            <label class="col-lg-2 col-form-label">Alergi Obat-Obatan:</label>
            <div class="col-lg-4">
              <select class="form-control required" name="alergi_obat" id="alergi_obat">
                <option value="0" <?php if(isset($data_pasien) && $data_pasien->alergi_obat == '0') {echo "selected";} ?>> Tidak Ada </option>
                <option value="1" <?php if(isset($data_pasien) && $data_pasien->alergi_obat == '1') {echo "selected";} ?>> Ada </option>
              </select>
              <span class="help-block"></span>
            </div>
            <div class="col-lg-6">
              <input type="text" class="form-control" name="alergi_obat_val" disabled value="<?php if(isset($data_pasien)) {echo $data_pasien->alergi_obat_val;} ?>">
              <span class="help-block"></span>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-lg-2 col-form-label">Alergi Makanan:</label>
            <div class="col-lg-4">
              <select class="form-control required" name="alergi_makanan" id="alergi_makanan">
                <option value="0" <?php if(isset($data_pasien) && $data_pasien->alergi_makanan == '0') {echo "selected";} ?>> Tidak Ada </option>
                <option value="1" <?php if(isset($data_pasien) && $data_pasien->alergi_makanan == '1') {echo "selected";} ?>> Ada </option>
              </select>
              <span class="help-block"></span>
            </div>
            <div class="col-lg-6">
              <input type="text" class="form-control" name="alergi_makanan_val" disabled value="<?php if(isset($data_pasien)) {echo $data_pasien->alergi_makanan_val;} ?>">
              <span class="help-block"></span>
            </div>
          </div>
        </div>
        <div class="kt-portlet__foot">
          <div class="kt-form__actions">
            <div class="row">
              <div class="col-lg-5"></div>
              <div class="col-lg-7">
                <button type="button" class="btn btn-brand" onclick="save()">Simpan</button>
                <a type="button" class="btn btn-secondary" href="<?= base_url($this->uri->segment(1))?>">Batal</a>
              </div>
            </div>
          </div>
        </div>
      </div>      
    </form>
    <!--end::Form-->
  </div>
</div>



