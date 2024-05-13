<?php

function cekSession()
{
	$ci = get_instance();
	if(!$ci->session->userdata('role_id') != 1) {
		redirect('auth');
	} else if(!$ci->session->userdata('role_id') != 2) {
		redirect('auth');
	}
}

function cekMenu()
{
	$ci = get_instance();
	if($ci->session->userdata('role_id') == 3) {
		redirect('pegawai/dashboard');
	}
}
