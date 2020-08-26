var save_method;
var table;

$(document).ready(function() {

    //force integer input in textfield
    $('input.numberinput').bind('keypress', function (e) {
        return (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 46) ? false : true;
    });

	//datatables
	table = $('#tabel_menu').DataTable({
		responsive: true,
        searchDelay: 500,
        processing: true,
        serverSide: true,
		ajax: {
			url  : base_url + "set_menu/list_menu",
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
            title: 'Ubah Status Data Menu ?',
            text: "Apakah Anda Yakin ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Ubah Status!',
            cancelButtonText: 'Tidak, Batalkan!',
            reverseButtons: true
          }).then((result) => {
            if (result.value) {
                $.ajax({
                    url : base_url + 'set_menu/edit_status_menu/'+ id,
                    type: "POST",
                    dataType: "JSON",
                    data : {status : status},
                    success: function(data)
                    {
                        swalConfirm.fire(
                            'Berhasil Ubah Status Menu!',
                            data.pesan,
                            'success'
                        );

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
        $('#form-add-menu')[0].reset();
        $('.append-opt').remove(); 
    });
});	

function add_menu()
{
    save_method = 'add';
	$('#modal_menu_form').modal('show');
	$('#modal_title').text('Tambah Menu Baru'); 
    //append select option
    var url = base_url+"set_menu/get_parent_data";
    $.ajax({
        type: "GET",
        // enctype: 'multipart/form-data',
        url: url,
        // data: data,
        dataType: "JSON",
        processData: false, // false, it prevent jQuery form transforming the data into a query string
        contentType: false, 
        cache: false,
        timeout: 600000,
        success: function (data) {
            if (data.status) {
                data.data.forEach(function(dataLoop) {
                    $("#parent_menu").append('<option value = '+dataLoop.id+' class="append-opt">'+dataLoop.nama+'</option>');
                });
            }
        }
    });
}

function edit_user(id)
{
    save_method = 'update';
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('master_user_adm/edit_data_user')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            //ambil data ke json->modal
            $('[name="userId"]').val(data.id_user);
            $('[name="userFname"]').val(data.fname_user);
            $('[name="userLname"]').val(data.lname_user);
            $('[name="userEmail"]').val(data.email);
            $('[name="userPassword"]').val(data.password);
            $('[name="userAlamat"]').val(data.alamat_user);
            $('[name="userTelp"]').val(data.no_telp_user);
            $('[name="userKdpos"]').val(data.kode_pos);
            
            $('#user_level').val(data.id_level_user);
            $('[name="userTgllhr"]').datepicker({dateFormat: 'dd-mm-yyyy'}).datepicker('setDate', data.tgl_lahir_user);
            var selectedIdProvinsi = $("<option></option>").val(data.id_provinsi).text(data.nama_provinsi);
            var selectedIdkota = $("<option></option>").val(data.id_kota).text(data.nama_kota);
            var selectedIdkecamatan = $("<option></option>").val(data.id_kecamatan).text(data.nama_kecamatan);
            var selectedIdkelurahan = $("<option></option>").val(data.id_kelurahan).text(data.nama_kelurahan);
            //tanpa trigger event
            $('[name="userProvinsi"]').append(selectedIdProvinsi);
            $('[name="userKota"]').append(selectedIdkota);
            $('[name="userKecamatan"]').append(selectedIdkecamatan);
            $('[name="userKelurahan"]').append(selectedIdkelurahan);

            $('#modal_user_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit User'); // Set title to Bootstrap modal title

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

    if(save_method == 'add') {
        url = base_url + 'set_menu/add_data_menu';
    }else{
        url = base_url + 'set_menu/update_data_menu';
    }
    
    var form = $('#form-menu')[0];
    var data = new FormData(form);
    
    $("#btnSave").prop("disabled", true);
    $('#btnSave').text('saving...'); //change button text
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
                reload_table();
            }else {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    if (data.inputerror[i] != 'jabatan') {
                        $('[name="'+data.inputerror[i]+'"]').parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }else{
                        $($('#jabatan').data('select2').$container).addClass('has-error');
                    }
                }
            }

            // if (data.status) {
            //     alert(data.pesan);
            //     $("#btnSave").prop("disabled", false);
            //     $("#btnSave").text('Save'); //change button text
            //     $('#modal_menu_form').modal('hide');
            //     reload_table();
            // }
        },
        error: function (e) {
            console.log("ERROR : ", e);
            $("#btnSave").prop("disabled", false);
        }
    });
}

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax
}