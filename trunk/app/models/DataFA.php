<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataFA{

    private $db;
	private $_period_name;
	
	
    private $_satker;
	private $_code_id;
    private $_kppn;
	private $_akun;
    private $_program;
	private $_output;
	private $_dana;
	private $_bank;
	private $_kewenangan;
	private $_lokasi;
	private $_budget_type;
	private $_currency_code;
	private $_budget_amt;
	private $_encumbrance_amt;
	private $_actual_amt;
	private $_balancing_amt;
	private $_nm_satker;
    private $_table1 = 'gl_balances_v';
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
    
    public function get_fa_filter($filter) {
		Session::get('id_user');
		$sql = "SELECT Distinct A.*, B.NMSATKER
				FROM " 
				. $this->_table1. " A, "
				. $this->_table2. " B 
				WHERE BANK = '00000' AND
				SUBSTR(A.AKUN,1,1) = '5' AND
				SUBSTR(A.PERIOD_NAME,5,2) = '14' AND
				A.BUDGET_TYPE = '2' AND
				A.SATKER=B.KDSATKER ";
		$no=0;
		foreach ($filter as $filter) {
			$sql .= " AND ".$filter;
		}
		
		$sql .= " ORDER BY A.AKUN " ;
		
		//var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_satker($val['SATKER']);
			$d_data->set_code_id($val['CODE_COMBINATION_ID']);
            $d_data->set_kppn($val['KPPN']);
            $d_data->set_akun($val['AKUN']);
            $d_data->set_program($val['PROGRAM']);
            $d_data->set_output($val['OUTPUT']);
            $d_data->set_dana($val['DANA']);
			$d_data->set_bank($val['BANK']);
			$d_data->set_kewenangan($val['KEWENANGAN']);
			$d_data->set_lokasi($val['LOKASI']);
			$d_data->set_budget_type($val['BUDGET_TYPE']);
			$d_data->set_currency_code($val['CURRENCY_CODE']);
			$d_data->set_budget_amt(number_format($val['BUDGET_AMT']));
			$d_data->set_encumbrance_amt(number_format($val['ENCUMBRANCE_AMT']));
			$d_data->set_actual_amt(number_format($val['ACTUAL_AMT']));
			$d_data->set_balancing_amt(number_format($val['BALANCING_AMT']));
			$d_data->set_nm_satker($val['NMSATKER']);
            $data[] = $d_data;
        }
        return $data;
    }
	
    /*
     * setter
     */

    public function set_satker($satker) {
        $this->_satker = $satker;
    }
	public function set_kppn($kppn) {
        $this->_kppn = $kppn;
    }
	public function set_nm_satker($nm_satker) {
        $this->_nm_satker = $nm_satker;
    }
	public function set_code_id($code_id) {
        $this->_code_id = $code_id;
    }
	
    public function set_akun($akun) {
        $this->_akun = $akun;
    }
	
    public function set_program($program) {
        $this->_program = $program;
    }
	
    public function set_output($output) {
        $this->_output= $output;
    }
	
    public function set_dana($dana) {
        $this->_dana = $dana;
    }
	
	public function set_bank($bank) {
        $this->_bank = $bank;
    }
	public function set_kewenangan($kewenangan) {
        $this->_kewenangan = $kewenangan;
    }
	public function set_lokasi($lokasi) {
        $this->_lokasi = $lokasi;
    }
	public function set_budget_type($budget_type) {
        $this->_budget_type = $budget_type;
    }
	public function set_currency_code($currency_code) {
        $this->_currency_code = $currency_code;
    }
	public function set_budget_amt($budget_amt) {
        $this->_budget_amt = $budget_amt;
    }
	public function set_encumbrance_amt($encumbrance_amt) {
        $this->_encumbrance_amt = $encumbrance_amt;
    }
	public function set_actual_amt($actual_amt) {
        $this->_actual_amt = $actual_amt;
    }
	public function set_balancing_amt($balancing_amt) {
        $this->_balancing_amt = $balancing_amt;
    }
		
	/*
     * getter
     */
	public function get_nm_satker() {
        return $this->_nm_satker;
    }
	public function get_satker() {
        return $this->_satker;
    }
	public function get_code_id() {
        return $this->_code_id;
    }
	public function get_kppn() {
        return $this->_kppn;
    }
	
	public function get_akun() {
        return $this->_akun;
    }
	
	public function get_program() {
        return $this->_program;
    }
	
	public function get_output() {
        return $this->_output;
    }
	
	public function get_dana() {
        return $this->_dana;
    }
	
	public function get_bank() {
        return $this->_bank;
    }
	public function get_kewenangan() {
        return $this->_kewenangan;
    }
	 public function get_lokasi() {
         return $this->_lokasi ;
    }
	public function get_budget_type() {
         return $this->_budget_type ;
    }
	public function get_currency_code() {
         return $this->_currency_code ;
    }
	public function get_budget_amt() {
         return $this->_budget_amt ;
    }
	public function get_encumbrance_amt() {
         return $this->_encumbrance_amt ;
    }
	public function get_actual_amt() {
         return $this->_actual_amt ;
    }
	public function get_balancing_amt() {
         return $this->_balancing_amt ;
    }
	
    /*
     * destruktor
     */

    public function __destruct() {
        
    }

}