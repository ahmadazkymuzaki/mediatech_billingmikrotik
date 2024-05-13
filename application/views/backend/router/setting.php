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
		<div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
			<div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
				<h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Tambah Router</h6>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="card-body">
						<?php echo form_open_multipart('mikrotik/addrouter') ?>
						<div class="form-group">
							<label for="user_router">Identitas Router</label>
							<input type="text" id="name_router" name="name_router" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="host_router">Host / IP Address</label>
							<input type="text" id="host_router" name="host_router" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="port_router">Port API MikroTik</label>
							<input type="number" id="port_router" name="port_router" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="user_router">Username Login</label>
							<input type="text" id="user_router" name="user_router" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="pass_router">Password Login</label>
							<input type="password" id="pass_router" name="pass_router" class="form-control">
						</div>

					</div>
					<div class="modal-footer">
						<button type="reset" class="btn btn-secondary" data-dismiss="modal">Reset</button>
						<button type="submit" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>">Simpan</button>
					</div>
					<?php echo form_close() ?>
				</div>


			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
			<div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
				<h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Catatan</h6>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="card-body">
						<p>Secara Default :<br>
							- Address = 192.168.88.1<br>
							- Username = admin<br>
							- Password = (dikosongkan)<br>
							- Port API = 8728<br>
						</p>
						<p align="justify" style="margin-bottom: -5px;"><b>17 Langkah Mengamankan ROUTER MIKROTIK :</b><br>
							- Ubah username & password secara Berkala<br>
							- Disable service yang tidak diperlukan<br>
							- Mengubah port service yang sering digunakan<br>
							- Membatasi akses ke Router dari IP tertentu<br>
							- Mengaktifkan secure SSH dan Telnet<br>
							- Disable settingan Neighbors Discovery<br>
							- Disable atau mengubah fitur MAC Server<br>
							- Disable Interface yang tidak digunakan<br>
							- Disable fitur Bandwidth Test Server<br>
							- Disable Client Services yang tidak digunakan<br>
							- Disable atau Gunakan PIN pada LCD<br>
							- Mengaktifkan fitur Wireless Client Isolation<br>
							- Proteksi Settingan DNS dan Web Proxy<br>
							- Menggunakan Firewall Rule untuk keamanan<br>
							- Lakukan Backup System / Export Konfigurasi<br>
							- Monitoring Router Mikrotik secara Berkala<br>
							- Perbaru versi RouterOS Mikrotik secara Berkala<br>
						</p>
					</div>
					<div class="modal-footer">
						<center>Tutorial by : <a href="https://www.facebook.com/bung.iqbal80" target="_blank" style="color: black; font-weight: bold; text-decoration: none;">BUNG IQBAL</a></center>
					</div>
				</div>
				<?php echo form_close() ?>


			</div>
		</div>
	</div>
</div>

<!-- DataTales Example -->
<div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
	<div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
		<h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data Router</h6>

	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="tablebt" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th style="text-align: center;">No</th>
						<th style="text-align: center;">Identitas Router</th>
						<th style="text-align: center;">Address</th>
						<th style="text-align: center;">Port</th>
						<th style="text-align: center;">Username</th>
						<th style="text-align: center;">Status</th>
						<th style="text-align: center;">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1;
					foreach ($router as $r => $data) { ?>
						<tr>
							<td style="text-align: center;" width="5%"><?= $no++ ?></td>
							<td><?= $data->name_router ?></td>
							<td style="text-align: center;" width="20%"><?= $data->host_router ?></td>
							<td style="text-align: center;" width="10%"><?= $data->port_router ?></td>
							<td style="text-align: center;" width="13%"><?= $data->user_router ?></td>
							<td style="text-align: center;" width="12%"><?= $data->description ?></td>
							<td class="text-center" width="11%">
								<form>
									<a class="btn btn-xs btn-<?= $company['theme'] ?>" href="#ModalEdit<?= $data->router_id ?>" data-toggle="modal" title="Edit"><i class="fa fa-edit"> </i></a>
									<a class="btn btn-xs btn-danger" href="#ModalHapus<?= $data->router_id ?>" data-toggle="modal" title="Hapus"><i class="fa fa-trash"></i></a>
								</form>
							</td>
						</tr>
						<?php $id = $data->router_id; ?>
						<div class="modal fade" id="ModalEdit<?= $data->router_id ?>" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" style="display: none;" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Ubah Router</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form method="post" action="<?= site_url('mikrotik/editrouter/') ?><?= $id ?>" enctype="multipart/form-data">
										<div class="modal-body">
											<div class="form-group">
												<div class="row">
													<div class="col-md-6 pt-2">
														<label for="judul_promo">Identitas Router</label>
														<input type="text" class="form-control" id="name_router" name="name_router" value="<?= $data->name_router ?>" required>
													</div>
													<div class="col-md-6 pt-2">
														<label for="judul_promo">Status Router</label>
														<input type="text" class="form-control" id="description" name="description" value="<?= $data->description ?>" readonly>
													</div>
												</div>
												<div class="row">
													<div class="col-md-9 pt-2">
														<label for="judul_promo">Host / Address</label>
														<input type="text" class="form-control" id="host_router" name="host_router" value="<?= $data->host_router ?>" required>
													</div>
													<div class="col-md-3 pt-2">
														<label for="judul_promo">Port</label>
														<input type="number" class="form-control" id="port_router" name="port_router" value="<?= $data->port_router ?>" required>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6 pt-2">
														<label for="judul_promo">Username</label>
														<input type="text" class="form-control" id="user_router" name="user_router" value="<?= $data->user_router ?>" required>
													</div>
													<div class="col-md-6 pt-2">
														<label for="judul_promo">Password</label>
														<input type="password" class="form-control" id="pass_router" name="pass_router" value="<?= $data->pass_router ?>">
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
										<h3 class="modal-title" id="formModalLabel">Hapus Router</h3>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form method="post" action="<?= site_url('mikrotik/delete/') ?><?= $id; ?>" enctype="multipart/form-data">
											Apakah anda yakin akan hapus router <?= $data->name_router ?> ?

									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
										<button class="btn btn-danger"> Ya, lanjutkan</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>