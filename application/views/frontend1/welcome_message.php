<div class="container mt-5">
	<div class="section-services">
		<div class="row mt-2">
			<div class="col-lg-12">
				<div class="card border-<?= $company['front'] ?>">
					<div class="card-body">
						<center>
							<h5 class="card-title">
								<b>Detail Singkat Data Anda</b>
							</h5>
						</center>
						<?php
						$identitas_1 = substr($identitas, 0, 2);
						$identitas_2 = substr($identitas, 0, 2);

						if ($identitas_1 == '08') {
							$my_customer = $this->db->get_where('customer', array('no_wa' => $identitas));
						} elseif ($identitas_2 == '22') {
							$my_customer = $this->db->get_where('customer', array('no_services' => $identitas));
						} else {
							$my_customer = $this->db->get_where('customer', array('no_ktp' => $identitas));
						}
						$data_customer = $my_customer->row_array();
						$jumlah_customer = $my_customer->num_rows();
						?>
						<div class="row mt-2">
							<?php
							if ($jumlah_customer >= 1) {
							?>
								<div class="col-12 mb-2">
									Nomor Layanan : <br>
									<b>
										<font style="color: black;"><?= $data_customer['no_services']; ?></font>
									</b>
								</div>
								<div class="col-12 mb-2">
									Nama Lengkap :<br>
									<b>
										<font style="color: black;"><?= $data_customer['name']; ?></font>
									</b>
								</div>
								<div class="col-12 mb-2">
									Nomor Identitas : <br>
									<b>
										<font style="color: black;"><?= $data_customer['no_ktp']; ?></font>
									</b>
								</div>
								<div class="col-12 mb-2">
									Nomor Telepon : <br>
									<b>
										<font style="color: black;"><?= $data_customer['no_wa']; ?></font>
									</b>
								</div>
								<div class="col-12">
									Terdaftar Sejak : <br>
									<b>
										<font style="color: black;"><?= $data_customer['register_date']; ?></font>
									</b>
								</div>
							<?php
							} else {
							?>
								<div class="col-lg-12">
									Data <?= $identitas; ?> Tidak Ditemukan!!! Silahkan Anda klik -> <a href="<?= site_url('front') ?>">Cek Kembali</a>
								</div>
							<?php
							}
							?>
						</div>
						<?php
						if ($jumlah_customer >= 1) {
						?>
							<div class="row mt-4">
								<div class="col-lg-4">
									<input class="form-control mb-2 mr-sm-2" id="no_services" name="no_services" type="hidden" value="<?= $data_customer['no_services']; ?>">
									<select style="color: grey;" name="month" id="month" class="form-control mb-2 mr-sm-2" required>
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
								<div class="col-lg-4 mb-1">
									<select style="color: grey;" class="form-control select2" style="width: 100%;" id="year" name="year" required>
										<option value="<?= date('Y') ?>"><?= date('Y') ?></option>
										<?php
										for ($i = date('Y'); $i >= date('Y') - 1; $i -= 1) {
										?>
											<option value="<?= $i ?>"><?= $i ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="col-lg-4">
									<button class="btn btn-danger mb-2 my-2 my-sm-0 form-control" type="submit" onclick="cek_bill()">Cek Tagihan</button>
								</div>
							</div>
						<?php
						}
						?>
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