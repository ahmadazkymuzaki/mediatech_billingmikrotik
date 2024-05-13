<?php defined('BASEPATH') or exit('No direct script access allowed');

class Reseller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model(['reseller_m', 'promo_m', 'member_m', 'message_m', 'product_m', 'package_m',  'setting_m', 'services_m', 'customer_m', 'bill_m', 'income_m']);
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['other'] = $this->db->get('other')->row_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $this->template->load('reseller', 'reseller/index', $data);
    }
    public function bantuan()
    {
        $data['title'] = 'Bantuan';
        $data['other'] = $this->db->get('other')->row_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $this->template->load('reseller', 'reseller/bantuan', $data);
    }
    public function pengaduan()
    {
        $data['title'] = 'Pengaduan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $this->template->load('reseller', 'reseller/pengaduan', $data);
    }
    public function kirim()
    {
        $data['title'] = 'Kirim Pengaduan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $tiket_pesan = $this->input->post('tiket_pesan');
        $user_pengirim = $this->input->post('user_pengirim');
        $user_penerima = $this->input->post('user_penerima');
        $judul_pesan = $this->input->post('judul_pesan');
        $konten_pesan = $this->input->post('konten_pesan');
        $waktu_kirim = $this->input->post('waktu_kirim');
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
        $this->session->set_flashdata('success', 'Pesan Pengaduan telah Terkirim.');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function enable()
    {
        $data['title'] = 'Enable Voucher';
        $data['other'] = $this->db->get('other')->row_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $this->template->load('reseller', 'reseller/enable', $data);
    }
    public function listvoucher()
    {
        $data['title'] = 'Daftar Voucher';
        $data['other'] = $this->db->get('other')->row_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $this->template->load('reseller', 'reseller/list', $data);
    }
    public function voucher()
    {
        $data['title'] = 'Create Voucher';
        $data['other'] = $this->db->get('other')->row_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
        $API = new routeros();
        $host = $myrouter['host_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $port = $myrouter['port_router'];
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

        $this->template->load('reseller', 'reseller/voucher', $data + $dataku);
    }
    public function addvoucher()
    {
        $data['title'] = 'Tambah Voucher';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $server_hotspot = $this->input->post('server_hotspot');
        $paket_hotspot = $this->input->post('paket_hotspot');
        $user_hotspot = $this->input->post('user_hotspot');
        $pass_hotspot = $this->input->post('pass_hotspot');
        $create_hotspot = $this->input->post('create_hotspot');
        $time_hotspot = $this->input->post('time_hotspot');
        $status_hotspot = $this->input->post('status_hotspot');
        $whatsappku = $this->input->post('whatsapp');
        $whatsapp = $this->db->get('whatsapp')->row_array();

        $link = $whatsapp['url_web'];
        $create_hotspotku = urlencode($create_hotspot);
        $paket_hotspotku = urlencode($paket_hotspot);
        $user_hotspotku = urlencode($user_hotspot);
        $server_hotspotku = urlencode($server_hotspot);
        $pass_hotspotku = urlencode($pass_hotspot);
        $time_hotspotku = urlencode($time_hotspot);
        $nomor = $whatsappku;
        $pesan = '*' . $create_hotspotku . '*%20Membuat%20Voucher%0Adengan%20Paket%20:%20*' . $paket_hotspotku . '*%0Adengan%20Username%20:%20*' . $user_hotspotku . ' (' . $server_hotspotku . ')*%0Adengan%20Password%20:%20*' . $pass_hotspotku . '*%0APada%20:%20*' . $time_hotspotku . '%20WIB*%0Amohon%20segera%20*CHECK*';
        $url = $link . 'send.php?nomor=' . $nomor . '&pesan=' . $pesan;

        file_get_contents($url);
        $send = curl_init($url);
        $result = curl_exec($send);
        curl_close($send);

        $cek = $this->db->get_where('hotspot', ['user_hotspot' => $this->input->post('user_hotspot')])->num_rows();
        if ($cek > 0) {
            $this->session->set_flashdata('error', 'Akun Voucher Tersebut SUDAH ADA !');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $array = [
                'server_hotspot' => $server_hotspot,
                'paket_hotspot' => $paket_hotspot,
                'user_hotspot' => $user_hotspot,
                'pass_hotspot' => $pass_hotspot,
                'create_hotspot' => $create_hotspot,
                'time_hotspot' => $time_hotspot,
                'status_hotspot' => $status_hotspot,
            ];

            $this->db->insert('hotspot', $array);
            $this->session->set_flashdata('success', $result . ' Voucher berhasil Ditambah.');
            redirect('reseller/voucher');
        }
    }

    public function enablevoucher()
    {
        $post = $this->input->post(null, true);
        $data['title'] = 'Tambah Voucher';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
        $API = new routeros();
        $host = $myrouter['host_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $port = $myrouter['port_router'];
        $API->connect($host, $port, $user, $pass);

        $API->comm("/ip/hotspot/user/add", array(
            "name" => $post['user_hotspot'],
            "password" => $post['pass_hotspot'],
            "profile" => $post['paket_hotspot'],
            "server" => $post['server_hotspot'],
        ));

        $this->db->set('status_hotspot', 'Aktif');
        $this->db->where('user_hotspot', $post['user_hotspot']);
        $this->db->update('hotspot');

        $this->session->set_flashdata('success', 'Voucher berhasil Diaktifkan.');
        redirect($_SERVER['HTTP_REFERER']);

        $API->disconnect();
    }
    public function promo()
    {
        $data['title'] = 'Profil Saya';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['promo'] = $this->promo_m->get()->result();
        $this->template->load('reseller', 'reseller/promo', $data);
    }
    public function profile()
    {
        $data['title'] = 'Profil Saya';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $this->template->load('reseller', 'reseller/profile', $data);
    }
    public function editprofile()
    {
        $data['title'] = 'Edit Profil';
        $config['upload_path'] = './assets/images/profile/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']     = '2048';
        $config['file_name']  = 'profile-' . $this->input->post('name') . '-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $image1 = $this->input->post('image1');
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $gender = $this->input->post('gender');
        $address = $this->input->post('address');
        $is_active = $this->input->post('is_active');

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
        $this->db->set('is_active', $is_active);
        $this->db->where('email', $email);
        $this->db->update('user');

        $this->session->set_flashdata('success', 'Profile berhasil Diperbarui');
        redirect('reseller/profile');
    }
    public function ubahpassword()
    {
        $data['title'] = 'Ubah Password';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('current_password', 'Password Sekarang', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'Password Yang Baru', 'required|trim|min_length[5]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Ulangi Password Baru', 'required|trim|min_length[5]|matches[new_password1]');
        if ($this->form_validation->run() == false) {
            $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
            $this->template->load('reseller', 'reseller/profile', $data);
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('error', 'Password lama salah !');
                redirect('reseller/profile');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('error', 'Password baru tidak boleh sama dengan password lama!');
                    redirect('reseller/profile');
                } else {
                    // password benar
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');
                    $this->session->set_flashdata('success', 'Password baru sudah diperbaharui!');
                    redirect('reseller/profile');
                }
            }
        }
    }
    public function company()
    {
        $data['title'] = 'Company';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $this->template->load('reseller', 'reseller/company', $data);
    }
}
