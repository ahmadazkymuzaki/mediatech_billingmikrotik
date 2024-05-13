<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - Cetak <?= date('d M Y') ?></title>
    <link rel="stylesheet" href="https://files.billing.or.id/assets/frontend/libraries/bootstrap/css/bootstrap.css">
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
    <?php
    foreach ($bill as $r => $data) { ?>
        <div class="book">
            <div class="page">
                <div class="row invoice">
                    <div class="col-8">
                        <h3><?= $company['company_name'] ?></h3>
                        <br>
                        <h6>
                            <?= $company['sub_name'] ?>
                        </h6>
                        <span>No HP : <?= $company['whatsapp'] ?> email : <?= $company['email'] ?></span> <br>
                        <span style="font-style: italic;">Alamat : <?= $company['address'] ?></span>
                    </div>
                    <div class="col-4 text-right">
                        <img src="<?= site_url('assets/images/' . $company['logo']) ?>" alt="logo">

                    </div>
                </div>
                <hr>
                <div class="row invoice-title">
                    <div class="col text-right">
                        <h3>INVOICE</h3>
                    </div>
                </div>
                <!-- JATUH TEMPO -->
                <?php if ($data->due_date != 0) { ?>
                    <?php $due_date = $data->due_date ?>
                <?php } ?>
                <?php if ($data->due_date == 0) { ?>
                    <?php $due_date = $company['due_date'] ?>
                <?php } ?>
                <div class="row fromto">
                    <div class="col-6">
                        Kepada :
                        <h5><?= $data->customer_name ?></h5>
                        <h6><?= $data->no_wa ?></h6>
                        <h6><?= $data->address ?></h6>
                    </div>
                    <div class="col-4 text-right">
                        <h6 style="font-weight:bold">ID Pelanggan : </h6>
                        <h6 style="font-weight:bold">No Invoice : </h6>
                        <h6 style="font-weight:bold">Tanggal Invoice :</h6>
                        <h6 style="font-weight:bold">Jatuh Tempo :</h6>
                    </div>
                    <div class="col-2 text-left" style="margin-left:-15 ;">
                        <h6><?= $data->no_services ?></h6>
                        <h6><?= $data->invoice ?></h6>
                        <h6><?= date('d-m-Y', $data->created_invoice) ?></h6>
                        <h6><?= $due_date ?>-<?= $data->month ?>-<?= $data->year ?></h6>
                    </div>
                </div>
                <br>
                <div class="row justify-content-between mb-2">
                    <div class="col-6">Periode <?= indo_month($data->month) ?> <?= $data->year ?></div>
                    <div class="col-6 text-right">
                        <?php if ($data->status == 'BELUM BAYAR') { ?>
                            <h5 style="color: red;font-size:small; text-align: right; font-weight:bold;"><?= $data->status ?></h5>
                        <?php }else{ ?>
                            <h5 style="color: green;font-size:small; text-align: right; font-weight:bold;"><?= $data->status ?></h5>
                        <?php } ?>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th style="text-align: center; width:10px">No</th>
                            <th>Item</th>
                            <th style="text-align: center">Qty</th>
                            <th style="text-align: right">Harga</th>
                            <th style="text-align: center">Disc</th>

                            <th style="text-align: right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $month =  $data->month;
                        $year = $data->year;
                        $no_services = $data->no_services;
                        $query = "SELECT *, `invoice_detail`.`price` as `detail_price`
                            FROM `invoice_detail`
                            Join `package_item` ON `package_item`.`p_item_id` = `invoice_detail`.`item_id`
                                WHERE `invoice_detail`.`d_month` =  $month and
                               `invoice_detail`.`d_year` =  $year and
                               `invoice_detail`.`d_no_services` =  $no_services";
                        $queryTot = $this->db->query($query)->result(); ?>
                        <?php $subTotaldetail = 0;
                        foreach ($queryTot as  $dataa)
                            $subTotaldetail += (int) $dataa->total;
                        ?>
                        <tr>
                            <?php
                            $query = "SELECT *, `invoice_detail`.`price` as `detail_price`
                                    FROM `invoice_detail`  JOIN `package_item` 
                                                                ON `invoice_detail`.`item_id` = `package_item`.`p_item_id`
                                        WHERE `invoice_detail`.`invoice_id` = $data->invoice  ";
                            $querying = $this->db->query($query)->result(); ?>
                            <?php $subtotal = 0;
                            foreach ($querying as  $dataa)
                                $subtotal += (int) $dataa->total;
                            ?>
                            <?php $no = 1;
                            foreach ($querying as  $dataa) {
                            ?>
                        <tr>
                            <td style="text-align: center;"><?= $no++ ?></td>
                            <td><?= $dataa->name ?> <br> <span style="font-size:12px"><?= $dataa->description ?></td>
                            <td style="text-align: center;"><?= $dataa->qty ?></td>
                            <td style="text-align: right;"><?= indo_currency($dataa->detail_price) ?></td>
                            <td style="text-align: right;"> <?php if ($dataa->disc <= 0) { ?>
                                    -
                                <?php } ?>
                                <?php if ($dataa->disc > 0) { ?>
                                    <?= indo_currency($dataa->disc)  ?>
                                <?php } ?></td>

                            <td style="text-align: right;"><?= indo_currency($dataa->total) ?></td>
                        </tr>
                    <?php } ?>
                    </tr>
                    <!-- <tr>
                            <td>Tagihan Paket Internet Periode <?= indo_month($data->month) ?> <?= $data->year ?></td>
                            <td style="text-align: right;"><?php $no_invoice = $data->invoice ?> <?php $query = "SELECT *
                                    FROM `invoice_detail`
                                        WHERE `invoice_detail`.`invoice_id` =  $no_invoice ";
                                                                                                    $querying = $this->db->query($query)->result(); ?>
                                <?php $subtotal = 0;
                                foreach ($querying as  $dataa)
                                    $subtotal += (int) $dataa->total;
                                ?>
                                <?= indo_currency($subtotal) ?></td>
                        </tr> -->
                    <?php if ($subtotal <= 0) { ?>
                        <?php $no = 1;
                        foreach ($queryTot as  $dataa) { ?>
                            <tr>
                                <td style="text-align: center;"><?= $no++ ?>.</td>
                                <td><?= $dataa->name ?> </td>
                                <td style="text-align: center"><?= $dataa->qty ?></td>
                                <td style="text-align: right"><?= indo_currency($dataa->detail_price) ?></td>
                                <td style="text-align: right">
                                    <?php if ($dataa->disc <= 0) { ?>
                                        -
                                    <?php } ?>
                                    <?php if ($dataa->disc > 0) { ?>
                                        <?= indo_currency($dataa->disc)  ?>
                                    <?php } ?>
                                </td>
                                <td style="text-align: right"><?= indo_currency($dataa->total) ?></td>

                            </tr>
                        <?php
                        }
                        ?>
                    <?php } ?>
                    </tbody>
                    <tfoot>
                        <!-- KODE UNIK -->
                        <?php if ($other['code_unique'] == 1) { ?>
                            <?php $code_unique = $data->code_unique ?>
                        <?php } ?>
                        <?php if ($other['code_unique'] == 0) { ?>
                            <?php $code_unique = 0 ?>
                        <?php } ?>
                        <!-- END KODE UNIK -->

                        <?php if ($subtotal > 0) { ?>
                            <?php $ppn = $subtotal * ($data->i_ppn / 100) ?>
                        <?php } ?>
                        <?php if ($subtotal <= 0) { ?>
                            <?php $ppn = $subTotaldetail * ($data->i_ppn / 100) ?>

                        <?php } ?>
                        <?php if ($data->i_ppn > 0) { ?>
                            <tr class="text-right" style="font-size: small;">
                                <th colspan="5">PPN (<?= $data->i_ppn ?>%)</th>
                                <th><?= indo_currency($ppn) ?></th>
                            </tr>
                        <?php } ?>
                        <?php if ($other['code_unique'] == 1) { ?>
                            <tr class="text-right" style="font-size: small;">
                                <th colspan="5">Kode Unik</th>
                                <th><?= $code_unique ?></th>
                            </tr>
                        <?php } ?>
                        <tr style="text-align: right">
                            <th colspan="5">Total Tagihan</th>
                            <?php if ($subtotal > 0) { ?>
                                <th><?= indo_currency($subtotal + $code_unique + $ppn)  ?></th>
                            <?php } ?>
                            <?php if ($subtotal <= 0) { ?>
                                <th><?= indo_currency($subTotaldetail + $code_unique + $ppn)  ?></th>
                            <?php } ?>

                        </tr>
                    </tfoot>
                </table>
                <?php if ($subtotal > 0) { ?>
                    <span style="font-style: italic; ">* Terbilang : <?= to_word($subtotal + $code_unique + $ppn) ?> rupiah</span>
                    <?php if ($other['code_unique'] == 1) { ?>
                        <br><br>
                        <h6 style="font-weight: bold; color:red"> Catatan :</h6>
                        Transfer tepat <b><?= indo_currency($subtotal + $code_unique + $ppn) ?></b> (Tagihan + Kode Unik) <?= $other['text_code_unique']; ?>
                    <?php } ?>
                <?php } ?>
                <?php if ($subtotal <= 0) { ?>
                    <span style="font-style: italic; ">* Terbilang : <?= to_word($subTotaldetail + $code_unique + $ppn) ?> rupiah</span>
                    <?php if ($other['code_unique'] == 1) { ?>
                        <br><br>
                        <h6 style="font-weight: bold; color:red"> Catatan :</h6>
                        Transfer tepat <b><?= indo_currency($subTotaldetail + $code_unique + $ppn) ?></b> (Tagihan + Kode Unik) <?= $other['text_code_unique']; ?>
                    <?php } ?>
                <?php } ?>
                <br><br><b> Cara Pembayaran Bisa Dengan Metode Transfer :</b> <br>
                <table style="width: 100%;">
                    <tbody>
                        <?php foreach ($bank as $r => $dataku) { ?>
                            <tr>
                                <td style="text-align: left; width: 22%;"><?= $dataku->name ?></td>
                                <td style="text-align: left; width: 16%;"><?= $dataku->no_rek ?></td>
                                <td style="text-align: left; width: 30%;">a/n &nbsp; <?= $dataku->owner ?></td>
                                <td style="text-align: left; width: 20%;">( Kirim Bukti Transfer )</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <br>
                <b>Konfirmasi Pembayaran Melalui Kontak Kami :</b> <br>
                <table style="width: 100%;">
                    <tbody>
                        <tr>
                            <td style="text-align: left; width: 12%;">Alamat Email</td>
                            <td style="text-align: left;">: &nbsp;<?= $company['email'] ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: left; width: 12%;">WhatsApp</td>
                            <td style="text-align: left;">: &nbsp;<?= $company['whatsapp'] ?></td>
                        </tr>
                    </tbody>
                </table>
                <br><br>
                <div class="row text-center">
                    <div class="col-6">
                        <img height="200" src="<?= site_url('assets/images/qrcode/') ?>qr-<?= $data->invoice ?>.png" alt="qrcode">
                    </div>
                    <?php if($data->status == 'SUDAH BAYAR') { ?>
                        <div class="col-6">
                            <br>
                            <h1>Status Tagihan :</h1>
                            <br>
                            <h1 style="color: green; font-weight: bold;"><?= $data->status ?></h1>
                        </div>
                    <?php }else{ ?>
                        <div class="col-6">
                            <br>
                            <h1>Status Tagihan :</h1>
                            <br>
                            <h1 style="color: red; font-weight: bold;"><?= $data->status ?></h1>
                        </div>
                    <?php } ?>
                </div>
                <style>
                    .container {
                        display: flex;
                        flex-direction: column;
                        height: 10vh;
                    }

                    footer {

                        flex-shrink: 0;
                    }

                    main {
                        flex: 1 0 auto;
                    }
                </style>
                <div class="container">
                    <main class="content">
                    </main>
                    <footer>
                        <div class="row">
                            <div class="col-5 text-right border-right border-primary">
                                <h3 style="margin-top: 5px;">Terimakasih</h3>
                            </div>
                            <div class="col-7 text-left">
                                <h6 style="color: red;">Syarat dan Ketentuan</h6>
                                <span>Mohon lakukan pembayaran tepat waktu</span>
                            </div>
                        </div>
                        <?php if ($data->create_by != 0) { ?>
                            <?php
                            $user_id = $data->create_by;
                            $query = "SELECT *
                            FROM `user` WHERE `user`.`id` =  $user_id";
                            $kolektor = $this->db->query($query)->row_array(); ?>
                            <div class="row mt-2">
                                <div class="col"> Diterima Oleh : <?= $kolektor['name'] ?> </div>
                                <div class="col">Pada Tanggal <?= date('d M Y', $data->date_payment) ?></div>
                            </div>
                        <?php } ?>
                    </footer>
                </div>
            </div>
        </div>
    <?php } ?>

    <!-- end page -->
    <script src="https://files.billing.or.id/assets/frontend/libraries/jquery/jquery-3.4.1.min.js"></script>
    <script src="https://files.billing.or.id/assets/frontend/libraries/bootstrap/js/bootstrap.js"></script>
</body>

</html>