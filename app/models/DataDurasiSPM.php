<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataDurasiSPM {

    private $db;
    private $_invoice_num;
    private $_aia_creation_date;
    private $_check_number;
    private $_attribute1;
    private $_aca_creation_date;
    private $_jam_upload;
    private $_jam_selesai_sp2d;
    private $_durasi;
    private $_table1 = 'DURATION_INV_ALL_V';
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

    public function get_durasi_spm_filter($filter) {
        Session::get('id_user');
        $sql = "SELECT DISTINCT * FROM "
                . $this->_table1 . " 
				WHERE 
				durasi2 > 0
				"
        ;
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }

        $sql .= " order by to_date(tanggal_upload, 'dd-mm-yyyy') desc, jam_selesai_sp2d DESC";

        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_invoice_num($val['INVOICE_NUM']);
            $d_data->set_aia_creation_date(date("d-m-Y", strtotime($val['TANGGAL_UPLOAD'])));
            $d_data->set_check_number($val['CHECK_NUMBER']);
            if ($val['TANGAL_SELESAI_SP2D'] != '') {
                $tgl_selesai_sp2d = date("d-m-Y", strtotime($val['TANGAL_SELESAI_SP2D']));
            } else {
                $tgl_selesai_sp2d = $val['TANGAL_SELESAI_SP2D'];
            }
            $d_data->set_aca_creation_date($tgl_selesai_sp2d);
            $d_data->set_attribute1($val['JENDOK']);
            $d_data->set_jam_upload($val['JAM_UPLOAD']);
            $d_data->set_jam_selesai_sp2d($val['JAM_SELESAI_SP2D']);
            $tgl_awalnya= date("d-m-Y", strtotime($val['TANGGAL_UPLOAD'])). ' ' . $val['JAM_UPLOAD'];
            $tgl_akhirnya = $tgl_selesai_sp2d . ' ' . $val['JAM_SELESAI_SP2D'];
            $durasi = CariWaktuKerja::cariBedaWaktuKerja($tgl_awalnya, $tgl_akhirnya);
            //var_dump($tgl_awalnya);var_dump($tgl_akhirnya);
            $d_data->set_durasi($durasi);
            $data[] = $d_data;
        }
        return $data;
    }

    public function get_jendok_spm_filter($filter=null) {
        Session::get('id_user');
        $sql = "SELECT DISTINCT JENDOK FROM "
                . $this->_table1 .
                " where jendok is not null "

        ;
        $no = 0;
        //foreach ($filter as $filter) {
        //$sql .= " AND ".$filter;
        //}

        $sql .= " order by jendok";

        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_attribute1($val['JENDOK']);

            $data[] = $d_data;
        }
        return $data;
    }

    /*
     * setter
     */

    public function set_invoice_num($invoice_num) {
        $this->_invoice_num = $invoice_num;
    }

    public function set_aia_creation_date($aia_creation_date) {
        $this->_aia_creation_date = $aia_creation_date;
    }

    public function set_check_number($check_number) {
        $this->_check_number = $check_number;
    }

    public function set_aca_creation_date($aca_creation_date) {
        $this->_aca_creation_date = $aca_creation_date;
    }

    public function set_durasi($durasi) {
        $this->_durasi = $durasi;
    }

    public function set_attribute1($attribute1) {
        $this->_attribute1 = $attribute1;
    }

    public function set_jam_upload($jam_upload) {
        $this->_jam_upload = $jam_upload;
    }

    public function set_jam_selesai_sp2d($jam_selesai_sp2d) {
        $this->_jam_selesai_sp2d = $jam_selesai_sp2d;
    }

    /*
     * getter
     */

    public function get_invoice_num() {
        return $this->_invoice_num;
    }

    public function get_aia_creation_date() {
        return $this->_aia_creation_date;
    }

    public function get_check_number() {
        return $this->_check_number;
    }

    public function get_aca_creation_date() {
        return $this->_aca_creation_date;
    }

    public function get_durasi() {
        return $this->_durasi;
    }

    public function get_attribute1() {
        return $this->_attribute1;
    }

    public function get_jam_upload() {
        return $this->_jam_upload;
    }

    public function get_jam_selesai_sp2d() {
        return $this->_jam_selesai_sp2d;
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
