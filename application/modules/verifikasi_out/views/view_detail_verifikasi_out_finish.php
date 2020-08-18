    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Transaksi
        <small>Verifikasi Pengeluaran</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Data Transaksi</a></li>
        <li class="active">Verifikasi Pengeluaran Detail</li>
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
                  <h4 style="text-align: center;"><strong>Detail Verifikasi Pengeluaran - SMP. Darul Ulum Surabaya</strong></h4>
                  <h5 style="text-align: center;"><strong>Status : Sudah di Verifikasi</strong></h5>
                </div>
                <div class="col-xs-4">
                  <h4 style="text-align: left;">Diverifikasi Oleh: <?php echo $hasil_data->nama_lengkap_user; ?></h4>
                </div>
                <div class="col-xs-4">
                  <h4 style="text-align: center;">Nama Pemohon : <?php echo $hasil_data->nama_pemohon; ?></h4>
                </div>
                <div class="col-xs-4">
                  <h4 style="text-align: right;">Tanggal Pencatatan: <?php echo date('d-m-Y',strtotime($hasil_data->tanggal)); ?></h4>
                </div>
                <hr>
                  <table id="tabelTransOrderDetail" class="table table-bordered table-hover" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th style="width: 5%; text-align: center;">Bukti</th>
                        <th style="width: 15%; text-align: center;">ID</th>
                        <th style="text-align: center;">Keterangan</th>
                        <th style="width: 10%; text-align: center;">Qty</th>
                        <th style="width: 15%; text-align: center;">Satuan</th>
                        <th style="width: 10%; text-align: center;">Harga Satuan</th>
                        <th style="width: 10%; text-align: center;">Harga Total</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php if ($hasil_data) : ?>
                      <tr>
                        <td><?php echo '<img src="'.base_url().'/assets/img/bukti_verifikasi/'.$hasil_data->gambar_bukti.'" width="50" height="50">';?></td>  
                        <td><?php echo $hasil_data->id; ?></td>
                        <td><?php echo $hasil_data->keterangan; ?></td>
                        <td><?php echo $hasil_data->qty; ?></td>
                        <td><?php echo $hasil_data->nama_satuan; ?></td>
                        <td>
                          <div>
                            <span class="pull-left">Rp. </span>
                            <span class="pull-right"><?= number_format($hasil_data->harga_satuan,2,",",".");?></span>
                          </div>
                        </td>
                        <td>
                          <div>
                            <span class="pull-left">Rp. </span>
                            <span class="pull-right"><?= number_format($hasil_data->harga_total,2,",",".");?></span>
                          </div>
                        </td>
                      </tr>
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