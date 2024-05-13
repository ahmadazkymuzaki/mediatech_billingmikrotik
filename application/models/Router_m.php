<?php defined('BASEPATH') or exit('No direct script access allowed');

class Router_m extends CI_Model
{
    public function get()
    {
        $this->db->select('*');
        $this->db->from('router');
        $query = $this->db->get();
        return $query;
    }

    function get_Router()
    {
        $query = $this->db->get('router');
        return $query;
    }


    public function editrouter($post)

    {
        $params = [
            'host_router' => htmlspecialchars($post['host_router']),
            'port_router' => htmlspecialchars($post['port_router']),
            'user_router' => htmlspecialchars($post['user_router']),
            'pass_router' => htmlspecialchars($post['pass_router']),
            'description' => htmlspecialchars($post['description']),
        ];
        $this->db->where('router_id',  $post['router_id']);
        $this->db->update('router', $params);
    }
}
