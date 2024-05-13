 <?php $this->view('messages') ?>
 <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <?php if ($this->session->userdata('role_id') == 1) { ?>
        <a href="" id="#addModal" data-toggle="modal" data-target="#addModal" class="d-sm-inline-block btn btn-sm btn-<?= $company['theme'] ?> shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data</a>
    <?php } ?>
</div>
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
         <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>;">Data Akun Sosial Media</h6>
     </div>
     <div class="card-body">
         <div class="table-responsive">
             <table class="table table-bordered table-responsive" id="dataTable" width="100%" cellspacing="0">
                 <thead>
                     <tr style="height: 30px;">
                         <th style="text-align: center; width: 5%;">No</th>
                         <th style="text-align: center;">Username</th>
                         <th style="text-align: center;">Email</th>
                         <th style="text-align: center;">Password</th>
                         <th style="text-align: center;">Platform</th>
                         <th style="text-align: center;">Aksi</th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php
                        $no = 1;
                        foreach ($sosmed as $data) {
                        ?>
                         <tr style="height: 30px;">
                             <td style="text-align: center; width: 5%;"><?= $no++ ?></td>
                             <td style="text-align: center;"><?= $data->username ?></td>
                             <td style="text-align: left;"><?= $data->email ?></td>
                             <td style="text-align: center;"><?= $data->password ?></td>
                             <td style="text-align: center;"><?= $data->platform ?></td>
                             <td style="text-align: center;">
                                 <?php if ($this->session->userdata('role_id') == 1) { ?>
                                    <a href="" class="btn btn-outline-secondary" data-toggle="modal" data-target="#editModal<?= $data->id_sosmed ?>" title="Hapus"><i class="fa fa-edit" style="text-decoration: none; color: green; width: 25px; font-size: 20px;"></i></a>
                                    <a href="" class="btn btn-outline-secondary" data-toggle="modal" data-target="#DeleteModal<?= $data->id_sosmed ?>" title="Hapus"><i class="fa fa-trash" style="text-decoration: none; color: red; width: 25px; font-size: 20px;"></i></a>
                                 <?php } ?>
                             </td>
                         </tr>
                         <div class="modal fade" id="editModal<?= $data->id_sosmed ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Akun Sosial Media</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php echo form_open_multipart('setting/editsosmed') ?>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="name">Username Login</label>
                                                    <input type="text" name="username" id="username" class="form-control" value="<?= $data->username ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="name">Password Login</label>
                                                    <input type="text" name="password" id="password" class="form-control" value="<?= $data->password ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Alamat Email Login</label>
                                            <input type="email" name="email" id="email" class="form-control" value="<?= $data->email ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">URL Login Aplikasi</label>
                                            <input type="text" name="url_login" id="url_login" class="form-control" value="<?= $data->url_login ?>" required>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="name">Platform Sosmed</label>
                                                    <input type="text" name="platform" id="platform" class="form-control" value="<?= $data->platform ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="name">Ditambah Pada</label>
                                                    <input type="text" name="updated" id="updated" class="form-control" value="<?= date('d/m/Y H:i:s') ?> WIB" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button type="submit" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>">Simpan</button>
                                        </div>
                                        <?php echo form_close() ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="DeleteModal<?= $data->id_sosmed ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Data Sosial Media</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php echo form_open_multipart('setting/delsosmed/'.$data->id_sosmed) ?>
                                        Apakah yakin akan hapus Data Sosial Media <?= $data->username ?> - <?= $data->platform ?> ?
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </div>
                                        <?php echo form_close() ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                     <?php } ?>
                 </tbody>
             </table>
         </div>
     </div>
 </div>
 <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Akun Sosial Media</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('setting/addsosmed') ?>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Username Login</label>
                            <input type="text" name="username" id="username" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Password Login</label>
                            <input type="text" name="password" id="password" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Alamat Email Login</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="name">URL Login Aplikasi</label>
                    <input type="text" name="url_login" id="url_login" class="form-control" required>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Platform Sosmed</label>
                            <input type="text" name="platform" id="platform" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Ditambah Pada</label>
                            <input type="text" name="updated" id="updated" class="form-control" value="<?= date('d/m/Y H:i:s') ?> WIB" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>">Simpan</button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>