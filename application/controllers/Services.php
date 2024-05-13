<?php defined('BASEPATH') or exit('No direct script access allowed');

class Services extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model(['customer_m', 'package_m', 'services_m']);
    }
    public function index()
    {
    }
    public function detail($no_services)
    {
        $data['title'] = 'Services List';
        $data['logpaket'] = $this->db->get_where('package_log', ['no_services' => $no_services])->result();
        $data['p_item'] = $this->package_m->getPItem()->result();
        $data['services'] = $this->services_m->getServices($no_services);
        $data['loglayanangua'] = $this->db->get_where('layanan', ['nomor_layanan' => $no_services])->result();
        $query  = $this->customer_m->getNSCustomer($no_services);
        if ($query->num_rows() > 0) {
            $data['customer'] = $query->row();
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        } else {
            echo "<script> alert ('Data tidak ditemukan');";
            echo "window.location='" . site_url('customer') . "'; </script>";
        }
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/customer/services/list', $data);
    }

    public function add($no_services)
    {
        $data_user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $post = $this->input->post(null, TRUE);

        $this_iditem1 = $post['item_id'];
        $datapaket1 = $this->db->get_where('package_item', array('p_item_id' => $this_iditem1))->row_array();
        $paket_pppoe = $datapaket1['paket_wifi'];

        $tgl_sekarang = date('d/m/Y H:i:s') . ' WIB';
        $data_log = [
            'no_services' => $post['no_services'],
            'nama_paket' => $datapaket1['name'],
            'ditambah_oleh' => $data_user['name'],
            'time_paket' => $tgl_sekarang,
        ];
        $this->db->insert('package_log', $data_log);

        $this->services_m->add($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Daftar layanan berhasil ditambahkan');
        }
        echo "<script>window.location='" . site_url('services/detail/' . $no_services) . "'; </script>";
    }
    public function edit()
    {
        $no_services = $this->input->post('no_services');
        $post = $this->input->post(null, TRUE);
        $this->services_m->edit($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Item layanan berhasil diperbaharui');
        }
        echo "<script>window.location='" . site_url('services/detail/' . $no_services) . "'; </script>";
    }

    public function delete()
    {
        $no_services = $this->input->post('no_services');
        $services_id = $this->input->post('services_id');
        $this->services_m->delete($services_id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Item layanan berhasil dihapus');
        }
        echo "<script>window.location='" . site_url('services/detail/' . $no_services) . "'; </script>";
    }
}
