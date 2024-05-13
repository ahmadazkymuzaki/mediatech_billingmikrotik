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
    <div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
        <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
            <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Tambah Pelanggan (<font style="color: red; font-weight: bold;">*</font> = Wajib di Isi)</h6>
        </div>
        <div class="card-body">
            <?php echo form_open_multipart('customer/add') ?>
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                    <div class="form-group">
                        <label for="name">Nama Pelanggan <font style="color: red; font-weight: bold;">*</font></label>
                        <input type="text" id="name" name="name" class="form-control" value="<?= set_value('name') ?>" required>
                        <?= form_error('name', '<small class="text-danger pl-3 ">', '</small>') ?>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="gender">Jenis Kelamin <font style="color: red; font-weight: bold;">*</font></label>
                            <select name="gender" id="gender" class="form-control" required>
                                <option value="">-- Pilih KELAMIN -- </option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="no_ktp">Nomor Layanan <font style="color: red; font-weight: bold;">*</font></label>
                            <input type="number" id="no_services" name="no_services" class="form-control" placeholder="<?= date('ymdHis'); ?>" value="<?= date('ymdHis'); ?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="type_id">Pilih ID Card <font style="color: red; font-weight: bold;">*</font></label>
                            <select name="type_id" id="type_id" class="form-control" required>
                                <option value="">-- Pilih ID CARD -- </option>
                                <option value="KTP">KTP</option>
                                <option value="NPWP">NPWP</option>
                                <option value="SIM">SIM</option>
                                <option value="PASPOR">PASPOR</option>
                                <option value="KIS">KIS</option>
                                <option value="BPJS">BPJS</option>
                                <option value="LAINNYA">Lainnya</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="no_ktp">Nomor ID Card <font style="color: red; font-weight: bold;">*</font></label>
                            <input type="number" id="no_ktp" name="no_ktp" class="form-control" value="35<?= date('YmdHis'); ?>" required>
                            <?= form_error('no_ktp', '<small class="text-danger pl-3 ">', '</small>') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ktp">Gambar ID Card <font style="color: red; font-weight: bold;">*</font></label>
                        <input type="file" id="ktp" name="ktp" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email / Akun Login <font style="color: red; font-weight: bold;">*</font></label>
                        <input type="text" id="email" name="email" class="form-control" value="@gmail.com" required>
                        <input type="hidden" class="form-control form-control-user" id="Password1" name="password1" value="pelanggan">
                        <input type="hidden" class="form-control form-control-user" id="Password2" name="password2" value="pelanggan">
                        <?= form_error('email', '<small class="text-danger pl-3 ">', '</small>') ?>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="no_wa">Telepon (WA) <font style="color: red; font-weight: bold;">*</font></label>
                            <input type="number" id="no_wa" name="no_wa" class="form-control" value="08<?= date('ydHis'); ?>" required>
                            <?= form_error('no_wa', '<small class="text-danger pl-3 ">', '</small>') ?>
                        </div>
                        <div class="col-sm-6">
                            <label for="due_date">Tgl. Jatuh Tempo <font style="color: red; font-weight: bold;">*</font></label>
                            <input type="number" id="due_date" name="due_date" autocomplete="off" class="form-control" min="0" max="31" value="" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="jenis">Jenis Tagihan <font style="color: red; font-weight: bold;">*</font></label>
                            <select name="jenis" id="jenis" class="form-control" required>
                                <option value="">-- Pilih TAGIHAN --</option>
                                <option value="PRABAYAR">PRABAYAR</option>
                                <option value="PASCABAYAR">PASCABAYAR</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="paket">Paket Langganan <font style="color: red; font-weight: bold;">*</font></label>
                            <?php $item = $this->db->get('package_item')->result(); ?>
                            <select name="paket" id="paket" class="form-control" required>
                                <option value="">-- Pilih PAKET --</option>
                                <?php foreach ($item as $item) { ?>
                                    <option value="<?= $item->p_item_id ?>">#<?= $item->p_item_id ?> <?= $item->name ?> - Rp. <?= indo_currency($item->price); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="prorata">Tagihan Prorata <font style="color: red; font-weight: bold;">*</font></label>
                            <select name="prorata" id="prorata" class="form-control" required>
                                <option value="">-- Pilih PRORATA --</option>
                                <option value="1">Iya</option>
                                <option value="0">Tidak</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="hitung">Pemakaian <font style="color: red; font-weight: bold;">*</font></label>
                            <div class="input-group">
                                <input type="number" name="hitung" id="hitung" class="form-control" placeholder="1" aria-label="1" value="0" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2">Hari</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="ppn">Kena PPN <?= $company['ppn'] ?>% <font style="color: red; font-weight: bold;">*</font></label>
                            <select class="form-control" id="ppn" name="ppn" required>
                                <option value="">-- Pilih PAJAK --</option>
                                <option value="1">Iya</option>
                                <option value="0">Tidak</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="code_unique">Kena Kode Unik <font style="color: red; font-weight: bold;">*</font></label>
                            <select class="form-control" id="code_unique" name="code_unique" required>
                                <option value="">-- Pilih KODE UNIK --</option>
                                <option value="1">Iya</option>
                                <option value="0">Tidak</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="coverage">Coverage Area <font style="color: red; font-weight: bold;">*</font></label>
                            <select name="coverage" id="coverage" class="form-control" required>
                                <option value="">-- Pilih AREA -- </option>
                                <?php
                                $area = $this->db->get_where('coverage', ['kategori' => 'AREA'])->result();
                                foreach ($area as $data) {
                                ?>
                                    <option value="<?= $data->coverage_id ?>">#<?= $data->coverage_id ?> <?= $data->c_name ?> (<?= $data->address ?> - <?= $data->comment ?>)</option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="pemilik_rumah">Pemilik Rumah <font style="color: red; font-weight: bold;">*</font></label>
                            <input type="text" id="pemilik_rumah" name="pemilik_rumah" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat Singkat <font style="color: red; font-weight: bold;">*</font></label>
                        <input type="text" id="address" name="address" class="form-control" value="-" required>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan Singkat <font style="color: red; font-weight: bold;">*</font></label>
                        <input type="text" id="keterangan" name="keterangan" class="form-control" value="-" required>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="saldo">Saldo Akun <font style="color: red; font-weight: bold;">*</font></label>
                            <input type="number" id="saldo" name="saldo" class="form-control" value="0" placeholder="0" required>
                        </div>
                        <div class="col-sm-6">
                            <label for="no_ktp">PIN Transaksi <font style="color: red; font-weight: bold;">*</font></label>
                            <input type="number" id="pin_trx" name="pin_trx" class="form-control" placeholder="<?= date('His'); ?>" value="<?= date('His'); ?>" required>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="mode">Mode Pelanggan <font style="color: red; font-weight: bold;">*</font></label>
                            <select name="mode" id="mode" onchange="showForm(this)" class="form-control" required>
                                <option value="">-- Pilih MODE -- </option>
                                <option value="PPPOE">PPPOE</option>
                                <option value="HOTSPOT">HOTSPOT</option>
                                <option value="STATIC">STATIC</option>
                                <option value="LAINNYA">LAINNYA</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="coverage">Pilih Router <font style="color: red; font-weight: bold;">*</font></label>
                            <select name="router" id="router" class="form-control" required>
                                <option value="">-- Pilih ROUTER -- </option>
                                <?php
                                $router = $this->db->get('router')->result();
                                foreach ($router as $datarouter) {
                                ?>
                                    <option value="<?= $datarouter->name_router ?>"><?= $datarouter->name_router ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="kode_odp">Pilih Kode ODP <font style="color: red; font-weight: bold;">*</font></label>
                            <select name="kode_odp" id="kode_odp" class="form-control" required>
                                <option value="">-- Pilih ODP -- </option>
                                <option value="Tanpa ODP">Tanpa ODP</option>
                                <?php
                                $odp = $this->db->get_where('coverage', ['kategori' => 'ODP'])->result();
                                foreach ($odp as $data) {
                                ?>
                                    <option value="<?= $data->c_name ?>">#<?= $data->coverage_id ?> <?= $data->c_name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="port_odp">Port di ODP <font style="color: red; font-weight: bold;">*</font></label>
                            <input type="text" id="port_odp" name="port_odp" class="form-control" value="-" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="server">Pilih Server <font style="color: red; font-weight: bold;">*</font></label>
                            <select name="server" id="server" class="form-control" required>
                                <option value="">-- Pilih SERVER -- </option>
                                <option value="Server PPPOE">Server PPPOE</option>
                                <option value="Server STATIC">Server STATIC</option>
                                <?php foreach ($hotspotserver as $data) { ?>
                                    <option value="<?= $data['name'] ?>"><?= $data['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="paket_wifi">Pilih Profile / Parent <font style="color: red; font-weight: bold;">*</font></label>
                            <select name="paket_wifi" id="paket_wifi" class="form-control" required>
                                <option value="">-- Pilih PROFILE -- </option>
                                <option value="-">=== Profile PPPOE ===</option>
                                <?php foreach ($pppprofile as $data) { ?>
                                    <option value="<?= $data['name'] ?>"><?= $data['name'] ?></option>
                                <?php } ?>
                                <option value="-">=== Profile HOTSPOT ===</option>
                                <?php foreach ($hotspotprofile as $data) { ?>
                                    <option value="<?= $data['name'] ?>"><?= $data['name'] ?></option>
                                <?php } ?>
                                <option value="-">=== Parent QUEUE ===</option>
                                <?php foreach ($pppstatic as $data) { ?>
                                    <option value="<?= $data['name'] ?>"><?= $data['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" id="formusername">
                        <div class="col-sm-6" id="formusername">
                            <label for="username" id="formusername">Username <font style="color: red; font-weight: bold;">*</font></label>
                            <input type="text" id="username" name="username" placeholder="Username" class="form-control" value="-" required>
                        </div>
                        <div class="col-sm-6" id="formpassword">
                            <label for="password" id="formpassword">Password <font style="color: red; font-weight: bold;">*</font></label>
                            <input type="text" id="password" placeholder="Password" name="password" class="form-control" value="-" required>
                        </div>
                    </div>
                    <div class="form-group row" id="formupload">
                        <div class="col-sm-6" id="formupload">
                            <label for="upload" id="formupload">Limit Upload <font style="color: red; font-weight: bold;">*</font></label>
                            <div class="input-group" id="formupload">
                                <input type="text" name="upload" id="upload" class="form-control" placeholder="1M" aria-label="1" aria-describedby="basic-addon2" value="-" required>
                                <span class="input-group-text" id="basic-addon2">bps</span>
                            </div>
                        </div>
                        <div class="col-sm-6" id="formdownload">
                            <label for="download" id="formdownload">Limit Download <font style="color: red; font-weight: bold;">*</font></label>
                            <div class="input-group" id="formdownload">
                                <input type="text" name="download" id="download" class="form-control" placeholder="1M" aria-label="1" aria-describedby="basic-addon2" value="-" required>
                                <span class="input-group-text" id="basic-addon2">bps</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6" id="formip_address">
                            <label for="ip_address" id="formip_address">IP Address <font style="color: red; font-weight: bold;">*</font></label>
                            <input type="text" id="ip_address" name="ip_address" placeholder="192.168.1.1" class="form-control" value="-" required>
                        </div>
                        <div class="col-sm-6">
                            <label for="refferal">Kode Refferal <font style="color: red; font-weight: bold;">*</font></label>
                            <input type="number" id="refferal" name="refferal" class="form-control" value="<?= $user['no_services'] ?>" palecholder="<?= date('ymdHis'); ?>" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="latitude">Latitude <font style="color: red; font-weight: bold;">*</font></label>
                            <div class="input-group mb-2">
                                <input id="latitude" type="text" name="latitude" class="form-control" required>
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-map-marker"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="longitude">Longitude <font style="color: red; font-weight: bold;">*</font></label>
                            <div class="input-group mb-2">
                                <input id="longitude" type="text" name="longitude" class="form-control" required>
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-map-marker"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-12 col-md-12">
                            <div id="map" style="width: 100%; height: 320px;"></div>
                            <script>
                                var peta1 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiYWhtYWRhemt5bXV6YWtpIiwiYSI6ImNsdjMwYm5uZzBvdm0ya3A4dm01NmZsNHMifQ.p13nKazxCKdZq8ZTkq2PTw', {
                                    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                                        '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                                        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                                    id: 'mapbox/streets-v11'
                                });

                                var peta2 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiYWhtYWRhemt5bXV6YWtpIiwiYSI6ImNsdjMwYm5uZzBvdm0ya3A4dm01NmZsNHMifQ.p13nKazxCKdZq8ZTkq2PTw', {
                                    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                                        '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                                        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                                    id: 'mapbox/satellite-v9'
                                });


                                var peta3 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                                });

                                var peta4 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiYWhtYWRhemt5bXV6YWtpIiwiYSI6ImNsdjMwYm5uZzBvdm0ya3A4dm01NmZsNHMifQ.p13nKazxCKdZq8ZTkq2PTw', {
                                    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                                        '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                                        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                                    id: 'mapbox/dark-v10'
                                });

                                var baseMaps = {
                                    "Mode Terang": peta1,
                                    "Mode Gambar": peta2,
                                    "Mode Jalan": peta3,
                                    "Mode Gelap": peta4
                                };

                                var curLocation = [0, 0];
                                if (curLocation[0] == 0 && curLocation[1] == 0) {
                                    curLocation = [<?= $company['latitude'] ?>, <?= $company['longitude'] ?>];
                                }
                                var map = L.map('map').setView([<?= $company['latitude'] ?>, <?= $company['longitude'] ?>], 16);

                                L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiYWhtYWRhemt5bXV6YWtpIiwiYSI6ImNsdjMwYm5uZzBvdm0ya3A4dm01NmZsNHMifQ.p13nKazxCKdZq8ZTkq2PTw', {
                                    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                                        '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                                        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                                    id: 'mapbox/satellite-v9',
                                    tileSize: 512,
                                    zoomOffset: -1
                                }).addTo(map);

                                map.attributionControl.setPrefix(false);

                                var marker = new L.marker(curLocation, {
                                    draggable: 'true'
                                });

                                marker.on('dragend', function(event) {
                                    var position = marker.getLatLng();
                                    marker.setLatLng(position, {
                                        draggable: 'true'
                                    }).bindPopup(position).update();
                                    $('#latitude').val(position.lat);
                                    $('#longitude').val(position.lng).keyup();
                                })

                                $('#latitude, #longitude').change(function() {
                                    var position = [parseInt($('#latitude').val()), parseInt($('#longitude').val())];
                                    marker.setLatLng(position, {
                                        draggable: 'true'
                                    }).bindPopup(position).update();
                                    map.panTo(position);
                                });

                                map.addLayer(marker);

                                L.control.layers(baseMaps).addTo(map);
                            </script>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="role_id">Level Pengguna <font style="color: red; font-weight: bold;">*</font></label>
                            <select name="role_id" id="role_id" class="form-control" required>
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
                        </div>
                        <div class="col-sm-6">
                            <label for="c_status">Status Pelanggan <font style="color: red; font-weight: bold;">*</font></label>
                            <select name="c_status" id="c_status" class="form-control" required>
                                <option value="">-- Pilih STATUS --</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Non-Aktif">Non-Aktif</option>
                                <option value="Menunggu">Menunggu</option>
                                <option value="Gratis">Gratis</option>
                                <option value="Isolir">Isolir</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="register_date">Tanggal Daftar <font style="color: red; font-weight: bold;">*</font></label>
                            <input type="date" id="register_date" name="register_date" class="form-control" required>
                        </div>
                        <div class="col-sm-6">
                            <label for="register_date">Didaftarkan Oleh</label>
                            <input type="text" id="register_name" name="register_name" class="form-control" value="<?= $user['name'] ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mt-4">
                            <button type="reset" class="btn btn-secondary form-control" data-dismiss="modal">Reset</button>
                        </div>
                        <div class="col-sm-6 mt-4">
                            <button type="submit" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?> form-control">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>
<script type="text/javascript">

    $('#upload').hide();
    document.getElementById("upload").value = "-";
    $('#download').hide();
    document.getElementById("download").value = "-";
    $('#ip_address').hide();
    document.getElementById("ip_address").value = "-";
    $('#username').hide();
    document.getElementById("username").value = "-";
    $('#password').hide();
    document.getElementById("password").value = "-";
    $('#formupload').hide();
    $('#formdownload').hide();
    $('#formip_address').hide();
    $('#formpassword').hide();
    $('#formusername').hide();
    
    function showForm(select){
       if(select.value=='PPPOE'){
           $('#upload').hide();
           document.getElementById("upload").value = "-";
           $('#download').hide();
           document.getElementById("download").value = "-";
           $('#ip_address').hide();
           document.getElementById("ip_address").value = "-";
           $('#username').show();
           document.getElementById("username").value = "";
           $('#password').show();
           document.getElementById("password").value = "";
           $('#formupload').hide();
           $('#formdownload').hide();
           $('#formip_address').hide();
           $('#formpassword').show();
           $('#formusername').show();
       }
       else if(select.value=='HOTSPOT'){
           $('#upload').hide();
           document.getElementById("upload").value = "-";
           $('#download').hide();
           document.getElementById("download").value = "-";
           $('#ip_address').hide();
           document.getElementById("ip_address").value = "-";
           $('#username').show();
           document.getElementById("username").value = "";
           $('#password').show();
           document.getElementById("password").value = "";
           $('#formupload').hide();
           $('#formdownload').hide();
           $('#formip_address').hide();
           $('#formpassword').show();
           $('#formusername').show();
       }
       else if(select.value=='STATIC'){
           $('#upload').show();
           document.getElementById("upload").value = "";
           $('#download').show();
           document.getElementById("download").value = "";
           $('#ip_address').show();
           document.getElementById("ip_address").value = "";
           $('#username').hide();
           document.getElementById("username").value = "-";
           $('#password').hide();
           document.getElementById("password").value = "-";
           $('#formupload').show();
           $('#formdownload').show();
           $('#formip_address').show();
           $('#formpassword').hide();
           $('#formusername').hide();
       }
       else if(select.value=='LAINNYA'){
           $('#upload').hide();
           document.getElementById("upload").value = "-";
           $('#download').hide();
           document.getElementById("download").value = "-";
           $('#ip_address').hide();
           document.getElementById("ip_address").value = "-";
           $('#username').hide();
           document.getElementById("username").value = "-";
           $('#password').hide();
           document.getElementById("password").value = "-";
           $('#formupload').hide();
           $('#formdownload').hide();
           $('#formip_address').hide();
           $('#formpassword').hide();
           $('#formusername').hide();
       }
    } 
</script>
<script>
    $(function() {
        $("#generatenoservices").click(function() {
            var m = new Date();
            var th = m.getFullYear().toString().substr(-2);
            var dateString =
                th +
                ("0" + (m.getMonth() + 1)).slice(-2) +
                ("0" + m.getDate()).slice(-2) +
                ("0" + m.getHours()).slice(-2) +
                ("0" + m.getMinutes()).slice(-2) +
                ("0" + m.getSeconds()).slice(-2);

            $("#no_services").val(dateString);

        });
    });
</script>