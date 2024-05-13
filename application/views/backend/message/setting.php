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
    <div class="col-lg-6">
        <div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
            <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
                <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Setting Router</h6>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-body">
                        <?php echo form_open_multipart('mikrotik/editrouter') ?>
                        <div class="form-group">
                            <input type="hidden" name="router_id" value="<?= $router['router_id'] ?>">
                            <label for="host_router">Host / IP Address</label>
                            <input type="text" id="host_router" name="host_router" class="form-control" value="<?= $router['host_router'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="port_router">Port API MikroTik</label>
                            <input type="number" id="port_router" name="port_router" class="form-control" value="<?= $router['port_router'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="user_router">Username Login</label>
                            <input type="text" id="user_router" name="user_router" class="form-control" value="<?= $router['user_router'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="pass_router">Password Login</label>
                            <input type="text" id="pass_router" name="pass_router" class="form-control" value="<?= $router['pass_router'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="description">Deskripsi Router</label>
                            <textarea type="text" rows="6" id="description" name="description" class="form-control" required><?= $router['description'] ?></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Reset</button>
                        <button type="submit" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>">Simpan</button>
                    </div>
                </div>
                <?php echo form_close() ?>


            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
            <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
                <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Catatan</h6>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-body">
                        <p>Secara Default :<br>
                            - Address = 192.168.88.1<br>
                            - Username = admin<br>
                            - Password = (dikosongkan)<br>
                            - Port API = 8728<br>
                        </p>
                        <p align="justify" style="margin-bottom: -5px;"><b>17 Langkah Mengamankan ROUTER MIKROTIK :</b><br>
                            - Ubah username & password secara Berkala<br>
                            - Disable service yang tidak diperlukan<br>
                            - Mengubah port service yang sering digunakan<br>
                            - Membatasi akses ke Router dari IP tertentu<br>
                            - Mengaktifkan secure SSH dan Telnet<br>
                            - Disable settingan Neighbors Discovery<br>
                            - Disable atau mengubah fitur MAC Server<br>
                            - Disable Interface yang tidak digunakan<br>
                            - Disable fitur Bandwidth Test Server<br>
                            - Disable Client Services yang tidak digunakan<br>
                            - Disable atau Gunakan PIN pada LCD<br>
                            - Mengaktifkan fitur Wireless Client Isolation<br>
                            - Proteksi Settingan DNS dan Web Proxy<br>
                            - Menggunakan Firewall Rule untuk keamanan<br>
                            - Lakukan Backup System / Export Konfigurasi<br>
                            - Monitoring Router Mikrotik secara Berkala<br>
                            - Perbaru versi RouterOS Mikrotik secara Berkala<br>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <center>Tutorial by : <a href="https://www.facebook.com/ayenkmarley" target="_blank" style="color: black; font-weight: bold; text-decoration: none;">Coach Ayenk Marley</a></center>
                    </div>
                </div>
                <?php echo form_close() ?>


            </div>
        </div>
    </div>
</div>