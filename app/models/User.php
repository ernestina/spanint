<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class User {

    public $registry;
    private $_table = "d_user";
    private $_table2 = "d_user2";
    public $_db;
    private $_kd_d_user;
    private $_kd_r_jenis;
    private $_kd_d_kppn;
    private $_nama_user;
    private $_pass_user;

    public function __construct($registry) {
        $this->registry = $registry;
        $this->_db = new Database();
    }

    public function login($username, $password) {
        $sql = "SELECT KD_R_JENIS,NAMA_USER,KD_D_KPPN,KD_SATKER,KD_DEPT,KD_UNIT FROM " . $this->_table2 . " WHERE KD_SATKER = '" . $username . "' AND SHA256 = '" . $password . "'";
        $result = $this->_db->select($sql);
        //var_dump($sql);
        //var_dump($result);
        $role = 0;
        $return = array();
        foreach ($result as $v) {
            $role = $v['KD_R_JENIS'];
            $kd = $v['NAMA_USER'];
            $id = $v['KD_D_KPPN'];
            $satker = $v['KD_SATKER'];
            $dept = $v['KD_DEPT'];
            $unit = $v['KD_UNIT'];
        }

        //$return[] = 1;
        //$role = 2;
        //$kd = 'KPPN JAKARTA II';
        //$id = '018';

        $return[] = count($result);
        $return[] = $role;
        $return[] = $kd;
        $return[] = $id;
        $return[] = $satker;
        $return[] = $dept.$unit;
        return $return;
    }

    public function get_kd_d_user() {
        return $this->_kd_d_user;
    }

    public function set_kd_d_user($kd_d_user) {
        $this->_kd_d_user = $kd_d_user;
    }

    public function get_kd_r_jenis() {
        return $this->_kd_r_jenis;
    }

    public function set_kd_r_jenis($kd_r_jenis) {
        $this->_kd_r_jenis = $kd_r_jenis;
    }

    public function get_kd_d_kppn() {
        return $this->_kd_d_kppn;
    }

    public function set_kd_d_kppn($kd_r_unit) {
        $this->_kd_d_kppn = $kd_r_unit;
    }

    public function get_nama_user() {
        return $this->_nama_user;
    }

    public function set_nama_user($nama_user) {
        $this->_nama_user = $nama_user;
    }

    public function get_pass_user() {
        return $this->_pass_user;
    }

    public function set_pass_user($pass_user) {
        $this->_pass_user = $pass_user;
    }

}
