<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/admin/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/admin/dist/css/adminlte.min.css">
    <link rel="shortcut icon" type="image/png" href="<?= base_url(); ?>/assets/foodwebsite/images/home-img.png" />
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?= base_url(); ?>/assets/admin/dist/img/AdminLTELogo.png" height="60" width="60">
        </div>

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="<?= base_url(); ?>/assets/foodwebsite/images/home-img.png" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"><?= $sidebar_banner; ?></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= base_url(); ?>/assets/admin/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?= session()->get('username'); ?> | Admin</a>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-header">Navigasi Admin</li>
                        <li class="nav-item">
                            <?php if ($menuSegment === 'owner') : ?>
                                <a href="<?= base_url('/owner'); ?>" class="nav-link active">
                                <?php else : ?>
                                    <a href="<?= base_url('/owner'); ?>" class="nav-link">
                                    <?php endif; ?>
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                    </a>
                        </li>
                        <li class="nav-item">
                            <?php if ($menuSegment === 'member') : ?>
                                <a href="<?= base_url('/member'); ?>" class="nav-link active">
                                <?php else : ?>
                                    <a href="<?= base_url('/member'); ?>" class="nav-link">
                                    <?php endif; ?>
                                    <i class="nav-icon fas fas fa-users"></i>
                                    <p>
                                        Member
                                    </p>
                                    </a>
                        </li>
                        <li class="nav-item">
                            <?php if ($menuSegment === 'order') : ?>
                                <a href="<?= base_url('/order'); ?>" class="nav-link active">
                                <?php else : ?>
                                    <a href="<?= base_url('/order'); ?>" class="nav-link">
                                    <?php endif; ?>
                                    <i class="nav-icon fa fa-tasks"></i>
                                    <p>
                                        Order
                                    </p>
                                    </a>
                        </li>
                        <li class="nav-item">
                            <?php if ($menuSegment === 'profit') : ?>
                                <a href="<?= base_url('/profit'); ?>" class="nav-link active">
                                <?php else : ?>
                                    <a href="<?= base_url('/profit'); ?>" class="nav-link">
                                    <?php endif; ?>
                                    <i class="nav-icon fas fa-shopping-cart"></i>
                                    <p>
                                        Profit
                                    </p>
                                    </a>
                        </li>
                        <li class="nav-item">
                            <?php if ($menuSegment === 'menu') : ?>
                                <a href="<?= base_url('/menu'); ?>" class="nav-link active">
                                <?php else : ?>
                                    <a href="<?= base_url('/menu'); ?>" class="nav-link">
                                    <?php endif; ?>
                                    <i class="nav-icon far fa-calendar-alt"></i>
                                    <p>
                                        Menu
                                    </p>
                                    </a>
                        </li>
                        <li class="nav-header">Navigasi Halaman Depan</li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><?= $page_name; ?></h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#"><?= $page_name; ?></a></li>
                                <li class="breadcrumb-item active"><?= $sub_page; ?></li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- content -->
            <?= $this->renderSection('all_content'); ?>
            <!-- end content -->

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <div class="p-3">
                    <h5>Title</h5>
                    <p>Sidebar content</p>
                </div>
            </aside>
            <!-- /.control-sidebar -->

            <footer class="main-footer">
                <div class="float-right d-none d-sm-inline">
                    Template by AdminLTE
                </div>
                <strong>&copy; <?= date('Y', time()); ?> made with <i class="fa fa-heart"></i> by <a href="https://rimbadirgantara.github.io">Rimba Dirgantara</a></strong>
            </footer>
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <script src="<?= base_url(); ?>/assets/admin/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="<?= base_url(); ?>/assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="<?= base_url(); ?>/assets/admin/dist/js/adminlte.min.js"></script>
</body>

</html>