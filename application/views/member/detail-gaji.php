        <div class="col-12 mt-3">
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
            <div class="col-lg-12">
                <div class="card shadow" style="border: solid 1px grey;">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Detail Gaji</h6>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-body table-responsive">
                                <table id="zero_config" class="table table-striped no-wrap">
                                    <tr>
                                        <td>Nama Karyawan</td>
                                        <td>:</td>
                                        <td><?= $gaji['nama_karyawan'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nomor Layanan</td>
                                        <td>:</td>
                                        <td><?= $gaji['no_services'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Periode Gajian</td>
                                        <td>:</td>
                                        <td><?= $gaji['bulan_gaji'] ?> <?= $gaji['tahun_gaji'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Total Gaji</td>
                                        <td>:</td>
                                        <td>Rp. <?= indo_currency($gaji['total_gaji']) ?></td>
                                    </tr>
                                    <tr>
                                        <td>Total Kasbon</td>
                                        <td>:</td>
                                        <td>Rp. <?= indo_currency($gaji['total_kasbon']) ?></td>
                                    </tr>
                                    <tr>
                                        <td>Bonus / Komisi</td>
                                        <td>:</td>
                                        <td>Rp. <?= indo_currency($gaji['bonus_gaji']) ?></td>
                                    </tr>
                                    <tr>
                                        <td>Potongan Gaji</td>
                                        <td>:</td>
                                        <td>Rp. <?= indo_currency($gaji['potongan_gaji']) ?></td>
                                    </tr>
                                    <tr>
                                        <td>Gaji Diterima</td>
                                        <td>:</td>
                                        <td>Rp. <?= indo_currency($gaji['gaji_diterima']) ?></td>
                                    </tr>
                                    <tr>
                                        <td>Absen Masuk</td>
                                        <td>:</td>
                                        <td><?= $gaji['masuk_kerja'] ?> Hari</td>
                                    </tr>
                                    <tr>
                                        <td>Absen Lambat</td>
                                        <td>:</td>
                                        <td><?= $gaji['absen_lambat'] ?> Hari</td>
                                    </tr>
                                    <tr>
                                        <td>Absen Sakit</td>
                                        <td>:</td>
                                        <td><?= $gaji['absen_sakit'] ?> Hari</td>
                                    </tr>
                                    <tr>
                                        <td>Absen Izin</td>
                                        <td>:</td>
                                        <td><?= $gaji['absen_izin'] ?> Hari</td>
                                    </tr>
                                    <tr>
                                        <td>Tidak Absen</td>
                                        <td>:</td>
                                        <td><?= $gaji['tidak_absen'] ?> Hari</td>
                                    </tr>
                                    <tr>
                                        <td>Catatan</td>
                                        <td>:</td>
                                        <td><?= $gaji['catatan'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Status Gaji</td>
                                        <td>:</td>
                                        <td><?= $gaji['status_gaji'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Diberikan Oleh</td>
                                        <td>:</td>
                                        <td><?= $gaji['diberikan_oleh'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Diterima</td>
                                        <td>:</td>
                                        <td><?= $gaji['tanggal_gaji'] ?></td>
                                    </tr>
                                </table>
                            </div>
                            <?php if ($gaji['status_gaji'] == 'BELUM DITERIMA') { ?>
                                <div class="modal-footer">
                                    <a href="<?= site_url('member/tolakgaji/') ?><?= $gaji['id_gaji'] ?>" onclick="return confirm('Apakah anda yakin akan menolak gaji <?= $gaji['bulan_gaji'] ?> <?= $gaji['tahun_gaji'] ?> ?')" title="Tolak">
                                        <input type="button" class="btn btn-danger" value="Tolak" readonly>
                                    </a>
                                    <a href="<?= site_url('member/terimagaji/') ?><?= $gaji['id_gaji'] ?>" onclick="return confirm('Apakah anda yakin akan menerima gaji <?= $gaji['bulan_gaji'] ?> <?= $gaji['tahun_gaji'] ?> ?')" title="Terima">
                                        <input type="button" class="btn btn-success" value="Terima" readonly>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>