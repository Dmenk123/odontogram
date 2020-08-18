    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Daftar
        <small>Guru</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Detail</a></li>
        <li class="active">Master Guru Detail</li>
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
                <div class="col-lg-3">
                    <div class="pull-left">
                        <h4 style="text-align:center;"><?= $hasil_data->nama; ?></h4>
                        <img src="<?= base_url().'/assets/img/foto_guru/'.$hasil_data->foto; ?>" alt="image" height="170" width="170" class="img-circle">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="kt-infobox__content">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td coslpan="2"><strong>Biodata Guru</strong></td>
                                </tr>
                                <tr>
                                    <td width="50%">NIP</td>
                                    <td width="47%" style="text-align:left;"><?= $hasil_data->nip; ?></td>
                                </tr>
                                <tr>
                                    <td width="50%">Nama Lengkap</td>
                                    <td width="47%" style="text-align:left;"><?= $hasil_data->nama; ?></td>
                                </tr>
                                <tr>
                                    <td width="50%">Jabatan</td>
                                    <td width="47%" style="text-align:left;"><?= $hasil_data->nama_jabatan; ?></td>
                                </tr>
                                <tr>
                                    <td width="50%">Alamat</td>
                                    <td width="47%" style="text-align:left;"><?= $hasil_data->alamat; ?></td>
                                </tr>
                                <tr>
                                    <td width="50%">Tempat/Tanggal Lahir</td>
                                    <td width="47%" style="text-align:left;"><?= $hasil_data->tempat_lahir.' / '.date('d-m-Y', strtotime($hasil_data->tanggal_lahir)); ?></td>
                                </tr>
                                <tr>
                                    <td width="50%">Jenis Kelamin</td>
                                    <?php if ($hasil_data->jenis_kelamin == 'L') {
                                      echo '<td width="47%" style="text-align:left;">Laki-Laki</td>';
                                    }else{
                                      echo '<td width="47%" style="text-align:left;">Perempuan</td>';
                                    } ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-12">
                    <a href="javascript:window.history.back();" class="btn btn-danger pull-right">kembali</a>
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