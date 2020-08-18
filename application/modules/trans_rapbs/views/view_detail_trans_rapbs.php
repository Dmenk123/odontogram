    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Transaksi
        <small>RAPBS</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Data Transaksi</a></li>
        <li class="active">RAPBS Detail</li>
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
                  <h4 style="text-align: center;"><strong>Detail RAPBS - SMP. Darul Ulum Surabaya</strong></h4>
                </div>
                <div class="col-xs-6">
                  <h4 style="text-align: left;">Nama Petugas : <?php echo $hasil_header->nama_lengkap_user; ?></h4>
                </div>
                <div class="col-xs-6">
                  <h4 style="text-align: right;">Tanggal Pencatatan: <?php echo date('d-m-Y', strtotime($hasil_header->created_at)); ?></h4>
                </div>
                <hr>
                <table id="tabelRapbsDetail" class="table table-bordered table-hover" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th style="width: 10px; text-align: center;">Komponen</th>
                      <th style="width: 150px; text-align: center;">Uraian</th>
                      <th style="width: 30px; text-align: center;">Vol</th>
                      <th style="width: 30px; text-align: center;">Satuan</th>
                      <th style="width: 100px; text-align: center;">Harga Satuan</th>
                      <th style="width: 100px; text-align: center;">Jumlah Uang</th>
                      <th style="width: 100px; text-align: center;">Gaji Swasta</th>
                      <th style="width: 100px; text-align: center;">Bosnas</th>
                      <th style="width: 30px; text-align: center;">SSN</th>
                      <th style="width: 100px; text-align: center;">Blok Grand</th>
                      <th style="width: 100px; text-align: center;">Hibah Bopda</th>
                      <th style="width: 100px; text-align: center;">Lain-Lain</th>
                      <th style="width: 100px; text-align: center;">Jumlah Total</th>
                      <th style="width: 100px; text-align: center;">Keterangan Belanja</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($hasil_data) : ?>
                      <?php foreach ($hasil_data as $key => $val) { ?>
                        <tr>
                          <td><?php echo $val->kode; ?></td>
                          <td><?php echo $val->uraian; ?></td>
                          <td><?php echo $val->qty; ?></td>
                          <td><?php echo $val->nama_satuan; ?></td>
                          <td>
                            <div>
                              <span class="pull-left">Rp. </span>
                              <span class="pull-right"><?= number_format($val->harga_satuan, 2, ",", "."); ?></span>
                            </div>
                          </td>
                          <td>
                            <div>
                              <span class="pull-left">Rp. </span>
                              <span class="pull-right"><?= number_format($val->harga_total, 2, ",", "."); ?></span>
                            </div>
                          </td>
                          <td>
                            <div>
                              <span class="pull-left">Rp. </span>
                              <span class="pull-right"><?= number_format($val->gaji_swasta, 2, ",", "."); ?></span>
                            </div>
                          </td>
                          <td>
                            <div>
                              <span class="pull-left">Rp. </span>
                              <span class="pull-right"><?= number_format($val->bosnas, 2, ",", "."); ?></span>
                            </div>
                          </td>
                          <td></td>
                          <td></td>
                          <td>
                            <div>
                              <span class="pull-left">Rp. </span>
                              <span class="pull-right"><?= number_format($val->hibah_bopda, 2, ",", "."); ?></span>
                            </div>
                          </td>
                          <td></td>
                          <td>
                            <div>
                              <span class="pull-left">Rp. </span>
                              <span class="pull-right"><?= number_format($val->jumlah_total, 2, ",", "."); ?></span>
                            </div>
                          </td>
                          <td><?php echo $val->keterangan_belanja; ?></td>
                        </tr>
                      <?php } ?>
                    <?php endif ?>
                  </tbody>
                </table>
                <div style="padding-top: 30px; padding-bottom: 10px;">
                  <a class="btn btn-sm btn-danger" title="Kembali" onclick="javascript:history.back()"><i class="glyphicon glyphicon-menu-left"></i> Kembali</a>
                  <?php $id = $this->uri->segment(3); ?>
                  <?php $link_print = site_url('trans_rapbs/cetak_lap_rapbs/') . $id; ?>
                  <?php echo '<a class="btn btn-sm btn-success" href="' . $link_print . '" title="Print" id="btn_print_pengeluaran_detail" target="_blank"><i class="glyphicon glyphicon-print"></i> Cetak</a>'; ?>
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