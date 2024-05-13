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
        <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>"> Filter Tagihan </h6>
    </div>
    <div class="card-body">
        <form action="<?= site_url('bill/filter'); ?>" method="post">
            <div class="form-group row">
                <div class="col-md-0 mt-2">
                    <label class="col-sm-12 col-form-label">Bulan</label>
                </div>
                <div class="col-sm-3 mt-2 ">
                    <select id="month" name="month" class="form-control" required>
                        <option value="<?= $this->input->post('month') ?>"><?= indo_month($this->input->post('month')) ?></option>
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Maret</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">Agustus</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </div>

                <div class="col-md-0 mt-2">
                    <label class="col-sm-12 col-form-label">Tahun</label>
                </div>
                <div class="col-sm-3  mt-2">
                    <select class="form-control " style="width: 100%;" type="text" id="year" name="year" autocomplete="off" required>
                        <option value="<?= date('Y') ?>"><?= date('Y') ?></option>
                        <?php
                        for ($i = date('Y'); $i >= date('Y') - 2; $i -= 1) {
                        ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-3 mt-2">
                    <button style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?> mb-2 my-2 my-sm-0" type="submit">Filter</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- DataTales Example -->
<div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
    <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
        <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>"> Data Tagihan Bulan <?= indo_month($this->input->post('month')) ?> <?= $this->input->post('year') ?></h6>
    </div>
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-lg-3 col-sm-6 mb-2 col-md-4 text-left">
                <button href="" class="btn btn-outline-secondary" id="btn-cetak"><i class="fa fa-print"></i> A4 Yang Dipilih</button>
            </div>
            <div class="col-lg-3 col-sm-6 mb-2 col-md-4 text-left">
                <button href="" class="btn btn-outline-secondary" id="btn-cetak-thermal"><i class="fa fa-print"></i> Thermal Yang Dipilih</button>
            </div>

        </div>
        <div class="table-responsive">
            <form method="post" action="<?php echo site_url('bill/printinvoiceselected') ?>" target="blank" id="submit-cetak">
                <form method="post" action="<?php echo site_url('bill/printinvoiceselected') ?>" target="blank" id="submit-cetak-thermal">
                    <input type="hidden" name='invoice[]' id="result" size="60">
                    <table class="table table-bordered" id="tablebt" width="100%" cellspacing="0">
                        <thead>
                            <tr style="text-align: center">
                                <th style="text-align: center; width:20px">No</th>
                                <th><input type='checkbox' id="selectAll">
                                </th>
                                <th>No Layanan</th>
                                <th>Nama Pelanggan</th>
                                <th>No. Telp.</th>
                                <th>Periode</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th style="text-align: center">Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr style="text-align: center">
                                <th style="text-align: center">No</th>
                                <th></th>
                                <th>No Layanan</th>
                                <th>Nama Pelanggan</th>
                                <th>No. Telp.</th>
                                <th>Periode</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th style="text-align: center">Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $no = 1;
                            foreach ($bill as $r => $data) { ?>
                                <!-- JATUH TEMPO -->
                                <?php if ($data->due_date != 0) { ?>
                                    <?php $due_date = $data->due_date ?>
                                <?php } ?>
                                <?php if ($data->due_date == 0) { ?>
                                    <?php $due_date = $company['due_date'] ?>
                                <?php } ?>
                                <?php $cekduedate = $data->year . '-' . $data->month . '-' . $due_date ?>
                                <?php if (date('Y-m-d') >= $cekduedate) {
                                    $bg = 'yellow';
                                    $text = 'black';
                                } else {
                                    $bg = '';
                                    $text = '';
                                } ?>
                                <tr style="background-color: <?= $bg ?>; color: black;">
                                    <td style="text-align: center"><?= $no++ ?>.</td>
                                    <td>
                                        <input type='checkbox' class='check-item' id="ceklis" name='invoice[]' value='<?= $data->invoice ?>'>
                                    </td>
                                    <td style="text-align: center"><?= $data->no_services ?> <br>
                                        <?php if ($data->status == 'BELUM BAYAR') { ?>
                                            <a href="#" class="btn btn-outline-danger" data-toggle="modal" data-target="#selectpaper<?= $data->invoice ?>" title="Print Invoice" style="font-size: smaller"> <i class="fa fa-print"> Invoice</i> </a>
                                        <?php } ?>
                                        <?php if ($data->status == 'SUDAH BAYAR') { ?>
                                            <a href="#" class="btn btn-outline-success" data-toggle="modal" data-target="#selectpaper<?= $data->invoice ?>" title="Print Invoice" style="font-size: smaller"> <i class="fa fa-print"> Invoice</i> </a>
                                        <?php } ?>
                                    </td>
                                    <td><?= $data->name ?></td>
                                    <td><?= $data->no_wa ?></td>
                                    <td>
                                        <?= indo_month($data->month) ?>
                                        <?= $data->year ?></td>


                                    <?php if ($title == 'Belum Bayar') { ?>
                                        <td><?= $due_date; ?> <?= indo_month($data->month) ?>
                                            <?= $data->year ?></td>
                                    <?php } ?>

                                    <td style="font-weight: bold;text-align: center">
                                        <?php $query = "SELECT *
                                    FROM `invoice_detail`
                                        WHERE `invoice_detail`.`invoice_id` =  $data->invoice";
                                        $querying = $this->db->query($query)->result();
                                        ?>
                                        <?php $subTotal = 0;
                                        foreach ($querying as  $dataa)
                                            $subTotal += (int) $dataa->total;
                                        ?>
                                        <!-- KODE UNIK -->
                                        <?php if ($other['code_unique'] == 1) { ?>
                                            <?php $code_unique = $data->code_unique ?>
                                        <?php } ?>
                                        <?php if ($other['code_unique'] == 0) { ?>
                                            <?php $code_unique = 0 ?>
                                        <?php } ?>
                                        <!-- END KODE UNIK -->
                                        <?php if ($subTotal != 0) { ?>
                                            <?php $ppn = $subTotal * ($data->i_ppn / 100) ?>
                                            <?php $totaltagihan = indo_currency($subTotal + $ppn + $code_unique) ?>
                                        <?php } ?>
                                        <?php if ($subTotal == 0) { ?>
                                            <?php $query = "SELECT *
                                    FROM `invoice_detail`
                                        WHERE `invoice_detail`.`d_month` =  $data->month and
                                       `invoice_detail`.`d_year` =  $data->year and
                                       `invoice_detail`.`d_no_services` =  $data->no_services";
                                            $queryTot = $this->db->query($query)->result(); ?>
                                            <?php $subTotaldetail = 0;
                                            foreach ($queryTot as  $dataa)
                                                $subTotaldetail += (int) $dataa->total;
                                            ?>
                                        <?php } ?>
                                        <?php if ($subTotal != 0) { ?>
                                            <?php $ppn = $subTotal * ($data->i_ppn / 100) ?>
                                            <?= indo_currency($subTotal + $code_unique + $ppn) ?>
                                        <?php } ?>
                                        <?php if ($subTotal == 0) { ?>
                                            <?php $ppn = $subTotaldetail * ($data->i_ppn / 100) ?>
                                            <?= indo_currency($subTotaldetail + $code_unique + $ppn) ?>
                                        <?php } ?>
                                    </td>
                                    <?php if ($data->status == 'SUDAH BAYAR') { ?>
                                        <td style="text-align: center; font-weight:bold; color:green; font-size:small"> <?= $data->status  ?></td>
                                    <?php } ?>
                                    <?php if ($data->status == 'BELUM BAYAR') { ?>
                                        <td style="text-align: center; font-weight:bold; color:red; font-size:small"> <?= $data->status  ?></td>
                                    <?php } ?>
                                    <?php $query = "SELECT *
                                    FROM `bank`";
                                    $bank = $this->db->query($query)->result(); ?>

                                    <?php if ($subTotal == 0) { ?>
                                        <?php $ppn = $subTotaldetail * ($data->i_ppn / 100) ?>
                                        <?php $totaltagihan = indo_currency($subTotaldetail + $ppn + $code_unique) ?>
                                    <?php } ?>
                                    <td style="text-align: center">
                                        <?php if ($data->status == 'BELUM BAYAR') { ?>
                                            <a href="" data-toggle="modal" data-target="#BayarModal<?= $data->invoice_id ?>"><i class="fas fa-money-bill-alt" title="Bayar" style="font-size:25px;"> </i></a>
                                        <?php } ?>
                                        <a href="<?= site_url('bill/detail/' . $data->invoice) ?>" title="Lihat"><i class="fa fa-eye" style="font-size:25px; color: black;"></i></a>
                                        <?php $link = "https://$_SERVER[HTTP_HOST]"; ?>
                                        <?php if ($data->status == 'BELUM BAYAR') { ?>
                                            <a href="https://api.whatsapp.com/send?phone=<?= indo_tlp($data->no_wa) ?>&text=<?= $other['say_wa'] ?> <?= $data->no_services ?> a/n _<?= $data->name ?>_ bln <?= indo_month($data->month) ?> <?= $data->year ?> Sebesar *<?= $totaltagihan ?>*, Maks tgl <?= $due_date ?> <?= indo_month($data->month) ?> <?= $data->year ?>. <?= $other['body_wa'] ?>%0A%0APembayaran bisa cash atau via transfer ke :%0A <?php foreach ($bank as $bank) : ?> *<?= $bank->name; ?>* : %0A<?= $bank->no_rek ?> A/N <?= $bank->owner ?> %0A<?php endforeach ?>%0A<?= $other['footer_wa'] ?> %0A%0A%0A<?= $company['company_name'] ?> %0A<?= $company['sub_name'] ?> %0A<?= $link ?> " target="blank" title="Kirim Notifikasi"><i class="fab fa-whatsapp" style="font-size:25px; color:green"></i></a>
                                        <?php } ?>
                                        <?php if ($data->status == 'SUDAH BAYAR') { ?>
                                            <a href="https://api.whatsapp.com/send?phone=<?= indo_tlp($data->no_wa) ?>&text=<?= $other['thanks_wa'] ?> <?= $data->no_services ?> a/n _<?= $data->name ?>_ Periode <?= indo_month($data->month) ?> <?= $data->year ?> Sebesar *<?= $totaltagihan ?>*.%0A%0A%0A<?= $company['company_name'] ?> %0A<?= $company['sub_name'] ?> %0A<?= $link ?> " target="blank" title="Kirim Terimakasih"><i class="fab fa-whatsapp" style="font-size:25px; color:green"></i></a>
                                        <?php } ?>
                                        <?php if ($this->session->userdata('role_id') == 1) { ?>
                                            <a href="" data-toggle="modal" data-target="#DeleteModal<?= $data->invoice_id ?>" title="Hapus"><i class="fa fa-trash" style="font-size:25px; color:red"></i></a>
                                    </td>
                                <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </form>
        </div>
    </div>
</div>
<!-- Modal Add -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Tagihan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('bill/addBill') ?>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Bulan</label>
                            <input type="hidden" name="invoice" value="<?= $invoice ?>">
                            <select class="form-control select2" style="width: 100%;" name="month" required>
                                <option value="<?= date('m') ?>"><?= indo_month(date('m')) ?></option>
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Tahun</label>
                            <select class="form-control select2" style="width: 100%;" name="year" required>
                                <option value="<?= date('Y') ?>"><?= date('Y') ?></option>
                                <?php
                                for ($i = date('Y'); $i >= date('Y') - 2; $i -= 1) {
                                ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">No Layanan - Nama Pelanggan</label>
                    <select class="form-control select2" name="no_services" id="no_services" onchange="cek_data()" style="width: 100%;" required>
                        <option value="">-Pilih-</option>
                        <?php
                        foreach ($customer as $r => $data) { ?>
                            <option value="<?= $data->no_services ?>"><?= $data->no_services ?> - <?= $data->name ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nominal">Rincian Tagihan</label>
                    <div class="loading"></div>
                    <div class="view_data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>">Simpan</button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hapus -->
<?php
foreach ($bill as $r => $data) { ?>
    <div class="modal fade" id="DeleteModal<?= $data->invoice_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Tagihan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('bill/delete') ?>
                    <input type="hidden" name="invoice_id" value="<?= $data->invoice_id ?>" class="form-control">
                    <input type="hidden" name="invoice" value="<?= $data->invoice ?>" class="form-control">
                    Apakah yakin akan hapus Tagihan <?= $data->no_services ?> A/N <?= $data->name ?> ?
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
<?php foreach ($bill as $r => $data) { ?>
    <div class="modal fade" id="selectpaper<?= $data->invoice ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cetak Invoice</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row container mb-3">No layanan <?= $data->no_services ?> a/n <b> &nbsp;<?= $data->name ?></b>
                        <br>
                        Pilih Ukuran Kertas
                    </div>
                    <div class="row text-center">
                        <?php if ($data->status == 'BELUM BAYAR') { ?>
                            <div class="col">
                                <a href="<?= site_url('bill/printinvoice/' . $data->invoice) ?>" target="blank" class="btn btn-outline-danger" style="font-size: smaller"><i class="fa fa-print"> A4</i></a>
                            </div>
                            <div class="col">
                                <a href="<?= site_url('bill/printinvoicethermal/' . $data->invoice) ?>" target="blank" class="btn btn-outline-danger" style="font-size: smaller"><i class="fa fa-print"> Thermal</i></a>
                            </div>
                        <?php } ?>
                        <?php if ($data->status == 'SUDAH BAYAR') { ?>
                            <div class="col">
                                <a href="<?= site_url('bill/printinvoice/' . $data->invoice) ?>" target="blank" class="btn btn-outline-success" style="font-size: smaller"><i class="fa fa-print"> A4</i></a>
                            </div>
                            <div class="col">
                                <a href="<?= site_url('bill/printinvoicethermal/' . $data->invoice) ?>" target="blank" class="btn btn-outline-success" style="font-size: smaller"><i class="fa fa-print"> Thermal</i></a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<div class="modal fade" id="cetakblmbayar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cetak Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row container mb-3">
                    Pilih Ukuran Kertas
                </div>
                <div class="row text-center">
                    <div class="col">
                        <a href="<?= site_url('bill/printinvoiceunpaid') ?>" target="blank" class="btn btn-outline-danger" style="font-size: smaller"><i class="fa fa-print"> A4</i></a>
                    </div>
                    <div class="col">
                        <a href="<?= site_url('bill/printinvoiceunpaidthermal') ?>" target="blank" class="btn btn-outline-danger" style="font-size: smaller"><i class="fa fa-print"> Thermal</i></a>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="cetaksdhbayar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cetak Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row container mb-3">
                    Pilih Ukuran Kertas
                </div>
                <div class="row text-center">
                    <div class="col">
                        <a href="<?= site_url('bill/printinvoicepaid') ?>" target="blank" class="btn btn-outline-success" style="font-size: smaller"><i class="fa fa-print"> A4</i></a>
                    </div>
                    <div class="col">
                        <a href="<?= site_url('bill/printinvoicepaidthermal') ?>" target="blank" class="btn btn-outline-success" style="font-size: smaller"><i class="fa fa-print"> Thermal</i></a>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#selectAll").click(function() {
            if ($(this).is(":checked"))
                $(".check-item").prop("checked", true);

            else // Jika checkbox all tidak diceklis
                $(".check-item").prop("checked", false);
        });

        $("#btn-cetak").click(function() {
            $('#submit-cetak').attr('action', '<?php echo site_url('bill/printinvoiceselected') ?>');
            var confirm = window.confirm("Apakah Anda yakin ingin cetak tagihan yang terpilih ?");
            if (confirm)
                $("#submit-cetak").submit();
        });

        $('#btn-cetak-thermal').click(function() {
            $('#submit-cetak').attr('action', '<?php echo site_url('bill/printinvoiceselectedthermal') ?>');
            var confirm = window.confirm("Apakah Anda yakin ingin cetak tagihan yang terpilih ?");
            if (confirm)
                $("#submit-cetak").submit();
        });
    });
</script>