<?php defined('BASEPATH') or exit('No direct script access allowed');

class Cronjob extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }
    public function tambahkontak()
    {
        $customer = $this->db->get('customer')->result();
        $tgl_sekarang = date('d/m/Y H:i:s') . ' WIB';
        $no = 1;

        foreach ($customer as $post) {
            $cekCs = $this->db->get_where('campaign', ['nomor_services' => $post->no_services])->num_rows();
            if ($cekCs > 0) {
                if ($no <= 9) {
                    echo '000' . $no++ . '. Data Kontak Pelanggan Ini Sudah Ada Pada Database a/n ' . strtoupper($post->name) . '<br>';
                } else {
                    if ($no >= 10 && $no <= 99) {
                        echo '00' . $no++ . '. Data Kontak Pelanggan Ini Sudah Ada Pada Database a/n ' . strtoupper($post->name) . '<br>';
                    } else {
                        if ($no >= 10 && $no <= 999) {
                            echo '0' . $no++ . '. Data Kontak Pelanggan Ini Sudah Ada Pada Database a/n ' . strtoupper($post->name) . '<br>';
                        } else {
                            echo $no++ . '. Data Kontak Pelanggan Ini Sudah Ada Pada Database a/n ' . strtoupper($post->name) . '<br>';
                        }
                    }
                }
            } else {
                if ($post->due_date <= 3) {
                    $tanggal_reminder = $post->due_date;
                } else {
                    $tanggal_reminder = $post->due_date - 3;
                }

                if ($tanggal_reminder <= 9) {
                    $reminder = '0' . $tanggal_reminder;
                } else {
                    $reminder = $tanggal_reminder;
                }

                $datacampaign = [
                    'nama_pelanggan' => $post->name,
                    'nomor_services' => $post->no_services,
                    'nomor_whatsapp' => $post->no_wa,
                    'kategori_kontak' => 'PELANGGAN',
                    'tanggal_reminder' => $reminder,
                    'update_campaign' => $tgl_sekarang,
                ];
                $this->db->insert('campaign', $datacampaign);

                if ($no <= 9) {
                    echo '000' . $no++ . '. Data Kontak Pelanggan Ini Berhasil Disimpan Ke Database a/n ' . strtoupper($post->name) . '<br>';
                } else {
                    if ($no >= 10 && $no <= 99) {
                        echo '00' . $no++ . '. Data Kontak Pelanggan Ini Berhasil Disimpan Ke Database a/n ' . strtoupper($post->name) . '<br>';
                    } else {
                        if ($no >= 10 && $no <= 999) {
                            echo '0' . $no++ . '. Data Kontak Pelanggan Ini Berhasil Disimpan Ke Database a/n ' . strtoupper($post->name) . '<br>';
                        } else {
                            echo $no++ . '. Data Kontak Pelanggan Ini Berhasil Disimpan Ke Database a/n ' . strtoupper($post->name) . '<br>';
                        }
                    }
                }
            }
        }
    }
    public function isolirmanual($customer_id)
    {
        $customer = $this->db->get_where('customer', ['customer_id' => $customer_id])->row_array();
        $myrouter = $this->db->get_where('router', ['name_router' => $customer['router']])->row_array();
        $API = new routeros();
        $host = $myrouter['host_router'];
        $port = $myrouter['port_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $API->connect($host, $port, $user, $pass);
        $no = 1;
            $username    = $customer['username'];
            $no_services = $customer['no_services'];
            $due_date    = $customer['due_date'];
            $hari_ini    = date('d');
            $bulan_ini   = date('m');
            $tahun_ini   = date('Y');
                $myinvoice = $this->db->get_where('invoice', ['no_services' => $no_services, 'month' => $bulan_ini, 'year' => $tahun_ini])->row_array();
                $mypackage = $this->db->get_where('package_item', ['name' => 'ISOLIR'])->row_array();
                $myprofile = $mypackage['paket_wifi'];
                if ($myinvoice['status'] == 'BELUM BAYAR') {
                    $pppuser = $API->comm("/ppp/secret/print", array(
                        '?name' => $username,
                    ));
                    $pppactive = $API->comm("/ppp/active/print", array(
                        '?name' => $username,
                    ));
                    $pppuser = json_encode($pppuser);
                    $pppuser = json_decode($pppuser, true);
                    $pppactive = json_encode($pppactive);
                    $pppactive = json_decode($pppactive, true);
                    foreach ($pppuser as $dataku) {
                        foreach ($pppactive as $datague) {
                            $id_active = str_replace('*', '', $datague['.id']);
                            $API->comm("/ppp/active/remove", array(
                                '.id' => '*' . $id_active,
                            ));
                            $id_user = str_replace('*', '', $dataku['.id']);
                            $API->comm("/ppp/secret/set", array(
                                ".id" => '*' . $id_user,
                                "profile" => $myprofile,
                                "comment" => ''
                            ));
                            $API->disconnect();

                            $whatsapp       = $this->db->get('whatsapp')->row_array();
                            $nomor_penerima = $whatsapp['admin'];
                            $nomor_pengirim = $whatsapp['number'];
                            $api_key_wa     = $whatsapp['api_key'];
                            $link_url_wa    = $whatsapp['link_url'];
                            $link_url_web   = $whatsapp['url_web'];

                            $pesan_whatsapp = 'User PPPOE a/n *' . $username . '* saat ini telah Sukses di *ISOLIR*';

                            $dataWhatsapp = [
                                'api_key' => $api_key_wa,
                                'sender' => $nomor_pengirim,
                                'number' => $nomor_penerima,
                                'message' => $pesan_whatsapp,
                            ];

                            $curlme = curl_init();
                            curl_setopt_array($curlme, array(
                                CURLOPT_URL => $link_url_wa,
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => '',
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 0,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => 'POST',
                                CURLOPT_POSTFIELDS => json_encode($dataWhatsapp),
                                CURLOPT_HTTPHEADER => array(
                                    'Content-Type: application/json'
                                ),
                            ));

                            $response  = curl_exec($curlme);
                            $err = curl_error($curlme);
                            curl_close($curlme);
                            
                            $nomor_penerima2 = $customer['no_wa'];

                            echo 'Nomor WhatsApp Pengirim : ' . $nomor_pengirim . '<br>';
                            echo 'Nomor WhatsApp Penerima : ' . $nomor_penerima . '<br>';
                            echo 'Link URL Website Billing : ' . $link_url_web . '<br>';
                            echo 'Link URL WhatsApp Gateway : ' . $link_url_wa . '<br>';
                            echo 'Kode API Key WhatsApp : ' . $api_key_wa . '<br>';
                            echo 'Pesan Respon WA Gateway : ' . $response . '<br>';
                            echo 'User PPPOE a/n ' . $username . ' saat ini telah Sukses di ISOLIR<br>';
                        }
                    }
                } else {
                    echo '<br>Pelanggan Atas Nama ' . $customer['name'] . ' Tagihannya SUDAH BAYAR';
                }
    }
    public function aktifmanual($customer_id)
    {
        $customer = $this->db->get_where('customer', ['customer_id' => $customer_id])->row_array();
        $myrouter = $this->db->get_where('router', ['name_router' => $customer['router']])->row_array();
        $API = new routeros();
        $host = $myrouter['host_router'];
        $port = $myrouter['port_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $API->connect($host, $port, $user, $pass);
        $no = 1;
            $username    = $customer['username'];
            $no_services = $customer['no_services'];
            $due_date    = $customer['due_date'];
            $hari_ini    = date('d');
            $bulan_ini   = date('m');
            $tahun_ini   = date('Y');
                $myinvoice = $this->db->get_where('invoice', ['no_services' => $no_services, 'month' => $bulan_ini, 'year' => $tahun_ini])->row_array();
                $mypackage = $this->db->get_where('package_item', ['name' => 'ISOLIR'])->row_array();
                $myprofile = $customer['paket_wifi'];
                if ($myinvoice['status'] == 'SUDAH BAYAR') {
                    $pppuser = $API->comm("/ppp/secret/print", array(
                        '?name' => $username,
                    ));
                    $pppactive = $API->comm("/ppp/active/print", array(
                        '?name' => $username,
                    ));
                    $pppuser = json_encode($pppuser);
                    $pppuser = json_decode($pppuser, true);
                    $pppactive = json_encode($pppactive);
                    $pppactive = json_decode($pppactive, true);
                    foreach ($pppuser as $dataku) {
                        foreach ($pppactive as $datague) {
                            $id_active = str_replace('*', '', $datague['.id']);
                            $API->comm("/ppp/active/remove", array(
                                '.id' => '*' . $id_active,
                            ));
                            $id_user = str_replace('*', '', $dataku['.id']);
                            $API->comm("/ppp/secret/set", array(
                                ".id" => '*' . $id_user,
                                "profile" => $myprofile,
                                "comment" => ''
                            ));
                            $API->disconnect();

                            $whatsapp       = $this->db->get('whatsapp')->row_array();
                            $nomor_penerima = $whatsapp['admin'];
                            $nomor_pengirim = $whatsapp['number'];
                            $api_key_wa     = $whatsapp['api_key'];
                            $link_url_wa    = $whatsapp['link_url'];
                            $link_url_web   = $whatsapp['url_web'];

                            $pesan_whatsapp = 'User PPPOE a/n *' . $username . '* saat ini telah Sukses di *AKTIVASI*';

                            $dataWhatsapp = [
                                'api_key' => $api_key_wa,
                                'sender' => $nomor_pengirim,
                                'number' => $nomor_penerima,
                                'message' => $pesan_whatsapp,
                            ];

                            $curlme = curl_init();
                            curl_setopt_array($curlme, array(
                                CURLOPT_URL => $link_url_wa,
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => '',
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 0,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => 'POST',
                                CURLOPT_POSTFIELDS => json_encode($dataWhatsapp),
                                CURLOPT_HTTPHEADER => array(
                                    'Content-Type: application/json'
                                ),
                            ));

                            $response  = curl_exec($curlme);
                            $err = curl_error($curlme);
                            curl_close($curlme);
                            
                            $nomor_penerima2 = $customer['no_wa'];

                            echo 'Nomor WhatsApp Pengirim : ' . $nomor_pengirim . '<br>';
                            echo 'Nomor WhatsApp Penerima : ' . $nomor_penerima . '<br>';
                            echo 'Link URL Website Billing : ' . $link_url_web . '<br>';
                            echo 'Link URL WhatsApp Gateway : ' . $link_url_wa . '<br>';
                            echo 'Kode API Key WhatsApp : ' . $api_key_wa . '<br>';
                            echo 'Pesan Respon WA Gateway : ' . $response . '<br>';
                            echo 'User PPPOE a/n ' . $username . ' saat ini telah Sukses di ISOLIR<br>';
                        }
                    }
                } else {
                    echo '<br>Pelanggan Atas Nama ' . $customer['name'] . ' Tagihannya BELUM BAYAR';
                }
    }
    public function autoisolir()
    {
        $mycustomer = $this->db->get_where('customer')->result();
        $no = 1;
        foreach ($mycustomer as $customer) {
            $myrouter = $this->db->get_where('router', ['name_router' => $customer->router])->row_array();
            $API = new routeros();
            $host = $myrouter['host_router'];
            $port = $myrouter['port_router'];
            $user = $myrouter['user_router'];
            $pass = $myrouter['pass_router'];
            $API->connect($host, $port, $user, $pass);
        
            $username    = $customer->username;
            $no_services = $customer->no_services;
            $due_date    = $customer->due_date;
            $hari_ini    = date('d');
            $bulan_ini   = date('m');
            $tahun_ini   = date('Y');
            if ($hari_ini == $due_date) {
                $myinvoice = $this->db->get_where('invoice', ['no_services' => $no_services, 'month' => $bulan_ini, 'year' => $tahun_ini])->row_array();
                $mypackage = $this->db->get_where('package_item', ['name' => 'ISOLIR'])->row_array();
                $myprofile = $mypackage['paket_wifi'];
                if ($myinvoice['status'] == 'BELUM BAYAR') {
                    $pppuser = $API->comm("/ppp/secret/print", array(
                        '?name' => $username,
                    ));
                    $pppactive = $API->comm("/ppp/active/print", array(
                        '?name' => $username,
                    ));
                    $pppuser = json_encode($pppuser);
                    $pppuser = json_decode($pppuser, true);
                    $pppactive = json_encode($pppactive);
                    $pppactive = json_decode($pppactive, true);
                    foreach ($pppuser as $dataku) {
                        foreach ($pppactive as $datague) {
                            $id_active = str_replace('*', '', $datague['.id']);
                            $API->comm("/ppp/active/remove", array(
                                '.id' => '*' . $id_active,
                            ));
                            $id_user = str_replace('*', '', $dataku['.id']);
                            $API->comm("/ppp/secret/set", array(
                                ".id" => '*' . $id_user,
                                "profile" => $myprofile,
                                "comment" => ''
                            ));
                            $API->disconnect();

                            $whatsapp       = $this->db->get('whatsapp')->row_array();
                            $nomor_penerima = $whatsapp['admin'];
                            $nomor_pengirim = $whatsapp['number'];
                            $api_key_wa     = $whatsapp['api_key'];
                            $link_url_wa    = $whatsapp['link_url'];
                            $link_url_web   = $whatsapp['url_web'];

                            $pesan_whatsapp = 'User PPPOE a/n *' . $username . '* saat ini telah Sukses di *ISOLIR*';

                            $dataWhatsapp = [
                                'api_key' => $api_key_wa,
                                'sender' => $nomor_pengirim,
                                'number' => $nomor_penerima,
                                'message' => $pesan_whatsapp,
                            ];

                            $curlme = curl_init();
                            curl_setopt_array($curlme, array(
                                CURLOPT_URL => $link_url_wa,
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => '',
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 0,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => 'POST',
                                CURLOPT_POSTFIELDS => json_encode($dataWhatsapp),
                                CURLOPT_HTTPHEADER => array(
                                    'Content-Type: application/json'
                                ),
                            ));

                            $response  = curl_exec($curlme);
                            $err = curl_error($curlme);
                            curl_close($curlme);
                            
                            $nomor_penerima2 = $customer->no_wa;
                            $pesan_whatsapp2 = 'Mohon Maaf, Internet Anda
Saat Ini Telah di-*ISOLIR*';

                            $dataWhatsapp2 = [
                                'api_key' => $api_key_wa,
                                'sender' => $nomor_pengirim,
                                'number' => $nomor_penerima2,
                                'message' => $pesan_whatsapp2,
                            ];

                            $curlme2 = curl_init();
                            curl_setopt_array($curlme2, array(
                                CURLOPT_URL => $link_url_wa,
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => '',
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 0,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => 'POST',
                                CURLOPT_POSTFIELDS => json_encode($dataWhatsapp2),
                                CURLOPT_HTTPHEADER => array(
                                    'Content-Type: application/json'
                                ),
                            ));

                            $response2  = curl_exec($curlme2);
                            $err2 = curl_error($curlme2);
                            curl_close($curlme2);

                            echo 'Nomor WhatsApp Pengirim : ' . $nomor_pengirim . '<br>';
                            echo 'Nomor WhatsApp Penerima : ' . $nomor_penerima . '<br>';
                            echo 'Link URL Website Billing : ' . $link_url_web . '<br>';
                            echo 'Link URL WhatsApp Gateway : ' . $link_url_wa . '<br>';
                            echo 'Kode API Key WhatsApp : ' . $api_key_wa . '<br>';
                            echo 'Pesan Respon WA Gateway : ' . $response . '<br>';
                            echo 'User PPPOE a/n ' . $username . ' saat ini telah Sukses di ISOLIR<br>';
                        }
                    }
                } else {
                    echo '<br>Pelanggan Atas Nama ' . $customer->name . ' Tagihannya SUDAH BAYAR';
                }
            } else {
                echo '('.$no++.') '.$customer->no_services . ' - PPP dengan username : ' . $customer->username . ' => Tidak di Isolir hari ini !!! <br>';
            }
        }
    }
    public function aktivasi()
    {
        $mycustomer = $this->db->get_where('customer')->result();
        $no = 0;
        foreach ($mycustomer as $customer) {
            $myrouter = $this->db->get_where('router', ['name_router' => $customer->router])->row_array();
            $API = new routeros();
            $host = $myrouter['host_router'];
            $port = $myrouter['port_router'];
            $user = $myrouter['user_router'];
            $pass = $myrouter['pass_router'];
            $API->connect($host, $port, $user, $pass);
            
            $username    = $customer->username;
            $no_services = $customer->no_services;
            $due_date    = $customer->due_date;
            $hari_ini    = date('d');
            $bulan_ini   = date('m');
            $tahun_ini   = date('Y');
            if ($hari_ini == $due_date) {
                $myinvoice = $this->db->get_where('invoice', ['no_services' => $no_services, 'month' => $bulan_ini, 'year' => $tahun_ini])->row_array();
                $myprofile = $customer->paket_wifi;
                if ($myinvoice['status'] == 'SUDAH BAYAR') {
                    $pppuser = $API->comm("/ppp/secret/print", array(
                        '?name' => $username,
                    ));
                    $pppactive = $API->comm("/ppp/active/print", array(
                        '?name' => $username,
                    ));
                    $pppuser = json_encode($pppuser);
                    $pppuser = json_decode($pppuser, true);
                    $pppactive = json_encode($pppactive);
                    $pppactive = json_decode($pppactive, true);
                    foreach ($pppuser as $dataku) {
                        foreach ($pppactive as $datague) {
                            $id_active = str_replace('*', '', $datague['.id']);
                            $API->comm("/ppp/active/remove", array(
                                '.id' => '*' . $id_active,
                            ));
                            $id_user = str_replace('*', '', $dataku['.id']);
                            $API->comm("/ppp/secret/set", array(
                                ".id" => '*' . $id_user,
                                "profile" => $myprofile,
                                "comment" => ''
                            ));
                            $API->disconnect();

                            $whatsapp       = $this->db->get('whatsapp')->row_array();
                            $nomor_penerima = $whatsapp['admin'];
                            $nomor_pengirim = $whatsapp['number'];
                            $api_key_wa     = $whatsapp['api_key'];
                            $link_url_wa    = $whatsapp['link_url'];
                            $link_url_web   = $whatsapp['url_web'];

                            $pesan_whatsapp = 'User PPPOE a/n *' . $username . '* saat ini telah Sukses di *AKTIVASI*';

                            $dataWhatsapp = [
                                'api_key' => $api_key_wa,
                                'sender' => $nomor_pengirim,
                                'number' => $nomor_penerima,
                                'message' => $pesan_whatsapp,
                            ];

                            $curlsaya = curl_init();
                            curl_setopt_array($curlsaya, array(
                                CURLOPT_URL => $link_url_wa,
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => '',
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 0,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => 'POST',
                                CURLOPT_POSTFIELDS => json_encode($dataWhatsapp),
                                CURLOPT_HTTPHEADER => array(
                                    'Content-Type: application/json'
                                ),
                            ));

                            $response  = curl_exec($curlsaya);
                            $err = curl_error($curlsaya);
                            curl_close($curlsaya);
                            
                            $nomor_penerima2 = $customer->no_wa;
                            $pesan_whatsapp2 = 'Terimakasih, Internet Anda
Saat Ini Telah di-*AKTIVASI*';

                            $dataWhatsapp2 = [
                                'api_key' => $api_key_wa,
                                'sender' => $nomor_pengirim,
                                'number' => $nomor_penerima2,
                                'message' => $pesan_whatsapp2,
                            ];

                            $curlme2 = curl_init();
                            curl_setopt_array($curlme2, array(
                                CURLOPT_URL => $link_url_wa,
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => '',
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 0,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => 'POST',
                                CURLOPT_POSTFIELDS => json_encode($dataWhatsapp2),
                                CURLOPT_HTTPHEADER => array(
                                    'Content-Type: application/json'
                                ),
                            ));

                            $response2  = curl_exec($curlme2);
                            $err2 = curl_error($curlme2);
                            curl_close($curlme2);

                            echo 'Nomor WhatsApp Pengirim : ' . $nomor_pengirim . '<br>';
                            echo 'Nomor WhatsApp Penerima : ' . $nomor_penerima . '<br>';
                            echo 'Link URL Website Billing : ' . $link_url_web . '<br>';
                            echo 'Link URL WhatsApp Gateway : ' . $link_url_wa . '<br>';
                            echo 'Kode API Key WhatsApp : ' . $api_key_wa . '<br>';
                            echo 'Pesan Respon WA Gateway : ' . $response . '<br>';
                            echo 'User PPPOE a/n ' . $username . ' saat ini telah Sukses di AKTIVASI<br>';
                        }
                    }
                }
            } else {
                echo '('.$no++.') '.$customer->no_services . ' - PPP dengan username : ' . $customer->username . ' => Tidak di Aktivasi hari ini !!! <br>';
            }
        }
    }
    public function sudahbayar($no_services)
    {
        $myinvoice = $this->db->get_where('invoice', ['no_services' => $no_services])->row_array();
        $customer  = $this->db->get_where('customer', ['no_services' => $no_services])->row_array();
        $myrouter = $this->db->get_where('router', ['name_router' => $customer['router']])->row_array();
        $API = new routeros();
        $host = $myrouter['host_router'];
        $port = $myrouter['port_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $API->connect($host, $port, $user, $pass);
        $username  = $customer['username'];
        $myprofile = $customer['paket_wifi'];
        $pppuser = $API->comm("/ppp/secret/print", array(
            '?name' => $username,
        ));
        $pppactive = $API->comm("/ppp/active/print", array(
            '?name' => $username,
        ));
        $pppuser = json_encode($pppuser);
        $pppuser = json_decode($pppuser, true);
        $pppactive = json_encode($pppactive);
        $pppactive = json_decode($pppactive, true);
        foreach ($pppuser as $dataku) {
            foreach ($pppactive as $datague) {
                $id_active = str_replace('*', '', $datague['.id']);
                $API->comm("/ppp/active/remove", array(
                    '.id' => '*' . $id_active,
                ));
                $id_user = str_replace('*', '', $dataku['.id']);
                $API->comm("/ppp/secret/set", array(
                    ".id" => '*' . $id_user,
                    "profile" => $myprofile,
                    "comment" => ''
                ));
                $API->disconnect();

                $whatsapp       = $this->db->get('whatsapp')->row_array();
                $nomor_penerima = $whatsapp['admin'];
                $nomor_pengirim = $whatsapp['number'];
                $api_key_wa     = $whatsapp['api_key'];
                $link_url_wa    = $whatsapp['link_url'];
                $link_url_web   = $whatsapp['url_web'];

                $pesan_whatsapp = 'User PPPOE a/n *' . $username . '* saat ini telah Sukses di *AKTIVASI*';

                $dataWhatsapp = [
                    'api_key' => $api_key_wa,
                    'sender' => $nomor_pengirim,
                    'number' => $nomor_penerima,
                    'message' => $pesan_whatsapp,
                ];

                $curlsaya = curl_init();
                curl_setopt_array($curlsaya, array(
                    CURLOPT_URL => $link_url_wa,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => json_encode($dataWhatsapp),
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                ));

                $response  = curl_exec($curlsaya);
                $err = curl_error($curlsaya);
                curl_close($curlsaya);
                            
                            $nomor_penerima2 = $customer->no_wa;
                            $pesan_whatsapp2 = 'Terimakasih, Internet Anda
Saat Ini Telah di-*AKTIVASI*';

                            $dataWhatsapp2 = [
                                'api_key' => $api_key_wa,
                                'sender' => $nomor_pengirim,
                                'number' => $nomor_penerima2,
                                'message' => $pesan_whatsapp2,
                            ];

                            $curlme2 = curl_init();
                            curl_setopt_array($curlme2, array(
                                CURLOPT_URL => $link_url_wa,
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => '',
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 0,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => 'POST',
                                CURLOPT_POSTFIELDS => json_encode($dataWhatsapp2),
                                CURLOPT_HTTPHEADER => array(
                                    'Content-Type: application/json'
                                ),
                            ));

                            $response2  = curl_exec($curlme2);
                            $err2 = curl_error($curlme2);
                            curl_close($curlme2);

                echo 'Nomor WhatsApp Pengirim : ' . $nomor_pengirim . '<br>';
                echo 'Nomor WhatsApp Penerima : ' . $nomor_penerima . '<br>';
                echo 'Link URL Website Billing : ' . $link_url_web . '<br>';
                echo 'Link URL WhatsApp Gateway : ' . $link_url_wa . '<br>';
                echo 'Kode API Key WhatsApp : ' . $api_key_wa . '<br>';
                echo 'Pesan Respon WA Gateway : ' . $response . '<br>';
                echo 'User PPPOE a/n ' . $username . ' saat ini telah Sukses di AKTIVASI<br>';
            }
        }
    }

    public function index()
    {
        $url_terimakasih_1 = base_url() . 'cronjob/remind';
        $ch_1 = curl_init();
        curl_setopt($ch_1, CURLOPT_URL, $url_terimakasih_1);
        curl_setopt($ch_1, CURLOPT_RETURNTRANSFER, 1);
        $output_1 = curl_exec($ch_1);
        echo $output_1 . '<br>';
        curl_close($ch_1);

        $url_terimakasih_2 = base_url() . 'cronjob/aktivasi';
        $ch_2 = curl_init();
        curl_setopt($ch_2, CURLOPT_URL, $url_terimakasih_2);
        curl_setopt($ch_2, CURLOPT_RETURNTRANSFER, 1);
        $output_2 = curl_exec($ch_2);
        echo $output_2 . '<br>';
        curl_close($ch_2);

        $url_terimakasih_3 = base_url() . 'cronjob/autoisolir';
        $ch_3 = curl_init();
        curl_setopt($ch_3, CURLOPT_URL, $url_terimakasih_3);
        curl_setopt($ch_3, CURLOPT_RETURNTRANSFER, 1);
        $output_3 = curl_exec($ch_3);
        echo $output_3 . '<br>';
        curl_close($ch_3);

        $url_terimakasih_4 = base_url() . 'cronjob/jatuhtempo';
        $ch_4 = curl_init();
        curl_setopt($ch_4, CURLOPT_URL, $url_terimakasih_4);
        curl_setopt($ch_4, CURLOPT_RETURNTRANSFER, 1);
        $output_4 = curl_exec($ch_4);
        echo $output_4 . '<br>';
        curl_close($ch_4);
    }
    
    public function remind()
    {
        $tanggal    = date('d/m/Y H:i:s') . " WIB";
        $hari_ini   = date('d');
        $bulan_ini  = date('m');
        $tahun_ini  = date('Y');
        $cekCs = $this->db->get_where('campaign', ['tanggal_reminder' => $hari_ini])->num_rows();
        $no = 0;
        if ($cekCs > 0) {
            $queryCampaign  = $this->db->get_where('campaign', ['tanggal_reminder' => $hari_ini])->result();
            $whatsapp       = $this->db->get('whatsapp')->row_array();
            $nomor_pengirim = $whatsapp['number'];
            $api_key_wa     = $whatsapp['api_key'];
            $link_url_wa    = $whatsapp['link_url'];
            $link_url_web   = $whatsapp['url_web'];

            foreach ($queryCampaign as $datagua) {
                $no_services    = $datagua->nomor_services;
                $nomor_penerima = $datagua->nomor_whatsapp;
                $queryInvoice   = $this->db->get_where('invoice', ['no_services' => $no_services, 'month' => $bulan_ini, 'year' => $tahun_ini])->result();
                foreach ($queryInvoice as $datasaya) {
                    $no_invoice     = $datasaya->invoice;

                    $queryCustomer  = $this->db->get_where('customer', ['no_services' => $no_services])->row_array();
                    $nama_pelanggan = $queryCustomer['name'];
                    $jatuh_tempo    = $queryCustomer['due_date'];
                    $id_coverage    = $queryCustomer['coverage'];

                    $queryCoverage  = $this->db->get_where('coverage', ['coverage_id' => $id_coverage])->row_array();
                    $id_kelurahan   = $queryCoverage['id_kel'];
                    $id_kecamatan   = $queryCoverage['id_kec'];
                    $id_kabupaten   = $queryCoverage['id_kab'];
                    $id_provinsi    = $queryCoverage['id_prov'];

                    $queryOther  = $this->db->get('other')->row_array();
                    $url_isolir  = $queryOther['isolir_image'];
                    $url_thanks  = $queryOther['thanks_image'];


                    $queryKelurahan = $this->db->get_where('wilayah_desa', ['id' => $id_kelurahan])->row_array();
                    $queryKecamatan = $this->db->get_where('wilayah_kecamatan', ['id' => $id_kecamatan])->row_array();
                    $queryKabupaten = $this->db->get_where('wilayah_kabupaten', ['id' => $id_kabupaten])->row_array();
                    $queryProvinsi  = $this->db->get_where('wilayah_provinsi', ['id' => $id_provinsi])->row_array();
                    $alamat_lengkap = $queryCoverage['address'] . ', Rt/Rw ' . $queryCoverage['nomor_rt'] . '/' . $queryCoverage['nomor_rw'] . ', ' . $queryKelurahan['nama'] . ', Kec.' . $queryKecamatan['nama'] . ', ' . $queryKabupaten['nama'] . ', Prov. ' . $queryProvinsi['nama'] . ' - Indonesia ' . $queryCoverage['kode_pos'];
                    $queryCompany   = $this->db->get_where('company', ['status' => 'Aktif'])->row_array();
                    $link_app       = $queryCompany['link_app'];
                    if ($jatuh_tempo == 0) {
                        $tgl_due_date = $queryCompany['due_date'];
                    } else {
                        $tgl_due_date = $jatuh_tempo;
                    }

                    $nomor_nik_ktp  = $queryCustomer['no_ktp'];
                    $id_layanan = $queryCustomer['item_paket'];
                    $bulan_tagihan  = $datasaya->month;
                    $tahun_tagihan  = $datasaya->year;
                    $status_tagihan = $datasaya->status;
                    $metode_bayar   = $datasaya->metode_payment;

                    $queryLayanan = $this->db->get_where('package_item', ['p_item_id' => $id_layanan])->row_array();
                    $id_kategori = $queryLayanan['category_id'];
                    $queryKategori  = $this->db->get_where('package_category', ['p_category_id' => $id_kategori])->row_array();
                    $queryUser      = $this->db->get_where('user', ['no_services' => $no_services])->row_array();

                    if ($queryCustomer['ppn'] == 0) {
                        $harga_pajak = 0;
                        $ppnCustomer = 0;
                    } else {
                        $harga_pajak = ($queryLayanan['price'] / 100) * $queryCompany['ppn'];
                        $ppnCustomer = $queryCompany['ppn'];
                    }
                    $jumlah_tagihan = $harga_pajak + $queryLayanan['price'];

                    if ($status_tagihan == 'BELUM BAYAR') {
                        $queryOther  = $this->db->get('other')->row_array();
                        $pesan_whatsapp = '*'.$queryOther['say_wa'].'*
*' . $queryCompany['company_name'] . '*

Yth. ' . strtoupper($nama_pelanggan) . '
Nomor Layanan    : ' . $no_services . '
Nomor Tagihan     : ' . $no_invoice . '
Jumlah Tagihan    : Rp. ' . indo_currency($datasaya->amount) . '

*DENGAN RINCIAN TAGIHAN*
Harga Paket          : Rp. ' . indo_currency($queryLayanan['price']) . '
Pajak / PPN ' . $ppnCustomer . '%  : Rp.' . indo_currency($harga_pajak) . '
Total Tagihan        : Rp. ' . indo_currency($jumlah_tagihan) . '

Paket Langganan : ' . $queryLayanan['name'] . '
Kategori Layanan : ' . $queryKategori['name'] . '
Status Tagihan      : *' . $status_tagihan . '*
Tgl. Jatuh Tempo  : ' . $tgl_due_date . ' ' . indo_month($bulan_tagihan) . ' ' . $tahun_tagihan . '
Nomor NIK / KTP : ' . $nomor_nik_ktp . '
Nomor Telepon    : ' . $nomor_penerima . '

ID / Kode Wilayah : ' . $queryCoverage['c_name'] . '
Alamat Lengkap    : 
' . $alamat_lengkap . '
Tedaftar Sejak       : ' . $queryCustomer['register_date'] . '

*Akun Login Aplikasi  ' . $queryCompany['nama_singkat'] . '*
Username : ' . $queryUser['email'] . '
Password  : ' . $queryUser['pass_text'] . '
' . base_url() . 'auth

*Download Aplikasi ' . $queryCompany['nama_singkat'] . ' di :*
' . $link_app . '

*Link Pembayaran :*
' . base_url() . 'front/quickpayment/' . $no_invoice . '

*Link Cetak Invoice :*
' . base_url() . 'bill/cetak/' . $no_invoice . '

'.$queryOther['body_wa'].'

*'.$queryOther['footer_wa'].'*';

                        if ($url_isolir != '') {
                            $dataWhatsapp = [
                                'api_key' => $api_key_wa,
                                'sender' => $nomor_pengirim,
                                'number' => $nomor_penerima,
                                'message' => $pesan_whatsapp,
                                'url' => $url_isolir,
                                'type' => 'image',
                            ];

                            $mycurl = curl_init();
                            curl_setopt_array($mycurl, array(
                                CURLOPT_URL => $link_url_wa,
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => '',
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 0,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => 'POST',
                                CURLOPT_POSTFIELDS => json_encode($dataWhatsapp),
                                CURLOPT_HTTPHEADER => array(
                                    'Content-Type: application/json'
                                ),
                            ));

                            $response  = curl_exec($mycurl);
                            $statusnya = substr($response, 10, 4);
                            echo $response;
                            $err = curl_error($mycurl);
                            echo $err;

                            $kirim_sukses = $datagua->kirim_sukses + 1;
                            $kirim_gagal  = $datagua->kirim_gagal + 1;
                            $jumlah_kirim = $datagua->jumlah_kirim + 1;
                            $id_campaign  = $datagua->id_campaign;

                            if ($statusnya ==  'true') {
                                $this->db->set('nomor_invoice', $no_invoice);
                                $this->db->set('jumlah_kirim', $jumlah_kirim);
                                $this->db->set('kirim_sukses', $kirim_sukses);
                                $this->db->set('update_campaign', $tanggal);
                                $this->db->where('id_campaign', $id_campaign);
                                $this->db->update('campaign');
                            } else {
                                $this->db->set('nomor_invoice', $no_invoice);
                                $this->db->set('jumlah_kirim', $jumlah_kirim);
                                $this->db->set('kirim_gagal', $kirim_gagal);
                                $this->db->set('update_campaign', $tanggal);
                                $this->db->where('id_campaign', $id_campaign);
                                $this->db->update('campaign');
                            }
                            curl_close($mycurl);
                            echo '<br>Pelanggan Atas Nama ' . $nama_pelanggan . ' Tagihannya BELUM BAYAR';
                        } else {
                            $dataWhatsapp = [
                                'api_key' => $api_key_wa,
                                'sender' => $nomor_pengirim,
                                'number' => $nomor_penerima,
                                'message' => $pesan_whatsapp,
                            ];

                            $mycurl = curl_init();
                            curl_setopt_array($mycurl, array(
                                CURLOPT_URL => $link_url_wa,
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => '',
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 0,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => 'POST',
                                CURLOPT_POSTFIELDS => json_encode($dataWhatsapp),
                                CURLOPT_HTTPHEADER => array(
                                    'Content-Type: application/json'
                                ),
                            ));

                            $response  = curl_exec($mycurl);
                            $statusnya = substr($response, 10, 4);
                            echo $response;
                            $err = curl_error($mycurl);
                            echo $err;

                            $kirim_sukses = $datagua->kirim_sukses + 1;
                            $kirim_gagal  = $datagua->kirim_gagal + 1;
                            $jumlah_kirim = $datagua->jumlah_kirim + 1;
                            $id_campaign  = $datagua->id_campaign;

                            if ($statusnya ==  'true') {
                                $this->db->set('nomor_invoice', $no_invoice);
                                $this->db->set('jumlah_kirim', $jumlah_kirim);
                                $this->db->set('kirim_sukses', $kirim_sukses);
                                $this->db->set('update_campaign', $tanggal);
                                $this->db->where('id_campaign', $id_campaign);
                                $this->db->update('campaign');
                            } else {
                                $this->db->set('nomor_invoice', $no_invoice);
                                $this->db->set('jumlah_kirim', $jumlah_kirim);
                                $this->db->set('kirim_gagal', $kirim_gagal);
                                $this->db->set('update_campaign', $tanggal);
                                $this->db->where('id_campaign', $id_campaign);
                                $this->db->update('campaign');
                            }
                            curl_close($mycurl);
                            echo '<br>Pelanggan Atas Nama ' . $nama_pelanggan . ' Tagihannya BELUM BAYAR';
                        }
                    } else {
                        $queryOther  = $this->db->get('other')->row_array();
                        $pesan_whatsapp = '*'.$queryOther['say_wa'].'*
*' . $queryCompany['company_name'] . '*

Yth. ' . strtoupper($nama_pelanggan) . '
Nomor Layanan    : ' . $no_services . '
Nomor Tagihan     : ' . $no_invoice . '
Status Tagihan      : *' . $status_tagihan . '*
Metode Bayar        : *' . $metode_bayar . '*

'.$queryOther['thanks_wa'].'

*IKUTI AKUN SOCIAL MEDIA KAMI*
facebook.com/' . $queryCompany['facebook'] . '
twitter.com/' . $queryCompany['twitter'] . '
instagram.com/' . $queryCompany['instagram'] . '
youtube.com/' . $queryCompany['youtube'] . '
https://t.me/' . $queryCompany['telegram'] . '
' . $queryCompany['website'] . '

Agar Selalu Dapat Info dan Promo
Menarik yang terbaru dari kami

*Akun Login Aplikasi ' . $queryCompany['nama_singkat'] . '*
Username : ' . $queryUser['email'] . '
Password  : ' . $queryUser['pass_text'] . '
' . base_url() . 'auth

*Link Cetak Invoice :*
' . base_url() . 'bill/cetak/' . $no_invoice . '

*Download Aplikasi ' . $queryCompany['nama_singkat'] . ' di :*
' . $link_app;

                        if ($url_thanks != '') {
                            $dataWhatsapp = [
                                'api_key' => $api_key_wa,
                                'sender' => $nomor_pengirim,
                                'number' => $nomor_penerima,
                                'message' => $pesan_whatsapp,
                                'url' => $url_thanks,
                                'type' => 'image',
                            ];

                            $mycurl = curl_init();
                            curl_setopt_array($mycurl, array(
                                CURLOPT_URL => $link_url_wa,
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => '',
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 0,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => 'POST',
                                CURLOPT_POSTFIELDS => json_encode($dataWhatsapp),
                                CURLOPT_HTTPHEADER => array(
                                    'Content-Type: application/json'
                                ),
                            ));

                            $response  = curl_exec($mycurl);
                            $statusnya = substr($response, 10, 4);
                            echo $response;
                            $err = curl_error($mycurl);
                            echo $err;

                            $kirim_sukses = $datagua->kirim_sukses + 1;
                            $kirim_gagal  = $datagua->kirim_gagal + 1;
                            $jumlah_kirim = $datagua->jumlah_kirim + 1;
                            $id_campaign  = $datagua->id_campaign;

                            if ($statusnya ==  'true') {
                                $this->db->set('nomor_invoice', $no_invoice);
                                $this->db->set('jumlah_kirim', $jumlah_kirim);
                                $this->db->set('kirim_sukses', $kirim_sukses);
                                $this->db->set('update_campaign', $tanggal);
                                $this->db->where('id_campaign', $id_campaign);
                                $this->db->update('campaign');
                            } else {
                                $this->db->set('nomor_invoice', $no_invoice);
                                $this->db->set('jumlah_kirim', $jumlah_kirim);
                                $this->db->set('kirim_gagal', $kirim_gagal);
                                $this->db->set('update_campaign', $tanggal);
                                $this->db->where('id_campaign', $id_campaign);
                                $this->db->update('campaign');
                            }
                            curl_close($mycurl);
                            echo '<br>Pelanggan Atas Nama ' . $nama_pelanggan . ' Tagihannya SUDAH BAYAR';
                        } else {
                            $dataWhatsapp = [
                                'api_key' => $api_key_wa,
                                'sender' => $nomor_pengirim,
                                'number' => $nomor_penerima,
                                'message' => $pesan_whatsapp,
                            ];

                            $mycurl = curl_init();
                            curl_setopt_array($mycurl, array(
                                CURLOPT_URL => $link_url_wa,
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => '',
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 0,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => 'POST',
                                CURLOPT_POSTFIELDS => json_encode($dataWhatsapp),
                                CURLOPT_HTTPHEADER => array(
                                    'Content-Type: application/json'
                                ),
                            ));

                            $response  = curl_exec($mycurl);
                            $statusnya = substr($response, 10, 4);
                            echo $response;
                            $err = curl_error($mycurl);
                            echo $err;

                            $kirim_sukses = $datagua->kirim_sukses + 1;
                            $kirim_gagal  = $datagua->kirim_gagal + 1;
                            $jumlah_kirim = $datagua->jumlah_kirim + 1;
                            $id_campaign  = $datagua->id_campaign;

                            if ($statusnya ==  'true') {
                                $this->db->set('nomor_invoice', $no_invoice);
                                $this->db->set('jumlah_kirim', $jumlah_kirim);
                                $this->db->set('kirim_sukses', $kirim_sukses);
                                $this->db->set('update_campaign', $tanggal);
                                $this->db->where('id_campaign', $id_campaign);
                                $this->db->update('campaign');
                            } else {
                                $this->db->set('nomor_invoice', $no_invoice);
                                $this->db->set('jumlah_kirim', $jumlah_kirim);
                                $this->db->set('kirim_gagal', $kirim_gagal);
                                $this->db->set('update_campaign', $tanggal);
                                $this->db->where('id_campaign', $id_campaign);
                                $this->db->update('campaign');
                            }
                            curl_close($mycurl);
                            echo '<br>Pelanggan Atas Nama ' . $nama_pelanggan . ' Tagihannya SUDAH BAYAR';
                        }
                    }
                }
            }
            
            echo '('.$no++.') '.$customer->no_services . ' -  ' . $customer->name . ' => Sudah di Reminder hari ini !!! <br>';
        } else {
            echo '('.$no++.') '.$customer->no_services . ' -  ' . $customer->username . ' => Tidak di Reminder hari ini !!! <br>';
        }
    }

    public function jatuhtempo()
    {
        $tanggal    = date('d/m/Y H:i:s') . " WIB";
        $hari_ini   = date('d');
        $bulan_ini  = date('m');
        $tahun_ini  = date('Y');

        $queryCustomer  = $this->db->get_where('customer', ['due_date' => $hari_ini])->result();
        $whatsapp       = $this->db->get('whatsapp')->row_array();
        $nomor_pengirim = $whatsapp['number'];
        $api_key_wa     = $whatsapp['api_key'];
        $link_url_wa    = $whatsapp['link_url'];
        $link_url_web   = $whatsapp['url_web'];

        foreach ($queryCustomer as $datagua) {
            $no_services    = $datagua->no_services;
            $nomor_penerima = $datagua->no_wa;
            $queryInvoice   = $this->db->get_where('invoice', ['no_services' => $no_services, 'month' => $bulan_ini, 'year' => $tahun_ini])->result();
            foreach ($queryInvoice as $datasaya) {
                $no_invoice     = $datasaya->invoice;

                $nama_pelanggan = $datagua->name;
                $jatuh_tempo    = $datagua->due_date;
                $id_coverage    = $datagua->coverage;

                $queryCoverage  = $this->db->get_where('coverage', ['coverage_id' => $id_coverage])->row_array();
                $id_kelurahan   = $queryCoverage['id_kel'];
                $id_kecamatan   = $queryCoverage['id_kec'];
                $id_kabupaten   = $queryCoverage['id_kab'];
                $id_provinsi    = $queryCoverage['id_prov'];

                $queryOther  = $this->db->get('other')->row_array();
                $url_isolir  = $queryOther['isolir_image'];
                $url_thanks  = $queryOther['thanks_image'];

                $queryKelurahan = $this->db->get_where('wilayah_desa', ['id' => $id_kelurahan])->row_array();
                $queryKecamatan = $this->db->get_where('wilayah_kecamatan', ['id' => $id_kecamatan])->row_array();
                $queryKabupaten = $this->db->get_where('wilayah_kabupaten', ['id' => $id_kabupaten])->row_array();
                $queryProvinsi  = $this->db->get_where('wilayah_provinsi', ['id' => $id_provinsi])->row_array();
                $alamat_lengkap = $queryCoverage['address'] . ', Rt/Rw ' . $queryCoverage['nomor_rt'] . '/' . $queryCoverage['nomor_rw'] . ', ' . $queryKelurahan['nama'] . ', Kec.' . $queryKecamatan['nama'] . ', ' . $queryKabupaten['nama'] . ', Prov. ' . $queryProvinsi['nama'] . ' - Indonesia ' . $queryCoverage['kode_pos'];
                $queryCompany   = $this->db->get_where('company', ['status' => 'Aktif'])->row_array();
                $link_app       = $queryCompany['link_app'];
                if ($jatuh_tempo == 0) {
                    $tgl_due_date = $queryCompany['due_date'];
                } else {
                    $tgl_due_date = $jatuh_tempo;
                }

                $nomor_nik_ktp  = $datagua->no_ktp;
                $id_layanan     = $datagua->item_paket;
                $bulan_tagihan  = $datasaya->month;
                $tahun_tagihan  = $datasaya->year;
                $status_tagihan = $datasaya->status;
                $metode_bayar   = $datasaya->metode_payment;

                $queryLayanan = $this->db->get_where('package_item', ['p_item_id' => $id_layanan])->row_array();
                $id_kategori = $queryLayanan['category_id'];
                $queryKategori  = $this->db->get_where('package_category', ['p_category_id' => $id_kategori])->row_array();
                $queryUser      = $this->db->get_where('user', ['no_services' => $no_services])->row_array();

                if ($datagua->ppn == 0) {
                    $harga_pajak = 0;
                    $ppnCustomer = 0;
                } else {
                    $harga_pajak = ($queryLayanan['price'] / 100) * $queryCompany['ppn'];
                    $ppnCustomer = $queryCompany['ppn'];
                }
                $jumlah_tagihan = $harga_pajak + $queryLayanan['price'];

                if ($status_tagihan == 'BELUM BAYAR') {
                    $queryOther  = $this->db->get('other')->row_array();
                    $pesan_whatsapp = '*'.$queryOther['say_wa'].'*
*' . $queryCompany['company_name'] . '*

Yth. ' . strtoupper($nama_pelanggan) . '
Nomor Layanan    : ' . $no_services . '
Nomor Tagihan     : ' . $no_invoice . '
Jumlah Tagihan    : Rp. ' . indo_currency($datasaya->amount) . '

*DENGAN RINCIAN TAGIHAN*
Harga Paket          : Rp. ' . indo_currency($queryLayanan['price']) . '
Pajak / PPN ' . $ppnCustomer . '%  : Rp.' . indo_currency($harga_pajak) . '
Total Tagihan        : Rp. ' . indo_currency($jumlah_tagihan) . '

Paket Langganan : ' . $queryLayanan['name'] . '
Kategori Layanan : ' . $queryKategori['name'] . '
Status Tagihan      : *' . $status_tagihan . '*
Tgl. Jatuh Tempo  : ' . $tgl_due_date . ' ' . indo_month($bulan_tagihan) . ' ' . $tahun_tagihan . '
Nomor NIK / KTP : ' . $nomor_nik_ktp . '
Nomor Telepon    : ' . $nomor_penerima . '

ID / Kode Wilayah : ' . $queryCoverage['c_name'] . '
Alamat Lengkap    : 
' . $alamat_lengkap . '
Tedaftar Sejak       : ' . $datagua->register_date . '

*Akun Login Aplikasi  ' . $queryCompany['nama_singkat'] . '*
Username : ' . $queryUser['email'] . '
Password  : ' . $queryUser['pass_text'] . '
' . base_url() . 'auth

*Download Aplikasi ' . $queryCompany['nama_singkat'] . ' di :*
' . $link_app . '

*Link Pembayaran :*
' . base_url() . 'front/quickpayment/' . $no_invoice . '

*Link Cetak Invoice :*
' . base_url() . 'bill/cetak/' . $no_invoice . '

'.$queryOther['body_wa'].'

*'.$queryOther['footer_wa'].'*';

                    if ($url_isolir != '') {
                        $dataWhatsapp = [
                            'api_key' => $api_key_wa,
                            'sender' => $nomor_pengirim,
                            'number' => $nomor_penerima,
                            'message' => $pesan_whatsapp,
                            'url' => $url_isolir,
                            'type' => 'image',
                        ];

                        $mycurl = curl_init();
                        curl_setopt_array($mycurl, array(
                            CURLOPT_URL => $link_url_wa,
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => json_encode($dataWhatsapp),
                            CURLOPT_HTTPHEADER => array(
                                'Content-Type: application/json'
                            ),
                        ));

                        $response  = curl_exec($mycurl);
                        $statusnya = substr($response, 10, 4);
                        echo $response;

                        $queryCampaign  = $this->db->get_where('campaign', ['nomor_services' => $datagua->no_services])->row_array();
                        $kirim_sukses   = $queryCampaign['kirim_sukses'] + 1;
                        $kirim_gagal    = $queryCampaign['kirim_gagal'] + 1;
                        $jumlah_kirim   = $queryCampaign['jumlah_kirim'] + 1;
                        $id_campaign    = $queryCampaign['id_campaign'];

                        if ($statusnya ==  'true') {
                            $this->db->set('nomor_invoice', $no_invoice);
                            $this->db->set('jumlah_kirim', $jumlah_kirim);
                            $this->db->set('kirim_sukses', $kirim_sukses);
                            $this->db->set('update_campaign', $tanggal);
                            $this->db->where('id_campaign', $id_campaign);
                            $this->db->update('campaign');
                        } else {
                            $this->db->set('nomor_invoice', $no_invoice);
                            $this->db->set('jumlah_kirim', $jumlah_kirim);
                            $this->db->set('kirim_gagal', $kirim_gagal);
                            $this->db->set('update_campaign', $tanggal);
                            $this->db->where('id_campaign', $id_campaign);
                            $this->db->update('campaign');
                        }
                        $err = curl_error($mycurl);
                        curl_close($mycurl);
                        echo $err;
                        echo '<br>Pelanggan Atas Nama ' . $nama_pelanggan . ' Tagihannya BELUM BAYAR';
                    } else {
                        $dataWhatsapp = [
                            'api_key' => $api_key_wa,
                            'sender' => $nomor_pengirim,
                            'number' => $nomor_penerima,
                            'message' => $pesan_whatsapp,
                        ];

                        $mycurl = curl_init();
                        curl_setopt_array($mycurl, array(
                            CURLOPT_URL => $link_url_wa,
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => json_encode($dataWhatsapp),
                            CURLOPT_HTTPHEADER => array(
                                'Content-Type: application/json'
                            ),
                        ));

                        $response  = curl_exec($mycurl);
                        $statusnya = substr($response, 10, 4);
                        echo $response;

                        $queryCampaign  = $this->db->get_where('campaign', ['nomor_services' => $datagua->no_services])->row_array();
                        $kirim_sukses   = $queryCampaign['kirim_sukses'] + 1;
                        $kirim_gagal    = $queryCampaign['kirim_gagal'] + 1;
                        $jumlah_kirim   = $queryCampaign['jumlah_kirim'] + 1;
                        $id_campaign    = $queryCampaign['id_campaign'];

                        if ($statusnya ==  'true') {
                            $this->db->set('nomor_invoice', $no_invoice);
                            $this->db->set('jumlah_kirim', $jumlah_kirim);
                            $this->db->set('kirim_sukses', $kirim_sukses);
                            $this->db->set('update_campaign', $tanggal);
                            $this->db->where('id_campaign', $id_campaign);
                            $this->db->update('campaign');
                        } else {
                            $this->db->set('nomor_invoice', $no_invoice);
                            $this->db->set('jumlah_kirim', $jumlah_kirim);
                            $this->db->set('kirim_gagal', $kirim_gagal);
                            $this->db->set('update_campaign', $tanggal);
                            $this->db->where('id_campaign', $id_campaign);
                            $this->db->update('campaign');
                        }
                        $err = curl_error($mycurl);
                        curl_close($mycurl);
                        echo $err;
                        echo '<br>Pelanggan Atas Nama ' . $nama_pelanggan . ' Tagihannya BELUM BAYAR';
                    }
                } else {
                    $queryOther  = $this->db->get('other')->row_array();
                    $pesan_whatsapp = '*'.$queryOther['say_wa'].'*
*' . $queryCompany['company_name'] . '*

Yth. ' . strtoupper($nama_pelanggan) . '
Nomor Layanan    : ' . $no_services . '
Nomor Tagihan     : ' . $no_invoice . '
Status Tagihan      : *' . $status_tagihan . '*
Metode Bayar        : *' . $metode_bayar . '*

'.$queryOther['thanks_wa'].'

*IKUTI AKUN SOCIAL MEDIA KAMI*
facebook.com/' . $queryCompany['facebook'] . '
twitter.com/' . $queryCompany['twitter'] . '
instagram.com/' . $queryCompany['instagram'] . '
youtube.com/' . $queryCompany['youtube'] . '
https://t.me/' . $queryCompany['telegram'] . '
' . $queryCompany['website'] . '

Agar Selalu Dapat Info dan Promo
Menarik yang terbaru dari kami

*Akun Login Aplikasi ' . $queryCompany['nama_singkat'] . '*
Username : ' . $queryUser['email'] . '
Password  : ' . $queryUser['pass_text'] . '
' . base_url() . 'auth

*Link Cetak Invoice :*
' . base_url() . 'bill/cetak/' . $no_invoice . '

*Download Aplikasi ' . $queryCompany['nama_singkat'] . ' di :*
' . $link_app;

                    if ($url_thanks != '') {
                        $dataWhatsapp = [
                            'api_key' => $api_key_wa,
                            'sender' => $nomor_pengirim,
                            'number' => $nomor_penerima,
                            'message' => $pesan_whatsapp,
                            'url' => $url_thanks,
                            'type' => 'image',
                        ];

                        $mycurl = curl_init();
                        curl_setopt_array($mycurl, array(
                            CURLOPT_URL => $link_url_wa,
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => json_encode($dataWhatsapp),
                            CURLOPT_HTTPHEADER => array(
                                'Content-Type: application/json'
                            ),
                        ));

                        $response  = curl_exec($mycurl);
                        $statusnya = substr($response, 10, 4);
                        echo $response;

                        $queryCampaign  = $this->db->get_where('campaign', ['nomor_services' => $datagua->no_services])->row_array();
                        $kirim_sukses   = $queryCampaign['kirim_sukses'] + 1;
                        $kirim_gagal    = $queryCampaign['kirim_gagal'] + 1;
                        $jumlah_kirim   = $queryCampaign['jumlah_kirim'] + 1;
                        $id_campaign    = $queryCampaign['id_campaign'];

                        if ($statusnya ==  'true') {
                            $this->db->set('nomor_invoice', $no_invoice);
                            $this->db->set('jumlah_kirim', $jumlah_kirim);
                            $this->db->set('kirim_sukses', $kirim_sukses);
                            $this->db->set('update_campaign', $tanggal);
                            $this->db->where('id_campaign', $id_campaign);
                            $this->db->update('campaign');
                        } else {
                            $this->db->set('nomor_invoice', $no_invoice);
                            $this->db->set('jumlah_kirim', $jumlah_kirim);
                            $this->db->set('kirim_gagal', $kirim_gagal);
                            $this->db->set('update_campaign', $tanggal);
                            $this->db->where('id_campaign', $id_campaign);
                            $this->db->update('campaign');
                        }
                        $err = curl_error($mycurl);
                        curl_close($mycurl);
                        echo $err;
                        echo '<br>Pelanggan Atas Nama ' . $nama_pelanggan . ' Tagihannya SUDAH BAYAR';
                    } else {
                        $dataWhatsapp = [
                            'api_key' => $api_key_wa,
                            'sender' => $nomor_pengirim,
                            'number' => $nomor_penerima,
                            'message' => $pesan_whatsapp,
                        ];

                        $mycurl = curl_init();
                        curl_setopt_array($mycurl, array(
                            CURLOPT_URL => $link_url_wa,
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => json_encode($dataWhatsapp),
                            CURLOPT_HTTPHEADER => array(
                                'Content-Type: application/json'
                            ),
                        ));

                        $response  = curl_exec($mycurl);
                        $statusnya = substr($response, 10, 4);
                        echo $response;

                        $queryCampaign  = $this->db->get_where('campaign', ['nomor_services' => $datagua->no_services])->row_array();
                        $kirim_sukses   = $queryCampaign['kirim_sukses'] + 1;
                        $kirim_gagal    = $queryCampaign['kirim_gagal'] + 1;
                        $jumlah_kirim   = $queryCampaign['jumlah_kirim'] + 1;
                        $id_campaign    = $queryCampaign['id_campaign'];

                        if ($statusnya ==  'true') {
                            $this->db->set('nomor_invoice', $no_invoice);
                            $this->db->set('jumlah_kirim', $jumlah_kirim);
                            $this->db->set('kirim_sukses', $kirim_sukses);
                            $this->db->set('update_campaign', $tanggal);
                            $this->db->where('id_campaign', $id_campaign);
                            $this->db->update('campaign');
                        } else {
                            $this->db->set('nomor_invoice', $no_invoice);
                            $this->db->set('jumlah_kirim', $jumlah_kirim);
                            $this->db->set('kirim_gagal', $kirim_gagal);
                            $this->db->set('update_campaign', $tanggal);
                            $this->db->where('id_campaign', $id_campaign);
                            $this->db->update('campaign');
                        }
                        $err = curl_error($mycurl);
                        curl_close($mycurl);
                        echo $err;
                        echo '<br>Pelanggan Atas Nama ' . $nama_pelanggan . ' Tagihannya SUDAH BAYAR';
                    }
                }
            }
        }
    }
    public function kirimpesan($id)
    {
        $tanggal    = date('d/m/Y H:i:s') . " WIB";
        $hari_ini   = date('d');
        $bulan_ini  = date('m');
        $tahun_ini  = date('Y');

        $queryCampaign  = $this->db->get_where('campaign', ['id_campaign' => $id])->row_array();
        $whatsapp       = $this->db->get('whatsapp')->row_array();
        $nomor_pengirim = $whatsapp['number'];
        $api_key_wa     = $whatsapp['api_key'];
        $link_url_wa    = $whatsapp['link_url'];
        $link_url_web   = $whatsapp['url_web'];

        $no_services    = $queryCampaign['nomor_services'];
        $nomor_penerima = $queryCampaign['nomor_whatsapp'];
        $queryInvoice   = $this->db->get_where('invoice', ['no_services' => $no_services, 'month' => $bulan_ini, 'year' => $tahun_ini])->result();
        foreach ($queryInvoice as $datasaya) {
            $no_invoice     = $datasaya->invoice;
            $queryCustomer  = $this->db->get_where('customer', ['no_services' => $no_services])->row_array();
            $nama_pelanggan = $queryCustomer['name'];
            $jatuh_tempo    = $queryCustomer['due_date'];
            $id_coverage    = $queryCustomer['coverage'];

            $queryCoverage  = $this->db->get_where('coverage', ['coverage_id' => $id_coverage])->row_array();
            $id_kelurahan   = $queryCoverage['id_kel'];
            $id_kecamatan   = $queryCoverage['id_kec'];
            $id_kabupaten   = $queryCoverage['id_kab'];
            $id_provinsi    = $queryCoverage['id_prov'];

            $queryOther  = $this->db->get('other')->row_array();
            $url_isolir  = $queryOther['isolir_image'];

            $queryKelurahan = $this->db->get_where('wilayah_desa', ['id' => $id_kelurahan])->row_array();
            $queryKecamatan = $this->db->get_where('wilayah_kecamatan', ['id' => $id_kecamatan])->row_array();
            $queryKabupaten = $this->db->get_where('wilayah_kabupaten', ['id' => $id_kabupaten])->row_array();
            $queryProvinsi  = $this->db->get_where('wilayah_provinsi', ['id' => $id_provinsi])->row_array();
            $alamat_lengkap = $queryCoverage['address'] . ', Rt/Rw ' . $queryCoverage['nomor_rt'] . '/' . $queryCoverage['nomor_rw'] . ', ' . $queryKelurahan['nama'] . ', Kec.' . $queryKecamatan['nama'] . ', ' . $queryKabupaten['nama'] . ', Prov. ' . $queryProvinsi['nama'] . ' - Indonesia ' . $queryCoverage['kode_pos'];
            $queryCompany   = $this->db->get_where('company', ['status' => 'Aktif'])->row_array();
            $link_app       = $queryCompany['link_app'];
            if ($jatuh_tempo == 0) {
                $tgl_due_date = $queryCompany['due_date'];
            } else {
                $tgl_due_date = $jatuh_tempo;
            }

            $nomor_nik_ktp  = $queryCustomer['no_ktp'];
            $id_layanan     = $queryCustomer['item_paket'];
            $bulan_tagihan  = $datasaya->month;
            $tahun_tagihan  = $datasaya->year;
            $status_tagihan = $datasaya->status;
            $metode_bayar   = $datasaya->metode_payment;

            $queryLayanan   = $this->db->get_where('package_item', ['p_item_id' => $id_layanan])->row_array();
            $id_kategori    = $queryLayanan['category_id'];
            $queryKategori  = $this->db->get_where('package_category', ['p_category_id' => $id_kategori])->row_array();
            $queryUser      = $this->db->get_where('user', ['no_services' => $no_services])->row_array();

            if ($queryCustomer['ppn'] == 0) {
                $harga_pajak = 0;
                $ppnCustomer = 0;
            } else {
                $harga_pajak = ($queryLayanan['price'] / 100) * $queryCompany['ppn'];
                $ppnCustomer = $queryCompany['ppn'];
            }
            $jumlah_tagihan = $harga_pajak + $queryLayanan['price'];
            
            $queryOther  = $this->db->get('other')->row_array();
            $pesan_whatsapp = '*'.$queryOther['say_wa'].'*
*' . $queryCompany['company_name'] . '*

Yth. ' . strtoupper($nama_pelanggan) . '
Nomor Layanan    : ' . $no_services . '
Nomor Tagihan     : ' . $no_invoice . '
Jumlah Tagihan    : Rp. ' . indo_currency($datasaya->amount) . '

*DENGAN RINCIAN TAGIHAN*
Harga Paket          : Rp. ' . indo_currency($queryLayanan['price']) . '
Pajak / PPN ' . $ppnCustomer . '%  : Rp.' . indo_currency($harga_pajak) . '
Total Tagihan        : Rp. ' . indo_currency($jumlah_tagihan) . '

Paket Langganan : ' . $queryLayanan['name'] . '
Kategori Layanan : ' . $queryKategori['name'] . '
Status Tagihan      : *' . $status_tagihan . '*
Tgl. Jatuh Tempo  : ' . $tgl_due_date . ' ' . indo_month($bulan_tagihan) . ' ' . $tahun_tagihan . '
Nomor NIK / KTP : ' . $nomor_nik_ktp . '
Nomor Telepon    : ' . $nomor_penerima . '

ID / Kode Wilayah : ' . $queryCoverage['c_name'] . '
Alamat Lengkap    : 
' . $alamat_lengkap . '
Tedaftar Sejak       : ' . $queryCustomer['register_date'] . '

*Akun Login Aplikasi  ' . $queryCompany['nama_singkat'] . '*
Username : ' . $queryUser['email'] . '
Password  : ' . $queryUser['pass_text'] . '
' . base_url() . 'auth

*Download Aplikasi ' . $queryCompany['nama_singkat'] . ' di :*
' . $link_app . '

*Link Pembayaran :*
' . base_url() . 'front/quickpayment/' . $no_invoice . '

*Link Cetak Invoice :*
' . base_url() . 'bill/cetak/' . $no_invoice . '

'.$queryOther['body_wa'].'

*'.$queryOther['footer_wa'].'*';

            if ($url_isolir != '') {
                $dataWhatsapp = [
                    'api_key' => $api_key_wa,
                    'sender' => $nomor_pengirim,
                    'number' => $nomor_penerima,
                    'message' => $pesan_whatsapp,
                    'url' => $url_isolir,
                    'type' => 'image',
                ];

                $thiscurl = curl_init();
                curl_setopt_array($thiscurl, array(
                    CURLOPT_URL => $link_url_wa,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => json_encode($dataWhatsapp),
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                ));
            } else {
                $dataWhatsapp = [
                    'api_key' => $api_key_wa,
                    'sender' => $nomor_pengirim,
                    'number' => $nomor_penerima,
                    'message' => $pesan_whatsapp,
                ];

                $thiscurl = curl_init();
                curl_setopt_array($thiscurl, array(
                    CURLOPT_URL => $link_url_wa,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => json_encode($dataWhatsapp),
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                ));
            }
        }
        $response  = curl_exec($thiscurl);
        $statusnya = substr($response, 10, 4);

        $kirim_sukses = $queryCampaign['kirim_sukses'] + 1;
        $kirim_gagal  = $queryCampaign['kirim_gagal'] + 1;
        $jumlah_kirim = $queryCampaign['jumlah_kirim'] + 1;
        $id_campaign  = $queryCampaign['id_campaign'];

        if ($statusnya ==  'true') {
            $this->db->set('nomor_invoice', $no_invoice);
            $this->db->set('jumlah_kirim', $jumlah_kirim);
            $this->db->set('kirim_sukses', $kirim_sukses);
            $this->db->set('update_campaign', $tanggal);
            $this->db->where('id_campaign', $id_campaign);
            $this->db->update('campaign');

            $this->session->set_flashdata('success', 'Berhasil Mengirim Pesan Pengingat Tagihan ke Pelanggan');
            redirect($_SERVER['HTTP_REFERER']);
            curl_close($thiscurl);
        } else {
            $this->db->set('nomor_invoice', $no_invoice);
            $this->db->set('jumlah_kirim', $jumlah_kirim);
            $this->db->set('kirim_gagal', $kirim_gagal);
            $this->db->set('update_campaign', $tanggal);
            $this->db->where('id_campaign', $id_campaign);
            $this->db->update('campaign');

            $err = curl_error($thiscurl);
            $this->session->set_flashdata('error', $response . '<br><br>' . $err);
            redirect($_SERVER['HTTP_REFERER']);
            curl_close($thiscurl);
        }
    }
    public function kirimmassal()
    {
        $tanggal    = date('d/m/Y H:i:s') . " WIB";
        $hari_ini   = date('d');
        $bulan_ini  = date('m');
        $tahun_ini  = date('Y');

        $queryCampaign  = $this->db->get_where('campaign', ['id_campaign' => 24])->result();
        foreach ($queryCampaign as $value) {
            $whatsapp       = $this->db->get('whatsapp')->row_array();
            $nomor_pengirim = $whatsapp['number'];
            $api_key_wa     = $whatsapp['api_key'];
            $link_url_wa    = $whatsapp['link_url'];
            $link_url_web   = $whatsapp['url_web'];

            $no_services    = $value->nomor_services;
            $nomor_penerima = $value->nomor_whatsapp;
            $queryInvoice   = $this->db->get_where('invoice', ['no_services' => $no_services, 'month' => $bulan_ini, 'year' => $tahun_ini])->result();
            foreach ($queryInvoice as $datasaya) {
                $no_invoice     = $datasaya->invoice;
                $queryCustomer  = $this->db->get_where('customer', ['no_services' => $no_services])->row_array();
                $nama_pelanggan = $queryCustomer['name'];
                $jatuh_tempo    = $queryCustomer['due_date'];
                $id_coverage    = $queryCustomer['coverage'];

                $queryCoverage  = $this->db->get_where('coverage', ['coverage_id' => $id_coverage])->row_array();
                $id_kelurahan   = $queryCoverage['id_kel'];
                $id_kecamatan   = $queryCoverage['id_kec'];
                $id_kabupaten   = $queryCoverage['id_kab'];
                $id_provinsi    = $queryCoverage['id_prov'];

                $queryOther  = $this->db->get('other')->row_array();
                $url_isolir  = $queryOther['isolir_image'];

                $queryKelurahan = $this->db->get_where('wilayah_desa', ['id' => $id_kelurahan])->row_array();
                $queryKecamatan = $this->db->get_where('wilayah_kecamatan', ['id' => $id_kecamatan])->row_array();
                $queryKabupaten = $this->db->get_where('wilayah_kabupaten', ['id' => $id_kabupaten])->row_array();
                $queryProvinsi  = $this->db->get_where('wilayah_provinsi', ['id' => $id_provinsi])->row_array();
                $alamat_lengkap = $queryCoverage['address'] . ', Rt/Rw ' . $queryCoverage['nomor_rt'] . '/' . $queryCoverage['nomor_rw'] . ', ' . $queryKelurahan['nama'] . ', Kec.' . $queryKecamatan['nama'] . ', ' . $queryKabupaten['nama'] . ', Prov. ' . $queryProvinsi['nama'] . ' - Indonesia ' . $queryCoverage['kode_pos'];
                $queryCompany   = $this->db->get_where('company', ['status' => 'Aktif'])->row_array();
                $link_app       = $queryCompany['link_app'];
                if ($jatuh_tempo == 0) {
                    $tgl_due_date = $queryCompany['due_date'];
                } else {
                    $tgl_due_date = $jatuh_tempo;
                }

                $nomor_nik_ktp  = $queryCustomer['no_ktp'];
                $id_layanan     = $queryCustomer['item_paket'];
                $bulan_tagihan  = $datasaya->month;
                $tahun_tagihan  = $datasaya->year;
                $status_tagihan = $datasaya->status;
                $metode_bayar   = $datasaya->metode_payment;

                $queryLayanan   = $this->db->get_where('package_item', ['p_item_id' => $id_layanan])->row_array();
                $id_kategori    = $queryLayanan['category_id'];
                $queryKategori  = $this->db->get_where('package_category', ['p_category_id' => $id_kategori])->row_array();
                $queryUser      = $this->db->get_where('user', ['no_services' => $no_services])->row_array();

                if ($queryCustomer['ppn'] == 0) {
                    $harga_pajak = 0;
                    $ppnCustomer = 0;
                } else {
                    $harga_pajak = ($queryLayanan['price'] / 100) * $queryCompany['ppn'];
                    $ppnCustomer = $queryCompany['ppn'];
                }
                $jumlah_tagihan = $harga_pajak + $queryLayanan['price'];

                if ($status_tagihan == 'BELUM BAYAR') {
                    $queryOther  = $this->db->get('other')->row_array();
                    $pesan_whatsapp = '*'.$queryOther['say_wa'].'*
*' . $queryCompany['company_name'] . '*

Yth. ' . strtoupper($nama_pelanggan) . '
Nomor Layanan    : ' . $no_services . '
Nomor Tagihan     : ' . $no_invoice . '
Jumlah Tagihan    : Rp. ' . indo_currency($datasaya->amount) . '

*DENGAN RINCIAN TAGIHAN*
Harga Paket          : Rp. ' . indo_currency($queryLayanan['price']) . '
Pajak / PPN ' . $ppnCustomer . '%  : Rp.' . indo_currency($harga_pajak) . '
Total Tagihan        : Rp. ' . indo_currency($jumlah_tagihan) . '

Paket Langganan : ' . $queryLayanan['name'] . '
Kategori Layanan : ' . $queryKategori['name'] . '
Status Tagihan      : *' . $status_tagihan . '*
Tgl. Jatuh Tempo  : ' . $tgl_due_date . ' ' . indo_month($bulan_tagihan) . ' ' . $tahun_tagihan . '
Nomor NIK / KTP : ' . $nomor_nik_ktp . '
Nomor Telepon    : ' . $nomor_penerima . '

ID / Kode Wilayah : ' . $queryCoverage['c_name'] . '
Alamat Lengkap    : 
' . $alamat_lengkap . '
Tedaftar Sejak       : ' . $queryCustomer['register_date'] . '

*Akun Login Aplikasi  ' . $queryCompany['nama_singkat'] . '*
Username : ' . $queryUser['email'] . '
Password  : ' . $queryUser['pass_text'] . '
' . base_url() . 'auth

*Download Aplikasi ' . $queryCompany['nama_singkat'] . ' di :*
' . $link_app . '

*Link Pembayaran :*
' . base_url() . 'front/quickpayment/' . $no_invoice . '

*Link Cetak Invoice :*
' . base_url() . 'bill/cetak/' . $no_invoice . '

'.$queryOther['body_wa'].'

*'.$queryOther['footer_wa'].'*';

                    if ($url_isolir != '') {
                        $dataWhatsapp = [
                            'api_key' => $api_key_wa,
                            'sender' => $nomor_pengirim,
                            'number' => $nomor_penerima,
                            'message' => $pesan_whatsapp,
                            'url' => $url_isolir,
                            'type' => 'image',
                        ];

                        $thiscurl = curl_init();
                        curl_setopt_array($thiscurl, array(
                            CURLOPT_URL => $link_url_wa,
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => json_encode($dataWhatsapp),
                            CURLOPT_HTTPHEADER => array(
                                'Content-Type: application/json'
                            ),
                        ));
                    } else {
                        $dataWhatsapp = [
                            'api_key' => $api_key_wa,
                            'sender' => $nomor_pengirim,
                            'number' => $nomor_penerima,
                            'message' => $pesan_whatsapp,
                        ];

                        $thiscurl = curl_init();
                        curl_setopt_array($thiscurl, array(
                            CURLOPT_URL => $link_url_wa,
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => json_encode($dataWhatsapp),
                            CURLOPT_HTTPHEADER => array(
                                'Content-Type: application/json'
                            ),
                        ));
                    }
                    $response  = curl_exec($thiscurl);
                    $statusnya = substr($response, 10, 4);

                    $kirim_sukses = $value->kirim_sukses + 1;
                    $kirim_gagal  = $value->kirim_gagal + 1;
                    $jumlah_kirim = $value->jumlah_kirim + 1;
                    $id_campaign  = $value->id_campaign;

                    if ($statusnya ==  'true') {
                        $this->db->set('nomor_invoice', $no_invoice);
                        $this->db->set('jumlah_kirim', $jumlah_kirim);
                        $this->db->set('kirim_sukses', $kirim_sukses);
                        $this->db->set('update_campaign', $tanggal);
                        $this->db->where('id_campaign', $id_campaign);
                        $this->db->update('campaign');
                    } else {
                        $this->db->set('nomor_invoice', $no_invoice);
                        $this->db->set('jumlah_kirim', $jumlah_kirim);
                        $this->db->set('kirim_gagal', $kirim_gagal);
                        $this->db->set('update_campaign', $tanggal);
                        $this->db->where('id_campaign', $id_campaign);
                        $this->db->update('campaign');
                    }

                    $err = curl_error($thiscurl);
                    curl_close($thiscurl);
                    echo $err . '<br>';
                    echo $response . '<br><br>';
                } else {
                    redirect('cronjob/terimakasih/' . $value->id_campaign);
                }
            }
        }
    }
    public function terimakasih($id)
    {
        $tanggal    = date('d/m/Y H:i:s') . " WIB";
        $hari_ini   = date('d');
        $bulan_ini  = date('m');
        $tahun_ini  = date('Y');

        $queryCampaign  = $this->db->get_where('campaign', ['id_campaign' => $id])->row_array();
        $whatsapp       = $this->db->get('whatsapp')->row_array();
        $nomor_pengirim = $whatsapp['number'];
        $api_key_wa     = $whatsapp['api_key'];
        $link_url_wa    = $whatsapp['link_url'];
        $link_url_web   = $whatsapp['url_web'];

        $no_services    = $queryCampaign['nomor_services'];
        $nomor_penerima = $queryCampaign['nomor_whatsapp'];
        $queryInvoice   = $this->db->get_where('invoice', ['no_services' => $no_services, 'month' => $bulan_ini, 'year' => $tahun_ini])->result();
        foreach ($queryInvoice as $datasaya) {
            $no_invoice     = $datasaya->invoice;
            $queryCustomer  = $this->db->get_where('customer', ['no_services' => $no_services])->row_array();
            $nama_pelanggan = $queryCustomer['name'];
            $jatuh_tempo    = $queryCustomer['due_date'];
            $id_coverage    = $queryCustomer['coverage'];

            $queryCoverage  = $this->db->get_where('coverage', ['coverage_id' => $id_coverage])->row_array();
            $id_kelurahan   = $queryCoverage['id_kel'];
            $id_kecamatan   = $queryCoverage['id_kec'];
            $id_kabupaten   = $queryCoverage['id_kab'];
            $id_provinsi    = $queryCoverage['id_prov'];

            $queryOther  = $this->db->get('other')->row_array();
            $url_thanks  = $queryOther['thanks_image'];

            $queryKelurahan = $this->db->get_where('wilayah_desa', ['id' => $id_kelurahan])->row_array();
            $queryKecamatan = $this->db->get_where('wilayah_kecamatan', ['id' => $id_kecamatan])->row_array();
            $queryKabupaten = $this->db->get_where('wilayah_kabupaten', ['id' => $id_kabupaten])->row_array();
            $queryProvinsi  = $this->db->get_where('wilayah_provinsi', ['id' => $id_provinsi])->row_array();
            $alamat_lengkap = $queryCoverage['address'] . ', Rt/Rw ' . $queryCoverage['nomor_rt'] . '/' . $queryCoverage['nomor_rw'] . ', ' . $queryKelurahan['nama'] . ', Kec.' . $queryKecamatan['nama'] . ', ' . $queryKabupaten['nama'] . ', Prov. ' . $queryProvinsi['nama'] . ' - Indonesia ' . $queryCoverage['kode_pos'];
            $queryCompany   = $this->db->get_where('company', ['status' => 'Aktif'])->row_array();
            $link_app       = $queryCompany['link_app'];
            if ($jatuh_tempo == 0) {
                $tgl_due_date = $queryCompany['due_date'];
            } else {
                $tgl_due_date = $jatuh_tempo;
            }

            $nomor_nik_ktp  = $queryCustomer['no_ktp'];
            $id_layanan     = $queryCustomer['item_paket'];
            $bulan_tagihan  = $datasaya->month;
            $tahun_tagihan  = $datasaya->year;
            $status_tagihan = $datasaya->status;
            $metode_bayar   = $datasaya->metode_payment;

            $queryLayanan   = $this->db->get_where('package_item', ['p_item_id' => $id_layanan])->row_array();
            $id_kategori    = $queryLayanan['category_id'];
            $queryKategori  = $this->db->get_where('package_category', ['p_category_id' => $id_kategori])->row_array();
            $queryUser      = $this->db->get_where('user', ['no_services' => $no_services])->row_array();

            if ($queryCustomer['ppn'] == 0) {
                $harga_pajak = 0;
            } else {
                $harga_pajak = ($queryLayanan['price'] / 100) * $queryCompany['ppn'];
            }
            $jumlah_tagihan = $harga_pajak + $queryLayanan['price'];
            
            $queryOther  = $this->db->get('other')->row_array();
            $pesan_whatsapp = '*'.$queryOther['say_wa'].'*
*' . $queryCompany['company_name'] . '*

Yth. ' . strtoupper($nama_pelanggan) . '
Nomor Layanan    : ' . $no_services . '
Nomor Tagihan     : ' . $no_invoice . '
Status Tagihan      : *' . $status_tagihan . '*
Metode Bayar        : *' . $metode_bayar . '*

'.$queryOther['thanks_wa'].'

*IKUTI AKUN SOCIAL MEDIA KAMI*
facebook.com/' . $queryCompany['facebook'] . '
twitter.com/' . $queryCompany['twitter'] . '
instagram.com/' . $queryCompany['instagram'] . '
youtube.com/' . $queryCompany['youtube'] . '
https://t.me/' . $queryCompany['telegram'] . '
' . $queryCompany['website'] . '

Agar Selalu Dapat Info dan Promo
Menarik yang terbaru dari kami

*Akun Login Aplikasi ' . $queryCompany['nama_singkat'] . '*
Username : ' . $queryUser['email'] . '
Password  : ' . $queryUser['pass_text'] . '
' . base_url() . 'auth

*Link Cetak Invoice :*
' . base_url() . 'bill/cetak/' . $no_invoice . '

*Download Aplikasi ' . $queryCompany['nama_singkat'] . ' di :*
' . $link_app;

            if ($url_thanks != '') {
                $dataWhatsapp = [
                    'api_key' => $api_key_wa,
                    'sender' => $nomor_pengirim,
                    'number' => $nomor_penerima,
                    'message' => $pesan_whatsapp,
                    'url' => $url_thanks,
                    'type' => 'image',
                ];

                $thiscurl = curl_init();
                curl_setopt_array($thiscurl, array(
                    CURLOPT_URL => $link_url_wa,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => json_encode($dataWhatsapp),
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                ));
            } else {
                $dataWhatsapp = [
                    'api_key' => $api_key_wa,
                    'sender' => $nomor_pengirim,
                    'number' => $nomor_penerima,
                    'message' => $pesan_whatsapp,
                ];

                $thiscurl = curl_init();
                curl_setopt_array($thiscurl, array(
                    CURLOPT_URL => $link_url_wa,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => json_encode($dataWhatsapp),
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                ));
            }
        }
        $response  = curl_exec($thiscurl);
        $statusnya = substr($response, 10, 4);

        $kirim_sukses = $queryCampaign['kirim_sukses'] + 1;
        $kirim_gagal  = $queryCampaign['kirim_gagal'] + 1;
        $jumlah_kirim = $queryCampaign['jumlah_kirim'] + 1;
        $id_campaign  = $queryCampaign['id_campaign'];

        if ($statusnya ==  'true') {
            $this->db->set('nomor_invoice', $no_invoice);
            $this->db->set('jumlah_kirim', $jumlah_kirim);
            $this->db->set('kirim_sukses', $kirim_sukses);
            $this->db->set('update_campaign', $tanggal);
            $this->db->where('id_campaign', $id_campaign);
            $this->db->update('campaign');

            $this->session->set_flashdata('success', 'Berhasil Mengirim Pesan Pengingat Tagihan ke Pelanggan');
            $this->session->set_flashdata('info', $response);
            redirect($_SERVER['HTTP_REFERER']);
            curl_close($thiscurl);
        } else {
            $this->db->set('nomor_invoice', $no_invoice);
            $this->db->set('jumlah_kirim', $jumlah_kirim);
            $this->db->set('kirim_gagal', $kirim_gagal);
            $this->db->set('update_campaign', $tanggal);
            $this->db->where('id_campaign', $id_campaign);
            $this->db->update('campaign');

            $err = curl_error($thiscurl);
            $this->session->set_flashdata('error', $response . '<br><br>' . $err);
            redirect($_SERVER['HTTP_REFERER']);
            curl_close($thiscurl);
        }
    }
}
