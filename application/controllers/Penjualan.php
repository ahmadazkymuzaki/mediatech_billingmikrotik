<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model(['member_m', 'router_m', 'message_m', 'product_m', 'package_m',  'setting_m', 'services_m', 'customer_m', 'bill_m', 'income_m']);
	}

	public function index()
	{
		$data['title'] = 'Penjualan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
		$data['router'] = $this->router_m->get()->result();
		$data['customer'] = $this->db->get('customer')->result();
		$data['barang'] = $this->db->get('barang')->result();
		$data['channel'] = $this->setting_m->getChannelAktif()->result();
		$data['bank'] = $this->setting_m->getBank()->result();
		$data['other'] = $this->db->get('other')->row_array();
		$MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
		$MyThemes = $MyCompanyData['tm_backend'];
		$this->template->load($MyThemes, 'backend/penjualan/transaksi', $data);
	}

	public function keranjang()
	{
		$nomor_nota = $this->input->post('nomor_nota');
		$kode_barang = $this->input->post('kode_barang');
		$nama_barang = $this->input->post('nama_barang');
		$harga_barang = $this->input->post('harga_barang');
		$jumlah_awal = $this->input->post('jumlah_barang');
		$kategori_barang = $this->input->post('kategori_barang');
		$jumlah_diskon = $this->input->post('jumlah_diskon');
		$harga_awal = $this->input->post('jumlah_harga');
		$kode_karyawan = $this->input->post('kode_karyawan');

		$cek = $this->db->get_where('penjualan', ['nomor_nota' => $nomor_nota, 'kode_barang' => $kode_barang])->num_rows();
		$penjualan = $this->db->get_where('penjualan', ['nomor_nota' => $nomor_nota, 'kode_barang' => $kode_barang])->row_array();
		$mybarang = $this->db->get_where('barang', ['kode_barang' => $kode_barang])->row_array();
		$stok_awal = $mybarang['stok_barang'];
		$jumlah_akhir = $penjualan['jumlah_barang'];
		$jumlah_harga = ($harga_barang * $jumlah_awal) - $jumlah_diskon;
		$jumlah_barang = $jumlah_awal + $jumlah_akhir;
		$jumlah_harganya = ($harga_barang * $jumlah_barang) - $jumlah_diskon;
		$stok_barang = $stok_awal - $jumlah_awal;
		$stok_akhir = $stok_awal + $jumlah_akhir - $jumlah_barang;

		if ($cek > 0) {
			$this->db->set('jumlah_barang', $jumlah_barang);
			$this->db->set('jumlah_harga', $jumlah_harganya);
			$this->db->where('nomor_nota', $nomor_nota);
			$this->db->update('penjualan');

			$param = [
				'stok_barang' => $stok_akhir
			];
			$this->db->where('kode_barang', $kode_barang);
			$this->db->update('barang', $param);

			$this->session->set_flashdata('success', 'Produk berhasil Diperbarui.');
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			$array = [
				'nomor_nota' => $nomor_nota,
				'kode_barang' => $kode_barang,
				'nama_barang' => $nama_barang,
				'kategori_barang' => $kategori_barang,
				'harga_barang' => $harga_barang,
				'jumlah_barang' => $jumlah_barang,
				'jumlah_diskon' => $jumlah_diskon,
				'jumlah_harga' => $jumlah_harga,
				'kode_karyawan' => $kode_karyawan
			];
			$this->db->insert('penjualan', $array);

			$param = [
				'stok_barang' => $stok_barang
			];
			$this->db->where('kode_barang', $kode_barang);
			$this->db->update('barang', $param);

			$this->session->set_flashdata('success', 'Produk berhasil Ditambahkan.');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function deletekrjg($id_penjualan)
	{
		$penjualan = $this->db->get_where('penjualan', ['id_penjualan' => $id_penjualan])->row_array();
		$kode_barang = $penjualan['kode_barang'];
		$jumlah_awal = $penjualan['jumlah_barang'];
		$mybarang = $this->db->get_where('barang', ['kode_barang' => $kode_barang])->row_array();
		$jumlah_akhir = $mybarang['stok_barang'];
		$jumlah_barang = $jumlah_awal + $jumlah_akhir;

		$param = [
			'stok_barang' => $jumlah_barang
		];
		$this->db->where('kode_barang', $kode_barang);
		$this->db->update('barang', $param);

		$this->db->where('id_penjualan', $id_penjualan);
		$this->db->delete('penjualan');

		$this->session->set_flashdata('success', 'Produk berhasil Dihapus.');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function rajakota($provinsi)
	{
		$company = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.rajaongkir.com/starter/city?&province=" . $provinsi,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"content-type: application/x-www-form-urlencoded",
				"key: " . $company['rajaongkir']
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);
		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			$kota = json_decode($response, true);
			if ($kota['rajaongkir']['status']['code'] == '200') {
				foreach ($kota['rajaongkir']['results'] as $mykota) {
					echo "<option value='$mykota[city_id]'>$mykota[type] $mykota[city_name]</option>";
				}
			}
		}
	}

	public function rajaongkir($kota)
	{
		$company = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "origin=160&destination=" . $kota . "&weight=1000&courier=jne&service=REG",
			CURLOPT_HTTPHEADER => array(
				"content-type: application/x-www-form-urlencoded",
				"key: " . $company['rajaongkir']
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			$ongkir = json_decode($response, true);
			if ($ongkir['rajaongkir']['status']['code'] == '200') {
				foreach ($ongkir['rajaongkir']['results']['0']['costs'] as $myongkir) {
					foreach ($myongkir['cost'] as $ongkirku) {
						echo $ongkirku['value'];
					}
				}
			}
		}
	}

	public function confirmPayment()
	{
		$no_invoice = $post['no_invoice'];
		$methodPayment = $post['metode_payment'];
		$customerName = $post['name'];
		$nominal = $post['nominal'];
		$no_services = $post['no_services'];

		$myinvoice = $this->db->get_where('invoice', array('invoice' => $no_invoice))->row_array();
		$totalAmount = $myinvoice['amount'];

		$mycustomer = $this->db->get_where('customer', array('no_services' => $no_services))->row_array();
		$customerEmail = $mycustomer['email'];
		$customerDate = $mycustomer['due_date'];
		$customerPhone = $mycustomer['no_wa'];
		$customerNik = $mycustomer['no_ktp'];
		$coverage_id = $mycustomer['coverage'];

		$mypayment = $this->db->get('payment')->row_array();
		$apiKey = 'DEV-' . $mypayment['apikey_pay'];
		$myapiKey = $mypayment['apikey_pay'];
		$privateKey = $mypayment['private_key'];
		$merchantCode = $mypayment['merchant_id'];
		$urlPayment = $mypayment['url_payment'];
		$urlCallback = $mypayment['url_callback'];
		$expiredDay = $mypayment['expired_day'];

		$mydetail = $this->db->get_where('invoice_detail', array('invoice_id' => $no_invoice))->row_array();
		$p_item_id = $mydetail['item_id'];
		$detailQty = $mydetail['qty'];
		$detailPrice = $mydetail['price'];

		$mypackage = $this->db->get_where('package_item', array('p_item_id' => $p_item_id))->row_array();
		$productName = $mypackage['name'];
		$productPrice = $mypackage['price'];
		$productPaket = $mypackage['paket_wifi'];

		$mybank = $this->db->get_where('bank', array('name' => $methodPayment))->row_array();
		$bankNoRek = $mybank['no_rek'];
		$bankOwner = $mybank['owner'];

		$mywhatsapp = $this->db->get('whatsapp')->row_array();
		$link_whatsapp = $mywhatsapp['url_web'];

		$mycoverage = $this->db->get_where('coverage', array('coverage_id' => $coverage_id))->row_array();
		$resellerName = $mycoverage['comment'];
		$resellerAddress = $mycoverage['address'];
		$resellerKode = $mycoverage['c_name'];

		$merchantRef = 'NID-' . date('dmY') . '-' . $methodPayment;

		if ($methodPayment == 'BRIVA' || $methodPayment == 'ALFAMIDI' || $methodPayment == 'ALFAMART' || $methodPayment == 'CIMBVA' || $methodPayment == 'MUAMALATVA' || $methodPayment == 'SMSVA' || $methodPayment == 'BCAVA' || $methodPayment == 'MANDIRIVA' || $methodPayment == 'BNIVA' || $methodPayment == 'PERMATAVA' || $methodPayment == 'MYBVA' || $methodPayment == 'QRISC') {
			$data = [
				'method'            => $methodPayment,
				'merchant_ref'      => $merchantRef,
				'amount'            => $totalAmount,
				'customer_name'     => $customerName,
				'customer_email'    => $customerEmail,
				'customer_phone'    => $customerPhone,
				'order_items'       => [
					[
						'sku'       	=> $productPaket,
						'name'      	=> $productName,
						'price'     	=> $productPrice,
						'quantity'  	=> $detailQty
					]
				],
				'callback_url'      => $urlCallback,
				'return_url'        => $urlPayment,
				'expired_time'      => (time() + ($expiredDay * 24 * 60 * 60)), // 24 jam
				'signature'         => hash_hmac('sha256', $merchantCode . $merchantRef . $totalAmount, $privateKey)
			];

			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_FRESH_CONNECT     => true,
				CURLOPT_URL               => "https://tripay.co.id/api/transaction/create",
				CURLOPT_RETURNTRANSFER    => true,
				CURLOPT_HEADER            => false,
				CURLOPT_HTTPHEADER        => array(
					"Authorization: Bearer " . $myapiKey
				),
				CURLOPT_FAILONERROR       => false,
				CURLOPT_POST              => true,
				CURLOPT_POSTFIELDS        => http_build_query($data)
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);

			echo $response . '<br><br>';
			$reference = substr($response, 83, 16);
			$link = 'https://tripay.co.id/checkout/' . $reference;
			echo $link;
			$this->db->set('metode_payment', $methodPayment);
			$this->db->set('merchant_ref', $merchantRef);
			$this->db->where('invoice', $no_invoice);
			$this->db->update('invoice');

			$myMethod = urlencode($methodPayment);
			$nomor = $customerPhone;
			$pesan = '*Konfirmasi%20Pembayaran%20' . $myMethod . '%20Anda*%0AKlik%20/%20Kunjungi%20:%0A' . $link;
			$url = $link_whatsapp . 'send.php?nomor=' . $nomor . '&pesan=' . $pesan;

			file_get_contents($url);
			$send = curl_init($url);
			$result = curl_exec($send);
			curl_close($send);

			echo "<script>window.location='" . $link . "'; </script>";
		} elseif ($methodPayment == 'Bayar Tunai ke Reseller') {
			$paytime = date('d') . ' ' . indo_month(date('m')) . ' ' . date('Y') . ' ' . date('H:i') . ' WIB';
			$jatuhtempo = $customerDate . ' ' . indo_month(date('m')) . ' ' . date('Y');
			$periode = indo_month(date('m')) . ' ' . date('Y');
			$data['title'] = '@Boss.Net - Payment Gateway || ' . $no_services;
			$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
			$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
			$data['customer'] = $this->customer_m->getNSCustomer($no_services)->row_array();
			$data['bill'] = $this->bill_m->getDebt($no_services)->num_rows();
			$data['other'] = $this->db->get('other')->row_array();
			$data['bank'] = $this->setting_m->getBank()->result();
			$data['nominal'] = $nominal;
			$data['customerName'] = $customerName;
			$data['customerEmail'] = $customerEmail;
			$data['customerPhone'] = $customerPhone;
			$data['productName'] = $productName;
			$data['no_invoice'] = $no_invoice;
			$data['paytime'] = $paytime;
			$data['jatuhtempo'] = $jatuhtempo;
			$data['periode'] = $periode;
			$data['no_services'] = $no_services;
			$data['methodPayment'] = $methodPayment;
			$data['bankNoRek'] = $bankNoRek;
			$data['bankOwner'] = $bankOwner;
			$data['resellerName'] = $resellerName;
			$data['resellerAddress'] = $resellerAddress;
			$data['resellerKode'] = $resellerKode;

			$this->db->set('metode_payment', $methodPayment);
			$this->db->set('merchant_ref', $merchantRef);
			$this->db->where('invoice', $no_invoice);
			$this->db->update('invoice');

			$this->load->view('member/pembayaran', $data);
		} else {
			$paytime = $customerDate . ' ' . indo_month(date('m')) . ' ' . date('Y') . ' ' . date('H:i') . ' WIB';
			$jatuhtempo = $customerDate . ' ' . indo_month(date('m')) . ' ' . date('Y');
			$periode = indo_month(date('m')) . ' ' . date('Y');
			$data['title'] = '@Boss.Net - Payment Gateway || ' . $no_services;
			$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
			$data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
			$data['customer'] = $this->customer_m->getNSCustomer($no_services)->row_array();
			$data['bill'] = $this->bill_m->getDebt($no_services)->num_rows();
			$data['other'] = $this->db->get('other')->row_array();
			$data['bank'] = $this->setting_m->getBank()->result();
			$data['nominal'] = $nominal;
			$data['customerName'] = $customerName;
			$data['customerEmail'] = $customerEmail;
			$data['customerPhone'] = $customerPhone;
			$data['productName'] = $productName;
			$data['no_invoice'] = $no_invoice;
			$data['paytime'] = $paytime;
			$data['jatuhtempo'] = $jatuhtempo;
			$data['periode'] = $periode;
			$data['no_services'] = $no_services;
			$data['methodPayment'] = $methodPayment;
			$data['bankNoRek'] = $bankNoRek;
			$data['bankOwner'] = $bankOwner;
			$data['resellerName'] = $resellerName;
			$data['resellerAddress'] = $resellerAddress;
			$data['resellerKode'] = $resellerKode;

			$this->db->set('metode_payment', $methodPayment);
			$this->db->set('merchant_ref', $merchantRef);
			$this->db->where('invoice', $no_invoice);
			$this->db->update('invoice');

			$this->load->view('member/pembayaran', $data);
		}
	}
}
