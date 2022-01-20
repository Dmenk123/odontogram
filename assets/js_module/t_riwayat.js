$(document).ready(function() {

    // $('#anamnesa').ckeditor();
    
});

function reloadFormDiagnosaRiwayat(){
    $('#CssLoader').removeClass('hidden');
    $('#CssLoader').addClass('hidden');
    table = $('#tabel_modal_diagnosa_pasien').DataTable({
        responsive: true,
        searchDelay: 500,
        processing: true,
        serverSide: false,
        bDestroy: true,
        ajax: {
            url  : base_url + "rekam_medik/riwayat_diagnosa",
            type : "POST",
            data : {
                id_peg: id_peg,
                id_psn: id_psn,
                id_reg: id_reg
            },
        },
        order: [[ 4, "desc" ]],
        //set column definition initialisation properties
        columnDefs: [
            {
                targets: [-1], //last column
                orderable: false, //set not orderable
            },
        ],
    });
}

function reloadFormTindakanRiwayat(){
    $('#CssLoader').removeClass('hidden');
    $('#CssLoader').addClass('hidden');
    table = $('#tabel_modal_tindakan_pasien').DataTable({
        responsive: true,
        searchDelay: 500,
        processing: true,
        serverSide: false,
        bDestroy: true,
        ajax: {
            url  : base_url + "rekam_medik/riwayat_tindakan",
            type : "POST",
            data : {
                id_peg: id_peg,
                id_psn: id_psn,
                id_reg: id_reg
            },
        },
        order: [[ 5, "desc" ]],
        //set column definition initialisation properties
        columnDefs: [
            { targets: 3, className: 'text-right' },
        ],
    });
}

function reloadFormOdontogramRiwayat(){
    $('#CssLoader').removeClass('hidden');
    $('#CssLoader').addClass('hidden');
    table = $('#tabel_modal_odontogram_pasien').DataTable({
        responsive: true,
        searchDelay: 500,
        processing: true,
        serverSide: false,
        bDestroy: true,
        ajax: {
            url  : base_url + "rekam_medik/riwayat_odontogram",
            type : "POST",
            data : {
                id_peg: id_peg,
                id_psn: id_psn,
                id_reg: id_reg
            },
        },
        // order: [[ 5, "desc" ]],
        //set column definition initialisation properties
        columnDefs: [
            { targets: 0, className: 'text-center' },
        ],
    });
}

function reloadFormTindakanLabRiwayat(){
    $('#CssLoader').removeClass('hidden');
    $('#CssLoader').addClass('hidden');
    table = $('#tabel_modal_tindakan_lab_pasien').DataTable({
        responsive: true,
        searchDelay: 500,
        processing: true,
        serverSide: false,
        bDestroy: true,
        ajax: {
            url  : base_url + "rekam_medik/riwayat_tindakan_lab",
            type : "POST",
            data : {
                id_peg: id_peg,
                id_psn: id_psn,
                id_reg: id_reg
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

function reloadFormLogisitikRiwayat(){
    $('#CssLoader').removeClass('hidden');
    $('#CssLoader').addClass('hidden');
    table = $('#tabel_modal_logistik_pasien').DataTable({
        responsive: true,
        searchDelay: 500,
        processing: true,
        serverSide: false,
        bDestroy: true,
        ajax: {
            url  : base_url + "rekam_medik/riwayat_logistik",
            type : "POST",
            data : {
                id_peg: id_peg,
                id_psn: id_psn,
                id_reg: id_reg
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

