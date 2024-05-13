<div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
    <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
        <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>"> <?= $title ?>
            <small>Tabel Data</small>
        </h6>

    </div>
    <div class="card-body">
        <?php if ($this->session->userdata('role_id') == 1) { ?>
            <!-- Content Header (Page header) -->
            <section class="content">
                <div class="box">
                    <div class="box-header">

                        <div class="pull-right mb-2">
                            <a href="<?= site_url('user/register') ?>" class="btn btn-flat btn-<?= $company['theme'] ?>">
                                <i class="fa fa-plus"></i> Tambah Pengguna
                            </a>
                        </div>
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
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-bordered">
                            <thead>
                                <tr style="text-align: center">
                                    <th style="text-align: center; width:20px">No</th>
                                    <th>Name</th>
                                    <!-- 
                                    <th>Picture</th> -->
                                    <th>Phone</th>
                                    <!-- 
                                    <th>Address</th> -->
                                    <th>Status</th>
                                    <th>Level</th>
                                    <th style="text-align: center;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($row as $r => $data) { ?>
                                    <tr>
                                        <td width="35px"><?= $no++ ?>.</td>
                                        <td><?= $data->name ?></td>
                                        <!-- 
                                        <td class="text-center"><img src="<?= site_url('assets/') ?>images/profile/<?= $data->image ?>" alt="" style="width:200px; "></td> -->
                                        <td style="text-align: center;"><?= $data->phone ?></td>
                                        <!-- 
                                        <td><?= $data->address ?></td> -->
                                        <td style="text-align: center;"><?= $data->is_active == 1 ? 'Aktif' : 'Non-Aktif' ?></td>
                                        <td style="text-align: center;">
                                            <?= $data->role_id == 1 ? 'Admin / Owner' : '' ?>
                                            <?= $data->role_id == 2 ? 'Member PPPOE' : '' ?>
                                            <?= $data->role_id == 3 ? 'Member HOTSPOT' : '' ?>
                                            <?= $data->role_id == 4 ? 'Resellr HOTSPOT' : '' ?>
                                            <?= $data->role_id == 5 ? 'Sales PPPOE' : '' ?>
                                            <?= $data->role_id == 6 ? 'Operator Jaringan' : '' ?>
                                            <?= $data->role_id == 7 ? 'Customer Service' : '' ?>
                                            <?= $data->role_id == 8 ? 'Teknisi / Karyawan' : '' ?>
                                            <?= $data->role_id == 9 ? 'Member PREMIUM' : '' ?>
                                            <?= $data->role_id == 10 ? 'Bill Collector' : '' ?>
                                            <br><?= $data->no_services ?>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-xs btn-<?= $company['theme'] ?>" href="<?= site_url('user/edit_user/') ?><?= $data->id ?>" title="Edit"><i class="fa fa-edit"> </i></a>
                                            <a class="btn btn-xs btn-success" target="_blank" href="<?= site_url('cetak/karyawan/') ?><?= $data->id ?>" title="Edit"><i class="fa fa-print"> </i></a>
                                            <?php if ($data->id != $this->session->userdata('id')) { ?>
                                                <a class="btn btn-xs btn-danger" href="#ModalHapus<?= $data->id ?>" data-toggle="modal" title="Hapus"><i class="fa fa-trash"></i></a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <!-- MODAL eDIT -->

            <!--END MODAL eDIT-->
            <!-- MODAL Hapus -->
            <?php foreach ($row as $data) { ?>
                <div class="modal fade" id="ModalHapus<?= $data->id ?>" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="formModalLabel">Delete User</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="<?= site_url('user/del') ?>" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?= $data->id ?>" class="form-control">
                                    Apakah anda yakin akan hapus user <?= $data->name ?> ?

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button class="btn btn-danger"> Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <!--END MODAL Hapus-->
        <?php } ?>
    </div>
</div>