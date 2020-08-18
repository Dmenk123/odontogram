<!-- DataTables -->
<script src="<?=config_item('assets')?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=config_item('assets')?>plugins/datatables/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
	var save_method; //for save method string
	var table;

$(document).ready(function() {
	//datatables
	table = $('#tabelSatuan').DataTable({
		
		"processing": true, //feature control the processing indicator
		"serverSide": true, //feature control DataTables server-side processing mode
		"order":[], //initial no order
        "lengthMenu": [ [25, 50, 100, -1], [25, 50, 100, "All"] ],
		//load data for table content from ajax source
		"ajax": {
			"url": "<?php echo site_url('master_akun_eksternal/list_akun_eksternal') ?>",
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

	//set input/textarea/select event when change value, remove class error and remove text help block
	$("input").change(function() {
		$(this).parent().parent().removeClass('has-error');
		$(this).next().empty();
	});

    //select2
    $( "#kat_akun" ).select2({ 
        ajax: {
        url: '<?php echo site_url('master_akun_eksternal/get_kategori_akun'); ?>/',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results: data
            };
        },
        cache: true
        },
    });

    $('#kat_akun').on('change', function() {
        var data = $("#kat_akun option:selected").val();
        $('.append-opt').remove();
        //Ajax Load data from ajax
        $.ajax({
            url : "<?php echo site_url('master_akun_eksternal/get_data_subakun')?>/" + data,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                key = 0;
                Object.keys(data).forEach(function(){
                    var option = $('<option value="'+data[key].kode_in_text+'" class="append-opt">'+data[key].nama+'</option>');
                    $('#sub_akun').append(option);
                    key += 1;  
                });
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });

    });

    $('#modal_form').on('hidden.bs.modal', function () {
        $(this).find("input,textarea,select").val('').end();
        $('#form')[0].reset();
        $('.panel-pesan-error').text('');
    });
});	

function add_akun() 
{
    save_method = 'add';
    $('#form')[0].reset(); //reset form on modals
    $('.form-group').removeClass('has-error');//clear error class
    $('.help-block').empty(); //clear error string
    $('#modal_form').modal('show'); //show bootstrap modal
    $('.modal-title').text('Add Akun'); //set title modal

}

function edit_akun(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('.append-opt').remove();

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('master_akun_eksternal/edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            //ambil data ke json->modal
            $('[name="id"]').val(data.id);
            $('[name="nama"]').val(data.nama);
            //select2 append
            var $newOption = $("<option selected='selected'></option>").val(data.kat_id).text(data.kat_text)
            $('[name="kat_akun"]').append($newOption).trigger('change');

            // select option append
            if (data.kat_val_sub != null && data.kat_nama_sub != null) {
                var option = $('<option value="'+data.kat_val_sub+'" class="append-opt">'+data.kat_nama_sub+'</option>');
                $('#sub_akun').append(option);
                $("#sub_akun").val(data.kat_val_sub);    
            }
            
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Master Akun Eksternal'); // Set title to Bootstrap modal title

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
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
        url = "<?php echo site_url('master_akun_eksternal/add')?>";
        tipe_simpan = 'tambah';
    } else {
        url = "<?php echo site_url('master_akun_eksternal/update')?>";
        tipe_simpan = 'update';
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                alert(data.pesan);
                $('#modal_form').modal('hide');
                reload_table();
            }
            else
            {
                var kampos = "";
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    //$('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    //$('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    kampos += "<p class='bg-red-active'>"+data.error_string[i]+"</p>";
                }

                $('.panel-pesan-error').html(kampos);
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}

function delete_akun(id)
{
    if(confirm('Yakin Hapus Data Ini ?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('master_akun_eksternal/delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                alert(data.pesan);
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}
</script>	