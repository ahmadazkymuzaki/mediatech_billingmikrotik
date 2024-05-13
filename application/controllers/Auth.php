<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model(['customer_m']);
        $this->load->model('Auth_model');
    }

    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('dashboard');
        }
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
            $this->load->view('backend/auth/login', $data);
        } else {
            $this->_login();
        }
    }
    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $user = $this->db->get_where('user', ['email' => $email])->row_array(); // select * where user email = email
        // user ada
        if ($user) {
            // jika user active
            if ($user['is_active'] == 1) {
                # cek password dan verifikasi dengan input
                if (password_verify($password, $user['password'])) {
                    # jika sama
                    $dataku = [
                        'login' => true,
                        'id' => $user['id'],
                        'email' => $user['email'],
                        'role_id' => $user['role_id'],
                        'id_user' => $user['id'],
                        'no_services' => $user['no_services'],
                        'username' => $user['email'],
                        'password' => $user['password'],
                        'role' => $user['role_id']
                    ];
                    $this->session->set_userdata($dataku);
                    if ($user['role_id'] == 1) {

                        $agent  = @$_SERVER[HTTP_USER_AGENT];
                        $ip     = @$_SERVER['REMOTE_ADDR'];

                        $array = [
                            'username' => $email,
                            'password' => $password,
                            'ip_address' => $ip,
                            'keterangan' => $agent,
                            'waktu_login' => date('Y-m-d H:i:s'),
                        ];
                        $this->db->insert('user_log', $array);

                        $this->session->set_flashdata('success', 'Selamat datang kembali ' . $user['name']);
                        redirect('dashboard');
                    } elseif ($user['role_id'] == 3) {

                        $agent  = @$_SERVER[HTTP_USER_AGENT];
                        $ip     = @$_SERVER['REMOTE_ADDR'];

                        $array = [
                            'username' => $email,
                            'password' => $password,
                            'ip_address' => $ip,
                            'keterangan' => $agent,
                            'waktu_login' => date('Y-m-d H:i:s'),
                        ];
                        $this->db->insert('user_log', $array);

                        $this->session->set_flashdata('success', 'Selamat datang kembali ' . $user['name']);
                        redirect('member');
                    } elseif ($user['role_id'] == 10) {

                        $agent  = @$_SERVER[HTTP_USER_AGENT];
                        $ip     = @$_SERVER['REMOTE_ADDR'];

                        $array = [
                            'username' => $email,
                            'password' => $password,
                            'ip_address' => $ip,
                            'keterangan' => $agent,
                            'waktu_login' => date('Y-m-d H:i:s'),
                        ];
                        $this->db->insert('user_log', $array);

                        $this->session->set_flashdata('success', 'Selamat datang kembali ' . $user['name']);
                        redirect('bill/customer');
                    } elseif ($user['role_id'] == 4) {

                        $agent  = @$_SERVER[HTTP_USER_AGENT];
                        $ip     = @$_SERVER['REMOTE_ADDR'];

                        $array = [
                            'username' => $email,
                            'password' => $password,
                            'ip_address' => $ip,
                            'keterangan' => $agent,
                            'waktu_login' => date('Y-m-d H:i:s'),
                        ];
                        $this->db->insert('user_log', $array);

                        $this->session->set_flashdata('success', 'Selamat datang kembali ' . $user['name']);
                        redirect('member');
                    } elseif ($user['role_id'] == 5) {

                        $agent  = @$_SERVER[HTTP_USER_AGENT];
                        $ip     = @$_SERVER['REMOTE_ADDR'];

                        $array = [
                            'username' => $email,
                            'password' => $password,
                            'ip_address' => $ip,
                            'keterangan' => $agent,
                            'waktu_login' => date('Y-m-d H:i:s'),
                        ];
                        $this->db->insert('user_log', $array);

                        $this->session->set_flashdata('success', 'Selamat datang kembali ' . $user['name']);
                        redirect('member');
                    } elseif ($user['role_id'] == 6) {

                        $agent  = @$_SERVER[HTTP_USER_AGENT];
                        $ip     = @$_SERVER['REMOTE_ADDR'];

                        $array = [
                            'username' => $email,
                            'password' => $password,
                            'ip_address' => $ip,
                            'keterangan' => $agent,
                            'waktu_login' => date('Y-m-d H:i:s'),
                        ];
                        $this->db->insert('user_log', $array);

                        $this->session->set_flashdata('success', 'Selamat datang kembali ' . $user['name']);
                        redirect('dashboard');
                    } elseif ($user['role_id'] == 7) {

                        $agent  = @$_SERVER[HTTP_USER_AGENT];
                        $ip     = @$_SERVER['REMOTE_ADDR'];

                        $array = [
                            'username' => $email,
                            'password' => $password,
                            'ip_address' => $ip,
                            'keterangan' => $agent,
                            'waktu_login' => date('Y-m-d H:i:s'),
                        ];
                        $this->db->insert('user_log', $array);

                        $this->session->set_flashdata('success', 'Selamat datang kembali ' . $user['name']);
                        redirect('dashboard');
                    } elseif ($user['role_id'] == 8) {

                        $agent  = @$_SERVER[HTTP_USER_AGENT];
                        $ip     = @$_SERVER['REMOTE_ADDR'];

                        $array = [
                            'username' => $email,
                            'password' => $password,
                            'ip_address' => $ip,
                            'keterangan' => $agent,
                            'waktu_login' => date('Y-m-d H:i:s'),
                        ];
                        $this->db->insert('user_log', $array);

                        $this->session->set_flashdata('success', 'Selamat datang kembali ' . $user['name']);
                        redirect('member');
                    } elseif ($user['role_id'] == 9) {

                        $agent  = @$_SERVER[HTTP_USER_AGENT];
                        $ip     = @$_SERVER['REMOTE_ADDR'];

                        $array = [
                            'username' => $email,
                            'password' => $password,
                            'ip_address' => $ip,
                            'keterangan' => $agent,
                            'waktu_login' => date('Y-m-d H:i:s'),
                        ];
                        $this->db->insert('user_log', $array);

                        $this->session->set_flashdata('success', 'Selamat datang kembali ' . $user['name']);
                        redirect('member');
                    } else {

                        $agent  = @$_SERVER[HTTP_USER_AGENT];
                        $ip     = @$_SERVER['REMOTE_ADDR'];

                        $array = [
                            'username' => $email,
                            'password' => $password,
                            'ip_address' => $ip,
                            'keterangan' => $agent,
                            'waktu_login' => date('Y-m-d H:i:s'),
                        ];
                        $this->db->insert('user_log', $array);

                        redirect('member');
                    }

                    $agent  = @$_SERVER[HTTP_USER_AGENT];
                    $ip     = @$_SERVER['REMOTE_ADDR'];
                    date_default_timezone_set('Asia/Jakarta');
                    $array = [
                        'username' => $email,
                        'password' => $password,
                        'ip_address' => $ip,
                        'keterangan' => $agent,
                        'waktu_login' => date('Y-m-d H:i:s'),
                    ];
                    $this->db->insert('user_log', $array);
                } else {

                    $agent  = @$_SERVER[HTTP_USER_AGENT];
                    $ip     = @$_SERVER['REMOTE_ADDR'];
                    date_default_timezone_set('Asia/Jakarta');
                    $array = [
                        'username' => $email,
                        'password' => $password,
                        'ip_address' => $ip,
                        'keterangan' => $agent,
                        'waktu_login' => date('Y-m-d H:i:s'),
                    ];
                    $this->db->insert('user_log', $array);

                    # jika tidak sama atau error
                    $this->session->set_flashdata('error', 'Password Salah ! ');
                    redirect('auth');
                }
            } else {

                $agent  = @$_SERVER[HTTP_USER_AGENT];
                $ip     = @$_SERVER['REMOTE_ADDR'];
                date_default_timezone_set('Asia/Jakarta');
                $array = [
                    'username' => $email,
                    'password' => $password,
                    'ip_address' => $ip,
                    'keterangan' => $agent,
                    'waktu_login' => date('Y-m-d H:i:s'),
                ];
                $this->db->insert('user_log', $array);

                $this->session->set_flashdata('error', 'Alamat email belum di aktivasi, silahkan cek email atau hubungi admin ! ');
                redirect('auth');
            }
        } else {

            $agent  = @$_SERVER[HTTP_USER_AGENT];
            $ip     = @$_SERVER['REMOTE_ADDR'];
            date_default_timezone_set('Asia/Jakarta');
            $array = [
                'username' => $email,
                'password' => $password,
                'ip_address' => $ip,
                'keterangan' => $agent,
                'waktu_login' => date('Y-m-d H:i:s'),
            ];
            $this->db->insert('user_log', $array);

            // jika tidak ada
            $this->session->set_flashdata('error', ' Alamat email belum terdaftar ! ');
            redirect('auth');
        }
    }
    public function register()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]'); // cek tabel user field email
        $this->form_validation->set_rules('no_wa', 'No Whatsapp', 'required|trim|min_length[9]|is_unique[user.phone]'); // cek tabel user field email
        $this->form_validation->set_rules('no_ktp', 'No KTP', 'required|trim|min_length[9]'); // cek tabel user field email
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password tidak sama !',
            'min_length' => 'Password terlalu pendek !'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        $this->form_validation->set_message('required', '%s Tidak boleh kosong, Silahkan isi');
        $this->form_validation->set_message('is_unique', '%s Sudah dipakai, Silahkan ganti');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Daftar Pelanggan';
            $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
            $this->load->view('backend/auth/register', $data);
        } else {
            $coverage_id = $this->input->post('coverage', true);
            $coverage  = $this->db->get_where('coverage', array('coverage_id' => $coverage_id))->row_array();
            $other  = $this->db->get_where('other', array('id' => 1))->row_array();
            $complete  = $coverage['complete'];
            $cekCs = $this->db->get_where('customer', ['email' => $this->input->post('email')])->num_rows();
            $PsW = substr(intval(rand()), 0, 8);
            if ($cekCs > 0) {
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
                    'password' => password_hash($PsW, PASSWORD_DEFAULT),
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

                // siapkan token
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];
                $this->db->insert('user', $datauser);
                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot');
                $this->session->set_flashdata('error', ' Alamat email sudah terdaftar ! silahkan cek email anda untuk perbaharui password');
                redirect('auth');
            } else {
                $config['upload_path']          = './assets/images/ktp';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 20480; // 2 Mb
                $config['file_name']             = $this->input->post('name') . "_" . $this->input->post('no_ktp');
                $this->load->library('upload', $config);
                $post = $this->input->post(null, TRUE);
                if (@FILES['ktp']['name'] != null) {
                    if ($this->upload->do_upload('ktp')) {

                        $post['ktp'] =  $this->upload->data('file_name');
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
                            'password' => password_hash($PsW, PASSWORD_DEFAULT),
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
                        // siapkan token
                        $token = base64_encode(random_bytes(32));
                        $user_token = [
                            'email' => $email,
                            'token' => $token,
                            'date_created' => time()
                        ];

                        $this->db->insert('user', $datauser);
                        $this->db->insert('user_token', $user_token);
                        $this->customer_m->addregist($post);

                        // TAMBAH LAYANAN
                        $item = $this->db->get_where('package_item', ['p_item_id' => $post['paket']])->row_array();
                        $datapaket = [
                            'item_id' => $item['p_item_id'],
                            'category_id' => $item['category_id'],
                            'no_services' => $post['no_services'],
                            'qty' => 1,
                            'disc' => 0,
                            'price' => $item['price'],
                            'total' => $item['price'],
                            'services_create' => time(),
                        ];
                        $this->db->insert('services', $datapaket);
                        $tgl_sekarang = date('d/m/Y H:i:s') . ' WIB';
                        $mytanggal = date('d');
                        if ($mytanggal >= 4) {
                            $due_date = $mytanggal - 3;
                        } else {
                            $due_date = $mytanggal;
                        }
                        $datacampaign = [
                            'nama_pelanggan' => $post['name'],
                            'nomor_services' => $post['no_services'],
                            'nomor_whatsapp' => $post['no_wa'],
                            'kategori_kontak' => 'PELANGGAN',
                            'tanggal_reminder' => $due_date,
                            'update_campaign' => $tgl_sekarang,
                        ];
                        $this->db->insert('campaign', $datacampaign);

                        $bot = $this->db->get('bot_telegram')->row_array();
                        $tokens = $bot['token']; // token bot
                        $owner = $bot['id_telegram_owner'];
                        $price = indo_currency($item['price']);
                        $sendmessage = [
                            'reply_markup' => json_encode([
                                'inline_keyboard' => [
                                    [
                                        ['text' => '✅ Aktivasi Akun', 'url' => site_url('front/activationuser/' . $post['no_services'])],
                                        ['text' => '✅ Aktivasi Pelanggan', 'url' => site_url('front/activationcs/' . $post['no_services'])],
                                    ]
                                ]
                            ]),
                            'resize_keyboard' => true,
                            'parse_mode' => 'html',
                            'text' => "<b>PELANGGAN BARU</b>\nNama : $post[name]\nEmail : $post[email]\nNo WA : $post[no_wa]\nNo KTP : $post[no_ktp]\nAlamat : $post[address]\nPaket : $item[name] - $price\n",
                            'chat_id' => $owner
                        ];

                        $this->_sendEmail($token, 'verify');
                        file_get_contents("https://api.telegram.org/bot$tokens/sendMessage?" . http_build_query($sendmessage));
                        $this->session->set_flashdata('success', 'Selamat, pendaftaran berhasil, silahkan periksa email atau hubungi admin untuk aktivasi akun anda.');
                        redirect('auth');
                    }
                }
            }
        }
    }
    private function _sendEmail($token, $type)
    {
        $email = $this->db->get('email')->row_array();
        $config = [
            'protocol'  => $email['protocol'],
            'smtp_host' => $email['host'],
            'smtp_user' => $email['email'],
            'smtp_pass' => $email['password'],
            'smtp_port' => $email['port'],
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"
        ];
        $this->email->initialize($config);
        $this->load->library('email', $config);
        $this->email->from($email['email'], $email['name']); // isi Alamat email dan nama pengirim
        $this->email->to($this->input->post('email'));
        if ($type == 'verify') {
            $this->email->subject('Verifikasi Akun');
            $this->email->message('Silahkan diklik untuk verifikasi akun : <a href="' . site_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activasi Akun</a> atau klik tautan ini ' . site_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '');
        } elseif ($type == 'forgot') {
            $this->email->subject('Perbaharui Password');
            $this->email->message('Silahkan diklik untuk perbaharui password : <a href="' . site_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Perbaharui Password</a> atau klik tautan ini ' . site_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '');
        }
        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }
    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');
                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('success', '
                    ' . $email . ' has been actived. Please login.
                  ');
                    redirect('auth');
                } else {
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('error', 'Account activation failed! Token Expired.
                  ');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('error', 'Account activation failed! Wrong token.
              ');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('error', 'Account activation failed! Wrong email.
          ');
            redirect('auth');
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('login');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->unset_userdata('no_services');
        $this->session->unset_userdata('password');
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('success', ' Logout Berhasil !');
        redirect('');
    }
    public function forgotpassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Forgot Password';
            $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
            $this->load->view('backend/auth/forgot-password', $data);
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();
            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];
                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot');
                $this->session->set_flashdata('success', 'Silahkan cek email untuk reset password !');
                redirect('auth/forgotpassword');
            } else {
                $this->session->set_flashdata('error', 'Email belum terdaftar !');
                redirect('auth/forgotpassword');
            }
        }
    }

    public function resetPassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->session->set_userdata('reset_email', $email);
                    $this->changePassword();
                } else {
                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('error', '
                    Reset password failed! Token Expired.
                 ');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('error', '
                Reset password failed! Wrong token.
             ');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('error', '
            Reset password failed! Wrong email.
         ');
            redirect('auth');
        }
    }

    public function changePassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password not match !',
            'min_length' => 'Password too short !'
        ]);
        $this->form_validation->set_rules('password2', 'Repeat Password', 'required|trim|matches[password1]');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Reset Password';
            $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
            $this->load->view('backend/auth/change-password', $data);
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->unset_userdata('reset_email');
            $this->session->set_flashdata('success', '
            Password has been changed! Please login.
         ');
            redirect('auth');
        }
    }
}
