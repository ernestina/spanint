<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataRetur {

    private $db;
	private $_kdkppn;
	private $_kdsatker;
	private $_nmsatker;
    private $_receipt_number;
    private $_sp2d_number;
	private $_statement_date;
    private $_amount;
	private $_vendor_ext_bank_account_num;
	private $_vendor_name;
    private $_bank_account_name;
	private $_bank_name;
	private $_invoice_description;
    private $_tgl_retur;
	private $_keterangan_retur;
	private $_nosp2d_pengganti;
    private $_tgsp2d_pengganti;
	private $_tgl_proses_sp2d_pengganti;
    private $_nilai_sp2d_pengganti;
    private $_bank_name_pengganti;
    private $_vendor_name_pengganti;
    private $_vendor_account_num_pengganti;
	private $_status_retur;
    private $_error;
    private $_valid = TRUE;
    private $_table = 'RETUR_SPAN_V';
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
    
    public function get_retur_filter($filter) {
		$sql = "SELECT KDKPPN, KDSATKER, NMSATKER,  RECEIPT_NUMBER, SP2D_NUMBER, 
				STATEMENT_DATE, AMOUNT, VENDOR_EXT_BANK_ACCOUNT_NUM,
				VENDOR_NAME, BANK_ACCOUNT_NAME, BANK_NAME,
				INVOICE_DESCRIPTION, TGL_RETUR, KETERANGAN_RETUR, NOSP2D_PENGGANTI,
				TGSP2D_PENGGANTI, TGL_PROSES_SP2D_PENGGANTI, NILAI_SP2D_PENGGANTI,
				BANK_NAME_PENGGANTI, VENDOR_NAME_PENGGANTI, VENDOR_ACCOUNT_NUM_PENGGANTI,			
				STATUS_RETUR
				FROM " . $this->_table . "
				WHERE 1=1 ";
		//SP2D = 140181301002823
		//xml = 520002000990_SP2D_O_20140408_101509_367.xml
		$no=0;
		//var_dump($filter);
		foreach ($filter as $filter) {
			$sql .= " AND ".$filter;
		}
		$sql .= " ORDER BY STATEMENT_DATE DESC";
		//var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_kdkppn($val['KDKPPN']);
            $d_data->set_kdsatker($val['KDSATKER']);
            $d_data->set_nmsatker($val['NMSATKER']);
            $d_data->set_receipt_number($val['RECEIPT_NUMBER']);
            $d_data->set_sp2d_number($val['SP2D_NUMBER']);
            $d_data->set_statement_date(date("d-m-Y",strtotime($val['STATEMENT_DATE'])));
            $d_data->set_amount(number_format($val['AMOUNT']));
            $d_data->set_vendor_ext_bank_account_num($val['VENDOR_EXT_BANK_ACCOUNT_NUM']);
            $d_data->set_vendor_name($val['VENDOR_NAME']);
            $d_data->set_bank_account_name($val['BANK_ACCOUNT_NAME']);
            $d_data->set_bank_name($val['BANK_NAME']);
            $d_data->set_invoice_description($val['INVOICE_DESCRIPTION']);
            $d_data->set_tgl_retur($val['TGL_RETUR']);
            $d_data->set_keterangan_retur($val['KETERANGAN_RETUR']);
            $d_data->set_nosp2d_pengganti($val['NOSP2D_PENGGANTI']);
			if ($val['TGSP2D_PENGGANTI']!=''){
				$d_data->set_tgsp2d_pengganti(date("d-m-Y",strtotime($val['TGSP2D_PENGGANTI'])));
			} else {
				$d_data->set_tgsp2d_pengganti('');
			}
			if ($val['TGL_PROSES_SP2D_PENGGANTI']!=''){
				$d_data->set_tgl_proses_sp2d_pengganti(date("d-m-Y",strtotime($val['TGL_PROSES_SP2D_PENGGANTI'])));
			} else {
				$d_data->set_tgl_proses_sp2d_pengganti('');
			}
            $d_data->set_nilai_sp2d_pengganti(number_format($val['NILAI_SP2D_PENGGANTI']));
            $d_data->set_bank_name_pengganti($val['BANK_NAME_PENGGANTI']);
            $d_data->set_vendor_name_pengganti($val['VENDOR_NAME_PENGGANTI']);
            $d_data->set_vendor_account_num_pengganti($val['VENDOR_ACCOUNT_NUM_PENGGANTI']);
            $d_data->set_status_retur($val['STATUS_RETUR']);
			$data[] = $d_data;
        }
        return $data;
    }
	
	public function get_retur_pkn_filter($filter) {
		$sql = "SELECT STATEMENT_DATE, RECEIPT_NUMBER, TGSP2D_PENGGANTI ,NOSP2D_PENGGANTI, 
				AMOUNT, NILAI_SP2D_PENGGANTI, (AMOUNT-NILAI_SP2D_PENGGANTI) SALDO  
				FROM " . $this->_table . "
				WHERE 1=1 ";
		//SP2D = 140181301002823
		//xml = 520002000990_SP2D_O_20140408_101509_367.xml
		$no=0;
		//var_dump($filter);
		foreach ($filter as $filter) {
			$sql .= " AND ".$filter;
		}
		$sql .= " ORDER BY STATEMENT_DATE";
		//var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_statement_date(date("d-m-Y",strtotime($val['STATEMENT_DATE'])));
            $d_data->set_receipt_number($val['RECEIPT_NUMBER']);
            $d_data->set_nosp2d_pengganti($val['NOSP2D_PENGGANTI']);
			if ($val['TGSP2D_PENGGANTI']!=''){
				$d_data->set_tgsp2d_pengganti(date("d-m-Y",strtotime($val['TGSP2D_PENGGANTI'])));
			} else {
				$d_data->set_tgsp2d_pengganti('');
			}
            $d_data->set_amount($val['AMOUNT']);
            $d_data->set_nilai_sp2d_pengganti($val['NILAI_SP2D_PENGGANTI']);
			$data[] = $d_data;
        }
        return $data;
    }
	
    /*
     * setter
     */
	
    public function set_kdkppn($kdkppn) {
        $this->_kdkppn = $kdkppn;
    }
	
    public function set_kdsatker($kdsatker) {
        $this->_kdsatker = $kdsatker;
    }
	
    public function set_nmsatker($nmsatker) {
        $this->_nmsatker = $nmsatker;
    }
	
    public function set_receipt_number($receipt_number) {
        $this->_receipt_number = $receipt_number;
    }
	
    public function set_sp2d_number($sp2d_number) {
        $this->_sp2d_number = $sp2d_number;
    }

    public function set_statement_date($statement_date) {
        $this->_statement_date = $statement_date;
    }
	
    public function set_amount($amount) {
        $this->_amount = $amount;
    }
	
    public function set_vendor_ext_bank_account_num($vendor_ext_bank_account_num) {
        $this->_vendor_ext_bank_account_num = $vendor_ext_bank_account_num;
    }
	
    public function set_vendor_name($vendor_name) {
        $this->_vendor_name = $vendor_name;
    }
	
    public function set_bank_account_name($bank_account_name) {
        $this->_bank_account_name = $bank_account_name;
    }
	
    public function set_bank_name($bank_name) {
        $this->_bank_name = $bank_name;
    }
	
    public function set_invoice_description($invoice_description) {
        $this->_invoice_description = $invoice_description;
    }
	
    public function set_tgl_retur($tgl_retur) {
        $this->_tgl_retur = $tgl_retur;
    }
	
    public function set_keterangan_retur($keterangan_retur) {
        $this->_keterangan_retur = $keterangan_retur;
    }
	
    public function set_nosp2d_pengganti($nosp2d_pengganti) {
        $this->_nosp2d_pengganti = $nosp2d_pengganti;
    }
	
    public function set_tgsp2d_pengganti($tgsp2d_pengganti) {
        $this->_tgsp2d_pengganti = $tgsp2d_pengganti;
    }
	
    public function set_tgl_proses_sp2d_pengganti($tgl_proses_sp2d_pengganti) {
        $this->_tgl_proses_sp2d_pengganti = $tgl_proses_sp2d_pengganti;
    }
	
    public function set_nilai_sp2d_pengganti($nilai_sp2d_pengganti) {
        $this->_nilai_sp2d_pengganti = $nilai_sp2d_pengganti;
    }
	
    public function set_bank_name_pengganti($bank_name_pengganti) {
        $this->_bank_name_pengganti = $bank_name_pengganti;
    }
	
    public function set_vendor_name_pengganti($vendor_name_pengganti) {
        $this->_vendor_name_pengganti = $vendor_name_pengganti;
    }
	
    public function set_vendor_account_num_pengganti($vendor_account_num_pengganti) {
        $this->_vendor_account_num_pengganti = $vendor_account_num_pengganti;
    }
	
    public function set_status_retur($status_retur) {
        $this->_status_retur = $status_retur;
    }
		
	/*
     * getter
     */
	
	public function get_kdkppn() {
        return $this->_kdkppn;
    }
	
	public function get_kdsatker() {
        return $this->_kdsatker;
    }
	
	public function get_nmsatker() {
        return $this->_nmsatker;
    }
	
	public function get_receipt_number() {
        return $this->_receipt_number;
    }
	
	public function get_sp2d_number() {
        return $this->_sp2d_number;
    }
	
	public function get_statement_date() {
        return $this->_statement_date;
    }
	
	public function get_amount() {
        return $this->_amount;
    }
	
	public function get_vendor_ext_bank_account_num() {
        return $this->_vendor_ext_bank_account_num;
    }
	
	public function get_vendor_name() {
        return $this->_vendor_name;
    }
	
	public function get_bank_account_name() {
        return $this->_bank_account_name;
    }
	
	public function get_bank_name() {
        return $this->_bank_name;
    }
	
	public function get_invoice_description() {
        return $this->_invoice_description;
    }
	
	public function get_tgl_retur() {
        return $this->_tgl_retur;
    }
	
	public function get_keterangan_retur() {
        return $this->_keterangan_retur;
    }
	
	public function get_nosp2d_pengganti() {
        return $this->_nosp2d_pengganti;
    }
	
	public function get_tgsp2d_pengganti() {
        return $this->_tgsp2d_pengganti;
    }
	
	public function get_tgl_proses_sp2d_pengganti() {
        return $this->_tgl_proses_sp2d_pengganti;
    }
	
	public function get_nilai_sp2d_pengganti() {
        return $this->_nilai_sp2d_pengganti;
    }
	
	public function get_bank_name_pengganti() {
        return $this->_bank_name_pengganti;
    }
	
	public function get_vendor_name_pengganti() {
        return $this->_vendor_name_pengganti;
    }
	
	public function get_vendor_account_num_pengganti() {
        return $this->_vendor_account_num_pengganti;
    }
	
	public function get_status_retur() {
        return $this->_status_retur;
    }
	
	public function get_table() {
        return $this->_table;
    }

    /*
     * destruktor
     */

    public function __destruct() {
        
    }

}