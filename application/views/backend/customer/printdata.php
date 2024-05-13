<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - <?= $customer['name'] ?></title>
    <link rel="stylesheet" href="<?= site_url('assets/') ?>frontend/libraries/bootstrap/css/bootstrap.css">
</head>

<body onload="window.print()">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font: 12pt "Tahoma";
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .page {
            width: 21cm;
            min-height: 29.7cm;
            padding: 2cm;
            margin: 1cm auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .invoice h3 {
            margin-top: -40px;
            font-weight: bold;
            font-size: 25px;
        }

        .invoice h6 {
            margin-top: -20px;
            font-size: 16px;
        }

        .invoice span {
            margin-top: -55px;
            font-size: 12px;
        }

        .invoice img {
            margin-top: -40px;
            max-height: 60px;
        }

        .invoice-title h3 {
            margin-top: -15px;
            font-size: 40px;
            font-weight: bold;
            color: darkblue;
        }


        .fromto h5 {
            font-weight: bold;
            font-size: 20px;
        }

        .lunas {
            text-align: center;
            font-weight: bold;
            color: green;
            border-width: 2px;
            border-style: dashed solid;
            position: relative;
            margin: 1em 0;
            transform: rotate(-20deg);
            -ms-transform: rotate(-20deg);
            -webkit-transform: rotate(-20deg);
        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {
            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }
    </style>

    <div class="book">
        <div class="page">
            <br>
            <br>
            <br>
            <br>
            <div class="row invoice">
                <div class="col-8">
                    <?php
                    $coverage  = $this->db->get_where('coverage', array('coverage_id' => $customer['coverage']))->row_array();
                    $kabupaten = $this->db->get_where('wilayah_kabupaten', array('id' => $coverage['id_kab']))->row_array();
                    $itemPaket = $this->db->get_where('package_item', array('p_item_id' => $customer['item_paket']))->row_array();
                    ?>
                    <h3><?= $company['company_name'] ?> - <?= substr($kabupaten['nama'], 5, 50) ?></h3>
                    <br>
                    <h6>
                        <b><?= $company['sub_name'] ?></b>
                    </h6>
                    <span>Telepon : <?= $company['phone'] ?> &nbsp; | &nbsp; Alamat Email : <?= $company['email'] ?> &nbsp; | &nbsp; WhatsApp : +<?= $company['whatsapp'] ?></span> <br>
                    <span style="font-style: italic;">Alamat : <?= $company['address'] ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Website : <?php $link = $company['website'];
                                                                                                                                    echo $link; ?></span>
                </div>
                <div class="col-4 text-right">
                    <img src="<?= site_url('assets/images/' . $company['logo']) ?>" alt="logo"><br><br>
                    <?php
                    if ($customer['due_date'] == 0) {
                        $jatuh_tempo = $company['due_date'];
                    } else {
                        $jatuh_tempo = $customer['due_date'];
                    }
                    ?>
                    Jatuh Tempo :<br>
                    Setiap Bulan <b>Tanggal <?= $jatuh_tempo ?></b>
                </div>
            </div>
            <hr>
            <div class="row invoice-title">
                <div class="col text-center">
                    <br>
                    <h3 style="font-size: 30px;"><?= $customer['no_services'] ?> (Status : <?= $customer['c_status'] ?>)</h3>
                </div>
            </div>
            <br />
            <style>
                main {
                    flex: 1 0 auto;
                }
            </style>
            <div class="container">
                <main class="content">
                    <div class="row text-left" style="padding-right: 60px;">
                        <div class="col-6">
                            <div class="row text-left pt-1">
                                <div class="col-4">
                                    Nama Pelanggan
                                </div>
                                <div class="col-1 text-center">
                                    <b>:</b>
                                </div>
                                <div class="col-7">
                                    <?= $customer['name'] ?>
                                </div>
                            </div>
                            <div class="row text-left pt-1">
                                <div class="col-4">
                                    Nomor WhatsApp
                                </div>
                                <div class="col-1 text-center">
                                    <b>:</b>
                                </div>
                                <div class="col-7">
                                    <?= $customer['no_wa'] ?>
                                </div>
                            </div>
                            <div class="row text-left pt-1">
                                <div class="col-4">
                                    Alamat Rumah
                                </div>
                                <div class="col-1 text-center">
                                    <b>:</b>
                                </div>
                                <div class="col-7">
                                    <?= $customer['address'] ?>
                                </div>
                            </div>
                            <div class="row text-left pt-1">
                                <div class="col-4">
                                    Lokasi Pasang
                                </div>
                                <div class="col-1 text-center">
                                    <b>:</b>
                                </div>
                                <div class="col-7">
                                    Rumah <?= $customer['pemilik_rumah'] ?>
                                </div>
                            </div>
                            <div class="row text-left pt-1">
                                <div class="col-4">
                                    Wilayah / ID Area
                                </div>
                                <div class="col-1 text-center">
                                    <b>:</b>
                                </div>
                                <div class="col-7">
                                    <?= $coverage['c_name'] ?> / <?= $coverage['comment'] ?>
                                </div>
                            </div>
                            <div class="row text-left pt-1">
                                <div class="col-4">
                                    Terdaftar Sejak
                                </div>
                                <div class="col-1 text-center">
                                    <b>:</b>
                                </div>
                                <div class="col-7">
                                    <?= $customer['register_date'] ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row text-left pt-1">
                                <div class="col-4">
                                    Nomor NIK / KTP
                                </div>
                                <div class="col-1 text-center">
                                    <b>:</b>
                                </div>
                                <div class="col-7">
                                    <?= $customer['no_ktp'] ?>
                                </div>
                            </div>
                            <div class="row text-left pt-1">
                                <div class="col-4">
                                    Alamat Email
                                </div>
                                <div class="col-1 text-center">
                                    <b>:</b>
                                </div>
                                <div class="col-7">
                                    <?= $customer['email'] ?>
                                </div>
                            </div>
                            <div class="row text-left pt-1">
                                <div class="col-4">
                                    Nama Paket iNet
                                </div>
                                <div class="col-1 text-center">
                                    <b>:</b>
                                </div>
                                <div class="col-7">
                                    <?= $itemPaket['name'] ?>
                                </div>
                            </div>
                            <div class="row text-left pt-1">
                                <div class="col-4">
                                    Keterangan Paket
                                </div>
                                <div class="col-1 text-center">
                                    <b>:</b>
                                </div>
                                <div class="col-7">
                                    <?= $itemPaket['description'] ?>
                                </div>
                            </div>
                            <div class="row text-left pt-1">
                                <div class="col-4">
                                    Metode Bayar
                                </div>
                                <div class="col-1 text-center">
                                    <b>:</b>
                                </div>
                                <div class="col-7">
                                    Aplikasi / Transfer
                                </div>
                            </div>
                            <div class="row text-left pt-1">
                                <div class="col-4">
                                    Tagihan Internet
                                </div>
                                <div class="col-1 text-center">
                                    <b>:</b>
                                </div>
                                <div class="col-7">
                                    Rp. <?= indo_currency($itemPaket['price']) ?>
                                </div>
                            </div>
                            <div class="row text-left pt-1">
                                <div class="col-4">
                                    Terbilang
                                </div>
                                <div class="col-1 text-center">
                                    <b>:</b>
                                </div>
                                <div class="col-7" style="text-transform: capitalize;">
                                    <b><?= to_word($itemPaket['price']) ?> Rupiah</b>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br />
                    <div class="row text-left" style="padding-right: 50px;">
                        <div class="col-12">
                            <b><i>* Persyaratan dan Ketentuan</i></b><br>
                            <?= $company['catatan'] ?>
                        </div>
                    </div>
                    <br />
                    <div class="row text-left" style="padding-right: 50px;">
                        <div class="col-12">
                            <b><i>* Daftar Rekening Pembayaran</i></b><br>
                            <div class="row">
                                <?php
                                $bank = $this->db->get('bank')->result();
                                foreach ($bank as $r => $data) {
                                ?>
                                    <div class="col-3">
                                        <?= $data->name ?>
                                    </div>
                                    <div class="col-3">
                                        <b>:</b> <?= $data->no_rek ?>
                                    </div>
                                    <div class="col-6">
                                        a/n <?= $data->owner ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row text-center" style="padding-right: 50px;">
                        <div class="col-12">
                            <br><b>TENTANG KAMI</b><br>
                            <?= $company['description'] ?>
                        </div>
                    </div>
                    <br />
                    <div class="row text-left">
                        <div class="col-12">
                            <b><input type="checkbox">&nbsp; Menyetujui syarat dan ketentuan yang berlaku dengan sadar dan tanpa adanya paksaan dari pihak manapun</b>
                        </div>
                    </div>
                    <br />
                    <br />
                    <div class="row text-center" style="padding-right: 50px;">
                        <div class="col-4">
                            <br><b>TEKNISI PASANG</b><br>
                            ( ID : &nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp; )<br><br>
                            <img src="<?= site_url('assets/images/') ?><?= $company['logo'] ?>" width="150" alt="Logo" style="opacity: 15%;"><br>
                            <br>____________________
                        </div>
                        <div class="col-4">
                            <img src="<?= site_url('assets/images/qrcode/PLG/') ?>PLG-<?= $customer['no_services'] ?>.png" width="150" alt="Logo" style="opacity: 100%;">
                        </div>
                        <div class="col-4">
                            <br><?= substr($kabupaten['nama'], 5, 50) ?>, <?= date('d') ?> <?= indo_month(date('m')) ?> <?= date('Y') ?><br>
                            <b>PELANGGAN</b><br><br>
                            <img src="<?= site_url('assets/images/') ?><?= $company['logo'] ?>" width="150" alt="Logo" style="opacity: 15%;"><br>
                            <br>____________________
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
    <!-- end page -->
    <script src="<?= site_url('assets/') ?>frontend/libraries/jquery/jquery-3.4.1.min.js"></script>
    <script src="<?= site_url('assets/') ?>frontend/libraries/bootstrap/js/bootstrap.js"></script>
</body>

</html>