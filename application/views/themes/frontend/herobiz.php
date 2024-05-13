<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="Access-Control-Allow-Origin" content="*"/>
        <meta name="theme-color" content="#e74a3b">
        <meta name="apple-mobile-web-app-status-bar-style" content="#e74a3b" />
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="description" content="<?= $company['about']; ?>">
        <meta name="author" content="<?= $company['owner']; ?>">
        <meta name="title" content="<?= $company['company_name']; ?>">
        <meta name="keywords" content="<?= $company['keyword']; ?>">
        <meta http-equiv="refresh" content="<?= $company['refresh']; ?>">
        <title><?= $title ?> || Landing <?= $company['nama_singkat'] ?></title>
        <link rel="shortcut icon" href="<?= site_url('assets/images/favicon.png') ?>" sizes="16x16" type="image/png">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
        <link href="https://files.billing.or.id//assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://files.billing.or.id//assets/vendor/aos/aos.css" rel="stylesheet">
        <link href="https://files.billing.or.id//assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
        <link href="https://files.billing.or.id//assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
        <link href="https://files.billing.or.id//assets/css/variables.css" rel="stylesheet">
        <link href="https://files.billing.or.id//assets/css/main.css" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.5.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
        <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
        <style>
            ::-webkit-scrollbar {
                width: 10px;
                height: 10px;
            }
    
            ::-webkit-scrollbar-track {
                background: #f1f1f1;
            }
    
            ::-webkit-scrollbar-track:hover {
                background: #f1f1f1;
            }
        </style>
        <?php if ($company['front'] == 'primary') {
            $backgroundnya = '#0ea2bd';
            $colornya = '#fff';
            $colorsub = '#000';
        ?>
            <style>
                ::-webkit-scrollbar-thumb {
                    background: <?= $backgroundnya ?>;
                }
    
                ::-webkit-scrollbar-thumb:hover {
                    background: <?= $backgroundnya ?>;
                }
            </style>
        <?php } elseif ($company['front'] == 'secondary') {
            $backgroundnya = '#485664';
            $colornya = '#fff';
            $colorsub = '#000';
        ?>
            <style>
                ::-webkit-scrollbar-thumb {
                    background: <?= $backgroundnya ?>;
                }
    
                ::-webkit-scrollbar-thumb:hover {
                    background: <?= $backgroundnya ?>;
                }
            </style>
        <?php } elseif ($company['front'] == 'success') {
            $backgroundnya = '#1cc88a';
            $colornya = '#fff';
            $colorsub = '#000';
        ?>
            <style>
                ::-webkit-scrollbar-thumb {
                    background: <?= $backgroundnya ?>;
                }
    
                ::-webkit-scrollbar-thumb:hover {
                    background: <?= $backgroundnya ?>;
                }
            </style>
        <?php } elseif ($company['front'] == 'danger') {
            $backgroundnya = '#dc3545';
            $colornya = '#fff';
            $colorsub = '#000';
        ?>
            <style>
                ::-webkit-scrollbar-thumb {
                    background: <?= $backgroundnya ?>;
                }
    
                ::-webkit-scrollbar-thumb:hover {
                    background: <?= $backgroundnya ?>;
                }
            </style>
        <?php } elseif ($company['front'] == 'warning') {
            $backgroundnya = '#ffc107';
            $colornya = '#fff';
            $colorsub = '#000';
        ?>
            <style>
                ::-webkit-scrollbar-thumb {
                    background: <?= $backgroundnya ?>;
                }
    
                ::-webkit-scrollbar-thumb:hover {
                    background: <?= $backgroundnya ?>;
                }
            </style>
        <?php } elseif ($company['front'] == 'info') {
            $backgroundnya = '#0dcaf0';
            $colornya = '#fff';
            $colorsub = '#000';
        ?>
            <style>
                ::-webkit-scrollbar-thumb {
                    background: <?= $backgroundnya ?>;
                }
    
                ::-webkit-scrollbar-thumb:hover {
                    background: <?= $backgroundnya ?>;
                }
            </style>
        <?php } elseif ($company['front'] == 'dark') {
            $backgroundnya = '#212529';
            $colornya = '#fff';
            $colorsub = '#000';
        ?>
            <style>
                ::-webkit-scrollbar-thumb {
                    background: <?= $backgroundnya ?>;
                }
    
                ::-webkit-scrollbar-thumb:hover {
                    background: <?= $backgroundnya ?>;
                }
            </style>
        <?php } elseif ($company['front'] == 'light') {
            $backgroundnya = '#f8f9fa';
            $colornya = '#000';
            $colorsub = '#000';
        ?>
            <style>
                ::-webkit-scrollbar-thumb {
                    background: <?= $backgroundnya ?>;
                }
    
                ::-webkit-scrollbar-thumb:hover {
                    background: <?= $backgroundnya ?>;
                }
            </style>
        <?php } elseif ($company['front'] == 'default') {
            $backgroundnya = '#1a1f24';
            $colornya = '#fff';
            $colorsub = '#000';
        ?>
            <style>
                ::-webkit-scrollbar-thumb {
                    background: <?= $backgroundnya ?>;
                }
    
                ::-webkit-scrollbar-thumb:hover {
                    background: <?= $backgroundnya ?>;
                }
            </style>
        <?php } elseif ($company['front'] == 'purple') {
            $backgroundnya = '#6f42c1';
            $colornya = '#fff';
            $colorsub = '#000';
        ?>
            <style>
                ::-webkit-scrollbar-thumb {
                    background: <?= $backgroundnya ?>;
                }
    
                ::-webkit-scrollbar-thumb:hover {
                    background: <?= $backgroundnya ?>;
                }
            </style>
        <?php } elseif ($company['front'] == 'orange') {
            $backgroundnya = '#fd7e14';
            $colornya = '#fff';
            $colorsub = '#000';
        ?>
            <style>
                ::-webkit-scrollbar-thumb {
                    background: <?= $backgroundnya ?>;
                }
    
                ::-webkit-scrollbar-thumb:hover {
                    background: <?= $backgroundnya ?>;
                }
            </style>
        <?php } else {
            $backgroundnya = '#e74a3b';
            $colornya = '#fff';
            $colorsub = '#000';
        ?>
            <style>
                ::-webkit-scrollbar-thumb {
                    background: <?= $backgroundnya ?>;
                }
    
                ::-webkit-scrollbar-thumb:hover {
                    background: <?= $backgroundnya ?>;
                }
            </style>
        <?php } ?>
    </head>
    <body>
        <header id="header" class="header fixed-top bg-<?= $company['front'] ?> shadow" data-scrollto-offset="0">
            <div class="container d-flex align-items-center justify-content-between"
              <a href="index.html" class="logo d-flex align-items-center scrollto me-auto me-lg-0">
                <img src="<?= site_url('assets/images/') ?><?= $company['logo'] ?>" alt="logo" class="logo" height="30">
              </a>
              <nav id="navbar" class="navbar">
                <ul>
                  <li><a href="<?= site_url('front') ?>" class="<?= $title == 'Halaman Depan' ? 'active' : '' ?>" style="color: <?= $colornya ?>;"><b>BERANDA</b></a></li>
                  <li><a href="<?= site_url('download.html') ?>" class="<?= $title == 'Download File' ? 'active' : '' ?>" style="color: <?= $colornya ?>;"><b>MEDIA</b></a></li>
                  <li><a href="<?= site_url('syarat-dan-ketentuan.html') ?>" class="<?= $title == 'Syarat dan Ketentuan' ? 'active' : '' ?>" style="color: <?= $colornya ?>;"><b>SYARAT</b></a></li>
                  <li><a href="<?= site_url('kebijakan-privasi.html') ?>" class="<?= $title == 'Kebijakan Privasi' ? 'active' : '' ?>" style="color: <?= $colornya ?>;"><b>PRIVASI</b></a></li>
                  <li><a href="share" target="_blank" style="color: <?= $colornya ?>;"><b>BAGIKAN</b></a></li>
                  <li><a href="download" target="_blank" style="color: <?= $colornya ?>;"><b>APLIKASI</b></a></li>
                </ul>
                <i class="fa fa-list mobile-nav-toggle d-none" style="margin-top: 5px; color: <?= $colornya ?>;"></i>
              </nav>
              <a class="btn scrollto" style="margin-right: 40px; background: <?= $colornya ?>; color: <?= $backgroundnya ?>;" href="<?= site_url('auth') ?>"><b>LOGIN</b></a>
            </div>
        </header>
        <main id="main" style="padding-top: 0px; padding-bottom: 15px; padding-left: 10px; padding-right: 10px;">
            <br><br><br><br>
            <?= $contents ?>
            <br>
        </main>
        <footer id="footer" style="background: <?= $backgroundnya ?>" class="footer bg-<?= $company['front'] ?> shadow">
            <div class="footer-legal text-center" style="background: <?= $backgroundnya ?>">
              <div class="container d-flex flex-column flex-lg-row justify-content-center justify-content-lg-between align-items-center">
                <div class="d-flex flex-column align-items-center align-items-lg-start">
                  <div class="copyright">
                    &copy; Copyright <?= date('Y') ?> - <strong><span><?= $company['company_name'] ?></span></strong>
                  </div>
                  <div class="credits" style="color: <?= $colornya ?>;">
                    Created And Developed by <a href="<?= base_url() ?>" style="color: <?= $colornya ?>;"><b><?= $company['owner'] ?></b></a>
                  </div>
                </div>
                <div class="social-links order-first order-lg-last mb-3 mb-lg-0">
                    <a target="_blank" style="color: <?= $colornya ?>;" href="https://api.whatsapp.com/send?phone=<?= indo_tlp($company['whatsapp']); ?>" class="twitter"><i class="fab fa-whatsapp"></i></a>
                    <a target="_blank" style="color: <?= $colornya ?>;" href="https://www.facebook.com/<?= $company['facebook']; ?>" class="facebook"><i class="fab fa-facebook"></i></a>
                    <a target="_blank" style="color: <?= $colornya ?>;" href="https://www.instagram.com/<?= $company['instagram']; ?>" class="instagram"><i class="fab fa-instagram"></i></a>
                    <a target="_blank" style="color: <?= $colornya ?>;" href="mailto:<?= $company['email']; ?>" class="google-plus"><i class="fa fa-envelope"></i></a>
                </div>
              </div>
            </div>
        </footer>
        <script src="https://files.billing.or.id//assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="https://files.billing.or.id//assets/vendor/aos/aos.js"></script>
        <script src="https://files.billing.or.id//assets/vendor/glightbox/js/glightbox.min.js"></script>
        <script src="https://files.billing.or.id//assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
        <script src="https://files.billing.or.id//assets/vendor/swiper/swiper-bundle.min.js"></script>
        <script src="https://files.billing.or.id//assets/vendor/php-email-form/validate.js"></script>
        <script src="https://files.billing.or.id//assets/js/main.js"></script>
        <script src="https://files.billing.or.id/assets/frontend/libraries/jquery/jquery-3.4.1.min.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        <script src="https://files.billing.or.id/assets/mobile/assets/js/plugins/splide/splide.min.js"></script>
    </body>
</html>