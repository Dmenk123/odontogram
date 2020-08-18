<!-- DataTables -->
<script src="<?=config_item('assets')?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=config_item('assets')?>plugins/datatables/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
	var save_method; //for save method string
	var table;

$(document).ready(function() {
	//datatables
	table = $('#tabelSetGaji').DataTable({
		
		"processing": true, //feature control the processing indicator
		"serverSide": true, //feature control DataTables server-side processing mode
		"order":[], //initial no order

		//load data for table content from ajax source
		"ajax": {
			"url": "<?php echo site_url('set_gaji_guru/list_data') ?>",
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

    //select2
    $("#jabatan").select2({
        ajax: {
            url: '<?php echo site_url('set_gaji_guru/suggest_jabatan'); ?>',
            dataType: 'json',
            type: "GET",
            data: function (params) {
                var queryParameters = {
                    term: params.term
                }
                return queryParameters;
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.text,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }, 
    });

    $('#jabatan').on('change', function() {
        var data = $("#jabatan option:selected").val();
        //Ajax Load data from ajax
        $.ajax({
            url : "<?php echo site_url('set_gaji_guru/get_tunjangan')?>/" + data,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('#tunjangan').maskMoney('mask', parseInt(data.tunjangan));
                $("#tunjangan_raw").val(data.tunjangan);

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });

    });

    //mask money
    $('.mask-currency').maskMoney({
        precision: 0
    });
    
	//set input/textarea/select event when change value, remove class error and remove text help block
	$("input").change(function() {
		$(this).parent().parent().removeClass('has-error');
		$(this).next().empty();
	});

});	

function add_data() 
{
    save_method = 'add';
    $('#form')[0].reset(); //reset form on modals
    $('.form-group').removeClass('has-error');//clear error class
    $('.help-block').empty(); //clear error string
    $('#modal_form').modal('show'); //show bootstrap modal
    $('.modal-title').text('Add Setting Gaji'); //set title modal
}

function edit_data(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('set_gaji_guru/edit/')?>" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            //ambil data ke json->modal
            $('[name="id"]').val(data.id);
            //$('#jabatan').select2('data', {id: data.id_jabatan, text: data.nama_jabatan});
            var $newOption = $("<option selected='selected'></option>").val(data.id_jabatan).text(data.nama_jabatan)
            $("#jabatan").append($newOption).trigger('change');
            //$("#jabatan").val(data.id_jabatan).trigger('change');
            
            $('[name="gapok"]').maskMoney('mask', parseInt(data.gaji_pokok));
            $('[name="gapok_raw"]').val(data.gaji_pokok);

            $('[name="gaperjam"]').maskMoney('mask', parseInt(data.gaji_perjam));
            $('[name="gaperjam_raw"]').val(data.gaji_perjam);

            $('[name="tunjangan"]').maskMoney('mask', parseInt(data.gaji_tunjangan_jabatan));
            $('[name="tunjangan_raw"]').val(data.gaji_tunjangan_jabatan);

            $("#tipepeg").val(data.is_guru);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Setting Gaji'); // Set title to Bootstrap modal title

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
        url = "<?php echo site_url('set_gaji_guru/add_data')?>";
        tipe_simpan = 'tambah';
    } else {
        url = "<?php echo site_url('set_gaji_guru/update_data')?>";
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
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    if (data.inputerror[i] != 'jabatan') {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }else{
                        $($('#jabatan').data('select2').$container).parent().parent().addClass('has-error');
                    }   
                }
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

function delete_data(id)
{
    if(confirm('Yakin Hapus Data Ini ?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('set_gaji_guru/delete_data')?>/"+id,
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


function setTunjanganRaw() {  
  var harga = $('#tunjangan').maskMoney('unmasked')[0];
  //set harga raw
  $('#tunjangan_raw').val(harga);
} 

function setGapokRaw() {
    var harga = $('#gapok').maskMoney('unmasked')[0];
    //set harga raw
    $('#gapok_raw').val(harga);
}

function setGaperjamRaw() {
    var harga = $('#gaperjam').maskMoney('unmasked')[0];
    //set harga raw
    $('#gaperjam_raw').val(harga);
}
</script>	