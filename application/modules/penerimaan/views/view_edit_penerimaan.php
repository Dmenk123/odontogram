    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit
        <small>Pencatatan Penerimaan</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Data Transaksi</a></li>
        <li class="active">Edit Penerimaan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-s12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <form method="post" enctype="multipart/form-data" action="<?= base_url('penerimaan/update_penerimaan'); ?>">

                <div class="form-group col-md-12">
                  <label>Keterangan : </label>
                  <input type="text" class="form-control" id="i_keterangan" name="i_keterangan" value="<?= $hasil_data->keterangan; ?>">
                  <input type="hidden" class="form-control" id="i_id_header" name="i_id_header" value="<?= $hasil_data->id; ?>">
                  <input type="hidden" class="form-control" id="i_id_detail" name="i_id_detail" value="<?= $hasil_data->id_detail; ?>">
                </div>

                <div class="form-group col-md-6">
                  <label>Satuan : </label>
                  <select name="i_satuan" id="i_satuan" class="form-control">
                    <?php $data_satuan = $this->db->get('tbl_satuan')->result(); ?>
                    <?php foreach ($data_satuan as $key => $value) : ?>
                      <?php if ($hasil_data->satuan == $value->id) { ?>
                        <?php echo '<option value="' . $value->id . '" selected>' . $value->nama . '</option>'; ?>
                      <?php } else { ?>
                        <?php echo '<option value="' . $value->id . '">' . $value->nama . '</option>'; ?>
                      <?php } ?>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group col-md-6">
                  <label>Qty : </label>
                  <input type="text" class="form-control numberinput" id="i_qty" name="i_qty" value="<?= $hasil_data->qty; ?>">
                </div>

                <div class="form-group col-md-6">
                  <label>harga Satuan : </label>
                  <input type="text" class="form-control mask-currency" id="i_harga" name="i_harga" value="" data-thousands="." data-decimal="," data-prefix="Rp. " onKeyUp="hargaTotal();" />
                  <input type="hidden" class="form-control" id="i_harga_raw" name="i_harga_raw" value="" />
                </div>

                <div class="form-group col-md-6">
                  <label>Harga Total : </label>
                  <input type="text" class="form-control mask-currency" id="i_harga_total" name="i_harga_total" data-thousands="." data-decimal="," data-prefix="Rp. " readonly />
                  <input type="hidden" class="form-control" id="i_harga_total_raw" name="i_harga_total_raw" value="" />
                </div>

                <div class="form-group col-md-9">
                  <label>Bukti : </label>
                  <input type="file" id="i_gambar" class="i_gambar" name="i_gambar" ; />
                </div>

                <div class="form-group col-md-3">
                  <img id="i_gambar-img" src="#" alt="Preview Gambar" height="75" width="75" class="pull-right" />
                </div>

                <div class="form-group col-md-12">
                  <label><strong>Ceklist Pilihan ini Apabila dana dari BOS</strong></label>
                  <div class="checkbox">
                    <label>
                      <?php if ($hasil_data->is_bos = 1) { ?>
                        <input type="checkbox" name="is_bos" value="t" checked> Dana dari BOS (bantuan Operasional Sekolah)
                      <?php } else { ?>
                        <input type="checkbox" name="is_bos" value="t"> Dana dari BOS (bantuan Operasional Sekolah)
                      <?php } ?>
                    </label>
                  </div>
                </div>

                <div class="form-group col-md-12">
                  <label><strong>Ceklist Pilihan Setuju Apabila Data Sudah di Verifikasi</strong></label>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="ceklis" onchange="eventCeklis(this)" value="t"> Setuju, Saya Sudah Memastikan data Telah Benar
                    </label>
                  </div>
                </div>
                <div class="col-md-6">
                  <h3>Grand Total : </h3>
                </div>
                <div class="col-md-4">
                  <h3 id="grand_total"></h3>
                </div>
                <div class="col-md-2 pull-right">
                  <div class="form-group" style="text-align:center; margin:10%">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
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