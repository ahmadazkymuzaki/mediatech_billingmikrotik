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
<?php
$grandtotal = 0;
foreach ($invoice as  $dataa) {
    $grandtotal += (int) $dataa->amount;
}
?>
 <!-- DataTales Example -->
 <div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
     <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
         <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>;">Data Seluruh Riwayat Tagihan : <font style="text-align:left; font-weight:bold; color: <?= $backgroundnya ?>;">Rp. <?= indo_currency($grandtotal) ?></font></h6>
     </div>
     <div class="card-body">
         <div class="table-responsive">
             <table class="table table-bordered table-responsive" id="dataTable" width="100%" cellspacing="0">
                 <thead>
                     <tr style="height: 30px;">
                         <th style="text-align: center; width: 5%;">No</th>
                         <th style="text-align: center;">Layanan</th>
                         <th style="text-align: center;">Pelanggan</th>
                         <th style="text-align: center;">Tagihan</th>
                         <th style="text-align: center;">Pembayaran</th>
                         <th style="text-align: center;">Gateway</th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php
                        $no = 1;
                        foreach ($invoice as $data) {
                            $data_customer   = $this->db->get_where('customer', array('no_services' => $data->no_services))->row_array();
                        ?>
                         <tr style="height: 30px;">
                             <td style="text-align: center; width: 5%;"><?= $no++ ?></td>
                             <td style="text-align: center;">#<?= $data->invoice ?><br><?= $data->no_services ?></td>
                             <td style="text-align: center;"><?= $data_customer['name'] ?><br><?= $data_customer['no_wa'] ?></td>
                             <td style="text-align: center;"><?= indo_month($data->month) ?> <?= $data->year ?><br>Rp. <?= indo_currency($data->amount) ?></td>
                             <td style="text-align: center;"><?= $data->status ?><br>
                             <?php
                                if($data->metode_payment == ''){
                            ?>
                            MTD : BEDA
                            <?php
                                } else {
                            ?>
                            MTD : <?= $data->metode_payment ?>
                            <?php
                                }
                            ?></td>
                             <td style="text-align: center;"><?= $data->merchant_ref ?><br><a href="https://tripay.co.id/checkout/<?= $data->reference_code ?>" target="_blank" style="font-weight: bold; text-decoration: none;"><?= $data->reference_code ?></a></td>
                         </tr>
                     <?php } ?>
                 </tbody>
             </table>
         </div>
     </div>
 </div>