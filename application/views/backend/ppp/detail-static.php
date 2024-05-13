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
    <a href="<?= site_url('ppp/static'); ?>" title="Kembali">
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
                        <table>
                            <?php
                            function formatBytes($bytes, $decimal = null)
                            {
                                $satuan = ['B', 'K', 'M', 'G', 'T'];
                                $i = 0;
                                while ($bytes > 1024) {
                                    $bytes /= 1024;
                                    $i++;
                                }
                                return round($bytes, $decimal) . $satuan[$i];
                            }
                            foreach ($pppstatic as $dataku) {
                                $id             = str_replace('*', '', $dataku['.id']);
                                $name           = $dataku['name'];
                                $target         = $dataku['target'];
                                $thismaxlimit   = $dataku['max-limit'];
                                $thisburstlimit = $dataku['burst-limit'];
                                $thisthreshold  = $dataku['burst-threshold'];
                                $thislimitat    = $dataku['limit-at'];
                                $thisbytes      = $dataku['bytes'];
                                $comment        = $dataku['comment'];
                                $parent         = $dataku['parent'];
                                $maxlimit       = explode("/", $thismaxlimit);
                                $maxlimitup     = formatBytes($maxlimit[0]);
                                $maxlimitdown   = formatBytes($maxlimit[1]);
                                $burstlimit     = explode("/", $thisburstlimit);
                                $burstlimitup   = formatBytes($burstlimit[0]);
                                $burstlimitdown = formatBytes($burstlimit[1]);
                                $threshold      = explode("/", $thisthreshold);
                                $thresholdup    = formatBytes($threshold[0]);
                                $thresholddown  = formatBytes($threshold[1]);
                                $limitat        = explode("/", $thislimitat);
                                $limitatup      = formatBytes($limitat[0]);
                                $limitatdown    = formatBytes($limitat[1]);
                                $bytes          = explode("/", $thisbytes);
                                $bytesup        = formatBytes($bytes[0]);
                                $bytesdown      = formatBytes($bytes[1]);
                            ?>
                                <tr>
                                    <td>Nama Pengguna</td>
                                    <td>&nbsp;&nbsp;&nbsp;</td>
                                    <td>:</td>
                                    <td>&nbsp;</td>
                                    <td><?= $name ?></td>
                                </tr>
                                <tr>
                                    <td>Target (IP)</td>
                                    <td>&nbsp;&nbsp;&nbsp;</td>
                                    <td>:</td>
                                    <td>&nbsp;</td>
                                    <td><?= substr($target, 0, 25) ?></td>
                                </tr>
                                <tr>
                                    <td>Max Limit</td>
                                    <td>&nbsp;&nbsp;&nbsp;</td>
                                    <td>:</td>
                                    <td>&nbsp;</td>
                                    <td><?= $maxlimitup ?>/<?= $maxlimitdown ?></td>
                                </tr>
                                <tr>
                                    <td>Burst Limit</td>
                                    <td>&nbsp;&nbsp;&nbsp;</td>
                                    <td>:</td>
                                    <td>&nbsp;</td>
                                    <td><?= $burstlimitup ?>/<?= $burstlimitdown ?></td>
                                </tr>
                                <tr>
                                    <td>Burst Threshold</td>
                                    <td>&nbsp;&nbsp;&nbsp;</td>
                                    <td>:</td>
                                    <td>&nbsp;</td>
                                    <td><?= $thresholdup ?>/<?= $thresholddown ?></td>
                                </tr>
                                <tr>
                                    <td>Burst Time</td>
                                    <td>&nbsp;&nbsp;&nbsp;</td>
                                    <td>:</td>
                                    <td>&nbsp;</td>
                                    <td><?= $dataku['burst-time'] ?></td>
                                </tr>
                                <tr>
                                    <td>Limit At</td>
                                    <td>&nbsp;&nbsp;&nbsp;</td>
                                    <td>:</td>
                                    <td>&nbsp;</td>
                                    <td><?= $limitatup ?>/<?= $limitatdown ?></td>
                                </tr>
                                <tr>
                                    <td>Priority</td>
                                    <td>&nbsp;&nbsp;&nbsp;</td>
                                    <td>:</td>
                                    <td>&nbsp;</td>
                                    <td><?= $dataku['priority'] ?></td>
                                </tr>
                                <tr>
                                    <td>Bucket Size</td>
                                    <td>&nbsp;&nbsp;&nbsp;</td>
                                    <td>:</td>
                                    <td>&nbsp;</td>
                                    <td><?= $dataku['bucket-size'] ?></td>
                                </tr>
                                <tr>
                                    <td>Queue Type</td>
                                    <td>&nbsp;&nbsp;&nbsp;</td>
                                    <td>:</td>
                                    <td>&nbsp;</td>
                                    <td><?= $dataku['queue'] ?></td>
                                </tr>
                                <tr>
                                    <td>Parent Limit</td>
                                    <td>&nbsp;&nbsp;&nbsp;</td>
                                    <td>:</td>
                                    <td>&nbsp;</td>
                                    <td><?= $dataku['parent'] ?></td>
                                </tr>
                                <tr>
                                    <td>Pemakaian</td>
                                    <td>&nbsp;&nbsp;&nbsp;</td>
                                    <td>:</td>
                                    <td>&nbsp;</td>
                                    <td><?= $bytesup ?>/<?= $bytesdown ?></td>
                                </tr>
                                <tr>
                                    <td>Status Pengguna</td>
                                    <td>&nbsp;&nbsp;&nbsp;</td>
                                    <td>:</td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <?php
                                        if ($pppstatic['0']['disabled'] == 'true') {
                                            echo 'Isolir';
                                        } else {
                                            echo 'Aktif';
                                        } ?>
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
                    </div>
                    <div class="modal-footer">
                        <a href="#" data-toggle="modal" data-target="#edit" title="Edit Pengguna">
                            <input type="button" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>" value="Edit User Static" readonly>
                        </a>
                        <?php if ($pppstatic['0']['disabled'] == 'false') { ?>
                            <a href="<?= site_url('ppp/disablestatic/' . $id) ?>" onclick="return confirm('Apakah anda yakin akan disable user static <?= $dataku['name'] ?> ?')" title="Enable">
                                <input type="button" class="btn btn-secondary" value="Disable User Static" readonly>
                            </a>
                        <?php } ?>
                        <?php if ($pppstatic['0']['disabled'] == 'true') { ?>
                            <a href="<?= site_url('ppp/enablestatic/' . $id) ?>" onclick="return confirm('Apakah anda yakin akan enable user static <?= $dataku['name'] ?> ?')" title="Disable">
                                <input type="button" class="btn btn-success" value="Enable User Static" readonly>
                            </a>
                        <?php } ?>
                        <a href="<?= site_url('ppp/deletestatic/' . $id) ?>" onclick="return confirm('Apakah anda yakin akan menghapus user static <?= $dataku['name'] ?> ?')" title="Delete">
                            <input type="button" class="btn btn-danger" value="Delete User Static" readonly>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Edit -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit User Static</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
            foreach ($pppstatic as $dataku) {
                $id = str_replace('*', '', $dataku['.id']);
                $name           = $dataku['name'];
                $target         = $dataku['target'];
                $thismaxlimit   = $dataku['max-limit'];
                $thisburstlimit = $dataku['burst-limit'];
                $thisthreshold  = $dataku['burst-threshold'];
                $thislimitat    = $dataku['limit-at'];
                $thisbytes      = $dataku['bytes'];
                $comment        = $dataku['comment'];
                $parent         = $dataku['parent'];
                $maxlimit       = explode("/", $thismaxlimit);
                $maxlimitup     = formatBytes($maxlimit[0]);
                $maxlimitdown   = formatBytes($maxlimit[1]);
                $burstlimit     = explode("/", $thisburstlimit);
                $burstlimitup   = formatBytes($burstlimit[0]);
                $burstlimitdown = formatBytes($burstlimit[1]);
                $threshold      = explode("/", $thisthreshold);
                $thresholdup    = formatBytes($threshold[0]);
                $thresholddown  = formatBytes($threshold[1]);
                $limitat        = explode("/", $thislimitat);
                $limitatup      = formatBytes($limitat[0]);
                $limitatdown    = formatBytes($limitat[1]);
                $bytes          = explode("/", $thisbytes);
                $bytesup        = formatBytes($bytes[0]);
                $bytesdown      = formatBytes($bytes[1]);
            ?>
                <div class="modal-body">
                    <form action="<?= site_url('ppp/editstatic/') ?><?= $id ?>" method="POST">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Nama Limit</label>
                                        <input type="text" id="name" name="name" placeholder="<?= $dataku['name'] ?>" value="<?= $name ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="target">Target (IP)</label>
                                        <input type="text" id="target" name="target" placeholder="<?= $dataku['target'] ?>" value="<?= $target ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="parent">Parent</label>
                                        <select id="parent" name="parent" class="selectpicker show-tick form-control" data-live-search="true" tabindex="-98" required>
                                            <option value="<?= $parent ?>"><?= $parent ?></option>
                                            <option value="none">none</option>
                                            <?php foreach ($pppparent as $mydata) { ?>
                                                <option value="<?= $mydata['name']; ?>"><?= $mydata['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="max_limit">Max Limit</label>
                                        <input type="text" id="max_limit" name="max_limit" placeholder="<?= $maxlimitup ?>/<?= $maxlimitdown ?>" value="<?= $maxlimitup ?>/<?= $maxlimitdown ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="burst_limit">Burst Limit</label>
                                        <input type="text" id="burst_limit" name="burst_limit" placeholder="<?= $burstlimitup ?>/<?= $burstlimitdown ?>" value="<?= $burstlimitup ?>/<?= $burstlimitdown ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="threshold">B. Threshold</label>
                                        <input type="text" id="threshold" name="threshold" placeholder="<?= $thresholdup ?>/<?= $thresholddown ?>" value="<?= $thresholdup ?>/<?= $thresholddown ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="burst_time">Burst Time</label>
                                        <input type="text" id="burst_time" name="burst_time" placeholder="<?= $dataku['burst-time'] ?>" value="<?= $dataku['burst-time'] ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="limit_at">Limit At</label>
                                        <input type="text" id="limit_at" name="limit_at" placeholder="<?= $limitatup ?>/<?= $limitatdown ?>" value="<?= $limitatup ?>/<?= $limitatdown ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="priority">Priority</label>
                                        <input type="text" id="priority" name="priority" placeholder="<?= $dataku['priority'] ?>" value="<?= $dataku['priority'] ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="bucket_size">Bucket Size</label>
                                        <input type="text" id="bucket_size" name="bucket_size" placeholder="<?= $dataku['bucket-size'] ?>" value="<?= $dataku['bucket-size'] ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="queue_type">Queue Type</label>
                                        <select id="queue_type" name="queue_type" class="selectpicker show-tick form-control" data-live-search="true" tabindex="-98" required>
                                            <option value="<?= $dataku['queue'] ?>"><?= $dataku['queue'] ?></option>
                                            <option value="default-small">default-small</option>
                                            <option value="default">default</option>
                                            <option value="ethernet-default">ethernet-default</option>
                                            <option value="hotspot-default">hotspot-default</option>
                                            <option value="multi-queue-ethernet-default">multi-queue-default</option>
                                            <option value="only-hardware-queue">only-hardware-queue</option>
                                            <option value="synchronous-default">synchronous-default</option>
                                            <option value="wireless-default">wireless-default</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="comment">Komentar</label>
                                        <input type="text" id="comment" name="comment" placeholder="<?= $dataku['comment'] ?>" value="<?= $dataku['comment'] ?>" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>">Simpan</button>
                        </div>
                    </form>
                </div>
            <?php } ?>
        </div>
    </div>