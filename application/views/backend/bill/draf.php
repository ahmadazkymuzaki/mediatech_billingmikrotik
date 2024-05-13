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
        <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Tagihan Bulan <?= indo_month(date('m')) ?> <?= date('Y') ?> <sup style="color: red;">Draf </sup> <a href="" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-info-circle" style="font-size: 24px"></i></a></h6>
    </div>
    <div class="card-body">
        <?php $month = date('m');
        $year = date('Y');
        $query = "SELECT *
                                    FROM `invoice`
                                        WHERE  `invoice`.`month` = $month and `invoice`.`year` = $year";
        $cekbillthismonth = $this->db->query($query)->row_array();
        // var_dump($cekbillthismonth)
        ?>
        <?php if ($cekbillthismonth <= 0) { ?>
            <div class="col-lg-3 col-sm-6 mb-2 col-md-4 text-left">
                <button href="" data-toggle="modal" data-target="#addModalGenerate" class="btn btn-outline-success"><i class="fa fa-save"></i> Simpan Semua</button>
            </div>
        <?php } ?>
        <div class="table-responsive">
            <input type="hidden" name='no_services[]' id="result" size="60">
            <table class="table table-bordered" id="tablebt" width="100%" cellspacing="0">
                <thead>
                    <tr style="text-align: center">
                        <th style="text-align: center; width:20px">No</th>
                        <th>No Layanan</th>
                        <th>Nama</th>
                        <th style="text-align:center">Tagihan</th>
                        <th>Status</th>
                        <th style="text-align: center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($customer as $r => $data) { ?>
                        <tr>
                            <td style="text-align: center"><?= $no++ ?>.</td>
                            <td style="text-align: center"><?= $data->no_services ?> <br>
                                <?php $month = date('m');
                                $year = date('Y');
                                $query = "SELECT *
                                    FROM `invoice`
                                        WHERE `invoice`.`no_services` = $data->no_services and `invoice`.`month` = $month and `invoice`.`year` = $year";
                                $querying = $this->db->query($query)->row_array();
                                // var_dump($querying)
                                ?>
                                <?php if ($querying == Null) { ?>
                                    <a href="<?= site_url('services/detail/') ?><?= $data->no_services ?>" class="btn btn-success" style="font-size: smaller">Rincian Paket</a>
                                <?php } ?>
                            </td>
                            <td><?= $data->name ?></td>
                            <?php if ($querying != Null) { ?>
                                <td style="text-align:right; font-weight:bold ">
                                    <?php $month = date('m');
                                    $year = date('Y');
                                    $no_services = $data->no_services;
                                    $query = "SELECT *
                                  FROM `invoice_detail`
                            Join `invoice` ON `invoice`.`invoice` = `invoice_detail`.`invoice_id`
                                WHERE `invoice`.`month` =  $month and
                               `invoice`.`year` =  $year and
                               `invoice`.`no_services` = $no_services";
                                    $queryinvoice = $this->db->query($query)->result(); ?>
                                    <?php $subtotal = 0;
                                    foreach ($queryinvoice as  $dataa)
                                        $subtotal += (int) $dataa->total;
                                    ?>
                                    <?php
                                    $month = date('m');
                                    $year = date('Y');
                                    $no_services = $data->no_services;
                                    $query = "SELECT *
                                    FROM `invoice_detail`
                                        WHERE `invoice_detail`.`d_month` =  $month and
                                       `invoice_detail`.`d_year` =  $year and
                                       `invoice_detail`.`d_no_services` =  $no_services";
                                    $queryTot = $this->db->query($query)->result(); ?>
                                    <?php $subTotaldetail = 0;
                                    foreach ($queryTot as  $dataa)
                                        $subTotaldetail += (int) $dataa->total;
                                    ?>
                                    <!-- KODE UNIK -->
                                    <?php if ($other['code_unique'] == 1) { ?>
                                        <?php $code_unique = $querying['code_unique'] ?>
                                    <?php } ?>
                                    <?php if ($other['code_unique'] == 0) { ?>
                                        <?php $code_unique = 0 ?>
                                    <?php } ?>
                                    <!-- END KODE UNIK -->
                                    <?php if ($subtotal != 0) { ?>
                                        <?php $ppn = $subtotal * ($querying['i_ppn'] / 100)  ?>
                                        <?= indo_currency($subtotal + $ppn + $code_unique); ?>
                                    <?php } ?>
                                    <?php if ($subtotal == 0) { ?>
                                        <?php $ppn = $subTotaldetail * ($querying['i_ppn'] / 100)  ?>
                                        <?= indo_currency($subTotaldetail + $ppn + $code_unique); ?>
                                    <?php } ?>
                                </td>
                                <?php if ($querying['status'] == 'BELUM BAYAR') { ?>
                                    <td style="text-align: center">
                                        <div class="badge badge-danger"><?= $querying['status'] ?></div>
                                    </td>
                                <?php } ?>
                                <?php if ($querying['status'] == 'SUDAH BAYAR') { ?>
                                    <td style="text-align: center">
                                        <div class="badge badge-success"><?= $querying['status'] ?></div>
                                    </td>
                                <?php } ?>
                                <td></td>
                            <?php } ?>
                            <?php if ($querying == Null) { ?>
                                <td style="text-align:right; font-weight:bold ">
                                    <?php $query = "SELECT *
                                    FROM `services`
                                        WHERE `services`.`no_services` = $data->no_services";
                                    $bill = $this->db->query($query)->result(); ?>
                                    <?php $subtotal = 0;
                                    foreach ($bill as  $dataa)
                                        $subtotal += (int) $dataa->total;
                                    ?>
                                    <?= indo_currency($subtotal) ?>
                                </td>
                                <td style="text-align: center">Tagihan Belum Disimpan</td>
                                <td style="text-align: center"><a href="" data-toggle="modal" data-target="#SaveModal<?= $data->customer_id ?>" title="Simpan Tagihan"><i class="fa fa-save" title="Simpan Tagihan" style="font-size:25px; color:blue"></i></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="addModalGenerate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Generate Tagihan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('bill/generateBill') ?>
                <input type="hidden" name="invoice" value="<?= $invoice ?>">
                <input type="hidden" name="month" value="<?= date('m') ?>">
                <input type="hidden" name="year" value="<?= date('Y') ?>">
                Apakah anda yakin akan simpan semua tagihan ?
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Ya, Lanjutkan</button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>
<!-- Bill Save -->
<?php
foreach ($customer as $r => $data) { ?>
    <div class="modal fade" id="SaveModal<?= $data->customer_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Simpan Tagihan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('bill/addBillDraf') ?>
                    <input type="hidden" name="no_services" value="<?= $data->no_services ?>" class="form-control">
                    <input type="hidden" name="month" value="<?= date('m') ?>" class="form-control">
                    <input type="hidden" name="invoice" value="<?= $invoice ?>">
                    <input type="hidden" name="year" value="<?= date('Y') ?>" class="form-control">
                    Simpan Tagihan A/N <?= $data->name ?> Periode <?= indo_month(date('m')) ?> <?= date('Y') ?> ?
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>">Simpan</button>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-info-circle" style="font-size: 24px"></i> Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <li>Halaman ini adalah draf Tagihan semua pelanggan setiap pergantian bulan</li>
                <li>Jika status tagihan belum disimpan, maka pelanggan tidak akan bisa cek tagihan </li>
                <li>Tombol <button class="btn btn-outline-success" style="font-size: 10px;">Simpan Semua</button> akan berfungsi jika semua status tagihan belum disimpan</li>
                <li>Jika ada pelanggan baru setelah klik simpan semua / generate, maka cukup klik saja tombol save <i class="fa fa-save"></i></li>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>">Save changes</button>
            </div>
        </div>
    </div>
</div>