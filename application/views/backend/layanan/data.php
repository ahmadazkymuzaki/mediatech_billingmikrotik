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
        $koneksi = mysqli_connect($company['host_database'], $company['user_database'], $company['pass_database'], $company['nama_database']);
        $query = mysqli_query($koneksi, "SELECT * from layanan order by diajukan_pada DESC");
        $jumlah_layanan = mysqli_num_rows($query);
        ?>
        <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data Ajuan Layanan (<?= $jumlah_layanan; ?> item)</h6>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="tablebt" width="100%" cellspacing="0">
                <thead>
                    <tr style="text-align: center;">
                        <th>No.</th>
                        <th>Pelanggan</th>
                        <th>Judul</th>
                        <th>Alasan</th>
                        <th>Pada</th>
                        <th>Status</th>
                        <?php if ($this->session->userdata('role_id') == 1) { ?>
                            <th>Aksi</th>
                        <?php } ?>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    while ($datagua = mysqli_fetch_array($query)) {
                        $id = $datagua['id_layanan'];
                    ?>
                        <tr style="text-align: left; height: 25px; margin:auto;">
                            <td style="text-align: center;"><?= $no++ ?></td>
                            <td><?= $datagua['nama_pelanggan']; ?></td>
                            <td><?= $datagua['judul_layanan']; ?></td>
                            <td><?= $datagua['alasan_layanan']; ?></td>
                            <td style="text-align: center;"><?= $datagua['diajukan_pada']; ?></td>
                            <td style="text-align: center;"><?= $datagua['status_layanan']; ?></td>
                            <?php if ($this->session->userdata('role_id') == 1) { ?>
                                <td style="text-align: center;">
                                    <a href="<?= site_url('layanan/detail/' . $id) ?>" title="Detail">
                                        <i class="fa fa-eye" style="font-size:25px; color:green;"></i>
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