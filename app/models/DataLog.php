<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataLog {

    private $db;
    private $_kd_log;
    private $_kd_d_user;
    private $_activity;
    private $_activity_time;
    private $_ip_client;
    private $_status;
    private $_error;
    private $_valid = TRUE;
    private $_table = 'USRAPL14.LOG_USER';
    public $registry;

    /*
     * konstruktor
     */

    public function __construct($registry = Registry) {
        $this->db = $registry->db;
        $this->registry = $registry;
    }

    public function add_d_log() {
        $data = array(
            'KD_LOG' => $this->get_kd_log(),
            'KD_D_USER' => $this->get_kd_d_user(),
            'ACTIVITY' => $this->get_activity(),
            'ACTIVITY_TIME' => $this->get_activity_time(),
            'IP_CLIENT' => $this->get_ip_client(),
            'STATUS' => $this->get_status()
        );
        if (!$this->get_valid()) {
            return false;
        }
        if (!is_array($data)) {
            return false;
        }
		//var_dump($data);
        return $this->db->insert($this->_table, $data);
    }
	
    public function tambah_log($status) {
        //$this->set_kd_log('');
		$this->set_kd_d_user(Session::get('kd_satker'));
		$this->set_activity("$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
		$this->set_activity_time(date("d-m-Y h:i:s"));
		$this->set_ip_client($this->getIp());
		$this->set_status($status);
        $this->add_d_log();
		return true;
    }
	
	private function getIp() {
		$ip = $_SERVER['REMOTE_ADDR'];
		
		if (!empty($_SERVER['HTTP_CLIENT_IP'])){
			$ip=$_SERVER['HTTP_CLIENT_IP'];
		} else if (!empty($_SERVER['HTTP_X_FORWARDER_FOR'])){
			$ip = $_SERVER['HTTP_X_FORWARDER_FOR'];
		}
		return $ip;
	}

    /*
     * setter
     */

    public function set_kd_log($kd_log) {
        $this->_kd_log = $kd_log;
    }

    public function set_kd_d_user($kd_d_user) {
        $this->_kd_d_user = $kd_d_user;
    }

    public function set_activity($activity) {
        $this->_activity = $activity;
    }

    public function set_activity_time($activity_time) {
        $this->_activity_time = $activity_time;
    }

    public function set_ip_client($ip_client) {
        $this->_ip_client = $ip_client;
    }

    public function set_status($status) {
        $this->_status = $status;
    }

    /*
     * getter
     */

    public function get_kd_log() {
        return $this->_kd_log;
    }

    public function get_kd_d_user() {
        return $this->_kd_d_user;
    }

    public function get_activity() {
        return $this->_activity;
    }

    public function get_activity_time() {
        return $this->_activity_time;
    }

    public function get_ip_client() {
        return $this->_ip_client;
    }

    public function get_status() {
        return $this->_status;
    }

    public function get_valid() {
        return $this->_valid;
    }

    /*
     * destruktor
     */

    public function __destruct() {
        
    }

}
