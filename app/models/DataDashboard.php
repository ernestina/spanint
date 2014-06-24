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
    
    public $registry;

    /*
     * konstruktor
     */

    public function __construct($registry = Registry) {
        $this->db = $registry->db;
        $this->registry = $registry;
    }
    
    public function get_sp2d_rekap($hari) {
        //$sql = "select jenis_sp2d, count(check_number) jumlah, sum(amount) nominal from AP_CHECKS_ALL_V where substr(check_number,3,3) in (select kdkppn from t_kppn where kdkanwil='11') and check_date between to_date('01052014','ddmmyyyy') and to_date('01062014','ddmmyyyy') group by jenis_sp2d;";
        
        $data = array();
        for ($i=0; $i<$hari; $i++) {
            $sql = "select status_lookup_code, jenis_sp2d, count(check_number) jumlah, sum(amount) nominal from (select distinct(check_number), status_lookup_code, jenis_sp2d, amount from AP_CHECKS_ALL_V where substr(check_number,3,3) = '".Session::get('id_user')."' and check_date = to_date('".date("Ymd",time()-($i*24*60*60))."','yyyymmdd')) group by status_lookup_code, jenis_sp2d";
            $result =  $this->db->select($sql);
            //var_dump($result);
            $d_data = new $this($this->registry);
            foreach ($result as $val) {
                if ($val['STATUS_LOOKUP_CODE']=='VOIDED') {
                    $d_data->set_void($d_data->get_void() + $val['JUMLAH']);
                    $d_data->set_vol_void($d_data->get_vol_void() + $val['NOMINAL']);
                } else {
                    if ($val['JENIS_SP2D']=='GAJI') {
                        $d_data->set_gaji($d_data->get_gaji() + $val['JUMLAH']);
                        $d_data->set_vol_gaji($d_data->get_vol_gaji() + $val['NOMINAL']);
                    } else if ($val['JENIS_SP2D']=='NON GAJI') {
                        $d_data->set_non_gaji($d_data->get_non_gaji() + $val['JUMLAH']);
                        $d_data->set_vol_non_gaji($d_data->get_vol_non_gaji() + $val['NOMINAL']);
                    } else if ($val['JENIS_SP2D']=='LAINNYA') {
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
    
    public function get_sp2d_retur($hari) {
        $sql = "select STATUS_RETUR, count(STATUS_RETUR) JUMLAH from RETUR_SPAN_V where KDKPPN='".Session::get('id_user')."' and TGL_RETUR between to_date('".date("Ymd",time()-(($hari-1)*24*60*60))."','yyyymmdd') and to_date('".date("Ymd",time())."','yyyymmdd') group by STATUS_RETUR;";
        var_dump($sql);
        $result =  $this->db->select($sql);
        var_dump($result);
        $d_data = new $this($this->registry);
        foreach ($result as $val) {
            if ($val['STATUS_RETUR']=='SUDAH PROSES') {
                $d_data->set_retur_sudah_proses($d_data->get_retur_sudah_proses() + $val['JUMLAH']);
            } else {
                $d_data->set_retur_belum_proses($d_data->get_retur_belum_proses() + $val['JUMLAH']);
            }
        }
        var_dump($d_data);
        return $d_data;
    }
    
    public function get_list_sp2d_selesai() {
        //$sql = "select jenis_sp2d, count(check_number) jumlah, sum(amount) nominal from AP_CHECKS_ALL_V where substr(check_number,3,3) in (select kdkppn from t_kppn where kdkanwil='11') and check_date between to_date('01052014','ddmmyyyy') and to_date('01062014','ddmmyyyy') group by jenis_sp2d;";
        
        $data = array();
        
        $sql = "select distinct(check_number), jenis_sp2d, amount from AP_CHECKS_ALL_V where substr(check_number,3,3) = ".Session::get('id_user')." and check_date = to_date('".date("Ymd",time())."','yyyymmdd')";
        $result =  $this->db->select($sql);
        
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_jenis_sp2d($val['JENIS_SP2D']);
            $d_data->set_check_number($val['CHECK_NUMBER']);
            $d_data->set_nominal_sp2d($val['AMOUNT']);
            //var_dump($val['AMOUNT']);
            $data[] = $d_data;
        }
        //var_dump($data);
        return $data;
    }
    
    public function get_lhp_rekap($hari) {
        $data = array();
        for ($i=0; $i<$hari; $i++) {
            if ($hari == 1) {
                $sql = "select * from spgr_mpn_dashboard where kppn = '".Session::get('id_user')."' and tanggal=(select max(tanggal) from spgr_mpn_dashboard where kppn = '".Session::get('id_user')."')";
            } else {
                $sql = "select * from spgr_mpn_dashboard where kppn = '".Session::get('id_user')."' and tanggal = to_date('".date("Ymd",time()-($i*24*60*60))."','yyyymmdd')";
            }
            $result =  $this->db->select($sql);
            $d_data = new $this($this->registry);
            //var_dump($result);
            foreach ($result as $val) {
                if ($val['STATUS']=='Completed') {
                    $d_data->set_lhp_completed($val['JUMLAH']);
                    $d_data->set_vol_lhp_completed($val['NOMINAL']);
                } else if ($val['STATUS']=='Validated') {
                    $d_data->set_lhp_validated($val['JUMLAH']);
                    $d_data->set_vol_lhp_validated($val['NOMINAL']);
                } else if ($val['STATUS']=='Error') {
                    $d_data->set_lhp_error($val['JUMLAH']);
                    $d_data->set_vol_lhp_error($val['NOMINAL']);
                } else {
                    $d_data->set_lhp_etc($val['JUMLAH']);
                    $d_data->set_vol_lhp_etc($val['NOMINAL']);
                }
            }
            $data[$i] = $d_data;
        }
        return $data;
    }
    
    public function get_hist_spm_filter($filter) {
        Session::get('id_user');
		$sql = "SELECT OU_NAME, INVOICE_NUM, TO_USER, FU_DESCRIPTION, TIME_BEGIN_DATE from ap_invoices_all_v WHERE STATUS = 'OPEN' ";		
		$no=0;
		foreach ($filter as $filter) {
			$sql .= " AND ".$filter;
		}
		$sql .= " ORDER BY TIME_BEGIN_DATE DESC, INVOICE_NUM";
        $result =  $this->db->select($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_ou_name($val['OU_NAME']);
            $d_data->set_invoice_num($val['INVOICE_NUM']);
			$d_data->set_to_user($val['TO_USER']);
			$d_data->set_fu_description(substr($val['FU_DESCRIPTION'],11));
			$d_data->set_time_begin_date($val['TIME_BEGIN_DATE']);
            $data[] = $d_data;
        }
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
    
    /*
     * destruktor
     */

    public function __destruct() {
        
    }

}