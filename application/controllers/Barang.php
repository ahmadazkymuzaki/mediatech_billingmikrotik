<?php defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model(['Barang_m']);
    }
    public function index()
    {
        $data['title'] = 'Barang';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['media'] = $this->Barang_m->get()->result();
        $data['barang'] = $this->Barang_m->getAllBarang();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/barang/data', $data);
    }
    public function add()
    {
        $config['upload_path']          = './assets/images/barang';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 2048; // 2 Mb
        $config['file_name']             = 'barang-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $this->load->library('upload', $config);
        $post = $this->input->post(null, TRUE);
        if (@FILES['barang']['name'] != null) {
            if ($this->upload->do_upload('barang')) {
                $post['barang'] =  $this->upload->data('file_name');
                $this->Barang_m->add($post);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', 'Data Barang berhasil Ditambah');
                }
                echo "<script>window.location='" . site_url('barang') . "'; </script>";
            } else {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error);
                echo "<script>window.location='" . base_url('barang') . "'; </script>";
            }
        }
    }

    public function edit()
    {
        $config['upload_path']          = './assets/images/barang';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 2048; // 2 Mb
        $config['file_name']             = 'barang-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $this->load->library('upload', $config);
        $post = $this->input->post(null, TRUE);
        if (@FILES['barang']['name'] != null) {
            if ($this->upload->do_upload('barang')) {
                $id = $post['id_barang'];
                $barang = $this->Barang_m->get($id)->row();
                if ($barang->gambar_barang != null) {
                    $target_file = './assets/images/barang/' . $barang->gambar_barang;
                    unlink($target_file);
                }
                $post['barang'] =  $this->upload->data('file_name');
                $this->Barang_m->edit($post);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', ' Data Barang berhasil Diubah');
                }
                echo "<script>window.location='" . site_url('barang') . "'; </script>";
            } else {
                $post['barang'] =  null;
                $this->Barang_m->edit($post);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', ' Data Barang berhasil Diubah');
                }
                echo "<script>window.location='" . base_url('barang') . "'; </script>";
            }
        } else {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            echo "<script>window.location='" . base_url('barang') . "'; </script>";
        }
    }

    public function delete($id_barang)
    {
        $this->Barang_m->del($id_barang);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Barang berhasil Dihapus');
        }
        echo "<script>window.location='" . base_url('barang') . "'; </script>";
    }
}
