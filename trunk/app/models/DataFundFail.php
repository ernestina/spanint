<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataFundFail{

    private $db;
	private $_error_date;
    private $_satker_code;
	private $_kppn_code;
	private $_account_code;
	private $_program_code;
	private $_output_code;
	private $_dana_code;
	private $_kewenangan;
	private $_lokasi;
	private $_pagu_semula;
	private $_pagu_revisi;
	private $_blokir;
	private $_description;
	private $_blokir_kontrak;
	private $_blokir_realisasi;
    private $_table1 = 'fund_fail_v';
	private $_table2 = 'detail_fund_fail';
	private $_table3 = 'detail_fund_fail_kd';
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
    
    public function get_fun_fail_filter($filter) {
		$sql = "SELECT * 
				FROM " 
				. $this->_table1. "
				where 1=1 
				and realisasi > 0
				"
				
				
				;
		$no=0;
		foreach ($filter as $filter) {
			$sql .= " AND ".$filter;
		}
		
		$sql .= " ORDER BY KPPN_CODE, KDSATKER ";
		
		//var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_error_date($val['ERROR_DATE']);
            $d_data->set_satker_code($val['KDSATKER']);
            $d_data->set_kppn_code($val['KPPN_CODE']);
			$d_data->set_account_code($val['ACCOUNT_CODE']);
			$d_data->set_program_code($val['PROGRAM_CODE']);
			$d_data->set_output_code($val['OUTPUT_CODE']);
			$d_data->set_dana_code($val['DANA_CODE']);
			$d_data->set_description($val['DESCRIPTION']);
			$d_data->set_blokir_kontrak($val['BLOKIR_KONTRAK']);
			$d_data->set_blokir_realisasi($val['REALISASI']);
            $data[] = $d_data;
        }
        return $data;
    }
	
	
	public function get_detail_fun_fail_filter($filter) {
		$sql = "SELECT * 
				FROM " 
				. $this->_table2. "
				where 1=1 
				
				"
				
				
				;
		$no=0;
		foreach ($filter as $filter) {
			$sql .= " AND ".$filter;
		}
		
		//$sql .= " ORDER BY A.SATKER_CODE ASC, A.REVISION_NO DESC, A.ACCOUNT_CODE ASC, A.TANGGAL_POSTING_REVISI DESC, A.JAM_POSTING_REVISI DESC ";
		
		//var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_error_date($val['LAST_UPDATE_DATE']);
            $d_data->set_satker_code($val['KDSATKER']);
            $d_data->set_kppn_code($val['KDKPPN']);
			$d_data->set_account_code($val['KDAKUN']);
			$d_data->set_program_code($val['PROGRAM_CODE']);
			$d_data->set_output_code($val['OUTPUT_CODE']);
			$d_data->set_dana_code($val['DANA_CODE']);
			$d_data->set_description($val['ERROR_DESCRIPTION']);
			$d_data->set_blokir_kontrak($val['PAGU']);
			$d_data->set_blokir_realisasi($val['REVISION_NO']);
            $data[] = $d_data;
        }
        return $data;
    }
	
	
	public function get_detail_fun_fail_kd_filter($filter) {
		$sql = "SELECT * 
				FROM " 
				. $this->_table3. "
				where 1=1 
				
				"
				;
		$no=0;
		foreach ($filter as $filter) {
			$sql .= " AND ".$filter;
		}
		
		//$sql .= " ORDER BY A.SATKER_CODE ASC, A.REVISION_NO DESC, A.ACCOUNT_CODE ASC, A.TANGGAL_POSTING_REVISI DESC, A.JAM_POSTING_REVISI DESC ";
		
		//var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_error_date($val['LAST_UPDATE_DATE']);
            $d_data->set_satker_code($val['SATKER']);
            $d_data->set_kppn_code($val['KPPN']);
			$d_data->set_account_code($val['AKUN']);
			$d_data->set_program_code($val['PROG']);
			$d_data->set_output_code($val['OUTPUT']);
			$d_data->set_dana_code($val['DANA']);
			$d_data->set_description($val['ERROR_DESCRIPTION']);
			$d_data->set_blokir_kontrak($val['KONTRAK']);
			$d_data->set_blokir_realisasi($val['REALISASI']);
			$d_data->set_pagu_semula($val['PAGU_SEMULA']);
			$d_data->set_pagu_revisi($val['PAGU_REVISI']);
			$d_data->set_blokir($val['BLOKIR']);
            $data[] = $d_data;
        }
        return $data;
    }
    /*
     * setter
     */

    public function set_error_date($error_date) {
        $this->_error_date = $error_date;
    }
	public function set_kewenangan($kewenangan) {
        $this->_kewenangan = $kewenangan;
    }
	public function set_lokasi($lokasi) {
        $this->_lokasi = $lokasi;
    }
	public function set_blokir($blokir) {
        $this->_blokir = $blokir;
    }
	public function set_pagu_semula($pagu_semula) {
        $this->_pagu_semula = $pagu_semula;
    }
	public function set_pagu_revisi($pagu_revisi) {
        $this->_pagu_revisi = $pagu_revisi;
    }
	
    public function set_satker_code($satker_code) {
        $this->_satker_code= $satker_code;
    }
	
    public function set_kppn_code($kppn_code) {
        $this->_kppn_code = $kppn_code;
    }
	
	public function set_account_code($account_code) {
        $this->_account_code = $account_code;
    }
	public function set_program_code($program_code) {
        $this->_program_code = $program_code;
    }
	public function set_output_code($output_code) {
        $this->_output_code = $output_code;
    }
	
	public function set_dana_code($dana_code) {
        $this->_dana_code = $dana_code;
    }
	public function set_description($description) {
        $this->_description = $description;
    }
	public function set_blokir_kontrak($blokir_kontrak) {
        $this->_blokir_kontrak = $blokir_kontrak;
    }
	public function set_blokir_realisasi($blokir_realisasi) {
        $this->_blokir_realisasi = $blokir_realisasi;
    }	
	/*
     * getter
     */
	
	public function get_error_date() {
        return $this->_error_date;
    }
	public function get_kewenangan() {
        return $this->_kewenangan;
    }
	public function get_lokasi() {
        return $this->_lokasi;
    }
	public function get_blokir() {
        return $this->_blokir;
    }
	public function get_pagu_semula() {
        return $this->_pagu_semula;
    }
	public function get_pagu_revisi() {
        return $this->_pagu_revisi;
    }
	public function get_satker_code() {
        return $this->_satker_code;
    }
	
	public function get_account_code() {
        return $this->_account_code;
    }
	
	public function get_program_code() {
        return $this->_program_code;
    }
	 public function get_output_code() {
         return $this->_output_code ;
    }
	public function get_description() {
         return $this->_description ;
    }
	public function get_blokir_kontrak() {
         return $this->_blokir_kontrak ;
    }
	public function get_blokir_realisasi() {
         return $this->_blokir_realisasi ;
    }
	
	public function get_dana_code() {
         return $this->_dana_code ;
    }
	public function get_kppn_code() {
         return $this->_kppn_code ;
    }
	
    /*
     * destruktor
     */

    public function __destruct() {
        
    }

}