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
    foreach ($hutang as $c => $data) {
        $subtotal += $data->nominal_kasbon;
    }
    ?>
 <div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
     <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
         <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data Kasbon Karyawan</h6>
     </div>
     <div class="card-body">
         <div class="table-responsive">
             <table class="table table-bordered" id="tablebt" width="100%" cellspacing="0">
                 <thead>
                     <tr style="text-align: center">
                         <th style="text-align: center; width: 5%;">No</th>
                         <th style="text-align: center; width: 25%;">Data Karyawan</th>
                         <th style="text-align: center">Alasan Kasbon</th>
                         <th style="text-align: center; width: 25%;">Keterangan</th>
                     </tr>
                 </thead>
                 <tfoot>
                     <tr style="text-align: center">
                         <th style="text-align: right;" colspan="3"><b>Total Kasbon Karyawan</b></th>
                         <th style="text-align: right;"><b>Rp. <?= indo_currency($subtotal) ?></b></th>
                     </tr>
                     <tr style="text-align: left">
                         <th colspan="6"><i>Terbilang &nbsp; : &nbsp; <?= number_to_words($subtotal) ?> Rupiah</i></th>
                     </tr>
                 </tfoot>
                 <tbody>
                     <?php $no = 1;
                        foreach ($kasbon as $r => $data) {
                            $dataUser = $this->db->get_where('user', array('no_services' => $data->nomor_services))->row_array();
                        ?>
                         <tr>
                             <td style="text-align: center; width: 5%;"><?= $no++ ?>.</td>
                             <td style="text-align: left;">
                                 &#128073; <?= $dataUser['name'] ?><br>
                                 &#128073; <?= $dataUser['no_services'] ?> - <?= $dataUser['role_id'] ?><br>
                                 &#128073; <?= $dataUser['phone'] ?>
                             </td>
                             <td style="text-align: left;">
                                 <?= $data->ket_kasbon ?><br>
                                 Status : <?= $data->status_kasbon ?>
                             </td>
                             <td style="text-align: left;">
                                 &#128073; Rp. <?= indo_currency($data->nominal_kasbon) ?><br>
                                 &#128073; <?= $data->waktu_kasbon ?><br>
                                 <?php if ($data->status_kasbon == 'DALAM PROSES') { ?>
                                     &#128073; Aksi :
                                     &nbsp; <a style="text-decoration: none; font-weight: bold;" href="<?= site_url('keuangan/terimakasbon/') ?><?= $data->id_kasbon ?>" class="btn-sm btn-<?= $company['theme'] ?>">TERIMA</a>
                                     &nbsp; <a style="text-decoration: none; font-weight: bold;" href="<?= site_url('keuangan/tolakkasbon/') ?><?= $data->id_kasbon ?>" class="btn-sm btn-dark">TOLAK</a>
                                 <?php } elseif ($data->status_kasbon == 'DITERIMA') { ?>
                                     &#128073; Aksi :
                                     &nbsp; <a style="text-decoration: none; font-weight: bold;" href="<?= site_url('keuangan/lunasikasbon/') ?><?= $data->id_kasbon ?>" class="btn-sm btn-success">LUNAS</a>
                                 <?php } elseif ($data->status_kasbon == 'DITOLAK') { ?>
                                     &#128073; Aksi :
                                     &nbsp; <a style="text-decoration: none; font-weight: bold;" href="<?= site_url('keuangan/hapuskasbon/') ?><?= $data->id_kasbon ?>" class="btn-sm btn-danger">HAPUS</a>
                                 <?php } elseif ($data->status_kasbon == 'SUDAH LUNAS') { ?>
                                     &#128073; Aksi :
                                     &nbsp; <a style="text-decoration: none; font-weight: bold;" href="<?= site_url('keuangan/hapuskasbon/') ?><?= $data->id_kasbon ?>" class="btn-sm btn-danger">HAPUS</a>
                                 <?php } else { ?>
                                     &#128073; Aksi : TIDAK DIKETAHUI
                                 <?php } ?>
                             </td>
                         </tr>
                     <?php } ?>
                 </tbody>
             </table>
         </div>
     </div>
 </div>