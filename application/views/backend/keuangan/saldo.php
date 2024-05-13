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
 <?php $subtotal = 0;
    foreach ($saldo as $c => $data) {
        $subtotal += $data->saldo;
    }
    ?>
 <div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
     <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
         <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data Saldo Pengguna</h6>
     </div>
     <div class="card-body">
         <div class="table-responsive">
             <table class="table table-bordered" id="tablebt" width="100%" cellspacing="0">
                 <thead>
                     <tr style="text-align: center">
                         <th style="text-align: center; width: 5%;">No</th>
                         <th style="text-align: center">Nama Pelanggan</th>
                         <th style="text-align: center">Level</th>
                         <th style="text-align: center">Telepon</th>
                         <th style="text-align: center">No. Layanan</th>
                         <th style="text-align: center">Saldo</th>
                     </tr>
                 </thead>
                 <tfoot>
                     <tr style="text-align: center">
                         <th style="text-align: right;" colspan="5"><b>Total Saldo Pengguna</b></th>
                         <th style="text-align: right;"><b>Rp. <?= indo_currency($subtotal) ?></b></th>
                     </tr>
                     <tr style="text-align: left">
                         <th colspan="6"><i>Terbilang &nbsp; : &nbsp; <?= number_to_words($subtotal) ?> Rupiah</i></th>
                     </tr>
                 </tfoot>
                 <tbody>
                     <?php $no = 1;
                        foreach ($saldo as $r => $data) {
                            if ($data->role_id == 1) {
                                $level = 'Admin / Owner';
                            } elseif ($data->role_id == 2) {
                                $level = 'Member PPPOE';
                            } elseif ($data->role_id == 3) {
                                $level = 'Member HOTSPOT';
                            } elseif ($data->role_id == 4) {
                                $level = 'Resellr HOTSPOT';
                            } elseif ($data->role_id == 5) {
                                $level = 'Sales PPPOE';
                            } elseif ($data->role_id == 6) {
                                $level = 'Operator Jaringan';
                            } elseif ($data->role_id == 7) {
                                $level = 'Customer Service';
                            } elseif ($data->role_id == 8) {
                                $level = 'Teknisi / Karyawan';
                            } elseif ($data->role_id == 9) {
                                $level = 'Member PREMIUM';
                            } elseif ($data->role_id == 10) {
                                $level = 'Bill Collector';
                            } else {
                                $level = 'Tidak Diketahui';
                            }
                        ?>
                         <tr>
                             <td style="text-align: center; width: 5%;"><?= $no++ ?>.</td>
                             <td style="text-align: left;"><?= $data->name ?></td>
                             <td style="text-align: center;"><?= $level ?></td>
                             <td style="text-align: center;"><?= $data->phone ?></td>
                             <td style="text-align: center;"><?= $data->no_services ?></td>
                             <td style="text-align: right;">Rp. <?= indo_currency($data->saldo) ?></td>
                         </tr>
                     <?php } ?>
                 </tbody>
             </table>
         </div>
     </div>
 </div>