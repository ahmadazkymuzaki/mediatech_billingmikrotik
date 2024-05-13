<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan_model extends CI_Model
{
	public function getAllKaryawan()
	{
		$this->db->select('*');
		$this->db->from('karyawan');
		$this->db->join('jabatan', 'jabatan.id_jabatan = karyawan.id_jabatan', 'LEFT');
		$this->db->join('user', 'karyawan.id_user = user.id', 'LEFT');
		return $this->db->get()->result_array();
	}
	public function getAllUser()
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('karyawan', 'karyawan.id_user = user.id');
		return $this->db->get()->result_array();
	}
	public function getAllJabatan()
	{
		$this->db->select('*');
		$this->db->from('jabatan');
		return $this->db->get()->result_array();
	}
	public function getAllKategori()
	{
		$this->db->select('*');
		$this->db->from('kategori');
		return $this->db->get()->result_array();
	}
	public function getAllMerk()
	{
		$this->db->select('*');
		$this->db->from('merk');
		return $this->db->get()->result_array();
	}
	public function getAllKurir()
	{
		$this->db->select('*');
		$this->db->from('kurir');
		return $this->db->get()->result_array();
	}
	public function getAllVoucher()
	{
		$this->db->select('*');
		$this->db->from('voucher');
		return $this->db->get()->result_array();
	}
	public function getAllSupplier()
	{
		$this->db->select('*');
		$this->db->from('supplier');
		return $this->db->get()->result_array();
	}
}
