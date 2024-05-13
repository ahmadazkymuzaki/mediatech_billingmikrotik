<div class="col-lg-12 mt-3">
    <div class="col-12">
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
    <div class="col-12">
        <div class="card shadow mb-3" style="border: solid 1px grey;">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>"><?= $title ?></h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg">
                        <div class="box box-primary">
                            <div class="box-body box-profile">
                                <form action="<?= site_url('member/changepassword'); ?>" method="post">
                                    <div class="form-group mt-2">
                                        <label for="current_password">Password Lama</label>
                                        <input type="password" class="form-control" id="current_password" name="current_password">
                                        <?= form_error('current_password', '<small class="text-danger pl-3 ">', '</small>') ?>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="new_password1">Password Baru</label>
                                        <input type="password" class="form-control" id="new_password1" name="new_password1">
                                        <?= form_error('new_password1', '<small class="text-danger pl-3 ">', '</small>') ?>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="new_password2">Konfirmasi Password</label>
                                        <input type="password" class="form-control" id="new_password2" name="new_password2">
                                        <?= form_error('new_password2', '<small class="text-danger pl-3 ">', '</small>') ?>
                                    </div>
                                    <div class="form-group mt-2">
                                        <button class="btn btn-primary">Change Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>