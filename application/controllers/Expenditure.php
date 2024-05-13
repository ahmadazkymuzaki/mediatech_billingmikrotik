<?php defined('BASEPATH') or exit('No direct script access allowed');

class expenditure extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model(['expenditure_m', 'report_m']);
    }


    public function index()
    {
        $data['title'] = 'Expenditure';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['expenditure'] = $this->expenditure_m->getexpenditure()->result();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/expenditure/expenditure', $data);
    }


    public function add()
    {
        $post = $this->input->post(null, TRUE);
        $this->expenditure_m->add($post);
        $this->report_m->addReport2($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data pengeluaran berhasil ditambahkan');
        }
        echo "<script>window.location='" . site_url('expenditure') . "'; </script>";
    }
    public function edit()
    {
        $post = $this->input->post(null, TRUE);
        $this->report_m->editExpenditure($post);
        $this->expenditure_m->edit($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data pengeluaran berhasil diperbaharui');
        }
        echo "<script>window.location='" . site_url('expenditure') . "'; </script>";
    }
    public function delete()
    {
        $expenditure_id = $this->input->post('expenditure_id');
        $created = $this->input->post('created');
        $this->expenditure_m->delete($expenditure_id);
        $this->report_m->delete($created);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data pengeluaran berhasil dihapus');
        }
        echo "<script>window.location='" . site_url('expenditure') . "'; </script>";
    }
    public function printexpenditure()
    {
        $post = $this->input->post(null, TRUE);
        $data['tanggal'] = $this->input->post('tanggal');
        $data['tanggal2'] = $this->input->post('tanggal2');
        $data['title'] = 'Invoice';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['income'] = $this->expenditure_m->getFilter($post)->result();
        $this->load->view('backend/expenditure/printexpenditure', $data);
    }
}
