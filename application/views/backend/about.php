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
<div class="col-lg-12">
	<div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-2">
		<div class="row">
			<div class="col-lg-12">
				<div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-2">
					<div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header ">
						<h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>"><i class="fa fa-info-circle" style="font-size: 24px"> About Us</i></h6>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<div class="card-body">
								<img src="<?= site_url('assets/images/bung.png') ?>" style=" display: block;margin-left: auto;margin-right: auto;width: 100%;" alt="">
							</div>
						</div>
						<div class="col-lg-4">
							<div class="container">
								<div class="row mt-2">
									<div class="col-12">
										<table style="font-size: 13px;">
											<tbody>
												<tr>
													<td><br>&nbsp;&nbsp;&nbsp; Founder APP</td>
													<td><br>&nbsp;:&nbsp; </td>
													<td><br>Ahmad Azky Muzaki</td>
												</tr>
												<tr>
													<td>&nbsp;&nbsp;&nbsp; Birth In</td>
													<td>&nbsp;:&nbsp; </td>
													<td>Banyumas, November 2005</td>
												</tr>
												<tr>
													<td>&nbsp;&nbsp;&nbsp; Education</td>
													<td>&nbsp;:&nbsp; </td>
													<td>Tamat SMK N Jateng</td>
												</tr>
												<!-- <tr>
														<td>&nbsp;&nbsp;&nbsp; Profession</td>
														<td>&nbsp;:&nbsp; </td>
														<td>Kepala Staff Teknisi Jaringan</td>
													</tr>
													<tr>
														<td>&nbsp;&nbsp;&nbsp; Experience</td>
														<td>&nbsp;:&nbsp; </td>
														<td>Designer Baliano DP (2019)</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td>&nbsp;</td>
														<td>Marketing Bintank Cell (2016)</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td>&nbsp;</td>
														<td>Guru MTs Swst (2017-2018)</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td>&nbsp;</td>
														<td>Guru SMK Swst (2018-2019)</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td>&nbsp;</td>
														<td>Barista Hitam Putih (2018)</td>
													</tr>
													<tr>
														<td>&nbsp;&nbsp;&nbsp; Skill on WEB</td>
														<td>&nbsp;:&nbsp; </td>
														<td>Developer (IT Programmer)</td>
													</tr> -->
												<tr>
													<td>&nbsp;&nbsp;&nbsp; Address</td>
													<td>&nbsp;:&nbsp; </td>
													<td>Jalan Masjid Kaliontong, Desa Kalisalak</td>
												</tr>
												<tr>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													<td>Kecamatan Kebasen</td>
												</tr>
												<tr>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													<td>Kabupaten Banyumas</td>
												</tr>
												<tr>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													<td>Jawa Tengah</td>
												</tr>
												<tr>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													<td>Indonesia (POS : 53172)</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="container">
								<div class="row mt-2">
									<div class="col-12">
										<table style="font-size: 13px;">
											<tbody>
												<tr>
													<td><br>&nbsp;&nbsp;&nbsp; Demo APP</td>
													<td><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
													<td><br><a href="demo.mediatechhost.my.id" target="_blank">demo.mediatechhost.my.id</a></td>
												</tr>
												<tr>
													<td>&nbsp;&nbsp;&nbsp; Telepon</td>
													<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
													<td><a href="tel:+6285225849110" target="_blank">6285225849110</a></td>
												</tr>
												<tr>
													<td>&nbsp;&nbsp;&nbsp; E-Mail</td>
													<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
													<td><a href="mailto:ahmadazkymuzaki123@gmail.com" target="_blank">ahmadazkymuzaki123@gmail.com</a></td>
												</tr>
												<tr>
													<td>&nbsp;&nbsp;&nbsp; Whatsapp</td>
													<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
													<td><a href="https://wa.me/6285225849110" target="_blank">6285225849110 (chat only)</a></td>
												</tr>
												<tr>
													<td>&nbsp;&nbsp;&nbsp; Facebook</td>
													<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
													<td><a href="https://www.facebook.com/ahmadazkymuzaki" target="_blank">Ahmad Azky Muzaki</a></td>
												</tr>
												<tr>
													<td>&nbsp;&nbsp;&nbsp; Instagram</td>
													<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
													<td><a href="https://www.instagram.com/ahmadazkymuzaki" target="_blank">Ahmad Azky Muzaki</a></td>
												</tr>
												<tr>
													<td>&nbsp;&nbsp;&nbsp; Twitter</td>
													<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
													<td><a href="https://www.twitter.com/ahmadazkymuzaki" target="_blank">Ahmad Azky Muzaki</a></td>
												</tr>
												<tr>
													<td>&nbsp;&nbsp;&nbsp; Telegram</td>
													<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
													<td><a href="https://t.me/ahmadazkymuzaki" target="_blank">Ahmad Azky Muzaki</a></td>
												</tr>
												<tr>
													<td>&nbsp;&nbsp;&nbsp; YouTube</td>
													<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
													<td><a href="https://www.youtube.com/channel/ahmadazkymuzaki" target="_blank">Ahmad Azky Muzaki</a></td>
												</tr>
												<tr>
													<td>&nbsp;&nbsp;&nbsp; Website</td>
													<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
													<td><a href="https://mediatechhost.my.id" target="_blank">www.mediatechhost.my.id</a></td>
												</tr>
												<!-- <tr>
														<td>&nbsp;&nbsp;&nbsp; Github</td>
														<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
														<td><a href="https://www.github.com/ayenkmarley28" target="_blank">github.com/ayenkmarley28</a></td>
													</tr>
													<tr>
														<td>&nbsp;&nbsp;&nbsp; Fanspage</td>
														<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
														<td><a href="https://www.facebook.com/ispnaufalid" target="_blank">facebook.com/ispnaufalid</a></td>
													</tr>
													<tr>
														<td>&nbsp;&nbsp;&nbsp; Pinterest</td>
														<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
														<td><a href="https://id.pinterest.com/ayenkmarley" target="_blank">pinterest.com/ayenkmarley</a></td>
													</tr>
													<tr>
														<td>&nbsp;&nbsp;&nbsp; LinkedIn</td>
														<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
														<td><a href="https://www.linkedin.com/in/ahmad-zulkarnain-al-farisi-44926b112" target="_blank">al-farisi-44926b112</a></td>
													</tr> -->
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<!-- <div class="col-lg-12">
                            <div class="container">
                                <br><center  style="font-size: 22px;"><b><i>Bagi yang ingin donasi silahkan ke rekening atau dompet digital kami berikut ini :</i></b></center><br>
                                <div class="row mt-2">
                                    <div class="col-12">
										<div class="table-responsive">
											<table class="table table-bordered" id="tablebt" width="100%" cellspacing="0">
												<thead>
													<tr style="text-align: center;">
														<th>No</th>
														<th>Pembayaran</th>
														<th>Rekening</th>
														<th>Atas Nama</th>
													</tr>
												</thead>
												<tbody>
												<?php $no = 1; ?>
													<tr>
														<th style="text-align: center;" width="5%"><?= $no++; ?></th>
														<td>Transfer Bank BRI</td>
														<td style="text-align: center;">6545 01 011 229 53 2</td>
														<td style="text-align: center;">St. Fatima</td>
													</tr>
													<tr>
														<th style="text-align: center;" width="5%"><?= $no++; ?></th>
														<td>Transfer Shopee-Pay</td>
														<td style="text-align: center;">sumenep_shop</td>
														<td style="text-align: center;">Ahmad Zulkarnain Al Farisi</td>
													</tr>
													<tr>
														<th style="text-align: center;" width="5%"><?= $no++; ?></th>
														<td>Transfer Pulsa T-Sel</td>
														<td style="text-align: center;">085334748768</td>
														<td style="text-align: center;">Ahmad Zulkarnain Al Farisi</td>
													</tr>
													<tr>
														<th style="text-align: center;" width="5%"><?= $no++; ?></th>
														<td>Dompet Digital DO-KU</td>
														<td style="text-align: center;">1018748768 (ID)</td>
														<td style="text-align: center;">Ahmad Zulkarnain Al Farisi</td>
													</tr>
													<tr>
														<th style="text-align: center;" width="5%"><?= $no++; ?></th>
														<td>Dompet Digital T-Money</td>
														<td style="text-align: center;">085334748768</td>
														<td style="text-align: center;">Ahmad Zulkarnain Al Farisi</td>
													</tr>
													<tr>
														<th style="text-align: center;" width="5%"><?= $no++; ?></th>
														<td>Dompet Digital OVO</td>
														<td style="text-align: center;">085334748768</td>
														<td style="text-align: center;">Ahmad Zulkarnain Al Farisi</td>
													</tr>
													<tr>
														<th style="text-align: center;" width="5%"><?= $no++; ?></th>
														<td>Dompet Digital DANA</td>
														<td style="text-align: center;">085334748768</td>
														<td style="text-align: center;">Ahmad Zulkarnain Al Farisi</td>
													</tr>
													<tr>
														<th style="text-align: center;" width="5%"><?= $no++; ?></th>
														<td>Dompet Digital LinkAJa</td>
														<td style="text-align: center;">085334748768</td>
														<td style="text-align: center;">Ahmad Zulkarnain Al Farisi</td>
													</tr>
													<tr>
														<th style="text-align: center;" width="5%"><?= $no++; ?></th>
														<td>Dompet Digital GO-Pay</td>
														<td style="text-align: center;">085334748768</td>
														<td style="text-align: center;">Ahmad Zulkarnain Al Farisi</td>
													</tr>
													<tr>
														<th style="text-align: center;" width="5%"><?= $no++; ?></th>
														<td>Dompet Digital PayPal</td>
														<td style="text-align: center;">paypal.me/ayenkmarley28</td>
														<td style="text-align: center;">Ahmad Zulkarnain Al Farisi</td>
													</tr>
												</tbody>
											</table>
										</div>
                                    </div>
                                </div>
								<br>
                            </div>
                        </div> -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--End of Tawk.to Script-->