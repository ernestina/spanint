<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataKarwasUP {

    private $db;
    private $_dipa_no;
    private $_satker_code;
	private $_nmsatker;
    private $_kppn_code;
    private $_account_code;
	private $_jenis_belanja;
	private $_jenis_spm;
    private $_line_amount;
	private $_amount;
	private $_program_code;
	private $_output_code;
	private $_ntpn;
	private $_tanggal;
	private $_jendok;
	private $_invoice_num;
	private $_description;
	private $_check_num;
	private $_invoice_date;
	private $_tanggal_sp2d;
    private $_table1 = 'KARWAS_UP_DIPA_V';
    private $_table2 = 'KARWAS_TOTAL_UP_V';
	private $_table3 = 'KARWAS_UP_V';
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
	
	
	public function get_nama_satker_up($kd_satker) {
        $sql = "SELECT DISTINCT KDSATKER, UPPER(NMSATKER) NMSATKER 
				FROM T_SATKER
				WHERE 
				1=1 
				AND KDSATKER = '" .$kd_satker. "'"
        ;
        $no = 0;
        
        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_nmsatker($val['NMSATKER']);
            $d_data->set_satker_code($val['KDSATKER']);
            $data[] = $d_data;
        }
        return $data;
    }

	
    public function get_dipa_up($filter) {
        $sql = "SELECT *
				FROM "
                . $this->_table1 . " 
				WHERE 
				1=1 
				 
				"

        ;
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }

		//$sql .= " AND " . $satker1;
        $sql .= " ORDER BY JENBEL ";

        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_dipa_no($val['DIPA_NO']);
            $d_data->set_satker_code($val['SATKER_CODE']);
            $d_data->set_kppn_code($val['KPPN_CODE']);
			$d_data->set_jenis_belanja($val['JENBEL']);
            $d_data->set_line_amount($val['AMOUNT']);
            $data[] = $d_data;
        }
        return $data;
    }
	
	public function get_karwas_up_satker($filter) {
        $sql = "SELECT *
				FROM "
                . $this->_table3 . " 
				WHERE 
				1=1 
				
				"

        ;
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }

        $sql .= " ORDER BY to_char(TO_DATE(BATAS_TEGURAN,'DD-MM-YYYY'),'yyyymmdd') asc, KETERANGAN, SATKER_CODE ";
		//$sql .= " AND " . $satker1;

        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
			$d_data->set_nmsatker($val['NMSATKER']);
            $d_data->set_satker_code($val['SATKER_CODE']);
            $d_data->set_kppn_code($val['KPPN_CODE']);
			$d_data->set_invoice_date($val['TGL_UP_AKHIR']);
			$d_data->set_check_num($val['SISA_UP']);
            $d_data->set_line_amount($val['TOTAL_GU_NIHIL']);
			$d_data->set_amount($val['TOTAL_UP']);
			$d_data->set_jendok($val['SUMBER_DANA']);
			$d_data->set_tanggal_sp2d($val['TGL_GUP_AKHIR']);
			$d_data->set_tanggal($val['BATAS_TEGURAN']);
			$d_data->set_description($val['KETERANGAN']);
			$d_data->set_ntpn($val['SETORAN_UP']);
			$d_data->set_output_code($val['TOTAL_GUP_AKHIR']);
            $data[] = $d_data;
        }
        return $data;
    }
	
	public function get_total_up($filter) {
        $sql = "SELECT *
				FROM "
                . $this->_table2 . " 
				WHERE 
				1=1 
				
				"

        ;
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }

        $sql .= " ORDER BY INVOICE_DATE ";
		//$sql .= " AND " . $satker1;

        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
			$d_data->set_jenis_spm($val['JENIS_SPM']);
            $d_data->set_satker_code($val['SATKER_CODE']);
            $d_data->set_kppn_code($val['KPPN_CODE']);
			$d_data->set_invoice_num($val['INVOICE_NUM']);
			$d_data->set_invoice_date($val['INVOICE_DATE']);
			$d_data->set_tanggal_sp2d($val['CHECK_DATE']);
			$d_data->set_check_num($val['CHECK_NUMBER']);
            $d_data->set_line_amount($val['AMOUNT']);
            $data[] = $d_data;
        }
        return $data;
    }
	
	public function get_total_sisa_up($filter) {
        $sql = "SELECT SUM(SISA_UP) SISA_UP
				FROM "
                . $this->_table3 . " 
				WHERE 
				1=1 
				
				"

        ;
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }

        //$sql .= " ORDER BY INVOICE_DATE ";
		//$sql .= " AND " . $satker1;

        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_line_amount($val['SISA_UP']);
            $data[] = $d_data;
        }
        return $data;
    }
	
    /*
     * setter
     */
	
	
	
	public function set_invoice_date($invoice_date) {
        $this->_invoice_date = $invoice_date;
    }
	
    public function set_dipa_no($dipa_no) {
        $this->_dipa_no = $dipa_no;
    }
	
	public function set_description($description) {
        $this->_description = $description;
    }

    public function set_jenis_belanja($jenis_belanja) {
        $this->_jenis_belanja = $jenis_belanja;
    }

    public function set_satker_code($satker_code) {
        $this->_satker_code = $satker_code;
    }
	public function set_nmsatker($nmsatker) {
        $this->_nmsatker = $nmsatker;
    }
    public function set_kppn_code($kppn_code) {
        $this->_kppn_code = $kppn_code;
    }

    public function set_account_code($account_code) {
        $this->_account_code = $account_code;
    }

 
    public function set_line_amount($line_amount) {
        $this->_line_amount = $line_amount;
    }
	
	public function set_amount($line_amount) {
        $this->_amount = $line_amount;
    }
	
	public function set_ntpn($ntpn) {
        $this->_ntpn = $ntpn;
    }
	public function set_invoice_num($invoice_num) {
        $this->_invoice_num = $invoice_num;
    }
	public function set_tanggal($tanggal) {
        $this->_tanggal = $tanggal;
    }
	public function set_jenis_spm($jenis_spm) {
        $this->_jenis_spm = $jenis_spm;
    }
	public function set_jendok($jendok) {
        $this->_jendok = $jendok;
    }
	public function set_check_num($check_num) {
        $this->_check_num = $check_num;
    }
	public function set_tanggal_sp2d($tanggal_sp2d) {
        $this->_tanggal_sp2d = $tanggal_sp2d;
    }
	
	public function set_program_code($program_code) {
        $this->_program_code = $program_code;
    }
	
	public function set_output_code($output_code) {
        $this->_output_code = $output_code;
    }
    /*
     * getter
     */
	
	
	
	public function get_invoice_date() {
        return $this->_invoice_date;
    }
	public function get_description() {
        return $this->_description;
    }
	
	public function get_ntpn() {
        return $this->_ntpn;
    }
	
	public function get_invoice_num() {
        return $this->_invoice_num;
    }
	
	public function get_tanggal() {
        return $this->_tanggal;
    }
	
	public function get_jenis_spm() {
        return $this->_jenis_spm;
    }
	
	public function get_jendok() {
        return $this->_jendok;
    }
	
	public function get_check_num() {
        return $this->_check_num;
    }
	
	public function get_tanggal_sp2d() {
        return $this->_tanggal_sp2d;
    }
	
	
    public function get_dipa_no() {
        return $this->_dipa_no;
    }

    public function get_satker_code() {
        return $this->_satker_code;
    }
	
	public function get_nmsatker() {
        return $this->_nmsatker;
    }

    public function get_account_code() {
        return $this->_account_code;
    }
	
	public function get_program_code() {
        return $this->_program_code;
    }
	
	public function get_kppn_code() {
        return $this->_kppn_code;
    }
	
	public function get_output_code() {
        return $this->_output_code;
    }


    public function get_jenis_belanja() {
        return $this->_jenis_belanja;
    }

    public function get_line_amount() {
        return $this->_line_amount;
    }
	
	public function get_amount() {
        return $this->_amount;
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
