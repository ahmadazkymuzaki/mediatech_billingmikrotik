 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <a href="#" class="d-sm-inline-block btn btn-sm btn-<?= $company['theme'] ?> shadow-sm" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah</a>
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
 <!-- DataTales Example -->
 <div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
     <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
         <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Daftar Gaji Karyawan</h6>
     </div>
     <div class="card-body">
         <div class="table-responsive">
             <table class="table table-responsive table-bordered" id="tablebt" cellspacing="1">
                 <thead>
                     <tr>
                         <th style="text-align: center; width: 5%;">No</th>
                         <th style="text-align: center;">Nama Karyawan</th>
                         <th style="text-align: center;">Periode Gaji</th>
                         <th style="text-align: center;">Status Gaji</th>
                         <th style="text-align: center;">Gaji Diterima</th>
                         <th style="text-align: center;">Aksi</th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php $no = 1;
                        foreach ($gaji as $r => $data) { ?>
                         <tr>
                             <td style="text-align: center; width: 5%;"><?= $no++ ?>.</td>
                             <td style="text-align: left;">
                                 <?= $data->nama_karyawan ?>
                             </td>
                             <td style="text-align: left;">
                                 <?= $data->bulan_gaji ?> <?= $data->tahun_gaji ?>
                             </td>
                             <td style="text-align: center;">
                                 <?= $data->status_gaji ?>
                             </td>
                             <td style="text-align: right;">
                                 Rp. <?= indo_currency($data->gaji_diterima) ?>
                             </td>
                             <td style="text-align: center; width: 10%;">
                                 <a href="" data-toggle="modal" data-target="#DetailModal<?= $data->id_gaji ?>" title="Edit"><i class="fa fa-eye" style="font-size:25px; color:green;" style="font-size:25px"></i></a>
                                 <a href="" data-toggle="modal" data-target="#EditModal<?= $data->id_gaji ?>" title="Edit"><i class="fa fa-edit" style="font-size:25px"></i></a>
                                 <a href="" data-toggle="modal" data-target="#DeleteModal<?= $data->id_gaji ?>" title="Hapus"><i class="fa fa-trash" style="font-size:25px; color:red;"></i></a>
                             </td>
                         </tr>
                     <?php } ?>
                 </tbody>
             </table>
         </div>
     </div>
 </div>

 <!-- Modal Add -->
 <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Tambah Gaji Karyawan</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <?php echo form_open_multipart('keuangan/tambahgaji') ?>
                 <div class="row">
                     <div class="col-md-6">
                         <div class="form-group">
                             <label for="bulan_gaji">Periode Bulan</label>
                             <select id="bulan_gaji" name="bulan_gaji" class="form-control" required>
                                 <option value="<?= strtoupper(indo_month(date('m'))) ?>"><?= strtoupper(indo_month(date('m'))) ?></option>
                                 <option value="JANUARI">JANUARI</option>
                                 <option value="FEBRUARI">FEBRUARI</option>
                                 <option value="MARET">MARET</option>
                                 <option value="APRIL">APRIL</option>
                                 <option value="MEI">MEI</option>
                                 <option value="JUNI">JUNI</option>
                                 <option value="JULI">JULI</option>
                                 <option value="AGUSTUS">AGUSTUS</option>
                                 <option value="SEPTEMBER">SEPTEMBER</option>
                                 <option value="OKTOBER">OKTOBER</option>
                                 <option value="NOVEMBER">NOVEMBER</option>
                                 <option value="DESEMBER">DESEMBER</option>
                             </select>
                         </div>
                     </div>
                     <div class="col-md-6">
                         <div class="form-group">
                             <label for="tahun_gaji">Periode Tahun</label>
                             <select id="tahun_gaji" name="tahun_gaji" class="form-control" required>
                                 <option value="<?= date('Y') ?>"><?= date('Y') ?></option>
                                 <option value="2016">2016</option>
                                 <option value="2017">2017</option>
                                 <option value="2018">2018</option>
                                 <option value="2019">2019</option>
                                 <option value="2020">2020</option>
                                 <option value="2021">2021</option>
                                 <option value="2022">2022</option>
                                 <option value="2023">2023</option>
                                 <option value="2024">2024</option>
                                 <option value="2025">2025</option>
                             </select>
                         </div>
                     </div>
                     <div class="col-md-12">
                         <div class="form-group">
                             <label for="name">Nama Karyawan</label>
                             <select id="no_services" name="no_services" class="selectpicker show-tick form-control" data-live-search="true" tabindex="-98" required>
                                 <option value="">-- Pilih Karyawan --</option>
                                 <?php
                                    $data_customer   = $this->db->get_where('user', ['role_id' => 6])->result();
                                    foreach ($data_customer as $mycustomer) {
                                    ?>
                                     <option value="<?= $mycustomer->no_services ?>"><?= $mycustomer->name ?></option>
                                 <?php } ?>
                                 <?php
                                    $data_customer   = $this->db->get_where('user', ['role_id' => 7])->result();
                                    foreach ($data_customer as $mycustomer) {
                                    ?>
                                     <option value="<?= $mycustomer->no_services ?>"><?= $mycustomer->name ?></option>
                                 <?php } ?>
                                 <?php
                                    $data_customer   = $this->db->get_where('user', ['role_id' => 8])->result();
                                    foreach ($data_customer as $mycustomer) {
                                    ?>
                                     <option value="<?= $mycustomer->no_services ?>"><?= $mycustomer->name ?></option>
                                 <?php } ?>
                                 <?php
                                    $data_customer   = $this->db->get_where('user', ['role_id' => 9])->result();
                                    foreach ($data_customer as $mycustomer) {
                                    ?>
                                     <option value="<?= $mycustomer->no_services ?>"><?= $mycustomer->name ?></option>
                                 <?php } ?>
                             </select>
                         </div>
                     </div>
                     <div class="col-md-5">
                         <div class="form-group">
                             <label for="total_gaji">Total Gaji</label>
                             <input type="number" id="total_gaji" name="total_gaji" class="form-control" required>
                         </div>
                     </div>
                     <div class="col-md-4">
                         <div class="form-group">
                             <label for="potongan_gaji">Potongan Lainnya</label>
                             <input type="number" id="potongan_gaji" name="potongan_gaji" value="0" class="form-control">
                         </div>
                     </div>
                     <div class="col-md-3">
                         <div class="form-group">
                             <label for="masuk_kerja">Masuk Kerja</label>
                             <input type="number" id="masuk_kerja" name="masuk_kerja" class="form-control" required>
                         </div>
                     </div>
                     <div class="col-md-3">
                         <div class="form-group">
                             <label for="masuk_kerja">Terlambat</label>
                             <input type="number" id="absen_lambat" name="absen_lambat" value="0" class="form-control">
                         </div>
                     </div>
                     <div class="col-md-3">
                         <div class="form-group">
                             <label for="absen_sakit">Absen Sakit</label>
                             <input type="number" id="absen_sakit" name="absen_sakit" value="0" class="form-control">
                         </div>
                     </div>
                     <div class="col-md-3">
                         <div class="form-group">
                             <label for="absen_izin">Absen Izin</label>
                             <input type="number" id="absen_izin" name="absen_izin" value="0" class="form-control">
                         </div>
                     </div>
                     <div class="col-md-3">
                         <div class="form-group">
                             <label for="tidak_absen">Tidak Absen</label>
                             <input type="number" id="tidak_absen" name="tidak_absen" value="0" class="form-control">
                         </div>
                     </div>
                     <div class="col-md-12">
                         <div class="form-group">
                             <label for="catatan">Catatan untuk Karyawan</label>
                             <textarea id="catatan" name="catatan" class="form-control"></textarea>
                         </div>
                     </div>
                     <div class="col-md-4">
                         <div class="form-group">
                             <label for="bonus_gaji">Bonus Tambahan</label>
                             <input type="number" id="bonus_gaji" name="bonus_gaji" value="0" class="form-control">
                         </div>
                     </div>
                     <div class="col-md-8">
                         <div class="form-group">
                             <label for="diberikan_oleh">Diberikan Oleh</label>
                             <input id="diberikan_oleh" name="diberikan_oleh" class="form-control" value="<?= $user['name'] ?>" readonly>
                         </div>
                     </div>
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

 <!-- Modal Edit -->
 <?php
    foreach ($gaji as $r => $data) { ?>
     <div class="modal fade" id="EditModal<?= $data->id_gaji ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Edit Gaji Karyawan </h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <?php echo form_open_multipart('keuangan/editgaji') ?>
                     <input type="hidden" name="id_gaji" id="id_gaji" value="<?= $data->id_gaji ?>" class="form-control">
                     <div class="row">
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label for="bulan_gaji">Periode Bulan</label>
                                 <select id="bulan_gaji" name="bulan_gaji" class="form-control" required>
                                     <option value="<?= $data->bulan_gaji ?>"><?= $data->bulan_gaji ?></option>
                                     <option value="JANUARI">JANUARI</option>
                                     <option value="FEBRUARI">FEBRUARI</option>
                                     <option value="MARET">MARET</option>
                                     <option value="APRIL">APRIL</option>
                                     <option value="MEI">MEI</option>
                                     <option value="JUNI">JUNI</option>
                                     <option value="JULI">JULI</option>
                                     <option value="AGUSTUS">AGUSTUS</option>
                                     <option value="SEPTEMBER">SEPTEMBER</option>
                                     <option value="OKTOBER">OKTOBER</option>
                                     <option value="NOVEMBER">NOVEMBER</option>
                                     <option value="DESEMBER">DESEMBER</option>
                                 </select>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label for="tahun_gaji">Periode Tahun</label>
                                 <select id="tahun_gaji" name="tahun_gaji" class="form-control" required>
                                     <option value="<?= $data->tahun_gaji ?>"><?= $data->tahun_gaji ?></option>
                                     <option value="2016">2016</option>
                                     <option value="2017">2017</option>
                                     <option value="2018">2018</option>
                                     <option value="2019">2019</option>
                                     <option value="2020">2020</option>
                                     <option value="2021">2021</option>
                                     <option value="2022">2022</option>
                                     <option value="2023">2023</option>
                                     <option value="2024">2024</option>
                                     <option value="2025">2025</option>
                                 </select>
                             </div>
                         </div>
                         <div class="col-md-12">
                             <div class="form-group">
                                 <label for="nama_karyawan">Nama Karyawan</label>
                                 <input type="text" id="nama_karyawan" name="nama_karyawan" value="<?= $data->nama_karyawan ?>" class="form-control" readonly>
                             </div>
                         </div>
                         <div class="col-md-5">
                             <div class="form-group">
                                 <label for="total_gaji">Total Gaji</label>
                                 <input type="number" id="total_gaji" name="total_gaji" value="<?= $data->total_gaji ?>" class="form-control" required>
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group">
                                 <label for="potongan_gaji">Potongan Lainnya</label>
                                 <input type="number" id="potongan_gaji" name="potongan_gaji" value="<?= $data->potongan_gaji ?>" class="form-control" required>
                             </div>
                         </div>
                         <div class="col-md-3">
                             <div class="form-group">
                                 <label for="masuk_kerja">Masuk Kerja</label>
                                 <input type="number" id="masuk_kerja" name="masuk_kerja" value="<?= $data->masuk_kerja ?>" class="form-control" required>
                             </div>
                         </div>
                         <div class="col-md-3">
                             <div class="form-group">
                                 <label for="masuk_kerja">Terlambat</label>
                                 <input type="number" id="absen_lambat" name="absen_lambat" value="<?= $data->absen_lambat ?>" class="form-control">
                             </div>
                         </div>
                         <div class="col-md-3">
                             <div class="form-group">
                                 <label for="absen_sakit">Absen Sakit</label>
                                 <input type="number" id="absen_sakit" name="absen_sakit" value="<?= $data->absen_sakit ?>" class="form-control">
                             </div>
                         </div>
                         <div class="col-md-3">
                             <div class="form-group">
                                 <label for="absen_izin">Absen Izin</label>
                                 <input type="number" id="absen_izin" name="absen_izin" value="<?= $data->absen_izin ?>" class="form-control">
                             </div>
                         </div>
                         <div class="col-md-3">
                             <div class="form-group">
                                 <label for="tidak_absen">Tidak Absen</label>
                                 <input type="number" id="tidak_absen" name="tidak_absen" value="<?= $data->tidak_absen ?>" class="form-control">
                             </div>
                         </div>
                         <div class="col-md-12">
                             <div class="form-group">
                                 <label for="catatan">Catatan untuk Karyawan</label>
                                 <textarea type="text" id="catatan" name="catatan" class="form-control"><?= $data->catatan ?></textarea>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label for="gaji_diterima">Gaji Diterima</label>
                                 <input id="gaji_diterima" name="gaji_diterima" value="<?= $data->gaji_diterima ?>" class="form-control" readonly>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label for="diberikan_oleh">Status Gaji</label>
                                 <input type="text" id="status_gaji" name="status_gaji" value="<?= $data->status_gaji ?>" class="form-control" readonly>
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group">
                                 <label for="bonus_gaji">Bonus Tambahan</label>
                                 <input type="number" id="bonus_gaji" name="bonus_gaji" value="<?= $data->bonus_gaji ?>" class="form-control">
                             </div>
                         </div>
                         <div class="col-md-8">
                             <div class="form-group">
                                 <label for="diberikan_oleh">Diberikan Oleh</label>
                                 <input type="text" id="diberikan_oleh" name="diberikan_oleh" class="form-control" value="<?= $data->diberikan_oleh ?>" readonly>
                             </div>
                         </div>
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
 <?php } ?>

 <!-- Modal Edit -->
 <?php
    foreach ($gaji as $r => $data) { ?>
     <div class="modal fade" id="DetailModal<?= $data->id_gaji ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Detail Gaji Karyawan </h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <?php echo form_open_multipart('keuangan/editgaji') ?>
                     <input type="hidden" name="id_gaji" id="id_gaji" value="<?= $data->id_gaji ?>" readonly class="form-control">
                     <div class="row">
                         <div class="col-md-4">
                             <div class="form-group">
                                 <label for="bulan_gaji">Periode Bulan</label>
                                 <input type="text" id="bulan_gaji" name="bulan_gaji" value="<?= $data->bulan_gaji ?>" class="form-control" readonly>
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group">
                                 <label for="tahun_gaji">Periode Tahun</label>
                                 <input type="text" id="tahun_gaji" name="tahun_gaji" value="<?= $data->tahun_gaji ?>" class="form-control" readonly>
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group">
                                 <label for="total_gaji">Total Gaji</label>
                                 <input type="text" id="total_gaji" name="total_gaji" value="Rp. <?= indo_currency($data->total_gaji) ?>" class="form-control" readonly>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label for="nama_karyawan">Nama Karyawan</label>
                                 <input type="text" id="nama_karyawan" name="nama_karyawan" value="<?= $data->nama_karyawan ?>" class="form-control" readonly>
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group">
                                 <label for="potongan_gaji">Potongan Lainnya</label>
                                 <input type="text" id="potongan_gaji" name="potongan_gaji" value="Rp. <?= indo_currency($data->potongan_gaji) ?>" class="form-control" readonly>
                             </div>
                         </div>
                         <div class="col-md-2">
                             <div class="form-group">
                                 <label for="masuk_kerja">Masuk Kerja</label>
                                 <input type="text" id="masuk_kerja" name="masuk_kerja" value="<?= $data->masuk_kerja ?> Hari" class="form-control" readonly>
                             </div>
                         </div>
                         <div class="col-md-2">
                             <div class="form-group">
                                 <label for="absen_lambat">Terlambat</label>
                                 <input type="text" id="absen_lambat" name="absen_lambat" value="<?= $data->absen_lambat ?> Hari" class="form-control" readonly>
                             </div>
                         </div>
                         <div class="col-md-2">
                             <div class="form-group">
                                 <label for="absen_sakit">Absen Sakit</label>
                                 <input type="text" id="absen_sakit" name="absen_sakit" value="<?= $data->absen_sakit ?> Hari" class="form-control" readonly>
                             </div>
                         </div>
                         <div class="col-md-2">
                             <div class="form-group">
                                 <label for="absen_izin">Absen Izin</label>
                                 <input type="text" id="absen_izin" name="absen_izin" value="<?= $data->absen_izin ?> Hari" class="form-control" readonly>
                             </div>
                         </div>
                         <div class="col-md-2">
                             <div class="form-group">
                                 <label for="tidak_absen">Tidak Absen</label>
                                 <input type="text" id="tidak_absen" name="tidak_absen" value="<?= $data->tidak_absen ?> Hari" class="form-control" readonly>
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group">
                                 <label for="total_kasbon">Total Kasbon</label>
                                 <input type="text" id="total_kasbon" name="total_kasbon" value="Rp. <?= indo_currency($data->total_kasbon) ?>" class="form-control" readonly>
                             </div>
                         </div>
                         <div class="col-md-12">
                             <div class="form-group">
                                 <label for="catatan">Catatan untuk Karyawan</label>
                                 <textarea type="text" id="catatan" name="catatan" class="form-control" readonly><?= $data->catatan ?></textarea>
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group">
                                 <label for="status_gaji">Status Gaji</label>
                                 <input type="text" id="status_gaji" name="status_gaji" value="<?= $data->status_gaji ?>" class="form-control" readonly>
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group">
                                 <label for="bonus_gaji">Bonus Tambahan</label>
                                 <input type="text" id="bonus_gaji" name="bonus_gaji" value="Rp. <?= indo_currency($data->bonus_gaji) ?>" class="form-control" readonly>
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group">
                                 <label for="diberikan_oleh">Diberikan Oleh</label>
                                 <input id="diberikan_oleh" name="diberikan_oleh" class="form-control" value="<?= $data->diberikan_oleh ?>" readonly>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label for="gaji_diterima">Gaji Diterima</label>
                                 <input id="gaji_diterima" name="gaji_diterima" value="Rp. <?= indo_currency($data->gaji_diterima) ?>" class="form-control" readonly>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label for="tanggal_gaji">Diterima Pada</label>
                                 <input id="tanggal_gaji" name="tanggal_gaji" value="<?= $data->tanggal_gaji ?>" class="form-control" readonly>
                             </div>
                         </div>
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                     </div>
                     <?php echo form_close() ?>
                 </div>
             </div>
         </div>
     </div>
 <?php } ?>
 <!-- Modal Hapus -->
 <?php
    foreach ($gaji as $r => $data) { ?>
     <div class="modal fade" id="DeleteModal<?= $data->id_gaji ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Hapus Gaji Karyawan</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <?php echo form_open_multipart('keuangan/hapusgaji') ?>
                     <input type="hidden" name="id_gaji" id="id_gaji" value="<?= $data->id_gaji ?>" class="form-control">
                     Apakah yakin akan hapus gaji <?= $data->nama_karyawan ?> bulan <?= $data->bulan_gaji ?> <?= $data->tahun_gaji ?> ?
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