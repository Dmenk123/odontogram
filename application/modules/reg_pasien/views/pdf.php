<html>

<head>
  <title><?php echo $title; ?></title>
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
      border-collapse: collapse;
      font-family: arial;
      color: black;
      font-size: 12px;
    }

    thead th {
      text-align: center;
      font-style: bold;
    }

    .clear {
      clear: both;
    }

    footer { position: fixed; bottom: -60px; left: 0px; right: 0px; height: 80px;}

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
          <p style="text-align: center; font-size: 16px; padding-top:10px;" class="head-left"><strong> <?= $periode; ?> </strong></p>
        </td>
      </tr>
    </table>
    
    <table id="tbl_content" class="table table-bordered table-hover" cellspacing="0" width="100%" border="1">
      <thead>
        <tr>
          <th style="text-align: center;">No Reg</th>
          <th style="text-align: center;">Tgl Reg</th>
          <th style="text-align: center;">Jam reg</th>
          <th style="text-align: center;">Tgl Pulang</th>
          <th style="text-align: center;">Dokter</th>
          <th style="text-align: center;">Penjamin</th>
          <th style="text-align: center;">Asuransi</th>
          <th style="text-align: center;">No Asuransi</th>
          <th style="text-align: center;">Nama Pasien</th>
          <th style="width: 5%; text-align: center;">No RM</th>
          <th style="text-align: center;">NIK</th>
          <th style="text-align: center;">TTL</th>
          <th style="width: 5%; text-align: center;">Umur</th>
          <th style="text-align: center;">Pemetaan</th>
          <th style="text-align: center;">Jns Kelamin</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($data as $key => $val) : ?>
          <?php $nomor = $key += 1; ?>
          <tr>
            <td class="text-center"><?= $val->no_reg; ?></td>
            <td class="text-center"><?= DateTime::createFromFormat('Y-m-d', $val->tanggal_reg)->format('d/m/Y'); ?></td>
            <td class="text-center"><?= $val->jam_reg; ?></td>
            <td class="text-center"><?php echo ($val->tanggal_pulang) ? DateTime::createFromFormat('Y-m-d', $val->tanggal_pulang)->format('d/m/Y') : '-'; ?></td>
            <td class="text-center"><?= $val->nama_dokter; ?></td>
            <td class="text-center"><?php echo ($val->is_asuransi == '1') ? 'Asuransi' : 'Umum'; ?></td>
            <td class="text-center"><?php echo ($val->nama_asuransi) ? $val->nama_asuransi : '-'; ?></td>
            <td class="text-center"><?php echo ($val->no_asuransi) ? $val->no_asuransi : '-'; ?></td>
            <td class="text-center"><?= $val->nama_pasien; ?></td>
            <td class="text-center"><?= $val->no_rm; ?></td>
            <td class="text-center"><?= $val->nik; ?></td>
            <td class="text-center"><?= $val->tempat_lahir.' / '.DateTime::createFromFormat('Y-m-d', $val->tanggal_lahir)->format('d-m-Y'); ?></td>
            <td class="text-center"><?= $val->umur; ?></td>
            <td class="text-center"><?= $val->keterangan; ?></td>
            <td class="text-center"><?= $val->jenkel; ?></td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</body>

</html>