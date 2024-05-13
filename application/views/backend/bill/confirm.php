  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="https://files.billing.or.id/assets/backend/bootstrap-datepicker/css/bootstrap-datepicker.min.css">

  <!-- Page Heading -->

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
          <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data Konfirmasi Pembayaran</h6>
      </div>
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr style="text-align: center">
                          <th style="text-align: center; width:20px">No</th>
                          <th>No Invoice</th>
                          <th>Periode</th>
                          <th>No Layanan</th>
                          <th>Nama Pelanggan</th>
                          <th>Metode Pembayaran</th>
                          <th>Tanggal Pembayaran</th>
                          <th>Bukti</th>
                          <th>Status</th>
                          <th>Keterangan</th>
                          <th style="text-align: center; width:100px">Aksi</th>
                      </tr>
                  </thead>

                  <tbody>
                      <?php $no = 1;
                        foreach ($confirm as $r => $data) { ?>
                          <tr>
                              <td style="text-align: center"><?= $no++ ?>.</td>
                              <td>
                                  <a href="<?= site_url('confirmdetail/' . $data->invoice_id) ?>">
                                      <?php if ($data->status == 'Terverifikasi') { ?>
                                          <div class="badge badge-success"><?= $data->invoice_id ?></div>
                                      <?php } ?>
                                      <?php if ($data->status == 'Pending') { ?>
                                          <div class="badge badge-danger"><?= $data->invoice_id ?></div>
                                      <?php } ?>
                                  </a>
                              </td>
                              <td>
                                  <?php $Invoice =   $this->db->get_where('invoice', ['invoice' => $data->invoice_id])->row_array(); ?>
                                  <?= indo_month($Invoice['month']) ?> <?= $Invoice['year']; ?>
                              </td>
                              <td><?= $data->no_services ?></td>
                              <?php $Customer =    $this->db->get_where('customer', ['no_services' => $data->no_services])->row_array(); ?>
                              <td><?= $Customer['name'] ?></td>
                              <td><?= $data->metode_payment ?></td>
                              <td><?= indo_date($data->date_payment) ?></td>
                              <td>
                                  <a href=""><img src="<?= site_url('assets/images/confirm/') ?><?= $data->picture ?>" alt="" style="width:100px; height:100px"></a>
                              </td>
                              <td><?= $data->status ?></td>
                              <td><?= $data->remark ?></td>
                              </td>
                              <td style="text-align: center"> <a href="" data-toggle="modal" data-target="#delete<?= $data->confirm_id ?>" title="Hapus"><i class="fa fa-trash" style="font-size:25px; color:red"></i></a></td>
                          </tr>
                      <?php } ?>
                  </tbody>
              </table>
          </div>
      </div>
  </div>



  <?php foreach ($confirm as $r => $data) { ?>
      <div class="modal fade" id="delete<?= $data->confirm_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Hapus Data Konfirmasi Pembayaran</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form action="<?= site_url('bill/deleteconfirm') ?>" method="POST">
                          <?php $Customer =    $this->db->get_where('customer', ['no_services' => $data->no_services])->row_array(); ?>

                          <input type="hidden" name="confirm_id" value="<?= $data->confirm_id ?>">
                          Apakah anda yakin akan hapus data konfirmasi pembayaran no invoice <?= $data->invoice_id; ?> a/n <?= $Customer['name'] ?> ?
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-danger">Ya, Lanjutkan</button>
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