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
            <?php $id = $layanan['id_layanan']; ?>
            <?= $layanan['judul_layanan']; ?> (<?= $layanan['nama_pelanggan']; ?>) -
            <?php
            if ($layanan['status_layanan'] == 'Disetujui') {
            ?>
                <font style="color: green;"><i><?= $layanan['status_layanan']; ?></i></font>
            <?php
            }
            ?>
            <?php
            if ($layanan['status_layanan'] == 'Pending') {
            ?>
                <font style="color: orange;"><i><?= $layanan['status_layanan']; ?></i></font>
            <?php
            }
            ?>
            <?php
            if ($layanan['status_layanan'] == 'Ditolak') {
            ?>
                <font style="color: red;"><i><?= $layanan['status_layanan']; ?></i></font>
            <?php
            }
            ?>
        </h6>

    </div>
    <div class="card-body">
        <?= $layanan['deskripsi_layanan']; ?>
        <br>Alasan :
        <br><?= $layanan['alasan_layanan']; ?>
    </div>
    <div class="card-footer">
        <a href="<?= site_url('layanan/data'); ?>" title="Kembali">
            <input type="button" class="d-sm-inline-block btn btn-sm btn-secondary shadow-sm pull-left" style="margin-right: 10px;" value="Kembali" readonly>
        </a>
        <?php
        if ($this->session->userdata('role_id') == 1) { ?>
            <a href="<?= site_url('layanan/deletelayanan/' . $id) ?>" class="d-sm-inline-block btn btn-sm btn-danger shadow-sm pull-right" onclick="return confirm('Apakah anda yakin akan menghapus data ajuan layanan <?= $layanan['judul_layanan'] ?> dari <?= $layanan['nama_pelanggan']; ?> ?')" title="Hapus">
                <!-- <i class="fas fa-trash fa-sm text-white-50"></i> -->Hapus
            </a>
        <?php } ?>
        <?php
        if ($this->session->userdata('role_id') == 1) { ?>
            <a href="#" data-toggle="modal" data-target="#add" class="d-sm-inline-block btn btn-sm btn-<?= $company['theme'] ?> shadow-sm pull-left">
                <!-- <i class="fas fa-reply-all fa-sm text-white-50"></i> -->Konfirmasi
            </a>
        <?php } ?>
        <?php
        if ($this->session->userdata('role_id') == 1) { ?>
            <a href="" class="pull-left" style="text-decoration: none;">&nbsp;&nbsp;</a>
        <?php } ?>
    </div>
</div>
<!-- Modal Add -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Ajuan Layanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('layanan/kirim/' . $layanan['id_layanan']) ?>" method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nominal">Deskripsi Layanan</label>
                                <textarea type="text" rows="2" readonly name="deskripsi_layanan" id="deskripsi_layanan" class="form-control"><?= $layanan['deskripsi_layanan']; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nominal">Judul Layanan</label>
                                <input type="text" id="judul_layanan" name="judul_layanan" value="<?= $layanan['judul_layanan']; ?>" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nominal">Status Layanan</label>
                                <select class="form-control" id="status_layanan" name="status_layanan">
                                    <option value="<?= $layanan['status_layanan']; ?>"><?= $layanan['status_layanan']; ?></option>
                                    <option value="Ditolak">Tolak</option>
                                    <option value="Disetujui">Setujui</option>
                                    <option value="Pending">Tunggu</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="remark">Catatan</label>
                        <textarea type="text" rows="3" name="catatan_layanan" id="catatan_layanan" class="form-control">Pengajuan Anda disetujui pada <?= date('d/m/Y H:i:s') ?> WIB. Total tagihan bulanan Anda akan kami akumulasikan kembali pada Periode <?php $bulan_sekarang = date('m');
                                                                                                                                                                                                                                                                $periode_berikutnya = $bulan_sekarang + 01;
                                                                                                                                                                                                                                                                echo indo_month($periode_berikutnya); ?> <?= date('Y') ?> (tagihan di bulan berikutnya).</textarea>
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
        $no = 1;
        $koneksi = mysqli_connect($company['host_database'], $company['user_database'], $company['pass_database'], $company['nama_database']);
        $nomor_layanan = $layanan['nomor_layanan'];
        $myquery = mysqli_query($koneksi, "SELECT * from layanan where nomor_layanan='$nomor_layanan' order by diajukan_pada DESC");
        $jumlah_layanan = mysqli_num_rows($myquery);
        ?>
        <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data Ajuan Layanan <?= $layanan['nomor_layanan']; ?> - <?= $layanan['nama_pelanggan']; ?> (<?= $jumlah_layanan; ?> item)</h6>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="tablebt" width="100%" cellspacing="0">
                <thead>
                    <tr style="text-align: center;">
                        <th>No.</th>
                        <th>Judul</th>
                        <th>Pada</th>
                        <th>Status</th>
                        <th>Catatan</th>
                        <?php if ($this->session->userdata('role_id') == 1) { ?>
                            <th>Aksi</th>
                        <?php } ?>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    while ($datagua = mysqli_fetch_array($myquery)) {
                        $id = $datagua['id_layanan'];
                    ?>
                        <tr style="text-align: left; height: 25px; margin:auto;">
                            <td style="text-align: center;"><?= $no++ ?></td>
                            <td><?= $datagua['judul_layanan']; ?></td>
                            <td style="text-align: center;"><?= $datagua['diajukan_pada']; ?></td>
                            <td style="text-align: center;"><?= $datagua['status_layanan']; ?></td>
                            <td><?= $datagua['catatan_layanan']; ?></td>
                            <?php if ($this->session->userdata('role_id') == 1) { ?>
                                <td style="text-align: center;">
                                    <a href="<?= site_url('layanan/deletelayanan/' . $id) ?>" title="Delete">
                                        <i class="fa fa-trash" style="font-size:25px; color:red;"></i>
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