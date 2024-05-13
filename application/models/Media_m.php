<?php defined('BASEPATH') or exit('No direct script access allowed');

class Media_m extends CI_Model
{
    public function get($media_id = null)
    {
        $this->db->select('*');
        $this->db->from('media');
        if ($media_id != null) {
            $this->db->where('media_id', $media_id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function add($post)
    {
        $params = [
            'name' => $post['name'],
            'media' => $post['media'],
            'description' => $post['description'],
            'link' => $post['link'],
        ];
        $this->db->insert('media', $params);
    }
    public function edit($post)
    {
        $params = [
            'name' => $post['name'],
            'description' => $post['description'],
            'link' => $post['link'],
        ];
        if (!empty(@FILES['media']['name'])) {
            $params['media'] = $post['media'];
        }
        $this->db->where('media_id', $post['media_id']);
        $this->db->update('media', $params);
    }
    public function del($media_id)
    {
        $this->db->where('media_id', $media_id);
        $this->db->delete('media');
    }
}
