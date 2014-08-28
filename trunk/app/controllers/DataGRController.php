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
            $filter[$no++] = "TRIM(to_char(tanggal_bayar,'month')) =  '" . $bulan . "'";
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
            $filter[$no++] = "KPPN = '" . Session::get('id_user') . "'";
            $this->view->jml_rek = $d_spm1->get_jml_rek_dep(Session::get('id_user'));
            $this->view->data = $d_spm1->get_gr_status_harian($filter);
        }
        if (isset($_POST['submit_file'])) {
            if ($_POST['kdkppn'] != '') {
                $filter[$no++] = "KPPN = '" . $_POST['kdkppn'] . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
            } else {
                $filter[$no++] = "KPPN = '" . Session::get('id_user') . "'";
            }
            $this->view->jml_rek = $d_spm1->get_jml_rek_dep($_POST['kdkppn']);
            $this->view->data = $d_spm1->get_gr_status_harian($filter);
        }

        $this->view->render('kppn/GRStatusHarian');
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
			$this->view->kppn =  Session::get('id_user');
        }
        $this->view->data = $d_spm1->get_detail_lhp_rekap($filter);
		
        //var_dump($d_spm->get_gr_status_filter($filter));
        $this->view->render('kppn/detailLhpRekap');
		$d_log->tambah_log("Sukses");
    }

    public function detailPenerimaan($file_name = null,$kppn=null) {
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
			$this->view->kppn =  Session::get('id_user');
        }
        $this->view->data = $d_spm1->get_detail_penerimaan($filter);
		
        //var_dump($d_spm->get_gr_status_filter($filter));
        $this->view->render('kppn/detailPenerimaan');
		$d_log->tambah_log("Sukses");
    }

    public function __destruct() {
        
    }

}
