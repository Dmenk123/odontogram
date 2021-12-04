$(document).ready(function() {
    $("#cek_manual").change(function() {
        if(this.checked) {
            $('[name="no_rm"]').attr('disabled', false).val('');
        }else{
            $('[name="no_rm"]').attr('disabled', true).val('');
        }
    });

    $('#alergi_obat').change(function (e) { 
        e.preventDefault();
        if($(this).val() == '1') {
            $('[name="alergi_obat_val"]').attr('disabled', false).val('');
        }else{
            $('[name="alergi_obat_val"]').attr('disabled', true).val('');
        }
    });

    $('#alergi_makanan').change(function (e) { 
        e.preventDefault();
        if($(this).val() == '1') {
            $('[name="alergi_makanan_val"]').attr('disabled', false).val('');
        }else{
            $('[name="alergi_makanan_val"]').attr('disabled', true).val('');
        }
    });


    $('.mask_tanggal').mask("00/00/0000", {placeholder: "DD/MM/YYYY"});
    $('.mask_rm').mask("AA.00.00");
});


function reloadFormPasien(){
    $('#CssLoader').removeClass('hidden');
    $.ajax({
        type: "post",
        url: base_url+"rekam_medik/load_form_pasien",
        data: {
            id_peg: id_peg,
            id_psn: id_psn,
            id_reg: id_reg
        },
        dataType: "json",
        success: function (response) {
           $('#CssLoader').addClass('hidden');
           $('[name="nik"]').val(response.old_data.nik);
           $('[name="nama"]').val(response.old_data.nama);
           $('[name="no_rm"]').val(response.old_data.no_rm);
           $('[name="tempat_lahir"]').val(response.old_data.tempat_lahir);
           $('[name="tanggal_lahir"]').val(response.tgl_lahir);
           $('[name="jenkel"]').val(response.old_data.jenis_kelamin);
           $('[name="suku"]').val(response.old_data.suku);
           $('[name="pekerjaan"]').val(response.old_data.pekerjaan);
           $('[name="hp"]').val(response.old_data.hp);
           $('[name="telp"]').val(response.old_data.telp_rumah);
           $('[name="alamat_rumah"]').val(response.old_data.alamat_rumah);
           $('[name="alamat_kantor"]').val(response.old_data.alamat_kantor);
           $('[name="gol_darah"]').val(response.old_data.gol_darah);
           $('[name="tekanan_darah_val"]').val(response.old_data.tekanan_darah_val);
           $('[name="tekanan_darah"]').val(response.old_data.tekanan_darah);
           $('[name="penyakit_jantung"]').val(response.old_data.penyakit_jantung);
           $('[name="diabetes"]').val(response.old_data.diabetes);
           $('[name="haemopilia"]').val(response.old_data.haemopilia);
           $('[name="hepatitis"]').val(response.old_data.hepatitis);
           $('[name="gastring"]').val(response.old_data.gastring);
           $('[name="penyakit_lainnya"]').val(response.old_data.penyakit_lainnya);
           $('[name="alergi_obat"]').val(response.old_data.alergi_obat);
           $('[name="alergi_obat_val"]').val(response.old_data.alergi_obat_val);
           $('[name="alergi_makanan"]').val(response.old_data.alergi_makanan);
           $('[name="alergi_makanan_val"]').val(response.old_data.alergi_makanan_val);
        }
    });
}