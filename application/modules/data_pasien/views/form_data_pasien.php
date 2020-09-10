<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

  <!-- begin:: Content Head -->
  <div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
      <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">
          <?= $this->template_view->nama('judul').' - '.$title.' - Form Data Pasien'; ?>
        </h3>
      </div>
    </div>
  </div>
  <!-- end:: Content Head -->

  <!-- begin:: Content -->
  <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <!--begin::Form-->
    <form class="kt-form kt-form--label-right">
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
          <div class="form-group row form-group-marginless kt-margin-t-20">
            <label class="col-lg-1 col-form-label">Full Name:</label>
            <div class="col-lg-3">
              <input type="email" class="form-control" placeholder="Full name">
              <span class="form-text text-muted">Please enter your full name</span>
            </div>
            <label class="col-lg-1 col-form-label">Email:</label>
            <div class="col-lg-3">
              <input type="email" class="form-control" placeholder="Email">
              <span class="form-text text-muted">Please enter your email</span>
            </div>
            <label class="col-lg-1 col-form-label">Username:</label>
            <div class="col-lg-3">
              <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-user"></i></span></div>
                <input type="text" class="form-control" placeholder="">
              </div>
              <span class="form-text text-muted">Please enter your username</span>
            </div>
          </div>
          <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
          <div class="form-group row form-group-marginless">
            <label class="col-lg-1 col-form-label">Contact:</label>
            <div class="col-lg-3">
              <input type="email" class="form-control" placeholder="Enter contact number">
              <span class="form-text text-muted">Please enter your contact</span>
            </div>
            <label class="col-lg-1 col-form-label">Fax:</label>
            <div class="col-lg-3">
              <div class="kt-input-icon">
                <input type="text" class="form-control" placeholder="Fax number">
                <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-info-circle"></i></span></span>
              </div>
              <span class="form-text text-muted">Please enter fax</span>
            </div>
            <label class="col-lg-1 col-form-label">Address:</label>
            <div class="col-lg-3">
              <div class="kt-input-icon">
                <input type="text" class="form-control" placeholder="Enter your address">
                <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-map-marker"></i></span></span>
              </div>
              <span class="form-text text-muted">Please enter your address</span>
            </div>
          </div>
          <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
          <div class="form-group row">
            <label class="col-lg-1 col-form-label">Postcode:</label>
            <div class="col-lg-3">
              <div class="kt-input-icon">
                <input type="text" class="form-control" placeholder="Enter your postcode">
                <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>
              </div>
              <span class="form-text text-muted">Please enter your postcode</span>
            </div>
            <label class="col-lg-1 col-form-label">User Group:</label>
            <div class="col-lg-3">
              <div class="kt-radio-inline">
                <label class="kt-radio kt-radio--solid">
                  <input type="radio" name="example_2" checked value="2"> Sales Person
                  <span></span>
                </label>
                <label class="kt-radio kt-radio--solid">
                  <input type="radio" name="example_2" value="2"> Customer
                  <span></span>
                </label>
              </div>
              <span class="form-text text-muted">Please select user group</span>
            </div>
          </div>
        </div>
      </div>

      <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
          <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
              Form Data Medik
            </h3>
          </div>
        </div>
        <div class="kt-portlet__body">
          <div class="form-group row form-group-marginless kt-margin-t-20">
            <label class="col-lg-1 col-form-label">Full Name:</label>
            <div class="col-lg-3">
              <input type="email" class="form-control" placeholder="Full name">
              <span class="form-text text-muted">Please enter your full name</span>
            </div>
            <label class="col-lg-1 col-form-label">Email:</label>
            <div class="col-lg-3">
              <input type="email" class="form-control" placeholder="Email">
              <span class="form-text text-muted">Please enter your email</span>
            </div>
            <label class="col-lg-1 col-form-label">Username:</label>
            <div class="col-lg-3">
              <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-user"></i></span></div>
                <input type="text" class="form-control" placeholder="">
              </div>
              <span class="form-text text-muted">Please enter your username</span>
            </div>
          </div>
          <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
          <div class="form-group row form-group-marginless">
            <label class="col-lg-1 col-form-label">Contact:</label>
            <div class="col-lg-3">
              <input type="email" class="form-control" placeholder="Enter contact number">
              <span class="form-text text-muted">Please enter your contact</span>
            </div>
            <label class="col-lg-1 col-form-label">Fax:</label>
            <div class="col-lg-3">
              <div class="kt-input-icon">
                <input type="text" class="form-control" placeholder="Fax number">
                <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-info-circle"></i></span></span>
              </div>
              <span class="form-text text-muted">Please enter fax</span>
            </div>
            <label class="col-lg-1 col-form-label">Address:</label>
            <div class="col-lg-3">
              <div class="kt-input-icon">
                <input type="text" class="form-control" placeholder="Enter your address">
                <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-map-marker"></i></span></span>
              </div>
              <span class="form-text text-muted">Please enter your address</span>
            </div>
          </div>
          <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
          <div class="form-group row">
            <label class="col-lg-1 col-form-label">Postcode:</label>
            <div class="col-lg-3">
              <div class="kt-input-icon">
                <input type="text" class="form-control" placeholder="Enter your postcode">
                <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>
              </div>
              <span class="form-text text-muted">Please enter your postcode</span>
            </div>
            <label class="col-lg-1 col-form-label">User Group:</label>
            <div class="col-lg-3">
              <div class="kt-radio-inline">
                <label class="kt-radio kt-radio--solid">
                  <input type="radio" name="example_2" checked value="2"> Sales Person
                  <span></span>
                </label>
                <label class="kt-radio kt-radio--solid">
                  <input type="radio" name="example_2" value="2"> Customer
                  <span></span>
                </label>
              </div>
              <span class="form-text text-muted">Please select user group</span>
            </div>
          </div>
        </div>
        <div class="kt-portlet__foot">
          <div class="kt-form__actions">
            <div class="row">
              <div class="col-lg-5"></div>
              <div class="col-lg-7">
                <button type="reset" class="btn btn-brand">Submit</button>
                <button type="reset" class="btn btn-secondary">Cancel</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </form>
    <!--end::Form-->
  </div>
</div>



