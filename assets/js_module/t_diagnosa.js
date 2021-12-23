$(document).ready(function() {

    initOpsiDiagnosa();

    // $('#diagnosa').on('select2:selecting', function(e) {
        // let data = e.params.args.data;
        
        // $('#nik').val(data.nik);
        // $('#no_rm').val(data.no_rm);
        // $('#tempat_lahir').val(data.tempat_lahir);
        // let tgl_lhr = data.tanggal_lahir;
        // $('#tanggal_lahir').val(tgl_lhr.split("-").reverse().join("/"));
        // $('#umur_reg').val(data.umur);
        // $('#pemetaan').val(data.pemetaan);
    // });
    
});

const formPintasan = () => {
    $('#modalPintasanDiagnosa').modal('show');
}

const initOpsiDiagnosa = () => {
    if ($('#diagnosa').data('select2')) {
        $("#diagnosa").select2('destroy');
    }
   
    $("#diagnosa").select2({
        // tags: true,
        //multiple: false,
        tokenSeparators: [',', ' '],
        minimumInputLength: 0,
        minimumResultsForSearch: 5,
        ajax: {
            url: base_url+'master_diagnosa/get_select_diagnosa',
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
                            html: item.html
                        }
                    })
                };
            }
        }
    });
}

function reloadFormDiagnosa(){
    $('#CssLoader').removeClass('hidden');
    $.ajax({
        type: "post",
        url: base_url+"rekam_medik/load_form_diagnosa",
        data: {
            id_peg: id_peg,
            id_psn: id_psn,
            id_reg: id_reg
        },
        dataType: "json",
        success: function (response) {
           $('#CssLoader').addClass('hidden');
           $('#tabel_modal_diagnosa tbody').html(response.html);
        }
    });
}


function hapus_diagnosa_det(id) {
    swalConfirmDelete.fire({
        title: 'Hapus Data Diagnosa ?',
        text: "Data Akan dihapus ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus Data !',
        cancelButtonText: 'Tidak, Batalkan!',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
            $.ajax({
                url : base_url + 'rekam_medik/delete_data_diagnosa_det',
                type: "POST",
                dataType: "JSON",
                data : {id:id},
                success: function(data)
                {
                    swalConfirm.fire('Berhasil Hapus Data!', data.pesan, 'success');
                    reloadFormDiagnosa();
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


function saveMasterDiagnosa()
{
    let form = $('#form_master_diagnosa')[0];
    let data = new FormData(form);

    $("#btnSaveMasterDiagnosa").prop("disabled", true);
    $('#btnSaveMasterDiagnosa').text('Menyimpan Data'); //change button text
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
                url: base_url + 'master_diagnosa/add_data_diagnosa',
                data: data,
                dataType: "JSON",
                processData: false,
                contentType: false, 
                cache: false,
                timeout: 600000,
                success: function (data) {
                    if(data.status) {
                        swal.fire("Sukses!!", "Aksi Berhasil", "success");
                        $("#btnSaveMasterDiagnosa").prop("disabled", false);
                        $('#btnSaveMasterDiagnosa').text('Simpan');
                        reset_modal_form_diagnosa();
                        initOpsiDiagnosa();
                        $("#modalPintasanDiagnosa").modal('hide');
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
        
                        $("#btnSaveMasterDiagnosa").prop("disabled", false);
                        $('#btnSaveMasterDiagnosa').text('Simpan');
                    }
                },
                error: function (e) {
                    console.log("ERROR : ", e);
                    $("#btnSaveMasterDiagnosa").prop("disabled", false);
                    $('#btnSaveMasterDiagnosa').text('Simpan');
        
                    reset_modal_form_diagnosa();
                    $("#modalPintasanDiagnosa").modal('hide');
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

function reset_modal_form_diagnosa()
{
    $('#form_master_diagnosa')[0].reset();
    $('.append-opt').remove(); 
    $('div.form-group').children().removeClass("is-invalid invalid-feedback");
    $('span.help-block').text('');
    $('#div_pass_lama').css("display","none");
}
