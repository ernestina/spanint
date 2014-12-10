<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataGRController extends BaseController {
    /*
     * Konstruktor
     */

    public function __construct($registry) {
        parent::__construct($registry);
    }

    /*
     * Index
     */

    public function GR_PFK() {
        $d_spm1 = new DataPFK($this->registry);
        $filter = array();
        $bulan = '';
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
            $filter[$no++] = "KPPN = '" . Session::get('id_user') . "'";
            $bulan = strtolower(Tanggal::bulan_indo(date("m")));
            $this->view->d_bulan = $bulan;
        }
        if (isset($_POST['submit_file'])) {
            if ($_POST['bulan'] != '') {
                $bulan = $_POST['bulan'];
                $this->view->d_bulan = $_POST['bulan'];
            }
            if ($_POST['kdkppn'] != '') {
                if ($_POST['kdkppn'] != 'SEMUA KPPN') {
                    $filter[$no++] = "KPPN = '" . $_POST['kdkppn'] . "'";
                    $d_kppn = new DataUser($this->registry);
                    $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
                    $this->view->d_kd_kppn = $_POST['kdkppn'];
                }
            } else {
                $filter[$no++] = "KPPN = '" . Session::get('id_user') . "'";
            }
        }
        $this->view->data = $d_spm1->get_gr_pfk_filter($filter, $bulan);
        
        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $this->view->render('kppn/test');
        $d_log->tambah_log("Sukses");
    }

    public function GR_PFK_DETAIL($akun = null, $bulan = null, $kppn = null) {
        $d_spm1 = new DataPFK_DETAIL($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (!is_null($akun)) {
            $filter[$no++] = "akun =  '" . $akun . "'";
            $this->view->d_tgl = $akun;
        }
        if (!is_null($bulan)) {
            $filter[$no++] = "TRIM(to_char(tanggal_buku,'month')) =  '" . strtolower(Tanggal::bulan_indo_eng($bulan)) . "'";
            $this->view->bulan = $bulan;
        }
        if (!is_null($kppn)) {
            if ($kppn != 'SEMUA') {
                $filter[$no++] = "KPPN =  '" . $kppn . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kppn);
            }
        }
        if (Session::get('role') == KPPN) {
            $filter[$no++] = "KPPN = '" . Session::get('id_user') . "'";
        }
        $this->view->data = $d_spm1->get_gr_pfk_detail_filter($filter);
        
        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        //var_dump($d_spm->get_gr_status_filter($filter));
        $this->view->render('kppn/GR_PFK');
        $d_log->tambah_log("Sukses");
    }

    public function GR_IJP() {
        $d_spm1 = new DataGR_IJP($this->registry);
        $filter = array();
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
            $filter[$no++] = "KPPN = '" . Session::get('id_user') . "'";
        }
        if (isset($_POST['submit_file'])) {
            if ($_POST['bulan'] != '') {
                $filter[$no++] = "BULAN = '" . $_POST['bulan'] . "'";
                $this->view->d_bulan = $_POST['bulan'];
            }
            if ($_POST['kdkppn'] != '') {
                $filter[$no++] = "KPPN = '" . $_POST['kdkppn'] . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
                $this->view->d_kd_kppn = $_POST['kdkppn'];
            } else {
                $filter[$no++] = "KPPN = '" . Session::get('id_user') . "'";
            }
        } else {
            $filter[$no++] = "BULAN = '" . date('m', time()) . "'";
            $this->view->d_bulan = date('m', time());
            $this->view->data = $d_spm1->get_gr_ijp_filter($filter);
        }

        $this->view->data = $d_spm1->get_gr_ijp_filter($filter);
        
        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        $this->view->render('kppn/GR_IJP');
        $d_log->tambah_log("Sukses");
    }

    public function GR_STATUS_LHP() {
        $d_spm1 = new DataGR_STATUS_LHP($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (isset($_POST['submit_file'])) {
            if ($_POST['bulan'] != '') {
                if ($_POST['bulan'] != 'SEMUA_BULAN') {
                    $filter[$no++] = "BULAN = '" . $_POST['bulan'] . "'";
                }
                $this->view->d_bulan = $_POST['bulan'];
            }
        } else {
            $filter[$no++] = "BULAN = '" . date('m', time()) . "'";
            $this->view->d_bulan = date('m', time());
        }

        $this->view->data = $d_spm1->get_gr_status_lhp_filter($filter);
        
        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        //var_dump($d_spm->get_gr_status_filter($filter));
        $this->view->render('kppn/statusGR_LHP');
        $d_log->tambah_log("Sukses");
    }

    public function grStatusHarian() {
        $d_spm1 = new DataGR_IJP($this->registry);
        $filter = array();
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
            $filter[$no++] = "a.KPPN = '" . Session::get('id_user') . "'";
            $this->view->jml_rek = $d_spm1->get_jml_rek_dep(Session::get('id_user'));
            $this->view->data = $d_spm1->get_gr_status_harian($filter);
        }
        if (isset($_POST['submit_file'])) {
            if ($_POST['kdkppn'] != '') {
                $filter[$no++] = "a.KPPN = '" . $_POST['kdkppn'] . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
            } else {
                $filter[$no++] = "a.KPPN = '" . Session::get('id_user') . "'";
            }
            $this->view->jml_rek = $d_spm1->get_jml_rek_dep($_POST['kdkppn']);
            $this->view->data = $d_spm1->get_gr_status_harian($filter);
        }
        
        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table());

        $this->view->render('kppn/GRStatusHarian');
        $d_log->tambah_log("Sukses");
    }
    
    public function grStatusHarianBulan() {
        $d_spm1 = new DataGR_IJP($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
        
        $d_kppn = new DataUser($this->registry);
        $this->view->kppn_list = $d_kppn->get_kppn_kanwil();
        
        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
            $kppnya='';
            foreach ($kppn_list as $value1) {
                $kppnya .= "'".$value1->get_kd_d_kppn()."',";
            }
            $filter[$no++] = " a.kppn in (".$kppnya."'0') ";
        }
        
        if (isset($_POST['submit_file'])) {
            if ($_POST['bulan'] != '') {
                if ($_POST['bulan'] != 'SEMUA_BULAN') {
                    $filter[$no++] = "a.BULAN = '" . $_POST['bulan'] . "'";
                }
                $this->view->d_bulan = $_POST['bulan'];
            }
        } else {
            $filter[$no++] = "a.BULAN = '" . date('m', time()) . "'";
            //$filter[$no++] = "BULAN = '11'";
            $this->view->d_bulan = date('m', time());
        }
        
        
        //$this->view->jml_rek = $d_spm1->get_jml_rek_dep($_POST['kdkppn']);
        $this->view->data = $d_spm1->get_gr_status_harian($filter);
        
        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table());

        $this->view->render('kppn/GRStatusHarianBulan');
        $d_log->tambah_log("Sukses");
    }

    public function detailLhpRekap($tgl = null, $kppn = null) {
        $d_spm1 = new DataGR_STATUS($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (!is_null($tgl)) {
            $filter[$no++] = "CONT_GL_DATE =  '" . $tgl . "'";
            $this->view->d_tgl = substr($tgl, 6, 2) . "-" . substr($tgl, 4, 2) . "-" . substr($tgl, 0, 4);
        }
        if (!is_null($kppn)) {
            $filter[$no++] = "KDKPPN = '" . $kppn . "'";
            $this->view->kppn = $kppn;
            //$this->view->d_tgl = substr($tgl, 6, 2)."-".substr($tgl, 4, 2)."-".substr($tgl, 0, 4);
        } else {
            $filter[$no++] = "KDKPPN = '" . Session::get('id_user') . "'";
            $this->view->kppn = Session::get('id_user');
        }
        $this->view->data = $d_spm1->get_detail_lhp_rekap($filter);
        
        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        //var_dump($d_spm->get_gr_status_filter($filter));
        $this->view->render('kppn/detailLhpRekap');
        $d_log->tambah_log("Sukses");
    }

    public function detailPenerimaan($file_name = null, $kppn = null) {
        $d_spm1 = new DataGR_STATUS($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (!is_null($file_name)) {
            $filter[$no++] = "FILE_NAME =  '" . $file_name . "' AND ";
            $this->view->d_tgl = $file_name;
        }
        if (!is_null($kppn)) {
            $filter[$no++] = "KDKPPN = '" . $kppn . "'";
            $this->view->kppn = $kppn;
        } else {
            $filter[$no++] = "KDKPPN = '" . Session::get('id_user') . "'";
            $this->view->kppn = Session::get('id_user');
        }
        $this->view->data = $d_spm1->get_detail_penerimaan($filter);
        
        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());

        //var_dump($d_spm->get_gr_status_filter($filter));
        $this->view->render('kppn/detailPenerimaan');
        $d_log->tambah_log("Sukses");
    }

    public function detailCoAPenerimaan($ntpn = null) {
        $d_spm1 = new DataGR_STATUS($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (!is_null($ntpn)) {
            $filter[$no++] = "RECEIPT_NUMBER =  '" . $ntpn . "'";
            $this->view->d_tgl = $ntpn;
        }
        // if (!is_null($kppn)) {
        // $filter[$no++] = "KDKPPN = '" . $kppn . "'";
        // $this->view->kppn = $kppn;
        // } else {
        // $filter[$no++] = "KDKPPN = '" . Session::get('id_user') . "'";
        // $this->view->kppn =  Session::get('id_user');
        // }
        $this->view->data = $d_spm1->get_detail_coa_penerimaan($filter);
        
        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya("SPGR_MPN_COA");

        //var_dump($d_spm->get_gr_status_filter($filter));
        $this->view->render('kppn/detailCoAPenerimaan');
        $d_log->tambah_log("Sukses");
    }

    public function KonfirmasiPenerimaan() {
        $d_spm1 = new DataGR_STATUS($this->registry);
        $filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));
		
		/* if (Session::get('role') == SATKER) {
            $filter[$no++] = "SUBSTR(INVOICE_NUM,8,6) = '" . Session::get('kd_satker') . "'";
            $this->view->data = $d_spm1->get_sp2d_rekap_filter($filter);
        }
		 */
		$this->view->data2 = $d_spm1->get_akun_pnbp($filter);
        if (isset($_POST['submit_file'])) {

            if ($_POST['ntpn'] != '') {
                $filter[$no++] = "RECEIPT_NUMBER = '" . $_POST['ntpn'] . "'";
                $this->view->ntpn = $_POST['ntpn'];
            } 
			
			if ($_POST['akun'] != '') {
			
				if (Session::get('role') == SATKER) {
					$filter[$no++] = $filter[$no++] = "SEGMENT1 = '" . Session::get('kd_satker') . "'";
					
				}
			
                $filter[$no++] = "SEGMENT3 = '" . $_POST['akun'] . "'";
				$filter[$no++] = "SEGMENT2 = '" . Session::get('id_user') . "'";
                $this->view->akun = $_POST['akun'];
            } 
			
			$this->view->data = $d_spm1->get_konfirmasi_penerimaan($filter);

        }
           
           // $this->view->data = $d_spm1->get_konfirmasi_penerimaan($filter);
        
        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table2());
			
        $this->view->render('kppn/konfirmasi_penerimaan');
        $d_log->tambah_log("Sukses");
    }

    public function NTPNGanda() {
        $d_spm1 = new DataGR_STATUS($this->registry);
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
                $this->view->d_kd_kppn = $_POST['kdkppn'];
            }
            if ($_POST['bulan'] != '') {
                $filter[$no++] = "SUBSTR(BULAN,1,2) = '" . $_POST['bulan'] . "'";
                $this->view->d_bulan = $_POST['bulan'];
            }
        }

        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
            $this->view->data = $d_spm1->get_ntpn_ganda($filter);
        }
        if (Session::get('role') == ADMIN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
            $this->view->data = $d_spm1->get_ntpn_ganda($filter);
        }
        if (Session::get('role') == KPPN) {
            $filter[$no++] = "KDKPPN = '" . Session::get('id_user') . "'";
            $this->view->data = $d_spm1->get_ntpn_ganda($filter);
        }

        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table3());
        
        $this->view->render('kppn/ntpn_ganda');
        $d_log->tambah_log("Sukses");
    }

    public function DetailNTPNGanda($ntpn) {
        $d_spm1 = new DataGR_STATUS($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));


        if (Session::get('role') == KPPN) {
            $filter[$no++] = "SUBSTR(RESP_NAME,1,3) = '" . Session::get('id_user') . "'";
        }

        if (Sntpn != '') {

            $filter[$no++] = "NTPN = '" . $ntpn . "'";
        }

        $this->view->data = $d_spm1->get_detail_ntpn_ganda($filter);

        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table4());

        $this->view->render('kppn/detail_ntpn_ganda');
        $d_log->tambah_log("Sukses");
    }

    public function downloadkonfirmasi() {
        $d_spm1 = new DataGR_STATUS($this->registry);
        //$filter = array();
        $no = 0;

        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

        if (count($_POST['checkbox1']) != 0) {
            $array = array("checkbox" => $_POST['checkbox1']);
            $ids = implode("','", $array['checkbox']);

            $this->view->data = $d_spm1->get_download_koreksi_penerimaan($ids);

            $this->view->load('kppn/downloadkoreksi');
        }

        if (count($_POST['checkbox2']) != 0) {
            $array = array("checkbox" => $_POST['checkbox2']);
            $ids = implode("','", $array['checkbox']);

            if (Session::get('role') == KPPN) {
                $segment1 = "(SELECT KDSATKER FROM T_SATKER WHERE SATKER_BUN = 'Y' AND KPPN = '" . Session::get('id_user') . "') SEGMENT1,";
            }
            if (Session::get('role') == SATKER) {
                $segment1 = "(SELECT KDSATKER FROM T_SATKER WHERE KDSATKER = '" . Session::get('kd_satker') . "') SEGMENT1,";
            }

            $this->view->data1 = $d_spm1->get_download_konfirmasi_penerimaan($ids, $segment1);

            $this->view->load('kppn/downloadkonfirmasi');
        }
        if (count($_POST['checkbox2']) != 0 and count($_POST['checkbox1']) != 0) {
            echo "<script>alert ('Belum ada yang dipilih (centang/checkmark))</script>";
            header('location:' . URL . 'DataGR/KonfirmasiPenerimaan');
        }
        
        $d_log->tambah_log("Sukses");
        

        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table2());
    }

    public function SuspendSatkerPenerimaan() {
        $d_spm1 = new DataGR_STATUS($this->registry);
        $filter = array();
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
            $filter[$no++] = "SEGMENT1 = 'ZZZ" . Session::get('id_user') . "'";
        }

        if (isset($_POST['submit_file'])) {

            if ($_POST['kdkppn'] != '') {
                $filter[$no++] = "SEGMENT1 = 'ZZZ" . $_POST['kdkppn'] . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
                $this->view->d_kd_kppn = $_POST['kdkppn'];
            } else {
                $filter[$no++] = "SEGMENT1 = 'ZZZ" . Session::get('id_user') . "'";
            }

            if ($_POST['bulan'] != '') {
                $filter[$no++] = "SUBSTR(TANGGAL,4,3) = '" . $_POST['bulan'] . "'";
                $this->view->d_bulan = $_POST['bulan'];
            }

            if ($_POST['ntpn'] != '') {
                $filter[$no++] = "RECEIPT_NUMBER = '" . $_POST['ntpn'] . "'";
                $this->view->ntpn = $_POST['ntpn'];
            }

            $this->view->data = $d_spm1->get_konfirmasi_penerimaan($filter);
        }
        
        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table2());

        //var_dump($d_spm->get_gr_status_filter($filter));

        $this->view->render('kppn/suspend_satker_penerimaan');
        $d_log->tambah_log("Sukses");
    }

    public function SuspendAkunPenerimaan() {
        $d_spm1 = new DataGR_STATUS($this->registry);
        $filter = array();
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
            $filter[$no++] = "SEGMENT2 = '" . Session::get('id_user') . "'";
            $filter[$no++] = "SEGMENT3 = '498111'";
            $this->view->data = $d_spm1->get_konfirmasi_penerimaan($filter);
        }
        if (isset($_POST['submit_file'])) {

            if ($_POST['kdkppn'] != '') {
                $filter[$no++] = "SEGMENT2 = '" . $_POST['kdkppn'] . "'";
                $filter[$no++] = "SEGMENT3 = '498111'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
                $this->view->d_kd_kppn = $_POST['kdkppn'];
            } else {
                $filter[$no++] = "SEGMENT2 = '" . Session::get('id_user') . "'";
                $filter[$no++] = "SEGMENT3 = '498111'";
            }

            if ($_POST['bulan'] != '') {
                $filter[$no++] = "SUBSTR(TANGGAL,4,3) = '" . $_POST['bulan'] . "'";
                $this->view->d_bulan = $_POST['bulan'];
            }
            $this->view->data = $d_spm1->get_konfirmasi_penerimaan($filter);
        }
        
        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table2());

        //var_dump($d_spm->get_gr_status_filter($filter));

        $this->view->render('kppn/suspend_akun_penerimaan');
        $d_log->tambah_log("Sukses");
    }

    public function __destruct() {
        
    }

}
