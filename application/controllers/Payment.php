<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model(['setting_m', 'customer_m']);
    }

    public function tagihan()
    {
        $data['title'] = 'Payment Tagihan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['payment'] = $this->setting_m->getpayment()->result();
        $data['channel'] = $this->setting_m->getchannel()->result();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/payment/tagihan', $data);
    }

    public function saldo()
    {
        $data['title'] = 'Payment Saldo';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['payment'] = $this->db->get('paymentsaldo')->result();
        $data['channel'] = $this->setting_m->getchannel()->result();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/payment/saldo', $data);
    }

    public function voucher()
    {
        $data['title'] = 'Payment Voucher';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['payment'] = $this->db->get('paymentvoucher')->result();
        $data['channel'] = $this->setting_m->getchannel()->result();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/payment/voucher', $data);
    }

    public function edittagihan($id)
    {
        $data['title'] = 'Edit Tagihan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $params = [
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'vendor_pay' => $this->input->post('vendor_pay'),
            'apikey_pay' => $this->input->post('apikey_pay'),
            'private_key' => $this->input->post('private_key'),
            'merchant_id' => $this->input->post('merchant_id'),
            'admin_cost' => $this->input->post('admin_cost'),
            'expired_day' => $this->input->post('expired_day'),
            'url_payment' => $this->input->post('url_payment'),
            'url_callback' => $this->input->post('url_callback'),
            'update_pay' => $this->input->post('update_pay'),
        ];
        $this->db->where('id_payment', $id);
        $this->db->update('payment', $params);
        $this->session->set_flashdata('success', 'Payment Tagihan berhasil Diperbaharui');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function editsaldo($id)
    {
        $data['title'] = 'Edit Saldo';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $params = [
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'vendor_pay' => $this->input->post('vendor_pay'),
            'apikey_pay' => $this->input->post('apikey_pay'),
            'private_key' => $this->input->post('private_key'),
            'merchant_id' => $this->input->post('merchant_id'),
            'admin_cost' => $this->input->post('admin_cost'),
            'expired_day' => $this->input->post('expired_day'),
            'url_payment' => $this->input->post('url_payment'),
            'url_callback' => $this->input->post('url_callback'),
            'update_pay' => $this->input->post('update_pay'),
        ];
        $this->db->where('id_payment', $id);
        $this->db->update('paymentsaldo', $params);
        $this->session->set_flashdata('success', 'Payment Saldo berhasil Diperbaharui');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function editvoucher($id)
    {
        $data['title'] = 'Edit Voucher';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $params = [
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'vendor_pay' => $this->input->post('vendor_pay'),
            'apikey_pay' => $this->input->post('apikey_pay'),
            'private_key' => $this->input->post('private_key'),
            'merchant_id' => $this->input->post('merchant_id'),
            'admin_cost' => $this->input->post('admin_cost'),
            'expired_day' => $this->input->post('expired_day'),
            'url_payment' => $this->input->post('url_payment'),
            'url_callback' => $this->input->post('url_callback'),
            'update_pay' => $this->input->post('update_pay'),
        ];
        $this->db->where('id_payment', $id);
        $this->db->update('paymentvoucher', $params);
        $this->session->set_flashdata('success', 'Payment Voucher berhasil Diperbaharui');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function addchannel()
    {
        $data['title'] = 'Tambah Vhannel';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $admin_channel = $this->input->post('admin_channel');
        $biaya_channel = $this->input->post('biaya_channel');
        $total_channel = $admin_channel + $biaya_channel;

        $params = [
            'kode_channel' => $this->input->post('kode_channel'),
            'nama_channel' => $this->input->post('nama_channel'),
            'grup_channel' => $this->input->post('grup_channel'),
            'tipe_channel' => 'direct',
            'icon_channel' => $this->input->post('icon_channel'),
            'beban_channel' => $this->input->post('beban_channel'),
            'admin_channel' => $admin_channel,
            'biaya_channel' => $biaya_channel,
            'percent_channel' => $this->input->post('percent_channel'),
            'total_channel' => $total_channel,
            'status_channel' => $this->input->post('status_channel'),
        ];
        $this->db->insert('channel', $params);
        $this->session->set_flashdata('success', 'Data Channel berhasil Ditambahkan');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function editchannel($id)
    {
        $data['title'] = 'Edit Channel';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $admin_channel = $this->input->post('admin_channel');
        $biaya_channel = $this->input->post('biaya_channel');
        $total_channel = $admin_channel + $biaya_channel;

        $params = [
            'kode_channel' => $this->input->post('kode_channel'),
            'nama_channel' => $this->input->post('nama_channel'),
            'grup_channel' => $this->input->post('grup_channel'),
            'tipe_channel' => 'direct',
            'icon_channel' => $this->input->post('icon_channel'),
            'beban_channel' => $this->input->post('beban_channel'),
            'admin_channel' => $admin_channel,
            'biaya_channel' => $biaya_channel,
            'percent_channel' => $this->input->post('percent_channel'),
            'total_channel' => $total_channel,
            'status_channel' => $this->input->post('status_channel'),
        ];
        $this->db->where('id_channel', $id);
        $this->db->update('channel', $params);
        $this->session->set_flashdata('success', 'Channel berhasil Diperbaharui');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function enable($id)
    {
        $data['title'] = 'Edit Channel';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $this->db->set('status_channel', 'Aktif');
        $this->db->where('id_channel', $id);
        $this->db->update('channel', $params);
        $this->session->set_flashdata('success', 'Channel berhasil Diperbaharui');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function disable($id)
    {
        $data['title'] = 'Edit Channel';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $this->db->set('status_channel', 'Non-Aktif');
        $this->db->where('id_channel', $id);
        $this->db->update('channel');
        $this->session->set_flashdata('success', 'Channel berhasil Diperbaharui');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function deletechannel($id)
    {
        $this->db->where('id_channel', $id);
        $this->db->delete('channel');

        $this->session->set_flashdata('success', 'Channel berhasil Dihapus');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function testpayment()
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
}
