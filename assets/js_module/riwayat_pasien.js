var save_method;
var table_diagnosa;
var table_tindakan;
var table_lab;
var table_logistik;
var pid;
var id_peg;
var id_reg;


$(document).ready(function() {
    let uri = new URL(window.location.href);
    pid = uri.searchParams.get("pid");

    if(pid != '' || pid != undefined) {
        pilih_pasien(pid);
    }

    $("#pid").select2();

    //force integer input in textfield
    $('input.numberinput').bind('keypress', function (e) {
        return (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 46) ? false : true;
    });
    
});	

function pilih_pasien(pid) {
    $.ajax({
        type: "post",
        url: base_url+'rekam_medik/hasil_pilih_pasien?unencrypted=true',
        data: {enc_id:pid},
        dataType: "json",
        success: function (response) {
            $('#tabel_pasien tbody').html(response.data);
            id_reg = response.data_id.id_reg;
            id_peg = response.data_id.id_peg;
            
            // pid = response.data_id.id_psn;
            // $('#modal_pilih_pasien').modal('hide');
            // if(response.is_pulang) {
            //     stateSelesai = true;
            // }

            reloadFormDiagnosaTabel(pid);
            reloadFormTindakanRiwayatTabel(pid);
            reloadFormTindakanLabRiwayatTabel(pid);
            reloadFormLogisitikRiwayatTabel(pid);
        }
    });

    
}

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}

function reloadFormDiagnosaTabel(pid){
    $('#CssLoader').removeClass('hidden');
    $('#CssLoader').addClass('hidden');
    table_diagnosa = $('#tabel_modal_diagnosa_pasien').DataTable({
        responsive: true,
        searchDelay: 500,
        processing: true,
        serverSide: false,
        bDestroy: true,
        ajax: {
            url  : base_url + "rekam_medik/riwayat_diagnosa",
            type : "POST",
            data : {
                id_psn : pid,
                id_reg : null,
                id_peg : null
            },
        },
        order: [[ 4, "desc" ]],

        columnDefs: [
            {
                targets: [-1], //last column
                orderable: false, //set not orderable
            },
            // { targets: 5, className: 'text-right' },
        ],
    });
}

function reloadFormDiagnosa(){
    $('#CssLoader').removeClass('hidden');
    $.ajax({
        type: "post",
        url: base_url+"rekam_medik/load_form_diagnosa/true",
        data: {
            id_peg: id_peg,
            id_psn: pid,
            id_reg: id_reg
        },
        dataType: "json",
        success: function (response) {
           $('#CssLoader').addClass('hidden');
           $('#tabel_modal_diagnosa tbody').html(response.html);
        }
    });
}

function reloadFormTindakanRiwayatTabel(pid){
    $('#CssLoader').removeClass('hidden');
    $('#CssLoader').addClass('hidden');
    table_tindakan = $('#tabel_modal_tindakan_pasien').DataTable({
        responsive: true,
        searchDelay: 500,
        processing: true,
        serverSide: false,
        bDestroy: true,
        ajax: {
            url  : base_url + "rekam_medik/riwayat_tindakan",
            type : "POST",
            data : {
                id_psn : pid,
                id_reg : null,
                id_peg : null
            },
        },
        order: [[ 5, "desc" ]],
        //set column definition initialisation properties
        columnDefs: [
            { targets: 3, className: 'text-right' },
        ],
    });
}

function reloadFormTindakan(){
    resetFormTindakan();
    $('#CssLoader').removeClass('hidden');
    $.ajax({
        type: "post",
        url: base_url+"rekam_medik/load_form_tindakan/true",
        data: {
            id_peg: id_peg,
            id_psn: pid,
            id_reg: id_reg
        },
        dataType: "json",
        success: function (response) {
           $('#CssLoader').addClass('hidden');
           $('#tabel_modal_tindakan tbody').html(response.html);
        }
    });
}

function reloadFormTindakanLabRiwayatTabel(pid){
    $('#CssLoader').removeClass('hidden');
    $('#CssLoader').addClass('hidden');
    table_lab = $('#tabel_modal_tindakan_lab_pasien').DataTable({
        responsive: true,
        searchDelay: 500,
        processing: true,
        serverSide: false,
        bDestroy: true,
        ajax: {
            url  : base_url + "rekam_medik/riwayat_tindakan_lab",
            type : "POST",
            data : {
                id_psn : pid,
                id_reg : null,
                id_peg : null
            },
        },

        //set column definition initialisation properties
        columnDefs: [
            {
                targets: [-1], //last column
                orderable: false, //set not orderable
            },
        ],
    });
}

function reloadFormLogisitikRiwayatTabel(pid){
    $('#CssLoader').removeClass('hidden');
    $('#CssLoader').addClass('hidden');
    table_logistik = $('#tabel_modal_logistik_pasien').DataTable({
        responsive: true,
        searchDelay: 500,
        processing: true,
        serverSide: false,
        bDestroy: true,
        ajax: {
            url  : base_url + "rekam_medik/riwayat_logistik",
            type : "POST",
            data : {
                id_psn : pid,
                id_reg : null,
                id_peg : null
            },
        },
        order: [[ 3, "desc" ]],
        //set column definition initialisation properties
        columnDefs: [
            {
                targets: [-1], //last column
                orderable: false, //set not orderable
            },
        ],
    });
}

function reloadFormLogistik(){
    resetFormLogistik();
    $('#CssLoader').removeClass('hidden');
    $.ajax({
        type: "post",
        url: base_url+"rekam_medik/load_form_logistik/true",
        data: {
            id_peg: id_peg,
            id_psn: pid,
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

function openModalRiwayat(modalName) {
    let modalNameFix = 'div_'+modalName+'_modal';
    if(modalName == 'diagnosa') {
        initOpsiDiagnosa();
        reloadFormDiagnosa();
    }else if(modalName == 'tindakan') {
        initOpsiTindakan();
        reloadFormTindakan();
    }else if(modalName == 'logistik') {
        initOpsiLogistik();
        reloadFormLogistik();
    }

    $('#'+modalNameFix+'').modal('show');
}

const initOpsiDiagnosa = () => {
    if ($('#fm_diagnosa').data('select2')) {
        $("#fm_diagnosa").select2('destroy');
    }
   
    $("#fm_diagnosa").select2({
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

const initOpsiTindakan = () => {
    if ($("#tdk_tindakan").data('select2')) {
        $("#tdk_tindakan").select2('destroy');
    }

    $("#tdk_tindakan").select2({
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

const initOpsiLogistik = () => {
    if ($("#log_logistik").data('select2')) {
        $("#log_logistik").select2('destroy');
    }

    $("#log_logistik").select2({
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

function save(id_form)
{
    let str1 = '#';
    let id_element = str1.concat(id_form);
    var form = $(id_element)[0];
    //console.log(form);
    var data = new FormData(form);
    data.append('id_peg', id_peg);
    data.append('id_reg', id_reg);
    data.append('id_psn', pid);
    
    if(id_form == 'form_anamnesa'){
        var value = CKEDITOR.instances['anamnesa'].getData()
        data.append('txt_anamnesa', value);
    }
    
    $("#btnSave").prop("disabled", true);
    $('#btnSave').text('Menyimpan Data'); //change button text
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: base_url+'riwayat_pasien/simpan_'+id_form,
        data: data,
        dataType: "JSON",
        processData: false,
        contentType: false, 
        cache: false,
        timeout: 600000,
        success: function (data) {
            if(data.status) {
                swal.fire({
                    title: "Sukses!!", 
                    text: data.pesan, 
                    type: "success"
                }).then(function() {
                    $("#btnSave").prop("disabled", false);
                    $('#btnSave').text('Simpan');      
                    if(id_form == 'form_diagnosa') {
                        reloadFormDiagnosa();
                        reloadFormDiagnosaTabel(pid);
                    }else if(id_form == 'form_tindakan'){
                        reloadFormTindakan();
                        reloadFormTindakanRiwayatTabel(pid);
                    }else if(id_form == 'form_logistik'){
                        reloadFormLogistik();
                        reloadFormLogisitikRiwayatTabel(pid);
                    }else{
                        $('#'+activeModal).modal('hide');
                    }
                });
                // swal.fire("Sukses!!", data.pesan, "success");     
            }else {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    if (data.is_select2[i] == false) {
                        $('[name="'+data.inputerror[i]+'"]').addClass('is-invalid');
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]).addClass('invalid-feedback');
                    }else{
                        //ikut style global
                        $('[name="'+data.inputerror[i]+'"]').next().next().text(data.error_string[i]).addClass('invalid-feedback-select');
                    }
                }

                $("#btnSave").prop("disabled", false);
                $('#btnSave').text('Simpan');
            }
        },
        error: function (e) {
            console.log("ERROR : ", e);
            $("#btnSave").prop("disabled", false);
            $('#btnSave').text('Simpan');
        }
    });
}

const resetFormTindakan = () => {
    $("#form_tindakan select[name='tdk_tindakan']").val('').trigger('change');
    $("#form_tindakan select[name='tdk_dokter']").val('').trigger('change');
    $("#form_tindakan input[name='tdk_gigi_num']").val('');
    $("#form_tindakan input[name='tdk_gigi_txt']").val('');
    $("#form_tindakan input[name='tdk_kode']").val('');
}

const resetFormLogistik = () => {
    $("#form_logistik select[name='log_logistik']").val('').trigger('change');
    $("#form_logistik select[name='log_dokter']").val('').trigger('change');
    $("#form_logistik input[name='log_qty']").val('');
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
                url : base_url + 'rekam_medik/delete_data_diagnosa_det/true',
                type: "POST",
                dataType: "JSON",
                data : {id:id},
                success: function(data)
                {
                    swalConfirm.fire('Berhasil Hapus Data!', data.pesan, 'success');
                    reloadFormDiagnosa();
                    reloadFormDiagnosaTabel(pid);
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
                url : base_url + 'rekam_medik/delete_data_tindakan_det/true',
                type: "POST",
                dataType: "JSON",
                data : {id:id},
                success: function(data)
                {
                    swalConfirm.fire('Berhasil Hapus Data!', data.pesan, 'success');
                    reloadFormTindakan();
                    reloadFormTindakanRiwayatTabel(pid);
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
                url : base_url + 'rekam_medik/delete_data_logistik_det/true',
                type: "POST",
                dataType: "JSON",
                data : {id:id},
                success: function(data)
                {
                    swalConfirm.fire('Berhasil Hapus Data!', data.pesan, 'success');
                    reloadFormLogistik();
                    reloadFormLogisitikRiwayatTabel(pid)
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