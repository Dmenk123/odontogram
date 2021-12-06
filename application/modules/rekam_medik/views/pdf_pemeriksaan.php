<style>
    table#tbl_content {
      font-size: 12px;
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
        <p style="text-align: center; font-size: 16px; padding-top:3px;" class="head-left"><strong> FORMULIR PEMERIKSAAN ODONTOGRAM </strong></p>
      </td>
    </tr>
  </table>

        <table id="tbl_content" class="table table-bordered table-hover" cellspacing="2" cellpadding="2" width="100%" border="0" style="margin-top:-20px;">
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
        <div align="center">
            <table id="tbl_content" class="table table-bordered table-hover" style="padding-left:13px;line-height:12px;" cellspacing="2" cellpadding="2" width="100%" border="1">
                <tbody>
                    <tr>
                        <td style="text-align:center" width="10%">11 (51)</td>
                        <td width="40%"><?php echo $odonto->sebelas ?? '';?></td>
                        <td width="40%"><?php echo $odonto->dua_satu ?? '';?></td>
                        <td style="text-align:center" width="10%">(61) 21</td>
                    </tr>
                    <tr>
                        <td style="text-align:center" width="10%">12 (52)</td>
                        <td width="40%"><?php echo $odonto->dua_belas ?? '';?></td>
                        <td width="40%"><?php echo $odonto->dua_dua ?? '';?></td>
                        <td style="text-align:center" width="10%">(62) 22</td>
                    </tr>
                    <tr>
                        <td style="text-align:center" width="10%">13 (53)</td>
                        <td width="40%"><?php echo $odonto->tiga_belas ?? '';?></td>
                        <td width="40%"><?php echo $odonto->dua_tiga ?? '';?></td>
                        <td style="text-align:center" width="10%">(63) 23</td>
                    </tr>
                    <tr>
                        <td style="text-align:center" width="10%">14 (54)</td>
                        <td width="40%"><?php echo $odonto->empat_belas ?? '';?></td>
                        <td width="40%"><?php echo $odonto->dua_empat ?? '';?></td>
                        <td style="text-align:center" width="10%">(64) 24</td>
                    </tr>
                    <tr>
                        <td style="text-align:center" width="10%">15 (55)</td>
                        <td width="40%"><?php echo $odonto->lima_belas ?? '';?></td>
                        <td width="40%"><?php echo $odonto->dua_lima ?? '';?></td>
                        <td style="text-align:center" width="10%">(65) 25</td>
                    </tr>
                    <tr>
                        <td style="text-align:center" width="10%">16</td>
                        <td width="40%"><?php echo $odonto->enam_belas ?? '';?></td>
                        <td width="40%"><?php echo $odonto->dua_enam ?? '';?></td>
                        <td style="text-align:center" width="10%">26</td>
                    </tr>
                    <tr>
                        <td style="text-align:center" width="10%">17</td>
                        <td width="40%"><?php echo $odonto->tujuh_belas ?? '';?></td>
                        <td width="40%"><?php echo $odonto->dua_tujuh ?? '';?></td>
                        <td style="text-align:center" width="10%">27</td>
                    </tr>
                    <tr>
                        <td style="text-align:center" width="10%">18</td>
                        <td width="40%"><?php echo $odonto->delapan_belas ?? '';?></td>
                        <td width="40%"><?php echo $odonto->dua_delapan ?? '';?></td>
                        <td style="text-align:center" width="10%">28</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div align="center" style="margin-top:20px;">
            <?php
                if ($odonto->gambar) { 
            ?>
                <img src="<?=base_url('upload/odontogram/'.$data_reg->id.'.png');?>" width="750" style="z-index:1">
            <?php
                }else{
            ?>
                <img src="<?=base_url('upload/odontogram/example.png');?>" width="750" style="z-index:1">
            <?php
                }
            ?>
        
        </div>
        <div align="center">
            <table id="tbl_content" class="table table-bordered table-hover" style="padding-left:13px;line-height:12px;" cellspacing="2" cellpadding="2" width="100%" border="1">
                <tbody>
                    <tr>
                        <td style="text-align:center" width="10%">48</td>
                        <td width="40%"><?php echo $odonto->empat_delapan ?? '';?></td>
                        <td width="40%"><?php echo $odonto->tiga_delapan ?? '';?></td>
                        <td style="text-align:center" width="10%">38</td>
                    </tr>
                    <tr>
                        <td style="text-align:center" width="10%">47</td>
                        <td width="40%"><?php echo $odonto->empat_tujuh ?? '';?></td>
                        <td width="40%"><?php echo $odonto->tiga_tujuh ?? '';?></td>
                        <td style="text-align:center" width="10%">37</td>
                    </tr>
                    <tr>
                        <td style="text-align:center" width="10%">46</td>
                        <td width="40%"><?php echo $odonto->empat_enam ?? '';?></td>
                        <td width="40%"><?php echo $odonto->tiga_enam ?? '';?></td>
                        <td style="text-align:center" width="10%">36</td>
                    </tr>
                    <tr>
                        <td style="text-align:center" width="10%">45 (85)</td>
                        <td width="40%"><?php echo $odonto->empat_lima ?? '';?></td>
                        <td width="40%"><?php echo $odonto->tiga_lima ?? '';?></td>
                        <td style="text-align:center" width="10%">(75) 35</td>
                    </tr>
                    <tr>
                        <td style="text-align:center" width="10%">44 (84)</td>
                        <td width="40%"><?php echo $odonto->empat_empat ?? '';?></td>
                        <td width="40%"><?php echo $odonto->tiga_empat ?? '';?></td>
                        <td style="text-align:center" width="10%">(74) 34</td>
                    </tr>
                    <tr>
                        <td style="text-align:center" width="10%">43 (83)</td>
                        <td width="40%"><?php echo $odonto->empat_tiga ?? '';?></td>
                        <td width="40%"><?php echo $odonto->tiga_tiga ?? '';?></td>
                        <td style="text-align:center" width="10%">(73) 33</td>
                    </tr>
                    <tr>
                        <td style="text-align:center" width="10%">42 (82)</td>
                        <td width="40%"><?php echo $odonto->empat_dua ?? '';?></td>
                        <td width="40%"><?php echo $odonto->tiga_dua ?? '';?></td>
                        <td style="text-align:center" width="10%">(72) 32</td>
                    </tr>
                    <tr>
                        <td style="text-align:center" width="10%">41 (81)</td>
                        <td width="40%"><?php echo $odonto->empat_satu ?? '';?></td>
                        <td width="40%"><?php echo $odonto->tiga_satu ?? '';?></td>
                        <td style="text-align:center" width="10%">(71) 31</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <table id="tbl_content" class="table table-bordered table-hover" style="padding-left:20px;" cellspacing="2" cellpadding="2" width="100%" border="0">
            <tbody>
                <tr>
                    <td width="20%">Occlusi</td>
                    <td width="5px;">:</td>
                    <td><?php echo $odonto->occlusi ?? '';?></td>
                </tr>
                <tr>
                    <td>Torus Palatinus</td>
                    <td>:</td>
                    <td><?php echo $odonto->torus_palatinus ?? '';?></td>
                </tr>
                <tr>
                    <td>Torus Mandibularis</td>
                    <td>:</td>
                    <td><?php echo $odonto->torus_mandibularis ?? '';?></td>
                </tr>
                <tr>
                    <td>Palatum</td>
                    <td>:</td>
                    <td><?php echo $odonto->palatum ?? '';?></td>
                </tr>
                <tr>
                    <td>Diastema</td>
                    <td>:</td>
                    <td>
                        <?php 
                            $value = $odonto->diastema ?? '';
                            if ($odonto->diastema != 'Tidak Ada') {
                                $value .= ' ('.$odonto->keterangan_diastema.')';
                            }else{
                                $value .= ' ('.$odonto->keterangan_diastema.')';
                            }
                            echo $value;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Gigi Anomali</td>
                    <td>:</td>
                    <td>
                        <?php 
                            $value = $odonto->gigi_anomali ?? '';
                            if ($odonto->gigi_anomali != 'Tidak Ada') {
                                $value .= ' ('.$odonto->keterangan_gigi_anomali.')';
                            }else{
                                $value .= ' ('.$odonto->keterangan_gigi_anomali.')';
                            }
                            echo $value;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Lain-lain</td>
                    <td>:</td>
                    <td><?php echo $odonto->lain_lain ?? '';?></td>
                </tr>
                <tr>
                    <td colspan="3">D : <?php echo (isset($odonto->d) != '') ? $odonto->d : '.... ';?> M : <?php echo $odonto->m ?? '.... ';?> F : <?php echo $odonto->f ?? '.... ';?></td>
                </tr>
                <tr>
                    <td colspan="3">Jumlah Photo yang diambil : <?php echo $odonto->jumlah_foto ?? '........';?> <?php echo $odonto->satuan_jumlah_foto ?? '';?></td>
                </tr>
                <tr>
                    <td colspan="3">Jumlah Rontgen Photo yang diambil : <?php echo $odonto->jumlah_rontgen ?? '........';?> <?php echo $odonto->satuan_jumlah_rontgen ?? '';?></td>
                </tr>
            </tbody>
        </table>

   
 