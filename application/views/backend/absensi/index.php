  <link rel="stylesheet" href="https://files.billing.or.id/assets/backend/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
  <div class="row">
  	<div class="col-md">
  		<div style="border: 3px solid <?= $backgroundnya ?>;" class="card">
  			<div class="card-body">
  				<form class="form-inline" method="post" action="">
  					<div class="form-group mb-2">
  						<label for="bulan">Bulan</label>
  						<select name="bulan" id="bulan" class="form-control ml-2">
  							<option value="">-- Pilih Bulan --</option>
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
  					<div class="form-group mx-sm-3 mb-2">
  						<label for="tahun">Tahun</label>
  						<select name="tahun" id="tahun" class="form-control ml-2">
  							<option value="">-- Pilih Tahun --</option>
  							<?php $thn = date('Y');
								for ($i = 2020; $i < $thn + 10; $i++) { ?>
  								<option value="<?= $i; ?>"><?= $i; ?></option>
  							<?php } ?>
  						</select>
  					</div>
  					<button type="submit" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?> mb-2 ml-auto"><i class="fas fa-eye"></i> Tampilkan Data</button>
  				</form>
  				<?php
					if ((isset($_POST['bulan']) && $_POST['bulan'] != null) && (isset($_POST['tahun']) && $_POST['tahun'] != null)) {
						$bulan = $this->input->post('bulan');
						$tahun = $this->input->post('tahun');
						$bulanTahun = $bulan . $tahun;
					} else {
						$bulan = date('m');
						$tahun = date('Y');
						$bulanTahun = $bulan . $tahun;
					}

					if ($bulan == '01') {
						$bulan_filter = 'Januari';
					} elseif ($bulan == '02') {
						$bulan_filter = 'Februari';
					} elseif ($bulan == '03') {
						$bulan_filter = 'Maret';
					} elseif ($bulan == '04') {
						$bulan_filter = 'April';
					} elseif ($bulan == '05') {
						$bulan_filter = 'Mei';
					} elseif ($bulan == '06') {
						$bulan_filter = 'Juni';
					} elseif ($bulan == '07') {
						$bulan_filter = 'Juli';
					} elseif ($bulan == '08') {
						$bulan_filter = 'Agustus';
					} elseif ($bulan == '09') {
						$bulan_filter = 'September';
					} elseif ($bulan == '10') {
						$bulan_filter = 'Oktober';
					} elseif ($bulan == '11') {
						$bulan_filter = 'November';
					} elseif ($bulan == '12') {
						$bulan_filter = 'Desember';
					} else {
						$bulan_filter = '';
					}
					?>
  				<div class="alert alert-info mt-4" role="alert">Menampilkan Data Kehadiran Karyawan Bulan : <strong><?= $bulan_filter; ?> <?= $tahun; ?></strong></div>
  			</div>
  		</div>
  		<br>
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
  				<?php
					$jumlah_absensi = $this->db->get('absensi')->num_rows();
					?>
  				<h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data Absensi (<?= $jumlah_absensi; ?> item)</h6>
  			</div>
  			<div class="card-body">
  				<section class="content">
  					<div class="box">
  						<div class="table-responsive">
  							<table class="table table-bordered" id="tablebt" width="100%" cellspacing="0">
  								<thead>
  									<tr class="text-center">
  										<th>No</th>
  										<th>Waktu Absensi</th>
  										<th>Nama Karyawan</th>
  										<th>Absensi</th>
  										<th>IP Address</th>
  										<th>Aksi</th>
  									</tr>
  									<thead>
  									<tbody>
  										<?php $no = 1;
											foreach ($absensi as $a) : ?>
  											<tr>
  												<td width="5%" class="text-center"><?= $no++; ?></td>
  												<td width="23%" class="text-center"><?= substr($a['tanggal'], 0, 10); ?> <?= $a['waktu']; ?> WIB</td>
  												<td><?= $a['name']; ?></td>
  												<td width="10%" class="text-center" width="15%"><?= $a['absen']; ?></td>
  												<td class="text-center" width="15%"><?= $a['ip_add']; ?></td>
  												<td width="17%" class="text-center">
  													<button type="button" class="btn btn-warning tombolUbahPegawai" data-toggle="modal" data-target="#formModalView<?= $a['tanggal']; ?>" data-id="<?= $a['tanggal']; ?>"><i class="fas fa-eye"></i></button>
  													<button type="button" class="btn btn-success tombolUbahPegawai" data-toggle="modal" data-target="#formModalEdit<?= $a['tanggal']; ?>" data-id="<?= $a['tanggal']; ?>"><i class="fas fa-edit"></i></button>
  													<a href="<?= site_url('/karyawan/hapus/') . $a['tanggal']; ?>" onclick="return confirm('Apakah anda yakin akan menghapus data kehadiran <?= $a['name'] ?> ?')" class="btn btn-danger"><i class="fas fa-trash"></i></a>
  												</td>
  											</tr>

  											<!-- Modal -->
  											<div class="modal fade" id="formModalEdit<?= $a['tanggal']; ?>" tabindex="-1" aria-labelledby="formModalLabelSimulasi" aria-hidden="true">
  												<div class="modal-dialog">
  													<div class="modal-content">
  														<div class="modal-header">
  															<h5 class="modal-title" id="formModalLabelSimulasi">Absensi <?= $a['name']; ?></h5>
  															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  																<span aria-hidden="true">&times;</span>
  															</button>
  														</div>
  														<div class="modal-body">
  															<?php echo form_open_multipart('karyawan/alasan') ?>
  															<div class="form-group">
  																<div class="input-group">
  																	<div class="input-group-prepend">
  																		<span class="input-group-text" id="inputGroupPrepend2">Absensi Karyawan</span>
  																	</div>
  																	<input type="text" class="form-control" id="uang_makanku" name="uang_makanku" aria-describedby="inputGroupPrepend2" value="<?= $a['absen']; ?> (<?= $a['st_absen']; ?>)" readonly>
  																</div>
  															</div>
  															<div class="form-group">
  																<center><label>Alasan Karyawan</label></center>
  																<div class="input-group">
  																	<textarea type="text" class="form-control" id="gaji_pokokku" name="gaji_pokokku" readonly><?= $a['alasan']; ?></textarea>
  																</div>
  															</div>
  															<div class="form-group">
  																<center><label>Status Absensi</label></center>
  																<div class="input-group">
  																	<select class="form-control" id="st_absen" name="st_absen" required>
  																		<option>-- Pilih Status --</option>
  																		<option value="diterima">TERIMA</option>
  																		<option value="ditolak">TOLAK</option>
  																	</select>
  																</div>
  															</div>
  															<div class="form-group">
  																<center><label>Pesan Pemberitahuan</label></center>
  																<div class="input-group">
  																	<textarea type="text" class="form-control" id="pesan" name="pesan"></textarea>
  																	<input type="hidden" class="form-control" id="tanggal" name="tanggal" value="<?= $a['tanggal']; ?>" readonly>
  																</div>
  															</div>
  															<div class="modal-footer">
  																<button class="btn btn-secondary" data-dismiss="modal">Tutup</button>
  																<button class="btn btn-success" type="submit">Konfirmasi</button>
  															</div>
  															<?php echo form_close() ?>
  														</div>
  													</div>
  												</div>
  											</div>
  											<!-- Modal -->
  											<div class="modal fade" id="formModalView<?= $a['tanggal']; ?>" tabindex="-1" aria-labelledby="formModalLabelSimulasi" aria-hidden="true">
  												<div class="modal-dialog">
  													<div class="modal-content">
  														<div class="modal-header">
  															<h5 class="modal-title" id="formModalLabelSimulasi">Detail Absensi <?= $a['name']; ?></h5>
  															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  																<span aria-hidden="true">&times;</span>
  															</button>
  														</div>
  														<div class="modal-body">
  															<div class="row">
  																<div class="col-4">
  																	Kode<br>
  																	Tanggal<br>
  																	Periode<br>
  																	Absensi<br>
  																	Alasan<br>
  																	Masuk<br>
  																	Pulang<br>
  																	Durasi<br>
  																	Address<br>
  																	Status<br>
  																	Pesan
  																</div>
  																<div class="col-8">
  																	: <?= $a['kode']; ?><br>
  																	: <?= substr($a['tanggal'], 0, 10); ?><br>
  																	: <?= $bulan_filter; ?> <?= $tahun; ?><br>
  																	: <?= $a['absen']; ?><br>
  																	: <?= $a['alasan']; ?><br>
  																	: <?= $a['waktu']; ?> WIB<br>
  																	: <?= $a['pulang']; ?> WIB<br>
  																	: <?= $a['durasi']; ?> JAM<br>
  																	: <?= $a['ip_add']; ?><br>
  																	: <?= $a['st_absen']; ?><br>
  																	: <?= $a['pesan']; ?><br>
  																</div>
  															</div>
  														</div>
  														<div class="modal-footer">
  															<button class="btn btn-secondary" data-dismiss="modal">Tutup</button>
  														</div>
  													</div>
  												</div>
  											</div>
  										<?php endforeach; ?>
  										<?php if (empty($absensi)) : ?>
  											<tr>
  												<td colspan="10">
  													<div class="alert alert-danger text-center" role="alert">Data tidak ditemukan.</div>
  												</td>
  											</tr>
  										<?php endif; ?>
  									</tbody>
  							</table>
  						</div>
  					</div>
  				</section>
  			</div>
  		</div>

  		<!-- Modal -->
  		<div class="modal fade" id="formModalAbsensi" tabindex="-1" aria-labelledby="formModalLabelkehadiran" aria-hidden="true">
  			<div class="modal-dialog">
  				<div class="modal-content">
  					<div class="modal-header">
  						<h5 class="modal-title" id="formModalLabelkehadiran">Tambah Data Kehadiran</h5>
  						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  							<span aria-hidden="true">&times;</span>
  						</button>
  					</div>

  					<div class="modal-body">
  						<form action="<?= site_url('/absensi/input_kehadiran') ?>" method="post" enctype="multipart/form-data">
  							<input type="hidden" id="id_kehadiran" name="id_kehadiran">
  							<div class="form-group">
  								<div class="row">
  									<div class="col-12">
  										<label>Nama Karyawan</label>
  										<select id="basic" id="id_karyawan" name="id_karyawan" class="selectpicker show-tick form-control" data-live-search="true" tabindex="-98" required>
  											<option value="">- Pilih Karyawan -</option>
  											<?php $no = 1;
												foreach ($InputKaryawan as $b) : ?>
  												<option value="<?php echo $b['id_karyawan']; ?>"><?php echo $b['name']; ?> (<?php echo $b['nama_jabatan']; ?>) - <?php echo $b['kode']; ?></option>
  											<?php endforeach; ?>
  										</select>
  										<input type="hidden" class="form-control" id="jumlah_sakit" title="diisi 0 jika tidak ada" name="jumlah_sakit" aria-describedby="inputGroupPrepend2" value="0" required>
  										<input type="hidden" class="form-control" id="jumlah_izin" title="diisi 0 jika tidak ada" name="jumlah_izin" aria-describedby="inputGroupPrepend2" value="0" required>
  										<input type="hidden" class="form-control" id="jumlah_alpa" title="diisi 0 jika tidak ada" name="jumlah_alpa" aria-describedby="inputGroupPrepend2" value="0" required>
  										<input type="hidden" class="form-control" id="jumlah_hadir" title="diisi 0 jika tidak ada" name="jumlah_hadir" aria-describedby="inputGroupPrepend2" value="0" required>
  										<input type="hidden" class="form-control" id="nominal_lembur" title="diisi 0 jika tidak ada" name="nominal_lembur" aria-describedby="inputGroupPrepend2" value="0" required>
  										<input type="hidden" class="form-control" id="jumlah_lembur" title="diisi 0 jika tidak ada" name="jumlah_lembur" aria-describedby="inputGroupPrepend2" value="0" required>
  										<input type="hidden" class="form-control" id="uang_bpjs" title="diisi 0 jika tidak ada" name="uang_bpjs" aria-describedby="inputGroupPrepend2" value="0" required>
  										<input type="hidden" class="form-control" id="uang_thr" title="diisi 0 jika tidak ada" name="uang_thr" aria-describedby="inputGroupPrepend2" value="0" required>
  										<input type="hidden" class="form-control" id="kehadiran" title="diisi 0 jika tidak ada" name="kehadiran" aria-describedby="inputGroupPrepend2" value="0" required>
  										<input type="hidden" class="form-control" id="kedisiplinan" title="diisi 0 jika tidak ada" name="kedisiplinan" aria-describedby="inputGroupPrepend2" value="0" required>
  										<input type="hidden" class="form-control" id="hutang" title="diisi 0 jika tidak ada" name="hutang" aria-describedby="inputGroupPrepend2" value="0" required>
  										<input type="hidden" class="form-control" id="jumlah_lambat" title="diisi 0 jika tidak ada" name="jumlah_lambat" aria-describedby="inputGroupPrepend2" value="0" required>
  										<input type="hidden" class="form-control" id="cat_absen" name="cat_absen" aria-describedby="inputGroupPrepend2">
  									</div>
  								</div>
  								<hr>
  								<div class="row">
  									<div class="col-5">
  										<center><label style="padding-top: 10px;">Jabatan Karyawan</label></center>
  										<select id="basic" id="id_jabatan" name="id_jabatan" class="selectpicker show-tick form-control" required>
  											<option value="">- Pilih Jabatan -</option>
  											<?php $no = 1;
												foreach ($InputKaryawan as $c) : ?>
  												<option value="<?php echo $c['id_jabatan']; ?>"><?php echo $c['nama_jabatan']; ?></option>
  											<?php endforeach; ?>
  										</select>
  									</div>
  									<div class="col-7">
  										<center><label style="padding-top: 10px;">Periode Absensi</label></center>
  										<div class="row">
  											<div class="col-7">
  												<select class="form-control" id="bulan_gaji" name="bulan_gaji">
  													<option value="">Bulan</option>
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
  											<div class="col-5" style="margin-left: -8px;">
  												<select name="tahun_gaji" id="tahun_gaji" class="form-control ml-2">
  													<option value="">Tahun</option>
  													<?php $thn = date('Y');
														for ($i = 2020; $i < $thn + 10; $i++) { ?>
  														<option value="<?= $i; ?>"><?= $i; ?></option>
  													<?php } ?>
  												</select>
  											</div>
  										</div>
  									</div>
  								</div>
  							</div>
  							<div class="modal-footer">
  								<button type="reset" class="btn btn-danger" data-dismiss="modal">Reset</button>
  								<button type="submit" class="btn btn-success">Tambah</button>
  							</div>
  						</form>
  					</div>
  				</div>
  			</div>
  		</div>