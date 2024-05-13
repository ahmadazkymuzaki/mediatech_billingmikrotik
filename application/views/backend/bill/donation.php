<?php
if ($company['theme'] == 'primary') {
    $backgroundnya = '#4e73df';
    $colornya = '#fff';
} elseif ($company['theme'] == 'secondary') {
    $backgroundnya = '#6c757d';
    $colornya = '#fff';
} elseif ($company['theme'] == 'success') {
    $backgroundnya = '#1cc88a';
    $colornya = '#fff';
} elseif ($company['theme'] == 'danger') {
    $backgroundnya = '#e74a3b';
    $colornya = '#fff';
} elseif ($company['theme'] == 'warning') {
    $backgroundnya = '#f6c23e';
    $colornya = '#fff';
} elseif ($company['theme'] == 'info') {
    $backgroundnya = '#36b9cc';
    $colornya = '#fff';
} elseif ($company['theme'] == 'dark') {
    $backgroundnya = '#5a5c69';
    $colornya = '#fff';
} elseif ($company['theme'] == 'light') {
    $backgroundnya = '#f8f9fc';
    $colornya = '#000';
} elseif ($company['theme'] == 'default') {
    $backgroundnya = '#ffffff';
    $colornya = '#000';
} elseif ($company['theme'] == 'purple') {
    $backgroundnya = '#6f42c1';
    $colornya = '#fff';
} elseif ($company['theme'] == 'orange') {
    $backgroundnya = '#fd7e14';
    $colornya = '#fff';
} else {
    $backgroundnya = '#e74a3b';
    $colornya = '#fff';
}
?>
<div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
    <div class="col-lg-12">
        <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header ">
            <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>"><i class="fa fa-table" style="font-size: 24px"> Donasi Uang Kopi</i></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0" style="border: solid black 1px; color: black;">
                    <thead>
                        <tr style="text-align: center">
                            <th style="text-align: center; width:20px">No</th>
                            <th>Metode Bayar</th>
                            <th>Nomor Rekening </th>
                            <th>Atas Nama</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: center">1.</td>
                            <td>Transfer Bank MANDIRI</td>
                            <td>1260011046272</td>
                            <td>Ahmad Azky Muzaki</td>
                        </tr>
                        <tr>
                            <td style="text-align: center">9.</td>
                            <td>E-Wallet Gopay</td>
                            <td>08161110211</td>
                            <td>Ahmad Azky Muzaki</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>