<?php defined('BASEPATH') or exit('No direct script access allowed');

class product extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model(['product_m']);
    }


    public function data()
    {
        $data['title'] = 'Product';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['product'] = $this->product_m->get()->result();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/website/product', $data);
    }
    public function add()
    {
        is_logged_in();
        $this->form_validation->set_rules('name', 'Name product', 'required|trim');

        $data['title'] = 'Add product';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($this->form_validation->run() == false) {
            $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
            $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
            $MyThemes = $MyCompanyData['tm_backend'];
            $this->template->load($MyThemes, 'backend/website/add-product', $data);
        } else {

            $config['upload_path']          = './assets/images/product';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 2048; // 2 Mb
            $config['file_name']             = 'product-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
            $this->load->library('upload', $config);
            $post = $this->input->post(null, TRUE);
            if (@FILES['picture']['name'] != null) {
                if ($this->upload->do_upload('picture')) {
                    $post['picture'] =  $this->upload->data('file_name');
                    $string = $this->input->post('name');
                    $trim = trim($string);
                    $pre_slug = strtolower(str_replace(" ", "-", $trim));
                    $slug = $pre_slug . '.html';
                    $this->product_m->add($post, $slug);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('success', 'Data berhasil disimpan');
                    }
                    echo "<script>window.location='" . site_url('product/data') . "'; </script>";
                } else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    echo "<script>window.location='" . site_url('product/data') . "'; </script>";
                }
            }
        }
    }
    public function edit($id)
    {
        is_logged_in();
        $this->form_validation->set_rules('product', 'Nama product', 'required');
        if ($this->form_validation->run() == FALSE) {
            $query  = $this->product_m->get($id);
            if ($query->num_rows() > 0) {
                $data['product'] = $query->row();
                $data['title'] = 'Edit product';
                $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

                $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
                $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
                $MyThemes = $MyCompanyData['tm_backend'];
                $this->template->load($MyThemes, 'backend/website/edit-product', $data);
            } else {
                echo "<script> alert ('Data tidak ditemukan');";
                echo "window.location='" . site_url('product/data') . "'; </script>";
            }
        }
    }

    public function edit_product()
    {
        is_logged_in();
        $config['upload_path']          = './assets/images/product';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 2048; // 2 Mb
        $config['file_name']             = 'product-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $this->load->library('upload', $config);
        $post = $this->input->post(null, TRUE);
        if (@FILES['picture']['name'] != null) {
            if ($this->upload->do_upload('picture')) {
                $product = $this->product_m->get($post['id'])->row();
                if ($product->picture != null) {
                    $target_file = './assets/images/product/' . $product->picture;
                    unlink($target_file);
                }
                $post['picture'] =  $this->upload->data('file_name');
                $this->product_m->edit($post);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', ' Data berhasil diupdate');
                }
                echo "<script>window.location='" . site_url('product/data') . "'; </script>";
            } else {
                $post['picture'] =  null;
                $this->product_m->edit($post);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', ' Data berhasil disimpan');
                }
                echo "<script>window.location='" . site_url('product/data') . "'; </script>";
            }
        } else {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            echo "<script>window.location='" . site_url('product/data') . "'; </script>";
        }
    }
    public function del()
    {
        $id = $this->input->post('id');
        $product = $this->product_m->get($id)->row();
        if ($product->picture != null) {
            $target_file = './assets/images/product/' . $product->picture;
            unlink($target_file);
        }
        $this->product_m->del($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        }
        echo "<script>window.location='" . site_url('product/data') . "'; </script>";
    }
}
