    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        LAPORAN K1
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Laporan</a></li>
        <li class="active">LAPORAN K1</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              <label class="control-label">Pilih periode Laporan pada field dibawah ini</label>
              <form class="form-inline" method="get" action="<?php echo site_url('lap_k1/laporan_k1_detail') ?>" target="_blank">
                <div class="form-group">
                  <select name="tahun" class="form-control" id="tahun" required="">
                    <option value="">Pilih Tahun</option>
                    <?php
                      $thn = date('Y'); 
                      for ($z=(int)$thn-10; $z <= (int)$thn + 10; $z++) { 
                      echo "<option value='$z'>$z</option>";
                    } ?>
                  </select>
                </div>
                <button type="submit" class="btn btn-info">Cari</button>
                <button type="reset" class="btn btn-default">reset</button>
              </form>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <a class="btn btn-sm btn-danger" title="Kembali" onclick="javascript:history.back()"><i class="glyphicon glyphicon-menu-left"></i> Kembali</a>
            </div>
          </div>
          <!-- /.box -->
        </div>
      </div>    
    </section>
    <!-- /.content -->
