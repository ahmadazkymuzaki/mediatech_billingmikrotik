<div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-2">
    <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
        <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data Wilayah Indonesia</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="tablebt" width="100%" cellspacing="0">
                <thead>
                    <tr style="text-align: center">
                        <th style="text-align: center">No</th>
                        <th style="text-align: center">Kode</th>
                        <th style="text-align: center">Kelurahan</th>
                        <th style="text-align: center">Kode</th>
                        <th style="text-align: center">Kecamatan</th>
                        <th style="text-align: center">Kode</th>
                        <th style="text-align: center">Kabupaten</th>
                        <th style="text-align: center">Kode</th>
                        <th style="text-align: center">Provinsi</th>
                        <th style="text-align: center">Kode Pos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $kelurahan = $this->db->get('wilayah_desa')->result();
                    $no = 1;
                    foreach ($kelurahan as $value) {
                        $kode_kelurahan = $value->id;
                        $nama_kelurahan = $value->nama;
                        $kode_kecamatan = $value->kecamatan_id;

                        $wil_Kecamatan  = $this->db->get_where('wilayah_kecamatan', array('id' => $kode_kecamatan))->row_array();
                        $nama_kecamatan = $wil_Kecamatan['nama'];
                        $kode_kabupaten = $wil_Kecamatan['kabupaten_id'];

                        $wil_Kabupaten  = $this->db->get_where('wilayah_kabupaten', array('id' => $kode_kabupaten))->row_array();
                        $nama_kabupaten = $wil_Kabupaten['nama'];
                        $kode_provinsi  = $wil_Kabupaten['provinsi_id'];

                        $wil_Provinsi   = $this->db->get_where('wilayah_provinsi', array('id' => $kode_provinsi))->row_array();
                        $nama_provinsi  = $wil_Provinsi['nama'];
                    ?>
                        <tr>
                            <td style="text-align: center"><?= $no++ ?></td>
                            <td style="text-align: center"><?= $kode_kelurahan ?></td>
                            <td style="text-align: left"><?= $nama_kelurahan ?></td>
                            <td style="text-align: center"><?= $kode_kecamatan ?></td>
                            <td style="text-align: left"><?= $nama_kecamatan ?></td>
                            <td style="text-align: center"><?= $kode_kabupaten ?></td>
                            <td style="text-align: left"><?= $nama_kabupaten ?></td>
                            <td style="text-align: center"><?= $kode_provinsi ?></td>
                            <td style="text-align: left"><?= $nama_provinsi ?></td>
                            <td style="text-align: center"></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>