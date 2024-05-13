<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <?php if ($this->session->userdata('role_id') == 1) { ?>
        <a href="" id="#addModal" data-toggle="modal" data-target="#addModal" class="d-sm-inline-block btn btn-sm btn-<?= $company['theme'] ?> shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah</a>
        <a href="" id="#billGenerate" data-toggle="modal" data-target="#billGenerate" class="d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fa fa-gear fa-sm text-white-50"></i> Generate</a>
    <?php } ?>
</div>
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
        <form action="<?= site_url('bill/filterpaid'); ?>" method="post">
            <div class="form-group row">
                <div class="col-md-0 mt-2">
                    <label class="col-sm-12 col-form-label">Bulan</label>
                </div>
                <div class="col-sm-3 mt-2 ">
                    <select id="month" name="month" class="form-control" required>
                        <option value="">-Pilih-</option>
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
                        <?php if (date('m') == 12) {  ?>
                            <?php
                            for ($i = date('Y') + 1; $i >= date('Y') - 2; $i -= 1) {
                            ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php } ?>
                        <?php } ?>
                        <?php if (date('m') < 12) {  ?>
                            <?php
                            for ($i = date('Y'); $i >= date('Y') - 2; $i -= 1) {
                            ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-3 mt-2">
                    <button style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?> mb-2 my-2 my-sm-0" type="submit">Filter</button>
                    <a style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?> mb-2 my-2 my-sm-0" href="<?= base_url() ?>bill/invoicesync" target="_blank">Sikronkan Tagihan</a>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
$bulan_ini = date('m');
$tahun_ini = date('Y');
$query = "SELECT * FROM invoice WHERE month='$bulan_ini' AND year='$tahun_ini' AND status='SUDAH BAYAR'";
$queryku = $this->db->query($query)->result();
$grandtotal = 0;
foreach ($queryku as  $dataa) {
    $grandtotal += (int) $dataa->amount;
}
?>
<!-- DataTales Example -->
<div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
    <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
        <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>"> Data Tagihan Sudah Bayar Bulan Ini : <font style="text-align:left; font-weight:bold; color:green">Rp. <?= indo_currency($grandtotal) ?></font>
        </h6>
    </div>
    <div class="card-body">
        <div class="dropdown mb-3">
            <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Pilih Tindakan
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <button data-toggle="modal" data-target="#cetakblmbayar" target="_blank" class="dropdown-item"><i style="width: 20px; text-align: center;" class="fa fa-print"></i> Semua Belum Bayar</button>
                <button data-toggle="modal" data-target="#cetaksdhbayar" target="_blank" class="dropdown-item"><i style="width: 20px; text-align: center;" class="fa fa-print"></i> Semua Sudah Bayar</button>
                <button class="dropdown-item" id="btn-cetak"><i style="width: 20px; text-align: center;" class="fa fa-print"></i> Cetak A4 Yang Dipilih</button>
                <button class="dropdown-item" id="btn-cetak-thermal"><i style="width: 20px; text-align: center;" class="fa fa-print"></i> Thermal Yang Dipilih</button>
                <button class="dropdown-item" id="btn-cetak-58mm"><i style="width: 20px; text-align: center;" class="fa fa-print"></i> 58mm Yang Dipilih</button>
                <button class="dropdown-item" id="btn-kirim-terimakasih"><i style="width: 20px; text-align: center;" class="fab fa-whatsapp"></i> Kirim WA Yang Dipilih</button>
                <button class="dropdown-item" id="btn-sudah-bayar"><i style="width: 20px; text-align: center;" class="fa fa-money"></i> Lunasi Yang Dipilih</button>
                <button class="dropdown-item" id="btn-hapus"><i style="width: 20px; text-align: center;" class="fa fa-trash"></i> Hapus Yang Dipilih</button>
                <button class="dropdown-item" id="btn-hapusbulankemarin"><i style="width: 20px; text-align: center;" class="fa fa-trash"></i> Hapus Bulan Kemarin</button>
                <button class="dropdown-item" id="btn-hapusbulanini"><i style="width: 20px; text-align: center;" class="fa fa-trash"></i> Hapus Bulan Ini</button>
                <button class="dropdown-item" id="btn-hapusbulandepan"><i style="width: 20px; text-align: center;" class="fa fa-trash"></i> Hapus Bulan Depan</button>
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
                                <th>Nama Pelanggan</th>
                                <th>Periode</th>
                                <?php if ($title == 'Belum Bayar') { ?>
                                    <th>Jatuh Tempo</th>
                                <?php } ?>
                                <th>Total</th>
                                <th>Status</th>

                                <th style="text-align: center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($bill as $r => $data) { ?>
                                <tr>
                                    <td style="text-align: center"><?= $no++ ?>.</td>
                                    <td>
                                        <input type='checkbox' class='check-item' id="ceklis" name='invoice[]' value='<?= $data->invoice ?>'>
                                    </td>
                                    <td><?= $data->name ?></td>
                                    <td style="text-align: center">
                                        <?= indo_month($data->month) ?>
                                        <?= $data->year ?><br><b><?= $data->no_services ?></b></td>


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
                                            <a href="" class="btn btn-outline-secondary" data-toggle="modal" data-target="#selectpaper<?= $data->invoice ?>" title="Print Invoice"><i class="fa fa-print" style="text-decoration: none; color: red; width: 25px; font-size: 20px;"></i></a>
                                        <?php } ?>
                                        <?php if ($data->status == 'SUDAH BAYAR') { ?>
                                            <a href="" class="btn btn-outline-secondary" data-toggle="modal" data-target="#selectpaper<?= $data->invoice ?>" title="Print Invoice"><i class="fa fa-print" style="text-decoration: none; color: green; width: 25px; font-size: 20px;"></i></a>
                                        <?php } ?>
                                        <?php if ($data->status == 'BELUM BAYAR') { ?>
                                            <a href="" class="btn btn-outline-secondary" data-toggle="modal" data-target="#BayarModal<?= $data->invoice_id ?>" title="Lunasi Tagihan"><i class="fas fa-money-bill-alt" style="text-decoration: none; color: orange; width: 25px; font-size: 20px;"></i></a>
                                        <?php } ?>
                                        <a href="<?= site_url('bill/detail/' . $data->invoice) ?>" class="btn btn-outline-secondary" title="Lihat"><i class="fa fa-eye" style="text-decoration: none; color: blue; width: 25px; font-size: 20px;"></i></a>
                                        <?php
                                        $campaign  = $this->db->get_where('campaign', ['nomor_services' => $data->no_services])->row_array();
                                        $no_services = $data->no_services;
                                        $no_invoice  = $data->invoice;
                                        $campaign  = $this->db->get_where('campaign', ['nomor_services' => $no_services])->row_array();
                                        $tanggal    = date('d/m/Y H:i:s') . " WIB";
                                        $hari_ini   = date('d');
                                        $bulan_ini  = date('m');
                                        $tahun_ini  = date('Y');
                                        $cekCs = $this->db->get_where('campaign', ['tanggal_reminder' => $hari_ini])->num_rows();
                                        $whatsapp       = $this->db->get('whatsapp')->row_array();
                                        $nomor_pengirim = $whatsapp['number'];
                                        $api_key_wa     = $whatsapp['api_key'];
                                        $link_url_wa    = $whatsapp['link_url'];
                                        $link_url_web   = $whatsapp['url_web'];
                                        $no_services    = $data->no_services;
                                        $no_invoice     = $data->invoice;
                                        $queryCustomer  = $this->db->get_where('customer', ['no_services' => $no_services])->row_array();
                                        $nama_pelanggan = $queryCustomer['name'];
                                        $jatuh_tempo    = $queryCustomer['due_date'];
                                        $id_coverage    = $queryCustomer['coverage'];
                                        $no_wa          = $queryCustomer['no_wa'];
                                        $noWanya        = substr($no_wa, 0, 2);
                                        $noWacust       = substr($no_wa, 1, 12);

                                        if ($noWanya = '08') {
                                            $no_whatsapp = '62' . $noWacust;
                                        } else {
                                            $no_whatsapp = $no_wa;
                                        }
                                        $nomor_penerima = $no_wa;

                                        $queryCoverage  = $this->db->get_where('coverage', ['coverage_id' => $id_coverage])->row_array();
                                        $id_kelurahan   = $queryCoverage['id_kel'];
                                        $id_kecamatan   = $queryCoverage['id_kec'];
                                        $id_kabupaten   = $queryCoverage['id_kab'];
                                        $id_provinsi    = $queryCoverage['id_prov'];

                                        $queryOther  = $this->db->get('other')->row_array();
                                        $url_isolir  = $queryOther['isolir_image'];
                                        $url_thanks  = $queryOther['thanks_image'];

                                        $queryKelurahan = $this->db->get_where('wilayah_desa', ['id' => $id_kelurahan])->row_array();
                                        $queryKecamatan = $this->db->get_where('wilayah_kecamatan', ['id' => $id_kecamatan])->row_array();
                                        $queryKabupaten = $this->db->get_where('wilayah_kabupaten', ['id' => $id_kabupaten])->row_array();
                                        $queryProvinsi  = $this->db->get_where('wilayah_provinsi', ['id' => $id_provinsi])->row_array();
                                        $alamat_lengkap = $queryCoverage['address'] . ', Rt/Rw ' . $queryCoverage['nomor_rt'] . '/' . $queryCoverage['nomor_rw'] . ', ' . $queryKelurahan['nama'] . ', Kec.' . $queryKecamatan['nama'] . ', ' . $queryKabupaten['nama'] . ', Prov. ' . $queryProvinsi['nama'] . ' - Indonesia ' . $queryCoverage['kode_pos'];
                                        $company   = $this->db->get_where('company', ['status' => 'Aktif'])->row_array();
                                        $link_app       = $company['link_app'];
                                        if ($jatuh_tempo == 0) {
                                            $tgl_due_date = $company['due_date'];
                                        } else {
                                            $tgl_due_date = $jatuh_tempo;
                                        }

                                        $nomor_nik_ktp  = $queryCustomer['no_ktp'];
                                        $id_layanan     = $queryCustomer['item_paket'];
                                        $bulan_tagihan  = $data->month;
                                        $tahun_tagihan  = $data->year;
                                        $status_tagihan = $data->status;
                                        $metode_bayar   = $data->metode_payment;

                                        $queryLayanan = $this->db->get_where('package_item', ['p_item_id' => $id_layanan])->row_array();
                                        $queryOther = $this->db->get('other')->row_array();
                                        $id_kategori = $queryLayanan['category_id'];
                                        $queryKategori  = $this->db->get_where('package_category', ['p_category_id' => $id_kategori])->row_array();
                                        $queryUser      = $this->db->get_where('user', ['no_services' => $no_services])->row_array();
                                        $dataBank  = $this->db->get('bank')->result();
                                        if ($data->ppn == 0) {
                                            $harga_pajak = 0;
                                            $ppnCustomer = 0;
                                        } else {
                                            $harga_pajak = ($queryLayanan['price'] / 100) * $company['ppn'];
                                            $ppnCustomer = $company['ppn'];
                                        }
                                        $jumlah_tagihan = $harga_pajak + $queryLayanan['price'];
                                        
                                        $date1 = date_create($queryCustomer['register_date']); 
                                        $date2 = date_create(date('Y-m-d'));
                                        $interval = date_diff($date1, $date2);
                                        $selisih  = $interval->y . " Tahun, " . $interval->m . " Bulan, " . $interval->d. " Hari";
                                        $periode_ke = $interval->m + 1;
                                        if ($data->status == 'BELUM BAYAR') {
                                            
                                            $pesan1 = 'https://api.whatsapp.com/send?phone=' . $no_whatsapp . '&text=*'.$queryOther['say_wa'].'*%0A*' . $company['company_name'] . '*%0A%0AYth.%20' . strtoupper($data->name) . '%0ANomor%20Layanan%20%20%20%20:%20' . $no_services . '%0ANomor%20Tagihan%20%20%20%20%20:%20' . $no_invoice . '%0APeriode%20Tagihan%20%20%20%20:%20' . indo_month($bulan_tagihan) . '%20' . $tahun_tagihan . '%20(Ke-'. $periode_ke . ')%0AJumlah%20Tagihan%20%20%20%20:%20Rp.%20' . indo_currency($jumlah_tagihan) . '%0A%0A*DENGAN%20RINCIAN%20TAGIHAN*%0AHarga%20Paket%20%20%20%20%20%20%20%20%20%20:%20Rp.%20' . indo_currency($queryLayanan['price']) . '%0APajak%20/%20PPN%20' . $ppnCustomer . '%%20%20:%20Rp.' . indo_currency($harga_pajak) . '%0ATotal%20Tagihan%20%20%20%20%20%20%20%20:%20Rp.%20' . indo_currency($jumlah_tagihan) . '%0A%0APaket%20Langganan%20:%20' . $queryLayanan['name'] . '%0AKategori%20Layanan%20:%20' . $queryKategori['name'] . '%0AStatus%20Tagihan%20%20%20%20%20%20:%20*' . $status_tagihan . '*%0ATgl.%20Jatuh%20Tempo%20%20:%20' . $tgl_due_date . '%20' . indo_month($bulan_tagihan) . '%20' . $tahun_tagihan . '%0ANomor%20NIK%20/%20KTP%20:%20' . $nomor_nik_ktp . '%0ANomor%20Telepon%20%20%20%20:%20' . $nomor_penerima . '%0A%0AID%20/%20Kode%20Wilayah%20:%20' . $queryCoverage['c_name'] . '%0AAlamat%20Lengkap%20%20%20%20:%20%0A' . $alamat_lengkap . '%0ATedaftar%20Sejak%20%20%20%20%20%20%20:%20' . $queryCustomer['register_date'] . '%0A(Berlangganan%20:%20' . $selisih . ')%0A%0A*Akun%20Login%20Aplikasi%20%20' . $company['nama_singkat'] . '*%0AUsername%20:%20' . $queryUser['email'] . '%0APassword%20%20:%20' . $queryUser['pass_text'] . '%0A' . base_url() . 'auth%0A%0A*Download%20Aplikasi%20' . $company['nama_singkat'] . '%20di%20:*%0A' . $link_app . '%0A%0A*Link%20Pembayaran%20:*%0A' . base_url() . 'front/quickpayment/' . $no_invoice . '%0A%0A*Pembayaran%20Manual%20:*%0A';
                                            
                                            $pesan2 = '%0A*Link%20Cetak%20Invoice%20:*%0A' . base_url() . 'bill/cetak/' . $no_invoice . '%0A%0A'.$queryOther['body_wa'].'%0A%0A*'.$queryOther['footer_wa'].'*';
                                        ?>
                                            <a href="<?php echo $pesan1; foreach($dataBank as $bank){ echo '=>%20' . $bank->name . '%20:%20' . $bank->no_rek . '%0A%20%20%20%20%20a/n%20' . $bank->owner . '%0A'; } echo $pesan2 ?>" target="_blank" class="btn btn-outline-secondary" title="Kirim Manual"><i class="fab fa-whatsapp" style="text-decoration: none; color: black; width: 25px; font-size: 20px;"></i></a>
                                        <?php } ?>
                                        <?php
                                        if ($data->status == 'SUDAH BAYAR') {
                                            $pesan =
                                                '*'.$queryOther['say_wa'].'*%0A*' . $company['company_name'] . '*%0A%0AYth.%20' . strtoupper($nama_pelanggan) . '%0ANomor%20Layanan%20%20%20%20:%20' . $no_services . '%0ANomor%20Tagihan%20%20%20%20%20:%20' . $no_invoice . '%0APeriode%20Tagihan%20%20%20%20:%20' . indo_month($bulan_tagihan) . '%20' . $tahun_tagihan . '%0AStatus%20Tagihan%20%20%20%20%20%20:%20*' . $status_tagihan . '*%0AMetode%20Bayar%20%20%20%20%20%20%20%20:%20*' . $metode_bayar . '*%0A%0A*Link%20Cetak%20Invoice%20:*%0A' . base_url() . 'bill/cetak/' . $no_invoice . '%0A%0A'.$queryOther['thanks_wa'].'%0A%0A*IKUTI%20AKUN%20SOCIAL%20MEDIA%20KAMI*%0Afacebook.com/' . $company['facebook'] . '%0Atwitter.com/' . $company['twitter'] . '%0Ainstagram.com/' . $company['instagram'] . '%0Ayoutube.com/' . $company['youtube'] . '%0Ahttps://t.me/' . $company['telegram'] . '%0A' . $company['website'] . '%0A%0AAgar%20Selalu%20Dapat%20Info%20dan%20Promo%0AMenarik%20yang%20terbaru%20dari%20kami%0A%0A*Akun%20Login%20Aplikasi%20' . $company['nama_singkat'] . '*%0AUsername%20:%20' . $queryUser['email'] . '%0APassword%20%20:%20' . $queryUser['pass_text'] . '%0A' . base_url() . 'auth%0A%0A*Download%20Aplikasi%20' . $company['nama_singkat'] . '%20di%20:*%0A' . $link_app;
                                        ?>
                                            <a href="https://api.whatsapp.com/send?phone=<?= $no_whatsapp ?>&text=<?= $pesan ?>" target="_blank" class="btn btn-outline-secondary" title="Kirim Manual"><i class="fab fa-whatsapp" style="text-decoration: none; color: black; width: 25px; font-size: 20px;"></i></a>
                                        <?php } ?>
                                        <?php if ($this->session->userdata('role_id') == 1) { ?>
                                            <a href="" class="btn btn-outline-secondary" data-toggle="modal" data-target="#DeleteModal<?= $data->invoice_id ?>" title="Hapus"><i class="fa fa-trash" style="text-decoration: none; color: brown; width: 25px; font-size: 20px;"></i></a>
                                        <?php } ?>
                                    </td>
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
                            <select class="selectpicker show-tick form-control" data-live-search="true" tabindex="-98" style="width: 100%;" name="month" required>
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
                            <select class="selectpicker show-tick form-control" data-live-search="true" tabindex="-98" style="width: 100%;" name="year" required>
                                <option value="<?= date('Y') ?>"><?= date('Y') ?></option>
                                <?php if (date('m') == 12) {  ?>
                                    <?php
                                    for ($i = date('Y') + 1; $i >= date('Y') - 2; $i -= 1) {
                                    ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php } ?>
                                <?php } ?>
                                <?php if (date('m') < 12) {  ?>
                                    <?php
                                    for ($i = date('Y'); $i >= date('Y') - 2; $i -= 1) {
                                    ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">No Layanan - Nama Pelanggan</label>
                    <select name="no_services" id="no_services" onchange="cek_data()" style="width: 100%;" class="selectpicker show-tick form-control" data-live-search="true" tabindex="-98" required>
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
                    <input type="hidden" name="year" value="<?= $data->year ?>" class="form-control">
                    <!-- PPN -->
                    <?php if ($subTotal != 0) { ?>
                        <?php $ppn = $subTotal * ($data->i_ppn / 100) ?>
                    <?php } ?>
                    <?php if ($subTotal == 0) { ?>
                        <?php $ppn = $subTotaldetail * ($data->i_ppn / 100) ?>
                    <?php } ?>

                    <?php if ($subTotal != 0) { ?>
                        <input type="" name="nominal" value="<?= $subTotal + $ppn ?>" class="form-control">
                    <?php } ?>
                    <?php if ($subTotal == 0) { ?>
                        <input type="" name="nominal" value="<?= $subTotaldetail + $ppn ?>" class="form-control">
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

<?php } ?>
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
                    <input type="hidden" name="month" value="<?= $data->month ?>" class="form-control">
                    <input type="hidden" name="year" value="<?= $data->year ?>" class="form-control">
                    <input type="hidden" name="no_services" value="<?= $data->no_services ?>" class="form-control">
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
                    <div class="row container mb-3">
                        No layanan <?= $data->no_services ?> a/n <b> &nbsp;<?= $data->name ?></b>
                    </div>
                    <div class="row text-center">
                        <?php if ($data->status == 'BELUM BAYAR') { ?>
                            <div class="col-4">
                                <a href="<?= site_url('bill/printinvoice/' . $data->invoice) ?>" target="blank" class="btn btn-outline-danger" style="font-size: smaller"><i class="fa fa-print"> A4</i></a>
                            </div>
                            <div class="col-4">
                                <a href="<?= site_url('bill/printinvoice58mm/' . $data->invoice) ?>" target="blank" class="btn btn-outline-danger" style="font-size: smaller"><i class="fa fa-print"> 58mm</i></a>
                            </div>
                            <div class="col-4">
                                <a href="<?= site_url('bill/printinvoicethermal/' . $data->invoice) ?>" target="blank" class="btn btn-outline-danger" style="font-size: smaller"><i class="fa fa-print"> Thermal</i></a>
                            </div>
                        <?php } ?>
                        <?php if ($data->status == 'SUDAH BAYAR') { ?>
                            <div class="col-4">
                                <a href="<?= site_url('bill/printinvoice/' . $data->invoice) ?>" target="blank" class="btn btn-outline-success" style="font-size: smaller"><i class="fa fa-print"> A4</i></a>
                            </div>
                            <div class="col-4">
                                <a href="<?= site_url('bill/printinvoice58mm/' . $data->invoice) ?>" target="blank" class="btn btn-outline-success" style="font-size: smaller"><i class="fa fa-print"> 58mm</i></a>
                            </div>
                            <div class="col-4">
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
                <div class="row text-center">
                    <div class="col-4">
                        <a href="<?= site_url('bill/printinvoiceunpaid') ?>" target="blank" class="btn btn-outline-danger" style="font-size: smaller"><i class="fa fa-print"> A4</i></a>
                    </div>
                    <div class="col-4">
                        <a href="<?= site_url('bill/printinvoiceunpaid58mm') ?>" target="blank" class="btn btn-outline-danger" style="font-size: smaller"><i class="fa fa-print"> 58mm</i></a>
                    </div>
                    <div class="col-4">
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
                <div class="row text-center">
                    <div class="col-4">
                        <a href="<?= site_url('bill/printinvoicepaid') ?>" target="blank" class="btn btn-outline-success" style="font-size: smaller"><i class="fa fa-print"> A4</i></a>
                    </div>
                    <div class="col-4">
                        <a href="<?= site_url('bill/printinvoicepaid58mm') ?>" target="blank" class="btn btn-outline-success" style="font-size: smaller"><i class="fa fa-print"> 58mm</i></a>
                    </div>
                    <div class="col-4">
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
<div class="modal fade" id="billGenerate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Generate Tagihan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('bill/generateBill') ?>
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
                                <?php if (date('m') == 12) {  ?>
                                    <?php
                                    for ($i = date('Y') + 1; $i >= date('Y') - 2; $i -= 1) {
                                    ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php } ?>
                                <?php } ?>
                                <?php if (date('m') < 12) {  ?>
                                    <?php
                                    for ($i = date('Y'); $i >= date('Y') - 2; $i -= 1) {
                                    ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Ya, Lanjutkan</button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()
    });

    function cek_data() {
        no_services = $('[name="no_services"]');
        $.ajax({
            type: 'POST',
            data: "cek_data=" + 1 + "&no_services=" + no_services.val(),
            url: '<?= site_url('bill/view_data') ?>',
            cache: false,

            beforeSend: function() {
                no_services.attr('disabled', true);
                $('.loading').html(` <div class="container">
        <div class="text-center">
            <div class="spinner-border" style="color : <?= $colornya ?>" style="width: 5rem; height: 5rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>`);
            },
            success: function(data) {
                no_services.attr('disabled', false);
                $('.loading').html('');
                $('.view_data').html(data);
            }

        });
        return false;
    }
</script>
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
            var confirm = window.confirm("Apakah Anda yakin ingin Cetak A4 Tagihan yang terpilih ?");
            if (confirm)
                $("#submit-cetak").submit();
        });

        $('#btn-cetak-thermal').click(function() {
            $('#submit-cetak').attr('action', '<?php echo site_url('bill/printinvoiceselectedthermal') ?>');
            var confirm = window.confirm("Apakah Anda yakin ingin Cetak Thermal Tagihan yang terpilih ?");
            if (confirm)
                $("#submit-cetak").submit();
        });

        $('#btn-kirim-terimakasih').click(function() {
            $('#submit-cetak').attr('action', '<?php echo site_url('bill/whatsappselected') ?>');
            var confirm = window.confirm("Apakah Anda yakin ingin Kirim WA Tagihan yang terpilih ?");
            if (confirm)
                $("#submit-cetak").submit();
        });

        $('#btn-cetak-58mm').click(function() {
            $('#submit-cetak').attr('action', '<?php echo site_url('bill/printinvoiceselected58mm') ?>');
            var confirm = window.confirm("Apakah Anda yakin ingin Cetak 58mm Tagihan yang terpilih ?");
            if (confirm)
                $("#submit-cetak").submit();
        });

        $('#btn-sudah-bayar').click(function() {
            $('#submit-cetak').attr('action', '<?php echo site_url('bill/lunasiselected') ?>');
            var confirm = window.confirm("Apakah Anda yakin ingin Melunasi Status Tagihan yang terpilih ?");
            if (confirm)
                $("#submit-cetak").submit();
        });

        $('#btn-hapus').click(function() {
            $('#submit-cetak').attr('action', '<?php echo site_url('bill/hapusinvoiceselected') ?>');
            var confirm = window.confirm("Apakah Anda yakin ingin Menghapus Tagihan yang terpilih ?");
            if (confirm)
                $("#submit-cetak").submit();
        });

        $('#btn-hapusbulankemarin').click(function() {
            $('#submit-cetak').attr('action', '<?php echo site_url('bill/hapusbulankemarin') ?>');
            var confirm = window.confirm("Apakah Anda yakin ingin Menghapus Tagihan yang Bulan Kemarin ?");
            if (confirm)
                $("#submit-cetak").submit();
        });

        $('#btn-hapusbulanini').click(function() {
            $('#submit-cetak').attr('action', '<?php echo site_url('bill/hapusbulanini') ?>');
            var confirm = window.confirm("Apakah Anda yakin ingin Menghapus Tagihan yang Bulan Ini ?");
            if (confirm)
                $("#submit-cetak").submit();
        });

        $('#btn-hapusbulandepan').click(function() {
            $('#submit-cetak').attr('action', '<?php echo site_url('bill/hapusbulandepan') ?>');
            var confirm = window.confirm("Apakah Anda yakin ingin Menghapus Tagihan yang Bulan Depan ?");
            if (confirm)
                $("#submit-cetak").submit();
        });
    });
</script>