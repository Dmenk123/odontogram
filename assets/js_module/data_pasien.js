var save_method;
var table;

$(document).ready(function() {

    //force integer input in textfield
    $('input.numberinput').bind('keypress', function (e) {
        return (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 46) ? false : true;
    });

	//datatables
	table = $('#tabel_index').DataTable({
		responsive: true,
        searchDelay: 500,
        processing: true,
        serverSide: true,
		ajax: {
			url  : base_url + "data_pasien/list_pasien",
			type : "POST" 
		},

		//set column definition initialisation properties
		columnDefs: [
			{
				targets: [-1], //last column
				orderable: false, //set not orderable
			},
		],
    });
    

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
        reset_modal_form_import();
    });

    $('#alergi_obat').change(function (e) { 
        e.preventDefault();
        if($(this).val() == '1') {
            $('[name="alergi_obat_val"]').attr('disabled', false).val('');
        }else{
            $('[name="alergi_obat_val"]').attr('disabled', true).val('');
        }
    });

    $('#alergi_makanan').change(function (e) { 
        e.preventDefault();
        if($(this).val() == '1') {
            $('[name="alergi_makanan_val"]').attr('disabled', false).val('');
        }else{
            $('[name="alergi_makanan_val"]').attr('disabled', true).val('');
        }
    });

    $("#cek_manual").change(function() {
        if(this.checked) {
            $('[name="no_rm"]').attr('disabled', false).val('');
        }else{
            $('[name="no_rm"]').attr('disabled', true).val('');
        }
    });

    $('.mask_tanggal').mask("00/00/0000", {placeholder: "DD/MM/YYYY"});
    $('.mask_rm').mask("AA.00.00");
});	

function edit_user(id)
{
    reset_modal_form();
    save_method = 'update';
    //Ajax Load data from ajax
    $.ajax({
        url : base_url + 'master_user/edit_user',
        type: "POST",
        dataType: "JSON",
        data : {id:id},
        success: function(data)
        {
            // data.data_menu.forEach(function(dataLoop) {
            //     $("#parent_menu").append('<option value = '+dataLoop.id+' class="append-opt">'+dataLoop.nama+'</option>');
            // });
            $('#div_pass_lama').css("display","block");
            $('#div_preview_foto').css("display","block");
            $('#div_skip_password').css("display", "block");
            $('[name="id_user"]').val(data.old_data.id);
            $('[name="username"]').val(data.old_data.username).attr('disabled', true);
            $('[name="role"]').val(data.old_data.id_role);
            $('[name="status"]').val(data.old_data.status);
            $("#pegawai").val(data.old_data.id_pegawai).trigger("change");
            $('#preview_img').attr('src', 'data:image/jpeg;base64,'+data.foto_encoded);
            $('#modal_user_form').modal('show');
	        $('#modal_title').text('Edit User'); 

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function detail_user(id) {
    $.ajax({
        url : base_url + 'master_user/edit_user',
        type: "POST",
        dataType: "JSON",
        data : {id:id},
        success: function(data)
        {
            $('#username_det').text(data.old_data.id);
            $('#pegawai_det').text(data.old_data.username);
            $('#role_det').text(data.old_data.id_role);
            $('#status_det').text(data.old_data.status);
            $('#preview_img_det').attr('src', 'data:image/jpeg;base64,'+data.foto_encoded);
            $('#modal_user_detail').modal('show');
	        $('#modal_title_det').text('Detail User'); 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}

function save()
{
    var form = $('#form_pasien')[0];
    var data = new FormData(form);
    
    $("#btnSave").prop("disabled", true);
    $('#btnSave').text('Menyimpan Data'); //change button text
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: base_url + 'data_pasien/simpan_data',
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
                window.location.href = base_url+"data_registrasi/add";
            }else {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    if (data.inputerror[i] != 'pegawai') {
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

function delete_user(id){
    swalConfirmDelete.fire({
        title: 'Hapus Data User ?',
        text: "Data Akan dihapus permanen ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus Data !',
        cancelButtonText: 'Tidak, Batalkan!',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
            $.ajax({
                url : base_url + 'master_user/delete_user',
                type: "POST",
                dataType: "JSON",
                data : {id:id},
                success: function(data)
                {
                    swalConfirm.fire('Berhasil Hapus User!', data.pesan, 'success');
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
