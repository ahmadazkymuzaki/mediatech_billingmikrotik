<!-- bootstrap datepicker -->
<link rel="stylesheet" href="https://files.billing.or.id/assets/backend/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
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
<div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
    <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
        <?php
        $no = 1;
        $jumlah_hotspot = $this->db->get('hotspot')->num_rows();
        ?>
        <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data Reseller Voucher (<?= $jumlah_hotspot; ?> item)</h6>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="tablebt" width="100%" cellspacing="0">
                <thead>
                    <tr style="text-align: center;">
                        <th>No</th>
                        <th>Paket</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Pembuat</th>
                        <th>Pada</th>
                        <th>Status</th>
                        <?php if ($this->session->userdata('role_id') == 1) { ?>
                            <th>Aksi</th>
                        <?php } ?>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $myhotspot = $this->db->get('hotspot')->result();
                    foreach ($myhotspot as $datagua) {
                        $id = $datagua->id_hotspot;
                    ?>
                        <tr style="text-align: center; height: 25px; margin:auto;">
                            <td><?= $no++ ?></td>
                            <td><?= $datagua->paket_hotspot ?></td>
                            <td><?= $datagua->user_hotspot ?></td>
                            <td><?= $datagua->pass_hotspot ?></td>
                            <td><?= $datagua->create_hotspot ?></td>
                            <td><?= $datagua->time_hotspot ?> WIB</td>
                            <td><?= $datagua->status_hotspot ?></td>
                            <?php if ($this->session->userdata('role_id') == 1) { ?>
                                <td>
                                    <a href="<?= site_url('laporan/delete/' . $id) ?>" onclick="return confirm('Apakah anda yakin akan menghapus data voucher <?= $datagua->user_hotspot ?> ?')" title="Delete">
                                        <i class="fa fa-trash" style="font-size:25px; color:red;"></i>
                                    </a>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>