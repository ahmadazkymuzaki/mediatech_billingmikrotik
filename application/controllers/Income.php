<?php defined('BASEPATH') or exit('No direct script access allowed');

class Income extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model(['income_m', 'report_m']);
    }


    public function index()
    {
        $data['title'] = 'Income';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['income'] = $this->income_m->getincome()->result();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/income/income', $data);
    }


    public function add()
    {
        $post = $this->input->post(null, TRUE);
        $this->income_m->add($post);
        $this->report_m->add($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data pemasukan berhasil ditambahkan');
        }
        echo "<script>window.location='" . site_url('income') . "'; </script>";
    }
    public function edit()
    {
        $post = $this->input->post(null, TRUE);
        $this->report_m->editIncome($post);
        $this->income_m->edit($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data pemasukan berhasil diperbaharui');
        }
        echo "<script>window.location='" . site_url('income') . "'; </script>";
    }
    public function delete()
    {
        $income_id = $this->input->post('income_id');
        $created = $this->input->post('created');
        $this->income_m->delete($income_id);
        $this->report_m->delete($created);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data pemasukan berhasil dihapus');
        }
        echo "<script>window.location='" . site_url('income') . "'; </script>";
    }
    public function printincome()
    {
        $post = $this->input->post(null, TRUE);
        $data['tanggal'] = $this->input->post('tanggal');
        $data['tanggal2'] = $this->input->post('tanggal2');
        $data['title'] = 'Invoice';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['income'] = $this->income_m->getFilter($post)->result();
        $this->load->view('backend/income/printincome', $data);
    }
}
