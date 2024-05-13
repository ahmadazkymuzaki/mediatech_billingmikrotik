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
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Daftar Penerimaan Gaji</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-responsive table-bordered" id="dataTable" cellspacing="1">
                        <thead>
                            <tr>
                                <th style="text-align: center; width: 5%;">No</th>
                                <th style="text-align: center;">Periode</th>
                                <th style="text-align: center;">Gaji Diterima</th>
                                <th style="text-align: center;">Catatan</th>
                                <th style="text-align: center;">Status</th>
                                <th style="text-align: center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($gaji as $r => $data) { ?>
                                <tr>
                                    <td style="text-align: center; width: 5%;"><?= $no++ ?>.</td>
                                    <td style="text-align: left;">
                                        <?= $data->bulan_gaji ?> <?= $data->tahun_gaji ?>
                                    </td>
                                    <td style="text-align: right;">
                                        Rp. <?= indo_currency($data->gaji_diterima) ?>
                                    </td>
                                    <td style="text-align: left;">
                                        <?= $data->catatan ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?= $data->status_gaji ?>
                                    </td>
                                    <td style="text-align: center; width: 10%;">
                                        <a href="<?= site_url('member/detailgaji/') ?><?= $data->id_gaji ?>" style="text-decoration: none; font-weight: bold;" title="Detail Gaji"><i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>