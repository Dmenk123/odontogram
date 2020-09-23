var save_method;
var txtAksi;
var table;
var table2;

$(document).ready(function() {

    filter_tanggal();
    
    //force integer input in textfield
    $('input.numberinput').bind('keypress', function (e) {
        return (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 46) ? false : true;
    });

    table2 = $('#tabel_asuransi').DataTable({
        autoWidth: false,
		responsive: true,
        searchDelay: 500,
        processing: true,
        serverSide: true,
		ajax: {
			url  : base_url + "master_asuransi/list_data",
			type : "POST" 
		}
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
        reset_form("form-asuransi");
    });

    $("#nama").select2({
        // tags: true,
        //multiple: false,
        tokenSeparators: [',', ' '],
        minimumInputLength: 0,
        minimumResultsForSearch: 5,
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
        minimumInputLength: 0,
        minimumResultsForSearch: 5,
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

    $('#jam_reg').timepicker({
        minuteStep: 1,
        defaultTime: time_now(),
        showSeconds: true,
        showMeridian: false,
        snapToStep: true
    });

    $('.mask_rm').mask("AA.00.00");

    $('#jenis_penjamin').change(function (e) { 
        let id_regnya = get_uri_segment(4);
        e.preventDefault();
        $.ajax({
            type: "post",
            url: base_url+"reg_pasien/get_data_form_penjamin",
            data: {jenis_penjamin : $(this).val(), id_regnya:id_regnya},
            dataType: "json",
            success: function (response) {
                $('#div-append-form').html(response);
                trigger_select_asuransi();
            }
        });
    });   

    if(get_uri_segment(3) !== 'undefined' && get_uri_segment(3) == 'edit') {
        get_data_form_edit();
    }
});

function filter_tanggal(){
    var tgl_awal = $('#tgl_filter_mulai').val();
    var tgl_akhir = $('#tgl_filter_akhir').val();

    //datatables
	table = $('#tabel_index').DataTable({
        destroy: true,
        responsive: true,
        searchDelay: 500,
        processing: true,
        serverSide: true,
		ajax: {
			url  : base_url + "reg_pasien/list_data",
            type : "POST",
            data : {tgl_awal:tgl_awal, tgl_akhir:tgl_akhir},
            dataType : 'JSON',
		},

		//set column definition initialisation properties
		columnDefs: [
			{
				targets: [-1], //last column
				orderable: false, //set not orderable
			},
		],
    });
}

function trigger_select_asuransi(){
    $("#asuransi").select2({
        // tags: true,
        //multiple: false,
        tokenSeparators: [',', ' '],
        minimumInputLength: 0,
        minimumResultsForSearch: 5,
        ajax: {
            url: base_url+'master_asuransi/get_select_asuransi',
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
}

function clear_input_pasien() {
    $('#nik').val('');
    $('#no_rm').val('');
    $('#tempat_lahir').val('');
    $('#tanggal_lahir').val('');
}

function tambah_data_asuransi() {
    save_method = 'add';
    $('#modal_form_asuransi').modal('show');
    $('#modal_form_asuransi_title').text('Master Asuransi'); 
}

function edit_asuransi(id){
    save_method = 'update';
    $.ajax({
        type: "get",
        url: base_url+'master_asuransi/edit_data',
        data: {id:id},
        dataType: "json",
        success: function (response) {
            if(response.status) {
                $('#id_asuransi').val(response.old_data.id);
                $('#nama_asuransi').val(response.old_data.nama).focus();
                $('#ket_asuransi').val(response.old_data.keterangan);
            }else{
                swalConfirm.fire('Dibatalkan','Aksi Dibatalakan','error');
            }
        }
    }); 
}

function get_data_form_edit() {
    var enc_id = get_uri_segment(4);
     
     $.ajax({
        type: "post",
        url: base_url+"reg_pasien/get_data_form_reg",
        data: {enc_id : enc_id},
        dataType: "json",
        success: function (response) {
            if(response.status) {
                $("#id_reg").val(response.data.id);
                var option_nama = $("<option selected='selected'></option>").val(response.data.id_pasien).text(response.txt_opt_pasien);
                $("#nama").append(option_nama).trigger('change');
                $('#nik').val(response.data.nik);
                $('#no_rm').val(response.data.no_rm);
                $('#tempat_lahir').val(response.data.tempat_lahir);
               
                let tgl_lhr = response.data.tanggal_lahir;
                $('#tanggal_lahir').val(tgl_lhr.split("-").reverse().join("/"));
                $('#umur_reg').val(response.data.umur);
                $('#pemetaan').val(response.data.id_pemetaan);
                
                let tgl_reg = response.data.tanggal_reg;
                $('#tanggal_reg').val(tgl_reg.split("-").reverse().join("/"));
                $('#jam_reg').val(response.data.jam_reg);

                var option_dokter = $("<option selected='selected'></option>").val(response.data.id_pegawai).text(response.txt_opt_dokter);
                $("#dokter").append(option_dokter).trigger('change');

                $('#jenis_penjamin').val(response.data.is_asuransi).change();
                
                // $('#no_asuransi').val(response.data.no_asuransi);
                // var $newOption3 = $("<option selected='selected'></option>").val(response.data.id_asuransi).text(response.data.nama_asuransi);
                // $("#asuransi").append($newOption3).trigger('change');
                
            }else{
                window.location.href = base_url+"reg_pasien";
            }
        }
    });  
   
}

function reload_table()
{
    table.ajax.reload(null,false); 
}

function reload_table2()
{
    table2.ajax.reload(null,false); 
}

function reset_form(jqIdForm) {
    $(':input','#'+jqIdForm)
        .not(':button, :submit, :reset, :hidden')
        .val('')
        .prop('checked', false)
        .prop('selected', false);
}

function save()
{
    var form = $('#form_registrasi')[0];
    var data = new FormData(form);
    
    $("#btnSave").prop("disabled", true);
    $('#btnSave').text('Menyimpan Data'); //change button text
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: base_url + 'reg_pasien/simpan_data',
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
                window.location.href = base_url+"reg_pasien";
            }else {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    if (data.is_select2[i] == false) {
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

function simpanAsuransi(){
    if(save_method == 'add') {
        url = base_url + 'master_asuransi/simpan_data';
        txtAksi = 'Tambah Asuransi';
    }else{
        url = base_url + 'master_asuransi/update_data';
        txtAksi = 'Edit Asuransi';
    }

    let form = $('#form-asuransi')[0];
    let data = new FormData(form);
    
    $("#btnSaveAsuransi").prop("disabled", true);
    $('#btnSaveAsuransi').text('Menyimpan Data'); //change button text
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: url,
        data: data,
        dataType: "JSON",
        processData: false,
        contentType: false, 
        cache: false,
        timeout: 600000,
        success: function (data) {
            if(data.status) {
                swal.fire("Sukses!!", data.pesan, "success");
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
            }

            $("#btnSaveAsuransi").prop("disabled", false);
            $('#btnSaveAsuransi').text('Simpan');
            reload_table2();
            reset_form("form-asuransi");
            save_method = 'add';
        },
        error: function (e) {
            console.log("ERROR : ", e);
            $("#btnSaveAsuransi").prop("disabled", false);
            $('#btnSaveAsuransi').text('Simpan');
        }
    });
}

function delete_reg(id){
    swalConfirmDelete.fire({
        title: 'Hapus Data Registrasi ?',
        text: "Data Akan dihapus permanen ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus Data !',
        cancelButtonText: 'Tidak, Batalkan!',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
            $.ajax({
                url : base_url + 'reg_pasien/delete_data',
                type: "POST",
                dataType: "JSON",
                data : {id:id},
                success: function(data)
                {
                    swalConfirm.fire('Berhasil Hapus Registrasi!', data.pesan, 'success');
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

function delete_asuransi(id) {
    swalConfirmDelete.fire({
        title: 'Hapus Data Asuransi ?',
        text: "Data Akan dihapus permanen ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus Data !',
        cancelButtonText: 'Tidak, Batalkan!',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
            $.ajax({
                url : base_url + 'master_asuransi/delete_data',
                type: "POST",
                dataType: "JSON",
                data : {id:id},
                success: function(data)
                {
                    swalConfirm.fire('Berhasil Hapus Data!', data.pesan, 'success');
                    table2.ajax.reload();
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

function ekspor_excel(){
    let tgl_awal = $('#tgl_filter_mulai').val();
    let tgl_akhir = $('#tgl_filter_akhir').val();
    // redirect
    window.open(base_url+'reg_pasien/export_excel?tgl_awal='+tgl_awal+'&tgl_akhir='+tgl_akhir, '_blank');

}

function cetak_data(){
    let tgl_awal = $('#tgl_filter_mulai').val();
    let tgl_akhir = $('#tgl_filter_akhir').val();
    // redirect
    window.open(base_url+'reg_pasien/cetak_data?tgl_awal='+tgl_awal+'&tgl_akhir='+tgl_akhir, '_blank');
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

function get_uri_segment(segment) {
    var pathArray = window.location.pathname.split( '/' );
    return pathArray[segment];
}
