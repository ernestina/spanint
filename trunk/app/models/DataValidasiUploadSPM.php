<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataValidasiUploadSPM{

    private $db;
	private $_file_name;
	private $_creation_date;
	private $_status_code;
	private $_satker_code;
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
		$sql = "SELECT DISTINCT FILE_NAME
				, CREATION_DATE
				, STATUS_CODE
				, SUBSTR(INVOICE_NUM, 8,6) SATKER_CODE
				FROM " 
				. $this->_table1. "
				WHERE STATUS_CODE = 'Validasi gagal' 
				"
				
				;
				
		$no=0;
		foreach ($filter as $filter) {
			$sql .= " AND ".$filter;
		}
		//var_dump ($sql);
		$sql .= " ORDER BY CREATION_DATE DESC";
        $result = $this->db->select($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_satker_code($val['SATKER_CODE']);
			$d_data->set_creation_date($val['CREATION_DATE']);
            $d_data->set_file_name($val['FILE_NAME']);
            $d_data->set_status_code($val['STATUS_CODE']);
            $data[] = $d_data;
        }
        return $data;
    }
	
    /*
     * setter
     */

    public function set_satker_code($SATKER_CODE) {
        $this->_satker_code = $SATKER_CODE;
    }
	
    public function set_file_name($file_name) {
        $this->_file_name = $file_name;
    }
	
    public function set_status_code($status_code) {
        $this->_status_code = $status_code;
    }
	
	public function set_creation_date($creation_date) {
        $this->_creation_date = $creation_date;
    }
	
	/*
     * getter
     */
	
	public function get_satker_code() {
        return $this->_satker_code;
    }
		
	public function get_file_name() {
        return $this->_file_name;
    }
	
	public function get_status_code() {
        return $this->_status_code;
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