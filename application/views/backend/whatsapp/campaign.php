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
        $koneksi = mysqli_connect($company['host_database'], $company['user_database'], $company['pass_database'], $company['nama_database']);
        $data_contact = mysqli_query($koneksi, "SELECT * FROM campaign WHERE kategori_kontak='PELANGGAN'");
        $jumlah_contact = mysqli_num_rows($data_contact);
        ?>
        <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data Pesan Terjadwal (<?= $jumlah_contact; ?> item)</h6>
    </div>
    <div class="card-body">
        <section class="content">
            <div class="box">
                <div class="table-responsive">
                    <table class="table table-bordered" id="tablebt" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama Pelanggan</th>
                                <th>No. WhatsApp</th>
                                <th>No. Layanan</th>
                                <th>Kategori</th>
                                <th>Reminder</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($campaign as $p) :
                            ?>
                                <tr>
                                    <td class="text-center" width="5%"><?= $no++; ?></td>
                                    <td><?= $p->nama_pelanggan; ?></td>
                                    <td class="text-center"><?= $p->nomor_whatsapp; ?></td>
                                    <td class="text-center"><?= $p->nomor_services; ?></td>
                                    <td class="text-center"><?= $p->kategori_kontak; ?></td>
                                    <td class="text-center">Setiap Tanggal <?= $p->tanggal_reminder; ?></td>


                                    <?php
                                    $koneksi = mysqli_connect($company['host_database'], $company['user_database'], $company['pass_database'], $company['nama_database']);
                                    $id = $p->id_campaign;
                                    $query = "SELECT * FROM user WHERE id='$id'";
                                    $hasil = mysqli_query($koneksi, $query);
                                    $data  = mysqli_fetch_array($hasil);
                                    ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>