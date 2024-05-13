<?php defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model(['setting_m', 'income_m', 'router_m', 'expenditure_m', 'bill_m', 'customer_m', 'package_m']);
    }
    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['income'] = $this->income_m->getIncome()->result();
        $data['router'] = $this->router_m->get()->result();
        $data['mycompany'] = $this->setting_m->getMyCompany()->result();
        $data['totalCustomer'] = $this->customer_m->getCustomer()->num_rows();
        $data['totalServices'] = $this->package_m->getPItem()->num_rows();
        $data['expenditure'] = $this->expenditure_m->getexpenditure()->result();
        $data['incomeThisMonth'] = $this->income_m->getIncomeThisMonth()->result();
        $data['ExpenditureThisMonth'] = $this->expenditure_m->getExpenditureThisMonth()->result();
        $data['pendingPayment'] = $this->bill_m->getPendingPayment()->num_rows();
        $data['incomeJan'] = $this->income_m->getIncomeJan()->result();
        $data['incomeFeb'] = $this->income_m->getIncomeFeb()->result();
        $data['incomeMar'] = $this->income_m->getIncomeMar()->result();
        $data['incomeApr'] = $this->income_m->getIncomeApr()->result();
        $data['incomeMay'] = $this->income_m->getIncomeMay()->result();
        $data['incomeJun'] = $this->income_m->getIncomeJun()->result();
        $data['incomeJul'] = $this->income_m->getIncomeJul()->result();
        $data['incomeAug'] = $this->income_m->getIncomeAug()->result();
        $data['incomeSep'] = $this->income_m->getIncomeSep()->result();
        $data['incomeOct'] = $this->income_m->getIncomeOct()->result();
        $data['incomeNov'] = $this->income_m->getIncomeNov()->result();
        $data['incomeDec'] = $this->income_m->getIncomeDec()->result();
        $data['bank'] = $this->setting_m->getBank()->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $data['other'] = $this->db->get('other')->row_array();

        $API = new routeros();
        $router = $this->db->get_where('router', array('description' => 'Aktif'))->row_array();
        $port = $router['port_router'];
        $host = $router['host_router'];
        $user = $router['user_router'];
        $pass = $router['pass_router'];
        $API->connect($host, $port, $user, $pass);
        $hotspotuser = $API->comm("/ip/hotspot/user/print");
        $hotspotactive = $API->comm("/ip/hotspot/active/print");
        $pppsecrets = $API->comm("/ppp/secret/print");
        $pppactive = $API->comm("/ppp/active/print");
        $identity = $API->comm("/system/identity/print");
        $resource = $API->comm("/system/resource/print");
        $waktu = $API->comm("/system/clock/print");
        $license = $API->comm("/system/license/print");
        $resource = json_encode($resource);
        $resource = json_decode($resource, true);
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
            'time' => $waktu['0']['time'],
            'date' => $waktu['0']['date'],
            'level' => $level,
            'software' => $software,
        ];

        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/dashboard', $data + $dataku);
        $API->disconnect();
    }
}
