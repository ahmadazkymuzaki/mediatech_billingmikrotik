<?php defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model(['customer_m', 'router_m', 'member_m', 'product_m', 'router_m', 'package_m',  'setting_m', 'services_m', 'expenditure_m', 'customer_m', 'bill_m', 'income_m']);
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['notifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->result();
        $data['mynotifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->num_rows();
        $data['message'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->result();
        $data['mymessage'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->num_rows();
        $data['other'] = $this->db->get('other')->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $dataUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $no_services = $dataUser['no_services'];
        $cekCustomer = $this->db->get_where('customer', ['email' => $this->session->userdata('email')])->num_rows();

        if ($cekCustomer > 0) {
            $mycustomer = $this->db->get_where('customer', ['email' => $this->session->userdata('email')])->row_array();
            $name = $mycustomer['username'];
            if ($no_services != '') {
                $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
                $host = $myrouter['host_router'];
                $user = $myrouter['user_router'];
                $pass = $myrouter['pass_router'];
                $port = $myrouter['port_router'];
    
                $API = new routeros();
                $API->connect($host, $port, $user, $pass);
    
                $pppuser = $API->comm("/ppp/secret/print", array(
                    '?name' => $name,
                ));
                $pppuser = json_encode($pppuser);
                $pppuser = json_decode($pppuser, true);
    
                $pppactive = $API->comm("/ppp/active/print", array(
                    '?name' => $name,
                ));
                $pppactive = json_encode($pppactive);
                $pppactive = json_decode($pppactive, true);
    
                $dataku = [
                    'totalpppuser' => count($pppuser),
                    'totalpppactive' => count($pppactive),
                    'pppuser' => $pppuser,
                    'pppactive' => $pppactive,
                ];
    
                foreach($pppuser as $dataprofile) {
                    $name_profile = $dataprofile['profile'];
                    $pppprofile = $API->comm("/ppp/profile/print", array(
                        '?name' => $name_profile,
                    ));
                    $pppprofile = json_encode($pppprofile);
                    $pppprofile = json_decode($pppprofile, true);
                    $datagua = [
                        'pppprofile' => $pppprofile,
                    ];
                }
                $data['CountServices'] = $this->services_m->getServices($no_services)->num_rows();
                $data['no_services'] = $no_services;
                $bill = $this->bill_m->getBillThisMonth($no_services)->row();
                if ($bill != '') {
                    $data['totalBill'] = $this->bill_m->getBillThisMonth($no_services)->num_rows();
                    $data['CountBill'] = $this->bill_m->getBillDetail($bill->invoice)->result();
                    $data['bank'] = $this->setting_m->getBank()->result();
                    $data['invoice'] = $this->bill_m->getBillThisMonth($no_services)->row();
                    $data['services'] = $this->services_m->getServices($no_services)->result();
                } else {
                    $data['totalBill'] = 0;
                    $data['CountBill'] = 0;
                }
                $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
                $data['product'] = $this->product_m->get()->result();
                $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
                $MyThemes = $MyCompanyData['tm_member'];
                if($dataUser['role_id'] == 1){
                    $this->template->load($MyThemes, 'member/dashboard', $data + $dataku + $datagua);
                }else{
                    $this->template->load($MyThemes, 'member/dashboard', $data);
                }
            } else {
                $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
                $MyThemes = $MyCompanyData['tm_member'];
                $this->template->load($MyThemes, 'member/dashboard', $data);
            }
        } else {
            $this->session->set_flashdata('error', 'Email anda belum memiliki layanan yang aktif, silahkan hubungi kami untuk menjadi pelanggan kami');
            redirect('member/about');
        }
    }
    public function add()
    {
        $data_user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $PsW = substr(intval(rand()), 0, 8);
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('no_ktp', 'No KTP', 'trim');
        $this->form_validation->set_rules('no_services', 'No Service', 'required|trim|is_unique[customer.no_services]');
        $this->form_validation->set_rules('no_wa', 'No Whatsapp', 'required|trim|is_unique[customer.no_wa]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[customer.email]');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password tidak sama !',
            'min_length' => 'Password terlalu pendek !'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        $this->form_validation->set_message('required', '%s Tidak boleh kosong, Silahkan isi');
        $this->form_validation->set_message('is_unique', '%s Sudah dipakai, Silahkan ganti');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Add Customer';
            $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
            $data['coverage'] = $this->db->get_where('coverage', array('kategori' => 'AREA'))->result();
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
            $MyThemes = $MyCompanyData['tm_backend'];
            $this->template->load($MyThemes, 'backend/customer/add_customer', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $coverage_id = $this->input->post('coverage', true);
            $coverage  = $this->db->get_where('coverage', array('coverage_id' => $coverage_id))->row_array();
            $complete  = $coverage['complete'];
            $cekCs = $this->db->get_where('user', ['email' => $post['email']])->num_rows();
            if ($cekCs > 0) {
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('error', 'Email Tersebut Telah Terdaftar');
                }
                redirect('member/registrasi');
            } else {
                $this_iditem1 = $post['paket'];
                $datapaket1 = $this->db->get_where('package_item', array('p_item_id' => $this_iditem1))->row_array();
                $paket_pppoe = $datapaket1['paket_wifi'];

                $datapackage  = $this->db->get_where('package_item', array('p_item_id' => $this_iditem1))->row_array();
                $category_id  = $datapackage['category_id'];
                $datacategory = $this->db->get_where('package_category', array('p_category_id' => $category_id))->row_array();
                $kategorinya  = $datacategory['name'];
                $coverage_id = $this->input->post('coverage', true);
                $coverage  = $this->db->get_where('coverage', array('coverage_id' => $coverage_id))->row_array();
                $other  = $this->db->get_where('other', array('id' => 1))->row_array();
                $complete  = $coverage['complete'];
                $email = $this->input->post('email', true);
                $pass_text = $this->input->post('password2', true);
                $name = $this->input->post('name', true);
                $gender = $this->input->post('gender', true);
                $saldo = $other['bonus_saldo'];
                $refferal = $this->input->post('refferal', true);
                $no_services = $this->input->post('no_services', true);
                $phone = $this->input->post('no_wa', true);
                $image = 'logo.png';
                $role_id = 2;
                $is_active = 1;
                $date_created = time();
                $datauser = [
                    'email' => htmlspecialchars($email),
                    'password' => '$2y$10$vUwQxmIUlYwZpHESSLjK6./BwSxtoRPDrjq4T7dRrnGK3B9dK.O6y',
                    'pass_text' => htmlspecialchars($pass_text),
                    'name' => htmlspecialchars($name),
                    'gender' => htmlspecialchars($gender),
                    'saldo' => htmlspecialchars($saldo),
                    'refferal' => htmlspecialchars($refferal),
                    'no_services' => htmlspecialchars($no_services),
                    'phone' => htmlspecialchars($phone),
                    'address' => htmlspecialchars($complete),
                    'image' => htmlspecialchars($image),
                    'role_id' => htmlspecialchars($role_id),
                    'is_active' => htmlspecialchars($is_active),
                    'date_created' => htmlspecialchars($date_created),
                ];
                $this->db->insert('user', $datauser);

                $this_iditem1 = $post['paket'];
                $datapaket1 = $this->db->get_where('package_item', array('p_item_id' => $this_iditem1))->row_array();
                $paket_pppoe = $datapaket1['paket_wifi'];

                $this->customer_m->add($post);

                $tgl_sekarang = date('d/m/Y H:i:s') . ' WIB';
                $data_log = [
                    'no_services' => $no_services,
                    'nama_paket'  => $datapaket1['name'],
                    'cat_paket'   => $kategorinya,
                    'ditambah_oleh'   => $data_user['name'],
                    'time_paket' => $tgl_sekarang,
                ];
                $this->db->insert('package_log', $data_log);

                $item = $this->db->get_where('package_item', ['p_item_id' => $post['paket']])->row_array();
                $datapaket = [
                    'item_id' => $item['p_item_id'],
                    'category_id' => $item['category_id'],
                    'no_services' => $no_services,
                    'qty' => 1,
                    'disc' => 0,
                    'price' => $item['price'],
                    'total' => $item['price'],
                    'services_create' => time(),
                ];
                $this->db->insert('services', $datapaket);

                if ($post['due_date'] <= 4) {
                    $tanggal_reminder = $post['due_date'];
                } else {
                    $tanggal_reminder = $post['due_date'] - 3;
                }
                if ($tanggal_reminder <= 9) {
                    $reminder = '0' . $tanggal_reminder;
                } else {
                    $reminder = $tanggal_reminder;
                }

                $datacampaign = [
                    'nama_pelanggan' => $name,
                    'nomor_services' => $no_services,
                    'nomor_whatsapp' => $phone,
                    'kategori_kontak' => 'PELANGGAN',
                    'tanggal_reminder' => $reminder,
                    'update_campaign' => $tgl_sekarang,
                ];
                $this->db->insert('campaign', $datacampaign);

                $whatsapp       = $this->db->get('whatsapp')->row_array();
                $nomor_pengirim = $whatsapp['number'];
                $nomor_penerima = $whatsapp['admin'];
                $api_key_wa     = $whatsapp['api_key'];
                $link_url_wa    = $whatsapp['link_url'];
                $link_url_web   = $whatsapp['url_web'];

                $pesan_whatsapp = '*KONFIRMASI PENDAFTARAN MEMBER*
a/n : ' . $name . '
Nomor Layanan : ' . $no_services . '
Oleh Refferal : ' . $refferal . '
Pada : ' . $tgl_sekarang;

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

                $this->session->set_flashdata('success', 'Data Member berhasil disimpan, silahkan hubungi Admin agar di konfirmasi');
                redirect('member/refferal');
            }
        }
    }
    public function status()
    {
        $data['title'] = 'Detail Paket Saya';
        $data['notifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->result();
        $data['mynotifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->num_rows();
        $data['message'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->result();
        $data['mymessage'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->num_rows();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['payment'] = $this->db->get('paymentsaldo')->row_array();
        $dataUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $no_services = $dataUser['no_services'];
        if ($no_services != '') {
            $data['CountServices'] = $this->services_m->getServices($no_services)->num_rows();
            $data['no_services'] = $no_services;
            $data['customer'] = $this->customer_m->getNSCustomer($no_services)->row();
            $bill = $this->bill_m->getBillThisMonth($no_services)->row();
            if ($bill != '') {
                $data['totalBill'] = $this->bill_m->getBillThisMonth($no_services)->num_rows();
                $data['CountBill'] = $this->bill_m->getBillDetail($bill->invoice)->result();
                $data['bank'] = $this->setting_m->getBank()->result();
                $data['invoice'] = $this->bill_m->getBillThisMonth($no_services)->row();
                $data['services'] = $this->services_m->getServices($no_services)->result();
            } else {
                $data['totalBill'] = 0;
                $data['CountBill'] = 0;
            }
            $data['product'] = $this->product_m->get()->result();
            $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_member'];
        $this->template->load($MyThemes, 'member/status', $data);
        } else {
            $this->session->set_flashdata('error', 'Email anda belum memiliki layanan yang aktif, silahkan hubungi kami untuk menjadi pelanggan kami');
            redirect('member/about');
        }
    }
    public function koneksi()
    {
        $mycustomer = $this->db->get_where('customer', ['email' => $this->session->userdata('email')])->row_array();
        $name = $mycustomer['username'];

        $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
        $host = $myrouter['host_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $port = $myrouter['port_router'];

        $API = new routeros();
        $API->connect($host, $port, $user, $pass);

        $pppuser = $API->comm("/ppp/secret/print", array(
            '?name' => $name,
        ));
        $pppuser = json_encode($pppuser);
        $pppuser = json_decode($pppuser, true);

        $pppactive = $API->comm("/ppp/active/print", array(
            '?name' => $name,
        ));
        $pppactive = json_encode($pppactive);
        $pppactive = json_decode($pppactive, true);

        $dataku = [
            'totalpppuser' => count($pppuser),
            'totalpppactive' => count($pppactive),
            'pppuser' => $pppuser,
            'pppactive' => $pppactive,
        ];

        foreach ($pppuser as $dataprofile) {
            $name_profile = $dataprofile['profile'];
            $pppprofile = $API->comm("/ppp/profile/print", array(
                '?name' => $name_profile,
            ));
            $pppprofile = json_encode($pppprofile);
            $pppprofile = json_decode($pppprofile, true);
            $datagua = [
                'pppprofile' => $pppprofile,
            ];
        }

        $data['title'] = 'Kelola Koneksi';
        $data['notifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->result();
        $data['mynotifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->num_rows();
        $data['message'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->result();
        $data['mymessage'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->num_rows();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $dataUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $no_services = $dataUser['no_services'];
        if ($no_services != '') {
            $data['no_services'] = $no_services;
            $data['invoice'] = $this->bill_m->getBillThisMonth($no_services)->row();
            $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_member'];
        $this->template->load($MyThemes, 'member/koneksi', $data + $dataku + $datagua);
            $API->disconnect();
        } else {
            $this->session->set_flashdata('error  ', 'Email anda belum memiliki layanan yang aktif, silahkan hubungi kami untuk menjadi pelanggan kami');
            redirect('member/about');
            $API->disconnect();
        }
    }
    public function belivoucher()
    {
        $mycustomer = $this->db->get_where('customer', ['email' => $this->session->userdata('email')])->row_array();

        $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
        $host = $myrouter['host_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $port = $myrouter['port_router'];

        $API = new routeros();
        $API->connect($host, $port, $user, $pass);

        $hotspotuser = $API->comm("/ip/hotspot/user/print");
        $hotspotuser = json_encode($hotspotuser);
        $hotspotuser = json_decode($hotspotuser, true);
        $hotspotserver = $API->comm("/ip/hotspot/print");
        $hotspotserver = json_encode($hotspotserver);
        $hotspotserver = json_decode($hotspotserver, true);
        $hotspotprofile = $API->comm("/ip/hotspot/user/profile/print");
        $hotspotprofile = json_encode($hotspotprofile);
        $hotspotprofile = json_decode($hotspotprofile, true);

        $dataku = [
            'totalhotspotprofile' => count($hotspotprofile),
            'hotspotprofile' => $hotspotprofile,
            'hotspotserver' => $hotspotserver,
        ];

        $data['title'] = 'Beli Voucher';
        $data['notifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->result();
        $data['package'] = $this->db->get_where('package_item', ['category_id' => 2])->result();
        $data['mynotifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->num_rows();
        $data['message'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->result();
        $data['mymessage'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->num_rows();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $dataUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $no_services = $dataUser['no_services'];
        if ($no_services != '') {
            $data['no_services'] = $no_services;
            $data['invoice'] = $this->bill_m->getBillThisMonth($no_services)->row();
            $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_member'];
        $this->template->load($MyThemes, 'member/voucher', $data + $dataku);
            $API->disconnect();
        } else {
            $this->session->set_flashdata('error  ', 'Email anda belum memiliki layanan yang aktif, silahkan hubungi kami untuk menjadi pelanggan kami');
            redirect('member/about');
            $API->disconnect();
        }
    }
    public function tambahvoucher()
    {
        $data['title'] = 'Tambah Voucher';
        $datauser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $server_hotspot = $this->input->post('server_hotspot');
        $paket_id  = $this->input->post('paket_voucher');
        $user_voucher = $this->input->post('user_voucher');
        $pass_voucher = $this->input->post('pass_voucher');
        $create_voucher = $this->input->post('create_voucher');
        $no_serviceku = $this->input->post('no_services');
        $no_whatsapp = $this->input->post('whatsapp');

        $package_item = $this->db->get_where('package_item', array('p_item_id' => $paket_id))->row_array();
        $paket_hotspot = $package_item['name'];
        $paket_voucher = $package_item['paket_wifi'];
        if ($this->session->userdata('role_id') == 4) {
            $harga_voucher = $package_item['reseller'];
        } else {
            $harga_voucher = $package_item['price'];
        }

        $whatsapp = $this->db->get('whatsapp')->row_array();
        $link = $whatsapp['url_web'];
        $create_hotspotku = urlencode($create_voucher);
        $paket_hotspotku = urlencode($paket_hotspot);
        $user_hotspotku = urlencode($user_voucher);
        $pass_hotspotku = urlencode($pass_voucher);
        $server_hotspotku = urlencode($server_hotspot);

        $whatsapp = $this->db->get('whatsapp')->row_array();
        $number   = $whatsapp['number'];
        $admin    = $whatsapp['admin'];
        $api_key  = $whatsapp['api_key'];
        $link_url = $whatsapp['link_url'];
        $nomor    = $no_whatsapp;
        $pesan = '*VOUCHER TELAH DIBUAT*
Server : ' . $server_hotspotku . '
Paket : ' . $paket_hotspot . '
Username : ' . $user_voucher . '
Username : ' . $pass_voucher . '
Harga : Rp. ' . indo_currency($harga_voucher) . '
' . $create_voucher . '
*TERIMAKASIH*';

        $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
        $host = $myrouter['host_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $port = $myrouter['port_router'];

        $API = new routeros();
        $API->connect($host, $port, $user, $pass);

        $hotspotuser = $API->comm("/ip/hotspot/user/print", array(
            '?name' => $user_voucher,
        ));
        $hotspotuser = json_encode($hotspotuser);
        $hotspotuser = json_decode($hotspotuser, true);
        $cek = count($hotspotuser);
        if ($cek > 0) {
            $this->session->set_flashdata('error', 'Akun Voucher Tersebut SUDAH ADA !');
            redirect('member/belivoucher');
        } else {
            if ($harga_voucher <= $datauser['saldo']) {
                $API->comm("/ip/hotspot/user/add", array(
                    "name" => $user_voucher,
                    "password" => $pass_voucher,
                    "profile" => $paket_voucher,
                    "server" => $server_hotspot,
                ));

                $datapesan1 = [
                    'api_key' => $api_key,
                    'sender' => $number,
                    'number' => $nomor,
                    'message' => $pesan
                ];
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => $link_url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => json_encode($datapesan1),
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                ));

                $response = curl_exec($curl);
                curl_close($curl);

                $datapesan2 = [
                    'api_key' => $api_key,
                    'sender' => $number,
                    'number' => $admin,
                    'message' => $pesan
                ];
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => $link_url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => json_encode($datapesan2),
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                ));

                $response = curl_exec($curl);
                curl_close($curl);

                $array = [
                    'server_hotspot' => $server_hotspot,
                    'paket_voucher' => $paket_hotspot,
                    'user_voucher' => $user_voucher,
                    'pass_voucher' => $pass_voucher,
                    'harga_voucher' => $harga_voucher,
                    'no_services' => $no_serviceku,
                    'create_voucher' => $create_voucher,
                ];
                $this->db->insert('hotspot', $array);
                $this->session->set_flashdata('success', ' Voucher "' . $user_voucher . '" berhasil Ditambah');
                redirect('member/belivoucher');
            } else {
                $this->session->set_flashdata('error', 'Saldo Anda Tidak Mencukupi !');
                redirect('member/belivoucher');
            }
        }
    }
    public function terimabonus()
    {
        $data['title'] = 'Terima Bonus';
        $data['notifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->result();
        $data['mynotifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->num_rows();
        $data['message'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->result();
        $data['mymessage'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->num_rows();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $myuser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $nomor_services = $myuser['no_services'];
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['payment'] = $this->db->get('paymentsaldo')->row_array();
        $dataUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $no_services = $dataUser['no_services'];
        $data['bonus'] = $this->db->get_where('bonus', array('no_services' => $nomor_services))->result();
        if ($no_services != '') {
            $data['CountServices'] = $this->services_m->getServices($no_services)->num_rows();
            $data['no_services'] = $no_services;
            $data['customer'] = $this->customer_m->getNSCustomer($no_services)->row();
            $bill = $this->bill_m->getBillThisMonth($no_services)->row();
            if ($bill != '') {
                $data['totalBill'] = $this->bill_m->getBillThisMonth($no_services)->num_rows();
                $data['CountBill'] = $this->bill_m->getBillDetail($bill->invoice)->result();
                $data['bank'] = $this->setting_m->getBank()->result();
                $data['invoice'] = $this->bill_m->getBillThisMonth($no_services)->row();
            } else {
                $data['totalBill'] = 0;
                $data['CountBill'] = 0;
            }
            $data['product'] = $this->product_m->get()->result();
            $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_member'];
        $this->template->load($MyThemes, 'member/terima-bonus', $data);
        } else {
            $this->session->set_flashdata('error', 'Email anda belum memiliki layanan yang aktif, silahkan hubungi kami untuk menjadi pelanggan kami');
            redirect('member/about');
        }
    }
    public function history()
    {
        $data['title'] = 'Riwayat Tagihan';
        $data['notifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->result();
        $data['mynotifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->num_rows();
        $data['message'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->result();
        $data['mymessage'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->num_rows();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $dataUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $no_services = $dataUser['no_services'];
        if ($no_services != '') {
            $data['CountServices'] = $this->services_m->getServices($no_services)->num_rows();
            $data['no_services'] = $no_services;
            $bill = $this->bill_m->getBillThisMonth($no_services)->row();
            if ($bill != '') {
                $data['totalBill'] = $this->bill_m->getBillThisMonth($no_services)->num_rows();
                $data['CountBill'] = $this->bill_m->getBillDetail($bill->invoice)->result();
                $data['bank'] = $this->setting_m->getBank()->result();
                $data['invoice'] = $this->bill_m->getBillThisMonth($no_services)->row();
                $data['services'] = $this->services_m->getServices($no_services)->result();
            } else {
                $data['totalBill'] = 0;
                $data['CountBill'] = 0;
            }
            $data['product'] = $this->product_m->get()->result();
            $data['myinvoice'] = $this->bill_m->getBillbyNS($no_services)->result();
            $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
            $data['bank'] = $this->setting_m->getBank()->result();
            $data['other'] = $this->db->get('other')->row_array();
            $data['services'] = $this->services_m->getServices($no_services)->result();
            $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_member'];
        $this->template->load($MyThemes, 'member/history', $data);
        } else {
            $this->session->set_flashdata('error', 'Email anda belum memiliki layanan yang aktif, silahkan hubungi kami untuk menjadi pelanggan kami');
            redirect('member/about');
        }

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
    }
    public function profile()
    {
        $data['title'] = 'Profile';
        $data['notifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->result();
        $data['mynotifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->num_rows();
        $data['message'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->result();
        $data['mymessage'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->num_rows();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $dataUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $no_services = $dataUser['no_services'];
        if ($no_services != '') {
            $data['no_services'] = $no_services;
            $data['invoice'] = $this->bill_m->getBillThisMonth($no_services)->row();
            $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_member'];
        $this->template->load($MyThemes, 'member/profile', $data);
        } else {
            $this->session->set_flashdata('error  ', 'Email anda belum memiliki layanan yang aktif, silahkan hubungi kami untuk menjadi pelanggan kami');
            redirect('member/about');
        }
    }
    public function registrasi()
    {
        $data['title'] = 'Registrasi Member';
        $data['notifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->result();
        $data['mynotifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->num_rows();
        $data['message'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->result();
        $data['mymessage'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->num_rows();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['coverage'] = $this->db->get('coverage')->result();
        $dataUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $no_services = $dataUser['no_services'];
        if ($no_services != '') {
            $data['no_services'] = $no_services;
            $data['invoice'] = $this->bill_m->getBillThisMonth($no_services)->row();
            $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_member'];
        $this->template->load($MyThemes, 'member/registrasi', $data);
        } else {
            $this->session->set_flashdata('error  ', 'Email anda belum memiliki layanan yang aktif, silahkan hubungi kami untuk menjadi pelanggan kami');
            redirect('member/about');
        }
    }
    public function refferal()
    {
        $data['title'] = 'Member Refferal';
        $data['notifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->result();
        $data['mynotifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->num_rows();
        $data['message'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->result();
        $data['mymessage'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->num_rows();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $myuser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $nomor_services = $myuser['no_services'];
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['refferal'] = $this->db->get_where('customer', ['refferal' => $nomor_services])->result();
        $dataUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $no_services = $dataUser['no_services'];
        if ($no_services != '') {
            $data['no_services'] = $no_services;
            $data['invoice'] = $this->bill_m->getBillThisMonth($no_services)->row();
            $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_member'];
        $this->template->load($MyThemes, 'member/refferal', $data);
        } else {
            $this->session->set_flashdata('error  ', 'Email anda belum memiliki layanan yang aktif, silahkan hubungi kami untuk menjadi pelanggan kami');
            redirect('member/about');
        }
    }
    public function notifikasi($id)
    {
        $data['title'] = 'Notifikasi';
        $data['notifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->result();
        $data['mynotifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->num_rows();
        $data['message'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->result();
        $data['mymessage'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->num_rows();
        $data['notif'] = $this->db->get_where('notifikasi', ['id_notifikasi' => $id])->row_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $dataUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $no_services = $dataUser['no_services'];
        if ($no_services != '') {
            $data['no_services'] = $no_services;
            $data['invoice'] = $this->bill_m->getBillThisMonth($no_services)->row();
            $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_member'];
        $this->template->load($MyThemes, 'member/notifikasi', $data);
        } else {
            $this->session->set_flashdata('error  ', 'Email anda belum memiliki layanan yang aktif, silahkan hubungi kami untuk menjadi pelanggan kami');
            redirect('member/about');
        }
    }
    public function message($id)
    {
        $this->db->set('status_message', 'sudah dibaca');
        $this->db->where('message_id', $id);
        $this->db->update('message');
        $data['title'] = 'Baca Pesan Masuk';
        $data['notifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->result();
        $data['mynotifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->num_rows();
        $data['message'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->result();
        $data['mymessage'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->num_rows();
        $data['message'] = $this->db->get_where('message', ['message_id' => $id])->row_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $dataUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $no_services = $dataUser['no_services'];
        if ($no_services != '') {
            $data['no_services'] = $no_services;
            $data['invoice'] = $this->bill_m->getBillThisMonth($no_services)->row();
            $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_member'];
        $this->template->load($MyThemes, 'member/message', $data);
        } else {
            $this->session->set_flashdata('error  ', 'Email anda belum memiliki layanan yang aktif, silahkan hubungi kami untuk menjadi pelanggan kami');
            redirect('member/about');
        }
    }
    public function account()
    {
        $data['title'] = 'Account';
        $data['notifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->result();
        $data['mynotifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->num_rows();
        $data['message'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->result();
        $data['mymessage'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->num_rows();
        $config['upload_path'] = './assets/images/profile/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']     = '2048';
        $config['file_name']  = 'profile-' . $this->input->post('name') . '-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $dataUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $no_services = $dataUser['no_services'];
        if ($no_services != '') {
            $data['no_services'] = $no_services;
            $data['invoice'] = $this->bill_m->getBillThisMonth($no_services)->row();
        } else {
            $this->session->set_flashdata('error  ', 'Email anda belum memiliki layanan yang aktif, silahkan hubungi kami untuk menjadi pelanggan kami');
            redirect('member/about');
        }

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $dataUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $no_services = $dataUser['no_services'];
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('phone', 'Phone', 'required|trim|min_length[8]');
        $this->form_validation->set_rules('gender', 'Gender', 'required|trim');
        if ($this->form_validation->run() == false) {
            $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_member'];
        $this->template->load($MyThemes, 'member/account', $data);
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');
            $pin_trx = $this->input->post('pin_trx');
            $pin_trx1 = $this->input->post('pin_trx1');
            $pin_trx2 = $this->input->post('pin_trx2');
            $gender = $this->input->post('gender');
            $address = $this->input->post('address');
            $image1 = $this->input->post('image1');

            // cek jika ada gambar
            $upload_image = @FILES['image']['name'];

            if ($upload_image) {
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . '/assets/images/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
                    redirect('member/account');
                }
            }
            if ($pin_trx != null) {
                $cekCs = $this->db->get_where('user', ['pin_trx' => $pin_trx, 'email' => $this->session->userdata('email')])->num_rows();
                if ($cekCs > 0) {
                    if ($pin_trx1 == $pin_trx2) {
                        $this->db->set('pin_trx', $pin_trx1);
                    } else {
                        $this->session->set_flashdata('error', 'PIN Transaksi Baru Tidak Sama !!!');
                        redirect('member/account');
                    }
                } else {
                    $this->session->set_flashdata('error', 'PIN Transaksi Saat Ini Salah !!!');
                    redirect('member/account');
                }
            }
            if ($new_image != null) {
                $this->db->set('image', $new_image);
            } else {
                $this->db->set('image', $image1);
            }
            $this->db->set('name', $name);
            $this->db->set('email', $email);
            $this->db->set('phone', $phone);
            $this->db->set('gender', $gender);
            $this->db->set('address', $address);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('success', 'Profil Akun Kamu Berhasil Diperbarui');
            redirect('member/account');
        }
    }
    public function changepassword()
    {
        $data['title'] = 'Ganti Password';
        $data['notifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->result();
        $data['mynotifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->num_rows();
        $data['message'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->result();
        $data['mymessage'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->num_rows();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[5]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm Password', 'required|trim|min_length[5]|matches[new_password1]');
        $dataUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $no_services = $dataUser['no_services'];
        if ($no_services != '') {
            $data['no_services'] = $no_services;
            $data['invoice'] = $this->bill_m->getBillThisMonth($no_services)->row();
        } else {
            $this->session->set_flashdata('error  ', 'Email anda belum memiliki layanan yang aktif, silahkan hubungi kami untuk menjadi pelanggan kami');
            redirect('member/about');
        }
        if ($this->form_validation->run() == false) {
            $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
            $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_member'];
        $this->template->load($MyThemes, 'member/changepassword', $data);
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('error', 'Password lama salah !');
                redirect('member/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('error', 'Password baru tidak boleh sama dengan password lama!');
                    redirect('member/changepassword');
                } else {
                    // password benar
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->set('pass_text', $this->input->post('new_password1'));
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');
                    $this->session->set_flashdata('success', 'Password baru sudah diperbaharui!');
                    redirect('member/changepassword');
                }
            }
        }
    }

    public function about()
    {
        $data['title'] = 'Tentang';
        $data['notifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->result();
        $data['mynotifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->num_rows();
        $data['message'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->result();
        $data['mymessage'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->num_rows();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $dataUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $no_services = $dataUser['no_services'];
        if ($no_services != '') {
            $data['no_services'] = $no_services;
            $data['invoice'] = $this->bill_m->getBillThisMonth($no_services)->row();
        } else {
            $this->session->set_flashdata('error  ', 'Email anda belum memiliki layanan yang aktif, silahkan hubungi kami untuk menjadi pelanggan kami');
            redirect('member/about');
        }
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_member'];
        $this->template->load($MyThemes, 'member/about', $data);
    }
    public function testimoni()
    {
        $data['title'] = 'Testimoni';
        $data['notifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->result();
        $data['mynotifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->num_rows();
        $data['message'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->result();
        $data['mymessage'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->num_rows();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $dataUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $no_services = $dataUser['no_services'];
        if ($no_services != '') {
            $data['no_services'] = $no_services;
            $data['invoice'] = $this->bill_m->getBillThisMonth($no_services)->row();
        } else {
            $this->session->set_flashdata('error  ', 'Email anda belum memiliki layanan yang aktif, silahkan hubungi kami untuk menjadi pelanggan kami');
            redirect('member/about');
        }
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_member'];
        $this->template->load($MyThemes, 'member/testimoni', $data);
    }


    public function addTestimoni()
    {
        $post = $this->input->post(null, TRUE);
        $this->member_m->addTestimoni($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Terimakasih atas testimoni yang anda berikan kepada kami');
        }
        echo "<script>window.location='" . site_url('member/testimoni') . "'; </script>";
    }

    public function editTestimoni()
    {
        $post = $this->input->post(null, TRUE);
        $this->member_m->editTestimoni($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Terimakasih atas testimoni yang anda berikan kepada kami');
        }
        echo "<script>window.location='" . site_url('member/testimoni') . "'; </script>";
    }

    public function invoice($invoice)
    {
        $data['title'] = 'Invoice';
        $data['notifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->result();
        $data['mynotifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->num_rows();
        $data['message'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->result();
        $data['mymessage'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->num_rows();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $dataUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $no_services = $dataUser['no_services'];
        if ($no_services != '') {
            $data['no_services'] = $no_services;
            $data['invoice'] = $this->bill_m->getBillThisMonth($no_services)->row();
        } else {
            $this->session->set_flashdata('error  ', 'Email anda belum memiliki layanan yang aktif, silahkan hubungi kami untuk menjadi pelanggan kami');
            redirect('member/about');
        }
        $data['invoice'] = $this->bill_m->getBill($invoice);
        $data['invoice_detail'] = $this->bill_m->getDetailBill($invoice);
        $data['bill'] = $this->bill_m->getBill($invoice)->row_array();
        $data['other'] = $this->db->get('other')->row_array();
        $data['bank'] = $this->setting_m->getBank()->result();
        $data['p_item'] = $this->package_m->getPItem()->result();
        $this->load->library('ciqrcode'); //pemanggilan library QR CODE
        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/images/qrcode/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
        $inv = $this->db->get_where('invoice', ['invoice' => $invoice])->row_array();
        $this->ciqrcode->initialize($config);
        $image_name = $invoice . '.png'; //buat name dari qr code
        $params['data'] = site_url() . 'bill/printinvoice/' . $invoice; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
        $this->load->view('backend/bill/invoice', $data);
    }

    public function confirmotomatis($invoice)
    {
        $data['title'] = 'Konfirmasi Otomatis';
        $data['notifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->result();
        $data['mynotifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->num_rows();
        $data['message'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->result();
        $data['mymessage'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->num_rows();
        $cekinvoice = $this->db->get_where('invoice', ['invoice' => $invoice])->row_array();
        if ($cekinvoice <= 0) {
            $this->session->set_flashdata('error', 'Invoice tidak ditemukan');
            echo "<script>window.location='" . site_url('member/history') . "'; </script>";
        }
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['myinvoice'] = $this->bill_m->getEditInvoice($invoice);
        $data['bill'] = $this->member_m->getInvoice($invoice)->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['channel'] = $this->setting_m->getChannelAktif()->result();
        $data['other'] = $this->db->get('other')->row_array();
        $data['category'] = $this->db->get('kategori')->result();
        $data['bank'] = $this->setting_m->getBank()->result();
        $dataUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $no_services = $dataUser['no_services'];
        if ($no_services != '') {
            $data['CountServices'] = $this->services_m->getServices($no_services)->num_rows();
            $data['no_services'] = $no_services;
            $bill = $this->bill_m->getBillThisMonth($no_services)->row();
            if ($bill != '') {
                $data['totalBill'] = $this->bill_m->getBillThisMonth($no_services)->num_rows();
                $data['CountBill'] = $this->bill_m->getBillDetail($bill->invoice)->result();
                $data['bank'] = $this->setting_m->getBank()->result();
                $data['invoice'] = $this->bill_m->getBillThisMonth($no_services)->row();
                $data['services'] = $this->services_m->getServices($no_services)->result();
            } else {
                $data['totalBill'] = 0;
                $data['CountBill'] = 0;
            }
            $data['product'] = $this->product_m->get()->result();
            $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_member'];
        $this->template->load($MyThemes, 'member/confirm-otomatis', $data);
        } else {
            $this->session->set_flashdata('error', 'Email anda belum memiliki layanan yang aktif, silahkan hubungi kami untuk menjadi pelanggan kami');
            redirect('member/about');
        }
    }

    public function bayartagihan($invoice)
    {
        $data['title'] = 'Konfirmasi Otomatis';
        $data['notifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->result();
        $data['mynotifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->num_rows();
        $data['message'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->result();
        $data['mymessage'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->num_rows();
        $cekinvoice = $this->db->get_where('invoice', ['invoice' => $invoice])->row_array();
        if ($cekinvoice <= 0) {
            $this->session->set_flashdata('error', 'Invoice tidak ditemukan');
            echo "<script>window.location='" . site_url('member/history') . "'; </script>";
        }
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['myinvoice'] = $this->bill_m->getEditInvoice($invoice);
        $data['bill'] = $this->member_m->getInvoice($invoice)->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['channel'] = $this->setting_m->getChannelAktif()->result();
        $data['category'] = $this->db->get('kategori')->result();
        $data['other'] = $this->db->get('other')->row_array();
        $dataUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $no_services = $dataUser['no_services'];
        if ($no_services != '') {
            $data['CountServices'] = $this->services_m->getServices($no_services)->num_rows();
            $data['no_services'] = $no_services;
            $bill = $this->bill_m->getBillThisMonth($no_services)->row();
            if ($bill != '') {
                $data['totalBill'] = $this->bill_m->getBillThisMonth($no_services)->num_rows();
                $data['CountBill'] = $this->bill_m->getBillDetail($bill->invoice)->result();
                $data['bank'] = $this->setting_m->getBank()->result();
                $data['invoice'] = $this->bill_m->getBillThisMonth($no_services)->row();
                $data['services'] = $this->services_m->getServices($no_services)->result();
            } else {
                $data['totalBill'] = 0;
                $data['CountBill'] = 0;
            }
            $data['product'] = $this->product_m->get()->result();
            $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_member'];
        $this->template->load($MyThemes, 'member/bayar-tagihan', $data);
        } else {
            $this->session->set_flashdata('error', 'Email anda belum memiliki layanan yang aktif, silahkan hubungi kami untuk menjadi pelanggan kami');
            redirect('member/about');
        }
    }

    public function confirmmanual($invoice)
    {
        $data['title'] = 'Konfirmasi Manual';
        $data['notifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->result();
        $data['mynotifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->num_rows();
        $data['message'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->result();
        $data['mymessage'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->num_rows();
        $cekinvoice = $this->db->get_where('invoice', ['invoice' => $invoice])->row_array();
        if ($cekinvoice <= 0) {
            $this->session->set_flashdata('error', 'Invoice tidak ditemukan');
            echo "<script>window.location='" . site_url('member/history') . "'; </script>";
        }
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['myinvoice'] = $this->bill_m->getEditInvoice($invoice);
        $data['bill'] = $this->member_m->getInvoice($invoice)->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['channel'] = $this->setting_m->getChannelAktif()->result();
        $data['other'] = $this->db->get('other')->row_array();
        $data['category'] = $this->db->get('kategori')->result();
        $data['bank'] = $this->setting_m->getBank()->result();
        $dataUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $no_services = $dataUser['no_services'];
        if ($no_services != '') {
            $data['CountServices'] = $this->services_m->getServices($no_services)->num_rows();
            $data['no_services'] = $no_services;
            $bill = $this->bill_m->getBillThisMonth($no_services)->row();
            if ($bill != '') {
                $data['totalBill'] = $this->bill_m->getBillThisMonth($no_services)->num_rows();
                $data['CountBill'] = $this->bill_m->getBillDetail($bill->invoice)->result();
                $data['bank'] = $this->setting_m->getBank()->result();
                $data['invoice'] = $this->bill_m->getBillThisMonth($no_services)->row();
                $data['services'] = $this->services_m->getServices($no_services)->result();
            } else {
                $data['totalBill'] = 0;
                $data['CountBill'] = 0;
            }
            $data['product'] = $this->product_m->get()->result();
            $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_member'];
        $this->template->load($MyThemes, 'member/confirm-manual', $data);
        } else {
            $this->session->set_flashdata('error', 'Email anda belum memiliki layanan yang aktif, silahkan hubungi kami untuk menjadi pelanggan kami');
            redirect('member/about');
        }
    }

    public function topupsaldo()
    {
        $data['title'] = 'Top Up Saldo';
        $data['notifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->result();
        $data['mynotifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->num_rows();
        $data['message'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->result();
        $data['mymessage'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->num_rows();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['channel'] = $this->setting_m->getChannelAktif()->result();
        $data['category'] = $this->db->get('kategori')->result();
        $data['payment'] = $this->db->get('paymentsaldo')->row_array();
        $data['bank'] = $this->setting_m->getBank()->result();
        $dataUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $no_services = $dataUser['no_services'];
        if ($no_services != '') {
            $data['CountServices'] = $this->services_m->getServices($no_services)->num_rows();
            $data['no_services'] = $no_services;
            $bill = $this->bill_m->getBillThisMonth($no_services)->row();
            if ($bill != '') {
                $data['totalBill'] = $this->bill_m->getBillThisMonth($no_services)->num_rows();
                $data['CountBill'] = $this->bill_m->getBillDetail($bill->invoice)->result();
                $data['bank'] = $this->setting_m->getBank()->result();
                $data['invoice'] = $this->bill_m->getBillThisMonth($no_services)->row();
                $data['services'] = $this->services_m->getServices($no_services)->result();
            } else {
                $data['totalBill'] = 0;
                $data['CountBill'] = 0;
            }
            $data['product'] = $this->product_m->get()->result();
            $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_member'];
        $this->template->load($MyThemes, 'member/topup-saldo', $data);
        } else {
            $this->session->set_flashdata('error', 'Email anda belum memiliki layanan yang aktif, silahkan hubungi kami untuk menjadi pelanggan kami');
            redirect('member/about');
        }
    }

    public function pengeluaran()
    {
        $data['title'] = 'Daftar Pengeluaran';
        $data['notifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->result();
        $data['mynotifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->num_rows();
        $data['message'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->result();
        $data['mymessage'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->num_rows();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $myuser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $no_services = $myuser['no_services'];
        $data['pengeluaran'] = $this->expenditure_m->getpengeluaran($no_services)->result();
        $dataUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $no_services = $dataUser['no_services'];
        if ($no_services != '') {
            $data['no_services'] = $no_services;
            $data['invoice'] = $this->bill_m->getBillThisMonth($no_services)->row();
            $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_member'];
        $this->template->load($MyThemes, 'member/list-pengeluaran', $data);
        } else {
            $this->session->set_flashdata('error  ', 'Email anda belum memiliki layanan yang aktif, silahkan hubungi kami untuk menjadi pelanggan kami');
            redirect('member/about');
        }
    }

    public function loglayanan()
    {
        $data['title'] = 'Riwayat Layanan';
        $data['notifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->result();
        $data['mynotifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->num_rows();
        $data['message'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->result();
        $data['mymessage'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->num_rows();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $myuser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $no_services = $myuser['no_services'];
        $data['paket'] = $this->db->get_where('package_log', ['no_services' => $no_services])->result();
        $dataUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $no_services = $dataUser['no_services'];
        if ($no_services != '') {
            $data['no_services'] = $no_services;
            $data['invoice'] = $this->bill_m->getBillThisMonth($no_services)->row();
            $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_member'];
        $this->template->load($MyThemes, 'member/log-paket', $data);
        } else {
            $this->session->set_flashdata('error  ', 'Email anda belum memiliki layanan yang aktif, silahkan hubungi kami untuk menjadi pelanggan kami');
            redirect('member/about');
        }
    }
    public function pengaduan()
    {
        $data['title'] = 'Lapor / Pengaduan';
        $data['notifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->result();
        $data['mynotifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->num_rows();
        $data['message'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->result();
        $data['mymessage'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->num_rows();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $dataUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $no_services = $dataUser['no_services'];
        if ($no_services != '') {
            $data['no_services'] = $no_services;
            $data['customer'] = $this->customer_m->getNSCustomer($no_services)->row_array();
            $data['services'] = $this->services_m->getServices($no_services)->result();
            $data['invoice'] = $this->bill_m->getBillThisMonth($no_services)->row();
            $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_member'];
        $this->template->load($MyThemes, 'member/pengaduan', $data);
        } else {
            $this->session->set_flashdata('error  ', 'Email anda belum memiliki layanan yang aktif, silahkan hubungi kami untuk menjadi pelanggan kami');
            redirect('member/about');
        }
    }
    public function kasbon()
    {
        $data['title'] = 'Pengajuan Kasbon';
        $data['notifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->result();
        $data['mynotifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->num_rows();
        $data['message'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->result();
        $data['mymessage'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->num_rows();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $dataUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $no_services = $dataUser['no_services'];
        if ($no_services != '') {
            $data['no_services'] = $no_services;
            $data['customer'] = $this->customer_m->getNSCustomer($no_services)->row_array();
            $data['services'] = $this->services_m->getServices($no_services)->result();
            $data['invoice'] = $this->bill_m->getBillThisMonth($no_services)->row();
            $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_member'];
        $this->template->load($MyThemes, 'member/kasbon', $data);
        } else {
            $this->session->set_flashdata('error  ', 'Email anda belum memiliki layanan yang aktif, silahkan hubungi kami untuk menjadi pelanggan kami');
            redirect('member/about');
        }
    }
    public function pesanmasuk()
    {
        $data['title'] = 'Pesan Masuk';
        $data['notifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->result();
        $data['mynotifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->num_rows();
        $data['message'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->result();
        $data['mymessage'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->num_rows();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $dataUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $no_services = $dataUser['no_services'];
        if ($no_services != '') {
            $data['no_services'] = $no_services;
            $data['customer'] = $this->customer_m->getNSCustomer($no_services)->row_array();
            $data['services'] = $this->services_m->getServices($no_services)->result();
            $data['invoice'] = $this->bill_m->getBillThisMonth($no_services)->row();
            $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_member'];
        $this->template->load($MyThemes, 'member/inbox', $data);
        } else {
            $this->session->set_flashdata('error  ', 'Email anda belum memiliki layanan yang aktif, silahkan hubungi kami untuk menjadi pelanggan kami');
            redirect('member/about');
        }
    }
    public function pesankeluar()
    {
        $data['title'] = 'Pesan Terkirim';
        $data['notifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->result();
        $data['mynotifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->num_rows();
        $data['message'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->result();
        $data['mymessage'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->num_rows();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $dataUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $no_services = $dataUser['no_services'];
        if ($no_services != '') {
            $data['no_services'] = $no_services;
            $data['customer'] = $this->customer_m->getNSCustomer($no_services)->row_array();
            $data['services'] = $this->services_m->getServices($no_services)->result();
            $data['invoice'] = $this->bill_m->getBillThisMonth($no_services)->row();
            $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_member'];
        $this->template->load($MyThemes, 'member/outbox', $data);
        } else {
            $this->session->set_flashdata('error  ', 'Email anda belum memiliki layanan yang aktif, silahkan hubungi kami untuk menjadi pelanggan kami');
            redirect('member/about');
        }
    }
    public function ajukankasbon()
    {
        $ket_kasbon = $this->input->post('ket_kasbon');
        if ($ket_kasbon == '') {
            $this->session->set_flashdata('error', 'Permintaan Kasbon Gagal Diajukan');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $nama_karyawan   = $this->input->post('nama_karyawan');
            $nominal_kasbon  = $this->input->post('nominal_kasbon');
            $nomor_services  = $this->input->post('nomor_services');
            $waktu_kasbon    = $this->input->post('waktu_kasbon');
            $status_kasbon   = $this->input->post('status_kasbon');

            $array = [
                'nama_karyawan' => $nama_karyawan,
                'nominal_kasbon' => $nominal_kasbon,
                'ket_kasbon' => $ket_kasbon,
                'nomor_services' => $nomor_services,
                'waktu_kasbon' => $waktu_kasbon,
                'status_kasbon' => $status_kasbon,
            ];
            $this->db->insert('kasbon', $array);

            $this->session->set_flashdata('success', 'Permintaan Kasbon Berhasil Diajukan');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function kirimpengaduan()
    {
        $konten_pesan = $this->input->post('konten_pesan');
        if ($konten_pesan == '') {
            $this->session->set_flashdata('error', 'Pesan Pengaduan gagal di Kirimkan');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $tiket_pesan    = $this->input->post('tiket_pesan');
            $user_pengirim  = $this->input->post('user_pengirim');
            $user_penerima  = $this->input->post('user_penerima');
            $judul_pesan    = $this->input->post('judul_pesan');
            $waktu_kirim    = $this->input->post('waktu_kirim');
            $status_message = $this->input->post('status_message');

            $array = [
                'tiket_pesan' => $tiket_pesan,
                'user_pengirim' => $user_pengirim,
                'user_penerima' => $user_penerima,
                'judul_pesan' => $judul_pesan,
                'konten_pesan' => $konten_pesan,
                'waktu_kirim' => $waktu_kirim,
                'status_message' => $status_message,
            ];
            $this->db->insert('message', $array);
        
            $queryCompany  = $this->db->get_where('company', ['status' => 'Aktif'])->row_array();
            $queryCampaign = $this->db->get_where('campaign', ['kategori_kontak' => 'GRUP WA'])->row_array();
            $queryCustomer = $this->db->get_where('customer', ['email' => $user_pengirim])->row_array();
            $queryUser1     = $this->db->get_where('user', ['email' => $user_pengirim])->row_array();
            $queryUser2     = $this->db->get_where('user', ['email' => $user_penerima])->row_array();
            
            $whatsapp = $this->db->get('whatsapp')->row_array();
            $number   = $whatsapp['number'];
            $api_key  = $whatsapp['api_key'];
            $link_url = $whatsapp['link_url'];
            $admin    = $whatsapp['admin'];
            $member   = $queryCustomer['no_wa'];
            $user     = $queryUser1['phone'];
            $group    = $queryCampaign['nomor_whatsapp'];
    
            $pesan = '*INFORMASI PESAN PENGADUAN*
*' . $queryCompany['company_name'] . '*

Nomor Tiket : ' . $tiket_pesan . '
Pengirim : ' . $no_services . '
('.$user_pengirim.')
Penerima : ' . $no_invoice . '
('.$user_penerima.')

Judul Pesan : 
' . $judul_pesan . '
Konten Pesan : 
' . $konten_pesan . '

Status Pesan : ' . $status_message .'
Waktu Kirim : ' . $waktu_kirim . '
*TERIMAKASIH*';

            $data1 = [
                'api_key' => $api_key,
                'sender' => $number,
                'number' => $admin,
                'message' => $pesan
            ];
            $curl1 = curl_init();
            curl_setopt_array($curl1, array(
                CURLOPT_URL => $link_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($data1),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            ));
            $response1 = curl_exec($curl1);
            curl_close($curl1);
    
            $data2 = [
                'api_key' => $api_key,
                'sender' => $number,
                'number' => $member,
                'message' => $pesan
            ];
            $curl2 = curl_init();
            curl_setopt_array($curl2, array(
                CURLOPT_URL => $link_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($data2),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            ));
            $response2 = curl_exec($curl2);
            curl_close($curl2);
    
            $data3 = [
                'api_key' => $api_key,
                'sender' => $number,
                'number' => $group,
                'message' => $pesan
            ];
            $curl3 = curl_init();
            curl_setopt_array($curl3, array(
                CURLOPT_URL => $link_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($data3),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            ));
            $response3 = curl_exec($curl3);
            curl_close($curl3);
    
            $data4 = [
                'api_key' => $api_key,
                'sender' => $number,
                'number' => $user,
                'message' => $pesan
            ];
            $curl4 = curl_init();
            curl_setopt_array($curl4, array(
                CURLOPT_URL => $link_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($data4),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            ));
            $response4 = curl_exec($curl4);
            curl_close($curl4);

            $this->session->set_flashdata('success', 'Pesan Pengaduan berhasi dikirimkan ke ' . $user_penerima);
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function terimasaldo($id_bonus)
    {
        $dataBonus   = $this->db->get_where('bonus', ['id_bonus' => $id_bonus])->row_array();
        $nilai_bonus = $dataBonus['nilai_bonus'];
        $no_services = $dataBonus['no_services'];
        $desc_bonus  = $dataBonus['desc_bonus'];

        $dataUser    = $this->db->get_where('user', ['no_services' => $no_services])->row_array();
        $nama_user   = $dataUser['name'];
        $nilai_saldo = $dataUser['saldo'];
        $saldo_total = $nilai_saldo + $nilai_bonus;
        $indo_total  = indo_currency($saldo_total);

        if ($nilai_bonus <= 0) {
            $sekarang = date('d/m/Y H:i:s') . ' WIB';
            $this->db->set('status_bonus', 'DITERIMA');
            $this->db->set('time_bonus', $sekarang);
            $this->db->where('id_bonus', $id_bonus);
            $this->db->update('bonus');

            $this->session->set_flashdata('success', 'Saldo Bonus Refferal Berhasil Diterima Sebesar Rp. ' . $indo_total);
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $sekarang = date('d/m/Y H:i:s') . ' WIB';

            $params = [
                'nominal' => $nilai_bonus,
                'date_payment' => date('Y-m-d'),
                'nama_kategori' => 'BONUS REFFERAL',
                'remark' => 'Pemberian Bonus Refferal kepada ' . $nama_user . ' (' . $no_services . ') Sebesar Rp. ' . $indo_total,
                'created' => time()
            ];
            $this->db->insert('expenditure', $params);

            $paramku = [
                'no_services' => $no_services,
                'nama_pemasukan' => 'BONUS REFFERAL',
                'nominal_pemasukan' => $nilai_bonus,
                'ket_pemasukan' => $desc_bonus,
                'waktu_pemasukan' => $sekarang
            ];
            $this->db->insert('pemasukan', $paramku);

            $this->db->set('saldo', $saldo_total);
            $this->db->where('no_services', $no_services);
            $this->db->update('user');

            $this->db->set('status_bonus', 'DITERIMA');
            $this->db->set('time_bonus', $sekarang);
            $this->db->where('id_bonus', $id_bonus);
            $this->db->update('bonus');

            $this->session->set_flashdata('success', 'Saldo Bonus Refferal Berhasil Diterima Sebesar Rp. ' . $indo_total);
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function balaspengaduan()
    {
        $konten_pesan = $this->input->post('konten_pesan');
        if ($konten_pesan == '') {
            $this->session->set_flashdata('error', 'Pesan Pengaduan gagal di Kirimkan');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $tiket_pesan    = $this->input->post('tiket_pesan');
            $user_pengirim  = $this->input->post('user_pengirim');
            $user_penerima  = $this->input->post('user_penerima');
            $judul_pesan    = $this->input->post('judul_pesan');
            $waktu_kirim    = $this->input->post('waktu_kirim');
            $status_message = $this->input->post('status_message');
            $message_id     = $this->input->post('message_id');

            $array = [
                'tiket_pesan' => $tiket_pesan,
                'user_pengirim' => $user_pengirim,
                'user_penerima' => $user_penerima,
                'judul_pesan' => $judul_pesan,
                'konten_pesan' => $konten_pesan,
                'waktu_kirim' => $waktu_kirim,
                'status_message' => $status_message,
            ];
            $this->db->insert('message', $array);

            $this->db->set('status_message', 'sudah dibaca');
            $this->db->where('message_id', $message_id);
            $this->db->update('message');
            $this->session->set_flashdata('success', 'Pesan Pengaduan berhasi dikirimkan ke ' . $user_penerima);
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function transaksi()
    {
        $data['title'] = 'Tambah Layanan';
        $data['notifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->result();
        $data['mynotifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->num_rows();
        $data['message'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->result();
        $data['mymessage'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->num_rows();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $myuser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $no_services = $myuser['no_services'];
        $data['paket'] = $this->db->get_where('package_log', ['no_services' => $no_services])->result();
        $dataUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $no_services = $dataUser['no_services'];
        if ($no_services != '') {
            $data['no_services'] = $no_services;
            $data['customer'] = $this->customer_m->getNSCustomer($no_services)->row_array();
            $data['services'] = $this->services_m->getServices($no_services)->result();
            $data['invoice'] = $this->bill_m->getBillThisMonth($no_services)->row();
            $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_member'];
        $this->template->load($MyThemes, 'member/transaksi', $data);
        } else {
            $this->session->set_flashdata('error  ', 'Email anda belum memiliki layanan yang aktif, silahkan hubungi kami untuk menjadi pelanggan kami');
            redirect('member/about');
        }
    }
    public function upgrade()
    {
        $data['title'] = 'Ganti Layanan';
        $data['notifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->result();
        $data['mynotifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->num_rows();
        $data['message'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->result();
        $data['mymessage'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->num_rows();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $myuser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $no_services = $myuser['no_services'];
        $data['paket'] = $this->db->get_where('package_log', ['no_services' => $no_services])->result();
        $dataUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $no_services = $dataUser['no_services'];
        if ($no_services != '') {
            $data['no_services'] = $no_services;
            $data['customer'] = $this->customer_m->getNSCustomer($no_services)->row_array();
            $data['services'] = $this->services_m->getServices($no_services)->result();
            $data['invoice'] = $this->bill_m->getBillThisMonth($no_services)->row();
            $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_member'];
        $this->template->load($MyThemes, 'member/upgrade', $data);
        } else {
            $this->session->set_flashdata('error  ', 'Email anda belum memiliki layanan yang aktif, silahkan hubungi kami untuk menjadi pelanggan kami');
            redirect('member/about');
        }
    }
    public function renew()
    {
        $data['title'] = 'Renew Speed';
        $data['notifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->result();
        $data['mynotifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->num_rows();
        $data['message'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->result();
        $data['mymessage'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->num_rows();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $myuser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $no_services = $myuser['no_services'];
        $data['paket'] = $this->db->get_where('package_log', ['no_services' => $no_services])->result();
        $dataUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $no_services = $dataUser['no_services'];
        if ($no_services != '') {
            $data['no_services'] = $no_services;
            $data['customer'] = $this->customer_m->getNSCustomer($no_services)->row_array();
            $data['services'] = $this->services_m->getServices($no_services)->result();
            $data['invoice'] = $this->bill_m->getBillThisMonth($no_services)->row();
            $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_member'];
        $this->template->load($MyThemes, 'member/renew', $data);
        } else {
            $this->session->set_flashdata('error  ', 'Email anda belum memiliki layanan yang aktif, silahkan hubungi kami untuk menjadi pelanggan kami');
            redirect('member/about');
        }
    }
    public function getdata()
    {
        $p_item_id = $this->input->post('id', TRUE);
        $data      = $this->db->get_where('package_item', ['p_item_id' => $p_item_id])->result();
        echo json_encode($data);
    }
    public function tambahlayanan()
    {
        $alasan_layanan = $this->input->post('alasan');
        $p_item_id      = $this->input->post('mydeskripsi');
        if ($alasan_layanan == '') {
            $this->session->set_flashdata('error', 'Layanan gagal di Ajukan pada Admin / Operator');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $data_paket        = $this->db->get_where('package_item', ['p_item_id' => $p_item_id])->row_array();
            $judul_layanan     = $this->input->post('judul_layanan');
            $nomor_layanan     = $this->input->post('nomor_layanan');
            $nama_pelanggan    = $this->input->post('nama_pelanggan');
            $nama_layanan      = $data_paket['name'];
            $harga_layanan     = $data_paket['price'];
            $diajukan_pada     = $this->input->post('diajukan_pada');
            $deskripsi_layanan = $data_paket['name'] . ' - Dengan harga sebesar Rp. ' . indo_currency($harga_layanan) . ' (Belum Termasuk PPN)';
            $catatan_layanan   = 'Menunggu Tanggapan Admin';
            $status_layanan    = 'Pending';

            $array = [
                'judul_layanan' => $judul_layanan,
                'nomor_layanan' => $nomor_layanan,
                'nama_pelanggan' => $nama_pelanggan,
                'nama_layanan' => $nama_layanan,
                'deskripsi_layanan' => $deskripsi_layanan,
                'alasan_layanan' => $alasan_layanan,
                'catatan_layanan' => $catatan_layanan,
                'status_layanan' => $status_layanan,
                'diajukan_pada' => $diajukan_pada,
            ];
            $this->db->insert('layanan', $array);

            $this->session->set_flashdata('success', 'Transaksi Layanan berhasil di Ajukan pada Admin / Operator');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function transfer()
    {
        $dataUserMember     = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $payment_saldo      = $this->db->get('paymentsaldo')->row_array();
        $admin_cost         = $payment_saldo['admin_cost'];
        $nominal_transfer   = $this->input->post('nominal_transfer');
        $nama_penerima      = $this->input->post('nama_penerima');
        $pin_transaksi      = $this->input->post('pin_trx');
        $bank_tujuan        = $this->input->post('bank_tujuan');
        $rekening_tujuan    = $this->input->post('rekening_tujuan');
        $nomor_services     = $this->input->post('nomor_services');
        $status_request     = 'PENDING';
        $waktu_request      = $this->input->post('waktu_request');
        $nomor_penerima     = $this->input->post('no_whatsapp');
        $kategori_transfer  = $this->input->post('kategori_transfer');
        $total_tranfer      = $admin_cost + $nominal_transfer;
        $saldoMember        = $dataUserMember['saldo'];
        $saldoTersedia      = $saldoMember - 5000;
        $cekCs = $this->db->get_where('user', ['pin_trx' => $pin_transaksi, 'email' => $this->session->userdata('email')])->num_rows();
        if ($cekCs > 0) {
            if ($saldoMember >= 10000) {
                if ($total_tranfer <= $saldoMember) {
                    $array = [
                        'nominal_transfer' => $total_tranfer,
                        'nama_penerima'    => $nama_penerima,
                        'bank_tujuan'      => $bank_tujuan,
                        'rekening_tujuan'  => $rekening_tujuan,
                        'kategori_transfer' => $kategori_transfer,
                        'nomor_services'   => $nomor_services,
                        'status_request'   => $status_request,
                        'waktu_request'    => $waktu_request,
                    ];
                    $this->db->insert('transfer', $array);

                    $whatsapp       = $this->db->get('whatsapp')->row_array();
                    $nomor_pengirim = $whatsapp['number'];
                    $api_key_wa     = $whatsapp['api_key'];
                    $link_url_wa    = $whatsapp['link_url'];
                    $link_url_web   = $whatsapp['url_web'];

                    $pesan_whatsapp = '*KONFIRMASI TRANSFER SALDO*
Nominal : Rp. ' . indo_currency($nominal_transfer) . '
No. Rek : ' . $rekening_tujuan . '
Tujuan : ' . $bank_tujuan . '
a/n : ' . $nama_penerima . '
Pada : ' . $waktu_request . '

Balas  *LANJUT*  untuk Konfirmasi';

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

                    $this->session->set_flashdata('success', 'Transfer saldo berhasil di ajukan, cek whatsapp anda untuk konfirmasi');
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    $this->session->set_flashdata('error', 'Transfer saldo gagal di ajukan, karena saldo anda tidak mencukupi. Nominal maksimal yang dapat anda Transfer Rp. ' . indo_currency($saldoTersedia));
                    redirect($_SERVER['HTTP_REFERER']);
                }
            } else {
                $this->session->set_flashdata('error', 'Saldo Tidak Mencukupi, Silahkan Top Up Saldo Dahulu');
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_flashdata('error', 'PIN Transaksi Yang Anda Masukkan Salah, Silahkan Ulangi');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function pemasukan()
    {
        $data['title'] = 'Daftar Pemasukan';
        $data['notifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->result();
        $data['mynotifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->num_rows();
        $data['message'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->result();
        $data['mymessage'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->num_rows();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $myuser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $no_services = $myuser['no_services'];
        $data['pemasukan'] = $this->income_m->getpemasukan($no_services)->result();
        $dataUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $no_services = $dataUser['no_services'];
        if ($no_services != '') {
            $data['no_services'] = $no_services;
            $data['invoice'] = $this->bill_m->getBillThisMonth($no_services)->row();
            $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_member'];
        $this->template->load($MyThemes, 'member/list-pemasukan', $data);
        } else {
            $this->session->set_flashdata('error  ', 'Email anda belum memiliki layanan yang aktif, silahkan hubungi kami untuk menjadi pelanggan kami');
            redirect('member/about');
        }
    }
    public function speedtest()
    {
        $data['title'] = 'Test Kecepatan';
        $data['notifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->result();
        $data['mynotifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->num_rows();
        $data['message'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->result();
        $data['mymessage'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->num_rows();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $myuser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $no_services = $myuser['no_services'];
        if ($no_services != '') {
            $data['no_services'] = $no_services;
            $data['invoice'] = $this->bill_m->getBillThisMonth($no_services)->row();
            $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_member'];
        $this->template->load($MyThemes, 'member/speedtest', $data);
        } else {
            $this->session->set_flashdata('error  ', 'Email anda belum memiliki layanan yang aktif, silahkan hubungi kami untuk menjadi pelanggan kami');
            redirect('member/about');
        }
    }
    public function gaji()
    {
        $data['title'] = 'Daftar Gaji';
        $data['notifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->result();
        $data['mynotifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->num_rows();
        $data['message'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->result();
        $data['mymessage'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->num_rows();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $myuser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $no_services = $myuser['no_services'];
        $dataUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $no_services = $dataUser['no_services'];
        $data['gaji'] = $this->db->get_where('gaji', array('no_services' => $no_services))->result();
        if ($no_services != '') {
            $data['no_services'] = $no_services;
            $data['invoice'] = $this->bill_m->getBillThisMonth($no_services)->row();
            $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_member'];
        $this->template->load($MyThemes, 'member/terima-gaji', $data);
        } else {
            $this->session->set_flashdata('error  ', 'Email anda belum memiliki layanan yang aktif, silahkan hubungi kami untuk menjadi pelanggan kami');
            redirect('member/about');
        }
    }
    public function detailgaji($id)
    {
        $data['title'] = 'Daftar Pemasukan';
        $data['notifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->result();
        $data['mynotifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->num_rows();
        $data['message'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->result();
        $data['mymessage'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->num_rows();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $myuser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $no_services = $myuser['no_services'];
        $dataUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $no_services = $dataUser['no_services'];
        $data['gaji'] = $this->db->get_where('gaji', array('id_gaji' => $id))->row_array();
        if ($no_services != '') {
            $data['no_services'] = $no_services;
            $data['invoice'] = $this->bill_m->getBillThisMonth($no_services)->row();
            $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_member'];
        $this->template->load($MyThemes, 'member/detail-gaji', $data);
        } else {
            $this->session->set_flashdata('error  ', 'Email anda belum memiliki layanan yang aktif, silahkan hubungi kami untuk menjadi pelanggan kami');
            redirect('member/about');
        }
    }

    public function terimagaji($id)
    {
        $tgl_sekarang = date('d/m/Y H:i:s') . ' WIB';
        $this->db->set('status_gaji', 'DITERIMA');
        $this->db->set('tanggal_gaji', $tgl_sekarang);
        $this->db->where('id_gaji', $id);
        $this->db->update('gaji');

        $dataGaji = $this->db->get_where('gaji', array('id_gaji' => $id))->row_array();
        $paramgua = [
            'date_payment' => date('Y-m-d'),
            'no_services' => $dataGaji['no_services'],
            'nominal_pemasukan' => $dataGaji['gaji_diterima'],
            'ket_pemasukan' => 'Terima Gaji Periode ' . $dataGaji['bulan_gaji'] . ' ' . $dataGaji['tahun_gaji'],
            'nama_pemasukan' => 'TERIMA GAJI',
            'waktu_pemasukan' => $dataGaji['tanggal_gaji']
        ];
        $this->db->insert('pemasukan', $paramgua);

        $paramku = [
            'date_payment' => date('Y-m-d'),
            'no_services' => $dataGaji['no_services'],
            'nominal' => $dataGaji['gaji_diterima'],
            'remark' => 'Gaji Karyawan a/n ' . $dataGaji['nama_karyawan'] . ' yang diterima pada ' . $dataGaji['tanggal_gaji'],
            'nama_kategori' => 'GAJI KARYAWAN',
            'create_by' => $this->session->userdata('id'),
            'created' => time()
        ];
        $this->db->insert('expenditure', $paramku);

        $dataUser   = $this->db->get_where('user', array('no_services' => $dataGaji['no_services']))->row_array();
        $saldonya   = $dataUser['saldo'];
        $totalsaldo = $saldonya + $dataGaji['gaji_diterima'];

        $whatsapp       = $this->db->get('whatsapp')->row_array();
        $nomor_pengirim = $whatsapp['number'];
        $nomor_penerima = $dataUser['phone'];
        $api_key_wa     = $whatsapp['api_key'];
        $link_url_wa    = $whatsapp['link_url'];
        $link_url_web   = $whatsapp['url_web'];

        $pesan_whatsapp = '*PENERIMAAN GAJI KARYAWAN*
Nominal : Rp. ' . indo_currency($dataGaji['gaji_diterima']) . '
a/n : ' . $dataGaji['nama_karyawan'] . '
Status Gaji : ' . $dataGaji['status_gaji'] . '
Pada : ' . $dataGaji['tanggal_gaji'];

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

        $this->db->set('saldo', $totalsaldo);
        $this->db->where('no_services', $dataGaji['no_services']);
        $this->db->update('user');

        $this->session->set_flashdata('success', 'Berhasil Terima Gaji');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function tolakgaji($id)
    {
        $tgl_sekarang = date('d/m/Y H:i:s') . ' WIB';
        $this->db->set('status_gaji', 'DITOLAK');
        $this->db->set('tanggal_gaji', $tgl_sekarang);
        $this->db->where('id_gaji', $id);
        $this->db->update('gaji');

        $dataGaji = $this->db->get_where('gaji', array('id_gaji' => $id))->row_array();
        $whatsapp       = $this->db->get('whatsapp')->row_array();
        $dataUser       = $this->db->get_where('user', array('no_services' => $dataGaji['no_services']))->row_array();
        $nomor_pengirim = $whatsapp['number'];
        $nomor_penerima = $whatsapp['admin'];
        $api_key_wa     = $whatsapp['api_key'];
        $link_url_wa    = $whatsapp['link_url'];
        $link_url_web   = $whatsapp['url_web'];

        $pesan_whatsapp = '*PENERIMAAN GAJI KARYAWAN*
Nominal : Rp. ' . indo_currency($dataGaji['gaji_diterima']) . '
a/n : ' . $dataGaji['nama_karyawan'] . '
Status Gaji : ' . $dataGaji['status_gaji'] . '
Pada : ' . $dataGaji['tanggal_gaji'];

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

        $this->session->set_flashdata('success', 'Berhasil Tolak Gaji');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function transfersaldo()
    {
        $data['title'] = 'Transfer Saldo';
        $data['notifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->result();
        $data['mynotifikasi'] = $this->db->get_where('notifikasi', ['status_notifikasi' => 'Aktif'])->num_rows();
        $data['message'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->result();
        $data['mymessage'] = $this->db->get_where('message', ['status_message' => 'belum dibaca', 'user_penerima' => $this->session->userdata('email')])->num_rows();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['payment'] = $this->db->get('paymentsaldo')->row_array();
        $dataUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $no_services = $dataUser['no_services'];
        if ($no_services != '') {
            $data['CountServices'] = $this->services_m->getServices($no_services)->num_rows();
            $data['no_services'] = $no_services;
            $bill = $this->bill_m->getBillThisMonth($no_services)->row();
            if ($bill != '') {
                $data['totalBill'] = $this->bill_m->getBillThisMonth($no_services)->num_rows();
                $data['CountBill'] = $this->bill_m->getBillDetail($bill->invoice)->result();
                $data['bank'] = $this->setting_m->getBank()->result();
                $data['invoice'] = $this->bill_m->getBillThisMonth($no_services)->row();
                $data['services'] = $this->services_m->getServices($no_services)->result();
            } else {
                $data['totalBill'] = 0;
                $data['CountBill'] = 0;
            }
            $data['product'] = $this->product_m->get()->result();
            $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_member'];
        $this->template->load($MyThemes, 'member/transfer-saldo', $data);
        } else {
            $this->session->set_flashdata('error', 'Email anda belum memiliki layanan yang aktif, silahkan hubungi kami untuk menjadi pelanggan kami');
            redirect('member/about');
        }
    }
}
