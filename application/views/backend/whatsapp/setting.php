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
            <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Setting Akun WhatsApp</h6>
        </div>
        <div class="card-body">
            <?php echo form_open_multipart('whatsapp/edit/1') ?>
            <div class="form-group">
                <label for="address">Nomor WA ChatBot</label>
                <input type="number" id="number" name="number" class="form-control" value="<?= $whatsapp['number'] ?>" placeholder="Contoh : <?= $whatsapp['number'] ?>">
                <input type="hidden" id="link_url" name="link_url" class="form-control" value="https://wa-bot.my.id/send-message" readonly>
                <input type="hidden" id="url_web" name="url_web" class="form-control" value="<?= site_url(); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="address">WhatsApp Admin</label>
                <input type="number" id="admin" name="admin" class="form-control" value="<?= $whatsapp['admin'] ?>">
            </div>
            <div class="form-group">
                <label for="address">API Key Gateway</label>
                <input type="text" id="api_key" name="api_key" class="form-control" value="<?= $whatsapp['api_key'] ?>">
            </div>
            <div class="form-group">
                <label for="address">Terakhir Diperbarui</label>
                <input type="text" id="update" name="update" class="form-control" value="<?= $whatsapp['update'] ?>" readonly>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-secondary" data-dismiss="modal">Reset</button>
                <button type="submit" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>">Save</button>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>