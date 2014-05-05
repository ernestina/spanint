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
				
				if ($_POST['invoice']!=''){
					$filter[$no++]="invoice_num = '".$_POST['invoice'] . "'";
				}
				if ($_POST['file_name']!=''){
					$filter[$no++]=" upper(file_name) = upper('".$_POST['file_name'] . "')";
				}
			$this->view->data = $d_spm1->get_validasi_spm_filter($filter);	
			}	
		
			//var_dump($d_spm1->get_error_spm_filter ($filter));
			
	
			else{
				$filter[$no++]=" creation_date in 
				(select max(creation_date) from SPPM_AP_INV_INT_ALL where SUBSTR(OPERATING_UNIT,1,3) = ".Session::get('id_user')."
				 and STATUS_CODE = 'Validasi gagal') ";
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
		$this->view->data = $d_spm1->get_error_spm_filter ($filter);
		//var_dump($d_spm1->get_error_spm_filter ($filter));
		$this->view->render('kppn/uploadSPM');
	}
	
	
	
	public function HistorySpm() {
		$d_spm1 = new DataHistorySPM($this->registry);
		$filter = array ();
		$no=0;
			if (isset($_POST['submit_file'])) {
				
				if ($_POST['invoice']!=''){
					$filter[$no++]="'".$_POST['invoice']."'";
					$this->view->d_invoice = $_POST['invoice'];
				}
			$this->view->data = $d_spm1->get_history_spm_filter ($filter);
			}	
			
			
		//var_dump($d_spm->get_hist_spm_filter());
		$this->view->render('kppn/historySPM');
	}
	
	
	public function DurasiSpm() {
		$d_spm1 = new DataDurasiSPM($this->registry);
		$filter = array ();
		$no=0;
		if (isset($_POST['submit_file'])) {
				
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
					$filter[$no++] = "TANGGAL_UPLOAD BETWEEN '".$_POST['tgl_awal']."' AND '".$_POST['tgl_akhir']."'";
					$this->view->d_tgl_awal = $_POST['tgl_awal'];
					$this->view->d_tgl_akhir = $_POST['tgl_akhir'];
				}
			$this->view->data = $d_spm1->get_durasi_spm_filter ($filter);	
		} ELSE {	
		$filter[$no++] = " to_date(tanggal_upload,'dd-mm-yyyy') in (select max(to_date(tanggal_upload,'dd-mm-yyyy'))
		from DURATION_INV_ALL_V where SUBSTR(OPERATING_UNIT,1,3) = ".Session::get('id_user').")" ;
		
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
				
				if ($_POST['kdsatker']!=''){
					$filter[$no++]="KDSATKER = '".$_POST['kdsatker']."'";
					$this->view->d_invoice = $_POST['kdsatker'];
				}
			$this->view->data = $d_spm1->get_satker_filter($filter);	
			}	
			
		$this->view->data = $d_spm1->get_satker_filter($filter);	
		//var_dump($d_spm1->get_satker_filter($filter));
		$this->view->render('kppn/NamaSatker');
	}
	
	public function daftarsp2d($kdsatker=null) {
		$d_spm1 = new DataCheck($this->registry);
		$filter = array ();
		$no=0;
			if (!is_null($kdsatker)) {
				$filter[$no++]=" SUBSTR(INVOICE_NUM,8,6) =  '".$kdsatker."'";
				//$this->view->invoice_num = $invoice_num;
				
			}
		$this->view->data = $d_spm1->get_sp2d_satker_filter($filter);	
		//var_dump($d_spm1->get_satker_filter($filter));
		$this->view->render('kppn/SP2DSatker');
	}	
	
    public function __destruct() {
        
    }
}
