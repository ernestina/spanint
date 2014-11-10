<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataPMRT {

    private $db;
    private $_nama_supplier;
    private $_npwp_supplier;
    private $_kdvalas;
    private $_nm_bank;
    private $_cabang;
    private $_kd_bank;
    private $_kd_swift;
    private $_iban;
    private $_asal_bank;
    private $_norek_bank;
    private $_norek_penerima;
    private $_nm_pemilik_rek;
    private $_npwp_penerima;
    private $_nip_penerima;
    private $_nm_penerima;
    private $_tipe_supp;
    private $_satker;
    private $_v_supplier_number;
    private $_kppn_code;
    private $_email;
    private $_alamat;
    private $_city;
    private $_provinsi;
    private $_negawa;
    private $_zip;
    private $_phone;
    private $_update_date;
    private $_ids;
    private $_kode_sandi;
    private $_error;
    private $_valid = TRUE;
    private $_table = 'SUPP';
    public $registry;

    /*
     * konstruktor
     */

    public function __construct($registry = Registry) {
        $this->db = $registry->db;
        $this->registry = $registry;
    }

    public function create_pmrt_from_file($file) {
        $docObj = new DocXConversion ($file);
        $data = $docObj->convertToText();
        
        return $data;
    }
    
    /*
     * setter
     */

    public function set_nama_supplier($nama_supplier) {
        $this->_nama_supplier = $nama_supplier;
    }

    public function set_npwp_supplier($npwp_supplier) {
        $this->_npwp_supplier = $npwp_supplier;
    }

    public function set_kdvalas($kdvalas) {
        $this->_kdvalas = $kdvalas;
    }

    public function set_nm_bank($nm_bank) {
        $this->_nm_bank = $nm_bank;
    }

    public function set_cabang($cabang) {
        $this->_cabang = $cabang;
    }

    public function set_kd_bank($kd_bank) {
        $this->_kd_bank = $kd_bank;
    }

    public function set_kd_swift($kd_swift) {
        $this->_kd_swift = $kd_swift;
    }

    public function set_iban($iban) {
        $this->_iban = $iban;
    }

    public function set_asal_bank($asal_bank) {
        $this->_asal_bank = $asal_bank;
    }

    public function set_norek_bank($norek_bank) {
        $this->_norek_bank = $norek_bank;
    }

    public function set_norek_penerima($norek_penerima) {
        $this->_norek_penerima = $norek_penerima;
    }

    public function set_nm_pemilik_rek($nm_pemilik_rek) {
        $this->_nm_pemilik_rek = $nm_pemilik_rek;
    }

    public function set_npwp_penerima($npwp_penerima) {
        $this->_npwp_penerima = $npwp_penerima;
    }

    public function set_nip_penerima($nip_penerima) {
        $this->_nip_penerima = $nip_penerima;
    }

    public function set_nm_penerima($nm_penerima) {
        $this->_nm_penerima = $nm_penerima;
    }

    public function set_tipe_supp($tipe_supp) {
        $this->_tipe_supp = $tipe_supp;
    }

    public function set_satker($satker) {
        $this->_satker = $satker;
    }

    public function set_v_supplier_number($v_supplier_number) {
        $this->_v_supplier_number = $v_supplier_number;
    }

    public function set_kppn_code($kppn_code) {
        $this->_kppn_code = $kppn_code;
    }

    public function set_email($email) {
        $this->_email = $email;
    }

    public function set_alamat($alamat) {
        $this->_alamat = $alamat;
    }

    public function set_city($city) {
        $this->_city = $city;
    }

    public function set_provinsi($provinsi) {
        $this->_provinsi = $provinsi;
    }

    public function set_negara($negara) {
        $this->_negara = $negara;
    }

    public function set_zip($zip) {
        $this->_zip = $zip;
    }

    public function set_phone($phone) {
        $this->_phone = $phone;
    }

    public function set_update_date($update_date) {
        $this->_update_date = $update_date;
    }

    public function set_ids($ids) {
        $this->_ids = $ids;
    }

    public function set_kode_sandi($kode_sandi) {
        $this->_kode_sandi = $kode_sandi;
    }

    /*
     * getter
     */

    public function get_nama_supplier() {
        return $this->_nama_supplier;
    }

    public function get_npwp_supplier() {
        return $this->_npwp_supplier;
    }

    public function get_kdvalas() {
        return $this->_kdvalas;
    }

    public function get_nm_bank() {
        return $this->_nm_bank;
    }

    public function get_cabang() {
        return $this->_cabang;
    }

    public function get_kd_bank() {
        return $this->_kd_bank;
    }

    public function get_kd_swift() {
        return $this->_kd_swift;
    }

    public function get_iban() {
        return $this->_iban;
    }

    public function get_asal_bank() {
        return $this->_asal_bank;
    }

    public function get_norek_bank() {
        return $this->_norek_bank;
    }

    public function get_norek_penerima() {
        return $this->_norek_penerima;
    }

    public function get_nm_pemilik_rek() {
        return $this->_nm_pemilik_rek;
    }

    public function get_npwp_penerima() {
        return $this->_npwp_penerima;
    }

    public function get_nip_penerima() {
        return $this->_nip_penerima;
    }

    public function get_nm_penerima() {
        return $this->_nm_penerima;
    }

    public function get_tipe_supp() {
        return $this->_tipe_supp;
    }

    public function get_satker() {
        return $this->_satker;
    }

    public function get_v_supplier_number() {
        return $this->_v_supplier_number;
    }

    public function get_kppn_code() {
        return $this->_kppn_code;
    }

    public function get_email() {
        return $this->_email;
    }

    public function get_alamat() {
        return $this->_alamat;
    }

    public function get_city() {
        return $this->_city;
    }

    public function get_provinsi() {
        return $this->_provinsi;
    }

    public function get_negara() {
        return $this->_negara;
    }

    public function get_zip() {
        return $this->_zip;
    }

    public function get_phone() {
        return $this->_phone;
    }

    public function get_update_date() {
        return $this->_update_date;
    }

    public function get_ids() {
        return $this->_ids;
    }

    public function get_kode_sandi() {
        return $this->_kode_sandi;
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
