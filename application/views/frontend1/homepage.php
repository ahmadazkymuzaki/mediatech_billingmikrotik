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
			<div id="carouselExampleIndicators" class="carousel slide mt-1" data-ride="carousel">
				<div class="carousel-inner" role="listbox">
                    <?php
                        $no = 0;
                        foreach ($slide as $data) {
                    ?>
    					<div class="carousel-item
    					    <?php
    					        if($no == 0) {
    					            echo 'active';
                                } else {
                                    echo 'notactive';
                                }
                            ?>">
    					    <a href="<?= $data->link ?>">
    						<img src="<?= site_url('assets/images/slide/') ?><?= $data->picture ?>" width="100%" style="height: auto;" alt="">
    					    </a>
    					</div>
    				<?php $no++; } ?>
				</div>
				<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
					<i class="tim-icons icon-minimal-left"></i>
				</a>
				<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
					<i class="tim-icons icon-minimal-right"></i>
				</a>
			</div>

<div class="container">
    <div class="section-services">
        <div class="row mt-4">
            <div class="col-lg-8 m-0">
                <div class="card border-<?= $company['front'] ?>">
                    <div class="card-body">
                        <center>
                            <h5 class="card-title" style="color: <?= $colornya ?>">Cek Tagihan Layanan Internet Bulanan Wi-Fi Anda hanya di Website <?= $company['company_name'] ?></h5>
                        </center>
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-lg-9 mt-2">
                                    <input class="form-control mb-2 mr-sm-2" id="identitas" name="identitas" type="text" placeholder="Nomor Telepon / Nomor Layanan" required>
                                </div>
                                <div class="col-lg-3 mt-2">
                                    <button class="btn mb-2 my-2 my-sm-0 form-control btn-danger" type="submit" name="cekdata"><b>Cek Data Saya</b></button>
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

            <div class="col-lg-4 m-0">
                <div class="card border-<?= $company['front'] ?>">
                    <div class="card-body">
                        <h4 class="card-title text-center" style="color: <?= $colornya ?>"><b>DAFTAR KONTAK</b></h4>
                        <div class="row text-center">
                            <div class="col-lg-3 col-sm-3 col-3 ">
                                <a href="https://www.instagram.com/<?= $company['instagram']; ?>"  class="btn btn-icon btn-primary btn-round btn-lg sharrre" data-toggle="tooltip" data-original-title="Facebook">
                                        <i class="fab fa-instagram"></i>
                                        
                                </a>
                            </div>
                            <div class="col-lg-3 col-3 ">
                                <a href="https://www.facebook.com/<?= $company['facebook']; ?>"  class="btn btn-icon btn-twitter btn-round btn-lg sharrre" data-toggle="tooltip" data-original-title="Facebook">
                                        <i class="fab fa-facebook"></i>
                                        
                                </a>
                            </div>
                            <div class="col-lg-3 col-sm-3 col-3 ">
                                <a href="https://api.whatsapp.com/send?phone=<?= indo_tlp($company['whatsapp']); ?>" target="blank" class="btn btn-icon btn-success btn-round btn-lg sharrre" data-toggle="tooltip" data-original-title="WhatsApp">
                                        <i class="fab fa-whatsapp"></i>
                                        
                                </a>
                            </div>
                            <div class="col-lg-3 col-3 ">
                                <a href="mailto:<?= $company['email']; ?>" target="blank" class="btn btn-icon btn-warning btn-round btn-lg sharrre" data-toggle="tooltip" data-original-title="Google Mail">
                                        <i class="far fa-envelope"></i>
                                        
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mb-4" style="margin-top: -17px;">
                <div class="card border-<?= $company['front'] ?> mt-3 mb-1">
                    <div class="card-body">
                        <h4 class="card-title text-center" style="color: <?= $colornya ?>"><b>TENTANG KAMI</b></h4>
                        <div class="row" style="text-align: justify; color: <?= $backgroundnya ?>; padding-left: 20px; padding-right: 20px;">
                            <?= $company['description']; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 m-0">
                <div class="card border-<?= $company['front'] ?>">
                    <div class="card-body">
                        <h4 class="card-title text-center" style="color: <?= $colornya ?>"><b>DAFTAR PAKET</b></h4>
                        <div class="row text-center">
                            <?php
		                        $paket = $this->db->get_where('package_item', array('public' => 1))->result();
                                foreach($paket as $DataPaket){
		                            $DataKategori = $this->db->get_where('package_category', array('p_category_id' => $DataPaket->category_id))->row_array();
                            ?>
                                <div class="col-lg-3 col-xl-3 col-md-3 col-xs-6 col-sm-6 col-6 mt-2">
                                    <div class="card m-0 p-0" style="border: 1px solid <?= $colornya ?>;">
                                        <center>
                                            <img class="card-img-top" src="<?= site_url() ?>assets/images/package/<?= $DataPaket->picture ?>" style="height: auto; width: 80%; padding: 10px; margin-top: 10px;" alt="<?= $DataPaket->name ?>" title="<?= $DataPaket->name ?>">
                                        </center>
                                        <div class="card-body">
                                            <h6>
                                                <b style="font-weight: bold;"><?= $DataPaket->name ?></b>
                                                <br>
                                                Rp. <?= indo_currency($DataPaket->price) ?>
                                                <br>
                                                + PPN <?= $company['ppn'] ?>%
                                            </h6><br>
                                            <a href="<?= site_url('auth/register') ?>" class="btn-sm btn btn-danger">D A F T A R</a>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 m-0">
                <div class="card border-<?= $company['front'] ?>">
                    <div class="card-body">
                        <h4 class="card-title text-center" style="color: <?= $colornya ?>"><b>DAFTAR PRODUK</b></h4>
                        <div class="row text-center">
                            <?php foreach($product as $DataProduk){ ?>
                                <div class="col-lg-3 col-xl-3 col-md-3 col-xs-6 col-sm-6 col-6 mt-2">
                                    <div class="card m-0 p-0" style="border: 1px solid <?= $colornya ?>;">
                                        <center>
                                            <img class="card-img-top" src="<?= site_url() ?>assets/images/product/<?= $DataProduk->picture ?>" style="height: auto; width: 80%; padding: 10px; margin-top: 10px;" alt="<?= $DataProduk->name ?>" title="<?= $DataProduk->name ?>">
                                        </center>
                                        <div class="card-body">
                                            <h6>
                                                <b style="font-weight: bold;"><?= $DataProduk->name ?></b>
                                                <br>
                                                Harga : Rp. <?= indo_currency($DataProduk->remark) ?>
                                                <br><br>
                                                <?= substr($DataProduk->description, 0, 100) ?>...
                                            </h6>
                                            <a href="https://api.whatsapp.com/send?phone=<?= indo_tlp($company['whatsapp']); ?>&text=*Halo Admin <?= $company['nama_singkat'] ?>,*%0ASaya ingin order *<?= $DataProduk->name ?>* dengan harga *Rp. <?= indo_currency($DataProduk->remark) ?>* sekarang !!!" target="_blank" class="btn-sm btn btn-danger">O R D E R</a>
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