<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataBPN {

    private $db;
    private $_kdkppn;
    private $_tgl_sp2d;
    private $_no_sp2d;
    private $_nama2;
    private $_npwp;
    private $_akun;
    private $_deskripsi_akun;
    private $_nilai_ori;
    private $_no_tagihan;
    private $_no_spm;
    private $_tgl_spm;
    private $_jendok_exis;
    private $_satker;
    private $_kppn;
    private $_invoice_id;
    private $_description;
    private $_supplier_site;
    private $_remit_to_supplier_site;
    private $_remit_to_supplier_id;
    private $_kd_satker;
    private $_kd_satker_dipa;
    private $_table = 'SPPM_BPN';
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

    public function get_bpn_filter($filter) {
        $sql = "SELECT KPPN, TGL_SP2D, NO_SP2D, NO_SPM, TGL_SPM, NAMA2, AKUN, NILAI_ORI, DESKRIPSI_AKUN, DESCRIPTION, substr(no_spm,8,6) SATKER, NO_TAGIHAN
				FROM ". $this->_table . " 
				 WHERE 1=1 AND substr(TGL_SP2D,1,4) = '".Session::get('ta')."' " ;
        ;
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $sql .= " ORDER BY TGL_SPM DESC, TGL_SP2D DESC ";
        //var_dump($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_kppn($val['KPPN']);
            $d_data->set_tgl_sp2d(date("d-m-Y", strtotime($val['TGL_SP2D'])));
            $d_data->set_no_sp2d($val['NO_SP2D']);
            $d_data->set_no_spm($val['NO_SPM']);
            $d_data->set_tgl_spm(date("d-m-Y", strtotime($val['TGL_SPM'])));
            $d_data->set_nama2($val['NAMA2']);
            $d_data->set_akun($val['AKUN']);
            $d_data->set_nilai_ori($val['NILAI_ORI']);
            $d_data->set_deskripsi_akun($val['DESKRIPSI_AKUN']);
            $d_data->set_description($val['DESCRIPTION']);
            $d_data->set_satker($val['SATKER']);
            $d_data->set_no_tagihan($val['NO_TAGIHAN']);
            $data[] = $d_data;
        }
        return $data;
    }
    
    public function get_bpn_satker_filter($filter) {
        $sql = "SELECT KPPN, TGL_SP2D, NO_SP2D, NO_SPM, TGL_SPM, NAMA2, AKUN, 
                NILAI_ORI, DESKRIPSI_AKUN, DESCRIPTION, SATKER, NO_TAGIHAN
				FROM ". $this->_table . " 
				 WHERE 1=1 AND substr(TGL_SP2D,1,4) = '".Session::get('ta')."' " ;
        ;
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $sql .= " ORDER BY TGL_SPM DESC, TGL_SP2D DESC ";
        //var_dump($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_kppn($val['KPPN']);
            $d_data->set_tgl_sp2d(date("d-m-Y", strtotime($val['TGL_SP2D'])));
            $d_data->set_no_sp2d($val['NO_SP2D']);
            $d_data->set_no_spm($val['NO_SPM']);
            $d_data->set_tgl_spm(date("d-m-Y", strtotime($val['TGL_SPM'])));
            $d_data->set_nama2($val['NAMA2']);
            $d_data->set_akun($val['AKUN']);
            $d_data->set_nilai_ori($val['NILAI_ORI']);
            $d_data->set_deskripsi_akun($val['DESKRIPSI_AKUN']);
            $d_data->set_description($val['DESCRIPTION']);
            $d_data->set_satker($val['SATKER']);
            $d_data->set_no_tagihan($val['NO_TAGIHAN']);
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

    public function set_tgl_sp2d($tgl_sp2d) {
        $this->_tgl_sp2d = $tgl_sp2d;
    }

    public function set_no_sp2d($no_sp2d) {
        $this->_no_sp2d = $no_sp2d;
    }

    public function set_nama2($nama2) {
        $this->_nama2 = $nama2;
    }

    public function set_npwp($npwp) {
        $this->_npwp = $npwp;
    }

    public function set_akun($akun) {
        $this->_akun = $akun;
    }

    public function set_deskripsi_akun($deskripsi_akun) {
        $this->_deskripsi_akun = $deskripsi_akun;
    }

    public function set_nilai_ori($nilai_ori) {
        $this->_nilai_ori = $nilai_ori;
    }

    public function set_no_tagihan($no_tagihan) {
        $this->_no_tagihan = $no_tagihan;
    }

    public function set_no_spm($no_spm) {
        $this->_no_spm = $no_spm;
    }

    public function set_tgl_spm($tgl_spm) {
        $this->_tgl_spm = $tgl_spm;
    }

    public function set_jendok_exis($jendok_exis) {
        $this->_jendok_exis = $jendok_exis;
    }

    public function set_satker($satker) {
        $this->_satker = $satker;
    }

    public function set_kppn($kppn) {
        $this->_kppn = $kppn;
    }

    public function set_invoice_id($invoice_id) {
        $this->_invoice_id = $invoice_id;
    }

    public function set_description($description) {
        $this->_description = $description;
    }

    public function set_supplier_site($supplier_site) {
        $this->_supplier_site = $supplier_site;
    }

    public function set_remit_to_supplier_site($remit_to_supplier_site) {
        $this->_remit_to_supplier_site = $remit_to_supplier_site;
    }

    public function set_remit_to_supplier_id($remit_to_supplier_id) {
        $this->_remit_to_supplier_id = $remit_to_supplier_id;
    }

    public function set_kd_satker($kd_satker) {
        $this->_kd_satker = $kd_satker;
    }

    public function set_kd_satker_dipa($kd_satker_dipa) {
        $this->_kd_satker_dipa = $kd_satker_dipa;
    }

    /*
     * getter
     */

    public function get_kdkppn() {
        return $this->_kdkppn;
    }

    public function get_tgl_sp2d() {
        return $this->_tgl_sp2d;
    }

    public function get_no_sp2d() {
        return $this->_no_sp2d;
    }

    public function get_nama2() {
        return $this->_nama2;
    }

    public function get_npwp() {
        return $this->_npwp;
    }

    public function get_akun() {
        return $this->_akun;
    }

    public function get_deskripsi_akun() {
        return $this->_deskripsi_akun;
    }

    public function get_nilai_ori() {
        return $this->_nilai_ori;
    }

    public function get_no_tagihan() {
        return $this->_no_tagihan;
    }

    public function get_no_spm() {
        return $this->_no_spm;
    }

    public function get_tgl_spm() {
        return $this->_tgl_spm;
    }

    public function get_jendok_exis() {
        return $this->_jendok_exis;
    }

    public function get_satker() {
        return $this->_satker;
    }

    public function get_kppn() {
        return $this->_kppn;
    }

    public function get_invoice_id() {
        return $this->_invoice_id;
    }

    public function get_description() {
        return $this->_description;
    }

    public function get_supplier_site() {
        return $this->_supplier_site;
    }

    public function get_remit_to_supplier_site() {
        return $this->_remit_to_supplier_site;
    }

    public function get_remit_to_supplier_id() {
        return $this->_remit_to_supplier_id;
    }

    public function get_kd_satker() {
        return $this->_kd_satker;
    }

    public function get_kd_satker_dipa() {
        return $this->_kd_satker_dipa;
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
