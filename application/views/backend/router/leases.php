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
        <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data DHCP Leases (<?= $totallease; ?> item)</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" cellspacing="0">
                <thead>
                    <tr style="text-align: center;">
                        <th width="5%">No</th>
                        <th width="12%">Address</th>
                        <th width="17%">Mac Address</th>
                        <th width="22%">Host Name</th>
                        <th width="15%">Server</th>
                        <th width="12%">Status</th>
                        <th width="12%">Last Seen</th>
                        <th width="5%">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $no = 1;
                    foreach ($lease as $datagua) {
                    ?>
                        <?php $id = str_replace('*', '', $datagua['.id']) ?>
                        <tr style="text-align: center">
                            <td width="5%"><?= $no++ ?></td>
                            <td width="12%"><?= $datagua['address'] ?></td>
                            <td width="17%"><?= $datagua['mac-address'] ?></td>
                            <td width="27%"><?= $datagua['host-name'] ?></td>
                            <td width="15%"><?= $datagua['server'] ?></td>
                            <td width="12%"><?= $datagua['status'] ?></td>
                            <td width="12%"><?= $datagua['last-seen'] ?></td>
                            <td width="15%">
                                <a href="<?= site_url('mikrotik/deletelease/' . $id) ?>" onclick="return confirm('Apakah anda yakin akan menghapus data <?= $datagua['address'] ?> <?= $dataku['name'] ?> ?')" title="Hapus">
                                    <i class="fa fa-trash" style="font-size:25px; color:red"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>