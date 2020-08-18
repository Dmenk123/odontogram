<!-- Bootstrap modal -->
<!-- modal_form_order -->
<div class="modal fade" id="modal_pengeluaran" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-inline">
                    <div class="form-group">
                        <label class="lbl-modal">ID Pencatatan : </label>
                        <input type="text" class="form-control" id="form_id" name="fieldId" readonly="">
                    </div>
                    <div class="form-group">
                        <label class="lbl-modal">User : </label>
                        <input type="text" class="form-control" id="form_username" name="fieldUsername" value="<?php echo $this->session->userdata('username');?>" readonly>
                        <input type="hidden" class="form-control" id="form_userid" name="fieldUserid" value="<?php echo $this->session->userdata('id_user');?>" readonly>
                    </div>
                    <br /><br />
                    <div class="form-group" style="padding-bottom: 20px;">
                       <table id="tabel_pengeluaran" class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                  <th style="text-align:center; width: 30%">Pemohon</th>
                                  <th style="text-align:center; width: 50%">Keterangan</th>
                                  <th style="text-align:center; width: 5%">Jumlah</th>
                                  <th style="text-align:center; width: 10%">Satuan</th>
                                  <th style="text-align:center; width: 5%">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                              <tr>
                                 <td style="width: 30%;">
                                    <div class="form-group" style="width: 100%;">
                                        <input type="text" name="formPemohonTbl" class="form-control" id="form_pemohon_tbl"  placeholder="Pemohon" style="width: 100%;"/>
                                    </div>
                                 </td>
                                 <td style="width: 40%;">
                                    <div class="form-group" style="width: 100%;">
                                        <input type="text" name="formKeteranganTbl" class="form-control" id="form_keterangan_tbl" placeholder="Keterangan" style="width: 100%;"/>
                                    </div>    
                                 </td>
                                 <td style="width: 10%;">
                                    <div class="form-group" style="width: 100%;">
                                        <input type="text" name="formJumlahTbl" class="form-control numberinput" id="form_jumlah_tbl" placeholder="Jumlah" style="width: 100%;"/>
                                    </div>
                                 </td>
                                 <td style="width: 15%;">
                                    <div class="form-group" style="width: 100%;">
                                        <select name="formSatuanTbl" id="form_satuan_tbl" class="form-control" style="width: 100%;">
                                            <?php
                                                $arr_satuan = $this->db->get('tbl_satuan')->result();
                                                echo '<option value=""> - </option>';
                                                foreach ($arr_satuan as $key => $val) {
                                                    echo '<option value="'.$val->id.'">'.$val->nama.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>    
                                 </td>
                                 <td>
                                   <button type="button" name="btnAddRow" id="btn_add_row" class="btn btn-small btn-default">+</button>           
                                 </td>
                              </tr>
                           </tbody> <!-- tbody -->
                        </table> <!-- table --> 
                    </div> <!-- form group -->
                </form> <!-- form -->
            </div> <!-- modal body -->
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="reset" id="btn_cancel_order" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->