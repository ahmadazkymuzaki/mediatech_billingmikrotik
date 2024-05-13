<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="<?= $company['about']; ?>">
	<meta name="author" content="<?= $company['owner']; ?>">
	<meta name="title" content="<?= $company['company_name']; ?>">
	<meta name="keywords" content="<?= $company['keyword']; ?>">
	<meta http-equiv="refresh" content="<?= $company['refresh']; ?>">

	<title><?= $title ?> | <?= $company['company_name'] ?></title>
	<link rel="shortcut icon" href="<?= site_url('assets/images/favicon.png') ?>" sizes="16x16" type="image/png">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="https://files.billing.or.id/assets/backend/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body>
	<div class="row">
		<?php $no = 1;
		foreach ($hotspotuser as $dataku) { ?>
			<div class="col-3 text-center">
				<table class="table" style="border: 1px solid black;">
					<tr>
						<td colspan="2">
							<img src="<?= site_url('assets/images/' . $company['logo']) ?>" style="height:50px;">
						</td>
					</tr>
					<tr style="height: 20px;">
						<td colspan="2" style="border: 1px solid black;" style="height: 20px;">
							Kode Voucher : <b><?= $no++; ?></b>
						</td>
					</tr>
					<tr>
						<td>
							Username
						</td>
						<td>
							Password
						</td>
					</tr>
					<tr>
						<td style="border: 1px solid black;">
							<b><?= $dataku['name'] ?></b>
						</td>
						<td style="border: 1px solid black;">
							<b><?= $dataku['password'] ?></b>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							Login : <b>http://<?= $dnsname; ?></b>
						</td>
					</tr>
				</table>
			</div>
		<?php } ?>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://files.billing.or.id/assets/backend/js/bootstrap-select.js"></script>
	<script src="https://files.billing.or.id/assets/backend/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<style type="text/css" media="print">
		@page {
			size: a4 portrait;
		}
	</style>
	<script>
		window.print();
	</script>
</body>

</html>