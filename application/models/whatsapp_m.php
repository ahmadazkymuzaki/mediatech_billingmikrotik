<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Whatsapp_m extends CI_Model
{
	public function getAllContact()
	{
		$this->db->select('*');
		$this->db->from('campaign');
		return $this->db->get()->result_array();
	}
}
