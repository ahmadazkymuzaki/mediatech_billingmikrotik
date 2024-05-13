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
<div class="col-lg-6">
    <div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
        <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
            <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">SMS Gateway</h6>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card-body">
                    <?php echo form_open_multipart('setting/editsmsgateway') ?>
                    <div class="form-group">
                        <input type="hidden" name="sms_id" value="<?= $sms['sms_id'] ?>">
                        <label for="name">Nama Server</label>
                        <input type="text" id="name" name="name" class="form-control" value="<?= $sms['sms_name'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="token">Token</label>
                        <input type="text" id="token" name="token" class="form-control" value="<?= $sms['sms_token'] ?>">
                    </div>

                    <!-- <div class="form-group">
                        <label for="user">User</label>
                        <input type="text" id="user" name="user" class="form-control" value="<?= $sms['sms_user'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" value="<?= $sms['sms_password'] ?>">
                    </div> -->

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
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()
    });
</script>