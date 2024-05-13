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
<div class="row">
    <div class="col-lg-4">
        <div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
            <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-center">Generate Script Router MikroTik</h6>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-body">
                        <form method="post">
                            <div class="form-group">
                                <center><label for="host_router">IP Gateway Modem ISP</label></center>
                                <input type="text" id="gateway" name="gateway" class="form-control" placeholder="192.168.1.1" required>
                            </div>
                            <div class="form-group">
                                <center><label for="host_router">IP Address MikroTik</label></center>
                                <input type="text" id="address" name="address" class="form-control" placeholder="192.168.1.2/24" required>
                            </div>
                            <div class="form-group">
                                <center><label for="host_router">Total Download ISP</label></center>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="number" id="down_isp" name="down_isp" class="form-control" placeholder="50" required>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" id="host_router" name="host_router" class="form-control" placeholder="MBPS" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <center><label for="host_router">Total Upload ISP</label></center>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="number" id="up_isp" name="up_isp" class="form-control" placeholder="10" required>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" id="host_router" name="host_router" class="form-control" placeholder="MBPS" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <center><label for="host_router">DNS Name Hotspot</label></center>
                                <input type="text" id="dns_name" name="dns_name" class="form-control" placeholder="DNS Name Hotspot" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Reset</button>
                        <button type="submit" name="submit" id="submit" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>">Generate Script</button>
                    </div>
                    </form>
                </div>
                <?php echo form_close() ?>


            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['submit'])) {
        $gateway = $_POST['gateway'];
        $address = $_POST['address'];
        $down_isp = $_POST['down_isp'];
        $up_isp = $_POST['up_isp'];
        $dns_name = $_POST['dns_name'];
        $download = floor(($down_isp / 100) * 80);
        $upload = floor(($up_isp / 100) * 80);
    ?>
        <div class="col-lg-8">
            <div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
                <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
                    <h6 class="m-0 text-center font-weight-bold">Hasil Generate Script</h6>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-body">
                            <p style="margin-bottom: -5px;">
                                # ============================= SEGMEN 01 ============================<br>
                                <br>
                                /sys note set show-at-login=yes note="BUNG IQBAL : 087849918464 (WA)"<br>
                                <br>
                                <b>/interface bridge</b><br>
                                add name=Bridge-HOTSPOT<br>
                                add name=Bridge-INTERNET<br>
                                add name=Bridge-PRIVATE<br>
                                <br>
                                # ============================= SEGMEN 02 ============================<br>
                                <br>
                                <b>/interface vlan</b><br>
                                add interface=Bridge-HOTSPOT name=Vlan-HOTSPOT vlan-id=101<br>
                                <br>
                                # ============================= SEGMEN 03 ============================<br>
                                <br>
                                <b>/ip firewall layer7-protocol</b><br>
                                add name=speedtest regexp="^.+(speedtest).*\\\$"<br>
                                add name=streaming regexp="^.+(.youtube.|ytimg|googlevideo.com|youtu.be).*\$"<br>
                                <br>
                                # ============================= SEGMEN 04 ============================<br>
                                <br>
                                <b>/ip hotspot profile</b><br>
                                add dns-name=<font style="color: green; font-weight: bold;"><?= $dns_name; ?></font> hotspot-address=192.168.4.1 html-directory=\<br>
                                flash/hotspot login-by=cookie,http-chap,http-pap,trial,mac-cookie name=\<br>
                                Profile-HOTSPOT trial-uptime-limit=3m<br>
                                <br>
                                # ============================= SEGMEN 05 ============================<br>
                                <br>
                                <b>/ip pool</b><br>
                                add name=Pool-HOTSPOT ranges=192.168.4.2-192.168.4.254<br>
                                add name=Pool-PRIVATE ranges=192.168.2.2-192.168.2.254<br>
                                add name=Pool-PPPOE ranges=192.168.3.2-192.168.3.254<br>
                                add name=Pool-EXPIRED ranges=192.168.5.2-192.168.5.254<br>
                                <br>
                                # ============================= SEGMEN 06 ============================<br>
                                <br>
                                <b>/ip dhcp-server</b><br>
                                add address-pool=Pool-HOTSPOT disabled=no interface=Bridge-HOTSPOT name=\<br>
                                Address-HOTSPOT<br>
                                add address-pool=Pool-PRIVATE disabled=no interface=Bridge-PRIVATE name=\<br>
                                Address-PRIVATE<br>
                                <br>
                                # ============================= SEGMEN 07 ============================<br>
                                <br>
                                <b>/ip hotspot</b><br>
                                add address-pool=Pool-HOTSPOT addresses-per-mac=1 disabled=no interface=\<br>
                                Bridge-HOTSPOT name=Server-HOTSPOT profile=Profile-HOTSPOT<br>
                                <br>
                                # ============================= SEGMEN 08 ============================<br>
                                <br>
                                <b>/queue tree</b><br>
                                add name="GLOBAL ALL" parent=global<br>
                                add name=A.ISP1 parent="GLOBAL ALL"<br>
                                add name=1.UKKNOWN packet-mark=no-mark parent="GLOBAL ALL"<br>
                                <br>
                                # ============================= SEGMEN 09 ============================<br>
                                <br>
                                <b>/queue simple</b><br>
                                add name=Limit-GAMER packet-marks="PORT SELAIN PORT UMUM(GAME) DOWN ISP1,PORT \<br>
                                SELAIN PORT UMUM(GAME) UP ISP1,ICMP DOWN ISP1,ICMP UP ISP1,no-mark" \<br>
                                priority=3/3 queue=default/default target=\<br>
                                192.168.2.0/24,192.168.3.0/24,192.168.4.0/24<br>
                                add name=Limit-SPEEDTEST packet-marks="SPEEDTES DOWN ISP1,SPEEDTES UP ISP1" \<br>
                                priority=3/3 queue=default/default target=\<br>
                                192.168.2.0/24,192.168.3.0/24,192.168.4.0/24<br>
                                add name=Limit-TRAFFIC packet-marks="DOWNLOAD ALL ISP1,UPLUAD ALL ISP1,PORT BE\<br>
                                RAT DOWN ISP1,PORT BERAT UP ISP1,STREAMING VIDEO DOWN ISP1,STREAMING VIDEO\<br>
                                \_UP ISP1,UMUM BERAT DOWN ISP1,UMUM BERAT UP ISP1" priority=3/3 queue=\<br>
                                default/default target=192.168.2.0/24,192.168.3.0/24,192.168.4.0/24<br>
                                add name=Limit-PPPOE parent=Limit-TRAFFIC priority=3/3 queue=default/default \<br>
                                target=192.168.3.0/24<br>
                                add name=Limit-HOTSPOT parent=Limit-TRAFFIC priority=3/3 queue=\<br>
                                default/default target=192.168.4.0/24<br>
                                add max-limit=1M/1M name=Limit-EXPIRED parent=Limit-TRAFFIC priority=3/3 \<br>
                                queue=default/default target=192.168.4.0/24<br>
                                add name=Limit-PRIVATE parent=Limit-TRAFFIC priority=3/3 queue=\<br>
                                default/default target=192.168.2.0/24<br>
                                add max-limit=1M/2M name=Limit-ADMIN parent=Limit-PRIVATE target=\<br>
                                192.168.2.2/32<br>
                                <br>
                                # ============================= SEGMEN 10 ============================<br>
                                <br>
                                <b>/ip hotspot user profile</b><br>
                                set [ find default=yes ] insert-queue-before=bottom mac-cookie-timeout=1d \<br>
                                parent-queue=Limit-HOTSPOT queue-type=default-small rate-limit=1M/2M<br>
                                add address-pool=Pool-HOTSPOT insert-queue-before=bottom mac-cookie-timeout=\<br>
                                1d name=Profile-1MB parent-queue=Limit-HOTSPOT queue-type=default-small \<br>
                                rate-limit=512k/1M<br>
                                add address-pool=Pool-HOTSPOT insert-queue-before=bottom mac-cookie-timeout=\<br>
                                1d name=Profile-2MB parent-queue=Limit-HOTSPOT queue-type=default-small \<br>
                                rate-limit=1M/2M<br>
                                add address-pool=Pool-HOTSPOT insert-queue-before=bottom mac-cookie-timeout=\<br>
                                1d name=Profile-3MB parent-queue=Limit-HOTSPOT queue-type=default-small \<br>
                                rate-limit=1536k/3M<br>
                                add address-pool=Pool-HOTSPOT insert-queue-before=bottom mac-cookie-timeout=\<br>
                                1d name=Profile-4MB parent-queue=Limit-HOTSPOT queue-type=default-small \<br>
                                rate-limit=2M/4M<br>
                                add address-pool=Pool-HOTSPOT insert-queue-before=bottom mac-cookie-timeout=\<br>
                                1d name=Profile-5MB parent-queue=Limit-HOTSPOT queue-type=default-small \<br>
                                rate-limit=2560k/5M<br>
                                <br>
                                # ============================= SEGMEN 11 ============================<br>
                                <br>
                                <b>/queue tree</b><br>
                                add name=ISP1-DOWNLOAD parent=A.ISP1 queue=pcq-download-default<br>
                                add name=ISP1-UPLUAD parent=A.ISP1 queue=pcq-upload-default<br>
                                add name="2.ISP1-ICMP DOWN" packet-mark="ICMP DOWN ISP1" parent=ISP1-DOWNLOAD \<br>
                                priority=2 queue=pcq-download-default<br>
                                add name="1.ISP1-GAME DOWN" packet-mark=\<br>
                                "PORT SELAIN PORT UMUM(GAME) DOWN ISP1" parent=ISP1-DOWNLOAD priority=1 \<br>
                                queue=pcq-download-default<br>
                                add max-limit=<font style="color: green; font-weight: bold;"><?= $download; ?>M</font> name="4.ISP1-ALL TRAFIC DOWN" parent=ISP1-DOWNLOAD \<br>
                                priority=2 queue=pcq-download-default<br>
                                add name="a.isp1-umum ringan all down" packet-mark="DOWNLOAD ALL ISP1" \<br>
                                parent="4.ISP1-ALL TRAFIC DOWN" priority=2 queue=pcq-download-default<br>
                                add name="d.isp1-port random berat down" packet-mark="PORT BERAT DOWN ISP1" \<br>
                                parent="4.ISP1-ALL TRAFIC DOWN" priority=2 queue=pcq-download-default<br>
                                add name="e.isp1-speedtest web down" packet-mark="SPEEDTES DOWN ISP1" parent=\<br>
                                "4.ISP1-ALL TRAFIC DOWN" priority=2 queue=default<br>
                                add name="1.ISP1-GAME UP" packet-mark="PORT SELAIN PORT UMUM(GAME) UP ISP1" \<br>
                                parent=ISP1-UPLUAD priority=1 queue=pcq-upload-default<br>
                                add name="2.ISP1-ICMP UP" packet-mark="ICMP UP ISP1" parent=ISP1-UPLUAD \<br>
                                priority=2 queue=pcq-upload-default<br>
                                add max-limit=<font style="color: green; font-weight: bold;"><?= $upload; ?>M</font> name="4.ISP1-ALL TRAFIC UP" parent=ISP1-UPLUAD priority=2 \<br>
                                queue=pcq-upload-default<br>
                                add name="a.isp1-umum ringan all up" packet-mark="UPLUAD ALL ISP1" parent=\<br>
                                "4.ISP1-ALL TRAFIC UP" priority=2 queue=pcq-upload-default<br>
                                add name="d.isp1-port random berat up" packet-mark="PORT BERAT UP ISP1" \<br>
                                parent="4.ISP1-ALL TRAFIC UP" priority=2 queue=pcq-upload-default<br>
                                add name="e.isp1-speedtest web up" packet-mark="SPEEDTES UP ISP1" parent=\<br>
                                "4.ISP1-ALL TRAFIC UP" priority=2 queue=default<br>
                                add name="b.isp1-Streaming video down" packet-mark=\<br>
                                "STREAMING VIDEO DOWN ISP1" parent="4.ISP1-ALL TRAFIC DOWN" priority=2 \<br>
                                queue=pcq-download-default<br>
                                add name="b.isp1-Streaming video up" packet-mark="STREAMING VIDEO UP ISP1" \<br>
                                parent="4.ISP1-ALL TRAFIC UP" priority=2 queue=pcq-upload-default<br>
                                add name="c.isp1-umum berat all down" packet-mark="UMUM BERAT DOWN ISP1" \<br>
                                parent="4.ISP1-ALL TRAFIC DOWN" priority=2 queue=pcq-download-default<br>
                                add name="c.isp1-umum berat all up" packet-mark="UMUM BERAT UP ISP1" parent=\<br>
                                "4.ISP1-ALL TRAFIC UP" priority=2 queue=pcq-upload-default<br>
                                <br>
                                # ============================= SEGMEN 12 ============================<br>
                                <br>
                                <b>/interface bridge port</b><br>
                                add bridge=Bridge-INTERNET interface=ether1<br>
                                add bridge=Bridge-PRIVATE interface=ether2<br>
                                add bridge=Bridge-HOTSPOT interface=ether3<br>
                                add bridge=Bridge-HOTSPOT interface=ether4<br>
                                add bridge=Bridge-HOTSPOT interface=ether5<br>
                                <br>
                                # ============================= SEGMEN 13 ============================<br>
                                <br>
                                <b>/interface pppoe-server server</b><br>
                                add disabled=no interface=Bridge-HOTSPOT keepalive-timeout=60 service-name=\<br>
                                Service-PPPOE<br>
                                <br>
                                # ============================= SEGMEN 14 ============================<br>
                                <br>
                                <b>/ip address</b><br>
                                add address=<font style="color: green; font-weight: bold;"><?= $address; ?></font> interface=Bridge-INTERNET<br>
                                add address=192.168.2.1/24 interface=Bridge-PRIVATE network=192.168.2.0<br>
                                add address=192.168.4.1/24 interface=Bridge-HOTSPOT network=192.168.4.0<br>
                                <br>
                                # ============================= SEGMEN 15 ============================<br>
                                <br>
                                <b>/ip cloud</b><br>
                                set ddns-enabled=yes<br>
                                <br>
                                # ============================= SEGMEN 16 ============================<br>
                                <br>
                                <b>/ip dhcp-server network</b><br>
                                add address=192.168.2.0/24 gateway=192.168.2.1<br>
                                add address=192.168.4.0/24 gateway=192.168.4.1<br>
                                <br>
                                # ============================= SEGMEN 17 ============================<br>
                                <br>
                                <b>/ip dns</b><br>
                                set allow-remote-requests=yes servers=8.8.8.8,8.8.4.4<br>
                                <br>
                                # ============================= SEGMEN 18 ============================<br>
                                <br>
                                <b>/ip firewall address-list</b><br>
                                add address=192.168.2.0/24 list=lokal<br>
                                add address=192.168.3.0/24 list=lokal<br>
                                add address=192.168.4.0/24 list=lokal<br>
                                add address=<font style="color: green; font-weight: bold;"><?= $address; ?></font> list=kecuali<br>
                                add address=<font style="color: green; font-weight: bold;"><?= $gateway; ?></font> list=kecuali<br>
                                add address=192.168.2.0/24 list=kecuali<br>
                                add address=192.168.3.0/24 list=kecuali<br>
                                add address=192.168.4.0/24 list=kecuali<br>
                                add address=192.168.5.0/24 list=expired<br>
                                <br>
                                # ============================= SEGMEN 19 ============================<br>
                                <br>
                                <b>/ip firewall filter</b><br>
                                add action=passthrough chain=unused-hs-chain comment=\<br>
                                "place hotspot rules here" disabled=yes<br>
                                add action=drop chain=forward dst-address=<font style="color: green; font-weight: bold;"><?= $gateway; ?></font> dst-port=80 protocol=\<br>
                                tcp<br>
                                add action=drop chain=forward src-address-list=expired<br>
                                <br>
                                # ============================= SEGMEN 20 ============================<br>
                                <br>
                                <b>/ip firewall mangle</b><br>
                                add action=mark-connection chain=prerouting comment="TOTAL ALL" \<br>
                                dst-address-list="!IP MENGGUNAKAN PORT RANDOM" new-connection-mark=\<br>
                                "TOTAL ALL" passthrough=yes protocol=!icmp src-address-list=lokal<br>
                                add action=mark-packet chain=forward connection-mark="TOTAL ALL" \<br>
                                dst-address-list=lokal in-interface=Bridge-INTERNET new-packet-mark=\<br>
                                "DOWNLOAD ALL ISP1" passthrough=yes protocol=!icmp src-address-list=\<br>
                                "!IP MENGGUNAKAN PORT RANDOM"<br>
                                add action=mark-packet chain=forward connection-mark="TOTAL ALL" \<br>
                                dst-address-list="!IP MENGGUNAKAN PORT RANDOM" new-packet-mark=\<br>
                                "UPLUAD ALL ISP1" out-interface=Bridge-INTERNET passthrough=yes protocol=\<br>
                                !icmp src-address-list=lokal<br>
                                add action=add-dst-to-address-list address-list="IP MENGGUNAKAN PORT RANDOM" \<br>
                                address-list-timeout=1m chain=prerouting comment=GAME dst-address-list=\<br>
                                !kecuali dst-port=\<br>
                                !21,22,23,81,88,5060,843,182,8777,1935,53,8000-8081,443,80 protocol=tcp \<br>
                                src-address-list=lokal<br>
                                add action=add-dst-to-address-list address-list="IP MENGGUNAKAN PORT RANDOM" \<br>
                                address-list-timeout=1m chain=prerouting dst-address-list=!kecuali \<br>
                                dst-port=!21,22,23,81,88,5060,843,182,8777,1935,53,8000-8081,443,80 \<br>
                                protocol=udp src-address-list=lokal<br>
                                add action=mark-packet chain=forward dst-address-list=lokal in-interface=\<br>
                                Bridge-INTERNET new-packet-mark="PORT SELAIN PORT UMUM(GAME) DOWN ISP1" \<br>
                                passthrough=yes src-address-list="IP MENGGUNAKAN PORT RANDOM"<br>
                                add action=mark-packet chain=forward dst-address-list=\<br>
                                "IP MENGGUNAKAN PORT RANDOM" new-packet-mark=\<br>
                                "PORT SELAIN PORT UMUM(GAME) UP ISP1" out-interface=Bridge-INTERNET \<br>
                                passthrough=yes src-address-list=lokal<br>
                                add action=add-dst-to-address-list address-list="PORT BERAT" \<br>
                                address-list-timeout=59m chain=prerouting comment="PORT RANDOM BERAT" \<br>
                                connection-rate=1M-999M dst-address-list="IP MENGGUNAKAN PORT RANDOM" \<br>
                                src-address-list=lokal<br>
                                add action=add-dst-to-address-list address-list="PORT BERAT" \<br>
                                address-list-timeout=59m chain=prerouting connection-bytes=\<br>
                                10000000-999000000 dst-address-list="IP MENGGUNAKAN PORT RANDOM" \<br>
                                src-address-list=lokal<br>
                                add action=mark-packet chain=forward dst-address-list=lokal in-interface=\<br>
                                Bridge-INTERNET new-packet-mark="PORT BERAT DOWN ISP1" passthrough=no \<br>
                                src-address-list="PORT BERAT"<br>
                                add action=mark-packet chain=forward dst-address-list="PORT BERAT" \<br>
                                new-packet-mark="PORT BERAT UP ISP1" out-interface=Bridge-INTERNET \<br>
                                passthrough=no src-address-list=lokal<br>
                                add action=mark-connection chain=prerouting comment=ICMP new-connection-mark=\<br>
                                ICMP passthrough=yes protocol=icmp<br>
                                add action=mark-packet chain=forward connection-mark=ICMP in-interface=\<br>
                                Bridge-INTERNET new-packet-mark="ICMP DOWN ISP1" passthrough=no<br>
                                add action=mark-packet chain=forward connection-mark=ICMP new-packet-mark=\<br>
                                "ICMP UP ISP1" out-interface=Bridge-INTERNET passthrough=no<br>
                                add action=mark-connection chain=prerouting comment=SPEEDTEST \<br>
                                layer7-protocol=speedtest new-connection-mark=speedtes passthrough=yes<br>
                                add action=mark-packet chain=forward connection-mark=speedtes in-interface=\<br>
                                Bridge-INTERNET new-packet-mark="SPEEDTES DOWN ISP1" passthrough=no<br>
                                add action=mark-packet chain=forward connection-mark=speedtes \<br>
                                new-packet-mark="SPEEDTES UP ISP1" out-interface=Bridge-INTERNET \<br>
                                passthrough=no<br>
                                add action=add-dst-to-address-list address-list="UMUM BERAT" \<br>
                                address-list-timeout=25s chain=prerouting comment="TRAFICK UMUM BERAT" \<br>
                                connection-bytes=5000000-999000000 connection-mark="TOTAL ALL" \<br>
                                connection-rate=512k-999M dst-address-list="!IP MENGGUNAKAN PORT RANDOM" \<br>
                                layer7-protocol=!streaming src-address-list=lokal<br>
                                add action=mark-packet chain=forward dst-address-list=lokal in-interface=\<br>
                                Bridge-INTERNET layer7-protocol=!streaming new-packet-mark=\<br>
                                "UMUM BERAT DOWN ISP1" passthrough=yes src-address-list="UMUM BERAT"<br>
                                add action=mark-packet chain=forward dst-address-list="UMUM BERAT" \<br>
                                layer7-protocol=!streaming new-packet-mark="UMUM BERAT UP ISP1" \<br>
                                out-interface=Bridge-INTERNET passthrough=yes src-address-list=lokal<br>
                                add action=mark-packet chain=forward comment="STREAMING VIDEO" \<br>
                                dst-address-list=lokal in-interface=Bridge-INTERNET layer7-protocol=\<br>
                                streaming new-packet-mark="STREAMING VIDEO DOWN ISP1" passthrough=no<br>
                                add action=mark-packet chain=forward layer7-protocol=streaming \<br>
                                new-packet-mark="STREAMING VIDEO UP ISP1" out-interface=Bridge-INTERNET \<br>
                                passthrough=no src-address-list=lokal<br>
                                <br>
                                # ============================= SEGMEN 21 ============================<br>
                                <br>
                                <b>/ip firewall nat</b><br>
                                add action=masquerade chain=srcnat out-interface=Bridge-INTERNET<br>
                                add action=passthrough chain=unused-hs-chain comment=\<br>
                                "place hotspot rules here" disabled=yes<br>
                                add action=masquerade chain=srcnat comment="masquerade hotspot network" \<br>
                                src-address=192.168.4.0/24<br>
                                <br>
                                # ============================= SEGMEN 22 ============================<br>
                                <br>
                                <b>/ip hotspot user</b><br>
                                add name=admin password=112233 server=Server-HOTSPOT<br>
                                <br>
                                # ============================= SEGMEN 23 ============================<br>
                                <br>
                                <b>/ip route</b><br>
                                add distance=1 gateway=<font style="color: green; font-weight: bold;"><?= $gateway; ?></font><br>
                                <br>
                                # ============================= SEGMEN 24 ============================<br>
                                <br>
                                <b>/ip service</b><br>
                                set telnet disabled=yes<br>
                                set ftp disabled=yes<br>
                                set ssh disabled=yes<br>
                                set api-ssl disabled=yes<br>
                                <br>
                                # ============================ SEGMEN 25 ============================<br>
                                <br>
                                <b>/ppp profile</b><br>
                                add insert-queue-before=bottom local-address=192.168.4.1 name=Profile-1M-50RB \<br>
                                on-up="{\r\<br>
                                \n:local usernya \$user;\r\<br>
                                \n:if ([/system schedule find name=\$usernya]=\"\") do={\r\<br>
                                \n/system schedule add name=\$usernya interval=30d on-event=\"/ppp secret \<br>
                                set profile=Profile-EXPIRED [find name=\$usernya]\\r\\n/ppp active remove \<br>
                                [find name=\$usernya]\\r\\n/system schedule remove [find name=\$usernya]\"\<br>
                                \r\<br>
                                \n}\r\<br>
                                \n}" only-one=yes parent-queue=Limit-PPPOE queue-type=default-small \<br>
                                rate-limit=512k/1M remote-address=Pool-PPPOE use-ipv6=default<br>
                                add insert-queue-before=bottom name=Profile-EXPIRED parent-queue=\<br>
                                Limit-EXPIRED queue-type=default-small rate-limit=50k/100k \<br>
                                remote-address=Pool-EXPIRED use-ipv6=default<br>
                                add insert-queue-before=bottom local-address=192.168.4.1 name=\<br>
                                Profile-2MB-100RB on-up="{\r\<br>
                                \n:local usernya \$user;\r\<br>
                                \n:if ([/system schedule find name=\$usernya]=\"\") do={\r\<br>
                                \n/system schedule add name=\$usernya interval=30d on-event=\"/ppp secret \<br>
                                set profile=Profile-EXPIRED [find name=\$usernya]\\r\\n/ppp active remove \<br>
                                [find name=\$usernya]\\r\\n/system schedule remove [find name=\$usernya]\"\<br>
                                \r\<br>
                                \n}\r\<br>
                                \n}" only-one=yes parent-queue=Limit-PPPOE queue-type=default-small \<br>
                                rate-limit=1M/2M remote-address=Pool-PPPOE use-ipv6=default<br>
                                add insert-queue-before=bottom local-address=192.168.4.1 name=\<br>
                                Profile-3MB-150RB on-up="{\r\<br>
                                \n:local usernya \$user;\r\<br>
                                \n:if ([/system schedule find name=\$usernya]=\"\") do={\r\<br>
                                \n/system schedule add name=\$usernya interval=30d on-event=\"/ppp secret \<br>
                                set profile=Profile-EXPIRED [find name=\$usernya]\\r\\n/ppp active remove \<br>
                                [find name=\$usernya]\\r\\n/system schedule remove [find name=\$usernya]\"\<br>
                                \r\<br>
                                \n}\r\<br>
                                \n}" only-one=yes parent-queue=Limit-PPPOE queue-type=default-small \<br>
                                rate-limit=1536k/3M remote-address=Pool-PPPOE use-ipv6=default<br>
                                add insert-queue-before=bottom local-address=192.168.4.1 name=\<br>
                                Profile-4MB-200RB on-up="{\r\<br>
                                \n:local usernya \$user;\r\<br>
                                \n:if ([/system schedule find name=\$usernya]=\"\") do={\r\<br>
                                \n/system schedule add name=\$usernya interval=30d on-event=\"/ppp secret \<br>
                                set profile=Profile-EXPIRED [find name=\$usernya]\\r\\n/ppp active remove \<br>
                                [find name=\$usernya]\\r\\n/system schedule remove [find name=\$usernya]\"\<br>
                                \r\<br>
                                \n}\r\<br>
                                \n}" only-one=yes parent-queue=Limit-PPPOE queue-type=default-small \<br>
                                rate-limit=2M/4M remote-address=Pool-PPPOE use-ipv6=default<br>
                                add insert-queue-before=bottom local-address=192.168.4.1 name=\<br>
                                Profile-5MB-250RB on-up="{\r\<br>
                                \n:local usernya \$user;\r\<br>
                                \n:if ([/system schedule find name=\$usernya]=\"\") do={\r\<br>
                                \n/system schedule add name=\$usernya interval=30d on-event=\"/ppp secret \<br>
                                set profile=Profile-EXPIRED [find name=\$usernya]\\r\\n/ppp active remove \<br>
                                [find name=\$usernya]\\r\\n/system schedule remove [find name=\$usernya]\"\<br>
                                \r\<br>
                                \n}\r\<br>
                                \n}" only-one=yes parent-queue=Limit-PPPOE queue-type=default-small \<br>
                                rate-limit=2560k/5M remote-address=Pool-PPPOE use-ipv6=default<br>
                                <br>
                                # ============================= SEGMEN 26 ============================<br>
                                <br>
                                <b>/ppp secret</b><br>
                                add name=admin password=112233 profile=Profile-1M-50RB service=pppoe<br>
                                <br>
                                # ============================= SEGMEN 27 ============================<br>
                                <br>
                                <b>/system identity</b><br>
                                set name=MikRoBot-App<br>
                                <br>
                                # ============================= SEGMEN 28 ============================<br>
                                <br>
                                <b>/system ntp client</b><br>
                                set enabled=yes primary-ntp=202.65.114.202 secondary-ntp=119.82.243.189<br>
                                <br>
                                # ============================= SEGMEN 29 ============================<br>
                                <br>
                                <b>/system scheduler</b><br>
                                add interval=1m name=Auto-DELETE on-event=\<br>
                                "/queue simple remove [find name=hs-<Server-HOTSPOT>]" policy=\<br>
                                    ftp,reboot,read,write,policy,test,password,sniff,sensitive,romon \<br>
                                    start-time=startup<br>
                                    add interval=10s name=Auto-REBOOT on-event="/system reboot\r\<br>
                                    \ny\r\<br>
                                    \n" policy=\<br>
                                    ftp,reboot,read,write,policy,test,password,sniff,sensitive,romon \<br>
                                    start-date=jun/12/2021 start-time=21:31:44<br>
                                    <br>
                                    # ============================= SEGMEN 30 ============================<br>
                                    <br>
                                    /interface l2tp-client<br>
                                    add connect-to=vpn.labkom.my.id disabled=no name=VPN-REMOTE password=bungiqbal \<br>
                                    user=bungiqbal<br>
                                    <br>
                                    # ============================= SEGMEN 31 ============================<br>
                                    <br>
                                    /ip firewall mangle<br>
                                    add action=change-ttl chain=postrouting new-ttl=set:1 out-interface=Bridge-HSP passthrough=no<br>
                            </p>
                        </div>
                        <div class="modal-footer">
                            <center>Tutorial by : <a href="https://www.facebook.com/bung.iqbal80" target="_blank" style="color: black; font-weight: bold; text-decoration: none;">BUNG IQBAL</a></center>
                        </div>
                    </div>
                    <?php echo form_close() ?>


                </div>
            </div>
        </div>
    <?php } ?>
</div>