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
        <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data Cronjob WhatsApp</h6>
    </div>
    <div class="card-body">
        <section class="content">
            <div class="box">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Scheduler</th>
                                <th>Start Time</th>
                                <th>Run Count</th>
                                <th>Next Run</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
                            $API  = new routeros();
                            $host = $myrouter['host_router'];
                            $user = $myrouter['user_router'];
                            $pass = $myrouter['pass_router'];
                            $port = $myrouter['port_router'];
                            $API->connect($host, $port, $user, $pass);

                            $waktu  = $API->comm("/system/clock/print");
                            $waktu2 = json_encode($waktu);
                            $waktu3 = json_decode($waktu2, true);
                            $time   = $waktu3['0']['time'];
                            $date   = $waktu3['0']['date'];

                            $autoisolir    = $API->comm("/system/scheduler/print", array(
                                '?name'    => 'Auto-Isolir'
                            ));
                            $autoisolir2   = json_encode($autoisolir);
                            $autoisolir3   = json_decode($autoisolir2, true);

                            $autoaktivasi  = $API->comm("/system/scheduler/print", array(
                                '?name'    => 'Auto-Aktivasi'
                            ));
                            $autoaktivasi2 = json_encode($autoaktivasi);
                            $autoaktivasi3 = json_decode($autoaktivasi2, true);

                            $autoperiode     = $API->comm("/system/scheduler/print", array(
                                '?name'    => 'Auto-Periode'
                            ));
                            $autoperiode2    = json_encode($autoperiode);
                            $autoperiode3    = json_decode($autoperiode2, true);

                            $autocronjob   = $API->comm("/system/scheduler/print", array(
                                '?name'    => 'Auto-Tempo'
                            ));
                            $autocronjob2  = json_encode($autocronjob);
                            $autocronjob3  = json_decode($autocronjob2, true);

                            $autoremind  = $API->comm("/system/scheduler/print", array(
                                '?name'    => 'Auto-Remind'
                            ));
                            $autoremind2 = json_encode($autoremind);
                            $autoremind3 = json_decode($autoremind2, true);
                            ?>
                            <tr>
                                <td class="text-center">1</td>
                                <td class="text-left">Auto-Isolir</td>
                                <?php if ($autoisolir3['0']['name'] == '' || $autoisolir3['0']['name'] == NULL) { ?>
                                    <td class="text-center">-</td>
                                    <td class="text-center">0 Kali</td>
                                    <td class="text-center">-</td>
                                    <td class="text-center">Non-Aktif</td>
                                    <td class="text-center">
                                        <a href="" data-toggle="modal" data-target="#modalisolir" class="d-sm-inline-block btn btn-sm btn-success shadow-sm">ATUR</a>
                                    </td>
                                <?php } else { ?>
                                    <td class="text-center"><?= $autoisolir3['0']['start-time']; ?></td>
                                    <td class="text-center"><?= $autoisolir3['0']['run-count']; ?> Kali</td>
                                    <td class="text-center"><?= $autoisolir3['0']['next-run']; ?></td>
                                    <td class="text-center">Aktif</td>
                                    <td class="text-center">
                                        <a href="<?= site_url('whatsapp/resetcronjob/') ?>Auto-Isolir" class="d-sm-inline-block btn btn-sm btn-danger shadow-sm">RESET</a>
                                    </td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td class="text-left">Auto-Aktivasi</td>
                                <?php if ($autoaktivasi3['0']['name'] == '' || $autoaktivasi3['0']['name'] == NULL) { ?>
                                    <td class="text-center">-</td>
                                    <td class="text-center">0 Kali</td>
                                    <td class="text-center">-</td>
                                    <td class="text-center">Non-Aktif</td>
                                    <td class="text-center">
                                        <a href="" data-toggle="modal" data-target="#modalaktivasi" class="d-sm-inline-block btn btn-sm btn-success shadow-sm">ATUR</a>
                                    </td>
                                <?php } else { ?>
                                    <td class="text-center"><?= $autoaktivasi3['0']['start-time']; ?></td>
                                    <td class="text-center"><?= $autoaktivasi3['0']['run-count']; ?> Kali</td>
                                    <td class="text-center"><?= $autoaktivasi3['0']['next-run']; ?></td>
                                    <td class="text-center">Aktif</td>
                                    <td class="text-center">
                                        <a href="<?= site_url('whatsapp/resetcronjob/') ?>Auto-Aktivasi" class="d-sm-inline-block btn btn-sm btn-danger shadow-sm">RESET</a>
                                    </td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td class="text-center">3</td>
                                <td class="text-left">Auto-Periode</td>
                                <?php if ($autoperiode3['0']['name'] == '' || $autoperiode3['0']['name'] == NULL) { ?>
                                    <td class="text-center">-</td>
                                    <td class="text-center">0 Kali</td>
                                    <td class="text-center">-</td>
                                    <td class="text-center">Non-Aktif</td>
                                    <td class="text-center">
                                        <a href="" data-toggle="modal" data-target="#modalperiode" class="d-sm-inline-block btn btn-sm btn-success shadow-sm">ATUR</a>
                                    </td>
                                <?php } else { ?>
                                    <td class="text-center"><?= $autoperiode3['0']['start-time']; ?></td>
                                    <td class="text-center"><?= $autoperiode3['0']['run-count']; ?> Kali</td>
                                    <td class="text-center"><?= $autoperiode3['0']['next-run']; ?></td>
                                    <td class="text-center">Aktif</td>
                                    <td class="text-center">
                                        <a href="<?= site_url('whatsapp/resetcronjob/') ?>Auto-Periode" class="d-sm-inline-block btn btn-sm btn-danger shadow-sm">RESET</a>
                                    </td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td class="text-center">4</td>
                                <td class="text-left">Auto-Tempo</td>
                                <?php if ($autocronjob3['0']['name'] == '' || $autocronjob3['0']['name'] == NULL) { ?>
                                    <td class="text-center">-</td>
                                    <td class="text-center">0 Kali</td>
                                    <td class="text-center">-</td>
                                    <td class="text-center">Non-Aktif</td>
                                    <td class="text-center">
                                        <a href="" data-toggle="modal" data-target="#modaltempo" class="d-sm-inline-block btn btn-sm btn-success shadow-sm">ATUR</a>
                                    </td>
                                <?php } else { ?>
                                    <td class="text-center"><?= $autocronjob3['0']['start-time']; ?></td>
                                    <td class="text-center"><?= $autocronjob3['0']['run-count']; ?> Kali</td>
                                    <td class="text-center"><?= $autocronjob3['0']['next-run']; ?></td>
                                    <td class="text-center">Aktif</td>
                                    <td class="text-center">
                                        <a href="<?= site_url('whatsapp/resetcronjob/') ?>Auto-Tempo" class="d-sm-inline-block btn btn-sm btn-danger shadow-sm">RESET</a>
                                    </td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td class="text-center">5</td>
                                <td class="text-left">Auto-Remind</td>
                                <?php if ($autoremind3['0']['name'] == '' || $autoremind3['0']['name'] == NULL) { ?>
                                    <td class="text-center">-</td>
                                    <td class="text-center">0 Kali</td>
                                    <td class="text-center">-</td>
                                    <td class="text-center">Non-Aktif</td>
                                    <td class="text-center">
                                        <a href="" data-toggle="modal" data-target="#modalremind" class="d-sm-inline-block btn btn-sm btn-success shadow-sm">ATUR</a>
                                    </td>
                                <?php } else { ?>
                                    <td class="text-center"><?= $autoremind3['0']['start-time']; ?></td>
                                    <td class="text-center"><?= $autoremind3['0']['run-count']; ?> Kali</td>
                                    <td class="text-center"><?= $autoremind3['0']['next-run']; ?></td>
                                    <td class="text-center">Aktif</td>
                                    <td class="text-center">
                                        <a href="<?= site_url('whatsapp/resetcronjob/') ?>Auto-Remind" class="d-sm-inline-block btn btn-sm btn-danger shadow-sm">RESET</a>
                                    </td>
                                <?php } ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalremind" tabindex="-1" aria-labelledby="formModalLabelContact" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabelContact">Setting Auto Remind</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('/whatsapp/aturcronjob') ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label><i>Waktu Kirim</i></label>
                                <input type="time" name="start_time" id="start_time" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label><i>Tanggal Kirim</i></label>
                                <input type="number" name="tanggal" id="tanggal" class="form-control" value="<?= date('d') ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><i>Script</i></label>
                        <input type="hidden" name="kategori" id="kategori" value="Auto-Remind" class="form-control" readonly>
                        <input type="hidden" name="interval" id="interval" value="1d" class="form-control" readonly>
                        <input type="hidden" name="start_date" id="start_date" value="<?= $date ?>" class="form-control" readonly>
                        <input type="text" name="script" id="script" value="<?= base_url() ?>cronjob/remind" class="form-control" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        <button type="submit" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modaltempo" tabindex="-1" aria-labelledby="formModalLabelContact" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabelContact">Setting Auto Tempo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('/whatsapp/aturcronjob') ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label><i>Waktu Kirim</i></label>
                                <input type="time" name="start_time" id="start_time" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label><i>Tanggal Kirim</i></label>
                                <input type="number" name="tanggal" id="tanggal" class="form-control" value="<?= date('d') ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><i>Script</i></label>
                        <input type="hidden" name="kategori" id="kategori" value="Auto-Tempo" class="form-control" readonly>
                        <input type="hidden" name="interval" id="interval" value="1d" class="form-control" readonly>
                        <input type="hidden" name="start_date" id="start_date" value="<?= $date ?>" class="form-control" readonly>
                        <input type="text" name="script" id="script" value="<?= base_url() ?>cronjob/jatuhtempo" class="form-control" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        <button type="submit" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalisolir" tabindex="-1" aria-labelledby="formModalLabelContact" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabelContact">Setting Auto Isolir</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('/whatsapp/aturcronjob') ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label><i>Waktu Kirim</i></label>
                                <input type="time" name="start_time" id="start_time" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label><i>Tanggal Kirim</i></label>
                                <input type="number" name="tanggal" id="tanggal" class="form-control" value="<?= date('d') ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><i>Script</i></label>
                        <input type="hidden" name="kategori" id="kategori" value="Auto-Isolir" class="form-control" readonly>
                        <input type="hidden" name="interval" id="interval" value="1d" class="form-control" readonly>
                        <input type="hidden" name="start_date" id="start_date" value="<?= $date ?>" class="form-control" readonly>
                        <input type="text" name="script" id="script" value="<?= base_url() ?>cronjob/autoisolir" class="form-control" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        <button type="submit" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalperiode" tabindex="-1" aria-labelledby="formModalLabelContact" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabelContact">Setting Per Periode</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('/whatsapp/aturcronjob') ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label><i>Waktu Kirim</i></label>
                                <input type="time" name="start_time" id="start_time" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label><i>Tanggal Kirim</i></label>
                                <input type="number" name="tanggal" id="tanggal" class="form-control" value="<?= date('d') ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><i>Script</i></label>
                        <input type="hidden" name="kategori" id="kategori" value="Auto-Periode" class="form-control" readonly>
                        <input type="hidden" name="interval" id="interval" value="31d" class="form-control" readonly>
                        <input type="hidden" name="start_date" id="start_date" value="<?= $date ?>" class="form-control" readonly>
                        <input type="text" name="script" id="script" value="<?= base_url() ?>cronjob/kirimmassal" class="form-control" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        <button type="submit" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalaktivasi" tabindex="-1" aria-labelledby="formModalLabelContact" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabelContact">Setting Auto Aktivasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('/whatsapp/aturcronjob') ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label><i>Waktu Kirim</i></label>
                                <input type="time" name="start_time" id="start_time" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label><i>Tanggal Kirim</i></label>
                                <input type="number" name="tanggal" id="tanggal" class="form-control" value="<?= date('d') ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><i>Script</i></label>
                        <input type="hidden" name="kategori" id="kategori" value="Auto-Aktivasi" class="form-control" readonly>
                        <input type="hidden" name="interval" id="interval" value="1d" class="form-control" readonly>
                        <input type="hidden" name="start_date" id="start_date" value="<?= $date ?>" class="form-control" readonly>
                        <input type="text" name="script" id="script" value="<?= base_url() ?>cronjob/aktivasi" class="form-control" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        <button type="submit" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>