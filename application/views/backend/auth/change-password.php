<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="<?= $company['about']; ?>">
	<meta name="author" content="<?= $company['owner']; ?>">
	<meta name="title" content="<?= $company['company_name']; ?>">
	<meta name="keywords" content="<?= $company['keyword']; ?>">
	<meta http-equiv="refresh" content="<?= $company['refresh']; ?>">
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css'>
	<link rel="stylesheet" href="https://files.billing.or.id/login/style.css">
	<title><?= $title ?> | <?= $company['company_name'] ?></title>
	<link rel="shortcut icon" href="<?= site_url('assets/images/favicon.png') ?>" sizes="16x16" type="image/png">
	<?php if ($company['company_name'] == '@Boss.Net') { ?>
		<style>
			/* width */
			::-webkit-scrollbar {
				width: 10px;
			}

			/* Track */
			::-webkit-scrollbar-track {
				background: #f1f1f1;
			}

			/* Handle */
			::-webkit-scrollbar-thumb {
				background: #ff0000;
			}

			/* Handle on hover */
			::-webkit-scrollbar-thumb:hover {
				background: #ff0000;
			}
		</style>
	<?php } else { ?>
		<style>
			/* width */
			::-webkit-scrollbar {
				width: 10px;
			}

			/* Track */
			::-webkit-scrollbar-track {
				background: #f1f1f1;
			}

			/* Handle */
			::-webkit-scrollbar-thumb {
				background: #808080;
			}

			/* Handle on hover */
			::-webkit-scrollbar-thumb:hover {
				background: #808080;
			}
		</style>
	<?php } ?>
</head>

<body>
	<div class="container">
		<div id="login-box">
			<div class="logo" style="margin-top: 10px;">
				<img src="<?= site_url('assets/images/') ?><?= $company['logo'] ?>" alt="Logo Perusahaan" class="img img-responsive center-block" />
			</div>
			<h5 class=" mb-2 mt-2"><?= $this->session->userdata('reset_email'); ?></h5>
			<form action="" method="post" class="user">
				<div class="controls">
					<input type="password" name="password1" id="password1" placeholder="Masukkan Password Baru" class="form-control" />
					<input style="margin-top: 10px;" type="password" name="password2" id="password2" placeholder="Ulangi Password Baru" class="form-control mt-1" />
					<button style="margin-top: 10px; font-weight: bold;" type="submit" class="btn btn-info btn-block"> P E R B A R U I </button>
				</div>
			</form>
			<a style="margin-top: 10px; text-decoration: none;" class="small" href="<?= site_url('auth') ?>">
				<button style="margin-top: 10px; font-weight: bold;" type="buttton" class="btn btn-success btn-block"> M A S U K</button>
			</a>
		</div>
	</div>
	<div id="particles-js"></div>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css'></script>
	<script src='https://code.jquery.com/jquery-1.11.1.min.js'></script>
	<script src="https://files.billing.or.id/login/script.js"></script>
</body>

</html>