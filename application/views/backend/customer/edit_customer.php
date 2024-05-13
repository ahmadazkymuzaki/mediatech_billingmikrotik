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
            <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Edit Pelanggan (<font style="color: red; font-weight: bold;">*</font> = Wajib di Isi)</h6>
        </div>
        <div class="card-body">
            <?php echo form_open_multipart('') ?>
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                    <div class="form-group">
                        <label for="name">Nama Pelanggan <font style="color: red; font-weight: bold;">*</font></label>
                        <input type="hidden" id="customer_id" name="customer_id" class="form-control" value="<?= $customer['customer_id'] ?>" readonly>
                        <input type="text" id="name" name="name" class="form-control" value="<?= $customer['name'] ?>" required>
                        <?= form_error('name', '<small class="text-danger pl-3 ">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <label for="email">Email / Akun Login <font style="color: red; font-weight: bold;">*</font></label>
                        <input type="text" id="email" name="email" class="form-control" value="<?= $customer['email'] ?>" required>
                        <input type="hidden" class="form-control form-control-user" id="Password1" name="password1" value="pelanggan">
                        <input type="hidden" class="form-control form-control-user" id="Password2" name="password2" value="pelanggan">
                        <?= form_error('email', '<small class="text-danger pl-3 ">', '</small>') ?>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="type_id">Pilih ID Card <font style="color: red; font-weight: bold;">*</font></label>
                            <select name="type_id" id="type_id" class="form-control" required>
                                <option value="<?= $customer['type_id'] ?>"><?= $customer['type_id'] ?></option>
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
                            <input type="number" id="no_ktp" name="no_ktp" class="form-control" value="<?= $customer['no_ktp'] ?>" required>
                            <?= form_error('no_ktp', '<small class="text-danger pl-3 ">', '</small>') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ktp">Gambar ID Card</label>
                        <input type="file" id="ktp" name="ktp" class="form-control">
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="no_wa">Telepon (WA) <font style="color: red; font-weight: bold;">*</font></label>
                            <input type="number" id="no_wa" name="no_wa" class="form-control" value="<?= $customer['no_wa'] ?>" required>
                            <?= form_error('no_wa', '<small class="text-danger pl-3 ">', '</small>') ?>
                        </div>
                        <div class="col-sm-6">
                            <label for="due_date">Tgl. Jatuh Tempo <font style="color: red; font-weight: bold;">*</font></label>
                            <input type="number" id="due_date" name="due_date" autocomplete="off" class="form-control" min="0" max="31" value="<?= $customer['due_date'] ?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="jenis">Jenis Tagihan <font style="color: red; font-weight: bold;">*</font></label>
                            <select name="jenis" id="jenis" class="form-control" required>
                                <option value="<?= $customer['jenis'] ?>"><?= $customer['jenis'] ?></option>
                                <option value="PRABAYAR">PRABAYAR</option>
                                <option value="PASCABAYAR">PASCABAYAR</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="paket">Paket Langganan <font style="color: red; font-weight: bold;">*</font></label>
                            <?php
                            $dataItem = $this->db->get_where('package_item', ['p_item_id' => $customer['item_paket']])->row_array();
                            $item = $this->db->get('package_item')->result();
                            ?>
                            <select name="paket" id="paket" class="form-control" required>
                                <option value="<?= $dataItem['p_item_id'] ?>">#<?= $dataItem['p_item_id'] ?> <?= $dataItem['name'] ?> - Rp. <?= indo_currency($dataItem['price']); ?></option>
                                <?php foreach ($item as $item) { ?>
                                    <option value="<?= $item->p_item_id ?>">#<?= $item->p_item_id ?> <?= $item->name ?> - Rp. <?= indo_currency($item->price); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="prorata">Tagihan Prorata <font style="color: red; font-weight: bold;">*</font></label>
                            <input type="number" name="prorata" id="prorata" class="form-control" placeholder="1" aria-label="1" value="0" aria-describedby="basic-addon2" readonly>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="hitung">Pemakaian <font style="color: red; font-weight: bold;">*</font></label>
                            <div class="input-group">
                                <input type="number" name="hitung" id="hitung" class="form-control" placeholder="1" aria-label="1" value="0" aria-describedby="basic-addon2" readonly>
                                <span class="input-group-text" id="basic-addon2">Hari</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="ppn">Kena PPN <?= $company['ppn'] ?>% <font style="color: red; font-weight: bold;">*</font></label>
                            <select class="form-control" id="ppn" name="ppn" required>
                                <option value="<?= $customer['ppn'] ?>"><?= $customer['ppn'] == 1 ? 'Iya' : 'Tidak' ?></option>
                                <option value="1">Iya</option>
                                <option value="0">Tidak</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="code_unique">Kena Kode Unik <font style="color: red; font-weight: bold;">*</font></label>
                            <select class="form-control" id="code_unique" name="code_unique" required>
                                <option value="<?= $customer['code_unique'] ?>"><?= $customer['code_unique'] == 1 ? 'Iya' : 'Tidak' ?></option>
                                <option value="1">Iya</option>
                                <option value="0">Tidak</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="coverage">Coverage Area <font style="color: red; font-weight: bold;">*</font></label>
                            <?php
                            $dataCoverage = $this->db->get_where('coverage', ['coverage_id' => $customer['coverage']])->row_array();
                            $area = $this->db->get_where('coverage', ['kategori' => 'AREA'])->result();
                            ?>
                            <select name="coverage" id="coverage" class="form-control" required>
                                <option value="<?= $dataCoverage['coverage_id'] ?>">#<?= $dataCoverage['coverage_id'] ?> <?= $dataCoverage['c_name'] ?> (<?= $dataCoverage['address'] ?> - <?= $dataCoverage['comment'] ?>)</option>
                                <?php
                                foreach ($area as $data) {
                                ?>
                                    <option value="<?= $data->coverage_id ?>">#<?= $data->coverage_id ?> <?= $data->c_name ?> (<?= $data->address ?> - <?= $data->comment ?>)</option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="pemilik_rumah">Pemilik Rumah <font style="color: red; font-weight: bold;">*</font></label>
                            <input type="text" id="pemilik_rumah" name="pemilik_rumah" class="form-control" value="<?= $customer['pemilik_rumah'] ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat Singkat <font style="color: red; font-weight: bold;">*</font></label>
                        <input type="text" id="address" name="address" class="form-control" value="<?= $customer['address'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan Singkat <font style="color: red; font-weight: bold;">*</font></label>
                        <input type="text" id="keterangan" name="keterangan" class="form-control" value="<?= $customer['keterangan'] ?>" required>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="saldo">Jumlah Telat <font style="color: red; font-weight: bold;">*</font></label>
                            <input type="number" id="telat" name="telat" class="form-control" value="<?= $customer['telat'] ?>" placeholder="0" required>
                        </div>
                        <div class="col-sm-6">
                            <label for="no_ktp">Nomor Layanan <font style="color: red; font-weight: bold;">*</font></label>
                            <input type="number" id="no_services" name="no_services" class="form-control" placeholder="<?= $customer['no_services'] ?>" value="<?= $customer['no_services'] ?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="mode">Mode Pelanggan <font style="color: red; font-weight: bold;">*</font></label>
                            <select name="mode" id="mode" class="form-control" required>
                                <option value="<?= $customer['mode'] ?>"><?= $customer['mode'] ?></option>
                                <option value="PPPOE">PPPOE</option>
                                <option value="HOTSPOT">HOTSPOT</option>
                                <option value="STATIC">STATIC</option>
                                <option value="LAINNYA">LAINNYA</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="coverage">Pilih Router <font style="color: red; font-weight: bold;">*</font></label>
                            <select name="router" id="router" class="form-control" required>
                                <option value="<?= $customer['router'] ?>"><?= $customer['router'] ?></option>
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
                                <option value="<?= $customer['kode_odp'] ?>"><?= $customer['kode_odp'] ?></option>
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
                            <input type="text" id="port_odp" name="port_odp" class="form-control" value="<?= $customer['port_odp'] ?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="server">Pilih Server <font style="color: red; font-weight: bold;">*</font></label>
                            <select name="server" id="server" class="form-control" required>
                                <option value="<?= $customer['server'] ?>"><?= $customer['server'] ?></option>
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
                                <option value="<?= $customer['paket_wifi'] ?>"><?= $customer['paket_wifi'] ?></option>
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
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" class="form-control" value="<?= $customer['username'] ?>">
                        </div>
                        <div class="col-sm-6">
                            <label for="password">Password</label>
                            <input type="text" id="password" name="password" class="form-control" value="<?= $customer['password'] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="upload">Limit Upload</label>
                            <div class="input-group">
                                <input type="text" name="upload" id="upload" class="form-control" placeholder="1M" aria-label="1" value="<?= $customer['upload'] ?>" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2">bps</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="download">Limit Download</label>
                            <div class="input-group">
                                <input type="text" name="download" id="download" class="form-control" placeholder="1M" aria-label="1" value="<?= $customer['download'] ?>" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2">bps</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="ip_address">IP Address</label>
                            <input type="text" id="ip_address" name="ip_address" class="form-control" placeholder="192.168.1.1" value="<?= $customer['ip_address'] ?>">
                        </div>
                        <div class="col-sm-6">
                            <label for="refferal">Kode Refferal <font style="color: red; font-weight: bold;">*</font></label>
                            <input type="number" id="refferal" name="refferal" class="form-control" value="<?= $customer['refferal'] ?>" palecholder="<?= date('ymdHis'); ?>" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="latitude">Latitude</label>
                            <div class="input-group mb-2">
                                <input id="latitude" type="text" name="latitude" class="form-control" value="<?= $customer['latitude'] ?>" required>
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-map-marker"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="longitude">Longitude</label>
                            <div class="input-group mb-2">
                                <input id="longitude" type="text" name="longitude" value="<?= $customer['longitude'] ?>" class="form-control" required>
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
                            <label for="register_date">Tanggal Daftar <font style="color: red; font-weight: bold;">*</font></label>
                            <input id="latitude" type="date" name="register_date" class="form-control" value="<?= $customer['register_date'] ?>" required>
                        </div>
                        <div class="col-sm-6">
                            <label for="c_status">Status Pelanggan <font style="color: red; font-weight: bold;">*</font></label>
                            <select name="c_status" id="c_status" class="form-control" required>
                                <option value="<?= $customer['c_status'] ?>"><?= $customer['c_status'] ?></option>
                                <option value="Aktif">Aktif</option>
                                <option value="Non-Aktif">Non-Aktif</option>
                                <option value="Menunggu">Menunggu</option>
                                <option value="Gratis">Gratis</option>
                                <option value="Isolir">Isolir</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-secondary" data-dismiss="modal">Reset</button>
                <button type="submit" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>">Save</button>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>

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