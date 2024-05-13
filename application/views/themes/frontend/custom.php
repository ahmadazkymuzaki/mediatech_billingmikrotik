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
    <link rel="stylesheet" href="https://files.billing.or.id/assets/mobile/assets/css/style.css">
    <link rel="manifest" href="https://files.billing.or.id/assets/mobile/__manifest.json" crossorigin>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
        $backgroundnya = '#4e73df';
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
        $backgroundnya = '#6c757d';
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
        $backgroundnya = '#198754';
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
    <?php } elseif ($company['front'] == 'warning') {
        $backgroundnya = '#f6c23e';
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
        $backgroundnya = '#36b9cc';
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
        $backgroundnya = '#5a5c69';
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
        $backgroundnya = '#f8f9fc';
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
        $backgroundnya = '#ffffff';
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
    <div class="appHeader bg-<?= $company['front']; ?> text-light">
        <div class="float-right">
            <a href="download" style="text-decoraton: none; color: white; font-weight: bold;">
                <i class="fa fa-download"></i>
            </a>
        </div>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <div class="pageTitle">
            <img src="<?= site_url('assets/images/') ?><?= $company['logo'] ?>" alt="logo" class="logo">
        </div>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <div class="float-right">
            <a href="share" style="text-decoraton: none; color: white; font-weight: bold;">
                <i class="fa fa-share"></i>
            </a>
        </div>
    </div>

    <div class="appBottomMenu">
        <a href="<?= site_url('front') ?>" class="item <?= $title == 'Halaman Depan' ? 'active' : '' ?>">
            <div class="col">
                <ion-icon name="home-outline"></ion-icon>
                <strong>BERANDA</strong>
            </div>
        </a>
        <a href="<?= site_url('syarat-dan-ketentuan.html') ?>" class="item <?= $title == 'Syarat dan Ketentuan' ? 'active' : '' ?>">
            <div class="col">
                <ion-icon name="document-text-outline"></ion-icon>
                <strong>SYARAT</strong>
            </div>
        </a>
        <a href="<?= site_url('kebijakan-privasi.html') ?>" class="item <?= $title == 'Kebijakan Privasi' ? 'active' : '' ?>">
            <div class="col">
                <ion-icon name="file-tray-full-outline"></ion-icon>
                <strong>KEBIJAKAN</strong>
            </div>
        </a>
        <a href="<?= site_url('download.html') ?>" class="item <?= $title == 'Download File' ? 'active' : '' ?>">
            <div class="col">
                <ion-icon name="newspaper-outline"></ion-icon>
                <strong>MEDIA</strong>
            </div>
        </a>
        <a href="<?= site_url('auth') ?>" class="item">
            <div class="col">
                <ion-icon name="exit-outline"></ion-icon>
                <strong>LOGIN</strong>
            </div>
        </a>
    </div>
    <main id="appCapsule">
        <?= $contents ?>
        <div class="appFooter mt-2">
            Copyright &copy; <?= $company['company_name'] ?> - <?= date('Y'); ?>
        </div>
    </main>
    <script src="https://files.billing.or.id/assets/frontend/libraries/jquery/jquery-3.4.1.min.js"></script>
    <script src="https://files.billing.or.id/assets/mobile/assets/js/lib/bootstrap.bundle.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://files.billing.or.id/assets/mobile/assets/js/plugins/splide/splide.min.js"></script>
    <script src="https://files.billing.or.id/assets/frontend/libraries/bootstrap/js/bootstrap.js"></script>
</body>

</html>