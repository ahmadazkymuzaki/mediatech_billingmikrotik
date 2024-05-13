<!-- bootstrap datepicker -->
<link rel="stylesheet" href="https://files.billing.or.id/assets/backend/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
<!-- Page Heading -->
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
<div class="row">
	<div class="col-lg-6">
		<div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-3">
			<div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
				<h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Payment Tagihan</h6>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<?php
					foreach ($payment as $r => $data) {
						$id_payment = $data->id_payment;
					?>
						<?php echo form_open_multipart('payment/edittagihan/' . $id_payment) ?>
						<div class="card-body">
							<div class="row">
								<div class="col-6">
									<div class="form-group">
										<label for="user_router">Username Login</label>
										<input type="number" id="username" name="username" value="<?= $data->username ?>" class="form-control" required>
									</div>
								</div>
								<div class="col-6">
									<div class="form-group">
										<label for="user_router">Password Login</label>
										<input type="password" id="password" name="password" value="<?= $data->password ?>" class="form-control" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-6">
									<div class="form-group">
										<label for="user_router">Vendor Gateway</label>
										<input type="text" id="vendor_pay" name="vendor_pay" value="<?= $data->vendor_pay ?>" class="form-control" required>
									</div>
								</div>
								<div class="col-6">
									<div class="form-group">
										<label for="user_router">Kode Merchant</label>
										<input type="text" id="merchant_id" name="merchant_id" value="<?= $data->merchant_id ?>" class="form-control" required>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="host_router">API Key Vendor</label>
								<input type="text" id="apikey_pay" name="apikey_pay" value="<?= $data->apikey_pay ?>" class="form-control" required>
							</div>
							<div class="form-group">
								<label for="port_router">Private Key</label>
								<input type="text" id="private_key" name="private_key" value="<?= $data->private_key ?>" class="form-control" required>
							</div>
							<div class="row">
								<div class="col-6">
									<div class="form-group">
										<label for="pass_router">Biaya Admin</label>
										<input type="number" id="admin_cost" name="admin_cost" value="<?= $data->admin_cost ?>" class="form-control">
									</div>
								</div>
								<div class="col-6">
									<div class="form-group">
										<label for="pass_router">Masa Berlaku</label>
										<div class="row">
											<div class="col-8">
												<input type="number" id="expired_day" name="expired_day" value="<?= $data->expired_day ?>" class="form-control">
											</div>
											<div class="col-4">
												<input type="text" value="Hari" class="form-control" disabled>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="pass_router">Link URL Gateway</label>
								<input type="text" id="url_payment" name="url_payment" value="<?= $data->url_payment ?>" class="form-control">
							</div>
							<div class="form-group">
								<label for="pass_router">Link URL Callback</label>
								<input type="text" id="url_callback" name="url_callback" value="<?= $data->url_callback ?>" class="form-control">
							</div>
							<div class="row">
								<div class="col-12">
									<div class="form-group">
										<label for="pass_router" style="padding-top: 8px;">Terakhir Diperbaharui : <?= $data->update_pay ?> WIB<br><br></label>
										<div class="row">
											<div class="col-6">
												<button type="submit" style="margin-top: 3px;" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?> form-control">Simpan Perubahan</button>
											</div>
											<div class="col-6">
												<a href="<?= site_url('tripay/intruksi') ?>" style="margin-top: 3px;" target="_blank" class="btn btn-success form-control">Tes Koneksi Tripay</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php echo form_close() ?>
					<?php } ?>
				</div>


			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
			<div class="row">
				<div class="col-lg-8">
					<div class="card-body" style="padding-left: 20px; padding-top: 17px; padding-bottom: 0px; margin: 0px;">
						<p>
							<b>Butuh Jasa Setting & Pembuatan Akun ?</b><br>
							- <i>Silahkan Scan QR Code Dibawah Ini</i><br>
							- <i>Pastikan Nama Merchant : @Boss.Net</i><br>
							- <i>Masukkan Nominal Transfer : 25000</i><br>
							- <i>Tunggu Proses Registrasi 2-3 Hari Kerja</i><br>
							- <i>Dapatkan Informasi Akun. SELESAI</i>
						</p>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="card-body" style="padding-left: 20px; padding-top: 17px; padding-bottom: 0px; margin: 0px;">
						<img src="<?= site_url('assets/images') ?>/tripay.png" alt="qrcode" width="100%">
						<h6 style="margin-top: 7px; text-align: center;"><a style="font-size: 15px; font-weight: bold; text-decoration: none;" href="https://tripay.co.id" target="_blank">www.tripay.co.id</a></h6>
					</div>
				</div>
				<div class="col-lg-12" style="margin-top: -22px;">
					<div class="card-body" style="padding-left: 20px; padding-bottom: 0px; margin: 0px;">
						<p>
							<b>Login di : <a style="font-size: 15px; font-weight: bold; text-decoration: none;" href="https://tripay.id/login" target="_blank">https://tripay.id/login</a></b><br>
							- <i>Masukkan Username dan Password yang telah kami Informasikan</i><br>
							- <i>Selamat Bertransaksi dengan </i><b>TRIPAY</b> &#128519; &nbsp;&nbsp; <i>#GunakanSecaraBijak</i><br>
						</p>
					</div>
				</div>
			</div>
		</div>
		<div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
			<div class="card-body text-center">
				<div class="row justify-content-center" style="padding-bottom: 5px;">
					<div class="col-lg-12">
						<img src="<?= site_url('assets/images') ?>/qris.jpg" alt="qrcode" width="80%" title="NMID : ID1021079862517 - @Boss.Net">
					</div>
					<div class="col-lg-12 pt-2">
						<h5>Scan Menggunakan Aplikasi :</h5>
					</div>
					<div class="col-lg-2">
						<img src="<?= site_url('assets/images') ?>/shopee.png" style="border-radius: 10%;" alt="qrcode" width="80%" title="NMID : ID1021079862517 - @Boss.Net">
					</div>
					<div class="col-lg-2">
						<img src="<?= site_url('assets/images') ?>/dana.jpg" style="border-radius: 10%;" alt="qrcode" width="80%" title="NMID : ID1021079862517 - @Boss.Net">
					</div>
					<div class="col-lg-2">
						<img src="<?= site_url('assets/images') ?>/gopay.png" alt="qrcode" width="80%" title="NMID : ID1021079862517 - @Boss.Net">
					</div>
					<div class="col-lg-2">
						<img src="<?= site_url('assets/images') ?>/linkaja.png" style="border-radius: 10%;" alt="qrcode" width="80%" title="NMID : ID1021079862517 - @Boss.Net">
					</div>
					<div class="col-lg-2">
						<img src="<?= site_url('assets/images') ?>/ovo.jpg" style="border-radius: 10%;" alt="qrcode" width="80%" title="NMID : ID1021079862517 - @Boss.Net">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- DataTales Example -->
<div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
	<div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
		<div class="row">
			<div class="col-8">
				<h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data List Channel<br>Payment Gateway</h6>
			</div>
			<div class="col-4">
				<a class="btn btn-xs btn-success pull-right" href="#ModalAdd" data-toggle="modal" title="Edit"><i class="fa fa-plus"></i> Data Channel</a>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="tablebt" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th style="text-align: center;">No</th>
						<th style="text-align: center;">Logo Channel</th>
						<th style="text-align: center;">Nama Channel</th>
						<th style="text-align: center;">Dibebankan</th>
						<th style="text-align: center;">Total Biaya</th>
						<th style="text-align: center;">Status</th>
						<th style="text-align: center;">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1;
					foreach ($channel as $r => $mydata) { ?>
						<tr>
							<td style="text-align: center;" width="5%"><?= $no++ ?></td>
							<td style="text-align: center;"><img src="<?= $mydata->icon_channel ?>" width="100" alt="<?= $mydata->kode_channel ?>" title="<?= $mydata->nama_channel ?>"></td>
							<td style="text-align: left;"><?= $mydata->nama_channel ?></td>
							<td style="text-align: center;">Kepada : <?= $mydata->beban_channel ?></td>
							<td style="text-align: center;">Rp. <?= indo_currency($mydata->total_channel); ?></td>
							<td style="text-align: center;"><?= $mydata->status_channel ?></td>
							<td class="text-center">
								<form>
									<?php if ($mydata->status_channel == 'Aktif') { ?>
										<a class="btn btn-xs btn-secondary" href="disable/<?= $mydata->id_channel ?>" title="Disable">Disable</a>
									<?php } else { ?>
										<a class="btn btn-xs btn-success" href="enable/<?= $mydata->id_channel ?>" title="Enable">Enable</a>
									<?php } ?>
									<a class="btn btn-xs btn-<?= $company['theme'] ?>" href="#ModalEdit<?= $mydata->id_channel ?>" data-toggle="modal" title="Edit"><i class="fa fa-edit"> </i></a>
									<a class="btn btn-xs btn-danger" href="#ModalHapus<?= $mydata->id_channel ?>" data-toggle="modal" title="Hapus"><i class="fa fa-trash"></i></a>
								</form>
							</td>
						</tr>
						<?php $id = $mydata->id_channel; ?>
						<div class="modal fade" id="ModalEdit<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" style="display: none;" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Ubah Channel</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form method="post" action="<?= site_url('payment/editchannel/') ?><?= $id ?>" enctype="multipart/form-data">
										<div class="modal-body">
											<div class="form-group">
												<div class="row">
													<div class="col-md-8 pt-2">
														<label for="judul_promo">Nama Channel</label>
														<input type="text" class="form-control" id="nama_channel" value="<?= $mydata->nama_channel ?>" name="nama_channel" required>
													</div>
													<div class="col-md-4 pt-2">
														<label for="judul_promo">Status Channel</label>
														<select class="form-control" id="status_channel" value="" name="status_channel" required>
															<option value="<?= $mydata->status_channel ?>"><?= $mydata->status_channel ?>
															<option>
															<option value="Aktif">Aktif</option>
															<option value="Non-Aktif">Non-Aktif</option>
														</select>
													</div>
													<div class="col-md-12 pt-2">
														<label for="judul_promo">Logo Channel</label>
														<input type="text" class="form-control" id="icon_channel" value="<?= $mydata->icon_channel ?>" name="icon_channel" required>
													</div>
													<div class="col-md-4 pt-2">
														<label for="judul_promo">Kode Channel</label>
														<input type="text" class="form-control" id="kode_channel" value="<?= $mydata->kode_channel ?>" name="kode_channel" required>
													</div>
													<div class="col-md-4 pt-2">
														<label for="judul_promo">Group Channel</label>
														<select class="form-control" id="grup_channel" name="grup_channel" required>
															<option value="<?= $mydata->grup_channel ?>"><?= $mydata->grup_channel ?></option>
															<option value="Virtual Account">Virtual Account</option>
															<option value="Super Market">Super Market</option>
															<option value="Dompet Digital">Dompet Digital</option>
														</select>
													</div>
													<div class="col-md-4 pt-2">
														<label for="judul_promo">Admin Channel</label>
														<input type="number" class="form-control" id="admin_channel" value="<?= $mydata->admin_channel ?>" name="admin_channel" required>
													</div>
													<div class="col-md-4 pt-2">
														<label for="judul_promo">Beban Channel</label>
														<select class="form-control" id="beban_channel" value="" name="beban_channel" required>
															<option value="<?= $mydata->beban_channel ?>"><?= $mydata->beban_channel ?></option>
															<option value="Merchant">Merchant</option>
															<option value="Pelanggan">Pelanggan</option>
														</select>
													</div>
													<div class="col-md-4 pt-2">
														<label for="judul_promo">Biaya Channel</label>
														<input type="number" class="form-control" id="biaya_channel" value="<?= $mydata->biaya_channel ?>" name="biaya_channel" required>
													</div>
													<div class="col-md-4 pt-2">
														<label for="judul_promo">Persentase (%)</label>
														<input type="number" class="form-control" id="percent_channel" value="<?= $mydata->percent_channel ?>" name="percent_channel" required>
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
											<button style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>" id="btn_simpan"> Simpan</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="modal fade" id="ModalHapus<?= $id; ?>" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" style="display: none;" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h3 class="modal-title" id="formModalLabel">Hapus Channel</h3>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form method="post" action="<?= site_url('payment/deletechannel/') ?><?= $id; ?>" enctype="multipart/form-data">
											Apakah anda yakin akan hapus data Channel <?= $mydata->kode_channel ?> ?

									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
										<button class="btn btn-danger"> Ya, lanjutkan</button>
										</form>
									</div>
								</div>
							</div>
						</div>
						<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" style="display: none;" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Tambah Channel</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form method="post" action="<?= site_url('payment/addchannel/') ?>" enctype="multipart/form-data">
										<div class="modal-body">
											<div class="form-group">
												<div class="row">
													<div class="col-md-8 pt-2">
														<label for="judul_promo">Nama Channel</label>
														<input type="text" class="form-control" id="nama_channel" name="nama_channel" required>
													</div>
													<div class="col-md-4 pt-2">
														<label for="judul_promo">Status Channel</label>
														<select class="form-control" id="status_channel" name="status_channel" required>
															<option value="">Pilih Status</option>
															<option value="Aktif">Aktif</option>
															<option value="Non-Aktif">Non-Aktif</option>
														</select>
													</div>
													<div class="col-md-12 pt-2">
														<label for="judul_promo">Logo Channel</label>
														<input type="text" class="form-control" id="icon_channel" name="icon_channel" required>
													</div>
													<div class="col-md-4 pt-2">
														<label for="judul_promo">Kode Channel</label>
														<input type="text" class="form-control" id="kode_channel" name="kode_channel" required>
													</div>
													<div class="col-md-4 pt-2">
														<label for="judul_promo">Group Channel</label>
														<select class="form-control" id="grup_channel" name="grup_channel" required>
															<option value="">Pilih Grup</option>
															<option value="Virtual Account">Virtual Account</option>
															<option value="Super Market">Super Market</option>
															<option value="Dompet Digital">Dompet Digital</option>
														</select>
													</div>
													<div class="col-md-4 pt-2">
														<label for="judul_promo">Admin Channel</label>
														<input type="number" class="form-control" id="admin_channel" name="admin_channel" required>
													</div>
													<div class="col-md-4 pt-2">
														<label for="judul_promo">Beban Channel</label>
														<select class="form-control" id="beban_channel" name="beban_channel" required>
															<option value="">Pilih Beban</option>
															<option value="Merchant">Merchant</option>
															<option value="Pelanggan">Pelanggan</option>
														</select>
													</div>
													<div class="col-md-4 pt-2">
														<label for="judul_promo">Biaya Channel</label>
														<input type="number" class="form-control" id="biaya_channel" name="biaya_channel" required>
													</div>
													<div class="col-md-4 pt-2">
														<label for="judul_promo">Persentase (%)</label>
														<input type="number" class="form-control" id="percent_channel" name="percent_channel" required>
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
											<button style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>" id="btn_simpan"> Simpan</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>