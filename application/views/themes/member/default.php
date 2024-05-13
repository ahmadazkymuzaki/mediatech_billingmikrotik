<!DOCTYPE html>
<html dir="ltr" lang="en">

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

    <title><?= $title ?> || Pelanggan <?= $company['nama_singkat'] ?></title>
    <link rel="shortcut icon" href="<?= site_url('assets/images/favicon.png') ?>" sizes="16x16" type="image/png">
    <!-- Custom fonts for this template-->
    <link href="https://files.billing.or.id/assets/template-member/assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="https://files.billing.or.id/assets/template-member/assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="https://files.billing.or.id/assets/themify-icons/themify-icons.css" rel="stylesheet">
    <link href="https://files.billing.or.id/assets/template-member/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link href="https://files.billing.or.id/assets/template-member/assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="https://files.billing.or.id/assets/template-member/dist/css/style.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.5.0/css/all.min.css">
</head>

<body>
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md" style="border-bottom: solid 3px grey;">
                <div class="navbar-header" data-logobg="skin6">
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="fa fa-bars"></i></a>
                    <div class="navbar-brand">
                        <a href="<?= site_url('member') ?>">
                            <b class="logo-icon">
                                <img src="<?= site_url('assets/images/') ?><?= $company['logo'] ?>" alt="logo" height="40" class="lightlogo">
                            </b>
                            <span class="logo-text">
                                <img src="<?= site_url('assets/images/') ?><?= $company['logo'] ?>" alt="logo" height="40" class="light-logo">
                            </span>
                        </a>
                    </div>
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-info-circle"></i>
                    </a>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent" style="border-bottom: solid 1px grey; border-top: solid 1px grey;">
                    <ul class="navbar-nav float-left mr-auto ml-3 pl-1">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle pl-md-3 position-relative" href="javascript:void(0)" id="bell" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span><i data-feather="bell" class="svg-icon"></i></span>
                                <span class="badge badge-primary notify-no rounded-circle"><?= $mynotifikasi ?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-left mailbox animated bounceInDown" style="width : 300px;">
                                <ul class="list-style-none" style="width : 300px;">
                                    <?php if ($mynotifikasi >= 1) { ?>
                                        <?php foreach ($notifikasi as $c => $data) { ?>
                                            <li style="width : 300px;">
                                                <div class="message-center notifications position-relative" style="width : 300px;">
                                                    <a href="<?= site_url('member/notifikasi/') ?><?= $data->id_notifikasi ?>" class="message-item d-flex align-items-center border-bottom px-3 py-2" style="width : 300px;">
                                                        <div class="w-75 d-inline-block v-middle pl-2" style="width : 300px;">
                                                            <h6 class="message-title mb-0 mt-1"><?= $data->nama_notifikasi ?></h6>
                                                            <span class="font-12 text-nowrap d-block text-muted">
                                                                <?= substr($data->desc_notifikasi, 0, 26); ?>...
                                                            </span>
                                                            <span class="font-12 text-nowrap d-block text-muted"><?= $data->user_notifikasi ?> - <?= $data->time_notifikasi ?></span>
                                                        </div>
                                                    </a>
                                                </div>
                                            </li>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <li style="width : 300px;">
                                            <div class="message-center notifications position-relative" style="width : 300px;">
                                                <a href="" class="message-item d-flex align-items-center border-bottom px-3 py-2" style="width : 300px;">
                                                    <div class="w-75 d-inline-block v-middle pl-2" style="width : 300px;">
                                                        <h6 class="message-title mb-0 mt-1">Tidak Ada Notifikasi Baru</h6>
                                                    </div>
                                                </a>
                                            </div>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle pl-md-3 position-relative" href="javascript:void(0)" id="bell" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span><i data-feather="mail" class="svg-icon"></i></span>
                                <span class="badge badge-primary notify-no rounded-circle"><?= $mymessage ?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-left mailbox animated bounceInDown" style="width : 300px;">
                                <ul class="list-style-none" style="width : 300px;">
                                    <?php if ($mymessage >= 1) { ?>
                                        <?php foreach ($message as $c => $dataku) { ?>
                                            <li style="width : 300px;">
                                                <div class="message-center notifications position-relative" style="width : 300px;">
                                                    <a href="<?= site_url('member/message/') ?><?= $dataku->message_id ?>" class="message-item d-flex align-items-center border-bottom px-3 py-2" style="width : 300px;">
                                                        <div class="w-75 d-inline-block v-middle pl-2" style="width : 300px;">
                                                            <h6 class="message-title mb-0 mt-1"><?= $dataku->judul_pesan ?></h6>
                                                            <span class="font-12 text-nowrap d-block text-muted">
                                                                <?= substr($dataku->konten_pesan, 0, 26); ?>...
                                                            </span>
                                                            <span class="font-12 text-nowrap d-block text-muted"><?= $dataku->user_pengirim ?> - <?= $dataku->waktu_kirim ?></span>
                                                        </div>
                                                    </a>
                                                </div>
                                            </li>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <li style="width : 300px;">
                                            <div class="message-center notifications position-relative" style="width : 300px;">
                                                <a href="" class="message-item d-flex align-items-center border-bottom px-3 py-2" style="width : 300px;">
                                                    <div class="w-75 d-inline-block v-middle pl-2" style="width : 300px;">
                                                        <h6 class="message-title mb-0 mt-1">Tidak Ada Pesan Masuk</h6>
                                                    </div>
                                                </a>
                                            </div>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item dropdown" style="margin-top: 15px;">
                            <span>
                                &nbsp;&nbsp; Saldo : Rp. <?= indo_currency($user['saldo']) ?><br>
                                &nbsp;&nbsp; ID : <?= $user['no_services'] ?>
                            </span>
                        </li>
                    </ul>
                    <ul class="navbar-nav float-right">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url('member/profile') ?>">
                                <img src="<?= site_url(''); ?>assets/images/profile/<?= $user['image']; ?>" alt="user" class="rounded-circle" width="40">
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <nav class="sidebar-nav">
                    <?php if ($user['role_id'] == 2) { ?>
                        <ul id="sidebarnav">
                            <li class="sidebar-item ">
                                <a class="sidebar-link " href="<?= site_url('member') ?>" aria-expanded="false">
                                    <i data-feather="home" class="feather-icon"></i>
                                    <span class="hide-menu">Halaman Depan</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="<?= site_url('member/koneksi') ?>" aria-expanded="false">
                                    <i data-feather="wifi" class="feather-icon"></i>
                                    <span class="hide-menu">Kelola Koneksi</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="<?= site_url('member/speedtest') ?>" aria-expanded="false">
                                    <i data-feather="cpu" class="feather-icon"></i>
                                    <span class="hide-menu">Test Kecepatan</span>
                                </a>
                            </li>
                            <li class="list-divider"></li>
                            <li class="nav-small-cap"><span class="hide-menu">Kelola Keuangan</span></li>
                            <li class="sidebar-item">
                                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                    <i data-feather="chevrons-down" class="feather-icon"></i>
                                    <span class="hide-menu">Pemasukan</span>
                                </a>
                                <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/topupsaldo') ?>" class="sidebar-link">
                                            <span class="hide-menu"> Top Up Saldo</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/terimabonus') ?>" class="sidebar-link">
                                            <span class="hide-menu"> Terima Bonus</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/pemasukan') ?>" class="sidebar-link">
                                            <span class="hide-menu"> List Transaksi</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                    <i data-feather="chevrons-up" class="feather-icon"></i>
                                    <span class="hide-menu">Pengeluaran </span>
                                </a>
                                <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/transfersaldo') ?>" class="sidebar-link">
                                            <span class="hide-menu"> Transfer Saldo</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/bayartagihan/') ?><?= $invoice->invoice ?>" class="sidebar-link">
                                            <span class="hide-menu"> Bayar Tagihan</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/pengeluaran') ?>" class="sidebar-link">
                                            <span class="hide-menu"> List Transaksi</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="list-divider"></li>
                            <li class="nav-small-cap"><span class="hide-menu">Menu Utama</span></li>
                            <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false"><i data-feather="layers" class="feather-icon"></i><span class="hide-menu">Kelola Tagihan </span></a>
                                <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                    <li class="sidebar-item"><a href="<?= site_url('member/confirmmanual/') ?><?= $invoice->invoice ?>" class="sidebar-link"><span class="hide-menu"> Konfirmasi Manual
                                            </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="<?= site_url('member/confirmotomatis/') ?><?= $invoice->invoice ?>" class="sidebar-link"><span class="hide-menu"> Konfirmasi Otomatis
                                            </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="<?= site_url('member/history') ?>" class="sidebar-link"><span class="hide-menu"> Riwayat Tagihan
                                            </span></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false"><i data-feather="grid" class="feather-icon"></i><span class="hide-menu">Kelola Layanan </span></a>
                                <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/status') ?>" class="sidebar-link">
                                            <span class="hide-menu"> Detail Paket Saya</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/pengaduan') ?>" class="sidebar-link">
                                            <span class="hide-menu"> Lapor / Pengaduan</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/loglayanan') ?>" class="sidebar-link">
                                            <span class="hide-menu"> Riwayat Transkasi</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false"><i data-feather="box" class="feather-icon"></i><span class="hide-menu">Kelola Transaksi </span></a>
                                <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/upgrade') ?>" class="sidebar-link">
                                            <span class="hide-menu"> Ganti Layanan</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/transaksi') ?>" class="sidebar-link">
                                            <span class="hide-menu"> Tambah Layanan</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/renew') ?>" class="sidebar-link">
                                            <span class="hide-menu"> Renew Speed</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false"><i data-feather="layout" class="feather-icon"></i><span class="hide-menu">Kelola Penjualan </span></a>
                                <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/registrasi') ?>" class="sidebar-link">
                                            <span class="hide-menu"> Registrasi Member</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/refferal') ?>" class="sidebar-link">
                                            <span class="hide-menu"> Member Refferal</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false"><i data-feather="user" class="feather-icon"></i><span class="hide-menu">Kelola Profil </span></a>
                                <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                    <li class="sidebar-item"><a href="<?= site_url('member/account') ?>" class="sidebar-link"><span class="hide-menu"> Edit Akun Saya
                                            </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="<?= site_url('member/changepassword') ?>" class="sidebar-link"><span class="hide-menu"> Ganti Password
                                            </span></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="<?= site_url('member/about') ?>" aria-expanded="false">
                                    <i data-feather="info" class="feather-icon"></i>
                                    <span class="hide-menu">Tentang Kami</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="<?= site_url() ?>auth/logout" aria-expanded="false">
                                    <i data-feather="log-out" class="feather-icon"></i>
                                    <span class="hide-menu">Keluar Aplikasi</span>
                                </a>
                            </li>
                        </ul>
                    <?php } ?>
                    <?php if ($user['role_id'] == 3) { ?>
                        <ul id="sidebarnav">
                            <li class="sidebar-item ">
                                <a class="sidebar-link " href="<?= site_url('member') ?>" aria-expanded="false">
                                    <i data-feather="home" class="feather-icon"></i>
                                    <span class="hide-menu">Halaman Depan</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="<?= site_url('member/speedtest') ?>" aria-expanded="false">
                                    <i data-feather="cpu" class="feather-icon"></i>
                                    <span class="hide-menu">Test Kecepatan</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                    <i data-feather="chevrons-down" class="feather-icon"></i>
                                    <span class="hide-menu">Pemasukan</span>
                                </a>
                                <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/topupsaldo') ?>" class="sidebar-link">
                                            <span class="hide-menu"> Top Up Saldo</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/pemasukan') ?>" class="sidebar-link">
                                            <span class="hide-menu"> List Transaksi</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                    <i data-feather="chevrons-up" class="feather-icon"></i>
                                    <span class="hide-menu">Pengeluaran </span>
                                </a>
                                <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/belivoucher') ?>" class="sidebar-link">
                                            <span class="hide-menu"> Beli Voucher</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/pengeluaran') ?>" class="sidebar-link">
                                            <span class="hide-menu"> List Transaksi</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                    <i data-feather="grid" class="feather-icon"></i>
                                    <span class="hide-menu">Kelola Layanan</span>
                                </a>
                                <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/pengaduan') ?>" class="sidebar-link">
                                            <span class="hide-menu"> Lapor / Pengaduan</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false"><i data-feather="user" class="feather-icon"></i><span class="hide-menu">Kelola Profil </span></a>
                                <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                    <li class="sidebar-item"><a href="<?= site_url('member/account') ?>" class="sidebar-link"><span class="hide-menu"> Edit Akun Saya
                                            </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="<?= site_url('member/changepassword') ?>" class="sidebar-link"><span class="hide-menu"> Ganti Password
                                            </span></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="<?= site_url('member/about') ?>" aria-expanded="false">
                                    <i data-feather="info" class="feather-icon"></i>
                                    <span class="hide-menu">Tentang Kami</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="<?= site_url() ?>auth/logout" aria-expanded="false">
                                    <i data-feather="log-out" class="feather-icon"></i>
                                    <span class="hide-menu">Keluar Aplikasi</span>
                                </a>
                            </li>
                        </ul>
                    <?php } ?>
                    <?php if ($user['role_id'] == 4) { ?>
                        <ul id="sidebarnav">
                            <li class="sidebar-item ">
                                <a class="sidebar-link " href="<?= site_url('member') ?>" aria-expanded="false">
                                    <i data-feather="home" class="feather-icon"></i>
                                    <span class="hide-menu">Halaman Depan</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                    <i data-feather="chevrons-down" class="feather-icon"></i>
                                    <span class="hide-menu">Pemasukan</span>
                                </a>
                                <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/topupsaldo') ?>" class="sidebar-link">
                                            <span class="hide-menu"> Top Up Saldo</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/pemasukan') ?>" class="sidebar-link">
                                            <span class="hide-menu"> List Transaksi</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                    <i data-feather="chevrons-up" class="feather-icon"></i>
                                    <span class="hide-menu">Pengeluaran </span>
                                </a>
                                <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/belivoucher') ?>" class="sidebar-link">
                                            <span class="hide-menu"> Beli Voucher</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/pengeluaran') ?>" class="sidebar-link">
                                            <span class="hide-menu"> List Transaksi</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                    <i data-feather="grid" class="feather-icon"></i>
                                    <span class="hide-menu">Kelola Layanan</span>
                                </a>
                                <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/pengaduan') ?>" class="sidebar-link">
                                            <span class="hide-menu"> Lapor / Pengaduan</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false"><i data-feather="layout" class="feather-icon"></i><span class="hide-menu">Kelola Penjualan </span></a>
                                <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/registrasi') ?>" class="sidebar-link">
                                            <span class="hide-menu"> Registrasi Member</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/refferal') ?>" class="sidebar-link">
                                            <span class="hide-menu"> Member Refferal</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false"><i data-feather="user" class="feather-icon"></i><span class="hide-menu">Kelola Profil </span></a>
                                <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                    <li class="sidebar-item"><a href="<?= site_url('member/account') ?>" class="sidebar-link"><span class="hide-menu"> Edit Akun Saya
                                            </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="<?= site_url('member/changepassword') ?>" class="sidebar-link"><span class="hide-menu"> Ganti Password
                                            </span></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="<?= site_url('member/about') ?>" aria-expanded="false">
                                    <i data-feather="info" class="feather-icon"></i>
                                    <span class="hide-menu">Tentang Kami</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="<?= site_url() ?>auth/logout" aria-expanded="false">
                                    <i data-feather="log-out" class="feather-icon"></i>
                                    <span class="hide-menu">Keluar Aplikasi</span>
                                </a>
                            </li>
                        </ul>
                    <?php } ?>
                    <?php if ($user['role_id'] == 5) { ?>
                        <ul id="sidebarnav">
                            <li class="sidebar-item ">
                                <a class="sidebar-link " href="<?= site_url('member') ?>" aria-expanded="false">
                                    <i data-feather="home" class="feather-icon"></i>
                                    <span class="hide-menu">Halaman Depan</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                    <i data-feather="chevrons-down" class="feather-icon"></i>
                                    <span class="hide-menu">Pemasukan</span>
                                </a>
                                <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/terimabonus') ?>" class="sidebar-link">
                                            <span class="hide-menu"> Terima Bonus</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/pemasukan') ?>" class="sidebar-link">
                                            <span class="hide-menu"> List Transaksi</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                    <i data-feather="chevrons-up" class="feather-icon"></i>
                                    <span class="hide-menu">Pengeluaran </span>
                                </a>
                                <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/transfersaldo') ?>" class="sidebar-link">
                                            <span class="hide-menu"> Transfer Saldo</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/pengeluaran') ?>" class="sidebar-link">
                                            <span class="hide-menu"> List Transaksi</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false"><i data-feather="layout" class="feather-icon"></i><span class="hide-menu">Kelola Penjualan </span></a>
                                <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/registrasi') ?>" class="sidebar-link">
                                            <span class="hide-menu"> Registrasi Member</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/refferal') ?>" class="sidebar-link">
                                            <span class="hide-menu"> Member Refferal</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                    <i data-feather="grid" class="feather-icon"></i>
                                    <span class="hide-menu">Kelola Layanan</span>
                                </a>
                                <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/pengaduan') ?>" class="sidebar-link">
                                            <span class="hide-menu"> Lapor / Pengaduan</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false"><i data-feather="user" class="feather-icon"></i><span class="hide-menu">Kelola Profil </span></a>
                                <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                    <li class="sidebar-item"><a href="<?= site_url('member/account') ?>" class="sidebar-link"><span class="hide-menu"> Edit Akun Saya
                                            </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="<?= site_url('member/changepassword') ?>" class="sidebar-link"><span class="hide-menu"> Ganti Password
                                            </span></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="<?= site_url('member/about') ?>" aria-expanded="false">
                                    <i data-feather="info" class="feather-icon"></i>
                                    <span class="hide-menu">Tentang Kami</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="<?= site_url() ?>auth/logout" aria-expanded="false">
                                    <i data-feather="log-out" class="feather-icon"></i>
                                    <span class="hide-menu">Keluar Aplikasi</span>
                                </a>
                            </li>
                        </ul>
                    <?php } ?>
                    <?php if ($user['role_id'] == 8) { ?>
                        <ul id="sidebarnav">
                            <li class="sidebar-item ">
                                <a class="sidebar-link " href="<?= site_url('member') ?>" aria-expanded="false">
                                    <i data-feather="home" class="feather-icon"></i>
                                    <span class="hide-menu">Halaman Depan</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="<?= site_url('member/pesanmasuk') ?>" aria-expanded="false">
                                    <i data-feather="mail" class="feather-icon"></i>
                                    <span class="hide-menu">Pesan Masuk</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="<?= site_url('member/pesankeluar') ?>" aria-expanded="false">
                                    <i data-feather="send" class="feather-icon"></i>
                                    <span class="hide-menu">Pesan Terkirim</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="<?= site_url('member/gaji') ?>" aria-expanded="false">
                                    <i data-feather="dollar-sign" class="feather-icon"></i>
                                    <span class="hide-menu">Terima Gaji</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="<?= site_url('member/kasbon') ?>" aria-expanded="false">
                                    <i data-feather="dollar-sign" class="feather-icon"></i>
                                    <span class="hide-menu">Ajukan Kasbon</span>
                                </a>
                            </li>
                            <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false"><i data-feather="layout" class="feather-icon"></i><span class="hide-menu">Kelola Penjualan </span></a>
                                <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/registrasi') ?>" class="sidebar-link">
                                            <span class="hide-menu"> Registrasi Member</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/refferal') ?>" class="sidebar-link">
                                            <span class="hide-menu"> Member Refferal</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false"><i data-feather="user" class="feather-icon"></i><span class="hide-menu">Kelola Profil </span></a>
                                <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                    <li class="sidebar-item"><a href="<?= site_url('member/account') ?>" class="sidebar-link"><span class="hide-menu"> Edit Akun Saya
                                            </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="<?= site_url('member/changepassword') ?>" class="sidebar-link"><span class="hide-menu"> Ganti Password
                                            </span></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="<?= site_url('member/about') ?>" aria-expanded="false">
                                    <i data-feather="info" class="feather-icon"></i>
                                    <span class="hide-menu">Tentang Kami</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="<?= site_url() ?>auth/logout" aria-expanded="false">
                                    <i data-feather="log-out" class="feather-icon"></i>
                                    <span class="hide-menu">Keluar Aplikasi</span>
                                </a>
                            </li>
                        </ul>
                    <?php } ?>
                    <?php if ($user['role_id'] == 9) { ?>
                        <ul id="sidebarnav">
                            <li class="sidebar-item ">
                                <a class="sidebar-link " href="<?= site_url('member') ?>" aria-expanded="false">
                                    <i data-feather="home" class="feather-icon"></i>
                                    <span class="hide-menu">Halaman Depan</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="<?= site_url('member/koneksi') ?>" aria-expanded="false">
                                    <i data-feather="wifi" class="feather-icon"></i>
                                    <span class="hide-menu">Kelola Koneksi</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="<?= site_url('member/speedtest') ?>" aria-expanded="false">
                                    <i data-feather="cpu" class="feather-icon"></i>
                                    <span class="hide-menu">Test Kecepatan</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="<?= site_url('member/pesanmasuk') ?>" aria-expanded="false">
                                    <i data-feather="mail" class="feather-icon"></i>
                                    <span class="hide-menu">Pesan Masuk</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="<?= site_url('member/pesankeluar') ?>" aria-expanded="false">
                                    <i data-feather="send" class="feather-icon"></i>
                                    <span class="hide-menu">Pesan Terkirim</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="<?= site_url('member/gaji') ?>" aria-expanded="false">
                                    <i data-feather="dollar-sign" class="feather-icon"></i>
                                    <span class="hide-menu">Terima Gaji</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="<?= site_url('member/kasbon') ?>" aria-expanded="false">
                                    <i data-feather="dollar-sign" class="feather-icon"></i>
                                    <span class="hide-menu">Ajukan Kasbon</span>
                                </a>
                            </li>
                            <li class="list-divider"></li>
                            <li class="nav-small-cap"><span class="hide-menu">Kelola Keuangan</span></li>
                            <li class="sidebar-item">
                                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                    <i data-feather="chevrons-down" class="feather-icon"></i>
                                    <span class="hide-menu">Pemasukan</span>
                                </a>
                                <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/topupsaldo') ?>" class="sidebar-link">
                                            <span class="hide-menu"> Top Up Saldo</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/terimabonus') ?>" class="sidebar-link">
                                            <span class="hide-menu"> Terima Bonus</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/pemasukan') ?>" class="sidebar-link">
                                            <span class="hide-menu"> List Transaksi</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                    <i data-feather="chevrons-up" class="feather-icon"></i>
                                    <span class="hide-menu">Pengeluaran </span>
                                </a>
                                <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/transfersaldo') ?>" class="sidebar-link">
                                            <span class="hide-menu"> Transfer Saldo</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/bayartagihan/') ?><?= $invoice->invoice ?>" class="sidebar-link">
                                            <span class="hide-menu"> Bayar Tagihan</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/belivoucher') ?>" class="sidebar-link">
                                            <span class="hide-menu"> Beli Voucher</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/pengeluaran') ?>" class="sidebar-link">
                                            <span class="hide-menu"> List Transaksi</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="list-divider"></li>
                            <li class="nav-small-cap"><span class="hide-menu">Menu Utama</span></li>
                            <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false"><i data-feather="layers" class="feather-icon"></i><span class="hide-menu">Kelola Tagihan </span></a>
                                <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                    <li class="sidebar-item"><a href="<?= site_url('member/confirmmanual/') ?><?= $invoice->invoice ?>" class="sidebar-link"><span class="hide-menu"> Konfirmasi Manual
                                            </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="<?= site_url('member/confirmotomatis/') ?><?= $invoice->invoice ?>" class="sidebar-link"><span class="hide-menu"> Konfirmasi Otomatis
                                            </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="<?= site_url('member/history') ?>" class="sidebar-link"><span class="hide-menu"> Riwayat Tagihan
                                            </span></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false"><i data-feather="grid" class="feather-icon"></i><span class="hide-menu">Kelola Layanan </span></a>
                                <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/status') ?>" class="sidebar-link">
                                            <span class="hide-menu"> Detail Paket Saya</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/pengaduan') ?>" class="sidebar-link">
                                            <span class="hide-menu"> Lapor / Pengaduan</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/loglayanan') ?>" class="sidebar-link">
                                            <span class="hide-menu"> Riwayat Transkasi</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false"><i data-feather="box" class="feather-icon"></i><span class="hide-menu">Kelola Transaksi </span></a>
                                <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/upgrade') ?>" class="sidebar-link">
                                            <span class="hide-menu"> Ganti Layanan</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/transaksi') ?>" class="sidebar-link">
                                            <span class="hide-menu"> Tambah Layanan</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/renew') ?>" class="sidebar-link">
                                            <span class="hide-menu"> Renew Speed</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false"><i data-feather="layout" class="feather-icon"></i><span class="hide-menu">Kelola Penjualan </span></a>
                                <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/registrasi') ?>" class="sidebar-link">
                                            <span class="hide-menu"> Registrasi Member</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="<?= site_url('member/refferal') ?>" class="sidebar-link">
                                            <span class="hide-menu"> Member Refferal</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false"><i data-feather="user" class="feather-icon"></i><span class="hide-menu">Kelola Profil </span></a>
                                <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                    <li class="sidebar-item"><a href="<?= site_url('member/account') ?>" class="sidebar-link"><span class="hide-menu"> Edit Akun Saya
                                            </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="<?= site_url('member/changepassword') ?>" class="sidebar-link"><span class="hide-menu"> Ganti Password
                                            </span></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="<?= site_url('member/about') ?>" aria-expanded="false">
                                    <i data-feather="info" class="feather-icon"></i>
                                    <span class="hide-menu">Tentang Kami</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="<?= site_url() ?>auth/logout" aria-expanded="false">
                                    <i data-feather="log-out" class="feather-icon"></i>
                                    <span class="hide-menu">Keluar Aplikasi</span>
                                </a>
                            </li>
                        </ul>
                    <?php } ?>
                </nav>
            </div>
        </aside>
        <div class="page-wrapper">
            <div class="row">
                <?= $contents ?>
            </div>
            <footer class="footer text-center text-muted">
                All Rights Reserved by <?= $company['nama_singkat'] ?>
            </footer>
        </div>
    </div>
    <script src="https://files.billing.or.id/assets/template-member/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="https://files.billing.or.id/assets/template-member/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="https://files.billing.or.id/assets/template-member/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="https://files.billing.or.id/assets/template-member/dist/js/app-style-switcher.js"></script>
    <script src="https://files.billing.or.id/assets/template-member/dist/js/feather.min.js"></script>
    <script src="https://files.billing.or.id/assets/template-member/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="https://files.billing.or.id/assets/template-member/dist/js/sidebarmenu.js"></script>
    <script src="https://files.billing.or.id/assets/template-member/dist/js/custom.min.js"></script>
    <script src="https://files.billing.or.id/assets/template-member/assets/extra-libs/c3/d3.min.js"></script>
    <script src="https://files.billing.or.id/assets/template-member/assets/extra-libs/c3/c3.min.js"></script>
    <script src="https://files.billing.or.id/assets/template-member/assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="https://files.billing.or.id/assets/template-member/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="https://files.billing.or.id/assets/template-member/assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
    <script src="https://files.billing.or.id/assets/template-member/dist/js/pages/dashboards/dashboard1.min.js"></script>
    <script src="https://files.billing.or.id/assets/template-member/assets/extra-libs/sparkline/sparkline.js"></script>
    <script src="https://files.billing.or.id/assets/template-member/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="https://files.billing.or.id/assets/template-member/dist/js/pages/datatable/datatable-basic.init.js"></script>
</body>

</html>