<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Access-Control-Allow-Origin" content="*" />
    <meta name="theme-color" content="#e74a3b">
    <meta name="apple-mobile-web-app-status-bar-style" content="#e74a3b" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="description" content="<?= $company['about']; ?>">
    <meta name="author" content="<?= $company['owner']; ?>">
    <meta name="title" content="<?= $company['company_name']; ?>">
    <meta name="keywords" content="<?= $company['keyword']; ?>">
    <meta http-equiv="refresh" content="<?= $company['refresh']; ?>">

    <title><?= $title ?> || Administrator <?= $company['nama_singkat'] ?></title>
    <link rel="shortcut icon" href="<?= site_url('assets/images/favicon.png') ?>" sizes="16x16" type="image/png">
    <!-- Custom fonts for this template-->
    <link href="https://files.billing.or.id/assets/backend/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://files.billing.or.id/assets/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <!-- Custom styles for this template-->
    <link href="https://files.billing.or.id/assets/backend/css/sb-admin-2.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.5.0/css/all.min.css">
    <!-- Custom styles for this page -->
    <link href="https://files.billing.or.id/assets/backend/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://files.billing.or.id/assets/backend/css/select2.min.css" rel="stylesheet">
    <link href="https://files.billing.or.id/assets/backend/css/bootstrap-select.css" rel="stylesheet">
    <script src="http://maps.googleapis.com/maps/api/js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    <link rel="stylesheet" href="https://files.billing.or.id/assets/backend/leaflet-search.css" />
    <script src="https://files.billing.or.id/assets/backend/leaflet-search.js"></script>
    <script src="https://unpkg.com/@ngageoint/leaflet-geopackage@2.0.5/dist/leaflet-geopackage.min.js"></script>
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
    <?php if ($company['theme'] == 'primary') {
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
    <?php } elseif ($company['theme'] == 'secondary') {
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
    <?php } elseif ($company['theme'] == 'success') {
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
    <?php } elseif ($company['theme'] == 'danger') {
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
    <?php } elseif ($company['theme'] == 'warning') {
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
    <?php } elseif ($company['theme'] == 'info') {
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
    <?php } elseif ($company['theme'] == 'dark') {
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
    <?php } elseif ($company['theme'] == 'light') {
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
    <?php } elseif ($company['theme'] == 'default') {
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
    <?php } elseif ($company['theme'] == 'purple') {
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
    <?php } elseif ($company['theme'] == 'orange') {
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

<body id="page-top" class="sidebar-toggled">
    <?php if ($user['email'] == '') {
        redirect('auth/logout');
    } ?>
    <?php if ($user['role_id'] == 2 || $user['role_id'] == 3 || $user['role_id'] == 4 || $user['role_id'] == 5 || $user['role_id'] == 8 || $user['role_id'] == 9) {
        $this->session->set_flashdata('error', 'Akses dilarang');
        redirect('member');
    } ?>
    <?php if ($user['role_id'] == 10) {
        redirect('bill/customer');
    } ?>
    <?php if ($user['role_id'] != 1 && $user['role_id'] != 6 && $user['role_id'] != 7) {
        $this->session->set_flashdata('error', 'Akses dilarang');
        redirect('auth/logout');
    } ?>
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-<?= $company['theme']; ?> sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= site_url('dashboard') ?>">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i style="font-weight: bold; color: <?= $colornya ?>;" class="fas fa-wifi"></i>
                </div>
                <div style="font-weight: bold; color: <?= $colornya ?>;" class="sidebar-brand-text mx-3">BILLING</div>
            </a>
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?= $title == 'Dashboard'  ? 'active' : '' ?>">
                <a style="font-weight: bold; color: <?= $colornya ?>;" class="nav-link" href="<?= site_url('dashboard') ?>">
                    <i class="fas fa-fw fa-tachometer-alt" style="font-weight: bold; color: <?= $colornya ?>;"></i>
                    <span>Halaman Utama</span></a>
            </li>
            <?php if ($user['role_id'] == 1) { ?>
                <li class="nav-item <?= $title == 'Balas Otomatis' | $title == 'Kontak WhatsApp' | $title == 'Cronjob WhatsApp' | $title == 'WhatsApp Blaster' | $title == 'Test Kirim WA' | $title == 'Kirim WA Massal' | $title == 'Setting WhatsApp' ? 'active' : '' ?>">
                    <a style="font-weight: bold; color: <?= $colornya ?>;" class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseWhatsapp" aria-expanded="true" aria-controls="collapseSetting">
                        <i style="font-weight: bold; color: <?= $colornya ?>;" class="fab fa-fw fa-whatsapp"></i>
                        <span>Kelola WhatsApp</span>
                    </a>
                    <div id="collapseWhatsapp" class="collapse <?= $title == 'Balas Otomatis' | $title == 'Kontak WhatsApp' | $title == 'Cronjob WhatsApp' | $title == 'WhatsApp Blaster' | $title == 'Test Kirim WA' | $title == 'Kirim WA Massal' | $title == 'Setting WhatsApp' ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item <?= $title == 'Setting WhatsApp'  ? 'active' : '' ?>" href="<?= site_url('whatsapp/setting') ?>">Setting Akun Whatsapp</a>
                            <a class="collapse-item <?= $title == 'Kontak WhatsApp'  ? 'active' : '' ?>" href="<?= site_url('whatsapp/contact') ?>">Data Kontak Whatsapp</a>
                            <a class="collapse-item <?= $title == 'Cronjob WhatsApp'  ? 'active' : '' ?>" href="<?= site_url('whatsapp/cronjob') ?>">Set Cronjob Whatsapp</a>
                            <a class="collapse-item <?= $title == 'Test Kirim WA'  ? 'active' : '' ?>" href="<?= site_url('whatsapp/sending') ?>">Test Kirim Pesan WA</a>
                            <a class="collapse-item <?= $title == 'Kirim WA Massal'  ? 'active' : '' ?>" href="<?= site_url('whatsapp/massal') ?>">Kirim Pesan WA Massal</a>
                            <a class="collapse-item <?= $title == 'WhatsApp Blaster'  ? 'active' : '' ?>" href="<?= site_url('whatsapp/campaign') ?>">Daftar Pesan Terjadwal</a>
                        </div>
                    </div>
                </li>
            <?php } ?>
            <?php if ($user['role_id'] == 1 || $user['role_id'] == 6) { ?>
                <li class="nav-item <?= $title == 'Setting Router' | $title == 'Status Router' | $title == 'Script Router' | $title == 'Semua Router' | $title == 'Log Router' | $title == 'DHCP Leases' | $title == 'All Interface' ? 'active' : '' ?>">
                    <a style="font-weight: bold; color: <?= $colornya ?>;" class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRouter" aria-expanded="true" aria-controls="collapseRouter">
                        <i style="font-weight: bold; color: <?= $colornya ?>;" class="fa fa-fw fa-server"></i>
                        <span>Kelola MikroTik</span>
                    </a>
                    <div id="collapseRouter" class="collapse <?= $title == 'Setting Router' | $title == 'Status Router' | $title == 'Script Router' | $title == 'Semua Router' | $title == 'Log Router' | $title == 'DHCP Leases' | $title == 'All Interface' ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item <?= $title == 'Status Router'  ? 'active' : '' ?>" href="<?= site_url('mikrotik/status') ?>">Status Router</a>
                            <a class="collapse-item <?= $title == 'Log Router'  ? 'active' : '' ?>" href="<?= site_url('mikrotik/log') ?>">Log Router</a>
                            <a class="collapse-item <?= $title == 'DHCP Leases'  ? 'active' : '' ?>" href="<?= site_url('mikrotik/leases') ?>">DHCP Leases</a>
                            <a class="collapse-item <?= $title == 'All Interface'  ? 'active' : '' ?>" href="<?= site_url('mikrotik/interface') ?>">All Interface</a>
                            <!-- <a class="collapse-item <?= $title == 'Script Router'  ? 'active' : '' ?>" href="<?= site_url('mikrotik/script') ?>">Script Router</a> -->
                            <a class="collapse-item <?= $title == 'Semua Router'  ? 'active' : '' ?>" href="<?= site_url('mikrotik/semua') ?>">Semua Router</a>
                            <a class="collapse-item <?= $title == 'Setting Router'  ? 'active' : '' ?>" href="<?= site_url('mikrotik/setting') ?>">Setting Router</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item <?= $title == 'Profile Hotspot' | $title == 'Users Hotspot' | $title == 'Generate Users' | $title == 'Hosts Hotspot' | $title == 'Active Hotspot' | $title == 'Binding Hotspot' | $title == 'Walled Garden' | $title == 'Cookies Hotspot' ? 'active' : '' ?>">
                    <a style="font-weight: bold; color: <?= $colornya ?>;" class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseHotspot" aria-expanded="true" aria-controls="collapseHotspot">
                        <i style="font-weight: bold; color: <?= $colornya ?>;" class="fas fa-fw fa-tags"></i>
                        <span>Kelola Hotspot</span>
                    </a>
                    <div id="collapseHotspot" class="collapse <?= $title == 'Profile Hotspot' | $title == 'Users Hotspot' | $title == 'Generate Users' | $title == 'Hosts Hotspot' | $title == 'Active Hotspot' | $title == 'Binding Hotspot' | $title == 'Walled Garden' | $title == 'Cookies Hotspot' ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item <?= $title == 'Profile Hotspot'  ? 'active' : '' ?>" href="<?= site_url('hotspot/profile') ?>">Profile Hotspot</a>
                            <a class="collapse-item <?= $title == 'Users Hotspot'  ? 'active' : '' ?>" href="<?= site_url('hotspot/users') ?>">Users Hotspot</a>
                            <a class="collapse-item <?= $title == 'Generate Users'  ? 'active' : '' ?>" href="<?= site_url('hotspot/generate') ?>">Generate Users</a>
                            <a class="collapse-item <?= $title == 'Hosts Hotspot'  ? 'active' : '' ?>" href="<?= site_url('hotspot/hosts') ?>">Hosts Hotspot</a>
                            <a class="collapse-item <?= $title == 'Active Hotspot'  ? 'active' : '' ?>" href="<?= site_url('hotspot/active') ?>">Active Hotspot</a>
                            <a class="collapse-item <?= $title == 'Binding Hotspot'  ? 'active' : '' ?>" href="<?= site_url('hotspot/binding') ?>">Binding Hotspot</a>
                            <a class="collapse-item <?= $title == 'Walled Garden'  ? 'active' : '' ?>" href="<?= site_url('hotspot/walled') ?>">Walled Garden</a>
                            <a class="collapse-item <?= $title == 'Cookies Hotspot'  ? 'active' : '' ?>" href="<?= site_url('hotspot/cookie') ?>">Cookies Hotspot</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item <?= $title == 'Profile PPP' | $title == 'Secrets PPP' | $title == 'User Static' | $title == 'Active PPP' ? 'active' : '' ?>">
                    <a style="font-weight: bold; color: <?= $colornya ?>;" class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePPPOE" aria-expanded="true" aria-controls="collapsePPPOE">
                        <i style="font-weight: bold; color: <?= $colornya ?>;" class="fas fa-fw fa-home"></i>
                        <span>PPPOE & Static</span>
                    </a>
                    <div id="collapsePPPOE" class="collapse <?= $title == 'Profile PPP' | $title == 'Secrets PPP' | $title == 'User Static' | $title == 'Active PPP' ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item <?= $title == 'Profile PPP'  ? 'active' : '' ?>" href="<?= site_url('ppp/profile') ?>">Profile PPP</a>
                            <a class="collapse-item <?= $title == 'Secrets PPP'  ? 'active' : '' ?>" href="<?= site_url('ppp/secret') ?>">Secrets PPP</a>
                            <a class="collapse-item <?= $title == 'Active PPP'  ? 'active' : '' ?>" href="<?= site_url('ppp/active') ?>">Active PPP</a>
                            <a class="collapse-item <?= $title == 'User Static'  ? 'active' : '' ?>" href="<?= site_url('ppp/static') ?>">User Static</a>
                        </div>
                    </div>
                </li>
            <?php  } ?>
            <?php if ($user['role_id'] == 1 || $user['role_id'] == 6 || $user['role_id'] == 7) { ?>
                <li class="nav-item <?= $title == 'Coverage Area' | $title == 'Lokasi ODP' | $title == 'Lokasi ODC' | $title == 'Item Layanan' | $title == 'Kategori Layanan' | $title == 'Data Layanan' | $title == 'Data Pengaduan' ? 'active' : '' ?>">
                    <a style="font-weight: bold; color: <?= $colornya ?>;" class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayanan" aria-expanded="true" aria-controls="collapseTwo">
                        <i style="font-weight: bold; color: <?= $colornya ?>;" class="fas fa-fw fa-sitemap"></i>
                        <span>Kelola Layanan</span>
                    </a>
                    <div id="collapseLayanan" class="collapse <?= $title == 'Coverage Area' | $title == 'Lokasi ODP' | $title == 'Lokasi ODC' | $title == 'Item Layanan' | $title == 'Kategori Layanan' | $title == 'Data Layanan' | $title == 'Data Pengaduan' ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <?php if ($user['role_id'] == 1 || $user['role_id'] == 6) { ?>
                                <a class="collapse-item <?= $title == 'Coverage Area'  ? 'active' : '' ?>" href="<?= site_url('coverage') ?>">Coverage Area</a>
                                <a class="collapse-item <?= $title == 'Lokasi ODP'  ? 'active' : '' ?>" href="<?= site_url('coverage/odp') ?>">Lokasi ODP</a>
                                <a class="collapse-item <?= $title == 'Lokasi ODC'  ? 'active' : '' ?>" href="<?= site_url('coverage/odc') ?>">Lokasi ODC</a>
                            <?php } ?>
                            <?php if ($user['role_id'] == 1) { ?>
                                <a class="collapse-item <?= $title == 'Kategori Layanan'  ? 'active' : '' ?>" href="<?= site_url('package/category') ?>">Kategori Layanan</a>
                                <a class="collapse-item <?= $title == 'Item Layanan'  ? 'active' : '' ?>" href="<?= site_url('package/item') ?>">Item Layanan</a>
                            <?php } ?>
                            <a class="collapse-item <?= $title == 'Data Layanan'  ? 'active' : '' ?>" href="<?= site_url('layanan/data') ?>">Ajuan Layanan</a>
                            <a class="collapse-item <?= $title == 'Data Pengaduan'  ? 'active' : '' ?>" href="<?= site_url('message/data') ?>">Pengaduan</a>
                        </div>
                    </div>
                </li>
            <?php  } ?>
            <?php if ($user['role_id'] == 1) { ?>
                <li class="nav-item <?= $title == 'Tambah' | $title == 'Aktif' | $title == 'Non-Aktif' | $title == 'Lokasi' | $title == 'Gratis' | $title == 'Isolir' | $title == 'Waiting' | $title == 'Customer'   ? 'active' : '' ?>">
                    <a style="font-weight: bold; color: <?= $colornya ?>;" class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCustomer" aria-expanded="true" aria-controls="collapseCustomer">
                        <i style="font-weight: bold; color: <?= $colornya ?>;" class="fas fa-fw fa-users"></i>
                        <span>Kelola Pelanggan</span>
                    </a>
                    <div id="collapseCustomer" class="collapse <?= $title == 'Aktif' | $title == 'Non-Aktif' | $title == 'Lokasi' | $title == 'Gratis' | $title == 'Isolir' | $title == 'Tambah' | $title == 'Waiting' | $title == 'Customer' ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item <?= $title == 'Tambah'  ? 'active' : '' ?>" href="<?= site_url('customer/add') ?>">Tambah</a>
                            <a class="collapse-item <?= $title == 'Aktif'  ? 'active' : '' ?>" href="<?= site_url('customer/active') ?>">Aktif</a>
                            <a class="collapse-item <?= $title == 'Non-Aktif'  ? 'active' : '' ?>" href="<?= site_url('customer/nonactive') ?>">Non-Aktif</a>
                            <a class="collapse-item <?= $title == 'Waiting'  ? 'active' : '' ?>" href="<?= site_url('customer/wait') ?>">Menunggu</a>
                            <a class="collapse-item <?= $title == 'Gratis'  ? 'active' : '' ?>" href="<?= site_url('customer/free') ?>">Gratis</a>
                            <a class="collapse-item <?= $title == 'Isolir'  ? 'active' : '' ?>" href="<?= site_url('customer/isolir') ?>">Isolir</a>
                            <a class="collapse-item <?= $title == 'Customer'  ? 'active' : '' ?>" href="<?= site_url('customer') ?>">Semua</a>
                            <a class="collapse-item <?= $title == 'Lokasi'  ? 'active' : '' ?>" href="<?= site_url('customer/location') ?>">Lokasi</a>
                        </div>
                    </div>
                </li>
            <?php  } ?>
            <?php if ($user['role_id'] == 1 || $user['role_id'] == 7) { ?>
                <li class="nav-item <?= $title == 'Belum Bayar' | $title == 'Bill History' |  $title == 'Sudah Bayar' | $title == 'Konfirmasi Pembayaran' |  $title == 'Tunggakan' | $title == 'Bill Draf' | $title == 'Bill' ? 'active' : '' ?>">
                    <a style="font-weight: bold; color: <?= $colornya ?>;" class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#tagihan" aria-expanded="true" aria-controls="tagihan">
                        <i style="font-weight: bold; color: <?= $colornya ?>;" class="fas fa-fw fa-tasks"></i>
                        <span>Kelola Tagihan</span>
                    </a>
                    <div id="tagihan" class="collapse <?= $title == 'Belum Bayar' |  $title == 'Sudah Bayar' | $title == 'Konfirmasi Pembayaran' |  $title == 'Tunggakan' | $title == 'Bill Draf' | $title == 'Bill History' | $title == 'Bill' ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item <?= $title == 'Belum Bayar'  ? 'active' : '' ?>" href="<?= site_url('bill/unpaid') ?>">Belum Bayar</a>
                            <a class="collapse-item <?= $title == 'Sudah Bayar'  ? 'active' : '' ?>" href="<?= site_url('bill/paid') ?>">Sudah Bayar</a>
                            <a class="collapse-item <?= $title == 'Bill'  ? 'active' : '' ?>" href="<?= site_url('bill') ?>">Semua</a>
                            <a class="collapse-item <?= $title == 'Bill Draf'  ? 'active' : '' ?>" href="<?= site_url('bill/draf') ?>">Bulan Ini <sup style="color: red;">Draf</sup></a>
                            <a class="collapse-item <?= $title == 'Tunggakan'  ? 'active' : '' ?>" href="<?= site_url('bill/debt') ?>">Tunggakan</a>
                            <a class="collapse-item <?= $title == 'Konfirmasi Pembayaran'  ? 'active' : '' ?>" href="<?= site_url('confirm') ?>">Konfirmasi</a>
                            <a class="collapse-item <?= $title == 'Bill History'  ? 'active' : '' ?>" href="<?= site_url('bill/history') ?>">Riwayat</a>
                        </div>
                    </div>
                </li>
            <?php  } ?>
            <?php if ($user['role_id'] == 1) { ?>
                <li class="nav-item <?= $title == 'Income' | $title == 'Expenditure' | $title == 'Transaksi Member' | $title == 'Pengajuan Kasbon' | $title == 'Bonus Refferal' | $title == 'Transfer Saldo' | $title == 'Top Up Saldo' | $title == 'Daftar Kategori'  ? 'active' : '' ?>">
                    <a style="font-weight: bold; color: <?= $colornya ?>;" class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReport" aria-expanded="true" aria-controls="collapseReport">
                        <i style="font-weight: bold; color: <?= $colornya ?>;" class="fas fa-fw fa-dollar-sign"></i>
                        <span>Kelola Keuangan</span>
                    </a>
                    <div id="collapseReport" class="collapse <?= $title == 'Income' | $title == 'Transaksi Member' | $title == 'Pengajuan Kasbon' | $title == 'Expenditure' | $title == 'Bonus Refferal' | $title == 'Gaji Karyawan' | $title == 'Saldo Member' | $title == 'Transfer Saldo' | $title == 'Top Up Saldo' | $title == 'Daftar Kategori' ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item <?= $title == 'Daftar Kategori'  ? 'active' : '' ?>" href="<?= site_url('keuangan/kategori') ?>">Daftar Kategori</a>
                            <a class="collapse-item <?= $title == 'Income'  ? 'active' : '' ?>" href="<?= site_url('income') ?>">Pemasukan</a>
                            <a class="collapse-item <?= $title == 'Expenditure'  ? 'active' : '' ?>" href="<?= site_url('expenditure') ?>">Pengeluaran</a>
                            <a class="collapse-item <?= $title == 'Bonus Refferal'  ? 'active' : '' ?>" href="<?= site_url('keuangan/bonus') ?>">Bonus Refferal</a>
                            <a class="collapse-item <?= $title == 'Pengajuan Kasbon'  ? 'active' : '' ?>" href="<?= site_url('keuangan/kasbon') ?>">Pengajuan Kasbon</a>
                            <a class="collapse-item <?= $title == 'Gaji Karyawan'  ? 'active' : '' ?>" href="<?= site_url('keuangan/gaji') ?>">Gaji Karyawan</a>
                            <a class="collapse-item <?= $title == 'Transfer Saldo'  ? 'active' : '' ?>" href="<?= site_url('keuangan/transfer') ?>">Transfer Saldo</a>
                            <a class="collapse-item <?= $title == 'Top Up Saldo'  ? 'active' : '' ?>" href="<?= site_url('keuangan/topup') ?>">Top Up Saldo</a>
                            <a class="collapse-item <?= $title == 'Saldo Member'  ? 'active' : '' ?>" href="<?= site_url('keuangan/saldo') ?>">Saldo Member</a>
                            <a class="collapse-item <?= $title == 'Transaksi Member'  ? 'active' : '' ?>" href="<?= site_url('keuangan/transaksi') ?>">Transaksi Member</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item <?= $title == 'Product' | $title == 'Slide' | $title == 'Media' ? 'active' : '' ?>">
                    <a style="font-weight: bold; color: <?= $colornya ?>;" class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePostingan" aria-expanded="true" aria-controls="collapseLainnya">
                        <i style="font-weight: bold; color: <?= $colornya ?>;" class="fas fa-fw fa-bars"></i>
                        <span>Kelola Postingan</span>
                    </a>
                    <div id="collapsePostingan" class="collapse <?= $title == 'Product' | $title == 'Slide' | $title == 'Media' ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item <?= $title == 'Media'  ? 'active' : '' ?>" href="<?= site_url('media') ?>">Media</a>
                            <a class="collapse-item <?= $title == 'Product'  ? 'active' : '' ?>" href="<?= site_url('product/data') ?>">Produk</a>
                            <a class="collapse-item <?= $title == 'Slide'  ? 'active' : '' ?>" href="<?= site_url('slider') ?>">Slide</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item <?= $title == 'Profil Perusahaan' | $title == 'About' | $title == 'Catatan Pelanggan' | $title == 'User' | $title == 'Riwayat Login' | $title == 'Bank' | $title == 'Sosial Media' | $title == 'Data Webhook' | $title == 'Payment Tagihan' | $title == 'Payment Saldo' | $title == 'Payment Voucher' | $title == 'Email' | $title == 'Bot Telegram' | $title == 'Syarat & Ketentuan' | $title == 'Kebijakan Privasi' | $title == 'Backup' | $title == 'Lainnya' ? 'active' : '' ?>">
                    <a style="font-weight: bold; color: <?= $colornya ?>;" class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSetting" aria-expanded="true" aria-controls="collapseSetting">
                        <i style="font-weight: bold; color: <?= $colornya ?>;" class="fas fa-fw fa-cog"></i>
                        <span>Kelola Pengaturan</span>
                    </a>
                    <div id="collapseSetting" class="collapse <?= $title == 'Profil Perusahaan' | $title == 'About' | $title == 'Catatan Pelanggan' | $title == 'User' | $title == 'Riwayat Login' | $title == 'Bank' | $title == 'Sosial Media' | $title == 'Data Webhook' | $title == 'Payment Tagihan' | $title == 'Payment Saldo' | $title == 'Payment Voucher' | $title == 'Email' | $title == 'Bot Telegram' | $title == 'Syarat & Ketentuan' | $title == 'Kebijakan Privasi' | $title == 'Backup' | $title == 'Lainnya' ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item <?= $title == 'Profil Perusahaan'  ? 'active' : '' ?>" href="<?= site_url('setting') ?>">Profil Perusahaan</a>
                            <a class="collapse-item <?= $title == 'Catatan Pelanggan'  ? 'active' : '' ?>" href="<?= site_url('setting/catatan') ?>">Catatan Pelanggan</a>
                            <a class="collapse-item <?= $title == 'Syarat & Ketentuan'  ? 'active' : '' ?>" href="<?= site_url('setting/terms') ?>">Syarat & Ketentuan</a>
                            <a class="collapse-item <?= $title == 'Kebijakan Privasi'  ? 'active' : '' ?>" href="<?= site_url('setting/policy') ?>">Kebijakan Privasi</a>
                            <a class="collapse-item <?= $title == 'About'  ? 'active' : '' ?>" href="<?= site_url('setting/about') ?>">Tentang Perusahaan</a>
                            <a class="collapse-item <?= $title == 'Bank'  ? 'active' : '' ?>" href="<?= site_url('setting/bank') ?>">Metode Pembayaran</a>
                            <a class="collapse-item <?= $title == 'Payment Tagihan'  ? 'active' : '' ?>" href="<?= site_url('payment/tagihan') ?>">Payment Tagihan</a>
                            <a class="collapse-item <?= $title == 'Payment Saldo'  ? 'active' : '' ?>" href="<?= site_url('payment/saldo') ?>">Payment Saldo</a>
                            <!-- <a class="collapse-item <?= $title == 'Payment Voucher'  ? 'active' : '' ?>" href="<?= site_url('payment/voucher') ?>">Payment Voucher</a> -->
                            <a class="collapse-item <?= $title == 'Bot Telegram'  ? 'active' : '' ?>" href="<?= site_url('setting/bottelegram') ?>">Bot Telegram</a>
                            <a class="collapse-item <?= $title == 'Email'  ? 'active' : '' ?>" href="<?= site_url('setting/email') ?>">Email Perusahaan</a>
                            <!-- <a class="collapse-item <?= $title == 'Sosial Media'  ? 'active' : '' ?>" href="<?= site_url('setting/sosmed') ?>">Data Akun Sosmed</a> -->
                            <!-- <a class="collapse-item <?= $title == 'Data Webhook'  ? 'active' : '' ?>" href="<?= site_url('setting/webhook') ?>">Data Webhook</a> -->
                            <a class="collapse-item <?= $title == 'User'  ? 'active' : '' ?>" href="<?= site_url('user') ?>">Daftar Pengguna</a>
                            <!-- <a class="collapse-item <?= $title == 'Riwayat Login'  ? 'active' : '' ?>" href="<?= site_url('setting/riwayat') ?>">Riwayat Login</a> -->
                            <a class="collapse-item <?= $title == 'Backup'  ? 'active' : '' ?>" href="<?= site_url('backup') ?>">Backup Database</a>
                            <a class="collapse-item <?= $title == 'Lainnya'  ? 'active' : '' ?>" href="<?= site_url('setting/other') ?>">Atur Lainnya</a>
                        </div>
                    </div>
                </li>
            <?php  } ?>
            <?php if ($user['role_id'] == 1 || $user['role_id'] == 6) { ?>
                <li class="nav-item">
                    <a style="font-weight: bold; color: <?= $colornya ?>;" class="nav-link" target="_blank" href="<?= site_url('mikhmon') ?>" style="font-weight: bold; color: <?= $colornya ?>;">
                        <i style="font-weight: bold; color: <?= $colornya ?>;" class="fa fa-fw fa-globe"></i>
                        <span>Kelola Mikhmon</span>
                    </a>
                </li>
            <?php  } ?>
            <?php if ($user['role_id'] == 1) { ?>
                <li class="nav-item <?= $title == 'Info Aplikasi'  ? 'active' : '' ?>">
                    <a style="font-weight: bold; color: <?= $colornya ?>;" class="nav-link" href="<?= site_url('about') ?>" style="font-weight: bold; color: <?= $colornya ?>;">
                        <i style="font-weight: bold; color: <?= $colornya ?>;" class="fa fa-fw fa-info-circle"></i>
                        <span>Info Aplikasi</span>
                    </a>
                </li>
                <li class="nav-item mb-5 pb-5 <?= $title == 'Donasi'  ? 'active' : '' ?>">
                    <a style="font-weight: bold; color: <?= $colornya ?>;" class="nav-link" href="<?= site_url('donasi') ?>" style="font-weight: bold; color: <?= $colornya ?>;">
                        <i style="font-weight: bold; color: <?= $colornya ?>;" class="fa fa-fw fa-table"></i>
                        <span>Donasi Uang Kopi</span>
                    </a>
                </li>
                <br>
            <?php  } ?>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow" style="background: <?= $backgroundnya ?>;">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3" style="font-weight: bold; color: <?= $colornya ?>;">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form class=" form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search d-none d-sm-block d-md-block">
                        <h5 style="padding-top: 8px; color: <?= $colornya ?>;">
                            <?php
                            // Ambil data waktu saat ini
                            $jam = date('H:i:s');

                            // Ucapan salam menggunakan IF & PHP + Echo
                            if ($jam > '04:01:00' && $jam <= '05:00:00') {
                                $salam = 'Jangan Lupa Sholat Subuh';
                            } elseif ($jam >= '05:01:00' && $jam <= '06:00:00') {
                                $salam = 'Jangan Lupa Olahraga Pagi';
                            } elseif ($jam >= '06:01:00' && $jam <= '06:30:00') {
                                $salam = 'Jangan Lupa Untuk Mandi';
                            } elseif ($jam >= '06:31:00' && $jam <= '07:00:00') {
                                $salam = 'Jangan Lupa Sarapan Pagi';
                            } elseif ($jam >= '07:01:00' && $jam <= '08:00:00') {
                                $salam = 'Jangan Lupa Sholat Dhuha';
                            } elseif ($jam >= '08:01:00' && $jam <= '10:00:00') {
                                $salam = 'Selamat Pagi, Sediakan Kopi';
                            } elseif ($jam >= '10:01:00' && $jam <= '10:30:00') {
                                $salam = 'Jangan Lupa Senyum Hari Ini';
                            } elseif ($jam >= '10:31:00' && $jam <= '11:30:00') {
                                $salam = 'Selamat Siang, Tetap Semangat';
                            } elseif ($jam >= '11:31:00' && $jam <= '12:00:00') {
                                $salam = 'Jangan Lupa Sholat Dzuhur';
                            } elseif ($jam >= '12:01:00' && $jam <= '13:00:00') {
                                $salam = 'Jangan Lupa Makan Siang';
                            } elseif ($jam >= '13:01:00' && $jam <= '15:00:00') {
                                $salam = 'Selamat Siang, Jangan Ngantuk';
                            } elseif ($jam >= '15:01:00' && $jam <= '15:30:00') {
                                $salam = 'Jangan Lupa Sholat Ashar';
                            } elseif ($jam >= '15:31:00' && $jam <= '17:30:00') {
                                $salam = 'Selamat Sore, Tetap Semangat';
                            } elseif ($jam >= '17:31:00' && $jam <= '18:00:00') {
                                $salam = 'Jangan Lupa Sholat Maghrib';
                            } elseif ($jam >= '18:01:00' && $jam <= '18:30:00') {
                                $salam = 'Jangan Lupa Untuk Dzikir';
                            } elseif ($jam >= '18:31:00' && $jam <= '19:00:00') {
                                $salam = 'Jangan Lupa Sholat Isya';
                            } elseif ($jam >= '19:01:00' && $jam <= '22:00:00') {
                                $salam = 'Selamat Malam, Mari Bersantai';
                            } elseif ($jam >= '22:01:00' && $jam <= '23:30:00') {
                                $salam = 'Jangan Lupa Untuk Istirahat';
                            } elseif ($jam >= '23:31:00' && $jam <= '23:59:59') {
                                $salam = 'Menuju Hari/Tanggal Yang Baru';
                            } elseif ($jam >= '00:01:00' && $jam <= '02:00:00') {
                                $salam = 'Istirahat Dulu, Lanjutkan Besok';
                            } elseif ($jam >= '02:01:00' && $jam <= '03:00:00') {
                                $salam = 'Jangan Lupa Sholat Tahajud';
                            } elseif ($jam >= '03:01:00' && $jam <= '03:30:00') {
                                $salam = 'Jangan Lupa Sahur, Jika Berpuasa';
                            } elseif ($jam >= '03:31:00' && $jam <= '04:00:00') {
                                $salam = 'Persiapan Menuju Waktu Imsak';
                            } else {
                                $salam = 'Jangan Lupa Banyak Istighfar';
                            }

                            //Tampilkan ucapan salam
                            ?>
                            <b style="font-size:25px">
                                <?php
                                echo $salam;
                                ?>
                                !
                            </b>
                        </h5>
                    </form>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <?php if ($this->session->userdata('role_id') == 1) { ?>
                            <li class="nav-item dropdown no-arrow mx-1">
                                <a style="font-weight: bold; color: <?= $colornya ?>;" class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-weight: bold; color: <?= $colornya ?>;">
                                    <i class="fas fa-archive fa-fw"></i>
                                    <?php
                                    $no = 1;
                                    $jumlah_layanan = $this->db->get_where('layanan', array('status_layanan' => 'Pending'))->num_rows();
                                    ?>
                                    <?php if ($jumlah_layanan == 0) {
                                    } else { ?>
                                        <span class="badge badge-danger badge-counter"><?= $jumlah_layanan ?></span>
                                    <?php } ?>
                                </a>
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                    <h6 class="dropdown-header" style="background: <?= $backgroundnya ?>; font-weight: bold; color: <?= $colornya ?>;">
                                        Layanan Pelanggan
                                    </h6>
                                    <?php
                                    $layanansaya = $this->db->get_where('layanan', array('status_layanan' => 'Pending'))->result();
                                    foreach ($layanansaya as $datalayanan) {
                                        $id = $datalayanan->id_layanan;
                                    ?>
                                        <a class="dropdown-item d-flex align-items-center" href="<?= site_url('layanan/detail/' . $id) ?>">
                                            <div>
                                                <span class="font-weight-bold"><?= $no++ ?>. <?= $datalayanan->nama_pelanggan; ?> - <?= $datalayanan->judul_layanan; ?></span>
                                                <div class="small text-gray-500"><?= $datalayanan->deskripsi_layanan; ?></div>
                                            </div>
                                        </a>
                                    <?php } ?>
                                    <a class="dropdown-item text-center small text-gray-500" href="<?= site_url('layanan/data') ?>">Tampilkan Semua</a>
                                </div>
                            </li>
                        <?php } ?>
                        <?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 6 || $this->session->userdata('role_id') == 7) { ?>
                            <li class="nav-item dropdown no-arrow mx-1">
                                <a style="font-weight: bold; color: <?= $colornya ?>;" class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-weight: bold; color: <?= $colornya ?>;">
                                    <i class="fas fa-envelope fa-fw"></i>
                                    <?php
                                    $no = 1;
                                    $jumlah_pesan = $this->db->get_where('message', array('status_message' => 'belum dibaca'))->num_rows();
                                    ?>
                                    <?php if ($jumlah_pesan == 0) {
                                    } else { ?>
                                        <span class="badge badge-danger badge-counter"><?= $jumlah_pesan ?></span>
                                    <?php } ?>
                                </a>
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                    <h6 class="dropdown-header" style="background: <?= $backgroundnya ?>; font-weight: bold; color: <?= $colornya ?>;">
                                        Pesan Pengaduan
                                    </h6>
                                    <?php
                                    $mymessage = $this->db->get_where('message', array('status_message' => 'belum dibaca'))->result();
                                    foreach ($mymessage as $datagua) {
                                        $id = $datagua->message_id;
                                    ?>
                                        <a class="dropdown-item d-flex align-items-center" href="<?= site_url('message/detail/' . $id) ?>">
                                            <div>
                                                <span class="font-weight-bold"><?= $datagua->user_pengirim; ?> - <?= $datagua->judul_pesan; ?></span>
                                                <div class="small text-gray-500"><?= $datagua->konten_pesan; ?></div>
                                            </div>
                                        </a>
                                    <?php } ?>
                                    <a class="dropdown-item text-center small text-gray-500" href="<?= site_url('message/data') ?>">Tampilkan Semua</a>
                                </div>
                            </li>
                        <?php } ?>
                        <?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 7) { ?>
                            <li class="nav-item dropdown no-arrow mx-1">
                                <a style="font-weight: bold; color: <?= $colornya ?>;" class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-weight: bold; color: <?= $colornya ?>;">
                                    <i class="fas fa-bell fa-fw"></i>
                                    <?php
                                    $jumlah_confirm = $this->db->get_where('confirm_payment', ['status' => 'Pending'])->num_rows();
                                    ?>
                                    <?php if ($jumlah_confirm == 0) {
                                    } else { ?>
                                        <span class="badge badge-danger badge-counter"><?= $jumlah_confirm ?></span>
                                    <?php } ?>
                                </a>
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                    <h6 class="dropdown-header" style="background: <?= $backgroundnya ?>; font-weight: bold; color: <?= $colornya ?>;">
                                        Menunggu Konfirmasi Pembayaran
                                    </h6>
                                    <?php $query = "SELECT *
                                    FROM `confirm_payment`
                                    WHERE `status` =  'Pending'";
                                    $pendingConfirm = $this->db->query($query)->result(); ?>
                                    <?php foreach ($pendingConfirm as $data) : ?>
                                        <a class="dropdown-item d-flex align-items-center" href="<?= site_url('confirmdetail/' . $data->invoice_id) ?>">
                                            <div>
                                                <?php $Customer = $this->db->get_where('customer', ['no_services' => $data->no_services])->row_array(); ?>
                                                <?php $bill = $this->db->get_where('invoice', ['no_services' => $data->no_services, 'invoice' => $data->invoice_id])->row_array(); ?>
                                                <span class="font-weight-bold"><?= $Customer['name'] ?> - <?= $data->no_services ?></span>
                                                <div class="small text-gray-500">#<?= $data->invoice_id ?> Periode <?= indo_month($bill['month']) ?> <?= $bill['year'] ?></div>
                                            </div>
                                        </a>
                                    <?php endforeach ?>
                                    <a class="dropdown-item text-center small text-gray-500" href="<?= site_url('confirm') ?>">Tampilkan Semua</a>
                                </div>
                            </li>
                        <?php } ?>
                        <?php if ($this->session->userdata('role_id') == 1) { ?>
                            <li class="nav-item dropdown no-arrow mx-1">
                                <a style="font-weight: bold; color: <?= $colornya ?>;" class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-weight: bold; color: <?= $colornya ?>;">
                                    <i class="fas fa-users fa-fw"></i>
                                    <?php
                                    $Capel = $this->db->get_where('customer', ['c_status' => 'Menunggu']);
                                    $jumlah_confirm = $Capel->num_rows();
                                    ?>
                                    <?php if ($jumlah_confirm == 0) {
                                    } else { ?>
                                        <span class="badge badge-danger badge-counter"><?= $jumlah_confirm ?></span>
                                    <?php } ?>
                                </a>
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                                    <h6 class="dropdown-header" style="background: <?= $backgroundnya ?>; font-weight: bold; color: <?= $colornya ?>;">
                                        Calon Pelanggan Baru
                                    </h6>
                                    <?php foreach ($Capel->result() as $capel) { ?>
                                        <a class="dropdown-item d-flex align-items-center" href="<?= site_url('customer/edit/' . $capel->customer_id) ?>">

                                            <div class="font-weight-bold">
                                                <div class="text-truncate"><?= $capel->name; ?></div>
                                                <div class="small text-gray-500"><?= date('d F Y', $capel->created); ?></div>
                                            </div>
                                        </a>
                                    <?php } ?>


                                    <a class="dropdown-item text-center small text-gray-500" href="<?= site_url('customer/wait') ?>">Tampilkan Semua</a>
                                </div>
                            </li>
                        <?php } ?>
                        <div class="d-none d-sm-block d-md-block pt-2" style="font-size: 14px; line-height: 17px; text-align: right; margin-top:10px; margin-left:20px; margin-right: 10px; font-weight: bold; color: <?= $colornya ?>;">
                            <b>
                                <span id="jamServer">
                                    <?= date('H:i:s'); ?>
                                </span>
                                <span>
                                    WIB
                                </span>
                                <br>
                                <span>
                                    <script type='text/javascript'>
                                        var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                        var myDays = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"];
                                        var date = new Date();
                                        var day = date.getDate();
                                        var month = date.getMonth();
                                        var thisDay = date.getDay(),
                                            thisDay = myDays[thisDay];
                                        var yy = date.getYear();
                                        var year = (yy < 1000) ? yy + 1900 : yy;
                                        document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
                                        // document.write(months[month] + ' ' + year);
                                    </script>
                                </span>
                            </b>
                        </div>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a style="font-weight: bold; color: <?= $colornya ?>;" class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-weight: bold; color: <?= $colornya ?>;">
                                <span class="mr-2 d-lg-inline text-gray-600 small d-none d-sm-block d-md-block" style="line-height: 17px;">
                                    <b style="margin-left:-5px; font-weight: bold; color: <?= $colornya ?>;"><?php function get_client_ip()
                                                                                                                {
                                                                                                                    $ipaddress = '';
                                                                                                                    if (isset($_SERVER['HTTP_CLIENT_IP']))
                                                                                                                        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
                                                                                                                    else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
                                                                                                                        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
                                                                                                                    else if (isset($_SERVER['HTTP_X_FORWARDED']))
                                                                                                                        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
                                                                                                                    else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
                                                                                                                        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
                                                                                                                    else if (isset($_SERVER['HTTP_FORWARDED']))
                                                                                                                        $ipaddress = $_SERVER['HTTP_FORWARDED'];
                                                                                                                    else if (isset($_SERVER['REMOTE_ADDR']))
                                                                                                                        $ipaddress = $_SERVER['REMOTE_ADDR'];
                                                                                                                    else
                                                                                                                        $ipaddress = 'IP tidak dikenali';
                                                                                                                    return $ipaddress;
                                                                                                                } ?>
                                        IP : <?php
                                                echo get_client_ip();
                                                ?>
                                        <?php
                                        ?>
                                    </b>
                                    <br>
                                    <?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 6) { ?>
                                        <?php $Router = $this->db->get_where('router');
                                        foreach ($Router->result() as $router) { ?>
                                            <?php if ($router->description == 'Aktif') { ?>
                                                <b style="margin-left:-5px; font-weight: bold; color: <?= $colornya ?>;">
                                                    <?= $router->name_router ?>
                                                </b>
                                            <?php } else {
                                            } ?>
                                        <?php } ?>
                                    <?php } ?>
                                </span>
                                <img class="img-profile rounded-circle" src="<?= site_url(''); ?>assets/images/profile/<?= $user['image']; ?>" alt="" style="margin-left: 5px; background: #fff;">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?= site_url('user/profile') ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-black-400"></i>
                                    <!-- <b>
                                        <?= $user['name']; ?>
                                    </b> -->
                                    <b>
                                        Profile (<?= $user['name']; ?>)
                                    </b>
                                </a>
                                <?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 6) { ?>
                                    <?php $Router = $this->db->get_where('router');
                                    foreach ($Router->result() as $router) { ?>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="<?= site_url('mikrotik/klikrouter/') ?><?= $router->router_id ?>">
                                            <?php if ($router->description == 'Aktif') { ?>
                                                <font style="color: green;">
                                                    <i class="fa fa-codepen fa-sm fa-fw mr-2"></i>
                                                </font>
                                                <b style="color: green;">
                                                    Router : <?= $router->name_router ?>
                                                </b>
                                            <?php } else { ?>
                                                <font style="color: red;">
                                                    <i class="fa fa-codepen fa-sm fa-fw mr-2"></i>
                                                </font>
                                                <i style="color: red;">
                                                    Router : <?= $router->name_router ?>
                                                </i>
                                            <?php } ?>

                                        </a>
                                    <?php } ?>
                                <?php } ?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= site_url('auth/logout/') ?>">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-black-400"></i>
                                    <b>
                                        Keluar
                                    </b>
                                </a>
                            </div>
                            <!-- <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <center>
                                    <b style="color: black;">
                                        ROUTER
                                    </b>
                                </center>
                                <?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 3 || $this->session->userdata('role_id') == 10) { ?>
									<?php $Router = $this->db->get_where('router');
                                    foreach ($Router->result() as $router) { ?>
									<a class="dropdown-item" href="<?= site_url('mikrotik/klikrouter/') ?><?= $router->router_id ?>">
										<?php if ($router->description == 'Aktif') { ?>
                                        <font style="color: green;">
                                            <i class="fa fa-codepen fa-sm fa-fw mr-2"></i>
                                        </font>
                                        <b style="color: green;">
                                            <?= $router->name_router ?>
                                        </b>
                                    <?php } else { ?>
                                        <font style="color: red;">
                                            <i class="fa fa-codepen fa-sm fa-fw mr-2"></i>
                                        </font>
                                        <i style="color: red;">
                                            <?= $router->name_router ?>
                                        </i>
                                    <?php } ?>
										
									</a>
									<?php } ?>
								<?php } ?>
                                <div class="dropdown-divider"></div>
                                <center>
                                    <b style="color: black;">
                                        MENU
                                    </b>
                                </center>
                                <a class="dropdown-item" href="<?= site_url('user/profile') ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    <?= $user['name']; ?>
                                </a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Keluar
                                </a>
                            </div> -->
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->
                <!-- Bootstrap core JavaScript-->
                <script src="https://files.billing.or.id/assets/backend/vendor/jquery/jquery.min.js"></script>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?= $contents ?>
                    <br><br><br><br><br>
                </div>
                <!-- /.container-fluid -->

            </div>
            <nav class="navbar navbar-<?= $company['front'] ?> shadow navbar-expand d-xs-none d-sm-none d-md-flex d-lg-flex d-xl-flex fixed-bottom text-center" style="background: <?= $backgroundnya ?>;">
                <center>
                    <span style="font-weight: bold; color: <?= $colornya ?>;">
                        &copy; Copyright <?= date('Y') ?> All Rights Reserved - Created And Developed by : <a href="https://facebook.com/<?= $company['facebook']; ?>" target="_blank" style="text-decoration: none; font-weight: bold; color: <?= $colornya ?>;"><?= $company['company_name']; ?></a> &nbsp; || &nbsp;
                        <?php
                        $starttime = explode(' ', microtime());
                        $starttime = $starttime[1] + $starttime[0];
                        $load = microtime();
                        $loadtime = explode(' ', microtime());
                        $loadtime = $loadtime[0] + $loadtime[1] - $starttime;
                        echo "Page Displayed In " . substr($load, 0, 4) . " Seconds";
                        echo " &nbsp; ||  &nbsp;";
                        echo "Peak Memory Usage : " . round(memory_get_peak_usage() / 1048576, 2), " MB";
                        ?>
                    </span>
                </center>
            </nav>
        </div>
    </div>
    <style>
        .scroll-to-top {
            position: fixed;
            left: 50%;
            right: 50%;
            bottom: 4rem;
            display: none;
            width: 2.75rem;
            height: 2.75rem;
            text-align: center;
            color: <?= $colornya ?>;
            background: <?= $backgroundnya ?>;
            line-height: 46px;
        }

        .scroll-to-top:focus,
        .scroll-to-top:hover {
            color: white;
        }

        .scroll-to-top:hover {
            background: <?= $backgroundnya ?>;
        }

        .scroll-to-top i {
            font-weight: 800;
        }
    </style>
    <a class="scroll-to-top rounded" href="#page-top" title="Back To Top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.4/dist/sweetalert2.all.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://files.billing.or.id/assets/backend/js/bootstrap-select.js"></script>
    <!-- <script src="<?= site_url('assets/') ?>ajax_daerah.js"></script> -->
    <script src="https://files.billing.or.id/assets/backend/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="https://files.billing.or.id/assets/backend/js/sb-admin-2.js"></script>
    <script src="https://files.billing.or.id/assets/backend/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="https://files.billing.or.id/assets/backend/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="https://files.billing.or.id/assets/backend/js/demo/datatables-demo.js"></script>
    <script src="https://files.billing.or.id/assets/backend/js/select2.full.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#tablebt').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: ['copy'],
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: ['csv'],
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: ['excel'],
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: ['pdf'],
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: ['print'],
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    'colvis'
                ],
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            oTable = jQuery('#dataTableDraf').dataTable({
                "bPaginate": false,
                "bLengthChange": false,
                "aoColumns": [{
                        "bSortable": true
                    },
                    {
                        "bSortable": true
                    },
                    {
                        "bSortable": true
                    },
                    {
                        "bSortable": true
                    },
                    {
                        "bSortable": true
                    },

                    {
                        "bSortable": true
                    },
                    {
                        "bSortable": false
                    }
                ]
            });
        })
    </script>
    <script>
        var serverClock = jQuery("#jamServer");
        if (serverClock.length > 0) {
            showServerTime(serverClock, serverClock.text());
        }

        function showServerTime(obj, time) {
            var parts = time.split(":"),
                newTime = new Date();

            newTime.setHours(parseInt(parts[0], 10));
            newTime.setMinutes(parseInt(parts[1], 10));
            newTime.setSeconds(parseInt(parts[2], 10));

            var timeDifference = new Date().getTime() - newTime.getTime();

            var methods = {
                displayTime: function() {
                    var now = new Date(new Date().getTime() - timeDifference);
                    obj.text([
                        methods.leadZeros(now.getHours(), 2),
                        methods.leadZeros(now.getMinutes(), 2),
                        methods.leadZeros(now.getSeconds(), 2)
                    ].join(":"));
                    setTimeout(methods.displayTime, 500);
                },

                leadZeros: function(time, width) {
                    while (String(time).length < width) {
                        time = "0" + time;
                    }
                    return time;
                }
            }
            methods.displayTime();
        }
    </script>
    <script>
        function detail_loc(param) {
            $('div#modal-id').modal('show');
        }

        function setMapToForm(latitude, longitude) {
            $('input[name="latitude"]').val(latitude.toFixed(5));
            $('input[name="longitude"]').val(longitude.toFixed(5));
        }
    </script>
    <script src="https://files.billing.or.id/assets/js/sweetalert2.all.min.js"></script>
    <script src="https://files.billing.or.id/assets/js/myscript.js"></script>
    <script>
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>
    <script>
        $(window).resize(function() {
            if ($(window).width() < 767) {
                $("body").toggleClass("sidebar-toggled");
                $(".sidebar").toggleClass("toggled");
                if ($(".sidebar").hasClass("toggled")) {
                    $('.sidebar .collapse').collapse('hide');
                };
            };
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            if ($(window).width() < 767) {
                $("body").toggleClass("sidebar-toggled");
                $(".sidebar").toggleClass("toggled");
                if ($(".sidebar").hasClass("toggled")) {
                    $('.sidebar .collapse').collapse('hide');
                };
            }
        });
    </script>
    <script>
        // fungsi initialize untuk mempersiapkan peta
        function initialize() {
            var propertiPeta = {
                center: new google.maps.LatLng(-8.5830695, 116.3202515),
                zoom: 9,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);
        }

        // event jendela di-load  
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
</body>

</html>