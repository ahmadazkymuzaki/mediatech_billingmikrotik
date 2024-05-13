<?php defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_m extends CI_Model
{
    public function get($id_hotspot = null)
    {
        $this->db->select('*');
        $this->db->from('hotspot');
        if ($id_hotspot != null) {
            $this->db->where('id_hotspot', $id_hotspot);
        }
        $query = $this->db->get();
        return $query;
    }

    public function delete($id)
    {
        $this->db->where('id_hotspot', $id);
        $this->db->delete('hotspot');
    }
}
