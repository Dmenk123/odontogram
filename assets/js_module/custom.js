const hostName = window.location.origin;
const pecah = window.location.pathname.split('/');
const base_url = hostName+'/'+pecah[1]+'/';


$(window).on('load', function(){
    $('div#CssLoader').addClass('hidden');
});

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

$(document).ready(function () {
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