<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - <?= $user['name'] ?></title>
    <link rel="stylesheet" href="https://files.billing.or.id/assets/frontend/libraries/bootstrap/css/bootstrap.css">
</head>

<body onload="window.print()">
    <style>
        body {
            max-width: 6cm;
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font: 12px "Tahoma";
            border: 1px solid black;
            border-radius: 10px;
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .page {
            max-width: 6cm;
            margin-left: 5px;
            margin-right: auto;
            padding-top: 0.5cm;
            padding-bottom: 0.5cm;
            margin-left: auto;
            margin-right: auto;
            border: 1px solid black;
            border-radius: 10px;
            background: white;
            font-size: 12px;
            line-height: 15px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        @page {
            max-width: 6cm;
            margin: 0;
        }

        @media print {
            .page {
                border: 1px solid black;
                border-radius: 10px;
                max-width: 5.8cm;
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
        
        .thanks {
            padding-top: 5px;
            text-align: center;
            border-top: 1px dashed;
        }
    </style>

    <div class="book">
        <?php foreach ($bill as $r => $data) { ?>
            <div class="page">
                <center style="margin-left: 15px; margin-right: 10px;">
                    <img src="<?= site_url('assets/images/' . $company['logo']) ?>" alt="logo" height="20">
                    <br><br>=======================<br>
                    <b>Struk Pembayaran Tagihan</b><br>
                    <?= $company['company_name'] ?><br>
                    =======================<br>
                    <b>Atas Nama :</b><br>
                    <?= $data->name ?><br>
                    =======================<br>
                    <table id="table" width="100%" border="0">
                        <tbody>
                            <tr>
                                <td>No. Invoice</td>
                                <td>:</td>
                                <td><?= $data->invoice ?></td>
                            </tr>
                            <tr>
                                <td>No. Layanan</td>
                                <td>:</td>
                                <td><?= $data->no_services ?></td>
                            </tr>
                            <tr>
                                <td>Periode Tagihan</td>
                                <td>:</td>
                                <td><?= indo_month($data->month) ?> <?= $data->year ?></td>
                            </tr>
                            <tr>
                                <td>Status Tagihan</td>
                                <td>:</td>
                                <td><?= $data->status ?></td>
                            </tr>
                            <tr>
                                <td>Dicetak Tanggal</td>
                                <td>:</td>
                                <td><?= date('d/m/Y') ?></td>
                            </tr>
                            <tr>
                                <td>Dicetak Jam</td>
                                <td>:</td>
                                <td><?= date('H:i:s') ?> WIB</td>
                            </tr>
                            <tr>
                                <td colspan="3">
                    =======================</td>
                            </tr>
                            <?php
                            $month =  $data->month;
                            $year = $data->year;
                            $no_services = $data->no_services;
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
                            $invoice =  $data->invoice;
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
                                    <td colspan="3"><b>Layanan ke-<?= $no++ ?></b></td>
                                </tr>
                                <tr>
                                    <td>Nama Paket</td>
                                    <td>:</td>
                                    <td><?= $dataa->name ?></td>
                                </tr>
                                <tr>
                                    <td>Harga</td>
                                    <td>:</td>
                                    <td style="text-align: left">Rp. <?= indo_currency($dataa->price_detail) ?></td>
                                </tr>
                                <tr>
                                    <td>Jumlah</td>
                                    <td>:</td>
                                    <td style="text-align: left"><?= $dataa->qty ?> (item)</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td>:</td>
                                    <td style="text-align: left">Rp. <?= indo_currency($dataa->total) ?></td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                    =======================</td>
                                </tr>
                            <?php } ?>
                            <?php if ($subtotal <= 0) { ?>
                                <?php
                                foreach ($queryTot as  $dataaa) { ?>
                                    <tr>
                                        <td colspan="3"><b>Layanan ke-<?= $no++ ?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Paket</td>
                                        <td>:</td>
                                        <td><?= $dataa->name ?></td>
                                    </tr>
                                    <tr>
                                        <td>Harga</td>
                                        <td>:</td>
                                        <td style="text-align: left">Rp. <?= indo_currency($dataa->price_detail) ?></td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah</td>
                                        <td>:</td>
                                        <td style="text-align: left"><?= $dataa->qty ?> (item)</td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td>:</td>
                                        <td style="text-align: left">Rp. <?= indo_currency($dataa->total) ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                    =======================</td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
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
                                <tr>
                                    <td><b>PPN (<?= $data->i_ppn ?>%)<b></td>
                                    <td>:</td>
                                    <td>Rp. <?= indo_currency($ppn) ?></td>
                                </tr>
                            <?php } ?>
                            <?php if ($other['code_unique'] == 1) { ?>
                                <tr>
                                    <td><b>Kode Unik<br>(sedekah)</b></td>
                                    <td>:</td>
                                    <td>Rp. <?= indo_currency($code_unique) ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <b style="line-height: 20px;">Total Tagihan : Rp.</b>
                    <?php if ($subtotal > 0) { ?>
                        <?= indo_currency($subtotal + $code_unique + $ppn) ?>
                    <?php } ?>
                    <?php if ($subtotal == 0) { ?>
                        <?= indo_currency($subTotaldetail + $code_unique + $ppn) ?>
                    <?php } ?>
                    <br>
                    ( <i style="line-height: 20px;">
                        <?php if ($subtotal > 0) { ?>
                            <?= number_to_words($subtotal + $code_unique + $ppn) ?>
                        <?php } ?>
                        <?php if ($subtotal == 0) { ?>
                            <?= number_to_words($subTotaldetail + $code_unique + $ppn) ?>
                        <?php } ?> Rupiah
                    </i> )
                    =======================<br>
                    <?php if ($data->status == 'SUDAH BAYAR') {   ?>
                        Tanda Terima ini adalah sah dan harap disimpan sebagai bukti pembayaran Tagihan
                        <br>
                    <?php } ?>
                    =======================<br>
                    ~~~ Terima Kasih ~~~
                    <br>
                    <?php $link = "www.$_SERVER[HTTP_HOST]"; ?>
                    <b><?= $link ?></b><br>
                    =======================
                </center>
            </div>
        <?php } ?>
    </div>
    <!-- end page -->
    <script src="https://files.billing.or.id/assets/frontend/libraries/jquery/jquery-3.4.1.min.js"></script>
    <script src="https://files.billing.or.id/assets/frontend/libraries/bootstrap/js/bootstrap.js"></script>
</body>

</html>