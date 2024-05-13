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
                <div class="row">
                    <div class="col-lg">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="box box-widget">
                                    <div class="box-body table-responsive">
                                        <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                            <thead>
                                                <tr style="text-align: center">
                                                    <th>Kategori</th>
                                                    <th>Nominal</th>
                                                    <th>Deskripsi</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="dataTables">
                                                <?php $no = 1;
                                                foreach ($bonus as $c => $data) { ?>
                                                    <tr style="text-align: center">
                                                        <td><?= $data->kode_bonus ?></td>
                                                        <td>Rp. <?= indo_currency($data->nilai_bonus) ?></td>
                                                        <td><?= $data->desc_bonus ?></td>
                                                        <td>
                                                            <?php if ($data->status_bonus == 'PENDING') { ?>
                                                                <a href="<?= site_url('member/terimasaldo/') ?><?= $data->id_bonus ?>" class="btn btn-success">TERIMA</a>
                                                            <?php } else { ?>
                                                                <?= $data->status_bonus ?>
                                                            <?php } ?>
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
                </div>
            </div>
        </div>
    </div>
</div>