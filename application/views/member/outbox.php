<div class="col-lg-12 mt-3">
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
    <div class="col-12">
        <div class="card shadow mb-3" style="border: solid 1px grey;">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Pesan Terkirim</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered no-wrap">
                        <thead>
                            <tr style="text-align: center">
                                <th style="text-align: center;">No</th>
                                <th style="text-align: center;">Judul Pesan</th>
                                <th style="text-align: center;">Konten Pesan</th>
                                <th style="text-align: center;">Status</th>
                                <th style="text-align: center;">Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $ok = 1;
                            $pesan_terkirim = $this->db->get_where('message', ['user_pengirim' => $user['email']])->result();
                            foreach ($pesan_terkirim as $r => $terkirim) {
                            ?>
                                <tr>
                                    <td style="text-align: center;"><?= $ok++ ?>.</td>
                                    <td><?= $terkirim->judul_pesan; ?></td>
                                    <td><?= $terkirim->konten_pesan; ?></td>
                                    <td style="text-align: center;"><?= $terkirim->status_message; ?></td>
                                    <td style="text-align: center;"><?= $terkirim->waktu_kirim; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>