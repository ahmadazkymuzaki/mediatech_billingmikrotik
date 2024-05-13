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
<div class="continer mb-2">
    <div class="row">
        <div class="col-lg-2 col-xl-2 col-md-2 col-sm-6 col-xs-6 col-6">
            <a href="<?= site_url('customer/add') ?>" class="form-control btn btn-sm btn-<?= $company['theme'] ?> shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> &nbsp; Tambah</a>
        </div>
        <div class="col-lg-2 col-xl-2 col-md-2 col-sm-6 col-xs-6 col-6">
            <a href="<?= site_url('assets/excel/') ?>customer.xlsx" target="_blank" class="form-control btn btn-sm btn-warning shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> &nbsp; Download</a>
        </div>
        <div class="col-lg-6 col-xl-6 col-md-6 col-sm-6 col-xs-6 col-6">
            <form method="post" action="<?= site_url('customer/excel') ?>" enctype="multipart/form-data">
                <input type="file" class="form-control" name="excel" id="excel" required>
        </div>
        <div class="col-lg-2 col-xl-2 col-md-2 col-sm-6 col-xs-6 col-6">
            <button type="submit" class="form-control btn btn-sm btn-success shadow-sm"><i class="fas fa-table fa-sm text-white-50"></i> &nbsp; Import Data</button>
            </form>
        </div>
    </div>
</div>
<div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-2">
    <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
        <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data Pelanggan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="tablebt" width="100%" cellspacing="0">
                <thead>
                    <tr style="text-align: center">
                        <th style="text-align: center">No</th>
                        <th style="text-align: center">No Layanan</th>
                        <th style="text-align: center">Nama</th>
                        <th style="text-align: center">Telepon</th>
                        <th style="text-align: center">Status</th>
                        <th style="text-align: center">PPN</th>
                        <th style="text-align: center">Tempo</th>
                        <th style="text-align: center">Tagihan</th>
                        <th style="text-align: center">Refferal</th>
                        <?php if ($this->session->userdata('role_id') == 1) { ?>
                            <th style="text-align: center">Aksi</th>
                        <?php } ?>
                    </tr>
                </thead>

                <tbody>
                    <?php $no = 1;
                    foreach ($customer as $r => $data) { ?>
                        <tr>
                            <td style="text-align: center"><?= $no++ ?>.</td>
                            <td style="text-align: center"><a href="<?= site_url('services/detail/') ?><?= $data->no_services ?>" style="text-decoration: none; font-weight: bold;"><?= $data->no_services ?></a></td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#detail<?= $data->no_services ?>" title="Detail">
                                    <div class="badge badge-primary"><?= $data->name ?></div>
                                </a>
                            </td>
                            <td style="text-align: center">
                                <a href="https://api.whatsapp.com/send/?phone=62<?= substr($data->no_wa, 1, 15) ?>&text=Maaf, Dengan Sdr/i <?= $data->name ?> ?" target="_blank" title="https://api.whatsapp.com/send/?phone=62<?= substr($data->no_wa, 1, 15) ?>&text=Maaf, Dengan Sdr/i <?= $data->name ?> ?" style="color: green; text-decoration: none; font-weight: bold;" title="Detail">
                                    <?= $data->no_wa ?>
                                </a>
                            </td>
                            <td style="text-align: center"><?= $data->c_status ?></td>
                            <td style="text-align: center"><?= $data->ppn == 1 ? 'Yes' : 'No' ?></td>
                            <td style="text-align: center"><?= $data->due_date ?></td>
                            <td style="text-align: right; font-weight: bold;">
                                <?php $querying = $this->db->get_where('services', array('no_services' => $data->no_services))->result(); ?>
                                <?php
                                $jumlah_refferal = $this->db->get_where('customer', array('refferal' => $data->no_services))->num_rows();
                                $subtotal = 0;
                                foreach ($querying as  $dataa)
                                    $subtotal += (int) $dataa->total;
                                ?>
                                <?= indo_currency($subtotal) ?>

                            </td>
                            <?php if ($jumlah_refferal == 0) { ?>
                                <td style="text-align: center">Belum Ada</td>
                            <?php } else { ?>
                                <td style="text-align: center"><?= $jumlah_refferal ?> Orang</td>
                            <?php } ?>
                            <?php if ($this->session->userdata('role_id') == 1) { ?>
                                <td style="text-align: center">
                                    <a href="<?= site_url('customer/edit/') ?><?= $data->customer_id ?>" title="Edit"><i class="fa fa-edit" style="font-size:25px"></i></a> &nbsp;
                                    <a target="_blank" href="<?= site_url('cetak/pelanggan/') ?><?= $data->customer_id ?>" title="Cetak"><i class="fa fa-print" style="font-size:25px; color:black"></i></a> &nbsp;
                                    <a href="" data-toggle="modal" data-target="#DeleteModal<?= $data->customer_id ?>" title="Hapus"><i class="fa fa-trash" style="font-size:25px; color:red"></i></a>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
                <?php if ($this->session->userdata('role_id') == 1) { ?>
                    <?php if ($title == 'Aktif') { ?>
                        <tfoot>

                            <tr style="text-align: right">
                                <th colspan="7">Grand Total</th>
                                <?php $query = "SELECT *
FROM `services` JOIN `customer`  ON `customer`.`no_services` = `services`.`no_services` WHERE  `customer`.`c_status` = 'Aktif' 
";
                                $querying = $this->db->query($query)->result(); ?>
                                <?php $grandtotal = 0;
                                foreach ($querying as  $dataa)
                                    $grandtotal += (int) $dataa->total;
                                ?>
                                <th style="text-align:right; font-weight:bold; color:green"><?= indo_currency($grandtotal) ?></th>
                                <th colspan="2"></th>
                            </tr>
                        </tfoot>
                    <?php } ?>
                <?php } ?>
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
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Alamat:</label>
                        <textarea class="form-control" id="message-text" readonly><?= $data->address; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Foto KTP:</label>
                        <img src="<?= site_url('assets/images/ktp/' . $data->ktp) ?>" alt="" style="width:400px;">
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
<?php
foreach ($customer as $r => $data) { ?>
    <div class="modal fade" id="DeleteModal<?= $data->customer_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Pelanggan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('customer/delete') ?>
                    <input type="hidden" name="customer_id" value="<?= $data->customer_id ?>" class="form-control">
                    <input type="hidden" name="no_services" value="<?= $data->no_services ?>" class="form-control">
                    Apakah yakin akan hapus No Layanan <?= $data->no_services ?> A/N <?= $data->name ?> ?
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>