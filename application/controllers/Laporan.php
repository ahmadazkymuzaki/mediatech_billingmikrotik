<?php defined('BASEPATH') or exit('No direct script access allowed');

class laporan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model(['laporan_m']);
    }

    public function reseller()
    {
        $data['title'] = 'Reseller';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['hotspot'] = $this->db->get('hotspot');
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/laporan/reseller', $data);
    }

    public function reward()
    {
        $data['title'] = 'Reward';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['invoice'] = $this->db->get('invoice')->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/laporan/customer', $data);
    }
    public function delete($id)
    {
        $this->db->get_where('hotspot', ['id_hotspot' => $id])->row_array();
        $this->laporan_m->delete($id);
        $this->session->set_flashdata('success', 'Voucher berhasil Dihapus.
      ');
        redirect('laporan/reseller');
    }
}
