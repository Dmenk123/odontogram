var save_method;
var table;

$(document).ready(function() {

    //force integer input in textfield
    $('input.numberinput').bind('keypress', function (e) {
        return (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 46) ? false : true;
    });

	//datatables
	// table = $('#tabel_data').DataTable({
	// 	responsive: true,
    //     searchDelay: 500,
    //     processing: true,
    //     serverSide: true,
	// 	ajax: {
	// 		url  : base_url + "honor_dokter/list_data",
	// 		type : "POST" 
	// 	},

	// 	//set column definition initialisation properties
	// 	columnDefs: [
	// 		{
	// 			targets: [-1], //last column
	// 			orderable: false, //set not orderable
	// 		},
	// 	],
    // });


   
    
    //change menu status
    $(document).on('click', '.btn_edit_status', function(){
        var id = $(this).attr('id');
        var status = $(this).val();
        swalConfirm.fire({
            title: 'Ubah Status Data User ?',
            text: "Apakah Anda Yakin ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Ubah Status!',
            cancelButtonText: 'Tidak, Batalkan!',
            reverseButtons: true
          }).then((result) => {
            if (result.value) {
                $.ajax({
                    url : base_url + 'master_user/edit_status_user/'+ id,
                    type: "POST",
                    dataType: "JSON",
                    data : {status : status},
                    success: function(data)
                    {
                        swalConfirm.fire('Berhasil Ubah Status User!', data.pesan, 'success');
                        table.ajax.reload();
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
    });

    $(".modal").on("hidden.bs.modal", function(){
        // reset_modal_form();
        reset_modal_tindakan();
        reset_modal_lab();
    });
});	



function add_menu()
{
    reset_modal_form();
    save_method = 'add';
	$('#modal_honor_dokter').modal('show');
	$('#modal_title').text('Tambah Honor Baru'); 
}

function show_modal_honor(){
    $(".modal").modal('hide');
	$('#modal_honor_dokter').modal('show');
	$('#modal_title').text('Tambah Honor Baru'); 
}

function tambah_tindakan()
{
    var form = $('#form-honor-tindakan')[0];
    var data = new FormData(form);
    
    $("#btnSaveTindakan").prop("disabled", true);
    $('#btnSaveTindakan').text('Menyimpan Data'); //change button text
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: base_url + 'honor_dokter/add_data_honor_tindakan',
        data: data,
        dataType: "JSON",
        processData: false, // false, it prevent jQuery form transforming the data into a query string
        contentType: false, 
        cache: false,
        timeout: 600000,
        success: function (data) {
            if(data.status) {
                swalConfirm.fire('Berhasil Tambah Tindakan!', data.pesan, 'success');
                $("#btnSaveTindakan").prop("disabled", false);
                $('#btnSaveTindakan').text('Simpan Tindakan');
                load_form_tindakan(data.id_dokter);
            }else {
                if(data.is_alert) {
                    swalConfirm.fire('Oops !!!', data.pesan, 'error');
                }else{
                    for (var i = 0; i < data.inputerror.length; i++) 
                    {
                        if (data.inputerror[i] != 'id_tindakan') {
                            $('[name="'+data.inputerror[i]+'"]').addClass('is-invalid');
                            $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]).addClass('invalid-feedback'); //select span help-block class set text error string
                        }else{
                            //ikut style global
                            $('[name="'+data.inputerror[i]+'"]').next().next().text(data.error_string[i]).addClass('invalid-feedback-select');
                        }
                    }
                }
               
                $("#btnSaveTindakan").prop("disabled", false);
                $('#btnSaveTindakan').text('Simpan');
            }
        },
        error: function (e) {
            console.log("ERROR : ", e);
            $("#btnSaveTindakan").prop("disabled", false);
            $('#btnSaveTindakan').text('Simpan');

            reset_modal_form();
            $(".modal").modal('hide');
        }
    });
}

function tambah_lab()
{
    var form = $('#form-honor-lab')[0];
    var data = new FormData(form);
    
    $("#btnSaveLab").prop("disabled", true);
    $('#btnSaveLab').text('Menyimpan Data'); //change button text
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: base_url + 'honor_dokter/add_data_honor_lab',
        data: data,
        dataType: "JSON",
        processData: false, // false, it prevent jQuery form transforming the data into a query string
        contentType: false, 
        cache: false,
        timeout: 600000,
        success: function (data) {
            if(data.status) {
                swalConfirm.fire('Berhasil Tambah Honor Lab!', data.pesan, 'success');
                $("#btnSaveLab").prop("disabled", false);
                $('#btnSaveLab').text('Simpan Lab');
                load_form_lab(data.id_dokter);
            }else {
                if(data.is_alert) {
                    swalConfirm.fire('Oops !!!', data.pesan, 'error');
                }else{
                    for (var i = 0; i < data.inputerror.length; i++) 
                    {
                        if (data.inputerror[i] != 'id_lab') {
                            $('[name="'+data.inputerror[i]+'"]').addClass('is-invalid');
                            $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]).addClass('invalid-feedback'); //select span help-block class set text error string
                        }else{
                            //ikut style global
                            $('[name="'+data.inputerror[i]+'"]').next().next().text(data.error_string[i]).addClass('invalid-feedback-select');
                        }
                    }
                }
               
                $("#btnSaveLab").prop("disabled", false);
                $('#btnSaveLab').text('Simpan');
            }
        },
        error: function (e) {
            console.log("ERROR : ", e);
            $("#btnSaveTindakan").prop("disabled", false);
            $('#btnSaveTindakan').text('Simpan');

            reset_modal_form();
            $(".modal").modal('hide');
        }
    });
}

function save()
{
    var url;
    if(save_method == 'add') {
        url = base_url + 'honor_dokter/add_data_honor';
        txtAksi = 'Tambah Honor Dokter';
    }else{
        url = base_url + 'honor_dokter/update_data_honor';
        txtAksi = 'Edit Honor Dokter';
    }
    
    var form = $('#form-honor')[0];
    var data = new FormData(form);
    
    $("#btnSave").prop("disabled", true);
    $('#btnSave').text('Menyimpan Data'); //change button text
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: url,
        data: data,
        dataType: "JSON",
        processData: false, // false, it prevent jQuery form transforming the data into a query string
        contentType: false, 
        cache: false,
        timeout: 600000,
        success: function (data) {
            if(data.status) {
                swal.fire("Sukses!!", "Aksi "+txtAksi+" Berhasil", "success");
                $("#btnSave").prop("disabled", false);
                $('#btnSave').text('Simpan');
                
                reset_modal_form();
                $(".modal").modal('hide');
                
                reload_table();
            }else {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    if (data.inputerror[i] != 'dokter') {
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

            reset_modal_form();
            $(".modal").modal('hide');
        }
    });
}

function bukaFormTindakan(){
    let id_dokter = $('#dokter').val();
    if(id_dokter == '') {
        swalConfirm.fire('Perhatian!!', 'Mohon Memilih Dokter Terlebih Dahulu', 'error');
        return;
    }
    
    load_form_tindakan(id_dokter);
    $(".modal").modal('hide');
    $('#modal_honor_tindakan').modal('show');
    $('#modal_title_tindakan').text('Tambah Honor Tindakan');
    
}

function load_form_tindakan(id_dokter) {
    reset_modal_tindakan();
    $.ajax({
        type: "POST",
        url: base_url+"honor_dokter/get_data_form_tindakan",
        data:{id_dokter:id_dokter},
        dataType: "json",
        success: function (response) {
            $.each(response.tindakan, function(key, value) {
                $('#id_tindakan').
                    append($('<option></option>').
                    val(value.id_tindakan).
                    text(value.nama_tindakan)
                );       
            });

            $('#nama_dokter_tindakan').val(response.dokter.nama);
            $('#id_dokter_tindakan').val(response.dokter.id);
            $('#tabel-tindakan-dokter tbody').html(response.html);
        }
    });
}


function bukaFormLab(){
    let id_dokter = $('#dokter').val();
    if(id_dokter == '') {
        swalConfirm.fire('Perhatian!!', 'Mohon Memilih Dokter Terlebih Dahulu', 'error');
        return;
    }
    
    load_form_lab(id_dokter);
    $(".modal").modal('hide');
    $('#modal_honor_lab').modal('show');
    $('#modal_title_lab').text('Tambah Honor Laboratorium');
    
}

function load_form_lab(id_dokter) {
    reset_modal_lab();
    $.ajax({
        type: "POST",
        url: base_url+"honor_dokter/get_data_form_lab",
        data:{id_dokter:id_dokter},
        dataType: "json",
        success: function (response) {
            $.each(response.lab, function(key, value) {
                $('#id_lab').
                    append($('<option></option>').
                    val(value.id_laboratorium).
                    text(value.tindakan_lab)
                );       
            });

            $('#nama_dokter_lab').val(response.dokter.nama);
            $('#id_dokter_lab').val(response.dokter.id);
            $('#tabel-lab-dokter tbody').html(response.html);
        }
    });
}


function reset_modal(){
    reset_modal_form();
    reset_modal_tindakan();
    reset_modal_lab();
    $(".modal").modal('hide');
}

function reset_modal_tindakan(){
    $('#id_tindakan')
        .find('option')
        .remove()
        .end()
        .append('<option value="">Silahkan Pilih Tindakan</option>')
        .val("")
    ;
    $('#form-honor-tindakan')[0].reset();
    $('div.form-group').children().removeClass("is-invalid invalid-feedback");
    $('span.help-block').text('');
}

function reset_modal_lab(){
    $('#id_lab')
        .find('option')
        .remove()
        .end()
        .append('<option value="">Silahkan Pilih Lab</option>')
        .val("")
    ;
    $('#form-honor-lab')[0].reset();
    $('div.form-group').children().removeClass("is-invalid invalid-feedback");
    $('span.help-block').text('');
}


function reset_modal_form()
{
    $('#form-honor')[0].reset();
    $('.append-opt').remove(); 
    $('div.form-group').children().removeClass("is-invalid invalid-feedback");
    $('span.help-block').text('');
    $('#dokter').val('').trigger('change');
}

function hapus_honor_tindakan(id){
    swalConfirmDelete.fire({
        title: 'Hapus Data ?',
        text: "Data Akan dihapus permanen ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus Data !',
        cancelButtonText: 'Tidak, Batalkan!',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
            $.ajax({
                url : base_url + 'honor_dokter/delete_honor_tindakan',
                type: "POST",
                dataType: "JSON",
                data : {id:id},
                success: function(data)
                {
                    swalConfirm.fire('Berhasil !!!', data.pesan, 'success');
                    load_form_tindakan(data.id_dokter);
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

function hapus_honor_lab(id){
    swalConfirmDelete.fire({
        title: 'Hapus Data ?',
        text: "Data Akan dihapus permanen ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus Data !',
        cancelButtonText: 'Tidak, Batalkan!',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
            $.ajax({
                url : base_url + 'honor_dokter/delete_honor_lab',
                type: "POST",
                dataType: "JSON",
                data : {id:id},
                success: function(data)
                {
                    swalConfirm.fire('Berhasil !!!', data.pesan, 'success');
                    load_form_lab(data.id_dokter);
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
///////////////////////////////////////////////////////

// function edit_user(id)
// {
//     reset_modal_form();
//     save_method = 'update';
//     //Ajax Load data from ajax
//     $.ajax({
//         url : base_url + 'master_user/edit_user',
//         type: "POST",
//         dataType: "JSON",
//         data : {id:id},
//         success: function(data)
//         {
//             // data.data_menu.forEach(function(dataLoop) {
//             //     $("#parent_menu").append('<option value = '+dataLoop.id+' class="append-opt">'+dataLoop.nama+'</option>');
//             // });
//             $('#div_pass_lama').css("display","block");
//             $('#div_preview_foto').css("display","block");
//             $('#div_skip_password').css("display", "block");
//             $('[name="id_user"]').val(data.old_data.id);
//             $('[name="username"]').val(data.old_data.username).attr('disabled', true);
//             $('[name="role"]').val(data.old_data.id_role);
//             $('[name="status"]').val(data.old_data.status);
//             $("#pegawai").val(data.old_data.id_pegawai).trigger("change");
//             $('#preview_img').attr('src', 'data:image/jpeg;base64,'+data.foto_encoded);
//             $('#modal_user_form').modal('show');
// 	        $('#modal_title').text('Edit User'); 

//         },
//         error: function (jqXHR, textStatus, errorThrown)
//         {
//             alert('Error get data from ajax');
//         }
//     });
// }


function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}

function reset_modal_form_import()
{
    $('#form_import_excel')[0].reset();
    $('#label_file_excel').text('Pilih file excel yang akan diupload');
}

function import_excel(){
    $('#modal_import_excel').modal('show');
	$('#modal_import_title').text('Import data user'); 
}

function import_data_excel(){
    var form = $('#form_import_excel')[0];
    var data = new FormData(form);
    
    $("#btnSaveImport").prop("disabled", true);
    $('#btnSaveImport').text('Import Data');
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: base_url + 'master_user/import_data_master',
        data: data,
        dataType: "JSON",
        processData: false, // false, it prevent jQuery form transforming the data into a query string
        contentType: false, 
        success: function (data) {
            if(data.status) {
                swal.fire("Sukses!!", data.pesan, "success");
                $("#btnSaveImport").prop("disabled", false);
                $('#btnSaveImport').text('Simpan');
            }else {
                swal.fire("Gagal!!", data.pesan, "error");
                $("#btnSaveImport").prop("disabled", false);
                $('#btnSaveImport').text('Simpan');
            }

            reset_modal_form_import();
            $(".modal").modal('hide');
            table.ajax.reload();
        },
        error: function (e) {
            console.log("ERROR : ", e);
            $("#btnSaveImport").prop("disabled", false);
            $('#btnSaveImport').text('Simpan');

            reset_modal_form_import();
            $(".modal").modal('hide');
            table.ajax.reload();
        }
    });
}

function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#div_preview_foto').css("display","block");
        $('#preview_img').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    } else {
        $('#div_preview_foto').css("display","none");
        $('#preview_img').attr('src', '');
    }
}