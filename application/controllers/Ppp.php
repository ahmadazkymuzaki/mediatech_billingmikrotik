<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ppp extends CI_Controller
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
        $this->load->model(['customer_m']);
    }

    public function secret()
    {
        $data['title'] = 'Secrets PPP';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
        $API = new routeros();
        $host = $myrouter['host_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $port = $myrouter['port_router'];
        $API->connect($host, $port, $user, $pass);
        $pppsecret = $API->comm("/ppp/secret/print");
        $pppsecret = json_encode($pppsecret);
        $pppsecret = json_decode($pppsecret, true);
        $pppprofile = $API->comm("/ppp/profile/print");
        $pppprofile = json_encode($pppprofile);
        $pppprofile = json_decode($pppprofile, true);

        $dataku = [
            'totalpppsecret' => count($pppsecret),
            'pppsecret' => $pppsecret

        ];

        $datagua = [
            'totalpppprofile' => count($pppprofile),
            'pppprofile' => $pppprofile
        ];

        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/ppp/secret', $data + $dataku + $datagua);
        $API->disconnect();
    }

    public function static()
    {
        $data['title'] = 'User Static';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
        $API = new routeros();
        $host = $myrouter['host_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $port = $myrouter['port_router'];
        $API->connect($host, $port, $user, $pass);
        $pppstatic = $API->comm("/queue/simple/print", array(
            "?dynamic" => "false",
        ));
        $pppstatic = json_encode($pppstatic);
        $pppstatic = json_decode($pppstatic, true);
        $ppptree = $API->comm("/queue/tree/print", array(
            "?dynamic" => "false",
        ));
        $ppptree = json_encode($ppptree);
        $ppptree = json_decode($ppptree, true);

        $dataku = [
            'totalpppstatic' => count($pppstatic),
            'pppstatic' => $pppstatic

        ];

        $datagua = [
            'totalppptree' => count($ppptree),
            'ppptree' => $ppptree
        ];

        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/ppp/static', $data + $dataku + $datagua);
        $API->disconnect();
    }

    public function addsecret()
    {
        $post = $this->input->post(null, true);
        $data['title'] = 'Tambah Secret';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $username    = $this->input->post('name');
        $password    = $this->input->post('password');
        $remote      = $this->input->post('remote');
        $local       = $this->input->post('local');
        $service     = $this->input->post('service');
        $comment     = $this->input->post('comment');
        $no_services = $this->input->post('no_services');

        $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
        $host = $myrouter['host_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $port = $myrouter['port_router'];
        $API = new routeros();
        $API->connect($host, $port, $user, $pass);

        if ($no_services == "") {
            $profile = $this->input->post('profile');
            if ($local == '' && $remote == '' && $comment == '') {
                $API->comm("/ppp/secret/add", array(
                    "name" => $username,
                    "password" => $password,
                    "service" => $service,
                    "profile" => $profile
                ));
            } elseif ($local == '' && $remote == '') {
                $API->comm("/ppp/secret/add", array(
                    "name" => $username,
                    "password" => $password,
                    "service" => $service,
                    "profile" => $profile,
                    "comment" => $comment
                ));
            } elseif ($local == '' && $comment == '') {
                $API->comm("/ppp/secret/add", array(
                    "name" => $username,
                    "password" => $password,
                    "remote-address" => $remote,
                    "service" => $service,
                    "profile" => $profile,
                ));
            } elseif ($remote == '' && $comment == '') {
                $API->comm("/ppp/secret/add", array(
                    "name" => $username,
                    "password" => $password,
                    "local-address" => $local,
                    "service" => $service,
                    "profile" => $profile,
                ));
            } elseif ($local == '') {
                $API->comm("/ppp/secret/add", array(
                    "name" => $username,
                    "password" => $password,
                    "remote-address" => $remote,
                    "service" => $service,
                    "profile" => $profile,
                    "comment" => $comment
                ));
            } elseif ($remote == '') {
                $API->comm("/ppp/secret/add", array(
                    "name" => $username,
                    "password" => $password,
                    "local-address" => $local,
                    "service" => $service,
                    "profile" => $profile,
                    "comment" => $comment
                ));
            } elseif ($comment == '') {
                $API->comm("/ppp/secret/add", array(
                    "name" => $username,
                    "password" => $password,
                    "remote-address" => $remote,
                    "local-address" => $local,
                    "service" => $service,
                    "profile" => $profile
                ));
            } else {
                $API->comm("/ppp/secret/add", array(
                    "name" => $username,
                    "password" => $password,
                    "local-address" => $local,
                    "remote-address" => $remote,
                    "service" => $service,
                    "profile" => $profile,
                    "comment" => $comment
                ));
            }
        } else {
            $mydatapaket = $this->db->get_where('customer', array('no_services' => $no_services))->row_array();
            $profile = $mydatapaket['paket_wifi'];

            $this->db->set('username', $username);
            $this->db->set('password', $password);
            $this->db->where('no_services', $no_services);
            $this->db->update('customer');

            if ($local == '' && $remote == '' && $comment == '') {
                $API->comm("/ppp/secret/add", array(
                    "name" => $username,
                    "password" => $password,
                    "service" => $service,
                    "profile" => $profile
                ));
            } elseif ($local == '' && $remote == '') {
                $API->comm("/ppp/secret/add", array(
                    "name" => $username,
                    "password" => $password,
                    "service" => $service,
                    "profile" => $profile,
                    "comment" => $comment
                ));
            } elseif ($local == '' && $comment == '') {
                $API->comm("/ppp/secret/add", array(
                    "name" => $username,
                    "password" => $password,
                    "remote-address" => $remote,
                    "service" => $service,
                    "profile" => $profile,
                ));
            } elseif ($remote == '' && $comment == '') {
                $API->comm("/ppp/secret/add", array(
                    "name" => $username,
                    "password" => $password,
                    "local-address" => $local,
                    "service" => $service,
                    "profile" => $profile,
                ));
            } elseif ($local == '') {
                $API->comm("/ppp/secret/add", array(
                    "name" => $username,
                    "password" => $password,
                    "remote-address" => $remote,
                    "service" => $service,
                    "profile" => $profile,
                    "comment" => $comment
                ));
            } elseif ($remote == '') {
                $API->comm("/ppp/secret/add", array(
                    "name" => $username,
                    "password" => $password,
                    "local-address" => $local,
                    "service" => $service,
                    "profile" => $profile,
                    "comment" => $comment
                ));
            } elseif ($comment == '') {
                $API->comm("/ppp/secret/add", array(
                    "name" => $username,
                    "password" => $password,
                    "remote-address" => $remote,
                    "local-address" => $local,
                    "service" => $service,
                    "profile" => $profile
                ));
            } else {
                $API->comm("/ppp/secret/add", array(
                    "name" => $username,
                    "password" => $password,
                    "local-address" => $local,
                    "remote-address" => $remote,
                    "service" => $service,
                    "profile" => $profile,
                    "comment" => $comment
                ));
            }
        }

        $API->disconnect();
        $this->session->set_flashdata('success', 'Akun PPP berhasil Ditambah');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function addstatic()
    {
        $data['title'] = 'Tambah Static';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $name           = $this->input->post('name');
        $target         = $this->input->post('target');
        $max_limit      = $this->input->post('max_limit');
        $burst_limit    = $this->input->post('burst_limit');
        $threshold      = $this->input->post('threshold');
        $burst_time     = $this->input->post('burst_time');
        $limit_at       = $this->input->post('limit_at');
        $priority       = $this->input->post('priority');
        $bucket_size    = $this->input->post('bucket_size');
        $queue_type     = $this->input->post('queue_type') . '/' . $this->input->post('queue_type');
        $parent         = $this->input->post('parent');
        $comment        = 'Nomor Layanan : ' . $this->input->post('no_service');

        $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
        $host = $myrouter['host_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $port = $myrouter['port_router'];

        $API = new routeros();
        $API->connect($host, $port, $user, $pass);

        if ($burst_limit == 'unlimited/unlimited') {
            if ($threshold == 'unlimited/unlimited') {
                if ($burst_time == '0/0') {
                    if ($bucket_size == '0.100/0.100') {
                        if ($limit_at == 'unlimited/unlimited') {
                            if ($priority == '8/8') {
                                $API->comm("/queue/simple/add", array(
                                    "name" => "$name",
                                    "target" => "$target",
                                    "max-limit" => "$max_limit",
                                    "queue" => "$queue_type",
                                    "parent" => "$parent",
                                    "comment" => "$comment"
                                ));
                            } else {
                                $API->comm("/queue/simple/add", array(
                                    "name" => "$name",
                                    "target" => "$target",
                                    "max-limit" => "$max_limit",
                                    "priority" => "$priority",
                                    "queue" => "$queue_type",
                                    "parent" => "$parent",
                                    "comment" => "$comment"
                                ));
                            }
                        } else {
                            $API->comm("/queue/simple/add", array(
                                "name" => "$name",
                                "target" => "$target",
                                "max-limit" => "$max_limit",
                                "limit-at" => "$limit_at",
                                "priority" => "$priority",
                                "queue" => "$queue_type",
                                "parent" => "$parent",
                                "comment" => "$comment"
                            ));
                        }
                    } else {
                        $API->comm("/queue/simple/add", array(
                            "name" => "$name",
                            "target" => "$target",
                            "max-limit" => "$max_limit",
                            "limit-at" => "$limit_at",
                            "priority" => "$priority",
                            "bucket-size" => "$bucket_size",
                            "queue" => "$queue_type",
                            "parent" => "$parent",
                            "comment" => "$comment"
                        ));
                    }
                } else {
                    $API->comm("/queue/simple/add", array(
                        "name" => "$name",
                        "target" => "$target",
                        "max-limit" => "$max_limit",
                        "burst-time" => "$burst_time",
                        "limit-at" => "$limit_at",
                        "priority" => "$priority",
                        "bucket-size" => "$bucket_size",
                        "queue" => "$queue_type",
                        "parent" => "$parent",
                        "comment" => "$comment"
                    ));
                }
            } else {
                $API->comm("/queue/simple/add", array(
                    "name" => "$name",
                    "target" => "$target",
                    "max-limit" => "$max_limit",
                    "burst-threshold" => "$threshold",
                    "burst-time" => "$burst_time",
                    "limit-at" => "$limit_at",
                    "priority" => "$priority",
                    "bucket-size" => "$bucket_size",
                    "queue" => "$queue_type",
                    "parent" => "$parent",
                    "comment" => "$comment"
                ));
            }
        } else {
            $API->comm("/queue/simple/add", array(
                "name" => "$name",
                "target" => "$target",
                "max-limit" => "$max_limit",
                "burst-limit" => "$burst_limit",
                "burst-threshold" => "$threshold",
                "burst-time" => "$burst_time",
                "limit-at" => "$limit_at",
                "priority" => "$priority",
                "bucket-size" => "$bucket_size",
                "queue" => "$queue_type",
                "parent" => "$parent",
                "comment" => "$comment"
            ));
        }

        $mystatic = $API->comm("/queue/simple/print", array(
            '?name' => $name,
        ));
        $mystatic = json_encode($mystatic);
        $mystatic = json_decode($mystatic, true);

        echo 'NAMA : ' . $name . '<br>';
        echo 'TARGET : ' . $target . '<br>';
        echo 'MAX LIMIT : ' . $max_limit . '<br>';
        echo 'BURST LIMIT : ' . $burst_limit . '<br>';
        echo 'B. THRESHOLD : ' . $threshold . '<br>';
        echo 'BURST TIME : ' . $burst_time . '<br>';
        echo 'LIMIT AT : ' . $limit_at . '<br>';
        echo 'PRIORITY : ' . $priority . '<br>';
        echo 'BUCKET SIZE : ' . $bucket_size . '<br>';
        echo 'QUEUE TYPE : ' . $queue_type . '<br>';
        echo 'PARENT : ' . $parent . '<br>';
        echo 'COMMENT : ' . $comment . '<br>';

        if (count($mystatic) > 0) {
            $this->session->set_flashdata('success', 'User Static ' . $name . ' berhasil di Ditambahkan');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_flashdata('error', 'User Static ' . $name . ' gagal di Ditambahkan');
            redirect($_SERVER['HTTP_REFERER']);
        }
        $API->disconnect();
    }

    public function editstatic($id)
    {
        $data['title'] = 'Tambah Static';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $name           = $this->input->post('name');
        $target         = $this->input->post('target');
        $max_limit      = $this->input->post('max_limit');
        $burst_limit    = $this->input->post('burst_limit');
        $threshold      = $this->input->post('threshold');
        $burst_time     = $this->input->post('burst_time');
        $limit_at       = $this->input->post('limit_at');
        $priority       = $this->input->post('priority');
        $bucket_size    = $this->input->post('bucket_size');
        $queue_type     = $this->input->post('queue_type');
        $parent         = $this->input->post('parent');
        $comment        = $this->input->post('comment');

        $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
        $host = $myrouter['host_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $port = $myrouter['port_router'];

        $API = new routeros();
        $API->connect($host, $port, $user, $pass);

        if ($burst_limit == '0/0') {
            if ($threshold == '0/0') {
                if ($burst_time == '0s/0s') {
                    if ($bucket_size == '0.1/0.1') {
                        if ($limit_at == '0/0') {
                            if ($priority == '8/8') {
                                $API->comm("/queue/simple/set", array(
                                    ".id" => '*' . $id,
                                    "name" => "$name",
                                    "target" => "$target",
                                    "max-limit" => "$max_limit",
                                    "queue" => "$queue_type",
                                    "parent" => "$parent",
                                    "comment" => "$comment"
                                ));
                            } else {
                                $API->comm("/queue/simple/set", array(
                                    ".id" => '*' . $id,
                                    "name" => "$name",
                                    "target" => "$target",
                                    "max-limit" => "$max_limit",
                                    "priority" => "$priority",
                                    "queue" => "$queue_type",
                                    "parent" => "$parent",
                                    "comment" => "$comment"
                                ));
                            }
                        } else {
                            $API->comm("/queue/simple/set", array(
                                ".id" => '*' . $id,
                                "name" => "$name",
                                "target" => "$target",
                                "max-limit" => "$max_limit",
                                "limit-at" => "$limit_at",
                                "priority" => "$priority",
                                "queue" => "$queue_type",
                                "parent" => "$parent",
                                "comment" => "$comment"
                            ));
                        }
                    } else {
                        $API->comm("/queue/simple/set", array(
                            ".id" => '*' . $id,
                            "name" => "$name",
                            "target" => "$target",
                            "max-limit" => "$max_limit",
                            "limit-at" => "$limit_at",
                            "priority" => "$priority",
                            "bucket-size" => "$bucket_size",
                            "queue" => "$queue_type",
                            "parent" => "$parent",
                            "comment" => "$comment"
                        ));
                    }
                } else {
                    $API->comm("/queue/simple/set", array(
                        ".id" => '*' . $id,
                        "name" => "$name",
                        "target" => "$target",
                        "max-limit" => "$max_limit",
                        "burst-time" => "$burst_time",
                        "limit-at" => "$limit_at",
                        "priority" => "$priority",
                        "bucket-size" => "$bucket_size",
                        "queue" => "$queue_type",
                        "parent" => "$parent",
                        "comment" => "$comment"
                    ));
                }
            } else {
                $API->comm("/queue/simple/set", array(
                    ".id" => '*' . $id,
                    "name" => "$name",
                    "target" => "$target",
                    "max-limit" => "$max_limit",
                    "burst-threshold" => "$threshold",
                    "burst-time" => "$burst_time",
                    "limit-at" => "$limit_at",
                    "priority" => "$priority",
                    "bucket-size" => "$bucket_size",
                    "queue" => "$queue_type",
                    "parent" => "$parent",
                    "comment" => "$comment"
                ));
            }
        } else {
            $API->comm("/queue/simple/set", array(
                ".id" => '*' . $id,
                "name" => "$name",
                "target" => "$target",
                "max-limit" => "$max_limit",
                "burst-limit" => "$burst_limit",
                "burst-threshold" => "$threshold",
                "burst-time" => "$burst_time",
                "limit-at" => "$limit_at",
                "priority" => "$priority",
                "bucket-size" => "$bucket_size",
                "queue" => "$queue_type",
                "parent" => "$parent",
                "comment" => "$comment"
            ));
        }

        echo 'NAMA : ' . $name . '<br>';
        echo 'TARGET : ' . $target . '<br>';
        echo 'MAX LIMIT : ' . $max_limit . '<br>';
        echo 'BURST LIMIT : ' . $burst_limit . '<br>';
        echo 'B. THRESHOLD : ' . $threshold . '<br>';
        echo 'BURST TIME : ' . $burst_time . '<br>';
        echo 'LIMIT AT : ' . $limit_at . '<br>';
        echo 'PRIORITY : ' . $priority . '<br>';
        echo 'BUCKET SIZE : ' . $bucket_size . '<br>';
        echo 'QUEUE TYPE : ' . $queue_type . '<br>';
        echo 'PARENT : ' . $parent . '<br>';
        echo 'COMMENT : ' . $comment . '<br>';

        $this->session->set_flashdata('success', 'User Static ' . $name . ' berhasil di Diperbarui');
        redirect('ppp/static');
        $API->disconnect();
    }

    public function editsecret($id)
    {
        $post = $this->input->post(null, true);
        $data['title'] = 'Edit Secret';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
        $API = new routeros();
        $host = $myrouter['host_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $port = $myrouter['port_router'];
        $API->connect($host, $port, $user, $pass);

        if ($this->input->post('local') == '') {
            $API->comm("/ppp/secret/set", array(
                ".id" => '*' . $id,
                "name" => $this->input->post('name'),
                "password" => $this->input->post('password'),
                "remote-address" => $this->input->post('remote'),
                "service" => $this->input->post('service'),
                "profile" => $this->input->post('profile'),
                "comment" => $this->input->post('comment')
            ));
            $this->session->set_flashdata('success', 'Akun PPP berhasil Diperbarui');
        } elseif ($this->input->post('remote') == '') {
            $API->comm("/ppp/secret/set", array(
                ".id" => '*' . $id,
                "name" => $this->input->post('name'),
                "password" => $this->input->post('password'),
                "local-address" => $this->input->post('local'),
                "service" => $this->input->post('service'),
                "profile" => $this->input->post('profile'),
                "comment" => $this->input->post('comment')
            ));
            $this->session->set_flashdata('success', 'Akun PPP berhasil Diperbarui');
        } elseif ($this->input->post('local') == '' && $this->input->post('remote') == '') {
            $API->comm("/ppp/secret/set", array(
                ".id" => '*' . $id,
                "name" => $this->input->post('name'),
                "password" => $this->input->post('password'),
                "service" => $this->input->post('service'),
                "profile" => $this->input->post('profile'),
                "comment" => $this->input->post('comment')
            ));
            $this->session->set_flashdata('success', 'Akun PPP berhasil Diperbarui');
        } else {
            $API->comm("/ppp/secret/set", array(
                ".id" => '*' . $id,
                "name" => $this->input->post('name'),
                "password" => $this->input->post('password'),
                "local-address" => $this->input->post('local'),
                "remote-address" => $this->input->post('remote'),
                "service" => $this->input->post('service'),
                "profile" => $this->input->post('profile'),
                "comment" => $this->input->post('comment')
            ));
            $this->session->set_flashdata('success', 'Akun PPP berhasil Diperbarui');
        }
        redirect('ppp/detail/' . $this->input->post('name'));
        $API->disconnect();
    }

    public function deletesecret($id)
    {
        $data['title'] = 'Delete Secret';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
        $API = new routeros();
        $host = $myrouter['host_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $port = $myrouter['port_router'];
        $API->connect($host, $port, $user, $pass);
        $API->comm("/ppp/secret/remove", array(
            '.id' => '*' . $id,
        ));

        $this->session->set_flashdata('success', 'Akun PPP berhasil Dihapus');
        redirect('ppp/secret');

        $API->disconnect();
    }

    public function deletestatic($id)
    {
        $data['title'] = 'Delete Static';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
        $host = $myrouter['host_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $port = $myrouter['port_router'];

        $API = new routeros();
        $API->connect($host, $port, $user, $pass);

        $API->comm("/queue/simple/remove", array(
            '.id' => '*' . $id,
        ));

        $this->session->set_flashdata('success', 'User Static ' . $id . ' berhasil di Dihapus');
        redirect('ppp/static');
        $API->disconnect();
    }

    public function disablestatic($id)
    {
        $data['title'] = 'Disable Users';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
        $host = $myrouter['host_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $port = $myrouter['port_router'];

        $API = new routeros();
        $API->connect($host, $port, $user, $pass);

        $API->comm("/queue/simple/disable", array(
            '.id' => '*' . $id,
        ));

        $this->session->set_flashdata('success', 'User Static ' . $id . ' berhasil di Disable');
        redirect($_SERVER['HTTP_REFERER']);
        $API->disconnect();
    }

    public function enablestatic($id)
    {
        $data['title'] = 'Disable Users';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
        $host = $myrouter['host_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $port = $myrouter['port_router'];

        $API = new routeros();
        $API->connect($host, $port, $user, $pass);

        $API->comm("/queue/simple/enable", array(
            '.id' => '*' . $id,
        ));

        $this->session->set_flashdata('success', 'User Static ' . $id . ' berhasil di Enable');
        redirect($_SERVER['HTTP_REFERER']);
        $API->disconnect();
    }

    public function monitoring($nameinterface)
    {
        $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
        $host = $myrouter['host_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $port = $myrouter['port_router'];

        $API = new routeros();
        $API->connect($host, $port, $user, $pass);
        $interface           = "<pppoe-" . $nameinterface . ">";
        $API->debug          = false;
        $getinterfacetraffic = $API->comm("/interface/monitor-traffic", array(
            "interface" => "$interface",
            "once" => "",
        ));

        $rows                = array();
        $rows2               = array();
        $ftx                 = $getinterfacetraffic[0]['tx-bits-per-second'];
        $frx                 = $getinterfacetraffic[0]['rx-bits-per-second'];
        $rows['name']        = 'Tx';
        $rows['data'][]      = $ftx;
        $rows2['name']       = 'Rx';
        $rows2['data'][]     = $frx;
        $result              = array();
        array_push($result, $rows);
        array_push($result, $rows2);
        print json_encode($result);
    }

    public function detail($name)
    {
        $data['title'] = 'Detail Users';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
        $host = $myrouter['host_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $port = $myrouter['port_router'];

        $API = new routeros();
        $API->connect($host, $port, $user, $pass);

        $pppuser = $API->comm("/ppp/secret/print", array(
            '?name' => $name,
        ));
        $pppuser = json_encode($pppuser);
        $pppuser = json_decode($pppuser, true);

        $pppactive = $API->comm("/ppp/active/print", array(
            '?name' => $name,
        ));
        $pppactive = json_encode($pppactive);
        $pppactive = json_decode($pppactive, true);

        $dataku = [
            'totalpppuser' => count($pppuser),
            'pppuser' => $pppuser,
            'pppactive' => $pppactive,
        ];

        $pppprofile = $API->comm("/ppp/profile/print");
        $pppprofile = json_encode($pppprofile);
        $pppprofile = json_decode($pppprofile, true);
        $datagua = [
            'pppprofile' => $pppprofile,
        ];

        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/ppp/detail', $data + $dataku + $datagua);
        $API->disconnect();
    }

    public function detailstatic($name)
    {
        $data['title'] = 'Detail Static';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
        $host = $myrouter['host_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $port = $myrouter['port_router'];

        $API = new routeros();
        $API->connect($host, $port, $user, $pass);

        $pppstatic = $API->comm("/queue/simple/print", array(
            '?name' => $name,
        ));
        $pppstatic = json_encode($pppstatic);
        $pppstatic = json_decode($pppstatic, true);

        $pppparent = $API->comm("/queue/simple/print", array(
            '?dynamic' => 'false',
        ));
        $pppparent = json_encode($pppparent);
        $pppparent = json_decode($pppparent, true);

        $dataku = [
            'totalpppstatic' => count($pppstatic),
            'pppstatic' => $pppstatic,
            'totalpppparent' => count($pppparent),
            'pppparent' => $pppparent,
        ];

        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/ppp/detail-static', $data + $dataku);
        $API->disconnect();
    }

    public function enable($id)
    {
        $data['title'] = 'Enable Users';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
        $API = new routeros();
        $host = $myrouter['host_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $port = $myrouter['port_router'];
        $API->connect($host, $port, $user, $pass);

        $comment = 'Di Aktifkan pada Tanggal :<br>' . date('d') . ' ' . indo_month(date('m')) . ' ' . date('Y') . ' - ' . date('H:i:s');

        $API->comm("/ppp/secret/set", array(
            '.id' => '*' . $id,
            'comment' => $comment,
        ));

        $API->comm("/ppp/secret/enable", array(
            '.id' => '*' . $id,
        ));

        $this->session->set_flashdata('success', 'PPP Secret ' . $id . ' berhasil di Enable.');
        redirect($_SERVER['HTTP_REFERER']);
        $API->disconnect();
    }

    public function disable($id)
    {
        $data['title'] = 'Disable Users';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
        $API = new routeros();
        $host = $myrouter['host_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $port = $myrouter['port_router'];
        $API->connect($host, $port, $user, $pass);

        $comment = 'Di Non-Aktifkan pada Tanggal :<br>' . date('d') . ' ' . indo_month(date('m')) . ' ' . date('Y') . ' - ' . date('H:i:s');

        $API->comm("/ppp/secret/set", array(
            '.id' => '*' . $id,
            'comment' => $comment,
        ));

        $API->comm("/ppp/secret/disable", array(
            '.id' => '*' . $id,
        ));

        $this->session->set_flashdata('success', 'PPP Secret ' . $id . ' berhasil di Disable.');
        redirect($_SERVER['HTTP_REFERER']);
        $API->disconnect();
    }

    public function profile()
    {
        $data['title'] = 'Profile PPP';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
        $API = new routeros();
        $host = $myrouter['host_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $port = $myrouter['port_router'];
        $API->connect($host, $port, $user, $pass);
        $pppprofile = $API->comm("/ppp/profile/print");
        $pppprofile = json_encode($pppprofile);
        $pppprofile = json_decode($pppprofile, true);
        $ippool = $API->comm("/ip/pool/print");
        $ippool = json_encode($ippool);
        $ippool = json_decode($ippool, true);
        $queue = $API->comm("/queue/simple/print");
        $queue = json_encode($queue);
        $queue = json_decode($queue, true);

        $dataku = [
            'totalpppprofile' => count($pppprofile),
            'pppprofile' => $pppprofile

        ];

        $datagua = [
            'ippool' => $ippool

        ];

        $mydata = [
            'queue' => $queue

        ];

        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/ppp/profile', $data + $dataku + $datagua + $mydata);
        $API->disconnect();
    }

    public function active()
    {
        $data['title'] = 'Active PPP';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
        $API = new routeros();
        $host = $myrouter['host_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $port = $myrouter['port_router'];
        $API->connect($host, $port, $user, $pass);
        $pppactive = $API->comm("/ppp/active/print");
        $pppactive = json_encode($pppactive);
        $pppactive = json_decode($pppactive, true);

        $dataku = [
            'totalpppactive' => count($pppactive),
            'pppactive' => $pppactive

        ];

        $MyCompanyData = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();
        $MyThemes = $MyCompanyData['tm_backend'];
        $this->template->load($MyThemes, 'backend/ppp/active', $data + $dataku);
        $API->disconnect();
    }

    public function deleteactive($id)
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
        $API->comm("/ppp/active/remove", array(
            '.id' => '*' . $id,
        ));

        $this->session->set_flashdata('success', 'PPP Active ' . $id . ' berhasil Dihapus');
        redirect($_SERVER['HTTP_REFERER']);
        $API->disconnect();
    }

    public function deleteprofile($id)
    {
        $data['title'] = 'Delete Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
        $API = new routeros();
        $host = $myrouter['host_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $port = $myrouter['port_router'];
        $API->connect($host, $port, $user, $pass);
        $API->comm("/ppp/profile/remove", array(
            '.id' => '*' . $id,
        ));

        $this->session->set_flashdata('success', 'Profile PPP berhasil Dihapus');
        redirect($_SERVER['HTTP_REFERER']);
        $API->disconnect();
    }

    public function addprofile()
    {
        $post = $this->input->post(null, true);
        $data['title'] = 'Tambah Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get_where('company', array('status' => 'Aktif'))->row_array();

        $myrouter  = $this->db->get_where('router', ['description' => 'Aktif'])->row_array();
        $API = new routeros();
        $host = $myrouter['host_router'];
        $user = $myrouter['user_router'];
        $pass = $myrouter['pass_router'];
        $port = $myrouter['port_router'];
        $API->connect($host, $port, $user, $pass);

        if ($post['local'] == '') {
            $local = '0.0.0.0';
        } else {
            $local = $post['local'];
        }
        if ($post['remote'] == '') {
            $remote = '0.0.0.0';
        } else {
            $remote = $post['remote'];
        }

        $API->comm("/ppp/profile/add", array(
            "name" => $post['name'],
            "rate-limit" => $post['limit'],
            "local-address" => $post['local'],
            "remote-address" => $post['remote'],
            "parent-queue" => $post['parent'],
            "only-one" => $post['only'],
            "comment" => $post['comment']
        ));

        $this->session->set_flashdata('success', 'Profile PPP berhasil Ditambah.');
        redirect($_SERVER['HTTP_REFERER']);
        $API->disconnect();
    }
}
ini_set("display_errors", "off");
