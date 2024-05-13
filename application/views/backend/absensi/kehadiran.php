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
  					<a href="" data-toggle="modal" data-target="#formModalSimulasi" class="btn btn-secondary mb-2 ml-2"><i class="fas fa-calculator"></i> Simulasi Perhitungan</a>
  					<a href="" data-toggle="modal" data-target="#formModalAbsensi" class="btn btn-success mb-2 ml-2"><i class="fas fa-plus"></i> Input Kehadiran</a>
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
					$koneksi = mysqli_connect($company['host_database'], $company['user_database'], $company['pass_database'], $company['nama_database']);
					$data_kehadiran = mysqli_query($koneksi, "SELECT * FROM kehadiran");
					$jumlah_kehadiran = mysqli_num_rows($data_kehadiran);
					?>
  				<h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data Kehadiran (<?= $jumlah_kehadiran; ?> item)</h6>
  			</div>
  			<div class="card-body">
  				<section class="content">
  					<div class="box">
  						<div class="table-responsive">
  							<table class="table table-bordered" id="tablebt" width="100%" cellspacing="0">
  								<thead>
  									<tr class="text-center">
  										<th>No</th>
  										<th>Kode</th>
  										<th>Nama</th>
  										<th>Jabatan</th>
  										<th>Hadir</th>
  										<th>Sakit</th>
  										<th>Izin</th>
  										<th>Alpa</th>
  										<th>Lembur</th>
  										<th>Aksi</th>
  									</tr>
  									<thead>
  									<tbody>
  										<?php $no = 1;
											foreach ($absensi as $a) : ?>
  											<tr>
  												<td width="5%" class="text-center"><?= $no++; ?></td>
  												<td width="12%" class="text-center"><?= $a['kode']; ?></td>
  												<td><?= $a['name']; ?></td>
  												<td width="12%" class="text-center" width="12%"><?= $a['nama_jabatan']; ?></td>
  												<td class="text-center" width="8%"><?= $a['hadir']; ?> Hari</td>
  												<td class="text-center" width="8%"><?= $a['sakit']; ?> Hari</td>
  												<td class="text-center" width="8%"><?= $a['izin']; ?> Hari</td>
  												<td class="text-center" width="8%"><?= $a['alpa']; ?> Hari</td>
  												<td class="text-center" width="8%"><?= $a['lembur']; ?> Hari</td>
  												<td width="12%" class="text-center">
  													<button type="button" class="btn btn-success tombolUbahPegawai" data-toggle="modal" data-target="#formModalEdit<?= $a['id_kehadiran']; ?>" data-id="<?= $a['id_kehadiran']; ?>"><i class="fas fa-edit"></i></button>
  													<?php
														if ($a['status_gaji'] != 'tergantung') {
														?>
  														<a href="<?= site_url('/absensi/hapuskehadiran/') . $a['id_kehadiran']; ?>" onclick="return confirm('Apakah anda yakin akan menghapus data kehadiran <?= $a['name'] ?> ?')" class="btn btn-danger"><i class="fas fa-trash"></i></a>
  													<?php } ?>
  												</td>
  												<!-- Modal -->
  												<div class="modal fade" id="formModalEdit<?= $a['id_kehadiran']; ?>" tabindex="-1" aria-labelledby="formModalLabelEdit" aria-hidden="true">
  													<div class="modal-dialog">
  														<div class="modal-content">
  															<div class="modal-header">
  																<?php
																	$id = $a['id_kehadiran'];
																	$koneksi = mysqli_connect($company['host_database'], $company['user_database'], $company['pass_database'], $company['nama_database']);
																	$query_kehadiran = "SELECT * FROM kehadiran WHERE id_kehadiran='$id'";
																	$hasil_kehadiran = mysqli_query($koneksi, $query_kehadiran);
																	$kehadiran = mysqli_fetch_array($hasil_kehadiran);
																	$waktu_kehadiran = $kehadiran['bulan'];
																	$tahun_kehadiran = substr($waktu_kehadiran, 0, 2);
																	$id_jabatan = $kehadiran['id_jabatan'];
																	$query_jabatan = "SELECT * FROM jabatan WHERE id_jabatan='$id_jabatan'";
																	$hasil_jabatan = mysqli_query($koneksi, $query_jabatan);
																	$jabatan = mysqli_fetch_array($hasil_jabatan);
																	$id_karyawanku = $kehadiran['id_karyawan'];
																	$query_karyawanku = "SELECT * FROM karyawan WHERE id_karyawan='$id_karyawanku'";
																	$hasil_karyawanku = mysqli_query($koneksi, $query_karyawanku);
																	$karyawanku = mysqli_fetch_array($hasil_karyawanku);
																	$kode_absensi = $karyawanku['kode'];
																	$data_sakit = mysqli_query($koneksi, "SELECT * FROM absensi WHERE kode='$kode_absensi' AND absen='sakit'");
																	$jumlah_sakit = mysqli_num_rows($data_sakit);
																	$data_izin = mysqli_query($koneksi, "SELECT * FROM absensi WHERE kode='$kode_absensi' AND absen='izin'");
																	$jumlah_izin = mysqli_num_rows($data_izin);
																	$data_hadir = mysqli_query($koneksi, "SELECT * FROM absensi WHERE kode='$kode_absensi' AND absen='hadir'");
																	$jumlah_hadir = mysqli_num_rows($data_hadir);
																	$data_lembur = mysqli_query($koneksi, "SELECT * FROM absensi WHERE kode='$kode_absensi' AND durasi>8 AND absen='hadir'");
																	$jumlah_lembur = mysqli_num_rows($data_lembur);
																	$jumlah_alpa = 30 - $jumlah_izin - $jumlah_sakit - $jumlah_hadir;

																	if ($tahun_kehadiran == '01') {
																		$bulan_kehadiran = 'Januari';
																	} elseif ($tahun_kehadiran == '02') {
																		$bulan_kehadiran = 'Februari';
																	} elseif ($tahun_kehadiran == '03') {
																		$bulan_kehadiran = 'Maret';
																	} elseif ($tahun_kehadiran == '04') {
																		$bulan_kehadiran = 'April';
																	} elseif ($tahun_kehadiran == '05') {
																		$bulan_kehadiran = 'Mei';
																	} elseif ($tahun_kehadiran == '06') {
																		$bulan_kehadiran = 'Juni';
																	} elseif ($tahun_kehadiran == '07') {
																		$bulan_kehadiran = 'Juli';
																	} elseif ($tahun_kehadiran == '08') {
																		$bulan_kehadiran = 'Agustus';
																	} elseif ($tahun_kehadiran == '09') {
																		$bulan_kehadiran = 'September';
																	} elseif ($tahun_kehadiran == '10') {
																		$bulan_kehadiran = 'Oktober';
																	} elseif ($tahun_kehadiran == '11') {
																		$bulan_kehadiran = 'November';
																	} elseif ($tahun_kehadiran == '12') {
																		$bulan_kehadiran = 'Desember';
																	} else {
																		$bulan_kehadiran = '';
																	}
																	?>
  																<h5 class="modal-title" id="formModalLabelEdit">Ubah Data Kehadiran <?= $a['name']; ?></h5>
  																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  																	<span aria-hidden="true">&times;</span>
  																</button>
  															</div>
  															<div class="modal-body">
  																<form action="<?= site_url('/absensi/ubahkehadiran/') . $id ?>" method="post" enctype="multipart/form-data">
  																	<input type="hidden" id="id_kehadiran" name="id_kehadiran" value="<?= $id; ?>">
  																	<input type="hidden" id="id_jabatan" name="id_jabatan" value="<?= $a['id_jabatan']; ?>">
  																	<input type="hidden" id="id_karyawan" name="id_karyawan" value="<?= $a['id_karyawan']; ?>">
  																	<div class="form-group">
  																		<div class="row">
  																			<div class="col-6">
  																				<center><label style="padding-top: 10px;">Nama Jabatan</label></center>
  																				<input type="text" class="form-control text-center" id="nama_jabatan" name="nama_jabatan" aria-describedby="inputGroupPrepend2" value="<?= $a['nama_jabatan']; ?>" readonly>
  																			</div>
  																			<div class="col-6">
  																				<center><label style="padding-top: 10px;">Gaji Pokok</label></center>
  																				<div class="input-group">
  																					<div class="input-group-prepend">
  																						<span class="input-group-text" id="inputGroupPrepend2">Rp.</span>
  																					</div>
  																					<input type="number" class="form-control" id="gaji_pokok" name="gaji_pokok" aria-describedby="inputGroupPrepend2" value="<?= $jabatan['gaji_pokok']; ?>" readonly>
  																				</div>
  																			</div>
  																		</div>
  																		<div class="row">
  																			<div class="col-6">
  																				<center><label style="padding-top: 10px;">Tunjangan Transport</label></center>
  																				<div class="input-group">
  																					<div class="input-group-prepend">
  																						<span class="input-group-text" id="inputGroupPrepend2">Rp.</span>
  																					</div>
  																					<input type="number" class="form-control" id="tj_transport" name="tj_transport" aria-describedby="inputGroupPrepend2" value="<?= $jabatan['tj_transport']; ?>" readonly>
  																				</div>
  																			</div>
  																			<div class="col-6">
  																				<center><label style="padding-top: 10px;">Uang Makan</label></center>
  																				<div class="input-group">
  																					<div class="input-group-prepend">
  																						<span class="input-group-text" id="inputGroupPrepend2">Rp.</span>
  																					</div>
  																					<input type="number" class="form-control" id="uang_makan" name="uang_makan" aria-describedby="inputGroupPrepend2" value="<?= $jabatan['uang_makan']; ?>" readonly>
  																				</div>
  																			</div>
  																		</div>
  																		<div class="row">
  																			<div class="col-4">
  																				<center><label style="padding-top: 10px;">Absen Sakit</label></center>
  																				<div class="input-group">
  																					<input type="number" class="form-control" id="jumlah_sakit" title="diisi 0 jika tidak ada" name="jumlah_sakit" aria-describedby="inputGroupPrepend2" value="<?= $jumlah_sakit; ?>" required>
  																					<div class="input-group-prepend">
  																						<span class="input-group-text" id="inputGroupPrepend2">HARI</span>
  																					</div>
  																				</div>
  																			</div>
  																			<div class="col-4">
  																				<center><label style="padding-top: 10px;">Absen Izin</label></center>
  																				<div class="input-group">
  																					<input type="number" class="form-control" id="jumlah_izin" title="diisi 0 jika tidak ada" name="jumlah_izin" aria-describedby="inputGroupPrepend2" value="<?= $jumlah_izin; ?>" required>
  																					<div class="input-group-prepend">
  																						<span class="input-group-text" id="inputGroupPrepend2">HARI</span>
  																					</div>
  																				</div>
  																			</div>
  																			<div class="col-4">
  																				<center><label style="padding-top: 10px;">Absen Alpa</label></center>
  																				<div class="input-group">
  																					<input type="number" class="form-control" id="jumlah_alpa" title="diisi 0 jika tidak ada" name="jumlah_alpa" aria-describedby="inputGroupPrepend2" value="<?= $jumlah_alpa; ?>" required>
  																					<div class="input-group-prepend">
  																						<span class="input-group-text" id="inputGroupPrepend2">HARI</span>
  																					</div>
  																				</div>
  																			</div>
  																		</div>
  																		<div class="row">
  																			<div class="col-4">
  																				<center><label style="padding-top: 10px;">Absen Hadir</label></center>
  																				<div class="input-group">
  																					<input type="number" class="form-control" id="jumlah_hadir" title="diisi 0 jika tidak ada" name="jumlah_hadir" aria-describedby="inputGroupPrepend2" value="<?= $jumlah_hadir; ?>" required>
  																					<div class="input-group-prepend">
  																						<span class="input-group-text" id="inputGroupPrepend2">HARI</span>
  																					</div>
  																				</div>
  																			</div>
  																			<div class="col-8">
  																				<center><label style="padding-top: 10px;">Bonus Lembur &nbsp; x &nbsp; Absen Lembur</label></center>
  																				<div class="row">
  																					<div class="col-7">
  																						<div class="input-group">
  																							<div class="input-group-prepend">
  																								<span class="input-group-text" id="inputGroupPrepend2">Rp.</span>
  																							</div>
  																							<input type="number" class="form-control" id="nominal_lembur" title="diisi 0 jika tidak ada" name="nominal_lembur" aria-describedby="inputGroupPrepend2" value="<?= $kehadiran['nom_lembur']; ?>" required>
  																						</div>
  																					</div>
  																					<div class="col-5">
  																						<div class="input-group">
  																							<div class="input-group-prepend">
  																								<span class="input-group-text" id="inputGroupPrepend2">X</span>
  																							</div>
  																							<input type="number" class="form-control" id="jumlah_lembur" title="diisi 0 jika tidak ada" name="jumlah_lembur" value="<?= $jumlah_lembur; ?>" aria-describedby="inputGroupPrepend2" required>
  																						</div>
  																					</div>
  																				</div>
  																			</div>
  																		</div>
  																		<div class="row">
  																			<div class="col-6">
  																				<center><label style="padding-top: 10px;">Tunjangan BPJS</label></center>
  																				<div class="input-group">
  																					<div class="input-group-prepend">
  																						<span class="input-group-text" id="inputGroupPrepend2">Rp.</span>
  																					</div>
  																					<input type="number" class="form-control" id="uang_bpjs" title="diisi 0 jika tidak ada" name="uang_bpjs" aria-describedby="inputGroupPrepend2" value="<?= $kehadiran['bpjs']; ?>" required>
  																				</div>
  																			</div>
  																			<div class="col-6">
  																				<center><label style="padding-top: 10px;">Bonus THR</label></center>
  																				<div class="input-group">
  																					<div class="input-group-prepend">
  																						<span class="input-group-text" id="inputGroupPrepend2">Rp.</span>
  																					</div>
  																					<input type="number" class="form-control" id="uang_thr" title="diisi 0 jika tidak ada" name="uang_thr" aria-describedby="inputGroupPrepend2" value="<?= $kehadiran['thr']; ?>" required>
  																				</div>
  																			</div>
  																		</div>
  																		<div class="row">
  																			<div class="col-6">
  																				<center><label style="padding-top: 10px;">Bonus Kerajinan (kehadiran)</label></center>
  																				<div class="input-group">
  																					<div class="input-group-prepend">
  																						<span class="input-group-text" id="inputGroupPrepend2">Rp.</span>
  																					</div>
  																					<input type="number" class="form-control" id="kehadiran" title="diisi 0 jika tidak ada" name="kehadiran" aria-describedby="inputGroupPrepend2" value="<?= $kehadiran['rajin']; ?>" required>
  																				</div>
  																			</div>
  																			<div class="col-6">
  																				<center><label style="padding-top: 10px;">Bonus Kedisiplinan (waktu)</label></center>
  																				<div class="input-group">
  																					<div class="input-group-prepend">
  																						<span class="input-group-text" id="inputGroupPrepend2">Rp.</span>
  																					</div>
  																					<input type="number" class="form-control" id="kedisiplinan" title="diisi 0 jika tidak ada" name="kedisiplinan" aria-describedby="inputGroupPrepend2" value="<?= $kehadiran['disiplin']; ?>" required>
  																				</div>
  																			</div>
  																		</div>
  																		<div class="row">
  																			<div class="col-8">
  																				<center><label style="padding-top: 10px;">Kasbon / Hutang (selama 1 bulan)</label></center>
  																				<div class="input-group">
  																					<div class="input-group-prepend">
  																						<span class="input-group-text" id="inputGroupPrepend2">Rp.</span>
  																					</div>
  																					<input type="number" class="form-control" id="hutang" title="diisi 0 jika tidak ada" name="hutang" aria-describedby="inputGroupPrepend2" value="<?= $kehadiran['hutang']; ?>" required>
  																				</div>
  																			</div>
  																			<div class="col-4">
  																				<center><label style="padding-top: 10px;">Absen Lambat</label></center>
  																				<div class="input-group">
  																					<input type="number" class="form-control" id="jumlah_lambat" title="diisi 0 jika tidak ada" name="jumlah_lambat" aria-describedby="inputGroupPrepend2" value="<?= $kehadiran['lambat']; ?>" required>
  																					<div class="input-group-prepend">
  																						<span class="input-group-text" id="inputGroupPrepend2">JAM</span>
  																					</div>
  																				</div>
  																			</div>
  																		</div>
  																		<div class="row">
  																			<div class="col-12">
  																				<center><label style="padding-top: 10px;">Catatan Kehadiran</label></center>
  																				<textarea type="text" class="form-control" id="cat_absen" name="cat_absen" aria-describedby="inputGroupPrepend2"><?= $kehadiran['cat_absen']; ?></textarea>
  																			</div>
  																		</div>
  																	</div>
  																	<div class="modal-footer">
  																		<span>Periode : <?= $bulan_kehadiran ?> <?= substr($waktu_kehadiran, 2); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
  																		<button type="reset" class="btn btn-danger" data-dismiss="modal">Reset</button>
  																		<button type="submit" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>">Perbarui</button>
  																	</div>
  																</form>
  															</div>
  														</div>
  													</div>
  												</div>
  											</tr>
  											</tr>
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

  		<!-- Modal -->
  		<div class="modal fade" id="formModalSimulasi" tabindex="-1" aria-labelledby="formModalLabelSimulasi" aria-hidden="true">
  			<div class="modal-dialog">
  				<div class="modal-content">
  					<div class="modal-header">
  						<h5 class="modal-title" id="formModalLabelSimulasi">Simulasi Perhitungan Gaji si "A"</h5>
  						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  							<span aria-hidden="true">&times;</span>
  						</button>
  					</div>
  					<?php
						$query_jabatan1 = "SELECT * FROM jabatan WHERE id_jabatan=5";
						$hasil_jabatan1 = mysqli_query($koneksi, $query_jabatan1);
						$jabatan1 = mysqli_fetch_array($hasil_jabatan1);
						?>
  					<div class="modal-body">
  						<form action="" method="" enctype="">
  							<div class="form-group">
  								<div class="row">
  									<div class="col-6">
  										<center><label style="padding-top: 10px;">Gaji Pokok</label></center>
  										<div class="input-group">
  											<div class="input-group-prepend">
  												<span class="input-group-text" id="inputGroupPrepend2">Rp.</span>
  											</div>
  											<input type="number" class="form-control" id="gaji_pokokku" name="gaji_pokokku" aria-describedby="inputGroupPrepend2" value="<?= $jabatan1['gaji_pokok']; ?>" readonly>
  										</div>
  									</div>
  									<div class="col-6">
  										<center><label style="padding-top: 10px;">Uang Makan</label></center>
  										<div class="input-group">
  											<div class="input-group-prepend">
  												<span class="input-group-text" id="inputGroupPrepend2">Rp.</span>
  											</div>
  											<input type="number" class="form-control" id="uang_makanku" name="uang_makanku" aria-describedby="inputGroupPrepend2" value="<?= $jabatan1['uang_makan']; ?>" readonly>
  										</div>
  									</div>
  								</div>
  								<div class="row">
  									<div class="col-6">
  										<center><label style="padding-top: 10px;">Tunjangan Transport</label></center>
  										<div class="input-group">
  											<div class="input-group-prepend">
  												<span class="input-group-text" id="inputGroupPrepend2">Rp.</span>
  											</div>
  											<input type="number" class="form-control" id="tj_transportku" name="tj_transportku" aria-describedby="inputGroupPrepend2" value="<?= $jabatan1['tj_transport']; ?>" readonly>
  										</div>
  									</div>
  									<div class="col-6">
  										<center><label style="padding-top: 10px;">Absen Keterlambatan</label></center>
  										<div class="input-group">
  											<input type="number" class="form-control" id="jumlah_lambatku" title="diisi 0 jika tidak ada" name="jumlah_lambatku" aria-describedby="inputGroupPrepend2" value="6" required>
  											<div class="input-group-prepend">
  												<span class="input-group-text" id="inputGroupPrepend2">JAM</span>
  											</div>
  										</div>
  									</div>
  								</div>
  								<div class="row">
  									<div class="col-4">
  										<center><label style="padding-top: 10px;">Absen Sakit</label></center>
  										<div class="input-group">
  											<input type="number" class="form-control" id="jumlah_sakitku" onkeyup="javascript:sum();" title="diisi 0 jika tidak ada" value="4" name="jumlah_sakitku" aria-describedby="inputGroupPrepend2" required>
  											<div class="input-group-prepend">
  												<span class="input-group-text" id="inputGroupPrepend2">HARI</span>
  											</div>
  										</div>
  									</div>
  									<div class="col-4">
  										<center><label style="padding-top: 10px;">Absen Izin</label></center>
  										<div class="input-group">
  											<input type="number" class="form-control" onkeyup="javascript:sum();" id="jumlah_izinku" title="diisi 0 jika tidak ada" value="2" name="jumlah_izinku" aria-describedby="inputGroupPrepend2" required>
  											<div class="input-group-prepend">
  												<span class="input-group-text" id="inputGroupPrepend2">HARI</span>
  											</div>
  										</div>
  									</div>
  									<div class="col-4">
  										<center><label style="padding-top: 10px;">Absen Alpa</label></center>
  										<div class="input-group">
  											<input type="number" class="form-control" onkeyup="javascript:sum();" id="jumlah_alpaku" title="diisi 0 jika tidak ada" value="3" name="jumlah_alpaku" aria-describedby="inputGroupPrepend2" required>
  											<div class="input-group-prepend">
  												<span class="input-group-text" id="inputGroupPrepend2">HARI</span>
  											</div>
  										</div>
  									</div>
  								</div>
  								<div class="row">
  									<div class="col-4">
  										<center><label style="padding-top: 10px;">Absen Hadir</label></center>
  										<div class="input-group">
  											<input type="number" class="form-control" onkeyup="javascript:sum();" id="jumlah_hadirku" title="diisi 0 jika tidak ada" value="21" name="jumlah_hadirku" aria-describedby="inputGroupPrepend2" required>
  											<div class="input-group-prepend">
  												<span class="input-group-text" id="inputGroupPrepend2">HARI</span>
  											</div>
  										</div>
  									</div>
  									<div class="col-8">
  										<center><label style="padding-top: 10px;">Bonus Lembur / Jam &nbsp; x &nbsp; Jumlah Jam</label></center>
  										<div class="row">
  											<div class="col-7">
  												<div class="input-group">
  													<div class="input-group-prepend">
  														<span class="input-group-text" id="inputGroupPrepend2">Rp.</span>
  													</div>
  													<input type="number" class="form-control" onkeyup="javascript:sum();" id="nominal_lemburku" title="diisi 0 jika tidak ada" value="20000" name="nominal_lemburku" aria-describedby="inputGroupPrepend2" required>
  												</div>
  											</div>
  											<div class="col-5">
  												<div class="input-group">
  													<div class="input-group-prepend">
  														<span class="input-group-text" id="inputGroupPrepend2">X</span>
  													</div>
  													<input type="number" class="form-control" id="jumlah_lemburku" onkeyup="javascript:sum();" title="diisi 0 jika tidak ada" value="13" name="jumlah_lemburku" aria-describedby="inputGroupPrepend2" required>
  												</div>
  											</div>
  										</div>
  									</div>
  								</div>
  								<div class="row">
  									<div class="col-6">
  										<center><label style="padding-top: 10px;">Tunjangan BPJS</label></center>
  										<div class="input-group">
  											<div class="input-group-prepend">
  												<span class="input-group-text" id="inputGroupPrepend2">Rp.</span>
  											</div>
  											<input type="number" class="form-control" id="uang_bpjsku" onkeyup="javascript:sum();" title="diisi 0 jika tidak ada" name="uang_bpjsku" value="75000" aria-describedby="inputGroupPrepend2" required>
  										</div>
  									</div>
  									<div class="col-6">
  										<center><label style="padding-top: 10px;">Bonus THR</label></center>
  										<div class="input-group">
  											<div class="input-group-prepend">
  												<span class="input-group-text" id="inputGroupPrepend2">Rp.</span>
  											</div>
  											<input type="number" class="form-control" id="uang_thrku" onkeyup="javascript:sum();" title="diisi 0 jika tidak ada" name="uang_thrku" value="500000" aria-describedby="inputGroupPrepend2" required>
  										</div>
  									</div>
  								</div>
  								<div class="row">
  									<div class="col-6">
  										<center><label style="padding-top: 10px;">Bonus Kerajinan (kehadiran)</label></center>
  										<div class="input-group">
  											<div class="input-group-prepend">
  												<span class="input-group-text" id="inputGroupPrepend2">Rp.</span>
  											</div>
  											<input type="number" class="form-control" id="kehadiranku" onkeyup="javascript:sum();" title="diisi 0 jika tidak ada" name="kehadiranku" value="100000" aria-describedby="inputGroupPrepend2" required>
  										</div>
  									</div>
  									<div class="col-6">
  										<center><label style="padding-top: 10px;">Bonus Kedisiplinan (waktu)</label></center>
  										<div class="input-group">
  											<div class="input-group-prepend">
  												<span class="input-group-text" id="inputGroupPrepend2">Rp.</span>
  											</div>
  											<input type="number" class="form-control" id="kedisiplinanku" onkeyup="javascript:sum();" title="diisi 0 jika tidak ada" name="kedisiplinanku" value="100000" aria-describedby="inputGroupPrepend2" required>
  										</div>
  									</div>
  								</div>
  								<div class="row">
  									<div class="col-6">
  										<center><label style="padding-top: 10px;">Hutang Karyawan</label></center>
  										<div class="input-group">
  											<div class="input-group-prepend">
  												<span class="input-group-text" id="inputGroupPrepend2">Rp.</span>
  											</div>
  											<input type="number" class="form-control" id="hutangku" onkeyup="javascript:sum();" title="diisi 0 jika tidak ada" name="hutangku" value="280000" aria-describedby="inputGroupPrepend2" required>
  										</div>
  									</div>
  									<div class="col-6">
  										<center><label style="padding-top: 10px;">Total Gaji</label></center>
  										<div class="input-group">
  											<div class="input-group-prepend">
  												<span class="input-group-text" id="inputGroupPrepend2">Rp.</span>
  											</div>
  											<input type="number" class="form-control" id="total_gajiku" name="total_gajiku" aria-describedby="inputGroupPrepend2" readonly>
  										</div>
  									</div>
  								</div>
  							</div>
  							<div class="modal-footer">
  								<button class="btn btn-secondary" data-dismiss="modal">Tutup</button>
  							</div>
  						</form>
  					</div>
  				</div>
  			</div>
  		</div>
  		<script type="text/javascript">
  			function sum() {
  				var bonus_pokok = parseInt(document.getElementById('gaji_pokokku').value);
  				var bonus_trans = parseInt(document.getElementById('tj_transportku').value);
  				var bonus_makan = parseInt(document.getElementById('uang_makanku').value);
  				var gj_sakit = ((bonus_pokok / 30) / 2) * parseInt(document.getElementById('jumlah_sakitku').value);
  				var gj_izin = ((bonus_pokok / 30) / 4) * parseInt(document.getElementById('jumlah_izinku').value);
  				var gj_lambat = ((bonus_pokok / 30) / 8) * parseInt(document.getElementById('jumlah_lambatku').value);
  				var gj_alpa = (bonus_pokok / 15) * parseInt(document.getElementById('jumlah_alpaku').value);
  				var gj_hadir = (bonus_pokok / 30) * parseInt(document.getElementById('jumlah_hadirku').value);
  				var jm_lembur = parseInt(document.getElementById('jumlah_lemburku').value);
  				var uang_lembur = parseInt(document.getElementById('nominal_lemburku').value);
  				var gj_lembur = jm_lembur * uang_lembur;
  				var bonus_bpjs = parseInt(document.getElementById('uang_bpjsku').value);
  				var bonus_thr = parseInt(document.getElementById('uang_thrku').value);
  				var bonus_rajin = parseInt(document.getElementById('kehadiranku').value);
  				var bonus_disiplin = parseInt(document.getElementById('kedisiplinanku').value);
  				var minus_hutang = parseInt(document.getElementById('hutangku').value);
  				var result = gj_sakit + gj_izin + gj_hadir + gj_lembur + bonus_bpjs + bonus_thr + bonus_rajin + bonus_disiplin + bonus_trans + bonus_makan - gj_alpa - gj_lambat - minus_hutang;

  				if (!isNaN(result)) {
  					document.getElementById('total_gajiku').value = Math.round(result);
  				}
  				if (isNaN(result)) {
  					document.getElementById('total_gajiku').value = '';
  				}
  			}
  			sum();
  		</script>