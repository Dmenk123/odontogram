let id_peg;
let id_psn;
let id_reg;
let activeModal;

$(document).ready(function() {

    //force integer input in textfield
    $('input.numberinput').bind('keypress', function (e) {
        return (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 46) ? false : true;
    });

    $(document).on('click', '.div_menu', function(){
        var nama_menu = $(this).data('id');
        
        if(id_peg == undefined || id_reg == undefined || id_psn == undefined) {
            Swal.fire('Mohon Pilih Pasien Terlebih Dahulu');
        }else{
            activeModal =  nama_menu+'_modal';
            cekDanSetValue(activeModal);
            $('#'+nama_menu+'_modal').modal('show');
        } 
    });
    
    //////////////////////////////////////////////////////////////
});

function show_modal_pasien() {
    $('#modal_pilih_pasien').modal('show');
    $('#modal_pilih_pasien_title').text('Pilih Pasien'); 
}

function cari_pasien() {
    let form = $('#form_cari_pasien')[0];
    let data = new FormData(form);

    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: base_url+'rekam_medik/cari_pasien',
        data: data,
        dataType: "JSON",
        processData: false,
        contentType: false, 
        cache: false,
        timeout: 600000,
        success: function (response) {
            if(response.status) {
                $('#tabel_pilih_pasien tbody').html(response.data);
            }else{
                swalConfirm.fire('Gagal','Data Tidak Ditemukan','error');
            }
        }
    });
}

function pilih_pasien(enc_id){
    $.ajax({
        type: "post",
        url: base_url+'rekam_medik/hasil_pilih_pasien',
        data: {enc_id:enc_id},
        dataType: "json",
        success: function (response) {
            $('#tabel_pasien tbody').html(response.data);
            id_reg = response.data_id.id_reg;
            id_peg = response.data_id.id_peg;
            id_psn = response.data_id.id_psn;
            $('#modal_pilih_pasien').modal('hide');
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
    data.append('id_psn', id_psn);
    
    if(id_form == 'form_anamnesa'){
        var value = CKEDITOR.instances['anamnesa'].getData()
        data.append('txt_anamnesa', value);
    }
    
    $("#btnSave").prop("disabled", true);
    $('#btnSave').text('Menyimpan Data'); //change button text
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: base_url+'rekam_medik/simpan_'+id_form,
        data: data,
        dataType: "JSON",
        processData: false,
        contentType: false, 
        cache: false,
        timeout: 600000,
        success: function (data) {
            if(data.status) {
                swal.fire("Sukses!!", data.pesan, "success");
                $("#btnSave").prop("disabled", false);
                $('#btnSave').text('Simpan');                
                $('#'+activeModal).modal('hide');
            }else {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    if (data.is_select2[i] == false) {
                        $('[name="'+data.inputerror[i]+'"]').addClass('is-invalid');
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]).addClass('invalid-feedback'); //select span help-block class set text error string
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

function cekDanSetValue(txt_div_modal){
    let menu = txt_div_modal.split("_");
    let retval = $.ajax({
        type: "post",
        url: base_url+"rekam_medik/get_old_data",
        data: {
            menu:menu[1], 
            id_peg:id_peg,
            id_psn:id_psn,
            id_reg:id_reg
        },
        dataType: "json",
        success:setModalFieldValue,
    });

    function setModalFieldValue(objData){
        console.log(objData);
        if(objData.menu == 'anamnesa') {
            $("#form_anamnesa input[name='id_anamnesa']").val(objData.data.id);
            $("#form_anamnesa textarea[name='anamnesa']").val(objData.data.anamnesa);
        }
    }
    
    return;
}



////////////////////////////////////////////////////////////////////////////

// function reload_table()
// {
//     table.ajax.reload(null,false); 
// }

// function reload_table2()
// {
//     table2.ajax.reload(null,false); 
// }

function reset_form(jqIdForm) {
    $(':input','#'+jqIdForm)
        .not(':button, :submit, :reset, :hidden')
        .val('')
        .prop('checked', false)
        .prop('selected', false);
}

function get_uri_segment(segment) {
    var pathArray = window.location.pathname.split( '/' );
    return pathArray[segment];
}

$('#red').click(function(){
    $('#pilihanwarna').val('#ff0000');
});
$('#green').click(function(){
    $('#pilihanwarna').val('#00ff00');
});

$('#cyann').click(function(){
    $('#pilihanwarna').val('#00ffff');
});

$('#old_brown').click(function(){
    $('#pilihanwarna').val('#A9A9A9');
});

$('#pink').click(function(){
    $('#pilihanwarna').val('#ff3399');
});

$('#biru_muda').click(function(){
    $('#pilihanwarna').val('#b3b3ff');
});

$('#outline').click(function(){
    $('#pilihanwarna').val('outline');
});

$('#pre').click(function(){
    $('#pilihanwarna').val('PRE');
});

$('#ano').click(function(){
    $('#pilihanwarna').val('ANO');
});

$('#une').click(function(){
    $('#pilihanwarna').val('UNE');
});

$('#silang').click(function(){
    $('#pilihanwarna').val('silang');
});

$('#akar').click(function(){
    $('#pilihanwarna').val('akar');
});

$('#border').click(function(){
    $('#pilihanwarna').val('border');
});

$('#segitiga').click(function(){
    $('#pilihanwarna').val('segitiga');
});

$('#panah_kanan').click(function(){
    $('#pilihanwarna').val('panah_kanan');
});
$('#non_vital').click(function(){
    $('#pilihanwarna').val('non_vital');
});

$('#crash').click(function(){
    $('#pilihanwarna').val('crash');
});

$( document ).ready(function() {
    console.log('tes');
    var i;
        $("#barispertamakiri1").on('click', function(event){
            var hasil = $('#pilihanwarna').val();
            var subs  = hasil.substring(0,1);
            if(subs == '#'){
                $("#barispertamakiri1").css("fill", $('#pilihanwarna').val());
            }else if (hasil == 'outline') {
                $("#barispertamaoutline1").css("display", "block");
            }else if (hasil == 'PRE') {
                $("#barispertamapre1").css("display", "block");
                $("#barispertamaano1").css("display", "none");
                $("#barispertamaune1").css("display", "none");
            }else if (hasil == 'ANO') {
                $("#barispertamapre1").css("display", "none");
                $("#barispertamaune1").css("display", "none");
                $("#barispertamaano1").css("display", "block");
            }else if(hasil == 'UNE'){
                $("#barispertamapre1").css("display", "none");
                $("#barispertamaune1").css("display", "block");
                $("#barispertamaano1").css("display", "none");
            }else if (hasil == 'silang') {
                $("#barispertamasilang11").css("display", "block");
                $("#barispertamasilang21").css("display", "block");
            }else if (hasil == 'border'){
                $("#barispertamakiri1").css("stroke-width", '2');
            }else if (hasil == 'segitiga') {
                $("#barispertamasegitiga1").css("display", "block");
            }else if (hasil == 'panah_kanan') {
                $("#barispertamapanahkanan1").css("display", "block");
            }else if (hasil == 'non_vital') {
                $("#barispertamasegitiga1").css("display", "block");
                $("#barispertamasegitiga1").css("fill", "white");
            }else if (hasil == 'akar') {
                $("#barispertamaakar11").css("display", "block");
                $("#barispertamaakar21").css("display", "block");
            }else if (hasil == 'crash') {
                $("#barispertamacrash11").css("display", "block");
                $("#barispertamacrash21").css("display", "block");
                $("#barispertamacrash31").css("display", "block");
                $("#barispertamacrash41").css("display", "block");
            }
        });
        $("#barispertamakiri2").on('click', function(event){
            $("#barispertamakiri2").css("fill", $('#pilihanwarna').val());
        });
        $("#barispertamaatas1").on('click', function(event){
            var hasil = $('#pilihanwarna').val();
            var subs  = hasil.substring(0,1);
            if(subs == '#'){
                $("#barispertamaatas1").css("fill", $('#pilihanwarna').val());
            }else if (hasil == 'outline') {
                $("#barispertamaoutline1").css("display", "block");
            }else if (hasil == 'PRE') {
                $("#barispertamapre1").css("display", "block");
                $("#barispertamaune1").css("display", "none");
                $("#barispertamaano1").css("display", "none");
            }else if (hasil == 'ANO') {
                $("#barispertamapre1").css("display", "none");
                $("#barispertamaune1").css("display", "none");
                $("#barispertamaano1").css("display", "block");
            }else if(hasil == 'UNE'){
                $("#barispertamapre1").css("display", "none");
                $("#barispertamaune1").css("display", "block");
                $("#barispertamaano1").css("display", "none");
            }else if (hasil == 'silang') {
                $("#barispertamasilang11").css("display", "block");
                $("#barispertamasilang21").css("display", "block");
            }else if (hasil == 'border'){
                $("#barispertamaatas1").css("stroke-width", '2');
            }else if (hasil == 'segitiga') {
                $("#barispertamasegitiga1").css("display", "block");
            }else if (hasil == 'panah_kanan') {
                $("#barispertamapanahkanan1").css("display", "block");
            }else if (hasil == 'non_vital') {
                $("#barispertamasegitiga1").css("display", "block");
                $("#barispertamasegitiga1").css("fill", "white");
            }else if (hasil == 'akar') {
                $("#barispertamaakar11").css("display", "block");
                $("#barispertamaakar21").css("display", "block");
            }else if (hasil == 'crash') {
                $("#barispertamacrash11").css("display", "block");
                $("#barispertamacrash21").css("display", "block");
                $("#barispertamacrash31").css("display", "block");
                $("#barispertamacrash41").css("display", "block");
            }
        });
        $("#barispertamakanan1").on('click', function(event){
            var hasil = $('#pilihanwarna').val();
            var subs  = hasil.substring(0,1);
            if(subs == '#'){
                $("#barispertamakanan1").css("fill", $('#pilihanwarna').val());
            }else if (hasil == 'outline') {
                $("#barispertamaoutline1").css("display", "block");
            }else if (hasil == 'PRE') {
                $("#barispertamapre1").css("display", "block");
                $("#barispertamaano1").css("display", "none");
                $("#barispertamaune1").css("display", "none");
            }else if (hasil == 'ANO') {
                $("#barispertamapre1").css("display", "none");
                $("#barispertamaano1").css("display", "block");
                $("#barispertamaune1").css("display", "none");
            }else if(hasil == 'UNE'){
                $("#barispertamapre1").css("display", "none");
                $("#barispertamaune1").css("display", "block");
                $("#barispertamaano1").css("display", "none");
            }else if (hasil == 'silang') {
                $("#barispertamasilang11").css("display", "block");
                $("#barispertamasilang21").css("display", "block");
            }else if (hasil == 'border'){
                $("#barispertamakanan1").css("stroke-width", '2');
            }else if (hasil == 'segitiga') {
                $("#barispertamasegitiga1").css("display", "block");
            }else if (hasil == 'panah_kanan') {
                $("#barispertamapanahkanan1").css("display", "block");
            }else if (hasil == 'non_vital') {
                $("#barispertamasegitiga1").css("display", "block");
                $("#barispertamasegitiga1").css("fill", "white");
            }else if (hasil == 'akar') {
                $("#barispertamaakar11").css("display", "block");
                $("#barispertamaakar21").css("display", "block");
            }else if (hasil == 'crash') {
                $("#barispertamacrash11").css("display", "block");
                $("#barispertamacrash21").css("display", "block");
                $("#barispertamacrash31").css("display", "block");
                $("#barispertamacrash41").css("display", "block");
            }
        });
        $("#barispertamabawah1").on('click', function(event){
            var hasil = $('#pilihanwarna').val();
            var subs  = hasil.substring(0,1);
            if(subs == '#'){
                $("#barispertamabawah1").css("fill", $('#pilihanwarna').val());
            }else if (hasil == 'outline') {
                $("#barispertamaoutline1").css("display", "block");
            }else if (hasil == 'PRE') {
                $("#barispertamapre1").css("display", "block");
                $("#barispertamaune1").css("display", "none");
                $("#barispertamaano1").css("display", "none");
            }else if (hasil == 'ANO') {
                $("#barispertamapre1").css("display", "none");
                $("#barispertamaune1").css("display", "none");
                $("#barispertamaano1").css("display", "block");
            }else if(hasil == 'UNE'){
                $("#barispertamapre1").css("display", "none");
                $("#barispertamaune1").css("display", "block");
                $("#barispertamaano1").css("display", "none");
            }else if (hasil == 'silang') {
                $("#barispertamasilang11").css("display", "block");
                $("#barispertamasilang21").css("display", "block");
            }else if (hasil == 'border'){
                $("#barispertamabawah1").css("stroke-width", '2');
            }else if (hasil == 'segitiga') {
                $("#barispertamasegitiga1").css("display", "block");
            }else if (hasil == 'panah_kanan') {
                $("#barispertamapanahkanan1").css("display", "block");
            }else if (hasil == 'non_vital') {
                $("#barispertamasegitiga1").css("display", "block");
                $("#barispertamasegitiga1").css("fill", "white");
            }else if (hasil == 'akar') {
                $("#barispertamaakar11").css("display", "block");
                $("#barispertamaakar21").css("display", "block");
            }else if (hasil == 'crash') {
                $("#barispertamacrash11").css("display", "block");
                $("#barispertamacrash21").css("display", "block");
                $("#barispertamacrash31").css("display", "block");
                $("#barispertamacrash41").css("display", "block");
            }
        });
        $("#barispertamatengah1").on('click', function(event){
            var hasil = $('#pilihanwarna').val();
            var subs  = hasil.substring(0,1);
            if(subs == '#'){
                $("#barispertamatengah1").css("fill", $('#pilihanwarna').val());
            }else if (hasil == 'outline') {
                $("#barispertamaoutline1").css("display", "block");
            }else if (hasil == 'PRE') {
                $("#barispertamapre1").css("display", "block");
                $("#barispertamaano1").css("display", "none");
                $("#barispertamaune1").css("display", "none");
            }else if (hasil == 'ANO') {
                $("#barispertamapre1").css("display", "none");
                $("#barispertamaune1").css("display", "none");
                $("#barispertamaano1").css("display", "block");
            }else if(hasil == 'UNE'){
                $("#barispertamapre1").css("display", "none");
                $("#barispertamaune1").css("display", "block");
                $("#barispertamaano1").css("display", "none");
            }else if (hasil == 'silang') {
                $("#barispertamasilang11").css("display", "block");
                $("#barispertamasilang21").css("display", "block");
            }else if (hasil == 'border'){
                $("#barispertamatengah1").css("stroke-width", '2');
            }else if (hasil == 'segitiga') {
                $("#barispertamasegitiga1").css("display", "block");
            }else if (hasil == 'panah_kanan') {
                $("#barispertamapanahkanan1").css("display", "block");
            }else if (hasil == 'non_vital') {
                $("#barispertamasegitiga1").css("display", "block");
                $("#barispertamasegitiga1").css("fill", "white");
            }else if (hasil == 'akar') {
                $("#barispertamaakar11").css("display", "block");
                $("#barispertamaakar21").css("display", "block");
            }else if (hasil == 'crash') {
                $("#barispertamacrash11").css("display", "block");
                $("#barispertamacrash21").css("display", "block");
                $("#barispertamacrash31").css("display", "block");
                $("#barispertamacrash41").css("display", "block");
            }
        });


});

