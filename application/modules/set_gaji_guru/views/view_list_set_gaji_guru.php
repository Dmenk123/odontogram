    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Setting
        <small>Gaji Guru</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Setting Gaji Guru</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <button class="btn btn-success" onclick="add_data()"><i class="glyphicon glyphicon-plus"></i> Add Data</button>
              <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive"> 
                <table id="tabelSetGaji" class="table table-bordered table-hover" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Nama jabatan</th>
                      <th>Gaji Pokok</th>
                      <th>Gaji Perjam</th>
                      <th>Tunjangan Jabatan</th>
                      <th style="width: 125px;">Action</th>
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
