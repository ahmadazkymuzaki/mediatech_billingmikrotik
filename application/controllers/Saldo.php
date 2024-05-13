<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Saldo extends CI_Controller
{

	// Database
	protected $field_status = 'status'; // nama field status dalam tabel transaksi
	protected $field_kodetrans = 'merchant_ref'; // nama field kode dalam tabel transaksi
	protected $tabel_trans = 'invoice'; // nama tabel transaksi

	// URLs Channel
	public $URL_channelPs = 'https://payment.tripay.co.id/api-sandbox/payment/channel';
	public $URL_channelPp = 'https://payment.tripay.co.id/api/payment/channel';
	public $URL_channelMs = 'https://payment.tripay.co.id/api-sandbox/merchant/payment-channel';
	public $URL_channelMp = 'https://payment.tripay.co.id/api/merchant/payment-channel';
	// URLs Calculator
	public $URL_calcMs = 'https://payment.tripay.co.id/api-sandbox/merchant/fee-calculator';
	public $URL_calcMp = 'https://payment.tripay.co.id/api/merchant/fee-calculator';
	/*
	* URLs Transaction
	*/
	// Create
	public $URL_transMs = 'https://payment.tripay.co.id/api-sandbox/transaction/create';
	public $URL_transMp = 'https://payment.tripay.co.id/api/transaction/create';
	public $URL_transOpenMs = '';
	public $URL_transOpenMp = 'https://payment.tripay.co.id/api/transaction/open-payment/create';
	// Detail Close Sistem
	public $URL_transDetailMs = 'https://payment.tripay.co.id/api-sandbox/transaction/detail';
	public $URL_transDetailMp = 'https://payment.tripay.co.id/api/transaction/detail';
	// Detail Open Sistem with uuid
	public $URL_transDetailOpenMs = '';
	public $URL_transDetailOpenMp = 'https://payment.tripay.co.id/api/transaction/open-payment/';
	public $URL_transPembOpenMs = '';
	public $URL_transPembOpenMp = 'https://payment.tripay.co.id/api/transaction/open-payment/';

	public function __construct()
	{
		parent::__construct();
		$payment = $this->db->get('paymentsaldo')->result();
		foreach ($payment as $data) {
			$privateKey = $data->private_key;
			$apiKey  = $data->apikey_pay;
			$this->api_PKey = $data->private_key;
			$this->api_Key = 'DEV' . $data->apikey_pay;
			$this->myapi_Key = $data->apikey_pay;
			$this->merchantCode = $data->merchant_id;
			$this->url_payment = $data->url_payment;
			$this->url_callback = $data->url_callback;
		}
		if ($privateKey === null and $apiKey === null) {
			exit('Mohon isikan data private dan api key anda');
		} else {
			$detail_id = 5;
			$invoice_detail = $this->db->get_where('invoice_detail', array('detail_id' => $detail_id))->result();
			foreach ($invoice_detail as $datagua) {
				$this->detailQty = $datagua->qty;
				$this->detailID = $datagua->invoice_id;
				$this->detailTotal = $datagua->total;
				$this->detailPrice = $datagua->price;
				$this->detailItemID = $datagua->item_id;
			}
			$invoice = $this->db->get_where('invoice', array('invoice' => $this->detailID))->result();
			foreach ($invoice as $dataku) {
				$this->merchantRef = $dataku->merchant_ref;
				$this->amount = $dataku->amount;
				$this->no_invoice = $dataku->invoice;
				$this->no_services = $dataku->no_services;
				$this->metode_payment = 'BRIVA';
			}
			$package_item = $this->db->get_where('package_item', array('p_item_id' => $this->detailItemID))->result();
			foreach ($package_item as $datague) {
				$this->productName = $datague->name;
				$this->productPrice = $datague->price;
				$this->productPaket = $datague->paket_wifi;
				$this->productImg = site_url('assets/images/product/') . $datague->picture;
				$this->productKet = $datague->description;
			}
			$customer = $this->db->get_where('customer', array('no_services' => $this->no_services))->result();
			foreach ($customer as $mydata) {
				$this->customerName = $mydata->name;
				$this->customerEmail = $mydata->email;
				$this->customerPhone = $mydata->no_wa;
				$this->customerNik = $mydata->no_ktp;
			}
		}
	}

	private function checkKey()
	{
		if ($this->api_PKey === null or $this->api_PKey === '' and $this->api_Key === null or $this->api_Key === '') {
			exit('Mohon isikan data private dan api key anda');
		} else {
			return true;
		}
	}

	private function dQuery($merchantH = null, $statusH = null)
	{
		$this->checkKey();
		if ($merchantH === null or $merchantH === '' and $statusH === null or $statusH === '' and $this->field_status === null or $this->field_status === '' and $this->field_kodetrans === null or $this->field_kodetrans === '' and $this->tabel_trans === null or $this->tabel_trans === '') {
			return false;
		} else {
			if ($statusH === 'BELUM BAYAR') {
				return "UPDATE " . addslashes($this->tabel_trans) . " SET " . addslashes($this->field_status) . " = 'BELUM BAYAR' WHERE " . addslashes($this->field_kodetrans) . " = '" . addslashes($merchantH) . "'";
			} elseif ($statusH === 'SUDAH BAYAR') {
				return "UPDATE " . addslashes($this->tabel_trans) . " SET " . addslashes($this->field_status) . " = 'SUDAH BAYAR' WHERE " . addslashes($this->field_kodetrans) . " = '" . addslashes($merchantH) . "'";
			} elseif ($statusH === 'KADALUARSA') {
				return "UPDATE " . addslashes($this->tabel_trans) . " SET " . addslashes($this->field_status) . " = 'KADALUARSA' WHERE " . addslashes($this->field_kodetrans) . " = '" . addslashes($merchantH) . "'";
			} elseif ($statusH === 'GAGAL BAYAR') {
				return "UPDATE " . addslashes($this->tabel_trans) . " SET " . addslashes($this->field_status) . " = 'GAGAL BAYAR' WHERE " . addslashes($this->field_kodetrans) . " = '" . addslashes($merchantH) . "'";
			} elseif ($statusH === 'PENGEMBALIAN') {
				return "UPDATE " . addslashes($this->tabel_trans) . " SET " . addslashes($this->field_status) . " = 'PENGEMBALIAN' WHERE " . addslashes($this->field_kodetrans) . " = '" . addslashes($merchantH) . "'";
			}
		}
	}

	public function mycallBack()
	{
		$this->checkKey();
		header('Content-Type: application/json');
		$result = array();
		// ambil data JSON
		$json = file_get_contents("php://input");

		// ambil callback signature
		$callbackSignature = isset($_SERVER['HTTP_X_CALLBACK_SIGNATURE']) ? $_SERVER['HTTP_X_CALLBACK_SIGNATURE'] : '';

		// generate signature untuk dicocokkan dengan X-Callback-Signature
		$signature = hash_hmac('sha256', $json, $this->api_PKey);

		// validasi signature
		if ($callbackSignature != $signature) {
			exit('Signature tidak valid'); // signature tidak valid, hentikan proses
		} else {
			// Data
			$data = json_decode($json);
			$event = $_SERVER['HTTP_X_CALLBACK_EVENT'];

			if ($event == 'payment_status') {
				if ($data->status == 'BELUM BAYAR') {
					$merchantRef = $this->db->escape_string(addslashes($data->merchant_ref));

					// belum pembayaran, lanjutkan proses sesuai sistem Anda, contoh:
					$queryBELUMBAYAR = $this->dQuery($merchantRef, $data->status);
					$updateBELUMBAYAR = $this->db->query($queryBELUMBAYAR);

					if ($updateBELUMBAYAR) {
						$result['success'] = true;
					} else {
						$result['success'] = false;
					}
				} elseif ($data->status == 'SUDAH BAYAR') {
					$merchantRef = $this->db->escape_string(addslashes($data->merchant_ref));

					// pembayaran sukses, lanjutkan proses sesuai sistem Anda, contoh:
					$querySUDAHBAYAR = $this->dQuery($merchantRef, $data->status);
					$updateSUDAHBAYAR = $this->db->query($querySUDAHBAYAR);

					if ($updateSUDAHBAYAR) {
						$result['success'] = true;
					} else {
						$result['success'] = false;
					}
				} elseif ($data->status == 'KADALUARSA') {
					$merchantRef = $this->db->escape_string(addslashes($data->merchant_ref));

					// pembayaran KADALUARSA, lanjutkan proses sesuai sistem Anda, contoh:
					$queryKADALUARSA = $this->dQuery($merchantRef, $data->status);
					$updateKADALUARSA = $this->db->query($queryKADALUARSA);

					if ($updateKADALUARSA) {
						$result['success'] = true;
					} else {
						$result['success'] = false;
					}
				} elseif ($data->status == 'GAGAL BAYAR') {
					$merchantRef = $this->db->escape_string(addslashes($data->merchant_ref));

					// pembayaran gagal, lanjutkan proses sesuai sistem Anda, contoh:
					$queryGAGALBAYAR = $this->dQuery($merchantRef, $data->status);
					$updateGAGALBAYAR = $this->db->query($queryGAGALBAYAR);

					if ($updateGAGALBAYAR) {
						$result['success'] = true;
					} else {
						$result['success'] = false;
					}
				} elseif ($data->status == 'PENGEMBALIAN') {
					$merchantRef = $this->db->escape_string(addslashes($data->merchant_ref));

					// pembayaran dikembalikan, lanjutkan proses sesuai sistem Anda, contoh:
					$queryREFUND = $this->dQuery($merchantRef, $data->status);
					$updateREFUND = $this->db->query($queryREFUND);

					if ($updateREFUND) {
						$result['success'] = true;
					} else {
						$result['success'] = false;
					}
				}
			}
			$result['data'] = $data;
			return json_encode($result, JSON_PRETTY_PRINT);
		}
	}

	public function callBack()
	{
		$paymentsaya = $this->db->get('paymentsaldo')->result();
		foreach ($paymentsaya as $datasaya) {
			$privateKey = $datasaya->private_key;
			$apiKey  = $datasaya->apikey_pay;
			$this->api_PKey = $datasaya->private_key;
			$this->api_Key = 'DEV' . $datasaya->apikey_pay;
			$this->myapi_Key = $datasaya->apikey_pay;
			$this->merchantCode = $datasaya->merchant_id;
			$this->url_payment = $datasaya->url_payment;
			$this->url_callback = $datasaya->url_callback;
		}

		$this->checkKey();
		header('Content-Type: application/json');
		$result = array();
		// Ambil data JSON
		$json = file_get_contents('php://input');

		// Ambil callback signature
		$callbackSignature = isset($_SERVER['HTTP_X_CALLBACK_SIGNATURE']) ? $_SERVER['HTTP_X_CALLBACK_SIGNATURE'] : '';

		// Generate signature untuk dicocokkan dengan X-Callback-Signature
		$signature = hash_hmac('sha256', $json, $privateKey);

		if ($callbackSignature != $signature) {
			exit('Tanda tangan tidak valid'); // signature tidak valid, hentikan proses
		} else {
			// Data
			$data = json_decode($json);
			$event = $_SERVER['HTTP_X_CALLBACK_EVENT'];
			if ('payment_status' !== $_SERVER['HTTP_X_CALLBACK_EVENT']) {
				exit('Acara panggilan balik tidak valid, tidak ada tindakan yang diambil');
			}

			$uniqueRef = $data->merchant_ref;
			$status = strtoupper((string) $data->status);

			$mysaldo = $this->db->get_where('saldo', array('merchant_ref' => $uniqueRef))->row_array();
			$nomor_services = $mysaldo['no_services'];
			$nominal_saldo = $mysaldo['nominal_saldo'];

			$myuser = $this->db->get_where('user', array('no_services' => $nomor_services))->row_array();
			$saldo_akun = $myuser['saldo'];
			$saldo_total = $saldo_akun + $nominal_saldo;
			$time_saldo = date('d/m/Y H:i:s') . ' WIB';
			$ket_pemasukan = 'Melakukan Pengisian Saldo dengan Nominal sebesar Rp. ' . indo_currency($nominal_saldo);

			if ($event == 'payment_status') {
				if ($data->status == 'UNPAID') {
					$this->db->set('status_saldo', 'BELUM BAYAR');
					$this->db->where('merchant_ref', $uniqueRef);
					$this->db->update('saldo');

					echo json_encode(['success' => true]);
					exit;
				} elseif ($data->status == 'PAID') {

					$this->db->set('status_saldo', 'SUDAH BAYAR');
					$this->db->where('merchant_ref', $uniqueRef);
					$this->db->update('saldo');

					$this->db->set('saldo', $saldo_total);
					$this->db->where('no_services', $nomor_services);
					$this->db->update('user');

					$params = [
						'no_services' => $nomor_services,
						'nama_pemasukan' => 'TOP UP SALDO',
						'nominal_pemasukan' => $nominal_saldo,
						'ket_pemasukan' => $ket_pemasukan,
						'waktu_pemasukan' => $time_saldo
					];
					$this->db->insert('pemasukan', $params);

					echo json_encode(['success' => true]);
					exit;
				} elseif ($data->status == 'EXPIRED') {
					$this->db->set('status_saldo', 'KADALUARSA');
					$this->db->where('merchant_ref', $uniqueRef);
					$this->db->update('saldo');

					echo json_encode(['success' => true]);
					exit;
				} elseif ($data->status == 'FAILED') {
					$this->db->set('status_saldo', 'GAGAL BAYAR');
					$this->db->where('merchant_ref', $uniqueRef);
					$this->db->update('saldo');

					echo json_encode(['success' => true]);
					exit;
				} elseif ($data->status == 'REFUND') {
					$this->db->set('status_saldo', 'DIKEMBALIKAN');
					$this->db->where('merchant_ref', $uniqueRef);
					$this->db->update('saldo');

					echo json_encode(['success' => true]);
					exit;
				}
			}
		}
	}

	public function curlAPI($url = null, $payloads = null, $method = null)
	{
		$apiKey = $this->api_Key;
		$myapiKey = $this->myapi_Key;
		$privateKey = $this->api_PKey;
		$method = $this->metode_payment;
		$merchantCode = $this->merchantCode;
		$urlPayment = $this->url_payment;
		$urlCallback = $this->url_callback;
		$detailQty = $this->detailQty;
		$detailID = $this->detailID;
		$detailTotal = $this->detailTotal;
		$detailItemID = $this->detailItemID;
		$merchantRef = $this->merchantRef;
		$amount = $this->amount;
		$no_invoice = $this->no_invoice;
		$no_services = $this->no_services;
		$metode_payment = $this->metode_payment;
		$productName = $this->productName;
		$productPrice = $this->productPrice;
		$productPaket = $this->productPaket;
		$productImg = $this->productImg;
		$productKet = $this->productKet;
		$customerName = $this->customerName;
		$customerEmail = $this->customerEmail;
		$customerPhone = $this->customerPhone;
		$customerNik = $this->customerNik;

		$this->checkKey();
		header('Content-Type: application/json');
		$result = array();
		$curl = curl_init();

		if ($method === null and $url === null) {
			$result['error'] = true;
			$result['status'] = 404;
		} elseif ($method === 'get' or $method === 'GET') {
			curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);
			if ($payloads != null or $payloads != '') {
				curl_setopt($curl, CURLOPT_URL, $url . "?" . http_build_query($payloads));
			} elseif (isset($payloads['uuid']) and isset($payloads['uuid_type'])) {
				curl_setopt($curl, CURLOPT_URL, $url . $payloads['uuid'] . $payloads['uuid_type']);
			} else {
				curl_setopt($curl, CURLOPT_URL, $url);
			}
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_HEADER, false);
			curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $this->api_Key));
			curl_setopt($curl, CURLOPT_FAILONERROR, false);

			$response = curl_exec($curl);
			$err = curl_error($curl);
			$http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

			curl_close($curl);
			if (!empty($err)) {
				$result['error'] = true;
				$result['status'] = $http_status;
				$result['message'] = $err;
			} else {
				$result = $response;
			}
		} elseif ($method === 'post' or $method === 'POST') {
			curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_HEADER, false);
			curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $this->api_Key));
			curl_setopt($curl, CURLOPT_FAILONERROR, false);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($payloads));

			$response = curl_exec($curl);
			$err = curl_error($curl);
			$http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

			curl_close($curl);

			if (!empty($err)) {
				$result['error'] = true;
				$result['status'] = $http_status;
				$result['message'] = $err;
			} else {
				$result = $response;
			}
		}

		return json_encode($result, JSON_PRETTY_PRINT);
	}

	public function readuser()
	{
		$apiKey = $this->api_Key;
		$myapiKey = $this->myapi_Key;
		$privateKey = $this->api_PKey;
		$method = $this->metode_payment;
		$merchantCode = $this->merchantCode;
		$urlPayment = $this->url_payment;
		$urlCallback = $this->url_callback;
		$detailQty = $this->detailQty;
		$detailID = $this->detailID;
		$detailTotal = $this->detailTotal;
		$detailItemID = $this->detailItemID;
		$merchantRef = $this->merchantRef;
		$amount = $this->amount;
		$no_invoice = $this->no_invoice;
		$no_services = $this->no_services;
		$metode_payment = $this->metode_payment;
		$productName = $this->productName;
		$productPrice = $this->productPrice;
		$productPaket = $this->productPaket;
		$productImg = $this->productImg;
		$productKet = $this->productKet;
		$customerName = $this->customerName;
		$customerEmail = $this->customerEmail;
		$customerPhone = $this->customerPhone;
		$customerNik = $this->customerNik;

		$payload = [
			'page'    => 1,
			'per_page'    => 25
		];

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_FRESH_CONNECT     => true,
			CURLOPT_URL               => "https://tripay.co.id/api-group/user/list?" . http_build_query($payload),
			CURLOPT_RETURNTRANSFER    => true,
			CURLOPT_HEADER            => false,
			CURLOPT_HTTPHEADER        => array(
				"Authorization: Bearer " . $apiKey
			),
			CURLOPT_FAILONERROR       => false
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		echo !empty($err) ? $err : $response;
	}

	public function detailuser()
	{
		$apiKey = $this->api_Key;
		$myapiKey = $this->myapi_Key;
		$privateKey = $this->api_PKey;
		$method = $this->metode_payment;
		$merchantCode = $this->merchantCode;
		$urlPayment = $this->url_payment;
		$urlCallback = $this->url_callback;
		$detailQty = $this->detailQty;
		$detailID = $this->detailID;
		$detailTotal = $this->detailTotal;
		$detailItemID = $this->detailItemID;
		$merchantRef = $this->merchantRef;
		$amount = $this->amount;
		$no_invoice = $this->no_invoice;
		$no_services = $this->no_services;
		$metode_payment = $this->metode_payment;
		$productName = $this->productName;
		$productPrice = $this->productPrice;
		$productPaket = $this->productPaket;
		$productImg = $this->productImg;
		$productKet = $this->productKet;
		$customerName = $this->customerName;
		$customerEmail = $this->customerEmail;
		$customerPhone = $this->customerPhone;
		$customerNik = $this->customerNik;

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_FRESH_CONNECT     => true,
			CURLOPT_URL               => "https://tripay.co.id/api-group/user/5/detail",
			CURLOPT_RETURNTRANSFER    => true,
			CURLOPT_HEADER            => false,
			CURLOPT_HTTPHEADER        => array(
				"Authorization: Bearer " . $apiKey
			),
			CURLOPT_FAILONERROR       => false
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		echo !empty($err) ? $err : $response;
	}

	public function createuser()
	{
		$apiKey = $this->api_Key;
		$myapiKey = $this->myapi_Key;
		$privateKey = $this->api_PKey;
		$method = $this->metode_payment;
		$merchantCode = $this->merchantCode;
		$urlPayment = $this->url_payment;
		$urlCallback = $this->url_callback;
		$detailQty = $this->detailQty;
		$detailID = $this->detailID;
		$detailTotal = $this->detailTotal;
		$detailItemID = $this->detailItemID;
		$merchantRef = $this->merchantRef;
		$amount = $this->amount;
		$no_invoice = $this->no_invoice;
		$no_services = $this->no_services;
		$metode_payment = $this->metode_payment;
		$productName = $this->productName;
		$productPrice = $this->productPrice;
		$productPaket = $this->productPaket;
		$productImg = $this->productImg;
		$productKet = $this->productKet;
		$customerName = $this->customerName;
		$customerEmail = $this->customerEmail;
		$customerPhone = $this->customerPhone;
		$customerNik = $this->customerNik;

		$payload = [
			'name' => 'Nama Pengguna',
			'email' => 'emailuser@tripay.co.id',
			'phone' => '081111111111'
		];

		$signature = hash_hmac('sha256', json_encode($payload), $privateKey);
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_FRESH_CONNECT     => true,
			CURLOPT_URL               => "https://tripay.co.id/api-group/user/create",
			CURLOPT_RETURNTRANSFER    => true,
			CURLOPT_HEADER            => false,
			CURLOPT_HTTPHEADER        => array(
				"Authorization: Bearer " . $apiKey,
				"X-Hub-Signature: " . $signature
			),
			CURLOPT_FAILONERROR       => false,
			CURLOPT_POST              => true,
			CURLOPT_POSTFIELDS        => http_build_query($payload)
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		echo !empty($err) ? $err : $response;
	}

	public function updateuser()
	{
		$apiKey = $this->api_Key;
		$myapiKey = $this->myapi_Key;
		$privateKey = $this->api_PKey;
		$method = $this->metode_payment;
		$merchantCode = $this->merchantCode;
		$urlPayment = $this->url_payment;
		$urlCallback = $this->url_callback;
		$detailQty = $this->detailQty;
		$detailID = $this->detailID;
		$detailTotal = $this->detailTotal;
		$detailItemID = $this->detailItemID;
		$merchantRef = $this->merchantRef;
		$amount = $this->amount;
		$no_invoice = $this->no_invoice;
		$no_services = $this->no_services;
		$metode_payment = $this->metode_payment;
		$productName = $this->productName;
		$productPrice = $this->productPrice;
		$productPaket = $this->productPaket;
		$productImg = $this->productImg;
		$productKet = $this->productKet;
		$customerName = $this->customerName;
		$customerEmail = $this->customerEmail;
		$customerPhone = $this->customerPhone;
		$customerNik = $this->customerNik;

		$payload = [
			'name' => 'Nama Baru Pengguna'
		];

		$signature = hash_hmac('sha256', json_encode($payload), $privateKey);
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_FRESH_CONNECT     => true,
			CURLOPT_URL               => "https://tripay.co.id/api-group/user/5/update",
			CURLOPT_RETURNTRANSFER    => true,
			CURLOPT_HEADER            => false,
			CURLOPT_HTTPHEADER        => array(
				"Authorization: Bearer " . $apiKey,
				"X-Hub-Signature: " . $signature
			),
			CURLOPT_FAILONERROR       => false,
			CURLOPT_POST              => true,
			CURLOPT_POSTFIELDS        => http_build_query($payload)
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		echo !empty($err) ? $err : $response;
	}

	public function verifikasidokumen()
	{
		$apiKey = $this->api_Key;
		$myapiKey = $this->myapi_Key;
		$privateKey = $this->api_PKey;
		$method = $this->metode_payment;
		$merchantCode = $this->merchantCode;
		$urlPayment = $this->url_payment;
		$urlCallback = $this->url_callback;
		$detailQty = $this->detailQty;
		$detailID = $this->detailID;
		$detailTotal = $this->detailTotal;
		$detailItemID = $this->detailItemID;
		$merchantRef = $this->merchantRef;
		$amount = $this->amount;
		$no_invoice = $this->no_invoice;
		$no_services = $this->no_services;
		$metode_payment = $this->metode_payment;
		$productName = $this->productName;
		$productPrice = $this->productPrice;
		$productPaket = $this->productPaket;
		$productImg = $this->productImg;
		$productKet = $this->productKet;
		$customerName = $this->customerName;
		$customerEmail = $this->customerEmail;
		$customerPhone = $this->customerPhone;
		$customerNik = $this->customerNik;

		$payload = [
			'id_card' => new \CURLFile("path/to/the/ktp.jpg", "image/jpeg"),
			'selfie' => new \CURLFile("path/to/the/selfie.jpg", "image/jpeg"),
			'photo' => new \CURLFile("path/to/the/photo.jpg", "image/jpeg")
		];

		$payload = [
			'id_card' => new \CURLFile(@FILES['ktp']['tmp_name'], "image/jpeg"),
			'selfie' => new \CURLFile(@FILES['selfie']['tmp_name'], "image/jpeg"),
			'photo' => new \CURLFile(@FILES['photo']['tmp_name'], "image/jpeg"),
		];

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_FRESH_CONNECT     => true,
			CURLOPT_URL               => "https://tripay.co.id/api-group/user/5/verification/submit",
			CURLOPT_RETURNTRANSFER    => true,
			CURLOPT_HEADER            => false,
			CURLOPT_HTTPHEADER        => array(
				"Authorization: Bearer " . $apiKey
			),
			CURLOPT_FAILONERROR       => false,
			CURLOPT_POST              => true,
			CURLOPT_POSTFIELDS        => $payload
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		echo !empty($err) ? $err : $response;
	}

	public function statusverifikasi()
	{
		$apiKey = $this->api_Key;
		$myapiKey = $this->myapi_Key;
		$privateKey = $this->api_PKey;
		$method = $this->metode_payment;
		$merchantCode = $this->merchantCode;
		$urlPayment = $this->url_payment;
		$urlCallback = $this->url_callback;
		$detailQty = $this->detailQty;
		$detailID = $this->detailID;
		$detailTotal = $this->detailTotal;
		$detailItemID = $this->detailItemID;
		$merchantRef = $this->merchantRef;
		$amount = $this->amount;
		$no_invoice = $this->no_invoice;
		$no_services = $this->no_services;
		$metode_payment = $this->metode_payment;
		$productName = $this->productName;
		$productPrice = $this->productPrice;
		$productPaket = $this->productPaket;
		$productImg = $this->productImg;
		$productKet = $this->productKet;
		$customerName = $this->customerName;
		$customerEmail = $this->customerEmail;
		$customerPhone = $this->customerPhone;
		$customerNik = $this->customerNik;

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_FRESH_CONNECT     => true,
			CURLOPT_URL               => "https://tripay.co.id/api-group/user/5/verification/status",
			CURLOPT_RETURNTRANSFER    => true,
			CURLOPT_HEADER            => false,
			CURLOPT_HTTPHEADER        => array(
				"Authorization: Bearer " . $apiKey
			),
			CURLOPT_FAILONERROR       => false
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		echo !empty($err) ? $err : $response;
	}

	public function intruksi()
	{
		$apiKey = $this->api_Key;
		$myapiKey = $this->myapi_Key;
		$privateKey = $this->api_PKey;
		$method = $this->metode_payment;
		$merchantCode = $this->merchantCode;
		$urlPayment = $this->url_payment;
		$urlCallback = $this->url_callback;
		$detailQty = $this->detailQty;
		$detailID = $this->detailID;
		$detailTotal = $this->detailTotal;
		$detailItemID = $this->detailItemID;
		$merchantRef = $this->merchantRef;
		$amount = $this->amount;
		$no_invoice = $this->no_invoice;
		$no_services = $this->no_services;
		$metode_payment = $this->metode_payment;
		$productName = $this->productName;
		$productPrice = $this->productPrice;
		$productPaket = $this->productPaket;
		$productImg = $this->productImg;
		$productKet = $this->productKet;
		$customerName = $this->customerName;
		$customerEmail = $this->customerEmail;
		$customerPhone = $this->customerPhone;
		$customerNik = $this->customerNik;

		$payload = [
			'code'	=> $method
		];

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_FRESH_CONNECT     => true,
			CURLOPT_URL               => "https://tripay.co.id/api/payment/instruction?" . http_build_query($payload),
			CURLOPT_RETURNTRANSFER    => true,
			CURLOPT_HEADER            => false,
			CURLOPT_HTTPHEADER        => array(
				"Authorization: Bearer " . $myapiKey
			),
			CURLOPT_FAILONERROR       => false,
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		echo !empty($err) ? $err : $response;
	}

	public function createrekening()
	{
		$apiKey = $this->api_Key;
		$myapiKey = $this->myapi_Key;
		$privateKey = $this->api_PKey;
		$method = $this->metode_payment;
		$merchantCode = $this->merchantCode;
		$urlPayment = $this->url_payment;
		$urlCallback = $this->url_callback;
		$detailQty = $this->detailQty;
		$detailID = $this->detailID;
		$detailTotal = $this->detailTotal;
		$detailItemID = $this->detailItemID;
		$merchantRef = $this->merchantRef;
		$amount = $this->amount;
		$no_invoice = $this->no_invoice;
		$no_services = $this->no_services;
		$metode_payment = $this->metode_payment;
		$productName = $this->productName;
		$productPrice = $this->productPrice;
		$productPaket = $this->productPaket;
		$productImg = $this->productImg;
		$productKet = $this->productKet;
		$customerName = $this->customerName;
		$customerEmail = $this->customerEmail;
		$customerPhone = $this->customerPhone;
		$customerNik = $this->customerNik;

		$payload = [
			'bank_code' => '002',
			'account_number' => '1234567890',
			'account_name' => 'Nama Pemilik'
		];

		$signature = hash_hmac('sha256', json_encode($payload), $privateKey);
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_FRESH_CONNECT     => true,
			CURLOPT_URL               => "https://tripay.co.id/api-group/user/5/add-bank",
			CURLOPT_RETURNTRANSFER    => true,
			CURLOPT_HEADER            => false,
			CURLOPT_HTTPHEADER        => array(
				"Authorization: Bearer " . $apiKey,
				"X-Hub-Signature: " . $signature
			),
			CURLOPT_FAILONERROR       => false,
			CURLOPT_POST              => true,
			CURLOPT_POSTFIELDS        => http_build_query($payload)
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		echo !empty($err) ? $err : $response;
	}

	public function readrekening()
	{
		$apiKey = $this->api_Key;
		$myapiKey = $this->myapi_Key;
		$privateKey = $this->api_PKey;
		$method = $this->metode_payment;
		$merchantCode = $this->merchantCode;
		$urlPayment = $this->url_payment;
		$urlCallback = $this->url_callback;
		$detailQty = $this->detailQty;
		$detailID = $this->detailID;
		$detailTotal = $this->detailTotal;
		$detailItemID = $this->detailItemID;
		$merchantRef = $this->merchantRef;
		$amount = $this->amount;
		$no_invoice = $this->no_invoice;
		$no_services = $this->no_services;
		$metode_payment = $this->metode_payment;
		$productName = $this->productName;
		$productPrice = $this->productPrice;
		$productPaket = $this->productPaket;
		$productImg = $this->productImg;
		$productKet = $this->productKet;
		$customerName = $this->customerName;
		$customerEmail = $this->customerEmail;
		$customerPhone = $this->customerPhone;
		$customerNik = $this->customerNik;

		$payload = [
			'page'    => 1,
			'per_page'    => 25
		];

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_FRESH_CONNECT     => true,
			CURLOPT_URL               => "https://tripay.co.id/api-group/user/5/list-bank?" . http_build_query($payload),
			CURLOPT_RETURNTRANSFER    => true,
			CURLOPT_HEADER            => false,
			CURLOPT_HTTPHEADER        => array(
				"Authorization: Bearer " . $apiKey
			),
			CURLOPT_FAILONERROR       => false
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		echo !empty($err) ? $err : $response;
	}

	public function updaterekening()
	{
		$apiKey = $this->api_Key;
		$myapiKey = $this->myapi_Key;
		$privateKey = $this->api_PKey;
		$method = $this->metode_payment;
		$merchantCode = $this->merchantCode;
		$urlPayment = $this->url_payment;
		$urlCallback = $this->url_callback;
		$detailQty = $this->detailQty;
		$detailID = $this->detailID;
		$detailTotal = $this->detailTotal;
		$detailItemID = $this->detailItemID;
		$merchantRef = $this->merchantRef;
		$amount = $this->amount;
		$no_invoice = $this->no_invoice;
		$no_services = $this->no_services;
		$metode_payment = $this->metode_payment;
		$productName = $this->productName;
		$productPrice = $this->productPrice;
		$productPaket = $this->productPaket;
		$productImg = $this->productImg;
		$productKet = $this->productKet;
		$customerName = $this->customerName;
		$customerEmail = $this->customerEmail;
		$customerPhone = $this->customerPhone;
		$customerNik = $this->customerNik;

		$payload = [
			'id' => 1,
			'account_number' => '1234567890',
			'account_name' => 'Nama Pemilik'
		];

		$signature = hash_hmac('sha256', json_encode($payload), $privateKey);
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_FRESH_CONNECT     => true,
			CURLOPT_URL               => "https://tripay.co.id/api-group/user/5/update-bank",
			CURLOPT_RETURNTRANSFER    => true,
			CURLOPT_HEADER            => false,
			CURLOPT_HTTPHEADER        => array(
				"Authorization: Bearer " . $apiKey,
				"X-Hub-Signature: " . $signature
			),
			CURLOPT_FAILONERROR       => false,
			CURLOPT_POST              => true,
			CURLOPT_POSTFIELDS        => http_build_query($payload)
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		echo !empty($err) ? $err : $response;
	}

	public function infosaldo()
	{
		$apiKey = $this->api_Key;
		$myapiKey = $this->myapi_Key;
		$privateKey = $this->api_PKey;
		$method = $this->metode_payment;
		$merchantCode = $this->merchantCode;
		$urlPayment = $this->url_payment;
		$urlCallback = $this->url_callback;
		$detailQty = $this->detailQty;
		$detailID = $this->detailID;
		$detailTotal = $this->detailTotal;
		$detailItemID = $this->detailItemID;
		$merchantRef = $this->merchantRef;
		$amount = $this->amount;
		$no_invoice = $this->no_invoice;
		$no_services = $this->no_services;
		$metode_payment = $this->metode_payment;
		$productName = $this->productName;
		$productPrice = $this->productPrice;
		$productPaket = $this->productPaket;
		$productImg = $this->productImg;
		$productKet = $this->productKet;
		$customerName = $this->customerName;
		$customerEmail = $this->customerEmail;
		$customerPhone = $this->customerPhone;
		$customerNik = $this->customerNik;

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_FRESH_CONNECT     => true,
			CURLOPT_URL               => "https://tripay.co.id/api-group/user/5/balance",
			CURLOPT_RETURNTRANSFER    => true,
			CURLOPT_HEADER            => false,
			CURLOPT_HTTPHEADER        => array(
				"Authorization: Bearer " . $apiKey
			),
			CURLOPT_FAILONERROR       => false
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		echo !empty($err) ? $err : $response;
	}

	public function riwayattransaksi()
	{
		$apiKey = $this->api_Key;
		$myapiKey = $this->myapi_Key;
		$privateKey = $this->api_PKey;
		$method = $this->metode_payment;
		$merchantCode = $this->merchantCode;
		$urlPayment = $this->url_payment;
		$urlCallback = $this->url_callback;
		$detailQty = $this->detailQty;
		$detailID = $this->detailID;
		$detailTotal = $this->detailTotal;
		$detailItemID = $this->detailItemID;
		$merchantRef = $this->merchantRef;
		$amount = $this->amount;
		$no_invoice = $this->no_invoice;
		$no_services = $this->no_services;
		$metode_payment = $this->metode_payment;
		$productName = $this->productName;
		$productPrice = $this->productPrice;
		$productPaket = $this->productPaket;
		$productImg = $this->productImg;
		$productKet = $this->productKet;
		$customerName = $this->customerName;
		$customerEmail = $this->customerEmail;
		$customerPhone = $this->customerPhone;
		$customerNik = $this->customerNik;

		$payload = [
			'page'    => 1,
			'per_page'    => 25
		];

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_FRESH_CONNECT     => true,
			CURLOPT_URL               => "https://tripay.co.id/api-group/user/5/transactions?" . http_build_query($payload),
			CURLOPT_RETURNTRANSFER    => true,
			CURLOPT_HEADER            => false,
			CURLOPT_HTTPHEADER        => array(
				"Authorization: Bearer " . $apiKey
			),
			CURLOPT_FAILONERROR       => false
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		echo !empty($err) ? $err : $response;
	}

	public function createmerchant()
	{
		$apiKey = $this->api_Key;
		$myapiKey = $this->myapi_Key;
		$privateKey = $this->api_PKey;
		$method = $this->metode_payment;
		$merchantCode = $this->merchantCode;
		$urlPayment = $this->url_payment;
		$urlCallback = $this->url_callback;
		$detailQty = $this->detailQty;
		$detailID = $this->detailID;
		$detailTotal = $this->detailTotal;
		$detailItemID = $this->detailItemID;
		$merchantRef = $this->merchantRef;
		$amount = $this->amount;
		$no_invoice = $this->no_invoice;
		$no_services = $this->no_services;
		$metode_payment = $this->metode_payment;
		$productName = $this->productName;
		$productPrice = $this->productPrice;
		$productPaket = $this->productPaket;
		$productImg = $this->productImg;
		$productKet = $this->productKet;
		$customerName = $this->customerName;
		$customerEmail = $this->customerEmail;
		$customerPhone = $this->customerPhone;
		$customerNik = $this->customerNik;

		$payload = [
			'name' => 'Nama Merchant',
			'website' => 'https://websitemerchant.com',
			'callback_url' => 'https://websitemerchant.com/callback-tripay'
		];

		$signature = hash_hmac('sha256', json_encode($payload), $privateKey);
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_FRESH_CONNECT     => true,
			CURLOPT_URL               => "https://tripay.co.id/api-group/user/5/merchant/create",
			CURLOPT_RETURNTRANSFER    => true,
			CURLOPT_HEADER            => false,
			CURLOPT_HTTPHEADER        => array(
				"Authorization: Bearer " . $apiKey,
				"X-Hub-Signature: " . $signature
			),
			CURLOPT_FAILONERROR       => false,
			CURLOPT_POST              => true,
			CURLOPT_POSTFIELDS        => http_build_query($payload)
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		echo !empty($err) ? $err : $response;
	}

	public function readmerchant()
	{
		$apiKey = $this->api_Key;
		$myapiKey = $this->myapi_Key;
		$privateKey = $this->api_PKey;
		$method = $this->metode_payment;
		$merchantCode = $this->merchantCode;
		$urlPayment = $this->url_payment;
		$urlCallback = $this->url_callback;
		$detailQty = $this->detailQty;
		$detailID = $this->detailID;
		$detailTotal = $this->detailTotal;
		$detailItemID = $this->detailItemID;
		$merchantRef = $this->merchantRef;
		$amount = $this->amount;
		$no_invoice = $this->no_invoice;
		$no_services = $this->no_services;
		$metode_payment = $this->metode_payment;
		$productName = $this->productName;
		$productPrice = $this->productPrice;
		$productPaket = $this->productPaket;
		$productImg = $this->productImg;
		$productKet = $this->productKet;
		$customerName = $this->customerName;
		$customerEmail = $this->customerEmail;
		$customerPhone = $this->customerPhone;
		$customerNik = $this->customerNik;

		$payload = [
			'page'    => 1,
			'per_page'    => 25
		];

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_FRESH_CONNECT     => true,
			CURLOPT_URL               => "https://tripay.co.id/api-group/user/5/merchant/list?" . http_build_query($payload),
			CURLOPT_RETURNTRANSFER    => true,
			CURLOPT_HEADER            => false,
			CURLOPT_HTTPHEADER        => array(
				"Authorization: Bearer " . $apiKey
			),
			CURLOPT_FAILONERROR       => false
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		echo !empty($err) ? $err : $response;
	}

	public function updatemerchant()
	{
		$apiKey = $this->api_Key;
		$myapiKey = $this->myapi_Key;
		$privateKey = $this->api_PKey;
		$method = $this->metode_payment;
		$merchantCode = $this->merchantCode;
		$urlPayment = $this->url_payment;
		$urlCallback = $this->url_callback;
		$detailQty = $this->detailQty;
		$detailID = $this->detailID;
		$detailTotal = $this->detailTotal;
		$detailItemID = $this->detailItemID;
		$merchantRef = $this->merchantRef;
		$amount = $this->amount;
		$no_invoice = $this->no_invoice;
		$no_services = $this->no_services;
		$metode_payment = $this->metode_payment;
		$productName = $this->productName;
		$productPrice = $this->productPrice;
		$productPaket = $this->productPaket;
		$productImg = $this->productImg;
		$productKet = $this->productKet;
		$customerName = $this->customerName;
		$customerEmail = $this->customerEmail;
		$customerPhone = $this->customerPhone;
		$customerNik = $this->customerNik;

		$payload = [
			'update_key' => 1
		];

		$signature = hash_hmac('sha256', json_encode($payload), $privateKey);
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_FRESH_CONNECT     => true,
			CURLOPT_URL               => "https://tripay.co.id/api-group/user/5/merchant/123/update",
			CURLOPT_RETURNTRANSFER    => true,
			CURLOPT_HEADER            => false,
			CURLOPT_HTTPHEADER        => array(
				"Authorization: Bearer " . $apiKey,
				"X-Hub-Signature: " . $signature
			),
			CURLOPT_FAILONERROR       => false,
			CURLOPT_POST              => true,
			CURLOPT_POSTFIELDS        => http_build_query($payload)
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		echo !empty($err) ? $err : $response;
	}

	public function detailmerchant()
	{
		$apiKey = $this->api_Key;
		$myapiKey = $this->myapi_Key;
		$privateKey = $this->api_PKey;
		$method = $this->metode_payment;
		$merchantCode = $this->merchantCode;
		$urlPayment = $this->url_payment;
		$urlCallback = $this->url_callback;
		$detailQty = $this->detailQty;
		$detailID = $this->detailID;
		$detailTotal = $this->detailTotal;
		$detailItemID = $this->detailItemID;
		$merchantRef = $this->merchantRef;
		$amount = $this->amount;
		$no_invoice = $this->no_invoice;
		$no_services = $this->no_services;
		$metode_payment = $this->metode_payment;
		$productName = $this->productName;
		$productPrice = $this->productPrice;
		$productPaket = $this->productPaket;
		$productImg = $this->productImg;
		$productKet = $this->productKet;
		$customerName = $this->customerName;
		$customerEmail = $this->customerEmail;
		$customerPhone = $this->customerPhone;
		$customerNik = $this->customerNik;

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_FRESH_CONNECT     => true,
			CURLOPT_URL               => "https://tripay.co.id/api-group/user/5/merchant/123/detail",
			CURLOPT_RETURNTRANSFER    => true,
			CURLOPT_HEADER            => false,
			CURLOPT_HTTPHEADER        => array(
				"Authorization: Bearer " . $apiKey
			),
			CURLOPT_FAILONERROR       => false
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		echo !empty($err) ? $err : $response;
	}

	public function riwayatmerchant()
	{
		$apiKey = $this->api_Key;
		$myapiKey = $this->myapi_Key;
		$privateKey = $this->api_PKey;
		$method = $this->metode_payment;
		$merchantCode = $this->merchantCode;
		$urlPayment = $this->url_payment;
		$urlCallback = $this->url_callback;
		$detailQty = $this->detailQty;
		$detailID = $this->detailID;
		$detailTotal = $this->detailTotal;
		$detailItemID = $this->detailItemID;
		$merchantRef = $this->merchantRef;
		$amount = $this->amount;
		$no_invoice = $this->no_invoice;
		$no_services = $this->no_services;
		$metode_payment = $this->metode_payment;
		$productName = $this->productName;
		$productPrice = $this->productPrice;
		$productPaket = $this->productPaket;
		$productImg = $this->productImg;
		$productKet = $this->productKet;
		$customerName = $this->customerName;
		$customerEmail = $this->customerEmail;
		$customerPhone = $this->customerPhone;
		$customerNik = $this->customerNik;

		$payload = [
			'page'    => 1,
			'per_page'    => 25
		];

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_FRESH_CONNECT     => true,
			CURLOPT_URL               => "https://tripay.co.id/api-group/user/5/merchant/123/transactions?" . http_build_query($payload),
			CURLOPT_RETURNTRANSFER    => true,
			CURLOPT_HEADER            => false,
			CURLOPT_HTTPHEADER        => array(
				"Authorization: Bearer " . $apiKey
			),
			CURLOPT_FAILONERROR       => false
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		echo !empty($err) ? $err : $response;
	}

	public function sandboxmerchant()
	{
		$apiKey = $this->api_Key;
		$myapiKey = $this->myapi_Key;
		$privateKey = $this->api_PKey;
		$method = $this->metode_payment;
		$merchantCode = $this->merchantCode;
		$urlPayment = $this->url_payment;
		$urlCallback = $this->url_callback;
		$detailQty = $this->detailQty;
		$detailID = $this->detailID;
		$detailTotal = $this->detailTotal;
		$detailItemID = $this->detailItemID;
		$merchantRef = $this->merchantRef;
		$amount = $this->amount;
		$no_invoice = $this->no_invoice;
		$no_services = $this->no_services;
		$metode_payment = $this->metode_payment;
		$productName = $this->productName;
		$productPrice = $this->productPrice;
		$productPaket = $this->productPaket;
		$productImg = $this->productImg;
		$productKet = $this->productKet;
		$customerName = $this->customerName;
		$customerEmail = $this->customerEmail;
		$customerPhone = $this->customerPhone;
		$customerNik = $this->customerNik;

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_FRESH_CONNECT     => true,
			CURLOPT_URL               => "https://tripay.co.id/api-group/user/5/merchant/sandbox",
			CURLOPT_RETURNTRANSFER    => true,
			CURLOPT_HEADER            => false,
			CURLOPT_HTTPHEADER        => array(
				"Authorization: Bearer " . $apiKey
			),
			CURLOPT_FAILONERROR       => false
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		echo !empty($err) ? $err : $response;
	}

	public function channelpayment()
	{
		$apiKey = $this->api_Key;
		$myapiKey = $this->myapi_Key;
		$privateKey = $this->api_PKey;

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_FRESH_CONNECT     => true,
			CURLOPT_URL               => "https://tripay.co.id/api/merchant/payment-channel",
			CURLOPT_RETURNTRANSFER    => true,
			CURLOPT_HEADER            => false,
			CURLOPT_HTTPHEADER        => array(
				"Authorization: Bearer " . $myapiKey
			),
			CURLOPT_FAILONERROR       => false
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		echo !empty($err) ? $err : $response;
	}

	public function kalkulatorbiaya()
	{
		$apiKey = $this->api_Key;
		$myapiKey = $this->myapi_Key;
		$privateKey = $this->api_PKey;
		$method = $this->metode_payment;
		$merchantCode = $this->merchantCode;
		$urlPayment = $this->url_payment;
		$urlCallback = $this->url_callback;
		$detailQty = $this->detailQty;
		$detailID = $this->detailID;
		$detailTotal = $this->detailTotal;
		$detailItemID = $this->detailItemID;
		$merchantRef = $this->merchantRef;
		$amount = $this->amount;
		$no_invoice = $this->no_invoice;
		$no_services = $this->no_services;
		$metode_payment = $this->metode_payment;
		$productName = $this->productName;
		$productPrice = $this->productPrice;
		$productPaket = $this->productPaket;
		$productImg = $this->productImg;
		$productKet = $this->productKet;
		$customerName = $this->customerName;
		$customerEmail = $this->customerEmail;
		$customerPhone = $this->customerPhone;
		$customerNik = $this->customerNik;

		$payload = [
			'code'	=> 'QRIS',
			'amount'	=> 100000
		];

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_FRESH_CONNECT     => true,
			CURLOPT_URL               => "https://tripay.co.id/api/merchant/fee-calculator?" . http_build_query($payload),
			CURLOPT_RETURNTRANSFER    => true,
			CURLOPT_HEADER            => false,
			CURLOPT_HTTPHEADER        => array(
				"Authorization: Bearer " . $myapiKey
			),
			CURLOPT_FAILONERROR       => false
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		echo !empty($err) ? $err : $response;
	}

	public function daftartransaksi()
	{
		$apiKey = $this->api_Key;
		$myapiKey = $this->myapi_Key;
		$privateKey = $this->api_PKey;
		$method = $this->metode_payment;
		$merchantCode = $this->merchantCode;
		$urlPayment = $this->url_payment;
		$urlCallback = $this->url_callback;
		$detailQty = $this->detailQty;
		$detailID = $this->detailID;
		$detailTotal = $this->detailTotal;
		$detailItemID = $this->detailItemID;
		$merchantRef = $this->merchantRef;
		$amount = $this->amount;
		$no_invoice = $this->no_invoice;
		$no_services = $this->no_services;
		$metode_payment = $this->metode_payment;
		$productName = $this->productName;
		$productPrice = $this->productPrice;
		$productPaket = $this->productPaket;
		$productImg = $this->productImg;
		$productKet = $this->productKet;
		$customerName = $this->customerName;
		$customerEmail = $this->customerEmail;
		$customerPhone = $this->customerPhone;
		$customerNik = $this->customerNik;

		$payload = [
			'page'    => 1,
			'per_page'    => 25
		];

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_FRESH_CONNECT     => true,
			CURLOPT_URL               => "https://tripay.co.id/api/merchant/transactions?" . http_build_query($payload),
			CURLOPT_RETURNTRANSFER    => true,
			CURLOPT_HEADER            => false,
			CURLOPT_HTTPHEADER        => array(
				"Authorization: Bearer " . $myapiKey
			),
			CURLOPT_FAILONERROR       => false
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		echo !empty($err) ? $err : $response;
	}

	public function mintatransaksiCP()
	{
		$apiKey = $this->api_Key;
		$myapiKey = $this->myapi_Key;
		$privateKey = $this->api_PKey;
		$method = $this->metode_payment;
		$merchantCode = $this->merchantCode;
		$urlPayment = $this->url_payment;
		$urlCallback = $this->url_callback;
		$detailQty = $this->detailQty;
		$detailID = $this->detailID;
		$detailTotal = $this->detailTotal;
		$detailPrice = $this->detailPrice;
		$detailItemID = $this->detailItemID;
		$merchantRef = $this->merchantRef;
		$amount = $this->amount;
		$no_invoice = $this->no_invoice;
		$no_services = $this->no_services;
		$metode_payment = $this->metode_payment;
		$productName = $this->productName;
		$productPrice = $this->productPrice;
		$productPaket = $this->productPaket;
		$productImg = $this->productImg;
		$productKet = $this->productKet;
		$customerName = $this->customerName;
		$customerEmail = $this->customerEmail;
		$customerPhone = $this->customerPhone;
		$customerNik = $this->customerNik;

		$data = [
			'method'            => $method,
			'merchant_ref'      => $merchantRef,
			'amount'            => $amount,
			'customer_name'     => $customerName,
			'customer_email'    => $customerEmail,
			'customer_phone'    => $customerPhone,
			'order_items'       => [
				[
					'sku'       => $productPaket,
					'name'      => $productName,
					'price'     => $amount,
					'quantity'  => 1
				]
			],
			'callback_url'      => $urlCallback,
			'return_url'        => $urlPayment,
			'KADALUARSA_time'      => (time() + (24 * 60 * 60)), // 24 jam
			'signature'         => hash_hmac('sha256', $merchantCode . $merchantRef . $amount, $privateKey)
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
		echo !empty($err) ? $err : $response;
	}

	public function detailtransaksiCP()
	{
		$apiKey = $this->api_Key;
		$myapiKey = $this->myapi_Key;
		$privateKey = $this->api_PKey;
		$method = $this->metode_payment;
		$merchantCode = $this->merchantCode;
		$urlPayment = $this->url_payment;
		$urlCallback = $this->url_callback;
		$detailQty = $this->detailQty;
		$detailID = $this->detailID;
		$detailTotal = $this->detailTotal;
		$detailItemID = $this->detailItemID;
		$merchantRef = $this->merchantRef;
		$amount = $this->amount;
		$no_invoice = $this->no_invoice;
		$no_services = $this->no_services;
		$metode_payment = $this->metode_payment;
		$productName = $this->productName;
		$productPrice = $this->productPrice;
		$productPaket = $this->productPaket;
		$productImg = $this->productImg;
		$productKet = $this->productKet;
		$customerName = $this->customerName;
		$customerEmail = $this->customerEmail;
		$customerPhone = $this->customerPhone;
		$customerNik = $this->customerNik;

		$payload = [
			'reference'	=> $merchantRef
		];

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_FRESH_CONNECT     => true,
			CURLOPT_URL               => "https://tripay.co.id/api/transaction/detail?" . http_build_query($payload),
			CURLOPT_RETURNTRANSFER    => true,
			CURLOPT_HEADER            => false,
			CURLOPT_HTTPHEADER        => array(
				"Authorization: Bearer " . $myapiKey
			),
			CURLOPT_FAILONERROR       => false,
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		echo !empty($err) ? $err : $response;
	}

	public function pembuatansignatureCP()
	{
		$apiKey = $this->api_Key;
		$myapiKey = $this->myapi_Key;
		$privateKey = $this->api_PKey;
		$method = $this->metode_payment;
		$merchantCode = $this->merchantCode;
		$urlPayment = $this->url_payment;
		$urlCallback = $this->url_callback;
		$detailQty = $this->detailQty;
		$detailID = $this->detailID;
		$detailTotal = $this->detailTotal;
		$detailItemID = $this->detailItemID;
		$merchantRef = $this->merchantRef;
		$amount = $this->amount;
		$no_invoice = $this->no_invoice;
		$no_services = $this->no_services;
		$metode_payment = $this->metode_payment;
		$productName = $this->productName;
		$productPrice = $this->productPrice;
		$productPaket = $this->productPaket;
		$productImg = $this->productImg;
		$productKet = $this->productKet;
		$customerName = $this->customerName;
		$customerEmail = $this->customerEmail;
		$customerPhone = $this->customerPhone;
		$customerNik = $this->customerNik;

		$response = hash_hmac('sha256', $merchantCode . $merchantRef . $amount, $privateKey);
		echo !empty($err) ? $err : $response;
	}
}
