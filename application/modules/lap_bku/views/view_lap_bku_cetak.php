<?php require_once(APPPATH.'views/template/temp_img_cetak_header.php'); ?>
<html><head>
  <title><?php echo $title; ?></title>
  <style type="text/css">
    #outtable{
      padding: 20px;
      border:1px solid #e3e3e3;
      width:600px;
      border-radius: 5px;
    }
    .short{
      width: 50px;
    }
    .normal{
      width: 150px;
    }
    .tbl-outer{
      color:#070707;
      margin-bottom: 10px;
    }

    .text-center{
      text-align:center;
    }

    .text-left{
      text-align:left;
    }

    .text-right{
      text-align:right;
    }
    
    .outer-left{
      padding: 2px;
      border: 0px solid white;
      border-color: white;
      margin: 0px;
      background: white;
    }
    .head-left{
      padding-top: 5px;
      padding-bottom: 0px;
      border: 0px solid white;
      border-color: white;
      margin: 0px;
      background: white;
    }
    .tbl-footer{
      width: 100%;
      color:#070707;
      border-top: 0px solid white;
      border-color: white;
      padding-top: 75px;
    }
    .head-right{
       padding-bottom: 0px;
       border: 0px solid white;
       border-color: white;
       margin: 0px;
    }
    .tbl-header{
      width: 100%;
      color:#070707;
      border-color: #070707;
      border-top: 2px solid #070707;
    }
    #tbl_content{
      padding-top: 10px;
      margin-left: -20px;
    } 
    .tbl-footer td{
      border-top: 0px;
      padding: 10px;
    }
    .tbl-footer tr{
      background: white;
    }
    .foot-center{
      padding-left: 70px;
    }
    .inner-head-left{
       padding-top: 20px;
       border: 0px solid white;
       border-color: white;
       margin: 0px;
       background: white;
    }
    .tbl-content-footer{
      width: 100%;
      color:#070707;
      padding-top: 0px;
    }
    table{
      border-collapse: collapse;
      font-family: arial;
      color:black;
      font-size: 12px;
    }
    thead th{
      text-align: center;
      padding: 10px;
      font-style: bold;
    }
    tbody td{
      padding: 10px;
    }
    tbody tr:nth-child(even){
      background: #F6F5FA;
    }
    tbody tr:hover{
      background: #EAE9F5
    }
    .clear{
        clear:both;
    }
  </style>
</head><body>
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
    <h2 style="text-align: center;"><strong>Laporan Buku Kas Umum</strong></h2>
    
    <table class="tbl-header">
      <tr>
        <td align="center" class="head-center">
          <p style="text-align: center; font-size: 14px" class="head-left"><strong>Periode <?php echo $periode; ?></strong></p>
        </td>
      </tr> 
    </table>
    
    <table id="tbl_content" class="table table-bordered table-hover" cellspacing="0" width="100%" border="1">
      <thead>
        <tr>
          <th style="width: 60px; text-align: center;">Tanggal</th>
          <th style="width: 30px; text-align: center;">No. Kode</th>
          <th style="width: 50px; text-align: center;">No. Bukti</th>
          <th style="width: 150px; text-align: center;">Uraian</th>
          <th style="width: 95px; text-align: center;">Penerimaan</th>
          <th style="width: 95px; text-align: center;">Pengeluaran</th>
          <th style="width: 95px; text-align: center;">Saldo</th>
        </tr>
      </thead>
      <tbody>
      <?php $tanggaltxt = "";?>
      <?php $saldoTot = "";?>
      <?php foreach ($hasil_data as $val ) : ?>
        <tr>
          <td class="text-center"><?php echo $val['tanggal']; ?></td> 
          <td class="text-center"><?php echo $val['kode'] ?></td>
          <td class="text-center"><?php echo $val['bukti'] ?></td>
          <td><?php echo $val['keterangan']; ?></td>
          <td>
            <div>
              <span style="float: left;">Rp. </span>
              <span style="float: right;"><?= $val['penerimaan'];?></span>
              <div class="clear"></div>
            </div>
          </td>
          <td>
            <div>
              <span style="float: left;">Rp. </span>
              <span style="float: right;"><?= $val['pengeluaran'];?></span>
              <div class="clear"></div>
            </div>
          </td>  
          <td>
            <div>
              <span style="float: left;">Rp. </span>
              <span style="float: right;"><?= number_format($val['saldo_akhir'],2,",",".");?></span>
              <div class="clear"></div>
            </div>
          </td>      
        </tr>
        <?php $tanggaltxt = $val['tanggal'];?>
        <?php $saldoTot = $val['saldo_akhir'];?>
      <?php endforeach ?>
        <tr>
          <td class="text-center" colspan="6"><strong>Saldo Akhir Bulan <?php echo $arr_bulan[(int)date('m', strtotime($tanggaltxt))]; ?></strong></td> 
          <td>
            <div>
              <span style="float: left;"><strong>Rp. </strong></span>
              <span style="float: right;"><strong><?= number_format($saldoTot,2,",",".");?></strong></span>
              <div class="clear"></div>
            </div>
          </td>      
        </tr>
      </tbody>
    </table>
    <!-- <table class="tbl-content-footer">
      <tr class="content-footer-left"> 
        <td align="left" class="content-footer-left" colspan="5">
          <p style="text-align: left; font-size: 12px" class="content-footer-left">Pada hari ini, <?= $arr_hari[date('w', strtotime(date('Y-m-d')))]; ?> Tanggal <?= date('d'); ?> Bulan <?= date('m'); ?> Tahun <?= date('Y'); ?>, Buku Kas Umum ditutup dengan keadaan sebagai berikut : </p>
          <p style="text-align: left; font-size: 12px" class="content-footer-left">Saldo Buku Kas Umum bulan <?=$arr_bulan[date('m')]?>   2015 Rp. 24.749.800,-   terdiri dari :</p>
        </td>
      </tr>  
    </table> -->
    <table class="tbl-footer">
      <tr>
        <td align="left">
          <p style="text-align: left;" class="foot-left"><strong>Mengetahui</strong> </p>
          <p style="text-align: left;" class="foot-left"><strong>Kepala Sekolah</strong> </p>
        </td>
        <td align="right">
          <p style="text-align: right;" class="foot-left"><strong>Surabaya, <?= date('d').' '.$arr_bulan[date('m')].' '.date('Y');?></strong> </p>
          <p style="text-align: right;" class="foot-right"><strong>Bendahara</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        </td>
      </tr>
      <tr>
        <td align="left">
          <p style="text-align: left;" class="foot-left">(KHUSNUL KHOTIMAH,S.Pd) </p>
        </td>

        <td align="right">
          <p style="text-align: right;" class="foot-right">(SITI CHOLIFAH)</p>
        </td>
      </tr>
    </table>
  </div>          
</body></html>