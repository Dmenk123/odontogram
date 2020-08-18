    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Transaksi
        <small>Penerimaan Harian</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Data Transaksi</a></li>
        <li class="active">Penerimaan Harian Detail</li>
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
                <?php foreach ($hasil_header as $val ) : ?>
                <div class="col-xs-12">
                  <h4 style="text-align: center;"><strong>Detail Penerimaan - SMP. Darul Ulum Surabaya</strong></h4>
                </div>
                <div class="col-xs-6">
                  <h4 style="text-align: left;">Nama Petugas : <?php echo $val->nama_lengkap_user; ?></h4>
                </div>
                <div class="col-xs-6">
                  <h4 style="text-align: right;">Tanggal Pencatatan: <?php echo date('d-m-Y',strtotime($val->tanggal)); ?></h4>
                </div>
                <?php endforeach ?>
                <hr>
                  <table id="tabelTransMasukDetail" class="table table-bordered table-hover" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th style="width: 10px; text-align: center;">Gambar</th>
                        <th style="width: 50px; text-align: center;">Kode</th>
                        <th style="width: 30px; text-align: center;">Jumlah</th>
                        <th style="width: 30px; text-align: center;">Satuan</th>
                        <?php if ($sts == 'finish') { ?>
                          <th style="width: 100px; text-align: center;">Harga</th>
                          <th style="width: 100px; text-align: center;">Total</th>
                        <?php } ?>
                        <th style="text-align: center;">Keterangan</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php if ($hasil_data): ?>
                    <?php $no = 1; ?>
                        <tr>
                        <td><?php echo '<img src="'.base_url().'/assets/img/bukti_verifikasi/'.$hasil_data->gambar_bukti.'" width="50" height="50">';?></td>   
                        <td><?php echo $hasil_data->id_trans_masuk; ?></td>
                        <td><?php echo $hasil_data->qty; ?></td>
                        <td><?php echo $hasil_data->nama_satuan; ?></td>
                        <?php if ($sts == 'finish') { ?>
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
                        <?php } ?>
                        <td><?php echo $hasil_data->keterangan; ?></td>
                        </tr>
                    <?php endif ?>     
                    </tbody>
                  </table>
                  <div style="padding-top: 30px; padding-bottom: 10px;">
                    <a class="btn btn-sm btn-danger" title="Kembali" onclick="javascript:history.back()"><i class="glyphicon glyphicon-menu-left"></i> Kembali</a>
                    <?php $id = $this->uri->segment(3); ?>
                    <?php $link_print = site_url('penerimaan/cetak_nota_penerimaan/').$id; ?>
                    <?php echo '<a class="btn btn-sm btn-success" href="'.$link_print.'" title="Print" id="btn_print_pengeluaran_detail" target="_blank"><i class="glyphicon glyphicon-print"></i> Cetak</a>';?>
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