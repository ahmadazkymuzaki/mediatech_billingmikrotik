<link href="https://files.billing.or.id/assets/backend/css/bootstrap3-wysihtml5.min.css" rel="stylesheet">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<a href="#" data-toggle="modal" data-target="#addModal" class="d-sm-inline-block btn btn-sm btn-<?= $company['theme'] ?> shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah</a>
</div>
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
<!-- DataTales Example -->
<div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
	<div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
		<h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data Item Layanan</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr style="text-align: center;">
						<th style="text-align: center; width:20px">No</th>
						<th>Nama Layanan</th>
						<th>Reguler</th>
						<th>Reseller</th>
						<th>Kategori</th>
						<th>Tampil</th>
						<th>Profil Paket</th>
						<th style="text-align: center">Aksi</th>
					</tr>
				</thead>

				<tbody>
					<?php $no = 1;
					foreach ($p_item as $r => $data) { ?>
						<tr>
							<td style="text-align: center"><?= $no++ ?>.</td>
							<td width="20%"><?= $data->nameItem ?></td>
							<td style="text-align: center;">Rp. <?= indo_currency($data->price) ?></td>
							<td style="text-align: center;">Rp. <?= indo_currency($data->reseller) ?></td>
							<td style="text-align: center;"><?= $data->category_name ?></td>
							<td style="text-align: center"><?= $data->public == 1 ? 'Yes' : 'No'; ?></td>
							<td style="text-align: left;"><?= $data->paket_wifi ?></td>
							<td style="text-align: center">
								<a href="<?= site_url('package/editItemnya/') ?><?= $data->p_item_id ?>"><i class="fa fa-edit" style="font-size:25px; color:blue"></i></a>
								<a href="" data-toggle="modal" data-target="#DeleteModal<?= $data->p_item_id ?>" title="Hapus"><i class="fa fa-trash" style="font-size:25px; color:red"></i></a>
							</td>
						</tr>
						<div class="modal fade" id="DeleteModal<?= $data->p_item_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Hapus Layanan</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<?php echo form_open_multipart('package/deletePItem') ?>
										<input type="hidden" name="p_item_id" value="<?= $data->p_item_id ?>" class="form-control">
										Apakah yakin akan hapus Layanan <?= $data->nameItem ?> ?
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
											<button type="submit" class="btn btn-danger">Hapus</button>
										</div>
										<?php echo form_close() ?>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>


<!-- Modal Add -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Layanan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?php echo form_open_multipart('package/addPItem') ?>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="price">Gambar Layanan</label>
							<input type="file" id="picture" name="picture" class="form-control" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="price">Nama Layanan</label>
							<input type="text" id="name" name="name" class="form-control" required>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="name">Profile Layanan</label>
							<select id="basic" id="paket" name="paket" class="selectpicker show-tick form-control" data-live-search="true" tabindex="-98" required>
								<option value="" style="font-weight:bold; text-align: center;">============== Pilih Profile PPPOE ==============</option>
								<?php foreach ($pppprofile as $datagua) { ?>
									<option value="<?= $datagua['name'] ?>"><?= $datagua['name'] ?></option>
								<?php } ?>
								<option value="" style="font-weight:bold;">============== Pilih Profile Hotspot ==============</option>
								<?php foreach ($hotspotprofile as $datagua) { ?>
									<option value="<?= $datagua['name'] ?>"><?= $datagua['name'] ?></option>
								<?php } ?>
								<option value="" style="font-weight:bold;">============== Pilih Product Add-On ==============</option>
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
								<option value="Telepon Rumah">Telepon Rumah</option>
							</select>
						</div>
					</div>
					<div class="col-md-6">
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
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="price">Harga Reguler</label>
							<input type="number" id="price" name="price" class="form-control" required>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="reseller">Harga Reseller</label>
							<input type="number" id="reseller" name="reseller" class="form-control" required>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="public">Tampilkan di Register</label>
							<select name="public" class="form-control" id="public" required>
								<option value="">-- Pilih --</option>
								<option value="1">Yes</option>
								<option value="0">No</option>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="description">Keterangan Layanan </label>
					<textarea type="text" id="editor1" name="description" class="form-control" required></textarea>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>">Simpan</button>
				</div>
				<?php echo form_close() ?>
			</div>
		</div>
	</div>
</div>
<script src="https://cdn.ckeditor.com/4.16.1/standard-all/ckeditor.js"></script>
<script>
	CKEDITOR.replace('editor1');
</script>