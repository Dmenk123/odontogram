<!-- DataTables -->
<script src="<?=config_item('assets')?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=config_item('assets')?>plugins/datatables/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
	var save_method; //for save method string
	var table;

$(document).ready(function() {
	//datatables
	table = $('#tabelData').DataTable();

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

function kunciLaporan() {
    swal({
        title: "Konfirmasi",
        text: "Yakin ingin Kunci Laporan ? ",
        icon: "warning",
        buttons: [
            'Tidak',
            'Ya'
        ],
        dangerMode: true,
    }).then(function(isConfirm) {
        if (isConfirm) {
            $.ajax({
                url: baseUrl + 'kunci_lap/proses_kunci_laporan',
                type: 'POST',
                dataType: "JSON",
                data: $('#formTambahKuncian').serialize(),
                success: function(data) {
                    if (data.status == true) {
                        swal("Pemberitahuan", data.pesan, "success").then(function() {
                            location.reload();
                        });
                    } else {
                        swal("Pemberitahuan", data.pesan, "error").then(function() {
                            location.reload();
                        });
                    }
                }
            });
        } else {
            swal("Batal", "Aksi dibatalkan", "error");
        }
    });
}

function setKunci(bulan, tahun, statuskunci) {
    swal({
        title: "Konfirmasi",
        text: "Yakin ingin setting penguncian ? ",
        icon: "warning",
        buttons: [
            'Tidak',
            'Ya'
        ],
        dangerMode: true,
    }).then(function(isConfirm) {
        if (isConfirm) {
            $.ajax({
                url: baseUrl + 'kunci_lap/set_kunci_laporan',
                type: 'POST',
                dataType: "JSON",
                data: {bulan:bulan, tahun:tahun, statuskunci:statuskunci},
                success: function(data) {
                    if (data.status == true) {
                        swal("Pemberitahuan", data.pesan, "success").then(function() {
                            location.reload();
                        });
                    } else {
                        swal("Pemberitahuan", data.pesan, "error").then(function() {
                            location.reload();
                        });
                    }
                }
            });
        } else {
            swal("Batal", "Aksi dibatalkan", "error");
        }
    });
}


function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}

</script>	