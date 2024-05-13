<?php defined('BASEPATH') or exit('No direct script access allowed');

class Slide_m extends CI_Model
{
    public function get($slide_id = null)
    {
        $this->db->select('*');
        $this->db->from('slide');
        if ($slide_id != null) {
            $this->db->where('slide_id', $slide_id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function add($post)
    {
        $params = [
            'name' => $post['name'],
            'picture' => $post['picture'],
            'link' => $post['link'],
            'description' => $post['description'],
        ];
        $this->db->insert('slide', $params);
    }
    public function edit($post)
    {
        $params = [
            'name' => $post['name'],
            'link' => $post['link'],
            'description' => $post['description'],
        ];
        if (!empty(@FILES['picture']['name'])) {
            $params['picture'] = $post['picture'];
        }
        $this->db->where('slide_id', $post['slide_id']);
        $this->db->update('slide', $params);
    }
    public function del($slide_id)
    {
        $this->db->where('slide_id', $slide_id);
        $this->db->delete('slide');
    }
}
