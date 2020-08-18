    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Laporan Pembelian Barang
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Laporan</a></li>
        <li class="active">Laporan Pembelian</li>
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
                  <h4 style="text-align: center;"><strong>Laporan Pembelian Barang - PT. SPB</strong></h4>
                </div>
                <div class="col-xs-12">
                  <h4 style="text-align: center;">Periode Tanggal : <?php echo $tanggal ?></h4>
                </div>
                  <table id="tabelLaporanBeliDetail" class="table table-bordered table-hover" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th style="width: 10px; text-align: center;">No</th>
                        <th style="width: 20px; text-align: center;">Tanggal</th>
                        <th style="width: 20px; text-align: center;">ID PO</th>
                        <th style="width: 200px; text-align: center;">Nama Barang</th>
                        <th style="width: 20px; text-align: center;">Satuan</th>
                        <th style="width: 20px; text-align: center;">Jumlah</th>
                        <th style="width: 180px; text-align: center;">Supplier</th>
                        <th style="text-align: center;">Keterangan</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php if (count($hasil_data) != 0): ?>
                    <?php $no = 1; ?>
                        <?php foreach ($hasil_data as $val ) : ?>
                          <tr>
                        <td><?php echo $no++; ?></td> 
                        <td><?php echo $val->tgl_trans_beli_detail; ?></td>
                        <td><?php echo $val->id_trans_beli; ?></td>
                        <td><?php echo $val->nama_barang; ?></td>
                        <td><?php echo $val->nama_satuan; ?></td>
                        <td><?php echo $val->qty_beli; ?></td>
                        <td><?php echo $val->nama_supplier; ?></td>
                        <td><?php echo $val->keterangan_beli; ?></td>
                        </tr>
                        <?php endforeach ?>
                    <?php endif ?>     
                    </tbody>
                  </table>
                  <div style="padding-top: 30px; padding-bottom: 10px;">
                    <a class="btn btn-sm btn-danger" title="Kembali" onclick="javascript:history.back()"><i class="glyphicon glyphicon-menu-left"></i> Kembali</a>

                    <?php $tglAwal = $tanggal_awal; ?> 
                    <?php $tglAkhir = $tanggal_akhir; ?>
                    <?php $link_print = site_url("laporan_beli/cetak_report_pembelian/".$tglAwal."/".$tglAkhir.""); ?>
                    <?php echo '<a class="btn btn-sm btn-success" href="'.$link_print.'" target="_blank" title="Print Laporan Pembelian" id="btn_print_laporan_beli"><i class="glyphicon glyphicon-print"></i> Cetak</a>';?>
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