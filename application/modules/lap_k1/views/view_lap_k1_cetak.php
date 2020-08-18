<?php require_once(APPPATH . 'views/template/temp_img_cetak_header.php'); ?>
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
      padding-top: 0px;
    }

    .head-right {
      padding-bottom: 0px;
      border: 0px solid white;
      border-color: white;
      margin: 0px;
    }

    .tbl-header {
      padding-top: -15px;
      width: 100%;
      color: #070707;
      border-color: #070707;
      border-top: 2px solid #070707;
    }

    .tbl_content {
      padding-top: 10px;
      margin-left: -1px;
      /*line-height: 20px;*/
    }

    /*.tbl_content td {
      padding: 20px;
    }*/

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

    /*tbody td{
      padding: 10px;
    }
    tbody tr:nth-child(even){
      background: #F6F5FA;
    }
    tbody tr:hover{
      background: #EAE9F5
    }*/
    .clear {
      clear: both;
    }

    .kolom-pink {
      background: #f765bd;
    }

    .kolom-biru {
      background: #7570fa;
    }
  </style>
</head>

<body>
  <div class="container">
    <table class="tbl-outer">
      <tr>
        <td align="left" class="outer-left">
          <?php echo $img_laporan; ?>
        </td>
        <td align="right" class="outer-left">
          <p style="text-align: left; font-size: 14px" class="outer-left">
            <strong>SMP. Darul Ulum Surabaya</strong>
          </p>
          <p style="text-align: left; font-size: 12px" class="outer-left">Jl. Raya Manukan Kulon No.98-100 Kota Surabaya, Jawa Timur 60185</p>
        </td>
      </tr>
    </table>

    <h5 style="text-align: center;margin-top:-100px;"><strong>REALISASI KEGIATAN DAN ANGGARAN SEKOLAH (K1)</strong></h5>

    <table class="tbl-header">
      <tr>
        <td align="center" class="head-center">
          <p style="text-align: center; font-size: 14px" class="head-left"><strong>Tahun Ajaran <?php echo $tahun; ?></strong></p>
        </td>
      </tr>
    </table>
    <table>
      <tr>
        <td>Nama Sekolah </td>
        <td width="700px;">: Smp Darul Ulum Surabaya</td>
        <td width="200px;" style="text-align: center;border: 1px solid black;">Formulir BOS K-1</td>
      </tr>
      <tr>
        <td>Desa/Kecamatan </td>
        <td width="700px;">: Tandes</td>
        <td width="200px;" style="text-align: center;border: 1px solid black;">Diisi Oleh Sekolah</td>
      </tr>
      <tr>
        <td>Kabupaten/Kota </td>
        <td width="700px;">: Surabaya</td>
        <td width="200px;" style="text-align: center;border: 1px solid black;">Dikirim ke Tim Manajemen BOS Kab/Kota</td>
      </tr>
      <tr>
        <td>Provinsi </td>
        <td width="700px;">: Jawa Timur</td>
        <td width="200px;"></td>
      </tr>
    </table>
    <!-- =============================== -->
    <table> 
      <tr>
        <!-- penerimaan -->
        <td style="width:500px;">
          <table class="table table-bordered table-hover tbl_content" cellspacing="0" width="100%" border="1">
            <thead>
              <tr>
                <th colspan="4" style="text-align: center;">Penerimaan</th>
              </tr>
              <tr>
                <th style="text-align: center;">No Urut</th>
                <th style="text-align: center;">No Kode</th>
                <th style="text-align: center;">Uraian</th>
                <th style="text-align: center;">Jumlah</th>
              </tr>
            </thead>

            <tbody>
              <?php
              $counter_baris_in = 0;
              $jumlah_penerimaan = 0;
              foreach ($hasil_data['penerimaan'] as $key => $val) {
                $jumlah_penerimaan += $val['jumlah_raw'];
              }
              ?>      

              <tr>
                <?php $counter_baris_in++; ?>
                <td class="text-center tebal">I</td>
                <td class="text-center tebal">1</td>
                <td class="tebal">Sisa Tahun Lalu</td>
                <td class="tebal">
                  <div>
                    <span style="float: left;margin-left:5px;">Rp. </span>
                    <span style="float: right;margin-right:5px;"><?= number_format($saldo_awal, 0, ",", "."); ?></span>
                    <div class="clear"></div>
                  </div>
                </td>
              </tr>

              <tr>
                <?php $counter_baris_in++; ?>
                <td class="text-center tebal">II</td>
                <td class="text-center tebal">2</td>
                <td class="tebal">Pendapatan Rutin</td>
                <td class="tebal">
                  <div>
                    <span style="float: left;margin-left:5px;color: white;">Rp. </span>
                    <span style="float: right;margin-right:5px;color: white;">0</span>
                    <div class="clear"></div>
                  </div>
                </td>
              </tr>

              <tr>
                <?php $counter_baris_in++; ?>
                <td class="text-center"></td>
                <td class="text-center">2.1</td>
                <td>Gaji PNS</td>
                <td>
                  <div>
                    <span style="float: left;margin-left:5px;color: white;">Rp. </span>
                    <span style="float: right;margin-right:5px;color: white;">0</span>
                    <div class="clear"></div>
                  </div>
                </td>
              </tr>

              <tr>
                <?php $counter_baris_in++; ?>
                <td class="text-center"></td>
                <td class="text-center">2.2</td>
                <td>Gaji Pegawai Tidak Tetap</td>
                <td>
                  <div>
                    <span style="float: left;margin-left:5px;color: white;">Rp. </span>
                    <span style="float: right;margin-right:5px;color: white;">0</span>
                    <div class="clear"></div>
                  </div>
                </td>
              </tr>
              
              <tr>
                <?php $counter_baris_in++; ?>
                <td class="text-center"></td>
                <td class="text-center">2.3</td>
                <td>Belanja Barang dan Jasa</td>
                <td>
                  <div>
                    <span style="float: left;margin-left:5px;color: white;">Rp. </span>
                    <span style="float: right;margin-right:5px;color: white;">0</span>
                    <div class="clear"></div>
                  </div>
                </td>
              </tr>

              <tr>
                <?php $counter_baris_in++; ?>
                <td class="text-center"></td>
                <td class="text-center">2.4</td>
                <td>Belanja Pemeliharaan</td>
                <td>
                  <div>
                    <span style="float: left;margin-left:5px;color: white;">Rp. </span>
                    <span style="float: right;margin-right:5px;color: white;">0</span>
                    <div class="clear"></div>
                  </div>
                </td>
              </tr>


              <tr>
                <?php $counter_baris_in++; ?>
                <td class="text-center"></td>
                <td class="text-center">2.5</td>
                <td>Belanja Lain - Lain</td>
                <td>
                  <div>
                    <span style="float: left;margin-left:5px;color: white;">Rp. </span>
                    <span style="float: right;margin-right:5px;color: white;">0</span>
                    <div class="clear"></div>
                  </div>
                </td>
              </tr>

              <tr>
                <?php $counter_baris_in++; ?>
                <td class="text-center tebal">III</td>
                <td class="text-center tebal">3</td>
                <td class="tebal">Bantuan Operasional Sekolah</td>
                <td class="tebal">
                  <div>
                    <span style="float: left;margin-left:5px;color: white;">Rp. </span>
                    <span style="float: right;margin-right:5px;color: white;">0</span>
                    <div class="clear"></div>
                  </div>
                </td>
              </tr>

              <tr>
                <?php $counter_baris_in++; ?>
                <td class="text-center"></td>
                <td class="text-center">3.1</td>
                <td>BOS Pusat</td>
                <td>
                  <div>
                    <span style="float: left;margin-left:5px;">Rp. </span>
                    <span style="float: right;margin-right:5px;"><?= $hasil_data['penerimaan'][0]['jumlah']; ?></span>
                    <div class="clear"></div>
                  </div>
                </td>
              </tr>

              <!-- <tr>
                <?php $counter_baris_in++; ?>
                <td class="text-center"></td>
                <td class="text-center">3.2</td>
                <td>BOS Provinsi</td>
                <td>
                  <div>
                    <span style="float: left;margin-left:5px;color: white;">Rp. </span>
                    <span style="float: right;margin-right:5px;color: white;">0</span>
                    <div class="clear"></div>
                  </div>
                </td>
              </tr>

              <tr>
                <?php $counter_baris_in++; ?>
                <td class="text-center"></td>
                <td class="text-center">3.3</td>
                <td>BOS Kabupaten/Kota</td>
                <td>
                  <div>
                    <span style="float: left;margin-left:5px;color: white;">Rp. </span>
                    <span style="float: right;margin-right:5px;color: white;">0</span>
                    <div class="clear"></div>
                  </div>
                </td>
              </tr> -->
              
              <tr>
                <?php $counter_baris_in++; ?>
                <td class="text-center tebal">IV</td>
                <td class="text-center tebal">4</td>
                <td class="tebal">Bantuan</td>
                <td class="tebal">
                  <div>
                    <span style="float: left;margin-left:5px;color: white;">Rp. </span>
                    <span style="float: right;margin-right:5px;color: white;">0</span>
                    <div class="clear"></div>
                  </div>
                </td>
              </tr>
              
              <tr>
                <?php $counter_baris_in++; ?>
                <td class="text-center"></td>
                <td class="text-center">4.1</td>
                <td>Dana Dekosentrasi</td>
                <td>
                  <div>
                    <span style="float: left;margin-left:5px;color: white;">Rp. </span>
                    <span style="float: right;margin-right:5px;color: white;">0</span>
                    <div class="clear"></div>
                  </div>
                </td>
              </tr>

              <tr>
                <?php $counter_baris_in++; ?>
                <td class="text-center"></td>
                <td class="text-center">4.2</td>
                <td>Dana Tugas Pembantuan</td>
                <td>
                  <div>
                    <span style="float: left;margin-left:5px;color: white;">Rp. </span>
                    <span style="float: right;margin-right:5px;color: white;">0</span>
                    <div class="clear"></div>
                  </div>
                </td>
              </tr>

              <tr>
                <?php $counter_baris_in++; ?>
                <td class="text-center"></td>
                <td class="text-center">4.3</td>
                <td>Dana Alokasi Khusus</td>
                <td>
                  <div>
                    <span style="float: left;margin-left:5px;color: white;">Rp. </span>
                    <span style="float: right;margin-right:5px;color: white;">0</span>
                    <div class="clear"></div>
                  </div>
                </td>
              </tr>

              <tr>
                <?php $counter_baris_in++; ?>
                <td class="text-center"></td>
                <td class="text-center">4.4</td>
                <td>Dana Lain-Lain</td>
                <td>
                  <div>
                    <span style="float: left;margin-left:5px;">Rp. </span>
                    <span style="float: right;margin-right:5px;"><?= $hasil_data['penerimaan'][1]['jumlah']; ?></span>
                    <div class="clear"></div>
                  </div>
                </td>
              </tr>

              <tr class="kolom-pink">
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="tebal">Jumlah Penerimaan</td>
                <td> 
                  <div>
                    <span style="float: left;margin-left:5px;">Rp. </span>
                    <span style="float: right;margin-right:5px;"><?= number_format($jumlah_penerimaan,0,",",".");?></span>
                    <div class="clear"></div>
                  </div>
                </td>
              </tr>

              <tr class="kolom-pink">
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td></td>
                <td> 
                  <div>
                    <span style="float: left;margin-left:5px; color: #f765bd;">Rp. </span>
                    <span style="float: right;margin-right:5px; color: #f765bd;">0</span>
                    <div class="clear"></div>
                  </div>
                </td>
              </tr>

            </tbody>
          </table>
        </td>
        <!-- !penerimaan -->

        <!-- pengeluaran -->
        <td style="width:530px;">
          <table class="table table-bordered table-hover tbl_content" cellspacing="0" width="100%" border="1">
            <thead>
              <tr>
                <th colspan="4" style="text-align: center;">Pengeluaran</th>
              </tr>
              <tr>
                <th style="text-align: center;">No Urut</th>
                <th style="text-align: center;">No Kode</th>
                <th style="text-align: center;">Uraian</th>
                <th style="text-align: center;">Jumlah</th>
              </tr>
            </thead>

            <tbody>
              <?php
              $total_out = 0;
              ?>      

              <tr>
                <td class="text-center tebal">I</td>
                <td class="text-center tebal">1</td>
                <td class="tebal">Program Sekolah</td>
                <td class="tebal">
                    <div>
                      <span style="float: left;margin-left:5px;color: white;">Rp. </span>
                      <span style="float: right;margin-right:5px;color: white;">0</span>
                      <div class="clear"></div>
                    </div>
                  </td>
              </tr>

              <?php 
              foreach ($hasil_data['pengeluaran_reg'] as $key => $value) { 
              $total_out += $value['jumlah_raw'];
              ?>
                <tr>
                  <td class="text-center"></td>
                  <td class="text-center"><?= $value['kode'] ?></td>
                  <td><?= $value['uraian'] ?></td>
                  <td>
                    <div>
                      <span style="float: left;margin-left:5px;">Rp. </span>
                      <span style="float: right;margin-right:5px;"><?= $value['jumlah']; ?></span>
                      <div class="clear"></div>
                    </div>
                  </td>
                </tr>
              <?php } ?>

              <tr>
                <td class="text-center tebal">II</td>
                <td class="text-center tebal">2</td>
                <td class="tebal">Belanja Lainnya</td>
                <td class="tebal">
                  <div>
                    <span style="float: left;margin-left:5px;color: white;">Rp. </span>
                    <span style="float: right;margin-right:5px;color: white;">0</span>
                    <div class="clear"></div>
                  </div>
                </td>
              </tr>

              <?php 
              foreach ($hasil_data['pengeluaran_gaji'] as $key => $value) { 
              $total_out += $value['jumlah_raw'];
              ?>
                <tr>
                  <td class="text-center"></td>
                  <td class="text-center"><?= $value['kode'] ?></td>
                  <td><?= $value['uraian'] ?></td>
                  <td>
                    <div>
                      <span style="float: left;margin-left:5px;">Rp. </span>
                      <span style="float: right;margin-right:5px;"><?= $value['jumlah']; ?></span>
                      <div class="clear"></div>
                    </div>
                  </td>
                </tr>
              <?php } ?>

              <tr class="kolom-pink">
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="tebal">Jumlah Pengeluaran</td>
                <td> 
                  <div>
                    <span style="float: left;margin-left:5px;">Rp. </span>
                    <span style="float: right;margin-right:5px;"><?= number_format($total_out,0,",",".");?></span>
                    <div class="clear"></div>
                  </div>
                </td>
              </tr>

              <tr class="kolom-pink">
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="tebal">SALDO</td>
                <td> 
                  <div>
                    <span style="float: left;margin-left:5px">Rp. </span>
                    <span style="float: right;margin-right:5px"><?= number_format($jumlah_penerimaan - $total_out,0,",",".");?></span>
                    <div class="clear"></div>
                  </div>
                </td>
              </tr>

            </tbody>
          </table>
        </td>
        <!-- !pengeluaran -->
      </tr>
    </table>
    <!-- =============================== -->
    <table class="tbl-footer">
      <tr>
        <td align="left">
          <p style="text-align: left;" class="foot-left"><strong>Mengetahui</strong> </p>
          <p style="text-align: left;" class="foot-left"><strong>Ketua Komite Sekolah</strong> </p>
        </td>
        <td align="center" style="padding-left:-120px;">
          <p style="text-align: center;" class="foot-center"><strong>Menyetujui</strong> </p>
          <p style="text-align: center;" class="foot-center"><strong>Kepala Sekolah</strong> </p>
        </td>
        <td align="right">
          <p style="text-align: right;" class="foot-left"><strong>Surabaya, <?= date('d') . ' ' . $arr_bulan[date('m')] . ' ' . date('Y'); ?></strong> </p>
          <p style="text-align: right;" class="foot-right"><strong>Bendahara</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        </td>
      </tr>

      <tr>
        <td align="left">
          <p style="text-align: left;margin-top:50px;" class="foot-left">(KHUSNUL KHOTIMAH,S.Pd) </p>
        </td>
        <td align="left" style="padding-left:-120px;">
          <p style="text-align: center;margin-top:50px;" class="foot-center">(KHUSNUL KHOTIMAH,S.Pd) </p>
        </td>
        <td align="right">
          <p style="text-align: right;margin-top:50px;" class="foot-right">(SITI CHOLIFAH)</p>
        </td>
      </tr>
    </table>
  </div>
</body>

</html>