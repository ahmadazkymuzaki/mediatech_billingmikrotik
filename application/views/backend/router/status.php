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
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid"><br>
      <!-- Info boxes -->
      <div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
        <div class="card-body">
          <!-- Content Header (Page header) -->
          <section class="content">
            <div class="box">
              <h5 style="text-align: center;">
                Router Terkoneksi Saat Ini
              </h5>
              <div class="table-responsive">
                <table id="dataTable" class="table table-bordered" style="border: 3px solid #cacaca;">
                  <thead>
                    <tr style="text-align: center">
                      <th colspan="6">Identitas Router : <?= $identity; ?> (<?= $date; ?> - <?= $time; ?> WIB)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td style="text-align: center;" width="5%">1</td>
                      <td width="15%">CPU Count</td>
                      <td width="30%"><?= $cpucount; ?> Core &nbsp; ( Freq. : <?= $frequency; ?> Mhz )</td>
                      <td style="text-align: center;" width="5%">7</td>
                      <td width="15%">Router Uptime</td>
                      <td width="30%"><?= $uptime; ?> &nbsp; ( BB : <?= $badblock; ?> % )</td>
                    </tr>
                    <tr>
                      <td style="text-align: center;" width="5%">2</td>
                      <td width="15%">CPU Load</td>
                      <td width="30%"><?= $cpuload; ?> % &nbsp; ( <?= $cpuname; ?> )</td>
                      <td style="text-align: center;" width="5%">8</td>
                      <td width="15%">Router OS</td>
                      <td width="30%">Version <?= $version; ?></td>
                    </tr>
                    <tr>
                      <td style="text-align: center;" width="5%">3</td>
                      <td width="15%">Free Memory</td>
                      <td width="30%">
                        <?php
                        function formatBytes1($bytes, $decimal = null)
                        {
                          $satuan = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
                          $i = 0;
                          while ($bytes > 1024) {
                            $bytes /= 1024;
                            $i++;
                          }
                          return round($bytes, $decimal) . ' ' . $satuan[$i];
                        }
                        ?>
                        <?= formatBytes1($freememory, 2) ?> / <?= formatBytes1($totalmemory, 2) ?>
                      </td>
                      <td style="text-align: center;" width="5%">9</td>
                      <td width="15%">Hotspot Active</td>
                      <td width="30%"><?= $hotspotactive; ?> Device</td>
                    </tr>
                    <tr>
                      <td style="text-align: center;" width="5%">4</td>
                      <td width="15%">Free HDD</td>
                      <td width="30%">
                        <?php
                        function formatBytes($bytes, $decimal = null)
                        {
                          $satuan = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
                          $i = 0;
                          while ($bytes > 1024) {
                            $bytes /= 1024;
                            $i++;
                          }
                          return round($bytes, $decimal) . ' ' . $satuan[$i];
                        }
                        ?>
                        <?= formatBytes($freehdd, 2) ?> / <?= formatBytes($totalhdd, 2) ?>
                      </td>
                      <td style="text-align: center;" width="5%">10</td>
                      <td width="15%">Users Hotspot</td>
                      <td width="30%"><?= $hotspotuser; ?> Voucher</td>
                    </tr>
                    <tr>
                      <td style="text-align: center;" width="5%">5</td>
                      <td width="15%">RouterBoard</td>
                      <td width="30%"><?= $boardname; ?> &nbsp; ( <?= $architecture; ?> )</td>
                      <td style="text-align: center;" width="5%">11</td>
                      <td width="15%">PPP Active</td>
                      <td width="30%"><?= $pppactive; ?> Customer</td>
                    </tr>
                    <tr>
                      <td style="text-align: center;" width="5%">6</td>
                      <td width="15%">Level Lisence</td>
                      <td width="30%"><?= $level; ?> &nbsp; ( SW ID : <?= $software; ?> )</td>
                      <td style="text-align: center;" width="5%">12</td>
                      <td width="15%">Secret PPP</td>
                      <td width="30%"><?= $pppsecrets; ?> Account</td>
                    </tr>
                    <tr>
                      <td colspan="2" style="text-align: center;">
                        <div class="d-sm-flex align-items-center justify-content-between">
                          <?php if ($this->session->userdata('role_id') == 1) { ?>
                            <a href="<?= site_url('mikrotik/reboot') ?>" onclick="return confirm('Apakah anda yakin akan merestart Router <?= $identity; ?> ?')" class="d-sm-inline-block btn btn-sm btn-<?= $company['theme'] ?> shadow-sm">
                              <i class="fa fa-power-off fa-sm text-white-50"></i> Reboot MikroTik Now
                            </a>
                          <?php } ?>
                        </div>
                      </td>
                      <td style="text-align: left; font-size: 20px;">
                        <b><?php
                            $koneksi = mysqli_connect($company['host_database'], $company['user_database'], $company['pass_database'], $company['nama_database']);
                            $queryku = mysqli_query($koneksi, "SELECT * from router WHERE description='Aktif'");
                            $routerku = mysqli_fetch_array($queryku);
                            echo $routerku['name_router'];
                            ?></b>
                      </td>
                      <td style="text-align: center;" width="5%">13</td>
                      <td width="15%">Dapat IP Public</td>
                      <td width="30%"><?= $publicrouter; ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </section>
        </div>
      </div>
      <br>
    </div>
    <!--/. container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->