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
<div class="row">
    <div class="col-lg-6">
        <div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
            <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
                <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Bot Telegram Notifikasi</h6>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-body">
                        <?php echo form_open_multipart('setting/editbottelegram') ?>
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?= $bot1['id'] ?>">
                            <label for="token">Token Bot</label>
                            <input type="text" id="token" name="token" class="form-control" value="<?= $bot1['token'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="username_bot">Username Bot</label>
                            <input type="text" id="username_bot" name="username_bot" class="form-control" value="<?= $bot1['username_bot'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="username_owner">Username Owner</label>
                            <input type="text" id="username_owner" name="username_owner" class="form-control" value="<?= $bot1['username_owner'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="id_telegram_owner">ID Owner</label>
                            <input type="text" id="id_telegram_owner" name="id_telegram_owner" class="form-control" value="<?= $bot1['id_telegram_owner'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="username_owner">Link Webhook</label>
                            <input type="text" id="link_webhook" name="link_webhook" class="form-control" value="<?= $bot1['link_webhook'] ?>">
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
    <div class="col-lg-6">
        <div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
            <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
                <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Test Kirim Pesan</h6>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-body">
                        <?php echo form_open_multipart('setting/kirimtelegram') ?>
                        <div class="form-group">
                            <label for="id_telegram_owner">Pesan ke Telegram</label>
                            <textarea type="text" id="pesan" rows="6" name="pesan" class="form-control"></textarea>
                            <input type="hidden" id="bot" name="bot" class="form-control" value="<?= $bot1['token'] ?>" readonly>
                            <input type="hidden" id="id" name="id" class="form-control" value="<?= $bot1['id_telegram_owner'] ?>" readonly>
                        </div>
                        <button type="submit" class="btn btn-success form-control">Kirim</button>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
            <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
                <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Bot Telegram Payment</h6>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-body">
                        <?php echo form_open_multipart('setting/editbottelegram') ?>
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?= $bot2['id'] ?>">
                            <label for="token">Token Bot</label>
                            <input type="text" id="token" name="token" class="form-control" value="<?= $bot2['token'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="username_bot">Username Bot</label>
                            <input type="text" id="username_bot" name="username_bot" class="form-control" value="<?= $bot2['username_bot'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="username_owner">Username Owner</label>
                            <input type="text" id="username_owner" name="username_owner" class="form-control" value="<?= $bot2['username_owner'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="id_telegram_owner">ID Owner</label>
                            <input type="text" id="id_telegram_owner" name="id_telegram_owner" class="form-control" value="<?= $bot2['id_telegram_owner'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="username_owner">Link Webhook</label>
                            <input type="text" id="link_webhook" name="link_webhook" class="form-control" value="<?= $bot2['link_webhook'] ?>">
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
    <div class="col-lg-6">
        <div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
            <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
                <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Test Kirim Pesan</h6>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-body">
                        <?php echo form_open_multipart('setting/kirimtelegram') ?>
                        <div class="form-group">
                            <label for="id_telegram_owner">Pesan ke Telegram</label>
                            <textarea type="text" id="pesan" rows="6" name="pesan" class="form-control"></textarea>
                            <input type="hidden" id="bot" name="bot" class="form-control" value="<?= $bot2['token'] ?>" readonly>
                            <input type="hidden" id="id" name="id" class="form-control" value="<?= $bot2['id_telegram_owner'] ?>" readonly>
                        </div>
                        <button type="submit" class="btn btn-success form-control">Kirim</button>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
            <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
                <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Bot Telegram Webhook</h6>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-body">
                        <?php echo form_open_multipart('setting/editbottelegram') ?>
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?= $bot3['id'] ?>">
                            <label for="token">Token Bot</label>
                            <input type="text" id="token" name="token" class="form-control" value="<?= $bot3['token'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="username_bot">Username Bot</label>
                            <input type="text" id="username_bot" name="username_bot" class="form-control" value="<?= $bot3['username_bot'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="username_owner">Username Owner</label>
                            <input type="text" id="username_owner" name="username_owner" class="form-control" value="<?= $bot3['username_owner'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="id_telegram_owner">ID Owner</label>
                            <input type="text" id="id_telegram_owner" name="id_telegram_owner" class="form-control" value="<?= $bot3['id_telegram_owner'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="username_owner">Link Webhook</label>
                            <input type="text" id="link_webhook" name="link_webhook" class="form-control" value="<?= $bot3['link_webhook'] ?>">
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
    <div class="col-lg-6">
        <div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
            <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
                <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Test Kirim Pesan</h6>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-body">
                        <?php echo form_open_multipart('setting/kirimtelegram') ?>
                        <div class="form-group">
                            <label for="id_telegram_owner">Pesan ke Telegram</label>
                            <textarea type="text" id="pesan" rows="6" name="pesan" class="form-control"></textarea>
                            <input type="hidden" id="bot" name="bot" class="form-control" value="<?= $bot3['token'] ?>" readonly>
                            <input type="hidden" id="id" name="id" class="form-control" value="<?= $bot3['id_telegram_owner'] ?>" readonly>
                        </div>
                        <button type="submit" class="btn btn-success form-control">Kirim</button>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>