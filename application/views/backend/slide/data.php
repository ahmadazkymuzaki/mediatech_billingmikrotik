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
    <a href="" data-toggle="modal" data-target="#ModalAdd" class="d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Slide</a>

</div>
<!-- DataTales Example -->
<div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
    <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
        <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data Slide</h6>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Picture</th>
                        <th>Deskripsi</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($slide as $r => $data) { ?>
                        <tr>
                            <td width="35px"><?= $no++ ?>.</td>
                            <td><?= $data->name ?></td>
                            <td class="text-center"><img src="<?= site_url() ?>assets/images/slide/<?= $data->picture ?>" alt="" style="width:100px"></td>
                            <td><?= $data->description ?></td>
                            <td class="text-center" width="160px">
                                <form>
                                    <a class="btn btn-xs btn-<?= $company['theme'] ?>" href="#ModalEdit<?= $data->slide_id ?>" data-toggle="modal" title="Edit"><i class="fa fa-edit"> </i></a>
                                    <a class="btn btn-xs btn-danger" href="#ModalHapus<?= $data->slide_id ?>" data-toggle="modal" title="Hapus"><i class="fa fa-trash"></i></a>
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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Slide</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?= site_url('slider/add') ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="picture">Picture</label>
                            <input type="file" class="form-control" id="picture" name="picture" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea type="text" class="form-control" id="description" name="description" autocomplete="off"> </textarea>
                        </div>
                        <div class="form-group">
                            <label for="link">Link</label>
                            <input type="text" class="form-control" id="link" name="link" autocomplete="off">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>" id="btn_simpan"> Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--END MODAL ADD-->

    <!-- MODAL eDIT -->
    <?php foreach ($slide as $data) { ?>
        <div class="modal fade" id="ModalEdit<?= $data->slide_id ?>" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="formModalLabel">Edit slide</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="<?= site_url('slider/edit') ?>" enctype="multipart/form-data">
                            <input type="hidden" name="slide_id" value="<?= $data->slide_id ?>" class="form-control">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= $data->name ?>" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="picture">Picture</label>
                                <input type="file" class="form-control" id="picture" name="picture" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea type="text" class="form-control" id="description" name="description" autocomplete="off"> <?= $data->description ?> </textarea>
                            </div>
                            <div class="form-group">
                                <label for="link">Link</label>
                                <input type="text" class="form-control" id="link" name="link" value="<?= $data->link ?>" autocomplete="off">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>"> Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <!--END MODAL eDIT-->

    <!-- MODAL Hapus -->
    <?php foreach ($slide as $data) { ?>
        <div class="modal fade" id="ModalHapus<?= $data->slide_id ?>" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="formModalLabel">Hapus Slide</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="<?= site_url('slider/delete') ?>" enctype="multipart/form-data">
                            <input type="hidden" name="slide_id" value="<?= $data->slide_id ?>" class="form-control">
                            Apakah anda yakin akan hapus slide <?= $data->name ?> ?

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-danger"> Ya, lanjutkan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <!--END MODAL Hapus-->