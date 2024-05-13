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
<div class="container mt-5">
	<div class="section-services">
		<div class="row">
			<div class="col-lg-12">
				<div class="card border-danger">
					<div class="card-body">
						<center>
							<h5 class="card-title">
								<b>Masukkan Nomor Layanan Anda</b>
							</h5>
						</center>
							<div class="row mt-2">
								<div class="col-lg-8 mb-1">
									<input class="form-control mr-sm-2" id="no_services" name="no_services" type="number" placeholder="Nomor Layanan" required>
									<input class="form-control" id="month" name="month" type="hidden" placeholder="Bulan" value="<?= date('m') ?>" readonly>
									<input class="form-control" id="year" name="year" type="hidden" placeholder="Tahun" value="<?= date('Y') ?>" readonly>
								</div>
								<div class="col-lg-4">
									<button class="btn btn-danger my-2 my-sm-0 form-control" type="submit" onclick="cek_koneksi()">CEK KONEKSI MODEM</button>
								</div>
							</div>
					</div>
					<div class="loading"></div>
					<div class="view_data"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	function cek_koneksi() {
		var no = $('#no_services').val()
		var m = $('#month').val()
		var y = $('#year').val()
		no_services = $('[name="no_services"]');
		month = $('[name="month"]');
		year = $('[name="year"]');
		if (no == '') {
			$('#no_services').focus()
		} else {
			if (m == '') {
				$('#month').focus()
			} else {
				if (y == '') {
					$('#year').focus()
				} else {
					$.ajax({
						type: 'POST',
						data: "cek_koneksi=" + 1 + "&no_services=" + no_services.val() + "&month=" + month.val() + "&year=" + year.val(),
						url: '<?= site_url('front/view_koneksi') ?>',
						cache: false,
						beforeSend: function() {
							no_services.attr('disabled', true);
							$('.loading').html(` <div class="container">
        <div class="text-center">
            <div class="spinner-border" style="color : <?= $colornya ?>" style="width: 5rem; height: 5rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>`);
						},
						success: function(data) {
							no_services.attr('disabled', false);
							$('.loading').html('');
							$('.view_data').html(data);
						}
					});
				}
			}
		}
		return false;
	}
</script>