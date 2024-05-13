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
			<?php echo form_open_multipart('auth/register') ?>
			<div class="controls">
				<input type="hidden" name="no_services" id="no_services" value="<?= date('ymdHis') ?>">
				<input type="hidden" name="c_status" id="c_status" value="Menunggu">
				<input type="hidden" name="ppn" id="ppn" value="0">
				<input type="hidden" name="due_date" id="due_date" value="0">
				<input type="hidden" name="keterangan" id="keterangan" value="0">
				<input type="hidden" name="register_name" id="register_name" value="0">
				<input type="hidden" name="created" id="created" value="<?= time(); ?>">
				<input type="hidden" name="id_company" id="id_company" value="1">
				<input type="hidden" name="type_id" id="type_id" value="0">
				<input type="hidden" name="longitude" id="longitude" value="0">
				<input type="hidden" name="latitude" id="latitude" value="0">
				<input type="hidden" name="address" id="address" value="0">
				<input type="hidden" name="register_date" id="register_date" value="<?= date('Y-m-d'); ?>">
				<input type="hidden" name="username" id="username" value="0">
				<input type="hidden" name="password" id="password" value="0">
				<input type="hidden" name="prorata" id="prorata" value="0">
				<input type="hidden" name="hitung" id="hitung" value="0">
				<input type="hidden" name="code_unique" id="code_unique" value="0">
				<input type="hidden" name="server" id="server" value="0">
				<input type="hidden" name="upload" id="upload" value="0">
				<input type="hidden" name="download" id="download" value="0">
				<input type="hidden" name="jenis" id="jenis" value="0">
				<input type="hidden" name="kode_odp" id="kode_odp" value="0">
				<input type="hidden" name="port_odp" id="port_odp" value="0">
				<input type="hidden" name="ip_address" id="ip_address" value="0">
				<input type="hidden" name="mode" id="mode" value="0">
				<input type="hidden" name="router" id="router" value="0">
				<input type="hidden" name="telat" id="telat" value="0">
				<input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Nama Lengkap" value="<?= set_value('name') ?>">
				<select style="margin-top: 10px;" name="gender" id="gender" class="form-control" required>
					<option value="">- Pilih Jenis Kelamin -</option>
					<option value="Laki-Laki">Laki-Laki</option>
					<option value="Perempuan">Perempuan</option>
				</select>
				<input style="margin-top: 10px;" type="number" class="form-control form-control-user" id="no_wa" name="no_wa" placeholder="Nomor Whatsapp" value="<?= set_value('no_wa') ?>">
				<?php $coverage = $this->db->get_where('coverage', ['kategori' => 'AREA'])->result() ?>
				<select style="margin-top: 10px;" name="coverage" id="coverage" class="form-control" required>
					<option value="">- Pilih Alamat Pemasangan -</option>
					<?php foreach ($coverage as $coverage) { ?>
						<option value="<?= $coverage->coverage_id ?>"><?= $coverage->address ?> (Area <?= $coverage->comment ?>)</option>
					<?php } ?>
				</select>
				<?php $item = $this->db->get_where('package_item', ['public' => 1])->result() ?>
				<select style="margin-top: 10px;" name="paket" id="paket" class="form-control" required>
					<option value="">- Pilih Layanan Internet -</option>
					<?php foreach ($item as $item) { ?>
						<option value="<?= $item->p_item_id ?>"><?= $item->name ?> - Rp. <?= indo_currency($item->price); ?></option>
					<?php } ?>
				</select>
				<input style="margin-top: 10px;" type="text" class="form-control form-control-user" id="pemilik_rumah" name="pemilik_rumah" placeholder="Nama Pemilik Rumah" required>
				<input style="margin-top: 10px;" type="number" class="form-control form-control-user" id="no_ktp" name="no_ktp" placeholder="3529032010200004" value="<?= set_value('no_ktp') ?>">
				<label style="margin-top: 10px; color: white;">Upload Foto KTP</label>
				<input type="file" id="ktp" name="ktp" required>
				<input style="margin-top: 10px;" type="email" class="form-control form-control-user" id="Email" name="email" placeholder="Email Akun Login Aplikasi" value="<?= set_value('email') ?>">
				<input style="margin-top: 10px;" type="hidden" class="form-control form-control-user" id="password1" name="password1" value="pelanggan">
				<input style="margin-top: 10px;" type="hidden" class="form-control form-control-user" id="password2" name="password2" value="pelanggan">
				<input style="margin-top: 10px;" type="text" class="form-control form-control-user" id="refferal" name="refferal" placeholder="Kode Refferal" value="-" required>
				<input style="margin-top: 10px; margin-bottom: 10px;" type="checkbox" required> <span style="color: white;">Saya menyetujui <a href="<?= site_url('syarat-dan-ketentuan.html') ?>" style="text-decoration: none;">Syarat & Ketentuan</a> dan <a href="<?= site_url('kebijakan-privasi.html') ?>" style="text-decoration: none;">Kebijakan Privasi</a> yang berlaku</span>
				<button style="margin-top: 10px; font-weight: bold;" type="submit" class="btn btn-info btn-block"> D A F T A R </button>
			</div>
			</form>
			<a style="margin-top: 10px; text-decoration: none;" class="small" href="<?= site_url('auth') ?>">
				<button style="margin-top: 10px; font-weight: bold;" type="buttton" class="btn btn-success btn-block"> M A S U K</button>
			</a>
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
	<script src="https://files.billing.or.id/login/script.js"></script>
</body>

</html>