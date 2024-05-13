<?php defined('BASEPATH') or exit('No direct script access allowed');
class Bill_m extends CI_Model
{
    public function getInvoice($invoice_id = null)
    {
        $this->db->select('*, invoice.created as created_invoice');
        $this->db->from('invoice');
        $this->db->join('customer', 'customer.no_services = invoice.no_services');
        if ($invoice_id != null) {
            $this->db->where('invoice_id', $invoice_id);
        }
        $this->db->order_by('created_invoice', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    public function getRecentInv()
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->limit(1);
        $this->db->order_by('invoice', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    public function getInvoiceUp()
    {
        $this->db->select('*, invoice.created as created_invoice');
        $this->db->from('invoice');
        $this->db->join('customer', 'customer.no_services = invoice.no_services');
        $this->db->where('status', 'Belum Bayar');
        $this->db->order_by('created_invoice', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    public function getInvoiceFilter()
    {
        $this->db->select('*, invoice.created as created_invoice');
        $this->db->from('invoice');
        $this->db->join('customer', 'customer.no_services = invoice.no_services');
        $this->db->where('month', $this->input->post('month'));
        $this->db->where('year', $this->input->post('year'));
        $this->db->order_by('created_invoice', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    public function getInvoiceFilterUnpaid()
    {
        $this->db->select('*, invoice.created as created_invoice');
        $this->db->from('invoice');
        $this->db->join('customer', 'customer.no_services = invoice.no_services');
        $this->db->where('month', $this->input->post('month'));
        $this->db->where('year', $this->input->post('year'));
        $this->db->where('status', 'BELUM BAYAR');
        $this->db->order_by('created_invoice', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    public function getInvoiceFilterpaid()
    {
        $this->db->select('*, invoice.created as created_invoice');
        $this->db->from('invoice');
        $this->db->join('customer', 'customer.no_services = invoice.no_services');
        $this->db->where('month', $this->input->post('month'));
        $this->db->where('year', $this->input->post('year'));
        $this->db->where('status', 'SUDAH BAYAR');
        if ($this->session->userdata('role_id') == 3) {
            $this->db->where('create_by', $this->session->userdata('id'));
        }
        $this->db->order_by('created_invoice', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    public function getInvoiceP()
    {
        $this->db->select('*, invoice.created as created_invoice');
        $this->db->from('invoice');
        $this->db->join('customer', 'customer.no_services = invoice.no_services');
        $this->db->where('status', 'Sudah Bayar');
        $this->db->order_by('created_invoice', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    public function getInvoicePaidby()
    {
        $this->db->select('*, invoice.created as created_invoice');
        $this->db->from('invoice');
        $this->db->join('customer', 'customer.no_services = invoice.no_services');
        $this->db->where('status', 'Sudah Bayar');
        $this->db->where('create_by', $this->session->userdata('id'));
        $this->db->order_by('created_invoice', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    public function getBillThisMonth($no_services)
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('no_services', $no_services);
        $this->db->where('month', date('m'));
        $this->db->where('year', date('Y'));
        $query = $this->db->get();
        return $query;
    }
    public function getBillbyNS($no_services = null)
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('no_services', $no_services);
        $this->db->where('year', date('Y'));
        $this->db->order_by('month', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    public function getInvoiceThisMonth($month, $year)
    {
        $this->db->select('*, invoice.created as created_invoice');
        $this->db->from('invoice');
        $this->db->join('customer', 'customer.no_services = invoice.no_services');
        $this->db->where('month', $month);
        $this->db->where('year', $year);
        $this->db->order_by('created_invoice', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    public function getInvoiceUnpaid()
    {
        $this->db->select('*, customer.name as customer_name, invoice.created as created_invoice');
        $this->db->from('invoice');
        $this->db->join('customer', 'customer.no_services = invoice.no_services');
        $this->db->where('status', 'Belum Bayar');
        $this->db->order_by('created_invoice', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    public function getBillDetail($invoice = null)
    {
        $this->db->select('*, invoice_detail.price as detail_price, package_item.name as item_name, package_category.name as category_name');
        $this->db->from('invoice_detail');
        $this->db->join('package_item', 'package_item.p_item_id = invoice_detail.item_id');
        $this->db->join('package_category', 'package_category.p_category_id = invoice_detail.category_id');
        $this->db->where('invoice_id', $invoice);
        $query = $this->db->get();
        return $query;
    }
    public function getInvoicePaid()
    {
        $this->db->select('*, customer.name as customer_name, invoice.created as created_invoice');
        $this->db->from('invoice');
        $this->db->join('customer', 'customer.no_services = invoice.no_services');
        $this->db->where('status', 'Sudah Bayar');
        $this->db->order_by('created_invoice', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function getInvoiceSelected($invoice = null)
    {
        $this->db->select('*, customer.name as customer_name, invoice.created as created_invoice, invoice.no_services as noServices');
        $this->db->from('invoice');
        $this->db->join('customer', 'customer.no_services = invoice.no_services');
        if ($invoice != null) {
            $this->db->where_in('invoice', $invoice);
        }
        $this->db->order_by('created_invoice', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    public function getInvoiceDetail($invoice = null)
    {
        $this->db->select('*');
        $this->db->from('invoice_detail');
        $this->db->where('invoice_id', $invoice);
        $query = $this->db->get();
        return $query;
    }
    public function getBill($invoice = null)
    {
        $this->db->select('*, invoice.created as created_invoice, invoice.no_services as noServices');
        $this->db->from('invoice');
        $this->db->join('customer', 'customer.no_services = invoice.no_services');
        if ($invoice != null) {
            $this->db->where_in('invoice', $invoice);
        }
        $this->db->order_by('created_invoice', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    public function getDetailBill($invoice = null)
    {
        $this->db->select('*, invoice_detail.price as detail_price, package_item.name as item_name,package_item.description as descriptionItem, package_category.name as category_name');
        $this->db->from('invoice_detail');
        $this->db->join('package_item', 'package_item.p_item_id = invoice_detail.item_id');
        $this->db->join('package_category', 'package_category.p_category_id = invoice_detail.category_id');
        $this->db->where('invoice_id', $invoice);
        $query = $this->db->get();
        return $query;
    }
    public function getEditInvoice($invoice)
    {
        $this->db->select('*, invoice_detail.price as detail_price, package_item.name as item_name, package_category.name as category_name');
        $this->db->from('invoice_detail');
        $this->db->join('package_item', 'package_item.p_item_id = invoice_detail.item_id');
        $this->db->join('package_category', 'package_category.p_category_id = invoice_detail.category_id');
        if ($invoice != null) {
            $this->db->where('invoice_id', $invoice);
        }
        $query = $this->db->get();
        return $query;
    }
    public function getPendingPayment()
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('status', 'BELUM BAYAR');
        $query = $this->db->get();
        return $query;
    }
    public function getTotalPendingPayment()
    {
        $this->db->select('*');
        $this->db->from('invoice_detail');
        $this->db->join('invoice', 'invoice.no_services = invoice_detail.d_no_services');
        $this->db->where('status', 'BELUM BAYAR');
        $query = $this->db->get();
        return $query;
    }

    public function cekItem($p_item_id = null)
    {
        $this->db->select('*');
        $this->db->from('invoice_detail');
        if ($p_item_id != null) {
            $this->db->where('item_id', $p_item_id);
        }
        $query = $this->db->get();
        return $query;
    }
    function invoice_no()
    {
        $tgl = date('ymd');
        $no = 001;
        $kode = ($tgl . '' .  str_pad($no, 3, "0", STR_PAD_LEFT));  //cek jika kode belum terdapat pada table
        $kodetampil = $kode;  //format kode
        return $kodetampil;
    }

    public function addBill($post, $invoice, $ppn, $amount)
    {
        $dataUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $create_by = $dataUser['id'];
        $params = [
            'invoice' => $invoice,
            'month' => $post['month'],
            'year' => $post['year'],
            'amount' => $amount,
            'i_ppn' => $ppn,
            'code_unique' => substr(intval(rand()), 0, 3),
            'status' => 'BELUM BAYAR',
            'create_by' => $create_by,
            'no_services' => $post['no_services'],
            'created' => time()
        ];

        $this->db->insert('invoice', $params);
    }
    public function add_bill_generate($params)
    {
        $this->db->insert_batch('invoice', $params);
    }
    public function add_bill_detail($params)
    {
        $this->db->insert_batch('invoice_detail', $params);
    }
    public function getCekInvoice($no_services = null)
    {
        $this->db->select('*');
        $this->db->from('invoice');
        if ($no_services != null) {
            $this->db->where('no_services', $no_services);
        }
        $query = $this->db->get();
        return $query;
    }
    public function delete($invoice)
    {
        $this->db->where('invoice', $invoice);
        $this->db->delete('invoice');
    }

    public function deleteDetailBill($post)
    {
        $this->db->where('d_month', $post['month']);
        $this->db->where('d_year', $post['year']);
        $this->db->where('d_no_services', $post['no_services']);
        $this->db->delete('invoice_detail');
    }
    public function deleteDetailInvoice($invoice)
    {
        $this->db->where('invoice_id', $invoice);
        $this->db->delete('invoice_detail');
    }


    public function cekPeriode($no_services, $month, $year)
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('no_services', $no_services);
        $this->db->where('month', $month);
        $this->db->where('year', $year);
        $query = $this->db->get();
        return $query;
    }
    public function cekPeriodeMonth($month, $year)
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('month', $month);
        $this->db->where('year', $year);
        $query = $this->db->get();
        return $query;
    }
    public function cekInvoice($inv)
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('invoice', $inv);
        $query = $this->db->get();
        return $query;
    }

    public function getDebt($no_services = null)
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('no_services', $no_services);
        $this->db->where('status', 'Belum Bayar');
        $query = $this->db->get();
        return $query;
    }

    // PAYMENT 
    public function payment($post)
    {	
        $params = [
            'status' => 'SUDAH BAYAR',
            'metode_payment' => 'MANUAL',
            'date_payment' => time(),
            'create_by' => $this->session->userdata('id'),
        ];
        $this->db->where('invoice', $post['invoice']);
        $this->db->update('invoice', $params);
    }
    public function confirmPayment($post)
    {
        $params = [
            'status' => 'Pending',
            'picture' => $post['picture'],
            'invoice_id' => $post['no_invoice'],
            'no_services' => $post['no_services'],
            'metode_payment' => $post['metode_payment'],
            'date_payment' => $post['date_payment'],
            'remark' => $post['remark'],
            'date_created' => time(),
        ];
        $this->db->insert('confirm_payment', $params);
    }
    public function getPendingConfirm()
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('status', 'BELUM BAYAR');
        $query = $this->db->get();
        return $query;
    }
    public function getConfirm()
    {
        $this->db->select('*');
        $this->db->from('confirm_payment');
        $query = $this->db->get();
        return $query;
    }
    public function UpdateConfirm($post)
    { {
            $params = [
                'status' => 'Terverifikasi'
            ];
            $this->db->where('confirm_id', $post['confirm_id']);
            $this->db->update('confirm_payment', $params);
        }
    }
    public function UpdateConfirmPayment($post)
    { {
            $params = [
                'status' => 'Terverifikasi'
            ];
            $this->db->where('invoice_id', $post['invoice']);
            $this->db->update('confirm_payment', $params);
        }
    }
    public function deleteconfirm($confirm_id)
    {
        $this->db->where('confirm_id', $confirm_id);
        $this->db->delete('confirm_payment');
    }
}
