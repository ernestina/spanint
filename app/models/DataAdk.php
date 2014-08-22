<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataAdk {

    private $db;
    private $_kd_d_adk;
    private $_kd_kppn;
    private $_kd_satker;
    private $_kd_tgl;
    private $_kd_adk_name;
    private $_kd_jml_pdf;
    private $_kd_file_name;
    private $_kd_status;
    private $_file;
    private $_error;
    private $_valid = TRUE;
    private $_table = 'd_adk';
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

    public function get_adk_list($kd_kppn = null, $status = null, $limit = null, $batas = null) {
        $sql = "SELECT * FROM " . $this->_table . " where kd_kppn = " . $kd_kppn;
        if (!is_null($status)) {
            $sql .= " AND kd_status =" . $status;
        }
        $sql .= " ORDER BY kd_tgl desc";
        if (!is_null($limit) AND ! is_null($batas)) {
            $sql .= " LIMIT " . $limit . "," . $batas;
        }
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_adk = new $this($this->registry);
            $d_adk->set_kd_d_adk($val['kd_d_adk']);
            $d_adk->set_kd_kppn($val['kd_kppn']);
            $d_adk->set_kd_satker($val['kd_satker']);
            $d_adk->set_kd_tgl(date("d/m/y", strtotime($val['kd_tgl'])));
            $d_adk->set_kd_adk_name($val['kd_adk_name']);
            $d_adk->set_kd_jml_pdf($val['kd_jml_pdf']);
            $d_adk->set_kd_file_name($val['kd_file_name']);
            $d_adk->set_kd_status($val['kd_status']);
            $data[] = $d_adk;
        }
        return $data;
    }

    public function get_adk_by_id($adk) {
        $sql = "SELECT * FROM " . $this->_table . " where kd_d_adk = " . $adk;
        if (!is_null($limit) AND ! is_null($batas)) {
            $sql .= " LIMIT " . $limit . "," . $batas;
        }
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_adk = new $this($this->registry);
            $d_adk->set_kd_d_adk($val['kd_d_adk']);
            $d_adk->set_kd_kppn($val['kd_kppn']);
            $d_adk->set_kd_satker($val['kd_satker']);
            $d_adk->set_kd_tgl($val['kd_tgl']);
            $d_adk->set_kd_adk_name($val['kd_adk_name']);
            $d_adk->set_kd_jml_pdf($val['kd_jml_pdf']);
            $d_adk->set_kd_file_name($val['kd_file_name']);
            $d_adk->set_kd_status($val['kd_status']);
            $data[] = $d_adk;
        }
        return $data;
    }

    public function add_adk() {
        $data = array(
            'kd_kppn' => $this->get_kd_kppn(),
            'kd_satker' => $this->get_kd_satker(),
            'kd_tgl' => $this->get_kd_tgl(),
            'kd_adk_name' => $this->get_kd_adk_name(),
            'kd_jml_pdf' => $this->get_kd_jml_pdf(),
            'kd_file_name' => $this->get_kd_file_name(),
            'kd_status' => $this->get_kd_status()
        );
        //$this->validate();
        //if (!$this->get_valid()) {
        //    return false;
        //}
        if (!is_array($data)) {
            return false;
        }
        return $this->db->insert($this->_table, $data);
    }

    public function upload_adk($kd_kppn = null, $limit = null, $batas = null) {
        $sql = "SELECT * FROM " . $this->_table . " where kd_kppn = " . $kd_kppn . " ORDER BY kd_tgl desc";
        if (!is_null($limit) AND ! is_null($batas)) {
            $sql .= " LIMIT " . $limit . "," . $batas;
        }
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_adk = new $this($this->registry);
            $d_adk->set_kd_d_adk($val['kd_d_adk']);
            $d_adk->set_kd_kppn($val['kd_kppn']);
            $d_adk->set_kd_satker($val['kd_satker']);
            $d_adk->set_kd_tgl(date("d/m/y", strtotime($val['kd_tgl'])));
            $d_adk->set_kd_adk_name($val['kd_adk_name']);
            $d_adk->set_kd_jml_pdf($val['kd_jml_pdf']);
            $d_adk->set_kd_file_name($val['kd_file_name']);
            $d_adk->set_kd_status($val['kd_status']);
            $data[] = $d_adk;
        }
        return $data;
    }

    public function update_status($adk) {
        $data = array(
            'kd_status' => $this->get_kd_status()
        );
        $where = ' kd_d_adk=' . $adk;
        return $this->db->update($this->_table, $data, $where);
    }

    /*
     * setter
     */

    public function set_kd_d_adk($adk) {
        $this->_kd_d_adk = $adk;
    }

    public function set_kd_kppn($kppn) {
        $this->_kd_kppn = $kppn;
    }

    public function set_kd_satker($satker) {
        $this->_kd_satker = $satker;
    }

    public function set_kd_tgl($tgl) {
        $this->_kd_tgl = $tgl;
    }

    public function set_kd_adk_name($adk_name) {
        $this->_kd_adk_name = $adk_name;
    }

    public function set_kd_jml_pdf($jml_pdf) {
        $this->_kd_jml_pdf = $jml_pdf;
    }

    public function set_kd_file_name($file_name) {
        $this->_kd_file_name = $file_name;
    }

    public function set_kd_status($status) {
        $this->_kd_status = $status;
    }

    public function set_file($file) {
        $this->_file = $file;
    }

    /*
     * getter
     */

    public function get_kd_d_adk($where = null) {
        if (!is_null($where)) {
            $sql = "SELECT kd_d_adk FROM '" . $this->_table . "' WHERE '" . $where . "'";
            $result = $this->db->select($sql);
            foreach ($result as $val) {
                $this->set_kd_d_adk($val['kd_d_adk']);
            }
        }
        return $this->_kd_d_adk;
    }

    public function get_kd_kppn() {
        return $this->_kd_kppn;
    }

    public function get_kd_satker() {
        return $this->_kd_satker;
    }

    public function get_kd_tgl() {
        return $this->_kd_tgl;
    }

    public function get_kd_adk_name() {
        return $this->_kd_adk_name;
    }

    public function get_kd_jml_pdf() {
        return $this->_kd_jml_pdf;
    }

    public function get_kd_file_name() {
        return $this->_kd_file_name;
    }

    public function get_kd_status() {
        return $this->_kd_status;
    }

    /*
     * destruktor
     */

    public function __destruct() {
        
    }

}
