<?php defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model(['karyawan_model', 'message_m', 'product_m', 'package_m',  'setting_m', 'services_m', 'customer_m', 'bill_m', 'income_m']);
    }

    public function editpesan()
    {
        $data['title'] = 'Edit Pesan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $host_router = $this->input->post('host_router');
        $port_router = $this->input->post('port_router');
        $user_router = $this->input->post('user_router');
        $pass_router = $this->input->post('pass_router');
        $description = $this->input->post('description');
        $this->db->set('host_router', $host_router);
        $this->db->set('port_router', $port_router);
        $this->db->set('user_router', $user_router);
        $this->db->set('pass_router', $pass_router);
        $this->db->set('description', $description);
        $this->db->update('router');
        $this->session->set_flashdata('success', 'Router sudah diperbaharui.
      ');
        redirect('message/data');
    }

    public function masuk()
    {
        $data['title'] = 'Pesan Masuk';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['message'] = $this->db->get_where('message', ['user_penerima' => $this->session->userdata('email')])->row_array();
        $this->template->load('karyawan', 'karyawan/message/masuk', $data);
    }

    public function keluar()
    {
        $data['title'] = 'Pesan Keluar';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['message'] = $this->db->get_where('message', ['user_penerima' => $this->session->userdata('email')])->row_array();
        $this->template->load('karyawan', 'karyawan/message/keluar', $data);
    }

    public function detail($id)
    {
        $data['title'] = 'Detail Pengaduan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['message'] = $this->db->get_where('message', ['message_id' => $id])->row_array();

        $this->template->load('karyawan', 'karyawan/message/detail', $data);
    }
    public function deletepesan($id)
    {
        $this->db->get_where('message', ['message_id' => $id])->row_array();
        $this->message_m->deletepesan($id);
        $this->session->set_flashdata('success', 'Pesan berhasil dihapus.
      ');
        redirect('message/data');
    }
    public function belum_dibaca($id)
    {
        $data['title'] = 'Edit Pesan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $status_message = 'belum dibaca';
        $this->db->set('status_message', $status_message);
        $this->db->where('message_id', $id);
        $this->db->update('message');
        $this->session->set_flashdata('success', 'Status Pesan sudah diperbaharui.
      ');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function sudah_dibaca($id)
    {
        $data['title'] = 'Edit Pesan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $status_message = 'sudah dibaca';
        $this->db->set('status_message', $status_message);
        $this->db->where('message_id', $id);
        $this->db->update('message');
        $this->session->set_flashdata('success', 'Status Pesan sudah diperbaharui.
      ');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function kirim()
    {
        $data['title'] = 'Edit Router';
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
        $this->session->set_flashdata('success', 'Pesan sudah dikirim.');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['karyawan'] = $this->db->get_where('karyawan', ['id_user' => $this->session->userdata('id')])->row_array();
        $this->template->load('karyawan', 'karyawan/dashboard', $data);
    }
    public function history()
    {
        $data['title'] = 'History';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['kehadiran'] = $this->db->get('kehadiran')->row_array();
        $this->template->load('karyawan', 'karyawan/history', $data);
    }
    public function profile()
    {
        $data['title'] = 'Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $this->template->load('karyawan', 'karyawan/profile', $data);
    }

    public function hapus($tanggal)
    {
        $result = $this->db->get_where('absensi', ['tanggal' => $tanggal])->row_array();
        $this->db->where('tanggal', $tanggal);
        $this->db->delete('absensi');

        $this->session->set_flashdata('success', 'Data Absensi berhasil Dihapus');
        redirect('absensi');
    }

    public function hadir()
    {
        $data['title'] = 'Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $this->template->load('karyawan', 'karyawan/hadir', $data);
    }
    public function addhadir()
    {
        $data['title'] = 'Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $tanggal = $this->input->post('tanggal');
        $kode = $this->input->post('kode');
        $absen = 'hadir';
        $durasi = '';
        $alasan = '';
        $waktu = $this->input->post('waktu');
        $pulang = '00:00:00';
        $ip_add = $this->input->post('ip_add');
        $pesan = '';
        $st_absen = 'diterima';
        $periode = $this->input->post('periode');

        $cek = $this->db->get_where('absensi', ['tanggal' => $this->input->post('tanggal')])->num_rows();
        if ($cek > 0) {
            $this->session->set_flashdata('error', 'Absen Hari Ini SUDAH ADA !');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $array = [
                'tanggal' => $tanggal,
                'periode' => $periode,
                'kode' => $kode,
                'absen' => $absen,
                'durasi' => $durasi,
                'alasan' => $alasan,
                'waktu' => $waktu,
                'pulang' => $pulang,
                'ip_add' => $ip_add,
                'pesan' => $pesan,
                'st_absen' => $st_absen,
            ];

            $this->db->insert('absensi', $array);
            $this->session->set_flashdata('success', 'Absen Hadir berhasil Ditambah.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function addpulang()
    {
        $data['title'] = 'Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $tanggal = $this->input->post('tanggal');
        $pulang = $this->input->post('pulang');

        $absensi = $this->db->get_where('absensi', array('tanggal' => $tanggal))->row_array();
        $masuk = $absensi['waktu'];
        $durasi = substr($pulang, 0, 2) - substr($masuk, 0, 2);

        $this->db->set('durasi', $durasi);
        $this->db->set('pulang', $pulang);
        $this->db->where('tanggal', $tanggal);
        $this->db->where('pulang', '00:00:00');
        $this->db->update('absensi');

        $this->session->set_flashdata('success', 'Absen Pulang berhasil Ditambah.');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function alasan()
    {
        $data['title'] = 'Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $tanggal = $this->input->post('tanggal');
        $pesan = $this->input->post('pesan');
        $st_absen = $this->input->post('st_absen');

        $this->db->set('pesan', $pesan);
        $this->db->set('st_absen', $st_absen);
        $this->db->where('tanggal', $tanggal);
        $this->db->update('absensi');

        $this->session->set_flashdata('success', 'Absen Karyawan berhasil Diperbarui.');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function sakit()
    {
        $data['title'] = 'Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $this->template->load('karyawan', 'karyawan/sakit', $data);
    }
    public function addsakit()
    {
        $data['title'] = 'Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $tanggal = $this->input->post('tanggal');
        $kode = $this->input->post('kode');
        $absen = 'sakit';
        $durasi = '';
        $alasan = $this->input->post('alasan');
        $waktu = $this->input->post('waktu');
        $pulang = '00:00:00';
        $ip_add = $this->input->post('ip_add');
        $pesan = '';
        $st_absen = 'pending';
        $periode = $this->input->post('periode');

        $cek = $this->db->get_where('absensi', ['tanggal' => $this->input->post('tanggal')])->num_rows();
        if ($cek > 0) {
            $this->session->set_flashdata('error', 'Absen Hari Ini SUDAH ADA !');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $array = [
                'tanggal' => $tanggal,
                'periode' => $periode,
                'kode' => $kode,
                'absen' => $absen,
                'durasi' => $durasi,
                'alasan' => $alasan,
                'waktu' => $waktu,
                'pulang' => $pulang,
                'ip_add' => $ip_add,
                'pesan' => $pesan,
                'st_absen' => $st_absen,
            ];

            $this->db->insert('absensi', $array);
            $this->session->set_flashdata('success', 'Absen Sakit berhasil Ditambah.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function izin()
    {
        $data['title'] = 'Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $this->template->load('karyawan', 'karyawan/izin', $data);
    }
    public function addizin()
    {
        $data['title'] = 'Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $tanggal = $this->input->post('tanggal');
        $kode = $this->input->post('kode');
        $absen = 'izin';
        $durasi = '';
        $alasan = $this->input->post('alasan');
        $waktu = $this->input->post('waktu');
        $pulang = '00:00:00';
        $ip_add = $this->input->post('ip_add');
        $pesan = '';
        $st_absen = 'pending';
        $periode = $this->input->post('periode');

        $cek = $this->db->get_where('absensi', ['tanggal' => $this->input->post('tanggal')])->num_rows();
        if ($cek > 0) {
            $this->session->set_flashdata('error', 'Absen Hari Ini SUDAH ADA !');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $array = [
                'tanggal' => $tanggal,
                'periode' => $periode,
                'kode' => $kode,
                'absen' => $absen,
                'durasi' => $durasi,
                'alasan' => $alasan,
                'waktu' => $waktu,
                'pulang' => $pulang,
                'ip_add' => $ip_add,
                'pesan' => $pesan,
                'st_absen' => $st_absen,
            ];

            $this->db->insert('absensi', $array);
            $this->session->set_flashdata('success', 'Absen Izin berhasil Ditambah.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function account()
    {
        $data['title'] = 'Account';
        $config['upload_path'] = './assets/images/profile/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']     = '2048';
        $config['file_name']  = 'profile-' . $this->input->post('name') . '-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('phone', 'Phone', 'required|trim|min_length[8]');
        $this->form_validation->set_rules('gender', 'Gender', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->template->load('karyawan', 'karyawan/account', $data);
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');
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
                    redirect('karyawan/account');
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

            $this->session->set_flashdata('success', 'Profil Kamu Berhasil Diperbarui !');
            redirect('karyawan/account');
        }
    }
    public function changepassword()
    {
        $data['title'] = 'Ganti Password';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[5]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm Password', 'required|trim|min_length[5]|matches[new_password1]');
        if ($this->form_validation->run() == false) {
            $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
            $this->template->load('karyawan', 'karyawan/changepassword', $data);
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('error', 'Password lama salah !');
                redirect('karyawan/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('error', 'Password baru tidak boleh sama dengan password lama!');
                    redirect('karyawan/changepassword');
                } else {
                    // password benar
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');
                    $this->session->set_flashdata('success', 'Password baru sudah diperbaharui!');
                    redirect('karyawan/changepassword');
                }
            }
        }
    }

    public function about()
    {
        $data['title'] = 'Tentang';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $this->template->load('karyawan', 'karyawan/about', $data);
    }
    public function testimoni()
    {
        $data['title'] = 'Testimoni';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $this->template->load('karyawan', 'karyawan/testimoni', $data);
    }


    public function addTestimoni()
    {
        $post = $this->input->post(null, TRUE);
        $this->karyawan_model->addTestimoni($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Terimakasih atas testimoni yang anda berikan kepada kami');
        }
        echo "<script>window.location='" . site_url('karyawan/testimoni') . "'; </script>";
    }

    public function editTestimoni()
    {
        $post = $this->input->post(null, TRUE);
        $this->karyawan_model->editTestimoni($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Terimakasih atas testimoni yang anda berikan kepada kami');
        }
        echo "<script>window.location='" . site_url('karyawan/testimoni') . "'; </script>";
    }

    public function invoice($invoice)
    {
        $data['title'] = 'Invoice';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
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
        $params['data'] = $invoice . '-' . $inv['no_services']; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
        $this->load->view('backend/bill/invoice', $data);
    }

    public function confirmpayment($invoice)
    {
        $data['title'] = 'Konfirmasi Pembayaran';
        $cekinvoice = $this->db->get_where('invoice', ['invoice' => $invoice])->row_array();
        if ($cekinvoice <= 0) {
            $this->session->set_flashdata('error', 'Invoice tidak ditemukan');
            echo "<script>window.location='" . site_url('karyawan/history') . "'; </script>";
        }
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['invoice'] = $this->bill_m->getEditInvoice($invoice);
        $data['bill'] = $this->karyawan_model->getInvoice($invoice)->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['other'] = $this->db->get('other')->row_array();
        $this->template->load('karyawan', 'karyawan/confirm-payment', $data);
    }
}
