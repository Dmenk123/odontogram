<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

  <!-- begin:: Content Head -->
  <div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
      <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">
          <?= $this->template_view->nama('judul'); ?>
        </h3>
      </div>
    </div>
  </div>
  <!-- end:: Content Head -->

  <!-- begin:: Content -->
  <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    
    <div class="kt-portlet kt-portlet--mobile">
      
      <div class="kt-portlet__body">

        <!--begin: Datatable -->
        <form id="submit_form" method="get" action="<?= base_url('lap_penerimaan_klinik')?>" >
          <!-- Horizontal Form -->
         <div class="form-group row">
            <label class="col-lg-3 col-form-label text-left">Pilih Klinik</label>
            <div class="col-lg-7">
              <select name="klinik" class="form-control input" id="klinik" data-id="klinik">
                <option selected value="">Silahkan Pilih</option>
                <?php foreach ($data_klinik as $k => $v) { ?>
                    <option value="<?=$v->id;?>" <?php if ( $this->input->get('klinik') == $v->id) { echo 'selected'; } ?>><?=$v->nama_klinik;?></option>
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
              <label class="col-lg-3 col-form-label text-left">Pilih Periode</label>
              <div class="col-lg-7">
                <select name="model" class="form-control input" id="model" data-id="model" onChange="changeModel()" >
                  <option selected value="">Silahkan Pilih</option>
                  <option value="2" <?php if ( $this->input->get('model') == 2) { echo 'selected'; } ?>>Per Tahun</option>
                  <option value="1" <?php if ( $this->input->get('model') == 1) { echo 'selected'; } ?>>Per Bulan</option>
                  <option value="3" <?php if ( $this->input->get('model') == 3) { echo 'selected'; } ?>>Per Hari</option>
                </select>
              </div>
          </div>
          <div class="form-group row div_tanggal_mulai" style="display:none;">
              <label class="col-lg-3 col-form-label text-left">Tanggal Mulai</label>
              <div class="col-lg-7">
                  <input type="text" class="form-control kt_datepicker" id="tanggal_awal" name="start" value="<?php echo $this->input->get('start') ?? null;?>" autocomplete="off">
              </div>
          </div>
          <div class="form-group row div_tanggal_akhir" style="display:none;">
              <label class="col-lg-3 col-form-label text-left">Tanggal Akhir</label>
              <div class="col-lg-7">
                  <input type="text" class="form-control kt_datepicker" id="tanggal_akhir" name="end" value="<?php echo $this->input->get('end') ?? null;?>" autocomplete="off">
              </div>
          </div>
          <div class="form-group row div_bulan" style="display:none;">
              <label class="col-lg-3 col-form-label text-left">Bulan</label>
              <div class="col-lg-7">
                <select name="bulan" class="form-control input" id="bulan" data-id="bulan" >
                  <option selected value="">Silahkan Pilih</option>
                  <option value="1" <?php if ( $this->input->get('bulan') == 1) { echo 'selected'; } ?>>Januari</option>
                  <option value="2" <?php if ( $this->input->get('bulan') == 2) { echo 'selected'; } ?>>Februari</option>
                  <option value="3" <?php if ( $this->input->get('bulan') == 3) { echo 'selected'; } ?>>Maret</option>
                  <option value="4" <?php if ( $this->input->get('bulan') == 4) { echo 'selected'; } ?>>April</option>
                  <option value="5" <?php if ( $this->input->get('bulan') == 5) { echo 'selected'; } ?>>Mei</option>
                  <option value="6" <?php if ( $this->input->get('bulan') == 6) { echo 'selected'; } ?>>Juni</option>
                  <option value="7" <?php if ( $this->input->get('bulan') == 7) { echo 'selected'; } ?>>Juli</option>
                  <option value="8" <?php if ( $this->input->get('bulan') == 8) { echo 'selected'; } ?>>Agustus</option>
                  <option value="9" <?php if ( $this->input->get('bulan') == 9) { echo 'selected'; } ?>>September</option>
                  <option value="10" <?php if ( $this->input->get('bulan') == 10) { echo 'selected'; } ?>>Oktober</option>
                  <option value="11" <?php if ( $this->input->get('bulan') == 11) { echo 'selected'; } ?>>November</option>
                  <option value="12" <?php if ( $this->input->get('bulan') == 12) { echo 'selected'; } ?>>Desember</option>
                </select>
              </div>
          </div>
          <div class="form-group row div_bulan" style="display:none;">
              <label class="col-lg-3 col-form-label text-left">Tahun</label>
              <div class="col-lg-7">
                <select name="tahun" class="form-control input" id="tahun" data-id="tahun" >
                  <option selected value="">Silahkan Pilih</option>
                  <?php for ($i=2020;$i<=date("Y");$i++) { ?>
                  <option value="<?=$i?>" <?php if ( $this->input->get('tahun') == $i) { echo 'selected'; } ?>><?=$i?></option>
                  <?php } ?>
                </select>
              </div>
          </div>
          <div class="form-group row div_tahun" style="display:none;">
              <label class="col-lg-3 col-form-label text-left">Tahun</label>
              <div class="col-lg-7">
                <select name="tahun2" class="form-control input" id="tahun2" data-id="tahun2" >
                  <option selected value="">Silahkan Pilih</option>
                  <?php for ($i=2020;$i<=date("Y");$i++) { ?>
                  <option value="<?=$i?>" <?php if ( $this->input->get('tahun2') == $i) { echo 'selected'; } ?> ><?=$i?></option>
                  <?php } ?>
                </select>
              </div>
          </div>
          <div class="row">
              <label class="col-lg-3"></label>
              <div class="col-lg-9">
                  <div class="form-group form-button">
                      <button type="button" class="btn btn-fill btn-success" onclick="save()">Tampilkan</button>
                      <button type="button" onclick="cetak()" class="btn btn-fill btn-danger">Cetak</button>
                  </div>
              </div>
          </div>
        </form>

        <?php
          if ($this->input->get('model')) {
            $nama_klinik = '';

            if($this->input->get('klinik')) {
              $klinike_mbahe = $this->db->query("select * from m_klinik where id = '".$this->input->get('klinik')."'")->row();
              $nama_klinik = $klinike_mbahe->nama_klinik;  
            }

            if($this->input->get('model') == '1') {
              $txt_periode = 'Bulan '.bulan_indo($this->input->get('bulan')).' Tahun '.$this->input->get('tahun');
            }elseif($this->input->get('model') == '2') {
              $txt_periode = 'Tahun ' . $this->input->get('tahun');
            } elseif ($this->input->get('model') == '3') {
              $txt_periode = 'Tanggal ' . tanggal_indo($this->input->get('tanggal_awal')).' s/d '.tanggal_indo($this->input->get('tanggal_akhir'));
            }
        ?>
          <h3>Laporan Penerimaan <?=$nama_klinik.' '.$txt_periode;?></h3>
            <table class="table table-striped- table-bordered table-hover table-checkable" id="tabel_lap_penjualan">
              <thead>
                <tr>
                  <th style="width: 5%;">No</th>
                  <th>Tanggal</th>
                  <th>Pasien</th>
                  <th>Layanan</th>
                  <th>Dokter</th>
                  <th>Omset Klinik</th>
                  <th>Honor Dokter</th>
                  <th>Total Nett</th>
                </tr>
              </thead>
              <tbody>
              </tbody>      
          </table>
        <?php
        }
        ?>
        

        <!--end: Datatable -->
      </div>
    </div>
  </div>
  
</div>



