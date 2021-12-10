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
          <div class="kt-widget__body">
            <div class="kt-widget__content">
              <div class="kt-widget__info">
                <span class="kt-widget__label">Pegawai : </span>
                <a href="#" class="kt-widget__data"><?php if(isset($data_user)){echo $data_user->kode_user.' - '.$data_user->nama_pegawai;}?></a>
              </div>
              <div class="kt-widget__info">
                <span class="kt-widget__label">Jabatan : </span>
                <a href="#" class="kt-widget__data"><?php if(isset($data_user)){echo $data_user->nama_jabatan;}?></a>
              </div>
              <div class="kt-widget__info">
                <span class="kt-widget__label">Role User : </span>
                <a href="#" class="kt-widget__data"><?php if(isset($data_user)) {echo $data_user->nama_role;} ?></a>
              </div>
              <div class="kt-widget__info">
                <span class="kt-widget__label">Username :</span>
                <span class="kt-widget__data"><?php if(isset($data_user)) {echo $data_user->username;}?></span>
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
                  <h3 class="kt-portlet__head-title">Akses User Klinik <small><?php if(isset($foto_encoded)) {echo "Update"; }else{echo "Tambah"; }?> Berikut merupakan form ceklist Akses Klinik</small></h3>
                </div>
              </div>
              
              <form class="kt-form" id="form_user_klinik">
                <div class="kt-portlet__body">
                  <div class="kt-section kt-section--first">
                    <div class="kt-section__body">
                      <div class="form-group row">
                        <label class="col-3 col-form-label">Pilih Akses</label>
                        <div class="col-9">
                          <div class="kt-checkbox-list">
                            <?php foreach ($data_klinik as $key => $value) { ?>
                              <label class="kt-checkbox kt-checkbox--bold kt-checkbox--success">
                                <input type="checkbox" name="id_klinik[]" value="<?=$value->id;?>"> <?=$value->nama_klinik;?>
                                <span></span>
                              </label>
                            <?php } ?>
                          </div>
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
                        <button id="btnSave" type="button" class="btn btn-success" onclick="saveUserKlinik(<?=$data_user->id;?>)">Simpan</button>&nbsp;
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



