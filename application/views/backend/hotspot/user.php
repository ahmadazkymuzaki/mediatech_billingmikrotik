<!-- bootstrap datepicker -->
<link rel="stylesheet" href="https://files.billing.or.id/assets/backend/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <a href="#" data-toggle="modal" data-target="#add" class="d-sm-inline-block btn btn-sm btn-<?= $company['theme'] ?> shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah</a>
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
        <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data Hotspot Users (<?= $totalhotspotuser; ?> item)</h6>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="tablebt" width="100%" cellspacing="0">
                <thead>
                    <tr style="text-align: center;">
                        <th width="5%">No</th>
                        <th width="10%">Username</th>
                        <th width="10%">Password</th>
                        <th width="12%">Profile</th>
                        <th width="12%">Uptime</th>
                        <th width="10%">Download</th>
                        <th width="10%">Upload</th>
                        <?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 10) { ?>
                            <th width="5%">Aksi</th>
                        <?php } ?>
                    </tr>
                </thead>

                <tbody>
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
                    ?>
                    <?php
                    $no = 1;
                    foreach ($hotspotuser as $dataku) {
                        $id = str_replace('*', '', $dataku['.id']);
                        $name = $dataku['name'];
                    ?>
                        <tr style="text-align: center">
                            <td width="5%"><?= $no++ ?></td>
                            <td width="15%"><?= $dataku['name'] ?></td>
                            <td width="10%"><?= $dataku['password'] ?></td>
                            <td width="12%"><?= $dataku['profile'] ?></td>
                            <td width="13%"><?= $dataku['uptime'] ?></td>
                            <td width="10%"><?= formatBytes($dataku['bytes-out'], 2) ?></td>
                            <td width="10%"><?= formatBytes($dataku['bytes-in'], 3) ?></td>
                            <?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 10) { ?>
                                <td width="15%">
                                    <a href="<?= site_url('hotspot/detail/' . $name) ?>" title="Detail">
                                        <button class="btn bg-secondary text-white"><i class="fa fa-eye"></i></button>
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

<!-- Modal Add -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah User Hotspot</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('hotspot/adduser') ?>" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nominal">Username</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nominal">Password</label>
                                <input type="text" id="password" name="password" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nominal">Profile</label>
                                <select id="profile" name="profile" class="form-control">
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
                                    <?php foreach ($hotspotserver as $mydata) { ?>
                                        <option value="<?= $mydata['name'] ?>"><?= $mydata['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="remark">Komentar</label>
                        <input type="text" name="comment" id="comment" class="form-control">
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