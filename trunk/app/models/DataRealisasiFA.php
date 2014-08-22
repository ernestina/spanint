<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataRealisasiFA {

    private $db;
    private $_invoice_num;
    private $_invoice_date;
    private $_cancelled_date;
    private $_status;
    private $_code_id;
    private $_amount;
    private $_check_number;
    private $_check_date;
    private $_table1 = 'realisasi_inv_all_v';
    public $registry;

    /*
     * konstruktor
     */

    public function __construct($registry = Registry) {
        $this->db = $registry->db;
        $this->registry = $registry;
    }

    /*
     * mendapatkan data dari tabel Data Tetap
     * @param limit batas default null
     * return array objek Data Tetap */

    public function get_realisasi_fa_filter($filter) {
        Session::get('id_user');
        $sql = "SELECT INVOICE_NUM, DIST_CODE_COMBINATION_ID, INVOICE_DATE, AMOUNT, CHECK_NUMBER, CHECK_DATE, 
				CASE WHEN WFAPPROVAL_STATUS = 'WFAPPROVED' THEN 'Sudah Disetujui' 
				WHEN WFAPPROVAL_STATUS = 'REJECTED' THEN 'Ditolak (Belum Dibatalkan)'
				END WFAPPROVAL_STATUS 
				FROM "
                . $this->_table1 . " 
				where 1=1
				and (status_lookup_code <> 'VOIDED' 
				or status_lookup_code is null) 
				and WFAPPROVAL_STATUS <> 'NOT REQUIRED'
				";
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }

        $sql .= " ORDER BY CHECK_DATE ASC, INVOICE_NUM, INVOICE_DATE ASC ";

        //var_dump($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_invoice_num($val['INVOICE_NUM']);
            $d_data->set_code_id($val['DIST_CODE_COMBINATION_ID']);
            $d_data->set_invoice_date(date("d-m-Y", strtotime($val['INVOICE_DATE'])));
            $d_data->set_amount($val['AMOUNT']);
            $d_data->set_check_number($val['CHECK_NUMBER']);
            $d_data->set_status($val['WFAPPROVAL_STATUS']);
            if (is_null($val['CHECK_DATE'])) {
                $d_data->set_check_date("-");
            } else {
                $d_data->set_check_date(date("d-m-Y", strtotime($val['CHECK_DATE'])));
            }
            $d_data->set_cancelled_date(date("d-m-Y", strtotime($val['CANCELLED_DATE'])));
            $data[] = $d_data;
        }
        return $data;
    }

    /*
     * setter
     */

    public function set_invoice_num($invoice_num) {
        $this->_invoice_num = $invoice_num;
    }

    public function set_invoice_date($invoice_date) {
        $this->_invoice_date = $invoice_date;
    }

    public function set_code_id($code_id) {
        $this->_code_id = $code_id;
    }

    public function set_amount($amount) {
        $this->_amount = $amount;
    }

    public function set_check_number($check_number) {
        $this->_check_number = $check_number;
    }

    public function set_check_date($check_date) {
        $this->_check_date = $check_date;
    }

    public function set_status($status) {
        $this->_status = $status;
    }

    public function set_cancelled_date($cancelled_date) {
        $this->_cancelled_date = $cancelled_date;
    }

    /*
     * getter
     */

    public function get_invoice_num() {
        return $this->_invoice_num;
    }

    public function get_invoice_date() {
        return $this->_invoice_date;
    }

    public function get_code_id() {
        return $this->_code_id;
    }

    public function get_amount() {
        return $this->_amount;
    }

    public function get_check_number() {
        return $this->_check_number;
    }

    public function get_check_date() {
        return $this->_check_date;
    }

    public function get_status() {
        return $this->_status;
    }

    public function get_cancelled_date() {
        return $this->_cancelled_date;
    }

    /*
     * destruktor
     */

    public function __destruct() {
        
    }

}
