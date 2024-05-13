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
<?php
$koneksi = mysqli_connect($company['host_database'], $company['user_database'], $company['pass_database'], $company['nama_database']);
?>
<?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 7) { ?>
    <!-- Content Row -->
    <!-- <form method="post" action="<?= site_url('setting/pilihcompany') ?>" enctype="multipart/form-data">
        <div class="form-group">
            <div class="row">
                <div class="col-md-9 pt-2">
                    <select class="form-control" id="id_company" name="id_company" required>
                        <option value="">Pilih Perusahaan Aktif</option>
                        <?php foreach ($mycompany as $r => $mydata) { ?>
                            <option value="<?= $mydata->id ?>">Perusahaan : <?= $mydata->company_name ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-3 pt-2">
                    <button type="submit" class="form-control btn btn-<?= $company['theme'] ?>">Aktifkan Perusahaan Terpilih</button>
                </div>
            </div>
        </div>
    </form> -->
    <?php
    $koneksi = mysqli_connect($company['host_database'], $company['user_database'], $company['pass_database'], $company['nama_database']);
    $due_date = date('d');
    $query = mysqli_query($koneksi, "SELECT * FROM customer WHERE due_date='$due_date'");
    $jumlah_pelanggan = mysqli_num_rows($query);
    $lainnya = ($jumlah_pelanggan - 1);
    while ($datagua = mysqli_fetch_array($query)) {
        $d_no_services = $datagua['no_services'];
        $query000 = mysqli_query($koneksi, "SELECT * FROM invoice WHERE no_services='$d_no_services'");
        $jumlah_invoice = mysqli_num_rows($query000);
        if($jumlah_invoice > 0){
            $myinvoice123 = mysqli_fetch_array($query000);
            $query111 = mysqli_query($koneksi, "SELECT * FROM invoice_detail WHERE d_no_services='$d_no_services'");
            $myinvoice = mysqli_fetch_array($query111);
            $query999 = mysqli_query($koneksi, "SELECT * FROM campaign WHERE nomor_services='$d_no_services'");
            $mycampaign = mysqli_fetch_array($query999);
            $item_id = $myinvoice['item_id'];
            $query222 = mysqli_query($koneksi, "SELECT * FROM package_item WHERE p_item_id='$item_id'");
            $myitem = mysqli_fetch_array($query222);
            $category_id = $myitem['category_id'];
            $query333 = mysqli_query($koneksi, "SELECT * FROM package_category WHERE p_category_id='$category_id'");
            $mycategory = mysqli_fetch_array($query333);
            $monthInvoice = date('m');
            $yearInvoice = date('Y');
            $query444 = mysqli_query($koneksi, "SELECT * FROM invoice WHERE no_services='$d_no_services' AND month='$monthInvoice' AND year='$yearInvoice'");
            $invoiceku = mysqli_fetch_array($query444);
            $query555 = mysqli_query($koneksi, "SELECT * FROM whatsapp");
            $whatsapp = mysqli_fetch_array($query555);
            $query666 = mysqli_query($koneksi, "SELECT * FROM bank");
            $coverage_id = $datagua['coverage'];
            $data_coverage = mysqli_query($koneksi, "SELECT * FROM coverage WHERE coverage_id='$coverage_id'");
            $coverage = mysqli_fetch_array($data_coverage);
            $id_kab = $coverage['id_kab'];
            $data_wilayah = mysqli_query($koneksi, "SELECT * FROM wilayah_kabupaten WHERE id='$id_kab'");
            $wilayah = mysqli_fetch_array($data_wilayah);
            $kabupaten = $wilayah['nama'];
            $myppn = ($myinvoice['price'] / 100) * $invoiceku['i_ppn'];
            if ($invoiceku['status'] != "SUDAH BAYAR") {
    ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <div class="row">
                    <div class="col-md-11">
                        a/n <strong><?= $datagua['name'] ?> (<?= $datagua['no_wa'] ?>)</strong> di Server <b><?= $datagua['server'] ?></b>
                        <?php if ($lainnya >= 1) { ?>
                            beserta <b><?= $lainnya ?> Orang</b> Lainnya
                        <?php } ?>
                        <br>Masa Aktif <b><?= $myitem['name']; ?></b> Telah Habis ! - <b>
                            Tagihan Rp. <?= indo_currency($myinvoice['total']); ?></b>
                        <a style="text-decoration: none;" href="<?= site_url() ?>cronjob/kirimpesan/<?= $mycampaign['id_campaign'] ?>" target="blank" title="Kirim Notifikasi">
                            (kirimkan whatsapp)
                        </a>
                    </div>
                    <?php if ($mycategory['name'] == 'HOTSPOT') { ?>
                        <div class="col-md-1 pt-1">
                            <a href="<?= site_url('bill/detail/') ?><?= $invoiceku['invoice'] ?>" class="form-control btn btn-success">Cek</a>
                        </div>
                    <?php } elseif ($mycategory['name'] == 'PPPOE') { ?>
                        <div class="col-md-1 pt-1">
                            <a href="<?= site_url('bill/detail/') ?><?= $invoiceku['invoice'] ?>" class="form-control btn btn-success">Cek</a>
                        </div>
                    <?php } else { ?>
                        <div class="col-md-1 pt-1">
                            <a href="<?= site_url('bill/detail/') ?><?= $invoiceku['invoice'] ?>" class="form-control btn btn-success">Cek</a>
                        </div>
                    <?php } ?>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
<?php
            }
        }
    }
}
?>
<?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 6) { ?>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Identitas Router</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $identity; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-cube fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Hotspot Aktif</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $hotspotactive; ?> Perangkat</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-desktop fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">PPPOE Aktif</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pppactive; ?> Pengguna</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Hidup Selama</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $uptime; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-spinner fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 9) { ?>
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <?php
        $date = date('Y-m-d');
        $myquery1 = mysqli_query($koneksi, "SELECT SUM(nominal) AS nominal_sumi from income where date_payment='$date'");
        $data1 = mysqli_fetch_array($myquery1);
        $income_hari = $data1['nominal_sumi'];
        ?>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pemasukan Hari ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= indo_currency($income_hari) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        $myquery5 = mysqli_query($koneksi, "SELECT SUM(nominal) AS nominal_summi from income where YEARWEEK(date_payment)=YEARWEEK('$date')");
        $data5 = mysqli_fetch_array($myquery5);
        $income_minggu = $data5['nominal_summi'];
        ?>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pemasukan Minggu ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= indo_currency($income_minggu) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        $tanggal01 = date('Y-m') . '-01';
        $tanggal31 = date('Y-m') . '-31';
        $myquery15 = mysqli_query($koneksi, "SELECT SUM(nominal) AS nominal_sumbi from income where date_payment BETWEEN '$tanggal01' AND '$tanggal31'");
        $data15 = mysqli_fetch_array($myquery15);
        $income_bulan = $data15['nominal_sumbi'];
        ?>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pemasukan Bulan ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= indo_currency($income_bulan) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        $date2 = date('Y');
        $myquery3 = mysqli_query($koneksi, "SELECT SUM(nominal) AS nominal_sumti from income where YEAR(date_payment)='$date'");
        $data3 = mysqli_fetch_array($myquery3);
        $income_tahun = $data3['nominal_sumti'];
        ?>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pemasukan Tahun ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= indo_currency($income_tahun) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        $myquery2 = mysqli_query($koneksi, "SELECT SUM(nominal) AS nominal_sume from expenditure where date_payment='$date'");
        $data2 = mysqli_fetch_array($myquery2);
        $expenditure_hari = $data2['nominal_sume'];
        ?>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Pengeluaran Hari Ini</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= indo_currency($expenditure_hari) ?></div>
                                </div>

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <?php
        $query = "SELECT  `invoice`.`status`, 
    `invoice`.`no_services`,
    `invoice`.`month`,
    `invoice`.`year`,
    `invoice_detail`.`d_no_services`,
    `invoice_detail`.`d_month`,
    `invoice_detail`.`d_year`,
    `invoice_detail`.`invoice_id`,
    `invoice_detail`.`total`
                            FROM `invoice` 
                            JOIN `invoice_detail` ON `invoice`.`no_services`=`invoice_detail`.`d_no_services`
                            and `invoice`.`month`=`invoice_detail`.`d_month`
                            and `invoice`.`year`=`invoice_detail`.`d_year`
                                WHERE `invoice`.`status` =  'BELUM BAYAR' and  `invoice_detail`.`invoice_id` = 0 ";
        $TotalpendingPayment = $this->db->query($query)->result();
        // var_dump($TotalpendingPayment)
        ?>

        <?php $Totalpending = 0;
        foreach ($TotalpendingPayment as $c => $data) {
            $Totalpending += $data->total;
        } ?>
        <?php
        $query = "SELECT *
                            FROM `invoice_detail` 
                            JOIN `invoice` ON `invoice`.`invoice`=`invoice_detail`.`invoice_id`
                                WHERE `invoice`.`status` =  'BELUM BAYAR' ";
        $TotalpendingPaymentt = $this->db->query($query)->result();
        ?>

        <?php $Totalpendingg = 0;
        foreach ($TotalpendingPaymentt as $c => $data) {
            $Totalpendingg += $data->total;
        } ?>

        <!-- Earnings (Monthly) Card Example -->


        <!-- Earnings (Monthly) Card Example -->
        <?php
        $myquery6 = mysqli_query($koneksi, "SELECT SUM(nominal) AS nominal_summe from expenditure where YEARWEEK(date_payment)=YEARWEEK('$date')");
        $data6 = mysqli_fetch_array($myquery6);
        $expenditure_minggu = $data6['nominal_summe'];
        ?>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Pengeluaran Minggu Ini</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= indo_currency($expenditure_minggu) ?></div>
                                </div>

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->


        <!-- Earnings (Monthly) Card Example -->
        <?php
        $myquery16 = mysqli_query($koneksi, "SELECT SUM(nominal) AS nominal_sumbe from expenditure where date_payment BETWEEN '$tanggal01' AND '$tanggal31'");
        $data16 = mysqli_fetch_array($myquery16);
        $expenditure_bulan = $data16['nominal_sumbe'];
        ?>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Pengeluaran Bulan Ini</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= indo_currency($expenditure_bulan) ?></div>
                                </div>

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->


        <!-- Earnings (Monthly) Card Example -->
        <?php
        $myquery4 = mysqli_query($koneksi, "SELECT SUM(nominal) AS nominal_sumte from expenditure where YEAR(date_payment)='$date2'");
        $data4 = mysqli_fetch_array($myquery4);
        $expenditure_tahun = $data4['nominal_sumte'];
        ?>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Pengeluaran Tahun Ini</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= indo_currency($expenditure_tahun) ?></div>
                                </div>

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <?php
        $myquery7 = mysqli_query($koneksi, "SELECT SUM(nominal) AS nominal_sumtti from income");
        $data7 = mysqli_fetch_array($myquery7);
        $income_total = $data7['nominal_sumtti'];
        ?>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Pemasukan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= indo_currency($income_total) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <?php
        $myquery8 = mysqli_query($koneksi, "SELECT SUM(nominal) AS nominal_sumtte from expenditure");
        $data8 = mysqli_fetch_array($myquery8);
        $expenditure_total = $data8['nominal_sumtte'];
        ?>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Pengeluaran</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= indo_currency($expenditure_total) ?></div>
                                </div>

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Menunggu Pembayaran</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" style="font-size: small"><?= $pendingPayment ?> Tagihan<br>
                                ( <span style="color:red;">Rp. <?= indo_currency($Totalpendingg + $Totalpending) ?></span> )
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php $IncomeTotal = 0;
        foreach ($income as $c => $data) {
            $IncomeTotal += $data->nominal;
        } ?>
        <?php $ExpenditureTotal = 0;
        foreach ($expenditure as $c => $data) {
            $ExpenditureTotal += $data->nominal;
        } ?>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Saldo Kas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= indo_currency($IncomeTotal - $ExpenditureTotal) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-wallet fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 6) { ?>
    <?php if ($this->session->userdata('role_id') == 1) { ?>
    <?php } ?>
    <?php if ($this->session->userdata('role_id') == 1) { ?>
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Pemasukan Tahun ini</h6>

                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="myAreaChart" style="display: block; height: 320px; width: 560px;" width="1120" height="640" class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5 d-none d-sm-block d-md-block">
                <div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Panel Kendali</h6>

                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 mb-3">
                                    <a href="<?= site_url('package/item') ?>" style="text-decoration: none">
                                        <div class="card h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-10 text-gray-800">
                                                        <h3 class="font-weight-bold"><?= $totalServices ?></h3>
                                                        <h6>Layanan</h6>
                                                    </div>
                                                    <div class="col-2">
                                                        <i class="fa fa-sitemap "></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-6  col-sm-6 mb-3">
                                    <a href="<?= site_url('customer') ?>" style="text-decoration: none">
                                        <div class="card  shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-10 text-gray-800">
                                                        <h3 class="font-weight-bold"><?= $totalCustomer ?></h3>
                                                        <h6>Pelanggan</h6>
                                                    </div>
                                                    <div class="col-2">
                                                        <i class="fa fa-users"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-6  col-sm-6">
                                    <a href="<?= site_url('bill/unpaid') ?>" style="text-decoration: none">
                                        <div class="card  shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-10 text-gray-800">
                                                        <h3 class="font-weight-bold text-gray-800"><?= $pendingPayment ?></h3>
                                                        <h6>Tagihan</h6>
                                                    </div>
                                                    <div class="col-2">
                                                        <i class="fa fa-tasks"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-6  col-sm-6">
                                    <a href="<?= site_url('setting') ?>" style="text-decoration: none">
                                        <div class="card  shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col ">
                                                        <center>
                                                            <i class="fa fa-cog fa-3x"></i>
                                                        </center>
                                                        <h6 class="text-gray-800" style="text-align: center; margin-top:10px">Pengaturan</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
<?php } ?>
<?php if ($this->session->userdata('role_id') == 9) { ?>
    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Pemasukan Tahun ini</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>
                        <canvas id="myAreaChart" style="display: block; height: 320px; width: 560px;" width="1120" height="640" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php $Jan = 0;
foreach ($incomeJan as $c => $data) {
    $Jan += $data->nominal;
} ?>
<?php $Feb = 0;
foreach ($incomeFeb as $c => $data) {
    $Feb += $data->nominal;
} ?>
<?php $Mar = 0;
foreach ($incomeMar as $c => $data) {
    $Mar += $data->nominal;
} ?>
<?php $Apr = 0;
foreach ($incomeApr as $c => $data) {
    $Apr += $data->nominal;
} ?>
<?php $May = 0;
foreach ($incomeMay as $c => $data) {
    $May += $data->nominal;
} ?>
<?php $Jun = 0;
foreach ($incomeJun as $c => $data) {
    $Jun += $data->nominal;
} ?>
<?php $Jul = 0;
foreach ($incomeJul as $c => $data) {
    $Jul += $data->nominal;
} ?>
<?php $Aug = 0;
foreach ($incomeAug as $c => $data) {
    $Aug += $data->nominal;
} ?>
<?php $Sep = 0;
foreach ($incomeSep as $c => $data) {
    $Sep += $data->nominal;
} ?>
<?php $Oct = 0;
foreach ($incomeOct as $c => $data) {
    $Oct += $data->nominal;
} ?>
<?php $Nov = 0;
foreach ($incomeNov as $c => $data) {
    $Nov += $data->nominal;
} ?>
<?php $Dec = 0;
foreach ($incomeDec as $c => $data) {
    $Dec += $data->nominal;
} ?>
<script src="https://files.billing.or.id/assets/backend/js/Chart.min.js"></script>
<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }

    // Area Chart Example
    var ctx = document.getElementById("myAreaChart");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Income",
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: [<?php echo "$Jan"; ?>, <?php echo "$Feb"; ?>, <?php echo "$Mar"; ?>, <?php echo "$Apr"; ?>, <?php echo "$May"; ?>, <?php echo "$Jun"; ?>, <?php echo "$Jul"; ?>, <?php echo "$Aug"; ?>, <?php echo "$Sep"; ?>, <?php echo "$Oct"; ?>, <?php echo "$Nov"; ?>, <?php echo "$Dec"; ?>],
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 7
                    }
                }],
                yAxes: [{
                    ticks: {
                        maxTicksLimit: 5,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        callback: function(value, index, values) {
                            return 'Rp.' + number_format(value);
                        }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
            },
            legend: {
                display: false
            },
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ': Rp. ' + number_format(tooltipItem.yLabel);
                    }
                }
            }
        }
    });
</script>