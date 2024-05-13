<body onload="window.print()">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font-family: "Verdana, Arial";
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .page {
            width: 80mm;
            font-size: 12px;
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
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid;
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
            /* width: 55mm; */
            margin-left: 5px;
            font-size: 12px;
        }
    </style>
    <title><?= $title ?> - Cetak <?= date('d M Y') ?></title>
    <link rel="stylesheet" href="https://files.billing.or.id/assets/frontend/libraries/bootstrap/css/bootstrap.css">
    <?php
    foreach ($bill as $r => $data) { ?>
        <div class="page">
            <div class="title">
                <img src="<?= site_url('assets/images/' . $company['logo']) ?>" alt="logo">
                <br>
                <font style="font-size: 7px;">&nbsp;</font><br>
                <?= $company['address'] ?>
            </div>
            <div class="header">
                <?php if ($data->status == 'SUDAH BAYAR') {   ?>
                    <div class="row container">
                        <p>Struk Pembayaran Tagihan Internet<br><?= $company['company_name'] ?></p>
                    </div>
                <?php } ?>
                <div class="row">
                    <div class="col-6">No Invoice</div>
                    <div class="col-6 left-content">: <?= $data->invoice ?></div>
                </div>
                <div class="row">
                    <div class="col-6">No Layanaffn</div>
                    <div class="col-6 left-content">: <?= $data->no_services ?></div>
                </div>
                <div class="row">
                    <div class="col-6">Nama</div>
                    <div class="col-6 left-content">: <?= $data->name ?> </div>
                </div>
                <div class="row">
                    <div class="col-6">Periode</div>
                    <div class="col-6 left-content">: <?= indo_month($data->month) ?> <?= $data->year ?></div>
                </div>
                <?php if ($data->status == 'BELUM BAYAR') {   ?>
                    <div class="row">
                        <div class="col-6">Jatuh Tempo</div>
                        <div class="col-6 left-content">: <?= $company['due_date'] ?> <?= indo_month($data->month) ?> <?= $data->year ?></div>
                    </div>
                    <div class="row">
                        <div class="col-6">Status</div>
                        <div class="col-6 left-content" style="color: red;">: Belum Bayar</div>
                    </div>
                <?php } ?>
                <?php if ($data->status == 'SUDAH BAYAR') {   ?>
                    <div class="row">
                        <div class="col-6">Status</div>
                        <div class="col-6 left-content" style="color: green;">: Lunas</div>
                    </div>
                    <div class="row">
                        <div class="col-6">Tanggal Bayar</div>
                        <div class="col-6 left-content">: <?= date('d M Y h:m:s', $data->date_payment) ?></div>
                    </div>
                    <div class="row">
                        <div class="col-6">Tanggal Cetak</div>
                        <div class="col-6 left-content">: <?= date('d M Y h:m:s') ?></div>
                    </div>
                <?php } ?>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th style="text-align: center">Qty</th>
                        <th style="text-align: right">Harga</th>
                        <th style="text-align: right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $month =  $data->month;
                    $year = $data->year;
                    $no_services = $data->no_services;
                    $query = "SELECT *
                            FROM `invoice_detail`
                            Join `package_item` ON `package_item`.`p_item_id` = `invoice_detail`.`item_id`
                                WHERE `invoice_detail`.`d_month` =  $month and
                               `invoice_detail`.`d_year` =  $year and
                               `invoice_detail`.`d_no_services` =  $no_services";
                    $queryTot = $this->db->query($query)->result();
                    var_dump($queryTot) ?>
                    <?php $subTotaldetail = 0;
                    foreach ($queryTot as  $dataa)
                        $subTotaldetail += (int) $dataa->total;
                    ?>
                    <?php
                    $query = "SELECT *
                                    FROM `invoice_detail`  JOIN `package_item` 
                                                                ON `invoice_detail`.`item_id` = `package_item`.`p_item_id`
                                        WHERE `invoice_detail`.`invoice_id` = $data->invoice  ";
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
                            <td style="text-align: right"><?= indo_currency($dataa->price) ?></td>
                            <td style="text-align: right"><?= indo_currency($dataa->total) ?></td>
                        </tr>

                    <?php
                    }
                    ?>
                    <?php if ($subtotal > 0) { ?>
                        <?php
                        foreach ($queryTot as  $dataaa) { ?>
                            <tr>
                                <td><?= $dataaa->name ?> </td>
                                <td style="text-align: center"><?= $dataaa->qty ?></td>
                                <td style="text-align: right"><?= indo_currency($dataaa->price) ?></td>
                                <td style="text-align: right">
                                    <?php if ($dataaa->disc <= 0) { ?>
                                        -
                                    <?php } ?>
                                    <?php if ($dataaa->disc > 0) { ?>
                                        <?= indo_currency($dataaa->disc)  ?>
                                    <?php } ?>
                                </td>
                                <td style="text-align: right"><?= indo_currency($dataaa->total) ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    <?php } ?>

                </tbody>
                <tfoot>
                    <tr class="text-right" style="font-size: small;">
                        <td colspan="3" style="font-size: 12px;">Kode Unik (sedekah)</td>
                        <td style="font-size: 12px;"><?= $data->code_unique ?></td>
                    </tr>
                    <tr style="text-align: right">
                        <th colspan="3">Total Tagihan</th>
                        <th><?= indo_currency($subtotal + $data->code_unique)  ?></th>

                    </tr>
                    <tr>
                        <td colspan="4" style="font-size: 12px;">Terbilang :<br><i><?= number_to_words($subtotal + $data->code_unique) ?> Rupiah</i></td>
                    </tr>
                    <?php if ($data->status == 'SUDAH BAYAR') {   ?>
                        <tr>
                            <td colspan="4" style="font-size: 12px; text-align: center;">
                                Tanda Terima ini adalah sah dan harap disimpan sebagai bukti pembayaran
                            </td>
                        </tr>
                    <?php } ?>
                </tfoot>

            </table>

            <div class="thanks">
                ~~~ Terima Kasih ~~~
                <br>
                <?php $link = "www.$_SERVER[HTTP_HOST]"; ?>
                <?= $link ?>
            </div>
        </div>

    <?php } ?>
    <script src="https://files.billing.or.id/assets/frontend/libraries/jquery/jquery-3.4.1.min.js"></script>
    <script src="https://files.billing.or.id/assets/frontend/libraries/bootstrap/js/bootstrap.js"></script>
</body>

</html>