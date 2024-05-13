<?php defined('BASEPATH') or exit('No direct script access allowed');

class Traffic extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    

    public function index()
    {
        $data['title'] = 'Traffic Router';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
        $API = new routeros();
        $host = $myrouter['host_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $port = $myrouter['port_router'];
        $API->connect($host, $port, $user, $pass);
        $traffic = $API->comm("/interface/print/stats");
        $traffic = json_encode($traffic);
        $traffic = json_decode($traffic, true);
        
        var_dump($traffic);
        
        $datagua = [
            'totaltraffic' => count($traffic),
            'traffic' => $traffic
        ];
    }

    public function update()
    {
        $router_id    = $_GET['router_id'];
        $interface    = $_GET['interface'];
        $my_service   = substr($interface, 7, -1);
        $total_tx_gb  = $_GET['total_tx_gb'];
        $total_tx_mb  = $_GET['total_tx_mb'];
        $total_tx_b   = $_GET['total_tx_b'];
        $total_rx_gb  = $_GET['total_rx_gb'];
        $total_rx_mb  = $_GET['total_rx_mb'];
        $total_rx_b   = $_GET['total_rx_b'];
        $tx_rx_gb     = $_GET['tx_rx_gb'];
        $tx_rx_mb     = $_GET['tx_rx_mb'];
        $tx_rx_b      = $_GET['tx_rx_b'];
        $date_today   = $_GET['date_today'];
        $time_today   = $_GET['time_today'];
        $update_date  = date('d-m-Y');
        $month        = date('m');
        $year         = date('Y');
        $update_time  = $date_today . ' ' . $time_today . ' WIB';
        $myCustomer  = $this->db->get_where('customer', ['username' => $my_service])->row_array();
        $no_services = $myCustomer['no_services'];
        
        $cekTraffic  = $this->db->get_where('traffic', ['nama_router' => $router_id, 'interface' => $interface, 'update_date' => $update_date])->num_rows();
        if($cekTraffic > 0){
            $myTraffic  = $this->db->get_where('traffic', ['nama_router' => $router_id, 'interface' => $interface, 'update_date' => $update_date])->row_array();
            if($myTraffic['tx_rx_b'] <= $tx_rx_b){
                $this->db->set('nama_router', $router_id);
                $this->db->set('interface', $interface);
                $this->db->set('no_services', $no_services);
                $this->db->set('username', $my_service);
                $this->db->set('month', $month);
                $this->db->set('year', $year);
                $this->db->set('total_tx_gb', $total_tx_gb);
                $this->db->set('total_tx_mb', $total_tx_mb);
                $this->db->set('total_tx_b', $total_tx_b);
                $this->db->set('total_rx_gb', $total_rx_gb);
                $this->db->set('total_rx_mb', $total_rx_mb);
                $this->db->set('total_rx_b', $total_rx_b);
                $this->db->set('tx_rx_gb', $tx_rx_gb);
                $this->db->set('tx_rx_mb', $tx_rx_mb);
                $this->db->set('tx_rx_b', $tx_rx_b);
                $this->db->set('update_date', $update_date);
                $this->db->set('update_time', $update_time);
                $this->db->where('id_traffic', $myTraffic['id_traffic']);
                $this->db->update('traffic');
            }else{
                $insertdatatraffic = [
                    'nama_router' => $router_id,
                    'interface' => $interface,
                    'no_services' => $no_services,
                    'month' => $month,
                    'year' => $year,
                    'username' => $my_service,
                    'total_tx_gb' => $total_tx_gb,
                    'total_tx_mb' => $total_tx_mb,
                    'total_tx_b' => $total_tx_b,
                    'total_rx_gb' => $total_rx_gb,
                    'total_rx_mb' => $total_rx_mb,
                    'total_rx_b' => $total_rx_b,
                    'tx_rx_gb' => $tx_rx_gb,
                    'tx_rx_mb' => $tx_rx_mb,
                    'tx_rx_b' => $tx_rx_b,
                    'update_date' => $update_date,
                    'update_time' => $update_time,
                ];
                $this->db->insert('traffic', $insertdatatraffic);
            }
        }else{
            $insertdatatraffic = [
                'nama_router' => $router_id,
                'interface' => $interface,
                'no_services' => $no_services,
                'month' => $month,
                'year' => $year,
                'username' => $my_service,
                'total_tx_gb' => $total_tx_gb,
                'total_tx_mb' => $total_tx_mb,
                'total_tx_b' => $total_tx_b,
                'total_rx_gb' => $total_rx_gb,
                'total_rx_mb' => $total_rx_mb,
                'total_rx_b' => $total_rx_b,
                'tx_rx_gb' => $tx_rx_gb,
                'tx_rx_mb' => $tx_rx_mb,
                'tx_rx_b' => $tx_rx_b,
                'update_date' => $update_date,
                'update_time' => $update_time,
            ];
            $this->db->insert('traffic', $insertdatatraffic);
        }
        
        echo 'Nama Identitas Router : '. $router_id . '<br>';
        echo 'Nama Interface Traffic : '. $interface . '<br>';
        echo 'Total Pemakaian TX (GB) : '. $total_tx_gb . ' GB<br>';
        echo 'Total Pemakaian TX (MB) : '. $total_tx_mb . ' MB<br>';
        echo 'Total Pemakaian TX (B) : '. $total_tx_b . ' B<br>';
        echo 'Total Pemakaian RX (GB) : '. $total_rx_gb . ' GB<br>';
        echo 'Total Pemakaian RX (MB) : '. $total_rx_mb . ' MB<br>';
        echo 'Total Pemakaian RX (B) : '. $total_rx_b . ' B<br>';
        echo 'Total Jumlah TX+RX (GB) : '. $tx_rx_gb . ' GB<br>';
        echo 'Total Jumlah TX+RX (MB) : '. $tx_rx_mb . ' MB<br>';
        echo 'Total Jumlah TX+RX (B) : '. $tx_rx_b . ' B<br>';
        echo 'Di Infokan Pada (waktu) : '. $update_time;
    }
    
    public function script()
    {
        $username    = $_GET['username'];
        echo '<br># Salin semua perintah berikut, kemudian tempel di terminal MikroTik<br>
<br>/system scheduler<br>
add comment=1 disabled=no name='.$username.'-RXByte.log on-event=1 policy=ftp,reboot,read,write,policy,test,password,sniff,sensitive,romon start-time='.date('H:i:s').'<br>
add comment=1 disabled=no name='.$username.'-RXByteCur.log on-event=1 policy=ftp,reboot,read,write,policy,test,password,sniff,sensitive,romon start-time='.date('H:i:s').'<br>
add comment=1 disabled=no name='.$username.'-TXByte.log on-event=1 policy=ftp,reboot,read,write,policy,test,password,sniff,sensitive,romon start-time='.date('H:i:s').'<br>
add comment=1 disabled=no name='.$username.'-TXByteCur.log on-event=1 policy=ftp,reboot,read,write,policy,test,password,sniff,sensitive,romon start-time='.date('H:i:s').'<br>
add disabled=no interval=10m name='.$username.'-RESET-RXTX on-event=":local varDate;\r\<br>
    \n:local varDay;\r\<br>
    \n:set varDate [/system clock get date];\r\<br>
    \n:set varDay [:pick \$varDate 4 6];\r\<br>
    \n:if (\$varDay = \"01\") do={\r\<br>
    \n/system scheduler set RXByte.log comment=\"1\" on-event=\"1\"\r\<br>
    \n/system scheduler set RXByteCur.log comment=\"1\" on-event=\"1\"\r\<br>
    \n/system scheduler set TXByte.log comment=\"1\" on-event=\"1\"\r\<br>
    \n/system scheduler set TXByteCur.log comment=\"1\" on-event=\"1\"\r\<br>
    \n/system scheduler disable [/system scheduler find name=\"'.$username.'-RESET-RXTX\"]\r\<br>
    \n}" policy=\<br>
    ftp,reboot,read,write,policy,test,password,sniff,sensitive,romon start-time='.date('H:i:s').'<br>
add disabled=no interval=10m name='.$username.'-MONITORING on-event=":local InterFaceNya "pppoe-'.$username.'>";\r\<br>
    \n:local datesekarang [/system clock get date];\r\<br>
    \n:local timesekarang [/system clock get time];\r\<br>
    \n:local routerid [/system identity get name];\r\<br>
    \n:local TOTQuota 1800;\r\<br>
    \n:local RXByteCur [/interface get \$InterFaceNya rx-byte];\r\<br>
    \n:local RXByteCount [/system scheduler get '.$username.'-RXByteCur.log on-event];\r\<br>
    \n:local RXByte [/system scheduler get '.$username.'-RXByte.log on-event];\r\<br>
    \n:local TXByteCur [/interface get \$InterFaceNya tx-byte];\r\<br>
    \n:local TXByteCount [/system scheduler get '.$username.'-TXByteCur.log on-event];\r\<br>
    \n:local TXByte [/system scheduler get '.$username.'-TXByte.log on-event];\r\<br>
    \n:local ifReboot 0;\r\<br>
    \n:if (\$RXByteCur>=\$RXByteCount) do={} else={:set \$ifReboot (\$ifReboot\<br>
    +1);}\r\<br>
    \n:if (\$TXByteCur>=\$TXByteCount) do={} else={:set \$ifReboot (\$ifReboot\<br>
    +1);}\r\<br>
    \n:if (\$ifReboot>=1) do={\r\<br>
    \n:set \$RXByte (\$RXByte+\$RXByteCount);\r\<br>
    \n/system scheduler set '.$username.'-RXByte.log comment=\$RXByte on-event=\$RXByte\r\<br>
    \n:set \$TXByte (\$TXByte+\$TXByteCount);\r\<br>
    \n/system scheduler set '.$username.'-TXByte.log comment=\$TXByte on-event=\$TXByte\r\<br>
    \n} else={\r\<br>
    \n}\r\<br>
    \n:set RXByteCount (\$RXByteCur);\r\<br>
    \n/system scheduler set '.$username.'-RXByteCur.log comment=\$RXByteCount on-event=\$RXB\<br>
    yteCount\r\<br>
    \n:set TXByteCount (\$TXByteCur);\r\<br>
    \n/system scheduler set '.$username.'-TXByteCur.log comment=\$TXByteCount on-event=\$TXB\<br>
    yteCount\r\<br>
    \n:local RXTot (\$RXByte+\$RXByteCur);\r\<br>
    \n:local RXMB (\$RXTot / 1024 / 1024);\r\<br>
    \n:local RXGB (\$RXTot  / 1024 / 1024 / 1024);\r\<br>
    \n:local TXTot (\$TXByte+\$TXByteCur);\r\<br>
    \n:local TXMB (\$TXTot / 1024 / 1024);\r\<br>
    \n:local TXGB (\$TXTot / 1024 / 1024 / 1024);\r\<br>
    \n:local RXTX (\$RXTot+\$TXTot);\r\<br>
    \n:local RXTXMB (\$RXMB+\$TXMB);\r\<br>
    \n:local RXTXGB (\$RXGB+\$TXGB);\r\<br>
    \n:local percent (\$RXTXGB*100 / \$TOTQuota);\r\<br>
    \n/tool fetch http-method=post url=\"https://rtrwnet.xyz/traffic/\<br>
    update\?router_id=\$routerid&interface=\$InterFaceNya&total_tx_gb=\$TXGB&total_t\<br>
    x_mb=\$TXMB&total_tx_b=\$TXTot&total_rx_gb=\$RXGB&total_rx_mb=\$RXMB&total\<br>
    _rx_b=\$RXTot&tx_rx_gb=\$RXTXGB&tx_rx_mb=\$RXTXMB&tx_rx_b=\$RXTX&date_toda\<br>
    y=\$datesekarang&time_today=\$timesekarang\" mode=http keep-result=no;\r\<br>
    \n:log warning \"INTERFACE MONITORING DIRECTLY ==> \$InterFaceNya <== TO APPLICA\<br>
    TION DATABASE\";\r\<br>
    \n:local varDate;\r\<br>
    \n:local varDay;\r\<br>
    \n:set varDate [/system clock get date];\r\<br>
    \n:set varDay [:pick \$varDate 4 6];\r\<br>
    \n:if (\$varDay = \"29\") do={\r\<br>
    \n/system scheduler enable [/system scheduler find name=\"'.$username.'-RESET-RXTX\"];\r\<br>
    \n}" policy=\<br>
    ftp,reboot,read,write,policy,test,password,sniff,sensitive,romon \<br>
    start-time='.date('H:i:s').'<br><br>
    # Salin semua Perintah sampai disini !!!<br><br>';
    }
    
    public function queue()
    {
        $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
        $API = new routeros();
        $host = $myrouter['host_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $port = $myrouter['port_router'];
        $API->connect($host, $port, $user, $pass);
        $simple = $API->comm("/queue/simple/print");
        $simple = json_encode($simple);
        $simple = json_decode($simple, true);

        $datagua = [
            'totalsimple' => count($simple),
            'simple' => $simple
        ];
        foreach($simple as $data){
            echo '========================================================<br>';
            echo 'ID Queue : '.$data['.id'].'<br>';
            echo 'Invalid : '.$data['invalid'].'<br>';
            echo 'Dynamic : '.$data['dynamic'].'<br>';
            echo 'Disabled : '.$data['disabled'].'<br>';
            echo 'Name : '.$data['name'].'<br>';
            echo 'Target : '.$data['target'].'<br>';
            echo 'Max Limit : '.$data['max-limit'].'<br>';
            echo 'Burst Limit : '.$data['burst-limit'].'<br>';
            echo 'Burst Threshold : '.$data['burst-threshold'].'<br>';
            echo 'Burst Time : '.$data['burst-time'].'<br>';
            echo 'Packet Marks : '.$data['packet-marks'].'<br>';
            echo 'Limit At : '.$data['limit-at'].'<br>';
            echo 'Priority : '.$data['priority'].'<br>';
            echo 'Bucket Size : '.$data['bucket-size'].'<br>';
            echo 'Queue Type : '.$data['queue'].'<br>';
            echo 'Parent : '.$data['parent'].'<br>';
            echo 'Bytes : '.$data['bytes'].'<br>';
            echo 'Total Bytes : '.$data['total-bytes'].'<br>';
            echo 'Total Rate : '.$data['total-rate'].'<br>';
            echo 'Packet Rate : '.$data['packet-rate'].'<br>';
            echo 'Packets : '.$data['packets'].'<br>';
            echo 'Total Packets : '.$data['total-packets'].'<br>';
            echo 'Dropped : '.$data['dropped'].'<br>';
            echo 'Total Dropped : '.$data['total-dropped'].'<br>';
            echo 'Rate Traffic : '.$data['rate'].'<br>';
            echo 'Total Packet Rate : '.$data['total-packet-rate'].'<br>';
            echo 'Queued Packets : '.$data['queued-packets'].'<br>';
            echo 'Total Queued Packets : '.$data['total-queued-packets'].'<br>';
            echo 'Queued Bytes : '.$data['queued-bytes'].'<br>';
            echo 'Total Queued Bytes : '.$data['total-queued-bytes'].'<br>';
            echo '========================================================<br>';
            echo '<br>';
        }
    }
}