<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan <?php if ($tanggal && $tanggal2 !== '') {
                            ?>
            Dari Tanggal <?= indo_date($tanggal) ?> Sampai Tanggal <?= indo_date($tanggal2) ?>
        <?php } ?></title>
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
            width: 29.7cm;
            /* height: 21cm; */
            padding: 2cm;
            margin: 1cm auto;
            margin-top: auto;
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
            size: A4 landscape;
            margin-top: 0, 1cm;
            margin-bottom: 0, 5cm;
        }

        @media print {
            .page {
                margin: 2;
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
            <?php
            $subtotal = 0;
            foreach ($report as $c => $data) {
                $subtotal += $data->income;
            }
            $subtotal2 = 0;
            foreach ($report as $c => $data) {
                $subtotal2 += $data->expenditure;
            }
            $subtotal3 = 0;
            foreach ($report as $c => $data) {
                $subtotal3 += $data->income - $data->expenditure;
            }
            ?>
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
            <div class="title text-center">
                <h6 style="font-weight: bold;">Laporan Keuangan

                    <?php if ($tanggal && $tanggal2 !== '') {
                    ?> Dari Tanggal <?= indo_date($tanggal) ?> Sampai Tanggal <?= indo_date($tanggal2) ?>
                    <?php } ?></h6>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped w-auto small" style="font-size: 12px;" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr style="text-align: center">
                            <th style="text-align: center; width:15px">No</th>
                            <th style="width:150px">Tanggal</th>
                            <th style="width:500px">Keterangan</th>
                            <th style="width:130px">Debit</th>
                            <th style="width:130px">Kredit</th>
                            <th style="width:130px">Saldo</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr style="text-align: center">
                            <th style="text-align: right; font-weight:bold" colspan="3"><b>Total</b></th>
                            <th style="text-align: right"><?= indo_currency($subtotal) ?> </th>
                            <th style="text-align: right"><?= indo_currency($subtotal2) ?></th>
                            <th style="text-align: right"><?= indo_currency($subtotal3) ?></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $no = 1;
                        $date = '';
                        $saldo = 0;
                        $debit = $this->report_m->debit($date);
                        $kredit = $this->report_m->kredit($date);
                        $saldo = $debit - $kredit;
                        foreach ($report as $r => $data) {
                            $saldo = $saldo + $data->income - $data->expenditure;
                        ?>
                            <tr>
                                <td style="text-align: center"><?= $no++ ?>.</td>
                                <td><?= indo_date($data->date)  ?> </td>
                                <td><?= $data->remark ?></td>
                                <td style="text-align: right"><?= indo_currency($data->income)  ?></td>
                                <td style="text-align: right"><?= indo_currency($data->expenditure)  ?></td>
                                <td style="text-align: right"><?= indo_currency($saldo)  ?></td>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="row mt-2" style="font-size: smaller;">
                <div class="col-4">
                </div>
                <div class="col-4">
                </div>
                <div class="col-4 text-center">
                    Tanggal Cetak : <?= date('d') ?> <?= indo_month(date('m')) ?> <?= date('Y') ?>
                    <h6 style="margin-top: 60px;"><?= $user['name']; ?></h6>
                </div>
            </div>
        </div>
    </div>
</body>

</html>