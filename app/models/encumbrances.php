<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class encumbrances {

    private $db;
    private $_segment1;
    private $_status;
    private $_comments;
    private $_attribute1;
    private $_code_id;
    private $_encumbered_amount;
    private $_table1 = 'ENCUMBRANCES';
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

    public function get_encumbrances($filter) {
        Session::get('id_user');
        $sql = "SELECT *  
				FROM "
                . $this->_table1 . " 
				where 1=1
				";
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }

        $sql .= " ORDER BY SEGMENT1 DESC ";

        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_segment1($val['SEGMENT1']);
            $d_data->set_code_id($val['DIST_CODE_COMBINATION_ID']);
            $d_data->set_status($val['AUTHORIZATION_STATUS']);
            $d_data->set_encumbered_amount($val['ENCUMBERED_AMOUNT']);
            $d_data->set_comments($val['COMMENTS']);
            $d_data->set_attribute1($val['ATTRIBUTE1']);
            $data[] = $d_data;
        }
        return $data;
    }

    /*
     * setter
     */

    public function set_segment1($segment1) {
        $this->_segment1 = $segment1;
    }

    public function set_encumbered_amount($encumbered_amount) {
        $this->_encumbered_amount = $encumbered_amount;
    }

    public function set_code_id($code_id) {
        $this->_code_id = $code_id;
    }

    public function set_comments($comments) {
        $this->_comments = $comments;
    }

    public function set_status($status) {
        $this->_status = $status;
    }

    public function set_attribute1($attribute1) {
        $this->_attribute1 = $attribute1;
    }

    /*
     * getter
     */

    public function get_segment1() {
        return $this->_segment1;
    }

    public function get_encumbered_amount() {
        return $this->_encumbered_amount;
    }

    public function get_code_id() {
        return $this->_code_id;
    }

    public function get_comments() {
        return $this->_comments;
    }

    public function get_status() {
        return $this->_status;
    }

    public function get_attribute1() {
        return $this->_attribute1;
    }

    /*
     * destruktor
     */

    public function __destruct() {
        
    }

}
