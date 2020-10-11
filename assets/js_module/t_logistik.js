$(document).ready(function() {

    $("#logistik").select2({
        // tags: true,
        //multiple: false,
        tokenSeparators: [',', ' '],
        minimumInputLength: 0,
        minimumResultsForSearch: 5,
        ajax: {
            url: base_url+'master_logistik/get_select_logistik',
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
                            id_jenis_logistik: item.id_jenis_logistik,
                            harga_jual_raw: item.harga_jual_raw
                        }
                    })
                };
            }
        }
    });

    $('#logistik').on('select2:selecting', function(e) {
        let data = e.params.args.data;
        $("#form_logistik input[name='harga_jual_raw']").val(data.harga_jual_raw);
    });
    
});

function reloadFormLogistik(){
    $('#CssLoader').removeClass('hidden');
    $.ajax({
        type: "post",
        url: base_url+"rekam_medik/load_form_logistik",
        data: {
            id_peg: id_peg,
            id_psn: id_psn,
            id_reg: id_reg
        },
        dataType: "json",
        success: function (response) {
           $('#CssLoader').addClass('hidden');
           $('#tabel_modal_logistik tbody').html(response.html);
        }
    });
}


function hapus_logistik_det(id) {
    swalConfirmDelete.fire({
        title: 'Hapus Data logistik ?',
        text: "Data Akan dihapus ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus Data !',
        cancelButtonText: 'Tidak, Batalkan!',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
            $.ajax({
                url : base_url + 'rekam_medik/delete_data_logistik_det',
                type: "POST",
                dataType: "JSON",
                data : {id:id},
                success: function(data)
                {
                    swalConfirm.fire('Berhasil Hapus Data!', data.pesan, 'success');
                    reloadFormLogistik();
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

