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
       <p style="text-align: center; font-size: 16px; padding-top:10px;" class="head-left"><strong> <?= $title.' '.$data_dokter->nama.' - '.$data_klinik->nama_klinik; ?> </strong> <br> <strong> <?= $periode; ?> </strong></p>
     </td>
   </tr>
 </table>

 <table id="tbl_content" class="table table-bordered table-hover" cellspacing="0" width="100%" border="1">
   <thead>
     <tr>
        <th style="width: 5%;">No</th>
        <th style="width: 17%;">Tanggal</th>
        <th>No. Reg</th>
        <th>Pasien</th>
        <th>Layanan</th>
        <th>Omset Klinik</th>
        <th>Nilai Honor</th>
        <th>Total Nett (Klinik)</th>
     </tr>
   </thead>
   <tbody>
     <?php
      if ($datanya) {
        $grandTotalOmset = 0;
        $grandTotalHonor = 0;
        $no = 1;
			
        foreach ($datanya as $k => $v) {
          $grandTotalHonor += $v->total_honor_dokter; 
          $grandTotalOmset += $v->total_omset;
          ?>
          <tr>
            <td><?= $no; ?></td>
            <td><?= tanggal_indo($v->tanggal_reg); ?></td>
            <td><?= $v->no_reg; ?></td>
            <td><?= $v->nama_lengkap; ?></td>
            <td><?= $v->nama_layanan; ?></td>
            <td align="right"><?= number_format($v->total_omset, 0, ',', '.'); ?></td>
            <td align="right"><?= number_format($v->total_honor_dokter, 0, ',', '.'); ?></td>
            <td align="right"><?= number_format($v->total_omset - $v->total_honor_dokter, 0, ',', '.'); ?></td>
          </tr>
          <?php $no++; ?>
       <?php } ?>
       <tr>
          <td colspan='7' align='center'><b>Grand Total Omset</b></td>
          <td align='right'><?= number_format($grandTotalOmset, 0, ',', '.'); ?></td>
        </tr>
        <tr>
          <td colspan='7' align='center'><b>Grand Total Honor</b></td>
          <td align='right'><?= number_format($grandTotalHonor, 0, ',', '.'); ?></td>
        </tr>
        <tr>
          <td colspan='7' align='center'><b>Penerimaan Klink (Nett)</b></td>
          <td align='right'><?= number_format($grandTotalOmset - $grandTotalHonor, 0, ',', '.'); ?></td>
        </tr>
     <?php } else {
        echo '<tr><td colspan="7" align="center">Tidak ada data</td></th>';
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