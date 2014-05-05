<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataCheck{

    private $db;
	private $_vendor_name;
	private $_amoount;
	private $_invoice_num;
	private $_invoice_date;
	private $_description;
	private $_check_number;
	private $_check_date;
	private $_attribute6;
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
				ATTRIBUTE15 = '".Session::get('id_user')."'"
				
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
            $d_data->set_vendor_name($val['VENDOR_NAME']);
			$d_data->set_amount(NUMBER_FORMAT($val['AMOUNT']));
            $d_data->set_invoice_num($val['INVOICE_NUM']);
			$d_data->set_invoice_date($val['INVOICE_DATE']);
			$d_data->set_description($val['DESCRIPTION']);
			$d_data->set_check_number($val['CHECK_NUMBER']);
			$d_data->set_check_date($val['CHECK_DATE']);
			$d_data->set_attribute6($val['ATTRIBUTE6']);
			$d_data->set_status_lookup_code($val['STATUS_LOOKUP_CODE']);
            $data[] = $d_data;
        }
        return $data;
    }
	
    /*
     * setter
     */

    public function set_vendor_name($vendor_name) {
        $this->_vendor_name = $vendor_name;
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
	
	/*
     * getter
     */
	
	public function get_vendor_name() {
        return $this->_vendor_name;
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
		
    /*
     * destruktor
     */

    public function __destruct() {
        
    }

}