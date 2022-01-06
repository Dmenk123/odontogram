<div class="modal fade modal_detail" tabindex="-1" role="dialog" aria-labelledby="add_menu" aria-hidden="true" id="modal_detail">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_title_det"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body row">
        <div class="col-md-6">
          <table class="table table-responsive table-borderless">
            <tbody>
              <tr>
                <th style="width: 130px;">Klinik</th>
                <td style="width: 10px;"> : </td>
                <td><span id="klinik_det"></span></td>
              </tr>
              <tr>
                <th>No. Registrasi</th>
                <td> : </td>
                <td><span id="no_reg_det"></span></td>
              </tr>
              <tr>
                <th>Tgl Registrasi</th>
                <td> : </td>
                <td><span id="tgl_reg_det"></span></td>
              </tr>
              <tr> 
                <th>User</th>
                <td> : </td>
                <td><span id="user_det"></span></td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="col-md-6">
          <table class="table table-responsive table-borderless">
            <tbody>
              <tr> 
                <th style="width: 130px;">Nama Pasien</th>
                <td style="width: 10px;"> : </td>
                <td><span id="pasien_det"></span></td>
              </tr>
              <tr> 
                <th>No. RM</th>
                <td> : </td>
                <td><span id="rm_det"></span></td>
              </tr>
              <tr>
                <th>Jenis Bayar</th>
                <td> : </td>
                <td><span id="jenis_det"></span></td>
              </tr>
              <tr> 
                <th>Nama Kredit</th>
                <td> : </td>
                <td><span id="kredit_det"></span></td>
              </tr>
            </tbody>
          </table>
        </div>
        
        <div class="modal-header col-md-12"><h5 class="modal-title">Rincian</h5></div>
        <div class="col-12">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Jenis</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Disc</th>
                <th>Subtotal</th>
              </tr>
            </thead>
            <tbody id="rincian_det"></tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>