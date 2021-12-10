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
                        <label class="col-3 col-form-label">Checkboxes</label>
                        <div class="col-9">
                          <div class="kt-checkbox-list">
                            <label class="kt-checkbox">
                              <input type="checkbox"> Option 1
                              <span></span>
                            </label>
                            <label class="kt-checkbox">
                              <input type="checkbox"> Option 2
                              <span></span>
                            </label>
                            <label class="kt-checkbox">
                              <input type="checkbox" checked="checked"> Checked
                              <span></span>
                            </label>
                            <label class="kt-checkbox kt-checkbox--disabled">
                              <input type="checkbox" disabled=""> Disabled
                              <span></span>
                            </label>
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



