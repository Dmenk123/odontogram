$(document).ready(function() {

    $("#tindakanlab").select2({
        // tags: true,
        //multiple: false,
        tokenSeparators: [',', ' '],
        minimumInputLength: 0,
        minimumResultsForSearch: 5,
        ajax: {
            url: base_url+'master_laboratorium/get_select_tindakanlab',
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

    $('#tindakanlab').on('select2:selecting', function(e) {
        let data = e.params.args.data;
        
        $("#form_tindakanlab input[name='tdklab_kode']").val(data.kode);
        $("#form_tindakanlab input[name='tdklab_tindakan']").val(data.nama);
        $("#form_tindakanlab input[name='tdklab_harga']").val(data.harga);
        $("#form_tindakanlab input[name='tdklab_harga_raw']").val(data.harga_raw);
    });
    
});

function reloadFormTindakanLab(){
    $('#CssLoader').removeClass('hidden');
    $.ajax({
        type: "post",
        url: base_url+"rekam_medik/load_form_tindakanlab",
        data: {
            id_peg: id_peg,
            id_psn: id_psn,
            id_reg: id_reg
        },
        dataType: "json",
        success: function (response) {
           $('#CssLoader').addClass('hidden');
           $('#tabel_modal_tindakanlab tbody').html(response.html);
        }
    });
}


function hapus_tindakanlab_det(id) {
    swalConfirmDelete.fire({
        title: 'Hapus Data Tindakan Lab ?',
        text: "Data Akan dihapus ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus Data !',
        cancelButtonText: 'Tidak, Batalkan!',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
            $.ajax({
                url : base_url + 'rekam_medik/delete_data_tindakanlab_det',
                type: "POST",
                dataType: "JSON",
                data : {id:id},
                success: function(data)
                {
                    swalConfirm.fire('Berhasil Hapus Data!', data.pesan, 'success');
                    reloadFormTindakanLab();
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

