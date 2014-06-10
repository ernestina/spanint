<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataRealisasi{

    private $db;
	private $_satker;
	private $_kppn;
	private $_dipa;
	private $_ba;
	private $_nmba;
	private $_pagu;
	private $_encumbrance;
    private $_belanja_51;
	private $_belanja_52;
    private $_belanja_53;
	private $_belanja_54;
	private $_belanja_55;
	private $_belanja_56;
	private $_belanja_57;
	private $_belanja_58;
	private $_belanja_59;
	private $_table1 = 'gl_balances_v';
	private $_table2 = 'spsa_bt_dipa_headers_all';
	private $_table3 = 't_ba';
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
    
    public function get_realisasi_fa_global_filter($filter) {
		Session::get('id_user');
		$sql = "select a.satker
				, substr(a.program,1,3) BA
				, a.kppn
				, b.dipa_no
				, sum(a.budget_amt) Pagu
				, sum(decode(substr(a.akun,1,2),'51',a.actual_amt,0)) belanja_51
				, sum(decode(substr(a.akun,1,2),'52',a.actual_amt,0)) belanja_52
				, sum(decode(substr(a.akun,1,2),'53',a.actual_amt,0)) belanja_53
				, sum(decode(substr(a.akun,1,2),'54',a.actual_amt,0)) belanja_54
				, sum(decode(substr(a.akun,1,2),'55',a.actual_amt,0)) belanja_55
				, sum(decode(substr(a.akun,1,2),'56',a.actual_amt,0)) belanja_56
				, sum(decode(substr(a.akun,1,2),'57',a.actual_amt,0)) belanja_57
				, sum(decode(substr(a.akun,1,2),'58',a.actual_amt,0)) belanja_58
				, sum(decode(substr(a.akun,1,2),'59',a.actual_amt,0)) belanja_59
				, sum(ENCUMBRANCE_AMT) encumbrance 
				FROM " 
				. $this->_table1. " a," 
				. $this->_table2. " b 
				where 
				substr(a.akun,1,1) in ('5','6')
				and a.bank = '00000'
				and a.budget_type = '2' 
				and a.budget_amt > 0
				and a.satker=substr(b.dipa_no, 15,6)
				and b.period_year=to_char(sysdate,'yyyy')"
				;
		$no=0;
		foreach ($filter as $filter) {
			$sql .= " AND ".$filter;
		}
		
		$sql .= " group by a.satker ,b.dipa_no, a.kppn, substr(a.program,1,3) " ;
		$sql .= " ORDER by a.satker " ;
		
		//var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_satker($val['SATKER']);
			$d_data->set_kppn($val['KPPN']);
            $d_data->set_ba($val['BA']);
            $d_data->set_pagu($val['PAGU']);
			$d_data->set_dipa($val['DIPA_NO']);
			$d_data->set_encumbrance($val['ENCUMBRANCE']);
            $d_data->set_belanja_51($val['BELANJA_51']);
			$d_data->set_belanja_52($val['BELANJA_52']);
			$d_data->set_belanja_53($val['BELANJA_53']);
			$d_data->set_belanja_54($val['BELANJA_54']);
			$d_data->set_belanja_55($val['BELANJA_55']);
			$d_data->set_belanja_56($val['BELANJA_56']);
			$d_data->set_belanja_57($val['BELANJA_57']);
			$d_data->set_belanja_58($val['BELANJA_58']);
			$d_data->set_belanja_59($val['BELANJA_59']);
            $data[] = $d_data;
        }
        return $data;
    }
	public function get_realisasi_fa_global_ba_filter($filter) {
		Session::get('id_user');
		$sql = "select 
				substr(a.program,1,3) BA
				, b.nmba
				, sum(a.budget_amt) Pagu
				, sum(decode(substr(a.akun,1,2),'51',a.actual_amt,0)) belanja_51
				, sum(decode(substr(a.akun,1,2),'52',a.actual_amt,0)) belanja_52
				, sum(decode(substr(a.akun,1,2),'53',a.actual_amt,0)) belanja_53
				, sum(decode(substr(a.akun,1,2),'54',a.actual_amt,0)) belanja_54
				, sum(decode(substr(a.akun,1,2),'55',a.actual_amt,0)) belanja_55
				, sum(decode(substr(a.akun,1,2),'56',a.actual_amt,0)) belanja_56
				, sum(decode(substr(a.akun,1,2),'57',a.actual_amt,0)) belanja_57
				, sum(decode(substr(a.akun,1,2),'58',a.actual_amt,0)) belanja_58
				, sum(decode(substr(a.akun,1,2),'59',a.actual_amt,0)) belanja_59
				, sum(ENCUMBRANCE_AMT) encumbrance 
				FROM " 
				. $this->_table1. " a," 
				. $this->_table3. " b 
				where 
				substr(a.akun,1,1) in ('5','6')
				and a.bank = '00000'
				and a.budget_type = '2'
				and a.budget_amt > 0				
				and substr(a.program,1,3)=b.kdba
				"
				;
		$no=0;
		foreach ($filter as $filter) {
			$sql .= " AND ".$filter;
		}
		
		$sql .= " group by substr(a.program,1,3), b.nmba " ;
		$sql .= " ORDER by substr(a.program,1,3) " ;
		
		//var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
			$d_data->set_nmba($val['NMBA']);
            $d_data->set_ba($val['BA']);
            $d_data->set_pagu($val['PAGU']);
			$d_data->set_encumbrance($val['ENCUMBRANCE']);
            $d_data->set_belanja_51($val['BELANJA_51']);
			$d_data->set_belanja_52($val['BELANJA_52']);
			$d_data->set_belanja_53($val['BELANJA_53']);
			$d_data->set_belanja_54($val['BELANJA_54']);
			$d_data->set_belanja_55($val['BELANJA_55']);
			$d_data->set_belanja_56($val['BELANJA_56']);
			$d_data->set_belanja_57($val['BELANJA_57']);
			$d_data->set_belanja_58($val['BELANJA_58']);
			$d_data->set_belanja_59($val['BELANJA_59']);
            $data[] = $d_data;
        }
        return $data;
    }
	
    /*
     * setter
     */
	 
	public function set_pagu($pagu) {
        $this->_pagu = $pagu;
    }
	public function set_nmba($nmba) {
        $this->_nmba = $nmba;
    }

    public function set_satker($satker) {
        $this->_satker = $satker;
    }
	public function set_kppn($kppn) {
        $this->_kppn = $kppn;
    }
	public function set_encumbrance($encumbrance) {
        $this->_encumbrance = $encumbrance;
    }
	public function set_dipa($dipa) {
        $this->_dipa = $dipa;
    }
	public function set_ba($ba) {
        $this->_ba = $ba;
    }
	public function set_belanja_51($belanja_51) {
        $this->_belanja_51 = $belanja_51;
    }
	public function set_belanja_52($belanja_52) {
        $this->_belanja_52 = $belanja_52;
    }
	public function set_belanja_53($belanja_53) {
        $this->_belanja_53 = $belanja_53;
    }
	public function set_belanja_54($belanja_54) {
        $this->_belanja_54 = $belanja_54;
    }
	public function set_belanja_55($belanja_55) {
        $this->_belanja_55 = $belanja_55;
    }
	public function set_belanja_56($belanja_56) {
        $this->_belanja_56 = $belanja_56;
    }
    public function set_belanja_57($belanja_57) {
        $this->_belanja_57 = $belanja_57;
    }
	public function set_belanja_58($belanja_58) {
        $this->_belanja_58 = $belanja_58;
    }
	public function set_belanja_59($belanja_59) {
        $this->_belanja_59 = $belanja_59;
    }
    	
	/*
     * getter
     */
	
	
	public function get_nmba() {
        return $this->_nmba;
    }
	public function get_pagu() {
        return $this->_pagu;
    }
	public function get_dipa() {
        return $this->_dipa;
    }
	public function get_encumbrance() {
        return $this->_encumbrance;
    }
	public function get_satker() {
        return $this->_satker;
    }
	public function get_kppn() {
        return $this->_kppn;
    }
	public function get_ba() {
        return $this->_ba;
    }
	public function get_belanja_51() {
        return $this->_belanja_51;
    }
	public function get_belanja_52() {
        return $this->_belanja_52;
    }
	public function get_belanja_53() {
        return $this->_belanja_53;
    }
	public function get_belanja_54() {
        return $this->_belanja_54;
    }
	public function get_belanja_55() {
        return $this->_belanja_55;
    }
	public function get_belanja_56() {
        return $this->_belanja_56;
    }
	public function get_belanja_57() {
        return $this->_belanja_57;
    }
	public function get_belanja_58() {
        return $this->_belanja_58;
    }
	public function get_belanja_59() {
        return $this->_belanja_59;
    }
	
    /*
     * destruktor
     */

    public function __destruct() {
        
    }

}