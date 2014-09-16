<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataCheck {

    private $db;
    private $_jenis_sp2d;
    private $_amount;
    private $_base_amount;
    private $_invoice_num;
    private $_invoice_date;
    private $_description;
    private $_check_number;
    private $_check_date;
    private $_attribute6;
    private $_nmsatker;
    private $_jendok;
    private $_creation_date;
    private $_currency_code;
    private $_exchange_date;
    private $_exchange_rate;
    private $_jumlah_sp2d;
    private $_total_sp2d;
    private $_status_lookup_code;
    private $_thang;
    private $_kdbankpos;
    private $_pilih;
    private $_tgl1;
    private $_tgl2;
    private $_table1 = 'AP_CHECKS_ALL_V';
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

    public function get_sp2d_satker_filter($filter) {
        Session::get('id_user');
        $sql = "SELECT *
				FROM "
                . $this->_table1 . "
				WHERE 
				STATUS_LOOKUP_CODE <> 'VOIDED'"

        ;

        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }


        $sql .= " ORDER BY CHECK_DATE DESC";
        //var_dump ($sql);

        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_jenis_sp2d($val['JENIS_SP2D']);
            $d_data->set_amount($val['AMOUNT']);
            $d_data->set_base_amount($val['BASE_AMOUNT']);
            $d_data->set_invoice_num($val['INVOICE_NUM']);
            $d_data->set_invoice_date(date("d-m-Y", strtotime($val['INVOICE_DATE'])));
            $d_data->set_description($val['DESCRIPTION']);
            $d_data->set_check_number($val['CHECK_NUMBER']);
            $d_data->set_check_date(date("d-m-Y", strtotime($val['CHECK_DATE'])));
            $d_data->set_attribute6($val['JENIS_SPM']);
            $d_data->set_nmsatker($val['NMSATKER']);
            $d_data->set_currency_code($val['CURRENCY_CODE']);
            $d_data->set_exchange_date(date("d-m-Y", strtotime($val['EXCHANGE_DATE'])));
            $d_data->set_exchange_rate($val['EXCHANGE_RATE']);
            $d_data->set_creation_date(date("d-m-Y", strtotime($val['CREATION_DATE'])));
            $d_data->set_status_lookup_code($val['STATUS_LOOKUP_CODE']);
            $data[] = $d_data;
        }
        return $data;
    }

    public function get_jenis_spm_filter($satker = null) {
        Session::get('id_user');

        $sql = "SELECT DISTINCT JENIS_SPM 
				FROM "
                . $this->_table1 . "
				WHERE 
				STATUS_LOOKUP_CODE <> 'VOIDED'
				AND SEGMENT1 = '" . $satker . "'"

        ;

        $no = 0;
        //foreach ($filter as $filter) {
        //$sql .= " AND ".$filter;
        //}


        $sql .= " ORDER BY JENIS_SPM DESC";
        //var_dump ($sql);

        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_attribute6($val['JENIS_SPM']);
			$d_data->set_jendok($val['JENDOK']);

            $data[] = $d_data;
        }
        return $data;
    }

    public function get_sp2d_rekap_filter($filter) {
        Session::get('id_user');
        $sql = "SELECT SUBSTR(CHECK_NUMBER,3,3) KPPN, UPPER(JENIS_SPM) JENIS_SPM, JENDOK, COUNT(CHECK_NUMBER) JUMLAH_SP2D, SUM(AMOUNT) TOTAL_SP2D 
				FROM "
                . $this->_table1 . "
				WHERE 
				STATUS_LOOKUP_CODE <> 'VOIDED'"

        ;

        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }

        $sql .= " GROUP BY SUBSTR(CHECK_NUMBER,3,3), JENIS_SPM, JENDOK";
        $sql .= " ORDER BY SUBSTR(CHECK_NUMBER,3,3), COUNT(CHECK_NUMBER) DESC, JENIS_SPM";
        //var_dump ($sql);

        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_jumlah_sp2d($val['JUMLAH_SP2D']);
            $d_data->set_jendok($val['JENDOK']);
            $d_data->set_jenis_sp2d($val['JENIS_SP2D']);
            $d_data->set_total_sp2d($val['TOTAL_SP2D']);
            $d_data->set_attribute6($val['JENIS_SPM']);
            $data[] = $d_data;
        }
        return $data;
    }

    public function get_sp2d_rekap_kanwil_filter($filter) {
        Session::get('id_user');
        $sql = "SELECT UPPER(JENIS_SPM) JENIS_SPM, JENDOK, COUNT(CHECK_NUMBER) JUMLAH_SP2D, SUM(AMOUNT) TOTAL_SP2D 
				FROM "
                . $this->_table1 . "
				WHERE 
				STATUS_LOOKUP_CODE <> 'VOIDED'
				AND SUBSTR(CHECK_NUMBER,3,3) IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL = '" . Session::get('id_user') . "')"
        ;

        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }

        $sql .= " GROUP BY JENIS_SPM, JENDOK ";
        $sql .= " ORDER BY COUNT(CHECK_NUMBER) DESC, JENIS_SPM";
        //var_dump ($sql);

        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_jumlah_sp2d($val['JUMLAH_SP2D']);
            $d_data->set_jendok($val['JENDOK']);
            $d_data->set_jenis_sp2d($val['JENIS_SP2D']);
            $d_data->set_total_sp2d(NUMBER_FORMAT($val['TOTAL_SP2D']));
            $d_data->set_attribute6($val['JENIS_SPM']);
            $data[] = $d_data;
        }
        return $data;
    }

    public function get_sp2d_rekap_admin_filter($filter) {
        Session::get('id_user');
        $sql = "SELECT  UPPER(JENIS_SPM) JENIS_SPM, JENDOK, COUNT(CHECK_NUMBER) JUMLAH_SP2D, SUM(AMOUNT) TOTAL_SP2D 
				FROM "
                . $this->_table1 . "
				WHERE 
				STATUS_LOOKUP_CODE <> 'VOIDED'"

        ;

        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }

        $sql .= " GROUP BY JENIS_SPM, JENDOK ";
        $sql .= " ORDER BY COUNT(CHECK_NUMBER) DESC, JENIS_SPM";
        //var_dump ($sql);

        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_jumlah_sp2d($val['JUMLAH_SP2D']);
            $d_data->set_jendok($val['JENDOK']);
            $d_data->set_jenis_sp2d($val['JENIS_SP2D']);
            $d_data->set_total_sp2d(NUMBER_FORMAT($val['TOTAL_SP2D']));
            $d_data->set_attribute6($val['JENIS_SPM']);
            $data[] = $d_data;
        }
        return $data;
    }

    public function get_download_sp2d($filter) {
        Session::get('id_user');
        $sql = "SELECT  TO_CHAR(SYSDATE,'YYYY') THANG, SEGMENT1 KDSATKER, SUBSTR(INVOICE_NUM,1,5) NOSPM, TO_CHAR(INVOICE_DATE, 'DD-MM-YYYY') TGSPM,
			CHECK_NUMBER NOSP2D, TO_CHAR(CHECK_DATE, 'DD-MM-YYYY') TGSP2D, '' KDBANKPOS, 1 PILIH
				FROM "
                . $this->_table1 . "
				WHERE 
				STATUS_LOOKUP_CODE <> 'VOIDED'
				and check_number in ('" . $filter;




        //$no=0;
        //foreach ($filter as $filter) {
        //$sql .= " AND ".$filter;
        //}
        //$sql .= " GROUP BY JENIS_SPM, JENDOK ";
        $sql .= " ') ORDER BY SUBSTR(INVOICE_NUM,1,5) DESC";
        //var_dump ($sql);

        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_invoice_num($val['NOSPM']);
            $d_data->set_invoice_date($val['TGSPM']);
            $d_data->set_check_number($val['NOSP2D']);
            $d_data->set_check_date($val['TGSP2D']);
            $d_data->set_nmsatker($val['KDSATKER']);
            $d_data->set_thang($val['THANG']);
            $d_data->set_kdbankpos($val['KDBANKPOS']);
            $d_data->set_pilih($val['PILIH']);
            $data[] = $d_data;
        }
        return $data;
    }

    public function get_tgl_download_sp2d($filter) {
        Session::get('id_user');
        $sql = "SELECT TO_CHAR(MAX(INVOICE_DATE),'DDMMYYYY') TGL1, TO_CHAR(MIN(INVOICE_DATE),'DDMMYYYY') TGL2 
				FROM "
                . $this->_table1 . "
				WHERE 
				STATUS_LOOKUP_CODE <> 'VOIDED'
				and check_number in ('" . $filter . "')";

        //$no=0;
        //foreach ($filter as $filter) {
        //$sql .= " AND ".$filter;
        //}
        //$sql .= " GROUP BY JENIS_SPM, JENDOK ";
        //$sql .= " ') ORDER BY SUBSTR(INVOICE_NUM,1,5) DESC";
        //var_dump ($sql);

        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_tgl1($val['TGL1']);
            $d_data->set_tgl2($val['TGL2']);
            $data[] = $d_data;
        }
        return $data;
    }

    /*
     * setter
     */

    public function set_thang($thang) {
        $this->_thang = $thang;
    }

    public function set_tgl1($tgl1) {
        $this->_tgl1 = $tgl1;
    }

    public function set_tgl2($tgl2) {
        $this->_tgl2 = $tgl2;
    }

    public function set_pilih($pilih) {
        $this->_pilih = $pilih;
    }

    public function set_kdbankpos($kdbankpos) {
        $this->_kdbankpos = $kdbankpos;
    }

    public function set_jenis_sp2d($jenis_sp2d) {
        $this->_jenis_sp2d = $jenis_sp2d;
    }

    public function set_jumlah_sp2d($jumlah_sp2d) {
        $this->_jumlah_sp2d = $jumlah_sp2d;
    }

    public function set_total_sp2d($total_sp2d) {
        $this->_total_sp2d = $total_sp2d;
    }

    public function set_amount($amount) {
        $this->_amount = $amount;
    }

    public function set_jendok($jendok) {
        $this->_jendok = $jendok;
    }

    public function set_base_amount($base_amount) {
        $this->_base_amount = $base_amount;
    }

    public function set_invoice_num($invoice_num) {
        $this->_invoice_num = $invoice_num;
    }

    public function set_currency_code($currency_code) {
        $this->_currency_code = $currency_code;
    }

    public function set_exchange_date($exchange_date) {
        $this->_exchange_date = $exchange_date;
    }

    public function set_exchange_rate($exchange_rate) {
        $this->_exchange_rate = $exchange_rate;
    }

    public function set_invoice_date($invoice_date) {
        $this->_invoice_date = $invoice_date;
    }

    public function set_description($description) {
        $this->_description = $description;
    }

    public function set_check_number($check_number) {
        $this->_check_number = $check_number;
    }

    public function set_check_date($check_date) {
        $this->_check_date = $check_date;
    }

    public function set_attribute6($attribute6) {
        $this->_attribute6 = $attribute6;
    }

    public function set_status_lookup_code($status_lookup_code) {
        $this->_status_lookup_code = $status_lookup_code;
    }

    public function set_nmsatker($nmsatker) {
        $this->_nmsatker = $nmsatker;
    }

    public function set_creation_date($creation_date) {
        $this->_creation_date = $creation_date;
    }

    /*
     * getter
     */

    public function get_tgl2() {
        return $this->_tgl2;
    }

    public function get_tgl1() {
        return $this->_tgl1;
    }

    public function get_jenis_sp2d() {
        return $this->_jenis_sp2d;
    }

    public function get_thang() {
        return $this->_thang;
    }

    public function get_kdbankpos() {
        return $this->_kdbankpos;
    }

    public function get_pilih() {
        return $this->_pilih;
    }

    public function get_jendok() {
        return $this->_jendok;
    }

    public function get_jumlah_sp2d() {
        return $this->_jumlah_sp2d;
    }

    public function get_total_sp2d() {
        return $this->_total_sp2d;
    }

    public function get_creation_date() {
        return $this->_creation_date;
    }

    public function get_amount() {
        return $this->_amount;
    }

    public function get_base_amount() {
        return $this->_base_amount;
    }

    public function get_currency_code() {
        return $this->_currency_code;
    }

    public function get_exchange_rate() {
        return $this->_exchange_rate;
    }

    public function get_exchange_date() {
        return $this->_exchange_date;
    }

    public function get_invoice_num() {
        return $this->_invoice_num;
    }

    public function get_invoice_date() {
        return $this->_invoice_date;
    }

    public function get_description() {
        return $this->_description;
    }

    public function get_check_number() {
        return $this->_check_number;
    }

    public function get_check_date() {
        return $this->_check_date;
    }

    public function get_attribute6() {
        return $this->_attribute6;
    }

    public function get_status_lookup_code() {
        return $this->_status_lookup_code;
    }

    public function get_nmsatker() {
        return $this->_nmsatker;
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
