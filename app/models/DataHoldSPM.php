<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataHoldSPM{

    private $db;
	private $_invoice_num;
    private $_invoice_amount;
    private $_invoice_id;
	private $_invoice_id_hold;
    private $_hold_reason;
	private $_hold_date;
	private $_release_reason;
	private $_attribute15;
	private $_description;
    private $_table1 = 'ap_invoices_all';
	private $_table2 = 'ap_holds_all';
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
     * return array objek Data Tetap*/
    
    public function get_hold_spm_filter($filter) {
		Session::get('id_user');
		$sql = "SELECT A.INVOICE_NUM, A.INVOICE_AMOUNT, A.DESCRIPTION, B.HOLD_REASON, B.HOLD_DATE, B.RELEASE_REASON
				FROM " 
				. $this->_table1 . " A, "
				. $this->_table2 . " B  
				WHERE 
				A.ATTRIBUTE15 = ".Session::get('id_user').
				" and A.INVOICE_ID=B.INVOICE_ID"
				;
		$no=0;
		foreach ($filter as $filter) {
			$sql .= " AND ".$filter;
		}
		
		$sql .= " ORDER BY B.HOLD_DATE DESC";
		
		//var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_invoice_num($val['INVOICE_NUM']);
            $d_data->set_invoice_amount(number_format($val['INVOICE_AMOUNT']));
            $d_data->set_hold_reason($val['HOLD_REASON']);
            $d_data->set_hold_date(date("d-m-Y",strtotime($val['HOLD_DATE'])));
			//$d_data->set_check_date(date("d-m-Y",strtotime($val['CHECK_DATE'])));
            $d_data->set_release_reason($val['RELEASE_REASON']);
            $d_data->set_invoice_id($val['INVOICE_ID']);
			$d_data->set_invoice_id_hold($val['INVOICE_ID']);
			$d_data->set_attribute15($val['ATTRIBUTE15']);
			$d_data->set_description($val['DESCRIPTION']);
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
	public function set_invoice_amount($invoice_amount) {
        $this->_invoice_amount = $invoice_amount;
    }
	
    public function set_hold_reason($hold_reason) {
        $this->_hold_reason = $hold_reason;
    }
	
    public function set_hold_date($hold_date) {
        $this->_hold_date = $hold_date;
    }
	
    public function set_release_reason($release_reason) {
        $this->_release_reason = $release_reason;
    }
	
    public function set_invoice_id($invoice_id) {
        $this->_invoice_id = $invoice_id;
    }
	
	public function set_invoice_id_hold($invoice_id_hold) {
        $this->_invoice_id_hold = $invoice_id_hold;
    }
	public function set_attribute15($attribute15) {
        $this->_attribute15 = $attribute15;
    }
	public function set_description($description) {
        $this->_description = $description;
    }
		
	/*
     * getter
     */
	
	public function get_invoice_num() {
        return $this->_invoice_num;
    }
	
	public function get_invoice_amount() {
        return $this->_invoice_amount;
    }
	
	public function get_hold_reason() {
        return $this->_hold_reason;
    }
	
	
	public function get_hold_date() {
        return $this->_hold_date;
    }
	
	public function get_release_reason() {
        return $this->_release_reason;
    }
	
	public function get_invoice_id() {
        return $this->_invoice_id;
    }
	
	public function get_invoice_id_hold() {
        return $this->_invoice_id_hold;
    }
	 public function get_attribute15() {
         return $this->_attribute15 ;
    }
	public function get_description() {
         return $this->_description ;
    }
	

    /*
     * destruktor
     */

    public function __destruct() {
        
    }

}