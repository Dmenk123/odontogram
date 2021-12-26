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
        <p style="text-align: center; font-size: 18px; padding-top:10px;" class="head-left"><strong> FOTO X-RAY PASIEN </strong></p>
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
        <br>
        
        <?php
            if (isset($foto)) {
                foreach ($foto as $value) {
        ?>
        <div align="center">
            <img src="<?= base_url('upload/kamera/') .$value->nama_gambar;?>" width="500">
        </div>
        <p><strong>Keterangan :</strong><br><?php echo $value->keterangan;?></p><br>
        <?php
                }
            }
        ?>

       
       
   
 