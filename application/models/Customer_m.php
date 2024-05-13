<?php defined('BASEPATH') or exit('No direct script access allowed');

class Customer_m extends CI_Model
{

    public function getCustomer($customer_id = null, $no_services = null)
    {
        $this->db->select('*');
        $this->db->from('customer');
        if ($customer_id != null) {
            $this->db->where('customer_id', $customer_id);
        }
        if ($no_services != null) {
            $this->db->where('no_services', $no_services);
        }
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get();
        return $query;
    }
    public function getCustomerServices($no_services)
    {
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->where('no_services', $no_services);
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get();
        return $query;
    }
    public function getCustomerActive($customer_id = null, $no_services = null)
    {
        $this->db->select('*');
        $this->db->from('customer');
        if ($customer_id != null) {
            $this->db->where('customer_id', $customer_id);
        }
        if ($no_services != null) {
            $this->db->where('no_services', $no_services);
        }
        $this->db->where('c_status', 'Aktif');
        $query = $this->db->get();
        return $query;
    }
    public function getCustomerNonactive($customer_id = null, $no_services = null)
    {
        $this->db->select('*');
        $this->db->from('customer');
        if ($customer_id != null) {
            $this->db->where('customer_id', $customer_id);
        }
        if ($no_services != null) {
            $this->db->where('no_services', $no_services);
        }
        $this->db->where('c_status', 'Non-Aktif');
        $query = $this->db->get();
        return $query;
    }
    public function getCustomerFree($customer_id = null, $no_services = null)
    {
        $this->db->select('*');
        $this->db->from('customer');
        if ($customer_id != null) {
            $this->db->where('customer_id', $customer_id);
        }
        if ($no_services != null) {
            $this->db->where('no_services', $no_services);
        }
        $this->db->where('c_status', 'Gratis');
        $query = $this->db->get();
        return $query;
    }
    public function getCustomerIsolir($customer_id = null, $no_services = null)
    {
        $this->db->select('*');
        $this->db->from('customer');
        if ($customer_id != null) {
            $this->db->where('customer_id', $customer_id);
        }
        if ($no_services != null) {
            $this->db->where('no_services', $no_services);
        }
        $this->db->where('c_status', 'Isolir');
        $query = $this->db->get();
        return $query;
    }
    public function getCustomerWait($customer_id = null, $no_services = null)
    {
        $this->db->select('*');
        $this->db->from('customer');
        if ($customer_id != null) {
            $this->db->where('customer_id', $customer_id);
        }
        if ($no_services != null) {
            $this->db->where('no_services', $no_services);
        }
        $this->db->where('c_status', 'Menunggu');
        $query = $this->db->get();
        return $query;
    }



    public function getNSCustomer($no_services = null)
    {
        $this->db->select('*');
        $this->db->from('customer');
        if ($no_services != null) {
            $this->db->where('no_services', $no_services);
        }
        $query = $this->db->get();
        return $query;
    }
    public function getNSCustomerdraf($no_services = null)
    {
        $this->db->select('*');
        $this->db->from('customer');
        if ($no_services != null) {
            $this->db->where_in('no_services', $no_services);
        }
        $query = $this->db->get();
        return $query;
    }
    public function getInvoiceCustomer($no_services = null)
    {
        $this->db->select('*');
        $this->db->from('customer');
        if ($no_services != null) {
            $this->db->where('no_services', $no_services);
        }
        $query = $this->db->get();
        return $query;
    }
    public function add($post)
    {
        $datapaket = $this->db->get_where('package_item', array('p_item_id' => $post['paket']))->row_array();
        $paket = $datapaket['paket_wifi'];
        $tagihan = $datapaket['price'];
        if($post['username'] == '' || $post['username'] == NULL){
            $usernamenya = 'belum diatur';
        }else{
            $usernamenya = $post['username'];
        }
        if($post['password'] == '' || $post['password'] == NULL){
            $passwordnya = 'belum diatur';
        }else{
            $passwordnya = $post['password'];
        }
        $coverage  = $this->db->get_where('coverage', array('coverage_id' => $post['coverage']))->row_array();
        $complete  = $coverage['complete'];
        $register_date = date('Y-m-d');
        $mytanggal = date('d');
        
        $config['upload_path']          = './assets/images/ktp';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 2048; // 2 Mb
        $config['file_name']             = 'ktp-'.$post['no_services'];
        $this->load->library('upload', $config);
        if ($_FILES['ktp']['name'] != null) {
            if ($this->upload->do_upload('ktp')) {
                $post['ktp'] =  $this->upload->data('file_name');
            } else {
                $post['ktp'] =  '-';
            }
        }
        
        $params = [
            'name' => htmlspecialchars($post['name']),
            'no_services' => $post['no_services'],
            'item_paket' => $post['paket'],
            'username' => $usernamenya,
            'password' => $passwordnya,
            'paket_wifi' => $post['profile'],
            'prorata' => $post['prorata'],
            'hitung' => $post['hitung'],
            'telat' => 0,
            'tagihan' => $tagihan,
            'router' => $post['router'],
            'mode' => $post['mode'],
            'ip_address' => $post['ip_address'],
            'code_unique' => $post['code_unique'],
            'server' => $post['server'],
            'upload' => $post['upload'],
            'download' => $post['download'],
            'jenis' => $post['jenis'],
            'kode_odp' => $post['kode_odp'],
            'port_odp' => $post['port_odp'],
            'email' => $post['email'],
            'register_date' => $post['register_date'],
            'pemilik_rumah' => $post['pemilik_rumah'],
            'address' => $post['address'],
            'complete' => $complete,
            'latitude' => $post['latitude'],
            'longitude' => $post['longitude'],
            'no_wa' => $post['no_wa'],
            'type_id' => $post['type_id'],
            'no_ktp' => $post['no_ktp'],
            'ktp' => $post['ktp'],
            'c_status' => $post['status'],
            'ppn' => $post['ppn'],
            'coverage' => $post['coverage'],
            'due_date' => $post['due_date'],
            'refferal' => $post['refferal'],
            'keterangan' => $post['keterangan'],
            'created' => time(),
        ];
        $this->db->insert('customer', $params);
    }

    public function addregist($post)
    {
        $datapaket = $this->db->get_where('package_item', array('p_item_id' => $post['paket']))->row_array();
        $paket = $datapaket['paket_wifi'];
        $coverage  = $this->db->get_where('coverage', array('coverage_id' => $post['coverage']))->row_array();
        $complete  = $coverage['complete'];
        $register_date = date('Y-m-d');
        $mytanggal = date('d');
        $params = [
            'name' => htmlspecialchars($post['name']),
            'no_services' => $post['no_services'],
            'item_paket' => $post['paket'],
            'paket_wifi' => $paket,
            'username' => 'belum diatur',
            'email' => $post['email'],
            'register_date' => $register_date,
            'pemilik_rumah' => htmlspecialchars($post['pemilik_rumah']),
            'address' => $complete,
            'no_wa' => $post['no_wa'],
            'no_ktp' => $post['no_ktp'],
            'ktp' => $post['ktp'],
            'c_status' => 'Menunggu',
            'coverage' => $post['coverage'],
            'due_date' => $mytanggal,
            'refferal' => $post['refferal'],
            'created' => time(),
        ];
        $this->db->insert('customer', $params);
    }

    public function edit($post)
    {
        $datapaket = $this->db->get_where('package_item', array('p_item_id' => $post['paket']))->row_array();
        $dataCustomer = $this->db->get_where('customer', array('customer_id' => $post['customer_id']))->row_array();
        $paket = $datapaket['paket_wifi'];
        $tagihan = $datapaket['price'];
        if($post['username'] == '' || $post['username'] == NULL){
            $usernamenya = 'belum diatur';
        }else{
            $usernamenya = $post['username'];
        }
        if($post['password'] == '' || $post['password'] == NULL){
            $passwordnya = 'belum diatur';
        }else{
            $passwordnya = $post['password'];
        }
        $coverage  = $this->db->get_where('coverage', array('coverage_id' => $post['coverage']))->row_array();
        $complete  = $coverage['complete'];
        $register_date = date('Y-m-d');
        $mytanggal = date('d');
        
        $config['upload_path']          = './assets/images/ktp';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 2048; // 2 Mb
        $config['file_name']             = 'ktp-'.$post['no_services'];
        $this->load->library('upload', $config);
        if ($_FILES['ktp']['name'] != null) {
            if ($this->upload->do_upload('ktp')) {
                $target_file = './assets/images/' . $dataCustomer['ktp'];
                unlink($target_file);
                $post['ktp'] =  $this->upload->data('file_name');
                
            } else {
                $post['ktp'] = $dataCustomer['ktp'];
            }
        }

        $params = [
            'name' => htmlspecialchars($post['name']),
            'no_services' => $post['no_services'],
            'item_paket' => $post['paket'],
            'username' => $usernamenya,
            'password' => $passwordnya,
            'paket_wifi' => $post['profile'],
            'tagihan' => $tagihan,
            'prorata' => 0,
            'hitung' => 0,
            'telat' => $post['telat'],
            'router' => $post['router'],
            'mode' => $post['mode'],
            'ip_address' => $post['ip_address'],
            'code_unique' => $post['code_unique'],
            'server' => $post['server'],
            'upload' => $post['upload'],
            'download' => $post['download'],
            'jenis' => $post['jenis'],
            'kode_odp' => $post['kode_odp'],
            'port_odp' => $post['port_odp'],
            'email' => $post['email'],
            'register_date' => $post['register_date'],
            'pemilik_rumah' => $post['pemilik_rumah'],
            'address' => $post['address'],
            'complete' => $complete,
            'latitude' => $post['latitude'],
            'longitude' => $post['longitude'],
            'no_wa' => $post['no_wa'],
            'type_id' => $post['type_id'],
            'no_ktp' => $post['no_ktp'],
            'ktp' => $post['ktp'],
            'c_status' => $post['status'],
            'ppn' => $post['ppn'],
            'coverage' => $post['coverage'],
            'due_date' => $post['due_date'],
            'refferal' => $post['refferal'],
            'keterangan' => $post['keterangan'],
            'created' => time(),
        ];
        $this->db->where('customer_id', $post['customer_id']);
        $this->db->update('customer', $params);

        $datacampaign = [
            'nama_pelanggan'   => $post['name'],
            'nomor_whatsapp'   => $post['no_wa'],
            'tanggal_reminder' => $reminder,
            'update_campaign'  => $tgl_sekarang,
        ];
        $this->db->where('nomor_services', $post['no_services']);
        $this->db->update('campaign', $datacampaign);
    }


    public function delete($customer_id)
    {
        $this->db->where('customer_id', $customer_id);
        $this->db->delete('customer');
    }
}
