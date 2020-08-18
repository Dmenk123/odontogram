    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User
        <small>Setting</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Profil</a></li>
        <li class="active">User Setting</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <?=$this->session->flashdata('pesan')?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
             <table id="tabelDetailPengguna" class="table table-bordered" cellspacing="0" width="100%">
                <tbody>
                    <?php foreach ($data_user as $val ) : ?>
                    <tr> 
                      <td style="width: 30%; text-align: center;"><strong>Nama Lengkap</strong></td>  
                      <td style="width: 40%;"><?php echo $val->nama_lengkap_user; ?></td>
                      <td rowspan="5" align="center"><img src="<?php echo config_item('assets'); ?>img/user_img/<?php echo $val->gambar_user; ?>" class="user-image thumbImg" alt="User Image"></td>
                    <tr>
                      <td style="width: 30%; text-align: center;"><strong>Alamat</strong></td>  
                      <td style="width: 40%;"><?php echo $val->alamat_user; ?></td>
                    </tr>
                    <tr>
                      <td style="width: 30%; text-align: center;"><strong>Tanggal Lahir</strong></td>  
                      <td style="width: 40%;"><?php echo $val->tanggal_lahir_user; ?></td>
                    </tr>
                    <tr> 
                      <td style="width: 30%; text-align: center;"><strong>Jenis Kelamin</strong></td> 
                      <td style="width: 40%;"><?php echo $val->jenis_kelamin_user; ?></td>
                    </tr>
                    <tr>
                      <td style="width: 30%; text-align: center;"><strong>Contact Person</strong></td>  
                      <td style="width: 40%;"><?php echo $val->no_telp_user; ?></td>
                    </tr> 
                    <?php endforeach ?>
                </tbody>
              </table>
              <div style="padding-top: 30px;">
                <?php $id = $this->uri->segment(3); ?>
                <?php $link_print = site_url('profil/form_detail_pengguna/').$id; ?>
                <?php echo '<a class="btn btn-sm btn-success" href="'.$link_print.'" title="Setting Profil" id="btn_print_order_detail"><i class="glyphicon glyphicon-edit"></i> Setting Profil</a>';?>
                <a class="btn btn-sm btn-danger" title="Kembali" href="<?php echo site_url('home') ?>"><i class="glyphicon glyphicon-menu-left"></i> Kembali</a>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>    
    </section>
    <!-- /.content -->                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    