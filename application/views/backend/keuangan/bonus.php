 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <a href="#" class="d-sm-inline-block btn btn-sm btn-<?= $company['theme'] ?> shadow-sm" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah</a>
 </div>
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
 <!-- DataTales Example -->
 <div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
     <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
         <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data Bonus Refferal</h6>
     </div>
     <div class="card-body">
         <div class="table-responsive">
             <table class="table table-bordered table-responsive" id="dataTable" width="100%" cellspacing="0">
                 <thead>
                     <tr style="height: 30px;">
                         <th style="text-align: center; width: 5%;">No</th>
                         <th style="text-align: center">Kode Bonus</th>
                         <th style="text-align: center">Keterangan</th>
                         <th style="text-align: center">Nominal</th>
                         <th style="text-align: center">No. Layanan</th>
                         <th style="text-align: center">Status</th>
                         <th style="text-align: center">Diterima</th>
                         <th style="text-align: center">Aksi</th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php $no = 1;
                        foreach ($bonus as $r => $data) { ?>
                         <tr style="height: 30px;">
                             <td style="text-align: center; width: 5%;"><?= $no++ ?>.</td>
                             <td><?= $data->kode_bonus ?></td>
                             <td><?= $data->desc_bonus ?></td>
                             <td style="text-align: left;">Rp. <?= indo_currency($data->nilai_bonus) ?></td>
                             <td style="text-align: center;"><?= $data->no_services ?></td>
                             <td style="text-align: center;"><?= $data->status_bonus ?></td>
                             <td style="text-align: center;"><?= $data->time_bonus ?></td>
                             <td style="text-align: center; width: 10%;">
                                 <a href="" data-toggle="modal" data-target="#EditModal<?= $data->id_bonus ?>" title="Edit"><i class="fa fa-edit" style="font-size:25px"></i></a>
                                 <a href="" data-toggle="modal" data-target="#DeleteModal<?= $data->id_bonus ?>" title="Hapus"><i class="fa fa-trash" style="font-size:25px; color:red"></i></a>
                             </td>
                         </tr>
                     <?php } ?>
                 </tbody>
             </table>
         </div>
     </div>
 </div>



 <!-- Modal Add -->
 <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Tambah Bonus Refferal</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <?php echo form_open_multipart('keuangan/tambahbonus') ?>
                 <div class="form-group">
                     <label for="name">Kode Bonus</label>
                     <input type="text" id="kode_bonus" name="kode_bonus" value="BRM-<?= date('ymdHis') ?>" class="form-control" readonly>
                 </div>
                 <div class="form-group">
                     <label for="name">Nominal</label>
                     <input type="number" id="nilai_bonus" name="nilai_bonus" class="form-control" required>
                 </div>
                 <div class="form-group">
                     <label for="name">Penerima</label>
                     <select id="no_services" name="no_services" class="selectpicker show-tick form-control" data-live-search="true" tabindex="-98" required>
                         <option value="">- Pilih Member -</option>
                         <?php
                            $data_customer   = $this->db->get('customer')->result();
                            foreach ($data_customer as $mycustomer) {
                                $jumlah_refferal = $this->db->get_where('customer', array('refferal' => $mycustomer->no_services))->num_rows();
                                if ($jumlah_refferal == 0) {
                                    $total = 'Tidak Ada';
                                } else {
                                    $total = $jumlah_refferal . ' Orang';
                                }
                            ?>
                             <option value="<?= $mycustomer->no_services ?>"><?= $mycustomer->name ?> - <?= $total ?></option>
                         <?php } ?>
                     </select>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                     <button type="submit" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>">Simpan</button>
                 </div>
                 <?php echo form_close() ?>
             </div>
         </div>
     </div>
 </div>

 <!-- Modal Edit -->
 <?php
    foreach ($bonus as $r => $data) { ?>
     <div class="modal fade" id="EditModal<?= $data->id_bonus ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Edit Bonus Refferal </h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <?php echo form_open_multipart('keuangan/editbonus') ?>
                     <div class="form-group">
                         <label for="name">Kode Bonus</label>
                         <input type="text" id="kode_bonus" name="kode_bonus" value="<?= $data->kode_bonus ?>" class="form-control" readonly>
                         <input type="hidden" id="no_services" name="no_services" value="<?= $data->no_services ?>" class="form-control" readonly>
                     </div>
                     <div class="form-group">
                         <label for="name">Nominal</label>
                         <input type="number" id="nilai_bonus" name="nilai_bonus" value="<?= $data->nilai_bonus ?>" class="form-control" required>
                     </div>
                     <div class="form-group">
                         <label for="description">Deskripsi Lengkap</label>
                         <textarea id="desc_bonus" name="desc_bonus" class="form-control"><?= $data->desc_bonus ?></textarea>
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                         <button type="submit" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>">Simpan</button>
                     </div>
                     <?php echo form_close() ?>
                 </div>
             </div>
         </div>
     </div>
 <?php } ?>

 <!-- Modal Hapus -->
 <?php
    foreach ($bonus as $r => $data) { ?>
     <div class="modal fade" id="DeleteModal<?= $data->id_bonus ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Hapus Bonus Refferal</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <?php echo form_open_multipart('keuangan/hapusbonus') ?>
                     <input type="hidden" name="id_bonus" value="<?= $data->id_bonus ?>" class="form-control">
                     Apakah yakin akan hapus data bonus <?= $data->kode_bonus ?> ?
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                         <button type="submit" class="btn btn-danger">Hapus</button>
                     </div>
                     <?php echo form_close() ?>
                 </div>
             </div>
         </div>
     </div>
 <?php } ?>