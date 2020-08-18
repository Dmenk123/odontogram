<script type="text/javascript">
	var save_method; //for save method string
	var table;

$(document).ready(function() {

    //force integer input in textfield
    $('input.numberinput').bind('keypress', function (e) {
        return (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 46) ? false : true;
    });

	//datatables
	table = $('#tabelMenu').DataTable({
		
		"processing": true, //feature control the processing indicator
		"serverSide": true, //feature control DataTables server-side processing mode
		"order":[], //initial no order

		//load data for table content from ajax source
		"ajax": {
			"url": "<?php echo site_url('set_menu_adm/list_menu') ?>",
			"type": "POST" 
		},

		//set column definition initialisation properties
		"columnDefs": [
			{
				"targets": [-1], //last column
				"orderable": false, //set not orderable
			},
		],
	});

    //change menu status
    $(document).on('click', '.btn_edit_status', function(){
        if(confirm('Apakah anda yakin ubah status Menu ini ?'))
        {
            var id = $(this).attr('id');
            var status = $(this).val();
            // ajax delete data to database
            $.ajax({
                url : "<?php echo site_url('set_menu_adm/edit_status_menu')?>/"+id,
                type: "POST",
                dataType: "JSON",
                data : {status : status},
                success: function(data)
                {
                    alert(data.pesan);
                    //reload_table();
                    location.reload();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error update data');
                }
            });
        }   
    });

    //validasi form add menu
    $("[name='form-add-menu']").validate({
        // Specify validation rules
        errorElement: 'span',
        /*errorLabelContainer: '.errMsg',*/
        errorPlacement: function(error, element) {
            if (element.attr("name") == "nama_menu") {
                error.insertAfter(".lblNamaErr");
            } else if (element.attr("name") == "judul_menu") {
                error.insertAfter(".lblJudulErr");
            } else if (element.attr("name") == "link_menu") {
                error.insertAfter(".lblLinkErr");
            } else if (element.attr("name") == "tingkat_menu") {
                error.insertAfter(".lblTingkatErr");
            } else if (element.attr("name") == "urutan_menu") {
                error.insertAfter(".lblUrutErr");
            } else {
                error.insertAfter(element);
            }
        },
            rules:{
                nama_menu: "required",
                judul_menu: "required",
                link_menu: "required",
                tingkat_menu: "required",
                urutan_menu: "required"
            },
            // Specify validation error messages
            messages: {
                nama_menu: " (Harus diisi !!)",
                judul_menu: " (Harus diisi !!)",
                link_menu: " (Harus diisi !!)",
                tingkat_menu: " (Harus diisi !!)",
                urutan_menu: " (Harus diisi !!)"
            },
            submitHandler: function(form) {
              form.submit();
            }
    });

    $(".modal").on("hidden.bs.modal", function(){
        $('#form-add-menu')[0].reset();
        $('.append-opt').remove(); 
    });
});	

function add_menu()
{
    save_method = 'add';
	$('#modal_menu_form').modal('show'); //show bootstrap modal
	$('.modal-title').text('Add Menu'); //set title modal
    //append select option
    var url = "<?php echo site_url('set_menu_adm/get_parent_data')?>";
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
                    $("#id_parent").append('<option value = '+dataLoop.id_menu+' class="append-opt">'+dataLoop.nama_menu+'</option>');
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
        url = "<?php echo site_url('set_menu_adm/add_data_menu')?>";
    }
    // ajax adding data to database
    var IsValid = $("form[name='form-add-menu']").valid();
    if(IsValid)
    {
        var form = $('#form-add-menu')[0];
        // Create an FormData object
        var data = new FormData(form);
        // disabled the save button
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
                if (data.status) {
                    alert(data.pesan);
                    $("#btnSave").prop("disabled", false);
                    $("#btnSave").text('Save'); //change button text
                    $('#modal_menu_form').modal('hide');
                    reload_table();
                }
            },
            error: function (e) {
                console.log("ERROR : ", e);
                $("#btnSave").prop("disabled", false);
            }
        });
    } 
}

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax
}
</script>	