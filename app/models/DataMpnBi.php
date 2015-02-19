<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataMpnBi {

    private $db;
    private $_kdkppn;
    private $_tahun;
    private $_tanggal_gl;
    private $_trn;
    private $_rph;
    private $_trn_kbi;
    private $_rph_kbi;
    private $_trn_non_kbi;
    private $_rph_non_kbi;
    private $_kdkppn_kbi;
    private $_kdkcbi;
    private $_error;
    private $_valid = TRUE;
    private $_table = 'SPGR_MPN_BI';
    private $_table1 = 'T_BI_MAP';
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

    public function get_mpn_bi_filter($filter,$kdkcbi) {
        if ($kdkcbi=='3'){
        $sql = "select tanggal_gl, 0 trn_kbi, 0 rph_kbi,
                sum(case when kdkcbi=3 then trn end)  trn_non_kbi,
                sum(case when kdkcbi=3 then rph end) rph_non_kbi
				FROM " . $this->_table . "
				WHERE 1=1 
                AND TAHUN = '".Session::get('ta')."' ";        
        } else if ($kdkcbi=='2'){
        $sql = "select tanggal_gl, sum(case when kdkcbi=2 then trn end)  trn_kbi,
                sum(case when kdkcbi=2 then rph end) rph_kbi,
                sum(case when kdkcbi=3 then trn end)  trn_non_kbi,
                sum(case when kdkcbi=3 then rph end) rph_non_kbi
				FROM " . $this->_table . "
				WHERE 1=1 
                AND TAHUN = '".Session::get('ta')."' ";            
        } else if ($kdkcbi=='1'){
        $sql = "select tanggal_gl, sum(case when kdkcbi  in (1,2) then trn end)  trn_kbi,
                sum(case when kdkcbi in (1,2) then rph end) rph_kbi,
                sum(case when kdkcbi=3 then trn end)  trn_non_kbi,
                sum(case when kdkcbi=3 then rph end) rph_non_kbi 
				FROM " . $this->_table . "
				WHERE 1=1 
                AND TAHUN = '".Session::get('ta')."' ";            
        }
        
        $no = 0;
        //var_dump($filter);
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $sql .= " group by tanggal_gl order by tanggal_gl desc";
        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_kdkppn($val['KDKPPN']);
            $d_data->set_tanggal_gl(date("d-m-Y", strtotime($val['TANGGAL_GL'])));
            $d_data->set_trn_kbi($val['TRN_KBI']);
            $d_data->set_rph_kbi($val['RPH_KBI']);
            $d_data->set_trn_non_kbi($val['TRN_NON_KBI']);
            $d_data->set_rph_non_kbi($val['RPH_NON_KBI']);
            $data[] = $d_data;
        }
        return $data;
    }
    
    public function getKdKdkcbi($kdkppn){
        if ($kdkppn=='183'){
            $kdkppn = "PNR";    
        }
        $sql = "select kdkcbi from ".$this->_table1." where kdkppn = '".$kdkppn."'";
        $result = $this->db->select($sql);
        //var_dump($sql);
        foreach ($result as $val) {
            $data = $val['KDKCBI'];   
        }
        return $data;
    }
    
    /*
     * setter
     */

    public function set_kdkppn($kdkppn) {
        $this->_kdkppn = $kdkppn;
    }

    public function set_tahun($tahun) {
        $this->_tahun = $tahun;
    }

    public function set_tanggal_gl($tanggal_gl) {
        $this->_tanggal_gl = $tanggal_gl;
    }

    public function set_trn($trn) {
        $this->_trn = $trn;
    }

    public function set_rph($rph) {
        $this->_rph = $rph;
    }

    public function set_trn_kbi($trn_kbi) {
        $this->_trn_kbi = $trn_kbi;
    }

    public function set_rph_kbi($rph_kbi) {
        $this->_rph_kbi = $rph_kbi;
    }

    public function set_trn_non_kbi($trn_non_kbi) {
        $this->_trn_non_kbi = $trn_non_kbi;
    }

    public function set_rph_non_kbi($rph_non_kbi) {
        $this->_rph_non_kbi = $rph_non_kbi;
    }

    public function set_kdkppn_kbi($kdkppn_kbi) {
        $this->_kdkppn_kbi = $kdkppn_kbi;
    }

    public function set_kdkcbi($kdkcbi) {
        $this->_kdkcbi = $kdkcbi;
    }

    /*
     * getter
     */

    public function get_kdkppn() {
        return $this->_kdkppn;
    }

    public function get_tahun() {
        return $this->_tahun;
    }

    public function get_tanggal_gl() {
        return $this->_tanggal_gl;
    }

    public function get_trn() {
        return $this->_trn;
    }

    public function get_rph() {
        return $this->_rph;
    }

    public function get_trn_kbi() {
        return $this->_trn_kbi;
    }

    public function get_rph_kbi() {
        return $this->_rph_kbi;
    }

    public function get_trn_non_kbi() {
        return $this->_trn_non_kbi;
    }

    public function get_rph_non_kbi() {
        return $this->_rph_non_kbi;
    }

    public function get_kdkppn_kbi() {
        return $this->_kdkppn_kbi;
    }

    public function get_kdkcbi() {
        return $this->_kdkcbi;
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
