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
    <div class="col-lg-12">
        <div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
            <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
                <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Test Kirim Whatsapp</h6>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-body">
                        <?php echo form_open_multipart('whatsapp/sendingwhatsapp') ?>
                        <div class="form-group">
                            <label for="host_whatsapp">Nomor WhatsApp</label>
                            <input type="number" id="nomor" name="nomor" class="form-control" placeholder="081234567890" required>
                        </div>
                        <div class="form-group">
                            <label for="port_whatsapp">Pesan WhatsApp</label>
                            <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css" rel="stylesheet">
                            <link href="https://www.jquery-az.com/jquery/css/bootstrap-markdown-editor.css" rel="stylesheet">
                            <textarea rows="7" type="text" id="message" name="pesan" class="form-control" placeholder="Halo, Perkenalkan saya Admin @Boss.Net" required></textarea>
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.1.3/ace.js"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/marked/0.3.2/marked.min.js"></script>
                            <script src="https://files.billing.or.id/assets/backend/js/markdown-wa.js"></script>
                            <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
                            <script src="https://www.wasap.at/assets/js/lightbox.min.js"></script>
                            <script src="https://www.wasap.at/assets/js/clipboard.min.js"></script>
                            <script src="https://www.wasap.at/assets/js/wasap.js?v=1"></script>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="KirimPesan" name="KirimPesan" class="btn btn-success form-control">Kirim Sekarang</button>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>
<script>
</script>