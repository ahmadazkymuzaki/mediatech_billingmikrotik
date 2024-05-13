<?php defined('BASEPATH') or exit('No direct script access allowed');

class Member_m extends CI_Model
{

    public function getMember($email = null)
    {
        $this->db->select('*');
        $this->db->from('customer');
        if ($email != null) {
            $this->db->where('email', $email);
        }
        $query = $this->db->get();
        return $query;
    }

    public function addTestimoni($post)
    {
        $params = [
            'description' => $post['testimoni'],
            'user_id' => $this->session->userdata('id'),
            'status' => 'Menunggu',
            'date_created' => time()
        ];
        $this->db->insert('testimoni', $params);
    }
    public function editTestimoni($post)
    {
        $params = [
            'description' => $post['testimoni'],
            'status' => 'Menunggu',
            'date_created' => time()
        ];
        $this->db->where('id', $post['id']);
        $this->db->update('testimoni', $params);
    }

    public function delTestimoni($id)
    {
        $this->db->where('user_id', $id);
        $this->db->delete('testimoni');
    }
    public function getInvoice($invoice = null)
    {
        $this->db->select('*, invoice.created as created_invoice');
        $this->db->from('invoice');
        $this->db->join('customer', 'customer.no_services = invoice.no_services');
        if ($invoice != null) {
            $this->db->where('invoice', $invoice);
        }
        $this->db->order_by('created_invoice', 'DESC');
        $query = $this->db->get();
        return $query;
    }
}
