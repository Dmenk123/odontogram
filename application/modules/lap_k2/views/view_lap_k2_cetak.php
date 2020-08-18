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
      margin-left: -1px;
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

    <h5 style="text-align: center;margin-top:-100px;"><strong>RENCANA KEGIATAN DAN ANGGARAN SEKOLAH (RKAS)</strong></h5>

    <table class="tbl-header">
      <tr>
        <td align="center" class="head-center">
          <p style="text-align: center; font-size: 14px" class="head-left"><strong>Tahun Ajaran <?php echo $tahun; ?></strong></p>
        </td>
      </tr>
    </table>
    <table>
      <tr>
        <td>Nama Sekolah </td>
        <td width="700px;">: Smp Darul Ulum Surabaya</td>
        <td width="200px;" style="text-align: center;border: 1px solid black;">Formulir BOS K-2</td>
      </tr>
      <tr>
        <td>Desa/Kecamatan </td>
        <td width="700px;">: Tandes</td>
        <td width="200px;" style="text-align: center;border: 1px solid black;">Diisi Oleh Sekolah</td>
      </tr>
      <tr>
        <td>Kabupaten/Kota </td>
        <td width="700px;">: Surabaya</td>
        <td width="200px;" style="text-align: center;border: 1px solid black;">Dikirim ke Tim Manajemen BOS Kab/Kota</td>
      </tr>
      <tr>
        <td>Provinsi </td>
        <td width="700px;">: Jawa Timur</td>
        <td width="200px;"></td>
      </tr>
      <tr>
        <td>Triwulan </td>
        <td width="700px;">: I s/d IV</td>
        <td width="200px;"></td>
      </tr>
      <tr>
        <td>Sumber Dana </td>
        <td width="700px;">: BOS</td>
        <td width="200px;"></td>
      </tr>
    </table>
    <table id="tbl_content" class="table table-bordered table-hover" cellspacing="0" width="100%" border="1">
      <thead>
        <tr>
          <th rowspan="2" style="width: 30px; text-align: center;">No urut</th>
          <th rowspan="2" style="width: 50px; text-align: center;">No Kode</th>
          <th rowspan="2" style="width: 350px; text-align: center;">Uraian</th>
          <th rowspan="2" style="width: 100px; text-align: center;">Jumlah</th>
          <th colspan="4" style="text-align: center;">Triwulan</th>
        </tr>
        <tr>
          <th style="text-align: center;">I</th>
          <th style="text-align: center;">II</th>
          <th style="text-align: center;">III</th>
          <th style="text-align: center;">IV</th>
        </tr>
      </thead>

      <tbody>
        <?php
        $total_tri1 = 0;
        $total_tri2 = 0;
        $total_tri3 = 0;
        $total_tri4 = 0;

        foreach ($hasil_data['penerimaan'] as $val) : ?>
          <tr>
            <td class="text-center"><?= $val['no']; ?></td>
            <td class="text-center"><?= $val['kode']; ?></td>
            <td><?= $val['uraian']; ?></td>
            <td class="text-center"></td>
            <td class="text-center"></td>
            <td class="text-center"></td>
            <td class="text-center"></td>
            <td class="text-center"></td>
          </tr>
        <?php endforeach ?>

        <?php
        for ($i = 0; $i < count($hasil_data['triwulan1']); $i++) {
          $total_tri1 += $hasil_data['triwulan1'][$i]['jumlah_raw'];
          $total_tri2 += $hasil_data['triwulan2'][$i]['jumlah_raw'];
          $total_tri3 += $hasil_data['triwulan3'][$i]['jumlah_raw'];
          $total_tri4 += $hasil_data['triwulan4'][$i]['jumlah_raw'];
          ?>
          <tr>
            <td class="text-center"><?= $hasil_data['triwulan1'][$i]['no']; ?></td>
            <td class="text-center"><?= $hasil_data['triwulan1'][$i]['kode']; ?></td>
            <td><?= $hasil_data['triwulan1'][$i]['uraian']; ?></td>
            <td class="text-center"></td>
            <td>
              <div>
                <span style="float: left;margin-left:5px;">Rp. </span>
                <span style="float: right;margin-right:5px;"><?= $hasil_data['triwulan1'][$i]['jumlah']; ?></span>
                <div class="clear"></div>
              </div>
            </td>
            <td>
              <div>
                <span style="float: left;margin-left:5px;">Rp. </span>
                <span style="float: right;margin-right:5px;"><?= $hasil_data['triwulan2'][$i]['jumlah']; ?></span>
                <div class="clear"></div>
              </div>
            </td>
            <td>
              <div>
                <span style="float: left;margin-left:5px;">Rp. </span>
                <span style="float: right;margin-right:5px;"><?= $hasil_data['triwulan3'][$i]['jumlah']; ?></span>
                <div class="clear"></div>
              </div>
            </td>
            <td>
              <div>
                <span style="float: left;margin-left:5px;">Rp. </span>
                <span style="float: right;margin-right:5px;"><?= $hasil_data['triwulan4'][$i]['jumlah']; ?></span>
                <div class="clear"></div>
              </div>
            </td>
          </tr>
        <?php } ?>

        <tr class="kolom-pink">
          <td></td>
          <td></td>
          <td class="tebal">JUMLAH</td>
          <td class="tebal">
            <div>
              <span style="float: left;margin-left:5px;">Rp. </span>
              <span style="float: right;margin-right:5px;"><?= number_format($hasil_data['penerimaan'][0]['jumlah_raw'], 0, ",", "."); ?></span>
              <div class="clear"></div>
            </div>
          </td>
          <td class="tebal">
            <div>
              <span style="float: left;margin-left:5px;">Rp. </span>
              <span style="float: right;margin-right:5px;"><?= number_format($total_tri1, 0, ",", "."); ?></span>
              <div class="clear"></div>
            </div>
          </td>
          <td class="tebal">
            <div>
              <span style="float: left;margin-left:5px;">Rp. </span>
              <span style="float: right;margin-right:5px;"><?= number_format($total_tri2, 0, ",", "."); ?></span>
              <div class="clear"></div>
            </div>
          </td>
          <td class="tebal">
            <div>
              <span style="float: left;margin-left:5px;">Rp. </span>
              <span style="float: right;margin-right:5px;"><?= number_format($total_tri3, 0, ",", "."); ?></span>
              <div class="clear"></div>
            </div>
          </td>
          <td class="tebal">
            <div>
              <span style="float: left;margin-left:5px;">Rp. </span>
              <span style="float: right;margin-right:5px;"><?= number_format($total_tri4, 0, ",", "."); ?></span>
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