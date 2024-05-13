<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?= $title; ?> | Penggajian Pegawai</title>

  <!-- Custom fonts for this template-->
  <link href="<?= site_url('/assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= site_url('/assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-6 col-lg-6 col-md-6 pt-5">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Ganti Password!</h1>
                  </div>
                  <?= $this->session->flashdata('pesan'); ?>
                  <form class="user" action="<?= site_url('auth/ganti_password'); ?>" method="post">
                    <div class="form-group">
                      <input type="password" name="password_lama" class="form-control form-control-user" placeholder="Password Lama">
                      <?= form_error('password_lama', '<small class="muted text-danger ml-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                      <input type="password" name="password1" class="form-control form-control-user" placeholder="Password Baru">
                      <?= form_error('password1', '<small class="muted text-danger ml-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                      <input type="password" name="password2" class="form-control form-control-user" placeholder="Konfirmasi Password">
                      <?= form_error('password2', '<small class="muted text-danger ml-3">', '</small>'); ?>
                    </div>
                    <button type="submit" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?> btn-user btn-block">
                      Ubah Password
                    </button>
                    <hr>
                  </form>
                  <div class="text-center">
                    <a class="small" href="register.html">Create an Account!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?= site_url('/assets/'); ?>vendor/jquery/jquery.min.js"></script>
  <script src="<?= site_url('/assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= site_url('/assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= site_url('/assets/'); ?>js/sb-admin-2.min.js"></script>

</body>

</html>