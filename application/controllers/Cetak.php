<?php defined('BASEPATH') or exit('No direct script access allowed');

class Cetak extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    public function karyawan($user_id)
    {
        $data['title'] = 'Print Data Pelanggan';
        $data['user']  = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $dataUser      = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['company'] = $this->db->get('company')->row_array();
        $this->load->library('ciqrcode'); //pemanggilan library QR CODE
        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/images/qrcode/USR/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);
        $image_name = 'USR-' . $dataUser['no_services'] . '.png'; //buat name dari qr code
        $params['data'] = site_url() . 'cetak/karyawan/' . $dataUser['id']; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
        $this->load->view('backend/user/printdata', $data);
    }
    public function pelanggan($customer_id)
    {
        $data['title'] = 'Print Data Pelanggan';
        $data['customer'] = $this->db->get_where('customer', array('customer_id' => $customer_id))->row_array();
        $dataCustomer  = $this->db->get_where('customer', array('customer_id' => $customer_id))->row_array();
        $data['company'] = $this->db->get('company')->row_array();
        $this->load->library('ciqrcode'); //pemanggilan library QR CODE
        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/images/qrcode/PLG/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);
        $image_name = 'PLG-' . $dataCustomer['no_services'] . '.png'; //buat name dari qr code
        $params['data'] = site_url() . 'cetak/pelanggan/' . $dataCustomer['customer_id']; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
        $this->load->view('backend/customer/printdata', $data);
    }
}