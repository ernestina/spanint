<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataUser {

    private $db;
    private $_kd_d_user;
    private $_kd_r_jenis;
    private $_kd_d_kppn;
    private $_nama_user;
	private $_nama_kppn;
    private $_pass_user;
	private $_kd_satker;
	private $_kd_dept;
	private $_kd_unit;
    private $_error;
    private $_valid = TRUE;
    private $_table = 'USRAPL14.d_user';
	private $_table2 = 'MASTERAPL.t_kppn';
    private $_table1 = 't_satker';
    public $registry;

    /*
     * konstruktor
     */

    public function __construct($registry = Registry) {
        $this->db = $registry->db;
        $this->registry = $registry;
    }

    public function get_d_user($limit = null, $batas = null) {
        $sql = "SELECT * FROM " . $this->_table . " ORDER BY kd_d_kppn";
        if (!is_null($limit) AND !is_null($batas)) {
            $sql .= " LIMIT " . $limit . "," . $batas;
        }
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_user = new $this($this->registry);
            $d_user->set_kd_d_user($val['kd_d_user']);
            $d_user->set_kd_r_jenis($val['kd_r_jenis']);
            $d_user->set_kd_d_kppn($val['kd_d_kppn']);
            $d_user->set_nama_user($val['nama_user']);
            $d_user->set_pass_user($val['pass_user']);
			$d_user->set_kd_satker($val['kd_satker']);
			$d_user->set_kd_dept($val['kd_dept']);
			$d_user->set_kd_unit($val['kd_unit']);

            $data[] = $d_user;
        }

        return $data;
    }
	
	public function get_kppn_kanwil($kd_kanwil = null) {
        $sql = "SELECT * FROM " . $this->_table." WHERE  "; 
		if (!is_null($kd_kanwil)){
			$sql .= " kd_kanwil=" . $kd_kanwil." AND";
		}
		$sql .= " KD_R_JENIS = 3 ORDER BY KD_D_KPPN";
        $result = $this->db->select($sql);
        $data = array();
		//var_dump($sql);
        foreach ($result as $val) {
            $d_user = new $this($this->registry);
            $d_user->set_kd_d_kppn($val['KD_D_KPPN']);
            $d_user->set_nama_user(substr($val['NAMA_USER'],5,20));

            $data[] = $d_user;
        }
		//var_dump($data);
        return $data;
    }
	
	public function get_akses_kppn_satker($kolom,$nilai) {
		$session_check = "GUEST = '000'";
		if (Session::get('role') == ADMIN){
			$session_check = "";
		}
		if (Session::get('role') == SATKER){
			$session_check = "AND KDSATKER = '".Session::get('kd_satker')."'";
		}
		if (Session::get('role') == KPPN){
			$session_check = "AND KPPN = '".Session::get('kd_satker')."'";
		}
		if (Session::get('role') == PKN){
			$session_check = "";
		}
		if (Session::get('role') == KANWIL){
			$session_check = "AND KANWIL_DJPB = '".Session::get('kd_satker')."'";
		}
		if (Session::get('role') == DJA){
			$session_check = "";
		}
        $sql = "SELECT * FROM " . $this->_table1." WHERE  ".$kolom." = '".$nilai."'".$session_check; 
        $result = $this->db->select($sql);
		var_dump($sql);
        if (count($result)>=1){
			return TRUE;
		} else {
			return FALSE;
		}
    }

    public function get_d_user_by_id($id) {
        $sql = "SELECT * FROM " . $this->_table . " WHERE kd_d_user=" . $id;
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_user = new $this($this->registry);
            $d_user->set_kd_d_user($val['kd_d_user']);
            $d_user->set_kd_r_jenis($val['kd_r_jenis']);
            $d_user->set_kd_d_kppn($val['kd_d_kppn']);
            $d_user->set_nama_user($val['nama_user']);
            $d_user->set_pass_user($val['pass_user']);
			$d_user->set_kd_satker($val['kd_satker']);
			$d_user->set_kd_dept($val['kd_dept']);
			$d_user->set_kd_unit($val['kd_unit']);

            $data[] = $d_user;
        }

        return $data;
    }
	    public function get_d_user_nmkppn($kdsatker) {
		$sql = "SELECT A.*, B.NMKPPN NMKPPN
				FROM " 
				. $this->_table. " A, "
				. $this->_table2. " B 
				WHERE
				A.KD_D_KPPN=B.KDKPPN 
				AND A.KD_R_JENIS='2' 
				AND A.KD_SATKER = '" . $kdsatker."'";
		
		//var_dump($sql);
        $result = $this->db->select($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_user = new $this($this->registry);
			$d_user->set_nama_kppn($val['NMKPPN']);

            $data[] = $d_user;
        }
        return $data;
    }

    public function get_d_user_kppn($kppn) {
        $sql = "SELECT * FROM " . $this->_table . " WHERE KD_SATKER = '" . $kppn."'";
        $result = $this->db->select($sql);
		//var_dump($sql);
        $data = array();
        foreach ($result as $val) {
            $d_user = new $this($this->registry);
            $d_user->set_nama_user($val['NAMA_USER']);
			$d_user->set_kd_satker($val['KD_SATKER']);

            $data[] = $d_user;
        }
        return $data;
    }

	
    public function add_d_user() {
        $data = array(
            'kd_r_jenis' => $this->get_kd_r_jenis(),
            'kd_d_kppn' => $this->get_kd_d_kppn(),
            'nama_user' => $this->get_nama_user(),
            'pass_user' => $this->get_pass_user(),
            'kd_satker' => $this->get_kd_saker(),
            'kd_dept' => $this->get_kd_dept(),
            'kd_unit' => $this->get_kd_unit()
        );
        $this->validate();
        if (!$this->get_valid()) {
            return false;
        }
        if (!is_array($data)) {
            return false;
        }
        return $this->db->insert($this->_table, $data);
    }

    public function update_d_user() {
        $data = array(
            'kd_d_user' => $this->get_kd_d_user(),
            'kd_r_jenis' => $this->get_kd_r_jenis(),
            'kd_d_kppn' => $this->get_kd_d_kppn(),
            'nama_user' => $this->get_nama_user(),
            'pass_user' => $this->get_pass_user(),
            'kd_satker' => $this->get_kd_saker(),
            'kd_dept' => $this->get_kd_dept(),
            'kd_unit' => $this->get_kd_unit()
        );
        $this->validate();
        if (!$this->get_valid()) {
            return false;
        }
        if (!is_array($data)) {
            return false;
        }
        $where = ' kd_d_user=' . $this->get_kd_d_user();
        return $this->db->update($this->_table, $data, $where);
    }

    public function delete_d_user() {
        $where = ' kd_d_user=' . $this->get_kd_d_user();
        $this->db->delete($this->_table, $where);
    }

    public function validate() {
        if ($this->get_kd_r_jenis() == "") {
            $this->_error .= "Jenis user belum diinput!<?br>";
            $this->_valid = FALSE;
        }
        if ($this->get_kd_d_kppn() == "") {
            $this->_error .= "Unit User belum diinput!</br>";
            $this->_valid = FALSE;
        }
        if ($this->get_nama_user() == "") {
            $this->_error .= "Nama belum diinput!</br>";
            $this->_valid = FALSE;
        }
        if ($this->get_pass_user() == "") {
            $this->_error .= "Pass belum diinput!</br>";
            $this->_valid = FALSE;
        }
    }

    /*
     * setter
     */

    public function set_kd_d_user($kode) {
        $this->_kd_d_user = $kode;
    }

    public function set_kd_r_jenis($jenis) {
        $this->_kd_r_jenis = $jenis;
    }

    public function set_kd_d_kppn($unit) {
        $this->_kd_d_kppn = $unit;
    }

    public function set_nama_user($nama) {
        $this->_nama_user = $nama;
    }

	public function set_nama_kppn($kppn) {
        $this->_nama_kppn = $kppn;
    }

    public function set_pass_user($pass) {
        $this->_pass_user = $pass;
    }

    public function set_kd_satker($satker) {
        $this->_kd_satker = $satker;
    }

    public function set_kd_dept($dept) {
        $this->_kd_dept = $dept;
    }

    public function set_kd_unit($unit) {
        $this->_kd_unit = $unit;
    }

    public function set_table($table) {
        $this->_table = $table;
    }

    /*
     * getter
     */

    public function get_kd_d_user($where = null) {
        if (!is_null($where)) {
            $sql = "SELECT kd_d_user FROM '" . $this->_table . "' WHERE '" . $where . "'";
            $result = $this->db->select($sql);
            foreach ($result as $val) {
                $this->set_kd_d_user($val['kd_d_user']);
            }
        }
        return $this->_kd_d_user;
    }

    public function get_kd_r_jenis() {
        return $this->_kd_r_jenis;
    }

    public function get_kd_d_kppn() {
        return $this->_kd_d_kppn;
    }

    public function get_nama_user() {
        return $this->_nama_user;
    }

	public function get_nama_kppn() {
		return $this->_nama_kppn;
    }
	

    public function get_pass_user() {
        return $this->_pass_user;
    }

    public function get_kd_satker() {
        return $this->_kd_satker;
    }

    public function get_kd_dept() {
        return $this->_kd_dept;
    }

    public function get_kd_unit() {
        return $this->_kd_unit;
    }

    public function get_error() {
        return $this->_error;
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