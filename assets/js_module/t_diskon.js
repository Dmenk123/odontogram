var table;
var save_method;
$(document).ready(function() {

    $('#modal_diskon').on('hidden', function () {
        reset_modal_form();
    })

    $('#form-diskon').submit(function(e){
        e.preventDefault();
        $("#btnSave").prop("disabled", true);
        $('#btnSave').text('Menyimpan Data ....');
  
        var form = $('#form-diskon')[0];
        var reg = new FormData(form);
  
        swalConfirm.fire({
          title: 'Perhatian',
          text: "Apakah Anda ingin Menyimpan Transaksi ini ?",
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
                url: base_url + 'master_diskon/simpan_data',
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
                            $('#modal_diskon').modal('hide');
                            reset_modal_form();
                            reload_table();
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

    table = $('#tabel_data').DataTable({
        // dom: 'Bfrtip',
        responsive: true,
        processing: true,
        serverside: true,
        ajax: {
            url  : base_url + "master_diskon/list_data_diskon",
            type : "POST", 
        },
        language: {
            decimal: ",",
            thousands: "."
        },
        // columnDefs: [
        //     { targets: 8, className: 'text-right' },
        //     { targets: 9, className: 'text-right' },
        //     { visible: false, searchable: false, targets: 10 },
        //     { visible: false, searchable: false, targets: 11 },
        // ]
    });
    
});

function add_menu()
{
    reset_modal_form();
    save_method = 'add';
	$('#modal_diskon').modal('show');
	$('#modal_title').text('Tambah Diskon Baru'); 
}

function reset_modal_form()
{
    $('#form-diskon')[0].reset();
    $('.append-opt').remove(); 
    $('div.form-group').children().removeClass("is-invalid invalid-feedback");
    $('span.help-block').text('');
}

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}

function delete_transaksi(id) {
    swalConfirmDelete.fire({
        title: 'Hapus Data ?',
        text: "Data Akan dihapus ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus Data !',
        cancelButtonText: 'Tidak, Batalkan!',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
            $.ajax({
                url : base_url + 'master_diskon/delete_data_diskon',
                type: "POST",
                dataType: "JSON",
                data : {id:id},
                success: function(data)
                {
                    swalConfirm.fire('Berhasil Hapus Data!', data.pesan, 'success');
                    reload_table();
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

