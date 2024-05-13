<?php defined('BASEPATH') or exit('No direct script access allowed');

class Slider extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model(['slide_m']);
    }
    public function index()
    {
        $data['title'] = 'Slide';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['slide'] = $this->slide_m->get()->result();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/slide/data', $data);
    }
    public function add()
    {
        $config['upload_path']          = './assets/images/slide';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 2048; // 2 Mb
        $config['file_name']             = 'slide-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $this->load->library('upload', $config);
        $post = $this->input->post(null, TRUE);
        if (@FILES['picture']['name'] != null) {
            if ($this->upload->do_upload('picture')) {
                $post['picture'] =  $this->upload->data('file_name');
                $this->slide_m->add($post);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', 'Data berhasil disimpan');
                }
                echo "<script>window.location='" . site_url('slider') . "'; </script>";
            } else {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error);
                echo "<script>window.location='" . site_url('slider') . "'; </script>";
            }
        }
    }

    public function edit()
    {
        $config['upload_path']          = './assets/images/slide';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 2048; // 2 Mb
        $config['file_name']             = 'slide-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $this->load->library('upload', $config);
        $post = $this->input->post(null, TRUE);
        if (@FILES['picture']['name'] != null) {
            if ($this->upload->do_upload('picture')) {
                $slide = $this->slide_m->get($post['slide_id'])->row();
                if ($slide->picture != null) {
                    $target_file = './assets/images/slide/' . $slide->picture;
                    unlink($target_file);
                }
                $post['picture'] =  $this->upload->data('file_name');
                $this->slide_m->edit($post);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', ' Data Slide berhasil diupdate');
                }
                echo "<script>window.location='" . site_url('slider') . "'; </script>";
            } else {
                $post['picture'] =  null;
                $this->slide_m->edit($post);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', ' Data Slide berhasil disimpan');
                }
                echo "<script>window.location='" . site_url('slider') . "'; </script>";
            }
        } else {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            echo "<script>window.location='" . site_url('slider') . "'; </script>";
        }
    }

    public function delete()
    {
        $slide_id = $this->input->post('slide_id');
        $slide = $this->slide_m->get($slide_id)->row();
        if ($slide->picture != null) {
            $target_file = './assets/images/slide/' . $slide->picture;
            unlink($target_file);
        }
        $this->slide_m->del($slide_id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Slide berhasil dihapus');
        }
        echo "<script>window.location='" . site_url('slider') . "'; </script>";
    }
}
