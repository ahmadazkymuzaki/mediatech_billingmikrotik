<?php
    $cekdataku = $this->db->get_where('customer', array('no_services' => $no_services))->num_rows();
		
	if($cekdataku > 0){
        $customer = $this->db->get_where('customer', array('no_services' => $no_services))->row_array();
?>
<?php
    $cektraffic = $this->db->get_where('traffic', array('no_services' => $no_services, 'month' => $month, 'year' => $year))->row_array();
    		
    if($cektraffic > 0){
        $traffic = $this->db->get_where('traffic', ['no_services' => $no_services])->row_array();
?>
            <div class="info-tagihan">
                <div class="container">
                    <div class="card shadow mb-3" style="border: solid 1px grey;">
                        <div class="container mt-3">
                            <center>
                                <h3>Periode <?= indo_month($month) ?> <?= $year ?>
                            </center>
                            </h3>
                            <?php
                                $batas   = 200;
                                $persen  = $batas / 100;
                                $persen1 = indo_currency($traffic['total_rx_gb'] / $persen);
                                $persen2 = indo_currency($traffic['total_tx_gb'] / $persen);
                                $persen3 = indo_currency($traffic['tx_rx_gb'] / $persen);
                                $persen4 = indo_currency(($batas - $traffic['tx_rx_gb']) / $persen);
                            ?>
                            <div class="row">
                                <div class="col-12">
                                    =====================<br>
                                    Download :
                                    <b>
                                        <font style="color: black;"><?= indo_currency($traffic['total_rx_gb']) ?> GB (<?= $persen1 ?>%)</font>
                                    </b><br>
                                    Download :
                                    <b>
                                        <font style="color: black;"><?= indo_currency($traffic['total_rx_mb']) ?> MB</font>
                                    </b><br>
                                    Download :
                                    <b>
                                        <font style="color: black;"><?= indo_currency(($traffic['total_rx_b'] / 1024)) ?> KB</font>
                                    </b><br>
                                    =====================<br>
                                    Upload :
                                    <b>
                                        <font style="color: black;"><?= indo_currency($traffic['total_tx_gb']) ?> GB (<?= $persen2 ?>%)</font>
                                    </b><br>
                                    Upload :
                                    <b>
                                        <font style="color: black;"><?= indo_currency($traffic['total_tx_mb']) ?> MB</font>
                                    </b><br>
                                    Upload :
                                    <b>
                                        <font style="color: black;"><?= indo_currency(($traffic['total_tx_b'] / 1024)) ?> KB</font>
                                    </b><br>
                                    =====================<br>
                                    Total D+U :
                                    <b>
                                        <font style="color: black;"><?= indo_currency($traffic['tx_rx_gb']) ?> GB (<?= $persen3 ?>%)</font>
                                    </b><br>
                                    Total D+U :
                                    <b>
                                        <font style="color: black;"><?= indo_currency($traffic['tx_rx_mb']) ?> MB</font>
                                    </b><br>
                                    Total D+U :
                                    <b>
                                        <font style="color: black;"><?= indo_currency(($traffic['tx_rx_b'] / 1024)) ?> KB</font>
                                    </b><br>
                                    =====================<br>
                                    Interface :
                                    <b>
                                        <font style="color: black;"><?= 'pppoe-' . $customer['username'] ?></font>
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
                    <h4 class="card-title text-danger">Data Pemakaian Belum Tersedia</h4>
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