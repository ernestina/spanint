<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataUserSPAN {

    private $db;
	private $_kdkppn;
	private $_user_name;
    private $_last_name;
    private $_attribute1;
	private $_name;
	private $_responsibility_name;
    private $_email_address;
    private $_start_date;
	private $_end_date;
    private $_error;
    private $_valid = TRUE;
    private $_table = 'USER_SPAN';
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
    
    public function get_user_filter($filter) {
	Session::get('id_user');
        $sql = "SELECT KDKPPN, USER_NAME, LAST_NAME, ATTRIBUTE1, substr(NAME,12,30) NAME, EMAIL_ADDRESS, START_DATE, END_DATE FROM " . $this->_table. "
		WHERE KDKPPN = ".Session::get('id_user');
	  	
        foreach ($filter as $filter) {
			$sql .= " AND ".$filter;
			
		}
		$sql .= "  GROUP BY KDKPPN, USER_NAME, LAST_NAME, ATTRIBUTE1,NAME, EMAIL_ADDRESS, START_DATE, END_DATE";
		//var_dump($sql);
	    $result = $this->db->select($sql);
      	$data = array();   
        	foreach ($result as $val) {
            	$d_data = new $this($this->registry);
            	$d_data->set_kdkppn($val['KDKPPN']);
            	$d_data->set_user_name($val['USER_NAME']);
            	$d_data->set_last_name($val['LAST_NAME']);
            	$d_data->set_attribute1($val['ATTRIBUTE1']);
            	$d_data->set_name($val['NAME']);
            	$d_data->set_responsibility_name($val['RESPONSIBILITY_NAME']);
            	$d_data->set_email_address($val['EMAIL_ADDRESS']);
            	$d_data->set_start_date($val['START_DATE']);
            	$d_data->set_end_date($val['END_DATE']);
		 $data[] = $d_data;
        }
        return $data;
    }
	
    /*
     * setter
     */

    public function set_kdkppn($kdkppn) {
        $this->_kdkppn = $kdkppn;
    }
	
    public function set_user_name($user_name) {
        $this->_user_name = $user_name;
    }
	
    public function set_last_name($last_name) {
        $this->_last_name = $last_name;
    }
	
    public function set_attribute1($attribute1) {
        $this->_attribute1 = $attribute1;
    }
	
    public function set_name($name) {
        $this->_name = $name;
    }
	
    public function set_responsibility_name($responsibility_name) {
        $this->_responsibility_name = $responsibility_name;
    }
	
    public function set_email_address($email_address) {
        $this->_email_address = $email_address;
    }
	
    public function set_start_date($start_date) {
        $this->_start_date = $start_date;
    }
	
    public function set_end_date($end_date) {
        $this->_end_date = $end_date;
    }
	
	
	
	/*
     * getter
     */
	
	public function get_kdkppn() {
        return $this->_kdkppn;
    }
	
	public function get_user_name() {
        return $this->_user_name;
    }
	
	public function get_last_name() {
        return $this->_last_name;
    }
	
	public function get_attribute1() {
        return $this->_attribute1;
    }
	
	public function get_name() {
        return $this->_name;
    }
	
	public function get_responsibility_name() {
        return $this->_responsibility_name;
    }
	
	public function get_email_address() {
        return $this->_email_address;
    }
	
	public function get_start_date() {
        return $this->_start_date;
    }
	
	public function get_end_date() {
        return $this->_end_date;
    }
	

    /*
     * destruktor
     */

    public function __destruct() {
        
    }

}