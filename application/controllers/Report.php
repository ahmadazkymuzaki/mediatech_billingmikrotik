<?php defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model(['report_m']);
    }


    public function index()
    {
        $data['title'] = 'Report';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['report'] = $this->report_m->getReport()->result();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/report/report', $data);
    }

    public function printreport()
    {
        $post = $this->input->post(null, TRUE);
        $data['tanggal'] = $this->input->post('tanggal');
        $data['tanggal2'] = $this->input->post('tanggal2');
        $data['title'] = 'Invoice';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['report'] = $this->report_m->getFilter($post)->result();
        $this->load->view('backend/report/printreport', $data);
    }
}
