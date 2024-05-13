<?php defined('BASEPATH') or exit('No direct script access allowed');

class About extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(['setting_m']);
    }

    public function index()
    {
        is_logged_in();
        $data['title'] = 'Info Aplikasi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/about', $data);
    }
    public function about()
    {
        $data['title'] = 'Tentang Kami';
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_frontend'];
        $this->template->load($MyThemes, 'frontend/about', $data);
    }
    public function terms()
    {
        $data['title'] = 'Syarat dan Ketentuan';
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_frontend'];
        $this->template->load($MyThemes, 'frontend/terms', $data);
    }
    public function policy()
    {
        $data['title'] = 'Kebijakan Privasi';
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_frontend'];
        $this->template->load($MyThemes, 'frontend/policy', $data);
    }
}
