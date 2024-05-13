<style>
    .switch {
        display: inline-block;
        height: 34px;
        position: relative;
        width: 60px;

    }

    .switch input {
        display: none;
    }

    .slider {
        background-color: gray;
        bottom: 0;
        cursor: pointer;
        left: 0;
        position: absolute;
        right: 0;
        top: 0;
        transition: .4s;
    }

    .slider:before {
        background-color: #fff;
        bottom: 4px;
        content: "";
        height: 26px;
        left: 4px;
        position: absolute;
        transition: .4s;
        width: 26px;
    }

    input:checked+.slider {
        background-color: blue;
    }

    input:checked+.slider:before {
        transform: translateX(26px);
    }

    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
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
            <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Pengaturan Lainnya</h6>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card-body">
                    <?php echo form_open_multipart('setting/editOther') ?>
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?= $other['id'] ?>">
                        <label for="body_wa">Head Pesan WhatsApp</label>
                        <textarea id="body_wa" name="say_wa" class="form-control"><?= $other['say_wa'] ?></textarea>
                        <label for="body_wa">Body Pesan WhatsApp</label>
                        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css" rel="stylesheet">
                        <link href="https://www.jquery-az.com/jquery/css/bootstrap-markdown-editor.css" rel="stylesheet">
                        <textarea rows="7" type="text" id="message" name="body_wa" class="form-control" placeholder="Halo, Perkenalkan saya Admin @Boss.Net" required><?= $other['body_wa'] ?></textarea>
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
                    <div class="form-group">
                        <label for="footer">Footer Pesan WhatsApp</label>
                        <textarea id="footer_wa" name="footer_wa" class="form-control"><?= $other['footer_wa'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="thanks_wa">WhatsApp Sudah Bayar</label>
                        <textarea id="thanks_wa" name="thanks_wa" class="form-control"><?= $other['thanks_wa'] ?></textarea>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card-body">
                    <div class="form-group">
                        <label>Kode Unik Tagihan</label>
                        <div class="row">
                            <label for="chcode_unique" class="switch ml-3">
                                <input type="checkbox" <?= $other['code_unique'] == 1 ? 'checked' : ''; ?> id="chcode_unique" />
                                <div class="slider round"></div>
                            </label>
                        </div>
                        <div id="text_code_unique" style="display: <?= $other['code_unique'] == 1 ? 'block' : 'none'; ?>">
                            <label>Keterangan Kode Unik</label>
                            <input type="hidden" id="code_unique" name="code_unique" value="<?= $other['code_unique'] == 1 ? '1' : '0'; ?>">
                            <textarea name="text_code_unique" class="form-control"><?= $other['text_code_unique'] ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="thanks_wa">Nominal Bonus Saldo</label>
                        <input id="bonus_saldo" name="bonus_saldo" type="number" class="form-control" value="<?= $other['bonus_saldo'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="thanks_wa">Link Gambar Reminder</label>
                        <input id="isolir_image" name="bonus_saldo" type="text" class="form-control" value="<?= $other['isolir_image'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="thanks_wa">Link Gambar Terimakasih</label>
                        <input id="thanks_image" name="thanks_image" type="text" class="form-control" value="<?= $other['thanks_image'] ?>" required>
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
<script>
    $(function() {
        $("#chcode_unique").click(function() {
            if ($(this).is(":checked")) {
                $("#text_code_unique").show();
                $("#code_unique").val('1');
            } else {
                $("#code_unique").val('0');
                $("#text_code_unique").hide();
            }
        });
    });
</script>