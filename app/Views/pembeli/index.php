<?= $this->extend('pembeli/templates'); ?>

<?= $this->section('all_content'); ?>
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
           <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Money</p>
                    <h5 class="font-weight-bolder mb-0">
                      $53,000
                      <span class="text-success text-sm font-weight-bolder">+55%</span>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Users</p>
                    <h5 class="font-weight-bolder mb-0">
                      2,300
                      <span class="text-success text-sm font-weight-bolder">+3%</span>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">New Clients</p>
                    <h5 class="font-weight-bolder mb-0">
                      +3,462
                      <span class="text-danger text-sm font-weight-bolder">-2%</span>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Sales</p>
                    <h5 class="font-weight-bolder mb-0">
                      $103,430
                      <span class="text-success text-sm font-weight-bolder">+5%</span>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
          
              <div class="row">    
                <div class="col-12 mt-4">
                  <div class="card mb-4">
                    <div class="card-header pb-0 p-3">
                      <h6 class="mb-1">Menu</h6>
                    </div>
                    <div class="card-body p-3">
                      <div class="row">
                        <?php foreach($menu as $m): ?>
                          <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
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
                                <?= $m['ket_makanan']; ?>.
                              </p>
                            </div>
                            <div class="card-footer px-1 pb-0">
                              <div class="d-flex align-items-center justify-content-between">
                                <button type="button" class="btn btn-outline-primary btn-sm mb-0">Pesan</button>
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