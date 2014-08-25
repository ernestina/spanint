<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataPelimpahan {

    private $db;
    private $_kppn_anak;
    private $_akun_limpah;
    private $_jml_limpah;
    private $_nosakti_limpah;
    private $_norek_persepsi;
    private $_nmrek_persepsi;
    private $_kppn_induk;
    private $_norek_501;
    private $_nmrek_501;
    private $_akun_terima;
    private $_jml_terima;
    private $_nosakti_bs;
    private $_status;
    private $_tipe_transaksi;
    private $_tgl_terima;
    private $_tgl_limpah;
    private $_status_amount;
    private $_error;
    private $_valid = TRUE;
    private $_table = 'USRAPL14.T_LIMPAH';
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

    public function get_limpah_filter($filter) {
        $sql = "SELECT 
				KPPN_ANAK, AKUN_LIMPAH, JML_LIMPAH, NOSAKTI_LIMPAH,
				NOREK_PERSEPSI, NMREK_PERSEPSI,
				KPPN_INDUK, NOREK_501, NMREK_501, AKUN_TERIMA, JML_TERIMA,
				NOSAKTI_BS, STATUS
				FROM  " . $this->_table . "
				WHERE 1=1 ";
        //SP2D = 140181301002823
        //xml = 520002000990_SP2D_O_20140408_101509_367.xml
        $no = 0;
        //var_dump($filter);
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $sql .= " ORDER BY TGL_LIMPAH DESC";
        //var_dump ($sql);
        $result = $this->db->select($sql);
		//var_dump ($result);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_kppn_anak($val['KPPN_ANAK']);
            $d_data->set_akun_limpah($val['AKUN_LIMPAH']);
            $d_data->set_jml_limpah(number_format($val['JML_LIMPAH']));
            $d_data->set_nosakti_limpah($val['NOSAKTI_LIMPAH']);
            $d_data->set_norek_persepsi($val['NOREK_PERSEPSI']);
            $d_data->set_nmrek_persepsi($val['NMREK_PERSEPSI']);
            $d_data->set_kppn_induk($val['KPPN_INDUK']);
            $d_data->set_norek_501($val['NOREK_501']);
            $d_data->set_nmrek_501($val['NMREK_501']);
            $d_data->set_akun_terima($val['AKUN_TERIMA']);
            $d_data->set_jml_terima(number_format($val['JML_TERIMA']));
            $d_data->set_nosakti_bs($val['NOSAKTI_BS']);
            $d_data->set_status($val['STATUS']);
            $data[] = $d_data;
			//var_dump($d_data);
        }
		//var_dump($data);
        return $data;
    }

    /*
     * setter
     */

    public function set_kppn_anak($kppn_anak) {
        $this->_kppn_anak = $kppn_anak;
    }

    public function set_akun_limpah($akun_limpah) {
        $this->_akun_limpah = $akun_limpah;
    }

    public function set_jml_limpah($jml_limpah) {
        $this->_jml_limpah = $jml_limpah;
    }

    public function set_nosakti_limpah($nosakti_limpah) {
        $this->_nosakti_limpah = $nosakti_limpah;
    }

    public function set_norek_persepsi($norek_persepsi) {
        $this->_norek_persepsi = $norek_persepsi;
    }

    public function set_nmrek_persepsi($nmrek_persepsi) {
        $this->_nmrek_persepsi = $nmrek_persepsi;
    }

    public function set_kppn_induk($kppn_induk) {
        $this->_kppn_induk = $kppn_induk;
    }

    public function set_norek_501($norek_501) {
        $this->_norek_501 = $norek_501;
    }

    public function set_nmrek_501($nmrek_501) {
        $this->_nmrek_501 = $nmrek_501;
    }

    public function set_akun_terima($akun_terima) {
        $this->_akun_terima = $akun_terima;
    }

    public function set_jml_terima($jml_terima) {
        $this->_jml_terima = $jml_terima;
    }

    public function set_nosakti_bs($nosakti_bs) {
        $this->_nosakti_bs = $nosakti_bs;
    }

    public function set_status($status) {
        $this->_status = $status;
    }

    public function set_tipe_transaksi($tipe_transaksi) {
        $this->_tipe_transaksi = $tipe_transaksi;
    }

    public function set_tgl_terima($tgl_terima) {
        $this->_tgl_terima = $tgl_terima;
    }

    public function set_tgl_limpah($tgl_limpah) {
        $this->_tgl_limpah = $tgl_limpah;
    }

    public function set_status_amount($status_amount) {
        $this->_status_amount = $status_amount;
    }

    /*
     * getter
     */

    public function get_kppn_anak() {
        return $this->_kppn_anak;
    }

    public function get_akun_limpah() {
        return $this->_akun_limpah;
    }

    public function get_jml_limpah() {
        return $this->_jml_limpah;
    }

    public function get_norek_persepsi() {
        return $this->_norek_persepsi;
    }

    public function get_nmrek_persepsi() {
        return $this->_nmrek_persepsi;
    }

    public function get_kppn_induk() {
        return $this->_kppn_induk;
    }

    public function get_norek_501() {
        return $this->_norek_501;
    }

    public function get_nmrek_501() {
        return $this->_nmrek_501;
    }

    public function get_akun_terima() {
        return $this->_akun_terima;
    }

    public function get_jml_terima() {
        return $this->_jml_terima;
    }

    public function get_nosakti_bs() {
        return $this->_nosakti_bs;
    }

    public function get_nosakti_limpah() {
        return $this->_nosakti_limpah;
    }

    public function get_status() {
        return $this->_status;
    }

    public function get_tipe_transaksi() {
        return $this->_tipe_transaksi;
    }

    public function get_tgl_terima() {
        return $this->_tgl_terima;
    }

    public function get_tgl_limpah() {
        return $this->_tgl_limpah;
    }

    public function get_status_amount() {
        return $this->_status_amount;
    }

    public function get_table() {
        return $this->_table;
    }

    /*
     * destruktor
     */

    public function __destruct() {
        
    }

}
