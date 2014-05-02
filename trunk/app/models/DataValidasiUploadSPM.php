<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataValidasiUploadSPM{

    private $db;
	private $_file_name;
	private $_creation_date;
	private $_invoice_num;
    private $_status_code;
	private $_invoice_date;
	private $_invoice_amount;
	private $_vendor_name;
	private $_vendor_site_code;
	private $_description;
	private $_table1 = 'SPPM_AP_INV_INT_ALL';
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
    
    public function get_validasi_spm_filter($filter) {
		Session::get('id_user');
		$sql = "SELECT DISTINCT *
				FROM " 
				. $this->_table1. "
				WHERE STATUS_CODE = 'Validasi gagal' 
				AND SUBSTR(OPERATING_UNIT,1,3) = ".Session::get('id_user')
				
				;
				
		$no=0;
		foreach ($filter as $filter) {
			$sql .= " AND ".$filter;
		}
		//var_dump ($sql);
		
        $result = $this->db->select($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_invoice_num($val['INVOICE_NUM']);
			$d_data->set_creation_date($val['CREATION_DATE']);
            $d_data->set_invoice_amount(number_format($val['INVOICE_AMOUNT']));
			$d_data->set_invoice_date($val['INVOICE_DATE']);
            $d_data->set_file_name($val['FILE_NAME']);
            $d_data->set_status_code($val['STATUS_CODE']);
			$d_data->set_vendor_name($val['VENDOR_NAME']);
			$d_data->set_vendor_site_code($val['VENDOR_SITE_CODE']);
			$d_data->set_description($val['DESCRIPTION']);
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
	public function set_creation_date($creation_date) {
        $this->_creation_date = $creation_date;
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
	public function get_creation_date() {
        return $this->_creation_date;
    }
    /*
     * destruktor
     */

    public function __destruct() {
        
    }

}