  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="https://teamtalk.id/files/assets/backend/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
  <style>
      #map-canvas {
          width: 100%;
          height: 400px;
          border: solid #999 1px;
      }

      select {
          width: 240px;
      }

      #kab_box,
      #kec_box,
      #kel_box,
      #kab_boxx,
      #kec_boxx,
      #kel_boxx,
      #lat_box,
      #lng_box {
          display: none;
      }
  </style>
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
  <div class="continer mb-3">
      <div class="row">
          <div class="col-lg-3 col-xl-3 col-md-3 col-sm-6 col-xs-6 col-6">
              <a href="" data-toggle="modal" data-target="#addODC" class="form-control btn btn-sm btn-<?= $company['theme'] ?> shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> &nbsp; Tambah Lokasi ODC</a>
          </div>
          <div class="col-lg-3 col-xl-3 col-md-3 col-sm-6 col-xs-6 col-6">
              <a href="<?= base_url() ?>coverage/lokasiodc" target="_blank" class="form-control btn btn-sm btn-success shadow-sm"><i class="fas fa-eye fa-sm text-white-50"></i> &nbsp; Lihat Lokasi ODC</a>
          </div>
      </div>
  </div>
  <!-- DataTales Example -->
  <div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
      <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
          <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data Daftar ODC</h6>
      </div>
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr style="text-align: center">
                          <th style="text-align: center; width:20px">No</th>
                          <th>Nama Area</th>
                          <th>Port</th>
                          <th>Redaman</th>
                          <th>Kapasitas</th>
                          <th>Tersedia</th>
                          <th>Keterangan</th>
                          <th style="text-align: center; width:100px">Aksi</th>
                      </tr>
                  </thead>

                  <tbody>
                      <?php $no = 1;
                        foreach ($coverage as $r => $data) { ?>
                          <tr>
                              <td style="text-align: center"><?= $no++ ?>.</td>
                              <td style="text-align: center"><?= $data->c_name; ?></td>
                              <td style="text-align: center">PON <?= $data->port_pon; ?></td>
                              <td style="text-align: center"><?= $data->redaman; ?> db</td>
                              <td style="text-align: center"><?= $data->kapasitas; ?> Core / Port</td>
                              <td style="text-align: center"><?= $data->tersedia; ?> Core / Port</td>
                              <td style="text-align: center"><?= $data->comment; ?></td>
                              <td style="text-align: center"><a href="<?= site_url('coverage/edit/' . $data->coverage_id) ?>" title="Edit"><i class="fa fa-edit" style="font-size:25px"></i></a> <a href="" data-toggle="modal" data-target="#delete<?= $data->coverage_id ?>" title="Hapus"><i class="fa fa-trash" style="font-size:25px; color:red"></i></a></td>
                          </tr>
                      <?php } ?>
                  </tbody>
              </table>
          </div>
      </div>
  </div>
  <div class="modal fade" id="addODC" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Tambah Lokasi ODC</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form action="<?= site_url('coverage/add') ?>" method="POST">
                      <div class="row">
                          <div class="col-12 col-lg-6 col-md-6 col-xl-6 col-sm-12 col-xs-12 mb-2">
                              <div class="form-group">
                                  <label for="name">Nama / Kode ODP</label>
                                  <input type="text" name="name" id="name" value="ODC-<?= date('His') ?>/P1/KSG/<?= date('y') ?>" class="form-control" required>
                                  <input type="hidden" name="kategori" value="ODP">
                                  <input type="hidden" name="address" value="Kantor Google Indonesia">
                                  <input type="hidden" name="nomor_rt" value="005">
                                  <input type="hidden" name="nomor_rw" value="003">
                                  <input type="hidden" name="kode_pos" value="12190">
                                  <input type="hidden" name="prop" value="31">
                                  <input type="hidden" name="kota" value="3171">
                                  <input type="hidden" name="kec" value="3171060">
                                  <input type="hidden" name="kel" value="3171060010">
                              </div>
                          </div>
                          <div class="col-12 col-lg-6 col-md-6 col-xl-6 col-sm-12 col-xs-12 mb-2">
                              <div class="form-group">
                                  <label for="name">Warna Tube FO</label>
                                  <select name="tube" id="tube" class="form-control" required>
                                      <option value="">-- Silahkan Pilih --</option>
                                      <option value="Biru">Biru</option>
                                      <option value="Orange">Orange</option>
                                      <option value="Hijau">Hijau</option>
                                      <option value="Coklat">Coklat</option>
                                      <option value="Slate">Slate</option>
                                      <option value="Putih">Putih</option>
                                      <option value="Merah">Merah</option>
                                      <option value="Hitam">Hitam</option>
                                      <option value="Kuning">Kuning</option>
                                      <option value="Ungu">Ungu</option>
                                      <option value="Pink">Pink</option>
                                      <option value="Aqua">Aqua</option>
                                      <option value="Lainnya">Lainnya</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-12 col-lg-6 col-md-6 col-xl-6 col-sm-12 col-xs-12 mb-2">
                              <label for="kapasitas">Port OLT</label>
                              <div class="input-group mb-2">
                                  <div class="input-group-prepend">
                                      <div class="input-group-text">PON</div>
                                  </div>
                                  <input id="input-calendar" type="number" name="port_pon" class="form-control" required>
                              </div>
                          </div>
                          <div class="col-12 col-lg-6 col-md-6 col-xl-6 col-sm-12 col-xs-12 mb-2">
                              <label for="kapasitas">Kapasitas</label>
                              <div class="input-group mb-2">
                                  <input id="input-calendar" type="number" name="kapasitas" class="form-control" required>
                                  <div class="input-group-prepend">
                                      <div class="input-group-text">Core</div>
                                  </div>
                              </div>
                          </div>
                          <div class="col-12 col-lg-6 col-md-6 col-xl-6 col-sm-12 col-xs-12 mb-2">
                              <label for="tersedia">Tersedia</label>
                              <div class="input-group mb-2">
                                  <input id="input-calendar" type="number" name="tersedia" class="form-control" required>
                                  <div class="input-group-prepend">
                                      <div class="input-group-text">Core</div>
                                  </div>
                              </div>
                          </div>
                          <div class="col-12 col-lg-6 col-md-6 col-xl-6 col-sm-12 col-xs-12 mb-2">
                              <label for="tersedia">Redaman</label>
                              <div class="input-group mb-2">
                                  <div class="input-group-prepend">
                                      <div class="input-group-text">Rata"</div>
                                  </div>
                                  <input id="input-calendar" type="text" name="redaman" class="form-control" required>
                                  <div class="input-group-prepend">
                                      <div class="input-group-text">DB</div>
                                  </div>
                              </div>
                          </div>
                          <div class="col-12 col-lg-12 col-md-12 col-xl-12 col-sm-12 col-xs-12">
                              <div class="form-group">
                                  <label for="name">Keterangan</label>
                                  <input type="text" name="comment" id="comment" class="form-control" autocapitalize="off" required>
                              </div>
                          </div>
                          <div class="col-12 col-lg-6 col-md-6 col-xl-6 col-sm-12 col-xs-12">
                              <label for="latitude">Latitude</label>
                              <div class="input-group mb-2">
                                  <input id="input-calendar" type="text" name="latitude" class="form-control" required>
                                  <div class="input-group-prepend">
                                      <div class="input-group-text"><i class="fa fa-map-marker"></i></div>
                                  </div>
                              </div>
                          </div>
                          <div class="col-12 col-lg-6 col-md-6 col-xl-6 col-sm-12 col-xs-12">
                              <label for="longitude">Longitude</label>
                              <div class="input-group mb-2">
                                  <input id="input-calendar" type="text" name="longitude" class="form-control" required>
                                  <div class="input-group-prepend">
                                      <div class="input-group-text"><i class="fa fa-map-marker"></i></div>
                                  </div>
                              </div>
                          </div>
                          <?php
                            $configodc = array();
                            $configodc['map_div_id'] = "map-add";
                            $configodc['map_height'] = "250px";
                            $configodc['center'] = $company['latitude'] . ',' . $company['longitude'];
                            $configodc['zoom'] = '12';
                            $configodc['map_height'] = '400px;';
                            $configodc['map_type'] = 'HYBRID';
                            $this->googlemaps->initialize($configodc);
                            $markerodc = array();
                            $markerodc['position'] = $company['latitude'] . ',' . $company['longitude'];
                            $markerodc['draggable'] = true;
                            $markerodc['ondragend'] = 'setMapToForm(event.latLng.lat(), event.latLng.lng());';
                            $this->googlemaps->add_marker($markerodc);
                            $mapodc = $this->googlemaps->create_map();
                            ?>
                          <div class="col-12 col-md-12 mt-2">
                              <?php echo $mapodc['js'] ?>
                              <?php echo $mapodc['html'] ?>
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
  <!-- Modal Edit -->
  <?php foreach ($coverage as $r => $data) { ?>
      <div class="modal fade" id="delete<?= $data->coverage_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Hapus Data Coverage</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form action="<?= site_url('coverage/deletecoverage') ?>" method="POST">
                          <input type="hidden" name="coverage_id" value="<?= $data->coverage_id ?>">
                          Apakah anda yakin akan hapus data Lokasi ODC <?= $data->c_name ?> ?
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
  <script src="https://teamtalk.id/files/assets/backend/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
  <script>
      $(function() {
          //Initialize Select2 Elements
          $('.select2').select2()
      });
      //Date picker
      $('#datepicker').datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true,
          todayHighlight: true,
      })
  </script>

  <script>
      var ajaxku = createajax();

      function selectkota(id) {
          var url = "coverage/getKab/" + id + "/" + Math.random();
          ajaxku.onreadystatechange = stateChangedd;
          ajaxku.open("GET", url, true);
          ajaxku.send(null);
      }

      function selectkec(id) {
          var url = "coverage/getKec/" + id + "/" + Math.random();
          ajaxku.onreadystatechange = stateChangedKecc;
          ajaxku.open("GET", url, true);
          ajaxku.send(null);
      }

      function selectkel(id) {
          var url = "coverage/getKel/" + id + "/" + Math.random();
          ajaxku.onreadystatechange = stateChangedKell;
          ajaxku.open("GET", url, true);
          ajaxku.send(null);
      }

      function createajax() {
          if (window.XMLHttpRequest) {
              return new XMLHttpRequest();
          }
          if (window.ActiveXObject) {
              return new ActiveXObject("Microsoft.XMLHTTP");
          }
          return null;
      }

      function stateChangedd() {
          var data;
          if (ajaxku.readyState == 4) {
              data = ajaxku.responseText;
              if (data.length >= 0) {
                  document.getElementById("kotaa").innerHTML = data
              } else {
                  document.getElementById("kotaa").value = "<option selected>Pilih Kota/Kab</option>";
              }
              document.getElementById("kab_boxx").style.display = 'table-row';
              document.getElementById("kec_boxx").style.display = 'none';
              document.getElementById("kel_boxx").style.display = 'none';
          }
      }

      function stateChangedKecc() {
          var data;
          if (ajaxku.readyState == 4) {
              data = ajaxku.responseText;
              if (data.length >= 0) {
                  document.getElementById("kecc").innerHTML = data
              } else {
                  document.getElementById("kecc").value = "<option selected>Pilih Kecamatan</option>";
              }
              document.getElementById("kec_boxx").style.display = 'table-row';
              document.getElementById("kel_boxx").style.display = 'none';
          }
      }

      function stateChangedKell() {
          var data;
          if (ajaxku.readyState == 4) {
              data = ajaxku.responseText;
              if (data.length >= 0) {
                  document.getElementById("kell").innerHTML = data
              } else {
                  document.getElementById("kell").value = "<option selected>Pilih Kelurahan/Desa</option>";
              }
              document.getElementById("kel_boxx").style.display = 'table-row';

          }
      }
  </script>

  </html>