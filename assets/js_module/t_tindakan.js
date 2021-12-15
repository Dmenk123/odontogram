$(document).ready(function() {

    $("#tindakan").select2({
        // tags: true,
        //multiple: false,
        tokenSeparators: [',', ' '],
        minimumInputLength: 0,
        minimumResultsForSearch: 5,
        ajax: {
            url: base_url+'master_tindakan/get_select_tindakan',
            dataType: "json",
            type: "GET",
            data: function (params) {

                var queryParameters = {
                    term: params.term
                }
                return queryParameters;
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.text,
                            id: item.id,
                            kode: item.kode,
                            nama: item.nama,
                            harga: item.harga,
                            harga_raw: item.harga_raw,
                            is_all_gigi: item.is_all_gigi,
                            disc_persen: item.disc_persen,
                            harga_nett: item.harga_nett,
                            harga_nett_raw: item.harga_nett_raw,
                        }
                    })
                };
            }
        }
    });

    $('#tindakan').on('select2:selecting', function(e) {
        $('#input_tdk_gigi_num').val('');
        $('#input_tdk_gigi_txt').val('');

        let data = e.params.args.data;
        if(data.is_all_gigi) {
            $('#input_tdk_gigi_num').slideUp();
            $('#input_tdk_gigi_txt').slideDown().val('all');
        }else{
            $('#input_tdk_gigi_num').slideDown();
            $('#input_tdk_gigi_txt').slideUp().val('');
        }

        $("#form_tindakan input[name='tdk_kode']").val(data.kode);
        $("#form_tindakan input[name='tdk_tindakan']").val(data.nama);
        $("#form_tindakan input[name='tdk_harga']").val(data.harga);
        $("#form_tindakan input[name='tdk_harga_raw']").val(data.harga_raw);
        $("#form_tindakan input[name='tdk_diskon']").val(data.disc_persen);
        $("#form_tindakan input[name='tdk_nett']").val(data.harga_nett);
        $("#form_tindakan input[name='tdk_nett_raw']").val(data.harga_nett_raw);
    });
    
});

function reloadFormTindakan(){
    resetFormTindakan();
    $('#CssLoader').removeClass('hidden');
    $.ajax({
        type: "post",
        url: base_url+"rekam_medik/load_form_tindakan",
        data: {
            id_peg: id_peg,
            id_psn: id_psn,
            id_reg: id_reg
        },
        dataType: "json",
        success: function (response) {
           $('#CssLoader').addClass('hidden');
           $('#tabel_modal_tindakan tbody').html(response.html);
        }
    });
}


function hapus_tindakan_det(id) {
    swalConfirmDelete.fire({
        title: 'Hapus Data Tindakan ?',
        text: "Data Akan dihapus ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus Data !',
        cancelButtonText: 'Tidak, Batalkan!',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
            $.ajax({
                url : base_url + 'rekam_medik/delete_data_tindakan_det',
                type: "POST",
                dataType: "JSON",
                data : {id:id},
                success: function(data)
                {
                    swalConfirm.fire('Berhasil Hapus Data!', data.pesan, 'success');
                    reloadFormTindakan();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    Swal.fire('Terjadi Kesalahan');
                }
            });
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalConfirm.fire(
            'Dibatalkan',
            'Aksi Dibatalakan',
            'error'
          )
        }
    });
}

const resetFormTindakan = () => {
    $('#tindakan').val('').trigger('change');
    $("#form_tindakan input[name='tdk_gigi_num']").val('');
    $("#form_tindakan input[name='tdk_gigi_txt']").val('');
    $("#form_tindakan input[name='tdk_kode']").val('');
    $("#form_tindakan input[name='tdk_tindakan']").val('');
    $("#form_tindakan input[name='tdk_harga']").val('');
    $("#form_tindakan input[name='tdk_harga_raw']").val('');
    $("#form_tindakan input[name='tdk_ket']").val('');
    $("#form_tindakan input[name='tdk_diskon']").val('');
    $("#form_tindakan input[name='tdk_nett']").val('');
    $("#form_tindakan input[name='tdk_nett_raw']").val('');
}

const setHargaRaw = () => {
    let diskon = $('#tdk_diskon').val();
    let rp = $('#tdk_harga').inputmask('unmaskedvalue');
    
    let rpGrossRaw = parseFloat(rp).toFixed(2);
    let rpNettRaw = parseFloat((()=>{
        return rp - (rp * diskon / 100);
    })()).toFixed(2);

    // set value
    $('#tdk_harga_raw').val(rpGrossRaw);
    $('#tdk_nett_raw').val(rpNettRaw);
    $('#tdk_nett').val(formatMoney(Number(rpNettRaw)));
}

