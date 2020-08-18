    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Daftar
        <small>User</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Daftar</a></li>
        <li class="active">Master User</li>
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
                  <input type="text" class="form-control" id="username" name="username" value="<?php if(isset($hasil_data)){echo $hasil_data->username;}?>">
                  <input type="hidden" class="form-control" id="id" name="id" value="<?php if(isset($hasil_data)){echo $hasil_data->id_user;}?>">
                  <span class="help-block"></span>
                </div>

                <div class="form-group col-md-12">
                  <?php if (isset($hasil_data)) { ?>
                    <label>Password Lama: </label>
                  <?php }else{ ?>
                    <label>Password : </label>
                  <?php } ?>
                  <input type="password" class="form-control" id="password" name="password" value="">
                  <span class="help-block"></span>
                </div>

                <div class="form-group col-md-12">
                  <?php if (isset($hasil_data)) { ?>
                    <label>Ulangi Password Lama: </label>
                  <?php }else{ ?>
                    <label>Ulangi Password : </label>
                  <?php } ?>
                  <input type="password" class="form-control" id="repassword" name="repassword" value="">
                  <span class="help-block"></span>
                </div>
                
                <?php if (isset($hasil_data)) { ?>
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
                <?php } ?>
                
                <div class="form-group col-md-12">
                  <label>Role / Level User : </label>
                    <select class="form-control" id="role" name="role">
                      <?php foreach ($data_role as $key => $role) {
                        if (isset($hasil_data)) { ?>
                          <option value="<?= $role->id_level_user; ?>" <?php if ($hasil_data->id_level_user == $role->id_level_user) {echo "selected";}?>><?= $role->nama_level_user; ?></option>
                        <?php }else{ ?>
                          <option value="<?= $role->id_level_user; ?>"><?= $role->nama_level_user; ?></option>
                        <?php } ?>
                      <?php } ?>
                    </select>
                    <span class="help-block"></span>
                </div>

                <div class="form-group col-md-12">
                  <label>Nama Lengkap : </label>
                  <input type="text" class="form-control" id="namalengkap" name="namalengkap" value="<?php if(isset($hasil_data)){echo $hasil_data->nama_lengkap_user;}?>">
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
                            <option value="<?= $i; ?>" <?php if ((int)date('d', strtotime($hasil_data->tanggal_lahir_user)) == $i) {echo "selected";}?>><?= $i; ?></option>
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
                            <option value="<?= $i; ?>" <?php if ((int)date('m', strtotime($hasil_data->tanggal_lahir_user)) == $i) {echo "selected";}?>><?= $i; ?></option>
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
                            <option value="<?= $i; ?>" <?php if ((int)date('Y', strtotime($hasil_data->tanggal_lahir_user)) == $i) {echo "selected";}?>><?= $i; ?></option>
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
                  <textarea class="form-control" rows="3" placeholder="Alamat ..." id="alamat" name="alamat" ><?php if(isset($hasil_data)){echo $hasil_data->alamat_user;}?></textarea>
                  <span class="help-block"></span>
                </div>

                <div class="form-group col-md-12">
                  <label>Jenis Kelamin : </label>
                    <select class="form-control select2" id="jenkel" name="jenkel">
                      <option value="">Pilih Jenis Kelamin</option>
                      <?php if(isset($hasil_data)){ ?>
                          <option value="L" <?php if ($hasil_data->jenis_kelamin_user == 'L'){echo "selected";}?>>Laki-Laki</option>
                          <option value="P" <?php if ($hasil_data->jenis_kelamin_user == 'P'){echo "selected";}?>>Perempuan</option>
                      <?php } else { ?>
                        <option value="L">Laki-Laki</option>
                        <option value="P">Perempuan</option>
                      <?php } ?>
                    </select>
                    <span class="help-block"></span>
                </div>

                <div class="form-group col-md-12">
                  <label>Nomor Telp : </label>
                  <input type="text" class="form-control numberinput" id="telp" name="telp" value="<?php if(isset($hasil_data)){echo $hasil_data->no_telp_user;}?>">
                  <span class="help-block"></span>
                </div>

                <div class="form-group col-md-9">
                  <label>Foto : </label>
                  <input type="file" id="gambar" class="gambar" name="gambar";/>
                </div>

                <div class="form-group col-md-3">
                  <?php if(isset($hasil_data)){ ?>
                    <img id="gambar-img" src="<?= base_url().'/assets/img/user_img/'.$hasil_data->gambar_user; ?>" alt="Preview Gambar" height="75" width="75" class="pull-right"/>
                  <?php } else { ?>
                    <img id="gambar-img" src="#" alt="Preview Gambar" height="75" width="75" class="pull-right"/>
                  <?php } ?>
                </div>

                <div class="form-group col-md-12">
                  <div class="pull-right">
                    <?php if (isset($hasil_data)) { ?>
                      <button type="button" id="btnSave" class="btn btn-primary" onclick="save('update')"><i class="fa fa-save"></i> Simpan</button>
                    <?php }else{ ?>
                      <button type="button" id="btnSave" class="btn btn-primary" onclick="save('add')"><i class="fa fa-save"></i> Simpan</button>
                    <?php } ?>
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