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
					$koneksi = mysqli_connect($company['host_database'], $company['user_database'], $company['pass_database'], $company['nama_database']);
					$data_kehadiran = mysqli_query($koneksi, "SELECT * FROM kehadiran");
					$jumlah_kehadiran = mysqli_num_rows($data_kehadiran);
					?>
  				<h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data Kehadiran <?= $bulan_filter; ?> <?= $tahun; ?> (<?= $jumlah_kehadiran; ?> item)</h6>
  			</div>
  			<div class="card-body">
  				<section class="content">
  					<div class="box">
  						<div class="table-responsive">
  							<table class="table table-bordered" id="tablebt" width="100%" cellspacing="0">
  								<thead>
  									<tr class="text-center">
  										<th>No</th>
  										<th>Nama Karyawan</th>
  										<th>Diterima</th>
  										<th>Potongan</th>
  										<th>Total Gaji</th>
  										<th>Status</th>
  										<th>Aksi</th>
  									</tr>
  									<thead>
  									<tbody>
  										<?php $no = 1;
											foreach ($absensi as $a) : ?>
  											<tr>
  												<?php
													$koneksi = mysqli_connect($company['host_database'], $company['user_database'], $company['pass_database'], $company['nama_database']);
													$data_penggajian = mysqli_query($koneksi, "SELECT SUM(total) AS total_sum FROM kehadiran WHERE bulan='$bulanTahun'");
													$row = mysqli_fetch_assoc($data_penggajian);
													$total_penggajian = $row['total_sum'];

													$id_kehadiran = $a['id_kehadiran'];
													$query_kehadiran = "SELECT * FROM kehadiran WHERE id_kehadiran='$id_kehadiran'";
													$hasil_kehadiran = mysqli_query($koneksi, $query_kehadiran);
													$kehadiran = mysqli_fetch_array($hasil_kehadiran);
													$id_karyawan = $kehadiran['id_karyawan'];
													$id_jabatan = $kehadiran['id_jabatan'];
													$query_karyawan = "SELECT * FROM karyawan WHERE id_karyawan='$id_karyawan'";
													$hasil_karyawan = mysqli_query($koneksi, $query_karyawan);
													$karyawan = mysqli_fetch_array($hasil_karyawan);
													$id_user = $karyawan['id_user'];
													$query_user = "SELECT * FROM user WHERE id='$id_user'";
													$hasil_user = mysqli_query($koneksi, $query_user);
													$user = mysqli_fetch_array($hasil_user);
													$query_jabatan = "SELECT * FROM jabatan WHERE id_jabatan='$id_jabatan'";
													$hasil_jabatan = mysqli_query($koneksi, $query_jabatan);
													$jabatan = mysqli_fetch_array($hasil_jabatan);

													$gaji_pokok = $jabatan['gaji_pokok'];
													$bonus_trans = $jabatan['tj_transport'];
													$bonus_makan = $jabatan['uang_makan'];
													$jumlah_hadir = $a['hadir'];
													$jumlah_sakit = $a['sakit'];
													$jumlah_izin = $a['izin'];
													$jumlah_alpa = $a['alpa'];
													$jumlah_lembur = $a['lembur'];
													$jumlah_lambat = $a['lambat'];
													$nominal_lembur = $a['nom_lembur'];
													$gaji_lembur = $jumlah_lembur * $nominal_lembur;
													$uang_bpjs = $a['bpjs'];
													$uang_thr = $a['thr'];
													$kehadiran = $a['rajin'];
													$kedisiplinan = $a['disiplin'];
													$hutang = $a['hutang'];

													$tj_transport = ($bonus_trans / 30) * $jumlah_hadir;
													$uang_makan = ($bonus_makan / 30) * $jumlah_hadir;

													$gaji_hadir = ($gaji_pokok / 30);
													$gaji_sakit = ($gaji_hadir / 2);
													$gaji_izin = ($gaji_hadir / 4);
													$gaji_alpa = ($gaji_pokok / 15);
													$gaji_lambat = ($gaji_hadir / 8);
													$total_hadir = $gaji_hadir * $jumlah_hadir;
													$total_sakit = $gaji_sakit * $jumlah_sakit;
													$total_izin = $gaji_izin * $jumlah_izin;
													$total_alpa = $gaji_alpa * $jumlah_alpa;
													$total_lambat = $gaji_lambat * $jumlah_lambat;

													$penerimaan = $total_hadir + $total_sakit + $total_izin + $gaji_lembur + $uang_makan + $uang_bpjs + $tj_transport + $uang_thr + $kehadiran + $kedisiplinan;
													$potongan = $total_alpa + $total_lambat + $hutang;
													$gaji_diterima = $penerimaan - $potongan;
													?>
  												<td width="5%" class="text-center"><?= $no++; ?></td>
  												<td><?= $a['name']; ?></td>
  												<td style="text-align: right;" width="17%">Rp. <?= indo_currency($gaji_diterima); ?></td>
  												<td style="text-align: right;" width="13%">Rp. <?= indo_currency($potongan); ?></td>
  												<td style="text-align: right;" width="13%">Rp. <?= indo_currency($penerimaan); ?></td>
  												<td class="text-center" width="10%"><?= $a['status_gaji']; ?></td>
  												<td class="text-center" width="12%">
  													<?php
														$status_gaji = $a['status_gaji'];
														if ($status_gaji == 'terhutang') {
														?>
  														<a href="<?= site_url('/absensi/cairkan/') . $a['id_kehadiran']; ?>" title="Cetak Slip Gaji" onclick="return confirm('Apakah anda yakin akan mencairkan gaji <?= $a['name'] ?> ?')" class="btn btn-success"><i class="fas fa-money"></i></a>
  													<?php
														}
														?>
  													<a target="_blank" href="<?= site_url('/absensi/cetakslipgaji/') . $a['id_kehadiran']; ?>" title="Cetak Slip Gaji" onclick="return confirm('Apakah anda yakin akan mencetak slip gaji <?= $a['name'] ?> ?')" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>"><i class="fas fa-print"></i></a>
  												</td>
  											</tr>
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
  									<?php if (!empty($absensi)) : ?>
  								<tfoot>
  									<tr>
  										<th style="text-align: right;" colspan="2"><b>Total Penggajian <?= $bulan_filter; ?> <?= $tahun; ?></b></th>
  										<th style="text-align: right;">Rp. <?= indo_currency($total_penggajian); ?></th>
  										<th style="text-align: left;" colspan="4">Terbilang : <i><?= number_to_words($total_penggajian) ?> Rupiah</i></th>
  									</tr>
  								</tfoot>
  							<?php endif; ?>
  							</table>
  						</div>
  					</div>
  				</section>
  			</div>
  		</div>