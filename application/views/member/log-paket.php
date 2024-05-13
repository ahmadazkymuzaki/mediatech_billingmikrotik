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
<div class="col-lg-12 mt-3">
    <div class="col-12">
        <div class="card shadow mb-3" style="border: solid 1px grey;">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Daftar Riwayat Layanan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered no-wrap">
                        <thead>
                            <tr style="text-align: center">
                                <th style="text-align: center;">No</th>
                                <th style="text-align: center;">Nama Layanan</th>
                                <th style="text-align: center;">Kategori</th>
                                <th style="text-align: center;">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($paket as $r => $dataku) { ?>
                                <tr>
                                    <td style="text-align: center;"><?= $no++ ?>.</td>
                                    <td><?= $dataku->nama_paket; ?></td>
                                    <td style="text-align: center;"><?= $dataku->cat_paket; ?></td>
                                    <td style="text-align: center;"><?= $dataku->time_paket; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card shadow mb-3" style="border: solid 1px grey;">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Daftar Ajuan Layanan</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box box-widget">
                            <div class="box-body table-responsive table-hover">
                                <table id="default_order" class="table table-striped table-bordered no-wrap">
                                    <thead>
                                        <tr style="text-align: center">
                                            <th>No.</th>
                                            <th>Judul</th>
                                            <th>Layanan</th>
                                            <th>Catatan</th>
                                            <th>Status</th>
                                            <th>Pada</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $nomor_layanan = $user['no_services'];
                                        $koneksi = mysqli_connect($company['host_database'], $company['user_database'], $company['pass_database'], $company['nama_database']);
                                        $myquery = mysqli_query($koneksi, "SELECT * from layanan where nomor_layanan='$nomor_layanan' order by diajukan_pada DESC");
                                        while ($datagua = mysqli_fetch_array($myquery)) {
                                        ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $datagua['judul_layanan'] ?></td>
                                                <td><?= $datagua['nama_layanan'] ?></td>
                                                <td><?= $datagua['catatan_layanan'] ?></td>
                                                <td><?= $datagua['status_layanan'] ?></td>
                                                <td><?= $datagua['diajukan_pada'] ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>