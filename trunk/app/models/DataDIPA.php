<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataDipa{

    private $db;
	private $_dipa_no;
    private $_revision_no;
    private $_tanggal_posting_revisi;
	private $_jam_posting_revisi;
    private $_satker_code;
	private $_kppn_code;
	private $_account_code;
	private $_program_code;
	private $_output_code;
	private $_dana_code;
	private $_bank_code;
	private $_kewenangan_code;
	private $_lokasi_code;
	private $_budget_type;
	private $_intraco_code;
	private $_cadangan_code;
	private $_line_amount;
	private $_nm_satker;
    private $_table1 = 'spsa_bt_dipa_v';
	private $_table2 = 't_satker';
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
    
    public function get_dipa_filter($filter) {
		$sql = "SELECT A.*, B.NMSATKER
				FROM " 
				. $this->_table1. " A, " 
				. $this->_table2. " B  
				WHERE 
				A.SATKER_CODE=B.KDSATKER"
				
				;
		$no=0;
		foreach ($filter as $filter) {
			$sql .= " AND ".$filter;
		}
		
		$sql .= " ORDER BY A.SATKER_CODE ASC, A.REVISION_NO DESC, A.ACCOUNT_CODE ASC, A.TANGGAL_POSTING_REVISI DESC, A.JAM_POSTING_REVISI DESC ";
		
		//var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_dipa_no($val['DIPA_NO']);
            $d_data->set_revision_no($val['REVISION_NO']);
            $d_data->set_tanggal_posting_revisi($val['TANGGAL_POSTING_REVISI']);
            $d_data->set_jam_posting_revisi($val['JAM_POSTING_REVISI']);
            $d_data->set_satker_code($val['SATKER_CODE']);
            $d_data->set_kppn_code($val['KPPN_CODE']);
			$d_data->set_account_code($val['ACCOUNT_CODE']);
			$d_data->set_program_code($val['PROGRAM_CODE']);
			$d_data->set_output_code($val['OUTPUT_CODE']);
			$d_data->set_dana_code($val['DANA_CODE']);
			$d_data->set_bank_code($val['BANK_CODE']);
			$d_data->set_output_code($val['OUTPUT_CODE']);
			$d_data->set_kewenangan_code($val['KEWENANGAN_CODE']);
			$d_data->set_lokasi_code($val['LOKASI_CODE']);
			$d_data->set_budget_type($val['BUDGET_TYPE']);
			$d_data->set_intraco_code($val['INTRACO_CODE']);
			$d_data->set_cadangan_code($val['CADANGAN_CODE']);
			$d_data->set_nm_satker($val['NMSATKER']);
			$d_data->set_line_amount(number_format($val['LINE_AMOUNT']));
            $data[] = $d_data;
        }
        return $data;
    }
	
    /*
     * setter
     */

    public function set_dipa_no($dipa_no) {
        $this->_dipa_no = $dipa_no;
    }
	public function set_revision_no($revision_no) {
        $this->_revision_no = $revision_no;
    }
	public function set_nm_satker($nm_satker) {
        $this->_nm_satker = $nm_satker;
    }
	
    public function set_tanggal_posting_revisi($tanggal_posting_revisi) {
        $this->_tanggal_posting_revisi = $tanggal_posting_revisi;
    }
	
    public function set_jam_posting_revisi($jam_posting_revisi) {
        $this->_jam_posting_revisi = $jam_posting_revisi;
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
	public function set_kewenangan_code($kewenangan_code) {
        $this->_kewenangan_code = $kewenangan_code;
    }
	public function set_lokasi_code($lokasi_code) {
        $this->_lokasi_code = $lokasi_code;
    }
	public function set_budget_type($budget_type) {
        $this->_budget_type = $budget_type;
    }
	public function set_intraco_code($intraco_code) {
        $this->_intraco_code = $intraco_code;
    }
	public function set_cadangan_code($cadangan_code) {
        $this->_cadangan_code = $cadangan_code;
    }
	public function set_line_amount($line_amount) {
        $this->_line_amount = $line_amount;
    }
	public function set_dana_code($dana_code) {
        $this->_dana_code = $dana_code;
    }
	public function set_bank_code($bank_code) {
        $this->_bank_code = $bank_code;
    }
			
	/*
     * getter
     */
	
	public function get_dipa_no() {
        return $this->_dipa_no;
    }
	public function get_nm_satker() {
        return $this->_nm_satker;
    }
	
	public function get_revision_no() {
        return $this->_revision_no;
    }
	
	public function get_tanggal_posting_revisi() {
        return $this->_tanggal_posting_revisi;
    }
	
	
	public function get_jam_posting_revisi() {
        return $this->_jam_posting_revisi;
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
	public function get_kewenangan_code() {
         return $this->_kewenangan_code ;
    }
	public function get_lokasi_code() {
         return $this->_lokasi_code ;
    }
	public function get_budget_type() {
         return $this->_budget_type ;
    }
	public function get_intraco_code() {
         return $this->_intraco_code ;
    }
	public function get_cadangan_code() {
         return $this->_cadangan_code ;
    }
	public function get_line_amount() {
         return $this->_line_amount ;
    }
	public function get_dana_code() {
         return $this->_dana_code ;
    }
	public function get_bank_code() {
         return $this->_bank_code ;
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