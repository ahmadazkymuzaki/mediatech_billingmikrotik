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
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="https://files.billing.or.id/assets/backend/bootstrap-datepicker/css/bootstrap-datepicker.min.css">

<div class="col-lg-12">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="<?= site_url('bill'); ?>" title="Kembali">
            <input type="button" class="btn btn-danger" value="Close" readonly>
        </a>
    </div>
    <div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-2">
        <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-1">
            <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Rincian Tagihan</h6> #<?= $bill['no_services'] ?>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-12 control-label">Nama Pelanggan</label>
                            <div class="col-sm-9">
                                <input type="text" name="date1" id="date1" value="<?= $bill['name'] ?>" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Bulan</label>
                            <div class="col-sm-9">
                                <input type="text" name="date1" id="date1" value="<?= indo_month($bill['month']) ?>" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Tahun</label>
                            <div class="col-sm-8">
                                <input type="text" name="date1" id="date1" value="<?= $bill['year'] ?>" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <?php $this->view('messages') ?>
</div>
<div class="col-lg-12">
    <div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
        <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <?php if ($bill['status'] == 'SUDAH BAYAR') { ?>
                    <h3 style="font-weight:bold; color:green"><?= $bill['status'] ?> </h3>
                <?php } ?>
                <?php if ($bill['status'] == 'BELUM BAYAR') { ?>
                    <h3 style="font-weight:bold; color:red"><?= $bill['status'] ?> </h3>
                <?php } ?>
                <?php $subtotal = 0;
                foreach ($invoice->result() as $c => $data) {
                    $subtotal += (int) $data->total;
                } ?>
                <?php $link = "https://$_SERVER[HTTP_HOST]"; ?>
                <?php $month = $bill['month'];
                $year = $bill['year'];
                $no_services = $bill['no_services'];
                $query = "SELECT * FROM `invoice_detail` WHERE `invoice_detail`.`d_month` =  $month and `invoice_detail`.`d_year` =  $year and `invoice_detail`.`d_no_services` =  $no_services";
                $queryTot = $this->db->query($query)->result(); ?><?php $subTotaldetail = 0;
                                                                    foreach ($queryTot as  $dataa) $subTotaldetail += (int) $dataa->total; ?>
                <?php if ($subtotal > 0) { ?>
                    <?php $ppn = $subtotal * ($bill['i_ppn'] / 100) ?>
                <?php } ?>
                <?php if ($subtotal <= 0) { ?>
                    <?php $ppn = $subTotaldetail * ($bill['i_ppn'] / 100) ?>
                <?php } ?>
                <?php if ($subtotal > 0) { ?>
                    <?php $tagihan = $subtotal  ?>
                <?php } ?>
                <?php if ($subtotal <= 0) { ?>
                    <?php $tagihan = $subTotaldetail  ?>
                <?php } ?>
                <?php if ($bill['status'] == 'SUDAH BAYAR') { ?>
                    <a href="https://api.whatsapp.com/send?phone=<?= indo_tlp($bill['no_wa']) ?>&text=<?= $other['thanks_wa'] ?> <?= $bill['no_services'] ?> a/n <?= $bill['name'] ?> sebesar <?= indo_currency($tagihan + $ppn + $bill['code_unique']) ?> Periode <?= indo_month($bill['month']) ?> <?= $bill['year'] ?>. %0A%0A%0A <?= $company['company_name'] ?> %0A<?= $company['sub_name'] ?>" class="btn btn-success" target="blank"> <i class="fa fa-whatsapp"> Send Thank's</i></a>
                <?php } ?>
                <?php if ($bill['status'] == 'BELUM BAYAR') { ?>
                    <h3 style="font-weight:bold; color:red"> <a href="#" data-toggle="modal" data-target="#bayar" class="btn btn-success">Bayar ?</a> </h3>
                <?php } ?>
            </div>
        </div>
        <br>
        <div class="card-body py-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box box-widget">
                        <div class="box-body table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr style="text-align: center">
                                        <th style="text-align: center; width:20px">No</th>
                                        <th>Item Layanan</th>
                                        <th>Kategori</th>
                                        <th style="text-align: center">Jumlah</th>
                                        <th style="text-align: center">Harga</th>
                                        <th style="text-align: center">Diskon</th>
                                        <th style="text-align: center">Total</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody id="dataTables">
                                    <?php if ($invoice->num_rows() > 0) { ?>
                                        <?php $no = 1;
                                        foreach ($invoice->result() as $c => $data) { ?>
                                            <tr>
                                                <td><?= $no++ ?>.</td>
                                                <td><?= $data->item_name ?></td>
                                                <td><?= $data->category_name ?></td>
                                                <td style="text-align: center"><?= $data->qty ?></td>
                                                <td style="text-align: right"><?= indo_currency($data->detail_price) ?></td>
                                                <td style="text-align: right">
                                                    <?php if ($data->disc <= 0) { ?>
                                                        -
                                                    <?php } ?>
                                                    <?php if ($data->disc > 0) { ?>
                                                        <?= indo_currency($data->disc)  ?>
                                                    <?php } ?>
                                                </td>
                                                <td style="text-align: right"><?= indo_currency($data->total) ?></td>
                                                <td><?= $data->remark ?></td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php if ($invoice->num_rows() == 0) { ?>
                                        <?php
                                        $month =   $bill['month'];
                                        $year = $bill['year'];
                                        $no_services = $bill['no_services'];
                                        $query = "SELECT * ,invoice_detail.price as detail_price, package_item.name as item_name, package_category.name as category_name
                                    FROM `invoice_detail`
                                    JOIN `package_item` 
                                    ON `package_item`.`p_item_id` = `invoice_detail`.`item_id`
                                    JOIN `package_category` 
                                     ON `package_category`.`p_category_id` = `invoice_detail`.`category_id`
                                        WHERE `invoice_detail`.`d_month` = $month  and
                                       `invoice_detail`.`d_year` =  $year and
                                       `invoice_detail`.`d_no_services` =  $no_services";
                                        $queryInv = $this->db->query($query)->result();
                                        ?>
                                        <?php $no = 1;
                                        foreach ($queryInv as $data) : ?>
                                            <tr>
                                                <td><?= $no++ ?>.</td>
                                                <td><?= $data->item_name ?></td>
                                                <td><?= $data->category_name ?></td>
                                                <td style="text-align: center"><?= $data->qty ?></td>
                                                <td style="text-align: right"><?= indo_currency($data->detail_price) ?></td>
                                                <td style="text-align: right">
                                                    <?php if ($data->disc <= 0) { ?>
                                                        -
                                                    <?php } ?>
                                                    <?php if ($data->disc > 0) { ?>
                                                        <?= indo_currency($data->disc)  ?>
                                                    <?php } ?>
                                                </td>
                                                <td style="text-align: right"><?= indo_currency($data->total) ?></td>
                                                <td><?= $data->remark ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    <?php } ?>
                                <tfoot>
                                    <tr style="text-align: right">
                                        <th colspan="6">Total</th>
                                        <?php if ($subtotal != 0) { ?>
                                            <th><?= indo_currency($subtotal) ?></th>
                                        <?php } ?>
                                        <?php if ($subtotal == 0) { ?>
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
                                            <th><?= indo_currency($subTotaldetail) ?></th>
                                        <?php } ?>
                                    </tr>
                                    <?php if ($bill['i_ppn'] > 0) { ?>
                                        <?php if ($subtotal != 0) { ?>
                                            <?php $ppn = $subtotal * ($bill['i_ppn'] / 100) ?>
                                        <?php } ?>
                                        <?php if ($subtotal == 0) { ?>
                                            <?php $ppn = $subTotaldetail * ($bill['i_ppn'] / 100) ?>
                                        <?php } ?>
                                        <tr style="text-align: right">
                                            <th colspan="6">Ppn (<?= $bill['i_ppn'] ?>%)</th>
                                            <th><?= indo_currency($ppn) ?></th>
                                        </tr>
                                    <?php } ?>
                                    <tr style="text-align: right">
                                        <th colspan="6">Kode Unik</th>
                                        <th><?= indo_currency($bill['code_unique']) ?></th>
                                    </tr>
                                    <tr style="text-align: right">
                                        <th colspan="6">Grand Total</th>
                                        <?php if ($subtotal != 0) { ?>
                                            <th><?= indo_currency($subtotal + $ppn + $bill['code_unique']) ?></th>
                                        <?php } ?>
                                        <?php if ($subtotal == 0) { ?>
                                            <th><?= indo_currency($subTotaldetail + $ppn + $bill['code_unique']) ?></th>
                                        <?php } ?>
                                    </tr>


                                </tfoot>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Add -->
<div class="modal fade" id="bayar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('bill/payment') ?>" method="POST">
                    <input type="hidden" name="invoice" value="<?= $bill['invoice'] ?>">
                    <input type="hidden" name="no_services" value="<?= $bill['no_services'] ?>">
                    <input type="hidden" name="name" value="<?= $bill['name'] ?>">
                    <input type="hidden" name="nominal" value="<?= $tagihan + $ppn  ?>">
                    <input type="hidden" name="to_email" value="<?= $company['email'] ?>">
                    <input type="hidden" name="agen" value="<?= $user['name'] ?>">
                    <input type="hidden" name="email_customer" value="<?= $bill['email'] ?>">
                    <input type="hidden" name="periode" value="<?= indo_month($bill['month']) ?> <?= $bill['year'] ?>">
                    <input type="hidden" name="email_agen" value="<?= $user['email'] ?>">
                    <input type="hidden" name="year" value="<?= $bill['year'] ?>">
                    <input type="hidden" name="month" value="<?= indo_month($bill['month']) ?>">
                    Apakah yakin Tagihan dengan no layanan <?= $bill['no_services'] ?> a/n <b><?= $bill['name'] ?></b> Periode <?= indo_month($bill['month']) ?> <?= $bill['year'] ?> sudah terbayarkan ?, jika sudah silahkan isi tanggal bayar iuran.
                    <br>
                    <br>
                    <div class="form-group">
                        <label for="date_payment"><b> Tanggal Bayar</b></label> <span style="font-size: 10px">Format : yyyy-mm-dd Contoh <?= date('Y-m-d') ?></span>
                        <input type="text" name="date_payment" autocomplete="off" id="datepickerdisablefuture" class="form-control" required>
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
<!-- bootstrap datepicker -->
<script src="https://files.billing.or.id/assets/backend/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<!-- <link href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="Stylesheet" type="text/css" />
  <script type="text/javascript" src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script> -->
<script>
    //Date picker
    $('#datepicker').datepicker({
        maxDate: '0',
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true,
    })
    $('#datepickerdisablefuture').datepicker({
        maxDate: '0',
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true,
        endDate: new Date()
    });
</script>