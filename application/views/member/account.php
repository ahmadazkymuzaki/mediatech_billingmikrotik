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
            <div class="card-body">
                <div class="box box-primary">
                    <div class="row">
                        <div class="col">
                            <div class="box box-primary">
                                <div class="box-body box-profile">
                                    <?= form_open_multipart('member/account'); ?>
                                    <div class="form-group">
                                        <label for="name">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>">
                                        <?= form_error('name', '<small class="text-danger pl-3 ">', '</small>') ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mt-2">
                                            <div class="form-group">
                                                <label for="email">Alamat Email</label>
                                                <input type="email" class="form-control" id="email" name="email" value="<?= $user['email']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <div class="form-group">
                                                <label for="gender">Jenis Kelamin</label>
                                                <select class="form-control" id="gender" name="gender">
                                                    <option value="<?= $user['gender']; ?>"><?= $user['gender']; ?></option>
                                                    <option value="Laki-Laki">Laki-Laki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                            </div>
                                            <?= form_error('gender', '<small class="text-danger pl-3 ">', '</small>') ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mt-2">
                                            <div class="form-group mt-2">
                                                <label for="phone">Nomor Telepon</label>
                                                <input type="number" class="form-control" id="phone" name="phone" value="<?= $user['phone']; ?>" placeholder="">
                                                <?= form_error('phone', '<small class="text-danger pl-3 ">', '</small>') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <div class="form-group mt-2">
                                                <label for="phone">PIN Trx Saat Ini</label>
                                                <input type="number" class="form-control" id="pin_trx" name="pin_trx" placeholder="1234 (maks. 6 karakter)" maxlength="6">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mt-2">
                                            <div class="form-group mt-2">
                                                <label for="phone">PIN Trx Baru</label>
                                                <input type="number" class="form-control" id="pin_trx1" name="pin_trx1" placeholder="1234 (maks. 6 karakter)" maxlength="6">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <div class="form-group mt-2">
                                                <label for="phone">Konfirmasi PIN</label>
                                                <input type="number" class="form-control" id="pin_trx2" name="pin_trx2" placeholder="1234 (maks. 6 karakter)" maxlength="6">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <input type="hidden" class="form-control" id="image1" name="image1" value="<?= $user['image']; ?>" placeholder="">
                                    </div>
                                    <div class="form-group mt-2">
                                        <label>Foto Profil</label><br>
                                        <input type="file" name="image" class="file-upload-default" required>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="address">Alamat Lengkap</label>
                                        <textarea class="form-control" id="address" name="address" rows="4"><?= $user['address']; ?></textarea>
                                    </div>
                                    <div class="text-right mt-2">
                                        <button type="reset" class="btn">Reset</button>
                                        <button "submit" class="btn btn-success"> <i class="ik ik-save"></i> Update</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
    window.jQuery || document.write('<script src="<?= site_url('assets/member/') ?>/src/js/vendor/jquery-3.3.1.min.js"><\/script>')
</script>
<script src="<?= site_url('assets/member/') ?>js/form-components.js"></script>