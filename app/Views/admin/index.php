<?= $this->extend('layouts/templates_admin'); ?>

<?= $this->section('all_content'); ?>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <a href="<?= base_url('/member'); ?>" style="color: black;" title="Jumlah Member">
                    <div class="info-box shadow">
                        <span class="info-box-icon bg-success"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Member</span>
                            <span class="info-box-number"><?= $jumlah_semua; ?> Orang</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <a href="#" style="color: black;" title="Jumlah Order">
                    <div class="info-box shadow">
                        <span class="info-box-icon bg-warning"><i class="fa fa-tasks"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Order</span>
                            <span class="info-box-number"><?= $jumlah_order; ?> Order</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <a href="#" style="color: black;" title="Total Profit">
                    <div class="info-box shadow">
                        <span class="info-box-icon bg-info"><i class="fas fa-shopping-cart"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Profit</span>
                            <?php foreach ($profit as $profit) : ?>
                                <span class="info-box-number">Rp. <?= $profit['total_harga']; ?>.-</span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <a href="#" style="color: black;" title="Jumlah Menu">
                    <div class="info-box shadow">
                        <span class="info-box-icon bg-warning"><i class="far fa-calendar-alt"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Menu</span>
                            <span class="info-box-number"><?= $jumlah_menu; ?> Menu</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?= $this->endSection(); ?>