var save_method;
var table;

$(document).ready(function() {

    //force integer input in textfield
    $('input.numberinput').bind('keypress', function (e) {
        return (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 46) ? false : true;
    });

	//datatables
    $("#filters").click(function(){
        var id = $('#id_dokter').val();
        var start = $('#start').val();
        var end = $('#end').val();
        if (start && end) {
            var mulai = start.split("/");
            var s = new Date(mulai[2], mulai[1] - 1, mulai[0]);

            var akhir = end.split("/");
            var e = new Date(akhir[2], akhir[1] - 1, akhir[0]);
            if (s > e) {
                Swal.fire('Tanggal Mulai dilarang melebihi tanggal akhir')
                return;
            }
            
        }else if (!id) {
            Swal.fire('Silahkan memilih dokter terlebih dahulu')
            return;
        }

        //chart
        // monitoring(id, id_barang, start, end);

        if (id != '') {
            table = $('#tabeldata').DataTable({
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: false,
                bDestroy: true,
                ajax: {
                    url  : base_url + "monitoring_honor/datatable_monitoring",
                    type : "POST",
                    data : {
                        id_dokter : id, 
                        start : start,
                        end : end
                    },
                },
    
                //set column definition initialisation properties
                columnDefs: [
                    {
                        targets: [-1], //last column
                        orderable: false, //set not orderable
                    },
                    { targets: 5, className: 'text-right' },
                ],
            });
        }
       
    }); 
    

    $(".modal").on("hidden.bs.modal", function(){
        reset_modal_form();
        reset_modal_form_import();
    });
});	

// function add_menu()
// {
//     reset_modal_form();
//     save_method = 'add';
// 	$('#modal_log').modal('show');
// 	$('#modal_title').text('Tambah Log Harga Jual'); 
// }

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}


function monitoring(id, id_barang, start, end)
{
    url = base_url + 'monitoring_honor/monitoring_cart';
    $.ajax({
      type: "POST",
      enctype: 'multipart/form-data',
      url: url,
      data: {
            id_pelanggan:id,
            id_barang : id_barang,
            start : start,
            end : end
        },
      dataType: "JSON",
      // processData: false, // false, it prevent jQuery form transforming the data into a query string
      // contentType: false, 
      // cache: false,
      timeout: 600000,
      success: function (response) {
          if(response.status) {
              console.log('berhasil');
              new Chart(document.getElementById("line-chart"), {
                  type: 'bar',
                  data: {
                    labels: response.label,
                    datasets: response.datasets
                  },
                  options: {
                    title: {
                      display: true,
                      text: response.judul
                    }
                  }
              });
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
}

const detail_trans = (enc_id) => {
    $.ajax({
        url : base_url + 'pembayaran/detail_pembayaran/true',
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
            $('#modal_title_det').text('Detail Pembayaran'); 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

// function getDokter(param){
//     var value = $(param).val();

//     field = $("[name='id_dokter']");
//     field.html("<option value=''>Loading</option>");
//     $.ajax({
//         url  : base_url + "monitoring_pelanggan/get_barang",
//         type: 'post',
//         data : { id_pelanggan : value },
//         type : 'POST', 
//         dataType : 'json'
//     }).done(function(response){
//         var tes = "<option value=''>Pilih Barang</option>";
//         console.log(response);
//         if(response){
//             for(i=0;i<response.length;i++){
//             //    console.log(response[i]['klh_id']);
//                 var option = "<option value='"+response[i]['id_barang']+"' ";
//                 option += " >"+response[i]['nama_barang']+"</option>";
//                 tes += option;
//                 // field.append(option);
//             }
        
//         }
//         field.html(tes);
//         $('#jenis_event').data("selectBox-selectBoxIt").refresh();
//     });

// }