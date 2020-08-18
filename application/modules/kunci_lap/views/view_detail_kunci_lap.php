    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Detail
        <small>Penggajian</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Detail</a></li>
        <li class="active">Penggajian</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-lg-12">
                    <div class="kt-infobox__content">
                      <div class="table-responsive">
                          <table class="table table-bordered">
                              <thead>
                                  <tr>
                                      <th>No</th>
                                      <th>Nama Guru</th>
                                      <th>Jabatan</th>
                                      <th>Gaji Perjam</th>
                                      <th>Jam Kerja</th>
                                      <th>Tunjangan Jabatan</th>
                                      <th>Tunjangan Lain</th>
                                      <th>Potongan Lain</th>
                                      <th>Total Gaji</th>
                                      <th>Tipe Pegawai</th>
                                  </tr>
                              </thead>
                              <?php
                                $tot_gaji = 0; 
                                foreach ($hasil_data as $key => $val): 
                                  $tot_gaji += $val->total_take_home_pay;
                              ?>
                              <tbody>
                                  <tr>
                                      <td style="text-align:left;"><?= $key+1; ?></td>
                                      <td style="text-align:left;"><?= $val->nama_guru; ?></td>
                                      <td style="text-align:left;"><?= $val->nama_jabatan; ?></td>
                                      <td>
                                          <div>
                                              <span class="pull-left">Rp. </span>
                                              <span class="pull-right"><?php echo number_format($val->gaji_perjam,0,",",".");?></span>
                                          </div>
                                      </td>
                                      <td style="text-align:left;"><?= $val->jumlah_jam_kerja; ?></td>
                                      <td>
                                          <div>
                                              <span class="pull-left">Rp. </span>
                                              <span class="pull-right"><?php echo number_format($val->gaji_tunjangan_jabatan,0,",",".");?></span>
                                          </div>
                                      </td>
                                      <td>
                                          <div>
                                              <span class="pull-left">Rp. </span>
                                              <span class="pull-right"><?php echo number_format($val->gaji_tunjangan_lain,0,",",".");?></span>
                                          </div>
                                      </td>
                                      <td>
                                          <div>
                                              <span class="pull-left">Rp. </span>
                                              <span class="pull-right"><?php echo number_format($val->potongan_lain,0,",",".");?></span>
                                          </div>
                                      </td>
                                      <td>
                                          <div>
                                              <span class="pull-left">Rp. </span>
                                              <span class="pull-right"><?php echo number_format($val->total_take_home_pay,0,",",".");?></span>
                                          </div>
                                      </td>
                                      <?php if ($val->is_guru == '1') {
                                        echo '<td style="text-align:left;">Guru</td>';
                                      }else{
                                        echo '<td style="text-align:left;">Staff/Karyawan</td>';
                                      } ?>
                                  </tr>
                                  <?php endforeach ?>
                              </tbody>
                          </table>
                      </div>
                    </div>
                </div>
                <div class="col-lg-12">
                  <div>
                    <a href="javascript:window.history.back();" class="btn btn-danger pull-left">kembali</a>
                    <h4 class="pull-right"><strong>Total Gaji : Rp. <?= number_format($tot_gaji,0,",","."); ?> </strong></h4>
                  </div>
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