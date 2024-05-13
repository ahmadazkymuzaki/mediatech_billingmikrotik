<div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-2">
    <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
        <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data Lokasi Pelanggan</h6>
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
                $customer = $this->db->get('customer')->result();
                foreach ($customer as $data) {
                    $base_url = base_url();
                    $dataItem = $this->db->get_where('package_item', array('p_item_id' => $data->item_paket))->row_array();
                    $dataUser = $this->db->get_where('user', array('no_services' => $data->no_services))->row_array();
                ?>["Nama Pelanggan : <?= $data->name ?><br>Nomor Layanan : <?= $data->no_services ?><br>Paket Langganan : <?= $dataItem['name'] ?><br>Jumlah Tagihan : Rp. <?= indo_currency($dataItem['price']) ?><br>Saldo Pelanggan : Rp. <?= indo_currency($dataUser['saldo']) ?><br>Jatuh Tempo : Setiap Tanggal <?= $data->due_date ?><br>Alamat E-Mail : <?= $data->email ?><br>Status Pelanggan : <?= $data->c_status ?><br>Kode Refferal : <?= $data->refferal ?><br>Terdaftar Sejak : <?= $data->register_date ?><br><br>Alamat Pelanggan :<br><?= $data->address ?>", <?= $data->latitude ?>, <?= $data->longitude ?>],
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
                iconUrl: 'https://files.billing.or.id/assets/marker.png',

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