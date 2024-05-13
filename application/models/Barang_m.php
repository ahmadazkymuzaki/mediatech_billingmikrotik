<?php defined('BASEPATH') or exit('No direct script access allowed');

class Barang_m extends CI_Model
{
    public function get($id_barang = NULL)
    {
        $this->db->select('*');
        $this->db->from('barang');
        if ($id_barang != null) {
            $this->db->where('id_barang', $id_barang);
        }
        $query = $this->db->get();
        return $query;
    }
    public function getAllBarang()
    {
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->join('merk', 'barang.id_merk = merk.id_merk', 'LEFT');
        $this->db->join('kategori', 'barang.id_kategori = kategori.id_kategori', 'LEFT');
        $this->db->join('supplier', 'barang.id_supplier = supplier.id_supplier', 'LEFT');
        return $this->db->get()->result_array();
    }
    public function add($post)
    {
        $params = [
            'kode_barang' => $post['kode_barang'],
            'gambar_barang' => $post['barang'],
            'nama_barang' => $post['nama_barang'],
            'panjang_barang' => $post['panjang_barang'],
            'lebar_barang' => $post['lebar_barang'],
            'tinggi_barang' => $post['tinggi_barang'],
            'berat_barang' => $post['berat_barang'],
            'stok_barang' => $post['stok_barang'],
            'harga_barang' => $post['harga_barang'],
            'diskon_barang' => $post['diskon_barang'],
            'id_merk' => $post['id_merk'],
            'id_kategori' => $post['id_kategori'],
            'id_supplier' => $post['id_supplier'],
            'link_barang' => $post['link_barang'],
            'keterangan' => $post['keterangan'],
            'status_barang' => $post['status_barang'],
        ];
        $this->db->insert('barang', $params);
    }
    public function edit($post)
    {
        $params = [
            'kode_barang' => $post['kode_barang'],
            'nama_barang' => $post['nama_barang'],
            'panjang_barang' => $post['panjang_barang'],
            'lebar_barang' => $post['lebar_barang'],
            'tinggi_barang' => $post['tinggi_barang'],
            'berat_barang' => $post['berat_barang'],
            'stok_barang' => $post['stok_barang'],
            'harga_barang' => $post['harga_barang'],
            'diskon_barang' => $post['diskon_barang'],
            'id_merk' => $post['id_merk'],
            'id_kategori' => $post['id_kategori'],
            'id_supplier' => $post['id_supplier'],
            'link_barang' => $post['link_barang'],
            'keterangan' => $post['keterangan'],
            'status_barang' => $post['status_barang'],
        ];
        if (!empty(@FILES['barang']['name'])) {
            $params['gambar_barang'] = $post['barang'];
        }
        $this->db->where('id_barang', $post['id_barang']);
        $this->db->update('barang', $params);
    }
    public function del($id_barang)
    {
        $this->db->where('id_barang', $id_barang);
        $this->db->delete('barang');
    }
}
