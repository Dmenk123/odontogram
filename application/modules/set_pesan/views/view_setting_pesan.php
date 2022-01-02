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

        <!--begin: Datatable -->
        <div class="row">
            <div class="col-sm-6"> 
            <h4>Pesan Personal (Balasan Otomatis)</h4>
            <form id="form-personal" name="form-personal">
              <div class="form-group">
                <input type="hidden" class="form-control" id="type" name="type" value="personal">
                <label for="lbl_telp1" class="form-control-label">Pesan Whatsapp:</label>
                <?php $value = (isset($personal->pesan))?$personal->pesan:'';?>
                <textarea type="text" class="form-control" id="pesan" name="pesan" style="height: 300px;" value="<?= $value;?>" id="ta"><?= $value;?></textarea>
                <span class="help-block"></span>
              </div>
              <div class="form-group">
                <button type="button" class="btn btn-primary" id="btnSave1" onclick="save_personal()">Simpan</button>
              </div>
            </form>
            </div>
            <div class="col-sm-6"> 
            <h4>Pesan Broadcast (Reminder Pasien)</h4>
            <form id="form-broadcast" name="form-broadcast">
              <div class="form-group">
                <input type="hidden" class="form-control" id="type" name="type" value="broadcast">
                <label for="lbl_telp1" class="form-control-label">Pesan Whatsapp:</label>
                <?php $value = (isset($broadcast->pesan))?$broadcast->pesan:'';?>
                <textarea type="text" class="form-control" id="pesan" name="pesan" style="height: 300px;" value="<?= $value;?>" id="ta"><?= $value;?></textarea>
                <span class="help-block"></span>
              </div>
              <div class="form-group">
                <button type="button" class="btn btn-primary" id="btnSave2" onclick="save_broadcast()">Simpan</button>
              </div>
            </form>
            </div>
        </div>
        <!--end: Datatable -->
      </div>
    </div>
  </div>
  
</div>



