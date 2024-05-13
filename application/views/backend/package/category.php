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
         <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data Kategori Layanan</h6>
     </div>
     <div class="card-body">
         <div class="table-responsive">
             <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                 <thead>
                     <tr>
                         <th style="text-align: center; width: 5%;">No</th>
                         <th style="text-align: center">Nama Kategori</th>
                         <th style="text-align: center">Keterangan</th>
                         <th style="text-align: center">Aksi</th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php $no = 1;
                        foreach ($p_category as $r => $data) { ?>
                         <tr>
                             <td style="text-align: center; width: 5%;"><?= $no++ ?>.</td>
                             <td style="width: 20%;"><?= $data->name ?></td>
                             <td><?= $data->description ?></td>
                             <td style="text-align: center; width: 10%;">
                                 <?php if ($data->p_category_id > 5) { ?>
                                     <a href="" data-toggle="modal" data-target="#EditModal<?= $data->p_category_id ?>" title="Edit"><i class="fa fa-edit" style="font-size:25px"></i></a>
                                     <a href="" data-toggle="modal" data-target="#DeleteModal<?= $data->p_category_id ?>" title="Hapus"><i class="fa fa-trash" style="font-size:25px; color:red"></i></a>
                                 <?php } ?>
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
                 <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <?php echo form_open_multipart('package/addPCategory') ?>
                 <div class="form-group">
                     <label for="name">Nama Kategori</label>
                     <input type="text" id="name" name="name" class="form-control" required>
                 </div>
                 <div class="form-group">
                     <label for="description">Keterangan</label>
                     <textarea id="description" name="description" class="form-control"></textarea>
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
    foreach ($p_category as $r => $data) { ?>
     <div class="modal fade" id="EditModal<?= $data->p_category_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Edit Kategori </h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <?php echo form_open_multipart('package/editPCategory') ?>
                     <div class="form-group">
                         <input type="hidden" name="p_category_id" value="<?= $data->p_category_id ?>" class="form-control">
                         <label for="name">Nama Kategori</label>
                         <input type="text" id="name" name="name" value="<?= $data->name ?>" class="form-control" required>
                     </div>
                     <div class="form-group">
                         <label for="description">Keterangan</label>
                         <textarea id="description" name="description" class="form-control"><?= $data->description ?></textarea>
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
    foreach ($p_category as $r => $data) { ?>
     <div class="modal fade" id="DeleteModal<?= $data->p_category_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Hapus Kategori</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <?php echo form_open_multipart('package/deletePCategory') ?>
                     <input type="hidden" name="p_category_id" value="<?= $data->p_category_id ?>" class="form-control">
                     Apakah yakin akan hapus kategori <?= $data->name ?> ?
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