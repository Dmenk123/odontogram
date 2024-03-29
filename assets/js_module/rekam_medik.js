let id_peg;
let id_psn;
let id_reg;
let pid;
let activeModal;
let stateSelesai = false;

$(document).ready(function() {
    let uri = new URL(window.location.href);
    pid = uri.searchParams.get("pid");

    if(pid != '' || pid != undefined) {
        pilih_pasien(pid);
    }
    
    
    //force integer input in textfield
    $('input.numberinput').bind('keypress', function (e) {
        return (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 46) ? false : true;
    });

    $(document).on('click', '.div_menu', function(){
        var nama_menu = $(this).data('id');

        if(id_peg == undefined || id_reg == undefined || id_psn == undefined) {
            Swal.fire('Mohon Pilih Pasien Terlebih Dahulu');
        }else{
            if(nama_menu == 'div_pulangkan') {
                confirmPulangkan(pid);
            }else{
                activeModal =  nama_menu+'_modal';
                cekDanSetValue(activeModal);
                $('#'+nama_menu+'_modal').modal('show');
            }
            
        } 
    });
    
    //////////////////////////////////////////////////////////////
});

function show_modal_pasien() {
    $('#modal_pilih_pasien').modal('show');
    $('#modal_pilih_pasien_title').text('Pilih Pasien'); 
    cari_pasien();
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

function submit_pasien(enc_id){
    location.href = base_url+'rekam_medik?pid='+enc_id;
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
            // $('#modal_pilih_pasien').modal('hide');
            if(response.is_pulang) {
                stateSelesai = true;
            }
        }
    });
}

function save(id_form)
{
    if(stateSelesai == true) {
        swalConfirm.fire('Gagal Menyimpan !', 'Pasien sudah dalam proses pembayaran, Batalkan terlebih dahulu', 'error').then((cb) => {
            if(cb.value) {
                location.reload();
                return;
            }
        });
        
        return;
    }
    
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

    if(id_form == 'form_noted'){
        var val = CKEDITOR.instances['noted'].getData()
        console.log(val);
        data.append('txt_noted', val);
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
        // console.log(objData);
        if(objData.menu == 'anamnesa') {
            $("#form_anamnesa input[name='id_anamnesa']").val(objData.data.id);
            $("#form_anamnesa textarea[name='anamnesa']").val(objData.data.anamnesa);
        }else if(objData.menu == 'diagnosa'){
            reloadFormDiagnosa();
        }else if(objData.menu == 'tindakan'){
            reloadFormTindakan();
        }else if(objData.menu == 'logistik'){
            reloadFormLogistik();
        }else if(objData.menu == 'kamera'){
            reloadFormKamera();
        }else if(objData.menu == 'tindakanlab'){
            reloadFormTindakanLab();
        }else if(objData.menu == 'diskon'){
            reloadFormDiskon();
        }else if(objData.menu == 'odonto'){
            reloadFormOdonto();
        }else if(objData.menu == 'pasien'){
            reloadFormPasien();
        }else if(objData.menu == 'riwayat'){
            console.log('tes'); 
            reloadFormDiagnosaRiwayat();
            reloadFormTindakanRiwayat();
            reloadFormTindakanLabRiwayat();
            reloadFormLogisitikRiwayat();
            reloadFormOdontogramRiwayat();
        }else if(objData.menu == 'noted'){
            $("#form_noted textarea[name='noted']").val(objData.data.noted_kasir);
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

const confirmPulangkan = (idReg) => {
    swalConfirm.fire({
        title: 'Konfirmasi Selesai',
        text: "Apakah Anda Yakin ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya !',
        cancelButtonText: 'Tidak',
        reverseButtons: false
      }).then((result) => {
        if (result.value) {
            $.ajax({
                url : base_url + 'rekam_medik/pulangkan_pasien',
                type: "POST",
                dataType: "JSON",
                data : {idReg : idReg},
                success: function(data)
                {
                    if(data.status) {
                        swalConfirm.fire('Berhasil Konfirmasi', data.pesan, 'success').then((cb) => {
                            if(cb.value) {
                                location.reload();
                            }
                        });
                    }else{
                        swalConfirm.fire('Gagal', data.pesan, 'error').then((cb) => {
                            if(cb.value) {
                                console.log(cb);
                                location.reload();
                            }
                        });
                    }
                    
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

const batalkanPulang = () => {
    swalConfirm.fire({
        title: 'Konfirmasi Batal Pulangkan Pasien',
        text: "Apakah Anda Yakin ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya !',
        cancelButtonText: 'Tidak',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url : base_url + 'rekam_medik/batal_pulangkan_pasien',
                type: "POST",
                dataType: "JSON",
                data : {id_reg : id_reg},
                success: function(data)
                {
                    if(data.status) {
                        swalConfirm.fire('Berhasil Konfirmasi', data.pesan, 'success').then((cb) => {
                            if(cb.value) {
                                location.reload();
                            }
                        });
                    }else{
                        swalConfirm.fire('Gagal', data.pesan, 'error').then((cb) => {
                            if(cb.value) {
                                console.log(cb);
                                location.reload();
                            }
                        });
                    }
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
