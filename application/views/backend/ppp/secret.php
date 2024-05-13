<!-- bootstrap datepicker -->
<link rel="stylesheet" href="https://files.billing.or.id/assets/backend/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-2 col-xl-2 col-md-2 col-sm-6 col-xs-6 col-6">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <a href="#" data-toggle="modal" data-target="#add" class="d-sm-inline-block btn btn-sm btn-<?= $company['theme'] ?> form-control shadow-sm"><b><i class="fas fa-plus fa-sm text-white-50"></i> OTOMATIS</b></a>
        </div>
    </div>
    <div class="col-lg-2 col-xl-2 col-md-2 col-sm-6 col-xs-6 col-6">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <a href="#" data-toggle="modal" data-target="#addmanual" class="d-sm-inline-block btn btn-sm btn-success form-control shadow-sm"><b><i class="fas fa-plus fa-sm text-white-50"></i> MANUAL</b></a>
        </div>
    </div>
</div>
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
        <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data PPP Secret (<?= $totalpppsecret; ?> item)</h6>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="tablebt" width="100%" cellspacing="0">
                <thead>
                    <tr style="text-align: center;">
                        <th>No</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Service</th>
                        <th>Profile</th>
                        <th>Last Logout</th>
                        <th>Komentar</th>
                        <th>Status</th>
                        <?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 10) { ?>
                            <th>Aksi</th>
                        <?php } ?>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $no = 1;
                    foreach ($pppsecret as $dataku) {
                        $password = ucwords($dataku['password']);
                        $koneksi = mysqli_connect($company['host_database'], $company['user_database'], $company['pass_database'], $company['nama_database']);
                        $queryku = mysqli_query($koneksi, "SELECT * from customer where no_services='$password'");
                        $customer = mysqli_fetch_array($queryku);
                        $noser = $customer['no_services'];
                        $no_wa = $customer['no_wa'];
                        $queryku1 = mysqli_query($koneksi, "SELECT * from invoice where no_services='$noser'");
                        $invoice = mysqli_fetch_array($queryku1);
                        $amount = $invoice['amount'];
                    ?>
                        <?php
                        $id = str_replace('*', '', $dataku['.id']);
                        $name = $dataku['name'];
                        ?>
                        <tr style="text-align: center; height: 25px; margin:auto;">
                            <td><?= $no++ ?></td>
                            <td><?= $dataku['name'] ?></td>
                            <td><?= $dataku['password'] ?></td>
                            <td><?= $dataku['service'] ?></td>
                            <td><?= $dataku['profile'] ?></td>
                            <td><?= $dataku['last-logged-out'] ?></td>
                            <td><?= $dataku['comment'] ?></td>
                            <?php
                            $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
                            $host = $myrouter['host_router'];
                            $user = $myrouter['user_router'];
                            $pass = $myrouter['pass_router'];
                            $port = $myrouter['port_router'];

                            $API = new routeros();
                            $API->connect($host, $port, $user, $pass);

                            $counttheuser = $API->comm("/ppp/active/print", array(
                                "?name" => $dataku['name'],
                            ));
                            $countthisuser = count($counttheuser);

                            if ($plastloggedout == 'jan/01/1970 00:00:00') {
                            ?>
                                <td><button class="btn bg-warning text-white" title="Status Koneksi Internet <?= $dataku['name'] ?> Saat Ini Sedang Waiting">Waiting</button></td>
                            <?php
                            } elseif ($dataku['disabled'] == 'true') {
                            ?>
                                <td><button class="btn bg-dark text-white" title="Status Koneksi Internet <?= $dataku['name'] ?> Saat Ini Sedang Disable">Disabled</button></td>
                            <?php
                            } elseif ($countthisuser == 1) {
                            ?>
                                <td><button class="btn bg-success text-white" title="Status Koneksi Internet <?= $dataku['name'] ?> Saat Ini Sedang Online">Online</button></td>
                            <?php
                            } else {
                            ?>
                                <td><button class="btn bg-danger text-white" title="Status Koneksi Internet <?= $dataku['name'] ?> Saat Ini Sedang Offline">Offline</button></td>
                            <?php
                            }
                            ?>
                            <?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 10) { ?>
                                <td>
                                    <a href="<?= site_url('ppp/detail/' . $name) ?>" title="Detail">
                                        <button class="btn bg-secondary text-white"><i class="fa fa-eye"></i></button>
                                    </a>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Add -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Secret PPP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('ppp/addsecret') ?>" method="POST">
                    <div class="form-group">
                        <label for="remark">Pilih Pelanggan</label>
                        <select id="no_services" name="no_services" class="selectpicker show-tick form-control" data-live-search="true" tabindex="-98" required>
                            <option value="">- Pilih Pelanggan -</option>
                            <?php
                            $data_customer = $this->db->get_where('customer', array('username' => 'belum diatur'))->result();
                            foreach ($data_customer as $data10) {
                            ?>
                                <option value="<?= $data10->no_services; ?>"><?= $data10->name; ?> (<?= $data10->no_services; ?>)</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-xs-12 col-12">
                            <div class="form-group">
                                <label for="name">Username</label>
                                <input type="text" id="name" name="name" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-xs-12 col-12">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="text" id="password" name="password" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-xl-3 col-md-3 col-sm-12 col-xs-12 col-12">
                            <div class="form-group">
                                <label for="service">Service</label>
                                <select id="service" name="service" class="form-control">
                                    <option value="pppoe">pppoe</option>
                                    <option value="any">any</option>
                                    <option value="async">async</option>
                                    <option value="l2tp">l2tp</option>
                                    <option value="ovpn">ovpn</option>
                                    <option value="pptp">pptp</option>
                                    <option value="sstp">sstp</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-xl-4 col-md-4 col-sm-12 col-xs-12 col-12">
                            <div class="form-group">
                                <label for="local">Local Address</label>
                                <input type="text" id="local" name="local" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-5 col-xl-5 col-md-5 col-sm-12 col-xs-12 col-12">
                            <div class="form-group">
                                <label for="remote">Remote Address</label>
                                <input type="text" id="remote" name="remote" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="comment">Komentar</label>
                        <input type="text" name="comment" id="comment" class="form-control">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Add -->
<div class="modal fade" id="addmanual" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Secret PPP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('ppp/addsecret') ?>" method="POST">
                    <div class="row">
                        <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-xs-12 col-12">
                            <div class="form-group">
                                <label for="name">Username</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                                <input type="hidden" id="no_services" name="no_services" value="" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-xs-12 col-12">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="text" id="password" name="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 col-xs-12 col-12">
                            <label for="password">Profile</label>
                            <select id="basic" id="profile" name="profile" class="selectpicker show-tick form-control" data-live-search="true" tabindex="-98" required>
                                <?php foreach ($pppprofile as $datagua) { ?>
                                    <option value="<?= $datagua['name'] ?>"><?= $datagua['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-xl-3 col-md-3 col-sm-12 col-xs-12 col-12">
                            <div class="form-group">
                                <label for="service">Service</label>
                                <select id="service" name="service" class="form-control">
                                    <option value="pppoe">pppoe</option>
                                    <option value="any">any</option>
                                    <option value="async">async</option>
                                    <option value="l2tp">l2tp</option>
                                    <option value="ovpn">ovpn</option>
                                    <option value="pptp">pptp</option>
                                    <option value="sstp">sstp</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-xl-4 col-md-4 col-sm-12 col-xs-12 col-12">
                            <div class="form-group">
                                <label for="local">Local Address</label>
                                <input type="text" id="local" name="local" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-5 col-xl-5 col-md-5 col-sm-12 col-xs-12 col-12">
                            <div class="form-group">
                                <label for="remote">Remote Address</label>
                                <input type="text" id="remote" name="remote" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="comment">Komentar</label>
                        <input type="text" name="comment" id="comment" class="form-control">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>