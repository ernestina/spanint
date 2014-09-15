<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataDashboard {

    private $db;
    private $_gaji;
    private $_non_gaji;
    private $_lainnya;
    private $_void;
    private $_vol_gaji;
    private $_vol_non_gaji;
    private $_vol_lainnya;
    private $_vol_void;
    private $_vol_completed;
    private $_vol_validated;
    private $_vol_error;
    private $_vol_etc;
    private $_vol_lhp_completed;
    private $_vol_lhp_validated;
    private $_vol_lhp_error;
    private $_vol_lhp_etc;
    private $_jenis_sp2d;
    private $_check_number;
    private $_nominal_sp2d;
    private $_retur_belum_proses;
    private $_retur_sudah_proses;
    private $_last_update;
    public $registry;

    /*
     * konstruktor
     */

    public function __construct($registry = Registry) {
        $this->db = $registry->db;
        $this->registry = $registry;
    }

    public function get_last_update_all() {
        $sql = "SELECT to_char(MAX(LAST_UPDATE),'dd-mm-yyyy hh24:mi:ss') LAST_UPDATE FROM T_LAST_UPDATE";
        $result = $this->db->select($sql);
        foreach ($result as $val) {
            $d_data = $val['LAST_UPDATE'];
        }
        return $d_data;
    }

    public function get_sp2d_rekap_vol_pie($hari, $unitfilter = null) {
        if (!isset($unitfilter)) {
            $sql = "select status_lookup_code, jenis_sp2d, sum(amount_rph) nominal from (select distinct(check_number), status_lookup_code, jenis_sp2d, amount, amount * nvl(exchange_rate,1) amount_rph, segment1 from (select check_number, status_lookup_code, jenis_sp2d, amount, exchange_rate, check_date, segment1 from AP_CHECKS_ALL_V where CURRENCY_CODE = 'IDR' or EXCHANGE_RATE is not null) where kdkppn = '" . Session::get('id_user') . "' and (check_date between to_date('" . date("Ymd", time() - (($hari - 1) * 24 * 60 * 60)) . "','yyyymmdd') and to_date('" . date("Ymd", time()) . "','yyyymmdd'))) group by status_lookup_code, jenis_sp2d";
        } else {
            $sql = "select status_lookup_code, jenis_sp2d, sum(amount_rph) nominal from (select distinct(check_number), status_lookup_code, jenis_sp2d, amount, amount * nvl(exchange_rate,1) amount_rph, segment1 from (select check_number, status_lookup_code, jenis_sp2d, amount, exchange_rate, check_date, segment1 from AP_CHECKS_ALL_V where CURRENCY_CODE = 'IDR' or EXCHANGE_RATE is not null) where " . $unitfilter . " and (check_date between to_date('" . date("Ymd", time() - (($hari - 1) * 24 * 60 * 60)) . "','yyyymmdd') and to_date('" . date("Ymd", time()) . "','yyyymmdd'))) group by status_lookup_code, jenis_sp2d";
        }

        //echo $sql;
        $result = $this->db->select($sql);
        //var_dump($result);            
        $d_data = new $this($this->registry);

        $d_data->set_void(0);
        $d_data->set_vol_void(0);
        $d_data->set_gaji(0);
        $d_data->set_vol_gaji(0);
        $d_data->set_non_gaji(0);
        $d_data->set_vol_non_gaji(0);
        $d_data->set_lainnya(0);
        $d_data->set_vol_lainnya(0);

        foreach ($result as $val) {
            if ($val['STATUS_LOOKUP_CODE'] == 'VOIDED') {
                $d_data->set_vol_void($d_data->get_vol_void() + $val['NOMINAL']);
            } else {
                if ($val['JENIS_SP2D'] == 'GAJI') {
                    $d_data->set_vol_gaji($d_data->get_vol_gaji() + $val['NOMINAL']);
                } else if ($val['JENIS_SP2D'] == 'NON GAJI') {
                    $d_data->set_vol_non_gaji($d_data->get_vol_non_gaji() + $val['NOMINAL']);
                } else {
                    $d_data->set_vol_lainnya($d_data->get_vol_lainnya() + $val['NOMINAL']);
                }
            }
        }
        //var_dump($d_data);
        return $d_data;
    }

    public function get_sp2d_rekap_vol($hari, $unitfilter = null) {
        //$sql = "select jenis_sp2d, count(check_number) jumlah, sum(amount) nominal from AP_CHECKS_ALL_V where substr(check_number,3,3) in (select kdkppn from t_kppn where kdkanwil='11') and check_date between to_date('01052014','ddmmyyyy') and to_date('01062014','ddmmyyyy') group by jenis_sp2d;";

        $data = array();
        for ($i = 0; $i < $hari; $i++) {
            if (!isset($unitfilter)) {
                $sql = "select status_lookup_code, jenis_sp2d, sum(amount_rph) nominal from (select distinct(check_number), status_lookup_code, jenis_sp2d, amount, amount * nvl(exchange_rate,1) amount_rph, segment1 from (select check_number, status_lookup_code, jenis_sp2d, amount, exchange_rate, check_date, segment1 from AP_CHECKS_ALL_V where CURRENCY_CODE = 'IDR' or EXCHANGE_RATE is not null) where kdkppn = '" . Session::get('id_user') . "' and check_date = to_date('" . date("Ymd", time() - ($i * 24 * 60 * 60)) . "','yyyymmdd')) group by status_lookup_code, jenis_sp2d";
            } else {
                $sql = "select status_lookup_code, jenis_sp2d, sum(amount_rph) nominal from (select distinct(check_number), status_lookup_code, jenis_sp2d, amount, amount * nvl(exchange_rate,1) amount_rph, segment1 from (select check_number, status_lookup_code, jenis_sp2d, amount, exchange_rate, check_date, segment1 from AP_CHECKS_ALL_V where CURRENCY_CODE = 'IDR' or EXCHANGE_RATE is not null) where " . $unitfilter . " and check_date = to_date('" . date("Ymd", time() - ($i * 24 * 60 * 60)) . "','yyyymmdd')) group by status_lookup_code, jenis_sp2d";
            }

            //var_dump($sql);
            $result = $this->db->select($sql);
            //var_dump($result);
            $d_data = new $this($this->registry);

            $d_data->set_void(0);
            $d_data->set_vol_void(0);
            $d_data->set_gaji(0);
            $d_data->set_vol_gaji(0);
            $d_data->set_non_gaji(0);
            $d_data->set_vol_non_gaji(0);
            $d_data->set_lainnya(0);
            $d_data->set_vol_lainnya(0);

            foreach ($result as $val) {
                if ($val['STATUS_LOOKUP_CODE'] == 'VOIDED') {
                    $d_data->set_vol_void($d_data->get_vol_void() + $val['NOMINAL']);
                } else {
                    if ($val['JENIS_SP2D'] == 'GAJI') {
                        $d_data->set_vol_gaji($d_data->get_vol_gaji() + $val['NOMINAL']);
                    } else if ($val['JENIS_SP2D'] == 'NON GAJI') {
                        $d_data->set_vol_non_gaji($d_data->get_vol_non_gaji() + $val['NOMINAL']);
                    } else if ($val['JENIS_SP2D'] == 'LAINNYA') {
                        $d_data->set_vol_lainnya($d_data->get_vol_lainnya() + $val['NOMINAL']);
                    }
                }
            }
            $data[$i] = $d_data;
        }
        //var_dump($data);
        return $data;
    }

    public function get_sp2d_rekap_num_pie($hari, $unitfilter = null) {

        if (!isset($unitfilter)) {
            $sql = "select status_lookup_code, jenis_sp2d, count(check_number) jumlah, sum(amount_rph) nominal from (select distinct(check_number), status_lookup_code, jenis_sp2d, segment1 from (select check_number, status_lookup_code, jenis_sp2d, check_date, segment1 from AP_CHECKS_ALL_V where CURRENCY_CODE = 'IDR' or EXCHANGE_RATE is not null) where kdkppn = '" . Session::get('id_user') . "' and (check_date between to_date('" . date("Ymd", time() - (($hari - 1) * 24 * 60 * 60)) . "','yyyymmdd') and to_date('" . date("Ymd", time()) . "','yyyymmdd'))) group by status_lookup_code, jenis_sp2d";
        } else {
            $sql = "select status_lookup_code, jenis_sp2d, count(check_number) jumlah from (select distinct(check_number), status_lookup_code, jenis_sp2d, segment1 from (select check_number, status_lookup_code, jenis_sp2d, check_date, segment1 from AP_CHECKS_ALL_V where CURRENCY_CODE = 'IDR' or EXCHANGE_RATE is not null) where " . $unitfilter . " and (check_date between to_date('" . date("Ymd", time() - (($hari - 1) * 24 * 60 * 60)) . "','yyyymmdd') and to_date('" . date("Ymd", time()) . "','yyyymmdd'))) group by status_lookup_code, jenis_sp2d";
        }

        //var_dump($sql);
        $result = $this->db->select($sql);
        //var_dump($result);
        $d_data = new $this($this->registry);

        $d_data->set_void(0);
        $d_data->set_vol_void(0);
        $d_data->set_gaji(0);
        $d_data->set_vol_gaji(0);
        $d_data->set_non_gaji(0);
        $d_data->set_vol_non_gaji(0);
        $d_data->set_lainnya(0);
        $d_data->set_vol_lainnya(0);

        foreach ($result as $val) {
            if ($val['STATUS_LOOKUP_CODE'] == 'VOIDED') {
                $d_data->set_void($d_data->get_void() + $val['JUMLAH']);
                $d_data->set_vol_void($d_data->get_vol_void() + $val['NOMINAL']);
            } else {
                if ($val['JENIS_SP2D'] == 'GAJI') {
                    $d_data->set_gaji($d_data->get_gaji() + $val['JUMLAH']);
                    $d_data->set_vol_gaji($d_data->get_vol_gaji() + $val['NOMINAL']);
                } else if ($val['JENIS_SP2D'] == 'NON GAJI') {
                    $d_data->set_non_gaji($d_data->get_non_gaji() + $val['JUMLAH']);
                    $d_data->set_vol_non_gaji($d_data->get_vol_non_gaji() + $val['NOMINAL']);
                } else {
                    $d_data->set_lainnya($d_data->get_lainnya() + $val['JUMLAH']);
                    $d_data->set_vol_lainnya($d_data->get_vol_lainnya() + $val['NOMINAL']);
                }
            }
        }
        //var_dump($data);
        return $d_data;
    }

    public function get_sp2d_rekap_num($hari, $unitfilter = null) {
        //$sql = "select jenis_sp2d, count(check_number) jumlah, sum(amount) nominal from AP_CHECKS_ALL_V where substr(check_number,3,3) in (select kdkppn from t_kppn where kdkanwil='11') and check_date between to_date('01052014','ddmmyyyy') and to_date('01062014','ddmmyyyy') group by jenis_sp2d;";

        $data = array();
        for ($i = 0; $i < $hari; $i++) {
            if (!isset($unitfilter)) {
                $sql = "select status_lookup_code, jenis_sp2d, count(check_number) jumlah, sum(amount_rph) nominal from (select distinct(check_number), status_lookup_code, jenis_sp2d, segment1 from (select check_number, status_lookup_code, jenis_sp2d, check_date, segment1 from AP_CHECKS_ALL_V where CURRENCY_CODE = 'IDR' or EXCHANGE_RATE is not null) where kdkppn = '" . Session::get('id_user') . "' and check_date = to_date('" . date("Ymd", time() - ($i * 24 * 60 * 60)) . "','yyyymmdd')) group by status_lookup_code, jenis_sp2d";
            } else {
                $sql = "select status_lookup_code, jenis_sp2d, count(check_number) jumlah from (select distinct(check_number), status_lookup_code, jenis_sp2d, segment1 from (select check_number, status_lookup_code, jenis_sp2d, check_date, segment1 from AP_CHECKS_ALL_V where CURRENCY_CODE = 'IDR' or EXCHANGE_RATE is not null) where " . $unitfilter . " and check_date = to_date('" . date("Ymd", time() - ($i * 24 * 60 * 60)) . "','yyyymmdd')) group by status_lookup_code, jenis_sp2d";
            }

            //var_dump($sql);
            $result = $this->db->select($sql);
            //var_dump($result);
            $d_data = new $this($this->registry);

            $d_data->set_void(0);
            $d_data->set_vol_void(0);
            $d_data->set_gaji(0);
            $d_data->set_vol_gaji(0);
            $d_data->set_non_gaji(0);
            $d_data->set_vol_non_gaji(0);
            $d_data->set_lainnya(0);
            $d_data->set_vol_lainnya(0);

            foreach ($result as $val) {
                if ($val['STATUS_LOOKUP_CODE'] == 'VOIDED') {
                    $d_data->set_void($d_data->get_void() + $val['JUMLAH']);
                    $d_data->set_vol_void($d_data->get_vol_void() + $val['NOMINAL']);
                } else {
                    if ($val['JENIS_SP2D'] == 'GAJI') {
                        $d_data->set_gaji($d_data->get_gaji() + $val['JUMLAH']);
                        $d_data->set_vol_gaji($d_data->get_vol_gaji() + $val['NOMINAL']);
                    } else if ($val['JENIS_SP2D'] == 'NON GAJI') {
                        $d_data->set_non_gaji($d_data->get_non_gaji() + $val['JUMLAH']);
                        $d_data->set_vol_non_gaji($d_data->get_vol_non_gaji() + $val['NOMINAL']);
                    } else if ($val['JENIS_SP2D'] == 'LAINNYA') {
                        $d_data->set_lainnya($d_data->get_lainnya() + $val['JUMLAH']);
                        $d_data->set_vol_lainnya($d_data->get_vol_lainnya() + $val['NOMINAL']);
                    }
                }
            }
            $data[$i] = $d_data;
        }
        //var_dump($data);
        return $data;
    }

    public function get_sp2d_rekap($hari, $unitfilter = null) {
        //$sql = "select jenis_sp2d, count(check_number) jumlah, sum(amount) nominal from AP_CHECKS_ALL_V where substr(check_number,3,3) in (select kdkppn from t_kppn where kdkanwil='11') and check_date between to_date('01052014','ddmmyyyy') and to_date('01062014','ddmmyyyy') group by jenis_sp2d;";

        $data = array();
        for ($i = 0; $i < $hari; $i++) {
            if (!isset($unitfilter)) {
                $sql = "select status_lookup_code, jenis_sp2d, count(check_number) jumlah, sum(amount_rph) nominal from (select distinct(check_number), status_lookup_code, jenis_sp2d, amount, amount * nvl(exchange_rate,1) amount_rph, segment1 from (select check_number, status_lookup_code, jenis_sp2d, amount, exchange_rate, check_date, segment1 from AP_CHECKS_ALL_V where CURRENCY_CODE = 'IDR' or EXCHANGE_RATE is not null) where kdkppn = '" . Session::get('id_user') . "' and check_date = to_date('" . date("Ymd", time() - ($i * 24 * 60 * 60)) . "','yyyymmdd')) group by status_lookup_code, jenis_sp2d";
            } else {
                $sql = "select status_lookup_code, jenis_sp2d, count(check_number) jumlah, sum(amount_rph) nominal from (select distinct(check_number), status_lookup_code, jenis_sp2d, amount, amount * nvl(exchange_rate,1) amount_rph, segment1 from (select check_number, status_lookup_code, jenis_sp2d, amount, exchange_rate, check_date, segment1 from AP_CHECKS_ALL_V where CURRENCY_CODE = 'IDR' or EXCHANGE_RATE is not null) where " . $unitfilter . " and check_date = to_date('" . date("Ymd", time() - ($i * 24 * 60 * 60)) . "','yyyymmdd')) group by status_lookup_code, jenis_sp2d";
            }

            //var_dump($sql);
            $result = $this->db->select($sql);
            //var_dump($result);
            $d_data = new $this($this->registry);

            $d_data->set_void(0);
            $d_data->set_vol_void(0);
            $d_data->set_gaji(0);
            $d_data->set_vol_gaji(0);
            $d_data->set_non_gaji(0);
            $d_data->set_vol_non_gaji(0);
            $d_data->set_lainnya(0);
            $d_data->set_vol_lainnya(0);

            foreach ($result as $val) {
                if ($val['STATUS_LOOKUP_CODE'] == 'VOIDED') {
                    $d_data->set_void($d_data->get_void() + $val['JUMLAH']);
                    $d_data->set_vol_void($d_data->get_vol_void() + $val['NOMINAL']);
                } else {
                    if ($val['JENIS_SP2D'] == 'GAJI') {
                        $d_data->set_gaji($d_data->get_gaji() + $val['JUMLAH']);
                        $d_data->set_vol_gaji($d_data->get_vol_gaji() + $val['NOMINAL']);
                    } else if ($val['JENIS_SP2D'] == 'NON GAJI') {
                        $d_data->set_non_gaji($d_data->get_non_gaji() + $val['JUMLAH']);
                        $d_data->set_vol_non_gaji($d_data->get_vol_non_gaji() + $val['NOMINAL']);
                    } else if ($val['JENIS_SP2D'] == 'LAINNYA') {
                        $d_data->set_lainnya($d_data->get_lainnya() + $val['JUMLAH']);
                        $d_data->set_vol_lainnya($d_data->get_vol_lainnya() + $val['NOMINAL']);
                    }
                }
            }
            $data[$i] = $d_data;
        }
        //var_dump($data);
        return $data;
    }

    public function get_summary_dipa_unit($kodeunit = null) {
        if (!isset($unitfilter)) {
            $sql = "select sum(ACTUAL_AMT) TERPAKAI , sum(BALANCING_AMT) SISA from GL_BALANCES_V where SATKER='" . Session::get('kd_satker') . "'";
        } else {
            $sql = "select sum(ACTUAL_AMT) TERPAKAI , sum(BALANCING_AMT) SISA from GL_BALANCES_V where SATKER='" . $kodeunit . "'";
        }
        //var_dump($sql);
        $result = $this->db->select($sql);
        $data = new $this($this->registry);
        foreach ($result as $val) {
            $data->set_dipa_terpakai($val['TERPAKAI']);
            $data->set_dipa_sisa($val['SISA']);
        }
        return $data;
    }

    public function get_sp2d_retur($unitfilter = null) {
        if (!isset($unitfilter)) {
            $sql = "select STATUS_RETUR, count(STATUS_RETUR) JUMLAH, sum(AMOUNT) NOMINAL from RETUR_SPAN_V where KDKPPN='" . Session::get('id_user') . "' group by STATUS_RETUR";
        } else {
            $sql = "select STATUS_RETUR, count(STATUS_RETUR) JUMLAH, sum(AMOUNT) NOMINAL from RETUR_SPAN_V where " . $unitfilter . " group by STATUS_RETUR";
        }
        //var_dump($sql);
        $result = $this->db->select($sql);
        $d_data = new $this($this->registry);
        $d_data->set_retur_sudah_proses(0);
        $d_data->set_vol_retur_sudah_proses(0);
        $d_data->set_retur_belum_proses(0);
        $d_data->set_vol_retur_belum_proses(0);
        foreach ($result as $val) {
            if ($val['STATUS_RETUR'] == 'SUDAH PROSES') {
                $d_data->set_retur_sudah_proses($d_data->get_retur_sudah_proses() + $val['JUMLAH']);
                $d_data->set_vol_retur_sudah_proses($d_data->get_vol_retur_sudah_proses() + $val['NOMINAL']);
            } else {
                $d_data->set_retur_belum_proses($d_data->get_retur_belum_proses() + $val['JUMLAH']);
                $d_data->set_vol_retur_belum_proses($d_data->get_vol_retur_belum_proses() + $val['NOMINAL']);
            }
        }
        return $d_data;
    }

    public function get_list_sp2d_selesai($unitfilter = null) {
        //$sql = "select jenis_sp2d, count(check_number) jumlah, sum(amount) nominal from AP_CHECKS_ALL_V where substr(check_number,3,3) in (select kdkppn from t_kppn where kdkanwil='11') and check_date between to_date('01052014','ddmmyyyy') and to_date('01062014','ddmmyyyy') group by jenis_sp2d;";

        $data = array();

        if (!isset($unitfilter)) {
            $sql = "select distinct(check_number), check_date, jenis_sp2d, currency_code, exchange_rate, amount, amount * nvl(exchange_rate,1) amount_rph from AP_CHECKS_ALL_V where kdkppn = " . Session::get('id_user') . " and check_date = to_date('" . date("Ymd", time()) . "','yyyymmdd') order by check_date desc";
        } else {
            $sql = "select distinct(check_number), check_date, jenis_sp2d, currency_code, exchange_rate, amount, amount * nvl(exchange_rate,1) amount_rph from AP_CHECKS_ALL_V where " . $unitfilter . " order by check_date desc";
        }
        $result = $this->db->select($sql);

        //select distinct(check_number), jenis_sp2d, exchange_rate, amount, currency_code, amount * nvl(exchange_rate,1) amount_rph from AP_CHECKS_ALL_V where  substr(CHECK_NUMBER,3,3)='140' and check_date = to_date('20140630','yyyymmdd');

        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_tanggal_sp2d($val['CHECK_DATE']);
            $d_data->set_jenis_sp2d($val['JENIS_SP2D']);
            $d_data->set_check_number($val['CHECK_NUMBER']);
            $d_data->set_nominal_sp2d($val['AMOUNT_RPH']);
            $d_data->set_rate_sp2d($val['EXCHANGE_RATE']);
            $d_data->set_currency_sp2d($val['CURRENCY_CODE']);
            $d_data->set_gross_nominal_sp2d($val['AMOUNT']);
            //var_dump($val['AMOUNT']);
            $data[] = $d_data;
        }
        //var_dump($data);
        return $data;
    }

    public function get_lhp_rekap_tanggal($tanggal, $unitfilter = null) {

        $data = array();

        if (!isset($unitfilter)) {
            $sql = "select tanggal, jumlah, nominal, status from spgr_mpn_dashboard where kppn = '" . Session::get('id_user') . "' and tanggal = to_date('" . $tanggal . "','ddmmyyyy')";
        } else {
            $sql = "select tanggal, jumlah, nominal, status from spgr_mpn_dashboard where " . $unitfilter . " and tanggal = to_date('" . $tanggal . "','dd-mm-yyyy')";
        }

        //var_dump($sql);

        $result = $this->db->select($sql);
        $d_data = new $this($this->registry);

        //var_dump($result);

        $d_data->set_tgl_lhp($tanggal);
        $d_data->set_lhp_completed(0);
        $d_data->set_vol_lhp_completed(0);
        $d_data->set_lhp_validated(0);
        $d_data->set_vol_lhp_validated(0);
        $d_data->set_lhp_error(0);
        $d_data->set_vol_lhp_error(0);
        $d_data->set_lhp_etc(0);
        $d_data->set_vol_lhp_etc(0);

        foreach ($result as $val) {
            $d_data->set_tgl_lhp($val['TANGGAL']);
            if ($val['STATUS'] == 'Completed') {
                $d_data->set_lhp_completed($d_data->get_lhp_completed() + $val['JUMLAH']);
                $d_data->set_vol_lhp_completed($d_data->get_vol_lhp_completed() + $val['NOMINAL']);
            } else if ($val['STATUS'] == 'Validated') {
                $d_data->set_lhp_validated($d_data->get_lhp_validated() + $val['JUMLAH']);
                $d_data->set_vol_lhp_validated($d_data->get_vol_lhp_validated() + $val['NOMINAL']);
            } else if ($val['STATUS'] == 'Error') {
                $d_data->set_lhp_error($d_data->get_lhp_error() + $val['JUMLAH']);
                $d_data->set_vol_lhp_error($d_data->get_vol_lhp_error() + $val['NOMINAL']);
            } else {
                $d_data->set_lhp_etc($d_data->get_lhp_etc() + $val['JUMLAH']);
                $d_data->set_vol_lhp_etc($d_data->get_vol_lhp_etc() + $val['NOMINAL']);
            }
        }

        $data[0] = $d_data;

        return $data;
    }

    public function get_lhp_rekap($hari, $unitfilter = null) {
        $data = array();
        for ($i = 0; $i < $hari; $i++) {

            if (!isset($unitfilter)) {
                if ($hari == 1) {
                    $sql = "select tanggal, jumlah, nominal, status from spgr_mpn_dashboard where kppn = '" . Session::get('id_user') . "' and tanggal=(select max(tanggal) from spgr_mpn_dashboard where kppn = '" . Session::get('id_user') . "')";
                } else {
                    $sql = "select tanggal, jumlah, nominal, status from spgr_mpn_dashboard where kppn = '" . Session::get('id_user') . "' and tanggal = to_date('" . date("Ymd", time() - ($i * 24 * 60 * 60)) . "','yyyymmdd')";
                }
            } else {
                if ($hari == 1) {
                    $sql = "select tanggal, jumlah, nominal, status from spgr_mpn_dashboard where " . $unitfilter . " and tanggal=(select max(tanggal) from spgr_mpn_dashboard where " . $unitfilter . ")";
                } else {
                    $sql = "select tanggal, jumlah, nominal, status from spgr_mpn_dashboard where " . $unitfilter . " and tanggal = to_date('" . date("Ymd", time() - ($i * 24 * 60 * 60)) . "','yyyymmdd')";
                }
            }

            //var_dump($sql);

            $result = $this->db->select($sql);
            $d_data = new $this($this->registry);
            //var_dump($result);

            $d_data->set_tgl_lhp(0);
            $d_data->set_lhp_completed(0);
            $d_data->set_vol_lhp_completed(0);
            $d_data->set_lhp_validated(0);
            $d_data->set_vol_lhp_validated(0);
            $d_data->set_lhp_error(0);
            $d_data->set_vol_lhp_error(0);
            $d_data->set_lhp_etc(0);
            $d_data->set_vol_lhp_etc(0);

            foreach ($result as $val) {
                $d_data->set_tgl_lhp($val['TANGGAL']);
                if ($val['STATUS'] == 'Completed') {
                    $d_data->set_lhp_completed($d_data->get_lhp_completed() + $val['JUMLAH']);
                    $d_data->set_vol_lhp_completed($d_data->get_vol_lhp_completed() + $val['NOMINAL']);
                } else if ($val['STATUS'] == 'Validated') {
                    $d_data->set_lhp_validated($d_data->get_lhp_validated() + $val['JUMLAH']);
                    $d_data->set_vol_lhp_validated($d_data->get_vol_lhp_validated() + $val['NOMINAL']);
                } else if ($val['STATUS'] == 'Error') {
                    $d_data->set_lhp_error($d_data->get_lhp_error() + $val['JUMLAH']);
                    $d_data->set_vol_lhp_error($d_data->get_vol_lhp_error() + $val['NOMINAL']);
                } else {
                    $d_data->set_lhp_etc($d_data->get_lhp_etc() + $val['JUMLAH']);
                    $d_data->set_vol_lhp_etc($d_data->get_vol_lhp_etc() + $val['NOMINAL']);
                }
            }
            $data[$i] = $d_data;
        }
        return $data;
    }

    public function get_hist_spm_filter($filter) {
        $sql = "SELECT OU_NAME, INVOICE_NUM, TO_USER, FU_DESCRIPTION, BEGIN_DATE, TIME_BEGIN_DATE from ap_invoices_all_v WHERE STATUS = 'OPEN' ";
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $sql .= " ORDER BY BEGIN_DATE DESC, TIME_BEGIN_DATE DESC, INVOICE_NUM";
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_ou_name($val['OU_NAME']);
            $d_data->set_invoice_num($val['INVOICE_NUM']);
            $d_data->set_to_user($val['TO_USER']);
            $d_data->set_fu_description(substr($val['FU_DESCRIPTION'], 11));
            $d_data->set_begin_date($val['BEGIN_DATE']);
            $d_data->set_time_begin_date($val['TIME_BEGIN_DATE']);
            $data[] = $d_data;
        }
        return $data;
    }
    
    public function get_hist_spm_count($filter) {
        $sql = "SELECT count(STATUS) JUMLAH from AP_INVOICES_ALL_V where STATUS = 'OPEN' ";
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            return $val['JUMLAH'];
        }
    }
    
    public function get_hist_spm_sp2d_filter_tv($kdkppn) {
        $sql = "select DISTINCT(AP_INVOICES_ALL_V.INVOICE_NUM) NO_INVOICE, AP_INVOICES_ALL_V.BEGIN_DATE DATE_START, "
                . "AP_INVOICES_ALL_V.STATUS LAST_STATUS, AP_CHECKS_ALL_V.CHECK_NUMBER NO_SP2D, AP_CHECKS_ALL_V.CHECK_DATE TGL_SP2D, "
                . "AP_CHECKS_ALL_V.AMOUNT JUMLAH, AP_CHECKS_ALL_V.CURRENCY_CODE MATA_UANG, AP_CHECKS_ALL_V.DESCRIPTION DESKRIPSI "
                . "from AP_INVOICES_ALL_V left join AP_CHECKS_ALL_V on AP_INVOICES_ALL_V.INVOICE_NUM = AP_CHECKS_ALL_V.INVOICE_NUM "
                . "where AP_INVOICES_ALL_V.KDKPPN='" . $kdkppn . "' "
                . "and ("
                . "AP_INVOICES_ALL_V.BEGIN_DATE = '". date("d-m-Y", time()) . "' "
                . "or AP_INVOICES_ALL_V.STATUS = 'OPEN' "
                . "or AP_CHECKS_ALL_V.CHECK_DATE  = TO_DATE ('" . date("d-m-Y", time()) . "','DD-MM-YYYY')"
                . ") "
                . "order by AP_INVOICES_ALL_V.BEGIN_DATE, AP_INVOICES_ALL_V.INVOICE_NUM, substr(AP_INVOICES_ALL_V.INVOICE_NUM,7,6) ";

        $result = $this->db->select($sql);
        //var_dump($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_ou_name($val['OU_NAME']);
            $d_data->set_invoice_num($val['NO_INVOICE']);
            $d_data->set_begin_date($val['DATE_START']);
            $d_data->set_status($val['LAST_STATUS']);
            $d_data->set_check_number($val['NO_SP2D']);
            $d_data->set_check_date($val['TGL_SP2D']);
            $d_data->set_nominal_sp2d($val['JUMLAH']);
            $d_data->set_mata_uang($val['MATA_UANG']);
            $d_data->set_deskripsi($val['DESKRIPSI']);
            $data[] = $d_data;
        }
        return $data;
    }

    public function get_kanwil() {
        $sql = "SELECT KDKANWIL, NMKANWIL FROM T_KANWIL";
        $result = $this->db->select($sql);
        $data = array();
        //var_dump($sql);
        foreach ($result as $val) {
            $d_user = new $this($this->registry);
            $d_user->set_kd_d_kanwil("K" . $val['KDKANWIL']);
            $d_user->set_nama_user($val['NMKANWIL']);

            $data[] = $d_user;
        }
        //var_dump($data);
        return $data;
    }

    public function get_nama_unit($kdsatker) {
        $sql = "SELECT NAMA_USER FROM D_USER WHERE KD_SATKER='" . $kdsatker . "'";
        $result = $this->db->select($sql);
        //var_dump($sql);
        foreach ($result as $val) {
            $data = $val['NAMA_USER'];
        }
        //var_dump($data);
        return $data;
    }

    public function get_kanwil_kppn($kdkppn) {
        $sql = "SELECT KD_KANWIL FROM D_USER WHERE KD_SATKER='" . $kdkppn . "'";
        $result = $this->db->select($sql);
        //var_dump($sql);
        foreach ($result as $val) {
            $data = $val['KD_KANWIL'];
        }
        //var_dump($data);
        return $data;
    }

    /*
     * setter
     */

    //Rekap SP2D
    public function set_gaji($gaji) {
        $this->_gaji = $gaji;
    }

    public function set_non_gaji($non_gaji) {
        $this->_non_gaji = $non_gaji;
    }

    public function set_void($void) {
        $this->_void = $void;
    }

    public function set_lainnya($lainnya) {
        $this->_lainnya = $lainnya;
    }

    public function set_vol_gaji($vol_gaji) {
        $this->_vol_gaji = $vol_gaji;
    }

    public function set_vol_non_gaji($vol_non_gaji) {
        $this->_vol_non_gaji = $vol_non_gaji;
    }

    public function set_vol_void($vol_void) {
        $this->_vol_void = $vol_void;
    }

    public function set_vol_lainnya($vol_lainnya) {
        $this->_vol_lainnya = $vol_lainnya;
    }
    
    public function set_check_date($check_date) {
        $this->_check_date = $check_date;
    }

    //SP2D Ongoing
    public function set_ou_name($ou_name) {
        $this->_ou_name = $ou_name;
    }

    public function set_invoice_num($invoice_num) {
        $this->_invoice_num = $invoice_num;
    }

    public function set_to_user($to_user) {
        $this->_to_user = $to_user;
    }

    public function set_fu_description($fu_description) {
        $this->_fu_description = $fu_description;
    }

    public function set_time_begin_date($time_begin_date) {
        $this->_time_begin_date = $time_begin_date;
    }

    public function set_begin_date($begin_date) {
        $this->_begin_date = $begin_date;
    }

    //Rekap LHP
    public function set_lhp_completed($lhp_completed) {
        $this->_lhp_completed = $lhp_completed;
    }

    public function set_vol_lhp_completed($vol_lhp_completed) {
        $this->_vol_lhp_completed = $vol_lhp_completed;
    }

    public function set_lhp_validated($lhp_validated) {
        $this->_lhp_validated = $lhp_validated;
    }

    public function set_vol_lhp_validated($vol_lhp_validated) {
        $this->_vol_lhp_validated = $vol_lhp_validated;
    }

    public function set_lhp_error($lhp_error) {
        $this->_lhp_error = $lhp_error;
    }

    public function set_vol_lhp_error($vol_lhp_error) {
        $this->_vol_lhp_error = $vol_lhp_error;
    }

    public function set_lhp_etc($lhp_etc) {
        $this->_lhp_etc = $lhp_etc;
    }

    public function set_vol_lhp_etc($vol_lhp_etc) {
        $this->_vol_lhp_etc = $vol_lhp_etc;
    }

    public function set_jenis_sp2d($jenis_sp2d) {
        $this->_jenis_sp2d = $jenis_sp2d;
    }

    public function set_check_number($check_number) {
        $this->_check_number = $check_number;
    }

    public function set_nominal_sp2d($nominal_sp2d) {
        $this->_nominal_sp2d = $nominal_sp2d;
    }

    public function set_retur_sudah_proses($retur_sudah_proses) {
        $this->_retur_sudah_proses = $retur_sudah_proses;
    }

    public function set_retur_belum_proses($retur_belum_proses) {
        $this->_retur_belum_proses = $retur_belum_proses;
    }

    public function set_tgl_lhp($tgl_lhp) {
        $this->_tgl_lhp = $tgl_lhp;
    }

    public function set_rate_sp2d($rate_sp2d) {
        $this->_rate_sp2d = $rate_sp2d;
    }

    public function set_vol_retur_belum_proses($vol_retur_belum_proses) {
        $this->_vol_retur_belum_proses = $vol_retur_belum_proses;
    }

    public function set_vol_retur_sudah_proses($vol_retur_sudah_proses) {
        $this->_vol_retur_sudah_proses = $vol_retur_sudah_proses;
    }

    public function set_currency_sp2d($currency_sp2d) {
        $this->_currency_sp2d = $currency_sp2d;
    }

    public function set_gross_nominal_sp2d($gross_nominal_sp2ds) {
        $this->_gross_nominal_sp2d = $gross_nominal_sp2d;
    }

    public function set_kd_d_kanwil($unit) {
        $this->_kd_d_kppn = $unit;
    }

    public function set_nama_user($nama) {
        $this->_nama_user = $nama;
    }

    public function set_dipa_terpakai($dipa_terpakai) {
        $this->_dipa_terpakai = $dipa_terpakai;
    }

    public function set_dipa_sisa($dipa_sisa) {
        $this->_dipa_sisa = $dipa_sisa;
    }

    public function set_tanggal_sp2d($tanggal_sp2d) {
        $this->_tanggal_sp2d = $tanggal_sp2d;
    }
    
    public function set_mata_uang($mata_uang) {
        $this->_mata_uang = $mata_uang;
    }
    
    public function set_deskripsi($deskripsi) {
        $this->_deskripsi = $deskripsi;
    }

    public function set_status($status) {
        $this->_status = $status;
    }
    
    /*
     * getter
     */

    //Rekap SP2D
    public function get_gaji() {
        return $this->_gaji;
    }

    public function get_non_gaji() {
        return $this->_non_gaji;
    }

    public function get_void() {
        return $this->_void;
    }

    public function get_lainnya() {
        return $this->_lainnya;
    }

    public function get_vol_gaji() {
        return $this->_vol_gaji;
    }

    public function get_vol_non_gaji() {
        return $this->_vol_non_gaji;
    }

    public function get_vol_void() {
        return $this->_vol_void;
    }

    public function get_vol_lainnya() {
        return $this->_vol_lainnya;
    }

    //SP2D Ongoing
    public function get_ou_name() {
        return $this->_ou_name;
    }

    public function get_invoice_num() {
        return $this->_invoice_num;
    }

    public function get_to_user() {
        return $this->_to_user;
    }

    public function get_fu_description() {
        return $this->_fu_description;
    }

    public function get_time_begin_date() {
        return $this->_time_begin_date;
    }

    public function get_begin_date() {
        return $this->_begin_date;
    }

    //Rekap LHP
    public function get_lhp_completed() {
        return $this->_lhp_completed;
    }

    public function get_vol_lhp_completed() {
        return $this->_vol_lhp_completed;
    }

    public function get_lhp_validated() {
        return $this->_lhp_validated;
    }

    public function get_vol_lhp_validated() {
        return $this->_vol_lhp_validated;
    }

    public function get_lhp_error() {
        return $this->_lhp_error;
    }

    public function get_vol_lhp_error() {
        return $this->_vol_lhp_error;
    }

    public function get_lhp_etc() {
        return $this->_lhp_etc;
    }

    public function get_vol_lhp_etc() {
        return $this->_vol_lhp_etc;
    }

    public function get_jenis_sp2d() {
        return $this->_jenis_sp2d;
    }

    public function get_check_number() {
        return $this->_check_number;
    }

    public function get_nominal_sp2d() {
        return $this->_nominal_sp2d;
    }

    public function get_retur_sudah_proses() {
        return $this->_retur_sudah_proses;
    }

    public function get_retur_belum_proses() {
        return $this->_retur_belum_proses;
    }

    public function get_tgl_lhp() {
        return $this->_tgl_lhp;
    }

    public function get_rate_sp2d() {
        return $this->_rate_sp2d;
    }

    public function get_vol_retur_belum_proses() {
        return $this->_vol_retur_belum_proses;
    }

    public function get_vol_retur_sudah_proses() {
        return $this->_vol_retur_sudah_proses;
    }

    public function get_currency_sp2d() {
        return $this->_currency_sp2d;
    }

    public function get_gross_nominal_sp2d() {
        return $this->_gross_nominal_sp2d;
    }

    public function get_kd_d_kanwil() {
        return $this->_kd_d_kppn;
    }
    
    public function get_kd_d_kppn() {
        return $this->_kd_d_kppn;
    }

    public function get_nama_user() {
        return $this->_nama_user;
    }

    public function get_dipa_terpakai() {
        return $this->_dipa_terpakai;
    }

    public function get_dipa_sisa() {
        return $this->_dipa_sisa;
    }

    public function get_tanggal_sp2d() {
        return $this->_tanggal_sp2d;
    }
    
    public function get_mata_uang() {
        return $this->_mata_uang;
    }
    
    public function get_deskripsi() {
        return $this->_deskripsi;
    }
    
    public function get_check_date() {
        return $this->_check_date;
    }
    
    public function get_status() {
        return $this->_status;
    }

    /*
     * destruktor
     */

    public function __destruct() {
        
    }

}
