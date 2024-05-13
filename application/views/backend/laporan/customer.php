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
        $koneksi = mysqli_connect($company['host_database'], $company['user_database'], $company['pass_database'], $company['nama_database']);
        $query = mysqli_query($koneksi, "SELECT * FROM customer");
        $jumlah_pelanggan = mysqli_num_rows($query);
        ?>
        <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data Tagihan Pelanggan (<?= $jumlah_pelanggan; ?> item)</h6>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="tablebt" width="100%" cellspacing="0">
                <thead>
                    <tr style="text-align: center;">
                        <th>ID</th>
                        <th>Nomor</th>
                        <th>Nama</th>
                        <th>WhatsApp</th>
                        <th>Tgl</th>
                        <th>Lunas</th>
                        <th>Status</th>
                        <?php if ($this->session->userdata('role_id') == 1) { ?>
                            <th>Aksi</th>
                        <?php } ?>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    while ($datagua = mysqli_fetch_array($query)) {
                        $no_services = $datagua['no_services'];
                    ?>
                        <tr style="height: 20px;">
                            <td style="text-align: center; width: 7%;"><?= $datagua['customer_id'] ?></td>
                            <td style="text-align: center; width: 17%;"><?= $datagua['no_services'] ?></td>
                            <td><?= $datagua['name'] ?></td>
                            <td style="text-align: center; width: 15%;"><?= $datagua['no_wa'] ?></td>
                            <td style="text-align: center; width: 7%;"><?= $datagua['due_date'] ?></td>
                            <?php
                            $query11 = mysqli_query($koneksi, "SELECT * FROM invoice WHERE no_services='$no_services'");
                            $jumlah_tagihan = mysqli_num_rows($query11);
                            $id = $datagua['customer_id'];
                            ?>
                            <td style="text-align: center; width: 10%;"><?= $jumlah_tagihan; ?> Kali</td>
                            <td style="text-align: center; width: 11%;"><?= $datagua['c_status'] ?></td>
                            <?php if ($this->session->userdata('role_id') == 1) { ?>
                                <td style="text-align: center; width: 7%;">
                                    <a href="<?= site_url('laporan/delete/' . $id) ?>" onclick="return confirm('Apakah anda yakin akan menghapus data customer <?= $datagua['name'] ?> ?')" title="Delete">
                                        <i class="fa fa-whatsapp" style="font-size:25px; color:green;"></i>
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
                                            $role = 'Customer';
                                        } elseif ($data10['role_id'] == 3) {
                                            $role = 'Operator';
                                        } elseif ($data10['role_id'] == 4) {
                                            $role = 'Backuper';
                                        } elseif ($data10['role_id'] == 5) {
                                            $role = 'Karyawan';
                                        } elseif ($data10['role_id'] == 6) {
                                            $role = 'Kasir';
                                        } elseif ($data10['role_id'] == 7) {
                                            $role = 'Reseller';
                                        } elseif ($data10['role_id'] == 8) {
                                            $role = 'Promoter';
                                        } elseif ($data10['role_id'] == 9) {
                                            $role = 'Investor';
                                        } else {
                                            $role = 'Tidak Dikenal';
                                        }
                                    ?>
                                        <option value="<?php echo $data10['email']; ?>"><?php echo $data10['name']; ?> (<?= $role ?>)</option>
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
                                <label for="nominal">Judul Pesan</label>
                                <input type="text" id="judul_pesan" name="judul_pesan" class="form-control">
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
                                <input type="hidden" id="tiket_pesan" name="tiket_pesan" value="#TN<?= date('HisYmd') ?>-<?= $user['id']; ?>" class="form-control">
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