<style>
    .tbl-outer {
      color: #070707;
    }
</style>
<table class="tbl-outer" style="margin-top:-20px;">
    <tr>

        <td align="left" class="outer-left">
        <img src="<?= base_url('files/img/app_img/') . $data_klinik->gambar; ?>" height="75" width="90">
        </td>

        <td align="right" class="outer-left" style="padding-top: 5px; padding-left:10px;">
        <p style="text-align: left; font-size: 14px" class="outer-left">
            <strong><?= $data_klinik->nama_klinik.'lala'; ?></strong>
        </p>
        <p style="text-align: left; font-size: 12px" class="outer-left"><?= $data_klinik->alamat . ' ' . $data_klinik->kelurahan . ' ' . $data_klinik->kecamatan; ?></p>
        <p style="text-align: left; font-size: 12px" class="outer-left"><?= $data_klinik->kota . ', ' . $data_klinik->provinsi . ' ' . $data_klinik->kode_pos; ?></p>
        </td>

    </tr>
    </table>