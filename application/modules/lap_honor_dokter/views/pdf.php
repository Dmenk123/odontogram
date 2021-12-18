
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

  </style>

<div>
  <table class="tbl-header">
    <tr>
      <td align="center" class="head-center">
        <p style="text-align: center; font-size: 16px; padding-top:10px;" class="head-left"><strong> <?= $title;?> </strong></p>
      </td>
    </tr>
  </table>
  
  <table id="tbl_content" class="table table-bordered table-hover" cellspacing="0" width="100%" border="1">
    <thead>
      <tr>
        <th style="width: 5%;">No</th>
        <th>Nama Pelanggan</th>
        <th>Nama Barang</th>
        <th>qty</th>
        <th>Harga</th>
        <th>Tanggal Order</th>
      </tr>
    </thead>
    <tbody>
      <?php
        if ($table) {   
        foreach ($table as $key => $value) {
      ?>
        <tr>
          <td><?php echo $key+1;?></td>
          <td><?php echo $value->nama_pelanggan;?></td>
          <td><?php echo $value->nama_barang;?></td>
          <td><?php echo $value->qty.' Pcs';?></td>
          <td><?php echo 'Rp '.number_format($value->sub_total);?></td>
          <td><?php echo date('d-m-Y H:i:s', strtotime($value->tanggal_order));?></td>
        </tr>

      <?php
        }
      }else{
        echo '<tr><td colspan="6" align="center">Tidak ada data</td></th>';
      }
      ?>
    </tbody>
  </table>
</div>
