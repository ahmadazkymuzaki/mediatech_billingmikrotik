<?php defined('BASEPATH') or exit('No direct script access allowed');
class Report_m extends CI_Model
{
    public function getReport($id_transaksi = null)
    {
        $this->db->select('*');
        $this->db->from('report_transaction');
        if ($id_transaksi != null) {
            $this->db->where('$id_transaksi', $id_transaksi);
        }
        $this->db->order_by('created', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = [
            'income' => htmlspecialchars($post['nominal']),
            'expenditure' => 0,
            'date' => htmlspecialchars($post['date_payment']),
            'remark' => htmlspecialchars($post['remark']),
            'created' => time()
        ];
        $this->db->insert('report_transaction', $params);
    }

    public function addReport2($post)
    {
        $params = [
            'income' => 0,
            'expenditure' =>  htmlspecialchars($post['nominal']),
            'date' => htmlspecialchars($post['date_payment']),
            'remark' => htmlspecialchars($post['remark']),
            'created' => time()
        ];
        $this->db->insert('report_transaction', $params);
    }
    public function addReport($post)
    {
        $params = [
            'income' => htmlspecialchars($post['nominal']),
            'expenditure' => 0,
            'date' => htmlspecialchars($post['date_payment']),
            'remark' => htmlspecialchars('Pembayaran Tagihan no layanan' . ' ' . $post['no_services'] . ' ' . 'a/n' . ' ' . $post['name'] . ' ' . 'Periode' . ' ' . $post['month'] . ' ' . $post['year']),
            'created' => time()
        ];
        $this->db->insert('report_transaction', $params);
    }
    public function gettransaksiThisMonth()
    {
        $this->db->select('*');
        $this->db->from('report_transaction');
        $this->db->where('MONTH(date)', date('m'));
        $query = $this->db->get();
        return $query;
    }
    //Query manual
    function manualQuery($q)
    {
        return $this->db->query($q);
    }

    public function debit($date)
    {
        $q = "SELECT * FROM report_transaction WHERE  date='$date'";
        $data = $this->report_m->manualQuery($q);
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $t) {
                $hasil = $t->income;
            }
        } else {
            $hasil = 0;
        }
        return $hasil;
    }
    public function kredit($date)
    {
        $q = "SELECT * FROM report_transaction WHERE date='$date'";
        $data = $this->report_m->manualQuery($q);
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $t) {
                $hasil = $t->expenditure;
            }
        } else {
            $hasil = 0;
        }
        return $hasil;
    }

    public function delete($created)
    {
        $this->db->where('created', $created);
        $this->db->delete('report_transaction');
    }
    public function editIncome($post)
    {
        $params = [
            'income' => htmlspecialchars($post['nominal']),
            'date' => htmlspecialchars($post['date_payment']),
            'remark' => htmlspecialchars($post['remark']),
        ];
        $this->db->where('created',  $post['created']);
        $this->db->update('report_transaction', $params);
    }
    public function editExpenditure($post)
    {
        $params = [
            'expenditure' => htmlspecialchars($post['nominal']),
            'date' => htmlspecialchars($post['date_payment']),
            'remark' => htmlspecialchars($post['remark']),
        ];
        $this->db->where('created',  $post['created']);
        $this->db->update('report_transaction', $params);
    }

    public function getFilter($post)
    {
        $this->db->select('*');
        $this->db->from('report_transaction');
        if (!empty($post['tanggal']) && !empty($post['tanggal2'])) {
            $this->db->where("report_transaction.date BETWEEN '" . ($post['tanggal']) . "' AND '" . ($post['tanggal2']) . "'");
        }
        $this->db->order_by('date', 'ASC');
        $query = $this->db->get();
        return $query;
    }
}
