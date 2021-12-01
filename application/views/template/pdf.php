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
  </style>

<body>
  <div class="container">
    <?php if (isset($header) && $header != null) { ?>
      <?= $header; ?>
    <?php } else { ?>
      <table class="tbl-outer">
        <tr>

          <td align="left" class="outer-left">
            <img src="<?= base_url('files/img/app_img/') . $data_klinik->gambar; ?>" height="75" width="90">
          </td>

          <td align="right" class="outer-left" style="padding-top: 5px; padding-left:10px;">
            <p style="text-align: left; font-size: 14px" class="outer-left">
              <strong><?= $data_klinik->nama_klinik; ?></strong>
            </p>
            <p style="text-align: left; font-size: 12px" class="outer-left"><?= $data_klinik->alamat . ' ' . $data_klinik->kelurahan . ' ' . $data_klinik->kecamatan; ?></p>
            <p style="text-align: left; font-size: 12px" class="outer-left"><?= $data_klinik->kota . ', ' . $data_klinik->provinsi . ' ' . $data_klinik->kode_pos; ?></p>
          </td>

        </tr>
      </table>
    <?php } ?>

    <?php if (isset($content) && $content != null) {
      echo $content;
    } ?>


    <?php if (isset($footer) && $footer != null) { 
      echo $footer;
    } else { ?>
      <table class="tbl-footer">
        <tr>
          <td align="right" style="padding-top: 5px;padding-right:20px;padding-bottom:50px;">
            <?=$data_klinik->kota.', '.tanggal_indo($data_reg->tanggal_reg);?>
          </td>
        </tr>
        <tr>
          <td align="right" style="padding-top: 5px;padding-right:20px;">
            <?= $data_reg->nama_dokter; ?>
          </td>
        </tr>
      </table>
    <?php } ?>
  </div>
</body>

</html>