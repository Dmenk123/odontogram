"use strict";
// Class Definition
var KTLoginGeneral = function() {

    var login = $('#kt_login');

    var showErrorMsg = function(form, type, msg) {
        var alert = $('<div class="alert alert-' + type + ' alert-dismissible" role="alert">\
			<div class="alert-text">'+msg+'</div>\
			<div class="alert-close">\
                <i class="flaticon2-cross kt-icon-sm" data-dismiss="alert"></i>\
            </div>\
		</div>');

        form.find('.alert').remove();
        alert.prependTo(form);
        //alert.animateClass('fadeIn animated');
        KTUtil.animateClass(alert[0], 'fadeIn animated');
        alert.find('span').html(msg);
    }

    // Private Functions
    var displaySignUpForm = function() {
        login.removeClass('kt-login--forgot');
        login.removeClass('kt-login--signin');

        login.addClass('kt-login--signup');
        KTUtil.animateClass(login.find('.kt-login__signup')[0], 'flipInX animated');
    }

    var displaySignInForm = function() {
        login.removeClass('kt-login--forgot');
        login.removeClass('kt-login--signup');

        login.addClass('kt-login--signin');
        KTUtil.animateClass(login.find('.kt-login__signin')[0], 'flipInX animated');
        //login.find('.kt-login__signin').animateClass('flipInX animated');
    }

    var displayForgotForm = function() {
        login.removeClass('kt-login--signin');
        login.removeClass('kt-login--signup');

        login.addClass('kt-login--forgot');
        //login.find('.kt-login--forgot').animateClass('flipInX animated');
        KTUtil.animateClass(login.find('.kt-login__forgot')[0], 'flipInX animated');

    }

    var handleFormSwitch = function() {
        $('#kt_login_forgot').click(function(e) {
            e.preventDefault();
            displayForgotForm();
        });

        $('#kt_login_forgot_cancel').click(function(e) {
            e.preventDefault();
            displaySignInForm();
        });

        $('#kt_login_signup').click(function(e) {
            e.preventDefault();
            displaySignUpForm();
        });

        $('#kt_login_signup_cancel').click(function(e) {
            e.preventDefault();
            displaySignInForm();
        });
    }

    var handleSignInFormSubmit = function() {
        $('#kt_login_signin_submit').click(function(e) {
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');
            form.validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
                    }
                }
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);

            form.ajaxSubmit({
                method: 'POST',
                url: base_url+'login/proses',
                dataType: 'JSON',
                success: function(response, status, xhr, $form) {
                    if(response.status) {
                        if(response.is_klinik_choice) {
                            window.location.replace(base_url+'login');

                            let url = base_url+'login/middle_login';
                            let form = $('<form action="' + url + '" method="post">' +
                                '<input type="text" name="uid" value="' + response.uid + '" />' +
                                '</form>'
                            );

                            $('body').append(form);
                            form.submit();
                            return;
                        }else{
                            window.location.replace(base_url+'home');
                        }
                    }else{
                        setTimeout(function() {
                            btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
                            showErrorMsg(form, 'danger', 'Incorrect username or password. Please try again.');
                        }, 1000);
                    }
                },
            });
        });
    }

    var handleSignUpFormSubmit = function() {
        $('#kt_login_signup_submit').click(function(e) {
            e.preventDefault();

            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    fullname: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
                    },
                    rpassword: {
                        required: true
                    },
                    agree: {
                        required: true
                    }
                }
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);

            form.ajaxSubmit({
                url: '',
                success: function(response, status, xhr, $form) {
                	// similate 2s delay
                	setTimeout(function() {
	                    btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
	                    form.clearForm();
	                    form.validate().resetForm();

	                    // display signup form
	                    displaySignInForm();
	                    var signInForm = login.find('.kt-login__signin form');
	                    signInForm.clearForm();
	                    signInForm.validate().resetForm();

	                    showErrorMsg(signInForm, 'success', 'Thank you. To complete your registration please check your email.');
	                }, 2000);
                }
            });
        });
    }

    var handleForgotFormSubmit = function() {
        $('#kt_login_forgot_submit').click(function(e) {
            e.preventDefault();

            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    }
                }
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);

            form.ajaxSubmit({
                
                url: '',
                success: function(response, status, xhr, $form) {
                	// similate 2s delay
                	setTimeout(function() {
                		btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false); // remove
	                    form.clearForm(); // clear form
	                    form.validate().resetForm(); // reset validation states

	                    // display signup form
	                    displaySignInForm();
	                    var signInForm = login.find('.kt-login__signin form');
	                    signInForm.clearForm();
	                    signInForm.validate().resetForm();

	                    showErrorMsg(signInForm, 'success', 'Cool! Password recovery instruction has been sent to your email.');
                	}, 2000);
                }
            });
        });
    }

    // Public Functions
    return {
        // public functions
        init: function() {
            handleFormSwitch();
            handleSignInFormSubmit();
            handleSignUpFormSubmit();
            handleForgotFormSubmit();
        }
    };
}();

const swalConfirm = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-md btn-primary',
        cancelButton: 'btn btn-md btn-danger'
    },
    buttonsStyling: false
});

const hostName = window.location.origin;
const pecah = window.location.pathname.split('/');

if(hostName == 'http://localhost') {
    var baseurl = hostName+'/'+pecah[1]+'/';
}else{
    var baseurl = hostName+'/';
}


// Class Initialization
jQuery(document).ready(function() {
    KTLoginGeneral.init();

    $(document).on('click', '.div_menu', function(){
        var kid = $(this).data('id');
        var uid = $(this).data('uid');
        var nm = $(this).data('nama');

        swalConfirm.fire({
            title: 'Perhatian',
            text: "Login pada klinik "+nm+" ini",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya !',
            cancelButtonText: 'Tidak !',
            reverseButtons: false
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: baseurl + 'login/confirm_middle_login',
                    data: {kid:kid, uid:uid},
                    dataType: "JSON",
                    success: function (data) {
                        if(data.status) {
                            swalConfirm.fire('Sukses !', 'Berhasil Login', 'success').then((cb) => {
                                if(cb.value) {
                                    window.location.href = baseurl + 'home';
                                }
                            });
                        }else {
                            swalConfirm.fire('Gagal !', 'Gagal Login', 'error').then((cb) => {
                                if(cb.value) {
                                    window.location.href = baseurl + 'login';
                                }
                            });
                        }
                    },
                    error: function (e) {
                        console.log("ERROR : ", e);
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
});
