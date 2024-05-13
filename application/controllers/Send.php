<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Send extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Kirim Pesan';
        $no_wa = html_escape($this->input->post('no_wa', true));
        $isi_pesan = html_escape($this->input->post('isi_pesan', true));
        redirect('https://api.whatsapp.com/send?phone=' . $no_wa . '&text=' . $isi_pesan);
    }
}
