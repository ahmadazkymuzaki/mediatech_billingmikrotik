<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
	public function getAuthUserPegawai($username)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('karyawan', 'karyawan.id_user = user.id');
		$this->db->join('jabatan', 'jabatan.id_jabatan = karyawan.id_jabatan');
		$this->db->where('user.email', $username);
		return $this->db->get();
	}

	public function InputjoinPegawaiJabatan($bulanTahun)
	{
		return $this->db->query("
			SELECT karyawan.*, jabatan.nama_jabatan FROM karyawan 
			INNER JOIN jabatan ON karyawan.id_jabatan = jabatan.id_jabatan 
			WHERE NOT EXISTS (SELECT * FROM kehadiran 
			WHERE bulan = '$bulanTahun' AND karyawan.kode = kehadiran.kode)")->result_array();
	}

	public function tambah_batch($data)
	{
		$jumlahData = count($data);
		// var_dump($jumlahData); die;
		if ($jumlahData > 0) {
			$this->db->insert_batch('kehadiran', $data);
		}
	}
}
