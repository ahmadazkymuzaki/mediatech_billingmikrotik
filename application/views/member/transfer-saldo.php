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
				<h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Saldo Anda Saat Ini : Rp. <?= indo_currency($user['saldo']) ?></h6>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-lg">
						<div class="box box-primary">
							<div class="box-body box-profile">
								<?= form_open_multipart('member/transfer'); ?>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group mb-2">
											<label for="name">Jumlah Transfer *</label>
											<input type="number" class="form-control" id="nominal_transfer" name="nominal_transfer" placeholder="Minimal 10000" required>
											<input type="hidden" class="form-control" autocomplete="off" name="nomor_services" value="<?= $user['no_services'] ?>" readonly>
											<input type="hidden" class="form-control" autocomplete="off" name="no_whatsapp" value="<?= $user['phone'] ?>" readonly>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group mb-2">
											<label for="name">Biaya Administrasi *</label>
											<input type="text" class="form-control" id="admin_cost" name="admin_cost" value="Rp. <?= indo_currency($payment['admin_cost']) ?>" readonly>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group mb-2">
											<label for="name">Kategori Transaksi *</label>
											<select class="form-control" id="kategori_transfer" name="kategori_transfer" required>
												<option value="TRANSFER SALDO">TRANSFER SALDO</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group mb-2">
											<label for="name">Tanggal Transfer</label>
											<input type="text" class="form-control" id="waktu_request" name="waktu_request" value="<?= date('d/m/Y H:i:s'); ?> WIB" readonly>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group mb-2">
											<label for="name">Nomor Rekening Tujuan *</label>
											<input type="number" class="form-control" id="rekening_tujuan" name="rekening_tujuan" placeholder="654501033377531" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group mb-2">
											<label for="date_payment">Nama Pemilik Rekening *</label>
											<input type="text" class="form-control" id="nama_penerima" name="nama_penerima" placeholder="AHMAD ZULKARNAIN AL FARISI" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group mb-2">
											<label for="name">Nama Bank Tujuan *</label>
											<select class="form-control" id="bank_tujuan" name="bank_tujuan" required>
												<option value="">- Silahkan Pilih -</option>
												<option value="Dompet Digital GO-PAY">Dompet Digital GO-PAY</option>
												<option value="Dompet Digital LINK-AJA">Dompet Digital LINK-AJA</option>
												<option value="Dompet Digital DANA">Dompet Digital DANA</option>
												<option value="Dompet Digital SAKUKU">Dompet Digital SAKUKU</option>
												<option value="Dompet Digital SHOPEE-PAY">Dompet Digital SHOPEE-PAY</option>
												<option value="Dompet Digital DO-KU">Dompet Digital DO-KU</option>
												<option value="Dompet Digital T-MONEY">Dompet Digital T-MONEY</option>
												<option value="Dompet Digital QRIS CODE">Dompet Digital QRIS CODE</option>
												<option value="Dompet Digital OVO">Dompet Digital OVO</option>
												<option value="Dompet Digital PAYPAL">Dompet Digital PAYPAL</option>
												<option value="Transfer Pulsa TELKOMSEL">Transfer Pulsa TELKOMSEL</option>
												<option value="Transfer Pulsa AXIS">Transfer Pulsa AXIS</option>
												<option value="Transfer Pulsa XL AXIATA">Transfer Pulsa XL AXIATA</option>
												<option value="Transfer Pulsa INDOSAT">Transfer Pulsa INDOSAT</option>
												<option value="Transfer Pulsa THREE">Transfer Pulsa THREE</option>
												<option value="Transfer Pulsa SMARTFREN">Transfer Pulsa SMARTFREN</option>
												<option value="Transfer Bank BRI">Transfer Bank BRI</option>
												<option value="Transfer Bank BCA">Transfer Bank BCA</option>
												<option value="Transfer Bank BNI">Transfer Bank BNI</option>
												<option value="Transfer Bank BTN">Transfer Bank BTN</option>
												<option value="Transfer Bank MANDIRI">Transfer Bank MANDIRI</option>
												<option value="Transfer Bank SAMPOERNA">Transfer Bank SAMPOERNA</option>
												<option value="Transfer Bank BUKOPIN">Transfer Bank BUKOPIN</option>
												<option value="Transfer Bank JATIM">Transfer Bank JATIM</option>
												<option value="Transfer Bank MAYBANK">Transfer Bank MAYBANK</option>
												<option value="Transfer Bank PERMATA">Transfer Bank PERMATA</option>
												<option value="Transfer Bank CIMB NIAGA">Transfer Bank CIMB NIAGA</option>
												<option value="Transfer Bank SINARMAS">Transfer Bank SINARMAS</option>
												<option value="Transfer Bank MUAMALAT">Transfer Bank MUAMALAT</option>
												<option value="Transfer Bank BPRS">Transfer Bank BPRS</option>
												<option value="Transfer Bank NEO">Transfer Bank NEO</option>
												<option value="Transfer Bank SEA">Transfer Bank SEA</option>
												<option value="Transfer Bank Lainnya">Transfer Bank Lainnya</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group mb-2">
											<label for="name">PIN Transaksi (6 digit) *</label>
											<input type="number" class="form-control" id="pin_trx" name="pin_trx" placeholder="123456" required>
										</div>
									</div>
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
	</div>
</div>