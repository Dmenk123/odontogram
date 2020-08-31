var save_method;
var table;

$(document).ready(function() {

    //force integer input in textfield
    $('input.numberinput').bind('keypress', function (e) {
        return (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 46) ? false : true;
    });

	//datatables
	table = $('#tabel_pegawai').DataTable({
		responsive: true,
        searchDelay: 500,
        processing: true,
        serverSide: true,
		ajax: {
			url  : base_url + "master_pegawai/list_pegawai",
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
                    url : base_url + 'master_pegawai/edit_status_pegawai/'+ id,
                    type: "POST",
                    dataType: "JSON",
                    data : {status : status},
                    success: function(data)
                    {
                        swalConfirm.fire('Berhasil Ubah Status Pegawai!', data.pesan, 'success');
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
        reset_modal_form();
    });
});	

function add_pegawai()
{
    reset_modal_form();
    save_method = 'add';
	$('#modal_pegawai_form').modal('show');
	$('#modal_title').text('Tambah Pegawai Baru'); 
}

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
            $('[name="id_user"]').val(data.old_data.id);
            $('[name="username"]').val(data.old_data.username).attr('disabled', true);
            $('[name="role"]').val(data.old_data.id_role);
            $('[name="status"]').val(data.old_data.status);
            $('#modal_user_form').modal('show');
	        $('#modal_title').text('Edit User'); 

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
    var url;
    var txtAksi;

    if(save_method == 'add') {
        url = base_url + 'master_pegawai/add_data_pegawai';
        txtAksi = 'Tambah Pegawai';
    }else{
        url = base_url + 'master_pegawai/update_data_pegawai';
        txtAksi = 'Edit Pegawai';
    }
    
    var form = $('#form-pegawai')[0];
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
                    if (data.inputerror[i] != 'jabatans') {
                        $('[name="'+data.inputerror[i]+'"]').addClass('is-invalid');
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]).addClass('invalid-feedback'); //select span help-block class set text error string
                    }else{
                        $($('#jabatans').data('select2').$container).addClass('has-error');
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

function reset_modal_form()
{
    $('#form-pegawai')[0].reset();
    $('.append-opt').remove(); 
    $('div.form-group').children().removeClass("is-invalid invalid-feedback");
    $('span.help-block').text('');
    $('#div_pass_lama').css("display","none");
}