<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Master Barang</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Barang</label>
                            <div class="col-md-9">
                                <input name="namaBarang" placeholder="Nama Barang" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Satuan</label>
                            <div class="col-md-9">
                                <select name="satuanBarang" class="form-control">
                                    <option value="">--Pilih Satuan--</option>
                                    <?php 
                                    $query = $this->db->get('tbl_satuan')->result();
                                    foreach ($query as $key) { ?>
                                        <option value="<?php echo $key->id_satuan ?>">
                                            <?php echo $key->nama_satuan ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group modal_stok_awal">
                            <label class="control-label col-md-3">Stok Awal</label>
                            <div class="col-md-9">
                                <input name="stokBarang" placeholder="Stok Awal" class="form-control numberinput" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>    
                        <div class="form-group">
                            <label class="control-label col-md-3">Kategori</label>
                            <div class="col-md-9">
                                <select name="kategoriBarang" class="form-control">
                                    <option value="">--Pilih Kategori--</option>
                                    <?php
                                    $query = $this->db->get('tbl_kategori')->result();
                                    foreach ($query as $key) { ?>
                                        <option value="<?php echo $key->id_kategori ?>">
                                            <?php echo $key->keterangan_kategori ?>    
                                        </option>
                                <?php } ?>     
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Status</label>
                            <div class="col-md-9">
                                <select name="statusBarang" class="form-control">
                                    <option value="aktif">Aktif</option>
                                    <option value="nonaktif">Non-Aktif</option>
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