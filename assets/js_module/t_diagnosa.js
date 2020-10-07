$(document).ready(function() {

    $("#diagnosa").select2({
        // tags: true,
        //multiple: false,
        tokenSeparators: [',', ' '],
        minimumInputLength: 0,
        minimumResultsForSearch: 5,
        ajax: {
            url: base_url+'master_diagnosa/get_select_diagnosa',
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
                            kode: item.kode,
                            html: item.html
                        }
                    })
                };
            }
        }
    });

    // $('#diagnosa').on('select2:selecting', function(e) {
        // let data = e.params.args.data;
        // $('#tabel_modal_diagnosa tbody').html(data.html);
        // $('#nik').val(data.nik);
        // $('#no_rm').val(data.no_rm);
        // $('#tempat_lahir').val(data.tempat_lahir);
        // let tgl_lhr = data.tanggal_lahir;
        // $('#tanggal_lahir').val(tgl_lhr.split("-").reverse().join("/"));
        // $('#umur_reg').val(data.umur);
        // $('#pemetaan').val(data.pemetaan);
    // });
    
});
