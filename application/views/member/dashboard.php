<div class="col-12 mt-3" style="padding-left: 10px;">
    <div class="col-12">
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
    </div>
    <div class="col-12 col-lg-4 col-md-4 col-xl-4 col-md-4 col-sm-12 col-xs-12">
        <a href="<?= site_url('member/topupsaldo') ?>" style="color: black;">
            <div class="card comp-card" style="border: solid 1px grey;">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="mb-25">Saldo Anda</h6>
                            <h3 class="fw-700 text-blue" style="color: blue;">Rp. <?= indo_currency($user['saldo']) ?></h3>
                            <p class="mb-0">Top Up Saldo</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <?php if ($user['role_id'] == 2 || $user['role_id'] == 9) { ?>
        <?php
        if ($totalpppuser >= 0) {
            function formatBytes($bytes, $decimal = null)
            {
                $satuan = ['MB', 'GB', 'TB'];
                $i = 0;
                while ($bytes > 1024) {
                    $bytes /= 1024;
                    $i++;
                }
                return round($bytes, $decimal) . ' ' . $satuan[$i];
            }

            foreach ($pppactive as $dataku) {
        ?>
                <div class="col-12 col-lg-4 col-md-4 col-xl-4 col-md-4 col-sm-12 col-xs-12">
                    <a href="http://<?= $dataku['address'] ?>" target="_blank" style="color: black;">
                        <div class="card comp-card" style="border: solid 1px grey;">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="mb-25">IP Address</h6>
                                        <h3 class="fw-700 text-blue" style="color: blue;">
                                            <?= $dataku['address']; ?>
                                        </h3>
                                        <p class="mb-0">
                                            Status :
                                            <?php
                                            if (count($pppactive) > 0) {
                                                echo '<font style="color: green; font-weight: bold;">Online</font>';
                                            } else {
                                                echo '<font style="color: red; font-weight: bold;">Offline</font>';
                                            }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
        <?php
            }
        }
        ?>
        <div class="col-12 col-lg-4 col-md-4 col-xl-4 col-md-4 col-sm-12 col-xs-12">
            <a href="<?= site_url('member/status') ?>" style="color: black;">
                <div class="card comp-card" style="border: solid 1px grey;">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="mb-25">Paket Anda</h6>
                                <h3 class="fw-700 text-blue" style="color: blue;"><?= $CountServices ?></h3>
                                <p class="mb-0">Item Layanan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-lg-4 col-md-4 col-xl-4 col-md-4 col-sm-12 col-xs-12">
            <?php
            if ($totalBill > 0) { ?>
                <a href="" data-toggle="modal" data-target="#Modal" style="color: black;">
                <?php } ?>
                <div class=" card comp-card" style="border: solid 1px grey;">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <?php
                                if ($totalBill <= 0) { ?>
                                    <h6 class="mb-25">Tagihan <?= indo_month(date('m')) ?> <?= date('Y') ?></h6>
                                    <h3 class="fw-700 text-red" style="color: red;">-</h3>
                                    <p class="mb-0">Belum Tersedia</p>
                                <?php } ?>
                                <?php
                                if ($totalBill > 0) { ?>
                                    <?php $countBill = 0;
                                    foreach ($CountBill as $c => $data) {
                                        $countBill += $data->total;
                                    } ?>
                                    <?php
                                    $month =   date('m');
                                    $year = date('Y');
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
                                    <?php if ($countBill <= 0) {  ?>
                                        <?php $ppn = $subTotaldetail * ($invoice->i_ppn / 100) ?>

                                    <?php } ?>
                                    <?php if ($countBill > 0) {  ?>
                                        <?php $ppn = $countBill * ($invoice->i_ppn / 100) ?>

                                    <?php } ?>
                                    <!-- KODE UNIK -->
                                    <?php if ($other['code_unique'] == 1) { ?>
                                        <?php $code_unique = $invoice->code_unique ?>
                                    <?php } ?>
                                    <?php if ($other['code_unique'] == 0) { ?>
                                        <?php $code_unique = 0 ?>
                                    <?php } ?>
                                    <!-- END KODE UNIK -->
                                    <h6 class="mb-10">Tagihan Bulan <?= indo_month(date('m')) ?> <?= date('Y') ?></h6>
                                    <?php if ($invoice->status == 'BELUM BAYAR') {  ?>
                                        <?php if ($countBill <= 0) {  ?>
                                            <?php $ppn = $subTotaldetail * ($invoice->i_ppn / 100) ?>
                                            <h3 class="fw-700 text-red" style="color: red;">Rp. <?= indo_currency($subTotaldetail  + $code_unique + $ppn) ?></h3>
                                        <?php } ?>
                                        <?php if ($countBill > 0) {  ?>
                                            <?php $ppn = $countBill * ($invoice->i_ppn / 100) ?>
                                            <h3 class="fw-700 text-red" style="color: red;">Rp. <?= indo_currency($countBill  + $code_unique + $ppn) ?></h3>
                                        <?php } ?>
                                        <!-- JATUH TEMPO -->
                                        <?php $Customer = $this->db->get_where('customer', ['no_services' => $invoice->no_services])->row_array(); ?>
                                        <?php if ($Customer['due_date'] != 0) { ?>
                                            <?php $due_date = $Customer['due_date'] ?>
                                        <?php } ?>
                                        <?php if ($Customer['due_date'] == 0) { ?>
                                            <?php $due_date = $company['due_date'] ?>
                                        <?php } ?>
                                        <p class="mb-0">Bayar tagihan sebelum Anda <br>
                                            Tanggal <?= $due_date ?> <?= indo_month($invoice->month) ?> <?= date('Y') ?></p>
                                    <?php } ?>
                                    <?php if ($invoice->status == 'SUDAH BAYAR') {  ?>
                                        <?php if ($countBill <= 0) {  ?>
                                            <h3 class="fw-700 text-green" style="color: green;">Rp. <?= indo_currency($subTotaldetail  + $code_unique + $ppn) ?></h3>
                                        <?php } ?>
                                        <?php if ($countBill > 0) {  ?>
                                            <h3 class="fw-700 text-green" style="color: green;">Rp. <?= indo_currency($countBill  + $code_unique + $ppn) ?></h3>
                                        <?php } ?>
                                        <p class="mb-0">Sudah Dibayar</p>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
        </div>
        <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><?= indo_month(date('m')) ?> <?= date('Y') ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-lg-12">
                            <div class="box box-widget">
                                <div class="row text-center">
                                    <div class="col">No Layanan</div>
                                    <div class="col">Status</div>
                                </div>
                                <div class="row text-center mt-1">
                                    <div class="col"><b><?= $no_services ?></b></div>
                                    <div class="col">
                                        <?php if ($invoice->status == 'BELUM BAYAR') { ?>
                                            <b class="text-red" style="color: red;">Belum Dibayar</b>
                                        <?php } ?>
                                        <?php if ($invoice->status == 'SUDAH BAYAR') { ?>
                                            <b class="text-green" style="color: green;">Sudah Dibayar</b>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="row mt-3">
                                        <div class="col text-center">
                                            <span>Total</span>
                                            <?php if ($invoice->status == 'BELUM BAYAR') {  ?>
                                                <?php if ($countBill <= 0) {  ?>
                                                    <h3 class="fw-700 text-black">Rp. <?= indo_currency($subTotaldetail  + $code_unique + $ppn) ?></h3>
                                                <?php } ?>
                                                <?php if ($countBill > 0) {  ?>
                                                    <h3 class="fw-700 text-black">Rp. <?= indo_currency($countBill  + $code_unique + $ppn) ?></h3>
                                                <?php } ?>
                                            <?php } ?>
                                            <?php if ($invoice->status == 'SUDAH BAYAR') {  ?>
                                                <?php if ($countBill <= 0) {  ?>
                                                    <h3 class="fw-700 text-green" style="color: green;">Rp. <?= indo_currency($subTotaldetail  + $code_unique + $ppn) ?></h3>
                                                <?php } ?>
                                                <?php if ($countBill > 0) {  ?>
                                                    <h3 class="fw-700 text-green" style="color: green;">Rp. <?= indo_currency($countBill  + $code_unique + $ppn) ?></h3>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <?php
                                    $month =  date('m');
                                    $year = date('Y');
                                    $query = "SELECT *, `invoice_detail`.`price` as detail_price
                            FROM `invoice_detail` 
                            JOIN `package_item` ON `package_item`.`p_item_id` = `invoice_detail`.`item_id`
                                WHERE `invoice_detail`.`d_month` =  $month and
                               `invoice_detail`.`d_year` =  $year and
                               `invoice_detail`.`d_no_services` =  $no_services";
                                    $queryDetail = $this->db->query($query)->result(); ?>
                                    <div class="row">
                                        <div class="col text-center">
                                            Rincian Tagihan #<?= $invoice->invoice ?>
                                            <br><br>
                                            <?php if ($countBill == 0) {  ?>
                                                <?php foreach ($queryDetail as $dataa) { ?>
                                                    <div class="row">
                                                        <div class="col">
                                                            <?= $dataa->name ?>
                                                        </div>
                                                        <div class="col text-right">
                                                            <?= indo_currency($dataa->detail_price) ?>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <?php $diskon = 0;
                                                foreach ($queryDetail as  $dataaa)
                                                    $diskon += (int) $dataaa->disc;
                                                ?>

                                                <?php if ($diskon != 0) { ?>
                                                    <div class="row">
                                                        <div class="col">
                                                            Diskon
                                                        </div>
                                                        <div class="col text-right">
                                                            <?= indo_currency($diskon) ?>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col">
                                                            Sub Total
                                                        </div>
                                                        <div class="col text-right">
                                                            <?php if ($countBill <= 0) {  ?>
                                                                <?= indo_currency($subTotaldetail) ?>
                                                            <?php } ?>
                                                            <?php if ($countBill > 0) {  ?>
                                                                <?= indo_currency($countBill) ?>
                                                            <?php } ?>

                                                        </div>
                                                    </div>

                                                <?php } ?>
                                                <?php if ($invoice->i_ppn > 0) { ?>
                                                    <div class="row">
                                                        <div class="col">
                                                            PPN (<?= $invoice->i_ppn ?>%)
                                                        </div>
                                                        <div class="col text-right">
                                                            <?= indo_currency($ppn) ?>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <?php if ($other['code_unique'] == 1) { ?>
                                                    <div class="row">
                                                        <div class="col">
                                                            Kode Unik
                                                        </div>
                                                        <div class="col text-right">
                                                            <?= indo_currency($code_unique) ?>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            <?php } ?>
                                            <?php if ($countBill > 0) {  ?>
                                                <?php foreach ($CountBill as $data) { ?>
                                                    <div class="row">
                                                        <div class="col">
                                                            <?= $data->item_name ?>
                                                        </div>
                                                        <div class="col text-right">
                                                            Rp. <?= indo_currency($data->detail_price) ?>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <?php $diskonDet = 0;
                                                foreach ($CountBill as  $dataaa)
                                                    $diskonDet += (int) $dataaa->disc;
                                                ?>
                                                <?php if ($diskonDet > 0) { ?>
                                                    <div class="row">
                                                        <div class="col">
                                                            Diskon
                                                        </div>
                                                        <div class="col text-right">
                                                            <?= indo_currency($diskonDet) ?>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            Sub Total
                                                        </div>
                                                        <div class="col text-right">
                                                            <?php if ($countBill <= 0) {  ?>
                                                                <?= indo_currency($subTotaldetail) ?>
                                                            <?php } ?>
                                                            <?php if ($countBill > 0) {  ?>
                                                                <?= indo_currency($countBill) ?>
                                                            <?php } ?>

                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <?php if ($invoice->i_ppn > 0) { ?>
                                                    <div class="row">
                                                        <div class="col">
                                                            PPN (<?= $invoice->i_ppn ?>%)
                                                        </div>
                                                        <div class="col text-right">
                                                            <?= indo_currency($ppn) ?>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <?php if ($other['code_unique'] == 1) { ?>
                                                    <div class="row">
                                                        <div class="col">
                                                            Kode Unik
                                                        </div>
                                                        <div class="col text-right">
                                                            <?= indo_currency($invoice->code_unique) ?>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="row mt-1">

                                        Terbilang : &nbsp;<?php if ($countBill <= 0) {  ?><span><em> <?= number_to_words($subTotaldetail  + $code_unique + $ppn) ?></em></span>
                                    <?php } ?>
                                    <?php if ($countBill > 0) {  ?>
                                        <span><em> <?= number_to_words($countBill  + $code_unique + $ppn) ?></em></span>
                                    <?php } ?>
                                    </div><br>
                                    <?php if ($invoice->status == 'BELUM BAYAR') { ?>
                                        <div class="row mt-1">
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 col-12 mb-1">
                                                <a href="" data-toggle="modal" data-target="#ModalBayar" class="btn btn-primary form-control">BAYAR</a>
                                            </div>
                                            <div class="col">
                                                <?php $confirm = $this->db->get_where('confirm_payment', ['no_services' => $invoice->no_services, 'invoice_id' => $invoice->invoice])->row_array(); ?>

                                                <?php if ($confirm != null) { ?>
                                                    <?php $Customer = $this->db->get_where('customer', ['no_services' => $invoice->no_services])->row_array(); ?>
                                                    <?php $link = "https://$_SERVER[HTTP_HOST]"; ?>
                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 col-12 mb-1">
                                                        <a class="btn btn-success form-control" href="https://api.whatsapp.com/send?phone=<?= indo_tlp($company['whatsapp']) ?>&text=*Konfirmasi Pembayaran*  %0ANama Pelanggan : <?= $Customer['name'] ?>  %0ANo Layanan : <?= $invoice->no_services ?>  %0ANo Invoice : <?= $invoice->invoice ?>  %0APeriode : <?= indo_month($invoice->month) ?> <?= $invoice->year ?>  %0A%0A%0A <?= $link ?>/confirmdetail/<?= $invoice->invoice ?>" target="blank">
                                                            <i class="fab fa-whatsapp" style="font-size:15px; color:green"></i>Hubungi Admin
                                                        </a>
                                                    </div>
                                                <?php } ?>
                                                <?php if ($confirm == null) { ?>
                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 col-12 mb-1">
                                                        <a class="btn btn-warning form-control" href="<?= site_url('member/bayartagihan/' . $invoice->invoice) ?>">Konfirmasi</a>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 col-12 mb-1">
                                                <a class="btn btn-danger form-control" href="<?= site_url('member/invoice/' . $invoice->invoice) ?>">Invoice</a>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($invoice->status == 'SUDAH BAYAR') { ?>
                                        <div class="row mt-1">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 mb-1">
                                                <div class="badge badge-success"><a href="<?= site_url('member/invoice/' . $invoice->invoice) ?>">Invoice</a> </div>
                                            </div>
                                        </div>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="ModalBayar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cara Pembayaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Silahkan lakukan pembayaran sesuai tagihan anda, pembayaran bisa via Transfer ke rekening berikut;
                        <br> <br>
                        <?php
                        foreach ($bank as $r => $data) { ?>
                            <?= $data->name ?> : <?= $data->no_rek ?> A/N <?= $data->owner ?>
                            <br>
                        <?php } ?>
                        <br>
                        <b>Konfirmasi Pembayaran :</b> <br>
                        Email : <?= $company['email'] ?>
                        <br>
                        WA : <?= $company['whatsapp'] ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-success">Konfirmasi Pembayaran</button> -->
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>