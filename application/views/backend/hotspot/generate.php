<!-- bootstrap datepicker -->
<link rel="stylesheet" href="https://files.billing.or.id/assets/backend/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
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
<div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
    <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
        <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">
            Generate Voucher / User (Saat Ini : <?= $totalhotspotuser; ?> Voucher Aktif)
            <!-- &nbsp; <a href="" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-info-circle" style="font-size: 24px"></i></a> -->
        </h6>
    </div>
    <div class="card-body">
        <form action="<?= site_url('hotspot/addgenerate') ?>" method="POST">
            <div class="row pt-3">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="nominal">Jumlah <small><i>*Max 500 Voucher</i></small></label>
                        <input type="number" id="jumlah" name="jumlah" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="nominal">Server Hotspot</label>
                        <select id="server" name="server" class="form-control">
                            <option value="all">Semua Server</option>
                            <?php foreach ($hotspotserver as $mydata) { ?>
                                <option value="<?= $mydata['name'] ?>"><?= $mydata['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="nominal">Profile Hotspot</label>
                        <select id="profile" name="profile" class="form-control">
                            <?php foreach ($hotspotprofile as $datagua) { ?>
                                <option value="<?= $datagua['name'] ?>"><?= $datagua['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="nominal">Panjang Karakter</label>
                        <select id="panjang" name="panjang" class="form-control">
                            <option value="5">5</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="nominal">Mode Voucher</label>
                        <select id="voucher" name="voucher" class="form-control">
                            <option value="beda">Username & Password</option>
                            <option value="sama">Username = Password</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="nominal">Prefix Username</label>
                        <input type="text" id="prefix" name="prefix" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="nominal">Batas Waktu Voucher</label>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="number" id="waktu" name="waktu" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <select id="waktu1" name="waktu1" class="form-control">
                                    <option value="s">Detik</option>
                                    <option value="m">Menit</option>
                                    <option value="h">Jam</option>
                                    <option value="d">Hari</option>
                                    <option value="w">Minggu</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="nominal">Batas Kuota Voucher</label>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="number" id="kuota" name="kuota" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <select id="kuota1" name="kuota1" class="form-control">
                                    <option value="k">KB</option>
                                    <option value="M">MB</option>
                                    <option value="G">GB</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="nominal">Karakter Username</label>
                        <select id="karakter" name="karakter" class="form-control">
                            <option value="1">Random abcd</option>
                            <option value="2">Random 1ab2c34d</option>
                            <option value="3">Random ABCD</option>
                            <option value="4">Random 1AB2C34D</option>
                            <option value="5">Random aBcD</option>
                            <option value="6">Random 1aB2c34D</option>
                            <option value="7">Random 1234</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="remark">Komentar Voucher</label>
                        <input type="text" name="comment" id="comment" value="vc-7<?= date('s'); ?>-<?= date('d.m.y'); ?>" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="remark">Dibuat Pada</label>
                        <input type="text" name="dibuat" id="dibuat" value="<?= date('d-m-Y H:i:s'); ?> WIB" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group pull-right">
                        <button type="submit" style="margin-top: 32px;" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>"><i class="fa fa-save"></i>&nbsp; Generate</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-info-circle" style="font-size: 24px"></i> Informasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <li>Username Random - Contoh <?php $this->load->helper(array('url', 'string'));
                                                echo random_string('alnum', 10); ?></li>
                <li>Username tidak sama dengan Password (≠)</li>
                <li>Username Numeric - Contoh <?php $this->load->helper(array('url', 'string'));
                                                echo random_string('numeric', 10); ?></li>
                <li>Batas Maksimal Generate s/d 500 Voucher</li>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>