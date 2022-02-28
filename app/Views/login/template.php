<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title; ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url(); ?>/assets/assets_login/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url(); ?>/assets/assets_login/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url(); ?>/assets/assets_login/dist/css/adminlte.min.css">
  <link rel="shortcut icon" type="image/png" href="<?= base_url(); ?>/assets/assets_login/dist/img/polbeng_.png" />
</head>

<?= $this->renderSection('konten_login'); ?>

<script src="<?= base_url(); ?>/assets/assets_login/plugins/jquery/jquery.min.js"></script>
<script src="<?= base_url(); ?>/assets/assets_login/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url(); ?>/assets/assets_login/dist/js/adminlte.min.js"></script>
<!-- Sweet alert -->
<script src="<?= base_url(); ?>/assets/assets_login/dist/latihan/dist/sweetalert2.all.min.js"></script>
<!-- my js -->
<script src="<?= base_url(); ?>/assets/assets_login/dist/latihan/dist/myscript.js"></script>
</body>

</html>