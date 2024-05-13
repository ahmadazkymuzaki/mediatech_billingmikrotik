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
    <div class="col-lg-6">
        <div class="card shadow mb-3" style="border: solid 1px grey;">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Registrasi Member</h6>
            </div>
            <div class="card-body">
                <?php echo form_open_multipart('member/add') ?>
                <div class="form-group">
                    <label for="name">Nama Pelanggan</label>
                    <input type="text" id="name" name="name" class="form-control" value="<?= set_value('name') ?>">
                    <input type="hidden" id="no_services" name="no_services" class="form-control" value="<?= date('ymdHis'); ?>" readonly>
                    <?= form_error('name', '<small class="text-danger pl-3 ">', '</small>') ?>
                </div>
                <div class="form-group">
                    <label for="email">Email / Akun Login</label>
                    <input type="text" id="email" name="email" class="form-control" value="@gmail.com">
                    <input type="hidden" class="form-control form-control-user" id="Password1" name="password1" value="pelanggan">
                    <input type="hidden" class="form-control form-control-user" id="Password2" name="password2" value="pelanggan">
                    <?= form_error('email', '<small class="text-danger pl-3 ">', '</small>') ?>
                </div>
                <div class="form-group">
                    <label for="no_ktp">Nomor NIK KTP</label>
                    <input type="number" id="no_ktp" name="no_ktp" class="form-control" value="35<?= date('YmdHis'); ?>">
                    <?= form_error('no_ktp', '<small class="text-danger pl-3 ">', '</small>') ?>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="no_wa">Telepon / WhatsApp</label>
                        <input type="number" id="no_wa" name="no_wa" class="form-control" value="08<?= date('ydHis'); ?>">
                        <?= form_error('no_wa', '<small class="text-danger pl-3 ">', '</small>') ?>
                    </div>
                    <div class="col-sm-6">
                        <label for="due_date">Tanggal Jatuh Tempo</label>
                        <input type="number" id="due_date" name="due_date" autocomplete="off" class="form-control" min="0" max="31" value="0">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="status">Status Pelanggan</label>
                        <select name="status" id="" class="form-control" required>
                            <option value="">-Pilih-</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Non-Aktif">Non-Aktif</option>
                            <option value="Menunggu">Menunggu</option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label for="ppn">PPN</label>
                        <select class="form-control" id="ppn" name="ppn" required>
                            <option value="">-Pilih-</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="paket">Paket Langganan</label>
                        <?php $item = $this->db->get_where('package_item', array('public' => 1))->result() ?>
                        <select name="paket" id="paket" class="form-control" required>
                            <option value="">-Pilih-</option>
                            <?php foreach ($item as $item) { ?>
                                <option value="<?= $item->p_item_id ?>"><?= $item->name ?> - Rp. <?= indo_currency($item->price); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label for="coverage">Coverage Area</label>
                        <select name="coverage" id="coverage" class="form-control">
                            <?php if ($customer->coverage == 0) { ?>
                                <option value="">-Pilih-</option>
                            <?php } ?>
                            <?php if ($customer->coverage != 0) { ?>
                                <?php $datacoverage = $this->db->get_where('coverage', ['coverage_id' => $customer->coverage])->row_array(); ?>
                                <option value="<?= $customer->coverage ?>"><?= $datacoverage['c_name'] ?> (<?= $datacoverage['address'] ?> - <?= $datacoverage['comment'] ?>)</option>
                            <?php } ?>
                            <?php foreach ($coverage as $data) { ?>
                                <option value="<?= $data->coverage_id ?>"><?= $data->c_name ?> (<?= $data->address ?> - <?= $data->comment ?>)</option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="coverage">Pilih Server</label>
                        <select name="server" id="server" class="form-control" required>
                            <option value="">-- Pilih Server -- </option>
                            <?php
                            $router = $this->db->get_where('router')->result();
                            foreach ($router as $datarouter) {
                            ?>
                                <option value="<?= $datarouter->name_router ?>"><?= $datarouter->name_router ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label for="due_date">Kode Refferal</label>
                        <input type="text" id="refferal" name="refferal" value="<?= $user['no_services'] ?>" class="form-control" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="due_date">Pemilik Rumah</label>
                        <input type="text" id="pemilik_rumah" name="pemilik_rumah" class="form-control">
                    </div>
                    <div class="col-sm-6">
                        <label for="due_date">Tanggal Daftar</label>
                        <input type="text" id="register_date" name="register_date" class="form-control" value="<?= date('d/m/Y H:i:s') ?> WIB" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Reset</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>