    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Laporan Buku Kas Umum
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Laporan</a></li>
        <li class="active">Laporan Buku Kas Umum</li>
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
                  <h4 style="text-align: center;"><strong>Laporan Buku Kas Umum - SMP. Darul Ulum Surabaya</strong></h4>
                </div>
                <div class="col-xs-12">
                  <h4 style="text-align: center;">Periode : <?php echo $periode ?></h4>
                </div>
                  <table id="tblLaporanMutasiDetail" class="table table-bordered table-hover" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th style="width: 10%; text-align: center;">Tanggal</th>
                        <th style="width: 10%; text-align: center;">No. Kode</th>
                        <th style="width: 10%; text-align: center;">No. Bukti</th>
                        <th style="width: 20%; text-align: center;">Uraian</th>
                        <th style="width: 15%; text-align: center;">Penerimaan</th>
                        <th style="width: 15%; text-align: center;">Pengeluaran</th>
                        <th style="width: 15%; text-align: center;">Saldo</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php if (count($hasil_data) != 0): ?>
                    <?php $no = 1; ?>
                        <?php foreach ($hasil_data as $val ) : ?>
                        <tr>
                          <td><?php echo $val['tanggal']; ?></td> 
                          <td><?php echo $val['kode'] ?></td>
                          <td><?php echo $val['bukti'] ?></td>
                          <td><?php echo $val['keterangan']; ?></td>
                          <td>
                            <div>
                              <span class="pull-left">Rp. </span>
                              <span class="pull-right"><?= $val['penerimaan'];?></span>
                            </div>
                          </td>
                          <td>
                            <div>
                              <span class="pull-left">Rp. </span>
                              <span class="pull-right"><?= $val['pengeluaran'];?></span>
                            </div>
                          </td>  
                          <td>
                            <div>
                              <span class="pull-left">Rp. </span>
                              <span class="pull-right"><?= number_format($val['saldo_akhir'],2,",",".");?></span>
                            </div>
                          </td>      
                        </tr>
                        <?php endforeach ?>
                    <?php endif ?>     
                    </tbody>
                  </table>
                  <div style="padding-top: 30px; padding-bottom: 10px;">
                    <a class="btn btn-sm btn-danger" title="Kembali" onclick="javascript:history.back()"><i class="glyphicon glyphicon-menu-left"></i> Kembali</a>
                    <?php $link_print = site_url("lap_bku/cetak_report_bku/".$bln_awal."/".$bln_akhir."/".$tahun.""); ?>
                    <?php echo '<a class="btn btn-sm btn-success" href="'.$link_print.'" target="_blank" title="Print Laporan BKU" id="btn_print_laporan_bku"><i class="glyphicon glyphicon-print"></i> Cetak</a>';?>
                    <?php $link_submit = site_url("lap_bku/konfirmasi_lap_bku/".$bln_awal."/".$bln_akhir."/".$tahun.""); ?>
                    <?php echo '<a class="btn btn-sm btn-info pull-right" href="'.$link_submit.'" target="_blank" title="Submit Laporan BKU" id="btn_print_laporan_bku"><i class="glyphicon glyphicon-ok"></i> Submit</a>';?>
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