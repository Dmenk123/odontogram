<!-- DataTables -->
<script src="<?= config_item('assets') ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= config_item('assets') ?>plugins/datatables/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

        var table = $('#tblLaporanMutasiDetail');
        //set input/textarea/select event when change value, remove class error and remove text help block
        $("input").change(function() {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });


        //datatable
        $('#tblLaporanMutasiDetail').DataTable({
            "pageLength": 50,
            "order": [],
        });

    });

    function konfirmBku(bulan, tahun, saldo_awal, saldo_akhir) {
        swal({
            title: "Konfirmasi",
            text: "Yakin ingin Konfirmasi Laporan ? ",
            icon: "warning",
            buttons: [
                'Tidak',
                'Ya'
            ],
            dangerMode: true,
        }).then(function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: baseUrl + 'lap_bku/konfirmasi_laporan',
                    type: 'POST',
                    dataType: "JSON",
                    data: {
                        bulan: bulan,
                        tahun: tahun,
                        saldo_awal: saldo_awal,
                        saldo_akhir: saldo_akhir
                    },
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

    function reload_table() {
        table.reload(null, false); //reload datatable ajax 
    }
</script>