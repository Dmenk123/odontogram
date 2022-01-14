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

        //set column definition initialisation properties
        columnDefs: [
            { targets: 3, className: 'text-right' },
        ],
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

        //set column definition initialisation properties
        columnDefs: [
            {
                targets: [-1], //last column
                orderable: false, //set not orderable
            },
        ],
    });
}

function openModalRiwayat(modalName) {
    let modalNameFix = 'div_'+modalName+'_modal';
    if(modalName == 'diagnosa') {
        initOpsiDiagnosa();
        reloadFormDiagnosa();
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
                    }else if(id_form == 'form_tindakan'){
                        reloadFormTindakan();
                    }else if(id_form == 'form_logistik'){
                        reloadFormLogistik();
                    }else if(id_form == 'form_kamera'){
                        reloadFormKamera();
                    }else if(id_form == 'form_tindakanlab'){
                        reloadFormTindakanLab();
                    }else if(id_form == 'form_pasien'){
                        reloadFormPasien();
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