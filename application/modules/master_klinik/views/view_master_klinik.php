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
    
    <div class="kt-portlet kt-portlet--mobile">
      <div style="padding-top:2%;">
       
      </div>

      <div class="kt-portlet__body kt-portlet__body--fit-y">

        <!--begin::Widget -->
        <div class="kt-widget kt-widget--user-profile-1">
          <div class="kt-widget__head">
            <div class="kt-widget__media">
              <?php if(isset($foto_encoded)) { ?>
                <img src="<?= $foto_encoded; ?>" alt="image">
              <?php } ?>
            </div>
            <div class="kt-widget__content">
              <div class="kt-widget__section">
                <a href="#" class="kt-widget__username">
                  <?php if(isset($data_klinik)) {echo $data_klinik->nama_klinik; }?>
                  <i class="flaticon2-correct kt-font-success"></i>
                </a>
                <span class="kt-widget__subtitle">
                  <?php if(isset($data_klinik)) {echo $data_klinik->alamat.' , '.$data_klinik->kota.' '.$data_klinik->provinsi.' , '.$data_klinik->kode_pos; } ?>
                </span>
              </div>
            </div>
          </div>
          <div class="kt-widget__body">
            <div class="kt-widget__content">
              <div class="kt-widget__info">
                <span class="kt-widget__label">Dokter : </span>
                <a href="#" class="kt-widget__data"><?php if(isset($data_klinik)){echo $data_klinik->nama_dokter;}?></a>
              </div>
              <div class="kt-widget__info">
                <span class="kt-widget__label">SIP : </span>
                <a href="#" class="kt-widget__data"><?php if(isset($data_klinik)){echo $data_klinik->sip;}?></a>
              </div>
              <div class="kt-widget__info">
                <span class="kt-widget__label">Telp : </span>
                <a href="#" class="kt-widget__data"><?php if(isset($data_klinik)) {echo $data_klinik->telp;} ?></a>
              </div>
              <div class="kt-widget__info">
                <span class="kt-widget__label">Email :</span>
                <span class="kt-widget__data"><?php if(isset($data_klinik)) {echo $data_klinik->email;}?></span>
              </div>
            </div>
          </div>
        </div>
        <!--end::Widget -->
      </div>

      <!--Begin:: App Content-->
      <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
        <div class="row">
          <div class="col-xl-12">
            <div class="kt-portlet">
              <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                  <h3 class="kt-portlet__head-title">Profil Klinik <small><?php if(isset($foto_encoded)) {echo "Update"; }else{echo "Tambah"; }?> Profil Klinik pada Form dibawah ini</small></h3>
                </div>
              </div>
              <form class="kt-form" id="form_profile">
                <div class="kt-portlet__body">
                  <div class="kt-section kt-section--first">
                    <div class="kt-section__body">
                      <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Logo Klinik</label>
                        <div class="col-lg-9 col-xl-6">
                          <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar">
                            <?php if(isset($foto_encoded)) { ?>
                              <img id="preview_img" class="rounded" src="<?= $foto_encoded; ?>" alt="Preview Foto" height="200" width="200"/>
                            <?php } ?>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Upload gambar </label>
                        <div></div>
                        <div class="custom-file col-lg-9 col-xl-6">
                          <input type="file" class="custom-file-input" id="foto" name="foto" accept=".jpg,.jpeg,.png">
                          <label class="custom-file-label" id="label_foto" for="customFile">Pilih gambar yang akan diupload</label>
                          <span class="form-text text-muted">Abaikan jika tidak ingin merubah gambar profil klinik</span>
                        </div>
                      </div>
                      <div class="row" style="padding-top:10px;">
                        <label class="col-xl-3"></label>
                        <div class="col-lg-9 col-xl-6">
                          <h3 class="kt-section__title kt-section__title-sm">Data Klinik:</h3>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Nama Klinik</label>
                        <div class="col-lg-9 col-xl-6">
                          <input class="form-control" type="text" value="<?php if(isset($data_klinik)) { echo $data_klinik->nama_klinik; }?>" name="nama">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Alamat</label>
                        <div class="col-lg-9 col-xl-6">
                          <input class="form-control" type="text" value="<?php if(isset($data_klinik)) { echo $data_klinik->alamat; }?>" name="alamat">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Kelurahan</label>
                        <div class="col-lg-9 col-xl-6">
                          <input class="form-control" type="text" value="<?php if(isset($data_klinik)) { echo $data_klinik->kelurahan; }?>" name="kelurahan">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Kecamatan</label>
                        <div class="col-lg-9 col-xl-6">
                          <input class="form-control" type="text" value="<?php if(isset($data_klinik)) { echo $data_klinik->kecamatan; }?>" name="kecamatan">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Kota</label>
                        <div class="col-lg-9 col-xl-6">
                          <input class="form-control" type="text" value="<?php if(isset($data_klinik)) { echo $data_klinik->kota; }?>" name="kota">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Provinsi</label>
                        <div class="col-lg-9 col-xl-6">
                          <input class="form-control" type="text" value="<?php if(isset($data_klinik)) { echo $data_klinik->provinsi; }?>" name="provinsi">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Kode Pos</label>
                        <div class="col-lg-9 col-xl-6">
                          <input class="form-control numberinput" type="text" value="<?php if(isset($data_klinik)) { echo $data_klinik->kode_pos; }?>" name="kodepos">
                        </div>
                      </div>
                      <div class="row">
                        <label class="col-xl-3"></label>
                        <div class="col-lg-9 col-xl-6">
                          <h3 class="kt-section__title kt-section__title-sm">Data Kontak Klinik:</h3>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Nama Dokter</label>
                        <div class="col-lg-9 col-xl-6">
                          <input class="form-control" type="text" value="<?php if(isset($data_klinik)) { echo $data_klinik->nama_dokter; }?>" name="dokter">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">SIP</label>
                        <div class="col-lg-9 col-xl-6">
                          <input class="form-control" type="text" value="<?php if(isset($data_klinik)) { echo $data_klinik->sip; }?>" name="sip">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">No. Telepon/HP Klinik</label>
                        <div class="col-lg-9 col-xl-6">
                          <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                            <input type="text" class="form-control" value="<?php if(isset($data_klinik)) { echo $data_klinik->sip; }?>" placeholder="Nomor Telp" aria-describedby="basic-addon1" name="telp">
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Email Klinik</label>
                        <div class="col-lg-9 col-xl-6">
                          <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
                            <input type="text" class="form-control" value="<?php if(isset($data_klinik)) { echo $data_klinik->email; }?>" placeholder="Email" aria-describedby="basic-addon1" name="email">
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Website</label>
                        <div class="col-lg-9 col-xl-6">
                          <input class="form-control" type="text" value="<?php if(isset($data_klinik)) { echo $data_klinik->website; }?>" name="website">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="kt-portlet__foot">
                  <div class="kt-form__actions">
                    <div class="row">
                      <div class="col-lg-3 col-xl-3">
                      </div>
                      <div class="col-lg-9 col-xl-9">
                        <?php if(isset($data_klinik)) { ?>
                          <button id="btnSave" type="button" class="btn btn-success" onclick="save('<?=$data_klinik->id;?>')">Simpan</button>&nbsp;
                        <?php }else{ ?>
                          <button id="btnSave" type="button" class="btn btn-success" onclick="save()">Simpan</button>&nbsp;
                        <?php } ?>
                        <a type="button" class="btn btn-secondary" href="<?=base_url($this->uri->segment(1));?>">Batal</a>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!--End:: App Content-->
    </div>

  </div>
  
</div>



