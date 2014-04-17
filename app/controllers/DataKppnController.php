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
					$this->view->d_nosp2d = $_POST['nosp2d'];
				}
				if ($_POST['barsp2d']!=''){
					$filter[$no++]="CHECK_NUMBER_LINE_NUM = ".$_POST['barsp2d'];
					$this->view->d_barsp2d = $_POST['barsp2d'];
				}
				if ($_POST['kdsatker']!=''){
					$filter[$no++]="SUBSTR(INVOICE_NUM,8,6) = '".$_POST['kdsatker']."'";
					$this->view->d_kdsatker = $_POST['kdsatker'];
				}
				if ($_POST['invoice']!=''){
					$filter[$no++]="INVOICE_NUM = UPPER('".$_POST['invoice']."')";
					$this->view->d_invoice = $_POST['invoice'];
				}
				if ($_POST['bank']!=''){
					if ($_POST['bank']!=5){
						$filter[$no++]="BANK_ACCOUNT_NAME LIKE '%".$_POST['bank']."%'";
					$this->view->d_bank = $_POST['bank'];
					}
				}
				if ($_POST['tgl_awal']!='' AND $_POST['tgl_akhir']!=''){
					$filter[$no++] = "PAYMENT_DATE BETWEEN TO_DATE (".date('Ymd',strtotime($_POST['tgl_awal'])).",'YYYYMMDD') 
									AND TO_DATE (".date('Ymd',strtotime($_POST['tgl_akhir'])).",'YYYYMMDD')  ";
					
					$this->view->d_tgl_awal = $_POST['tgl_awal'];
					$this->view->d_tgl_akhir = $_POST['tgl_akhir'];
				}
				if ($_POST['fxml']!=''){
					$fxml = $_POST['fxml'];
					$filter[$no++]="UPPER(FTP_FILE_NAME) = '".strtoupper($fxml)."'";
					$this->view->d_fxml = $_POST['fxml'];
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
					if ($_POST['bank']!=5){
						$filter[$no++]="BANK_ACCOUNT_NAME LIKE '%".$_POST['bank']."%'";
					}
					$this->view->d_bank = $_POST['bank'];
				}
				if ($_POST['tgl_awal']!='' AND $_POST['tgl_akhir']!=''){
					$filter[$no++] = "PAYMENT_DATE BETWEEN TO_DATE (".date('Ymd',strtotime($_POST['tgl_awal'])).",'YYYYMMDD') 
									AND TO_DATE (".date('Ymd',strtotime($_POST['tgl_akhir'])).",'YYYYMMDD')  ";
					$this->view->d_tgl_awal = $_POST['tgl_awal'];
					$this->view->d_tgl_akhir = $_POST['tgl_akhir'];
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
					if ($_POST['bank']!=5){
						$filter[$no++]="BANK_ACCOUNT_NAME LIKE '%".$_POST['bank']."%'";
					}
					$this->view->d_bank = $_POST['bank'];
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
					if ($_POST['bank']!=5){
						$filter[$no++]="BANK_ACCOUNT_NAME LIKE '%".$_POST['bank']."%'";
					}
					$this->view->d_bank = $_POST['bank'];
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
					if ($_POST['bank']!=5){
						$filter[$no++]="BANK_ACCOUNT_NAME LIKE '%".$_POST['bank']."%'";
					}
					$this->view->d_bank = $_POST['bank'];
				}
				if ($_POST['tgl_awal']!=''){
					$filter[$no++] = "PAYMENT_DATE BETWEEN TO_DATE (".date('Ymd',strtotime($_POST['tgl_awal'])).",'YYYYMMDD') 
									AND TO_DATE (".date('Ymd',strtotime($_POST['tgl_akhir'])).",'YYYYMMDD')  ";
					$this->view->d_tgl_awal = $_POST['tgl_awal'];
					$this->view->d_tgl_akhir = $_POST['tgl_akhir'];
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
					if ($_POST['bank']!=5){
						$filter[$no++]="BANK_ACCOUNT_NAME LIKE '%".$_POST['bank']."%'";
					}
					$this->view->d_bank = $_POST['bank'];
				}
				if ($_POST['tgl_awal']!='' AND $_POST['tgl_akhir']!=''){
					$filter[$no++] = "PAYMENT_DATE BETWEEN TO_DATE (".date('Ymd',strtotime($_POST['tgl_awal'])).",'YYYYMMDD') 
									AND TO_DATE (".date('Ymd',strtotime($_POST['tgl_akhir'])).",'YYYYMMDD')  ";
					$this->view->d_tgl_awal = $_POST['tgl_awal'];
					$this->view->d_tgl_akhir = $_POST['tgl_akhir'];
				}
				$this->view->data = $d_sppm->get_sp2d_harian($filter);
			}	
		
		//var_dump($d_sppm->get_sppm_filter($filter));
		$this->view->render('kppn/sp2dHarian');
	}
	
	public function sp2dNilaiMinus() {
		$d_sppm = new DataSppm($this->registry);
		$filter = array ();
		$no=0;
			if (isset($_POST['submit_file'])) {
				if ($_POST['bank']!=''){
					if ($_POST['bank']!=5){
						$filter[$no++]="BANK_ACCOUNT_NAME LIKE '%".$_POST['bank']."%'";
					}
					$this->view->d_bank = $_POST['bank'];
				}
				if ($_POST['tgl_awal']!='' AND $_POST['tgl_akhir']!=''){
					$filter[$no++] = "PAYMENT_DATE BETWEEN TO_DATE (".date('Ymd',strtotime($_POST['tgl_awal'])).",'YYYYMMDD') 
									AND TO_DATE (".date('Ymd',strtotime($_POST['tgl_akhir'])).",'YYYYMMDD')  ";
					$this->view->d_tgl_awal = $_POST['tgl_awal'];
					$this->view->d_tgl_akhir = $_POST['tgl_akhir'];
				}
				$filter[$no++] = "CHECK_AMOUNT < 1";
				$this->view->data = $d_sppm->get_sp2d_backdate($filter);
			}	
		
		//var_dump($d_sppm->get_sppm_filter($filter));
		$this->view->render('kppn/sp2dNilaiMinus');
	}
	
	public function sp2dSudahVoid() {
		$d_sppm = new DataSppm($this->registry);
		$filter = array ();
		$no=0;
			if (isset($_POST['submit_file'])) {
				if ($_POST['bank']!=''){
					if ($_POST['bank']!=5){
						$filter[$no++]="BANK_ACCOUNT_NAME LIKE '%".$_POST['bank']."%'";
					}
					$this->view->d_bank = $_POST['bank'];
				}
				
				if ($_POST['tgl_awal']!='' AND $_POST['tgl_akhir']!=''){
					$filter[$no++] = "PAYMENT_DATE BETWEEN TO_DATE (".date('Ymd',strtotime($_POST['tgl_awal'])).",'YYYYMMDD') 
									AND TO_DATE (".date('Ymd',strtotime($_POST['tgl_akhir'])).",'YYYYMMDD')  ";
					$this->view->d_tgl_awal = $_POST['tgl_awal'];
					$this->view->d_tgl_akhir = $_POST['tgl_akhir'];
				}
				$this->view->data = $d_sppm->get_sp2d_sudah_void($filter);
			}	
		
		//var_dump($d_sppm->get_sppm_filter($filter));
		$this->view->render('kppn/sp2dSudahVoid');
	}
	
	public function sp2dGajiDobel() {
		$d_sppm = new DataSppm($this->registry);
		if (isset($_POST['submit_file'])) {
			if ($_POST['bulan']!=13){
					$bulan=$_POST['bulan'];
				}
			$this->view->d_bank = $_POST['bulan'];
			$this->view->data = $d_sppm->get_sp2d_gaji_dobel($bulan);
		}
		//var_dump($d_sppm->get_sppm_filter($filter));
		$this->view->render('kppn/sp2dGajiDobel');
	}
	
	public function sp2dSalahTanggal() {
		$d_sppm = new DataSppm($this->registry);
		$this->view->data = $d_sppm->get_sp2d_gaji_tanggal();
		//var_dump($d_sppm->get_sppm_filter($filter));
		$this->view->render('kppn/sp2dGajiTanggal');
	}
	
	public function sp2dSalahBank() {
		$d_sppm = new DataSppm($this->registry);
		$this->view->data = $d_sppm->get_sp2d_gaji_bank();
		//var_dump($d_sppm->get_sppm_filter($filter));
		$this->view->render('kppn/sp2dGajiBank');
	}
	
	public function sp2dSalahRekening() {
		$d_sppm = new DataSppm($this->registry);
		$this->view->data = $d_sppm->get_sp2d_gaji_rekening();
		//var_dump($d_sppm->get_sppm_filter($filter));
		$this->view->render('kppn/sp2dGajiRekening');
	}
	
	public function sp2dCompareGaji() {
		$d_sppm = new DataSppm($this->registry);
		$this->view->data = $d_sppm->get_sp2d_gaji_bulan_lalu();
		//var_dump($d_sppm->get_sppm_filter($filter));
		$this->view->render('kppn/sp2dGajiBulanLalu');
	}
	
    public function __destruct() {
        
    }

}
