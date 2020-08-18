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
      margin-left: 70px;
      margin-right: 100px;
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
      /* border-color: #070707;
      border-top: 2px solid #070707; */
    }
    #tbl_content{
      padding-top: 10px;
      margin-left: 70px;
      margin-right: 100px;
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
    /* tbody tr:nth-child(even){
      background: #F6F5FA;
    }
    tbody tr:hover{
      background: #EAE9F5
    } */
    .clear{
        clear:both;
    }
  </style>
</head><body>
  <div class="container">   
     <table class="tbl-header">
      <tr>
        <td align="center" class="head-center"> 
          <p style="text-align: center; font-size: 14px" class="head-left"><strong>Slip Gaji SMP Darul Ulum Surabaya</strong></p>
          <p style="text-align: center; font-size: 14px" class="head-left"><strong>Periode <?php echo $periode; ?></strong></p>
        </td>
      </tr>
    </table>
    <table class="table table-bordered table-hover" cellspacing="0" width="100%" border="0">
      <tr>
          <td align="right">Nama : </td>
          <td><?= $hasil_data['nama_guru'];?></td>
          <td></td>
        </tr>
        <tr>
          <td align="right">Jumlah Jam :</td>
          <td><?= $hasil_data['jumlah_jam_kerja'];?></td>
          <td></td>
        </tr> 
    </table>
    <table id="tbl_content" class="table table-bordered table-hover" cellspacing="0" width="100%" border="1">
      <thead>
        <tr>
          <th style="width: 10px; text-align: center;">No</th>
          <th style="width: 100px; text-align: center;">Uraian</th>
          <th style="width: 50px; text-align: center;">Jumlah</th>
        </tr>
      </thead>
      <tbody>
      <?php $no = 0; ?> 
        <tr>
          <td colspan="3"><strong>Penerimaan</strong></td>
        </tr> 
        <tr>
          <td class="text-center"><?= 1; ?></td>
          <td class="text-left">Gaji Pokok</td> 
          <td>
            <div>
              <span style="float: left;">Rp. </span>
              <?php if ($hasil_data['is_guru'] == '1') { ?>
                <?php $gapok = (int)$hasil_data['gaji_perjam'] * (int)$hasil_data['jumlah_jam_kerja'];?>
                <span style="float: right;"><?= number_format($gapok,0,",",".");?></span>
              <?php }else{ ?>
                <span style="float: right;"><?= number_format($hasil_data['gaji_pokok'],0,",",".");?></span>
              <?php } ?>
              <div class="clear"></div>
            </div>
          </td>
        </tr>
        <tr>
          <td class="text-center"><?= 2; ?></td>
          <td class="text-left">Tunjangan Jabatan</td> 
          <td>
            <div>
              <span style="float: left;">Rp. </span>
              <span style="float: right;"><?= number_format($hasil_data['gaji_tunjangan_jabatan'],0,",",".");?></span>
              <div class="clear"></div>
            </div>
          </td>
        </tr>

        <tr>
          <td class="text-center"><?= 3; ?></td>
          <td class="text-left">Tunjangan Lainnya</td> 
          <td>
            <div>
              <span style="float: left;">Rp. </span>
              <span style="float: right;"><?= number_format($hasil_data['gaji_tunjangan_lain'],0,",",".");?></span>
              <div class="clear"></div>
            </div>
          </td>
        </tr>
        
        <tr>
          <td colspan="3"><strong>Pengeluaran</strong></td>
        </tr>

        <tr>
          <td class="text-center"><?= 1; ?></td>
          <td class="text-left" style="height: 90px;">Potongan Lainnya</td> 
          <td>
            <div>
              <span style="float: left;">Rp. </span>
              <span style="float: right;"><?= number_format($hasil_data['potongan_lain'],0,",",".");?></span>
              <div class="clear"></div>
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="2"><strong>Jumlah</strong></td> 
          <td>
            <div>
              <span style="float: left;"><strong>Rp. </strong></span>
              <span style="float: right;"><strong><?= number_format($hasil_data['total_take_home_pay'],0,",",".");?></strong></span>
              <div class="clear"></div>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <table class="tbl-footer">
      <tr>
        <td align="right">
          <p style="text-align: right;" class="foot-right"><strong>Surabaya, <?= date('d').' '.$arr_bulan[(int)date('m')].' '.date('Y'); ?></strong> </p>
          <p style="text-align: right;" class="foot-right"><strong>Kepala Sekolah</strong> </p>
          <br><br><br>
          <p style="text-align: right;" class="foot-right"><strong>Khusnul Chotimah</strong> </p>
        </td>
      </tr>
    </table>
  </div>          
</body></html>