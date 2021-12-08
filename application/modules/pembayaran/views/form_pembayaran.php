<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

  <!-- begin:: Content Head -->
  <div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
      <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">
          <?= $this->template_view->nama('judul') . ' - ' . $title; ?>
        </h3>
      </div>
    </div>
  </div>
  <!-- end:: Content Head -->

  <!-- begin:: Content -->
  <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <!--begin::Form-->
    <form class="kt-form kt-form--label-right" id="form_pembayaran">
      <!-- form data pasien -->
      <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
          <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
              Form Data Pasien
            </h3>
          </div>
        </div>

        <div class="kt-portlet__body">
          <div class="col-12 row" style="padding-bottom: 20px;">
            <div class="col-12">
              <button type="button" class="btn btn-brand" onclick="show_modal_pasien()">Cari Data</button>
            </div>
          </div>
          <div class="col-12 table-responsive">
            <div class="hidden">
              <input type="hidden" id="id_reg" name="id_reg">
              <input type="hidden" id="id_psn" name="id_psn">
              <input type="hidden" id="id_peg" name="id_peg">
              <input type="hidden" id="total_biaya_raw" name="total_biaya_raw">
              <input type="hidden" id="total_biaya_nett_raw" name="total_biaya_nett_raw" class="form-control form-control-sm input-lg" value="">
              <input type="hidden" id="disc_nilai_raw" name="disc_nilai_raw" value="0">
            </div>
            <table class="table table-striped- table-bordered table-hover table-checkable" id="tabel_pasien">
              <thead>
                <tr>
                  <th>No. Reg</th>
                  <th>Tgl Masuk</th>
                  <th>Tgl Pulang</th>
                  <th>Dokter</th>
                  <th>Nama</th>
                  <th>No. RM</th>
                  <th>Jenis Penjamin</th>
                  <th>Pers. Asuransi</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td colspan="7" style="text-align: center;">Data Registrasi Tidak Ditemukan</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="kt-portlet__body">
          <div class="col-12 row">
            <div class="col-5 row">
              <!--begin::Section-->
              <div class="kt-section" id="header_pembayaran"></div>
              <!--end::Section-->
            </div>
            <div class="col-7 row">
              <!--begin::Section-->
              <div class="kt-section col-12" id="detail_pembayaran"></div>
              <!--end::Section-->
            </div>
          </div>
        </div>
      </div>

      <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
          <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
              Form Pembayaran (Kasir)
            </h3>
          </div>
        </div>
        <div class="kt-portlet__body">
          <div class="form-group">
            <label>Jenis Pembayaran : </label>
            <select class="form-control select2" id="jenis_bayar" name="jenis_bayar" style="width: 100%;">
              <option value="cash">Cash</option>
              <option value="kredit">Kredit</option>
            </select>
            <span class="help-block"></span>
          </div>

          <div id="div_opt_kredit">
            <div class="form-group">
              <label>Kredit : </label>
              <select class="form-control select2" id="opt_kredit" name="opt_kredit" style="width: 100%;">
                <?php foreach ($data_bank_kredit as $k => $v) {
                  echo '<option value="' . $v->id . '">' . $v->nama . '</option>';
                } ?>
              </select>
              <span class="help-block"></span>
            </div>
          </div>

          <div class="form-group">
            <label>Pilih Jenis Diskon : </label>
            <select class="form-control select2" id="jenis_diskon" name="jenis_diskon" style="width: 100%;">
              <option value="none">Tanpa Diskon</option>
              <option value="nominal">Nominal</option>
              <option value="persen">Persen</option>
            </select>
            <span class="help-block"></span>
          </div>

          <div id="div_opt_diskon_nominal">
            <div class="form-group">
              <label>Diskon Nominal (Rp) : </label>
              <input type="text" data-thousands="." data-decimal="," id="disc_rp" name="disc_rp" class="form-control inputmask" onkeyup="setDiscRpRaw()" value="0">
              <input type="hidden" id="disc_rp_raw" name="disc_rp_raw" class="form-control form-control-sm input-lg" value="">
              <span class="help-block"></span>
            </div>
          </div>

          <div id="div_opt_diskon_persen">
            <div class="form-group">
              <label>Diskon Persen : </label>
              <input type="text" id="disc_persen" name="disc_persen" class="form-control numberinput" value="0" onkeyup="setDiscPersenRaw(this.value)">
              <span class="help-block"></span>
            </div>
          </div>

          <div class="form-group">
            <label>Pembayaran <span style="font-weight: bold;font-style:italic;"><span> : </label>
            <input type="text" data-thousands="." data-decimal="," id="pembayaran" name="pembayaran" class="form-control inputmask" onkeyup="hitungKembalian()" value="0">
            <input type="hidden" id="pembayaran_raw" name="pembayaran_raw" class="form-control form-control-sm input-lg" value="">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label>Total Biaya:</label>
            <input type="text" class="form-control inputmask" name="biaya" id="biaya" data-thousands="." data-decimal="," disabled>
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label>Kembalian:</label>
            <input type="text" class="form-control" name="kembalian" id="kembalian" data-thousands="." data-decimal="," disabled style="text-align: right;">
            <input type="hidden" id="kembalian_raw" name="kembalian_raw" class="form-control form-control-sm" value="">
            <span class="help-block"></span>
          </div>
        </div>
        <div class="kt-portlet__foot">
          <div class="kt-form__actions">
            <div class="row">
              <div class="col-lg-5"></div>
              <div class="col-lg-7">
                <button type="submit" class="btn btn-brand btnSubmit" disabled>Submit</button>
                <a type="button" class="btn btn-secondary" href="<?= base_url($this->uri->segment(1)) ?>">Batal</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
    <!--end::Form-->
  </div>
</div>