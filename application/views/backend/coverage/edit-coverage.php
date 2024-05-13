<style>
    #map-canvas {
        width: 100%;
        height: 400px;
        border: solid #999 1px;
    }

    select {
        width: 240px;
    }

    #kab_box,
    #kec_box,
    #kel_box,

    #lat_box,
    #lng_box {
        display: none;
    }
</style>
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
<?php if ($coverage['kategori'] == 'AREA') { ?>
    <div class="col-lg-6">
        <div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
            <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
                <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Edit <?= $coverage['kategori'] ?></h6>
            </div>
            <?php echo form_open_multipart('') ?>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-12 col-md-12 col-xl-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="name">Nama Area / Code Area</label>
                            <input type="text" name="name" id="name" class="form-control" value="<?= $coverage['c_name'] ?>" required>
                            <input type="hidden" name="coverage_id" id="coverage_id" class="form-control" value="<?= $coverage['coverage_id'] ?>" required>
                            <input type="hidden" name="prop" id="prop" class="form-control" value="<?= $coverage['id_prov'] ?>" required>
                            <input type="hidden" name="kota" id="kota" class="form-control" value="<?= $coverage['id_kab'] ?>" required>
                            <input type="hidden" name="kec" id="kec" class="form-control" value="<?= $coverage['id_kec'] ?>" required>
                            <input type="hidden" name="kel" id="kel" class="form-control" value="<?= $coverage['id_kel'] ?>" required>
                            <input type="hidden" name="kode_pos" id="kode_pos" class="form-control" value="<?= $coverage['kode_pos'] ?>" required>
                            <input type="hidden" name="nomor_rt" id="nomor_rt" class="form-control" value="<?= $coverage['nomor_rt'] ?>" required>
                            <input type="hidden" name="nomor_rw" id="nomor_rw" class="form-control" value="<?= $coverage['nomor_rw'] ?>" required>
                            <input type="hidden" name="kategori" id="kategori" class="form-control" value="<?= $coverage['kategori'] ?>" required>
                            <input type="hidden" name="complete" id="complete" class="form-control" value="<?= $coverage['complete'] ?>" required>
                            <input type="hidden" name="port_pon" id="port_pon" class="form-control" value="<?= $coverage['port_pon'] ?>" required>
                            <input type="hidden" name="redaman" id="redaman" class="form-control" value="<?= $coverage['redaman'] ?>" required>
                            <input type="hidden" name="tube" id="tube" class="form-control" value="Lainnya" required>
                        </div>
                    </div>
                    <div class="col-12 col-lg-12 col-md-12 col-xl-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="address">Jalan / Dusun / Gang</label>
                            <input type="text" name="address" id="address" class="form-control" value="<?= $coverage['address'] ?>" required>
                        </div>
                    </div>
                    <div class="col-12 col-lg-12 col-md-12 col-xl-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="name">Alamat Lengkap</label>
                            <textarea name="complete" id="complete" class="form-control" required><?= $coverage['complete'] ?></textarea>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-md-6 col-xl-6 col-sm-12 col-xs-12">
                        <label for="kapasitas">Kapasitas</label>
                        <div class="input-group mb-2">
                            <input id="input-calendar" type="number" name="kapasitas" class="form-control" value="<?= $coverage['kapasitas'] ?>" required>
                            <div class="input-group-prepend">
                                <div class="input-group-text">Core</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-md-6 col-xl-6 col-sm-12 col-xs-12">
                        <label for="tersedia">Tersedia</label>
                        <div class="input-group mb-2">
                            <input id="input-calendar" type="number" name="tersedia" class="form-control" value="<?= $coverage['tersedia'] ?>" required>
                            <div class="input-group-prepend">
                                <div class="input-group-text">Core</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-12 col-md-12 col-xl-12 col-sm-12 col-xs-12">
                        <div class="form-group mb-2">
                            <label for="name">Tokoh Wilayah / Komentar</label>
                            <input type="text" name="comment" id="comment" class="form-control" value="<?= $coverage['comment'] ?>" required>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-md-6 col-xl-6 col-sm-12 col-xs-12">
                        <label for="latitude">Latitude</label>
                        <div class="input-group mb-2">
                            <input id="latitude" type="text" name="latitude" class="form-control" value="<?= $coverage['latitude'] ?>" required>
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-map-marker"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-md-6 col-xl-6 col-sm-12 col-xs-12">
                        <label for="longitude">Longitude</label>
                        <div class="input-group mb-2">
                            <input id="longitude" type="text" name="longitude" class="form-control" value="<?= $coverage['longitude'] ?>" required>
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-map-marker"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 mt-2">
                        <div id="map" style="width: 100%; height: 500px;"></div>
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
                                curLocation = [<?= $coverage['latitude'] ?>, <?= $coverage['longitude'] ?>];
                            }
                            var map = L.map('map').setView([<?= $coverage['latitude'] ?>, <?= $coverage['longitude'] ?>], 16);

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
                    <div class="col-12 col-lg-12 col-md-12 col-xl-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="name">&nbsp;</label>
                            <button type="submit" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?> form-control">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
<?php } else { ?>
    <div class="col-lg-6">
        <div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
            <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
                <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Edit <?= $coverage['kategori'] ?></h6>
            </div>
            <?php echo form_open_multipart('') ?>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-6 col-md-6 col-xl-6 col-sm-12 col-xs-12 mb-2">
                        <div class="form-group">
                            <label for="name">Nama Area / Code Area</label>
                            <input type="text" name="name" id="name" class="form-control" value="<?= $coverage['c_name'] ?>" required>
                            <input type="hidden" name="coverage_id" id="coverage_id" class="form-control" value="<?= $coverage['coverage_id'] ?>" required>
                            <input type="hidden" name="kode_pos" id="kode_pos" class="form-control" value="<?= $coverage['kode_pos'] ?>" required>
                            <input type="hidden" name="nomor_rt" id="nomor_rt" class="form-control" value="<?= $coverage['nomor_rt'] ?>" required>
                            <input type="hidden" name="nomor_rw" id="nomor_rw" class="form-control" value="<?= $coverage['nomor_rw'] ?>" required>
                            <input type="hidden" name="address" id="address" class="form-control" value="<?= $coverage['address'] ?>" required>
                            <input type="hidden" name="prop" id="prop" class="form-control" value="<?= $coverage['id_prov'] ?>" required>
                            <input type="hidden" name="kota" id="kota" class="form-control" value="<?= $coverage['id_kab'] ?>" required>
                            <input type="hidden" name="kec" id="kec" class="form-control" value="<?= $coverage['id_kec'] ?>" required>
                            <input type="hidden" name="kel" id="kel" class="form-control" value="<?= $coverage['id_kel'] ?>" required>
                            <input type="hidden" name="kategori" id="kategori" class="form-control" value="<?= $coverage['kategori'] ?>" required>
                            <input type="hidden" name="complete" id="complete" class="form-control" value="<?= $coverage['complete'] ?>" required>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-md-6 col-xl-6 col-sm-12 col-xs-12 mb-2">
                        <div class="form-group">
                            <label for="name">Warna Tube FO</label>
                            <select name="tube" id="tube" class="form-control" required>
                                <option value="<?= $coverage['tube'] ?>"><?= $coverage['tube'] ?></option>
                                <option value="Biru">Biru</option>
                                <option value="Orange">Orange</option>
                                <option value="Hijau">Hijau</option>
                                <option value="Coklat">Coklat</option>
                                <option value="Slate">Slate</option>
                                <option value="Putih">Putih</option>
                                <option value="Merah">Merah</option>
                                <option value="Hitam">Hitam</option>
                                <option value="Kuning">Kuning</option>
                                <option value="Ungu">Ungu</option>
                                <option value="Pink">Pink</option>
                                <option value="Aqua">Aqua</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-md-6 col-xl-6 col-sm-12 col-xs-12">
                        <label for="kapasitas">Port OLT</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">PON</div>
                            </div>
                            <input id="input-calendar" type="number" name="port_pon" class="form-control" value="<?= $coverage['port_pon'] ?>" required>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-md-6 col-xl-6 col-sm-12 col-xs-12">
                        <label for="kapasitas">Kapasitas</label>
                        <div class="input-group mb-2">
                            <input id="input-calendar" type="number" name="kapasitas" class="form-control" value="<?= $coverage['kapasitas'] ?>" required>
                            <div class="input-group-prepend">
                                <div class="input-group-text">Core</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-md-6 col-xl-6 col-sm-12 col-xs-12">
                        <label for="tersedia">Tersedia</label>
                        <div class="input-group mb-2">
                            <input id="input-calendar" type="number" name="tersedia" class="form-control" value="<?= $coverage['tersedia'] ?>" required>
                            <div class="input-group-prepend">
                                <div class="input-group-text">Core</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-md-6 col-xl-6 col-sm-12 col-xs-12">
                        <label for="tersedia">Redaman</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Rata"</div>
                            </div>
                            <input id="input-calendar" type="text" name="redaman" class="form-control" value="<?= $coverage['redaman'] ?>" required>
                            <div class="input-group-prepend">
                                <div class="input-group-text">DB</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-12 col-md-12 col-xl-12 col-sm-12 col-xs-12">
                        <div class="form-group mb-2">
                            <label for="name">Komentar</label>
                            <input type="text" name="comment" id="comment" class="form-control" value="<?= $coverage['comment'] ?>" required>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-md-6 col-xl-6 col-sm-12 col-xs-12">
                        <label for="latitude">Latitude</label>
                        <div class="input-group mb-2">
                            <input id="input-calendar" type="text" name="latitude" class="form-control" value="<?= $coverage['latitude'] ?>" required>
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-map-marker"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-md-6 col-xl-6 col-sm-12 col-xs-12">
                        <label for="longitude">Longitude</label>
                        <div class="input-group mb-2">
                            <input id="input-calendar" type="text" name="longitude" class="form-control" value="<?= $coverage['longitude'] ?>" required>
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-map-marker"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 mt-2">
                        <?php echo $map['js'] ?>
                        <?php echo $map['html'] ?>
                    </div>
                    <div class="col-12 col-lg-12 col-md-12 col-xl-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="name">&nbsp;</label>
                            <button type="submit" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?> form-control">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
<?php } ?>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()
    });
    var ajaxku = buatajax();

    function ajaxkota(id) {
        var url = "<?= site_url('') ?>coverage/getKab/" + id + "/" + Math.random();
        ajaxku.onreadystatechange = stateChanged;
        ajaxku.open("GET", url, true);
        ajaxku.send(null);
    }

    function ajaxkec(id) {
        var url = "<?= site_url('') ?>coverage/getKec/" + id + "/" + Math.random();
        ajaxku.onreadystatechange = stateChangedKec;
        ajaxku.open("GET", url, true);
        ajaxku.send(null);
    }

    function ajaxkel(id) {
        var url = "<?= site_url('') ?>coverage/getKel/" + id + "/" + Math.random();
        ajaxku.onreadystatechange = stateChangedKel;
        ajaxku.open("GET", url, true);
        ajaxku.send(null);
    }

    function buatajax() {
        if (window.XMLHttpRequest) {
            return new XMLHttpRequest();
        }
        if (window.ActiveXObject) {
            return new ActiveXObject("Microsoft.XMLHTTP");
        }
        return null;
    }

    function stateChanged() {
        var data;
        if (ajaxku.readyState == 4) {
            data = ajaxku.responseText;
            if (data.length >= 0) {
                document.getElementById("kota").innerHTML = data
            } else {
                document.getElementById("kota").value = "<option selected>Pilih Kota/Kab</option>";
            }
            document.getElementById("kab_box").style.display = 'table-row';
            document.getElementById("kec_box").style.display = 'none';
            document.getElementById("kel_box").style.display = 'none';
        }
    }

    function stateChangedKec() {
        var data;
        if (ajaxku.readyState == 4) {
            data = ajaxku.responseText;
            if (data.length >= 0) {
                document.getElementById("kec").innerHTML = data
            } else {
                document.getElementById("kec").value = "<option selected>Pilih Kecamatan</option>";
            }
            document.getElementById("kec_box").style.display = 'table-row';
            document.getElementById("kel_box").style.display = 'none';
        }
    }

    function stateChangedKel() {
        var data;
        if (ajaxku.readyState == 4) {
            data = ajaxku.responseText;
            if (data.length >= 0) {
                document.getElementById("kel").innerHTML = data
            } else {
                document.getElementById("kel").value = "<option selected>Pilih Kelurahan/Desa</option>";
            }
            document.getElementById("kel_box").style.display = 'table-row';

        }
    }
</script>