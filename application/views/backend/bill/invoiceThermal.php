<html>

<head>
    <title><?= $title ?> - <?= $bill['invoice'] ?> a/n <?= $bill['name'] ?> Periode <?= indo_month($bill['month']) ?> <?= $bill['year'] ?></title>
    <link rel="stylesheet" href="https://files.billing.or.id/assets/frontend/libraries/bootstrap/css/bootstrap.css">
</head>

<body onload="window.print()">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font-family: "Arial Narrow";
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .page {
            width: 80mm;
            font-size: 15px;
            padding: 5px;
            margin: 0.3cm auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: white;
        }

        @page {
            margin: 0;
        }

        @media print {
            .page {
                margin-top: 5px;
                margin-left: 2px;
                border: initial;

            }
        }


        .title {
            text-align: center;
            padding-bottom: 5px;
            border-bottom: 0.5px dashed;
        }

        .title img {
            margin-top: 10px;
            max-height: 35px;
        }

        .header {
            margin-left: 10px;
            margin-top: 5px;
            padding-bottom: 10px;
        }

        .left-content {
            margin-left: -30px;
        }

        .thanks {
            /* margin-top: 5px; */
            padding-top: 5px;
            text-align: center;
            border-top: 1px dashed;
        }

        table {
            /* width: 58mm; */
            margin-left: 5px;
            font-size: 16px;
        }
    </style>
    <div class="page">
        <div class="title">
            <img src="<?= site_url('assets/images/' . $company['logo']) ?>" alt="logo">
            <br>
            <font style="font-size: 7px;">&nbsp;</font><br>
            <?= $company['address'] ?><br>
            Telepon : <?= $company['phone'] ?>
        </div>
        <div class="header">
            <div class="row container" style="padding-top: 5px; padding-bottom: 5px;">
                <center>
                    Struk Pembayaran Tagihan Internet<br>
                    <?= $company['company_name'] ?>
                </center>
            </div>
            <div class="row">
                <div class="col-5">No. Invoice</div>
                <div class="col-7 left-content">: <?= $bill['invoice'] ?></div>
            </div>
            <div class="row">
                <div class="col-5">No. Layanan</div>
                <div class="col-7 left-content">: <?= $bill['no_services'] ?></div>
            </div>
            <div class="row">
                <div class="col-5">Atas Nama</div>
                <div class="col-7 left-content">: <?= $bill['name'] ?> </div>
            </div>
            <div class="row">
                <div class="col-5">Periode</div>
                <div class="col-7 left-content">: <?= indo_month($bill['month']) ?> <?= $bill['year'] ?></div>
            </div>
            <?php if ($bill['status'] == 'BELUM BAYAR') {   ?>
                <!-- JATUH TEMPO -->
                <?php if ($bill['due_date'] != 0) { ?>
                    <?php $due_date = $bill['due_date'] ?>
                <?php } ?>
                <?php if ($bill['due_date'] == 0) { ?>
                    <?php $due_date = $company['due_date'] ?>
                <?php } ?>
                <div class="row">
                    <div class="col-5">Jatuh Tempo</div>
                    <div class="col-7 left-content">: <?= $due_date ?> <?= indo_month($bill['month']) ?> <?= $bill['year'] ?></div>
                </div>
                <div class="row">
                    <div class="col-5">Status</div>
                    <div class="col-7 left-content" style="color: red;">: Belum Bayar</div>
                </div>
                <div class="row">
                    <div class="col-5">Tanggal Cetak</div>
                    <div class="col-7 left-content">: <?= date('d/m/y H:i') ?> WIB</div>
                </div>
            <?php } ?>
            <?php if ($bill['status'] == 'SUDAH BAYAR') {   ?>
                <div class="row">
                    <div class="col-5">Status</div>
                    <div class="col-7 left-content" style="color: green;">: Sudah Bayar</div>
                </div>
                <div class="row">
                    <div class="col-5">Tanggal Cetak</div>
                    <div class="col-7 left-content">: <?= date('d/m/y H:i') ?> WIB</div>
                </div>
                <?php if ($bill['create_by'] != 0) { ?>
                    <?php
                    $user_id =  $bill['create_by'];
                    $query = "SELECT *
                            FROM `user` WHERE `user`.`id` =  $user_id";
                    $kolektor = $this->db->query($query)->row_array(); ?>
                    <div class="row">
                        <div class="col-5">Diterima Oleh</div>
                        <div class="col-7 left-content">: <?= $kolektor['name'] ?></div>
                    </div>

                <?php } ?>
            <?php } ?>
        </div>
        <table class="table" width="100%" style="margin-left: -2px;">
            <thead>
                <tr>
                    <th style="text-align: center">Layanan</th>
                    <th style="text-align: center">Qty</th>
                    <th style="text-align: center">Harga</th>
                    <th style="text-align: center">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $month =  $bill['month'];
                $year = $bill['year'];
                $no_services = $bill['no_services'];
                $query = "SELECT *, `invoice_detail`.`price` as `price_detail`
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
                <?php
                $invoice =  $bill['invoice'];
                $query = "SELECT *, `invoice_detail`.`price` as `price_detail`
                                    FROM `invoice_detail`  JOIN `package_item` 
                                                                ON `invoice_detail`.`item_id` = `package_item`.`p_item_id`
                                        WHERE `invoice_detail`.`invoice_id` = $invoice  ";
                $querying = $this->db->query($query)->result(); ?>
                <?php $subtotal = 0;
                foreach ($querying as  $dataa)
                    $subtotal += (int) $dataa->total;
                ?>
                <?php $no = 1;
                foreach ($querying as $c => $dataa) { ?>
                    <tr>
                        <td><?= $dataa->name ?></td>
                        <td style="text-align: center"><?= $dataa->qty ?></td>
                        <td style="text-align: right"><?= indo_currency($dataa->price_detail) ?></td>
                        <td style="text-align: right"><?= indo_currency($dataa->total) ?></td>
                    </tr>
                <?php } ?>
                <?php if ($subtotal <= 0) { ?>
                    <?php
                    foreach ($queryTot as  $dataaa) { ?>
                        <tr>
                            <td><?= $dataaa->name ?> </td>
                            <td style="text-align: center"><?= $dataaa->qty ?></td>
                            <td style="text-align: right"><?= indo_currency($dataaa->price_detail) ?></td>
                            <td style="text-align: right"><?= indo_currency($dataaa->total) ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                <?php } ?>
            </tbody>
            <tfoot>
                <!-- KODE UNIK -->
                <?php if ($other['code_unique'] == 1) { ?>
                    <?php $code_unique = $bill['code_unique'] ?>
                <?php } ?>
                <?php if ($other['code_unique'] == 0) { ?>
                    <?php $code_unique = 0 ?>
                <?php } ?>
                <!-- END KODE UNIK -->

                <?php if ($subtotal > 0) { ?>
                    <?php $ppn = $subtotal * ($bill['i_ppn'] / 100) ?>
                <?php } ?>
                <?php if ($subtotal <= 0) { ?>
                    <?php $ppn = $subTotaldetail * ($bill['i_ppn'] / 100) ?>

                <?php } ?>
                <?php if ($bill['i_ppn'] > 0) { ?>
                    <tr class="text-right" style="font-size: small;">
                        <td colspan="3" style="font-size: 12px;"><b>PPN (<?= $bill['i_ppn'] ?>%)<b></td>
                        <td style="font-size: 12px;"><?= indo_currency($ppn) ?></td>
                    </tr>
                <?php } ?>
                <?php if ($other['code_unique'] == 1) { ?>
                    <tr class="text-right" style="font-size: small;">
                        <td colspan="3" style="font-size: 12px;"><b>Kode Unik (sedekah)</b></td>
                        <td style="font-size: 12px;"><?= $code_unique ?></td>
                    </tr>
                <?php } ?>
                <tr style="text-align: right">
                    <th colspan="3">Total Tagihan</th>
                    <th>

                        <?php if ($subtotal > 0) { ?>
                            <?= indo_currency($subtotal + $code_unique + $ppn)  ?>
                        <?php } ?>
                        <?php if ($subtotal == 0) { ?>
                            <?= indo_currency($subTotaldetail + $code_unique + $ppn)  ?>
                        <?php } ?>

                    </th>

                </tr>
                <tr>
                    <td colspan="4" style="font-size: 16px; line-height: 10px;">
                        <center><b>Terbilang :</b></center><br><i>
                            <?php if ($subtotal > 0) { ?>
                                <?= number_to_words($subtotal + $code_unique + $ppn) ?>
                            <?php } ?>
                            <?php if ($subtotal == 0) { ?>
                                <?= number_to_words($subTotaldetail + $code_unique + $ppn) ?>
                            <?php } ?>
                            Rupiah</i>
                    </td>
                </tr>
                <?php if ($bill['status'] == 'SUDAH BAYAR') {   ?>
                    <tr>
                        <td colspan="4" style="font-size: 16px; text-align: center;">
                            Tanda Terima ini adalah sah dan harap disimpan sebagai bukti pembayaran Tagihan
                        </td>
                    </tr>
                <?php } ?>
            </tfoot>

        </table>

        <div class="thanks" style="margin-top: -15px;">
            ~~~ Terima Kasih ~~~
            <br>
            <?php $link = "www.$_SERVER[HTTP_HOST]"; ?>
            <?= $link ?>
        </div>
    </div>

    <script src="https://files.billing.or.id/assets/frontend/libraries/jquery/jquery-3.4.1.min.js"></script>
    <script src="https://files.billing.or.id/assets/frontend/libraries/bootstrap/js/bootstrap.js"></script>
</body>

</html>