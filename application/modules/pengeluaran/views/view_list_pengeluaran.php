    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Transaksi
        <small>Pengeluaran Harian</small>
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

            <div class="box-body">
              <div class="">
                <form class="form-horizontal" method="get">
                  <div class="form-group">
                    <label class="control-label col-sm-2">Bulan :</label>
                    <div class="col-sm-4">
                      <select id="bulan" class="form-control col-sm-4" style="margin-right: 5px;" name="bulan">
                        <option value="">Silahkan Pilih Bulan</option>
                        <?php $flagBlnAda = FALSE; ?>
                        <?php for ($i = 1; $i <= 12; $i++) {
                          if ($i == $this->input->get('bulan')) {
                            echo '<option value="' . $i . '" selected>' . $arr_bulan[$i] . '</option>';
                            $flagBlnAda = TRUE;
                          } else {
                            if ($i == (int)date('m') && $flagBlnAda == FALSE) {
                              echo '<option value="' . $i . '" selected>' . $arr_bulan[$i] . '</option>';
                            }else{
                              echo '<option value="' . $i . '">' . $arr_bulan[$i] . '</option>';
                            }
                          }
                        } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-2">Tahun :</label>
                    <div class="col-sm-4">
                      <select id="tahun" class="form-control col-sm-3" style="margin-right: 5px;" name="tahun">
                        <option value="">Silahkan Pilih Tahun</option>
                        <?php for ($i = 2010; $i <= 2025; $i++) {
                          if ($i == $this->input->get('tahun')) {
                            echo '<option value="' . $i . '" selected>' . $i . '</option>';
                          } else {
                            if ($i == (int)date('Y')) {
                              echo '<option value="' . $i . '" selected>' . $i . '</option>';
                            }else{
                              echo '<option value="' . $i . '">' . $i . '</option>';
                            }
                          }
                        } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-2"></label>
                    <div class="col-sm-6">
                      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Proses</button>
                    </div>
                  </div>

                </form>
              </div>
            </div>

            <?php if ($this->input->get('bulan') != "" && $this->input->get('tahun') != "") { ?>
              <!-- <script>
                showData(<?= $this->input->get('bulan'); ?>, <?= $this->input->get('tahun'); ?>);
              </script> -->
              <div class="box-header">
                <?php if ($cek_kunci == FALSE) { ?>
                  <button class="btn btn-success" onclick="addPengeluaran()"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button>
                <?php } ?>
                <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="table-responsive">
                  <table id="tabelPengeluaran" class="table table-bordered" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>ID Pencatatan</th>
                        <th>Tanggal</th>
                        <th>Nama User</th>
                        <th>Pemohon</th>
                        <th>Status</th>
                        <th style="width: 13%;">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.box-body -->
            <?php } ?>

          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->