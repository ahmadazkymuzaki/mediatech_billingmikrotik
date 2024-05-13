<div class="col-lg-12 mt-3">
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
	<div class="col-lg-6">
		<div class="card shadow mb-3" style="border: solid 1px grey;">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>"><a href="" data-toggle="modal" data-target="#ModalBayar" class="float-right"><i class="fa fa-info-circle"></i>&nbsp; Cara Top Up Saldo (silahkan klik)</a></h6>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-lg">
						<div class="box box-primary">
							<div class="box-body box-profile">
								<?= form_open_multipart('bill/topupSaldo'); ?>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group mb-2">
											<label for="name">Nama Pelanggan</label>
											<input type="text" class="form-control" id="name" name="name" value="<?= $user['name'] ?>" readonly>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group mb-2">
											<label for="date_payment">Nomor Layanan</label>
											<input type="text" class="form-control" autocomplete="off" name="no_services" value="<?= $user['no_services'] ?>" readonly>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group mb-2">
											<label for="name">Nomor Telepon</label>
											<input type="text" class="form-control" id="telepon" name="telepon" value="<?= $user['phone'] ?>" readonly>
											<input type="hidden" class="form-control" id="request" name="request" value="<?= date('d/m/Y H:i:s'); ?> WIB" readonly>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group mb-2">
											<label for="date_payment">Biaya Administrasi</label>
											<input type="text" class="form-control" autocomplete="off" name="admin_cost" value="Rp. <?= indo_currency($payment['admin_cost']) ?>" readonly>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group mb-2">
											<label for="name">Nominal Top Up *</label>
											<input type="number" class="form-control" id="nominal" name="nominal" placeholder="Minimal 10000" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group mb-2">
											<label for="name">Kategori Transaksi *</label>
											<select class="form-control" id="kategori" name="kategori" required>
												<option value="TOP UP SALDO">TOP UP SALDO</option>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group mb-2">
									<label for="metode_payment">Metode Pembayaran *</label>
									<select class="form-control" name="metode_payment" style="font-weight: bold;" id="metode_payment" required>
										<option value="">- Pilih Metode Pembayaran -</option>
										<?php foreach ($channel as $mydata) { ?>
											<option value="<?= $mydata->kode_channel ?>"><?= $mydata->nama_channel ?> - Konfirmasi Otomatis</option>
										<?php } ?>
									</select>
								</div>
								<div class="form-group">
									<button class="btn btn-primary">Kirim</button>
								</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="ModalBayar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Cara Top Up Saldo</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						Silahkan melakukan Transfer sesuai Jumlah
						yang telah Anda tentukan, pembayaran dapat
						dilakukan melalui Transfer ataupun Dompet
						Digital sesuai daftar berikut ini :
						<br> <br>
						<?php
						foreach ($bank as $r => $data) { ?>
							Metode VIA : <?= $data->name ?> <br> Rekening Tujuan : <?= $data->no_rek ?> <br> a/n <?= $data->owner ?> <br>
							<br>
						<?php } ?>
						Jika dalam waktu 30 menit status top up saldo
						belum juga di konfirmasi, silahkan dapat melapor
						atau konfirmasi pembayaran Anda melalui :<br><br>
						Email : <?= $company['email'] ?><br>
						Whatsapp : <?= $company['whatsapp'] ?>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<!-- <button type="button" class="btn btn-success">Konfirmasi Pembayaran</button> -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>