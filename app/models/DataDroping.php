<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataDroping {

    private $db;
	private $_id;
	private $_id_detail;
	private $_bank;
	private $_creation_date;
	private $_payment_currency_code;
	private $_payment_amount;
	private $_trxn_status_code;
	private $_jumlah_ftp_file_name;
	private $_jumlah_check_number_line_num;
	private $_jumlah_check_amount;
	private $_tgl_tarik;
	private $_payment_date;
	private $_bank_trxn_number;
	private $_attribute4;
    private $_error;
    private $_valid = TRUE;
    private $_table = 'T_DROPING';
    private $_table1 = 'T_DROPING_DETAIL';
    public $registry;

    /*
     * konstruktor
     */

    public function __construct($registry = Registry) {
        $this->db = $registry->db;
        $this->registry = $registry;
    }

    /*
     * mendapatkan data dari tabel Data Droping
     * @param filter
     * return array objek Data Droping*/
    
    public function get_droping_filter($filter) {
		$sql = "SELECT MAX(ID) ID, to_char(CREATION_DATE,'dd-mm-yyyy') CREATION_DATE, sum(JUMLAH_FTP_FILE_NAME) JUMLAH_FTP_FILE_NAME, 
				sum(JUMLAH_CHECK_NUMBER_LINE_NUM) JUMLAH_CHECK_NUMBER_LINE_NUM, sum(JUMLAH_CHECK_AMOUNT) JUMLAH_CHECK_AMOUNT, 
				sum(PAYMENT_AMOUNT) PAYMENT_AMOUNT
				FROM " . $this->_table . "
				WHERE TRXN_STATUS_CODE = 'SETTLED'";
		$no=0;
		//var_dump($filter);
		foreach ($filter as $filter) {
			$sql .= " AND ".$filter;
		}
		$sql .= "  GROUP BY CREATION_DATE ORDER BY CREATION_DATE";
		//var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_id($val['ID']);
            $d_data->set_creation_date(date("d-m-Y",strtotime($val['CREATION_DATE'])));
            $d_data->set_jumlah_ftp_file_name($val['JUMLAH_FTP_FILE_NAME']);
            $d_data->set_jumlah_check_number_line_num($val['JUMLAH_CHECK_NUMBER_LINE_NUM']);
            $d_data->set_jumlah_check_amount($val['JUMLAH_CHECK_AMOUNT']);
            $d_data->set_payment_amount($val['PAYMENT_AMOUNT']);
			$data[] = $d_data;
        }
        return $data;
    }
    
    public function get_droping_detail_filter($filter) {
		$sql = "select ID_DETAIL, CREATION_DATE, PAYMENT_CURRENCY_CODE, BANK_TRXN_NUMBER, PAYMENT_AMOUNT, ATTRIBUTE4 
				FROM " . $this->_table1 . "
				WHERE 1=1";
		$no=0;
		//var_dump($filter);
		foreach ($filter as $filter) {
			$sql .= " AND ".$filter;
		}
		$sql .= " ORDER BY CREATION_DATE";
		//var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_id($val['ID_DETAIL']);
            $d_data->set_creation_date(date("d-m-Y hh24:mi:ss",strtotime($val['CREATION_DATE'])));
            $d_data->set_payment_currency_code($val['PAYMENT_CURRENCY_CODE']);
            $d_data->set_bank_trxn_number($val['BANK_TRXN_NUMBER']);
            $d_data->set_payment_amount($val['PAYMENT_AMOUNT']);
            $d_data->set_attribute4($val['ATTRIBUTE4']);
			$data[] = $d_data;
        }
        return $data;
    }
	
    /*
     * setter
     */

    public function set_id($id) {
        $this->_id = $id;
    }

    public function set_id_detail($id_detail) {
        $this->_id_detail = $id_detail;
    }

    public function set_bank($bank) {
        $this->_bank = $bank;
    }
	
    public function set_creation_date($creation_date) {
        $this->_creation_date = $creation_date;
    }
	
    public function set_payment_currency_code($payment_currency_code) {
        $this->_payment_currency_code = $payment_currency_code;
    }
	
    public function set_payment_amount($payment_amount) {
        $this->_payment_amount = $payment_amount;
    }
	
    public function set_trxn_status_code($trxn_status_code) {
        $this->_trxn_status_code = $trxn_status_code;
    }
	
    public function set_jumlah_ftp_file_name($jumlah_ftp_file_name) {
        $this->_jumlah_ftp_file_name = $jumlah_ftp_file_name;
    }
	
    public function set_jumlah_check_number_line_num($jumlah_check_number_line_num) {
        $this->_jumlah_check_number_line_num = $jumlah_check_number_line_num;
    }
	
    public function set_jumlah_check_amount($jumlah_check_amount) {
        $this->_jumlah_check_amount = $jumlah_check_amount;
    }
	
    public function set_tgl_tarik($tgl_tarik) {
        $this->_tgl_tarik = $tgl_tarik;
    }
	
    public function set_payment_date($payment_date) {
        $this->_payment_date = $payment_date;
    }
	
    public function set_bank_trxn_number($bank_trxn_number) {
        $this->_bank_trxn_number = $bank_trxn_number;
    }
	
    public function set_attribute4($attribute4) {
        $this->_attribute4 = $attribute4;
    }
		
	/*
     * getter
     */
	
	public function get_id() {
        return $this->_id;
    }
	
	public function get_id_detail() {
        return $this->_id_detail;
    }
	
	public function get_bank() {
        return $this->_bank;
    }
	
	public function get_creation_date() {
        return $this->_creation_date;
    }
	
	public function get_payment_currency_code() {
        return $this->_payment_currency_code;
    }
	
	public function get_payment_amount() {
        return $this->_payment_amount;
    }
	
	public function get_trxn_status_code() {
        return $this->_trxn_status_code;
    }
	
	public function get_jumlah_ftp_file_name() {
        return $this->_jumlah_ftp_file_name;
    }
	
	public function get_jumlah_check_number_line_num() {
        return $this->_jumlah_check_number_line_num;
    }
	
	public function get_jumlah_check_amount() {
        return $this->_jumlah_check_amount;
    }
	
	public function get_tgl_tarik() {
        return $this->_tgl_tarik;
    }
	
	public function get_payment_date() {
        return $this->_payment_date;
    }
	
	public function get_attribute4() {
        return $this->_attribute4;
    }
	
	public function get_bank_trxn_number() {
        return $this->_bank_trxn_number;
    }
	
	public function get_table() {
        return $this->_table;
    }
	
	public function get_table1() {
        return $this->_table1;
    }

    /*
     * destruktor
     */

    public function __destruct() {
        
    }

}