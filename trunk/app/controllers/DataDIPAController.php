<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataDIPAController extends BaseController {
    /*
     * Konstruktor
     */

    public function __construct($registry) {
        parent::__construct($registry);
    }

    /*
     * Index
     */

   
    
	public function RevisiDipa($kdsatker=null) {
		$d_spm1 = new DataDIPA($this->registry);
		$filter = array ();
		$no=0;
			if ($kdsatker != '') {
					$filter[$no++]=" A.SATKER_CODE =  '".$kdsatker."'";
				//$this->view->invoice_num = $invoice_num;	
				}
			if (isset($_POST['submit_file'])) {
				
				if ($_POST['kd_satker']!=''){
					$filter[$no++]="SATKER_CODE = '".$_POST['kd_satker']."'";
					$this->view->satker_code = $_POST['satker_code'];
				}
				if ($_POST['akun']!=''){
					$filter[$no++]="A.ACCOUNT_CODE = '".$_POST['akun']."'";
					$this->view->account_code = $_POST['account_code'];
				}
				if ($_POST['output']!=''){
					$filter[$no++]="A.OUTPUT_CODE = '".$_POST['output']."'";
					$this->view->output_code = $_POST['output_code'];
				}
				if ($_POST['program']!=''){
					$filter[$no++]="A.PROGRAM_CODE = '".$_POST['program']."'";
					$this->view->program_code = $_POST['program_code'];
				}
				if ($_POST['tgl_awal']!='' AND $_POST['tgl_akhir']!=''){
					$filter[$no++] = "A.TANGGAL_POSTING_REVISI BETWEEN '".$_POST['tgl_awal']."' AND '".$_POST['tgl_akhir']."'";
					$this->view->d_tgl_awal = $_POST['tgl_awal'];
					$this->view->d_tgl_akhir = $_POST['tgl_akhir'];
				}
				
			}	

		//var_dump($d_spm->get_hist_spm_filter());
		$this->view->data = $d_spm1->get_dipa_filter($filter);
		$this->view->render('kppn/revisiDIPA');
	}
	
	public function RealisasiFA($kdsatker=null) {
		$d_spm1 = new DataFA($this->registry);
		$filter = array ();
		$no=0;
		if ($kdsatker != '') {
					$filter[$no++]=" A.SATKER =  '".$kdsatker."'";
				//$this->view->invoice_num = $invoice_num;	
				}
		if (Session::get('role')==KPPN) {
					$filter[$no++]="A.KPPN = '".Session::get('id_user')."'";			
			}		
			if (isset($_POST['submit_file'])) {
				
				if ($_POST['kdsatker']!=''){
					$filter[$no++]="A.SATKER = '".$_POST['kdsatker']."'";
					$this->view->satker_code = $_POST['satker_code'];
				}
				if ($_POST['akun']!=''){
					$filter[$no++]="A.AKUN = '".$_POST['akun']."'";
					$this->view->account_code = $_POST['account_code'];
				}
				if ($_POST['output']!=''){
					$filter[$no++]="A.OUTPUT = '".$_POST['output']."'";
					$this->view->output_code = $_POST['output_code'];
				}
				if ($_POST['program']!=''){
					$filter[$no++]="A.PROGRAM = '".$_POST['program']."'";
					$this->view->program_code = $_POST['program_code'];
				}
				if ($_POST['tgl_awal']!='' AND $_POST['tgl_akhir']!=''){
					$filter[$no++] = "A.TANGGAL_POSTING_REVISI BETWEEN '".$_POST['tgl_awal']."' AND '".$_POST['tgl_akhir']."'";
					$this->view->d_tgl_awal = $_POST['tgl_awal'];
					$this->view->d_tgl_akhir = $_POST['tgl_akhir'];
				}
				
			}	
		$this->view->data = $d_spm1->get_fa_filter($filter);
		//var_dump($d_spm->get_hist_spm_filter());
		$this->view->render('kppn/realisasiFA');
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
				
			$this->view->data = $d_spm1->get_satker_dipa_filter($filter);
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
			$this->view->data = $d_spm1->get_satker_dipa_filter($filter);	
			}
					
		
		//var_dump($d_spm1->get_satker_filter($filter));
		$this->view->render('kppn/NamaSatkerDIPA1');
	}
	public function nmsatker1() {
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
		$this->view->render('kppn/NamaSatkerDIPA2');
	}
	
	
	
	
    public function __destruct() {
        
    }
}
