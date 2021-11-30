<style>
  table#tbl_content thead tr th{
    /* text-align: center; */
   border-style: none;
  }

  table#tbl_content thead tr td{
    /* text-align: center; */
    border: 1;
    border-bottom-style: dotted;
  }

  table#tbl_content tbody tr td{
    /* text-align: center; */
    border: 1;
    border-bottom-style: dotted;
  }

  table#tbl_content tbody tr td.header{
    /* text-align: center; */
    border: 1;
    border-top-style: solid;
  }
</style>

<table class="tbl-header">
  <tr>
    <td align="center" class="head-center">
      <p style="text-align: center; font-size: 16px; padding-top:10px;" class="head-left"><strong> Formulir Anamnesa </strong></p>
    </td>
  </tr>
</table>

<table id="tbl_content" class="table table-bordered table-hover" cellspacing="2" cellpadding="2" width="100%" border="0">
  <thead>
    <tr>
      <th>No. Registrasi </th>
      <th>:</th>
      <td><?= $data_reg->no_reg;?></td>
    </tr>
    <tr>
      <th>Tgl Registrasi</th>
      <th>:</th>
      <td><?= tanggal_indo($data_reg->tanggal_reg);?></td>
    </tr>
    <tr>
      <th>No. RM </th>
      <th>:</th>
      <td><?= $data_reg->no_rm;?></td>
    </tr>
    <tr>
      <th>Dokter</th>
      <th>:</th>
      <td><?= $data_reg->nama_dokter;?></td>
    </tr>
    <tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <td>&nbsp;</td>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="header" colspan="3" style="font-size: 16px;font-weight:bold;padding-top:10px;">Identitas Pasien</td>
    </tr>
    <tr>
      <th>Nama Pasien</th>
      <th>:</th>
      <td><?= $data_reg->nama_pasien;?></td>
    </tr>
    <tr>
      <th>Tempat / Tgl Lahir</th>
      <th>:</th>
      <td><?= $data_reg->tempat_lahir.' / '.tanggal_indo($data_reg->tanggal_lahir);?></td>
    </tr>
    <tr>
      <th>Usia</th>
      <th>:</th>
      <td><?= hitung_umur($data_reg->tanggal_lahir);?></td>
    </tr>
    <tr>
      <th>Jenis Kelamin</th>
      <th>:</th>
      <td><?= $data_reg->jenis_kelamin;?></td>
    </tr>
    <tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td class="header" colspan="3" style="font-size: 16px;font-weight:bold;padding-top:10px;">Keterangan</td>
    </tr>
    <tr>
      <td colspan="3" style="font-size:16px;border:0"><?= $datanya->anamnesa;?></td>
    </tr>
  </tbody>
</table>