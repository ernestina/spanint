<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataKppnController extends BaseController {
    /*
     * Konstruktor
     */

    public function __construct($registry) {
        parent::__construct($registry);
    }

    /*
     * Index
     */

    public function index() {
		header('location:' . URL . 'dataKppn/download');
    }

    public function download($status=null) {
		$d_adk = new DataAdk($this->registry);
		if (isset($_POST['cari'])) {
			$status=$_POST['filter'];
		}
		if (is_null($status)) {
            $status='0';
        }
		$this->view->data = $d_adk->get_adk_list(Session::get('id_user'),$status);
		$this->view->render('kppn/downloadAdk');
	}
	
	public function download_adk($adk,$status,$file_name) {
		$d_adk = new DataAdk($this->registry);
		if ($status==0){
			$d_adk->set_kd_status('1');
			$d_adk->update_status($adk);
		}
		header('location:' . URL . 'adk/'.$file_name);
	}
	
	public function monitoringSp2d() {
		$d_sppm = new DataSppm($this->registry);
		$filter = array ();
		$no=0;
			if (isset($_POST['submit_file'])) {
				if ($_POST['nosp2d']!=''){
					$filter[$no++]="CHECK_NUMBER = ".$_POST['nosp2d'];
					//var_dump ("CHECK_NUMBER = ".$_POST['nosp2d']);
				}
				if ($_POST['barsp2d']!=''){
					$filter[$no++]="CHECK_NUMBER_LINE_NUM = ".$_POST['barsp2d'];
				}
				if ($_POST['invoice']!=''){
					$filter[$no++]="INVOICE_NUM = ".$_POST['invoice'];
				}
				if ($_POST['bank']!=''){
					$filter[$no++]="BANK_ACCOUNT_NAME LIKE '%".$_POST['bank']."%'";
				}
				if ($_POST['tgl_awal']!='' AND $_POST['tgl_akhir']!=''){
					$filter[$no++]=date('Ymd',strtotime($_POST['tgl_awal']));
					$filter[$no++]=date('Ymd',strtotime($_POST['tgl_akhir']));
				}
				if ($_POST['fxml']!=''){
					$fxml = $_POST['fxml'];
					$filter[$no++]="UPPER(FTP_FILE_NAME) = '".strtoupper($fxml)."'";
				}
				$this->view->data = $d_sppm->get_sppm_filter($filter);
			}	
		
		//var_dump($d_sppm->get_sppm_filter($filter));
		$this->view->render('kppn/isianKppn');
	}
	
	public function harianBO() {
		$d_sppm = new DataSppm($this->registry);
		$filter = array ();
		$no=0;
			if (isset($_POST['submit_file'])) {
				if ($_POST['bank']!=''){
					$filter[$no++]="BANK_ACCOUNT_NAME LIKE '%".$_POST['bank']."%'";
				}
				if ($_POST['tgl_awal']!=''){
					$filter[$no++]="PAYMENT_DATE = TO_DATE(".date('Ymd',strtotime($_POST['tgl_awal'])).",'YYYYMMDD')";
				}
				$this->view->data = $d_sppm->get_harian_bo_i($filter);
			}	
		
		//var_dump($d_sppm->get_sppm_filter($filter));
		$this->view->render('kppn/harianBo');
	}
	
	public function sp2dHariIni() {
		$d_sppm = new DataSppm($this->registry);
		$filter = array ();
		$no=0;
			if (isset($_POST['submit_file'])) {
				if ($_POST['bank']!=''){
					$filter[$no++]="BANK_ACCOUNT_NAME LIKE '%".$_POST['bank']."%'";
				}
				$filter[$no++]="PAYMENT_DATE = TO_DATE('".date('Ymd')."','YYYYMMDD') 
								AND TO_CHAR(CREATION_DATE,'YYYYMMDD') = '".date('Ymd')."' ";
				$this->view->data = $d_sppm->get_sp2d_hari_ini($filter);
			}	
		
		//var_dump($d_sppm->get_sppm_filter($filter));
		$this->view->render('kppn/sp2dHariIni');
	}
	
	public function sp2dBesok() {
		$d_sppm = new DataSppm($this->registry);
		$filter = array ();
		$no=0;
			if (isset($_POST['submit_file'])) {
				if ($_POST['bank']!=''){
					$filter[$no++]="BANK_ACCOUNT_NAME LIKE '%".$_POST['bank']."%'";
				}
				$filter[$no++]="PAYMENT_DATE = TO_DATE('".date('Ymd')."','YYYYMMDD') 
								AND CREATION_DATE = TO_DATE('".date('Ymd')."1500','YYYYMMDDHH24MISS')";
								
				$this->view->data = $d_sppm->get_sp2d_besok($filter);
			}	
		
		//var_dump($d_sppm->get_sppm_filter($filter));
		$this->view->render('kppn/sp2dBesok');
	}
	
	public function sp2dBackdate() {
		$d_sppm = new DataSppm($this->registry);
		$filter = array ();
		$no=0;
			if (isset($_POST['submit_file'])) {
				if ($_POST['bank']!=''){
					$filter[$no++]="BANK_ACCOUNT_NAME LIKE '%".$_POST['bank']."%'";
				}
				if ($_POST['tgl_awal']!=''){
					$filter[$no++]="PAYMENT_DATE = TO_DATE(".date('Ymd',strtotime($_POST['tgl_awal'])).",'YYYYMMDD')";
				}
				$filter[$no++]="TO_CHAR(CREATION_DATE,'YYYYMMDD')  > TO_CHAR(CHECK_DATE,'YYYYMMDD')";
				$this->view->data = $d_sppm->get_sp2d_backdate($filter);
			}	
		
		//var_dump($d_sppm->get_sppm_filter($filter));
		$this->view->render('kppn/sp2dBackdate');
	}
	
	public function sp2dHarian() {
		$d_sppm = new DataSppm($this->registry);
		$filter = array ();
		$no=0;
			if (isset($_POST['submit_file'])) {
				if ($_POST['bank']!=''){
					$filter[$no++]="BANK_ACCOUNT_NAME LIKE '%".$_POST['bank']."%'";
				}
				if ($_POST['tgl_awal']!=''){
					$filter[$no++]="PAYMENT_DATE = TO_DATE(".date('Ymd',strtotime($_POST['tgl_awal'])).",'YYYYMMDD')";
				}
				$this->view->data = $d_sppm->get_sp2d_harian($filter);
			}	
		
		//var_dump($d_sppm->get_sppm_filter($filter));
		$this->view->render('kppn/sp2dHarian');
	}
	
	public function sp2dBelumVoid() {
		$d_sppm = new DataSppm($this->registry);
		$filter = array ();
		$no=0;
			if (isset($_POST['submit_file'])) {
				if ($_POST['bank']!=''){
					$filter[$no++]="BANK_ACCOUNT_NAME LIKE '%".$_POST['bank']."%'";
				}
				if ($_POST['tgl_awal']!=''){
					$filter[$no++]="PAYMENT_DATE = TO_DATE('".$_POST['tgl_awal']."','YYYYMMDD')";
				}
				$this->view->data = $d_sppm->get_sp2d_backdate($filter);
			}	
		
		//var_dump($d_sppm->get_sppm_filter($filter));
		$this->view->render('kppn/sp2dBelumVoid');
	}
	
	public function sp2dSudahVoid() {
		$d_sppm = new DataSppm($this->registry);
		$filter = array ();
		$no=0;
			if (isset($_POST['submit_file'])) {
				if ($_POST['bank']!=''){
					$filter[$no++]="BANK_ACCOUNT_NAME LIKE '%".$_POST['bank']."%'";
				}
				if ($_POST['tgl_awal']!=''){
					$filter[$no++]="PAYMENT_DATE = TO_DATE('".$_POST['tgl_awal']."','YYYYMMDD')";
				}
				$this->view->data = $d_sppm->get_sp2d_backdate($filter);
			}	
		
		//var_dump($d_sppm->get_sppm_filter($filter));
		$this->view->render('kppn/sp2dSudahVoid');
	}
	
    public function __destruct() {
        
    }

}
