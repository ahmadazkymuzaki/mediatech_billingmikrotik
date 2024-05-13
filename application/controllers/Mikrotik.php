<?php defined('BASEPATH') or exit('No direct script access allowed');

class Mikrotik extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('router_m');
    }

    public function setting()
    {
        $data['title'] = 'Setting Router';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['router'] = $this->router_m->get()->result();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/router/setting', $data);
    }
    public function semua()
    {
        $data['title'] = 'Semua Router';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['router'] = $this->router_m->get()->result();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/router/semua', $data);
    }

    public function script()
    {
        $data['title'] = 'Script Router';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['router'] = $this->db->get('router')->row_array();
        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/router/script', $data);
    }

    public function addrouter()
    {
        $data['title'] = 'Tambah Router';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $name_router = $this->input->post('name_router');
        $host_router = $this->input->post('host_router');
        $port_router = $this->input->post('port_router');
        $user_router = $this->input->post('user_router');
        $pass_router = $this->input->post('pass_router');
        $description = $this->input->post('description');

        $params = [
            'name_router' => $name_router,
            'host_router' => $host_router,
            'port_router' => $port_router,
            'user_router' => $user_router,
            'pass_router' => $pass_router,
            'description' => 'Non-Aktif',
        ];
        $this->db->insert('router', $params);
        $this->session->set_flashdata('success', 'Router berhasil Ditambah');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function editrouter($id)
    {
        $data['title'] = 'Edit Router';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $name_router = $this->input->post('name_router');
        $host_router = $this->input->post('host_router');
        $port_router = $this->input->post('port_router');
        $user_router = $this->input->post('user_router');
        $pass_router = $this->input->post('pass_router');
        $description = $this->input->post('description');
        $this->db->set('name_router', $name_router);
        $this->db->set('host_router', $host_router);
        $this->db->set('port_router', $port_router);
        $this->db->set('user_router', $user_router);
        $this->db->set('pass_router', $pass_router);
        $this->db->set('description', $description);
        $this->db->where('router_id', $id);
        $this->db->update('router');
        $this->session->set_flashdata('success', 'Data Router berhasil Diperbaharui');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function pilihrouter()
    {
        $data['title'] = 'Edit Router';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $router_id = $this->input->post('router_id');

        $param = [
            'description' => 'Non-Aktif',
        ];
        $this->db->update('router', $param);

        $params = [
            'description' => 'Aktif',
        ];
        $this->db->where('router_id', $router_id);
        $this->db->update('router', $params);
        $this->session->set_flashdata('success', 'Router berhasil Dipilih & Diaktifkan.');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function klikrouter($router_id)
    {
        $data['title'] = 'Edit Router';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $param = [
            'description' => 'Non-Aktif',
        ];
        $this->db->update('router', $param);

        $params = [
            'description' => 'Aktif',
        ];
        $this->db->where('router_id', $router_id);
        $this->db->update('router', $params);
        $this->session->set_flashdata('success', 'Router berhasil Dipilih & Diaktifkan.');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete($id)
    {
        $this->db->where('router_id', $id);
        $this->db->delete('router');

        $this->session->set_flashdata('success', 'Data Router berhasil Dihapus');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function status()
    {
        $data['title'] = 'Status Router';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
        $API = new routeros();
        $host = $myrouter['host_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $port = $myrouter['port_router'];
        $API->connect($host, $port, $user, $pass);
        $hotspotuser = $API->comm("/ip/hotspot/user/print");
        $ipcloud = $API->comm("/ip/cloud/print");
        $hotspotactive = $API->comm("/ip/hotspot/active/print");
        $pppsecrets = $API->comm("/ppp/secret/print");
        $pppactive = $API->comm("/ppp/active/print");
        $identity = $API->comm("/system/identity/print");
        $resource = $API->comm("/system/resource/print");
        $waktu = $API->comm("/system/clock/print");
        $license = $API->comm("/system/license/print");
        $resource = json_encode($resource);
        $resource = json_decode($resource, true);
        $ipcloud = json_encode($ipcloud);
        $ipcloud = json_decode($ipcloud, true);
        $waktu = json_encode($waktu);
        $waktu = json_decode($waktu, true);
        $identity = json_encode($identity);
        $identity = json_decode($identity, true);
        $license = json_encode($license);
        $license = json_decode($license, true);

        $boardname = $resource['0']['board-name'];
        if ($boardname == 'CHR') {
            $level = $license['0']['level'];
            $software = $license['0']['system-id'];
        } else {
            $level = $license['0']['nlevel'];
            $software = $license['0']['software-id'];
        }

        $dataku = [
            'hotspotuser' => count($hotspotuser),
            'hotspotactive' => count($hotspotactive),
            'pppsecrets' => count($pppsecrets),
            'pppactive' => count($pppactive),
            'identity' => $identity['0']['name'],
            'publicrouter' => $ipcloud['0']['public-address'],
            'identity' => $identity['0']['name'],
            'cpuname' => $resource['0']['cpu'],
            'cpucount' => $resource['0']['cpu-count'],
            'frequency' => $resource['0']['cpu-frequency'],
            'cpuload' => $resource['0']['cpu-load'],
            'uptime' => $resource['0']['uptime'],
            'boardname' => $resource['0']['board-name'],
            'architecture' => $resource['0']['architecture-name'],
            'freememory' => $resource['0']['free-memory'],
            'totalmemory' => $resource['0']['total-memory'],
            'freehdd' => $resource['0']['free-hdd-space'],
            'totalhdd' => $resource['0']['total-hdd-space'],
            'architecture' => $resource['0']['architecture-name'],
            'version' => $resource['0']['version'],
            'badblock' => $resource['0']['bad-blocks'],
            'time' => $waktu['0']['time'],
            'date' => $waktu['0']['date'],
            'level' => $level,
            'software' => $software,
        ];

        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/router/status', $data + $dataku);
        $API->disconnect();
    }

    public function log()
    {
        $data['title'] = 'Log Router';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
        $API = new routeros();
        $host = $myrouter['host_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $port = $myrouter['port_router'];
        $API->connect($host, $port, $user, $pass);
        $log = $API->comm("/log/print");
        $log = json_encode($log);
        $log = json_decode($log, true);

        $datagua = [
            'totallog' => count($log),
            'log' => $log
        ];

        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/router/log', $data + $datagua);
    }

    public function leases()
    {
        $data['title'] = 'DHCP Leases';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
        $API = new routeros();
        $host = $myrouter['host_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $port = $myrouter['port_router'];
        $API->connect($host, $port, $user, $pass);
        $lease = $API->comm("/ip/dhcp-server/lease/print");
        $lease = json_encode($lease);
        $lease = json_decode($lease, true);

        $datagua = [
            'totallease' => count($lease),
            'lease' => $lease
        ];

        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/router/leases', $data + $datagua);
    }

    public function deletelease($id)
    {
        $data['title'] = 'Delete Active';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
        $API = new routeros();
        $host = $myrouter['host_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $port = $myrouter['port_router'];
        $API->connect($host, $port, $user, $pass);
        $API->comm("/ip/dhcp-server/lease/remove", array(
            '.id' => '*' . $id,
        ));

        $this->session->set_flashdata('success', 'DHCP Lease berhasil Dihapus');
        redirect($_SERVER['HTTP_REFERER']);
        $API->disconnect();
    }

    public function interface()
    {
        $data['title'] = 'All Interface';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
        $API = new routeros();
        $host = $myrouter['host_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $port = $myrouter['port_router'];
        $API->connect($host, $port, $user, $pass);
        $interface = $API->comm("/interface/print", array(
            '?mtu' => 1500,
        ));
        $interface = json_encode($interface);
        $interface = json_decode($interface, true);

        $datagua = [
            'totalinterface' => count($interface),
            'interface' => $interface
        ];

        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/router/interface', $data + $datagua);
    }

    public function reboot()
    {
        $data['title'] = 'MikroTik Reboot';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
        $API = new routeros();
        $host = $myrouter['host_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $port = $myrouter['port_router'];
        $API->connect($host, $port, $user, $pass);
        $API->comm("/system/reboot\ny");

        $this->session->set_flashdata('success', 'Router MikroTik berhasil Reboot');
        redirect($_SERVER['HTTP_REFERER']);
        $API->disconnect();
    }
}
ini_set("display_errors", "off");
