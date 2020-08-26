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
        reset_modal_form();
    });
});	

function add_menu()
{
    reset_modal_form();
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

function edit_menu(id)
{
    reset_modal_form();
    save_method = 'update';
    //Ajax Load data from ajax
    $.ajax({
        url : base_url + 'set_menu/edit_menu',
        type: "POST",
        dataType: "JSON",
        data : {id:id},
        success: function(data)
        {
            data.data_menu.forEach(function(dataLoop) {
                $("#parent_menu").append('<option value = '+dataLoop.id+' class="append-opt">'+dataLoop.nama+'</option>');
            });

            $('[name="id_menu"]').val(data.old_data.id);
            $('[name="nama_menu"]').val(data.old_data.nama);
            $('[name="judul_menu"]').val(data.old_data.judul);
            $('[name="link_menu"]').val(data.old_data.link);
            $('[name="icon_menu"]').val(data.old_data.icon);
            $('[name="tingkat_menu"]').val(data.old_data.tingkat);
            $('[name="urutan_menu"]').val(data.old_data.urutan);
            $('[name="aktif_menu"]').val(data.old_data.aktif);
            $('[name="add_button"]').val(data.old_data.add_button);
            $('[name="edit_button"]').val(data.old_data.edit_button);
            $('[name="delete_button"]').val(data.old_data.delete_button);
            $('[name="parent_menu"]').val(data.old_data.id_parent);
            
            // $('#user_level').val(data.id_level_user);
            // $('[name="userTgllhr"]').datepicker({dateFormat: 'dd-mm-yyyy'}).datepicker('setDate', data.tgl_lahir_user);
            // var selectedIdProvinsi = $("<option></option>").val(data.id_provinsi).text(data.nama_provinsi);
            // var selectedIdkota = $("<option></option>").val(data.id_kota).text(data.nama_kota);
            // var selectedIdkecamatan = $("<option></option>").val(data.id_kecamatan).text(data.nama_kecamatan);
            // var selectedIdkelurahan = $("<option></option>").val(data.id_kelurahan).text(data.nama_kelurahan);

            // //tanpa trigger event
            // $('[name="userProvinsi"]').append(selectedIdProvinsi);
            // $('[name="userKota"]').append(selectedIdkota);
            // $('[name="userKecamatan"]').append(selectedIdkecamatan);
            // $('[name="userKelurahan"]').append(selectedIdkelurahan);

            $('#modal_menu_form').modal('show');
	        $('#modal_title').text('Edit Menu'); 

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
        url = base_url + 'set_menu/add_data_menu';
        txtAksi = 'Tambah Menu';
    }else{
        url = base_url + 'set_menu/update_data_menu';
        txtAksi = 'Edit Menu';
    }
    
    var form = $('#form-menu')[0];
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
                    if (data.inputerror[i] != 'jabatan') {
                        $('[name="'+data.inputerror[i]+'"]').addClass('is-invalid');
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]).addClass('invalid-feedback'); //select span help-block class set text error string
                    }else{
                        $($('#jabatan').data('select2').$container).addClass('has-error');
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

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax
}

function reset_modal_form()
{
    $('#form-menu')[0].reset();
    $('.append-opt').remove(); 
    $('div.form-group').children().removeClass("is-invalid invalid-feedback");
    $('span.help-block').text('');
}