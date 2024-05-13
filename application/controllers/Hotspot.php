<?php

defined('BASEPATH') or exit('No direct script access allowed');

class hotspot extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model(['router_m']);
	}

	public function profile()
	{
		$data['title'] = 'Profile Hotspot';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

		$myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
		$host = $myrouter['host_router'];
		$user = $myrouter['user_router'];
		$pass = $myrouter['pass_router'];
		$port = $myrouter['port_router'];

		$API = new routeros();
		$API->connect($host, $port, $user, $pass);
		$hotspotprofile = $API->comm("/ip/hotspot/user/profile/print");
		$hotspotprofile = json_encode($hotspotprofile);
		$hotspotprofile = json_decode($hotspotprofile, true);
		$ippool = $API->comm("/ip/pool/print");
		$ippool = json_encode($ippool);
		$ippool = json_decode($ippool, true);
		$queue = $API->comm("/queue/simple/print");
		$queue = json_encode($queue);
		$queue = json_decode($queue, true);

		$datagua = [
			'ippool' => $ippool

		];

		$mydata = [
			'queue' => $queue

		];

		$dataku = [
			'totalhotspotprofile' => count($hotspotprofile),
			'hotspotprofile' => $hotspotprofile
		];

		$MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
		$MyThemes = $MyCompanyData['tm_backend'];
		$this->template->load($MyThemes, 'backend/hotspot/profile', $data + $dataku + $datagua + $mydata);
	}

	public function users()
	{
		$data['title'] = 'Users Hotspot';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

		$myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
		$host = $myrouter['host_router'];
		$user = $myrouter['user_router'];
		$pass = $myrouter['pass_router'];
		$port = $myrouter['port_router'];

		$API = new routeros();
		$API->connect($host, $port, $user, $pass);
		$hotspotuser = $API->comm("/ip/hotspot/user/print");
		$hotspotuser = json_encode($hotspotuser);
		$hotspotuser = json_decode($hotspotuser, true);
		$hotspotserver = $API->comm("/ip/hotspot/print");
		$hotspotserver = json_encode($hotspotserver);
		$hotspotserver = json_decode($hotspotserver, true);
		$hotspotprofile = $API->comm("/ip/hotspot/user/profile/print");
		$hotspotprofile = json_encode($hotspotprofile);
		$hotspotprofile = json_decode($hotspotprofile, true);

		$dataku = [
			'totalhotspotuser' => count($hotspotuser),
			'hotspotuser' => $hotspotuser
		];

		$mydata = [
			'totalhotspotserver' => count($hotspotserver),
			'hotspotserver' => $hotspotserver
		];

		$datagua = [
			'totalhotspotprofile' => count($hotspotprofile),
			'hotspotprofile' => $hotspotprofile
		];

		$MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
		$MyThemes = $MyCompanyData['tm_backend'];
		$this->template->load($MyThemes, 'backend/hotspot/user', $data + $dataku + $mydata + $datagua);
	}

	public function detail($name)
	{
		$data['title'] = 'Detail Users';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

		$myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
		$host = $myrouter['host_router'];
		$user = $myrouter['user_router'];
		$pass = $myrouter['pass_router'];
		$port = $myrouter['port_router'];

		$API = new routeros();
		$API->connect($host, $port, $user, $pass);
		$hotspotuser = $API->comm("/ip/hotspot/user/print", array(
			'?name' => $name,
		));
		$hotspotuser = json_encode($hotspotuser);
		$hotspotuser = json_decode($hotspotuser, true);
		$hotspotserver = $API->comm("/ip/hotspot/print");
		$hotspotserver = json_encode($hotspotserver);
		$hotspotserver = json_decode($hotspotserver, true);
		$hotspotprofile = $API->comm("/ip/hotspot/user/profile/print");
		$hotspotprofile = json_encode($hotspotprofile);
		$hotspotprofile = json_decode($hotspotprofile, true);
		$hotspotactive = $API->comm("/ip/hotspot/active/print");
		$hotspotactive = json_encode($hotspotactive);
		$hotspotactive = json_decode($hotspotactive, true);

		$datagua = [
			'totalhotspotactive' => count($hotspotactive),
			'hotspotactive' => $hotspotactive,
			'totalhotspotserver' => count($hotspotserver),
			'hotspotserver' => $hotspotserver,
			'totalhotspotprofile' => count($hotspotprofile),
			'hotspotprofile' => $hotspotprofile,
			'totalhotspotuser' => count($hotspotuser),
			'hotspotuser' => $hotspotuser
		];

		$MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
		$MyThemes = $MyCompanyData['tm_backend'];
		$this->template->load($MyThemes, 'backend/hotspot/detail', $data + $datagua);
	}

	public function saveedit($id)
	{
		$data['title'] = 'Edit Users';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

		$myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
		$host = $myrouter['host_router'];
		$user = $myrouter['user_router'];
		$pass = $myrouter['pass_router'];
		$port = $myrouter['port_router'];

		$API = new routeros();
		$API->connect($host, $port, $user, $pass);

		if ($post['comment'] == '') {
			$API->comm("/ip/hotspot/user/set", array(
				".id" => '*' . $id,
				"name" => $this->input->post('name'),
				"password" => $this->input->post('password'),
				"profile" => $this->input->post('profile'),
				"server" => $this->input->post('server')
			));
		} else {
			$API->comm("/ip/hotspot/user/set", array(
				".id" => '*' . $id,
				"name" => $this->input->post('name'),
				"password" => $this->input->post('password'),
				"profile" => $this->input->post('profile'),
				"server" => $this->input->post('server'),
				"comment" => $this->input->post('comment')
			));
		}

		$this->session->set_flashdata('success', 'User Hotspot ' . $this->input->post('name') . ' berhasil Diubah.');
		redirect('hotspot/detail/' . $this->input->post('name'));
		$API->disconnect();
	}

	public function reset($id)
	{
		$data['title'] = 'Delete Users';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

		$myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
		$host = $myrouter['host_router'];
		$user = $myrouter['user_router'];
		$pass = $myrouter['pass_router'];
		$port = $myrouter['port_router'];

		$API = new routeros();
		$API->connect($host, $port, $user, $pass);
		$API->comm("/ip/hotspot/user/reset-counters", array(
			'.id' => '*' . $id,
		));

		$this->session->set_flashdata('success', 'User Hotspot berhasil Direset.');
		redirect($_SERVER['HTTP_REFERER']);
		$API->disconnect();
	}

	public function generate()
	{

		$data['title'] = 'Generate Users';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

		$myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
		$host = $myrouter['host_router'];
		$user = $myrouter['user_router'];
		$pass = $myrouter['pass_router'];
		$port = $myrouter['port_router'];

		$API = new routeros();
		$API->connect($host, $port, $user, $pass);
		$hotspotuser = $API->comm("/ip/hotspot/user/print");
		$hotspotuser = json_encode($hotspotuser);
		$hotspotuser = json_decode($hotspotuser, true);
		$hotspotserver = $API->comm("/ip/hotspot/print");
		$hotspotserver = json_encode($hotspotserver);
		$hotspotserver = json_decode($hotspotserver, true);
		$hotspotprofile = $API->comm("/ip/hotspot/user/profile/print");
		$hotspotprofile = json_encode($hotspotprofile);
		$hotspotprofile = json_decode($hotspotprofile, true);

		$dataku = [
			'totalhotspotuser' => count($hotspotuser),
			'hotspotuser' => $hotspotuser
		];

		$mydata = [
			'totalhotspotserver' => count($hotspotserver),
			'hotspotserver' => $hotspotserver
		];

		$datagua = [
			'totalhotspotprofile' => count($hotspotprofile),
			'hotspotprofile' => $hotspotprofile
		];

		$MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
		$MyThemes = $MyCompanyData['tm_backend'];
		$this->template->load($MyThemes, 'backend/hotspot/generate', $data + $dataku + $mydata + $datagua);
	}

	public function cetak($comment)
	{
		$data['title'] = 'Detail Users';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

		$myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
		$host = $myrouter['host_router'];
		$user = $myrouter['user_router'];
		$pass = $myrouter['pass_router'];
		$port = $myrouter['port_router'];

		$API = new routeros();
		$API->connect($host, $port, $user, $pass);
		$hotspotuser = $API->comm("/ip/hotspot/user/print", array(
			'?comment' => $comment,
		));
		$hotspotuser = json_encode($hotspotuser);
		$hotspotuser = json_decode($hotspotuser, true);
		$hotspotprofile = $API->comm("/ip/hotspot/profile/print");
		$hotspotprofile = json_encode($hotspotprofile);
		$hotspotprofile = json_decode($hotspotprofile, true);

		$dataku = [
			'totalhotspotuser' => count($hotspotuser),
			'hotspotuser' => $hotspotuser
		];

		$datagua = [
			'dnsname' => $hotspotprofile['0']['dns-name'],
		];

		$this->load->view('backend/hotspot/print', $data + $dataku + $datagua);
	}

	public function enable($id)
	{
		$data['title'] = 'Enable Users';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

		$myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
		$host = $myrouter['host_router'];
		$user = $myrouter['user_router'];
		$pass = $myrouter['pass_router'];
		$port = $myrouter['port_router'];

		$API = new routeros();
		$API->connect($host, $port, $user, $pass);
		$API->comm("/ip/hotspot/user/enable", array(
			'.id' => '*' . $id,
		));

		$this->session->set_flashdata('success', 'User Hotspot berhasil Diaktifkan.');
		redirect($_SERVER['HTTP_REFERER']);
		$API->disconnect();
	}

	public function disable($id)
	{
		$data['title'] = 'Disable Users';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

		$myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
		$host = $myrouter['host_router'];
		$user = $myrouter['user_router'];
		$pass = $myrouter['pass_router'];
		$port = $myrouter['port_router'];

		$API = new routeros();
		$API->connect($host, $port, $user, $pass);
		$API->comm("/ip/hotspot/user/disable", array(
			'.id' => '*' . $id,
		));

		$this->session->set_flashdata('success', 'User Hotspot berhasil Dinon-aktifkan.');
		redirect($_SERVER['HTTP_REFERER']);
		$API->disconnect();
	}

	public function cookie()
	{
		$data['title'] = 'Cookies Hotspot';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

		$myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
		$host = $myrouter['host_router'];
		$user = $myrouter['user_router'];
		$pass = $myrouter['pass_router'];
		$port = $myrouter['port_router'];

		$API = new routeros();
		$API->connect($host, $port, $user, $pass);
		$hotspotcookie = $API->comm("/ip/hotspot/cookie/print");
		$hotspotcookie = json_encode($hotspotcookie);
		$hotspotcookie = json_decode($hotspotcookie, true);

		$dataku = [
			'totalhotspotcookie' => count($hotspotcookie),
			'hotspotcookie' => $hotspotcookie
		];

		$MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
		$MyThemes = $MyCompanyData['tm_backend'];
		$this->template->load($MyThemes, 'backend/hotspot/cookie', $data + $dataku);
	}

	public function binding()
	{
		$data['title'] = 'Binding Hotspot';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

		$myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
		$host = $myrouter['host_router'];
		$user = $myrouter['user_router'];
		$pass = $myrouter['pass_router'];
		$port = $myrouter['port_router'];

		$API = new routeros();
		$API->connect($host, $port, $user, $pass);
		$hotspotbinding = $API->comm("/ip/hotspot/ip-binding/print");
		$hotspotbinding = json_encode($hotspotbinding);
		$hotspotbinding = json_decode($hotspotbinding, true);
		$hotspotserver = $API->comm("/ip/hotspot/print");
		$hotspotserver = json_encode($hotspotserver);
		$hotspotserver = json_decode($hotspotserver, true);

		$dataku = [
			'totalhotspotbinding' => count($hotspotbinding),
			'hotspotbinding' => $hotspotbinding
		];

		$mydata = [
			'totalhotspotserver' => count($hotspotserver),
			'hotspotserver' => $hotspotserver
		];

		$MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
		$MyThemes = $MyCompanyData['tm_backend'];
		$this->template->load($MyThemes, 'backend/hotspot/binding', $data + $dataku + $mydata);
	}

	public function active()
	{
		$data['title'] = 'Active Hotspot';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

		$myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
		$host = $myrouter['host_router'];
		$user = $myrouter['user_router'];
		$pass = $myrouter['pass_router'];
		$port = $myrouter['port_router'];

		$API = new routeros();
		$API->connect($host, $port, $user, $pass);
		$hotspotactive = $API->comm("/ip/hotspot/active/print");
		$hotspotactive = json_encode($hotspotactive);
		$hotspotactive = json_decode($hotspotactive, true);

		$dataku = [
			'totalhotspotactive' => count($hotspotactive),
			'hotspotactive' => $hotspotactive
		];

		$MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
		$MyThemes = $MyCompanyData['tm_backend'];
		$this->template->load($MyThemes, 'backend/hotspot/active', $data + $dataku);
	}

	public function walled()
	{
		$data['title'] = 'Walled Garden';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

		$myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
		$host = $myrouter['host_router'];
		$user = $myrouter['user_router'];
		$pass = $myrouter['pass_router'];
		$port = $myrouter['port_router'];

		$API = new routeros();
		$API->connect($host, $port, $user, $pass);
		$hotspotwalled = $API->comm("/ip/hotspot/walled-garden/print");
		$hotspotwalled = json_encode($hotspotwalled);
		$hotspotwalled = json_decode($hotspotwalled, true);
		$hotspotserver = $API->comm("/ip/hotspot/print");
		$hotspotserver = json_encode($hotspotserver);
		$hotspotserver = json_decode($hotspotserver, true);

		$dataku = [
			'totalhotspotwalled' => count($hotspotwalled),
			'hotspotwalled' => $hotspotwalled
		];

		$mydata = [
			'totalhotspotserver' => count($hotspotserver),
			'hotspotserver' => $hotspotserver
		];

		$MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
		$MyThemes = $MyCompanyData['tm_backend'];
		$this->template->load($MyThemes, 'backend/hotspot/walled', $data + $dataku + $mydata);
	}

	public function hosts()
	{
		$data['title'] = 'Hosts Hotspot';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

		$myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
		$host = $myrouter['host_router'];
		$user = $myrouter['user_router'];
		$pass = $myrouter['pass_router'];
		$port = $myrouter['port_router'];

		$API = new routeros();
		$API->connect($host, $port, $user, $pass);
		$hotspothosts = $API->comm("/ip/hotspot/host/print");
		$hotspothosts = json_encode($hotspothosts);
		$hotspothosts = json_decode($hotspothosts, true);

		$dataku = [
			'totalhotspothosts' => count($hotspothosts),
			'hotspothosts' => $hotspothosts
		];

		$MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
		$MyThemes = $MyCompanyData['tm_backend'];
		$this->template->load($MyThemes, 'backend/hotspot/hosts', $data + $dataku);
	}

	public function adduser()
	{
		$post = $this->input->post(null, true);
		$data['title'] = 'Tambah User';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

		$myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
		$host = $myrouter['host_router'];
		$user = $myrouter['user_router'];
		$pass = $myrouter['pass_router'];
		$port = $myrouter['port_router'];

		$API = new routeros();
		$API->connect($host, $port, $user, $pass);

		$API->comm("/ip/hotspot/user/add", array(
			"name" => $post['name'],
			"password" => $post['password'],
			"profile" => $post['profile'],
			"server" => $post['server'],
			"comment" => $post['comment']
		));

		$this->session->set_flashdata('success', 'User Hotspot berhasil Ditambah.');
		redirect($_SERVER['HTTP_REFERER']);
		$API->disconnect();
	}

	public function addgenerate()
	{
		$post = $this->input->post(null, true);
		$data['title'] = 'Generate Users';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

		$myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
		$host = $myrouter['host_router'];
		$user = $myrouter['user_router'];
		$pass = $myrouter['pass_router'];
		$port = $myrouter['port_router'];


		$API = new routeros();
		$API->connect($host, $port, $user, $pass);
		$this->load->helper(array('url', 'string'));

		$jumlah = $this->input->post('jumlah');
		$panjang = $this->input->post('panjang');
		$profile = $this->input->post('profile');
		$server = $this->input->post('server');
		$prefix = $this->input->post('prefix');
		$voucher = $this->input->post('voucher');
		$waktu = $this->input->post('waktu');
		$waktu1 = $this->input->post('waktu1');
		$limit_waktu = $waktu . $waktu1;
		$kuota = $this->input->post('kuota');
		$kuota1 = $this->input->post('kuota1');
		$limit_kuota = $kuota . $kuota1;
		$karakter = $this->input->post('karakter');
		$komentar = $this->input->post('comment');
		$dibuat = $this->input->post('dibuat');
		$comment = $komentar . ' - ' . $profile;

		if ($jumlah <= 500) {

			if ($karakter == 1) {
				if ($voucher == 'beda') {
					if ($prefix == '') {
						if ($waktu == '') {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower(random_string('alpha', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower(random_string('alpha', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower(random_string('alpha', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower(random_string('alpha', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						} else {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower(random_string('alpha', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower(random_string('alpha', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower(random_string('alpha', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower(random_string('alpha', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						}
					} else {
						if ($waktu == '') {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower($prefix . random_string('alpha', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower($prefix . random_string('alpha', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower($prefix . random_string('alpha', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower($prefix . random_string('alpha', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						} else {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower($prefix . random_string('alpha', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower($prefix . random_string('alpha', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower($prefix . random_string('alpha', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower($prefix . random_string('alpha', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						}
					}
				} else {
					if ($prefix = '') {
						if ($waktu == '') {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower(random_string('alpha', $panjang)),
											"profile" => $profile,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower(random_string('alpha', $panjang)),
											"profile" => $profile,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower(random_string('alpha', $panjang)),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower(random_string('alpha', $panjang)),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						} else {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower(random_string('alpha', $panjang)),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower(random_string('alpha', $panjang)),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower(random_string('alpha', $panjang)),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower(random_string('alpha', $panjang)),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						}
					} else {
						if ($waktu == '') {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower($prefix . random_string('alpha', $panjang)),
											"profile" => $profile,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower($prefix . random_string('alpha', $panjang)),
											"profile" => $profile,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower($prefix . random_string('alpha', $panjang)),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower($prefix . random_string('alpha', $panjang)),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						} else {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower($prefix . random_string('alpha', $panjang)),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower($prefix . random_string('alpha', $panjang)),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower($prefix . random_string('alpha', $panjang)),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower($prefix . random_string('alpha', $panjang)),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						}
					}
				}
			} elseif ($karakter == 2) {
				if ($voucher == 'beda') {
					if ($prefix == '') {
						if ($waktu == '') {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower(random_string('alnum', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower(random_string('alnum', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower(random_string('alnum', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower(random_string('alnum', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						} else {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower(random_string('alnum', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower(random_string('alnum', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower(random_string('alnum', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower(random_string('alnum', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						}
					} else {
						if ($waktu == '') {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower($prefix . random_string('alnum', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower($prefix . random_string('alnum', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower($prefix . random_string('alnum', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower($prefix . random_string('alnum', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						} else {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower($prefix . random_string('alnum', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower($prefix . random_string('alnum', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower($prefix . random_string('alnum', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower($prefix . random_string('alnum', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						}
					}
				} else {
					if ($prefix = '') {
						if ($waktu == '') {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower(random_string('alnum', $panjang)),
											"profile" => $profile,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower(random_string('alnum', $panjang)),
											"profile" => $profile,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower(random_string('alnum', $panjang)),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower(random_string('alnum', $panjang)),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						} else {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower(random_string('alnum', $panjang)),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower(random_string('alnum', $panjang)),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower(random_string('alnum', $panjang)),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower(random_string('alnum', $panjang)),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						}
					} else {
						if ($waktu == '') {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower($prefix . random_string('alnum', $panjang)),
											"profile" => $profile,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower($prefix . random_string('alnum', $panjang)),
											"profile" => $profile,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower($prefix . random_string('alnum', $panjang)),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower($prefix . random_string('alnum', $panjang)),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						} else {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower($prefix . random_string('alnum', $panjang)),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower($prefix . random_string('alnum', $panjang)),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower($prefix . random_string('alnum', $panjang)),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtolower($prefix . random_string('alnum', $panjang)),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						}
					}
				}
			} elseif ($karakter == 3) {
				if ($voucher == 'beda') {
					if ($prefix == '') {
						if ($waktu == '') {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper(random_string('alpha', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper(random_string('alpha', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper(random_string('alpha', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper(random_string('alpha', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						} else {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper(random_string('alpha', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper(random_string('alpha', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper(random_string('alpha', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper(random_string('alpha', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						}
					} else {
						if ($waktu == '') {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper($prefix . random_string('alpha', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper($prefix . random_string('alpha', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper($prefix . random_string('alpha', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper($prefix . random_string('alpha', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						} else {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper($prefix . random_string('alpha', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper($prefix . random_string('alpha', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper($prefix . random_string('alpha', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper($prefix . random_string('alpha', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						}
					}
				} else {
					if ($prefix = '') {
						if ($waktu == '') {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper(random_string('alpha', $panjang)),
											"profile" => $profile,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper(random_string('alpha', $panjang)),
											"profile" => $profile,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper(random_string('alpha', $panjang)),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper(random_string('alpha', $panjang)),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						} else {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper(random_string('alpha', $panjang)),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper(random_string('alpha', $panjang)),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper(random_string('alpha', $panjang)),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper(random_string('alpha', $panjang)),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						}
					} else {
						if ($waktu == '') {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper($prefix . random_string('alpha', $panjang)),
											"profile" => $profile,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper($prefix . random_string('alpha', $panjang)),
											"profile" => $profile,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper($prefix . random_string('alpha', $panjang)),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper($prefix . random_string('alpha', $panjang)),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						} else {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper($prefix . random_string('alpha', $panjang)),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper($prefix . random_string('alpha', $panjang)),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper($prefix . random_string('alpha', $panjang)),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper($prefix . random_string('alpha', $panjang)),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						}
					}
				}
			} elseif ($karakter == 4) {
				if ($voucher == 'beda') {
					if ($prefix == '') {
						if ($waktu == '') {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper(random_string('alnum', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper(random_string('alnum', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper(random_string('alnum', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper(random_string('alnum', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						} else {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper(random_string('alnum', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper(random_string('alnum', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper(random_string('alnum', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper(random_string('alnum', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						}
					} else {
						if ($waktu == '') {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper($prefix . random_string('alnum', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper($prefix . random_string('alnum', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper($prefix . random_string('alnum', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper($prefix . random_string('alnum', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						} else {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper($prefix . random_string('alnum', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper($prefix . random_string('alnum', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper($prefix . random_string('alnum', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper($prefix . random_string('alnum', $panjang)),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						}
					}
				} else {
					if ($prefix = '') {
						if ($waktu == '') {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper(random_string('alnum', $panjang)),
											"profile" => $profile,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper(random_string('alnum', $panjang)),
											"profile" => $profile,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper(random_string('alnum', $panjang)),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper(random_string('alnum', $panjang)),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						} else {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper(random_string('alnum', $panjang)),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper(random_string('alnum', $panjang)),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper(random_string('alnum', $panjang)),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper(random_string('alnum', $panjang)),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						}
					} else {
						if ($waktu == '') {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper($prefix . random_string('alnum', $panjang)),
											"profile" => $profile,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper($prefix . random_string('alnum', $panjang)),
											"profile" => $profile,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper($prefix . random_string('alnum', $panjang)),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper($prefix . random_string('alnum', $panjang)),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						} else {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper($prefix . random_string('alnum', $panjang)),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper($prefix . random_string('alnum', $panjang)),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper($prefix . random_string('alnum', $panjang)),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => strtoupper($prefix . random_string('alnum', $panjang)),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						}
					}
				}
			} elseif ($karakter == 5) {
				if ($voucher == 'beda') {
					if ($prefix == '') {
						if ($waktu == '') {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('alpha', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('alpha', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('alpha', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('alpha', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						} else {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('alpha', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('alpha', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('alpha', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('alpha', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						}
					} else {
						if ($waktu == '') {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('alpha', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('alpha', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('alpha', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('alpha', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						} else {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('alpha', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('alpha', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('alpha', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('alpha', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						}
					}
				} else {
					if ($prefix = '') {
						if ($waktu == '') {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('alpha', $panjang),
											"profile" => $profile,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('alpha', $panjang),
											"profile" => $profile,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('alpha', $panjang),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('alpha', $panjang),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						} else {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('alpha', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('alpha', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('alpha', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('alpha', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						}
					} else {
						if ($waktu == '') {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('alpha', $panjang),
											"profile" => $profile,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('alpha', $panjang),
											"profile" => $profile,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('alpha', $panjang),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('alpha', $panjang),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						} else {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('alpha', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('alpha', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('alpha', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('alpha', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						}
					}
				}
			} elseif ($karakter == 6) {
				if ($voucher == 'beda') {
					if ($prefix == '') {
						if ($waktu == '') {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('alnum', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('alnum', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('alnum', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('alnum', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						} else {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('alnum', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('alnum', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('alnum', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('alnum', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						}
					} else {
						if ($waktu == '') {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('alnum', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('alnum', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('alnum', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('alnum', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						} else {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('alnum', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('alnum', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('alnum', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('alnum', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						}
					}
				} else {
					if ($prefix = '') {
						if ($waktu == '') {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('alnum', $panjang),
											"profile" => $profile,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('alnum', $panjang),
											"profile" => $profile,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('alnum', $panjang),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('alnum', $panjang),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						} else {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('alnum', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('alnum', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('alnum', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('alnum', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						}
					} else {
						if ($waktu == '') {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('alnum', $panjang),
											"profile" => $profile,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('alnum', $panjang),
											"profile" => $profile,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('alnum', $panjang),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('alnum', $panjang),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						} else {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('alnum', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('alnum', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('alnum', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('alnum', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						}
					}
				}
			} else {
				if ($voucher == 'beda') {
					if ($prefix == '') {
						if ($waktu == '') {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('numeric', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('numeric', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('numeric', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('numeric', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						} else {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('numeric', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('numeric', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('numeric', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('numeric', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						}
					} else {
						if ($waktu == '') {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('numeric', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('numeric', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('numeric', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('numeric', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						} else {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('numeric', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('numeric', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('numeric', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('numeric', $panjang),
											"password" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						}
					}
				} else {
					if ($prefix = '') {
						if ($waktu == '') {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						} else {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						}
					} else {
						if ($waktu == '') {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('numeric', $panjang),
											"profile" => $profile,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						} else {
							if ($kuota == '') {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"comment" => $comment,
										));
									}
								}
							} else {
								if ($komentar == '') {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $dibuat,
										));
									}
								} else {
									for ($i = 1; $i <= $jumlah; $i++) {
										$API->comm("/ip/hotspot/user/add", array(
											"name" => $prefix . random_string('numeric', $panjang),
											"profile" => $profile,
											"limit-uptime" => $limit_waktu,
											"server" => $server,
											"limit-bytes-total" => $limit_kuota,
											"comment" => $comment,
										));
									}
								}
							}
						}
					}
				}
			}

			$this->session->set_flashdata('success', $jumlah . ' Voucher berhasil Dibuat');
			$API->disconnect();
		} else {
			// $this->session->set_flashdata('error', 'Aii mik cengkal sela lah ebelei maksimal 500 Voucher koo, tak tao maca yeh? ngabes matana rah !!!'); //
			$this->session->set_flashdata('error', 'Maksimal hanya bisa generate 500 Voucher saja !');
		}
		redirect($_SERVER['HTTP_REFERER']);
		$API->disconnect();
	}

	public function addprofile()
	{
		$post = $this->input->post(null, true);
		$data['title'] = 'Tambah Profile';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

		$myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
		$host = $myrouter['host_router'];
		$user = $myrouter['user_router'];
		$pass = $myrouter['pass_router'];
		$port = $myrouter['port_router'];

		$API = new routeros();
		$API->connect($host, $port, $user, $pass);

		$API->comm("/ip/hotspot/user/profile/add", array(
			"name" => $post['name'],
			"rate-limit" => $post['limit'],
			"shared-users" => $post['shared'],
			"address-pool" => $post['address'],
			"parent-queue" => $post['parent'],
			"add-mac-cookie" => $post['cookie']
		));

		$this->session->set_flashdata('success', 'Profile Hotspot berhasil Ditambah.');
		redirect($_SERVER['HTTP_REFERER']);
		$API->disconnect();
	}

	public function addbinding()
	{
		$post = $this->input->post(null, true);
		$data['title'] = 'Tambah Binding';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

		$myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
		$host = $myrouter['host_router'];
		$user = $myrouter['user_router'];
		$pass = $myrouter['pass_router'];
		$port = $myrouter['port_router'];

		$API = new routeros();
		$API->connect($host, $port, $user, $pass);

		if ($post['address'] == '') {
			$address = '0.0.0.0';
		} else {
			$address = $post['address'];
		}
		if ($post['toaddress'] == '') {
			$toaddress = '0.0.0.0';
		} else {
			$toaddress = $post['toaddress'];
		}

		$API->comm("/ip/hotspot/ip-binding/add", array(
			"mac-address" => $post['macaddress'],
			"address" => $address,
			"to-address" => $toaddress,
			"server" => $post['server'],
			"type" => $post['typenya'],
			"comment" => $post['comment']
		));

		$this->session->set_flashdata('success', 'IP Binding berhasil Ditambah.');
		redirect($_SERVER['HTTP_REFERER']);
		$API->disconnect();
	}

	public function addwalled()
	{
		$post = $this->input->post(null, true);
		$data['title'] = 'Tambah Walled Garden';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

		$myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
		$host = $myrouter['host_router'];
		$user = $myrouter['user_router'];
		$pass = $myrouter['pass_router'];
		$port = $myrouter['port_router'];

		$API = new routeros();
		$API->connect($host, $port, $user, $pass);

		if ($post['dsthost'] == '') {
			if ($post['dstport'] == '') {
				$API->comm("/ip/hotspot/walled-garden/add", array(
					"server" => $post['server'],
					"action" => $post['action'],
					"comment" => $post['comment']
				));
			} else {
				$API->comm("/ip/hotspot/walled-garden/add", array(
					"server" => $post['server'],
					"dst-port" => $post['dstport'],
					"action" => $post['action'],
					"comment" => $post['comment']
				));
			}
		} else {
			if ($post['dstport'] == '') {
				$API->comm("/ip/hotspot/walled-garden/add", array(
					"server" => $post['server'],
					"dst-host" => $post['dsthost'],
					"action" => $post['action'],
					"comment" => $post['comment']
				));
			} else {
				$API->comm("/ip/hotspot/walled-garden/add", array(
					"server" => $post['server'],
					"dst-host" => $post['dsthost'],
					"dst-port" => $post['dstport'],
					"action" => $post['action'],
					"comment" => $post['comment']
				));
			}
		}

		$this->session->set_flashdata('success', 'Walled Garden berhasil Ditambah.');
		redirect($_SERVER['HTTP_REFERER']);
		$API->disconnect();
	}

	public function deleteprofile($id)
	{
		$data['title'] = 'Delete Profile';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

		$myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
		$host = $myrouter['host_router'];
		$user = $myrouter['user_router'];
		$pass = $myrouter['pass_router'];
		$port = $myrouter['port_router'];


		$API = new routeros();
		$API->connect($host, $port, $user, $pass);
		$API->comm("/ip/hotspot/user/profile/remove", array(
			'.id' => '*' . $id,
		));

		$this->session->set_flashdata('success', 'Profile Hotspot berhasil Dihapus.');
		redirect($_SERVER['HTTP_REFERER']);
		$API->disconnect();
	}

	public function deleteuser($id)
	{
		$data['title'] = 'Delete Users';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

		$myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
		$host = $myrouter['host_router'];
		$user = $myrouter['user_router'];
		$pass = $myrouter['pass_router'];
		$port = $myrouter['port_router'];

		$API = new routeros();
		$API->connect($host, $port, $user, $pass);
		$API->comm("/ip/hotspot/user/remove", array(
			'.id' => '*' . $id,
		));

		$this->session->set_flashdata('success', 'User Hotspot berhasil Dihapus.');
		redirect($_SERVER['HTTP_REFERER']);
		$API->disconnect();
	}

	public function deletehosts($id)
	{
		$data['title'] = 'Delete Hosts';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

		$myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
		$host = $myrouter['host_router'];
		$user = $myrouter['user_router'];
		$pass = $myrouter['pass_router'];
		$port = $myrouter['port_router'];

		$API = new routeros();
		$API->connect($host, $port, $user, $pass);
		$API->comm("/ip/hotspot/host/remove", array(
			'.id' => '*' . $id,
		));

		$this->session->set_flashdata('success', 'Host Hotspot berhasil Dihapus.');
		redirect($_SERVER['HTTP_REFERER']);
		$API->disconnect();
	}

	public function deleteactive($id)
	{
		$data['title'] = 'Delete Active';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

		$myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
		$host = $myrouter['host_router'];
		$user = $myrouter['user_router'];
		$pass = $myrouter['pass_router'];
		$port = $myrouter['port_router'];

		$API = new routeros();
		$API->connect($host, $port, $user, $pass);
		$API->comm("/ip/hotspot/active/remove", array(
			'.id' => '*' . $id,
		));

		$this->session->set_flashdata('success', 'Hotspot Active berhasil Dihapus.');
		redirect($_SERVER['HTTP_REFERER']);
		$API->disconnect();
	}

	public function deletebinding($id)
	{
		$data['title'] = 'Delete Binding';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

		$myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
		$host = $myrouter['host_router'];
		$user = $myrouter['user_router'];
		$pass = $myrouter['pass_router'];
		$port = $myrouter['port_router'];

		$API = new routeros();
		$API->connect($host, $port, $user, $pass);
		$API->comm("/ip/hotspot/ip-binding/remove", array(
			'.id' => '*' . $id,
		));

		$this->session->set_flashdata('success', 'IP Binding berhasil Dihapus.');
		redirect($_SERVER['HTTP_REFERER']);
		$API->disconnect();
	}

	public function deletewalled($id)
	{
		$data['title'] = 'Delete Walled';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

		$myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
		$host = $myrouter['host_router'];
		$user = $myrouter['user_router'];
		$pass = $myrouter['pass_router'];
		$port = $myrouter['port_router'];

		$API = new routeros();
		$API->connect($host, $port, $user, $pass);
		$API->comm("/ip/hotspot/walled-garden/remove", array(
			'.id' => '*' . $id,
		));

		$this->session->set_flashdata('success', 'Walled Garden berhasil Dihapus.');
		redirect($_SERVER['HTTP_REFERER']);
		$API->disconnect();
	}

	public function deletecookie($id)
	{
		$data['title'] = 'Delete Cookies';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

		$myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
		$host = $myrouter['host_router'];
		$user = $myrouter['user_router'];
		$pass = $myrouter['pass_router'];
		$port = $myrouter['port_router'];

		$API = new routeros();
		$API->connect($host, $port, $user, $pass);
		$API->comm("/ip/hotspot/cookie/remove", array(
			'.id' => '*' . $id,
		));

		$this->session->set_flashdata('success', 'Hotspot Cookie berhasil Dihapus.');
		redirect($_SERVER['HTTP_REFERER']);
		$API->disconnect();
	}
}
ini_set("display_errors", "off");
