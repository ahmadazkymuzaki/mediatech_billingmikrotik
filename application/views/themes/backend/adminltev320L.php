<!DOCTYPE html>
<html lang="en">
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://files.billing.or.id/adminlte320L/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="https://files.billing.or.id/adminlte320L/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="https://files.billing.or.id/adminlte320L/plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="https://files.billing.or.id/adminlte320L/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://files.billing.or.id/adminlte320L/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="https://files.billing.or.id/adminlte320L/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="https://files.billing.or.id/adminlte320L/plugins/summernote/summernote-bs4.min.css">
    <link href="https://files.billing.or.id/assets/backend/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://files.billing.or.id/assets/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.5.0/css/all.min.css">
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
        $backgroundnya = '#5a5c69';
        $colornya = '#000';
        $colorsub = '#fff';
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
        $backgroundnya = '#5a5c69';
        $colornya = '#000';
        $colorsub = '#fff';
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
        $backgroundnya = '#5a5c69';
        $colornya = '#000';
        $colorsub = '#fff';
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
        $backgroundnya = '#5a5c69';
        $colornya = '#000';
        $colorsub = '#fff';
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
        $backgroundnya = '#5a5c69';
        $colornya = '#000';
        $colorsub = '#fff';
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
        $backgroundnya = '#5a5c69';
        $colornya = '#000';
        $colorsub = '#fff';
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
        $colornya = '#000';
        $colorsub = '#fff';
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
        $backgroundnya = '#5a5c69';
        $colornya = '#000';
        $colorsub = '#fff';
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
        $backgroundnya = '#5a5c69';
        $colornya = '#000';
        $colorsub = '#fff';
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
        $backgroundnya = '#5a5c69';
        $colornya = '#000';
        $colorsub = '#fff';
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
        $backgroundnya = '#5a5c69';
        $colornya = '#000';
        $colorsub = '#fff';
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
        $backgroundnya = '#5a5c69';
        $colornya = '#000';
        $colorsub = '#fff';
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
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
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
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
              </li>
                <li class="nav-item d-none d-sm-inline-block mt-1">
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
                    ?>
                    <b style="font-size: 20px;">
                        <?php
                        echo $salam;
                        ?>
                        !
                    </b>
                </li>
            </ul>
        
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <?php if ($this->session->userdata('role_id') == 1) { ?>
                    <li class="nav-item dropdown" style="padding-right: -5px; padding-left: -5px; margin-right: -5px; margin-left: -5px;">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="fas fa-archive fa-fw"></i>
                            <?php
                                $no = 1;
                                $jumlah_layanan = $this->db->get_where('layanan', array('status_layanan' => 'Pending'))->num_rows();
                                if ($jumlah_layanan == 0) {
                                } else {
                            ?>
                                <span class="badge badge-danger navbar-badge">
                                    <?= $jumlah_layanan ?>
                                </span>
                            <?php } ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-item dropdown-header">
                                Pengajuan Layanan
                            </span>
                            <div class="dropdown-divider"></div>
                            <?php
                                if ($jumlah_layanan == 0) {
                            ?>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-archive fa-fw"></i>&nbsp;
                                    Tidak Ada Pengajuan
                                    <div class="small text-gray-500">
                                        kosong
                                    </div>
                                </a>
                            <?php
                                } else {
                            ?>
                                <?php
                                    $layanansaya = $this->db->get_where('layanan', array('status_layanan' => 'Pending'))->result();
                                        foreach ($layanansaya as $datalayanan) {
                                                $id = $datalayanan->id_layanan;
                                ?>
                                    <a class="dropdown-item" href="<?= site_url('layanan/detail/' . $id) ?>">
                                        <i class="fas fa-archive fa-fw"></i>&nbsp;
                                        <?= $datalayanan->nama_pelanggan; ?>
                                        <div class="small text-gray-500">
                                            <?= $datalayanan->judul_layanan; ?>
                                        <div class="small text-gray-500">
                                            <?= $datalayanan->deskripsi_layanan; ?>
                                        </div>
                                    </a>
                                <?php } ?>
                            <?php } ?>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item dropdown-footer" href="<?= site_url('layanan/data') ?>">Tampilkan Semua</a>
                        </div>
                    </li>
                <?php } ?>
                <?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 6 || $this->session->userdata('role_id') == 7) { ?>
                    <li class="nav-item dropdown" style="padding-right: -5px; padding-left: -5px; margin-right: -5px; margin-left: -5px;">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="fas fa-envelope fa-fw"></i>
                            <?php
                                $no = 1;
                                $jumlah_pesan = $this->db->get_where('message', array('status_message' => 'belum dibaca'))->num_rows();
                                if ($jumlah_pesan == 0) {
                                } else {
                            ?>
                                <span class="badge badge-danger navbar-badge">
                                    <?= $jumlah_pesan ?>
                                </span>
                            <?php } ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-item dropdown-header">
                                Pesan Pengaduan
                            </span>
                            <div class="dropdown-divider"></div>
                            <?php
                                if ($jumlah_pesan == 0) {
                            ?>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-envelope fa-fw"></i>&nbsp;
                                    Tidak Ada Pengaduan
                                    <div class="small text-gray-500">
                                        kosong
                                    </div>
                                </a>
                            <?php
                                } else {
                            ?>
                                <?php
                                    $mymessage = $this->db->get_where('message', array('status_message' => 'belum dibaca'))->result();
                                    foreach ($mymessage as $datagua) {
                                        $id = $datagua->message_id;
                                ?>
                                    <a class="dropdown-item" href="<?= site_url('message/detail/' . $id) ?>">
                                        <i class="fas fa-envelope fa-fw"></i>&nbsp;
                                        <?= $datagua->user_pengirim; ?>
                                        <div class="small text-gray-500">
                                            <?= $datagua->judul_pesan; ?>
                                        </div>
                                        <div class="small text-gray-500">
                                            <?= $datagua->konten_pesan; ?>
                                        </div>
                                    </a>
                                <?php } ?>
                            <?php } ?>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item dropdown-footer" href="<?= site_url('message/data') ?>">Tampilkan Semua</a>
                        </div>
                    </li>
                <?php } ?>
                <?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 7) { ?>
                    <li class="nav-item dropdown" style="padding-right: -5px; padding-left: -5px; margin-right: -5px; margin-left: -5px;">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="fas fa-bell fa-fw"></i>
                            <?php
                                $jumlah_confirm = $this->db->get_where('confirm_payment', ['status' => 'Pending'])->num_rows();
                                if ($jumlah_confirm == 0) {
                                } else {
                            ?>
                                <span class="badge badge-danger navbar-badge">
                                    <?= $jumlah_confirm ?>
                                </span>
                            <?php } ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-item dropdown-header">
                                Konfirmasi Pembayaran
                            </span>
                            <div class="dropdown-divider"></div>
                            <?php
                                if ($jumlah_confirm == 0) {
                            ?>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-bell fa-fw"></i>&nbsp;
                                    Tidak Ada Konfirmasi
                                    <div class="small text-gray-500">
                                        kosong
                                    </div>
                                </a>
                            <?php
                                } else {
                            ?>
                                <?php
                                    $query = "SELECT * FROM `confirm_payment` WHERE `status` =  'Pending'";
                                    $pendingConfirm = $this->db->query($query)->result();
                                    foreach ($pendingConfirm as $data){
                                ?>
                                    <a class="dropdown-item" href="<?= site_url('confirmdetail/' . $data->invoice_id) ?>">
                                        <?php
                                            $Customer = $this->db->get_where('customer', ['no_services' => $data->no_services])->row_array();
                                            $bill = $this->db->get_where('invoice', ['no_services' => $data->no_services, 'invoice' => $data->invoice_id])->row_array();
                                        ?>
                                        <i class="fas fa-bell fa-fw"></i>&nbsp;
                                        <?= $Customer['name'] ?>
                                        <div class="small text-gray-500">
                                            ( <?= $data->no_services ?> )
                                        </div>
                                        <div class="small text-gray-500">
                                            #<?= $data->invoice_id ?> Periode <?= indo_month($bill['month']) ?> <?= $bill['year'] ?>
                                        </div>
                                    </a>
                                <?php } ?>
                            <?php } ?>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item dropdown-footer" href="<?= site_url('confirm') ?>">Tampilkan Semua</a>
                        </div>
                    </li>
                <?php } ?>
                <?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 7) { ?>
                    <li class="nav-item dropdown" style="padding-right: -5px; padding-left: -5px; margin-right: -5px; margin-left: -5px;">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="fas fa-users fa-fw"></i>
                            <?php
                                $Capel = $this->db->get_where('customer', ['c_status' => 'Menunggu']);
                                $jumlah_pelanggan = $Capel->num_rows();
                                if ($jumlah_pelanggan == 0) {
                                } else {
                            ?>
                                <span class="badge badge-danger navbar-badge">
                                    <?= $jumlah_pelanggan ?>
                                </span>
                            <?php } ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-item dropdown-header">
                                Pendaftaran Pelanggan
                            </span>
                            <div class="dropdown-divider"></div>
                            <?php
                                if ($jumlah_confirm == 0) {
                            ?>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-users fa-fw"></i>&nbsp;
                                    Tidak Ada Pendaftaran
                                    <div class="small text-gray-500">
                                        kosong
                                    </div>
                                </a>
                            <?php
                                } else {
                            ?>
                                <?php
                                    foreach ($Capel->result() as $capel) {
                                ?>
                                    <a class="dropdown-item" href="<?= site_url('customer/edit/' . $capel->customer_id) ?>">
                                        <i class="fas fa-users fa-fw"></i>&nbsp;
                                        <?= $capel->name; ?>
                                        <div class="small text-gray-500">
                                            <?= date('d F Y', $capel->created); ?>
                                        </div>
                                    </a>
                                <?php } ?>
                            <?php } ?>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item dropdown-footer" href="<?= site_url('customer/wait') ?>">Tampilkan Semua</a>
                        </div>
                    </li>
                <?php } ?>
                <li class="nav-item" style="padding-right: -5px; padding-left: -5px; margin-right: -5px; margin-left: -5px;">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                      <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item d-none d-sm-block d-md-block" style="font-size: 14px; line-height: 17px; text-align: right; margin-top: 3px; margin-left: 10px; margin-right: 10px; font-weight: bold;">
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
                            var thisDay = date.getDay(), thisDay = myDays[thisDay];
                            var yy = date.getYear();
                            var year = (yy < 1000) ? yy + 1900 : yy;
                            document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
                            // document.write(months[month] + ' ' + year);
                        </script>
                    </span>
                </li>
                <li class="nav-item d-none d-sm-block d-md-block" style="font-size: 14px; line-height: 17px; text-align: right; margin-top: 3px; margin-left: 10px; font-weight: bold;">
                    <b>
                        <?php
                            if (isset($_SERVER['HTTP_CLIENT_IP'])){
                                $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
                            } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
                                $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
                            } elseif (isset($_SERVER['HTTP_X_FORWARDED'])){
                                $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
                            } elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])){
                                $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
                            } elseif (isset($_SERVER['HTTP_FORWARDED'])){
                                $ipaddress = $_SERVER['HTTP_FORWARDED'];
                            } elseif (isset($_SERVER['REMOTE_ADDR'])){
                                $ipaddress = $_SERVER['REMOTE_ADDR'];
                            } else {
                                $ipaddress = 'IP tidak dikenali';
                            }
                        ?>
                            IP : <?= $ipaddress ?>
                        </b>
                        <br>
                        <?php
                            if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 6) {
                        ?>
                            <?php
                                $Router = $this->db->get_where('router');
                                foreach ($Router->result() as $router) { ?>
                                <?php if ($router->description == 'Aktif') { ?>
                                    <b style="margin-left:-5px; font-weight: bold; color: <?= $colornya ?>;">
                                        <?= $router->name_router ?>
                                    </b>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    </span>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" style="margin-top: -9px;" data-toggle="dropdown" href="#">
                        <img class="img-profile rounded-circle" src="<?= site_url(''); ?>assets/images/profile/<?= $user['image']; ?>" height="40" alt="" style="margin-left: 5px; background: #fff;">
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a class="dropdown-item dropdown-header" href="<?= site_url('user/profile') ?>">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-black-400"></i>&nbsp;
                            <b>Profile (<?= $user['name']; ?>)</b>
                        </a>
                        <?php
                            if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 6) {
                            $Router = $this->db->get('router')->result();
                            foreach ($Router as $router) {
                        ?>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= site_url('mikrotik/klikrouter/') ?><?= $router->router_id ?>">
                                <?php
                                    if ($router->description == 'Aktif') {
                                ?>
                                    <font style="color: green;">
                                        <i class="fa fa-codepen fa-sm fa-fw mr-2"></i>
                                    </font>
                                    <b style="color: green;">
                                        Router : <?= $router->name_router ?>
                                    </b>
                                <?php
                                    } else {
                                ?>
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
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-black-400"></i>&nbsp;
                            <b>Keluar Aplikasi</b>
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="" class="brand-link">
              <i style="font-weight: bold; padding-top: 10px; color: <?= $colorsub ?>;" class="brand-image fas fa-wifi"></i>
              &nbsp;
              <span class="brand-text font-weight-light" style="font-family: arial;"><b>BILLING</b></span>
            </a>
            <div class="sidebar">
              <!-- Sidebar Menu -->
              <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
                       with font-awesome or any other icon font library -->
                  <li class="nav-item">
                    <a href="<?= site_url('dashboard') ?>" class="nav-link <?= $title == 'Dashboard'  ? 'active' : '' ?>">
                      <i class="fas fa-fw fa-tachometer-alt" style="font-weight: bold; color: <?= $colorsub ?>;"></i>&nbsp;&nbsp;
                      <p>
                        Halaman Utama
                      </p>
                    </a>
                  </li>
                  <?php if ($user['role_id'] == 1) { ?>
                      <li class="nav-item <?= $title == 'Balas Otomatis' | $title == 'Kontak WhatsApp' | $title == 'Cronjob WhatsApp' | $title == 'WhatsApp Blaster' | $title == 'Test Kirim WA' | $title == 'Kirim WA Massal' | $title == 'Setting WhatsApp' ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= $title == 'Balas Otomatis' | $title == 'Kontak WhatsApp' | $title == 'Cronjob WhatsApp' | $title == 'WhatsApp Blaster' | $title == 'Test Kirim WA' | $title == 'Kirim WA Massal' | $title == 'Setting WhatsApp' ? 'active' : '' ?>">
                          <i style="font-weight: bold; color: <?= $colorsub ?>;" class="fab fa-fw fa-whatsapp"></i>&nbsp;&nbsp;
                          <p>
                            Kelola WhatsApp
                            <i class="right fas fa-angle-left"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a class="nav-link <?= $title == 'Setting WhatsApp'  ? 'active' : '' ?>" href="<?= site_url('whatsapp/setting') ?>"><i class="far fa-circle nav-icon"></i> <p>Setting Akun Whatsapp</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Kontak WhatsApp'  ? 'active' : '' ?>" href="<?= site_url('whatsapp/contact') ?>"><i class="far fa-circle nav-icon"></i> <p>Data Kontak Whatsapp</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Cronjob WhatsApp'  ? 'active' : '' ?>" href="<?= site_url('whatsapp/cronjob') ?>"><i class="far fa-circle nav-icon"></i> <p>Set Cronjob Whatsapp</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Test Kirim WA'  ? 'active' : '' ?>" href="<?= site_url('whatsapp/sending') ?>"><i class="far fa-circle nav-icon"></i> <p>Test Kirim Pesan WA</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Kirim WA Massal'  ? 'active' : '' ?>" href="<?= site_url('whatsapp/massal') ?>"><i class="far fa-circle nav-icon"></i> <p>Kirim Pesan WA Massal</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'WhatsApp Blaster'  ? 'active' : '' ?>" href="<?= site_url('whatsapp/campaign') ?>"><i class="far fa-circle nav-icon"></i> <p>Daftar Pesan Terjadwal</p></a></li>
                        </ul>
                      </li>
                  <?php } ?>
                  <?php if ($user['role_id'] == 1 || $user['role_id'] == 6) { ?>
                      <li class="nav-item <?= $title == 'Setting Router' | $title == 'Status Router' | $title == 'Script Router' | $title == 'Semua Router' | $title == 'Log Router' | $title == 'DHCP Leases' | $title == 'All Interface' ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= $title == 'Setting Router' | $title == 'Status Router' | $title == 'Script Router' | $title == 'Semua Router' | $title == 'Log Router' | $title == 'DHCP Leases' | $title == 'All Interface' ? 'active' : '' ?>">
                          <i style="font-weight: bold; color: <?= $colorsub ?>;" class="fa fa-fw fa-server"></i>&nbsp;&nbsp;
                          <p>
                            Kelola MikroTik
                            <i class="right fas fa-angle-left"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a class="nav-link <?= $title == 'Status Router'  ? 'active' : '' ?>" href="<?= site_url('mikrotik/status') ?>"><i class="far fa-circle nav-icon"></i> <p>Status Router</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Log Router'  ? 'active' : '' ?>" href="<?= site_url('mikrotik/log') ?>"><i class="far fa-circle nav-icon"></i> <p>Log Router</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'DHCP Leases'  ? 'active' : '' ?>" href="<?= site_url('mikrotik/leases') ?>"><i class="far fa-circle nav-icon"></i> <p>DHCP Leases</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'All Interface'  ? 'active' : '' ?>" href="<?= site_url('mikrotik/interface') ?>"><i class="far fa-circle nav-icon"></i> <p>All Interface</p></a></li>
                            <!-- <li class="nav-item"><a class="nav-link <?= $title == 'Script Router'  ? 'active' : '' ?>" href="<?= site_url('mikrotik/script') ?>"><i class="far fa-circle nav-icon"></i> <p>Script Router</p></a></li> -->
                            <li class="nav-item"><a class="nav-link <?= $title == 'Semua Router'  ? 'active' : '' ?>" href="<?= site_url('mikrotik/semua') ?>"><i class="far fa-circle nav-icon"></i> <p>Semua Router</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Setting Router'  ? 'active' : '' ?>" href="<?= site_url('mikrotik/setting') ?>"><i class="far fa-circle nav-icon"></i> <p>Setting Router</p></a></li>
                        </ul>
                      </li>
                      <li class="nav-item <?= $title == 'Profile Hotspot' | $title == 'Users Hotspot' | $title == 'Generate Users' | $title == 'Hosts Hotspot' | $title == 'Active Hotspot' | $title == 'Binding Hotspot' | $title == 'Walled Garden' | $title == 'Cookies Hotspot' ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= $title == 'Profile Hotspot' | $title == 'Users Hotspot' | $title == 'Generate Users' | $title == 'Hosts Hotspot' | $title == 'Active Hotspot' | $title == 'Binding Hotspot' | $title == 'Walled Garden' | $title == 'Cookies Hotspot' ? 'active' : '' ?>">
                          <i style="font-weight: bold; color: <?= $colorsub ?>;" class="fas fa-fw fa-tags"></i>&nbsp;&nbsp;
                          <p>
                            Kelola Hotspot
                            <i class="right fas fa-angle-left"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a class="nav-link <?= $title == 'Profile Hotspot'  ? 'active' : '' ?>" href="<?= site_url('hotspot/profile') ?>"><i class="far fa-circle nav-icon"></i> <p>Profile Hotspot</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Users Hotspot'  ? 'active' : '' ?>" href="<?= site_url('hotspot/users') ?>"><i class="far fa-circle nav-icon"></i> <p>Users Hotspot</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Generate Users'  ? 'active' : '' ?>" href="<?= site_url('hotspot/generate') ?>"><i class="far fa-circle nav-icon"></i> <p>Generate Users</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Hosts Hotspot'  ? 'active' : '' ?>" href="<?= site_url('hotspot/hosts') ?>"><i class="far fa-circle nav-icon"></i> <p>Hosts Hotspot</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Active Hotspot'  ? 'active' : '' ?>" href="<?= site_url('hotspot/active') ?>"><i class="far fa-circle nav-icon"></i> <p>Active Hotspot</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Binding Hotspot'  ? 'active' : '' ?>" href="<?= site_url('hotspot/binding') ?>"><i class="far fa-circle nav-icon"></i> <p>Binding Hotspot</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Walled Garden'  ? 'active' : '' ?>" href="<?= site_url('hotspot/walled') ?>"><i class="far fa-circle nav-icon"></i> <p>Walled Garden</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Cookies Hotspot'  ? 'active' : '' ?>" href="<?= site_url('hotspot/cookie') ?>"><i class="far fa-circle nav-icon"></i> <p>Cookies Hotspot</p></a></li>
                        </ul>
                      </li>
                      <li class="nav-item <?= $title == 'Profile PPP' | $title == 'Secrets PPP' | $title == 'User Static' | $title == 'Active PPP' ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= $title == 'Profile PPP' | $title == 'Secrets PPP' | $title == 'User Static' | $title == 'Active PPP' ? 'active' : '' ?>">
                          <i style="font-weight: bold; color: <?= $colorsub ?>;" class="fas fa-fw fa-home"></i>&nbsp;&nbsp;
                          <p>
                            PPPOE & Static
                            <i class="right fas fa-angle-left"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a class="nav-link <?= $title == 'Profile PPP'  ? 'active' : '' ?>" href="<?= site_url('ppp/profile') ?>"><i class="far fa-circle nav-icon"></i> <p>Profile PPP</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Secrets PPP'  ? 'active' : '' ?>" href="<?= site_url('ppp/secret') ?>"><i class="far fa-circle nav-icon"></i> <p>Secrets PPP</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Active PPP'  ? 'active' : '' ?>" href="<?= site_url('ppp/active') ?>"><i class="far fa-circle nav-icon"></i> <p>Active PPP</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'User Static'  ? 'active' : '' ?>" href="<?= site_url('ppp/static') ?>"><i class="far fa-circle nav-icon"></i> <p>User Static</p></a></li>
                        </ul>
                      </li>
                  <?php } ?>
                  <?php if ($user['role_id'] == 1 || $user['role_id'] == 6 || $user['role_id'] == 7) { ?>
                  <li class="nav-item <?= $title == 'Coverage Area' | $title == 'Lokasi ODP' | $title == 'Lokasi ODC' | $title == 'Item Layanan' | $title == 'Kategori Layanan' | $title == 'Data Layanan' | $title == 'Data Pengaduan' ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= $title == 'Coverage Area' | $title == 'Lokasi ODP' | $title == 'Lokasi ODC' | $title == 'Item Layanan' | $title == 'Kategori Layanan' | $title == 'Data Layanan' | $title == 'Data Pengaduan' ? 'active' : '' ?>">
                      <i style="font-weight: bold; color: <?= $colorsub ?>;" class="fas fa-fw fa-home"></i>&nbsp;&nbsp;
                      <p>
                        Kelola Layanan
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php if ($user['role_id'] == 1 || $user['role_id'] == 6) { ?>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Coverage Area'  ? 'active' : '' ?>" href="<?= site_url('coverage') ?>"><i class="far fa-circle nav-icon"></i> <p>Coverage Area</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Lokasi ODP'  ? 'active' : '' ?>" href="<?= site_url('coverage/odp') ?>"><i class="far fa-circle nav-icon"></i> <p>Lokasi ODP</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Lokasi ODC'  ? 'active' : '' ?>" href="<?= site_url('coverage/odc') ?>"><i class="far fa-circle nav-icon"></i> <p>Lokasi ODC</p></a></li>
                        <?php } ?>
                        <?php if ($user['role_id'] == 1) { ?>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Kategori Layanan'  ? 'active' : '' ?>" href="<?= site_url('package/category') ?>"><i class="far fa-circle nav-icon"></i> <p>Kategori Layanan</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Item Layanan'  ? 'active' : '' ?>" href="<?= site_url('package/item') ?>"><i class="far fa-circle nav-icon"></i> <p>Item Layanan</p></a></li>
                        <?php } ?>
                        <li class="nav-item"><a class="nav-link <?= $title == 'Data Layanan'  ? 'active' : '' ?>" href="<?= site_url('layanan/data') ?>"><i class="far fa-circle nav-icon"></i> <p>Ajuan Layanan</p></a></li>
                        <li class="nav-item"><a class="nav-link <?= $title == 'Data Pengaduan'  ? 'active' : '' ?>" href="<?= site_url('message/data') ?>"><i class="far fa-circle nav-icon"></i> <p>Pengaduan</p></a></li>
                    </ul>
                  </li>
                  <?php  } ?>
                  <?php if ($user['role_id'] == 1) { ?>
                      <li class="nav-item <?= $title == 'Tambah' | $title == 'Aktif' | $title == 'Non-Aktif' | $title == 'Lokasi' | $title == 'Gratis' | $title == 'Isolir' | $title == 'Waiting' | $title == 'Customer'   ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= $title == 'Tambah' | $title == 'Aktif' | $title == 'Non-Aktif' | $title == 'Lokasi' | $title == 'Gratis' | $title == 'Isolir' | $title == 'Waiting' | $title == 'Customer'   ? 'active' : '' ?>">
                          <i style="font-weight: bold; color: <?= $colorsub ?>;" class="fas fa-fw fa-users"></i>&nbsp;&nbsp;
                          <p>
                            Kelola Pelanggan
                            <i class="right fas fa-angle-left"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a class="nav-link <?= $title == 'Tambah'  ? 'active' : '' ?>" href="<?= site_url('customer/add') ?>"><i class="far fa-circle nav-icon"></i> <p>Tambah</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Aktif'  ? 'active' : '' ?>" href="<?= site_url('customer/active') ?>"><i class="far fa-circle nav-icon"></i> <p>Aktif</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Non-Aktif'  ? 'active' : '' ?>" href="<?= site_url('customer/nonactive') ?>"><i class="far fa-circle nav-icon"></i> <p>Non-Aktif</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Waiting'  ? 'active' : '' ?>" href="<?= site_url('customer/wait') ?>"><i class="far fa-circle nav-icon"></i> <p>Menunggu</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Gratis'  ? 'active' : '' ?>" href="<?= site_url('customer/free') ?>"><i class="far fa-circle nav-icon"></i> <p>Gratis</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Isolir'  ? 'active' : '' ?>" href="<?= site_url('customer/isolir') ?>"><i class="far fa-circle nav-icon"></i> <p>Isolir</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Customer'  ? 'active' : '' ?>" href="<?= site_url('customer') ?>"><i class="far fa-circle nav-icon"></i> <p>Semua</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Lokasi'  ? 'active' : '' ?>" href="<?= site_url('customer/location') ?>"><i class="far fa-circle nav-icon"></i> <p>Lokasi</p></a></li>
                        </ul>
                      </li>
                  <?php  } ?>
                  <?php if ($user['role_id'] == 1 || $user['role_id'] == 7) { ?>
                      <li class="nav-item <?= $title == 'Belum Bayar' | $title == 'Bill History' |  $title == 'Sudah Bayar' | $title == 'Konfirmasi Pembayaran' |  $title == 'Tunggakan' | $title == 'Bill Draf' | $title == 'Bill' ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= $title == 'Belum Bayar' | $title == 'Bill History' |  $title == 'Sudah Bayar' | $title == 'Konfirmasi Pembayaran' |  $title == 'Tunggakan' | $title == 'Bill Draf' | $title == 'Bill' ? 'active' : '' ?>">
                          <i style="font-weight: bold; color: <?= $colorsub ?>;" class="fas fa-fw fa-tasks"></i>&nbsp;&nbsp;
                          <p>
                            Kelola Tagihan
                            <i class="right fas fa-angle-left"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a class="nav-link <?= $title == 'Belum Bayar'  ? 'active' : '' ?>" href="<?= site_url('bill/unpaid') ?>"><i class="far fa-circle nav-icon"></i> <p>Belum Bayar</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Sudah Bayar'  ? 'active' : '' ?>" href="<?= site_url('bill/paid') ?>"><i class="far fa-circle nav-icon"></i> <p>Sudah Bayar</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Bill'  ? 'active' : '' ?>" href="<?= site_url('bill') ?>"><i class="far fa-circle nav-icon"></i> <p>Semua</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Bill Draf'  ? 'active' : '' ?>" href="<?= site_url('bill/draf') ?>"><i class="far fa-circle nav-icon"></i> <p>Bulan Ini <sup style="color: red;">Draf</sup></p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Tunggakan'  ? 'active' : '' ?>" href="<?= site_url('bill/debt') ?>"><i class="far fa-circle nav-icon"></i> <p>Tunggakan</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Konfirmasi Pembayaran'  ? 'active' : '' ?>" href="<?= site_url('confirm') ?>"><i class="far fa-circle nav-icon"></i> <p>Konfirmasi</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Bill History'  ? 'active' : '' ?>" href="<?= site_url('bill/history') ?>"><i class="far fa-circle nav-icon"></i> <p>Riwayat</p></a></li>
                        </ul>
                      </li>
                  <?php  } ?>
                  <?php if ($user['role_id'] == 1) { ?>
                      <li class="nav-item <?= $title == 'Income' | $title == 'Expenditure' | $title == 'Transaksi Member' | $title == 'Pengajuan Kasbon' | $title == 'Bonus Refferal' | $title == 'Transfer Saldo' | $title == 'Top Up Saldo' | $title == 'Daftar Kategori'  ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= $title == 'Income' | $title == 'Expenditure' | $title == 'Transaksi Member' | $title == 'Pengajuan Kasbon' | $title == 'Bonus Refferal' | $title == 'Transfer Saldo' | $title == 'Top Up Saldo' | $title == 'Daftar Kategori'  ? 'active' : '' ?>">
                          <i style="font-weight: bold; color: <?= $colorsub ?>;" class="fas fa-fw fa-dollar-sign"></i>&nbsp;&nbsp;
                          <p>
                            Kelola Keuangan
                            <i class="right fas fa-angle-left"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a class="nav-link <?= $title == 'Daftar Kategori'  ? 'active' : '' ?>" href="<?= site_url('keuangan/kategori') ?>"><i class="far fa-circle nav-icon"></i> <p>Daftar Kategori</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Income'  ? 'active' : '' ?>" href="<?= site_url('income') ?>"><i class="far fa-circle nav-icon"></i> <p>Pemasukan</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Expenditure'  ? 'active' : '' ?>" href="<?= site_url('expenditure') ?>"><i class="far fa-circle nav-icon"></i> <p>Pengeluaran</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Bonus Refferal'  ? 'active' : '' ?>" href="<?= site_url('keuangan/bonus') ?>"><i class="far fa-circle nav-icon"></i> <p>Bonus Refferal</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Pengajuan Kasbon'  ? 'active' : '' ?>" href="<?= site_url('keuangan/kasbon') ?>"><i class="far fa-circle nav-icon"></i> <p>Pengajuan Kasbon</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Gaji Karyawan'  ? 'active' : '' ?>" href="<?= site_url('keuangan/gaji') ?>"><i class="far fa-circle nav-icon"></i> <p>Gaji Karyawan</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Transfer Saldo'  ? 'active' : '' ?>" href="<?= site_url('keuangan/transfer') ?>"><i class="far fa-circle nav-icon"></i> <p>Transfer Saldo</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Top Up Saldo'  ? 'active' : '' ?>" href="<?= site_url('keuangan/topup') ?>"><i class="far fa-circle nav-icon"></i> <p>Top Up Saldo</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Saldo Member'  ? 'active' : '' ?>" href="<?= site_url('keuangan/saldo') ?>"><i class="far fa-circle nav-icon"></i> <p>Saldo Member</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Transaksi Member'  ? 'active' : '' ?>" href="<?= site_url('keuangan/transaksi') ?>"><i class="far fa-circle nav-icon"></i> <p>Transaksi Member</p></a></li>
                        </ul>
                      </li>
                      <li class="nav-item <?= $title == 'Product' | $title == 'Slide' | $title == 'Media' ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= $title == 'Product' | $title == 'Slide' | $title == 'Media' ? 'active' : '' ?>">
                          <i style="font-weight: bold; color: <?= $colorsub ?>;" class="fas fa-fw fa-bars"></i>&nbsp;&nbsp;
                          <p>
                            Kelola Postingan
                            <i class="right fas fa-angle-left"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a class="nav-link <?= $title == 'Media'  ? 'active' : '' ?>" href="<?= site_url('media') ?>"><i class="far fa-circle nav-icon"></i> <p>Media</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Product'  ? 'active' : '' ?>" href="<?= site_url('product/data') ?>"><i class="far fa-circle nav-icon"></i> <p>Produk</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Slide'  ? 'active' : '' ?>" href="<?= site_url('slider') ?>"><i class="far fa-circle nav-icon"></i> <p>Slide</p></a></li>
                        </ul>
                      </li>
                      <li class="nav-item <?= $title == 'Profil Perusahaan' | $title == 'About' | $title == 'Catatan Pelanggan' | $title == 'User' | $title == 'Riwayat Login' | $title == 'Bank' | $title == 'Sosial Media' | $title == 'Data Webhook' | $title == 'Payment Tagihan' | $title == 'Payment Saldo' | $title == 'Payment Voucher' | $title == 'Email' | $title == 'Bot Telegram' | $title == 'Syarat & Ketentuan' | $title == 'Kebijakan Privasi' | $title == 'Backup' | $title == 'Lainnya' ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= $title == 'Profil Perusahaan' | $title == 'About' | $title == 'Catatan Pelanggan' | $title == 'User' | $title == 'Riwayat Login' | $title == 'Bank' | $title == 'Sosial Media' | $title == 'Data Webhook' | $title == 'Payment Tagihan' | $title == 'Payment Saldo' | $title == 'Payment Voucher' | $title == 'Email' | $title == 'Bot Telegram' | $title == 'Syarat & Ketentuan' | $title == 'Kebijakan Privasi' | $title == 'Backup' | $title == 'Lainnya' ? 'active' : '' ?>">
                          <i style="font-weight: bold; color: <?= $colorsub ?>;" class="fas fa-fw fa-cog"></i>&nbsp;&nbsp;
                          <p>
                            Kelola Pengaturan
                            <i class="right fas fa-angle-left"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a class="nav-link <?= $title == 'Profil Perusahaan'  ? 'active' : '' ?>" href="<?= site_url('setting') ?>"><i class="far fa-circle nav-icon"></i> <p>Profil Perusahaan</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Catatan Pelanggan'  ? 'active' : '' ?>" href="<?= site_url('setting/catatan') ?>"><i class="far fa-circle nav-icon"></i> <p>Catatan Pelanggan</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Syarat & Ketentuan'  ? 'active' : '' ?>" href="<?= site_url('setting/terms') ?>"><i class="far fa-circle nav-icon"></i> <p>Syarat & Ketentuan</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Kebijakan Privasi'  ? 'active' : '' ?>" href="<?= site_url('setting/policy') ?>"><i class="far fa-circle nav-icon"></i> <p>Kebijakan Privasi</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'About'  ? 'active' : '' ?>" href="<?= site_url('setting/about') ?>"><i class="far fa-circle nav-icon"></i> <p>Tentang Perusahaan</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Bank'  ? 'active' : '' ?>" href="<?= site_url('setting/bank') ?>"><i class="far fa-circle nav-icon"></i> <p>Metode Pembayaran</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Payment Tagihan'  ? 'active' : '' ?>" href="<?= site_url('payment/tagihan') ?>"><i class="far fa-circle nav-icon"></i> <p>Payment Tagihan</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Payment Saldo'  ? 'active' : '' ?>" href="<?= site_url('payment/saldo') ?>"><i class="far fa-circle nav-icon"></i> <p>Payment Saldo</p></a></li>
                            <!-- <li class="nav-item"><a class="nav-link <?= $title == 'Payment Voucher'  ? 'active' : '' ?>" href="<?= site_url('payment/voucher') ?>"><i class="far fa-circle nav-icon"></i> <p>Payment Voucher</p></a></li> -->
                            <li class="nav-item"><a class="nav-link <?= $title == 'Bot Telegram'  ? 'active' : '' ?>" href="<?= site_url('setting/bottelegram') ?>"><i class="far fa-circle nav-icon"></i> <p>Bot Telegram</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Email'  ? 'active' : '' ?>" href="<?= site_url('setting/email') ?>"><i class="far fa-circle nav-icon"></i> <p>Email Perusahaan</p></a></li>
                            <!-- <li class="nav-item"><a class="nav-link <?= $title == 'Sosial Media'  ? 'active' : '' ?>" href="<?= site_url('setting/sosmed') ?>"><i class="far fa-circle nav-icon"></i> <p>Data Akun Sosmed</p></a></li> -->
                            <!-- <li class="nav-item"><a class="nav-link <?= $title == 'Data Webhook'  ? 'active' : '' ?>" href="<?= site_url('setting/webhook') ?>"><i class="far fa-circle nav-icon"></i> <p>Data Webhook</p></a></li> -->
                            <li class="nav-item"><a class="nav-link <?= $title == 'User'  ? 'active' : '' ?>" href="<?= site_url('user') ?>"><i class="far fa-circle nav-icon"></i> <p>Daftar Pengguna</p></a></li>
                            <!-- <li class="nav-item"><a class="nav-link <?= $title == 'Riwayat Login'  ? 'active' : '' ?>" href="<?= site_url('setting/riwayat') ?>"><i class="far fa-circle nav-icon"></i> <p>Riwayat Login</p></a></li> -->
                            <li class="nav-item"><a class="nav-link <?= $title == 'Backup'  ? 'active' : '' ?>" href="<?= site_url('backup') ?>"><i class="far fa-circle nav-icon"></i> <p>Backup Database</p></a></li>
                            <li class="nav-item"><a class="nav-link <?= $title == 'Lainnya'  ? 'active' : '' ?>" href="<?= site_url('setting/other') ?>"><i class="far fa-circle nav-icon"></i> <p>Atur Lainnya</p></a></li>
                        </ul>
                      </li>
                  <?php  } ?>
                  <?php if ($user['role_id'] == 1 || $user['role_id'] == 6) { ?>
                      <li class="nav-item">
                        <a target="_blank" href="<?= site_url('mikhmon') ?>" class="nav-link">
                          <i style="font-weight: bold; color: <?= $colorsub ?>;" class="fa fa-fw fa-globe"></i>&nbsp;&nbsp;
                          <p>
                            Kelola Mikhmon
                          </p>
                        </a>
                      </li>
                       <?php  } ?>
                  <?php if ($user['role_id'] == 1 || $user['role_id'] == 6) { ?>
                      <li class="nav-item">
                        <a target="_blank" href="<?= site_url('mikhmon') ?>" class="nav-link">
                          <i style="font-weight: bold; color: <?= $colorsub ?>;" class="fa fa-fw fa-globe"></i>&nbsp;&nbsp;
                          <p>
                            Kelola Mikhmon
                          </p>
                        </a>
                      </li>
                  <?php  } ?>
                  <?php if ($user['role_id'] == 1) { ?>
                      <li class="nav-item <?= $title == 'Info Aplikasi'  ? 'active' : '' ?>">
                        <a href="<?= site_url('about') ?>" class="nav-link">
                          <i style="font-weight: bold; color: <?= $colorsub ?>;" class="fa fa-fw fa-info-circle"></i>&nbsp;
                          <p>
                            Info Aplikasi
                          </p>
                        </a>
                      </li>
                      <li class="nav-item <?= $title == 'Donasi'  ? 'active' : '' ?>">
                        <a href="<?= site_url('donasi') ?>" class="nav-link">
                          <i style="font-weight: bold; color: <?= $colorsub ?>;" class="fa fa-fw fa-table"></i>&nbsp;&nbsp;
                          <p>
                            Donasi Uang Kopi
                          </p>
                        </a>
                      </li>
                  <?php  } ?>
                </ul>
              </nav>
            </div>
        </aside>

        <div class="content-wrapper" style="padding-left: 10px; padding-right: 10px;">
            <br>
            <script src="https://files.billing.or.id/assets/backend/vendor/jquery/jquery.min.js"></script>
            <section class="content">
                <div class="container-fluid">
                    <?= $contents ?>
                </div>
            </section>
            <br><br><br>
        </div>
        <footer class="main-footer shadow d-xs-none d-sm-none d-md-flex d-lg-flex d-xl-flex fixed-bottom text-center">
            <strong>
                &copy; Copyright <?= date('Y') ?> - All Rights Reserved  &nbsp; || &nbsp;
                <a href="https://facebook.com/<?= $company['facebook']; ?>" target="_blank" style="text-decoration: none; font-weight: bold; color: <?= $colornya ?>;"><?= $company['company_name']; ?></a>
            </strong> &nbsp; || &nbsp;
            <div class="float-right">
                <b>
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
                </b>
            </div>
        </footer>
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
    <script src="https://files.billing.or.id/adminlte320L/plugins/jquery/jquery.min.js"></script>
    <script src="https://files.billing.or.id/adminlte320L/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="https://files.billing.or.id/adminlte320L/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://files.billing.or.id/adminlte320L/plugins/chart.js/Chart.min.js"></script>
    <script src="https://files.billing.or.id/adminlte320L/plugins/sparklines/sparkline.js"></script>
    <script src="https://files.billing.or.id/adminlte320L/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="https://files.billing.or.id/adminlte320L/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <script src="https://files.billing.or.id/adminlte320L/plugins/jquery-knob/jquery.knob.min.js"></script>
    <script src="https://files.billing.or.id/adminlte320L/plugins/moment/moment.min.js"></script>
    <script src="https://files.billing.or.id/adminlte320L/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="https://files.billing.or.id/adminlte320L/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="https://files.billing.or.id/adminlte320L/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="https://files.billing.or.id/adminlte320L/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="https://files.billing.or.id/adminlte320L/dist/js/adminlte.js"></script>
    <script src="https://files.billing.or.id/adminlte320L/dist/js/pages/dashboard.js"></script>
    <script src="https://files.billing.or.id/assets/backend/js/bootstrap-select.js"></script>
    <script src="https://files.billing.or.id/assets/backend/vendor/jquery-easing/jquery.easing.min.js"></script>
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