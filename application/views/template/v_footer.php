                    <?php
                        if(isset($modal)) {
                            echo $modal;
                        }
                    ?>
                    <!-- begin:: Footer -->
                    <div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
                        <div class="kt-container  kt-container--fluid ">
                            <div class="kt-footer__copyright">
                                2019&nbsp;&copy;&nbsp;<a href="http://keenthemes.com/metronic" target="_blank" class="kt-link">Keenthemes</a>
                            </div>
                            <div class="kt-footer__menu">
                                <a href="http://keenthemes.com/metronic" target="_blank" class="kt-footer__menu-link kt-link">About</a>
                                <a href="http://keenthemes.com/metronic" target="_blank" class="kt-footer__menu-link kt-link">Team</a>
                                <a href="http://keenthemes.com/metronic" target="_blank" class="kt-footer__menu-link kt-link">Contact</a>
                            </div>
                        </div>
                    </div>
                    <!-- end:: Footer -->

                </div>

			</div>
			<!-- end:: KT-Page -->
		</div>
		<!-- end:: Page -->

		<!-- Quick Panel di panel_dashboard.php-->
		
		<!-- begin::Scrolltop -->
		<div id="kt_scrolltop" class="kt-scrolltop">
			<i class="fa fa-arrow-up"></i>
		</div>
        <!-- end::Scrolltop -->

        <!-- end::Global Config -->

        <!--begin::Global Theme Bundle(used by all pages) -->
        <script src="<?= base_url('assets/template/'); ?>assets/plugins/global/plugins.bundle.js" type="text/javascript"></script>
        <script src="<?= base_url('assets/template/'); ?>assets/js/scripts.bundle.js" type="text/javascript"></script>
        <script src="<?= base_url('assets/template/'); ?>assets/plugins/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
        <!-- <script src="<?= base_url('assets/template/'); ?>assets/js/pages/components/extended/sweetalert2.js" type="text/javascript"></script> -->

        <!--end::Global Theme Bundle -->

        <!--begin::Page Vendors(used by this page) -->
        <script src="<?= base_url('assets/template/'); ?>assets/plugins/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
        <script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript"></script>
        <script src="<?= base_url('assets/template/'); ?>assets/plugins/custom/gmaps/gmaps.js" type="text/javascript"></script>

        <!--end::Page Vendors -->

        <!--begin::Page Scripts(used by this page) -->
        <script src="<?= base_url('assets/template/'); ?>assets/js/pages/dashboard.js" type="text/javascript"></script>
        <!--end::Page Scripts -->
        
        <!-- begin::Global Config(global config for global JS sciprts) -->
        <script>
            let base_url = "<?= base_url(); ?>";
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
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });

        </script>

        <!-- load file css per modul -->
        <?php if(isset($link_js)){ ?> 
        <script src="<?= base_url("$link_js"); ?>" type="text/javascript"></script>; 
        <?php } ?> 
    </body>

	<!-- end::Body -->
</html>