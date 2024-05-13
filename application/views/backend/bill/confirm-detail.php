<?php $subtotal = 0;
foreach ($invoice->result() as $c => $data) {
    $subtotal += (int) $data->total;
} ?>
<?php
$month = $bill['month'];
$year = $bill['year'];
$no_services = $bill['no_services'];
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
<?php if ($other['code_unique'] == 1) {
    $code_unique = $bill['code_unique'];
} ?>
<?php if ($other['code_unique'] != 1) {
    $code_unique = 0;
} ?>

<?php if ($subtotal != 0) { ?>
    <?php $ppn = $subtotal * ($bill['i_ppn'] / 100) ?>
    <?php $tagihan = $subtotal + $code_unique + $ppn ?>
<?php } ?>
<?php if ($subtotal == 0) { ?>
    <?php $ppn = $subTotaldetail * ($bill['i_ppn'] / 100) ?>
    <?php $tagihan = $subTotaldetail + $code_unique + $ppn ?>
<?php } ?>
<?php if ($subtotal != 0) { ?>
    <?php $ppn = $subtotal * ($bill['i_ppn'] / 100) ?>
    <?php $nominal = $subtotal + $ppn  ?>
<?php } ?>
<?php if ($subtotal == 0) { ?>
    <?php $ppn = $subTotaldetail * ($bill['i_ppn'] / 100) ?>
    <?php $nominal = $subTotaldetail + $ppn  ?>
<?php } ?>
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
<div class="col-lg-12">
    <div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
        <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
            <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Konfirmasi Pembayaran #<?= $bill['invoice'] ?></h6>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card-body">
                    <?php echo form_open_multipart('bill/confirmupdate') ?>
                    <div class="form-group">
                        <?php $Confirm = $this->db->get_where('confirm_payment', ['invoice_id' => $bill['invoice']])->row_array(); ?>
                        <label for="invoice">No invoice</label>
                        <input type="text" class="form-control" id="invoice" name="invoice" value="<?= $bill['invoice'] ?>" readonly>
                        <input type="hidden" class="form-control" id="confirm_id" name="confirm_id" value="<?= $Confirm['confirm_id'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama Pelanggan</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= $bill['name'] ?>" readonly>

                    </div>
                    <div class="form-group">
                        <label for="no_services">No Layanan</label>
                        <input type="text" class="form-control" id="no_services" name="no_services" value="<?= $bill['no_services'] ?>" readonly>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tagihan">Total Tagihan</label>
                                <input type="text" class="form-control" id="tagihan" name="tagihan" value="<?= indo_currency($tagihan) ?>" readonly>
                                <input type="hidden" class="form-control" id="nominal" name="nominal" value="<?= $nominal ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="periode">Periode</label>
                                <input type="text" class="form-control" id="periode" value="<?= indo_month($bill['month']) ?> <?= $bill['year'] ?>" readonly>
                                <input type="hidden" class="form-control" id="periode" name="month" value="<?= indo_month($bill['month']) ?>" readonly>
                                <input type="hidden" class="form-control" id="periode" name="year" value="<?= indo_month($bill['year']) ?>" readonly>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">

                        <label for="date_payment">Tanggal Pembayaran</label>
                        <input type="text" class="form-control" id="datepicker" value="<?= indo_date($Confirm['date_payment']) ?>" readonly>
                        <input type="hidden" class="form-control" id="datepicker" name="date_payment" value="<?= $Confirm['date_payment'] ?>" readonly>

                    </div>
                    <div class="form-group">
                        <label for="remark">Remark</label>
                        <textarea id="remark" name="remark" class="form-control" readonly><?= $Confirm['remark'] ?></textarea>
                    </div>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="card-body">
                    <div class="form-group">
                        <label for="bukti">Bukti Pembayaran</label>
                        <img src="<?= site_url('assets/images/confirm/') ?><?= $Confirm['picture'] ?>" style=" margin-top: 8px;
   width: 100%;
   padding: 10px;" alt="" alt="">
                    </div>
                </div>
                <?php if ($Confirm['status'] == 'Pending') { ?>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Verifikasi</button>
                    </div>
                <?php } ?>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>