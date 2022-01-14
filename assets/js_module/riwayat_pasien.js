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