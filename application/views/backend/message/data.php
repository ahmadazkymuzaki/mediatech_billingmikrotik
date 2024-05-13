<!-- bootstrap datepicker -->
<link rel="stylesheet" href="https://files.billing.or.id/assets/backend/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <a href="#" data-toggle="modal" data-target="#add" class="d-sm-inline-block btn btn-sm btn-<?= $company['theme'] ?> shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah</a>
</div>
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
        $query = mysqli_query($koneksi, "SELECT * from message where judul_pesan!='Laporan' order by waktu_kirim DESC");
        $jumlah_pesan = mysqli_num_rows($query);
        ?>
        <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data Pesan Pengaduan (<?= $jumlah_pesan; ?> item)</h6>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="tablebt" width="100%" cellspacing="0">
                <thead>
                    <tr style="text-align: center;">
                        <th>No</th>
                        <th>Tiket</th>
                        <th>Pengirim</th>
                        <th>Judul</th>
                        <th>Status</th>
                        <?php if ($this->session->userdata('role_id') == 1) { ?>
                            <th>Aksi</th>
                        <?php } ?>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    while ($datagua = mysqli_fetch_array($query)) {
                        $id = $datagua['message_id'];
                        $mycustomer = $this->db->get_where('user', ['email' => $datagua['user_pengirim']])->row_array();
                        $pengirim = $mycustomer['name'];
                    ?>
                        <tr style="height: 25px; margin:auto;">
                            <td style="text-align: center;"><?= $no++ ?></td>
                            <td style="text-align: center;"><?= $datagua['tiket_pesan'] ?></td>
                            <td><?= $pengirim ?></td>
                            <td><?= $datagua['judul_pesan'] ?></td>
                            <td style="text-align: center;"><?= $datagua['status_message'] ?></td>
                            <?php if ($this->session->userdata('role_id') == 1) { ?>
                                <td style="text-align: center;">
                                    <a href="<?= site_url('message/detail/' . $id) ?>" title="Detail">
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

<!-- Modal Add -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pesan</h5>
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
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nominal">Penerima Pesan</label>
                                <select id="user_penerima" name="user_penerima" class="selectpicker show-tick form-control" data-live-search="true" tabindex="-98" required>
                                    <option value="">- Pilih Penerima -</option>
                                    <?php
                                    $query10 = mysqli_query($koneksi, "SELECT * from user WHERE role_id != 1");
                                    while ($data10 = mysqli_fetch_array($query10)) {
                                        if ($data10['role_id'] == 2) {
                                            $role = 'Member PPPOE';
                                        } elseif ($data10['role_id'] == 3) {
                                            $role = 'Member HOTSPOT';
                                        } elseif ($data10['role_id'] == 4) {
                                            $role = 'Reseller HOTSPOT';
                                        } elseif ($data10['role_id'] == 5) {
                                            $role = 'Sales PPPOE';
                                        } elseif ($data10['role_id'] == 6) {
                                            $role = 'Operator Jaringan';
                                        } elseif ($data10['role_id'] == 7) {
                                            $role = 'Customer Service';
                                        } elseif ($data10['role_id'] == 8) {
                                            $role = 'Teknisi / Karyawan';
                                        } elseif ($data10['role_id'] == 9) {
                                            $role = 'Member Premium';
                                        } else {
                                            $role = 'Tidak Dikenal';
                                        }
                                    ?>
                                        <option value="<?php echo $data10['email']; ?>"><?= $role ?> <?= $data10['no_services'] ?> - <?php echo $data10['name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nominal">Nomor Tiket</label>
                                <input type="text" id="tiket_pesan" name="tiket_pesan" value="#TKT-<?= date('ymdHis') ?>" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nominal">Judul Pesan</label>
                                <input type="text" id="judul_pesan" name="judul_pesan" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="remark">Isi Pesan</label>
                        <textarea type="text" name="konten_pesan" id="konten_pesan" class="form-control" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nominal">Waktu Kirim</label>
                                <input type="text" id="waktu_kirim" name="waktu_kirim" value="<?= date('d/m/Y H:i:s') ?> WIB" class="form-control" readonly>
                                <input type="hidden" id="status_message" name="status_message" value="belum dibaca" class="form-control">
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