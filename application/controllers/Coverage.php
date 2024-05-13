<?php defined('BASEPATH') or exit('No direct script access allowed');

class Coverage extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model(['coverage_m']);
    }
    public function index()
    {
        $data['title'] = 'Coverage Area';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['coverage'] = $this->db->get_where('coverage', array('kategori' => 'AREA'))->result();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['provinsi'] = $this->coverage_m->getProv();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/coverage/coverage', $data);
    }

    public function searchODP()
    {
        $this->db->select('coverage.*');
        $this->db->where('coverage.kategori =', 'ODP');
        $this->db->where('coverage.latitude !=', NULL);
        $this->db->where('coverage.longitude !=', NULL);
        return $this->db->get("coverage")->result();
    }

    public function searchODC()
    {
        $this->db->select('coverage.*');
        $this->db->where('coverage.kategori =', 'ODC');
        $this->db->where('coverage.latitude !=', NULL);
        $this->db->where('coverage.longitude !=', NULL);
        return $this->db->get("coverage")->result();
    }

    public function searchAREA()
    {
        $this->db->select('coverage.*');
        $this->db->where('coverage.kategori =', 'AREA');
        $this->db->where('coverage.latitude !=', NULL);
        $this->db->where('coverage.longitude !=', NULL);
        return $this->db->get("coverage")->result();
    }

    public function odp()
    {
        $data['title'] = 'Lokasi ODP';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['coverage'] = $this->db->get_where('coverage', array('kategori' => 'ODP'))->result();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['provinsi'] = $this->coverage_m->getProv();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/coverage/odp', $data);
    }
    public function lokasiodp()
    {
        $data['title'] = 'Lokasi ODP';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['coverage'] = $this->db->get_where('coverage', array('kategori' => 'ODP'))->result();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['provinsi'] = $this->coverage_m->getProv();

        $company = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
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
        foreach ($this->searchODP() as $key => $value) :
            $marker = array();
            $marker['position'] = "{$value->latitude}, {$value->longitude}";
            $base_url = base_url();
            $marker['animation'] = 'DROP';
            $marker['infowindow_content'] = '<div class="media" style="width:300px;">';
            $marker['infowindow_content'] .= '<div class="media-left">';
            $marker['infowindow_content'] .= '</div>';
            $marker['infowindow_content'] .= '<div class="media-body">';
            $marker['infowindow_content'] .= '<b>Kode Wilayah :</b> ' . $value->c_name . '<br>';
            $marker['infowindow_content'] .= '<b>Port OLT :</b> PON ' . $value->port_pon . '<br>';
            $marker['infowindow_content'] .= '<b>Redaman Rata" :</b>' . $value->redaman . ' db<br>';
            $marker['infowindow_content'] .= '<b>Kapasitas :</b> ' . $value->kapasitas . ' Core / Port<br>';
            $marker['infowindow_content'] .= '<b>Tersedia :</b> ' . $value->tersedia . ' Core / Port<br>';
            $marker['infowindow_content'] .= '<b>Keterangan :</b> ' . $value->comment . '<br>';
            $marker['infowindow_content'] .= '</div>';
            $marker['infowindow_content'] .= '</div>';
            $marker['icon'] = 'https://files.naufal.co.id/public/icon/wifi.png';
            $this->googlemaps->add_marker($marker);
        endforeach;
        $this->googlemaps->initialize($config);
        $data['map'] = $this->googlemaps->create_map();

        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/coverage/lokasi-odp', $data);
    }
    public function lokasiarea()
    {
        $data['title'] = 'Coverage Area';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['coverage'] = $this->db->get_where('coverage', array('kategori' => 'AREA'))->result();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['provinsi'] = $this->coverage_m->getProv();

        $company = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
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
        foreach ($this->searchAREA() as $key => $value) :
            $marker = array();
            $marker['position'] = "{$value->latitude}, {$value->longitude}";
            $base_url = base_url();
            $marker['animation'] = 'DROP';
            $marker['infowindow_content'] = '<div class="media" style="width:300px;">';
            $marker['infowindow_content'] .= '<div class="media-left">';
            $marker['infowindow_content'] .= '</div>';
            $marker['infowindow_content'] .= '<div class="media-body">';
            $marker['infowindow_content'] .= '<b>Kode Wilayah :</b> ' . $value->c_name . '<br>';
            $marker['infowindow_content'] .= '<b>Port OLT :</b> PON ' . $value->port_pon . '<br>';
            $marker['infowindow_content'] .= '<b>Redaman Rata" :</b>' . $value->redaman . ' db<br>';
            $marker['infowindow_content'] .= '<b>Kapasitas :</b> ' . $value->kapasitas . ' Core / Port<br>';
            $marker['infowindow_content'] .= '<b>Tersedia :</b> ' . $value->tersedia . ' Core / Port<br>';
            $marker['infowindow_content'] .= '<b>Keterangan :</b> ' . $value->comment . '<br>';
            $marker['infowindow_content'] .= '</div>';
            $marker['infowindow_content'] .= '</div>';
            $marker['icon'] = 'https://files.naufal.co.id/public/icon/wifi.png';
            $this->googlemaps->add_marker($marker);
        endforeach;
        $this->googlemaps->initialize($config);
        $data['map'] = $this->googlemaps->create_map();

        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/coverage/lokasi-area', $data);
    }
    public function lokasiodc()
    {
        $data['title'] = 'Lokasi ODC';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['coverage'] = $this->db->get_where('coverage', array('kategori' => 'ODC'))->result();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['provinsi'] = $this->coverage_m->getProv();

        $company = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
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
        foreach ($this->searchODC() as $key => $value) :
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
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/coverage/lokasi-odc', $data);
    }
    public function odc()
    {
        $data['title'] = 'Lokasi ODC';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['coverage'] = $this->db->get_where('coverage', array('kategori' => 'ODC'))->result();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['provinsi'] = $this->coverage_m->getProv();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/coverage/odc', $data);
    }
    public function data()
    {
        $data['title'] = 'Data Wilayah';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/coverage/wilayah', $data);
    }
    public function customer()
    {
        $data['title'] = 'Customer Area';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['coverage'] = $this->coverage_m->getCoverage()->result();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['provinsi'] = $this->coverage_m->getProv();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/coverage/coverage', $data);
    }
    public function add()
    {
        if ($this->session->userdata('role_id') != 1) {
            $this->session->set_flashdata('error', 'Akses dilarang');
            redirect('dashboard');
        }
        $post = $this->input->post(null, TRUE);

        $this->coverage_m->add($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Coverage area berhasil ditambahkan');
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function getKab($id_prov)
    {
        $kab = $this->coverage_m->getKab($id_prov);
        echo "<option value=''>Pilih Kota/Kab</option>";
        foreach ($kab as $k) {
            echo "<option value='{$k->id}'>{$k->nama}</option>";
        }
    }

    public function getKec($id_kab)
    {
        $kec = $this->coverage_m->getKec($id_kab);
        echo "<option value=''>Pilih Kecamatan</option>";
        foreach ($kec as $k) {
            echo "<option value='{$k->id}'>{$k->nama}</option>";
        }
    }

    public function getKel($id_kec)
    {
        $kel = $this->coverage_m->getKel($id_kec);
        echo "<option value=''>Pilih Kelurahan/Desa</option>";
        foreach ($kel as $k) {
            echo "<option value='{$k->id}'>{$k->nama}</option>";
        }
    }

    public function edit($id)
    {
        if ($this->session->userdata('role_id') != 1) {
            $this->session->set_flashdata('error', 'Akses dilarang');
            redirect('dashboard');
        }
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        if ($this->form_validation->run() == false) {
            $query  = $this->db->get_where('coverage', ['coverage_id' => $id]);
            if ($query->num_rows() > 0) {
                $data['title'] = 'Edit Data';
                $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
                $company = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
                $data['coverage'] = $this->db->get_where('coverage', ['coverage_id' => $id])->row_array();
                $data['provinsi'] = $this->coverage_m->getProv();
                $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
                $config['map_div_id'] = "map-add";
                $config['map_height'] = "250px";
                $coverage = $this->db->get_where('coverage', ['coverage_id' => $id])->row_array();
                if ($coverage['latitude'] == '' || $coverage['latitude'] == NULL) {
                    $config['center'] = $company['latitude'] . ',' . $company['longitude'];
                } else {
                    $config['center'] = $coverage['latitude'] . ',' . $coverage['longitude'];
                }
                $config['zoom'] = '12';
                $config['map_height'] = '400px;';
                $config['map_type'] = 'HYBRID';
                $this->googlemaps->initialize($config);
                $marker = array();
                if ($coverage['latitude'] == '' || $coverage['latitude'] == NULL) {
                    $marker['position'] = $company['latitude'] . ',' . $company['longitude'];
                } else {
                    $marker['position'] = $coverage['latitude'] . ',' . $coverage['longitude'];
                }
                $marker['draggable'] = true;
                $marker['ondragend'] = 'setMapToForm(event.latLng.lat(), event.latLng.lng());';
                $this->googlemaps->add_marker($marker);
                $data['map'] = $this->googlemaps->create_map();
                $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
                $MyThemes = $MyCompanyData['tm_backend'];
                $this->template->load($MyThemes, 'backend/coverage/edit-coverage', $data);
            } else {
                echo "<script> alert ('Data tidak ditemukan');";
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $post = $this->input->post(null, TRUE);
            $this->coverage_m->edit($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success-sweet', 'Data berhasil Diperbaharui');
            }
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function deletecoverage()
    {
        $post = $this->input->post(null, TRUE);
        $cekcustomer = $this->db->get_where('customer', ['coverage' => $post['coverage_id']]);
        if ($cekcustomer->num_rows() > 0) {
            $this->session->set_flashdata('error-sweet', 'Tidak bisa dihapus karena masih terdaftar di data pelanggan');
        } else {
            $this->coverage_m->del($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success-sweet', 'Coverage Area berhasil dihapus');
            }
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function cs($coverage)
    {
        $data['title'] = 'Customer Area';
        $data['cov'] = $coverage;
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['customer'] = $this->coverage_m->getCustomer($coverage)->result();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/coverage/customer', $data);
    }
}
