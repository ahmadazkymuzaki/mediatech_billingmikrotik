<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="robots" content="noindex, nofollow">
	<title>@Boss.Net - Payment Gateway</title>
	<meta name="author" content="TriPay">
	<link rel="shortcut icon" type="ico/png" href="https://tripay.co.id/images/favicon.png">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.css">
	<link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
	<style>
		.lds-dual-ring {
			display: inline-block;
			width: 80px;
			height: 80px;
		}

		.lds-dual-ring:after {
			content: " ";
			display: block;
			width: 64px;
			height: 64px;
			margin: 8px;
			border-radius: 50%;
			border: 6px solid #fff;
			border-color: #fff transparent #fff transparent;
			animation: lds-dual-ring 1.2s linear infinite;
		}

		@keyframes lds-dual-ring {
			0% {
				transform: rotate(0deg);
			}

			100% {
				transform: rotate(360deg);
			}
		}

		.bg {
			/* The image used */
			background-image: url("image/grass.jpg");

		}

		#bg {
			position: fixed;
			top: 0;
			left: 0;

			/* Preserve aspet ratio */
			min-width: 100%;
			min-height: 100%;
			z-index: -1;
		}

		.logo img {
			height: 40px;
			width: auto;
			margin-left: auto;
			margin-right: auto;
			display: block;
		}

		.box-shape {
			background-color: #fff;
			border-radius: 8px;
			margin-top: 2rem;
			margin-bottom: 2rem;
		}

		.payment__logo img,
		.merchant__logo img {
			height: 40px;
			width: auto;
		}

		.payment__title {
			font-size: 16px;
			font-weight: 600;
			color: #707070;
			text-align: center;
			margin-top: 3rem;
			margin-bottom: 1rem;
		}

		.payment__infoTitle {
			font-size: 14px;
			color: #98A3B2;
		}

		.payment__infoSubtitle {
			font-size: 15px;
			color: #2C4656;
			font-weight: 600;
		}

		.payment__expired {
			font-size: 18px;
			color: #FF5A92;
			font-weight: 600;
		}

		.icon-copy {
			cursor: pointer;
		}


		/* Payment */

		.box-payment {
			box-shadow: 0px 8px 16px 0px rgba(132, 132, 132, 0.16);
			-webkit-box-shadow: 0px 8px 16px 0px rgba(132, 132, 132, 0.16);
			-moz-box-shadow: 0px 8px 16px 0px rgba(132, 132, 132, 0.16);
			border-radius: 25px;
			background-color: #fff;
		}

		.title-payment {
			color: #394654;
			font-size: 22px;
			font-weight: bold;
		}

		.sub-title-payment {
			color: #707070;
			font-size: 16px;
			font-weight: 400;
		}

		.title-detail {
			color: #394654;
			font-size: 14px;
			font-weight: bold;
		}

		.title-detail-2 {
			color: #394654;
			font-size: 16px;
			font-weight: 400;
			opacity: 0.8;
		}

		.icon-copy {
			cursor: pointer;
			color: #ced4da;
		}

		.button-green {
			background-color: #25D366;
			color: #fff;
			border: none;
		}

		.button-green:hover {
			background-color: rgb(31, 196, 91);
			color: #fff;
			border: none;
		}


		.list-petunjuk-pembayaran {
			max-width: 500px;
			counter-reset: my-awesome-counter;
			list-style: none;
		}

		.list-petunjuk-pembayaran li {
			margin: 0 0 0.5rem 0;
			counter-increment: my-awesome-counter;
			position: relative;
		}

		.list-petunjuk-pembayaran li::before {
			content: counter(my-awesome-counter);
			color: white;
			position: absolute;
			font-size: 12px;
			--size: 20px;
			left: calc(-1 * var(--size) - 10px);
			line-height: var(--size);
			width: var(--size);
			height: var(--size);

			top: 0;
			border-radius: 50%;
			text-align: center;
			background: #d6d6d6;
		}

		.custom-accordion .card,
		.custom-accordion .card:last-child .card-header {
			border: none;
		}

		.custom-accordion .card-header {
			border-bottom-color: #EDEFF0;
			background: transparent;
		}

		.custom-accordion .fa-stack {
			font-size: 18px;
		}

		.custom-accordion li+li {
			margin-top: 10px;
		}

		.title-pembayaran {
			font-size: 16px;
			color: #394654;
			font-weight: 600;
		}

		.panel-title {
			color: #394654;
			opacity: 0.8;
		}

		.panel-title:hover {
			color: #394654;
			opacity: 0.8;
		}

		.panel-title::after {
			content: "\f107";
			color: #fff !important;
			top: 13px;
			right: 20px;
			position: absolute;
			font-family: "Font Awesome 5 Free";
			font-weight: 800;
		}

		.panel-title[aria-expanded="true"]::after {
			content: "\f106";
		}

		.background-payment {
			background-color: red;
		}

		@media screen and (max-width: 768px) {
			.payment__title {
				font-size: 14px;
			}

			.payment__infoTitle {
				font-size: 12px;
			}

			.payment__infoSubtitle {
				font-size: 14px;
			}

			.payment__expired {
				font-size: 14px;
			}

			.padding-mobile {
				padding: 20px !important;
			}

			.box-payment {
				box-shadow: 0px 6px 24px 0px rgba(0, 0, 0, 0.16);
				-webkit-box-shadow: 0px 6px 24px 0px rgba(0, 0, 0, 0.16);
				-moz-box-shadow: 0px 6px 24px 0px rgba(0, 0, 0, 0.16);
				border-radius: 15px;
				background-color: #fff;
			}

			.title-payment {
				color: #394654;
				font-size: 18px;
				font-weight: bold;
			}

			.sub-title-payment {
				color: #707070;
				font-size: 14px;
				font-weight: 400;
			}

			.custom-img-bank-mobile>img {
				width: auto !important;
				height: 2px !important;
			}

			.title-pembayaran {
				font-size: 16px;
				color: #394654;
				font-weight: 600;
			}

			.padding-modal-body-mobile {
				padding-left: 0.5rem !important;
			}

			.custom-padding-accordion>.card-header {
				padding-left: 0 !important;
			}

			.custom-padding-accordion-2>.card-body {
				padding-left: 0 !important;
			}
		}

		@media screen and (min-width: 768px) {
			.payment-info {
				box-shadow: 0px 0px 3px 2px #ddd;
				padding: 15px !important;
			}
		}

		.payment-instruction-head {
			background: #17a2b8 !important;
			padding: 5px 1.25rem !important;
		}

		.payment-instruction-head>h5>span {
			font-size: 16px !important;
			font-weight: bold !important;
			color: #fff !important;
		}

		.section-icon {
			display: block;
			background: #1b5724;
			color: #fff;
			text-align: center;
			width: 4em;
			height: 4em;
			-webkit-border-radius: 30em;
			border-radius: 30em;
			position: absolute;
			top: -2.1em;
			left: 50%;
			margin-left: -2em;
			line-height: 4.8em;
		}

		.section-icon.danger {
			background: #ac3430;
		}

		.fz-14 {
			font-size: 14px !important;
		}
	</style>
</head>

<body class="" style="">
	<img src="https://tripay.co.id/images/grass.jpg" id="bg" alt="">
	<div class="container pt-4 pb-4">
		<div class="row">
			<div class="col-lg-8 col-12 mx-auto">
				<div class="box-shape pl-lg-5 pr-lg-5 pt-lg-4 pb-lg-4 p-3">
					<div class="payment__logo float-left mt-1">
						<a target="_blank" href="http://app.ayenkmarley.my.id/naufal/member/history">
							<img src="https://assets.tripay.co.id/upload/merchant-logo/T9611515Z0hmESpLJAung.png" style="height: 40px;width: auto;">
						</a>
					</div>
					<?php if ($methodPayment == 'E-Wallet LinkAja') { ?>
						<div class="merchant__logo text-right mt-1">
							<img src="<?= site_url('assets/images/linkaja.svg') ?>" style="border-radius: 10%">
						</div>
					<?php } elseif ($methodPayment == 'E-Wallet DANA') { ?>
						<div class="merchant__logo text-right mt-1">
							<img src="<?= site_url('assets/images/dana.svg') ?>" style="border-radius: 10%">
						</div>
					<?php } elseif ($methodPayment == 'E-Wallet GOPAY') { ?>
						<div class="merchant__logo text-right mt-1">
							<img src="<?= site_url('assets/images/gopay.png') ?>" style="border-radius: 10%">
						</div>
					<?php } elseif ($methodPayment == 'E-Wallet OVO') { ?>
						<div class="merchant__logo text-right mt-1">
							<img src="<?= site_url('assets/images/ovo.jpg') ?>" style="border-radius: 10%">
						</div>
					<?php } elseif ($methodPayment == 'E-Wallet DOKU') { ?>
						<div class="merchant__logo text-right mt-1">
							<img src="<?= site_url('assets/images/doku.png') ?>" style="border-radius: 10%">
						</div>
					<?php } elseif ($methodPayment == 'E-Wallet SHOPEE') { ?>
						<div class="merchant__logo text-right mt-1">
							<img src="<?= site_url('assets/images/shopee.png') ?>" style="border-radius: 10%">
						</div>
					<?php } elseif ($methodPayment == 'E-Wallet SAKUKU') { ?>
						<div class="merchant__logo text-right mt-1">
							<img src="<?= site_url('assets/images/sakuku.png') ?>" style="border-radius: 10%">
						</div>
					<?php } elseif ($methodPayment == 'Transfer Bank BRI') { ?>
						<div class="merchant__logo text-right mt-1">
							<img src="<?= site_url('assets/images/bri.png') ?>" style="border-radius: 10%">
						</div>
					<?php } elseif ($methodPayment == 'Transfer Bank BCA') { ?>
						<div class="merchant__logo text-right mt-1">
							<img src="<?= site_url('assets/images/bca.png') ?>" style="border-radius: 10%">
						</div>
					<?php } elseif ($methodPayment == 'Transfer Bank BNI') { ?>
						<div class="merchant__logo text-right mt-1">
							<img src="<?= site_url('assets/images/bni.png') ?>" style="border-radius: 10%">
						</div>
					<?php } elseif ($methodPayment == 'Transfer Bank BPRS') { ?>
						<div class="merchant__logo text-right mt-1">
							<img src="<?= site_url('assets/images/bprs.png') ?>" style="border-radius: 10%">
						</div>
					<?php } elseif ($methodPayment == 'Transfer Bank NEO') { ?>
						<div class="merchant__logo text-right mt-1">
							<img src="<?= site_url('assets/images/neo.png') ?>" style="border-radius: 10%">
						</div>
					<?php } elseif ($methodPayment == 'Transfer Bank SEA') { ?>
						<div class="merchant__logo text-right mt-1">
							<img src="<?= site_url('assets/images/sea.jpg') ?>" style="border-radius: 10%">
						</div>
					<?php } else { ?>
						<div class="merchant__logo text-right mt-1">
							<img src="<?= site_url('assets/images/payment.svg') ?>" style="border-radius: 10%">
						</div>
					<?php } ?>
					<div class="payment__title" style="margin-top: 20px;">
						<h5><b><?= $methodPayment ?></b></h5>
						Pastikan anda melakukan pembayaran sebelum melewati batas
						akhir pembayaran dan dengan nominal yang tepat / sesuai di
						kolom <b>Jumlah Nominal Tagihan</b> dibawah ini !
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-6 col-xs-6 col-6">
									<div class="mb-3">
										<div class="payment__infoTitle">
											Nama Perusahaan
										</div>
										<div class="payment__infoSubtitle">
											<?= $company['company_name'] ?>
										</div>
									</div>
									<div class="mb-3">
										<div class="payment__infoTitle">
											Nama Pelanggan
										</div>
										<div class="payment__infoSubtitle">
											<?= $customerName ?>
										</div>
									</div>
									<div class="mb-3">
										<div class="payment__infoTitle">
											Email Pelanggan
										</div>
										<div class="payment__infoSubtitle">
											<?= $customerEmail ?>
										</div>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-6 col-xs-6 col-6">
									<div class="mb-3">
										<div class="payment__infoTitle">
											Nomor Layanan
										</div>
										<div class="payment__infoSubtitle">
											<?= $no_services ?>
										</div>
									</div>
									<div class="mb-3">
										<div class="payment__infoTitle">
											Telepon Pelanggan
										</div>
										<div class="payment__infoSubtitle">
											<?= $customerPhone ?>
										</div>
									</div>
									<div class="mb-3">
										<div class="payment__infoTitle">
											Paket Pelanggan
										</div>
										<div class="payment__infoSubtitle">
											<?= $productName ?>
										</div>
									</div>
								</div>
							</div>
							<a href="<?= site_url('bill/printinvoicethermal/' . $no_invoice) ?>" target="_blank" class="btn btn-primary form-control waves-effect waves-light mb-2" type="button">
								<span class="left fa fa-print fz-20 m-r-15"></span>
								<span class="left fz-14">Cetak Invoice / Faktur<span id="auto-redirect"></span></span>
							</a>
							<div class="row mb-2">
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 pb-2">
									<a href="<?= site_url('member/history') ?>" target="_blank" class="btn btn-info form-control" type="button">
										<span class="left fa fa-arrow-left fz-20 m-r-15"></span>
										<span class="left fz-14">Kembali<span id="auto-redirect"></span></span>
									</a>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 pb-2">
									<button class="btn btn btn-success form-control" id="payment_instruction_button" data-toggle="modal" data-target="#cara_bayar">
										Cara Bayar
									</button>
								</div>
							</div>
						</div>
						<div class="col-lg-6 payment-info" style="height: fit-content;">
							<div class="mb-3">
								<div class="payment__infoTitle">
									Nomor Invoice / Faktur
								</div>
								<div class="payment__infoSubtitle">
									<div class="input-group pt-1">
										<input type="text" class="form-control border-right-0" id="noReferensi" i="" data-toggle="tooltip" title="" value="<?= $no_invoice ?>" aria-describedby="inputGroupPrepend" disabled="" readonly="" style="background: #fff" data-original-title="Berhasil menyalin teks">
										<div class="input-group-prepend">
											<span class="input-group-text bg-white border-left-0">
												<i class="zmdi zmdi-copy zmdi-hc-lg icon-copy" data-toggle="tooltip" data-placement="top" title="" onclick="copy('<?= $no_invoice ?>')" data-original-title="Salin"></i>
											</span>
										</div>
									</div>
								</div>
							</div>
							<?php if ($methodPayment == 'Bayar Tunai ke Reseller') { ?>
								<div class="mb-3">
									<div class="payment__infoTitle">
										Wilayah (Kode Wilayah)
									</div>
									<div class="payment__infoSubtitle">
										<div class="input-group pt-1">
											<input type="text" class="form-control border-right-0" id="noVA" i="" data-toggle="tooltip" title="" value="<?= $resellerAddress . ' (' . $resellerKode . ')' ?>" aria-describedby="inputGroupPrepend" disabled="" readonly="" style="background: #fff" data-original-title="Berhasil menyalin teks">
											<div class="input-group-prepend">
												<span class="input-group-text bg-white border-left-0">
													<i class="zmdi zmdi-copy zmdi-hc-lg icon-copy" data-toggle="tooltip" data-placement="top" title="" onclick="copy('<?= $resellerAddress ?>')" data-original-title="Salin"></i>
												</span>
											</div>
										</div>
									</div>
								</div>
								<div class="mb-3">
									<div class="payment__infoTitle">
										Nama Reseller / Penerima
									</div>
									<div class="payment__infoSubtitle">
										<div class="input-group pt-1">
											<input type="text" class="form-control border-right-0" id="noVA" i="" data-toggle="tooltip" title="" value="<?= $resellerName ?>" aria-describedby="inputGroupPrepend" disabled="" readonly="" style="background: #fff" data-original-title="Berhasil menyalin teks">
											<div class="input-group-prepend">
												<span class="input-group-text bg-white border-left-0">
													<i class="zmdi zmdi-copy zmdi-hc-lg icon-copy" data-toggle="tooltip" data-placement="top" title="" onclick="copy('<?= $resellerName ?>')" data-original-title="Salin"></i>
												</span>
											</div>
										</div>
									</div>
								</div>
							<?php } else { ?>
								<div class="mb-3">
									<div class="payment__infoTitle">
										No. Rek / ID / Username
									</div>
									<div class="payment__infoSubtitle">
										<div class="input-group pt-1">
											<input type="text" class="form-control border-right-0" id="noVA" i="" data-toggle="tooltip" title="" value="<?= $bankNoRek ?>" aria-describedby="inputGroupPrepend" disabled="" readonly="" style="background: #fff" data-original-title="Berhasil menyalin teks">
											<div class="input-group-prepend">
												<span class="input-group-text bg-white border-left-0">
													<i class="zmdi zmdi-copy zmdi-hc-lg icon-copy" data-toggle="tooltip" data-placement="top" title="" onclick="copy('<?= $bankNoRek ?>')" data-original-title="Salin"></i>
												</span>
											</div>
										</div>
									</div>
								</div>
								<div class="mb-3">
									<div class="payment__infoTitle">
										Atas Nama / Penerima
									</div>
									<div class="payment__infoSubtitle">
										<div class="input-group pt-1">
											<input type="text" class="form-control border-right-0" id="noVA" i="" data-toggle="tooltip" title="" value="<?= $bankOwner ?>" aria-describedby="inputGroupPrepend" disabled="" readonly="" style="background: #fff" data-original-title="Berhasil menyalin teks">
											<div class="input-group-prepend">
												<span class="input-group-text bg-white border-left-0">
													<i class="zmdi zmdi-copy zmdi-hc-lg icon-copy" data-toggle="tooltip" data-placement="top" title="" onclick="copy('<?= $bankOwner ?>')" data-original-title="Salin"></i>
												</span>
											</div>
										</div>
									</div>
								</div>
							<?php } ?>
							<div class="mb-3">
								<div class="payment__infoTitle">
									Jumlah Nominal Tagihan
								</div>
								<div class="payment__infoSubtitle">
									<div class="input-group pt-1">
										<input type="text" class="form-control border-right-0" id="jumTagihan" i="" data-toggle="tooltip" title="" value="Rp. <?= indo_currency($nominal) ?>" aria-describedby="inputGroupPrepend" disabled="" readonly="" style="background: #fff" data-original-title="Berhasil menyalin teks">
										<div class="input-group-prepend">
											<span class="input-group-text bg-white border-left-0">
												<i class="zmdi zmdi-copy zmdi-hc-lg icon-copy" data-toggle="tooltip" data-placement="top" title="" onclick="copy('<?= $nominal ?>')" data-original-title="Salin"></i>
											</span>
										</div>
									</div>
								</div>
							</div>
							<div class="mb-3 text-center">
								<div class="payment__infoTitle">
									Batas Akhir Pembayaran :
								</div>
								<div class="payment__expired">
									<?= $paytime ?><br><small class="font-weight-bold" style="color: #17a2b8;">Jatuh Tempo : <?= $jatuhtempo ?></small>
								</div>
							</div>
						</div>
					</div>

					<div class="d-flex" style="margin-top: -50px;">
						<div class="m-auto pb-2" style="margin-top: 55px !important;font-size: 14px;">
							Secure Payment by <a href="https://tripay.co.id" target="_blank"><img src="https://assets.tripay.co.id/upload/merchant-logo/T9611515Z0hmESpLJAung.png" style="height:20px;margin-left: 7px; margin-top: -3px;" alt="TriPay"></a>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	<div class="modal fade lg" id="cara_bayar" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<div class="modal-title" id="cara_bayar_title">
						<div class="d-flex flex-row">
							<div class="d-flex align-items-center">
								<img src="<?= site_url('assets/images/payment.svg') ?>" style="border-radius: 10%" width="auto" height="20px">
							</div>
							<div class="ml-3 title-pembayaran">
								Petunjuk Pembayaran <?= $methodPayment ?>
							</div>
						</div>
					</div>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body pt-0 pr-0 pl-0 mt-0">
					<div id="payment-modal" class="custom-accordion">
						<div class="card custom-padding-accordion">
							<div class="card-header payment-instruction-head" id="payment-instruction-head-0">
								<h5 class="mb-0">
									<span class="btn collaped panel-title collapsed" data-toggle="collapse" data-target="#payment-instruction-collapse-0" aria-expanded="false" aria-controls="payment-instruction-collapse-0">
										Petunjuk Umum
									</span>
								</h5>
							</div>
							<div id="payment-instruction-collapse-0" class="custom-padding-accordion-2 collapse show" aria-labelledby="payment-instruction-head-0" data-parent="#payment-modal" style="">
								<div class="card-body">
									<ol class="list-petunjuk-pembayaran">
										<li>Transfer ke <?= $bankNoRek ?></li>
									</ol>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://cekmutasi.co.id/component/jquery-ui/js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="https://cekmutasi.co.id/component/jquery-ui/js/jquery.blockUI.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
</body>

</html>