<div class="row">
  <div class="col-lg-3">
      <div class="pull-left">
        <h4 style="text-align:center;"><?= $detail_guru->nama; ?></h4>
        <img src="<?= base_url().'/assets/img/foto_guru/'.$detail_guru->foto; ?>" alt="image" height="170" width="170" class="img-circle">
      </div>
  </div>
  <div class="col-lg-6">
      <div class="kt-infobox__content">
          <table class="table table-borderless">
            <tbody>
                <tr>
                    <td coslpan="2"><strong>Biodata User / Pengguna</strong></td>
                </tr>
                <tr>
                    <td width="50%">Username</td>
                    <td width="47%" style="text-align:left;"><?= $detail_guru->nip; ?></td>
                </tr>
                <tr>
                    <td width="50%">Nama Lengkap</td>
                    <td width="47%" style="text-align:left;"><?= $detail_guru->nama; ?></td>
                </tr>
                <tr>
                    <td width="50%">Alamat</td>
                    <td width="47%" style="text-align:left;"><?= $detail_guru->alamat; ?></td>
                </tr>
                <tr>
                    <td width="50%">Tanggal Lahir</td>
                    <td width="47%" style="text-align:left;"><?= date('d-m-Y', strtotime($detail_guru->tanggal_lahir)); ?></td>
                </tr>
                <tr>
                    <td width="50%">Jenis Kelamin</td>
                    <?php if ($detail_guru->jenis_kelamin == 'L') {
                      echo '<td width="47%" style="text-align:left;">Laki-Laki</td>';
                    }else{
                      echo '<td width="47%" style="text-align:left;">Perempuan</td>';
                    } ?>
                </tr>
            </tbody>
          </table>
      </div>
  </div>
</div>