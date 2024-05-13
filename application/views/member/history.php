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
			} elseif ($company['theme'] == 'orange') {
				$backgroundnya = '#fd7e14';
				$colornya = '#fff';
			} else {
				$backgroundnya = '#e74a3b';
				$colornya = '#fff';
			}
			?>
    	</div>
    	<div class="col-lg-12 mt-3">
    		<div class="col-12">
    			<div class="card shadow mb-3" style="border: solid 1px grey;">
    				<div class="card-header py-3">
    					<h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Daftar Riwayat Tagihan</h6>

    				</div>
    				<div class="card-body">
    					<div class="table-responsive">
    						<table id="zero_config" class="table table-striped table-bordered no-wrap">
    							<thead>
    								<tr style="text-align: center">
    									<th style="text-align: center;">Periode</th>
    									<th style="text-align: center;">Tahun</th>
    									<th style="text-align: center;">Nominal</th>
    									<th style="text-align: center;">Status</th>
    									<th style="text-align: center;">Terbilang</th>
    								</tr>
    							</thead>
    							<tbody>
    								<?php foreach ($myinvoice as $r => $data) { ?>
    									<?php
										$query = "SELECT *
                                                                    FROM `invoice_detail`                  
                                                                        WHERE `invoice_detail`.`invoice_id` = $data->invoice  ";
										$querying = $this->db->query($query)->result(); ?>
    									<?php $subtotal = 0;
										foreach ($querying as  $dataa)
											$subtotal += (int) $dataa->total;
										?>
    									<?php
										$month =   $data->month;
										$year = $data->year;
										$no_services = $data->no_services;
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
    									<?php if ($subtotal != 0) { ?>
    										<tr>
    											<td>
    												<a href="" style="color: green;" data-toggle="modal" data-target="#Modal<?= $data->invoice ?>"><?= strtoupper(indo_month($data->month)) ?></a>
    											</td>
    											<td style="text-align: center;">
    												<?= $data->year ?>
    											</td>
    											<td>
    												<?php if ($other['code_unique'] == 1) { ?>
    													<?php $code_unique = $data->code_unique ?>
    												<?php } ?>
    												<?php if ($other['code_unique'] == 0) { ?>
    													<?php $code_unique = 0 ?>
    												<?php } ?>
    												<!-- END KODE UNIK -->
    												<?php $ppn = $subtotal * ($data->i_ppn / 100) ?>
    												<font style="color: blue;" class="fw-700">Rp. <?= indo_currency($subtotal + $code_unique + $ppn) ?></font>
    											</td>
    											<td style="text-align: center;">
    												<?php if ($data->status == 'SUDAH BAYAR') {  ?>
    													<font class="text-green" style="color: green;">SUDAH BAYAR</font>
    												<?php } else {  ?>
    													<font class="text-red" style="color: red;"><?= $data->status ?></font>
    												<?php } ?>
    											</td>
    											<td>
    												<?= number_to_words($subtotal + $code_unique + $ppn) ?> Rupiah
    											</td>
    										</tr>
    									<?php } ?>
    									<?php if ($subtotal == 0) { ?>
    										<tr>
    											<td>
    												<a href="" style="color: green;" data-toggle="modal" data-target="#Modal<?= $data->invoice ?>"><?= strtoupper(indo_month($data->month)) ?></a>
    											</td>
    											<td style="text-align: center;">
    												<?= $data->year ?>
    											</td>
    											<td>
    												<?php $ppn = $subTotaldetail * ($data->i_ppn / 100) ?>
    												<?php if ($other['code_unique'] == 1) { ?>
    													<?php $code_unique = $data->code_unique ?>
    												<?php } ?>
    												<?php if ($other['code_unique'] == 0) { ?>
    													<?php $code_unique = 0 ?>
    												<?php } ?>
    												<?php if ($data->status == 'SUDAH BAYAR') {  ?>
    													<font style="color: blue;" class="fw-700">Rp. <?= indo_currency($subTotaldetail + $code_unique + $ppn) ?></font>
    												<?php } else {  ?>
    													<font style="color: blue;" class="fw-700">Rp. <?= indo_currency($subTotaldetail + $code_unique + $ppn) ?></font>
    												<?php } ?>
    											</td>
    											<td style="text-align: center;">
    												<?php if ($data->status == 'SUDAH BAYAR') {  ?>
    													<font class="text-green" style="color: green;">SUDAH BAYAR</font>
    												<?php } else {  ?>
    													<font class="text-red" style="color: red;"><?= $data->status ?></font>
    												<?php } ?>
    											</td>
    											<td>
    												<?= number_to_words($subTotaldetail + $code_unique + $ppn) ?> Rupiah
    											</td>
    										</tr>
    									<?php } ?>
    								<?php } ?>
    							</tbody>
    						</table>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    	<?php
		foreach ($myinvoice as $r => $data) { ?>

    		<?php
			$query = "SELECT *
                                    FROM `invoice_detail`                  
                                        WHERE `invoice_detail`.`invoice_id` = $data->invoice  ";
			$querying = $this->db->query($query)->result(); ?>
    		<?php $subtotal = 0;
			foreach ($querying as  $dataa)
				$subtotal += (int) $dataa->total;
			?>
    		<?php
			$month =   $data->month;
			$year = $data->year;
			$no_services = $data->no_services;
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
    		<div class="modal fade" id="Modal<?= $data->invoice ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    			<div class="modal-dialog" role="document">
    				<div class="modal-content">
    					<div class="modal-header">
    						<h5 class="modal-title" id="exampleModalLabel">Periode : <?= indo_month($data->month) ?> <?= $data->year ?></h5>
    						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    							<span aria-hidden="true">&times;</span>
    						</button>
    					</div>
    					<div class="modal-body">
    						<div class="col-lg-12">
    							<div class="box box-widget">
    								<div class="row text-center">
    									<div class="col">No Layanan</div>
    									<div class="col">Status</div>
    								</div>
    								<div class="row text-center mt-1">
    									<div class="col"><b><?= $no_services ?></b></div>
    									<div class="col">
    										<?php if ($data->status == 'SUDAH BAYAR') { ?>
    											<b class="text-green">SUDAH BAYAR</b>
    										<?php } else { ?>
    											<b class="text-red"><?= $data->status ?></b>
    										<?php } ?>
    									</div>
    								</div>
    								<div class="box-body">
    									<div class="row mt-3">
    										<div class="col text-center">
    											<span>Total</span>
    											<!-- KODE UNIK -->
    											<?php if ($other['code_unique'] == 1) { ?>
    												<?php $code_unique = $data->code_unique ?>
    											<?php } ?>
    											<?php if ($other['code_unique'] == 0) { ?>
    												<?php $code_unique = 0 ?>
    											<?php } ?>
    											<!-- END KODE UNIK -->
    											<?php if ($data->status == 'SUDAH BAYAR') {  ?>
    												<?php if ($subtotal <= 0) {  ?>
    													<h3 class="fw-700 text-green"><?= indo_currency($subTotaldetail + $code_unique + $ppn) ?></h3>
    												<?php } ?>
    												<?php if ($subtotal > 0) {  ?>
    													<h3 class="fw-700 text-green"><?= indo_currency($subtotal + $code_unique + $ppn) ?></h3>
    												<?php } ?>
    											<?php } else {  ?>
    												<?php if ($subtotal <= 0) {  ?>
    													<h3 class="fw-700 text-black"><?= indo_currency($subTotaldetail + $code_unique + $ppn) ?></h3>
    												<?php } ?>
    												<?php if ($subtotal > 0) {  ?>
    													<h3 class="fw-700 text-black"><?= indo_currency($subtotal + $code_unique + $ppn) ?></h3>
    												<?php } ?>
    											<?php } ?>


    										</div>
    									</div>
    									<div class="row">
    										<div class="col text-center">
    											<?php
												$month =   $data->month;
												$year = $data->year;
												$no_services = $data->no_services;
												$query = "SELECT *, `invoice_detail`.`price` as detail_price
                            FROM `invoice_detail` 
                            JOIN `package_item` ON `package_item`.`p_item_id` = `invoice_detail`.`item_id`
                                WHERE `invoice_detail`.`d_month` =  $month and
                               `invoice_detail`.`d_year` =  $year and
                               `invoice_detail`.`d_no_services` =  $no_services";
												$queryDetail = $this->db->query($query)->result(); ?>
    											<?php
												$query = "SELECT *, `invoice_detail`.`price` as detail_price
                            FROM `invoice_detail` 
                            JOIN `invoice` ON `invoice`.`invoice`=`invoice_detail`.`invoice_id`
                            JOIN `package_item` ON `package_item`.`p_item_id` = `invoice_detail`.`item_id`
                                WHERE `invoice_detail`.`invoice_id` =  $data->invoice";
												$queryDet = $this->db->query($query)->result(); ?>
    											Rincian Tagihan #<?= $data->invoice ?>
    											<br><br>
    											<?php if ($subtotal == 0) {  ?>
    												<?php foreach ($queryDetail as $dataa) { ?>
    													<div class="row">
    														<div class="col">
    															<?= $dataa->name ?>
    														</div>
    														<div class="col text-right">
    															<?= indo_currency($dataa->detail_price) ?>
    														</div>
    													</div>
    												<?php } ?>


    												<?php $diskon = 0;
													foreach ($queryDetail as  $dataaa)
														$diskon += (int) $dataaa->disc;
													?>

    												<?php if ($diskon != 0) { ?>
    													<div class="row">
    														<div class="col">
    															Diskon
    														</div>
    														<div class="col text-right">
    															<?= indo_currency($diskon) ?>
    														</div>
    													</div>
    													<hr>
    													<div class="row">
    														<div class="col">
    															<b>Sub Total</b>
    														</div>
    														<div class="col text-right">
    															<?php if ($subtotal <= 0) {  ?>
    																<b><?= indo_currency($subTotaldetail) ?></b>
    															<?php } ?>
    															<?php if ($subtotal > 0) {  ?>
    																<b><?= indo_currency($subtotal) ?></b>
    															<?php } ?>
    														</div>
    													</div>
    												<?php } ?>
    												<?php if ($data->i_ppn != 0) { ?>
    													<div class="row">
    														<div class="col">
    															Ppn (<?= $data->i_ppn ?>%)
    														</div>
    														<div class="col text-right">
    															<?= indo_currency($ppn) ?>
    														</div>
    													</div>
    												<?php } ?>
    												<?php if ($other['code_unique'] == 1) { ?>
    													<div class="row">
    														<div class="col">
    															Kode Unik
    														</div>
    														<div class="col text-right">
    															<?= indo_currency($code_unique) ?>
    														</div>
    													</div>
    												<?php } ?>
    											<?php } ?>
    											<?php if ($subtotal != 0) {  ?>
    												<?php foreach ($queryDet as $dataaaa) { ?>
    													<div class="row">
    														<div class="col">
    															<?= $dataaaa->name ?>
    														</div>
    														<div class="col text-right">
    															<?= indo_currency($dataaaa->detail_price) ?>
    														</div>
    													</div>
    												<?php } ?>

    												<?php $diskon = 0;
													foreach ($queryDet as  $dataaa)
														$diskon += (int) $dataaa->disc;
													?>
    												<?php if ($diskon != 0) { ?>
    													<div class="row">
    														<div class="col">
    															Diskon
    														</div>

    														<div class="col text-right">
    															<?= indo_currency($diskon) ?>
    														</div>
    													</div>
    													<hr>
    													<div class="row">
    														<div class="col">
    															<b>Sub Total</b>
    														</div>
    														<div class="col text-right">
    															<?php if ($subtotal <= 0) {  ?>
    																<b><?= indo_currency($subTotaldetail) ?></b>
    															<?php } ?>
    															<?php if ($subtotal > 0) {  ?>
    																<b><?= indo_currency($subtotal) ?></b>
    															<?php } ?>
    														</div>
    													</div>
    												<?php } ?>
    												<?php if ($data->i_ppn != 1) { ?>
    													<div class="row">
    														<div class="col">
    															Ppn (<?= $data->i_ppn ?>) %
    														</div>
    														<div class="col text-right">
    															<?= indo_currency($ppn) ?>
    														</div>
    													</div>
    												<?php } ?>
    												<?php if ($other['code_unique'] == 1) { ?>
    													<div class="row">
    														<div class="col">
    															Kode Unik
    														</div>
    														<div class="col text-right">
    															<?= indo_currency($code_unique) ?>
    														</div>
    													</div>
    												<?php } ?>
    											<?php } ?>
    										</div>
    									</div>
    									<div class="row mt-2">
    										Terbilang : &nbsp;

    										<?php if ($subtotal <= 0) {  ?>
    											<span><em> <?= number_to_words($subTotaldetail + $code_unique + $ppn) ?> Rupiah</em></span>
    										<?php } ?>

    										<?php if ($subtotal > 0) {  ?>
    											<span><em> <?= number_to_words($subtotal + $code_unique + $ppn) ?> Rupiah</em></span>
    										<?php } ?>


    									</div>
    									<?php if ($data->status == 'SUDAH BAYAR') { ?>
    										<div class="row mt-1">
    											<div class="col text-center">
    												<div class="badge badge-success"><a href="<?= site_url('member/invoice/' . $data->invoice) ?>">Invoice</a> </div>
    											</div>
    										</div>
    									<?php } else { ?>
    										<div class="row mt-1">
    											<div class="col text-center">
    												<a href="" data-toggle="modal" data-target="#ModalBayar" class="btn btn-primary">BAYAR</a>
    											</div>
    											<?php $confirm = $this->db->get_where('confirm_payment', ['no_services' => $data->no_services, 'invoice_id' => $data->invoice])->row_array(); ?>

    											<?php if ($confirm != null) { ?>
    												<?php $Customer = $this->db->get_where('customer', ['no_services' => $data->no_services])->row_array(); ?>
    												<?php $link = "https://$_SERVER[HTTP_HOST]"; ?>
    												<a href="https://api.whatsapp.com/send?phone=<?= indo_tlp($company['whatsapp']) ?>&text=*Konfirmasi Pembayaran*  %0ANama Pelanggan : <?= $Customer['name'] ?>  %0ANo Layanan : <?= $data->no_services ?>  %0ANo Invoice : <?= $data->invoice ?>  %0APeriode : <?= indo_month($data->month) ?> <?= $data->year ?>  %0A%0A%0A <?= $link ?>/confirmdetail/<?= $data->invoice ?>" target="blank" class="btn btn-success"><i class="fab fa-whatsapp" style="font-size:15px; color:green"></i>Hubungi Admin</a>
    											<?php } ?>
    											<?php if ($confirm == null) { ?>
    												<div class="col text-center mb-1">
    													<a href="<?= site_url('member/bayartagihan/' . $data->invoice) ?>" class="btn btn-warning">Konfirmasi Pembayaran</a>
    												</div>
    											<?php } ?>
    											<div class="col text-center">
    												<a class="btn btn-danger" href="<?= site_url('member/invoice/' . $data->invoice) ?>">Invoice</a>
    											</div>
    										</div>
    									<?php } ?>

    								</div>
    							</div>
    						</div>
    					</div>

    				</div>
    			</div>
    		</div>
    	<?php } ?>
    	<!-- Modal -->
    	<div class="modal fade" id="ModalBayar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    		<div class="modal-dialog modal-lg">
    			<div class="modal-content">
    				<div class="modal-header">
    					<h5 class="modal-title" id="exampleModalLabel">Cara Pembayaran</h5>
    					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    						<span aria-hidden="true">&times;</span>
    					</button>
    				</div>
    				<div class="modal-body">
    					Silahkan lakukan pembayaran sesuai tagihan anda, pembayaran bisa via Transfer ke rekening berikut;
    					<br> <br>
    					<?php
						foreach ($bank as $r => $data) { ?>
    						<?= $data->name ?> : <?= $data->no_rek ?> A/N <?= $data->owner ?>
    						<br>
    					<?php } ?>
    					<br>
    					<b>Konfirmasi Pembayaran :</b> <br>
    					Email : <?= $company['email'] ?>
    					<br>
    					WA : <?= $company['whatsapp'] ?>
    				</div>
    				<div class="modal-footer">
    					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    					<!-- <button type="button" class="btn btn-success">Konfirmasi Pembayaran</button> -->
    				</div>
    			</div>
    		</div>
    	</div>