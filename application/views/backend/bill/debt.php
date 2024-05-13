<!-- Page Heading -->

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
<!-- DataTales Example -->
<div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
    <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
        <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data Tunggakan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTableDraf" width="100%" cellspacing="0">
                <thead>
                    <tr style="text-align: center">
                        <th style="text-align: center; width:20px">No</th>
                        <th>No Layanan</th>
                        <th>Nama</th>
                        <th>Tagihan</th>
                        <th>Total</th>

                        <th>Status</th>
                        <th style="text-align: center">Aksi</th>
                    </tr>
                </thead>
                <tfoot>
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
                                WHERE `invoice`.`status` =  'BELUM BAYAR' and  `invoice_detail`.`invoice_id` = 0 ";
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
                                WHERE `invoice`.`status` =  'BELUM BAYAR' ";
                    $TotalpendingPaymentt = $this->db->query($query)->result();
                    ?>

                    <?php $Totalpendingg = 0;
                    foreach ($TotalpendingPaymentt as $c => $data) {
                        $Totalpendingg += $data->total;
                    } ?>
                    <tr style="text-align: right">
                        <th colspan="4">Grand Total (Belum Termasuk PPN)</th>
                        <th style="text-align:right; font-weight:bold; color:green"><?= indo_currency($Totalpendingg + $Totalpending) ?></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php $no = 1;
                    foreach ($customer as $r => $data) { ?>
                        <tr>
                            <td style="text-align: center"><?= $no++ ?>.</td>
                            <td style="text-align: center"><?= $data->no_services ?> <br>
                            </td>
                            <td><?= $data->name ?></td>
                            <!-- Total Tunggakan -->
                            <?php $query = "SELECT *
                                    FROM `invoice`
                                        WHERE `invoice`.`no_services` = $data->no_services and `invoice`.`status` = 'Belum Bayar'";
                            $querying = $this->db->query($query)->num_rows();
                            ?>
                            <?php $query = "SELECT *
                                    FROM `invoice`
                                        WHERE `invoice`.`no_services` = $data->no_services and `invoice`.`status` = 'Belum Bayar'";
                            $queryii = $this->db->query($query)->result();
                            ?>
                            <!-- Total Tagihan -->

                            <?php $query = "SELECT *
                                    FROM `invoice`
                                    JOIN `invoice_detail` 
                                                                ON `invoice_detail`.`invoice_id` = `invoice`.`invoice`
                                        WHERE `invoice`.`no_services` = $data->no_services and `invoice`.`status` = 'Belum Bayar'";
                            $queryTot = $this->db->query($query)->result();
                            ?>
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
                                WHERE `invoice`.`status` =  'BELUM BAYAR' and `invoice_detail`.`d_no_services` =  $data->no_services and `invoice_detail`.`invoice_id` = 0 ";
                            $queryTotDet = $this->db->query($query)->result();
                            // var_dump($TotalpendingPayment)
                            ?>

                            <?php $subtotalDet = 0;
                            foreach ($queryTotDet as $c => $data) {
                                $subtotalDet += $data->total;
                            } ?>


                            <?php $subtotal = 0;
                            foreach ($queryTot as  $dataa)
                                $subtotal += (int) $dataa->total;
                            ?>



                            <?php if ($querying > 0) { ?>
                                <td style="text-align: center"><?= $querying ?> Bulan</td>
                            <?php } ?>
                            <?php if ($querying == 0) { ?>
                                <td style="text-align: center"></td>
                            <?php } ?>

                            <?php $grandTotal = indo_currency($subtotal + $subtotalDet) ?>


                            <td style="text-align: right;"><?= $grandTotal ?></td>
                            <?php if ($querying  == 0) { ?>
                                <td style="text-align: center">
                                    <div class="badge badge-success">Lunas</div>
                                </td>
                            <?php } ?>
                            <?php if ($querying > 0) { ?>
                                <td style="text-align: center">
                                    <div class="badge badge-danger">Belum Lunas</div>
                                </td>
                            <?php } ?>

                            <?php if ($querying > 0) { ?>
                                <td style="text-align: center"><a href="<?= site_url('bill/printdebt/' . $data->no_services) ?>" target="blank" title="Cetak Invoice"><i class="fa fa-print" style=" color:gray"></i></a>
                                    <?php $link = "https://$_SERVER[HTTP_HOST]"; ?>
                                    <!-- <a href="<?= site_url('bill/detail/') ?>" title="Send Whatsapp"><i class="fab fa-whatsapp" style=" color:green"></i></a> -->
                                </td>
                            <?php } ?>
                            <?php if ($querying == 0) { ?>
                                <td></td>
                            <?php } ?>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>