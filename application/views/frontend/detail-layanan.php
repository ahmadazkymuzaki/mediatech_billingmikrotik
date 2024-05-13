<div class="container mt-5">
    <div class="product">
        <div class="row">
            <div class="col-lg-4">
                <div class="card__image">
                    <img src="<?= site_url('assets/images/product/') ?><?= $product['picture'] ?>" alt="">
                </div>
            </div>
            <div class="col-lg-8">
                <div class="product-text">
                    <h3>
                        <?= $product['name'] ?>
                    </h3>
                    <p><?= $product['remark'] ?></p>
                    <a href="https://api.whatsapp.com/send?phone=<?= indo_tlp($company['whatsapp']); ?>&text=<?= $product['name'] ?>" target="blank" class="btn btn-outline-primary"> <i class="fa fa-phone" aria-hidden="true"></i>
                        Kontak Kami</a>
                </div>
            </div>
        </div>
        <br>
        <?= $product['description'] ?>

    </div>
</div>