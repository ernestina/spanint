<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataPNBPController extends BaseController {
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

    public function KarwasPNBP() {
        $d_spm1 = new DataPNBP($this->registry);
        $filter = array();
        $no = 0;
		
		//untuk mencatat log user
        $d_log = new DataLog($this->registry);
		$d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
		
		if (Session::get('role') == KPPN) {
			$this->view->data5 = $d_spm1->get_satker_pnbp(Session::get('id_user'));
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
				$this->view->nmsatker = $d_spm1->get_nama_satker_pnbp($_POST['kdsatker']);
            }
        $this->view->data5 = $d_spm1->get_satker_pnbp(Session::get('id_user'));
		}
		if ($_POST['kdsatker'] != '') {
		
		$this->view->data1 = $d_spm1->get_dipa_pnbp($filter);
		$this->view->data2 = $d_spm1->get_gr_pnbp($filter);
		$this->view->data3 = $d_spm1->get_sa_pnbp($filter);
		$this->view->data4 = $d_spm1->get_up_pnbp($filter);
		$this->view->data6 = $d_spm1->get_set_up_pnbp($filter);
		}
		
        //var_dump($d_spm->get_hist_spm_filter());
		
		$d_log->tambah_log("Sukses");
		
		
        $this->view->render('kppn/karwasPNBP');
    }

    public function DetailDipaPNBP($akun, $satker) {
        $d_spm1 = new DataPNBP($this->registry);
        $filter = array();
        $no = 0;
		//untuk mencatat log user
        $d_log = new DataLog($this->registry);
		$d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
		if (Session::get('role') == KPPN) {
            $filter[$no++] = "KPPN_CODE = '" . Session::get('id_user')."'";
            $this->view->d_kppn = Session::get('id_user');
        }
		
		if ($akun != '') {
			$filter[$no++] = "SUBSTR(ACCOUNT_CODE,1,2) = '" . $akun."'";
        }
		if ($satker != '') {
			$filter[$no++] = "SATKER_CODE = '" . $satker."'";
			$this->view->nmsatker = $d_spm1->get_nama_satker_pnbp($satker);
			
        }
		
		$this->view->data = $d_spm1->get_pnbp_dipa_line($filter);
		
		$d_log->tambah_log("Sukses");
		
        $this->view->render('kppn/detail_dipa_pnbp');
    }


    public function DetailGRPNBP($akun, $satker) {
        $d_spm1 = new DataPNBP($this->registry);
        $filter = array();
        $no = 0;
		//untuk mencatat log user
        $d_log = new DataLog($this->registry);
		$d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
        if (Session::get('role') == KPPN) {
            $filter[$no++] = "KPPN_CODE = '" . Session::get('id_user')."'";
            $this->view->d_kppn = Session::get('id_user');
			
        }
        if ($akun != '') {
			$filter[$no++] = "ACCOUNT_CODE = '" . $akun."'";
        }
		if ($satker != '') {
			$filter[$no++] = "SATKER_CODE = '" . $satker."'";
			$this->view->nmsatker = $d_spm1->get_nama_satker_pnbp($satker);
			
        }
		
        $this->view->data = $d_spm1->get_pnbp_gr_line($filter);
		
        

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());
		
		$d_log->tambah_log("Sukses");

        $this->view->render('kppn/detail_gr_pnbp');
    }
	
	public function DetailUPPNBP($akun, $satker) {
        $d_spm1 = new DataPNBP($this->registry);
        $filter = array();
        $no = 0;
		//untuk mencatat log user
        $d_log = new DataLog($this->registry);
		$d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
        if (Session::get('role') == KPPN) {
            $filter[$no++] = "SEGMENT2 = '" . Session::get('id_user')."'";
            $this->view->d_kppn = Session::get('id_user');
			
        }
        if ($akun != '') {
			$filter[$no++] = "JENIS_SPM = '" . $akun."'";
        }
		if ($satker != '') {
			$filter[$no++] = "SATKER_CODE = '" . $satker."'";
			$this->view->nmsatker = $d_spm1->get_nama_satker_pnbp($satker);
			
        }
		
        $this->view->data = $d_spm1->get_pnbp_up_line($filter);
		
        

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());
		
		$d_log->tambah_log("Sukses");

        $this->view->render('kppn/detail_up_pnbp');
    }

	public function DetailBelanjaPNBP($akun, $satker) {
        $d_spm1 = new DataPNBP($this->registry);
        $filter = array();
        $no = 0;
		//untuk mencatat log user
        $d_log = new DataLog($this->registry);
		$d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
        if (Session::get('role') == KPPN) {
            $filter[$no++] = "SEGMENT2 = '" . Session::get('id_user')."'";
            $this->view->d_kppn = Session::get('id_user');
			
        }
        if ($akun != '') {
			$filter[$no++] = "SUBSTR(SEGMENT3,1,2) = '" . $akun."'";
        }
		if ($satker != '') {
			$filter[$no++] = "SATKER_CODE = '" . $satker."'";
			$this->view->nmsatker = $d_spm1->get_nama_satker_pnbp($satker);
			
        }
		
        $this->view->data = $d_spm1->get_pnbp_bel_line($filter);
		
        

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());
		
		$d_log->tambah_log("Sukses");

        $this->view->render('kppn/detail_belanja_pnbp');
    }
	
	public function DetailSetoranUPPNBP($akun, $satker) {
        $d_spm1 = new DataPNBP($this->registry);
        $filter = array();
        $no = 0;
		//untuk mencatat log user
        $d_log = new DataLog($this->registry);
		$d_log->set_activity_time_start(date("d-m-Y h:i:s"));
        
        if (Session::get('role') == KPPN) {
            $filter[$no++] = "KPPN_CODE = '" . Session::get('id_user')."'";
            $this->view->d_kppn = Session::get('id_user');
			
        }
        if ($akun != '') {
			$filter[$no++] = "ACCOUNT_CODE = '" . $akun."'";
        }
		if ($satker != '') {
			$filter[$no++] = "SATKER_CODE = '" . $satker."'";
			$this->view->nmsatker = $d_spm1->get_nama_satker_pnbp($satker);
			
        }
		
        $this->view->data = $d_spm1->get_pnbp_set_up_line($filter);
		
        

        $d_last_update = new DataLastUpdate($this->registry);
        $this->view->last_update = $d_last_update->get_last_updatenya($d_spm1->get_table1());
		
		$d_log->tambah_log("Sukses");

        $this->view->render('kppn/detail_setoran_up_pnbp');
    }
    


    //author by jhon

    public function __destruct() {
        
    }

}
