var save_method;
var table_diagnosa;
var table_tindakan;
var table_lab;
var table_logistik;
var id_psn;

$(document).ready(function() {
    $("#pasien").select2();

    //force integer input in textfield
    $('input.numberinput').bind('keypress', function (e) {
        return (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 46) ? false : true;
    });

	//datatables
    $("#filters").click(function(){
        id_psn = $('#pasien').val();
        
        if(id_psn == '' || id_psn == undefined) {
            Swal.fire('Wajib memilih pasien terlebih dahulu.');
            return;
        }
    
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
                    id_psn : id_psn,
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
                // { targets: 5, className: 'text-right' },
            ],
        });

        reloadFormTindakanRiwayat();

        reloadFormTindakanLabRiwayat();

        reloadFormLogisitikRiwayat();
        
        $('#div-tabel-area').css('display', 'block');
       
    }); 
    
});	

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}


function reloadFormTindakanRiwayat(){
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
                id_psn : id_psn,
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

function reloadFormTindakanLabRiwayat(){
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
                id_psn : id_psn,
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

function reloadFormLogisitikRiwayat(){
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
                id_psn : id_psn,
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