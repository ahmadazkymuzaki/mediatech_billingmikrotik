 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <a href="#" data-toggle="modal" data-target="#add" class="d-sm-inline-block btn btn-sm btn-<?= $company['theme'] ?> shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah</a>
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
         <h6 class="m-0 font-weight-bold" style="color : <?= $colornya ?>">Data Hotspot Profile (<?= $totalhotspotprofile; ?> item)</h6>
     </div>
     <div class="card-body">
         <div class="table-responsive">
             <table class="table table-bordered" id="dataTable" cellspacing="0">
                 <thead>
                     <tr style="text-align: center;">
                         <th width="5%">No</th>
                         <th width="25%">Name</th>
                         <th width="15%">Pool</th>
                         <th width="15%">Limit</th>
                         <th width="10%">Session</th>
                         <th width="10%">Shared</th>
                         <th width="15%">Comment</th>
                         <?php if ($this->session->userdata('role_id') == 1) { ?>
                             <th width="5%">Aksi</th>
                         <?php } ?>
                     </tr>
                 </thead>

                 <tbody>
                     <?php $no = 1;
                        foreach ($hotspotprofile as $dataku) {
                        ?>
                         <?php $id = str_replace('*', '', $dataku['.id']) ?>
                         <tr style="text-align: center">
                             <td width="5%"><?= $no++ ?></td>
                             <td width="25%"><?= $dataku['name'] ?></td>
                             <td width="15%"><?= $dataku['address-pool'] ?></td>
                             <td width="15%"><?= $dataku['rate-limit'] ?></td>
                             <td width="10%"><?= $dataku['session-timeout'] ?></td>
                             <td width="10%"><?= $dataku['shared-users'] ?> User</td>
                             <td width="15%"><?= $dataku['comment'] ?></td>
                             <?php if ($this->session->userdata('role_id') == 1) { ?>
                                 <td width="15%">
                                     <a href="<?= site_url('hotspot/deleteprofile/' . $id) ?>" onclick="return confirm('Apakah anda yakin akan menghapus data profile <?= $dataku['name'] ?> ?')" title="Hapus">
                                         <i class="fa fa-trash" style="font-size:25px; color:red"></i>
                                     </a>
                                 </td>
                             <?php } ?>
                         </tr>
                     <?php } ?>
                 </tbody>
             </table>
         </div>
     </div>
 </div>

 <!-- Modal Add -->
 <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Tambah Profile Hotspot</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form action="<?= site_url('hotspot/addprofile') ?>" method="POST">
                     <div class="row">
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label for="nominal">Nama Profil</label>
                                 <input type="text" id="name" name="name" class="form-control" placeholder="Paket-1-MB" required>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label for="nominal">Rate Limit</label>
                                 <input type="text" id="limit" name="limit" class="form-control" placeholder="512k/1M" required>
                             </div>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label for="nominal">Shared User</label>
                                 <input type="number" id="shared" name="shared" class="form-control" placeholder="1" required>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label for="nominal">Address Pool</label>
                                 <select id="address" name="address" class="form-control" required>
                                     <option value="">( silahkan pilih )</option>
                                     <?php foreach ($ippool as $datagua) { ?>
                                         <option value="<?= $datagua['name'] ?>"><?= $datagua['name'] ?></option>
                                     <?php } ?>
                                 </select>
                             </div>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label for="nominal">Parent Queue</label>
                                 <select id="parent" name="parent" class="form-control" required>
                                     <option value="">( silahkan pilih )</option>
                                     <?php foreach ($queue as $mydata) {
                                            if ($mydata['dynamic'] == 'false') {
                                        ?>
                                             <option value="<?= $mydata['name'] ?>"><?= $mydata['name'] ?></option>
                                     <?php }
                                        } ?>
                                 </select>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label for="nominal">MAC Cookie</label>
                                 <select id="cookie" name="cookie" class="form-control" required>
                                     <option value="">( silahkan pilih )</option>
                                     <option value="yes">yes</option>
                                     <option value="no">no</option>
                                 </select>
                             </div>
                         </div>
                     </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                 <button type="submit" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>">Simpan</button>
             </div>
             </form>
         </div>
     </div>
 </div>