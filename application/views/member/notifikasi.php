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
            <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active show" id="pills-profile-tab" data-toggle="pill" href="#last-month" role="tab" aria-controls="pills-profile" aria-selected="false">Notifikasi</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade active show" id="last-month" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="card-header">
                        <p style="padding-top: 15px;">
                            <?= $notif['nama_notifikasi'] ?> - <?= $notif['cat_notifikasi'] ?>
                        </p>
                    </div>
                    <div class="card-body">
                        <p style="padding-top: 15px;">
                            <?= $notif['desc_notifikasi'] ?>
                            <br>
                            <br>
                            <?= $notif['time_notifikasi'] ?>
                        </p>
                    </div>
                    <div class="card-footer">
                        <p style="padding-top: 15px;">
                            Oleh : <?= $notif['user_notifikasi'] ?> &nbsp;&nbsp;&nbsp;
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>