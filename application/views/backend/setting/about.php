<div class="container">
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
</div>
<div class="container mt-2">
    <div style="border: 3px solid <?= $backgroundnya ?>;" class="card">
        <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header">
            Tentang <?= $company['company_name'] ?>
        </div>
        <div class="card-body">
            <form action="<?= site_url('setting/editAbout') ?>" method="POST">
                <div class="form-group">
                    <textarea name="description" id="editor1" class="form-control"><?= $company['description'] ?></textarea>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-1">
                            <label class="pt-2">PPN</label>
                        </div>
                        <div class="col-9">
                            <input type="number" name="ppn" id="ppn" class="form-control" value="<?= $company['ppn'] ?>">
                        </div>
                        <div class="col-2">
                            <label class="pt-2 text-right pull-right">Defaultnya 10%</label>
                        </div>
                    </div>
                </div>
                <div class="text-right mt-2">
                    <button style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.ckeditor.com/4.16.1/standard-all/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor1');
</script>