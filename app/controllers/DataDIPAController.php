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
					$this->view->satker_code = $kdsatker;
				}
			if (isset($_POST['submit_file'])) {
				
				if ($_POST['akun']!=''){
					$filter[$no++]="A.ACCOUNT_CODE = '".$_POST['akun']."'";
					$this->view->account_code = $_POST['akun'];
				}
				if ($_POST['output']!=''){
					$filter[$no++]="A.OUTPUT_CODE = '".$_POST['output']."'";
					$this->view->output_code = $_POST['output'];
				}
				if ($_POST['program']!=''){
					$filter[$no++]="A.PROGRAM_CODE = '".$_POST['program']."'";
					$this->view->program_code = $_POST['program'];
				}
				if ($_POST['tgl_awal']!='' AND $_POST['tgl_akhir']!=''){
					$filter[$no++] = "A.TANGGAL_POSTING_REVISI BETWEEN '".$_POST['tgl_awal']."' AND '".$_POST['tgl_akhir']."'";
					$this->view->d_tgl_awal = $_POST['tgl_awal'];
					$this->view->d_tgl_akhir = $_POST['tgl_akhir'];
				}
				
			}	
			
		
		$d_last_update = new DataLastUpdate($this->registry);
		$this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());
		
		$this->view->data = $d_spm1->get_dipa_filter($filter);
		$this->view->render('kppn/revisiDIPA');
	}
			//----------------------------------------------------
			//Development history
			//Revisi : 0
			//Kegiatan :1.mencetak hasil filter ke dalam pdf
			//File yang diubah : DataDIPAController.php
			//Dibuat oleh : Rifan Abdul Rachman
			//Tanggal dibuat : 18-07-2014
			//----------------------------------------------------

	public function RevisiDipa_PDF($kdsatker=null,$kdakun=null,$kdoutput=null,$kdprogram=null,$kdtgl_awal=null,$kdtgl_akhir=null) {
	
		$d_spm1 = new DataDIPA($this->registry);
		$filter = array ();
		$no=0;
			if ($kdsatker != 'null') {
				$filter[$no++]=" A.SATKER_CODE =  '".$kdsatker."'";
			}						
			if ($kdakun !='null'){
				$filter[$no++]=" A.ACCOUNT_CODE = '".$kdakun."'";
			}
			if ($kdoutput !='null'){
				$filter[$no++]=" A.OUTPUT_CODE = '".$kdoutput."'";
			}
			if ($kdprogram !='null'){
				$filter[$no++]=" A.PROGRAM_CODE = '".$kdprogram."'";
			}
			if ($kdtgl_awal !='null' OR $kdtgl_akhir !='null'){
				list($bln,$tgl,$thn)=explode('-',$kdtgl_awal);
				$kdtgl_awal=$bln."/".$tgl."/".$thn;
				
				list($bln,$tgl,$thn)=explode('-',$kdtgl_akhir);				
				$kdtgl_akhir=$bln."/".$tgl."/".$thn;			
				$filter[$no++] = " A.TANGGAL_POSTING_REVISI BETWEEN '".$kdtgl_awal."' AND '".$kdtgl_akhir."'";
			}
		$d_last_update = new DataLastUpdate($this->registry);
		$this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());
		
		$this->view->data = $d_spm1->get_dipa_filter($filter);
		$this->view->load('kppn/revisiDIPA_PDF');
	}
			//----------------------------------------------------
	
	public function Fund_fail() {
		$d_spm1 = new DataFundFail($this->registry);
		$filter = array ();
		$no=0;
			if (isset($_POST['submit_file'])) {
			
				if ($_POST['kdkppn']!=''){
					$filter[$no++]="KPPN_CODE = '".$_POST['kdkppn']."'";
					$d_kppn = new DataUser($this->registry);
					$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
				} else {
					$filter[$no++]="KPPN_CODE = '".Session::get('id_user')."'";
				}
				
				if ($_POST['kd_satker']!=''){
					$filter[$no++]="KDSATKER = '".$_POST['kd_satker']."'";
					$this->view->satker_code = $_POST['kd_satker'];
				}
				/*if ($_POST['akun']!=''){
					$filter[$no++]="A.ACCOUNT_CODE = '".$_POST['akun']."'";
					$this->view->account_code = $_POST['akun'];
				}
				if ($_POST['output']!=''){
					$filter[$no++]="A.OUTPUT_CODE = '".$_POST['output']."'";
					$this->view->output_code = $_POST['output'];
				}
				if ($_POST['program']!=''){
					$filter[$no++]="A.PROGRAM_CODE = '".$_POST['program']."'";
					$this->view->program_code = $_POST['program'];
				}
				if ($_POST['tgl_awal']!='' AND $_POST['tgl_akhir']!=''){
					$filter[$no++] = "A.TANGGAL_POSTING_REVISI BETWEEN '".$_POST['tgl_awal']."' AND '".$_POST['tgl_akhir']."'";
					$this->view->d_tgl_awal = $_POST['tgl_awal'];
					$this->view->d_tgl_akhir = $_POST['tgl_akhir'];
				}*/
				$this->view->data = $d_spm1->get_fun_fail_filter($filter);
			}	
			if (Session::get('role')==KANWIL){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
			}
			if (Session::get('role')==ADMIN || Session::get('role')==DJA){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
				$this->view->data = $d_spm1->get_fun_fail_filter($filter);
			}
			if (Session::get('role')==KPPN) {$filter[$no++]="KPPN_CODE = '".Session::get('id_user')."'";	
			$this->view->data = $d_spm1->get_fun_fail_filter($filter);
			}
	
		$this->view->render('kppn/fund_fail');
	}
				//----------------------------------------------------
			//Development history
			//Revisi : 0
			//Kegiatan :1.mencetak hasil filter ke dalam pdf
			//File yang diubah : DataDIPAController.php
			//Dibuat oleh : Rifan Abdul Rachman
			//Tanggal dibuat : 18-07-2014
			//----------------------------------------------------

	public function Fund_fail_PDF() {
		$d_spm1 = new DataFundFail($this->registry);
		$filter = array ();
		$no=0;
			
				if ($kdkppn!=''){
					$filter[$no++]="KPPN_CODE = '".$kdkppn."'";
				} else {
					$filter[$no++]="KPPN_CODE = '".Session::get('id_user')."'";
				}
				if ($kdsatker!=''){
					$filter[$no++]="KDSATKER = '".$kdsatker."'";
				}
				$this->view->data = $d_spm1->get_fun_fail_filter($filter);				
				$this->view->load('kppn/fund_fail_PDF');
	}
	
	public function Detail_Fund_fail($kdsatker = null) {
		$d_spm1 = new DataFundFail($this->registry);
		$filter = array ();
		$no=0;
			if ($kdsatker != '') {
					$filter[$no++]=" KDSATKER =  '".$kdsatker."'";
				}
			if (isset($_POST['submit_file'])) {
				
				if ($_POST['kd_satker']!=''){
					$filter[$no++]="KDSATKER = '".$_POST['kd_satker']."'";
					$this->view->satker_code = $_POST['satker_code'];
				}
				/*if ($_POST['akun']!=''){
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
				}*/
				
			}	
			if (Session::get('role')==KANWIL){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
			}
			if (Session::get('role')==ADMIN || Session::get('role')==DJA){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
			}
			if (Session::get('role')==KPPN) {$filter[$no++]="KDKPPN = '".Session::get('id_user')."'";	
			
			}

		$this->view->data = $d_spm1->get_detail_fun_fail_filter($filter);
		$this->view->render('kppn/detail_fund_fail');
	}
	
	public function RealisasiFA($kdsatker=null) {
		$d_spm1 = new DataFA($this->registry);
		$filter = array ();
		$no=0;
		if ($kdsatker != '') {
					$filter[$no++]=" A.SATKER =  '".$kdsatker."'";
				}
		if (Session::get('role')==KPPN) {
					$filter[$no++]="A.KPPN = '".Session::get('id_user')."'";			
			}		
			if (isset($_POST['submit_file'])) {
				
				if ($_POST['kdsatker']!=''){
					$filter[$no++]="A.SATKER = '".$_POST['kdsatker']."'";
					$this->view->satker_code = $_POST['kdsatker'];
				}
				if ($_POST['akun']!=''){
					$filter[$no++]="A.AKUN = '".$_POST['akun']."'";
					$this->view->account_code = $_POST['akun'];
				}
				if ($_POST['output']!=''){
					$filter[$no++]="A.OUTPUT = '".$_POST['output']."'";
					$this->view->output_code = $_POST['output'];
				}
				if ($_POST['program']!=''){
					$filter[$no++]="A.PROGRAM = '".$_POST['program']."'";
					$this->view->program_code = $_POST['program'];
				}
				if ($_POST['tgl_awal']!='' AND $_POST['tgl_akhir']!=''){
					$filter[$no++] = "A.TANGGAL_POSTING_REVISI BETWEEN '".$_POST['tgl_awal']."' AND '".$_POST['tgl_akhir']."'";
					$this->view->d_tgl_awal = $_POST['tgl_awal'];
					$this->view->d_tgl_akhir = $_POST['tgl_akhir'];
				}
				
			}	
			
		$d_last_update = new DataLastUpdate($this->registry);
		$this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());
		
		$this->view->data = $d_spm1->get_fa_filter($filter);
		$this->view->render('kppn/realisasiFA');
	}
			//----------------------------------------------------
			//Development history
			//Revisi : 0
			//Kegiatan :1.mencetak hasil filter ke dalam pdf
			//File yang diubah : DataDIPAController.php
			//Dibuat oleh : Rifan Abdul Rachman
			//Tanggal dibuat : 18-07-2014
			//----------------------------------------------------


		public function RealisasiFA_PDF($kdsatker=null,$kdakun=null,$kdprogram=null,$kdoutput=null) {
		$d_spm1 = new DataFA($this->registry);
		$filter = array ();
		$no=0;
		if ($kdsatker != '') {
					$filter[$no++]=" A.SATKER =  '".$kdsatker."'";
				}
		if (Session::get('role')==KPPN) {
					$filter[$no++]="A.KPPN = '".Session::get('id_user')."'";			
			}		


		if ($kdakun!='null'){
			$filter[$no++]=" A.AKUN = '".$kdakun."'";
		}
		if ($kdprogram!='null'){
			$filter[$no++]=" A.PROGRAM = '".$kdprogram."'";
		}
		if ($kdoutput!='null'){
			$filter[$no++]=" A.OUTPUT = '".$kdoutput."'";
		}
			
		$d_last_update = new DataLastUpdate($this->registry);
		$this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());
		
		$this->view->data = $d_spm1->get_fa_filter($filter);
		$this->view->load('kppn/realisasiFA_PDF');
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
				} 
				
				if ($_POST['kdsatker']!=''){
					$filter[$no++]="TS.KDSATKER = '".$_POST['kdsatker']."'";
					$this->view->d_invoice = $_POST['kdsatker'];
				}
				if ($_POST['nmsatker']!=''){
					$filter[$no++]=" UPPER(TS.NMSATKER) LIKE UPPER('%".$_POST['nmsatker']."%')";
					$this->view->d_invoice = $_POST['nmsatker'];
				}
				if ($_POST['revisi']!=''){
					$filter[$no++]="(SELECT MAX(A.REVISION_NO) FROM SPSA_BT_DIPA_V) ".$_POST['revisi'];
					$this->view->d_invoice = $_POST['revisi'];
				}
			$this->view->data = $d_spm1->get_satker_dipa_filter($filter);
			}
			elseif (Session::get('role')==ADMIN){
				$filter[$no++]="(SELECT MAX(A.REVISION_NO) FROM SPSA_BT_DIPA_V) > '0'";
				$this->view->data = $d_spm1->get_satker_dipa_filter($filter);
			}
			
			if (Session::get('role')==KANWIL){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
			}
			if (Session::get('role')==ADMIN || Session::get('role')==DJA){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
				$this->view->data = $d_spm1->get_satker_dipa_filter($filter);	
			}
			if (Session::get('role')==KPPN) {$filter[$no++]="TS.KPPN = '".Session::get('id_user')."'";	
			$this->view->data = $d_spm1->get_satker_dipa_filter($filter);	
			}
					
		if( Session::get('role')==ADMIN ){$this->view->render('kppn/NamaSatkerDIPA1');
		}
		else {$this->view->render('kppn/NamaSatkerDIPAkppn');
		}
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
				
			$this->view->data = $d_spm1->get_satker_dipa_filter($filter);
			}
			if (Session::get('role')==KANWIL){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
			}
			if (Session::get('role')==ADMIN|| Session::get('role')==DJA){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
			}
			if (Session::get('role')==KPPN) {$filter[$no++]="TS.KPPN = '".Session::get('id_user')."'";	
			$this->view->data = $d_spm1->get_satker_dipa_filter($filter);	
			}
					
		
		$this->view->render('kppn/NamaSatkerDIPA2');
	}
	
	public function DetailRealisasiFA($code_id=null) {
		$d_spm1 = new DataRealisasiFA($this->registry);
		$filter = array ();
		$no=0;
			if ($code_id != '') {
					$filter[$no++]=" DIST_CODE_COMBINATION_ID =  '".$code_id."'";
				}
		$this->view->data = $d_spm1->get_realisasi_fa_filter($filter);
		$this->view->render('kppn/DetailRealisasiFA');
	}
	public function DataRealisasi() {
		$d_spm1 = new DataRealisasi($this->registry);
		$filter = array ();
		$no=0;
			if (isset($_POST['submit_file'])) {
				if ($_POST['kdkppn']!=''){
					$filter[$no++]="A.KPPN = '".$_POST['kdkppn']."'";
					$d_kppn = new DataUser($this->registry);
					$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
				} else {
					$filter[$no++]="A.KPPN = '".Session::get('id_user')."'";
				}
				
				if ($_POST['kdsatker']!=''){
					$filter[$no++]="A.SATKER = '".$_POST['kdsatker']."'";
					$this->view->satker_code = $_POST['kdsatker'];
				}
			$this->view->data = $d_spm1->get_realisasi_fa_global_filter($filter);
			
			}
			if (Session::get('role')==KANWIL){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
			}
			if (Session::get('role')==ADMIN || Session::get('role')==DJA){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
			}
		
			if (Session::get('role')==KPPN) {$filter[$no++]="A.KPPN = '".Session::get('id_user')."'";
			$this->view->data = $d_spm1->get_realisasi_fa_global_filter($filter);
			}
			
			$d_last_update = new DataLastUpdate($this->registry);
		$this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());
		$this->view->render('kppn/DataRealisasi');
	}
			//----------------------------------------------------
			//Development history
			//Revisi : 0
			//Kegiatan :1.mencetak hasil filter ke dalam pdf
			//File yang diubah : DataDIPAController.php
			//Dibuat oleh : Rifan Abdul Rachman
			//Tanggal dibuat : 18-07-2014
			//----------------------------------------------------

	public function DataRealisasi_PDF($kd_satker=null) {
		$d_spm1 = new DataRealisasi($this->registry);
		$filter = array ();
		$no=0;
			if ($kd_satker!='null'){
				$filter[$no++]="A.SATKER= '".$kd_satker."'";
			}
			$this->view->data = $d_spm1->get_realisasi_fa_global_filter($filter);

			
			$d_last_update = new DataLastUpdate($this->registry);
		$this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());
			$this->view->load('kppn/DataRealisasi_PDF');
	}
			//----------------------------------------------------
	

	public function DataRealisasiBA() {
		$d_spm1 = new DataRealisasi($this->registry);
		$filter = array ();
		$no=0;
			if (isset($_POST['submit_file'])) {
				if ($_POST['kdkppn']!=''){
					
					$filter[$no++]="KPPN = '".$_POST['kdkppn']."'";
					$d_kppn = new DataUser($this->registry);
					$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
				} 
				elseif (Session::get('role')==KANWIL) {
					$filter[$no++]="KANWIL = '".Session::get('id_user')."'";
				}
				
				if ($_POST['kdlokasi']!=''){
					$filter[$no++]="a.lokasi = '".$_POST['kdlokasi']."'";
					$this->view->lokasi = $_POST['kdlokasi'];
				}
			$this->view->data = $d_spm1->get_realisasi_fa_global_ba_filter($filter);
			}
			if (Session::get('role')==KANWIL){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
			}
			if (Session::get('role')==ADMIN || Session::get('role')==DJA){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
			}
		
			if (Session::get('role')==KPPN) {$filter[$no++]="KPPN = '".Session::get('id_user')."'";
			$this->view->data = $d_spm1->get_realisasi_fa_global_ba_filter($filter);
			
			
			}
			
		$d_last_update = new DataLastUpdate($this->registry);
		$this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());
		$this->view->render('kppn/DataRealisasiBA');
	}
	//----------------------------------------------------
			//----------------------------------------------------
			//Development history
			//Revisi : 0
			//Kegiatan :1.mencetak hasil filter ke dalam pdf
			//File yang diubah : DataDIPAController.php
			//Dibuat oleh : Rifan Abdul Rachman
			//Tanggal dibuat : 18-07-2014
			//----------------------------------------------------

	public function DataRealisasiBA_PDF($kdkppn=null) {
		$d_spm1 = new DataRealisasi($this->registry);
		$filter = array ();
		$no=0;
		if ($kdkppn!='null'){
			$filter[$no++]="KPPN= '".$kdkppn."'";
		}
		
		$this->view->data = $d_spm1->get_realisasi_fa_global_ba_filter($filter);
			
		if (Session::get('role')==KPPN) {$filter[$no++]="KPPN = '".Session::get('id_user')."'";
		$this->view->data = $d_spm1->get_realisasi_fa_global_ba_filter($filter);
		
		}
			
		$d_last_update = new DataLastUpdate($this->registry);
		$this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());
		$this->view->load('kppn/DataRealisasiBA_PDF');
	}
//----------------------------------------------------
	public function DataRealisasiLokasi() {
		$d_spm1 = new DataRealisasi($this->registry);
		$filter = array ();
		$no=0;
			if (isset($_POST['submit_file'])) {
				if ($_POST['kdkppn']!=''){
					$filter[$no++]="A.KPPN = '".$_POST['kdkppn']."'";
					$d_kppn = new DataUser($this->registry);
					$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
					$this->view->data2 = $d_spm1->get_realisasi_lokasi($_POST['kdkppn']);
				} elseif (Session::get('role')==KANWIL){
					$filter[$no++]="A.KANWIL = '".Session::get('id_user')."'";
					$this->view->data2 = $d_spm1->get_realisasi_lokasi_kanwil(Session::get('id_user'));
				}
				
				if ($_POST['kdlokasi']!=''){
					$filter[$no++]="a.lokasi = '".$_POST['kdlokasi']."'";
					$this->view->lokasi = $_POST['kdlokasi'];
				}
				if ($_POST['kdsatker']!=''){
					$filter[$no++]="A.SATKER = '".$_POST['kdsatker']."'";
					$this->view->satker_code = $_POST['kdsatker'];
				}
			$this->view->data = $d_spm1->get_realisasi_fa_lokasi_global_filter($filter);
			}
			if (Session::get('role')==KANWIL){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
				
			}
			if (Session::get('role')==ADMIN || Session::get('role')==DJA){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
			}
		
			if (Session::get('role')==KPPN) {$filter[$no++]="A.KPPN = '".Session::get('id_user')."'";
			$this->view->data2 = $d_spm1->get_realisasi_lokasi(Session::get('id_user'));
			$this->view->data = $d_spm1->get_realisasi_fa_lokasi_global_filter($filter);
			
			}
		$this->view->render('kppn/DataRealisasiLokasi');
	}
	
	public function DataRealisasiTransfer() {
		$d_spm1 = new DataRealisasi($this->registry);
		$filter = array ();
		$no=0;
			if (isset($_POST['submit_file'])) {
				/*if ($_POST['kdkppn']!=''){
					$filter[$no++]="A.KPPN = '".$_POST['kdkppn']."'";
					$d_kppn = new DataUser($this->registry);
					$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
					$this->view->data2 = $d_spm1->get_realisasi_satker_transfer($_POST['kdkppn']);
				} 
				elseif (Session::get('role')==KANWIL){
					$filter[$no++]="A.KANWIL = '".Session::get('id_user')."'";
					$this->view->data2 = $d_spm1->get_realisasi_satker_transfer_kanwil(Session::get('id_user'));
				}*/
				
				if ($_POST['kdlokasi']!=''){
					$filter[$no++]="a.lokasi = '".$_POST['kdlokasi']."'";
					$this->view->lokasi = $_POST['kdlokasi'];
				}
				if ($_POST['kdsatker']!=''){
					$filter[$no++]="A.SATKER = '".$_POST['kdsatker']."'";
					$this->view->data3 = $d_spm1->get_realisasi_nmsatker_transfer($_POST['kdsatker']);
				}
				
				if ($_POST['tgl_awal']!='' AND $_POST['tgl_akhir']!=''){
					
					$filter[$no++] = "TO_CHAR(ACCOUNTING_DATE,'YYYYMMDD') BETWEEN '".date('Ymd',strtotime($_POST['tgl_awal']))."' AND '".date('Ymd', strtotime($_POST['tgl_akhir']))."'";
					
					$this->view->d_tgl_awal = $_POST['tgl_awal'];
					$this->view->d_tgl_akhir = $_POST['tgl_akhir'];
				}	
			$this->view->data = $d_spm1->get_realisasi_transfer_global_filter($filter);
			}
			
			if (Session::get('role')==KANWIL){
				$d_kppn_list = new DataUser($this->registry);
				//$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
				$this->view->data4 = $d_spm1->get_realisasi_lokasi_kanwil(Session::get('id_user'));
				$this->view->data2 = $d_spm1->get_realisasi_satker_transfer();
				//$this->view->data = $d_spm1->get_realisasi_transfer_global_filter($filter);
			}
			if (Session::get('role')==ADMIN || Session::get('role')==DJA){
				$d_kppn_list = new DataUser($this->registry);
				//$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
				$this->view->data4 = $d_spm1->get_realisasi_lokasi_kanwil(Session::get('id_user'));
				$this->view->data = $d_spm1->get_realisasi_transfer_global_filter($filter);
				$this->view->data2 = $d_spm1->get_realisasi_satker_transfer();
				//$this->view->data2 = $d_spm1->get_realisasi_satker_transfer($_POST['kdkppn']);
			}
		
			if (Session::get('role')==KPPN) {
			$this->view->data4 = $d_spm1->get_realisasi_lokasi(Session::get('id_user'));
			$this->view->data2 = $d_spm1->get_realisasi_satker_transfer(Session::get('id_user'));
			
			}
		$this->view->render('kppn/DataRealisasiTransfer');
	}
			//----------------------------------------------------
			//Development history
			//Revisi : 0
			//Kegiatan :1.mencetak hasil filter ke dalam pdf
			//File yang diubah : DataDIPAController.php
			//Dibuat oleh : Rifan Abdul Rachman
			//Tanggal dibuat : 18-07-2014
			//----------------------------------------------------

	public function DataRealisasiTransfer_PDF() {
		$d_spm1 = new DataRealisasi($this->registry);
		$filter = array ();
		$no=0;
				
			if ($kdlokasi!=''){
				$filter[$no++]="a.lokasi = '".$kdlokasi."'";
			}
			if ($kdsatker!=''){
				$filter[$no++]="A.SATKER = '".$kdsatker."'";
			}
			
			if ($kdtgl_awal!='' AND $kdtgl_akhir!=''){
				
				$filter[$no++] = "TO_CHAR(ACCOUNTING_DATE,'YYYYMMDD') BETWEEN '".date('Ymd',strtotime($kdtgl_awal))."' AND '".date('Ymd', strtotime($kdtgl_akhir))."'";
				
			}	
			$this->view->data = $d_spm1->get_realisasi_transfer_global_filter($filter);
			
		$this->view->load('kppn/DataRealisasiTransfer_PDF');
	}
	
	
	public function DetailEncumbrances($code_id=null) {
		$d_spm1 = new encumbrances($this->registry);
		$filter = array ();
		$no=0;
			if ($code_id != '') {
					$filter[$no++]=" CODE_COMBINATION_ID =  '".$code_id."'";
				}
		$this->view->data = $d_spm1->get_encumbrances($filter);
		$this->view->render('kppn/encumbrances');
	}

    public function __destruct() {
        
    }
}
