$(document).ready(function() {
    initOpsiTindakanLab();

    $('#tindakanlab').on('select2:selecting', function(e) {
        let data = e.params.args.data;
        
        $("#form_tindakanlab input[name='tdklab_kode']").val(data.kode);
        $("#form_tindakanlab input[name='tdklab_tindakan']").val(data.nama);
        $("#form_tindakanlab input[name='tdklab_harga']").val(data.harga);
        $("#form_tindakanlab input[name='tdklab_harga_raw']").val(data.harga_raw);
        $("#form_tindakanlab input[name='tdklab_diskon']").val(data.disc_persen);
        $("#form_tindakanlab input[name='tdklab_nett']").val(data.harga_nett);
        $("#form_tindakanlab input[name='tdklab_nett_raw']").val(data.harga_nett_raw);
    });
    
});

const formPintasanTindakanLab = () => {
    $('#modalPintasanLab').modal('show');
}

const initOpsiTindakanLab = () => {
    if ($("#tindakanlab").data('select2')) {
        $("#tindakanlab").select2('destroy');
    }

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
                            harga_raw: item.harga_raw,
                            disc_persen: item.disc_persen,
                            harga_nett: item.harga_nett,
                            harga_nett_raw: item.harga_nett_raw,
                        }
                    })
                };
            }
        }
    });
}



function reloadFormTindakanLab(){
    resetFormTindakanLab()
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

const resetFormTindakanLab = () => {
    $('#tindakanlab').val('').trigger('change');
    $("#form_tindakanlab input[name='tdklab_kode']").val('');
    $("#form_tindakanlab input[name='tdklab_tindakan']").val('');
    $("#form_tindakanlab input[name='tdklab_harga']").val('');
    $("#form_tindakanlab input[name='tdklab_harga_raw']").val('');
    $("#form_tindakanlab input[name='tdklab_diskon']").val('');
    $("#form_tindakanlab input[name='tdklab_nett']").val('');
    $("#form_tindakanlab input[name='tdklab_nett_raw']").val('');
    $("#form_tindakanlab input[name='tdklab_ket']").val('');
}

const setHargaLabRaw = () => {
    let diskonLab = $('#tdklab_diskon').val();
    let rpLab = $('#tdklab_harga').inputmask('unmaskedvalue');
    
    let rpLabGrossRaw = parseFloat(rpLab).toFixed(2);
    let rpLabNettRaw = parseFloat((()=>{
        return rpLab - (rpLab * diskonLab / 100);
    })()).toFixed(2);

    // set value
    $('#tdklab_harga_raw').val(rpLabGrossRaw);
    $('#tdklab_nett_raw').val(rpLabNettRaw);
    $('#tdklab_nett').val(formatMoney(Number(rpLabNettRaw)));
}


function saveMasterTindakanLab()
{
    let form = $('#form_master_lab')[0];
    let data = new FormData(form);

    $("#btnSaveMasterLab").prop("disabled", true);
    $('#btnSaveMasterLab').text('Menyimpan Data'); //change button text
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
                url: base_url + 'master_laboratorium/add_data_laboratorium',
                data: data,
                dataType: "JSON",
                processData: false,
                contentType: false, 
                cache: false,
                timeout: 600000,
                success: function (data) {
                    if(data.status) {
                        swal.fire("Sukses!!", "Aksi Berhasil", "success");
                        $("#btnSaveMasterLab").prop("disabled", false);
                        $('#btnSaveMasterLab').text('Simpan');
                        reset_modal_form_lab();
                        initOpsiTindakanLab();
                        $("#modalPintasanLab").modal('hide');
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
        
                        $("#btnSaveMasterLab").prop("disabled", false);
                        $('#btnSaveMasterLab').text('Simpan');
                    }
                },
                error: function (e) {
                    console.log("ERROR : ", e);
                    $("#btnSaveMasterLab").prop("disabled", false);
                    $('#btnSaveMasterLab').text('Simpan');
        
                    reset_modal_form_lab();
                    $("#modalPintasanLab").modal('hide');
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

function reset_modal_form_lab()
{
    $('#form_master_lab')[0].reset();
    $('.append-opt').remove(); 
    $('div.form-group').children().removeClass("is-invalid invalid-feedback");
    $('span.help-block').text('');
    $('#div_pass_lama').css("display","none");
}
