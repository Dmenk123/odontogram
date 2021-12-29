<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

  <!-- begin:: Content Head -->
  <div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
      <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">
          <?= $title ?>
        </h3>
      </div>
    </div>
  </div>
  <!-- end:: Content Head -->

  <!-- begin:: Content -->
  <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

    <div class="kt-portlet kt-portlet--mobile">
      <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
          <span class="kt-portlet__head-icon">
            <i class="kt-font-brand flaticon2-line-chart"></i>
          </span>
          <h3 class="kt-portlet__head-title">
            <?= $title; ?>
          </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
          <div class="kt-portlet__head-wrapper">
            <div class="kt-portlet__head-actions">
            </div>
          </div>
        </div>
      </div>
      <div class="kt-portlet__body">
        <div class="row">

          <div class="col-xl-6 col-lg-6 order-lg-2 order-xl-1">

            <!--begin:: Widgets/Daily Sales-->
            <div class="kt-portlet kt-portlet--height-fluid">
              <div class="kt-widget14">
                <div class="kt-widget14__header">
                  <h3 class="kt-widget14__title">
                    Kunjungan Klinik
                  </h3>
                </div>
                <div class="kt-widget14__chart" style="height:150;">
                  <div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand">
                      <div class=""></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink">
                      <div class=""></div>
                    </div>
                  </div>
                  <canvas id="dash_kunjungan" style="display: block; height: 150; width: 418px;" width="376" height="150" class="chartjs-render-monitor"></canvas>
                </div>
              </div>
            </div>

            <!--end:: Widgets/Daily Sales-->
          </div>

          <div class="col-xl-6 col-lg-6 order-lg-2 order-xl-1">

            <!--begin:: Widgets/Daily Sales-->
            <div class="kt-portlet kt-portlet--height-fluid">
              <div class="kt-widget14">
                <div class="kt-widget14__header">
                  <h3 class="kt-widget14__title">
                    Omset Per Klinik
                  </h3>
                </div>
                <div class="kt-widget14__chart" style="height:150;">
                  <div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand">
                      <div class=""></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink">
                      <div class=""></div>
                    </div>
                  </div>
                  <canvas id="dash_omset" style="display: block; height: 150; width: 418px;" width="376" height="150" class="chartjs-render-monitor"></canvas>
                </div>
              </div>
            </div>

            <!--end:: Widgets/Daily Sales-->
          </div>

        </div>

        <div class="row">

          <div class="col-xl-6 col-lg-6 order-lg-2 order-xl-1">

            <!--begin:: Widgets/Daily Sales-->
            <div class="kt-portlet kt-portlet--height-fluid">
              <div class="kt-widget14">
                <div class="kt-widget14__header">
                  <h3 class="kt-widget14__title">
                    Total Kunjungan Klinik
                  </h3>
                </div>
                <div class="kt-widget14__chart" style="height:150;">
                  <div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand">
                      <div class=""></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink">
                      <div class=""></div>
                    </div>
                  </div>
                  <canvas id="dash_total_kunjungan" style="display: block; height: 150; width: 418px;" width="376" height="150" class="chartjs-render-monitor"></canvas>
                </div>
              </div>
            </div>

            <!--end:: Widgets/Daily Sales-->
          </div>

          <div class="col-xl-6 col-lg-6 order-lg-2 order-xl-1">

            <!--begin:: Widgets/Daily Sales-->
            <div class="kt-portlet kt-portlet--height-fluid">
              <div class="kt-widget14">
                <div class="kt-widget14__header">
                  <h3 class="kt-widget14__title">
                    Total Honor Dokter
                  </h3>
                </div>
                <div class="kt-widget14__chart" style="height:150;">
                  <div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand">
                      <div class=""></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink">
                      <div class=""></div>
                    </div>
                  </div>
                  <canvas id="dash_omset_dokter" style="display: block; height: 150; width: 418px;" width="376" height="150" class="chartjs-render-monitor"></canvas>
                </div>
              </div>
            </div>

            <!--end:: Widgets/Daily Sales-->
          </div>

        </div>

      </div>
    </div>
  </div>

</div>