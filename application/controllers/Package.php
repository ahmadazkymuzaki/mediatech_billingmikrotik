<?php defined('BASEPATH') or exit('No direct script access allowed');

class Package extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model(['package_m', 'services_m', 'bill_m']);
    }
    public function index()
    {
        $data['title'] = 'Paket';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/package', $data);
    }
    public function Item()
    {
        $data['title'] = 'Item Layanan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['p_item'] = $this->package_m->getPItem()->result();
        $data['p_category'] = $this->package_m->getPCategory()->result();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
        $API = new routeros();
        $host = $myrouter['host_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $port = $myrouter['port_router'];
        $API->connect($host, $port, $user, $pass);
        $hotspotuser = $API->comm("/ip/hotspot/user/print");
        $hotspotuser = json_encode($hotspotuser);
        $hotspotuser = json_decode($hotspotuser, true);
        $hotspotserver = $API->comm("/ip/hotspot/print");
        $hotspotserver = json_encode($hotspotserver);
        $hotspotserver = json_decode($hotspotserver, true);
        $hotspotprofile = $API->comm("/ip/hotspot/user/profile/print");
        $hotspotprofile = json_encode($hotspotprofile);
        $hotspotprofile = json_decode($hotspotprofile, true);

        $pppsecret = $API->comm("/ppp/secret/print");
        $pppsecret = json_encode($pppsecret);
        $pppsecret = json_decode($pppsecret, true);
        $pppprofile = $API->comm("/ppp/profile/print");
        $pppprofile = json_encode($pppprofile);
        $pppprofile = json_decode($pppprofile, true);

        $dataku = [
            'totalpppprofile' => count($pppprofile),
            'pppprofile' => $pppprofile
        ];

        $mydata = [
            'totalhotspotprofile' => count($hotspotprofile),
            'hotspotprofile' => $hotspotprofile
        ];

        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/package/item', $data + $dataku + $mydata);
    }

    public function editItemnya($id)
    {
        $data['title'] = 'Edit Item';
        $data['item'] = $this->db->get_where('package_item', ['p_item_id' => $id])->row_array();
        $data['p_category'] = $this->package_m->getPCategory()->result();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
        $API = new routeros();
        $host = $myrouter['host_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $port = $myrouter['port_router'];
        $API->connect($host, $port, $user, $pass);
        $hotspotuser = $API->comm("/ip/hotspot/user/print");
        $hotspotuser = json_encode($hotspotuser);
        $hotspotuser = json_decode($hotspotuser, true);
        $hotspotserver = $API->comm("/ip/hotspot/print");
        $hotspotserver = json_encode($hotspotserver);
        $hotspotserver = json_decode($hotspotserver, true);
        $hotspotprofile = $API->comm("/ip/hotspot/user/profile/print");
        $hotspotprofile = json_encode($hotspotprofile);
        $hotspotprofile = json_decode($hotspotprofile, true);

        $pppsecret = $API->comm("/ppp/secret/print");
        $pppsecret = json_encode($pppsecret);
        $pppsecret = json_decode($pppsecret, true);
        $pppprofile = $API->comm("/ppp/profile/print");
        $pppprofile = json_encode($pppprofile);
        $pppprofile = json_decode($pppprofile, true);

        $dataku = [
            'totalpppprofile' => count($pppprofile),
            'pppprofile' => $pppprofile
        ];

        $mydata = [
            'totalhotspotprofile' => count($hotspotprofile),
            'hotspotprofile' => $hotspotprofile
        ];

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/package/edit-item', $data + $dataku + $mydata);
    }

    public function Category()
    {
        $data['title'] = 'Kategori Layanan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['p_category'] = $this->package_m->getPCategory()->result();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/package/category', $data);
    }
    public function addPcategory()
    {
        $post = $this->input->post(null, TRUE);
        $this->package_m->addPCategory($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
        }
        redirect('package/category');
    }
    public function editPcategory()
    {
        $post = $this->input->post(null, TRUE);
        $this->package_m->editPCategory($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil diperbaharui');
        }
        redirect('package/category');
    }

    public function deletePCategory()
    {
        $id = $this->input->post('p_category_id');
        if ($id <= 5) {
            $this->session->set_flashdata('error', 'Mohon Maaf, Kategori ini tidah dapat Dihapus');
            redirect('package/category');
        } else {
            $query = $this->package_m->cekCategory($id);
            if ($query->num_rows() > 0) {
                $this->session->set_flashdata('error', 'Data Kategori tidak dapat dihapus dikarenakan masih digunakan di Item Layanan atau Detail Tagihan');
                redirect('package/category');
            } else {
                $this->package_m->deletePCategory($id);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', 'Data Kategori berhasil dihapus');
                }
            }
        }
        redirect('package/category');
    }

    public function addPItem()
    {
        $config['upload_path']          = './assets/images/package';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 10048; // 10 Mb
        $config['file_name']             = 'package-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $this->load->library('upload', $config);
        $post = $this->input->post(null, TRUE);
        if (@FILES['picture']['name'] != null) {
            if ($this->upload->do_upload('picture')) {
                $post['picture'] =  $this->upload->data('file_name');
                $params = [
                    'name' => htmlspecialchars($post['name']),
                    'price' => $post['price'],
                    'reseller' => $post['reseller'],
                    'public' => $post['public'],
                    'paket_wifi' => $post['paket'],
                    'category_id' => $post['category'],
                    'description' => $post['description'],
                    'date_created' => time()
                ];
                if (!empty(@FILES['picture']['name'])) {
                    $params['picture'] = $post['picture'];
                }
                $this->db->insert('package_item', $params);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', 'Data Item Layanan berhasil disimpan');
                }
                echo "<script>window.location='" . site_url('package/item') . "'; </script>";
            } else {
                $post['picture'] =  null;
                $params = [
                    'name' => htmlspecialchars($post['name']),
                    'price' => $post['price'],
                    'reseller' => $post['reseller'],
                    'public' => $post['public'],
                    'paket_wifi' => $post['paket'],
                    'category_id' => $post['category'],
                    'description' => $post['description'],
                    'date_created' => time()
                ];
                if (!empty(@FILES['picture']['name'])) {
                    $params['picture'] = $post['picture'];
                }
                $this->db->insert('package_item', $params);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', 'Data Item Layanan berhasil disimpan');
                }
                echo "<script>window.location='" . site_url('package/item') . "'; </script>";
            }
        } else {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            echo "<script>window.location='" . site_url('package/item') . "'; </script>";
        }
    }
    public function editPItem()
    {
        $config['upload_path']          = './assets/images/package';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 10048; // 10 Mb
        $config['file_name']             = 'package-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $this->load->library('upload', $config);
        $post = $this->input->post(null, TRUE);
        if (@FILES['picture']['name'] != null) {
            if ($this->upload->do_upload('picture')) {
                $package = $this->package_m->getPItem($post['p_item_id'])->row();
                if ($package->picture != null) {
                    $target_file = './assets/images/package/' . $package->picture;
                    unlink($target_file);
                }
                $post['picture'] =  $this->upload->data('file_name');
                $params = [
                    'name' => htmlspecialchars($post['name']),
                    'price' => $post['price'],
                    'reseller' => $post['reseller'],
                    'public' => $post['public'],
                    'paket_wifi' => $post['paket'],
                    'category_id' => $post['category'],
                    'description' => $post['description'],
                    'date_created' => time()
                ];
                if (!empty(@FILES['picture']['name'])) {
                    $params['picture'] = $post['picture'];
                }
                $this->db->where('p_item_id', $post['p_item_id']);
                $this->db->update('package_item', $params);

                $dataCustomer = $this->db->get_where('customer', ['item_paket' => $post['p_item_id']])->row_array();
                $this->db->set('paket_wifi', $post['paket']);
                $this->db->where('item_paket', $post['p_item_id']);
                $this->db->update('customer');

                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', 'Data Item layanan berhasil diperbaharui');
                }
                echo "<script>window.location='" . site_url('package/item') . "'; </script>";
            } else {
                $post['picture'] =  null;
                $params = [
                    'name' => htmlspecialchars($post['name']),
                    'price' => $post['price'],
                    'reseller' => $post['reseller'],
                    'public' => $post['public'],
                    'paket_wifi' => $post['paket'],
                    'category_id' => $post['category'],
                    'description' => $post['description'],
                    'date_created' => time()
                ];
                if (!empty(@FILES['picture']['name'])) {
                    $params['picture'] = $post['picture'];
                }
                $this->db->where('p_item_id', $post['p_item_id']);
                $this->db->update('package_item', $params);

                $dataCustomer = $this->db->get_where('customer', ['item_paket' => $post['p_item_id']])->row_array();
                $this->db->set('paket_wifi', $post['paket']);
                $this->db->where('item_paket', $post['p_item_id']);
                $this->db->update('customer');

                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', 'Data Item layanan berhasil diperbaharui');
                }
                echo "<script>window.location='" . site_url('package/item') . "'; </script>";
            }
        } else {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            echo "<script>window.location='" . site_url('package/item') . "'; </script>";
        }
    }
    public function deletePItem()
    {
        $p_item_id = $this->input->post('p_item_id');
        $query = $this->services_m->cekItem($p_item_id);
        if ($query->num_rows() > 0) {
            $this->session->set_flashdata('error', 'Data Layanan tidak dapat dihapus dikarenakan masih digunakan di Layanan Pelanggan atau Detail Tagihan');
            redirect('package/item');
        }
        $query = $this->bill_m->cekItem($p_item_id);
        if ($query->num_rows() > 0) {
            $this->session->set_flashdata('error', 'Data Item tidak dapat dihapus dikarenakan masih digunakan Detail Tagihan');
            redirect('package/Item');
        } else {
            $package = $this->package_m->getPItem($p_item_id)->row();
            if ($package->picture != null) {
                $target_file = './assets/images/package/' . $package->picture;
                unlink($target_file);
            }
        }

        $this->package_m->deletePitem($p_item_id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        }
        redirect('package/item');
    }
}
