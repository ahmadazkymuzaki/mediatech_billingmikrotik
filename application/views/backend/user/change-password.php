<div class="col-lg-6">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="<?= site_url('user/profile'); ?>" title="Kembali">
            <input type="button" class="btn btn-danger" value="Close" readonly>
        </a>
    </div>
    <div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
        <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
            <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>"><?= $title ?></h6>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-lg">
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
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <form action="<?= site_url('user/changepassword'); ?>" method="post">
                                <div class="form-group">
                                    <label for="current_password">Current Password</label>
                                    <input type="password" class="form-control" id="current_password" name="current_password">
                                    <?= form_error('current_password', '<small class="text-danger pl-3 ">', '</small>') ?>
                                </div>
                                <div class="form-group">
                                    <label for="new_password1">New Password</label>
                                    <input type="password" class="form-control" id="new_password1" name="new_password1">
                                    <?= form_error('new_password1', '<small class="text-danger pl-3 ">', '</small>') ?>
                                </div>
                                <div class="form-group">
                                    <label for="new_password2">Repeat Password</label>
                                    <input type="password" class="form-control" id="new_password2" name="new_password2">
                                    <?= form_error('new_password2', '<small class="text-danger pl-3 ">', '</small>') ?>
                                </div>
                                <div class="form-group">
                                    <button style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>">Change Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>