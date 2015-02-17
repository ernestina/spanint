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

    public function index() {
        
    }

    /*
      public function infoSP2D() {
      $d_spm = new DataSPM($this->registry);
      d_spm->get_spm_filter();
      //var_dump($d_sppm->get_sppm_filter($filter));
      $this->view->render('kppn/isianSPM');
      }
     */

    public function PosisiSPM() {
        $d_spm1 = new DataHistSPM($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        if (isset($_POST['submit_file'])) {
            if ($_POST['kdkppn'] != '') {
                $filter[$no++] = "KDKPPN = '" . $_POST['kdkppn'] . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
            }
        } else {
            $filter[$no++] = "KDKPPN = '" . Session::get('id_user') . "'";
        }
        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
            $filter[$no++] = "KDKPPN IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL = '" . Session::get('id_user') . "')";
        }
        if (Session::get('role') == ADMIN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == SATKER) {
            $filter[$no++] = " SUBSTR(INVOICE_NUM,8,6) = '" . Session::get('kd_satker') . "'";
            $this->view->d_satker = Session::get('kd_satker');
        }
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $this->view->data = $d_spm1->get_hist_spm_filter($filter);
        //var_dump($d_spm->get_hist_spm_filter());

        $d_log->tambah_log("Sukses");


        $this->view->render('kppn/posisiSPM');
    }

    public function downloadSP2D() {
        $d_supp = new DataCheck($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        if (count($_POST['checkbox']) != 0) {
            $array = array("checkbox" => $_POST['checkbox']);
            $ids = implode("','", $array['checkbox']);
        } else {
            echo "<script>alert ('Belum ada yang dipilih (centang/checkmark))</script>";
            header('location:' . URL . 'dataSPM/daftarsp2d');
        }
        $this->view->data = $d_supp->get_download_sp2d($ids);
        $this->view->data2 = $d_supp->get_tgl_download_sp2d($ids);

        $d_log->tambah_log("Sukses");

        $this->view->load('kppn/downloadSP2D');
    }

    public function HoldSPM() {
        $d_spm1 = new DataHoldSPM($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (isset($_POST['submit_file'])) {

            if ($_POST['invoice'] != '') {
                $filter[$no++] = "invoice_num = '" . $_POST['invoice'] . "'";
                $this->view->d_invoice = $_POST['invoice'];
            }
            if ($_POST['kdkppn'] != '') {
                $filter[$no++] = "KDKPPN = '" . $_POST['kdkppn'] . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
                $this->view->d_kppn = $_POST['kdkppn'];
            }
            if ($_POST['STATUS'] != '') {
                if ($_POST['STATUS'] == 1) {
                    $filter[$no++] = "A.CANCELLED_DATE IS NULL ";
                } elseif ($_POST['STATUS'] == 2) {
                    $filter[$no++] = "A.CANCELLED_DATE IS NOT NULL";
                }

                $this->view->d_status = $_POST['STATUS'];
            }
        }
        if (Session::get('role') == KPPN) {
            $filter[$no++] = "KDKPPN = '" . Session::get('id_user') . "'";
            $this->view->d_kppn = Session::get('id_user');
            $this->view->data = $d_spm1->get_hold_spm_filter($filter);
        }
        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
            $filter[$no++] = "KDKPPN IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL = '" . Session::get('id_user') . "')";
        }
        if (Session::get('role') == ADMIN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == SATKER) {
            $filter[$no++] = " SUBSTR(INVOICE_NUM,8,6) = '" . Session::get('kd_satker') . "'";
            $this->view->d_satker = Session::get('kd_satker');
        }
        if ($_POST['kdkppn'] != '') {
            $this->view->data = $d_spm1->get_hold_spm_filter($filter);
        } else if (Session::get('role') == SATKER) {
            $this->view->data = $d_spm1->get_hold_spm_filter($filter);
        }
        //var_dump($d_spm1->get_hold_spm_filter ($filter));

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table2());

        $this->view->render('kppn/holdSPM');

        $d_log->tambah_log("Sukses");
    }

    public function ValidasiSpm() {
        $d_spm1 = new DataValidasiUploadSPM($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        if (isset($_POST['submit_file'])) {
            if ($_POST['kdkppn'] != '') {
                $filter[$no++] = "KDKPPN = '" . $_POST['kdkppn'] . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);

                //$filter[$no++]=" creation_date in 
                //(select max(creation_date) from SPPM_AP_INV_INT_ALL where SUBSTR(OPERATING_UNIT,1,3) = ".$_POST['kdkppn']."
                //and STATUS_CODE = 'Validasi gagal') ";
            } else {
                $filter[$no++] = "KDKPPN = '" . Session::get('id_user') . "'";
            }

            if ($_POST['kdsatker'] != '') {
                $filter[$no++] = "substr(invoice_num,8,6) = '" . $_POST['kdsatker'] . "'";
                $this->view->d_satker_code = $_POST['kdsatker'];
            }
            if ($_POST['file_name'] != '') {
                $filter[$no++] = " upper(file_name) = upper('" . $_POST['file_name'] . "')";
                $this->view->d_file_name = $_POST['file_name'];
            }
            if ($_POST['tgl_awal'] != '' AND $_POST['tgl_akhir'] != '') {
                $filter[$no++] = "CREATION_DATE BETWEEN TO_DATE('" . $_POST['tgl_awal'] . " 00:00:01','DD/MM/YYYY hh24:mi:ss') AND TO_DATE('" . $_POST['tgl_akhir'] . " 23:59:59','DD/MM/YYYY hh24:mi:ss')";
                $this->view->d_tgl_awal = $_POST['tgl_awal'];
                $this->view->d_tgl_akhir = $_POST['tgl_akhir'];
            }

            $this->view->data = $d_spm1->get_validasi_spm_filter($filter);
        } else {             

            $filter[$no++] = "CREATION_DATE BETWEEN TO_DATE('01/01/" . Session::get('ta') . " 00:00:01','DD/MM/YYYY hh24:mi:ss') AND TO_DATE('31/12" . Session::get('ta') . " 23:59:59','DD/MM/YYYY hh24:mi:ss')";
            $this->view->d_tgl_awal = '01-01-'.Session::get('ta');
            $this->view->d_tgl_akhir = '31-12-'.Session::get('ta');
            
        }

        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
            $filter[$no++] = "KDKPPN IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL = '" . Session::get('id_user') . "')";
        }
        if (Session::get('role') == ADMIN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == KPPN) {
            $filter[$no++] = "KDKPPN = '" . Session::get('id_user') . "'";
            if (!isset($_POST['submit_file'])) {
                $filter[$no++] = " creation_date in 
							(select max(creation_date) from SPPM_AP_INV_INT_ALL where KDKPPN = '" . Session::get('id_user') . "'
							and STATUS_CODE = 'Validasi gagal') ";
            }
            $this->view->data = $d_spm1->get_validasi_spm_filter($filter);
        }
        if (Session::get('role') == SATKER) {
            $filter[$no++] = " SUBSTR(INVOICE_NUM,8,6) = '" . Session::get('kd_satker') . "'";
            $this->view->d_satker = Session::get('kd_satker');
            $this->view->data = $d_spm1->get_validasi_spm_filter($filter);
        }
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $d_log->tambah_log("Sukses");

        $this->view->render('kppn/validasiuploadSPM');
    }

    public function errorSpm($file_name = null) {
        $d_spm1 = new DataUploadSPM($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (!is_null($file_name)) {
            $filter[$no++] = "FILE_NAME =  '" . $file_name . ".xlsx'";
            $this->view->d_file_name = $file_name;
        }
        if (Session::get('role') == KPPN) {
            $filter[$no++] = "KDKPPN = '" . Session::get('id_user') . "'";
        }
        if (Session::get('role') == SATKER) {
            $filter[$no++] = "SUBSTR(FILE_NAME,8,6) = '" . Session::get('kd_satker') . "'";
        }
        $this->view->data = $d_spm1->get_error_spm_filter($filter);
        //var_dump($d_spm1->get_error_spm_filter ($filter));
        
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table());

        $this->view->render('kppn/uploadSPM');

        $d_log->tambah_log("Sukses");
    }

    public function HistorySpm($invoice_num1 = null, $invoice_num2 = null, $invoice_num3 = null, $sp2d = null) {
        $d_spm1 = new DataHistorySPM($this->registry);
        $filter = array();
        $invoice = '';
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));


        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }
        if (Session::get('role') == ADMIN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == KPPN) {
            $filter[$no++] = Session::get('id_user');
			$this->view->kd_kppn = $kppn;
            
        }
        /*
          if (!is_null($invoice_num1)) {
          $invoice="'".$invoice_num1."/".$invoice_num2."/".$invoice_num3."'";
          $kppn=substr($sp2d,2,3);
          $filter[$no++]= $kppn;
          $this->view->invoice_num = $invoice_num;
          $this->view->data = $d_spm1->get_history_spm_filter ($filter, $invoice);
          }
         */
        if (!is_null($invoice_num1) and Session::get('role') == KPPN) {
            $invoice = "'" . $invoice_num1 . "/" . $invoice_num2 . "/" . $invoice_num3 . "'";
            $kppn = Session::get('id_user');
            $filter[$no++] = $kppn;
            $this->view->invoice_num = $invoice_num;
            $this->view->data = $d_spm1->get_history_spm_filter($filter, $invoice);
        } elseif (!is_null($invoice_num1) and Session::get('role') == SATKER) {
            $satker = Session::get('kd_satker');
            $invoice = "'" . $invoice_num1 . "/" . $satker . "/" . $invoice_num3 . "'";
            $kppn = Session::get('id_user');
            $filter[$no++] = $kppn;
            $this->view->invoice_num = $invoice_num;
            $this->view->data = $d_spm1->get_history_spm_filter($filter, $invoice);
        } elseif (!is_null($invoice_num1) and ( Session::get('role') == KANWIL OR Session::get('role') == ADMIN)) {
            $invoice = "'" . $invoice_num1 . "/" . $invoice_num2 . "/" . $invoice_num3 . "'";
            $kppn = substr($sp2d, 2, 3);
            $filter[$no++] = $kppn;
            //$filter_kanwil = "SUBSTR(NO_SP2D,3,3) IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL = '". Session::get('id_user') . "')";
            $this->view->invoice_num = $invoice_num;
            $this->view->data = $d_spm1->get_history_spm_filter($filter, $invoice);
        }

        if (isset($_POST['submit_file'])) {

            if ($_POST['kdkppn'] != '') {
                $filter[$no++] = $_POST['kdkppn'];
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
            } else {
                $filter[$no++] = Session::get('id_user');
            }

            if ($_POST['invoice'] != '') {
                $invoice = "'" . $_POST['invoice'] . "'";
                $this->view->invoice_num = $_POST['invoice'];
            }
            $this->view->data = $d_spm1->get_history_spm_filter($filter, $invoice);
        }
        
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table9());

        //var_dump($d_spm->get_hist_spm_filter());
        $this->view->render('kppn/historySPM');
        $d_log->tambah_log("Sukses");
    }

    public function DurasiSpm() {
        $d_spm1 = new DataDurasiSPM($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
		
		/*if ((''.Session::get('ta')) == date("Y")) {
			$filter[$no++] = "TO_CHAR(tanggal_upload,'YYYY') = '2015'";
		 }
		 else {
			$filter[$no++] = "TO_CHAR(tanggal_upload,'YYYY') = '2014'";
		 }*/
		 

        if (isset($_POST['submit_file'])) {

            if ($_POST['kdkppn'] != '' AND ( $_POST['invoice'] != '' or $_POST['JenisSPM'] != '' or $_POST['kdsatker'] != '' or $_POST['JenisSPM'] != '' or $_POST['durasi'] != '' or $_POST['tgl_awal'] != '')) {

                $filter[$no++] = "KDKPPN = '" . $_POST['kdkppn'] . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
            } elseif ($_POST['kdkppn'] != '') {
                $filter[$no++] = " to_date(tanggal_upload,'dd-MM-yyyy') in (select max(to_date(tanggal_upload,'dd-MON-yyyy'))
								from DURATION_INV_ALL_V where KDKPPN = '" . $_POST['kdkppn'] . "')";
                $filter[$no++] = "KDKPPN = '" . $_POST['kdkppn'] . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
            } else {
                $filter[$no++] = "KDKPPN = '" . Session::get('id_user') . "'";
            }

            if ($_POST['invoice'] != '') {
                $filter[$no++] = "invoice_num = '" . $_POST['invoice'] . "'";
                $this->view->d_invoice = $_POST['invoice'];
            }
            if ($_POST['kdsatker'] != '') {
                $filter[$no++] = "substr(invoice_num,8,6) = '" . $_POST['kdsatker'] . "'";
                $this->view->d_kdsatker = $_POST['kdsatker'];
            }
            if ($_POST['JenisSPM'] != '') {
                $filter[$no++] = "jendok = '" . $_POST['JenisSPM'] . "'";
                $this->view->d_jendok = $_POST['JenisSPM'];
            }
            if ($_POST['durasi'] != '') {
                $this->view->d_durasi = $_POST['durasi'];
                if ($_POST['durasi'] == '1') {
                    $filter[$no++] = "durasi2 < 1";
                }
                if ($_POST['durasi'] == '2') {
                    $filter[$no++] = "durasi2 > 1 and durasi2 < 24";
                }
                if ($_POST['durasi'] == '3') {
                    $filter[$no++] = "durasi2 > 24";
                }
            }
            if ($_POST['tgl_awal'] != '' AND $_POST['tgl_akhir'] != '') {
                $filter[$no++] = "TANGGAL_UPLOAD BETWEEN to_date('" . $_POST['tgl_awal'] . "','dd-mm-yyyy') AND to_date('" . $_POST['tgl_akhir'] . "' ,'dd-mm-yyyy')";
                $this->view->d_tgl_awal = $_POST['tgl_awal'];
                $this->view->d_tgl_akhir = $_POST['tgl_akhir'];
            }
            //else {
            //$filter[$no++] = " to_date(tanggal_upload,'dd-MM-yyyy') in (select max(to_date(tanggal_upload,'dd-MON-yyyy'))
            //from DURATION_INV_ALL_V where SUBSTR(OPERATING_UNIT,1,3) = ".$_POST['kdkppn'].")" ;}

            $this->view->data = $d_spm1->get_durasi_spm_filter($filter);
        }

        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
            //$filter[$no++] = "KDKPPN IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL = '". Session::get('id_user') . "')";
        }
        if (Session::get('role') == ADMIN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == KPPN) {
            $filter[$no++] = "KDKPPN = '" . Session::get('id_user') . "'";
            if (!isset($_POST['submit_file'])) {
                $filter[$no++] = " to_date(tanggal_upload,'dd-MM-yyyy') = (select max(to_date(tanggal_upload,'dd-MON-yyyy'))
								from DURATION_INV_ALL_V where KDKPPN = '" . Session::get('id_user') . "')";
                $this->view->data = $d_spm1->get_durasi_spm_filter($filter);
            }

            //var_dump($d_spm1->get_durasi_spm_filter ($filter));
        }
        $this->view->data2 = $d_spm1->get_jendok_spm_filter();
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $this->view->render('kppn/DurasiSPM');

        $d_log->tambah_log("Sukses");
    }

    public function nmsatker() {
        $d_spm1 = new DataNamaSatker($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
		
		if ((''.Session::get('ta')) == date("Y")) {
			$filter[$no++] = "TO_CHAR(CHECK_DATE,'YYYY') = '2015'";
		 }
		 else {
			$filter[$no++] = "TO_CHAR(CHECK_DATE,'YYYY') = '2014'";
		 }
		
		
        if (isset($_POST['submit_file'])) {

            if ($_POST['kdkppn'] != '') {
                $filter[$no++] = "KDKPPN = '" . $_POST['kdkppn'] . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
            } else {
                $filter[$no++] = "KDKPPN = '" . Session::get('id_user') . "'";
            }

            if ($_POST['kdsatker'] != '') {
                $filter[$no++] = "SEGMENT1 = '" . $_POST['kdsatker'] . "'";
                $this->view->d_kd_satker = $_POST['kdsatker'];
            }
            if ($_POST['nmsatker'] != '') {
                $filter[$no++] = " UPPER(NMSATKER) LIKE UPPER('%" . $_POST['nmsatker'] . "%')";
                $this->view->d_nm_satker = $_POST['nmsatker'];
            }
            if ($_POST['tgl_awal'] != '' AND $_POST['tgl_akhir'] != '') {

                $filter[$no++] = "TO_CHAR(CREATION_DATE,'YYYYMMDD') BETWEEN '" . date('Ymd', strtotime($_POST['tgl_awal'])) . "' AND '" . date('Ymd', strtotime($_POST['tgl_akhir'])) . "'";

                $this->view->d_tgl_awal = $_POST['tgl_awal'];
                $this->view->d_tgl_akhir = $_POST['tgl_akhir'];
            }

            $this->view->data = $d_spm1->get_satker_filter($filter);
            //$this->view->render('kppn/NamaSatker');			
        }
        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
            $filter[$no++] = "KDKPPN IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL = '" . Session::get('id_user') . "')";
        }
        if (Session::get('role') == ADMIN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == KPPN) {
            $filter[$no++] = "KDKPPN = '" . Session::get('id_user') . "'";
            $this->view->data = $d_spm1->get_satker_filter($filter);
        }
        
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table2());

        //var_dump($d_spm1->get_satker_filter($filter));
        $this->view->render('kppn/NamaSatker');
        $d_log->tambah_log("Sukses");
    }

    public function daftarsp2d($kdsatker = null, $tgl1 = null, $tgl2 = null, $jendok = null) {
        $d_spm1 = new DataCheck($this->registry);
        $filter = array();
        $no = 0;
        if (is_null($kdsatker)) {
            $kdsatker = Session::get('kd_satker');
        }

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
		
		if ((''.Session::get('ta')) == date("Y")) {
			$filter[$no++] = "TO_CHAR(CHECK_DATE,'YYYY') = '2015'";
		 }
		 else {
			$filter[$no++] = "TO_CHAR(CHECK_DATE,'YYYY') = '2014'";
		 }
		 
        if ($kdsatker != '') {
            if (Session::get('role') == SATKER) {
                $filter[$no++] = " SEGMENT1 =  '" .Session::get('kd_satker'). "'";
				
            } else {
                $filter[$no++] = " SEGMENT1 =  '" . $kdsatker . "'";
                $this->view->d_kd_satker = $kdsatker;
            }
        }

        if ($tgl1 != '' AND $tgl2 != '') {
            $filter[$no++] = "CHECK_DATE BETWEEN TO_DATE('" . $tgl1 . "','DD/MM/YYYY hh:mi:ss') AND TO_DATE('" . $tgl2 . "','DD/MM/YYYY hh:mi:ss')";
            $this->view->d_tgl_awal = $tgl1;
            $this->view->d_tgl_akhir = $tgl2;
        }
		
		if ($jendok != '') {
		
            $filter[$no++] = "JENDOK = '" . $jendok . "'";
        }
		
        if (isset($_POST['submit_file'])) {
            if ($_POST['check_number'] != '') {
                $filter[$no++] = "check_number = '" . $_POST['check_number'] . "'";
                $this->view->d_invoice = $_POST['check_number'];
            }

            if ($_POST['invoice'] != '') {
                $filter[$no++] = "invoice_num = '" . $_POST['invoice'] . "'";
                $this->view->invoice = $_POST['invoice'];
            }
            if ($_POST['JenisSP2D'] != '') {
                $filter[$no++] = "JENIS_SP2D = '" . $_POST['JenisSP2D'] . "'";
                $this->view->JenisSP2D = $_POST['JenisSP2D'];
            }
            if ($_POST['JenisSPM'] != '') {
                $filter[$no++] = "JENDOK = '" . $_POST['JenisSPM'] . "'";
                $this->view->JenisSPM = $_POST['JenisSPM'];
            }
        }

        if ($_POST['tgl_awal'] != '' AND $_POST['tgl_akhir'] != '') {
            $filter[$no++] = "CHECK_DATE BETWEEN TO_DATE('" . $_POST['tgl_awal'] . "','DD/MM/YYYY hh:mi:ss') AND TO_DATE('" . $_POST['tgl_akhir'] . "','DD/MM/YYYY hh:mi:ss')";
            $this->view->d_tgl_awal = $_POST['tgl_awal'];
            $this->view->d_tgl_akhir = $_POST['tgl_akhir'];
        }
        if (Session::get('role') == KPPN) {
            $filter[$no++] = "KDKPPN = '" . Session::get('id_user') . "'";
        }
        if (Session::get('role') == SATKER) {
            $filter[$no++] = "SEGMENT1 = '" . Session::get('kd_satker') . "'";
        }
        if (Session::get('role') == KANWIL) {
            $filter[$no++] = "KDKPPN IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL = '" . Session::get('id_user') . "')";
            ;
        }

        if (kdsatker != '') {
            $this->view->data = $d_spm1->get_sp2d_satker_filter($filter);
        }

        $this->view->data2 = $d_spm1->get_jenis_spm_filter($kdsatker);

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        //var_dump($d_spm1->get_satker_filter($filter));
        if (Session::get('id_user') == 140) {
            $this->view->render('kppn/SP2DSatker140');
        } else {
            $this->view->render('kppn/SP2DSatker');
        }
        $d_log->tambah_log("Sukses");
    }

    public function RekapSp2d() {
        $d_spm1 = new DataCheck($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
		 
		 if ((''.Session::get('ta')) == date("Y")) {
			$filter[$no++] = "TO_CHAR(CHECK_DATE,'YYYY') = '2015'";
		 }
		 else {
			$filter[$no++] = "TO_CHAR(CHECK_DATE,'YYYY') = '2014'";
		 }
		 
		 
        if (isset($_POST['submit_file'])) {
            if ($_POST['kdkppn'] != '') {
                $filter[$no++] = "KDKPPN IN ( '" . $_POST['kdkppn'] . "')";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
            } elseif (Session::get('role') == KANWIL) {
                $filter[$no++] = "KDKPPN IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL = '" . Session::get('id_user') . "')";
            } elseif (Session::get('role') == ADMIN) {
                //$filter[$no++]="SUBSTR(CHECK_NUMBER,3,3) = ".Session::get('id_user');
                //$this->view->data = $d_spm1->get_sp2d_rekap_admin_filter ($filter);
            }

            if ($_POST['tgl_awal'] != '' AND $_POST['tgl_akhir'] != '') {
                $filter[$no++] = "TO_CHAR(CHECK_DATE,'YYYYMMDD') BETWEEN '" . date('Ymd', strtotime($_POST['tgl_awal'])) . "' AND '" . date('Ymd', strtotime($_POST['tgl_akhir'])) . "'";

                $this->view->d_tgl_awal = $_POST['tgl_awal'];
                $this->view->d_tgl_akhir = $_POST['tgl_akhir'];
            }
			
            //$this->view->data = $d_spm1->get_sp2d_rekap_filter ($filter);
        
		}
        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
            $this->view->data = $d_spm1->get_sp2d_rekap_kanwil_filter($filter);
            $filter[$no++] = "KDKPPN IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL = '" . Session::get('id_user') . "')";
        }
        if (Session::get('role') == ADMIN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
            $this->view->data = $d_spm1->get_sp2d_rekap_admin_filter($filter);
        }
        if (Session::get('role') == KPPN) {
            $filter[$no++] = "KDKPPN = '" . Session::get('id_user') . "'";
            $this->view->data = $d_spm1->get_sp2d_rekap_filter($filter);
        }

        if (Session::get('role') == SATKER) {
            //$filter[$no++] = "KDKPPN = '" . Session::get('id_user') . "'";
            $filter[$no++] = "SEGMENT1 = '" . Session::get('kd_satker') . "'";
            $this->view->data = $d_spm1->get_sp2d_rekap_filter($filter);
        }
        //$this->view->data = $d_spm1->get_sp2d_rekap_filter ($filter);
        //var_dump($d_spm1->get_error_spm_filter ($filter));
		
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $d_log->tambah_log("Sukses");

        $this->view->render('kppn/RekapSP2D');
    }

    public function detailrekapsp2d($jenis_spm = null, $kppn = null, $tgl_awal = null, $tgl_akhir = null) {
        $d_spm1 = new DataCheck($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
		
		if ((''.Session::get('ta')) == date("Y")) {
			$filter[$no++] = "TO_CHAR(CHECK_DATE,'YYYY') = '2015'";
		 }
		 else {
			$filter[$no++] = "TO_CHAR(CHECK_DATE,'YYYY') = '2014'";
		 }
		 
        if ($jenis_spm != '') {
            $filter[$no++] = " JENDOK =  '" . $jenis_spm . "'";
            $this->view->jendok = $jenis_spm;
        }
        if ($kppn != '' AND Session::get('role') == KANWIL AND $_POST['kdkppn'] != '') {
            $filter[$no++] = "KDKPPN IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL = '" . Session::get('id_user') . "')";
        } 
		elseif ($kppn != '') {
            $filter[$no++] = " KDKPPN =  '" . $kppn . "'";
            $this->view->kppn = $kppn;
        }
        if ($tgl_awal != '' AND $tgl_akhir != '') {

            $filter[$no++] = "TO_CHAR(CHECK_DATE,'YYYYMMDD') BETWEEN '" . date('Ymd', strtotime($tgl_awal)) . "' AND '" . date('Ymd', strtotime($tgl_akhir)) . "'";

            $this->view->d_tgl_awal = $tgl_awal;
            $this->view->d_tgl_akhir = $tgl_akhir;
        }

        if (Session::get('role') == KPPN) {
            $filter[$no++] = "KDKPPN = '" . Session::get('id_user') . "'";
        }
        if (Session::get('role') == SATKER) {
            $filter[$no++] = "SEGMENT1 = '" . Session::get('kd_satker') . "'";
            $this->view->data = $d_spm1->get_sp2d_rekap_filter($filter);
        }

        $this->view->data = $d_spm1->get_sp2d_satker_filter($filter);

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $d_log->tambah_log("Sukses");

        $this->view->render('kppn/Rekap');
    }
	/*
	public function KarwasUP() {
        $d_spm1 = new DataKarwasUP($this->registry);
		$d_spm2 = new DataCheck($this->registry);
        $filter = array();
		//$filter2 = array();
        $no = 0;
		
		//untuk mencatat log user
        $d_log = new DataLog($this->registry);
		$d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
		
		if (Session::get('role') == KPPN) {
			$this->view->data5 = $d_spm1->get_satker_up(Session::get('id_user'));
        }
		
		
		if (isset($_POST['submit_file'])) {
            if ($_POST['kdkppn'] != '') {
                $filter[$no++] = "KPPN_CODE = '" . $_POST['kdkppn']."'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
				
            } else {
                $filter[$no++] = "KPPN_CODE = '" . Session::get('id_user')."'";
            }
			
			if ($_POST['ppp'] != '') {
                //$filter[$no++] = "SATKER_CODE = '" . $_POST['kdsatker'] . "'";
				$this->view->ppp = $_POST['ppp'];
            }
			
            if ($_POST['kdsatker'] != '') {
                $filter[$no++] = "SATKER_CODE = '" . $_POST['kdsatker'] . "'";
				$this->view->nmsatker = $d_spm1->get_nama_satker_up($_POST['kdsatker']);
				$filter_up[$no++] = "SEGMENT1 = '" . $_POST['kdsatker'] . "'";
				$filter_up[$no++] = "JENDOK = '312'";
				$this->view->data3 = $d_spm2->get_karwas_up_filter($filter_up);
            }
        $this->view->data5 = $d_spm1->get_satker_up(Session::get('id_user'));
		}
		if ($_POST['kdsatker'] != '') {
		
		$this->view->data1 = $d_spm1->get_dipa_up($filter);
		$this->view->data2 = $d_spm1->get_total_up($filter);
		//$this->view->data3 = $d_spm1->get_sa_pnbp($filter);
		//$this->view->data4 = $d_spm1->get_up_pnbp($filter);
		//$this->view->data6 = $d_spm1->get_set_up_pnbp($filter);
		}
		
        //var_dump($d_spm->get_hist_spm_filter());
		
		$d_log->tambah_log("Sukses");
		
		
        $this->view->render('kppn/karwasUP');
    }
	*/
	public function KarwasUPSatker() {
        $d_spm1 = new DataKarwasUP($this->registry);
        $filter = array();
		//$filter2 = array();
        $no = 0;
		
		//untuk mencatat log user
        $d_log = new DataLog($this->registry);
		$d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
		
		if (isset($_POST['submit_file'])) {
            if ($_POST['kdkppn'] != '') {
                $filter[$no++] = "KPPN_CODE = '" . $_POST['kdkppn']."'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
				
            } else {
                $filter[$no++] = "KPPN_CODE = '" . Session::get('id_user')."'";
            }
				
            if ($_POST['kdsatker'] != '') {
                $filter[$no++] = "SATKER_CODE = '" . $_POST['kdsatker'] . "'";
				$this->view->d_kd_satker = $_POST['kdsatker'];
            }
			if ($_POST['SUMBERDANA'] != '') {
                $filter[$no++] = "SUMBER_DANA = '" . $_POST['SUMBERDANA'] . "'";
				$this->view->d_sumber_dana = $_POST['SUMBERDANA'];
            }
			$this->view->data1 = $d_spm1->get_karwas_up_satker($filter);
			$this->view->data2 = $d_spm1->get_total_sisa_up($filter);
		}
		
		if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
            
        }
        if (Session::get('role') == ADMIN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
           
        }
		
		if (Session::get('role') == KPPN) {
			$filter[$no++] = "KPPN_CODE = '" . Session::get('id_user')."'";
			$this->view->data1 = $d_spm1->get_karwas_up_satker($filter);
			$this->view->data2 = $d_spm1->get_total_sisa_up($filter);
			
        }
				
		$d_log->tambah_log("Sukses");
        $this->view->render('kppn/KarwasUPSatker');
    }
	
	public function KarwasTUPSatker() {
        $d_spm1 = new DataKarwasUP($this->registry);
        $filter = array();
		//$filter2 = array();
        $no = 0;
		
		//untuk mencatat log user
        $d_log = new DataLog($this->registry);
		$d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
		
		if (isset($_POST['submit_file'])) {
            if ($_POST['kdkppn'] != '') {
                $filter[$no++] = "KPPN_CODE = '" . $_POST['kdkppn']."'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
				
            } else {
                $filter[$no++] = "KPPN_CODE = '" . Session::get('id_user')."'";
            }
				
            if ($_POST['kdsatker'] != '') {
                $filter[$no++] = "SATKER_CODE = '" . $_POST['kdsatker'] . "'";
				$this->view->d_kd_satker = $_POST['kdsatker'];
            }
			if ($_POST['SUMBERDANA'] != '') {
                $filter[$no++] = "SUMBER_DANA = '" . $_POST['SUMBERDANA'] . "'";
				$this->view->d_sumber_dana = $_POST['SUMBERDANA'];
            }
			$this->view->data1 = $d_spm1->get_karwas_tup_satker($filter);
			$this->view->data2 = $d_spm1->get_total_sisa_tup($filter);
		}
		
		if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
            
        }
        if (Session::get('role') == ADMIN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
           
        }
		
		if (Session::get('role') == KPPN) {
			$filter[$no++] = "KPPN_CODE = '" . Session::get('id_user')."'";
			$this->view->data1 = $d_spm1->get_karwas_tup_satker($filter);			
			$this->view->data2 = $d_spm1->get_total_sisa_tup($filter);
        }	
		
		$d_log->tambah_log("Sukses");
        $this->view->render('kppn/KarwasTUPSatker');
    }
	
	public function UPSatker($sumber_dana, $kd_satker, $jendok) {
        $d_spm1 = new DataKarwasUP($this->registry);
        $filter = array();
		//$filter2 = array();
        $no = 0;
		
		//untuk mencatat log user
        $d_log = new DataLog($this->registry);
		$d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
		
		if (Session::get('role') == KPPN) {
			$filter[$no++] = "KPPN_CODE = '" . Session::get('id_user')."'";
        }
		if ($kd_satker != '') {
            if (Session::get('role') == SATKER) {
                $filter[$no++] = " SATKER_CODE =  '" . Session::get('kd_satker'). "'";
            } else {
                $filter[$no++] = " SATKER_CODE =  '" . $kd_satker . "'";
                $this->view->d_kd_satker = $kd_satker;
            }
			$this->view->nmsatker = $d_spm1->get_nama_satker_up($kd_satker);
        }
		if ($jendok == 'UP') {
                $filter[$no++] = " JENIS_SPM = 'UP'";
				$this->view->jendok = $jendok;
        }
		else {
				$filter[$no++] = " JENIS_SPM = 'GUP NIHIL'";
				
		}
		
		if($sumber_dana != '') {
			 $filter[$no++] = " SUMBER_DANA =  '" . $sumber_dana. "'";
			
		}

		$this->view->data1 = $d_spm1->get_total_up($filter);
		
        //var_dump($d_spm->get_hist_spm_filter());
		
		$d_log->tambah_log("Sukses");
        $this->view->render('kppn/DetailUP');
    }
    //author by jhon
	
	public function TUPSatker($sumber_dana, $kd_satker, $tgl1 = null, $tgl2 = null) {
        $d_spm1 = new DataKarwasUP($this->registry);
        $filter = array();
		//$filter2 = array();
        $no = 0;
		
		//untuk mencatat log user
        $d_log = new DataLog($this->registry);
		$d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
		
		if (Session::get('role') == KPPN) {
			$filter[$no++] = "KPPN_CODE = '" . Session::get('id_user')."'";
        }
		if ($kd_satker != '') {
            if (Session::get('role') == SATKER) {
                $filter[$no++] = " SATKER_CODE =  '" . Session::get('kd_satker'). "'";
            } else {
                $filter[$no++] = " SATKER_CODE =  '" . $kd_satker . "'";
                $this->view->d_kd_satker = $kd_satker;
            }
			$this->view->nmsatker = $d_spm1->get_nama_satker_up($kd_satker);
        }
		if($sumber_dana != '') {
			 $filter[$no++] = " SUMBER_DANA =  '" . $sumber_dana. "'";
			$this->view->sumber_dana = $sumber_dana;
		}
		
		if ($tgl1 != '' AND $tgl2 != '') {
            $filter[$no++] = "CHECK_DATE BETWEEN TO_DATE('" . $tgl1 . "','DD/MM/YYYY hh:mi:ss') AND TO_DATE('" . $tgl2 . "','DD/MM/YYYY hh:mi:ss')";
            $this->view->d_tgl_awal = $tgl1;
            $this->view->d_tgl_akhir = $tgl2;
        }
		
		
		$this->view->data1 = $d_spm1->get_total_tup($filter);
		
        //var_dump($d_spm->get_hist_spm_filter());
		
		$d_log->tambah_log("Sukses");
        $this->view->render('kppn/DetailTUP');
    }
	
	
	
	public function Konversi() {
        $d_spm1 = new DataADKKonversi($this->registry);
        $filter = array();
		//$filter2 = array();
        $no = 0;
		
		//untuk mencatat log user
        $d_log = new DataLog($this->registry);
		$d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
		if (isset($_POST['submit_file'])) {
            if ($_POST['kdkppn'] != '') {
                $filter[$no++] = "KDKPPN = '" . $_POST['kdkppn']."'";
				$kppn = "AND KDKPPN = '".$_POST['kdkppn']."'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
				
            } 
			if (Session::get('role') == KANWIL){
			$filter[$no++] = "KDKPPN IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL = '" . Session::get('id_user') . "')";
			$kppn = "AND KDKPPN IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL = '" . Session::get('id_user') . "')";
			}
			$this->view->data = $d_spm1->get_adk_konversi($filter , $kppn);
			$this->view->data1 = $d_spm1->get_jml_adk_konversi($filter);
		}
		if (Session::get('role') == KPPN) {
			$filter[$no++] = "KDKPPN = '" . Session::get('id_user')."'";
			$kppn = "AND KDKPPN ='".Session::get('id_user')."'";
			$this->view->data = $d_spm1->get_adk_konversi($filter , $kppn );
			$this->view->data1 = $d_spm1->get_jml_adk_konversi($filter);
        }
		
		if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));           
        }
        if (Session::get('role') == ADMIN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
		
		
		$d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table());
		
        //var_dump($d_spm1->get_adk_konversi(filter));
		
		$d_log->tambah_log("Sukses");
        $this->view->render('kppn/KonversiSPM');
    }
	
    public function __destruct() {
        
    }

}
