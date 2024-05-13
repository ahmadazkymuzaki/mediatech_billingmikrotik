<?php defined('BASEPATH') or exit('No direct script access allowed');

class Webhook extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    
    public function gratisan($voucher)
	{
        $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
        $host = $myrouter['host_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $port = $myrouter['port_router'];

		$API = new routeros();
		$API->connect($host, $port, $user, $pass);

		$API->comm("/ip/hotspot/user/add", array(
			"name" => $voucher,
			"password" => $voucher,
			"profile" => 'Trial-5-MENIT-Rp0',
			"server" => 'Server-HOTSPOT',
			"limit-uptime" => '00:05:00',
			"limit-bytes-in" => '100M',
			"limit-bytes-out" => '100M',
			"limit-bytes-total" => '100M',
			"comment" => 'Gratisan by WhatsApp'
		));
		$API->disconnect();
	}
	
    public function buatvoucher($voucher)
	{
		$perintah  = explode("123", $voucher);
        $username  = $perintah[0];
        $password  = $perintah[1];
        $severhspt = $perintah[2];
        $profile   = $perintah[3];
        
        $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
        $host = $myrouter['host_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $port = $myrouter['port_router'];

		$API = new routeros();
		$API->connect($host, $port, $user, $pass);

		$API->comm("/ip/hotspot/user/add", array(
			"name" => $username,
			"password" => $password,
			"profile" => $profile,
			"server" => $severhspt,
			"comment" => 'Dibuat Dari WhatsApp'
		));
		$API->disconnect();
	}
	
    public function buatpppoe($pppoe)
	{
		$perintah  = explode("123", $pppoe);
        $username  = $perintah[0];
        $password  = $perintah[1];
        $serviceppp = $perintah[2];
        $profile   = $perintah[3];
        
        $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
        $host = $myrouter['host_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $port = $myrouter['port_router'];

		$API = new routeros();
		$API->connect($host, $port, $user, $pass);

		$API->comm("/ppp/secret/add", array(
			"name" => $username,
			"password" => $password,
			"profile" => $profile,
			"service" => $serviceppp,
			"comment" => 'Dibuat Dari WhatsApp'
		));
		$API->disconnect();
	}
    
    public function codeqr()
	{
        //Type respon (json)
        // { "status" : "processing", "message" : "processing"  }
        // { "status" : true, "message" : "Already Connected"  }
        // { "status" : false, "qrcode" : "qr url",  "message" : "Please Scan qrcode"  }
    
        $data = [
            'api_key' => '8vi8WNBqKKnwA9guXgked8doTO7bAs',
            'number'  => '6281911991146',
           
            ];
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://wa-bot.my.id/generate-qr",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => json_encode($data),
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));
        
        $response = curl_exec($curl);
        $iniPesan = json_decode($response, true);
        $message  = $iniPesan['message'];
        $status   = $iniPesan['status'];
        $qrcode   = $iniPesan['qrcode'];
        $errornya = curl_error($curl);
        curl_close($curl);
        
        if($status == 'processing'){
            echo $message.'<br>';
        }elseif($status == true){
            echo $message.'<br>';
        }else{
            echo $message.'<br>';
            echo $qrcode.'<br>';
        }
        
        echo $qrcode;
	}
	
    public function index()
    {
        $HostDatabase = 'localhost';
        $UserDatabase = 'naux3337_bill';
        $PassDatabase = 'naux3337_bill';
        $NamaDatabase = 'naux3337_bill';
        $koneksi = mysqli_connect($HostDatabase,$UserDatabase,$PassDatabase,$NamaDatabase);
        
        header('content-type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);
        file_put_contents('whatsapp.txt', '[' . date('Y-m-d H:i:s') . "]\n" . json_encode($data) . "\n\n", FILE_APPEND);                                               
        $message = strtolower($data['message']);
        $messagenya = $data['message'];
        $from = strtolower($data['from']);
        $respon = false;
        
        $params = [
            'pengirim' => $from,
            'penerima' => '6281911991146',
            'pesan' => $messagenya,
            'kategori' => 'Manual',
            'tanggal' => date('Y-m-d'),
            'waktu' => date('H:i:s'),
            'url_web' => base_url(),
        ];
        $this->db->insert('webhook', $params);
        
        // auto respond text   
        function sayHello($from){    
            return ["text" => 'Selamat Pagi '.$from];
        }
        
        function search($messagenya, $from)
        {
            $secret_key = "Bearer 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";
            
            $request_body = [
                "model" => "text-davinci-003",
                "prompt" => $messagenya,
                "temperature" => 0.9,
                "max_tokens" => 150,
                "top_p" => 1,
                "frequency_penalty" => 0.0,
                "presence_penalty" => 0.6,
                "stop" => [" Human:", " AI:"]
            ];
            
            $postfields = json_encode($request_body);
            $curl = curl_init();
            
            curl_setopt_array($curl, [
                CURLOPT_URL => "https://api.openai.com/v1/completions",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $postfields,
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json',
                    'Authorization: ' . $secret_key
                ],
            ]);
                    
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            $IniResponNya = json_decode($response, true);
            $responnya    = $IniResponNya['choices'][0]['text'];
            $balasanwa    = substr($responnya, 0, 1);
            $balasanwanya = substr($responnya, 0, 2);
            $balasanwaku  = substr($responnya, 0, 3);
            
            $HostDatabase = 'localhost';
            $UserDatabase = 'naux3337_bill';
            $PassDatabase = 'naux3337_bill';
            $NamaDatabase = 'naux3337_bill';
            $koneksi = mysqli_connect($HostDatabase,$UserDatabase,$PassDatabase,$NamaDatabase);
        
            $pengirimnya  = '6281911991146';
            $penerimanya  = $from;
            $kategorinya  = 'Open AI';
            $tanggalnya   = date('Y-m-d');
            $waktunya     = date('H:i:s');
            $url_webnya   = 'https://api.openai.com/v1/completions';
            $timestamp    = date('Y-m-d H:i:s');
            $id_webnya    = '110';
            
            $querygua = mysqli_query($koneksi, "SELECT * FROM webhook WHERE id_web='$id_webnya'");
            $datagua = mysqli_fetch_array($querygua);
            $penanda = substr($datagua['tanda'], 0, 2);
            
            if($balasanwanya == $penanda){
                $balasannya   = substr($responnya, 2, 1000000);
            }else{
                $balasannya   = $responnya;
            }
            
            mysqli_query($koneksi,"INSERT INTO webhook VALUES('', '$pengirimnya', '$balasanwaku', '$penerimanya', '$balasannya', '$kategorinya', '$tanggalnya', '$waktunya', '$url_webnya', '$timestamp')");
            
            return ["text" => $balasannya];
        }
         
        // auto respon lists
        function lists(){
            $sections = [
                [ 
                	"title" => "This is List menu",
                	"rows" => [
        	            ["title" => "List 1", "description" => "this is list one"],
        	            ["title" => "List 2", "description" => "this is list two"],
            	    ] 
                ]
            ];
         
            $listMessage = [
                "text" => "This is a list",
                "title" => "Title Chat",
                "buttonText" => "Select what will you do?",
                "sections" => $sections
            ];
         
            return $listMessage;  
        } 
         
        //auto respond button
        function button(){
            $buttons = [
                ['buttonId' => 'id1', 'buttonText' => ['displayText' => 'BUTTON 1'], 'type' => 1], // button 1 // 
                ['buttonId' => 'id2', 'buttonText' => ['displayText' => 'BUTTON 2'], 'type' => 1], // button 2
                ['buttonId' => 'id3', 'buttonText' => ['displayText' => 'BUTTON 3'], 'type' => 1], // button 3
            ];
            $buttonMessage = [
                'text' => 'HOLA, INI ADALAH PESAN BUTTON', 
                'footer' => 'ini pesan footer', 
                'buttons' => $buttons,
                'headerType' => 1 
            ];
            return $buttonMessage;
        }
        
        // auto respond gambaar            
        function gambar(){
            $HostDatabase = 'localhost';
            $UserDatabase = 'naux3337_bill';
            $PassDatabase = 'naux3337_bill';
            $NamaDatabase = 'naux3337_bill';
            $koneksi = mysqli_connect($HostDatabase,$UserDatabase,$PassDatabase,$NamaDatabase);
            $query = mysqli_query($koneksi, "SELECT * FROM company WHERE status='Aktif'");
            $datacompany    = mysqli_fetch_array($query);
            $company_name   = $datacompany['company_name'];
            $address        = $datacompany['address'];
            $owner          = $datacompany['owner'];
            $website        = $datacompany['website'];
            $billing        = $datacompany['billing'];
            $logo           = $datacompany['logo'];
            $phone          = $datacompany['phone'];
            $email          = $datacompany['email'];
            $whatsapp       = $datacompany['whatsapp'];
            $image          = $billing.'/assets/images/'.$logo;
            
            return [
                'image' => ['url' => $image],
                'caption' => $image
            ];   
        }
        
        function perusahaan(){
            $HostDatabase = 'localhost';
            $UserDatabase = 'naux3337_bill';
            $PassDatabase = 'naux3337_bill';
            $NamaDatabase = 'naux3337_bill';
            $koneksi = mysqli_connect($HostDatabase,$UserDatabase,$PassDatabase,$NamaDatabase);
            $query = mysqli_query($koneksi, "SELECT * FROM company WHERE status='Aktif'");
            $datacompany    = mysqli_fetch_array($query);
            $company_name   = $datacompany['company_name'];
            $nama_singkat   = $datacompany['nama_singkat'];
            $sub_name       = $datacompany['sub_name'];
            $address        = $datacompany['address'];
            $owner          = $datacompany['owner'];
            $ppn            = $datacompany['ppn'];
            $due_date       = $datacompany['due_date'];
            $website        = $datacompany['website'];
            $billing        = $datacompany['billing'];
            $logo           = $datacompany['logo'];
            $phone          = $datacompany['phone'];
            $email          = $datacompany['email'];
            $whatsapp       = $datacompany['whatsapp'];
            $facebook       = $datacompany['facebook'];
            $twitter        = $datacompany['twitter'];
            $instagram      = $datacompany['instagram'];
            $website        = $datacompany['website'];
            $telegram       = $datacompany['telegram'];
            $youtube        = $datacompany['youtube'];
            $image          = $billing.'/assets/images/'.$logo;
            
            return [
                'image' => ['url' => $image],
                'caption' => '*'.strtoupper($company_name).'*
'.$nama_singkat.' - '.$sub_name.'

*Alamat Perusahaan :*
'.$address.'

*Informasi Lainnya :*
Direktur => '.$owner.'
Pajak PErusahaan (PPN) => '.$ppn.'%
Tanggal Jatuh Tempo => '.$due_date.'
Nomor Telepon => '.$phone.'
Email => '.$email.'

*Sosial Media Kami :*
WA => wa.me/'.$whatsapp.'
FB => https://fb.me/'.$facebook.'
IG => instagram.com/'.$instagram.'
TW => https://twitter.com/'.$twitter.'
TG => https://t.me/'.$telegram.'
YT => https://'.$youtube.'
CT => '.$billing.'
WS => '.$website];   
        }
        
        // auto respond text   
        function lainnya(){
            $HostDatabase = 'localhost';
            $UserDatabase = 'naux3337_bill';
            $PassDatabase = 'naux3337_bill';
            $NamaDatabase = 'naux3337_bill';
            $koneksi = mysqli_connect($HostDatabase,$UserDatabase,$PassDatabase,$NamaDatabase);
            $query = mysqli_query($koneksi, "SELECT * FROM company WHERE status='Aktif'");
            $datacompany     = mysqli_fetch_array($query);
            $nama_singkat    = $datacompany['nama_singkat'];   
            
            return ["text" => 'Kata Perintah Tidak Bot Ketahui atau Anda
Ulangi Kata Perintah jika Bot tidak Jawab !
Terimakasih 🙏 (mohon tidak spam chat)
*TTD : Bot '.$nama_singkat.'*'];
        }
        
        // auto respond text   
        function android(){
            $HostDatabase = 'localhost';
            $UserDatabase = 'naux3337_bill';
            $PassDatabase = 'naux3337_bill';
            $NamaDatabase = 'naux3337_bill';
            $koneksi = mysqli_connect($HostDatabase,$UserDatabase,$PassDatabase,$NamaDatabase);
            $query = mysqli_query($koneksi, "SELECT * FROM company WHERE status='Aktif'");
            $datacompany     = mysqli_fetch_array($query);
            $nama_singkat    = $datacompany['nama_singkat'];
            $link_app        = $datacompany['link_app']; 
            
            return ["text" => '*Link Download Aplikasi '.$nama_singkat.'*
'.$link_app];
        }
        
        // auto respond text   
        function mytagihan(){
            return ["text" => 'Silahkan Kirim Nomor Invoice'];
        }
        
        // auto respond text   
        function cektagihan(){
            return ["text" => 'Silahkan Kirim Nomor Invoice'];
        }
        
        // auto respond text   
        function buatvoucher($username, $password, $severhspt, $profile){
            $HostDatabase = 'localhost';
            $UserDatabase = 'naux3337_bill';
            $PassDatabase = 'naux3337_bill';
            $NamaDatabase = 'naux3337_bill';
            $koneksi = mysqli_connect($HostDatabase,$UserDatabase,$PassDatabase,$NamaDatabase);
            $query = mysqli_query($koneksi, "SELECT * FROM company WHERE status='Aktif'");
            $datacompany     = mysqli_fetch_array($query);
            $nama_singkat    = $datacompany['nama_singkat'];
            $billing         = $datacompany['billing'];
            $voucher = $username.'123'.$password.'123'.$severhspt.'123'.$profile;
        
            $url_gratisan = $billing . '/webhook/buatvoucher/'.$voucher;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url_gratisan);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);
            
            return ["text" => '*User Hotspot '.$nama_singkat.'*
            
Paket : '.$profile.'
Username : '.$username.'
Password : '.$password.'
Server : '.$severhspt.'
Telah Berhasil Dibuat

*TTD : Bot '.$nama_singkat.'*'];
        }
        
        // auto respond text   
        function buatpppoe($username, $password, $serviceppp, $profile){
            $HostDatabase = 'localhost';
            $UserDatabase = 'naux3337_bill';
            $PassDatabase = 'naux3337_bill';
            $NamaDatabase = 'naux3337_bill';
            $koneksi = mysqli_connect($HostDatabase,$UserDatabase,$PassDatabase,$NamaDatabase);
            $query = mysqli_query($koneksi, "SELECT * FROM company WHERE status='Aktif'");
            $datacompany     = mysqli_fetch_array($query);
            $nama_singkat    = $datacompany['nama_singkat'];
            $billing         = $datacompany['billing'];
            $pppoe = $username.'123'.$password.'123'.$serviceppp.'123'.$profile;
        
            $url_gratisan = $billing . '/webhook/buatpppoe/'.$pppoe;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url_gratisan);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);
            
            return ["text" => '*Secret PPP '.$nama_singkat.'*
            
Paket : '.$profile.'
Username : '.$username.'
Password : '.$password.'
Service : '.$serviceppp.'
Telah Berhasil Dibuat

*TTD : Bot '.$nama_singkat.'*'];
        }
        
        function gratisan(){
            $HostDatabase = 'localhost';
            $UserDatabase = 'naux3337_bill';
            $PassDatabase = 'naux3337_bill';
            $NamaDatabase = 'naux3337_bill';
            $koneksi = mysqli_connect($HostDatabase,$UserDatabase,$PassDatabase,$NamaDatabase);
            $query = mysqli_query($koneksi, "SELECT * FROM company WHERE status='Aktif'");
            $datacompany     = mysqli_fetch_array($query);
            $nama_singkat    = $datacompany['nama_singkat'];
            $billing         = $datacompany['billing'];
            $voucher         = date('His');
            
            $url_gratisan = $billing . '/webhook/gratisan/'.$voucher;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url_gratisan);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);
            
            return ["text" => '*Akun Login Hotspot '.$nama_singkat.'*
            
Paket : Gratisan (Rp. 0)
Username : '.$voucher.'
Username : '.$voucher.'
Batas Waktu : 5 Menit
Speed : Up To 1 Mbps
Kuota Upload : 100 MB
Kuota Download : 100 MB
Total Kuota : 100 MB
Selamat Menikmati 🙏

*TTD : Bot '.$nama_singkat.'*'];
        }
        
        // auto respond text   
        function tagihan(){
            $HostDatabase = 'localhost';
            $UserDatabase = 'naux3337_bill';
            $PassDatabase = 'naux3337_bill';
            $NamaDatabase = 'naux3337_bill';
            $koneksi = mysqli_connect($HostDatabase,$UserDatabase,$PassDatabase,$NamaDatabase);
            $query = mysqli_query($koneksi, "SELECT * FROM company WHERE status='Aktif'");
            $datacompany     = mysqli_fetch_array($query);
            $nama_singkat    = $datacompany['nama_singkat'];
            $link_app      = $datacompany['billing']; 
            
            return ["text" => '*Aplikasi Cek Tagihan '.$nama_singkat.'*
'.$link_app];
        }
        
        // auto respond text   
        function hotspot(){
            $HostDatabase = 'localhost';
            $UserDatabase = 'naux3337_bill';
            $PassDatabase = 'naux3337_bill';
            $NamaDatabase = 'naux3337_bill';
            $koneksi = mysqli_connect($HostDatabase,$UserDatabase,$PassDatabase,$NamaDatabase);
            $query = mysqli_query($koneksi, "SELECT * FROM company WHERE status='Aktif'");
            $datacompany     = mysqli_fetch_array($query);
            $nama_singkat    = $datacompany['nama_singkat'];
            
            return ["text" => '*Daftar Harga Paket Hotspot '.$nama_singkat.'*

Paket iNet Gratisan (trial)
Masa Berlaku : 5 Menit
Harga Voucher : Rp. 0
Speed : Up To 1 Mbps
Lock User : 1 Perangkat

Paket iNet Hotspot 2 Jam
Masa Berlaku : 120 Menit
Harga Voucher : Rp. 1.000
Speed : Up To 1 Mbps
Lock User : 1 Perangkat

Paket iNet Hotspot 6 Jam
Masa Berlaku : 6 Jam
Harga Voucher : Rp. 2.000
Speed : Up To 1 Mbps
Lock User : 1 Perangkat

Paket iNet Hotspot 3 Hari
Masa Berlaku : 72 Jam
Harga Voucher : Rp. 5.000
Speed : Up To 1 Mbps
Lock User : 1 Perangkat

Paket iNet Hotspot 1 Minggu
Masa Berlaku : 7 Hari
Harga Voucher : Rp. 12.000
Speed : Up To 1 Mbps
Lock User : 1 Perangkat

Paket iNet Hotspot 1/2 Bulan
Masa Berlaku : 15 Hari
Harga Voucher : Rp. 20.000
Speed : Up To 1 Mbps
Lock User : 1 Perangkat

Paket iNet Hotspot 1 Bulan
Masa Berlaku : 30 Hari
Harga Voucher : Rp. 35.000
Speed : Up To 1 Mbps
Lock User : 1 Perangkat

Paket iNet Hotspot 3 Bulan
Masa Berlaku : 90 Hari
Harga Voucher : Rp. 100.000
Speed : Up To 1 Mbps
Lock User : 1 Perangkat

*TTD : Bot '.$nama_singkat.'*'];
        }
        
        // auto respond text   
        function rumahan(){
            $HostDatabase = 'localhost';
            $UserDatabase = 'naux3337_bill';
            $PassDatabase = 'naux3337_bill';
            $NamaDatabase = 'naux3337_bill';
            $koneksi = mysqli_connect($HostDatabase,$UserDatabase,$PassDatabase,$NamaDatabase);
            $query = mysqli_query($koneksi, "SELECT * FROM company WHERE status='Aktif'");
            $datacompany     = mysqli_fetch_array($query);
            $nama_singkat    = $datacompany['nama_singkat'];
            
            return ["text" => '*Daftar Harga Paket Rumahan '.$nama_singkat.'*

Paket Home ECONOMIC
Masa Aktif : 30 Hari
Tagihan : Rp. 50.000
Speed : Up To 1 Mbps
Support : 1-2 Perangkat

Paket Home DYNAMIC
Masa Aktif : 30 Hari
Tagihan : Rp. 75.000
Speed : Up To 1.5 Mbps
Support : 2-3 Perangkat

Paket Home HAPPY
Masa Aktif : 30 Hari
Tagihan : Rp. 100.000
Speed : Up To 2 Mbps
Support : 2-4 Perangkat

Paket Home GAMING
Masa Aktif : 30 Hari
Tagihan : Rp. 125.000
Speed : Up To 2.5 Mbps
Support : 4-5 Perangkat

Paket Home PREMIUM
Masa Aktif : 30 Hari
Tagihan : Rp. 150.000
Speed : Up To 3 Mbps
Support : 4-6 Perangkat

Paket Home STREAMING
Masa Aktif : 30 Hari
Tagihan : Rp. 250.000
Speed : Up To 5 Mbps
Support : 7-10 Perangkat

Paket Home BASE VVIP
Masa Aktif : 30 Hari
Tagihan : Rp. 350.000
Speed : Up To 7 Mbps
Support : 12-15 Perangkat

Paket Home SUPER VVIP
Masa Aktif : 30 Hari
Tagihan : Rp. 500.000
Speed : Up To 10 Mbps
Support : 15-20 Perangkat

*TTD : Bot '.$nama_singkat.'*'];
        }
        
        // auto respond text   
        function pengaduan(){
            $HostDatabase = 'localhost';
            $UserDatabase = 'naux3337_bill';
            $PassDatabase = 'naux3337_bill';
            $NamaDatabase = 'naux3337_bill';
            $koneksi = mysqli_connect($HostDatabase,$UserDatabase,$PassDatabase,$NamaDatabase);
            $query = mysqli_query($koneksi, "SELECT * FROM company WHERE status='Aktif'");
            $datacompany     = mysqli_fetch_array($query);
            $nama_singkat    = $datacompany['nama_singkat'];
            
            return ["text" => '*Informasi Daftar Kontak Pengaduan*

ADMIN / OWNER
Nama Panggilan : Mas Ayenk
WhatsApp : wa.me/6285334748768
Wilayah : Komadu - Karangharjo

OPERATOR #01
Nama Panggilan : Bapak Naufal
WhatsApp : wa.me/6282332600569
Wilayah : Sumberlanas Barat 1

OPERATOR #02
Nama Panggilan : Mas Fiki
WhatsApp : wa.me/6282243559661
Wilayah : Komadu - Karangharjo

TEKNISI #01
Nama Panggilan : Mas Faris
WhatsApp : wa.me/6281911991146
Wilayah : Jalinan - Harjomulyo

*TTD : Bot '.$nama_singkat.'*'];
        }
        
        // auto respond text   
        function gantinama(){
            $HostDatabase = 'localhost';
            $UserDatabase = 'naux3337_bill';
            $PassDatabase = 'naux3337_bill';
            $NamaDatabase = 'naux3337_bill';
            $koneksi = mysqli_connect($HostDatabase,$UserDatabase,$PassDatabase,$NamaDatabase);
            $query = mysqli_query($koneksi, "SELECT * FROM company WHERE status='Aktif'");
            $datacompany     = mysqli_fetch_array($query);
            $nama_singkat    = $datacompany['nama_singkat'];
            
            return [
                "text" => '*Cara Ganti Nama Wi-Fi (SSID)*

      => ROTER / MODEM ZTE F609
01. Akses IP Address https://192.168.1.1
      (pada kolom URL Browser / Chrome)
02. Login ke menu administrasi Modem
       Username : user
       Password : user
03. Klik menu *Network* (menu kiri)
04. Klik menu *WLAN* (menu sebalah kiri)
05. Klik menu *SSID Settings* (menu kiri)
06. Ubah Nama pada kolom *SSID Name*
       (pada menu sebelah kanan)
07. Klik *Submit* (pojok kanan bawah)
08. Mohon Tunggu Selama 30-60 Detik
       (sampai proses ganti nama selesai)
09. Buka pengaturan koneksi Wi-Fi
       pada perangkat / smartphone Anda
10. Hubungkan perangkat Anda dengan
       jaringan Wi-Fi yang telah berhasil
       ganti nama dan masukkan password
       sama persis dengan password Wi-Fi
       Anda sebelum nama SSID diganti
11. Selamat Akses Internet Kembali 🙏

*TTD : Bot '.$nama_singkat.'*'];
        }
        
        // auto respond text   
        function gantisandi(){
            $HostDatabase = 'localhost';
            $UserDatabase = 'naux3337_bill';
            $PassDatabase = 'naux3337_bill';
            $NamaDatabase = 'naux3337_bill';
            $koneksi = mysqli_connect($HostDatabase,$UserDatabase,$PassDatabase,$NamaDatabase);
            $query = mysqli_query($koneksi, "SELECT * FROM company WHERE status='Aktif'");
            $datacompany     = mysqli_fetch_array($query);
            $nama_singkat    = $datacompany['nama_singkat'];
            
            return [
                "text" => '*Cara Ganti Password Wi-Fi*

      => ROTER / MODEM ZTE F609
01. Akses IP Address https://192.168.1.1
      (pada kolom URL Browser / Chrome)
02. Login ke menu administrasi Modem
       Username : user
       Password : user
03. Klik menu *Network* (menu kiri)
04. Klik menu *WLAN* (menu sebalah kiri)
05. Klik menu *Security* (menu kiri)
06. Ubah Sandi pada *WPA Passphrase*
       (pada menu sebelah kanan)
06. Klik Kolom Centang (kotak kosong)
       Agar Sandi Dapat Terlihat Jelas 
07. Klik *Submit* (pojok kanan bawah)
08. Mohon Tunggu Selama 30-60 Detik
       (sampai proses ganti sandi selesai)
09. Buka pengaturan koneksi Wi-Fi
       pada perangkat / smartphone Anda
10. Hubungkan perangkat Anda dengan
       jaringan Wi-Fi yang telah berhasil
       ganti sandi dan masukkan password
       sama persis dengan password Wi-Fi
       yang baru berhasil Anda ganti
11. Selamat Akses Internet Kembali 🙏

*TTD : Bot '.$nama_singkat.'*'];
        }
        
        // auto respond text   
        function nointernet(){
            $HostDatabase = 'localhost';
            $UserDatabase = 'naux3337_bill';
            $PassDatabase = 'naux3337_bill';
            $NamaDatabase = 'naux3337_bill';
            $koneksi = mysqli_connect($HostDatabase,$UserDatabase,$PassDatabase,$NamaDatabase);
            $query = mysqli_query($koneksi, "SELECT * FROM company WHERE status='Aktif'");
            $datacompany     = mysqli_fetch_array($query);
            $nama_singkat    = $datacompany['nama_singkat'];
            
            return [
                "text" => '*Solusi Tidak Ada Akses Internet*

01. Cabut Adaptor (charger) Modem
02. Mohon Tunggu Selama 1-3 Menit
03. Pasang Adaptor Modem / Router
04. Mohon Tunggu Selama 30-60 Detik
       (sampai proses reboot selesai)
05. Buka pengaturan koneksi Wi-Fi
       pada perangkat / smartphone Anda
06. Hubungkan perangkat Anda dengan
       jaringan Wi-Fi yang telah di Reboot
07. Test Jaringan dengan buka YouTube
08. Jika masih tidak ada akses internet
       Ulangi Kembali cara no. 1 s/d no. 7
       (ulang sebanyak 3 kali)
09. Jika masih tidak ada akses internet
       silahkan segera lakukan pengaduan
       pada salah satu kontak yang ada di
       daftar kontak pengaduan

*TTD : Bot '.$nama_singkat.'*'];
        }
        
        // auto respond text   
        function inetlemot(){
            $HostDatabase = 'localhost';
            $UserDatabase = 'naux3337_bill';
            $PassDatabase = 'naux3337_bill';
            $NamaDatabase = 'naux3337_bill';
            $koneksi = mysqli_connect($HostDatabase,$UserDatabase,$PassDatabase,$NamaDatabase);
            $query = mysqli_query($koneksi, "SELECT * FROM company WHERE status='Aktif'");
            $datacompany     = mysqli_fetch_array($query);
            $nama_singkat    = $datacompany['nama_singkat'];
            
            return [
                "text" => '*Solusi Koneksi Internet Lambat*

01. Cabut Adaptor (charger) Modem
02. Mohon Tunggu Selama 1-3 Menit
03. Pasang Adaptor Modem / Router
04. Mohon Tunggu Selama 30-60 Detik
       (sampai proses reboot selesai)
05. Buka pengaturan koneksi Wi-Fi
       pada perangkat / smartphone Anda
06. Hubungkan perangkat Anda dengan
       jaringan Wi-Fi yang telah di Reboot
07. Test Jaringan dengan buka YouTube
08. Jika masih tidak ada akses internet
       Ulangi Kembali cara no. 1 s/d no. 7
       (ulang sebanyak 3 kali)
09. Jika masih tidak ada akses internet
       silahkan segera lakukan pengaduan
       pada salah satu kontak yang ada di
       daftar kontak pengaduan

*TTD : Bot '.$nama_singkat.'*'];
        }
        
        // auto respond text   
        function foterputus(){
            $HostDatabase = 'localhost';
            $UserDatabase = 'naux3337_bill';
            $PassDatabase = 'naux3337_bill';
            $NamaDatabase = 'naux3337_bill';
            $koneksi = mysqli_connect($HostDatabase,$UserDatabase,$PassDatabase,$NamaDatabase);
            $query = mysqli_query($koneksi, "SELECT * FROM company WHERE status='Aktif'");
            $datacompany     = mysqli_fetch_array($query);
            $nama_singkat    = $datacompany['nama_singkat'];
            
            return [
                "text" => '*Solusi Kabel Internet (FO) Terputus*

01. Tandai Lokasi Kabel yang terputus
02. Foto Kabel yang Terputus (jarak 1-3M)
03. Kirim Foto Kabel Pada Teknisi Kami
       (cek kontak di info daftar pengaduan)
04. Minta Teknisi Untuk Segera Perbaiki
05. Adukan ke Admin jika dalam 1x24 Jam
       Kabel Belum Kunjung Diperbaiki

*TTD : Bot '.$nama_singkat.'*'];
        }
        
        // auto respon lists
        function voucher(){
            $HostDatabase = 'localhost';
            $UserDatabase = 'naux3337_bill';
            $PassDatabase = 'naux3337_bill';
            $NamaDatabase = 'naux3337_bill';
            $koneksi = mysqli_connect($HostDatabase,$UserDatabase,$PassDatabase,$NamaDatabase);
            $query = mysqli_query($koneksi, "SELECT * FROM company WHERE status='Aktif'");
            $datacompany     = mysqli_fetch_array($query);
            $nama_singkat    = $datacompany['company_name'];
            
            $sections = [
                [ 
                	"title" => "DAFTAR PAKET YANG TERSEDIA",
                	"rows" => [
        	            ["title" => "▶️ Paket Gratisan - Rp. 0"],
        	            ["title" => "▶️ Paket 2 Jam - Rp. 1.000"],
        	            ["title" => "▶️ Paket 6 Jam - Rp. 2.000"],
        	            ["title" => "▶️ Paket 3 Hari - Rp. 5.000"],
        	            ["title" => "▶️ Paket 1 Minggu - Rp. 12.000"],
        	            ["title" => "▶️ Paket 1/2 Bulan - Rp. 20.000"],
        	            ["title" => "▶️ Paket 1 Bulan - Rp. 35.000"],
        	            ["title" => "▶️ Paket 3 Bulan - Rp. 100.000"],
            	    ] 
                ]
            ];
            
            $listMessage = [
                "title" => "",
                "text" => "▶️ Pembelian Voucher Wi-Fi",
                "buttonText" => "Silahkan Pilih Dafar Paket  🔽",
                "sections" => $sections
            ];
         
            return $listMessage;  
        }
        
        // auto respon lists
        function registrasi(){
            $HostDatabase = 'localhost';
            $UserDatabase = 'naux3337_bill';
            $PassDatabase = 'naux3337_bill';
            $NamaDatabase = 'naux3337_bill';
            $koneksi = mysqli_connect($HostDatabase,$UserDatabase,$PassDatabase,$NamaDatabase);
            $query = mysqli_query($koneksi, "SELECT * FROM company WHERE status='Aktif'");
            $datacompany     = mysqli_fetch_array($query);
            $nama_singkat    = $datacompany['company_name'];
            
            $sections = [
                [ 
                	"title" => "DAFTAR PAKET YANG TERSEDIA",
                	"rows" => [
        	            ["title" => "▶️ Paket ECONOMIC - Rp. 50.000"],
        	            ["title" => "▶️ Paket DYNAMIC - Rp. 75.000"],
        	            ["title" => "▶️ Paket HAPPY - Rp. 100.000"],
        	            ["title" => "▶️ Paket GAMING - Rp. 125.000"],
        	            ["title" => "▶️ Paket PREMIUM - Rp. 150.000"],
        	            ["title" => "▶️ Paket STREAMING - Rp. 250.000"],
        	            ["title" => "▶️ Paket BASE VVIP - Rp. 350.000"],
        	            ["title" => "▶️ Paket SUPER VVIP - Rp. 500.000"],
            	    ] 
                ]
            ];
            
            $listMessage = [
                "title" => "",
                "text" => "▶️ Pendaftaran Wi-Fi Rumahan",
                "buttonText" => "Silahkan Pilih Dafar Paket  🔽",
                "sections" => $sections
            ];
         
            return $listMessage;  
        }
        
        // auto respon lists
        function metode(){
            $HostDatabase = 'localhost';
            $UserDatabase = 'naux3337_bill';
            $PassDatabase = 'naux3337_bill';
            $NamaDatabase = 'naux3337_bill';
            $koneksi = mysqli_connect($HostDatabase,$UserDatabase,$PassDatabase,$NamaDatabase);
            $query = mysqli_query($koneksi, "SELECT * FROM company WHERE status='Aktif'");
            $datacompany     = mysqli_fetch_array($query);
            $nama_singkat    = $datacompany['company_name'];
            
            $sections = [
                [ 
                	"title" => "DAFTAR METODE YANG TERSEDIA",
                	"rows" => [
        	            ["title" => "▶️ Manual ke Reseller / Admin"],
        	            ["title" => "▶️ BRI Virtual Account"],
        	            ["title" => "▶️ BNI Virtual Account"],
        	            ["title" => "▶️ BSI Virtual Account"],
        	            ["title" => "▶️ Mandiri Virtual Account"],
        	            ["title" => "▶️ Maybank Virtual Account"],
        	            ["title" => "▶️ Permata Virtual Account"],
        	            ["title" => "▶️ Sinarmas Virtual Account"],
        	            ["title" => "▶️ Muamalat Virtual Account"],
        	            ["title" => "▶️ Sampoerna Virtual Account"],
        	            ["title" => "▶️ Minimarket Alfamart"],
        	            ["title" => "▶️ Minimarket Indomaret"],
        	            ["title" => "▶️ Minimarket Alfamidi"],
        	            ["title" => "▶️ Dompet Digital OVO"],
            	    ] 
                ]
            ];
            
            $listMessage = [
                "title" => "",
                "text" => "▶️ Pemilihan Metode Pembayaran",
                "buttonText" => "Silahkan Pilih Dafar Metode  🔽",
                "sections" => $sections
            ];
         
            return $listMessage;  
        }
        
        // auto respon lists
        function menu(){
            $HostDatabase = 'localhost';
            $UserDatabase = 'naux3337_bill';
            $PassDatabase = 'naux3337_bill';
            $NamaDatabase = 'naux3337_bill';
            $koneksi = mysqli_connect($HostDatabase,$UserDatabase,$PassDatabase,$NamaDatabase);
            $query = mysqli_query($koneksi, "SELECT * FROM company WHERE status='Aktif'");
            $datacompany     = mysqli_fetch_array($query);
            $nama_singkat    = $datacompany['company_name'];
            
            $sections = [
                [ 
                	"title" => "DAFTAR MENU YANG TERSEDIA",
                	"rows" => [
        	            ["title" => "▶️ Info Perusahaan @Boss.Net"],
        	            ["title" => "▶️ Download Aplikasi Android"],
        	            ["title" => "▶️ Link URL Aplikasi Cek Tagihan"],
        	            ["title" => "▶️ Daftar Harga Paket Hotspot"],
        	            ["title" => "▶️ Daftar Harga Paket Rumahan"],
        	            ["title" => "▶️ Pembelian Voucher Wi-Fi"],
        	            ["title" => "▶️ Pendaftaran Wi-Fi Rumahan"],
        	            ["title" => "▶️ Pembayaran Tagihan iNet"],
        	            ["title" => "▶️ Periksa / Cek Tagihan iNet"],
        	            ["title" => "▶️ Cara Ganti Nama Wi-Fi (SSID)"],
        	            ["title" => "▶️ Cara Ganti Password Wi-Fi"],
        	            ["title" => "▶️ Tidak Ada Akses Internet"],
        	            ["title" => "▶️ Kabel Internet (FO) Terputus"],
        	            ["title" => "▶️ Koneksi Internet Lambat"],
        	            ["title" => "▶️ Informasi Kontak Pengaduan"],
            	    ] 
                ]
            ];
            
            $listMessage = [
                "title" => "Selamat Datang di Chat WhatsApp 🤖
*".strtoupper($nama_singkat)."*",
                "text" => "Beritahu apa yang dapat kami bantu ?",
                "buttonText" => "Silahkan Pilih Dafar Menu  🔽",
                "sections" => $sections
            ];
         
            return $listMessage;  
        }
         
        if($message === 'hai'){
            $respon = ["text" => 'Selamat Pagi '.$from];;
        } else if($message === '▶️ info perusahaan @Boss.Net'){
            $respon = perusahaan();
        } else if($message === '▶️ download aplikasi android'){
            $respon = android();
        } else if($message === '▶️ link url aplikasi cek tagihan'){
            $respon = tagihan();
        } else if($message === '▶️ daftar harga paket hotspot'){
            $respon = hotspot();
        } else if($message === '▶️ pembelian voucher wi-fi'){
            $respon = voucher();
        } else if($message === '▶️ daftar harga paket rumahan'){
            $respon = rumahan();
        } else if($message === '▶️ pendaftaran wi-fi rumahan'){
            $respon = registrasi();
        } else if($message === '▶️ pembayaran tagihan inet'){
            $respon = mytagihan();
        } else if($message === '▶️ periksa / cek tagihan inet'){
            $respon = cektagihan();
        } else if($message === '▶️ cara ganti nama wi-fi (ssid)'){
            $respon = gantinama();
        } else if($message === '▶️ cara ganti password wi-fi'){
            $respon = gantisandi();
        } else if($message === '▶️ koneksi internet lambat'){
            $respon = inetlemot();
        } else if($message === '▶️ tidak ada akses internet'){
            $respon = nointernet();
        } else if($message === '▶️ kabel internet (fo) terputus'){
            $respon = foterputus();
        } else if($message === '▶️ informasi kontak pengaduan'){
            $respon = pengaduan();
        } else if($message === '▶️ paket gratisan - rp. 0'){
            $respon = gratisan();
        } else if($message === '▶️ paket 2 jam - rp. 1.000'){
            
        $HostDatabase = 'localhost';
        $UserDatabase = 'naux3337_bill';
        $PassDatabase = 'naux3337_bill';
        $NamaDatabase = 'naux3337_bill';
        $koneksi = mysqli_connect($HostDatabase,$UserDatabase,$PassDatabase,$NamaDatabase);
            $respon = metode();
        } else if($message === '▶️ paket 6 jam - rp. 2.000'){
            $respon = metode();
        } else if($message === '▶️ paket 3 hari - rp. 5.000'){
            $respon = metode();
        } else if($message === '▶️ paket 1 minggu - rp. 12.000'){
            $respon = metode();
        } else if($message === '▶️ paket 1/2 bulan - rp. 20.000'){
            $respon = metode();
        } else if($message === '▶️ paket 1 bulan - rp. 35.000'){
            $respon = metode();
        } else if($message === '▶️ paket 3 bulan - rp. 100.000'){
            $respon = metode();
        } else if($message === 'start'){
            $respon = menu();
        } else if($message === 'mulai'){
            $respon = menu();
        } else if($message === 'menu'){
            $respon = menu();
        } else if($message === 'p'){
            $respon = menu();
        } else if($message === 'tes'){
            $respon = menu();
        } else if($message === 'test'){
            $respon = menu();
        } else if($message === 'testing'){
            $respon = menu();
        } else if($message === 'hy'){
            $respon = menu();
        } else if($message === 'hi'){
            $respon = menu();
        } else if($message === 'hey'){
            $respon = menu();
        } else if($message === 'bot'){
            $respon = menu();
        } else if($message === 'robot'){
            $respon = menu();
        } else if($message === 'gambar'){
            $respon = gambar();
        } else if($message === 'lists'){
            $respon = lists();
        } else if($message === 'tes button'){
            $respon = button();
        } else {
            $respon = search($messagenya, $from);
        }
        echo json_encode($respon);
    }
}