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
    <div class="col-12">
        <div class="card shadow mb-3" style="border: solid 1px grey;">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Upgrade / Downgrade Layanan</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="form-upgrade">
                            <form action="<?= site_url('member/tambahlayanan') ?>" method="POST">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <select class="form-control" name="mydeskripsi" id="mydeskripsi">
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
                                </div>
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
                                        <label>Diajukan Pada</label>
                                        <input type="text" class="form-control" readonly value="<?= date('d/m/Y H:i:s') ?> WIB" name="diajukan_pada" id="diajukan_pada">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>