<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataLastUpdate {

    private $db;
    private $_table_name;
    private $_last_update;
    private $_valid = TRUE;
    private $_table = 'T_LAST_UPDATE';
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
    
    public function get_last_updatenya($filter) {
		$sql = "SELECT TABLE_NAME, to_char(MAX(LAST_UPDATE),'dd-mm-yyyy hh24:mi:ss') LAST_UPDATE
				FROM T_LAST_UPDATE
				WHERE TABLE_NAME = '".$filter."' group by TABLE_NAME";
        $result = $this->db->select($sql);
		//var_dump ($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_table_name($val['TABLE_NAME']);
            $d_data->set_last_update($val['LAST_UPDATE']);
			$data[] = $d_data;
        }
        return $data;
    }
	
    /*
     * setter
     */

    public function set_table_name($table_name) {
        $this->_table_name = $table_name;
    }
	
    public function set_last_update($last_update) {
        $this->_last_update = $last_update;
    }
		
	/*
     * getter
     */
	
	public function get_table_name() {
        return $this->_table_name;
    }
	
	public function get_last_update() {
        return $this->_last_update;
    }

    /*
     * destruktor
     */

    public function __destruct() {
        
    }

}