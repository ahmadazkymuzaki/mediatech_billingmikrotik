<?php defined('BASEPATH') or exit('No direct script access allowed');

class Keuangan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model(['setting_m', 'income_m', 'router_m', 'expenditure_m', 'bill_m', 'customer_m', 'package_m']);
    }
    public function bonus()
    {
        $data['title'] = 'Bonus Refferal';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['bonus'] = $this->db->get('bonus')->result();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/keuangan/bonus', $data);
    }
    public function tambahbonus()
    {
        $kode_bonus  = $this->input->post('kode_bonus');
        $nilai_bonus = $this->input->post('nilai_bonus');
        $no_services = $this->input->post('no_services');

        $data_customer   = $this->db->get_where('customer', array('no_services' => $no_services))->row_array();
        $jumlah_refferal = $this->db->get_where('customer', array('refferal' => $no_services))->num_rows();
        $total_nominal   = $nilai_bonus * $jumlah_refferal;
        $desc_bonus      = 'Pemberian Bonus Refferal kepada ' . $data_customer['name'] . ' dengan total jumlah Refferal sebanyak ' . $jumlah_refferal . ' Orang';

        $array = [
            'kode_bonus' => $kode_bonus,
            'desc_bonus' => $desc_bonus,
            'nilai_bonus' => $total_nominal,
            'no_services' => $no_services,
            'status_bonus' => 'PENDING',
            'time_bonus' => '-',
        ];
        $this->db->insert('bonus', $array);
        $this->session->set_flashdata('success', 'Sukses Tambah Data Bonus Refferal');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function editbonus()
    {
        $kode_bonus  = $this->input->post('kode_bonus');
        $nilai_bonus = $this->input->post('nilai_bonus');
        $desc_bonus  = $this->input->post('desc_bonus');
        $no_services = $this->input->post('no_services');

        $jumlah_refferal = $this->db->get_where('customer', array('refferal' => $no_services))->num_rows();
        $total_nominal   = $nilai_bonus * $jumlah_refferal;

        $this->db->set('desc_bonus', $desc_bonus);
        $this->db->set('nilai_bonus', $total_nominal);
        $this->db->where('kode_bonus', $kode_bonus);
        $this->db->update('bonus');

        $this->session->set_flashdata('success', 'Sukses Ubah Data Bonus Refferal');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function hapusbonus()
    {
        $id_bonus = $this->input->post('id_bonus');

        $this->db->where('id_bonus', $id_bonus);
        $this->db->delete('bonus');

        $this->session->set_flashdata('success', 'Sukses Hapus Data Bonus Refferal');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function topup()
    {
        $data['title'] = 'Top Up Saldo';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['saldo'] = $this->db->get('saldo')->result();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/keuangan/top-up', $data);
    }
    public function transfer()
    {
        $data['title'] = 'Transfer Saldo';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['transfer'] = $this->db->get('transfer')->result();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/keuangan/transfer', $data);
    }
    public function terimatransfer($id)
    {
        $this->db->set('status_request', 'DITERIMA');
        $this->db->where('id_transfer', $id);
        $this->db->update('transfer');

        $dataTransfer = $this->db->get_where('transfer', array('id_transfer' => $id))->row_array();
        $no_services  = $dataTransfer['nomor_services'];
        $nom_transfer = $dataTransfer['nominal_transfer'];


        $dataUser     = $this->db->get_where('user', array('no_services' => $no_services))->row_array();
        $saldoUser    = $dataUser['saldo'];
        $saldoTotal   = $saldoUser - $nom_transfer;

        $this->db->set('saldo', $saldoTotal);
        $this->db->where('no_services', $no_services);
        $this->db->update('user');

        $this->session->set_flashdata('success', 'Permintaan Transfer Berhasil Diterima');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function tolaktransfer($id)
    {
        $this->db->set('status_request', 'DITOLAK');
        $this->db->where('id_transfer', $id);
        $this->db->update('transfer');

        $this->session->set_flashdata('success', 'Permintaan Transfer Berhasil Ditolak');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function gaji()
    {
        $data['title'] = 'Gaji Karyawan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['gaji'] = $this->db->get('gaji')->result();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/keuangan/gaji', $data);
    }
    public function tambahgaji()
    {
        $bulan_gaji     = $this->input->post('bulan_gaji');
        $tahun_gaji     = $this->input->post('tahun_gaji');
        $no_services    = $this->input->post('no_services');
        $total_gaji     = $this->input->post('total_gaji');
        $bonus_gaji     = $this->input->post('bonus_gaji');
        $masuk_kerja    = $this->input->post('masuk_kerja');
        $absen_lambat   = $this->input->post('absen_lambat');
        $absen_sakit    = $this->input->post('absen_sakit');
        $absen_izin     = $this->input->post('absen_izin');
        $tidak_absen    = $this->input->post('tidak_absen');
        $potongan_gaji  = $this->input->post('potongan_gaji');
        $catatan        = $this->input->post('catatan');
        $diberikan_oleh = $this->input->post('diberikan_oleh');

        $data_karyawan  = $this->db->get_where('user', ['no_services' => $no_services])->row_array();
        $data_kasbon    = $this->db->get_where('kasbon', ['nomor_services' => $no_services, 'status_kasbon' => 'DITERIMA'])->result();
        $total_kasbon   = 0;
        foreach ($data_kasbon as $c => $data) {
            $total_kasbon += $data->nominal_kasbon;
        }

        $nama_karyawan  = $data_karyawan['name'];
        $gaji_diterima  = $total_gaji - $total_kasbon - $potongan_gaji + $bonus_gaji;
        $status_gaji    = 'BELUM DITERIMA';
        $tanggal_gaji   = '-';

        $array = [
            'bulan_gaji'    => $bulan_gaji,
            'tahun_gaji'    => $tahun_gaji,
            'no_services'    => $no_services,
            'nama_karyawan'    => $nama_karyawan,
            'total_gaji'    => $total_gaji,
            'total_kasbon'    => $total_kasbon,
            'bonus_gaji'    => $bonus_gaji,
            'masuk_kerja'    => $masuk_kerja,
            'absen_lambat'    => $absen_lambat,
            'absen_sakit'    => $absen_sakit,
            'absen_izin'    => $absen_izin,
            'tidak_absen'    => $tidak_absen,
            'potongan_gaji'    => $potongan_gaji,
            'gaji_diterima'    => $gaji_diterima,
            'catatan'    => $catatan,
            'status_gaji'    => $status_gaji,
            'diberikan_oleh' => $diberikan_oleh,
            'tanggal_gaji' => $tanggal_gaji,
        ];
        $this->db->insert('gaji', $array);
        $this->session->set_flashdata('success', 'Sukses Tambah Data Gaji Karyawan');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function editgaji()
    {
        $id_gaji = $this->input->post('id_gaji');

        $bulan_gaji     = $this->input->post('bulan_gaji');
        $tahun_gaji     = $this->input->post('tahun_gaji');
        $no_services    = $this->input->post('no_services');
        $total_gaji     = $this->input->post('total_gaji');
        $bonus_gaji     = $this->input->post('bonus_gaji');
        $masuk_kerja    = $this->input->post('masuk_kerja');
        $absen_lambat   = $this->input->post('absen_lambat');
        $absen_sakit    = $this->input->post('absen_sakit');
        $absen_izin     = $this->input->post('absen_izin');
        $tidak_absen    = $this->input->post('tidak_absen');
        $potongan_gaji  = $this->input->post('potongan_gaji');
        $catatan        = $this->input->post('catatan');
        $diberikan_oleh = $this->input->post('diberikan_oleh');

        $data_karyawan  = $this->db->get_where('user', ['no_services' => $no_services])->row_array();
        $data_kasbon    = $this->db->get_where('kasbon', ['nomor_services' => $no_services, 'status_kasbon' => 'DITERIMA'])->result();
        $total_kasbon   = 0;
        foreach ($data_kasbon as $c => $data) {
            $total_kasbon += $data->nominal_kasbon;
        }

        $nama_karyawan  = $data_karyawan['name'];
        $gaji_diterima  = $total_gaji - $total_kasbon - $potongan_gaji + $bonus_gaji;
        $status_gaji    = 'BELUM DITERIMA';
        $tanggal_gaji   = '-';

        $array = [
            'bulan_gaji'    => $bulan_gaji,
            'tahun_gaji'    => $tahun_gaji,
            'total_gaji'    => $total_gaji,
            'total_kasbon'    => $total_kasbon,
            'bonus_gaji'    => $bonus_gaji,
            'masuk_kerja'    => $masuk_kerja,
            'absen_lambat'    => $absen_lambat,
            'absen_sakit'    => $absen_sakit,
            'absen_izin'    => $absen_izin,
            'tidak_absen'    => $tidak_absen,
            'potongan_gaji'    => $potongan_gaji,
            'gaji_diterima'    => $gaji_diterima,
            'catatan'    => $catatan,
            'status_gaji'    => $status_gaji,
            'diberikan_oleh' => $diberikan_oleh,
            'tanggal_gaji' => $tanggal_gaji,
        ];
        $this->db->where('id_gaji', $id_gaji);
        $this->db->update('gaji', $array);
        $this->session->set_flashdata('success', 'Sukses Ubah Data Gaji Karyawan');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function hapusgaji()
    {
        $id_gaji = $this->input->post('id_gaji');

        $this->db->where('id_gaji', $id_gaji);
        $this->db->delete('gaji');

        $this->session->set_flashdata('success', 'Sukses Hapus Data Gaji Karyawan');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function kategori()
    {
        $data['title'] = 'Daftar Kategori';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['kategori'] = $this->db->get('kategori')->result();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/keuangan/kategori', $data);
    }
    public function tambahkategori()
    {
        $name_category = $this->input->post('name_category');
        $desc_category = $this->input->post('desc_category');
        $time_created  = date('d/m/Y H:i:s') . ' WIB';

        $array = [
            'name_category' => $name_category,
            'desc_category' => $desc_category,
            'time_created'  => $time_created,
        ];
        $this->db->insert('kategori', $array);
        $this->session->set_flashdata('success', 'Sukses Tambah Data Kategori Keuanagan');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function editkategori()
    {
        $id_category   = $this->input->post('id_category');
        $name_category = $this->input->post('name_category');
        $desc_category = $this->input->post('desc_category');
        $time_updated  = date('d/m/Y H:i:s') . ' WIB';

        $this->db->set('name_category', $name_category);
        $this->db->set('desc_category', $desc_category);
        $this->db->set('time_updated', $time_updated);
        $this->db->where('id_category', $id_category);
        $this->db->update('kategori');

        $this->session->set_flashdata('success', 'Sukses Ubah Data Kategori Keuanagan');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function hapuskategori()
    {
        $id_category   = $this->input->post('id_category');

        $this->db->where('id_category', $id_category);
        $this->db->delete('kategori');

        $this->session->set_flashdata('success', 'Sukses Hapus Data Kategori Keuanagan');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function transaksi()
    {
        $data['title'] = 'Transaksi Member';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['pemasukan'] = $this->db->get('pemasukan')->result();
        $data['pengeluaran'] = $this->db->get('pengeluaran')->result();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/keuangan/transaksi', $data);
    }
    public function saldo()
    {
        $data['title'] = 'Saldo Member';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['saldo'] = $this->db->get('user')->result();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/keuangan/saldo', $data);
    }
    public function kasbon()
    {
        $data['title'] = 'Pengajuan Kasbon';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['kasbon'] = $this->db->get('kasbon')->result();
        $data['hutang'] = $this->db->get_where('kasbon', array('status_kasbon' => 'DITERIMA'))->result();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/keuangan/kasbon', $data);
    }
    public function terimakasbon($id)
    {
        $this->db->set('status_kasbon', 'DITERIMA');
        $this->db->where('id_kasbon', $id);
        $this->db->update('kasbon');

        $dataKasbon = $this->db->get_where('kasbon', array('id_kasbon' => $id))->row_array();
        $paramgua = [
            'date_payment' => date('Y-m-d'),
            'no_services' => $dataKasbon['nomor_services'],
            'nominal_pemasukan' => $dataKasbon['nominal_kasbon'],
            'ket_pemasukan' => 'Pengajuan Kasbon Diterima',
            'nama_pemasukan' => 'KASBON SALDO',
            'waktu_pemasukan' => $dataKasbon['waktu_kasbon']
        ];
        $this->db->insert('pemasukan', $paramgua);

        $paramku = [
            'date_payment' => date('Y-m-d'),
            'no_services' => $dataKasbon['nomor_services'],
            'nominal' => $dataKasbon['nominal_kasbon'],
            'remark' => 'Pengajuan Kasbon dengan Nomor Layanan ' . $dataKasbon['nomor_services'] . ' a/n ' . $dataKasbon['nama_karyawan'] . ' yang diajukan pada ' . $dataKasbon['waktu_kasbon'],
            'nama_kategori' => 'KASBON KARYAWAN',
            'create_by' => $this->session->userdata('id'),
            'created' => time()
        ];
        $this->db->insert('expenditure', $paramku);

        $dataUser   = $this->db->get_where('user', array('no_services' => $dataKasbon['nomor_services']))->row_array();
        $saldonya   = $dataUser['saldo'];
        $totalsaldo = $saldonya + $dataKasbon['nominal_kasbon'];

        $whatsapp       = $this->db->get('whatsapp')->row_array();
        $nomor_pengirim = $whatsapp['number'];
        $nomor_penerima = $dataUser['phone'];
        $api_key_wa     = $whatsapp['api_key'];
        $link_url_wa    = $whatsapp['link_url'];
        $link_url_web   = $whatsapp['url_web'];

        $pesan_whatsapp = '*PENGAJUAN KASBON SALDO*
Nominal : Rp. ' . indo_currency($dataKasbon['nominal_kasbon']) . '
a/n : ' . $dataKasbon['nama_karyawan'] . '
Status : ' . $dataKasbon['status_kasbon'] . '
Pada : ' . $dataKasbon['waktu_kasbon'];

        $dataWhatsapp = [
            'api_key' => $api_key_wa,
            'sender' => $nomor_pengirim,
            'number' => $nomor_penerima,
            'message' => $pesan_whatsapp,
        ];

        $curlme = curl_init();
        curl_setopt_array($curlme, array(
            CURLOPT_URL => $link_url_wa,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($dataWhatsapp),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response  = curl_exec($curlme);
        $err = curl_error($curlme);
        curl_close($curlme);

        $this->db->set('saldo', $totalsaldo);
        $this->db->where('no_services', $dataKasbon['nomor_services']);
        $this->db->update('user');

        $this->session->set_flashdata('success', 'Pengajuan Kasbon berhasil Diterima');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function tolakkasbon($id)
    {
        $this->db->set('status_kasbon', 'DITOLAK');
        $this->db->where('id_kasbon', $id);
        $this->db->update('kasbon');

        $dataKasbon     = $this->db->get_where('kasbon', array('id_kasbon' => $id))->row_array();
        $whatsapp       = $this->db->get('whatsapp')->row_array();
        $dataUser       = $this->db->get_where('user', array('no_services' => $dataKasbon['nomor_services']))->row_array();
        $nomor_pengirim = $whatsapp['number'];
        $nomor_penerima = $dataUser['phone'];
        $api_key_wa     = $whatsapp['api_key'];
        $link_url_wa    = $whatsapp['link_url'];
        $link_url_web   = $whatsapp['url_web'];

        $pesan_whatsapp = '*PENGAJUAN KASBON SALDO*
Nominal : Rp. ' . indo_currency($dataKasbon['nominal_kasbon']) . '
a/n : ' . $dataKasbon['nama_karyawan'] . '
Status : ' . $dataKasbon['status_kasbon'] . '
Pada : ' . $dataKasbon['waktu_kasbon'];

        $dataWhatsapp = [
            'api_key' => $api_key_wa,
            'sender' => $nomor_pengirim,
            'number' => $nomor_penerima,
            'message' => $pesan_whatsapp,
        ];

        $curlme = curl_init();
        curl_setopt_array($curlme, array(
            CURLOPT_URL => $link_url_wa,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($dataWhatsapp),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response  = curl_exec($curlme);
        $err = curl_error($curlme);
        curl_close($curlme);

        $this->session->set_flashdata('success', 'Pengajuan Kasbon berhasil Ditolak');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function lunasikasbon()
    {
        $this->db->set('status_kasbon', 'SUDAH LUNAS');
        $this->db->where('id_kasbon', $id);
        $this->db->update('kasbon');

        $dataKasbon = $this->db->get_where('kasbon', array('id_kasbon' => $id))->row_array();
        $paramku = [
            'date_payment' => date('Y-m-d'),
            'nominal' => $dataKasbon['nominal_kasbon'],
            'mode_payment' => 'BAYAR MANUAL',
            'create_by' => $this->session->userdata('id'),
            'no_services' => $dataKasbon['nomor_services'],
            'invoice_id' => NULL,
            'remark' => 'Pelunasan Kasbon dengan Nomor Layanan ' . $dataKasbon['nomor_services'] . ' a/n ' . $dataKasbon['nama_karyawan'] . ' yang diajukan pada ' . $dataKasbon['waktu_kasbon'],
            'nama_kategori' => 'KASBON KARYAWAN',
            'created' => time()
        ];
        $this->db->insert('income', $paramku);

        $this->session->set_flashdata('success', 'Pengajuan Kasbon berhasil Dilunasi');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function hapuskasbon($id)
    {
        $this->db->where('id_kasbon', $id);
        $this->db->delete('kasbon');

        $this->session->set_flashdata('success', 'Transaksi Kasbon berhasil Dihapus');
        redirect($_SERVER['HTTP_REFERER']);
    }
}
