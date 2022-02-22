<?= $this->extend('pembeli/templates'); ?>

<?= $this->section('all_content'); ?>

<div class="row mt-4">
  <div class="col-lg-12 mb-lg-0 mb-4">
    <?php if ($order) : ?>
      <?php if ($order[0]['status'] === 'Belum di proses') : ?>
        <div class="row">
          <div class="col-12 mt-4">
            <div class="card mb-4">
              <div class="card-header pb-0 p-3">
                <h6 class="mb-1">Keranjang Pesanan</h6>
              </div>
              <div class="card-body p-3">
                <div class="row">

                  <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Menu Pesanan</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jumlah Porsi</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Harga</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($order as $o) : ?>
                          <tr>
                            <td>
                              <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                  <h6 class="mb-0 text-sm"><?= $o['nama_makanan']; ?></h6>
                                </div>
                              </div>
                            </td>
                            <td>
                              <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                  <h6 class="mb-0 text-sm"><?= $o['porsi']; ?> porsi</h6>
                                </div>
                              </div>
                            </td>
                            <td>
                              <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                  <input type="hidden" id="asdf" value="<?= $o['total_harga']; ?>">
                                  <h6 class="mb-0 text-sm">Rp. <?= $o['total_harga']; ?>,-</h6>
                                </div>
                              </div>
                            </td>

                            <td>
                              <form action="<?= base_url('/a/' . $o['id'] . '/delete_order/') ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger mt-3 btn-mini"><i class="fas fa-trash"></i></button>
                              </form>
                              <form action="<?= base_url('/a/' . $o['id'] . '/delete_order/') ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="PUT">
                                <button type="submit" class="btn btn-warning mt-3 btn-mini"><i class="fas fa-pen"></i></button>
                              </form>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                        <tr>
                          <td></td>
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
                                <?php foreach ($data_harga->getResult() as $row) : ?>
                                  <span class="label">Rp. <?= $row->total_harga; ?>,-</span>
                                <?php endforeach; ?>
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="d-flex px-2 py-1">
                              <div class="justify-content-center">
                                <form action="<?= base_url('/a/' . session()->get('username') . '/proses_pesanan_v2'); ?>" method="post">
                                  <input type="hidden" name="_method" value="PUT" />
                                  <button class="btn btn-info btn-mini">Proses Pesanan</button>
                                </form>
                              </div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php elseif ($order[0]['status'] === 'Tolong di proses') : ?>
        <div class="row">
          <div class="col-8">
            <table class="table table-hover text-nowrap table-bordered">
              <thead class="text-center">
                <tr>
                  <th style="width: 5px">No.</th>
                  <th style="width: 10px">Menu</th>
                  <th style="width: 5px">Porsi</th>
                  <th style="width: 10px">Harga</th>
                </tr>
              </thead>
              <tbody class="text-center">
                <?php $i = 1;
                foreach ($order as $o) : ?>
                  <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $o['nama_makanan']; ?></td>
                    <td><?= $o['porsi']; ?></td>
                    <td>Rp. <?= $o['total_harga']; ?>,-</td>
                  </tr>
                <?php endforeach; ?>
                <tr>
                  <td></td>
                  <td>Total Semua</td>
                  <td></td>
                  <td>
                    <?php foreach ($data_harga->getResult() as $row) : ?>
                      Rp. <?= $row->total_harga; ?>,-
                    <?php endforeach; ?>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="widget-box span12">
            <div class="widget-title"> <span class="icon"> <i class="icon-hand-right"></i> </span>
            </div>
            <div class="widget-content">
              <div class="alert alert-block">
                <h4 class="alert-heading">Informasi !</h4>
                Terimakasih, Anda telah melakukan pemesanan.<br>
                Silahkan tunggu pesanan tiba di meja saudara. Apabila selesai menyantap hidangan, silahkan lakukan proses pembayaran di kasir !
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>
    <?php endif; ?>

    <div class=" row" id="menu">
      <div class="col-12 mt-4">
        <div class="card mb-4">
          <div class="card-header pb-0 p-3">
            <h6 class="mb-1">Menu</h6>
          </div>
          <div class="card-body p-3">
            <div class="row">
              <?php foreach ($menu as $m) : ?>
                <div class="col-xl-3 col-md-6 mb-xl-0 mb-4 mt-1">
                  <div class="card card-blog card-plain">
                    <div class="position-relative">
                      <a class="d-block shadow-xl border-radius-xl">
                        <img src="<?= base_url(); ?>/assets/login_page/assets/img/menu/<?= $m['gambar_masakan']; ?>" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                      </a>
                    </div>
                  </div>
                  <div class="card-body px-1 pb-0">
                    <a href="javascript:;">
                      <h5>
                        <?= $m['nama_masakan']; ?>
                      </h5>
                    </a>
                    <p class="mb-4 text-sm">
                      Harga Rp. <?= floatval($m['harga']); ?>.
                    </p>
                  </div>
                  <div class="card-footer px-1 pb-0">
                    <div class="d-flex align-items-center justify-content-between">
                      <?php if ($order) : ?>
                        <?php if ($order[0]['status'] === 'Tolong di proses') : ?>
                          <a class="btn btn-outline-primary btn-sm mb-0" onclick="alert('Pesanan anda sedang di proses')">Pesan</a>
                        <?php elseif ($order[0]['status'] === 'Belum di proses') : ?>
                          <a class="btn btn-outline-primary btn-sm mb-0" href="<?= base_url('/a/' . $m['slug'] . '/proses'); ?>">Pesan</a>
                        <?php endif; ?>
                      <?php else : ?>
                        <a class="btn btn-outline-primary btn-sm mb-0" href="<?= base_url('/a/' . $m['slug'] . '/proses'); ?>">Pesan</a>
                      <?php endif; ?>
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
</div>
<?= $this->endSection(); ?>