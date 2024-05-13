<?php defined('BASEPATH') or exit('No direct script access allowed');

class Bill extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(['router_m', 'customer_m', 'package_m', 'services_m', 'setting_m', 'bill_m', 'income_m', 'report_m']);
    }

    public function index()
    {
        $data['title'] = 'Bill';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['customer'] = $this->customer_m->getCustomeractive()->result();
        $data['bill'] = $this->bill_m->getInvoice()->result();
        $data['detail'] = $this->bill_m->getInvoiceDetail()->result();
        $data['invoice'] = $this->bill_m->invoice_no();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $company = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['other'] = $this->db->get('other')->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/bill/bill', $data);
    }

    public function invoicesync()
    {
        $company = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $dataServices = $this->db->get('services')->result();
        $no = 1;
        foreach ($dataServices as $row) {
            $amountt = $this->db->query("SELECT SUM(total) AS total_tagihan FROM `services` where `no_services` = $row->no_services")->row_array();
            $cust = $this->db->query("SELECT * FROM `customer` where `no_services` = $row->no_services")->row_array();
            if ($cust['ppn'] > 0) {
                $ppn = $company['ppn'];
            } else {
                $ppn = 0;
            }
            $amount = $amountt['total_tagihan'] + (($amountt['total_tagihan'] / 100) * $ppn);

            $this->db->where('no_services', $cust['no_services']);
            $this->db->delete('invoice_create');
            $id_invoice_c = $no++;
            $sekarang = date('d/m/Y H:i:s') . ' WIB';
            $params = [
                'id_invoice_c' => $id_invoice_c,
                'mycustomer' => $cust['name'],
                'no_services' => $cust['no_services'],
                'total_tagihan' => $amount,
                'update_time' => $sekarang,
            ];
            $this->db->insert('invoice_create', $params);
        }
        echo "<script>window.close();</script>";
    }

    public function draf()
    {
        $data['title'] = 'Bill Draf';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['customer'] = $this->customer_m->getCustomerActive()->result();
        $data['other'] = $this->db->get('other')->row_array();
        $data['invoice'] = $this->bill_m->invoice_no();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/bill/draf', $data);
    }
    public function confirmSaldo()
    {
        $no_invoice     = $this->input->post('no_invoice');
        $no_services    = $this->input->post('no_services');
        $nominal        = $this->input->post('nominal');
        $date_paymentku = $this->input->post('date_payment');
        $metode_payment = $this->input->post('metode_payment');
        $kategori       = $this->input->post('kategori');
        $date_payment   = time();
        $no_invoice     = $this->input->post('no_invoice');

        $dataUser     = $this->db->get_where('user', array('no_services' => $no_services))->row_array();
        $saldonya     = $dataUser['saldo'];
        $totalSaldo   = $saldonya - $nominal;

        if ($nominal <= $saldonya) {
            $myinvoice    = $this->db->get_where('invoice', array('invoice' => $no_invoice))->row_array();
            $nominalnya   = $myinvoice['amount'];
            $bulannya     = $myinvoice['month'];
            $tahunnya     = $myinvoice['year'];
            $statusnya    = $myinvoice['status'];
            $metodePaym   = $myinvoice['metode_payment'];

            if ($statusnya == 'SUDAH BAYAR') {
                $this->session->set_flashdata('error', 'Tagihan Periode ' . indo_month($bulannya) . ' ' . $tahunnya . ' Telah Terbayar');
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $this->db->set('saldo', $totalSaldo);
                $this->db->where('no_services', $no_services);
                $this->db->update('user');

                $this->db->set('metode_payment', $metode_payment);
                $this->db->set('date_payment', $date_payment);
                $this->db->set('status', 'SUDAH BAYAR');
                $this->db->where('invoice', $no_invoice);
                $this->db->update('invoice');

                $mycustomer   = $this->db->get_where('customer', array('no_services' => $no_services))->row_array();
                $nama_cust    = $mycustomer['name'];
                $whatsapp     = $mycustomer['no_wa'];

                $dataCampaign = $this->db->get_where('campaign', array('nomor_services' => $dataInvoice['no_services']))->row_array();
                $id_campaign  = $dataCampaign['id_campaign'];

                $url_terimakasih = base_url() . 'cronjob/terimakasih/' . $id_campaign;
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url_terimakasih);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $output = curl_exec($ch);
                curl_close($ch);

                $url_terimakasih_2 = base_url() . 'cronjob/sudahbayar/' . $no_services;
                $ch_2 = curl_init();
                curl_setopt($ch_2, CURLOPT_URL, $url_terimakasih_2);
                curl_setopt($ch_2, CURLOPT_RETURNTRANSFER, 1);
                $output_2 = curl_exec($ch_2);
                curl_close($ch_2);

                $params = [
                    'nominal' => $nominalnya,
                    'date_payment' => date('Y-m-d'),
                    'mode_payment' => $metode_payment,
                    'no_services' => $no_services,
                    'invoice_id' => $no_invoice,
                    'nama_kategori' => 'BAYAR TAGIHAN',
                    'create_by' => 1,
                    'remark' => 'Pembayaran Tagihan dengan Nomor Layanan ' . $no_services . ' a/n ' . $nama_cust . ' ' . 'Periode' . ' ' . indo_month($bulannya) . ' ' . $tahunnya,
                    'created' => time()
                ];
                $this->db->insert('income', $params);

                $paramku = [
                    'no_services' => $no_services,
                    'nama_pengeluaran' => $kategori,
                    'nominal_pengeluaran' => $nominal,
                    'ket_pengeluaran' => 'Pembayaran Tagihan Periode' . ' ' . indo_month($bulannya) . ' ' . $tahunnya,
                    'waktu_pengeluaran' => $date_paymentku
                ];
                $this->db->insert('pengeluaran', $paramku);

                $this->session->set_flashdata('success', 'Tagihan Periode ' . indo_month($bulannya) . ' ' . $tahunnya . ' Berhasil di Bayarkan');
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_flashdata('error', 'Saldo Anda Tidak Mencukupi, Silahkan Top Up Saldo Terlebih Dahulu Agar Dapat Membayar Tagihan');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function filter()
    {
        if ($this->input->post('month') <= 0) {
            echo "<script>window.location='" . site_url('bill') . "'; </script>";
        }
        $post = $this->input->post(null, TRUE);
        $data['title'] = 'Bill';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['customer'] = $this->customer_m->getCustomer()->result();
        $data['bill'] = $this->bill_m->getInvoiceFilter($post)->result();
        $data['detail'] = $this->bill_m->getInvoiceDetail()->result();
        $data['invoice'] = $this->bill_m->invoice_no();
        $data['bank'] = $this->setting_m->getBank()->row_array();
        $data['other'] = $this->db->get('other')->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/bill/billFilter', $data);
    }
    public function filterunpaid()
    {
        if ($this->input->post('month') <= 0) {
            echo "<script>window.location='" . site_url('bill/unpaid') . "'; </script>";
        }
        $post = $this->input->post(null, TRUE);
        $data['title'] = 'Belum Bayar';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['customer'] = $this->customer_m->getCustomer()->result();
        $data['bill'] = $this->bill_m->getInvoiceFilterUnpaid($post)->result();
        $data['detail'] = $this->bill_m->getInvoiceDetail()->result();
        $data['invoice'] = $this->bill_m->invoice_no();
        $data['bank'] = $this->setting_m->getBank()->row_array();
        $data['other'] = $this->db->get('other')->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/bill/unpaid', $data);
    }
    public function filterpaid()
    {
        if ($this->input->post('month') <= 0) {
            echo "<script>window.location='" . site_url('bill/paid') . "'; </script>";
        }

        $post = $this->input->post(null, TRUE);
        $data['title'] = 'Sudah Bayar';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['customer'] = $this->customer_m->getCustomer()->result();
        $data['bill'] = $this->bill_m->getInvoiceFilterpaid($post)->result();
        $data['detail'] = $this->bill_m->getInvoiceDetail()->result();
        $data['invoice'] = $this->bill_m->invoice_no();
        $data['bank'] = $this->setting_m->getBank()->row_array();
        $data['other'] = $this->db->get('other')->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/bill/paid', $data);
    }
    public function unpaid()
    {
        $data['title'] = 'Belum Bayar';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['customer'] = $this->customer_m->getCustomeractive()->result();
        $data['bill'] = $this->bill_m->getInvoiceUp()->result();
        $data['detail'] = $this->bill_m->getInvoiceDetail()->result();
        $data['invoice'] = $this->bill_m->invoice_no();
        $data['bank'] = $this->setting_m->getBank()->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['other'] = $this->db->get('other')->row_array();
        $customer = $this->customer_m->getCustomer()->result();

        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/bill/unpaid', $data);
    }
    public function history()
    {
        $data['title'] = 'Bill History';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['invoice'] = $this->db->get('invoice')->result();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['other'] = $this->db->get('other')->row_array();

        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/bill/history', $data);
    }
    public function customer()
    {
        $data['title'] = 'Belum Bayar';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['customer'] = $this->customer_m->getCustomeractive()->result();
        $data['bill'] = $this->bill_m->getInvoiceUp()->result();
        $data['detail'] = $this->bill_m->getInvoiceDetail()->result();
        $data['invoice'] = $this->bill_m->invoice_no();
        $data['bank'] = $this->setting_m->getBank()->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['other'] = $this->db->get('other')->row_array();
        $customer = $this->customer_m->getCustomer()->result();

        $this->template->load('customer', 'backend/bill/customer', $data);
    }
    public function paid()
    {
        $data['title'] = 'Sudah Bayar';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['customer'] = $this->customer_m->getCustomer()->result();
        if ($this->session->userdata('role_id') == 3) {
            $data['bill'] = $this->bill_m->getInvoicePaidby()->result();
        } else {
            $data['bill'] = $this->bill_m->getInvoiceP()->result();
        }
        $data['detail'] = $this->bill_m->getInvoiceDetail()->result();
        $data['invoice'] = $this->bill_m->invoice_no();
        $data['bank'] = $this->setting_m->getBank()->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['other'] = $this->db->get('other')->row_array();
        $customer = $this->customer_m->getCustomer()->result();

        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/bill/paid', $data);
    }

    public function view_data()
    {
        $no_services = $this->input->post('no_services');
        $data['csrf_hash'] = $this->security->get_csrf_hash();
        $data['services'] =  $this->services_m->getServicesDetail($no_services);
        $this->load->view('backend/bill/detail_bill', $data);
    }

    public function addBill()
    {

        $data = $this->input->post(null, TRUE);
        $no_services = $this->input->post('no_services');
        $month = $this->input->post('month');
        $year = $this->input->post('year');
        $cekperiode = $this->bill_m->cekPeriode($no_services, $month, $year);
        $inv = $this->input->post('invoice');
        $getInv = $this->bill_m->getRecentInv()->row();
        $cekCustomer = $this->db->get_where('customer', ['no_services' => $no_services])->row_array();
        if ($cekCustomer['ppn'] > 0) {
            $company = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
            $ppn = $company['ppn'];
        } else {
            $ppn = 0;
        }

        $cekinvoice = $this->bill_m->cekInvoice($inv);
        $getInv = $this->bill_m->getRecentInv()->row();
        if ($cekinvoice->num_rows() > 0) {
            $invoice = $getInv->invoice + 1;
        } else {
            $invoice = $this->input->post('invoice');
        }
        $amountt = $this->db->get_where('invoice_create', ['no_services' => $no_services])->row_array();
        $total_tagihan = $amountt['total_tagihan'];
        $total_pajak   = ($total_tagihan / 100) * $ppn;
        $amount = $total_tagihan + $total_pajak - $total_pajak;
        $this->load->library('ciqrcode'); //pemanggilan library QR CODE
        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/images/qrcode/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);
        $image_name = 'qr-' . $invoice . '.png'; //buat name dari qr code
        $params['data'] = site_url() . 'bill/printinvoice/' . $invoice; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
        if ($cekperiode->num_rows() > 0) {
            $this->session->set_flashdata('error', 'Gagal, Tagihan untuk periode tersebut sudah tersedia, mohon dicek kembali !');
            echo "<script>window.location='" . site_url('bill') . "'; </script>";
        } else {
            $dataUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $create_by = $dataUser['id'];
            $this->bill_m->addBill($data, $invoice, $ppn, $amount);
            $Detail = $this->services_m->getServicesDetail($this->input->post('no_services'))->result();
            $data2 = [];
            foreach ($Detail as $c => $row) {
                array_push(
                    $data2,
                    array(
                        'invoice_id' => $invoice,
                        'item_id' => $row->item_id,
                        'category_id' => $row->category_id,
                        'price' => $row->services_price,
                        'qty' => $row->qty,
                        'disc' => $row->disc,
                        'remark' => $row->remark,
                        'total' => $row->total,
                        'd_month' => $month,
                        'd_year' => $year,
                        'd_no_services' => $row->no_services,
                    )
                );
            }
            $this->bill_m->add_bill_detail($data2);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Tagihan berhasil dibuat');
            }
            redirect('bill');
        }
    }
    public function addBillDraf()
    {
        $post = $this->input->post(null, TRUE);
        $no_services = $this->input->post('no_services');
        $month = $this->input->post('month');
        $year = $this->input->post('year');
        $cekperiode = $this->bill_m->cekPeriode($no_services, $month, $year);
        $inv = $this->input->post('invoice');
        $cekinvoice = $this->bill_m->cekInvoice($inv);
        $getInv = $this->bill_m->getRecentInv()->row();
        $cekCustomer = $this->db->get_where('customer', ['no_services' => $no_services])->row_array();
        if ($cekCustomer['ppn'] > 0) {
            $company = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
            $ppn = $company['ppn'];
        } else {
            $ppn = 0;
        }
        if ($cekinvoice->num_rows() > 0) {
            $invoice = $getInv->invoice + 1;
        } else {
            $invoice = $this->input->post('invoice');
        }
        $query = "SELECT *
        FROM `services` where `no_services` = $no_services";
        $bill = $this->db->query($query)->result();
        $amountt = 0;
        foreach ($bill as $bill) {
            $amountt += (int) $bill->total;
        }
        $amount = $amountt + $amountt * ($ppn / 100);
        $this->load->library('ciqrcode'); //pemanggilan library QR CODE
        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/images/qrcode/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);
        $image_name = 'qr-' . $invoice . '.png'; //buat name dari qr code
        $params['data'] = site_url() . 'bill/printinvoice/' . $invoice; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
        if ($cekperiode->num_rows() > 0) {
            $this->session->set_flashdata('error', 'Gagal, Tagihan untuk periode tersebut sudah tersedia, mohon dicek kembali !');
            echo "<script>window.location='" . site_url('bill') . "'; </script>";
        } else {
            $this->bill_m->addBill($post, $invoice, $ppn, $amount);
            $Detail = $this->services_m->getServicesDetail($this->input->post('no_services'))->result();
            $data2 = [];
            foreach ($Detail as $c => $row) {
                array_push(
                    $data2,
                    array(
                        'invoice_id' => $invoice,
                        'item_id' => $row->item_id,
                        'category_id' => $row->category_id,
                        'price' => $row->services_price,
                        'qty' => $row->qty,
                        'disc' => $row->disc,
                        'remark' => $row->remark,
                        'total' => $row->total,
                        'd_month' => $month,
                        'd_year' => $year,
                        'd_no_services' => $row->no_services,
                    )
                );
            }
            $this->bill_m->add_bill_detail($data2);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Tagihan berhasil dibuat');
            }
            redirect('bill/draf');
        }
    }
    public function generateBill()
    {
        $no_services = $this->customer_m->getCustomerActive()->result();
        $month = $this->input->post('month');
        $year = $this->input->post('year');
        $inv = $this->input->post('invoice');
        $cekperiode = $this->bill_m->cekPeriodeMonth($month, $year);
        $cekinvoice = $this->bill_m->cekInvoice($inv);
        $getInv = $this->bill_m->getRecentInv()->row();
        if ($cekinvoice->num_rows() > 0) {
            $kode = $getInv->invoice + 1;
        } else {
            $tgl = date('ymd');
            $no = 001;
            $kode = ($tgl . '' .  str_pad($no, 3, "0", STR_PAD_LEFT));
        }
        if ($cekinvoice->num_rows() > 0) {
            $kodeku = $getInv->invoice + 1;
        } else {
            $tgl = date('ymd');
            $no = 001;
            $kodeku = ($tgl . '' .  str_pad($no, 3, "0", STR_PAD_LEFT));
        }

        if ($cekperiode->num_rows() > 0) {
            $this->session->set_flashdata('error', 'Gagal, Tagihan untuk periode ini sudah tersedia disalah satu pelanggan, mohon dicek kembali !');
            echo "<script>window.location='" . site_url('bill') . "'; </script>";
        } else {
            foreach ($no_services as $c => $row) {
                $no_servicesnya = $row->no_services;
                $amountt = $this->db->get_where('invoice_create', ['no_services' => $no_servicesnya])->row_array();
                $cust = $this->db->get_where('customer', ['no_services' => $no_servicesnya])->row_array();
                if ($cust['ppn'] > 0) {
                    $company = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
                    $ppn = $company['ppn'];
                } else {
                    $ppn = 0;
                }
                $dataUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
                $total_tagihan = $amountt['total_tagihan'];
                $total_pajak   = ($total_tagihan / 100) * $ppn;
                $total_amount  = $total_tagihan + $total_pajak - $total_pajak;
                $params = [
                    'no_services' => $row->no_services,
                    'invoice' => $kodeku++,
                    'month' => $month,
                    'i_ppn' => $ppn,
                    'amount' => $total_amount,
                    'year' => $year,
                    'code_unique' => substr(intval(rand()), 0, 3),
                    'status' => 'BELUM BAYAR',
                    'create_by' => $dataUser['id'],
                    'created' => time()
                ];
                $this->db->insert('invoice', $params);
                $detail_service = $this->db->get_where('services', ['no_services' => $no_servicesnya])->result();
                foreach ($detail_service as $c => $row) {
                    $detail_invoice = $this->db->get_where('invoice_detail', ['d_no_services' => $row->no_services, 'd_month' => $month, 'd_year' => $year, 'item_id' => $row->item_id, 'category_id' => $row->category_id])->num_rows();
                    if ($detail_invoice <= 0) {
                        $params = [
                            'invoice_id' => $kodeku++,
                            'item_id' => $row->item_id,
                            'category_id' => $row->category_id,
                            'price' => $row->price,
                            'qty' => $row->qty,
                            'disc' => $row->disc,
                            'remark' => $row->remark,
                            'total' => $row->total,
                            'd_month' => $month,
                            'd_year' => $year,
                            'd_no_services' => $row->no_services,
                        ];
                        $this->db->insert('invoice_detail', $params);
                    }
                }
            }
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Generate Tagihan berhasil dibuat');
            }
            redirect('bill');
        }
    }
    public function generateAllBill()
    {
        $tanggahariini = date('d');
        if ($tanggahariini >= 1) {
            $no_services = $this->customer_m->getCustomerActive()->result();
            $month = date('m');
            $year = date('Y');
            $tgl = date('ymd');
            $no = 001;
            $inv = ($tgl . '' .  str_pad($no, 3, "0", STR_PAD_LEFT));  //cek jika kode belum terdapat pada table
            $cekperiode = $this->bill_m->cekPeriodeMonth($month, $year);
            $cekinvoice = $this->bill_m->cekInvoice($inv);
            $getInv = $this->bill_m->getRecentInv()->row();
            if ($cekinvoice->num_rows() > 0) {
                $kode = $getInv->invoice + 1;
            } else {
                $tgl = date('ymd');
                $no = 001;
                $kode = ($tgl . '' .  str_pad($no, 3, "0", STR_PAD_LEFT));
            }
            if ($cekinvoice->num_rows() > 0) {
                $kodeku = $getInv->invoice + 1;
            } else {
                $tgl = date('ymd');
                $no = 001;
                $kodeku = ($tgl . '' .  str_pad($no, 3, "0", STR_PAD_LEFT));
            }

            if ($cekperiode->num_rows() > 0) {
                echo "<script>window.location='" . site_url('bill') . "'; </script>";
            } else {

                $dataNS = [];
                foreach ($no_services as $c => $row) {
                    if ($row->ppn != 0) {
                        $company = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
                        $ppn = $company['ppn'];
                    } else {
                        $ppn = 0;
                    }
                    $query = "SELECT *
					FROM `services` where `no_services` = $row->no_services";
                    $bill = $this->db->query($query)->result();
                    $amountt = 0;
                    foreach ($bill as $bill) {
                        $amountt += (int) $bill->total;
                    }
                    $amount = $amountt + $amountt * ($ppn / 100);
                    array_push(
                        $dataNS,
                        array(
                            'no_services' => $row->no_services,
                            'invoice' => $kode++,
                            'month' => $month,
                            'i_ppn' => $ppn,
                            'amount' => $amount,
                            'year' => $year,
                            'code_unique' => substr(intval(rand()), 0, 3),
                            'status' => 'BELUM BAYAR',
                            'created' => time()
                        )
                    );
                }
                $this->bill_m->add_bill_generate($dataNS);
                $detail = $this->services_m->getServicesActive()->result();
                $data2 = [];
                foreach ($detail as $c => $row) {
                    array_push(
                        $data2,
                        array(
                            'invoice_id' => $kodeku++,
                            'item_id' => $row->item_id,
                            'category_id' => $row->category_id,
                            'price' => $row->services_price,
                            'qty' => $row->qty,
                            'disc' => $row->disc,
                            'remark' => $row->remark,
                            'total' => $row->total,
                            'd_month' => $month,
                            'd_year' => $year,
                            'd_no_services' => $row->no_services,
                        )
                    );
                }
                $this->bill_m->add_bill_detail($data2);
                redirect('bill');
            }
        } else {
            redirect('bill');
        }
    }
    public function generateBelum()
    {
        $tanggahariini = date('d');
        if ($tanggahariini >= 1) {
            $no_services = $this->customer_m->getCustomerActive()->result();
            $month = date('m');
            $year = date('Y');
            $tgl = date('ymd');
            $no = 001;
            $inv = ($tgl . '' .  str_pad($no, 3, "0", STR_PAD_LEFT));  //cek jika kode belum terdapat pada table
            $cekperiode = $this->bill_m->cekPeriodeMonth($month, $year);
            $cekinvoice = $this->bill_m->cekInvoice($inv);
            $getInv = $this->bill_m->getRecentInv()->row();
            if ($cekinvoice->num_rows() > 0) {
                $kode = $getInv->invoice + 1;
            } else {
                $tgl = date('ymd');
                $no = 001;
                $kode = ($tgl . '' .  str_pad($no, 3, "0", STR_PAD_LEFT));
            }
            if ($cekinvoice->num_rows() > 0) {
                $kodeku = $getInv->invoice + 1;
            } else {
                $tgl = date('ymd');
                $no = 001;
                $kodeku = ($tgl . '' .  str_pad($no, 3, "0", STR_PAD_LEFT));
            }

            if ($cekperiode->num_rows() > 0) {
                echo "<script>window.location='" . site_url('bill/unpaid') . "'; </script>";
            } else {

                $dataNS = [];
                foreach ($no_services as $c => $row) {
                    if ($row->ppn != 0) {
                        $company = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
                        $ppn = $company['ppn'];
                    } else {
                        $ppn = 0;
                    }
                    $query = "SELECT *
					FROM `services` where `no_services` = $row->no_services";
                    $bill = $this->db->query($query)->result();
                    $amountt = 0;
                    foreach ($bill as $bill) {
                        $amountt += (int) $bill->total;
                    }
                    $amount = $amountt + $amountt * ($ppn / 100);
                    array_push(
                        $dataNS,
                        array(
                            'no_services' => $row->no_services,
                            'invoice' => $kode++,
                            'month' => $month,
                            'i_ppn' => $ppn,
                            'amount' => $amount,
                            'year' => $year,
                            'code_unique' => substr(intval(rand()), 0, 3),
                            'status' => 'BELUM BAYAR',
                            'created' => time()
                        )
                    );
                }
                $this->bill_m->add_bill_generate($dataNS);
                $detail = $this->services_m->getServicesActive()->result();
                $data2 = [];
                foreach ($detail as $c => $row) {
                    array_push(
                        $data2,
                        array(
                            'invoice_id' => $kodeku++,
                            'item_id' => $row->item_id,
                            'category_id' => $row->category_id,
                            'price' => $row->services_price,
                            'qty' => $row->qty,
                            'disc' => $row->disc,
                            'remark' => $row->remark,
                            'total' => $row->total,
                            'd_month' => $month,
                            'd_year' => $year,
                            'd_no_services' => $row->no_services,
                        )
                    );
                }
                $this->bill_m->add_bill_detail($data2);
                redirect('bill/unpaid');
            }
        } else {
            redirect('bill/unpaid');
        }
    }
    public function detail($invoice)
    {
        $data['title'] = 'Detail Bill';
        $data['invoice'] = $this->bill_m->getEditInvoice($invoice);
        $data['p_item'] = $this->package_m->getPItem()->result();
        $data['bill'] = $this->bill_m->getBill($invoice)->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['other'] = $this->db->get('other')->row_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/bill/invoice_detail', $data);
    }

    public function donation()
    {
        $data['title'] = 'Donasi';
        $data['customer'] = $this->customer_m->getCustomer()->result();
        $data['bank'] = $this->setting_m->getBank()->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/bill/donation', $data);
    }
    public function view_donation()
    {
        $month = $this->input->post('month');
        $year = $this->input->post('year');
        if (isset($_POST['cek_bill'])) {
            $data['bill'] = $this->bill_m->getInvoiceThisMonth($month, $year)->result();
            $this->load->view('backend/bill/tampil_donation', $data);
        } else {
            echo "Not Found";
        }
    }
    public function delete()
    {
        $post = $this->input->post(null, TRUE);
        $invoice = $this->input->post('invoice');
        $cekConfir = $this->db->get_where('confirm_payment', ['invoice_id' => $invoice])->num_rows();
        if ($cekConfir > 0) {
            $this->session->set_flashdata('error', 'Tagihan tidak bisa dihapus dikarenakan masih ada di konfirmasi pembayaran');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->bill_m->delete($invoice);
            $this->bill_m->deleteDetailInvoice($invoice);
            $this->bill_m->deleteDetailBill($post);
            $target_file = './assets/images/qrcode/' . $invoice . '.png';
            unlink($target_file);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data Tagihan berhasil dihapus');
            }
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function cetak($invoice)
    {
        $data['title'] = 'Invoice';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['invoice'] = $this->bill_m->getBill($invoice);
        $data['invoice_detail'] = $this->bill_m->getDetailBill($invoice);
        $data['bill'] = $this->bill_m->getBill($invoice)->row_array();
        $data['bank'] = $this->setting_m->getBank()->result();
        $data['p_item'] = $this->package_m->getPItem()->result();
        $data['other'] = $this->db->get('other')->row_array();
        $this->load->library('ciqrcode'); //pemanggilan library QR CODE
        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/images/qrcode/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
        $inv = $this->db->get_where('invoice', ['invoice' => $invoice])->row_array();
        $this->ciqrcode->initialize($config);
        $image_name = 'qr-' . $invoice . '.png'; //buat name dari qr code
        $params['data'] = site_url() . 'bill/printinvoice/' . $invoice; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
        $this->load->view('backend/bill/invoiceThermal', $data);
    }
    public function printinvoice($invoice)
    {
        $data['title'] = 'Invoice';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['invoice'] = $this->bill_m->getBill($invoice);
        $data['invoice_detail'] = $this->bill_m->getDetailBill($invoice);
        $data['bill'] = $this->bill_m->getBill($invoice)->row_array();
        $data['bank'] = $this->setting_m->getBank()->result();
        $data['p_item'] = $this->package_m->getPItem()->result();
        $data['other'] = $this->db->get('other')->row_array();
        $this->load->library('ciqrcode'); //pemanggilan library QR CODE
        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/images/qrcode/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
        $inv = $this->db->get_where('invoice', ['invoice' => $invoice])->row_array();
        $this->ciqrcode->initialize($config);
        $image_name = 'qr-' . $invoice . '.png'; //buat name dari qr code
        $params['data'] = site_url() . 'bill/printinvoice/' . $invoice; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
        $this->load->view('backend/bill/invoice', $data);
    }
    public function printinvoice58mm($invoice)
    {
        $data['title'] = 'Invoice';
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['invoice'] = $this->bill_m->getBill($invoice);
        $data['invoice_detail'] = $this->bill_m->getDetailBill($invoice);
        $data['bill'] = $this->bill_m->getBill($invoice)->row_array();
        $data['bank'] = $this->setting_m->getBank()->result();
        $data['p_item'] = $this->package_m->getPItem()->result();
        $data['other'] = $this->db->get('other')->row_array();
        $this->load->view('backend/bill/invoice58mm', $data);
    }
    public function printinvoicethermal($invoice)
    {
        $data['title'] = 'Invoice';
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['invoice'] = $this->bill_m->getBill($invoice);
        $data['invoice_detail'] = $this->bill_m->getDetailBill($invoice);
        $data['bill'] = $this->bill_m->getBill($invoice)->row_array();
        $data['bank'] = $this->setting_m->getBank()->result();
        $data['p_item'] = $this->package_m->getPItem()->result();
        $data['other'] = $this->db->get('other')->row_array();
        $this->load->view('backend/bill/invoiceThermal', $data);
    }
    public function printinvoiceselected()
    {
        $invoice = $_POST['invoice'];
        $data['title'] = 'Invoice';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['invoice'] = $this->bill_m->getBill($invoice)->result();
        $data['invoice_detail'] = $this->bill_m->getBill($invoice)->result();
        $data['bill'] = $this->bill_m->getInvoiceSelected($invoice)->result();
        $data['other'] = $this->db->get('other')->row_array();
        $data['bank'] = $this->setting_m->getBank()->result();
        $data['p_item'] = $this->package_m->getPItem()->result();

        $this->load->view('backend/bill/invoiceselected', $data);
    }
    public function printinvoiceselectedthermal()
    {
        $invoice = $_POST['invoice'];
        $data['title'] = 'Invoice';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['invoice'] = $this->bill_m->getBill($invoice)->result();
        $data['invoice_detail'] = $this->bill_m->getBill($invoice)->result();
        $data['bill'] = $this->bill_m->getInvoiceSelected($invoice)->result();
        $data['other'] = $this->db->get('other')->row_array();
        $data['bank'] = $this->setting_m->getBank()->result();
        $data['p_item'] = $this->package_m->getPItem()->result();
        $this->load->view('backend/bill/invoiceselectedthermal', $data);
    }
    public function printinvoiceselected58mm()
    {
        $invoice = $_POST['invoice'];
        $data['title'] = 'Invoice';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['invoice'] = $this->bill_m->getBill($invoice)->result();
        $data['invoice_detail'] = $this->bill_m->getBill($invoice)->result();
        $data['bill'] = $this->bill_m->getInvoiceSelected($invoice)->result();
        $data['other'] = $this->db->get('other')->row_array();
        $data['bank'] = $this->setting_m->getBank()->result();
        $data['p_item'] = $this->package_m->getPItem()->result();
        $this->load->view('backend/bill/invoiceselected58mm', $data);
    }
    public function whatsappselected()
    {
        $invoice = $_POST['invoice'];
        $data['title'] = 'Kirim WhatsaApp';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $post = $this->input->post(null, TRUE);
        $invoice = $this->input->post('invoice');
        if ($invoice[1] == '') {
            $this->session->set_flashdata('error', 'Data Tagihan tidak ada yang anda Pilih / Ceklis');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $totalselected = count($invoice);
            for ($i = 0; $i < $totalselected; $i++) {
                $no_invoice = $invoice[$i];
                $cekInvoice = $this->db->get_where('invoice', ['invoice' => $no_invoice])->num_rows();
                if ($cekInvoice > 0) {
                    $dataInvoice  = $this->db->get_where('invoice', array('invoice' => $no_invoice))->row_array();
                    $no_services  = $dataInvoice['no_services'];
                    $statusnya    = $dataInvoice['status'];
                    $dataCampaign = $this->db->get_where('campaign', array('nomor_services' => $no_services))->row_array();
                    $id_campaign  = $dataCampaign['id_campaign'];

                    if ($statusnya == 'BELUM BAYAR') {
                        $url_terimakasih = base_url() . 'cronjob/kirimpesan/' . $id_campaign;
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $url_terimakasih);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        $output = curl_exec($ch);
                        curl_close($ch);
                    } else {
                        $url_terimakasih = base_url() . 'cronjob/terimakasih/' . $id_campaign;
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $url_terimakasih);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        $output = curl_exec($ch);
                        curl_close($ch);

                        $url_terimakasih_2 = base_url() . 'cronjob/sudahbayar/' . $no_services;
                        $ch_2 = curl_init();
                        curl_setopt($ch_2, CURLOPT_URL, $url_terimakasih_2);
                        curl_setopt($ch_2, CURLOPT_RETURNTRANSFER, 1);
                        $output_2 = curl_exec($ch_2);
                        curl_close($ch_2);
                    }
                }
            }
            $this->session->set_flashdata('success', 'Data Tagihan yang di Pilih berhasil dikirimkan WA');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function hapusinvoiceselected()
    {
        $invoice = $_POST['invoice'];
        $data['title'] = 'Hapus Invoice';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $post = $this->input->post(null, TRUE);
        $invoice = $this->input->post('invoice');
        if ($invoice[1] == '') {
            $this->session->set_flashdata('error', 'Data Tagihan tidak ada yang anda Pilih / Ceklis');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $totalselected = count($invoice);
            for ($i = 0; $i < $totalselected; $i++) {
                $no_invoice = $invoice[$i];
                if ($i != '' || $i != NULL) {
                    $cekInvoice = $this->db->get_where('invoice', ['invoice' => $no_invoice])->num_rows();
                    if ($cekInvoice > 0) {
                        $cekConfir = $this->db->get_where('confirm_payment', ['invoice_id' => $no_invoice])->num_rows();
                        if ($cekConfir > 0) {
                            $this->session->set_flashdata('error', 'Tagihan tidak bisa dihapus dikarenakan masih ada di konfirmasi pembayaran');
                            redirect($_SERVER['HTTP_REFERER']);
                        } else {
                            $dataInvoice = $this->db->get_where('invoice', array('invoice' => $no_invoice))->row_array();
                            $month       = $dataInvoice['month'];
                            $year        = $dataInvoice['year'];
                            $no_services = $dataInvoice['no_services'];

                            $this->db->where('invoice_id', $no_invoice);
                            $this->db->delete('confirm_payment');
                            
                            $this->db->where('invoice', $no_invoice);
                            $this->db->delete('invoice');

                            $this->db->where('d_month', $month);
                            $this->db->where('d_year', $year);
                            $this->db->where('d_no_services', $no_services);
                            $this->db->where('invoice_id', $no_invoice);
                            $this->db->delete('invoice_detail');

                            $this->db->where('invoice_id', $no_invoice);
                            $this->db->delete('income');
                        }
                    }
                }
            }
            $this->session->set_flashdata('success', 'Data Tagihan yang di Pilih berhasil Dihapus');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function hapusbulanini()
    {
        $dataCustomer = $this->db->get_where('customer', ['c_status' => 'Aktif'])->result();
        foreach ($dataCustomer as $row) {
            $myservice   = $row->no_services;
            $month       = date('m');
            if ($month < 10) {
                $mymonth = '0' . $month;
            } else {
                $mymonth = $month;
            }
            $year        = date('Y');

            $this->db->query("DELETE FROM invoice WHERE no_services='$myservice' AND month='$month' AND year='$year'");

            $this->db->query("DELETE FROM invoice_detail WHERE d_no_services='$myservice' AND d_month='$mymonth' AND d_year='$year'");

            $this->db->where('no_services', $myservice);
            $this->db->where('month', $mymonth);
            $this->db->where('year', $year);
            $this->db->delete('invoice');

            $this->db->where('d_no_services', $myservice);
            $this->db->where('d_month', $month);
            $this->db->where('d_year', $year);
            $this->db->delete('invoice_detail');

            echo '#' . $row->customer_id . ' Invoice Pelanggan a/n ' . $row->name . ' dengan Nomor Layanan ' . $myservice . ' Periode ' . indo_month($mymonth) . ' Tahun ' . $year . ' berhasil DIHAPUS<br>';

            echo '#' . $row->customer_id . ' Invoice Detail a/n ' . $row->name . ' dengan Nomor Layanan ' . $myservice . ' Periode/Bulan ' . $month . ' Tahun ' . $year . ' berhasil DIHAPUS<br><br>';
            echo "<script>window.close();</script>";
        }
    }
    public function hapusbulandepan()
    {
        $dataCustomer = $this->db->get_where('customer', ['c_status' => 'Aktif'])->result();
        foreach ($dataCustomer as $row) {
            $myservice   = $row->no_services;
            $month       = (date('m') + 1);
            if ($month < 10) {
                $mymonth = '0' . $month;
            } else {
                $mymonth = $month;
            }
            $year        = date('Y');

            $this->db->query("DELETE FROM invoice WHERE no_services='$myservice' AND month='$month' AND year='$year'");

            $this->db->query("DELETE FROM invoice_detail WHERE d_no_services='$myservice' AND d_month='$mymonth' AND d_year='$year'");

            $this->db->where('no_services', $myservice);
            $this->db->where('month', $mymonth);
            $this->db->where('year', $year);
            $this->db->delete('invoice');

            $this->db->where('d_no_services', $myservice);
            $this->db->where('d_month', $month);
            $this->db->where('d_year', $year);
            $this->db->delete('invoice_detail');

            echo '#' . $row->customer_id . ' Invoice Pelanggan a/n ' . $row->name . ' dengan Nomor Layanan ' . $myservice . ' Periode ' . indo_month($mymonth) . ' Tahun ' . $year . ' berhasil DIHAPUS<br>';

            echo '#' . $row->customer_id . ' Invoice Detail a/n ' . $row->name . ' dengan Nomor Layanan ' . $myservice . ' Periode/Bulan ' . $month . ' Tahun ' . $year . ' berhasil DIHAPUS<br><br>';
            echo "<script>window.close();</script>";
        }
    }
    public function hapusbulankemarin()
    {
        $dataCustomer = $this->db->get_where('customer', ['c_status' => 'Aktif'])->result();
        foreach ($dataCustomer as $row) {
            $myservice   = $row->no_services;
            $month       = (date('m') - 1);
            if ($month < 10) {
                $mymonth = '0' . $month;
            } else {
                $mymonth = $month;
            }
            $year        = date('Y');

            $this->db->query("DELETE FROM invoice WHERE no_services='$myservice' AND month='$month' AND year='$year'");

            $this->db->query("DELETE FROM invoice_detail WHERE d_no_services='$myservice' AND d_month='$mymonth' AND d_year='$year'");

            $this->db->where('no_services', $myservice);
            $this->db->where('month', $mymonth);
            $this->db->where('year', $year);
            $this->db->delete('invoice');

            $this->db->where('d_no_services', $myservice);
            $this->db->where('d_month', $month);
            $this->db->where('d_year', $year);
            $this->db->delete('invoice_detail');

            echo '#' . $row->customer_id . ' Invoice Pelanggan a/n ' . $row->name . ' dengan Nomor Layanan ' . $myservice . ' Periode ' . indo_month($mymonth) . ' Tahun ' . $year . ' berhasil DIHAPUS<br>';

            echo '#' . $row->customer_id . ' Invoice Detail a/n ' . $row->name . ' dengan Nomor Layanan ' . $myservice . ' Periode/Bulan ' . $month . ' Tahun ' . $year . ' berhasil DIHAPUS<br><br>';
            echo "<script>window.close();</script>";
        }
    }
    public function lunasiselected()
    {
        $invoice = $_POST['invoice'];
        $data['title'] = 'Lunasi Invoice';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $post = $this->input->post(null, TRUE);
        $invoice = $this->input->post('invoice');
        if ($invoice[1] == '') {
            $this->session->set_flashdata('error', 'Data Tagihan tidak ada yang anda Pilih / Ceklis');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $totalselected = count($invoice);
            for ($i = 0; $i < $totalselected; $i++) {
                $no_invoice = $invoice[$i];
                $cekInvoice = $this->db->get_where('invoice', ['invoice' => $no_invoice])->num_rows();
                if ($cekInvoice > 0) {
                    $cekConfir = $this->db->get_where('confirm_payment', ['invoice_id' => $no_invoice])->num_rows();
                    if ($cekConfir > 0) {
                        $this->session->set_flashdata('error', 'Tagihan tidak bisa dilunasi dikarenakan masih ada di konfirmasi pembayaran');
                        redirect($_SERVER['HTTP_REFERER']);
                    } else {
                        $dataInvoice  = $this->db->get_where('invoice', array('invoice' => $no_invoice))->row_array();
                        $no_services  = $dataInvoice['no_services'];
                        $nominal      = $dataInvoice['amount'];
                        $month        = indo_month($dataInvoice['month']);
                        $year         = $dataInvoice['year'];
                        $dataCampaign = $this->db->get_where('campaign', array('nomor_services' => $no_services))->row_array();
                        $id_campaign  = $dataCampaign['id_campaign'];
                        $name         = $dataCampaign['nama_pelanggan'];

                        $params = [
                            'status' => 'SUDAH BAYAR',
                            'metode_payment' => 'MANUAL',
                            'date_payment' => time(),
                            'create_by' => $this->session->userdata('id'),
                        ];
                        $this->db->where('invoice', $no_invoice);
                        $this->db->update('invoice', $params);

                        $paramku = [
                            'nominal' => $nominal,
                            'date_payment' => date('Y-m-d'),
                            'mode_payment' => 'TRANSAKSI MANUAL',
                            'no_services' => $no_services,
                            'invoice_id' => $no_invoice,
                            'nama_kategori' => 'BAYAR TAGIHAN',
                            'create_by' => $this->session->userdata('id'),
                            'remark' => 'Pembayaran Tagihan dengan Nomor Layanan ' . $no_services . ' a/n ' . $name . ' ' . 'Periode' . ' ' . $month . ' ' . $year,
                            'created' => time()
                        ];
                        $this->db->insert('income', $paramku);

                        $url_terimakasih = base_url() . 'cronjob/terimakasih/' . $id_campaign;
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $url_terimakasih);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        $output = curl_exec($ch);
                        curl_close($ch);

                        $url_terimakasih_2 = base_url() . 'cronjob/sudahbayar/' . $no_services;
                        $ch_2 = curl_init();
                        curl_setopt($ch_2, CURLOPT_URL, $url_terimakasih_2);
                        curl_setopt($ch_2, CURLOPT_RETURNTRANSFER, 1);
                        $output_2 = curl_exec($ch_2);
                        curl_close($ch_2);
                    }
                }
            }
            $this->session->set_flashdata('success', 'Data Tagihan yang di Pilih berhasil Dilunasi');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function printinvoiceunpaid()
    {
        $data['title'] = 'Invoice';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['bill'] = $this->bill_m->getInvoiceUnpaid()->result();
        $data['bank'] = $this->setting_m->getBank()->result();
        $data['p_item'] = $this->package_m->getPItem()->result();
        $data['other'] = $this->db->get('other')->row_array();
        $this->load->view('backend/bill/invoiceselected', $data);
    }
    public function printinvoiceunpaidthermal()
    {
        $data['title'] = 'Invoice';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['bill'] = $this->bill_m->getInvoiceUnpaid()->result();
        $data['bank'] = $this->setting_m->getBank()->result();
        $data['p_item'] = $this->package_m->getPItem()->result();
        $data['other'] = $this->db->get('other')->row_array();
        $this->load->view('backend/bill/invoiceselectedthermal', $data);
    }
    public function printinvoicepaid()
    {
        $data['title'] = 'Invoice';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['bill'] = $this->bill_m->getInvoicePaid()->result();
        $data['bank'] = $this->setting_m->getBank()->result();
        $data['p_item'] = $this->package_m->getPItem()->result();
        $data['other'] = $this->db->get('other')->row_array();
        $this->load->view('backend/bill/invoiceselected', $data);
    }
    public function printinvoicepaidthermal()
    {
        $data['title'] = 'Invoice';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['bill'] = $this->bill_m->getInvoicePaid()->result();
        $data['bank'] = $this->setting_m->getBank()->result();
        $data['p_item'] = $this->package_m->getPItem()->result();
        $data['other'] = $this->db->get('other')->row_array();
        $this->load->view('backend/bill/invoiceselectedthermal', $data);
    }
    public function debt()
    {
        $data['title'] = 'Tunggakan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['customer'] = $this->customer_m->getCustomer()->result();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['bank'] = $this->setting_m->getBank()->row_array();
        $data['other'] = $this->db->get('other')->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/bill/debt', $data);
    }

    public function printdebt($no_services)
    {
        $data['title'] = 'Akumulasi Tagihan ' . $no_services;
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['customer'] = $this->customer_m->getNSCustomer($no_services)->row_array();
        $data['bill'] = $this->bill_m->getDebt($no_services)->num_rows();
        $data['other'] = $this->db->get('other')->row_array();
        $data['bank'] = $this->setting_m->getBank()->result();

        $this->load->view('backend/bill/invoicedebt', $data);
    }
    public function billpaid()
    {
        $post = $this->input->post(null, TRUE);
        $invoice = $this->input->post('invoice');
        $dataInvoice  = $this->db->get_where('invoice', array('invoice' => $invoice))->row_array();
        $dataCampaign = $this->db->get_where('campaign', array('nomor_services' => $dataInvoice['no_services']))->row_array();
        $id_campaign  = $dataCampaign['id_campaign'];
        $no_services  = $dataCampaign['nomor_services'];
        $data['other'] = $this->db->get('other')->row_array();
        $cekConfirm = $this->db->get_where('confirm_payment', ['invoice_id' => $post['invoice']])->row_array();
        if ($cekConfirm > 0) {
            $this->bill_m->UpdateConfirmPayment($post);
        }

        $this->bill_m->payment($post);
        $this->income_m->addPaymentFast($post);
        if ($this->db->affected_rows() > 0) {

            $url_terimakasih = base_url() . 'cronjob/terimakasih/' . $id_campaign;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url_terimakasih);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);

            $url_terimakasih_2 = base_url() . 'cronjob/sudahbayar/' . $no_services;
            $ch_2 = curl_init();
            curl_setopt($ch_2, CURLOPT_URL, $url_terimakasih_2);
            curl_setopt($ch_2, CURLOPT_RETURNTRANSFER, 1);
            $output_2 = curl_exec($ch_2);
            curl_close($ch_2);

            $this->session->set_flashdata('success-payment', '<h3>Tagihan berhasil terbayarkan</h3> <a class="btn btn-success" target="blank" href="' . site_url('bill/printinvoice/' . $invoice) . '">Cetak A4</a>&nbsp; <a class="btn btn-success" target="blank" href="' . site_url('bill/printinvoicethermal/' . $invoice) . '">Cetak Thermal</a>');
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    // PAYMENT
    public function payment()
    {
        $post = $this->input->post(null, TRUE);
        $invoice = $this->input->post('invoice');
        $cekConfirm = $this->db->get_where('confirm_payment', ['invoice_id' => $post['invoice']])->row_array();
        if ($cekConfirm > 0) {
            $this->bill_m->UpdateConfirmPayment($post);
        }

        $this->bill_m->payment($post);
        $this->income_m->addPayment($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success-payment', '<h3>Tagihan berhasil terbayarkan</h3> <a class="btn btn-success" target="blank" href="' . site_url('bill/printinvoice/' . $invoice) . '">Cetak A4</a>&nbsp; <a class="btn btn-success" target="blank" href="' . site_url('bill/printinvoicethermal/' . $invoice) . '">Cetak Thermal</a>');
        }
        echo "<script>window.location='" . site_url('bill/detail/' . $invoice) . "'; </script>";
    }

    public function topupSaldo()
    {
        $post = $this->input->post(null, TRUE);
        $post['picture'] = 'tripay.png';
        $bot = $this->db->get('bot_telegram')->row_array();
        $tokens = $bot['token']; // token bot
        $owner = $bot['id_telegram_owner'];
        $nominalTF = indo_currency($post['nominal']);
        $time_saldo = date('d/m/Y H:i:s') . ' WIB';
        $merchantRef = 'NID-' . date('ymdHis');

        $params = [
            'kategori_saldo' => $post['kategori'],
            'nominal_saldo' => $post['nominal'],
            'metode_bayar' => $post['metode_payment'],
            'merchant_ref' => $merchantRef,
            'no_services' => $post['no_services'],
            'status_saldo' => 'PENDING',
            'time_saldo' => $time_saldo
        ];
        $this->db->insert('saldo', $params);

        $sendmessage = [
            'resize_keyboard' => true,
            'parse_mode' => 'html',
            'text' => "<b>KONFIRMASI TOP UP SALDO</b>\n$post[name]\nNo Layanan : $post[no_services]\nJumlah : Rp. $nominalTF\nTanggal Bayar : $post[request]\nMetode : $post[metode_payment]\n",
            'chat_id' => $owner
        ];

        file_get_contents("https://api.telegram.org/bot$tokens/sendMessage?" . http_build_query($sendmessage));
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Konfirmasi pembayaran sudah terkirim, mohon tunggu untuk di verifikasi');
        }

        $mypayment = $this->db->get('paymentsaldo')->row_array();
        $apiKey = 'DEV-' . $mypayment['apikey_pay'];
        $myapiKey = $mypayment['apikey_pay'];
        $privateKey = $mypayment['private_key'];
        $merchantCode = $mypayment['merchant_id'];
        $urlPayment = $mypayment['url_payment'];
        $urlCallback = $mypayment['url_callback'];
        $expiredDay = $mypayment['expired_day'];
        $admin_cost = $mypayment['admin_cost'];

        $methodPayment = $post['metode_payment'];
        $customerName = $post['name'];
        $nominal = $post['nominal'] + $admin_cost;
        $no_services = $post['no_services'];
        $productName = 'Top Up Saldo Akun';
        $productPaket = 'Saldo';

        $mycustomer = $this->db->get_where('customer', array('no_services' => $no_services))->row_array();
        $customerEmail = $mycustomer['email'];
        $customerPhone = $mycustomer['no_wa'];
        $coverage_id = $mycustomer['coverage'];

        $data = [
            'method'            => $methodPayment,
            'merchant_ref'      => $merchantRef,
            'amount'            => $nominal,
            'customer_name'     => $customerName,
            'customer_email'    => $customerEmail,
            'customer_phone'    => $customerPhone,
            'order_items'       => [
                [
                    'sku'           => $productPaket,
                    'name'          => $productName,
                    'price'         => $nominal,
                    'quantity'      => 1
                ]
            ],
            'callback_url'      => $urlCallback,
            'return_url'        => $urlPayment,
            'expired_time'      => (time() + ($expiredDay * 24 * 60 * 60)), // 24 jam
            'signature'         => hash_hmac('sha256', $merchantCode . $merchantRef . $nominal, $privateKey)
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

        $iniRefrensi = json_decode($response, true);
        $kodeRefrensi = $iniRefrensi['data']['reference'];

        $err = curl_error($curl);
        curl_close($curl);

        $link = 'https://tripay.co.id/checkout/' . $kodeRefrensi;
        echo "<script>window.location='" . $link . "'; </script>";
    }

    public function confirmPayment()
    {
        $config['upload_path']          = './assets/images/confirm';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 2048; // 2 Mb
        $config['file_name']             = 'confirm-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $this->load->library('upload', $config);
        $post = $this->input->post(null, TRUE);
        if (@FILES['picture']['name'] != null) {
            if ($this->upload->do_upload('picture')) {
                $post['picture'] =  $this->upload->data('file_name');
                $this->bill_m->confirmPayment($post);
                $bot = $this->db->get('bot_telegram')->row_array();
                $tokens = $bot['token']; // token bot
                $owner = $bot['id_telegram_owner'];

                $sendmessage = [
                    'reply_markup' => json_encode([
                        'inline_keyboard' => [
                            [
                                ['text' => '✅ Konfirmasi', 'url' => site_url('confirmdetail/' . $post['no_invoice'])],

                            ]
                        ]
                    ]),
                    'resize_keyboard' => true,
                    'parse_mode' => 'html',
                    'text' => "<b>KONFIRMASI PEMBAYARAN</b>\nNama : $post[name]\nNo Layanan : $post[no_services]\nTagihan : Rp. $post[nominal]\nPeriode : $post[periode]\nTanggal Bayar : $post[date_payment]\nMetode : $post[metode_payment]\n",
                    'chat_id' => $owner
                ];

                file_get_contents("https://api.telegram.org/bot$tokens/sendMessage?" . http_build_query($sendmessage));
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', 'Konfirmasi pembayaran sudah terkirim, mohon tunggu untuk di verifikasi');
                }

                $mypayment = $this->db->get('payment')->row_array();
                $apiKey = 'DEV-' . $mypayment['apikey_pay'];
                $myapiKey = $mypayment['apikey_pay'];
                $privateKey = $mypayment['private_key'];
                $merchantCode = $mypayment['merchant_id'];
                $urlPayment = $mypayment['url_payment'];
                $urlCallback = $mypayment['url_callback'];
                $expiredDay = $mypayment['expired_day'];
                $admin_cost = $mypayment['admin_cost'];

                $no_invoice = $post['no_invoice'];
                $methodPayment = $post['metode_payment'];
                $customerName = $post['name'];
                $nominal = $post['nominal'] + $admin_cost;
                $mynominal = $post['nominal'];
                $no_services = $post['no_services'];

                $myinvoice = $this->db->get_where('invoice', array('invoice' => $no_invoice))->row_array();
                $totalAmount = $myinvoice['amount'] +  $admin_cost;

                $mycustomer = $this->db->get_where('customer', array('no_services' => $no_services))->row_array();
                $customerEmail = $mycustomer['email'];
                $customerDate = $mycustomer['due_date'];
                $customerPhone = $mycustomer['no_wa'];
                $customerNik = $mycustomer['no_ktp'];
                $coverage_id = $mycustomer['coverage'];

                $mydetail = $this->db->get_where('invoice_detail', array('invoice_id' => $no_invoice))->row_array();
                $p_item_id = $mydetail['item_id'];
                $detailQty = $mydetail['qty'];
                $detailPrice = $mydetail['price'];

                $mypackage = $this->db->get_where('package_item', array('p_item_id' => $p_item_id))->row_array();
                $productName = $mypackage['name'];
                $productPrice = $mypackage['price'] + $admin_cost;
                $productPaket = $mypackage['paket_wifi'];

                $mycoverage = $this->db->get_where('coverage', array('coverage_id' => $coverage_id))->row_array();
                $resellerName = $mycoverage['comment'];
                $resellerAddress = $mycoverage['address'];
                $resellerKode = $mycoverage['c_name'];

                $merchantRef = 'NID-' . date('ymdHis');

                $myChannel = $this->db->get_where('channel', array('kode_channel' => $methodPayment))->num_rows();

                if ($myChannel == 1) {
                    $data = [
                        'method'            => $methodPayment,
                        'merchant_ref'      => $merchantRef,
                        'amount'            => $totalAmount,
                        'customer_name'     => $customerName,
                        'customer_email'    => $customerEmail,
                        'customer_phone'    => $customerPhone,
                        'order_items'       => [
                            [
                                'sku'           => $productPaket,
                                'name'          => $productName,
                                'price'         => $totalAmount,
                                'quantity'      => $detailQty
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

                    $iniRefrensi = json_decode($response, true);
                    $kodeRefrensi = $iniRefrensi['data']['reference'];

                    $err = curl_error($curl);
                    curl_close($curl);

                    $link = 'https://tripay.co.id/checkout/' . $kodeRefrensi;
                    $this->db->set('metode_payment', $methodPayment);
                    $this->db->set('merchant_ref', $merchantRef);
                    $this->db->set('reference_code', $kodeRefrensi);
                    $this->db->where('invoice', $no_invoice);
                    $this->db->update('invoice');

                    echo "<script>window.location='" . $link . "'; </script>";
                } elseif ($methodPayment == 'Bayar Tunai ke Reseller') {
                    $myCompany = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
                    $myDue = $myCompany['due_date'];

                    if ($customerDate == 0) {
                        $TanggalJatuhTemponya = $myDue;
                    } else {
                        $TanggalJatuhTemponya = $customerDate;
                    }

                    $tgl1 = date('Y-m-d');
                    $tgl2 = date('d', strtotime('+1 days', strtotime($tgl1)));
                    $paytime = $tgl2 . ' ' . indo_month(date('m')) . ' ' . date('Y') . ' - ' . date('H:i') . ' WIB';
                    $jatuhtempo = $TanggalJatuhTemponya . ' ' . indo_month(date('m')) . ' ' . date('Y');
                    $periode = indo_month(date('m')) . ' ' . date('Y');
                    $data['title'] = '@Boss.Net - Payment Gateway || ' . $no_services;
                    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
                    $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
                    $data['customer'] = $this->customer_m->getNSCustomer($no_services)->row_array();
                    $data['bill'] = $this->bill_m->getDebt($no_services)->num_rows();
                    $data['other'] = $this->db->get('other')->row_array();
                    $data['bank'] = $this->setting_m->getBank()->result();
                    $data['nominal'] = $mynominal;
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
                    $data['resellerName'] = $resellerName;
                    $data['resellerAddress'] = $resellerAddress;
                    $data['resellerKode'] = $resellerKode;

                    $this->db->set('metode_payment', $methodPayment);
                    $this->db->set('merchant_ref', $merchantRef);
                    $this->db->set('reference_code', $kodeRefrensi);
                    $this->db->where('invoice', $no_invoice);
                    $this->db->update('invoice');

                    $this->load->view('member/pembayaran', $data);
                } else {
                    $myCompany = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
                    $myDue = $myCompany['due_date'];

                    if ($customerDate == 0) {
                        $TanggalJatuhTemponya = $myDue;
                    } else {
                        $TanggalJatuhTemponya = $customerDate;
                    }

                    $tgl1 = date('Y-m-d');
                    $tgl2 = date('d', strtotime('+1 days', strtotime($tgl1)));
                    $paytime = $tgl2 . ' ' . indo_month(date('m')) . ' ' . date('Y') . ' - ' . date('H:i') . ' WIB';
                    $jatuhtempo = $TanggalJatuhTemponya . ' ' . indo_month(date('m')) . ' ' . date('Y');
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

                    $myBank = $this->db->get_where('bank', array('name' => $methodPayment))->row_array();
                    $bankNoRek = $myBank['no_rek'];
                    $bankOwner = $myBank['owner'];

                    $data['bankNoRek'] = $bankNoRek;
                    $data['bankOwner'] = $bankOwner;
                    $data['resellerName'] = $resellerName;
                    $data['resellerAddress'] = $resellerAddress;
                    $data['resellerKode'] = $resellerKode;

                    $this->db->set('metode_payment', $methodPayment);
                    $this->db->set('merchant_ref', $merchantRef);
                    $this->db->set('reference_code', $kodeRefrensi);
                    $this->db->where('invoice', $no_invoice);
                    $this->db->update('invoice');

                    $this->load->view('member/pembayaran', $data);
                }
            } else {
                $post['picture'] = 'tripay.png';
                $this->bill_m->confirmPayment($post);
                $bot = $this->db->get('bot_telegram')->row_array();
                $tokens = $bot['token']; // token bot
                $owner = $bot['id_telegram_owner'];

                $sendmessage = [
                    'reply_markup' => json_encode([
                        'inline_keyboard' => [
                            [
                                ['text' => '✅ Konfirmasi', 'url' => site_url('confirmdetail/' . $post['no_invoice'])],

                            ]
                        ]
                    ]),
                    'resize_keyboard' => true,
                    'parse_mode' => 'html',
                    'text' => "<b>KONFIRMASI PEMBAYARAN</b>\nNama : $post[name]\nNo Layanan : $post[no_services]\nTagihan : Rp. $post[nominal]\nPeriode : $post[periode]\nTanggal Bayar : $post[date_payment]\nMetode : $post[metode_payment]\n",
                    'chat_id' => $owner
                ];

                file_get_contents("https://api.telegram.org/bot$tokens/sendMessage?" . http_build_query($sendmessage));
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', 'Konfirmasi pembayaran sudah terkirim, mohon tunggu untuk di verifikasi');
                }

                $mypayment = $this->db->get('payment')->row_array();
                $apiKey = 'DEV-' . $mypayment['apikey_pay'];
                $myapiKey = $mypayment['apikey_pay'];
                $privateKey = $mypayment['private_key'];
                $merchantCode = $mypayment['merchant_id'];
                $urlPayment = $mypayment['url_payment'];
                $urlCallback = $mypayment['url_callback'];
                $expiredDay = $mypayment['expired_day'];
                $admin_cost = $mypayment['admin_cost'];

                $no_invoice = $post['no_invoice'];
                $methodPayment = $post['metode_payment'];
                $customerName = $post['name'];
                $nominal = $post['nominal'] + $admin_cost;
                $mynominal = $post['nominal'];
                $no_services = $post['no_services'];

                $myinvoice = $this->db->get_where('invoice', array('invoice' => $no_invoice))->row_array();
                $totalAmount = $myinvoice['amount'] +  $admin_cost;

                $mycustomer = $this->db->get_where('customer', array('no_services' => $no_services))->row_array();
                $customerEmail = $mycustomer['email'];
                $customerDate = $mycustomer['due_date'];
                $customerPhone = $mycustomer['no_wa'];
                $customerNik = $mycustomer['no_ktp'];
                $coverage_id = $mycustomer['coverage'];

                $mydetail = $this->db->get_where('invoice_detail', array('invoice_id' => $no_invoice))->row_array();
                $p_item_id = $mydetail['item_id'];
                $detailQty = $mydetail['qty'];
                $detailPrice = $mydetail['price'];

                $mypackage = $this->db->get_where('package_item', array('p_item_id' => $p_item_id))->row_array();
                $productName = $mypackage['name'];
                $productPrice = $mypackage['price'] + $admin_cost;
                $productPaket = $mypackage['paket_wifi'];

                $mycoverage = $this->db->get_where('coverage', array('coverage_id' => $coverage_id))->row_array();
                $resellerName = $mycoverage['comment'];
                $resellerAddress = $mycoverage['address'];
                $resellerKode = $mycoverage['c_name'];

                $merchantRef = 'NID-' . date('ymdHis');

                $myChannel = $this->db->get_where('channel', array('kode_channel' => $methodPayment))->num_rows();

                if ($myChannel == 1) {
                    $data = [
                        'method'            => $methodPayment,
                        'merchant_ref'      => $merchantRef,
                        'amount'            => $totalAmount,
                        'customer_name'     => $customerName,
                        'customer_email'    => $customerEmail,
                        'customer_phone'    => $customerPhone,
                        'order_items'       => [
                            [
                                'sku'           => $productPaket,
                                'name'          => $productName,
                                'price'         => $totalAmount,
                                'quantity'      => $detailQty
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

                    $iniRefrensi = json_decode($response, true);
                    $kodeRefrensi = $iniRefrensi['data']['reference'];

                    $err = curl_error($curl);
                    curl_close($curl);

                    $link = 'https://tripay.co.id/checkout/' . $kodeRefrensi;
                    $this->db->set('metode_payment', $methodPayment);
                    $this->db->set('merchant_ref', $merchantRef);
                    $this->db->set('reference_code', $kodeRefrensi);
                    $this->db->where('invoice', $no_invoice);
                    $this->db->update('invoice');

                    echo "<script>window.location='" . $link . "'; </script>";
                } elseif ($methodPayment == 'Bayar Tunai ke Reseller') {
                    $myCompany = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
                    $myDue = $myCompany['due_date'];

                    if ($customerDate == 0) {
                        $TanggalJatuhTemponya = $myDue;
                    } else {
                        $TanggalJatuhTemponya = $customerDate;
                    }

                    $tgl1 = date('Y-m-d');
                    $tgl2 = date('d', strtotime('+1 days', strtotime($tgl1)));
                    $paytime = $tgl2 . ' ' . indo_month(date('m')) . ' ' . date('Y') . ' - ' . date('H:i') . ' WIB';
                    $jatuhtempo = $TanggalJatuhTemponya . ' ' . indo_month(date('m')) . ' ' . date('Y');
                    $periode = indo_month(date('m')) . ' ' . date('Y');
                    $data['title'] = '@Boss.Net - Payment Gateway || ' . $no_services;
                    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
                    $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
                    $data['customer'] = $this->customer_m->getNSCustomer($no_services)->row_array();
                    $data['bill'] = $this->bill_m->getDebt($no_services)->num_rows();
                    $data['other'] = $this->db->get('other')->row_array();
                    $data['bank'] = $this->setting_m->getBank()->result();
                    $data['nominal'] = $mynominal;
                    $data['customerName'] = $customerName;
                    $data['customerEmail'] = $customerEmail;
                    $data['customerPhone'] = $customerPhone;
                    $data['productName'] = $productName;
                    $data['no_invoice'] = $no_invoice;
                    $data['paytime'] = $paytime;
                    $data['jatuhtempo'] = $jatuhtempo;
                    $data['periode'] = $periode;
                    $data['no_services'] = $no_services;
                    $data['mypayment'] = $this->db->get('payment')->row_array();
                    $data['methodPayment'] = $methodPayment;
                    $data['resellerName'] = $resellerName;
                    $data['resellerAddress'] = $resellerAddress;
                    $data['resellerKode'] = $resellerKode;

                    $this->db->set('metode_payment', $methodPayment);
                    $this->db->set('merchant_ref', $merchantRef);
                    $this->db->set('reference_code', $kodeRefrensi);
                    $this->db->where('invoice', $no_invoice);
                    $this->db->update('invoice');

                    $this->load->view('member/pembayaran', $data);
                } else {
                    $myCompany = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
                    $myDue = $myCompany['due_date'];

                    if ($customerDate == 0) {
                        $TanggalJatuhTemponya = $myDue;
                    } else {
                        $TanggalJatuhTemponya = $customerDate;
                    }

                    $tgl1 = date('Y-m-d');
                    $tgl2 = date('d', strtotime('+1 days', strtotime($tgl1)));
                    $paytime = $tgl2 . ' ' . indo_month(date('m')) . ' ' . date('Y') . ' - ' . date('H:i') . ' WIB';
                    $jatuhtempo = $TanggalJatuhTemponya . ' ' . indo_month(date('m')) . ' ' . date('Y');
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
                    $data['mypayment'] = $this->db->get('payment')->row_array();

                    $myBank = $this->db->get_where('bank', array('name' => $methodPayment))->row_array();
                    $bankNoRek = $myBank['no_rek'];
                    $bankOwner = $myBank['owner'];

                    $data['bankNoRek'] = $bankNoRek;
                    $data['bankOwner'] = $bankOwner;
                    $data['resellerName'] = $resellerName;
                    $data['resellerAddress'] = $resellerAddress;
                    $data['resellerKode'] = $resellerKode;

                    $this->db->set('metode_payment', $methodPayment);
                    $this->db->set('merchant_ref', $merchantRef);
                    $this->db->set('reference_code', $kodeRefrensi);
                    $this->db->where('invoice', $no_invoice);
                    $this->db->update('invoice');

                    $this->load->view('member/pembayaran', $data);
                }
            }
        }
    }

    public function confirm()
    {
        $data['title'] = 'Konfirmasi Pembayaran';
        $data['confirm'] = $this->bill_m->getConfirm()->result();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/bill/confirm', $data);
    }

    public function confirmdetail($invoice)
    {
        $data['title'] = 'Detail Konfirmasi Pembayaran';
        $cekInvoice = $this->db->get_where('invoice', ['invoice' => $invoice])->row_array();
        if ($cekInvoice != null) {
            $data['invoice'] = $this->bill_m->getEditInvoice($invoice);
            $data['p_item'] = $this->package_m->getPItem()->result();
            $data['bill'] = $this->bill_m->getBill($invoice)->row_array();
            $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
            $data['other'] = $this->db->get('other')->row_array();
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
            $MyThemes = $MyCompanyData['tm_backend'];
            $this->template->load($MyThemes, 'backend/bill/confirm-detail', $data);
        } else {
            $this->session->set_flashdata('error', 'Invoice tidak ditemukan');
            echo "<script>window.location='" . site_url('confirm') . "'; </script>";
        }
    }
    public function confirmUpdate()
    {
        $post = $this->input->post(null, TRUE);
        $invoice = $this->input->post('invoice');
        $cekConfirm = $this->db->get_where('confirm_payment', ['invoice_id' => $invoice])->row_array();
        if ($cekConfirm > 0) {
            $this->bill_m->UpdateConfirmPayment($post);
        }

        $this->bill_m->payment($post);
        $this->bill_m->UpdateConfirm($post);
        $this->income_m->addPayment($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success-payment', '<h3>Pembayaran berhasil diverifikasi</h3> <a class="btn btn-success" target="blank" href="' . site_url('bill/printinvoice/' . $invoice) . '">Cetak A4</a>&nbsp; <a class="btn btn-success" target="blank" href="' . site_url('bill/printinvoicethermal/' . $invoice) . '">Cetak Thermal</a>');
        }
        echo "<script>window.location='" . site_url('confirm') . "'; </script>";
    }
    public function deleteconfirm()
    {
        $confirm_id = $this->input->post('confirm_id');
        $confirm = $this->db->get_where('confirm_payment', ['confirm_id' => $confirm_id])->row_array();
        $target_file = './assets/images/confirm/' . $confirm['picture'];
        $this->bill_m->deleteconfirm($confirm_id);
        unlink($target_file);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data konfirmasi berhasil dihapus');
        }
        redirect('confirm');
    }
    public function removeconfirm($confirm_id)
    {
        $confirm = $this->db->get_where('confirm_payment', ['confirm_id' => $confirm_id])->row_array();
        $target_file = './assets/images/confirm/' . $confirm['picture'];
        $this->bill_m->deleteconfirm($confirm_id);
        unlink($target_file);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data konfirmasi berhasil dihapus');
        }
        redirect('confirm');
    }

    // SMS GATEWAY
    // public function sendsms()
    // {
    //     $sg = $this->db->get('sms_gateway')->row_array();
    //     $user = $sg['sms_user'];
    //     $password =  $sg['sms_password'];
    //     $mobile = $this->input->post('mobile');
    //     $message = $this->input->post('message');

    //     $url = 'https://soufasms.com/sms_gateway/?user=' . $user . '&pass=' . $password . 'no=' . $mobile . '&msg=' . $message . '';

    //     $header = array(
    //         'Accept: application/json',
    //     );

    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL, $url);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //     curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    //     $result = curl_exec($ch);
    //     $hasil =  json_decode($result, true);
    //     if ($hasil['status'] == 200) {
    //         $this->session->set_flashdata('success-sendsms', $hasil['status_message']);
    //     } else {
    //         $this->session->set_flashdata('error-sendsms', $hasil['status_message']);
    //     }
    //     redirect('bill');
    // }
}
