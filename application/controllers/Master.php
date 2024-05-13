<?php defined('BASEPATH') or exit('No direct script access allowed');

class Master extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('user_m');
        $this->load->model('Karyawan_model');
        $this->load->model('Auth_model');
    }

    public function karyawan()
    {
        $data['title'] = 'Karyawan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['row'] = $this->user_m->get()->result();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['karyawan'] = $this->Karyawan_model->getAllKaryawan();
        $data['jabatan'] = $this->db->get('jabatan')->result_array();
        $data['users'] = $this->db->get('user')->result_array();
        $this->form_validation->set_rules('kode', 'Kode', 'required|trim|min_length[9]|is_unique[karyawan.kode]');
        $this->form_validation->set_rules('jabatan', 'Nama Jabatan', 'required|trim');
        $this->form_validation->set_rules('tgl_masuk', 'Tanggal Masuk', 'required|trim');
        $this->form_validation->set_rules('rek_bank', 'Rekening', 'required|trim');
        $this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required|trim');
        $this->form_validation->set_rules('an_bank', 'Atas Nama', 'required|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');
        $this->form_validation->set_rules('catatan', 'Catatan', 'required|trim');
        if ($this->form_validation->run() == FALSE) {
            $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
            $MyThemes = $MyCompanyData['tm_backend'];
            $this->template->load($MyThemes, 'backend/master/karyawan', $data);
        } else {
            $this->Karyawan_model->tambahDataPegawai();
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Pegawai <strong>Berhasil Ditambahkan.</strong></div>');
            redirect('master/karyawan');
        }
    }

    public function tambahKaryawan()
    {
        $data['title'] = 'Tambah Karyawan'; // Judul link
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $nama_bank = $this->input->post('nama_bank');

        if ($nama_bank == 'Bank Rakyat Indonesia (BRI)') {
            $kode_bank = '002';
        } elseif ($nama_bank == 'Bank Negara Indonesia (BNI)') {
            $kode_bank = '009';
        } elseif ($nama_bank == 'Bank CIMB Niaga (Swasta)') {
            $kode_bank = '022';
        } elseif ($nama_bank == 'Bank Central Asia (BCA)') {
            $kode_bank = '014';
        } elseif ($nama_bank == 'Bank Mandiri (Persero)') {
            $kode_bank = '008';
        } elseif ($nama_bank == 'Langsung Tunai (cash)') {
            $kode_bank = 'CASH';
        } elseif ($nama_bank == 'Dompet Digital DANA') {
            $kode_bank = 'DANA';
        } elseif ($nama_bank == 'Dompet Digital OVO') {
            $kode_bank = 'OVO';
        } elseif ($nama_bank == 'Dompet Digital Pulsa') {
            $kode_bank = 'PULSA';
        } elseif ($nama_bank == 'Dompet Digital T-Money') {
            $kode_bank = 'T-MNY';
        } elseif ($nama_bank == 'Dompet Digital LinkAja') {
            $kode_bank = 'LAJA';
        } elseif ($nama_bank == 'Dompet Digital GO-Pay') {
            $kode_bank = 'GOPAY';
        } elseif ($nama_bank == 'Dompet Digital DO-KU') {
            $kode_bank = 'DO-KU';
        } elseif ($nama_bank == 'Dompet Digital Shopee-Pay') {
            $kode_bank = 'S-PAY';
        } elseif ($nama_bank == 'Dompet Digital PayPal') {
            $kode_bank = 'PYPL';
        } elseif ($nama_bank == 'Lainnya') {
            $kode_bank = 'Tidak Diketahui';
        } else {
            $kode_bank = 'Kosong';
        }

        $array = [
            'kode' => html_escape($this->input->post('kode', true)),
            'id_jabatan' => html_escape($this->input->post('jabatan', true)),
            'tgl_masuk' => html_escape($this->input->post('tgl_masuk', true)),
            'rek_bank' => html_escape($this->input->post('rek_bank', true)),
            'nama_bank' => $nama_bank,
            'an_bank' => html_escape($this->input->post('an_bank', true)),
            'kode_bank' => $kode_bank,
            'status' => html_escape($this->input->post('status', true)),
            'id_user' => html_escape($this->input->post('user', true)),
            'catatan' => html_escape($this->input->post('catatan', true)),
        ];

        $this->db->insert('karyawan', $array);

        $this->session->set_flashdata('success', 'Data Karyawan berhasil Ditambah');
        redirect('master/karyawan');
    }

    public function ubahKaryawan($id)
    {
        $data['title'] = 'Edit Karyawan'; // Judul link
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['karyawan'] = $this->db->get('karyawan')->row_array();

        $id_jabatan = $this->input->post('id_jabatan');
        $tgl_keluar = $this->input->post('tgl_keluar1');
        $status = $this->input->post('status1');
        $catatan = $this->input->post('catatan1');
        $rek_bank = $this->input->post('rek_bank');
        $nama_bank = $this->input->post('nama_bank');
        $an_bank = $this->input->post('an_bank');

        if ($nama_bank == 'Bank Rakyat Indonesia (BRI)') {
            $kode_bank = '002';
        } elseif ($nama_bank == 'Bank Negara Indonesia (BNI)') {
            $kode_bank = '009';
        } elseif ($nama_bank == 'Bank CIMB Niaga (Swasta)') {
            $kode_bank = '022';
        } elseif ($nama_bank == 'Bank Central Asia (BCA)') {
            $kode_bank = '014';
        } elseif ($nama_bank == 'Bank Mandiri (Persero)') {
            $kode_bank = '008';
        } elseif ($nama_bank == 'Langsung Tunai (cash)') {
            $kode_bank = 'CASH';
        } elseif ($nama_bank == 'Dompet Digital DANA') {
            $kode_bank = 'DANA';
        } elseif ($nama_bank == 'Dompet Digital OVO') {
            $kode_bank = 'OVO';
        } elseif ($nama_bank == 'Dompet Digital Pulsa') {
            $kode_bank = 'PULSA';
        } elseif ($nama_bank == 'Dompet Digital T-Money') {
            $kode_bank = 'T-MNY';
        } elseif ($nama_bank == 'Dompet Digital LinkAja') {
            $kode_bank = 'LAJA';
        } elseif ($nama_bank == 'Dompet Digital GO-Pay') {
            $kode_bank = 'GOPAY';
        } elseif ($nama_bank == 'Dompet Digital DO-KU') {
            $kode_bank = 'DO-KU';
        } elseif ($nama_bank == 'Dompet Digital Shopee-Pay') {
            $kode_bank = 'S-PAY';
        } elseif ($nama_bank == 'Dompet Digital PayPal') {
            $kode_bank = 'PYPL';
        } elseif ($nama_bank == 'Lainnya') {
            $kode_bank = 'Tidak Diketahui';
        } else {
            $kode_bank = 'Kosong';
        }

        $this->db->set('id_jabatan', $id_jabatan);
        $this->db->set('tgl_keluar', $tgl_keluar);
        $this->db->set('rek_bank', $rek_bank);
        $this->db->set('nama_bank', $nama_bank);
        $this->db->set('an_bank', $an_bank);
        $this->db->set('kode_bank', $kode_bank);
        $this->db->set('status', $status);
        $this->db->set('catatan', $catatan);
        $this->db->where('id_karyawan', $id);
        $this->db->update('karyawan');

        $this->session->set_flashdata('success', 'Data Karyawan berhasil Diubah');
        redirect('master/karyawan');
    }

    public function hapuskaryawan($id)
    {
        $result = $this->db->get_where('karyawan', ['id_karyawan' => $id])->row_array();
        $this->db->where('id_karyawan', $id);
        $this->db->delete('karyawan');

        $this->session->set_flashdata('success', 'Data Karyawan berhasil Dihapus');
        redirect('master/karyawan');
    }

    public function jabatan()
    {
        $data['title'] = 'Jabatan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['row'] = $this->user_m->get()->result();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['jabatan'] = $this->Karyawan_model->getAllJAbatan();
        $data['users'] = $this->db->get('user')->result_array();
        $this->form_validation->set_rules('nama_jabatan', 'Nama Jabatan', 'required|trim');
        $this->form_validation->set_rules('gaji_pokok', 'Gaji Pokok', 'required|trim');
        $this->form_validation->set_rules('tj_transport', 'Uang Transport', 'required|trim');
        $this->form_validation->set_rules('uang_makan', 'Uang Makan', 'required|trim');

        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/master/jabatan', $data);
    }

    public function tambahJabatan()
    {
        $data['title'] = 'Tambah Jabatan'; // Judul link
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $array = [
            'nama_jabatan' => html_escape($this->input->post('nama_jabatan', true)),
            'gaji_pokok' => html_escape($this->input->post('gaji_pokok', true)),
            'tj_transport' => html_escape($this->input->post('tj_transport', true)),
            'uang_makan' => html_escape($this->input->post('uang_makan', true)),
        ];

        $this->db->insert('jabatan', $array);

        $this->session->set_flashdata('success', 'Data Jabatan berhasil Ditambah');
        redirect('master/jabatan');
    }

    public function ubahJabatan($id)
    {
        $data['title'] = 'Edit Jabatan'; // Judul link
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['jabatan'] = $this->db->get('jabatan')->row_array();

        $nama_jabatan = $this->input->post('nama_jabatan');
        $gaji_pokok = $this->input->post('gaji_pokok');
        $tj_transport = $this->input->post('tj_transport');
        $uang_makan = $this->input->post('uang_makan');

        $this->db->set('nama_jabatan', $nama_jabatan);
        $this->db->set('gaji_pokok', $gaji_pokok);
        $this->db->set('tj_transport', $tj_transport);
        $this->db->set('uang_makan', $uang_makan);
        $this->db->where('id_jabatan', $id);
        $this->db->update('jabatan');

        $this->session->set_flashdata('success', 'Data Jabatan berhasil Diubah');
        redirect('master/jabatan');
    }

    public function hapusJabatan($id)
    {
        $result = $this->db->get_where('jabatan', ['id_jabatan' => $id])->row_array();
        $this->db->where('id_jabatan', $id);
        $this->db->delete('jabatan');

        $this->session->set_flashdata('success', 'Data Jabatan berhasil Dihapus');
        redirect('master/jabatan');
    }

    public function kategori()
    {
        $data['title'] = 'Kategori';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['row'] = $this->user_m->get()->result();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['kategori'] = $this->Karyawan_model->getAllKategori();
        $data['users'] = $this->db->get('user')->result_array();
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|trim');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim');

        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/master/kategori', $data);
    }

    public function tambahKategori()
    {
        $data['title'] = 'Tambah Kategori'; // Judul link
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $array = [
            'nama_kategori' => html_escape($this->input->post('nama_kategori', true)),
            'deskripsi' => html_escape($this->input->post('deskripsi', true)),
        ];

        $this->db->insert('kategori', $array);

        $this->session->set_flashdata('success', 'Data Kategori berhasil Ditambah');
        redirect('master/kategori');
    }

    public function ubahKategori($id)
    {
        $data['title'] = 'Edit Kategori'; // Judul link
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['kategori'] = $this->db->get('kategori')->row_array();

        $nama_kategori = $this->input->post('nama_kategori');
        $deskripsi = $this->input->post('deskripsi');

        $this->db->set('nama_kategori', $nama_kategori);
        $this->db->set('deskripsi', $deskripsi);
        $this->db->where('id_kategori', $id);
        $this->db->update('kategori');

        $this->session->set_flashdata('success', 'Data Kategori berhasil Diubah');
        redirect('master/kategori');
    }

    public function hapusKategori($id)
    {
        $result = $this->db->get_where('kategori', ['id_kategori' => $id])->row_array();
        $this->db->where('id_kategori', $id);
        $this->db->delete('kategori');

        $this->session->set_flashdata('success', 'Data Kategori berhasil Dihapus');
        redirect('master/kategori');
    }

    public function brand()
    {
        $data['title'] = 'Brand';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['row'] = $this->user_m->get()->result();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['merk'] = $this->Karyawan_model->getAllMerk();
        $data['users'] = $this->db->get('user')->result_array();
        $this->form_validation->set_rules('nama_merk', 'Nama Brand', 'required|trim');
        $this->form_validation->set_rules('cat_merk', 'Deskripsi', 'required|trim');

        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/master/brand', $data);
    }

    public function tambahMerk()
    {
        $data['title'] = 'Tambah Brand'; // Judul link
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $array = [
            'nama_merk' => html_escape($this->input->post('nama_merk', true)),
            'cat_merk' => html_escape($this->input->post('cat_merk', true)),
        ];

        $this->db->insert('merk', $array);

        $this->session->set_flashdata('success', 'Data Brand berhasil Ditambah');
        redirect('master/brand');
    }

    public function ubahMerk($id)
    {
        $data['title'] = 'Edit Brand'; // Judul link
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['merk'] = $this->db->get('merk')->row_array();

        $nama_merk = $this->input->post('nama_merk');
        $cat_merk = $this->input->post('cat_merk');

        $this->db->set('nama_merk', $nama_merk);
        $this->db->set('cat_merk', $cat_merk);
        $this->db->where('id_merk', $id);
        $this->db->update('merk');

        $this->session->set_flashdata('success', 'Data Brand berhasil Diubah');
        redirect('master/brand');
    }

    public function hapusMerk($id)
    {
        $result = $this->db->get_where('merk', ['id_merk' => $id])->row_array();
        $this->db->where('id_merk', $id);
        $this->db->delete('merk');

        $this->session->set_flashdata('success', 'Data Brand berhasil Dihapus');
        redirect('master/brand');
    }

    public function supplier()
    {
        $data['title'] = 'Supplier';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['row'] = $this->user_m->get()->result();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['supplier'] = $this->Karyawan_model->getAllSupplier();
        $data['users'] = $this->db->get('user')->result_array();
        $this->form_validation->set_rules('nama_supplier', 'Nama Supplier', 'required|trim');
        $this->form_validation->set_rules('kontak_supplier', 'Kontak Supplier', 'required|trim');
        $this->form_validation->set_rules('alamat_supplier', 'Alamat Supplier', 'required|trim');
        $this->form_validation->set_rules('link_supplier', 'Link Supplier', 'required|trim');
        $this->form_validation->set_rules('mtd_transaksi', 'Metode Transaksi', 'required|trim');
        $this->form_validation->set_rules('status_supplier', 'Status Supplier', 'required|trim');
        $this->form_validation->set_rules('cat_supplier', 'Deskripsi', 'required|trim');

        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/master/supplier', $data);
    }

    public function tambahSupplier()
    {
        $data['title'] = 'Tambah Supplier'; // Judul link
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $array = [
            'nama_supplier' => html_escape($this->input->post('nama_supplier', true)),
            'kontak_supplier' => html_escape($this->input->post('kontak_supplier', true)),
            'alamat_supplier' => html_escape($this->input->post('alamat_supplier', true)),
            'link_supplier' => html_escape($this->input->post('link_supplier', true)),
            'mtd_transaksi' => html_escape($this->input->post('mtd_transaksi', true)),
            'status_supplier' => html_escape($this->input->post('status_supplier', true)),
            'cat_supplier' => html_escape($this->input->post('cat_supplier', true)),
        ];

        $this->db->insert('supplier', $array);

        $this->session->set_flashdata('success', 'Data Supplier berhasil Ditambah');
        redirect('master/supplier');
    }

    public function ubahSupplier($id)
    {
        $data['title'] = 'Edit Supplier'; // Judul link
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['supplier'] = $this->db->get('supplier')->row_array();

        $nama_supplier = $this->input->post('nama_supplier');
        $kontak_supplier = $this->input->post('kontak_supplier');
        $alamat_supplier = $this->input->post('alamat_supplier');
        $link_supplier = $this->input->post('link_supplier');
        $web_supplier = $this->input->post('web_supplier');
        $status_supplier = $this->input->post('status_supplier');
        $cat_supplier = $this->input->post('cat_supplier');

        $this->db->set('nama_supplier', $nama_supplier);
        $this->db->set('kontak_supplier', $kontak_supplier);
        $this->db->set('alamat_supplier', $alamat_supplier);
        $this->db->set('link_supplier', $link_supplier);
        $this->db->set('web_supplier', $web_supplier);
        $this->db->set('status_supplier', $status_supplier);
        $this->db->set('cat_supplier', $cat_supplier);
        $this->db->where('id_supplier', $id);
        $this->db->update('supplier');

        $this->session->set_flashdata('success', 'Data Supplier berhasil Diubah');
        redirect('master/supplier');
    }

    public function hapusSupplier($id)
    {
        $result = $this->db->get_where('supplier', ['id_supplier' => $id])->row_array();
        $this->db->where('id_supplier', $id);
        $this->db->delete('supplier');

        $this->session->set_flashdata('success', 'Data Supplier berhasil Dihapus');
        redirect('master/supplier');
    }
}
