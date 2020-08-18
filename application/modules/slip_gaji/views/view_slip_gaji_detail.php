    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Laporan Slip Gaji
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Laporan</a></li>
        <li class="active">Laporan Slip Gaji</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <div class="col-xs-12">
                  <h4 style="text-align: center;"><strong>Laporan Slip Gaji - SMP. Darul Ulum Surabaya</strong></h4>
                </div>
                <div class="col-xs-12">
                  <h4 style="text-align: center;">Periode : <?php echo $periode ?></h4>
                </div>
                  <table id="tblLaporanMutasiDetail" class="table table-bordered table-hover" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th style="width: 30%; text-align: center;">Nama</th>
                        <th style="width: 20%; text-align: center;">jabatan</th>
                        <th style="width: 10%; text-align: center;">Bulan</th>
                        <th style="width: 10%; text-align: center;">Tahun</th>
                        <th style="width: 20%; text-align: center;">Total Gaji</th>
                        <th style="width: 10%; text-align: center;">Cetak</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php if ($hasil_data) : ?>
                    <?php $no = 1; ?>
                        <?php foreach ($hasil_data as $val ) : ?>
                        <tr>
                          <td><?php echo $val->nama_guru; ?></td> 
                          <td><?php echo $val->nama_jabatan ?></td>
                          <td><?php echo $arr_bulan[(int)$val->bulan] ?></td>
                          <td><?php echo $val->tahun; ?></td>
                          <td>
                            <div>
                              <span class="pull-left">Rp. </span>
                              <span class="pull-right"><?= number_format($val->total_take_home_pay,0,",","."); ?></span>
                            </div>
                          </td>
                          <td>
                            <a class="btn btn-sm btn-success" target="_blank" href="<?= base_url('slip_gaji/slip_gaji_cetak/').$val->id;?>" title="Cetak"><i class="glyphicon glyphicon-print"></i></a>
                          </td>
                        </tr>
                        <?php endforeach ?>
                    <?php endif ?>     
                    </tbody>
                  </table>
                  <div style="padding-top: 30px; padding-bottom: 10px;">
                    <a class="btn btn-sm btn-danger" title="Kembali" onclick="javascript:history.back()"><i class="glyphicon glyphicon-menu-left"></i> Kembali</a>
                  </div>
              </div>  
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>    
    </section>
    <!-- /.content -->                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    