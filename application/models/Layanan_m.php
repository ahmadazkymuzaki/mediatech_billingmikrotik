<?php defined('BASEPATH') or exit('No direct script access allowed');

class Layanan_m extends CI_Model
{
    public function get($id_layanan = null)
    {
        $this->db->select('*');
        $this->db->from('layanan');
        if ($id_layanan != null) {
            $this->db->where('id_layanan', $id_layanan);
        }
        $query = $this->db->get();
        return $query;
    }
    public function getMember($id_layanan = null)
    {
        $this->db->select('*');
        $this->db->from('layanan');
        if ($id_layanan != null) {
            $this->db->where('id_layanan', $id_layanan);
        }
        $query = $this->db->get();
        return $query;
    }

    public function deletelayanan($id)
    {
        $this->db->where('id_layanan', $id);
        $this->db->delete('layanan');
    }


    public function editlayanan($id)
    {
        $params = [
            'status_layanan' => htmlspecialchars($post['status_layanan'])
        ];
        $this->db->where('id_layanan',  $id);
        $this->db->update('layanan', $params);
    }
}
