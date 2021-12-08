var save_method;
var table;
let id_peg;
let id_psn;
let id_reg;
let pid;
let biaya_raw_global;

$(document).ready(function() {
    $('#div_opt_kredit').css('display', 'none');
    $('#div_opt_diskon_nominal').css('display', 'none');
    $('#div_opt_diskon_persen').css('display', 'none');

    let uri = new URL(window.location.href);
    pid = uri.searchParams.get("pid");

    if(pid != '' || pid != undefined) {
        pilih_pasien_pulang(pid);
    }

    //force integer input in textfield
    $('input.numberinput').bind('keypress', function (e) {
        return (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 46) ? false : true;
    });


    $('#jenis_bayar').change(function (e) { 
      if(this.value == 'kredit') {
        $('#div_opt_kredit').slideDown();
      }else{
        $('#div_opt_kredit').slideUp();
      }
    });

    $('#jenis_diskon').change(function (e) { 
        $('#disc_persen').val(0);
        $('#disc_rp_raw').val(0);
        $('#disc_rp').val(0);
        $('#disc_nilai_raw').val(0);
        $('#total_biaya_nett_raw').val(biaya_raw_global);
        $('#biaya').val(formatMoney(Number(biaya_raw_global)));

        if(this.value == 'nominal') {
            $('#div_opt_diskon_nominal').slideDown();
            $('#div_opt_diskon_persen').slideUp();
            
        }else if(this.value == 'persen'){
            $('#div_opt_diskon_nominal').slideUp();
            $('#div_opt_diskon_persen').slideDown();
            
        }else if(this.value == 'none'){
            $('#div_opt_diskon_nominal').slideUp();
            $('#div_opt_diskon_persen').slideUp();
        }
    });

    $('#form_pembayaran').submit(function (e) { 
        e.preventDefault();
        
    });

    $('#form_pembayaran').submit(function(e){
      e.preventDefault();
      $("#btnSave").prop("disabled", true);
      $('#btnSave').text('Menyimpan Data ....');

      var form = $('#form_pembayaran')[0];
      var reg = new FormData(form);

      swalConfirm.fire({
        title: 'Perhatian',
        text: "Apakah Anda ingin Membayar Transaksi ini ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya !',
        cancelButtonText: 'Tidak !',
        reverseButtons: false
      }).then((result) => {
        if (result.value) {
          $.ajax({
              type: "POST",
              enctype: 'multipart/form-data',
              url: base_url + 'pembayaran/simpan_data',
              data: reg,
              dataType: "JSON",
              processData: false, // false, it prevent jQuery form transforming the data into a query string
              contentType: false, 
              cache: false,
              timeout: 600000,
              success: function (data) {
                  if(data.status) {
                    swalConfirm.fire('Berhasil Menambah Data!', data.pesan, 'success').then((cb) => {
                        if(cb.value) {
                            window.location.href = base_url +'pembayaran';
                        }
                    });
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
                  createAlert('Opps!','Terjadi Kesalahan','Coba Lagi nanti','danger',true,false,'pageMessages');
                  $("#btnSave").prop("disabled", false);
                  $('#btnSave').text('Simpan');
              }
          });
        }else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalConfirm.fire(
            'Dibatalkan',
            'Aksi Dibatalakan',
            'error'
          );

          $("#btnSave").prop("disabled", false);
          $('#btnSave').text('Simpan');
        }
      });

      
    });

	//datatables
	table = $('#tabel_index').DataTable({
		responsive: true,
        searchDelay: 500,
        processing: true,
        serverSide: true,
		ajax: {
			url  : base_url + "pembayaran/list_data",
			type : "POST" 
		},
        language: {
            decimal: ",",
            thousands: "."
        },
        columnDefs: [
            { targets: 6, className: 'text-right' },
            { targets: 7, className: 'text-right' },
            { targets: 8, className: 'text-right' },
            // { visible: false, searchable: false, targets: 4 },
            // { visible: false, searchable: false, targets: 5 },
        ],

		//set column definition initialisation properties
		columnDefs: [
			{
				targets: [-1], //last column
				orderable: false, //set not orderable
			},
		],
    });
    

    //change menu status
    // $(document).on('click', '.btn_edit_status', function(){
    //     var id = $(this).attr('id');
    //     var status = $(this).val();
    //     swalConfirm.fire({
    //         title: 'Ubah Status Data Pasien ?',
    //         text: "Apakah Anda Yakin ?",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonText: 'Ya, Ubah Status!',
    //         cancelButtonText: 'Tidak, Batalkan!',
    //         reverseButtons: true
    //       }).then((result) => {
    //         if (result.value) {
    //             $.ajax({
    //                 url : base_url + 'data_pasien/edit_status_aktif',
    //                 type: "POST",
    //                 dataType: "JSON",
    //                 data : {status : status, id : id},
    //                 success: function(data)
    //                 {
    //                     swalConfirm.fire('Berhasil Ubah Status Pasien!', data.pesan, 'success');
    //                     table.ajax.reload();
    //                 },
    //                 error: function (jqXHR, textStatus, errorThrown)
    //                 {
    //                     Swal.fire('Terjadi Kesalahan');
    //                 }
    //             });
    //         } else if (
    //           /* Read more about handling dismissals below */
    //           result.dismiss === Swal.DismissReason.cancel
    //         ) {
    //           swalConfirm.fire(
    //             'Dibatalkan',
    //             'Aksi Dibatalakan',
    //             'error'
    //           )
    //         }
    //     });
    // });

    $(".modal").on("hidden.bs.modal", function(){
        reset_modal_form_import();
    });

    // $('#alergi_obat').change(function (e) { 
    //     e.preventDefault();
    //     if($(this).val() == '1') {
    //         $('[name="alergi_obat_val"]').attr('disabled', false).val('');
    //     }else{
    //         $('[name="alergi_obat_val"]').attr('disabled', true).val('');
    //     }
    // });

    // $('#alergi_makanan').change(function (e) { 
    //     e.preventDefault();
    //     if($(this).val() == '1') {
    //         $('[name="alergi_makanan_val"]').attr('disabled', false).val('');
    //     }else{
    //         $('[name="alergi_makanan_val"]').attr('disabled', true).val('');
    //     }
    // });

    // $("#cek_manual").change(function() {
    //     if(this.checked) {
    //         $('[name="no_rm"]').attr('disabled', false).val('');
    //     }else{
    //         $('[name="no_rm"]').attr('disabled', true).val('');
    //     }
    // });

    // $('.mask_tanggal').mask("00/00/0000", {placeholder: "DD/MM/YYYY"});
    // $('.mask_rm').mask("AA.00.00");
});	

const show_modal_pasien = () => {
    $('#modal_pilih_pasien').modal('show');
    $('#modal_pilih_pasien_title').text('Pilih Data Registrasi'); 
}

const cari_pasien = () => {
    let form = $('#form_cari_pasien')[0];
    let data = new FormData(form);

    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: base_url+'pembayaran/cari_pasien_pulang',
        data: data,
        dataType: "JSON",
        processData: false,
        contentType: false, 
        cache: false,
        timeout: 600000,
        success: function (response) {
            if(response.status) {
                $('#tabel_pilih_pasien tbody').html(response.data);
            }else{
                swalConfirm.fire('Gagal','Data Tidak Ditemukan','error');
            }
        }
    });
}

const pilih_pasien_pulang = (enc_id) => {
    $.ajax({
        type: "post",
        url: base_url+'pembayaran/hasil_pilih_pasien',
        data: {enc_id:enc_id},
        dataType: "json",
        success: function (response) {
            //set html
            $('#tabel_pasien tbody').html(response.data);
            $('#header_pembayaran').html(response.html_header);
            $('#detail_pembayaran').html(response.html_detail);
            //set value
            $('#id_reg').val(response.data_id.id_reg);
            $('#id_psn').val(response.data_id.id_psn);
            $('#id_peg').val(response.data_id.id_peg);
            $('#total_biaya_raw').val(response.tot_biaya);
            $('#total_biaya_nett_raw').val(response.tot_biaya);
            $('#biaya').val(response.tot_biaya);
            // set state
            id_reg = response.data_id.id_reg;
            id_peg = response.data_id.id_peg;
            id_psn = response.data_id.id_psn;
            biaya_raw_global = response.tot_biaya;
            // $('#modal_pilih_pasien').modal('hide');
        }
    });
}

const submit_pasien_pulang = (enc_id) => {
    location.href = base_url+'pembayaran/add?pid='+enc_id;
}

const hitungKembalian = () => {
    let harga = $('#pembayaran').inputmask('unmaskedvalue');
    let totalBiaya = $('#total_biaya_nett_raw').val();

    harga = harga.replace(",", ".");
    hargaFix = parseFloat(harga).toFixed(2);
    totalBiayaFix = parseFloat(totalBiaya).toFixed(2);
    
    let kembalian = hargaFix - totalBiaya;
    
    if(Number.isNaN(kembalian)) {
        kembalianFix = 0;
    }else{
        kembalianFix = parseFloat(kembalian).toFixed(2);
    }
    
    let kembalianNew = Number(kembalianFix).toFixed(2);
    $('#kembalian').val(formatMoney(Number(kembalianNew)));
    // $('#span_pembayaran_harga_global').text(formatMoney(Number(hargaFix)));
    // $('#span_kembalian_harga_global').text(formatMoney(Number(kembalianNew)));
    
    // set raw value
    $('#pembayaran_raw').val(hargaFix);
    $('#kembalian_raw').val(kembalianFix);

    if(kembalianFix < 0) {
        $('.btnSubmit').attr('disabled', 'disabled');
    }else{
        $('.btnSubmit').removeAttr('disabled');
    }
}

const setDiscRpRaw = () => {
    let rp = $('#disc_rp').inputmask('unmaskedvalue');
    let rpFix = parseFloat(rp).toFixed(2);
    $('#disc_rp_raw').val(rpFix);
    $('#disc_nilai_raw').val(rpFix);

    let totalBiaya = $('#total_biaya_raw').val();
    let totalBiayaFix = totalBiaya - rpFix;
    
    // set value
    $('#total_biaya_nett_raw').val(totalBiayaFix);
    $('#biaya').val(formatMoney(Number(totalBiayaFix)));
}

const setDiscPersenRaw = (discVal) => {
    let totalBiaya = $('#total_biaya_raw').val();
    let diskon = totalBiaya * discVal / 100;
    $('#disc_nilai_raw').val(parseFloat(diskon).toFixed(2));
    let totalBiayaFix = totalBiaya - diskon;

    $('#total_biaya_nett_raw').val(totalBiayaFix);
    $('#biaya').val(formatMoney(Number(totalBiayaFix)));
}

const formatMoney = (number) => {
    var value = number.toLocaleString(
        'id-ID', 
        { minimumFractionDigits: 2 }
    );
    return value;
}

const detail_trans = (enc_id) => {
    $.ajax({
        url : base_url + 'pembayaran/detail_pembayaran',
        type: "POST",
        dataType: "JSON",
        data : {enc_id:enc_id},
        success: function(data)
        {
            $('#klinik_det').text(data.old_data.nama_klinik);
            $('#no_reg_det').text(data.old_data.no_reg);
            $('#tgl_reg_det').text(moment(data.old_data.tanggal, 'YYYY-MM-DD').format('DD-MM-YYYY'));
            $('#user_det').text(data.old_data.username);

            $('#pasien_det').text(data.old_data.nama);
            $('#rm_det').text(data.old_data.no_rm);
            $('#jenis_det').text(data.old_data.jenis_bayar);
            $('#kredit_det').text(data.old_data.nama_kredit);

            $('tbody#rincian_det').html(data.html_rinci);
            $('#modal_detail').modal('show');
	        $('#modal_title_det').text('Detail Pasien'); 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
////////////////////////////////////////////////////



function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
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
