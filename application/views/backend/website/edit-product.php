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
            <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Edit Item Layanan</h6>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card-body">
                    <form method="post" action="<?= site_url('product/edit_product') ?>" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 col-12">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" id="id" name="id" value="<?= $product->id ?>">
                                            <input type="hidden" class="form-control" id="post_by" name="post_by" value="<?= $user['name'] ?>">
                                            <label for="name">Nama Produk</label>
                                            <input type="text" class="form-control" value="<?= $product->name ?>" id="name" name="name" onKeyPress="return kodeScript(event,' :abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789',this)" required>
                                            <?= form_error('name', '<small class="text-danger pl-3 ">', '</small>') ?>
                                        </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 col-12">
                                    <div class="form-group">
                                        <label for="remark">Gambar Produk</label>
                                        <input type="text" name="picture" id="picture" value="<?= $product->picture ?>" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 col-12">
                                    <div class="form-group">
                                        <label for="remark">Harga Produk</label>
                                        <input type="number" class="form-control" value="<?= $product->remark ?>" id="remark" name="remark" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">Deskripsi</label>
                                <textarea name="description" id="editor1" cols="30" rows="10"><?= $product->description ?></textarea>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="Reset" class="btn btn-info">Reset</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
                </section>
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
                <script src="https://cdn.ckeditor.com/4.16.1/standard-all/ckeditor.js"></script>
                <script>
                    CKEDITOR.replace('editor1');
                </script>