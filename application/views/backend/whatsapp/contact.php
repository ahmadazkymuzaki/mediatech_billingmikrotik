<link rel="stylesheet" href="https://files.billing.or.id/assets/backend/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <?php if ($this->session->userdata('role_id') == 1) { ?>
        <a href="" data-toggle="modal" data-target="#formModalContact" class="d-sm-inline-block btn btn-sm btn-<?= $company['theme'] ?> shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Kontak</a>
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
        $koneksi = mysqli_connect($company['host_database'], $company['user_database'], $company['pass_database'], $company['nama_database']);
        $data_contact = mysqli_query($koneksi, "SELECT * FROM campaign");
        $jumlah_contact = mysqli_num_rows($data_contact);
        ?>
        <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data Kontak (<?= $jumlah_contact; ?> item)</h6>
    </div>
    <div class="card-body">
        <section class="content">
            <div class="box">
                <div class="table-responsive">
                    <table class="table table-bordered" id="tablebt" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama Kontak</th>
                                <th>No. WhatsApp</th>
                                <th>Kategori</th>
                                <th>update</th>
                                <th>Aksi</th>
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
                                    <td class="text-center"><?= $p->kategori_kontak; ?></td>
                                    <td class="text-center"><?= $p->update_campaign; ?></td>
                                    <td class="text-center">
                                        <a href="<?= site_url() ?>whatsapp/hapusContact/<?= $p->id_campaign ?>" class="btn btn-danger">HAPUS</a>
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
                <h5 class="modal-title" id="formModalLabelContact">Tambah Data Kontak</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('/whatsapp/tambahContact') ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label><i>Nama Kontak</i></label>
                        <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label><i>Nomor WhatsApp</i></label>
                        <input type="text" name="nomor_whatsapp" id="nomor_whatsapp" class="form-control" placeholder="085334748768" required>
                    </div>
                    <div class="form-group">
                        <label><i>Kategori Kontak</i></label>
                        <select name="kategori_kontak" id="kategori_kontak" class="form-control" required>
                            <option value=""> -- Pilih Kategori --</option>
                            <option value="PELANGGAN">PELANGGAN</option>
                            <option value="KARYAWAN">KARYAWAN</option>
                            <option value="OPERATOR">OPERATOR</option>
                            <option value="RESELLER">RESELLER</option>
                            <option value="SALES">SALES</option>
                            <option value="SERVICE">SERVICE</option>
                            <option value="TAMBAHAN">TAMBAHAN</option>
                            <option value="GRUP WA">GRUP WA</option>
                        </select>
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