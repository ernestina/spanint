<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataFA {

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
    private $_obligation;
    private $_block_amount;
    private $_temp_block;
    private $_cash_limit;
    private $_invoice;
    private $_table1 = 'GL_BALANCES_V';
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
     * return array objek Data Tetap */

    public function get_fa_filter($filter) {
        Session::get('id_user');
        $sql = "SELECT Distinct A.*, B.NMSATKER 
				FROM "
                . $this->_table1 . " A, "
                . $this->_table2 . " B 
				WHERE 1=1 AND 
				A.BUDGET_TYPE='2' AND
				A.SATKER=B.KDSATKER
				AND A.SUMMARY_FLAG = 'N' 
				AND NVL(A.BUDGET_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) + NVL(A.ACTUAL_AMT,0) <> 0
				AND SUBSTR(AKUN,1,2) <> '53'
				";
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }

        $sql .= " ORDER BY A.KPPN, A.AKUN ";

        //var_dump($sql);
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
            $d_data->set_budget_amt($val['BUDGET_AMT']);
            $d_data->set_encumbrance_amt($val['ENCUMBRANCE_AMT']);
            $d_data->set_actual_amt($val['ACTUAL_AMT']);
            $d_data->set_balancing_amt($val['BALANCING_AMT']);
            $d_data->set_nm_satker($val['NMSATKER']);
            $d_data->set_obligation($val['OBLIGATION']);
            $d_data->set_block_amount($val['BLOCK_AMOUNT']);
            $d_data->set_temp_block($val['TEMP_BLOCKED_AMOUNT']);
            $d_data->set_cash_limit($val['CASH_LIMIT']);
            $d_data->set_invoice($val['INVOICE']);
            $data[] = $d_data;
        }
        return $data;
    }

    public function get_fa_summary_filter($filter) {
        Session::get('id_user');
        $sql = "SELECT Distinct A.*, B.NMSATKER
				FROM "
                . $this->_table1 . " A, "
                . $this->_table2 . " B 
				WHERE 1=1
				AND
				A.SATKER=B.KDSATKER 
				AND A.SUMMARY_FLAG = 'Y' 
				AND NVL(A.BUDGET_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) + NVL(A.ACTUAL_AMT,0) <> 0
				AND SUBSTR(AKUN,1,2) <> 'B3'
				";
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }

        $sql .= " ORDER BY A.KPPN, A.OUTPUT, A.AKUN ";

        //var_dump($sql);
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
            $d_data->set_budget_amt($val['BUDGET_AMT']);
            $d_data->set_encumbrance_amt($val['ENCUMBRANCE_AMT']);
            $d_data->set_actual_amt($val['ACTUAL_AMT']);
            $d_data->set_balancing_amt($val['BALANCING_AMT']);
            $d_data->set_nm_satker($val['NMSATKER']);
            $d_data->set_obligation($val['OBLIGATION']);
            $d_data->set_block_amount($val['BLOCK_AMOUNT']);
            $d_data->set_temp_block($val['TEMP_BLOCKED_AMOUNT']);
            $d_data->set_cash_limit($val['CASH_LIMIT']);
            $d_data->set_invoice($val['INVOICE']);
            $data[] = $d_data;
        }
        return $data;
    }

    public function get_global_fa_filter($filter) {
        Session::get('id_user');
        $sql = "select  
				b.nmsatker,
				a.satker,
				a.kppn,
				substr(a.AKUN,1,2) akun,
				a.program,
				a.output,
				a.dana,
				a.kewenangan,
				a.lokasi,
				sum(a.budget_amt) budget_amt,
				sum(a.encumbrance_amt) encumbrance_amt,
				sum(a.actual_amt) actual_amt,
				sum(a.balancing_amt) balancing_amt 
				FROM  "
                . $this->_table1 . " A, "
                . $this->_table2 . " B 
				WHERE
				A.BUDGET_TYPE='2' AND
				A.SATKER=B.KDSATKER ";
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }

        $sql .= " GROUP BY
				b.nmsatker,
				a.satker,
				a.kppn,
				substr(a.AKUN,1,2),
				a.program,
				a.output,
				a.dana,
				a.kewenangan,
				a.lokasi
		
				order BY
				b.nmsatker,
				a.satker,
				a.kppn,
				substr(a.AKUN,1,2),
				a.program,
				a.output,
				a.dana,
				a.kewenangan,
				a.lokasi
		
		";

        //var_dump($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_satker($val['SATKER']);
            //$d_data->set_code_id($val['CODE_COMBINATION_ID']);
            $d_data->set_kppn($val['KPPN']);
            $d_data->set_akun($val['AKUN']);
            $d_data->set_program($val['PROGRAM']);
            $d_data->set_output($val['OUTPUT']);
            $d_data->set_dana($val['DANA']);
            //$d_data->set_bank($val['BANK']);
            $d_data->set_kewenangan($val['KEWENANGAN']);
            $d_data->set_lokasi($val['LOKASI']);
            //$d_data->set_budget_type($val['BUDGET_TYPE']);
            //$d_data->set_currency_code($val['CURRENCY_CODE']);
            $d_data->set_budget_amt($val['BUDGET_AMT']);
            $d_data->set_encumbrance_amt($val['ENCUMBRANCE_AMT']);
            $d_data->set_actual_amt($val['ACTUAL_AMT']);
            $d_data->set_balancing_amt($val['BALANCING_AMT']);
            $d_data->set_nm_satker($val['NMSATKER']);
            $data[] = $d_data;
        }
        return $data;
    }

    /*
     * setter
     */

    public function set_obligation($obligation) {
        $this->_obligation = $obligation;
    }

    public function set_block_amount($block_amont) {
        $this->_block_amount = $block_amont;
    }

    public function set_temp_block($temp_block) {
        $this->_temp_block = $temp_block;
    }

    public function set_cash_limit($cash_limit) {
        $this->_cash_limit = $cash_limit;
    }

    public function set_invoice($invoice) {
        $this->_invoice = $invoice;
    }

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
        $this->_output = $output;
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

    public function get_obligation() {
        return $this->_obligation;
    }

    public function get_block_amount() {
        return $this->_block_amount;
    }

    public function get_temp_block() {
        return $this->_temp_block;
    }

    public function get_cash_limit() {
        return $this->_cash_limit;
    }

    public function get_invoice() {
        return $this->_invoice;
    }

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
        return $this->_lokasi;
    }

    public function get_budget_type() {
        return $this->_budget_type;
    }

    public function get_currency_code() {
        return $this->_currency_code;
    }

    public function get_budget_amt() {
        return $this->_budget_amt;
    }

    public function get_encumbrance_amt() {
        return $this->_encumbrance_amt;
    }

    public function get_actual_amt() {
        return $this->_actual_amt;
    }

    public function get_balancing_amt() {
        return $this->_balancing_amt;
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
