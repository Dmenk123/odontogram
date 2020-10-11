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
                            harga_raw: item.harga_raw
                        }
                    })
                };
            }
        }
    });

    $('#tindakan').on('select2:selecting', function(e) {
        let data = e.params.args.data;
        
        $("#form_tindakan input[name='tdk_kode']").val(data.kode);
        $("#form_tindakan input[name='tdk_tindakan']").val(data.nama);
        $("#form_tindakan input[name='tdk_harga']").val(data.harga);
        $("#form_tindakan input[name='tdk_harga_raw']").val(data.harga_raw);
    });
    
});

function reloadFormTindakan(){
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

