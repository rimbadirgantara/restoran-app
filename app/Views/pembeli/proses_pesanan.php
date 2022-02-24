<?= $this->extend('layouts/templates'); ?>

<?= $this->section('all_content'); ?>

<div class="row mt-4">
    <div class="col-lg-8 mb-lg-0 mb-4">

        <div class="row">
            <div class="col mt-4">
                <div class="card mb-4">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-1">Form Pesanan</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="row">

                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Menu Pesanan</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jumlah Porsi</th>
                                        </tr>
                                    </thead>
                                    <form action="<?= base_url('/a/' . $makanan['slug'] . '/proses_pesanan'); ?>" method="post">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm"><?= $makanan['nama_masakan']; ?></h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <input type="hidden" nama="harga_makanan" id="harga_makanan" value="<?= $makanan['harga']; ?>">
                                                            <input type="number" name="jumlah_porsi" id='jumlah_porsi' class="form-control <?= ($validation->hasError('jumlah_porsi')) ? 'is-invalid' : '' ?>" placeholder="Jumlah Porsi" onchange="jumlah_harga();">
                                                            <div class="invalid-feedback">
                                                                <?= $validation->getError('jumlah_porsi'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">No Meja</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <input type="text" name="no_meja" class="form-control <?= ($validation->hasError('no_meja')) ? 'is-invalid' : '' ?>">
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('no_meja'); ?>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">Total Harga</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <input type="number" id="total_harga" name="total_harga" class="form-control" disabled="">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="justify-content-center">
                                                            <button class="btn btn-info btn-mini" type="submit">Proses Pesanan</button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </form>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let harga = document.getElementById('harga_makanan').value;

    function jumlah_harga() {
        let porsi = document.getElementById('jumlah_porsi').value;
        let total = parseInt(harga) * parseInt(porsi);
        if (!isNaN(total)) {
            document.getElementById('total_harga').value = total;
        }
    }
</script>
<?= $this->endSection(); ?>