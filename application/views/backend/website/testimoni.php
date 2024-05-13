<div class="d-sm-flex align-items-center justify-content-between mb-4">


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
<!-- DataTales Example -->
<div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
    <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
        <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data testimoni</h6>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Testimoni</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($testimoni as $r => $data) { ?>
                        <tr>
                            <td width="35px"><?= $no++ ?>.</td>
                            <td><?= $data->name ?></td>
                            <td><?= $data->description ?></td>
                            <td><?= date('d M Y', $data->createdTestimoni) ?></td>
                            <td><?= $data->status ?></td>
                            <td class="text-center" width="160px">
                                <form>
                                    <a class="btn btn-xs btn-<?= $company['theme'] ?>" href="#ModalEdit<?= $data->testimoni_id ?>" data-toggle="modal" title="Edit"><i class="fa fa-close"></i> Edit</a>
                                    <a class="btn btn-xs btn-danger" href="#ModalHapus<?= $data->testimoni_id ?>" data-toggle="modal" title="Hapus"><i class="fa fa-close"></i> Hapus</a>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>


    <?php foreach ($testimoni as $data) { ?>
        <div class="modal fade" id="ModalEdit<?= $data->testimoni_id ?>" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="formModalLabel">Edit Testimoni</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="<?= site_url('master/editTestimoni') ?>" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="hidden" name="testimoni_id" value="<?= $data->testimoni_id ?>" class="form-control">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="<?= $data->status ?>"><?= $data->status ?></option>
                                    <option value="Publish">Publish</option>
                                    <option value="No Publish">No Publish</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>"> Simpan</button>
                    </form>
                </div>
            </div>
        </div>
</div>
<?php } ?>
<!-- MODAL Hapus -->
<?php foreach ($testimoni as $data) { ?>
    <div class="modal fade" id="ModalHapus<?= $data->testimoni_id ?>" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="formModalLabel">Hapus Testimoni</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?= site_url('master/del_testimoni') ?>" enctype="multipart/form-data">
                        <input type="hidden" name="testimoni_id" value="<?= $data->testimoni_id ?>" class="form-control">
                        Apakah anda yakin akan hapus testimoni dari <?= $data->name ?> ?

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>"> Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<!--END MODAL Hapus-->