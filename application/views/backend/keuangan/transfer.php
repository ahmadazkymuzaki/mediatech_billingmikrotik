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
         <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data Transfer Saldo</h6>
     </div>
     <div class="card-body">
         <div class="table-responsive">
             <table class="table table-bordered table-responsive" id="dataTable" width="100%" cellspacing="0">
                 <thead>
                     <tr style="height: 30px;">
                         <th style="text-align: center; width: 5%;">No</th>
                         <th style="text-align: center">Nama Penerima</th>
                         <th style="text-align: center">Bank Tujuan</th>
                         <th style="text-align: center">No. Rekening</th>
                         <th style="text-align: center">Nominal</th>
                         <th style="text-align: center">Status</th>
                         <th style="text-align: center">Pada</th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php
                        $no = 1;
                        foreach ($transfer as $r => $data) {
                        ?>
                         <tr style="height: 30px;">
                             <td style="text-align: center; width: 5%;"><?= $no++ ?>.</td>
                             <td style="text-align: left;"><?= $data->nama_penerima ?></td>
                             <td style="text-align: left;"><?= $data->bank_tujuan ?></td>
                             <td style="text-align: left;"><?= $data->rekening_tujuan ?></td>
                             <td style="text-align: left;">Rp. <?= indo_currency($data->nominal_transfer) ?></td>
                             <?php if ($data->status_request == 'PENDING') { ?>
                                 <td style="text-align: center;">
                                     <a style="text-decoration: none;" href="<?= site_url() ?>/keuangan/terimatransfer/<?= $data->id_transfer ?>" class="btn btn-success">TERIMA</a><br>
                                     <a style="text-decoration: none; margin-top: 5px;" href="<?= site_url() ?>/keuangan/tolaktransfer/<?= $data->id_transfer ?>" class="btn btn-danger">TOLAK</a>
                                 </td>
                             <?php } else { ?>
                                 <td style="text-align: left;"><?= $data->status_request ?></td>
                             <?php } ?>
                             <td style="text-align: center;"><?= $data->waktu_request ?></td>
                         </tr>
                     <?php } ?>
                 </tbody>
             </table>
         </div>
     </div>
 </div>