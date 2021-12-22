  <style>
    table#tbl_content {
      font-size: 14px;
    }

    table#tbl_content th,
    td {
      padding: 5px;
    }

    table#tbl_content thead tr th {
      /* text-align: center; */
      border-style: solid;
    }

    table#tbl_content thead tr td {
      /* text-align: center; */
      border-bottom: 1px;
      border-bottom-style: dotted;
    }

    table#tbl_content tbody tr.body td {
      /* text-align: center; */
      border-bottom: 1px;
      border-bottom-style: dotted;
    }

    table#tbl_content tbody tr.header td {
      /* text-align: center; */
      border-top: 1px;
      border-top-style: solid;
    }
  </style>
  </head>

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
        <th style="width: 3%;">No</th>
        <th style="width: 17%;">Tanggal</th>
        <th style="width: 30%;">Klinik</th>
        <th>Total Omset</th>
        <th>Honor Dokter</th>
        <th>Total Nett</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($datanya) {
        $flag_rowspan = null;
        $grandTotalOmset = 0;
        $grandTotalHonor = 0;
        $no = 1;
        foreach ($datanya as $k => $v) {
          $grandTotalOmset += $v->total_omset;
          $grandTotalHonor += $v->total_bea_dokter;

          if ($flag_rowspan != $v->tanggal) { ?>
            <tr>
              <td rowspan='<?= $v->num_row; ?>'><?= $no; ?></td>
              <td rowspan='<?= $v->num_row; ?>'><?= tanggal_indo($v->tanggal); ?></td>
              <td><?= $v->nama_klinik; ?></td>
              <td align="right"><?= number_format($v->total_omset, 0, ',', '.'); ?></td>
              <td align="right"><?= number_format($v->total_bea_dokter, 0, ',', '.'); ?></td>
              <td align="right"><?= number_format($v->total_omset - $v->total_bea_dokter, 0, ',', '.'); ?></td>
            </tr>
            <?php
            $no++;
            $flag_rowspan = $v->tanggal;
            ?>
          <?php } else { ?>
            <tr>
              <td><?= $v->nama_klinik; ?></td>
              <td align="right"><?= number_format($v->total_omset, 0, ',', '.'); ?></td>
              <td align="right"><?= number_format($v->total_bea_dokter, 0, ',', '.'); ?></td>
              <td align="right"><?= number_format($v->total_omset - $v->total_bea_dokter, 0, ',', '.'); ?></td>
            </tr>
          <?php } ?>
        <?php } ?>
        <tr>
          <td colspan='5' align='center'><b>Grand Total Omset</b></td>
          <td align='right'><?= number_format($grandTotalOmset, 0, ',', '.'); ?></td>
        </tr>
        <tr>
          <td colspan='5' align='center'><b>Grand Total Honor</b></td>
          <td align='right'><?= number_format($grandTotalHonor, 0, ',', '.'); ?></td>
        </tr>
        <tr>
          <td colspan='5' align='center'><b>Penerimaan Klink (Nett)</b></td>
          <td align='right'><?= number_format($grandTotalOmset - $grandTotalHonor, 0, ',', '.'); ?></td>
        </tr>
      <?php } else {
        echo '<tr><td colspan="6" align="center">Tidak ada data</td></th>';
      }
      ?>
    </tbody>
  </table>

  <table class="tbl-footer" border='0'>
    <tr>
      <td style="width: 70%;">&nbsp;</td>
      <td align="center" style="padding-top: 5px;padding-bottom:60px;">
        <?= $data_klinik->kota . ', ' . tanggal_indo(\Carbon\Carbon::now()->format('Y-m-d H:i:s')); ?>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="center" style="padding-top: 5px;">
        <?= $data_user->nama_pegawai; ?>
      </td>
    </tr>
  </table>