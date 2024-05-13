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
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <a href="<?= site_url('ppp/secret'); ?>" title="Kembali">
        <input type="button" class="btn btn-danger" value="Close" readonly>
    </a>
</div>
<div class="row">
    <div class="col-lg-6">
        <div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
            <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
                <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Detail Pengguna</h6>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-body">
                        <?php echo form_open_multipart('mikrotik/editrouter') ?>
                        <table>
                            <?php
                            foreach ($pppuser as $dataku) {
                                $id = str_replace('*', '', $dataku['.id']);
                            ?>
                                <tr>
                                    <td>Nama Pengguna</td>
                                    <td>&nbsp;&nbsp;&nbsp;</td>
                                    <td>:</td>
                                    <td>&nbsp;</td>
                                    <td><?= $dataku['name'] ?></td>
                                </tr>
                                <tr>
                                    <td>Password Akun</td>
                                    <td>&nbsp;&nbsp;&nbsp;</td>
                                    <td>:</td>
                                    <td>&nbsp;</td>
                                    <td><?= $dataku['password'] ?></td>
                                </tr>
                                <tr>
                                    <td>Paket Pengguna</td>
                                    <td>&nbsp;&nbsp;&nbsp;</td>
                                    <td>:</td>
                                    <td>&nbsp;</td>
                                    <td><?= $dataku['profile'] ?></td>
                                </tr>
                                <?php
                                foreach ($pppactive as $mydata) {
                                ?>
                                    <tr>
                                        <td>IP Address</td>
                                        <td>&nbsp;&nbsp;&nbsp;</td>
                                        <td>:</td>
                                        <td>&nbsp;</td>
                                        <td><?= $mydata['address'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Aktif Selama</td>
                                        <td>&nbsp;&nbsp;&nbsp;</td>
                                        <td>:</td>
                                        <td>&nbsp;</td>
                                        <td><?= $mydata['uptime'] ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                                <tr>
                                    <td>Status Pengguna</td>
                                    <td>&nbsp;&nbsp;&nbsp;</td>
                                    <td>:</td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <?php
                                        $myitem = $this->db->get_where('package_item', ['name' => 'ISOLIR'])->row_array();
                                        if ($dataku['profile'] == $myitem['paket_wifi']) {
                                            echo 'Isolir';
                                        } elseif (count($pppactive) > 0) {
                                            echo 'Online';
                                        } else {
                                            echo 'Offline';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Komentar</td>
                                    <td>&nbsp;&nbsp;&nbsp;</td>
                                    <td>:</td>
                                    <td>&nbsp;</td>
                                    <td><?= $dataku['comment'] ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Interace</th>
                                    <th>Upload</th>
                                    <th>Download</th>
                                </tr>
                                <tr>
                                    <?php
                                    foreach ($pppuser as $dataku) {
                                    ?>
                                        <td width="40%">
                                            <input name="interface" id="interface" type="hidden" value="<?= $dataku['name'] ?>" readonly>
                                            pppoe-<?= $dataku['name'] ?>
                                        </td>
                                    <?php } ?>
                                    <td width="30%">
                                        <div id="tabletx"></div>
                                    </td>
                                    <td width="30%">
                                        <div id="tablerx"></div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" data-toggle="modal" data-target="#edit" title="Edit Pengguna">
                            <input type="button" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>" value="Edit PPP" readonly>
                        </a>
                        <?php if ($pppuser['0']['disabled'] == 'false') { ?>
                            <a href="<?= site_url('ppp/disable/' . $id) ?>" onclick="return confirm('Apakah anda yakin akan disable ppp secret <?= $dataku['name'] ?> ?')" title="Enable">
                                <input type="button" class="btn btn-secondary" value="Disable PPP" readonly>
                            </a>
                        <?php } ?>
                        <?php if ($pppuser['0']['disabled'] == 'true') { ?>
                            <a href="<?= site_url('ppp/enable/' . $id) ?>" onclick="return confirm('Apakah anda yakin akan enable ppp secret <?= $dataku['name'] ?> ?')" title="Disable">
                                <input type="button" class="btn btn-success" value="Enable PPP" readonly>
                            </a>
                        <?php } ?>
                        <a href="<?= site_url('ppp/deletesecret/' . $id) ?>" onclick="return confirm('Apakah anda yakin akan menghapus ppp secret <?= $dataku['name'] ?> ?')" title="Delete">
                            <input type="button" class="btn btn-danger" value="Delete PPP" readonly>
                        </a>
                        <?php
                        foreach ($pppactive as $datasaya) {
                            $idsaya = str_replace('*', '', $datasaya['.id'])
                        ?>
                            <a href="<?= site_url('ppp/deleteactive/' . $idsaya) ?>" onclick="return confirm('Apakah anda yakin akan menghapus ppp active <?= $dataku['name'] ?> ?')" title="Delete">
                                <input type="button" class="btn btn-warning" value="Delete Active" readonly>
                            </a>
                        <?php } ?>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
            <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
                <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Live Traffic</h6>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-body">
                        <div id="graph"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit User PPP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
            foreach ($pppuser as $dataku) {
            ?>
                <div class="modal-body">
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nominal">Username</label>
                                    <input type="text" id="name" name="name" value="<?= $dataku['name'] ?>" required class="form-control">
                                    <input type="hidden" id="id" name="id" value="<?= $dataku['.id'] ?>" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nominal">Password</label>
                                    <input type="text" id="password" name="password" value="<?= $dataku['password'] ?>" required class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nominal">Profile</label>
                                    <select id="profile" name="profile" class="form-control">
                                        <option value="<?= $dataku['profile'] ?>"><?= $dataku['profile'] ?></option>
                                        <?php foreach ($pppprofile as $datagua) { ?>
                                            <option value="<?= $datagua['name'] ?>"><?= $datagua['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nominal">Service</label>
                                    <select id="service" name="service" class="form-control">
                                        <option value="<?= $dataku['service'] ?>"><?= $dataku['service'] ?></option>
                                        <option value="any">any</option>
                                        <option value="async">async</option>
                                        <option value="l2tp">l2tp</option>
                                        <option value="ovpn">ovpn</option>
                                        <option value="pppoe">pppoe</option>
                                        <option value="pptp">pptp</option>
                                        <option value="sstp">sstp</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nominal">Local Address</label>
                                    <input type="text" id="local" name="local" value="<?= $dataku['local-address'] ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nominal">Remote Address</label>
                                    <input type="text" id="remote" name="remote" value="<?= $dataku['remote-address'] ?>" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="remark">Komentar</label>
                            <input type="text" name="comment" id="comment" value="<?= $dataku['comment'] ?>" class="form-control">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" name="save" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>">Simpan</button>
                </div>
                </form>
        </div>
    <?php
            }
    ?>
    </div>
</div>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js" integrity="sha384-XEerZL0cuoUbHE4nZReLT7nx9gQrQreJekYhJD9WNWhH8nEW+0c5qq7aIo2Wl30J" crossorigin="anonymous"></script>
<script type="text/javascript" src="<?= $company['billing']; ?>/assets/highchart/js/highcharts.js"></script>
<script>
    var chart;

    function requestDatta(interface) {
        $.ajax({
            url: '<?= $company['billing'] ?>' + '/monitoring-pppoe.php?interface=' + interface,
            datatype: "json",
            success: function(data) {
                var midata = JSON.parse(data);
                // console.log(midata);
                if (midata.length > 0) {
                    var TX = parseInt(midata[0].data);
                    var RX = parseInt(midata[1].data);
                    var x = (new Date()).getTime();
                    shift = chart.series[0].data.length > 19;
                    chart.series[0].addPoint([x, TX], true, shift);
                    chart.series[1].addPoint([x, RX], true, shift);
                    document.getElementById("tabletx").innerHTML = convert(TX);
                    document.getElementById("tablerx").innerHTML = convert(RX);
                } else {
                    document.getElementById("tabletx").innerHTML = "0";
                    document.getElementById("tablerx").innerHTML = "0";
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.error("Status: " + textStatus + " request: " + XMLHttpRequest);
                console.error("Error: " + errorThrown);
            }
        });
    }

    $(document).ready(function() {
        Highcharts.setOptions({
            global: {
                useUTC: false
            }
        });

        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'graph',
                animation: Highcharts.svg,
                type: 'spline',
                events: {
                    load: function() {
                        setInterval(function() {
                            requestDatta(document.getElementById("interface").value);
                        }, 1000);
                    }
                }
            },
            title: {
                text: 'Monitoring'
            },
            xAxis: {
                type: 'datetime',
                tickPixelInterval: 150,
                maxZoom: 20 * 1000
            },

            yAxis: {
                minPadding: 0.2,
                maxPadding: 0.2,
                title: {
                    text: 'Traffic'
                },
                labels: {
                    formatter: function() {
                        var bytes = this.value;
                        var sizes = ['b/s', 'Kb/s', 'Mb/s', 'Gb/s', 'Tb/s'];
                        if (bytes == 0) return '0 b/s';
                        var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
                        return parseFloat((bytes / Math.pow(1024, i)).toFixed(2)) + ' ' + sizes[i];
                    },
                },
            },
            series: [{
                name: 'TX',
                data: []
            }, {
                name: 'RX',
                data: []
            }],
            tooltip: {
                headerFormat: '<b>{series.name}</b><br/>',
                pointFormat: '{point.x:%Y-%m-%d %H:%M:%S}<br/>{point.y}'
            },
        });
    });

    function convert(bytes) {

        var sizes = ['b/s', 'Kb/s', 'Mb/s', 'Gb/s', 'Tb/s'];
        if (bytes == 0) return '0 b/s';
        var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
        return parseFloat((bytes / Math.pow(1024, i)).toFixed(2)) + ' ' + sizes[i];
    }
</script>
<?php
$API = new routeros();
$API->connect($host, $port, $user, $pass);
if (isset($_POST['save'])) {
    $pid = ($_POST['id']);
    $username = (preg_replace('/\s+/', '-', $_POST['name']));
    $password = ($_POST['password']);
    $service = ($_POST['service']);
    $profile = ($_POST['profile']);
    $local = ($_POST['local']);
    $remote = ($_POST['remote']);
    $comment = ($_POST['comment']);
    if ($local == '') {
        if ($remote == '') {
            if ($comment == '') {
                $API->comm("/ppp/secret/set", array(
                    ".id" => "$pid",
                    "name" => "$username",
                    "password" => "$password",
                    "service" => "$service",
                    "profile" => "$profile",
                ));
            } else {
                $API->comm("/ppp/secret/set", array(
                    ".id" => "$pid",
                    "name" => "$username",
                    "password" => "$password",
                    "service" => "$service",
                    "profile" => "$profile",
                    "comment" => "$comment",
                ));
            }
        } else {
            $API->comm("/ppp/secret/set", array(
                ".id" => "$pid",
                "name" => "$username",
                "password" => "$password",
                "service" => "$service",
                "profile" => "$profile",
                "remote-address" => "$remote",
                "comment" => "$comment",
            ));
        }
    } else {
        $API->comm("/ppp/secret/set", array(
            ".id" => "$pid",
            "name" => "$username",
            "password" => "$password",
            "service" => "$service",
            "profile" => "$profile",
            "local-address" => "$local",
            "remote-address" => "$remote",
            "comment" => "$comment",
        ));
    }
    if ($remote == '') {
        if ($local == '') {
            if ($comment == '') {
                $API->comm("/ppp/secret/set", array(
                    ".id" => "$pid",
                    "name" => "$username",
                    "password" => "$password",
                    "service" => "$service",
                    "profile" => "$profile",
                ));
            } else {
                $API->comm("/ppp/secret/set", array(
                    ".id" => "$pid",
                    "name" => "$username",
                    "password" => "$password",
                    "service" => "$service",
                    "profile" => "$profile",
                    "comment" => "$comment",
                ));
            }
        } else {
            $API->comm("/ppp/secret/set", array(
                ".id" => "$pid",
                "name" => "$username",
                "password" => "$password",
                "service" => "$service",
                "profile" => "$profile",
                "local-address" => "$local",
                "comment" => "$comment",
            ));
        }
    } else {
        $API->comm("/ppp/secret/set", array(
            ".id" => "$pid",
            "name" => "$username",
            "password" => "$password",
            "service" => "$service",
            "profile" => "$profile",
            "local-address" => "$local",
            "remote-address" => "$remote",
            "comment" => "$comment",
        ));
    }
    if ($comment == '') {
        if ($local == '') {
            if ($remote == '') {
                $API->comm("/ppp/secret/set", array(
                    ".id" => "$pid",
                    "name" => "$username",
                    "password" => "$password",
                    "service" => "$service",
                    "profile" => "$profile",
                ));
            } else {
                $API->comm("/ppp/secret/set", array(
                    ".id" => "$pid",
                    "name" => "$username",
                    "password" => "$password",
                    "service" => "$service",
                    "profile" => "$profile",
                    "remote-address" => "$remote",
                ));
            }
        } else {
            $API->comm("/ppp/secret/set", array(
                ".id" => "$pid",
                "name" => "$username",
                "password" => "$password",
                "service" => "$service",
                "profile" => "$profile",
                "local-address" => "$local",
                "remote-address" => "$remote",
            ));
        }
    } else {
        $API->comm("/ppp/secret/set", array(
            ".id" => "$pid",
            "name" => "$username",
            "password" => "$password",
            "service" => "$service",
            "profile" => "$profile",
            "local-address" => "$local",
            "remote-address" => "$remote",
            "comment" => "$comment",
        ));
    }

    echo "<script>window.location='./" . $_POST['name'] . "'</script>";
}
?>