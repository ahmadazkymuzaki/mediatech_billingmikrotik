<?= $this->session->userdata('role_id') ?>
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
			<div class="card-body">
				<div class="row">
					<div class="col-lg">
						<div class="box box-primary">
							<div class="box-body box-profile">
								<?php echo form_open_multipart('member/tambahvoucher') ?>
								<div class="form-group mb-3">
									<label for="periode">Pilih Server Hotspot</label>
									<select name="server_hotspot" id="server_hotspot" class="form-control" required>
										<option value="">-- Pilih Server Hotspot --</option>
										<?php foreach ($hotspotserver as $datague) { ?>
											<option value="<?= $datague['name'] ?>"><?= $datague['name'] ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="form-group mb-3">
									<label for="periode">Pilih Paket</label>
									<select name="paket_voucher" id="paket_voucher" class="form-control" required>
										<option value="">-- Pilih Paket Hotspot --</option>
										<?php
										    $package = $this->db->get_where('package_item', array('category_id' => 2))->result();
										    foreach ($package as $datagua) {
										?>
											<option value="<?= $datagua->p_item_id ?>"><?= $datagua->name ?> - Rp. <?= indo_currency($datagua->price) ?></option>
										<?php } ?>
									</select>
									<input type="hidden" class="form-control" id="whatsapp" name="whatsapp" value="<?= $user['phone'] ?>" readonly>
									<input type="hidden" class="form-control" id="no_services" name="no_services" value="<?= $user['no_services'] ?>" readonly>
									<input type="hidden" name="create_voucher" id="create_voucher" class="form-control" value="<?= date('d-m-Y H:i:s'); ?> WIB" readonly>
								</div>
								<div class="form-group mb-3">
									<label for="periode">Username Voucher</label>
									<input type="text" name="user_voucher" id="user_voucher" class="form-control" placeholder="Username Voucher" required>
								</div>
								<div class="form-group mb-3">
									<label for="periode">Password Voucher</label>
									<input type="text" name="pass_voucher" id="pass_voucher" class="form-control" placeholder="Password Voucher" required>
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-primary form-control">Buat Voucher Sekarang</button>
								</div>
								<?php echo form_close() ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>