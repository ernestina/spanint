<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataUploadSPM{

    private $db;
	private $_invoice_num;
    private $_invoice_amount;
	private $_invoice_date;
    private $_file_name;
	private $_status_code;
	private $_vendor_name;
	private $_vendor_site_code;
	private $_description;
	private $_column_name;
	private $_column_value;
	private $_error_message;
    private $_table1 = 'sppm_upload_errors_v';
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
    
    public function get_error_spm_filter($filter) {
		Session::get('id_user');
		$sql = "SELECT *
				FROM " 
				. $this->_table1. "
				WHERE INVOICE_NUM='80061T/119152/2014' 
				AND SUBSTR(FILE_NAME,5,3) = ".Session::get('id_user').
				"
				ORDER BY FILE_NAME "
				;
				//var_dump ($sql);
		$no=0;
		foreach ($filter as $filter) {
			
		}
        $result = $this->db->select($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_invoice_num($val['INVOICE_NUM']);
            $d_data->set_invoice_amount($val['INVOICE_AMOUNT']);
			$d_data->set_invoice_date($val['INVOICE_DATE']);
            $d_data->set_file_name($val['FILE_NAME']);
            $d_data->set_status_code($val['STATUS_CODE']);
			$d_data->set_vendor_name($val['VENDOR_NAME']);
			$d_data->set_vendor_site_code($val['VENDOR_SITE_CODE']);
			$d_data->set_description($val['DESCRIPTION']);
			$d_data->set_column_name($val['COLUMN_NAME']);
			$d_data->set_column_value($val['COLUMN_VALUE']);
			$d_data->set_error_message($val['ERROR_MESSAGE']);
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
	public function set_invoice_amount($invoice_amount) {
        $this->_invoice_amount = $invoice_amount;
    }
	public function set_invoice_date($invoice_date) {
        $this->_invoice_date = $invoice_date;
    }
	
    public function set_file_name($file_name) {
        $this->_file_name = $file_name;
    }
	
    public function set_status_code($status_code) {
        $this->_status_code = $status_code;
    }
	
	public function set_vendor_name($vendor_name) {
        $this->_vendor_name = $vendor_name;
    }
	public function set_vendor_site_code($vendor_site_code) {
        $this->_vendor_site_code = $vendor_site_code;
    }
	public function set_description($description) {
        $this->_description = $description;
    }
	public function set_attribute1($attribute1) {
        $this->_attribute1 = $attribute1;
    }

	public function set_column_value($column_value) {
        $this->_column_value = $column_value;
    }	
	public function set_column_name($column_name) {
        $this->_column_name = $column_name;
    }	
	public function set_error_message($error_message) {
        $this->_error_message = $error_message;
    }	
	/*
     * getter
     */
	
	public function get_invoice_num() {
        return $this->_invoice_num;
    }
	
	public function get_invoice_amount() {
        return $this->_invoice_amount;
    }
	
	public function get_invoice_date() {
        return $this->_invoice_date;
    }
		
	public function get_file_name() {
        return $this->_file_name;
    }
	
	public function get_status_code() {
        return $this->_status_code;
    }
	public function get_vendor_name() {
        return $this->_vendor_name;
    }
	public function get_vendor_site_code() {
        return $this->_vendor_site_code;
    }
	public function get_description() {
        return $this->_description;
    }
	public function get_column_name() {
        return $this->_column_name;
    }
	public function get_column_value() {
        return $this->_column_value;
    }
	public function get_error_message() {
        return $this->_error_message;
    }

    /*
     * destruktor
     */

    public function __destruct() {
        
    }

}