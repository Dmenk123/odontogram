
    var get_data        = $('#get_data').val();
    $('#jam_mulai').timepicker({
        minuteStep: 1,
        // defaultTime: time_now(),
        showSeconds: false,
        showMeridian: false,
        snapToStep: true
    });

    $('#jam_akhir').timepicker({
        minuteStep: 1,
        // defaultTime: time_now(),
        showSeconds: false,
        showMeridian: false,
        snapToStep: true
    });
    $(document).ready(function() {
        console.log('tes ');
       
        table = $('#tabel_rutin').DataTable({
            responsive: true,
            searchDelay: 500,
            processing: true,
            serverSide: false,
            bDestroy: true,
            ajax: {
                url  : base_url + "jadwal_dokter/datatable_jadwal_rutin",
                type : "POST",
                // data : {
                //     start : start,
                //     end : end
                // },
            },

            //set column definition initialisation properties
            columnDefs: [
                {
                    targets: [-1], //last column
                    orderable: false, //set not orderable
                },
                // { targets: 5, className: 'text-right' },
            ],
        });

        table2 = $('#tabel_tidak_rutin').DataTable({
            responsive: true,
            searchDelay: 500,
            processing: true,
            serverSide: false,
            bDestroy: true,
            ajax: {
                url  : base_url + "jadwal_dokter/datatable_jadwal_tidak_rutin",
                type : "POST",
                // data : {
                //     start : start,
                //     end : end
                // },
            },

            //set column definition initialisation properties
            columnDefs: [
                {
                    targets: [-1], //last column
                    orderable: false, //set not orderable
                },
                // { targets: 5, className: 'text-right' },
            ],
        });
    });


function add_jadwal_rutin()
{
    reset_modal_form();
    save_method = 'add';
    $('#modal_jadwal_rutin').modal('show');
    $('#modal_title').text('Tambahkan Jadwal Rutin'); 
}

function reset_modal_form()
{
    $('#form-jadwal-rutin')[0].reset();
    $('.append-opt').remove(); 
    $('div.form-group').children().removeClass("is-invalid invalid-feedback");
    $('span.help-block').text('');
    $('#div_pass_lama').css("display","none");
}

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}

function save_jadwal_rutin()
{
    var url;
    var txtAksi;

    url = base_url + 'jadwal_dokter/add_jadwal_rutin';
    
    var form = $('#form-jadwal-rutin')[0];
    var data = new FormData(form);
    
    $("#btnSave").prop("disabled", true);
    $('#btnSave').text('Menyimpan Data'); //change button text
    swalConfirmDelete.fire({
        title: 'Perhatian !!',
        text: "Apakah anda yakin menambah data ini ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
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
                        swal.fire("Sukses!!", data.pesan, "success");
                        $("#btnSave").prop("disabled", false);
                        $('#btnSave').text('Simpan');
                        
                        reset_modal_form();
                        $(".modal").modal('hide');
                        
                        reload_table();
                    }else {
                        for (var i = 0; i < data.inputerror.length; i++) 
                        {
                            if (data.inputerror[i] != 'jabatans') {
                                $('[name="'+data.inputerror[i]+'"]').addClass('is-invalid');
                                $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]).addClass('invalid-feedback'); //select span help-block class set text error string
                            }else{
                                $($('#jabatans').data('select2').$container).addClass('has-error');
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
      })
    
}

function delete_jadwal_rutin(id){
    swalConfirmDelete.fire({
        title: 'Hapus Data ini ?',
        text: "Data Akan dihapus permanen ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus Data !',
        cancelButtonText: 'Tidak, Batalkan!',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
            $.ajax({
                url : base_url + 'jadwal_dokter/delete_jadwal_rutin',
                type: "POST",
                dataType: "JSON",
                data : {id:id},
                success: function(data)
                {
                    swalConfirm.fire('Berhasil Hapus data jadwal!', data.pesan, 'success');
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

   
