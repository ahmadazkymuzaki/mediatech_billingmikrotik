<?php defined('BASEPATH') or exit('No direct script access allowed');

class Media extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model(['media_m']);
    }
    public function index()
    {
        $data['title'] = 'Media';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['media'] = $this->media_m->get()->result();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/media/data', $data);
    }
    public function add()
    {
        $config['upload_path']          = './assets/images/media';
        $config['allowed_types']        = 'gif|jpg|png|jpeg|pdf|mp4|mp3';
        $config['max_size']             = 12048; // 12 Mb
        $config['file_name']             = 'media-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $this->load->library('upload', $config);
        $post = $this->input->post(null, TRUE);
        if (@FILES['media']['name'] != null) {
            if ($this->upload->do_upload('media')) {
                $post['media'] =  $this->upload->data('file_name');
                $this->media_m->add($post);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', 'Data berhasil disimpan');
                }
                echo "<script>window.location='" . site_url('media') . "'; </script>";
            } else {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error);
                echo "<script>window.location='" . site_url('media') . "'; </script>";
            }
        }
    }

    public function edit()
    {
        $config['upload_path']          = './assets/images/media';
        $config['allowed_types']        = 'gif|jpg|png|jpeg|pdf|mp4|mp3';
        $config['max_size']             = 12048; // 12 Mb
        $config['file_name']             = 'media-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $this->load->library('upload', $config);
        $post = $this->input->post(null, TRUE);
        if (@FILES['media']['name'] != null) {
            if ($this->upload->do_upload('media')) {
                $media = $this->media_m->get($post['media_id'])->row();
                if ($media->media != null) {
                    $target_file = './assets/images/media/' . $media->media;
                    unlink($target_file);
                }
                $post['media'] =  $this->upload->data('file_name');
                $this->media_m->edit($post);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', ' Data Media berhasil diupdate');
                }
                echo "<script>window.location='" . site_url('media') . "'; </script>";
            } else {
                $post['media'] =  null;
                $this->media_m->edit($post);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', ' Data Media berhasil disimpan');
                }
                echo "<script>window.location='" . site_url('media') . "'; </script>";
            }
        } else {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            echo "<script>window.location='" . site_url('media') . "'; </script>";
        }
    }

    public function delete()
    {
        $media_id = $this->input->post('media_id');
        $media = $this->media_m->get($media_id)->row();
        if ($media->media != null) {
            $target_file = './assets/images/media/' . $media->media;
            unlink($target_file);
        }
        $this->media_m->del($media_id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Media berhasil dihapus');
        }
        echo "<script>window.location='" . site_url('media') . "'; </script>";
    }
}
