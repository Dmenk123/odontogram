<!DOCTYPE html>


<html lang="en">

	<!-- begin::Head -->
	<head>
		<base href="../../../">
		<meta charset="utf-8" />
		<title>Sofine | Klinik Login</title>
		<meta name="description" content="Login page example">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!--begin::Fonts -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

		<!--end::Fonts -->

		<!--begin::Page Custom Styles(used by this page) -->
		<link href="<?= base_url('assets/template/')?>assets/css/pages/login/login-5.css" rel="stylesheet" type="text/css" />

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
	<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

		<!-- begin:: Page -->
		<div class="kt-grid kt-grid--ver kt-grid--root">
			<div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v5 kt-login--signin" id="kt_login">
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile" style="background-image: url(<?=base_url('assets/template/')?>assets/media/bg/bg-3.jpg);">
					<div class="kt-login__left">
						<div class="kt-login__wrapper">
							<div class="kt-login__content">
								<a class="kt-login__logo" href="#">
									<img src="<?= base_url('files/img/logo.PNG');?>">
								</a>
								<h3 class="kt-login__title" style="margin-top: 10px;"><?= $greet.' '.$data[0]->nama_pegawai; ?></h3>
								<span class="kt-login__desc">
									<p>Selamat bekerja dan semoga hari anda menyenangkan. <br>
                    Silahkan pilih klinik di panel sebalah kanan untuk melanjutkan Login. Terimakasih.
                  </p>
								</span>
							</div>
						</div>
					</div>
					<div class="kt-login__divider">
						<div></div>
					</div>
					<div class="kt-login__right">
						<!-- <div class="kt-portlet__body" id="menu_area"> -->
              <div class="col-lg-12 row">
                
                <?php foreach ($data as $key => $value) { ?>
                  <div class="col-6 div_menu" data-uid="<?= $this->enkripsi->enc_dec('encrypt', $value->id);?>" data-id="<?= $this->enkripsi->enc_dec('encrypt', $value->id_klinik);?>" data-nama="<?=$value->nama_klinik;?>" style="cursor:pointer;display:flex">
                    <div class="kt-portlet kt-iconbox kt-iconbox--success kt-iconbox--animate-slower">
                      <div class="kt-portlet__body">
                        <div class="kt-iconbox__body">
                          <div class="kt-iconbox__desc">
                            <div class="kt-iconbox__content"><?= $value->nama_klinik; ?></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>
                
              </div>
            <!-- </div> -->
					</div>
				</div>
			</div>
		</div>

		<!-- end:: Page -->

		<!-- begin::Global Config(global config for global JS sciprts) -->
		<script>
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
		<script src="<?= base_url('assets/template/')?>assets/plugins/global/plugins.bundle.js" type="text/javascript"></script>
		<script src="<?= base_url('assets/template/')?>assets/js/scripts.bundle.js" type="text/javascript"></script>

		<!--end::Global Theme Bundle -->

		<!--begin::Page Scripts(used by this page) -->
		<script src="<?= base_url('assets/template/')?>assets/js/pages/custom/login/login-general.js" type="text/javascript"></script>
      
		<!--end::Page Scripts -->
	</body>

	<!-- end::Body -->
</html>