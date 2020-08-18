<div class="col-lg-4 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
        <div class="inner">
            <h3><?= $data_dashboard['jumlah_sudah_verifikasi'] ?></h3>

            <p>Jumlah Pengeluaran Bulan : <?= $data_dashboard['bulan_indo'] ?></p>
        </div>
        <div class="icon">
            <i class="fa fa-minus-square"></i>
        </div>
    </div>
</div>

<div class="col-lg-4 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
        <div class="inner">
            <h3><?= $data_dashboard['jumlah_penerimaan'] ?></h3>

            <p>Jumlah Penerimaan Bulan : <?= $data_dashboard['bulan_indo'] ?></p>
        </div>
        <div class="icon">
            <i class="fa fa-plus-square"></i>
        </div>
    </div>
</div>

<div class="col-lg-4 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-purple">
        <div class="inner">
            <h3>Rp. <?= number_format($data_dashboard['nilai_out'], 0, ",", "."); ?></h3>

            <p>Nilai Pengeluaran Bulan : <?= $data_dashboard['bulan_indo'] ?></p>
        </div>
        <div class="icon">
            <i class="fa fa-money"></i>
        </div>
    </div>
</div>

<div class="col-lg-4 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-orange">
        <div class="inner">
            <h3>Rp. <?= number_format($data_dashboard['nilai_in'], 0, ",", "."); ?></h3>

            <p>Nilai Penerimaan Bulan : <?= $data_dashboard['bulan_indo'] ?></p>
        </div>
        <div class="icon">
            <i class="fa fa-money"></i>
        </div>
    </div>
</div>