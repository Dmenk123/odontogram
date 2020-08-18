    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Transaksi
        <small>RAPBS</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Data Transaksi</a></li>
        <li class="active">RENCANA ANGGARAN PENDAPATAN DAN BELANJA SEKOLAH (RAPBS)</li>
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
                    <label class="control-label col-sm-2">Tahun :</label>
                    <div class="col-sm-4">
                      <select id="tahun" class="form-control col-sm-3" style="margin-right: 5px;" name="tahun">
                        <option value="">Silahkan Pilih Tahun</option>
                        <?php for ($i = 2010; $i <= 2025; $i++) {
                          if ($i == $this->input->get('tahun')) {
                            echo '<option value="' . $i . '" selected>' . $i . '</option>';
                          } else {
                            if ($i == (int) date('Y')) {
                              echo '<option value="' . $i . '" selected>' . $i . '</option>';
                            } else {
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

            <?php if ($this->input->get('tahun') != "") { ?>
              <div class="box-header">
                <!-- <a class="btn btn-success" href="<?= base_url('trans_rapbs/add_rapbs/') ?>"><i class="glyphicon glyphicon-plus"></i> Tambah Data</a> -->
                <?php $this->template_view->getAddButton() ?>
                <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <!-- flashdata -->
                <?php if ($this->session->flashdata('feedback_success')) { ?>
                  <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
                    <?= $this->session->flashdata('feedback_success') ?>
                  </div>

                <?php } elseif ($this->session->flashdata('feedback_failed')) { ?>
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-remove"></i> Gagal!</h4>
                    <?= $this->session->flashdata('feedback_failed') ?>
                  </div>
                <?php } ?>
                <!-- end flashdata -->
                <div class="table-responsive">
                  <table id="tabelRapbs" class="table table-bordered" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Tahun</th>
                        <th>Dibuat</th>
                        <th>Petugas</th>
                        <th>Aksi</th>
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