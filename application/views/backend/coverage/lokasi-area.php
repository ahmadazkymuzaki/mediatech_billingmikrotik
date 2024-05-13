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
<div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-2">
    <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
        <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Peta Coverage Area</h6>
    </div>
    <div class="card-body">
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

            var locations = [
                <?php
                $coverage = $this->db->get_where('coverage', array('kategori' => 'AREA'))->result();
                foreach ($coverage as $data) {
                ?>["<b><?= $data->c_name ?> - <?= $data->comment ?></b><br>Kapasitas : <?= $data->kapasitas ?> Core / Port<br>Tersedia : <?= $data->tersedia ?> Core / Port<br><br>Detail Lokasi :<br><?= $data->complete ?>", <?= $data->latitude ?>, <?= $data->longitude ?>],
                <?php } ?>
            ];
            var map = L.map('map').setView([<?= $company['latitude'] ?>, <?= $company['longitude'] ?>], 15);

            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiYWhtYWRhemt5bXV6YWtpIiwiYSI6ImNsdjMwYm5uZzBvdm0ya3A4dm01NmZsNHMifQ.p13nKazxCKdZq8ZTkq2PTw', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                    '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                id: 'mapbox/satellite-v9',
                tileSize: 512,
                zoomOffset: -1
            }).addTo(map);

            var icon1 = L.icon({
                iconUrl: '/assets/marker.png',

                iconSize: [30, 38], // size of the icon
                iconAnchor: [17, 94], // point of the icon which will correspond to marker's location
                popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
            });
            for (var i = 0; i < locations.length; i++) {
                marker = new L.marker([locations[i][1], locations[i][2]], {
                        icon: icon1
                    })
                    .bindPopup(locations[i][0])
                    .addTo(map);
            }

            var baseMaps = {
                "Mode Terang": peta1,
                "Mode Gambar": peta2,
                "Mode Jalan": peta3,
                "Mode Gelap": peta4
            };

            L.control.layers(baseMaps).addTo(map);
        </script>
    </div>
</div>