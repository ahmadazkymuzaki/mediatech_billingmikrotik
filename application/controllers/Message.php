<?php defined('BASEPATH') or exit('No direct script access allowed');

class message extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model(['message_m']);
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

    public function data()
    {
        $data['title'] = 'Data Pengaduan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['message'] = $this->db->get('message')->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/message/data', $data);
    }

    public function detail($id)
    {
        $data['title'] = 'Detail Pengaduan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['message'] = $this->db->get_where('message', ['message_id' => $id])->row_array();

        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/message/detail', $data);
    }
    public function deletepesan($id)
    {
        $dataMessage = $this->db->get_where('message', ['message_id' => $id])->row_array();
        $tiket_pesan = $dataMessage['tiket_pesan'];
        $this->message_m->deletepesan($tiket_pesan);
        $this->session->set_flashdata('success', 'Pesan Pengaduan berhasil Dihapus');
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
( '.$user_pengirim.' )
Penerima : ' . $no_invoice . '
( '.$user_penerima.' )

Judul Pesan : 
' . $judul_pesan . '
Konten Pesan : 
' . $konten_pesan . '

Waktu Kirim : ' . $waktu_kirim . '
Status Pesan : ' . $status_message .'
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

        $this->db->insert('message', $array);
        $this->session->set_flashdata('success', 'Pesan sudah dikirim.');
        redirect($_SERVER['HTTP_REFERER']);
    }
}
