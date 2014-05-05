<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataNamaSatker{

    private $db;
	private $_kdsatker;
	private $_nmsatker;
	private $_kppn;
	private $_table1 = 'T_SATKER';
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
    
    public function get_satker_filter($filter) {
		Session::get('id_user');
		$sql = "SELECT KDSATKER, UPPER(NMSATKER) NMSATKER , KPPN
				FROM " 
				. $this->_table1. "
				WHERE  
				KPPN = '".Session::get('id_user')."'"
				
				;
				
		$no=0;
		foreach ($filter as $filter) {
			$sql .= " AND ".$filter;
		}
		
		
		$sql .= " ORDER BY NMSATKER";
				//var_dump ($sql);

        $result = $this->db->select($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_kdsatker($val['KDSATKER']);
			$d_data->set_nmsatker($val['NMSATKER']);
            $d_data->set_kppn($val['KPPN']);
            $data[] = $d_data;
        }
        return $data;
    }
	
    /*
     * setter
     */

    public function set_nmsatker($nmsatker) {
        $this->_nmsatker = $nmsatker;
    }
	public function set_kdsatker($kdsatker) {
        $this->_kdsatker = $kdsatker;
    }
	public function set_kppn($kppn) {
        $this->_kppn = $kppn;
    }
	
	/*
     * getter
     */
	
	public function get_nmsatker() {
        return $this->_nmsatker;
    }
	
	public function get_kdsatker() {
        return $this->_kdsatker;
    }
	
	public function get_kppn() {
        return $this->_kppn;
    }
		
    /*
     * destruktor
     */

    public function __destruct() {
        
    }

}