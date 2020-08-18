    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Transaksi
        <small>Pencatatan Penerimaan</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Data Transaksi</a></li>
        <li class="active">Tambah Penerimaan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="col-xs-s12">
        <div class="box">
          <!-- /.box-header -->
          <div class="box-body">

            <div class="col-md-12">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <i class="fa fa-info"></i>

                  <h3 class="box-title">Upload data excel RAPBS</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <blockquote>
                    <p>Mohon upload data excel RAPBS ke dalam sistem</p>
                    <p>Berikut data Template Format Excel. Dimohon mengikuti aturan penulisan pada Excelnya</p>
                    <small>
                      <a target="_blank" href="<?php echo base_url('assets/img/contoh-excel.xlsx') ?>">
                        <cite title="Source Title">Download Contoh Format Pengisian Excel</cite>
                      </a>
                    </small>
                    <small>
                      <a target="_blank" href="<?php echo base_url('trans_rapbs/get_template') ?>">
                        <cite title="Source Title">Download Template Format Pengisian Excel</cite>
                      </a>
                    </small>
                  </blockquote>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>

            <form method="post" action="<?= base_url('trans_rapbs/saveimport'); ?>" class="form-horizontal" enctype="multipart/form-data">

              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Lampirkan File</label>
                <div class="col-sm-10">
                  <input type="file" name="file" class="form-control" id="file" required accept=".xls, .xlsx" /></p>
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-2 pull-right">
                  <input type="submit" class="btn btn-block btn-primary" value="Import" name="import">
                </div>
              </div>

              <!--   <div class="col-md-2 pull-right">
                <div class="form-group" style="text-align:center; margin:10%">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                </div>
              </div> -->

            </form>


            <!-- <form method="post" enctype="multipart/form-data" action="<?= base_url('penerimaan/proses_penerimaan'); ?>">

                <div class="form-group col-md-12">
                  <label>Keterangan : </label>
                  <input type="text" class="form-control" id="i_keterangan" name="i_keterangan" value="">
                </div>

                <div class="form-group col-md-6">
                  <label>Satuan : </label>
                  <select name="i_satuan" id="i_satuan" class="form-control">
                    <?php $data_satuan = $this->db->get('tbl_satuan')->result(); ?>
                    <?php foreach ($data_satuan as $key => $value) : ?>
                      <?php echo '<option value="' . $value->id . '">' . $value->nama . '</option>'; ?>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group col-md-6">
                  <label>Qty : </label>
                  <input type="text" class="form-control numberinput" id="i_qty" name="i_qty" value="">
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
              </form> -->
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>

    </section>
    <!-- /.content -->