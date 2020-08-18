<!-- Bootstrap modal -->
<?php
$arr_bulan = [ 
    '1' => 'Januari',
    '2' => 'Februari',
    '3' => 'Maret',
    '4' => 'April',
    '5' => 'Mei',
    '6' => 'Juni',
    '7' => 'Juli',
    '8' => 'Agustus',
    '9' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember'
];
?>
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Proses Penggajian</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Bulan</label>
                            <div class="col-md-9">
                                <select name="bulan" id="bulan" class="form-control">
                                    <option value="">Pilih Bulan</option>
                                    <?php for ($i=1; $i <= 12 ; $i++) { 
                                        echo '<option value="'.$i.'">'.$arr_bulan[$i].'</option>';
                                    } ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Tahun</label>
                            <div class="col-md-9">
                                <select name="tahun" id="tahun" class="form-control">
                                    <option value="">Pilih Tahun</option>
                                    <?php for ($i=(int)date('Y')-10; $i <= 2025; $i++) { 
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                    } ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Guru / Staff</label>
                            <div class="col-md-9">
                                <select name="namapeg" id="namapeg"></select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Status</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="statuspeg" name="statuspeg" value="" readonly />
                                <input type="hidden" class="form-control" id="statuspeg_raw" name="statuspeg_raw" value=""/>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Jabatan</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="jabatanpeg" name="jabatanpeg" value="" readonly />
                                <input type="hidden" class="form-control" id="jabatanpeg_raw" name="jabatanpeg_raw" value=""/>
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
                            <label class="control-label col-md-3">Tunjangan Lain</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control mask-currency" id="tunjanganlain" name="tunjanganlain" value="" data-thousands="." data-decimal="," data-prefix="Rp. " onKeyUp="setTunjanganLainRaw();"/>
                                <input type="hidden" class="form-control" id="tunjanganlain_raw" name="tunjanganlain_raw" value=""/>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Total Potongan</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control mask-currency" id="potongan" name="potongan" value="" data-thousands="." data-decimal="," data-prefix="Rp. " onKeyUp="setPotonganRaw();"/>
                                <input type="hidden" class="form-control" id="potongan_raw" name="potongan_raw" value=""/>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Jumlah Jam / Sebulan</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control numberinput" id="jumlahjam" name="jumlahjam" onKeyUp="setGajiTotal();"/>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Gaji Total</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control mask-currency" id="totalgaji" data-thousands="." data-decimal="," data-prefix="Rp. " precision="" name="totalgaji" readonly/>
                                <input type="hidden" class="form-control numberinput" id="totalgaji_raw" name="totalgaji_raw" />
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