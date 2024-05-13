<!-- Page Heading -->

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
<!-- DataTales Example -->
<div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
    <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
        <?php $coverage = $this->db->get_where('coverage', ['coverage_id' => $cov])->row_array() ?>
        <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data Pelanggan Area <?= $coverage['c_name']; ?></h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr style="text-align: center">
                        <th style="text-align: center; width:20px">No</th>
                        <th>No Layanan</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>No Telp.</th>
                        <th style="width: 100px">Tagihan / Bulan</th>
                        <th style="text-align: center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $no = 1;
                    foreach ($customer as $r => $data) { ?>
                        <tr>
                            <td style="text-align: center"><?= $no++ ?>.</td>
                            <td><?= $data->no_services ?> <br>
                                <a href="<?= site_url('services/detail/') ?><?= $data->no_services ?>" class="btn btn-success" style="font-size: smaller">Rincian Paket</a>
                            </td>
                            <td><a href="#" data-toggle="modal" data-target="#detail<?= $data->no_services ?>" title="Detail">
                                    <div class="badge badge-primary"><?= $data->name ?></div>
                                </a></td>
                            <td><?= $data->email ?></td>
                            <td><?= $data->c_status ?></td>
                            <td><?= $data->no_wa ?></td>
                            <td style="text-align:right; font-weight:bold ">
                                <?php $query = "SELECT *
                                    FROM `services`
                                        WHERE `services`.`no_services` = $data->no_services";
                                $querying = $this->db->query($query)->result(); ?>
                                <?php $subtotal = 0;
                                foreach ($querying as  $dataa)
                                    $subtotal += (int) $dataa->total;
                                ?>
                                <?= indo_currency($subtotal) ?>

                            </td>
                            <td style="text-align: center"><a href="<?= site_url('customer/edit/') ?><?= $data->customer_id ?>" title="Edit"><i class="fa fa-edit" style="font-size:25px"></i></a> <a href="" data-toggle="modal" data-target="#DeleteModal<?= $data->customer_id ?>" title="Hapus"><i class="fa fa-trash" style="font-size:25px; color:red"></i></a></td>
                        </tr>
                    <?php } ?>
                </tbody>

            </table>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<?php foreach ($customer as $r => $data) { ?>
    <div class="modal fade" id="detail<?= $data->no_services ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Pelanggan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label">Nama:</label>
                        <input type="text" class="form-control" value="<?= $data->name ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Email:</label>
                        <input type="text" class="form-control" value="<?= $data->email ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">No Telp:</label>
                        <input type="text" class="form-control" value="<?= $data->no_wa ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">No KTP:</label>
                        <input type="text" class="form-control" value="<?= $data->no_ktp ?>" readonly>
                        <img src="<?= site_url('assets/images/ktp/' . $data->ktp) ?>" alt="" style="width:400px;">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Alamat:</label>
                        <textarea class="form-control" id="message-text" readonly><?= $data->address; ?></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>

                </div>

            </div>
        </div>
    </div>
<?php } ?>
<!-- Modal Edit -->
<!-- Modal Hapus -->