<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan_model extends CI_Model {
	public function getAllJabatan()
	{
		return $this->db->get('jabatan')->result_array();
	}

	public function tambahDataJabatan()
	{
		$data = [
			'nama_jabatan' => html_escape($this->input->post('jabatan', true)),
			'gaji_pokok' => html_escape($this->input->post('gapok', true)),
			'tj_transport' => html_escape($this->input->post('tj_transport', true)),
			'uang_makan' => html_escape($this->input->post('uang_makan', true))
		];

		$this->db->insert('jabatan', $data);
	}

	public function getJabatanById($id)
	{
		return $this->db->get_where('jabatan', ['id_jabatan' => $id])->row_array();
	}

	public function editJabatan($data)
	{
		$id_jabatan = $data['id_jabatan'];
		$arr = [
			'nama_jabatan' => html_escape($data['jabatan']),
			'gaji_pokok' => html_escape($data['gapok']),
			'tj_transport' => html_escape($data['tj_transport']),
			'uang_makan' => html_escape($data['uang_makan'])
		];

		$this->db->where('id_jabatan', $id_jabatan);
		$this->db->update('jabatan', $arr);
	}


}