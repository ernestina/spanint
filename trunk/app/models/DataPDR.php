<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataPDR {

    private $db;
    private $_reg_no;
    private $_d_signed;
    private $_d_effective;
    private $_d_drawlim;
    private $_cred_ref;
    private $_name;
    private $_cred_name;
    private $_cred_type;
    private $_curr;
    private $_amt_ori;
    private $_amt_amend;
    private $_amt_net;
    private $_disb_type;
    private $_purpose;
    private $_benef;
    private $_lg_id;
    private $_reg_type;
    private $_status;
    private $_d_period;
    private $_status_span;
    private $_cara_tarik;
    private $_table_djpu_reg = 'DJPU_REGISTER';
    private $_table_djpu_cara_tarik = 'DJPU_CARA_TARIK';
    private $_table_join_status = 'SPPM_REGISTER_LENDER';

    /*
     * AKUN
     */
    private $_kdakun;
    private $_nmakun;
    private $_kdkppn;
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

    public function get_djpu_register($filter) {
        Session::get('id_user');
        $sql = "SELECT  c.register_no,
                        a.reg_no,
                        a.name,
                        a.cred_name,
                        a.curr,
                        a.country,
                        a.cred_type,
                        b.cara_tarik,
                        a.amt_ori,
                        a.amt_amend,
                        a.amt_net,
                        a.benef,
                        a.status,
                        a.d_signed,
                        a.d_effective,
                        a.d_drawlim,
                        a.d_period
                FROM    " . $this->_table_djpu_reg . " a
                LEFT JOIN " . $this->_table_join_status . " c
                ON      a.reg_no = c.register_no
                INNER JOIN " . $this->_table_djpu_cara_tarik . " b 
                ON      a.reg_no = b.register_no
                AND     trim(a.lg_id) = b.instrument_id
                WHERE   1=1 ";

        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $sql .=" ORDER BY d_effective desc,d_signed desc ";
        //echo($sql);

        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);

            if ($val['REGISTER_NO'] == "") {
                $d_data->set_status_span("Belum Terdaftar");
            } else {
                $d_data->set_status_span("Terdaftar");
            }

            $d_data->set_reg_no($val['REG_NO']);
            $d_data->set_name($val['NAME']);
            $d_data->set_cred_name($val['CRED_NAME']);
            $d_data->set_curr($val['CURR']);
            $d_data->set_country($val['COUNTRY']);
            $d_data->set_cred_type($val['CRED_TYPE']);
            $d_data->set_cara_tarik($val['CARA_TARIK']);
            $d_data->set_amt_ori($val['AMT_ORI']);
            $d_data->set_amt_amend($val['AMT_AMEND']);
            $d_data->set_amt_net($val['AMT_NET']);
            $d_data->set_benef($val['BENEF']);
            $d_data->set_status($val['STATUS']);
            $d_data->set_d_signed($val['D_SIGNED']);
            $d_data->set_d_effective($val['D_EFFECTIVE']);
            $d_data->set_d_drawlim($val['D_DRAWLIM']);
            $d_data->set_d_period($val['D_PERIOD']);

            $data[] = $d_data;
        }
        return $data;
    }

    public function get_akun($filter) {
        Session::get('id_user');
        $sql = "SELECT  flex_value kdakun,
                        case when enabled_flag='Y' then description else 'Tidak digunakan' end nmakun
                FROM    t_akun where substr(flex_value,1,1)<'A' ";

        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $sql .=" ORDER BY kdakun ";
        //echo($sql);

        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_kdakun($val['KDAKUN']);
            $d_data->set_nMakun($val['NMAKUN']);

            $data[] = $d_data;
        }
        return $data;
    }

    public function get_kppn($filter) {
        Session::get('id_user');
        $sql = "SELECT  kdkppn kdakun,
                        nmkppn nmakun
                FROM    t_kppn where 1=1 ";

        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $sql .=" ORDER BY kdakun ";
        //echo($sql);

        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_kdakun($val['KDAKUN']);
            $d_data->set_nMakun($val['NMAKUN']);

            $data[] = $d_data;
        }
        return $data;
    }

    public function get_sdana($filter) {
        Session::get('id_user');
        $sql = "SELECT  kd_sdana||' ('||sdana||')' kdakun,
                        deskripsi nmakun
                FROM    t_sdana where 1=1 ";

        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $sql .=" ORDER BY kdakun ";
        //echo($sql);

        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_kdakun($val['KDAKUN']);
            $d_data->set_nMakun($val['NMAKUN']);

            $data[] = $d_data;
        }
        return $data;
    }

    public function get_lokasi($filter) {
        Session::get('id_user');
        $sql = "SELECT  kdlokasi kdakun,
                        nmlokasi nmakun
                FROM    t_lokasi where kdlokasi<'A' ";

        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        $sql .=" ORDER BY kdakun ";
        //echo($sql);

        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_kdakun($val['KDAKUN']);
            $d_data->set_nMakun($val['NMAKUN']);

            $data[] = $d_data;
        }
        return $data;
    }

    public function get_satker($filter) {
        Session::get('id_user');
        $sql = "SELECT distinct kdba kdakun,nmba nmakun,'' kdkppn from t_ba a, t_satker b where a.kdba=b.ba  
            and kdsatker not like '%Z%'";
        foreach ($filter as $filter1) {
            $sql .= " AND " . $filter1;
        }
        $sql.=" union
            select distinct kdes1 kdakun,nmes1 nmakun,'' kdkppn from t_eselon1 a,t_satker b where a.kdes1=b.baes1 
            and kdsatker not like '%Z%'";
        foreach ($filter as $filter2) {
            $sql .= " AND " . $filter2;
        }
        $sql.=" union
            select distinct baes1||'-'||kdsatker kdakun,nmsatker nmakun,kppn kdkppn
            from t_satker 
            where kdsatker not like '%Z%'";

        foreach ($filter as $filter3) {
            $sql .= " AND " . $filter3;
        }
        $sql .=" ORDER BY kdakun,nmakun ";
       // echo($sql);

        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_kdakun($val['KDAKUN']);
            $d_data->set_nMakun($val['NMAKUN']);
            $d_data->set_kdkppn($val['KDKPPN']);

            $data[] = $d_data;
        }
        return $data;
    }

    /*
     * setter
     */

    function get_kdakun() {
        return $this->_kdakun;
    }

    function get_nmakun() {
        return $this->_nmakun;
    }

    function set_kdakun($_kdakun) {
        $this->_kdakun = $_kdakun;
    }

    function set_nmakun($_nmakun) {
        $this->_nmakun = $_nmakun;
    }

    public function set_status_span($status_span) {
        $this->_status_span = $status_span;
    }

    public function set_reg_no($reg_no) {
        $this->_reg_no = $reg_no;
    }

    public function set_d_signed($d_signed) {
        $this->_d_signed = $d_signed;
    }

    public function set_d_effective($d_effective) {
        $this->_d_effective = $d_effective;
    }

    public function set_d_drawlim($d_drawlim) {
        $this->_d_drawlim = $d_drawlim;
    }

    public function set_cred_ref($cred_ref) {
        $this->_cred_ref = $cred_ref;
    }

    public function set_name($name) {
        $this->_name = $name;
    }

    public function set_cred_name($cred_name) {
        $this->_cred_name = $cred_name;
    }

    public function set_cred_type($cred_type) {
        $this->_cred_type = $cred_type;
    }

    public function set_curr($curr) {
        $this->_curr = $curr;
    }

    public function set_country($country) {
        $this->_country = $country;
    }

    public function set_amt_ori($amt_ori) {
        $this->_amt_ori = $amt_ori;
    }

    public function set_amt_amend($amt_amend) {
        $this->_amt_amend = $amt_amend;
    }

    public function set_amt_net($amt_net) {
        $this->_amt_net = $amt_net;
    }

    public function set_disb_type($disb_type) {
        $this->_disb_type = $disb_type;
    }

    public function set_purpose($purpose) {
        $this->_purpose = $purpose;
    }

    public function set_benef($benef) {
        $this->_benef = $benef;
    }

    public function set_lg_id($lg_id) {
        $this->_lg_id = $lg_id;
    }

    function get_kdba() {
        return $this->_kdba;
    }

    function get_nmba() {
        return $this->_nmba;
    }

    function get_kdkppn() {
        return $this->_kdkppn;
    }

    function set_kdba($_kdba) {
        $this->_kdba = $_kdba;
    }

    function set_nmba($_nmba) {
        $this->_nmba = $_nmba;
    }

    function set_kdkppn($_kdkppn) {
        $this->_kdkppn = $_kdkppn;
    }

    public function set_reg_type($reg_type) {
        $this->_reg_type = $reg_type;
    }

    public function set_status($status) {
        $this->_status = $status;
    }

    public function set_d_period($d_period) {
        $this->_d_period = $d_period;
    }

    public function set_cara_tarik($cara_tarik) {
        $this->_cara_tarik = $cara_tarik;
    }

    /*
     * getter
     */

    public function get_status_span() {
        return $this->_status_span;
    }

    public function get_reg_no() {
        return $this->_reg_no;
    }

    public function get_d_signed() {
        return $this->_d_signed;
    }

    public function get_d_effective() {
        return $this->_d_effective;
    }

    public function get_d_drawlim() {
        return $this->_d_drawlim;
    }

    public function get_cred_ref() {
        return $this->_cred_ref;
    }

    public function get_name() {
        return $this->_name;
    }

    public function get_cred_name() {
        return $this->_cred_name;
    }

    public function get_cred_type() {
        return $this->_cred_type;
    }

    public function get_curr() {
        return $this->_curr;
    }

    public function get_country() {
        return $this->_country;
    }

    public function get_amt_ori() {
        return $this->_amt_ori;
    }

    public function get_amt_amend() {
        return $this->_amt_amend;
    }

    public function get_amt_net() {
        return $this->_amt_net;
    }

    public function get_disb_type() {
        return $this->_disb_type;
    }

    public function get_purpose() {
        return $this->_purpose;
    }

    public function get_benef() {
        return $this->_benef;
    }

    public function get_lg_id() {
        return $this->_lg_id;
    }

    public function get_reg_type() {
        return $this->_reg_type;
    }

    public function get_status() {
        return $this->_status;
    }

    public function get_d_period() {
        return $this->_d_period;
    }

    public function get_cara_tarik() {
        return $this->_cara_tarik;
    }

    /*
     * destruktor
     */

    public function __destruct() {
        
    }

}
