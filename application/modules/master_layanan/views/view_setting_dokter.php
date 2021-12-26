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
  <style>
      .pad-p {
        padding-top:11px;
      }

      .form-group {
            margin-bottom: none;
        }

  </style>

  <!-- begin:: Content -->
  <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    
    <div class="kt-portlet kt-portlet--mobile">
      <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
          <span class="kt-portlet__head-icon">
            <i class="kt-font-brand flaticon2-line-chart"></i>
          </span>
          <h3 class="kt-portlet__head-title">
            <?= $title; ?>
          </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
          <div class="kt-portlet__head-wrapper">
            <div class="kt-portlet__head-actions">
             
            </div>
          </div>
        </div>
      </div>
      <div class="kt-portlet__body">

       <!--begin::Form-->
       <form class="kt-form kt-form--label-right" id="form-dokter">
            <div class="kt-portlet__body">
                <div class="row">
                    <label for="example-text-input" class="col-2 col-form-label">Nama Layanan</label>
                    <div class="col-10">
                        <p class="pad-p">:&nbsp;<?php echo $layanan->nama_layanan;?></p>
                    </div>
                </div>
                <div class="row">
                    <label for="example-search-input" class="col-2 col-form-label">Durasi waktu layanan</label>
                    <div class="col-10">
                        <p class="pad-p">:&nbsp;<?php echo $layanan->waktu_layanan .' Menit';?></p>
                    </div>
                </div>

                <div class="row">
                    <label for="example-search-input" class="col-2 col-form-label">Kode layanan</label>
                    <div class="col-10">
                        <p class="pad-p">:&nbsp;<?php echo $layanan->kode_layanan;?></p>
                    </div>
                </div>
               
                <div class="row">
                    <label for="example-email-input" class="col-2 col-form-label">Dokter yg menangani</label>
                    <div class="col-10">
                        <input type="hidden" name="id_layanan" value="<?php echo $layanan->id_layanan;?>">
                        <div class="pad-p">
                            <?php
                            $dokter_exis = explode(",", $layanan->dokter);
                            foreach ($dokter as $value) {
                            ?>
                                <label class="kt-checkbox kt-checkbox--success">
                                <input type="checkbox" name="dokter[]" id="dokter" value="<?= $value->id;?>" <?php if (in_array($value->id, $dokter_exis)) echo 'checked' ?>> <?= $value->nama;?>
                                <span></span>
                                </label><br>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-2">
                        </div>
                        <div class="col-10">
                            <button type="reset" class="btn btn-success" id="btnSave" onclick="save_dokter()">Submit</button>
                            <a  class="btn btn-secondary" href="<?php echo base_url('master_layanan');?>">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
  
</div>



