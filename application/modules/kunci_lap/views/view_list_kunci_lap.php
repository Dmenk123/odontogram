    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Laporan
        <small>Kunci Laporan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Laporan</a></li>
        <li class="active">Kunci Laporan</li>
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
                    <label class="control-label col-sm-2">Tahun :</label>
                    <div class="col-sm-4">
                      <select id="tahun" class="form-control col-sm-3" style="margin-right: 5px;" name="tahun">
                        <option value="">Silahkan Pilih Tahun</option>
                        <?php for ($i=2010; $i <=2025 ; $i++) {
                          if ($i == $this->input->get('tahun')) {
                            echo '<option value="'.$i.'" selected>'.$i.'</option>';
                          }else{
                            echo '<option value="'.$i.'">'.$i.'</option>';
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
            <?php if ($this->input->get('tahun') != "") { ?>
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_list" data-toggle="tab" aria-expanded="true">List Data</a></li>
                  <li class=""><a href="#tab_form" data-toggle="tab" aria-expanded="false">Form Kunci Laporan</a></li>
                </ul>
                <div class="tab-content">
                  <!-- tab progress -->
                  <div class="tab-pane active" id="tab_list">
                    <div class="box-body">
                      <div class="table-responsive"> 
                        <table id="tabelData" class="table table-bordered table-hover" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th style="width: 25%">Bulan</th>
                              <th style="width: 25%">Tahun</th>
                              <th style="width: 35%">Status</th>
                              <th style="width: 15%">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($datatabel as $key => $val): ?>
                              <tr>
                                <td><?= $arr_bulan[(int)$val->bulan]; ?></td>
                                <td><?= $val->tahun; ?></td>
                                <?php if ($val->is_kunci == '1') { ?>
                                  <td style="color: green;">Terkunci</td>
                                <?php }else{ ?>
                                  <td style="color: red;">Belum Terkunci</td>
                                <?php } ?>
                                <td>
                                  <?php $id = $val->bulan.','.$val->tahun.','.$val->is_kunci; ?>
                                  <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Aksi" onclick="setKunci(<?=$id;?>)"><i class="glyphicon glyphicon-pencil"></i></a>
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

                  <div class="tab-pane" id="tab_form">
                    <div class="box-body">
                      <form class="form-horizontal" id="formTambahKuncian" action="#">
                        <div class="form-group">
                          <label class="control-label col-sm-2">Tahun :</label>
                          <div class="col-sm-4">
                            <select id="tahun_kunci" class="form-control col-sm-3" style="margin-right: 5px;" name="tahun_kunci">
                              <option value="">Silahkan Pilih Tahun</option>
                              <?php for ($i=((int)date('Y')-10); $i <= ((int)date('Y') + 10); $i++) {
                                  echo '<option value="'.$i.'">'.$i.'</option>';
                              } ?>
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-sm-2">Bulan :</label>
                          <div class="col-sm-4">
                            <select id="bulan_kunci" class="form-control col-sm-4" style="margin-right: 5px;" name="bulan_kunci">
                              <option value="">Silahkan Pilih Bulan</option>
                              <?php for ($i=1; $i <=12 ; $i++) { 
                                echo '<option value="'.$i.'">'.$arr_bulan[$i].'</option>';
                              } ?>
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-sm-2"></label>
                          <div class="col-sm-6">
                            <button type="button" id="btnAdd" onclick="kunciLaporan()" class="btn btn-primary">Kunci Laporan</button>
                          </div>
                        </div>

                      </form>
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
