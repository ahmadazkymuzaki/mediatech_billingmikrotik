<section class="section">

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
</section>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <a href="" data-toggle="modal" data-target="#ModalAdd" class="d-sm-inline-block btn btn-sm btn-<?= $company['theme'] ?> shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Barang</a>

</div>
<!-- DataTales Example -->
<div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
    <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
        <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data Barang</h6>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="text-align: center;">No</th>
                        <th style="text-align: center;">Gambar</th>
                        <th style="text-align: center;">Nama Barang / Jasa</th>
                        <th style="text-align: center;">Harga</th>
                        <th style="text-align: center;">Diskon</th>
                        <th style="text-align: center;">Dijual</th>
                        <th style="text-align: center;">Stok</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;

                    $koneksi = mysqli_connect($company['host_database'], $company['user_database'], $company['pass_database'], $company['nama_database']);
                    foreach ($barang as $dataku) {
                        $harga_barang = $dataku['harga_barang'];
                        $diskon = $dataku['diskon_barang'];
                        $diskon_barang = ($harga_barang / 100) * $diskon;
                        $dijual = $harga_barang - $diskon_barang;
                    ?>
                        <tr>
                            <td class="text-center" width="35px"><?= $no++ ?></td>
                            <td class="text-center"><img src="<?= site_url() ?>assets/images/barang/<?= $dataku['gambar_barang']; ?>" alt="" style="width:100px"></td>
                            <td><?= $dataku['nama_barang']; ?></td>
                            <td>Rp. <?= indo_currency($dataku['harga_barang']); ?></td>
                            <td class="text-center"><?= $dataku['diskon_barang']; ?>%</td>
                            <td>Rp. <?= indo_currency($dijual); ?></td>
                            <td class="text-center"><?= $dataku['stok_barang']; ?></td>
                            <td class="text-center">
                                <form>
                                    <a class="btn btn-xs btn-<?= $company['theme'] ?>" href="#ModalDetail<?= $dataku['id_barang']; ?>" data-toggle="modal" title="Detail"><i class="fa fa-eye"> </i></a>
                                    <a class="btn btn-xs btn-success" href="#ModalEdit<?= $dataku['id_barang']; ?>" data-toggle="modal" title="Edit"><i class="fa fa-edit"> </i></a>
                                    <?php if ($this->session->userdata('role_id') == 1) { ?>
                                        <a class="btn btn-xs btn-danger" href="#ModalHapus<?= $dataku['id_barang']; ?>" data-toggle="modal" title="Hapus"><i class="fa fa-trash"></i></a>
                                    <?php } ?>
                                </form>
                            </td>

                            <!-- MODAL eDIT -->
                            <div class="modal fade" id="ModalEdit<?= $dataku['id_barang']; ?>" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="formModalLabel">Edit barang</h3>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="<?= site_url('barang/edit') ?>" enctype="multipart/form-data">
                                                <input type="hidden" name="id_barang" value="<?= $dataku['id_barang']; ?>" class="form-control">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-8">
                                                            <label for="name">Gambar Barang</label>
                                                            <input type="file" class="form-control" id="barang" name="barang">
                                                        </div>
                                                        <div class="col-4">
                                                            <label for="name">Kode Barang</label>
                                                            <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="<?= $dataku['kode_barang']; ?>" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-8">
                                                            <label for="name">Nama Barang</label>
                                                            <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= $dataku['nama_barang']; ?>">
                                                        </div>
                                                        <div class="col-4">
                                                            <label for="name">Stok Barang</label>
                                                            <input type="number" class="form-control" id="stok_barang" name="stok_barang" value="<?= $dataku['stok_barang']; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label for="name">Panjang Barang (cm)</label>
                                                            <input type="number" class="form-control" id="panjang_barang" name="panjang_barang" value="<?= $dataku['panjang_barang']; ?>">
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="name">Lebar Barang (cm)</label>
                                                            <input type="number" class="form-control" id="lebar_barang" name="lebar_barang" value="<?= $dataku['lebar_barang']; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label for="name">Tinggi Barang (cm)</label>
                                                            <input type="number" class="form-control" id="tinggi_barang" name="tinggi_barang" value="<?= $dataku['tinggi_barang']; ?>">
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="name">Berat Barang (gr)</label>
                                                            <input type="number" class="form-control" id="berat_barang" name="berat_barang" value="<?= $dataku['berat_barang']; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label for="name">Harga Barang (Rp.)</label>
                                                            <input type="number" class="form-control" id="harga_barang" name="harga_barang" value="<?= $dataku['harga_barang']; ?>">
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="name">Diskon Barang (%)</label>
                                                            <input type="number" class="form-control" id="diskon_barang" name="diskon_barang" value="<?= $dataku['diskon_barang']; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label for="name">Brand Barang</label>
                                                            <select name="id_merk" id="id_merk" class="form-control">
                                                                <?php
                                                                $query_merk1 = mysqli_query($koneksi, "SELECT * FROM merk");
                                                                while ($data_merk1 = mysqli_fetch_array($query_merk1)) {
                                                                ?>
                                                                    <option value="<?= $data_merk1['id_merk']; ?>"><?= $data_merk1['nama_merk']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="name">Kategori Barang</label>
                                                            <select name="id_kategori" id="id_kategori" class="form-control">
                                                                <?php
                                                                $query_kategori1 = mysqli_query($koneksi, "SELECT * FROM kategori");
                                                                while ($data_kategori1 = mysqli_fetch_array($query_kategori1)) {
                                                                ?>
                                                                    <option value="<?= $data_kategori1['id_kategori']; ?>"><?= $data_kategori1['nama_kategori']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label for="name">Penjual Barang</label>
                                                            <select name="id_supplier" id="id_supplier" class="form-control">
                                                                <?php
                                                                $query_supplier1 = mysqli_query($koneksi, "SELECT * FROM supplier");
                                                                while ($data_supplier1 = mysqli_fetch_array($query_supplier1)) {
                                                                ?>
                                                                    <option value="<?= $data_supplier1['id_supplier']; ?>"><?= $data_supplier1['nama_supplier']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="name">Status Barang</label>
                                                            <select name="status_barang" id="status_barang" class="form-control">
                                                                <option value="Tersedia">Tersedia</option>
                                                                <option value="Kosong">Kosong</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="link">Link Barang</label>
                                                    <input type="text" class="form-control" id="link_barang" name="link_barang" value="<?= $dataku['link_barang']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="description">Keterangan</label>
                                                    <textarea type="text" class="form-control" id="keterangan" name="keterangan"><?= $dataku['keterangan']; ?></textarea>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>"> Update</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--END MODAL eDIT-->

                            <!-- MODAL Hapus -->
                            <div class="modal fade" id="ModalHapus<?= $dataku['id_barang']; ?>" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="formModalLabel">Hapus <?= $dataku['nama_barang']; ?></h3>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <?php $id_barang = $dataku['id_barang']; ?>
                                        <div class="modal-body">
                                            <form method="post" action="<?= site_url('barang/delete/') . $id_barang ?>" enctype="multipart/form-data">
                                                <input type="hidden" name="id_barang" value="<?= $dataku['id_barang']; ?>" class="form-control">
                                                <center>Apakah anda yakin akan menghapus data barang ini ?</center>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button class="btn btn-danger"> Ya, lanjutkan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--END MODAL Hapus-->

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- MODAL ADD -->
    <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <?php
                $query = "SELECT max(kode_barang) as maxKode FROM barang";
                $hasil = mysqli_query($koneksi, $query);
                $data  = mysqli_fetch_array($hasil);
                $kodebuku = $data['maxKode'];
                $noUrut = (int) substr($kodebuku, 5, 5);
                $noUrut++;
                $char = "BRNG-";
                $newID = $char . sprintf("%05s", $noUrut)
                ?>
                <div class="modal-body">
                    <form method="post" action="<?= site_url('barang/add') ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-8">
                                    <label for="name">Gambar Barang</label>
                                    <input type="file" class="form-control" id="barang" name="barang">
                                </div>
                                <div class="col-4">
                                    <label for="name">Kode Barang</label>
                                    <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="<?= $newID; ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-8">
                                    <label for="name">Nama Barang</label>
                                    <input type="text" class="form-control" id="nama_barang" name="nama_barang">
                                </div>
                                <div class="col-4">
                                    <label for="name">Stok Barang</label>
                                    <input type="number" class="form-control" id="stok_barang" name="stok_barang">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="name">Panjang Barang (cm)</label>
                                    <input type="number" class="form-control" id="panjang_barang" name="panjang_barang">
                                </div>
                                <div class="col-6">
                                    <label for="name">Lebar Barang (cm)</label>
                                    <input type="number" class="form-control" id="lebar_barang" name="lebar_barang">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="name">Tinggi Barang (cm)</label>
                                    <input type="number" class="form-control" id="tinggi_barang" name="tinggi_barang">
                                </div>
                                <div class="col-6">
                                    <label for="name">Berat Barang (gr)</label>
                                    <input type="number" class="form-control" id="berat_barang" name="berat_barang">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="name">Harga Barang (Rp.)</label>
                                    <input type="number" class="form-control" id="harga_barang" name="harga_barang">
                                </div>
                                <div class="col-6">
                                    <label for="name">Diskon Barang (%)</label>
                                    <input type="number" class="form-control" id="diskon_barang" name="diskon_barang">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="name">Brand Barang</label>
                                    <select name="id_merk" id="id_merk" class="form-control">
                                        <?php
                                        $query_merk = mysqli_query($koneksi, "SELECT * FROM merk");
                                        while ($data_merk = mysqli_fetch_array($query_merk)) {
                                        ?>
                                            <option value="<?= $data_merk['id_merk']; ?>"><?= $data_merk['nama_merk']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="name">Kategori Barang</label>
                                    <select name="id_kategori" id="id_kategori" class="form-control">
                                        <?php
                                        $query_kategori = mysqli_query($koneksi, "SELECT * FROM kategori");
                                        while ($data_kategori = mysqli_fetch_array($query_kategori)) {
                                        ?>
                                            <option value="<?= $data_kategori['id_kategori']; ?>"><?= $data_kategori['nama_kategori']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="name">Penjual Barang</label>
                                    <select name="id_supplier" id="id_supplier" class="form-control">
                                        <?php
                                        $query_supplier = mysqli_query($koneksi, "SELECT * FROM supplier");
                                        while ($data_supplier = mysqli_fetch_array($query_supplier)) {
                                        ?>
                                            <option value="<?= $data_supplier['id_supplier']; ?>"><?= $data_supplier['nama_supplier']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="name">Status Barang</label>
                                    <select name="status_barang" id="status_barang" class="form-control">
                                        <option value="Tersedia">Tersedia</option>
                                        <option value="Kosong">Kosong</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="link">Link Barang</label>
                            <input type="text" class="form-control" id="link_barang" name="link_barang">
                        </div>
                        <div class="form-group">
                            <label for="description">Keterangan</label>
                            <textarea type="text" class="form-control" id="keterangan" name="keterangan"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>" id="btn_simpan"> Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--END MODAL ADD-->