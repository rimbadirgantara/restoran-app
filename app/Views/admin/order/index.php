<?= $this->extend('layouts/templates_admin'); ?>

<?= $this->section('all_content'); ?>

<!-- Main content -->
<div class="content">
    <div class="berhasil-hapus-user" data-flashdata="<?= session()->getFlashdata('berhasil_hapus_user'); ?>"></div>
    <div class="berhasil-update-user" data-flashdata="<?= session()->getFlashdata('edit_berhasil'); ?>"></div>
    <div class="berhasil-tambah-user" data-flashdata="<?= session()->getFlashdata('berhasil_tambah_user'); ?>"></div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List Order</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 250px;">

                            <div class="input-group-append">
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
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No. Meja</th>
                                <th>Pemesan</th>
                                <th>Makanan</th>
                                <th>Harga</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($order as $p) : ?>
                                <tr>
                                    <td><?= $p['no_meja']; ?></td>
                                    <td>
                                        <?= $p['pemesan']; ?><br>
                                        <small class="badge"><?= date('d/n/Y - H:i', $p['waktu_dibuat']); ?></small>
                                    </td>
                                    <td><?= $p['nama_makanan']; ?></td>
                                    <td>
                                        <?= $p['total_harga']; ?>
                                    </td>
                                    <td>
                                        <small class="badge <?= ($p['status'] === 'Belum di proses') ? 'badge-warning' : 'badge-info'; ?>"><?= $p['status']; ?></small>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="ml-3">
                        <?= $order_pager->links('order', 'order'); ?>
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