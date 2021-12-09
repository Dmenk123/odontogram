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
          <div class="col-12 row" style="padding-bottom: 20px;">
            <div class="col-12">
              <button type="button" class="btn btn-brand" onclick="show_modal_pasien()">Cari Pasien</button>
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
        <?php if($is_pulang){ ?>
          <div class="kt-portlet__body">
            <div class="col-12">
              <div class="alert alert-danger fade show" role="alert">
                <div class="alert-icon"><i class="flaticon-warning"></i></div>
                <div class="alert-text">Perhatian !!!. Pasien ini [<?=$datareg->no_reg;?>] telah dipulangkan pada tanggal : <?=tanggal_indo($datareg->tanggal_pulang).' pukul : '.$datareg->jam_pulang;?><span style="float: right;cursor:pointer;" onclick="batalkanPulang()"><b><u>Klik disini untuk membatalkan</u></b></span></div>
                <div class="alert-close">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-close"></i></span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
        

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
            
            <div class="col-lg-3 div_menu" data-id="div_logistik" style="cursor:pointer">
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
                        Odontogram
                      </h5>
                      <div class="kt-iconbox__content">
                      Odontogram
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
                          Foto X-ray
                      </h5>
                      <div class="kt-iconbox__content">Foto X-ray</div>
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

            <!-- <div class="col-lg-3 div_menu" data-id="div_diskon" style="cursor:pointer">
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
            </div> -->

            <div class="col-lg-3">&nbsp;</div>

            <div class="col-lg-3 div_menu" data-id="div_tindakanlab" style="cursor:pointer">
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

            <div class="col-lg-3 div_menu" data-id="div_pulangkan" style="cursor:pointer">
              <div class="kt-portlet kt-iconbox kt-iconbox--danger kt-iconbox--animate-slower">
                <div class="kt-portlet__body">
                  <div class="kt-iconbox__body">
                    <div class="kt-iconbox__icon">
                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              <rect opacity="0.300000012" x="0" y="0" width="24" height="24"/>
                              <polygon fill="#000000" fill-rule="nonzero" opacity="0.3" points="7 4.89473684 7 21 5 21 5 3 11 3 11 4.89473684"/>
                              <path d="M10.1782982,2.24743315 L18.1782982,3.6970464 C18.6540619,3.78325557 19,4.19751166 19,4.68102291 L19,19.3190064 C19,19.8025177 18.6540619,20.2167738 18.1782982,20.3029829 L10.1782982,21.7525962 C9.63486295,21.8510675 9.11449486,21.4903531 9.0160235,20.9469179 C9.00536265,20.8880837 9,20.8284119 9,20.7686197 L9,3.23140966 C9,2.67912491 9.44771525,2.23140966 10,2.23140966 C10.0597922,2.23140966 10.119464,2.2367723 10.1782982,2.24743315 Z M11.9166667,12.9060229 C12.6070226,12.9060229 13.1666667,12.2975724 13.1666667,11.5470105 C13.1666667,10.7964487 12.6070226,10.1879981 11.9166667,10.1879981 C11.2263107,10.1879981 10.6666667,10.7964487 10.6666667,11.5470105 C10.6666667,12.2975724 11.2263107,12.9060229 11.9166667,12.9060229 Z" fill="#000000"/>
                          </g>
                      </svg>
                    </div>
                    <div class="kt-iconbox__desc">
                      <h5 class="kt-iconbox__title">
                        Pulangkan
                      </h5>
                      <div class="kt-iconbox__content">
                        <span style="font-size: 12px;">Pulangkan Pasien</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-3">&nbsp;</div>

            
          </div>
        </div>

        <div class="kt-portlet__foot" id="print_area">
          <div class="row align-items-center">
            <div class="col-lg-12 row">
              <div class="col-lg-2 col-sm-4">
                <a href="<?= base_url('rekam_medik/cetak_anamnesa')?>?pid=<?=$this->input->get('pid');?>" class="widget-body" target="_blank"></a>
                <h5 style="color:black!important;">
                  <a href="<?= base_url('rekam_medik/cetak_anamnesa')?>?pid=<?=$this->input->get('pid');?>" class="widget-body" target="_blank">
                    <img src="<?= base_url('assets/images/pdf.png'); ?>" width="40" height="auto" alt="Anamnesa"> 
                  </a>
                  <a target="_blank" href="<?= base_url('rekam_medik/cetak_anamnesa')?>?pid=<?=$this->input->get('pid');?>" style="color:black!important;">Anamnesa</a>
                </h5>
              </div>

              <div class="col-lg-2 col-sm-4">
                <a href="<?= base_url('rekam_medik/cetak_odontogram')?>?pid=<?=$this->input->get('pid');?>" class="widget-body" target="_blank"></a>
                <h5 style="color:black!important;">
                  <a href="<?= base_url('rekam_medik/cetak_odontogram')?>?pid=<?=$this->input->get('pid');?>" class="widget-body" target="_blank">
                    <img src="<?= base_url('assets/images/pdf.png'); ?>" width="40" height="auto" alt="Anamnesa"> 
                  </a>
                  <a target="_blank" href="<?= base_url('rekam_medik/cetak_odontogram')?>?pid=<?=$this->input->get('pid');?>" style="color:black!important;">Odontogram</a>
                </h5>
              </div>

              <div class="col-lg-2 col-sm-4">
                <a href="<?= base_url('rekam_medik/cetak_pemeriksaan')?>?pid=<?=$this->input->get('pid');?>" class="widget-body" target="_blank"></a>
                <h5 style="color:black!important;">
                  <a href="<?= base_url('rekam_medik/cetak_pemeriksaan')?>?pid=<?=$this->input->get('pid');?>" class="widget-body" target="_blank">
                    <img src="<?= base_url('assets/images/pdf.png'); ?>" width="40" height="auto" alt="Anamnesa"> 
                  </a>
                  <a target="_blank" href="<?= base_url('rekam_medik/cetak_pemeriksaan')?>?pid=<?=$this->input->get('pid');?>" style="color:black!important;">Pemeriksaan</a>
                </h5>
              </div>

              <div class="col-lg-2 col-sm-4">
                <a href="<?= base_url('rekam_medik/cetak_perawatan')?>?pid=<?=$this->input->get('pid');?>" class="widget-body" target="_blank"></a>
                <h5 style="color:black!important;">
                  <a href="<?= base_url('rekam_medik/cetak_perawatan')?>?pid=<?=$this->input->get('pid');?>" class="widget-body" target="_blank">
                    <img src="<?= base_url('assets/images/pdf.png'); ?>" width="40" height="auto" alt="Anamnesa"> 
                  </a>
                  <a target="_blank" href="<?= base_url('rekam_medik/cetak_perawatan')?>?pid=<?=$this->input->get('pid');?>" style="color:black!important;">Perawatan</a>
                </h5>
              </div>

              <div class="col-lg-2 col-sm-4">
                <a href="<?= base_url('rekam_medik/cetak_foto')?>?pid=<?=$this->input->get('pid');?>" class="widget-body" target="_blank"></a>
                <h5 style="color:black!important;">
                  <a href="<?= base_url('rekam_medik/cetak_foto')?>?pid=<?=$this->input->get('pid');?>" class="widget-body" target="_blank">
                    <img src="<?= base_url('assets/images/pdf.png'); ?>" width="40" height="auto" alt="Anamnesa"> 
                  </a>
                  <a target="_blank" href="<?= base_url('rekam_medik/cetak_foto')?>?pid=<?=$this->input->get('pid');?>" style="color:black!important;">Foto</a>
                </h5>
              </div>

            </div>
          </div>
        </div>
        
      </div>  
    </form>
    <!--end::Form-->
  </div>
</div>



