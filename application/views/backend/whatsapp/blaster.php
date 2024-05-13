<link rel="stylesheet" href="<?= base_url('assets/backend') ?>/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <?php if ($this->session->userdata('role_id') == 1) { ?>
        <a href="" data-toggle="modal" data-target="#formModalContact" class="d-sm-inline-block btn btn-sm btn-<?= $company['theme'] ?> shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Pesan Terjadwal</a>
    <?php } ?>
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
        $koneksi = mysqli_connect("localhost", "root", "", "naufal");
        $data_blaster = mysqli_query($koneksi, "SELECT * FROM blaster");
        $jumlah_blaster = mysqli_num_rows($data_blaster);
        ?>
        <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data Pesan Terjadwal (<?= $jumlah_blaster; ?> item)</h6>
    </div>
    <div class="card-body">
        <section class="content">
            <div class="box">
                <div class="table-responsive">
                    <table class="table table-bordered" id="tablebt" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th width="5%">No</th>
                                <th width="15%">Penerima</th>
                                <th width="30%">Pesan Whatsapp</th>
                                <th width="15%">Waktu</th>
                                <th width="15%">Tanggal</th>
                                <th width="12%">Aksi</i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($blaster as $p) :
                            ?>
                                <tr>
                                    <td class="text-center" width="5%"><?= $no++; ?></td>
                                    <td class="text-center" width="15%"><?= $p['target_wa']; ?></td>
                                    <td class="text-center" width="30%"><b><?= $p['header_wa']; ?><br><br><img src="<?= base_url() ?>assets/images/pesan/<?= $p['media_wa']; ?>" alt="" style="height:100px;"><br><br><?= $p['content_wa']; ?><br><br><?= $p['footer_wa']; ?></td>
                                    <td class="text-center" width="15%"><?= $p['sent_time']; ?> WIB</td>
                                    <td class="text-center" width="15%">
                                        <?php
                                        $send_date = $p['sent_date'];
                                        function tgl_indo($tanggal)
                                        {
                                            $bulan = array(
                                                1 =>   'Januari',
                                                'Februari',
                                                'Maret',
                                                'April',
                                                'Mei',
                                                'Juni',
                                                'Juli',
                                                'Agustus',
                                                'September',
                                                'Oktober',
                                                'November',
                                                'Desember'
                                            );
                                            $pecahkan = explode('-', $tanggal);

                                            // variabel pecahkan 0 = tanggal
                                            // variabel pecahkan 1 = bulan
                                            // variabel pecahkan 2 = tahun

                                            return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
                                        }
                                        echo tgl_indo($send_date);
                                        ?>
                                    </td>
                                    <td class="text-center" width="12%">
                                        <?php if ($p['target_wa'] != NULL) { ?>
                                            <button type="button" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?> tombolUbahPegawai" data-toggle="modal" data-target="#formModalDetail<?= $p['id_blaster']; ?>" data-id="<?= $p['id_blaster']; ?>"><i class="fas fa-eye"></i></button>
                                        <?php } ?>
                                        <button type="button" class="btn btn-success tombolUbahPegawai" data-toggle="modal" data-target="#formModalEdit<?= $p['id_blaster']; ?>" data-id="<?= $p['id_blaster']; ?>"><i class="fas fa-edit"></i></button>
                                        <?php if ($p['target_wa'] == NULL) { ?>
                                            <a href="<?= base_url('/whatsapp/hapusContact/') . $p['id_blaster']; ?>" onclick="return confirm('Apakah anda yakin akan menghapus data contact <?= $p['header_wa']; ?> ?')" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="formModalContact" tabindex="-1" aria-labelledby="formModalLabelContact" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabelContact">Tambah Data Pesan Terjadwal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('/whatsapp/tambahBlaster') ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label><i>Penerima Pesan</i></label>
                        <select name="target_wa" id="target_wa" class="selectpicker form-control" data-live-search="true" required>
                            <option value=""> -- Pilih Penerima Pesan --</option>
                            <option value="Tambahan">Ke Seluruh Kontak Tambahan</option>
                            <option value="Pelanggan">Ke Seluruh Pelanggan Aktif</option>
                            <option value="Karyawan">Ke Seluruh Karyawan Aktif</option>
                            <option value="Operator">Ke Seluruh Operator Aktif</option>
                            <option value="Backuper">Ke Seluruh Backuper Aktif</option>
                            <option value="Teknisi">Ke Seluruh Teknisi Aktif</option>
                            <option value="Kasir">Ke Seluruh Kasir Aktif</option>
                            <option value="Reseller">Ke Seluruh Reseller Aktif</option>
                            <option value="Promoter">Ke Seluruh Promoter Aktif</option>
                            <option value="Investor">Ke Seluruh Investor Aktif</option>
                            <option value="Pengguna">Ke Seluruh Pengguna Aktif (kecuali admin)</option>
                            <option value="Semua">Ke Seluruh Pengguna Aktif (termasuk admin)</option>
                            <?php
                            $koneksi = mysqli_connect("localhost", "root", "", "naufal");
                            $queryku = mysqli_query($koneksi, "SELECT * FROM user WHERE role_id != 1 AND is_active = 1");
                            while ($dataku = mysqli_fetch_array($queryku)) {
                                if ($dataku['role_id'] == 1) {
                                    $jabatannya = 'Admin';
                                } elseif ($dataku['role_id'] == 2) {
                                    $jabatannya = 'Pelanggan';
                                } elseif ($dataku['role_id'] == 3) {
                                    $jabatannya = 'Operator';
                                } elseif ($dataku['role_id'] == 4) {
                                    $jabatannya = 'Backuper';
                                } elseif ($dataku['role_id'] == 5) {
                                    $jabatannya = 'Karyawan';
                                } elseif ($dataku['role_id'] == 6) {
                                    $jabatannya = 'Kasir';
                                } elseif ($dataku['role_id'] == 7) {
                                    $jabatannya = 'Reseller';
                                } elseif ($dataku['role_id'] == 8) {
                                    $jabatannya = 'Promoter';
                                } elseif ($dataku['role_id'] == 9) {
                                    $jabatannya = 'Investor';
                                } else {
                                    $jabatannya = 'tidak diketahui';
                                }
                            ?>
                                <option value="<?= $dataku['phone']; ?>"><?= $dataku['name']; ?> (<?= $jabatannya ?>)</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><i>Header Konten</i></label>
                        <input type="text" name="header_wa" id="header_wa" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label><i>Media WhatsApp</i></label>
                        <input type="file" name="media_wa" id="media_wa" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label><i>Pesan WhatsApp</i></label>
                        <textarea type="text" name="content_wa" id="content_wa" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label><i>Footer Konten</i></label>
                        <input type="text" name="footer_wa" id="footer_wa" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label><i>Tanggal Pengiriman</i></label>
                                <input type="date" name="sent_date" id="sent_date" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label><i>Waktu Pengiriman</i></label>
                                <input type="time" name="sent_time" id="sent_time" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger" data-dismiss="modal">Reset</button>
                        <button type="submit" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>