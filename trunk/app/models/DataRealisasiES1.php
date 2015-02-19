<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataRealisasiES1 {

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
    private $_table2 = 'T_BA';
    private $_table3 = 'T_KEGIATAN';
    private $_table4 = 'T_ESELON1';
    private $_table6 = 'T_OUTPUT';
    private $_table5 = 'T_AKUN';
    public $registry;

    /*
     * konstruktor
     */

    public function __construct($registry = Registry) {
        $this->db = $registry->db;
        $this->registry = $registry;

        if (('' . Session::get('ta')) == date("Y")) {
            $this->_table1 = 'GL_BALANCES_V';
            $this->_table2 = 'T_BA';
        } else {
            $this->_table1 = 'GL_BALANCES_V_TL';
            $this->_table2 = 't_satker_tl';
        }
    }

    /*
     * mendapatkan data dari tabel Data Tetap
     * @param limit batas default null
     * return array objek Data Tetap */





    /* ----------------------------------------------------------------------------------------------------------- contekan */

    public function get_ba_kegiatan_filter($filter) {
        Session::get('id_user');
        $sql = "SELECT SUBSTR(OUTPUT,1,4) KODE_KEGIATAN, C.NMKEGIATAN, SUM(BUDGET_AMT) PAGU, SUM(ACTUAL_AMT) REALISASI,
				SUM(OBLIGATION) OBLIGATION, SUM(BLOCK_AMOUNT) BLOCK_AMOUNT, SUM(BALANCING_AMT) BALANCING_AMT  FROM "
                . $this->_table1 . " A, "
                . $this->_table3 . " C 
				WHERE 1=1 AND 
				A.BUDGET_TYPE='2' 				
				AND SUBSTR(A.OUTPUT,1,4)=C.KDKEGIATAN			
				AND A.SUMMARY_FLAG = 'N' 
				AND SUBSTR(A.AKUN,1,1) IN ('5','6')
				AND NVL(A.BUDGET_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) + NVL(A.ACTUAL_AMT,0) <> 0
				
				";
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $sql .= " GROUP BY SUBSTR(OUTPUT,1,4), C.NMKEGIATAN ";
        $sql .= " ORDER BY SUBSTR(OUTPUT,1,4) ";

        //var_dump($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_satker($val['KDBA']);
            $d_data->set_kdkegiatan($val['KODE_KEGIATAN']);
            $d_data->set_nmkegiatan($val['NMKEGIATAN']);
            $d_data->set_budget_amt($val['PAGU']);
            $d_data->set_actual_amt($val['REALISASI']);
            $d_data->set_nm_satker($val['NMBA']);
			 $d_data->set_obligation($val['OBLIGATION']);
            $d_data->set_block_amount($val['BLOCK_AMOUNT']);
			$d_data->set_balancing_amt($val['BALANCING_AMT']);
            $data[] = $d_data;
        }
        return $data;
    }

    public function get_es1_kegiatan_filter($filter) {
        Session::get('id_user');
        $sql = "SELECT SUBSTR(OUTPUT,1,4) KODE_KEGIATAN, C.NMKEGIATAN, SUM(BUDGET_AMT) PAGU, SUM(ACTUAL_AMT) REALISASI, B.NMES1 , B.KDES1
				FROM "
                . $this->_table1 . " A, "
                . $this->_table4 . " B, "
                . $this->_table3 . " C 
				WHERE 1=1 AND 
				A.BUDGET_TYPE='2' AND
				AND SUBSTR(A.PROGRAM,1,5)=B.KDES1
				SUBSTR(A.OUTPUT,1,4)=C.KDKEGIATAN			
				AND A.SUMMARY_FLAG = 'N' 
				AND SUBSTR(A.AKUN,1,1) IN ('5','6')
				AND NVL(A.BUDGET_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) + NVL(A.ACTUAL_AMT,0) <> 0
				
				";
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $sql .= " GROUP BY SUBSTR(OUTPUT,1,4), C.NMKEGIATAN ,B.NMES1 , B.KDES1";
        $sql .= " ORDER BY SUBSTR(OUTPUT,1,4) ";

        //var_dump($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_satker($val['KDBA']);
            $d_data->set_kdkegiatan($val['KODE_KEGIATAN']);
            $d_data->set_nmkegiatan($val['NMKEGIATAN']);
            $d_data->set_budget_amt($val['BUDGET_AMT']);
            $d_data->set_actual_amt($val['ACTUAL_AMT']);
            $d_data->set_nm_satker($val['NMBA']);
            $data[] = $d_data;
        }
        return $data;
    }

    public function get_ba_pendapatan_filter($filter) {
        Session::get('id_user');
        $sql = "SELECT A.AKUN, C.DESCRIPTION, SUM(BUDGET_AMT) PAGU, SUM(ACTUAL_AMT)* -1 REALISASI, SUBSTR(A.PROGRAM,1,3) KDBA
				FROM "
                . $this->_table1 . " A, "
                . $this->_table5 . " C 
				WHERE 1=1 
				AND A.AKUN =C.FLEX_VALUE			
				AND A.SUMMARY_FLAG = 'N' 
				AND SUBSTR(AKUN,1,1) = '4'
				AND NVL(A.BUDGET_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) + NVL(A.ACTUAL_AMT,0) <> 0
				
				";
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $sql .= " GROUP BY A.AKUN, C.DESCRIPTION, SUBSTR(A.PROGRAM,1,3) ";
        $sql .= " ORDER BY A.AKUN ";


        //var_dump($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_satker($val['KDBA']);
            $d_data->set_kdkegiatan($val['AKUN']);
            $d_data->set_nmkegiatan($val['DESCRIPTION']);
            $d_data->set_budget_amt($val['PAGU']);
            $d_data->set_actual_amt($val['REALISASI']);
            $d_data->set_nm_satker($val['NMBA']);
            $data[] = $d_data;
        }
        return $data;
    }

    public function get_ba_output_filter($filter) {
        Session::get('id_user');
        $sql = "SELECT SUBSTR(OUTPUT,1,4) KODE_KEGIATAN, C.NMKEGIATAN, SUM(BUDGET_AMT) PAGU, SUM(ACTUAL_AMT) REALISASI
				FROM "
                . $this->_table1 . " A, "
                . $this->_table3 . " C 
				WHERE 1=1 AND 
				A.BUDGET_TYPE='2' 
	
				AND SUBSTR(A.OUTPUT,1,4)=C.KDKEGIATAN			
				AND A.SUMMARY_FLAG = 'N' 
                                AND SUBSTR(A.AKUN,1,1) IN('5','6')
				AND NVL(A.BUDGET_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) + NVL(A.ACTUAL_AMT,0) > 0
				";

        foreach ($filter as $filter1) {
            $sql .= " AND " . $filter1;
        }
        $sql .= " GROUP BY SUBSTR(OUTPUT,1,4), C.NMKEGIATAN ";
        $sql .=" union all 
                SELECT OUTPUT KODE_KEGIATAN, C.NMKEGIATAN, SUM(BUDGET_AMT) PAGU, SUM(ACTUAL_AMT) REALISASI
				FROM "
                . $this->_table1 . " A, "
                . $this->_table6 . " C 
				WHERE 1=1 AND 
				A.BUDGET_TYPE='2' 
				
				AND OUTPUT=C.KDKEGIATAN			
				AND A.SUMMARY_FLAG = 'N'
                                AND SUBSTR(A.AKUN,1,1) IN('5','6')
				AND NVL(A.BUDGET_AMT,0) + NVL(A.ENCUMBRANCE_AMT,0) + NVL(A.ACTUAL_AMT,0) > 0
				 ";

        foreach ($filter as $filter2) {
            $sql .= " AND " . $filter2;
        }
        $sql .= " GROUP BY OUTPUT, C.NMKEGIATAN";
        $sql .= " ORDER BY kode_kegiatan ";

        //var_dump($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_satker($val['KDBA']);
            $d_data->set_kdkegiatan($val['KODE_KEGIATAN']);
            $d_data->set_nmkegiatan($val['NMKEGIATAN']);
            $d_data->set_budget_amt($val['PAGU']);
            $d_data->set_actual_amt($val['REALISASI']);
            $d_data->set_nm_satker($val['NMBA']);
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

    public function set_kdkegiatan($kdkegiatan) {
        $this->_kdkegiatan = $kdkegiatan;
    }

    public function set_nmkegiatan($nmkegiatan) {
        $this->_nmkegiatan = $nmkegiatan;
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

    public function get_kdkegiatan() {
        return $this->_kdkegiatan;
    }

    public function get_nmkegiatan() {
        return $this->_nmkegiatan;
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
