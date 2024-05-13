<?php defined('BASEPATH') or exit('No direct script access allowed');

class User_m extends CI_Model
{

    public function get($id = null)
    {
        $this->db->select('*');
        $this->db->from('user');
        //$this->db->where('email !=', 'ayenkmarley@gmail.com');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public  function edit($post)
    {
        $new_password = $this->input->post('password');
        $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

        $params['name'] = $post['name'];
        $params['is_active'] = $post['is_active'];
        $params['role_id'] = $post['role_id'];
        $params['gender'] = $post['gender'];
        $params['saldo'] = $post['saldo'];
        $params['phone'] = $post['phone'];
        $params['address'] = $post['address'];
        if (!empty($new_password)) {

            $params['password'] = $password_hash;
        }


        $this->db->where('id', $post['id']);
        $this->db->update('user', $params);
    }
    public function del($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user');
    }
}
