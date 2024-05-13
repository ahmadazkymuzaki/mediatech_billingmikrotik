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
<div class="col-lg-12">
    <div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
        <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
            <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Email</h6>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card-body">
                    <?php echo form_open_multipart('setting/editEmail') ?>
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?= $email['id'] ?>">
                        <label for="name">Nama Pengirim</label>
                        <input type="text" id="name" name="name" class="form-control" value="<?= $email['name'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Alamat Email</label>
                        <input type="text" id="email" name="email" class="form-control" value="<?= $email['email'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" value="<?= $email['password'] ?>">
                    </div>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="card-body">
                    <div class="form-group">
                        <label for="protocol">Protocol</label>
                        <input type="text" id="protocol" name="protocol" class="form-control" value="<?= $email['protocol'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="host">Host</label>
                        <input type="text" id="host" name="host" class="form-control" value="<?= $email['host'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="port">Port</label>
                        <input type="text" id="port" name="port" class="form-control" value="<?= $email['port'] ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Reset</button>
                    <button type="submit" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>">Simpan</button>
                </div>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>