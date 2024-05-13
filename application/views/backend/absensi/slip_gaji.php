<?php
$koneksi = mysqli_connect($company['host_database'], $company['user_database'], $company['pass_database'], $company['nama_database']);
$query_kehadiran = "SELECT * FROM kehadiran WHERE id_kehadiran='$id'";
$hasil_kehadiran = mysqli_query($koneksi, $query_kehadiran);
$kehadiran = mysqli_fetch_array($hasil_kehadiran);
$id_jabatan =  $kehadiran['id_jabatan'];
$id_karyawan =  $kehadiran['id_karyawan'];
$bulan =  $kehadiran['bulan'];
$query_jabatan = "SELECT * FROM jabatan WHERE id_jabatan='$id_jabatan'";
$hasil_jabatan = mysqli_query($koneksi, $query_jabatan);
$jabatan = mysqli_fetch_array($hasil_jabatan);
$query_karyawan = "SELECT * FROM karyawan WHERE id_karyawan='$id_karyawan'";
$hasil_karyawan = mysqli_query($koneksi, $query_karyawan);
$karyawan = mysqli_fetch_array($hasil_karyawan);
$kode = $karyawan['kode'];
$id_user = $karyawan['id_user'];
$query_user = "SELECT * FROM user WHERE id='$id_user'";
$hasil_user = mysqli_query($koneksi, $query_user);
$user = mysqli_fetch_array($hasil_user);

$sakit = $kehadiran['sakit'];
$izin = $kehadiran['izin'];
$alpa = $kehadiran['alpa'];
$hadir = $kehadiran['hadir'];
$lambat = $kehadiran['lambat'];
$lembur = $kehadiran['lembur'];
$nom_lembur = $kehadiran['nom_lembur'];
$gaji_lembur = $lembur * $nom_lembur;
$bpjs = $kehadiran['bpjs'];
$thr = $kehadiran['thr'];
$rajin = $kehadiran['rajin'];
$disiplin = $kehadiran['disiplin'];
$hutang = $kehadiran['hutang'];

$gaji_pokok = $jabatan['gaji_pokok'];
$bonus_trans = $jabatan['tj_transport'];
$bonus_makan = $jabatan['uang_makan'];
$tj_transport = ($bonus_trans / 30) * $hadir;
$uang_makan = ($bonus_makan / 30) * $hadir;

$gaji_hadir = ($gaji_pokok / 30);
$gaji_sakit = ($gaji_hadir / 2);
$gaji_izin = ($gaji_hadir / 4);
$gaji_alpa = ($gaji_pokok / 15);
$gaji_lambat = ($gaji_hadir / 8);
$total_hadir = $gaji_hadir * $hadir;
$total_sakit = $gaji_sakit * $sakit;
$total_izin = $gaji_izin * $izin;
$total_alpa = $gaji_alpa * $alpa;
$total_lambat = $gaji_lambat * $lambat;

$tgl_masuk = $karyawan['tgl_masuk'];
$penerimaan = $total_hadir + $total_sakit + $total_izin + $gaji_lembur + $uang_makan + $bpjs + $tj_transport + $thr + $rajin + $disiplin;
$potongan = $total_alpa + $total_lambat + $hutang;
$gaji_diterima = $penerimaan - $potongan;
?>
<html lang="en">

<head>
  <title>Slip Gaji <?= $user['name']; ?> - <?= $bulan; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
  <div class="container-fluid">
    <table width="100%" style=" background: transparent; background-color: transparent; margin-top: 5px;">
      <br>
      <font style="color: black;">#invoice : </font>
      <font id="bulan_gajian" style="color: black;"><?= substr($kehadiran['bulan'], 0, 2); ?></font>
      <font id="tahun_gajian" style="color: black;"><?= substr($kehadiran['bulan'], 2, 4); ?></font>
      <font id="tahun" style="color: black;"><?= substr($tgl_masuk, 0, 4); ?></font>
      <font id="bulan" style="color: black;"><?= substr($tgl_masuk, 5, 2); ?></font>
      <font id="tanggal" style="color: black;"><?= substr($tgl_masuk, 8, 2); ?></font>
      <font style="color: black;">-<?= date('His'); ?></font>
      <br>
      <br>
      <thead style="border: 1px solid black;">
        <tr>
          <th colspan="11" style="font-size: 30px; font-weight: bold;" class="text-center">LAPORAN SLIP GAJI KARYAWAN</th>
        </tr>
      </thead>
      <tbody style="border: 1px solid black; border-bottom: 2px solid black;">
        <tr style="font-size: 16px; font-weight: bold;">
          <td width="15%" style="padding-left: 15px; padding-top: 10px;">Nama Perusahaan</td>
          <td width="2%" style="padding-top: 10px; padding-left: 15px;">:</td>
          <td colspan="3" style="padding-top: 10px; padding-left: 15px;">CV. @Boss.Net - Jember</td>
          <td width="10%" style="padding-top: 10px; padding-left: 15px;">&nbsp;</td>
          <td width="15%" style="padding-top: 10px; padding-left: 15px;">Kode Karyawan</td>
          <td width="2%" style="padding-top: 10px; padding-left: 15px;">:</td>
          <td colspan="3" style="padding-top: 10px; padding-left: 15px;"><?= $kode; ?></td>
        </tr>
        <tr style="font-size: 16px; font-weight: bold;">
          <td style="padding-left: 15px;">Periode Penggajian</td>
          <td style="padding-left: 15px;">:</td>
          <td style="padding-left: 15px;" colspan="3">
            <script type='text/javascript'>
              var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
              var myDays = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"];
              var date = new Date();
              var day = '01';
              var month = document.getElementById("bulan_gajian").innerHTML;

              if (month == '01') {
                var month = 0;
              }
              if (month == '02') {
                var month = 1;
              }
              if (month == '03') {
                var month = 2;
              }
              if (month == '04') {
                var month = 3;
              }
              if (month == '05') {
                var month = 4;
              }
              if (month == '06') {
                var month = 5;
              }
              if (month == '07') {
                var month = 6;
              }
              if (month == '08') {
                var month = 7;
              }
              if (month == '09') {
                var month = 8;
              }
              if (month == '10') {
                var month = 9;
              }
              if (month == '11') {
                var month = 10;
              }
              if (month == '12') {
                var month = 11;
              }

              var yy = document.getElementById("tahun_gajian").innerHTML;
              var year = (yy < 1000) ? yy + 1900 : yy;
              document.write(day + ' ' + months[month] + ' ' + year);
            </script> s/d
            <script type='text/javascript'>
              var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
              var myDays = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"];
              var date = new Date();
              var day = '01';
              var month = document.getElementById("bulan_gajian").innerHTML;

              if (month == '01') {
                var month = 1;
              }
              if (month == '02') {
                var month = 2;
              }
              if (month == '03') {
                var month = 3;
              }
              if (month == '04') {
                var month = 4;
              }
              if (month == '05') {
                var month = 5;
              }
              if (month == '06') {
                var month = 6;
              }
              if (month == '07') {
                var month = 7;
              }
              if (month == '08') {
                var month = 8;
              }
              if (month == '09') {
                var month = 9;
              }
              if (month == '10') {
                var month = 10;
              }
              if (month == '11') {
                var month = 11;
              }
              if (month == '12') {
                var month = 0;
              }

              var yy = document.getElementById("tahun_gajian").innerHTML;
              var year = (yy < 1000) ? yy + 1900 : yy;
              document.write(day + ' ' + months[month] + ' ' + year);
            </script>
          </td>
          <td>&nbsp;</td>
          <td style="padding-left: 15px;">Nama Karyawan</td>
          <td style="padding-left: 15px;">:</td>
          <td style="padding-left: 15px;" colspan="3"><?= $user['name']; ?></td>
        </tr>
        <tr style="font-size: 16px; font-weight: bold;">
          <td style="padding-left: 15px; padding-bottom: 10px;">Mulai Bekerja Sejak</td>
          <td style="padding-left: 15px; padding-bottom: 10px;">:</td>
          <td colspan="3" style="padding-left: 15px; padding-bottom: 10px;">
            <script type='text/javascript'>
              var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
              var myDays = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"];
              var day = document.getElementById("tanggal").innerHTML;
              var month = document.getElementById("bulan").innerHTML;

              if (month == '01') {
                var month = 0;
              }
              if (month == '02') {
                var month = 1;
              }
              if (month == '03') {
                var month = 2;
              }
              if (month == '04') {
                var month = 3;
              }
              if (month == '05') {
                var month = 4;
              }
              if (month == '06') {
                var month = 5;
              }
              if (month == '07') {
                var month = 6;
              }
              if (month == '08') {
                var month = 7;
              }
              if (month == '09') {
                var month = 8;
              }
              if (month == '10') {
                var month = 9;
              }
              if (month == '11') {
                var month = 10;
              }
              if (month == '12') {
                var month = 11;
              }

              var yy = document.getElementById("tahun").innerHTML;
              var year = (yy < 1000) ? yy + 1900 : yy;
              document.write(day + ' ' + months[month] + ' ' + year);
            </script> (<?php
                        $tanggal = date('Y-m-d');
                        $awal1 = $tgl_masuk;
                        $akhir1 = date('Y-m-d');

                        if (function_exists('hitungHari') == FALSE) {
                          function hitungHari($awal, $akhir)
                          {
                            $tglAwal = strtotime($awal);
                            $tglAkhir = strtotime($akhir);
                            $jeda = abs($tglAkhir - $tglAwal);
                            return floor($jeda / (60 * 60 * 24));
                          }
                        }
                        echo hitungHari($awal1, $akhir1);
                        ?> Hari)
          </td>
          <td style="padding-bottom: 10px;">&nbsp;</td>
          <td style="padding-left: 15px; padding-bottom: 10px;">Jabatan / Telepon</td>
          <td style="padding-left: 15px; padding-bottom: 10px;">:</td>
          <td style="padding-left: 15px; padding-bottom: 10px;" colspan="3"><?= $jabatan['nama_jabatan']; ?> (<?= $user['phone']; ?>)</td>
        </tr>
      </tbody>
      <tbody style="border: 1px solid black;">
        <tr style="font-size: 14px; font-weight: bold;">
          <td colspan="5" width="48%" style="padding-left: 15px; padding-right: 15px; padding-top: 10px; padding-bottom: -10px;">Penerimaan (+)</td>
          <td>&nbsp;</td>
          <td colspan="5" width="48%" style="padding-left: 15px; padding-right: 15px; padding-top: 10px; padding-bottom: -10px;">Potongan (-)</td>
        </tr>
        <tr style="font-size: 14px; font-weight: bold;">
          <td width="48%" colspan="5" style="padding-left: 15px; padding-right: 15px; padding-top: -10px;">"""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""</td>
          <td>&nbsp;</td>
          <td width="48%" colspan="5" style="padding-left: 15px; padding-right: 15px; padding-top: -10px;">""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""</td>
        </tr>
        <tr style="font-size: 14px; font-weight: bold;">
          <td style="padding-left: 15px; padding-bottom: 5px;">Keterangan</td>
          <td style="padding-left: 15px; padding-bottom: 5px;">&nbsp;</td>
          <td style="padding-left: 15px; padding-bottom: 5px;">Jumlah</td>
          <td class="text-center" style="padding-left: 15px; padding-bottom: 5px;">Sebanyak</td>
          <td class="text-right" style="padding-right: 15px; padding-bottom: 5px;">Total</td>
          <td>&nbsp;</td>
          <td style="padding-left: 15px; padding-bottom: 5px;">Keterangan</td>
          <td style="padding-left: 15px; padding-bottom: 5px;">&nbsp;</td>
          <td style="padding-left: 15px; padding-bottom: 5px;">Jumlah</td>
          <td class="text-center" style="padding-left: 15px; padding-bottom: 5px;">Sebanyak</td>
          <td class="text-right" style="padding-right: 15px; padding-bottom: 5px;">Total</td>
        </tr>
        <tr>
          <td width="15%" style="padding-left: 15px;">Gaji Absen Hadir</td>
          <td width="2%" style="padding-left: 15px;">:</td>
          <td width="11%" style="padding-left: 15px;">Rp. <?= indo_currency($gaji_hadir); ?></td>
          <td class="text-center" width="9%" style="padding-left: 15px;"><?= $hadir; ?> Hari</td>
          <td class="text-right" width="13%" style="padding-right: 15px;">Rp. <?= indo_currency($total_hadir); ?></td>
          <td width="10%" style="padding-left: 15px;">&nbsp;</td>
          <td width="15%" style="padding-left: 15px;">Denda Absen Alpa</td>
          <td width="2%" style="padding-left: 15px;">:</td>
          <td width="11%" style="padding-left: 15px;">Rp. <?= indo_currency($gaji_alpa); ?></td>
          <td class="text-center" width="9%" style="padding-left: 15px;"><?= $alpa; ?> Hari</td>
          <td class="text-right" width="13%" style="padding-right: 15px;">Rp. <?= indo_currency($total_alpa); ?></td>
        </tr>
        <tr>
          <td style="padding-left: 15px;">Gaji Absen Sakit</td>
          <td style="padding-left: 15px;">:</td>
          <td style="padding-left: 15px;">Rp. <?= indo_currency($gaji_sakit); ?></td>
          <td class="text-center" style="padding-left: 15px;"><?= $sakit; ?> Hari</td>
          <td class="text-right" style="padding-right: 15px;">Rp. <?= indo_currency($total_sakit); ?></td>
          <td style="padding-left: 15px;">&nbsp;</td>
          <td style="padding-left: 15px;">Denda Terlambat</td>
          <td style="padding-left: 15px;">:</td>
          <td style="padding-left: 15px;">Rp. <?= indo_currency($gaji_lambat); ?></td>
          <td class="text-center" style="padding-left: 15px;"><?= $lambat; ?> Hari</td>
          <td class="text-right" style="padding-right: 15px;">Rp. <?= indo_currency($total_lambat); ?></td>
        </tr>
        <tr>
          <td style="padding-left: 15px;">Gaji Absen Izin</td>
          <td style="padding-left: 15px;">:</td>
          <td style="padding-left: 15px;">Rp. <?= indo_currency($gaji_izin); ?></td>
          <td class="text-center" style="padding-left: 15px;"><?= $izin; ?> Hari</td>
          <td class="text-right" style="padding-right: 15px;">Rp. <?= indo_currency($total_izin); ?></td>
          <td style="padding-left: 15px;">&nbsp;</td>
          <td style="padding-left: 15px;">Kasbon / Hutang</td>
          <td style="padding-left: 15px;">:</td>
          <td style="padding-left: 15px;">&nbsp;</td>
          <td class="text-center" style="padding-left: 15px;">&nbsp;</td>
          <td class="text-right" style="padding-right: 15px;">Rp. <?= indo_currency($hutang); ?></td>
        </tr>
        <tr>
          <td style="padding-left: 15px;">Gaji Absen Lembur</td>
          <td style="padding-left: 15px;">:</td>
          <td style="padding-left: 15px;">Rp. <?= indo_currency($nom_lembur); ?></td>
          <td class="text-center" style="padding-left: 15px;"><?= $lembur; ?> Hari</td>
          <td class="text-right" style="padding-right: 15px;">Rp. <?= indo_currency($gaji_lembur); ?></td>
          <td style="padding-left: 15px;">&nbsp;</td>
          <td class="text-center" colspan="5" rowspan="7" style="padding-top: 15px;"><img style="opacity: 50%;" width="50%" src="<?= site_url('/assets/images/') . 'logo3.png' ?>"></td>
        </tr>
        <tr>
          <td style="padding-left: 15px;">Bonus Uang Makan</td>
          <td style="padding-left: 15px;">:</td>
          <td style="padding-left: 15px;">&nbsp;</td>
          <td class="text-center" style="padding-left: 15px;">&nbsp;</td>
          <td class="text-right" style="padding-right: 15px;">Rp. <?= indo_currency($uang_makan); ?></td>
          <td style="padding-left: 15px;">&nbsp;</td>
        </tr>
        <tr>
          <td style="padding-left: 15px;">Tunjangan BPJS</td>
          <td style="padding-left: 15px;">:</td>
          <td style="padding-left: 15px;">&nbsp;</td>
          <td class="text-center" style="padding-left: 15px;">&nbsp;</td>
          <td class="text-right" style="padding-right: 15px;">Rp. <?= indo_currency($bpjs); ?></td>
          <td style="padding-left: 15px;">&nbsp;</td>
        </tr>
        <tr>
          <td style="padding-left: 15px;">Tunjangan Transport</td>
          <td style="padding-left: 15px;">:</td>
          <td style="padding-left: 15px;">&nbsp;</td>
          <td class="text-center" style="padding-left: 15px;">&nbsp;</td>
          <td class="text-right" style="padding-right: 15px;">Rp. <?= indo_currency($tj_transport); ?></td>
          <td style="padding-left: 15px;">&nbsp;</td>
        </tr>
        <tr>
          <td style="padding-left: 15px;">Bonus THR Idul Fitri</td>
          <td style="padding-left: 15px;">:</td>
          <td style="padding-left: 15px;">&nbsp;</td>
          <td class="text-center" style="padding-left: 15px;">&nbsp;</td>
          <td class="text-right" style="padding-right: 15px;">Rp. <?= indo_currency($thr); ?></td>
          <td style="padding-left: 15px;">&nbsp;</td>
        </tr>
        <tr>
          <td style="padding-left: 15px;">Bonus Kehadiran</td>
          <td style="padding-left: 15px;">:</td>
          <td style="padding-left: 15px;">&nbsp;</td>
          <td class="text-center" style="padding-left: 15px;">&nbsp;</td>
          <td class="text-right" style="padding-right: 15px;">Rp. <?= indo_currency($rajin); ?></td>
          <td style="padding-left: 15px;">&nbsp;</td>
        </tr>
        <tr>
          <td style="padding-left: 15px;">Bonus Kedisiplinan</td>
          <td style="padding-left: 15px;">:</td>
          <td style="padding-left: 15px;">&nbsp;</td>
          <td class="text-center" style="padding-left: 15px;">&nbsp;</td>
          <td class="text-right" style="padding-right: 15px;">Rp. <?= indo_currency($disiplin); ?></td>
          <td style="padding-left: 15px;">&nbsp;</td>
        </tr>
        <tr style="font-size: 14px; font-weight: bold;">
          <td width="48%" colspan="5" style="padding-left: 15px; padding-right: 15px; padding-top: -10px;">
            <hr>
          </td>
          <td>&nbsp;</td>
          <td width="48%" colspan="5" style="padding-left: 15px; padding-right: 15px; padding-top: -10px;">
            <hr>
          </td>
        </tr>
        <tr style="font-size: 14px; font-weight: bold;">
          <td style="padding-left: 15px;">Total Penerimaan</td>
          <td style="padding-left: 15px;">:</td>
          <td style="padding-left: 15px;">&nbsp;</td>
          <td class="text-center" style="padding-left: 15px;">&nbsp;</td>
          <td class="text-right" style="padding-right: 15px;">Rp. <?= indo_currency($penerimaan); ?></td>
          <td style="padding-left: 15px;">&nbsp;</td>
          <td style="padding-left: 15px;">Total Potongan</td>
          <td style="padding-left: 15px;">:</td>
          <td style="padding-left: 15px;">&nbsp;</td>
          <td class="text-center" style="padding-left: 15px;">&nbsp;</td>
          <td class="text-right" style="padding-right: 15px;">Rp. <?= indo_currency($potongan); ?></td>
        </tr>
        <tr style="font-size: 14px; font-weight: bold;">
          <td width="100%" colspan="11" style="padding-left: 15px; padding-right: 15px;">-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</td>
        </tr>
        <tr style="font-size: 14px; font-weight: bold;">
          <td class="text-center" colspan="4" style="padding-left: 15px; padding-right: 15px; padding-top: -10px;"><b>Total Gaji Yang Diterima : Rp. <?= indo_currency($gaji_diterima); ?>
              <?php
              $status_gaji = $kehadiran['status_gaji'];
              if ($status_gaji == 'terbayar') {
              ?>
                (<i><b>
                    <font style="color: green;">terbayar</font>
                  </b></i>)
              <?php
              }
              ?>
              <?php
              if ($status_gaji == 'terhutang') {
              ?>
                (<i><b>
                    <font style="color: red;">terhutang</font>
                  </b></i>)
              <?php
              }
              ?>
            </b></td>
          <td class="text-center" colspan="7" style="padding-left: 15px; padding-right: 15px; padding-top: -10px;"><b>Terbilang : <i><?= number_to_words($gaji_diterima) ?> Rupiah</i></b></td>
        </tr>
        <tr style="font-size: 14px; font-weight: bold;">
          <td width="100%" colspan="11" style="padding-left: 15px; padding-right: 15px; padding-top: -10px;">
            <hr>
          </td>
        </tr>

        <?php
        if ($karyawan['kode_bank'] == '002') {
          $nama_banknya = 'Bank BRI';
        } elseif ($karyawan['kode_bank'] == '009') {
          $nama_banknya = 'Bank BNI';
        } elseif ($karyawan['kode_bank'] == '022') {
          $nama_banknya = 'CIMB Niaga';
        } elseif ($karyawan['kode_bank'] == '014') {
          $nama_banknya = 'Bank BCA';
        } elseif ($karyawan['kode_bank'] == '008') {
          $nama_banknya = 'Bank Mandiri';
        } elseif ($karyawan['kode_bank'] == 'CASH') {
          $nama_banknya = 'Tunai / Cash';
        } elseif ($karyawan['kode_bank'] == 'DANA') {
          $nama_banknya = 'DD DANA';
        } elseif ($karyawan['kode_bank'] == 'OVO') {
          $nama_banknya = 'DD OVO';
        } elseif ($karyawan['kode_bank'] == 'PULSA') {
          $nama_banknya = 'DD Pulsa';
        } elseif ($karyawan['kode_bank'] == 'T-MNY') {
          $nama_banknya = 'DD T-Money';
        } elseif ($karyawan['kode_bank'] == 'LAJA') {
          $nama_banknya = 'DD LinkAja';
        } elseif ($karyawan['kode_bank'] == 'GOPAY') {
          $nama_banknya = 'DD GO-Pay';
        } elseif ($karyawan['kode_bank'] == 'DO-KU') {
          $nama_banknya = 'DD DO-KU';
        } elseif ($karyawan['kode_bank'] == 'S-PAY') {
          $nama_banknya = 'DD Shopee-Pay';
        } elseif ($karyawan['kode_bank'] == 'PYPL') {
          $nama_banknya = 'DD PayPal';
        } elseif ($karyawan['kode_bank'] == 'Tidak Diketahui') {
          $nama_banknya = 'Tidak Diketahui';
        } else {
          $nama_banknya = 'Kosong';
        }
        ?>
        <tr style="font-size: 13px;">
          <td colspan="4" rowspan="9" style="padding-left: 15px;"><b>Di Transfer ke :<br> (Kode TF : <?= $karyawan['kode_bank']; ?>) <i><?= $karyawan['rek_bank']; ?></i> - <?= $nama_banknya; ?></b><br><br><i>Catatan :<br>
              <p style="padding-top: 5px;" align="justify"><b>"<?= $kehadiran['cat_absen']; ?>"</b></p>
            </i></td>
          <td colspan="3" class="text-center" rowspan="9" style="padding-left: 15px;"><i>Scan QR Code :</i><br><img style="padding-top: 5px;" width="30%" src="<?= site_url('/assets/images/qrcode/') . 'KNID-00002_072021.png' ?>"></td>
          <td colspan="2" class="text-center" style="padding-left: 15px;">&nbsp;</td>
          <td colspan="2" class="text-center" style="padding-left: 15px;"><b>Sumenep,
              <script type='text/javascript'>
                var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                var myDays = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"];
                var date = new Date();
                var day = date.getDate();
                var month = date.getMonth();
                var thisDay = date.getDay(),
                  thisDay = myDays[thisDay];
                var yy = date.getYear();
                var year = (yy < 1000) ? yy + 1900 : yy;
                document.write(day + ' ' + months[month] + ' ' + year);
              </script>
            </b></td>
        </tr>
        <tr style="font-size: 13px;">
          <td colspan="2" class="text-center" style="padding-left: 15px;">Diserahkan Oleh</td>
          <td colspan="2" class="text-center" style="padding-left: 15px;">Diterima Oleh</td>
        </tr>
        <tr>
          <td colspan="2" class="text-center">&nbsp;</td>
          <td colspan="2" class="text-center">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" class="text-center">&nbsp;</td>
          <td colspan="2" class="text-center">&nbsp;</td>
        </tr>
        <tr>
        <tr>
          <td colspan="2" class="text-center">&nbsp;</td>
          <td colspan="2" class="text-center">&nbsp;</td>
        </tr>
        <tr>
        <tr style="font-size: 13px;">
          <td colspan="2" class="text-center" style="padding-left: 15px;"><b><u><i>Ayenk Marley</i></u></b></td>
          <td colspan="2" class="text-center" style="padding-left: 15px;"><b><u><i><?= $user['name']; ?></i></u></b></td>
        </tr>
        <tr style="font-size: 13px;">
          <td colspan="2" class="text-center" style="padding-left: 15px; padding-bottom: 10px;">Dikrektur Keuangan</td>
          <td colspan="2" class="text-center" style="padding-left: 15px; padding-bottom: 10px;">Kode : <?= $kode; ?></td>
        </tr>
      </tbody>
      <tfoot style="border: 1px solid black;">
        <tr>
          <th colspan="5" style="padding: 15px; font-size: 16px;" class="text-left"><i class="fa fa-print"></i> <i class="fa fa-calendar"></i> &nbsp; Dicetak Pada :
            <script type='text/javascript'>
              var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
              var myDays = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"];
              var date = new Date();
              var day = date.getDate();
              var month = date.getMonth();
              var thisDay = date.getDay(),
                thisDay = myDays[thisDay];
              var yy = date.getYear();
              var year = (yy < 1000) ? yy + 1900 : yy;
              document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
            </script> - <?= date('H:i:s'); ?> WIB
          </th>
          <th colspan="6" style="padding: 15px; font-size: 16x;" class="text-right"><i>Perhatian : kertas ini harap disimpan dengan baik. Terimakasih</i></th>
        </tr>
      </tfoot>
    </table>
  </div>

  <style type="text/css" media="print">
    @page {
      size: a4 landscape;
    }
  </style>
  <script>
    window.print();
  </script>
</body>

</html>