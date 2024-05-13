<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('user_m');
        $this->load->model('Absensi_model');
        $this->load->model('Auth_model');
    }

    public function index()
    {
        $data['title'] = 'Absensi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['row'] = $this->user_m->get()->result();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['users'] = $this->db->get('user')->result_array();
        if ((isset($_POST['bulan']) && $_POST['bulan'] != null) && (isset($_POST['tahun']) && $_POST['tahun'] != null)) {
            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');
            $bulanTahun = $bulan . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulanTahun = $bulan . $tahun;
        }

        $data['InputKaryawan'] = $this->Absensi_model->InputKaryawan();
        $data['absensi'] = $this->Absensi_model->joinAbsensi($bulanTahun);
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/absensi/index', $data);
    }

    public function kehadiran()
    {
        $data['title'] = 'Kehadiran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['row'] = $this->user_m->get()->result();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['users'] = $this->db->get('user')->result_array();
        if ((isset($_POST['bulan']) && $_POST['bulan'] != null) && (isset($_POST['tahun']) && $_POST['tahun'] != null)) {
            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');
            $bulanTahun = $bulan . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulanTahun = $bulan . $tahun;
        }

        $data['InputKaryawan'] = $this->Absensi_model->InputKaryawan();
        $data['absensi'] = $this->Absensi_model->joinPegawaiJabatan($bulanTahun);
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/absensi/kehadiran', $data);
    }

    public function input_kehadiran()
    {
        $data['title'] = 'Tambah Kehadiran'; // Judul link
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $id_karyawan = $this->input->post('id_karyawan');
        $id_jabatan = $this->input->post('id_jabatan');

        $karyawan = $this->db->get_where('karyawan', array('id_karyawan' => $id_karyawan))->row_array();
        $id_user = $karyawan['id_user'];
        $user = $this->db->get_where('user', array('id' => $id_user))->row_array();
        $jabatan = $this->db->get_where('jabatan', array('id_jabatan' => $id_jabatan))->row_array();

        $bulan_gaji = $this->input->post('bulan_gaji');
        $tahun_gaji = $this->input->post('tahun_gaji');
        $penggajian = $bulan_gaji . $tahun_gaji;
        $gaji_pokok = $jabatan['gaji_pokok'];
        $bonus_trans = $jabatan['tj_transport'];
        $bonus_makan = $jabatan['uang_makan'];
        $jumlah_hadir = $this->input->post('jumlah_hadir');
        $jumlah_sakit = $this->input->post('jumlah_sakit');
        $jumlah_izin = $this->input->post('jumlah_izin');
        $jumlah_alpa = $this->input->post('jumlah_alpa');
        $jumlah_lembur = $this->input->post('jumlah_lembur');

        $jumlah_sakit = $this->input->post('jumlah_sakit');
        $jumlah_izin = $this->input->post('jumlah_izin');
        $jumlah_alpa = $this->input->post('jumlah_alpa');
        $jumlah_hadir = $this->input->post('jumlah_hadir');
        $jumlah_lambat = $this->input->post('jumlah_lambat');
        $jumlah_lembur = $this->input->post('jumlah_lembur');
        $nominal_lembur = $this->input->post('nominal_lembur');
        $gaji_lembur = $jumlah_lembur * $nominal_lembur;
        $uang_bpjs = $this->input->post('uang_bpjs');
        $uang_thr = $this->input->post('uang_thr');
        $kehadiran = $this->input->post('kehadiran');
        $kedisiplinan = $this->input->post('kedisiplinan');
        $hutang = $this->input->post('hutang');
        $cat_absen = $this->input->post('cat_absen');

        $tj_transport = ($bonus_trans / 30) * $jumlah_hadir;
        $uang_makan = ($bonus_makan / 30) * $jumlah_hadir;

        $gaji_hadir = ($gaji_pokok / 30);
        $gaji_sakit = ($gaji_hadir / 2);
        $gaji_izin = ($gaji_hadir / 4);
        $gaji_alpa = ($gaji_pokok / 15);
        $gaji_lambat = ($gaji_hadir / 8);
        $total_hadir = $gaji_hadir * $jumlah_hadir;
        $total_sakit = $gaji_sakit * $jumlah_sakit;
        $total_izin = $gaji_izin * $jumlah_izin;
        $total_alpa = $gaji_alpa * $jumlah_alpa;
        $total_lambat = $gaji_lambat * $jumlah_lambat;

        $penerimaan = $total_hadir + $total_sakit + $total_izin + $gaji_lembur + $uang_makan + $uang_bpjs + $tj_transport + $uang_thr + $kehadiran + $kedisiplinan;
        $potongan = $total_alpa + $total_lambat + $hutang;
        $gaji_diterima = $penerimaan - $potongan;
        $status_gaji = 'tergantung';
        $tgl_transaksi = date('Y-m-d H:i:s');

        $array = [
            'bulan' => $penggajian,
            'id_karyawan' => $id_karyawan,
            'id_jabatan' => $id_jabatan,
            'sakit' => $jumlah_sakit,
            'izin' => $jumlah_izin,
            'alpa' => $jumlah_alpa,
            'hadir' => $jumlah_hadir,
            'lambat' => $jumlah_lambat,
            'lembur' => $jumlah_lembur,
            'nom_lembur' => $nominal_lembur,
            'bpjs' => $uang_bpjs,
            'thr' => $uang_thr,
            'rajin' => $kehadiran,
            'disiplin' => $kedisiplinan,
            'hutang' => $hutang,
            'total' => $gaji_diterima,
            'cat_absen' => $cat_absen,
            'status_gaji' => $status_gaji,
            'tgl_transaksi' => $tgl_transaksi,
        ];

        $this->db->insert('kehadiran', $array);

        $this->session->set_flashdata('success', 'Data Kehadiran berhasil Ditambah');
        redirect('absensi/kehadiran');
    }

    public function ubahkehadiran($id)
    {
        $data['title'] = 'Edit Karyawan'; // Judul link
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['kehadiran'] = $this->db->get('kehadiran')->row_array();

        $id_karyawan = $this->input->post('id_karyawan');
        $id_jabatan = $this->input->post('id_jabatan');

        $karyawan = $this->db->get_where('karyawan', array('id_karyawan' => $id_karyawan))->row_array();
        $id_user = $karyawan['id_user'];
        $user = $this->db->get_where('user', array('id' => $id_user))->row_array();
        $jabatan = $this->db->get_where('jabatan', array('id_jabatan' => $id_jabatan))->row_array();

        $bulan_gaji = $this->input->post('bulan_gaji');
        $tahun_gaji = $this->input->post('tahun_gaji');
        $penggajian = $bulan_gaji . $tahun_gaji;
        $gaji_pokok = $jabatan['gaji_pokok'];
        $bonus_trans = $jabatan['tj_transport'];
        $bonus_makan = $jabatan['uang_makan'];
        $jumlah_hadir = $this->input->post('jumlah_hadir');
        $jumlah_sakit = $this->input->post('jumlah_sakit');
        $jumlah_izin = $this->input->post('jumlah_izin');
        $jumlah_alpa = $this->input->post('jumlah_alpa');
        $jumlah_lembur = $this->input->post('jumlah_lembur');

        $jumlah_sakit = $this->input->post('jumlah_sakit');
        $jumlah_izin = $this->input->post('jumlah_izin');
        $jumlah_alpa = $this->input->post('jumlah_alpa');
        $jumlah_hadir = $this->input->post('jumlah_hadir');
        $jumlah_lambat = $this->input->post('jumlah_lambat');
        $jumlah_lembur = $this->input->post('jumlah_lembur');
        $nominal_lembur = $this->input->post('nominal_lembur');
        $gaji_lembur = $jumlah_lembur * $nominal_lembur;
        $uang_bpjs = $this->input->post('uang_bpjs');
        $uang_thr = $this->input->post('uang_thr');
        $kehadiran = $this->input->post('kehadiran');
        $kedisiplinan = $this->input->post('kedisiplinan');
        $hutang = $this->input->post('hutang');
        $cat_absen = $this->input->post('cat_absen');

        $tj_transport = ($bonus_trans / 30) * $jumlah_hadir;
        $uang_makan = ($bonus_makan / 30) * $jumlah_hadir;

        $gaji_hadir = ($gaji_pokok / 30);
        $gaji_sakit = ($gaji_hadir / 2);
        $gaji_izin = ($gaji_hadir / 4);
        $gaji_alpa = ($gaji_pokok / 15);
        $gaji_lambat = ($gaji_hadir / 8);
        $total_hadir = $gaji_hadir * $jumlah_hadir;
        $total_sakit = $gaji_sakit * $jumlah_sakit;
        $total_izin = $gaji_izin * $jumlah_izin;
        $total_alpa = $gaji_alpa * $jumlah_alpa;
        $total_lambat = $gaji_lambat * $jumlah_lambat;

        $penerimaan = $total_hadir + $total_sakit + $total_izin + $gaji_lembur + $uang_makan + $uang_bpjs + $tj_transport + $uang_thr + $kehadiran + $kedisiplinan;
        $potongan = $total_alpa + $total_lambat + $hutang;
        $gaji_diterima = $penerimaan - $potongan;
        $status_gaji = 'terhutang';
        $tgl_transaksi = date('Y-m-d H:i:s');

        $this->db->set('sakit', $jumlah_sakit);
        $this->db->set('izin', $jumlah_izin);
        $this->db->set('alpa', $jumlah_alpa);
        $this->db->set('hadir', $jumlah_hadir);
        $this->db->set('lambat', $jumlah_lambat);
        $this->db->set('lembur', $jumlah_lembur);
        $this->db->set('nom_lembur', $nominal_lembur);
        $this->db->set('bpjs', $uang_bpjs);
        $this->db->set('thr', $uang_thr);
        $this->db->set('rajin', $kehadiran);
        $this->db->set('disiplin', $kedisiplinan);
        $this->db->set('hutang', $hutang);
        $this->db->set('total', $gaji_diterima);
        $this->db->set('cat_absen', $cat_absen);
        $this->db->set('status_gaji', $status_gaji);
        $this->db->set('tgl_transaksi', $tgl_transaksi);
        $this->db->where('id_kehadiran', $id);
        $this->db->update('kehadiran');

        $this->session->set_flashdata('success', 'Data Kehadiran berhasil Diubah');
        redirect('absensi/kehadiran');
    }

    public function hapuskehadiran($id)
    {
        $result = $this->db->get_where('kehadiran', ['id_kehadiran' => $id])->row_array();
        $this->db->where('id_kehadiran', $id);
        $this->db->delete('kehadiran');

        $this->session->set_flashdata('success', 'Data Kehadiran berhasil Dihapus');
        redirect('absensi/kehadiran');
    }

    public function penggajian()
    {
        $data['title'] = 'Penggajian';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['row'] = $this->user_m->get()->result();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['users'] = $this->db->get('user')->result_array();
        if ((isset($_POST['bulan']) && $_POST['bulan'] != null) && (isset($_POST['tahun']) && $_POST['tahun'] != null)) {
            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');
            $bulanTahun = $bulan . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulanTahun = $bulan . $tahun;
        }

        $data['InputKaryawan'] = $this->Absensi_model->InputKaryawan();
        $data['absensi'] = $this->Absensi_model->joinPegawaiJabatan($bulanTahun);
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/absensi/penggajian', $data);
    }

    public function cetakslipgaji($id)
    {
        $data['title'] = 'Cetak Slip Gaji';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['row'] = $this->user_m->get()->result();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['users'] = $this->db->get('user')->result_array();
        $data['id'] = $id;

        $kehadiran = $this->db->get_where('kehadiran', array('id_kehadiran' => $$id))->row_array();
        $id_user = $karyawan['id_user'];
        $jabatan = $this->db->get_where('jabatan', array('id_jabatan' => $id_jabatan))->row_array();

        $id_karyawan =  $kehadiran['id_karyawan'];
        $bulan =  $kehadiran['bulan'];
        $karyawan = $this->db->get_where('karyawan', array('id_karyawan' => $id_karyawan))->row_array();
        $kode = $karyawan['kode'];

        $this->load->library('ciqrcode'); //pemanggilan library QR CODE

        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/images/qrcode/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/images/qrcode/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/images/qrcode/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name = $kode . '_' . $bulan . '.png'; //buat name dari qr code sesuai dengan nim

        $params['data'] = base_url('absensi/cetakslipgaji/' . $id); //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
        $this->load->view('backend/absensi/slip_gaji', $data);
    }

    public function tahan($id)
    {
        $data['title'] = 'Edit Karyawan'; // Judul link
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['kehadiran'] = $this->db->get('kehadiran')->row_array();

        $status_gaji = 'terhutang';
        $tgl_transaksi = date('Y-m-d H:i:s');

        $this->db->set('status_gaji', $status_gaji);
        $this->db->set('tgl_transaksi', $tgl_transaksi);
        $this->db->where('id_kehadiran', $id);
        $this->db->update('kehadiran');

        $this->session->set_flashdata('success', 'Data Kehadiran berhasil Diubah');
        redirect('absensi/penggajian');
    }

    public function cairkan($id)
    {
        $data['title'] = 'Edit Karyawan'; // Judul link
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['kehadiran'] = $this->db->get('kehadiran')->row_array();

        $id_kehadiran = $id;
        $kehadiran = $this->db->get_where('kehadiran', array('id_kehadiran' => $id_kehadiran))->row_array();
        $id_karyawan = $kehadiran['id_karyawan'];
        $karyawan = $this->db->get_where('karyawan', array('id_karyawan' => $id_karyawan))->row_array();
        $id_jabatan = $kehadiran['id_jabatan'];
        $jabatan = $this->db->get_where('jabatan', array('id_jabatan' => $id_jabatan))->row_array();
        $id_user = $karyawan['id_user'];
        $user = $this->db->get_where('user', array('id' => $id_user))->row_array();

        $nominal = $kehadiran['total'];
        $remark = 'Gaji ' . $user['name'] . ' (' . $jabatan['nama_jabatan'] . ')';
        $status_gaji = 'terbayar';
        $tgl_transaksi = date('Y-m-d H:i:s');
        $date_payment = date('Y-m-d');
        $created = date('myHis');

        $this->db->set('status_gaji', $status_gaji);
        $this->db->set('tgl_transaksi', $tgl_transaksi);
        $this->db->where('id_kehadiran', $id);
        $this->db->update('kehadiran');

        $array = [
            'date_payment' => $date_payment,
            'nominal' => $nominal,
            'remark' => $remark,
            'created' => $created,
        ];

        $this->db->insert('expenditure', $array);
        $this->session->set_flashdata('success', 'Gaji Berhasil berhasil Dicairkan');
        redirect('absensi/penggajian');
    }
}
