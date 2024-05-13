<link rel="stylesheet" href="<?= base_url('assets/backend') ?>/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <?php if ($this->session->userdata('role_id') == 1) { ?>
        <a href="" data-toggle="modal" data-target="#formModalAutoReply" class="d-sm-inline-block btn btn-sm btn-<?= $company['theme'] ?> shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Auto Reply</a>
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
        $data_autoreply = mysqli_query($koneksi, "SELECT * FROM autoreply");
        $jumlah_autoreply = mysqli_num_rows($data_autoreply);
        ?>
        <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data Auto Reply (<?= $jumlah_autoreply; ?> item)</h6>
    </div>
    <div class="card-body">
        <section class="content">
            <div class="box">
                <div class="table-responsive">
                    <table class="table table-bordered" id="tablebt" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th width="5%">No</th>
                                <th width="20%">Kata Kunci</th>
                                <th width="55%">Pesas Balasan</th>
                                <th width="15%">Status</th>
                                <th width="5%">Aksi</i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($autoreply as $p) :
                            ?>
                                <tr>
                                    <td class="text-center" width="5%"><?= $no++; ?></td>
                                    <td class="text-center" width="20%"><?= $p['keyword']; ?></td>
                                    <td width="55%"><?= $p['response']; ?></td>
                                    <td class="text-center" width="15%"><?= $p['status']; ?></td>
                                    <td class="text-center" width="5%">
                                        <a href="<?= base_url('/whatsapp/hapusAutoReply/') . $p['id_reply']; ?>" onclick="return confirm('Apakah anda yakin akan menghapus data autoreply <?= $p['keyword'] ?> ?')" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                    </td>


                                    <?php
                                    $koneksi = mysqli_connect("localhost", "root", "", "naufal");
                                    $id_reply = $p['id_reply'];
                                    $query = "SELECT * FROM autoreply WHERE id_reply='$id_reply'";
                                    $hasil = mysqli_query($koneksi, $query);
                                    $data  = mysqli_fetch_array($hasil);
                                    ?>
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
<div class="modal fade" id="formModalAutoReply" tabindex="-1" aria-labelledby="formModalLabelAutoReply" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabelAutoReply">Tambah Data Auto Reply</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('/whatsapp/tambahAutoReply') ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label><i>Kata Kunci</i></label>
                                <input type="text" name="keyword" id="keyword" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label><i>Status Pesan</i></label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value=""> -- Pilih Status Pesan --</option>
                                    <option value="Case Sensitive">Case Sensitive</option>
                                    <option value="Non-Sensitive">Non-Sensitive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><i>Pesan Balasan</i></label>
                        <textarea type="text" name="response" id="response" class="form-control" required></textarea>
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
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor1');
</script>