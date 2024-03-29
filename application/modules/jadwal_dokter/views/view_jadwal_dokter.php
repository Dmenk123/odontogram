<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

  <!-- begin:: Content Head -->
  <div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
      <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">
 
        </h3>
      </div>
    </div>
  </div>
  <!-- end:: Content Head -->

  <!-- begin:: Content -->
  <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    
    <div class="kt-portlet kt-portlet--mobile">
      <div class="kt-portlet__body">

        <!--begin: Datatable -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
							<div class="row">
								<div class="col-lg-12">

									<!--begin::Portlet-->
                  <div class="container">
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="alert notification" style="display: none;">
                <button class="close" data-close="alert"></button>
                <p></p>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-body">
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="btn-group">
                                            <?= $this->template_view->getAddButton(true, 'add_schedule'); ?>
                                            <a href="#" class="btn btn-primary add_calendar"> Tambah Jadwal
                                                <i class="fa fa-plus"></i>
                                            </a>
                                            <br>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- place -->
                            <br>
                            <textarea type="text" value="<?php echo $get_data;?>" id="get_data" hidden="true"><?php echo $get_data;?></textarea>
                            <div id="calendarIO"></div>
                            <div class="modal fade" id="create_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <form class="form-horizontal" method="POST" action="POST" id="form_create">
                                            <input type="hidden" name="calendar_id" value="0">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                              </button>
                                              <h4 class="modal-title" id="myModalLabel">Create calendar event</h4>
                                          </div>
                                          <div class="modal-body">

                                            <div class="form-group">
                                               <div class="alert alert-danger" style="display: none;"></div>
                                           </div>
                                           <div class="form-group">
                                            <label class="control-label col-sm-2">Dokter  <span class="required"> * </span></label>
                                            <div class="col-sm-10">
                                            <select class="form-control required" name="id_dokter" id="id_dokter">
                                                <option value=""> Dokter Gigi </option>
                                                <?php
                                                foreach ($dokter as $val) { ?>
                                                    <option value="<?php echo $val->id; ?>">
                                                        <?php echo $val->nama; ?>    
                                                    </option>
                                                <?php } ?>
                                            </select>
                                            </div>
                                        </div>

                                        <!-- <div class="form-group">
                                            <label class="control-label col-sm-2">Klinik</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="id_klinik" rows="3" class="form-control"  placeholder="Enter description">
                                            </div>
                                        </div> -->

                                        <div class="form-group">
                                            <label for="color" class="col-sm-2 control-label">Color</label>
                                            <div class="col-sm-10">
                                                <select name="color" class="form-control">
                                                    <option value="">Choose</option>
                                                    <option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
                                                    <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
                                                    <option style="color:#008000;" value="#008000">&#9724; Green</option>                       
                                                    <option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
                                                    <option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
                                                    <option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
                                                    <option style="color:#000;" value="#000">&#9724; Black</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-sm-2">Tanggal</label>
                                            <div class="col-sm-10">
                                                <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                                    <input type="text" name="tanggal" class="form-control kt_datepicker" id="datepick" readonly>
                                                    <span class="input-group-addon"><i class="fa fa-calendar font-dark"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group timepicker">
                                            <label class="control-label col-sm-2">Jam Mulai</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" id="jam_mulai" name="jam_mulai"  placeholder="Pilih Jam" type="text" >
                                            </div>
                                        </div>
                                        <div class="form-group timepicker">
                                            <label class="control-label col-sm-2">Jam Akhir</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" id="jam_akhir" name="jam_akhir"  placeholder="Pilih Jam" type="text" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="javascript::void" class="btn default" data-dismiss="modal">Cancel</a>
                                        <a class="btn btn-danger delete_calendar" style="display: none;">Delete</a>
                                        <button type="submit" class="btn green">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end place -->
                </div>
            </div>
            
        </div>
    </div>
</div>
</div>
</div>

									<!--end::Portlet-->
								</div>
							</div>
						</div>
        <!--end: Datatable -->
      </div>
    </div>
  </div>
  
</div>



