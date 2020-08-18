    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Daftar
        <small>User</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Edit</a></li>
        <li class="active">Master Guru / Staff</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-s12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <form id="form_input">
                <div class="form-group col-md-12">
                  <label>Username : </label>
                  <input type="text" class="form-control" id="username" name="username" value="<?php echo $hasil_data->nip; ?>" readonly>
                  <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $hasil_data->id; ?>">
                  <span class="help-block"></span>
                </div>

                <div class="form-group col-md-12">
                  <label>Password Lama: </label>
                  <input type="password" class="form-control" id="password" name="password" value="">
                  <span class="help-block"></span>
                </div>

                <div class="form-group col-md-12">
                  <label>Ulangi Password : </label>
                  <input type="password" class="form-control" id="repassword" name="repassword" value="">
                  <span class="help-block"></span>
                </div>
                
                <div class="form-group col-md-12">
                  <label>Password Baru : </label>
                  <input type="password" class="form-control" id="passwordnew" name="passwordnew" value="">
                  <span class="help-block"></span>
                </div>

                <div class="form-group col-md-12 checkbox">
                  <label>
                    <input type="checkbox" value="Y" name="ceklistpwd" id="ceklistpwd"> Centang Pilihan ini jika tidak mengganti password
                  </label>
                </div>
                                
                <div class="form-group col-md-12">
                  <label>Nama Lengkap : </label>
                  <input type="text" class="form-control" id="namalengkap" name="namalengkap" value="<?php echo $hasil_data->nama; ?>">
                  <span class="help-block"></span>
                </div>

                <div class="form-group col-md-12">
                  <label>Tempat Lahir : </label>
                  <input type="text" class="form-control" id="tempatlahir" name="tempatlahir" value="<?php echo $hasil_data->tempat_lahir; ?>">
                  <span class="help-block"></span>
                </div>

                <div class="form-group col-md-12">
                  <label>Tanggal Lahir </label>  
                  <div class="row">
                    <div class="col-md-4">
                      <label>Hari : </label>
                      <select class="form-control" id="dobday" name="hari">
                        <?php for ($i=1; $i <= 31; $i++) { ?> 
                          <?php if (isset($hasil_data)) { ?>
                            <option value="<?= $i; ?>" <?php if ((int)date('d', strtotime($hasil_data->tanggal_lahir)) == $i) {echo "selected";}?>><?= $i; ?></option>
                          <?php }else { ?>
                            <option value="<?= $i;?>"><?= $i; ?></option>
                          <?php } ?>
                        <?php }?>
                      </select>
                      <span class="help-block"></span> 
                    </div>
                    <div class="col-md-4">
                      <label>Bulan : </label>
                      <select class="form-control" id="dobmonth" name="bulan">
                        <?php for ($i=1; $i <= 12; $i++) { ?> 
                          <?php if (isset($hasil_data)) { ?>
                            <option value="<?= $i; ?>" <?php if ((int)date('m', strtotime($hasil_data->tanggal_lahir)) == $i) {echo "selected";}?>><?= $i; ?></option>
                          <?php }else { ?>
                            <option value="<?= $i;?>"><?= $i; ?></option>
                          <?php } ?>
                        <?php }?>
                      </select>
                      <span class="help-block"></span>
                    </div>
                    <div class="col-md-4">
                      <label>Tahun : </label>
                      <select class="form-control" id="dobyear" name="tahun">
                        <?php for ($i=1945; $i <= 2019; $i++) { ?> 
                          <?php if (isset($hasil_data)) { ?>
                            <option value="<?= $i; ?>" <?php if ((int)date('Y', strtotime($hasil_data->tanggal_lahir)) == $i) {echo "selected";}?>><?= $i; ?></option>
                          <?php }else { ?>
                            <option value="<?= $i;?>"><?= $i; ?></option>
                          <?php } ?>
                        <?php }?>
                      </select>
                      <span class="help-block"></span>
                    </div>
                  </div>
                </div>

                <div class="form-group col-md-12">
                  <label>Alamat : </label>
                  <textarea class="form-control" rows="3" placeholder="Alamat ..." id="alamat" name="alamat" ><?php echo $hasil_data->alamat; ?></textarea>
                  <span class="help-block"></span>
                </div>

                <div class="form-group col-md-12">
                  <label>Jenis Kelamin : </label>
                    <select class="form-control select2" id="jenkel" name="jenkel">
                      <option value="">Pilih Jenis Kelamin</option>
                      <option value="L" <?php if ($hasil_data->jenis_kelamin == 'L'){echo "selected";}?>>Laki-Laki</option>
                      <option value="P" <?php if ($hasil_data->jenis_kelamin == 'P'){echo "selected";}?>>Perempuan</option>
                    </select>
                    <span class="help-block"></span>
                </div>

                <div class="form-group col-md-9">
                  <label>Foto : </label>
                  <input type="file" id="gambar" class="gambar" name="gambar";/>
                </div>

                <div class="form-group col-md-3">
                  <img id="gambar-img" src="<?= base_url().'/assets/img/foto_guru/'.$hasil_data->foto; ?>" alt="Preview Gambar" height="75" width="75" class="pull-right"/>
                </div>

                <div class="form-group col-md-12">
                  <div class="pull-right">
                      <button type="button" id="btnSave" class="btn btn-primary" onclick="update_profil('pegawai')"><i class="fa fa-save"></i> Simpan</button>
                  </div>
                  <div class="pull-left">
                    <a class="btn btn-md btn-danger" title="Kembali" onclick="javascript:history.back()"><i class="glyphicon glyphicon-menu-left"></i> Kembali</a>
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