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
	<div class="col-lg-12">
		<div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
			<div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-center">Scan QR Code WhatsApp Web (cek di pengaturan perangkat tertaut)</h6>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="card-body">
						<link href="https://naufal.labkom.us/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
						<link href="https://naufal.labkom.us/bower_components/morrisjs/morris.css" rel="stylesheet">
						<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
						<center>
							<div class="row">
								<div class="col-md-3 col-lg-3 col-12 pt-1 pb-1" style="margin-top: -3px; margin-bottom: -10px;">
									<h6> Status WA Gateway :<br><span id="status"></span> </h6>
								</div>
								<div class="col-md-5 col-lg-5 col-12 pt-1 pb-1">
									<span id="qr"></span>
								</div>
								<div class="col-md-2 col-lg-2 col-12 pt-1 pb-1">
									<a class="btn btn-danger btn-block" target="_blank" href="https://naufalid.herokuapp.com/deletesess"> Logout </a>
								</div>
								<div class="col-md-2 col-lg-2 col-12 pt-1 pb-1">
									<a class="btn btn-warning btn-block" target="_blank" href="https://naufalid.herokuapp.com/reset"> Reset</a>
								</div>
							</div>
						</center>
						<script src="https://naufal.labkom.us/bower_components/jquery/dist/jquery.min.js"></script>
						<script src="https://naufal.labkom.us/bower_components/metisMenu/dist/metisMenu.min.js"></script>
						<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
						<script src="https://naufal.labkom.us/js/jquery.nicescroll.js"></script>
						<script src="https://naufal.labkom.us/bower_components/raphael/raphael-min.js"></script>
						<script src="https://naufal.labkom.us/bower_components/morrisjs/morris.js"></script>
						<script src="https://naufal.labkom.us/js/waves.js"></script>
						<script src="https://naufal.labkom.us/js/myadmin.js"></script>
						<script src="https://naufal.labkom.us/js/dashboard1.js"></script>
						<script>
						</script>
						<script src="https://cdn.jsdelivr.net/npm/davidshimjs-qrcodejs@0.0.2/qrcode.min.js"></script>
						<script>
							getWaStatus();
							setInterval(getWaStatus, 3000);

							function getWaStatus() {
								$.get("https://naufalid.herokuapp.com/status", function(data) {
									console.log(data);
									if (data.msg == "READY") {
										$("#status").html('<span class="badge badge-success">ONLINE</span>');
										$("#qr").empty();
									} else {
										$("#status").html('<span class="badge badge-danger">OFFLINE</span>');
										getAndShowQR();
									}
								});
							}

							function getAndShowQR() {
								$.get("https://naufalid.herokuapp.com/qr", function(data) {
									if (data.data.qr) {
										$("#qr").empty();
										new QRCode(document.getElementById("qr"), data.data.qr);
									}
								});
							}
						</script>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>