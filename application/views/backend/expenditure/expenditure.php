  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="https://files.billing.or.id/assets/backend/bootstrap-datepicker/css/bootstrap-datepicker.min.css">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <?php if ($this->session->userdata('role_id') == 1) { ?>
          <a href="" data-toggle="modal" data-target="#add" class="d-sm-inline-block btn btn-sm btn-<?= $company['theme'] ?> shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah</a>
      <?php } ?>
      <?php $subtotal = 0;
        foreach ($expenditure as $c => $data) {
            $subtotal += $data->nominal;
        } ?>
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
  <div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
      <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
          <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Cetak Laporan</h6>
      </div>
      <div class="card-body">
          <div class="row">
              <div class="col-lg">
                  <div class="box box-primary">
                      <div class="box-body box-profile">
                          <form action="<?= site_url('expenditure/printexpenditure'); ?>" target="blank" method="post">
                              <div class="box">
                                  <div class="box-body">

                                      <div class="form-group row">
                                          <div class="col-md-0 mt-2">
                                              <label class="col-sm-12 col-form-label">Tanggal</label>
                                          </div>
                                          <div class="col-sm-3 mt-2 ">
                                              <input type="date" id="tanggal" name="tanggal" class="form-control" autocomplete="off">
                                          </div>
                                          <div class="col-md-0 mt-2">
                                              <label class="col-sm-12 col-form-label">s/d</label>
                                          </div>
                                          <div class="col-sm-3  mt-2">
                                              <input type="date" id="tanggal2" name="tanggal2" autocomplete="off" class="form-control">
                                          </div>
                                          <div class="col-sm-3 mt-2">
                                              <button type="reset" name="reset" class="btn btn-info">Reset</button>
                                              <button type="submit" name="filter" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>"><i class="fa fa-print"></i> Cetak</button>
                                          </div>
                                      </div>
                                  </div>
                          </form>
                      </div>

                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
  </div>
  <!-- DataTales Example -->
  <div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
      <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
          <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data Pengeluaran</h6>

      </div>
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered" id="tablebt" width="100%" cellspacing="0">
                  <thead>
                      <tr style="text-align: center">
                          <th style="text-align: center;">No</th>
                          <th style="text-align: center;">Tanggal</th>
                          <th style="text-align: center;">Kategori</th>
                          <th style="text-align: center;">Nominal</th>
                          <th>Keterangan</th>
                          <?php if ($this->session->userdata('role_id') == 1) { ?>
                              <th style="text-align: center; width:50px">Aksi</th>
                          <?php } ?>
                      </tr>
                  </thead>
                  <tfoot>
                      <tr style="text-align: center">
                          <th style="text-align: right; font-weight:bold" colspan="3"><b>Total</b></th>
                          <th style="text-align: right">
                              <?= indo_currency($subtotal) ?>
                          </th>
                          <th colspan="2"> <?= number_to_words($subtotal) ?></th>
                      </tr>
                  </tfoot>
                  <tbody>
                      <?php $no = 1;
                        foreach ($expenditure as $r => $data) { ?>
                          <tr>
                              <td style="text-align: center"><?= $no++ ?>.</td>
                              <td class="text-center"><?= indo_date($data->date_payment)  ?> <br>
                              <td class="text-left"><?= $data->nama_kategori ?> <br>
                              <td style="text-align: right"><?= indo_currency($data->nominal)  ?></td>
                              <td><?= $data->remark ?></td>
                              </td>
                              <?php if ($this->session->userdata('role_id') == 1) { ?>
                                  <td style="text-align: center"><a href="#" data-toggle="modal" data-target="#edit<?= $data->expenditure_id ?>" title="Edit"><i class="fa fa-edit" style="font-size:25px"></i></a> <a href="" data-toggle="modal" data-target="#delete<?= $data->expenditure_id ?>" title="Hapus"><i class="fa fa-trash" style="font-size:25px; color:red"></i></a></td>
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
                  <h5 class="modal-title" id="exampleModalLabel">Tambah Pengeluaran</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form action="<?= site_url('expenditure/add') ?>" method="POST">
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="nominal">Nominal</label>
                                  <input type="number" id="nominal" name="nominal" min="0" autocomplete="off" class="form-control" required>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="nominal">Kategori</label>
                                  <select id="nama_kategori" name="nama_kategori" class="selectpicker show-tick form-control" data-live-search="true" tabindex="-98" required>
                                      <option value="">- Pilih Kategori -</option>
                                      <?php
                                        $data_kategori   = $this->db->get('kategori')->result();
                                        foreach ($data_kategori as $mykategori) {
                                        ?>
                                          <option value="<?= $mykategori->name_category ?>"><?= $mykategori->name_category ?></option>
                                      <?php } ?>
                                  </select>
                              </div>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="datepicker">Tanggal</label>
                          <input type="date" name="date_payment" autocomplete="off" id="date_payment" class="form-control" required>
                      </div>
                      <div class="form-group">
                          <label for="remark">Keterangan</label>
                          <textarea type="text" name="remark" id="remark" class="form-control"> </textarea>
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
  <?php foreach ($expenditure as $r => $data) { ?>
      <div class="modal fade" id="edit<?= $data->expenditure_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Edit Pengeluaran</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form action="<?= site_url('expenditure/edit') ?>" method="POST">
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="nominal">Nominal</label>
                                      <input type="number" id="nominal" name="nominal" value="<?= $data->nominal ?>" min="0" class="form-control" autocomplete="off" required>
                                      <input type="hidden" id="expenditure_id" name="expenditure_id" value="<?= $data->expenditure_id ?>" class="form-control" required>
                                      <input type="hidden" id="created" name="created" value="<?= $data->created ?>" class="form-control" required>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="nominal">Kategori</label>
                                      <select id="nama_kategori" name="nama_kategori" class="selectpicker show-tick form-control" data-live-search="true" tabindex="-98" required>
                                          <option value="<?= $data->nama_kategori ?>"><?= $data->nama_kategori ?></option>
                                          <?php
                                            $data_kategori   = $this->db->get('kategori')->result();
                                            foreach ($data_kategori as $mykategori) {
                                            ?>
                                              <option value="<?= $mykategori->name_category ?>"><?= $mykategori->name_category ?></option>
                                          <?php } ?>
                                      </select>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="date">Tanggal</label>
                              <input type="date" name="date_payment" id="date_payment" value="<?= $data->date_payment ?>" class="form-control" required>
                          </div>
                          <div class="form-group">
                              <label for="remark">Keterangan</label>
                              <textarea type="text" name="remark" id="remark" class="form-control"><?= $data->remark ?></textarea>
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
  <?php foreach ($expenditure as $r => $data) { ?>
      <div class="modal fade" id="delete<?= $data->expenditure_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Hapus Pengeluaran</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form action="<?= site_url('expenditure/delete') ?>" method="POST">
                          <input type="hidden" name="expenditure_id" value="<?= $data->expenditure_id ?>">
                          <input type="hidden" name="created" value="<?= $data->created ?>">
                          <?php $d = substr($data->date_payment, 8, 2);
                            $m = substr($data->date_payment, 5, 2);
                            $y = substr($data->date_payment, 0, 4); ?>
                          Apakah yakin akan hapus data pendapatan pada tanggal <?= indo_date($data->date_payment) ?> senilai <?= indo_currency($data->nominal) ?> ?
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
      $('#tanggal').datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true,
          todayHighlight: true,
      })
      $('#tanggal2').datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true,
          todayHighlight: true,
      })
      $('#datepicker').datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true,
          todayHighlight: true,
      })
  </script>