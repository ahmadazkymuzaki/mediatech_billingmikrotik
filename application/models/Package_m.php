<?php defined('BASEPATH') or exit('No direct script access allowed');

class Package_m extends CI_Model
{

    public function getPCategory($id = null)
    {
        $this->db->select('*');
        $this->db->from('package_category');
        if ($id != null) {
            $this->db->where('package_category_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function cekCategory($id = null)
    {
        $this->db->select('*');
        $this->db->from('package_item');
        if ($id != null) {
            $this->db->where('category_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function addPCategory($post)
    {
        $params = [
            'name' => htmlspecialchars($post['name']),
            'description' => htmlspecialchars($post['description']),
            'date_created' => time(),
        ];
        $this->db->insert('package_category', $params);
    }

    public function editPCategory($post)
    {
        $params = [
            'name' => htmlspecialchars($post['name']),
            'description' => htmlspecialchars($post['description']),
            'date_updated' => time(),
        ];
        $this->db->where('p_category_id', $post['p_category_id']);
        $this->db->update('package_category', $params);
    }

    public function deletePCategory($id)
    {
        $this->db->where('p_category_id', $id);
        $this->db->delete('package_category');
    }

    public function getPitem($p_item_id = null)
    {
        $this->db->select('*, package_category.name as category_name, package_item.description as descriptionItem, package_item.public as publicnya, package_item.picture as pictureItem, package_item.name as nameItem, package_item.paket_wifi as namePaket');
        $this->db->from('package_item');
        $this->db->join('package_category', 'package_category.p_category_id = package_item.category_id');
        if ($p_item_id != null) {
            $this->db->where('p_item_id', $p_item_id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function getPitemku()
    {
        $this->db->select('*, package_category.name as category_name, package_item.description as descriptionItem, package_item.public as publicnya, package_item.picture as pictureItem, package_item.name as nameItem, package_item.paket_wifi as namePaket');
        $this->db->from('package_item');
        $this->db->join('package_category', 'package_category.p_category_id = package_item.category_id');
		$this->db->where('package_item.public', 1);
        $query = $this->db->get();
        return $query;
    }

    public function getPitemAll()
    {
        $this->db->select('*, package_category.name as category_name, package_item.description as descriptionItem, package_item.public as publicnya, package_item.picture as pictureItem, package_item.name as nameItem, package_item.paket_wifi as namePaket');
        $this->db->from('package_item');
        $this->db->join('package_category', 'package_category.p_category_id = package_item.category_id');
		$this->db->where('package_item.date_update', 0);
        $query = $this->db->get();
        return $query;
    }
	
    public function deletePItem($p_item_id)
    {
        $this->db->where('p_item_id', $p_item_id);
        $this->db->delete('package_item');
    }
}
