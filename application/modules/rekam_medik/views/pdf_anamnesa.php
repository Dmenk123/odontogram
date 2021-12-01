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
        <p style="text-align: center; font-size: 20px; padding-top:10px;" class="head-left"><strong> Formulir Anamnesa </strong></p>
      </td>
    </tr>
  </table>

  <table id="tbl_content" class="table table-bordered table-hover" cellspacing="2" cellpadding="2" width="100%" border="0">
    <thead>
      <tr>
        <th>No. Registrasi </th>
        <th>:</th>
        <td><?= $data_reg->no_reg; ?></td>
      </tr>
      <tr>
        <th>Tgl Registrasi</th>
        <th>:</th>
        <td><?= tanggal_indo($data_reg->tanggal_reg); ?></td>
      </tr>
      <tr>
        <th>No. RM </th>
        <th>:</th>
        <td><?= $data_reg->no_rm; ?></td>
      </tr>
      <tr>
        <th>Dokter</th>
        <th>:</th>
        <td><?= $data_reg->nama_dokter; ?></td>
      </tr>
      <tr>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      <tr class="header">
        <td colspan="3" style="font-size: 16px;font-weight:bold;padding-top:10px;padding-bottom:15px;"><u>Identitas Pasien</u></td>
      </tr>
      <tr class="body">
        <th>Nama Pasien</th>
        <th>:</th>
        <td><?= $data_reg->nama_pasien; ?></td>
      </tr>
      <tr class="body">
        <th>Tempat / Tgl Lahir</th>
        <th>:</th>
        <td><?= $data_reg->tempat_lahir . ' / ' . tanggal_indo($data_reg->tanggal_lahir); ?></td>
      </tr>
      <tr class="body">
        <th>Usia</th>
        <th>:</th>
        <td><?= hitung_umur($data_reg->tanggal_lahir); ?></td>
      </tr>
      <tr class="body">
        <th>Jenis Kelamin</th>
        <th>:</th>
        <td><?= ($data_reg->jenis_kelamin == 'L') ? 'Laki-Laki': 'Perempuan'; ?></td>
      </tr>
      <tr class="body">
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
      <tr class="header">
        <td colspan="3" style="font-size: 16px;font-weight:bold;padding-top:10px;"><u>Keterangan</u></td>
      </tr>
      <tr>
        <td colspan="3" style="font-size:16px;border:0"><?= $datanya->anamnesa; ?></td>
      </tr>
    </tbody>
  </table>