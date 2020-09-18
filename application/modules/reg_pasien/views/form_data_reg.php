<?php
$obj_date = new DateTime();
?>
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
    <form class="kt-form kt-form--label-right" id="form_registrasi">
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
            <div class=" col-lg-4 col-md-9 col-sm-12">
              <select class="form-control kt-select2" id="nama" name="nama">
                <option value="">Silahkan Pilih Nama Pasien</option>
              </select>
              <span class="help-block"></span>
            </div>
            <label class="col-lg-1 col-form-label">No RM:</label>
            <div class="col-lg-2">
              <input type="text" class="form-control mask_rm" id="no_rm" name="no_rm" onkeyup="to_upper(this)" disabled value="<?php if(isset($data_reg)) {echo $data_reg->no_rm;} ?>">
              <span class="help-block"></span>
            </div>
            <label class="col-lg-1 col-form-label">NIK:</label>
            <div class="col-lg-2">
              <input type="text" class="form-control" id="nik" name="nik" maxlength="16" disabled value="<?php if(isset($data_reg)) {echo $data_reg->nik;} ?>">
              <span class="help-block"></span>
            </div>
          </div>
          <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
          <div class="form-group row form-group-marginless">
            <label class="col-lg-1 col-form-label">Tempat Lahir:</label>
            <div class="col-lg-5">
              <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" disabled value="<?php if(isset($data_reg)) {echo $data_reg->tempat_lahir;} ?>">
              <span class="help-block"></span>
            </div>
            <label class="col-lg-1 col-form-label">Tanggal Lahir:</label>
            <div class="col-lg-4">
              <input type="text" class="form-control mask_tanggal" id="tanggal_lahir" name="tanggal_lahir" autocomplete="off" disabled value="<?php if(isset($data_reg)) {echo DateTime::createFromFormat('Y-m-d', $data_reg->tanggal_lahir)->format('d/m/Y');} ?>">
              <span class="help-block"></span>
            </div>
          </div>
        </div>
      </div>

      <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
          <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
              Form Registrasi
            </h3>
          </div>
        </div>
        <div class="kt-portlet__body">
          <div class="form-group row form-group-marginless kt-margin-t-20">
            <label class="col-lg-1 col-form-label">Tanggal:</label>
            <div class="col-lg-2">
              <input type="text" class="form-control mask_tanggal" id="tanggal_reg" name="tanggal_reg" autocomplete="off" value="<?php if(isset($data_reg)) {echo DateTime::createFromFormat('Y-m-d', $data_reg->tanggal_lahir)->format('d/m/Y');}else{echo $obj_date->format('d/m/Y');} ?>">
              <span class="help-block"></span>
            </div>
            <label class="col-lg-1 col-form-label">Pukul:</label>
            
            <div class="col-lg-2">
              <div class="input-group timepicker">
                <input class="form-control" id="jam_reg" name="jam_reg" readonly placeholder="Pilih Jam" type="text">
                <div class="input-group-append">
                  <span class="input-group-text">
                    <i class="la la-clock-o"></i>
                  </span>
                </div>
              </div>
              <span class="help-block"></span>
            </div>

            <label class="col-lg-1 col-form-label">Umur:</label>
            <div class="col-lg-1">
              <input type="text" class="form-control numberinput" id="umur_reg" name="umur_reg" autocomplete="off" value="<?php if(isset($data_reg)) {echo $data_reg->tanggal_lahir;} ?>">
              <span class="help-block"></span>
            </div>

            <label class="col-lg-1 col-form-label">Pemetaan:</label>
            <div class="col-lg-3">
              <select class="form-control required" name="pemetaan" id="pemetaan">
                <?php
                  foreach ($data_pemetaan as $keys => $vals) { ?>
                    <option value='<?= $vals->id; ?>' <?php if(isset($data_reg) && $data_reg->id_pemetaan == $vals->id) {echo "selected";} ?>> <?= $vals->keterangan; ?> </option>;
                <?php } ?>
              </select>
              <span class="help-block"></span>
            </div>

          </div>
          
          <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
          <div class="form-group row form-group-marginless kt-margin-t-20">
            <label class="col-lg-2 col-form-label">Dokter:</label>
            <div class=" col-lg-8">
              <select class="form-control kt-select2" id="dokter" name="dokter">
                <option value="">Silahkan Pilih Nama Dokter</option>
              </select>
              <span class="help-block"></span>
            </div>
          </div>
          <div><br /></div>
          <div class="form-group row form-group-marginless kt-margin-t-20">
            <label class="col-lg-2 col-form-label">Jenis Penjamin:</label>
            <div class=" col-lg-8">
              <select class="form-control" id="jenis_penjamin" name="jenis_penjamin">
                <option value="">Umum</option>
                <option value="1">Asuransi</option>
              </select>
              <span class="help-block"></span>
            </div>
          </div>

          <div><br /></div>
          <div id="div-append-form">

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



