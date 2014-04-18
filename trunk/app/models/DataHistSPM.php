<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataHistSPM{

    private $db;
	private $_invoice_amount;
    private $_ou_name;
    private $_creation_date;
    private $_invoice_num;
	private $_invoice_description;
	private $_wfapproval_status;
	private $_status;
	private $_attribute15;
	private $_original_recipient;
	private $_to_user;
	private $_item_key;
	private $_org_id;
	private $_organization_id;
	private $_user_name ;
	private $_begin_date;
	private $_time_begin_date;
	private $_end_date;
	private $_time_end_date;
	private $_fu_description;
    private $_table1 = 'ap_invoices_all_v';
    public $registry;
	
    /*
     * konstruktor
     */

    public function __construct($registry = Registry) {
         return $this->db = $registry->db;
         return $this->registry = $registry;
    }

    /*
     * mendapatkan data dari tabel Data Tetap
     * @param limit batas default null
     * return array objek Data Tetap*/
    
    public function get_hist_spm_filter($filter) {
	Session::get('id_user');
		$sql = "SELECT *
				from "
				. $this->_table1 ."
				  WHERE SUBSTR(OU_NAME,1,3)= ".Session::get('id_user')
				;
				
				
		$no=0;
		foreach ($filter as $filter) {
			$sql .= " AND ".$filter;
		}
		$sql .= " ORDER BY BEGIN_DATE, INVOICE_NUM DESC";
		//var_dump ($sql);
        $result =  $this->db->select($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_invoice_amount(number_format($val['INVOICE_AMOUNT']));
            $d_data->set_ou_name($val['OU_NAME']);
            $d_data->set_creation_date($val['CREATION_DATE']);
            $d_data->set_invoice_num($val['INVOICE_NUM']);
            $d_data->set_invoice_description($val['INVOICE_DESCRIPTION']);
            $d_data->set_wfapproval_status($val['WFAPPROVAL_STATUS']);
			$d_data->set_status($val['STATUS']);
			$d_data->set_attribute15($val['ATTRIBUTE15']);
			$d_data->set_original_recipient($val['ORIGINAL_RECIPIENT']);
			$d_data->set_to_user($val['TO_USER']);
			$d_data->set_item_key($val['ITEM_KEY']);
			$d_data->set_org_id($val['ORG_ID']);
			$d_data->set_organization_id($val['ORGANIZATION_ID']);
			$d_data->set_user_name($val['USER_NAME']);
			$d_data->set_fu_description($val['FU_DESCRIPTION']);
			$d_data->set_begin_date($val['BEGIN_DATE']);
			$d_data->set_time_begin_date($val['TIME_BEGIN_DATE']);
			$d_data->set_end_date($val['END_DATE']);
			$d_data->set_time_end_date($val['TIME_END_DATE']);
            $data[] = $d_data;
        }
        return $data;
    }
	
    /*
     * setter
     */

    public function set_invoice_amount($invoice_amount) {
         return $this->_invoice_amount = $invoice_amount;
    }
    public function set_ou_name($ou_name) {
         return $this->_ou_name = $ou_name;
    }
    public function set_creation_date($creation_date) {
         return $this->_creation_date = $creation_date;
    }
    public function set_invoice_num($invoice_num) {
         return $this->_invoice_num = $invoice_num;
    }
    public function set_invoice_description($invoice_description) {
         return $this->_invoice_description = $invoice_description;
    }
    public function set_wfapproval_status($wfapproval_status) {
         return $this->_wfapproval_status = $wfapproval_status;
    }
	 public function set_status($status) {
         return $this->_status = $status;
    }
	 public function set_attribute15($attribute15) {
         return $this->_attribute15 = $attribute15;
    }
	 public function set_original_recipient($original_recipient) {
         return $this->_original_recipient = $original_recipient;
    }
	 public function set_to_user($to_user) {
         return $this->_to_user = $to_user;
    }
	public function set_item_key($item_key) {
         return $this->_item_key = $item_key;
    }
	public function set_org_id($org_id) {
         return $this->_org_id = $org_id;
    }
	public function set_organization_id($organization_id) {
         return $this->_organization_id = $organization_id;
    }
	
	public function set_user_name($user_name) {
         return $this->_user_name = $user_name;
    }
	public function set_fu_description($fu_description) {
         return $this->_fu_description = $fu_description;
    }
	public function set_begin_date($begin_date) {
         return $this->_begin_date = $begin_date;
    }
	public function set_time_begin_date($time_begin_date) {
         return $this->_time_begin_date = $time_begin_date;
    }
	public function set_end_date($end_date) {
         return $this->_end_date = $end_date;
    }
	public function set_time_end_date($time_end_date) {
         return $this->_time_end_date = $time_end_date;
    }
	/*
     * getter
     */
	
	public function get_invoice_amount() {
        return $this->_invoice_amount;
    }
    public function get_ou_name() {
         return $this->_ou_name;
    }
    public function get_creation_date() {
         return $this->_creation_date ;
    }
    public function get_invoice_num() {
         return $this->_invoice_num ;
    }
    public function get_invoice_description() {
         return $this->_invoice_description ;
    }
    public function get_wfapproval_status() {
         return $this->_wfapproval_status ;
    }
	 public function get_status() {
         return $this->_status ;
    }
	 public function get_attribute15() {
         return $this->_attribute15 ;
    }
	 public function get_original_recipient () {
         return $this->_original_recipient ;
    }
	 public function get_to_user() {
         return $this->_to_user ;
    }
	public function get_item_key() {
         return $this->_item_key ;
    }
	public function get_org_id() {
         return $this->_org_id ;
    }
	public function get_organization_id() {
         return $this->_organization_id ;
    }
	
	public function get_user_name() {
         return $this->_user_name ;
    }
	public function get_fu_description() {
         return $this->_fu_description ;
    }
	public function get_begin_date() {
         return $this->_begin_date ;
    }
	public function get_time_begin_date() {
         return $this->_time_begin_date ;
    }
	public function get_end_date() {
         return $this->_end_date ;
    }
	public function get_time_end_date() {
         return $this->_time_end_date ;
    }


    /*
     * destruktor
     */

    public function __destruct() {
        
    }

}