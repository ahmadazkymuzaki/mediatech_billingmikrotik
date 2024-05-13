    <!-- Layanan -->
    <div class="layanan">
        <div class="container">
            <h3>Layanan Kami</h3>
            <p>Kami melayani berbagai kebutuhan IT Anda</p>
            <div class="row">
                <?php foreach ($product as $key => $data) { ?>
                    <div class="cards__item col-12 col-sm-4 col-md-3 col-lg-3">
                        <div class="card">
                            <div class="card__image">
                                <img class="tv-card__image" src="<?= site_url('assets/images/product/') ?><?= $data->picture ?>">
                            </div>
                            <div class="card__content">
                                <div class="card__title"><?= $data->name ?></div>
                                <p class="card__text"><?= $data->remark ?>
                                </p>
                                <ul class="card__feature__list">
                                </ul>
                            </div>
                            <div class="card__content">
                                <a href="<?= site_url('detail-layanan/') ?><?= $data->link ?>" class="btn btn--block card__btn">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>


            </div>
        </div>
    </div>
    <!-- End Layanan -->