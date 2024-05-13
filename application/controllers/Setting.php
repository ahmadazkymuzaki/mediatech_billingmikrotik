<?php defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model(['setting_m', 'customer_m']);
    }

    public function index()
    {
        $data['title'] = 'Profil Perusahaan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $company = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $config['map_div_id'] = "map-add";
        $config['map_height'] = "200px";
        $config['center'] = $company['latitude'] . ',' . $company['longitude'];
        $config['zoom'] = '12';
        $config['map_height'] = '400px;';
        $config['map_type'] = 'HYBRID';
        $this->googlemaps->initialize($config);
        $marker = array();
        $marker['position'] = $company['latitude'] . ',' . $company['longitude'];
        $marker['draggable'] = true;
        $marker['ondragend'] = 'setMapToForm(event.latLng.lat(), event.latLng.lng());';
        $this->googlemaps->add_marker($marker);
        $data['map'] = $this->googlemaps->create_map();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/setting/company', $data);
    }
    public function editCompany()
    {
        $config['upload_path']          = './assets/images';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 10048; // 10 Mb
        $config['file_name']             = 'mylogo-'.date('dmYHis');
        $this->load->library('upload', $config);
        $post = $this->input->post(null, TRUE);
        if (@FILES['logo']['name'] != null) {
            if ($this->upload->do_upload('logo')) {
                $company = $this->setting_m->getCompany($post['id'])->row();
                if ($company->logo != null) {
                    $target_file = './assets/images/' . $company->logo;
                    unlink($target_file);
                }
                $post['logo'] =  $this->upload->data('file_name');
                $this->setting_m->editCompany($post);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', 'Data perusahaan berhasil diperbaharui');
                }
                echo "<script>window.location='" . site_url('setting') . "'; </script>";
            } else {
                $post['logo'] =  null;
                $this->setting_m->editCompany($post);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', 'Data perusahaan berhasil diperbaharui');
                }
                echo "<script>window.location='" . site_url('setting') . "'; </script>";
            }
        } else {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            echo "<script>window.location='" . site_url('setting') . "'; </script>";
        }
    }

    public function about()
    {
        $data['title'] = 'About';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/setting/about', $data);
    }
    public function riwayat()
    {
        $data['title'] = 'Riwayat Login';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/setting/user-log', $data);
    }
    public function editAbout()
    {
        $description = $this->input->post('description');
        $ppn = $this->input->post('ppn');
        $this->db->set('description', $description);
        $this->db->set('ppn', $ppn);
        $this->db->update('company');
        $this->session->set_flashdata('success', 'Deskripsi perusahaan sudah diperbaharui.
      ');
        redirect('setting/about');
    }

    public function bank()
    {
        $data['title'] = 'Bank';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['bank'] = $this->setting_m->getBank()->result();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/setting/bank', $data);
    }

    public function pilihcompany()
    {
        $data['title'] = 'Edit Company';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $id = $this->input->post('id_company');

        $param = [
            'status' => 'Non-Aktif',
        ];
        $this->db->update('company', $param);

        $params = [
            'status' => 'Aktif',
        ];
        $this->db->where('id', $id);
        $this->db->update('company', $params);
        $this->session->set_flashdata('success', 'Perusahaan berhasil Dipilih & Diaktifkan.');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function addBank()
    {
        $post = $this->input->post(null, TRUE);
        $this->setting_m->addBank($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Bank berhasil ditambahkan');
        }
        echo "<script>window.location='" . site_url('setting/bank') . "'; </script>";
    }
    public function editBank()
    {
        $post = $this->input->post(null, TRUE);
        $this->setting_m->editBank($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Bank berhasil diperbaharui');
        }
        echo "<script>window.location='" . site_url('setting/bank') . "'; </script>";
    }
    public function deleteBank()
    {
        $bank_id = $this->input->post('bank_id');
        $this->setting_m->deleteBank($bank_id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Bank berhasil dihapus');
        }
        echo "<script>window.location='" . site_url('setting/bank') . "'; </script>";
    }
    public function backup()
    {
        $data['title'] = 'Backup';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/setting/backup', $data);
    }
    public function backupdatabase()
    {
        $company = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $this->load->dbutil();
        $this->load->dbutil();
        $config = array(
            'format'    => 'zip',
            'filename'    => 'Backup-MikRoBot-App-' . $company['company_name'] . '-' . date("YmdHis") . '-db.sql'
        );

        $backup = $this->dbutil->backup($config);

        $this->load->helper('file');

        $this->load->helper('download');
        force_download('Backup-MikRoBot-App-' . $company['company_name'] . '-' . date("YmdHis") . '-db.zip', $backup);
    }

    public function email()
    {
        $data['title'] = 'Email';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['email'] = $this->db->get('email')->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/setting/email', $data);
    }

    public function sosmed()
    {
        $data['title'] = 'Sosial Media';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['sosmed'] = $this->db->get('sosmed')->result();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/setting/sosmed', $data);
    }

    public function addsosmed()
    {
        $username   = $this->input->post('username');
        $email      = $this->input->post('email');
        $password   = $this->input->post('password');
        $platform   = $this->input->post('platform');
        $url_login  = $this->input->post('url_login');
        $updated    = $this->input->post('updated');
        
        $params = [
            'username'  => $username,
            'email'     => $email,
            'password'  => $password,
            'platform'  => $platform,
            'url_login' => $url_login,
            'updated'   => $updated,
        ];
        $this->db->insert('sosmed', $params);
        
        $this->session->set_flashdata('success', 'Data Akun Sosial Media berhasil Ditambahkan !!!');
        redirect('setting/sosmed');
    }
    
    public function editsosmed()
    {
        $username   = $this->input->post('username');
        $email      = $this->input->post('email');
        $password   = $this->input->post('password');
        $platform   = $this->input->post('platform');
        $url_login  = $this->input->post('url_login');
        $updated    = $this->input->post('updated');
        
        $params = [
            'username'  => $username,
            'email'     => $email,
            'password'  => $password,
            'platform'  => $platform,
            'url_login' => $url_login,
            'updated'   => $updated,
        ];
        $this->db->update('sosmed', $params);
        
        $this->session->set_flashdata('success', 'Data Akun Sosial Media berhasil Diperbaharui !!!');
        redirect('setting/sosmed');
    }
    
    public function delsosmed($id_sosmed)
    {
        $this->db->where('id_sosmed', $id_sosmed);
        $this->db->delete('sosmed');
        $this->session->set_flashdata('success', 'Data Akun Sosial Media berhasil Dihapus !!!');
        redirect('setting/sosmed');
    }

    public function webhook()
    {
        $data['title'] = 'Data Webhook';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['webhook'] = $this->db->get('webhook')->result();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/setting/webhook', $data);
    }

    public function delwebhook($id_web)
    {
        $this->db->where('id_web', $id_web);
        $this->db->delete('webhook');
        $this->session->set_flashdata('success', 'Data Webhook WhatsApp berhasil Dihapus !!!');
        redirect('setting/webhook');
    }

    public function allwebhook()
    {
        $webhook = $this->db->get('webhook')->result();
        foreach($webhook as $data){
            if($data->id_web != '110'){
                $this->db->where('id_web', $data->id_web);
                $this->db->delete('webhook');
            }
        }
        $this->session->set_flashdata('success', 'Data Webhook WhatsApp berhasil Dibersihkan !!!');
        redirect('setting/webhook');
    }

    public function editEmail()
    {
        $post = $this->input->post(null, TRUE);
        $this->setting_m->editEmail($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Email berhasil diperbaharui');
        }
        echo "<script>window.location='" . site_url('setting/email') . "'; </script>";
    }
    public function other()
    {
        $data['title'] = 'Lainnya';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['other'] = $this->db->get('other')->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/setting/other', $data);
    }

    public function editOther()
    {
        $post = $this->input->post(null, TRUE);
        $this->setting_m->editOther($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil diperbaharui');
        }
        echo "<script>window.location='" . site_url('setting/other') . "'; </script>";
    }

    public function editphp()
    {
        $data['title'] = 'Lainnya';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['customer'] = $this->customer_m->getCustomer()->result();
        $data['sms'] = $this->db->get('sms_gateway')->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/setting/editphp', $data);
    }

    public function bottelegram()
    {
        $data['title'] = 'Bot Telegram';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['customer'] = $this->customer_m->getCustomer()->result();
        $data['bot1'] = $this->db->get_where('bot_telegram', array('id' => 1))->row_array();
        $data['bot2'] = $this->db->get_where('bot_telegram', array('id' => 2))->row_array();
        $data['bot3'] = $this->db->get_where('bot_telegram', array('id' => 3))->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/setting/bot-telegram', $data);
    }

    public function kirimtelegram()
    {
        $link = 'https://api.telegram.org/bot';
        $bot = $this->input->post('bot');
        $id = $this->input->post('id');
        $string = $this->input->post('pesan');
        $pesan = urlencode($string);
        $url = $link . $bot . '/sendMessage?chat_id=' . $id . '&text=' . $pesan;

        $send = curl_init($url);
        $result = curl_exec($send);
        curl_close($send);
        $this->session->set_flashdata('success', 'Pesan Telegram berhasil Dikirim ' . $result . ' Pesan');
        redirect('setting/bottelegram');
    }

    public function editbottelegram()
    {
        $post = $this->input->post(null, TRUE);
        $params = [
            'token' => htmlspecialchars($post['token']),
            'username_bot' => htmlspecialchars($post['username_bot']),
            'username_owner' => htmlspecialchars($post['username_owner']),
            'link_webhook' => htmlspecialchars($post['link_webhook']),
            'id_telegram_owner' => htmlspecialchars($post['id_telegram_owner']),
        ];
        $this->db->where('id',  $post['id']);
        $this->db->update('bot_telegram', $params);
        $this->session->set_flashdata('success', 'Data Bot berhasil diperbaharui');
        redirect('setting/bottelegram');
    }

    public function catatan()
    {
        $data['title'] = 'Catatan Pelanggan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/setting/catatan', $data);
    }

    public function terms()
    {
        $data['title'] = 'Syarat & Ketentuan';

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/setting/terms', $data);
    }
    public function policy()
    {
        $data['title'] = 'Kebijakan Privasi';

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/setting/policy', $data);
    }
    public function editterms($id_company)
    {
        $terms = $this->input->post('terms');
        $this->db->set('terms', $terms);
        $this->db->where('id', $id_company);
        $this->db->update('company');
        $this->session->set_flashdata('success', 'Syarat dan ketentuan sudah diperbaharui.
      ');
        redirect('setting/terms');
    }
    public function editcatatan($id_company)
    {
        $terms = $this->input->post('catatan');
        $this->db->set('catatan', $catatan);
        $this->db->where('id', $id_company);
        $this->db->update('company');
        $this->session->set_flashdata('success', 'Catatan Pelanggan sudah diperbaharui.
      ');
        redirect('setting/catatan');
    }
    public function editpolicy($id_company)
    {
        $policy = $this->input->post('policy');
        $this->db->set('policy', $policy);
        $this->db->where('id', $id_company);
        $this->db->update('company');
        $this->session->set_flashdata('success', 'Kebijakan privasi sudah diperbaharui.
      ');
        redirect('setting/policy');
    }
}
