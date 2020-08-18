<!-- DataTables -->
<script src="<?=config_item('assets')?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=config_item('assets')?>plugins/datatables/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
	var save_method; //for save method string
	var table;
    var table2;

$(document).ready(function() {
	//datatables
	table = $('#tabelData').DataTable();

    table2 = $('#tabelData2').DataTable();

    //select2
    $("#namapeg").select2({
        ajax: {
            url: '<?php echo site_url('proses_gaji/suggest_guru'); ?>',
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

    $('#namapeg').on('change', function() {
        var data = $("#namapeg option:selected").val();
        //Ajax Load data from ajax
        $.ajax({
            url : "<?php echo site_url('proses_gaji/get_data_guru')?>/" + data,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $("#statuspeg").val(data.statuspeg);
                $("#statuspeg_raw").val(data.is_guru);

                $("#jabatanpeg").val(data.nama_jabatan);
                $("#jabatanpeg_raw").val(data.kode_jabatan);
                
                $('#gapok').maskMoney('mask', parseInt(data.gaji_pokok));
                $("#gapok_raw").val(data.gaji_pokok);
                
                $('#gaperjam').maskMoney('mask', parseInt(data.gaji_perjam));
                $("#gaperjam_raw").val(data.gaji_perjam);

                $('#tunjangan').maskMoney('mask', parseInt(data.gaji_tunjangan_jabatan));
                $("#tunjangan_raw").val(data.gaji_tunjangan_jabatan);

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

     //force integer input in textfield
    $('input.numberinput').bind('keypress', function (e) {
        return (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 46) ? false : true;
    });

	//set input/textarea/select event when change value, remove class error and remove text help block
	$("input").change(function() {
		$(this).parent().parent().removeClass('has-error');
		$(this).next().empty();
	});

    //tabs
    var hash = window.location.hash;
    hash && $('ul.nav a[href="' + hash + '"]').tab('show');

    $('.nav-tabs a').click(function (e) {
        $(this).tab('show');
        var scrollmem = $('body').scrollTop();
        window.location.hash = this.hash;
        $('html,body').scrollTop(scrollmem);
    });

});	

function add_data() 
{
    save_method = 'add';
    $('#form')[0].reset(); //reset form on modals
    $('.form-group').removeClass('has-error');//clear error class
    $('.help-block').empty(); //clear error string
    $('#modal_form').modal('show'); //show bootstrap modal
    $('.modal-title').text('Proses Penggajian'); //set title modal
    $('#btnSave').removeClass('hidden');
}

function detail_data(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#btnSave').addClass('hidden');

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('proses_gaji/edit/')?>" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            //ambil data ke json->modal
            $('[name="id"]').val(data.id);
            $('#bulan').val(data.bulan);
            $('#tahun').val(data.tahun);

            var $newOption = $("<option selected='selected'></option>").val(data.id_guru).text(data.nama_guru)
            $("#namapeg").append($newOption).trigger('change');
            $('#statuspeg_raw').val(data.is_guru);
            $('#jabatanpeg_raw').val(data.id_jabatan);

            $('[name="gapok"]').maskMoney('mask', parseInt(data.gaji_pokok));
            $('[name="gapok_raw"]').val(data.gaji_pokok);

            $('[name="gaperjam"]').maskMoney('mask', parseInt(data.gaji_perjam));
            $('[name="gaperjam_raw"]').val(data.gaji_perjam);

            $('[name="tunjangan"]').maskMoney('mask', parseInt(data.gaji_tunjangan_jabatan));
            $('[name="tunjangan_raw"]').val(data.gaji_tunjangan_jabatan);

            $('[name="tunjanganlain"]').maskMoney('mask', parseInt(data.gaji_tunjangan_lain));
            $('[name="tunjanganlain_raw"]').val(data.gaji_tunjangan_lain);

            $('[name="potongan"]').maskMoney('mask', parseInt(data.potongan_lain));
            $('[name="potongan_raw"]').val(data.potongan_lain);

            $('#jumlahjam').val(data.jumlah_jam_kerja);

            $('[name="totalgaji"]').maskMoney('mask', parseInt(data.total_take_home_pay));
            $('[name="totalgaji_raw"]').val(data.total_take_home_pay);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Detail Proses Gaji'); // Set title to Bootstrap modal title

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

function reload_table2()
{
    table2.ajax.reload(null,false); //reload datatable ajax 
}

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
        url = "<?php echo site_url('proses_gaji/add_data')?>";
        tipe_simpan = 'tambah';
    } else {
        url = "<?php echo site_url('proses_gaji/update_data')?>";
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
                if (data.pesan) {
                    alert(data.pesan);
                    $('#modal_form').modal('hide');
                    reload_table(); 
                }else{
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

function konfirmGaji(id)
{
    if(confirm('Yakin Konfirmasi Data Ini ?'))
    {
        $.ajax({
            url : "<?php echo site_url('konfirm_gaji/proses_konfirmasi')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                alert(data.pesan);
                location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Gagal Konfirmasi Gaji');
            }
        });

    }
}

function hapusKonfirmGaji(id)
{
    if(confirm('Yakin Hapus Data Ini ?'))
    {
        $.ajax({
            url : "<?php echo site_url('konfirm_gaji/delete_konfirmasi')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                alert(data.pesan);
                location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Gagal Hapus data');
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

function setTunjanganLainRaw() {
    var harga = $('#tunjanganlain').maskMoney('unmasked')[0];
    //set harga raw
    $('#tunjanganlain_raw').val(harga);
}

function setPotonganRaw() {
    var harga = $('#potongan').maskMoney('unmasked')[0];
    //set harga raw
    $('#potongan_raw').val(harga);
};

function setGajiTotal() {
    var gapok = $('#gapok').maskMoney('unmasked')[0];
    var gaperjam = $('#gaperjam').maskMoney('unmasked')[0];
    var tunjangan = $('#tunjangan').maskMoney('unmasked')[0];
    var tunjanganlain = $('#tunjanganlain').maskMoney('unmasked')[0];
    var potongan = $('#potongan').maskMoney('unmasked')[0];
    var gaperjamfix = parseInt($('#jumlahjam').val() * gaperjam);
    var totalHarga = parseInt(gapok + gaperjamfix + tunjangan + tunjanganlain - potongan);

    //set harga total masked
    $('#totalgaji').maskMoney('mask', totalHarga);
    //set harga raw
    $('#totalgaji_raw').val(totalHarga); 
}
</script>	