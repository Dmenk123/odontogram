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
			url  : base_url + "data_pasien/list_data",
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
            title: 'Ubah Status Data Pasien ?',
            text: "Apakah Anda Yakin ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Ubah Status!',
            cancelButtonText: 'Tidak, Batalkan!',
            reverseButtons: true
          }).then((result) => {
            if (result.value) {
                $.ajax({
                    url : base_url + 'data_pasien/edit_status_aktif',
                    type: "POST",
                    dataType: "JSON",
                    data : {status : status, id : id},
                    success: function(data)
                    {
                        swalConfirm.fire('Berhasil Ubah Status Pasien!', data.pesan, 'success');
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

    $("#nama").select2({
        // tags: true,
        //multiple: false,
        tokenSeparators: [',', ' '],
        minimumInputLength: 2,
        minimumResultsForSearch: 10,
        ajax: {
            url: base_url+'reg_pasien/get_select_pasien',
            dataType: "json",
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
                            id: item.id,
                            no_rm: item.no_rm,
                            nik: item.nik,
                            tempat_lahir: item.tempat_lahir,
                            tanggal_lahir: item.tanggal_lahir,
                            umur: item.umur,
                            pemetaan: item.pemetaan
                        }
                    })
                };
            }
        }
    });

    $('#nama').on('select2:selecting', function(e) {
        let data = e.params.args.data;
        $('#nik').val(data.nik);
        $('#no_rm').val(data.no_rm);
        $('#tempat_lahir').val(data.tempat_lahir);
        let tgl_lhr = data.tanggal_lahir;
        $('#tanggal_lahir').val(tgl_lhr.split("-").reverse().join("/"));
        $('#umur_reg').val(data.umur);
        $('#pemetaan').val(data.pemetaan);
    });

    $("#dokter").select2({
        // tags: true,
        //multiple: false,
        tokenSeparators: [',', ' '],
        minimumInputLength: 2,
        minimumResultsForSearch: 10,
        ajax: {
            url: base_url+'reg_pasien/get_select_dokter',
            dataType: "json",
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
                            id: item.id,
                        }
                    })
                };
            }
        }
    });

    $('.mask_tanggal').mask("00/00/0000", {placeholder: "DD/MM/YYYY"});
    // minimum setup

    $('#jam_reg').timepicker({
        minuteStep: 1,
        defaultTime: time_now(),
        showSeconds: true,
        showMeridian: false,
        snapToStep: true
    });

    $('.mask_rm').mask("AA.00.00");

    $('#jenis_penjamin').change(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: base_url+"reg_pasien/get_data_form_penjamin",
            data: {jenis_penjamin : $(this).val()},
            dataType: "json",
            success: function (response) {
                $('#div-append-form').html(response);
            }
        });
    });
});

function clear_input_pasien() {
    $('#nik').val('');
    $('#no_rm').val('');
    $('#tempat_lahir').val('');
    $('#tanggal_lahir').val('');
}

function detail_pasien(id) {
    $.ajax({
        url : base_url + 'data_pasien/detail_pasien',
        type: "POST",
        dataType: "JSON",
        data : {id:id},
        success: function(data)
        {
            $('#no_rm_det').text(data.old_data.no_rm);
            $('#nik_det').text(data.old_data.nik);
            $('#pasien_det').text(data.old_data.nama);
            $('#ttl_det').text(function () {
                let tgl =  data.old_data.tanggal_lahir;
                return data.old_data.tempat_lahir+' / '+tgl.split("-").reverse().join("-");
            });
            $('#jenkel_det').text(data.old_data.jenkel);
            $('#alamat_rmh_det').text(data.old_data.alamat_rumah);
            $('#alamat_ktr_det').text(data.old_data.alamat_kantor);
            $('#suku_det').text(data.old_data.suku);
            $('#pekerjaan_det').text(data.old_data.pekerjaan);
            $('#hp_det').text(data.old_data.hp);
            $('#telp_det').text(data.old_data.telp_rumah);

            $('#goldarah_det').text(data.old_data.gol_darah);
            $('#tekanandarah_det').text(data.old_data.tekanan_darah+' ('+data.old_data.tekanan_darah_val+')');
            $('#jantung_det').text(handle_boolean(data.old_data.penyakit_jantung));
            $('#diabetes_det').text(handle_boolean(data.old_data.diabetes));
            $('#hepatitis_det').text(handle_boolean(data.old_data.hepatitis));
            $('#haemopilia_det').text(handle_boolean(data.old_data.haemopilia));
            $('#gastring_det').text(handle_boolean(data.old_data.gastring));
            $('#penyakitlain_det').text(handle_boolean(data.old_data.penyakit_lainnya));
            $('#alergiobat_det').text(function () {
                let strAlergiObat;
                if(data.old_data.alergi_obat == '1'){
                    strAlergiObat = 'Ya';
                }else{
                    strAlergiObat = 'Tidak';
                }

                if(data.old_data.alergi_obat_val){
                    return strAlergiObat+', '+data.old_data.alergi_obat_val;
                }else{
                    return strAlergiObat;
                }
            });
            $('#alergimakan_det').text(function () {
                let strAlergiMakan;
                if(data.old_data.alergi_makanan == '1'){
                    strAlergiMakan = 'Ya';
                }else{
                    strAlergiMakan = 'Tidak';
                }

                if(data.old_data.alergi_makanan_val){
                    return strAlergiMakan+', '+data.old_data.alergi_makanan_val;
                }else{
                    return strAlergiMakan;
                }
            });
            $('#modal_detail').modal('show');
	        $('#modal_title_det').text('Detail Pasien'); 
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

function delete_pasien(id){
    swalConfirmDelete.fire({
        title: 'Hapus Data Pasien ?',
        text: "Data Akan dihapus permanen ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus Data !',
        cancelButtonText: 'Tidak, Batalkan!',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
            $.ajax({
                url : base_url + 'data_pasien/delete_data',
                type: "POST",
                dataType: "JSON",
                data : {id:id},
                success: function(data)
                {
                    swalConfirm.fire('Berhasil Hapus Pasien!', data.pesan, 'success');
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
    
    $("#btnSaveImport").attr("disabled", true);
    $('#btnSaveImport').text('Import Data');
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: base_url + 'data_pasien/import_data',
        data: data,
        dataType: "JSON",
        processData: false,
        contentType: false, 
        success: function (data) {
            if(data.status) {
                swal.fire("Sukses!!", data.pesan, "success");
                $("#btnSaveImport").attr("disabled", false);
                $('#btnSaveImport').text('Simpan');
            }else {
                swal.fire("Gagal!!", data.pesan, "error");
                $("#btnSaveImport").attr("disabled", false);
                $('#btnSaveImport').text('Simpan');
            }

            reset_modal_form_import();
            $(".modal").modal('hide');
            table.ajax.reload();
        },
        error: function (e) {
            console.log("ERROR : ", e);
            $("#btnSaveImport").attr("disabled", false);
            $('#btnSaveImport').text('Simpan');

            reset_modal_form_import();
            $(".modal").modal('hide');
            table.ajax.reload();
        }
    });
}

function handle_boolean(str) {
    if(str == '1'){
        return 'Ya';
    }else{
        return 'Tidak';
    }
}

function time_now() {
    var d = new Date();
    return d.getHours()+':'+d.getMinutes()+':'+d.getSeconds();
}
