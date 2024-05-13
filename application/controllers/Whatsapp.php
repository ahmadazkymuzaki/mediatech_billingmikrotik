<?php defined('BASEPATH') or exit('No direct script access allowed');

class whatsapp extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function setting()
    {
        $data['title'] = 'Setting WhatsApp';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['whatsapp'] = $this->db->get('whatsapp')->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/whatsapp/setting', $data);
    }

    public function cronjob()
    {
        $data['title'] = 'Cronjob WhatsApp';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/whatsapp/cronjob', $data);
    }

    public function aturcronjob()
    {
        $kategori   = $this->input->post('kategori');
        $interval   = $this->input->post('interval');
        $start_date = $this->input->post('start_date');
        $status     = $this->input->post('status');
        $tanggal    = $this->input->post('tanggal');
        $comment    = 'Dibuat Oleh : BILLING versi PRO 2.4';
        $start_time = $this->input->post('start_time') . ':00';
        $script     = '/tool fetch http-method=post url="' . $this->input->post('script') . '" mode=http keep-result=no;';
        $periode    = substr($start_date, 0, 3) . '/' . $tanggal . '/' . substr($start_date, 7, 4);

        $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
        $host = $myrouter['host_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $port = $myrouter['port_router'];

        $API = new routeros();
        $API->connect($host, $port, $user, $pass);

        $API->comm("/system/scheduler/add", array(
            "name" => $kategori,
            "start-date" => $periode,
            "start-time" => $start_time,
            "interval" => $interval,
            "on-event" => $script,
            "comment" => $comment
        ));
        $this->session->set_flashdata('success', 'Cronjob WhatsApp berhasil di Aktifkan');
        redirect($_SERVER['HTTP_REFERER']);
        $API->disconnect();
    }

    public function resetcronjob($kategori)
    {
        $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
        $host = $myrouter['host_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $port = $myrouter['port_router'];

        $API = new routeros();
        $API->connect($host, $port, $user, $pass);

        $autohapus    = $API->comm("/system/scheduler/print", array(
            '?name'   => $kategori
        ));
        $autohapus2   = json_encode($autohapus);
        $autohapus3   = json_decode($autohapus2, true);
        $id_scheduler = $autohapus3['0']['.id'];

        $API->comm("/system/scheduler/remove", array(
            '.id' => $id_scheduler,
        ));
        $this->session->set_flashdata('success', 'Cronjob WhatsApp berhasil di Non-Aktifkan');
        redirect($_SERVER['HTTP_REFERER']);
        $API->disconnect();
    }

    public function sending()
    {
        $data['title'] = 'Test Kirim WA';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/whatsapp/sending', $data);
    }

    public function massal()
    {
        $data['title'] = 'Kirim WA Massal';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/whatsapp/massal', $data);
    }

    public function campaign()
    {
        $data['title'] = 'WhatsApp Blaster';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['whatsapp'] = $this->db->get('whatsapp')->row_array();
        $data['campaign'] = $this->db->get_where('campaign', array('kategori_kontak' => 'PELANGGAN'))->result();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/whatsapp/campaign', $data);
    }

    public function sendingwhatsapp()
    {
        $whatsapp = $this->db->get('whatsapp')->row_array();
        $number   = $whatsapp['number'];
        $api_key  = $whatsapp['api_key'];
        $link_url = $whatsapp['link_url'];
        $nomor    = $this->input->post('nomor');
        $string   = $this->input->post('pesan');
        $pesan    = urlencode($string);

        $data = [
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
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $this->session->set_flashdata('success', 'Respon =>> ' . $response . ' <<=');
        curl_close($curl);
        redirect('whatsapp/sending');
    }

    public function sendingmassal()
    {
        $whatsapp = $this->db->get('whatsapp')->row_array();
        $number   = $whatsapp['number'];
        $api_key  = $whatsapp['api_key'];
        $link_url = $whatsapp['link_url'];
        $nomor    = $this->input->post('nomor');
        $pesan    = $this->input->post('pesan');
        $role_id  = $this->input->post('role_id');

        if ($role_id == 'PELANGGAN') {
            $data_pengguna = $this->db->get_where('campaign', array('kategori_kontak' => $role_id))->result();
            $jumlah_pengguna = $this->db->get_where('campaign', array('kategori_kontak' => $role_id))->num_rows();

            foreach ($data_pengguna as $pengguna) {
                $nomor = $pengguna->nomor_whatsapp;
                $data = [
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
                    CURLOPT_POSTFIELDS => json_encode($data),
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                ));
                $response = curl_exec($curl);
            }
            curl_close($curl);
        }
        if ($role_id == 'KARYAWAN') {
            $data_pengguna = $this->db->get_where('campaign', array('kategori_kontak' => $role_id))->result();
            $jumlah_pengguna = $this->db->get_where('campaign', array('kategori_kontak' => $role_id))->num_rows();

            foreach ($data_pengguna as $pengguna) {
                $nomor = $pengguna->nomor_whatsapp;
                $data = [
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
                    CURLOPT_POSTFIELDS => json_encode($data),
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                ));
                $response = curl_exec($curl);
            }
            curl_close($curl);
        }
        if ($role_id == 'OPERATOR') {
            $data_pengguna = $this->db->get_where('campaign', array('kategori_kontak' => $role_id))->result();
            $jumlah_pengguna = $this->db->get_where('campaign', array('kategori_kontak' => $role_id))->num_rows();

            foreach ($data_pengguna as $pengguna) {
                $nomor = $pengguna->nomor_whatsapp;
                $data = [
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
                    CURLOPT_POSTFIELDS => json_encode($data),
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                ));
                $response = curl_exec($curl);
            }
            curl_close($curl);
        }
        if ($role_id == 'RESELLER') {
            $data_pengguna = $this->db->get_where('campaign', array('kategori_kontak' => $role_id))->result();
            $jumlah_pengguna = $this->db->get_where('campaign', array('kategori_kontak' => $role_id))->num_rows();

            foreach ($data_pengguna as $pengguna) {
                $nomor = $pengguna->nomor_whatsapp;
                $data = [
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
                    CURLOPT_POSTFIELDS => json_encode($data),
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                ));
                $response = curl_exec($curl);
            }
            curl_close($curl);
        }
        if ($role_id == 'SALES') {
            $data_pengguna = $this->db->get_where('campaign', array('kategori_kontak' => $role_id))->result();
            $jumlah_pengguna = $this->db->get_where('campaign', array('kategori_kontak' => $role_id))->num_rows();

            foreach ($data_pengguna as $pengguna) {
                $nomor = $pengguna->nomor_whatsapp;
                $data = [
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
                    CURLOPT_POSTFIELDS => json_encode($data),
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                ));
                $response = curl_exec($curl);
            }
            curl_close($curl);
        }
        if ($role_id == 'SERVICE') {
            $data_pengguna = $this->db->get_where('campaign', array('kategori_kontak' => $role_id))->result();
            $jumlah_pengguna = $this->db->get_where('campaign', array('kategori_kontak' => $role_id))->num_rows();

            foreach ($data_pengguna as $pengguna) {
                $nomor = $pengguna->nomor_whatsapp;
                $data = [
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
                    CURLOPT_POSTFIELDS => json_encode($data),
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                ));
                $response = curl_exec($curl);
            }
            curl_close($curl);
        }
        if ($role_id == 'TAMBAHAN') {
            $data_pengguna = $this->db->get_where('campaign', array('kategori_kontak' => $role_id))->result();
            $jumlah_pengguna = $this->db->get_where('campaign', array('kategori_kontak' => $role_id))->num_rows();

            foreach ($data_pengguna as $pengguna) {
                $nomor = $pengguna->nomor_whatsapp;
                $data = [
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
                    CURLOPT_POSTFIELDS => json_encode($data),
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                ));
                $response = curl_exec($curl);
            }
            curl_close($curl);
        }
        if ($role_id == 'GRUP WA') {
            $data_pengguna = $this->db->get_where('campaign', array('kategori_kontak' => $role_id))->result();
            $jumlah_pengguna = $this->db->get_where('campaign', array('kategori_kontak' => $role_id))->num_rows();

            foreach ($data_pengguna as $pengguna) {
                $nomor = $pengguna->nomor_whatsapp;
                $data = [
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
                    CURLOPT_POSTFIELDS => json_encode($data),
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                ));
                $response = curl_exec($curl);
            }
            curl_close($curl);
        }
        if ($role_id == 'SELURUH') {
            $data_pengguna = $this->db->get('campaign')->result();
            $jumlah_pengguna = $this->db->get('campaign')->num_rows();

            foreach ($data_pengguna as $pengguna) {
                $nomor = $pengguna->nomor_whatsapp;
                $data = [
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
                    CURLOPT_POSTFIELDS => json_encode($data),
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                ));
                $response = curl_exec($curl);
            }
            curl_close($curl);
        } else {
            $data_pengguna = $this->db->get_where('customer', ['coverage' => $role_id])->result();
            $jumlah_pengguna = $this->db->get_where('customer', ['coverage' => $role_id])->num_rows();

            foreach ($data_pengguna as $pengguna) {
                $nomor = $pengguna->no_wa;
                $data = [
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
                    CURLOPT_POSTFIELDS => json_encode($data),
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                ));
                $response = curl_exec($curl);
            }
            curl_close($curl);
        }
        $this->session->set_flashdata('success', 'Pesan Massal berhasil Dikirim ke Pelanggan sebanyak (' . $jumlah_pengguna . ' pesan)');
        redirect('whatsapp/massal');
    }

    public function autoreply()
    {
        $data['title'] = 'Balas Otomatis';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['autoreply'] = $this->Whatsapp_m->getAllReply();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/whatsapp/reply', $data);
    }

    public function tambahAutoReply()
    {
        $data['title'] = 'Tambah Karyawan'; // Judul link
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $array = [
            'keyword' => html_escape($this->input->post('keyword', true)),
            'response' => html_escape($this->input->post('response', true)),
            'status' => html_escape($this->input->post('status', true)),
        ];

        $this->db->insert('autoreply', $array);

        $this->session->set_flashdata('success', 'Data Auto Reply berhasil Ditambah');
        redirect('whatsapp/autoreply');
    }

    public function hapusAutoReply($id)
    {
        $result = $this->db->get_where('autoreply', ['id_reply' => $id])->row_array();
        $this->db->where('id_reply', $id);
        $this->db->delete('autoreply');

        $this->session->set_flashdata('success', 'Data Auto Reply berhasil Dihapus');
        redirect('whatsapp/autoreply');
    }

    public function contact()
    {
        $data['title'] = 'Kontak WhatsApp';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['campaign'] = $this->db->get_where('campaign')->result();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/whatsapp/contact', $data);
    }

    public function tambahContact()
    {
        $data['title'] = 'Tambah Kontak'; // Judul link
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $array = [
            'nama_pelanggan' => html_escape($this->input->post('nama_pelanggan', true)),
            'nomor_whatsapp' => html_escape($this->input->post('nomor_whatsapp', true)),
            'kategori_kontak' => html_escape($this->input->post('kategori_kontak', true)),
            'update_campaign' => html_escape(date('d/m/Y H:i:s') . ' WIB'),
        ];

        $this->db->insert('campaign', $array);

        $this->session->set_flashdata('success', 'Data Kontak berhasil Ditambah');
        redirect('whatsapp/contact');
    }

    public function hapusContact($id_campaign)
    {
        $this->db->where('id_campaign', $id_campaign);
        $this->db->delete('campaign');

        $this->session->set_flashdata('success', 'Data Kontak berhasil Dihapus');
        redirect('whatsapp/contact');
    }

    public function edit($id_whatsapp)
    {
        $tgl_sekarang = date('d/m/Y H:i:s') . ' WIB';
        $data['title'] = 'Edit Whatsapp';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $this->db->set('url_web', $this->input->post('url_web'));
        $this->db->set('number', $this->input->post('number'));
        $this->db->set('admin', $this->input->post('admin'));
        $this->db->set('api_key', $this->input->post('api_key'));
        $this->db->set('link_url', $this->input->post('link_url'));
        $this->db->set('update', $tgl_sekarang);
        $this->db->where('id_whatsapp', $id_whatsapp);
        $this->db->update('whatsapp');
        $this->session->set_flashdata('success', 'Data Akun Whatsapp Berhasil Diperbaharui.');
        redirect('whatsapp/setting');
    }
}
