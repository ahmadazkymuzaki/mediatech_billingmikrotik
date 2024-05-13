<!-- bootstrap datepicker -->
<link rel="stylesheet" href="https://files.billing.or.id/assets/backend/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <a href="#" data-toggle="modal" data-target="#add" class="d-sm-inline-block btn btn-sm btn-<?= $company['theme'] ?> shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah</a>
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
        <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data User Static (<?= $totalpppstatic; ?> item)</h6>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="tablebt" width="100%" cellspacing="0">
                <thead>
                    <tr style="text-align: center;">
                        <th>No</th>
                        <th>Name</th>
                        <th>Max Limit</th>
                        <th>Limit At</th>
                        <th>Bytes</th>
                        <th>Parent</th>
                        <th>Komentar</th>
                        <?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 10) { ?>
                            <th>Aksi</th>
                        <?php } ?>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    function formatBytes($bytes, $decimal = null)
                    {
                        $satuan = ['B', 'KB', 'MB', 'GB', 'TB'];
                        $i = 0;
                        while ($bytes > 1024) {
                            $bytes /= 1024;
                            $i++;
                        }
                        return round($bytes, $decimal) . ' ' . $satuan[$i];
                    }
                    $no = 1;
                    foreach ($pppstatic as $dataku) {
                        $id             = str_replace('*', '', $dataku['.id']);
                        $name           = $dataku['name'];
                        $target         = $dataku['target'];
                        $thismaxlimit   = $dataku['max-limit'];
                        $thislimitat    = $dataku['limit-at'];
                        $thisbytes      = $dataku['bytes'];
                        $comment        = $dataku['comment'];
                        $parent         = $dataku['parent'];
                        $maxlimit       = explode("/", $thismaxlimit);
                        $maxlimitup     = formatBytes($maxlimit[0]);
                        $maxlimitdown   = formatBytes($maxlimit[1]);
                        $limitat        = explode("/", $thislimitat);
                        $limitatup      = formatBytes($limitat[0]);
                        $limitatdown    = formatBytes($limitat[1]);
                        $bytes        = explode("/", $thisbytes);
                        $bytesup      = formatBytes($bytes[0]);
                        $bytesdown    = formatBytes($bytes[1]);
                    ?>
                        <tr style="text-align: center; height: 25px; margin:auto;">
                            <td><?= $no++ ?></td>
                            <td><?= $dataku['name'] ?></td>
                            <td><?= $maxlimitup ?> / <?= $maxlimitdown ?></td>
                            <td><?= $limitatup ?> / <?= $limitatdown ?></td>
                            <td><?= $bytesup ?> / <?= $bytesdown ?></td>
                            <td><?= $parent ?></td>
                            <td><?= $comment ?></td>
                            <?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 10) { ?>
                                <td>
                                    <a href="<?= site_url('ppp/detailstatic/' . $name) ?>" title="Detail">
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah User Static</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= site_url('ppp/addstatic') ?>" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="remark">Pilih Pelanggan</label>
                                <select id="no_service" name="no_service" class="selectpicker show-tick form-control" data-live-search="true" tabindex="-98" required>
                                    <option value="">- Pilih Pelanggan -</option>
                                    <?php
                                    $data_customer = $this->db->get_where('customer')->result();
                                    foreach ($data_customer as $data10) {
                                    ?>
                                        <option value="<?= $data10->no_services; ?>"><?= $data10->name; ?> (<?= $data10->no_services; ?>)</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Nama Limit</label>
                                <input type="text" id="name" name="name" placeholder="ayenkmarley" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="target">Target (IP)</label>
                                <input type="text" id="target" name="target" placeholder="192.168.1.234" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="parent">Parent</label>
                                <select id="parent" name="parent" class="selectpicker show-tick form-control" data-live-search="true" tabindex="-98" required>
                                    <option value="">- Plih Parent -</option>
                                    <option value="none">none</option>
                                    <?php foreach ($pppstatic as $mydata) { ?>
                                        <option value="<?= $mydata['name']; ?>"><?= $mydata['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="max_limit">Max Limit</label>
                                <input type="text" id="max_limit" name="max_limit" placeholder="3M/6M" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="burst_limit">Burst Limit</label>
                                <input type="text" id="burst_limit" name="burst_limit" placeholder="5M/10M" value="unlimited/unlimited" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="threshold">B. Threshold</label>
                                <input type="text" id="threshold" name="threshold" placeholder="4M/8M" value="unlimited/unlimited" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="burst_time">Burst Time</label>
                                <input type="text" id="burst_time" name="burst_time" placeholder="10/10" value="0/0" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="limit_at">Limit At</label>
                                <input type="text" id="limit_at" name="limit_at" placeholder="2M/4M" value="unlimited/unlimited" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="priority">Priority</label>
                                <input type="text" id="priority" name="priority" placeholder="3/3" value="8/8" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="bucket_size">Bucket Size</label>
                                <input type="text" id="bucket_size" name="bucket_size" placeholder="0.100/0.100" value="0.100/0.100" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="queue_type">Queue Type</label>
                                <select id="queue_type" name="queue_type" class="selectpicker show-tick form-control" data-live-search="true" tabindex="-98" required>
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