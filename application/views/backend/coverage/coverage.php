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
              <a href="" data-toggle="modal" data-target="#addArea" class="form-control btn btn-sm btn-<?= $company['theme'] ?> shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> &nbsp; Tambah Coverage Area</a>
          </div>
          <div class="col-lg-3 col-xl-3 col-md-3 col-sm-6 col-xs-6 col-6">
              <a href="<?= base_url() ?>coverage/lokasiarea" target="_blank" class="form-control btn btn-sm btn-success shadow-sm"><i class="fas fa-eye fa-sm text-white-50"></i> &nbsp; Lihat Peta Coverage Area</a>
          </div>
      </div>
  </div>
  <!-- DataTales Example -->
  <div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
      <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
          <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data Coverage Area</h6>
      </div>
      <div class="container mt-2"> A : Active <br> N-A : Non-Active <br> M : Menunggu</div>
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr style="text-align: center">
                          <th style="text-align: center; width:20px">No</th>
                          <th style="text-align: center; width:100px">Aksi</th>
                          <th>Nama Area</th>
                          <th>Pelanggan</th>
                          <th>Alamat</th>
                          <th>Keterangan</th>
                      </tr>
                  </thead>

                  <tbody>
                      <?php $no = 1;
                        foreach ($coverage as $r => $data) { ?>
                          <tr>
                              <td style="text-align: center"><?= $no++ ?>.</td>
                              <td style="text-align: center"><a href="<?= site_url('coverage/edit/' . $data->coverage_id) ?>" title="Edit"><i class="fa fa-edit" style="font-size:25px"></i></a> <a href="" data-toggle="modal" data-target="#delete<?= $data->coverage_id ?>" title="Hapus"><i class="fa fa-trash" style="font-size:25px; color:red"></i></a></td>
                              <td>
                                  <a href="<?= site_url('coverage/cs/' . $data->coverage_id) ?>" class="badge badge-primary"><?= $data->c_name; ?></a>
                              </td>
                              <?php $active = $this->db->get_where('customer', ['coverage' => $data->coverage_id, 'c_status' => 'Aktif'])->num_rows(); ?>
                              <?php $nonactive = $this->db->get_where('customer', ['coverage' => $data->coverage_id, 'c_status' => 'Non-Aktif'])->num_rows(); ?>
                              <?php $waiting = $this->db->get_where('customer', ['coverage' => $data->coverage_id, 'c_status' => 'Menunggu'])->num_rows(); ?>
                              <th>A : <?= $active; ?> <br>N-A : <?= $nonactive; ?> <br>M : <?= $waiting; ?></th>
                              <td><?= $data->complete; ?></td>
                              <td><?= $data->comment; ?> </td>
                          </tr>
                      <?php } ?>
                  </tbody>
              </table>
          </div>
      </div>
  </div>
  <script type="text/javascript" src="<?= site_url('assets/') ?>ajax_daerah.js"></script>
  <!-- Modal Add -->
  <div class="modal fade" id="addArea" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Tambah Coverage Area</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form action="<?= site_url('coverage/add') ?>" method="POST">
                      <div class="row">
                          <div class="col-12 col-lg-6 col-md-6 col-xl-6 col-sm-12 col-xs-12">
                              <div class="form-group">
                                  <label for="name">Nama Area / Kode Area</label>
                                  <input type="text" name="name" id="name" class="form-control" autocapitalize="off" required>
                                  <input type="hidden" name="kategori" value="AREA">
                                  <input type="hidden" name="port_pon" value="0">
                                  <input type="hidden" name="tube" value="BIRU">
                                  <input type="hidden" name="redaman" value="0">
                              </div>
                          </div>
                          <div class="col-12 col-lg-6 col-md-6 col-xl-6 col-sm-12 col-xs-12">
                              <div class="form-group">
                                  <label for="name">Kode Pos</label>
                                  <input type="number" name="kode_pos" id="kode_pos" class="form-control" autocapitalize="off" required>
                              </div>
                          </div>
                          <div class="col-12 col-lg-12 col-md-12 col-xl-12 col-sm-12 col-xs-12">
                              <div class="form-group">
                                  <label for="address">Jalan / Dusun / Gang</label>
                                  <input type="text" name="address" id="address" class="form-control" autocapitalize="off" required>
                              </div>
                          </div>
                          <div class="col-12 col-lg-6 col-md-6 col-xl-6 col-sm-12 col-xs-12">
                              <div class="form-group">
                                  <label for="prop">Provinsi</label>
                                  <select name="prop" id="prop" class="form-control" style="width: 100%;" onchange="ajaxkota(this.value)" required>
                                      <option value="">Pilih Provinsi</option>
                                      <?php foreach ($provinsi as $data) {
                                            echo '<option value="' . $data->id . '">' . $data->nama . '</option>';
                                        } ?>
                                      <select>
                              </div>
                          </div>
                          <div class="col-12 col-lg-6 col-md-6 col-xl-6 col-sm-12 col-xs-12" id="kab_box">
                              <div class="form-group">
                                  <label for="kota">Kabupaten</label>
                                  <select name="kota" id="kota" class="form-control" style="width: 100%;" onchange="ajaxkec(this.value)" required>
                                      <option value="">Pilih Kota</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-12 col-lg-6 col-md-6 col-xl-6 col-sm-12 col-xs-12" id="kec_box">
                              <div class="form-group">
                                  <label for="kec">Kecamatan</label>
                                  <select name="kec" id="kec" class="form-control" style="width: 100%;" onchange="ajaxkel(this.value)" required>
                                      <option value="">Pilih Kecamatan</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-12 col-lg-6 col-md-6 col-xl-6 col-sm-12 col-xs-12" id="kel_box">
                              <div class="form-group">
                                  <label for="kota">Kelurahan</label>
                                  <select name="kel" id="kel" class="form-control" style="width: 100%;" required>
                                      <option value="">Pilih Kelurahan/Desa</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-6 col-lg-3 col-md-3 col-xl-3 col-sm-6 col-xs-6">
                              <div class="form-group">
                                  <label for="name">Nomor RT</label>
                                  <select class="form-control" name="nomor_rt" id="nomor_rt" required>
                                      <option value="">Pilih</option>
                                      <option value="001">001</option>
                                      <option value="002">002</option>
                                      <option value="003">003</option>
                                      <option value="004">004</option>
                                      <option value="005">005</option>
                                      <option value="006">006</option>
                                      <option value="007">007</option>
                                      <option value="008">008</option>
                                      <option value="009">009</option>
                                      <option value="010">010</option>
                                      <option value="011">011</option>
                                      <option value="012">012</option>
                                      <option value="013">013</option>
                                      <option value="014">014</option>
                                      <option value="015">015</option>
                                      <option value="016">016</option>
                                      <option value="017">017</option>
                                      <option value="018">018</option>
                                      <option value="019">019</option>
                                      <option value="020">020</option>
                                      <option value="021">021</option>
                                      <option value="022">022</option>
                                      <option value="023">023</option>
                                      <option value="024">024</option>
                                      <option value="025">025</option>
                                      <option value="026">026</option>
                                      <option value="027">027</option>
                                      <option value="028">028</option>
                                      <option value="029">029</option>
                                      <option value="030">030</option>
                                      <option value="031">031</option>
                                      <option value="032">032</option>
                                      <option value="033">033</option>
                                      <option value="034">034</option>
                                      <option value="035">035</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-6 col-lg-3 col-md-3 col-xl-3 col-sm-6 col-xs-6">
                              <div class="form-group">
                                  <label for="name">Nomor RW</label>
                                  <select class="form-control" name="nomor_rw" id="nomor_rw" required>
                                      <option value="">Pilih</option>
                                      <option value="001">001</option>
                                      <option value="002">002</option>
                                      <option value="003">003</option>
                                      <option value="004">004</option>
                                      <option value="005">005</option>
                                      <option value="006">006</option>
                                      <option value="007">007</option>
                                      <option value="008">008</option>
                                      <option value="009">009</option>
                                      <option value="010">010</option>
                                      <option value="011">011</option>
                                      <option value="012">012</option>
                                      <option value="013">013</option>
                                      <option value="014">014</option>
                                      <option value="015">015</option>
                                      <option value="016">016</option>
                                      <option value="017">017</option>
                                      <option value="018">018</option>
                                      <option value="019">019</option>
                                      <option value="020">020</option>
                                      <option value="021">021</option>
                                      <option value="022">022</option>
                                      <option value="023">023</option>
                                      <option value="024">024</option>
                                      <option value="025">025</option>
                                      <option value="026">026</option>
                                      <option value="027">027</option>
                                      <option value="028">028</option>
                                      <option value="029">029</option>
                                      <option value="030">030</option>
                                      <option value="031">031</option>
                                      <option value="032">032</option>
                                      <option value="033">033</option>
                                      <option value="034">034</option>
                                      <option value="035">035</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-12 col-lg-6 col-md-6 col-xl-6 col-sm-12 col-xs-12">
                              <div class="form-group">
                                  <label for="name">Tokoh Wilayah</label>
                                  <input type="text" name="comment" id="comment" class="form-control" autocapitalize="off" required>
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
                            $configarea = array();
                            $configarea['map_div_id'] = "map-add";
                            $configarea['map_height'] = "250px";
                            $configarea['center'] = $company['latitude'] . ',' . $company['longitude'];
                            $configarea['zoom'] = '12';
                            $configarea['map_height'] = '400px;';
                            $configarea['map_type'] = 'HYBRID';
                            $this->googlemaps->initialize($configarea);
                            $markerarea = array();
                            $markerarea['position'] = $company['latitude'] . ',' . $company['longitude'];
                            $markerarea['draggable'] = true;
                            $markerarea['ondragend'] = 'setMapToForm(event.latLng.lat(), event.latLng.lng());';
                            $this->googlemaps->add_marker($markerarea);
                            $maparea = $this->googlemaps->create_map();
                            ?>
                          <div class="col-12 col-md-12 mt-2">
                              <?php echo $maparea['js'] ?>
                              <?php echo $maparea['html'] ?>
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
                          Apakah anda yakin akan hapus data coverage <?= $data->c_name ?> ?
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