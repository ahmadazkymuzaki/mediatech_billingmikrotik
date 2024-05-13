<!-- bootstrap datepicker -->
<link rel="stylesheet" href="https://files.billing.or.id/assets/backend/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
<!-- Page Heading -->
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
<div class="row">
	<div class="col-lg-3">
		<div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-3">
			<div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3 text-center">
				<a href="<?= site_url('penjualan'); ?>" class="m-0 font-weight-bold" style="text-decoration: none;"><i class="fa fa-plus"></i>&nbsp; Transaksi Baru &nbsp;<i class="fa fa-refresh"></i></a>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="card-body">
						<div class="form-group pt-2">
							<label for="user_router">Nama Pelanggan</label>
							<select name="user" id="user" class="selectpicker form-control" data-live-search="true">
								<option value=""> --{ Pilih Pelanggan }-- </option>
								<?php foreach ($customer as $mycustomer) { ?>
									<option value="<?= $mycustomer->customer_id; ?>"><?= $mycustomer->name; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group pt-3 pb-2">
							<a style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?> form-control" href="#ModalAdd" data-toggle="modal" title="Edit"><i class="fa fa-search"></i> Cari Barang / Produk</a>
						</div>
						<div class="form-group" style="padding-top: 5px;">
							<label for="user_router">Nomor Invoice</label>
							<input type="text" id="user_router" name="user_router" class="form-control" value="#NID-<?= $user['id'] . date('dYHm') . $user['id']; ?>" readonly>
						</div>
						<?php $karyawan = $this->db->get_where('karyawan', array('id_user' => $user['id']))->row_array(); ?>
						<div class="form-group">
							<label for="user_router">Kode Kasir (ID)</label>
							<input type="text" id="user_router" name="user_router" class="form-control" value="<?= $karyawan['kode'] . ' (ID : ' . $user['id'] . ')' ?>" readonly>
							<input type="hidden" id="user_router" name="user_router" class="form-control" value="<?= $karyawan['kode'] ?>" readonly>
						</div>
						<div class="form-group pt-1">
							<label for="user_router">Transaksi Pada</label>
							<input type="text" id="user_router" name="user_router" class="form-control" value="<?= date('d/m/Y H:i:s'); ?>" readonly>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-9">
		<div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
			<div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
				<h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Keranjang Belanja</h6>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="card-body">
						<table class="table table-bordered mt-3" id="table" width="100%" cellspacing="0">
							<thead>
								<tr class="text-center">
									<th>No</th>
									<th>Kode</th>
									<th>Nama Barang</th>
									<th>Harga (Rp)</th>
									<th>Qty</th>
									<th>Jumlah (Rp)</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								$nomornota = '#NID-' . $user['id'] . date('dYHm') . $user['id'];
								$penjualan = $this->db->get_where('penjualan', array('nomor_nota' => $nomornota, 'transaksi_ke' => 0))->result();
								foreach ($penjualan as $dataku) {
								?>
									<tr>
										<td style="padding-top: 20px;" class="text-center" width="5%"><?= $no++ ?></td>
										<td style="padding-top: 20px;" class="text-center" width="18%"><?= $dataku->kode_barang ?></td>
										<td style="padding-top: 20px;"><?= $dataku->nama_barang ?></td>
										<td style="padding-top: 20px;" class="text-center" width="15%"><?= indo_currency($dataku->harga_barang) ?></td>
										<td style="padding-top: 20px;" class="text-center" width="5%"><?= $dataku->jumlah_barang ?></td>
										<td style="padding-top: 20px;" class="text-center" width="15%"><?= indo_currency($dataku->jumlah_harga) ?></td>
										<td class="text-center" width="10%">
											<a class="btn btn-xs btn-danger" href="#ModalHapus<?= $dataku->id_penjualan ?>" data-toggle="modal" title="Hapus">
												<i class="fa fa-trash"></i>
											</a>
										</td>
									</tr>
									<div class="modal fade" id="ModalHapus<?= $dataku->id_penjualan ?>" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" style="display: none;" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h3 class="modal-title" id="formModalLabel">Hapus Barang dari Keranjang</h3>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												</div>
												<form method="post" action="<?= site_url('penjualan/deletekrjg/') ?><?= $dataku->id_penjualan ?>" enctype="multipart/form-data">
													<div class="modal-body">
														Anda yakin akan hapus barang <?= $dataku->nama_barang ?> ?
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
														<button class="btn btn-danger"> Ya, lanjutkan</button>
													</div>
												</form>
											</div>
										</div>
									</div>
								<?php } ?>
							</tbody>
						</table>
						<?php echo form_open_multipart('mikrotik/addrouter') ?>
						<div class="row">
							<div class="col-lg-7">
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<select class="form-control" name="provinsi" style="font-weight: bold;" id="provinsi" required>
												<option value="">- Pilih Provinsi -</option>
												<?php
												$curl = curl_init();
												curl_setopt_array($curl, array(
													CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
													CURLOPT_RETURNTRANSFER => true,
													CURLOPT_ENCODING => "",
													CURLOPT_MAXREDIRS => 10,
													CURLOPT_TIMEOUT => 30,
													CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
													CURLOPT_CUSTOMREQUEST => "GET",
													CURLOPT_HTTPHEADER => array(
														"content-type: application/x-www-form-urlencoded",
														"key: " . $company['rajaongkir']
													),
												));

												$response = curl_exec($curl);
												$err = curl_error($curl);
												curl_close($curl);

												if ($err) {
													echo "cURL Error #:" . $err;
												} else {
													$provinsi = json_decode($response, true);
													if ($provinsi['rajaongkir']['status']['code'] == '200') {
														foreach ($provinsi['rajaongkir']['results'] as $myprovinsi) {
												?>
															<option value="<?= $myprovinsi['province_id'] ?>">Provinsi <?= $myprovinsi['province'] ?></option>
												<?php }
													}
												} ?>
											</select>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<select class="form-control" name="kota" style="font-weight: bold;" id="kota" required>
												<option value="">- Pilih Kab / Kota -</option>
											</select>
										</div>
									</div>
								</div>
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text">Catatan</div>
									</div>
									<textarea type="text" id="remark" name="remark" rows="4" class="form-control" required>Barang yang sudah dibeli tidak dapat ditukar / dikembalikan kecuali ada perjanjian sebelumnya. Terimakasih anda telah berbelanja dan menjadi pelanggan setia kami. Hormat kami, <?= $company['company_name']; ?></textarea>
								</div>
								<div class="form-group" style="padding-top: 17px;">
									<select class="form-control" name="metode_payment" style="font-weight: bold;" id="metode_payment" required>
										<option value="">- Pilih Metode Pembayaran -</option>
										<option value="Bayar Tunai ke Reseller">Bayar Tunai ke Reseller</option>
										<?php foreach ($channel as $mydata) { ?>
											<option value="<?= $mydata->kode_channel ?>"><?= $mydata->nama_channel ?></option>
										<?php } ?>
										<?php foreach ($bank as $data) { ?>
											<option value="<?= $data->name ?>"><?= $data->name ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="row pt-1">
									<div class="col-lg-4">
										<button style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?> form-control"><i class="fa fa-save"></i> Simpan Trx</button>
									</div>
									<div class="col-lg-4">
										<button class="btn btn-warning form-control"><i class="fa fa-print"></i> Cetak Nota</button>
									</div>
									<div class="col-lg-4">
										<button class="btn btn-success form-control"><i class="fa fa-sign-out"></i> Cek Tripay</button>
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group text-right">
									<label for="user_router" style="padding-top: 7px;">Pajak / PPN :</label><br>
									<label for="user_router" style="padding-top: 10px;">Ongkos Kirim :</label><br>
									<label for="user_router" style="padding-top: 10px;">Ptg. Ongkir :</label><br>
									<label for="user_router" style="padding-top: 10px;">Total Belanja :</label>
									<hr>
									<label for="user_router" style="padding-top: 10px;">Jumlah Bayar :</label><br>
									<label for="user_router" style="padding-top: 10px;">Kembalian :</label>
								</div>
							</div>
							<?php $datague = $this->db->query("Select SUM(jumlah_harga) as subtotal from penjualan Where nomor_nota = '$nomornota' AND transaksi_ke = 0")->row_array() ?>
							<div class="col-lg-3">
								<div class="form-group">
									<div class="input-group">
										<input type="hidden" id="subtotal" name="subtotal" onchange="math()" value="<?= $datague['subtotal'] ?>" class="form-control" readonly>
										<input type="number" id="ppn" name="ppn" onchange="math()" value="1" class="form-control" required>
										<div class="input-group-prepend">
											<div class="input-group-text">%</div>
										</div>
									</div>
									<div class="input-group mt-1">
										<div class="input-group-prepend">
											<div class="input-group-text">Rp.</div>
										</div>
										<input type="number" id="ongkir" name="ongkir" maxlength="5" onchange="math()" value="0" class="form-control" required>
									</div>
									<div class="input-group mt-1">
										<div class="input-group-prepend">
											<div class="input-group-text">Rp.</div>
										</div>
										<input type="number" id="potong" name="potong" onchange="math()" value="0" class="form-control" required>
									</div>
									<div class="input-group mt-1">
										<div class="input-group-prepend">
											<div class="input-group-text">Rp.</div>
										</div>
										<input type="number" id="mytotal" name="mytotal" onchange="math()" class="form-control" readonly>
										<input type="hidden" id="total" name="total" onchange="math()" class="form-control" readonly>
									</div>
									<hr>
									<div class="input-group mt-1">
										<div class="input-group-prepend">
											<div class="input-group-text">Rp.</div>
										</div>
										<input type="number" id="bayar" name="bayar" onchange="math()" class="form-control" required>
									</div>
									<div class="input-group mt-1">
										<div class="input-group-prepend">
											<div class="input-group-text">Rp.</div>
										</div>
										<input type="text" id="kembali" name="kembali" onchange="math()" class="form-control" readonly>
									</div>
								</div>
							</div>
						</div>
						<?php echo form_close() ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<link rel="stylesheet" href="https://files.billing.or.id/assets/backend/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
<div class="row mb-4">
	<div class="col-md">
		<div style="border: 3px solid <?= $backgroundnya ?>;" class="card">
			<div class="card-body">
				<form class="form-inline" method="post" action="">
					<div class="form-group mb-2">
						<label for="bulan">Bulan</label>
						<select name="bulan" id="bulan" class="form-control ml-2">
							<option value="">-- Pilih Bulan --</option>
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
					<div class="form-group mx-sm-3 mb-2">
						<label for="tahun">Tahun</label>
						<select name="tahun" id="tahun" class="form-control ml-2">
							<option value="">-- Pilih Tahun --</option>
							<?php $thn = date('Y');
							for ($i = 2020; $i < $thn + 10; $i++) { ?>
								<option value="<?= $i; ?>"><?= $i; ?></option>
							<?php } ?>
						</select>
					</div>
					<button type="submit" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?> mb-2 ml-auto"><i class="fas fa-eye"></i> Tampilkan Data</button>
				</form>
				<?php
				if ((isset($_POST['bulan']) && $_POST['bulan'] != null) && (isset($_POST['tahun']) && $_POST['tahun'] != null)) {
					$bulan = $this->input->post('bulan');
					$tahun = $this->input->post('tahun');
					$bulanTahun = $bulan . $tahun;
				} else {
					$bulan = date('m');
					$tahun = date('Y');
					$bulanTahun = $bulan . $tahun;
				}

				if ($bulan == '01') {
					$bulan_filter = 'Januari';
				} elseif ($bulan == '02') {
					$bulan_filter = 'Februari';
				} elseif ($bulan == '03') {
					$bulan_filter = 'Maret';
				} elseif ($bulan == '04') {
					$bulan_filter = 'April';
				} elseif ($bulan == '05') {
					$bulan_filter = 'Mei';
				} elseif ($bulan == '06') {
					$bulan_filter = 'Juni';
				} elseif ($bulan == '07') {
					$bulan_filter = 'Juli';
				} elseif ($bulan == '08') {
					$bulan_filter = 'Agustus';
				} elseif ($bulan == '09') {
					$bulan_filter = 'September';
				} elseif ($bulan == '10') {
					$bulan_filter = 'Oktober';
				} elseif ($bulan == '11') {
					$bulan_filter = 'November';
				} elseif ($bulan == '12') {
					$bulan_filter = 'Desember';
				} else {
					$bulan_filter = '';
				}
				?>
				<div class="alert alert-info mt-4" role="alert">Menampilkan Data Transaksi Bulan : <strong><?= $bulan_filter; ?> <?= $tahun; ?></strong></div>
			</div>
		</div>
	</div>
</div>

<!-- DataTales Example -->
<div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-1">
	<div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
		<?php
		$jumlah_kehadiran = $this->db->get('kehadiran')->num_rows();
		$query_kehadiran = $this->db->get('kehadiran')->result();
		?>
		<h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data Transaksi <?= $bulan_filter; ?> <?= $tahun; ?> (<?= $jumlah_kehadiran; ?> item)</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="tablebt" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th style="text-align: center;">No</th>
						<th style="text-align: center;">Identitas Router</th>
						<th style="text-align: center;">Address</th>
						<th style="text-align: center;">Port</th>
						<th style="text-align: center;">Username</th>
						<th style="text-align: center;">Password</th>
						<th style="text-align: center;">Status</th>
						<th style="text-align: center;">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1;
					foreach ($router as $r => $data) { ?>
						<tr>
							<td style="text-align: center;" width="5%"><?= $no++ ?></td>
							<td width="19%"><?= $data->name_router ?></td>
							<td style="text-align: center;" width="15%"><?= $data->host_router ?></td>
							<td style="text-align: center;" width="10%"><?= $data->port_router ?></td>
							<td style="text-align: center;" width="15%"><?= $data->user_router ?></td>
							<td style="text-align: center;" width="15%"><?= $data->pass_router ?></td>
							<td style="text-align: center;" width="10%"><?= $data->description ?></td>
							<td class="text-center" width="11%">
								<form>
									<a class="btn btn-xs btn-<?= $company['theme'] ?>" href="#ModalEdit<?= $data->router_id ?>" data-toggle="modal" title="Edit"><i class="fa fa-edit"> </i></a>
									<a class="btn btn-xs btn-danger" href="#ModalHapus<?= $data->router_id ?>" data-toggle="modal" title="Hapus"><i class="fa fa-trash"></i></a>
								</form>
							</td>
						</tr>
						<div class="modal fade" id="ModalHapus1" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" style="display: none;" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h3 class="modal-title" id="formModalLabel">Hapus Router</h3>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form method="post" action="<?= site_url('mikrotik/delete/') ?>" enctype="multipart/form-data">
											Apakah anda yakin akan hapus router 1 ?

									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
										<button class="btn btn-danger"> Ya, lanjutkan</button>
										</form>
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
<!-- DataTales Example -->
<div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-1">
	<div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
		<h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data Transaksi</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="tablebt" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th style="text-align: center;">No</th>
						<th style="text-align: center;">Identitas Router</th>
						<th style="text-align: center;">Address</th>
						<th style="text-align: center;">Port</th>
						<th style="text-align: center;">Username</th>
						<th style="text-align: center;">Password</th>
						<th style="text-align: center;">Status</th>
						<th style="text-align: center;">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					$penjualan = $this->db->get_where('penjualan', array('kode_karyawan' => $karyawan['kode']))->result();
					foreach ($penjualan as $dataku) {
					?>
						<tr>
							<td style="text-align: center;" width="5%"><?= $no++ ?></td>
							<td width="19%"><?= $data->name_router ?></td>
							<td style="text-align: center;" width="15%"><?= $data->host_router ?></td>
							<td style="text-align: center;" width="10%"><?= $data->port_router ?></td>
							<td style="text-align: center;" width="15%"><?= $data->user_router ?></td>
							<td style="text-align: center;" width="15%"><?= $data->pass_router ?></td>
							<td style="text-align: center;" width="10%"><?= $data->description ?></td>
							<td class="text-center" width="11%">
								<form>
									<a class="btn btn-xs btn-<?= $company['theme'] ?>" href="#ModalEdit<?= $data->router_id ?>" data-toggle="modal" title="Edit"><i class="fa fa-edit"> </i></a>
									<a class="btn btn-xs btn-danger" href="#ModalHapus<?= $data->router_id ?>" data-toggle="modal" title="Hapus"><i class="fa fa-trash"></i></a>
								</form>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Pencarian Data Barang</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" action="<?= site_url('penjualan/keranjang/') ?>" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th style="text-align: center;">No</th>
									<th style="text-align: center;">Nama Barang</th>
									<th style="text-align: center;">Harga (Rp)</th>
									<th style="text-align: center;">Kategori</th>
									<th style="text-align: center;">Stok</th>
									<th style="text-align: center;">Diskon (Rp)</th>
									<th style="text-align: center;">Qty</th>
									<th style="text-align: center;">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								foreach ($barang as $mybarang) {
									$kategori = $this->db->get_where('kategori', array('id_kategori' => $mybarang->id_kategori))->row_array();
									$karyawan = $this->db->get_where('karyawan', array('id_user' => $user['id']))->row_array();
								?>
									<tr>
										<td style="text-align: center; padding-top: 18px;" width="3%"><?= $no++ ?></td>
										<td style="text-align: center; padding-top: 18px;" width="17%"><?= $mybarang->nama_barang . $mybarang->kode_barang ?></td>
										<td style="text-align: center; padding-top: 18px;" width="10%"><?= indo_currency($mybarang->harga_barang); ?></td>
										<td style="text-align: center; padding-top: 18px;" width="10%"><?= $kategori['nama_kategori'] ?></td>
										<td style="text-align: center; padding-top: 18px;" width="3%"><?= $mybarang->stok_barang ?></td>
										<td style="text-align: center;" width="10%"><input style="text-align: left;" type="number" id="jumlah_diskon" name="jumlah_diskon" value="<?= $mybarang->diskon_barang ?>" class="form-control" required></td>
										<td style="text-align: center;" width="7%">
											<input type="hidden" id="nomor_nota" name="nomor_nota" value="#NID-<?= $user['id'] . date('dYHm') . $user['id']; ?>" class="form-control" readonly>
											<input type="hidden" id="kode_barang" name="kode_barang" value="<?= $mybarang->kode_barang ?>" class="form-control" readonly>
											<input type="hidden" id="nama_barang" name="nama_barang" value="<?= $mybarang->nama_barang ?>" class="form-control" readonly>
											<input type="hidden" id="harga_barang" name="harga_barang" value="<?= $mybarang->harga_barang ?>" class="form-control" readonly>
											<input type="number" id="jumlah_barang" name="jumlah_barang" value="1" class="form-control" required>
											<input type="hidden" id="kategori_barang" name="kategori_barang" value="<?= $kategori['nama_kategori'] ?>" class="form-control" readonly>
											<input type="hidden" id="kode_karyawan" name="kode_karyawan" value="<?= $karyawan['kode']; ?>" class="form-control" readonly>
										</td>
										<td class="text-center" width="10%">
											<button class="btn btn-xs btn-<?= $company['theme'] ?>" type="submit"><i class="fa fa-shopping-cart"></i>&nbsp; Pilih</button>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	function math() {
		var subtotal = parseInt(document.getElementById("subtotal").value);
		var ppnnya = parseInt(document.getElementById("ppn").value);
		var ongkir = parseInt(document.getElementById("ongkir").value);
		var potong = parseInt(document.getElementById("potong").value);
		var total = parseInt(document.getElementById("total").value);
		var bayar = parseInt(document.getElementById("bayar").value);

		var thistotal = (subtotal + ((subtotal / 100) * ppnnya) + ongkir) - potong;
		var mykembali = bayar - thistotal;

		document.getElementById("mytotal").value = thistotal;
		document.getElementById("kembali").value = mykembali;
	}
</script>
<script type="text/javascript">
	document.getElementById('provinsi').addEventListener('change', function() {
		fetch("<?= site_url('penjualan/rajakota/') ?>" + this.value, {
				method: 'GET',
			})
			.then((response) => response.text())
			.then((data) => {
				console.log(data)
				document.getElementById('kota').innerHTML = data;
			})
	})
</script>
<script type="text/javascript">
	document.getElementById('kota').addEventListener('change', function() {
		fetch("<?= site_url('penjualan/rajaongkir/') ?>" + this.value, {
				method: 'GET',
			})
			.then((response) => response.text())
			.then((datagua) => {
				console.log(datagua)
				document.getElementById('ongkir').value = datagua.substr(5, 5);
			})
	})
</script>