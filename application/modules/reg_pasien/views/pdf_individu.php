<html>

<head>
  <title><?php echo $title; ?></title>
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
      <div class="modal-header col-md-12"><h4 class="modal-title">Data Registrasi</h4></div>
      <div class="col-md-12">
        <table class="table table-borderless">
          <tbody>
            <tr>
              <th style="width: 150px;">No. Registrasi</th>
              <td style="width: 10px;"> : </td>
              <td><span><?= $data->no_reg; ?></span></td>
            </tr>
            <tr> 
              <th>Tanggal Reg</th>
              <td> : </td>
              <td><span><?= DateTime::createFromFormat('Y-m-d', $data->tanggal_reg)->format('d/m/Y'); ?></span></td>
            </tr>
            <tr>
              <th>Jam Reg</th>
              <td> : </td>
              <td><span><?= $data->jam_reg; ?></span></td>
            </tr>
            <tr> 
              <th>Tanggal Pulang</th>
              <td> : </td>
              <td><span><?php echo ($data->tanggal_pulang) ? DateTime::createFromFormat('Y-m-d', $data->tanggal_pulang)->format('d/m/Y') : '-'; ?></span></td>
            </tr>
            <tr>
              <th>Dokter</th>
              <td> : </td>
              <td><span><?= $data->nama_dokter; ?></span></td>
            </tr>
            <tr>
              <th>Jenis Penjamin</th>
              <td> : </td>
              <td><span><?php echo ($data->is_asuransi == '1') ? 'Asuransi' : 'Umum'; ?></span></td>
            </tr>
            <tr>
              <th>Nama Asuransi</th>
              <td> : </td>
              <td><span><?php echo ($data->nama_asuransi) ? $data->nama_asuransi : '-'; ?></span></td>
            </tr>
            <tr>
              <th>No Asuransi</th>
              <td> : </td>
              <td><span><?php echo ($data->no_asuransi) ? $data->no_asuransi : '-'; ?></span></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-header col-md-12"><h4 class="modal-title">Data Pasien</h4></div>
      <div class="col-md-12">
        <table class="table table-responsive table-borderless">
          <tbody>
            <tr>
              <th style="width: 150px;">Nama Pasien</th>
              <td style="width: 10px;"> : </td>
              <td><span><?= $data->nama_pasien; ?></span></td>
            </tr>
            <tr>
              <th>No RM</th>
              <td> : </td>
              <td><span><?= $data->no_rm; ?></span></td>
            </tr>
            <tr>
              <th>NIK</th>
              <td> : </td>
              <td><span><?= $data->nik; ?></span></td>
            </tr>
            <tr> 
              <th>Tempat/Tanggal Reg</th>
              <td> : </td>
              <td><span><?= $data->tempat_lahir.' / '.DateTime::createFromFormat('Y-m-d', $data->tanggal_lahir)->format('d-m-Y'); ?></span></td>
            </tr>
            <tr>
              <th>Umur</th>
              <td> : </td>
              <td><span><?= $data->umur.' Tahun'; ?></span></td>
            </tr>
            <tr>
              <th>Pemetaaan</th>
              <td> : </td>
              <td><span><?= $data->keterangan; ?></span></td>
            </tr>
            <tr>
              <th>Jenis Kelamin</th>
              <td> : </td>
              <td><span><?= $data->jenkel; ?></span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>