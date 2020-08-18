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
  <!-- Main content -->
  <div class="container">
    <?php foreach ($hasil_header as $val ) : ?>
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
      <h2 style="text-align: center;"><strong>Nota Penerimaan</strong></h2>
      <table class="tbl-header">
        <tr>
          <td align="left" class="head-left">
            <p style="text-align: left; font-size: 14px" class="head-left"><strong>Surabaya, <?php echo date('d-m-Y', strtotime($val->tanggal)); ?></strong></p>
          </td>
          <td align="right" class="head-left">
            <p style="text-align: right; font-size: 14px" class="head-right"><strong>Kode Pencatatan : <?php echo $val->id; ?></strong></p>
          </td>
        </tr> 
        <tr> 
          <td align="left" class="head-left" colspan="2">
            <p style="text-align: left; font-size: 12px" class="head-left"><strong>Petugas : <?php echo $val->nama_lengkap_user; ?></strong></p>
          </td>
        </tr>  
      </table>
    <?php endforeach ?>

    <table id="tbl_content" class="table table-bordered table-hover" cellspacing="0" width="100%" border="1">
      <thead>
        <tr>
          <th style="width: 10px; text-align: left;">No</th>
          <th style="width: 50px; text-align: left;">Kode</th>
          <th style="width: 30px; text-align: left;">Jumlah</th>
          <th style="width: 30px; text-align: left;">Satuan</th>
          <th style="width: 100px; text-align: left;">Harga Satuan</th>
          <th style="width: 100px; text-align: left;">Harga Total</th>
          <th style="text-align: left;">Keterangan</th>
        </tr>
      </thead>
      <tbody>
      <?php $no = 1; ?>
      
        <tr>
          <td><?php echo $no; ?></td>  
          <td><?php echo $hasil_data->id_trans_masuk; ?></td>
          <td><?php echo $hasil_data->qty; ?></td>
          <td><?php echo $hasil_data->nama_satuan; ?></td>
          <td>
            <div>
              <span style="float: left;">Rp. </span>
              <span style="float: right;"><?= number_format($hasil_data->harga_satuan,0,",",".");?></span>
              <div class="clear"></div>
            </div>
          </td>  
          <td>
            <div>
              <span style="float: left;">Rp. </span>
              <span style="float: right;"><?= number_format($hasil_data->harga_total,0,",",".");?></span>
              <div class="clear"></div>
            </div>
          </td>  
          <td><?php echo $hasil_data->keterangan; ?></td>
        </tr>
     
      </tbody>
      </table>
      
      <table class="tbl-footer">
        <tr>
          <td align="left">
            <p style="text-align: left;" class="foot-left"><strong>Tata Usaha</strong> </p>
          </td>
          
          <td align="right">
            <p style="text-align: right;" class="foot-right"><strong>Keuangan</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
          </td>
        </tr>
        <tr>
          <td align="left">
            <?php foreach ($hasil_header as $val ) : ?> 
            <p style="text-align: left;" class="foot-left">(........................................) </p>      
          </td>
          
          <td align="right">
            <p style="text-align: right;" class="foot-right">(........................................)</p>
            <?php endforeach ?> 
          </td>
        </tr>
      </table>
  </div>          
</body></html>