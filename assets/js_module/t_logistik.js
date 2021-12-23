$(document).ready(function() {
    initOpsiLogistik();
   

    $('#logistik').on('select2:selecting', function(e) {
        let data = e.params.args.data;
        $("#form_logistik input[name='harga_jual_raw']").val(data.harga_jual_raw);
    });
    
});

const formPintasanLogistik = () => {
    initOpsijenisLogistik();
    $('#modalPintasanLogistik').modal('show');
}

const initOpsijenisLogistik = () => {
    if ($("#form_master_logistik select[name='jenis']").data('select2')) {
        $("#form_master_logistik select[name='jenis']").select2('destroy');
    }
    
    $("#form_master_logistik select[name='jenis']").select2({
        // tags: true,
        //multiple: false,
        tokenSeparators: [',', ' '],
        minimumInputLength: 0,
        minimumResultsForSearch: 5,
        ajax: {
            url: base_url+'master_logistik/get_select_jenis_logistik',
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
                        }
                    })
                };
            }
        }
    });
}

const initOpsiLogistik = () => {
    if ($("#logistik").data('select2')) {
        $("#logistik").select2('destroy');
    }

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
}

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
           $('#ket_resep').val(response.ket_resep);
           $('#CssLoader').addClass('hidden');
           $('#tabel_modal_logistik tbody').html(response.html);
        }
    });
}

function simpanHeader()
{
    $("#btnSaveHeader").prop("disabled", true);
    $('#btnSaveHeader').text('Menyimpan Data ....');
    let keteranganResep = $('#ket_resep').val();
    swalConfirm.fire({
        title: 'Perhatian',
        text: "Apakah Anda ingin Menyimpan Keterangan Resep ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya !',
        cancelButtonText: 'Tidak !',
        reverseButtons: false
    }).then((result) => {
        if (result.value) {
        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: base_url + 'rekam_medik/simpan_keterangan_resep',
            data: {
                id_peg: id_peg,
                id_psn: id_psn,
                id_reg: id_reg,
                keteranganResep: keteranganResep
            },
            dataType: "JSON",
            success: function (data) {
                if(data.status) {
                    swalConfirm.fire('Berhasil Menambah Data!', data.pesan, 'success').then((cb) => {
                        if(cb.value) {
                            reloadFormLogistik();
                        }
                    });
                }

                $("#btnSaveHeader").prop("disabled", false);
                $('#btnSaveHeader').text('Simpan');
                
            },
            error: function (e) {
                console.log("ERROR : ", e);
                createAlert('Opps!','Terjadi Kesalahan','Coba Lagi nanti','danger',true,false,'pageMessages');
                $("#btnSaveHeader").prop("disabled", false);
                $('#btnSaveHeader').text('Simpan');
            }
        });
        }else if (
        /* Read more about handling dismissals below */
        result.dismiss === Swal.DismissReason.cancel
        ) {
            swalConfirm.fire(
                'Dibatalkan',
                'Aksi Dibatalakan',
                'error'
            );

            $("#btnSaveHeader").prop("disabled", false);
            $('#btnSaveHeader').text('Simpan');
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

function saveMasterLogistik()
{
    let form = $('#form_master_logistik')[0];
    let data = new FormData(form);

    $("#btnSaveMasterLogistik").prop("disabled", true);
    $('#btnSaveMasterLogistik').text('Menyimpan Data'); //change button text
    swalConfirm.fire({
        title: 'Perhatian !!',
        text: "Apakah anda yakin menambah data ini ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: base_url + 'master_logistik/add_data_logistik',
                data: data,
                dataType: "JSON",
                processData: false,
                contentType: false, 
                cache: false,
                timeout: 600000,
                success: function (data) {
                    if(data.status) {
                        swal.fire("Sukses!!", "Aksi Berhasil", "success");
                        $("#btnSaveMasterLogistik").prop("disabled", false);
                        $('#btnSaveMasterLogistik').text('Simpan');
                        reset_modal_form_logistik();
                        initOpsiLogistik();
                        $("#modalPintasanLogistik").modal('hide');
                    }else {
                        for (var i = 0; i < data.inputerror.length; i++) 
                        {
                            if (data.inputerror[i] != 'jabatans') {
                                $('[name="'+data.inputerror[i]+'"]').addClass('is-invalid');
                                $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]).addClass('invalid-feedback'); //select span help-block class set text error string
                            }else{
                                $($('#jabatans').data('select2').$container).addClass('has-error');
                            }
                        }
        
                        $("#btnSaveMasterLogistik").prop("disabled", false);
                        $('#btnSaveMasterLogistik').text('Simpan');
                    }
                },
                error: function (e) {
                    console.log("ERROR : ", e);
                    $("#btnSaveMasterLogistik").prop("disabled", false);
                    $('#btnSaveMasterLogistik').text('Simpan');
        
                    reset_modal_form_logistik();
                    $("#modalPintasanLogistik").modal('hide');
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
      })
    
}

function reset_modal_form_logistik()
{
    $('#form_master_logistik')[0].reset();
    $('.append-opt').remove(); 
    $('div.form-group').children().removeClass("is-invalid invalid-feedback");
    $('span.help-block').text('');
    $('#div_pass_lama').css("display","none");
}
