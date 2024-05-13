<?php defined('BASEPATH') or exit('No direct script access allowed');

class Setting_m extends CI_Model
{
    public function getCompany($id = null)
    {
        $this->db->select('*');
        $this->db->from('company');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function getBank($id = null)
    {
        $this->db->select('*');
        $this->db->from('bank');
        if ($id != null) {
            $this->db->where('bank_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function getMyCompany()
    {
        $this->db->select('*');
        $this->db->from('company');
        $query = $this->db->get();
        return $query;
    }
    public function getChannel($id = null)
    {
        $this->db->select('*');
        $this->db->from('channel');
        if ($id != null) {
            $this->db->where('id_channel', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function getChannelAktif()
    {
        $this->db->select('*');
        $this->db->from('channel');
        $this->db->where('status_channel', 'Aktif');
        $query = $this->db->get();
        return $query;
    }
    public function addBank($post)
    {
        $params = [
            'name' => htmlspecialchars($post['name']),
            'no_rek' => $post['no_rek'],
            'owner' => htmlspecialchars($post['owner']),
        ];
        $this->db->insert('bank', $params);
    }
    public function editBank($post)
    {
        $params = [
            'name' => htmlspecialchars($post['name']),
            'no_rek' => $post['no_rek'],
            'owner' => htmlspecialchars($post['owner']),
        ];
        $this->db->where('bank_id',  $post['bank_id']);
        $this->db->update('bank', $params);
    }
    public function deleteBank($bank_id)
    {
        $this->db->where('bank_id', $bank_id);
        $this->db->delete('bank');
    }
    public function editCompany($post)
    {
        $params = [
            'company_name' => htmlspecialchars($post['company_name']),
            'sub_name' => htmlspecialchars($post['sub_name']),
            'nama_singkat' => htmlspecialchars($post['nama_singkat']),
            'due_date' => $post['due_date'],
            'owner' => $post['owner'],
            'address' => $post['address'],
            'email' => $post['email'],
            'phone' => $post['phone'],
            'about' => $post['about'],
            'ppn' => $post['ppn'],
            'keyword' => $post['keyword'],
            'refresh' => $post['refresh'],
            'whatsapp' => $post['whatsapp'],
            'facebook' => $post['facebook'],
            'twitter' => $post['twitter'],
            'instagram' => $post['instagram'],
            'youtube' => $post['youtube'],
            'telegram' => $post['telegram'],
            'website' => $post['website'],
            'billing' => $post['billing'],
            'latitude' => $post['latitude'],
            'longitude' => $post['longitude'],
            'link_app' => $post['link_app'],
            'user_database' => $post['user_database'],
            'pass_database' => $post['pass_database'],
            'nama_database' => $post['nama_database'],
            'theme' => $post['theme'],
            'front' => $post['front'],
            'tm_frontend' => $post['tm_frontend'],
            'tm_member' => $post['tm_member'],
            'tm_backend' => $post['tm_backend'],
        ];
        if (!empty($_FILES['logo']['name'])) {
            $params['logo'] = $post['logo'];
        }
        $this->db->where('status', 'Aktif');
        $this->db->update('company', $params);
    }

    public function editEmail($post)
    {
        $params = [
            'name' => htmlspecialchars($post['name']),
            'port' => $post['port'],
            'protocol' => htmlspecialchars($post['protocol']),
            'email' => htmlspecialchars($post['email']),
            'password' => htmlspecialchars($post['password']),
            'host' => htmlspecialchars($post['host']),
        ];
        $this->db->where('id',  $post['id']);
        $this->db->update('email', $params);
    }
    public function editOther($post)
    {
        $params = [
            'say_wa' => htmlspecialchars($post['say_wa']),
            'body_wa' => htmlspecialchars($post['body_wa']),
            'footer_wa' => htmlspecialchars($post['footer_wa']),
            'thanks_wa' => htmlspecialchars($post['thanks_wa']),
            'code_unique' => $post['code_unique'],
            'text_code_unique' => $post['text_code_unique'],
            'bonus_saldo' => $post['bonus_saldo'],
        ];
        $this->db->where('id', $post['id']);
        $this->db->update('other', $params);
    }

    public function getpayment()
    {
        $this->db->select('*');
        $this->db->from('payment');
        $query = $this->db->get();
        return $query;
    }
}
