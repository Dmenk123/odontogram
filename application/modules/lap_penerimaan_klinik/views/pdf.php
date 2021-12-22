<div>
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
        <th style="width: 5%;">No</th>
        <th>Dokter</th>
        <th>Klinik</th>
        <th>Honor Dokter</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($datanya) {
        $flag_rowspan = null;
        $grandTotal = 0;
        $no = 1;
        foreach ($datanya as $k => $v) {
          $grandTotal += $v->total;
          if ($flag_rowspan != $v->kode_dokter) { ?>
            <tr>
              <td rowspan='<?= $v->num_row; ?>'><?= $no; ?></td>
              <td rowspan='<?= $v->num_row; ?>'><?= $v->nama_dokter . " [" . $v->kode_dokter . "]"; ?></td>
              <td><?= $v->nama_klinik; ?></td>
              <td align="right"><?= number_format($v->total, 0, ',', '.'); ?></td>
            </tr>
            <?php
            $no++;
            $flag_rowspan = $v->kode_dokter;
            ?>
          <?php } else { ?>
            <tr>
              <td><?= $v->nama_klinik; ?></td>
              <td align="right"><?= number_format($v->total, 0, ',', '.'); ?></td>
            </tr>
          <?php } ?>
        <?php } ?>
        <tr>
          <td colspan='3' align='center'><b>Total Honor Dokter</b></td>
          <td align='right'><?=number_format($grandTotal, 0, ',', '.');?></td>
        </tr>
      <?php } else {
        echo '<tr><td colspan="4" align="center">Tidak ada data</td></th>';
      }
      ?>
    </tbody>
  </table>
</div>