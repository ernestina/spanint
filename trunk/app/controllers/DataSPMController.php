<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataSPMController extends BaseController {
    /*
     * Konstruktor
     */

    public function __construct($registry) {
        parent::__construct($registry);
    }

    /*
     * Index
     */

   
	/*
	public function infoSP2D() {
		$d_spm = new DataSPM($this->registry);
		d_spm->get_spm_filter();
		//var_dump($d_sppm->get_sppm_filter($filter));
		$this->view->render('kppn/isianSPM');
	}
	*/
    

	public function posisiSpm() {
		$d_spm1 = new DataHistSPM($this->registry);
		$filter = array ();
		$no=0;
		if (isset($_POST['submit_file'])) {
			if ($_POST['kdkppn']!=''){
					$filter[$no++]=" SUBSTR(OU_NAME,1,3)= ".$_POST['kdkppn'];
					$this->view->d_kdkppn = $_POST['kdkppn'];
			} 
		}
		else {
			$filter[$no++]="SUBSTR(OU_NAME,1,3) = ".Session::get('id_user');
		}
		if (Session::get('role')==KANWIL){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
			}
		if (Session::get('role')==ADMIN){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
			}
			$filter[$no++]=" STATUS = 'OPEN'";
			$this->view->data = $d_spm1->get_hist_spm_filter ($filter);
		//var_dump($d_spm->get_hist_spm_filter());
		$this->view->render('kppn/posisiSPM');
	}
	
	public function detailposisiSpm($invoice_num1=null, $invoice_num2=null, $invoice_num3=null ) {
		$d_spm1 = new DataHistSPM($this->registry);
		$filter = array ();
		$no=0;
			if (!is_null($invoice_num1)) {
				$filter[$no++]="INVOICE_NUM =  '".$invoice_num1."/".$invoice_num2."/".$invoice_num3."'";
				//$this->view->invoice_num = $invoice_num;
			}
		
		$this->view->data = $d_spm1->get_hist_spm_filter($filter);
			
		//var_dump($d_spm->get_hist_spm_filter());
		$this->view->render('kppn/detailposisiSPM');
	}
	
	public function HoldSpm() {
		$d_spm1 = new DataHoldSPM($this->registry);
		$filter = array ();
		$no=0;
		if (isset($_POST['submit_file'])) {
				
			if ($_POST['invoice']!=''){
					$filter[$no++]="invoice_num = '".$_POST['invoice']."'";
			}
			if ($_POST['kdkppn']!=''){
					$filter[$no++]="ATTRIBUTE15 = ".$_POST['kdkppn'];
					$d_kppn = new DataUser($this->registry);
					$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
			}
			if ($_POST['STATUS']!=''){
					$filter[$no++]="A.CANCELLED_DATE " .$_POST['STATUS'];
			}
			
		}	
		else {
					$filter[$no++]="ATTRIBUTE15 = ".Session::get('id_user');
				}
		if (Session::get('role')==KANWIL){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
			}
		if (Session::get('role')==ADMIN){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
			}
		$this->view->data = $d_spm1->get_hold_spm_filter($filter);
		//var_dump($d_spm1->get_hold_spm_filter ($filter));
		
		$this->view->render('kppn/holdSPM');
	}
	
	
	public function ValidasiSpm() {
		$d_spm1 = new DataValidasiUploadSPM($this->registry);
		$filter = array ();
		Session::get('id_user');
		$no=0;
			if (isset($_POST['submit_file'])) {
				if ($_POST['kdkppn']!=''){
					$filter[$no++]="SUBSTR(OPERATING_UNIT,1,3) = ".$_POST['kdkppn'];
					$d_kppn = new DataUser($this->registry);
					$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
					
					//$filter[$no++]=" creation_date in 
									//(select max(creation_date) from SPPM_AP_INV_INT_ALL where SUBSTR(OPERATING_UNIT,1,3) = ".$_POST['kdkppn']."
									//and STATUS_CODE = 'Validasi gagal') ";
								
				} else {
					$filter[$no++]="SUBSTR(OPERATING_UNIT,1,3) = ".Session::get('id_user');
				}
				
				if ($_POST['kdsatker']!=''){
					$filter[$no++]="substr(invoice_num,8,6) = '".$_POST['kdsatker'] . "'";
				}
				if ($_POST['file_name']!=''){
					$filter[$no++]=" upper(file_name) = upper('".$_POST['file_name'] . "')";
				}
				if ($_POST['tgl_awal']!='' AND $_POST['tgl_akhir']!=''){
					$filter[$no++] = "CREATION_DATE BETWEEN TO_DATE('".$_POST['tgl_awal']."','DD/MM/YYYY hh:mi:ss') AND TO_DATE('".$_POST['tgl_akhir']."','DD/MM/YYYY hh:mi:ss')";
					$this->view->d_tgl_awal = $_POST['tgl_awal'];
					$this->view->d_tgl_akhir = $_POST['tgl_akhir'];
				}	
				
			$this->view->data = $d_spm1->get_validasi_spm_filter($filter);	
			}
			
			if (Session::get('role')==KANWIL){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
			}
			if (Session::get('role')==ADMIN){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
			}
			if (Session::get('role')==KPPN){
				$filter[$no++]="SUBSTR(OPERATING_UNIT,1,3) = ".Session::get('id_user');
				if (!isset($_POST['submit_file'])) {
							$filter[$no++]=" creation_date in 
							(select max(creation_date) from SPPM_AP_INV_INT_ALL where SUBSTR(OPERATING_UNIT,1,3) = ".Session::get('id_user')."
							and STATUS_CODE = 'Validasi gagal') ";
				}
				$this->view->data = $d_spm1->get_validasi_spm_filter($filter);
			}
			
			$this->view->render('kppn/validasiuploadSPM');
		}
	
	
	public function errorSpm($file_name=null) {
		$d_spm1 = new DataUploadSPM($this->registry);
		$filter = array ();
		$no=0;
			if (!is_null($file_name)) {
				$filter[$no++]="FILE_NAME =  '".$file_name."'";
				//$this->view->invoice_num = $invoice_num;
			}
			if (Session::get('role')==KPPN){
				$filter[$no++]="SUBSTR(FILE_NAME,5,3) = ".Session::get('id_user');
			}
			
		$this->view->data = $d_spm1->get_error_spm_filter ($filter);
		//var_dump($d_spm1->get_error_spm_filter ($filter));
		$this->view->render('kppn/uploadSPM');
	}
	
	
	
	public function HistorySpm ($invoice_num1=null, $invoice_num2=null, $invoice_num3=null, $sp2d=null ) {
		$d_spm1 = new DataHistorySPM($this->registry);
		$filter = array ();
		$invoice = '';
		$no=0;
			
			if (Session::get('role')==KANWIL){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
			}
			if (Session::get('role')==ADMIN){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
			}
			if (Session::get('role')==KPPN){
				$filter[$no++]= Session::get('id_user')
				 ;
			//$this->view->data = $d_spm1->get_history_spm_filter ($filter);
			}
			if (!is_null($invoice_num1)) {
				$invoice="'".$invoice_num1."/".$invoice_num2."/".$invoice_num3."'";
				$kppn=substr($sp2d,2,3);
				$filter[$no++]= $kppn;
				//$this->view->invoice_num = $invoice_num;
				$this->view->data = $d_spm1->get_history_spm_filter ($filter, $invoice);
			}
			if (isset($_POST['submit_file'])) {
				
				if ($_POST['kdkppn']!=''){
					$filter[$no++]=$_POST['kdkppn'];
					$d_kppn = new DataUser($this->registry);
					$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
				} 
				else {
					$filter[$no++]= Session::get('id_user');
				}
				
				if ($_POST['invoice']!=''){
					$invoice ="'".$_POST['invoice']."'";
					$this->view->d_invoice = $_POST['invoice'];
				}
			$this->view->data = $d_spm1->get_history_spm_filter ($filter, $invoice);
			}
			
			
		//var_dump($d_spm->get_hist_spm_filter());
		$this->view->render('kppn/historySPM');
	}
	
	
	public function DurasiSpm() {
		$d_spm1 = new DataDurasiSPM($this->registry);
		$filter = array ();
		$no=0;
		if (isset($_POST['submit_file'])) {
		
				if ($_POST['kdkppn']!=''){
					$filter[$no++]="SUBSTR(OPERATING_UNIT,1,3) = ".$_POST['kdkppn'];
					$d_kppn = new DataUser($this->registry);
					$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
					$filter[$no++] = " to_date(tanggal_upload,'dd-MM-yyyy') in (select max(to_date(tanggal_upload,'dd-MON-yyyy'))
								from DURATION_INV_ALL_V where SUBSTR(OPERATING_UNIT,1,3) = ".$_POST['kdkppn'].")" ;
				} else {
					$filter[$no++]="SUBSTR(OPERATING_UNIT,1,3) = ".Session::get('id_user');
				}
				
				if ($_POST['invoice']!=''){
					$filter[$no++]="invoice_num = '".$_POST['invoice'] . "'";
				}
				if ($_POST['kdsatker']!=''){
					$filter[$no++]="substr(invoice_num,8,6) = '".$_POST['kdsatker'] . "'";
				}
				if ($_POST['JenisSPM']!=''){
					$filter[$no++]="jendok = '".$_POST['JenisSPM'] . "'";
				}
				if ($_POST['durasi']!=''){
					$filter[$no++]="durasi2 ".$_POST['durasi'] . "'";
				}
				
				if ($_POST['tgl_awal']!='' AND $_POST['tgl_akhir']!=''){
					$filter[$no++] = "TANGGAL_UPLOAD BETWEEN to_date('".$_POST['tgl_awal']."','dd-mm-yyyy') AND to_date('".$_POST['tgl_akhir']."' ,'dd-mm-yyyy')";
					$this->view->d_tgl_awal = $_POST['tgl_awal'];
					$this->view->d_tgl_akhir = $_POST['tgl_akhir'];
				}
				
			$this->view->data = $d_spm1->get_durasi_spm_filter ($filter);	
		}
		if (Session::get('role')==KANWIL){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
		}
		if (Session::get('role')==ADMIN){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
		}		
		if (Session::get('role')==KPPN) {	
				$filter[$no++]="SUBSTR(OPERATING_UNIT,1,3) = ".Session::get('id_user');
				if (!isset($_POST['submit_file'])){
					$filter[$no++] = " to_date(tanggal_upload,'dd-MM-yyyy') in (select max(to_date(tanggal_upload,'dd-MON-yyyy'))
								from DURATION_INV_ALL_V where SUBSTR(OPERATING_UNIT,1,3) = ".Session::get('id_user').")" ;
				}
		$this->view->data = $d_spm1->get_durasi_spm_filter ($filter);
		//var_dump($d_spm1->get_error_spm_filter ($filter));
		}
		$this->view->render('kppn/DurasiSPM');
	}
	
	public function nmsatker() {
		$d_spm1 = new DataNamaSatker($this->registry);
		$filter = array ();
		$no=0;
			if (isset($_POST['submit_file'])) {
			
				if ($_POST['kdkppn']!=''){
					$filter[$no++]="TS.KPPN = '".$_POST['kdkppn']."'";
					$d_kppn = new DataUser($this->registry);
					$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
				} else {
					$filter[$no++]="TS.KPPN = '".Session::get('id_user')."'";
				}
				
				if ($_POST['kdsatker']!=''){
					$filter[$no++]="KDSATKER = '".$_POST['kdsatker']."'";
					$this->view->d_invoice = $_POST['kdsatker'];
				}
				if ($_POST['nmsatker']!=''){
					$filter[$no++]=" UPPER(TS.NMSATKER) LIKE UPPER('%".$_POST['nmsatker']."%')";
					$this->view->d_invoice = $_POST['nmsatker'];
				}
				
			$this->view->data = $d_spm1->get_satker_filter($filter);
			//$this->view->render('kppn/NamaSatker');			
			}
			if (Session::get('role')==KANWIL){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
			}
			if (Session::get('role')==ADMIN){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
			}
			if (Session::get('role')==KPPN) {$filter[$no++]="TS.KPPN = '".Session::get('id_user')."'";	
			$this->view->data = $d_spm1->get_satker_filter($filter);	
			}
					
		
		//var_dump($d_spm1->get_satker_filter($filter));
		$this->view->render('kppn/NamaSatker');
	}
	
	public function daftarsp2d($kdsatker=null) {
		$d_spm1 = new DataCheck($this->registry);
		$filter = array ();
		$no=0;
		if ($kdsatker != '') {
				$filter[$no++]=" SUBSTR(INVOICE_NUM,8,6) =  '".$kdsatker."'";
				//$this->view->invoice_num = $invoice_num;	
			}
		if (isset($_POST['submit_file'])) {
			
			
			if ($_POST['check_number']!=''){
					$filter[$no++]="check_number = '".$_POST['check_number']."'";
					$this->view->d_invoice = $_POST['check_number'];
				}

			if ($_POST['invoice']!=''){
					$filter[$no++]="invoice_num = '".$_POST['invoice']."'";
					$this->view->invoice = $_POST['invoice'];
				}
			if ($_POST['JenisSP2D']!=''){
					$filter[$no++]="JENIS_SP2D = '".$_POST['JenisSP2D']."'";
					$this->view->JenisSP2D = $_POST['JenisSP2D'];
				}
			
			}	

			if ($_POST['tgl_awal']!='' AND $_POST['tgl_akhir']!=''){
					$filter[$no++] = "CHECK_DATE BETWEEN TO_DATE('".$_POST['tgl_awal']."','DD/MM/YYYY hh:mi:ss') AND TO_DATE('".$_POST['tgl_akhir']."','DD/MM/YYYY hh:mi:ss')";
					$this->view->d_tgl_awal = $_POST['tgl_awal'];
					$this->view->d_tgl_akhir = $_POST['tgl_akhir'];
				}
			if (Session::get('role')==KPPN) {$filter[$no++]="SUBSTR(CHECK_NUMBER,3,3) = '".Session::get('id_user')."'";	
					
			}
		$this->view->data = $d_spm1->get_sp2d_satker_filter($filter);	
		//var_dump($d_spm1->get_satker_filter($filter));
		$this->view->render('kppn/SP2DSatker');
	}	
	//author by jhon
	
    public function __destruct() {
        
    }
}
