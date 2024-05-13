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
        <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>"> Tagihan Periode <?= indo_month(date('m')) ?> <?= date('Y') ?></h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form method="post" action="<?php echo site_url('bill/printinvoiceselected') ?>" target="blank" id="submit-cetak">
                <form method="post" action="<?php echo site_url('bill/printinvoiceselected') ?>" target="blank" id="submit-cetak-thermal">
                    <input type="hidden" name='invoice[]' id="result" size="60">
                    <table class="table table-bordered" id="dataTable" cellspacing="0">
                        <thead>
                            <tr style="text-align: center">
                                <th style="text-align: center;">Data Pelanggan</th>
                                <th style="text-align: center;">Aksi</th>
                            </tr>
                        </thead>
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
                                    <td>No. Urut : <?= $no++ ?><br>
                                        <?= $data->name ?><br>
                                        <?= $data->no_services ?><br>
                                        <a href="tel:<?= $data->no_wa ?>" target="_blank" style="text-decoration: none; font-weight: bold;">
                                            <?= $data->no_wa ?>
                                        </a><br>
                                        <?= $due_date; ?> <?= substr(indo_month($data->month), 0, 3) ?>
                                        <?= $data->year ?><br>
                                        Rp.
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
                                        <?php } ?><br>
                                        <?php if ($data->status == 'SUDAH BAYAR') { ?>
                                            <font style="font-weight : bold; color: green; font-size : small;"> <?= $data->status ?></font>
                                        <?php } ?>
                                        <?php if ($data->status == 'BELUM BAYAR') { ?>
                                            <font style="font-weight : bold; color : red; font-size : small;"> <?= $data->status ?></font>
                                        <?php } ?>
                                        <?php $query = "SELECT *
                                    FROM `bank`";
                                        $bank = $this->db->query($query)->result(); ?>

                                        <?php if ($subTotal == 0) { ?>
                                            <?php $ppn = $subTotaldetail * ($data->i_ppn / 100) ?>
                                            <?php $totaltagihan = indo_currency($subTotaldetail + $ppn + $code_unique) ?>
                                        <?php } ?>
                                    <td style="text-align: center"><br>
                                        <?php if ($data->status == 'BELUM BAYAR') { ?>
                                            <a href="" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?> mb-1" style="text-decoration: none;" data-toggle="modal" data-target="#BayarModal<?= $data->invoice_id ?>">Bayar &nbsp;<i class="fa fa-money"></i></a>
                                            <a href="" class="btn btn-warning mb-1" style="text-decoration: none;" data-toggle="modal" data-target="#DetailModal<?= $data->invoice_id ?>">Detail &nbsp;<i class="fa fa-eye"></i></a>
                                            <?php $campaign  = $this->db->get_where('campaign', ['nomor_services' => $data->no_services])->row_array(); ?>
                                            <a href="<?= base_url() ?>cronjob/kirimpesan/<?= $campaign['id_campaign'] ?>" class="btn btn-success" title="Kirim Notifikasi" style="text-decoration: none;">Kirim &nbsp;&nbsp; <i class="fa fa-envelope"></i></a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr style="text-align: right">
                                <th>Total Tagihan</th>
                                <?php
                                $bulan_ini = date('m');
                                $tahun_ini = date('Y');
                                $query = "SELECT * FROM invoice WHERE month='$bulan_ini' AND year='$tahun_ini' AND status='BELUM BAYAR'";
                                $queryku = $this->db->query($query)->result();
                                $grandtotal = 0;
                                foreach ($queryku as  $dataa) {
                                    $grandtotal += (int) $dataa->amount;
                                }
                                ?>
                                <th style="text-align:right; font-weight:bold; color:red">Rp. <?= indo_currency($grandtotal) ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </form>
        </div>
    </div>
</div>
<?php
foreach ($bill as $r => $data) { ?>
    <div class="modal fade" id="BayarModal<?= $data->invoice_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bayar Tagihan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('bill/billpaid') ?>
                    <?php $query = "SELECT *
                                    FROM `invoice_detail`
                                        WHERE `invoice_detail`.`invoice_id` =  $data->invoice";
                    $querying = $this->db->query($query)->result(); ?>
                    <?php $subTotal = 0;
                    foreach ($querying as  $dataa)
                        $subTotal += (int) $dataa->total;
                    ?>
                    <?php if ($subTotal != 0) { ?>

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
                    <input type="hidden" name="invoice_id" value="<?= $data->invoice_id ?>" class="form-control">
                    <input type="hidden" name="invoice" value="<?= $data->invoice ?>" class="form-control">
                    <input type="hidden" name="month" value="<?= indo_month($data->month) ?>" class="form-control">
                    <input type="hidden" name="name" value="<?= $data->name ?>" class="form-control">
                    <input type="hidden" name="email_customer" value="<?= $data->email ?>" class="form-control">
                    <input type="hidden" name="periode" value="<?= indo_month($data->month) ?> <?= $data->year ?>" class="form-control">
                    <input type="hidden" name="agen" value="<?= $user['name'] ?>" class="form-control">
                    <input type="hidden" name="email_agen" value="<?= $this->session->userdata('email') ?>" class="form-control">
                    <input type="hidden" name="to_email" value="<?= $company['email'] ?>" class="form-control">
                    <input type="hidden" name="year" value="<?= $data->year ?>" class="form-control">
                    <input type="hidden" name="date_payment" value="<?= date('Y-m-d') ?>" class="form-control">
                    <!-- PPN -->
                    <?php if ($subTotal != 0) { ?>
                        <?php $ppn = $subTotal * ($data->i_ppn / 100) ?>
                    <?php } ?>
                    <?php if ($subTotal == 0) { ?>
                        <?php $ppn = $subTotaldetail * ($data->i_ppn / 100) ?>
                    <?php } ?>

                    <?php if ($subTotal != 0) { ?>
                        <input type="hidden" name="nominal" value="<?= $subTotal + $ppn ?>" class="form-control">
                    <?php } ?>
                    <?php if ($subTotal == 0) { ?>
                        <input type="hidden" name="nominal" value="<?= $subTotaldetail + $ppn ?>" class="form-control">
                    <?php } ?>
                    <input type="hidden" name="no_services" value="<?= $data->no_services ?>" class="form-control">
                    Apakah yakin tagihan dengan no layanan <?= $data->no_services ?> a/n <b><?= $data->name ?></b> Periode <?= indo_month($data->month) ?> <?= $data->year ?> sudah terbayarkan ?,
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Ya, Lanjutkan</button>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DetailModal<?= $data->invoice_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel"><b>Detail Pelanggan - <?= $data->no_services ?></b></h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php $customer = $this->db->get_where('customer', ['no_services' => $data->no_services])->row_array(); ?>
                <?php $datauser = $this->db->get_where('user', ['no_services' => $data->no_services])->row_array(); ?>
                <?php $coverage = $this->db->get_where('coverage', ['coverage_id' => $customer['coverage']])->row_array(); ?>
                <?php $layanan  = $this->db->get_where('package_item', ['p_item_id' => $customer['item_paket']])->row_array(); ?>
                <div class="modal-body">
                    <div class="row form-group">
                        <div class="col-5">
                            Nama Lengkap
                        </div>
                        <div class="col-7">
                            : <?= $customer['name'] ?>
                        </div>
                        <div class="col-5">
                            Jenis Kelamin
                        </div>
                        <div class="col-7">
                            : <?= $datauser['gender'] ?>
                        </div>
                        <div class="col-5">
                            Nomor Invoice
                        </div>
                        <div class="col-7">
                            : <?= $data->invoice ?>
                        </div>
                        <div class="col-5">
                            No. Layanan
                        </div>
                        <div class="col-7">
                            : <?= $customer['no_services'] ?>
                        </div>
                        <div class="col-5">
                            Nomor ID Card
                        </div>
                        <div class="col-7">
                            : <?= substr($customer['no_ktp'], 0, 8) ?>xxxxxxxx
                        </div>
                        <div class="col-5">
                            Nomor Telepon
                        </div>
                        <div class="col-7">
                            : <?= $customer['no_wa'] ?>
                        </div>
                        <div class="col-5">
                            Alamat Email
                        </div>
                        <div class="col-7">
                            : <?= $customer['email'] ?>
                        </div>
                        <div class="col-5">
                            Tipe Layanan
                        </div>
                        <div class="col-7">
                            : <?= $customer['mode'] ?>
                        </div>
                        <div class="col-5">
                            Nama Layanan
                        </div>
                        <div class="col-7">
                            : <?= $layanan['name'] ?>
                        </div>
                        <div class="col-5">
                            Total Tagihan
                        </div>
                        <div class="col-7">
                            : Rp. <?= indo_currency($layanan['price']) ?>
                        </div>
                        <div class="col-5">
                            Jenis Tagihan
                        </div>
                        <div class="col-7">
                            : <?= $customer['jenis'] ?>
                        </div>
                        <div class="col-5">
                            Saldo Member
                        </div>
                        <div class="col-7">
                            : Rp. <?= indo_currency($datauser['saldo']) ?>
                        </div>
                        <div class="col-5">
                            Lokasi Pasang
                        </div>
                        <div class="col-7">
                            : Rumah <?= $customer['pemilik_rumah'] ?>
                        </div>
                        <div class="col-5">
                            Coverage Area
                        </div>
                        <div class="col-7">
                            : <?= $coverage['c_name'] ?>
                        </div>
                        <div class="col-5">
                            Kode ODP
                        </div>
                        <div class="col-7">
                            : <?= $customer['kode_odp'] ?>
                        </div>
                        <div class="col-5">
                            Port ODP
                        </div>
                        <div class="col-7">
                            : <?= $customer['port_odp'] ?>
                        </div>
                        <div class="col-5">
                            Titik Koordinat
                        </div>
                        <div class="col-7">
                            : <?= $customer['latitude'] ?>, <?= $customer['longitude'] ?>
                        </div>
                        <div class="col-5">
                            Kena PPN <?= $company['ppn'] ?>%
                        </div>
                        <?php
                        if ($customer['ppn'] > 0) {
                            $ppn = 'Iya';
                        } else {
                            $ppn = 'Tidak';
                        }
                        ?>
                        <div class="col-7">
                            : <?= $ppn ?>
                        </div>
                        <div class="col-5">
                            Jatuh Tempo
                        </div>
                        <div class="col-7">
                            : Setiap Tanggal <?= $customer['due_date'] ?>
                        </div>
                        <div class="col-5">
                            Terdaftar Sejak
                        </div>
                        <div class="col-7">
                            : <?= substr($customer['register_date'], 8, 2) ?> <?= indo_month(substr($customer['register_date'], 5, 2)) ?> <?= substr($customer['register_date'], 0, 4) ?>
                        </div>
                        <div class="col-5">
                            Status Member
                        </div>
                        <div class="col-7">
                            : <?= $customer['c_status'] ?>
                        </div>

                        <div class="col-12 mt-3">
                            <?= $customer['complete'] ?> => <?= $customer['address'] ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>