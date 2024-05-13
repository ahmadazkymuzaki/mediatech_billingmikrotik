<section class="section">

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
</section>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <a href="" data-toggle="modal" data-target="#ModalAdd" class="d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Promo</a>

</div>
<!-- DataTales Example -->
<div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
    <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
        <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data Promo</h6>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="text-align: center;">No</th>
                        <th style="text-align: center;">Judul Promo</th>
                        <th style="text-align: center;">Gambar Promo</th>
                        <th style="text-align: center;">Konten Promo</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($promo as $r => $data) { ?>
                        <tr>
                            <td width="35px"><?= $no++ ?>.</td>
                            <td><?= $data->judul_promo ?></td>
                            <td class="text-center"><img src="<?= site_url() ?>assets/images/promo/<?= $data->gambar_promo ?>" alt="" style="width:100px"></td>
                            <td><?= $data->konten_promo ?></td>
                            <td class="text-center" width="160px">
                                <form>
                                    <a class="btn btn-xs btn-<?= $company['theme'] ?>" href="#ModalEdit<?= $data->kode_promo ?>" data-toggle="modal" title="Edit"><i class="fa fa-edit"> </i></a>
                                    <a class="btn btn-xs btn-danger" href="#ModalHapus<?= $data->kode_promo ?>" data-toggle="modal" title="Hapus"><i class="fa fa-trash"></i></a>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- MODAL ADD -->
    <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Promo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?= site_url('promo/add') ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 pt-2">
                                    <label for="waktu_promo">Dibuat Pada</label>
                                    <input type="text" class="form-control" id="waktu_promo" name="waktu_promo" value="<?= date('d-m-Y H:i:s'); ?> WIB" readonly>
                                </div>
                                <div class="col-md-3 pt-2">
                                    <label for="kode_promo">Kode Promo</label>
                                    <input type="text" class="form-control" id="kode_promo" name="kode_promo" required>
                                </div>
                                <div class="col-md-6 pt-2">
                                    <label for="judul_promo">Judul Promo</label>
                                    <input type="text" class="form-control" id="judul_promo" name="judul_promo" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 pt-2">
                                    <label for="gambar_promo">Gambar</label>
                                    <input type="file" class="form-control" id="gambar_promo" name="gambar_promo" required>
                                </div>
                                <div class="col-md-3 pt-2">
                                    <label for="mulai_promo">Mulai Tanggal</label>
                                    <input type="date" class="form-control" id="mulai_promo" name="mulai_promo" required>
                                </div>
                                <div class="col-md-3 pt-2">
                                    <label for="akhir_promo">Sampai Tanggal</label>
                                    <input type="date" class="form-control" id="akhir_promo" name="akhir_promo" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="konten_promo">Konten</label>
                            <textarea type="text" class="form-control" id="editor1" name="konten_promo" required> </textarea>
                            <input type="hidden" class="form-control" id="admin_promo" name="admin_promo" value="<?= $user['name']; ?>" readonly>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>" id="btn_simpan"> Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!--END MODAL ADD-->

    <!-- MODAL eDIT -->
    <?php foreach ($promo as $data) { ?>
        <div class="modal fade" id="ModalEdit<?= $data->kode_promo ?>" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Promo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="<?= site_url('promo/edit') ?>" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3 pt-2">
                                        <label for="waktu_promo">Dibuat Pada</label>
                                        <input type="text" class="form-control" id="waktu_promo" name="waktu_promo" value="<?= $data->waktu_promo ?>" readonly>
                                    </div>
                                    <div class="col-md-3 pt-2">
                                        <label for="kode_promo">Kode Promo</label>
                                        <input type="text" class="form-control" id="kode_promo" name="kode_promo" value="<?= $data->kode_promo ?>" required>
                                    </div>
                                    <div class="col-md-6 pt-2">
                                        <label for="judul_promo">Judul Promo</label>
                                        <input type="text" class="form-control" id="judul_promo" name="judul_promo" value="<?= $data->judul_promo ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6 pt-2">
                                        <label for="gambar_promo">Gambar</label>
                                        <input type="file" class="form-control" id="gambar_promo" name="gambar_promo">
                                    </div>
                                    <div class="col-md-3 pt-2">
                                        <label for="mulai_promo">Mulai Tanggal</label>
                                        <input type="date" class="form-control" id="mulai_promo" name="mulai_promo" value="<?= $data->mulai_promo ?>" required>
                                    </div>
                                    <div class="col-md-3 pt-2">
                                        <label for="akhir_promo">Sampai Tanggal</label>
                                        <input type="date" class="form-control" id="akhir_promo" name="akhir_promo" value="<?= $data->akhir_promo ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="konten_promo">Konten</label>
                                <textarea type="text" class="form-control" id="editor2" name="konten_promo" required><?= $data->konten_promo ?></textarea>
                                <input type="hidden" class="form-control" id="admin_promo" name="admin_promo" value="<?= $data->admin_promo ?>" readonly>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>" id="btn_simpan"> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<!--END MODAL eDIT-->

<!-- MODAL Hapus -->
<?php foreach ($promo as $data) { ?>
    <div class="modal fade" id="ModalHapus<?= $data->kode_promo ?>" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="formModalLabel">Hapus Promo</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?= site_url('promo/delete') ?>" enctype="multipart/form-data">
                        <input type="hidden" name="kode_promo" value="<?= $data->kode_promo ?>" class="form-control">
                        Apakah anda yakin akan hapus promo <?= $data->judul_promo ?> ?

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button class="btn btn-danger"> Ya, lanjutkan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<!--END MODAL Hapus-->
<script src="https://cdn.ckeditor.com/4.16.1/standard-all/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor1');
</script>
<script>
    CKEDITOR.replace('editor2');
</script>