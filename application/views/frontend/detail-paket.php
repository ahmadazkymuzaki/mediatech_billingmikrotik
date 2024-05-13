<div class="container-fluid mt-2">
    <div class="card" style="min-height:499px; max-height:499px">
        <div class="card-header text-center">
            Detail Produk / Layanan
        </div>
        <div class="card-body overflow-auto">
			<div class="row">
				<div class="col-lg-4">
					<div class="card__image text-center">
						<img src="<?= base_url('assets/images/product/') ?><?= $product['picture'] ?>" alt=""><br><br>
						<a href="https://api.whatsapp.com/send?phone=<?= indo_tlp($company['whatsapp']); ?>&text=Mau%20Order%20<?= $product['name'] ?>" target="_blank" class="btn btn-outline-primary"> <i class="fa fa-whatsapp" aria-hidden="true"></i>&nbsp; Order Sekarang</a>
					</div>
				</div>
				<div class="col-lg-8">
					<div class="product-text">
						<h3>
							<?= $product['name'] ?>
						</h3>
						<p><?= $product['remark'] ?></p>
						<?= $product['description'] ?>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>