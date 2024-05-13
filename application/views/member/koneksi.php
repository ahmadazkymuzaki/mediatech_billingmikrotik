<?php if (count($pppactive) > 0) { ?>
    <?php foreach ($pppactive as $mydatauser) { ?>
        <div class="col-12 mt-3">
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
            <div class="col-lg-12">
                <div class="card shadow" style="border: solid 1px grey;">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Detail Koneksi Modem</h6>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-body table-responsive">
                                <table id="zero_config" class="table table-striped no-wrap">
                                    <?php
                                    foreach ($pppuser as $dataku) {
                                        $id = str_replace('*', '', $dataku['.id']);
                                    ?>
                                        <tr>
                                            <td>Username Akun</td>
                                            <td>:</td>
                                            <td><?= $dataku['name'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Password Akun</td>
                                            <td>:</td>
                                            <td><?= $dataku['password'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Paket Pengguna</td>
                                            <td>:</td>
                                            <td><?= $dataku['profile'] ?></td>
                                        </tr>
                                        <?php foreach ($pppprofile as $dataprofile) { ?>
                                            <tr>
                                                <td>Speed Internet</td>
                                                <td>:</td>
                                                <td><?= $dataprofile['rate-limit'] ?></td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td>Mode Koneksi</td>
                                            <td>:</td>
                                            <td><?= $dataku['service'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Remote Address</td>
                                            <td>:</td>
                                            <td><?= $mydatauser['address'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>MAC Address</td>
                                            <td>:</td>
                                            <td><?= $mydatauser['caller-id'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Online Selama</td>
                                            <td>:</td>
                                            <td><?= $mydatauser['uptime'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Terakhir Offline</td>
                                            <td>:</td>
                                            <td><?= $dataku['last-logged-out'] ?> WIB</td>
                                        </tr>
                                        <tr>
                                            <td>Alasan Offline</td>
                                            <td>:</td>
                                            <td><?= $dataku['last-disconnect-reason'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Status Pengguna</td>
                                            <td>:</td>
                                            <td>
                                                <?php
                                                if ($pppuser['0']['disabled'] == 'true') {
                                                    echo 'Isolir';
                                                } else {
                                                    echo 'Online';
                                                } ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Komentar</td>
                                            <td>:</td>
                                            <td><?= $dataku['comment'] ?></td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <a target="_blank" href="http://<?= $mydatauser['address'] ?>" onclick="return confirm('Apakah anda yakin akan modem anda ?')" title="Remote">
                                    <input type="button" class="btn btn-primary" value="Remote" readonly>
                                </a>
                                <?php if ($pppuser['0']['disabled'] == 'false') { ?>
                                    <a href="<?= site_url('ppp/disable/' . $id) ?>" onclick="return confirm('Apakah anda yakin akan disable ppp secret <?= $dataku['name'] ?> ?')" title="Enable">
                                        <input type="button" class="btn btn-secondary" value="Disable" readonly>
                                    </a>
                                <?php } ?>
                                <?php if ($pppuser['0']['disabled'] == 'true') { ?>
                                    <a href="<?= site_url('ppp/enable/' . $id) ?>" onclick="return confirm('Apakah anda yakin akan enable ppp secret <?= $dataku['name'] ?> ?')" title="Disable">
                                        <input type="button" class="btn btn-success" value="Enable" readonly>
                                    </a>
                                <?php } ?>
                                <?php
                                foreach ($pppactive as $datasaya) {
                                    $idsaya = str_replace('*', '', $datasaya['.id'])
                                ?>
                                    <a href="<?= site_url('ppp/deleteactive/' . $idsaya) ?>" onclick="return confirm('Apakah anda yakin akan menghapus ppp active <?= $dataku['name'] ?> ?')" title="Delete">
                                        <input type="button" class="btn btn-danger" value="Delete" readonly>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
<?php } else { ?>
    <div class="col-lg-12 mt-3">
        <div class="col-12">
            <div class="card shadow mb-3" style="border: solid 1px grey;">
                <div class="card-header py-3">
                    <h6 class="m-0 text-center font-weight-bold" style="color: red;">Internet Anda Sedang OFFLINE</h6>
                </div>
            </div>
        </div>
    </div>
<?php } ?>