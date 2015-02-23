<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class encumbrances {

    private $db;
    private $_segment1;
	private $_attribute1;
	private $_attribute11;
    private $_status;
    private $_comments;
    private $_code_id;
    private $_encumbered_amount;
	private $_billed_amount;
	private $_sisa_encumbrence;
	private $_app_date;
	private $_description;
    private $_table1 = 'ENCUMBRANCES';
	private $_table2 = 'GL_CODE_COMBINATIONS';
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

        $sql .= " ORDER BY SEGMENT1, description ASC ";

        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_segment1($val['SEGMENT1']);
            $d_data->set_attribute11($val['ATTRIBUTE11']);
            $d_data->set_code_id($val['CODE_COMBINATION_ID']);
            $d_data->set_status($val['APPROVED_FLAG']);
            $d_data->set_encumbered_amount($val['ENCUMBERED_AMOUNT']);
			$d_data->set_billed_amount($val['EQ_AMOUNT_BILLED']);
			$d_data->set_sisa_encumbrence($val['SISA_ENCUMBRANCE']);
            $d_data->set_comments($val['COMMENTS']);
            $d_data->set_attribute1($val['ATTRIBUTE1']);
            $d_data->set_app_date($val['APPROVED_DATE']);
            $d_data->set_description($val['DESCRIPTION']);
            $data[] = $d_data;
        }
        return $data;
    }
	
	public function get_encumbrances_baes1($filter) {
        Session::get('id_user');
        $sql = "SELECT DISTINCT A.*, B.SEGMENT1  SATKER
				FROM "
                . $this->_table1 . " A,"
				. $this->_table2 . " B 
				where 1=1
				AND A.CODE_COMBINATION_ID = B.CODE_COMBINATION_ID
				";
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }

        $sql .= " ORDER BY A.SEGMENT1, A.CREATION_DATE, description  ";

        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_segment1($val['SEGMENT1']);
            $d_data->set_attribute11($val['ATTRIBUTE11']);
            $d_data->set_code_id($val['CODE_COMBINATION_ID']);
            $d_data->set_status($val['APPROVED_FLAG']);
            $d_data->set_encumbered_amount($val['ENCUMBERED_AMOUNT']);
			$d_data->set_billed_amount($val['EQ_AMOUNT_BILLED']);
			$d_data->set_sisa_encumbrence($val['SISA_ENCUMBRANCE']);
            $d_data->set_comments($val['COMMENTS']);
            $d_data->set_attribute1($val['ATTRIBUTE1']);
            $d_data->set_app_date($val['APPROVED_DATE']);
            $d_data->set_description($val['DESCRIPTION']);
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
	public function set_billed_amount($billed_amount) {
        $this->_billed_amount = $billed_amount;
    }
	public function set_sisa_encumbrence($sisa_encumbrence) {
        $this->_sisa_encumbrence = $sisa_encumbrence;
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
	public function set_attribute11($attribute11) {
        $this->_attribute11 = $attribute11;
    }
	public function set_app_date($app_date) {
        $this->_app_date = $app_date;
    }
	public function set_description($description) {
        $this->_description = $description;
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
	
	public function get_billed_amount() {
        return $this->_billed_amount;
    }
	
	public function get_sisa_encumbrence() {
        return $this->_sisa_encumbrence;
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
	
	public function get_attribute11() {
        return $this->_attribute11;
    }
	public function get_app_date() {
        return $this->_app_date;
    }
	public function get_description() {
        return $this->_description;
    }

    /*
     * destruktor
     */

    public function __destruct() {
        
    }

}
