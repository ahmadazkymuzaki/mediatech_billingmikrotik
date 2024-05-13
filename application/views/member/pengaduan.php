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
                <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Formulir Pengaduan - <b>#TKT-<?= date('ymdHis') ?></b></h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="form-renew">
                            <form action="<?= site_url('member/kirimpengaduan') ?>" method="POST">
                                <div class="row">
                                    <div class="form-group col-lg-4 col-12">
                                        <label>Ditujukan Kepada</label>
                                        <input type="text" class="form-control" readonly value="Admin <?= $company['company_name'] ?>" name="user_penerima" id="user_penerima">
                                        <input type="hidden" class="form-control" readonly value="#TKT-<?= date('ymdHis') ?>" name="tiket_pesan" id="tiket_pesan">
                                        <input type="hidden" class="form-control" readonly value="belum dibaca" name="status_message" id="status_message">
                                        <input type="hidden" class="form-control" readonly value="<?= date('d/m/Y H:i:s') ?> WIB" name="waktu_kirim" id="waktu_kirim">
                                    </div>
                                    <div class="form-group col-lg-4 col-12">
                                        <label>Pengirim Pesan</label>
                                        <input type="text" class="form-control" readonly value="<?= $user['email'] ?>" name="user_pengirim" id="user_pengirim">
                                    </div>
                                    <div class="form-group col-lg-4 col-12">
                                        <label>Subjek / Judul</label>
                                        <select class="form-control" name="judul_pesan" id="judul_pesan" required>
                                            <option value="">Silahkan Pilih</option>
                                            <option value="Gangguan Pada Jaringan">Gangguan Pada Jaringan</option>
                                            <option value="Pembayaran Tagihan">Pembayaran Tagihan</option>
                                            <option value="Berhenti Berlangganan">Berhenti Berlangganan</option>
                                            <option value="Cek Coverage Area">Cek Coverage Area</option>
                                            <option value="Pendaftaran Refferal">Pendaftaran Refferal</option>
                                            <option value="Top Up / Transfer Saldo">Top Up / Transfer Saldo</option>
                                            <option value="Pengajuan Wilayah Baru">Pengajuan Wilayah Baru</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-12 col-12">
                                        <label>Konten Pengaduan</label>
                                        <textarea class="form-control" placeholder="Tuliskan apa yang ingin di laporkan . . ." name="konten_pesan" id="konten_pesan" rows="3"></textarea>
                                    </div>
                                    <div class="form-group col-lg-12 col-12">
                                        <button type="submit" class="btn bg-primary form-control text-white">Kirim Pengaduan Sekarang</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    <div class="col-12">
        <div class="card shadow mb-3" style="border: solid 1px grey;">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Pesan Balasan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="default_order" class="table table-striped table-bordered no-wrap">
                        <thead>
                            <tr style="text-align: center">
                                <th style="text-align: center;">No</th>
                                <th style="text-align: center;">Pengirim</th>
                                <th style="text-align: center;">Judul Pesan</th>
                                <th style="text-align: center;">Konten Pesan</th>
                                <th style="text-align: center;">Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            $pesan_balasan = $this->db->get_where('message', ['user_penerima' => $user['email']])->result();
                            foreach ($pesan_balasan as $r => $terbalas) {
                            ?>
                                <tr>
                                    <td style="text-align: center;"><?= $no++ ?>.</td>
                                    <td><?= $terbalas->user_pengirim; ?></td>
                                    <td><?= $terbalas->judul_pesan; ?></td>
                                    <td><?= $terbalas->konten_pesan; ?></td>
                                    <td style="text-align: center;"><?= $terbalas->waktu_kirim; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>