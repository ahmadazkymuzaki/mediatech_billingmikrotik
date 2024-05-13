<link href="https://files.billing.or.id/assets/backend/css/bootstrap3-wysihtml5.min.css" rel="stylesheet">
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
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<a href="<?= site_url('package/item'); ?>" title="Kembali">
			<input type="button" class="btn btn-danger" value="Close" readonly>
		</a>
	</div>
	<div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
		<div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
			<h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Edit Item Layanan</h6>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="card-body">
					<form method="post" action="<?= site_url('package/editPItem') ?>" enctype="multipart/form-data">
						<div class="box-body">
							<img class="tv-card__image" style="height: 100px;" src="<?= site_url('assets/images/package/') ?><?= $item['picture'] ?>"><br><br>
							<input type="hidden" name="p_item_id" value="<?= $item['p_item_id'] ?>" class="form-control">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label for="price">Gambar Layanan</label>
										<input type="file" id="picture" name="picture" class="form-control">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="price">Nama Layanan</label>
										<input type="text" id="name" name="name" class="form-control" value="<?= $item['name'] ?>" required>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="price">Harga Reguler</label>
										<input type="number" id="price" name="price" value="<?= $item['price'] ?>" class="form-control" required>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="reseller">Harga Reseller</label>
										<input type="number" id="reseller" name="reseller" value="<?= $item['reseller'] ?>" class="form-control" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label for="name">Profile Layanan</label>
										<select id="basic" id="paket" name="paket" class="selectpicker show-tick form-control" data-live-search="true" tabindex="-98" required>
											<option value="<?= $item['paket_wifi'] ?>"><?= $item['paket_wifi'] ?></option>
											<option value="" style="font-weight:bold;">============== Pilih Profile PPPOE ==============</option>
											<?php foreach ($pppprofile as $itemgua) { ?>
												<option value="<?= $itemgua['name'] ?>"><?= $itemgua['name'] ?></option>
											<?php } ?>
											<option value="" style="font-weight:bold;">============== Pilih Profile Hotspot ==============</option>
											<?php foreach ($hotspotprofile as $itemgua) { ?>
												<option value="<?= $itemgua['name'] ?>"><?= $itemgua['name'] ?></option>
											<?php } ?>
											<!-- <option value="" style="font-weight:bold;">============== Pilih Product Add-On ==============</option>
												<option value="CCTV Indoor 2MP">CCTV Indoor 2MP</option>
												<option value="CCTV Indoor 5MP">CCTV Indoor 5MP</option>
												<option value="CCTV Outdoor 2MP">CCTV Outdoor 2MP</option>
												<option value="CCTV Outdoor 5MP">CCTV Outdoor 5MP</option>
												<option value="STB Huawei HG-680P">STB Huawei HG-680P</option>
												<option value="STB ZTE 4K v2">STB ZTE B860H v2</option>
												<option value="STB ZTE 4K v5">STB ZTE B860H v5</option>
												<option value="STB Akari AX-117">STB Akari AX-117</option>
												<option value="STB Akari AX-512">STB Akari AX-512</option>
												<option value="STB Ram 1gb MXQ Pro">STB Ram 1gb MXQ Pro</option>
												<option value="STB Ram 2gb MXQ Pro">STB Ram 2gb MXQ Pro</option>
												<option value="STB Ram 4gb MXQ Pro">STB Ram 4gb MXQ Pro</option>
												<option value="STB Ram 8gb X88 Pro">STB Ram 8gb X88 Pro</option>
												<option value="Telepon Rumah">Telepon Rumah</option> -->
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Kategori Layanan</label>
										<select name="category" id="" class="form-control" required>
											<option value="">-- Pilih Kategori --</option>
											<?php foreach ($p_category as $key => $data) { ?>
												<option value="<?= $data->p_category_id ?>"><?= $data->name ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="public">Tampilkan di Register</label>
										<select name="public" class="form-control" id="public" required>
											<?php if ($item['public'] = 1) { ?>
												<option value="1">Tamplikan (selected)</option>
												<option value="0">Sembunyikan</option>
											<?php } else { ?>
												<option value="0">Sembunyikan (selected)</option>
												<option value="1">Tamplikan</option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="description">Deskripsi</label>
								<textarea name="description" id="editor1" cols="30" rows="10"><?= $item['description'] ?></textarea>
							</div>
						</div>
						<div class="box-footer">
							<button type="Reset" class="btn btn-info">Reset</button>
							<button type="submit" class="btn btn-success">Simpan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		</section>
		<script src="https://files.billing.or.id/assets/backend/js/bootstrap3-wysihtml5.all.min.js"></script>
		<script language="javascript">
			function getkey(e) {
				if (window.event)
					return window.event.keyCode;
				else if (e)
					return e.which;
				else
					return null;
			}

			function kodeScript(e, goods, field) {
				var key, keychar;
				key = getkey(e);
				if (key == null) return true;

				keychar = String.fromCharCode(key);
				keychar = keychar.toLowerCase();
				goods = goods.toLowerCase();

				// check goodkeys
				if (goods.indexOf(keychar) != -1)
					return true;
				// control keys
				if (key == null || key == 0 || key == 8 || key == 9 || key == 27)
					return true;

				if (key == 13) {
					var i;
					for (i = 0; i < field.form.elements.length; i++)
						if (field == field.form.elements[i])
							break;
					i = (i + 1) % field.form.elements.length;
					field.form.elements[i].focus();
					return false;
				};
				// else return false
				return false;
			}
		</script>
		<script src="https://cdn.ckeditor.com/4.16.1/standard-all/ckeditor.js"></script>
		<script>
			CKEDITOR.replace('editor1');
		</script>