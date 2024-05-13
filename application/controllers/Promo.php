<?php defined('BASEPATH') or exit('No direct script access allowed');

class Promo extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model(['promo_m']);
    }
    public function index()
    {
        $data['title'] = 'Promo';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['promo'] = $this->promo_m->get()->result();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/promo/data', $data);
    }
    public function add()
    {
        $config['upload_path']          = './assets/images/promo';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 2048; // 2 Mb
        $config['file_name']             = 'promo-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $this->load->library('upload', $config);
        $post = $this->input->post(null, TRUE);
        if (@FILES['gambar_promo']['name'] != null) {
            if ($this->upload->do_upload('gambar_promo')) {
                $post['gambar_promo'] =  $this->upload->data('file_name');
                $this->promo_m->add($post);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', 'Data berhasil disimpan');
                }
                echo "<script>window.location='" . site_url('promo') . "'; </script>";
            } else {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error);
                echo "<script>window.location='" . site_url('promo') . "'; </script>";
            }
        }
    }

    public function edit()
    {
        $config['upload_path']          = './assets/images/promo';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 2048; // 2 Mb
        $config['file_name']             = 'promo-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $this->load->library('upload', $config);
        $post = $this->input->post(null, TRUE);
        if (@FILES['gambar_promo']['name'] != null) {
            if ($this->upload->do_upload('gambar_promo')) {
                $promo = $this->promo_m->get($post['kode_promo'])->row();
                if ($promo->gambar_promo != null) {
                    $target_file = './assets/images/promo/' . $promo->gambar_promo;
                    unlink($target_file);
                }
                $post['gambar_promo'] =  $this->upload->data('file_name');
                $this->promo_m->edit($post);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', ' Data Promo berhasil diupdate');
                }
                echo "<script>window.location='" . site_url('promo') . "'; </script>";
            } else {
                $post['gambar_promo'] =  null;
                $this->promo_m->edit($post);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', ' Data Promo berhasil disimpan');
                }
                echo "<script>window.location='" . site_url('promo') . "'; </script>";
            }
        } else {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            echo "<script>window.location='" . site_url('promo') . "'; </script>";
        }
    }

    public function delete()
    {
        $kode_promo = $this->input->post('kode_promo');
        $promo = $this->promo_m->get($kode_promo)->row();
        if ($promo->gambar_promo != null) {
            $target_file = './assets/images/promo/' . $promo->gambar_promo;
            unlink($target_file);
        }
        $this->promo_m->del($kode_promo);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Promo berhasil dihapus');
        }
        echo "<script>window.location='" . site_url('promo') . "'; </script>";
    }
}
