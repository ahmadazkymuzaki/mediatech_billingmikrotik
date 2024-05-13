<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi_model extends CI_Model {
	public function joinPegawaiJabatan($bulanTahun)
	{
		$this->db->select('*');
		$this->db->from('kehadiran');
		$this->db->join('karyawan', 'karyawan.id_karyawan = kehadiran.id_karyawan');
		$this->db->join('jabatan', 'jabatan.id_jabatan = kehadiran.id_jabatan');
		$this->db->join('user', 'user.id = karyawan.id_user');
		$this->db->where('kehadiran.bulan', $bulanTahun);
		return $this->db->get()->result_array();
	}
	public function joinAbsensi($bulanTahun)
	{
		$this->db->select('*');
		$this->db->from('absensi');
		$this->db->join('karyawan', 'karyawan.kode = absensi.kode');
		$this->db->join('user', 'user.id = karyawan.id_user');
		$this->db->join('jabatan', 'jabatan.id_jabatan = user.role_id');
		$this->db->where('absensi.periode', $bulanTahun);
		return $this->db->get()->result_array();
	}


	public function InputKaryawan()
	{
		$this->db->select('*');
		$this->db->from('karyawan');
		$this->db->join('jabatan', 'jabatan.id_jabatan = karyawan.id_jabatan', 'LEFT');
		$this->db->join('user', 'karyawan.id_user = user.id', 'LEFT');
		return $this->db->get()->result_array();
	}

	public function tambah_batch($data)
	{
		$jumlahData = count($data);
		// var_dump($jumlahData); die;
		if($jumlahData > 0) {
			$this->db->insert_batch('kehadiran', $data);
		}
	}


}