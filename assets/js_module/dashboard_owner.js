var save_method;
var table;

$(document).ready(function() {
    monitoring();
    //force integer input in textfield
    $('input.numberinput').bind('keypress', function (e) {
        return (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 46) ? false : true;
    });    
});	

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}


function monitoring()
{
    // redraw canvas.js
    $('#dash_kunjungan').html('<canvas id="line-chart" width="418px" height="120px"></canvas>');

    url = base_url + 'home/chart_kunjungan';
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: url,
        // data: {
        //     start : start,
        //     end : end
        // },
      dataType: "JSON",
      timeout: 600000,
      success: function (response) {
          if(response.status) {
              console.log('berhasil');
              new Chart(document.getElementById("dash_kunjungan"), {
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
                                /* callback: function(value, index, values) {
                                    if(parseInt(value) >= 1000){
                                        return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                    } else {
                                        return 'Rp ' + value;
                                    }
                                }, */
                                max : response.v_max + 5,    
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