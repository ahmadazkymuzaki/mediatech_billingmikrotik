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
    <div class="col-lg-4 col-sm-12 col-md-12 mb-1">
        <a href="<?= site_url('member/confirmotomatis/') ?><?= $invoice->invoice ?>">
            <div class="card comp-card" style="padding-top: 10px;">
                <div class="card-body">
                    <h3>
                        <i class="fa fa-arrow-right"></i>&nbsp;
                        Konfirmasi Otomatis
                    </h3>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-4 col-sm-12 col-md-12 mb-1">
        <a href="<?= site_url('member/confirmmanual/') ?><?= $invoice->invoice ?>">
            <div class="card comp-card" style="padding-top: 10px;">
                <div class="card-body">
                    <h3>
                        <i class="fa fa-arrow-right"></i>&nbsp;
                        Konfirmasi Manual
                    </h3>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-4 col-sm-12 col-md-12 mb-1">
        <a href="<?= site_url('member/history') ?>">
            <div class="card comp-card" style="padding-top: 10px;">
                <div class="card-body">
                    <h3>
                        <i class="fa fa-arrow-right"></i>&nbsp;
                        Riwayat Pembayaran
                    </h3>
                </div>
            </div>
        </a>
    </div>
</div>