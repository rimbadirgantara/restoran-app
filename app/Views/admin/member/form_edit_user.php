<?= $this->extend('layouts/templates_admin'); ?>

<?= $this->section('all_content'); ?>

<!-- Main content -->
<div class="content">
    <div class="row">
        <div class="col">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Info <?= $pembeli['nama']; ?></h3>
                </div>
                <form action="<?= base_url('/member/' . base64_encode($pembeli['id']) . '/sendedit'); ?>" method="post">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : '' ?>" name="nama" value="<?= $pembeli['nama']; ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nama'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Alaman Email</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>" name="email" value="<?= $pembeli['email']; ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('email'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>" name="username" value="<?= $pembeli['username']; ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('username'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Status akun</label>
                                    <select class="form-control" name="status_akun">
                                        <?php if ($pembeli['status_akun'] === 'aktif') : ?>
                                            <option>Aktif</option>
                                            <option>Non Aktif</option>
                                        <?php elseif ($pembeli['status_akun'] === 'non aktif') : ?>
                                            <option>Non Aktif</option>
                                            <option>Aktif</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?= $this->endSection(); ?>