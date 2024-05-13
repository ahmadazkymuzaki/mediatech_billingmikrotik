<?php
foreach ($bill->result() as $c => $data) {
} ?>

<?php
if ($customer->num_rows() > 0) { ?>
    <?php
    if ($bill->num_rows() > 0) { ?>
        <?php $query = "SELECT *
                                    FROM `customer`
                                        WHERE `customer`.`no_services` = $data->no_services";
        $querying = $this->db->query($query);
        ?>
        <!-- // var_dump($querying);  -->
        <?php
        foreach ($querying->result() as  $dataa)
        ?>
        <?php if ($data->status == 'BELUM BAYAR') {
        # code...
        ?>
            <div class="info-tagihan">
                <div class="container">
                    <div class="card shadow mb-2" style="border: solid 1px grey;">
                        <div class="container mt-3">
                            <center>
                                <h3>Periode <?= indo_month($data->month) ?> <?= $data->year ?>
                            </center>
                            </h3>
                            <div class="row">
                                <div class="col-12 mt-2">
                                    Nomor Layanan :<br>
                                    <b>
                                        <font style="color: black;"><?= $data->no_services ?></font>
                                    </b>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mt-2">
                                    Nama Pelanggan :<br>
                                    <b>
                                        <font style="color: black;"><?= $dataa->name ?></font>
                                    </b>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mt-2">
                                    Status Pembayaran :<br>
                                    <b>
                                        <font style="color: red;"><?= $data->status ?></font>
                                    </b>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mt-2">
                                    Tgl Jatuh Tempo :<br>
                                    <?php
                                    $company = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
                                    if ($dataa->due_date == 0) {
                                        $jatuhtempo = $company['due_date'];
                                    } else {
                                        $jatuhtempo = $dataa->due_date;
                                    }
                                    ?>
                                    <b>
                                        <font style="color: black;"><?= $jatuhtempo ?> <?= indo_month($data->month) ?> <?= $data->year ?></font>
                                    </b>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mt-2">
                                    Jumlah Tagihan :<br>
                                    <?php if ($data->invoice_id != 0) { ?>
                                        <?php $query = "SELECT *
                                    FROM `invoice_detail`
                                        WHERE `invoice_detail`.`invoice_id` =  $data->invoice";
                                        $querying = $this->db->query($query)->result();
                                        ?>

                                        <?php $subTotal = 0;
                                        foreach ($querying as  $dataa)
                                            $subTotal += (int) $dataa->total;
                                        ?>
                                        <?php
                                        $query = "SELECT *
                                    FROM `invoice_detail`
                                    WHERE `invoice_detail`.`d_month` =  $data->month and
                                       `invoice_detail`.`d_year` =  $data->year and
                                       `invoice_detail`.`d_no_services` =  $data->no_services";
                                        $queryTot = $this->db->query($query)->result();
                                        ?>
                                        <?php $subTotaldetail = 0;
                                        foreach ($queryTot as  $dataa)
                                            $subTotaldetail += (int) $dataa->total;
                                        ?>
                                        <!-- KODE UNIK -->
                                        <?php if ($other['code_unique'] == 1) { ?>
                                            <?php $code_unique = $data->code_unique ?>
                                        <?php } ?>
                                        <?php if ($other['code_unique'] == 0) { ?>
                                            <?php $code_unique = 0 ?>
                                        <?php } ?>
                                        <!-- END KODE UNIK -->
                                        <?php if ($subTotal > 0) { ?>
                                            <?php $ppn = $subTotal * ($data->i_ppn / 100) ?>
                                        <?php } ?>
                                        <?php if ($subTotal <= 0) { ?>
                                            <?php $ppn = $subTotaldetail * ($data->i_ppn / 100) ?>

                                        <?php } ?>

                                        <?php if ($subTotal != 0) { ?>
                                            <b>
                                                <font style="color: black;">Rp. <?= indo_currency($subTotal + $code_unique + $ppn) ?></font>
                                            </b>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php if ($subTotal == 0) { ?>
                                        <b>
                                            <font style="color: black;">Rp. <?= indo_currency($subTotaldetail + $code_unique + $ppn) ?></font>
                                        </b>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mt-2 mb-3">
                                    Terbilang : <br>
                                    <?php if ($subTotal != 0) { ?>
                                        <b>
                                            <font style="color: black;"><?= number_to_words($subTotal + $code_unique + $ppn) ?> Rupiah</font>
                                        </b>
                                    <?php } ?>
                                    <?php if ($subTotal == 0) { ?>
                                        <b>
                                            <font style="color: black;"><?= number_to_words($subTotaldetail + $code_unique + $ppn) ?> Rupiah</font>
                                        </b>
                                    <?php } ?>
                                    </b>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <center>
                                        <img height="200" src="<?= site_url('assets/images/qrcode/') ?>qr-<?= $data->invoice ?>.png" alt="qrcode">
                                    </center>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 mt-1">
                                    <a href="<?= site_url('front/quickpayment/') ?><?= $data->invoice ?>" style="text-decoration: none;" class="btn btn-primary form-control">BAYAR SEKARANG</a>
                                </div>
                                <div class="col-lg-4 mt-1">
                                    <a target="_blank" href="<?= site_url('bill/printinvoicethermal/') ?><?= $data->invoice ?>" style="text-decoration: none;" class="btn btn-warning form-control">CETAK INVOICE</a>
                                </div>
                                <div class="col-lg-4 mt-1 mb-4">
                                    <a target="_blank" href="https://api.whatsapp.com/send?phone=<?= indo_tlp($company['whatsapp']); ?>&text=Informasi Detail Tagihan (<?= $data->invoice ?>)" style="text-decoration: none;" class="btn btn-success form-control">HUBUNGI ADMIN</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else {
        echo ' <div class="text-center mb-3">
                <div class="container">
                    <div class="card border-success">
                        <div class="card-body">
                            <h4 class="card-title text-success">Tagihan Telah Dibayar</h4>
                        </div>
                    </div>
                </div>
            </div>';
    } ?>

<?php
    } else {
        echo '<div class="text-center mb-3">
    <div class="container">
        <div class="card border-danger">
            <div class="card-body">
                <h4 class="card-title text-danger">Tagihan Belum Tersedia</h4>
            </div>
        </div>
    </div>
</div>';
    }
} else {
    echo '<div class="text-center mb-3">
        <div class="container">
            <div class="card border-warning">
                <div class="card-body">
                    <h4 class="card-title text-warning">Nomor Layanan tidak Terdaftar, pastikan Nomor Layanan anda Benar atau silahkan Hubungi Admin.</h4>
                </div>
            </div>
        </div>
    </div>';
} ?>