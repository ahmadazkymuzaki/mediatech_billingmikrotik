<?php defined('BASEPATH') or exit('No direct script access allowed');

class Cetakbill extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(['customer_m', 'package_m', 'services_m', 'setting_m', 'bill_m', 'income_m', 'report_m']);
    }

    public function print($invoice)
    {
        $data['title'] = 'Invoice';
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['invoice'] = $this->bill_m->getBill($invoice);
        $data['invoice_detail'] = $this->bill_m->getDetailBill($invoice);
        $data['bill'] = $this->bill_m->getBill($invoice)->row_array();
        $data['bank'] = $this->setting_m->getBank()->result();
        $data['p_item'] = $this->package_m->getPItem()->result();
        $data['other'] = $this->db->get('other')->row_array();
        $this->load->view('backend/bill/invoiceThermal', $data);
    }
}
