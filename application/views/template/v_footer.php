                    <?php
                        if(isset($modal)) {
                            if(is_array($modal)){
                                foreach ($modal as $keys => $values) {
                                    echo $values;
                                }
                            }else{
                                echo $modal;
                            }
                        }

                        echo $modal_excel_upload;
                    ?>
                    <!-- begin:: Footer -->
                    <div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
                        <div class="kt-container  kt-container--fluid ">
                            <div class="kt-footer__copyright">
                                2021&nbsp;&copy;&nbsp;Sofine Dental Care
                            </div>
                            <div class="kt-footer__menu">
                                Supported by : Melek Aplikasi
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
        <script src="<?= base_url('assets/template/'); ?>assets/js/jspdf.debug.js" type="text/javascript"></script>
        <script src="<?= base_url('assets/template/'); ?>assets/plugins/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
        <script src="<?= base_url('assets/plugins/'); ?>datatables/extensions/Checkboxes/js/dataTables.checkboxes.min.js" type="text/javascript"></script>
        <script src="<?= base_url('assets/'); ?>plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <script src="<?= base_url('assets/'); ?>plugins/ckeditor/adapters/jquery.js" type="text/javascript"></script>
        <script src="<?= base_url('assets/'); ?>plugins/jquery-mask/jquery.mask.min.js" type="text/javascript"></script>
        <script src="<?= base_url('assets/'); ?>plugins/moment/moment.min.js" type="text/javascript"></script>
        <script src="<?= base_url('assets/template/'); ?>assets/plugins/custom/fullcalendar/fullcalendar.js" type="text/javascript"></script>
        <script src="<?= base_url('assets/'); ?>plugins/inputmask/dist/jquery.inputmask.min.js" type="text/javascript"></script>
        <script src="<?= base_url('build/'); ?>js/custom.js" type="text/javascript"></script>

        <!--begin::Page Vendors(used by this page) -->
		
        <!-- <script src="<?= base_url('assets/template/'); ?>assets/plugins/custom/fullcalendar/moment.js" type="text/javascript"></script> -->
        <!--end::Page Vendors -->

        <!--begin::Page Scripts(used by this page) -->
        <!-- <script src="<?= base_url('assets/template/'); ?>assets/js/pages/components/calendar/basic.js" type="text/javascript"></script> -->
        <!--end::Global Theme Bundle -->
        
        <!-- begin::Global Config(global config for global JS sciprts) -->
        <script>
            
        </script>
        <?php if(isset($link_js)) { ?>
        <?php if(is_array($link_js)){ ?>
        <?php foreach ($link_js as $keys => $values) { ?>
        <script src="<?= base_url("$values"); ?>" type="text/javascript"></script>
        <?php } ?>
        <?php }else{ ?>
        <script src="<?= base_url("$link_js"); ?>" type="text/javascript"></script>
        <?php } ?> 
        <?php } ?>

        <script>
            $(window).on('load', function(){
                $('div#CssLoader').hide();
            });
        </script>
    </body>

	<!-- end::Body -->
</html>