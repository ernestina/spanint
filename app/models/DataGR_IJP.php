<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataGR_IJP{

    private $db;
	private $_kppn;
    private $_gl_date_char;
    private $_bank_code;
    private $_bank_branch_code;
	private $_bank_account_num;
	private $_transaksi;
	private $_baris;
    private $_table1 = 'spgr_mpn_receipts_all_v';
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
    
    public function get_gr_ijp_filter($filter) {
		Session::get('id_user');
		$sql = "SELECT *
				FROM " 
				. $this->_table1. " 
				 WHERE 
				KPPN = ".Session::get('id_user')
				
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
            $d_data->set_kppn($val['KPPN']);
            $d_data->set_gl_date_char($val['GL_DATE_CHAR']);
			$d_data->set_bank_code($val['BANK_CODE']);
            $d_data->set_bank_branch_code($val['BANK_BRANCH_CODE']);
            $d_data->set_bank_account_num($val['BANK_ACCOUNT_NUM']);
			$d_data->set_transaksi($val['TRANSAKSI']);
			$d_data->set_baris($val['BARIS']);
			$data[] = $d_data;
        }
        return $data;
    }
	
    /*
     * setter
     */

    public function set_kppn($kppn) {
        $this->_kppn = $kppn;
    }
	
    public function set_gl_date_char($gl_date_char) {
        $this->_gl_date_char = $gl_date_char;
    }
	
	
    public function set_bank_code($bank_code) {
        $this->_bank_code = $bank_code;
    }
	
    public function set_bank_account_num($bank_account_num) {
        $this->_bank_account_num = $bank_account_num;
    }
	public function set_bank_branch_code($bank_branch_code) {
        $this->_bank_branch_code = $bank_branch_code;
    }
	public function set_transaksi($transaksi) {
        $this->_transaksi = $transaksi;
    }
	public function set_baris($baris) {
        $this->_baris = $baris;
    }	
	/*
     * getter
     */
	
	public function get_kppn() {
        return $this->_kppn;
    }
	
	public function get_gl_date_char() {
        return $this->_gl_date_char;
    }
	
	public function get_bank_code() {
        return $this->_bank_code;
    }
	
	
	public function get_bank_branch_code() {
        return $this->_bank_branch_code;
    }
	public function get_bank_account_num() {
        return $this->_bank_account_num;
    }
	public function get_transaksi() {
        return $this->_transaksi;
    }
	public function get_baris() {
        return $this->_baris;
    }

    /*
     * destruktor
     */

    public function __destruct() {
        
    }

}