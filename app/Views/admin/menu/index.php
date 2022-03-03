<?= $this->extend('layouts/templates_admin'); ?>

<?= $this->section('all_content'); ?>

<!-- Main content -->
<div class="content">
    <div class="berhasil-hapus-order" data-flashdata="<?= session()->getFlashdata('berhasil_hapus_data_order'); ?>"></div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Menu</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 250px;">

                            <div class="input-group-append">
                                <a href="#" class="btn btn-success btn-sm mr-3"><b>+</b></a>
                                <form action="" method="post">
                                    <input type="text" name="keyword" class="form-control form-control-sm float-right ml-2" style="width: 151px;" placeholder="Search">
                                    <button type="submit" name="submit" class="btn btn-default btn-sm">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <?php foreach ($menu as $m) : ?>
                            <div class="col">
                                <div class="card" style="width: 19rem;">
                                    <img src="<?= base_url('/assets/foodwebsite/images/' . $m['gambar_masakan']); ?>" alt="" class="card-img-top">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $m['nama_masakan']; ?></h5>
                                        <p class="card-text"><?= $m['ket_makanan']; ?>.</p>
                                        <p class="card-text">Rp. <?= $m['harga']; ?>,-</p>
                                        <div class="row">
                                            <div class="col-6">
                                                <a href="#" class="btn btn-info btn-sm btn-block">
                                                    Info
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <a href="#" class="btn btn-danger btn-sm btn-block">
                                                    Hapus
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?= $this->endSection(); ?>