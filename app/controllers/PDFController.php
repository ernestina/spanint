<?php
//----------------------------------------------------
//Development history
//Revisi : 0
//Kegiatan :1.mencetak hasil filter ke dalam pdf
//File yang dibuat : PDFController.php
//Dibuat oleh : Rifan Abdul Rachman
//Tanggal dibuat : 18-07-2014
//----------------------------------------------------

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class PDFController extends BaseController {
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
    }
	//------------------------------------------------------
	//Function PDF untuk DataDIPAController(DataDIPAController.php)
	//awal
	//------------------------------------------------------
	public function RevisiDipa_PDF($kdsatker=null,$kdakun=null,$kdoutput=null,$kdprogram=null,$kdtgl_awal=null,$kdtgl_akhir=null) {
	
		$d_spm1 = new DataDIPA($this->registry);
		$filter = array ();
		$no=0;
			if ($kdsatker != 'null') {
				$filter[$no++]=" A.SATKER_CODE =  '".$kdsatker."'";
			}						
			if ($kdakun !='null'){
				$filter[$no++]=" A.ACCOUNT_CODE =  '".$kdakun."'";
			}
			if ($kdoutput !='null'){
				$filter[$no++]=" A.OUTPUT_CODE = '".$kdoutput."'";
			}
			if ($kdprogram !='null'){
				$filter[$no++]=" A.PROGRAM_CODE =  '".$kdprogram."'";
			}
			if ($kdtgl_awal !='null' OR $kdtgl_akhir !='null'){
				$filter[$no++] = " A.TANGGAL_POSTING_REVISI BETWEEN '".$kdtgl_awal."' AND '".$kdtgl_akhir."'";
				$tglawal=array("$kdtgl_awal");
				$tglakhir=array("$kdtgl_akhir"); 
					
				$this->view->kdtgl_awal = $tglawal;
				$this->view->kdtgl_akhir = $tglakhir;	
			}

		if (Session::get('role')==SATKER){
			$d_nm_kppn1 = new DataUser($this->registry);
			$this->view->nm_kppn2= $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
		}else{
			$this->view->nm_kppn2=Session::get('user');
		}

		$d_last_update = new DataLastUpdate($this->registry);
		$this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());
		
		$this->view->data = $d_spm1->get_dipa_filter($filter);
		$this->view->load('kppn/revisiDIPA_PDF');
	}
	
	public function Fund_fail_PDF() {
		$d_spm1 = new DataFundFail($this->registry);
		$filter = array ();
		$no=0;
		
		if ($kdkppn!=''){
			$filter[$no++]="KPPN_CODE = '".$kdkppn."'";
			$d_kppn = new DataUser($this->registry);
			$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
		} else {
			$filter[$no++]="KPPN_CODE = '".Session::get('id_user')."'";
		}
		
		if ($kdsatker!=''){
			$filter[$no++]="KDSATKER = '".$kdsatker."'";
		}
		/*if ($kdakun!=''){
			$filter[$no++]="A.ACCOUNT_CODE = '".$kdakun."'";
		}
		if ($kdoutput!=''){
			$filter[$no++]="A.OUTPUT_CODE = '".$kdoutput."'";
		}
		if ($kdprogram!=''){
			$filter[$no++]="A.PROGRAM_CODE = '".$kdprogram."'";
		}
		
		if ($kdtgl_awal !='null' OR $kdtgl_akhir !='null'){
			//$filter[$no++] = " A.TANGGAL_POSTING_REVISI BETWEEN '".$kdtgl_awal."' AND '".$kdtgl_akhir."'";
			$tglawal=array("$kdtgl_awal");
			$tglakhir=array("$kdtgl_akhir"); 
				
			$this->view->kdtgl_awal = $tglawal;
			$this->view->kdtgl_akhir = $tglakhir;	
		}

		*/
		$this->view->data = $d_spm1->get_fun_fail_filter($filter);
		if (Session::get('role')==SATKER){
			$d_nm_kppn1 = new DataUser($this->registry);
			$this->view->nm_kppn2= $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
		}else{
			$this->view->nm_kppn2=Session::get('user');
		}
		$this->view->load('kppn/fund_fail_PDF');
	}

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

		if ($kdtgl_awal !='null' OR $kdtgl_akhir !='null'){
			//$filter[$no++] = " A.TANGGAL_POSTING_REVISI BETWEEN '".$kdtgl_awal."' AND '".$kdtgl_akhir."'";
			$tglawal=array("$kdtgl_awal");
			$tglakhir=array("$kdtgl_akhir"); 
				
			$this->view->kdtgl_awal = $tglawal;
			$this->view->kdtgl_akhir = $tglakhir;	
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
		if (Session::get('role')==SATKER){
			$d_nm_kppn1 = new DataUser($this->registry);
			$this->view->nm_kppn2= $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
		}else{
			$this->view->nm_kppn2=Session::get('user');
		}

		$d_last_update = new DataLastUpdate($this->registry);
		$this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());
		
		$this->view->data = $d_spm1->get_fa_filter($filter);
		$this->view->load('kppn/realisasiFA
		');
	}

	//------------------------------------
	public function DataRealisasi_PDF($kdkppn=null,$kdsatkerku=null) {
		$d_spm1 = new DataRealisasi($this->registry);
		$filter = array ();
		$no=0;
			if ($kdkppn!=''){
				$filter[$no++]="A.KPPN = '".$kdkppn."'";
				$d_kppn = new DataUser($this->registry);
				$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
				$this->view->d_kd_kppn = $kdkppn;
			} else {
				$filter[$no++]="A.KPPN = '".Session::get('id_user')."'";
			}
			
			if ($kdsatkerku!=''){
				$filter[$no++]="A.SATKER = '".$kdsatkerku."'";
			}
			
			if ($kdtgl_awal !='null' OR $kdtgl_akhir !='null'){
				//$filter[$no++] = " A.TANGGAL_POSTING_REVISI BETWEEN '".$kdtgl_awal."' AND '".$kdtgl_akhir."'";
				$tglawal=array("$kdtgl_awal");
				$tglakhir=array("$kdtgl_akhir"); 
					
				$this->view->kdtgl_awal = $tglawal;
				$this->view->kdtgl_akhir = $tglakhir;	
			}

			if (Session::get('role')==SATKER){
				$d_nm_kppn1 = new DataUser($this->registry);
				$this->view->nm_kppn2= $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
			}else{
				$this->view->nm_kppn2=Session::get('user');
			}

			$this->view->data = $d_spm1->get_realisasi_fa_global_filter($filter);

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
			$this->view->load('kppn/DataRealisasi_PDF');
	}
	
	public function DataRealisasiBA_PDF($kdkppn=null) {
		$d_spm1 = new DataRealisasi($this->registry);
		$filter = array ();
		$no=0;
			
		$this->view->data = $d_spm1->get_realisasi_fa_global_ba_filter($filter);
			
		if (Session::get('role')==SATKER){
			$d_nm_kppn1 = new DataUser($this->registry);
			$this->view->nm_kppn2= $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
		}else{
			$this->view->nm_kppn2=Session::get('user');
		}
	
		$d_last_update = new DataLastUpdate($this->registry);
		$this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());
		$this->view->load('kppn/DataRealisasiBA_PDF');
	}
	
	public function DataRealisasiTransfer_PDF($kdsatkerku=null,$kdlokasi=null,$kdtgl_awal=null,$kdtgl_akhir=null) {
		$d_spm1 = new DataRealisasi($this->registry);
		$filter = array ();
		$no=0;
				/*if ($_POST['kdkppn']!=''){
					$filter[$no++]="A.KPPN = '".$_POST['kdkppn']."'";
				} 
				elseif (Session::get('role')==KANWIL){
					$filter[$no++]="A.KANWIL = '".Session::get('id_user')."'";
				}*/
				
				if ($kdlokasi!='null'){
					$filter[$no++]="a.lokasi = '".$kdlokasi."'";
				}
				if ($kdsatkerku!='null'){
					$filter[$no++]="A.SATKER = '".$kdsatkerku."'";
				}
				
				if ($kdtgl_awal!='null' AND $kdtgl_akhir!='null'){
					
					$filter[$no++] = "TO_CHAR(ACCOUNTING_DATE,'YYYYMMDD') BETWEEN '".date('Ymd',strtotime($kdtgl_awal))."' AND '".date('Ymd', strtotime($kdtgl_akhir))."'";		
					$tglawal=array("$kdtgl_awal");
					$tglakhir=array("$kdtgl_akhir"); 
				
					$this->view->kdtgl_awal = $tglawal;
					$this->view->kdtgl_akhir = $tglakhir;	
				}	
				
				if (Session::get('role')==SATKER){
					$d_nm_kppn1 = new DataUser($this->registry);
					$this->view->nm_kppn2= $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
				}else{
					$this->view->nm_kppn2=Session::get('user');
				}

			$this->view->data = $d_spm1->get_realisasi_transfer_global_filter($filter);
			
		$this->view->load('kppn/DataRealisasiTransfer_PDF');
	}
	
	
	public function DetailRevisi_PDF($kdsatker=null) {
		$d_spm1 = new proses_revisi($this->registry);
		$filter = array ();
		$no=0;
		if ($kdsatker != '') {
			$filter[$no++]=" KDSATKER =  '".$kdsatker."'";
				
		}
		if ($kdtgl_awal !='null' OR $kdtgl_akhir !='null'){
 			//$filter[$no++] = " A.TANGGAL_POSTING_REVISI BETWEEN '".$kdtgl_awal."' AND '".$kdtgl_akhir."'";
			$tglawal=array("$kdtgl_awal");
			$tglakhir=array("$kdtgl_akhir"); 
				
			$this->view->kdtgl_awal = $tglawal;
			$this->view->kdtgl_akhir = $tglakhir;	
		}

		if (Session::get('role')==SATKER){
			$d_nm_kppn1 = new DataUser($this->registry);
			$this->view->nm_kppn2= $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));

		}else{
			$this->view->nm_kppn2=Session::get('user');
		}

		$this->view->data = $d_spm1->detail_revisi($filter);
		$this->view->load('kppn/detail_revisi_PDF');
	}

	//------------------------------------------------------
	//Function PDF untuk DataDIPAController
	//akhir
	//------------------------------------------------------

	//------------------------------------------------------
	//Function PDF untuk DataDropingController(DataDropingController.php)
	//awal
	//------------------------------------------------------
	public function detailDroping_PDF($id=null,$bank=null, $tanggal=null) {
		$d_sppm = new DataDroping($this->registry);
		$filter = array ();
		$no=0;
		if (!is_null($id)){
			$filter[$no++]="ID_DETAIL = '".$id."'";
			$this->view->d_id = $id;
		} 
		if (!is_null($bank)){
			if ($bank != "SEMUA_BANK"){
				$filter[$no++]="BANK = '".$bank."'";
			}
			$this->view->d_bank = $bank;
		} 	
		if (!is_null($tanggal)){
			$filter[$no++]="TO_CHAR(CREATION_DATE,'DD-MM-YYYY') = '".$tanggal."'";
			$this->view->d_tanggal = $tanggal;
		} 
		$this->view->data = $d_sppm->get_droping_detail_filter($filter);
		
		// untuk mengambil data last update 
		$d_last_update = new DataLastUpdate($this->registry);
		$this->view->last_update = $d_last_update->get_last_updatenya($d_sppm->get_table1());
		
		$this->view->render('pkn/dropingDetail');
	}

	//------------------------------------------------------
	//Function PDF untuk DataDropingController(DataDropingController.php)
	//akhir
	//------------------------------------------------------


	//------------------------------------------------------
	//Function PDF untuk DataGRController(DataGRController.php)
	//awal
	//------------------------------------------------------
	public function GR_PFK_PDF() {
		$d_spm1 = new DataPFK($this->registry);
		$filter = array ();
		$bulan = '';
		$no=0;
			if (Session::get('role')==KANWIL){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
			}
			if (Session::get('role')==ADMIN){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
			}
			if (Session::get('role')==KPPN) {
				$filter[$no++]="KPPN = '".Session::get('id_user')."'";	
			}
			if (isset($_POST['submit_file'])) {
				if ($_POST['bulan']!=''){
					//if ($_POST['bulan']!='SEMUA_BULAN'){
						$bulan = $_POST['bulan'];
					//}
					$this->view->d_bulan = $_POST['bulan'];
				} 
				if ($_POST['kdkppn'] != ''){
					if ($_POST['kdkppn'] != 'SEMUA KPPN'){
						$filter[$no++]="KPPN = '".$_POST['kdkppn']."'";
						$d_kppn = new DataUser($this->registry);
						$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
					}
				} else {
					$filter[$no++]="KPPN = '".Session::get('id_user')."'";
				}
			} 
		$this->view->data = $d_spm1->get_gr_pfk_filter($filter, $bulan);
		$this->view->load('kppn/GR_PFK_GLOBAL_PDF');
	}

		public function GR_IJP_PDF() {
		$d_spm1 = new DataGR_IJP($this->registry);
		$filter = array ();
		$no=0;
			if (Session::get('role')==KANWIL){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
			}
			if (Session::get('role')==ADMIN){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
			}
			if (Session::get('role')==KPPN) {
				$filter[$no++]="KPPN = '".Session::get('id_user')."'";	
				
			}
				if ($kdbulan!=''){
					$filter[$no++]="BULAN = '".$kdbulan."'";
				} 
				if ($kdkppn!=''){
					$filter[$no++]="KPPN = '".$kdkppn."'";
					$d_kppn = new DataUser($this->registry);
					$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
				} 
				
			
			
		$this->view->data = $d_spm1->get_gr_ijp_filter($filter);
		$this->view->load('kppn/GR_IJP_PDF');
	}

		public function detailLhpRekap_PDF($tgl=null, $kppn=null) {
		$d_spm1 = new DataGR_STATUS($this->registry);
		$filter = array ();
		$no=0;
			if (!is_null($tgl)) {
				$filter[$no++]="CONT_GL_DATE =  '" .$tgl."'";
				$this->view->d_tgl = substr($tgl, 6, 2)."-".substr($tgl, 4, 2)."-".substr($tgl, 0, 4);
			}
			if (!is_null($kppn)) {
				$filter[$no++]="substr(RESP_NAME,1,3) = '".$kppn."'";
			}
			else { $filter[$no++]="substr(RESP_NAME,1,3) = '".Session::get('id_user')."'";
			}
		$this->view->data = $d_spm1->get_detail_lhp_rekap($filter);
		$this->view->render('kppn/detailLhpRekap_PDF');
	}

	//------------------------------------------------------
	//Function PDF untuk DataGRController(DataGRController.php)
	//akhir
	//------------------------------------------------------
	
	
	//------------------------------------------------------
	//Function PDF untuk DataKppnController(DataKppnController.php)
	//awal
	//------------------------------------------------------
	public function monitoringSp2d_PDF($kdkppn=null,$kdsatker1=null,$kdtgl_awal=null,$kdtgl_akhir=null,$kdnosp2d=null,$kdnoinvoice=null,$kdbarsp2d=null,$kdstatus=null,$kdbayar=null,$kdfxml=null,$kdbank=null) {
		$d_sppm = new DataSppm($this->registry);
		$filter = array ();
		$no=0;
				if ($kdkppn!=''){
					$filter[$no++]="KDKPPN = '".$kdkppn."'";					
				} 
				if ($kdnosp2d!=''){
					$filter[$no++]="CHECK_NUMBER = '".$kdnosp2d."'";
				}
				if ($kdbarsp2d!=''){
					$filter[$no++]="CHECK_NUMBER_LINE_NUM = '".$kdbarsp2d."'";
					
				}
				if ($kdsatker1!=''){
					$filter[$no++]="SUBSTR(INVOICE_NUM,8,6) = '".$kdsatker1."'";				
				}
				
				if ($kdnoinvoice!=''){
					$kdnoinvoice2=substr($kdnoinvoice,0,6).'/'.substr($kdnoinvoice,7,6).'/'.substr($kdnoinvoice,14,4);
					$filter[$no++]="INVOICE_NUM = UPPER('".$kdnoinvoice2."')";
				}
				if ($kdbank!=''){
					if ($kdbank!=5){
						$filter[$no++]="BANK_ACCOUNT_NAME LIKE '%".$kdbank."%'";
						var_dump($kdbank);
					}
					
				}
				if ($kdstatus != ''){
					if ($kdstatus == 'SUKSES' ){
						$filter[$no++] = "RETURN_DESC = 'SUKSES'";
					} elseif ($_POST['status'] == 'TIDAK' ) {
						$filter[$no++] = "RETURN_DESC != 'SUKSES'";
					}
				}
				if ($kdbayar != ''){
					if ($kdbayar != 'SEMUA' ){
						$filter[$no++] = "PAYMENT_METHOD = '".$kdbayar."'";
					} 
				}
				
				if ($kdtgl_awal!='' AND $kdtgl_akhir!=''){
					$filter[$no++] = "PAYMENT_DATE BETWEEN TO_DATE (".date('Ymd',strtotime($kdtgl_awal)).",'YYYYMMDD') 
									AND TO_DATE (".date('Ymd',strtotime($kdtgl_akhir)).",'YYYYMMDD')  ";
					
				}
				if ($kdfxml!=''){
					$filter[$no++]="UPPER(FTP_FILE_NAME) = '".strtoupper($kdfxml)."'";
				}
				if (Session::get('role')==SATKER){
					$filter[$no++]=" SUBSTR(INVOICE_NUM,8,6) = '".Session::get('kd_satker')."'";
					$this->view->d_satker = Session::get('kd_satker');
				}
				$this->view->data = $d_sppm->get_sppm_filter($filter);
				
			if (Session::get('role')==ADMIN OR Session::get('role')==PKN){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
			}
			if (Session::get('role')==KANWIL){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
			}
			// untuk mengambil data last update 
			$d_last_update = new DataLastUpdate($this->registry);
			$this->view->last_update = $d_last_update->get_last_updatenya($d_sppm->get_table());
		
		//$this->view->render('kppn/isianKppn');
		$this->view->load('kppn/isianKppn_PDF');
	}

			public function harianBO_PDF($kdkppn=null,$kdtgl_awal=null,$kdtgl_akhir=null,$kdbank=null) {
		$d_sppm = new DataSppm($this->registry);
		$filter = array ();
		$no=0;
			
				if ($kdkppn!=''){
					$filter[$no++]="KDKPPN = '".$kdkppn."'";
					$d_kppn = new DataUser($this->registry);
					$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
				} else {
					$filter[$no++]="KDKPPN = '".Session::get('id_user')."'";
				}
				if ($kdbank!=''){
					if ($kdbank!=5){
						$filter[$no++]="BANK_ACCOUNT_NAME LIKE '%".$kdbank."%'";
					}
				}
				if ($kdtgl_awal!='' AND $kdtgl_akhir!=''){
					$filter[$no++] = "PAYMENT_DATE BETWEEN TO_DATE (".date('Ymd',strtotime($kdtgl_awal)).",'YYYYMMDD') 
									AND TO_DATE (".date('Ymd',strtotime($kdtgl_akhir)).",'YYYYMMDD')  ";
				}
				$this->view->data = $d_sppm->get_harian_bo_i($filter);
				
			if (Session::get('role')==ADMIN){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
			}	
			if (Session::get('role')==KANWIL){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
			}
			
			// untuk mengambil data last update 
			$d_last_update = new DataLastUpdate($this->registry);
			$this->view->last_update = $d_last_update->get_last_updatenya($d_sppm->get_table());
		
		//$this->view->render('kppn/harianBo');
		$this->view->load('kppn/harianBo_PDF');
	}

			public function sp2dHariIni_PDF() {
		$d_sppm = new DataSppm($this->registry);
		$filter = array ();
		$no=0;
				if ($kdkppn!=''){
					$filter[$no++]="KDKPPN = '".$kdkppn."'";
					$d_kppn = new DataUser($this->registry);
					$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
				} else {
					$filter[$no++]="KDKPPN = '".Session::get('id_user')."'";
				}
				if ($kdbank!=''){
					if ($kdbank!=5){
						$filter[$no++]="BANK_ACCOUNT_NAME LIKE '%".$_POST['bank']."%'";
					}
				}
				if ($kdtgl_awal!='' AND $kdtgl_akhir!=''){
					$filter[$no++] = "PAYMENT_DATE BETWEEN TO_DATE (".date('Ymd',strtotime($kdtgl_awal)).",'YYYYMMDD') 
									AND TO_DATE (".date('Ymd',strtotime($kdtgl_akhir)).",'YYYYMMDD')  ";
				}
				$filter[$no++]=" TO_CHAR(PAYMENT_DATE,'YYYYMMDD') = TO_CHAR(CREATION_DATE,'YYYYMMDD') ";
				$this->view->data = $d_sppm->get_sp2d_hari_ini($filter);
	
			if (Session::get('role')==ADMIN){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
			}	
			if (Session::get('role')==KANWIL){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
			}	
			
			// untuk mengambil data last update 
			$d_last_update = new DataLastUpdate($this->registry);
			$this->view->last_update = $d_last_update->get_last_updatenya($d_sppm->get_table());
		
		//$this->view->render('kppn/sp2dHariIni');
		$this->view->load('kppn/sp2dHariIni_PDF');
	}
	
			public function sp2dBesok_PDF() {
		$d_sppm = new DataSppm($this->registry);
		$filter = array ();
		$no=0;
			
				if ($kdkppn!=''){
					$filter[$no++]="KDKPPN = '".$kdkppn."'";
					$d_kppn = new DataUser($this->registry);
					$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
				} else {
					$filter[$no++]="KDKPPN = '".Session::get('id_user')."'";
				}
				if ($kdbank!=''){
					if ($kdbank!=5){
						$filter[$no++]="BANK_ACCOUNT_NAME LIKE '%".$kdbank."%'";
					}
				}
				if ($kdtgl_awal!='' AND $kdtgl_akhir!=''){
					$filter[$no++] = "PAYMENT_DATE BETWEEN TO_DATE (".date('Ymd',strtotime($kdtgl_awal)).",'YYYYMMDD') 
									AND TO_DATE (".date('Ymd',strtotime($kdtgl_akhir)).",'YYYYMMDD')  ";
				}
				$filter[$no++]="( TO_CHAR(PAYMENT_DATE,'YYYYMMDD') = TO_CHAR(CREATION_DATE,'YYYYMMDD') 
								AND TO_CHAR(CREATION_DATE,'HH24MISS') > '150000' )";
								
				$this->view->data = $d_sppm->get_sp2d_besok($filter);
			
			if (Session::get('role')==ADMIN){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
			}	
			if (Session::get('role')==KANWIL){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
			}		
			
			// untuk mengambil data last update 
			$d_last_update = new DataLastUpdate($this->registry);
			$this->view->last_update = $d_last_update->get_last_updatenya($d_sppm->get_table());
		
		//$this->view->render('kppn/sp2dBesok');
		$this->view->load('kppn/sp2dBesok_PDF');

	}

			public function sp2dBackdate_PDF() {
		$d_sppm = new DataSppm($this->registry);
		$filter = array ();
		$no=0;
				if ($kdkppn!=''){
					$filter[$no++]="KDKPPN = '".$kdkppn."'";
					$d_kppn = new DataUser($this->registry);
					$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
				} else {
					$filter[$no++]="KDKPPN = '".Session::get('id_user')."'";
				}
				if ($kdbank!=''){
					if ($kdbank!=5){
						$filter[$no++]="BANK_ACCOUNT_NAME LIKE '%".$kdbank."%'";
					}
				}
				if ($kdtgl_awal!=''){
					$filter[$no++] = "PAYMENT_DATE BETWEEN TO_DATE (".date('Ymd',strtotime($kdtgl_awal)).",'YYYYMMDD') 
									AND TO_DATE (".date('Ymd',strtotime($kdtgl_akhir)).",'YYYYMMDD')  ";
				}
				$filter[$no++]="TO_CHAR(CREATION_DATE,'YYYYMMDD')  > TO_CHAR(CHECK_DATE,'YYYYMMDD')";
				$this->view->data = $d_sppm->get_sp2d_backdate($filter);
			
			if (Session::get('role')==ADMIN){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
			}	
			if (Session::get('role')==KANWIL){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
			}	
			
			// untuk mengambil data last update 
			$d_last_update = new DataLastUpdate($this->registry);
			$this->view->last_update = $d_last_update->get_last_updatenya($d_sppm->get_table());
		
		//$this->view->render('kppn/sp2dBackdate');
		$this->view->load('kppn/sp2dBackdate_PDF');

	}
	
			public function sp2dNilaiMinus_PDF() {
		$d_sppm = new DataSppm($this->registry);
		$filter = array ();
		$no=0;
			
				if ($kdkppn!=''){
					$filter[$no++]="KDKPPN = '".$kdkppn."'";
					$d_kppn = new DataUser($this->registry);
					$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
				} else {
					$filter[$no++]="KDKPPN = '".Session::get('id_user')."'";
				}
				if ($kdbank!=''){
					if ($kdbank!=5){
						$filter[$no++]="BANK_ACCOUNT_NAME LIKE '%".$kdbank."%'";
					}
				}
				if ($kdtgl_awal!='' AND $kdtgl_akhir!=''){
					$filter[$no++] = "PAYMENT_DATE BETWEEN TO_DATE (".date('Ymd',strtotime($kdtgl_awal)).",'YYYYMMDD') 
									AND TO_DATE (".date('Ymd',strtotime($kdtgl_akhir)).",'YYYYMMDD')  ";
			
				}
				$filter[$no++] = "CHECK_AMOUNT < 1";
				$this->view->data = $d_sppm->get_sp2d_minus($filter);
			
			if (Session::get('role')==ADMIN){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
			}	
			if (Session::get('role')==KANWIL){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
			}		
			
			// untuk mengambil data last update 
			$d_last_update = new DataLastUpdate($this->registry);
			$this->view->last_update = $d_last_update->get_last_updatenya($d_sppm->get_table());
		
		//$this->view->render('kppn/sp2dNilaiMinus');
		$this->view->load('kppn/sp2dNilaiMinus_PDF');

	}

			public function sp2dSudahVoid_PDF($kdkppn=null,$kdtgl_awal2=null,$kdtgl_akhir2=null,$kdbank=null) {
		$d_sppm = new DataSppm($this->registry);
		$filter = array ();
		$no=0;

				if ($kdkppn!=''){
					$filter[$no++]="KDKPPN = '".$kdkppn."'";
					$d_kppn = new DataUser($this->registry);
					$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
				} else {
					$filter[$no++]="KDKPPN = '".Session::get('id_user')."'";
					
					
				}
				if ($kdbank!=''){
					if ($kdbank!=5){
						$filter[$no++]="BANK_ACCOUNT_NAME LIKE '%".$kdbank."%'";
					}
				}
				
				if ($kdtgl_awal2!='' AND $kdtgl_akhir2!=''){
					$filter[$no++] = "PAYMENT_DATE BETWEEN TO_DATE (".date('Ymd',strtotime($kdtgl_awal2)).",'YYYYMMDD') 
									AND TO_DATE (".date('Ymd',strtotime($kdtgl_akhir2)).",'YYYYMMDD')  ";
					
					$tglawal=array("$kdtgl_awal2");
					$tglakhir=array("$kdtgl_akhir2"); 
					
					$this->view->kdtgl_awal = $tglawal;
					$this->view->kdtgl_akhir = $tglakhir;
					
										
				}
				$this->view->data = $d_sppm->get_sp2d_sudah_void($filter);
			
			if (Session::get('role')==ADMIN){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
			}	
			if (Session::get('role')==KANWIL){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
			}
			
			// untuk mengambil data last update 
			$d_last_update = new DataLastUpdate($this->registry);
			$this->view->last_update = $d_last_update->get_last_updatenya($d_sppm->get_table());
		
		$this->view->render('kppn/sp2dSudahVoid');
		//$this->view->load('kppn/sp2dSudahVoid_PDF');
	}

			public function sp2dGajiDobel_PDF() {
		$d_sppm = new DataSppm($this->registry);
			if ($_POST['kdkppn']!=''){
				$kppn="KDKPPN = '".$_POST['kdkppn']."'";
				$d_kppn = new DataUser($this->registry);
				$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
			} else {
				$kppn="KDKPPN = '".Session::get('id_user')."'";
			}
			if ($kdbulan!=13){
				$bulan=$kdbulan;
			}
			$this->view->data = $d_sppm->get_sp2d_gaji_dobel($bulan,$kppn);
		if (Session::get('role')==ADMIN){
			$d_kppn_list = new DataUser($this->registry);
			$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
		}	
		if (Session::get('role')==KANWIL){
			$d_kppn_list = new DataUser($this->registry);
			$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
		}
			
		// untuk mengambil data last update 
		$d_last_update = new DataLastUpdate($this->registry);
		$this->view->last_update = $d_last_update->get_last_updatenya($d_sppm->get_table());
		
		//var_dump($d_sppm->get_sppm_filter($filter));
		$this->view->load('kppn/sp2dGajiDobel_PDF');
	}
	
			public function sp2dSalahTanggal_PDF() {
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
			
		// untuk mengambil data last update 
		$d_last_update = new DataLastUpdate($this->registry);
		$this->view->last_update = $d_last_update->get_last_updatenya($d_sppm->get_table());
		
		//var_dump($d_sppm->get_sppm_filter($filter));
		$this->view->load('kppn/sp2dGajiTanggal_PDF');
	}

		public function sp2dSalahBank_PDF() {
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
			
		// untuk mengambil data last update 
		$d_last_update = new DataLastUpdate($this->registry);
		$this->view->last_update = $d_last_update->get_last_updatenya($d_sppm->get_table());
		
		$this->view->load('kppn/sp2dGajiBank_PDF');
	}


			public function sp2dSalahRekening_PDF() {
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
			
		// untuk mengambil data last update 
		$d_last_update = new DataLastUpdate($this->registry);
		$this->view->last_update = $d_last_update->get_last_updatenya($d_sppm->get_table());
		
		//var_dump($d_sppm->get_sppm_filter($filter));
		$this->view->load('kppn/sp2dGajiRekening_PDF');
	}

			public function detailSp2dGaji_PDF($kdbank=null,$kdbulan=null,$kdkppn=null) {
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
			$filter[$no++]="BANK_ACCOUNT_NAME LIKE '%".$kdbank."%'";
		} 
		if (!is_null($bulan)){
			if ($bulan!='all'){
				$filter[$no++]="to_char(PAYMENT_DATE,'mm') = '".$kdbulan."'";
				
			}
		} 
		if (!is_null($kdkppn)){
			$filter[$no++]=" KDKPPN = '".$kdkppn."'";
				$d_kppn = new DataUser($this->registry);
				$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
		} else {
			if (Session::get('id_user')!='')
			$filter[$no++]=" KDKPPN = ".Session::get('id_user');
		}
			
		// untuk mengambil data last update 
		$d_last_update = new DataLastUpdate($this->registry);
		$this->view->last_update = $d_last_update->get_last_updatenya($d_sppm->get_table());
		
		$this->view->data = $d_sppm->get_detail_sp2d_gaji($filter);
		$this->view->load('kppn/detailSp2dGaji_PDF');
	}




	//------------------------------------------------------
	//Function PDF untuk DataKppnController(DataKppnController.php)
	//akhir
	//------------------------------------------------------

	//------------------------------------------------------
	//Function PDF untuk DataReturController(DataReturController.php)
	//awal
	//------------------------------------------------------
	public function monitoringRetur_PDF($kdkppn=null,$kdnosp2d=null,$kdbarsp2d=null,$kdsatker=null,$kdbank=null,$kdstatus=null,$kdtgl_awal=null,$kdtgl_akhir=null) {
		$d_retur = new DataRetur($this->registry);
		$filter = array ();
		$no=0;
				if ($kdkppn!=''){
					$filter[$no++]="KDKPPN = '".$kdkppn."'";
					$d_kppn = new DataUser($this->registry);
					$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
				} else {
					$filter[$no++]="KDKPPN = ".Session::get('id_user');
				}
				if ($kdnosp2d!=''){
					$filter[$no++]="SP2D_NUMBER = '".$kdnosp2d."'";
				}
				if ($kdbarsp2d!=''){
					$filter[$no++]="RECEIPT_NUMBER = '".$kdbarsp2d."'";
				}
				if ($kdsatker!=''){
					$filter[$no++]="KDSATKER = '".$kdsatker."'";
				}
				if ($kdbank!=''){
					if ($kdbank!='SEMUA_BANK'){
						$filter[$no++]="BANK_ACCOUNT_NAME LIKE '%".$kdbank."%'";
					}
				}
				if ($kdstatus != ''){
					if ($kdstatus != 'SEMUA' ){
						$filter[$no++] = "STATUS_RETUR = '".$kdstatus."'";
					}
				}
				if ($kdtgl_awal!='' AND $kdtgl_akhir!=''){
					$filter[$no++] = "STATEMENT_DATE BETWEEN TO_DATE (".date('Ymd',strtotime($kdtgl_awal)).",'YYYYMMDD') 
									AND TO_DATE (".date('Ymd',strtotime($kdtgl_akhir)).",'YYYYMMDD')  ";
					
				}
				if (Session::get('role')==SATKER){
					$filter[$no++]=" KDSATKER = '".Session::get('kd_satker')."'";
					$this->view->d_satker = Session::get('kd_satker');
				}
				$this->view->data = $d_retur->get_retur_filter($filter);
			
			if (Session::get('role')==ADMIN OR Session::get('role')==PKN){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
			}
			if (Session::get('role')==KANWIL){
				$d_kppn_list = new DataUser($this->registry);
				$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
			}
			
			// untuk mengambil data last update 
			$d_last_update = new DataLastUpdate($this->registry);
			$this->view->last_update = $d_last_update->get_last_updatenya($d_retur->get_table());
		
		//var_dump($d_sppm->get_sppm_filter($filter));
		$this->view->load('kppn/daftarRetur_PDF');
	}

	//------------------------------------------------------
	//Function PDF untuk DataReturController(DataReturController.php)
	//akhir
	//------------------------------------------------------

	//------------------------------------------------------
	//Function PDF untuk DataSPMController(DataSPMController.php)
	//awal
	//------------------------------------------------------
	public function detailposisiSpm_PDF($invoice_num1=null, $invoice_num2=null, $invoice_num3=null ) {
		$d_spm1 = new DataHistSPM($this->registry);
		$filter = array ();
		$no=0;
		if (!is_null($invoice_num1)) {
			$filter[$no++]="INVOICE_NUM =  '".$invoice_num1."/".$invoice_num2."/".$invoice_num3."'";
		}
		if (Session::get('role')==SATKER){
			$d_nm_kppn1 = new DataUser($this->registry);
			$this->view->nm_kppn2= $d_nm_kppn1->get_d_user_nmkppn(Session::get('kd_satker'));
		}else{
			$this->view->nm_kppn2=Session::get('user');
		}

		
		$this->view->data = $d_spm1->get_hist_spm_filter($filter);
			
		$this->view->load('kppn/detailposisiSPM_PDF');
	}

		public function HoldSpm_PDF($kdkppn = null, $invoice_depan=null,$invoice_tengah=null,$invoice_belakang=null, $status=null) {
		$d_spm1 = new DataHoldSPM($this->registry);
		$filter = array ();
		$no=0;
		if ($kdkppn!='null'){
			$filter[$no++]=" ATTRIBUTE15 = '".$kdkppn."'";
			$this->view->d_invoice = $kdkppn;
		}
		if ($invoice_depan!='null' && $invoice_tengah!='null' && $invoice_belakang!='null'){
			$filter[$no++]="invoice_num = '".$invoice_depan."/".$invoice_tengah."/".$invoice_belakang."'";
			$this->view->d_invoice = $invoice;
		}
		if ($status!='null'){
			$filter[$no++]="A.CANCELLED_DATE " .$status;
			$this->view->d_status = $status;
		}
		
		if (Session::get('role')==KPPN) {
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
		if (Session::get('role')==SATKER){
			$filter[$no++]=" SUBSTR(INVOICE_NUM,8,6) = '".Session::get('kd_satker')."'";
			$this->view->d_satker = Session::get('kd_satker');
		}
		$this->view->data = $d_spm1->get_hold_spm_filter($filter);
		
		$d_last_update = new DataLastUpdate($this->registry);
		$this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table2());
		
		$this->view->load('kppn/holdSPM_PDF');
	}
	
		public function HistorySpm_PDF ($invoice_num1=null, $invoice_num2=null, $invoice_num3=null, $sp2d=null ) {
		$d_spm1 = new DataHistorySPM($this->registry);
		$filter = array ();
		$invoice = '';
		$no=0;
			
			if (!is_null($invoice_num1)) {
				$invoice="'".$invoice_num1."/".$invoice_num2."/".$invoice_num3."'";
				$kppn=substr($sp2d,2,3);
				$filter[$no++]= $kppn;
			}
			
				
				if ($_POST['kdkppn']!=''){
					$filter[$no++]=$_POST['kdkppn'];
					$d_kppn = new DataUser($this->registry);
				} 
				else {
					$filter[$no++]= Session::get('id_user');
				}
				
				if ($check_number!=''){
					$invoice ="'".$check_number."'";
				}
		$this->view->data = $d_spm1->get_history_spm_filter ($filter, $invoice);			
		$this->view->load('kppn/historySPM_PDF');
	}

	public function daftarsp2d_PDF($satker=null,$check_number=null,$invoice_depan=null,$invoice_tengah=null,$invoice_belakang=null,$JenisSP2D=null,$JenisSPM=null,$kdtgl_awal=null,$kdtgl_akhir=null) {
		$d_spm1 = new DataCheck($this->registry);
		$filter = array ();
		$no=0;
		if ($satker != '' AND Session::get('id_user') == 140) {
				$filter[$no++]=" SEGMENT1 =  '".$satker."'";
			}
		elseif($satker != '') {
				$filter[$no++]=" SUBSTR(INVOICE_NUM,8,6) =  '".$satker."'";
			}
		if ($tgl1!='' AND $tgl2!=''){
					$filter[$no++] = "CHECK_DATE BETWEEN TO_DATE('".$tgl1."','DD-MM-YYYY hh:mi:ss') AND TO_DATE('".$tgl2."','DD-MM-YYYY hh:mi:ss')";
				}
			
			if ($check_number!='null'){
					$filter[$no++]="check_number = '".$check_number."'";
				}

			if ($invoice_depan!='null'){
					$filter[$no++]="invoice_num = '".$invoice_depan."/".$invoice_tengah."/".$invoice_belakang."'";
				}
			if ($JenisSP2D!='null'){
					$filter[$no++]="JENIS_SP2D = '".$JenisSP2D."'";
				}
			if ($JenisSPM!='null'){
					$filter[$no++]="JENIS_SPM = '".$JenisSPM."'";
				}

			if ($kdtgl_awal!='null' AND $kdtgl_akhir!='null'){
					$filter[$no++] = "CHECK_DATE BETWEEN TO_DATE('".$kdtgl_awal."','DD/MM/YYYY hh:mi:ss') AND TO_DATE('".$kdtgl_akhir."','DD/MM/YYYY hh:mi:ss')";
				}
			if (Session::get('role')==KPPN) {$filter[$no++]="SUBSTR(CHECK_NUMBER,3,3) = '".Session::get('id_user')."'";	
					
			}
			
		$this->view->data2 = $d_spm1->get_jenis_spm_filter($kdsatker);	
		$this->view->data = $d_spm1->get_sp2d_satker_filter($filter);	
		$d_last_update = new DataLastUpdate($this->registry);
		$this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

		if( Session::get('id_user') == 140 ){
		$this->view->load('kppn/SP2DSatker140_PDF');
		}
		else {
		$this->view->load('kppn/SP2DSatker_PDF');
		}
	}	
	
		public function detailrekapsp2d_PDF($jenis_spm=null, $kppn=null, $tgl_awal=null, $tgl_akhir=null) {
		$d_spm1 = new DataCheck($this->registry);
		$filter = array ();
		$no=0;
		if ($jenis_spm != 'null') {
				$filter[$no++]=" JENDOK =  '".$jenis_spm."'";
			}
		if ($kppn != '' AND Session::get('role')==KANWIL AND $_POST['kdkppn']!='') {
			$filter[$no++]="SUBSTR(CHECK_NUMBER,3,3) IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL = '".Session::get('id_user')."')";
			}
		elseif ($kppn != 'null') {
			$filter[$no++]=" SUBSTR(CHECK_NUMBER,3,3) =  '".$kppn."'";
			}
		if ($tgl_awal != 'null' AND $tgl_akhir !='null'){
					
			$filter[$no++] = "TO_CHAR(CREATION_DATE,'YYYYMMDD') BETWEEN '".date('Ymd',strtotime($tgl_awal))."' AND '".date('Ymd', strtotime($tgl_akhir))."'";
					
			}	
		
		if (Session::get('role')==KPPN) {
			$filter[$no++]="SUBSTR(CHECK_NUMBER,3,3) = '".Session::get('id_user')."'";			
				
			}
		if (Session::get('role')==SATKER) {				
			$filter[$no++]="SUBSTR(INVOICE_NUM,8,6) = '".Session::get('kd_satker')."'";
		}		
		$this->view->data = $d_spm1->get_sp2d_satker_filter($filter);	
		
		$d_last_update = new DataLastUpdate($this->registry);
		$this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

		$this->view->load('kppn/Rekap_PDF');
		
	}	


	//------------------------------------------------------
	//Function PDF untuk DataSPMController(DataSPMController.php)
	//akhir
	//------------------------------------------------------

	//------------------------------------------------------
	//Function PDF untuk DataSupplierController(DataSupplierController.php)
	//awal
	//------------------------------------------------------

	//------------------------------------------------------
	//Function PDF untuk DataSupplierController(DataSupplierController.php)
	//akhir
	//------------------------------------------------------

	//------------------------------------------------------
	//Function PDF untuk DataUserController(DataUserController.php)
	//awal
	//------------------------------------------------------

	//------------------------------------------------------
	//Function PDF untuk DataUserController(DataUserController.php)
	//akhir
	//------------------------------------------------------

	//------------------------------------------------------
	//Function PDF untuk UserSpanController(UserSpanController.php)
	//awal
	//------------------------------------------------------
	public function monitoringUserSpan_PDF($kdkppn=null,$kdnip=null) {   //nama function
		$d_user = new DataUserSPAN($this->registry); //model
		$filter = array ();
			if ($kdkppn!=''){
				$filter[$no++]=" KDKPPN = '".$kdkppn."'";
				$d_kppn = new DataUser($this->registry);
				$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
			} else {
				$filter[$no++]=" KDKPPN = ".Session::get('id_user');
			}
			if ($kdnip!=''){
				$filter[]=" USER_NAME = '".$kdnip."'";
			}
			$this->view->data = $d_user->get_user_filter($filter);
		
		if (Session::get('role')==ADMIN){
			$d_kppn_list = new DataUser($this->registry);
			$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
		}
		if (Session::get('role')==KANWIL){
			$d_kppn_list = new DataUser($this->registry);
			$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
		}
		if (Session::get('role')==KPPN) {
			$filter[$no++]=" KDKPPN = ".Session::get('id_user');
			$this->view->data = $d_user->get_user_filter($filter);
		}
		$this->view->load('kppn/monitoringUser_PDF');
	}

	//------------------------------------------------------
	//Function PDF untuk UserSpanController(UserSpanController.php)
	//akhir
	//------------------------------------------------------
    public function __destruct() {
        
    }

}
