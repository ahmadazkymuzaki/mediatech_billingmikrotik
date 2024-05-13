<?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 6) { ?>
<?php
    $dataRouter = $this->db->get_where('router')->result();
        foreach($dataRouter as $router){
            $router_id = $router->router_id;
            $router = $this->db->get_where('router', array('router_id' => $router_id))->row_array();
            $port = $router['port_router'];
            $host = $router['host_router'];
            $user = $router['user_router'];
            $pass = $router['pass_router'];
            $name = $router['name_router'];
            $API = new routeros();
            $API->connect($host, $port, $user, $pass);
            $hotspotuser = $API->comm("/ip/hotspot/user/print");
            $hotspotprofile= $API->comm("/ip/hotspot/user/profile/print");
            $hotspotactive = $API->comm("/ip/hotspot/active/print");
            $pppsecrets = $API->comm("/ppp/secret/print");
            $pppprofile = $API->comm("/ppp/profile/print");
            $pppactive  = $API->comm("/ppp/active/print");
            $identity1  = $API->comm("/system/identity/print");
            $resource1  = $API->comm("/system/resource/print");
            $interface = $API->comm("/interface/ethernet/print");
            $bridge = $API->comm("/interface/bridge/print");
            $waktu1 = $API->comm("/system/clock/print");
            $license1 = $API->comm("/system/license/print");
            $license2 = json_encode($license1);
            $license3 = json_decode($license2, true);
            $resource2 = json_encode($resource1);
            $resource3 = json_decode($resource2, true);
            $waktu2 = json_encode($waktu1);
            $waktu3 = json_decode($waktu2, true);
            $identity2 = json_encode($identity1);
            $identity3 = json_decode($identity2, true);
    
            $hotspotuser    = count($hotspotuser);
            $hotspotprofile   = count($hotspotprofile);
            $hotspotactive  = count($hotspotactive);
            $pppsecrets     = count($pppsecrets);
            $pppprofile     = count($pppprofile);
            $pppactive      = count($pppactive);
            $interface      = count($interface);
            $bridge         = count($bridge);
            $identity       = $identity3['0']['name'];
            $cpuname        = $resource3['0']['cpu'];
            $cpucount       = $resource3['0']['cpu-count'];
            $frequency      = $resource3['0']['cpu-frequency'];
            $cpuload        = $resource3['0']['cpu-load'];
            $uptime         = $resource3['0']['uptime'];
            $boardname      = $resource3['0']['board-name'];
            $architecture   = $resource3['0']['architecture-name'];
            $freememory     = $resource3['0']['free-memory'];
            $totalmemory    = $resource3['0']['total-memory'];
            $freehdd        = $resource3['0']['free-hdd-space'];
            $totalhdd       = $resource3['0']['total-hdd-space'];
            $architecture   = $resource3['0']['architecture-name'];
            $version        = $resource3['0']['version'];
            $buildtime      = $resource3['0']['build-time'];
            $time           = $waktu3['0']['time'];
            $date           = $waktu3['0']['date'];
            if($boardname == 'CHR'){
                $softwareid     = $license3['0']['system-id'];
                $level          = $license3['0']['level'];
                $badblock       = '0.0';
            }else{
                $softwareid     = $license3['0']['software-id'];
                $level          = $license3['0']['nlevel'];
                $badblock       = $resource3['0']['bad-blocks'];
            }
            $API->disconnect();
?>
    <div class="row mb-4">
        <div class="col-12">
            <h4>Router ID : <?= $identity ?></h4>
            <hr>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-dark shadow">
                <div class="card-body">
                    <table class="text-xs">
                        <?php
                            if($cpuload <= 20){
                                $kondisi = 'Enteng';
                            }
                            if($cpuload > 20 && $cpuload < 40){
                                $kondisi = 'Normal';
                            }
                            if($cpuload > 40 && $cpuload < 60){
                                $kondisi = 'Waspada';
                            }
                            if($cpuload > 60 && $cpuload < 80){
                                $kondisi = 'Siaga';
                            }
                            if($cpuload > 80 && $cpuload < 100){
                                $kondisi = 'Bahaya';
                            }
                        ?>
                        <tbody>
                            <tr>
                                <td colspan="3"><b>RESOURCE ROUTER</b></td>
                            </tr>
                            <tr>
                                <td>CPU Load &nbsp; </td>
                                <td>:</td>
                                <td> &nbsp; <?= $cpuload ?>% - <?= $kondisi ?></td>
                            </tr>
                            <tr>
                                <td>CPU Count &nbsp; </td>
                                <td>:</td>
                                <td> &nbsp;  <?= $cpucount ?> Core / Thread</td>
                            </tr>
                            <tr>
                                <td>CPU Freq &nbsp; </td>
                                <td>:</td>
                                <td> &nbsp; <?= $frequency ?> Mhz</td>
                            </tr>
                            <tr>
                                <td>CPU Name &nbsp; </td>
                                <td>:</td>
                                <td> &nbsp;  <?= $cpuname ?></td>
                            </tr>
                            <tr>
                                <td>Board Name &nbsp; </td>
                                <td>:</td>
                                <td> &nbsp; <?= $boardname ?></td>
                            </tr>
                            <tr>
                                <td>Architecture &nbsp; </td>
                                <td>:</td>
                                <td> &nbsp; <?= $architecture ?></td>
                            </tr>
                            <tr>
                                <td>Bad Block &nbsp; </td>
                                <td>:</td>
                                <td> &nbsp; <?= $badblock ?> %</td>
                            </tr>
                            <tr>
                                <td>OS Version &nbsp; </td>
                                <td>:</td>
                                <td> &nbsp; <?= $version ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-dark shadow">
                <div class="card-body">
                    <table class="text-xs">
                        <tbody>
                            <tr>
                                <td colspan="3"><b>HOTSPOT SERVER</b></td>
                            </tr>
                            <tr>
                                <td>Voucher &nbsp; </td>
                                <td>:</td>
                                <td> &nbsp;  <?= $hotspotuser ?> Tersisa</td>
                            </tr>
                            <tr>
                                <td>Active &nbsp; </td>
                                <td>:</td>
                                <td> &nbsp; <?= $hotspotactive ?> Perangkat</td>
                            </tr>
                            <tr>
                                <td>Profile &nbsp; </td>
                                <td>:</td>
                                <td> &nbsp; <?= $hotspotprofile ?> Paket</td>
                            </tr>
                            <tr>
                                <td colspan="3"><b>&nbsp;</b></td>
                            </tr>
                            <tr>
                                <td colspan="3"><b>PPPOE SERVER</b></td>
                            </tr>
                            <tr>
                                <td>Secret &nbsp; </td>
                                <td>:</td>
                                <td> &nbsp;  <?= $pppsecrets ?> Terdaftar</td>
                            </tr>
                            <tr>
                                <td>Active &nbsp; </td>
                                <td>:</td>
                                <td> &nbsp; <?= $pppactive ?> Pengguna</td>
                            </tr>
                            <tr>
                                <td>Profile &nbsp; </td>
                                <td>:</td>
                                <td> &nbsp; <?= $pppprofile ?> Paket</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-dark shadow">
                <div class="card-body">
                    <table class="text-xs">
                        <?php
                            $freemem_mb  = $freememory / 1024 / 1024;
                            $totalmem_mb = $totalmemory / 1024 / 1024;
                            $freehdd_mb  = $freehdd / 1024 / 1024;
                            $totalhdd_mb = $totalhdd / 1024 / 1024;
                        ?>
                        <tbody>
                            <tr>
                                <td colspan="3"><b>HARDWARE ROUTER</b></td>
                            </tr>
                            <tr>
                                <td>Free Memory &nbsp; </td>
                                <td>:</td>
                                <td> &nbsp; <?= indo_currency($freemem_mb) ?> MB</td>
                            </tr>
                            <tr>
                                <td>Total Memory &nbsp; </td>
                                <td>:</td>
                                <td> &nbsp; <?= indo_currency($totalmem_mb) ?> MB</td>
                            </tr>
                            <tr>
                                <td>Free HDD &nbsp; </td>
                                <td>:</td>
                                <td> &nbsp; <?= indo_currency($freehdd_mb) ?> MB</td>
                            </tr>
                            <tr>
                                <td>Total HDD &nbsp; </td>
                                <td>:</td>
                                <td> &nbsp; <?= indo_currency($totalhdd_mb) ?> MB</td>
                            </tr>
                            <tr>
                                <td>Ethernet &nbsp; </td>
                                <td>:</td>
                                <td> &nbsp; <?= $interface ?> Interface</td>
                            </tr>
                            <tr>
                                <td>Bridge &nbsp; </td>
                                <td>:</td>
                                <td> &nbsp; <?= $bridge ?> Interface</td>
                            </tr>
                            <tr>
                                <td>Waktu &nbsp; </td>
                                <td>:</td>
                                <td> &nbsp; <?= $time ?> WIB</td>
                            </tr>
                            <tr>
                                <td>Tanggal &nbsp; </td>
                                <td>:</td>
                                <td> &nbsp; <?= $date ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-dark shadow">
                <div class="card-body">
                    <table class="text-xs">
                        <tbody>
                            <tr>
                                <td colspan="3"><b>OTHER INFORMATION</b></td>
                            </tr>
                            <tr>
                                <td>Name Router &nbsp; </td>
                                <td>:</td>
                                <td> &nbsp; <?= $name ?></td>
                            </tr>
                            <tr>
                                <td>Host Router &nbsp; </td>
                                <td>:</td>
                                <td> &nbsp; <?= $host ?></td>
                            </tr>
                            <tr>
                                <td>Port Router &nbsp; </td>
                                <td>:</td>
                                <td> &nbsp; <?= $port ?></td>
                            </tr>
                            <tr>
                                <td>User Router &nbsp; </td>
                                <td>:</td>
                                <td> &nbsp; <?= $user ?></td>
                            </tr>
                            <tr>
                                <td>Pass Router &nbsp; </td>
                                <td>:</td>
                                <td> &nbsp; <?= $pass ?></td>
                            </tr>
                            <tr>
                                <td>Level Router &nbsp; </td>
                                <td>:</td>
                                <td> &nbsp; <?= $level ?></td>
                            </tr>
                            <?php if($boardname == 'CHR'){ ?>
                                <tr>
                                    <td>System ID &nbsp; </td>
                                    <td>:</td>
                                    <td> &nbsp; <?= $softwareid ?></td>
                                </tr>
                            <?php }else{ ?>
                                <tr>
                                    <td>Software ID &nbsp; </td>
                                    <td>:</td>
                                    <td> &nbsp; <?= $softwareid ?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td>Build Time &nbsp; </td>
                                <td>:</td>
                                <td> &nbsp; <?= $buildtime ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php } } ?>