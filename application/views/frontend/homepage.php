<style>
        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-track:hover {
            background: #f1f1f1;
        }
    </style>
    <?php if ($company['front'] == 'primary') {
        $backgroundnya = '#0ea2bd';
        $colornya = '#fff';
        $colorsub = '#000';
    ?>
        <style>
            ::-webkit-scrollbar-thumb {
                background: <?= $backgroundnya ?>;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: <?= $backgroundnya ?>;
            }
        </style>
    <?php } elseif ($company['front'] == 'secondary') {
        $backgroundnya = '#485664';
        $colornya = '#fff';
        $colorsub = '#000';
    ?>
        <style>
            ::-webkit-scrollbar-thumb {
                background: <?= $backgroundnya ?>;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: <?= $backgroundnya ?>;
            }
        </style>
    <?php } elseif ($company['front'] == 'success') {
        $backgroundnya = '#1cc88a';
        $colornya = '#fff';
        $colorsub = '#000';
    ?>
        <style>
            ::-webkit-scrollbar-thumb {
                background: <?= $backgroundnya ?>;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: <?= $backgroundnya ?>;
            }
        </style>
    <?php } elseif ($company['front'] == 'danger') {
        $backgroundnya = '#dc3545';
        $colornya = '#fff';
        $colorsub = '#000';
    ?>
        <style>
            ::-webkit-scrollbar-thumb {
                background: <?= $backgroundnya ?>;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: <?= $backgroundnya ?>;
            }
        </style>
    <?php } elseif ($company['front'] == 'warning') {
        $backgroundnya = '#ffc107';
        $colornya = '#fff';
        $colorsub = '#000';
    ?>
        <style>
            ::-webkit-scrollbar-thumb {
                background: <?= $backgroundnya ?>;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: <?= $backgroundnya ?>;
            }
        </style>
    <?php } elseif ($company['front'] == 'info') {
        $backgroundnya = '#0dcaf0';
        $colornya = '#fff';
        $colorsub = '#000';
    ?>
        <style>
            ::-webkit-scrollbar-thumb {
                background: <?= $backgroundnya ?>;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: <?= $backgroundnya ?>;
            }
        </style>
    <?php } elseif ($company['front'] == 'dark') {
        $backgroundnya = '#212529';
        $colornya = '#fff';
        $colorsub = '#000';
    ?>
        <style>
            ::-webkit-scrollbar-thumb {
                background: <?= $backgroundnya ?>;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: <?= $backgroundnya ?>;
            }
        </style>
    <?php } elseif ($company['front'] == 'light') {
        $backgroundnya = '#f8f9fa';
        $colornya = '#000';
        $colorsub = '#000';
    ?>
        <style>
            ::-webkit-scrollbar-thumb {
                background: <?= $backgroundnya ?>;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: <?= $backgroundnya ?>;
            }
        </style>
    <?php } elseif ($company['front'] == 'default') {
        $backgroundnya = '#1a1f24';
        $colornya = '#fff';
        $colorsub = '#000';
    ?>
        <style>
            ::-webkit-scrollbar-thumb {
                background: <?= $backgroundnya ?>;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: <?= $backgroundnya ?>;
            }
        </style>
    <?php } elseif ($company['front'] == 'purple') {
        $backgroundnya = '#6f42c1';
        $colornya = '#fff';
        $colorsub = '#000';
    ?>
        <style>
            ::-webkit-scrollbar-thumb {
                background: <?= $backgroundnya ?>;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: <?= $backgroundnya ?>;
            }
        </style>
    <?php } elseif ($company['front'] == 'orange') {
        $backgroundnya = '#fd7e14';
        $colornya = '#fff';
        $colorsub = '#000';
    ?>
        <style>
            ::-webkit-scrollbar-thumb {
                background: <?= $backgroundnya ?>;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: <?= $backgroundnya ?>;
            }
        </style>
    <?php } else {
        $backgroundnya = '#e74a3b';
        $colornya = '#fff';
        $colorsub = '#000';
    ?>
        <style>
            ::-webkit-scrollbar-thumb {
                background: <?= $backgroundnya ?>;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: <?= $backgroundnya ?>;
            }
        </style>
    <?php } ?>
    
<div class="container d-xl-none d-lg-none d-md-none d-sm-flex d-xs-flex"><br>
    <div id="carouselExampleIndicators" style="height: 150px;" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <?php $no = 0;
            foreach ($slide as $data) { ?>
                <div class="carousel-item splide__slide <?php if ($no == 0) {
                                                            echo 'active';
                                                        } else {
                                                            echo 'notactive';
                                                        } ?>">
                    <a href="<?= $data->link ?>">
                        <img src="<?= site_url('assets/images/slide/') ?><?= $data->picture ?>" width="100%" style="height: 150px;" alt="">
                    </a>
                </div>
            <?php $no++;
            } ?>

        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

<div class="container">
    <div class="section-services">
        <div class="row mt-4">
            <div class="col-lg-8 mb-2">
                <div class="card border-<?= $company['front'] ?>">
                    <div class="card-body">
                        <center>
                            <h5 class="card-title" style="color: <?= $backgroundnya ?>">Cek Tagihan Layanan Internet Bulanan Wi-Fi Anda hanya di Website <?= $company['company_name'] ?></h5>
                        <hr>
                        </center>
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-lg-9 mt-2">
                                    <input class="form-control mb-2 mr-sm-2" id="identitas" name="identitas" type="text" placeholder="Nomor Telepon / Nomor Layanan" required>
                                </div>
                                <div class="col-lg-3 mt-2">
                                    <button class="btn mb-2 my-2 my-sm-0 form-control" type="submit" style="background: <?= $backgroundnya ?>; color: <?= $colornya ?>" name="cekdata"><b>Cek Data Saya</b></button>
                                </div>
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['cekdata'])) {
                            $identitas = $_POST['identitas'];
                            echo "<script>window.location='front/cektagihan/" . $identitas . "'</script>";
                        };
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-2">
                <div class="card border-<?= $company['front'] ?>">
                    <div class="card-body">
                        <h4 class="card-title text-center" style="color: <?= $backgroundnya ?>"><b>DAFTAR KONTAK</b></h4>
                        <hr>
                        <div class="row text-center">
                            <div class="col-lg-3 col-sm-3 col-3 ">
                                <a href="https://www.instagram.com/<?= $company['instagram']; ?>" target="blank">
                                    <i class="fa fa-instagram" style="font-size: 50px; color: <?= $backgroundnya ?>;"></i>
                                </a>
                            </div>
                            <div class="col-lg-3 col-3 ">
                                <a href="https://www.facebook.com/<?= $company['facebook']; ?>" target="blank">
                                    <i class="fa fa-facebook-square" style="font-size: 50px; color: <?= $backgroundnya ?>;"></i>
                                </a>
                            </div>
                            <div class="col-lg-3 col-sm-3 col-3 ">
                                <a href="https://api.whatsapp.com/send?phone=<?= indo_tlp($company['whatsapp']); ?>" target="blank">
                                    <i class="fa fa-whatsapp" style="font-size: 50px; color: <?= $backgroundnya ?>;"></i>
                                </a>
                            </div>
                            <div class="col-lg-3 col-3 ">
                                <a href="mailto:<?= $company['email']; ?>" target="blank">
                                    <i class="fa fa-envelope" style="font-size: 50px; color: <?= $backgroundnya ?>;"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mb-1 mt-3">
                <div class="card border-<?= $company['front'] ?> mb-1">
                    <div class="card-body">
                        <center>
                            <h5 class="card-title mb-2" style="color: <?= $backgroundnya ?>"><b>Cakupan Area <?= $company['nama_singkat'] ?></b></h5>
                            <hr>
                        </center>
                        <div id="map" style="width: 100%; height: 500px;"></div>
                        <script>
                            var peta1 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiYXlvZHlhbmV0IiwiYSI6ImNsanM5aTl6aTBnOTMzZW9qbDF3dHB5YzAifQ.BoPwCt8nG7H8lqMxSR6QAA', {
                                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                                    '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                                    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                                id: 'mapbox/streets-v11'
                            });

                            var peta2 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiYXlvZHlhbmV0IiwiYSI6ImNsanM5aTl6aTBnOTMzZW9qbDF3dHB5YzAifQ.BoPwCt8nG7H8lqMxSR6QAA', {
                                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                                    '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                                    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                                id: 'mapbox/satellite-v9'
                            });


                            var peta3 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                            });

                            var peta4 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiYXlvZHlhbmV0IiwiYSI6ImNsanM5aTl6aTBnOTMzZW9qbDF3dHB5YzAifQ.BoPwCt8nG7H8lqMxSR6QAA', {
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

                            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiYXlvZHlhbmV0IiwiYSI6ImNsanM5aTl6aTBnOTMzZW9qbDF3dHB5YzAifQ.BoPwCt8nG7H8lqMxSR6QAA', {
                                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                                    '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                                    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                                id: 'mapbox/satellite-v9',
                                tileSize: 512,
                                zoomOffset: -1
                            }).addTo(map);

                            var icon1 = L.icon({
                                iconUrl: 'https://files.billing.or.id/herobiz/assets/marker.png',

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
            </div>
            <div class="col-lg-12 mb-3">
                <div class="card border-<?= $company['front'] ?> mt-3 mb-1">
                    <div class="card-body">
                        <h4 class="card-title text-center" style="color: <?= $backgroundnya ?>"><b>TENTANG KAMI</b></h4>
                        <hr>
                        <div class="row text-center" style="color: <?= $backgroundnya ?>">
                            <?= $company['description']; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mb-3 mt-1">
                <div class="card border-<?= $company['front'] ?>">
                    <div class="card-body">
                        <h4 class="card-title text-center" style="color: <?= $backgroundnya ?>"><b>DAFTAR PAKET</b></h4>
                        <hr>
                        <div class="row text-center">
                            <?php
		                        $paket = $this->db->get_where('package_item', array('public' => 1))->result();
                                foreach($paket as $DataPaket){
		                            $DataKategori = $this->db->get_where('package_category', array('p_category_id' => $DataPaket->category_id))->row_array();
                            ?>
                                <div class="col-lg-3 col-xl-3 col-md-3 col-xs-6 col-sm-6 col-6 mt-1 mb-1">
                                    <div class="card" style="border: 1px solid <?= $backgroundnya ?>;">
                                        <center>
                                            <img class="card-img-top" src="<?= site_url() ?>assets/images/package/<?= $DataPaket->picture ?>" style="height: auto; width: 50%; padding: 10px; margin-top: 10px;" alt="<?= $DataPaket->name ?>" title="<?= $DataPaket->name ?>">
                                        </center>
                                        <div class="card-body">
                                            <h6>
                                                <b style="font-weight: bold;"><?= $DataPaket->name ?></b>
                                                <br>
                                                Tagihan Rp. <?= indo_currency($DataPaket->price) ?>
                                                <br>
                                                + PPN <?= $company['ppn'] ?>% / Bulan
                                            </h6><br>
                                            <a href="<?= site_url('auth/register') ?>" class="btn form-control" style="background: <?= $backgroundnya ?>; color: <?= $colornya ?>">D A F T A R</a>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mb-3 mt-2">
                <div class="card border-<?= $company['front'] ?>">
                    <div class="card-body">
                        <h4 class="card-title text-center" style="color: <?= $backgroundnya ?>"><b>DAFTAR PRODUK</b></h4>
                        <hr>
                        <div class="row text-center">
                            <?php foreach($product as $DataProduk){ ?>
                                <div class="col-lg-3 col-xl-3 col-md-3 col-xs-6 col-sm-6 col-6 mt-1 mb-1">
                                    <div class="card" style="border: 1px solid <?= $backgroundnya ?>;">
                                        <center>
                                            <img class="card-img-top" src="<?= site_url() ?>assets/images/product/<?= $DataProduk->picture ?>" style="height: auto; width: 50%; padding: 10px; margin-top: 10px;" alt="<?= $DataProduk->name ?>" title="<?= $DataProduk->name ?>">
                                        </center>
                                        <div class="card-body">
                                            <h6>
                                                <b style="font-weight: bold;"><?= $DataProduk->name ?></b>
                                                <br>
                                                Harga : Rp. <?= indo_currency($DataProduk->remark) ?>
                                                <br><br>
                                                <?= substr($DataProduk->description, 0, 100) ?>...
                                            </h6>
                                            <a href="https://api.whatsapp.com/send?phone=<?= indo_tlp($company['whatsapp']); ?>&text=*Halo Admin <?= $company['nama_singkat'] ?>,*%0ASaya ingin order *<?= $DataProduk->name ?>* dengan harga *Rp. <?= indo_currency($DataProduk->remark) ?>* sekarang !!!" target="_blank" class="btn form-control" style="background: <?= $backgroundnya ?>; color: <?= $colornya ?>">O R D E R</a>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Layanan -->
<script>
    function cek_bill() {
        var no = $('#no_services').val()
        var m = $('#month').val()
        var y = $('#year').val()
        no_services = $('[name="no_services"]');
        month = $('[name="month"]');
        year = $('[name="year"]');
        if (no == '') {
            $('#no_services').focus()
        } else {
            if (m == '') {
                $('#month').focus()
            } else {
                if (y == '') {
                    $('#year').focus()
                } else {
                    $.ajax({
                        type: 'POST',
                        data: "cek_bill=" + 1 + "&no_services=" + no_services.val() + "&month=" + month.val() + "&year=" + year.val(),
                        url: '<?= site_url('front/view_bill') ?>',
                        cache: false,
                        beforeSend: function() {
                            no_services.attr('disabled', true);
                            $('.loading').html(` <div class="container">
        <div class="text-center">
            <div class="spinner-border" style="color : <?= $colornya ?>" style="width: 5rem; height: 5rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>`);
                        },
                        success: function(data) {
                            no_services.attr('disabled', false);
                            $('.loading').html('');
                            $('.view_data').html(data);
                        }
                    });
                }
            }
        }
        return false;
    }
</script>