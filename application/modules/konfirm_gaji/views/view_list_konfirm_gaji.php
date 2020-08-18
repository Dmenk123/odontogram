    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Penggajian
        <small>Konfirmasi Penggajian</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Konfirmasi Penggajian</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              <div class="">
                <form class="form-horizontal" method="get">
                  <div class="form-group">
                    <label class="control-label col-sm-2">Bulan :</label>
                    <div class="col-sm-4">
                      <select id="bulan" class="form-control col-sm-4" style="margin-right: 5px;" name="bulan">
                        <option value="">Silahkan Pilih Bulan</option>
                        <?php for ($i = 1; $i <= 12; $i++) {
                          if ($i == $this->input->get('bulan')) {
                            echo '<option value="' . $i . '" selected>' . $arr_bulan[$i] . '</option>';
                          } else {
                            echo '<option value="' . $i . '">' . $arr_bulan[$i] . '</option>';
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
                            echo '<option value="' . $i . '">' . $i . '</option>';
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
            <!-- /.box-body -->
            <?php if ($this->input->get('bulan') != "" && $this->input->get('tahun') != "") { ?>
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_progress" data-toggle="tab" aria-expanded="true">On Progress</a></li>
                  <li class=""><a href="#tab_finish" data-toggle="tab" aria-expanded="false">Konfirmasi Selesai</a></li>
                </ul>
                <div class="tab-content">
                  <!-- tab progress -->
                  <div class="tab-pane active" id="tab_progress">
                    <div class="box-body">
                      <div class="table-responsive">
                        <table id="tabelData" class="table table-bordered table-hover" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th style="width: 25%">Total Gaji</th>
                              <th style="width: 20%">Tipe Gaji</th>
                              <th style="width: 20%">Bulan</th>
                              <th style="width: 20%">Tahun</th>
                              <th style="width: 15%">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($datatabel as $key => $val) : ?>
                              <tr>
                                <td>
                                  <div>
                                    <span class="pull-left">Rp. </span>
                                    <span class="pull-right"><?php echo number_format($val->total_gaji, 2, ",", "."); ?></span>
                                  </div>
                                </td>
                                <td><?= $val->tipe_gaji; ?></td>
                                <td><?= $arr_bulan[$val->bulan]; ?></td>
                                <td><?= $val->tahun; ?></td>
                                <td>
                                  <?php $id = $val->is_guru . '/' . $val->bulan . '/' . $val->tahun . '/0'; ?>
                                  <a class="btn btn-sm btn-success" href="<?= site_url('konfirm_gaji/detail/') . $id; ?>" title="Detail" id="btn_detail">
                                    <i class="glyphicon glyphicon-info-sign"></i></a>
                                  <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Konfirmasi" onclick="konfirmGaji('<?= $id; ?>')"><i class="glyphicon glyphicon-pencil"></i></a>
                                </td>
                              </tr>
                            <?php endforeach ?>
                          </tbody>
                        </table>
                      </div>
                      <!-- responsive -->
                    </div>
                  </div>

                  <!-- tab progress -->
                  <div class="tab-pane" id="tab_finish">
                    <div class="box-body">
                      <div class="table-responsive">
                        <table id="tabelData2" class="table table-bordered table-hover" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th style="width: 25%">Total Gaji</th>
                              <th style="width: 20%">Tipe Gaji</th>
                              <th style="width: 20%">Bulan</th>
                              <th style="width: 20%">Tahun</th>
                              <th style="width: 15%">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($datatabel2 as $key => $val) : ?>
                              <tr>
                                <td>
                                  <div>
                                    <span class="pull-left">Rp. </span>
                                    <span class="pull-right"><?php echo number_format($val->total_gaji, 2, ",", "."); ?></span>
                                  </div>
                                </td>
                                <td><?= $val->tipe_gaji; ?></td>
                                <td><?= $arr_bulan[$val->bulan]; ?></td>
                                <td><?= $val->tahun; ?></td>
                                <td>
                                  <?php $id = $val->is_guru . '/' . $val->bulan . '/' . $val->tahun . '/1'; ?>
                                  <a class="btn btn-sm btn-success" href="<?= site_url('konfirm_gaji/detail/') . $id; ?>" title="Detail" id="btn_detail">
                                    <i class="glyphicon glyphicon-info-sign"></i>
                                  </a>
                                  <?php if ($cek_status_kunci == FALSE) { ?>
                                    <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapusKonfirmGaji('<?= $id; ?>')"><i class="glyphicon glyphicon-trash"></i></a>
                                  <?php } ?>
                                </td>
                              </tr>
                            <?php endforeach ?>
                          </tbody>
                        </table>
                      </div>
                      <!-- responsive -->
                    </div>
                  </div>

                </div>
                <!-- /.box-body -->
              </div>
            <?php } ?>
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->