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
    <form class="kt-form kt-form--label-right" id="form_rekam_medik">
      <!-- form data pasien -->
      <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
          <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
              Data Pasien
            </h3>
          </div>
        </div>
        <div class="kt-portlet__body">
          <div class="col-md-12 row" style="padding-bottom: 20px;">
            <div>
              <button type="button" class="btn btn-brand" onclick="show_modal_pasien()">Cari Pasien</button>
            </div>
          </div>
          <div class="col-md-12 table-responsive">
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
                  <th>Dokter</th>
                  <th>Nama</th>
                  <th>No. RM</th>
                  <th>Jenis Penjamin</th>
                  <th>Pers. Asuransi</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td colspan="7" style="text-align: center;">Data Pasien Tidak Ditemukan</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="kt-portlet__body" id="menu_area">
          <div class="col-lg-12 row">

            <div class="col-lg-3 div_menu" data-id="div_anamnesa" style="cursor:pointer">
              <div class="kt-portlet kt-iconbox kt-iconbox--wave">
                <div class="kt-portlet__body">
                  <div class="kt-iconbox__body">
                    <div class="kt-iconbox__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <rect x="0" y="0" width="24" height="24"/>
                          <path d="M4.875,20.75 C4.63541667,20.75 4.39583333,20.6541667 4.20416667,20.4625 L2.2875,18.5458333 C1.90416667,18.1625 1.90416667,17.5875 2.2875,17.2041667 C2.67083333,16.8208333 3.29375,16.8208333 3.62916667,17.2041667 L4.875,18.45 L8.0375,15.2875 C8.42083333,14.9041667 8.99583333,14.9041667 9.37916667,15.2875 C9.7625,15.6708333 9.7625,16.2458333 9.37916667,16.6291667 L5.54583333,20.4625 C5.35416667,20.6541667 5.11458333,20.75 4.875,20.75 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                          <path d="M2,11.8650466 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.23590829,11 3.04485894,11.3127315 2,11.8650466 Z M6,7 C5.44771525,7 5,7.44771525 5,8 C5,8.55228475 5.44771525,9 6,9 L15,9 C15.5522847,9 16,8.55228475 16,8 C16,7.44771525 15.5522847,7 15,7 L6,7 Z" fill="#000000"/>
                      </g>
                  </svg> 
                    </div>
                    <div class="kt-iconbox__desc">
                      <h5 class="kt-iconbox__title">
                        Anamnesa
                      </h5>
                      <div class="kt-iconbox__content">
                      Anamnesa
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
      
            <div class="col-lg-3 div_menu" data-id="div_diagnosa" style="cursor:pointer">
              <div class="kt-portlet kt-iconbox kt-iconbox--wave">
                <div class="kt-portlet__body">
                  <div class="kt-iconbox__body">
                    <div class="kt-iconbox__icon">
                      <img src="<?= base_url('assets/svg_icons/stethoscope.svg');?>" width="40px" height="40px"> 
                    </div>
                    <div class="kt-iconbox__desc">
                      <h5 class="kt-iconbox__title">
                        Diagnosa
                      </h5>
                      <div class="kt-iconbox__content">Diagnosa</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-3 div_menu" data-id="div_tindakan" style="cursor:pointer">
              <div class="kt-portlet kt-iconbox kt-iconbox--wave">
                <div class="kt-portlet__body">
                  <div class="kt-iconbox__body">
                    <div class="kt-iconbox__icon">
                      <img src="<?= base_url('assets/svg_icons/doctor.svg');?>" width="40px" height="40px"> 
                    </div>
                    <div class="kt-iconbox__desc">
                      <h5 class="kt-iconbox__title">
                        Tindakan
                      </h5>
                      <div class="kt-iconbox__content">Tindakan</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-3 div_menu" data-id="div_obat" style="cursor:pointer">
              <div class="kt-portlet kt-iconbox kt-iconbox--wave">
                <div class="kt-portlet__body">
                  <div class="kt-iconbox__body">
                    <div class="kt-iconbox__icon">
                      <img src="<?= base_url('assets/svg_icons/medicine.svg');?>" width="40px" height="40px"> 
                    </div>
                    <div class="kt-iconbox__desc">
                      <h5 class="kt-iconbox__title">
                        Obat
                      </h5>
                      <div class="kt-iconbox__content">Obat</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-3 div_menu" data-id="div_odonto" style="cursor:pointer">
              <div class="kt-portlet kt-iconbox kt-iconbox--wave">
                <div class="kt-portlet__body">
                  <div class="kt-iconbox__body">
                    <div class="kt-iconbox__icon">
                      <img src="<?= base_url('assets/svg_icons/tooth.svg');?>" width="40px" height="40px"> 
                    </div>
                    <div class="kt-iconbox__desc">
                      <h5 class="kt-iconbox__title">
                        Odonto
                      </h5>
                      <div class="kt-iconbox__content">
                      Odonto
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-3 div_menu" data-id="div_kamera" style="cursor:pointer">
              <div class="kt-portlet kt-iconbox kt-iconbox--wave">
                <div class="kt-portlet__body">
                  <div class="kt-iconbox__body">
                    <div class="kt-iconbox__icon">
                      <img src="<?= base_url('assets/svg_icons/camera.svg');?>" width="40px" height="40px"> 
                    </div>
                    <div class="kt-iconbox__desc">
                      <h5 class="kt-iconbox__title">
                        Kamera
                      </h5>
                      <div class="kt-iconbox__content">Kamera</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-3 div_menu" data-id="div_riwayat" style="cursor:pointer">
              <div class="kt-portlet kt-iconbox kt-iconbox--wave">
                <div class="kt-portlet__body">
                  <div class="kt-iconbox__body">
                    <div class="kt-iconbox__icon">
                      <img src="<?= base_url('assets/svg_icons/history.svg');?>" width="40px" height="40px"> 
                    </div>
                    <div class="kt-iconbox__desc">
                      <h5 class="kt-iconbox__title">
                        Riwayat
                      </h5>
                      <div class="kt-iconbox__content">Riwayat</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-3 div_menu" data-id="div_pasien" style="cursor:pointer">
              <div class="kt-portlet kt-iconbox kt-iconbox--wave">
                <div class="kt-portlet__body">
                  <div class="kt-iconbox__body">
                    <div class="kt-iconbox__icon">
                      <img src="<?= base_url('assets/svg_icons/patient.svg');?>" width="40px" height="40px"> 
                    </div>
                    <div class="kt-iconbox__desc">
                      <h5 class="kt-iconbox__title">
                        Pasien
                      </h5>
                      <div class="kt-iconbox__content">Data Pasien</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-3 div_menu" data-id="div_diskon" style="cursor:pointer">
              <div class="kt-portlet kt-iconbox kt-iconbox--wave">
                <div class="kt-portlet__body">
                  <div class="kt-iconbox__body">
                    <div class="kt-iconbox__icon">
                      <img src="<?= base_url('assets/svg_icons/tag.svg');?>" width="40px" height="40px"> 
                    </div>
                    <div class="kt-iconbox__desc">
                      <h5 class="kt-iconbox__title">
                        Diskon
                      </h5>
                      <div class="kt-iconbox__content">Diskon</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-3 div_menu" data-id="div_diskon" style="cursor:pointer">
              <div class="kt-portlet kt-iconbox kt-iconbox--wave">
                <div class="kt-portlet__body">
                  <div class="kt-iconbox__body">
                    <div class="kt-iconbox__icon">
                      <img src="<?= base_url('assets/svg_icons/clipboard.svg');?>" width="40px" height="40px"> 
                    </div>
                    <div class="kt-iconbox__desc">
                      <h5 class="kt-iconbox__title">
                        Lab
                      </h5>
                      <div class="kt-iconbox__content">Laboratorium</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
        </div>
        
      </div>  
    </form>
    <!--end::Form-->
  </div>
</div>



