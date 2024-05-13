<div class="col-lg-12 mt-3">
    <div class="col-12">
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
    </div>
    <div class="col-12">
        <div class="card shadow mb-3" style="border: solid 1px grey;">
            <div class="card-body">
                <div class="text-center mt-1">
                    <img src="<?= site_url('assets/images/') ?><?= $company['logo'] ?>" width="150">
                    <h4 class="card-title mt-3"><?= $company['company_name'] ?></h4>
                    <h6>" <?= $company['sub_name'] ?> "</h6>
                    <h6><?= $company['address'] ?></h6>
                </div>
                <div class="header-medsos text-center" style="font-size: 40px;">
                    <a style="color: black;" href="https://www.instagram.com/<?= $company['instagram']; ?>" target="blank"><i class=" fab fa-instagram"></i></a>
                    <a style="color: black;" href="https://www.facebook.com/<?= $company['facebook']; ?>" target="blank"><i class=" fab fa-facebook"></i></a>
                    <a style="color: black;" href="https://api.whatsapp.com/send?phone=<?= indo_tlp($company['whatsapp']); ?>"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card shadow mb-3" style="border: solid 1px grey;">
            <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">

                <li class="nav-item">
                    <a class="nav-link active show" id="pills-profile-tab" data-toggle="pill" href="#last-month" role="tab" aria-controls="pills-profile" aria-selected="false">Tentang Kami</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#previous-month" role="tab" aria-controls="pills-setting" aria-selected="false">Google Maps</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade active show" id="last-month" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="card-body">
                        <p>
                            <?= $company['description'] ?>
                        </p>
                    </div>
                </div>
                <div class="tab-pane fade" id="previous-month" role="tabpanel" aria-labelledby="pills-setting-tab">
                    <div class="card-body">
                        <?= $company['google_maps'] ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>