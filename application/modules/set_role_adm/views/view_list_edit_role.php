    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Role
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Setting</a></li>
        <li>Setting Role</li>
        <li class="active">Edit Role</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <form class="form-edit-role" id="form-edit-role" action="<?=base_url()."".$this->uri->segment(1)."/".$this->uri->segment(2);?>_data" method="post">
              <div class="box-header">
              <input type="hidden" value="<?php echo $old_data['id_level_user'];?>" name="id_role">
                <div class="form-group">
                  <label class="control-label col-sm-3">Role User :</label>
                  <div class="col-sm-9">
                    <input type="input" class="form-control required" id="nama_role" value="<?php echo $old_data['nama_level_user'];?>" name="nama_role">
                  </div>
                </div>
                <br>
                <div class="form-group">
                  <label class="control-label col-sm-3">Keterangan : <br>jika diperlukan *</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" id="keterangan" name="keterangan"><?php echo $old_data['keterangan_level_user'];?></textarea>
                  </div>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="form-group">
                  <div class="table-responsive"> 
                    <?php echo $check_box_menu; ?>
                  </div>
                  <!-- responsive --> 
                </div>
                <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                  <img src="<?php echo base_url();?>assets/img/AjaxLoader.gif" id="loading" style="display:none">
                  <p id="pesan_error" style="display:none" class="text-warning" style="display:none"></p>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                  <button type="submit" class="btn btn-primary tombol-simpan"><i class="fa fa-save"></i> Ubah Data</button>
                  <a href="<?=base_url()."".$this->uri->segment(1);?>">
                    <span class="btn btn-warning"><i class="glyphicon glyphicon-remove"></i> Batal</span>
                  </a>
                </div>
              </div>
              </div>
              <!-- /.box-body -->
            </form>
          </div>
          <!-- /.box -->
        </div>
      </div>    
    </section>
    <!-- /.content -->
