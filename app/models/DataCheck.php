<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataCheck{

    private $db;
	private $_jenis_sp2d;
	private $_amount;
	private $_invoice_num;
	private $_invoice_date;
	private $_description;
	private $_check_number;
	private $_check_date;
	private $_attribute6;
	private $_nmsatker;
	private $_creation_date;
	private $_status_lookup_code;
	private $_table1 = 'AP_CHECKS_ALL_V';
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
     * return array objek Data Tetap*/
    
    public function get_sp2d_satker_filter($filter) {
		Session::get('id_user');
		$sql = "SELECT *
				FROM " 
				. $this->_table1. "
				WHERE 
				STATUS_LOOKUP_CODE <> 'VOIDED'"
				
				;
				
		$no=0;
		foreach ($filter as $filter) {
			$sql .= " AND ".$filter;
		}
		
		
		$sql .= " ORDER BY CHECK_DATE DESC";
				//var_dump ($sql);

        $result = $this->db->select($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_jenis_sp2d($val['JENIS_SP2D']);
			$d_data->set_amount(NUMBER_FORMAT($val['AMOUNT']));
            $d_data->set_invoice_num($val['INVOICE_NUM']);
			$d_data->set_invoice_date($val['INVOICE_DATE']);
			$d_data->set_description($val['DESCRIPTION']);
			$d_data->set_check_number($val['CHECK_NUMBER']);
			$d_data->set_check_date($val['CHECK_DATE']);
			$d_data->set_attribute6($val['ATTRIBUTE6']);
			$d_data->set_nmsatker($val['NMSATKER']);
			$d_data->set_creation_date($val['CREATION_DATE']);
			$d_data->set_status_lookup_code($val['STATUS_LOOKUP_CODE']);
            $data[] = $d_data;
        }
        return $data;
    }
	
    /*
     * setter
     */

    public function set_jenis_sp2d($jenis_sp2d) {
        $this->_jenis_sp2d = $jenis_sp2d;
    }
	public function set_amount($amount) {
        $this->_amount = $amount;
    }
	public function set_invoice_num($invoice_num) {
        $this->_invoice_num = $invoice_num;
    }
	public function set_invoice_date($invoice_date) {
        $this->_invoice_date = $invoice_date;
    }
	public function set_description($description) {
        $this->_description = $description;
    }
	public function set_check_number($check_number) {
        $this->_check_number = $check_number;
    }
	public function set_check_date($check_date) {
        $this->_check_date = $check_date;
    }
	public function set_attribute6($attribute6) {
        $this->_attribute6 = $attribute6;
    }
	public function set_status_lookup_code($status_lookup_code) {
        $this->_status_lookup_code = $status_lookup_code;
    }
	public function set_nmsatker($nmsatker) {
        $this->_nmsatker = $nmsatker;
    }
	public function set_creation_date($creation_date) {
        $this->_creation_date = $creation_date;
    }
	/*
     * getter
     */
	
	public function get_jenis_sp2d() {
        return $this->_jenis_sp2d;
    }
	public function get_creation_date() {
        return $this->_creation_date;
    }
	public function get_amount() {
        return $this->_amount;
    }
	
	public function get_invoice_num() {
        return $this->_invoice_num;
    }
	public function get_invoice_date() {
        return $this->_invoice_date;
    }
	public function get_description() {
        return $this->_description;
    }
	public function get_check_number() {
        return $this->_check_number;
    }
	public function get_check_date() {
        return $this->_check_date;
    }
	public function get_attribute6() {
        return $this->_attribute6;
    }
	public function get_status_lookup_code() {
        return $this->_status_lookup_code;
    }
	public function get_nmsatker() {
        return $this->_nmsatker;
    }
		
    /*
     * destruktor
     */

    public function __destruct() {
        
    }

}