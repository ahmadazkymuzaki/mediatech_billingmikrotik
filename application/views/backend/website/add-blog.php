<link href="https://files.billing.or.id/assets/backend/css/bootstrap3-wysihtml5.min.css" rel="stylesheet">
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
            <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Tambah Artikel</h6>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card-body">
                    <form method="post" action="<?= site_url('blog/add') ?>" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="title">Judul</label>
                                <input type="text" class="form-control" id="title" autocomplete="off" name="title" onKeyPress="return kodeScript(event,' :abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789',this)">
                                <?= form_error('title', '<small class="text-danger pl-3 ">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <label for="category_id">Kategori</label>
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="">- Pilih -</option>
                                    <?php foreach ($category as $key => $data) { ?>
                                        <option value="<?= $data->cat_id ?>"><?= $data->cat_name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="picture">Picture</label>
                                <input type="file" name="picture" id="picture">
                            </div>


                            <div class="form-group">
                                <label for="description">Deskripsi</label>
                                <textarea name="description" id="editor1" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="Reset" class="btn btn-info">Reset</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://files.billing.or.id/assets/backend/css/ckeditor/ckeditor.js"></script>
    <script src="https://files.billing.or.id/assets/backend/js/bootstrap3-wysihtml5.all.min.js"></script>
    <script language="javascript">
        function getkey(e) {
            if (window.event)
                return window.event.keyCode;
            else if (e)
                return e.which;
            else
                return null;
        }

        function kodeScript(e, goods, field) {
            var key, keychar;
            key = getkey(e);
            if (key == null) return true;

            keychar = String.fromCharCode(key);
            keychar = keychar.toLowerCase();
            goods = goods.toLowerCase();

            // check goodkeys
            if (goods.indexOf(keychar) != -1)
                return true;
            // control keys
            if (key == null || key == 0 || key == 8 || key == 9 || key == 27)
                return true;

            if (key == 13) {
                var i;
                for (i = 0; i < field.form.elements.length; i++)
                    if (field == field.form.elements[i])
                        break;
                i = (i + 1) % field.form.elements.length;
                field.form.elements[i].focus();
                return false;
            };
            // else return false
            return false;
        }
    </script>
    <script type="text/javascript">
        $(function() {
            CKEDITOR.replace('editor1', {
                filebrowserImageBrowseUrl: '<?php echo site_url('assets/kcfinder/browse.php'); ?>',
                height: '400px'
            });
        });
    </script>