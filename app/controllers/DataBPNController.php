<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataBPNController extends BaseController {
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

    public function DataBPN() {
        $d_bpn = new DataBPN($this->registry);
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
            if (Session::get('id_user')=='183'){
                $filter[$no++] = "KDKPPN = 'PNR'";    
            } else {
                $filter[$no++] = "KDKPPN = '" . Session::get('id_user') . "'";
            }
        }
        if (Session::get('role') == SATKER) {
            $filter[$no++] = "substr(no_spm,8,6) = '" . Session::get('id_user') . "'";
        }
        if (isset($_POST['submit_file'])) {
            if ($_POST['kdkppn'] != '') {
                if ($_POST['kdkppn'] != 'SEMUA KPPN') {
                    if ($_POST['kdkppn']=='183'){
                        $filter[$no++] = "KDKPPN = 'PNR'";    
                    } else {
                        $filter[$no++] = "KDKPPN = '" . $_POST['kdkppn'] . "'";
                    }
                    $d_kppn = new DataUser($this->registry);
                    $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
                    $this->view->d_kd_kppn = $_POST['kdkppn'];
                }
            } else {
                $filter[$no++] = "KDKPPN = '" . Session::get('id_user') . "'";
            }
            
            if ($_POST['spm'] != '') {
                $filter[$no++] = "NO_SPM = UPPER('" . $_POST['spm'] . "')";
                $this->view->d_spm = $_POST['spm'];
            }
            
            if ($_POST['nosp2d'] != '') {
                $filter[$no++] = "NO_SP2D = '" . $_POST['nosp2d'] . "'";
                $this->view->d_sp2d = $_POST['nosp2d'];
            }
            
            if ($_POST['kdsatker'] != '') {
                $filter[$no++] = "substr(no_spm,8,6) = '". $_POST['kdsatker'] ."'";
                $this->view->d_kdsatker = $_POST['kdsatker'];
            }
            
            if ($_POST['tgl_awal'] != '' AND $_POST['tgl_akhir'] != '') {
                $filter[$no++] = "TO_DATE(TGL_SPM,'YYYYMMDD') BETWEEN TO_DATE ('" . date('Ymd', strtotime($_POST['tgl_awal'])) . "','YYYYMMDD') AND TO_DATE ('" . date('Ymd', strtotime($_POST['tgl_akhir'])) . "','YYYYMMDD')  ";
                $this->view->d_tgl_awal = $_POST['tgl_awal'];
                $this->view->d_tgl_akhir = $_POST['tgl_akhir'];
            }
            $this->view->data = $d_bpn->get_bpn_filter($filter);
        }
        $this->view->page_title = "Monitoring Potongan SPM (Satker Pembayar)";
        
        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_bpn->get_table());

        $this->view->render('kppn/daftarBpn');
        $d_log->tambah_log("Sukses");
    }

    public function DataBPNSatker() {
        $d_bpn = new DataBPN($this->registry);
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
            $filter[$no++] = "KDKPPN = '" . Session::get('id_user') . "'";
        }    
        if ($_POST['kdsatker'] != '') {
            $filter[$no++] = "SATKER = '". $_POST['kdsatker'] ."'";
            $this->view->d_kdsatker = $_POST['kdsatker'];
        }
        if (isset($_POST['submit_file'])) {
            if ($_POST['kdkppn'] != '') {
                if ($_POST['kdkppn'] != 'SEMUA KPPN') {
                    $filter[$no++] = "KDKPPN = '" . $_POST['kdkppn'] . "'";
                    $d_kppn = new DataUser($this->registry);
                    $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
                    $this->view->d_kd_kppn = $_POST['kdkppn'];
                }
            } else {
                $filter[$no++] = "KDKPPN = '" . Session::get('id_user') . "'";
            }
            
            if ($_POST['spm'] != '') {
                $filter[$no++] = "NO_SPM = UPPER('" . $_POST['spm'] . "')";
                $this->view->d_spm = $_POST['spm'];
            }
            
            if ($_POST['nosp2d'] != '') {
                $filter[$no++] = "NO_SP2D = '" . $_POST['nosp2d'] . "'";
                $this->view->d_sp2d = $_POST['nosp2d'];
            }
            
            if ($_POST['kdsatker'] != '') {
                $filter[$no++] = "SATKER = '". $_POST['kdsatker'] ."'";
                $this->view->d_kdsatker = $_POST['kdsatker'];
            }
            
            if ($_POST['tgl_awal'] != '' AND $_POST['tgl_akhir'] != '') {
                $filter[$no++] = "TO_DATE(TGL_SPM,'YYYYMMDD') BETWEEN TO_DATE ('" . date('Ymd', strtotime($_POST['tgl_awal'])) . "','YYYYMMDD') AND TO_DATE ('" . date('Ymd', strtotime($_POST['tgl_akhir'])) . "','YYYYMMDD')  ";
                $this->view->d_tgl_awal = $_POST['tgl_awal'];
                $this->view->d_tgl_akhir = $_POST['tgl_akhir'];
            }
            $this->view->data = $d_bpn->get_bpn_satker_filter($filter);
        }
        $this->view->page_title = "Monitoring Potongan SPM (Satker Penerima)";
        
        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_bpn->get_table());

        $this->view->render('kppn/daftarBPNSatker');
        $d_log->tambah_log("Sukses");
    }

    public function __destruct() {
        
    }

}
