<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Setting Gaji</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Jabatan</label>
                            <div class="col-md-9">
                                <select name="jabatan" id="jabatan"></select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Gaji Pokok</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control mask-currency" id="gapok" name="gapok" value="" data-thousands="." data-decimal="," data-prefix="Rp. " onKeyUp="setGapokRaw();"/>
                                <input type="hidden" class="form-control" id="gapok_raw" name="gapok_raw" value=""/>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Gaji Per Jam</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control mask-currency" id="gaperjam" name="gaperjam" value="" data-thousands="." data-decimal="," data-prefix="Rp. " onKeyUp="setGaperjamRaw();"/>
                                <input type="hidden" class="form-control" id="gaperjam_raw" name="gaperjam_raw" value=""/>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tunjangan Jabatan</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control mask-currency" id="tunjangan" name="tunjangan" value="" data-thousands="." data-decimal="," data-prefix="Rp. " onKeyUp="setTunjanganRaw();"/>
                                <input type="hidden" class="form-control" id="tunjangan_raw" name="tunjangan_raw" value=""/>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tipe Pegawai</label>
                            <div class="col-md-9">
                                <select name="tipepeg" id="tipepeg" class="form-control">
                                    <option value="1">Guru</option>
                                    <option value="0">Karyawan</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->