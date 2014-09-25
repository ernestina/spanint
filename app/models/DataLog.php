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
    private $_duration;
    private $_activity_time_start;
    private $_activity_time_end;
    private $_ip_client;
    private $_status;
    private $_error;
    private $_valid = TRUE;
    private $_table = 'LOG_USER';
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
            //'KD_LOG' => $this->get_kd_log(),
            'KD_D_USER' => $this->get_kd_d_user(),
            'ACTIVITY' => $this->get_activity(),
            'DURATION' => $this->get_duration(),
            'ACTIVITY_TIME_START' => $this->get_activity_time_start(),
            'ACTIVITY_TIME_END' => $this->get_activity_time_end(),
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
		$this->set_activity_time_end(date("d-m-Y h:i:s"));
		$mulai = strtotime($this->get_activity_time_start());
		$selesai = strtotime($this->get_activity_time_end());
		$this->set_duration($selesai - $mulai);
		$this->set_ip_client($this->get_ip_address());
		$this->set_status($status);
                $this->add_d_log();
		return true;
    }
    
    function get_ip_address() {
        $ip_keys = array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR');
        foreach ($ip_keys as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    // trim for safety measures
                    $ip = trim($ip);
                    // attempt to validate IP
                    if ($this->validate_ip($ip)) {
                        return $ip;
                    }
                }
            }
        }

        return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : false;
    }

    /**
     * Ensures an ip address is both a valid IP and does not fall within
     * a private network range.
     */
    function validate_ip($ip) {
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
            return false;
        }
        return true;
    }

    private function getIp() {
        $ipaddress = 'localhost';
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else if (!empty($_SERVER['HTTP_X_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        } else if (!empty($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } else if (!empty($_SERVER['HTTP_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        } else if (!empty($_SERVER['REMOTE_ADDR'])) {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        } else {
            $ipaddress = 'UNKNOWN';
        }
        return $ipaddress;
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

    public function set_duration($duration) {
        $this->_duration = $duration;
    }

    public function set_activity_time_start($activity_time_start) {
        $this->_activity_time_start = $activity_time_start;
    }

    public function set_activity_time_end($activity_time_end) {
        $this->_activity_time_end = $activity_time_end;
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

    public function get_duration() {
        return $this->_duration;
    }

    public function get_activity_time_start() {
        return $this->_activity_time_start;
    }

    public function get_activity_time_end() {
        return $this->_activity_time_end;
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
