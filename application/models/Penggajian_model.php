<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penggajian_model extends CI_Model
{
	public function getAllPotonganGaji()
	{
		return $this->db->get('gaji')->result_array();
	}

	public function tambahDataPotonganGaji()
	{
		$data = [
			'jenis' => html_escape($this->input->post('jenis', true)),
			'jumlah' => html_escape($this->input->post('jml', true))
		];

		$this->db->insert('gaji', $data);
	}

	public function ubahDataPotonganGaji($data)
	{
		$id_gaji = $data['id_gaji'];
		// var_dump($data); die;
		$arr = [
			'jenis' => $data['jenis'],
			'jumlah' => $data['jml']
		];

		$this->db->where('id_gaji', $id_gaji);
		$this->db->update('gaji', $arr);
	}

	public function getPotonganById($id)
	{
		return $this->db->get_where('gaji', ['id_gaji' => $id])->row_array();
	}
}
