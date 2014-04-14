<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataSppm {

    private $db;
	private $_payment_date;
    private $_invoice_num;
    private $_check_date;
    private $_creation_date;
	private $_check_number;
	private $_check_number_line_num;
    private $_check_amount;
    private $_bank_account_name;
	private $_bank_name;
	private $_vendor_ext_bank_account_num;
	private $_vendor_name;
	private $_invoice_description;
	private $_ftp_file_name;
	private $_return_desc;
	private $_return_code;
	private $_kdkppn;
	private $_fl_void;
    private $_error;
    private $_valid = TRUE;
    private $_table = 'XICO_ALL';
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
    
    public function get_sppm_filter($filter) {
		$sql = "SELECT PAYMENT_DATE , INVOICE_NUM, CHECK_DATE, CREATION_DATE, 
				CHECK_NUMBER, CHECK_NUMBER_LINE_NUM, CHECK_AMOUNT, BANK_ACCOUNT_NAME ,
				BANK_NAME, VENDOR_EXT_BANK_ACCOUNT_NUM, VENDOR_NAME, 
				INVOICE_DESCRIPTION, FTP_FILE_NAME, RETURN_DESC, RETURN_CODE, KDKPPN
				FROM " . $this->_table . "
				WHERE KDKPPN = ".Session::get('id_user')." AND FL_VOID <> 1";
		//SP2D = 140181301002823
		//xml = 520002000990_SP2D_O_20140408_101509_367.xml
		$no=0;
		//var_dump($filter);
		foreach ($filter as $filter) {
			$sql .= " AND ".$filter;
		}
		$sql .= " ORDER BY PAYMENT_DATE DESC";
		//var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_payment_date($val['PAYMENT_DATE']);
            $d_data->set_invoice_num($val['INVOICE_NUM']);
            $d_data->set_check_date($val['CHECK_DATE']);
            $d_data->set_creation_date($val['CREATION_DATE']);
            $d_data->set_check_number($val['CHECK_NUMBER']);
            $d_data->set_check_number_line_num($val['CHECK_NUMBER_LINE_NUM']);
            $d_data->set_check_amount($val['CHECK_AMOUNT']);
            $d_data->set_bank_account_name($val['BANK_ACCOUNT_NAME']);
            $d_data->set_bank_name($val['BANK_NAME']);
            $d_data->set_vendor_ext_bank_account_num($val['VENDOR_EXT_BANK_ACCOUNT_NUM']);
            $d_data->set_vendor_name($val['VENDOR_NAME']);
            $d_data->set_invoice_description($val['INVOICE_DESCRIPTION']);
            $d_data->set_ftp_file_name($val['FTP_FILE_NAME']);
            $d_data->set_return_code($val['RETURN_CODE']);
            $d_data->set_return_desc($val['RETURN_DESC']);
            $d_data->set_kdkppn($val['KDKPPN']);
			$data[] = $d_data;
        }
        return $data;
    }
	
	public function get_harian_bo_i($filter) {
		$sql = "SELECT PAYMENT_DATE , INVOICE_NUM, CHECK_DATE, CREATION_DATE, 
				CHECK_NUMBER, CHECK_NUMBER_LINE_NUM, CHECK_AMOUNT, BANK_ACCOUNT_NAME ,
				BANK_NAME, VENDOR_EXT_BANK_ACCOUNT_NUM, VENDOR_NAME, 
				INVOICE_DESCRIPTION, FTP_FILE_NAME, RETURN_DESC, RETURN_CODE, KDKPPN
				FROM " . $this->_table . "
				WHERE KDKPPN = ".Session::get('id_user')." AND FL_VOID <> 1";
		//SP2D = 140181301002823
		$no=0;
		//var_dump($filter);
		foreach ($filter as $filter) {
			$sql .= " AND ".$filter;
		}
		$sql .= " ORDER BY PAYMENT_DATE DESC";
		//var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_payment_date($val['PAYMENT_DATE']);
            $d_data->set_invoice_num($val['INVOICE_NUM']);
            $d_data->set_check_date($val['CHECK_DATE']);
            $d_data->set_creation_date($val['CREATION_DATE']);
            $d_data->set_check_number($val['CHECK_NUMBER']);
            $d_data->set_check_number_line_num($val['CHECK_NUMBER_LINE_NUM']);
            $d_data->set_check_amount($val['CHECK_AMOUNT']);
            $d_data->set_bank_account_name($val['BANK_ACCOUNT_NAME']);
            $d_data->set_bank_name($val['BANK_NAME']);
            $d_data->set_vendor_ext_bank_account_num($val['VENDOR_EXT_BANK_ACCOUNT_NUM']);
            $d_data->set_vendor_name($val['VENDOR_NAME']);
            $d_data->set_invoice_description($val['INVOICE_DESCRIPTION']);
            $d_data->set_ftp_file_name($val['FTP_FILE_NAME']);
            $d_data->set_return_code($val['RETURN_CODE']);
            $d_data->set_return_desc($val['RETURN_DESC']);
            $d_data->set_kdkppn($val['KDKPPN']);
			$data[] = $d_data;
        }
        return $data;
    }
	
	public function get_sp2d_hari_ini($filter) {
		$sql = "SELECT PAYMENT_DATE , INVOICE_NUM, CHECK_DATE, CREATION_DATE, 
				CHECK_NUMBER, CHECK_NUMBER_LINE_NUM, CHECK_AMOUNT, BANK_ACCOUNT_NAME ,
				BANK_NAME, VENDOR_EXT_BANK_ACCOUNT_NUM, VENDOR_NAME, 
				INVOICE_DESCRIPTION, FTP_FILE_NAME, RETURN_DESC, RETURN_CODE, KDKPPN
				FROM " . $this->_table . "
				WHERE KDKPPN = '0".Session::get('id_user')."' AND FL_VOID <> 1 ";
		//SP2D = 140181301002823
		$no=0;
		//var_dump($filter);
		foreach ($filter as $filter) {
			$sql .= " AND ".$filter;
		}
		$sql .= " ORDER BY PAYMENT_DATE DESC";
        $result = $this->db->select($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_payment_date($val['PAYMENT_DATE']);
            $d_data->set_invoice_num($val['INVOICE_NUM']);
            $d_data->set_check_date($val['CHECK_DATE']);
            $d_data->set_creation_date($val['CREATION_DATE']);
            $d_data->set_check_number($val['CHECK_NUMBER']);
            $d_data->set_check_number_line_num($val['CHECK_NUMBER_LINE_NUM']);
            $d_data->set_check_amount($val['CHECK_AMOUNT']);
            $d_data->set_bank_account_name($val['BANK_ACCOUNT_NAME']);
            $d_data->set_bank_name($val['BANK_NAME']);
            $d_data->set_vendor_ext_bank_account_num($val['VENDOR_EXT_BANK_ACCOUNT_NUM']);
            $d_data->set_vendor_name($val['VENDOR_NAME']);
            $d_data->set_invoice_description($val['INVOICE_DESCRIPTION']);
            $d_data->set_ftp_file_name($val['FTP_FILE_NAME']);
            $d_data->set_return_code($val['RETURN_CODE']);
            $d_data->set_return_desc($val['RETURN_DESC']);
            $d_data->set_kdkppn($val['KDKPPN']);
			$data[] = $d_data;
        }
        return $data;
    }
	
	public function get_sp2d_besok($filter) {
		$sql = "SELECT PAYMENT_DATE , INVOICE_NUM, CHECK_DATE, CREATION_DATE, 
				CHECK_NUMBER, CHECK_NUMBER_LINE_NUM, CHECK_AMOUNT, BANK_ACCOUNT_NAME ,
				BANK_NAME, VENDOR_EXT_BANK_ACCOUNT_NUM, VENDOR_NAME, 
				INVOICE_DESCRIPTION, FTP_FILE_NAME, RETURN_DESC, RETURN_CODE, KDKPPN
				FROM " . $this->_table . "
				WHERE KDKPPN = ".Session::get('id_user')." AND FL_VOID <> 1";
		//SP2D = 140181301002823
		$no=0;
		//var_dump($filter);
		foreach ($filter as $filter) {
			$sql .= " AND ".$filter;
		}
		$sql .= " ORDER BY PAYMENT_DATE DESC";
		var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_payment_date($val['PAYMENT_DATE']);
            $d_data->set_invoice_num($val['INVOICE_NUM']);
            $d_data->set_check_date($val['CHECK_DATE']);
            $d_data->set_creation_date($val['CREATION_DATE']);
            $d_data->set_check_number($val['CHECK_NUMBER']);
            $d_data->set_check_number_line_num($val['CHECK_NUMBER_LINE_NUM']);
            $d_data->set_check_amount($val['CHECK_AMOUNT']);
            $d_data->set_bank_account_name($val['BANK_ACCOUNT_NAME']);
            $d_data->set_bank_name($val['BANK_NAME']);
            $d_data->set_vendor_ext_bank_account_num($val['VENDOR_EXT_BANK_ACCOUNT_NUM']);
            $d_data->set_vendor_name($val['VENDOR_NAME']);
            $d_data->set_invoice_description($val['INVOICE_DESCRIPTION']);
            $d_data->set_ftp_file_name($val['FTP_FILE_NAME']);
            $d_data->set_return_code($val['RETURN_CODE']);
            $d_data->set_return_desc($val['RETURN_DESC']);
            $d_data->set_kdkppn($val['KDKPPN']);
			$data[] = $d_data;
        }
        return $data;
    }
	
	public function get_sp2d_backdate($filter) {
		$sql = "SELECT PAYMENT_DATE , INVOICE_NUM, CHECK_DATE, CREATION_DATE, 
				CHECK_NUMBER, CHECK_NUMBER_LINE_NUM, CHECK_AMOUNT, BANK_ACCOUNT_NAME ,
				BANK_NAME, VENDOR_EXT_BANK_ACCOUNT_NUM, VENDOR_NAME, 
				INVOICE_DESCRIPTION, FTP_FILE_NAME, RETURN_DESC, RETURN_CODE, KDKPPN
				FROM " . $this->_table . "
				WHERE KDKPPN = ".Session::get('id_user')." AND FL_VOID <> 1";
		//SP2D = 140181301002823
		$no=0;
		//var_dump($filter);
		foreach ($filter as $filter) {
			$sql .= " AND ".$filter;
		}
		$sql .= " ORDER BY PAYMENT_DATE DESC";
		var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_payment_date($val['PAYMENT_DATE']);
            $d_data->set_invoice_num($val['INVOICE_NUM']);
            $d_data->set_check_date($val['CHECK_DATE']);
            $d_data->set_creation_date($val['CREATION_DATE']);
            $d_data->set_check_number($val['CHECK_NUMBER']);
            $d_data->set_check_number_line_num($val['CHECK_NUMBER_LINE_NUM']);
            $d_data->set_check_amount($val['CHECK_AMOUNT']);
            $d_data->set_bank_account_name($val['BANK_ACCOUNT_NAME']);
            $d_data->set_bank_name($val['BANK_NAME']);
            $d_data->set_vendor_ext_bank_account_num($val['VENDOR_EXT_BANK_ACCOUNT_NUM']);
            $d_data->set_vendor_name($val['VENDOR_NAME']);
            $d_data->set_invoice_description($val['INVOICE_DESCRIPTION']);
            $d_data->set_ftp_file_name($val['FTP_FILE_NAME']);
            $d_data->set_return_code($val['RETURN_CODE']);
            $d_data->set_return_desc($val['RETURN_DESC']);
            $d_data->set_kdkppn($val['KDKPPN']);
			$data[] = $d_data;
        }
        return $data;
    }
	
	public function get_sp2d_harian($filter) {
		$sql = "SELECT PAYMENT_DATE , INVOICE_NUM, CHECK_DATE, CREATION_DATE, 
				CHECK_NUMBER, CHECK_NUMBER_LINE_NUM, CHECK_AMOUNT, BANK_ACCOUNT_NAME ,
				BANK_NAME, VENDOR_EXT_BANK_ACCOUNT_NUM, VENDOR_NAME, 
				INVOICE_DESCRIPTION, FTP_FILE_NAME, RETURN_DESC, RETURN_CODE, KDKPPN
				FROM " . $this->_table . "
				WHERE KDKPPN = ".Session::get('id_user')." AND FL_VOID <> 1";
		//SP2D = 140181301002823
		$no=0;
		//var_dump($filter);
		foreach ($filter as $filter) {
			$sql .= " AND ".$filter;
		}
		$sql .= " ORDER BY PAYMENT_DATE DESC";
		//var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_payment_date($val['PAYMENT_DATE']);
            $d_data->set_invoice_num($val['INVOICE_NUM']);
            $d_data->set_check_date($val['CHECK_DATE']);
            $d_data->set_creation_date($val['CREATION_DATE']);
            $d_data->set_check_number($val['CHECK_NUMBER']);
            $d_data->set_check_number_line_num($val['CHECK_NUMBER_LINE_NUM']);
            $d_data->set_check_amount($val['CHECK_AMOUNT']);
            $d_data->set_bank_account_name($val['BANK_ACCOUNT_NAME']);
            $d_data->set_bank_name($val['BANK_NAME']);
            $d_data->set_vendor_ext_bank_account_num($val['VENDOR_EXT_BANK_ACCOUNT_NUM']);
            $d_data->set_vendor_name($val['VENDOR_NAME']);
            $d_data->set_invoice_description($val['INVOICE_DESCRIPTION']);
            $d_data->set_ftp_file_name($val['FTP_FILE_NAME']);
            $d_data->set_return_code($val['RETURN_CODE']);
            $d_data->set_return_desc($val['RETURN_DESC']);
            $d_data->set_kdkppn($val['KDKPPN']);
			$data[] = $d_data;
        }
        return $data;
    }
	
	public function get_sp2d_belum_void($filter) {
		$sql = "SELECT PAYMENT_DATE , INVOICE_NUM, CHECK_DATE, CREATION_DATE, 
				CHECK_NUMBER, CHECK_NUMBER_LINE_NUM, CHECK_AMOUNT, BANK_ACCOUNT_NAME ,
				BANK_NAME, VENDOR_EXT_BANK_ACCOUNT_NUM, VENDOR_NAME, 
				INVOICE_DESCRIPTION, FTP_FILE_NAME, RETURN_DESC, RETURN_CODE, KDKPPN
				FROM " . $this->_table . "
				WHERE KDKPPN = ".Session::get('id_user')." AND FL_VOID <> 1";
		//SP2D = 140181301002823
		$no=0;
		//var_dump($filter);
		foreach ($filter as $filter) {
			$sql .= " AND ".$filter;
		}
		$sql .= " ORDER BY PAYMENT_DATE DESC";
		//var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_payment_date($val['PAYMENT_DATE']);
            $d_data->set_invoice_num($val['INVOICE_NUM']);
            $d_data->set_check_date($val['CHECK_DATE']);
            $d_data->set_creation_date($val['CREATION_DATE']);
            $d_data->set_check_number($val['CHECK_NUMBER']);
            $d_data->set_check_number_line_num($val['CHECK_NUMBER_LINE_NUM']);
            $d_data->set_check_amount($val['CHECK_AMOUNT']);
            $d_data->set_bank_account_name($val['BANK_ACCOUNT_NAME']);
            $d_data->set_bank_name($val['BANK_NAME']);
            $d_data->set_vendor_ext_bank_account_num($val['VENDOR_EXT_BANK_ACCOUNT_NUM']);
            $d_data->set_vendor_name($val['VENDOR_NAME']);
            $d_data->set_invoice_description($val['INVOICE_DESCRIPTION']);
            $d_data->set_ftp_file_name($val['FTP_FILE_NAME']);
            $d_data->set_return_code($val['RETURN_CODE']);
            $d_data->set_return_desc($val['RETURN_DESC']);
            $d_data->set_kdkppn($val['KDKPPN']);
			$data[] = $d_data;
        }
        return $data;
    }
	
	public function get_sp2d_sudah_void($filter) {
		$sql = "SELECT PAYMENT_DATE , INVOICE_NUM, CHECK_DATE, CREATION_DATE, 
				CHECK_NUMBER, CHECK_NUMBER_LINE_NUM, CHECK_AMOUNT, BANK_ACCOUNT_NAME ,
				BANK_NAME, VENDOR_EXT_BANK_ACCOUNT_NUM, VENDOR_NAME, 
				INVOICE_DESCRIPTION, FTP_FILE_NAME, RETURN_DESC, RETURN_CODE, KDKPPN
				FROM " . $this->_table . "
				WHERE KDKPPN = ".Session::get('id_user')." AND FL_VOID <> 1";
		//SP2D = 140181301002823
		$no=0;
		//var_dump($filter);
		foreach ($filter as $filter) {
			$sql .= " AND ".$filter;
		}
		$sql .= " ORDER BY PAYMENT_DATE DESC";
		//var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_payment_date($val['PAYMENT_DATE']);
            $d_data->set_invoice_num($val['INVOICE_NUM']);
            $d_data->set_check_date($val['CHECK_DATE']);
            $d_data->set_creation_date($val['CREATION_DATE']);
            $d_data->set_check_number($val['CHECK_NUMBER']);
            $d_data->set_check_number_line_num($val['CHECK_NUMBER_LINE_NUM']);
            $d_data->set_check_amount($val['CHECK_AMOUNT']);
            $d_data->set_bank_account_name($val['BANK_ACCOUNT_NAME']);
            $d_data->set_bank_name($val['BANK_NAME']);
            $d_data->set_vendor_ext_bank_account_num($val['VENDOR_EXT_BANK_ACCOUNT_NUM']);
            $d_data->set_vendor_name($val['VENDOR_NAME']);
            $d_data->set_invoice_description($val['INVOICE_DESCRIPTION']);
            $d_data->set_ftp_file_name($val['FTP_FILE_NAME']);
            $d_data->set_return_code($val['RETURN_CODE']);
            $d_data->set_return_desc($val['RETURN_DESC']);
            $d_data->set_kdkppn($val['KDKPPN']);
			$data[] = $d_data;
        }
        return $data;
    }
	
    /*
     * setter
     */

    public function set_payment_date($payment_date) {
        $this->_payment_date = $payment_date;
    }
	
    public function set_invoice_num($invoice_num) {
        $this->_invoice_num = $invoice_num;
    }
	
    public function set_check_date($check_date) {
        $this->_check_date = $check_date;
    }
	
    public function set_creation_date($creation_date) {
        $this->_creation_date = $creation_date;
    }
	
    public function set_check_number($check_number) {
        $this->_check_number = $check_number;
    }
	
    public function set_check_number_line_num($check_number_line_num) {
        $this->_check_number_line_num = $check_number_line_num;
    }
	
    public function set_check_amount($check_amount) {
        $this->_check_amount = $check_amount;
    }
	
    public function set_bank_account_name($bank_account_name) {
        $this->_bank_account_name = $bank_account_name;
    }
	
    public function set_bank_name($bank_name) {
        $this->_bank_name = $bank_name;
    }
	
    public function set_vendor_ext_bank_account_num($vendor_ext_bank_account_num) {
        $this->_vendor_ext_bank_account_num = $vendor_ext_bank_account_num;
    }
	
    public function set_vendor_name($vendor_name) {
        $this->_vendor_name = $vendor_name;
    }
	
    public function set_invoice_description($invoice_description) {
        $this->_invoice_description = $invoice_description;
    }
	
    public function set_ftp_file_name($ftp_file_name) {
        $this->_ftp_file_name = $ftp_file_name;
    }
	
    public function set_return_desc($return_desc) {
        $this->_return_desc = $return_desc;
    }
	
    public function set_return_code($return_code) {
        $this->_return_code = $return_code;
    }
	
    public function set_kdkppn($kdkppn) {
        $this->_kdkppn = $kdkppn;
    }
	
    public function set_fl_void($fl_void) {
        $this->_fl_void = $fl_void;
    }
		
	/*
     * getter
     */
	
	public function get_payment_date() {
        return $this->_payment_date;
    }
	
	public function get_invoice_num() {
        return $this->_invoice_num;
    }
	
	public function get_check_date() {
        return $this->_check_date;
    }
	
	public function get_creation_date() {
        return $this->_creation_date;
    }
	
	public function get_check_number() {
        return $this->_check_number;
    }
	
	public function get_check_number_line_num() {
        return $this->_check_number_line_num;
    }
	
	public function get_check_amount() {
        return $this->_check_amount;
    }
	
	public function get_bank_account_name() {
        return $this->_bank_account_name;
    }
	
	public function get_bank_name() {
        return $this->_bank_name;
    }
	
	public function get_vendor_ext_bank_account_num() {
        return $this->_vendor_ext_bank_account_num;
    }
	
	public function get_vendor_name() {
        return $this->_vendor_name;
    }
	
	public function get_invoice_description() {
        return $this->_invoice_description;
    }
	
	public function get_ftp_file_name() {
        return $this->_ftp_file_name;
    }
	
	public function get_return_code() {
        return $this->_return_code;
    }
	
	public function get_return_desc() {
        return $this->_return_desc;
    }
	
	public function get_kdkppn() {
        return $this->_kdkppn;
    }
	
	public function get_fl_void() {
        return $this->_fl_void;
    }

    /*
     * destruktor
     */

    public function __destruct() {
        
    }

}