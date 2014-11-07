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

    public function index() {
        
    }

    public function RevisiDipa($kdsatker = null) {
        $d_spm1 = new DataDIPA($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if ($kdsatker != '') {
            $filter[$no++] = " A.SATKER_CODE =  '" . $kdsatker . "'";
            $this->view->satker_code = $kdsatker;
        }
        if (Session::get('role') == SATKER) {
            $filter[$no++] = " A.SATKER_CODE =  '" . Session::get('kd_satker') . "'";
        }

        if (Session::get('role') == KANWIL) {
            $filter[$no++] = "KPPN_CODE IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL = '" . Session::get('id_user') . "')";
        }
        if (Session::get('role') == KANWIL) {
            $filter[$no++] = "KPPN_CODE IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL = '" . Session::get('id_user') . "')";
        }
        if (Session::get('role') == KPPN) {
            $filter[$no++] = "KPPN_CODE IN ('" . Session::get('id_user') . "')";
        }

        if (isset($_POST['submit_file'])) {
            $akun1 = $_POST['akun'];
            $akun1 = rtrim($akun1);
            if ($akun1 != '') {
                $filter[$no++] = "A.ACCOUNT_CODE =  '" . $akun1 . "'";
                $this->view->account_code = $akun1;
            }
            $output1 = $_POST['output'];
            $output1 = rtrim($output1);
            if ($_POST['output'] != '') {
                $filter[$no++] = "A.OUTPUT_CODE = '" . $_POST['output'] . "'";
                $this->view->output_code = $_POST['output'];
            }
            $program1 = $_POST['program'];
            $program1 = rtrim($program1);
            if ($program1 != '') {
                $filter[$no++] = "A.PROGRAM_CODE =  '" . $program1 . "'";
                $this->view->program_code = $program1;
            }
            /*if ($_POST['tgl_awal'] != '' AND $_POST['tgl_akhir'] != '') {
                $filter[$no++] = "A.TANGGAL_POSTING_REVISI BETWEEN '" . $_POST['tgl_awal'] . "' AND '" . $_POST['tgl_akhir'] . "'";
                $this->view->d_tgl_awal = $_POST['tgl_awal'];
                $this->view->d_tgl_akhir = $_POST['tgl_akhir'];
            }*/
            if ($_POST['tgl_awal'] != '' AND $_POST['tgl_akhir'] != '') {
                $filter[$no++] = "A.TANGGAL_POSTING_REVISI BETWEEN TO_DATE (" . date('Ymd', strtotime($_POST['tgl_awal'])) . ",'YYYYMMDD') AND TO_DATE (" . date('Ymd', strtotime($_POST['tgl_akhir'])) . ",'YYYYMMDD')";
                $this->view->d_tgl_awal = $_POST['tgl_awal'];
                $this->view->d_tgl_akhir = $_POST['tgl_akhir'];
            }
        }


        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());


        $this->view->data = $d_spm1->get_dipa_filter($filter);
        $this->view->render('kppn/revisiDIPA');
        $d_log->tambah_log("Sukses");
    }

    public function Fund_fail($satker = null) {
        $d_spm1 = new DataFundFail($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if ($satker != '') {
            $filter[$no++] = " KDSATKER =  '" . $satker . "'";
            $this->view->satker_code = $satker;
        }
        if (isset($_POST['submit_file'])) {

            if ($_POST['kdkppn'] != '') {
                $filter[$no++] = "KPPN_CODE = '" . $_POST['kdkppn'] . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
            } /*else {
                $filter[$no++] = "KPPN_CODE = '" . Session::get('id_user') . "'";
                $this->view->d_nama_kppn = Session::get('id_user');
            }*/

            if ($_POST['kd_satker'] != '') {
                $filter[$no++] = "KDSATKER = '" . $_POST['kd_satker'] . "'";
                $this->view->satker_code = $_POST['kd_satker'];
            }
            /* if ($_POST['akun']!=''){
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
              } */
            $this->view->data = $d_spm1->get_fun_fail_filter($filter);
        }
        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
            $filter[$no++] = "KPPN_CODE IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL = '" . Session::get('id_user') . "')";
            $this->view->data = $d_spm1->get_fun_fail_filter($filter);
        }
        if (Session::get('role') == ADMIN || Session::get('role') == DJA) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
            $this->view->data = $d_spm1->get_fun_fail_filter($filter);
        }
        if (Session::get('role') == KPPN) {
            $filter[$no++] = "KPPN_CODE = '" . Session::get('id_user') . "'";
            $this->view->data = $d_spm1->get_fun_fail_filter($filter);
        }
        if (Session::get('role') == SATKER) {
            $filter[$no++] = "KDSATKER = '" . Session::get('kd_satker') . "'";
            $this->view->data = $d_spm1->get_fun_fail_filter($filter);
        }

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        //var_dump($d_spm->get_hist_spm_filter());
        //$this->view->data = $d_spm1->get_fun_fail_filter($filter);


        $this->view->render('kppn/fund_fail');
        $d_log->tambah_log("Sukses");
    }

    public function Detail_Fund_fail() {
        $d_spm1 = new DataFundFail($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if ($kdsatker != '') {
            $filter[$no++] = " KDSATKER =  '" . $kdsatker . "'";
            //$this->view->invoice_num = $invoice_num;	
        }
        if (isset($_POST['submit_file'])) {

            if ($_POST['kd_satker'] != '') {
                $filter[$no++] = "SATKER = '" . $_POST['kd_satker'] . "'";
                $this->view->satker_code = $_POST['kd_satker'];
            }
            /* if ($_POST['akun']!=''){
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
              if (Session::get('role')==KANWIL){
              $d_kppn_list = new DataUser($this->registry);
              $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
              }
              if (Session::get('role')==ADMIN || Session::get('role')==DJA){
              $d_kppn_list = new DataUser($this->registry);
              $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
              }
              if (Session::get('role')==KPPN) {$filter[$no++]="KDKPPN = '".Session::get('id_user')."'";
             */
        }

        //var_dump($d_spm->get_hist_spm_filter());
        //$this->view->data = $d_spm1->get_detail_fun_fail_filter($filter);
        $this->view->data = $d_spm1->get_detail_fun_fail_kd_filter($filter);
        $this->view->render('kppn/detail_fund_fail_kd');
        $d_log->tambah_log("Sukses");
    }

    public function Detail_Fund_Fail_KD($kf, $kdsatker = null, $output = null, $akun = null) {
        $d_spm1 = new DataFundFail($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        if ($kdsatker != '') {
            $filter[$no++] = " SATKER =  '" . $kdsatker . "'";
            $this->view->satker_code = $kdsatker;
        }
        if ($output != '') {
            $filter[$no++] = " OUTPUT =  '" . $output . "'";
            $this->view->output_code = $output;
        }

        if ($akun != '' AND $kf == '2') {
            $filter[$no++] = " AKUN BETWEEN  (SELECT MIN(CHILD_FROM)  FROM T_AKUN_CONTROL WHERE VALUE = '" . $akun . "') AND (SELECT MAX(CHILD_TO)  FROM T_AKUN_CONTROL WHERE VALUE = '" . $akun . "') 
			AND AKUN NOT IN(SELECT CHILD_FROM FROM T_AKUN_CONTROL WHERE VALUE != '" . $akun . "')";
            $this->view->account_code = $akun;
        } elseif ($akun != '' AND $kf == '1') {
            $filter[$no++] = " A.AKUN BETWEEN  (SELECT MIN(CHILD_FROM)  FROM T_AKUN_CONTROL WHERE VALUE = '" . $akun . "') AND (SELECT MAX(CHILD_TO)  FROM T_AKUN_CONTROL WHERE VALUE = '" . $akun . "') 
			AND A.AKUN NOT IN(SELECT CHILD_FROM FROM T_AKUN_CONTROL WHERE VALUE != '" . $akun . "')";
            $this->view->account_code = $akun;
        }

        if (isset($_POST['submit_file'])) {

            if ($_POST['kd_satker'] != '') {
                $filter[$no++] = "KDSATKER = '" . $_POST['kd_satker'] . "'";
                $this->view->satker_code = $_POST['kd_satker'];
            }
        }
        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
            //$filter[$no++] = "KPPN IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL = '" . Session::get('id_user') . "')";
        }
        if (Session::get('role') == ADMIN || Session::get('role') == DJA) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == KPPN) {
            $filter[$no++] = "KPPN = '" . Session::get('id_user') . "'";
        }
        if (Session::get('role') == SATKER) {
            $filter[$no++] = " SATKER = '" . Session::get('kd_satker') . "'";
            $this->view->data = $d_spm1->get_fun_fail_filter($filter);
        }

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table3());
        //var_dump($d_spm->get_hist_spm_filter());

        if ($kf == '2') {
            $this->view->data = $d_spm1->get_detail_fun_fail_kd_filter($filter);
            $this->view->render('kppn/detail_fund_fail_kd');
        } elseif ($kf == '1')  {
            $d_spm2 = new DataFA($this->registry);
            $this->view->data = $d_spm2->get_fa_filter($filter);
            $this->view->render('kppn/detail_fund_fail_ff');
        }
        $d_log->tambah_log("Sukses");


        //$this->view->render('kppn/detail_fund_fail_kd');
    }

    public function RealisasiFA_1($kdsatker=null, $kppn = null) {
        $d_spm1 = new DataFA($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
        if ($kdsatker != '' and Session::get('role') != SATKER) {
            $filter[$no++] = " A.SATKER =  '" . $kdsatker . "'";
            $this->view->satker_code = $kdsatker;
        } else {
            $filter[$no++] = " A.SATKER =  '" . Session::get('kd_satker') . "'";
        }
		if($kppn !='' and Session::get('role') != SATKER) {
			$filter[$no++] = " A.KPPN =  '" . $kppn . "'";
		}
		
        if (Session::get('role') == KPPN) {
            $filter[$no++] = "A.KPPN = '" . Session::get('id_user') . "'";
			/* if (Session::get('id_user') != '019'){
			$filter[$no++] = "SUBSTR(AKUN,1,2) <> 'B3'";
			}	 */
        }
        if (Session::get('role') == KANWIL) {
            $filter[$no++] = "A.KPPN IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL = '" . Session::get('id_user') . "')";
        }
        if (isset($_POST['submit_file'])) {

            if ($_POST['kdsatker'] != '') {
                $filter[$no++] = "A.SATKER = '" . $_POST['kdsatker'] . "'";
                $this->view->satker_code = $_POST['kdsatker'];
            }
            if ($_POST['akun'] != '') {
                $filter[$no++] = "A.AKUN = '" . $_POST['akun'] . "'";
                $this->view->account_code = $_POST['akun'];
            }
            if ($_POST['output'] != '') {
                $filter[$no++] = "A.OUTPUT = '" . $_POST['output'] . "'";
                $this->view->output_code = $_POST['output'];
            }
            if ($_POST['program'] != '') {
                $filter[$no++] = "A.PROGRAM = '" . $_POST['program'] . "'";
                $this->view->program_code = $_POST['program'];
            }
            if ($_POST['tgl_awal'] != '' AND $_POST['tgl_akhir'] != '') {
                $filter[$no++] = "A.TANGGAL_POSTING_REVISI BETWEEN '" . $_POST['tgl_awal'] . "' AND '" . $_POST['tgl_akhir'] . "'";
                $this->view->d_tgl_awal = $_POST['tgl_awal'];
                $this->view->d_tgl_akhir = $_POST['tgl_akhir'];
            }
        }

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $this->view->data = $d_spm1->get_fa_summary_filter($filter);
        //var_dump($d_spm->get_hist_spm_filter());

        $d_log->tambah_log("Sukses");

        $this->view->render('kppn/realisasiFA_1');
    }

    public function RealisasiFA($kdsatker = null, $program = null, $output = null, $akun = null, $dana = null) {
        $d_spm1 = new DataFA($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        if ($kdsatker != '') {
            $filter[$no++] = " A.SATKER =  '" . $kdsatker . "'";
            $this->view->satker_code = $kdsatker;
        }
        if ($program != '') {
            $filter[$no++] = " A.PROGRAM =  '" . $program . "'";
            $this->view->program_code = $program;
        }
        if ($output != '') {
            $filter[$no++] = " A.OUTPUT =  '" . $output . "'";
            $this->view->output_code = $output;
        }

        if ($dana != '') {
            $filter[$no++] = " A.DANA =  '" . $dana . "'";
            //$this->view->dana_code = $dana;
        }
        if ($akun != '') {
            $filter[$no++] = " A.AKUN BETWEEN  (SELECT MIN(CHILD_FROM)  FROM T_AKUN_CONTROL WHERE VALUE = '" . $akun . "') AND (SELECT MAX(CHILD_TO)  FROM T_AKUN_CONTROL WHERE VALUE = '" . $akun . "') 
			AND A.AKUN NOT IN(SELECT CHILD_FROM FROM T_AKUN_CONTROL WHERE VALUE != '" . $akun . "')"
            ;
            $this->view->account_code = $akun;
        }

        if (Session::get('role') == KPPN) {
            $filter[$no++] = "A.KPPN = '" . Session::get('id_user') . "'";
			/* if (Session::get('id_user') != '019'){
			$filter[$no++] = "SUBSTR(AKUN,1,2) <> '53'";
			} */
        }
        if (Session::get('role') == SATKER) {
            $filter[$no++] = "A.SATKER = '" . Session::get('kd_satker') . "'";
        }
        if (Session::get('role') == KANWIL) {
            $filter[$no++] = "A.KPPN IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL = '" . Session::get('id_user') . "')";
        }

        if (isset($_POST['submit_file'])) {

            if ($_POST['kdsatker'] != '') {
                $filter[$no++] = "A.SATKER = '" . $_POST['kdsatker'] . "'";
                $this->view->satker_code = $_POST['kdsatker'];
            }
            if ($_POST['akun'] != '') {
                $filter[$no++] = "A.AKUN = '" . $_POST['akun'] . "'";
                $this->view->account_code = $_POST['akun'];
            }
            if ($_POST['output'] != '') {
                $filter[$no++] = "A.OUTPUT = '" . $_POST['output'] . "'";
                $this->view->output_code = $_POST['output'];
            }
            if ($_POST['program'] != '') {
                $filter[$no++] = "A.PROGRAM = '" . $_POST['program'] . "'";
                $this->view->program_code = $_POST['program'];
            }
            if ($_POST['tgl_awal'] != '' AND $_POST['tgl_akhir'] != '') {
                $filter[$no++] = "A.TANGGAL_POSTING_REVISI BETWEEN '" . $_POST['tgl_awal'] . "' AND '" . $_POST['tgl_akhir'] . "'";
                $this->view->d_tgl_awal = $_POST['tgl_awal'];
                $this->view->d_tgl_akhir = $_POST['tgl_akhir'];
            }
        }

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $this->view->data = $d_spm1->get_fa_filter($filter);
        //var_dump($d_spm->get_hist_spm_filter());

        $d_log->tambah_log("Sukses");

        $this->view->render('kppn/realisasiFA');
    }

    public function nmsatker() {
        $d_spm1 = new DataNamaSatker($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table4());

        if (isset($_POST['submit_file'])) {

            if ($_POST['kdkppn'] != '') {
                $filter[$no++] = "KPPN_CODE = '" . $_POST['kdkppn'] . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
            }
            /* else {
              $filter[$no++]="TS.KPPN = '".Session::get('id_user')."'";
              } */

            if ($_POST['kdsatker'] != '') {
                $filter[$no++] = "KDSATKER = '" . $_POST['kdsatker'] . "'";
                $this->view->d_kd_satker = $_POST['kdsatker'];
            }
            if ($_POST['nmsatker'] != '') {
                $filter[$no++] = " UPPER(NMSATKER) LIKE UPPER('%" . $_POST['nmsatker'] . "%')";
                $this->view->d_nm_satker = $_POST['nmsatker'];
            }
            if ($_POST['revisi'] != '') {
                if ($_POST['revisi'] == '0') {
                    $filter[$no++] = "REV = 0";
                    $this->view->d_kd_revisi = $_POST['revisi'];
                }
				
                elseif ($_POST['revisi'] == '1') {
                    $filter[$no++] = "REV > 0";
                    $this->view->d_kd_revisi = $_POST['revisi'];
                }
            }
            
            /*if ($_POST['KodeBA'] != '') {
                $filter[$no++] = "SUBSTR(A.PROGRAM,1,3) = '" . $_POST['KodeBA'] . "'";
                //$this->view->satker_code = $_POST['KodeBA'];
            }*/
            
            $this->view->data = $d_spm1->get_satker_dipa_filter($filter);
			//$this->view->data2 = $d_spm1->get_nama_BA($_POST['kdkppn']);
            
            		
        }
        /* elseif (Session::get('role')==ADMIN){
          $filter[$no++]="(SELECT MAX(A.REVISION_NO) FROM SPSA_BT_DIPA_V) > '0'";
          $this->view->data = $d_spm1->get_satker_dipa_filter($filter);
          } */

        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }
        if (Session::get('role') == ADMIN || Session::get('role') == DJA) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
            //$this->view->data = $d_spm1->get_satker_dipa_filter($filter);	
        }
        if (Session::get('role') == KPPN) {
            $filter[$no++] = "KPPN_CODE = '" . Session::get('id_user') . "'";
            $this->view->data = $d_spm1->get_satker_dipa_filter($filter);
        }


        if (Session::get('role') == ADMIN) {
            $this->view->render('kppn/NamaSatkerDIPA1');
        } else {
            $this->view->render('kppn/NamaSatkerDIPAkppn');
        }
        
        
        $d_log->tambah_log("Sukses");
        //var_dump($d_spm1->get_satker_filter($filter));
        //$this->view->render('kppn/NamaSatkerDIPA1');
    }

    public function nmsatker1() {
        $d_spm1 = new DataNamaSatker($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table4());
        
        if (isset($_POST['submit_file'])) {

            if ($_POST['kdkppn'] != '') {
                $filter[$no++] = "KPPN_CODE = '" . $_POST['kdkppn'] . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
				$this->view->kppn = $_POST['kdkppn'];
            } else {
                $filter[$no++] = "KPPN_CODE = '" . Session::get('id_user') . "'";
				$d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn(Session::get('id_user'));
            }

            if ($_POST['kdsatker'] != '') {
                $filter[$no++] = "KDSATKER = '" . $_POST['kdsatker'] . "'";
                $this->view->d_kd_satker = $_POST['kdsatker'];
            }
            if ($_POST['nmsatker'] != '') {
                $filter[$no++] = " UPPER(NMSATKER) LIKE UPPER('%" . $_POST['nmsatker'] . "%')";
                $this->view->d_nm_satker = $_POST['nmsatker'];
            }

            $this->view->data = $d_spm1->get_satker_dipa_filter($filter);
            //$this->view->render('kppn/NamaSatker');			
        }
        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }
        if (Session::get('role') == ADMIN || Session::get('role') == DJA) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == KPPN) {
            $filter[$no++] = "KPPN_CODE = '" . Session::get('id_user') . "'";
            $this->view->data = $d_spm1->get_satker_dipa_filter($filter);
        }

        //var_dump($d_spm1->get_satker_filter($filter));
        $this->view->render('kppn/NamaSatkerDIPA2');
        $d_log->tambah_log("Sukses");
    }

    public function DetailRealisasiFA($code_id = null) {
        $d_spm1 = new DataRealisasiFA($this->registry);
        $filter = array();
        $no = 0;
        
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());
        
        if ($code_id != '') {
            $filter[$no++] = " DIST_CODE_COMBINATION_ID =  '" . $code_id . "'";
            //$this->view->invoice_num = $invoice_num;	
        }
        //var_dump($d_spm->get_hist_spm_filter());
        $this->view->data = $d_spm1->get_realisasi_fa_filter($filter);

        $d_log->tambah_log("Sukses");

        $this->view->render('kppn/DetailRealisasiFA');
    }

    public function DataRealisasi() {
        $d_spm1 = new DataRealisasi($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        if (isset($_POST['submit_file'])) {
            if ($_POST['kdkppn'] != '') {
				if ($_POST['kdkppn'] != 'SEMUA') {
					$filter[$no++] = "A.KPPN = '" . $_POST['kdkppn'] . "'";
					$d_kppn = new DataUser($this->registry);
					$this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
					$this->view->d_kd_kppn = $_POST['kdkppn'];
				}
            } else {
                $filter[$no++] = "A.KPPN = '" . Session::get('id_user') . "'";
            }

            if ($_POST['kdsatker'] != '') {
                $filter[$no++] = "A.SATKER = '" . $_POST['kdsatker'] . "'";
                $this->view->satker_code = $_POST['kdsatker'];
            }
			if ($_POST['KodeBA'] != '') {
                $filter[$no++] = "SUBSTR(A.PROGRAM,1,3) = '" . $_POST['KodeBA'] . "'";
                //$this->view->satker_code = $_POST['KodeBA'];
            }
            $this->view->data = $d_spm1->get_realisasi_fa_global_filter($filter);
			$this->view->data2 = $d_spm1->get_nama_BA($_POST['kdkppn']);
			
        }

        //----------------------------------------------------
        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }
        if (Session::get('role') == ADMIN || Session::get('role') == DJA) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }

        if (Session::get('role') == KPPN) {
            $filter[$no++] = "A.KPPN = '" . Session::get('id_user') . "'";
            $this->view->data = $d_spm1->get_realisasi_fa_global_filter($filter);
			$this->view->data2 = $d_spm1->get_nama_BA(Session::get('id_user'));
        }

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $d_log->tambah_log("Sukses");

        $this->view->render('kppn/DataRealisasi');
    }

    public function DataRealisasiBA() {
        $d_spm1 = new DataRealisasi($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        if (isset($_POST['submit_file'])) {
            if ($_POST['kdkppn'] != '') {

                $filter[$no++] = "KPPN = '" . $_POST['kdkppn'] . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
                //$this->view->data2 = $d_spm1->get_realisasi_lokasi($_POST['kdkppn']);
            } elseif (Session::get('role') == KANWIL) {
                $filter[$no++] = "KANWIL = '" . Session::get('id_user') . "'";
            }

            if ($_POST['kdlokasi'] != '') {
                $filter[$no++] = "a.lokasi = '" . $_POST['kdlokasi'] . "'";
                $this->view->lokasi = $_POST['kdlokasi'];
            }
            $this->view->data = $d_spm1->get_realisasi_fa_global_ba_filter($filter);
        }
        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }
        if (Session::get('role') == ADMIN || Session::get('role') == DJA) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }

        if (Session::get('role') == KPPN) {
            $filter[$no++] = "KPPN = '" . Session::get('id_user') . "'";
            //$this->view->data2 = $d_spm1->get_realisasi_lokasi(Session::get('id_user'));
            $this->view->data = $d_spm1->get_realisasi_fa_global_ba_filter($filter);
        }

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        //var_dump($d_spm->get_hist_spm_filter());
        //$this->view->data = $d_spm1->get_realisasi_fa_global_filter($filter);

        $d_log->tambah_log("Sukses");

        $this->view->render('kppn/DataRealisasiBA');
    }

    public function DataRealisasiLokasi() {
        $d_spm1 = new DataRealisasi($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        if (isset($_POST['submit_file'])) {
            if ($_POST['kdkppn'] != '') {
                $filter[$no++] = "A.KPPN = '" . $_POST['kdkppn'] . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
                $this->view->data2 = $d_spm1->get_realisasi_lokasi($_POST['kdkppn']);
            } elseif (Session::get('role') == KANWIL) {
                $filter[$no++] = "A.KANWIL = '" . Session::get('id_user') . "'";
                $this->view->data2 = $d_spm1->get_realisasi_lokasi_kanwil(Session::get('id_user'));
            }

            if ($_POST['kdlokasi'] != '') {
                $filter[$no++] = "a.lokasi = '" . $_POST['kdlokasi'] . "'";
                $this->view->lokasi = $_POST['kdlokasi'];
            }
            if ($_POST['kdsatker'] != '') {
                $filter[$no++] = "A.SATKER = '" . $_POST['kdsatker'] . "'";
                $this->view->satker_code = $_POST['kdsatker'];
            }
            $this->view->data = $d_spm1->get_realisasi_fa_lokasi_global_filter($filter);
        }
        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }
        if (Session::get('role') == ADMIN || Session::get('role') == DJA) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }

        if (Session::get('role') == KPPN) {
            $filter[$no++] = "A.KPPN = '" . Session::get('id_user') . "'";
            $this->view->data2 = $d_spm1->get_realisasi_lokasi(Session::get('id_user'));
            $this->view->data = $d_spm1->get_realisasi_fa_lokasi_global_filter($filter);
        }
        //var_dump($d_spm->get_hist_spm_filter());
        //$this->view->data = $d_spm1->get_realisasi_fa_global_filter($filter);
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());
        
        $d_log->tambah_log("Sukses");

        $this->view->render('kppn/DataRealisasiLokasi');
    }

    public function DataRealisasiTransfer() {
        $d_spm1 = new DataRealisasi($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        if (isset($_POST['submit_file'])) {
            /* if ($_POST['kdkppn']!=''){
              $filter[$no++]="A.KPPN = '".$_POST['kdkppn']."'";
              $d_kppn = new DataUser($this->registry);
              $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
              $this->view->data2 = $d_spm1->get_realisasi_satker_transfer($_POST['kdkppn']);
              }
              elseif (Session::get('role')==KANWIL){
              $filter[$no++]="A.KANWIL = '".Session::get('id_user')."'";
              $this->view->data2 = $d_spm1->get_realisasi_satker_transfer_kanwil(Session::get('id_user'));
              } */

            if ($_POST['kdlokasi'] != '') {
                $filter[$no++] = "a.lokasi = '" . $_POST['kdlokasi'] . "'";
                $this->view->lokasi = $_POST['kdlokasi'];
            }
            if ($_POST['kdsatker'] != '') {
                $filter[$no++] = "A.SATKER = '" . $_POST['kdsatker'] . "'";
                $this->view->data3 = $d_spm1->get_realisasi_nmsatker_transfer($_POST['kdsatker']);
                $this->view->satker_code = $_POST['kdsatker'];
            }

            if ($_POST['tgl_awal'] != '' AND $_POST['tgl_akhir'] != '') {

                $filter[$no++] = "TO_CHAR(ACCOUNTING_DATE,'YYYYMMDD') BETWEEN '" . date('Ymd', strtotime($_POST['tgl_awal'])) . "' AND '" . date('Ymd', strtotime($_POST['tgl_akhir'])) . "'";

                $this->view->d_tgl_awal = $_POST['tgl_awal'];
                $this->view->d_tgl_akhir = $_POST['tgl_akhir'];
            }
			
			if (Session::get('role') == KPPN) {
            $filter[$no++]="A.KPPN = '".Session::get('id_user')."'";
			} 
			
            $this->view->data = $d_spm1->get_realisasi_transfer_global_filter($filter);
        }

        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            //$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
            $this->view->data4 = $d_spm1->get_realisasi_lokasi_kanwil(Session::get('id_user'));
            $this->view->data2 = $d_spm1->get_realisasi_satker_transfer();
            //$this->view->data = $d_spm1->get_realisasi_transfer_global_filter($filter);
        }
        if (Session::get('role') == ADMIN || Session::get('role') == DJA) {
            $d_kppn_list = new DataUser($this->registry);
            //$this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
            $this->view->data4 = $d_spm1->get_realisasi_lokasi_kanwil(Session::get('id_user'));
            $this->view->data = $d_spm1->get_realisasi_transfer_global_filter($filter);
            $this->view->data2 = $d_spm1->get_realisasi_satker_transfer();
            //$this->view->data2 = $d_spm1->get_realisasi_satker_transfer($_POST['kdkppn']);
        }

        if (Session::get('role') == KPPN) {
            $filter[$no++]="A.KPPN = '".Session::get('id_user')."'";
            $this->view->data4 = $d_spm1->get_realisasi_lokasi(Session::get('id_user'));
            $this->view->data2 = $d_spm1->get_realisasi_satker_transfer(Session::get('id_user'));
            //$this->view->data = $d_spm1->get_realisasi_transfer_global_filter($filter);
        }
        //var_dump($d_spm->get_hist_spm_filter());
        //$this->view->data = $d_spm1->get_realisasi_fa_global_filter($filter);
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $d_log->tambah_log("Sukses");

        $this->view->render('kppn/DataRealisasiTransfer');
    }

    public function DetailEncumbrances($code_id = null) {
        $d_spm1 = new encumbrances($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        if ($code_id != '') {
            $filter[$no++] = " CODE_COMBINATION_ID =  '" . $code_id . "'";
            //$this->view->invoice_num = $invoice_num;	
        }
        //var_dump($d_spm->get_hist_spm_filter());
        $this->view->data = $d_spm1->get_encumbrances($filter);

        $d_log->tambah_log("Sukses");

        $this->view->render('kppn/encumbrances');
    }

    public function ProsesRevisi($satker = NULL) {
        $d_spm1 = new proses_revisi($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if ($satker != '') {
            $filter[$no++] = " A.SATKER_CODE =  '" . $satker . "'";
            $this->view->satker_code = $satker;
        }
        if (isset($_POST['submit_file'])) {

            if ($_POST['kdkppn'] != '') {
                $filter[$no++] = "A.KPPN_CODE = '" . $_POST['kdkppn'] . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
            }
            /* else {
              $filter[$no++]="TS.KPPN = '".Session::get('id_user')."'";
              } */

            if ($_POST['satker'] != '') {
                $filter[$no++] = "A.SATKER_CODE = '" . $_POST['satker'] . "'";
                $this->view->d_kd_satker = $_POST['satker'];
            }
            if ($_POST['nmsatker'] != '') {
                $filter[$no++] = " UPPER(B.NMSATKER) LIKE UPPER('%" . $_POST['nmsatker'] . "%')";
                $this->view->d_nm_satker = $_POST['nmsatker'];
            }
        }
        if (Session::get('role') == SATKER) {
            $filter[$no++] = "A.SATKER_CODE = '" . Session::get('kd_satker') . "'";
            //$this->view->data = $d_spm1->get_revisi_dipa($filter);
        }

        if (Session::get('role') == KPPN) {
            $filter[$no++] = "A.KPPN_CODE = '" . Session::get('id_user') . "'";
            //$this->view->data = $d_spm1->get_revisi_dipa($filter);
        }

        if (Session::get('role') == KANWIL) {
            $filter[$no++] = "KPPN_CODE IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL = '" . Session::get('id_user') . "')";
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }
        if (Session::get('role') == ADMIN || Session::get('role') == DJA) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
            //$this->view->data = $d_spm1->get_revisi_dipa($filter);
        }
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $this->view->data = $d_spm1->get_revisi_dipa($filter);

        $this->view->render('kppn/proses_revisi');
        $d_log->tambah_log("Sukses");
    }

    public function DetailRevisi($satker = null) {
        $d_spm1 = new proses_revisi($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if ($satker != '') {
            $filter[$no++] = " KDSATKER =  '" . $satker . "'";
            $this->view->satker_code = $satker;
        }
        if (Session::get('role') == KANWIL) {
            $filter[$no++] = "KDKPPN IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL = '" . Session::get('id_user') . "')";
            //$this->view->data = $d_spm1->detail_revisi($filter);
        }
        if (Session::get('role') == KPPN) {
            $filter[$no++] = "KDKPPN = '" . Session::get('id_user') . "'";
            //$this->view->data = $d_spm1->detail_revisi($filter);
        }
        if (Session::get('role') == SATKER) {
            $filter[$no++] = "KDSATKER = '" . Session::get('kd_satker') . "'";
            //$this->view->data = $d_spm1->detail_revisi($filter);
        }

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table3());

        $this->view->d_kdsatker = $satker;
        $this->view->data = $d_spm1->detail_revisi($filter);

        $this->view->render('kppn/detail_revisi');

        $d_log->tambah_log("Sukses");
    }

    public function __destruct() {
        
    }

}
