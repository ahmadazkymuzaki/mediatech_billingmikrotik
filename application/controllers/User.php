<?php defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('user_m');
    }
    public function index()
    {
        $data['title'] = 'User';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['row'] = $this->user_m->get()->result();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/user/user_data', $data);
    }
    public function profile()
    {
        $data['title'] = 'Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/user/profile', $data);
    }
    public function edit()
    {
        $config['upload_path'] = './assets/images/profile/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']     = '2048';
        $data['title'] = 'Edit Profile'; // Judul link
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('phone', 'Phone', 'required|trim|min_length[8]');
        $this->form_validation->set_rules('gender', 'Gender', 'required|trim');

        if ($this->form_validation->run() == false) {
            $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
            $MyThemes = $MyCompanyData['tm_backend'];
            $this->template->load($MyThemes, 'backend/user/edit-profile', $data);
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
                    redirect('user/profile');
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

            $this->session->set_flashdata('success', 'Your profile has been updated!');
            redirect('user/profile');
        }
    }
    public function editEmail()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', 'Pastikan penulisan email baru benar');
            redirect('user/profile');
        } else {
            $id = $this->input->post('id');
            $email = $this->input->post('email');
            $this->db->set('email', $email);
            $this->db->where('id', $id);
            $this->db->update('user');
            $this->session->unset_userdata('login');
            $this->session->unset_userdata('email');
            $this->session->unset_userdata('role_id');
            $this->session->set_flashdata('success', 'Your email has been updated! please login with new email');
            redirect('auth');
        }
    }
    public function changepassword()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[5]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm Password', 'required|trim|min_length[5]|matches[new_password1]');
        if ($this->form_validation->run() == false) {
            $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
            $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
            $MyThemes = $MyCompanyData['tm_backend'];
            $this->template->load($MyThemes, 'backend/user/change-password', $data);
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('error', 'Wrong current password!');
                redirect('user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('error', 'Password baru tidak boleh sama dengan Password saat ini !');
                    redirect('user/changepassword');
                } else {
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');
                    $this->session->set_flashdata('success', 'New password has been changed!');
                    redirect('user/changepassword');
                }
            }
        }
    }
    public function edit_user($id)
    {

        $data['title'] = 'Edit Pengguna'; // Judul link
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $row = $this->db->get_where('user', ['id' => $id])->num_rows();
        if ($row <= 0) {
            $this->session->set_flashdata('error', 'Data user tidak ditemukan');
            echo "<script>window.location='" . site_url('user') . "'; </script>";
        } else {
            $data['row'] = $this->db->get_where('user', ['id' => $id])->row_array();
            $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
            $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
            $MyThemes = $MyCompanyData['tm_backend'];
            $this->template->load($MyThemes, 'backend/user/edit-user', $data);
        }
    }

    public function editUser()
    {
        $post = $this->input->post(null, TRUE);
        $this->user_m->edit($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data pengguna berhasil diperbaharui');
        }
        echo "<script>window.location='" . site_url('user') . "'; </script>";
    }
    public function del()
    {
        $id = $this->input->post('id');
        $user = $this->user_m->get($id)->row();
        if ($user->image != 'default.jpg') {
            $target_file = './assets/images/profile/' . $user->image;
            unlink($target_file);
        }
        $this->user_m->del($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data pengguna berhasil dihapus');
        }
        echo "<script>window.location='" . site_url('user') . "'; </script>";
    }
    public function register()
    {
        if ($this->session->userdata('role_id') != 1) {
            if ($this->session->userdata('role_id') == 2) {
                # code...
                $this->session->set_flashdata('error-sweet', 'Akses dilarang');
                redirect('member');
            }
            if ($this->session->userdata('role_id') == 3) {
                # code...
                $this->session->set_flashdata('error-sweet', 'Akses dilarang');
                redirect('dashboard');
            }
            if ($this->session->userdata('role_id') == 4) {
                # code...
                $this->session->set_flashdata('error-sweet', 'Akses dilarang');
                redirect('dashboard');
            }
            if ($this->session->userdata('role_id') == 5) {
                # code...
                $this->session->set_flashdata('error-sweet', 'Akses dilarang');
                redirect('dashboard');
            }
            if ($this->session->userdata('role_id') == 6) {
                # code...
                $this->session->set_flashdata('error-sweet', 'Akses dilarang');
                redirect('dashboard');
            }
            if ($this->session->userdata('role_id') == 7) {
                # code...
                $this->session->set_flashdata('error-sweet', 'Akses dilarang');
                redirect('dashboard');
            }
            if ($this->session->userdata('role_id') == 8) {
                # code...
                $this->session->set_flashdata('error-sweet', 'Akses dilarang');
                redirect('dashboard');
            }
            if ($this->session->userdata('role_id') == 9) {
                # code...
                $this->session->set_flashdata('error-sweet', 'Akses dilarang');
                redirect('dashboard');
            }
        }

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]'); // cek tabel user field email
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
            $this->load->view('backend/user/register', $data);
        } else {
            $cekCs = $this->db->get_where('customer', ['email' => $this->input->post('email')])->num_rows();
            if ($cekCs > 0) {
                $new_password = $this->input->post('password1', true);
                $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                $email = $this->input->post('email', true);
                $data = [
                    'name' => htmlspecialchars($this->input->post('name', true)),
                    'pass_text' => htmlspecialchars($this->input->post('password1', true)),
                    'email' => htmlspecialchars($email),
                    'no_services' => date('ymdHis'),
                    'image' => 'logo.png',
                    'saldo' => 0,
                    'refferal' => 0,
                    'password' => $password_hash,
                    'role_id' => $this->input->post('role_id'),
                    'is_active' => 1,
                    'date_created' => time()
                ];

                // siapkan token
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];
                $this->db->insert('user', $data);
                $this->db->insert('user_token', $user_token);
                $this->session->set_flashdata('error', ' Alamat email sudah terdaftar di data pelanggan, silahkan ganti password oleh admin atau reset password oleh pelanggan! ');
                redirect('user');
            } else {
                $new_password = $this->input->post('password1', true);
                $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                $email = $this->input->post('email', true);
                $data = [
                    'name' => htmlspecialchars($this->input->post('name', true)),
                    'pass_text' => htmlspecialchars($this->input->post('password1', true)),
                    'email' => htmlspecialchars($email),
                    'no_services' => date('ymdHis'),
                    'image' => 'logo.png',
                    'saldo' => 0,
                    'refferal' => 0,
                    'password' => $password_hash,
                    'role_id' => $this->input->post('role_id'),
                    'is_active' => 1,
                    'date_created' => time()
                ];

                // siapkan token
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];
                $this->db->insert('user', $data);

                $this->session->set_flashdata('success', 'Data pengguna berhasil dibuat');
                redirect('user');
            }
        }
    }
}
