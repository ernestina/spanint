<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataADKKonversi {

    private $db;
	private $_file_name_zip;
	private $_file_name;
    private $_invoice_num;
	private $_invoice_date;
    private $_invoice_amount;
	private $_satker;
	private $_kppn;
	private $_jendok;
    private $_conversion_date;
	private $_durasi;
    private $_status_code;  
    private $_jml_invoice;
    private $_jml_pmrt;
    private $_jml_nilai_inv;
    private $_table = 'SPAN_PMRT';
	private $_table1 = 'T_JENDOK';
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
     * return array objek Data Tetap */

    public function get_adk_konversi($filter, $kppn) {		
        Session::get('id_user');				
        $sql = "SELECT SPAN_PMRT.INVOICE_NUM, NETT_AMOUNT INVOICE_AMOUNT, INVOICE_DATE, SUBSTR(PMRT_FILE_NAME,3,29) PMRT_FILE_NAME,  STATUS_UPLOAD, ZIP_FILE_NAME,
				SUBSTR (ZIP_FILE_NAME,8,8) UPLOAD_DATE, KD_SATKER, SPAN_PMRT.DURASI, KDKPPN, URAIAN
				FROM "
                . $this->_table . "  , "
				. $this->_table1 . " , 
				(SELECT INVOICE_NUM ,
					  MAX(SUBSTR(PMRT_FILE_NAME,16,11))DURASI
					FROM SPAN_PMRT
					WHERE PMRT_FILE_NAME   IS NOT NULL
					AND STATUS_UPLOAD      IS NULL					
					AND NETT_AMOUNT NOT IN (1,2,3,4,5)
					 ".$kppn." 
					GROUP BY INVOICE_NUM
				) C
				WHERE 1=1
				AND SPAN_PMRT.JENDOK = T_JENDOK.KDJENDOK
				AND PMRT_FILE_NAME IS NOT NULL
				AND STATUS_UPLOAD IS NULL
				AND NETT_AMOUNT NOT IN (1,2,3,4,5)
				AND SUBSTR(SPAN_PMRT.PMRT_FILE_NAME,16,11)=C.DURASI
				AND SPAN_PMRT.INVOICE_NUM=C.INVOICE_NUM
				"

        ;

        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
		 $sql .= " ORDER BY KDKPPN, SUBSTR  (ZIP_FILE_NAME,8,8) ASC";
        //var_dump ($sql);
        $result = $this->db->select($sql);
		//var_dump ($result);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_invoice_num($val['INVOICE_NUM']);
            $d_data->set_invoice_amount($val['INVOICE_AMOUNT']);
			$d_data->set_invoice_date ($val['INVOICE_DATE']);
            $d_data->set_conversion_date(date("d-M-Y", strtotime($val['UPLOAD_DATE'])));
            $d_data->set_file_name($val['PMRT_FILE_NAME']);            
            $d_data->set_file_name_zip($val['ZIP_FILE_NAME']);
            $d_data->set_satker($val['KD_SATKER']);
            $d_data->set_durasi($val['DURASI']);
			$d_data->set_jendok($val['URAIAN']);
			$d_data->set_kppn($val['KDKPPN']);
            $d_data->set_jml_invoice($val['JML_INVOICE']);
            $d_data->set_jml_pmrt($val['JML_PMRT']);
            $d_data->set_jml_nilai_inv($val['JML_NILAI_INV']);
            $data[] = $d_data;
        }
        return $data;
    }
	
	public function get_jml_adk_konversi($filter) {
        Session::get('id_user');
        $sql = "SELECT COUNT(DISTINCT PMRT_FILE_NAME) JML_PMRT, COUNT(DISTINCT INVOICE_NUM) JML_INVOICE, SUM(NETT_AMOUNT)  JML_NILAI_INV
				FROM "
                . $this->_table . "
				WHERE 1=1 				
				AND PMRT_FILE_NAME IS NOT NULL
				AND STATUS_UPLOAD IS NULL
				AND NETT_AMOUNT NOT IN (1,2,3,4,5)
				"

        ;

        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }

        //var_dump ($sql);
        $result = $this->db->select($sql);
		//var_dump ($result);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);            
            $d_data->set_jml_invoice($val['JML_INVOICE']);
            $d_data->set_jml_pmrt($val['JML_PMRT']);
            $d_data->set_jml_nilai_inv($val['JML_NILAI_INV']);
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

    public function set_conversion_date($conversion_date) {
        $this->_conversion_date = $conversion_date;
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

    public function set_file_name_zip($file_name_zip) {
        $this->_file_name_zip = $file_name_zip;
    }

    public function set_satker($satker) {
        $this->_satker = $satker;
    }

    public function set_durasi($durasi) {
        $this->_durasi = $durasi;
    }
	
	public function set_kppn($kppn) {
        $this->_kppn = $kppn;
    }
	
	public function set_jendok($jendok) {
        $this->_jendok = $jendok;
    }

    public function set_attribute1($attribute1) {
        $this->_attribute1 = $attribute1;
    }

    public function set_jml_pmrt($jml_pmrt) {
        $this->_jml_pmrt = $jml_pmrt;
    }

    public function set_jml_invoice($jml_invoice) {
        $this->_jml_invoice = $jml_invoice;
    }

    public function set_jml_nilai_inv($jml_nilai_inv) {
        $this->_jml_nilai_inv = $jml_nilai_inv;
    }

    /*
     * getter
     */

    public function get_invoice_num() {
        return $this->_invoice_num;
    }
	
	public function get_invoice_date() {
        return $this->_invoice_date;
    }
	
    public function get_invoice_amount() {
        return $this->_invoice_amount;
    }

    public function get_conversion_date() {
        return $this->_conversion_date;
    }

    public function get_file_name() {
        return $this->_file_name;
    }

    public function get_status_code() {
        return $this->_status_code;
    }

    public function get_file_name_zip() {
        return $this->_file_name_zip;
    }

    public function get_satker() {
        return $this->_satker;
    }
	
	public function get_kppn() {
        return $this->_kppn;
    }
	
	public function get_jendok() {
        return $this->_jendok;
    }

    public function get_durasi() {
        return $this->_durasi;
    }

    public function get_jml_invoice() {
        return $this->_jml_invoice;
    }

    public function get_jml_pmrt() {
        return $this->_jml_pmrt;
    }

    public function get_jml_nilai_inv() {
        return $this->_jml_nilai_inv;
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
