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
         <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data Hotspot Cookies (<?= $totalhotspotcookie; ?> item)</h6>
     </div>
     <div class="card-body">
         <div class="table-responsive">
             <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                 <thead>
                     <tr style="text-align: center;">
                         <th width="10%">No</th>
                         <th width="25%">Name</th>
                         <th width="25%">Mac Address</th>
                         <th width="25%">Expired</th>
                         <th width="15%">Aksi</th>
                     </tr>
                 </thead>

                 <tbody>
                     <?php $no = 1;
                        foreach ($hotspotcookie as $dataku) { ?>
                         <?php $id = str_replace('*', '', $dataku['.id']) ?>
                         <tr style="text-align: center">
                             <td width="15%"><?= $no++ ?></td>
                             <td width="20%"><?= $dataku['user'] ?></td>
                             <td width="25%"><?= $dataku['mac-address'] ?></td>
                             <td width="25%"><?= $dataku['expires-in'] ?></td>
                             <td width="15%">
                                 <a href="<?= site_url('hotspot/deletecookie/' . $id) ?>" onclick="return confirm('Apakah anda yakin akan menghapus data cookie <?= $dataku['user'] ?> ?')" title="Hapus">
                                     <i class="fa fa-trash" style="font-size:25px; color:red"></i>
                                 </a>
                             </td>
                         </tr>
                     <?php } ?>
                 </tbody>
             </table>
         </div>
     </div>
 </div>