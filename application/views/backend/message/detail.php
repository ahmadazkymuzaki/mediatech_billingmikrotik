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
        <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">
            <?php $id = $message['message_id']; ?>
            <?= $message['judul_pesan']; ?> (<?= $message['user_pengirim']; ?>) -
            <?php
            if ($message['status_message'] == 'sudah dibaca') {
            ?>
                <font style="color: green;"><i><?= $message['status_message']; ?></i></font>
            <?php
            }
            ?>
            <?php
            if ($message['status_message'] == 'belum dibaca') {
            ?>
                <font style="color: red;"><i><?= $message['status_message']; ?></i></font>
            <?php
            }
            ?>
        </h6>

    </div>
    <div class="card-body">
        <?= $message['konten_pesan']; ?>
    </div>
    <div class="card-footer">
        <a href="<?= site_url('message/data'); ?>" title="Kembali">
            <input type="button" class="d-sm-inline-block btn btn-sm btn-secondary shadow-sm pull-left" style="margin-right: 10px;" value="<=&nbsp; Kembali" readonly>
        </a>
        <?php
        if ($this->session->userdata('role_id') == 1) { ?>
            <a href="<?= site_url('message/deletepesan/' . $id) ?>" class="d-sm-inline-block btn btn-sm btn-danger shadow-sm pull-right" onclick="return confirm('Apakah anda yakin akan menghapus data pesan <?= $message['judul_pesan'] ?> dari <?= $message['user_pengirim']; ?> ?')" title="Hapus">
                <i class="fas fa-trash fa-sm text-white-50"></i> Hapus
            </a>
        <?php } ?>
        <?php
        if ($this->session->userdata('role_id') == 1) { ?>
            <a href="#" data-toggle="modal" data-target="#add" class="d-sm-inline-block btn btn-sm btn-<?= $company['theme'] ?> shadow-sm pull-left"><i class="fas fa-reply-all fa-sm text-white-50"></i> Balas</a>
        <?php } ?>
        <?php
        if ($this->session->userdata('role_id') == 1) { ?>
            <a href="" class="pull-left" style="text-decoration: none;">&nbsp;&nbsp;</a>
        <?php } ?>
        <?php
        if ($this->session->userdata('role_id') == 1) { ?>
            <?php
            if ($message['status_message'] == 'belum dibaca') {
            ?>
                <a href="<?= site_url('message/sudah_dibaca/' . $id) ?>" class="d-sm-inline-block btn btn-sm btn-success shadow-sm pull-left"><i class="fas fa-edit fa-sm text-white-50"></i> Sudah Dibaca</a>
            <?php } ?>
        <?php } ?>
        <?php
        if ($this->session->userdata('role_id') == 1) { ?>
            <?php
            if ($message['status_message'] == 'sudah dibaca') {
            ?>
                <a href="<?= site_url('message/belum_dibaca/' . $id) ?>" class="d-sm-inline-block btn btn-sm btn-warning shadow-sm pull-left"><i class="fas fa-edit fa-sm text-white-50"></i> Belum Dibaca</a>
            <?php } ?>
        <?php } ?>
    </div>
</div>
<!-- Modal Add -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Balas Pesan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('message/kirim') ?>" method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nominal">Pengirim Pesan</label>
                                <input type="text" id="user_pengirim" name="user_pengirim" value="<?= $user['email']; ?>" class="form-control" readonly>
                                <input type="hidden" id="tiket_pesan" name="tiket_pesan" value="<?= $message['tiket_pesan']; ?>" class="form-control">
                                <input type="hidden" id="judul_pesan" name="judul_pesan" value="Laporan" class="form-control">
                                <input type="hidden" id="status_message" name="status_message" value="sudah dibaca" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nominal">Penerima Pesan</label>
                                <input type="text" id="user_penerima" name="user_penerima" value="<?= $message['user_pengirim']; ?>" class="form-control" readonly>
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
                                <input type="text" id="waktu_kirim" name="waktu_kirim" value="<?= date('Y-m-d H:i:s') ?>" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
    <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
        <?php
        $tiket_pesan = $message['tiket_pesan'];
        $no = 1;
        $koneksi = mysqli_connect($company['host_database'], $company['user_database'], $company['pass_database'], $company['nama_database']);
        $query = mysqli_query($koneksi, "SELECT * from message where tiket_pesan='$tiket_pesan' AND judul_pesan='Laporan'");
        $jumlah_pesan = mysqli_num_rows($query);
        ?>
        <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data Pesan Balasan (<?= $jumlah_pesan; ?> item)</h6>

    </div>
    <div class="card-body">
        <div class="container-fluid">
            <table id="example" class="table">
                <thead>
                    <tr style="text-align: center;">
                        <th>No</th>
                        <th>Tiket</th>
                        <th>Judul</th>
                        <th>Isi Pesan Balasan</th>
                        <th>Pada</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    while ($datagua = mysqli_fetch_array($query)) {
                        $id = $datagua['message_id'];
                    ?>
                        <tr style="height: 25px; margin:auto;">
                            <td style="text-align: center;" width="5%"><?= $no++ ?></td>
                            <td style="text-align: center;" width="18%"><?= $datagua['tiket_pesan'] ?></td>
                            <td width="15%"><?= $datagua['judul_pesan'] ?></td>
                            <td width="29%"><?= $datagua['konten_pesan'] ?></td>
                            <td style="text-align: center;" width="20%"><?= $datagua['waktu_kirim'] ?> WIB</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>