<?php defined('BASEPATH') or exit('No direct script access allowed');

class Cpanel extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model(['setting_m']);
    }

    public function index()
    {
        $data['title'] = 'cPanel Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $this->template->load('cpanel', 'cpanel/dashboard', $data);
    }
}
