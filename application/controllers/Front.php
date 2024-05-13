<?php defined('BASEPATH') or exit('No direct script access allowed');

class Front extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model(['services_m', 'package_m', 'product_m', 'media_m', 'slide_m', 'customer_m', 'member_m', 'bill_m', 'setting_m', 'router_m']);
	}
	public function index()
	{
		$data['title'] = 'Halaman Depan';
		$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
		$company = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
		$data['product'] = $this->product_m->get()->result();
		$data['slide'] = $this->slide_m->get()->result();
		$company = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
		$company_id = $company['id'];
		$kunjungan_awal = $company['kunjungan'];
		$kunjungan_akhir = $kunjungan_awal + 1;

		$param = [
			'kunjungan' => $kunjungan_akhir
		];
		$this->db->where('id', $company_id);
		$this->db->update('company', $param);

		$config['center'] = $company['latitude'] . ',' . $company['longitude'];
		$config['zoom'] = '12';
		$config['map_type'] = 'HYBRID';
		$config['map_height'] = '400px;';
		$config['styles'] = array(
			array(
				"name" => "No Businesses",
				"definition" => array(
					array(
						"featureType" => "poi",
						"elementType" =>
						"business",
						"stylers" => array(
							array(
								"visibility" => "off"
							)
						)
					)
				)
			)
		);

		$this->googlemaps->initialize($config);
		foreach ($this->searchQuery() as $key => $value) :
			$marker = array();
			$marker['position'] = "{$value->latitude}, {$value->longitude}";
			$base_url = base_url();
			$marker['animation'] = 'DROP';
			$marker['infowindow_content'] = '<div class="media" style="width:300px;">';
			$marker['infowindow_content'] .= '<div class="media-left">';
			$marker['infowindow_content'] .= '</div>';
			$marker['infowindow_content'] .= '<div class="media-body">';
			$marker['infowindow_content'] .= '<b>Kode Wilayah :</b> ' . $value->c_name . ' / ' . $value->comment . '<br>';
			$marker['infowindow_content'] .= '<b>Kapasitas :</b> ' . $value->kapasitas . ' Core / Port<br>';
			$marker['infowindow_content'] .= '<b>Tersedia :</b> ' . $value->tersedia . ' Core / Port<br>';
			$marker['infowindow_content'] .= '<b>Alamat Detail :</b> ' . $value->complete . '<br>';
			$marker['infowindow_content'] .= '</div>';
			$marker['infowindow_content'] .= '</div>';
			$marker['icon'] = 'https://files.naufal.co.id/public/icon/wifi.png';
			$this->googlemaps->add_marker($marker);
		endforeach;

		$this->googlemaps->initialize($config);

		$data['map'] = $this->googlemaps->create_map();


		$MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
		$MyThemes = $MyCompanyData['tm_frontend'];
		if($MyThemes == 'themes/frontend/design'){
		    $this->template->load($MyThemes, 'frontend1/homepage', $data);
		}else{
		    $this->template->load($MyThemes, 'frontend/homepage', $data);
		}
	}

	public function searchQuery()
	{
		$this->db->select('coverage.*');

		$this->db->where('coverage.latitude !=', NULL)
			->where('coverage.longitude !=', NULL);

		return $this->db->get("coverage")->result();
	}

	public function quickpayment($invoice)
	{
		$data['title'] = 'Pembayaran Cepat || Invoice ' . $invoice;
		$myinvoice = $this->db->get_where('invoice', ['invoice' => $invoice])->row_array();
		$cekinvoice = $this->db->get_where('invoice', ['invoice' => $invoice])->num_rows();
		if ($cekinvoice <= 0) {
			$this->session->set_flashdata('error', 'Invoice tidak ditemukan');
		} else {
			$no_services = $myinvoice['no_services'];
			$data['user'] = $this->db->get_where('user', ['no_services' => $no_services])->row_array();
			$data['myinvoice'] = $this->bill_m->getEditInvoice($invoice);
			$data['bill'] = $this->member_m->getInvoice($invoice)->row_array();
			$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
			$data['channel'] = $this->setting_m->getChannelAktif()->result();
			$data['other'] = $this->db->get('other')->row_array();
			$data['category'] = $this->db->get('kategori')->result();
			$data['bank'] = $this->setting_m->getBank()->result();
			if ($no_services != '') {
				$data['CountServices'] = $this->services_m->getServices($no_services)->num_rows();
				$data['no_services'] = $no_services;
				$bill = $this->bill_m->getBillThisMonth($no_services)->row();
				if ($bill != '') {
					$data['totalBill'] = $this->bill_m->getBillThisMonth($no_services)->num_rows();
					$data['CountBill'] = $this->bill_m->getBillDetail($bill->invoice)->result();
					$data['bank'] = $this->setting_m->getBank()->result();
					$data['invoice'] = $this->bill_m->getBillThisMonth($no_services)->row();
					$data['services'] = $this->services_m->getServices($no_services)->result();
				} else {
					$data['totalBill'] = 0;
					$data['CountBill'] = 0;
				}

				$MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
				$MyThemes = $MyCompanyData['tm_frontend'];
        		if($MyThemes == 'themes/frontend/design'){
        		    $this->template->load($MyThemes, 'frontend1/quickpayment', $data);
        		}else{
        		    $this->template->load($MyThemes, 'frontend/quickpayment', $data);
        		}
			}
		}
	}
	public function cektagihan($identitas)
	{
		$data['title'] = 'Cek Tagihan';
		$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
		$data['identitas'] = $identitas;
		$data['product'] = $this->product_m->get()->result();
		$data['slide'] = $this->slide_m->get()->result();

		$MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
		$MyThemes = $MyCompanyData['tm_frontend'];
        if($MyThemes == 'themes/frontend/design'){
        	$this->template->load($MyThemes, 'frontend1/welcome_message', $data);
        }else{
        	$this->template->load($MyThemes, 'frontend/welcome_message', $data);
        }
	}
	public function tagihansaya()
	{
		$data['title'] = 'Cek Tagihan';
		$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
		$MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
		$MyThemes = $MyCompanyData['tm_frontend'];
        if($MyThemes == 'themes/frontend/design'){
        	$this->template->load($MyThemes, 'frontend1/tagihan', $data);
        }else{
        	$this->template->load($MyThemes, 'frontend/tagihan', $data);
        }
	}
	public function cekkuota()
	{
		$data['title'] = 'Cek Kuota';
		$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
		$MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
		$MyThemes = $MyCompanyData['tm_frontend'];
        if($MyThemes == 'themes/frontend/design'){
        	$this->template->load($MyThemes, 'frontend1/kuota', $data);
        }else{
        	$this->template->load($MyThemes, 'frontend/kuota', $data);
        }
	}
	public function cekkoneksi()
	{
		$data['title'] = 'Cek Koneksi';
		$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
		$MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
		$MyThemes = $MyCompanyData['tm_frontend'];
        if($MyThemes == 'themes/frontend/design'){
        	$this->template->load($MyThemes, 'frontend1/koneksi', $data);
        }else{
        	$this->template->load($MyThemes, 'frontend/koneksi', $data);
        }
	}
	public function view_kuota()
	{
		$no_services = $this->input->post('no_services');
		$month = $this->input->post('month');
		$year = $this->input->post('year');
		$data['other'] = $this->db->get('other')->row_array();
		$data['bill'] =  $this->services_m->getCekBill($no_services, $month, $year);
		$data['customer'] =  $this->customer_m->getNSCustomer($no_services);

		$cekdataku = $this->db->get_where('customer', array('no_services' => $no_services))->num_rows();
		
		if($cekdataku > 0){
    		$data['title'] = 'Detail Kuota';
    		$data['no_services'] = $no_services;
    		$data['month'] = $month;
    		$data['year'] = $year;
    		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    		$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
		    $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
		    $MyThemes = $MyCompanyData['tm_frontend'];
            if($MyThemes == 'themes/frontend/design'){
            	$this->load->view('frontend1/cek_kuota', $data);
            }else{
                $this->load->view('frontend/cek_kuota', $data);
            }
		}else{
    		$data['title'] = 'Detail Kuota';
    		$data['no_services'] = $no_services;
    		$data['month'] = $month;
    		$data['year'] = $year;
    		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    		$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
		    $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
		    $MyThemes = $MyCompanyData['tm_frontend'];
            if($MyThemes == 'themes/frontend/design'){
            	$this->load->view('frontend1/cek_kuota', $data);
            }else{
                $this->load->view('frontend/cek_kuota', $data);
            }
		}
	}
	public function view_koneksi()
	{
		$no_services = $this->input->post('no_services');
		$month = $this->input->post('month');
		$year = $this->input->post('year');
		$data['other'] = $this->db->get('other')->row_array();
		$data['bill'] =  $this->services_m->getCekBill($no_services, $month, $year);
		$data['customer'] =  $this->customer_m->getNSCustomer($no_services);

		$cekdataku = $this->db->get_where('customer', array('no_services' => $no_services))->num_rows();
		
		if($cekdataku > 0){
    		$data['title'] = 'Detail Kuota';
    		$data['no_services'] = $no_services;
    		$data['month'] = $month;
    		$data['year'] = $year;
    		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    		$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
    		
            $customer = $this->db->get_where('customer', array('no_services' => $no_services))->row_array();
                
            $username    = $customer['username'];
            $name_router = $customer['router'];
        	$API = new routeros();
        	$router = $this->db->get_where('router', array('name_router' => $name_router))->row_array();
        	$port = $router['port_router'];
        	$host = $router['host_router'];
        	$user = $router['user_router'];
        	$pass = $router['pass_router'];
        	$API->connect($host, $port, $user, $pass);
        	$pppactive = $API->comm("/ppp/active/print", array(
        		'?name' => $username,
        	));
        	$pppactive  = json_encode($pppactive);
        	$pppactive  = json_decode($pppactive, true);
        	
        	$pppsecret = $API->comm("/ppp/secret/print", array(
        		'?name' => $username,
        	));
        	$pppsecret  = json_encode($pppsecret);
        	$pppsecret  = json_decode($pppsecret, true);
        	
        	$name_profile = $pppsecret['0']['profile'];
        	$pppprofile = $API->comm("/ppp/profile/print", array(
        		'?name' => $name_profile,
        	));
        	$pppprofile  = json_encode($pppprofile);
        	$pppprofile  = json_decode($pppprofile, true);

            $dataku = [
                'pppactive' => count($pppactive),
                'pppname' => $pppactive['0']['name'],
                'pppaddress' => $pppactive['0']['address'],
                'pppservice' => $pppactive['0']['service'],
                'pppuptime' => $pppactive['0']['uptime'],
                'pppencoding' => $pppactive['0']['encoding'],
                'pppcaller' => $pppactive['0']['caller-id'],
                'pppsession' => $pppactive['0']['session-id'],
                'ppplogged' => $pppsecret['0']['last-logged-out'],
                'pppreason' => $pppsecret['0']['last-disconnect-reason'],
                'pppprofile' => $pppsecret['0']['profile'],
                'ppplimit' => $pppprofile['0']['rate-limit'],
                'pppserver' => $pppprofile['0']['dns-server'],
                'ppplocal' => $pppprofile['0']['local-address'],
            ];
		    $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
		    $MyThemes = $MyCompanyData['tm_frontend'];
            if($MyThemes == 'themes/frontend/design'){
            	$this->load->view('frontend1/cek_koneksi', $data);
            }else{
                $this->load->view('frontend/cek_koneksi', $data);
            }
		}else{
    		$data['title'] = 'Detail Kuota';
    		$data['no_services'] = $no_services;
    		$data['month'] = $month;
    		$data['year'] = $year;
    		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    		$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
		    $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
		    $MyThemes = $MyCompanyData['tm_frontend'];
            if($MyThemes == 'themes/frontend/design'){
            	$this->load->view('frontend1/cek_koneksi', $data);
            }else{
                $this->load->view('frontend/cek_koneksi', $data);
            }
		}
	}
	public function detailLayanan($link)
	{
		$data['title'] = 'Detail Layanan';
		$data['product'] = $this->product_m->getProductLink($link)->row_array();
		$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

		$MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
		$MyThemes = $MyCompanyData['tm_frontend'];
        if($MyThemes == 'themes/frontend/design'){
            $this->template->load($MyThemes, 'frontend1/detail-layanan', $data);
        }else{
            $this->template->load($MyThemes, 'frontend/detail-layanan', $data);
        }
	}
	public function faq()
	{
		$data['title'] = 'FAQ';
		$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

		$MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
		$MyThemes = $MyCompanyData['tm_frontend'];
        if($MyThemes == 'themes/frontend/design'){
            $this->template->load($MyThemes, 'frontend1/faq', $data);
        }else{
            $this->template->load($MyThemes, 'frontend/faq', $data);
        }
	}
	public function produk()
	{
		$data['title'] = 'Produk Kami';
		$data['product'] = $this->product_m->get()->result();
		$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

		$MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
		$MyThemes = $MyCompanyData['tm_frontend'];
        if($MyThemes == 'themes/frontend/design'){
            $this->template->load($MyThemes, 'frontend1/produk-layanan', $data);
        }else{
            $this->template->load($MyThemes, 'frontend/produk-layanan', $data);
        }
	}
	public function download()
	{
		$data['title'] = 'Download File';
		$data['media'] = $this->media_m->get()->result();
		$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

		$MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
		$MyThemes = $MyCompanyData['tm_frontend'];
        if($MyThemes == 'themes/frontend/design'){
            $this->template->load($MyThemes, 'frontend1/download', $data);
        }else{
            $this->template->load($MyThemes, 'frontend/download', $data);
        }
	}
	public function view_bill()
	{
		$no_services = $this->input->post('no_services');
		$month = $this->input->post('month');
		$year = $this->input->post('year');
		$data['other'] = $this->db->get('other')->row_array();
		$data['bill'] =  $this->services_m->getCekBill($no_services, $month, $year);
		$data['customer'] =  $this->customer_m->getNSCustomer($no_services);

		$dataku = $this->db->get_where('customer', array('no_services' => $no_services))->row_array();
		$name = strtolower($dataku['name']);

		$API = new routeros();
		$router = $this->db->get_where('router', array('description' => 'Aktif'))->row_array();
		$port = $router['port_router'];
		$host = $router['host_router'];
		$user = $router['user_router'];
		$pass = $router['pass_router'];
		$API->connect($host, $port, $user, $pass);
		$pppuser = $API->comm("/ppp/secret/print", array(
			'?name' => $name,
		));
		$pppuser = json_encode($pppuser);
		$pppuser = json_decode($pppuser, true);

		$data['pppuser'] = $pppuser;
		$data['title'] = 'Detail Users';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

		$MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
		$MyThemes = $MyCompanyData['tm_frontend'];
        if($MyThemes == 'themes/frontend/design'){
            $this->load->view('frontend1/cek_bill', $data);
        }else{
            $this->load->view('frontend/cek_bill', $data);
        }
		$API->disconnect();
	}

	// V1.6
	public function activationuser($no_services)
	{
		$user = $this->db->get_where('user', ['no_services' => $no_services])->num_rows();

		if ($user > 0) {
			$this->db->set('is_active', 1);
			$this->db->where('no_services', $no_services);
			$this->db->update('user');
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('success', 'User berhasil aktif');
			}
			redirect('auth');
		} else {
			$this->session->set_flashdata('error', 'Data tidak ditemukan');
		}
	}
	public function activationcs($no_services)
	{
		$customer = $this->db->get_where('customer', ['no_services' => $no_services])->num_rows();
		if ($customer > 0) {
			# code...
			$this->db->set('c_status', 'Aktif');
			$this->db->where('no_services', $no_services);
			$this->db->update('customer');
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('success', 'Pelanggan berhasil aktif');
			}
			redirect('auth');
		} else {
			$this->session->set_flashdata('error', 'Data tidak ditemukan');
			redirect('auth');
		}
	}
}
