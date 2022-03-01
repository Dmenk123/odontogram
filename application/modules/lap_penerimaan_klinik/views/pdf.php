  <style>
    table#tbl_content {
      font-size: 10px;
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
        <p style="text-align: center; font-size: 16px; padding-top:10px;" class="head-left"><strong> <?= $title; ?> </strong> <br> <strong> <?= $periode; ?> </strong></p>
      </td>
    </tr>
  </table>

  <table id="tbl_content" class="table table-bordered table-hover" cellspacing="0" width="100%" border="1">
    <thead>
      <tr>
        <th style="width: 3%;">No</th>
        <th style="width: 12%;">Tanggal</th>
        <th>Pasien</th>
        <th>Layanan</th>
        <th style="width: 17%;">Tindakan</th>
        <th>Dokter</th>
        <th>Total Omset</th>
        <th>Honor Dokter</th>
        <th>Total Nett</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($datanya) {
        $grandTotalOmset = 0;
        $grandTotalHonor = 0;
        $no = 1;
        foreach ($datanya as $k => $v) {
          $grandTotalOmset += $v->total_omset;
          $grandTotalHonor += $v->total_bea_dokter;
          $q_gathel = $this->db->query("
            SELECT
              a.id as id_mutasi,
              d.harga_bruto,
              e.nama_tindakan
            FROM
              t_mutasi a
              join t_mutasi_det b on a.id = b.id_mutasi and b.deleted_at is null
              join t_tindakan c on a.id_trans_flag = c.id
              join t_tindakan_det d on c.id = d.id_t_tindakan and d.deleted_at is null
              join m_tindakan e on d.id_tindakan = e.id_tindakan and e.deleted_at is null
            WHERE
              a.id_registrasi = '$v->id_reg' 
              AND a.id_jenis_trans IN ( 2 ) 
              AND (a.total_penerimaan_nett > 0 AND a.total_penerimaan_gross > 0)
              GROUP BY d.id
          ")->result();

        ?>
          <tr>
            <td><?= $no; ?></td>
            <td><?= tanggal_indo($v->tanggal_reg); ?></td>
            <td><?= $v->nama_lengkap; ?></td>
            <td><?= $v->nama_layanan; ?></td>
            <?php
            if($q_gathel) {
							$html = "<td><ul style='padding-left: 15px;'>";
							foreach ($q_gathel as $kk => $vv) {
								$html .= "
									<li>".$vv->nama_tindakan."</li>
								";
							}
							$html .= "</ul></td>";
              echo $html;
						}else{
							$html = "<td> - </td>";
              echo $html;
						}
            ?>
            <td><?= $v->nama_dokter; ?></td>
            <td align="right"><?= number_format($v->total_omset, 0, ',', '.'); ?></td>
            <td align="right"><?= number_format($v->total_bea_dokter, 0, ',', '.'); ?></td>
            <td align="right"><?= number_format($v->total_omset - $v->total_bea_dokter, 0, ',', '.'); ?></td>
          </tr>
          <?php
          $no++;
          ?>
        <?php } ?>
        <tr>
          <td colspan='8' align='center'><b>Grand Total Omset</b></td>
          <td align='right'><?= number_format($grandTotalOmset, 0, ',', '.'); ?></td>
        </tr>
        <tr>
          <td colspan='8' align='center'><b>Grand Total Honor</b></td>
          <td align='right'><?= number_format($grandTotalHonor, 0, ',', '.'); ?></td>
        </tr>
        <tr>
          <td colspan='8' align='center'><b>Penerimaan Klink (Nett)</b></td>
          <td align='right'><?= number_format($grandTotalOmset - $grandTotalHonor, 0, ',', '.'); ?></td>
        </tr>
      <?php } else {
        echo '<tr><td colspan="8" align="center">Tidak ada data</td></th>';
      }
      ?>
    </tbody>
  </table>

  <!-- <table class="tbl-footer" border='0'>
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
  </table> -->