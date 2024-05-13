<?php $this->view('messages') ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <?php if ($this->session->userdata('role_id') == 1) { ?>
        <a href="<?= site_url('setting/allwebhook') ?>" class="d-sm-inline-block btn btn-sm btn-<?= $company['theme'] ?> shadow-sm"><i class="fa fa-trash fa-sm text-white-50"></i> Bersihkan Data</a>
    <?php } ?>
</div>
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
 <!-- DataTales Example -->
 <div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
     <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
         <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>;">Data Webhook WhatsApp</h6>
     </div>
     <div class="card-body">
         <div class="table-responsive">
             <table class="table table-bordered table-responsive" id="dataTable" width="100%" cellspacing="0">
                 <thead>
                     <tr style="height: 30px;">
                         <th style="text-align: center; width: 5%;">No</th>
                         <th style="text-align: center;">Pengirim</th>
                         <th style="text-align: center;">Penerima</th>
                         <th style="text-align: center;">Kategori</th>
                         <th style="text-align: center;">Isi Pesan</th>
                         <th style="text-align: center;">Pada</th>
                         <th style="text-align: center;">Aksi</th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php
                        $no = 1;
                        foreach ($webhook as $data) {
                        ?>
                         <tr style="height: 30px;">
                             <td style="text-align: center; width: 5%;"><?= $no++ ?></td>
                             <td style="text-align: center;"><?= $data->pengirim ?></td>
                             <td style="text-align: center;"><?= $data->penerima ?></td>
                             <td style="text-align: center;"><?= $data->kategori ?></td>
                             <td style="text-align: left;"><?= $data->pesan ?></td>
                             <td style="text-align: center;"><?= $data->timestamp ?> WIB</td>
                             <td style="text-align: center;">
                                 <?php if ($this->session->userdata('role_id') == 1) { ?>
                                    <?php if($data->id_web != '110'){ ?>
                                        <a href="" class="btn btn-outline-secondary" data-toggle="modal" data-target="#DeleteModal<?= $data->id_web ?>" title="Hapus"><i class="fa fa-trash" style="text-decoration: none; color: brown; width: 25px; font-size: 20px;"></i></a>
                                    <?php } ?>
                                 <?php } ?>
                             </td>
                         </tr>
                        <div class="modal fade" id="DeleteModal<?= $data->id_web ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Data Webhook WhatsApp</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php echo form_open_multipart('setting/delwebhook/'.$data->id_web) ?>
                                        Yakin akan hapus Data Webhook WhatsApp dengan Pesan :<br><i>"<?= $data->pesan ?>"</i> ?
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </div>
                                        <?php echo form_close() ?>
                                    </div>
                                </div>
                            </div>
                     <?php } ?>
                 </tbody>
             </table>
         </div>
     </div>
 </div>