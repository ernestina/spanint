<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class proses_revisi {

    private $db;
    private $_satker_code;
    private $_nmsatker;
    private $_revision_no;
    private $_meaning;
    private $_program;
    private $_output;
    private $_dana;
    private $_kppn;
    private $_akun;
    private $_usulan_revisi;
    private $_last_update_date;
    private $_table1 = 'PROSES_REVISI';
    private $_table2 = 'T_SATKER';
    private $_table3 = 'DETAIL_REVISI';
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

    public function get_revisi_dipa($filter) {
        $sql = "SELECT DISTINCT A.SATKER_CODE ,A.KPPN_CODE, A.REVISION_NO, A.MEANING, A.LAST_UPDATE_DATE, B.NMSATKER 
				FROM "
                . $this->_table1 . " A, "
                . $this->_table2 . " B 
				where 1=1
				AND A.MEANING IS NOT NULL
				AND A.SATKER_CODE=B.KDSATKER
				";
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }

        $sql .= " ORDER BY TO_DATE(substr(A.LAST_UPDATE_DATE,0,10),'dd-mm-YYYY') DESC, A.KPPN_CODE, A.SATKER_CODE ASC ";

        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_satker_code($val['SATKER_CODE']);
            $d_data->set_nmsatker($val['NMSATKER']);
			$d_data->set_kppn($val['KPPN_CODE']);
            $d_data->set_revision_no($val['REVISION_NO']);
            $d_data->set_meaning($val['MEANING']);
            $d_data->set_last_update_date($val['LAST_UPDATE_DATE']);
            $data[] = $d_data;
        }
        return $data;
    }

    public function detail_revisi($filter) {
        Session::get('id_user');
        $sql = "SELECT * 
				FROM "
                . $this->_table3 . " 
				where 1=1
				
				";
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }

        $sql .= " ORDER BY LAST_UPDATE_DATE DESC, KDSATKER DESC, PROGRAM_CODE, OUTPUT_CODE, KDAKUN  ";

        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_satker_code($val['KDSATKER']);
            $d_data->set_dana($val['DANA_CODE']);
            $d_data->set_kppn($val['KDKPPN']);
            $d_data->set_program($val['PROGRAM_CODE']);
            $d_data->set_output($val['OUTPUT_CODE']);
            $d_data->set_akun($val['KDAKUN']);
            $d_data->set_usulan_revisi($val['USULAN_REVISI']);
            $d_data->set_revision_no($val['REVISION_NO']);
            $d_data->set_last_update_date($val['LAST_UPDATE_DATE']);
            $data[] = $d_data;
        }
        return $data;
    }

    /*
     * setter
     */

    public function set_kppn($kppn) {
        $this->_kppn = $kppn;
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

    public function set_usulan_revisi($usulan_revisi) {
        $this->_usulan_revisi = $usulan_revisi;
    }

    public function set_satker_code($satker_code) {
        $this->_satker_code = $satker_code;
    }

    public function set_nmsatker($nmsatker) {
        $this->_nmsatker = $nmsatker;
    }

    public function set_revision_no($revision_no) {
        $this->_revision_no = $revision_no;
    }

    public function set_meaning($meaning) {
        $this->_meaning = $meaning;
    }

    public function set_last_update_date($last_update_date) {
        $this->_last_update_date = $last_update_date;
    }

    /*
     * getter
     */

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

    public function get_usulan_revisi() {
        return $this->_usulan_revisi;
    }

    public function get_satker_code() {
        return $this->_satker_code;
    }

    public function get_nmsatker() {
        return $this->_nmsatker;
    }

    public function get_revision_no() {
        return $this->_revision_no;
    }

    public function get_meaning() {
        return $this->_meaning;
    }

    public function get_last_update_date() {
        return $this->_last_update_date;
    }
	
	public function get_table1() {
        return $this->_table1;
    }

	public function get_table3() {
        return $this->_table3;
    }
    /*
     * destruktor
     */

    public function __destruct() {
        
    }

}
