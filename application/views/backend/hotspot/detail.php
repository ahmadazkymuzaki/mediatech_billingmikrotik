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
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <a href="<?= site_url('hotspot/users'); ?>" title="Kembali">
        <input type="button" class="btn btn-danger" value="Close" readonly>
    </a>
</div>
<div class="row">
    <div class="col-lg-6">
        <div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
            <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
                <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Detail Pengguna</h6>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-body">
                        <table>
                            <?php
                            function formatBytes($bytes, $decimal = null)
                            {
                                $satuan = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
                                $i = 0;
                                while ($bytes > 1024) {
                                    $bytes /= 1024;
                                    $i++;
                                }
                                return round($bytes, $decimal) . ' ' . $satuan[$i];
                            }

                            foreach ($hotspotuser as $dataku) {
                                $id = str_replace('*', '', $dataku['.id'])
                            ?>
                                <tr>
                                    <td>Nama Pengguna</td>
                                    <td>&nbsp;&nbsp;&nbsp;</td>
                                    <td>:</td>
                                    <td>&nbsp;</td>
                                    <td><?= $dataku['name'] ?></td>
                                </tr>
                                <tr>
                                    <td>Password Akun</td>
                                    <td>&nbsp;&nbsp;&nbsp;</td>
                                    <td>:</td>
                                    <td>&nbsp;</td>
                                    <td><?= $dataku['password'] ?></td>
                                </tr>
                                <tr>
                                    <td>Paket Voucher</td>
                                    <td>&nbsp;&nbsp;&nbsp;</td>
                                    <td>:</td>
                                    <td>&nbsp;</td>
                                    <td><?= $dataku['profile'] ?></td>
                                </tr>
                                <tr>
                                    <td>Download Terpakai</td>
                                    <td>&nbsp;&nbsp;&nbsp;</td>
                                    <td>:</td>
                                    <td>&nbsp;</td>
                                    <td><?= formatBytes($dataku['bytes-out'], 2) ?></td>
                                </tr>
                                <tr>
                                    <td>Upload Terpakai</td>
                                    <td>&nbsp;&nbsp;&nbsp;</td>
                                    <td>:</td>
                                    <td>&nbsp;</td>
                                    <td><?= formatBytes($dataku['bytes-in'], 3) ?></td>
                                </tr>
                                <tr>
                                    <td>Status User</td>
                                    <td>&nbsp;&nbsp;&nbsp;</td>
                                    <td>:</td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <?php
                                        if ($hotspotuser['0']['disabled'] == 'true') {
                                            echo 'Isolir';
                                        } elseif (count($hotspotactive) > 0) {
                                            echo 'Aktif';
                                        } else {
                                            echo 'Tidak Aktif';
                                        } ?>
                                    </td>
                                </tr>
                                <!-- Modal Edit -->
                                <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit User <?= $dataku['name'] ?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?= site_url('hotspot/saveedit/' . $id) ?>" method="POST">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="nominal">Username</label>
                                                                <input type="text" id="name" name="name" value="<?= $dataku['name'] ?>" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="nominal">Password</label>
                                                                <input type="text" id="password" name="password" value="<?= $dataku['password'] ?>" class="form-control" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="nominal">Profile</label>
                                                                <select id="profile" name="profile" class="form-control">
                                                                    <option value="<?= $dataku['profile'] ?>"><?= $dataku['profile'] ?></option>
                                                                    <?php foreach ($hotspotprofile as $datagua) { ?>
                                                                        <option value="<?= $datagua['name'] ?>"><?= $datagua['name'] ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="nominal">Server</label>
                                                                <select id="server" name="server" class="form-control">
                                                                    <option value="<?= $dataku['server'] ?>"><?= $dataku['server'] ?></option>
                                                                    <?php foreach ($hotspotserver as $mydata) { ?>
                                                                        <option value="<?= $mydata['name'] ?>"><?= $mydata['name'] ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="remark">Komentar</label>
                                                        <input type="text" name="comment" id="comment" value="<?= $dataku['comment'] ?>" class="form-control">
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
                            <?php } ?>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <!-- <a href="<?= site_url('hotspot/users'); ?>" title="Kembali">
                            <input type="button" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>" value="<=&nbsp; Kembali" readonly>
                        </a> -->
                        <a href="#" data-toggle="modal" data-target="#edit" title="Edit User">
                            <input type="button" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>" value="Edit User" readonly>
                        </a>
                        <a href="<?= site_url('hotspot/reset/' . $id) ?>" onclick="return confirm('Apakah anda yakin akan reset counter data user <?= $dataku['name'] ?> ?')" title="Reset">
                            <input type="button" class="btn btn-warning" value="Reset Counter" readonly>
                        </a>
                        <?php if ($hotspotuser['0']['disabled'] == 'false') { ?>
                            <a href="<?= site_url('hotspot/disable/' . $id) ?>" onclick="return confirm('Apakah anda yakin akan disable data user <?= $dataku['name'] ?> ?')" title="Enable">
                                <input type="button" class="btn btn-secondary" value="Disable User" readonly>
                            </a>
                        <?php } ?>
                        <?php if ($hotspotuser['0']['disabled'] == 'true') { ?>
                            <a href="<?= site_url('hotspot/enable/' . $id) ?>" onclick="return confirm('Apakah anda yakin akan enable data user <?= $dataku['name'] ?> ?')" title="Disable">
                                <input type="button" class="btn btn-success" value="Enable User" readonly>
                            </a>
                        <?php } ?>
                        <a href="<?= site_url('hotspot/deleteuser/' . $id) ?>" onclick="return confirm('Apakah anda yakin akan menghapus data user <?= $dataku['name'] ?> ?')" title="Delete">
                            <input type="button" class="btn btn-danger" value="Delete User" readonly>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>