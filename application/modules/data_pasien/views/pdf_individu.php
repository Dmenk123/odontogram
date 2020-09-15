<html>

<head>
  <title><?php echo $title; ?></title>
  <!--begin::Global Theme Styles(used by all pages) -->
   <!-- <link href="<?= base_url('assets/template/'); ?>assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" /> -->
  <!--<link href="<?= base_url('assets/template/'); ?>assets/css/style.bundle.css" rel="stylesheet" type="text/css" /> -->
  <!-- Latest compiled and minified CSS -->
  <style type="text/css">
    #outtable {
      padding: 10px;
      border: 1px solid #e3e3e3;
      width: 600px;
      border-radius: 5px;
    }

    .short {
      width: 50px;
    }

    .normal {
      width: 150px;
    }

    .tbl-outer {
      color: #070707;
    }

    .text-center {
      text-align: center;
    }

    .text-left {
      text-align: left;
    }

    .text-right {
      text-align: right;
    }

    .tebal {
      font-weight: bold;
    }

    .outer-left {
      border: 0px solid white;
      border-color: white;
      margin: 0px;
      background: white;
    }

    .head-left {
      padding-bottom: 0px;
      border: 0px solid white;
      border-color: white;
      margin: 0px;
      background: white;
    }

    .tbl-footer {
      width: 100%;
      color: #070707;
      border-top: 0px solid white;
      border-color: white;
      padding-top: 15px;
    }

    .head-right {
      padding-bottom: 0px;
      border: 0px solid white;
      border-color: white;
      margin: 0px;
    }

    .tbl-header {
      padding-top: 1px;
      width: 100%;
      color: #070707;
      border-color: #070707;
      border-top: 2px solid #070707;
    }

    #tbl_content {
      padding-top: 10px;
      margin-left: -15px;
    }

    .tbl-footer td {
      border-top: 0px;
      padding: 0px;
    }

    .tbl-footer tr {
      background: white;
    }

    .foot-center {
      padding-left: 70px;
    }

    .inner-head-left {
      padding-top: 20px;
      border: 0px solid white;
      border-color: white;
      margin: 0px;
      background: white;
    }

    .tbl-content-footer {
      width: 100%;
      color: #070707;
      padding-top: 0px;
    }

    table {
      /* border-collapse: separate; */
      font-family: arial;
      color: black;
      font-size: 12px;
      border-spacing: 10px;
    }

    thead th {
      text-align: center;
      font-style: bold;
    }

    tbody th {
      text-align: left;
      font-style: bold;
    }

    .clear {
      clear: both;
    }

    table.table-borderless tbody {
      padding-top: 10px;
      text-align: left;
      font-size: 14px;
    }
    
    
  </style>
</head>

<body>
  <div class="container">
    <table class="tbl-outer">
      <tr>
        
        <td align="left" class="outer-left">
          <img src="<?=base_url('files/img/app_img/').$data_klinik->gambar;?>" height="75" width="75">
        </td>

        <td align="right" class="outer-left" style="padding-top: 30px; padding-left:10px;">
          <p style="text-align: left; font-size: 14px" class="outer-left">
            <strong><?= $data_klinik->nama_klinik; ?></strong>
          </p>
          <p style="text-align: left; font-size: 12px" class="outer-left"><?= $data_klinik->alamat.' '.$data_klinik->kelurahan.' '.$data_klinik->kecamatan; ?></p>
          <p style="text-align: left; font-size: 12px" class="outer-left"><?= $data_klinik->kota.', '.$data_klinik->provinsi.' '.$data_klinik->kode_pos; ?></p>
        </td>

      </tr>
    </table>

    <table class="tbl-header">
      <tr>
        <td align="center" class="head-center">
          <p style="text-align: center; font-size: 16px; padding-top:10px;" class="head-left"><strong> <?= $title; ?> </strong></p>
        </td>
      </tr>
    </table>
    <div class="row">
      <div class="modal-header col-md-12"><h4 class="modal-title">Data Pasien</h4></div>
      <div class="col-md-6">
        <table class="table table-borderless">
          <tbody>
            <tr>
              <th style="width: 150px;">No. RM</th>
              <td style="width: 10px;"> : </td>
              <td><span><?= $data->no_rm; ?></span></td>
            </tr>
            <tr>
              <th>NIK</th>
              <td> : </td>
              <td><span><?= $data->nik; ?></span></td>
            </tr>
            <tr>
              <th>Nama Pasien</th>
              <td> : </td>
              <td><span><?= $data->nama; ?></span></td>
            </tr>
            <tr> 
              <th>Tempat / Tanggal Lahir</th>
              <td> : </td>
              <td><span><?= $data->tempat_lahir.' / '.DateTime::createFromFormat('Y-m-d', $data->tanggal_lahir)->format('d-m-Y'); ?></span></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-md-6">
        <table class="table table-responsive table-borderless">
          <tbody>
            <tr>
              <th style="width: 150px;">Suku Bangsa</th>
              <td style="width: 10px;"> : </td>
              <td><span><?= $data->suku; ?></span></td>
            </tr>
            <tr> 
              <th>Jenis Kelamin</th>
              <td> : </td>
              <td><span><?= $data->jenkel; ?></span></td>
            </tr>
            <tr>
              <th>Pekerjaan</th>
              <td> : </td>
              <td><span><?= $data->pekerjaan; ?></span></td>
            </tr>
            <tr>
              <th>No. HP/WA</th>
              <td> : </td>
              <td><span><?= $data->hp; ?></span></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-md-12">
        <table class="table table-responsive table-borderless">
          <tbody>
            <tr>
              <th style="width: 150px;">Alamat Rumah</th>
              <td style="width: 10px;"> : </td>
              <td><span><?= $data->alamat_rumah; ?></span></td>
            </tr>
            <tr> 
              <th>Alamat Kantor</th>
              <td> : </td>
              <td><span><?= $data->alamat_kantor; ?></span></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-header col-md-12"><h4 class="modal-title">Data Medik</h4></div>
      <div class="col-md-6">
        <table class="table table-responsive table-borderless">
          <tbody>
            <tr>
              <th style="width: 150px;">Golongan Darah</th>
              <td style="width: 10px;"> : </td>
              <td><span><?= $data->gol_darah; ?></span></td>
            </tr>
            <tr>
              <th>Tekanan Darah</th>
              <td> : </td>
              <td><span><?= $data->tekanan_darah.' ('.$data->tekanan_darah_val.')'; ?></span></td>
            </tr>
            <tr>
              <th>Penyakit Jantung</th>
              <td> : </td>
              <td><span><?= ($data->penyakit_jantung == '1') ? 'Ya' : 'Tidak'; ?></span></td>
            </tr>
            <tr> 
              <th>Diabetes</th>
              <td> : </td>
              <td><span><?= ($data->diabetes == '1') ? 'Ya' : 'Tidak'; ?></span></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-md-6">
        <table class="table table-responsive table-borderless">
          <tbody>
            <tr>
              <th style="width: 150px;">Hepatitis</th>
              <td style="width: 10px;"> : </td>
              <td><span><?= ($data->hepatitis == '1') ? 'Ya' : 'Tidak'; ?></span></td>
            </tr>
            <tr> 
              <th>Haemopilia</th>
              <td> : </td>
              <td><span><?= ($data->haemopilia == '1') ? 'Ya' : 'Tidak'; ?></span></td>
            </tr>
            <tr>
              <th>Gastring</th>
              <td> : </td>
              <td><span><?= ($data->gastring == '1') ? 'Ya' : 'Tidak'; ?></span></td>
            </tr>
            <tr>
              <th>Penyakit Lainnya</th>
              <td> : </td>
              <td><span><?= ($data->penyakit_lainnya == '1') ? 'Ya' : 'Tidak'; ?></span></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-md-12">
        <table class="table table-responsive table-borderless">
          <tbody>
            <tr>
              <th style="width: 150px;">Alergi Obat-Obatan</th>
              <td style="width: 10px;"> : </td>
              <td><span><?= ($data->alergi_obat == '1') ? 'Ya'.', '.$data->alergi_obat_val : 'Tidak'; ?></span></td>
            </tr>
            <tr> 
              <th>Alergi Makanan</th>
              <td> : </td>
              <td><span><?= ($data->alergi_makanan == '1') ? 'Ya'.', '.$data->alergi_makanan_val : 'Tidak'; ?></span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>