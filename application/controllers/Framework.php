<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Framework extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = 'Framework';
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $this->load->view('welcome', $data);
    }
}