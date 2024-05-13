<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gaji_model extends CI_Model
{
	public function joinJabatanPGajiPegawai($bulanTahun)
	{
		$this->db->select('karyawan.kode, jabatan.nama_jabatan, jabatan.gaji_pokok, jabatan.tj_transport, jabatan.uang_makan, kehadiran.alpa');
		$this->db->from('karyawan');
		$this->db->join('kehadiran', 'kehadiran.kode = karyawan.kode');
		$this->db->join('jabatan', 'jabatan.id_jabatan = karyawan.id_jabatan');
		$this->db->where('kehadiran.bulan', $bulanTahun);
		$this->db->order_by('karyawan.nama_karyawan', 'asc');
		return $this->db->get()->result_array();
	}

	public function getJabatanPegawaiWhereName($bulanTahun, $pegawai)
	{
		$this->db->select('*');
		$this->db->from('kehadiran');
		$this->db->join('jabatan', 'jabatan.id_jabatan = kehadiran.id_jabatan');
		$this->db->join('karyawan', 'karyawan.id_pegawai = kehadiran.id_karyawan');
		$this->db->where('kehadiran.bulan', $bulanTahun);
		$this->db->where('karyawan.id_karyawan', $pegawai);
		return $this->db->get()->row_array();
	}


	// **************** GAJI PEGAWAI *********************
	public function getJoinPegawaiJabatan()
	{
		$this->db->select('karyawan.kode, jabatan.nama_jabatan, jabatan.gaji_pokok, jabatan.tj_transport, jabatan.uang_makan, kehadiran.alpa, kehadiran.bulan, kehadiran.id_kehadiran');
		$this->db->from('karyawan');
		$this->db->join('user', 'user.id_user = karyawan.id_user');
		$this->db->join('kehadiran', 'kehadiran.id_pegawai = karyawan.id_karyawan');
		$this->db->join('jabatan', 'jabatan.id_jabatan = karyawan.id_jabatan');
		$this->db->where('user.id_user', $this->session->userdata('id_user'));
		$this->db->order_by('kehadiran.bulan', 'desc');
		return $this->db->get()->result_array();
	}

	public function getCetakJoinPegawaiJabatan($idKehadiran)
	{
		$this->db->select('karyawan.kode, jabatan.nama_jabatan, jabatan.gaji_pokok, jabatan.tj_transport, jabatan.uang_makan, kehadiran.alpa, kehadiran.bulan, kehadiran.id_kehadiran');
		$this->db->from('karyawan');
		$this->db->join('user', 'user.id_user = karyawan.id_user');
		$this->db->join('kehadiran', 'kehadiran.id_pegawai = karyawan.id_karyawan');
		$this->db->join('jabatan', 'jabatan.id_jabatan = karyawan.id_jabatan');
		$this->db->where('kehadiran.id_kehadiran', $idKehadiran);
		return $this->db->get();
	}
}
