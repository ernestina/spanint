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
	
	public function monitoringSp2d() {
		$d_sppm = new DataSppm($this->registry);
		$filter = array ();
		$no=0;
			if (isset($_POST['submit_file'])) {
				if ($_POST['kdkppn']!=''){
					$filter[$no++]="KDKPPN = ".$_POST['kdkppn'];
					$d_kppn = new DataUser($this->registry);
					$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
				} else {
					$filter[$no++]="KDKPPN = ".Session::get('id_user');
				}
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
					if ($_POST['bank']!='SEMUA_BANK'){
						$filter[$no++]="BANK_ACCOUNT_NAME LIKE '%".$_POST['bank']."%'";
					}
					$this->view->d_bank = $_POST['bank'];
				}
				if ($_POST['status'] != ''){
					if ($_POST['status'] == 'SUKSES' ){
						$filter[$no++] = "RETURN_CODE = '0000'";
					} elseif ($_POST['status'] == 'TIDAK' ) {
						$filter[$no++] = "RETURN_CODE != '0000'";
					}
					$this->view->d_status = $_POST['status'];
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
			if (Session::get('role')==ADMIN){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
			}
			if (Session::get('role')==KANWIL){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
			}
		
		//var_dump($d_sppm->get_sppm_filter($filter));
		$this->view->render('kppn/isianKppn');
	}
	
	public function harianBO() {
		$d_sppm = new DataSppm($this->registry);
		$filter = array ();
		$no=0;
			if (isset($_POST['submit_file'])) {
				if ($_POST['kdkppn']!=''){
					$filter[$no++]="KDKPPN = ".$_POST['kdkppn'];
					$d_kppn = new DataUser($this->registry);
					$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
				} else {
					$filter[$no++]="KDKPPN = ".Session::get('id_user');
				}
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
			if (Session::get('role')==ADMIN){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
			}	
			if (Session::get('role')==KANWIL){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
			}
		
		//var_dump($d_sppm->get_sppm_filter($filter));
		$this->view->render('kppn/harianBo');
	}
	
	public function sp2dHariIni() {
		$d_sppm = new DataSppm($this->registry);
		$filter = array ();
		$no=0;
			if (isset($_POST['submit_file'])) {
				if ($_POST['kdkppn']!=''){
					$filter[$no++]="KDKPPN = ".$_POST['kdkppn'];
					$d_kppn = new DataUser($this->registry);
					$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
				} else {
					$filter[$no++]="KDKPPN = ".Session::get('id_user');
				}
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
				$filter[$no++]=" TO_CHAR(PAYMENT_DATE,'YYYYMMDD') = TO_CHAR(CREATION_DATE,'YYYYMMDD') ";
				$this->view->data = $d_sppm->get_sp2d_hari_ini($filter);
			}	
			if (Session::get('role')==ADMIN){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
			}	
			if (Session::get('role')==KANWIL){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
			}	
		
		//var_dump($d_sppm->get_sppm_filter($filter));
		$this->view->render('kppn/sp2dHariIni');
	}
	
	public function sp2dBesok() {
		$d_sppm = new DataSppm($this->registry);
		$filter = array ();
		$no=0;
			if (isset($_POST['submit_file'])) {
				if ($_POST['kdkppn']!=''){
					$filter[$no++]="KDKPPN = ".$_POST['kdkppn'];
					$d_kppn = new DataUser($this->registry);
					$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
				} else {
					$filter[$no++]="KDKPPN = ".Session::get('id_user');
				}
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
				$filter[$no++]="( TO_CHAR(PAYMENT_DATE,'YYYYMMDD') = TO_CHAR(CREATION_DATE,'YYYYMMDD') 
								AND TO_CHAR(CREATION_DATE,'HH24MISS') > '150000' )";
								
				$this->view->data = $d_sppm->get_sp2d_besok($filter);
			}
			if (Session::get('role')==ADMIN){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
			}	
			if (Session::get('role')==KANWIL){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
			}		
		
		//var_dump($d_sppm->get_sppm_filter($filter));
		$this->view->render('kppn/sp2dBesok');
	}
	
	public function sp2dBackdate() {
		$d_sppm = new DataSppm($this->registry);
		$filter = array ();
		$no=0;
			if (isset($_POST['submit_file'])) {
				if ($_POST['kdkppn']!=''){
					$filter[$no++]="KDKPPN = ".$_POST['kdkppn'];
					$d_kppn = new DataUser($this->registry);
					$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
				} else {
					$filter[$no++]="KDKPPN = ".Session::get('id_user');
				}
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
			if (Session::get('role')==ADMIN){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
			}	
			if (Session::get('role')==KANWIL){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
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
				if ($_POST['kdkppn']!=''){
					$filter[$no++]="KDKPPN = ".$_POST['kdkppn'];
					$d_kppn = new DataUser($this->registry);
					$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
				} else {
					$filter[$no++]="KDKPPN = ".Session::get('id_user');
				}
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
				$this->view->data = $d_sppm->get_sp2d_minus($filter);
			}
			if (Session::get('role')==ADMIN){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
			}	
			if (Session::get('role')==KANWIL){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
			}		
		
		//var_dump($d_sppm->get_sppm_filter($filter));
		$this->view->render('kppn/sp2dNilaiMinus');
	}
	
	public function sp2dSudahVoid() {
		$d_sppm = new DataSppm($this->registry);
		$filter = array ();
		$no=0;
			if (isset($_POST['submit_file'])) {
				if ($_POST['kdkppn']!=''){
					$filter[$no++]="KDKPPN = ".$_POST['kdkppn'];
					$d_kppn = new DataUser($this->registry);
					$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
				} else {
					$filter[$no++]="KDKPPN = ".Session::get('id_user');
				}
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
			if (Session::get('role')==ADMIN){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
			}	
			if (Session::get('role')==KANWIL){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
			}
		
		//var_dump($d_sppm->get_sppm_filter($filter));
		$this->view->render('kppn/sp2dSudahVoid');
	}
	
	public function sp2dGajiDobel() {
		$d_sppm = new DataSppm($this->registry);
		if (isset($_POST['submit_file'])) {
			if ($_POST['kdkppn']!=''){
				$kppn="KDKPPN = '".$_POST['kdkppn']."'";
				$d_kppn = new DataUser($this->registry);
				$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
			} else {
				$kppn="KDKPPN = '".Session::get('id_user')."'";
			}
			if ($_POST['bulan']!=13){
				$bulan=$_POST['bulan'];
			}
			$this->view->d_bank = $_POST['bulan'];
			$this->view->data = $d_sppm->get_sp2d_gaji_dobel($bulan,$kppn);
		}
		if (Session::get('role')==ADMIN){
			$d_kppn_list = new DataUser($this->registry);
			$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
		}	
		if (Session::get('role')==KANWIL){
			$d_kppn_list = new DataUser($this->registry);
			$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
		}
		//var_dump($d_sppm->get_sppm_filter($filter));
		$this->view->render('kppn/sp2dGajiDobel');
	}
	
	public function sp2dSalahTanggal() {
		$d_sppm = new DataSppm($this->registry);
		if (Session::get('role')==ADMIN){
			if (isset($_POST['submit_file'])) {
				if ($_POST['kdkppn']!=''){
					$kppn=" AND KDKPPN = '".$_POST['kdkppn']."'";
					$d_kppn = new DataUser($this->registry);
					$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
				}
				$this->view->data = $d_sppm->get_sp2d_gaji_tanggal($kppn);
			}
			$d_kppn_list = new DataUser($this->registry);
			$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
		}	
		if (Session::get('role')==KANWIL){
			if (isset($_POST['submit_file'])) {
				if ($_POST['kdkppn']!=''){
					$kppn=" AND KDKPPN = '".$_POST['kdkppn']."'";
					$d_kppn = new DataUser($this->registry);
					$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
				}
				$this->view->data = $d_sppm->get_sp2d_gaji_tanggal($kppn);
			}
			$d_kppn_list = new DataUser($this->registry);
			$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
		}
		if (session::get('role')==KPPN){
			$kppn=" AND KDKPPN = '".Session::get('id_user')."'";
			$this->view->data = $d_sppm->get_sp2d_gaji_tanggal($kppn);
		}
		//var_dump($d_sppm->get_sppm_filter($filter));
		$this->view->render('kppn/sp2dGajiTanggal');
	}
	
	public function sp2dSalahBank() {
		$d_sppm = new DataSppm($this->registry);
		if (Session::get('role')==ADMIN){
			if (isset($_POST['submit_file'])) {
				if ($_POST['kdkppn']!=''){
					$kppn=" AND KDKPPN = '".$_POST['kdkppn']."'";
					$d_kppn = new DataUser($this->registry);
					$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
				}
				$this->view->data = $d_sppm->get_sp2d_gaji_bank($kppn);
			}
			$d_kppn_list = new DataUser($this->registry);
			$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
		}	
		if (Session::get('role')==KANWIL){
			if (isset($_POST['submit_file'])) {
				if ($_POST['kdkppn']!=''){
					$kppn=" AND KDKPPN = '".$_POST['kdkppn']."'";
					$d_kppn = new DataUser($this->registry);
					$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
				}
				$this->view->data = $d_sppm->get_sp2d_gaji_bank($kppn);
			}
			$d_kppn_list = new DataUser($this->registry);
			$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
		}
		if (session::get('role')==KPPN){
			$kppn=" AND KDKPPN = '".Session::get('id_user')."'";
			$this->view->data = $d_sppm->get_sp2d_gaji_bank($kppn);
		}
		//var_dump($d_sppm->get_sppm_filter($filter));
		$this->view->render('kppn/sp2dGajiBank');
	}
	
	public function sp2dSalahRekening() {
		$d_sppm = new DataSppm($this->registry);
		if (Session::get('role')==ADMIN){
			if (isset($_POST['submit_file'])) {
				if ($_POST['kdkppn']!=''){
					$kppn=" AND KDKPPN = '".$_POST['kdkppn']."'";
					$d_kppn = new DataUser($this->registry);
					$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
				}
				$this->view->data = $d_sppm->get_sp2d_gaji_rekening($kppn);
			}
			$d_kppn_list = new DataUser($this->registry);
			$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
		}	
		if (Session::get('role')==KANWIL){
			if (isset($_POST['submit_file'])) {
				if ($_POST['kdkppn']!=''){
					$kppn=" AND KDKPPN = '".$_POST['kdkppn']."'";
					$d_kppn = new DataUser($this->registry);
					$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
				}
				$this->view->data = $d_sppm->get_sp2d_gaji_rekening($kppn);
			}
			$d_kppn_list = new DataUser($this->registry);
			$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
		}
		if (session::get('role')==KPPN){
			$kppn=" AND KDKPPN = '".Session::get('id_user')."'";
			$this->view->data = $d_sppm->get_sp2d_gaji_rekening($kppn);
		}
		//var_dump($d_sppm->get_sppm_filter($filter));
		$this->view->render('kppn/sp2dGajiRekening');
	}
	
	public function sp2dCompareGaji() {
		$d_sppm = new DataSppm($this->registry);
		if (Session::get('role')==ADMIN){
			if (isset($_POST['submit_file'])) {
				if ($_POST['kdkppn']!=''){
					$kppn=" AND KDKPPN = '".$_POST['kdkppn']."'";
					$d_kppn = new DataUser($this->registry);
					$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
				}
				$this->view->data = $d_sppm->get_sp2d_gaji_bulan_lalu($kppn);
			}
			$d_kppn_list = new DataUser($this->registry);
			$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
		}	
		if (Session::get('role')==KANWIL){
			if (isset($_POST['submit_file'])) {
				if ($_POST['kdkppn']!=''){
					$kppn=" AND KDKPPN = '".$_POST['kdkppn']."'";
					$d_kppn = new DataUser($this->registry);
					$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
				}
				$this->view->data = $d_sppm->get_sp2d_gaji_bulan_lalu($kppn);
			}
			$d_kppn_list = new DataUser($this->registry);
			$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
		}
		if (session::get('role')==KPPN){
			$kppn=" AND KDKPPN = '".Session::get('id_user')."'";
			$this->view->data = $d_sppm->get_sp2d_gaji_bulan_lalu($kppn);
		}
		//var_dump($d_sppm->get_sppm_filter($filter));
		$this->view->render('kppn/sp2dGajiBulanLalu');
	}
	
	public function sp2dRekap() {
		$d_sppm = new DataSppm($this->registry);
		if (isset($_POST['submit_file'])) {
			if ($_POST['kdkppn']!=''){
				$filter[$no++]=" KDKPPN = ".$_POST['kdkppn'];
				$d_kppn = new DataUser($this->registry);
				$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
			} else {
				$filter[$no++]=" KDKPPN = ".Session::get('id_user');
			}
			if ($_POST['tgl_awal']!='' AND $_POST['tgl_akhir']!=''){
				$filter[$no++] = "PAYMENT_DATE BETWEEN TO_DATE ('".date('Ymd',strtotime($_POST['tgl_awal']))."','YYYYMMDD') 
									AND TO_DATE ('".date('Ymd',strtotime($_POST['tgl_akhir']))."','YYYYMMDD')  ";
				$this->view->d_tgl_awal = $_POST['tgl_awal'];
				$this->view->d_tgl_akhir = $_POST['tgl_akhir'];
			}
			$this->view->data = $d_sppm->get_sp2d_rekap($filter);
		}
		if (Session::get('role')==ADMIN){
			$d_kppn_list = new DataUser($this->registry);
			$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
		}	
		if (Session::get('role')==KANWIL){
			$d_kppn_list = new DataUser($this->registry);
			$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
		}
		//var_dump($d_sppm->get_sp2d_rekap($filter));
		$this->view->render('kppn/sp2dRekap');
	}
	
	public function detailSp2dGaji($bank=null,$bulan=null,$kdkppn=null) {
		$d_sppm = new DataSppm($this->registry);
		$filter = array ();
		if ($bank=='BNI'){
			$bank1 = 'gaji-BNI';
		} else if ($bank == 'BRI') {
			$bank1 = 'GAJI BRI';
		} else if ($bank == 'BTN') {
			$bank1 = 'GAJI-BTN';
		} else if ($bank == 'MANDIRI') {
			$bank1 = 'GAJI-MDRI';
		}
		if (!is_null($bank)){
			$filter[$no++]="BANK_ACCOUNT_NAME LIKE '%".$bank1."%'";
			$this->view->d_bank = $bank;
		} 
		if (!is_null($bulan)){
			if ($bulan!='all'){
				$filter[$no++]="to_char(PAYMENT_DATE,'mm') = '".$bulan."'";
				$this->view->d_bulan = $bulan;
			}
		} 
		if (!is_null($kdkppn)){
			$filter[$no++]=" KDKPPN = '".$kdkppn."'";
				$d_kppn = new DataUser($this->registry);
				$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
		} else {
			$filter[$no++]=" KDKPPN = ".Session::get('id_user');
		}
		$this->view->data = $d_sppm->get_detail_sp2d_gaji($filter);
		//var_dump($d_sppm->get_sppm_filter($filter));
		$this->view->render('kppn/detailSp2dGaji');
	}
	
	public function detailRekapSP2D($bank=null,$jendok=null,$tgl_awal=null,$tgl_akhir=null,$kdkppn=null) {
		$d_sppm = new DataSppm($this->registry);
		$filter = array ();
		if ($bank=='BNI'){
			$bank1 = 'BNI';
		} else if ($bank == 'BRI') {
			$bank1 = 'BRI';
		} else if ($bank == 'BTN') {
			$bank1 = 'BTN';
		} else if ($bank == 'MANDIRI') {
			$bank1 = 'MDRI';
		}
		if (!is_null($bank)){
			$filter[$no++] = "BANK_ACCOUNT_NAME LIKE '".$bank1."'";
			$this->view->d_bank = $bank;
		} 
		if (!is_null($jendok)){
			$filter[$no++] = "JENDOK = '".$jendok."'";
			$this->view->d_jendok = $jendok;
		}
		if ((!is_null($tgl_awal)) AND (!is_null($tgl_akhir))){
			$filter[$no++] = "PAYMENT_DATE BETWEEN TO_DATE ('".date('Ymd',strtotime($tgl_awal))."','YYYYMMDD') 
									AND TO_DATE ('".date('Ymd',strtotime($tgl_akhir))."','YYYYMMDD')  ";
			$this->view->d_tgl_awal = $tgl_awal;
			$this->view->d_tgl_akhir = $tgl_akhir;
		}
		if (!is_null($kdkppn)){
			$filter[$no++]=" KDKPPN = '".$kdkppn."'";
			$d_kppn = new DataUser($this->registry);
			$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
		} else {
			$filter[$no++]=" KDKPPN = ".Session::get('id_user');
		}
		$this->view->data = $d_sppm->get_detail_sp2d_rekap($filter);
		//var_dump($d_sppm->get_sppm_filter($filter));
		$this->view->render('kppn/detailSp2dRekap');
	}
	
	public function lihatPanduan1() {
        $this->view->render('kppn/panduan1');
    }
	
    public function __destruct() {
        
    }

}
