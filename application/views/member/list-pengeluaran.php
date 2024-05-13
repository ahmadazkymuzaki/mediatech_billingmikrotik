<?php $subtotal = 0;
foreach ($pengeluaran as $c => $data) {
    $subtotal += $data->nominal_pengeluaran;
}
?>
<div class="col-lg-12 mt-3">
    <div class="col-12">
        <?php $this->view('messages') ?>
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
    </div>
    <div class="col-12">
        <div class="card shadow mb-3" style="border: solid 1px grey;">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Daftar Transaksi Pengeluaran</h6>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered no-wrap">
                        <thead>
                            <tr style="text-align: center">
                                <th style="text-align: center; width:20px">No</th>
                                <th style="text-align: left;">Kategori</th>
                                <th style="text-align: center; width:100px">Nominal</th>
                                <th>Keterangan</th>
                                <th style="text-align: center;">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($pengeluaran as $r => $dataku) { ?>
                                <tr>
                                    <td style="text-align: center;"><?= $no++ ?>.</td>
                                    <td><?= $dataku->nama_pengeluaran; ?></td>
                                    <td style="text-align: right;"><?= indo_currency($dataku->nominal_pengeluaran); ?></td>
                                    <td><?= $dataku->ket_pengeluaran; ?></td>
                                    <td style="text-align: center;"><?= $dataku->waktu_pengeluaran; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr style="text-align: center">
                                <th style="text-align: right; font-weight:bold" colspan="2"><b>Total</b></th>
                                <th style="text-align: right"><?= indo_currency($subtotal); ?></th>
                                <th colspan="2"><?= number_to_words($subtotal); ?> Rupiah</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>