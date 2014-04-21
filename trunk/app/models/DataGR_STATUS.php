<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataGR_STATUS{

    private $db;
	private $_status;
    private $_file_name;
    private $_gl_date;
	private $_bank_code;
	private $_bank_account_num;
    private $_resp_name;
	private $_keterangan;
    private $_table1 = 'spgr_mpn_receipts_all';
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
    
    public function get_gr_status_filter($filter) {
		Session::get('id_user');
		$sql = "SELECT DISTINCT STATUS, FILE_NAME, GL_DATE, RESP_NAME, BANK_CODE, BANK_ACCOUNT_NUM,
				CASE STATUS 
				WHEN 'Validated' THEN 'Lakukan interface ulang' 
				WHEN 'Error' THEN 'Data Error, Silakan Konsultasikan dengan DTP' 
				ELSE 'Data Completed' END AS KETERANGAN 
				FROM " 
				. $this->_table1. " 
				WHERE 
				SUBSTR(RESP_NAME,1,3) = '".Session::get('id_user')."'  
				 AND status <> 'Reversed' " 
				
				;
		$no=0;
		foreach ($filter as $filter) {
			$sql .= " AND ".$filter;
		}
			$sql .= " ORDER BY GL_DATE DESC ";
		//var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_status($val['STATUS']);
            $d_data->set_file_name($val['FILE_NAME']);
			$d_data->set_bank_code($val['BANK_CODE']);
			$d_data->set_bank_account_num($val['BANK_ACCOUNT_NUM']);
            $d_data->set_gl_date($val['GL_DATE']);
            $d_data->set_resp_name($val['RESP_NAME']);
			$d_data->set_keterangan($val['KETERANGAN']);
			
            $data[] = $d_data;
        }
        return $data;
    }
	
    /*
     * setter
     */

    public function set_status($status) {
        $this->_status = $status;
    }
	
    public function set_file_name($file_name) {
        $this->_file_name = $file_name;
    }
	public function set_bank_code($bank_code) {
        $this->_bank_code = $bank_code;
    }
	public function set_bank_account_num($bank_account_num) {
        $this->_bank_account_num = $bank_account_num;
    }
	
	
    public function set_gl_date($gl_date) {
        $this->_gl_date = $gl_date;
    }
	
    public function set_resp_name($resp_name) {
        $this->_resp_name = $resp_name;
    }
	public function set_keterangan($keterangan) {
        $this->_keterangan = $keterangan;
    }
	
		
	/*
     * getter
     */
	
	public function get_status() {
        return $this->_status;
    }
	
	public function get_file_name() {
        return $this->_file_name;
    }
	
	public function get_gl_date() {
        return $this->_gl_date;
    }
	public function get_bank_code() {
        return $this->_bank_code;
    }
	public function get_bank_account_num() {
        return $this->_bank_account_num;
    }
	public function get_resp_name() {
        return $this->_resp_name;
    }
	public function get_keterangan() {
        return $this->_keterangan;
    }
	
	

    /*
     * destruktor
     */

    public function __destruct() {
        
    }

}