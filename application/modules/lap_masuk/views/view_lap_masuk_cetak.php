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

    <h4 style="text-align: center;margin-top:-100px;"><strong>Laporan Penerimaan Sekolah</strong></h4>

    <table class="tbl-header">
      <tr>
        <td align="center" class="head-center">
          <p style="text-align: center; font-size: 14px" class="head-left"><strong> <?php echo $periode; ?></strong></p>
        </td>
      </tr>
    </table>
    <table id="tbl_content" class="table table-bordered table-hover" cellspacing="0" width="100%" border="1">
      <thead>
        <tr>
          <th style="width: 30px; text-align: center;">No</th>
          <th style="width: 50px; text-align: center;">Kode</th>
          <th style="width: 70px; text-align: center;">User</th>
          <th style="width: 70px; text-align: center;">Tanggal</th>
          <th style="width: 200px;text-align: center;">Keterangan</th>
          <th style="width: 30px; text-align: center;">Qty</th>
          <th style="width: 50px; text-align: center;">Satuan</th>
          <th style="width: 90px; text-align: center;">Harga Satuan</th>
          <th style="width: 90px; text-align: center;">Harga Total</th>
        </tr>
      </thead>

      <tbody>
        <?php
        $total_out = 0;

        foreach ($hasil_data as $val) : ?>
          <?php $total_out += $val['harga_total']; ?>
          <tr>
            <td class="text-center"><?= $val['no']; ?></td>
            <td class="text-center"><?= $val['id_out']; ?></td>
            <td class="text-center"><?= $val['namauser']; ?></td>
            <td class="text-center"><?= date('d-m-Y', strtotime($val['tanggal'])); ?></td>
            <td class="text-center"><?= $val['keterangan']; ?></td>
            <td class="text-center"><?= $val['qty']; ?></td>
            <td class="text-center"><?= $val['nama_satuan']; ?></td>
            <td class="text-center">
              <div>
                <span style="float: left;margin-left:5px;">Rp. </span>
                <span style="float: right;margin-right:5px;"><?= number_format($val['harga_satuan'], 0, ",", "."); ?></span>
                <div class="clear"></div>
              </div>
            </td>
            <td class="text-center">
              <div>
                <span style="float: left;margin-left:5px;">Rp. </span>
                <span style="float: right;margin-right:5px;"><?= number_format($val['harga_total'], 0, ",", "."); ?></span>
                <div class="clear"></div>
              </div>
            </td>
          </tr>
        <?php endforeach ?>

        <tr class="tebal kolom-pink">
          <td colspan="8" class="text-center">Total Penerimaan</td>
          <td>
            <div>
                <span style="float: left;margin-left:5px;">Rp. </span>
                <span style="float: right;margin-right:5px;"><?= number_format($total_out, 0, ",", "."); ?></span>
                <div class="clear"></div>
              </div>
          </td>
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