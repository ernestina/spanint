<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataPFK {

    private $db;
    private $_akun;
    private $_potongan_spm;
    private $_setoran_mpn;
    private $_uraian_akun;
    private $_kppn;
    private $_total;
    private $_table1 = 'PFK_SPAN_PVT';
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

    public function get_gr_pfk_filter($filter, $bulan) {
        Session::get('id_user');
        $no = 0;
        //foreach ($filter as $filter);
        $sql = "select 
				akun,
				max(uraian_akun) uraian_akun,
				sum(case when trx = 1 then " . $bulan . " * (-1) end) potongan_spm,
				sum(case when trx = 2 then " . $bulan . " * (-1) end) setoran_mpn
				from "
                . $this->_table1 . "
				WHERE 1=1"

        ;

        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $sql .= " GROUP BY akun ORDER BY akun";

        //var_dump ($sql);


        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_akun($val['AKUN']);
            $d_data->set_uraian_akun($val['URAIAN_AKUN']);
            $d_data->set_potongan_spm($val['POTONGAN_SPM']);
            $d_data->set_setoran_mpn($val['SETORAN_MPN']);
            $d_data->set_total($val['SETORAN_MPN'] + $val['POTONGAN_SPM']);
            $data[] = $d_data;
        }
        return $data;
    }

    /*
     * setter
     */

    public function set_akun($akun) {
        $this->_akun = $akun;
    }

    public function set_potongan_spm($potongan_spm) {
        $this->_potongan_spm = $potongan_spm;
    }

    public function set_kppn($kppn) {
        $this->_kppn = $kppn;
    }

    public function set_setoran_mpn($setoran_mpn) {
        $this->_setoran_mpn = $setoran_mpn;
    }

    public function set_total($total) {
        $this->_total = $total;
    }

    public function set_uraian_akun($uraian_akun) {
        $this->_uraian_akun = $uraian_akun;
    }

    /*
     * getter
     */

    public function get_akun() {
        return $this->_akun;
    }

    public function get_kppn() {
        return $this->_kppn;
    }

    public function get_potongan_spm() {
        return $this->_potongan_spm;
    }

    public function get_setoran_mpn() {
        return $this->_setoran_mpn;
    }

    public function get_total() {
        return $this->_total;
    }

    public function get_uraian_akun() {
        return $this->_uraian_akun;
    }

    /*
     * destruktor
     */

    public function __destruct() {
        
    }

    /* update */
}
