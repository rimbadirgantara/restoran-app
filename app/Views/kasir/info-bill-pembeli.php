<?= $this->extend('layouts/templates'); ?>

<?= $this->section('all_content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Bill</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Menu</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Porsi</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">No Meja</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($order as $o) : ?>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"><?= $o['nama_makanan']; ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0"><?= $o['porsi']; ?> Porsi</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0"><?= $o['no_meja']; ?></p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <p class="text-xs font-weight-bold mb-0">Rp. <?= $o['total_harga']; ?>,-</p>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="text-center">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">Total Harga</h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <?php foreach ($data_harga->getResult() as $row) : ?>
                                        <p class="text-xs font-weight-bold mb-0"><b>Rp. <?= $row->total_harga; ?>,-</b></p>
                                    <?php endforeach; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-lg-8 mb-lg-0 mb-4">

        <div class="row">
            <div class="col mt-4">
                <div class="card mb-4">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-1">Transaksi</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="row">

                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                    </thead>
                                    <form action="<?= base_url('/k/sendbayar/' . base64_encode($order[0]['pemesan'])); ?>" method="post">
                                        <tbody>
                                            <tr>
                                                <td>Uang Bayar</td>
                                                <td>
                                                    <div class="d-inline">
                                                        <div class="justify-content-center">
                                                            <?php foreach ($data_harga->getResult() as $row) : ?>
                                                                <input type="hidden" name="total_harga" id="total_harga" value="<?= $row->total_harga; ?>">
                                                            <?php endforeach; ?>
                                                            <input type="num" name="nomimal_pembayaran" id='nomimal_pembayaran' class="form-control <?= $validation->hasError('nomimal_pembayaran'); ?>" placeholder="Nominal Pembayaran" onchange="pembayaran();">

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Uang Kembalian</td>
                                                <td>
                                                    <div class="d-inline">
                                                        <div class="justify-content-center">
                                                            <input type="number" id='nomimal_kembalian' class="form-control" onchange="pembayaran();" disabled>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <button class="btn btn-success" type="submit">Simpan</button>
                                                    <a class="btn btn-danger btn-mini" href="<?= base_url('/k'); ?>">Kembali</a>
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
    let total_harga = document.getElementById('total_harga').value;

    function pembayaran() {
        let nomimal_pembayaran = document.getElementById('nomimal_pembayaran').value;
        // if (nomimal_pembayaran < total_harga) {
        //     alert('Nominal uang tidak cukup !');
        // }
        let total_kembalian = parseInt(nomimal_pembayaran) - parseInt(total_harga);
        if (!isNaN(total_kembalian)) {
            document.getElementById('nomimal_kembalian').value = total_kembalian;
        }
    }
</script>
<?= $this->endSection(); ?>