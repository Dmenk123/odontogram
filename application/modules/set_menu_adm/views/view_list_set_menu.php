    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Daftar Menu
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Setting</a></li>
        <li class="active">Setting Menu</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <?php if ($this->session->userdata('id_level_user') == '1') { ?>
                <button class="btn btn-success" onclick="add_menu()"><i class="glyphicon glyphicon-plus"></i> Add Menu</button>
              <?php } ?>
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
                <table id="tabelMenu" class="table table-bordered table-hover" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>ID Menu</th>
                      <th>ID Parent</th>
                      <th>Nama Menu</th>
                      <th>Link</th>
                      <th>Aktif</th>
                      <th style="width: 100px;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
               </div>
               <!-- responsive --> 
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>    
    </section>
    <!-- /.content -->
