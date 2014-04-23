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
	private $_kdsatker;
	private $_fl_void;
	private $_bulan;
	private $_jumlah_sp2d;
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
		$sql = "SELECT PAYMENT_DATE , INVOICE_NUM, CHECK_DATE, to_char(CREATION_DATE,'dd-mm-yyy hh:mi:ss') CREATION_DATE, 
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
		$sql .= " ORDER BY PAYMENT_DATE ASC";
		//var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_payment_date(date("d-m-Y",strtotime($val['PAYMENT_DATE'])));
            $d_data->set_invoice_num($val['INVOICE_NUM']);
            $d_data->set_check_date(date("d-m-Y",strtotime($val['CHECK_DATE'])));
            $d_data->set_creation_date($val['CREATION_DATE']);
            $d_data->set_check_number($val['CHECK_NUMBER']);
            $d_data->set_check_number_line_num($val['CHECK_NUMBER_LINE_NUM']);
            $d_data->set_check_amount(number_format($val['CHECK_AMOUNT']));
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
		$sql = "SELECT PAYMENT_DATE , INVOICE_NUM, CHECK_DATE, to_char(CREATION_DATE,'dd-mm-yyy hh:mi:ss') CREATION_DATE,
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
		$sql .= " ORDER BY PAYMENT_DATE ASC";
		//var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_payment_date(date("d-m-Y",strtotime($val['PAYMENT_DATE'])));
            $d_data->set_invoice_num($val['INVOICE_NUM']);
            $d_data->set_check_date(date("d-m-Y",strtotime($val['CHECK_DATE'])));
            $d_data->set_creation_date($val['CREATION_DATE']);
            $d_data->set_check_number($val['CHECK_NUMBER']);
            $d_data->set_check_number_line_num($val['CHECK_NUMBER_LINE_NUM']);
            $d_data->set_check_amount(number_format($val['CHECK_AMOUNT']));
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
		$sql = "SELECT PAYMENT_DATE , INVOICE_NUM, CHECK_DATE, to_char(CREATION_DATE,'dd-mm-yyy hh:mi:ss') CREATION_DATE, 
				CHECK_NUMBER, CHECK_NUMBER_LINE_NUM, CHECK_AMOUNT, BANK_ACCOUNT_NAME ,
				BANK_NAME, VENDOR_EXT_BANK_ACCOUNT_NUM, VENDOR_NAME, 
				INVOICE_DESCRIPTION, FTP_FILE_NAME, RETURN_DESC, RETURN_CODE, KDKPPN
				FROM " . $this->_table . "
				WHERE KDKPPN = '".Session::get('id_user')."' AND FL_VOID <> 1 ";
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
            $d_data->set_payment_date(date("d-m-Y",strtotime($val['PAYMENT_DATE'])));
            $d_data->set_invoice_num($val['INVOICE_NUM']);
            $d_data->set_check_date(date("d-m-Y",strtotime($val['CHECK_DATE'])));
            $d_data->set_creation_date($val['CREATION_DATE']);
            $d_data->set_check_number($val['CHECK_NUMBER']);
            $d_data->set_check_number_line_num($val['CHECK_NUMBER_LINE_NUM']);
            $d_data->set_check_amount(number_format($val['CHECK_AMOUNT']));
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
		$sql = "SELECT PAYMENT_DATE , INVOICE_NUM, CHECK_DATE, to_char(CREATION_DATE,'dd-mm-yyy hh:mi:ss') CREATION_DATE,
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
            $d_data->set_payment_date(date("d-m-Y",strtotime($val['PAYMENT_DATE'])));
            $d_data->set_invoice_num($val['INVOICE_NUM']);
            $d_data->set_check_date(date("d-m-Y",strtotime($val['CHECK_DATE'])));
            $d_data->set_creation_date($val['CREATION_DATE']);
            $d_data->set_check_number($val['CHECK_NUMBER']);
            $d_data->set_check_number_line_num($val['CHECK_NUMBER_LINE_NUM']);
            $d_data->set_check_amount(number_format($val['CHECK_AMOUNT']));
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
		$sql = "SELECT PAYMENT_DATE , INVOICE_NUM, CHECK_DATE, to_char(CREATION_DATE,'dd-mm-yyy hh:mi:ss') CREATION_DATE,
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
            $d_data->set_payment_date(date("d-m-Y",strtotime($val['PAYMENT_DATE'])));
            $d_data->set_invoice_num($val['INVOICE_NUM']);
            $d_data->set_check_date(date("d-m-Y",strtotime($val['CHECK_DATE'])));
            $d_data->set_creation_date($val['CREATION_DATE']);
            $d_data->set_check_number($val['CHECK_NUMBER']);
            $d_data->set_check_number_line_num($val['CHECK_NUMBER_LINE_NUM']);
            $d_data->set_check_amount(number_format($val['CHECK_AMOUNT']));
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
		$sql = "SELECT PAYMENT_DATE , INVOICE_NUM, CHECK_DATE, to_char(CREATION_DATE,'dd-mm-yyy hh:mi:ss') CREATION_DATE,
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
            $d_data->set_payment_date(date("d-m-Y",strtotime($val['PAYMENT_DATE'])));
            $d_data->set_invoice_num($val['INVOICE_NUM']);
            $d_data->set_check_date(date("d-m-Y",strtotime($val['CHECK_DATE'])));
            $d_data->set_creation_date($val['CREATION_DATE']);
            $d_data->set_check_number($val['CHECK_NUMBER']);
            $d_data->set_check_number_line_num($val['CHECK_NUMBER_LINE_NUM']);
            $d_data->set_check_amount(number_format($val['CHECK_AMOUNT']));
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
		$sql = "SELECT PAYMENT_DATE , INVOICE_NUM, CHECK_DATE, to_char(CREATION_DATE,'dd-mm-yyy hh:mi:ss') CREATION_DATE,
				CHECK_NUMBER, CHECK_NUMBER_LINE_NUM, CHECK_AMOUNT, BANK_ACCOUNT_NAME ,
				BANK_NAME, VENDOR_EXT_BANK_ACCOUNT_NUM, VENDOR_NAME, 
				INVOICE_DESCRIPTION, FTP_FILE_NAME, RETURN_DESC, RETURN_CODE, KDKPPN
				FROM " . $this->_table . "
				WHERE KDKPPN = ".Session::get('id_user')." AND FL_VOID = 1";
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
            $d_data->set_payment_date(date("d-m-Y",strtotime($val['PAYMENT_DATE'])));
            $d_data->set_invoice_num($val['INVOICE_NUM']);
            $d_data->set_check_date(date("d-m-Y",strtotime($val['CHECK_DATE'])));
            $d_data->set_creation_date($val['CREATION_DATE']);
            $d_data->set_check_number($val['CHECK_NUMBER']);
            $d_data->set_check_number_line_num($val['CHECK_NUMBER_LINE_NUM']);
            $d_data->set_check_amount(number_format($val['CHECK_AMOUNT']));
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
		$sql = "SELECT PAYMENT_DATE , INVOICE_NUM, CHECK_DATE, to_char(CREATION_DATE,'dd-mm-yyy hh:mi:ss') CREATION_DATE,
				CHECK_NUMBER, CHECK_NUMBER_LINE_NUM, CHECK_AMOUNT, BANK_ACCOUNT_NAME ,
				BANK_NAME, VENDOR_EXT_BANK_ACCOUNT_NUM, VENDOR_NAME, 
				INVOICE_DESCRIPTION, FTP_FILE_NAME, RETURN_DESC, RETURN_CODE, KDKPPN
				FROM " . $this->_table . "
				WHERE KDKPPN = ".Session::get('id_user')." AND FL_VOID = 1";
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
            $d_data->set_payment_date(date("d-m-Y",strtotime($val['PAYMENT_DATE'])));
            $d_data->set_invoice_num($val['INVOICE_NUM']);
            $d_data->set_check_date(date("d-m-Y",strtotime($val['CHECK_DATE'])));
            $d_data->set_creation_date($val['CREATION_DATE']);
            $d_data->set_check_number($val['CHECK_NUMBER']);
            $d_data->set_check_number_line_num($val['CHECK_NUMBER_LINE_NUM']);
            $d_data->set_check_amount(number_format($val['CHECK_AMOUNT']));
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

	public function get_sp2d_gaji_dobel($bulan) {
		$sql = "SELECT DISTINCT KDKPPN, SUBSTR(INVOICE_NUM,8,6) SATKER, INVOICE_NUM, CHECK_NUMBER, INVOICE_DESCRIPTION
				FROM XICO_ALL WHERE KDKPPN = ".Session::get('id_user')." AND UPPER(INVOICE_DESCRIPTION) LIKE '%".$bulan."%' AND CHECK_NUMBER IN ( 
				SELECT CHECK_NUMBER FROM TEMP_GAJI_DOBEL WHERE SUBSTR(INVOICE_NUM,8,6) IN ( SELECT SATKER FROM ( 
				SELECT SUBSTR(INVOICE_NUM,8,6) SATKER, COUNT(INVOICE_NUM) CEK , INVOICE_NUM FROM TEMP_GAJI_DOBEL 
				GROUP BY SUBSTR(INVOICE_NUM,8,6), INVOICE_NUM HAVING COUNT(*) > 1 ))) ORDER BY SUBSTR(INVOICE_NUM,8,6)";
        $result = $this->db->select($sql);
		//var_dump ($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_kdkppn($val['KDKPPN']);
            $d_data->set_kdsatker($val['SATKER']);
            $d_data->set_invoice_num($val['INVOICE_NUM']);
            $d_data->set_check_number($val['CHECK_NUMBER']);
            $d_data->set_invoice_description($val['INVOICE_DESCRIPTION']);
			$data[] = $d_data;
        }
		//var_dump ($this->db->select($sql));
        return $data;
    }

	public function get_sp2d_gaji_tanggal() {
		$sql = "SELECT DISTINCT  KDKPPN, SUBSTR(INVOICE_NUM,8,6) SATKER, INVOICE_NUM, CHECK_NUMBER, PAYMENT_DATE, CREATION_DATE, INVOICE_DESCRIPTION FROM (
				SELECT KDKPPN,PAYMENT_DATE , INVOICE_NUM, CHECK_DATE, CREATION_DATE, CHECK_NUMBER, CHECK_NUMBER_LINE_NUM, CHECK_AMOUNT, BANK_ACCOUNT_NAME 
				,BANK_NAME, VENDOR_EXT_BANK_ACCOUNT_NUM, VENDOR_NAME, INVOICE_DESCRIPTION, FTP_FILE_NAME, RETURN_DESC, RETURN_CODE
				FROM XICO_ALL
				WHERE ( BANK_ACCOUNT_NAME LIKE '%gaji-BNI%' OR 
						BANK_ACCOUNT_NAME LIKE '%GAJI-BTN%' OR 
						BANK_ACCOUNT_NAME LIKE '%GAJI-MDRI%' OR
						BANK_ACCOUNT_NAME LIKE '%GAJI BRI%' )
					  AND CREATION_DATE BETWEEN TO_DATE('20140102','YYYYMMDD')  AND TO_DATE('20141231','YYYYMMDD')
					  AND TO_CHAR(CHECK_DATE,'YYYYMMDD') <> '20140401'
					  AND UPPER(INVOICE_DESCRIPTION) LIKE '%APRIL%' 
					  AND UPPER(INVOICE_DESCRIPTION) LIKE '%GAJI%' 
					  AND UPPER(INVOICE_DESCRIPTION) NOT LIKE '%RETUR%' 
					  AND BANK_ACCOUNT_NAME NOT LIKE '%RETUR%'
					  AND KDKPPN = ".Session::get('id_user')."
				)
				ORDER BY KDKPPN, SATKER, INVOICE_NUM";
        $result = $this->db->select($sql);
		//var_dump ($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_kdkppn($val['KDKPPN']);
            $d_data->set_kdsatker($val['SATKER']);
            $d_data->set_invoice_num($val['INVOICE_NUM']);
            $d_data->set_check_number($val['CHECK_NUMBER']);
			$d_data->set_payment_date(date("d-m-Y",strtotime($val['PAYMENT_DATE'])));
            $d_data->set_creation_date(date("d-m-Y h:m:s",strtotime($val['CREATION_DATE'])));
            $d_data->set_invoice_description($val['INVOICE_DESCRIPTION']);
			$data[] = $d_data;
        }
        return $data;
    }
	
	public function get_sp2d_gaji_bank() {
		$sql = "SELECT DISTINCT KDKPPN, SUBSTR(INVOICE_NUM,8,6) SATKER, INVOICE_NUM, CHECK_NUMBER,VENDOR_EXT_BANK_ACCOUNT_NUM, VENDOR_NAME, PAYMENT_DATE, CREATION_DATE, BANK_ACCOUNT_NAME, BANK_NAME, INVOICE_DESCRIPTION FROM (
                SELECT KDKPPN, PAYMENT_DATE , INVOICE_NUM, CHECK_DATE, CREATION_DATE, CHECK_NUMBER, CHECK_NUMBER_LINE_NUM, CHECK_AMOUNT, BANK_ACCOUNT_NAME ,BANK_NAME, VENDOR_EXT_BANK_ACCOUNT_NUM, VENDOR_NAME, INVOICE_DESCRIPTION, FTP_FILE_NAME, RETURN_DESC, RETURN_CODE
                FROM XICO_ALL
                WHERE ( BANK_ACCOUNT_NAME LIKE '%gaji-BNI%' OR 
                        BANK_ACCOUNT_NAME LIKE '%GAJI-BTN%' OR 
                        BANK_ACCOUNT_NAME LIKE '%GAJI-MDRI%' OR
                        BANK_ACCOUNT_NAME LIKE '%GAJI BRI%' 
                      )
                      AND CREATION_DATE BETWEEN TO_DATE('20140102','YYYYMMDD')  AND TO_DATE('20141231','YYYYMMDD')
                      AND UPPER(INVOICE_DESCRIPTION) LIKE '%APRIL%'    
                      AND UPPER(INVOICE_DESCRIPTION) NOT LIKE '%RETUR%' 
                      AND BANK_ACCOUNT_NAME NOT LIKE '%RETUR%'
					  AND KDKPPN = ".Session::get('id_user')."
                      AND TRIM(BANK_ACCOUNT_NAME)||'@'||TRIM(BANK_NAME) NOT IN (
                        'RPKBUNP.GAJI-BTN@BANK TABUNGAN NEGARA',
                        'RPKBUNP GAJI BRI@BANK RAKYAT INDONESIA',
                        'RPKBUNP GAJI-MDRI@BANK MANDIRI',
                        'RPKBUNP.gaji-BNI@BANK NEGARA INDONESIA'
                        )        
                )
                ORDER BY KDKPPN, SATKER, INVOICE_NUM, CHECK_NUMBER DESC";
        $result = $this->db->select($sql);
		//var_dump($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_kdkppn($val['KDKPPN']);
            $d_data->set_kdsatker($val['SATKER']);
            $d_data->set_invoice_num($val['INVOICE_NUM']);
            $d_data->set_check_number($val['CHECK_NUMBER']);
            $d_data->set_vendor_ext_bank_account_num($val['VENDOR_EXT_BANK_ACCOUNT_NUM']);
            $d_data->set_vendor_name($val['VENDOR_NAME']);
            $d_data->set_bank_account_name($val['BANK_ACCOUNT_NAME']);
            $d_data->set_bank_name($val['BANK_NAME']);
            $d_data->set_invoice_description($val['INVOICE_DESCRIPTION']);
			$data[] = $d_data;
        }
        return $data;
    }
	
	public function get_sp2d_gaji_rekening() {
		$sql = "SELECT DISTINCT SUBSTR(INVOICE_NUM,8,6) SATKER, KDKPPN, INVOICE_NUM, CHECK_NUMBER, PAYMENT_DATE, CREATION_DATE, BANK_ACCOUNT_NAME, INVOICE_DESCRIPTION FROM (
                SELECT KDKPPN,PAYMENT_DATE , INVOICE_NUM, CHECK_DATE, CREATION_DATE, CHECK_NUMBER, CHECK_NUMBER_LINE_NUM, CHECK_AMOUNT, BANK_ACCOUNT_NAME ,BANK_NAME, VENDOR_EXT_BANK_ACCOUNT_NUM, VENDOR_NAME, INVOICE_DESCRIPTION, FTP_FILE_NAME, RETURN_DESC, RETURN_CODE
                FROM XICO_ALL
                WHERE BANK_ACCOUNT_NAME NOT IN ( 'RPKBUNP.gaji-BNI','RPKBUNP.GAJI-BTN','RPKBUNP GAJI-MDRI','RPKBUNP GAJI BRI') 
                      AND CREATION_DATE BETWEEN TO_DATE('20140102','YYYYMMDD')  AND TO_DATE('20141231','YYYYMMDD')
                      AND UPPER(INVOICE_DESCRIPTION) LIKE '%APRIL%'
                      AND UPPER(INVOICE_DESCRIPTION) LIKE '%GAJI%'
                      AND UPPER(INVOICE_DESCRIPTION) NOT LIKE '%KEKURANGAN%'
                      AND UPPER(INVOICE_DESCRIPTION) NOT LIKE '%SUSULAN%'
                      AND UPPER(INVOICE_DESCRIPTION) NOT LIKE '%TERUSAN%'
                      AND UPPER(INVOICE_DESCRIPTION) NOT LIKE '%WARAKAWURI%'
                      AND BANK_ACCOUNT_NAME NOT LIKE '%RETUR%'    
					  AND KDKPPN = ".Session::get('id_user')."
                )
                ORDER BY KDKPPN, SATKER, CHECK_NUMBER DESC ";
        $result = $this->db->select($sql);
		//var_dump ($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_kdkppn($val['KDKPPN']);
            $d_data->set_kdsatker($val['SATKER']);
            $d_data->set_invoice_num($val['INVOICE_NUM']);
            $d_data->set_check_number($val['CHECK_NUMBER']);
            $d_data->set_bank_account_name($val['BANK_ACCOUNT_NAME']);
            $d_data->set_invoice_description($val['INVOICE_DESCRIPTION']);
			$data[] = $d_data;
        }
        return $data;
    }
	
	public function get_sp2d_gaji_bulan_lalu() {
		$sql = "SELECT DECODE(TRIM(BANK_ACCOUNT_NAME),'RPKBUNP GAJI-MDRI','BANK MANDIRI',
					'RPKBUNP.GAJI-BTN','BANK TABUNGAN NEGARA','RPKBUNP.gaji-BNI','BANK NEGARA INDONESIA','RPKBUNP GAJI BRI','BANK RAKYAT INDONESIA','INVALID') BANK
					, MAX(JANUARI) JANUARI
					, MAX(FEBRUARI) FEBRUARI
					, MAX(MARET) MARET
					, MAX(APRIL) APRIL
					, MAX(MEI) MEI
					, MAX(JUNI) JUNI 
					, MAX(JULI) JULI
					, MAX(AGUSTUS) AGUSTUS
					, MAX(SEPTEMBER) SEPTEMBER
					, MAX(OKTOBER) OKTOBER
					, MAX(NOVEMBER) NOVEMBER
					, MAX(DESEMBER) DESEMBER
					FROM (
					SELECT COUNT(DISTINCT (INVOICE_NUM)) as JANUARI, NULL FEBRUARI,  NULL MARET,  NULL APRIL, NULL MEI, NULL JUNI, NULL JULI, NULL AGUSTUS, NULL SEPTEMBER, NULL OKTOBER, NULL NOVEMBER, NULL DESEMBER, BANK_ACCOUNT_NAME FROM XICO_ALL 
							WHERE ( BANK_ACCOUNT_NAME LIKE '%gaji-BNI%' OR 
							BANK_ACCOUNT_NAME LIKE '%GAJI-BTN%' OR 
							BANK_ACCOUNT_NAME LIKE '%GAJI-MDRI%' OR
							BANK_ACCOUNT_NAME LIKE '%GAJI BRI%' )
                            AND TO_CHAR(PAYMENT_DATE,'MM') = '01'
							AND BANK_ACCOUNT_NAME NOT LIKE '%RETUR%'
							AND KDKPPN = ".Session::get('id_user')."
							GROUP BY  BANK_ACCOUNT_NAME
							UNION 
					SELECT NULL JANUARI,  COUNT(DISTINCT (INVOICE_NUM)) as FEBRUARI, NULL MARET,  NULL APRIL, NULL MEI, NULL JUNI, NULL JULI, NULL AGUSTUS, NULL SEPTEMBER, NULL OKTOBER, NULL NOVEMBER, NULL DESEMBER,BANK_ACCOUNT_NAME FROM XICO_ALL 
							WHERE ( BANK_ACCOUNT_NAME LIKE '%gaji-BNI%' OR 
							BANK_ACCOUNT_NAME LIKE '%GAJI-BTN%' OR 
							BANK_ACCOUNT_NAME LIKE '%GAJI-MDRI%' OR
							BANK_ACCOUNT_NAME LIKE '%GAJI BRI%' )
                            AND TO_CHAR(PAYMENT_DATE,'MM') = '02' 
							AND BANK_ACCOUNT_NAME NOT LIKE '%RETUR%'
							AND KDKPPN = ".Session::get('id_user')."
							GROUP BY  BANK_ACCOUNT_NAME
							UNION 
					SELECT NULL JANUARI, NULL FEBRUARI, COUNT(DISTINCT (INVOICE_NUM)) as MARET,  NULL APRIL, NULL MEI, NULL JUNI, NULL JULI, NULL AGUSTUS, NULL SEPTEMBER, NULL OKTOBER, NULL NOVEMBER, NULL DESEMBER,BANK_ACCOUNT_NAME FROM XICO_ALL 
							WHERE ( BANK_ACCOUNT_NAME LIKE '%gaji-BNI%' OR 
							BANK_ACCOUNT_NAME LIKE '%GAJI-BTN%' OR 
							BANK_ACCOUNT_NAME LIKE '%GAJI-MDRI%' OR
							BANK_ACCOUNT_NAME LIKE '%GAJI BRI%' )
                            AND TO_CHAR(PAYMENT_DATE,'MM') = '03'
							AND BANK_ACCOUNT_NAME NOT LIKE '%RETUR%'
							AND KDKPPN = ".Session::get('id_user')."
							GROUP BY  BANK_ACCOUNT_NAME
							UNION 
					SELECT NULL JANUARI, NULL FEBRUARI,  NULL MARET, COUNT(DISTINCT (INVOICE_NUM)) as APRIL, NULL MEI, NULL JUNI, NULL JULI, NULL AGUSTUS, NULL SEPTEMBER, NULL OKTOBER, NULL NOVEMBER, NULL DESEMBER,BANK_ACCOUNT_NAME FROM XICO_ALL 
							WHERE ( BANK_ACCOUNT_NAME LIKE '%gaji-BNI%' OR 
							BANK_ACCOUNT_NAME LIKE '%GAJI-BTN%' OR 
							BANK_ACCOUNT_NAME LIKE '%GAJI-MDRI%' OR
							BANK_ACCOUNT_NAME LIKE '%GAJI BRI%' )
                            AND TO_CHAR(PAYMENT_DATE,'MM') = '04'
							AND BANK_ACCOUNT_NAME NOT LIKE '%RETUR%'
							AND KDKPPN = ".Session::get('id_user')."
						GROUP BY BANK_ACCOUNT_NAME
							UNION 
					SELECT NULL JANUARI, NULL FEBRUARI,  NULL MARET,  NULL APRIL, COUNT(DISTINCT (INVOICE_NUM)) as MEI, NULL JUNI, NULL JULI, NULL AGUSTUS, NULL SEPTEMBER, NULL OKTOBER, NULL NOVEMBER, NULL DESEMBER,BANK_ACCOUNT_NAME FROM XICO_ALL 
							WHERE ( BANK_ACCOUNT_NAME LIKE '%gaji-BNI%' OR 
							BANK_ACCOUNT_NAME LIKE '%GAJI-BTN%' OR 
							BANK_ACCOUNT_NAME LIKE '%GAJI-MDRI%' OR
							BANK_ACCOUNT_NAME LIKE '%GAJI BRI%' )
                            AND TO_CHAR(PAYMENT_DATE,'MM') = '05'
							AND BANK_ACCOUNT_NAME NOT LIKE '%RETUR%'
							AND KDKPPN = ".Session::get('id_user')."
						GROUP BY BANK_ACCOUNT_NAME
							UNION 
					SELECT NULL JANUARI, NULL FEBRUARI,  NULL MARET,  NULL APRIL, NULL MEI,  COUNT(DISTINCT (INVOICE_NUM)) as JUNI, NULL JULI, NULL AGUSTUS, NULL SEPTEMBER, NULL OKTOBER, NULL NOVEMBER, NULL DESEMBER,BANK_ACCOUNT_NAME FROM XICO_ALL 
							WHERE ( BANK_ACCOUNT_NAME LIKE '%gaji-BNI%' OR 
							BANK_ACCOUNT_NAME LIKE '%GAJI-BTN%' OR 
							BANK_ACCOUNT_NAME LIKE '%GAJI-MDRI%' OR
							BANK_ACCOUNT_NAME LIKE '%GAJI BRI%' )
                            AND TO_CHAR(PAYMENT_DATE,'MM') = '06' 
							AND BANK_ACCOUNT_NAME NOT LIKE '%RETUR%'
							AND KDKPPN = ".Session::get('id_user')."
						GROUP BY BANK_ACCOUNT_NAME
							UNION 
					SELECT NULL JANUARI, NULL FEBRUARI,  NULL MARET,  NULL APRIL, NULL MEI, NULL JUNI,  COUNT(DISTINCT (INVOICE_NUM)) as JULI, NULL AGUSTUS, NULL SEPTEMBER, NULL OKTOBER, NULL NOVEMBER, NULL DESEMBER,BANK_ACCOUNT_NAME FROM XICO_ALL 
							WHERE ( BANK_ACCOUNT_NAME LIKE '%gaji-BNI%' OR 
							BANK_ACCOUNT_NAME LIKE '%GAJI-BTN%' OR 
							BANK_ACCOUNT_NAME LIKE '%GAJI-MDRI%' OR
							BANK_ACCOUNT_NAME LIKE '%GAJI BRI%' )
                            AND TO_CHAR(PAYMENT_DATE,'MM') = '07' 
							AND BANK_ACCOUNT_NAME NOT LIKE '%RETUR%'
							AND KDKPPN = ".Session::get('id_user')."
						GROUP BY BANK_ACCOUNT_NAME
							UNION 
					SELECT NULL JANUARI, NULL FEBRUARI,  NULL MARET,  NULL APRIL, NULL MEI, NULL JUNI, NULL JULI, COUNT(DISTINCT (INVOICE_NUM)) as AGUSTUS, NULL SEPTEMBER, NULL OKTOBER, NULL NOVEMBER, NULL DESEMBER,BANK_ACCOUNT_NAME FROM XICO_ALL 
							WHERE ( BANK_ACCOUNT_NAME LIKE '%gaji-BNI%' OR 
							BANK_ACCOUNT_NAME LIKE '%GAJI-BTN%' OR 
							BANK_ACCOUNT_NAME LIKE '%GAJI-MDRI%' OR
							BANK_ACCOUNT_NAME LIKE '%GAJI BRI%' )
                            AND TO_CHAR(PAYMENT_DATE,'MM') = '08' 
							AND BANK_ACCOUNT_NAME NOT LIKE '%RETUR%'
							AND KDKPPN = ".Session::get('id_user')."
						GROUP BY BANK_ACCOUNT_NAME
							UNION 
					SELECT NULL JANUARI, NULL FEBRUARI,  NULL MARET,  NULL APRIL, NULL MEI, NULL JUNI, NULL JULI, NULL AGUSTUS, COUNT(DISTINCT (INVOICE_NUM)) as SEPTEMBER, NULL OKTOBER, NULL NOVEMBER, NULL DESEMBER,BANK_ACCOUNT_NAME FROM XICO_ALL 
							WHERE ( BANK_ACCOUNT_NAME LIKE '%gaji-BNI%' OR 
							BANK_ACCOUNT_NAME LIKE '%GAJI-BTN%' OR 
							BANK_ACCOUNT_NAME LIKE '%GAJI-MDRI%' OR
							BANK_ACCOUNT_NAME LIKE '%GAJI BRI%' )
                            AND TO_CHAR(PAYMENT_DATE,'MM') = '09' 
							AND BANK_ACCOUNT_NAME NOT LIKE '%RETUR%'
							AND KDKPPN = ".Session::get('id_user')."
						GROUP BY BANK_ACCOUNT_NAME
							UNION 
					SELECT NULL JANUARI, NULL FEBRUARI,  NULL MARET,  NULL APRIL, NULL MEI, NULL JUNI, NULL JULI, NULL AGUSTUS,NULL SEPTEMBER,COUNT(DISTINCT (INVOICE_NUM)) as OKTOBER, NULL NOVEMBER, NULL DESEMBER,BANK_ACCOUNT_NAME FROM XICO_ALL 
							WHERE ( BANK_ACCOUNT_NAME LIKE '%gaji-BNI%' OR 
							BANK_ACCOUNT_NAME LIKE '%GAJI-BTN%' OR 
							BANK_ACCOUNT_NAME LIKE '%GAJI-MDRI%' OR
							BANK_ACCOUNT_NAME LIKE '%GAJI BRI%' )
                            AND TO_CHAR(PAYMENT_DATE,'MM') = '10' 
							AND BANK_ACCOUNT_NAME NOT LIKE '%RETUR%'
							AND KDKPPN = ".Session::get('id_user')."
						GROUP BY BANK_ACCOUNT_NAME
						UNION
					SELECT NULL JANUARI, NULL FEBRUARI,  NULL MARET,  NULL APRIL, NULL MEI, NULL JUNI, NULL JULI, NULL AGUSTUS,NULL SEPTEMBER,NULL OKTOBER,COUNT(DISTINCT (INVOICE_NUM)) as NOVEMBER, NULL DESEMBER,BANK_ACCOUNT_NAME FROM XICO_ALL 
							WHERE ( BANK_ACCOUNT_NAME LIKE '%gaji-BNI%' OR 
							BANK_ACCOUNT_NAME LIKE '%GAJI-BTN%' OR 
							BANK_ACCOUNT_NAME LIKE '%GAJI-MDRI%' OR
							BANK_ACCOUNT_NAME LIKE '%GAJI BRI%' )
                            AND TO_CHAR(PAYMENT_DATE,'MM') = '11'
							AND BANK_ACCOUNT_NAME NOT LIKE '%RETUR%'
							AND KDKPPN = ".Session::get('id_user')."
						GROUP BY BANK_ACCOUNT_NAME
						UNION
					SELECT NULL JANUARI, NULL FEBRUARI,  NULL MARET,  NULL APRIL, NULL MEI, NULL JUNI, NULL JULI, NULL AGUSTUS,NULL SEPTEMBER,NULL OKTOBER,NULL NOVEMBER,COUNT(DISTINCT (INVOICE_NUM)) as DESEMBER, BANK_ACCOUNT_NAME FROM XICO_ALL 
							WHERE ( BANK_ACCOUNT_NAME LIKE '%gaji-BNI%' OR 
							BANK_ACCOUNT_NAME LIKE '%GAJI-BTN%' OR 
							BANK_ACCOUNT_NAME LIKE '%GAJI-MDRI%' OR
							BANK_ACCOUNT_NAME LIKE '%GAJI BRI%' )
                            AND TO_CHAR(PAYMENT_DATE,'MM') = '12' 
							AND BANK_ACCOUNT_NAME NOT LIKE '%RETUR%'
							AND KDKPPN = ".Session::get('id_user')."
						GROUP BY BANK_ACCOUNT_NAME
					) 
				GROUP BY BANK_ACCOUNT_NAME
				ORDER BY BANK_ACCOUNT_NAME DESC";
        $result = $this->db->select($sql);
		//var_dump ($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_payment_date($val['BANK']);
            $d_data->set_invoice_num($val['JANUARI']);
            $d_data->set_check_date($val['FEBRUARI']);
            $d_data->set_creation_date($val['MARET']);
            $d_data->set_check_number($val['APRIL']);
            $d_data->set_check_number_line_num($val['MEI']);
            $d_data->set_check_amount($val['JUNI']);
            $d_data->set_bank_account_name($val['JULI']);
            $d_data->set_bank_name($val['AGUSTUS']);
            $d_data->set_vendor_ext_bank_account_num($val['SEPTEMBER']);
            $d_data->set_vendor_name($val['OKTOBER']);
            $d_data->set_invoice_description($val['NOVEMBER']);
            $d_data->set_ftp_file_name($val['DESEMBER']);
			$data[] = $d_data;
        }
		//var_dump($data);
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
	
    public function set_kdsatker($kdsatker) {
        $this->_kdsatker = $kdsatker;
    }
	
    public function set_fl_void($fl_void) {
        $this->_fl_void = $fl_void;
    }
	
    public function set_bulan($bulan) {
        $this->_bulan = $bulan;
    }
	
    public function set_jumlah_sp2d($jumlah_sp2d) {
        $this->_jumlah_sp2d = $jumlah_sp2d;
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
	
	public function get_kdsatker() {
        return $this->_kdsatker;
    }
	
	public function get_fl_void() {
        return $this->_fl_void;
    }
	
	public function get_bulan() {
        return $this->_bulan;
    }
	
	public function get_jumlah_sp2d() {
        return $this->_jumlah_sp2d;
    }

    /*
     * destruktor
     */

    public function __destruct() {
        
    }

}