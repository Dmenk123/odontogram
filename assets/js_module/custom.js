const hostName = window.location.origin;
const pecah = window.location.pathname.split('/');
if(hostName == 'http://localhost') {
    var base_url = hostName+'/'+pecah[1]+'/';
}else{
    var base_url = hostName+'/';
}

var KTAppOptions = {
    "colors": {
        "state": {
            "brand": "#5d78ff",
            "dark": "#282a3c",
            "light": "#ffffff",
            "primary": "#5867dd",
            "success": "#34bfa3",
            "info": "#36a3f7",
            "warning": "#ffb822",
            "danger": "#fd3995"
        },
        "base": {
            "label": [
                "#c5cbe3",
                "#a1a8c3",
                "#3d4465",
                "#3e4466"
            ],
            "shape": [
                "#f0f3ff",
                "#d9dffa",
                "#afb4d4",
                "#646c9a"
            ]
        }
    }
};

const swalConfirm = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-md btn-primary',
        cancelButton: 'btn btn-md btn-danger'
    },
    buttonsStyling: false
});

const swalConfirmDelete = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-md btn-danger',
        cancelButton: 'btn btn-md btn-primary'
    },
    buttonsStyling: false
});

function to_upper(objek) {
    var _a = objek.value;
    objek.value = _a.toUpperCase();
}

const jamSistem = () => {
    if (detik!=0 && detik%60==0) { menit++; detik=0; }
    second = Number(detik);
    if (menit!=0 && menit%60==0) { jam++; menit=0; }
    minute = Number(menit);
    if (jam!=0 && jam%24==0) { jam=0; }
    hour = Number(jam);
    if (detik<10) { second='0'+detik; }
    if (menit<10){ minute='0'+menit; }
    if (jam<10){ hour='0'+jam; }
    waktu = hour+':'+minute+':'+second;
    //  console.log(waktu);
    // $('.jamServer').text("<?=$obj_date->format('d-m-Y');?>"+' '+waktu);
    
    detik++;
}

const reInitInputMask = () => {
    $(".inputmask").inputmask({
        prefix: "",
        groupSeparator: ".",
        radixPoint: ",",
        alias: "currency",
        placeholder: "0",
        autoGroup: true,
        digits: 0,
        digitsOptional: false,
        clearMaskOnLostFocus: false,
        inputmode: "numeric",
        onBeforeMask: function (value, opts) {
            return value;
        },
    });
}

const formatMoney = (number) => {
    var value = number.toLocaleString(
        'id-ID', 
        { minimumFractionDigits: 0 }
    );
    return value;
}

const showProfileUser = (id) => 
{
    $.ajax({
        url : base_url + 'master_user/edit_user',
        type: "POST",
        dataType: "JSON",
        data : {id:id},
        success: function(data)
        {
            $('#form_user_profile input[name="id_user_profile"]').val(data.old_data.id);
            $('#form_user_profile input[name="p_pegawai"]').val(data.old_data.nama_pegawai);
            $('#form_user_profile input[name="p_username"]').val(data.old_data.username);
            $('#modal_profile_user').modal('show');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

const updateProfileUser = () => {
    let form = $('#form_user_profile')[0];
    let data = new FormData(form);
    
    $("#btnSaveProfileUser").prop("disabled", true);
    $('#btnSaveProfileUser').text('Menyimpan Data'); //change button text
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: base_url + 'master_user/update_data_profile',
        data: data,
        dataType: "JSON",
        processData: false,
        contentType: false, 
        cache: false,
        timeout: 600000,
        success: function (data) {
            if(data.status) {
                swalConfirm.fire('Sukses', data.pesan, 'success').then((cb) => {
                    if(cb.value) {
                        window.location.reload();
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

                $("#btnSaveProfileUser").prop("disabled", false);
                $('#btnSaveProfileUser').text('Simpan');
            }
        },
        error: function (e) {
            console.log("ERROR : ", e);
            $("#btnSaveProfileUser").prop("disabled", false);
            $('#btnSaveProfileUser').text('Update Password');

            reset_modal_form();
            $(".modal").modal('hide');
        }
    });
}

$(document).ready(function () {
    // setInterval(jamSistem, 1000);
    
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    // set global moment.js
    moment.locale('id');

    $('.mask_money').mask('000.000.000.000.000', {reverse: true});

    $(".inputmask").inputmask({
        prefix: "",
        groupSeparator: ".",
        radixPoint: ",",
        alias: "currency",
        placeholder: "0",
        autoGroup: true,
        digits: 0,
        digitsOptional: false,
        clearMaskOnLostFocus: false,
        inputmode: "numeric",
        onBeforeMask: function (value, opts) {
            return value;
        },
    });

    $('.select2').select2({
        allowClear: true,
        placeholder: "Mohon Pilih Salah Satu"
    });

    $('.kt_datepicker').datepicker({
        rtl: KTUtil.isRTL(),
        todayHighlight: true,
        format: "dd/mm/yyyy",
        autoclose: true,
        orientation: "bottom left",
        templates: {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }
    });

    $('input.numberinput').bind('keypress', function(e) {
        return (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 46) ? false : true;
    });

});