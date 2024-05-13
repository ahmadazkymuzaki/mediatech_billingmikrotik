<?php defined('BASEPATH') or exit('No direct script access allowed');

class Message_m extends CI_Model
{
    public function get($message_id = null)
    {
        $this->db->select('*');
        $this->db->from('message');
        if ($message_id != null) {
            $this->db->where('message_id', $message_id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function getMember($message_id = null)
    {
        $this->db->select('*');
        $this->db->from('message');
        if ($message_id != null) {
            $this->db->where('message_id', $message_id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function deletepesan($tiket_pesan)
    {
        $this->db->where('tiket_pesan', $tiket_pesan);
        $this->db->delete('message');
    }


    public function editmessage($id)
    {
        $params = [
            'status_message' => htmlspecialchars($post['status_message'])
        ];
        $this->db->where('message_id',  $id);
        $this->db->update('message', $params);
    }
}
