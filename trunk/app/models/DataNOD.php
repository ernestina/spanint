<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataNOD {

    private $db;
    private $_wa_number;
    private $_ref_number;
    private $_rm_name;
    private $_payment_date;
    private $_book_date;
    private $_nod_number;
    private $_nod_date;
    private $_type;
    private $_sp4hln_number;
    private $_curr_loan;
    private $_amount;
    private $_rate_type;
    private $_curr_eff;
    private $_amount_curr_eff;
    private $_amount_curr_local;
    private $_apdpl_number;
    private $_register_number;
    private $_akun_code;
    private $_output_code;
    private $_dana_code;
    private $_amount_service;
    private $_medium_name;
    private $_onlending_desc;
    private $_dmfas_id;
    private $_reksus_type;
    private $_reksus_number;
    private $_table = 'INT_NOD';
    public $registry;

    /*
     * konstruktor
     */

    public function __construct($registry = Registry) {
        $this->db = $registry->db;
        $this->registry = $registry;
    }

    public function get_nod_filter($filter) {
        $sql = "SELECT *
				FROM "
                . $this->_table . "
				WHERE 1=1 AND KDKPPN = '140' "

        ;

        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }

        /*$sql .= " GROUP BY KDKPPN, JENIS_SPM, JENDOK";
        $sql .= " ORDER BY KDKPPN, COUNT(CHECK_NUMBER) DESC, JENIS_SPM";*/
        //var_dump ($sql);

        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_wa_number($val['WA_NUMBER']);
            $d_data->set_ref_number($val['REF_NUMBER']);
            $d_data->set_rm_name($val['RM_NAME']);
            $d_data->set_payment_date(date("d-m-Y", strtotime($val['PAYMENT_DATE'])));
            $d_data->set_book_date(date("d-m-Y", strtotime($val['BOOK_DATE'])));
            $d_data->set_nod_number($val['NOD_NUMBER']);
            $d_data->set_nod_date(date("d-m-Y", strtotime($val['NOD_DATE'])));
            $d_data->set_type($val['TYPE']);
            $d_data->set_sp4hln_number($val['SP4HLN_NUMBER']);
            $d_data->set_curr_loan($val['CURR_LOAN']);
            $d_data->set_amount($val['AMOUNT']);
            $d_data->set_rate_type($val['RATE_TYPE']);
            $d_data->set_curr_eff($val['CURR_EFF']);
            $d_data->set_amount_curr_eff($val['AMOUNT_CURR_EFF']);
            $d_data->set_amount_curr_local($val['AMOUNT_CURR_LOCAL']);
            $d_data->set_apdpl_number($val['APDPL_NUMBER']);
            $d_data->set_register_number($val['REGISTER_NUMBER']);
            $d_data->set_akun_code($val['AKUN_CODE']);
            $d_data->set_output_code($val['OUTPUT_CODE']);
            $d_data->set_dana_code($val['DANA_CODE']);
            $d_data->set_amount_service($val['AMOUNT_SERVICE']);
            $d_data->set_medium_name($val['MEDIUM_NAME']);
            $d_data->set_onlending_desc($val['ONLENDING_DESC']);
            $d_data->set_dmfas_id($val['DMFAS_ID']);
            $d_data->set_reksus_type($val['REKSUS_TYPE']);
            $d_data->set_reksus_number($val['REKSUS_NUMBER']);
            $data[] = $d_data;
        }
        return $data;
    }

    public function get_download_nod($filter) {
        $sql = "SELECT  *
				FROM "
                . $this->_table . "
				WHERE 1=1 AND KDKPPN = '140'
				and WA_NUMBER in ('" . $filter;




        //$no=0;
        //foreach ($filter as $filter) {
        //$sql .= " AND ".$filter;
        //}
        //$sql .= " GROUP BY JENIS_SPM, JENDOK ";
        $sql .= "') ";
        //var_dump ($sql);

        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_wa_number($val['WA_NUMBER']);
            $d_data->set_ref_number($val['REF_NUMBER']);
            $d_data->set_rm_name($val['RM_NAME']);
            $d_data->set_payment_date($val['PAYMENT_DATE']);
            $d_data->set_book_date($val['BOOK_DATE']);
            $d_data->set_nod_number($val['NOD_NUMBER']);
            $d_data->set_nod_date($val['NOD_DATE']);
            $d_data->set_type($val['TYPE']);
            $d_data->set_sp4hln_number($val['SP4HLN_NUMBER']);
            $d_data->set_curr_loan($val['CURR_LOAN']);
            $d_data->set_amount($val['AMOUNT']);
            $d_data->set_rate_type($val['RATE_TYPE']);
            $d_data->set_curr_eff($val['CURR_EFF']);
            $d_data->set_amount_curr_eff($val['AMOUNT_CURR_EFF']);
            $d_data->set_amount_curr_local($val['AMOUNT_CURR_LOCAL']);
            $d_data->set_apdpl_number($val['APDPL_NUMBER']);
            $d_data->set_register_number($val['REGISTER_NUMBER']);
            $d_data->set_akun_code($val['AKUN_CODE']);
            $d_data->set_output_code($val['OUTPUT_CODE']);
            $d_data->set_dana_code($val['DANA_CODE']);
            $d_data->set_amount_service($val['AMOUNT_SERVICE']);
            $d_data->set_medium_name($val['MEDIUM_NAME']);
            $d_data->set_onlending_desc($val['ONLENDING_DESC']);
            $d_data->set_dmfas_id($val['DMFAS_ID']);
            $d_data->set_reksus_type($val['REKSUS_TYPE']);
            $d_data->set_reksus_number($val['REKSUS_NUMBER']);
            $data[] = $d_data;
        }
        return $data;
    }
    
    /*
     * setter
     */

    public function set_wa_number($wa_number) {
        $this->_wa_number = $wa_number;
    }

    public function set_ref_number($ref_number) {
        $this->_ref_number = $ref_number;
    }

    public function set_rm_name($rm_name) {
        $this->_rm_name = $rm_name;
    }

    public function set_payment_date($payment_date) {
        $this->_payment_date = $payment_date;
    }

    public function set_book_date($book_date) {
        $this->_book_date = $book_date;
    }

    public function set_nod_number($nod_number) {
        $this->_nod_number = $nod_number;
    }

    public function set_nod_date($nod_date) {
        $this->_nod_date = $nod_date;
    }

    public function set_type($type) {
        $this->_type = $type;
    }

    public function set_sp4hln_number($sp4hln_number) {
        $this->_sp4hln_number = $sp4hln_number;
    }

    public function set_curr_loan($curr_loan) {
        $this->_curr_loan = $curr_loan;
    }

    public function set_amount($amount) {
        $this->_amount = $amount;
    }

    public function set_rate_type($rate_type) {
        $this->_rate_type = $rate_type;
    }

    public function set_curr_eff($curr_eff) {
        $this->_curr_eff = $curr_eff;
    }

    public function set_amount_curr_eff($amount_curr_eff) {
        $this->_amount_curr_eff = $amount_curr_eff;
    }

    public function set_amount_curr_local($amount_curr_local) {
        $this->_amount_curr_local = $amount_curr_local;
    }

    public function set_apdpl_number($apdpl_number) {
        $this->_apdpl_number = $apdpl_number;
    }

    public function set_register_number($register_number) {
        $this->_register_number = $register_number;
    }

    public function set_akun_code($akun_code) {
        $this->_akun_code = $akun_code;
    }

    public function set_output_code($output_code) {
        $this->_output_code = $output_code;
    }

    public function set_dana_code($dana_code) {
        $this->_dana_code = $dana_code;
    }

    public function set_amount_service($amount_service) {
        $this->_amount_service = $amount_service;
    }

    public function set_medium_name($medium_name) {
        $this->_medium_name = $medium_name;
    }

    public function set_onlending_desc($onlending_desc) {
        $this->_onlending_desc = $onlending_desc;
    }

    public function set_dmfas_id($dmfas_id) {
        $this->_dmfas_id = $dmfas_id;
    }

    public function set_reksus_type($reksus_type) {
        $this->_reksus_type = $reksus_type;
    }

    public function set_reksus_number($reksus_number) {
        $this->_reksus_number = $reksus_number;
    }

    /*
     * getter
     */
	
	public function get_wa_number() {
        return $this->_wa_number;
    }
	
	public function get_ref_number() {
        return $this->_ref_number;
    }
	
	public function get_rm_name() {
        return $this->_rm_name;
    }
	
	public function get_payment_date() {
        return $this->_payment_date;
    }
	
	public function get_book_date() {
        return $this->_book_date;
    }
	
	public function get_nod_number() {
        return $this->_nod_number;
    }
	
	public function get_nod_date() {
        return $this->_nod_date;
    }
	
	public function get_type() {
        return $this->_type;
    }
	
	public function get_sp4hln_number() {
        return $this->_sp4hln_number;
    }
	
	public function get_curr_loan() {
        return $this->_curr_loan;
    }
	
	public function get_amount() {
        return $this->_amount;
    }
	
	public function get_rate_type() {
        return $this->_rate_type;
    }
	
	public function get_curr_eff() {
        return $this->_curr_eff;
    }
	
	public function get_amount_curr_eff() {
        return $this->_amount_curr_eff;
    }
	
	public function get_amount_curr_local() {
        return $this->_amount_curr_local;
    }
	
	public function get_apdpl_number() {
        return $this->_apdpl_number;
    }
	
	public function get_register_number() {
        return $this->_register_number;
    }
	
	public function get_akun_code() {
        return $this->_akun_code;
    }
	
	public function get_output_code() {
        return $this->_output_code;
    }
	
	public function get_dana_code() {
        return $this->_dana_code;
    }
	
	public function get_amount_service() {
        return $this->_amount_service;
    }
	
	public function get_medium_name() {
        return $this->_medium_name;
    }
	
	public function get_onlending_desc() {
        return $this->_onlending_desc;
    }
	
	public function get_dmfas_id() {
        return $this->_dmfas_id;
    }
	
	public function get_reksus_type() {
        return $this->_reksus_type;
    }
	
	public function get_reksus_number() {
        return $this->_reksus_number;
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
