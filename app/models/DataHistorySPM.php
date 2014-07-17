<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataHistorySPM{

    private $db;
	private $_invoice_num;
    private $_response;
    private $_user_name;
    private $_posisi;
	private $_creation_date;
	private $_check_number;
	private $_table1 = 'SPPM_AP_INV_INT_ALL';
	private $_table2 = 'AP_INV_APRVL_HIST_ALL';
	private $_table3 = 'AP_INVOICES_ALL';
	private $_table4 = 'FND_USER';
	private $_table5 = 'PER_ALL_PEOPLE_F';
	private $_table6 = 'AP_INVOICE_PAYMENTS_ALL';
	private $_table7 = 'AP_PAYMENT_HISTORY_ALL';
	private $_table8 = 'AP_CHECKS_ALL';
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
    
    public function get_history_spm_filter($filter,$invoice) {
	Session::get('id_user');
	$no=0;
		foreach ($filter as $filter) 
		{}
		
		$sql = "select 
				AIIA.invoice_num NOMOR_DOKUMEN, 
				AIIA.status_code RESPONSE, 
				pap.last_name nama_user, 
				case when fu.user_name like '19%' then fu.description else fu.user_name end as POSISI, 
				to_char(AIIA.creation_date, 'dd-mm-yyyy hh24:mi:ss') waktu_mulai, 
				'-' NO_SP2D
				from "	. $this->_table1 .	" AIIA," 
						. $this->_table4 . 	" FU," 
						. $this->_table5 .  " PAP 
				WHERE FU.USER_ID = AIIA.created_by
				and pap.person_id = fu.employee_id
				and substr(aiia.operating_unit,1,3) = '".$filter.
				"' 
				and AIIA.invoice_num = " . $invoice . " 
				
				union all
				select
				ai.invoice_num nomor_dukumen
				,'Cancelled' response
				,pap.full_name nama_user
				,case when fu.user_name like '19%' then fu.description else fu.user_name end as Posisi
				,to_char(ai.last_update_date, 'dd-mm-yyyy hh24:mi:ss') waktu_mulai
				,'-' as no_sp2d
				from 
				ap_invoices_all ai,
				fnd_user fu,
				per_all_people_f pap
				where
				ai.cancelled_by=fu.user_id
				and pap.person_id = fu.employee_id
				and ai.cancelled_date is not null
				and ai.invoice_num
				= " . $invoice . " 

				
				union all
				
				select
				ai.invoice_num nomor_dokumen
				,ah.response response
				,pap.last_name nama_user
				,case when fu.user_name like '19%' then fu.description else fu.user_name end as Posisi
				,to_char(ah.creation_date, 'dd-mm-yyyy hh24:mi:ss') waktu_mulai
				,'-' as no_sp2d 
				from "	. $this->_table2 . " ah, "
						. $this->_table3 . " ai, "
						. $this->_table4 . 	" FU," 
						. $this->_table5 .  " PAP
				where ai.invoice_id = ah.invoice_id
				and ah.created_by=fu.user_id
				and ah.last_updated_by=fu.user_id
				and pap.person_id = fu.employee_id
				and substr(ai.pay_group_lookup_code,1,3) = '".$filter.
				"' 
				
				and ai.invoice_num = ". $invoice ." 
				

				union all

				select distinct
				aia.invoice_num nomor_dokumen
				,aap.transaction_type response
				,case when pap.last_name is null then fu.user_name else pap.last_name end as nama_user
				, fu.description  Posisi
				,to_char(aap.creation_date, 'dd-mm-yyyy hh24:mi:ss') waktu_mulai
				,to_char(aca.check_number) no_sp2d
				from " . $this->_table3 . " aia
						
				right join "
						. $this->_table6 . " aipa
				on aipa.invoice_id=aia.invoice_id
				left join "
						. $this->_table7 . " aap
				on aap.check_id=aipa.check_id
				left join "
						. $this->_table8 . " aca
				on aap.check_id=aca.check_id
				inner join "
						. $this->_table4 . 	" FU
				on aap.created_by = fu.user_id
				full join "
						. $this->_table5 .  " PAP
				on pap.person_id = fu.employee_id
				where
				substr(aca.check_number,3,3) = '".$filter.
				"' 
				
				 and aia.invoice_num = ". $invoice ."
				 
				order by waktu_mulai "
				  
				;
				
			
		/*$no=0;
		foreach ($filter as $filter) {
			//$sql .= " AND ".$filter;
		}*/
		//var_dump ($sql);
		
		
        $result =  $this->db->select($sql);
        $data = array();   
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_invoice_num($val['NOMOR_DOKUMEN']);
            $d_data->set_response($val['RESPONSE']);
            $d_data->set_user_name($val['NAMA_USER']);
            $d_data->set_posisi($val['POSISI']);
            $d_data->set_creation_date($val['WAKTU_MULAI']);
			 $d_data->set_check_number($val['NO_SP2D']);
			$data[] = $d_data;
        }
        return $data;
    }
	
    /*
     * setter
     */

    public function set_invoice_num($invoice_num) {
         return $this->_invoice_num = $invoice_num;
    }
    public function set_response($response) {
         return $this->_response = $response;
    }
    public function set_user_name($user_name) {
         return $this->_user_name = $user_name;
    }
    public function set_posisi($posisi) {
         return $this->_posisi = $posisi;
    }
    public function set_creation_date($creation_date) {
         return $this->_creation_date = $creation_date;
    }
	public function set_check_number($check_number) {
         return $this->_check_number = $check_number;
    }
    
	/*
     * getter
     */
	
	public function get_invoice_num() {
        return $this->_invoice_num;
    }
    public function get_response() {
         return $this->_response;
    }
    public function get_user_name() {
         return $this->_user_name ;
    }
    public function get_posisi() {
         return $this->_posisi ;
    }
    public function get_creation_date() {
         return $this->_creation_date ;
    }
    public function get_check_number() {
         return $this->_check_number ;
    }


    /*
     * destruktor
     */

    public function __destruct() {
        
    }

}