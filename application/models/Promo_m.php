<?php defined('BASEPATH') or exit('No direct script access allowed');

class Promo_m extends CI_Model
{
    public function get($kode_promo = null)
    {
        $this->db->select('*');
        $this->db->from('promo');
        if ($kode_promo != null) {
            $this->db->where('kode_promo', $kode_promo);
        }
        $query = $this->db->get();
        return $query;
    }
    public function add($post)
    {
        $params = [
            'kode_promo' => $post['kode_promo'],
            'mulai_promo' => $post['mulai_promo'],
            'akhir_promo' => $post['akhir_promo'],
            'judul_promo' => $post['judul_promo'],
            'gambar_promo' => $post['gambar_promo'],
            'konten_promo' => $post['konten_promo'],
            'admin_promo' => $post['admin_promo'],
            'waktu_promo' => $post['waktu_promo'],
        ];
        $this->db->insert('promo', $params);
    }
    public function edit($post)
    {
        $params = [
            'kode_promo' => $post['kode_promo'],
            'mulai_promo' => $post['mulai_promo'],
            'akhir_promo' => $post['akhir_promo'],
            'judul_promo' => $post['judul_promo'],
            'konten_promo' => $post['konten_promo'],
            'admin_promo' => $post['admin_promo'],
            'waktu_promo' => $post['waktu_promo'],
        ];
        if (!empty(@FILES['gambar_promo']['name'])) {
            $params['gambar_promo'] = $post['gambar_promo'];
        }
        $this->db->where('kode_promo', $post['kode_promo']);
        $this->db->update('promo', $params);
    }
    public function del($kode_promo)
    {
        $this->db->where('kode_promo', $kode_promo);
        $this->db->delete('promo');
    }
}
