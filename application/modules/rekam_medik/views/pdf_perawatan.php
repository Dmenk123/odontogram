<style>
    table#tbl_content {
      font-size: 14px;
    }

    table#tbl_content thead tr th {
      /* text-align: center; */
      border-style: none;
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
        <p style="text-align: center; font-size: 18px; padding-top:10px;" class="head-left"><strong> PERAWATAN PASIEN </strong></p>
      </td>
    </tr>
  </table>

        <table id="tbl_content" class="table table-bordered table-hover" cellspacing="2" cellpadding="2" width="100%" border="0">
            <tbody>
                <tr>
                    <td>
                        <table id="tbl_content" class="table table-bordered table-hover" style="padding-left:10%;" cellspacing="2" cellpadding="2" width="100%" border="0">
                            <tbody>
                                <tr>
                                    <td width="25%">Nama</td>
                                    <td width="5%">:</td>
                                    <td width="65%"><?= $data_reg->nama_pasien ?? ''; ?></td>
                                </tr>
                                <tr>
                                    <td >NIK/No. KTP</td>
                                    <td width="5%">:</td>
                                    <td width="65%"><?= $data_reg->nik ?? ''; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td>
                        <table id="tbl_content" class="table table-bordered table-hover" style="padding-left:10%;" cellspacing="2" cellpadding="2" width="100%" border="0">
                            <tbody>
                                <tr>
                                    <td width="35%">Jenis Kelamin</td>
                                    <td width="5%">:</td>
                                    <td width="65%"><?= $data_reg->jenis_kelamin ?? ''; ?></td>
                                </tr>
                                <tr>
                                    <td width="30%">No. RM</td>
                                    <td width="5%">:</td>
                                    <td width="65%"><?= $data_reg->no_rm ?? ''; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <br>

        <?php
            if (isset($diagnosa)) {
        ?>
                <?php echo "<strong>Diagnosa</strong>"; ?>
                <table id="tbl_content" class="table table-bordered table-hover" style="padding-left:15px;"  cellspacing="2" cellpadding="2" width="95%" border="1">
                    <!-- <thead>
                        <tr>
                            <th>No</th>
                            <th>Gigi</th>
                            <th>Kode ICD</th>
                            <th>Diagnosa</th>
                        </tr>
                    </thead> -->
                    <tbody>
                        <tr>
                            <td align="center" width="5%">No</td>
                            <td align="center" width="15%">Gigi</td>
                            <td align="center" width="15%">Kode ICD</td>
                            <td align="center">Diagnosa</td>
                        </tr>
                        <?php
                            $no = 0;
                            foreach ($diagnosa as $value) {
                            $no++;
                            ?>
                                <tr>
                                    <td><?php echo $no;?></td>
                                    <td><?php echo $value->gigi;?></td>
                                    <td><?php echo $value->kode_diagnosa;?></td>
                                    <td><?php echo $value->nama_diagnosa;?></td>
                                </tr>
                            <?php
                            }
                        ?>
                    </tbody>
                </table>
                
        <?php
            }
        ?>
        <br>

        <?php
            if ($tindakan) {
        ?>
                <?php echo "<strong>Tindakan</strong>"; ?>
                <table id="tbl_content" class="table table-bordered table-hover" style="padding-left:15px;"  cellspacing="2" cellpadding="2" width="95%" border="1">
                    <!-- <thead>
                        <tr>
                            <th>No</th>
                            <th>Gigi</th>
                            <th>Kode ICD</th>
                            <th>Diagnosa</th>
                        </tr>
                    </thead> -->
                    <tbody>
                        <tr>
                            <td align="center" width="5%">No</td>
                            <td align="center" width="15%">Gigi</td>
                            <td align="center" width="15%">Kode</td>
                            <td align="center">Tindakan</td>
                        </tr>
                        <?php
                            $no = 0;
                            foreach ($tindakan as $value) {
                            $no++;
                            ?>
                                <tr>
                                    <td><?php echo $no;?></td>
                                    <td><?php echo $value->gigi;?></td>
                                    <td><?php echo $value->kode_tindakan;?></td>
                                    <td><?php echo $value->nama_tindakan;?></td>
                                </tr>
                            <?php
                            }
                        ?>
                    </tbody>
                </table>
                
        <?php
            }
        ?>
       
   
 