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
                                    <td><?= $terbalas->user_pengirim; ?> &nbsp; <a class="btn-sm btn-success" href="#" data-toggle="modal" data-target="#add<?= $terbalas->message_id ?>" style="text-decoration: none;"><i class="fa fa-share"></i> Balas</a></td>
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
<?php $pesan_balasan = $this->db->get_where('message', ['user_penerima' => $user['email']])->result();
foreach ($pesan_balasan as $r => $terbalas) { ?>
    <!-- Modal Add -->
    <div class="modal fade" id="add<?= $terbalas->message_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Balas Pesan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= site_url('member/balaspengaduan') ?>" method="POST">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nominal">Pengirim Pesan</label>
                                    <input type="text" id="user_pengirim" name="user_pengirim" value="<?= $user['email']; ?>" class="form-control" readonly>
                                    <input type="hidden" id="tiket_pesan" name="tiket_pesan" value="<?= $terbalas->tiket_pesan; ?>" class="form-control">
                                    <input type="hidden" id="message_id" name="message_id" value="<?= $terbalas->message_id; ?>" class="form-control">
                                    <input type="hidden" id="judul_pesan" name="judul_pesan" value="Laporan" class="form-control">
                                    <input type="hidden" id="status_message" name="status_message" value="belum dibaca" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nominal">Penerima Pesan</label>
                                    <input type="text" id="user_penerima" name="user_penerima" value="<?= $terbalas->user_pengirim ?>" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="remark">Isi Pesan</label>
                            <textarea type="text" name="konten_pesan" id="konten_pesan" class="form-control"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nominal">Waktu Kirim</label>
                                    <input type="text" id="waktu_kirim" name="waktu_kirim" value="<?= date('d/m/Y H:i:s') ?> WIB" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>