    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Transaksi
        <small>Verifikasi Pengeluaran</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Data Transaksi</a></li>
        <li class="active">Pengeluaran Harian</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-s12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table id="tabel_form_proses" class="table table-bordered table-hover" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>ID Pengeluaran</th>
                      <th>Tanggal</th>
                      <th>Nama User</th>
                      <th>Pemohon</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php 
                        echo "<td>$data_form->id</td>";
                        echo "<td>".date('d-m-Y', strtotime($data_form->tanggal))."</td>";
                        echo "<td>$data_form->user_id</td>";
                        echo "<td>$data_form->pemohon</td>";
                      ?>
                    </tr>
                  </tbody>
                </table>
              </div>  

              <form method="post" enctype="multipart/form-data" action="<?= base_url('verifikasi_out/proses_verifikasi'); ?>">
                <?php 
                foreach ($data_detail as $key => $value) {
                  $urut = $key+1;
                  echo '<button type="button" class="accordion button-acr">Transaksi Detail no. '.$urut.' | Keterangan : '.$value->keterangan.'</button>';
                    echo '<div class="panel">';
                      echo ' 
                        <div class="form-group col-md-12">
                          <label>Keterangan : </label>
                          <input type="text" class="form-control" id="i_keterangan" name="i_keterangan[]" value="'.$value->keterangan.'" readonly>
                        </div>

                        <div class="form-group col-md-6">
                          <label>Satuan : </label>
                          <input type="text" class="form-control" id="i_satuan" name="i_satuan[]" value="'.$value->nama.'" readonly>
                          <input type="hidden" class="form-control" id="id_satuan" name="id_satuan[]" value="'.$value->satuan.'" readonly>
                          <input type="hidden" class="form-control" id="id_detail" name="id_detail[]" value="'.$value->id.'" readonly>
                          <input type="hidden" class="form-control" id="id_header" name="id_header[]" value="'.$value->id_trans_keluar.'" readonly>
                        </div>

                        <div class="form-group col-md-6">
                          <label>Qty : </label>
                          <input type="text" class="form-control" id="i_qty-'.$key.'" name="i_qty[]" value="'.$value->qty.'" readonly>
                        </div>

                        <div class="form-group col-md-6">
                          <label>harga Satuan : </label>
                          <input type="text" class="form-control mask-currency" id="i_harga-'.$key.'" name="i_harga[]" value="" data-thousands="." data-decimal="," data-prefix="Rp. " onKeyUp="hargaTotal('.$key.');"/>
                          <input type="hidden" class="form-control" id="i_harga_raw-'.$key.'" name="i_harga_raw[]" value=""/>
                        </div>

                        <div class="form-group col-md-6">
                          <label>Harga Total : </label>
                          <input type="text" class="form-control mask-currency" id="i_harga_total-'.$key.'" name="i_harga_total[]" data-thousands="." data-decimal="," data-prefix="Rp. " readonly/>
                          <input type="hidden" class="form-control" id="i_harga_total_raw-'.$key.'" name="i_harga_total_raw[]" value=""/>
                        </div>

                        <div class="form-group col-md-6">
                          <label>Kode Akun BOS : </label>
                          <input type="text" class="form-control" id="i_akun-'.$key.'" name="i_akun[]" value="'.$value->qty.'" readonly>
                        </div>

                        <div class="form-group col-md-9">
                          <label>Bukti : </label>
                          <input type="file" id="i_gambar-'.$key.'" class="i_gambar" name="i_gambar'.$key.'";/>
                        </div>

                        <div class="form-group col-md-3">
                          <img id="i_gambar-'.$key.'-img" src="#" alt="Preview Gambar" height="75" width="75" class="pull-right"/>
                        </div>

                        <div class="form-group col-md-12">
                        <label><strong>Ceklist Pilihan Setuju Apabila Data Sudah di Verifikasi</strong></label>
                          <div class="checkbox">
                              <label>
                                <input type="checkbox" name="ceklis[]" onchange="eventCeklis(this, '.$key.')" value="t"> Setuju, Saya Sudah Memastikan data Telah Benar
                              </label>
                            </div>
                        </div>';
                    echo '</div>';
                }
                ?>
                <div class="col-md-6">
                  <h3>Grand Total : </h3>
                </div>
                <div class="col-md-4">
                  <h3 id="grand_total"></h3>
                </div>
                <div class="col-md-2 pull-right">
                  <div class="form-group" style="text-align:center; margin:10%">
                    <button type="submit" class="btn btn-primary tombol-simpan"><i class="fa fa-save"></i> Simpan</button>
                  </div>
                </div>
              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>    
    </section>
    <!-- /.content -->