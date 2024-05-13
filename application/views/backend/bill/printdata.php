<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - <?= $user['name'] ?></title>
    <link rel="stylesheet" href="<?= site_url('assets/') ?>frontend/libraries/bootstrap/css/bootstrap.css">
</head>

<body onload="window.print()">
    <style>
        body {
            max-width: 5.8cm;
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
            max-width: 5.8cm;
            max-height: 8.6cm;
            margin-left: auto;
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
            max-width: 5.4cm;
            max-height: 8.56cm;
            margin: 0;
        }

        @media print {
            .page {
                border: 1px solid black;
                border-radius: 10px;
                max-width: 5.8cm;
                max-height: 8.6cm;
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
            <center style="margin-left: 10px; margin-right: 10px;">
                <img src="<?= site_url('assets/images/' . $company['logo']) ?>" alt="logo" height="20"><hr>
                <b>Struk Pembayaran Tagihan</b><br>
                <?= $company['company_name'] ?><hr>
                <table id="table" width="100%" border="1">
                    <tbody>
                        <tr>
                            <td>No. Invoice</td>
                            <td>:</td>
                            <td><?= $bill['invoice'] ?></td>
                        </tr>
                    </tbody>
                </table>
            </center>
        </div>
    </div>
    <!-- end page -->
    <script src="<?= site_url('assets/') ?>frontend/libraries/jquery/jquery-3.4.1.min.js"></script>
    <script src="<?= site_url('assets/') ?>frontend/libraries/bootstrap/js/bootstrap.js"></script>
</body>

</html>