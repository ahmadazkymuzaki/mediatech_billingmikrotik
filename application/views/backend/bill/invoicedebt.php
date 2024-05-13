<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> a/n <?= $bill['name'] ?> Tanggal Cetak <?= date('d') ?> <?= indo_month(date('m')) ?> <?= date('Y') ?></title>
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
            <div class="row fromto">
                <div class="col-6">
                    Kepada :
                    <h5><?= $customer['name'] ?></h5>
                    <h6><?= $customer['no_wa'] ?></h6>
                    <h6><?= $customer['address'] ?></h6>
                </div>
                <div class="col-4 text-right">
                    <h6 style="font-weight:bold">ID Pelanggan : </h6>
                    <h6 style="font-weight:bold">Periode : </h6>
                    <h6 style="font-weight:bold">Tanggal Cetak : </h6>

                </div>
                <div class="col-2 text-left" style="margin-left:-15 ;">
                    <h6><?= $customer['no_services'] ?></h6>
                    <h6><?= $bill ?> Bulan</h6>
                    <h6><?= date('d-m-Y') ?></h6>

                </div>
            </div>
            <br>
            <div class="row justify-content-center mb-2">
                <h5>Rekap Tagihan Tunggakan</h5>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th style="text-align: center; width:10px">No</th>
                        <th style="text-align: left">Periode Tagihan</th>
                        <th style="text-align: right">Tagihan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no_services = $customer['no_services'] ?>
                    <?php $query = "SELECT *
                                    FROM `invoice`
                                        WHERE `invoice`.`no_services` = $no_services and `invoice`.`status` = 'Belum Bayar'";
                    $querying = $this->db->query($query)->result();
                    ?>

                    <?php $query = "SELECT *
                                    FROM `invoice_detail`
                                    JOIN `invoice` 
                                                                ON `invoice_detail`.`d_no_services` = `invoice`.`no_services` and `invoice_detail`.`d_month` = `invoice`.`month`  and `invoice_detail`.`d_year` = `invoice`.`year`
                                        WHERE `invoice_detail`.`d_no_services` = $no_services  and `invoice`.`status` = 'Belum Bayar' ORDER BY month, year ASC ";
                    $queryii = $this->db->query($query)->result();
                    ?>
                    <?php $totalbill = 0;
                    foreach ($queryii as  $dataa)
                        $totalbill += (int) $dataa->total;
                    ?>
                    <?php $totalppn = 0;
                    foreach ($queryii as  $dataa)
                        $totalppn += (int) $dataa->i_ppn;
                    ?>
                    <?php $totalcu = 0;
                    foreach ($querying as  $dataa)
                        $totalcu += (int) $dataa->code_unique;
                    ?>
                    <?php $totalpersen = 0;
                    foreach ($querying as  $dataa)
                        $totalpersen += (int) $dataa->i_ppn;
                    ?>
                    <?php $no = 1;
                    foreach ($querying as  $dataa) :
                    ?>
                        <tr>
                            <td style="text-align: center;"><?= $no++ ?></td>
                            <td><?= indo_month($dataa->month) ?> <?= $dataa->year ?> </td>
                            <?php $query = "SELECT *
                                    FROM `invoice`
                                    JOIN `invoice_detail` 
                                                                ON `invoice_detail`.`invoice_id` = `invoice`.`invoice`
                                        WHERE `invoice`.`no_services` = $no_services and `invoice_detail`.`invoice_id` = $dataa->invoice and `invoice`.`status` = 'Belum Bayar' ORDER BY month, year ASC ";
                            $queryTot = $this->db->query($query)->result(); ?>
                            <?php $subtotal = 0;
                            foreach ($queryTot as  $data)
                                $subtotal += (int) $data->total;
                            ?>
                            <?php $query = "SELECT *
                                    FROM `invoice_detail`
                                    JOIN `invoice` 
                                                                ON `invoice_detail`.`d_no_services` = `invoice`.`no_services`  and `invoice_detail`.`d_month` = `invoice`.`month`  and `invoice_detail`.`d_year` = `invoice`.`year`
                                        WHERE `invoice_detail`.`d_no_services` = $no_services and
                                       `invoice_detail`.`d_year` and
                                       `invoice_detail`.`invoice_id` =  '' and
                                       `invoice_detail`.`d_month` =  $dataa->month and `invoice`.`status` = 'Belum Bayar' ORDER BY month, year ASC ";
                            $queryTotDet = $this->db->query($query)->result(); ?>
                            <?php $subtotalDet = 0;
                            foreach ($queryTotDet as  $dataa)
                                $subtotalDet += (int) $dataa->total;
                            ?>
                            <td style="text-align: right">
                                <?php if ($subtotal == 0) { ?>
                                    <?php $ppn = $subtotalDet * ($dataa->i_ppn / 100) ?>
                                    <?php if ($other['code_unique'] == 1) { ?>
                                        Rp. <?= indo_currency($subtotalDet + $dataa->code_unique + $ppn) ?>
                                        <?php $nominalnya = $subtotalDet + $dataa->code_unique + $ppn; ?>
                                    <?php } ?>
                                    <?php if ($other['code_unique'] != 1) { ?>
                                        Rp. <?= indo_currency($subtotalDet  + $ppn) ?>
                                        <?php $nominalnya = $subtotalDet  + $ppn; ?>
                                    <?php } ?>
                                <?php } ?>
                                <?php if ($subtotal != 0) { ?>
                                    <?php $ppn = $subtotal * ($data->i_ppn / 100) ?>
                                    <?php if ($other['code_unique'] == 1) { ?>
                                        Rp. <?= indo_currency($subtotal + $data->code_unique + $ppn) ?>
                                        <?php $nominalnya = $subtotal + $data->code_unique + $ppn; ?>
                                    <?php } ?>
                                    <?php if ($other['code_unique'] != 1) { ?>
                                        Rp. <?= indo_currency($subtotal  + $ppn) ?>
                                        <?php $nominalnya = $subtotal  + $ppn; ?>
                                    <?php } ?>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr style="text-align: right">
                        <th colspan="2">Total Tagihan</th>
                        <?php
                        $query = "SELECT  `invoice`.`status`, 
        `invoice`.`no_services`,
        `invoice`.`month`,
        `invoice`.`year`,
        `invoice_detail`.`d_no_services`,
        `invoice_detail`.`d_month`,
        `invoice_detail`.`d_year`,
        `invoice_detail`.`invoice_id`,
        `invoice_detail`.`total`
                                FROM `invoice` 
                                JOIN `invoice_detail` ON `invoice`.`no_services`=`invoice_detail`.`d_no_services`
                                and `invoice`.`month`=`invoice_detail`.`d_month`
                                and `invoice`.`year`=`invoice_detail`.`d_year`
                                    WHERE `invoice`.`status` =  'BELUM BAYAR' and `invoice_detail`.`d_no_services` = $no_services and `invoice_detail`.`invoice_id` = 0 ";
                        $TotalpendingPayment = $this->db->query($query)->result();
                        // var_dump($TotalpendingPayment)
                        ?>
    
                        <?php $Totalpending = 0;
                        foreach ($TotalpendingPayment as $c => $data) {
                            $Totalpending += $data->total;
                        } ?>
                        <?php
                        $query = "SELECT *
                                FROM `invoice_detail` 
                                JOIN `invoice` ON `invoice`.`invoice`=`invoice_detail`.`invoice_id`
                                    WHERE `invoice`.`status` =  'BELUM BAYAR' and `invoice`.`no_services` = $no_services ";
                        $TotalpendingPaymentt = $this->db->query($query)->result();
                        ?>
    
                        <?php $Totalpendingg = 0;
                        foreach ($TotalpendingPaymentt as $c => $data) {
                            $Totalpendingg += $data->total;
                        } ?>
                        <?php $rumuspersen = ($totalpersen / $bill / 100) ?>
                        <?php $totalppn = ($Totalpendingg + $Totalpending) * $rumuspersen  ?>
                        <?php if ($other['code_unique'] == 1) { ?>
                            <th style="font-weight: bold;">Rp. <?= indo_currency($Totalpendingg + $Totalpending + $totalcu + $totalppn) ?></th>
                        <?php } ?>
                        <?php if ($other['code_unique'] != 1) { ?>
                            <th style="font-weight: bold;">Rp. <?= indo_currency($Totalpendingg + $Totalpending + $totalppn) ?></th>
                        <?php } ?>
                    </tr>
                </tfoot>
            </table>
            <?php if ($other['code_unique'] == 1) { ?>
                <b><span style="font-style: italic; ">* Terbilang : <?= to_word($Totalpendingg + $Totalpending + $totalcu + $totalppn) ?> rupiah</span></b>
            <?php } ?>
            <?php if ($other['code_unique'] != 1) { ?>
                <b><span style="font-style: italic; ">* Terbilang : <?= to_word($Totalpendingg + $Totalpending + $totalppn) ?> rupiah</span></b>
            <?php } ?>
            <br><br><b> Cara Pembayaran Bisa Dengan Metode Transfer :</b> <br>
            <table style="width: 100%;">
                <tbody>
                    <?php foreach ($bank as $r => $data) { ?>
                        <tr>
                            <td style="text-align: left; width: 22%;"><?= $data->name ?></td>
                            <td style="text-align: left; width: 16%;"><?= $data->no_rek ?></td>
                            <td style="text-align: left; width: 30%;">a/n &nbsp; <?= $data->owner ?></td>
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
            <style>
                .container {
                    display: flex;
                    flex-direction: column;
                    height: 20vh;
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
                </footer>
            </div>
        </div>
    </div>
    <!-- end page -->
    <script src="https://files.billing.or.id/assets/frontend/libraries/jquery/jquery-3.4.1.min.js"></script>
    <script src="https://files.billing.or.id/assets/frontend/libraries/bootstrap/js/bootstrap.js"></script>
</body>

</html>