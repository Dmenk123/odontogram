    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit <?php echo $this->template_view->nama_menu('nama_menu'); ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Setting</a></li>
        <li>Setting Menu</li>
        <li class="active">Edit Menu</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <form class="form-horizontal" id="form-edit-menu" action="<?=base_url()."".$this->uri->segment(1)."/".$this->uri->segment(2);?>_data" method="post">
              <div class="form-group" style="padding-top:50px;">
                <label class="control-label col-sm-4" >Nama Menu :</label>
                <div class="col-sm-4">
                  <input type="hidden" class="form-control required" id="id_menu"  name="id_menu" value="<?=$oldData['id_menu'];?>">
                  <input type="input" class="form-control required" id="nama_menu"  name="nama_menu" value="<?=$oldData['nama_menu'];?>">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-4" >Judul Menu :</label>
                <div class="col-sm-4">
                  <input type="input" class="form-control" id="judul_menu"  name="judul_menu" value="<?=$oldData['judul_menu'];?>">
                </div>
              </div>	

              <div class="form-group">
                <label class="control-label col-sm-4" >Link Menu :</label>
                <div class="col-sm-4">
                  <input type="input" class="form-control" id="link_menu"  name="link_menu" value="<?=$oldData['link_menu'];?>">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-4" >Icon Menu :</label>
                <div class="col-sm-4">
                  <input type="input" class="form-control" id="icon_menu"  name="icon_menu" value="<?=$oldData['icon_menu'];?>">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-4" >Tingkat Menu :</label>
                <div class="col-sm-4">
                  <input type="input" class="form-control required" id="tingkat_menu"  name="tingkat_menu" value="<?=$oldData['tingkat_menu'];?>">
                </div>
              </div>
              
              <div class="form-group">
                <label class="control-label col-sm-4" >Urutan Menu :</label>
                <div class="col-sm-4">
                  <input type="input" class="form-control required" id="urutan_menu"  name="urutan_menu" value="<?=$oldData['urutan_menu'];?>">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-4" >Aktif Menu :</label>
                <div class="col-sm-4">
                  <select class="form-control required" name="aktif_menu">
                    <option <?php if($oldData['aktif_menu'] == '1') echo "selected"; ?> value="1">Ya </option>
                    <option <?php if($oldData['aktif_menu'] == '0') echo "selected"; ?> value="0">Tidak </option>
                  </select>
                </div>
              </div>
              
              <div class="form-group">
                <label class="control-label col-sm-4" >Add Button :</label>
                <div class="col-sm-4">
                  <select class="form-control required" name="add_button">
                    <option <?php if($oldData['add_button'] == '1') echo "selected"; ?> value="1">Ya </option>
                    <option <?php if($oldData['add_button'] == '0') echo "selected"; ?> value="0">Tidak </option>
                  </select>
                </div>
              </div>
              
              <div class="form-group">
                <label class="control-label col-sm-4" >Edit Button :</label>
                <div class="col-sm-4">
                  <select class="form-control required" name="edit_button">
                    <option <?php if($oldData['edit_button'] == '1') echo "selected"; ?> value="1">Ya </option>
                    <option <?php if($oldData['edit_button'] == '0') echo "selected"; ?> value="0">Tidak </option>
                  </select>
                </div>
              </div>
              
              <div class="form-group">
                <label class="control-label col-sm-4" >Delete Button :</label>
                <div class="col-sm-4">
                  <select class="form-control required" name="delete_button">
                    <option <?php if($oldData['delete_button'] == '1') echo "selected"; ?> value="1">Ya </option>
                    <option <?php if($oldData['delete_button'] == '0') echo "selected"; ?> value="0">Tidak </option>
                  </select>
                </div>
              </div>
              
              <div class="form-group">
                <label class="control-label col-sm-4" for="Parent Menu">Parent Menu :</label>
                <div class="col-sm-4">
                  <select class="form-control required" name="id_parent">
                    <option value="0">Jenis Pertama </option>
                    <?php 
                    foreach($data_menu as $kat_user){
                    ?>
                    <option <?php if($oldData['id_parent'] == $kat_user->id_menu ) echo "selected"; ?> value="<?php echo $kat_user->id_menu ?>"><?php echo $kat_user->nama_menu ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </div>	
              
              <div class="form-group">
                <div class="col-sm-offset-4 col-sm-10">
                  <img src="<?php echo base_url();?>assets/img/loading.gif" id="loading" style="display:none">
                  <p id="pesan_error" style="display:none" class="text-warning" style="display:none"></p>
                </div>
              </div>

              <div class="form-group">        
                <div class="col-sm-offset-4 col-sm-10">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                  <a href="<?=base_url()."".$this->uri->segment(1);?>">
                    <span class="btn btn-warning"><i class="glyphicon glyphicon-remove"></i> Batal</span>
                  </a>
                </div>
              </div>
		        </form>
          </div>
          <!-- /.box -->
        </div>
      </div>    
    </section>
    <!-- /.content -->
