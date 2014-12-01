<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataNamaSatker {

    private $db;
    private $_kdsatker;
    private $_nmsatker;
    private $_kppn;
    private $_rev;
    private $_tgl_rev;
    private $_total_sp2d;
    private $_table1 = 'T_SATKER';
    private $_table2 = 'AP_CHECKS_ALL_V';
    private $_table3 = 'SPSA_BT_DIPA_V';
    private $_table4 = 'satker_max_revision';
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

    public function get_satker_filter($filter) {
        $sql = " SELECT SEGMENT1 KDSATKER
				, UPPER(NMSATKER) NMSATKER
				, substr(check_number,3,3) KPPN
				, count(check_number) TOTAL_SP2D 
				FROM "
                . $this->_table2 . " 
				WHERE  
				status_lookup_code <> 'VOIDED'
				AND NMSATKER IS NOT NULL"

        ;

        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }

        $sql .= " GROUP BY SEGMENT1, NMSATKER, SUBSTR(CHECK_NUMBER,3,3)";
        $sql .= " ORDER BY NMSATKER";
        //var_dump ($sql);

        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_kdsatker($val['KDSATKER']);
            $d_data->set_nmsatker($val['NMSATKER']);
            $d_data->set_kppn($val['KPPN']);
            //$d_data->set_tgl_rev($val['TANGGAL_POSTING_REVISI']);
            $d_data->set_total_sp2d($val['TOTAL_SP2D']);
            $data[] = $d_data;
        }
        return $data;
    }

    public function get_satker_dipa_filter($filter) {
        Session::get('id_user');
        $sql = "SELECT *
				FROM "
                . $this->_table4 . " WHERE 1=1 ";

        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }

        $sql .= " ORDER BY kppn_code,rev desc";
        var_dump ($sql);

        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_kdsatker($val['KDSATKER']);
            $d_data->set_nmsatker($val['NMSATKER']);
            $d_data->set_kppn($val['KPPN_CODE']);
            $d_data->set_rev($val['REV']);
            $d_data->set_tgl_rev($val['TANGGAL_POSTING_REVISI']);
            $data[] = $d_data;
        }
        return $data;
    }

    /*
     * setter
     */

    public function set_nmsatker($nmsatker) {
        $this->_nmsatker = $nmsatker;
    }

    public function set_rev($rev) {
        $this->_rev = $rev;
    }

    public function set_tgl_rev($tgl_rev) {
        $this->_tgl_rev = $tgl_rev;
    }

    public function set_kdsatker($kdsatker) {
        $this->_kdsatker = $kdsatker;
    }

    public function set_kppn($kppn) {
        $this->_kppn = $kppn;
    }

    public function set_total_sp2d($total_sp2d) {
        $this->_total_sp2d = $total_sp2d;
    }

    /*
     * getter
     */

    public function get_nmsatker() {
        return $this->_nmsatker;
    }

    public function get_rev() {
        return $this->_rev;
    }

    public function get_tgl_rev() {
        return $this->_tgl_rev;
    }

    public function get_kdsatker() {
        return $this->_kdsatker;
    }

    public function get_kppn() {
        return $this->_kppn;
    }

    public function get_total_sp2d() {
        return $this->_total_sp2d;
    }

    public function get_table1() {
        return $this->_table1;
    }

    public function get_table2() {
        return $this->_table2;
    }

    public function get_table3() {
        return $this->_table3;
    }

    public function get_table4() {
        return $this->_table4;
    }

    /*
     * destruktor
     */

    public function __destruct() {
        
    }

}
