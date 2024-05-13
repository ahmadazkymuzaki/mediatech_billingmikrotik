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
<div class="container mt-2">
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
								<div class="col-lg-6 mb-2">
									<select name="month" id="month" class="form-control mr-sm-2" required>
										<option value="<?= date('m') ?>"><?= indo_month('m') ?></option>
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
								<div class="col-lg-6 mb-2">
									<select class="form-control select2" style="width: 100%;" id="year" name="year" required>
										<option value="<?= date('Y') ?>"><?= date('Y') ?></option>
										<?php
										for ($i = date('Y'); $i >= date('Y') - 1; $i -= 1) {
										?>
											<option value="<?= $i ?>"><?= $i ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="col-lg-8 mb-1">
									<input class="form-control mr-sm-2" id="no_services" name="no_services" type="number" placeholder="Nomor Layanan" required>
								</div>
								<div class="col-lg-4">
									<button class="btn btn-dark my-2 my-sm-0 form-control" type="submit" onclick="cek_bill()">CEK TAGIHAN SAYA</button>
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
	function cek_bill() {
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
						data: "cek_bill=" + 1 + "&no_services=" + no_services.val() + "&month=" + month.val() + "&year=" + year.val(),
						url: '<?= site_url('front/view_bill') ?>',
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