  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="https://files.billing.or.id/assets/backend/bootstrap-datepicker/css/bootstrap-datepicker.min.css">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <a href="" data-toggle="modal" data-target="#add" class="d-sm-inline-block btn btn-sm btn-<?= $company['theme'] ?> shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah</a>

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
          <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data Metode Pembayaran</h6>
      </div>
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered" width="100%" cellspacing="0" style="border: solid black 1px; color: black;">
                  <thead>
                      <tr style="text-align: center">
                          <th style="text-align: center; width:20px">No</th>
                          <th>Metode Bayar</th>
                          <th>Nomor Rekening </th>
                          <th>Atas Nama</th>
                          <th style="text-align: center; width:100px">Aksi</th>
                      </tr>
                  </thead>

                  <tbody>
                      <?php $no = 1;
                        foreach ($bank as $r => $data) { ?>
                          <tr>
                              <td style="text-align: center"><?= $no++ ?>.</td>
                              <td><?= $data->name ?></td>
                              <td><?= $data->no_rek ?></td>
                              <td><?= $data->owner ?></td>
                              </td>
                              <td style="text-align: center"><a href="#" data-toggle="modal" data-target="#edit<?= $data->bank_id ?>" title="Edit"><i class="fa fa-edit" style="font-size:25px"></i></a> <a href="" data-toggle="modal" data-target="#delete<?= $data->bank_id ?>" title="Hapus"><i class="fa fa-trash" style="font-size:25px; color:red"></i></a></td>
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
                  <h5 class="modal-title" id="exampleModalLabel">Tambah Metode Pembayaran</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form action="<?= site_url('setting/addBank') ?>" method="POST">
                      <div class="form-group">
                          <label for="name">Jenis Pembayaran</label>
                          <input type="text" id="name" name="name" autocomplete="off" class="form-control" required>
                      </div>
                      <div class="form-group">
                          <label for="no_rek">Nomor Rekening / ID</label>
                          <input type="text" name="no_rek" autocomplete="off" id="no_rek" class="form-control" required>
                      </div>
                      <div class="form-group">
                          <label for="owner">Nama Penerima</label>
                          <input type="text" name="owner" autocomplete="off" id="owner" class="form-control">
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


  <!-- Modal Edit -->
  <?php foreach ($bank as $r => $data) { ?>
      <div class="modal fade" id="edit<?= $data->bank_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Edit Metode Pembayaran</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form action="<?= site_url('setting/editBank') ?>" method="POST">
                          <div class="form-group">
                              <label for="name">Jenis Pembayaran</label>
                              <input type="text" name="name" id="name" value="<?= $data->name ?>" class="form-control" required autocomplete="off">
                              <input type="hidden" id="bank_id" name="bank_id" value="<?= $data->bank_id ?>" class="form-control" required>
                          </div>
                          <div class="form-group">
                              <label for="no_rek">Nomor Rekening / ID</label>
                              <input type="text" name="no_rek" id="no_rek" value="<?= $data->no_rek ?>" class="form-control" required>
                          </div>
                          <div class="form-group">
                              <label for="owner">Nama Penerima</label>
                              <input type="text" name="owner" id="owner" autocomplete="off" class="form-control" value="<?= $data->owner ?>">
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
  <?php } ?>
  <!-- Modal Edit -->
  <?php foreach ($bank as $r => $data) { ?>
      <div class="modal fade" id="delete<?= $data->bank_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Hapus Data Pembayaran</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form action="<?= site_url('setting/deleteBank') ?>" method="POST">
                          <input type="hidden" name="bank_id" value="<?= $data->bank_id ?>">
                          Apakah anda yakin akan hapus data Pembayaran <?= $data->name ?> dg. Tujuan <?= $data->no_rek ?> a/n <?= $data->owner ?> ?
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-danger">Hapus</button>
                  </div>
                  </form>
              </div>
          </div>
      </div>
  <?php } ?>
  <!-- bootstrap datepicker -->
  <script src="https://files.billing.or.id/assets/backend/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
  <script>
      //Date picker
      $('#datepicker').datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true,
          todayHighlight: true,
      })
  </script>