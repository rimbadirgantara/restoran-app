<?= $this->extend('layouts/templates_admin'); ?>

<?= $this->section('all_content'); ?>

<!-- Main content -->
<div class="content">
    <div class="berhasil-hapus-user" data-flashdata="<?= session()->getFlashdata('berhasil_hapus_user'); ?>"></div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List Pembeli</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
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
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 + (5 * ($current_page - 1));
                            foreach ($pembeli as $p) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td>
                                        <?= $p['nama']; ?><br>
                                        <small class="badge <?= ($p['status'] === 'online') ? 'badge-success' : 'badge-danger'; ?>"><?= $p['status']; ?></small>
                                    </td>
                                    <td><?= $p['email']; ?></td>
                                    <td><span class="badge <?= ($p['status_akun'] === 'aktif') ? 'badge-success' : 'badge-danger'; ?>"><?= $p['status_akun']; ?></span></td>
                                    <td>
                                        <form action="<?= base_url('/member/' . base64_encode($p['id']) . '/edit'); ?>" method="post" class="d-inline">
                                            <input type="hidden" name="_method" value="GET" />
                                            <button class="btn btn-info btn-sm">Info</button>
                                        </form>
                                        <form action="<?= base_url('/member/' . base64_encode($p['id']) . '/delete'); ?>" method="post" class="d-inline">
                                            <input type="hidden" name="_method" value="DELETE" />
                                            <?= csrf_field(); ?>
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('yakin mau hapus user ?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="ml-3">
                        <?= $pembeli_pager->links('pembeli', 'list_user'); ?>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?= $this->endSection(); ?>