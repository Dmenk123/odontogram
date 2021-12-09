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
        <p style="text-align: center; font-size: 20px; padding-top:10px;" class="head-left"><strong> Pemeriksaan Odontogram </strong></p>
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
                                    <td width="65%"><?= $data_reg->nama_pasien; ?></td>
                                </tr>
                                <tr>
                                    <td >NIK/No. KTP</td>
                                    <td width="5%">:</td>
                                    <td width="65%"><?= $data_reg->nik; ?></td>
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
                                    <td width="65%"><?= $data_reg->jenis_kelamin; ?></td>
                                </tr>
                                <tr>
                                    <td width="30%">No. RM</td>
                                    <td width="5%">:</td>
                                    <td width="65%"><?= $data_reg->no_rm; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <div align="center" style="margin-top:20px;">
            <?php
                if (isset($odonto->gambar)) { 
            ?>
                <img src="<?=base_url('upload/odontogram/'.$data_reg->id.'.png');?>" width="950" style="z-index:1">
            <?php
                }else{
            ?>
                <img src="<?=base_url('upload/odontogram/example.png');?>" width="950" style="z-index:1">
            <?php
                }
            ?>
        
        </div>
   
 