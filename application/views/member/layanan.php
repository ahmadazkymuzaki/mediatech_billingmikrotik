<div class="col-lg-12 mt-3">
    <div class="col-12">
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
    <div class="col-md-12">
        <div class="card shadow mb-2">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-lg-4 col-12">
                                <span id="upgrade"><input type="checkbox" name="upgrade" value="upgrade" class="upgrade"> &nbsp;Upgrade / Downgrade Speed</span>
                            </div>
                            <div class="col-lg-4 col-12">
                                <span id="addon"><input type="checkbox" name="addon" value="addon" class="addon"> &nbsp;Tambah Layanan Add-On</span>
                            </div>
                            <div class="col-lg-4 col-12">
                                <span id="renew"><input type="checkbox" name="renew" value="renew" class="renew"> &nbsp;Renew Speed (reset kuota)</span>
                            </div>
                        </div>
                        <div id="form-upgrade">
                            <div class="row">
                                <div class="form-group col-lg-2 col-12">
                                    <select clas="form-control" name="mydeskripsi" id="mydeskripsi">
                                        <option value="">Silahkan Pilih</option>
                                        <?php
                                        $upgrade = $this->db->get_where('package_item', ['category_id' => 1])->result();
                                        foreach ($upgrade as $row1) {
                                        ?>
                                            <option value="<?= $row1->p_item_id ?>"><?= $row1->name ?> - Rp. <?= indo_currency($row1->price) ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <form action="<?= site_url('member/tambahlayanan') ?>" method="POST">
                                <div class="row">
                                    <div class="form-group col-lg-4 col-12">
                                        <label>Diajukan Oleh</label>
                                        <input type="hidden" class="form-control" readonly value="Upgrade / Downgrade Speed" name="judul_layanan" id="judul_layanan">
                                        <input type="text" class="form-control" readonly value="<?= $customer['name'] ?>" name="nama_pelanggan" id="nama_pelanggan">
                                    </div>
                                    <div class="form-group col-lg-4 col-12">
                                        <label>Nomor Layanan</label>
                                        <input type="text" class="form-control" readonly value="<?= $customer['no_services'] ?>" name="nomor_layanan" id="nomor_layanan">
                                    </div>
                                    <div class="form-group col-lg-4 col-12">
                                        <label>ID Layanan</label>
                                        <input type="text" class="form-control" readonly placeholder="ID Layanan" name="id_layanan" id="id_layanan">
                                    </div>
                                    <div class="form-group col-lg-4 col-12">
                                        <label>Nama Layanan</label>
                                        <input type="text" class="form-control" readonly placeholder="Layanan" name="nama_layanan" id="nama_layanan">
                                    </div>
                                    <div class="form-group col-lg-4 col-12">
                                        <label>Harga Layanan</label>
                                        <input type="text" class="form-control" readonly placeholder="Harga" name="harga" id="harga">
                                    </div>
                                    <div class="form-group col-lg-4 col-12">
                                        <label>Diajukan Pada</label>
                                        <input type="text" class="form-control" readonly value="<?= date('d-m-Y H:i:s') ?> WIB" name="diajukan_pada" id="diajukan_pada">
                                    </div>
                                    <div class="form-group col-lg-12 col-12">
                                        <label>Keterangan Layanan</label>
                                        <input type="text" class="form-control" readonly placeholder="Deskripsi" name="deskripsi" id="deskripsi">
                                    </div>
                                    <div class="form-group col-lg-12 col-12">
                                        <label>Catatan / Alasan <i>(pengajuan tanpa alasan akan ditolak)</i></label>
                                        <textarea class="form-control" placeholder="Alasan Upgrade / Downgrade Speed" name="alasan" id="alasan" rows="3"></textarea>
                                    </div>
                                    <div class="form-group col-lg-12 col-12">
                                        <button type="submit" class="btn bg-primary form-control text-white">Ajukan Sekarang</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="form-addon">
                            <div class="row">
                                <div class="form-group col-lg-2 col-12">
                                    <select clas="form-control" name="mydeskripsi" id="mydeskripsi">
                                        <option value="">Silahkan Pilih</option>
                                        <?php
                                        $addon = $this->db->get_where('package_item', ['category_id' => 3])->result();
                                        foreach ($addon as $row2) {
                                        ?>
                                            <option value="<?= $row2->p_item_id ?>"><?= $row2->name ?> - Rp. <?= indo_currency($row1->price) ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <form action="<?= site_url('member/tambahlayanan') ?>" method="POST">
                                <div class="row">
                                    <div class="form-group col-lg-4 col-12">
                                        <label>Diajukan Oleh</label>
                                        <input type="hidden" class="form-control" readonly value="Tambah Layanan Add-On" name="judul_layanan" id="judul_layanan">
                                        <input type="text" class="form-control" readonly value="<?= $customer['name'] ?>" name="nama_pelanggan" id="nama_pelanggan">
                                    </div>
                                    <div class="form-group col-lg-4 col-12">
                                        <label>Nomor Layanan</label>
                                        <input type="text" class="form-control" readonly value="<?= $customer['no_services'] ?>" name="nomor_layanan" id="nomor_layanan">
                                    </div>
                                    <div class="form-group col-lg-4 col-12">
                                        <label>ID Layanan</label>
                                        <input type="text" class="form-control" readonly placeholder="ID Layanan" name="id_layanan" id="id_layanan">
                                    </div>
                                    <div class="form-group col-lg-4 col-12">
                                        <label>Nama Layanan</label>
                                        <input type="text" class="form-control" readonly placeholder="Layanan" name="nama_layanan" id="nama_layanan">
                                    </div>
                                    <div class="form-group col-lg-4 col-12">
                                        <label>Harga Layanan</label>
                                        <input type="text" class="form-control" readonly placeholder="Harga" name="harga" id="harga">
                                    </div>
                                    <div class="form-group col-lg-4 col-12">
                                        <label>Diajukan Pada</label>
                                        <input type="text" class="form-control" readonly value="<?= date('d-m-Y H:i:s') ?> WIB" name="diajukan_pada" id="diajukan_pada">
                                    </div>
                                    <div class="form-group col-lg-12 col-12">
                                        <label>Keterangan Layanan</label>
                                        <input type="text" class="form-control" readonly placeholder="Deskripsi" name="deskripsi" id="deskripsi">
                                    </div>
                                    <div class="form-group col-lg-12 col-12">
                                        <label>Catatan / Alasan <i>(pengajuan tanpa alasan akan ditolak)</i></label>
                                        <textarea class="form-control" placeholder="Alasan Tambah Layanan Add-On" name="alasan" id="alasan" rows="3"></textarea>
                                    </div>
                                    <div class="form-group col-lg-12 col-12">
                                        <button type="submit" class="btn bg-primary form-control text-white">Ajukan Sekarang</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="form-renew">
                            <div class="row">
                                <div class="form-group col-lg-12 col-12">
                                    <select clas="form-control" name="mydeskripsi" id="mydeskripsi">
                                        <option value="">Silahkan Pilih</option>
                                        <?php
                                        $renew = $this->db->get_where('package_item', ['category_id' => 4])->result();
                                        foreach ($renew as $row3) {
                                        ?>
                                            <option value="<?= $row3->p_item_id ?>"><?= $row3->name ?> - Rp. <?= indo_currency($row1->price) ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <form action="<?= site_url('member/tambahlayanan') ?>" method="POST">
                                <div class="row">
                                    <div class="form-group col-lg-4 col-12">
                                        <label>Diajukan Oleh</label>
                                        <input type="hidden" class="form-control" readonly value="Renew Speed (reset kuota)" name="judul_layanan" id="judul_layanan">
                                        <input type="text" class="form-control" readonly value="<?= $customer['name'] ?>" name="nama_pelanggan" id="nama_pelanggan">
                                    </div>
                                    <div class="form-group col-lg-4 col-12">
                                        <label>Nomor Layanan</label>
                                        <input type="text" class="form-control" readonly value="<?= $customer['no_services'] ?>" name="nomor_layanan" id="nomor_layanan">
                                    </div>
                                    <div class="form-group col-lg-4 col-12">
                                        <label>ID Layanan</label>
                                        <input type="text" class="form-control" readonly placeholder="ID Layanan" name="id_layanan" id="id_layanan">
                                    </div>
                                    <div class="form-group col-lg-4 col-12">
                                        <label>Nama Layanan</label>
                                        <input type="text" class="form-control" readonly placeholder="Layanan" name="nama_layanan" id="nama_layanan">
                                    </div>
                                    <div class="form-group col-lg-4 col-12">
                                        <label>Harga Layanan</label>
                                        <input type="text" class="form-control" readonly placeholder="Harga" name="harga" id="harga">
                                    </div>
                                    <div class="form-group col-lg-4 col-12">
                                        <label>Diajukan Pada</label>
                                        <input type="text" class="form-control" readonly value="<?= date('d-m-Y H:i:s') ?> WIB" name="diajukan_pada" id="diajukan_pada">
                                    </div>
                                    <div class="form-group col-lg-12 col-12">
                                        <label>Keterangan Layanan</label>
                                        <input type="text" class="form-control" readonly placeholder="Deskripsi" name="deskripsi" id="deskripsi">
                                    </div>
                                    <div class="form-group col-lg-12 col-12">
                                        <label>Catatan / Alasan <i>(pengajuan tanpa alasan akan ditolak)</i></label>
                                        <textarea class="form-control" placeholder="Alasan Renew Speed (reset kuota)" name="alasan" id="alasan" rows="3"></textarea>
                                    </div>
                                    <div class="form-group col-lg-12 col-12">
                                        <button type="submit" class="btn bg-primary form-control text-white">Ajukan Sekarang</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card shadow mb-2">
            <div class="card-header py-1">
                <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Riwayat Layanan</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box box-widget">
                            <div class="box-body table-responsive table-hover">
                                <table class="table ">
                                    <thead>
                                        <tr style="text-align: center">
                                            <th>No.</th>
                                            <th>Judul</th>
                                            <th>Layanan</th>
                                            <th>Catatan</th>
                                            <th>Status</th>
                                            <th>Pada</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $nomor_layanan = $customer['no_services'];
                                        $koneksi = mysqli_connect("localhost", "root", "", "naufal");
                                        $myquery = mysqli_query($koneksi, "SELECT * from layanan where nomor_layanan='$nomor_layanan' order by diajukan_pada DESC");
                                        while ($datagua = mysqli_fetch_array($myquery)) {
                                        ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $datagua['judul_layanan'] ?></td>
                                                <td><?= $datagua['nama_layanan'] ?></td>
                                                <td><?= $datagua['catatan_layanan'] ?></td>
                                                <td><?= $datagua['status_layanan'] ?></td>
                                                <td><?= $datagua['diajukan_pada'] ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {

        $('#mydeskripsi').change(function() {
            var id = $(this).val();
            $.ajax({
                url: "<?php echo site_url('member/getdata'); ?>",
                method: "POST",
                data: {
                    id: id
                },
                async: true,
                dataType: 'json',
                success: function(data) {

                    var deskripsi = '';
                    var harga = '';
                    var layanan = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        deskripsi = data[i].name + " - " + data[i].paket_wifi;
                        harga = data[i].price;
                        layanan = data[i].name;
                    }
                    document.getElementById("id_layanan").value = id;
                    document.getElementById("nama_layanan").value = layanan;
                    document.getElementById("deskripsi").value = deskripsi;
                    document.getElementById("harga").value = harga;

                }
            });
            return false;
        });

    });
</script>
<script>
    $(document).ready(function() {
        $("#form-upgrade").css("display", "none"); //Menghilangkan form-input ketika pertama kali dijalankan
        $(".upgrade").click(function() { //Memberikan even ketika class detail di klik (class detail ialah class radio button)
            if ($("input[name='upgrade']:checked").val() == "upgrade") { //Jika radio button "berbeda" dipilih maka tampilkan form-inputan
                $("#form-addon").css("display", "none"); //Menghilangkan form-input ketika pertama kali dijalankan
                $("#form-renew").css("display", "none"); //Menghilangkan form-input ketika pertama kali dijalankan
                $("#addon").css("display", "none"); //Menghilangkan form-input ketika pertama kali dijalankan
                $("#renew").css("display", "none"); //Menghilangkan form-input ketika pertama kali dijalankan
                $("#form-upgrade").slideDown("fast"); //Efek Slide Down (Menampilkan Form Input)
            } else {
                $("#form-addon").css("display", "none"); //Menghilangkan form-input ketika pertama kali dijalankan
                $("#form-renew").css("display", "none"); //Menghilangkan form-input ketika pertama kali dijalankan
                $("#addon").css("display", "inline"); //Menghilangkan form-input ketika pertama kali dijalankan
                $("#renew").css("display", "inline"); //Menghilangkan form-input ketika pertama kali dijalankan
                $("#form-upgrade").slideUp("fast"); //Efek Slide Up (Menghilangkan Form Input)
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $("#form-addon").css("display", "none"); //Menghilangkan form-input ketika pertama kali dijalankan
        $(".addon").click(function() { //Memberikan even ketika class detail di klik (class detail ialah class radio button)
            if ($("input[name='addon']:checked").val() == "addon") { //Jika radio button "berbeda" dipilih maka tampilkan form-inputan
                $("#form-upgrade").css("display", "none"); //Menghilangkan form-input ketika pertama kali dijalankan
                $("#form-renew").css("display", "none"); //Menghilangkan form-input ketika pertama kali dijalankan
                $("#upgrade").css("display", "none"); //Menghilangkan form-input ketika pertama kali dijalankan
                $("#renew").css("display", "none"); //Menghilangkan form-input ketika pertama kali dijalankan
                $("#form-addon").slideDown("fast"); //Efek Slide Down (Menampilkan Form Input)
            } else {
                $("#form-upgrade").css("display", "none"); //Menghilangkan form-input ketika pertama kali dijalankan
                $("#form-renew").css("display", "none"); //Menghilangkan form-input ketika pertama kali dijalankan
                $("#upgrade").css("display", "inline"); //Menghilangkan form-input ketika pertama kali dijalankan
                $("#renew").css("display", "inline"); //Menghilangkan form-input ketika pertama kali dijalankan
                $("#form-addon").slideUp("fast"); //Efek Slide Up (Menghilangkan Form Input)
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $("#form-renew").css("display", "none"); //Menghilangkan form-input ketika pertama kali dijalankan
        $(".renew").click(function() { //Memberikan even ketika class detail di klik (class detail ialah class radio button)
            if ($("input[name='renew']:checked").val() == "renew") { //Jika radio button "berbeda" dipilih maka tampilkan form-inputan
                $("#form-upgrade").css("display", "none"); //Menghilangkan form-input ketika pertama kali dijalankan
                $("#form-addon").css("display", "none"); //Menghilangkan form-input ketika pertama kali dijalankan
                $("#upgrade").css("display", "none"); //Menghilangkan form-input ketika pertama kali dijalankan
                $("#addon").css("display", "none"); //Menghilangkan form-input ketika pertama kali dijalankan
                $("#form-renew").slideDown("fast"); //Efek Slide Down (Menampilkan Form Input)
            } else {
                $("#form-upgrade").css("display", "none"); //Menghilangkan form-input ketika pertama kali dijalankan
                $("#form-addon").css("display", "none"); //Menghilangkan form-input ketika pertama kali dijalankan
                $("#upgrade").css("display", "inline"); //Menghilangkan form-input ketika pertama kali dijalankan
                $("#addon").css("display", "inline"); //Menghilangkan form-input ketika pertama kali dijalankan
                $("#form-renew").slideUp("fast"); //Efek Slide Up (Menghilangkan Form Input)
            }
        });
    });
</script>