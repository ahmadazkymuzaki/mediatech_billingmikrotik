<div class="col-lg-6 col-sm-12">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="<?= site_url('user'); ?>" title="Kembali">
            <input type="button" class="btn btn-danger" value="Close" readonly>
        </a>
    </div>
    <div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
        <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
            <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>"> <?= $title ?>
            </h6>
        </div>
        <div class="card-body">
            <form method="post" action="<?= site_url('user/editUser') ?>" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $row['id'] ?>" class="form-control">
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= $row['name']; ?>">
                    <?= form_error('name', '<small class="text-danger pl-3 ">', '</small>') ?>
                </div>
                <input type="hidden" class="form-control" id="image1" name="image1" value="<?= $row['image']; ?>" placeholder="">
                <div class="row">
                    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 col-xs-12 col-12">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $row['email']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-xs-12 col-12">
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" class="form-control" id="password" name="password" value="" placeholder="kosongkan jika tidak diganti">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-xs-12 col-12">
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select class="form-control" id="gender" name="gender">
                                <option value="<?= $row['gender']; ?>"><?= $row['gender']; ?></option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <?= form_error('gender', '<small class="text-danger pl-3 ">', '</small>') ?>
                    </div>
                    <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-xs-12 col-12">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="number" class="form-control" id="phone" name="phone" value="<?= $row['phone']; ?>" placeholder="">
                            <?= form_error('phone', '<small class="text-danger pl-3 ">', '</small>') ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-xs-12 col-12">
                        <div class="form-group">
                            <label for="phone">Saldo Akun</label>
                            <input type="number" class="form-control" id="saldo" name="saldo" value="<?= $row['saldo']; ?>" placeholder="0" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-xs-12 col-12">
                        <div class="form-group">
                            <label for="name">Status</label>
                            <select name="is_active" class="form-control">
                                <option value="1">Aktif</option>
                                <option value="0" <?= $row['is_active'] == 0 ? 'selected' : null ?>>Non-Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-xs-12 col-12">
                        <div class="form-group">
                            <label for="name">Level</label>
                            <select name="role_id" class="form-control">
                                <option value="<?= $row['role_id'] ?>"><?= $row['role_id'] == 1 ? 'Admin / Owner' : null ?><?= $row['role_id'] == 2 ? 'Member PPPOE' : null ?><?= $row['role_id'] == 3 ? 'Member HOTSPOT' : null ?><?= $row['role_id'] == 4 ? 'Reseller HOTSPOT' : null ?><?= $row['role_id'] == 5 ? 'Sales PPPOE' : null ?><?= $row['role_id'] == 6 ? 'Operator Jaringan' : null ?><?= $row['role_id'] == 7 ? 'Customer Service' : null ?><?= $row['role_id'] == 8 ? 'Karyawan Teknisi' : null ?><?= $row['role_id'] == 10 ? 'Bill Collector' : null ?></option>
                                <option value="1">Admin / Owner</option>
                                <option value="2">Member PPPOE</option>
                                <option value="3">Member HOTSPOT</option>
                                <option value="4">Reseller HOTSPOT</option>
                                <option value="5">Sales PPPOE</option>
                                <option value="6">Operator Jaringan</option>
                                <option value="7">Customer Service</option>
                                <option value="8">Teknisi / Karyawan</option>
                                <option value="10">Bill Collector</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea class="form-control" id="address" name="address" rows="4"><?= $row['address']; ?></textarea>
                </div>
        </div>
        <div class="modal-footer">
            <button type="reset" class="btn btn-secondary" data-dismiss="modal">Reset</button>
            <button style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>" type="submit"> Update</button>
            </form>
        </div>
    </div>
</div>