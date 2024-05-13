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
                    <h1 class="h4 text-gray-900 mb-4">User Profile <?= $user['role'] == 1 ? 'Admin' : 'Pegawai'; ?></h1>
                  </div>
                  <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                      <div class="col-md-4 text-center">
                        <img src="<?= site_url('/assets/img/user/') . $user['photo']; ?>" class="card-img mb-3">
                        <span class="text-muted"><?= ucfirst($user['username']); ?></span>
                        <p class="card-text">
                          <?php if ($user['status'] == 1) : ?>
                            <span class="badge badge-primary">Pegawai Tetap</span>
                          <?php else : ?>
                            <span class="badge badge-success">Pegawai Tidak Tetap</span>
                          <?php endif; ?>
                        </p>
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <table class="table">
                            <tr>
                              <th>Username</th>
                              <td>
                                <h6 class="card-title"><?= $user['username']; ?></h6>
                              </td>
                            </tr>
                            <tr>
                              <th>Pegawai</th>
                              <td>
                                <h6 class="card-title"><?= $user['nama_pegawai']; ?></h6>
                              </td>
                            </tr>
                            <tr>
                              <th>Tanggal Masuk</th>
                              <?php $tglMasuk = date_create($user['tgl_masuk']); ?>
                              <td><span class="text-muted"><?= date_format($tglMasuk, 'd F Y'); ?></span></td>
                            </tr>
                            <tr>
                              <th>Status</th>
                              <?php $tglMasuk = date_create($user['tgl_masuk']); ?>
                              <td><?= $user['status'] == 'L' ? 'Wanita' : 'Pria'; ?></td>
                            </tr>
                          </table>
                          <p class="card-text"><small class="text-muted">Programmer Indonesia</small></p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="text-center">
                    <a class="small" href="<?= site_url('admin/dashboard'); ?>">Kembali</a>
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