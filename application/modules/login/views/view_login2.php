<!DOCTYPE html>

<html lang="en">

	<!-- begin::Head -->
	<head>
		<base href="../../../">
		<meta charset="utf-8" />
		<title>Sofine | Halaman Login</title>
		<meta name="description" content="Login page example">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!--begin::Fonts -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

		<!--end::Fonts -->

		<!--begin::Page Custom Styles(used by this page) -->
		<!-- <link href="<?= base_url('assets/template/')?>assets/css/pages/login/login-2.css" rel="stylesheet" type="text/css" /> -->
        <link href="<?= base_url('assets/template/')?>assets/css/pages/login/login-3.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('assets/template/')?>assets/css/custom-login.css" rel="stylesheet" type="text/css" />

		<!--end::Page Custom Styles -->

		<!--begin::Global Theme Styles(used by all pages) -->
		<link href="<?= base_url('assets/template/')?>assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?= base_url('assets/template/')?>assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

		<!--end::Global Theme Styles -->

		<!--begin::Layout Skins(used by all pages) -->
		<link href="<?= base_url('assets/template/')?>assets/css/skins/header/base/light.css" rel="stylesheet" type="text/css" />
		<link href="<?= base_url('assets/template/')?>assets/css/skins/header/menu/light.css" rel="stylesheet" type="text/css" />
		<link href="<?= base_url('assets/template/')?>assets/css/skins/brand/dark.css" rel="stylesheet" type="text/css" />
		<link href="<?= base_url('assets/template/')?>assets/css/skins/aside/dark.css" rel="stylesheet" type="text/css" />

		<!--end::Layout Skins -->
		<link rel="shortcut icon" href="<?= base_url('assets/template/')?>assets/media/logos/favicon.ico" />
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
    <body  class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">



    	<div class="container">
	        <div class="row mt-5 register-container">
	            <div class="col-md-5 isometric_box">
	                <div class="isometric py-5">
	                    <img src="https://bosswalfa.surabaya.go.id/assets/images/bg_login.png" width="100%" />
	                </div>
	            </div>
	            <div class="col-md-7">
	                <div class="register_box">
                        <img alt="Logo" src="<?= base_url('files/img/logo.PNG'); ?>"/>
	                    <h5 class="text-primary" style="color: #ecc075!important;">Sofine Dental & Beauty Studio</h5>

	                    <form class="kt-form" id="form" action="https://bosswalfa.surabaya.go.id/login" method="post">
	                    	<input type="hidden" name="_token" value="KZufWfXcHGJZiESAaFCvnIkgj9EuMJ32byPo7MHC">
                            <div class="alert alert-danger" role="alert" style="display:none;" >
								<div class="alert-text"></div>
							</div>								
								                     
	                        <div class="form-group row">
	                            <input class="form-control" type="text" placeholder="Username" name="username" id="username" autocomplete="off">
	                        </div>
	                        <div class="form-group row">
	                            <input class="form-control" type="password" placeholder="Password" id="password" name="password">
	                        </div>

	                        
	                        <div class="kt-login__actions">
	                            <!-- <button type="submit" id="signin_submit" class="btn btn-primary btn-brand btn-elevate">Masuk</button> -->
	                            <button id="kt_login_signin_submit" class="btn btn-brand btn-elevate kt-login__btn-primary" type="submit">Log In</button>
	                        <p></p>
	                      
	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>

       
		<!-- begin:: Page -->

		<!-- begin::Global Config(global config for global JS sciprts) -->
		<script>
			let base_url = '<?=base_url()?>';
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
		</script>

		<!-- end::Global Config -->

		<!--begin::Global Theme Bundle(used by all pages) -->
		<script src="<?=base_url('assets/template/')?>assets/plugins/global/plugins.bundle.js" type="text/javascript"></script>
		<script src="<?=base_url('assets/template/')?>assets/js/scripts.bundle.js" type="text/javascript"></script>

		<!--end::Global Theme Bundle -->

		<!--begin::Page Scripts(used by this page) -->
		<script src="<?=base_url('assets/template/')?>assets/js/pages/custom/login/login-general.js" type="text/javascript"></script>

		<!--end::Page Scripts -->
	</body>

	<!-- end::Body -->
</html>