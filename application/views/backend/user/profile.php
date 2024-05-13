<div class="col-6">

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
<div class="col-lg-6">
    <div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
        <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
            <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>"><?= $title ?></h6>
        </div>
        <div class="card-body">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="col">
                        <img style=" display: block;margin-left: auto;margin-right: auto;width: 100%; max-height:450px" class="profile-user-img img-responsive img-profile rounded-circle" src="<?= site_url('assets/images/profile/' . $user['image']) ?>" alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center mt-2"><?= $user['name'] ?></h3>
                    <h5 class="text-center"><?= $user['email'] ?>
                        <a href="" data-toggle="modal" data-target="#email" title="Edit Email">
                            <i class="fa fa-edit"></i></a>
                    </h5>
                </div>
                <!-- /.box-body -->
                <br>
                <center>
                    <div class="row d-sm-flex align-items-center justify-content-between">
                        <div class="col" style="margin-right:-200px">
                            <a href="<?= site_url('user/changepassword') ?>" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>"> Change Password</a>
                        </div>
                        <div class="col">
                            <a href="<?= site_url('user/edit') ?>" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>"> Edit Profile</a>
                        </div>
                    </div>
                </center>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="email" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('user/editEmail') ?>" method="POST">
                    <div class="form-group">
                        <label for="cemail">Current Email</label>
                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                        <input type="text" name="cemail" id="cemail" class="form-control" value="<?= $user['email'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email">New Email</label>
                        <input type="text" name="email" id="email" class="form-control">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>