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
	<title><?= $title ?> | <?= $company['company_name'] ?></title>
	<link rel="shortcut icon" href="<?= site_url('assets/images/favicon.png') ?>" sizes="16x16" type="image/png">
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css'>
	<link rel="stylesheet" href="<?= site_url() ?>/login/style.css">
	<?php if ($company['nama_singkat'] == '@Boss.Net') { ?>
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
			<form class="user" method="post" action="<?= site_url('user/register') ?>">
				<div class="controls">
					<input style="margin-top: 10px;" type="text" class="form-control form-control-user" id="name" name="name" placeholder="Nama Lengkap" value="<?= set_value('name') ?>">
					<input style="margin-top: 10px;" type="text" class="form-control form-control-user" id="Email" name="email" placeholder="Alamat Email" value="<?= set_value('email') ?>">
					<select style="margin-top: 10px;" name="role_id" id="role_id" class="form-control" required>
						<option value="">- Pilih Hak Akses -</option>
						<option value="1">Admin / Owner</option>
						<option value="2">Member PPPOE</option>
						<option value="3">Member HOTSPOT</option>
						<option value="4">Reseller HOTSPOT</option>
						<option value="5">Sales PPPOE</option>
						<option value="6">Operator Jaringan</option>
						<option value="7">Customer Service</option>
						<option value="8">Teknisi / Karyawan</option>
						<option value="9">Member PREMIUM</option>
						<option value="10">Bill Collector</option>
					</select>
					<input style="margin-top: 10px;" type="password" class="form-control form-control-user" id="Password1" name="password1" placeholder="Masukkan Password">
					<input style="margin-top: 10px;" type="password" class="form-control form-control-user" id="Password2" name="password2" placeholder="Konfirmasi Password">
					<button style="margin-top: 10px;" type="submit" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?> btn-user btn-block">Simpan</button>
				</div>
			</form>
			<br>
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
	</div>
	<div id="particles-js"></div>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css'></script>
	<script src='https://code.jquery.com/jquery-1.11.1.min.js'></script>
	<script src="<?= site_url() ?>/login/script.js"></script>
</body>

</html>