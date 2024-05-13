<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Sample extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        $this->load->helper('url');

        /** Initialize Config */
        $conf['product'] = 'Sample Product';
        $conf['price'] = 20000;
        $conf['quantity'] = 1;
        $conf['comments'] = 'Sample Comments';
        $conf['expired'] = 24;
        $conf['buyer_name'] = 'Ayenk Marley';
        $conf['buyer_phone'] = '085334748768';
        $conf['buyer_email'] = 'ayenkmarley@gmail.com';
        $conf['ureturn'] = site_url('callback/ureturn');
        $conf['unotify'] = site_url('callback/unotify');
        $conf['ucancel'] = site_url('callback/ucancel');
        $conf['uniqid'] = uniqid();

        /** Load Lib and Init */
        $this->load->library('ipaymuu', $conf);

        /** Call Response */
        $response = $this->ipaymuu->response();

        /** Result Response */
        $resp = json_decode($response);
        print_r($resp);
        // print_r($resp->url);
        // redirect($resp->url);
    }

    public function ceksaldo()
    {
        /** Checking Saldo */
        $this->load->library('ipaymu');
        $response = $this->ipaymu->ceksaldo();
        print_r($response);
    }
    public function cekstatus($id)
    {
        /** Checking Saldo */
        $this->load->library('ipaymu');
        $response = $this->ipaymu->cektransaksi($id);
        print($response);
    }
}
