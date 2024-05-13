<?php
    $cekdataku = $this->db->get_where('customer', array('no_services' => $no_services))->num_rows();
		
	if($cekdataku > 0){
	    if($pppactive > 0){
?>
            <div class="info-tagihan">
                <div class="container">
                    <div class="card shadow mb-3" style="border: solid 1px grey;">
                        <div class="container mt-3">
                            <center>
                                <h3>Koneksi Modem ONLINE
                            </center>
                            </h3>
                            <div class="row">
                                <div class="col-12">
                                    Interface :
                                    <b>
                                        <font style="color: black;"><?= $pppservice ?>-<?= $pppname ?></font>
                                    </b><br>
                                    Alamat IP :
                                    <b>
                                        <font style="color: black;"><?= $pppaddress ?></font>
                                    </b><br>
                                    Alamat Lokal :
                                    <b>
                                        <font style="color: black;"><?= $ppplocal ?></font>
                                    </b><br>
                                    DNS Server :
                                    <b>
                                        <font style="color: black;"><?= $pppserver ?></font>
                                    </b><br>
                                    Alamat MAC :
                                    <b>
                                        <font style="color: black;"><?= $pppcaller ?></font>
                                    </b><br>
                                    Aktif Selama :
                                    <b>
                                        <font style="color: black;"><?= $pppuptime ?></font>
                                    </b><br>
                                    Mode Layanan :
                                    <b>
                                        <font style="color: black;"><?= $pppservice ?></font>
                                    </b><br>
                                    Profile :
                                    <b>
                                        <font style="color: black;"><?= $pppprofile ?></font>
                                    </b><br>
                                    Speed Internet :
                                    <b>
                                        <font style="color: black;"><?= $ppplimit ?></font>
                                    </b><br>
                                    T. Putus :
                                    <b>
                                        <font style="color: black;"><?= $ppplogged ?></font>
                                    </b><br>
                                    Alasan Putus :
                                    <b>
                                        <font style="color: black;"><?= $pppreason ?></font>
                                    </b><br>
                                    Dengan ID Sesi :
                                    <b>
                                        <font style="color: black;"><?= $pppsession ?></font>
                                    </b><br><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php
    } else {
    echo '<div class="text-center mb-3">
        <div class="container">
            <div class="card border-danger">
                <div class="card-body">
                    <h4 class="card-title text-danger">Koneksi Modem Anda Saat Ini OFFLINE</h4>
                </div>
            </div>
        </div>
    </div>';
    }
} else {
    echo '<div class="text-center mb-3">
        <div class="container">
            <div class="card border-warning">
                <div class="card-body">
                    <h4 class="card-title text-warning">Nomor Layanan tidak Terdaftar, pastikan Nomor Layanan anda Benar atau silahkan Hubungi Admin.</h4>
                </div>
            </div>
        </div>
    </div>';
} ?>