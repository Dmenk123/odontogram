<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

  <!-- begin:: Content Head -->
  <div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
      <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">
          <?= $this->template_view->nama('judul').' - '.$title.' - Form Data Pasien'; ?>
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
          <div class="form-group row form-group-marginless kt-margin-t-20">
            <input type="hidden" class="form-control" name="id_pasien" value="">
            <label class="col-lg-1 col-form-label">Nama Pasien:</label>
            <div class="col-lg-3">
              <input type="text" class="form-control" name="nama" onkeyup="to_upper(this)">
              <span class="help-block"></span>
            </div>
            <label class="col-lg-1 col-form-label">NIK:</label>
            <div class="col-lg-2">
              <input type="text" class="form-control" name="nik" maxlength="16">
              <span class="help-block"></span>
            </div>
            <label class="col-lg-1 col-form-label">No RM:</label>
            <div class="col-lg-2">
              <input type="text" class="form-control mask_rm" name="no_rm" onkeyup="to_upper(this)" disabled>
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
              <input type="text" class="form-control" name="tempat_lahir">
              <span class="help-block"></span>
            </div>
            <label class="col-lg-1 col-form-label">Tanggal Lahir:</label>
            <div class="col-lg-3">
              <input type="text" class="form-control mask_tanggal" name="tanggal_lahir" autocomplete="off">
              <span class="help-block"></span>
            </div>
            <label class="col-lg-1 col-form-label">Jenis Kelamin:</label>
            <div class="col-lg-3">
              <select class="form-control required" name="jenkel" id="jenkel">
              <option value=""> Pilih Jenis Kelamin </option>
              <option value="L"> Laki-Laki </option>
              <option value="P"> Perempuan </option>
            </select>
              <span class="help-block"></span>
            </div>
          </div>
          <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
          <div class="form-group row">
            <label class="col-lg-1 col-form-label">Suku Bangsa:</label>
            <div class="col-lg-5">
              <input type="text" class="form-control" name="suku">
              <span class="help-block"></span>
            </div>
            <label class="col-lg-1 col-form-label">Pekerjaan:</label>
            <div class="col-lg-5">
              <input type="text" class="form-control" name="pekerjaan">
              <span class="help-block"></span>
            </div>
          </div>
          <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
          <div class="form-group row">
            <label class="col-lg-1 col-form-label">HP/WA:</label>
            <div class="col-lg-5">
              <input type="text" class="form-control" name="hp">
              <span class="help-block"></span>
            </div>
            <label class="col-lg-1 col-form-label">Telp Rumah:</label>
            <div class="col-lg-5">
              <input type="text" class="form-control" name="telp">
              <span class="help-block"></span>
            </div>
          </div>
          <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
          <div class="form-group row">
            <label class="col-lg-1 col-form-label">Alamat Rumah:</label>
            <div class="col-lg-5">
              <input type="text" class="form-control" name="alamat_rumah">
              <span class="help-block"></span>
            </div>
            <label class="col-lg-1 col-form-label">Alamat Kantor:</label>
            <div class="col-lg-5">
              <input type="text" class="form-control" name="alamat_kantor">
              <span class="help-block"></span>
            </div>
          </div>
        </div>
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
              <input type="text" class="form-control" name="tekanan_darah_val">
              <span class="help-block"></span>
            </div>
            <div class="col-lg-3">
              <select class="form-control required" name="tekanan_darah" id="tekanan_darah">
                <option value=""> Pilih Kategori </option>
                <option value="HYPERTENSI"> Hypertensi </option>
                <option value="HYPOTENSI"> Hypotensi </option>
                <option value="NORMAL"> Normal </option>
              </select>
              <span class="help-block"></span>
            </div>
          </div>
          <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
          <div class="form-group row">
            <label class="col-lg-1 col-form-label">Penyakit Jantung:</label>
            <div class="col-lg-3">
              <select class="form-control required" name="penyakit_jantung" id="penyakit_jantung">
                <option value="0"> Tidak Ada </option>
                <option value="1"> Ada </option>
              </select>
              <span class="help-block"></span>
            </div>
            <label class="col-lg-1 col-form-label">Diabetes:</label>
            <div class="col-lg-3">
              <select class="form-control required" name="diabetes" id="diabetes">
                <option value="0"> Tidak Ada </option>
                <option value="1"> Ada </option>
              </select>
              <span class="help-block"></span>
            </div>
            <label class="col-lg-1 col-form-label">Haemopilia:</label>
            <div class="col-lg-3">
              <select class="form-control required" name="haemopilia" id="haemopilia">
                <option value="0"> Tidak Ada </option>
                <option value="1"> Ada </option>
              </select>
              <span class="help-block"></span>
            </div>
          </div>
          <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
          <div class="form-group row">
            <label class="col-lg-1 col-form-label">Hepatitis:</label>
            <div class="col-lg-3">
              <select class="form-control required" name="hepatitis" id="hepatitis">
                <option value="0"> Tidak Ada </option>
                <option value="1"> Ada </option>
              </select>
              <span class="help-block"></span>
            </div>
            <label class="col-lg-1 col-form-label">Gastring:</label>
            <div class="col-lg-3">
              <select class="form-control required" name="gastring" id="gastring">
                <option value="0"> Tidak Ada </option>
                <option value="1"> Ada </option>
              </select>
              <span class="help-block"></span>
            </div>
            <label class="col-lg-1 col-form-label">Penyakit Lainnya:</label>
            <div class="col-lg-3">
              <select class="form-control required" name="penyakit_lainnya" id="penyakit_lainnya">
                <option value="0"> Tidak Ada </option>
                <option value="1"> Ada </option>
              </select>
              <span class="help-block"></span>
            </div>
          </div>
          <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
          <div class="form-group row">
            <label class="col-lg-2 col-form-label">Alergi Obat-Obatan:</label>
            <div class="col-lg-4">
              <select class="form-control required" name="alergi_obat" id="alergi_obat">
                <option value="0"> Tidak Ada </option>
                <option value="1"> Ada </option>
              </select>
              <span class="help-block"></span>
            </div>
            <div class="col-lg-6">
              <input type="text" class="form-control" name="alergi_obat_val" disabled>
              <span class="help-block"></span>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-lg-2 col-form-label">Alergi Makanan:</label>
            <div class="col-lg-4">
              <select class="form-control required" name="alergi_makanan" id="alergi_makanan">
                <option value="0"> Tidak Ada </option>
                <option value="1"> Ada </option>
              </select>
              <span class="help-block"></span>
            </div>
            <div class="col-lg-6">
              <input type="text" class="form-control" name="alergi_makanan_val" disabled>
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



