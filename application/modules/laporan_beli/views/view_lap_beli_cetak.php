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
    
    .head-left{
       padding: 0px;
       border: 0px solid white;
       border-color: white;
       margin: 0px;
       background: white;
    }

    .tbl-header{
      color:#070707;
      margin-bottom: 15px;
    }

    .tbl-footer{
      width: 100%;
      color:#070707;
      border-top: 0px solid white;
      border-color: white;
      padding-top: 10px;
    }

    .tbl-footer td{
      border-top: 0px;
      padding: 5px;
      font-size: 14px;
      font-style: bold;
    }

    .tbl-footer tr{
      background: white;
    }

    table{
      border-collapse: collapse;
      font-family: arial;
      font-size: 10px;
      color:black;
    }
    thead th{
      text-align: left;
      padding: 5px;
      font-size: 12px;
      font-style: bold;
    }
    tbody td{
      border-top: 1px solid #e3e3e3;
      padding: 5px;
    }
    tbody tr:nth-child(even){
      background: #F6F5FA;
    }
    tbody tr:hover{
      background: #EAE9F5
    }
  </style>
</head><body>
  <table class="tbl-header">
      <tr>
        <td align="left" class="head-left">
          <p style="text-align: left; font-size: 14px" class="head-left"><strong>PT. Surya Putra Barutama</strong></p>
        </td>
      </tr>
      <tr>  
        <td align="right" class="head-left">
          <p style="text-align: left; font-size: 12px" class="head-right">Jl. Raya Mastrip Kedurus No.23, Kota Surabaya - Jawa Timur</p>
        </td>
      </tr>           
  </table>
  <!-- Main content -->
  <div class="container">     
      <h2 style="text-align: center;"><strong>Laporan Pembelian Barang - PT. SPB</strong></h2>
      <h4 style="text-align: center;"><strong>Periode Tanggal : <?php echo $tanggal ?></strong></h4>
    <table id="tabelLaporanBeli" class="table table-bordered table-hover" cellspacing="0" width="100%" border="2">
      <thead>
        <tr>
          <th style="width: 10px; text-align: left;">No</th>
          <th style="width: 50px; text-align: center;">Tanggal</th>
          <th style="width: 40px; text-align: center;">ID PO</th>
          <th style="width: 150px; text-align: left;">Nama Barang</th>
          <th style="width: 25px; text-align: left;">Satuan</th>
          <th style="width: 25px; text-align: left;">Qty</th>
          <th style="width: 100px; text-align: left;">Supplier</th>
          <th style="width: 100px; text-align: left;">Keterangan</th>
        </tr>
      </thead>
      <tbody>
      <?php $no = 1; ?>
      <?php if (count($hasil_data) > 0) { ?>
        <?php foreach ($hasil_data as $val ) : ?>
          <tr>
            <td><?php echo $no++; ?></td> 
            <td><?php echo $val->tgl_trans_beli_detail; ?></td>
            <td><?php echo $val->id_trans_beli; ?></td>
            <td><?php echo $val->nama_barang; ?></td>
            <td><?php echo $val->nama_satuan; ?></td>
            <td><?php echo $val->qty_beli; ?></td>
            <td><?php echo $val->nama_supplier; ?></td>
            <td><?php echo $val->keterangan_beli; ?></td>
          </tr>
        <?php endforeach ?>
      <?php } ?>
      </tbody>
    </table>
    <table class="tbl-footer">
        <tr>
          <td align="left">
            <p style="text-align: left;" class="foot-left">Dibuat Oleh </p>
          </td>
          <td align="center">
            <p style="text-align: center;" class="foot-right">SPV Gudang </p>
          </td>
          <td align="right">
            <p style="text-align: right;" class="foot-right">Manajer&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
          </td>
        </tr>
        <tr>
          <td align="left">
            <?php foreach ($hasil_footer as $val ) : ?> 
              <p style="text-align: left;" class="foot-left">( <?php echo $val->nama_lengkap_user;?> ) </p>
            <?php endforeach ?>      
          </td>
          <td align="center">
            <p style="text-align: center;" class="foot-right">( Ony Cahyono ) </p>
          </td>
          <td align="right">
            <p style="text-align: right;" class="foot-right">( Suryo Putro ) </p>
          </td>
        </tr>
    </table>
  </div>          
</body></html>