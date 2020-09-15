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
  <footer>
    <table class="table table-bordered table-hover" cellspacing="0" width="50%" border="1" style="margin: 0 auto;">
      <thead>
        <tr>
          <th style="text-align: center;" colspan="7">KETERANGAN</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="text-align: center;" class="tebal">PJT</td>
          <td style="text-align: center;" class="tebal">DBS</td>
          <td style="text-align: center;" class="tebal">HML</td>
          <td style="text-align: center;" class="tebal">GSG</td>
          <td style="text-align: center;" class="tebal">PLN</td>
          <td style="text-align: center;" class="tebal">ALO</td>
          <td style="text-align: center;" class="tebal">ALM</td>
        </tr>
        <tr>
          <td style="text-align: center;">Penyakit Jantung</td>
          <td style="text-align: center;">Diabetes</td>
          <td style="text-align: center;">Haemopilia</td>
          <td style="text-align: center;">Gastring</td>
          <td style="text-align: center;">Penyakit Lainnya</td>
          <td style="text-align: center;">Alergi Obat</td>
          <td style="text-align: center;">Alergi Makanan</td>
        </tr>
      </tbody>
    </table>
  </footer>
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
    
    <table id="tbl_content" class="table table-bordered table-hover" cellspacing="0" width="100%" border="1">
      <thead>
        <tr>
          <th style="width: 10%; text-align: center;">No RM</th>
          <th style="width: 20%; text-align: center;">Nama</th>
          <th style="width: 20%; text-align: center;">TTL</th>
          <th style="width: 10%;text-align: center;">NIK</th>
          <th style="width: 3%; text-align: center;">JK</th>
          <th style="width: 15%; text-align: center;">Pekerjaan</th>
          <th style="width: 15%; text-align: center;">Alamat</th>
          <th style="width: 10%; text-align: center;">HP/WA</th>
          <th style="width: 5%; text-align: center;">Gol Darah</th>
          <th style="width: 10%; text-align: center;">Tkn Darah</th>
          <th style="width: 3%; text-align: center;">PJT</th>
          <th style="width: 3%; text-align: center;">DBS</th>
          <th style="width: 3%; text-align: center;">HML</th>
          <th style="width: 3%; text-align: center;">GSG</th>
          <th style="width: 3%; text-align: center;">PLN</th>
          <th style="width: 3%; text-align: center;">ALO</th>
          <th style="width: 3%; text-align: center;">ALM</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($data as $key => $val) : ?>
          <?php $nomor = $key += 1; ?>
          <tr>
            <td class="text-center"><?= $val->no_rm; ?></td>
            <td class="text-center"><?= $val->nama; ?></td>
            <td class="text-center"><?= $val->tempat_lahir.'/'.DateTime::createFromFormat('Y-m-d', $val->tanggal_lahir)->format('d-m-Y'); ?></td>
            <td class="text-center"><?= $val->nik; ?></td>
            <td class="text-center"><?= $val->jenis_kelamin; ?></td>
            <td class="text-center"><?= $val->pekerjaan; ?></td>
            <td class="text-center"><?= $val->alamat_rumah; ?></td>
            <td class="text-center"><?= $val->hp; ?></td>
            <td class="text-center"><?= $val->gol_darah; ?></td>
            <td class="text-center"><?= $val->tekanan_darah.' ('.$val->tekanan_darah_val.')'; ?></td>
            <td class="text-center"><?= ($val->penyakit_jantung == '1') ? 'Ya' : '-' ; ?></td>
            <td class="text-center"><?= ($val->diabetes == '1') ? 'Ya' : '-' ; ?></td>
            <td class="text-center"><?= ($val->haemopilia == '1') ? 'Ya' : '-' ; ?></td>
            <td class="text-center"><?= ($val->gastring == '1') ? 'Ya' : '-' ; ?></td>
            <td class="text-center"><?= ($val->penyakit_lainnya == '1') ? 'Ya' : '-' ; ?></td>
            <td class="text-center"><?= ($val->alergi_obat == '1') ? 'Ya' : '-' ; ?></td>
            <td class="text-center"><?= ($val->alergi_makanan == '1') ? 'Ya' : '-' ; ?></td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</body>

</html>