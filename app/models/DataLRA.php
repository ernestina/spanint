<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataLRA {

    private $db;
    private $_deskripsi;
    private $_apbn;
    private $_realisasi_bun;
    private $_realisasi_kppn;
    private $_jumlah;
    private $_table1 = 'LRA_APBN';
    
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

    public function get_lra_apbn($filter) {
        Session::get('id_user');
        $sql = "SELECT * 
				FROM "
                . $this->_table1 .
				" where 1=1 "
				
				;
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }

        //$sql .= " ORDER BY A.KPPN, A.AKUN ";

        //var_dump($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
			$d_data->set_deskripsi($val['DESCRIPTION']);
            $d_data->set_apbn($val['APBN']);
            $d_data->set_realisasi_bun($val['REALIASI_BUN']);
            $d_data->set_realisasi_kppn($val['REALIASI_KPP']);
            $d_data->set_jumlah($val['JUMALAH']);     
            $data[] = $d_data;
        }
        return $data;
    }
	

    /*
     * setter
     */

    public function set_deskripsi($deskripsi) {
        $this->_deskripsi = $deskripsi;
    }

    public function set_apbn($apbn) {
        $this->_apbn = $apbn;
    }

    public function set_realisasi_bun($realisasi_bun) {
        $this->_realisasi_bun = $realisasi_bun;
    }

    public function set_realisasi_kppn($realisasi_kppn) {
        $this->_realisasi_kppn = $realisasi_kppn;
    }

    public function set_jumlah($jumlah) {
        $this->_jumlah = $jumlah;
    }

    /*
     * getter
     */
	
	public function get_deskripsi() {
        return $this->_deskripsi;
    }
	
    public function get_apbn() {
        return $this->_apbn;
    }

    public function get_realisasi_bun() {
        return $this->_realisasi_bun;
    }

    public function get_realisasi_kppn() {
        return $this->_realisasi_kppn;
    }

    public function get_jumlah() {
        return $this->_jumlah;
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
