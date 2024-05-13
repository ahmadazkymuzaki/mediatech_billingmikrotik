<?php defined('BASEPATH') or exit('No direct script access allowed');

class customer extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model(['customer_m', 'router_m', 'services_m', 'bill_m']);
    }
    public function index()
    {
        $data['title'] = 'Customer';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['customer'] = $this->customer_m->getCustomer()->result();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $company = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/customer/data', $data);
    }
    public function location()
    {
        $data['title'] = 'Lokasi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['customer'] = $this->customer_m->getCustomer()->result();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $company = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $config['center'] = $company['latitude'] . ',' . $company['longitude'];
        $config['zoom'] = '12';
        $config['map_type'] = 'HYBRID';
        $config['map_height'] = '500px;';
        $config['styles'] = array(
            array(
                "name" => "No Businesses",
                "definition" => array(
                    array(
                        "featureType" => "poi",
                        "elementType" =>
                        "business",
                        "stylers" => array(
                            array(
                                "visibility" => "off"
                            )
                        )
                    )
                )
            )
        );

        $this->googlemaps->initialize($config);
        foreach ($this->searchQuery() as $key => $value) :
            $marker = array();
            $marker['position'] = "{$value->latitude}, {$value->longitude}";
            $base_url = base_url();
            $dataItem = $this->db->get_where('package_item', array('p_item_id' => $value->item_paket))->row_array();
            $dataUser = $this->db->get_where('user', array('no_services' => $value->no_services))->row_array();
            $marker['animation'] = 'DROP';
            $marker['infowindow_content'] = '<div class="media" style="width:300px; height: 300px;">';
            $marker['infowindow_content'] .= '<div class="media-left">';
            $marker['infowindow_content'] .= '</div>';
            $marker['infowindow_content'] .= '<div class="media-body">';
            $marker['infowindow_content'] .= '<p><img src="' . $base_url . 'assets/images/profile/' . $dataUser['image'] . '" style="width:50px;height:50px;"></p>';
            $marker['infowindow_content'] .= '<p>Nama Pelanggan ➡️<b> ' . $value->name . '</b><br>';
            $marker['infowindow_content'] .= 'Nomor Layanan ➡️<b> ' . $value->no_services . '</b><br>';
            $marker['infowindow_content'] .= 'Paket Langganan ➡️<b> ' . $value->paket_wifi . '</b><br>';
            $marker['infowindow_content'] .= 'Tagihan Pelanggan ➡️<b> Rp.' . indo_currency($dataItem['price']) . '</b><br>';
            $marker['infowindow_content'] .= 'Saldo Pelanggan ➡️<b> Rp. ' . indo_currency($dataUser['saldo']) . '</b><br>';
            $marker['infowindow_content'] .= 'Jatuh Tempo ➡️<b> Setiap Tanggal ' . $value->due_date . '</b><br>';
            $marker['infowindow_content'] .= 'Nomor Telepon ➡️<b> ' . $value->no_wa . '</b><br>';
            $marker['infowindow_content'] .= 'Alamat E-Mail ➡️<b> ' . $value->email . '</b><br>';
            $marker['infowindow_content'] .= 'Status Pelanggan ➡️<b> ' . $value->c_status . '</b><br>';
            $marker['infowindow_content'] .= 'Kode Refferal ➡️<b> ' . $value->refferal . '</b><br>';
            $marker['infowindow_content'] .= 'Terdaftar Sejak ➡️<b> ' . $value->register_date . '</b><br>';
            $marker['infowindow_content'] .= 'Alamat Lengkap ➡️<b> ' . $value->address . '</b></p>';
            $marker['infowindow_content'] .= '</div>';
            $marker['infowindow_content'] .= '</div>';
            $marker['icon'] = 'https://files.naufal.co.id/public/icon/wifi.png';
            $this->googlemaps->add_marker($marker);
        endforeach;

        $this->googlemaps->initialize($config);

        $data['map'] = $this->googlemaps->create_map();

        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/customer/location', $data);
    }

    public function searchQuery()
    {
        $this->db->select('customer.*');

        $this->db->where('customer.latitude !=', NULL)
            ->where('customer.longitude !=', NULL);

        return $this->db->get("customer")->result();
    }

    public function excel()
    {
        if (isset($_FILES["excel"]["name"])) {
            $file_tmp = $_FILES['excel']['tmp_name'];
            $file_name = $_FILES['excel']['name'];
            $file_size = $_FILES['excel']['size'];
            $file_type = $_FILES['excel']['type'];
            $object = PHPExcel_IOFactory::load($file_tmp);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for ($row = 3; $row <= $highestRow; $row++) {
                    $nama_pelanggan     = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $jenis_kelamin      = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $nomor_layanan      = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $username_ppp       = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $password_ppp       = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $profile_ppp        = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $item_paket         = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $email_pelanggan    = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $gambar_profil      = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                    $password_login     = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                    $password_text      = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                    $saldo_pelanggan    = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                    $tgl_registrasi     = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                    $alamat_lengkap     = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                    $pemilik_rumah      = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                    $nomor_telepon      = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                    $nomor_ktp          = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                    $foto_ktp           = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
                    $status_pelanggan   = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
                    $pajak_pelanggan    = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
                    $id_coverage        = $worksheet->getCellByColumnAndRow(20, $row)->getValue();
                    $jatuh_tempo        = $worksheet->getCellByColumnAndRow(21, $row)->getValue();
                    $kode_refferal      = $worksheet->getCellByColumnAndRow(22, $row)->getValue();
                    $level_akses        = $worksheet->getCellByColumnAndRow(23, $row)->getValue();
                    $server_pelanggan   = $worksheet->getCellByColumnAndRow(24, $row)->getValue();
                    $maps_latitude      = $worksheet->getCellByColumnAndRow(25, $row)->getValue();
                    $maps_longitude     = $worksheet->getCellByColumnAndRow(26, $row)->getValue();
                    $data[] = array(
                        'name'          => $nama_pelanggan,
                        'no_services'   => $nomor_layanan,
                        'item_paket'    => $item_paket,
                        'username'      => $username_ppp,
                        'password'      => $password_ppp,
                        'paket_wifi'    => $profile_ppp,
                        'server'        => $server_pelanggan,
                        'email'         => $email_pelanggan,
                        'register_date' => $tgl_registrasi,
                        'pemilik_rumah' => $pemilik_rumah,
                        'address'       => $alamat_lengkap,
                        'latitude'      => $maps_latitude,
                        'longitude'     => $maps_longitude,
                        'no_wa'         => $nomor_telepon,
                        'no_ktp'        => $nomor_ktp,
                        'ktp'           => $foto_ktp,
                        'c_status'      => $status_pelanggan,
                        'ppn'           => $pajak_pelanggan,
                        'coverage'      => $id_coverage,
                        'type_id'       => $level_akses,
                        'due_date'      => $jatuh_tempo,
                        'refferal'      => $kode_refferal,
                        'created'       => time(),
                    );

                    $datasaya[] = array(
                        'email'         => $email_pelanggan,
                        'password'      => $password_login,
                        'pass_text'     => $password_text,
                        'name'          => $nama_pelanggan,
                        'gender'        => $jenis_kelamin,
                        'saldo'         => $saldo_pelanggan,
                        'refferal'      => $kode_refferal,
                        'no_services'   => $nomor_layanan,
                        'phone'         => $nomor_telepon,
                        'address'       => $alamat_lengkap,
                        'image'         => $gambar_profil,
                        'role_id'       => $level_akses,
                        'is_active'     => 1,
                        'date_created'  => time(),
                    );

                    if ($jatuh_tempo <= 4) {
                        $tanggal_reminder = $jatuh_tempo;
                    } else {
                        $tanggal_reminder = $jatuh_tempo - 3;
                    }
                    if ($tanggal_reminder <= 9) {
                        $reminder = '0' . $tanggal_reminder;
                    } else {
                        $reminder = $tanggal_reminder;
                    }
                    $tgl_sekarang = date('d/m/Y H:i:s') . ' WIB';
                    $dataku[] = array(
                        'nama_pelanggan'    => $nama_pelanggan,
                        'nomor_services'    => $nomor_layanan,
                        'nomor_whatsapp'    => $nomor_telepon,
                        'kategori_kontak'   => 'PELANGGAN',
                        'tanggal_reminder'  => $reminder,
                        'nomor_invoice'     => NULL,
                        'jumlah_kirim'      => 0,
                        'kirim_sukses'      => 0,
                        'kirim_gagal'       => 0,
                        'update_campaign'   => $tgl_sekarang,
                    );

                    $dataItem = $this->db->get_where('package_item', array('p_item_id' => $item_paket))->row_array();
                    $datagua[] = array(
                        'item_id'           => $item_paket,
                        'category_id'       => $dataItem['category_id'],
                        'no_services'       => $nomor_layanan,
                        'qty'               => 1,
                        'price'             => $dataItem['price'],
                        'disc'              => 0,
                        'total'             => $dataItem['price'],
                        'remark'            => '',
                        'services_create'   => time(),
                    );
                }
                $this->db->insert_batch('customer', $data);
                $this->db->insert_batch('user', $datasaya);
                $this->db->insert_batch('services', $datagua);
                $this->db->insert_batch('campaign', $dataku);
            }
            $this->session->set_flashdata('success', 'Data Pelanggan berhasil disimpan, silahkan cek kembali data pelanggan');
            redirect('customer');
        }
    }
    public function active()
    {
        $data['title'] = 'Aktif';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['customer'] = $this->customer_m->getCustomerActive()->result();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $company = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/customer/data', $data);
    }
    public function nonactive()
    {
        $data['title'] = 'Non-Aktif';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['customer'] = $this->customer_m->getCustomerNonactive()->result();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $company = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/customer/data', $data);
    }
    public function free()
    {
        $data['title'] = 'Gratis';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['customer'] = $this->customer_m->getCustomerFree()->result();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $company = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/customer/data', $data);
    }
    public function isolir()
    {
        $data['title'] = 'Isolir';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['customer'] = $this->customer_m->getCustomerIsolir()->result();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $company = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/customer/data', $data);
    }
    public function wait()
    {
        $data['title'] = 'Waiting';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['customer'] = $this->customer_m->getCustomerWait()->result();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $company = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/customer/data', $data);
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
            $data['title'] = 'Tambah';
            $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
            $data['coverage'] = $this->db->get_where('coverage', array('kategori' => 'AREA'))->result();
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

            $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
            $API = new routeros();
            $host = $myrouter['host_router'];
            $user = $myrouter['user_router'];
            $pass = $myrouter['pass_router'];
            $port = $myrouter['port_router'];
            $API->connect($host, $port, $user, $pass);
            $hotspotprofile = $API->comm("/ip/hotspot/user/profile/print");
            $hotspotprofile = json_encode($hotspotprofile);
            $hotspotprofile = json_decode($hotspotprofile, true);
            $pppprofile = $API->comm("/ppp/profile/print");
            $pppprofile = json_encode($pppprofile);
            $pppprofile = json_decode($pppprofile, true);
            $pppserver = $API->comm("/ppp/profile/print");
            $pppprofile = json_encode($pppprofile);
            $pppprofile = json_decode($pppprofile, true);
            $hotspotserver = $API->comm("/ip/hotspot/print");
            $hotspotserver = json_encode($hotspotserver);
            $hotspotserver = json_decode($hotspotserver, true);
            $pppstatic = $API->comm("/queue/simple/print", array("?dynamic" => "false"));
            $pppstatic = json_encode($pppstatic);
            $pppstatic = json_decode($pppstatic, true);

            $mydata = [
                'hotspotprofile' => $hotspotprofile,
                'hotspotserver' => $hotspotserver,
                'pppprofile' => $pppprofile,
                'pppstatic' => $pppstatic,
            ];

            $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
            $MyThemes = $MyCompanyData['tm_backend'];
            $this->template->load($MyThemes, 'backend/customer/add_customer', $data + $mydata);
        } else {
            $cekCs = $this->db->get_where('user', ['email' => $this->input->post('email', true)])->num_rows();
            if ($cekCs > 0) {
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('error', 'Email Tersebut Telah Terdaftar');
                }
                redirect('customer');
            } else {
                $this_iditem1 = $this->input->post('paket', true);
                $coverage_id  = $this->input->post('coverage', true);
                $post = $this->input->post(null, TRUE);
                $datapaket1 = $this->db->get_where('package_item', array('p_item_id' => $this_iditem1))->row_array();
                $paket_pppoe = $datapaket1['paket_wifi'];
                $datapackage  = $this->db->get_where('package_item', array('p_item_id' => $this_iditem1))->row_array();
                $category_id  = $datapackage['category_id'];
                $datacategory = $this->db->get_where('package_category', array('p_category_id' => $category_id))->row_array();
                $kategorinya  = $datacategory['name'];
                $other  = $this->db->get_where('other', array('id' => 1))->row_array();
                $dataCompany = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
                $DataCoverageNya = $this->db->get_where('coverage', array('coverage_id' => $coverage_id))->row_array();
                $alamat_lengkap = $DataCoverageNya['complete'];
                $email = $this->input->post('email', true);
                $pass_text = $this->input->post('password2', true);
                $name = $this->input->post('name', true);
                $gender = $this->input->post('gender', true);
                $saldo = $this->input->post('saldo', true);
                $refferal = $this->input->post('refferal', true);
                $no_services = $this->input->post('no_services', true);
                $phone = $this->input->post('no_wa', true);

                $this_iditem1 = $post['paket'];
                $datapaket1 = $this->db->get_where('package_item', array('p_item_id' => $this_iditem1))->row_array();
                $paket_pppoe = $datapaket1['paket_wifi'];
                $datapaket = $this->db->get_where('package_item', array('p_item_id' => $post['paket']))->row_array();
                $paket = $datapaket['paket_wifi'];
                $tagihan = $datapaket['price'];
                $item = $this->db->get_where('package_item', ['p_item_id' => $post['paket']])->row_array();

                if ($post['username'] == '' || $post['username'] == NULL) {
                    $usernamenya = 'belum diatur';
                } else {
                    $usernamenya = $post['username'];
                }
                if ($post['password'] == '' || $post['password'] == NULL) {
                    $passwordnya = 'belum diatur';
                } else {
                    $passwordnya = $post['password'];
                }
                if ($post['ppn'] > 0) {
                    $i_ppnnya = $dataCompany['ppn'];
                } else {
                    $i_ppnnya = $post['ppn'];
                }

                $register_date = date('Y-m-d');
                $mytanggal = date('d');
                $latitudenya  = substr($post['latitude'], 0, 9);
                $longitudenya = substr($post['longitude'], 0, 9);

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
                $tgl_sekarang = date('d/m/Y H:i:s') . ' WIB';

                if ($post['jenis'] == 'PRABAYAR') {
                    $bulan_invoice = date('m');
                    $tahun_invoice = date('Y');
                } else {
                    $hitung_bulan = date('m') + 1;
                    if ($hitung_bulan > 0 && $hitung_bulan < 10) {
                        $bulan_invoice = '0' . $hitung_bulan;
                        $tahun_invoice = date('Y');
                    } elseif ($hitung_bulan >= 10 && $hitung_bulan < 12) {
                        $bulan_invoice = $hitung_bulan;
                        $tahun_invoice = date('Y');
                    } elseif ($hitung_bulan >= 12) {
                        $hitung_tahun  = date('Y') + 1;
                        $bulan_invoice = '01';
                        $tahun_invoice = $hitung_tahun;
                    }
                }

                $config['upload_path']          = './assets/images/ktp';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 2048; // 2 Mb
                $config['file_name']            = 'ktp-' . $post['no_services'];
        		$config['overwrite']            = true;
        		$config['max_size']             = 1024; // 1MB
        		$config['max_width']            = 1080;
        		$config['max_height']           = 1080;
        
        		$this->load->library('upload', $config);
                $this->upload->initialize($config);
        		if (!$this->upload->do_upload('ktp')) {
                    $ktpnya =  'tidak ada gambar ktp';
        		} else {
        			$ktpnya =  $this->upload->data('file_name');
        			$mypath = './assets/images/ktp/ktp-' . $post['no_services'];
        			unlink($mypath);
                }

                $image = $ktpnya;
                $role_id = $post['role_id'];
                if ($post['c_status'] == 'Aktif') {
                    $is_active = 1;
                } else {
                    $is_active = 0;
                }
                $date_created = time();

                if ($post['prorata'] == 1) {
                    $remark_sekarang  = 'DISKON TAGIHAN PRORATA';
                    $tagihan_sekarang = $tagihan;
                    $hitung_tagihan   = ($tagihan / 30) * $post['hitung'];
                    $diskon_sekarang  = ceil($tagihan_sekarang - $hitung_tagihan);
                    $total_sekarang   = ceil($tagihan_sekarang - $diskon_sekarang);
                } else {
                    $remark_sekarang  = '-';
                    $tagihan_sekarang = $tagihan;
                    $diskon_sekarang  = 0;
                    $total_sekarang   = $tagihan;
                }
                $total_sekarang2  = substr($total_sekarang, 0, -3).'000';
                $diskon_sekarang2 = (substr($diskon_sekarang, 0, -3)+1).'000';
                

                $myrouter  = $this->db->get_where('router', ['name_router' => $post['router']])->row_array();
                $host = $myrouter['host_router'];
                $user = $myrouter['user_router'];
                $pass = $myrouter['pass_router'];
                $port = $myrouter['port_router'];
                $API = new routeros();
                $API->connect($host, $port, $user, $pass);
        
                if ($post['mode'] == 'PPPOE') {
                    $API->comm("/ppp/secret/add", array(
                        "name" => $usernamenya,
                        "password" => $passwordnya,
                        "service" => 'pppoe',
                        "profile" => $post['paket_wifi'],
            			"comment" => 'Nomor Layanan : '.$post['no_services'],
                    ));
                }
                if ($post['mode'] == 'HOTSPOT') {
                    $API->comm("/ip/hotspot/user/add", array(
            			"name" => $usernamenya,
            			"password" => $passwordnya,
            			"profile" => $post['paket_wifi'],
            			"server" => $post['server'],
            			"comment" => 'Nomor Layanan : '.$post['no_services'],
            		));
                }
                if ($post['mode'] == 'STATIC') {
                    $API->comm("/queue/simple/add", array(
                        "name" => $post['name'],
                        "target" => $post['ip_address'],
                        "max-limit" => $post['upload'].'/'.$post['download'],
                        "queue" => "default-small",
                        "parent" => $post['paket_wifi'],
                        "comment" => 'Nomor Layanan : '.$post['no_services'],
                    ));
                }

                $insertdatacustomer = [
                    'name' => htmlspecialchars($post['name']),
                    'no_services' => $post['no_services'],
                    'item_paket' => $post['paket'],
                    'username' => $usernamenya,
                    'password' => $passwordnya,
                    'paket_wifi' => $post['paket_wifi'],
                    'prorata' => $post['prorata'],
                    'hitung' => $post['hitung'],
                    'telat' => 0,
                    'tagihan' => $tagihan,
                    'router' => $post['router'],
                    'mode' => $post['mode'],
                    'ip_address' => $post['ip_address'],
                    'code_unique' => $post['code_unique'],
                    'server' => $post['server'],
                    'upload' => $post['upload'],
                    'download' => $post['download'],
                    'jenis' => $post['jenis'],
                    'kode_odp' => $post['kode_odp'],
                    'port_odp' => $post['port_odp'],
                    'email' => $post['email'],
                    'register_date' => $post['register_date'],
                    'pemilik_rumah' => $post['pemilik_rumah'],
                    'address' => $post['address'],
                    'complete' => $alamat_lengkap,
                    'latitude' => $latitudenya,
                    'longitude' => $longitudenya,
                    'no_wa' => $post['no_wa'],
                    'type_id' => $post['type_id'],
                    'no_ktp' => $post['no_ktp'],
                    'ktp' => $ktpnya,
                    'c_status' => $post['c_status'],
                    'ppn' => $post['ppn'],
                    'coverage' => $post['coverage'],
                    'due_date' => $post['due_date'],
                    'refferal' => $post['refferal'],
                    'keterangan' => $post['keterangan'],
                    'register_name' => $post['register_name'],
                    'created' => time(),
                ];
                $this->db->insert('customer', $insertdatacustomer);

                $insertdatauser = [
                    'email' => htmlspecialchars($email),
                    'password' => '$2y$10$vUwQxmIUlYwZpHESSLjK6./BwSxtoRPDrjq4T7dRrnGK3B9dK.O6y',
                    'pass_text' => htmlspecialchars($pass_text),
                    'name' => htmlspecialchars($name),
                    'gender' => htmlspecialchars($gender),
                    'saldo' => htmlspecialchars($saldo),
                    'refferal' => htmlspecialchars($refferal),
                    'no_services' => htmlspecialchars($no_services),
                    'phone' => htmlspecialchars($phone),
                    'address' => htmlspecialchars($alamat_lengkap),
                    'image' => htmlspecialchars($image),
                    'role_id' => htmlspecialchars($role_id),
                    'is_active' => htmlspecialchars($is_active),
                    'date_created' => htmlspecialchars($date_created),
                ];
                $this->db->insert('user', $insertdatauser);

                $insertdatapackagelog = [
                    'no_services' => $post['no_services'],
                    'nama_paket'  => $datapaket1['name'],
                    'cat_paket'   => $kategorinya,
                    'ditambah_oleh'   => $data_user['name'],
                    'time_paket' => $tgl_sekarang,
                ];
                $this->db->insert('package_log', $insertdatapackagelog);

                $insertdatainvoice = [
                    'invoice' => date('ymdHis'),
                    'code_unique' => rand(500, 999),
                    'month' => $bulan_invoice,
                    'year'  => $tahun_invoice,
                    'no_services' => $post['no_services'],
                    'i_ppn' => $i_ppnnya,
                    'amount' => $total_sekarang2,
                    'status' => 'BELUM BAYAR',
                    'create_by' => 1,
                    'created' => time(),
                ];
                $this->db->insert('invoice', $insertdatainvoice);

                $insertdatacampaign = [
                    'nama_pelanggan' => $post['name'],
                    'nomor_services' => $post['no_services'],
                    'nomor_whatsapp' => $post['no_wa'],
                    'kategori_kontak' => 'PELANGGAN',
                    'tanggal_reminder' => $reminder,
                    'update_campaign' => $tgl_sekarang,
                ];
                $this->db->insert('campaign', $insertdatacampaign);

                $insertdatadetail = [
                    'invoice_id' => date('ymdHis'),
                    'price' => $tagihan_sekarang,
                    'qty' => 1,
                    'disc' => $diskon_sekarang2,
                    'remark' => $remark_sekarang,
                    'total' => $total_sekarang2,
                    'item_id' => $item['p_item_id'],
                    'category_id' => $item['category_id'],
                    'd_month' => $bulan_invoice,
                    'd_year' => $tahun_invoice,
                    'd_no_services' => $post['no_services'],
                ];
                $this->db->insert('invoice_detail', $insertdatadetail);

                $insertdataservices = [
                    'item_id' => $item['p_item_id'],
                    'category_id' => $item['category_id'],
                    'no_services' => $post['no_services'],
                    'qty' => 1,
                    'disc' => $diskon_sekarang2,
                    'price' => $tagihan_sekarang,
                    'total' => $total_sekarang2,
                    'remark' => $remark_sekarang,
                    'services_create' => time(),
                ];
                $this->db->insert('services', $insertdataservices);

                $this->session->set_flashdata('success', 'Data Pelanggan berhasil disimpan, silahkan cek kembali data pelanggan');
                redirect('customer/active');
            }
        }
    }

    public function edit($customer_id)
    {
        if ($this->session->userdata('role_id') != 1) {
            $this->session->set_flashdata('error', 'Akses dilarang');
            redirect('dashboard');
        }
        is_logged_in();
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('no_ktp', 'No KTP', 'trim');
        $this->form_validation->set_rules('no_wa', 'No Whatsapp', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        $this->form_validation->set_message('required', '%s Tidak boleh kosong, Silahkan isi');
        if ($this->form_validation->run() == false) {
            $query  = $this->customer_m->getCustomer($customer_id);
            if ($query->num_rows() > 0) {
                $data['customer'] = $this->db->get_where('customer', array('customer_id' => $customer_id))->row_array();
                $data['title'] = 'Edit Customer';
                $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
                $company = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
                $data['coverage'] = $this->db->get_where('coverage', array('kategori' => 'AREA'))->result();
                $data['router'] = $this->router_m->get()->result();
                $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
                $config['map_div_id'] = "map-add";
                $config['map_height'] = "250px";
                $customer = $this->db->get_where('customer', array('customer_id' => $customer_id))->row_array();
                if ($customer['latitude'] == '' || $customer['latitude'] == NULL) {
                    $config['center'] = $company['latitude'] . ',' . $company['longitude'];
                } else {
                    $config['center'] = $customer['latitude'] . ',' . $customer['longitude'];
                }
                $config['zoom'] = '12';
                $config['map_height'] = '400px;';
                $config['map_type'] = 'HYBRID';
                $this->googlemaps->initialize($config);
                $marker = array();
                if ($customer['latitude'] == '' || $customer['latitude'] == NULL) {
                    $marker['position'] = $company['latitude'] . ',' . $company['longitude'];
                } else {
                    $marker['position'] = $customer['latitude'] . ',' . $customer['longitude'];
                }
                $marker['draggable'] = true;
                $marker['ondragend'] = 'setMapToForm(event.latLng.lat(), event.latLng.lng());';
                $this->googlemaps->add_marker($marker);
                $data['map'] = $this->googlemaps->create_map();

                $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
                $API = new routeros();
                $host = $myrouter['host_router'];
                $user = $myrouter['user_router'];
                $pass = $myrouter['pass_router'];
                $port = $myrouter['port_router'];
                $API->connect($host, $port, $user, $pass);
                $hotspotprofile = $API->comm("/ip/hotspot/user/profile/print");
                $hotspotprofile = json_encode($hotspotprofile);
                $hotspotprofile = json_decode($hotspotprofile, true);
                $pppprofile = $API->comm("/ppp/profile/print");
                $pppprofile = json_encode($pppprofile);
                $pppprofile = json_decode($pppprofile, true);
                $pppserver = $API->comm("/ppp/profile/print");
                $pppprofile = json_encode($pppprofile);
                $pppprofile = json_decode($pppprofile, true);
                $hotspotserver = $API->comm("/ip/hotspot/print");
                $hotspotserver = json_encode($hotspotserver);
                $hotspotserver = json_decode($hotspotserver, true);
                $pppstatic = $API->comm("/queue/simple/print", array("?dynamic" => "false"));
                $pppstatic = json_encode($pppstatic);
                $pppstatic = json_decode($pppstatic, true);

                $mydata = [
                    'hotspotprofile' => $hotspotprofile,
                    'hotspotserver' => $hotspotserver,
                    'pppprofile' => $pppprofile,
                    'pppstatic' => $pppstatic,
                ];

                $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
                $MyThemes = $MyCompanyData['tm_backend'];
                $this->template->load($MyThemes, 'backend/customer/edit_customer', $data + $mydata);
            } else {
                echo "<script> alert ('Data tidak ditemukan');";
                redirect('customer');
            }
        } else {
            $this_iditem1 = $this->input->post('paket', true);
            $coverage_id  = $this->input->post('coverage', true);
            $customer_id  = $this->input->post('customer_id', true);
            $post = $this->input->post(null, TRUE);
            $datapaket1 = $this->db->get_where('package_item', array('p_item_id' => $this_iditem1))->row_array();
            $paket_pppoe = $datapaket1['paket_wifi'];
            $datapackage  = $this->db->get_where('package_item', array('p_item_id' => $this_iditem1))->row_array();
            $category_id  = $datapackage['category_id'];
            $datacategory = $this->db->get_where('package_category', array('p_category_id' => $category_id))->row_array();
            $kategorinya  = $datacategory['name'];
            $other  = $this->db->get_where('other', array('id' => 1))->row_array();
            $DataCustomerNya = $this->db->get_where('customer', array('customer_id' => $customer_id))->row_array();
            $DataCoverageNya = $this->db->get_where('coverage', array('coverage_id' => $coverage_id))->row_array();
            $alamat_lengkap = $DataCoverageNya['complete'];
            $email = $this->input->post('email', true);
            $pass_text = $this->input->post('password2', true);
            $name = $this->input->post('name', true);
            $gender = $this->input->post('gender', true);
            $saldo = $this->input->post('saldo', true);
            $refferal = $this->input->post('refferal', true);
            $no_services = $this->input->post('no_services', true);
            $phone = $this->input->post('no_wa', true);

            $this_iditem1 = $post['paket'];
            $datapaket1 = $this->db->get_where('package_item', array('p_item_id' => $this_iditem1))->row_array();
            $paket_pppoe = $datapaket1['paket_wifi'];
            $datapaket = $this->db->get_where('package_item', array('p_item_id' => $post['paket']))->row_array();
            $paket = $datapaket['paket_wifi'];
            $tagihan = $datapaket['price'];
            $item = $this->db->get_where('package_item', ['p_item_id' => $post['paket']])->row_array();

            if ($post['username'] == '' || $post['username'] == NULL) {
                $usernamenya = 'belum diatur';
            } else {
                $usernamenya = $post['username'];
            }
            if ($post['password'] == '' || $post['password'] == NULL) {
                $passwordnya = 'belum diatur';
            } else {
                $passwordnya = $post['password'];
            }

            $register_date = date('Y-m-d');
            $mytanggal = date('d');
            $latitudenya  = substr($post['latitude'], 0, 9);
            $longitudenya = substr($post['longitude'], 0, 9);

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
            $tgl_sekarang = date('d/m/Y H:i:s') . ' WIB';

            $config['upload_path']          = './assets/images/ktp';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 2048; // 2 Mb
            $config['file_name']            = 'ktp-' . $post['no_services'];
    		$config['overwrite']            = true;
    		$config['max_size']             = 1024; // 1MB
    		$config['max_width']            = 1080;
    		$config['max_height']           = 1080;
    
    		$this->load->library('upload', $config);
            $this->upload->initialize($config);
    		if (!$this->upload->do_upload('ktp')) {
                $ktpnya =  $DataCustomerNya['ktp'];
    		} else {
    			$ktpnya =  $this->upload->data('file_name');
    			$mypath = './assets/images/ktp/ktp-' . $post['no_services'];
    			unlink($mypath);
            }

            $date_created = time();

            if ($post['prorata'] == 1) {
                $remark_sekarang  = 'DISKON TAGIHAN PRORATA';
                $tagihan_sekarang = $tagihan;
                $hitung_tagihan   = ($tagihan / 30) * $post['hitung'];
                $diskon_sekarang  = $tagihan_sekarang - $hitung_tagihan;
                $total_sekarang   = $tagihan_sekarang - $diskon_sekarang;
            } else {
                $remark_sekarang  = '-';
                $tagihan_sekarang = $tagihan;
                $diskon_sekarang  = 0;
                $total_sekarang   = $tagihan;
            }

            $datacampaign = [
                'nama_pelanggan'   => $post['name'],
                'nomor_whatsapp'   => $post['no_wa'],
                'tanggal_reminder' => $reminder,
                'update_campaign'  => $tgl_sekarang,
            ];
            $this->db->where('nomor_services', $post['no_services']);
            $this->db->update('campaign', $datacampaign);

            $dataservices = [
                'price'  => $tagihan,
                'total'  => $tagihan,
                'remark' => $post['jenis'],
            ];
            $this->db->where('no_services', $post['no_services']);
            $this->db->update('services', $dataservices);

            $insertdatacustomer = [
                'name' => htmlspecialchars($post['name']),
                'no_services' => $post['no_services'],
                'item_paket' => $post['paket'],
                'username' => $usernamenya,
                'password' => $passwordnya,
                'paket_wifi' => $post['paket_wifi'],
                'prorata' => $post['prorata'],
                'hitung' => $post['hitung'],
                'telat' => $post['telat'],
                'tagihan' => $tagihan,
                'router' => $post['router'],
                'mode' => $post['mode'],
                'ip_address' => $post['ip_address'],
                'code_unique' => $post['code_unique'],
                'server' => $post['server'],
                'upload' => $post['upload'],
                'download' => $post['download'],
                'jenis' => $post['jenis'],
                'kode_odp' => $post['kode_odp'],
                'port_odp' => $post['port_odp'],
                'email' => $post['email'],
                'register_date' => $post['register_date'],
                'pemilik_rumah' => $post['pemilik_rumah'],
                'address' => $post['address'],
                'complete' => $alamat_lengkap,
                'latitude' => $latitudenya,
                'longitude' => $longitudenya,
                'no_wa' => $post['no_wa'],
                'type_id' => $post['type_id'],
                'no_ktp' => $post['no_ktp'],
                'ktp' => $ktpnya,
                'c_status' => $post['c_status'],
                'ppn' => $post['ppn'],
                'coverage' => $post['coverage'],
                'due_date' => $post['due_date'],
                'refferal' => $post['refferal'],
                'keterangan' => $post['keterangan'],
            ];
            $this->db->where('customer_id', $customer_id);
            $this->db->update('customer', $insertdatacustomer);

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data Pelanggan berhasil diperbaharui dengan upload gambar ID Card !!!');
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $this->session->set_flashdata('success', 'Data Pelanggan berhasil diperbaharui tanpa upload gambar ID Card !!!');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function editCustomer($no_services)
    {
        if ($this->session->userdata('role_id') != 1) {
            $this->session->set_flashdata('error', 'Akses dilarang');
            redirect('dashboard');
        }
        is_logged_in();
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('no_ktp', 'No KTP', 'trim');
        $this->form_validation->set_rules('no_wa', 'No Whatsapp', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_message('required', '%s Tidak boleh kosong, Silahkan isi');
        if ($this->form_validation->run() == false) {
            $query  = $this->customer_m->getCustomerServices($no_services);
            if ($query->num_rows() > 0) {
                $data['customer'] = $query->row();
                $data['title'] = 'Edit Customer';
                $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
                $company = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
                $data['coverage'] = $this->db->get_where('coverage', array('kategori' => 'AREA'))->result();
                $data['router'] = $this->router_m->get()->result();
                $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
                $config['map_div_id'] = "map-add";
                $config['map_height'] = "250px";
                $customer = $this->db->get_where('customer', array('no_services' => $no_services))->row_array();
                if ($customer['latitude'] == '' || $customer['latitude'] == NULL) {
                    $config['center'] = $company['latitude'] . ',' . $company['longitude'];
                } else {
                    $config['center'] = $customer['latitude'] . ',' . $customer['longitude'];
                }
                $config['zoom'] = '12';
                $config['map_height'] = '400px;';
                $config['map_type'] = 'HYBRID';
                $this->googlemaps->initialize($config);
                $marker = array();
                if ($customer['latitude'] == '' || $customer['latitude'] == NULL) {
                    $marker['position'] = $company['latitude'] . ',' . $company['longitude'];
                } else {
                    $marker['position'] = $customer['latitude'] . ',' . $customer['longitude'];
                }
                $marker['draggable'] = true;
                $marker['ondragend'] = 'setMapToForm(event.latLng.lat(), event.latLng.lng());';
                $this->googlemaps->add_marker($marker);
                $data['map'] = $this->googlemaps->create_map();
                $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
                $MyThemes = $MyCompanyData['tm_backend'];
                $this->template->load($MyThemes, 'backend/customer/edit_customer', $data);
            } else {
                echo "<script> alert ('Data tidak ditemukan');";
                redirect('customer');
            }
        } else {
            $this_iditem1 = $this->input->post('paket', true);
            $coverage_id  = $this->input->post('coverage', true);
            $customer_id  = $this->input->post('customer_id', true);
            $post = $this->input->post(null, TRUE);
            $datapaket1 = $this->db->get_where('package_item', array('p_item_id' => $this_iditem1))->row_array();
            $paket_pppoe = $datapaket1['paket_wifi'];
            $datapackage  = $this->db->get_where('package_item', array('p_item_id' => $this_iditem1))->row_array();
            $category_id  = $datapackage['category_id'];
            $datacategory = $this->db->get_where('package_category', array('p_category_id' => $category_id))->row_array();
            $kategorinya  = $datacategory['name'];
            $other  = $this->db->get_where('other', array('id' => 1))->row_array();
            $DataCustomerNya = $this->db->get_where('customer', array('customer_id' => $customer_id))->row_array();
            $DataCoverageNya = $this->db->get_where('coverage', array('coverage_id' => $coverage_id))->row_array();
            $alamat_lengkap = $DataCoverageNya['complete'];
            $email = $this->input->post('email', true);
            $pass_text = $this->input->post('password2', true);
            $name = $this->input->post('name', true);
            $gender = $this->input->post('gender', true);
            $saldo = $this->input->post('saldo', true);
            $refferal = $this->input->post('refferal', true);
            $no_services = $this->input->post('no_services', true);
            $phone = $this->input->post('no_wa', true);

            $this_iditem1 = $post['paket'];
            $datapaket1 = $this->db->get_where('package_item', array('p_item_id' => $this_iditem1))->row_array();
            $paket_pppoe = $datapaket1['paket_wifi'];
            $datapaket = $this->db->get_where('package_item', array('p_item_id' => $post['paket']))->row_array();
            $paket = $datapaket['paket_wifi'];
            $tagihan = $datapaket['price'];
            $item = $this->db->get_where('package_item', ['p_item_id' => $post['paket']])->row_array();

            if ($post['username'] == '' || $post['username'] == NULL) {
                $usernamenya = 'belum diatur';
            } else {
                $usernamenya = $post['username'];
            }
            if ($post['password'] == '' || $post['password'] == NULL) {
                $passwordnya = 'belum diatur';
            } else {
                $passwordnya = $post['password'];
            }

            $register_date = date('Y-m-d');
            $mytanggal = date('d');
            $latitudenya  = substr($post['latitude'], 0, 9);
            $longitudenya = substr($post['longitude'], 0, 9);

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
            $tgl_sekarang = date('d/m/Y H:i:s') . ' WIB';

            if ($post['jenis'] == 'PRABAYAR') {
                $bulan_invoice = date('m');
                $tahun_invoice = date('Y');
            } else {
                $hitung_bulan = date('m') + 1;
                if ($hitung_bulan > 0 && $hitung_bulan < 10) {
                    $bulan_invoice = '0' . $hitung_bulan;
                    $tahun_invoice = date('Y');
                } elseif ($hitung_bulan >= 10 && $hitung_bulan < 12) {
                    $bulan_invoice = $hitung_bulan;
                    $tahun_invoice = date('Y');
                } else {
                    $hitung_tahun  = date('Y') + 1;
                    $bulan_invoice = $hitung_bulan;
                    $tahun_invoice = $hitung_tahun;
                }
            }

            $config['upload_path']          = './assets/images/ktp';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 2048; // 2 Mb
            $config['file_name']             = 'ktp-' . $post['no_services'];
            $this->load->library('upload', $config);
            if ($_FILES['ktp']['name'] != null) {
                if ($this->upload->do_upload('ktp')) {
                    $ktpnya =  $this->upload->data('file_name');
                } else {
                    $ktpnya =  $DataCustomerNya['ktp'];
                }
            }

            $image = $ktpnya;
            $role_id = $post['role_id'];
            if ($post['c_status'] == 'Aktif') {
                $is_active = 1;
            } else {
                $is_active = 0;
            }
            $date_created = time();

            if ($post['prorata'] == 1) {
                $remark_sekarang  = 'DISKON TAGIHAN PRORATA';
                $tagihan_sekarang = $tagihan;
                $hitung_tagihan   = ($tagihan / 30) * $post['hitung'];
                $diskon_sekarang  = $tagihan_sekarang - $hitung_tagihan;
                $total_sekarang   = $tagihan_sekarang - $diskon_sekarang;
            } else {
                $remark_sekarang  = '-';
                $tagihan_sekarang = $tagihan;
                $diskon_sekarang  = 0;
                $total_sekarang   = $tagihan;
            }

            $insertdatacustomer = [
                'name' => htmlspecialchars($post['name']),
                'no_services' => $post['no_services'],
                'item_paket' => $post['paket'],
                'username' => $usernamenya,
                'password' => $passwordnya,
                'paket_wifi' => $post['paket_wifi'],
                'prorata' => $post['prorata'],
                'hitung' => $post['hitung'],
                'telat' => 0,
                'tagihan' => $tagihan,
                'router' => $post['router'],
                'mode' => $post['mode'],
                'ip_address' => $post['ip_address'],
                'code_unique' => $post['code_unique'],
                'server' => $post['server'],
                'upload' => $post['upload'],
                'download' => $post['download'],
                'jenis' => $post['jenis'],
                'kode_odp' => $post['kode_odp'],
                'port_odp' => $post['port_odp'],
                'email' => $post['email'],
                'register_date' => $post['register_date'],
                'pemilik_rumah' => $post['pemilik_rumah'],
                'address' => $post['address'],
                'complete' => $alamat_lengkap,
                'latitude' => $latitudenya,
                'longitude' => $longitudenya,
                'no_wa' => $post['no_wa'],
                'type_id' => $post['type_id'],
                'no_ktp' => $post['no_ktp'],
                'ktp' => $ktpnya,
                'c_status' => $post['c_status'],
                'ppn' => $post['ppn'],
                'coverage' => $post['coverage'],
                'due_date' => $post['due_date'],
                'refferal' => $post['refferal'],
                'keterangan' => $post['keterangan'],
            ];
            $this->db->where('customer_id', $customer_id);
            $this->db->update('customer', $insertdatacustomer);

            $datacampaign = [
                'nama_pelanggan'   => $post['name'],
                'nomor_whatsapp'   => $post['no_wa'],
                'tanggal_reminder' => $reminder,
                'update_campaign'  => $tgl_sekarang,
            ];
            $this->db->where('nomor_services', $post['no_services']);
            $this->db->update('campaign', $datacampaign);

            $dataservices = [
                'price'  => $tagihan,
                'total'  => $tagihan,
                'remark' => $post['jenis'],
            ];
            $this->db->where('no_services', $post['no_services']);
            $this->db->update('services', $dataservices);

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data Pelanggan berhasil diperbaharui');
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $this->session->set_flashdata('error', 'Data Pelanggan gagal diperbaharui');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function detail($no_services)
    {
    }

    function email_check()
    {
        $post = $this->input->post(null, TRUE);
        $query = $this->db->query("SELECT * FROM customer WHERE email = '$post[email]' AND customer_id != '$post[customer_id]'");
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('email_check', '%s Ini sudah dipakai, Silahkan ganti !');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function no_wa_check()
    {
        $post = $this->input->post(null, TRUE);
        $query = $this->db->query("SELECT * FROM customer WHERE no_wa = '$post[no_wa]' AND customer_id != '$post[customer_id]'");
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('no_wa_check', '%s Ini sudah dipakai, Silahkan ganti !');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function no_ktp_check()
    {
        $post = $this->input->post(null, TRUE);
        $query = $this->db->query("SELECT * FROM customer WHERE no_ktp = '$post[no_ktp]' AND customer_id != '$post[customer_id]'");
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('no_ktp_check', '%s Ini sudah dipakai, Silahkan ganti !');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function delete()
    {
        $customer_id = $this->input->post('customer_id');
        $no_services = $this->input->post('no_services');
        $customer = $this->db->get_where('customer', ['no_services' => $no_services])->row_array();
        if ($customer['ktp'] != null) {
            $target_file = './assets/images/ktp/' . $customer['ktp'];
            unlink($target_file);
        }
        
        $this->db->where('nomor_services', $no_services);
        $this->db->delete('campaign');
        
        $this->db->where('nomor_services', $no_services);
        $this->db->delete('transfer');
        
        $this->db->where('nomor_layanan', $no_services);
        $this->db->delete('layanan');
        
        $this->db->where('nomor_services', $no_services);
        $this->db->delete('kasbon');
        
        $this->db->where('no_services', $no_services);
        $this->db->delete('invoice');
        
        $this->db->where('no_services', $no_services);
        $this->db->delete('services');
        
        $this->db->where('no_services', $no_services);
        $this->db->delete('bonus');
        
        $this->db->where('no_services', $no_services);
        $this->db->delete('confirm_payment');
        
        $this->db->where('no_services', $no_services);
        $this->db->delete('user');
        
        $this->db->where('d_no_services', $no_services);
        $this->db->delete('invoice_detail');
        
        $this->db->where('no_services', $no_services);
        $this->db->delete('invoice_create');
        
        $this->db->where('no_services', $no_services);
        $this->db->delete('invoice_create');
        
        $this->db->where('no_services', $no_services);
        $this->db->delete('package_log');
        
        $this->db->where('no_services', $no_services);
        $this->db->delete('saldo');
        
        $this->db->where('no_services', $no_services);
        $this->db->delete('income');
        
        $this->db->where('no_services', $no_services);
        $this->db->delete('expenditure');
        
        $this->db->where('no_services', $no_services);
        $this->db->delete('gaji');
        
        $this->db->where('no_services', $no_services);
        $this->db->delete('hotspot');
        
        $this->db->where('no_services', $no_services);
        $this->db->delete('pengeluaran');
        
        $this->db->where('no_services', $no_services);
        $this->db->delete('pemasukan');
        
        $this->db->where('no_services', $no_services);
        $this->db->delete('customer');
        
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Pelanggan Berhasil Dihapus');
        }else{
            $this->session->set_flashdata('error', 'Data Pelanggan Gagal Dihapus');
        }
        redirect('customer');
    }
}
