<?php require_once(APPPATH . 'views/template/temp_img_cetak_header.php'); ?>
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
      padding-top: -15px;
      width: 100%;
      color: #070707;
      border-color: #070707;
      border-top: 2px solid #070707;
    }

    #tbl_content {
      padding-top: 10px;
      margin-left: -20px;
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

    /*tbody td{
      padding: 10px;
    }
    tbody tr:nth-child(even){
      background: #F6F5FA;
    }
    tbody tr:hover{
      background: #EAE9F5
    }*/
    .clear {
      clear: both;
    }

    .kolom-pink {
      background: #f765bd;
    }

    .kolom-biru {
      background: #7570fa;
    }
  </style>
</head>

<body>
  <div class="container">
    <table class="tbl-outer">
      <tr>
        <td align="left" class="outer-left">
          <?php echo $img_laporan; ?>
        </td>
        <td align="right" class="outer-left">
          <p style="text-align: left; font-size: 14px" class="outer-left">
            <strong>SMP. Darul Ulum Surabaya</strong>
          </p>
          <p style="text-align: left; font-size: 12px" class="outer-left">Jl. Raya Manukan Kulon No.98-100 Kota Surabaya, Jawa Timur 60185</p>
        </td>
      </tr>
    </table>

    <h5 style="text-align: center;margin-top:-100px;"><strong>RENCANA ANGGARAN PENDAPATAN DAN BELANJA SEKOLAH (RAPBS)</strong></h5>

    <table class="tbl-header">
      <tr>
        <td align="center" class="head-center">
          <p style="text-align: center; font-size: 14px" class="head-left"><strong>Tahun Anggaran <?php echo $tahun; ?></strong></p>
          <p style="text-align: center; font-size: 14px" class="head-left"><strong>Semester I dan II</strong></p>
        </td>
      </tr>
    </table>
    <table>
      <tr>
        <td>Nama Sekolah </td>
        <td width="700px;">: Smp Darul Ulum Surabaya</td>
      </tr>
      <tr>
        <td>Desa/Kecamatan </td>
        <td width="700px;">: Tandes</td>
      </tr>
      <tr>
        <td>Kabupaten/Kota </td>
        <td width="700px;">: Surabaya</td>
      </tr>
      <tr>
        <td>Provinsi </td>
        <td width="700px;">: Jawa Timur</td>
        <td width="200px;"></td>
      </tr>
    </table>
    <table id="tbl_content" class="table table-bordered table-hover" cellspacing="0" width="100%" border="1">
      <thead>
        <tr>
          <th rowspan="1" style="width: 10px; text-align: center;" height="50">Akun</th>
          <th rowspan="1" style="width: 150px; text-align: center;">Uraian</th>
          <th rowspan="1" style="width: 30px; text-align: center;">Vol</th>
          <th rowspan="1" style="width: 30px; text-align: center;">Satuan</th>
          <th rowspan="1" style="width: 90px; text-align: center;">Harga Satuan</th>
          <th rowspan="1" style="width: 120px; text-align: center;">Jumlah Uang</th>
          <th rowspan="1" style="width: 90px; text-align: center;">Gaji Swasta</th>
          <th rowspan="1" style="width: 90px; text-align: center;">Bosnas</th>
          <th rowspan="1" style="width: 30px; text-align: center;">SSN</th>
          <th rowspan="1" style="width: 30px; text-align: center;">Blok Grand</th>
          <th rowspan="1" style="width: 90px; text-align: center;">Hibah Bopda</th>
          <th rowspan="1" style="width: 30px; text-align: center;">Lain-Lain</th>
          <th rowspan="1" style="width: 120px; text-align: center;">Jumlah Total</th>
          <th rowspan="1" style="width: 90px; text-align: center;">Keterangan Belanja</th>
        </tr>
      </thead>
      <?php
      $tot_jml_uang = 0;
      $tot_bosnas = 0;
      $tot_hibah_bopda = 0;
      $tot_jml_total = 0;
      ?>
      <tbody>
        <?php foreach ($hasil_data as $val) :
          $tot_jml_uang += $val->harga_total;
          $tot_bosnas += $val->bosnas;
          $tot_hibah_bopda += $val->hibah_bopda;
          $tot_jml_total += $val->jumlah_total; ?>
          <tr <?= ($val->is_sub == '1') ? "class = 'tebal'" : ""; ?>>
            <td class="text-center"><?php echo $val->kode; ?></td>
            <td class="text-center"><?php echo $val->uraian; ?></td>
            <td class="text-center"><?php echo $val->qty; ?></td>
            <td class="text-center"><?php echo $val->nama_satuan; ?></td>

            <td>
              <div>
                <span style="float: left;margin-left:5px;">
                  <?= ($val->harga_satuan == '' || $val->harga_satuan == null) ? '' : 'Rp.'; ?>
                </span>
                <span style="float: right;margin-right:5px;">
                  <?= ($val->harga_satuan == '' || $val->harga_satuan == null) ? '' : number_format($val->harga_satuan, 0, ",", "."); ?>
                </span>
                <div class="clear"></div>
              </div>
            </td>

            <td>
              <div>
                <span style="float: left;margin-left:5px;">
                  <?= ($val->harga_total == '' || $val->harga_total == null) ? '' : 'Rp.'; ?>
                </span>
                <span style="float: right;margin-right:5px;">
                  <?= ($val->harga_total == '' || $val->harga_total == null) ? '' : number_format($val->harga_total, 0, ",", "."); ?>
                </span>
                <div class="clear"></div>
              </div>
            </td>

            <td>
              <div>
                <span style="float: left;margin-left:5px;">
                  <?= ($val->gaji_swasta == '' || $val->gaji_swasta == null) ? '' : 'Rp.'; ?>
                </span>
                <span style="float: right;margin-right:5px;">
                  <?= ($val->gaji_swasta == '' || $val->gaji_swasta == null) ? '' : number_format($val->gaji_swasta, 0, ",", "."); ?>
                </span>
                <div class="clear"></div>
              </div>
            </td>

            <td>
              <div>
                <span style="float: left;margin-left:5px;">
                  <?= ($val->bosnas == '' || $val->bosnas == null) ? '' : 'Rp.'; ?>
                </span>
                <span style="float: right;margin-right:5px;">
                  <?= ($val->bosnas == '' || $val->bosnas == null) ? '' : number_format($val->bosnas, 0, ",", "."); ?>
                </span>
                <div class="clear"></div>
              </div>
            </td>

            <td class="text-center"></td>
            <td class="text-center"></td>

            <td>
              <div>
                <span style="float: left;margin-left:5px;">
                  <?= ($val->hibah_bopda == '' || $val->hibah_bopda == null) ? '' : 'Rp.'; ?>
                </span>
                <span style="float: right;margin-right:5px;">
                  <?= ($val->hibah_bopda == '' || $val->hibah_bopda == null) ? '' : number_format($val->hibah_bopda, 0, ",", "."); ?>
                </span>
                <div class="clear"></div>
              </div>
            </td>

            <td class="text-center"></td>

            <td>
              <div>
                <span style="float: left;margin-left:5px;">
                  <?= ($val->jumlah_total == '' || $val->jumlah_total == null) ? '' : 'Rp.'; ?>
                </span>
                <span style="float: right;margin-right:5px;">
                  <?= ($val->jumlah_total == '' || $val->jumlah_total == null) ? '' : number_format($val->jumlah_total, 0, ",", "."); ?>
                </span>
                <div class="clear"></div>
              </div>
            </td>

            <td class="text-center"><?php echo $val->keterangan_belanja; ?></td>
          </tr>
        <?php endforeach ?>

        <tr class="tebal">
          <td></td>
          <td class="tebal text-center">TOTAL</td>
          <td></td>
          <td></td>
          <td></td>
          <td class="tebal">
            <div>
              <span style="float: left;margin-left:5px;">Rp. </span>
              <span style="float: right;margin-right:5px;"><?= number_format($tot_jml_uang, 0, ",", "."); ?></span>
              <div class="clear"></div>
            </div>
          </td>
          <td></td>
          <td class="tebal">
            <div>
              <span style="float: left;margin-left:5px;">Rp. </span>
              <span style="float: right;margin-right:5px;"><?= number_format($tot_bosnas, 0, ",", "."); ?></span>
              <div class="clear"></div>
            </div>
          </td>
          <td></td>
          <td></td>
          <td class="tebal">
            <div>
              <span style="float: left;margin-left:5px;">Rp. </span>
              <span style="float: right;margin-right:5px;"><?= number_format($tot_hibah_bopda, 0, ",", "."); ?></span>
              <div class="clear"></div>
            </div>
          </td>
          <td></td>
          <td class="tebal">
            <div>
              <span style="float: left;margin-left:5px;">Rp. </span>
              <span style="float: right;margin-right:5px;"><?= number_format($tot_jml_total, 0, ",", "."); ?></span>
              <div class="clear"></div>
            </div>
          </td>
          <td></td>
        </tr>
      </tbody>
    </table>
    <table class="tbl-footer">
      <tr>
        <td align="left">
          <p style="text-align: left;" class="foot-left"><strong>Mengetahui</strong> </p>
          <p style="text-align: left;" class="foot-left"><strong>Ketua Komite Sekolah</strong> </p>
        </td>
        <td align="center" style="padding-left:-120px;">
          <p style="text-align: center;" class="foot-center"><strong>Menyetujui</strong> </p>
          <p style="text-align: center;" class="foot-center"><strong>Kepala Sekolah</strong> </p>
        </td>
        <td align="right">
          <p style="text-align: right;" class="foot-left"><strong>Surabaya, <?= date('d') . ' ' . $arr_bulan[date('m')] . ' ' . date('Y'); ?></strong> </p>
          <p style="text-align: right;" class="foot-right"><strong>Bendahara</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        </td>
      </tr>

      <tr>
        <td align="left">
          <p style="text-align: left;margin-top:50px;" class="foot-left">(KHUSNUL KHOTIMAH,S.Pd) </p>
        </td>
        <td align="left" style="padding-left:-120px;">
          <p style="text-align: center;margin-top:50px;" class="foot-center">(KHUSNUL KHOTIMAH,S.Pd) </p>
        </td>
        <td align="right">
          <p style="text-align: right;margin-top:50px;" class="foot-right">(SITI CHOLIFAH)</p>
        </td>
      </tr>
    </table>
  </div>
</body>

</html>