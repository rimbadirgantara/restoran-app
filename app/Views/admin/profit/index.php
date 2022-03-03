<?= $this->extend('layouts/templates_admin'); ?>

<?= $this->section('all_content'); ?>

<!-- Main content -->
<div class="content">
    <div class="hapus-semua-data-profit" data-flashdata="<?= session()->getFlashdata('hapus_semua_data_profit'); ?>"></div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List Pembeli</h3>

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
                                <th>No</th>
                                <th>Nama Pemesan</th>
                                <th>Total Harga</th>
                                <th>Waktu Memesan</th>
                                <th>Waktu Bayar</th>
                                <th>Kasir</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 + (5 * ($current_page - 1));
                            foreach ($profit as $p) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $p['pemesan']; ?></td>
                                    <td>
                                        <?= $p['total_harga']; ?>
                                    </td>
                                    <td>
                                        <?= date('H:i', $p['waktu_dibuat']); ?> WIB<br>
                                        <small class="badge"><?= date('d/n/Y - H:i', $p['waktu_dibuat']); ?></small>
                                    </td>
                                    <td>
                                        <?= date('H:i', $p['waktu_bayar']); ?> WIB<br>
                                        <small class="badge"><?= date('d/n/Y - H:i', $p['waktu_bayar']); ?></small>
                                    </td>
                                    <td><?= $p['kasir']; ?></td>
                                    <td>
                                        <span class="badge <?= ($p['status'] === 'Sudah Bayar') ? 'badge-success' : 'badge-danger'; ?>"><?= $p['status']; ?></span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="ml-3">
                        <?php foreach ($total_pendapatan->getResultArray() as $a) : ?>
                            <p class="mt-3">Total Pendapatan : Rp. <?= $a['total_harga']; ?>,- *Hanya menghitung yang sudah bayar</p>
                        <?php endforeach; ?>
                        <?= $profit_pager->links('profit', 'profit'); ?>
                        <div class="row">
                            <div class="col-6">
                                <h6>
                                    <a class="btn btn-sm btn-block btn-info mt-1" href="<?= base_url('admin/exportPDF_transaksi'); ?>" target="_blank">Export ke PDF</a>
                                </h6>
                            </div>
                            <div class="col-6">
                                <form action="<?= base_url('/profit/del_all'); ?>" method="post">
                                    <input type="hidden" name="_method" value="DELETE" />
                                    <?= csrf_field(); ?>
                                    <button class="btn btn-sm btn-block btn-danger mt-1" onclick="return confirm('yakin mau hapus semua data ?')">Hapus</button>
                                </form>
                            </div>
                        </div>
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