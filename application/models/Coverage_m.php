<?php defined('BASEPATH') or exit('No direct script access allowed');
class Coverage_m extends CI_Model
{
    public function getCoverage()
    {
        $this->db->select('*, wilayah_provinsi.nama as provinsi, wilayah_kabupaten.nama as kabupaten, wilayah_kecamatan.nama as kecamatan, wilayah_desa.nama as desa');
        $this->db->from('coverage');
        $this->db->join('wilayah_provinsi', 'coverage.id_prov = wilayah_provinsi.id');
        $this->db->join('wilayah_kabupaten', 'coverage.id_kab = wilayah_kabupaten.id');
        $this->db->join('wilayah_desa', 'coverage.id_kel = wilayah_desa.id');
        $this->db->join('wilayah_kecamatan', 'coverage.id_kec = wilayah_kecamatan.id');
        $this->db->order_by('c_name', 'ASC');
        $query = $this->db->get();
        return $query;
    }
    public function add($post)
    {
        $provinsi1      = $this->db->get_where('wilayah_provinsi', ['id' => $post['prop']])->row_array();
        $nama_provinsi   = 'Prov. ' . $provinsi1['nama'];
        $kabupaten1 = $this->db->get_where('wilayah_kabupaten', ['id' => $post['kota']])->row_array();
        $nama_kabupaten  = $kabupaten1['nama'];
        $kecamatan1 = $this->db->get_where('wilayah_kecamatan', ['id' => $post['kec']])->row_array();
        $nama_kecamatan  = 'Kec.' . $kecamatan1['nama'];
        $kelurahan1 = $this->db->get_where('wilayah_desa', ['id' => $post['kel']])->row_array();
        $nama_kelurahan  = $kelurahan1['nama'];
        $complete = $post['address']  . ', Rt/Rw ' . $post['nomor_rt'] . '/' . $post['nomor_rw'] . ', ' . $nama_kelurahan . ', ' . $nama_kecamatan . ', ' . $nama_kabupaten . ', ' . $nama_provinsi . ' - Indonesia ' . $post['kode_pos'];

        $params = [
            'c_name' => $post['name'],
            'address' => $post['address'],
            'nomor_rt' => $post['nomor_rt'],
            'nomor_rw' => $post['nomor_rw'],
            'kode_pos' => $post['kode_pos'],
            'id_prov' => $post['prop'],
            'id_kab' => $post['kota'],
            'id_kec' => $post['kec'],
            'id_kel' => $post['kel'],
            'complete' => $complete,
            'latitude' => $post['latitude'],
            'longitude' => $post['longitude'],
            'port_pon' => $post['port_pon'],
            'kapasitas' => $post['kapasitas'],
            'tersedia' => $post['tersedia'],
            'redaman' => $post['redaman'],
            'tube' => $post['tube'],
            'kategori' => $post['kategori'],
            'comment' => $post['comment'],
        ];
        $this->db->insert('coverage', $params);
    }
    public function edit($post)
    {
        $provinsi1      = $this->db->get_where('wilayah_provinsi', ['id' => $post['prop']])->row_array();
        $nama_provinsi   = 'Prov. ' . $provinsi1['nama'];
        $kabupaten1 = $this->db->get_where('wilayah_kabupaten', ['id' => $post['kota']])->row_array();
        $nama_kabupaten  = $kabupaten1['nama'];
        $kecamatan1 = $this->db->get_where('wilayah_kecamatan', ['id' => $post['kec']])->row_array();
        $nama_kecamatan  = 'Kec.' . $kecamatan1['nama'];
        $kelurahan1 = $this->db->get_where('wilayah_desa', ['id' => $post['kel']])->row_array();
        $nama_kelurahan  = $kelurahan1['nama'];
        $complete = $post['address']  . ', Rt/Rw ' . $post['nomor_rt'] . '/' . $post['nomor_rw'] . ', ' . $nama_kelurahan . ', ' . $nama_kecamatan . ', ' . $nama_kabupaten . ', ' . $nama_provinsi . ' - Indonesia ' . $post['kode_pos'];

        $params = [
            'c_name' => $post['name'],
            'address' => $post['address'],
            'nomor_rt' => $post['nomor_rt'],
            'nomor_rw' => $post['nomor_rw'],
            'kode_pos' => $post['kode_pos'],
            'id_prov' => $post['prop'],
            'id_kab' => $post['kota'],
            'id_kec' => $post['kec'],
            'id_kel' => $post['kel'],
            'complete' => $post['complete'],
            'latitude' => $post['latitude'],
            'longitude' => $post['longitude'],
            'port_pon' => $post['port_pon'],
            'kapasitas' => $post['kapasitas'],
            'tersedia' => $post['tersedia'],
            'redaman' => $post['redaman'],
            'tube' => $post['tube'],
            'kategori' => $post['kategori'],
            'comment' => $post['comment'],
        ];
        $this->db->where('coverage_id', $post['coverage_id']);
        $this->db->update('coverage', $params);
    }


    public function getProv()
    {
        $sql = "SELECT * FROM wilayah_provinsi";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getKab($id_prov)
    {
        $sql = "SELECT * FROM wilayah_kabupaten WHERE provinsi_id={$id_prov} ORDER BY nama";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getKec($id_kab)
    {
        $sql = "SELECT * FROM wilayah_kecamatan WHERE kabupaten_id={$id_kab} ORDER BY nama";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getKel($id_kec)
    {
        $sql = "SELECT * FROM wilayah_desa WHERE kecamatan_id={$id_kec} ORDER BY nama";
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function del($post)
    {
        $this->db->where('coverage_id', $post['coverage_id']);
        $this->db->delete('coverage');
    }

    public function getCustomer($coverage)
    {
        $this->db->select('*');
        $this->db->from('customer');
        if ($coverage != null) {
            $this->db->where('coverage', $coverage);
        }
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get();
        return $query;
    }
}
