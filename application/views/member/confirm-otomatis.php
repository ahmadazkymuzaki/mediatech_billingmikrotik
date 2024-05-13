<?php $subtotal = 0;
foreach ($myinvoice->result() as $c => $data) {
	$subtotal += (int) $data->total;
} ?>
<?php
$month = $bill['month'];
$year = $bill['year'];
$no_services = $bill['no_services'];
$query = "SELECT *
                                    FROM `invoice_detail`
                                        WHERE `invoice_detail`.`d_month` =  $month and
                                       `invoice_detail`.`d_year` =  $year and
                                       `invoice_detail`.`d_no_services` =  $no_services";
$queryTot = $this->db->query($query)->result(); ?>
<?php $subTotaldetail = 0;
foreach ($queryTot as  $dataa)
	$subTotaldetail += (int) $dataa->total;
?>
<!-- KODE UNIK -->
<?php if ($other['code_unique'] == 1) { ?>
	<?php $code_unique = $bill['code_unique']  ?>
<?php } ?>
<?php if ($other['code_unique'] == 0) { ?>
	<?php $code_unique = 0 ?>
<?php } ?>
<!-- END KODE UNIK -->
<?php if ($subtotal != 0) { ?>
	<?php $ppn = $subtotal * ($bill['i_ppn'] / 100) ?>
	<?php $tagihan = $subtotal + $code_unique + $ppn ?>
<?php } ?>
<?php if ($subtotal == 0) { ?>
	<?php $ppn = $subTotaldetail * ($bill['i_ppn'] / 100) ?>
	<?php $tagihan = $subTotaldetail + $code_unique + $ppn ?>
<?php } ?>
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
				<h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>"><a href="" data-toggle="modal" data-target="#ModalBayar" class="float-right"><i class="fa fa-info-circle"></i>&nbsp; Cara Bayar (silahkan klik)</a></h6>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-lg">
						<div class="box box-primary">
							<div class="box-body box-profile">
								<?= form_open_multipart('bill/confirmPayment'); ?>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group mb-2">
											<label for="no_invoice">No invoice</label>
											<input type="text" class="form-control" id="no_invoice" name="no_invoice" value="<?= $bill['invoice'] ?>" readonly>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group mb-2">
											<label for="name">Nama Pelanggan</label>
											<input type="text" class="form-control" id="name" name="name" value="<?= $bill['name'] ?>" readonly>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group mb-2">
											<label for="periode">Periode</label>
											<input type="text" class="form-control" name="periode" id="periode" value="<?= indo_month($bill['month']) ?> <?= $bill['year'] ?>" readonly>
											<input type="hidden" class="form-control" id="no_services" name="no_services" value="<?= $bill['no_services'] ?>" readonly>
											<input type="hidden" class="form-control" id="nominal" name="nominal" value="<?= $tagihan ?>" readonly>
											<input type="hidden" class="form-control" id="picture" name="picture">
											<input type="hidden" class="form-control" id="remark" name="remark">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group mb-2">
											<label for="date_payment">Tanggal Pembayaran *</label>
											<input type="date" class="form-control" autocomplete="off" name="date_payment" required>
										</div>
									</div>
								</div>
								<div class="form-group mb-2">
									<label for="metode_payment">Metode Pembayaran *</label>
									<select class="form-control" name="metode_payment" style="font-weight: bold;" id="metode_payment" required>
										<option value="">- Pilih Metode Pembayaran -</option>
										<?php foreach ($channel as $mydata) { ?>
											<option value="<?= $mydata->kode_channel ?>"><?= $mydata->nama_channel ?></option>
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
						<h5 class="modal-title" id="exampleModalLabel">Cara Pembayaran</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						Silahkan melakukan Pembayaran sesuai Jumlah
						Tagihan Internet Bulanan Wi-Fi Anda dan
						Biaya Administrasi yang telah di tentukan.

						Jika dalam waktu 30 menit status pembayaran
						belum juga di konfirmasi, silahkan dapat melapor
						atau konfirmasi pembayaran Anda melalui : <br><br>

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