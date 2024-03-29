<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataDropingController extends BaseController {
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

    public function monitoringDroping() {
        $d_sppm = new DataDroping($this->registry);
        $filter = array();
        $no = 0;
		
		//untuk mencatat log user
        $d_log = new DataLog($this->registry);
		$d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
        
        if (Session::get('role') == BANK) {
            $filter[$no++] = "BANK = '" . Session::get('kd_satker') . "' ";
            $this->view->d_bank = Session::get('kd_satker');
            $tgl_awal = date('Ymd');
            $tgl_akhir = date('Ymd');
            $this->view->data = $d_sppm->get_droping_filter($filter);
        }
		
        if (isset($_POST['submit_file'])) {
            if ($_POST['bank'] != '') {
                if ($_POST['bank'] != 'SEMUA') {
                    $filter[$no++] = "BANK = '" . $_POST['bank'] . "' ";
                }
                $this->view->d_bank = $_POST['bank'];
            }
            if ($_POST['tgl_awal'] != '' AND $_POST['tgl_akhir'] != '') {
                $tgl_awal = $_POST['tgl_awal'];
                $tgl_akhir = $_POST['tgl_akhir'];
                $this->view->d_tgl_awal = $tgl_awal;
                $this->view->d_tgl_akhir = $tgl_akhir;
            }
            $filter[$no++] = "NVL(PAYMENT_DATE,CREATION_DATE) BETWEEN TO_DATE ('" . date('Ymd', strtotime($tgl_awal)) .
                                "','YYYYMMDD') AND TO_DATE ('" . date('Ymd', strtotime($tgl_akhir)) . "','YYYYMMDD') ";
            $this->view->data = $d_sppm->get_droping_filter($filter);
        }
        if (Session::get('role') == ADMIN OR Session::get('role') == PKN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }
        
        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_sppm->get_table());

        $this->view->render('pkn/droping');
		
		$d_log->tambah_log("Sukses");
    }

    public function detailDroping($id = null, $bank = null, $tanggal = null) {
        $d_sppm = new DataDroping($this->registry);
        $filter = array();
        $no = 0;
        
        
        if (Session::get('role') == BANK) {
            $filter[$no++] = "BANK = '" . Session::get('kd_satker') . "' ";
            $this->view->d_bank = Session::get('kd_satker');
            //var_dump(Session::get('role'));
        }
		
		//untuk mencatat log user
        $d_log = new DataLog($this->registry);
		$d_log->set_activity_time_start(date("d-m-Y h:i:s"));
		
        if (!is_null($id)) {
            $filter[$no++] = "ID_DETAIL = '" . $id . "'";
            $this->view->d_id = $id;
        }
        if (!is_null($bank)) {
            if ($bank != "SEMUA") {
                $filter[$no++] = "BANK = '" . $bank . "'";
            }
            $this->view->d_bank = $bank;
        }
        /* buka ketika iqbal dah nambahin kolom payment date di db
        if (!is_null($tanggal)) {
            $filter[$no++] = "TO_CHAR(NVL(PAYMENT_DATE,CREATION_DATE),'DD-MM-YYYY') = '" . $tanggal . "'";
            $this->view->d_tanggal = $tanggal;
        }
        */
        $this->view->data = $d_sppm->get_droping_detail_filter($filter);

        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_sppm->get_table1());

        $this->view->render('pkn/dropingDetail');
		
		$d_log->tambah_log("Sukses");
    }
    
    public function detailSPAN($bank = null, $tanggal = null) {
        $d_sppm = new DataDroping($this->registry);
        $filter = array();
        $no = 0;
        
        
        if (Session::get('role') == BANK) {
            $filter[$no++] = "BANK = '" . Session::get('kd_satker') . "' ";
            $this->view->d_bank = Session::get('kd_satker');
            //var_dump(Session::get('role'));
        }
		
		//untuk mencatat log user
        $d_log = new DataLog($this->registry);
		$d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
        if (!is_null($bank)) {
            if ($bank != "SEMUA") {
                $filter[$no++] = "BANK = '" . $bank . "'";
            }
            $this->view->d_bank = $bank;
        }
        if (!is_null($tanggal)) {
            $filter[$no++] = "PAYMENT_DATE = TO_DATE('" . $tanggal . "','DD-MM-YYYY')";
            $this->view->d_tanggal = $tanggal;
        }
        $this->view->data = $d_sppm->get_droping_detail_span_filter($filter,$tanggal);

        // untuk mengambil data last update 
        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_sppm->get_table2());

        $this->view->render('pkn/dropingDetailSPAN');
		
		$d_log->tambah_log("Sukses");
    }

    public function __destruct() {
        
    }

}
