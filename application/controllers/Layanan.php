<?php defined('BASEPATH') or exit('No direct script access allowed');

class layanan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model(['layanan_m']);
    }

    public function data()
    {
        $data['title'] = 'Data Layanan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['layanan'] = $this->db->get('layanan')->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/layanan/data', $data);
    }

    public function detail($id)
    {
        $data['title'] = 'Detail Layanan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['layanan'] = $this->db->get_where('layanan', ['id_layanan' => $id])->row_array();

        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/layanan/detail', $data);
    }
    public function deletelayanan($id)
    {
        $this->db->get_where('layanan', ['id_layanan' => $id])->row_array();
        $this->layanan_m->deletelayanan($id);
        $this->session->set_flashdata('success', 'Ajuan layanan berhasil dihapus.
      ');
        redirect('layanan/data');
    }
    public function kirim($id)
    {
        $catatan_layanan  = $this->input->post('catatan_layanan');
        $status_layanan   = $this->input->post('status_layanan');
        $this->db->set('catatan_layanan', $catatan_layanan);
        $this->db->set('status_layanan', $status_layanan);
        $this->db->where('id_layanan', $id);
        $this->db->update('layanan');
        $this->session->set_flashdata('success', 'Ajuan layanan berhasil diperbaharui.');
        redirect($_SERVER['HTTP_REFERER']);
    }
}
