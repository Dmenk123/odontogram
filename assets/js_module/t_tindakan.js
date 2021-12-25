$(document).ready(function() {
    initOpsiTindakan();

    $('#tindakan').on('select2:selecting', function(e) {
        $('#input_tdk_gigi_num').val('');
        $('#input_tdk_gigi_txt').val('');

        let data = e.params.args.data;
        // console.log(data);
        if(data.is_all_gigi) {
            $('#input_tdk_gigi_num').slideUp();
            $('#input_tdk_gigi_txt').slideDown().val('all');
        }else{
            $('#input_tdk_gigi_num').slideDown();
            $('#input_tdk_gigi_txt').slideUp().val('');
        }

        $("#form_tindakan input[name='tdk_kode']").val(data.kode);
        $("#form_tindakan input[name='tdk_tindakan']").val(data.nama);
        
        if(data.is_owner != '1') {
            $("#form_tindakan input[name='tdk_harga']").val(data.harga).attr('disabled', true);
        }else{
            $("#form_tindakan input[name='tdk_harga']").val(data.harga).attr('disabled', false);
        }
       
        $("#form_tindakan input[name='tdk_harga_raw']").val(data.harga_raw);
        $("#form_tindakan input[name='tdk_diskon']").val(data.disc_persen);
        $("#form_tindakan input[name='tdk_nett']").val(data.harga_nett);
        $("#form_tindakan input[name='tdk_nett_raw']").val(data.harga_nett_raw);
    });
    
});

const formPintasanTindakan = () => {
    $('#modalPintasanTindakan').modal('show');
}

const initOpsiTindakan = () => {
    if ($("#tindakan").data('select2')) {
        $("#tindakan").select2('destroy');
    }

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
                            is_owner:item.is_owner
                        }
                    })
                };
            }
        }
    });
}

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


function saveMasterTindakan()
{
    let form = $('#form_master_tindakan')[0];
    let data = new FormData(form);

    $("#btnSaveMasterTindakan").prop("disabled", true);
    $('#btnSaveMasterTindakan').text('Menyimpan Data'); //change button text
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
                url: base_url + 'master_tindakan/add_data_tindakan',
                data: data,
                dataType: "JSON",
                processData: false,
                contentType: false, 
                cache: false,
                timeout: 600000,
                success: function (data) {
                    if(data.status) {
                        swal.fire("Sukses!!", "Aksi Berhasil", "success");
                        $("#btnSaveMasterTindakan").prop("disabled", false);
                        $('#btnSaveMasterTindakan').text('Simpan');
                        reset_modal_form_tindakan();
                        initOpsiTindakan();
                        $("#modalPintasanTindakan").modal('hide');
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
        
                        $("#btnSaveMasterTindakan").prop("disabled", false);
                        $('#btnSaveMasterTindakan').text('Simpan');
                    }
                },
                error: function (e) {
                    console.log("ERROR : ", e);
                    $("#btnSaveMasterTindakan").prop("disabled", false);
                    $('#btnSaveMasterTindakan').text('Simpan');
        
                    reset_modal_form_tindakan();
                    $("#modalPintasanTindakan").modal('hide');
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

function reset_modal_form_tindakan()
{
    $('#form_master_tindakan')[0].reset();
    $('.append-opt').remove(); 
    $('div.form-group').children().removeClass("is-invalid invalid-feedback");
    $('span.help-block').text('');
    $('#div_pass_lama').css("display","none");
}


