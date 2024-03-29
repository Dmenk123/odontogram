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

        <form id="form-monitoring" name="form-monitoring">
          <div class="row">
            <div class="form-group col-sm-4">
              <label for="lbl_username" class="form-control-label">Tgl Mulai :</label>
              <input type="text" class="form-control kt_datepicker" id="start" name="start" autocomplete="off">
              <span class="help-block"></span>
            </div>

            <div class="form-group col-sm-4">
              <label for="lbl_username" class="form-control-label">Tgl Akhir :</label>
              <input type="text" class="form-control kt_datepicker" id="end" name="end" autocomplete="off" >
              <span class="help-block"></span>
            </div>

            <div class="form-group col-sm-4">
              <label for="lbl_username" class="form-control-label">Nama Dokter:</label>
              <select name="id_dokter" id="id_dokter" class="form-control select2">
                  <option value="">Pilih Dokter</option>
                  <?php foreach($dokter as $row):?>
                      <option value="<?php echo $row->id_pegawai;?>"><?php echo $row->nama_pegawai;?></option>
                  <?php endforeach;?>
              </select>
              <span class="help-block"></span>
            </div>

          </div>

          <div class="kt-portlet__foot">
            <div class="kt-form__actions">
              <button type="button" class="btn btn-success" id="filters">Submit</button>
              <button type="reset" class="btn btn-secondary">Cancel</button>
            </div>
          </div>
        </form>
        
        <div id="div-tabel-area" style="display: none;">
          <div class="row">
            <div class="col-sm-5">
              <table class="table table-striped- table-bordered table-hover table-checkable" id="tabeldata">
                <thead>
                  <tr>
                    <th style="width: 5%;">No</th>
                    <th>Tanggal</th>
                    <th>Dokter</th>
                    <th>Klinik</th>
                    <th>No. RM</th>
                    <th>Honor (Rp)</th>
                    <th>#</th>
                  </tr>
                </thead>
                  <tbody>
                  </tbody>      
              </table>
            </div>
            <div class="col-sm-7" id="chart-report">
              <canvas id="line-chart" width="800" height="450"></canvas>
            </div>
          <div>
        </div>

      </div>
    </div>
  </div>
  
</div>



