<?php defined('BASEPATH') or exit('No direct script access allowed');

class Product_m extends CI_Model
{

    public function get($id = null)
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->order_by('date_created', 'desc');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function getFlash()
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->limit(4);
        $this->db->order_by('date_created', 'asc');
        $query = $this->db->get();
        return $query;
    }
    public function getproductLink($link)
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where('link', $link);
        $query = $this->db->get();
        return $query;
    }
    public function add($post, $slug)
    {

        $params = [
            'name' => htmlspecialchars($post['name']),
            'picture' => $post['picture'],
            'remark' => htmlspecialchars($post['remark']),
            'link' => $slug,
            'description' => $post['description'],
            'date_created' => time()
        ];
        $this->db->insert('product', $params);
    }
    public function edit($post)
    {
        $params = [
            'name' => htmlspecialchars($post['name']),
            'remark' => htmlspecialchars($post['remark']),
            'description' => $post['description'],
        ];
        $this->db->where('id', $post['id']);
        $this->db->update('product', $params);
    }
    public function del($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('product');
    }
}
