var save_method;
var table;

$(document).ready(function() {

    //force integer input in textfield
    $('input.numberinput').bind('keypress', function (e) {
        return (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 46) ? false : true;
    });

	//datatables
    $("#filters").click(function(){
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
        }

        //chart
        // monitoring(start, end);

    
        table = $('#tabeldata').DataTable({
            responsive: true,
            searchDelay: 500,
            processing: true,
            serverSide: false,
            bDestroy: true,
            ajax: {
                url  : base_url + "monitoring_kunjungan/datatable_monitoring",
                type : "POST",
                data : {
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
        
       
    }); 
    
});	

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}


function monitoring(id, start, end)
{
    // redraw canvas.js
    $('#chart-report').html('<canvas id="line-chart" width="800" height="450"></canvas>');

    url = base_url + 'monitoring_honor/monitoring_chart';
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: url,
        data: {
            id_dokter:id,
            start : start,
            end : end
        },
      dataType: "JSON",
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
                    },
                    responsive: true,
                    responsiveAnimationDuration: 0,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: false,
                                callback: function(value, index, values) {
                                    if(parseInt(value) >= 1000){
                                        return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                    } else {
                                        return 'Rp ' + value;
                                    }
                                },
                                max : response.v_max + 500000,    
                                min : 0
                            }
                        }]
                    }
                  },
                  
              });
          }
      },
      error: function (e) {
        console.log("ERROR : ", e);
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